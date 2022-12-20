<?php
/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2012-2022
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
	 This program is free software: you can redistribute it and/or modify
	 it under the terms of the GNU General Public License as published by
	 the Free Software Foundation, either version 3 of the License, or
	 (at your option) any later version.

	 This program is distributed in the hope that it will be useful,
	 but WITHOUT ANY WARRANTY; without even the implied warranty of
	 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 GNU General Public License for more details.

	 You should have received a copy of the GNU General Public License
	 along with this program.  If not, see <http://www.gnu.org/licenses/>
	 
	            --- TRADUCCION NO OFICIAL DE LA LICENCIA ---

     Esta es una traducción no oficial de la Licencia Pública General de
     GNU al español. No ha sido publicada por la Free Software Foundation
     y no establece los términos jurídicos de distribución del software 
     publicado bajo la GPL 3 de GNU, solo la GPL de GNU original en inglés
     lo hace. De todos modos, esperamos que esta traducción ayude a los
     hispanohablantes a comprender mejor la GPL de GNU:
	 
     Este programa es software libre: puede redistribuirlo y/o modificarlo
     bajo los términos de la Licencia General Pública de GNU publicada por
     la Free Software Foundation, ya sea la versión 3 de la Licencia, o 
     (a su elección) cualquier versión posterior.

     Este programa se distribuye con la esperanza de que sea útil pero SIN
     NINGUNA GARANTÍA; incluso sin la garantía implícita de MERCANTIBILIDAD
     o CALIFICADA PARA UN PROPÓSITO EN PARTICULAR. Vea la Licencia General
     Pública de GNU para más detalles.

     Usted ha debido de recibir una copia de la Licencia General Pública de
     GNU junto con este programa. Si no, vea <http://www.gnu.org/licenses/>
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
		<seguridad_clave> | <PCO_CambiarContrasena>
