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


//Configuraciones generales del Bot
$AnchoConsola=80;	//Tamano deseado para entornos de ejecucion sobre consolas de texto



//######################################################################
//######################################################################
/*
	Function: Separador
	Para ejecucion sobre consolas (CLI), presenta una linea de separacion con determinado caracter

	Variables minimas de entrada:
		Caracter - Determina el caracter utilizado como separador
		AnchoConsola - Especifica el ancho del puerto o consola de visualizacion

	Salida de la funcion:
		* Linea sobre la consola de la terminal

	Ver tambien:
		<ColorTextoConsola>
*/
function Separador($Caracter='-',$AnchoConsola)
	{
		echo "\n\r";
		for($i=1;$i<=$AnchoConsola;$i++)
			echo $Caracter;
	}



//######################################################################
//######################################################################
/*
	Function: ColorTextoConsola
	Para ejecucion sobre consolas (CLI), esteblece el color del texto para la consola mediante caracteres de escape BASH

	Variables minimas de entrada:
		Foreground - Color del texto
		Background - Color del fondo

	Salida de la funcion:
		* Impresion sobre consola del codigo de escapa BASH para el cambio de color

	TABLA GUIA DE COLORES BASH
		Color	Foreground	Background
		black	30			40
		red		31			41
		green	32			42
		yellow	33			43
		blue	34			44
		magenta	35			45
		cyan	36			46
		white	37			47

	Ver tambien:
		<Separador>
*/
function ColorTextoConsola($Foreground="",$Background="")
	{
		//Si no se define color usa el estandar de la consola o define predeterminados
		if ($Foreground=="" && $Background=="")
			$ColorFinal="\033[0m";
		else
			{
				if ($Foreground=="black") $Foreground="30";
				if ($Foreground=="red") $Foreground="31";
				if ($Foreground=="green") $Foreground="32";
				if ($Foreground=="yellow") $Foreground="33";
				if ($Foreground=="blue") $Foreground="34";
				if ($Foreground=="magenta") $Foreground="35";
				if ($Foreground=="cyan") $Foreground="36";
				if ($Foreground=="white") $Foreground="37";

				if ($Background=="black") $Background=";40";
				if ($Background=="red") $Background=";41";
				if ($Background=="green") $Background=";42";
				if ($Background=="yellow") $Background=";43";
				if ($Background=="blue") $Background=";44";
				if ($Background=="magenta") $Background=";45";
				if ($Background=="cyan") $Background=";46";
				if ($Background=="white") $Background=";47";
				$ColorFinal="\033[{$Foreground}{$Background}m";
			}
		echo "$ColorFinal";
	}


//######################################################################
//######################################################################
/*
	Function: MensajeError
	Presenta mensajes de error obtenidos durante la ejecucion de las operaciones sobre la API

	Variables minimas de entrada:
		Mensaje - Cadena con todo el mensaje que se debe presentar al usuario

	Salida de la funcion:
		* Mensaje formateado en la terminal

	Ver tambien:
		<ColorTextoConsola> <Separador>
*/
function MensajeError($Mensaje)
	{
		global $AnchoConsola;
		ColorTextoConsola("red","cyan");
		Separador("#",$AnchoConsola);
		ColorTextoConsola("yellow","cyan");
		echo " ATENCION: Ha ocurrido una excepcion en la ejecucion de la transaccion:\n\r";
		ColorTextoConsola("red","cyan");
		echo $Mensaje;
		Separador("#",$AnchoConsola);		
	}



//######################################################################
//######################################################################
/*
	Function: AnalizaArregloTendencia
			  Presenta un arreglo de bytes por consola

	Variables minimas de entrada:
		* Arreglo

	Salida de la funcion:
		* Arreglo en pantalla
*/
function AnalizaArregloTendencia(array $Arreglo,$Descripcion="",$ValorActual)
	{
		global $AnchoConsola,$PrecioInicialVenta,$PrecioInicialCompra,$DecimalesPrecision;
		$ConteoAlza=0;
		$ConteoBaja=0;
		$ConteoEstable=0;
		$CantidadElementos=count($Arreglo);
		$InicioVisualizacion=0;
		if ($CantidadElementos>$AnchoConsola)
			$InicioVisualizacion=$CantidadElementos-$AnchoConsola;
		
		$ValorInicialOperacion=$PrecioInicialVenta;
		if ($Descripcion=="COMPRA:") $ValorInicialOperacion=$PrecioInicialCompra;

		ColorTextoConsola("red","white");		
		echo "\n\r";
		for ($i=$InicioVisualizacion;$i<$CantidadElementos;$i++)
			{
				echo $Arreglo[$i];
				if ($Arreglo[$i]=="+") $ConteoAlza++;
				if ($Arreglo[$i]=="-") $ConteoBaja++;
				if ($Arreglo[$i]=="_") $ConteoEstable++;
			}
		$Diferencia=$ValorActual*1-$ValorInicialOperacion*1;
		$Signo="";
		if ($Diferencia>=0) $Signo="+";
		echo "\n\r$Descripcion +:$ConteoAlza -:$ConteoBaja _:$ConteoEstable I:$ValorInicialOperacion F:$ValorActual";
		ColorTextoConsola("blue","white");
		echo " T:${Signo}".number_format($Diferencia,$DecimalesPrecision);
		ColorTextoConsola();
		
	}
