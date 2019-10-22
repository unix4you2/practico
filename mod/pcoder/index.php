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

	// Agrega las variables de sesion
	if (!empty($_SESSION)) extract($_SESSION);

    //Permite WebServices propios mediante el acceso a este script en solicitudes Cross-Domain
    header('Access-Control-Allow-Origin: *');
    header('access-control-allow-credentials: true');
	header('Content-type: text/html; charset=utf-8');

	//Habilita o deshabilita el modo de depuracion de la aplicacion
	$ModoDepuracion=0;
    if ($ModoDepuracion==1)
        {
            ini_set("display_errors", 1);
            error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE | E_DEPRECATED | E_STRICT | E_USER_DEPRECATED | E_USER_ERROR | E_USER_WARNING); //Otras disponibles | E_PARSE | E_CORE_ERROR | E_CORE_WARNING |
        }

    include_once("inc/configuracion.php");
    //Incluye librerias basicas de trabajo
    @require('inc/variables.php');
    @require('inc/comunes.php');
    @require('inc/comunes_bd.php');
    if ($PCO_PCODER_StandAlone==0) //███▓▓▓▒▒▒ Si es MODULO DE PRACTICO FRAMEWORK ▒▒▒▓▓▓███
        {
            // Incluye archivo de configuracion de base
            include_once '../../core/configuracion.php';
            // Inicia las conexiones con la BD y las deja listas para las operaciones
            include_once '../../core/conexiones.php';
            // Incluye definiciones comunes de la base de datos
            include_once '../../inc/practico/def_basedatos.php';
            // Incluye archivo con algunas funciones comunes usadas por la herramienta
            include_once '../../core/comunes.php';
            //Agrega idiomas de Practico Framework
            include_once("../../inc/practico/idiomas/es.php");
            include_once("../../inc/practico/idiomas/".$IdiomaPredeterminado.".php");
        }
    //Incluye idioma espanol, o sobreescribe vbles por configuracion de usuario
    include("idiomas/es.php");
    include("idiomas/".$IdiomaPredeterminado.".php");

    // Establece la zona horaria por defecto para la aplicacion
    date_default_timezone_set($ZonaHoraria);

	// Determina si no se trabaja en modo StandAlone y verifica entonces credenciales
	if ($PCO_PCODER_StandAlone==0)
		{
			// Valida sesion activa de Practico
			if (!isset($PCOSESS_SesionAbierta)) 
				{
					echo '<head><title>Error</title><style type="text/css"> body { background-color: #000000; color: #7f7f7f; font-family: sans-serif,helvetica; } </style></head><body><table width="100%" height="100%" border=0><tr><td align=center>&#9827; Acceso no autorizado !</td></tr></table></body>';
					die();
				}
		}

	if ($PCO_PCODER_StandAlone==0) //███▓▓▓▒▒▒ Si es MODULO DE PRACTICO FRAMEWORK ▒▒▒▓▓▓███
		{
		    // Determina si es un usuario administrador para poder abrir el editor
		    if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
		        {
					echo '<head><title>Error</title><style type="text/css"> body { background-color: #000000; color: #7f7f7f; font-family: sans-serif,helvetica; } </style></head><body><table width="100%" height="100%" border=0><tr><td align=center>&#9827; Acceso no autorizado !</td></tr></table></body>';
					die();
		        }
		    else
		        $EsUnAdmin=1;
		}

	//Crea variable se sesion usada por la consola de comandos
	$_SESSION['PCONSOLE_KEY']="23456789abcdefghijkmnpqrstuvwxyz";
	$_SESSION['PEXPLORER_KEY']="23456789abcdefghijkmnpqrstuvwxyz";
    // FIN BLOQUE BASICO DE INCLUSION ##################################

    // Datos de fecha, hora y direccion IP para algunas operaciones asi como variables de compatibilidad para modulo de Practico
    $PCO_PCODER_FechaOperacion=date("Ymd");
    $PCO_PCODER_FechaOperacionGuiones=date("Y-m-d");
    $PCO_PCODER_HoraOperacion=date("His");
    $PCO_PCODER_HoraOperacionPuntos=date("H:i");
    $PCO_PCODER_DireccionAuditoria=$_SERVER ['REMOTE_ADDR'];
    $PCO_FechaOperacion=$PCO_PCODER_FechaOperacion;
    $PCO_FechaOperacionGuiones=$PCO_PCODER_FechaOperacionGuiones;
    $PCO_HoraOperacion=$PCO_PCODER_HoraOperacion;
    $PCO_HoraOperacionPuntos=$PCO_PCODER_HoraOperacionPuntos;
    $PCO_DireccionAuditoria=$PCO_PCODER_DireccionAuditoria;

	// Establece version actual del sistema
	$PCO_PCODER_VersionActual = file("inc/version_actual.txt");
	$PCO_PCODER_VersionActual = trim($PCO_PCODER_VersionActual[0]);
	
	// Si no hay una accion definida entonces inicia con la predeterminada
	if (@$PCO_Accion=="" || !isset($PCO_Accion))
		$PCO_Accion="PCOMOD_CargarPcoder";

    // Recupera variables recibidas para su uso como globales (equivale a register_globals=on en php.ini)
    if (!ini_get('register_globals'))
    {
        $PCO_PBROWSER_NumeroParametros = count($_REQUEST);
        $PCO_PBROWSER_NombresParametros = array_keys($_REQUEST);// obtiene los nombres de las varibles
        $PCO_PBROWSER_ValoresParametros = array_values($_REQUEST);// obtiene los valores de las varibles
        // crea las variables y les asigna el valor
        for($i=0;$i<$PCO_PBROWSER_NumeroParametros;$i++)
            {
                ${$PCO_PBROWSER_NombresParametros[$i]}=$PCO_PBROWSER_ValoresParametros[$i];
            }
        // Agrega ademas las variables de sesion
        if (!empty($_SESSION)) extract($_SESSION);
    }


