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