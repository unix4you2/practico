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