if (@$EsUnAdmin==1 || $PCO_PCODER_StandAlone==1)
{
    //Carga el archivo recibido, si no recibe nada carga un demo
    if (@$PCODER_archivo=="")
        $PCODER_archivo = "demos/demo.txt";

    //Incluye archivo con funciones basicas de PCoder
	include_once("inc/lib_pcoder.php");



/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_CargarPcoder
	Abre el Practico Code Editor y carga un archivo sobre el para su edicion

    Entradas:

        Normalmente los parametros son: ?PCO_Accion=cargar_pcoder&Presentar_FullScreen=1&Precarga_EstilosBS=1
        * Comando: javascript:PCO_VentanaPopup('index.php?PCO_Accion=PCOMOD_CargarPcoder&Presentar_FullScreen=1&Precarga_EstilosBS=1','Pcoder','toolbar=no, location=no, directories=0, directories=no, status=no, location=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, titlebar=no, width=800, height=600');

	Salida:
		Archivo para edicion en pantalla
*/

if ($PCO_Accion=="PCOMOD_CargarPcoder") 
	{
?>
 <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
<head>
	<title>{P}</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="generator" content="PCoder <?php  echo $PCO_PCODER_VersionActual; ?>" />
 	<meta name="description" content="Editor de codigo en la Nube basado en Practico Framework PHP" />
    <meta name="author" content="John Arroyave G. - {www.practico.org} - {unix4you2 at gmail.com}">

    <!-- CSS Core de Bootstrap -->
    <link href="../../inc/bootstrap/css/tema_bootstrap.min.css" rel="stylesheet"  media="screen">

    <!-- Custom Fonts -->
    <link href="../../inc/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- Estilos especificos PCoder -->
    <link href="css/pcoder.min.css?<?php echo filemtime('css/pcoder.min.css'); ?>" rel="stylesheet" type="text/css">
    
    <!-- Estilos selector de color -->
    <link rel="stylesheet" href="../../inc/jquery/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">

    <link href="../../inc/bootstrap/css/plugins/select/bootstrap-select.min.css" rel="stylesheet">

    <?php
    	if ($PCO_PCODER_StandAlone==0) //███▓▓▓▒▒▒ Si es MODULO DE PRACTICO FRAMEWORK ▒▒▒▓▓▓███
    		echo '<link type="text/css" rel="stylesheet" media="all" href="../../inc/chat/css/chat.css" />  <!-- incluye estilos para cajas de chat -->';
    ?>

    <!-- jQuery -->
	<script type="text/javascript" src="../../inc/jquery/jquery-2.1.0.min.js"></script>
	<!-- Plugins adicionales JQuery -->
	<script type="text/javascript" src="../../inc/jquery/plugins/jquery.fileTree-1.01/jquery.easing.js"></script>
	<script type="text/javascript" src="../../inc/jquery/plugins/jquery.fileTree-1.01/jqueryFileTree.js"></script>
    <link  type="text/css" href="../../inc/jquery/plugins/jquery.fileTree-1.01/jqueryFileTree.css" rel="stylesheet" media="screen">
    
    <!-- Plugins JQuery -->
	<script type="text/javascript" src="../../inc/jquery/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

</head>
<body onbeforeunload="return VerificarCierreTotalPCoder();">

	<!-- ######### FORMULARIOS Y MARCOS DE TRABAJO OCULTOS ######### -->
	<form name="form_archivo_editado" action="index.php" method="POST" target="frame_almacenamiento" style="visibility: hidden; display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
		<textarea id="PCODER_AreaTexto" name="PCODER_AreaTexto" style="visibility:hidden; display:none;"></textarea>
		<input name="PCODER_TokenEdicion" type="Hidden" value="">
		<input name="PCODER_archivo" type="Hidden" value="">
		<input name="PCODER_NroLineasDocumento" type="Hidden" value="0">
		<input name="PCODER_NroCaracteresDocumento" type="Hidden" value="0">
		<input type="Hidden" name="PCO_ECHO" value="0"> <!-- Determina si la respuesta debe ser con o sin eco -->
		<input name="PCO_Accion" type="hidden" value="PCOMOD_GuardarArchivo">
	</form>

    <!--Formulario de compatibilidad para aciones heredadas de Practico -->
    <form name="FRMBASEINFORME" id="FRMBASEINFORME" action="index.php" method="POST" target="_self">
        <input type="Hidden" name="PCO_Accion" value="">
        <input type="Hidden" name="PCO_Valor" value="">
    </form>

	<!-- Zona de TextAreas ocultas segun los archivos abiertos -->
	<form id="form_textareas_archivos" name="form_textareas_archivos" method="POST" style="visibility: hidden; display:none; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">					
	</form>
	<!-- Marco para recepcion de eventos generados por el boton de guardar -->
	<iframe OnLoad="if (frame_almacenamiento.location.href != 'about:blank') QuitarAvisoAlmacenamiento();" height="0" width="0" name="frame_almacenamiento" id="frame_almacenamiento" src="about:blank" style="visibility:hidden; display:none"></iframe>

	<!-- Modal para mensajes de carga -->
	<div id="PCO_Modal_MensajeCargandoSimple" class="modal fade" tabindex="-1" role="dialog" data-backdrop="false"> <!--  data-backdrop="false" role="dialog" --> 
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-body" align="center">
					<div class="progress" id="PCO_Modal_MensajeCargandoBarra">
						<div id="PCO_Modal_MensajeCargandoPorcentaje" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
					</div>
					<i class="fa fa-circle-o-notch fa-fw fa-spin fa-1x"></i> <?php echo $MULTILANG_PCODER_Trabajando; ?>...
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- Modal para mensajes generales -->
	<div id="PCO_Modal_Mensaje" class="modal fade" data-backdrop="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $MULTILANG_PCODER_Cerrar; ?></span></button>
					<h4 id="PCO_Modal_MensajeTitulo" class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<p id="PCO_Modal_MensajeCuerpo"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline btn-info" data-dismiss="modal"><?php echo $MULTILANG_PCODER_Cerrar; ?></button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<?php include_once ("inc/marco_operarfs.php");	?>



<!-- INICIA MARCO DE CHAT -->
<!--<div id="main_container wrapper"  >  style="overflow: auto;"-->

	<!-- ################# INICIO DE LA MAQUETACION ################ -->
		<?php include_once ("inc/panel_superior.php"); 	?>
		<DIV class="row" id="MarcoContenedorCentral">
			<?php include_once ("inc/panel_izquierdo.php");	?>
			<div class="col-md-8" style="margin:0px;" id="panel_central">
				
				<?php include_once ("inc/panel_centralsuperior.php");	?>

				<div id="panel_central_medio">

					<div class="tab-content">
						<div id="pestana_superior_editores" class="tab-pane fade in active">
								<!-- ################## PESTANAS DE ARCHIVOS ################### -->
								<div class="row">
									<div id="contenedor_archivos" class="col-md-12" style="height:0px">
										<nav class="nav-xs">
											<ul id="lista_contenedor_archivos" name="lista_contenedor_archivos" class="nav nav-pills nav-xs">
											</ul>
										</nav>
									</div>
								</div>

								<!-- ############### MARCO MENSAJES SUPERIORES ################# -->
								<div class="row">
									<div id="contenedor_mensajes_superior" class="col-md-12">
									</div>
								</div>

								<!-- ############### MARCO BARRA DE EDICION ################# -->
								<div class="row">
									<div id="contenedor_barra_edicion" class="col-md-12">
									</div>
								</div>

								<!-- ############### EDITORES ################# -->
								<div class="row" style="margin:0px;">
									<div id="panel_editor_real" style="float:left">
										<div id="editor_codigo" style="display:block;  width:100%; height:100vh;" width="100%" height="100vh"></div>
									</div>
									<div id="panel_editor_clonado" style="float:right">
										<div id="editor_clonado" style="display:block;  width:100%; height:100vh; border-style: solid; border-width:1px; border-color:#373737;" width="100%" height="100vh"></div>
									</div>
								</div>
						</div>

						<div id="pestana_consola_comandos" class="tab-pane fade">
							<iframe name="frame_terminal" id="frame_terminal" src="mod/consola" style="border:0px;"></iframe>
						</div>

						<div id="pestana_explorador_web" class="tab-pane fade">
							<iframe name="frame_explorador" id="frame_explorador" src="mod/explorador" style="border:0px;"></iframe>
						</div>

						<div id="pestana_diferencias_archivos" class="tab-pane fade">
							<div class="row">
								<div class="col-md-12">
									<div id="panel_controles_diff" align="left" style="color:#FFFFFF; margin-top:7px; margin-bottom:5px;">
										&nbsp;&nbsp;&nbsp;&nbsp;
										<b><?php echo $MULTILANG_PCODER_Archivo; ?> #1: </b>
										<select style="margin-right:50px;" name="archivo_diff_1" id="archivo_diff_1" size="1" class="selectpicker" data-style="btn-success btn-xs" OnChange="PCODER_EjecutarDiff();">
										</select>
										<b><?php echo $MULTILANG_PCODER_Archivo; ?> #2: </b>
										<select                            name="archivo_diff_2" id="archivo_diff_2" size="1" class="selectpicker" data-style="btn-warning btn-xs" OnChange="PCODER_EjecutarDiff();">
										</select>
										<br>
										&nbsp;&nbsp;&nbsp;&nbsp;
										<?php echo $MULTILANG_PCODER_Formato; ?>: &nbsp;&nbsp;&nbsp;&nbsp;
										<select                            name="formato_diff" id="formato_diff" size="1" class="selectpicker" data-style="btn-default btn-xs" OnChange="PCODER_EjecutarDiff();">
											<option value="oscuro">Oscuro / Dark</option>
											<option value="claro">Claro / Light</option>
										</select>
										<?php echo $MULTILANG_PCODER_Tipo; ?>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<select                            name="modo_visual_diff" id="modo_visual_diff" size="1" class="selectpicker" data-style="btn-default btn-xs" OnChange="PCODER_EjecutarDiff();">
											<option value="ladoalado">Lado a Lado / Side by Side</option>
											<option value="enlinea">Entre lineas / In line</option>
											<option value="unificado">Unificado / Unified</option>
											<option value="encontexto">En contexto / By context</option>
										</select>
									</div>
								</div>	
							</div>
							<iframe name="frame_diferencias" id="frame_diferencias" src="mod/php-diff-1.0/generador" style="border:0px;"></iframe>
						</div>

						<div  id="pestana_chat_together" class="tab-pane fade" align=center>
							<button style="margin:10px;" class="btn btn-info" id="TableroCompartido" onclick="$('#frame_pboard').css('display', 'block'); $('#frame_pboard').css('visibility', 'visible');"><i class="fa fa-slideshare fa-fw"></i> Activar Pizarra</button>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<button style="margin:10px;" class="btn btn-success" id="EditorDiagramas" onclick="PCO_VentanaPopup('mod/mxgraph/javascript/scripts/grapheditor/www/');"><i class="fa fa-sitemap fa-fw"></i> Editor de diagramas</button>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<button style="margin:10px;" class="btn btn-default" id="ChatPCoderSimple" onclick="PCODER_CargarUsuariosChatEstandar();"><i class="fa fa-comments fa-fw"></i> Chat est&aacute;ndar</button>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<button style="margin:10px;" class="btn btn-primary" id="IniciarPMeetings" onclick="PCODER_PracticoMeetings();"><i class="fa fa-group fa-fw"></i> Activar/Desactivar Practico Meetings</button>

							<iframe name="frame_pboard" id="frame_pboard" src="mod/pboard" style="display:block; visibility:hidden; width:100%; height:100vh;" width="100%" height="100%"  scrolling="yes" style="border:0px;"></iframe>
						</div>

						<div  id="pestana_estado_general" class="tab-pane fade" align=center>
    						<div  id="MarcoEstadoYBloqueos" style="padding:30px; height:100vh;">
    						</div>
						</div>

					</div>
				</div>

				<?php include_once ("inc/panel_centralinferior.php");	?>

			</div>
			<?php include_once ("inc/panel_derecho.php"); ?>
		</DIV>
		<?php include_once ("inc/panel_inferior.php"); ?>
	<!-- ################## FIN DE LA MAQUETACION ################## -->

<!--</div>  FINALIZA MARCO DE CHAT -->

    <?php
    	if ($PCO_PCODER_StandAlone==0) //███▓▓▓▒▒▒ Si es MODULO DE PRACTICO FRAMEWORK ▒▒▒▓▓▓███
    		echo '<script type="text/javascript" src="../../inc/chat/js/chat.js"></script>';  // Agrega scripts de chat
    ?>

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="../../inc/bootstrap/js/bootstrap.min.js"></script>
    <!-- Plugins JQuery -->
    <script type="text/javascript" src="../../inc/bootstrap/js/plugins/select/bootstrap-select.min.js"></script>


    <!-- Carga editor ACE y sus extensiones -->
	<script src="../../inc/ace/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
	<script src="../../inc/ace/src-min-noconflict/ext-language_tools.js" type="text/javascript" charset="utf-8"></script>

	<!-- Funciones especificas de PCoder -->
	<script language="JavaScript">
	    var MensajeFuncionalidadNoDisponible="<center><b>OPCION INACTIVA!!! - FEATURE DISABLED!!!</b></center><HR>Su instalacion de {P}Coder no se encuentra integrada a <a href='https://www.practico.org'>Practico Framework</a><br>Muchas de las caracteristicas solo son habilitadas cuando PCoder se integra de manera nativa con Practico Framework<br><br>Your {P}Coder setup its not embeded into <a href='https://www.practico.org'>Practico Framework</a><br>Many features are available when your PCoder is embeded into a Practico Framework setup";
		//Convierte variables de idioma desde PHP a JS
		var MULTILANG_PCODER_Linea="<?php echo $MULTILANG_PCODER_Linea; ?>";
		var MULTILANG_PCODER_Columna="<?php echo $MULTILANG_PCODER_Columna; ?>";
		var MULTILANG_PCODER_Caracteres="<?php echo $MULTILANG_PCODER_Caracteres; ?>";
		var MULTILANG_PCODER_Tipo="<?php echo $MULTILANG_PCODER_Tipo; ?>";
		var MULTILANG_PCODER_Tamano="<?php echo $MULTILANG_PCODER_Tamano; ?>";
		var MULTILANG_PCODER_Modificado="<?php echo $MULTILANG_PCODER_Modificado; ?>";
		var MULTILANG_PCODER_ErrorRW="<?php echo $MULTILANG_PCODER_ErrorRW; ?>";
		var MULTILANG_PCODER_Estado="<?php echo $MULTILANG_PCODER_Estado; ?>";
		var MULTILANG_PCODER_ErrGuardarDefecto="<?php echo $MULTILANG_PCODER_ErrGuardarDefecto; ?>";
		var MULTILANG_PCODER_ErrGuardarNoPermiso="<?php echo $MULTILANG_PCODER_ErrGuardarNoPermiso; ?>";
		var MULTILANG_PCODER_Guardando="<?php echo $MULTILANG_PCODER_Guardando; ?>";
		var MULTILANG_PCODER_Error="<?php echo $MULTILANG_PCODER_Error; ?>";
		var MULTILANG_PCODER_Finalizado="<?php echo $MULTILANG_PCODER_Finalizado; ?>";
		var MULTILANG_PCODER_ElementoCreado="<?php echo $MULTILANG_PCODER_ElementoCreado; ?>";
		var MULTILANG_PCODER_ElementoExiste="<?php echo $MULTILANG_PCODER_ElementoExiste; ?>";
		var MULTILANG_PCODER_ElementoNoCreado="<?php echo $MULTILANG_PCODER_ElementoNoCreado; ?>";
		var MULTILANG_PCODER_Propietario="<?php echo $MULTILANG_PCODER_Propietario; ?>";
		var MULTILANG_PCODER_Permisos="<?php echo $MULTILANG_PCODER_Permisos; ?>";
		var MULTILANG_PCODER_Eliminado="<?php echo $MULTILANG_PCODER_Eliminado; ?>";
		var MULTILANG_PCODER_ExtensionNoSoportada="<?php echo $MULTILANG_PCODER_ExtensionNoSoportada; ?>";
		var MULTILANG_PCODER_HistorialVersiones="<?php echo $MULTILANG_PCODER_HistorialVersiones; ?>";
		var PCO_PCODER_StandAlone="<?php echo $PCO_PCODER_StandAlone; ?>";
		var PCOSESS_LoginUsuario="<?php echo $PCOSESS_LoginUsuario; ?>";
		var MULTILANG_PCODER_AdvertenciaCierre="<?php echo $MULTILANG_PCODER_AdvertenciaCierre; ?>";
	</script>
	<script type="text/javascript" src="js/pcoder.min.js?<?php echo filemtime('js/pcoder.min.js'); ?>"></script>

    <?php
        //Agrega snippets propios al editor en caso de existir
        if (file_exists('../../inc/ace_practico/snippets_practico.js')) {
            echo '<script type="text/javascript" src="../../inc/ace_practico/snippets_practico.js?'.filemtime('../../inc/ace_practico/snippets_practico.js').'"></script>';
        }
    ?>

	<script language="JavaScript">
		function RecargarToolTipsEnlaces()
			{
				//Carga los tooltips programados en la hoja.  Por defecto todos los elementos con data-toggle=tootip
				$(function () {
				  $('[data-toggle="tooltip"]').tooltip();
				})
			}
		RecargarToolTipsEnlaces();
	</script>

	<script language="JavaScript">
		//Carga los popovers programados en la hoja.  Por defecto todos los elementos con data-toggle=popover
		$(function () {
		  $('[data-toggle="popover"]').popover()
		});
	</script>
<script language="JavaScript">
    function activaTab(tab){
        $('.nav-tabs a[href="#' + tab + '"]').tab('show');
    };
function ActivarPestanaConsola(){
	//$('#pestana_consola_comandos').show();
//$('.nav-tabs a[href="#pestana_consola_comandos"]').tab('show');
//$('.nav-tabs a:last').tab('show') 
//activaTab('pestana_consola_comandos');
//$(thisss).tab('show');

//$('#pestana_consola_comandos').trigger('click');
//$("#item_pestana_consola").click();

/*
$('#pestana_consola_comandos').trigger('click');
    $("#pestana_consola_comandos a").click(function(e){
        e.preventDefault();
        alert();
        $(this).tab('show');
    });
*/
}
</script>

<?php
    //Incluye sistema de chat para desarrolladores
	if ($PCO_PCODER_StandAlone==0) //███▓▓▓▒▒▒ Si es MODULO DE PRACTICO FRAMEWORK ▒▒▒▓▓▓███
		{
		    if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
		        {
                ?>
                    <script>
                        // TogetherJS configuration would go here, but we'll talk about that
                        // later
                        TogetherJSConfig_siteName="PRACTICO FRAMEWORK";
                        TogetherJSConfig_toolName="Practico-Meetings";
                        //TogetherJSConfig_hubBase=""; //Servidor de conferencia
                        TogetherJSConfig_dontShowClicks = false; //Deshabilitar la vista de clics de participantes
                        //TogetherJSConfig_findRoom = "Cuarto_de_Desarrolladores";  //Crea un cuarto especifico y loguea en el a todos los participantes
                        //TogetherJSConfig_findRoom = {prefix: "Cuarto_de_Desarrolladores", max: 5} //Crea un cuarto y ademas asigna un maximo de participantes
                        TogetherJSConfig_autoStart = false; //Reinicia la sesion de un usuario
                        TogetherJSConfig_suppressJoinConfirmation=true; //Evita la confirmacion de ingreso a un cuarto para los invitados
                        TogetherJSConfig_suppressInvite=true;
                        TogetherJSConfig_inviteFromRoom=false;
                        TogetherJSConfig_includeHashInUrl=true; //Util en aplicaciones de una sola pagina para indicar que una misma URL no quiere decir que cada persona ve lo mismo
                        TogetherJSConfig_disableWebRTC=true; //Deshabilita boton de llamada de audio
                        TogetherJSConfig_ignoreForms=false; //Define si ignora los formularios
                        
                        TogetherJSConfig_getUserName = function () {return '<?php echo "$Nombre_usuario ($PCOSESS_LoginUsuario)"; ?>';};   //Funcion que establece el nombre de usuario, debe retornar null en caso que no lo pueda establecer
                        //TogetherJSConfig_getUserAvatar = function () {return avatarUrl;}; //Establece la URL utilizada para el avatar del usuario
                        //TogetherJSConfig_getUserColor = function () {return '#ff00ff';}; Retorna el color que diferencia al usuario
                    
                        //Retira opciones innecesarias de PMeetings y hace la traduccion forzada a espanol
                        function LimpiarInterfaz()
                            {
                                $("#togetherjs-menu-help").hide();
                                $("#togetherjs-menu-feedback").hide();
                                $("#togetherjs-share-button").hide();
                                $("#togetherjs-share-button").css("display", "none");
                                $("#togetherjs-share-button").css("visibility", "hidden");
                                //Traduce cadenas basicas
                                $("#togetherjs-menu-update-name").html('<img src="https://togetherjs.com/togetherjs/images/button-pencil.png" alt=""> Actualizar tu nombre');
                                $("#togetherjs-menu-update-avatar").html('<img src="https://togetherjs.com/togetherjs/images/btn-menu-change-avatar.png" alt=""> Cambiar avatar');
                                $("#togetherjs-menu-update-color").html('<span class="togetherjs-person-bgcolor-self" style="background-color: rgb(255, 0, 255);"></span> Actualizar tu color');
                                $("#togetherjs-menu-end").html('<img src="https://togetherjs.com/togetherjs/images/button-end-session.png" alt=""> Cerrar sesion');
                            }
                        TogetherJSConfig_on_ready = function () {
                            LimpiarInterfaz(); };
                    </script>
                    <script src="https://togetherjs.com/togetherjs-min.js"></script>
                <?php
		        }
		}
?>

</body>
</html>
<?php
	} // Fin $PCO_Accion=="PCOMOD_CargarPcoder"

} //Fin permisos modulo