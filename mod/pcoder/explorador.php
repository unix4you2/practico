<?php
	/*
	   PCODER (Editor de Codigo en la Nube)
	   Copyright (C) 2013  John F. Arroyave Gutiérrez
						   unix4you2@gmail.com
						   www.practico.org

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
	*/

    // BLOQUE BASICO DE INCLUSION ######################################
    // Inicio de la sesion
    @session_start();
	// Agrega las variables de sesion
	if (!empty($_SESSION)) extract($_SESSION);

    //Permite WebServices propios mediante el acceso a este script en solicitudes Cross-Domain
    header('Access-Control-Allow-Origin: *');
	header('Content-type: text/html; charset=utf-8');

    //Incluye archivo inicial de configuracion
	include_once("inc/configuracion.php");

	// Determina si no se trabaja en modo StandAlone y verifica entonces credenciales
	if ($PCO_PCODER_StandAlone==0)
		{
			// Valida sesion activa de Practico
			if (!isset($PCOSESS_SesionAbierta)) 
				{
					echo '<head><title>Error</title><style type="text/css"> body { background-color: #000000; color: #7f7f7f; font-family: sans-serif,helvetica; } </style></head><body><table width="100%" height="100%" border=0><tr><td align=center>&#9827; Acceso no autorizado !</td></tr></table></body>';
					die();
				}
		}
    // FIN BLOQUE BASICO DE INCLUSION ##################################

    // Recupera variables recibidas para su uso como globales (equivale a register_globals=on en php.ini)
    if (!ini_get('register_globals'))
    {
        $PCO_PBROWSER_NumeroParametros = count($_REQUEST);
        $PCO_PBROWSER_NombresParametros = array_keys($_REQUEST);// obtiene los nombres de las varibles
        $PCO_PBROWSER_ValoresParametros = array_values($_REQUEST);// obtiene los valores de las varibles
        // crea las variables y les asigna el valor
        for($i=0;$i<$PCO_PBROWSER_NumeroParametros;$i++)
            {
                $$PCO_PBROWSER_NombresParametros[$i]=$PCO_PBROWSER_ValoresParametros[$i];
            }
        // Agrega ademas las variables de sesion
        if (!empty($_SESSION)) extract($_SESSION);
    }
?>

 <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
<head>
	<title>{P}Explorador</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="generator" content="PCoder <?php  echo $PCO_PCODER_VersionActual; ?>" />
 	<meta name="description" content="Editor de codigo en la Nube basado en Practico Framework PHP" />
    <meta name="author" content="John Arroyave G. - {www.practico.org} - {unix4you2 at gmail.com}">

    <!-- Agrega archivos necesarios para el Explorador en arbol de directorios -->
    <link href="lib/phpFileTree/styles/default/default.css" rel="stylesheet" type="text/css" media="screen" />
    <script src="lib/phpFileTree/php_file_tree.js" type="text/javascript"></script>
    
	 <style type="text/css">
		.php-file-tree A {
			color: #FFFFFF;
			text-decoration: none;
		}
		
		.php-file-tree A:hover {
			color: #FFFF00;
		}
	</style>
</head>
<body>


<?php
	// Clase para exploracion de archivos
	include_once("lib/phpFileTree/php_file_tree.php");

	/* ################################################################## */
	/* ################################################################## */
	/*
		Function: PCOMOD_ExplorarPath
		Presenta los archivos existentes en un Path determinado, junto con las opciones para su procesamiento

		Entradas:

			Normalmente los parametros son: ?PCO_PCODER_Accion=PCOMOD_ExplorarPath&PathExploracion=.

		Salida:
			Listado de archivos y carpetas
	*/
	if ($PCO_PCODER_Accion=="PCOMOD_ExplorarPath") 
		{
			//Presenta el arbol de carpetas.  Ver archivo configuracion.php
			//Valida ademas si se puede abrir cualquier tipo de extension o solo algunas
			if ($PCO_PCODER_ForzarExtensionesConocidas==1)
				echo @php_file_tree($PathExploracion, "javascript:parent.PCODER_CargarArchivo('[link]');",$PCO_PCODER_ExtensionesPermitidas);
			else
				echo @php_file_tree($PathExploracion, "javascript:parent.PCODER_CargarArchivo('[link]');");
		}
?>

