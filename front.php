<?php
// include_once 'core/configuracion.php';
// // Inicia las conexiones con la BD y las deja listas para las operaciones
// include_once 'core/conexiones.php';
// // Incluye definiciones comunes de la base de datos
// include_once 'inc/practico/def_basedatos.php';
// // Incluye archivo con algunas funciones comunes usadas por la herramienta
// include_once 'core/comunes.php';
// include 'core/marco_arriba.php';
// include 'core/marco_arriba_bs.php';
// echo "hola mundo";
?>









<html lang="es">
<head>
    <script type="text/javascript">
        //Tiempo inicial de carga
        var tiempo_inicio_javascript = (new Date()).getTime();
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="generator" content="Practico 19.5" />
	<meta name="description" content="Generador de aplicaciones web - www.practico.org" />
    <meta name="theme-color" content="#ffffff"/>
    <meta name="author" content="John Arroyave G. - {www.practico.org} - {unix4you2 at gmail.com}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">

	<title>Practico </title>

    <!-- CSS Core de Bootstrap -->
    <link href="inc/bootstrap/css/tema_bootstrap.min.css" rel="stylesheet" id="tema-base-bootstrap" media="screen"><link href="inc/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet"  media="screen">
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- CSS Plugins BootStrap -->
    <link href="inc/bootstrap/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/morris.css?1537032336" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/timeline.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/datepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/slider/slider.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/select/bootstrap-select.min.css?1429564861" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/iconpicker/bootstrap-iconpicker.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/simple-sidebar.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/toggle/bootstrap-toggle.css" rel="stylesheet">

<!--
    <link href="inc/bootstrap/css/plugins/jquery.dataTables.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/buttons.bootstrap.min.css" rel="stylesheet">


-->
    <link href="inc/bootstrap/css/plugins/buttons.dataTables.min.css" rel="stylesheet">

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






























    <link href="inc/summernote/summernote.css" rel="stylesheet">
    <!-- CSS Personalizado (Plantilla y Practico) -->
            <link href="inc/bootstrap/css/sb-admin-2.css" rel="stylesheet">
        <link href="inc/bootstrap/css/practico.min.css" rel="stylesheet">
    
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
	<script type="text/javascript" src="inc/jquery/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="inc/bootstrap/js/plugins/select/bootstrap-select.min.js?1429564861"></script>
    <script type="text/javascript" src="inc/bootstrap/js/plugins/toggle/bootstrap-toggle.min.js"></script>

    <script src="inc/jquery/plugins/jszip.min.js"></script>
    <script src="inc/jquery/plugins/pdfmake.min.js"></script>
    <script src="inc/jquery/plugins/vfs_fonts.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="inc/bootstrap/js/plugins/morris/raphael.min.js?1553399384"></script>
    <script src="inc/bootstrap/js/plugins/morris/regression.min.js?1482094307"></script>
    <script src="inc/bootstrap/js/plugins/morris/morris.min.js?1537032336"></script>
    <link rel="manifest" href="pwa/manifest.json?1566331239">        	<script language="JavaScript">
                if (!('serviceWorker' in navigator))
                    {
                        console.log('Practico Framework: Service worker not supported in your browser');
                    }
                else
                    {
                        navigator.serviceWorker.register('pwa/service-worker.js?1525818913')
                        .then(function() {
                          console.log('Practico Framework: Service Worker REGISTERED');
                        })
                        .catch(function(error) {
                          console.log('Practico Framework: Service Worker Registration failed:', error);
                        });
                    }
        	</script>
        

  <!-- Agrega soporte para "Add to home screen" para Safari en iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="">
  <link rel="apple-touch-icon" href="pwa/launcher-icon-152.png">
  <meta name="msapplication-TileImage" content="pwa/launcher-icon-144.png">
  <meta name="msapplication-TileColor" content="#2F3BA2">
</head>
<body oncontextmenu="return false;"  style="background-color: #ffffff;">
    <noscript>
      <div style="width: 22em; position: absolute; left: 50%; margin-left: -11em; color: red; background-color: white; border: 1px solid red; padding: 4px; font-family: sans-serif">
        Your web browser must have JavaScript enabled in order for this application to display correctly.
      </div>
    </noscript>
    <!--Marco oculto para generacion de formularios y elementos dinamicos anidados -->
    <div id="PCODIV_FormulariosDinamicos" style="visibility: hidden; display: none;"></div>

