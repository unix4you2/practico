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

	<pre>
	<b>Importante: Si usted esta visualizando este mensaje en su navegador,
	entonces PHP no esta instalado correctamente en su servidor web!</b>
	</pre>
	*/

	/*
		Title: t_obsoletas
		Ubicacion *[dev_tools/tests/t_obsoletas.php]*.  Pruebas para evaluacion de funciones obsoletas en las diferentes versiones de PHP
	*/

	// Definicion de variables para almacenar resultado
	$estado_final="0";
	include_once("dev_tools/tests/z_consola.php");
    //Presenta estado sobre TravisCI
    PCOCLI_MensajeSimple(" EJECUTANDO PRUEBAS DE FUNCIONES OBSOLETAS ");
	
	//Funcion ereg_replace
    $ResultadoEvaluacion=ereg_replace("( )valX", "\\1valY", "CADENA");


	// Devuelve resultado final de las pruebas
	return $estado_final;