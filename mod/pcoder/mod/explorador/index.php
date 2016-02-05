<?php
	/*
	   PCODER (Editor de Codigo en la Nube)
	   Copyright (C) 2013  John F. Arroyave Gutiérrez
						   unix4you2@gmail.com
						   www.practico.org

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
	*/

    // BLOQUE BASICO DE INCLUSION ######################################
    // Inicio de la sesion
    @session_start();

    //Permite WebServices propios mediante el acceso a este script en solicitudes Cross-Domain
    header('Access-Control-Allow-Origin: *');
    header('access-control-allow-credentials: true');
	header('Content-type: text/html; charset=utf-8');

    //Incluye archivo inicial de configuracion
	include_once("../../inc/configuracion.php");

    //Incluye idioma espanol, o sobreescribe vbles por configuracion de usuario
    include("../../idiomas/es.php");
    include("../../idiomas/".$IdiomaPredeterminado.".php");
    // FIN BLOQUE BASICO DE INCLUSION ##################################

    // Establece la zona horaria por defecto para la aplicacion
    date_default_timezone_set($ZonaHoraria);

    // Datos de fecha, hora y direccion IP para algunas operaciones
    $PCO_EXPLORER_FechaOperacion=date("Ymd");
    $PCO_EXPLORER_FechaOperacionGuiones=date("Y-m-d");
    $PCO_EXPLORER_HoraOperacion=date("His");
    $PCO_EXPLORER_HoraOperacionPuntos=date("H:i");
    $PCO_EXPLORER_DireccionAuditoria=$_SERVER ['REMOTE_ADDR'];

/* ################################################################## */
/* ################################################################## */

	//Valida la llave de sesion generada por {P}Coder
	if ($_SESSION['PEXPLORER_KEY']!="")
		{
		}
	else
		{
			header('Location: blank.html');
			exit;
		}

?>
 <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
<head>
	<title>{E}</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="generator" content="PExplorer" />
 	<meta name="description" content="Explorador web embebido" />
    <meta name="author" content="John Arroyave G. - {www.practico.org} - {unix4you2 at gmail.com}">

    <!-- Custom Fonts -->
    <link href="../../../../inc/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
	<script type="text/javascript" src="../../../../inc/jquery/jquery-2.1.0.min.js"></script>
	
	<style>
		body
			{
				overflow:hidden;
				overflow-x:hidden;	/*Horizontal*/
				overflow-y:hidden;	/*Vertical*/
				font-size:12px;
				font-family: monospace;
				font-weight: bold;
				background: #3A3838;
				color: #ffffff;
				margin: 0px;
			}

		input
			{
				font-family: monospace;
				background: #D6D6D6;
				color: #000000;
				margin: 0px;
				border:0px;
				height: 20px;
			}

		i:hover
			{
				cursor:pointer;
				color:#6F7FA0;
			}

		/*Personalizacion de barras de desplazamiento*/
			/*Barra de desplazamiento como tal*/
			::-webkit-scrollbar {
				width: 10px;
				height: 10px;
			}
			/*Botones de los extremos de la barra*/
			::-webkit-scrollbar-button:start:decrement,
			::-webkit-scrollbar-button:end:increment  {
				display: none;
			}

			/*Barra sobre la que se mueve el boton flotante*/
			::-webkit-scrollbar-track  {
			}

			/*Espacio libre de la barra de desplazamiento*/
			::-webkit-scrollbar-track-piece  {
				background-color: #3b3b3b;
				-webkit-border-radius: 6px;
			}
			
			/*Boton flotante de la barra de desplazamiento*/
			::-webkit-scrollbar-thumb:vertical {
				-webkit-border-radius: 6px;
				background: #666 no-repeat center;
			}
			::-webkit-scrollbar-thumb:horizontal {
				-webkit-border-radius: 6px;
				background: #666 no-repeat center;
			}

			/*Esquina donde se encuentran las barras*/
			::-webkit-scrollbar-corner {
				display: none;
			}

			/*Esquina donde se encuentran las barras - cuando es redimensionable*/
			::-webkit-resizer {
				display: none;
			}
	</style>