<!-- INICIA MARCO DE CHAT -->
<!-- <div id="main_container" style="overflow: auto;"> -->

    <div id="wrapper">
 
 
        <!-- Sidebar oculto al lado izquierdo -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav btn-xs">
                <div id="PCODIV_SeccionLateralFlotanteUsoInterno" align=right></div>
                <div id="PCODIV_SeccionLateralFlotante" align=right></div>
            </ul>
        </div>
        <!--Elemento requerido para uso de barra lateral oculta-->
        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle" style="display: none; visibility:hidden;"></a>
        <!-- /#sidebar-wrapper oculto al lado izquierdo-->

		


<!-- Navigation -->
<nav id="BarraNavegacionSuperior" class="navbar navbar-default navbar-static-top oculto_impresion" role="navigation" style="margin-bottom: 0">

	
	<div class="navbar-header" >
		<button OnClick="document.getElementById('barra_navegacion_izquierda').style.visibility='visible';" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#PCO_BarraNavegacionIzquierda">
			<i class="fa fa-bars"></i>
		</button>
		<a class="navbar-brand" href="javascript:document.PCO_FormVerMenu.submit();"><img id="PCO_LogoAplicacion" width="115" height="30" src="img/logo.png?1525818912" border="0" ALT="Practico"></a>
	</div>


	<!-- /.navbar-header -->



	<ul class="nav navbar-top-links navbar-right">

	
	</ul>
	<!-- CIERRA /.navbar-top-links -->


</nav>

<script language="JavaScript">
    //Oculta la barra de navegacion superior a los usuarios estandar segun la configuracion y en algunas secciones fijas del sistema
    //VEASE FUNCION HERMANA AL FINAL DE MARCO_NAVIZQ PARA OCULTAR BOTON DE DESPLIEGUE DE BARRA IZQUIERDA
    $("#BarraNavegacionSuperior").hide();</script>

