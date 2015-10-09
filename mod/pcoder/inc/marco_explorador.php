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

    // EXPLORADOR DE ARCHIVOS
	?>
		<div class="" style="margin-left:15px;">
			<select id="path_exploracion_archivos" size="1" class="form-control btn-primary btn-xs" onchange="ExplorarPath()">
				<option value="<?php echo $PCO_PCODER_RaizExploracionArchivos; ?>">     PATH: [<?php echo $PCO_PCODER_RaizExploracionArchivos; ?>] (<?php echo $MULTILANG_PCODER_Predeterminado; ?>)</option>
				<optgroup label="<?php echo $MULTILANG_PCODER_Comunes; ?>">
					<option value=".">[.] <?php echo $MULTILANG_PCODER_Path1Punto; ?></option>
					<option value="../">[../] <?php echo $MULTILANG_PCODER_Path2Punto; ?></option>
					<option value="../../">[../../] <?php echo $MULTILANG_PCODER_Path3Punto; ?></option>
					<option value="../../../">[../../../] <?php echo $MULTILANG_PCODER_Path4Punto; ?></option>
					<option value="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>">[<?php echo $_SERVER['DOCUMENT_ROOT']; ?>] <?php echo $MULTILANG_PCODER_PathFull; ?></option>
				</optgroup>
			</select>
		</div>

        <div id="progreso_marco_explorador">
			<div class="progress">
				<div class="progress-bar progress-bar-striped active progress-bar-warning" role="progressbar" aria-valuenow="100" style="width: 100%">
					<i class="fa fa-circle-o-notch fa-spin"></i> <?php echo $MULTILANG_PCODER_Cargando; ?>
				</div>
			</div>
        </div>
		
        <div id="marco_explorador" class="embed-responsive embed-responsive-4by3" style="height:50vh;">
			<iframe name="iframe_marco_explorador" id="iframe_marco_explorador" class="embed-responsive-item" src="" style=" overflow-x: hidden; overflow-y: hidden;"></iframe>
        </div>

