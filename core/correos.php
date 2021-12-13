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

	/*
		Title: Modulo correos
		Ubicacion *[/core/correo.php]*.  Modulo encargado del envio de mensajes simples o informes automaticos por correo electronico.
	*/

	
	// Valida sesion activa de Practico
//	@session_start();
	if (!isset($PCOSESS_SesionAbierta)) 
		{
			echo '<head><title>Error</title><style type="text/css"> body { background-color: #000000; color: #7f7f7f; font-family: sans-serif,helvetica; } </style></head><body><table width="100%" height="100%" border=0><tr><td align=center>&#9827; Acceso no autorizado !</td></tr></table></body>';
			die();
		}

	$texto_prefijo_correo = '<html>
		<head>
		<meta content="text/html;charset=UTF-8" http-equiv="Content-Type">
		<title>'.$NombreRAD.'</title>
		</head>
		<body>
		<span style="font-family: Helvetica,Arial,sans-serif;"><small
		style="font-weight: bold; color: rgb(102, 102, 102);">'.$MULTILANG_MailIntro1.' '.$NombreRAD.'</small><br>
		<hr>
		<br>
		</span>
		<div style="margin-left: 0px;"><span
		style="font-family: Helvetica,Arial,sans-serif;">'.$MULTILANG_Fecha.':<span
		style="font-weight: bold;"> '.date("Y/m/d").'</span> - '.$MULTILANG_Hora.': <span
		style="font-weight: bold;">'.date("H:i:s").'</span></span></div>
		<div style="margin-left: 40px;"><span
		style="font-family: Helvetica,Arial,sans-serif;">';

	$texto_posfijo_correo = ' </span></div>
		<p style="font-family: Helvetica,Arial,sans-serif;"><br>
		</p>
		<p style="font-family: Helvetica,Arial,sans-serif;">
        '.$MULTILANG_MailIntro2.'
        <br>
		</p>
		<span
		style="font-family: Helvetica,Arial,sans-serif; color: rgb(135, 18, 21); font-style: italic;">
        '.$MULTILANG_MailIntro3.'
        <br>
		<hr>
		<small style="color: rgb(3, 0, 0);"><span style="font-weight: bold;">
        '.$MULTILANG_MailIntro4.'
        </small><br>
		</span>
		<table style="text-align: left; width: 100%;" border="0" cellpadding="0"
		cellspacing="0">
		</table>
		<div style="text-align: justify;"><small> </small><small> </small><small>
		</small></div>
		<table style="text-align: left;" border="0" cellpadding="0"
		cellspacing="0">
		<tbody>
		<tr>
		<td
		style="vertical-align: top; background-color: rgb(240, 240, 240);">
		<div style="text-align: justify;"><small><small><span
		style="font-family: Helvetica,Arial,sans-serif; color: rgb(89, 89, 89);">
        '.$MULTILANG_MailIntro5.'
        '.$MULTILANG_MailIntro6.'
        </span></small></small><br
		style="font-family: Helvetica,Arial,sans-serif;">
		<small><small> </small></small></div>
		</td>
		</tr>
		</tbody>
		</table>
		</body>
		</html>'; 


/* ################################################################## */
/* ################################################################## */
/*
	Function: enviar_correo
	Envia un correo electronico utilizando la funcion mail de php

	Variables de entrada:
		* remitente
		* destinatario
		* asunto
		* cuerpo_mensaje
		* destinatario_cc
		* destinatario_bcc

	Salida:
		Correo electronico enviado al destinatario, destinatario_cc y destinatario_bcc
		* Retorna verdadero si el correo fue encolado/aceptado para envio o falso si fue rechazado

	Ver tambien:
		<Modulo correos>
*/
function PCO_EnviarCorreo($remitente,$destinatario,$asunto,$cuerpo_mensaje,$destinatario_cc="",$destinatario_bcc="")
	{
		global $texto_prefijo_correo,$texto_posfijo_correo,$NombreRAD,$PCOVAR_ProvedorSMTP,$MULTILANG_Usuario;
		
		//Usa el proveedor interno del servidor:  Sendmail, Postfix, etc. cuando asi esta definido o cuando no existe uno definido
		if ($PCOVAR_ProvedorSMTP=="Interno" || @$PCOVAR_ProvedorSMTP=="")
			{
				//para el env�o en formato HTML
				$headers = "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\n";
				$headers .= "From: ".$NombreRAD." <".$remitente.">\n";
				$headers .= "Reply-To: ".$remitente."\n";
				$headers .= "Return-path: ".$remitente."\n";
				$headers .= $destinatario_cc;
				$headers .= $destinatario_bcc;
				$mensaje_final=$texto_prefijo_correo.$cuerpo_mensaje.$texto_posfijo_correo;
				$estado_envio = mail($destinatario,$asunto,$mensaje_final,$headers);
			}

		return $estado_envio;
	}

