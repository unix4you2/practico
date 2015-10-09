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
    //   https://github.com/ajaxorg/ace/blob/master/lib/ace/commands/default_commands.js#L171
    //   http://ace.c9.io/api/editor.html
    //   http://ace.c9.io/build/kitchen-sink.html
?>

<div class="row">
	<div class="col-md-12">

		<div id="contenedor_menu" >

			<nav class="navbar navbar-default navbar-inverse" style="margin:0px; padding:0px;"> <!-- navbar-fixed-top navbar-fixed-bottom navbar-static-top navbar-inverse -->
				<div class="container-fluid">
					<!-- Logo y boton colapsable -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#barra_menu_superior" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand text-danger" href="#"><b><i class="text-info">{P}Coder</i></b></a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="barra_menu_superior">
						<ul class="nav navbar-nav">

							<!-- MENU ARCHIVO -->
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $MULTILANG_PCODER_Archivo; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a id="boton_navegador_archivos" data-toggle="modal"  href="#NavegadorArchivos" OnClick="ExplorarPath();">   <i class="fa fa-folder-open fa-fw"></i> <?php echo $MULTILANG_PCODER_Abrir; ?></a>		</li>
									<li><a id="boton_guardar"            OnClick="Guardar();" href="#VentanaAlmacenamiento">					<i class="fa fa-floppy-o fa-fw"></i> <?php echo $MULTILANG_PCODER_Guardar; ?>			<span class="pull-right text-muted small"><i>Ctrl+S</i></span></a></li>
									<li role="separator" class="divider"></li>
									<li><a href="javascript:self.close();"><i class="fa fa-times fa-fw"></i> <?php echo $MULTILANG_PCODER_Salir; ?>: <?php echo $MULTILANG_PCODER_CerrarVentana; ?></a></li>
								</ul>
							</li>

							<!-- MENU EDITAR -->
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $MULTILANG_PCODER_Editar; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#" OnClick="editor.undo();"><i class="fa fa-undo fa-fw"></i> <?php echo $MULTILANG_PCODER_Deshacer; ?></a></li>
									<li><a href="#" OnClick="editor.redo();"><i class="fa fa-repeat fa-fw"></i> <?php echo $MULTILANG_PCODER_Rehacer; ?></a></li>
									<li role="separator" class="divider"></li>
									<li><a href="#" OnClick="editor.execCommand('cut');"><i class="fa fa-scissors fa-fw"></i> <?php echo $MULTILANG_PCODER_Cortar; ?></a></li>
									<li><a href="#" OnClick="editor.execCommand('copy');"><i class="fa fa-files-o fa-fw"></i> <?php echo $MULTILANG_PCODER_Copiar; ?></a></li>
									<li><a href="#" OnClick="editor.execCommand('paste');"><i class="fa fa-clipboard fa-fw"></i> <?php echo $MULTILANG_PCODER_Pegar; ?></a></li>
									<li role="separator" class="divider"></li>
									<li><a href="#" OnClick="editor.execCommand('find');"><i class="fa fa-search fa-fw"></i> <?php echo $MULTILANG_PCODER_Buscar; ?></a></li>
									<li><a href="#" OnClick="editor.execCommand('replace');"><i class="fa fa-exchange fa-fw"></i> <?php echo $MULTILANG_PCODER_Reemplazar; ?></a></li>
								</ul>
							</li>
							<!--<li><a href="#">EJEMPLO ENLACE</a></li>-->

							<!-- MENU VER -->
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $MULTILANG_PCODER_Ver; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#" OnClick="IntercambiarPantallaCompleta();"><i class="fa fa-arrows-alt fa-fw"></i> <?php echo $MULTILANG_PCODER_PantallaCompleta; ?></a></li>
									<li><a href="#" OnClick="IntercambiarEstadoCaracteresInvisibles();"><i class="fa fa-eye-slash fa-fw"></i> <?php echo $MULTILANG_PCODER_CaracNoImprimibles; ?></a></li>
									<li role="separator" class="divider"></li>
									<li><a href="#" OnClick="AumentarTamanoFuente();"><i class="fa fa-plus-square fa-fw"></i> <?php echo $MULTILANG_PCODER_Acercar; ?></a></li>
									<li><a href="#" OnClick="DisminuirTamanoFuente();"><i class="fa fa-minus-square fa-fw"></i> <?php echo $MULTILANG_PCODER_Alejar; ?></a></li>
									<li role="separator" class="divider"></li>
									<li><a href="#" OnClick="ActivarPanelIzquierdo();"><i class="fa fa-columns fa-fw"></i> <?php echo $MULTILANG_PCODER_PanelIzq; ?></a></li>
									<li><a href="#" OnClick="ActivarPanelDerecho();"><i class="fa fa-columns fa-fw"></i> <?php echo $MULTILANG_PCODER_PanelDer; ?></a></li>
								</ul>
							</li>
							<!--<li><a href="#">EJEMPLO ENLACE</a></li>-->

							<!-- MENU FORMATO -->
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $MULTILANG_PCODER_Formato; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#" OnClick="editor.indent();"><i class="fa fa-indent fa-fw"></i> <?php echo $MULTILANG_PCODER_AumSangria; ?></a></li>
									<li><a href="#" OnClick="editor.outdent();"><i class="fa fa-outdent fa-fw"></i> <?php echo $MULTILANG_PCODER_DisSangria; ?></a></li>
									<li role="separator" class="divider"></li>
									<li><a href="#" OnClick="editor.execCommand('touppercase');"><i class="fa fa-font fa-fw"></i> <?php echo $MULTILANG_PCODER_ConvMay; ?></a></li>
									<li><a href="#" OnClick="editor.execCommand('tolowercase');"><i class="fa fa-info fa-fw"></i> <?php echo $MULTILANG_PCODER_ConvMin; ?></a></li>
								</ul>
							</li>

							<!-- BOTONES INDEPENDIENTES -->
							<li><a href="#" OnClick="editor.execCommand('find');" data-toggle="tooltip" data-placement="bottom" title="<?php echo $MULTILANG_PCODER_Buscar; ?>"><i class="fa fa-search fa-fw text-danger "></i></a></li>
							<li><a href="#" OnClick="editor.execCommand('sortlines');" data-toggle="tooltip" data-placement="bottom" title="<?php echo $MULTILANG_PCODER_OrdenaSel; ?>"><i class="fa fa-sort-alpha-asc fa-fw text-primary"></i></a></li>
						
						
						</ul>
							
						<ul class="nav navbar-nav navbar-right">
							<a data-toggle="modal" href="#myModalPREFERENCIAS" class="navbar-text"><i class="fa fa-wrench fa-fw text-info"></i> <?php echo $MULTILANG_PCODER_Preferencias; ?></a>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-question-circle text-info"></i> <?php echo $MULTILANG_PCODER_Ayuda; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a data-toggle="modal" href="#AtajosTeclado"><i class="fa fa-keyboard-o fa-fw"></i> <?php echo $MULTILANG_PCODER_AtajosTitPcoder; ?></a></li>
									<li role="separator" class="divider"></li>
									<li><a data-toggle="modal" href="#myModalACERCADEPCODER"><i class="fa fa-info-circle fa-fw"></i> <?php echo $MULTILANG_PCODER_Acerca; ?></a></li>
									<li><a href="#" OnClick="editor.execCommand('showSettingsMenu');"><i class="fa fa-cogs fa-fw"></i> <?php echo $MULTILANG_PCODER_Otros; ?></a></li>
								</ul>
							</li>
						</ul>

					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>

		</div><!-- /.contenedor -->

	</div>
</div>
