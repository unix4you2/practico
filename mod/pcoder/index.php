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


    $PCODER_archivo = "../testpcoder.php";
    $PCODER_partes_extension = explode(".","core/ajax.php");
    $PCODER_extension = $PCODER_partes_extension[count($PCODER_partes_extension)-1];
    //Carga y Escapa el contenido del archivo
    $PCODERcontenido_archivo=@file_get_contents($PCODER_archivo);
    $PCODERcontenido_archivo=@htmlspecialchars($PCODERcontenido_archivo);

    //Cargar otras caracteristicas del archivo
    $PCODER_TamanoElemento=@round(filesize($PCODER_archivo)/1024);
    $PCODER_TipoElemento=filetype($PCODER_archivo);
    $PCODER_FechaElemento=date("d F Y H:i:s", filemtime($PCODER_archivo));


    //DOCS: http://stackoverflow.com/questions/15186558/loading-a-html-file-into-ace-editor-pre-tag
    //DOCS: <pre id="editor"><INTE ? php echo htmlentities(file_get_contents($input_dir."abc.html")); ? ></pre>
    //$PCODERcontenido_archivo=@htmlspecialchars(addslashes($PCODERcontenido_archivo));

/* ################################################################## */
/* ################################################################## */
/*
	Function: cargar_pcoder
	Abre el Practico Coder y carga un archivo sobre el para su edicion

    Entradas:

        Normalmente los parametros son: ?PCO_Accion=cargar_pcoder&Presentar_FullScreen=1&Precarga_EstilosBS=1
        * Comando: javascript:PCO_VentanaPopup('index.php?PCO_Accion=PCOMOD_CargarPcoder&Presentar_FullScreen=1&Precarga_EstilosBS=1','Pcoder','toolbar=no, location=no, directories=0, directories=no, status=no, location=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, titlebar=no, width=900, height=700');

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
    width: 100%;
    background: #BFBFBF;
}
</style>

<body>

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

<div class="row">


    <div class="row container-full">
        <div class="col-lg-12 container-full">

            <div class="form-group">
                <textarea name="javascript" data-editor="javascript" class="form-control container-fluid" style="width:100%; height:600px;"><?php echo $PCODERcontenido_archivo; ?></textarea>
            </div>

        </div>
    </div>
</div>


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
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
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>




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

    <?php
        // Si existe el directorio para el editor ACE lo incluye
        if (@file_exists("inc/ace"))
            {
    ?>
            <script src="inc/ace/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
            
            <script>
                /*
                // Habilita el editor ACE para los textareas con el atributo data-editor
                $(function () {
                    $('textarea[data-editor]').each(function () {
                        var textarea = $(this);

                        var mode = textarea.data('editor');

                        var editDiv = $('<div>', {
                            position: 'absolute',
                            width: textarea.width(),
                            height: textarea.height(),
                            'class': textarea.attr('class')
                        }).insertBefore(textarea);

                        textarea.css('visibility', 'hidden');
                        textarea.css('display', 'none');

                        var editor = ace.edit(editDiv[0]);
                        //editor.renderer.setShowGutter(false); //Ocultar numero de lineas, ayudas, opciones de colapsar, etc
                        editor.getSession().setValue(textarea.val());
                        editor.getSession().setMode("ace/mode/" + mode);
                        editor.setTheme("ace/theme/eclipse"); //Establece el tema a utilizar twilight|eclipse

                        //En cada evento de cambio actualiza el textarea
                        editor.getSession().on('change', function(){
                          textarea.val(editor.getSession().getValue());
                        });
                    });
                });
                */
            </script>
    <?php        
            } // Fin Si existe ACE
    ?>

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

