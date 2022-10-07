<?php
/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2012-2022
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
	====================================
	   Set de pruebas: CodeQL y Otros
	====================================
	DESCRIPCION:    Archivo de configuracion usado como origen en instalaciones automatizadas en entornos de prueba
	CODIGO QL:      cp /var/www/html/practico/dev/test/ga_configuracion.php /var/www/html/practico/configuracion.php
	
*/
$ServidorBD='localhost';
$BaseDatos='practico_testqa';       //Base de datos en la maquina de pruebas C.I.
$UsuarioBD='root';
$PasswordBD='root';                 //Password de motor en maquina de pruebas C.I.
$MotorBD='mysql';
$PuertoBD='';
$NombreRAD='Practico';
$ArchivoCORE='';
$TablasCore='core_';
$TablasApp='app_';
$LlaveDePaso='H76T9QFT7P';
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
$Auth_TipoMotor='practico';
$Auth_ProtoTransporte='';
$Auth_PermitirReseteoClaves='0';
$Auth_PermitirAutoRegistro='0';
$Auth_PlantillaAutoRegistro='';
$Auth_PresentarOauthInicio='0';
$Auth_TipoEncripcion='plano';
$Auth_LDAPServidor='172.29.196.181';
$Auth_LDAPPuerto='3269';
$Auth_LDAPDominio='practico.org';
$Auth_LDAPOU='GrupoGenerico';
$Activar_ModuloChat=0;
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
$_SeparadorCampos_='||_||';
$ModoDesarrolladorPractico=0;
$PCOVAR_Administradores='admin,john.arroyave';