*/
	if ($PCO_Accion=="Iniciar_login") 
		{
		    //Convierte las variables desde los campos aleatorios a los valores usados comunmente para el login
		    $uid=${$NombreCampoLogin};
		    $clave=${$NombreCampoClave};

			//Filtra cadenas recibidas para evitar sql injection
			$uid_orig=$uid;
			$clave_orig=$clave;
			$captcha_orig=$captcha;
			$uid=PCO_FiltrarCadenaSQL($uid);
			$clave=PCO_FiltrarCadenaSQL($clave);
			$captcha=PCO_FiltrarCadenaSQL($captcha);

			//Verifica el captcha ingresado por el usuario
			$ok_captcha=1;
			if (@$captcha_temporal!=$captcha)
				{
					$ok_captcha=0;
					// Lleva auditoria con query manual por la falta de $Login_Usuario y solamente si no hay un posible sqlinjection
					if ($uid_orig==$uid && $clave_orig==$clave)
						PCO_Auditar("Elimina sesiones activas al intentar acceso con CAPTCHA incorrecto desde $PCO_DireccionAuditoria",$uid);
				}

			$ok_login=0;
			$DetectadaRedPermitida=0;
			$ComplementoMensajeRedNoPermitida="";
			// Inicia la autenticacion frente a tablas de sistema
			if ($Auth_MotorWS!=1)
    		    {
    				$ClaveEnMD5=hash("md5", $clave);
    				$RegistroUsuario=PCO_EjecutarSQL("SELECT $ListaCamposSinID_usuario FROM ".$TablasCore."usuario WHERE estado=1 AND login='$uid' AND clave='$ClaveEnMD5' ")->fetch();
    				//Si encuentra el usuario activa bandera y genera XML de datos correspondiente
    				if ($RegistroUsuario["login"]!="")
    				    {
    				        $ok_login=1;
    				        $RedesPermitidas=trim($RegistroUsuario["redes_permitidas"]);
    				        //Si el login esta bien valida ademas que las redes de acceso sean las permitidas.  Siempre y cuando tenga alguna definida y ademas no sea admin o desarrollador
    				        if ($RedesPermitidas=="" || PCO_EsAdministrador($uid))
    				            $DetectadaRedPermitida=1;
    				        else
    				            {
            				        $IP_Usuario=$_SERVER['REMOTE_ADDR'];
                				    //Descompone la red de acceso en partes para ser comparada con cada red, equipo o subred permitida
                				    $PartesIPOrigen=explode(".",$IP_Usuario);
                				    $RedesPermitidas=explode(";",$RedesPermitidas);
                				    $RedAnalizada=0;
                				    while($RedAnalizada < count($RedesPermitidas) && $DetectadaRedPermitida==0)
                				        {
                				            $PartesIPPermitida=explode(".",$RedesPermitidas[$RedAnalizada]);
                				            $Octeto0_OK=1;
                				            $Octeto1_OK=1;
                				            $Octeto2_OK=1;
                				            $Octeto3_OK=1;
                				            //Analiza cada octeto de la red
                				            if($PartesIPPermitida[0]!="*" && $PartesIPPermitida[0]!=$PartesIPOrigen[0] ) $Octeto0_OK=0;
                				            if($PartesIPPermitida[1]!="*" && $PartesIPPermitida[1]!=$PartesIPOrigen[1] ) $Octeto1_OK=0;
                				            if($PartesIPPermitida[2]!="*" && $PartesIPPermitida[2]!=$PartesIPOrigen[2] ) $Octeto2_OK=0;
                				            if($PartesIPPermitida[3]!="*" && $PartesIPPermitida[3]!=$PartesIPOrigen[3] ) $Octeto3_OK=0;
                
                                            //Valida si los octetos pasaron la prueba
                                            if ($Octeto0_OK==1 && $Octeto1_OK==1 && $Octeto2_OK==1 && $Octeto3_OK==1)
                                                $DetectadaRedPermitida=1;
                				            $RedAnalizada++;
                				        }    				                
    				            }
    				        
                            if($DetectadaRedPermitida==0)
                                {
                                    PCO_Auditar("Elimina sesiones activas al intentar acceso con RED no autorizada desde $IP_Usuario","$uid");
                                    $ComplementoMensajeRedNoPermitida="<li><b>Red o lugar de origen donde se encuentra el usuario NO autorizado</b>";
                                }
                            
                            if ($DetectadaRedPermitida==1)
                                {
                            		// Inicia el XML de salida basico solamente con el estado de aceptacion
                            		$salida_xml .= "<?xml version=\"1.0\" encoding=\"utf-8\" ?>
                                    <credenciales>
                                    	<credencial>
                                    		<aceptacion>1</aceptacion>
                                    		<login>".$RegistroUsuario["login"]."</login>
                                    		<nombre>".$RegistroUsuario["nombre"]."</nombre>
                                    		<descripcion>".$RegistroUsuario["descripcion"]."</descripcion>
                                    		<nivel>".$RegistroUsuario["nivel"]."</nivel>
                                    		<correo>".$RegistroUsuario["correo"]."</correo>
                                    		<ultimo_acceso>".$RegistroUsuario["ultimo_acceso"]."</ultimo_acceso>";
                                    		// Finaliza el archivo XML
                                    		$salida_xml .= "
                                    	</credencial>
                                    </credenciales>";
                                    $resultado_webservice = @simplexml_load_string($salida_xml);   
                                }
    				    }
    		    }

			// Inicia la autenticacion como una solicitud de webservices interna SI ESTA ACTIVADO EN LA CONFIGURACION
			if ($Auth_MotorWS==1)
    		    {
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
        			$webservice_validacion = $protocolo_webservice.$prefijo_webservice."?PCO_WSOn=1&PCO_WSKey=".$LlaveDePaso."&PCO_WSSecret=".$LlaveDePaso."&PCO_WSId=verificar_credenciales&uid=".$uid."&clave=".$clave;
        			// Carga el contenido en una variable para validar la conexion
        			$contenido_url = @PCO_CargarURL($webservice_validacion);
        			// Valida si se logro cargar o no el contenido
        			if ($contenido_url!="")
        				{
        					// Usa SimpleXML Directamente para interpretar respuesta
        					$resultado_webservice = @simplexml_load_string($contenido_url);
        					// Analiza la respuesta recibida en el XML
        					if(@$resultado_webservice->credencial[0]->aceptacion==1)
        						$ok_login=1;
        				}
        			else
        				{
        					PCO_LimpiarEntradas();
        					PCO_Mensaje($MULTILANG_LoginNoWSTit,$MULTILANG_LoginNoWSDes."<br>Test URL=<a href='".$webservice_validacion."' target=_BLANK>Auth WebService</a> (entradas filtradas)", '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
        				}
    		    }

			$clave_correcta=0;
			if ($clave!="" && $ok_login==1 && $ok_captcha==1 && $DetectadaRedPermitida==1)
				  {

						// Busca datos del usuario Practico, sin importar metodo de autenticacion para tener configuraciones de permisos y parametros propios de la herramienta
						$resultado_usuario=PCO_EjecutarSQL("SELECT $ListaCamposSinID_usuario FROM ".$TablasCore."usuario WHERE login='$uid' AND es_plantilla=0 ");
						$registro = $resultado_usuario->fetch();
						
						// Se buscan datos de la aplicacion
						$consulta_parametros=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_parametros." FROM ".$TablasCore."parametros");
						$registro_parametros = $consulta_parametros->fetch();

						// Actualiza las variables de sesion con el registro
						$PCOSESS_SesionAbierta=1;
						// Actualiza booleana de ingreso
						$clave_correcta=1;
						// Registro de variables en la sesion
						// Antes con depreciada: session_register('PCOSESS_LoginUsuario');
						@session_start();
						if (!isset($_SESSION["PCOSESS_LoginUsuario"])) $_SESSION["PCOSESS_LoginUsuario"]=(string)$resultado_webservice->credencial[0]->login;
						
						//Agrega variable de sesion para el modulo de chat.  Quita puntos, espacios y otros caracteres del usuario que generen errores en JS
						$NombreUsuarioChat = preg_replace("/[^a-zA-Z0-9]/", "_", $registro["login"] );
						
						//Ajusta variables segun preferencias del usuario (si aplica)
						if ($idioma_login!=$registro["idioma"]) $idioma_login=$registro["idioma"];
						
						//Ruta del avatar
						$ruta_avatar_usuario="";
						if ($registro["avatar"]!="") 
						    {
						        $partes_ruta_avatar=explode("|",$registro["avatar"]);
						        $ruta_avatar_usuario=$partes_ruta_avatar[0];
						    }
						
						if (!isset($_SESSION["username"])) $_SESSION["username"]=(string)$NombreUsuarioChat;
						if (!isset($_SESSION["PCOSESS_NombreUsuario"])) $_SESSION["PCOSESS_NombreUsuario"]=(string)$resultado_webservice->credencial[0]->nombre;
						if (!isset($_SESSION["Nombre_usuario"])) $_SESSION["Nombre_usuario"]=(string)$resultado_webservice->credencial[0]->nombre;
						if (!isset($_SESSION["Descripcion_usuario"])) $_SESSION["Descripcion_usuario"]=(string)$resultado_webservice->credencial[0]->descripcion;
						if (!isset($_SESSION["Nivel_usuario"])) $_SESSION["Nivel_usuario"]=(string)$resultado_webservice->credencial[0]->nivel;
						if (!isset($_SESSION["Correo_usuario"])) $_SESSION["Correo_usuario"]=(string)$resultado_webservice->credencial[0]->correo;
						if (!isset($_SESSION["Clave_usuario"])) $_SESSION["Clave_usuario"]=$registro["clave"];
						if (!isset($_SESSION["LlaveDePasoUsuario"])) $_SESSION["LlaveDePasoUsuario"]=$registro["llave_paso"];
						if (!isset($_SESSION["PCOSESS_SesionAbierta"])) $_SESSION["PCOSESS_SesionAbierta"]=$PCOSESS_SesionAbierta;
						if (!isset($_SESSION["clave_correcta"])) $_SESSION["clave_correcta"]=$clave_correcta;
						if (!isset($_SESSION["Nombre_Empresa_Corto"])) $_SESSION["Nombre_Empresa_Corto"]=$registro_parametros["nombre_empresa_corto"];
						if (!isset($_SESSION["Nombre_Aplicacion"])) $_SESSION["Nombre_Aplicacion"]=$registro_parametros["nombre_aplicacion"];
						if (!isset($_SESSION["Version_Aplicacion"])) $_SESSION["Version_Aplicacion"]=$registro_parametros["version"];
						if (!isset($_SESSION["PCOSESS_IdiomaUsuario"])) $_SESSION["PCOSESS_IdiomaUsuario"]=$idioma_login;
						if (!isset($_SESSION["PCOSESS_TransformacionPaleta"])) $_SESSION["PCOSESS_TransformacionPaleta"]=$registro["transformacion_colores"];
						if (!isset($_SESSION["PCOSESS_RutaAvatar"])) $_SESSION["PCOSESS_RutaAvatar"]=(string)$ruta_avatar_usuario;

						// Lleva a auditoria con query manual por la falta de $Login_Usuario
						PCO_Auditar("Ingresa al sistema desde $PCO_DireccionAuditoria",$uid);
						// Actualiza fecha del ultimo ingreso para el usuario
						PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."usuario SET ultimo_acceso=? WHERE login=? ","$PCO_FechaOperacion$_SeparadorCampos_$uid");

						//Copia permisos de la plantilla si aplica
						if ($registro["plantilla_permisos"]!="")
							{
								$plantilla_origen=$registro["plantilla_permisos"];
								PCO_Auditar("Carga permisos a su perfil desde plantilla $plantilla_origen",$uid);
								PCO_CopiarPermisos($plantilla_origen,$uid);
								PCO_CopiarInformes($plantilla_origen,$uid);
							}
				  }

			// Si la clave es incorrecta muestra de nuevo la ventana de ingreso
			if (!$clave_correcta)
				{
					PCO_Mensaje($MULTILANG_ErrorTitAuth,$MULTILANG_ErrorDesAuth.$ComplementoMensajeRedNoPermitida,'','fa fa-ban fa-4x text-danger','alert alert-danger');
					PCO_VentanaLogin();
				}
			else
				{
					echo '<form name="Acceso" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="PCO_Accion" value="PCO_VerMenu"></form><script type="" language="JavaScript">	document.Acceso.submit();  </script>';
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
	if ($PCO_Accion=="Terminar_sesion")
	{
		PCO_Auditar("Cierra sesion desde $PCO_DireccionAuditoria");
		session_destroy();
		
		//Si se trata de una sesion SAML finaliza tambien a esta
		if ($PCO_FinalizarSAML=="1")
	        echo "<script> window.location.replace('inc/php-saml/practico/?slo'); </script>";
	    else
    		echo '<form name="Redireccion" method="POST"><input type="Hidden" name="PCO_Accion" value="Mensaje_cierre_sesion"></form><script type="" language="JavaScript">	document.Redireccion.submit();  </script>';
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
	if ($PCO_Accion=="Mensaje_cierre_sesion")
	{
		PCO_AbrirVentana($MULTILANG_Atencion, 'panel-primary');
			echo '<strong><font size="3">'.$MULTILANG_SesionCerrada.'</font>
			<table class="table"><tr>
				<td class="texto-gris">
					'.$MULTILANG_TituloCierre.':<br>
					'.$MULTILANG_ExplicacionCierre.'
				</td>
				<td>
                    <i class="fa fa-chain-broken fa-5x texto-rojo texto-blink"></i>
				</td>
			</tr></table>
            <center>
			<form name="Again" method="POST">
				<input type="Hidden" name="PCO_Accion" value="">
                <a class="btn btn-info" href="javascript:document.Again.submit();"><i class="fa fa-refresh fa-spin"></i> '.$MULTILANG_Ingresar.'</a>
			</form></center>';
		@session_destroy();
		PCO_CerrarVentana();
	}