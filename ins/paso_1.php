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
		<td width=100 valign=top><img src="../img/practico_login.png" border=0 ALT="Logo Practico" width="116" height="80"></td>
		<td valign=top>
			<font size=2 color=black><br>
			<b>[<?php echo $MULTILANG_ChequeoPreprocesador; ?>]</b><br>
			<?php echo $MULTILANG_VistaPreprocesador; ?></b>.
				<table width="100%" cellspacing=10><tr><td valign=top><font size=2 color=black>
					<div align=left>
						<u><?php echo $MULTILANG_CumplirRequisitos; ?>:</u>
						<li><?php echo $MULTILANG_CumplirPDO; ?>
						<li><?php echo $MULTILANG_CumplirDrivers; ?>
						<li><?php echo $MULTILANG_CumplirGD; ?>
					</div>
				</font></td></tr></table>

			
			<hr><b>[<?php echo $MULTILANG_ChequeoDirectorios1; ?>]</b><br>
				<?php echo $MULTILANG_ChequeoDirectorios2; ?>:
			</font>
				<table width="100%" cellspacing=10><tr><td valign=top><font size=2 color=black>
					<div align=left>
						<?php
							$hay_error=0;
							//informar_prueba_escritura("..");
							@informar_prueba_escritura("../bkp",1);
							@informar_prueba_escritura("../core",1);
							//informar_prueba_escritura("../core/configuracion.php",2);
							@informar_prueba_escritura("../tmp",1);
						?>
					</div>
				</font></td></tr></table>
		</td>
	</tr>
</table>

<?php
	if ($hay_error)
		{
			echo $MULTILANG_ErrorEscritura;
		}
?>
<br><br>
</div>

<?php
	abrir_barra_estado();

	$anterior=$paso-1;
	$siguiente=$paso+1;
	echo '<form name="regresar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			<input type="Hidden" name="paso" value="'.$anterior.'">
			<input type="Hidden" name="Idioma" value="'.$Idioma.'">
			<input type="Button" class="BotonesEstado" value=" <<< '.$MULTILANG_Anterior.' " onclick="document.regresar.submit();">
		  </form>';

	echo '<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">';	
	if ($hay_error)
		{
			echo '<input type="Hidden" name="paso" value="'.$paso.'">
				  <input type="Hidden" name="Idioma" value="'.$Idioma.'">
			';
			echo '<input type="Button" class="BotonesEstado" value=" '.$MULTILANG_ProbarNuevamente.' " onclick="document.continuar.submit();">';
		}
	else
		{
			echo '<input type="Hidden" name="paso" value="'.$siguiente.'">
				  <input type="Hidden" name="Idioma" value="'.$Idioma.'">
			';
			echo '<input type="Button" class="BotonesEstadoCuidado" value=" '.$MULTILANG_Continuar.' >>> " onclick="document.continuar.submit();">';
		}
	echo '</form>';

	cerrar_barra_estado();
?>

