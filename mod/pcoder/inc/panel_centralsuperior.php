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
?>
<div class="row">
	<div class="col-md-12">

		<div id="panel_central_superior" >

			<!-- ################ INICIO PESTANAS SUPERIORES ############### -->
			<ul class="nav nav-tabs btn-xs" role="tablist">
				<li class="active"><a id="pestana_editor_archivos" href="#pestana_superior_editores" data-toggle="tab" OnClick=""><i class="fa fa-pencil-square-o fa-fw"></i> <?php echo $MULTILANG_PCODER_EditorArchivos; ?></a></li>
				<li><a id="pestana_consola" data-toggle="tab" href="#pestana_consola_comandos"><i class="fa fa-desktop fa-fw"></i> <?php echo $MULTILANG_PCODER_TerminalRemota; ?></a></li>
				<li><a id="pestana_explorador" data-toggle="tab" href="#pestana_explorador_web"><i class="fa fa-globe fa-fw"></i> <?php echo $MULTILANG_PCODER_NavegadorEmbebido; ?></a></li>
			</ul>

		</div>

	</div>
</div>
