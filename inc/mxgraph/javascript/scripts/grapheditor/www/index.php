<?php
	/*
	PDiagram (Editor de Diagramas en la Nube)
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

    // BLOQUE BASICO DE INCLUSION ######################################
    // Inicio de la sesion
    @session_start();

	// Agrega las variables de sesion
	if (!empty($_SESSION)) extract($_SESSION);

    // Incluye archivo de configuracion de base
    include_once '../../../../../../core/configuracion.php';
    // Inicia las conexiones con la BD y las deja listas para las operaciones
    include_once '../../../../../../core/conexiones.php';
    // Incluye definiciones comunes de la base de datos
    include_once '../../../../../../inc/practico/def_basedatos.php';
    // Incluye archivo con algunas funciones comunes usadas por la herramienta
    include_once '../../../../../../core/comunes.php';
    //Agrega idiomas de Practico Framework
    include_once("../../../../../../inc/practico/idiomas/es.php");
    include_once("../../../../../../inc/practico/idiomas/".$IdiomaPredeterminado.".php");

    // Establece la zona horaria por defecto para la aplicacion
    date_default_timezone_set($ZonaHoraria);

	// Valida sesion activa de Practico
	if (!isset($PCOSESS_SesionAbierta)) 
		{
			echo '<head><title>Error</title><style type="text/css"> body { background-color: #000000; color: #7f7f7f; font-family: sans-serif,helvetica; } </style></head><body><table width="100%" height="100%" border=0><tr><td align=center>&#9827; Acceso no autorizado !</td></tr></table></body>';
			die();
		}

    // Determina si es un usuario administrador para poder abrir el editor
    if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
        {
			echo '<head><title>Error</title><style type="text/css"> body { background-color: #000000; color: #7f7f7f; font-family: sans-serif,helvetica; } </style></head><body><table width="100%" height="100%" border=0><tr><td align=center>&#9827; Acceso no autorizado !</td></tr></table></body>';
			die();
        }
    else
        $PCO_EsUnAdmin=1;
?>


<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=5,IE=9" ><![endif]-->
<!DOCTYPE html>
<html>
<head>
    <title>{P}Diagram</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="styles/grapheditor.css">
	<script type="text/javascript">
		// Parses URL parameters. Supported parameters are:
		// - lang=xy: Specifies the language of the user interface.
		// - touch=1: Enables a touch-style user interface.
		// - storage=local: Enables HTML5 local storage.
		// - chrome=0: Chromeless mode.
		var urlParams = (function(url)
		{
			var result = new Object();
			var idx = url.lastIndexOf('?');
	
			if (idx > 0)
			{
				var params = url.substring(idx + 1).split('&');
				
				for (var i = 0; i < params.length; i++)
				{
					idx = params[i].indexOf('=');
					
					if (idx > 0)
					{
						result[params[i].substring(0, idx)] = params[i].substring(idx + 1);
					}
				}
			}
			
			return result;
		})(window.location.href);
	
		// Default resources are included in grapheditor resources
		mxLoadResources = false;
	</script>
	<script type="text/javascript" src="js/Init.js"></script>
	<script type="text/javascript" src="deflate/pako.min.js"></script>
	<script type="text/javascript" src="deflate/base64.js"></script>
	<script type="text/javascript" src="jscolor/jscolor.js"></script>
	<script type="text/javascript" src="sanitizer/sanitizer.min.js"></script>
	<script type="text/javascript" src="../../../src/js/mxClient.js"></script>
	<script type="text/javascript" src="js/EditorUi.js"></script>
	<script type="text/javascript" src="js/Editor.js"></script>
	<script type="text/javascript" src="js/Sidebar.js"></script>
	<script type="text/javascript" src="js/Graph.js"></script>
	<script type="text/javascript" src="js/Format.js"></script>
	<script type="text/javascript" src="js/Shapes.js"></script>
	<script type="text/javascript" src="js/Actions.js"></script>
	<script type="text/javascript" src="js/Menus.js"></script>
	<script type="text/javascript" src="js/Toolbar.js"></script>
	<script type="text/javascript" src="js/Dialogs.js"></script>
</head>
<body class="geEditor">


	<script type="text/javascript">
        function sleep(ms)
            {
                return new Promise(resolve => setTimeout(resolve, ms));
            }

    	function MiCreacion()
        	{
        		// Removes all illegal control characters before parsing
        		MisDaticos='<mxGraphModel dx="782" dy="815" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="827" pageHeight="1169">  <root>    <mxCell id="0" />    <mxCell id="1" parent="0" />    <mxCell id="2" value="" style="ellipse;shape=cloud;whiteSpace=wrap;html=1;" vertex="1" parent="1">      <mxGeometry x="340" y="380" width="120" height="80" as="geometry" />    </mxCell>    <mxCell id="3" value="" style="shape=document;whiteSpace=wrap;html=1;boundedLbl=1;" vertex="1" parent="1">      <mxGeometry x="250" y="250" width="120" height="80" as="geometry" />    </mxCell>  </root></mxGraphModel>';
        		
        		//var data = Graph.zapGremlins(mxUtils.trim(textarea.value));
        		var data = Graph.zapGremlins(mxUtils.trim(MisDaticos));
        		
        		var error = null;
        
        			PCO_EditorDiagramas.actions.editorUi.editor.graph.model.beginUpdate();
        			try
        			{
        				PCO_EditorDiagramas.actions.editorUi.editor.setGraphXml(mxUtils.parseXml(data).documentElement);
        			}
        			catch (e)
        			{
        				error = e;
        			}
        			finally
        			{
        				PCO_EditorDiagramas.actions.editorUi.editor.graph.model.endUpdate();				
        			}
        	}
	</script>

    
    
	<script type="text/javascript">
	    //Genera variable global utilizada para los diferentes eventos sobre el diagrama
	    var PCO_EditorDiagramas;
	    
		// Extends EditorUi to update I/O action states based on availability of backend
		(function()
    		{
    			
    	    var editorUiInit = EditorUi.prototype.init;
    
    			EditorUi.prototype.init = function()
    			{
    				editorUiInit.apply(this, arguments);
    				this.actions.get('export').setEnabled(false);
    
    				// Updates action states which require a backend
    				if (!Editor.useLocalStorage)
    				{
    					mxUtils.post(OPEN_URL, '', mxUtils.bind(this, function(req)
    					{
    						var enabled = req.getStatus() != 404;
    						this.actions.get('open').setEnabled(enabled || Graph.fileSupport);
    						this.actions.get('import').setEnabled(enabled || Graph.fileSupport);
    						this.actions.get('save').setEnabled(enabled);
    						this.actions.get('saveAs').setEnabled(enabled);
    						this.actions.get('export').setEnabled(enabled);
    					}));
    				}
    			};
    			
    			// Adds required resources (disables loading of fallback properties, this can only
    			// be used if we know that all keys are defined in the language specific file)
    			mxResources.loadDefaultBundle = false;
    			var bundle = mxResources.getDefaultBundle(RESOURCE_BASE, mxLanguage) ||
    				mxResources.getSpecialBundle(RESOURCE_BASE, mxLanguage);
    
    			// Fixes possible asynchronous requests
    			mxUtils.getAll([bundle, STYLE_PATH + '/default.xml'], function(xhr)
    			{
    				// Adds bundle text to resources
    				mxResources.parse(xhr[0].getText());
    				
    				// Configures the default graph theme
    				var themes = new Object();
    				themes[Graph.prototype.defaultThemeName] = xhr[1].getDocumentElement(); 
    				
    				// Main
    				PCO_EditorDiagramas=new EditorUi(new Editor(urlParams['chrome'] == '0', themes));
    			}, function()
    			{
    				document.body.innerHTML = '<center style="margin-top:10%;">Error loading resource files. Please check browser console.</center>';
    				
    
    			});
    		
    		    
    		})();
		


window.onload = function() {
    setTimeout(MiCreacion, 1000);

};
	</script>

    Creates a container for the graph with a grid wallpaper 
   <div id="graphContainer"
      style="overflow:hidden;width:321px;height:241px;background:url('editors/images/grid.gif')">
   </div>


<textarea id="Pepe" name="Pepe">
    <mxGraphModel dx="782" dy="815" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="827" pageHeight="1169">
  <root>
    <mxCell id="0" />
    <mxCell id="1" parent="0" />
    <mxCell id="2" value="" style="ellipse;whiteSpace=wrap;html=1;" vertex="1" parent="1">
      <mxGeometry x="100" y="140" width="120" height="80" as="geometry" />
    </mxCell>
  </root>
</mxGraphModel>
</textarea>

<!--
ANOTACIONES JOHN:

    
Para tomar un XML plano y setearlo en el diagrama


MX-GRAPH de Supervivencia:
==========================
- Adición de idiomas:
    En caliente por URL: enviar el parametro lang=xx   (es,en,...)
    Se deben agregar los archivos correspondientes sobre /resources antes de usarlo
    Se debe agregar el idioma sobre js/Init.js  Linea 13 y al arreglo mxLanguages Linea  29

-  Agregar opciones:
    1) Sobre js/Menu.js  L33:  Se agrega el elemento al arreglo defaultMenuItems
    2) En el archivo de idioma se debe agregar la cadena equivalente.  Con el nombre de menu creado y el texto visual.  Ej Uno=MiLabel
    3) En js/Menus.js Apro. L500 tomar uno de los elementos y duplicarlo para agregar el nuevo, usando el elemento creado, ej Uno.
            El orden en que se agregue depende del arreglo defaultMenuItems
            Puede que requiera eliminar la cache para ver los cambios
    4) Para las opciones que son comandos cree la accion correspondiente Sobre js/Actions.js en L65 se toma un addAction y se agrega lo deseado cambiando el nombre. ej 'MiComando'
    5) Para las acciones tipo comando debe tener tambien su equivalente sobre el archivo de idiomas
    
- Eliminar opciones:
    1) Sobre js/Menu.js  buscar la opcion deseada y retirar su codigo en defaultMenuItems  o los items hijos.

- Cambio de accion en un elemento determinado:  Se resume a editar js/Actions.js  para el menu correspondiente

- Ocultar, habilitar o deshabilitar opciones de menu (siguen activos sus key bindings):
    HABILITAR: PCO_EditorDiagramas.actions.editorUi.actions.actions.saveAs.enabled=true;
    DESHABILITAR:  PCO_EditorDiagramas.actions.editorUi.actions.actions.save.enabled=false;
    OCULTAR/MOSTRAR: PCO_EditorDiagramas.actions.editorUi.actions.actions.save.visible=false;

- Para obtener el codigo en XML en formato PLANO y guardarlo en BD
    PCO_EditorDiagramas.actions.editorUi.getEditBlankXml()



-->



</body>
</html>