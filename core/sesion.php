<?php
			/*
				Title: Modulo sesion
				Ubicacion *[/core/sesion.php]*.  Archivo de funciones relacionadas con la administracion de sesiones en el sistema.
			*/
?>


<?php
			/*
				Section: Administracion de permisos
				Funciones asociadas a la gestion de permisos, roles y demas posibilidades de acceso que puedan tener los usuarios en el aplicativo.
			*/
?>


<?php
/* ################################################################# */
	if ($accion=="Iniciar_login") 
		{
			//Verifica el captcha ingresado por el usuario
			$ok_captcha=1;
			if ($captcha_temporal!=$captcha)
				{
					$ok_captcha=0;
					// Lleva a auditoria
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$uid','Elimina sesiones activas al intentar acceso con CAPTCHA incorrecto desde $direccion_auditoria','$fecha_operacion','$hora_operacion')");
				}
			session_destroy();

			$resultado_usuario=ejecutar_sql("SELECT login, nombre, clave, descripcion, nivel, correo, llave_paso FROM ".$TablasCore."usuario WHERE estado=1 AND login='$uid' AND clave=MD5('$clave')");
			$registro = $resultado_usuario->fetch();

			$clave_correcta=0;
			if ($clave!="" && $registro["login"]!="" && $ok_captcha==1)
				  {
						// Se buscan datos de la aplicacion
						$consulta_parametros=ejecutar_sql("SELECT * FROM ".$TablasCore."parametros");
						$registro_parametros = $consulta_parametros->fetch();

						// Actualiza las vartiables de sesion con el registro
						//$Login_usuario=$registro["login"];
						//$Nombre_usuario=$registro["nombre"];
						//$Clave_usuario=$registro["clave"];
						//$Descripcion_usuario=$registro["descripcion"];
						//$Nivel_usuario=$registro["nivel"];
						//$Correo_usuario=$registro["correo"];
						$Sesion_abierta=1;
						// Actualiza booleana de ingreso
						$clave_correcta=1;
						// Registro de variables en la sesion
						/*Antes con depreciada: session_register('Login_usuario');*/
						session_start();
						if (!isset($_SESSION["Login_usuario"])) $_SESSION["Login_usuario"]=$registro["login"];
						if (!isset($_SESSION["Nombre_usuario"])) $_SESSION["Nombre_usuario"]=$registro["nombre"];
						if (!isset($_SESSION["Clave_usuario"])) $_SESSION["Clave_usuario"]=$registro["clave"];
						if (!isset($_SESSION["Descripcion_usuario"])) $_SESSION["Descripcion_usuario"]=$registro["descripcion"];
						if (!isset($_SESSION["Nivel_usuario"])) $_SESSION["Nivel_usuario"]=$registro["nivel"];
						if (!isset($_SESSION["Correo_usuario"])) $_SESSION["Correo_usuario"]=$registro["correo"];
						if (!isset($_SESSION["Sesion_abierta"])) $_SESSION["Sesion_abierta"]=$Sesion_abierta;
						if (!isset($_SESSION["clave_correcta"])) $_SESSION["clave_correcta"]=$clave_correcta;
						if (!isset($_SESSION["LlaveDePasoUsuario"])) $_SESSION["LlaveDePasoUsuario"]=$registro["llave_paso"];
						
						if (!isset($_SESSION["Nombre_Empresa_Corto"])) $_SESSION["Nombre_Empresa_Corto"]=$registro_parametros["nombre_empresa_corto"];
						if (!isset($_SESSION["Nombre_Aplicacion"])) $_SESSION["Nombre_Aplicacion"]=$registro_parametros["nombre_aplicacion"];
						if (!isset($_SESSION["Version_Aplicacion"])) $_SESSION["Version_Aplicacion"]=$registro_parametros["version"];

						// Lleva a auditoria
						ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$uid','Ingresa al sistema desde $direccion_auditoria','$fecha_operacion','$hora_operacion')");
						// Actualiza fecha del ultimo ingreso para el usuario
						ejecutar_sql_unaria("UPDATE ".$TablasCore."usuario SET ultimo_acceso='$fecha_operacion' WHERE login='$uid'");
				  }

			// Si la clave es incorrecta muestra de nuevo la ventana de ingreso
			if (!$clave_correcta)
				{
					mensaje('<blink>ACCESO NEGADO!</blink>','Las credenciales suministradas para el acceso al sistema no fueron aceptadas.  Algunas causas comunes son:<br><li>El nombre de usuario o contrase&ntilde;a son incorrectos.<br><li>C&oacute;digo de seguridad ingresado de manera incorrecta.<br><li>Su usuario est&aacute; deshabilitado.<br><li>Cuenta bloqueada por multiples intentos de acceso con clave incorrecta.','60%','../img/tango_dialog-error.png','TextosEscritorio');
					ventana_login();
					@session_destroy();
				}
			else
				{
					echo '<form name="Acceso" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="accion" value="Ver_menu"></form><script type="" language="JavaScript">	document.Acceso.submit();  </script>';
				}
		}
