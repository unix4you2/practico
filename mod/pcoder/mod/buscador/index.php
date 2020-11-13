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

    // BLOQUE BASICO DE INCLUSION ######################################
    // Inicio de la sesion
    @session_start();

    //Permite WebServices propios mediante el acceso a este script en solicitudes Cross-Domain
    header('Access-Control-Allow-Origin: *');
    header('access-control-allow-credentials: true');
	header('Content-type: text/html; charset=utf-8');

    //Incluye archivo inicial de configuracion
	include_once("../../inc/configuracion.php");

    //Incluye idioma espanol, o sobreescribe vbles por configuracion de usuario
    include("../../idiomas/es.php");
    include("../../idiomas/".$IdiomaPredeterminado.".php");
    // FIN BLOQUE BASICO DE INCLUSION ##################################

    // Establece la zona horaria por defecto para la aplicacion
    date_default_timezone_set($ZonaHoraria);

    // Datos de fecha, hora y direccion IP para algunas operaciones
    $PCO_EXPLORER_FechaOperacion=date("Ymd");
    $PCO_EXPLORER_FechaOperacionGuiones=date("Y-m-d");
    $PCO_EXPLORER_HoraOperacion=date("His");
    $PCO_EXPLORER_HoraOperacionPuntos=date("H:i");
    $PCO_EXPLORER_DireccionAuditoria=$_SERVER ['REMOTE_ADDR'];

/* ################################################################## */
/* ################################################################## */


function ExplorarDirectorio($DirectorioExploracion)
	{
		global $TotalEncontrados,$SensibleMayuscula,$PatronBusqueda;
		if (is_dir($DirectorioExploracion)) 
			{
				if ($dh = opendir($DirectorioExploracion)) 
					{
						while (($file = readdir($dh)) !== false) 
							{
								if ($file != "." && $file != "..") 
									{
										//Determina la extension del archivo
										$Extension = preg_replace('/^.*\./', '', $file);
										
										//Si se desea sensible a mayuscula selecciona la funcion correcta strpos / stripos
										if ($SensibleMayuscula==1)
											$Posicion = strpos($file,$PatronBusqueda);
										else
											$Posicion = stripos($file,$PatronBusqueda);
				
										//Determina si el archivo cumple o no con el patron de busqueda
										if($Posicion===false)
											$CumplePatron=0;
										else
											$CumplePatron=1;
																				
										//Muestra el elemento si cumple con el patron de busqueda
										if ($CumplePatron==1)
											{						
												//OnDblClick=\"UltimoArchivoSeleccionado='"		  PCODER_CargarArchivo(path_operacion_elemento+"/"+nombre_elemento);				
												print '<li class="file ext_'.$Extension.'"><a OnDblClick="PCODER_CargarArchivo(\''.$DirectorioExploracion.'/'.$file.'\');" data-toggle="tooltip" data-placement="right" title="PATH: '.$DirectorioExploracion.'/">'.$file.'</a></li>';
												$TotalEncontrados++;
											}
										//Llamado recursivo a la funcion para revisar subcarpetas
										ExplorarDirectorio($DirectorioExploracion .  "/" . $file);
									}
							}
						closedir($dh);
					}
			}
	}

$SensibleMayuscula=$_REQUEST["SensibleMayuscula"];
$PatronBusqueda=$_REQUEST["PatronBusqueda"];
$DirectorioExploracion=$_REQUEST["DirectorioExploracion"];
if ($PatronBusqueda=="" || strlen($PatronBusqueda)<3)	$PatronBusqueda="__PATRON_NO_VALIDO__";
if ($DirectorioExploracion=="")	$DirectorioExploracion=".";

$TotalEncontrados=0;

//Hace el llamado inicial de exploracion
if($PatronBusqueda!="__PATRON_NO_VALIDO__")
	ExplorarDirectorio($DirectorioExploracion);

//Actualiza el marco con resumen de resultados
$CadenaResumen="<font color=white size=1><i>Resultados de \"<b>$PatronBusqueda</b>\" sobre <b>$DirectorioExploracion</b><br>Total: ".$TotalEncontrados." ".$MULTILANG_PCODER_Archivo."(s)</i></font>";
$CadenaResumen="<font color=white size=2><i><b>Total:</b> ".$TotalEncontrados." ".$MULTILANG_PCODER_Archivo."(s)</i></font>";
echo "
<script language='JavaScript'>
$('#resumen_buscador_archivo').html('$CadenaResumen');
RecargarToolTipsEnlaces();
</script>";