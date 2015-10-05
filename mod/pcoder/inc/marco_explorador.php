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
	
	abrir_dialogo_modal("NavegadorArchivos",$MULTILANG_PCODER_Explorar.' - '.$MULTILANG_PCODER_CargarArchivo);
	
	?>
        <i class="well well-sm btn-xs btn-block"><?php echo $MULTILANG_PCODER_AyudaExplorador; ?></i>
        <div id="marco_explorador" class="embed-responsive embed-responsive-4by3">
            <?php
                //Presenta el arbol de carpetas.  Ver archivo configuracion.php
				//Valida ademas si se puede abrir cualquier tipo de extension o solo algunas
                if ($PCO_PCODER_ForzarExtensionesConocidas==1)
					echo @php_file_tree($PCO_PCODER_RaizExploracionArchivos, "javascript:PCODER_CargarArchivo('[link]');",$PCO_PCODER_ExtensionesPermitidas);
                else
					echo @php_file_tree($PCO_PCODER_RaizExploracionArchivos, "javascript:PCODER_CargarArchivo('[link]');");
            ?>  
        </div>
<?php 
        $barra_herramientas_modal='
        <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_PCODER_Cancelar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
		cerrar_dialogo_modal($barra_herramientas_modal);

