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
	
	PCODER_AbrirDialogoModal("myModalPREFERENCIAS",$MULTILANG_PCODER_Preferencias); ?>

			<div class="row">
				<div class="col-lg-6">
						<label for="tamano_fuente"><?php echo $MULTILANG_PCODER_TamanoFuente; ?></label>
						<select id="tamano_fuente" size="1" class="form-control btn-warning" onchange="CambiarFuenteEditor(this.value)">
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
				</div>
				<div class="col-lg-6">
						<label for="tema_grafico"><?php echo $MULTILANG_PCODER_AparienciaEditor; ?></label>
						<select id="tema_grafico" size="1" class="form-control btn-primary" onchange="CambiarTemaEditor(this.value)">
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
									{
										$EstadoSeleccionTema="";
										if ($PCODER_TemasOscuros[$i]["Valor"]=="ambiance")
											$EstadoSeleccionTema=" SELECTED ";
										echo '<option value="ace/theme/'.$PCODER_TemasOscuros[$i]["Valor"].'" '.$EstadoSeleccionTema.'>'.$PCODER_TemasOscuros[$i]["Nombre"].'</option>';
									}
							  ?>
						  </optgroup>
						</select>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-6">
						<label for="modo_archivo_preferencias"><?php echo $MULTILANG_PCODER_LenguajeProg; ?></label>
						<select id="modo_archivo_preferencias" size="1" class="form-control btn-info" onchange="CambiarModoEditor(this.value)">
							  <?php
								//Presenta los lenguajes disponibles
								for ($i=0;$i<count($PCODER_Modos);$i++)
									echo '<option value="ace/mode/'.$PCODER_Modos[$i]["Nombre"].'">'.$PCODER_Modos[$i]["Nombre"].'</option>';
							  ?>
						</select>
				</div>
				<div class="col-lg-6">
						<label for="modo_invisibles"><?php echo $MULTILANG_PCODER_VerCaracteres; ?></label>
						<select id="modo_invisibles" size="1" class="form-control btn-default" onchange="CaracteresInvisiblesEditor(this.value)">
							<option value="0"><?php echo $MULTILANG_PCODER_No; ?></option>
							<option value="1"><?php echo $MULTILANG_PCODER_Si; ?></option>
						</select>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-6">
						<label for="verificacion_sintaxis"><?php echo $MULTILANG_PCODER_RevisarSintaxis; ?></label>
						<select id="verificacion_sintaxis" size="1" class="form-control btn-success" onchange="VerificarSintaxisEditor(this.value)">
							<option value="0"><?php echo $MULTILANG_PCODER_No; ?></option>
							<option value="1"><?php echo $MULTILANG_PCODER_Si; ?></option>
						</select>
				</div>
				<div class="col-lg-6">
					<!--
						<label for="verificacion_autocompletado"><?php echo $MULTILANG_PCODER_RevisarSintaxis; ?></label>
						<select id="verificacion_autocompletado" size="1" class="form-control btn-success" onchange="VerificarAutocompletadoEditor(this.value)">
							<option value="0"><?php echo $MULTILANG_PCODER_No; ?></option>
							<option value="1"><?php echo $MULTILANG_PCODER_Si; ?></option>
						</select>
					-->
				</div>
			</div>
    <?php 
        $barra_herramientas_modal='
        <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_PCODER_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
        PCODER_CerrarDialogoModal($barra_herramientas_modal);