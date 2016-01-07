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
    date_default_timezone_set("America/Bogota");

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
        $PCODER_Respuesta = file_put_contents($PCODER_archivo, $_POST["PCODER_AreaTexto"]) or die("No se puede abrir el archivo para escritura");
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
	Function: PCOMOD_ObtenerPermisosArchivo
	Determina cuales son los permisos de un archivo
*/
if ($PCO_Accion=="PCOMOD_ObtenerPermisosArchivo") 
	{
		$permisos_encontrados=@substr(sprintf('%o', fileperms($PCODER_archivo)), -4);
        echo $permisos_encontrados;
	}
	

/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_VerificarPermisosRW
	Verifica si el archivo cuenta o no con permisos de escritura por parte del usuario que corre el proceso web (generalmente Apache)
*/
if ($PCO_Accion=="PCOMOD_VerificarPermisosRW") 
	{
		$permisos_ok=1;
		$permisos_encontrados=@substr(sprintf('%o', fileperms($PCODER_archivo)), -4);
		if (!is_writable($PCODER_archivo)) { $permisos_ok=0; }
        echo $permisos_ok;
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_ObtenerTipoElemento
	Obtiene el tipo de elemento o archivo indicado
*/
if ($PCO_Accion=="PCOMOD_ObtenerTipoElemento") 
	{
		$PCODER_TipoElemento=@filetype($PCODER_archivo);
		@ob_clean();
        echo $PCODER_TipoElemento;
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_ObtenerTamanoDocumento
	Obtiene el tamano de elemento o archivo indicado
*/
if ($PCO_Accion=="PCOMOD_ObtenerTamanoDocumento") 
	{
        $PCODER_TamanoElemento=@round(filesize($PCODER_archivo)/1024);
		@ob_clean();
        echo $PCODER_TamanoElemento;
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_ObtenerFechaElemento
	Obtiene  la fecha de modificacion de elemento o archivo indicado
*/
if ($PCO_Accion=="PCOMOD_ObtenerFechaElemento") 
	{
        $PCODER_FechaElemento=@date("d F Y H:i:s", @filemtime($PCODER_archivo));
		@ob_clean();
        echo $PCODER_FechaElemento;
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_ObtenerTokenEdicion
	Obtiene el token de edicion de elemento o archivo indicado
*/
if ($PCO_Accion=="PCOMOD_ObtenerTokenEdicion") 
	{
		//Obtiene algunos valores del archivo necesarios para el token
		$PCODER_FechaElemento=@date("d F Y H:i:s", @filemtime($PCODER_archivo));
		$PCODER_TamanoElemento=@round(filesize($PCODER_archivo)/1024);
        $PCODERcontenido_original_archivo=@file_get_contents($PCODER_archivo);
        
        //Define un Token con el antes y despues
        $PCODER_TokenEdicion=md5($PCODER_archivo.$PCODER_TamanoElemento.$PCODER_FechaElemento.$PCODERcontenido_original_archivo);
   		@ob_clean();
        echo $PCODER_TokenEdicion;
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_ObtenerModoEditor
	Detecta el tipo de archivo y especifica el modo que se debe utilizar en el editor
*/
if ($PCO_Accion=="PCOMOD_ObtenerModoEditor") 
	{
        global $PCODER_Modos;
        
        //Obtiene la extension del archivo
        $PCODER_partes_extension = explode(".",$PCODER_archivo);
        $PCODER_extension = $PCODER_partes_extension[count($PCODER_partes_extension)-1];

        //Identifica el tipo de documento a ser aplicado segun la extension del archivo
        $PCODER_ModoEditor='';
        for ($i=0;$i<count($PCODER_Modos) && $PCODER_ModoEditor=='';$i++)
            {
               if(strpos($PCODER_Modos[$i]["Extensiones"], $PCODER_extension) !== false)
                    $PCODER_ModoEditor=$PCODER_Modos[$i]["Nombre"];
            }

   		@ob_clean();
        echo $PCODER_ModoEditor;
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_ObtenerNombreArchivo
	Establece el nombre del archivo abierto (sin su ruta, solo nombre.extension)
*/
if ($PCO_Accion=="PCOMOD_ObtenerNombreArchivo") 
	{
        //Obtiene el nombre del archivo para el titulo de ventana
        $PCODER_PartesNombreArchivo=explode(DIRECTORY_SEPARATOR,$PCODER_archivo);
        $PCODER_NombreArchivo = $PCODER_PartesNombreArchivo[count($PCODER_PartesNombreArchivo)-1];

   		@ob_clean();
        echo $PCODER_NombreArchivo;
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_ObtenerContenidoArchivo
	Obtiene el contenido del archivo indicado
*/
if ($PCO_Accion=="PCOMOD_ObtenerContenidoArchivo") 
	{
        //Carga y Escapa el contenido del archivo
        $PCODER_Contenido_original_archivo=@file_get_contents($PCODER_archivo, FILE_BINARY);   // FILE_TEXT | FILE_BINARY | FILE_USE_INCLUDE_PATH
        //$PCODER_ContenidoArchivo=@htmlspecialchars($PCODER_Contenido_original_archivo); //Para cargue como estaba en forma original (Sin Ajax)
        $PCODER_ContenidoArchivo= $PCODER_Contenido_original_archivo;

        //DOCS: http://stackoverflow.com/questions/15186558/loading-a-html-file-into-ace-editor-pre-tag
        //DOCS: <pre id="editor"><INTE ? php echo htmlentities(file_get_contents($input_dir."abc.html")); ? ></pre>
        //$PCODER_ContenidoArchivo=@htmlspecialchars(addslashes($PCODER_ContenidoArchivo));
   		@ob_clean();
        echo $PCODER_ContenidoArchivo;
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
            background: #272727;  /* 002a36 | BFBFBF | 888888 | 272727 | 000000 */
            overflow-x: hidden;
            overflow-y: hidden;
        }

		/* Personalizacion del estilo bootstrap para el alto del menu */
			.navbar-nav > li > a, .navbar-brand {
				padding-top:0px !important; padding-bottom:0 !important;
				height: 30px;
			}
		.navbar {min-height:30px !important;}
		
		/*Adicion de clase para el alto de menu*/
			.navbar-xs { min-height:30px; height: 30px; }
			.navbar-xs .navbar-brand{ padding: 0px 12px;font-size: 16px;line-height: 30px; }
			.navbar-xs .navbar-nav > li > a {  padding-top: 0px; padding-bottom: 0px; line-height: 30px; }
			
		/*Clase para las pestanas de archivos*/
			.nav-xs>li>a, .nav-xs {
				padding: 2px;
				font-size: 11px;
				margin-bottom: 1px;

			}

        .tooltip-inner {
            max-width: none;
            white-space: nowrap;
            font-size: 10px;
        }

		/*Clase para el explorador de archivos*/
			.explorador_archivos {
				margin: 0px;
				width: 100%;
				height: 50vh;	/* vh o px */
				overflow: auto;
				padding: 0px;
			}
    </style>
    
    <!-- jQuery -->
	<script type="text/javascript" src="../../inc/jquery/jquery-2.1.0.min.js"></script>
	<!-- Plugins adicionales JQuery -->
	<script type="text/javascript" src="../../inc/jquery/plugins/jquery.fileTree-1.01/jquery.easing.js"></script>
	<script type="text/javascript" src="../../inc/jquery/plugins/jquery.fileTree-1.01/jqueryFileTree.js"></script>
    <link href="../../inc/jquery/plugins/jquery.fileTree-1.01/jqueryFileTree.css" rel="stylesheet" media="screen" type="text/css">

</head>
<body>

		<?php
			//Incluye algunos marcos del aplicativo
			include_once ("inc/barra_menu.php");
			include_once ("inc/marco_preferencias.php");
			include_once ("inc/marco_acerca.php");
			include_once ("inc/marco_guardar.php");
			include_once ("inc/marco_teclado.php");
		?>



		<div class="row">
			<div class="col-md-2" style="margin:0px; padding:0px;" id="panel_izquierdo">
				<div algin="center">
				<?php
					include_once ("inc/panel_izquierdo.php");
				?>
				</div>
			</div>
			<div class="col-md-8" style="margin:0px;" id="panel_editor_codigo">


				<!-- INICIO MARCO PESTANAS DE ARCHIVOS -->
					<div id="contenedor_archivos" >
						<nav class="nav-xs">
							<ul id="lista_contenedor_archivos" name="lista_contenedor_archivos" class="nav nav-pills nav-xs">
							</ul>
						</nav>
					</div>
				<!-- FIN MARCO PESTANAS DE ARCHIVOS -->


				<!-- INICIO MARCO MENSAJES SUPERIORES -->
					<div class="row">
						<div id="contenedor_mensajes_superior" class="col-lg-12">
						</div>
					</div>
				<!-- FIN MARCO MENSAJES SUPERIORES -->


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

				<div class="tab-content">
				  <div id="archivo1" class="tab-pane fade in active">
					<div id="editor_codigo" style="display:block; width:100%; height:100vh;" width="100%" height="100vh"></div>
				  </div>
				</div>

			</div>
			<div class="col-md-2" style="margin:0px; padding:0px;" id="panel_derecho">
				<?php
					include_once ("inc/panel_derecho.php");
				?>
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
	<!--<script src="../../inc/ace/src-min-noconflict/ext-split.js" type="text/javascript" charset="utf-8"></script>-->

	<script language="JavaScript">
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
        function VerificarSintaxisEditor(estado)
            {
                //Cambia el la verificacion de sintaxis del editor
                if (estado==0)
                    editor.session.setOption("useWorker", false);
                else
                    editor.session.setOption("useWorker", true);
            }
        function VerificarAutocompletadoEditor(estado)
            {
                //Cambia el la verificacion de sintaxis del editor
                if (estado==0)
					{
						 editor.session.setOption("enableBasicAutocompletion", false);
						 editor.session.setOption("enableSnippets", false);
						 editor.session.setOption("enableLiveAutocompletion", false);
					}
                else
					{
						editor.session.setOption("enableBasicAutocompletion", true);
						editor.session.setOption("enableSnippets", true);
						editor.session.setOption("enableLiveAutocompletion", true);
					}
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
						editor.gotoLine(linea, 0, true);
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
				//Solamente guarda si no se trata del archivo demo
				if (document.form_archivo_editado.PCODER_archivo.value != "demos/demo.txt")
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
		function PCODER_ObtenerContenidoAjax(PCO_ASINCRONICO,PCO_URL,PCO_PARAMETROS)
			{
				var xmlhttp;
				if (window.XMLHttpRequest)
					{   // codigo for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}
				else
					{   // codigo for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}

				//funcion que se llama cada vez que cambia la propiedad readyState
				xmlhttp.onreadystatechange=function()
					{
						//readyState 4: peticion finalizada y respuesta lista
						//status 200: OK
						if (xmlhttp.readyState===4 && xmlhttp.status===200)
							{
								contenido_recibido=xmlhttp.responseText;
								contenido_recibido = contenido_recibido.trim();
								//Cuando es asincronico devuelve la respuesta cuando este lista
								if(PCO_ASINCRONICO==1)
									return contenido_recibido;
							}
					};

				/* open(metodo, url, asincronico)
				* metodo: post o get
				* url: localizacion del archivo en el servidor
				* asincronico: comunicacion asincronica true o false.*/
				if(PCO_ASINCRONICO==1)
					xmlhttp.open("POST",PCO_URL,true);
				else
					xmlhttp.open("POST",PCO_URL,false);

				//establece el header para la respuesta
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

				//enviamos las variables al archivo get_combo2.php
				//xmlhttp.send();
				xmlhttp.send(PCO_PARAMETROS);
				
				//Cuando la solicitud es asincronica devuelve el resultado al momento de llamado
				if(PCO_ASINCRONICO==0)
					return contenido_recibido;
			}

        function AjustarPanelesLaterales()
            {
				//Redimensiona, ajusta y aplica clases al editor segun el estado de visualizacion las barras laterales
				ancho_panel_editor=12-panel_izquierdo-panel_derecho; //Actualiza segun los anchos de cada panel

				//Remueve las clases tipicas de los paneles y aplica las nuevas
				$("#panel_izquierdo").removeClass("col-md-2");
				$("#panel_derecho").removeClass("col-md-2");
				//Si el valor es cero entonces se ocultan sino agrega la clase
				if(panel_izquierdo==0)
					$("#panel_izquierdo").hide();
				else
					$("#panel_izquierdo").addClass("col-md-"+panel_izquierdo);
				if(panel_derecho==0)
					$("#panel_derecho").hide();
				else
					$("#panel_derecho").addClass("col-md-"+panel_derecho);

				//Remueve las clases tipicas del editor de codigo y aplica la nueva
				$("#panel_editor_codigo").removeClass("col-md-8"); //Cuando estan los dos paneles activos
				$("#panel_editor_codigo").removeClass("col-md-10"); //Cuando esta un solo panel activo
				$("#panel_editor_codigo").addClass("col-md-"+ancho_panel_editor);
			}
		function ActivarPanelIzquierdo()
			{
				panel_izquierdo=2;
				$("#panel_izquierdo").show();
				$("#panel_izquierdo").removeClass("col-md-0");
				$("#panel_izquierdo").addClass("col-md-"+panel_izquierdo);
				AjustarPanelesLaterales();
			}
		function ActivarPanelDerecho()
			{
				panel_derecho=2;
				$("#panel_derecho").show();
				$("#panel_derecho").removeClass("col-md-0");
				$("#panel_derecho").addClass("col-md-"+panel_derecho);
				AjustarPanelesLaterales();
			}
		function DesactivarPanelIzquierdo()
			{
				panel_izquierdo=0;
				$("#panel_izquierdo").removeClass("col-md-2");
				$("#panel_izquierdo").hide();
				AjustarPanelesLaterales();
			}
		function DesactivarPanelDerecho()
			{
				panel_derecho=0;
				$("#panel_derecho").removeClass("col-md-2");
				$("#panel_derecho").hide();
				AjustarPanelesLaterales();
			}
        function RedimensionarEditor()
            {
				//Obtiene las dimensiones actuales de la ventana de edicion y algunos objetos
				var alto_ventana = $(window).height();
				var alto_documento = $(document).height();
				var alto_contenedor_editor = $("#editor_codigo").height();
				var alto_contenedor_archivos = $("#contenedor_archivos").height();
				var alto_contenedor_menu = $("#contenedor_menu").height();
				var alto_contenedor_barra_estado = $("#contenedor_barra_estado").height();
				var alto_contenedor_mensajes_superior = $("#contenedor_mensajes_superior").height();
				var alto_barra_lateral_izquierda = $("#barra_lateral_izquierda").height();	
				
				//Modifica el ALTO DEL EDITOR
				var porcentaje_barrasmenuyestado=(alto_contenedor_menu+alto_contenedor_barra_estado+alto_contenedor_mensajes_superior+alto_contenedor_archivos)*100/alto_ventana;
				var porcentaje_final=100-porcentaje_barrasmenuyestado;
				var alto_final=alto_ventana-alto_contenedor_menu-alto_contenedor_mensajes_superior-alto_contenedor_barra_estado-alto_contenedor_archivos;
				//$('#editor_codigo').height( alto_final ).css({ });			//Asignacion en pixeles
				$('#editor_codigo').height( porcentaje_final+"vh" ).css({ });	//Asignacion en porcentaje
				
				//Llama al metodo que actualiza el tamano del editor ACE segun las nuevas dimensiones
				editor.resize();
				
				AjustarPanelesLaterales();
			}

		function IntercambiarPantallaCompleta()
			{
				if (!document.fullscreenElement &&    // alternative standard method
				  !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current working methods
					if (document.documentElement.requestFullscreen) {
					  document.documentElement.requestFullscreen();
					} else if (document.documentElement.msRequestFullscreen) {
					  document.documentElement.msRequestFullscreen();
					} else if (document.documentElement.mozRequestFullScreen) {
					  document.documentElement.mozRequestFullScreen();
					} else if (document.documentElement.webkitRequestFullscreen) {
					  document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
					}
				} else {
					if (document.exitFullscreen) {
					  document.exitFullscreen();
					} else if (document.msExitFullscreen) {
					  document.msExitFullscreen();
					} else if (document.mozCancelFullScreen) {
					  document.mozCancelFullScreen();
					} else if (document.webkitExitFullscreen) {
					  document.webkitExitFullscreen();
					}
				}
			}
		function AumentarTamanoFuente()
			{
				tamano=editor.getFontSize();
				tamano = tamano.substring(0, tamano.length-2); //Elimina las letras de px al final
				tamano=parseInt(tamano)+2;
				CambiarFuenteEditor(tamano+"px");
			}
		function DisminuirTamanoFuente()
			{
				tamano=editor.getFontSize();
				tamano = tamano.substring(0, tamano.length-2); //Elimina las letras de px al final
				tamano=parseInt(tamano)-2;
				CambiarFuenteEditor(tamano+"px");
			}
		function ExplorarPath()
			{
				//Inicializa el explorador de archivos
				$(document).ready( function() {
					$('#marco_explorador').fileTree({ root: path_exploracion_archivos.value, script: '../../inc/jquery/plugins/jquery.fileTree-1.01/connectors/jqueryFileTree.php' }, function(archivo_seleccionado) {
						//alert(file);
						//PCODER_CargarArchivo('[link]');
						PCODER_CargarArchivo(archivo_seleccionado);
					});

				});
			}


        function ActualizarBarraEstado()
            {
				//Actualiza ademas las posiciones del cursor sobre el arreglo de archivos abiertos
				posicion_cursor=editor.getCursorPosition();
				ListaArchivos[IndiceArchivoActual].LineaActual=posicion_cursor.row;
				ListaArchivos[IndiceArchivoActual].ColumnaActual=posicion_cursor.column;

				//Actualiza la barra de estado del editor
				var NroLineasDocumento=editor.session.getLength();
				var NroCaracteresDocumento=editor.session.getValue().length;
				//Actualiza los contenedores con la informacion de estado
				$("#NroLineasDocumento").html("<?php echo $MULTILANG_PCODER_Linea; ?>: "+ (ListaArchivos[IndiceArchivoActual].LineaActual+1) +" / "+NroLineasDocumento);
				$("#NroColumnaDocumento").html("<?php echo $MULTILANG_PCODER_Columna; ?>: "+ (ListaArchivos[IndiceArchivoActual].ColumnaActual+1));
				$("#NroCaracteresDocumento").html("<?php echo $MULTILANG_PCODER_Caracteres; ?>: "+NroCaracteresDocumento);
				$("#TipoDocumento").html("<?php echo $MULTILANG_PCODER_Tipo; ?>: "+ListaArchivos[IndiceArchivoActual].TipoDocumento);
				$("#TamanoDocumento").html("<?php echo $MULTILANG_PCODER_Tamano; ?>: <b>"+ListaArchivos[IndiceArchivoActual].TamanoDocumento+" Kb</b>");
				$("#FechaModificadoDocumento").html("<?php echo $MULTILANG_PCODER_Modificado; ?>: <b>"+ListaArchivos[IndiceArchivoActual].FechaModificadoDocumento+"</b>");
				$("#RutaDocumento").html("<i class='fa fa-hdd-o text-info'> "+ListaArchivos[IndiceArchivoActual].RutaDocumento+"</i>");
				
				//Llama periodicamente la rutina de actualizacion de la barra
				window.setTimeout(ActualizarBarraEstado, 1000);
			}

		
		function AgregarNuevoTextarea(nombre_formulario,nombre_textarea,valor_predeterminado)
			{
				//contenedor.innerHTML = '<textarea name="pepe" rows="5" cols="30"></textarea>';
				elemento_textarea = document.createElement('textarea');
				elemento_textarea.cols = 1;
				elemento_textarea.rows = 1;
				elemento_textarea.name = nombre_textarea;
				elemento_textarea.id = nombre_textarea;	
				elemento_textarea.value = valor_predeterminado;
				nombre_formulario.appendChild(elemento_textarea);
			} 

		var ListaArchivos = new Array();								//Contiene la lista de los archivos cargados
		var IndiceAperturaArchivo=0;									//Posicion del arreglo sobre la que se desea guardar datos al abrir un archivo
		var IndiceUltimoArchivoAbierto=IndiceAperturaArchivo;			//Posicion del arreglo que contiene el ultimo archivo abierto
		var IndiceArchivoActual=IndiceAperturaArchivo;					//Posicion del arreglo con los datos del archivo actual
		var ValorModoEditor;

		function PCODER_CambiarArchivoActual(IndiceRecibido,VieneDesdeApertura)
			{
				//Si viene en valor 1 se trata de una apertura de archivo, por lo que no se requiere guardar valores previos.  Si viene en 0 se trata de un cambio de archivo desde la barra y guarda valores previos.
				if(VieneDesdeApertura==0)
					document.getElementById("PCODER_AreaTexto"+IndiceArchivoActual).value=editor.getSession().getValue();
				
				//Actualiza el Textarea y formulario base del editor
				document.form_archivo_editado.PCODER_archivo.value=ListaArchivos[IndiceRecibido].RutaDocumento;
				document.form_archivo_editado.PCODER_TokenEdicion.value=ListaArchivos[IndiceRecibido].TokenEdicion;
				document.form_archivo_editado.PCODER_AreaTexto.value=document.getElementById("PCODER_AreaTexto"+IndiceRecibido).value;
				//Actualiza el editor ACE y sus propiedades
				editor.setValue(document.getElementById("PCODER_AreaTexto"+IndiceRecibido).value);
				editor.focus();											//Establece el foco al editor
				editor.gotoLine(ListaArchivos[IndiceRecibido].LineaActual+1, ListaArchivos[IndiceRecibido].ColumnaActual, false);							//Ubica cursor en la linea,columna,sin animacion
				editor.scrollToLine(ListaArchivos[IndiceRecibido].LineaActual+1, true, false, function () {});	//Desplaza archivo hasta la linea, sin centrarla en pantalla, sin animacion
				editor.clearSelection();
				ActualizarTituloEditor("{P} "+ListaArchivos[IndiceRecibido].NombreArchivo);
				//Actualiza el modo de editor solamente si ha cambiado desde el archivo anterior
				if (ListaArchivos[IndiceArchivoActual].ModoEditor!=ListaArchivos[IndiceRecibido].ModoEditor)
					CambiarModoEditor("ace/mode/"+ListaArchivos[IndiceRecibido].ModoEditor);
				
				//Actualiza el indice del archivo de trabajo actual
				IndiceArchivoActual=IndiceRecibido;
				
				//Verifica permisos de escritura en cada cargue de archivo para saber si presenta o no mensaje de advertencia
				ValorPermisosRW=PCODER_ObtenerContenidoAjax(0,"index.php","PCO_Accion=PCOMOD_VerificarPermisosRW&PCODER_archivo="+ListaArchivos[IndiceRecibido].RutaDocumento);
				if(ValorPermisosRW==0 && ListaArchivos[IndiceRecibido].RutaDocumento!='demos/demo.txt')
					contenedor_mensajes_superior.innerHTML = '<div class="alert alert-warning btn-xs" role="alert" style="margin: 0px; padding: 5px;" ><i class="fa fa-warning"></i> '+'<b><?php echo $MULTILANG_PCODER_ErrorRW.'</b>. '.$MULTILANG_PCODER_Estado.'=' ?>'+ListaArchivos[IndiceRecibido].PermisosArchivo+'</div>';
				else
					contenedor_mensajes_superior.innerHTML = '';

				//Despues de haber agregado el archivo al arreglo procede a presentarlo en las pestanas
				ActualizarPestanasArchivos();
			}

		function PCODER_CerrarArchivo(IndiceRecibido)
			{
				//Limpia todos los campos del vector
				ListaArchivos[IndiceRecibido].TipoDocumento="";
				ListaArchivos[IndiceRecibido].TamanoDocumento="";
				ListaArchivos[IndiceRecibido].FechaModificadoDocumento="";
				ListaArchivos[IndiceRecibido].RutaDocumento="";
				ListaArchivos[IndiceRecibido].TokenEdicion="";
				ListaArchivos[IndiceRecibido].ModoEditor="";
				ListaArchivos[IndiceRecibido].NombreArchivo="";
				ListaArchivos[IndiceRecibido].LineaActual="";
				ListaArchivos[IndiceRecibido].PermisosRW="";
				ListaArchivos[IndiceRecibido].PermisosArchivo="";

				//Verifica si se trata del archivo actual, si es asi entonces se mueve al primero.Si es el primero entonces se mueve al demo
				if(IndiceRecibido==1)
					IndiceArchivoActual=0;
				else
					{
						if(IndiceRecibido==IndiceArchivoActual)
							IndiceArchivoActual=1;
					}

				ActualizarPestanasArchivos();
				//Se asegura de corregir tamano del editor cuando se actualizan las pestanas

				PCODER_CambiarArchivoActual(IndiceArchivoActual,1);
			}

		function PCODER_CerrarArchivoActual()
			{
				PCODER_CerrarArchivo(IndiceArchivoActual);
			}

		function PCODER_BuscarArchivoAbierto(path_archivo)
			{
				Encontrado=-1;
				//Determina si el archivo ya esta abierto o no (dentro del arreglo)
				//Retorna -1 si no es encontrado o el indice en caso de existir
				for (i=0;i<IndiceAperturaArchivo;i++)
					{
						if(ListaArchivos[i].RutaDocumento==path_archivo)
							Encontrado=i;
					}
				//Retorna el estado de variable si fue o no encontrado el archivo
				return Encontrado;
			}

		function ActualizarPestanasArchivos()
			{
				//Limpia el marco de pestanas
				lista_contenedor_archivos.innerHTML = "";

				//Recorre arreglo de archivos y regenera las pestanas
				for (i=1;i<IndiceAperturaArchivo;i++)
					{
						//Si se trata del primer archivo lo pone como activo en la barra
						ComplementoClase='';
						if (IndiceArchivoActual==i)
							ComplementoClase='class="active"';
						//Agrega el elemento simepre y cuando no sea vacio
						if (ListaArchivos[i].NombreArchivo!="")
							{
								//Construye datos para el ToolTip
								ComplementoTooltip='<i class=\'fa fa-hdd-o\'></i> '+ListaArchivos[i].RutaDocumento+'<br>';
								ComplementoTooltip+='<i class=\'fa fa-key\'></i> '+'Permisos (CHMOD): '+ListaArchivos[i].PermisosArchivo+'<br>';
								//Pestana con nombre de archivo
								lista_contenedor_archivos.innerHTML = lista_contenedor_archivos.innerHTML + '<li '+ComplementoClase+' ><a href="#" data-toggle="tooltip" data-html="true" data-placement="bottom" title="'+ComplementoTooltip+'" style="cursor:pointer;" OnClick="PCODER_CambiarArchivoActual('+i+',0);"><i class="fa fa-file-text-o fa-inactive"></i> '+ListaArchivos[i].NombreArchivo+'</a></li>';
								//Boton para cerrar el archivo
								lista_contenedor_archivos.innerHTML = lista_contenedor_archivos.innerHTML + '<li ><a data-toggle="tab" style="cursor:pointer; margin-right: 10px;" OnClick="PCODER_CerrarArchivo('+i+');"><i class="fa fa-times"></i></a></li>';								
							}

						//Actualiza el Tooltip asociado a la pestana agregada
						RecargarToolTipsEnlaces();
					}

				//Se asegura de corregir tamano del editor cuando se carga un archivo
				RedimensionarEditor();
			}

		function PCODER_CargarArchivo(path_archivo)
			{
				if (typeof path_archivo == 'undefined') path_archivo="demos/demo.txt";
				
				//Determina si el archivo ya ha sido abierto o no
				BusquedaArchivoAbierto=-1;
				if(IndiceAperturaArchivo>0)
					BusquedaArchivoAbierto=PCODER_BuscarArchivoAbierto(path_archivo);

				//Graba el estado del editor cuando se abre un nuevo archivo y no se trata del demo
				if(IndiceAperturaArchivo!=0)
					document.getElementById("PCODER_AreaTexto"+IndiceArchivoActual).value=editor.getSession().getValue();

				if (BusquedaArchivoAbierto==-1)
					{
						//Busca algunos datos del archivo
						ValorTipoElemento=PCODER_ObtenerContenidoAjax(0,"index.php","PCO_Accion=PCOMOD_ObtenerTipoElemento&PCODER_archivo="+path_archivo);
						ValorTamanoDocumento=PCODER_ObtenerContenidoAjax(0,"index.php","PCO_Accion=PCOMOD_ObtenerTamanoDocumento&PCODER_archivo="+path_archivo);
						ValorFechaModificadoDocumento=PCODER_ObtenerContenidoAjax(0,"index.php","PCO_Accion=PCOMOD_ObtenerFechaElemento&PCODER_archivo="+path_archivo);
						ValorTokenEdicion=PCODER_ObtenerContenidoAjax(0,"index.php","PCO_Accion=PCOMOD_ObtenerTokenEdicion&PCODER_archivo="+path_archivo);
						ValorModoEditor=PCODER_ObtenerContenidoAjax(0,"index.php","PCO_Accion=PCOMOD_ObtenerModoEditor&PCODER_archivo="+path_archivo);
						ValorNombreArchivo=PCODER_ObtenerContenidoAjax(0,"index.php","PCO_Accion=PCOMOD_ObtenerNombreArchivo&PCODER_archivo="+path_archivo);
						ValorContenidoArchivo=PCODER_ObtenerContenidoAjax(0,"index.php","PCO_Accion=PCOMOD_ObtenerContenidoArchivo&PCODER_archivo="+path_archivo);
						ValorPermisosRW=PCODER_ObtenerContenidoAjax(0,"index.php","PCO_Accion=PCOMOD_VerificarPermisosRW&PCODER_archivo="+path_archivo);
						ValorPermisosArchivo=PCODER_ObtenerContenidoAjax(0,"index.php","PCO_Accion=PCOMOD_ObtenerPermisosArchivo&PCODER_archivo="+path_archivo);

						//Agrega nuevo elemento al arreglo
						ListaArchivos[IndiceAperturaArchivo] = { TipoDocumento: ValorTipoElemento, TamanoDocumento: ValorTamanoDocumento, FechaModificadoDocumento: ValorFechaModificadoDocumento, RutaDocumento: path_archivo, TokenEdicion: ValorTokenEdicion, ModoEditor: ValorModoEditor, NombreArchivo: ValorNombreArchivo, LineaActual: 1, ColumnaActual: 0 , PermisosRW: ValorPermisosRW, PermisosArchivo: ValorPermisosArchivo};
						
						//Crea dinamicamente el textarea con el numero de indice y con su valor predeterminado
						AgregarNuevoTextarea(document.form_textareas_archivos,"PCODER_AreaTexto"+IndiceAperturaArchivo,ValorContenidoArchivo);
						
						//Actualiza los indices de posiciones en el vector
						IndiceUltimoArchivoAbierto=IndiceAperturaArchivo;
						IndiceArchivoActual=IndiceAperturaArchivo;
						IndiceAperturaArchivo++;

						//Actualiza todo el editor con el archivo recier cargado
						PCODER_CambiarArchivoActual(IndiceArchivoActual,1);
						CambiarModoEditor("ace/mode/"+ListaArchivos[IndiceArchivoActual].ModoEditor); //Hace cambio forzado de tipo de editor cuando se abre un nuevo archivo
					}
				else
					{
						PCODER_CambiarArchivoActual(BusquedaArchivoAbierto,0);
					}
			}


		//##############################################################
		//###              INICIALIZACION DE VARIABLES               ###
		//##############################################################
		panel_izquierdo=0;
        panel_derecho=0;

		//Evento que quita la barra de progreso de carga para el explorador cada que finaliza el cargue de su IFrame
		$('#iframe_marco_explorador').load(function(){
			$('#progreso_marco_explorador').hide();
		});

		//Incluye extension de lenguaje para ACE
		ace.require("ace/ext/language_tools");
        // Crea el editor
        editor = ace.edit("editor_codigo");
        editor.getSession().setUseWorker(true); //Llevar a false para evitar el error 404 para "worker-php.js Failed to load resource: the server responded with a status of 404 (Not Found)"
        editor.resize(true);
        

		//Inicia el primer archivo del arreglo (como demo.txt)
		PCODER_CargarArchivo();


        // Inicia el editor de codigo con las opciones predeterminadas
        CambiarFuenteEditor("14px");
        CambiarTemaEditor("ace/theme/ambiance");  //tomorrow_night|twilight|eclipse|ambiance|ETC

        
        //Activa la autocompletacion de codigo y los snippets
		editor.setOptions({
			enableBasicAutocompletion: true,
			enableSnippets: true,
			enableLiveAutocompletion: true
		});
		editor.setAnimatedScroll(true);
        
        //Elimina la visualizacion de margen de impresion
        editor.setShowPrintMargin(0);
        CaracteresInvisiblesEditor(0);
        
        
        //En cada evento de cambio actualiza el textarea
        editor.getSession().on('change', function(){
          document.getElementById("PCODER_AreaTexto").value=editor.getSession().getValue();
        });

        //Ajusta tamano del editor en cada cambio de tamano de la ventana
        $( window ).resize(function() {
			RedimensionarEditor();
        });
        

		// CAPTURA DE EVENTOS DE TECLADO #############################################################
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

		// FUNCIONES DE INICIALIZACION ###############################################################
			ExplorarPath();
			RedimensionarEditor();
			window.setTimeout(ActualizarBarraEstado, 1000);

	</script>

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
		})
	</script>

    <?php
        // Estadisticas de uso anonimo con GABeacon
        $PrefijoGA='<img src="https://ga-beacon.appspot.com/';
        $PosfijoGA='/PCoder/'.$PCO_Accion.'?pixel" border=0 ALT=""/>';
        // Este valor indica un ID generico de GA UA-847800-9 No edite esta linea sobre el codigo
        // Para validar que su ID es diferente al generico de seguimiento.  En lugar de esto cambie
        // su valor a traves del panel de configuracion con el entregado como ID de GoogleAnalytics
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

