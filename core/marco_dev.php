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


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $MULTILANG_TitDisenador; ?></h4>
      </div>
      <div class="modal-body">
            <table class="table">
                <tr>
                    <td><h1><span class="label label-primary">1</span></h1></td>
                    <td align=left valign=top>
                    <?php echo $MULTILANG_DefTablas; ?>: <u><b><?php echo strtoupper($MULTILANG_Basedatos); ?></b></u>
                    <br><?php echo $MULTILANG_DesTablas; ?>
                    </td>
                    <td>
                    <form action="" method="post" name="wzd_1" id="wzd_1" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
                    <input type="hidden" name="accion" value="administrar_tablas">
                    </form>
                        <i class="fa fa-table fa-2x fa-border"  onClick="document.wzd_1.submit();"></i>
                    </td>
                </tr>
            </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




		<!-- INICIO DE MARCOS POPUP -->
		<div id='BarraFlotanteDesarrollo' class="FormularioPopUps">
			<?php
			abrir_ventana($MULTILANG_TitDisenador,'panel-primary'); 
			?>


            
            
				<table width="100%" cellspacing=0 cellpadding=0 background="skin/<?php echo $PlantillaActiva; ?>/img/fondo_ventanas1.png"><tr><td>
					<br>
					
					<div align=center>
					<font color=yellow face="Tahoma,Verdana,Arial">
						<hr>
						<table width="100%" cellspacing=2 cellpadding=5 style="color:#FFFFFF; font-size:14px;"><tr>
							<td><h1><span class="label label-primary">1</span></h1></td>
							<td align=left valign=top>
								<?php echo $MULTILANG_DefTablas; ?>: <u><b><font color="#FFF022"><?php echo strtoupper($MULTILANG_Basedatos); ?></font></b></u>
								<br><font color=lightgray size=1><?php echo $MULTILANG_DesTablas; ?></font>
							</td>
							<td>
								<form action="" method="post" name="wzd_1old" id="wzd_1old" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
									<input type="hidden" name="accion" value="administrar_tablas">
								</form>
                                <i class="fa fa-table fa-2x fa-border"  onClick="document.wzd_1old.submit();"></i>
							</td>
						</tr>
						<tr><td colspan="3"><hr></td></tr>
						<tr>
							<td><h1><span class="label label-success">2</span></h1></td>
							<td align=left valign=top >
								<?php echo $MULTILANG_Disene; ?> <u><b><font color="#FFF022"><?php echo strtoupper($MULTILANG_Formularios); ?></font></b></u> <?php echo $MULTILANG_DefForms; ?>
								<br><font color=lightgray size=1><?php echo $MULTILANG_DesForms; ?></font>
							</td>
							<td>
								<form action="" method="post" name="wzd_2" id="wzd_2" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
									<input type="hidden" name="accion" value="administrar_formularios">
								</form>
									<i class="fa fa-list-alt fa-2x fa-border"  onClick="document.wzd_2.submit();"></i>
							</td>
						</tr>
						<tr><td colspan="3"><hr></td></tr>
						<tr>
							<td><h1><span class="label label-info">3</span></h1></td>
							<td align=left valign=top >
								<?php echo $MULTILANG_Disene; ?> <u><b><font color="#FFF022"><?php echo strtoupper($MULTILANG_Informes); ?></font></b></u> <?php echo $MULTILANG_DefInformes; ?>
								<br><font color=lightgray size=1><?php echo $MULTILANG_DesInformes; ?></font>
							</td>
							<td>
								<form action="" method="post" name="wzd_3" id="wzd_3" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
									<input type="hidden" name="accion" value="administrar_informes">
								</form>
									<i class="fa fa-file-text fa-2x fa-border" onClick="document.wzd_3.submit();"></i>
							</td>
						</tr>
						<tr><td colspan="3"><hr></td></tr>
						<tr>
							<td><h1><span class="label label-warning">4</span></h1></td>
							<td align=left valign=top >
								<?php echo $MULTILANG_Administre; ?> <u><b><font color="#FFF022"><?php echo strtoupper($MULTILANG_OpcionesMenu); ?></font></b></u> <?php echo $MULTILANG_DefMenus; ?>
								<br><font color=lightgray size=1><?php echo $MULTILANG_DesMenus; ?></font>
							</td>
							<td>
								<form action="" method="post" name="wzd_4" id="wzd_4" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
									<input type="hidden" name="accion" value="administrar_menu">
								</form>
                                <i class="fa fa-external-link-square fa-2x fa-border " onClick="document.wzd_4.submit();"></i>
							</td>
						</tr>
						<tr><td colspan="3"><hr></td></tr>
						<tr>
							<td><h1><span class="label label-danger">5</span></h1></td>
							<td align=left valign=top >
								<?php echo $MULTILANG_Defina; ?> <u><b><font color="#FFF022"><?php echo strtoupper($MULTILANG_UsuariosPermisos); ?></font></b></u> <?php echo $MULTILANG_DefUsuarios; ?>
								<br><font color=lightgray size=1><?php echo $MULTILANG_DesUsuarios; ?></font>
							</td>
							<td>
								<form action="" method="post" name="wzd_5" id="wzd_5" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
									<input type="hidden" name="accion" value="listar_usuarios">
								</form>
                                <i class="fa fa-user fa-2x fa-border " onClick="document.wzd_5.submit();"></i>
							</td>
						</tr></table>

					</font>
					</div>
				</td></tr></table> <!-- cierra tabla para el fondo -->
			<?php
			abrir_barra_estado();
				echo '<a class="btn btn-primary btn-xs" href="javascript:OcultarPopUp(\'BarraFlotanteDesarrollo\')"><i class="fa fa-home"></i> '.$MULTILANG_IrEscritorio.'</a>';
			cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>
