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

    // PANEL DERECHO DEL EDITOR
?>
	<div class="col-md-2" style="margin:0px; padding:0px;" id="panel_derecho">
		
		<!-- Boton de ocultacion del panel -->
		<div align="left"><a class="btn btn-xs text-danger" Onclick="PCODER_DesactivarPanelDerecho();"><i class="fa fa-forward"></i> <?php echo $MULTILANG_PCODER_OcultarPanel; ?></a></div>



		<!-- ################# SELECTOR DE COLORES ##################-->
			<br>
			<div id="SelectorColores" align="center" class="alert alert-info" style="margin-right:25px;">
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



	</div>
