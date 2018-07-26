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

	$NombreRAD="Pr&aacute;ctico";
	date_default_timezone_set("America/Bogota");
	$PCO_FechaOperacion=date("Ymd");
	$PCO_FechaOperacionGuiones=date("Y-m-d");
	$PCO_HoraOperacion=date("His");
	$PCO_HoraOperacionPuntos=date("H:i");
	$PCO_DireccionAuditoria=$_SERVER ['REMOTE_ADDR'];

	// Quitar comentario si se desea modo depuracion en proceso de instalacion
	ini_set("display_errors", 1);
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	// Recupera variables recibidas para su uso como globales (como si tuviese register_globals=on en php.ini)
	if (!ini_get('register_globals'))
	{
		$PCO_NumeroParametros = count($_REQUEST);
		$PCO_NombresParametros = array_keys($_REQUEST);// obtiene los nombres de las varibles
		$PCO_ValoresParametros = array_values($_REQUEST);// obtiene los valores de las varibles
		// crea las variables y les asigna el valor
		for($i=0;$i<$PCO_NumeroParametros;$i++)
			{
				${$PCO_NombresParametros[$i]}=$PCO_ValoresParametros[$i];
			}
		// Agrega ademas las variables de sesion
		if (!empty($_SESSION)) extract($_SESSION);
		//foreach($HTTP_POST_VARS as $postvar => $postval){ ${$postvar} = $postval; }
		//foreach($HTTP_GET_VARS as $getvar => $getval){ ${$getvar} = $getval; }		  
	}

	// Valida si se esta en modo desarrollador y protege carpetas de instalacion
    if (file_exists('../core/configuracion.php')) {
        include '../core/configuracion.php';
        if ($ModoDesarrolladorPractico=="-10000")
            die ("Modo desarrollador de Practico Framework activado. Cualquier instalacion es suspendida.");
    }

	//Crea un archivo para probar acceso de escritura, luego lo elimina
	function temp_file($archivo)
		{
			$fp=fopen($archivo,"w");
			if ($fp==NULL)
				return false;
			fwrite($fp,"x",1);
			fclose($fp);
			if (!is_file($archivo))
				return false;
			unlink($archivo);
			return true;
		}
		
	// Determina si se puede escribir en un directorio
	function puede_escribirse($archivo,$tipo=1) // dir pass with /   1=si es carpeta,2=si es archivo
		{
			if ($tipo==1)
				{
					if (is_dir($archivo))
						{
							$archivo.="/temp";
							return temp_file($archivo);
						}
					else
						if(is_file($archivo))
							{
								return temp_file($archivo);
							}
						else
							return false;
				}
			if ($tipo==2)
				{
					return is_writable ($archivo);
				}
		}

	function informar_prueba_escritura($path_a_probar) // dir pass with / 
		{
			global $hay_error,$MULTILANG_Correcto,$MULTILANG_Error;
			echo "<li>Probando archivo/carpeta:&nbsp;&nbsp;&nbsp;".$path_a_probar."&nbsp;&nbsp;&nbsp;";
			if(puede_escribirse($path_a_probar))
				{
					echo '<b><font color="green">['.$MULTILANG_Correcto.']</font></b>';
				}
			else
				{
					echo  '<b><font color="red">['.$MULTILANG_Error.']</font></b>';
					$hay_error=1;
				}
		}

	include("../core/comunes.php");
	include("core/marco_arriba.php");
	
	//Determina paso actual de instalacion
	if(!isset($paso)) $paso=-1;

	PCO_AbrirVentana($MULTILANG_Instalacion.' - '.$MULTILANG_Paso.' '.$paso);
	include("paso_".$paso.".php");
	PCO_CerrarVentana();

	include("core/marco_abajo.php");
?>