<script language="javascript">
    function PCO_CargarReportarBugs()
        {
            //Activa el proceso de captura de trazas y demas informacion
            $('#PCO_IconoBugTracker').addClass('fa fa-spin fa-spinner').removeClass('fa-bug');
            $('#PCO_TextoBugTracker').text(' ...');
            //Captura otros datos informativos de la aplicacion
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="TRAZAS DE APLICACION / APPLICATION DEBUG\n==================================================\n";
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+=":"+$('#PCO_TCarga').text()+" seg.";
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="       JS:"+$('#PCO_TCargaJS').text()+" seg.\n";
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+=":  "+"\n";
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+=": "+"\n";
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+=":  "+"\n";
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="Inclusiones: 8"+"+1?\n";
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="PHP_VERSION: 5.6.40   MEMORY_GET_USAGE: 1548312 bytes"+"\n";
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="MEMORY_PEAK_USAGE: 1720240 bytes"+"\n";
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nOS CLIENTE: LINUX"+"\n";
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nGET_BROWSER: "+"\n";
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nGET_DEFINED_VARS: "+"\n";
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nGET_ALL_HEADERS: \n    dev.practico.org\n    keep-alive\n    max-age=0\n    1\n    Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\n    navigate\n    ?1\n    text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3\n    none\n    gzip, deflate, br\n    en-US,en;q=0.9,es-US;q=0.8,es;q=0.7\n    PHPSESSID=7jcbfe7p9ej5t7vtpj55kpngq1"+"\n";
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nGET_LOADED_EXTENSIONS: , Core, date, ereg, libxml, openssl, pcre, zlib, filter, hash, Reflection, SPL, session, standard, apache2handler, bz2, calendar, ctype, curl, dom, mbstring, fileinfo, ftp, gd, gettext, iconv, exif, mysqlnd, PDO, Phar, posix, shmop, SimpleXML, sockets, sqlite3, sysvmsg, sysvsem, sysvshm, tokenizer, xml, xmlwriter, xsl, mysql, mysqli, pdo_mysql, pdo_sqlite, wddx, xmlreader, json, zip, mhash"+"\n";
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nDEBUG_TRACE: \n    /mnt/datos/webserver/practico/core/marco_nav.php\n    308\n    ImprimirArregloVariablesInternas\n    debug_backtrace\n    /mnt/datos/webserver/practico/core/marco_arriba.php\n    125\n    /mnt/datos/webserver/practico/core/marco_nav.php\n    include_once\n    /mnt/datos/webserver/practico/front.php\n    12\n    /mnt/datos/webserver/practico/core/marco_arriba.php\n    include"+"\n";
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nINI_GET_ALL: , 1, 1, 4, , , 4, 0, 0, 6, &, &, 6, &, &, 7, , , 6, 1, 1, 7, 0, 0, 7, , , 7, 0, 0, 7, 1, 1, 7, , , 6, 0, 0, 7, 1, 1, 6, , , 6, , , 4, , , 4, 31.7667, 31.7667, 7, 35.2333, 35.2333, 7, 90.583333, 90.583333, 7, 90.583333, 90.583333, 7, , , 7, UTF-8, UTF-8, 7, text/html, text/html, 7, 60, 60, 7, , , 4, , , 4, , , 7, , , 7, , , 4, , , 7, , , 7, , , 4, 1, 1, 6, 1, 1, 7, , , 7, , , 7, , , 7, 24575, 24575, 7, JIS, JIS, 7, JIS, JIS, 7, UCS-2LE, UCS-2LE, 7, UCS-2BE, UCS-2BE, 7, , , 7, ISO-8859-15, ISO-8859-15, 7, 0, 0, 7, 1, 1, 4, /usr/lib64/php/modules, /usr/lib64/php/modules, 4, 1, 1, 4, unsafe_raw, unsafe_raw, 6, , , 6, , , 7, 0, 0, 7, #FF8000, #FF8000, 7, #0000BB, #0000BB, 7, #000000, #000000, 7, #007700, #007700, 7, #DD0000, #DD0000, 7, , , 7, , , 7, , , 7, , , 7, , , 7, , , 7, 0, 0, 7, , , 7, .:/usr/share/pear:/usr/share/php, .:/usr/share/pear:/usr/share/php, 7, , , 7, , , 7, 0, 0, 7, 1, 1, 7, 1024, 1024, 7, 1, 1, 6, , , 6, , , 6, 30, 30, 7, 20, 20, 6, 64, 64, 6, 60, 60, 6, 1000, 1000, 6, , , 7, 0, 0, 6, 0, 0, 4, , , 7, , , 7, ^(text/|application/xhtml\+xml), ^(text/|application/xhtml\+xml), 7, , , 7, neutral, neutral, 7, 0, 0, 7, , , 7, 128M, 128M, 7, 1, 1, 4, 1, 1, 4, 60, 60, 7, , , 7, , , 7, , , 7, /var/lib/mysql/mysql.sock, /var/lib/mysql/mysql.sock, 7, , , 7, -1, -1, 4, -1, -1, 4, , , 7, 1, 1, 4, 1, 1, 4, , , 7, 3306, 3306, 7, , , 7, /var/lib/mysql/mysql.sock, /var/lib/mysql/mysql.sock, 7, , , 7, -1, -1, 4, -1, -1, 4, , , 4, 0, 0, 4, 0, 0, 4, 1, 1, 7, , , 4, 0, 0, 7, 0, 0, 7, 16000, 16000, 7, 4096, 4096, 7, 32768, 32768, 7, 31536000, 31536000, 4, , , 2, , , 4, , , 7, , , 2, , , 2, 4096, 4096, 6, , , 7, , , 6, 1000000, 1000000, 7, 100000, 100000, 7, /var/lib/mysql/mysql.sock, /var/lib/mysql/mysql.sock, 4, , , 4, 1, 1, 7, 1, 1, 7, 8M, 8M, 6, 14, 14, 7, 16K, 16K, 4, 120, 120, 4, , , 6, 1, 1, 7, 1, 1, 7, GP, GP, 6, , , 7, /usr/sbin/sendmail -t -i, /usr/sbin/sendmail -t -i, 4, 100, 100, 7, 0, 0, 2, 180, 180, 7, nocache, nocache, 7, , , 7, , , 7, 0, 0, 7, /, /, 7, , , 7, , , 7, 0, 0, 7, 1000, 1000, 7, 1440, 1440, 7, 1, 1, 7, 5, 5, 7, 0, 0, 7, PHPSESSID, PHPSESSID, 7, , , 7, files, files, 7, /var/lib/php/session, /var/lib/php/session, 7, php, php, 7, 1, 1, 2, 1, 1, 2, 1%, 1%, 2, 1, 1, 2, PHP_SESSION_UPLOAD_PROGRESS, PHP_SESSION_UPLOAD_PROGRESS, 2, upload_progress_, upload_progress_, 2, 1, 1, 7, 1, 1, 7, 0, 0, 7, 0, 0, 7, , , 6, localhost, localhost, 7, 25, 25, 7, , , 4, , , 4, , , 4, , , 7, , , 7, 8M, 8M, 6, , , 4, a=href,area=href,frame=src,input=src,form=fakeentry, a=href,area=href,frame=src,input=src,form=fakeentry, 7, , , 7, , , 4, 300, 300, 4, .user.ini, .user.ini, 4, GPCS, GPCS, 6, 0, 0, 7, 0, 0, 7, 0, 0, 4, 44, 44, 7, 1, 1, 7, 1, 1, 7, 0, 0, 2, , , 7, , , 7, -1, -1, 7, , , 7"+"\n";
            //Captura pantallazo del navegador
            CapturarCanvasPantallaAImagen('','PCO_ReportarBugsCapturaOculta','image/png',0,0,'PCO_ReportarBugs','PCO_CapturaPantalla');
        }
