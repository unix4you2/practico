<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=5,IE=9" ><![endif]-->
<!DOCTYPE html>
<html>
<head>
    <title>Grapheditor</title>
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
function sleep(ms) {
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
	var PCO_EditorDiagramas;
		// Extends EditorUi to update I/O action states based on availability of backend
        //var Pepon;
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