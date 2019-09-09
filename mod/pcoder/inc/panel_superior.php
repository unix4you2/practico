<?php
	/*
	   PCODER (Editor de Codigo en la Nube)
	   Sistema de Edicion de Codigo basado en PHP
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

    // BARRA DE MENU DEL APLICATIVO

	//Incluye algunos marcos del aplicativo
	include_once ("inc/marco_preferencias.php");
	include_once ("inc/marco_acerca.php");
	include_once ("inc/marco_teclado.php");
?>

<div class="row" id="MarcoContenedorSuperior">
	<div class="col-md-12">

		<div id="panel_superior" >
			
			<nav class="navbar navbar-default navbar-inverse navbar-xs" style="margin:0px; padding:0px;"> <!-- navbar-fixed-top navbar-fixed-bottom navbar-static-top navbar-inverse -->
				<div class="container-fluid">
					<!-- Logo y boton colapsable -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#barra_menu_superior" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
						<a data-toggle="modal" OnClick="$('#myModalACERCADEPCODER').modal('show'); $('#myModalACERCADEPCODER').css('z-index', '1500');" class="navbar-brand text-danger"><b><i class="text-info" style="cursor:pointer;">{P}Coder</i></b></a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="barra_menu_superior">
						<ul class="nav navbar-nav">

							<!-- MENU ARCHIVO -->
							<li class="dropdown">
								<a style="cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $MULTILANG_PCODER_Archivo; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a id="boton_navegador_archivos" style="cursor:pointer;" OnClick="OperacionFS_CrearArchivo();">		<i class="fa fa-file-o fa-fw"></i> <?php echo $MULTILANG_PCODER_Nuevo; ?></a></li>
									<li role="separator" class="divider"></li>
									<li><a id="boton_navegador_archivos" style="cursor:pointer;" OnClick="PCODER_ActivarPanelIzquierdo();">		<i class="fa fa-folder-open fa-fw"></i> <?php echo $MULTILANG_PCODER_Abrir; ?>			<span class="pull-right text-muted small"><i>Ctrl+O</i></span></a></li>
									<li><a id="boton_buscador_archivos1" style="cursor:pointer;" OnClick="BuscadorArchivosVisible=0; PCODER_ActivarPanelIzquierdo(); ActivarBuscadorArchivos();">		<i class="fa fa-search fa-fw"></i> <?php echo $MULTILANG_PCODER_Buscar; ?>			</a></li>
									<li><a id="boton_guardar"            style="cursor:pointer;" OnClick="Guardar();">							<i class="fa fa-floppy-o fa-fw"></i> <?php echo $MULTILANG_PCODER_Guardar; ?>			<span class="pull-right text-muted small"><i>Ctrl+S</i></span></a></li>
									<li role="separator" class="divider"></li>
									<li><a style="cursor:pointer;" id="boton_historialversiones"       OnClick="PCODER_HistorialArchivoActual();">		<i class="fa fa-history fa-fw"></i> <?php echo $MULTILANG_PCODER_HistorialVersiones; ?>				<span class="pull-right text-muted small"><i></i></span></a></li>
									<li role="separator" class="divider"></li>
									<li><a style="cursor:pointer;" id="boton_cerraractual"       OnClick="PCODER_CerrarArchivoActual();">		<i class="fa fa-times fa-fw"></i> <?php echo $MULTILANG_PCODER_Cerrar; ?>				<span class="pull-right text-muted small"><i>Ctrl+Q</i></span></a></li>
									<li role="separator" class="divider"></li>
									<li><a style="cursor:pointer;" OnClick="VerificarCierreTotalPCoder();"><i class="fa fa-sign-out fa-fw"></i> <?php echo $MULTILANG_PCODER_Salir; ?>: <?php echo $MULTILANG_PCODER_CerrarVentana; ?></a></li>
								</ul>
							</li>

							<!-- MENU EDITAR -->
							<li class="dropdown">
								<a style="cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $MULTILANG_PCODER_Editar; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									
									<li><a style="cursor:pointer;" OnClick="PCODER_DeshacerEdicion();"><i class="fa fa-undo fa-fw"></i> <?php echo $MULTILANG_PCODER_Deshacer; ?>		<span class="pull-right text-muted small"><i>Ctrl+Z</i></span></a></li>
									<li><a style="cursor:pointer;" OnClick="PCODER_RehacerEdicion();"><i class="fa fa-repeat fa-fw"></i> <?php echo $MULTILANG_PCODER_Rehacer; ?>	<span class="pull-right text-muted small"><i>Ctrl+Y</i></span></a></li>
									<li role="separator" class="divider"></li>
									
									<li><a style="cursor:pointer;" OnClick="editor.selectAll();"><i class="fa fa-file-text fa-fw"></i> <?php echo $MULTILANG_PCODER_SeleccionarTodo; ?>	<span class="pull-right text-muted small"><i>Ctrl+A</i></span></a></li>
									<li role="separator" class="divider"></li>
									<!--
									<li><a style="cursor:pointer;" OnClick="editor.execCommand('cut');"><i class="fa fa-scissors fa-fw"></i> <?php echo $MULTILANG_PCODER_Cortar; ?>	<span class="pull-right text-muted small"><i>Ctrl+X</i></span></a></li>
									<li><a style="cursor:pointer;" OnClick="editor.execCommand('copy');"><i class="fa fa-files-o fa-fw"></i> <?php echo $MULTILANG_PCODER_Copiar; ?>	<span class="pull-right text-muted small"><i>Ctrl+C</i></span></a></li>
									<li><a style="cursor:pointer;" OnClick="editor.execCommand('paste');"><i class="fa fa-clipboard fa-fw"></i> <?php echo $MULTILANG_PCODER_Pegar; ?>	<span class="pull-right text-muted small"><i>Ctrl+V</i></span></a></li>
									<li role="separator" class="divider"></li>
									-->
									<li><a style="cursor:pointer;" OnClick="editor.execCommand('duplicateSelection');"><i class="fa fa-pause fa-fw"></i> <?php echo $MULTILANG_PCODER_DuplicarSeleccion; ?>	<span class="pull-right text-muted small"><i>Ctrl+Shift+D</i></span></a></li>
									<li><a style="cursor:pointer;" OnClick="editor.execCommand('invertSelection');"><i class="fa fa-eraser fa-fw"></i> <?php echo $MULTILANG_PCODER_InvertirSeleccion; ?>	</a></li>
									<li><a style="cursor:pointer;" OnClick="editor.execCommand('joinlines');"><i class="fa fa-reorder fa-fw"></i> <?php echo $MULTILANG_PCODER_UnirSeleccion; ?>	</a></li>
									<li role="separator" class="divider"></li>
									<li><a style="cursor:pointer;" OnClick="editor.execCommand('find');"><i class="fa fa-search fa-fw"></i> <?php echo $MULTILANG_PCODER_Buscar; ?>	<span class="pull-right text-muted small"><i>Ctrl+F</i></span></a></li>
									<li><a style="cursor:pointer;" OnClick="editor.execCommand('replace');"><i class="fa fa-exchange fa-fw"></i> <?php echo $MULTILANG_PCODER_Reemplazar; ?>	<span class="pull-right text-muted small"><i>Ctrl+H</i></span></a></li>
									<li role="separator" class="divider"></li>
									<li style="cursor:pointer;" OnClick="$('#myModalPREFERENCIAS').modal('show'); $('#myModalPREFERENCIAS').css('z-index', '1500');"><a data-toggle="modal"><i class="fa fa-wrench fa-fw text-warning"></i> <?php echo $MULTILANG_PCODER_Preferencias; ?></a></li>
								</ul>
							</li>
							<!--<li><a href="#">EJEMPLO ENLACE</a></li>-->

							<!-- MENU VER -->
							<li class="dropdown">
								<a style="cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $MULTILANG_PCODER_Ver; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a style="cursor:pointer;" OnClick="IntercambiarPantallaCompleta();"><i class="fa fa-desktop fa-fw"></i> <?php echo $MULTILANG_PCODER_PantallaCompleta; ?>	<span class="pull-right text-muted small"><i>F11</i></span></a></li>
									<li><a style="cursor:pointer;" OnClick="IntercambiarEstadoCaracteresInvisibles();"><i class="fa fa-eye-slash fa-fw"></i> <?php echo $MULTILANG_PCODER_CaracNoImprimibles; ?></a></li>
									<li><a style="cursor:pointer;" OnClick="IntercambiarVisibilidadNumerosDeLinea();"><i class="fa fa-list-ol fa-fw"></i> <?php echo $MULTILANG_PCODER_NrosLinea; ?></a></li>
									<li role="separator" class="divider"></li>
									<li><a style="cursor:pointer;" OnClick="AumentarTamanoFuente();"><i class="fa fa-plus-square fa-fw"></i> <?php echo $MULTILANG_PCODER_Acercar; ?></a></li>
									<li><a style="cursor:pointer;" OnClick="DisminuirTamanoFuente();"><i class="fa fa-minus-square fa-fw"></i> <?php echo $MULTILANG_PCODER_Alejar; ?></a></li>
									<li role="separator" class="divider"></li>
									<li><a style="cursor:pointer;" OnClick="PCODER_ActivarPanelIzquierdo();"><i class="fa fa-columns fa-fw"></i> <?php echo $MULTILANG_PCODER_PanelIzq; ?></a></li>
									<li><a style="cursor:pointer;" OnClick="PCODER_ActivarPanelDerecho();"><i class="fa fa-columns fa-fw"></i> <?php echo $MULTILANG_PCODER_PanelDer; ?></a></li>
									<li role="separator" class="divider"></li>
									<li><a style="cursor:pointer;" OnClick="PCODER_DividirPantalla_NO();"><i class="fa fa-stop fa-fw"></i> <?php echo $MULTILANG_PCODER_DividirNO; ?></a></li>
									<li><a style="cursor:pointer;" OnClick="PCODER_DividirPantalla_Horizontal();"><i class="fa fa-pause fa-rotate-90 fa-fw"></i> <?php echo $MULTILANG_PCODER_DividirHorizontal; ?></a></li>
									<li><a style="cursor:pointer;" OnClick="PCODER_DividirPantalla_Vertical();"><i class="fa fa-pause fa-fw"></i> <?php echo $MULTILANG_PCODER_DividirVertical; ?></a></li>
									<li role="separator" class="divider"></li>
									<li><a style="cursor:pointer;" OnClick="editor.execCommand('fold');"><i class="fa fa-compress fa-fw"></i> <?php echo $MULTILANG_PCODER_EnrollarSeleccion; ?> <span class="pull-right text-muted small"><i>Alt+L</i></span></a></li>
									<li><a style="cursor:pointer;" OnClick="editor.execCommand('unfoldall');"><i class="fa fa-expand fa-fw"></i> <?php echo $MULTILANG_PCODER_DesenrollarTodo; ?> <span class="pull-right text-muted small"><i>Alt+Shift+0</i></span></a></li>
								</ul>
							</li>
							<!--<li><a href="#">EJEMPLO ENLACE</a></li>-->

							<!-- MENU FORMATO -->
							<li class="dropdown">
								<a style="cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $MULTILANG_PCODER_Formato; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a style="cursor:pointer;" OnClick="editor.indent();"><i class="fa fa-indent fa-fw"></i> <?php echo $MULTILANG_PCODER_AumSangria; ?></a></li>
									<li><a style="cursor:pointer;" OnClick="editor.outdent();"><i class="fa fa-outdent fa-fw"></i> <?php echo $MULTILANG_PCODER_DisSangria; ?></a></li>
									<li role="separator" class="divider"></li>
									<li><a style="cursor:pointer;" OnClick="editor.execCommand('touppercase');"><i class="fa fa-font fa-fw"></i> <?php echo $MULTILANG_PCODER_ConvMay; ?></a></li>
									<li><a style="cursor:pointer;" OnClick="editor.execCommand('tolowercase');"><i class="fa fa-info fa-fw"></i> <?php echo $MULTILANG_PCODER_ConvMin; ?></a></li>
									<li><a style="cursor:pointer;" OnClick="editor.execCommand('sortlines');  "><i class="fa fa-sort-alpha-asc fa-fw"></i> <?php echo $MULTILANG_PCODER_OrdenaSel; ?></a></li>
								</ul>
							</li>

							<!-- MENU DEPURAR -->
							<li class="dropdown">
								<a style="cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $MULTILANG_PCODER_Depurar; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a style="cursor:pointer;" OnClick="editor.execCommand('goToNextError');"><i class="fa fa-indent fa-fw"></i><?php echo $MULTILANG_PCODER_DepuraErrorSiguiente; ?> <span class="pull-right text-muted small"><i>Alt+E</i></span></a></li>
									<li><a style="cursor:pointer;" OnClick="editor.execCommand('goToPreviousError');"><i class="fa fa-outdent fa-fw"></i><?php echo $MULTILANG_PCODER_DepuraErrorPrevio; ?> <span class="pull-right text-muted small"><i>Alt+Shift+E</i></span></a></li>
									<li role="separator" class="divider"></li>
									<li><a style="cursor:pointer;" OnClick="VerificarSintaxisEditor(0);"><input type="checkbox" id="Check_VerificarSintaxisEditor" value="1" checked readonly> <?php echo $MULTILANG_PCODER_Activar; ?>/<?php echo $MULTILANG_PCODER_Desactivar; ?> <?php echo $MULTILANG_PCODER_CheqSintaxis; ?></a></li>

									<li><a style="cursor:pointer;" OnClick="VerificarAutocompletado(0);"><input type="checkbox" id="Check_VerificarAutocompletado" value="1" checked readonly> <?php echo $MULTILANG_PCODER_Activar; ?>/<?php echo $MULTILANG_PCODER_Desactivar; ?> <?php echo $MULTILANG_PCODER_Autocompletado; ?></a></li>


								</ul>
							</li>

							<!-- MENU HERRAMIENTAS -->
							<li class="dropdown">
								<a style="cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $MULTILANG_PCODER_Herramientas; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a style="cursor:pointer;" OnClick="PCODER_ActivarPanelDerecho();"><i class="fa fa-paint-brush fa-fw"></i> <?php echo $MULTILANG_PCODER_ExploradorColores; ?></a></li>
									<li><a style="cursor:pointer;" OnClick="PCODER_ActivarPanelDerecho();"><i class="fa fa-map-signs fa-fw"></i> <?php echo $MULTILANG_PCODER_Minimap; ?></a></li>
									<li><a style="cursor:pointer;" OnClick="$('#pestana_diferencias').trigger('click');"><i class="fa fa-eye-slash fa-fw"></i> <?php echo $MULTILANG_PCODER_HerramientaDiferencias; ?></a></li>
									<li><a id="boton_buscador_archivos2" style="cursor:pointer;" OnClick="BuscadorArchivosVisible=0; PCODER_ActivarPanelIzquierdo(); ActivarBuscadorArchivos();">		<i class="fa fa-search fa-fw"></i> <?php echo $MULTILANG_PCODER_Buscar; ?> <?php echo $MULTILANG_PCODER_Archivo; ?>			</a></li>
								</ul>
							</li>

							<!-- BOTONES INDEPENDIENTES -->
							<li><a style="cursor:pointer;" OnClick="editor.execCommand('find');" data-toggle="tooltip" data-placement="bottom" title="<?php echo $MULTILANG_PCODER_Buscar; ?>"><i class="fa fa-search fa-fw text-danger "></i></a></li>
							<li><a style="cursor:pointer;" OnClick="IntercambiarPantallaCompleta();" data-toggle="tooltip" data-placement="bottom" title="<?php echo $MULTILANG_PCODER_PantallaCompleta; ?>"><i class="fa fa-desktop fa-fw text-default"></i></a></li>
							
							<!-- SELECCION EN CALIENTE DEL LENGUAJE -->
							<li>
								<select style="margin-top:1px;" id="modo_archivo_top" size="1" class=" btn-xs btn-primary" onchange="CambiarModoEditor(this.value)"  data-toggle="tooltip" data-placement="bottom" title="<?php echo $MULTILANG_PCODER_LenguajeResaltado; ?>">
								  <?php
									//Presenta los lenguajes disponibles
									for ($i=0;$i<count($PCODER_Modos);$i++)
										echo '<option value="ace/mode/'.$PCODER_Modos[$i]["Nombre"].'" >'.$PCODER_Modos[$i]["Nombre"].'</option>';
								  ?>
								</select>
							</li>


						</ul>
							
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a style="cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-question-circle text-info"></i> <?php echo $MULTILANG_PCODER_Ayuda; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a style="cursor:pointer;" OnClick="$('#AtajosTeclado').modal('show'); $('#AtajosTeclado').css('z-index', '1500');"><i class="fa fa-keyboard-o fa-fw"></i> <?php echo $MULTILANG_PCODER_AtajosTitPcoder; ?></a></li>
									<li role="separator" class="divider"></li>
									<li><a style="cursor:pointer;" OnClick="$('#myModalACERCADEPCODER').modal('show'); $('#myModalACERCADEPCODER').css('z-index', '1500');"><i class="fa fa-info-circle fa-fw"></i> <?php echo $MULTILANG_PCODER_Acerca; ?></a></li>
									<!--<li><a style="cursor:pointer;" OnClick="editor.execCommand('showSettingsMenu');"><i class="fa fa-cogs fa-fw"></i> <?php echo $MULTILANG_PCODER_Otros; ?></a></li>-->
								</ul>
							</li>
						</ul>

					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>

		</div><!-- /.contenedor -->

	</div>
</div>