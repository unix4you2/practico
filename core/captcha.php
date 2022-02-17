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

	session_start();

/*
	Function: TextoAleatorioCaptcha
	Genera un texto aleatorio de una longitud determinada y basado en los caracteres suministrados en $plantilla

	Variables de entrada:

		longitud - Longitud del texto aleatorio

	Salida:
		texto aleatorio utilizado para la generacion de imagen del captcha

*/
function TextoAleatorioCaptcha($longitud)
	{
		// Plantilla para el captcha, a definir como parametro de aplicacion
		$clave="";
		$plantilla = "23456789abcdefghijkmnpqrstuvwxyz";
		for($i=0;$i<$longitud;$i++)
			{
				$posicion=rand(0,strlen($plantilla)-1);
				$clave .= $plantilla[$posicion];
			}
		return $clave;
	}
	include 'configuracion.php';

if ($TipoCaptchaLogin=="tradicional" || $TipoCaptchaLogin=="")
    {
    	$longitud=$CaracteresCaptcha; // A definir como parametro
    	$fuente=1;
    	$_SESSION['captcha_temporal'] = TextoAleatorioCaptcha($longitud);
    	$captcha = imagecreatefromgif('../img/captcha.gif');
    	$colText = imagecolorallocate($captcha, 0, 0, 0);
    	imagestring($captcha, 5, 50 - (imagefontwidth($fuente) * ($longitud-1)), 7, $_SESSION['captcha_temporal'], $colText);
    
    	header('Content-type: image/gif');
    	imagegif($captcha);
    }

if ($TipoCaptchaLogin=="visual")
    {
        $ArregloSimbolos=array(
            array("simbolo" => "fa-car","descripcion" => $MULTILANG_SimboloCaptchaCarro),
            array("simbolo" => "fa-scissors","descripcion" => $MULTILANG_SimboloCaptchaTijeras),
            array("simbolo" => "fa-calculator","descripcion" => $MULTILANG_SimboloCaptchaCalculadora),
            array("simbolo" => "fa-bomb","descripcion" => $MULTILANG_SimboloCaptchaBomba),
            array("simbolo" => "fa-book","descripcion" => $MULTILANG_SimboloCaptchaLibro),
            array("simbolo" => "fa-birthday-cake","descripcion" => $MULTILANG_SimboloCaptchaPastel),
            array("simbolo" => "fa-coffee","descripcion" => $MULTILANG_SimboloCaptchaCafe),
            array("simbolo" => "fa-cloud","descripcion" => $MULTILANG_SimboloCaptchaNube),
            array("simbolo" => "fa-diamond","descripcion" => $MULTILANG_SimboloCaptchaDiamante),
            array("simbolo" => "fa-female","descripcion" => $MULTILANG_SimboloCaptchaMujer),
            array("simbolo" => "fa-male","descripcion" => $MULTILANG_SimboloCaptchaHombre),
            array("simbolo" => "fa-futbol-o","descripcion" => $MULTILANG_SimboloCaptchaBalon),
            array("simbolo" => "fa-gamepad","descripcion" => $MULTILANG_SimboloCaptchaControl),
            array("simbolo" => "fa-home","descripcion" => $MULTILANG_SimboloCaptchaCasa),
            array("simbolo" => "fa-mobile","descripcion" => $MULTILANG_SimboloCaptchaCelular),
            array("simbolo" => "fa-tree","descripcion" => $MULTILANG_SimboloCaptchaArbol),
            array("simbolo" => "fa-trophy","descripcion" => $MULTILANG_SimboloCaptchaTrofeo),
            array("simbolo" => "fa-umbrella","descripcion" => $MULTILANG_SimboloCaptchaSombrilla),
            array("simbolo" => "fa-university","descripcion" => $MULTILANG_SimboloCaptchaUniversidad),
            array("simbolo" => "fa-video-camera","descripcion" => $MULTILANG_SimboloCaptchaCamara),
            array("simbolo" => "fa-ambulance","descripcion" => $MULTILANG_SimboloCaptchaAmbulancia),
            array("simbolo" => "fa-plane","descripcion" => $MULTILANG_SimboloCaptchaAvion),
            array("simbolo" => "fa-subway","descripcion" => $MULTILANG_SimboloCaptchaTren),
            array("simbolo" => "fa-bicycle","descripcion" => $MULTILANG_SimboloCaptchaBicicleta),
            array("simbolo" => "fa-truck","descripcion" => $MULTILANG_SimboloCaptchaCamion),
            array("simbolo" => "fa-heart","descripcion" => $MULTILANG_SimboloCaptchaCorazon)
        );

    	$CantidadSimbolosDisponibles=25;
    	$CantidadSimbolosVisibles=$CaracteresCaptcha;
    	$CadenaAleatoriosGenerados=",";

        //Toma el aleatorio que sera el simbolo seleccionado
    	$SimboloEscogido=rand(0, $CantidadSimbolosVisibles-1);

    	//Genera 6 aleatorios entre 1 y la cantidad de simbolos y crea los elementos correspondientes
    	$SimbolosGenerados=0;
    	while($SimbolosGenerados<$CantidadSimbolosVisibles)
    	    {
    	        $Aleatorio=rand(0, $CantidadSimbolosDisponibles);
    	        if (!strpos($CadenaAleatoriosGenerados,','.$Aleatorio))
    	            {
            	        $CadenaAleatoriosGenerados.=','.$Aleatorio;
            	        //Si el simbolo actual es el escogido lo lleva a variable esperada
            	        if ($SimbolosGenerados==$SimboloEscogido)
            	           $_SESSION['captcha_temporal'] = $ArregloSimbolos[$Aleatorio]['descripcion'];    
            	        $SimbolosGenerados++;        	                
    	            }
    	    }
    	//Genera los botones o elementos con los simbolos seleccionados
    	$AleatoriosGenerados=explode(',',$CadenaAleatoriosGenerados);
    	echo '
    	      <div class="well">
                <input type="hidden" name="captcha" id="captcha">
        	    '.$MULTILANG_TipoCaptchaPrefijo.' <b>'.$_SESSION['captcha_temporal'].'</b> '.$MULTILANG_TipoCaptchaPosfijo.'<br>';
        	    $IdBotones=1;
            	foreach ($AleatoriosGenerados as $Aleatorio) 
                	{
                	    if (trim($ArregloSimbolos[$Aleatorio]['simbolo'])!="")
                	        {
                	            echo '<a class="btn" id="BotonCaptcha'.$IdBotones.'" onclick="document.login_usuario.captcha.value=\''.$ArregloSimbolos[$Aleatorio]['descripcion'].'\'; LimpiarSeleccion(); $(this).addClass(\'btn-info\',0, \'easeOutBounce\');" style="border: solid 0px red;" ><i class="fa fa-fw fa-2x '.$ArregloSimbolos[$Aleatorio]['simbolo'].'"></i></a>';
                	            $IdBotones++;
                	        }
                	}
    	echo '</div>
    	      <script language="JavaScript">
    	            function LimpiarSeleccion()
    	                {
    	                    i=1;
    	                    while(i<='.$IdBotones.')
    	                        {
    	                            $("#BotonCaptcha"+i).removeClass("btn-info",0, "easeOutBounce");
    	                            i++;
    	                        }
    	                }
    	      </script>';
    } //Fin si el tipo de captch es visual