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

  require '../inc/bargen/php-barcode.php';
  
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
?>