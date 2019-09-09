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

    // ACERCA DE PCODER
	
    PCODER_AbrirDialogoModal("myModalACERCADEPCODER",$MULTILANG_PCODER_Acerca); ?>
		<div align="center">
			<br><h2><b>{P}Coder </b><i>ver <?php echo $PCO_PCODER_VersionActual; ?></i></h2>
			Practico CODe EditoR<br><br>
			 Powered by <a href="http://www.practico.org/"><i>Practico Framework PHP (www.practico.org)</i></a><hr>

			   <b>Editor de C&oacute;digo en la Nube basado en PHP<br></b>
			   Copyright (C) 2015  John F. Arroyave Guti&eacute;rrez<br><br>
			<?php echo $MULTILANG_PCODER_ResumenLicencia; ?><br>
		</div>
    <?php 
        $barra_herramientas_modal='
        <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_PCODER_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
        PCODER_CerrarDialogoModal($barra_herramientas_modal);