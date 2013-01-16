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

	session_start();

/*
	Function: TextoAleatorio
	Genera un texto aleatorio de una longitud determinada y basado en los caracteres suministrados en $plantilla

	Variables de entrada:

		longitud - Longitud del texto aleatorio

	Salida:
		texto aleatorio utilizado para la generacion de imagen del captcha

*/
	function TextoAleatorio($longitud)
		{
			// Plantilla para el captcha, a definir como parametro de aplicacion
			$plantilla = "23456789abcdefghijkmnpqrstuvwxyz";
			for($i=0;$i<$longitud;$i++)
				{
					$clave .= $plantilla{rand(0,strlen($plantilla)-1)};
				}
			return $clave;
		}
	include("configuracion.php");
	$longitud=$CaracteresCaptcha; // A definir como parametro
	$fuente=1;
	$_SESSION['captcha_temporal'] = TextoAleatorio($longitud);
	$captcha = imagecreatefromgif("../img/captcha.gif");
	$colText = imagecolorallocate($captcha, 0, 0, 0);
	imagestring($captcha, 5, 50 - (imagefontwidth($fuente) * ($longitud-1)), 7, $_SESSION['captcha_temporal'], $colText);

	header("Content-type: image/gif");
	imagegif($captcha);
?>
