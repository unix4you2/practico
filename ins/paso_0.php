<?php
	/*
	Copyright (C) 2013  John F. Arroyave Gutiérrez
						unix4you2@gmail.com

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
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