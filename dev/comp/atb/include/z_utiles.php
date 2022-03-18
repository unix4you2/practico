<?php
/*				  
	AUTO-TRADING-BOT						Copyright (C) 2017
	----------------						John F. Arroyave Gutiérrez
	                					  	unix4you2@gmail.com
	                					  	www.practico.org

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
    Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,MA 02110-1301,USA.
*/


//######################################################################
//######################################################################
/*
	Function: TruncarArreglo
			  Retorna solamente una parte o segmento de un arreglo

	Variables minimas de entrada:
		* Arreglo
		* Inicio
		* Fin

	Salida de la funcion:
		* Arreglo con los elementos indicados
*/
function TruncarArreglo(array $array, $left, $right) {
    $array = array_slice($array, $left, count($array) - $left);
    $array = array_slice($array, 0, count($array) - $right);
    return $array;
}

