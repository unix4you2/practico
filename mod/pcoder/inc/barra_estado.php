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
?>

<div id="contenedor_barra_estado">
	
    <div class="well well-sm" style="border:0px; margin:0px; padding:0px; background: #272727;">

				<!-- FORMULARIO IR A -->
				<div style="display:inline;">
					<input type="text" id="linea_salto" size=10 name="linea_salto" class="input-mini btn-xs btn-default" placeholder="<?php echo $MULTILANG_PCODER_SaltarLinea; ?>">
					<button class="btn btn-primary btn-xs" onClick="SaltarALinea();"><?php echo $MULTILANG_PCODER_Ir; ?> <i class="fa fa-arrow-circle-right"></i></button>
				</div>

				<font color="gray">
					
					<!-- LINEAS DEL DOCUMENTO -->
					<div id="NroLineasDocumento" class="btn-xs" style="display:inline;">
						0
					</div>

					<!-- CARACTERES DEL DOCUMENTO -->
					<div id="NroCaracteresDocumento" class="btn-xs" style="display:inline;">
						0
					</div>

					<!-- TIPO DOCUMENTO -->
					<div id="TipoDocumento" class="btn-xs" style="display:inline;">
						0
					</div>

					<!-- TAMANO DEL DOCUMENTO -->
					<div id="TamanoDocumento" class="btn-xs" style="display:inline;">
						0
					</div>

					<!-- FECHA MODIFICACION -->
					<div id="FechaModificadoDocumento" class="btn-xs" style="display:inline;">
						0
					</div>

					<!-- NOMBRE DE ARCHIVO -->
					<font color="white">
					<div id="RutaDocumento" class="btn-xs" style="display:inline;">
						0
					</div>
					</font>

				</font>

    </div>

</div><!-- /.contenedor -->
