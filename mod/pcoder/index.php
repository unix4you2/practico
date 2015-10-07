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
	header('Content-type: text/html; charset=utf-8');

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

    //Incluye librerias basicas de trabajo
    @require('inc/variables.php');
    @require('inc/comunes.php');

    //Incluye idioma espanol, o sobreescribe vbles por configuracion de usuario
    include("idiomas/es.php");
    include("idiomas/".$IdiomaPredeterminado.".php");
    // FIN BLOQUE BASICO DE INCLUSION ##################################

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
        $PCODER_archivo = "demos/demo.php";
    PCODER_cargar_archivo($PCODER_archivo);

    $PCODER_Mensajes=0;
    // Verifica que el archivo exista
    $existencia_ok=1;
    if (!file_exists($PCODER_archivo)) { $existencia_ok=0; $PCODER_Mensajes=1; } 
    
    // Verifica permisos de escritura
    $permisos_ok=1;
    $permisos_encontrados=@substr(sprintf('%o', fileperms($PCODER_archivo)), -4);
    if (!is_writable($PCODER_archivo) && $existencia_ok) { $permisos_ok=0; $PCODER_Mensajes=1; } 
    
    // Verifica si existe el directorio para el editor ACE
    $editor_ok=1;
    if (@!file_exists("../../inc/ace")) { $editor_ok=0; $PCODER_Mensajes=1; } 

	// Clase para exploracion de archivos
	include_once("lib/phpFileTree/php_file_tree.php");

/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_GuardarArchivo
	Almacena un archivo previamente abierto con el PCODER

	Salida:
		Archivo para edicion en pantalla
*/
if ($PCO_Accion=="PCOMOD_GuardarArchivo") 
	{
        //Guarda el archivo
        $PCODER_Respuesta = file_put_contents($PCODER_archivo, $_POST["PCODER_AreaTexto"]) or die("can't open file");
        //Vuelve a cargar el archivo para continuar con su edicion
        auditar("Modifica archivo $PCODER_archivo");
        //Continua presentando todo el editor solo si se pide el echo
        if ($PCO_ECHO==1)
            echo '
                <body>
                <form name="continuar_edicion" action="index.php" method="POST">
                    <input type="Hidden" name="PCO_Accion" value="PCOMOD_CargarPcoder">
                    <input type="Hidden" name="PCODER_archivo" value="'.$PCODER_archivo.'">
                    <input type="Hidden" name="PCODER_TokenEdicion" value="'.$PCODER_TokenEdicion.'">
                    <input type="Hidden" name="Presentar_FullScreen" value="'.@$Presentar_FullScreen.'">
                    <input type="Hidden" name="Precarga_EstilosBS" value="'.@$Precarga_EstilosBS.'">
                <script type="" language="JavaScript"> document.continuar_edicion.submit();  </script>
                </body>';
	}


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

    <style type="text/css">
        html, body {
            background: #000000;  /* 002a36 | BFBFBF | 888888 */
            overflow-x: hidden;
            overflow-y: hidden;
        }
    </style>

    <!-- Agrega archivos necesarios para el Explorador en arbol de directorios -->
    <link href="lib/phpFileTree/styles/default/default.css" rel="stylesheet" type="text/css" media="screen" />
    <script src="lib/phpFileTree/php_file_tree.js" type="text/javascript"></script>
    
    <!-- jQuery -->
	<script type="text/javascript" src="../../inc/jquery/jquery-2.1.0.min.js"></script>
