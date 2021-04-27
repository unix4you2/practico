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
    
    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
    AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
    IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
    DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
    FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
    DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
    SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
    CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
    OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
    OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
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