<?php
	/*
		Title: Modulo central
		Ubicacion *[index.php]*.  Archivo que contiene llamados a los demas modulos y procesos de validacion de cabeceras.
	*/

	// Inicio de la sesion
	session_start();
	
	//Determina si es un primer inicio o no hay configuracion
	if (!file_exists("core/configuracion.php")) { header("Location: ins/"); die();}

	// Datos de fecha, hora y direccion IP para algunas operaciones
	$fecha_operacion=date("Ymd");
	$fecha_operacion_guiones=date("Y-m-d");
	$hora_operacion=date("His");
	$hora_operacion_puntos=date("H:i");
	$direccion_auditoria=$_SERVER ['REMOTE_ADDR'];

	// Recupera variables recibidas para su uso como globales (como si tuviese register_globals=on en php.ini)
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

	// Establece la zona horaria por defecto para la aplicacion - A definir como parametro
	//date_default_timezone_set("America/Bogota");

	//Cargar archivo de configuracion principal
	include("core/configuracion.php");

	// Inicia las conexiones con la BD y las deja listas para las operaciones
	include("core/conexiones.php");
	
	// Incluye archivo con algunas funciones comunes usadas por la herramienta
	include_once("core/comunes.php");

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
	if (@file_exists("ins"))	mensaje('ATENCION: La carpeta de instalaci&oacute;n existe en el servidor','Este mensaje aparecer&aacute; de manera permanente a todos sus usuarios mientras usted no elimine el directorio utilizado durante el proceso de instalaci&oacute;n de Pr&aacute;ctico.  Es fundamental que la carpeta sea eliminada despu&eacute;s de finalizar una instalaci&oacute;n para evitar que algun usuario an&oacute;nimo inicie nuevamente el proceso sobreescribiendo archivos de configuraci&oacute;n o bases de datos con informaci&oacute;n de importancia para usted.<br><br>Si ya ha finalizado un proceso de instalaci&oacute;n de Pr&aacute;ctico para su uso en producci&oacute;n es importante que elimine esta carpeta antes de continuar.  Si no desea eliminar esta carpeta puede optar por renombrarla en instalaciones temporales o de prueba.<br><br>Si est&aacute; visualizando este mensaje al ejecutar este script por primera vez y desea realizar una instalaci&oacute;n nueva, puede iniciar el asistente haciendo <input type="button" Value="clic AQUI" Onclick="document.location=\'ins\'" class="BotonesCuidado">','70%','icono_error.png','TextosEscritorio');

	// Presenta mensajes con errores generales cuando son encontrados durante la ejecucion
	if (@$error_titulo!="")	mensaje($error_titulo,$error_descripcion,'','icono_error.png','TextosEscritorio');

/* ################################################################## */
	// Cuando no se tiene ninguna accion para procesar se carga la pagina de inicio de sesion
	if ($accion=="")
		ventana_login();
	// Incluye los archivos necesarios dependiendo de las funciones requeridas
	if ($accion=="agregar_usuario" || $accion=="guardar_usuario" || $accion=="listar_usuarios" || $accion=="eliminar_usuario" || $accion=="cambiar_estado_usuario" || $accion=="permisos_usuario" || $accion=="agregar_permiso" || $accion=="eliminar_permiso")
		include("core/usuarios.php");
	if ($accion=="administrar_menu" || $accion=="guardar_menu" || $accion=="eliminar_menu" || $accion=="detalles_menu" || $accion=="actualizar_menu")
		include("core/menus.php");
	if ($accion=="administrar_tablas" || $accion=="guardar_crear_tabla" || $accion=="eliminar_tabla" || $accion=="editar_tabla" || $accion=="guardar_crear_campo" || $accion=="eliminar_campo")
		include("core/tablas.php");
	if ($accion=="administrar_formularios" || $accion=="guardar_formulario" || $accion=="eliminar_formulario" || $accion=="editar_formulario" || $accion=="guardar_campo_formulario" || $accion=="eliminar_campo_formulario" || $accion=="guardar_accion_formulario" || $accion=="eliminar_accion_formulario" || $accion=="guardar_datos_formulario")
		include("core/formularios.php");
	if ($accion=="Iniciar_login" || $accion=="Terminar_sesion" || $accion=="Mensaje_cierre_sesion")
		include("core/sesion.php");

