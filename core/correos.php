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

	/*
		Title: Modulo correos
		Ubicacion *[/core/correo.php]*.  Modulo encargado del envio de informes por correo electronico

		Variables de entrada:

			informe - Indica el nombre del informe a generar y enviar

		Salida de la funcion:
			Informe por correo
	*/

	session_start();

	include("configuracion.php");

	$fecha_correo=date("Y/m/d");
	$hora_correo=date("H:i:s");
	$prefijo_correo = '<html>
		<head>
		<meta content="text/html;charset=UTF-8" http-equiv="Content-Type">
		<title>Mensaje de Pr&aacute;ctico</title>
		</head>
		<body>
		<span style="font-family: Helvetica,Arial,sans-serif;"><small
		style="font-weight: bold; color: rgb(102, 102, 102);">Mensaje
		automático de eventos en la plataforma Práctico</small><br>
		<hr>
		<br>
		</span>
		<div style="margin-left: 40px;"><span
		style="font-family: Helvetica,Arial,sans-serif;">Fecha:<span
		style="font-weight: bold;"> '.$fecha_correo.'</span> - Hora: <span
		style="font-weight: bold;">'.$hora_correo.'</span></span></div>
		<div style="margin-left: 40px;"><span
		style="font-family: Helvetica,Arial,sans-serif;">';

	$posfijo_correo = ' </span></div>
		<p style="font-family: Helvetica,Arial,sans-serif;"><br>
		</p>
		<p style="font-family: Helvetica,Arial,sans-serif;">Información
		detallada sobre este mensaje puede ser encontrada accesando nuestro
		portal de <span style="font-weight: bold;">Práctico</span> con su
		nombre de
		usuario y contraseña<br>
		</p>
		<span
		style="font-family: Helvetica,Arial,sans-serif; color: rgb(135, 18, 21); font-style: italic;">Este
		correo fue generado por un sistema automático, por favor no responda a
		este mensaje.<br>
		<hr>
		<small style="color: rgb(3, 0, 0);"><span style="font-weight: bold;">Recuerde
		que nunca le será solicitada información personal o
		contraseñas vía correo electrónico</span>, por lo tanto no conteste o
		diligencie formularios donde te solicite este tipo de información y que
		se encuentren por fuera de nuestro sistema.</small><br>
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
		style="font-family: Helvetica,Arial,sans-serif; color: rgb(89, 89, 89);">La
		información contenida en este correo electrónico y en todos sus
		archivos anexos, es confidencial y/o exclusiva del negocio y puede ser
		utilizada únicamente por la (s) persona (s) a la (s) cual (es) esté
		dirigida. Si
		usted no es el destinatario autorizado, cualquier modificación,
		retención, difusión, distribución o copia total o parcial de este
		mensaje y/o de la información contenida en este y/o en sus archivos
		anexos esta prohibida y son sancionados por la ley. Si recibe este
		mensaje por error, sírvase borrarlo de inmediato, notificarle de su
		error a la persona que lo envió y abstenerse de divulgar su contenido e
		información anexa.</span></small></small><br
		style="font-family: Helvetica,Arial,sans-serif;">
		<small><small> </small></small></div>
		</td>
		</tr>
		</tbody>
		</table>
		</body>
		</html>'; 


// #####################################################################################################
if ($informe=="xxx")		
	{
		//PASAR FUNCIONALIDAD A PDO
		$mysql_enlace = mysql_connect($Servidor, $UsuarioBD, $PasswordBD); 
		mysql_select_db($BaseDatos, $mysql_enlace);

		// Busca empresas atendidas en el dia
		$reporte_general=$prefijo_correo;
		$reporte_general.='<br>La informaci&oacute;n asociada a este mensaje se encuentra directamente en el asunto para facilitar su lectura en dispositivos m&oacute;viles<br>';
		
		// Obtiene y formatea datos del informe a enviar almacenados en la cadena de reporte_general
		if ($fecha=="") $fecha=date("Ymd");
		$consulta_ventas = "SELECT format(SUM(total),0) as totalventas FROM fac_factura WHERE anulada=0 AND f_fact='$fecha' AND cod_empresa<>'' AND forma_pago='0'";
		$resultado_ventas = mysql_query($consulta_ventas,$mysql_enlace);
		$registro_ventas = mysql_fetch_array($resultado_ventas);
		$total_ventas=$registro_ventas["totalventas"];

		$reporte_general.=$posfijo_correo;

		// ENVIO DE CORREO ELECTRONICO
		$asunto = "[".$par_NOMBRESEDE."] Total ventas: $".$total_ventas;

		$headers = "MIME-Version: 1.0\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\n"; 
		$headers .= "From: ERP Colmedicos S.A. <".$par_NOREPLYMAIL.">\n"; 
		$headers .= "Reply-To: ".$par_NOREPLYMAIL."\n"; 
		$headers .= "Return-path: ".$par_NOREPLYMAIL."\n"; 

		$destinatario = "reportes@unixlandia.org";
		$headers .= "Cc: copias1@unixlandia.com,copias2@unixlandia.net\n";
		$headers .= "Bcc: john.arroyave@unixlandia.org,catalina.merino@unixlandia.org\n";

		mail($destinatario,$asunto,$reporte_general,$headers);
	}

?>
