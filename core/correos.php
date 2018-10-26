<?php
	/*
	Copyright (C) 2013  John F. Arroyave Guti�rrez
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
Configuraciones de provvedor favorito para envio de correos
*/













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

		//Usa proveedor externo de correo
		if ($PCOVAR_ProvedorSMTP=="SendGrid")
			{
				
				$PCOVAR_APIKeySendGrid="XXXXX"; //Tomar este valor desde configuraciones
				//Pendiente:  parametrizar el envio de mensajes de solo texto si se desea.

				// REVISAR ESTE COMPOSER require 'vendor/autoload.php';
				Dotenv::load(__DIR__);
				$sendgrid_apikey = getenv($PCOVAR_APIKeySendGrid);
				$sendgrid = new SendGrid($sendgrid_apikey);
				$url = 'https://api.sendgrid.com/';
				$pass = $sendgrid_apikey;
				$template_id = '<your_template_id>';
				$js = array(
				  'sub' => array(':name' => array('Elmer')),
				  'filters' => array('templates' => array('settings' => array('enable' => 1, 'template_id' => $template_id)))
				);

				$params = array(
					'to'        => $destinatario,
					'toname'    => $MULTILANG_Usuario." - ".$NombreRAD,
					'from'      => $remitente,
					'fromname'  => $NombreRAD,
					'subject'   => $asunto,
					'text'      => "I'm text!",
					'html'      => $cuerpo_mensaje,
					'x-smtpapi' => json_encode($js),
				  );

				$request =  $url.'api/mail.send.json';

				// Generate curl request
				$session = curl_init($request);
				// Tell PHP not to use SSLv3 (instead opting for TLS)
				curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
				curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_apikey));
				// Tell curl to use HTTP POST
				curl_setopt ($session, CURLOPT_POST, true);
				// Tell curl that this is the body of the POST
				curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
				// Tell curl not to return headers, but do return the response
				curl_setopt($session, CURLOPT_HEADER, false);
				curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

				// obtain response
				$response = curl_exec($session);
				curl_close($session);

				// print everything out
				print_r($response);

			}
		return $estado_envio;
	}

?>