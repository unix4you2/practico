<?php
	/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2012-2022
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
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
	 
	            --- TRADUCCION NO OFICIAL DE LA LICENCIA ---

     Esta es una traducción no oficial de la Licencia Pública General de
     GNU al español. No ha sido publicada por la Free Software Foundation
     y no establece los términos jurídicos de distribución del software 
     publicado bajo la GPL 3 de GNU, solo la GPL de GNU original en inglés
     lo hace. De todos modos, esperamos que esta traducción ayude a los
     hispanohablantes a comprender mejor la GPL de GNU:
	 
     Este programa es software libre: puede redistribuirlo y/o modificarlo
     bajo los términos de la Licencia General Pública de GNU publicada por
     la Free Software Foundation, ya sea la versión 3 de la Licencia, o 
     (a su elección) cualquier versión posterior.

     Este programa se distribuye con la esperanza de que sea útil pero SIN
     NINGUNA GARANTÍA; incluso sin la garantía implícita de MERCANTIBILIDAD
     o CALIFICADA PARA UN PROPÓSITO EN PARTICULAR. Vea la Licencia General
     Pública de GNU para más detalles.

     Usted ha debido de recibir una copia de la Licencia General Pública de
     GNU junto con este programa. Si no, vea <http://www.gnu.org/licenses/>
	*/
?>

<div align=center>
	<b>
    <h1><b><?php echo $MULTILANG_Version; ?> <?php include("../inc/version_actual.txt"); ?></b></h1>
    [<?php echo $MULTILANG_BienvenidaInstalacion; ?>]</b><br><br>
    <?php echo $MULTILANG_BienvenidaDescripcion; ?>.
    <hr>
    <b><?php echo $MULTILANG_ResumenLicencia; ?></b>:<br>
    <textarea cols="100" rows="7" class="form-control">
        <?php include("../LICENSE"); ?>
    </textarea>
    <br>
    <?php echo $MULTILANG_AmpliacionLicencia; ?>.
    <br><br>
</div>

<?php
	PCO_AbrirBarraEstado();
	$anterior=$paso-1;
	$siguiente=$paso+1;
	echo '
		<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			<input type="Hidden" name="paso" value="'.$siguiente.'">
			<input type="Hidden" name="Idioma" value="'.$Idioma.'">
            <button onclick="document.continuar.submit();" type="button" class="btn btn-primary navbar-btn">'.$MULTILANG_Continuar.' <i class="fa fa-caret-square-o-right texto-amarillo"></i></button>
		</form>';
	PCO_CerrarBarraEstado();
?>