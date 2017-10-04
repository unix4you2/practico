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
	include("configuracion.php");

	if ($TipoCaptchaLogin=="tradicional")
	    {
        	$longitud=$CaracteresCaptcha; // A definir como parametro
        	$fuente=1;
        	$_SESSION['captcha_temporal'] = TextoAleatorioCaptcha($longitud);
        	$captcha = imagecreatefromgif("../img/captcha.gif");
        	$colText = imagecolorallocate($captcha, 0, 0, 0);
        	imagestring($captcha, 5, 50 - (imagefontwidth($fuente) * ($longitud-1)), 7, $_SESSION['captcha_temporal'], $colText);
        
        	header("Content-type: image/gif");
        	imagegif($captcha);
	    }

	if ($TipoCaptchaLogin=="visual")
	    {
        	$_SESSION['captcha_temporal'] = TextoAleatorioCaptcha($longitud);
	        ?>
                <script language="JavaScript">
                    var data ={
                      "iconos" :
                      [
                        {"id": "1",    "nombre": "car",    "propiedades": {"simbolo": "fa-car",    "es": "carro",  "en": "car",    "genero":"el"}},
                        {"id": "2","nombre": "scissors","propiedades": {"simbolo": "fa-scissors","es": "tijeras","en": "scissors","genero":"las"}},
                        {"id": "3","nombre": "calculator","propiedades": {"simbolo": "fa-calculator","es": "calculadora","en": "calculator","genero":"la"}},
                        {"id": "4","nombre": "bomb", "propiedades": {"simbolo": "fa-bomb","es": "bomba","en": "bomb","genero":"la"}},
                        {"id": "5","nombre": "book","propiedades": {"simbolo": "fa-book","es": "libro","en": "book","genero":"el"}},
                        {"id": "6","nombre": "cake", "propiedades": {"simbolo": "fa-birthday-cake","es": "pastel","en": "cake","genero":"el"}},
                        {"id": "7","nombre": "coffee","propiedades": {"simbolo": "fa-coffee","es": "cafe","en": "coffee","genero":"el"}},
                        {"id": "8","nombre": "cloud","propiedades": {"simbolo": "fa-cloud","es": "nube","en": "cloud","genero":"la"}},
                        { "id": "9","nombre": "diamond","propiedades": {"simbolo": "fa-diamond","es": "diamante","en": "diamond","genero":"el"} },
                        {"id": "10","nombre": "female","propiedades": {"simbolo": "fa-female","es": "mujer","en": "female","genero":"la"}},
                        {"id": "11","nombre": "male","propiedades": {"simbolo": "fa-male","es": "hombre","en": "male","genero":"el"}},
                        {"id": "12","nombre": "futbol","propiedades": {"simbolo": "fa-futbol-o","es": "balon","en": "ball","genero" : "el" } },
                        {"id": "13", "nombre": "gamepad", "propiedades": {"simbolo": "fa-gamepad","es": "control", "en": "gamepad", "genero" : "el" }},
                        { "id": "14","nombre": "home","propiedades": {"simbolo": "fa-home","es": "casa","en": "home","genero" : "la"}},
                        {"id": "15","nombre": "mobile","propiedades": {"simbolo": "fa-mobile","es": "celular","en": "mobile","genero" : "el"}},
                        {"id": "16","nombre": "tree","propiedades": {"simbolo": "fa-tree","es": "arbol","en": "tree","genero" : "el"}},
                        {"id": "17","nombre": "trophy","propiedades": {"simbolo": "fa-trophy","es": "trofeo","en": "trophy","genero" : "el"}},
                        {"id": "18","nombre": "umbrella","propiedades": {"simbolo": "fa-umbrella","es": "sombrilla", "en": "umbrella","genero" : "la"}},
                        {
                          "id": "19",
                          "nombre": "university",
                          "propiedades": {
                            "simbolo": "fa-university",
                            "es": "universidad",
                            "en": "university",
                            "genero" : "la"
                          }
                        },
                        {
                          "id": "20",
                          "nombre": "video-camera",
                          "propiedades": {
                            "simbolo": "fa-video-camera",
                            "es": "camara",
                            "en": "camera",
                            "genero" : "la"
                          }
                        },
                        {
                          "id": "21",
                          "nombre": "ambulance",
                          "propiedades": {
                            "simbolo": "fa-ambulance",
                            "es": "ambulancia",
                            "en": "ambulance",
                            "genero" : "la"
                          }
                        },
                        {
                          "id": "22",
                          "nombre": "plane",
                          "propiedades": {
                            "simbolo": "fa-plane",
                            "es": "avion",
                            "en": "plane",
                            "genero" : "el"
                          }
                        },
                        {
                          "id": "23",
                          "nombre": "subway",
                          "propiedades": {
                            "simbolo": "fa-subway",
                            "es": "tren",
                            "en": "subway",
                            "genero" : "el"
                          }
                        },
                        {
                          "id": "24",
                          "nombre": "bicycle",
                          "propiedades": {
                            "simbolo": "fa-bicycle",
                            "es": "bicicleta",
                            "en": "bicycle",
                            "genero" : "la"
                          }
                        },
                        {
                          "id": "25",
                          "nombre": "truck",
                          "propiedades": {
                            "simbolo": "fa-truck",
                            "es": "camion",
                            "en": "truck",
                            "genero" : "el"
                          }
                        },
                        {
                          "id": "26",
                          "nombre": "heart",
                          "propiedades": {
                            "simbolo": "fa-heart",
                            "es": "corazon",
                            "en": "heart",
                            "genero" : "el"
                          }
                        }
                      ]
                    };
                    
                    var captchaAnswered = false;
                    var captchaAnswer = getRandomIcon();
                    var language = "es";
                    
                    $(document).ready(function() {
                    
                      reloadCaptcha(true);
                      $('.reCap').on('click', function(event) {
                        event.preventDefault();
                          $('.reCap i').addClass('fa-spin');
                        setTimeout(function(){
                          reloadCaptcha(true);
                        }, 1000);
                    
                      });
                    
                    $('.voiceCaptcha').on('click', function(event) {
                      event.preventDefault();
                      spechToTextCaptcha($('.captchaTitle').text());
                    });
                    
                    });
                    
                    Array.prototype.unique=function(a){
                      return function(){return this.filter(a)}}(function(a,b,c){return c.indexOf(a,b+1)<0
                    });
                    
                    function getRandomIcon() {
                        var id = getRandomId(1,25);
                        return data.iconos[parseInt(id)];
                    }
                    
                    function getRandomId(min,max){
                      return  Math.floor(Math.random() * (max - min + 1)) + min;
                    }
                    
                    function getRandomsByArray(arr,icon){
                      var addToArray = false;
                      for (var i = 0; i < arr.length; i++) {
                        if(icon === arr[i]){
                          addToArray  = false;
                          break;
                        }
                        else {
                          addToArray = true;
                        }
                      }
                      return addToArray;
                    }
                    
                    function loadPictures(answerId){
                      var arr = new Array();
                      arr.push(answerId);
                      for (var i = 0; i < 5; i++) {
                        var aux = getRandomIcon();
                        if(getRandomsByArray(arr,aux))
                        {
                          arr.push(aux);
                        }
                        else {
                          i--;
                        }
                      }
                      arr.unique();
                      shuffle(arr);
                      for (var i = 0; i < arr.length; i++) {
                        $('.capchaIcons').append(' <a data-id="'+ arr[i].id +'" class="captchaIconSingle fa ' + arr[i].propiedades.simbolo + '" ></a> ');
                      }
                    
                      console.log(arr);
                    }
                    
                    function clearCaptcha(){
                    
                    }
                    
                    function shuffle(array) {
                      var currentIndex = array.length, temporaryValue, randomIndex ;
                    
                      // While there remain elements to shuffle...
                      while (0 !== currentIndex) {
                    
                        // Pick a remaining element...
                        randomIndex = Math.floor(Math.random() * currentIndex);
                        currentIndex -= 1;
                    
                        // And swap it with the current element.
                        temporaryValue = array[currentIndex];
                        array[currentIndex] = array[randomIndex];
                        array[randomIndex] = temporaryValue;
                      }
                    
                      return array;
                    }
                    
                    function reloadCaptcha(reload){
                      if(reload){
                        captchaAnswer = getRandomIcon();
                        captchaAnswered = false;
                        $('.capchaIcons').html('');
                        $('.captchaQuestion').text('');
                        $('.reCap i').removeClass('fa-spin');
                      }
                      if(language==="es"){
                        $('.captchaQuestion').text(captchaAnswer.propiedades.genero + ' ' + captchaAnswer.propiedades.es);
                      }
                      else {
                        $('.captchaQuestion').text('The ' + captchaAnswer.propiedades.en );
                      }
                      loadPictures(captchaAnswer);

                      $('.capchaIcons a').on('click', function(event) {
                        event.preventDefault();
                        $('.capchaIcons a').removeClass('selectedIconCaptcha');
                        captchaAnswered = false;
                        $(this).addClass('selectedIconCaptcha');
                        if($(this).data('id') == captchaAnswer.id){
                          captchaAnswered = true;
                        }
                        else {
                          captchaAnswered = false;
                        }
                      });
                    
                      $('.submitForm').on('click',function(event) {
                        event.preventDefault();
                        if(captchaAnswered)
                        {
                          alert('captcha resuelto correctamente');
                          reloadCaptcha(true);
                        }
                        else{
                          reloadCaptcha(true);
                        }
                      });
                    }
                    
                    function spechToTextCaptcha(text){
                      var msg = new SpeechSynthesisUtterance();
                      var voices = window.speechSynthesis.getVoices();
                      msg.text = text;
                      if(language == 'es'){
                        msg.lang = 'es-ES';
                        }
                      else {
                        msg.lang = 'en-US';
                      }
                    
                      msg.onend = function(e) {
                        console.log('Finished in ' + event.elapsedTime + ' seconds.');
                      };
                      speechSynthesis.speak(msg);
                    }
                </script>
	        <?php
	    } //Fin si el tipo de captch es visual
?>