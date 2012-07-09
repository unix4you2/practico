<?php
	session_start();

		function TextoAleatorio($longitud)
			{
				$plantilla = "23456789abcdefghijkmnpqrstuvwxyz";
				for($i=0;$i<$longitud;$i++)
					{
						$clave .= $plantilla{rand(0,strlen($plantilla)-1)};
					}
				return $clave;
			}

	$longitud=6;
	$fuente=1;
	$_SESSION['captcha_temporal'] = TextoAleatorio($longitud);
	$captcha = imagecreatefromgif("../img/captcha.gif");
	$colText = imagecolorallocate($captcha, 0, 0, 0);
	imagestring($captcha, 5, 50 - (imagefontwidth($fuente) * ($longitud-1)), 7, $_SESSION['captcha_temporal'], $colText);

	header("Content-type: image/gif");
	imagegif($captcha);
?>
