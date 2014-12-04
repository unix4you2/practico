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

	/*
		Title: Seccion marco de desarrollo
		Ubicacion *[/core/marco_dev.php]*.  Archivo con los enlaces hacia las herramientas de desarrollo

	Ver tambien:
		<Seccion superior> | <Articulador>
	*/

	//Valida que quien llame este marco tenga permisos suficientes
	if (@$Login_usuario!="admin" || !$Sesion_abierta)
		die();

?>

		<!-- INICIO DE MARCOS POPUP -->
		<div id='BarraFlotanteDesarrollo' class="FormularioPopUps">
			<?php
			abrir_ventana($NombreRAD,'#000000','600'); 
			?>
				<table width="100%" cellspacing=0 cellpadding=0 background="skin/<?php echo $PlantillaActiva; ?>/img/fondo_ventanas1.png"><tr><td>
					<br>
					
					<div align=center>
					<font color=yellow face="Tahoma,Verdana,Arial">
						<font size=5>
							<?php echo $MULTILANG_TitDisenador; ?>
						</font>
						<hr>
						<table width="100%" cellspacing=2 cellpadding=5 style="color:#FFFFFF; font-size:14px;"><tr>
							<td><img src="img/1.png" border=0></td>
							<td align=left valign=top>
								<?php echo $MULTILANG_DefTablas; ?>: <u><b><font color="#FFF022"><?php echo strtoupper($MULTILANG_Basedatos); ?></font></b></u>
								<br><font color=lightgray size=1><?php echo $MULTILANG_DesTablas; ?></font>
							</td>
							<td>
								<form action="" method="post" name="wzd_1" id="wzd_1" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
									<input type="hidden" name="accion" value="administrar_tablas">
								</form>
								<table class="EstiloBotones"><tr><td width="30" height="30" align=center>
									<i class="fa fa-table fa-2x"  onClick="document.wzd_1.submit();"></i>
								</tr></td></table>
							</td>
						</tr>
						<tr><td colspan="3"><hr></td></tr>
						<tr>
							<td><img src="img/2.png" border=0></td>
							<td align=left valign=top >
								<?php echo $MULTILANG_Disene; ?> <u><b><font color="#FFF022"><?php echo strtoupper($MULTILANG_Formularios); ?></font></b></u> <?php echo $MULTILANG_DefForms; ?>
								<br><font color=lightgray size=1><?php echo $MULTILANG_DesForms; ?></font>
							</td>
							<td>
								<form action="" method="post" name="wzd_2" id="wzd_2" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
									<input type="hidden" name="accion" value="administrar_formularios">
								</form>
								<table class="EstiloBotones"><tr><td width="30" height="30" align=center>
									<i class="fa fa-list-alt fa-2x"  onClick="document.wzd_2.submit();"></i>
								</tr></td></table>
							</td>
						</tr>
						<tr><td colspan="3"><hr></td></tr>
						<tr>
							<td><img src="img/3.png" border=0></td>
							<td align=left valign=top >
								<?php echo $MULTILANG_Disene; ?> <u><b><font color="#FFF022"><?php echo strtoupper($MULTILANG_Informes); ?></font></b></u> <?php echo $MULTILANG_DefInformes; ?>
								<br><font color=lightgray size=1><?php echo $MULTILANG_DesInformes; ?></font>
							</td>
							<td>
								<form action="" method="post" name="wzd_3" id="wzd_3" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
									<input type="hidden" name="accion" value="administrar_informes">
								</form>
								<table class="EstiloBotones"><tr><td width="30" height="30" align=center>
									<i class="fa fa-file-text fa-2x" onClick="document.wzd_3.submit();"></i>
								</tr></td></table>
							</td>
						</tr>
						<tr><td colspan="3"><hr></td></tr>
						<tr>
							<td><img src="img/4.png" border=0></td>
							<td align=left valign=top >
								<?php echo $MULTILANG_Administre; ?> <u><b><font color="#FFF022"><?php echo strtoupper($MULTILANG_OpcionesMenu); ?></font></b></u> <?php echo $MULTILANG_DefMenus; ?>
								<br><font color=lightgray size=1><?php echo $MULTILANG_DesMenus; ?></font>
							</td>
							<td>
								<form action="" method="post" name="wzd_4" id="wzd_4" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
									<input type="hidden" name="accion" value="administrar_menu">
								</form>
								<table class="EstiloBotones"><tr><td width="30" height="30" align=center>
									<img src="img/icono_menus.png" onClick="document.wzd_4.submit();" width="20" height="20">
								</tr></td></table>
							</td>
						</tr>
						<tr><td colspan="3"><hr></td></tr>
						<tr>
							<td><img src="img/5.png" border=0></td>
							<td align=left valign=top >
								<?php echo $MULTILANG_Defina; ?> <u><b><font color="#FFF022"><?php echo strtoupper($MULTILANG_UsuariosPermisos); ?></font></b></u> <?php echo $MULTILANG_DefUsuarios; ?>
								<br><font color=lightgray size=1><?php echo $MULTILANG_DesUsuarios; ?></font>
							</td>
							<td>
								<form action="" method="post" name="wzd_5" id="wzd_5" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
									<input type="hidden" name="accion" value="listar_usuarios">
								</form>
								<table class="EstiloBotones"><tr><td width="30" height="30" align=center>
									<img src="img/icono_usuarios.png" onClick="document.wzd_5.submit();" width="20" height="20">
								</tr></td></table>
							</td>
						</tr></table>

					</font>
					</div>
				</td></tr></table> <!-- cierra tabla para el fondo -->
			<?php
			abrir_barra_estado();
				echo '<input type="Button"  class="BotonesEstadoCuidado" value=" <<< '.$MULTILANG_IrEscritorio.' " onClick="OcultarPopUp(\'BarraFlotanteDesarrollo\')">';
			cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>
