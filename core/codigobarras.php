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
*/

  require '../inc/jbdemonte/barcode/php-barcode.php';
  
	// Recupera variables recibidas para su uso como globales (equivale a register_globals=on en php.ini)
	if (!ini_get('register_globals'))
	{
		$numero = count($_REQUEST);
		$tags = array_keys($_REQUEST);// obtiene los nombres de las varibles
		$valores = array_values($_REQUEST);// obtiene los valores de las varibles
		// crea las variables y les asigna el valor
		for($i=0;$i<$numero;$i++)
			{
				${$tags[$i]}=$valores[$i];
			}
		// Agrega ademas las variables de sesion
		if (!empty($_SESSION)) extract($_SESSION);
	}

  $x        = $AnchoImagen/2;	// Centro X del codigo en la imagen
  $y        = $AltoImagen/2;	// Centro Y del codigo dentro de la imagen
  if ($Tipo!="datamatrix")
	{
		$height   = $AltoCodigo;   	// Alto del codigo en 1D o tamano de modulo en 2D
		$width    = $AnchoCodigo;    	// Ancho del codigo en 1D ; no usar en 2D
	}

  //Separa recursos de trabajo en GD
  $im     = imagecreatetruecolor($AnchoImagen, $AltoImagen);
  $black  = ImageColorAllocate($im,0x00,0x00,0x00);
  $white  = ImageColorAllocate($im,0xff,0xff,0xff);
  imagefilledrectangle($im, 0, 0, $AnchoImagen, $AltoImagen, $white);
  
  //Llama el metodo para generar el codigo
  $data = Barcode::gd($im, $black, $x, $y, 0, $Tipo, array('code'=>$Cadena), $width, $height);

  //Genera la imagen
  header('Content-type: image/gif');
  imagegif($im);
  imagedestroy($im);