</head>
<body>
	<!-- ################# INICIO DE LA MAQUETACION ################ -->
		<form name="form_barra_navegacion" OnSubmit="PEXPLORER_Navegar(); return false;">
			<div id="barra_navegacion">
				<table border=0 width="100%" cellpadding="3"><tr>
					<td nowrap valign="middle">
						<i class="fa fa-home fa-fw fa-2x" OnClick="CargarIframeURL('frame_navegador', 'blank.html'); document.form_barra_navegacion.url.value='';"></i>
					</td>
					<!--
					<td nowrap valign="middle">
						<i class="fa fa-chevron-circle-left fa-fw fa-2x" OnClick="frame_navegador.history.back();"></i>
					</td>
					<td nowrap valign="middle">
						<i class="fa fa-chevron-circle-right fa-fw fa-2x" OnClick="frame_navegador.contentWindow.history.go(1);"></i>
					</td>
					-->
					<td nowrap valign="middle">
						<i class="fa fa-globe fa-fw fa-2x"></i>
					</td>
					<td width="100%"  valign="middle">
						<input type="text" id="url" name="url" style="position:inline; width:100%;" value="http://" placeholder="http://">			
					</td>
					<td nowrap valign="middle">
						<i class="fa fa-arrow-circle-right fa-fw fa-2x" OnClick="PEXPLORER_Navegar();"></i>
					</td>
					<td nowrap valign="middle">
						<i class="fa fa-refresh fa-fw fa-2x" OnClick="PEXPLORER_Navegar();"></i>
					</td>
				</tr></table>
			</div>
		</form>
		
		<!--Marco de navegacion-->
		<div id="marco_navegacion">
			<iframe name="frame_navegador" id="frame_navegador" width="100%" height="100%"  scrolling="yes" src="blank.html" style="border:0px; width:100%; height:100%;"></iframe>
		</div>

	<!-- ################## FIN DE LA MAQUETACION ################## -->


	<script language="javascript">
		function PEXPLORER_RecalcularMaquetacion()   //RedimensionarEditor();
			{
				//Obtiene las dimensiones actuales de la ventana de edicion y algunos objetos
				var AltoVentana = $(window).height();

				//Obtiene el alto de los diferentes marcos que componen el aplicativo
				var alto_barra_navegacion = $("#barra_navegacion").height();

				//Modifica el ALTO DEL PANEL CENTRAL MEDIO
				var TamanoNavegador = AltoVentana - ( alto_barra_navegacion );
				$('#marco_navegacion').height( TamanoNavegador+"px" ).css({ });
				$('#frame_navegador').height( TamanoNavegador+"px" ).css({ });
			}

		function CargarIframeURL(iframeName, url)
			{
				//url=url+'&output=embed';
				var $iframe = $('#' + iframeName);
				if ( $iframe.length )
					{
						$iframe.attr('src',url);   
						return false;
					}
				return true;
			}

		function PEXPLORER_Navegar()
			{
				//Verifica si se tiene http en la URL, sino lo agrega
				//[DEPRECATED]

				//Cambia la URL a que apunta el IFrame
				CargarIframeURL('frame_navegador', document.form_barra_navegacion.url.value);
			}

		function ActualizarBarraURL()
			{
				//Actualiza periodicamente la barra de URL del navegador embebido

				//Llama periodicamente la rutina de actualizacion de la barra
				window.setTimeout(ActualizarBarraURL, 10000);
			}
			

		//Ajusta tamano de la consola en cada cambio de tamano de la ventana
		$( window ).resize(function() {
			PEXPLORER_RecalcularMaquetacion();
		});

		//Inicializacion
		PEXPLORER_RecalcularMaquetacion();
		ActualizarBarraURL();
	</script>

</body>
</html>
