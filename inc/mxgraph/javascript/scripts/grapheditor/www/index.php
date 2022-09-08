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


########################################################################
########################################################################
    //Variables basicas de operacion para el diagrama
    $PCO_PosXDiagrama="782";
    $PCO_PosYDiagrama="815";
    $PCO_AnchoPaginaDiagrama="827";
    $PCO_AltoPaginaDiagrama="1169";
    $PCO_HabilitarRejilla="1";
    $PCO_TamanoRejilla="10";
    $DiagramaBaseLimpio='<mxGraphModel dx="'.$PCO_PosXDiagrama.'" dy="'.$PCO_PosYDiagrama.'" grid="'.$PCO_HabilitarRejilla.'" gridSize="'.$PCO_TamanoRejilla.'" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="'.$PCO_AnchoPaginaDiagrama.'" pageHeight="'.$PCO_AltoPaginaDiagrama.'">  <root>    <mxCell id="0" />    <mxCell id="1" parent="0" />    </root></mxGraphModel>';

    if (@!defined($PCO_CampoOrigen)) $PCO_CampoOrigen="";
    if (@!defined($PCO_TablaOrigen)) $PCO_TablaOrigen="";
    if (@!defined($PCO_CampoLlave)) $PCO_CampoLlave="";
    if (@!defined($PCO_ValorLlave)) $PCO_ValorLlave="";

    //Si la operacion es cargar entonces toma la 
    //if (@$PCO_DiagramaOperacion=="PCO_CargarDiagrama")
        {
            //Valores de prueba (Anular en produccion)
            // $PCO_CampoOrigen="accion";
            // $PCO_TablaOrigen="core_auditoria";
            // $PCO_CampoLlave="id";
            // $PCO_ValorLlave="4";
            
            $DiagramaOK=0;
            if (@$PCO_CampoOrigen!="" && $PCO_TablaOrigen!="" && $PCO_CampoLlave!="" && $PCO_ValorLlave!="")
                {
                    $ConcenidoDiagrama=PCO_EjecutarSQL("SELECT {$PCO_CampoOrigen} as Diagrama FROM {$PCO_TablaOrigen} WHERE {$PCO_CampoLlave}='{$PCO_ValorLlave}' ")->fetchColumn();
                    //Valida que se tengan algunos contenidos minimos del diagrama para ser considerado valido
                    if (trim($ConcenidoDiagrama)!="")
                        if (stripos($ConcenidoDiagrama,"mxGraphModel")>0)
                            if (stripos($ConcenidoDiagrama,"<root")>0)
                                if (stripos($ConcenidoDiagrama,"mxCell")>0)
                                    {
                                        $DiagramaOK=1;
                                        //Sanitiza la cadena eliminando todos los saltos porque en la asignacion posterior de JS no los debe tener
                                        $DiagramaBase=str_replace(array("\r", "\n"), "", $ConcenidoDiagrama);
                                    }
                }
        }

    //SIEMPRE SE ASUME QUE SE LLEGA CON DATOS PARA CARGA DEL DIAGRAMA!!!
    //Si no encuentra datos validos para el diagrama entonces presenta uno por defecto con la advertencia
    if ($DiagramaOK==0)
        $DiagramaBase='<mxGraphModel dx="'.$PCO_PosXDiagrama.'" dy="'.$PCO_PosYDiagrama.'" grid="'.$PCO_HabilitarRejilla.'" gridSize="'.$PCO_TamanoRejilla.'" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="'.$PCO_AnchoPaginaDiagrama.'" pageHeight="'.$PCO_AltoPaginaDiagrama.'">  <root>    <mxCell id="0" />    <mxCell id="1" parent="0" />    <mxCell id="3" value="Framework" style="text;html=1;strokeColor=none;fillColor=none;align=center;verticalAlign=middle;whiteSpace=wrap;rounded=0;fontColor=#B3B3B3;fontSize=25;fontStyle=2" parent="1" vertex="1">      <mxGeometry x="332" y="240" width="40" height="20" as="geometry" />    </mxCell>    <mxCell id="7" value="" style="shape=hexagon;perimeter=hexagonPerimeter2;whiteSpace=wrap;html=1;fixedSize=1;fillColor=#FFC60A;gradientDirection=north;gradientColor=#DE1016;strokeColor=none;" parent="1" vertex="1">      <mxGeometry x="220" y="190" width="70" height="60" as="geometry" />    </mxCell>    <mxCell id="8" value="Pr" style="text;html=1;strokeColor=none;fillColor=none;align=center;verticalAlign=middle;whiteSpace=wrap;rounded=0;fontStyle=1;fontSize=45;fontColor=#FFFFFF;" parent="1" vertex="1">      <mxGeometry x="240" y="210" width="40" height="20" as="geometry" />    </mxCell>    <mxCell id="15" value="áctico" style="text;html=1;strokeColor=none;fillColor=none;align=center;verticalAlign=middle;whiteSpace=wrap;rounded=0;fontStyle=1;fontSize=45;" parent="1" vertex="1">      <mxGeometry x="332" y="210" width="40" height="20" as="geometry" />    </mxCell>    <mxCell id="17" value="Si usted visualiza este mensaje es porque los parámetros de carga de su diagrama en {P}Diagram no fueron correctos.&lt;br style=&quot;font-size: 10px;&quot;&gt;&lt;br style=&quot;font-size: 10px;&quot;&gt;Verifique el origen de los datos del diagrama e intente de nuevo" style="rounded=1;whiteSpace=wrap;html=1;fontSize=10;labelBackgroundColor=none;fillColor=#FFCCE6;" vertex="1" parent="1">      <mxGeometry x="170" y="280" width="310" height="60" as="geometry" />    </mxCell>    </root></mxGraphModel>';


