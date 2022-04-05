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


	/*
	Title: Seccion superior
	Ubicacion *[/core/marco_arriba_bs.php]*.  Archivo con inclusiones a los estilos y scripts basicos para diagramacion

	Salida:
		Inclusion de archivos asociados a bootstrap, fuentes, plugins, etc.

	Ver tambien:
		Uso de la variable <Precarga_EstilosBS>
	*/
?><!DOCTYPE html>
<html lang="<?php echo $IdiomaPredeterminado; ?>">
<head>
    <script type="text/javascript">
        //Tiempo inicial de carga
        var tiempo_inicio_javascript = (new Date()).getTime();
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="generator" content="Practico <?php  $PCO_VersionActual = file("inc/version_actual.txt"); $PCO_VersionActual = trim($PCO_VersionActual[0]); echo $PCO_VersionActual; ?>" />
	<meta name="description" content="Generador de aplicaciones web - www.practico.org" />
    <meta name="theme-color" content="<?php echo $PCO_ColorFondoGeneral; ?>"/>
    <meta name="author" content="John Arroyave G. - {www.practico.org} - {unix4you2 at gmail.com}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">

	<title><?php echo $NombreRAD; ?> <?php echo $Version_Aplicacion; ?></title>

    <!-- CSS Core de Bootstrap -->
    <?php
        //Define el tema por defecto para versiones previas a 17.4-001
        if ($Tema_PracticoFramework=="")  $Tema_PracticoFramework="bootstrap";
        
        if ($Tema_PracticoFramework!="material")
            {
                echo '<link href="inc/bootstrap/css/tema_'.$Tema_PracticoFramework.'.min.css" rel="stylesheet" id="tema-base-bootstrap" media="screen">';
                //Si el tema es el predeterminado conserva efectos de controles en versiones previas a 17.4-001
                if ($Tema_PracticoFramework=="bootstrap")
                    echo '<link href="inc/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet"  media="screen">';
            }
        else
            {
                echo '<link href="inc/bootstrap/css/tema_bootstrap.min.css" rel="stylesheet"  media="screen">';
                echo '
                  <!-- Material Design fonts -->
                  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
                  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">

                  <!-- Bootstrap Material Design -->
                  <link rel="stylesheet" type="text/css" href="inc/bootstrap-material-design/css/bootstrap-material-design.css">
                  <link rel="stylesheet" type="text/css" href="inc/bootstrap-material-design/css/ripples.min.css">';
            }
    ?>

    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- CSS Plugins BootStrap -->
    <link href="inc/bootstrap/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/morris.css?<?php echo filemtime('inc/bootstrap/css/plugins/morris.css'); ?>" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/timeline.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/datepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/slider/slider.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/select/bootstrap-select.min.css?<?php echo filemtime('inc/bootstrap/css/plugins/select/bootstrap-select.min.css'); ?>" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/iconpicker/bootstrap-iconpicker.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/simple-sidebar.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/toggle/bootstrap-toggle.css" rel="stylesheet">

    <!-- CSS Plugins DataTables -->
    <link href="inc/bootstrap/css/plugins/responsive.dataTables.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/buttons.dataTables.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/dataTables/searchPanes.dataTables.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/dataTables/select.dataTables.min.css" rel="stylesheet">

    <!-- Estilos especificos para botones de exportacion de informes y paginador -->
    <style>
        .dataTables_length{
            float:left;
            }

        div.dt-buttons{
            margin:2px;
            position:relative;
            float:right;
            font-size:11px;
            font-weight: bold;

            }

        .InformeBotonCopiar{
            margin-left:10px !important;
            padding: 5px !important;
            color:gray !important;
            }
        .InformeBotonCsv{
            padding: 5px !important;
            color:black !important;
            }
        .InformeBotonExcel{
            padding: 5px !important;
            color:green !important;
            }
        .InformeBotonPdf{
            padding: 5px !important;
            color:red !important;
            }
    </style>

    <!-- CSS Plugin Gantt -->
    <link href="inc/jquery/plugins/gantt-master/css/style.css" type="text/css" rel="stylesheet">

    <?php
        //Determina si se tiene algun filtro de color POR DEFECTO en toda la plataforma y lo aplica
        $PCOVAR_CadenaFiltroColores="";
        
        //Determina si el usuario tiene o no un perfil de colores seleccionado y lo utiliza
        if ($PCOSESS_TransformacionPaleta!="") $PCO_TransformacionColores=$PCOSESS_TransformacionPaleta;
        
        if ($PCO_TransformacionColores!="")
            {
                switch ($PCO_TransformacionColores) {
                    //Inverso para modos dia y noche
                    case 'inverso':
                        $PCOVAR_CadenaFiltroColores="
                            <style>
                                html {
                                    filter: invert(100%);
                                }
                                
                                html img,video,iframe {
                                    filter: invert(100%);
                                }
                        
                                .modal-backdrop {
                                   filter: invert(100%);
                                }
                            </style>";
                        break;

                    //Escala de grises
                    case 'grises':
                        $PCOVAR_CadenaFiltroColores="
                            <style>
                                html {
                                    filter: grayscale(100%);
                                }
                            </style>";
                        break;
                    //Tonos Sepia

                    case 'sepia':
                        $PCOVAR_CadenaFiltroColores="
                            <style>
                                html {
                                    filter: sepia(85%);
                                }
                            </style>";                        
                        break;

                     //Sin cambios - predeterminado
                    default:
                        $PCOVAR_CadenaFiltroColores="";
                        break;
                }
            }
        echo $PCOVAR_CadenaFiltroColores;
    ?>

	<script language="JavaScript">
	    //TODO: Para cambiar dinamicamente por el usuario
    	/*
            html.dark-mode {
                filter: invert(100%);
                background: black;
            }
            
            html.dark-mode img,video,iframe {
                filter: invert(100%);
            }
    	
    	*/
		//document.documentElement.classList.toggle('dark-mode');   
	</script>

    <link href="inc/summernote/summernote.min.css" rel="stylesheet">
    <!-- CSS Personalizado (Plantilla y Practico) -->
    <?php 
        //Evita el cargue si se trata de una opcion especifica
        if ($PCO_Accion!="PCOMOD_CargarPcoder") {
    ?>
        <link href="inc/bootstrap/css/sb-admin-2.css" rel="stylesheet">
        <link href="inc/bootstrap/css/practico.min.css" rel="stylesheet">
    <?php 
        }
    ?>

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

    <!-- JavaScript Conversiones HTML-Canvas -->
	<script type="text/javascript" src="inc/html2canvas/0.5/html2canvas.min.js"></script>

	<link type="text/css" rel="stylesheet" media="all" href="inc/chat/css/chat.css" />
	<!--<link type="text/css" rel="stylesheet" media="all" href="inc/chat/css/screen.css" />-->
	<!--[if lte IE 7]>
	<link type="text/css" rel="stylesheet" media="all" href="inc/chat/css/screen_ie.css" />
	<![endif]-->

	<link rel="shortcut icon" href="img/favicon.ico?v=3"/>
	<script language="JavaScript">
		function PCO_VentanaPopup(theURL,winName,features)
			{ 
				window.open(theURL,winName,features);
			}
        function PCO_AgregarElementoDiv(marco,elemento)
            {
                //carga dinamicamente objetos html a marcos
                var capa = document.getElementById(marco);
                var zona = document.createElement("NuevoElemento");
                zona.innerHTML = elemento;
                capa.appendChild(zona);
            }
	</script>

    <!-- jQuery -->
	<script type="text/javascript" src="inc/jquery/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="inc/jquery/plugins/jquery-migrate-3.3.2.js"></script> <!-- sin min para desarrollo -->

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="inc/bootstrap/js/bootstrap.min.js"></script>

    <!-- Boostrap-Select -->
    <script type="text/javascript" src="inc/bootstrap/js/plugins/select/bootstrap-select.min.js?<?php echo filemtime('inc/bootstrap/js/plugins/select/bootstrap-select.min.js'); ?>"></script>

    <!-- AJAX para Boostrap-Select -->
    <script src="inc/bootstrap/js/plugins/ajax-bootstrap-select/ajax-bootstrap-select.min.js?<?php echo filemtime('inc/bootstrap/js/plugins/ajax-bootstrap-select/ajax-bootstrap-select.min.js'); ?>"></script>

    <script type="text/javascript" src="inc/bootstrap/js/plugins/toggle/bootstrap-toggle.min.js"></script>

    <script src="inc/jquery/plugins/jszip.min.js"></script>
    <!--<script src="inc/jquery/plugins/pdfmake.min.js"></script>-->
    <script src="inc/jquery/plugins/pdfmake-0.1.71/pdfmake.min.js"></script>
    <script src="inc/jquery/plugins/vfs_fonts.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="inc/bootstrap/js/plugins/morris/raphael.min.js?<?php echo filemtime('inc/bootstrap/js/plugins/morris/raphael.min.js'); ?>"></script>
    <script src="inc/bootstrap/js/plugins/morris/regression.min.js?<?php echo filemtime('inc/bootstrap/js/plugins/morris/regression.min.js'); ?>"></script>
    <script src="inc/bootstrap/js/plugins/morris/morris.min.js?<?php echo filemtime('inc/bootstrap/js/plugins/morris/morris.min.js'); ?>"></script>

    <!-- AJAX para Boostrap-Select -->
    <link  rel="stylesheet" href="inc/bootstrap/css/plugins/ajax-bootstrap-select/ajax-bootstrap-select.min.css" rel="stylesheet">

    <!-- ReactJS -->
    <script src="inc/reactjs/react.production.min.js" crossorigin></script>  <!-- react.production.min.js | react.development.js -->
    <script src="inc/reactjs/react-dom.production.min.js" crossorigin></script>

    <?php
        // Agrega soporte para PWA si aplica
        if ($PWA_Activa=="1")
            {
                echo '<link rel="manifest" href="pwa/manifest.json">'; //?'.filemtime('pwa/manifest.json').'
    ?>
        	<script language="JavaScript">
                if (!('serviceWorker' in navigator))
                    {
                        console.log('Practico Framework: Service worker not supported in your browser');
                    }
                else
                    {
                        navigator.serviceWorker.register('pwa/service-worker.js?<?php echo filemtime('pwa/service-worker.js'); ?>')
                        .then(function() {
                          console.log('Practico Framework: Service Worker REGISTERED');
                        })
                        .catch(function(error) {
                          console.log('Practico Framework: Service Worker Registration failed:', error);
                        });
                    }
        	</script>
    <?php
            } //Fin PWA_Activa
    ?>    

    <!-- JavaScript Personalizado -->
	<script type="text/javascript" src="mod/personalizadas_js.js?<?php echo filemtime('mod/personalizadas_js.js'); ?>"></script>

  <!-- Agrega soporte para "Add to home screen" para Safari en iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="<?php echo $Nombre_Aplicacion; ?>">
  <link rel="apple-touch-icon" href="pwa/launcher-icon-152.png">
  <meta name="msapplication-TileImage" content="pwa/launcher-icon-144.png">
  <meta name="msapplication-TileColor" content="#2F3BA2">
</head>