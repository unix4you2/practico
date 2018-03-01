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
	header('Content-type: text/html; charset=utf-8');
    
    // Inicio de la sesion
    @session_start();
 
    //Determina si es un primer inicio o no hay configuracion
    if (!file_exists("core/configuracion.php")) {
            header("Location: ins/");
            die();
    }
    else include("core/configuracion.php");

    //Incluye idioma espanol, o sobreescribe vbles por configuracion de usuario
    include("inc/practico/idiomas/es.php");
    include("inc/practico/idiomas/".$IdiomaPredeterminado.".php");

    //Determina si la plataforma se encuentra en modo DEMO
    $PCO_ModoDEMO=0;
    if (file_exists("DEMO") && @$PCO_WSOn!=1)
		{ $PCO_ModoDEMO=1; echo "<script language='JavaScript'> PCO_ModoDEMO=1; </script>"; }

    //Activa errores del preprocesador en modo de depuracion (configuracion.php)
    if ($ModoDepuracion && $_SESSION['PCOSESS_SesionAbierta'])
        {
			include_once("core/comunes.php");
			if (PCO_EsAdministrador($_SESSION['PCOSESS_LoginUsuario']))
				{
					ini_set("display_errors", 1);
					error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE | E_DEPRECATED | E_STRICT | E_USER_DEPRECATED | E_USER_ERROR | E_USER_WARNING); //Otras disponibles | E_PARSE | E_CORE_ERROR | E_CORE_WARNING |
				}
        }
    else
        error_reporting(0);

    // Establece la zona horaria por defecto para la aplicacion
    date_default_timezone_set($ZonaHoraria);

    // Datos de fecha, hora y direccion IP para algunas operaciones
    $PCO_FechaOperacion=date("Ymd");
    $PCO_FechaOperacionGuiones=date("Y-m-d");
    $PCO_HoraOperacion=date("His");
    $PCO_HoraOperacionPuntos=date("H:i");
    $PCO_DireccionAuditoria=$_SERVER ['REMOTE_ADDR'];

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
                }
            // Agrega ademas las variables de sesion
            if (!empty($_SESSION)) extract($_SESSION);
        }
    
    //Si el idioma seleccionado por el usuario es diferente al predeterminado lo incluye
    if($PCOSESS_IdiomaUsuario!=$IdiomaPredeterminado && $PCOSESS_IdiomaUsuario!="")
        {
            include("inc/practico/idiomas/".$PCOSESS_IdiomaUsuario.".php");
        }

    // Verifica algunas variables minimas de trabajo en el primer inicio para evitar NOTICE y WARNINGs
    if (!isset($PCO_Accion)) $PCO_Accion="";
    if (!isset($PCOSESS_SesionAbierta)) $PCOSESS_SesionAbierta=0;

    // Inicia las conexiones con la BD y las deja listas para las operaciones
    include_once("core/conexiones.php");

    // Incluye definiciones comunes de la base de datos
    include_once("inc/practico/def_basedatos.php");

    // Incluye archivo con algunas funciones comunes usadas por la herramienta
    include_once("core/comunes.php");

	// Genera conexiones individuales o conexiones para replicacion de transacciones
	include_once("core/conexiones_extra.php");

    // Incluye archivo con funciones de correo electronico
    include_once("core/correos.php");

    // Establece funciones propias para el manejo de errores y excepciones
    set_exception_handler('PCO_ManejadorExcepciones');
    set_error_handler('PCO_ManejadorErrores');

    // Almacena tiempo de inicio para calculo de tiempos de ejecucion del script (informados a los Administradores)
    if(PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && $PCO_Accion!="") {
        $tiempo_inicio_script = obtener_microtime();
    }

    // Importa autmaticamente definiciones de elementos internos en XML cuando encuentra alguna dentro de xml/
    if(PCO_EsAdministrador(@$PCOSESS_LoginUsuario)) {
        PCO_ImportarDefinicionesXML();
    }

    // Incluye configuraciones OAuth
    include_once("core/ws_oauth.php");

    // Determina si al momento de ejecucion se encuentra activado el modo webservices
    include_once("core/ws_nucleo.php");

    limpiar_entradas(); // Evita XSS

	// Incluye clases para procesar archivos en csv, xls, ods, pdf, otros
	require_once ('inc/phpexcel/Classes/PHPExcel.php');

    // Valida llaves de paso y permisos de accion
    if ($PCO_Accion!= "" && $PCO_Accion!="Iniciar_login" && $PCO_Accion!="Terminar_sesion" && $PCO_Accion!="Mensaje_cierre_sesion" && $PCO_Accion!="ver_monitoreo" && $PCO_Accion!="recuperar_contrasena" && $PCO_Accion!="agregar_usuario_autoregistro" && $PCO_Accion!="guardar_usuario_autoregistro")
        {
            // Verifica autenticidad de la sesion mediante llave de paso
            if (MD5($LlaveDePaso)!=$LlaveDePasoUsuario) {
                header("Location: index.php?accion=Terminar_sesion");
                exit(1);
            }
            // Valida permisos asignados al usuario actual para la accion llamada a ejecutar
            if (!permiso_accion($PCO_Accion)) {
                echo $MULTILANG_SecErrorTit."<hr>".$MULTILANG_SecErrorDes."<hr>[US=<b>$PCOSESS_LoginUsuario</b>|CMD=<b>$PCO_Accion</b>|IP=<b>$PCO_DireccionAuditoria</b>|DTE=<b>$PCO_FechaOperacionGuiones $PCO_HoraOperacionPuntos</b>]";
                auditar("SEC: Intento de acceso no autorizado CMD=$PCO_Accion");
                exit(1);
            }
        }

    // Incluye archivo que puede tener funciones personalizadas llamadas mediante acciones de formularios
    if (PCO_BuscarErroresSintaxisPHP("mod/personalizadas_pre.php")==0)
        include("mod/personalizadas_pre.php"); 

    // Inicia la presentacion de la pagina si no esta activado el fullscreen
    if (@$Presentar_FullScreen!=1) $Presentar_FullScreen="";
    if (@$Precarga_EstilosBS!=1) $Precarga_EstilosBS="";
    if (@$Presentar_FullScreen!=1) 
        {
            include("core/marco_arriba.php");
        }
    else
        {
            //Valida si el FullScreen al menos requiere de estilos BootStrap basicos
            if (@$Precarga_EstilosBS==1) 
                {
                    include("core/marco_arriba_bs.php");
                    //Inicia lo basico de la pagina
                    echo '<body oncontextmenu="return false;">';

					//Incluye formularios de uso comun para transporte de datos
					include_once("core/marco_forms.php");

                    echo '    <div id="wrapper">
                        <!-- CONTENIDO DE APLICACION -->
                        <div id="page-wrapper">  <!-- ANTES page-wrapper-->
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <br>';
                }
        }


    // Prueba que todas las extensiones requeridas se encuentren habilitadas
    verificar_extensiones();

    // Valida existencia de versiones nuevas cuando un Administrador esta logueado
    buscar_actualizaciones(@$PCOSESS_LoginUsuario,$PCO_Accion);

    // Presenta mensajes con errores generales cuando son encontrados durante la ejecucion
    if (@$PCO_ErrorTitulo!="") {
        if (@$PCO_ErrorIcono=="") $PCO_ErrorIcono='fa-thumbs-down';
        if (@$PCO_ErrorEstilo=="") $PCO_ErrorEstilo='alert-danger';
        mensaje($PCO_ErrorTitulo, $PCO_ErrorDescripcion, '', 'fa fa-fw fa-2x '.$PCO_ErrorIcono, 'alert alert-dismissible '.$PCO_ErrorEstilo);
        //Detiene ejecucion del script (util despues de popups de solo mensajes en operaciones)
        if (@$PCO_ErrorAutoclose=="1") echo '<script type="" language="JavaScript"> window.close();  </script>';
        if (@$PCO_ErrorDetener=="1") die();
    }

	// Si existe el directorio de instalacion y no es modo fullscreen presenta un mensaje constante de advertencia en el escritorio
	if (@file_exists("ins") && PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && @$Presentar_FullScreen!=1 && $PCO_Accion=="Ver_menu") {
		mensaje($MULTILANG_TituloInsExiste, $MULTILANG_TextoInsExiste, '', 'fa fa-exclamation-triangle fa-5x texto-rojo texto-blink', 'alert alert-warning alert-dismissible');
	}

	//Despliega escritorio de los Administradores
	if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && $PCOSESS_SesionAbierta && $PCO_Accion=="Ver_menu") {
        include_once("core/marco_admin.php");
    }


