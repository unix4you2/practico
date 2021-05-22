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
                $contenido_url = @PCO_CargarURL($URL_Recuperacion);
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