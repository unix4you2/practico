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
		Title: WS_API
		Ubicacion *[core/ws_api.php]*.  Archivo con las funciones para llamado por medio de WebServices
		
		El consumo de los web services requiere el envio de los siguientes parametros minimos a la raiz de Practico en cada llamado:
		
		* PCO_WSOn=1: Siempre iniciado en 1 indica a Practico que debe activar el modo de WebServices
		* PCO_WSKey: La llave generada para consumir los WebServices, la llave de paso de instalacion es incluida por defecto
		* PCO_WSId: El identificador unico del metodo o funcion de webservices a llamar
		* OTROS: Parametros adicionales requeridos por la funcion pueden ser enviados por URL o metodo POST al llamar el WebService.

		Ejemplo:  www.sudominio.com/practico/?PCO_WSOn=1&PCO_WSKey=AFSX345DF&PCO_WSSecret=ASDEWRTEAS&PCO_WSId=verificar_credenciales
		
		Recomendacion:  La generacion de avisos de tipo Notice, Warning, Error o similares de PHP puede ocasionar la emision
		de valores previos a la respuesta del WebService, se recomienda tener el modo de depuracion desactivado o verificar que los
		parametros y funciones utilizadas por cada webservice generen una salida limpia en caso de tener la depuracion activada.


https://www.phpclasses.org/browse/package/7700/download/zip.html
	*/


