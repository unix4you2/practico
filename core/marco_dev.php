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
	if (@$PCOSESS_LoginUsuario!="admin" || !$PCOSESS_SesionAbierta)
		die();

    echo '<div class="oculto_impresion">';
    //Modal Botones de Desarrollo
    abrir_dialogo_modal("myModalDESARROLLO",$MULTILANG_TitDisenador); ?>

                <table class="table">
                    <tr>
                        <td valign=top><h1><span class="label label-primary">1</span></h1></td>
                        <td align=left valign=top>
                        <?php echo $MULTILANG_DefTablas; ?>: <u><b><?php echo strtoupper($MULTILANG_Basedatos); ?></b></u>
                        <br><?php echo $MULTILANG_DesTablas; ?>
                        </td>
                        <td>
                        <form action="" method="post" name="wzd_1" id="wzd_1" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
                        <input type="hidden" name="PCO_Accion" value="administrar_tablas">
                        </form>
                            <i class="fa fa-table fa-4x fa-border"  onClick="document.wzd_1.submit();"></i>
                        </td>
                    </tr>
                    <tr>
                        <td valign=top><h1><span class="label label-success">2</span></h1></td>
                        <td align=left valign=top>
                        <?php echo $MULTILANG_Disene; ?> <u><b><?php echo strtoupper($MULTILANG_Formularios); ?></b> </u> <?php echo $MULTILANG_DefForms; ?>
                        <br><?php echo $MULTILANG_DesForms; ?>
                        </td>
                        <td>
                            <form action="" method="post" name="wzd_2" id="wzd_2" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
                                <input type="hidden" name="PCO_Accion" value="administrar_formularios">
                            </form>
                                <i class="fa fa-list-alt fa-4x fa-border"  onClick="document.wzd_2.submit();"></i>
                        </td>
                    </tr>
                    <tr>
                        <td valign=top><h1><span class="label label-info">3</span></h1></td>
                        <td align=left valign=top>
                        <?php echo $MULTILANG_Disene; ?> <u><b><?php echo strtoupper($MULTILANG_Informes); ?></b> </u> <?php echo $MULTILANG_DefInformes; ?>
                        <br><?php echo $MULTILANG_DesInformes; ?>
                        </td>
                        <td>
                            <form action="" method="post" name="wzd_3" id="wzd_3" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
                                <input type="hidden" name="PCO_Accion" value="administrar_informes">
                            </form>
                                <i class="fa fa-file-text fa-4x fa-border" onClick="document.wzd_3.submit();"></i>
                        </td>
                    </tr>
                    <tr>
                        <td valign=top><h1><span class="label label-warning">4</span></h1></td>
                        <td align=left valign=top>
                        <?php echo $MULTILANG_Administre; ?> <u><b><?php echo strtoupper($MULTILANG_OpcionesMenu); ?></b> </u> <?php echo $MULTILANG_DefMenus; ?>
                        <br><?php echo $MULTILANG_DesMenus; ?>
                        </td>
                        <td>
                            <form action="" method="post" name="wzd_4" id="wzd_4" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
                                <input type="hidden" name="PCO_Accion" value="administrar_menu">
                            </form>
                            <i class="fa fa-external-link-square fa-4x fa-border " onClick="document.wzd_4.submit();"></i>
                        </td>
                    </tr>
                    <tr>
                        <td valign=top><h1><span class="label label-danger">5</span></h1></td>
                        <td align=left valign=top>
                        <?php echo $MULTILANG_Defina; ?> <u><b><?php echo strtoupper($MULTILANG_UsuariosPermisos); ?></b> </u> <?php echo $MULTILANG_DefUsuarios; ?>
                        <br><?php echo $MULTILANG_DesUsuarios; ?>
                        </td>
                        <td>
                            <form action="" method="post" name="wzd_5" id="wzd_5" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
                                <input type="hidden" name="PCO_Accion" value="listar_usuarios">
                            </form>
                            <i class="fa fa-user fa-4x fa-border " onClick="document.wzd_5.submit();"></i>
                        </td>
                    </tr>

                </table>

<?php 
    $barra_herramientas_modal='
        <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
    cerrar_dialogo_modal($barra_herramientas_modal);
    echo '</div';
