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
	$ModoDesarrolladorPractico=-10000; // [0=Inactivo|-10000=Activo]

	// Define cadena separada por comas con usuarios administradores de la aplicacion
	$PCOVAR_Administradores='admin';