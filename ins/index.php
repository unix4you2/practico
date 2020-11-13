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