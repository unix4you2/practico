<?php
	/*
	Copyright (C) 2013  John F. Arroyave Gutiérrez
						unix4you2@gmail.com

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
	*/	

	/*
		Title: PCODER - Practico CODe EditoR
		Ubicacion *[/mod/pcoder/index.php]*.  Archivo que contiene las funciones de enlace al modulo de Edicion de codigo
        
        Este modulo permite abrir archivos de codigo desde la web para editarlos directamente con las caracteristicas de cualquier editor de codigo

		Section: Modulos complementarios
	*/

	// Valida sesion activa de Practico
	@session_start();
	
    if (!isset($PCOSESS_SesionAbierta)) 
		{
			echo '<head><title>Error</title><style type="text/css"> body { background-color: #000000; color: #7f7f7f; font-family: sans-serif,helvetica; } </style></head><body><table width="100%" height="100%" border=0><tr><td align=center>&#9827; Acceso no autorizado !</td></tr></table></body>';
			die();
		}
    
	// Configuraciones basicas del modulo
	$PCODER_raiz_modulo = "mod/pcoder/";
	$PCODER_modelos = $PCODER_raiz_modulo."modelo/";
	$PCODER_vistas = $PCODER_raiz_modulo."vista/";
	$PCODER_controladores = $PCODER_raiz_modulo."controlador/";
	$PCODER_idiomas = $PCODER_raiz_modulo."idiomas/";

    //Llamar al controlador inicial de la aplicacion o modulo
    @require($PCODER_modelos.'modelo.php');
    @require($PCODER_vistas.'vista.php');
    @require($PCODER_controladores.'controlador.php');

    //Carga el archivo recibido
    $PCODER_archivo = "../testpcoder.php";
    PCODER_cargar_archivo($PCODER_archivo);


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
<style type="text/css">
    html, body {
        margin: 0;
        padding: 0;
        height: 100%;
        min-height: 100%;
        width: 100%;
        background: #BFBFBF;  /*002a36*/
        overflow-x: hidden;
        overflow-y: hidden;
    }
    #editor_codigo { 
        width: 100%; 
        height: 600px;
        /*height: 100%;*/
        min-height: 100%;
    }
</style>
<body>






<div class="row" style="height: 100%; min-height: 100%;">
    <div class="row container-full" style="height: 100%; min-height: 100%;">
        <div class="col-lg-12 container-full" style="height: 100%; min-height: 100%;">
            <div class="form-group" style="height: 100%; min-height: 100%;">
                

    <div class="row container-fluid">
        <div class="col-lg-12 container-fluid">
            <?php 
                // Verifica que el archivo exista
                $existencia_ok=1;
                if (!file_exists($PCODER_archivo)) 
                    {
                        mensaje('<i class="fa fa-warning text-info texto-blink"></i> '.$MULTILANG_Error.': '.$MULTILANG_ErrorExistencia.'. '.$MULTILANG_Cargando.'='.$PCODER_archivo, '', '', '', 'alert alert-danger alert-dismissible');
                        $existencia_ok=0;
                    }

                // Verifica permisos de escritura
                $permisos_ok=1;
                if (!is_writable($PCODER_archivo) && $existencia_ok)
                    {
                        $permisos_encontrados=@substr(sprintf('%o', fileperms($PCODER_archivo)), -4);
                        mensaje('<i class="fa fa-warning text-info texto-blink"></i> '.$MULTILANG_Error.': '.$MULTILANG_ErrorRW.'. '.$MULTILANG_Estado.'='.$permisos_encontrados, '', '', '', 'alert alert-warning alert-dismissible');
                        $permisos_ok=0;
                    }

                // Verifica si existe el directorio para el editor ACE
                $editor_ok=1;
                if (@!file_exists("inc/ace"))
                    {
                        mensaje('<i class="fa fa-warning text-info texto-blink"></i> '.$MULTILANG_Error.': '.$MULTILANG_ErrorNoACE.': '.$PCODER_archivo, '', '', '', 'alert alert-danger alert-dismissible');
                        $editor_ok=0;
                        die();
                    }
            ?>
        </div>
    </div>




