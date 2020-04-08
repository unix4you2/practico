<?php
/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2013
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com

    This program is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License
    as published by the Free Software Foundation; either version 2
    of the License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,MA 02110-1301,USA.

    <pre><b>
    Importante: Si usted esta visualizando este mensaje en su navegador,
    entonces PHP no esta instalado correctamente en su servidor web!</b></pre>

	Title: Modulo Articulador
	Ubicacion *[index.php]*.  Archivo que contiene llamados a los demas
	modulos y procesos de validacion de cabeceras.

	Operaciones resumidas:
		(start code)
			Inicio variables de session
			Inclusion de archivo de configuracion
			Definicion de variables y parametros de funcionamiento
			Inclusion de conexiones PDO y funciones comunes
			Validacion de credenciales y datos de sesion
			Inclusion de marco superior
			Inclusion de modulos segun accion
			Proyeccion de contenidos centrales por cada modulo (externo)
			Inclusion de funciones personalizadas
			Inclusion de marco inferior
		(end)
*/
    
    //Permite WebServices propios mediante el acceso a este script en solicitudes Cross-Domain
    header('Access-Control-Allow-Origin: *');
    //header('X-Frame-Options: deny: sameorigin');  // Acepta:  deny|sameorigin|allow-from https://example.com/  Por defecto es ALLOWALL
    //header('Content-Security-Policy: frame-ancestors <source> <source>;');  //Si no esta permite todo.  A diferencia de X-Frame-Options puede permitir varios origenes
        //header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        //header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        //header("Allow: GET, POST, OPTIONS, PUT, DELETE");
        //if($_SERVER['REQUEST_METHOD'] == "OPTIONS") { die(); }
	header('Content-type: text/html; charset=utf-8');
    
    // Inicio de la sesion
    @session_start();
 
    //Determina si es un primer inicio o no hay configuracion
    if (!file_exists('core/configuracion.php')) {
		header('Location: ins/');
		die();
    }
    else include 'core/configuracion.php';

    //Incluye idioma espanol, o sobreescribe vbles por configuracion de usuario
    include 'inc/practico/idiomas/es.php';
    include 'inc/practico/idiomas/'.$IdiomaPredeterminado.'.php';

    //Determina si la plataforma se encuentra en modo DEMO
    $PCO_ModoDEMO=0;
    if (file_exists('DEMO') && @$PCO_WSOn!=1)
        { $PCO_ModoDEMO=1; echo '<script language="JavaScript"> PCO_ModoDEMO=1; </script>'; }

    //Activa errores del preprocesador en modo de depuracion (configuracion.php)
    if ($ModoDepuracion && isset($_SESSION['PCOSESS_SesionAbierta']) &&  $_SESSION['PCOSESS_SesionAbierta'])
        {
            include_once 'core/comunes.php';
            @include_once 'inc/practico_se/core/comunes.php';
            if (PCO_EsAdministrador($_SESSION['PCOSESS_LoginUsuario']))
                {
                    ini_set('display_errors', 1);
                    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE | E_DEPRECATED | E_STRICT | E_USER_DEPRECATED | E_USER_ERROR | E_USER_WARNING); //Otras disponibles | E_PARSE | E_CORE_ERROR | E_CORE_WARNING |
                }
        }
    else
        error_reporting(0);

    // Establece la zona horaria por defecto para la aplicacion
    date_default_timezone_set($ZonaHoraria);

    // Datos de fecha, hora y direccion IP para algunas operaciones
    $PCO_FechaOperacion=date('Ymd');
    $PCO_FechaOperacionGuiones=date('Y-m-d');
    $PCO_HoraOperacion=date('His');
    $PCO_HoraOperacionPuntos=date('H:i');
    $PCO_DireccionAuditoria=$_SERVER['REMOTE_ADDR'];

    // Define cadena con usuarios Administradores/disenadores.  Obsoleta desde 16.2  Confirmada eliminacion en 17.1
    if (!isset($PCOVAR_Administradores)) $PCOVAR_Administradores="admin";

    // Recupera variables recibidas para su uso como globales (equivale a register_globals=on en php.ini)
    if (!ini_get('register_globals'))
        {
            $PCO_NumeroParametros = count($_REQUEST);
            $PCO_NombresParametros = array_keys($_REQUEST);// obtiene los nombres de las varibles
            $PCO_ValoresParametros = array_values($_REQUEST);// obtiene los valores de las varibles
            // crea las variables y les asigna el valor
            for($i=0;$i<$PCO_NumeroParametros;$i++)
                {
                    ${$PCO_NombresParametros[$i]}=$PCO_ValoresParametros[$i];
                    //Si alguna de las variables proviene de un combo multiple la transforma a su variable original
					if (strstr($PCO_NombresParametros[$i],"PCO_ComboMultiple_")!=FALSE)
					    ${substr($PCO_NombresParametros[$i], strlen("PCO_ComboMultiple_"))}=$PCO_ValoresParametros[$i];
                }
            // Agrega ademas las variables de sesion
            if (!empty($_SESSION)) extract($_SESSION);
        }
    
    //Si el idioma seleccionado por el usuario es diferente al predeterminado lo incluye
    if(isset($PCOSESS_IdiomaUsuario) && @$PCOSESS_IdiomaUsuario!=$IdiomaPredeterminado && @$PCOSESS_IdiomaUsuario!="")
        include 'inc/practico/idiomas/'.$PCOSESS_IdiomaUsuario.'.php';

    // Verifica algunas variables minimas de trabajo en el primer inicio para evitar NOTICE y WARNINGs
    if (!isset($PCO_Accion)) $PCO_Accion="";
    if (!isset($PCOSESS_SesionAbierta)) $PCOSESS_SesionAbierta=0;

    // Inicia las conexiones con la BD y las deja listas para las operaciones
    include_once 'core/conexiones.php';

    // Incluye definiciones comunes de la base de datos
    include_once 'inc/practico/def_basedatos.php';

    // Incluye archivo con algunas funciones comunes usadas por la herramienta
    include_once 'core/comunes.php';
    @include_once 'inc/practico_se/core/comunes.php';

    //Ejecuta cualquier posible enlace corto que se reciba
    if ($_GET["e"]!=""  || $_POST["e"]!="")
        {
            $URLCorta=$_GET["e"]; if ($URLCorta=="") $URLCorta=$_POST["e"];
            //Busca posible URL corta con ese codigo
            $PCO_RegistroURLCorta=PCO_EjecutarSQL("SELECT id,{$ListaCamposSinID_acortadorurls} FROM {$TablasCore}acortadorurls WHERE url_corta=? ","$URLCorta")->fetch(); //http://192.168.0.63/practico/?q=g
            if ($PCO_RegistroURLCorta["id"]!="")
                {
                    PCO_EjecutarSQLUnaria("UPDATE core_acortadorurls SET contador_uso=contador_uso+1 WHERE id='".$PCO_RegistroURLCorta["id"]."' ");
                    if ($PCO_RegistroURLCorta["tipo_redireccion"]=="301")
                        header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$PCO_RegistroURLCorta["url_larga"]);
                }
            else
                {
                    $PCO_ErrorTitulo="ERROR en enlace $URLCorta";
                    $PCO_ErrorDescripcion="<hr><li>El enlace corto solicitado no existe<li>The shortened link that you are asking for doesnt exists";
                }
        }

    // Genera conexiones individuales o conexiones para replicacion de transacciones
    include_once 'core/conexiones_extra.php';

    // Incluye archivo con funciones de correo electronico
    include_once 'core/correos.php';
    @include_once 'inc/practico_se/core/correos.php';

    // Establece funciones propias para el manejo de errores y excepciones
    set_exception_handler('PCO_ManejadorExcepciones');
    set_error_handler('PCO_ManejadorErrores');

    // Almacena tiempo de inicio para calculo de tiempos de ejecucion del script (informados a los Administradores)
    if(PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && $PCO_Accion!="")
        $tiempo_inicio_script = PCO_ObtenerMicrotime();

    // Importa autmaticamente definiciones de elementos internos en XML cuando encuentra alguna dentro de xml/
    if(PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
        { PCO_ImportarDefinicionesXML();  PCO_ImportarScriptsPHP(); }

    // Incluye configuraciones OAuth
    include_once 'core/ws_oauth.php';

    // Determina si al momento de ejecucion se encuentra activado el modo webservices
    include_once 'core/ws_nucleo.php';
    @include_once 'inc/practico_se/core/ws_nucleo.php';

    //Ejecuta cualquier trabajo Cron definido
    include_once 'core/cron.php';
    @include_once 'inc/practico_se/core/cron.php';

    PCO_LimpiarEntradas(); // Evita XSS

    // Incluye clases para procesar archivos en csv, xls, ods, pdf, otros
    require_once 'inc/phpexcel/Classes/PHPExcel.php';
    //require_once 'inc/phpspreadsheet/src/Bootstrap.php';
    //require_once 'inc/phpspreadsheet/src/PhpSpreadsheet/Spreadsheet.php';

    // Incluye archivo que puede tener funciones personalizadas llamadas mediante acciones de formularios
    if (PCO_BuscarErroresSintaxisPHP('mod/personalizadas_pre.php')==0)
        include 'mod/personalizadas_pre.php';

    // Valida llaves de paso y permisos de accion
    if ($PCO_Accion!= "" && $PCO_Accion!="Iniciar_login" && $PCO_Accion!="Terminar_sesion" && $PCO_Accion!="Mensaje_cierre_sesion" && $PCO_Accion!="PCO_VerMonitoreo" && $PCO_Accion!="PCO_RecuperarContrasena" && $PCO_Accion!="PCO_AgregarUsuarioAutoregistro" && $PCO_Accion!="PCO_GuardarUsuarioAutoregistro")
        {
            // Verifica autenticidad de la sesion mediante llave de paso
            if (MD5($LlaveDePaso)!=$LlaveDePasoUsuario) {
                header('Location: index.php?accion=Terminar_sesion');
                exit(1);
            }
            // Valida permisos asignados al usuario actual para la accion llamada a ejecutar
            if (!PCO_PermisoAccion($PCO_Accion)) {
                echo $MULTILANG_SecErrorTit.'<hr>'.$MULTILANG_SecErrorDes.'<hr>[US=<b>'.$PCOSESS_LoginUsuario.'</b>|CMD=<b>'.$PCO_Accion.'</b>|IP=<b>'.$PCO_DireccionAuditoria.'</b>|DTE=<b>'.$PCO_FechaOperacionGuiones.' '.$PCO_HoraOperacionPuntos.'</b>]';
                PCO_Auditar("SEC: Intento de acceso no autorizado CMD=$PCO_Accion");
                exit(1);
            }
        }

    // Inicia la presentacion de la pagina si no esta activado el fullscreen
    if (@$Presentar_FullScreen!=1) $Presentar_FullScreen="";
    if (@$Precarga_EstilosBS!=1) $Precarga_EstilosBS="";
    if (@$Presentar_FullScreen!=1)
        {
            include 'core/marco_arriba.php';
            @include 'inc/practico_se/core/marco_arriba.php';
        }
    else if (@$Precarga_EstilosBS==1) //Valida si el FullScreen al menos requiere de estilos BootStrap basicos
		{
			include 'core/marco_arriba_bs.php';
			@include 'inc/practico_se/core/marco_arriba_bs.php';

			//Inicia lo basico de la pagina
			echo '<body oncontextmenu="return false;">';

			//Incluye formularios de uso comun para transporte de datos
			include_once 'core/marco_forms.php';
            @include_once 'inc/practico_se/core/marco_forms.php';

			echo '    <div id="wrapper">
				<!-- CONTENIDO DE APLICACION -->
				<div id="page-wrapper">  <!-- ANTES page-wrapper-->
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-12">
								<br>';
		}


    // Prueba que todas las extensiones requeridas se encuentren habilitadas
    PCO_VerificarExtensionesPHP();

    // Valida existencia de versiones nuevas cuando un Administrador esta logueado
    PCO_BuscarActualizaciones(@$PCOSESS_LoginUsuario,$PCO_Accion);

    // Presenta mensajes con errores generales cuando son encontrados durante la ejecucion
    if (@$PCO_ErrorTitulo!="") {
        if (@$PCO_ErrorIcono=="") $PCO_ErrorIcono='fa-thumbs-down';
        if (@$PCO_ErrorEstilo=="") $PCO_ErrorEstilo='alert-danger';
        PCO_Mensaje($PCO_ErrorTitulo, $PCO_ErrorDescripcion, '', 'fa fa-fw fa-2x '.$PCO_ErrorIcono, 'alert alert-dismissible '.$PCO_ErrorEstilo);
        //Detiene ejecucion del script (util despues de popups de solo mensajes en operaciones)
        if (@$PCO_ErrorAutoclose=="1") echo '<script type="" language="JavaScript"> window.close();  </script>';
        if (@$PCO_ErrorDetener=="1") die();
    }

    // Si existe el directorio de instalacion y no es modo fullscreen presenta un mensaje constante de advertencia en el escritorio
    if (@file_exists('ins') && PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && @$Presentar_FullScreen!=1 && $PCO_Accion=="PCO_VerMenu")
        PCO_Mensaje($MULTILANG_TituloInsExiste, $MULTILANG_TextoInsExiste, '', 'fa fa-exclamation-triangle fa-5x texto-rojo texto-blink', 'alert alert-warning alert-dismissible');

	//Despliega escritorio de los Administradores
    if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && $PCOSESS_SesionAbierta && $PCO_Accion=="PCO_VerMenu")
        include_once 'core/marco_admin.php';
        @include_once 'inc/practico_se/core/marco_admin.php';

