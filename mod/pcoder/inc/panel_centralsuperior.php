<?php
	/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2020
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
    Redistribution and use in source and binary forms, with or without
    modification, are permitted provided that the following conditions are met:
    
    1. Redistributions of source code must retain the above copyright notice, this
       list of conditions and the following disclaimer.
    
    2. Redistributions in binary form must reproduce the above copyright notice,
       this list of conditions and the following disclaimer in the documentation
       and/or other materials provided with the distribution.
    
    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
    AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
    IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
    DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
    FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
    DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
    SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
    CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
    OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
    OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
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