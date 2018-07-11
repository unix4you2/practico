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
	

<table  class="table table-unbordered">
	<tr>
		<td width=100 valign=top><img src="../img/practico_login.png" border=0 ALT="Logo Practico" width="116" height="80"></td>
		<td valign=top>
			<b>[<?php echo $MULTILANG_ChequeoPreprocesador; ?>]</b><br>
			<?php echo $MULTILANG_VistaPreprocesador; ?></b>.
				<table class="table table-unbordered"><tr><td valign=top>
					<div align=left>
						<u><?php echo $MULTILANG_CumplirRequisitos; ?>:</u>
						<li><?php echo $MULTILANG_CumplirPDO; ?>
						<li><?php echo $MULTILANG_CumplirDrivers; ?>
						<li><?php echo $MULTILANG_CumplirGD; ?>
					</div>
				</td></tr></table>

			
			<hr><b>[<?php echo $MULTILANG_ChequeoDirectorios1; ?>]</b><br>
				<?php echo $MULTILANG_ChequeoDirectorios2; ?>:<br><br>

                <?php
                    $hay_error=0;
                    //informar_prueba_escritura("..");
                    @informar_prueba_escritura("../bkp",1);
                    @informar_prueba_escritura("../core",1);
                    //informar_prueba_escritura("../core/configuracion.php",2);
                    @informar_prueba_escritura("../tmp",1);
                    @informar_prueba_escritura("../ins",1);
                    @informar_prueba_escritura("../xml",1);
                ?>

		</td>
	</tr>
</table>

<?php
	if ($hay_error)
        PCO_Mensaje('<i class="fa fa-warning fa-2x text-danger texto-blink"></i> ', $MULTILANG_ErrorEscritura, '', '', 'alert alert-danger alert-dismissible');
?>
</div>

<?php
	PCO_AbrirBarraEstado();

	$anterior=$paso-1;
	$siguiente=$paso+1;
	echo '<form name="regresar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			<input type="Hidden" name="paso" value="'.$anterior.'">
			<input type="Hidden" name="Idioma" value="'.$Idioma.'">
            <button onclick="document.regresar.submit();" type="button" class="btn btn-primary navbar-btn"><i class="fa fa-caret-square-o-left texto-amarillo"></i> '.$MULTILANG_Anterior.'</button>
		  </form>';

	echo '<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">';	
	if ($hay_error)
		{
			echo '<input type="Hidden" name="paso" value="'.$paso.'">
				  <input type="Hidden" name="Idioma" value="'.$Idioma.'">
			';
			echo '<button onclick="document.continuar.submit();" type="button" class="btn btn-primary navbar-btn">'.$MULTILANG_ProbarNuevamente.' <i class="fa fa-refresh texto-amarillo"></i></button>';
		}
	else
		{
			echo '<input type="Hidden" name="paso" value="'.$siguiente.'">
				  <input type="Hidden" name="Idioma" value="'.$Idioma.'">
			';
			echo '<button onclick="document.continuar.submit();" type="button" class="btn btn-primary navbar-btn">'.$MULTILANG_Continuar.' <i class="fa fa-caret-square-o-right texto-amarillo"></i></button>';
		}
	echo '</form>';

	PCO_CerrarBarraEstado();
?>