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
<table width="700" cellspacing=10>
	<tr>
		<td><img src="../img/practico_login.png" border=0 ALT="Logo Practico"></td>
		<td valign=top><font size=2 color=black><br><b>
			<h1><?php echo $MULTILANG_Version; ?> <?php include("../inc/version_actual.txt"); ?></h1>
			[<?php echo $MULTILANG_BienvenidaInstalacion; ?>]</b><br><br>
			<?php echo $MULTILANG_BienvenidaDescripcion; ?>.
		</font></td>
	</tr>
</table>
<hr>
<b><?php echo $MULTILANG_ResumenLicencia; ?></b>:<br>
<textarea cols="100" rows="7" class="AreaTexto">
	<?php include("../LICENSE"); ?>
</textarea>
<br><br>
<?php echo $MULTILANG_AmpliacionLicencia; ?>.
<br><br>
</div>

<?php
	abrir_barra_estado();
	$anterior=$paso-1;
	$siguiente=$paso+1;
	echo '
		<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			<input type="Hidden" name="paso" value="'.$siguiente.'">
			<input type="Hidden" name="Idioma" value="'.$Idioma.'">
			<input type="Submit" class="BotonesEstadoCuidado" value=" '.$MULTILANG_Continuar.' >>> ">
		</form>';
	cerrar_barra_estado();
?>