</head>
<body>

		<?php
			//Incluye algunos marcos del aplicativo
			include_once ("inc/barra_menu.php");
			include_once ("inc/mensajes_error.php");
			include_once ("inc/marco_explorador.php");
			include_once ("inc/marco_preferencias.php");
			include_once ("inc/marco_acerca.php");
			include_once ("inc/marco_guardar.php");
			include_once ("inc/marco_teclado.php");
		?>

		<form name="form_archivo_editado" action="index.php" method="POST" target="frame_almacenamiento" style="visibility: hidden; display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			<textarea id="PCODER_AreaTexto" name="PCODER_AreaTexto" style="visibility:hidden; display:none;"><?php echo $PCODERcontenido_archivo; ?></textarea>
			<input name="PCODER_TokenEdicion" type="hidden" value="<?php echo $PCODER_TokenEdicion; ?>">
			<input name="PCODER_archivo" type="hidden" value="<?php echo $PCODER_archivo; ?>">
			<input type="Hidden" name="Presentar_FullScreen" value="<?php echo $Presentar_FullScreen; ?>">
			<input type="Hidden" name="Precarga_EstilosBS" value="<?php echo $Precarga_EstilosBS; ?>">
			<input type="Hidden" name="PCO_ECHO" value="0"> <!-- Determina si la respuesta debe ser con o sin eco -->
			<input name="PCO_Accion" type="hidden" value="PCOMOD_GuardarArchivo">
		</form>

		<div class="row">
			<div class="col-lg-12">
				<div id="editor_codigo" style="display:block; width:100%; height:100vh;" width="100%" height="100vh"></div>
			</div>
		</div>

		<?php
			//Incluye algunos marcos del aplicativo
			include_once ("inc/barra_estado.php");
		?>


    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="../../inc/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- Carga editor ACE y sus extensiones -->
	<script src="../../inc/ace/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
	<script src="../../inc/ace/src-min-noconflict/ext-language_tools.js" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript">
        function CambiarFuenteEditor(tamano)
            {
                //Cambia la fuente del editor al tamano recibido
                editor.setFontSize(tamano);
            }
        function CambiarTemaEditor(tema)
            {
                //Cambia la apariencia grafica del editor
                editor.setTheme(tema);
            }
        function CambiarModoEditor(modo)
            {
                var ModoFiltrado = modo.replace(/_/g, " ");
                ModoFiltrado = ModoFiltrado.toLowerCase();
                //Cambia el modo de sintaxis y errores resaltado por el editor
                editor.getSession().setMode(ModoFiltrado);
            }
        function CaracteresInvisiblesEditor(estado)
            {
                //Cambia el modo del editor para mostrar (true) u ocultar (false) los caracteres invisibles
                if (estado==0)
                    editor.setShowInvisibles(false);
                else
                    editor.setShowInvisibles(true);
            }
        function IntercambiarEstadoCaracteresInvisibles()
            {
				//InterCambia el modo del editor para mostrar (true) u ocultar (false) los caracteres invisibles segun su estado actual
				if (editor.getShowInvisibles()==true)
					editor.setShowInvisibles(false);
				else
					editor.setShowInvisibles(true);
            }
        function ActualizarTituloEditor(titulo)
            {
                //Cambia el titulo presentado en la ventada del editor
                document.title = titulo;
                $(document).attr('title',titulo);
            }
        function SaltarALinea()
            {
				//Salta a una linea especifica del editor
                var linea = document.getElementById("linea_salto").value;
                //Valida que se tenga un valor de linea y que este en un rango valido
                if (linea!="" && linea>0)
					{
						editor.gotoLine(linea, 1, true);
						document.getElementById("linea_salto").value="";			
					}
            }
        function AvisoAlmacenamiento()
            {
                //$('#VentanaAlmacenamiento').modal('show');
                //Oculta mensaje de guardando y presenta el mensaje de guardar finalizado
				$('#progreso_marco_guardar').hide();
				$('#finalizado_marco_guardar').show();
				$('#boton_marco_guardar').show();
            }
        function Guardar()
            {
				//Oculta mensaje de guardar finalizado y presenta el de guardando
				$('#progreso_marco_guardar').show();
				$('#finalizado_marco_guardar').hide();
				$('#boton_marco_guardar').hide();
				//Presenta la ventana informativa sobre el proceso de almacenamiento
				$('#VentanaAlmacenamiento').modal('show');
                //Metodo estandar, envia todo sobre el iframe para evitar recargar la pagina
                document.form_archivo_editado.submit();
            }
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
 
        function PCODER_CargarArchivo(archivo)
            {
                //Oculta el modal de seleccion del archivo
                $('button#boton_navegador_archivos').click();
                //Carga la nueva ventana con el archivo, Reemplaza metodo anterior
                PCO_VentanaPopup('index.php?PCO_Accion=PCOMOD_CargarPcoder&Presentar_FullScreen=1&Precarga_EstilosBS=1&PCODER_archivo='+archivo,'{P} '+archivo,'toolbar=no, location=no, directories=0, directories=no, status=no, location=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, titlebar=no, width=800, height=600');
            }

        function RedimensionarEditor()
            {
				//Obtiene las dimensiones actuales de la ventana de edicion y algunos objetos
				var alto_ventana = $(window).height();
				var alto_documento = $(document).height();
				var alto_contenedor_editor = $("#editor_codigo").height();
				var alto_contenedor_menu = $("#contenedor_menu").height();
				var alto_contenedor_barra_estado = $("#contenedor_barra_estado").height();
				var alto_contenedor_mensajes_error = $("#contenedor_mensajes_error").height();
				var porcentaje_barrasmenuyestado=(alto_contenedor_menu+alto_contenedor_barra_estado+alto_contenedor_mensajes_error)*100/alto_ventana;
				var porcentaje_final=100-porcentaje_barrasmenuyestado;
				var alto_final=alto_ventana-alto_contenedor_menu-alto_contenedor_barra_estado-alto_contenedor_mensajes_error;
				//$('#editor_codigo').height( alto_final ).css({ });			//Asignacion en pixeles
				$('#editor_codigo').height( porcentaje_final+"vh" ).css({ });	//Asignacion en porcentaje
			}
			
		function ExplorarPath()
			{
				//Presenta la barra de carga que deberia ocultarse automaticamente en el OnLoad del Iframe
				$('#progreso_marco_explorador').show();
				
				//Se encarga de actualizar el path de navegacion de acuerdo al valor del combo o caja de texto
				/*
				if (path_exploracion_archivos_manual.value!="")
					$('#iframe_marco_explorador').attr('src', 'explorador.php?PCO_PCODER_Accion=PCOMOD_ExplorarPath&PathExploracion='+path_exploracion_archivos_manual.value);
				else
				*/
					$('#iframe_marco_explorador').attr('src', 'explorador.php?PCO_PCODER_Accion=PCOMOD_ExplorarPath&PathExploracion='+path_exploracion_archivos.value);
			}

		//Evento que quita la barra de progreso de carga para el explorador cada que finaliza el cargue de su IFrame
				$('#iframe_marco_explorador').load(function(){
				$('#progreso_marco_explorador').hide();
			});

        function ActualizarBarraEstado()
            {
				//Actualiza la barra de estado del editor
				var NroLineasDocumento=editor.session.getLength();
				var NroCaracteresDocumento=editor.session.getValue().length;
				//Actualiza los contenedores con la informacion de estado
				$("#NroLineasDocumento").html("<?php echo $MULTILANG_PCODER_Lineas; ?>: "+NroLineasDocumento);
				$("#NroCaracteresDocumento").html("<?php echo $MULTILANG_PCODER_Caracteres; ?>: "+NroCaracteresDocumento);
				$("#TipoDocumento").html("<?php echo $MULTILANG_PCODER_Tipo; ?>: <?php echo $PCODER_TipoElemento; ?>");
				$("#TamanoDocumento").html("<?php echo $MULTILANG_PCODER_Tamano; ?>: <b><?php echo $PCODER_TamanoElemento; ?> Kb</b>");
				$("#FechaModificadoDocumento").html("<?php echo $MULTILANG_PCODER_Modificado; ?>: <b><?php echo $PCODER_FechaElemento; ?></b>");
				$("#RutaDocumento").html("<i class='fa fa-hdd-o text-info'> <?php echo $PCODER_NombreArchivo; ?></i>");

				//Llama periodicamente la rutina de actualizacion de la barra
				window.setTimeout(ActualizarBarraEstado, 1500);
			}
		window.setTimeout(ActualizarBarraEstado, 2000);


		//Incluye extension de lenguaje para ACE
		ace.require("ace/ext/language_tools");
        // Crea el editor
        editor = ace.edit("editor_codigo");
        //editor.getSession().setUseWorker(false); //Evita el error 404 para "worker-php.js Failed to load resource: the server responded with a status of 404 (Not Found)"
        editor.getSession().setUseWorker(true); //Evita el error 404 para "worker-php.js Failed to load resource: the server responded with a status of 404 (Not Found)"
        
        //Actualiza el editor con el valor cargado inicialmente en el textarea
        editor.setValue(document.getElementById("PCODER_AreaTexto").value);

        // Inicia el editor de codigo con las opciones predeterminadas
        ActualizarTituloEditor("<?php echo '{P} '.$PCODER_NombreArchivo; ?>");
        CambiarFuenteEditor("14px");
        CambiarTemaEditor("ace/theme/ambiance");  //tomorrow_night|twilight|eclipse|ambiance|ETC
        CambiarModoEditor("ace/mode/<?php echo $PCODER_ModoEditor; ?>");
        
        
        
        //Activa la autocompletacion de codigo y los snippets
		editor.setOptions({
			enableBasicAutocompletion: true,
			enableSnippets: true,
			enableLiveAutocompletion: true
		});
        
        //Elimina la visualizacion de margen de impresion
        editor.setShowPrintMargin(0);
        CaracteresInvisiblesEditor(0);
        editor.clearSelection();
        
        
        //En cada evento de cambio actualiza el textarea
        editor.getSession().on('change', function(){
          document.getElementById("PCODER_AreaTexto").value=editor.getSession().getValue();
        });

        //Ajusta tamano del editor en cada cambio de tamano de la ventana
        $( window ).resize(function() {
			RedimensionarEditor();
        });
        RedimensionarEditor();

        //Captura el evento de Ctrl+S para guardar el archivo
        $(window).bind('keydown', function(event) {
            if (event.ctrlKey || event.metaKey) {
                switch (String.fromCharCode(event.which).toLowerCase()) {
                case 's':  //<-- Cambiar para otras letras ;)
                    event.preventDefault();
                    Guardar();
                    break;
                }
            }
        });
                
    </script>

	<script language="JavaScript">
		//Carga los tooltips programados en la hoja.  Por defecto todos los elementos con data-toggle=tootip
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip();
		})
	</script>

	<script language="JavaScript">
		//Carga los popovers programados en la hoja.  Por defecto todos los elementos con data-toggle=popover
		$(function () {
		  $('[data-toggle="popover"]').popover()
		})
	</script>

    <?php
        // Estadisticas de uso anonimo con GABeacon
        $PrefijoGA='<img src="https://ga-beacon.appspot.com/';
        $PosfijoGA='/Practico/'.$PCO_Accion.'?pixel" border=0 ALT=""/>';
        // Este valor indica un ID generico de GA UA-847800-9 No edite esta linea sobre el codigo
        // Para validar que su ID es diferente al generico de seguimiento.  En lugar de esto cambie
        // su valor a traves del panel de configuracion de Practico con el entregado como ID de GoogleAnalytics
        $Infijo=base64_decode("VUEtODQ3ODAwLTk=");
        echo $PrefijoGA.$Infijo.$PosfijoGA;
        if(@$CodigoGoogleAnalytics!="")
            echo $PrefijoGA.$CodigoGoogleAnalytics.$PosfijoGA;	
    ?>

<!-- Marco para recepcion de eventos generados por el boton de guardar -->
<iframe OnLoad="if (frame_almacenamiento.location.href != 'about:blank') AvisoAlmacenamiento();" height="0" width="0" name="frame_almacenamiento" id="frame_almacenamiento" src="about:blank" style="visibility:hidden; display:none"></iframe>

</body>
</html>
<?php
	} // Fin $PCO_Accion=="PCOMOD_CargarPcoder"

} //Fin permisos modulo