/* ################################################################## */
    // Cuando no se tiene ninguna accion para procesar se carga la pagina de inicio de sesion
    if ($PCO_Accion=="" && $PCOSESS_SesionAbierta==0) PCO_VentanaLogin();
    if ($PCO_Accion=="" && $PCOSESS_SesionAbierta==1 && @$Presentar_FullScreen!=1) echo '<script type="" language="JavaScript">    document.PCO_FormVerMenu.submit();  </script>';
    // Incluye los archivos necesarios dependiendo de las funciones requeridas
    if ($PCO_Accion=="PCO_ExportarInforme" || $PCO_Accion=="PCO_ConfirmarImportacionInforme" || $PCO_Accion=="PCO_AnalizarImportacionInforme" || $PCO_Accion=="PCO_ImportarInforme" || $PCO_Accion=="PCO_DefinirCopiaInformes" || $PCO_Accion=="PCO_ClonarDisenoInforme" || $PCO_Accion=="PCO_AdministrarInformes" || $PCO_Accion=="PCO_GuardarInforme" || $PCO_Accion=="PCO_EditarInforme" || $PCO_Accion=="PCO_EliminarInforme" || $PCO_Accion=="PCO_ActualizarInforme" || $PCO_Accion=="PCO_EliminarInformeTabla" || $PCO_Accion=="PCO_GuardarInformeTabla" || $PCO_Accion=="PCO_EliminarInformeCampo" || $PCO_Accion=="PCO_GuardarInformeCampo" || $PCO_Accion=="PCO_GuardarInformeCondicion" || $PCO_Accion=="PCO_EliminarInformeCondicion" || $PCO_Accion=="PCO_MisInformes" || $PCO_Accion=="PCO_ActualizarGraficoInforme" || $PCO_Accion=="PCO_ActualizarAgrupamientoInforme" || $PCO_Accion=="PCO_GuardarAccionInforme" || $PCO_Accion=="PCO_EliminarRegistroInforme" || $PCO_Accion=="PCO_EliminarAccionInforme")
        { include "core/informes.php";  @include "inc/practico_se/core/informes.php"; }
    if ($PCO_Accion=="PCO_GuardarUsuarioAutoregistro" || $PCO_Accion=="PCO_AgregarUsuarioAutoregistro" || $PCO_Accion=="PCO_CopiarInformes" || $PCO_Accion=="PCO_GuardarPerfilUsuario" || $PCO_Accion=="PCO_ActualizarPerfilUsuario" || $PCO_Accion=="PCO_RecuperarContrasena" || $PCO_Accion=="PCO_ResetearContrasena" || $PCO_Accion=="PCO_PanelAuditoriaMovimientos" || $PCO_Accion=="PCO_ActualizarContrasena" || $PCO_Accion=="PCO_CambiarContrasena" || $PCO_Accion=="PCO_AgregarUsuario" || $PCO_Accion=="PCO_GuardarUsuario" || $PCO_Accion=="PCO_EliminarUsuario" || $PCO_Accion=="PCO_CambiarEstadoUsuario" || $PCO_Accion=="PCO_PermisosUsuario" || $PCO_Accion=="PCO_AgregarPermiso" || $PCO_Accion=="PCO_EliminarPermiso" || $PCO_Accion=="PCO_InformesUsuario" || $PCO_Accion=="PCO_AgregarInformeUsuario" || $PCO_Accion=="PCO_EliminarInformeUsuario" || $PCO_Accion=="PCO_CopiarPermisos")
        { include "core/usuarios.php";  @include "inc/practico_se/core/usuarios.php"; }
    if ($PCO_Accion=="PCO_EjecutarImportacionCSV" || $PCO_Accion=="PCO_EscogerTablaImportacionCSV" || $PCO_Accion=="PCO_AnalizarImportacionCSV" || $PCO_Accion== "PCO_ConfirmarImportacionTabla" || $PCO_Accion== "PCO_ImportarTabla" || $PCO_Accion== "PCO_CopiarTabla" || $PCO_Accion== "PCO_DefinirCopiaTablas" || $PCO_Accion=="PCO_GuardarCrearTablaAsistente" || $PCO_Accion=="PCO_AsistenteTablas" || $PCO_Accion=="PCO_AdministrarTablas" || $PCO_Accion=="PCO_GuardarCrearTabla" || $PCO_Accion=="PCO_EliminarTabla" || $PCO_Accion=="PCO_EditarTabla" || $PCO_Accion=="PCO_GuardarCrearCampo" || $PCO_Accion=="PCO_EliminarCampoTabla")
        { include "core/tablas.php";  @include "inc/practico_se/core/tablas.php"; }
    if ($PCO_Accion=="PCO_DesplazarObjetosForm" || $PCO_Accion=="PCO_EliminarEventoObjeto" || $PCO_Accion=="PCO_EditarEventoObjeto" || $PCO_Accion=="PCO_ActualizarJavaEvento" || $PCO_Accion=="PCO_ConfirmarImportacionFormulario" || $PCO_Accion=="PCO_AnalizarImportacionFormulario" || $PCO_Accion=="PCO_ImportarFormulario" || $PCO_Accion=="PCO_DefinirCopiaFormularios" || $PCO_Accion=="PCO_ActualizarDatosFormulario" || $PCO_Accion=="PCO_ActualizarFormulario" || $PCO_Accion=="PCO_CopiarFormulario" || $PCO_Accion=="PCO_ActualizarCampoFormulario" || $PCO_Accion=="PCO_AdministrarFormularios" || $PCO_Accion=="PCO_GuardarFormulario" || $PCO_Accion=="PCO_EliminarFormulario" || $PCO_Accion=="PCO_EditarFormulario" || $PCO_Accion=="PCO_GuardarCampoFormulario" || $PCO_Accion=="PCO_EliminarCampoFormulario" || $PCO_Accion=="PCO_GuardarAccionFormulario" || $PCO_Accion=="PCO_EliminarAccionFormulario" || $PCO_Accion=="PCO_GuardarDatosFormulario" || $PCO_Accion=="PCO_EliminarDatosFormulario")
        { include "core/formularios.php";  @include "inc/practico_se/core/formularios.php"; }
    if ($PCO_Accion=="PCO_BuscarPermisosPractico" || $PCO_Accion=="PCO_VerMenu" || $PCO_Accion=="PCOFUNC_AdministrarMenu" || $PCO_Accion=="PCO_EliminarMenu")
        { include "core/menus.php";  @include "inc/practico_se/core/menus.php"; }
    if ($PCO_Accion=="Iniciar_login" || $PCO_Accion=="Terminar_sesion" || $PCO_Accion=="Mensaje_cierre_sesion")
        { include "core/sesion.php";  @include "inc/practico_se/core/sesion.php"; }
    if ($PCO_Accion=="PCO_CargarObjeto" || $PCO_Accion=="cargar_objeto" || $PCO_Accion=="guardar_configuracion" || $PCO_Accion=="PCO_GuardarConfiguracionOAuth" || $PCO_Accion=="exportacion_masiva_objetos")
        { include "core/objetos.php";  @include "inc/practico_se/core/objetos.php"; }
    if ($PCO_Accion=="actualizar_practico" || $PCO_Accion=="cargar_archivo" || $PCO_Accion=="analizar_parche" || $PCO_Accion=="aplicar_parche")
        { include "core/actualizacion.php";  @include "inc/practico_se/core/actualizacion.php"; }
    if ($PCO_Accion=="PCO_VerMonitoreo")
        { include "core/monitoreo.php";  @include "inc/practico_se/core/monitoreo.php"; }
    if ($PCO_Accion=="recordset_json" || $PCO_Accion=="cambiar_estado_campo" || $PCO_Accion=="valor_campo_tabla" || $PCO_Accion=="opciones_combo_box" || $PCO_Accion=="PCO_ObtenerOpcionesAjaxSelect")
        { include "core/ajax.php";  @include "inc/practico_se/core/ajax.php"; }
    if ($PCO_Accion=="PCO_ReportarBugs" || $PCO_Accion=="mantenimiento_tablas" || $PCO_Accion=="limpiar_temporales" || $PCO_Accion=="limpiar_backups")
        { include "core/mantenimiento.php";  @include "inc/practico_se/core/mantenimiento.php"; }
    if ($PCO_Accion=="PCO_ExplorarTablerosKanbanResumido" || $PCO_Accion=="EliminarTableroKanban" || $PCO_Accion=="GuardarCreacionKanban" || $PCO_Accion=="VerTareasArchivadas" || $PCO_Accion=="ArchivarTareaKanban" || $PCO_Accion=="PCO_ExplorarTablerosKanban" || $PCO_Accion=="GuardarTareaKanban" || $PCO_Accion=="EliminarTareaKanban" || $PCO_Accion=="GuardarPersonalizacionKanban")
        { include "core/kanban.php";  @include "inc/practico_se/core/kanban.php"; }


