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
/* ################################################################## */
/* ################################################################## */
/*
	Function: Iniciar_login
	Realiza proceso de verificacion de los datos suministrados para el inicio de sesion

	Variables de entrada:

		uid - Valor del campo clave digitado por el usuario
		clave - Nombre del formulario sobre el que se actualiza el valor del campo seguridad.
		captcha - Valor del captcha diligenciado por el usuario
		captcha_temporal - Valor del captcha calculado por el sistema

	Salida:
		Aceptacion o rechazo del inicio de sesion con la redireccion al lugar correspondiente

	Ver tambien:
		<seguridad_clave> | <cambiar_clave>
*/
	if ($accion=="Iniciar_login") 
		{
			//Filtra cadenas recibidas para evitar sql injection
			$uid=filtrar_cadena_sql($uid);
			$clave=filtrar_cadena_sql($clave);
			$captcha=filtrar_cadena_sql($captcha);

			//Verifica el captcha ingresado por el usuario
			$ok_captcha=1;
			if ($captcha_temporal!=$captcha)
				{
					$ok_captcha=0;
					// Lleva a auditoria con query manual por la falta de $Login_Usuario
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria (".$ListaCamposSinID_auditoria.") VALUES ('$uid','Elimina sesiones activas al intentar acceso con CAPTCHA incorrecto desde $direccion_auditoria','$fecha_operacion','$hora_operacion')");
				}
			session_destroy();

			$ok_login=0;			
			//Verifica autenticacion interna
			if ($Auth_TipoMotor=="practico" || $uid=="admin")
				{
					$ClaveEnMD5=hash("md5", $clave);
					$resultado_usuario=ejecutar_sql("SELECT login FROM ".$TablasCore."usuario WHERE estado=1 AND login='$uid' AND clave='$ClaveEnMD5' ");
					$registro = $resultado_usuario->fetch();
					if ($registro["login"]!="")
						$ok_login=1;
				}
				
			//Verifica autenticacion por LDAP
			if ($Auth_TipoMotor=="ldap" && $uid!="admin")
				{
					$auth_ldap_dc="";
					$auth_ldap_dc_trozos=explode(".",$Auth_LDAPDominio);
					for ($i = 0; $i < count($auth_ldap_dc_trozos) ; $i++)
						$auth_ldap_dc.=",dc=".$auth_ldap_dc_trozos[$i];
					$auth_ldap_cadena = 'uid='.$uid.',ou='.$Auth_LDAPOU.$auth_ldap_dc;
					// Conexion a LDAP
					$auth_ldap_conexion = ldap_connect( $Auth_LDAPServidor, $Auth_LDAPPuerto );
					ldap_set_option($auth_ldap_conexion, LDAP_OPT_PROTOCOL_VERSION, 3);
					//Verifica si se debe preencriptar la clave
					if ($Auth_TipoEncripcion!="plano")
						$clave=hash($Auth_TipoEncripcion, $clave);
					// match de usuario y password
					if (  ldap_bind( $auth_ldap_conexion, $auth_ldap_cadena, $clave )  )
						$ok_login=1;
				}

			$clave_correcta=0;
			if ($clave!="" && $ok_login==1 && $ok_captcha==1)
				  {
						// Busca datos del usuario Practico, sin importar metodo de autenticacion para tener configuraciones de permisos y parametros propios de la herramienta
						$resultado_usuario=ejecutar_sql("SELECT login, nombre, clave, descripcion, nivel, correo, llave_paso FROM ".$TablasCore."usuario WHERE login='$uid' ");
						$registro = $resultado_usuario->fetch();					
						
						// Se buscan datos de la aplicacion
						$consulta_parametros=ejecutar_sql("SELECT id,".$ListaCamposSinID_parametros." FROM ".$TablasCore."parametros");
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

						// Lleva a auditoria con query manual por la falta de $Login_Usuario
						ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria (".$ListaCamposSinID_auditoria.") VALUES ('$uid','Ingresa al sistema desde $direccion_auditoria','$fecha_operacion','$hora_operacion')");
						// Actualiza fecha del ultimo ingreso para el usuario
						ejecutar_sql_unaria("UPDATE ".$TablasCore."usuario SET ultimo_acceso='$fecha_operacion' WHERE login='$uid'");
				  }

			// Si la clave es incorrecta muestra de nuevo la ventana de ingreso
			if (!$clave_correcta)
				{
					mensaje($MULTILANG_ErrorTitAuth,$MULTILANG_ErrorDesAuth,'60%','../img/tango_dialog-error.png','TextosEscritorio');
					ventana_login();
					@session_destroy();
				}
			else
				{
					echo '<form name="Acceso" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="accion" value="Ver_menu"></form><script type="" language="JavaScript">	document.Acceso.submit();  </script>';
				}
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: Terminar_sesion
	Lleva una auditoria sobre el cierre de sesion de cada usuario y redirecciona a la funcion <Mensaje_cierre_sesion>

	Ver tambien:
		<Mensaje_cierre_sesion>
*/
	if ($accion=="Terminar_sesion")
	{
		auditar("Cierra sesion desde $direccion_auditoria");
		session_destroy();
		echo '<form name="Redireccion" method="POST"><input type="Hidden" name="accion" value="Mensaje_cierre_sesion"></form><script type="" language="JavaScript">	document.Redireccion.submit();  </script>';
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: Mensaje_cierre_sesion
	Destruye todas las variables de sesion creadas para el cliente del lado del servidor y presenta un mensaje de cierre

	Salida:
		Mensaje informando al usuario sobre el cierre de su sesion

	Ver tambien:
		<Terminar_sesion>
*/
	if ($accion=="Mensaje_cierre_sesion")
	{
		@session_destroy();
		echo '<br><br><div align="center">';
		abrir_ventana($MULTILANG_Atencion,'FFFFFF','');
			echo '
			<br><div align="center" class="TextosVentana"><strong><font size="3">'.$MULTILANG_SesionCerrada.'</font></strong>
			<table width="100%"><tr>
				<td>

					</div><br>
					<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center" class="TextosVentana"><tr><td>
						<font color="#000000">
						<strong>'.$MULTILANG_TituloCierre.':</strong><br>
						<font color="#808080">
							'.$MULTILANG_ExplicacionCierre.'
						</font>
					</td></tr></table>
					<br>
				</td>
				<td>
					<img src="img/caduca.gif"  width="88" height="116"  border=0 alt="">&nbsp;
				</td>
			</tr></table>
			<form name="Again" method="POST">
				<input type="Hidden" name="accion" value="">
				<input type="Submit"  class="Botones" value=" '.$MULTILANG_Ingresar.' >>>" >
			</form>
			';
		@session_destroy();
		cerrar_ventana();
		echo '</div>';
	}
?>
