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

    // MENSAJES DE ERROR
?>

<div id="contenedor_mensajes_error">
	
    <div class="row">
		<div class="col-lg-12">
        <?php 
			if ($PCODER_Mensajes==1)
				{
					echo "<br>";
					//Presenta mensajes de error o informacion
					if ($existencia_ok==0)
						mensaje('<i class="fa fa-exclamation-circle fa-2x"></i> '.$MULTILANG_PCODER_Error.': '.$MULTILANG_PCODER_ErrorExistencia.'. '.$MULTILANG_PCODER_Cargando.'='.$PCODER_archivo, '', '', '', 'alert alert-danger alert-dismissible');
					if ($permisos_ok==0)
						{
							mensaje('<i class="fa fa-warning fa-2x"></i> '.$MULTILANG_PCODER_Error.': '.$MULTILANG_PCODER_ErrorRW.'. '.$MULTILANG_PCODER_Estado.'='.$permisos_encontrados, '', '', '', 'alert alert-warning alert-dismissible');
						}
					if ($editor_ok==0)
						{
							mensaje('<i class="fa fa-exclamation-circle fa-2x"></i> '.$MULTILANG_PCODER_Error.': '.$MULTILANG_PCODER_ErrorNoACE.': '.$PCODER_archivo, '', '', '', 'alert alert-danger alert-dismissible');
							die();
						}
					
				}
        ?>
        </div>
    </div>
    
</div>