/* ################################################################## */
    // Cuando no se tiene ninguna accion para procesar se carga la pagina de inicio de sesion
    if ($PCO_Accion=="" && $PCOSESS_SesionAbierta==0) ventana_login();
    if ($PCO_Accion=="" && $PCOSESS_SesionAbierta==1 && @$Presentar_FullScreen!=1) echo '<script type="" language="JavaScript">    document.core_ver_menu.submit();  </script>';
    // Incluye los archivos necesarios dependiendo de las funciones requeridas
    if ($PCO_Accion=="exportar_informe" || $PCO_Accion=="confirmar_importacion_informe" || $PCO_Accion=="analizar_importacion_informe" || $PCO_Accion=="importar_informe" || $PCO_Accion=="definir_copia_informes" || $PCO_Accion=="clonar_diseno_informe" || $PCO_Accion=="administrar_informes" || $PCO_Accion=="guardar_informe" || $PCO_Accion=="editar_informe" || $PCO_Accion=="eliminar_informe" || $PCO_Accion=="actualizar_informe" || $PCO_Accion=="eliminar_informe_tabla" || $PCO_Accion=="guardar_informe_tabla" || $PCO_Accion=="eliminar_informe_campo" || $PCO_Accion=="guardar_informe_campo" || $PCO_Accion=="guardar_informe_condicion" || $PCO_Accion=="eliminar_informe_condicion" || $PCO_Accion=="mis_informes" || $PCO_Accion=="actualizar_grafico_informe" || $PCO_Accion=="actualizar_agrupamiento_informe" || $PCO_Accion=="guardar_accion_informe" || $PCO_Accion=="eliminar_registro_informe" || $PCO_Accion=="eliminar_accion_informe")
        include("core/informes.php");
    if ($PCO_Accion=="guardar_usuario_autoregistro" || $PCO_Accion=="agregar_usuario_autoregistro" || $PCO_Accion=="copiar_informes" || $PCO_Accion=="guardar_perfil_usuario" || $PCO_Accion=="actualizar_perfil_usuario" || $PCO_Accion=="recuperar_contrasena" || $PCO_Accion=="resetear_clave" || $PCO_Accion=="ver_seguimiento_monitoreo" || $PCO_Accion=="ver_seguimiento_general" || $PCO_Accion=="ver_seguimiento_especifico" || $PCO_Accion=="actualizar_clave" || $PCO_Accion=="cambiar_clave" || $PCO_Accion=="agregar_usuario" || $PCO_Accion=="guardar_usuario" || $PCO_Accion=="listar_usuarios" || $PCO_Accion=="eliminar_usuario" || $PCO_Accion=="cambiar_estado_usuario" || $PCO_Accion=="permisos_usuario" || $PCO_Accion=="agregar_permiso" || $PCO_Accion=="eliminar_permiso" || $PCO_Accion=="informes_usuario" || $PCO_Accion=="agregar_informe_usuario" || $PCO_Accion=="eliminar_informe_usuario" || $PCO_Accion=="copiar_permisos")
        include("core/usuarios.php");
    if ($PCO_Accion=="buscar_permisos_practico" || $PCO_Accion=="Ver_menu" || $PCO_Accion=="administrar_menu" || $PCO_Accion=="guardar_menu" || $PCO_Accion=="eliminar_menu" || $PCO_Accion=="detalles_menu" || $PCO_Accion=="actualizar_menu")
        include("core/menus.php");
    if ($PCO_Accion=="ejecutar_importacion_csv" || $PCO_Accion=="escogertabla_importacion_csv" || $PCO_Accion=="analizar_importacion_csv" || $PCO_Accion== "confirmar_importacion_tabla" || $PCO_Accion== "importar_tabla" || $PCO_Accion== "copiar_tabla" || $PCO_Accion== "definir_copia_tablas" || $PCO_Accion=="guardar_crear_tabla_asistente" || $PCO_Accion=="asistente_tablas" || $PCO_Accion=="administrar_tablas" || $PCO_Accion=="guardar_crear_tabla" || $PCO_Accion=="eliminar_tabla" || $PCO_Accion=="editar_tabla" || $PCO_Accion=="guardar_crear_campo" || $PCO_Accion=="eliminar_campo")
        include("core/tablas.php");
    if ($PCO_Accion=="eliminar_evento_objeto" || $PCO_Accion=="editar_evento_objeto" || $PCO_Accion=="actualizar_java_evento" || $PCO_Accion=="confirmar_importacion_formulario" || $PCO_Accion=="analizar_importacion_formulario" || $PCO_Accion=="importar_formulario" || $PCO_Accion=="definir_copia_formularios" || $PCO_Accion=="actualizar_datos_formulario" || $PCO_Accion=="actualizar_formulario" || $PCO_Accion=="copiar_formulario" || $PCO_Accion=="actualizar_campo_formulario" || $PCO_Accion=="administrar_formularios" || $PCO_Accion=="guardar_formulario" || $PCO_Accion=="eliminar_formulario" || $PCO_Accion=="editar_formulario" || $PCO_Accion=="guardar_campo_formulario" || $PCO_Accion=="eliminar_campo_formulario" || $PCO_Accion=="guardar_accion_formulario" || $PCO_Accion=="eliminar_accion_formulario" || $PCO_Accion=="guardar_datos_formulario" || $PCO_Accion=="eliminar_datos_formulario")
        include("core/formularios.php");
    if ($PCO_Accion=="Iniciar_login" || $PCO_Accion=="Terminar_sesion" || $PCO_Accion=="Mensaje_cierre_sesion")
        include("core/sesion.php");
    if ($PCO_Accion=="cargar_objeto" || $PCO_Accion=="guardar_configuracion" || $PCO_Accion=="PCO_GuardarConfiguracionOAuth" || $PCO_Accion=="exportacion_masiva_objetos")
        include("core/objetos.php");
    if ($PCO_Accion=="actualizar_practico" || $PCO_Accion=="cargar_archivo" || $PCO_Accion=="analizar_parche" || $PCO_Accion=="aplicar_parche")
        include("core/actualizacion.php");
    if ($PCO_Accion=="actualizar_monitoreo" || $PCO_Accion=="detalles_monitoreo" || $PCO_Accion=="administrar_monitoreo" || $PCO_Accion=="guardar_monitoreo" || $PCO_Accion=="eliminar_monitoreo" || $PCO_Accion=="ver_monitoreo")
        include("core/monitoreo.php");
    if ($PCO_Accion=="cambiar_estado_campo" || $PCO_Accion=="valor_campo_tabla" || $PCO_Accion=="opciones_combo_box")
        include("core/ajax.php");
	if ($PCO_Accion=="PCO_EditarConfiguracionOAuth" || $PCO_Accion=="mantenimiento_tablas" || $PCO_Accion=="limpiar_temporales" || $PCO_Accion=="limpiar_backups")
		include("core/mantenimiento.php");
    if ($PCO_Accion=="administrar_replicacion" || $PCO_Accion=="eliminar_replica" || $PCO_Accion=="detalles_replicacion" || $PCO_Accion=="guardar_replicacion" || $PCO_Accion=="actualizar_replicacion")
        include("core/replicacion.php");
    if ($PCO_Accion=="EliminarTableroKanban" || $PCO_Accion=="GuardarCreacionKanban" || $PCO_Accion=="VerTareasArchivadas" || $PCO_Accion=="ArchivarTareaKanban" || $PCO_Accion=="ExplorarTablerosKanban" || $PCO_Accion=="GuardarTareaKanban" || $PCO_Accion=="EliminarTareaKanban" || $PCO_Accion=="GuardarPersonalizacionKanban")
        include("core/kanban.php");

