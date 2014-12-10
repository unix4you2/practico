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

		uid - Login utilizado por el usuario
		clave - Clave del usuario sin cifrar
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
			$uid_orig=$uid;
			$clave_orig=$clave;
			$captcha_orig=$captcha;
			$uid=filtrar_cadena_sql($uid);
			$clave=filtrar_cadena_sql($clave);
			$captcha=filtrar_cadena_sql($captcha);

			//Verifica el captcha ingresado por el usuario
			$ok_captcha=1;
			if (@$captcha_temporal!=$captcha)
				{
					$ok_captcha=0;
					// Lleva auditoria con query manual por la falta de $Login_Usuario y solamente si no hay un posible sqlinjection
					if ($uid_orig==$uid && $clave_orig==$clave)
						auditar("Elimina sesiones activas al intentar acceso con CAPTCHA incorrecto desde $direccion_auditoria",$uid);
				}
			session_destroy();

			$ok_login=0;
			// Inicia la autenticacion como una solicitud de webservices interna
			// Determina si la conexion actual de Practico esta encriptada
			if(empty($_SERVER["HTTPS"]))
				$protocolo_webservice="http://";
			else
				$protocolo_webservice="https://";
			// Si se tiene un protocolo preferido sobreescribe lo auto-detectado
			if (@$Auth_ProtoTransporte=="http" || @$Auth_ProtoTransporte=="https")
				$protocolo_webservice=$Auth_ProtoTransporte."://";
			// Construye la URL para solicitar el webservice.  La URL se debe poder resolver por el servidor web correctamente, ya sea por dominio o IP (interna o publica).  Ver /etc/hosts si algo.
			$prefijo_webservice=$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['PHP_SELF'];
			$webservice_validacion = $protocolo_webservice.$prefijo_webservice."?WSOn=1&WSKey=".$LlaveDePaso."&WSSecret=".$LlaveDePaso."&WSId=verificar_credenciales&uid=".$uid."&clave=".$clave;
			// Carga el contenido en una variable para validar la conexion
			$contenido_url = @cargar_url($webservice_validacion);

			// Valida si se logro cargar o no el contenido
			if ($contenido_url!="")
				{
					// Usa SimpleXML Directamente para interpretar respuesta
					$resultado_webservice = simplexml_load_string($contenido_url);
					// Analiza la respuesta recibida en el XML
					if($resultado_webservice->credencial[0]->aceptacion==1)
						$ok_login=1;
				}
			else
				{
					limpiar_entradas();
					mensaje($MULTILANG_LoginNoWSTit,$MULTILANG_LoginNoWSDes."<br>Test URL=<a href='".$webservice_validacion."' target=_BLANK>Auth WebService</a> (entradas filtradas)",'','icono_error.png','TextosEscritorio');
				}

			$clave_correcta=0;
			if ($clave!="" && $ok_login==1 && $ok_captcha==1)
				  {
						// Busca datos del usuario Practico, sin importar metodo de autenticacion para tener configuraciones de permisos y parametros propios de la herramienta
						$resultado_usuario=ejecutar_sql("SELECT $ListaCamposSinID_usuario FROM ".$TablasCore."usuario WHERE login='$uid'");
						$registro = $resultado_usuario->fetch();
						
						// Se buscan datos de la aplicacion
						$consulta_parametros=ejecutar_sql("SELECT id,".$ListaCamposSinID_parametros." FROM ".$TablasCore."parametros");
						$registro_parametros = $consulta_parametros->fetch();

						// Actualiza las variables de sesion con el registro
						$Sesion_abierta=1;
						// Actualiza booleana de ingreso
						$clave_correcta=1;
						// Registro de variables en la sesion
						// Antes con depreciada: session_register('Login_usuario');
						@session_start();
						if (!isset($_SESSION["Login_usuario"])) $_SESSION["Login_usuario"]=(string)$resultado_webservice->credencial[0]->login;
						if (!isset($_SESSION["username"])) $_SESSION["username"]=(string)$registro["login"]; //Usada para el modulo de chat
						if (!isset($_SESSION["Nombre_usuario"])) $_SESSION["Nombre_usuario"]=(string)$resultado_webservice->credencial[0]->nombre;
						if (!isset($_SESSION["Descripcion_usuario"])) $_SESSION["Descripcion_usuario"]=(string)$resultado_webservice->credencial[0]->descripcion;
						if (!isset($_SESSION["Nivel_usuario"])) $_SESSION["Nivel_usuario"]=(string)$resultado_webservice->credencial[0]->nivel;
						if (!isset($_SESSION["Correo_usuario"])) $_SESSION["Correo_usuario"]=(string)$resultado_webservice->credencial[0]->correo;
						if (!isset($_SESSION["Clave_usuario"])) $_SESSION["Clave_usuario"]=$registro["clave"];
						if (!isset($_SESSION["LlaveDePasoUsuario"])) $_SESSION["LlaveDePasoUsuario"]=$registro["llave_paso"];
						if (!isset($_SESSION["Sesion_abierta"])) $_SESSION["Sesion_abierta"]=$Sesion_abierta;
						if (!isset($_SESSION["clave_correcta"])) $_SESSION["clave_correcta"]=$clave_correcta;
						if (!isset($_SESSION["Nombre_Empresa_Corto"])) $_SESSION["Nombre_Empresa_Corto"]=$registro_parametros["nombre_empresa_corto"];
						if (!isset($_SESSION["Nombre_Aplicacion"])) $_SESSION["Nombre_Aplicacion"]=$registro_parametros["nombre_aplicacion"];
						if (!isset($_SESSION["Version_Aplicacion"])) $_SESSION["Version_Aplicacion"]=$registro_parametros["version"];

						// Lleva a auditoria con query manual por la falta de $Login_Usuario
						auditar("Ingresa al sistema desde $direccion_auditoria",$uid);
						// Actualiza fecha del ultimo ingreso para el usuario
						ejecutar_sql_unaria("UPDATE ".$TablasCore."usuario SET ultimo_acceso=? WHERE login=? ","$fecha_operacion$_SeparadorCampos_$uid");
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
		abrir_ventana($MULTILANG_Atencion, 'panel-primary');
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
