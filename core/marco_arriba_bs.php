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
	Title: Seccion superior
	Ubicacion *[/core/marco_arriba_bs.php]*.  Archivo con inclusiones a los estilos y scripts basicos para diagramacion

	Salida:
		Inclusion de archivos asociados a bootstrap, fuentes, plugins, etc.

	Ver tambien:
		Uso de la variable <Precarga_EstilosBS>
	*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <script type="text/javascript">
        //Tiempo inicial de carga
        var tiempo_inicio_javascript = (new Date()).getTime();
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="generator" content="Practico <?php  $version = file("inc/version_actual.txt"); echo trim($version[0]); ?>" />
	<meta name="description" content="Generador de aplicaciones web - www.practico.org" />
    <meta name="author" content="John Arroyave G. - {www.practico.org} - {unix4you2 at gmail.com}">
	<title><?php echo $NombreRAD; ?> <?php echo trim($version[0]); ?></title>

    <!-- CSS Core de Bootstrap -->
    <link href="inc/bootstrap/css/bootstrap.min.css" rel="stylesheet"  media="screen">
    <link href="inc/bootstrap/css/bootstrap-theme.css" rel="stylesheet"  media="screen">
    
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- CSS Plugins BootStrap -->
    <link href="inc/bootstrap/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/morris.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/timeline.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/social-buttons.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/datepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/slider/slider.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/select/bootstrap-select.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/iconpicker/bootstrap-iconpicker.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- CSS Personalizado (Plantilla y Practico) -->
    <link href="inc/bootstrap/css/sb-admin-2.css" rel="stylesheet">
    <link href="inc/bootstrap/css/practico.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="inc/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="inc/ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css">
    <link href="inc/octicons/octicons.css" rel="stylesheet" type="text/css">
    <link href="inc/typicons/typicons.css" rel="stylesheet" type="text/css">
    <link href="inc/weather-icons/css/weather-icons.min.css" rel="stylesheet" type="text/css">
    <!--<link href="inc/elusive-iconfont/css/elusive-webfont.css" rel="stylesheet" type="text/css">-->
    <!--<link href="inc/map-icons/css/map-icons.css" rel="stylesheet" type="text/css">-->

    <!-- JavaScript Personalizado -->
	<script type="text/javascript" src="inc/practico/javascript/validaform.js"></script>
	<script type="text/javascript" src="inc/practico/javascript/html5slider.js"></script>

	<link type="text/css" rel="stylesheet" media="all" href="inc/chat/css/chat.css" />
	<!--<link type="text/css" rel="stylesheet" media="all" href="inc/chat/css/screen.css" />-->
	<!--[if lte IE 7]>
	<link type="text/css" rel="stylesheet" media="all" href="inc/chat/css/screen_ie.css" />
	<![endif]-->

	<link rel="shortcut icon" href="img/favicon.ico"/>
	<script language="JavaScript">
		function PCO_VentanaPopup(theURL,winName,features)
			{ 
				window.open(theURL,winName,features);
			}
	</script>
</head>