/* ################################################################## */
    // Incluye archivo que puede tener funciones personalizadas llamadas mediante acciones de formularios. Incluye compatibilidad hacia atras en personalizadas.php
    if (file_exists("mod/personalizadas.php")) include("mod/personalizadas.php");
    if (PCO_BuscarErroresSintaxisPHP("mod/personalizadas_pos.php")==0)
        include("mod/personalizadas_pos.php");

    // Incluye otros modulos que residan sobre carpetas en mod/* cuya entrada es index.php
    $directorio_modulos=opendir("mod");
    while (($PCOVAR_Elemento=readdir($directorio_modulos))!=false) {
        //Lo procesa solo si es directorio
        if (is_dir("mod/".$PCOVAR_Elemento) && $PCOVAR_Elemento!="." && $PCOVAR_Elemento!="..") {
            //Busca la entrada del modulo sino muestra error
            if (file_exists("mod/".$PCOVAR_Elemento."/index.php"))
				{
					//Incluye el archivo menos algunos modulos especiales de la herramienta que se ejecutan por separado
					if ($PCOVAR_Elemento!="pcoder" && $PCOVAR_Elemento!="pmydb")
					    {
						    if (PCO_BuscarErroresSintaxisPHP("mod/".$PCOVAR_Elemento."/index.php")==0)
						        include("mod/".$PCOVAR_Elemento."/index.php");
					    }
				}
            else
                mensaje($MULTILANG_ErrorTiempoEjecucion, $MULTILANG_ErrorModulo.'<br><b>'.$MULTILANG_Detalles.': '.$PCOVAR_Elemento.'</b>', '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
        }
    }

/* ################################################################## */
    // Finaliza el contenido central y presenta el pie de pagina de aplicacion
    // siempre y cuando no se esta en fullscreen.  Si la precarga esta activa tambien lo incluye
    if (@$Presentar_FullScreen!=1 || @$Precarga_EstilosBS==1)
        {
            include "core/marco_abajo.php";
        }