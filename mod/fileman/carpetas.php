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
	
	// Valida sesion activa de Practico
	@session_start();

	//Captura nombre de usuario desde la sesion
	$Usuario_activo=$_SESSION["Login_usuario"];
	
	if ($Usuario_activo=="") die(); //Termina ejecucion si no hay un usuario valido en la sesion

	//Si el usuario es el admin cambia la definicion de raices para agregar una que permite ver todos los usuarios
	if ($Usuario_activo=="admin")
		{
			$opts = array
				(
					// 'debug' => true,
					'roots' => array
						(
							//Agrega raiz para la carpeta compartida general ubicada en archivos/_publico_
							array
								(
									'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
									'path'          => '../../archivos/_publico_/',         // path to files (REQUIRED)
									'URL'           => dirname($_SERVER['PHP_SELF']) . '/../../archivos/_publico_/', // URL to files (REQUIRED)
									'alias' 		=> 'Carpeta publica',
									'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
								)
							//Agrega raiz para la carpeta personal
							,
							array
								(
									'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
									'path'          => '../../archivos/'.$Usuario_activo.'/',         // path to files (REQUIRED)
									'URL'           => dirname($_SERVER['PHP_SELF']) . '/../../archivos/'.$Usuario_activo.'/', // URL to files (REQUIRED)
									'alias' 		=> 'Mis archivos',
									'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
								)
							//Agrega raiz de todos los archivos de usuario
							,
							array
								(
									'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
									'path'          => '../../archivos/',         // path to files (REQUIRED)
									'URL'           => dirname($_SERVER['PHP_SELF']) . '/../../archivos/', // URL to files (REQUIRED)
									'alias' 		=> 'Todos los usuarios',
									'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
								)
							//Agrega raiz de todos los archivos de la aplicacion siempre y cuando la instalacion haya sido desplegada sobre la carpeta practico
							,
							array
								(
									'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
									'path'          => '../../../../../practico/',         // path to files (REQUIRED)
									'URL'           => dirname($_SERVER['PHP_SELF']) . '/../../../../../practico/', // URL to files (REQUIRED)
									'alias' 		=> 'Raiz de Practico',
									'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
								)
						)
				);
		}

	//Si el usuario es diferente al admin agrega solo raiz a la carpeta publica y a la personal
	if ($Usuario_activo!="admin" && $Usuario_activo!="")
		{
			$opts = array
				(
					// 'debug' => true,
					'roots' => array
						(
							//Agrega raiz para la carpeta compartida general ubicada en archivos/_publico_
							array
								(
									'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
									'path'          => '../../archivos/_publico_/',         // path to files (REQUIRED)
									'URL'           => dirname($_SERVER['PHP_SELF']) . '/../../archivos/_publico_/', // URL to files (REQUIRED)
									'alias' 		=> 'Carpeta publica',
									'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
								)
							//Agrega raiz para la carpeta personal
							,
							array
								(
									'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
									'path'          => '../../archivos/'.$Usuario_activo.'/',         // path to files (REQUIRED)
									'URL'           => dirname($_SERVER['PHP_SELF']) . '/../../archivos/'.$Usuario_activo.'/', // URL to files (REQUIRED)
									'alias' 		=> 'Mis archivos',
									'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
								)
						)
				);
		}

?>
