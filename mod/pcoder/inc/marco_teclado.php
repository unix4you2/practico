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

    // AYUDA DE TECLADO
    PCODER_AbrirDialogoModal("AtajosTeclado",$MULTILANG_PCODER_Ayuda.': <b>'.$MULTILANG_PCODER_AtajosTitPcoder.'</b>',"modal-wide"); ?>
        <DIV style="DISPLAY: block; OVERFLOW: auto; WIDTH: 100%; POSITION: relative; HEIGHT: 400px">
            <?php PCODER_PresentarKeyBindings(); ?>
        </DIV>

    <?php 
        $barra_herramientas_modal='
        <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_PCODER_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
        PCODER_CerrarDialogoModal($barra_herramientas_modal);