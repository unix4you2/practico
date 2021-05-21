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

    // PANEL DERECHO DEL EDITOR
?>
	<div class="col-md-2" style="margin:0px; padding:0px;" id="panel_derecho">
		
		<!-- Boton de ocultacion del panel -->
		<div align="left" id="boton_ocultacion_panel_derecho"><a class="btn btn-xs text-danger" Onclick="PCODER_DesactivarPanelDerecho();"><i class="fa fa-forward"></i> <?php echo $MULTILANG_PCODER_OcultarPanel; ?></a></div>



		<!-- ################# SELECTOR DE COLORES ##################-->
			<br>
			<div id="SelectorColores" align="center" class="alert alert-info btn-xs" style="margin-right:25px;">
				<?php echo $MULTILANG_PCODER_ExploradorColores; ?>:<br>
				<input type="text" id="ValorSelectorColores" class="btn btn-primary btn-xs" value="" placeholder="<?php echo $MULTILANG_PCODER_ClicSeleccionar; ?>"/>
				<style>
					.colorpicker-2x .colorpicker-saturation {
						width: 200px;
						height: 200px;
					}
					.colorpicker-2x .colorpicker-hue,
					.colorpicker-2x .colorpicker-alpha {
						width: 30px;
						height: 200px;
					}
					.colorpicker-2x .colorpicker-color,
					.colorpicker-2x .colorpicker-color div{
						height: 30px;
					}
				</style>
				<script>
					$(function(){
						$('#ValorSelectorColores').colorpicker({
							customClass: 'colorpicker-2x',
							sliders: {
								saturation: {
									maxLeft: 200,
									maxTop: 200
								},
								hue: {
									maxTop: 200
								},
								alpha: {
									maxTop: 200
								}
							}
						});
					});
				</script>
			</div>

		<!-- ################# MINIMAP DE CODIGO ##################-->
	    <div id="HerramientaMinimap" align="center" class="btn-xs alert alert-danger" style="background-color:#000000; margin-right:25px; padding:0x;">
		    <div align="left">
		        &nbsp;&nbsp;&nbsp;<font color=gray><input type="checkbox" id="Check_ActivarMinimap" value="0"> <?php echo $MULTILANG_PCODER_Activar; ?> <?php echo $MULTILANG_PCODER_Minimap; ?></font><br>
		        &nbsp;<a class="btn btn-xs text-info"><i class="fa fa-code"></i> <?php echo $MULTILANG_PCODER_SaltarLinea; ?> <div id="LineaSaltoMinimap" style="display:inline;">1</div>  </a>
		    </div>
            <canvas id="TextoCanvasMinimap" width="100%" height="400" style="width:100%; height:400px; background-color: #333333; border:1px solid #878787; border-radius: 10px; box-shadow: 2px 2px 5px black; margin:0px;">Your browser does not support the HTML5 canvas tag.</canvas>
		</div>

	</div>