?>

<?php
/* ################################################################# */
	if ($accion=="Terminar_sesion")
	{
		// Lleva a auditoria
		ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Cierra sesion desde $direccion_auditoria','$fecha_operacion','$hora_operacion')");

		session_destroy();
		echo '<form name="Redireccion" method="POST"><input type="Hidden" name="accion" value="Mensaje_cierre_sesion"></form><script type="" language="JavaScript">	document.Redireccion.submit();  </script>';
	}
?>

<?php
/* ################################################################# */
	if ($accion=="Mensaje_cierre_sesion")
	{
		@session_destroy();
		echo '<br><br><div align="center">';
		abrir_ventana('Alerta de seguridad','FFFFFF','');
			echo '
			<br><div align="center" class="TextosVentana"><strong><font size="3">Su sesi&oacute;n ha sido cerrada</font></strong>					
			<table width="100%"><tr>
				<td>

					</div><br>
					<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center" class="TextosVentana"><tr><td>
						<font color="#000000">
						<strong>Esto puede ocasionarse por acciones ejecutadas por el usuario como:</strong><br>
						<font color="#808080">
						<li>Cerrar de manera voluntaria su sesi&oacute;n</li>
						<li>Dejar de usar el sistema durante un tiempo prolongado</li>
						<li>Tener abiertas varias ventanas del sistema al mismo tiempo en secciones restringidas por el administrador</li>
						<li>Su usuario o contrase&ntilde;a son inv&aacute;lidos para realizar alguna operaci&oacute;n</li>
						<li>Navegar utilizando enlaces o botones diferentes a los permitidos</li>
						<font color="#000000">
						<br><strong>Tambi&eacute;n por configuraciones o acciones de su equipo como:</strong><br>
						<font color="#808080">
						<li>Su navegador no est&aacute; soportando cookies</li>
						<li>Se ha lipiado la cach&eacute; cookies o sesiones del navegador mientras se usaba el sistema</li>
						<font color="#000000">
						<br><strong>Tambi&eacute;n por configuraciones del sistema como:</strong><br>
						<font color="#808080">
						<li>Haber finalizado un proceso de instalaci&oacute;n de la plataforma que requiere un reinicio de sesi&oacute;n</li>
						<li>La llave de paso de su usuario no corresponde a la llave solicitada por este sistema</li>
						<li>Las credenciales para firmar un registro de operaci&oacute;n no son v&aacute;lidas</li>
						</font>
					</td></tr></table>
					<br>
				</td>
				<td>
					<img src="img/caduca.gif"  width="88" height="116"  border=0 alt="">&nbsp;
				</td>
			</tr></table>
			<form name="Again" method="POST"><input type="Hidden" name="accion" value="">
			<input type="image" src="img/ingresa.gif"></form>
			';
		@session_destroy();
		cerrar_ventana();
		echo '</div>';
	}
?>