/* ################################################################## */
	// Si la accion es presentar el menu de inicio o escritorio
	if ($accion=="Ver_menu" && $Sesion_abierta)
		{ 
			// Carga las opciones del ESCRITORIO
			echo '<table width="100%" border=0><tr><td valign=top>';
			// Si el usuario es el administrador muestra todas las opciones
			if ($Login_usuario=="admin")
				$resultado=ejecutar_sql("SELECT * FROM ".$TablasCore."menu WHERE posible_escritorio");
			//else
			//	$consulta = "SELECT menu.* FROM menu,usuario_menu WHERE posible_escritorio='S' AND usuario_menu.menu=menu.id AND usuario_menu.usuario='$Id_usuario' AND nivel>0";
			// Imprime las opciones con sus formularios
			while($registro = $resultado->fetch())
				{
					// Verifica si se trata de un comando interno o personal y crea formulario y enlace correspondiente (ambos funcionan igual)
					if ($registro["tipo_comando"]=="Interno" || $registro["tipo_comando"]=="Personal")
						{
							// Imprime la imagen asociada si esta definida
							if ($registro["imagen"]!="") 
								{
									echo '<form action="'.$ArchivoCORE.'" method="post" name="desk_'.$registro["id"].'" id="desk_'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;"><input type="hidden" name="accion" value="'.$registro["comando"].'"></form>';
									echo '<a title="'.$registro["texto"].'" name="" href="javascript:document.desk_'.$registro["id"].'.submit();">';
									echo '<img src="img/'.$registro["imagen"].'" alt="'.$registro["texto"].'" class="IconosEscritorio" valign="absmiddle" align="absmiddle">';
									echo '</a>';
								}
						}
				}
			echo '</td></tr></table>';


			// Carga las opciones del ACORDEON
			echo '<div align="center">';
			// Si el usuario es el administrador muestra todas las opciones
			if ($Login_usuario=="admin")
				$resultado=ejecutar_sql("SELECT COUNT(*) as conteo,seccion FROM ".$TablasCore."menu WHERE posible_centro GROUP BY seccion ORDER BY seccion");
			//else
			//	$consulta = "SELECT menu.* FROM menu,usuario_menu WHERE posible_escritorio='S' AND usuario_menu.menu=menu.id AND usuario_menu.usuario='$Id_usuario' AND nivel>0";
			// Imprime las secciones encontradas para el usuario
			while($registro = $resultado->fetch())
				{
					//Crea la seccion en el acordeon
					$seccion_menu_activa=$registro["seccion"];
					$conteo_opciones=$registro["conteo"];
					abrir_ventana($seccion_menu_activa.' ('.$conteo_opciones.')','fondo_ventanas2.gif','85%');
					// Busca las opciones dentro de la seccion
					// Si el usuario es el administrador muestra todas las opciones
					if ($Login_usuario=="admin")
						$resultado_opciones_acordeon=ejecutar_sql("SELECT * FROM ".$TablasCore."menu WHERE posible_centro AND seccion='".$seccion_menu_activa."' ORDER BY peso ");
					//else
					//	$consulta = "SELECT menu.* FROM menu,usuario_menu WHERE posible_escritorio='S' AND usuario_menu.menu=menu.id AND usuario_menu.usuario='$Id_usuario' AND nivel>0";
					while($registro_opciones_acordeon = $resultado_opciones_acordeon->fetch())
						{
							// Verifica si se trata de un comando interno o personal y crea formulario y enlace correspondiente (ambos funcionan igual)
							if ($registro_opciones_acordeon["tipo_comando"]=="Interno" || $registro_opciones_acordeon["tipo_comando"]=="Personal")
								{
									// Imprime la imagen asociada si esta definida
									if ($registro_opciones_acordeon["imagen"]!="") 
										{
											echo '<form action="'.$ArchivoCORE.'" method="post" name="acorde_'.$registro_opciones_acordeon["id"].'" id="acorde_'.$registro_opciones_acordeon["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;"><input type="hidden" name="accion" value="'.$registro_opciones_acordeon["comando"].'"></form>';
											echo '<a title="'.$registro_opciones_acordeon["texto"].'" name="" href="javascript:document.acorde_'.$registro_opciones_acordeon["id"].'.submit();">';
											echo '<img src="img/'.$registro_opciones_acordeon["imagen"].'" alt="'.$registro_opciones_acordeon["texto"].'" class="IconosEscritorio" valign="absmiddle" align="absmiddle">';
											echo '</a>';
										}
								}
						}
					cerrar_ventana();
				}
			echo '</div>';
	} 
/* ################################################################## */
	// Incluye archivo que puede tener funciones personalizadas llamadas mediante acciones de formularios
	include("personalizadas.php");  

	// Finaliza el contenido central y presenta el pie de pagina de aplicacion
	include("core/marco_abajo.php");
?>