/* ################################################################## */
/* ################################################################## */
/*
	Function: verificar_credenciales
	Realiza proceso de verificacion de credenciales para un inicio de sesion

	Variables de entrada:

		uid - Obligatorio: Login utilizado por el usuario
		clave - Obligatorio: Clave del usuario sin cifrar

	Salida:
		Archivo XML que contiene la propiedad de aceptacion en cero o uno (0,1) dependiendo de si las credenciales son o no validas.
		Complemento del archivo XML con datos generales del usuario como login, nombre, descripcion, nivel, correo y fecha de ultimo acceso

	Ver tambien:
		<Iniciar_login> | <PCO_CambiarContrasena>
*/
if (@$PCO_WSId=="verificar_credenciales") 
	{
		$uid=PCO_FiltrarCadenaSQL(@$uid);
		$clave=PCO_FiltrarCadenaSQL(@$clave);
		$salida_xml="";
		$ok_login_verifica='0';
		$error_parametros=0;		

		// Verifica parametros minimos para trabajar
		if ($uid=="" || $clave=="")
			$error_parametros=1;
		
		//Verifica MOTOR autenticacion interna
		if (!$error_parametros && ($Auth_TipoMotor=="practico" || PCO_EsAdministrador($uid)))
			{
				$ClaveEnMD5=hash("md5", $clave);
				$registro=PCO_EjecutarSQL("SELECT $ListaCamposSinID_usuario FROM ".$TablasCore."usuario WHERE estado=1 AND login=? AND clave=? ","$uid$_SeparadorCampos_$ClaveEnMD5")->fetch();
				if ($registro["login"]!="")
					$ok_login_verifica='1';
			}

		//Verifica MOTOR autenticacion por LDAP
		if (!$error_parametros && ($Auth_TipoMotor=="ldap" && !PCO_EsAdministrador($uid)))
			{
				$DepuracionLDAP=0; //Activar para depuracion durante autenticaciones LDAP
                $auth_ldap_dc="";
				$auth_ldap_dc_trozos=explode(".",$Auth_LDAPDominio);
				for ($i = 0; $i < count($auth_ldap_dc_trozos) ; $i++)
					$auth_ldap_dc.=",dc=".$auth_ldap_dc_trozos[$i];
				$auth_ldap_cadena = 'uid='.$uid.',ou='.$Auth_LDAPOU.$auth_ldap_dc;
				// Conexion a LDAP
				$auth_ldap_conexion = ldap_connect( $Auth_LDAPServidor, $Auth_LDAPPuerto );
				//if no coneccion  or echo ("No se puede conectar a LDAP");
				ldap_set_option($auth_ldap_conexion, LDAP_OPT_REFERRALS, 0); //ActiveDirectory
                ldap_set_option($auth_ldap_conexion, LDAP_OPT_PROTOCOL_VERSION, 3); //ActiveDirectory
				//Verifica si se debe preencriptar la clave
				if ($Auth_TipoEncripcion!="plano")
					$clave=hash($Auth_TipoEncripcion, $clave);
				// match de usuario y password
				if (  ldap_bind( $auth_ldap_conexion, $auth_ldap_cadena, $clave )  )
					$ok_login_verifica='1';
                else
                    PCO_Mensaje($MULTILANG_Error.': '.$MULTILANG_AuthLDAP,$MULTILANG_ErrorConnLDAP, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
				// Si logra el acceso por LDAP consulta datos del usuario sobre Practico para llenar el XML pero
				// Si el usuario no existe se devolvera el valor de aceptacion solamente y el resto vacios
				$registro=PCO_EjecutarSQL("SELECT $ListaCamposSinID_usuario FROM ".$TablasCore."usuario WHERE login=? ","$uid")->fetch();
				if ($DepuracionLDAP)
                    echo "<script language='JavaScript'> alert('$auth_ldap_cadena'); </script>";
			}

		//Verifica MOTOR autenticacion federado
		if (!$error_parametros && ($Auth_TipoMotor=="federado" && !PCO_EsAdministrador($uid)))
			{
				//Busca parametros de configuracion para el motor federado
				$Param_MotorFederado=PCO_EjecutarSQL("SELECT $ListaCamposSinID_parametros FROM ".$TablasCore."parametros ")->fetch();
				
				//Crea la nueva conexion al motor de autenticacion remoto segun los parametros encontrados
				$PCO_ConexionFederada=PCO_NuevaConexionBD($Param_MotorFederado["federado_motor"],$Param_MotorFederado["federado_puerto"],$Param_MotorFederado["federado_basedatos"],$Param_MotorFederado["federado_servidor"],$Param_MotorFederado["federado_usuario"],$Param_MotorFederado["federado_clave"]);
				
				//Aplica la encripcion usada por el motoro federado al campo de clave antes de compararlo frente a la BD
				if ($Param_MotorFederado["federado_encripcion"]=="plano")
					$ClaveEnMD5=$clave;
				else
					$ClaveEnMD5=hash($Param_MotorFederado["federado_encripcion"], $clave);

				//Ejecuta el Query sobre la conexion federada
				$registro=PCO_EjecutarSQL("SELECT ".$Param_MotorFederado["federado_campousuario"]." as login, ".$Param_MotorFederado["federado_campousuario"]." as nombre, 5 as nivel FROM ".$Param_MotorFederado["federado_tabla"]." WHERE ".$Param_MotorFederado["federado_campousuario"]."=? AND ".$Param_MotorFederado["federado_campoclave"]."=? ","$uid$_SeparadorCampos_$ClaveEnMD5",$PCO_ConexionFederada)->fetch();
				if ($registro["login"]!="")
					{
						$ok_login_verifica='1';
						//Genera las credenciales en caso que no existan
						oauth_crear_usuario("PCOFederado",$registro["login"],$registro["login"],"",1);
					}
			}

		// Inicia el XML de salida basico solamente con el estado de aceptacion
		$salida_xml .= "<?xml version=\"1.0\" encoding=\"utf-8\" ?>
<credenciales>
	<credencial>
		<aceptacion>$ok_login_verifica</aceptacion>";
		// Agrega al XML informacion complementaria cuando el estado de aceptacion es 1//// y ademas el motor interno es practico
		if ($ok_login_verifica=='1')
			$salida_xml .= "
		<login>".$registro["login"]."</login>
		<nombre>".$registro["nombre"]."</nombre>
		<descripcion>".$registro["descripcion"]."</descripcion>
		<nivel>".$registro["nivel"]."</nivel>
		<correo>".$registro["correo"]."</correo>
		<ultimo_acceso>".$registro["ultimo_acceso"]."</ultimo_acceso>";
		// Finaliza el archivo XML
		$salida_xml .= "
	</credencial>
</credenciales>";
		// Devuelve los resultados
		@ob_clean(); //Limpia salida antes de llamar los WS
		echo $salida_xml;
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: oauth_crear_usuario
	Agrega usuarios de manera automatica cuando son autenticados por OAuth

	Ver tambien:
		<PCO_AutenticacionOauth> | <ejecutar_login_oauth>
*/
	function oauth_crear_usuario($OAuth_servicio,$login_chk='',$nombre_chk='',$correo_chk='',$interno_chk=0,$plantilla_permisos_chk='')
		{
			global $TablasCore,$LlaveDePaso,$PCO_FechaOperacion,$ListaCamposSinID_usuario;
			// Inserta datos del usuario
			$clavemd5=MD5(PCO_TextoAleatorio(20));
			$pasomd5=MD5($LlaveDePaso);
			$descripcion="Auth:$OAuth_servicio";
			//Agrega el registro de usuario si aun no existe
			if (!PCO_ExisteValor($TablasCore."usuario","login",$login_chk))
				{
					@PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."usuario (login,clave,nombre,estado,correo,ultimo_acceso,llave_paso,usuario_interno,plantilla_permisos,descripcion) VALUES ('$login_chk','$clavemd5','$nombre_chk',1,'$correo_chk','$PCO_FechaOperacion','$pasomd5','$interno_chk','$plantilla_permisos_chk','$descripcion')");
					PCO_Auditar("OAuth:Agregado usuario $login_chk para ".$OAuth_servicio);
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: ejecutar_login_oauth
	Recibe los parametros necesarios para hacer el registro de un usuario en la plataforma durante su ingreso cuando se usa oauth
	
	Variables de entrada:

		accion - Accion a ser ejectudada, de la que se desea buscar permiso heredado por otra

	Salida:
		Variables de sesion registradas
		Redireccion del usuario al menu
*/
	function ejecutar_login_oauth($user,$OAuth_servicio)
		{
			global $APIGoogle_Template,$APIFacebook_Template,$APIDropbox_Template;
			global $TablasCore,$uid,$ListaCamposSinID_usuario,$ListaCamposSinID_parametros,$resultado_webservice,$ListaCamposSinID_parametros,$ListaCamposSinID_auditoria,$PCO_DireccionAuditoria,$PCO_HoraOperacion,$PCO_FechaOperacion,$ArchivoCORE;

			// Si el modo depuracion esta activo muestra arreglo user devuelto por el proveedor
			global $ModoDepuracion;
			if ($ModoDepuracion)
				{
					echo '<h1>'.$OAuth_servicio.' Login OK!</h1><hr>';
					echo '<pre>', HtmlSpecialChars(print_r($user, 1)), '</pre><hr>';
					die("Modo de depuracion activo. Debe apagarlo para usar OAuth");
				}

			// Define las variables del usuario a buscar/crear segun el servicio OAuth utilizado
			if ($OAuth_servicio=='Google' || $OAuth_servicio=='LinkedIn' || $OAuth_servicio=='Instagram' || $OAuth_servicio=='Microsoft' || $OAuth_servicio=='Flickr' || $OAuth_servicio=='Twitter' || $OAuth_servicio=='Foursquare' || $OAuth_servicio=='XING' || $OAuth_servicio=='Salesforce' || $OAuth_servicio=='Bitbucket' || $OAuth_servicio=='Yahoo' || $OAuth_servicio=='Box' || $OAuth_servicio=='Disqus' || $OAuth_servicio=='Eventful' || $OAuth_servicio=='SurveyMonkey' || $OAuth_servicio=='RightSignature' || $OAuth_servicio=='Fitbit' || $OAuth_servicio=='ScoopIt' || $OAuth_servicio=='Tumblr' || $OAuth_servicio=='StockTwits' || $OAuth_servicio=='VK' || $OAuth_servicio=='Withings')
				{
					// Otros disponibles: id,verified_email (0|1),given_name,family_name,link (G+),picture (link),gender (male|female),locale (es|en...)
					$login_chk=$user->email;
					$nombre_chk=$user->name;
					$correo_chk=$user->email;
					$plantilla_origen_permisos=$APIGoogle_Template;
				}
			if ($OAuth_servicio=='Facebook')
				{
					// Otros disponibles: id,name,first_name,middle_name,last_name, link, username, education(arreglo:school[id,name],type),gender (male|female),email, timezone,locale (es_LA...),verified,updated_time
					$login_chk=$user->id;
					$nombre_chk=$user->name;
					$correo_chk=$user->email;
					$plantilla_origen_permisos=$APIFacebook_Template;
				}
			if ($OAuth_servicio=='Dropbox')
				{
					// Otros disponibles: referral_link,display_name,uid (numerico),country (ej:CO),quota_info Arreglo: [datastores,shared,quota,normal],email
					$login_chk=$user->uid;
					$nombre_chk=$user->display_name;
					$correo_chk=$user->email;
					$plantilla_origen_permisos=$APIDropbox_Template;
				}

			// Busca datos del usuario Practico, segun tipo de servicio OAuth para tener configuraciones de permisos y parametros propios de la herramienta
			$consulta_busqueda_usuario_oauth="SELECT $ListaCamposSinID_usuario FROM ".$TablasCore."usuario WHERE login='$login_chk' AND descripcion LIKE '%Auth:$OAuth_servicio%' ";
			$registro=PCO_EjecutarSQL($consulta_busqueda_usuario_oauth)->fetch();

			// Agrega el usuario cuando es primer login desde el servicio
			if ($registro["login"]=="")
				{
					oauth_crear_usuario($OAuth_servicio,$login_chk,$nombre_chk,$correo_chk,0,$plantilla_origen_permisos);
					// Actualiza el registro desde nueva consulta
					$resultado_usuario=PCO_EjecutarSQL($consulta_busqueda_usuario_oauth);
					$registro = $resultado_usuario->fetch();
				}

			//Copia permisos de la plantilla si aplica
			if ($registro["plantilla_permisos"]!="")
				{
					PCO_Auditar("Carga permisos a su perfil desde plantilla $plantilla_origen_permisos",$login_chk);
					PCO_CopiarPermisos($plantilla_origen_permisos,$login_chk);
					PCO_CopiarInformes($plantilla_origen_permisos,$login_chk);
				}

			// Se buscan datos de la aplicacion
			$consulta_parametros=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_parametros." FROM ".$TablasCore."parametros");
			$registro_parametros = $consulta_parametros->fetch();

			// Actualiza las variables de sesion con el registro
			$PCOSESS_SesionAbierta=1;
			// Actualiza booleana de ingreso
			$clave_correcta=1;
			// Registro de variables en la sesion
			@session_start();
			if (!isset($_SESSION["PCOSESS_LoginUsuario"])) $_SESSION["PCOSESS_LoginUsuario"]=(string)$registro["login"];
			if (!isset($_SESSION["username"])) $_SESSION["username"]=(string)$registro["login"]; //Usada para el modulo de chat
			if (!isset($_SESSION["Nombre_usuario"])) $_SESSION["Nombre_usuario"]=(string)$registro["nombre"];
			if (!isset($_SESSION["Descripcion_usuario"])) $_SESSION["Descripcion_usuario"]=(string)$registro["descripcion"];
			if (!isset($_SESSION["Nivel_usuario"])) $_SESSION["Nivel_usuario"]=(string)$registro["nivel"];
			if (!isset($_SESSION["Correo_usuario"])) $_SESSION["Correo_usuario"]=(string)$registro["correo"];
			if (!isset($_SESSION["Clave_usuario"])) $_SESSION["Clave_usuario"]=$registro["clave"];
			if (!isset($_SESSION["LlaveDePasoUsuario"])) $_SESSION["LlaveDePasoUsuario"]=$registro["llave_paso"];
			if (!isset($_SESSION["PCOSESS_SesionAbierta"])) $_SESSION["PCOSESS_SesionAbierta"]=$PCOSESS_SesionAbierta;
			if (!isset($_SESSION["clave_correcta"])) $_SESSION["clave_correcta"]=$clave_correcta;
			if (!isset($_SESSION["Nombre_Empresa_Corto"])) $_SESSION["Nombre_Empresa_Corto"]=$registro_parametros["nombre_empresa_corto"];
			if (!isset($_SESSION["Nombre_Aplicacion"])) $_SESSION["Nombre_Aplicacion"]=$registro_parametros["nombre_aplicacion"];
			if (!isset($_SESSION["Version_Aplicacion"])) $_SESSION["Version_Aplicacion"]=$registro_parametros["version"];

			// Lleva a auditoria con query manual por la falta de $PCOSESS_LoginUsuario
			PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."auditoria (".$ListaCamposSinID_auditoria.") VALUES ('".$registro["login"]."','Ingresa al sistema desde $PCO_DireccionAuditoria','$PCO_FechaOperacion','$PCO_HoraOperacion')");
			PCO_Auditar("Ingresa al sistema desde $PCO_DireccionAuditoria",$_SESSION["PCOSESS_LoginUsuario"]);
			// Actualiza fecha del ultimo ingreso para el usuario
			PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."usuario SET ultimo_acceso=? WHERE login='".$registro["login"]."'","$PCO_FechaOperacion");

			// Redirecciona al menu
			header("Location: index.php");
			exit();
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: error_oauth
	Presenta mensajes de error durante la autenticacion

	Ver tambien:
		<PCO_AutenticacionOauth> | <aprobar_oauth>
*/
function error_oauth($client,$OAuth_servicio)
	{
		global $MULTILANG_WSErrTitulo;
		PCO_Mensaje($MULTILANG_WSErrTitulo,'OAuth '.$OAuth_servicio.' error: '.HtmlSpecialChars($client->error), '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
    }


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_AutenticacionOauth
	Realiza proceso de autenticacion hacia servidores OAuth 1.0 y 2.0

	Variables de entrada:
		* OAuth_solicitado:  Indica el tipo de servicio OAuth que debe ser llamado.
		* Permite por ahora los valores (22): Google, Facebook, LinkedIn, Instagram, Dropbox, Microsoft (Live), Flickr, Twitter, Foursquare, XING, Salesforce, Bitbucket, Yahoo, Box, Disqus, Eventful, SurveyMonkey, RightSignature, Fitbit, ScoopIt, Tumblr, StockTwits

	Salida:
		Redireccion del usuario a la pagina de login del proveedor de autenticacion , quien a su vez redireccionara al usuario segun el resultado

	Ver tambien:
		<Iniciar_login>
		
		
*/
if (@$PCO_WSId=="PCO_AutenticacionOauth") 
	{
		require('inc/http/http.php');			// Incluye funciones del cliente HTTP para conexiones desde PHP
		require('inc/oauth/oauth_client.php');	// Incluye las librerias del modulo OAuth 1.0 y 2.0

		// Inicia la conexion correspondiente
		$client = new oauth_client_class;

		// Define el servicio a llamar segun el recibido
		$OAuth_servicio=$OAuthSrv;
		
		// Google
		if ($OAuth_servicio=='Google')	
			{
				$OAuth_URIRedireccion=$APIGoogle_RedirectUri;
				$OAuth_IDCliente=$APIGoogle_ClientId;
				$OAuth_SecretoCliente=$APIGoogle_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Google http://code.google.com/apis/console y cree un nuevo ID de cliente, Secreto y URI de redireccion.";
				$OAuth_Alcance='https://www.googleapis.com/auth/userinfo.email '.'https://www.googleapis.com/auth/userinfo.profile';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
				$OAuth_Offline=false;
			}

		// Facebook
		if ($OAuth_servicio=='Facebook')	
			{
				$OAuth_URIRedireccion=$APIFacebook_RedirectUri;
				$OAuth_IDCliente=$APIFacebook_ClientId;
				$OAuth_SecretoCliente=$APIFacebook_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Facebook https://developers.facebook.com/apps y cree un nuevo ID de cliente, Secreto y URI de redireccion.";
				$OAuth_Alcance='email';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// LinkedIn
		if ($OAuth_servicio=='LinkedIn')	
			{
				$OAuth_URIRedireccion=$APILinkedIn_RedirectUri;
				$OAuth_IDCliente=$APILinkedIn_ClientId;
				$OAuth_SecretoCliente=$APILinkedIn_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de LinkedIn https://www.linkedin.com/secure/developer?newapp= y cree un nuevo ID de cliente, Secreto y URI de redireccion.";
				$OAuth_Alcance='r_fullprofile r_emailaddress';
				$OAuth_Depuracion=1;
				$OAuth_DepuracionHttp=1;
			}

		// Instagram
		if ($OAuth_servicio=='Instagram')	
			{
				$OAuth_URIRedireccion=$APIInstagram_RedirectUri;
				$OAuth_IDCliente=$APIInstagram_ClientId;
				$OAuth_SecretoCliente=$APIInstagram_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Instagram http://instagram.com/developer/register/ y cree un nuevo ID de cliente, Secreto y URI de redireccion.";
				$OAuth_Alcance='basic';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Dropbox
		if ($OAuth_servicio=='Dropbox')	
			{
				$OAuth_URIRedireccion=$APIDropbox_RedirectUri;
				$OAuth_IDCliente=$APIDropbox_ClientId;
				$OAuth_SecretoCliente=$APIDropbox_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Dropbox https://www.dropbox.com/developers/apps y cree un nuevo ID de cliente, Secreto y URI de redireccion.";
				$OAuth_Depuracion=1;
				$OAuth_DepuracionHttp=1;
			}

		// Microsoft
		if ($OAuth_servicio=='Microsoft')	
			{
				$OAuth_URIRedireccion=$APIMicrosoft_RedirectUri;
				$OAuth_IDCliente=$APIMicrosoft_ClientId;
				$OAuth_SecretoCliente=$APIMicrosoft_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Microsoft https://manage.dev.live.com/AddApplication.aspx y cree un nuevo ID de cliente, Secreto y URI de redireccion.";
				$OAuth_Alcance='wl.basic wl.emails';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Flickr
		if ($OAuth_servicio=='Flickr')	
			{
				$OAuth_URIRedireccion=$APIFlickr_RedirectUri;
				$OAuth_IDCliente=$APIFlickr_ClientId;
				$OAuth_SecretoCliente=$APIFlickr_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Flickr http://www.flickr.com/services/apps/create/ y cree un nuevo ID de cliente, Secreto y URI de redireccion.";
				$OAuth_Alcance='read'; // 'read', 'write' or 'delete'
				$OAuth_Depuracion=0;
				$OAuth_DepuracionHttp=1;
			}

		// Twitter
		if ($OAuth_servicio=='Twitter')	
			{
				$OAuth_URIRedireccion=$APITwitter_RedirectUri;
				$OAuth_IDCliente=$APITwitter_ClientId;
				$OAuth_SecretoCliente=$APITwitter_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Twitter https://dev.twitter.com/apps/new y cree un nuevo ID de cliente, Secreto y URI de redireccion.";
				$OAuth_Depuracion=1;
				$OAuth_DepuracionHttp=1;
			}

		// Foursquare
		if ($OAuth_servicio=='Foursquare')	
			{
				$OAuth_URIRedireccion=$APIFoursquare_RedirectUri;
				$OAuth_IDCliente=$APIFoursquare_ClientId;
				$OAuth_SecretoCliente=$APIFoursquare_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Foursquare https://foursquare.com/developers/apps y cree un nuevo ID de cliente, Secreto y URI de redireccion.";
				$OAuth_Alcance='';
				$OAuth_Depuracion=true;
				$OAuth_DepuracionHttp=true;
			}

		// XING
		if ($OAuth_servicio=='XING')	
			{
				$OAuth_URIRedireccion=$APIXING_RedirectUri;
				$OAuth_IDCliente=$APIXING_ClientId;
				$OAuth_SecretoCliente=$APIXING_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de XING https://dev.xing.com/applications y cree un nuevo ID de cliente, Secreto y URI de redireccion.";
				$OAuth_Depuracion=0;
				$OAuth_DepuracionHttp=1;
			}

		// Salesforce
		if ($OAuth_servicio=='Salesforce')	
			{
				$OAuth_URIRedireccion=$APISalesforce_RedirectUri;
				$OAuth_IDCliente=$APISalesforce_ClientId;
				$OAuth_SecretoCliente=$APISalesforce_ClientSecret;
				$OAuth_Mensaje="Vaya Salesforce, ingrese a la cuenta.  Clic en Setup, Clic en Develop, Clic en Remote Access y cree una nueva aplicacion para obtener el ID, Secreto y URI.";
				$OAuth_Alcance='';
				$OAuth_Depuracion=true;
				$OAuth_DepuracionHttp=true;
			}

		// Bitbucket
		if ($OAuth_servicio=='Bitbucket')	
			{
				$OAuth_URIRedireccion=$APIBitbucket_RedirectUri;
				$OAuth_IDCliente=$APIBitbucket_ClientId;
				$OAuth_SecretoCliente=$APIBitbucket_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Bitbucket https://bitbucket.org/account/ clic en Integrated Applications, luego Add Consumer para obtener el ID, Secreto y URI";
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Yahoo
		if ($OAuth_servicio=='Yahoo')	
			{
				$OAuth_URIRedireccion=$APIYahoo_RedirectUri;
				$OAuth_IDCliente=$APIYahoo_ClientId;
				$OAuth_SecretoCliente=$APIYahoo_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Yahoo https://developer.apps.yahoo.com/projects/ y cree un proyecto para obtener el ID, Secreto y URI";
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Box
		if ($OAuth_servicio=='Box')	
			{
				$OAuth_URIRedireccion=$APIBox_RedirectUri;
				$OAuth_IDCliente=$APIBox_ClientId;
				$OAuth_SecretoCliente=$APIBox_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Box https://www.box.com/developers/services y cree una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=true;
				$OAuth_DepuracionHttp=true;
				$OAuth_Offline=false;
			}

		// Disqus
		if ($OAuth_servicio=='Disqus')	
			{
				$OAuth_URIRedireccion=$APIDisqus_RedirectUri;
				$OAuth_IDCliente=$APIDisqus_ClientId;
				$OAuth_SecretoCliente=$APIDisqus_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Disqus http://disqus.com/api/applications/ y en la pestana API Access obtenga el ID, Secreto y URI";
				$OAuth_Alcance='read,write';
				$OAuth_Depuracion=true;
				$OAuth_DepuracionHttp=true;
			}

		// SurveyMonkey
		if ($OAuth_servicio=='SurveyMonkey')	
			{
				$OAuth_URIRedireccion=$APISurveyMonkey_RedirectUri;
				$OAuth_IDCliente=$APISurveyMonkey_ClientId;
				$OAuth_SecretoCliente=$APISurveyMonkey_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de SurveyMonkey https://developer.surveymonkey.com/apps/register y en la pestana API Access obtenga el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Eventful
		if ($OAuth_servicio=='Eventful')
			{
				$OAuth_URIRedireccion=$APIEventful_RedirectUri;
				$OAuth_IDCliente=$APIEventful_ClientId;
				$OAuth_SecretoCliente=$APIEventful_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Eventful http://api.eventful.com/keys/new y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Depuracion=1;
				$OAuth_DepuracionHttp=1;
				$application_key = ''; // Llave de la aplicacion
				$account = ''; // Cuenta usada, ej: mlemos
			}

		// Fitbit
		if ($OAuth_servicio=='Fitbit')
			{
				$OAuth_URIRedireccion=$APIFitbit_RedirectUri;
				$OAuth_IDCliente=$APIFitbit_ClientId;
				$OAuth_SecretoCliente=$APIFitbit_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Fitbit https://dev.fitbit.com/apps/new y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Depuracion=1;
				$OAuth_DepuracionHttp=1;
			}

		// RightSignature
		if ($OAuth_servicio=='RightSignature')
			{
				$OAuth_URIRedireccion=$APIRightSignature_RedirectUri;
				$OAuth_IDCliente=$APIRightSignature_ClientId;
				$OAuth_SecretoCliente=$APIRightSignature_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de RightSignature https://rightsignature.com/oauth_clients/new y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Depuracion=0;
				$OAuth_DepuracionHttp=1;
			}

		// Scoop.it
		if ($OAuth_servicio=='ScoopIt')	
			{
				$OAuth_URIRedireccion=$APIScoopit_RedirectUri;
				$OAuth_IDCliente=$APIScoopit_ClientId;
				$OAuth_SecretoCliente=$APIScoopit_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Scoop.it https://www.scoopit.com/developers/apps y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Depuracion=0;
				$OAuth_DepuracionHttp=1;
			}

		// Tumblr
		if ($OAuth_servicio=='Tumblr')	
			{
				$OAuth_URIRedireccion=$APITumblr_RedirectUri;
				$OAuth_IDCliente=$APITumblr_ClientId;
				$OAuth_SecretoCliente=$APITumblr_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Tumblr http://www.tumblr.com/oauth/apps y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Depuracion=1;
				$OAuth_DepuracionHttp=1;
			}

		// StockTwits
		if ($OAuth_servicio=='StockTwits')	
			{
				$OAuth_URIRedireccion=$APIStockTwits_RedirectUri;
				$OAuth_IDCliente=$APIStockTwits_ClientId;
				$OAuth_SecretoCliente=$APIStockTwits_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de StockTwits http://stocktwits.com/developers/apps/new y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='read,watch_lists,publish_messages,publish_watch_lists,direct_messages,follow_users,follow_stocks';
				$OAuth_Depuracion=true;
				$OAuth_DepuracionHttp=true;
			}

		// VK
		if ($OAuth_servicio=='VK')	
			{
				$OAuth_URIRedireccion=$APIVK_RedirectUri;
				$OAuth_IDCliente=$APIVK_ClientId;
				$OAuth_SecretoCliente=$APIVK_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de VK http://vk.com/editapp?act=create y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Withings
		if ($OAuth_servicio=='Withings')	
			{
				$OAuth_URIRedireccion=$APIWithings_RedirectUri;
				$OAuth_IDCliente=$APIWithings_ClientId;
				$OAuth_SecretoCliente=$APIWithings_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Withings https://oauth.withings.com/en/partner/add y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// 37Signals
		if ($OAuth_servicio=='37Signals')	
			{
				$OAuth_URIRedireccion=$API37Signals_RedirectUri;
				$OAuth_IDCliente=$API37Signals_ClientId;
				$OAuth_SecretoCliente=$API37Signals_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de 37Signals https://integrate.37signals.com/apps/new y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Amazon
		if ($OAuth_servicio=='Amazon')	
			{
				$OAuth_URIRedireccion=$APIAmazon_RedirectUri;
				$OAuth_IDCliente=$APIAmazon_ClientId;
				$OAuth_SecretoCliente=$APIAmazon_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Amazon https://sellercentral.amazon.com/gp/homepage.html y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='profile';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// AOL
		if ($OAuth_servicio=='AOL')	
			{
				$OAuth_URIRedireccion=$APIAOL_RedirectUri;
				$OAuth_IDCliente=$APIAOL_ClientId;
				$OAuth_SecretoCliente=$APIAOL_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de AOL y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Bitly
		if ($OAuth_servicio=='Bitly')	
			{
				$OAuth_URIRedireccion=$APIBitly_RedirectUri;
				$OAuth_IDCliente=$APIBitly_ClientId;
				$OAuth_SecretoCliente=$APIBitly_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Bitly https://bitly.com/a/oauth_apps y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Buffer
		if ($OAuth_servicio=='Buffer')	
			{
				$OAuth_URIRedireccion=$APIBuffer_RedirectUri;
				$OAuth_IDCliente=$APIBuffer_ClientId;
				$OAuth_SecretoCliente=$APIBuffer_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Buffer https://bufferapp.com/developers/apps/create y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Copy
		if ($OAuth_servicio=='Copy')	
			{
				$OAuth_URIRedireccion=$APICopy_RedirectUri;
				$OAuth_IDCliente=$APICopy_ClientId;
				$OAuth_SecretoCliente=$APICopy_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Copy https://developers.copy.com/applications/create y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Dailymotion
		if ($OAuth_servicio=='Dailymotion')	
			{
				$OAuth_URIRedireccion=$APIDailymotion_RedirectUri;
				$OAuth_IDCliente=$APIDailymotion_ClientId;
				$OAuth_SecretoCliente=$APIDailymotion_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Dailymotion http://www.dailymotion.com/profile/developer/new y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='read userinfo email';
				$OAuth_Depuracion=true;
				$OAuth_DepuracionHttp=true;
			}

		// Discogs
		if ($OAuth_servicio=='Discogs')	
			{
				$OAuth_URIRedireccion=$APIDiscogs_RedirectUri;
				$OAuth_IDCliente=$APIDiscogs_ClientId;
				$OAuth_SecretoCliente=$APIDiscogs_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Discogs http://www.discogs.com/applications/edit y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Etsy
		if ($OAuth_servicio=='Etsy')	
			{
				$OAuth_URIRedireccion=$APIEtsy_RedirectUri;
				$OAuth_IDCliente=$APIEtsy_ClientId;
				$OAuth_SecretoCliente=$APIEtsy_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Etsy https://www.etsy.com/developers/register y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='email_r';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Garmin
		if ($OAuth_servicio=='Garmin')	
			{
				$OAuth_URIRedireccion=$APIGarmin_RedirectUri;
				$OAuth_IDCliente=$APIGarmin_ClientId;
				$OAuth_SecretoCliente=$APIGarmin_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Garmin y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Garmin2Legged
		if ($OAuth_servicio=='Garmin2Legged')	
			{
				$OAuth_URIRedireccion=$APIGarmin2Legged_RedirectUri;
				$OAuth_IDCliente=$APIGarmin2Legged_ClientId;
				$OAuth_SecretoCliente=$APIGarmin2Legged_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Garmin2Legged y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// iHealth
		if ($OAuth_servicio=='iHealth')	
			{
				$OAuth_URIRedireccion=$APIiHealth_RedirectUri;
				$OAuth_IDCliente=$APIiHealth_ClientId;
				$OAuth_SecretoCliente=$APIiHealth_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de iHealth http://developer.ihealthlabs.com/developerappaddpage.htm y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// imgur
		if ($OAuth_servicio=='imgur')	
			{
				$OAuth_URIRedireccion=$APIimgur_RedirectUri;
				$OAuth_IDCliente=$APIimgur_ClientId;
				$OAuth_SecretoCliente=$APIimgur_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de imgur https://api.imgur.com/oauth2/addclient y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Infusionsoft
		if ($OAuth_servicio=='Infusionsoft')	
			{
				$OAuth_URIRedireccion=$APIInfusionsoft_RedirectUri;
				$OAuth_IDCliente=$APIInfusionsoft_ClientId;
				$OAuth_SecretoCliente=$APIInfusionsoft_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Infusionsoft https://keys.developer.infusionsoft.com/apps/register y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Intuit
		if ($OAuth_servicio=='Intuit')	
			{
				$OAuth_URIRedireccion=$APIIntuit_RedirectUri;
				$OAuth_IDCliente=$APIIntuit_ClientId;
				$OAuth_SecretoCliente=$APIIntuit_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Intuit https://developer.intuit.com/ y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Jawbone
		if ($OAuth_servicio=='Jawbone')	
			{
				$OAuth_URIRedireccion=$APIJawbone_RedirectUri;
				$OAuth_IDCliente=$APIJawbone_ClientId;
				$OAuth_SecretoCliente=$APIJawbone_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Jawbone https://jawbone.com/up/developer/account/ y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Livecoding
		if ($OAuth_servicio=='Livecoding')	
			{
				$OAuth_URIRedireccion=$APILivecoding_RedirectUri;
				$OAuth_IDCliente=$APILivecoding_ClientId;
				$OAuth_SecretoCliente=$APILivecoding_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Livecoding https://www.livecoding.tv/developer/applications/register/ y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// MailChimp
		if ($OAuth_servicio=='MailChimp')	
			{
				$OAuth_URIRedireccion=$APIMailChimp_RedirectUri;
				$OAuth_IDCliente=$APIMailChimp_ClientId;
				$OAuth_SecretoCliente=$APIMailChimp_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de MailChimp https://admin.mailchimp.com/account/api/ y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Mavenlink
		if ($OAuth_servicio=='Mavenlink')	
			{
				$OAuth_URIRedireccion=$APIMavenlink_RedirectUri;
				$OAuth_IDCliente=$APIMavenlink_ClientId;
				$OAuth_SecretoCliente=$APIMavenlink_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Mavenlink https://app.mavenlink.com/oauth/applications/new y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Meetup
		if ($OAuth_servicio=='Meetup')	
			{
				$OAuth_URIRedireccion=$APIMeetup_RedirectUri;
				$OAuth_IDCliente=$APIMeetup_ClientId;
				$OAuth_SecretoCliente=$APIMeetup_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Meetup https://secure.meetup.com/meetup_api/oauth_consumers/ y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// MicrosoftOpenIDConnect
		if ($OAuth_servicio=='MicrosoftOpenIDConnect')	
			{
				$OAuth_URIRedireccion=$APIMicrosoftOpenIDConnect_RedirectUri;
				$OAuth_IDCliente=$APIMicrosoftOpenIDConnect_ClientId;
				$OAuth_SecretoCliente=$APIMicrosoftOpenIDConnect_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de MicrosoftOpenIDConnect https://apps.dev.microsoft.com/ y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='wl.basic wl.emails';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Misfit
		if ($OAuth_servicio=='Misfit')	
			{
				$OAuth_URIRedireccion=$APIMisfit_RedirectUri;
				$OAuth_IDCliente=$APIMisfit_ClientId;
				$OAuth_SecretoCliente=$APIMisfit_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Misfit https://developers.misfit.com/apps y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// oDesk
		if ($OAuth_servicio=='oDesk')	
			{
				$OAuth_URIRedireccion=$APIoDesk_RedirectUri;
				$OAuth_IDCliente=$APIoDesk_ClientId;
				$OAuth_SecretoCliente=$APIoDesk_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de oDesk https://www.odesk.com/services/api/apply y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Odnoklassniki
		if ($OAuth_servicio=='Odnoklassniki')	
			{
				$OAuth_URIRedireccion=$APIOdnoklassniki_RedirectUri;
				$OAuth_IDCliente=$APIOdnoklassniki_ClientId;
				$OAuth_SecretoCliente=$APIOdnoklassniki_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Odnoklassniki https://ok.ru/dk?st.cmd=appEditBasic&st._aid=Apps_Info_MyDev_AddApp&st.vpl.mini=false y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Paypal
		if ($OAuth_servicio=='Paypal')	
			{
				$OAuth_URIRedireccion=$APIPaypal_RedirectUri;
				$OAuth_IDCliente=$APIPaypal_ClientId;
				$OAuth_SecretoCliente=$APIPaypal_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Paypal https://developer.paypal.com/webapps/developer/applications/myapps y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Pinterest
		if ($OAuth_servicio=='Pinterest')	
			{
				$OAuth_URIRedireccion=$APIPinterest_RedirectUri;
				$OAuth_IDCliente=$APIPinterest_ClientId;
				$OAuth_SecretoCliente=$APIPinterest_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Pinterest https://developers.pinterest.com/apps/ y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Rdio
		if ($OAuth_servicio=='Rdio')	
			{
				$OAuth_URIRedireccion=$APIRdio_RedirectUri;
				$OAuth_IDCliente=$APIRdio_ClientId;
				$OAuth_SecretoCliente=$APIRdio_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Rdio http://rdio.mashery.com/apps/register y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=true;
				$OAuth_DepuracionHttp=true;
			}

		// Reddit
		if ($OAuth_servicio=='Reddit')	
			{
				$OAuth_URIRedireccion=$APIReddit_RedirectUri;
				$OAuth_IDCliente=$APIReddit_ClientId;
				$OAuth_SecretoCliente=$APIReddit_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Reddit https://ssl.reddit.com/prefs/apps y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='identity';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// RunKeeper
		if ($OAuth_servicio=='RunKeeper')	
			{
				$OAuth_URIRedireccion=$APIRunKeeper_RedirectUri;
				$OAuth_IDCliente=$APIRunKeeper_ClientId;
				$OAuth_SecretoCliente=$APIRunKeeper_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de RunKeeper http://runkeeper.com/partner/applications/register y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Uber
		if ($OAuth_servicio=='Uber')	
			{
				$OAuth_URIRedireccion=$APIUber_RedirectUri;
				$OAuth_IDCliente=$APIUber_ClientId;
				$OAuth_SecretoCliente=$APIUber_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Uber https://developer.uber.com/dashboard/create y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// TeamViewer
		if ($OAuth_servicio=='TeamViewer')	
			{
				$OAuth_URIRedireccion=$APITeamViewer_RedirectUri;
				$OAuth_IDCliente=$APITeamViewer_ClientId;
				$OAuth_SecretoCliente=$APITeamViewer_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de TeamViewer https://login.teamviewer.com/nav/api y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Vimeo
		if ($OAuth_servicio=='Vimeo')	
			{
				$OAuth_URIRedireccion=$APIVimeo_RedirectUri;
				$OAuth_IDCliente=$APIVimeo_ClientId;
				$OAuth_SecretoCliente=$APIVimeo_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Vimeo https://developer.vimeo.com/apps/new y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=true;
				$OAuth_DepuracionHttp=true;
			}

		// Wordpress
		if ($OAuth_servicio=='Wordpress')	
			{
				$OAuth_URIRedireccion=$APIWordpress_RedirectUri;
				$OAuth_IDCliente=$APIWordpress_ClientId;
				$OAuth_SecretoCliente=$APIWordpress_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Wordpress https://developer.wordpress.com/apps/new/ y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=true;
				$OAuth_DepuracionHttp=true;
			}

		// Xero
		if ($OAuth_servicio=='Xero')	
			{
				$OAuth_URIRedireccion=$APIXero_RedirectUri;
				$OAuth_IDCliente=$APIXero_ClientId;
				$OAuth_SecretoCliente=$APIXero_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Xero https://api.xero.com/Application/Add y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Yammer
		if ($OAuth_servicio=='Yammer')	
			{
				$OAuth_URIRedireccion=$APIYammer_RedirectUri;
				$OAuth_IDCliente=$APIYammer_ClientId;
				$OAuth_SecretoCliente=$APIYammer_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Yammer https://www.yammer.com/client_applications y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}

		// Yandex
		if ($OAuth_servicio=='Yandex')	
			{
				$OAuth_URIRedireccion=$APIYandex_RedirectUri;
				$OAuth_IDCliente=$APIYandex_ClientId;
				$OAuth_SecretoCliente=$APIYandex_ClientSecret;
				$OAuth_Mensaje="Vaya a APIs de Yandex https://oauth.yandex.com/client/new y agregue una aplicacion para obtener el ID, Secreto y URI";
				$OAuth_Alcance='';
				$OAuth_Depuracion=false;
				$OAuth_DepuracionHttp=true;
			}


		// Define parametros del cliente segun el servicio detectado
		$client->server = $OAuth_servicio;
		// Establecerlo solo si se necesita llamar al API sin el usuario presente y el token puede expirar
		if (@$OAuth_Offline==true)
			$client->offline = $OAuth_Offline;
		$client->debug = $OAuth_Depuracion;
		$client->debug_http = $OAuth_DepuracionHttp;
		$client->redirect_uri = $OAuth_URIRedireccion;
		$client->client_id = $OAuth_IDCliente; $application_line = __LINE__;
		$client->client_secret = $OAuth_SecretoCliente;

		// Si no se dan los parametros basicos presenta error
		if(strlen($client->client_id) == 0 || strlen($client->client_secret) == 0)
			{
				PCO_Mensaje($MULTILANG_WSErrTitulo,'<b>'.$OAuth_servicio.'</b>: '.$OAuth_Mensaje, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
                die();
			}

		// Define permisos de la API (si es necesario)
		if ($OAuth_Alcance!="")
			$client->scope = $OAuth_Alcance;

		if(($success = $client->Initialize()))
			{
				if(($success = $client->Process()))
				{
					// INICIO DEL PROCESAMIENTO POR SERVICIO
					// Google
					if ($OAuth_servicio=='Google')
						{
							if(strlen($client->authorization_error))
							{
								$client->error = $client->authorization_error;
								$success = false;
							}
							elseif(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'https://www.googleapis.com/oauth2/v1/userinfo',
									'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// Facebook
					if ($OAuth_servicio=='Facebook')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'https://graph.facebook.com/me', 
									'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// LinkedIn
					if ($OAuth_servicio=='LinkedIn')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://api.linkedin.com/v1/people/~', 
									'GET', array(
										'format'=>'json'
									), array('FailOnAccessError'=>true), $user);
							}
						}

					// Instagram
					if ($OAuth_servicio=='Instagram')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'https://api.instagram.com/v1/users/self/', 
									'GET', array(), array('FailOnAccessError'=>true), $user);
								if(!$success)
								{
									$client->ResetAccessToken();
								}
							}
						}

					// Dropbox
					if ($OAuth_servicio=='Dropbox')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'https://api.dropbox.com/1/account/info', 
									'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// Microsoft
					if ($OAuth_servicio=='Microsoft')
						{
							if(strlen($client->authorization_error))
							{
								$client->error = $client->authorization_error;
								$success = false;
							}
							elseif(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'https://apis.live.net/v5.0/me',
									'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// Flickr
					if ($OAuth_servicio=='Flickr')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://api.flickr.com/services/rest/', 
									'GET', array(
										'method'=>'flickr.test.login',
										'format'=>'json',
										'nojsoncallback'=>'1'
									), array('FailOnAccessError'=>true), $user);
							}
						}

					// Twitter
					if ($OAuth_servicio=='Twitter')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'https://api.twitter.com/1.1/account/verify_credentials.json', 
									'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// Foursquare
					if ($OAuth_servicio=='Foursquare')
						{
							if(strlen($client->authorization_error))
							{
								$client->error = $client->authorization_error;
								$success = false;
							}
							elseif(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'https://api.foursquare.com/v2/users/self?v=20131013',
									'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// XING
					if ($OAuth_servicio=='XING')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'https://api.xing.com/v1/users/me', 
									'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// Salesforce
					if ($OAuth_servicio=='Salesforce')
						{
							if(strlen($client->authorization_error))
							{
								$client->error = $client->authorization_error;
								$success = false;
							}
							elseif(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									$client->access_token_response['id'],
									'GET', array(), array(
										'FailOnAccessError'=>true,
										'FollowRedirection'=>true
									), $user);
							}
						}

					// Bitbucket
					if ($OAuth_servicio=='Bitbucket')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'https://api.bitbucket.org/1.0/user', 
									'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// Yahoo
					if ($OAuth_servicio=='Yahoo')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://query.yahooapis.com/v1/yql', 
									'GET', array(
										'q'=>'select * from social.profile where guid=me',
										'format'=>'json'
									), array('FailOnAccessError'=>true), $user);
							}
						}

					// Box
					if ($OAuth_servicio=='Box')
						{
							if(strlen($client->authorization_error))
							{
								$client->error = $client->authorization_error;
								$success = false;
							}
							elseif(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'https://api.box.com/2.0/users/me',
									'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// Disqus
					if ($OAuth_servicio=='Disqus')
						{
							if(strlen($client->authorization_error))
							{
								$client->error = $client->authorization_error;
								$success = false;
							}
							elseif(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'https://disqus.com/api/3.0/users/details.json?api_key='.UrlEncode($client->client_id),
									'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// SurveyMonkey
					if ($OAuth_servicio=='SurveyMonkey')
						{
							if(strlen($client->authorization_error))
							{
								$client->error = $client->authorization_error;
								$success = false;
							}
							elseif(strlen($client->access_token))
							{
								$parameters = new stdClass;
								$success = $client->CallAPI(
									'https://api.surveymonkey.net/v2/surveys/get_survey_list?api_key='.$client->api_key,
									'POST', $parameters, array('FailOnAccessError'=>true, 'RequestContentType'=>'application/json'), $surveys);
							}
						}

					// Eventful
					if ($OAuth_servicio=='Eventful')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://api.evdb.com/rest/users/get', 
									'GET', array(
										'id'=>$account,
										'app_key'=>$application_key
									), array('FailOnAccessError'=>true), $user);
							}
						}

					// Fitbit
					if ($OAuth_servicio=='Fitbit')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'https://api.fitbit.com/1/user/-/profile.json', 
									'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// RightSignature
					if ($OAuth_servicio=='RightSignature')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'https://rightsignature.com/api/users/user_details.json', 
									'GET', array(), array(
										'FailOnAccessError'=>true,
										'ResponseContentType'=>'application/json'
									), $user);
							}
						}

					// Scoop.it
					if ($OAuth_servicio=='Scoop.it')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://www.scoop.it/api/1/profile', 
									'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}
		
					// Tumblr
					if ($OAuth_servicio=='Tumblr')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://api.tumblr.com/v2/user/info', 
									'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// StockTwits
					if ($OAuth_servicio=='StockTwits')
						{
							if(strlen($client->authorization_error))
							{
								$client->error = $client->authorization_error;
								$success = false;
							}
							elseif(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'https://api.stocktwits.com/api/2/account/verify.json',
									'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// VK
					if ($OAuth_servicio=='VK')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'https://api.vk.com/method/users.get', 
									'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// Withings
					if ($OAuth_servicio=='Withings')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://wbsapi.withings.net/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// 37Signals
					if ($OAuth_servicio=='37Signals')
						{
							if(strlen($client->access_token))
							{
                				$success = $client->CallAPI(
                					'https://launchpad.37signals.com/authorization.json',
                					'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}
					
					// Amazon
					if ($OAuth_servicio=='Amazon')
						{
							if(strlen($client->access_token))
							{
                				$success = $client->CallAPI(
                					'https://api.amazon.com/user/profile',
                					'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// AOL
					if ($OAuth_servicio=='AOL')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// Bitly
					if ($OAuth_servicio=='Bitly')
						{
							if(strlen($client->access_token))
							{
                				$success = $client->CallAPI(
                					'https://api-ssl.bitly.com/v3/user/info',
                					'GET', array(), array(
                						'FailOnAccessError'=>true,
                						'FollowRedirection'=>true
                					), $user);
							}
						}

					// Buffer
					if ($OAuth_servicio=='Buffer')
						{
							if(strlen($client->access_token))
							{
                				$success = $client->CallAPI(
                					'https://api.bufferapp.com/1/user.json', 
                					'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// Copy
					if ($OAuth_servicio=='Copy')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// Dailymotion
					if ($OAuth_servicio=='Dailymotion')
						{
							if(strlen($client->access_token))
							{
                				$success = $client->CallAPI(
                					'https://api.dailymotion.com/user/me?fields=fullname,email', 
                					'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// Discogs
					if ($OAuth_servicio=='Discogs')
						{
							if(strlen($client->access_token))
							{
                				$success = $client->CallAPI(
                					'http://api.discogs.com/oauth/identity', 
                					'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// Etsy
					if ($OAuth_servicio=='Etsy')
						{
							if(strlen($client->access_token))
							{
                				$success = $client->CallAPI(
                					'https://openapi.etsy.com/v2/users/__SELF__', 
                					'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// Garmin
					if ($OAuth_servicio=='Garmin')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// Garmin2Legged
					if ($OAuth_servicio=='Garmin2Legged')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// iHealth
					if ($OAuth_servicio=='iHealth')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// imgur
					if ($OAuth_servicio=='imgur')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// Infusionsoft
					if ($OAuth_servicio=='Infusionsoft')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// Intuit
					if ($OAuth_servicio=='Intuit')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// Jawbone
					if ($OAuth_servicio=='Jawbone')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// Livecoding
					if ($OAuth_servicio=='Livecoding')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// MailChimp
					if ($OAuth_servicio=='MailChimp')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// Mavenlink
					if ($OAuth_servicio=='Mavenlink')
						{
							if(strlen($client->access_token))
							{
                				$success = $client->CallAPI(
                					'https://api.mavenlink.com/api/v1/users/me.json',
                					'GET', array(), array(
                						'FailOnAccessError'=>true,
                						'FollowRedirection'=>true
                					), $user);
							}
						}

					// Meetup
					if ($OAuth_servicio=='Meetup')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// MicrosoftOpenIDConnect
					if ($OAuth_servicio=='MicrosoftOpenIDConnect')
						{
							if(strlen($client->access_token))
							{
                				$success = $client->CallAPI(
                					'https://apis.live.net/v5.0/me',
                					'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// Misfit
					if ($OAuth_servicio=='Misfit')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// oDesk
					if ($OAuth_servicio=='oDesk')
						{
							if(strlen($client->access_token))
							{
                				$success = $client->CallAPI(
                					'https://www.odesk.com/api/auth/v1/info.json',
                					'GET', array(), array(
                						'FailOnAccessError'=>true,
                						'FollowRedirection'=>true
                					), $user);
							}
						}

					// Odnoklassniki
					if ($OAuth_servicio=='Odnoklassniki')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// Paypal
					if ($OAuth_servicio=='Paypal')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// Pinterest
					if ($OAuth_servicio=='Pinterest')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// Rdio
					if ($OAuth_servicio=='Rdio')
						{
							if(strlen($client->access_token))
							{
                				$success = $client->CallAPI(
                					'http://api.rdio.com/1/', 
                					'POST', array('method'=>'currentUser'), array('FailOnAccessError'=>true), $user);
							}
						}

					// Reddit
					if ($OAuth_servicio=='Reddit')
						{
							if(strlen($client->access_token))
							{
                				$success = $client->CallAPI(
                					'https://oauth.reddit.com/api/v1/me.json',
                					'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// RunKeeper
					if ($OAuth_servicio=='RunKeeper')
						{
							if(strlen($client->access_token))
							{
                				$success = $client->CallAPI(
                					'https://api.runkeeper.com/profile/',
                					'GET', array(), array(
                						'FailOnAccessError'=>true,
                						'FollowRedirection'=>true
                					), $user);
							}
						}

					// Uber
					if ($OAuth_servicio=='Uber')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// TeamViewer
					if ($OAuth_servicio=='TeamViewer')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// Vimeo
					if ($OAuth_servicio=='Vimeo')
						{
							if(strlen($client->access_token))
							{
                				$success = $client->CallAPI(
                					'https://api.vimeo.com/me/?format=json', 
                					'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// Wordpress
					if ($OAuth_servicio=='Wordpress')
						{
							if(strlen($client->access_token))
							{
                				$success = $client->CallAPI(
                					'https://public-api.wordpress.com/rest/v1/me', 
                					'GET', array(), array('FailOnAccessError'=>true), $user);
							}
						}

					// Xero
					if ($OAuth_servicio=='Xero')
						{
							if(strlen($client->access_token))
							{
                				$success = $client->CallAPI(
                					'https://api.xero.com/api.xro/2.0/Users', 
                					'GET', array(), array('FailOnAccessError'=>true, 'DecodeXMLResponse'=>'simplexml'), $user);
							}
						}

					// Yammer
					if ($OAuth_servicio=='Yammer')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// Yandex
					if ($OAuth_servicio=='Yandex')
						{
							if(strlen($client->access_token))
							{
								$success = $client->CallAPI(
									'http://servicio.desconocido/user?action=getbyuserid&userid=0', 
									'GET', array(), array('FailOnAccessError'=>true, 'ResponseContentType'=>'application/json'), $user);
							}
						}

					// FIN DEL PROCESAMIENTO POR SERVICIO
				}
				$success = $client->Finalize($success);
			}

		if($client->exit)
			exit;

		// Operaciones adicionales para algunos servicios
		// Yahoo o LinkedIn
		if ($OAuth_servicio=='Yahoo' || $OAuth_servicio=='LinkedIn')
			{
				if(strlen($client->authorization_error))
				{
					$client->error = $client->authorization_error;
					$success = false;
				}
			}

		// Twitter
		if ($OAuth_servicio=='Twitter')
			{
				$client->ResetAccessToken();
			}

		// Presenta resultados de la autenticacion
		if($success)
			ejecutar_login_oauth($user,$OAuth_servicio);
		else
			error_oauth($client,$OAuth_servicio);
	}