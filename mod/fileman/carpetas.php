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
	
	// Valida sesion activa de Practico
	@session_start();

	//Captura nombre de usuario desde la sesion
	$Usuario_activo=$_SESSION["PCOSESS_LoginUsuario"];
	
	if ($Usuario_activo=="") die(); //Termina ejecucion si no hay un usuario valido en la sesion


/* ################################################################## */
/* ################################################################## */
/*
	// Function: PCO_EsAdministrador
	Determina si un login de usuario es administrador de plataforma o no (si es super usuario)
	
	Variables de entrada:

		Usuario - Login de usuario a verificar

	Salida:
		Cero (0) o uno (1) segun la pertenencia o no del usuario al grupo de admins
*/
    include ("../../../../core/configuracion.php");
	function PCO_EsAdministrador($Usuario)
		{
			global $PCOVAR_Administradores;
			$ArregloAdmins=explode(",",$PCOVAR_Administradores);

			//Recorre el arreglo de super-usuarios
			$Resultado = 0;
			if ($Usuario!="")
				foreach ($ArregloAdmins as $UsuarioAdmin)
					{
						if (trim($UsuarioAdmin)==$Usuario)
							$Resultado = 1;
					}
			return $Resultado;
		}


/* ################################################################## */
/* ################################################################## */
	//Si el usuario es el admin cambia la definicion de raices para agregar una que permite ver todos los usuarios
	if (PCO_EsAdministrador(@$Usuario_activo))
		{
            $Partes_Directorio_instalacion = explode(DIRECTORY_SEPARATOR, getcwd());
            $Directorio_instalacion= $Partes_Directorio_instalacion[count($Partes_Directorio_instalacion)-5];

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
									'path'          => '../../../../../'.$Directorio_instalacion.'/',         // path to files (REQUIRED)
									'URL'           => dirname($_SERVER['PHP_SELF']) . '/../../../../../'.$Directorio_instalacion.'/', // URL to files (REQUIRED)
									'alias' 		=> 'Raiz de '.$Directorio_instalacion,
									'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
								)
							//Agrega raiz para la carpeta compartida general ubicada en archivos/_publico_
							,
							array
								(
									'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
									'path'          => '../../cargas/',         // path to files (REQUIRED)
									'URL'           => dirname($_SERVER['PHP_SELF']) . '/../../cargas/', // URL to files (REQUIRED)
									'alias' 		=> 'Cargas por formulario',
									'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
								)
                    // 		// Trash volume
                    // 		,
                    // 		array(
                    // 			'id'            => '1',
                    // 			'driver'        => 'Trash',
                    // 			'path'          => '../../archivos/.trash/',         // path to files (REQUIRED)
                    // 			'winHashFix'    => DIRECTORY_SEPARATOR !== '/', // to make hash same to Linux one on windows too
                    // 			'uploadDeny'    => array('all'),                // Recomend the same settings as the original volume that uses the trash
                    // 			'uploadAllow'   => array('image', 'text/plain'),// Same as above
                    // 			'uploadOrder'   => array('deny', 'allow'),      // Same as above
                    // 			'accessControl' => 'access',                    // Same as above
                    // 		)

						)
				);
		}

	//Si el usuario es diferente al admin agrega solo raiz a la carpeta publica y a la personal
	if (PCO_EsAdministrador(@$Usuario_activo)==0 && $Usuario_activo!="")
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