########################################################################
########################################################################
/*
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

    - Para tomar un codigo en XML en formato PLANO y asignarlo/setearlo al editor
        
    ------------------------
    Algunos parametros que pueden ser parseados en la URL por la funcion urlParams = (function(url) SON:
		lang=xy: Especifica lenguaje en la interfaz de usuario
		touch=1: Habilita interfaz de usuario tipo Touch
		storage=local: Habilita almacenamiento local.  Valido HTML5
		chrome=0: Modo Chromeless
*/



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
	    //Genera variable global utilizada para los diferentes eventos sobre el diagrama
	    var PCO_EditorDiagramas;
	    
	    
        function sleep(ms)
            {
                return new Promise(resolve => setTimeout(resolve, ms));
            }

    	function PCO_GuardarDiagrama()
        	{
        	    //Obtiene el contenido actual del diagrama
        	    var DiagramaActual=PCO_EditorDiagramas.actions.editorUi.getEditBlankXml();
        	    
        	    //Agrega otras variables complementarias
        	    var DiagramaOK="<?php echo $DiagramaOK; ?>";
        	    var PCO_CampoOrigen="<?php echo $PCO_CampoOrigen; ?>";
        	    var PCO_TablaOrigen="<?php echo $PCO_TablaOrigen; ?>";
        	    var PCO_CampoLlave="<?php echo $PCO_CampoLlave; ?>";
        	    var PCO_ValorLlave="<?php echo $PCO_ValorLlave; ?>";

                //Determina si cuenta con todo lo necesario para ejecutar o no el almacenamiento
                if (DiagramaOK == "0")
                    {
                        alert("Usted no cuenta con un cargue valido de diagrama.  No se puede ejecutar una operacion de almacenamiento.  Puede usar la opcion Extras->Editar Diagrama si requiere guardar una copia de su trabajo actual.");
                    }
                else
                    {
                        
                        
                        
                        alert("Sobre registro: Guardando:"+DiagramaActual);
                    }
        	}

    	function PCO_CargarDiagramaInicial()
        	{
        		// Removes all illegal control characters before parsing
        		MisDaticos='<?php echo $DiagramaBase; ?>';
        		
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

        		//Habilita algunas opciones propias del editor
                PCO_EditorDiagramas.actions.editorUi.actions.actions.save.enabled=true;
        	}

		// Extends EditorUi to update I/O action states based on availability of backend
		(function()
    		{
    	        var editorUiInit = EditorUi.prototype.init;
    
    			EditorUi.prototype.init = function()
        			{
        				editorUiInit.apply(this, arguments);
        				this.actions.get('export').setEnabled(false);
        				// Actualiza las acciones que seran requeridas en el BackEnd
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
        				
        				// Define el objeto principal para manipular el diagrama
        				PCO_EditorDiagramas=new EditorUi(new Editor(urlParams['chrome'] == '0', themes));
        			}, function()
        			{
        				document.body.innerHTML = '<center style="margin-top:10%;">Error cargando archivos de recursos. Verifique consola de su navegador.</center>';
        			});
    		})();
		

        //Programa funcion inicial para el cargue de diagrama
        window.onload = function()
            {
                setTimeout(PCO_CargarDiagramaInicial, 1000);
            };
	</script>

</body>
</html>