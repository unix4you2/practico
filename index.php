<?php
	/*
	Copyright (C) 2013  John F. Arroyave Gutiérrez
						unix4you2@gmail.com

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
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

	<pre>
	<b>Importante: Si usted esta visualizando este mensaje en su navegador,
	entonces PHP no esta instalado correctamente en su servidor web!</b>
	</pre>
	*/

	/*
		Title: Articulador
		Ubicacion *[index.php]*.  Archivo que contiene llamados a los demas modulos y procesos de validacion de cabeceras.

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

	// Inicio de la sesion
	@session_start();

	//Determina si es un primer inicio o no hay configuracion
	if (!file_exists("core/configuracion.php")) { header("Location: ins/"); die();}
	else include("core/configuracion.php");

	//Incluye idioma espanol (oficial), luego sobreescribe vbles por configuracion de usuario
	include("inc/practico/idiomas/es.php");
	include("inc/practico/idiomas/".$IdiomaPredeterminado.".php");

	//Si esta establecido el modo de depuracion en configuracion.php activa errores del preprocesador
	if ($ModoDepuracion)
		{
			ini_set("display_errors", 1);
			error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE | E_DEPRECATED);
		}
	else
		{
			error_reporting(0);
		}

	// Establece la zona horaria por defecto para la aplicacion
	date_default_timezone_set($ZonaHoraria);

	// Datos de fecha, hora y direccion IP para algunas operaciones
	$fecha_operacion=date("Ymd");
	$fecha_operacion_guiones=date("Y-m-d");
	$hora_operacion=date("His");
	$hora_operacion_puntos=date("H:i");
	$direccion_auditoria=$_SERVER ['REMOTE_ADDR'];

	// Recupera variables recibidas para su uso como globales (equivale a register_globals=on en php.ini)
	if (!ini_get('register_globals'))
	{
		$numero = count($_REQUEST);
		$tags = array_keys($_REQUEST);// obtiene los nombres de las varibles
		$valores = array_values($_REQUEST);// obtiene los valores de las varibles
		// crea las variables y les asigna el valor
		for($i=0;$i<$numero;$i++)
			{
				$$tags[$i]=$valores[$i];
			}
		// Agrega ademas las variables de sesion
		if (!empty($_SESSION)) extract($_SESSION);
	}

	// Verifica algunas variables minimas de trabajo en el primer inicio para evitar NOTICE y WARNINGs
	if (!isset($accion)) $accion="";
	if (!isset($Sesion_abierta)) $Sesion_abierta=0;

	// Inicia las conexiones con la BD y las deja listas para las operaciones
	include("core/conexiones.php");

	// Incluye definiciones comunes de la base de datos
	include_once("inc/practico/def_basedatos.php");
	
	// Incluye archivo con algunas funciones comunes usadas por la herramienta
	include_once("core/comunes.php");

	// Almacena tiempo de inicio para calculo de tiempos de ejecucion del script (informados al admin)
	if(@$Login_usuario=="admin" && $accion!="") $tiempo_inicio_script = obtener_microtime();

	// Determina si al momento de ejecucion se encuentra activado el modo webservices
	include_once("core/ws_nucleo.php");

	limpiar_entradas(); // Evita XSS

	// Valida llaves de paso y permisos de accion
	if ($accion!= "" && $accion!="Iniciar_login" && $accion!="Terminar_sesion" && $accion!="Mensaje_cierre_sesion")
		{
			// Verifica autenticidad de la sesion mediante llave de paso
			if (MD5($LlaveDePaso)!=$LlaveDePasoUsuario)
				{
					header("Location: index.php?accion=Terminar_sesion");
					exit(1);
				}
			// Valida permisos asignados al usuario actual para la accion llamada a ejecutar
			if (!permiso_accion($accion))
				{
					mensaje($MULTILANG_SecErrorTit,$MULTILANG_SecErrorDes."<br>[US=<b>$Login_usuario</b>|CMD=<b>$accion</b>|IP=<b>$direccion_auditoria</b>|DTE=<b>$fecha_operacion_guiones $hora_operacion_puntos</b>]",'','icono_error.png','TextosEscritorio');
					auditar("SEC: Intento de acceso no autorizado CMD=$accion");
					exit(1);
				}
		}

	// Inicia la presentacion de la pagina
	include("core/marco_arriba.php");

	// Prueba que todas las extensiones requeridas se encuentren habilitadas
	verificar_extensiones();

	// Si existe el directorio de instalacion presenta un mensaje constante de advertencia
	if (@file_exists("ins"))	mensaje($MULTILANG_TituloInsExiste,$MULTILANG_TextoInsExiste,'70%','warning_icon.png','TextosEscritorio');

	// Presenta mensajes con errores generales cuando son encontrados durante la ejecucion
	if (@$error_titulo!="")	mensaje($error_titulo,$error_descripcion,'','icono_error.png','TextosEscritorio');

/* ################################################################## */
	// Cuando no se tiene ninguna accion para procesar se carga la pagina de inicio de sesion
	if ($accion=="" && $Sesion_abierta==0) ventana_login();
	if ($accion=="" && $Sesion_abierta==1) echo '<script type="" language="JavaScript">	document.core_ver_menu.submit();  </script>';
	// Incluye los archivos necesarios dependiendo de las funciones requeridas
	if ($accion=="administrar_informes" || $accion=="guardar_informe" || $accion=="editar_informe" || $accion=="eliminar_informe" || $accion=="actualizar_informe" || $accion=="eliminar_informe_tabla" || $accion=="guardar_informe_tabla" || $accion=="eliminar_informe_campo" || $accion=="guardar_informe_campo" || $accion=="guardar_informe_condicion" || $accion=="eliminar_informe_condicion" || $accion=="mis_informes" || $accion=="actualizar_grafico_informe" || $accion=="actualizar_agrupamiento_informe" || $accion=="guardar_accion_informe" || $accion=="eliminar_registro_informe" || $accion=="eliminar_accion_informe")
		include("core/informes.php");
	if ($accion=="ver_seguimiento_monitoreo" || $accion=="ver_seguimiento_general" || $accion=="ver_seguimiento_especifico" || $accion=="actualizar_clave" || $accion=="cambiar_clave" || $accion=="agregar_usuario" || $accion=="guardar_usuario" || $accion=="listar_usuarios" || $accion=="eliminar_usuario" || $accion=="cambiar_estado_usuario" || $accion=="permisos_usuario" || $accion=="agregar_permiso" || $accion=="eliminar_permiso" || $accion=="informes_usuario" || $accion=="agregar_informe_usuario" || $accion=="eliminar_informe_usuario" || $accion=="copiar_permisos")
		include("core/usuarios.php");
	if ($accion=="Ver_menu" || $accion=="administrar_menu" || $accion=="guardar_menu" || $accion=="eliminar_menu" || $accion=="detalles_menu" || $accion=="actualizar_menu")
		include("core/menus.php");
	if ($accion=="guardar_crear_tabla_asistente" || $accion=="asistente_tablas" || $accion=="administrar_tablas" || $accion=="guardar_crear_tabla" || $accion=="eliminar_tabla" || $accion=="editar_tabla" || $accion=="guardar_crear_campo" || $accion=="eliminar_campo")
		include("core/tablas.php");
	if ($accion=="actualizar_campo_formulario" || $accion=="administrar_formularios" || $accion=="guardar_formulario" || $accion=="eliminar_formulario" || $accion=="editar_formulario" || $accion=="guardar_campo_formulario" || $accion=="eliminar_campo_formulario" || $accion=="guardar_accion_formulario" || $accion=="eliminar_accion_formulario" || $accion=="guardar_datos_formulario" || $accion=="eliminar_datos_formulario")
		include("core/formularios.php");
	if ($accion=="Iniciar_login" || $accion=="Terminar_sesion" || $accion=="Mensaje_cierre_sesion")
		include("core/sesion.php");
	if ($accion=="cargar_objeto" || $accion=="guardar_configuracion" || $accion=="guardar_configws")
		include("core/objetos.php");
	if ($accion=="actualizar_practico" || $accion=="cargar_archivo" || $accion=="analizar_parche" || $accion=="aplicar_parche")
		include("core/actualizacion.php");

/* ################################################################## */
	// Incluye archivo que puede tener funciones personalizadas llamadas mediante acciones de formularios
	include("mod/personalizadas.php"); 
	// Incluye otros modulos que residan sobre carpetas en mod/* cuya entrada es index.php
	$directorio_modulos=opendir("mod");
	while (($elemento=readdir($directorio_modulos))!=false)
		{
			//Lo procesa solo si es directorio
			if (is_dir("mod/".$elemento) && $elemento!="." && $elemento!="..")
				{
					//Busca la entrada del modulo sino muestra error
					if (file_exists("mod/".$elemento."/index.php"))
						include("mod/".$elemento."/index.php");
					else
						mensaje($MULTILANG_ErrorTiempoEjecucion,$MULTILANG_ErrorModulo.'<br><b>'.$MULTILANG_Detalles.': '.$elemento.'</b>','','icono_error.png','TextosEscritorio');
				}
		}

	// Finaliza el contenido central y presenta el pie de pagina de aplicacion
	include("core/marco_abajo.php");
?>