</script>






<script language="JavaScript">
    //Oculta la barra de navegacion superior a los usuarios estandar segun la configuracion y en algunas secciones fijas del sistema
    //VEASE FUNCION HERMANA EN MARCO_NAV.PHP QUE SE ENCARGA DE OCULTAR LA BARRA SUPERIOR
    $("#boton_menu_izquierdo").hide();</script>


        <!-- CONTENIDO DE APLICACION   -->
        <div id="page-wrapper" style="background-color: #ffffff; background-image: url('https://dev.practico.org:443/practico/front.php/img/fondo.png?'); background-repeat: no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; ">  <!-- page-content-wrapper -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        
												<div id="PCODIV_ArribaMenuSuperior"></div>
						



<form method="POST" name="PCO_FormVerMenu"  class="oculto_impresion" action="" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="PCO_VerMenu">
    <input type="Hidden" name="Presentar_FullScreen" value="">
    <input type="Hidden" name="Precarga_EstilosBS" value="">
</form>
<form method="POST" name="cerrar_sesion"  class="oculto_impresion" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="Terminar_sesion">
</form>
<form method="POST" name="PCO_EditarConfiguracionOAuth"  class="oculto_impresion" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="PCO_CargarObjeto">
	<input type="Hidden" name="PCO_Objeto" value="frm:-5:1">
</form>
<form method="POST" name="actualizar_perfil"  class="oculto_impresion" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="PCO_ActualizarPerfilUsuario">
</form>
<form method="POST" name="reseteo_clave"  class="oculto_impresion" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="PCO_CambiarContrasena">
</form>
<form method="POST" name="PCO_MisInformes"  class="oculto_impresion"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="PCO_MisInformes">
</form>
<form method="POST" name="fileman_admin_embebido"  class="oculto_impresion" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="fileman_admin_embebido">
</form>
<form method="POST" id="PCO_ReportarBugs"  class="oculto_impresion" name="PCO_ReportarBugs" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <div id="PCO_ReportarBugsCapturaOculta" class="oculto_impresion" style="visibility: hidden; display:none;">
    </div>
    <input type="Hidden" name="PCO_Accion" value="PCO_ReportarBugs">
    <input type="Hidden" name="PCO_CapturaPantalla" id="PCO_CapturaPantalla" value="">
    <input type="Hidden" name="PCO_CapturaTrazas" id="PCO_CapturaTrazas" value="">
</form>

