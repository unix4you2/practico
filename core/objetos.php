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
		Title: Modulo objetos
		Ubicacion *[/core/objetos.php]*.  Archivo de funciones relacionadas con las operaciones de objetos generados por la herramienta
	*/



/* ################################################################## */
/* ################################################################## */
	if ($PCO_Accion=="cargar_objeto" || $PCO_Accion=="PCO_CargarObjeto")
		{
			/*
				Function: PCO_CargarObjeto
				Abre los objetos creados con practico como formularios, informes, etc.

				Variables de entrada:

					PCO_Objeto (alias de objeto) - Cadena con la representacion del objeto en formato frm:xxx  inf:xxx   o similares donde se pueden tener multiples parametros separados por el caracter de *dos puntos*.  El primer parametro indicado despues del tipo de objeto indica el ID interno del objeto creado por practico.

				Codigo de ejemplo para llamadas a objetos comunes:

					(start code)
						frm:1:1:documento:123  //Llama al formulario con id=1, dentro de una ventana y buscando por el valor 123 en el campo documento
						inf:1:1:htm:Informes:0 //Llama el informe con id=1, dentro de una ventana, en formato HTML con el estilo CSS Informes y sin ser embebido
					(end)

				Parametros adicionales para formularios:
					
					parametros[2] - indica si es cargado en ventana o escritorio
					parametros[3] - campo a usar Si se llena el form desde un registro
					parametros[4] - valor a comparar para el campo de busqueda

				Parametros adicionales para informes:
					parametros[2] - indica si es cargado en ventana o escritorio
					parametros[3] - Formato utilizado para desplegar el informe: htm, xls
					parametros[4] - Estilo CSS utilizado para presentar el informe en caso de ser formato htm
					parametros[5] - Embebido? Si=1, No=0

				Salida:

					Objeto indicado por la variable de entrada cargado en pantalla mediante llamado a la funcion correspondiente.

				Ver tambien:
					<PCO_CargarFormulario> | <PCO_CargarInforme>
			*/

			$mensaje_error="";
			
			//Verifica si llego o no el objeto
			if ($PCO_Objeto=="") $PCO_Objeto=$objeto;

			//Divide la cadena de objeto en partes conocidas
			$partes_objeto = explode(":", $PCO_Objeto);
			if ($partes_objeto[0]!="frm" && $partes_objeto[0]!="inf")
				$mensaje_error=$MULTILANG_ObjError.": ".$partes_objeto[0];

			if ($mensaje_error=="")
				{
				    //Las variables $PCO_CampoBusquedaBD y $PCO_ValorBusquedaBD son seteadas tanto para formularios como informes a menos que el informe especifique algo diferente en los casos donde se carga un informe o formulario
					if (@$partes_objeto[3]!="") $PCO_CampoBusquedaBD =$partes_objeto[3]; 
					if (@$partes_objeto[4]!="") $PCO_ValorBusquedaBD =$partes_objeto[4];
					//Si es un formulario lo llama con sus parámetros
					if ($partes_objeto[0]=="frm")
						{
							//Evalua si fueron enviados parametros adicionales
							if (@$partes_objeto[2]!="") $en_ventana=$partes_objeto[2];

                            //Si detecta que se trata del form interno para edicion de menues agrega funciones extra
                            if ($partes_objeto[1]=="-12")
                                {
                                    PCO_SelectorIconosAwesome();
                                    PCO_SelectorObjetosMenu();
                                }

                            //Si se trata del formulario de configuraciones OAuth genera variable de URI para redirecciones
                            if ($partes_objeto[1]=="-5")
                                {
                    				// Determina si la conexion actual de Practico esta encriptada
                    				if(empty($_SERVER["HTTPS"]))
                    					$protocolo_webservice="http://";
                    				else
                    					$protocolo_webservice="https://";
                    				// Construye la URI de retorno
                    				$prefijo_webservice=$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
                    				// Construye la URI de redireccion base para concatenar el servicio especifico
                    				$URI = $protocolo_webservice.$prefijo_webservice."?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=";
                                }

							PCO_CargarFormulario($partes_objeto[1],@$en_ventana,@$PCO_CampoBusquedaBD,@$PCO_ValorBusquedaBD);
						}
					//Si es un informe lo llama con sus parámetros
					if ($partes_objeto[0]=="inf")
						{
							if (@$partes_objeto[2]!="") $en_ventana=$partes_objeto[2];
							if (@$partes_objeto[3]!="") $formato =$partes_objeto[3];
							if (@$partes_objeto[4]!="") $estilo =$partes_objeto[4];
							if (@$partes_objeto[5]!="") $embebido =$partes_objeto[5];
							PCO_CargarInforme($partes_objeto[1],@$en_ventana);
						}
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_VerMenu">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorTiempoEjecucion.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
function RedimensionarImagenPWA($ArchivoOrigen,$ArchivoDestino,$Ancho,$Alto)
    {
        $original = $ArchivoOrigen;
        $destino = $ArchivoDestino; // La salida siempre será en PNG para no perder calidad
      
        $width_d = $Ancho; // ancho de salida en pixeles
        $height_d = $Alto; // alto de salida en pixeles

        //obtengo información del archivo
        list($width_s, $height_s, $type, $attr) = getimagesize($original, $info2);

        // crea el recurso gd para el origen
        if(!$gd_s = imagecreatefromstring(file_get_contents($original)))
         die('El archivo no es una imagen.'); // el archivo no es una imagen

        //crea el recurso gd para la salida
        if(!$gd_d = imagecreatetruecolor($width_d, $height_d))
         die('El archivo no es una imagen.'); // No maneja GD o escala fuera del limite

        imagealphablending($gd_d, false); // desactivo el procesamiento automatico de alpha
        imagesavealpha($gd_d, true); // Alpha original se graba en el archivo destino

        //Redimensiona
        imagecopyresampled($gd_d, $gd_s, 0, 0, 0, 0, $width_d, $height_d, $width_s, $height_s);
        //unlink($original); // Elimina el archivo original
        if(!imagepng($gd_d, $destino)) // Graba la imagen
         die('No tiene permisos de escritura sobre el directorio de imagenes.');
        imagedestroy($gd_s); // Libera memoria
        imagedestroy($gd_d); // Libera memoria
    }


/* ################################################################## */
/* ################################################################## */
	if ($PCO_Accion=="guardar_configuracion")
		{
			/*
				Function: guardar_configuracion
				Actualiza los valores del archivo core/configuracion.php con los ingresados en el formulario por el administrador.  El archivo debe contar con permisos suficientes para que el usuario que ejecuta el servicio web pueda escribirlo.

				Variables de entrada:

					variables desde formulario

				Salida:

					Archivo de configuracion actualizado con los nuevos parametros
			*/

			//Verifica si esta o no en modo DEMO para hacer la operacion
			if ($PCO_ModoDEMO==1)
				{
					PCO_Mensaje($MULTILANG_TitDemo, $MULTILANG_MsjDemo, '', 'fa fa-fw fa-2x fa-thumbs-down', 'alert alert-dismissible alert-danger');
					echo '<div align="center"><button onclick="document.PCO_FormVerMenu.submit()" class="btn btn-warning"><i class="fa fa-home"></i> '.$MULTILANG_IrEscritorio.'</button></div><br>';
					die();
				}

			$mensaje_error="";

			$hay_error=0;
			// Crea la cadena de salida con la configuracion de practico
$salida=sprintf("<?php
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


		Title: Configuracion base
		
		IMPORTANTE: La actualizacion de este archivo se deberia realizar por medio de la ventana de configuracion de la herramienta.  No altere estos valores manualmente a menos que sepa lo que hace.
		
		Ubicacion *[/core/configuracion.php]*.  Archivo que contiene la declaracion de variables basicas para conexion a bases de datos y otros

		Section: Variables de conexion

		Crea las variables de conexion para el motor de bases de datos, segmentos de direcciones, etc.  Ver ejemplo:

		(start code)
			ServidorBD='XXX';
			BaseDatos='XXX';
			UsuarioBD='XXX';
			PasswordBD='XXX';
			MotorBD='XXX';
			PuertoBD='';
		(end)
	*/

	\$ServidorBD='%s';	// Direccion IP o nombre de host
	\$BaseDatos='%s';   // Path completo cuando se trata de sqlite2, ej: '/path/to/database.sdb'
	\$UsuarioBD='%s';
	\$PasswordBD='%s';
	\$MotorBD='%s';		// Puede variar segun el driver PDO: mysql|pgsql|sqlite|sqlsrv|mssql|ibm|dblib|odbc|oracle|ifmx|fbd
	\$PuertoBD='%s';	// Vacio para predeterminado

	/*
		Section: Variables para aplicacion

		(start code)
			NombreRAD='XXX';			// Nombre del aplicativo
			VersionRAD='XXX';			// Version del aplicativo
			ArchivoCORE='';				// Script que procesa todos los formularios. Vacio para la misma pagina o index.php

			TablasCore='Core_';			// Prefijo de Tablas base para uso de Practico (Cuidado al cambiar)
			TablasApp='App_';			// Prefijo de Tablas de datos definidas por el usuario (Cuidado al cambiar)
		(end)

		*Llave de paso*

		Establezca cualquier valor en la siguiente variable para reforzar la seguridad. Cambiar esto despues de tener usuarios creados puede afectar la autenticacion
		Se recomienda establecer una llave en ambientes de produccion antes de trabajar. Cada usuario debe contar en su registro con una llave de paso equivalente al MD5 definido en este punto
		La llave de paso es utilizada tambien como una llave de consumo interno para WebServices.  Aunque se puede compartir con otros sitios o aplicativos, por seguridad se deberian utilizar llaves de paso generadas por el asistente.

		(start code)
			LlaveDePaso=''; //Predeterminado en vacio con MD5=d41d8cd98f00b204e9800998ecf8427e
		(end)
	*/

	\$NombreRAD='%s';
	\$ArchivoCORE='';
	\$TablasCore='%s';  // Cuidado al cambiar: Prefijo de Tablas base para uso de Practico
	\$TablasApp='%s';  // Cuidado al cambiar: Prefijo para Tablas de datos definidas por el usuario
	\$LlaveDePaso='%s';  // Valor unico para firmar los usuarios del aplicativo.  No debe ser cambiado despues de puesto en marcha a menos que se haga un update manual el usuario que no coincida con la llave no podra ingresar.
	\$ModoDepuracion=%s;
	\$PermitirReporteBugs=%s;
	\$DepuracionSQL=%s;
	\$BuscarActualizaciones=%s;

	\$ZonaHoraria='%s';
	\$IdiomaPredeterminado='%s';
	\$IdiomaEnLogin=%s;
	\$Tema_PracticoFramework='%s';
	\$PCO_ArchivoImagenFondo='%s';

	\$TipoCaptchaLogin='%s';
	\$CaracteresCaptcha=%s;
	\$CodigoGoogleAnalytics='%s';
	
	// Tipo de motor usado para la autenticacion de usuarios
	\$Auth_TipoMotor='%s';
	\$Auth_ProtoTransporte='%s';
	\$Auth_PermitirReseteoClaves='%s';
	\$Auth_PermitirAutoRegistro='%s';
	\$Auth_PlantillaAutoRegistro='%s';
	\$Auth_PresentarOauthInicio='%s';

	// Configuracion LDAP - Auth_TipoMotor=ldap
	\$Auth_TipoEncripcion='%s';
	\$Auth_LDAPServidor='%s';
	\$Auth_LDAPPuerto='%s';
	\$Auth_LDAPDominio='%s';
	\$Auth_LDAPOU='%s';

	// Especifica si desea activar o no el modulo de chat para usuarios asi:
	// 0=No, 1=Solo usuarios internos, 2=Solo usuarios externos, 3=Todos los usuarios, 4=Exclusivo para admin (podra iniciar conversacion y chat con cualquier otro usuario aun con modulo desactivado)
	\$Activar_ModuloChat=%s;
	
	// Especifica si desea activar o no el registro de la aplicacion como una Aplicacion web progresiva PWA y algunos permisos de usuario
	\$PWA_Activa=%s;
	\$PWA_DireccionTexto='%s';
	\$PWA_Display='%s';
	\$PWA_Orientacion='%s';
	\$PWA_FCMSenderID='%s';
	\$PWA_Scope='%s';
	\$PWA_AutorizacionGPS='%s';
	\$PWA_AutorizacionFCM='%s';
	\$PWA_AutorizacionCAM='%s';
	\$PWA_AutorizacionMIC='%s';
	\$PWA_OcultarBarrasHerramientas='%s';

	// Define cadena usada para separar campos en operaciones de bases de datos
	\$_SeparadorCampos_='%s';
	
	// Define si la plataforma se encuentra activa para realizar desarrollo interno de PracticoFramework
	\$ModoDesarrolladorPractico=%s; // [0=Inactivo|-10000=Activo]

	// Define cadena separada por comas con usuarios administradores de la aplicacion
	\$PCOVAR_Administradores='%s';",$ServidorNEW,$BaseDatos,$UsuarioBD,$PasswordBD,$MotorBD,$PuertoBD,$NombreRADNEW,$TablasCoreNEW,$TablasAppNEW,$LlaveDePasoNEW,$ModoDepuracionNEW,$PermitirReporteBugsNEW,$DepuracionSQLNEW,$BuscarActualizacionesNEW,$ZonaHorariaNEW,$IdiomaPredeterminadoNEW,$IdiomaEnLoginNEW,$Tema_PracticoFrameworkNEW,$PCO_ArchivoImagenFondoNEW,$TipoCaptchaLoginNEW,$CaracteresCaptchaNEW,$CodigoGoogleAnalyticsNEW,$Auth_TipoMotorNEW,$Auth_ProtoTransporteNEW,$Auth_PermitirReseteoClavesNEW,$Auth_PermitirAutoRegistroNEW,$Auth_PlantillaAutoRegistroNEW,$Auth_PresentarOauthInicioNEW,$Auth_TipoEncripcionNEW,$Auth_LDAPServidorNEW,$Auth_LDAPPuertoNEW,$Auth_LDAPDominioNEW,$Auth_LDAPOUNEW,$Activar_ModuloChatNEW,$PWA_ActivaNEW,$PWA_DireccionTextoNEW,$PWA_DisplayNEW,$PWA_OrientacionNEW,$PWA_FCMSenderIDNEW,$PWA_ScopeNEW,$PWA_AutorizacionGPSNEW,$PWA_AutorizacionFCMNEW,$PWA_AutorizacionCAMNEW,$PWA_AutorizacionMICNEW,$PWA_OcultarBarrasHerramientasNEW,$_SeparadorCampos_NEW,$ModoDesarrolladorPracticoNEW,$PCOVAR_AdministradoresNEW);
			// Escribe el archivo de configuracion
			$archivo_config=fopen("core/configuracion.php","w");
			if($archivo_config==null)
				{
					$hay_error=1;
					$mensaje_error=$MULTILANG_ErrorEscribirConfig;
				}
			else
				{
					fwrite($archivo_config,$salida,strlen($salida)); 
					fclose($archivo_config);
				}

            //Actualiza archivos de logo si aplica
            if ($_FILES["LogoSuperiorNEW"]['name']!="")
                {
					// Procesa el archivo y lo almacena en el path
					$nombre_archivo = $_FILES["LogoSuperiorNEW"]['name']; //Contiene el nombre original
					$nombre_archivo_temporal = $_FILES["LogoSuperiorNEW"]['tmp_name']; //Nombre del archivo temporal en servidor
					$extension_archivo=end(explode(".", $nombre_archivo));
					//Si la extension es permitida sigue adelante
					if ($extension_archivo=="png")
					    {
        					if (!move_uploaded_file($nombre_archivo_temporal, "img/logo.png" ))
        						$mensaje_error.=$nombre_archivo.'- '.$MULTILANG_FrmErrorCargaGeneral;
					    }
                }
            if ($_FILES["LogoLoginNEW"]['name']!="")
                {
					// Procesa el archivo y lo almacena en el path
					$nombre_archivo = $_FILES["LogoLoginNEW"]['name']; //Contiene el nombre original
					$nombre_archivo_temporal = $_FILES["LogoLoginNEW"]['tmp_name']; //Nombre del archivo temporal en servidor
					$extension_archivo=end(explode(".", $nombre_archivo));
					//Si la extension es permitida sigue adelante
					if ($extension_archivo=="png")
					    {
        					if (!move_uploaded_file($nombre_archivo_temporal, "img/practico_login.png" ))
        						$mensaje_error.=$nombre_archivo.'- '.$MULTILANG_FrmErrorCargaGeneral;
					    }
                }

            //Procesa iconos de PWA
            if ($_FILES["IconoPWANEW"]['name']!="")
                {
					// Procesa el archivo y lo almacena en el path
					$nombre_archivo = $_FILES["IconoPWANEW"]['name']; //Contiene el nombre original
					$nombre_archivo_temporal = $_FILES["IconoPWANEW"]['tmp_name']; //Nombre del archivo temporal en servidor
					$extension_archivo=end(explode(".", $nombre_archivo));
					//Si la extension es permitida sigue adelante
					if ($extension_archivo=="png")
					    {
        					if (!move_uploaded_file($nombre_archivo_temporal, "pwa/launcher-icon-512.png" ))
        						$mensaje_error.=$nombre_archivo.'- '.$MULTILANG_FrmErrorCargaGeneral;
        					else
        					    {
        					        //Si pudo crear el archivo entonces hace de una vez la creacion de los demas iconos a partir de este
        					        RedimensionarImagenPWA("pwa/launcher-icon-512.png","pwa/launcher-icon-256.png","256","256");
        					        RedimensionarImagenPWA("pwa/launcher-icon-512.png","pwa/launcher-icon-192.png","192","192");
        					        RedimensionarImagenPWA("pwa/launcher-icon-512.png","pwa/launcher-icon-152.png","152","152");
        					        RedimensionarImagenPWA("pwa/launcher-icon-512.png","pwa/launcher-icon-144.png","144","144");
        					        RedimensionarImagenPWA("pwa/launcher-icon-512.png","pwa/launcher-icon-96.png","96","96");
        					        RedimensionarImagenPWA("pwa/launcher-icon-512.png","pwa/launcher-icon-72.png","72","72");
        					        RedimensionarImagenPWA("pwa/launcher-icon-512.png","pwa/launcher-icon-36.png","36","36");
        					        RedimensionarImagenPWA("pwa/launcher-icon-512.png","pwa/launcher-icon.png","48","48");
        					    }
					    }
                }

            //Genera manifiesto para PWA en caso que se haya activado
            if ($PWA_ActivaNEW=="1")
                {
                    //Define si se cuenta o no con ID de FirebaseCloudMessagin
                    $CadenaFinalFCM="";
                    if ($PWA_FCMSenderIDNEW!="")
                        $CadenaFinalFCM='"gcm_sender_id": "'.$PWA_FCMSenderIDNEW.'",
    "gcm_user_visible_only": true,
	"permissions": [
	  "gcm", "storage"
	],';

                    //Define el Scope y la URL inicial
                        $CadenaFinalScope='
  "scope": "/",
  "start_url": "/",';
                    if ($PWA_ScopeNEW!="")
                        $CadenaFinalScope='
  "scope": "'.$PWA_ScopeNEW.'",
  "start_url": "'.$PWA_ScopeNEW.'",';

                    if ($Tema_PracticoFramework=="bootstrap") { $PCO_ColorFondoGeneral="#ffffff"; }
                    if ($Tema_PracticoFramework=="cerulean") { $PCO_ColorFondoGeneral="#ffffff"; }
                    if ($Tema_PracticoFramework=="cosmo") { $PCO_ColorFondoGeneral="#060606"; }
                    if ($Tema_PracticoFramework=="cyborg") { $PCO_ColorFondoGeneral="#060606"; }
                    if ($Tema_PracticoFramework=="darkly") { $PCO_ColorFondoGeneral="#222222"; }
                    if ($Tema_PracticoFramework=="flatly") { $PCO_ColorFondoGeneral="#2f324a"; }
                    if ($Tema_PracticoFramework=="journal") { $PCO_ColorFondoGeneral="#ffffff"; }
                    if ($Tema_PracticoFramework=="lumen") { $PCO_ColorFondoGeneral="#ffffff"; }
                    if ($Tema_PracticoFramework=="paper") { $PCO_ColorFondoGeneral="#ffffff"; }
                    if ($Tema_PracticoFramework=="readable") { $PCO_ColorFondoGeneral="#ffffff"; }
                    if ($Tema_PracticoFramework=="sandstone") { $PCO_ColorFondoGeneral="#1a221c"; }
                    if ($Tema_PracticoFramework=="simplex") { $PCO_ColorFondoGeneral="#fcfcfc"; }
                    if ($Tema_PracticoFramework=="slate") { $PCO_ColorFondoGeneral="#272b30"; }
                    if ($Tema_PracticoFramework=="spacelab") { $PCO_ColorFondoGeneral="#ffffff"; }
                    if ($Tema_PracticoFramework=="superhero") { $PCO_ColorFondoGeneral="#2b3e50"; }
                    if ($Tema_PracticoFramework=="united") { $PCO_ColorFondoGeneral="#ffffff"; }
                    if ($Tema_PracticoFramework=="yeti") { $PCO_ColorFondoGeneral="#2f2f2f"; }
                    if ($Tema_PracticoFramework=="amelia") { $PCO_ColorFondoGeneral="#108a93"; }
                    if ($Tema_PracticoFramework=="material") { $PCO_ColorFondoGeneral="#ffffff"; }

			        // Crea la cadena de salida con el archivo de manifiesto
$manifiesto=sprintf('{
  "lang": "%s",
  "short_name": "%s",
  "name": "%s %s (%s)",
  "description": "%s",
  "icons": [
    {
      "src": "launcher-icon.png",
      "sizes": "48x48",
      "type": "image/png"
    },
    {
      "src": "launcher-icon-36.png",
      "sizes": "36x36",
      "type": "image/png"
    },
    {
      "src": "launcher-icon-72.png",
      "sizes": "72x72",
      "type": "image/png"
    },
    {
      "src": "launcher-icon-96.png",
      "sizes": "96x96",
      "type": "image/png"
    },
    {
      "src": "launcher-icon-144.png",
      "sizes": "144x144",
      "type": "image/png"
    },
    {
      "src": "launcher-icon-192.png",
      "sizes": "192x192",
      "type": "image/png"
    },
    {
      "src": "launcher-icon-256.png",
      "sizes": "256x256",
      "type": "image/png"
    },
    {
      "src": "launcher-icon-512.png",
      "sizes": "512x512",
      "type": "image/png"
    }
  ],
  "author": {
    "name": "John F. Arroyave Gutierrez",
    "website": "http://www.practico.org",
    "github": "https://github.com/unix4you2",
    "source-repo": "https://github.com/unix4you2/practico"
  },
  "screenshots": [{
    "src": "screenshot-640x480.png",
    "sizes": "640x480",
    "type": "image/png"
  },{
    "src": "screenshot-1280x920.png",
    "sizes": "1280x920",
    "type": "image/png"
  }],
  %s
  %s
  "dir": "%s",
  "display": "%s",
  "orientation": "%s",
  "prefer_related_applications": false,
  "theme_color": "%s",
  "background_color": "%s"
}',$IdiomaPredeterminado,$Nombre_Aplicacion,$Nombre_Aplicacion,$Version_Aplicacion,$Nombre_Empresa_Corto,$MULTILANG_PWADescripcion,$CadenaFinalFCM,$CadenaFinalScope,$PWA_DireccionTextoNEW,$PWA_DisplayNEW,$PWA_OrientacionNEW,$PCO_ColorFondoGeneral,$PCO_ColorFondoGeneral);

        			// Escribe el archivo de manifiesto
        			$archivo_config_manifiesto=fopen("pwa/manifest.json","w");
        			if($archivo_config_manifiesto==null)
        				{
        					$hay_error=1;
        					$mensaje_error=$MULTILANG_ErrorEscribirConfig;
        				}
        			else
        				{
        					fwrite($archivo_config_manifiesto,$manifiesto,strlen($manifiesto)); 
        					fclose($archivo_config_manifiesto);
        				}

                }


            //Presenta resultados de operacion de actualizacion de configuracion y de archivos de logo
			if ($mensaje_error=="")
				{
					echo '<script type="" language="JavaScript"> document.PCO_FormVerMenu.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_VerMenu">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorTiempoEjecucion.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
	if ($PCO_Accion=="PCO_GuardarConfiguracionOAuth")
		{
			/*
				Function: PCO_GuardarConfiguracionOAuth
				Actualiza las configuraciones para autenticacion por OAuth

				Variables de entrada:

					ID Client, Secret, URI - Para cada servicio de OAuth disponible

				Salida:

					Archivo de tokens y configuraciones de OAuth actualizado
			*/


$salida=sprintf("<?php
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


		Title: Configuracion Proveedores OAuth 1.0 y 2.0
		
		IMPORTANTE: La actualizacion de este archivo se deberia realizar por medio de la ventana de configuracion de la herramienta.  No altere estos valores manualmente a menos que sepa lo que hace.
		
		Ubicacion *[/core/ws_oauth.php]*.  Archivo que contiene la configuracion para autenticaciones externas con proveedores OAuth
	*/

	// Ubicacion de las opciones al login
	\$UbicacionProveedoresOAuth='%s';

	// Google
	\$APIGoogle_ClientId='%s';
	\$APIGoogle_ClientSecret='%s';
	\$APIGoogle_RedirectUri='%s';
	\$APIGoogle_Template='%s';

	// Facebook
	\$APIFacebook_ClientId='%s';
	\$APIFacebook_ClientSecret='%s';
	\$APIFacebook_RedirectUri='%s';
	\$APIFacebook_Template='%s';

	// Twitter
	\$APITwitter_ClientId='%s';
	\$APITwitter_ClientSecret='%s';
	\$APITwitter_RedirectUri='%s';
	\$APITwitter_Template='%s';

	// Dropbox
	\$APIDropbox_ClientId='%s';
	\$APIDropbox_ClientSecret='%s';
	\$APIDropbox_RedirectUri='%s';
	\$APIDropbox_Template='%s';

	// Flickr
	\$APIFlickr_ClientId='%s';
	\$APIFlickr_ClientSecret='%s';
	\$APIFlickr_RedirectUri='%s';
	\$APIFlickr_Template='%s';

	// Microsoft
	\$APIMicrosoft_ClientId='%s';
	\$APIMicrosoft_ClientSecret='%s';
	\$APIMicrosoft_RedirectUri='%s';
	\$APIMicrosoft_Template='%s';

	// Foursquare
	\$APIFoursquare_ClientId='%s';
	\$APIFoursquare_ClientSecret='%s';
	\$APIFoursquare_RedirectUri='%s';
	\$APIFoursquare_Template='%s';

	// Bitbucket
	\$APIBitbucket_ClientId='%s';
	\$APIBitbucket_ClientSecret='%s';
	\$APIBitbucket_RedirectUri='%s';
	\$APIBitbucket_Template='%s';

	// Salesforce
	\$APISalesforce_ClientId='%s';
	\$APISalesforce_ClientSecret='%s';
	\$APISalesforce_RedirectUri='%s';
	\$APISalesforce_Template='%s';

	// Yahoo
	\$APIYahoo_ClientId='%s';
	\$APIYahoo_ClientSecret='%s';
	\$APIYahoo_RedirectUri='%s';
	\$APIYahoo_Template='%s';

	// Box
	\$APIBox_ClientId='%s';
	\$APIBox_ClientSecret='%s';
	\$APIBox_RedirectUri='%s';
	\$APIBox_Template='%s';

	// Disqus
	\$APIDisqus_ClientId='%s';
	\$APIDisqus_ClientSecret='%s';
	\$APIDisqus_RedirectUri='%s';
	\$APIDisqus_Template='%s';

	// RightSignature
	\$APIRightSignature_ClientId='%s';
	\$APIRightSignature_ClientSecret='%s';
	\$APIRightSignature_RedirectUri='%s';
	\$APIRightSignature_Template='%s';

	// Fitbit
	\$APIFitbit_ClientId='%s';
	\$APIFitbit_ClientSecret='%s';
	\$APIFitbit_RedirectUri='%s';
	\$APIFitbit_Template='%s';

	// ScoopIt
	\$APIScoopIt_ClientId='%s';
	\$APIScoopIt_ClientSecret='%s';
	\$APIScoopIt_RedirectUri='%s';
	\$APIScoopIt_Template='%s';

	// Tumblr
	\$APITumblr_ClientId='%s';
	\$APITumblr_ClientSecret='%s';
	\$APITumblr_RedirectUri='%s';
	\$APITumblr_Template='%s';

	// StockTwits
	\$APIStockTwits_ClientId='%s';
	\$APIStockTwits_ClientSecret='%s';
	\$APIStockTwits_RedirectUri='%s';
	\$APIStockTwits_Template='%s';

	// LinkedIn
	\$APILinkedIn_ClientId='%s';
	\$APILinkedIn_ClientSecret='%s';
	\$APILinkedIn_RedirectUri='%s';
	\$APILinkedIn_Template='%s';

	// Instagram
	\$APIInstagram_ClientId='%s';
	\$APIInstagram_ClientSecret='%s';
	\$APIInstagram_RedirectUri='%s';
	\$APIInstagram_Template='%s';

	// SurveyMonkey
	\$APISurveyMonkey_ClientId='%s';
	\$APISurveyMonkey_ClientSecret='%s';
	\$APISurveyMonkey_RedirectUri='%s';
	\$APISurveyMonkey_Template='%s';

	// Eventful
	\$APIEventful_ClientId='%s';
	\$APIEventful_ClientSecret='%s';
	\$APIEventful_RedirectUri='%s';
	\$APIEventful_Template='%s';

	// XING
	\$APIXING_ClientId='%s';
	\$APIXING_ClientSecret='%s';
	\$APIXING_RedirectUri='%s';
	\$APIXING_Template='%s';
	
	// VK
	\$APIVK_ClientId='%s';
	\$APIVK_ClientSecret='%s';
	\$APIVK_RedirectUri='%s';
	\$APIVK_Template='%s';
	
	// Withings
	\$APIWithings_ClientId='%s';
	\$APIWithings_ClientSecret='%s';
	\$APIWithings_RedirectUri='%s';
	\$APIWithings_Template='%s';
	
	// 37Signals
	\$API37Signals_ClientId='%s';
	\$API37Signals_ClientSecret='%s';
	\$API37Signals_RedirectUri='%s';
	\$API37Signals_Template='%s';
	
	// Amazon
	\$APIAmazon_ClientId='%s';
	\$APIAmazon_ClientSecret='%s';
	\$APIAmazon_RedirectUri='%s';
	\$APIAmazon_Template='%s';
	
	// AOL
	\$APIAOL_ClientId='%s';
	\$APIAOL_ClientSecret='%s';
	\$APIAOL_RedirectUri='%s';
	\$APIAOL_Template='%s';
	
	// Bitly
	\$APIBitly_ClientId='%s';
	\$APIBitly_ClientSecret='%s';
	\$APIBitly_RedirectUri='%s';
	\$APIBitly_Template='%s';
	
	// Buffer
	\$APIBuffer_ClientId='%s';
	\$APIBuffer_ClientSecret='%s';
	\$APIBuffer_RedirectUri='%s';
	\$APIBuffer_Template='%s';
	
	// Copy
	\$APICopy_ClientId='%s';
	\$APICopy_ClientSecret='%s';
	\$APICopy_RedirectUri='%s';
	\$APICopy_Template='%s';
	
	// Dailymotion
	\$APIDailymotion_ClientId='%s';
	\$APIDailymotion_ClientSecret='%s';
	\$APIDailymotion_RedirectUri='%s';
	\$APIDailymotion_Template='%s';
	
	// Discogs
	\$APIDiscogs_ClientId='%s';
	\$APIDiscogs_ClientSecret='%s';
	\$APIDiscogs_RedirectUri='%s';
	\$APIDiscogs_Template='%s';
	
	// Etsy
	\$APIEtsy_ClientId='%s';
	\$APIEtsy_ClientSecret='%s';
	\$APIEtsy_RedirectUri='%s';
	\$APIEtsy_Template='%s';
	
	// Garmin
	\$APIGarmin_ClientId='%s';
	\$APIGarmin_ClientSecret='%s';
	\$APIGarmin_RedirectUri='%s';
	\$APIGarmin_Template='%s';
	
	// Garmin2Legged
	\$APIGarmin2Legged_ClientId='%s';
	\$APIGarmin2Legged_ClientSecret='%s';
	\$APIGarmin2Legged_RedirectUri='%s';
	\$APIGarmin2Legged_Template='%s';
	
	// iHealth
	\$APIiHealth_ClientId='%s';
	\$APIiHealth_ClientSecret='%s';
	\$APIiHealth_RedirectUri='%s';
	\$APIiHealth_Template='%s';
	
	// imgur
	\$APIimgur_ClientId='%s';
	\$APIimgur_ClientSecret='%s';
	\$APIimgur_RedirectUri='%s';
	\$APIimgur_Template='%s';
	
	// Infusionsoft
	\$APIInfusionsoft_ClientId='%s';
	\$APIInfusionsoft_ClientSecret='%s';
	\$APIInfusionsoft_RedirectUri='%s';
	\$APIInfusionsoft_Template='%s';
	
	// Intuit
	\$APIIntuit_ClientId='%s';
	\$APIIntuit_ClientSecret='%s';
	\$APIIntuit_RedirectUri='%s';
	\$APIIntuit_Template='%s';
	
	// Jawbone
	\$APIJawbone_ClientId='%s';
	\$APIJawbone_ClientSecret='%s';
	\$APIJawbone_RedirectUri='%s';
	\$APIJawbone_Template='%s';
	
	// Livecoding
	\$APILivecoding_ClientId='%s';
	\$APILivecoding_ClientSecret='%s';
	\$APILivecoding_RedirectUri='%s';
	\$APILivecoding_Template='%s';
	
	// MailChimp
	\$APIMailChimp_ClientId='%s';
	\$APIMailChimp_ClientSecret='%s';
	\$APIMailChimp_RedirectUri='%s';
	\$APIMailChimp_Template='%s';
	
	// Mavenlink
	\$APIMavenlink_ClientId='%s';
	\$APIMavenlink_ClientSecret='%s';
	\$APIMavenlink_RedirectUri='%s';
	\$APIMavenlink_Template='%s';
	
	// Meetup
	\$APIMeetup_ClientId='%s';
	\$APIMeetup_ClientSecret='%s';
	\$APIMeetup_RedirectUri='%s';
	\$APIMeetup_Template='%s';
	
	// MicrosoftOpenIDConnect
	\$APIMicrosoftOpenIDConnect_ClientId='%s';
	\$APIMicrosoftOpenIDConnect_ClientSecret='%s';
	\$APIMicrosoftOpenIDConnect_RedirectUri='%s';
	\$APIMicrosoftOpenIDConnect_Template='%s';
	
	// Misfit
	\$APIMisfit_ClientId='%s';
	\$APIMisfit_ClientSecret='%s';
	\$APIMisfit_RedirectUri='%s';
	\$APIMisfit_Template='%s';
	
	// oDesk
	\$APIoDesk_ClientId='%s';
	\$APIoDesk_ClientSecret='%s';
	\$APIoDesk_RedirectUri='%s';
	\$APIoDesk_Template='%s';
	
	// Odnoklassniki
	\$APIOdnoklassniki_ClientId='%s';
	\$APIOdnoklassniki_ClientSecret='%s';
	\$APIOdnoklassniki_RedirectUri='%s';
	\$APIOdnoklassniki_Template='%s';
	
	// Paypal
	\$APIPaypal_ClientId='%s';
	\$APIPaypal_ClientSecret='%s';
	\$APIPaypal_RedirectUri='%s';
	\$APIPaypal_Template='%s';
	
	// Pinterest
	\$APIPinterest_ClientId='%s';
	\$APIPinterest_ClientSecret='%s';
	\$APIPinterest_RedirectUri='%s';
	\$APIPinterest_Template='%s';
	
	// Rdio
	\$APIRdio_ClientId='%s';
	\$APIRdio_ClientSecret='%s';
	\$APIRdio_RedirectUri='%s';
	\$APIRdio_Template='%s';
	
	// Reddit
	\$APIReddit_ClientId='%s';
	\$APIReddit_ClientSecret='%s';
	\$APIReddit_RedirectUri='%s';
	\$APIReddit_Template='%s';
	
	// RunKeeper
	\$APIRunKeeper_ClientId='%s';
	\$APIRunKeeper_ClientSecret='%s';
	\$APIRunKeeper_RedirectUri='%s';
	\$APIRunKeeper_Template='%s';
	
	// Uber
	\$APIUber_ClientId='%s';
	\$APIUber_ClientSecret='%s';
	\$APIUber_RedirectUri='%s';
	\$APIUber_Template='%s';
	
	// TeamViewer
	\$APITeamViewer_ClientId='%s';
	\$APITeamViewer_ClientSecret='%s';
	\$APITeamViewer_RedirectUri='%s';
	\$APITeamViewer_Template='%s';
	
	// Vimeo
	\$APIVimeo_ClientId='%s';
	\$APIVimeo_ClientSecret='%s';
	\$APIVimeo_RedirectUri='%s';
	\$APIVimeo_Template='%s';
	
	// Wordpress
	\$APIWordpress_ClientId='%s';
	\$APIWordpress_ClientSecret='%s';
	\$APIWordpress_RedirectUri='%s';
	\$APIWordpress_Template='%s';
	
	// Xero
	\$APIXero_ClientId='%s';
	\$APIXero_ClientSecret='%s';
	\$APIXero_RedirectUri='%s';
	\$APIXero_Template='%s';
	
	// Yammer
	\$APIYammer_ClientId='%s';
	\$APIYammer_ClientSecret='%s';
	\$APIYammer_RedirectUri='%s';
	\$APIYammer_Template='%s';
	
	// Yandex
	\$APIYandex_ClientId='%s';
	\$APIYandex_ClientSecret='%s';
	\$APIYandex_RedirectUri='%s';
	\$APIYandex_Template='%s';
	",$UbicacionProveedoresOAuthNEW,$APIGoogle_ClientIdNEW,$APIGoogle_ClientSecretNEW,$APIGoogle_RedirectUriNEW,$APIGoogle_TemplateNEW,$APIFacebook_ClientIdNEW,$APIFacebook_ClientSecretNEW,$APIFacebook_RedirectUriNEW,$APIFacebook_TemplateNEW,$APITwitter_ClientIdNEW,$APITwitter_ClientSecretNEW,$APITwitter_RedirectUriNEW,$APITwitter_TemplateNEW,$APIDropbox_ClientIdNEW,$APIDropbox_ClientSecretNEW,$APIDropbox_RedirectUriNEW,$APIDropbox_TemplateNEW,$APIFlickr_ClientIdNEW,$APIFlickr_ClientSecretNEW,$APIFlickr_RedirectUriNEW,$APIFlickr_TemplateNEW,$APIMicrosoft_ClientIdNEW,$APIMicrosoft_ClientSecretNEW,$APIMicrosoft_RedirectUriNEW,$APIMicrosoft_TemplateNEW,$APIFoursquare_ClientIdNEW,$APIFoursquare_ClientSecretNEW,$APIFoursquare_RedirectUriNEW,$APIFoursquare_TemplateNEW,$APIBitbucket_ClientIdNEW,$APIBitbucket_ClientSecretNEW,$APIBitbucket_RedirectUriNEW,$APIBitbucket_TemplateNEW,$APISalesforce_ClientIdNEW,$APISalesforce_ClientSecretNEW,$APISalesforce_RedirectUriNEW,$APISalesforce_TemplateNEW,$APIYahoo_ClientIdNEW,$APIYahoo_ClientSecretNEW,$APIYahoo_RedirectUriNEW,$APIYahoo_TemplateNEW,$APIBox_ClientIdNEW,$APIBox_ClientSecretNEW,$APIBox_RedirectUriNEW,$APIBox_TemplateNEW,$APIDisqus_ClientIdNEW,$APIDisqus_ClientSecretNEW,$APIDisqus_RedirectUriNEW,$APIDisqus_TemplateNEW,$APIRightSignature_ClientIdNEW,$APIRightSignature_ClientSecretNEW,$APIRightSignature_RedirectUriNEW,$APIRightSignature_TemplateNEW,$APIFitbit_ClientIdNEW,$APIFitbit_ClientSecretNEW,$APIFitbit_RedirectUriNEW,$APIFitbit_TemplateNEW,$APIScoopIt_ClientIdNEW,$APIScoopIt_ClientSecretNEW,$APIScoopIt_RedirectUriNEW,$APIScoopIt_TemplateNEW,$APITumblr_ClientIdNEW,$APITumblr_ClientSecretNEW,$APITumblr_RedirectUriNEW,$APITumblr_TemplateNEW,$APIStockTwits_ClientIdNEW,$APIStockTwits_ClientSecretNEW,$APIStockTwits_RedirectUriNEW,$APIStockTwits_TemplateNEW,$APILinkedIn_ClientIdNEW,$APILinkedIn_ClientSecretNEW,$APILinkedIn_RedirectUriNEW,$APILinkedIn_TemplateNEW,$APIInstagram_ClientIdNEW,$APIInstagram_ClientSecretNEW,$APIInstagram_RedirectUriNEW,$APIInstagram_TemplateNEW,$APISurveyMonkey_ClientIdNEW,$APISurveyMonkey_ClientSecretNEW,$APISurveyMonkey_RedirectUriNEW,$APISurveyMonkey_TemplateNEW,$APIEventful_ClientIdNEW,$APIEventful_ClientSecretNEW,$APIEventful_RedirectUriNEW,$APIEventful_TemplateNEW,$APIXING_ClientIdNEW,$APIXING_ClientSecretNEW,$APIXING_RedirectUriNEW,$APIXING_TemplateNEW,$APIVK_ClientIdNEW,$APIVK_ClientSecretNEW,$APIVK_RedirectUriNEW,$APIVK_TemplateNEW,$APIWithings_ClientIdNEW,$APIWithings_ClientSecretNEW,$APIWithings_RedirectUriNEW,$APIWithings_TemplateNEW,$API37Signals_ClientIdNEW,$API37Signals_ClientSecretNEW,$API37Signals_RedirectUriNEW,$API37Signals_TemplateNEW,$APIAmazon_ClientIdNEW,$APIAmazon_ClientSecretNEW,$APIAmazon_RedirectUriNEW,$APIAmazon_TemplateNEW,$APIAOL_ClientIdNEW,$APIAOL_ClientSecretNEW,$APIAOL_RedirectUriNEW,$APIAOL_TemplateNEW,$APIBitly_ClientIdNEW,$APIBitly_ClientSecretNEW,$APIBitly_RedirectUriNEW,$APIBitly_TemplateNEW,$APIBuffer_ClientIdNEW,$APIBuffer_ClientSecretNEW,$APIBuffer_RedirectUriNEW,$APIBuffer_TemplateNEW,$APICopy_ClientIdNEW,$APICopy_ClientSecretNEW,$APICopy_RedirectUriNEW,$APICopy_TemplateNEW,$APIDailymotion_ClientIdNEW,$APIDailymotion_ClientSecretNEW,$APIDailymotion_RedirectUriNEW,$APIDailymotion_TemplateNEW,$APIDiscogs_ClientIdNEW,$APIDiscogs_ClientSecretNEW,$APIDiscogs_RedirectUriNEW,$APIDiscogs_TemplateNEW,$APIEtsy_ClientIdNEW,$APIEtsy_ClientSecretNEW,$APIEtsy_RedirectUriNEW,$APIEtsy_TemplateNEW,$APIGarmin_ClientIdNEW,$APIGarmin_ClientSecretNEW,$APIGarmin_RedirectUriNEW,$APIGarmin_TemplateNEW,$APIGarmin2Legged_ClientIdNEW,$APIGarmin2Legged_ClientSecretNEW,$APIGarmin2Legged_RedirectUriNEW,$APIGarmin2Legged_TemplateNEW,$APIiHealth_ClientIdNEW,$APIiHealth_ClientSecretNEW,$APIiHealth_RedirectUriNEW,$APIiHealth_TemplateNEW,$APIimgur_ClientIdNEW,$APIimgur_ClientSecretNEW,$APIimgur_RedirectUriNEW,$APIimgur_TemplateNEW,$APIInfusionsoft_ClientIdNEW,$APIInfusionsoft_ClientSecretNEW,$APIInfusionsoft_RedirectUriNEW,$APIInfusionsoft_TemplateNEW,$APIIntuit_ClientIdNEW,$APIIntuit_ClientSecretNEW,$APIIntuit_RedirectUriNEW,$APIIntuit_TemplateNEW,$APIJawbone_ClientIdNEW,$APIJawbone_ClientSecretNEW,$APIJawbone_RedirectUriNEW,$APIJawbone_TemplateNEW,$APILivecoding_ClientIdNEW,$APILivecoding_ClientSecretNEW,$APILivecoding_RedirectUriNEW,$APILivecoding_TemplateNEW,$APIMailChimp_ClientIdNEW,$APIMailChimp_ClientSecretNEW,$APIMailChimp_RedirectUriNEW,$APIMailChimp_TemplateNEW,$APIMavenlink_ClientIdNEW,$APIMavenlink_ClientSecretNEW,$APIMavenlink_RedirectUriNEW,$APIMavenlink_TemplateNEW,$APIMeetup_ClientIdNEW,$APIMeetup_ClientSecretNEW,$APIMeetup_RedirectUriNEW,$APIMeetup_TemplateNEW,$APIMicrosoftOpenIDConnect_ClientIdNEW,$APIMicrosoftOpenIDConnect_ClientSecretNEW,$APIMicrosoftOpenIDConnect_RedirectUriNEW,$APIMicrosoftOpenIDConnect_TemplateNEW,$APIMisfit_ClientIdNEW,$APIMisfit_ClientSecretNEW,$APIMisfit_RedirectUriNEW,$APIMisfit_TemplateNEW,$APIoDesk_ClientIdNEW,$APIoDesk_ClientSecretNEW,$APIoDesk_RedirectUriNEW,$APIoDesk_TemplateNEW,$APIOdnoklassniki_ClientIdNEW,$APIOdnoklassniki_ClientSecretNEW,$APIOdnoklassniki_RedirectUriNEW,$APIOdnoklassniki_TemplateNEW,$APIPaypal_ClientIdNEW,$APIPaypal_ClientSecretNEW,$APIPaypal_RedirectUriNEW,$APIPaypal_TemplateNEW,$APIPinterest_ClientIdNEW,$APIPinterest_ClientSecretNEW,$APIPinterest_RedirectUriNEW,$APIPinterest_TemplateNEW,$APIRdio_ClientIdNEW,$APIRdio_ClientSecretNEW,$APIRdio_RedirectUriNEW,$APIRdio_TemplateNEW,$APIReddit_ClientIdNEW,$APIReddit_ClientSecretNEW,$APIReddit_RedirectUriNEW,$APIReddit_TemplateNEW,$APIRunKeeper_ClientIdNEW,$APIRunKeeper_ClientSecretNEW,$APIRunKeeper_RedirectUriNEW,$APIRunKeeper_TemplateNEW,$APIUber_ClientIdNEW,$APIUber_ClientSecretNEW,$APIUber_RedirectUriNEW,$APIUber_TemplateNEW,$APITeamViewer_ClientIdNEW,$APITeamViewer_ClientSecretNEW,$APITeamViewer_RedirectUriNEW,$APITeamViewer_TemplateNEW,$APIVimeo_ClientIdNEW,$APIVimeo_ClientSecretNEW,$APIVimeo_RedirectUriNEW,$APIVimeo_TemplateNEW,$APIWordpress_ClientIdNEW,$APIWordpress_ClientSecretNEW,$APIWordpress_RedirectUriNEW,$APIWordpress_TemplateNEW,$APIXero_ClientIdNEW,$APIXero_ClientSecretNEW,$APIXero_RedirectUriNEW,$APIXero_TemplateNEW,$APIYammer_ClientIdNEW,$APIYammer_ClientSecretNEW,$APIYammer_RedirectUriNEW,$APIYammer_TemplateNEW,$APIYandex_ClientIdNEW,$APIYandex_ClientSecretNEW,$APIYandex_RedirectUriNEW,$APIYandex_TemplateNEW);

			$mensaje_error="";

			// Escribe el archivo de configuracion
			$archivo_config=fopen("core/ws_oauth.php","w");
			if($archivo_config==null)
				{
					$hay_error=1;
					$mensaje_error=$MULTILANG_ErrorEscribirConfig;
				}
			else
				{
					fwrite($archivo_config,$salida,strlen($salida)); 
					fclose($archivo_config);
				}
			if ($mensaje_error=="")
				{
					echo '<script type="" language="JavaScript"> document.PCO_FormVerMenu.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_VerMenu">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorTiempoEjecucion.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
	if ($PCO_Accion=="exportacion_masiva_objetos")
		{
			/*
				Function: exportacion_masiva_objetos
				Exporta de manera masiva varios elementos de un tipo de objeto 

				Variables de entrada:

					TipoElementos - Indica el tipo de elementos que deben ser exportados:  Inf o Frm
					ListaElementos - Una lista de los elementos de ese tipo que deben ser exportados en un formato similar a la impresion  EJ: 1,2,5-6,8,12-30
					tipo_copia_objeto - Indica si los objetos seran generados con ID estatico o dinamico: XML_IdEstatico | XML_IdDinamico

				Salida:

					Archivos generados para los elementos seleccionados

				Ver tambien:
					<PCO_ExportarXMLInforme> | <PCO_ImportarXMLInforme> | <PCO_ExportarXMLFormulario> | <PCO_ImportarXMLFormulario>
			*/

			$mensaje_error="";
			//Verifica todas las variables obligatorias
			if ($TipoElementos!="Frm" && $TipoElementos!="Inf")  $mensaje_error="Tipo de elementos a exportar incorrectos";
			if ($ListaElementos=="")  $mensaje_error="No se ha provisto una lista de elementos a exportar valida";

			if ($mensaje_error=="")
				{
				    PCO_AbrirVentana($MULTILANG_FrmTipoCopiaExporta, 'panel-primary');
				    echo $MULTILANG_FrmCopiaFinalizada."<hr>"; 
				    PCO_ExportarDefinicionesXML($TipoElementos,$ListaElementos,$tipo_copia_objeto);
                    ?>
            			<div align=center>
            			<br><br>
            			<a class="btn btn-default" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-home"></i> <?php echo $MULTILANG_IrEscritorio; ?></a>
            			</div>
                    <?php
                        PCO_CerrarVentana();
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_VerMenu">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorTiempoEjecucion.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}