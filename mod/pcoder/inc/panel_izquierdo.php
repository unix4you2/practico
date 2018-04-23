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

    // PANEL IZQUIERDO DEL EDITOR
?>

	<div class="col-md-2" style="margin:0px; padding:0px;" id="panel_izquierdo">
		
		<!-- Boton de ocultacion del panel -->
		<div align="right" id="boton_ocultacion_panel_izquierdo"><a class="btn btn-xs text-danger" Onclick="PCODER_DesactivarPanelIzquierdo();"><i class="fa fa-backward"></i> <?php echo $MULTILANG_PCODER_OcultarPanel; ?></a></div>
		
		<?php
			//Presenta el explorador de archivos del lado del servidor
			include_once ("inc/marco_explorador.php");
		?>


	</div>
