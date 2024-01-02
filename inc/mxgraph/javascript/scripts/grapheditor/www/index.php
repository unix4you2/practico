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

    // Recupera variables recibidas para su uso como globales (equivale a register_globals=on en php.ini)
    if (!ini_get('register_globals'))
        {
            $PCO_NumeroParametros = count($_REQUEST);
            $PCO_NombresParametros = array_keys($_REQUEST);// obtiene los nombres de las varibles
            $PCO_ValoresParametros = array_values($_REQUEST);// obtiene los valores de las varibles
            // crea las variables y les asigna el valor
            for($i=0;$i<$PCO_NumeroParametros;$i++)
                {
                    ${$PCO_NombresParametros[$i]}=$PCO_ValoresParametros[$i];
                    //Si alguna de las variables proviene de un combo multiple la transforma a su variable original
					if (strstr($PCO_NombresParametros[$i],"PCO_ComboMultiple_")!=FALSE)
					    ${substr($PCO_NombresParametros[$i], strlen("PCO_ComboMultiple_"))}=$PCO_ValoresParametros[$i];
                }
            // Agrega ademas las variables de sesion
            if (!empty($_SESSION)) extract($_SESSION);
        }

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

    //Busca si el usuario tiene acceso a la edición de esta tarea o es administrador del tablero
    $UsuarioHabilitado_EdicionKanban=0;
    if (@$PCO_TablaOrigen=="core_kanban" && @$PCO_CampoOrigen=="diagrama_elicitacion")
        {
            $UsuariosEditoresTarea=PCO_EjecutarSQL("SELECT login_admintablero,usuarios_edicion FROM core_kanban WHERE id='{$PCO_ValorLlave}' ")->fetch();
            $UsuariosRecuperados=",".$UsuariosEditoresTarea["usuarios_edicion"].",";
            if (strpos($UsuariosRecuperados,$PCOSESS_LoginUsuario)!=false || $UsuariosEditoresTarea["login_admintablero"]==$PCOSESS_LoginUsuario)
                $UsuarioHabilitado_EdicionKanban=1;
        }

    // Determina si es un usuario administrador para poder abrir el editor
    if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && $UsuarioHabilitado_EdicionKanban==0)
        {
			echo '<head><title>Error</title><style type="text/css"> body { background-color: #000000; color: #7f7f7f; font-family: sans-serif,helvetica; } </style></head><body><table width="100%" height="100%" border=0><tr><td align=center>&#9827; Acceso no autorizado !</td></tr></table></body>';
			die();
        }
    else
        $PCO_EsUnAdmin=1;




########################################################################
########################################################################
/*
	Section: Acciones a ser ejecutadas (si aplica) en cada cargue de la herramienta
*/

########################################################################
########################################################################
/*
	Function: PCO_GuardarDiagrama
	Almacena el codigo XML asociado a un diagrama

	Variables de entrada:

		Varias - Identificadoras del origen de datos del diagrama

	Salida:

		Valor actualizado en BD y mensaje de retorno de operacion
*/
if (@$PCO_Accion=="PCO_GuardarDiagrama")
	{
        $MensajeRetorno="";
        if (@$PCO_CampoOrigen=="" || $PCO_TablaOrigen=="" || $PCO_CampoLlave=="" || $PCO_ValorLlave=="" || $PCO_ContenidoDiagrama=="")
            $MensajeRetorno="[ERROR]: Parametros insuficientes para almacenar diagrama";
		if ($MensajeRetorno=="")
			{
                //Se agrega al menos un separador de campos en los parametros para que se sanitize la consulta
                $cadena_nuevos_valores="{$PCO_ContenidoDiagrama}".$_SeparadorCampos_;
				PCO_EjecutarSQLUnaria("UPDATE $PCO_TablaOrigen SET $PCO_CampoOrigen=? WHERE {$PCO_CampoLlave}=? ",$cadena_nuevos_valores.$PCO_ValorLlave);
		        PCO_Auditar("Guarda diagrama sobre {$PCO_TablaOrigen}[{$PCO_CampoLlave}={$PCO_ValorLlave}].{$PCO_CampoOrigen}");
			}
		echo $MensajeRetorno;
		//Evita ejecucion del resto del script y recarga de todo el diagrama.
		die();
	}
	


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
    // IMPORTANTE - IMPORTANTE: 
    // IMPORTANTE - IMPORTANTE: 
    // IMPORTANTE - IMPORTANTE: 
    // Longitud actual de esta cadena DiagramaBaseLimpio en BD es 241: <mxGraphModel dx="782" dy="815" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="827" pageHeight="1169"><root><mxCell id="0" /><mxCell id="1" parent="0" /></root></mxGraphModel>
    // Esa longitud es usada en informes para saber si hay un cambio en el diagrama.  Longitudes SUPERIORES a 250

    // $PCO_CampoOrigen=@$_POST["PCO_CampoOrigen"];
    // $PCO_TablaOrigen=@$_POST["PCO_TablaOrigen"];
    // $PCO_CampoLlave=@$_POST["PCO_CampoLlave"];
    // $PCO_ValorLlave=@$_POST["PCO_ValorLlave"];
    // if (@!defined($PCO_CampoOrigen)) $PCO_CampoOrigen="";
    // if (@!defined($PCO_TablaOrigen)) $PCO_TablaOrigen="";
    // if (@!defined($PCO_CampoLlave)) $PCO_CampoLlave="";
    // if (@!defined($PCO_ValorLlave)) $PCO_ValorLlave="";

    //BANCO DE PRUEBAS (Anular en produccion)
