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

    //Incluye archivo inicial de configuracion
	include_once("inc/configuracion.php");

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

	//Crea variable se sesion usada por la consola de comandos
	$_SESSION['PCONSOLE_KEY']="23456789abcdefghijkmnpqrstuvwxyz";
	$_SESSION['PEXPLORER_KEY']="23456789abcdefghijkmnpqrstuvwxyz";

    //Incluye librerias basicas de trabajo
    @require('inc/variables.php');
    @require('inc/comunes.php');
    @require('inc/comunes_bd.php');
    @require('inc/conexiones.php');


    //Incluye idioma espanol, o sobreescribe vbles por configuracion de usuario
    include("idiomas/es.php");
    include("idiomas/".$IdiomaPredeterminado.".php");
    // FIN BLOQUE BASICO DE INCLUSION ##################################

	//Genera la conexion inicial del sistema para preferencias en standalone
	if ($PCO_PCODER_StandAlone==1)
		{
			$ConexionPDO=PCO_NuevaConexionBD($MotorBD,$PuertoBD,$BaseDatos,$ServidorBD,$UsuarioBD,$PasswordBD);
			include("inc/instalacion.php");
		}

    // Establece la zona horaria por defecto para la aplicacion
    date_default_timezone_set($ZonaHoraria);

    // Datos de fecha, hora y direccion IP para algunas operaciones
    $PCO_PCODER_FechaOperacion=date("Ymd");
    $PCO_PCODER_FechaOperacionGuiones=date("Y-m-d");
    $PCO_PCODER_HoraOperacion=date("His");
    $PCO_PCODER_HoraOperacionPuntos=date("H:i");
    $PCO_PCODER_DireccionAuditoria=$_SERVER ['REMOTE_ADDR'];

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
                $$PCO_PBROWSER_NombresParametros[$i]=$PCO_PBROWSER_ValoresParametros[$i];
            }
        // Agrega ademas las variables de sesion
        if (!empty($_SESSION)) extract($_SESSION);
    }


if (@$PCOSESS_LoginUsuario=="admin" || $PCO_PCODER_StandAlone==1)
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
    <link href="../../inc/bootstrap/css/bootstrap.min.css" rel="stylesheet"  media="screen">
    <link href="../../inc/bootstrap/css/bootstrap-theme.css" rel="stylesheet"  media="screen">

    <!-- Custom Fonts -->
    <link href="../../inc/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- Estilos especificos PCoder -->
    <link href="css/pcoder.min.css" rel="stylesheet" type="text/css">
    
    <!-- Estilos selector de color -->
    <link rel="stylesheet" href="../../inc/jquery/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">

    <!-- jQuery -->
	<script type="text/javascript" src="../../inc/jquery/jquery-2.1.0.min.js"></script>
	<!-- Plugins adicionales JQuery -->
	<script type="text/javascript" src="../../inc/jquery/plugins/jquery.fileTree-1.01/jquery.easing.js"></script>
	<script type="text/javascript" src="../../inc/jquery/plugins/jquery.fileTree-1.01/jqueryFileTree.js"></script>
    <link  type="text/css" href="../../inc/jquery/plugins/jquery.fileTree-1.01/jqueryFileTree.css" rel="stylesheet" media="screen">
    
    <!-- Selector de colores -->
	<script type="text/javascript" src="../../inc/jquery/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
</head>
<body onbeforeunload="return '<?php echo $MULTILANG_PCODER_AdvertenciaCierre; ?>';">

	<!-- ######### FORMULARIOS Y MARCOS DE TRABAJO OCULTOS ######### -->
	<form name="form_archivo_editado" action="index.php" method="POST" target="frame_almacenamiento" style="visibility: hidden; display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
		<textarea id="PCODER_AreaTexto" name="PCODER_AreaTexto" style="visibility:hidden; display:none;"></textarea>
		<input name="PCODER_TokenEdicion" type="Hidden" value="">
		<input name="PCODER_archivo" type="Hidden" value="">
		<input type="Hidden" name="PCO_ECHO" value="0"> <!-- Determina si la respuesta debe ser con o sin eco -->
		<input name="PCO_Accion" type="hidden" value="PCOMOD_GuardarArchivo">
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

	<!-- ################# INICIO DE LA MAQUETACION ################ -->
		<?php include_once ("inc/panel_superior.php"); 	?>
		<DIV class="row">
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
					</div>

				</div>

				<?php include_once ("inc/panel_centralinferior.php");	?>

			</div>
			<?php include_once ("inc/panel_derecho.php"); ?>
		</DIV>
		<?php include_once ("inc/panel_inferior.php"); ?>
	<!-- ################## FIN DE LA MAQUETACION ################## -->


    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="../../inc/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- Carga editor ACE y sus extensiones -->
	<script src="../../inc/ace/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
	<script src="../../inc/ace/src-min-noconflict/ext-language_tools.js" type="text/javascript" charset="utf-8"></script>

	<!-- Funciones especificas de PCoder -->
	<script language="JavaScript">
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
	</script>
	<script type="text/javascript" src="js/pcoder.min.js"></script>

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
</body>
</html>
<?php
	} // Fin $PCO_Accion=="PCOMOD_CargarPcoder"

} //Fin permisos modulo

