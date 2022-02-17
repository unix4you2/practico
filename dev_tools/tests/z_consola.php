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

		Title: z_consola
		Ubicacion *[dev_tools/tests/z_consola.php]*.  Funciones basicas para mensajes de consola
	*/


//Configuraciones generales
$AnchoConsola=80;	//Tamano deseado para entornos de ejecucion sobre consolas de texto


//######################################################################
//######################################################################
/*
	Function: PCOCLI_Separador
	Para ejecucion sobre consolas (CLI), presenta una linea de separacion con determinado caracter

	Variables minimas de entrada:
		Caracter - Determina el caracter utilizado como separador
		AnchoConsola - Especifica el ancho del puerto o consola de visualizacion

	Salida de la funcion:
		* Linea sobre la consola de la terminal

	Ver tambien:
		<ColorTextoConsola>
*/
function PCOCLI_Separador($Caracter='-',$AnchoConsola)
	{
		echo "\n\r";
		for($i=1;$i<=$AnchoConsola;$i++)
			echo $Caracter;
	}



//######################################################################
//######################################################################
/*
	Function: PCOCLI_ColorTextoConsola
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
function PCOCLI_ColorTextoConsola($Foreground="",$Background="")
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
	Function: PCOCLI_MensajeSimple
	Presenta mensajes de error obtenidos durante la ejecucion de las operaciones sobre la API

	Variables minimas de entrada:
		Mensaje - Cadena con todo el mensaje que se debe presentar al usuario

	Salida de la funcion:
		* Mensaje formateado en la terminal

	Ver tambien:
		<ColorTextoConsola> <Separador>
*/
function PCOCLI_MensajeSimple($Mensaje)
	{
		global $AnchoConsola;
		PCOCLI_ColorTextoConsola("yellow","black");
		PCOCLI_Separador("#",$AnchoConsola);
		echo "\n\r";
		echo $Mensaje;
		PCOCLI_Separador("#",$AnchoConsola);		
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
function PCOCLI_Mensaje($Mensaje)
	{
		global $AnchoConsola;
		PCOCLI_Separador("-",$AnchoConsola);
		echo "\n\r";
		echo $Mensaje;
	}