<form name="FRMBASEINFORME" id="FRMBASEINFORME"  class="oculto_impresion" action="" method="POST" target="_self">
    <input type="Hidden" name="PCO_Accion" value="">
    <input type="Hidden" name="tabla" value="">  <!-- Compatibilidad hacia atras -->
    <input type="Hidden" name="campo" value="">  <!-- Compatibilidad hacia atras -->
    <input type="Hidden" name="valor" value="">  <!-- Compatibilidad hacia atras -->
    <input type="Hidden" name="objeto" value=""> <!-- Compatibilidad hacia atras -->
    <input type="Hidden" name="PCO_Tabla" value="">
    <input type="Hidden" name="PCO_Campo" value="">
    <input type="Hidden" name="PCO_Valor" value="">
    <input type="Hidden" name="PCO_Objeto" value="">
    <input type="Hidden" name="Presentar_FullScreen" value="">
    <input type="Hidden" name="Precarga_EstilosBS" value="">
</form>


<form name="PCO_AdministrarTablas"  class="oculto_impresion" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="PCO_AdministrarTablas">
</form>
<form name="PCO_AdministrarFormularios"  class="oculto_impresion" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="PCO_AdministrarFormularios">
</form>
<form name="PCOFUNC_AdministrarMenu"  class="oculto_impresion" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="PCOFUNC_AdministrarMenu">
	<input type="Hidden" name="PCO_FormularioActivoEdicionMenu" value="">
</form>
<form name="PCO_AdministrarInformes"  class="oculto_impresion" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="PCO_AdministrarInformes">
</form>
<form name="PCO_ListarUsuarios"  class="oculto_impresion" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="PCO_ListarUsuarios">
</form>
<form name="PCO_PanelAuditoriaMovimientos"  class="oculto_impresion" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="PCO_PanelAuditoriaMovimientos">
</form>
<form name="PCO_ExplorarTablerosKanban"  class="oculto_impresion" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="PCO_ExplorarTablerosKanban">
</form>
<form name="PCO_BugTrackingForm"  class="oculto_impresion" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="PCO_CargarObjeto">
	<input type="Hidden" name="PCO_Objeto" value="frm:-4:1">
</form>
<form name="PCO_VerTareasCron"  class="oculto_impresion" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="PCO_CargarObjeto">
	<input type="Hidden" name="PCO_Objeto" value="frm:-16:1">
</form>
<form name="PCO_VerReplicaciones"  class="oculto_impresion" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="PCO_CargarObjeto">
	<input type="Hidden" name="PCO_Objeto" value="frm:-10:1">
</form>
<form name="PCO_VerMonitoreo"  class="oculto_impresion" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="PCO_CargarObjeto">
	<input type="Hidden" name="PCO_Objeto" value="frm:-11:1">
</form>

					<div id="PCODIV_AbajoMenuSuperior"></div>

	<!-- INICIO  DE CONTENIDOS DE APLICACION DISENADA POR EL USUARIO --><html lang="es">
<head>
    <script type="text/javascript">
        //Tiempo inicial de carga
        var tiempo_inicio_javascript = (new Date()).getTime();
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="generator" content="Practico 19.5" />
	<meta name="description" content="Generador de aplicaciones web - www.practico.org" />
    <meta name="theme-color" content="#ffffff"/>
    <meta name="author" content="John Arroyave G. - {www.practico.org} - {unix4you2 at gmail.com}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">

	<title>Practico </title>

    <!-- CSS Core de Bootstrap -->
    <link href="inc/bootstrap/css/tema_bootstrap.min.css" rel="stylesheet" id="tema-base-bootstrap" media="screen"><link href="inc/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet"  media="screen">
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- CSS Plugins BootStrap -->
    <link href="inc/bootstrap/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/morris.css?1537032336" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/timeline.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/datepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/slider/slider.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/select/bootstrap-select.min.css?1429564861" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/iconpicker/bootstrap-iconpicker.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/simple-sidebar.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/toggle/bootstrap-toggle.css" rel="stylesheet">

<!--
    <link href="inc/bootstrap/css/plugins/jquery.dataTables.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/buttons.bootstrap.min.css" rel="stylesheet">


