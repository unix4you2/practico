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
	Function: servir_sopa
	Ejecuta el lanzador de SO.PA. (Social Parser) de Practico

	Salida:
		Opciones del SOPA - Demostracion
*/
if ($accion=="servir_sopa") 
	{
        //Llamado a la funcion SOPA de Practico (Cuidado: es multiparametro o polimorfica)
        $EntradasFaceBook = ObtenerEntradas_FacebookFanPage("", "47562714382",3);
        //Despliegue de resultados
        DemoVista_SOPA_Facebook($EntradasFaceBook);
	}
