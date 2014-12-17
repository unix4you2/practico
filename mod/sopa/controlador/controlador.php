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


	// 1. Llama al modelo, encargado de abstraer las operaciones de consulta a BD
	//require($ruta_modelos.'modelo.php');
	// 2. Pasa los datos generados por una funcion existente en el modelo a un variable independiente
	//$registros = getAuditoria();
	// 3. Llama a la vista, encargada de presentar los datos genericos entregados desde el modelo
	//require($ruta_vistas.'vista.php');




/* ################################################################## */
/* ################################################################## */
/*
	Function: Obtener_IDFanPage
	Recupera el JSON con la informacion de una FanPage de Facebook y retorna su ID solamente
	
	Variables de entrada:

		Nombre_FanPage - Nombre de la fan page de la que se desea obtener el ID
		
	Salida:
		Retorna el ID de pagina
*/
function Obtener_IDFanPage($Nombre_FanPage="")
    {
        $ID_Obtenido="";
        $URL_Recuperacion="https://graph.facebook.com/$Nombre_FanPage";
        $contenido_url = @cargar_url($URL_Recuperacion);
        //Si se ha obtenido respuesta entonces procesa el JSON
        if ($contenido_url!="")
            {
                $JSON_Decodificado = json_decode($contenido_url);
                /*echo '<pre>'; // Esto para que sea mas legible
                var_dump($JSON_Decodificado);
                echo '</pre>';*/
            }
        return $ID_Obtenido;
    }


/* ################################################################## */
/* ################################################################## */
/*
	Function: ObtenerEntradas_FacebookFanPage
	Recupera el JSON con la informacion de una FanPage de Facebook y retorna su ID solamente
	
	Variables de entrada:

		Nombre_FanPage - Nombre de la fan page (en caso de no tener el ID)
        ID_FanPage - ID de la fan page para consulta directa (cuando se tiene)
        Formato - Establece el formato de salida de las entradas:  rss20 | atom10 
        Cantidad - Numero de entradas a ser devueltas
		
	Salida:
		Retorna variable con las entradas del Feed
*/
function ObtenerEntradas_FacebookFanPage($Nombre_FanPage="", $ID_FanPage="", $Formato="rss20", $Cantidad=1)
    {
        //Por defecto inicia en blanco
        $EntradasFanPage="";
        //Si el ID de consulta directa es vacio intenta averiguarlo con el nombre
        if ($ID_FanPage=="" && $Nombre_FanPage!="")
            {
                $ID_FanPage=Obtener_IDFanPage($Nombre_FanPage);
            }
        //Cuando ya se cuenta con un ID de FanPage hace la consulta
        if ($ID_FanPage!="")
            {
                $URL_Recuperacion="https://www.facebook.com/feeds/page.php?id=$ID_FanPage&format=$Formato";
                $contenido_url = @cargar_url($URL_Recuperacion);
                //Si se ha obtenido respuesta entonces procesa entradas
                if ($contenido_url!="")
                    {
                        // Usa SimpleXML Directamente para interpretar respuesta
                        $EntradasObtenidas = simplexml_load_string($contenido_url);
                        // Procesa la respuesta recibida en el XML
                        $NumEntradaProcesada=1;
                        
                        //Procesa si el formato recibido es RSS 2.0
                        if ($Formato="rss20")
                            {
                                foreach($EntradasObtenidas->channel->item as $Entrada)
                                    {
                                        $EntradasFanPage.=$Entrada->title;
                                        $EntradasFanPage.=$Entrada->description;
                                        $EntradasFanPage.=$Entrada->link;
                                        $NumEntradaProcesada++;
                                        if($NumEntradaProcesada > $Cantidad){
                                            break;
                                        }
                                    }
                            }
                    }
                else
                    {
                        $EntradasFanPage="";
                    }
            }
        return $EntradasFanPage;
    }

