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
?>