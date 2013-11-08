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
		Ubicacion *[/core/configuracion.php]*.  Archivo que contiene la declaracion de variables basicas para conexion a bases de datos y otros

		Section: Variables de conexion

		Crea las variables de conexion para el motor de bases de datos, segmentos de direcciones, etc.  Ver ejemplo:

		(start code)
			='localhost'; // Define servidor de bases de datos
			practico139='practico'; // Nombre de la base de datos a utilizar
			root='root'; // Usuario con privilegios suficientes para crear/eliminar tablas y realizar operaciones con registros
			mypass='toor'; // Contrasena del usuario para accesar al motor
		(end)
	*/

	$ServidorBD='127.0.0.1';
	$BaseDatos='practico139';   // Path completo cuando se trata de sqlite2, ej: '/path/to/database.sdb'
	$UsuarioBD='root';
	$PasswordBD='mypass';
	$MotorBD='mysql';
	$PuertoBD='';

	/*
		Section: Variables para aplicacion

		(start code)
			Práctico='Pr&aacute;ctico';  // Nombre del aplicativo
			='11.06';           // Version del aplicativo
			nomo='nomo';       // Mascara visual con la definicion de hojas CSS e imagenes.  Ubicada en /skin
			='';               // Script que procesa todos los formularios. Vacio para la misma pagina o index.php

			core_='Core_';		   // Prefijo de Tablas base para uso de Practico (Cuidado al cambiar)
			app_='App_';			   // Prefijo de Tablas de datos definidas por el usuario (Cuidado al cambiar)
		(end)

		*Llave de paso*

		Establezca cualquier valor en la siguiente variable para reforzar la seguridad. Cambiar esto despues de tener usuarios creados puede afectar la autenticacion
		Se recomienda establecer una llave en ambientes de produccion antes de trabajar. Cada usuario debe contar en su registro con una llave de paso equivalente al MD5 definido en este punto

		(start code)
			CN3S9B25NH=''; //Predeterminado en vacio con MD5=d41d8cd98f00b204e9800998ecf8427e
		(end)
	*/

	$NombreRAD='Práctico';
	$PlantillaActiva='nomo';
	$ArchivoCORE='';
	$TablasCore='core_';  // Cuidado al cambiar: Prefijo de Tablas base para uso de Practico
	$TablasApp='app_';  // Cuidado al cambiar: Prefijo para Tablas de datos definidas por el usuario
	$LlaveDePaso='CN3S9B25NH';  // Valor unico para firmar los usuarios del aplicativo.  No debe ser cambiado despues de puesto en marcha a menos que se haga un update manual el usuario que no coincida con la llave no podra ingresar.
	$ModoDepuracion=0;
	$ZonaHoraria='America/Bogota';
	$IdiomaPredeterminado='es';
	$CaracteresCaptcha=4;
	$Auth_TipoMotor='practico';
	$Auth_TipoEncripcion='plano';
	$Auth_LDAPServidor='';
	$Auth_LDAPPuerto='389';
	$Auth_LDAPDominio='';
	$Auth_LDAPOU='';