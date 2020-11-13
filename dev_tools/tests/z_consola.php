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