<nav class="navbar navbar-default  navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href=""><img src="img/pcoder.png"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse btn-xs" id="barra_superior">
      <ul class="nav navbar-nav">
        <li class="btn-primary">
            &nbsp;<?php echo $MULTILANG_Nombre; ?>: <?php echo $PCODER_archivo; ?>
            <span class="badge"><?php echo $PCODER_TamanoElemento; ?> Kb</span>
            &nbsp;
        </li>
      </ul>
      
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
                
                <!-- Dispone el control de area de texto y el div donde se empotrara el editor -->
                <textarea id="area_texto" name="area_texto" style="visibility:hidden; display:none;"><?php echo $PCODERcontenido_archivo; ?></textarea>
                <div id="editor_codigo" class="form-control container-fluid"></div>



<nav class="navbar navbar-default nav-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

        <li class="btn-xs">
            <label for="tamano_fuente">Tamano Fuente</label>
            <select id="tamano_fuente" size="1" class="form-control btn-xs" onchange="CambiarFuenteEditor(this.value)">
              <option value="10px">10px</option>
              <option value="11px">11px</option>
              <option value="12px">12px</option>
              <option value="13px">13px</option>
              <option value="14px" selected="selected">14px</option>
              <option value="16px">16px</option>
              <option value="18px">18px</option>
              <option value="20px">20px</option>
              <option value="24px">24px</option>
            </select>
        </li>

        <li class="btn-xs">
            <label for="tema_grafico">Apariencia</label>
            <select id="tema_grafico" size="1" class="form-control btn-xs" onchange="CambiarTemaEditor(this.value)">
              <optgroup label="Brillantes / Bright">
                  <?php
                    //Presenta los temas claros disponibles
                    for ($i=0;$i<count($PCODER_TemasBrillantes);$i++)
                        echo '<option value="ace/theme/'.$PCODER_TemasBrillantes[$i]["Valor"].'">'.$PCODER_TemasBrillantes[$i]["Nombre"].'</option>';
                  ?>
              </optgroup>
              <optgroup label="Oscuros / Dark">
                  <?php
                    //Presenta los temas claros disponibles
                    for ($i=0;$i<count($PCODER_TemasOscuros);$i++)
                        echo '<option value="ace/theme/'.$PCODER_TemasOscuros[$i]["Valor"].'">'.$PCODER_TemasOscuros[$i]["Nombre"].'</option>';
                  ?>
              </optgroup>
            </select>
        </li>

        <li class="btn-xs">
            <label for="modo_archivo">Lenguaje</label>
            <select id="modo_archivo" size="1" class="form-control btn-xs" onchange="CambiarModoEditor(this.value)">
                  <?php
                    //Presenta los temas claros disponibles
                    for ($i=0;$i<count($PCODER_Modos);$i++)
                        {
                            //Determina si el lenguaje o modo de archivo actual es la opcion a desplegar
                            $modo_seleccion='';
                            if($PCODER_Modos[$i]["Nombre"]==$PCODER_ModoEditor)
                                $modo_seleccion='SELECTED';
                            //PResenta la opcion
                            echo '<option value="ace/mode/'.$PCODER_Modos[$i]["Nombre"].'" '.$modo_seleccion.' >'.$PCODER_Modos[$i]["Nombre"].'</option>';
                        }
                  ?>
            </select>
        </li>

        <li class="btn-xs">
            <label for="modo_invisibles">Ver caracteres invisibles</label>
            <select id="modo_invisibles" size="1" class="form-control btn-xs" onchange="CaracteresInvisiblesEditor(this.value)">
                <option value="0"><?php echo $MULTILANG_No; ?></option>
                <option value="1"><?php echo $MULTILANG_Si; ?></option>
            </select>
        </li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>




            </div>
        </div>
    </div>
</div>



    <!-- jQuery -->
	<script type="text/javascript" src="inc/jquery/jquery-2.1.0.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="inc/bootstrap/js/bootstrap.min.js"></script>

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

    <script src="inc/ace/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
    
    <script>
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

        // Crea el editor
        editor = ace.edit("editor_codigo");
        
        //Actualiza el editor con el valor cargado inicialmente en el textarea
        editor.setValue(document.getElementById("area_texto").value);

        // Inicia el editor de codigo con las opciones predeterminadas
        CambiarFuenteEditor("14px");
        CambiarTemaEditor("ace/theme/ambiance");  //twilight|eclipse|ambiance|ETC
        CambiarModoEditor("ace/mode/<?php echo $PCODER_ModoEditor; ?>");
        CaracteresInvisiblesEditor(0);
        editor.clearSelection();
        
        //En cada evento de cambio actualiza el textarea
        editor.getSession().on('change', function(){
          document.getElementById("area_texto").value=editor.getSession().getValue();
        });
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
</body>
</html>
<?php
	}

