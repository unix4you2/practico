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
	*/

	/*
		Title: Modulo central
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
	session_start();

	//Determina si es un primer inicio o no hay configuracion
	if (!file_exists("core/configuracion.php")) { header("Location: ins/"); die();}
	else include("core/configuracion.php");

	//Si esta establecido el modo de depuracion en configuracion.php activa errores del preprocesador
	if ($ModoDepuracion)
		{
			ini_set("display_errors", 1);
			error_reporting(E_ERROR | E_WARNING | E_PARSE);
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
	
	// Incluye archivo con algunas funciones comunes usadas por la herramienta
	include_once("core/comunes.php");

	// Almacena tiempo de inicio para calculo de tiempos de ejecucion del script (informados al admin)
	if($Login_usuario=="admin" && $accion!="") $tiempo_inicio_script = obtener_microtime();

	// Verifica autenticidad de la sesion mediante llave de paso
	if ($accion!= "" && $accion!="Iniciar_login" && $accion!="Terminar_sesion" && $accion!="Mensaje_cierre_sesion")
		if (MD5($LlaveDePaso)!=$LlaveDePasoUsuario)
			{
				header("Location: index.php?accion=Terminar_sesion");
				exit(1);
			}

	// Inicia la presentacion de la pagina
	include("core/marco_arriba.php");

	// Si existe el directorio de instalacion presenta un mensaje constante de advertencia
	if (@file_exists("ins"))	mensaje('ATENCION: La carpeta de instalaci&oacute;n existe en el servidor','Este mensaje aparecer&aacute; de manera permanente a todos sus usuarios mientras usted no elimine el directorio utilizado durante el proceso de instalaci&oacute;n de Pr&aacute;ctico.  Es fundamental que la carpeta sea eliminada despu&eacute;s de finalizar una instalaci&oacute;n para evitar que algun usuario an&oacute;nimo inicie nuevamente el proceso sobreescribiendo archivos de configuraci&oacute;n o bases de datos con informaci&oacute;n de importancia para usted.<br><br>Si ya ha finalizado un proceso de instalaci&oacute;n de Pr&aacute;ctico para su uso en producci&oacute;n es importante que elimine esta carpeta antes de continuar.  Si no desea eliminar esta carpeta puede optar por renombrarla en instalaciones temporales o de prueba.<br><br>Si est&aacute; visualizando este mensaje al ejecutar este script por primera vez y desea realizar una instalaci&oacute;n nueva, puede iniciar el asistente haciendo <input type="button" Value="clic AQUI" Onclick="document.location=\'ins\'" class="BotonesCuidado">','70%','warning_icon.png','TextosEscritorio');

	// Presenta mensajes con errores generales cuando son encontrados durante la ejecucion
	if (@$error_titulo!="")	mensaje($error_titulo,$error_descripcion,'','icono_error.png','TextosEscritorio');

/* ################################################################## */
	// Cuando no se tiene ninguna accion para procesar se carga la pagina de inicio de sesion
	if ($accion=="")
		ventana_login();
	// Incluye los archivos necesarios dependiendo de las funciones requeridas
	if ($accion=="administrar_informes" || $accion=="guardar_informe" || $accion=="editar_informe" || $accion=="eliminar_informe" || $accion=="actualizar_informe" || $accion=="eliminar_informe_tabla" || $accion=="guardar_informe_tabla" || $accion=="eliminar_informe_campo" || $accion=="guardar_informe_campo" || $accion=="guardar_informe_condicion" || $accion=="eliminar_informe_condicion" || $accion=="mis_informes" || $accion=="actualizar_grafico_informe" || $accion=="actualizar_agrupamiento_informe")
		include("core/informes.php");
	if ($accion=="actualizar_clave" || $accion=="cambiar_clave" || $accion=="agregar_usuario" || $accion=="guardar_usuario" || $accion=="listar_usuarios" || $accion=="eliminar_usuario" || $accion=="cambiar_estado_usuario" || $accion=="permisos_usuario" || $accion=="agregar_permiso" || $accion=="eliminar_permiso" || $accion=="informes_usuario" || $accion=="agregar_informe_usuario" || $accion=="eliminar_informe_usuario" || $accion=="copiar_permisos")
		include("core/usuarios.php");
	if ($accion=="Ver_menu" || $accion=="administrar_menu" || $accion=="guardar_menu" || $accion=="eliminar_menu" || $accion=="detalles_menu" || $accion=="actualizar_menu")
		include("core/menus.php");
	if ($accion=="guardar_crear_tabla_asistente" || $accion=="asistente_tablas" || $accion=="administrar_tablas" || $accion=="guardar_crear_tabla" || $accion=="eliminar_tabla" || $accion=="editar_tabla" || $accion=="guardar_crear_campo" || $accion=="eliminar_campo")
		include("core/tablas.php");
	if ($accion=="administrar_formularios" || $accion=="guardar_formulario" || $accion=="eliminar_formulario" || $accion=="editar_formulario" || $accion=="guardar_campo_formulario" || $accion=="eliminar_campo_formulario" || $accion=="guardar_accion_formulario" || $accion=="eliminar_accion_formulario" || $accion=="guardar_datos_formulario" || $accion=="eliminar_datos_formulario")
		include("core/formularios.php");
	if ($accion=="Iniciar_login" || $accion=="Terminar_sesion" || $accion=="Mensaje_cierre_sesion")
		include("core/sesion.php");
	if ($accion=="cargar_objeto")
		include("core/objetos.php");
	if ($accion=="actualizar_practico" || $accion=="cargar_archivo" || $accion=="analizar_parche" || $accion=="aplicar_parche")
		include("core/actualizacion.php");

/* ################################################################## */
	// Incluye archivo que puede tener funciones personalizadas llamadas mediante acciones de formularios
	include("personalizadas.php");  

	// Finaliza el contenido central y presenta el pie de pagina de aplicacion
	include("core/marco_abajo.php");
?>
