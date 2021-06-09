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
        $contenido_url = @PCO_CargarURL($URL_Recuperacion);
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
	Function: servir_sopa
	Ejecuta el lanzador de SO.PA. (Social Parser) de Practico

	Salida:
		Opciones del SOPA - Demostracion
*/
if ($PCO_Accion=="servir_sopa") 
	{
        //Llamado a la funcion SOPA de Practico (Cuidado: es multiparametro o polimorfica)
        $EntradasFaceBook = ObtenerEntradas_FacebookFanPage("", "47562714382",3);
        //Despliegue de resultados
        DemoVista_SOPA_Facebook($EntradasFaceBook);
	}