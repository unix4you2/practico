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
	if ($PCO_Accion=="cargar_objeto")
		{
			/*
				Function: cargar_objeto
				Abre los objetos creados con practico como formularios, informes, etc.

				Variables de entrada:

					objeto - Cadena con la representacion del objeto en formato frm:xxx  inf:xxx   o similares donde se pueden tener multiples parametros separados por el caracter de *dos puntos*.  El primer parametro indicado despues del tipo de objeto indica el ID interno del objeto creado por practico.

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
					<cargar_formulario> | <cargar_informe>
			*/

			$mensaje_error="";

			//Divide la cadena de objeto en partes conocidas
			$partes_objeto = explode(":", $objeto);
			if ($partes_objeto[0]!="frm" && $partes_objeto[0]!="inf")
				$mensaje_error=$MULTILANG_ObjError.": ".$partes_objeto[0];

			if ($mensaje_error=="")
				{
					//Si es un formulario lo llama con sus parámetros
					if ($partes_objeto[0]=="frm")
						{
							//Evalua si fueron enviados parametros adicionales
							if (@$partes_objeto[2]!="") $en_ventana=$partes_objeto[2];
							if (@$partes_objeto[3]!="") $PCO_CampoBusquedaBD =$partes_objeto[3]; 
							if (@$partes_objeto[4]!="") $PCO_ValorBusquedaBD =$partes_objeto[4];
							cargar_formulario($partes_objeto[1],@$en_ventana,@$PCO_CampoBusquedaBD,@$PCO_ValorBusquedaBD);
						}
					//Si es un informe lo llama con sus parámetros
					if ($partes_objeto[0]=="inf")
						{
							if (@$partes_objeto[2]!="") $en_ventana=$partes_objeto[2];
							if (@$partes_objeto[3]!="") $formato =$partes_objeto[3];
							if (@$partes_objeto[4]!="") $estilo =$partes_objeto[4];
							if (@$partes_objeto[5]!="") $embebido =$partes_objeto[5];
							cargar_informe($partes_objeto[1],@$en_ventana);
						}
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="Ver_menu">
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
					mensaje($MULTILANG_TitDemo, $MULTILANG_MsjDemo, '', 'fa fa-fw fa-2x fa-thumbs-down', 'alert alert-dismissible alert-danger');
					echo '<div align="center"><button onclick="document.core_ver_menu.submit()" class="btn btn-warning"><i class="fa fa-home"></i> '.$MULTILANG_IrEscritorio.'</button></div><br>';
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
	\$DepuracionSQL=%s;
	\$BuscarActualizaciones=%s;

	\$ZonaHoraria='%s';
	\$IdiomaPredeterminado='%s';
	\$IdiomaEnLogin=%s;
	\$Tema_PracticoFramework='%s';

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
	
	// Especifica si desea activar o no el registro de la aplicacion como una Aplicacion web progresiva PWA
	\$PWA_Activa=%s;
	\$PWA_DireccionTexto='%s';
	\$PWA_Display='%s';
	\$PWA_Orientacion='%s';
	\$PWA_GCMSenderID='%s';

	// Define cadena usada para separar campos en operaciones de bases de datos
	\$_SeparadorCampos_='%s';
	
	// Define si la plataforma se encuentra activa para realizar desarrollo interno de PracticoFramework
	\$ModoDesarrolladorPractico=%s; // [0=Inactivo|-10000=Activo]

	// Define cadena separada por comas con usuarios administradores de la aplicacion
	\$PCOVAR_Administradores='%s';",$ServidorNEW,$BaseDatosNEW,$UsuarioBDNEW,$PasswordBDNEW,$MotorBDNEW,$PuertoBDNEW,$NombreRADNEW,$TablasCoreNEW,$TablasAppNEW,$LlaveDePasoNEW,$ModoDepuracionNEW,$DepuracionSQLNEW,$BuscarActualizacionesNEW,$ZonaHorariaNEW,$IdiomaPredeterminadoNEW,$IdiomaEnLoginNEW,$Tema_PracticoFrameworkNEW,$TipoCaptchaLoginNEW,$CaracteresCaptchaNEW,$CodigoGoogleAnalyticsNEW,$Auth_TipoMotorNEW,$Auth_ProtoTransporteNEW,$Auth_PermitirReseteoClavesNEW,$Auth_PermitirAutoRegistroNEW,$Auth_PlantillaAutoRegistroNEW,$Auth_PresentarOauthInicioNEW,$Auth_TipoEncripcionNEW,$Auth_LDAPServidorNEW,$Auth_LDAPPuertoNEW,$Auth_LDAPDominioNEW,$Auth_LDAPOUNEW,$Activar_ModuloChatNEW,$PWA_ActivaNEW,$PWA_DireccionTextoNEW,$PWA_DisplayNEW,$PWA_OrientacionNEW,$PWA_GCMSenderIDNEW,$_SeparadorCampos_NEW,$ModoDesarrolladorPracticoNEW,$PCOVAR_AdministradoresNEW);
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
        					if (!move_uploaded_file($nombre_archivo_temporal, "pwa/launcher-icon-256.png" ))
        						$mensaje_error.=$nombre_archivo.'- '.$MULTILANG_FrmErrorCargaGeneral;
        					else
        					    {
        					        //Si pudo crear el archivo entonces hace de una vez la creacion de los demas iconos a partir de este
        					        RedimensionarImagenPWA("pwa/launcher-icon-256.png","pwa/launcher-icon-256.png","256","256");
        					        RedimensionarImagenPWA("pwa/launcher-icon-256.png","pwa/launcher-icon-192.png","192","192");
        					        RedimensionarImagenPWA("pwa/launcher-icon-256.png","pwa/launcher-icon-152.png","152","152");
        					        RedimensionarImagenPWA("pwa/launcher-icon-256.png","pwa/launcher-icon-144.png","144","144");
        					        RedimensionarImagenPWA("pwa/launcher-icon-256.png","pwa/launcher-icon-96.png","96","96");
        					        RedimensionarImagenPWA("pwa/launcher-icon-256.png","pwa/launcher-icon-72.png","72","72");
        					        RedimensionarImagenPWA("pwa/launcher-icon-256.png","pwa/launcher-icon-36.png","36","36");
        					        RedimensionarImagenPWA("pwa/launcher-icon-256.png","pwa/launcher-icon.png","48","48");
        					    }
					    }
                }

            //Genera manifiesto para PWA en caso que se haya activado
            if ($PWA_ActivaNEW=="1")
                {
                    //Define si se cuenta o no con ID de GCM
                    $CadenaFinalGCM="";
                    if ($PWA_GCMSenderIDNEW!="")
                        $CadenaFinalGCM='"gcm_sender_id": "'.$PWA_GCMSenderIDNEW.'",
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
}',$IdiomaPredeterminado,$Nombre_Aplicacion,$Nombre_Aplicacion,$Version_Aplicacion,$Nombre_Empresa_Corto,$MULTILANG_PWADescripcion,$CadenaFinalGCM,$CadenaFinalScope,$PWA_DireccionTextoNEW,$PWA_DisplayNEW,$PWA_OrientacionNEW,$PCO_ColorFondoGeneral,$PCO_ColorFondoGeneral);

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
					echo '<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="Ver_menu">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorTiempoEjecucion.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
	if ($PCO_Accion=="guardar_oauth")
		{
			/*
				Function: guardar_oauth
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
	\$APIWithings_Template='%s';",$APIGoogle_ClientIdNEW,$APIGoogle_ClientSecretNEW,$APIGoogle_RedirectUriNEW,$APIGoogle_TemplateNEW,$APIFacebook_ClientIdNEW,$APIFacebook_ClientSecretNEW,$APIFacebook_RedirectUriNEW,$APIFacebook_TemplateNEW,$APITwitter_ClientIdNEW,$APITwitter_ClientSecretNEW,$APITwitter_RedirectUriNEW,$APITwitter_TemplateNEW,$APIDropbox_ClientIdNEW,$APIDropbox_ClientSecretNEW,$APIDropbox_RedirectUriNEW,$APIDropbox_TemplateNEW,$APIFlickr_ClientIdNEW,$APIFlickr_ClientSecretNEW,$APIFlickr_RedirectUriNEW,$APIFlickr_TemplateNEW,$APIMicrosoft_ClientIdNEW,$APIMicrosoft_ClientSecretNEW,$APIMicrosoft_RedirectUriNEW,$APIMicrosoft_TemplateNEW,$APIFoursquare_ClientIdNEW,$APIFoursquare_ClientSecretNEW,$APIFoursquare_RedirectUriNEW,$APIFoursquare_TemplateNEW,$APIBitbucket_ClientIdNEW,$APIBitbucket_ClientSecretNEW,$APIBitbucket_RedirectUriNEW,$APIBitbucket_TemplateNEW,$APISalesforce_ClientIdNEW,$APISalesforce_ClientSecretNEW,$APISalesforce_RedirectUriNEW,$APISalesforce_TemplateNEW,$APIYahoo_ClientIdNEW,$APIYahoo_ClientSecretNEW,$APIYahoo_RedirectUriNEW,$APIYahoo_TemplateNEW,$APIBox_ClientIdNEW,$APIBox_ClientSecretNEW,$APIBox_RedirectUriNEW,$APIBox_TemplateNEW,$APIDisqus_ClientIdNEW,$APIDisqus_ClientSecretNEW,$APIDisqus_RedirectUriNEW,$APIDisqus_TemplateNEW,$APIRightSignature_ClientIdNEW,$APIRightSignature_ClientSecretNEW,$APIRightSignature_RedirectUriNEW,$APIRightSignature_TemplateNEW,$APIFitbit_ClientIdNEW,$APIFitbit_ClientSecretNEW,$APIFitbit_RedirectUriNEW,$APIFitbit_TemplateNEW,$APIScoopIt_ClientIdNEW,$APIScoopIt_ClientSecretNEW,$APIScoopIt_RedirectUriNEW,$APIScoopIt_TemplateNEW,$APITumblr_ClientIdNEW,$APITumblr_ClientSecretNEW,$APITumblr_RedirectUriNEW,$APITumblr_TemplateNEW,$APIStockTwits_ClientIdNEW,$APIStockTwits_ClientSecretNEW,$APIStockTwits_RedirectUriNEW,$APIStockTwits_TemplateNEW,$APILinkedIn_ClientIdNEW,$APILinkedIn_ClientSecretNEW,$APILinkedIn_RedirectUriNEW,$APILinkedIn_TemplateNEW,$APIInstagram_ClientIdNEW,$APIInstagram_ClientSecretNEW,$APIInstagram_RedirectUriNEW,$APIInstagram_TemplateNEW,$APISurveyMonkey_ClientIdNEW,$APISurveyMonkey_ClientSecretNEW,$APISurveyMonkey_RedirectUriNEW,$APISurveyMonkey_TemplateNEW,$APIEventful_ClientIdNEW,$APIEventful_ClientSecretNEW,$APIEventful_RedirectUriNEW,$APIEventful_TemplateNEW,$APIXING_ClientIdNEW,$APIXING_ClientSecretNEW,$APIXING_RedirectUriNEW,$APIXING_TemplateNEW,$APIVK_ClientIdNEW,$APIVK_ClientSecretNEW,$APIVK_RedirectUriNEW,$APIVK_TemplateNEW,$APIWithings_ClientIdNEW,$APIWithings_ClientSecretNEW,$APIWithings_RedirectUriNEW,$APIWithings_TemplateNEW);

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
					echo '<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="Ver_menu">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorTiempoEjecucion.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}