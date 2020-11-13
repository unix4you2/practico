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

    // PREFERENCIAS
	
	PCODER_AbrirDialogoModal("myModalOPERARFS",$MULTILANG_PCODER_OperacionesFS); ?>

			<div class="row">
				<div id="cuadro_entrada_path_operacion_elemento">
					<div class="col-md-12">
						<label for="path_operacion_elemento"><?php echo $MULTILANG_PCODER_Ubicacion; ?>:</label><br>
						<div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-hdd-o fa-fw"></i></span>
						  <input type="text" name="path_operacion_elemento" id="path_operacion_elemento" class="form-control btn-block input-mini btn-xs" readonly>
						</div>
						<br>					
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
						<div id="cuadro_entrada_marco_explorador">
							<label for="marco_explorador_creacionarchivo"><?php echo $MULTILANG_PCODER_Explorar; ?>:</label>					
							<div id="marco_explorador_creacionarchivo" class="explorador_archivos_mini"></div>
						</div>
				</div>
				<div class="col-md-6">
					
						<div id="cuadro_entrada_operacion_fs">
							<label for="operacion_fs"><?php echo $MULTILANG_PCODER_Operacion; ?>:</label>
							<select id="operacion_fs" size="1" class="form-control btn-primary">
								<option value="CrearArchivo"><?php echo $MULTILANG_PCODER_CrearArchivo; ?></option>
								<option value="CrearCarpeta"><?php echo $MULTILANG_PCODER_CrearCarpeta; ?></option>
								<option value="EditarPermisos"><?php echo $MULTILANG_PCODER_EditarPermisos; ?></option>
								<option value="SubirArchivo"><?php echo $MULTILANG_PCODER_SubirArchivo; ?></option>
								<option value="EliminarElemento"><?php echo $MULTILANG_PCODER_EliminarElemento; ?></option>
							</select>
						</div>

						<div id="cuadro_entrada_nombre_elemento">
							<label for="nombre_elemento"><?php echo $MULTILANG_PCODER_Nombre; ?>:</label>
							<input type="text" name="nombre_elemento" id="nombre_elemento" class="form-control btn-block input-mini btn-xs">
						</div>

						<div id="cuadro_entrada_permisos_elemento">
							<label for="permisos_elemento"><?php echo $MULTILANG_PCODER_Permisos; ?> (octal):</label>
							<input type="text" name="permisos_elemento" id="permisos_elemento" class="form-control btn-block input-mini btn-xs">
							<label for="propietario_elemento"><?php echo $MULTILANG_PCODER_Propietario; ?>:</label>
							<input type="text" name="propietario_elemento" id="propietario_elemento" class="form-control btn-block input-mini btn-xs">
						</div>

				</div>
			</div>

    <?php 
        $barra_herramientas_modal='
        <button OnClick="EjecutarOperacionFS();" type="button" class="btn btn-success"><i class="fa fa-check fa-fw"></i> '.$MULTILANG_PCODER_Aceptar.'</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> '.$MULTILANG_PCODER_Cancelar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
        PCODER_CerrarDialogoModal($barra_herramientas_modal);