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
?>

<?php
	//Incluye el archivo de idioma
	if (!isset($Idioma)) $Idioma="es";
	include_once("../inc/practico/idiomas/".$Idioma.".php");
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
	<meta name="description" content="Generador de aplicaciones web - www.practico.org" />
    <meta name="author" content="John Arroyave G. - {www.practico.org} - {unix4you2 at gmail.com}">

	<title>
		Pr&aacute;ctico - <?php echo $MULTILANG_Instalacion; ?>
  	</title>
    <!-- CSS de Bootstrap -->
    <link href="../inc/bootstrap/css/tema_bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="../inc/font-awesome/css/font-awesome.min.css">

    <!-- CSS Personalizado (Plantilla y Practico) -->
    <link href="../inc/bootstrap/css/sb-admin-2.css" rel="stylesheet">
    <link href="../inc/bootstrap/css/practico.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../inc/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<link rel="shortcut icon" href="../img/favicon.ico"/>
</head>
<body oncontextmenu="return false;">
    <form method="POST" name="cerrar_sesion" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
        <input type="Hidden" name="accion" value="Terminar_sesion">
    </form>
    <div id="wrapper">

    <?php
        //Presenta titulo de la aplicacion
        echo "<a class='btn btn-block'><img src='../img/logo.png' border='0'> $MULTILANG_SubtituloPractico1 - $MULTILANG_SubtituloPractico2 <i><b> $MULTILANG_Version"; include("../inc/version_actual.txt"); echo "</b></i><br>$MULTILANG_InstaladorAplicacion</a>";
    ?>

        <!-- CONTENIDO DE APLICACION -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <br>


	<!-- INICIO  DE CONTENIDOS DE APLICACION -->