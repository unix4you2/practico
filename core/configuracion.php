<?php
	/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2020
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
    Redistribution and use in source and binary forms, with or without
    modification, are permitted provided that the following conditions are met:
    
    1. Redistributions of source code must retain the above copyright notice, this
       list of conditions and the following disclaimer.
    
    2. Redistributions in binary form must reproduce the above copyright notice,
       this list of conditions and the following disclaimer in the documentation
       and/or other materials provided with the distribution.
    
    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS 'AS IS'
    AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
    IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
    DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
    FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
    DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
    SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
    CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
    OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
    OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.


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

	$ServidorBD='localhost';	// Direccion IP o nombre de host
	$BaseDatos='practico';   // Path completo cuando se trata de sqlite2, ej: '/path/to/database.sdb'
	$UsuarioBD='root';
	$PasswordBD='mypass';
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
	$CodigoGoogleAnalytics='UA-847800-9';
	
	// Tipo de motor usado para la autenticacion de usuarios
	$Auth_TipoMotor='practico';
	$Auth_ProtoTransporte='';
	$Auth_PermitirReseteoClaves='0';
	$Auth_PermitirAutoRegistro='0';
	$Auth_PlantillaAutoRegistro='';
	$Auth_PresentarOauthInicio='0';

	// Configuracion LDAP - Auth_TipoMotor=ldap
	$Auth_TipoEncripcion='plano';
	$Auth_LDAPServidor='';
	$Auth_LDAPPuerto='';
	$Auth_LDAPDominio='';
	$Auth_LDAPOU='';

	// Especifica si desea activar o no el modulo de chat para usuarios asi:
	// 0=No, 1=Solo usuarios internos, 2=Solo usuarios externos, 3=Todos los usuarios, 4=Exclusivo para admin (podra iniciar conversacion y chat con cualquier otro usuario aun con modulo desactivado)
	$Activar_ModuloChat=3;
	
	// Especifica si desea activar o no el registro de la aplicacion como una Aplicacion web progresiva PWA y algunos permisos de usuario
	$PWA_Activa=1;
	$PWA_DireccionTexto='auto';
	$PWA_Display='standalone';
	$PWA_Orientacion='portrait';
	$PWA_FCMSenderID='103953800507';
	$PWA_Scope='/practico/';
	$PWA_AutorizacionGPS='0';
	$PWA_AutorizacionFCM='0';
	$PWA_AutorizacionCAM='0';
	$PWA_AutorizacionMIC='0';
	$PWA_OcultarBarrasHerramientas='0';

	// Define cadena usada para separar campos en operaciones de bases de datos
	$_SeparadorCampos_='||_||';
	
	// Define si la plataforma se encuentra activa para realizar desarrollo interno de PracticoFramework
	$ModoDesarrolladorPractico=-10000; // [0=Inactivo|-10000=Activo]

	// Define cadena separada por comas con usuarios administradores de la aplicacion
	$PCOVAR_Administradores='admin,john.arroyave';