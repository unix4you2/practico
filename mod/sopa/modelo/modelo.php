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


/* ################################################################## */
/* ################################################################## */
/*
	Function: ObtenerEntradas_FacebookFanPage
	Recupera el JSON con la informacion de una FanPage de Facebook y retorna su ID solamente
	
	Variables de entrada:

		Nombre_FanPage - Nombre de la fan page (en caso de no tener el ID)
        ID_FanPage - ID de la fan page para consulta directa (cuando se tiene)
        FormatoProveedor - Establece el formato como se entregan las entradas por el proveedor:  rss20 | atom10 
        Cantidad - Numero de entradas a ser devueltas
        FormatoSalida - Establece el formato en que deben devolverse los datos:  crudo | arreglo
		
	Salida:
		Retorna variable con las entradas del Feed
*/
function ObtenerEntradas_FacebookFanPage($Nombre_FanPage="", $ID_FanPage="", $Cantidad=1, $FormatoProveedor="rss20", $FormatoSalida="arreglo")
    {
        //Por defecto inicia en blanco si es formato crudo
        if ($FormatoSalida=="crudo")
            $EntradasFanPage="";
        //Si el ID de consulta directa es vacio intenta averiguarlo con el nombre
        if ($ID_FanPage=="" && $Nombre_FanPage!="")
            {
                $ID_FanPage=Obtener_IDFanPage($Nombre_FanPage);
            }
        //Cuando ya se cuenta con un ID de FanPage hace la consulta
        if ($ID_FanPage!="")
            {
                $URL_Recuperacion="https://www.facebook.com/feeds/page.php?id=$ID_FanPage&format=$FormatoProveedor";
                $contenido_url = @cargar_url($URL_Recuperacion);
                //Si se ha obtenido respuesta entonces procesa entradas
                if ($contenido_url!="")
                    {
                        // Usa SimpleXML Directamente para interpretar respuesta
                        $EntradasObtenidas = simplexml_load_string($contenido_url);
                        // Procesa la respuesta recibida en el XML
                        $NumEntradaProcesada=1;
                        
                        //Procesa si el formato recibido es RSS 2.0
                        if ($FormatoProveedor="rss20")
                            {
                                foreach($EntradasObtenidas->channel->item as $Entrada)
                                    {
                                        //Si el formato es crudo agrega entrada como concatenacion
                                        if ($FormatoSalida=="crudo")
                                            {
                                                $EntradasFanPage.=$Entrada->title;
                                                $EntradasFanPage.=$Entrada->description;
                                                $EntradasFanPage.=$Entrada->link;
                                                $EntradasFanPage.=$Entrada->pubDate;
                                            }
                                        //Si el formato es arreglo agrega entrada como elemento del arreglo
                                        if ($FormatoSalida=="arreglo")
                                            {
                                                $EntradasFanPage[]=@array(Titulo => $Entrada->title, Descripcion => $Entrada->description,	Enlace => $Entrada->link, Fecha => $Entrada->pubDate);
                                            }
                                        //Cuenta la entrada procesada y se detiene segun las deseadas
                                        $NumEntradaProcesada++;
                                        if($NumEntradaProcesada > $Cantidad)
                                            break;
                                    }
                            }
                    }
            }
        return $EntradasFanPage;
    }