//     $PCO_CampoOrigen="accion";
//     $PCO_TablaOrigen="core_auditoria";
//     $PCO_CampoLlave="id";
//     $PCO_ValorLlave="4";


    $DiagramaOK=0;
    echo @"<b><font color=green>[ESPERE...]:</font></b> Iniciando cargue de diagrama en la ruta: <b>{$PCO_TablaOrigen}[{$PCO_CampoLlave}={$PCO_ValorLlave}].{$PCO_CampoOrigen}</b><br><font size=1 color=gray><i>(Si no visualiza una ruta ser&aacute; causa de error de cargue o p&aacute;gina en blanco)</i></font>";
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
                                //Sanitiza posibles comillas simples recuperadas dentro del diagrama. Son escapadas porque posteeriormente la comilla simple se usa en la asignacion de JS al diagrama
                                $DiagramaBase=str_replace("'", "\'", $DiagramaBase);
                            }
        }

    //SIEMPRE SE ASUME QUE SE LLEGA CON DATOS PARA CARGA DEL DIAGRAMA!!!
    //Si no encuentra datos validos para el diagrama entonces presenta uno por defecto con la advertencia
    if ($DiagramaOK==0)
        {
            $DiagramaBase='<mxGraphModel dx="'.$PCO_PosXDiagrama.'" dy="'.$PCO_PosYDiagrama.'" grid="'.$PCO_HabilitarRejilla.'" gridSize="'.$PCO_TamanoRejilla.'" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="'.$PCO_AnchoPaginaDiagrama.'" pageHeight="'.$PCO_AltoPaginaDiagrama.'"> <root>    <mxCell id="0" />    <mxCell id="1" parent="0" />    <mxCell id="17" value="Si usted visualiza este mensaje es porque los parámetros de carga de su diagrama en {P}Diagram no fueron correctos.&lt;br style=&quot;font-size: 10px;&quot;&gt;&lt;br style=&quot;font-size: 10px;&quot;&gt;Verifique el origen de los datos del diagrama e intente de nuevo" style="rounded=1;whiteSpace=wrap;html=1;fontSize=10;labelBackgroundColor=none;verticalAlign=bottom;arcSize=4;fillColor=#E6D0DE;labelBorderColor=none;glass=1;shadow=1;sketch=0;" parent="1" vertex="1">      <mxGeometry x="170" y="162" width="310" height="180" as="geometry" />    </mxCell>    <mxCell id="3" value="Framework" style="text;html=1;strokeColor=none;fillColor=none;align=center;verticalAlign=middle;whiteSpace=wrap;rounded=0;fontSize=25;fontStyle=2;fontColor=#999999;" parent="1" vertex="1">      <mxGeometry x="332" y="240" width="40" height="20" as="geometry" />    </mxCell>    <mxCell id="7" value="" style="shape=hexagon;perimeter=hexagonPerimeter2;whiteSpace=wrap;html=1;fixedSize=1;fillColor=#FFC60A;gradientDirection=north;gradientColor=#DE1016;strokeColor=none;" parent="1" vertex="1">      <mxGeometry x="220" y="190" width="70" height="60" as="geometry" />    </mxCell>    <mxCell id="8" value="Pr" style="text;html=1;strokeColor=none;fillColor=none;align=center;verticalAlign=middle;whiteSpace=wrap;rounded=0;fontStyle=1;fontSize=45;fontColor=#FFFFFF;" parent="1" vertex="1">      <mxGeometry x="240" y="210" width="40" height="20" as="geometry" />    </mxCell>    <mxCell id="15" value="áctico" style="text;html=1;strokeColor=none;fillColor=none;align=center;verticalAlign=middle;whiteSpace=wrap;rounded=0;fontStyle=1;fontSize=45;" parent="1" vertex="1">      <mxGeometry x="332" y="210" width="40" height="20" as="geometry" />    </mxCell>  </root>    </mxGraphModel>';
            $DiagramaBase='<mxGraphModel dx="782" dy="795" grid="0" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="0" pageScale="1" pageWidth="827" pageHeight="1169">  <root>    <mxCell id="0" />    <mxCell id="1" parent="0" />    <mxCell id="17" value="Si usted visualiza este mensaje es porque los parámetros de carga de su diagrama en {P}Diagram no fueron correctos.&lt;br style=&quot;font-size: 10px;&quot;&gt;&lt;br style=&quot;font-size: 10px;&quot;&gt;Verifique el origen de los datos del diagrama e intente de nuevo" style="rounded=1;whiteSpace=wrap;html=1;fontSize=10;labelBackgroundColor=none;verticalAlign=bottom;arcSize=4;fillColor=#E6D0DE;labelBorderColor=none;glass=1;shadow=1;sketch=0;" parent="1" vertex="1">      <mxGeometry x="40" y="40" width="400" height="160" as="geometry" />    </mxCell>    <mxCell id="3" value="Framework" style="text;html=1;strokeColor=none;fillColor=none;align=center;verticalAlign=middle;whiteSpace=wrap;rounded=0;fontSize=25;fontStyle=2;fontColor=#999999;" parent="1" vertex="1">      <mxGeometry x="248" y="110" width="40" height="20" as="geometry" />    </mxCell>    <mxCell id="7" value="" style="shape=hexagon;perimeter=hexagonPerimeter2;whiteSpace=wrap;html=1;fixedSize=1;fillColor=#FFC60A;gradientDirection=north;gradientColor=#DE1016;strokeColor=none;" parent="1" vertex="1">      <mxGeometry x="136" y="60" width="70" height="60" as="geometry" />    </mxCell>    <mxCell id="8" value="Pr" style="text;html=1;strokeColor=none;fillColor=none;align=center;verticalAlign=middle;whiteSpace=wrap;rounded=0;fontStyle=1;fontSize=45;fontColor=#FFFFFF;" parent="1" vertex="1">      <mxGeometry x="156" y="80" width="40" height="20" as="geometry" />    </mxCell>    <mxCell id="15" value="áctico" style="text;html=1;strokeColor=none;fillColor=none;align=center;verticalAlign=middle;whiteSpace=wrap;rounded=0;fontStyle=1;fontSize=45;" parent="1" vertex="1">      <mxGeometry x="248" y="80" width="40" height="20" as="geometry" />    </mxCell>    <mxCell id="18" value="Si aún así usted sabe que está cargando un origen de datos correctamente identificado, &lt;b&gt;revise que el campo en cuestión sí contenga un código XML válido para un diagrama&lt;/b&gt;.&amp;nbsp; &amp;nbsp;En caso de estar vacío o no coincidir con un diagrama válido para esta herramienta puede inicializarlo con la plantilla indicada y recargar la operación." style="shape=process;whiteSpace=wrap;html=1;backgroundOutline=1;size=0.03225806451612903;rounded=0;shadow=0;sketch=0;glass=0;" vertex="1" parent="1">      <mxGeometry x="40" y="228" width="340" height="100" as="geometry" />    </mxCell>    <mxCell id="20" value="Contenido básico (Plantilla) Para diagramas en blanco" style="swimlane;rounded=0;shadow=0;glass=0;sketch=0;" vertex="1" parent="1">      <mxGeometry x="40" y="340" width="401" height="100" as="geometry" />    </mxCell>    <mxCell id="27" value="&lt;div style=&quot;font-size: 11px&quot;&gt;&lt;font style=&quot;font-size: 11px&quot; color=&quot;#006600&quot;&gt;&amp;lt;mxGraphModel dx=&quot;782&quot; dy=&quot;815&quot; grid=&quot;1&quot; gridSize=&quot;10&quot;&amp;nbsp;&lt;/font&gt;&lt;/div&gt;&lt;div style=&quot;font-size: 11px&quot;&gt;&lt;font style=&quot;font-size: 11px&quot; color=&quot;#006600&quot;&gt;&lt;span&gt;	&lt;/span&gt;guides=&quot;1&quot; tooltips=&quot;1&quot; connect=&quot;1&quot; arrows=&quot;1&quot; fold=&quot;1&quot;&amp;nbsp;&lt;/font&gt;&lt;/div&gt;&lt;div style=&quot;font-size: 11px&quot;&gt;&lt;font style=&quot;font-size: 11px&quot; color=&quot;#006600&quot;&gt;&lt;span&gt;	&lt;/span&gt;page=&quot;1&quot; pageScale=&quot;1&quot; pageWidth=&quot;827&quot; pageHeight=&quot;1169&quot;&amp;gt;&lt;/font&gt;&lt;/div&gt;&lt;div style=&quot;font-size: 11px&quot;&gt;&lt;font style=&quot;font-size: 11px&quot; color=&quot;#006600&quot;&gt;&amp;lt;root&amp;gt;&amp;lt;mxCell id=&quot;0&quot; /&amp;gt;&amp;lt;mxCell id=&quot;1&quot; parent=&quot;0&quot; /&amp;gt;&amp;lt;/root&amp;gt;&amp;lt;/mxGraphModel&amp;gt;&lt;/font&gt;&lt;/div&gt;" style="text;html=1;align=left;verticalAlign=middle;resizable=0;points=[];autosize=1;" vertex="1" parent="20">      <mxGeometry x="10" y="30" width="391" height="60" as="geometry" />    </mxCell>    <mxCell id="25" value="TIP" style="shape=mxgraph.basic.oval_callout;whiteSpace=wrap;html=1;strokeColor=#000000;strokeWidth=2;rounded=0;shadow=1;glass=0;sketch=0;fillColor=#FFFF00;" vertex="1" parent="1">      <mxGeometry x="390" y="228" width="50" height="23" as="geometry" />    </mxCell>    <mxCell id="30" value="Pasos de reemplazo - sanitización" style="swimlane;childLayout=stackLayout;horizontal=1;fillColor=none;horizontalStack=1;resizeParent=1;resizeParentMax=0;resizeLast=0;collapsible=0;stackBorder=10;stackSpacing=-12;resizable=1;align=center;points=[];rounded=0;shadow=0;glass=0;sketch=0;fontColor=#990000;fontSize=15;strokeColor=none;" vertex="1" parent="1">      <mxGeometry x="17.5" y="461" width="445" height="100" as="geometry" />    </mxCell><mxCell id="31" value="1.&#xa;Ubique el origen&#xa;del diagrama" style="shape=step;perimeter=stepPerimeter;fixedSize=1;points=[];gradientColor=#CC99FF;shadow=1;rounded=1;fontSize=11;" vertex="1" parent="30">      <mxGeometry x="10" y="33" width="142" height="57" as="geometry" />    </mxCell>    <mxCell id="32" value="2.&#xa; Seleccione, copie y pegue&#xa;la plantilla en el origen" style="shape=step;perimeter=stepPerimeter;fixedSize=1;points=[];gradientColor=#99CCFF;shadow=1;rounded=1;fontSize=11;" vertex="1" parent="30">      <mxGeometry x="140" y="33" width="187" height="57" as="geometry" />    </mxCell>    <mxCell id="33" value="3.&#xa;Recargue" style="shape=step;perimeter=stepPerimeter;fixedSize=1;points=[];gradientColor=#99CCFF;shadow=1;rounded=1;fontSize=11;" vertex="1" parent="30">      <mxGeometry x="315" y="33" width="120" height="57" as="geometry" />    </mxCell>  </root></mxGraphModel>';
            $DiagramaBase=$DiagramaBaseLimpio;
	    $DiagramaOK=1;
        }

  

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

        function PCOJS_Base64Encode(Cadena) {
            return btoa(encodeURIComponent(Cadena).replace(/%([0-9A-F]{2})/g, function(match, p1) {
                return String.fromCharCode('0x' + p1);
            }));
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
                        
                        document.PCO_FrmDatosDiagrama.PCO_ContenidoDiagrama.value=DiagramaActual;
                        document.PCO_FrmDatosDiagrama.submit();
                    }
        	}

    	function PCO_CargarDiagramaInicial()
        	{
        		// Removes all illegal control characters before parsing
        		DatosRecuperadosDiagrama='<?php echo $DiagramaBase; ?>';
        		
        		//var data = Graph.zapGremlins(mxUtils.trim(textarea.value));
        		var data = Graph.zapGremlins(mxUtils.trim(DatosRecuperadosDiagrama));
        		
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

    <iframe src="about:blank" id="IFrameAlmacenamiento" name="IFrameAlmacenamiento" style="width:0px; height:0px; visibility:hidden;"></iframe>
    <form action="index.php" target="IFrameAlmacenamiento" id="PCO_FrmDatosDiagrama" name="PCO_FrmDatosDiagrama" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="PCO_Accion" value="PCO_GuardarDiagrama">
        <input type="hidden" name="PCO_CampoOrigen" value="<?php echo $PCO_CampoOrigen; ?>">
        <input type="hidden" name="PCO_TablaOrigen" value="<?php echo $PCO_TablaOrigen; ?>">
        <input type="hidden" name="PCO_CampoLlave" value="<?php echo $PCO_CampoLlave; ?>">
        <input type="hidden" name="PCO_ValorLlave" value="<?php echo $PCO_ValorLlave; ?>">
        <input type="hidden" name="PCO_ContenidoDiagrama" value="">
    </form>
</body>
</html>