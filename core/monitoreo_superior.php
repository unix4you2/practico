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

    // BARRA DE MENU DEL MONITOREO
?>

<div class="row">
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
						<a class="navbar-brand text-primary"><b><i class="text-primary" style="cursor:pointer;"><i class="fa fa-tachometer text-primary">&nbsp;</i>Monitor</i></b></a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="barra_menu_superior">
						<ul class="nav navbar-nav">

							<!-- MENU ARCHIVO -->
							<li class="dropdown">
								<a style="cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $MULTILANG_Pagina; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a id="boton_navegador_archivos" style="cursor:pointer;" OnClick="OperacionFS_CrearArchivo();">		<i class="fa fa-file-o fa-fw"></i> <?php echo $MULTILANG_PCODER_Nuevo; ?></a></li>
									<li role="separator" class="divider"></li>
									<li><a id="boton_navegador_archivos" style="cursor:pointer;" OnClick="PCODER_ActivarPanelIzquierdo();">		<i class="fa fa-folder-open fa-fw"></i> <?php echo $MULTILANG_PCODER_Abrir; ?>			<span class="pull-right text-muted small"><i>Ctrl+O</i></span></a></li>
									<li><a id="boton_buscador_archivos1" style="cursor:pointer;" OnClick="BuscadorArchivosVisible=0; PCODER_ActivarPanelIzquierdo(); ActivarBuscadorArchivos();">		<i class="fa fa-search fa-fw"></i> <?php echo $MULTILANG_PCODER_Buscar; ?>			</a></li>
									<li><a id="boton_guardar"            style="cursor:pointer;" OnClick="Guardar();">							<i class="fa fa-floppy-o fa-fw"></i> <?php echo $MULTILANG_PCODER_Guardar; ?>			<span class="pull-right text-muted small"><i>Ctrl+S</i></span></a></li>
									<li role="separator" class="divider"></li>
									<li><a style="cursor:pointer;" id="boton_cerraractual"       OnClick="PCODER_CerrarArchivoActual();">		<i class="fa fa-times fa-fw"></i> <?php echo $MULTILANG_PCODER_Cerrar; ?>				<span class="pull-right text-muted small"><i>Ctrl+Q</i></span></a></li>
									<li role="separator" class="divider"></li>
									<li><a style="cursor:pointer;" OnClick="self.close();"><i class="fa fa-sign-out fa-fw"></i> <?php echo $MULTILANG_PCODER_Salir; ?>: <?php echo $MULTILANG_PCODER_CerrarVentana; ?></a></li>
								</ul>
							</li>

							<!-- BOTONES INDEPENDIENTES -->
							<li><a style="cursor:pointer;" OnClick="EstadoPausa=1;" data-toggle="tooltip" data-placement="bottom" title="Pausa en esta ventana / Pause this window"><i class="fa fa-pause fa-fw text-danger "></i> <?php echo $MULTILANG_Pausar; ?></a></li>
							<li><a style="cursor:pointer;" OnClick="EstadoPausa=0; actualizar();" data-toggle="tooltip" data-placement="bottom" title="Continuar monitoreo / Continue with monitoring"><i class="fa fa-play fa-fw text-success"></i> <?php echo $MULTILANG_Continuar; ?></a></li>

						</ul>
							
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a style="cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-question-circle text-info"></i> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a style="cursor:pointer;"><i class="fa fa-info fa-fw"></i> <?php echo $MULTILANG_Ayuda; ?></a></li>
								</ul>
							</li>
						</ul>

					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>

		</div><!-- /.contenedor -->

	</div>
</div>
