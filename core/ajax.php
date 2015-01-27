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

	/*
		Title: Modulo ajax
		Ubicacion *[/core/ajax.php]*.  Archivo de funciones utilizadas para el retorno de informacion mediante peticiones asincronas

		Section: Controles de datos
		Funciones asociadas a generacion de controles de datos basados en los parametros recibidos
	*/
?>


<?php


/* ################################################################## */
/* ################################################################## */
/*
	Function: opciones_combo_box
	Hace una consulta a la base de datos y retorna las opciones a desplegar en una lista de seleccion o combobox

	Variables de entrada:

        origen_lista_tablas - Lista de tablas separadas por coma
        origen_lista_opciones - Campo que sera agregado al select para obtener la lista de opciones
        origen_lista_valores -  Campo que sera agregado al select para obtener la lista de valores
        condicion_filtrado_listas - Condiones a ser agregadas en el where para filtrar los registros
        PCO_Prefijo - Cadena para anteponer a las opciones.  Podria recibir algo como un  <option value="  para inciar opciones de un combo o un | para otros usos (por ejemplo)
        PCO_Infijo - Cadena para agregar entre el valor y la opcion visual.  Podria recibir algo como un  ">  para cerrar opciones de un combo o un | para otros usos (por ejemplo)
        PCO_Posfijo - Cadena para agregar al final de cada opcion.  Podria recibir algo como un  </option>  para inciar opciones de un combo o un | para otros usos (por ejemplo)

	Salida:
		Lista de elementos < option > usados en el combo

*/
	if ($PCO_Accion=="opciones_combo_box") 
		{           
            $PCO_MensajeError="";
            $PCO_SalidaCombos="";
            //Valida variables minimas para la consulta
            if (@$origen_lista_tablas=="" || @$origen_lista_opciones=="" || @$origen_lista_valores=="")
                {
                    $PCO_MensajeError.="<option>[Error] Parametros de seleccion</option>";
                    if (@$origen_lista_tablas=="") $PCO_MensajeError.="<option>[Causa] Falta origen_lista_tablas</option>";
                    if (@$origen_lista_opciones=="") $PCO_MensajeError.="<option>[Causa] Falta origen_lista_opciones</option>";
                    if (@$origen_lista_valores=="") $PCO_MensajeError.="<option>[Causa] Falta origen_lista_valores</option>";
                }

            //Pendiente proteger tablas o campos CORE
            // ******************** //

            //Si no ha obtenido mensajes de error inicia la consulta
            if ($PCO_MensajeError=="")
                {
                    // Se buscan los registros para el combo
                    $complemento_condicion_filtrado="";
                    if (@$condicion_filtrado_listas!="")
                        $complemento_condicion_filtrado=" AND ($condicion_filtrado_listas) ";
                    $consulta_registros_combo=ejecutar_sql("SELECT $origen_lista_opciones as opcion, $origen_lista_valores as valor FROM $origen_lista_tablas WHERE 1 $complemento_condicion_filtrado ");
                    while ($registro_opciones_combo = $consulta_registros_combo->fetch())
                        {
                            $PCO_SalidaCombos.=$PCO_Prefijo.$registro_opciones_combo["valor"].$PCO_Infijo.$registro_opciones_combo["opcion"].$PCO_Posfijo;
                        }
                }

//echo '<select class="selectpicker show-tick">';

            //Retorna el resultado final
            if ($PCO_MensajeError!="")
                echo $PCO_MensajeError;
            else
                echo $PCO_SalidaCombos;

//echo "</select>";

		}

