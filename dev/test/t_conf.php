<?php
	/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2012-2022
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
	--------------------
	   Set de pruebas
	--------------------
	DESCRIPCION:    Archivo de configuracion usado como origen en instalaciones automatizadas en entornos de prueba
	CODIGO:         cp dev/test/t_conf.php /var/www/html/practico/configuracion.php

	*/

	$ServidorBD='localhost';	// Direccion IP o nombre de host
	$BaseDatos='practico';   // Path completo cuando se trata de sqlite2, ej: '/path/to/database.sdb'
	$UsuarioBD='root';
	$PasswordBD='root';
	$MotorBD='mysql';		// Puede variar segun el driver PDO: mysql|pgsql|sqlite|sqlsrv|mssql|ibm|dblib|odbc|oracle|ifmx|fbd
	$PuertoBD='';	// Vacio para predeterminado

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

	$NombreRAD='Practico';
	$ArchivoCORE='';
	$TablasCore='core_';  // Cuidado al cambiar: Prefijo de Tablas base para uso de Practico
	$TablasApp='app_';  // Cuidado al cambiar: Prefijo para Tablas de datos definidas por el usuario
	$LlaveDePaso='H76T9QFT7P';  // Valor unico para firmar los usuarios del aplicativo.  No debe ser cambiado despues de puesto en marcha a menos que se haga un update manual el usuario que no coincida con la llave no podra ingresar.
	$ModoDepuracion=0;
	$PermitirReporteBugs=1;
	$DepuracionSQL=0;
	$BuscarActualizaciones=0;

	$ZonaHoraria='America/Bogota';
	$IdiomaPredeterminado='es';
	$IdiomaEnLogin=1;
	$Tema_PracticoFramework='bootstrap';
	$PCO_ArchivoImagenFondo='';
	$PCO_TransformacionColores='';
    $PCO_PermitirUsuariosModoNoche='1';

	$TipoCaptchaLogin='visual';
	$CaracteresCaptcha=4;
	$CodigoGoogleAnalytics='G-ZKZP142B9V';
	
	// Tipo de motor usado para la autenticacion de usuarios
	$Auth_TipoMotor='practico';
	$Auth_ProtoTransporte='';
	$Auth_PermitirReseteoClaves='0';
	$Auth_PermitirAutoRegistro='0';
	$Auth_PlantillaAutoRegistro='';
	$Auth_PresentarOauthInicio='0';

	// Configuracion LDAP - Auth_TipoMotor=ldap
	$Auth_TipoEncripcion='plano';
	$Auth_LDAPServidor='172.29.196.181';
	$Auth_LDAPPuerto='3269';
	$Auth_LDAPDominio='practico.org';
	$Auth_LDAPOU='GrupoGenerico';

	// Especifica si desea activar o no el modulo de chat para usuarios asi:
	// 0=No, 1=Solo usuarios internos, 2=Solo usuarios externos, 3=Todos los usuarios, 4=Exclusivo para admin (podra iniciar conversacion y chat con cualquier otro usuario aun con modulo desactivado)
	$Activar_ModuloChat=0;
	
	// Especifica si desea activar o no el registro de la aplicacion como una Aplicacion web progresiva PWA y algunos permisos de usuario
	$PWA_Activa=1;
	$PWA_DireccionTexto='auto';
	$PWA_Display='fullscreen';
	$PWA_Orientacion='portrait';
	$PWA_FCMSenderID='103953800507';
	$PWA_Scope='';
	$PWA_AutorizacionGPS='0';
	$PWA_AutorizacionFCM='0';
	$PWA_AutorizacionCAM='1';
	$PWA_AutorizacionMIC='0';
	$PWA_OcultarBarrasHerramientas='0';

	// Define cadena usada para separar campos en operaciones de bases de datos
	$_SeparadorCampos_='||_||';
	
	// Define si la plataforma se encuentra activa para realizar desarrollo interno de PracticoFramework
	$ModoDesarrolladorPractico=0; // [0=Inactivo|-10000=Activo]

	// Define cadena separada por comas con usuarios administradores de la aplicacion
	$PCOVAR_Administradores='admin,john.arroyave';