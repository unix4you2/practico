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
				<li class="active"><a id="pestana_editor_archivos" data-toggle="tooltip" data-placement="bottom" title="<?php echo $MULTILANG_PCODER_EditorArchivos; ?>" OnClick="$('#pestana_editor_archivos').attr('href', '#pestana_superior_editores'); $('#pestana_editor_archivos').attr('data-toggle', 'tab');"><i class="fa fa-pencil-square-o fa-fw fa-2x text-danger"></i></a></li>
				<li><a id="pestana_consola" data-toggle="tooltip" data-placement="bottom" title="<?php echo $MULTILANG_PCODER_TerminalRemota; ?>" OnClick="$('#pestana_consola').attr('href', '#pestana_consola_comandos'); $('#pestana_consola').attr('data-toggle', 'tab');"><i class="fa fa-terminal fa-fw fa-2x text-warning"></i></a></li>
				<li><a id="pestana_explorador" data-toggle="tooltip" data-placement="bottom" title="<?php echo $MULTILANG_PCODER_NavegadorEmbebido; ?>" OnClick="$('#pestana_explorador').attr('href', '#pestana_explorador_web'); $('#pestana_explorador').attr('data-toggle', 'tab');"><i class="fa fa-globe fa-fw fa-2x text-info"></i></a></li>
				<li><a id="pestana_diferencias" data-toggle="tooltip" data-placement="bottom" title="<?php echo $MULTILANG_PCODER_HerramientaDiferencias; ?>" OnClick="$('#pestana_diferencias').attr('href', '#pestana_diferencias_archivos'); $('#pestana_diferencias').attr('data-toggle', 'tab');"><i class="fa fa-eye-slash fa-fw fa-2x text-danger"></i></a></li>
				<li><a id="pestana_chat" data-toggle="tooltip" data-html="true" data-placement="bottom" title="<?php echo $MULTILANG_PCODER_ChatDesarrolladores; ?>" OnClick="$('#pestana_chat').attr('href', '#pestana_chat_together'); $('#pestana_chat').attr('data-toggle', 'tab');"><i class="fa fa-comment-o fa-fw fa-2x text-yellow"></i></a></li>
				<li><a id="pestana_estado" data-toggle="tooltip" data-html="true" data-placement="bottom" title="Estado general y bloqueos de archivo <br> General status & file locks" OnClick="PCODER_CargarMarcoEstadoYBloqueos(); $('#pestana_estado').attr('href', '#pestana_estado_general'); $('#pestana_estado').attr('data-toggle', 'tab');"><font color=gray><i class="fa fa-tasks fa-fw fa-2x"></i></font></a></li>
			</ul>

		</div>

	</div>
</div>