/* ################################################################## */
    // Incluye archivo que puede tener funciones personalizadas llamadas mediante acciones de formularios. Incluye compatibilidad hacia atras en personalizadas.php
    if (file_exists('mod/personalizadas.php')) include 'mod/personalizadas.php';
    if (PCO_BuscarErroresSintaxisPHP('mod/personalizadas_pos.php')==0)
        include 'mod/personalizadas_pos.php';

    // Incluye otros modulos que residan sobre carpetas en mod/* cuya entrada es index.php
    $directorio_modulos=opendir('mod');
    while (($PCOVAR_Elemento=readdir($directorio_modulos))!=false) {
        //Lo procesa solo si es directorio
        if (is_dir('mod/'.$PCOVAR_Elemento) && $PCOVAR_Elemento!="." && $PCOVAR_Elemento!="..") {
            //Busca la entrada del modulo sino muestra error
            if (file_exists('mod/'.$PCOVAR_Elemento.'/index.php'))
                {
                    //Incluye el archivo menos algunos modulos especiales de la herramienta que se ejecutan por separado
                    if ($PCOVAR_Elemento!="pcoder" && $PCOVAR_Elemento!="pmydb")
                        {
                            if (PCO_BuscarErroresSintaxisPHP('mod/'.$PCOVAR_Elemento.'/index.php')==0)
                                include 'mod/'.$PCOVAR_Elemento.'/index.php';
                        }
                }
            else
                PCO_Mensaje($MULTILANG_ErrorTiempoEjecucion, $MULTILANG_ErrorModulo.'<br><b>'.$MULTILANG_Detalles.': '.$PCOVAR_Elemento.'</b>', '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
        }
    }

/* ################################################################## */
    // Finaliza el contenido central y presenta el pie de pagina de aplicacion
    // siempre y cuando no se esta en fullscreen.  Si la precarga esta activa tambien lo incluye
    if (@$Presentar_FullScreen!=1 || @$Precarga_EstilosBS==1)
        {
            include 'core/marco_abajo.php';
            @include 'inc/practico_se/core/marco_abajo.php';
        }