-->
    <link href="inc/bootstrap/css/plugins/buttons.dataTables.min.css" rel="stylesheet">

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






























    <link href="inc/summernote/summernote.css" rel="stylesheet">
    <!-- CSS Personalizado (Plantilla y Practico) -->
            <link href="inc/bootstrap/css/sb-admin-2.css" rel="stylesheet">
        <link href="inc/bootstrap/css/practico.min.css" rel="stylesheet">
    
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
	<script type="text/javascript" src="inc/jquery/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="inc/bootstrap/js/plugins/select/bootstrap-select.min.js?1429564861"></script>
    <script type="text/javascript" src="inc/bootstrap/js/plugins/toggle/bootstrap-toggle.min.js"></script>

    <script src="inc/jquery/plugins/jszip.min.js"></script>
    <script src="inc/jquery/plugins/pdfmake.min.js"></script>
    <script src="inc/jquery/plugins/vfs_fonts.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="inc/bootstrap/js/plugins/morris/raphael.min.js?1553399384"></script>
    <script src="inc/bootstrap/js/plugins/morris/regression.min.js?1482094307"></script>
    <script src="inc/bootstrap/js/plugins/morris/morris.min.js?1537032336"></script>
    <link rel="manifest" href="pwa/manifest.json?1566331239">        	<script language="JavaScript">
                if (!('serviceWorker' in navigator))
                    {
                        console.log('Practico Framework: Service worker not supported in your browser');
                    }
                else
                    {
                        navigator.serviceWorker.register('pwa/service-worker.js?1525818913')
                        .then(function() {
                          console.log('Practico Framework: Service Worker REGISTERED');
                        })
                        .catch(function(error) {
                          console.log('Practico Framework: Service Worker Registration failed:', error);
                        });
                    }
        	</script>
        

  <!-- Agrega soporte para "Add to home screen" para Safari en iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="">
  <link rel="apple-touch-icon" href="pwa/launcher-icon-152.png">
  <meta name="msapplication-TileImage" content="pwa/launcher-icon-144.png">
  <meta name="msapplication-TileColor" content="#2F3BA2">
  
  
  
<link rel="stylesheet" href="inc/bootstrap/css/plugins/ajax-bootstrap-select/ajax-bootstrap-select.min.css">
<script                 src="inc/bootstrap/js/plugins/ajax-bootstrap-select/ajax-bootstrap-select.min.js"></script>


</head>

<body oncontextmenu="return false;">




















































  <div class="container">
        <select id="ajax-select-multiple" class="selectpicker with-ajax" data-live-search="true"></select>
  </div>





<script language="JavaScript">

var options = {
  values: "a, b, c",
  ajax: {
    url: "index.php",
    type: "POST",
    dataType: "json",
    // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will automatically replace it with the value of the search query.
    data: {
      q: "{{{q}}}",
      PCO_Accion: "PCO_ObtenerOpcionesAjaxSelect",
      Presentar_FullScreen: "1",
      PCO_TablaConsulta: "app_empleado",
      PCO_ListaCamposRetorno: "jefe_inmediato,nombre,'a','a'", //Campos en el siguiente orden: Valor, Texto o etiqueta, Subtexto, Icono tipo glyphicon
      PCO_ListaCamposBusqueda: "nombre",
      PCO_ParametrosOrdenamientoYLimite: " ORDER BY nombre ",
      PCO_CondicionFiltrado: ""
    }
  },
  locale: {
    emptyTitle: "Seleccione y digite para buscar"
  },
  log: 0, //Nivel de console.log del combo
  preprocessData: function(data) {
      //data=JSON.parse(data);
    var i,
      l = data.length,
      array = [];
    if (l) {
      for (i = 0; i < l; i++) {
        array.push(
          $.extend(true, data[i], {
            text: data[i].T,
            value: data[i].V,
            data: {
              subtext: data[i].S,
              icon:  data[i].I,
              //thumbnail: "pwa/launcher-icon-36.png"
            }
          })
        );
      }
    }
    // You must always return a valid array when processing data. The data argument passed is a clone and cannot be modified directly.
    return array;
  }
};




$("#ajax-select-multiple").selectpicker().filter(".with-ajax").ajaxSelectPicker(options);
$("select").trigger("change");

function chooseSelectpicker(index, selectpicker) {
  $(selectpicker).val(index);
  $(selectpicker).selectpicker('refresh');
}



</script>































<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
include 'core/marco_abajo.php';