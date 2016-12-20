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
	$BuscarActualizaciones=0;
	$ZonaHoraria='America/Bogota';
	$IdiomaPredeterminado='es';
	$CaracteresCaptcha=4;
	$CodigoGoogleAnalytics='UA-847800-9';
	
	// Tipo de motor usado para la autenticacion de usuarios
	$Auth_TipoMotor='practico';
	$Auth_ProtoTransporte='http';
	$Auth_PermitirReseteoClaves='1';
	$Auth_PermitirAutoRegistro='1';
	$Auth_PlantillaAutoRegistro='';

	// Configuracion LDAP - Auth_TipoMotor=ldap
	$Auth_TipoEncripcion='plano';
	$Auth_LDAPServidor='';
	$Auth_LDAPPuerto='';
	$Auth_LDAPDominio='';
	$Auth_LDAPOU='';
	
	// Especifica si desea activar o no el modulo de chat para usuarios asi:
	// 0=No, 1=Solo usuarios internos, 2=Solo usuarios externos, 3=Todos los usuarios, 4=Exclusivo para admin (podra iniciar conversacion y chat con cualquier otro usuario aun con modulo desactivado)
	$Activar_ModuloChat=0;
	
	// Define cadena usada para separar campos en operaciones de bases de datos
	$_SeparadorCampos_='||_||';
	
	// Define cadena separada por comas con usuarios administradores de la aplicacion
	$PCOVAR_Administradores='admin';

	$PCOVAR_ProvedorSMTP="Interno";
