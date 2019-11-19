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
	if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario) || !$PCOSESS_SesionAbierta)
		die();

    echo '<div class="oculto_impresion">';
    //Modal Botones de Desarrollo
    PCO_AbrirDialogoModal("myModalDESARROLLO",$MULTILANG_TitDisenador,"modal-wide"); ?>


		<div class="row">
			<div class="col-md-6">

                <table class="table table-responsive table-hover table-unbordered btn-xs">
                    <tr>
                        <td valign=top><h2><span class="label label-primary">1</span></h2></td>
                        <td align=left valign=top>
                        <?php echo $MULTILANG_DefTablas; ?>: <u><b><?php echo strtoupper($MULTILANG_Basedatos); ?></b></u>
                        <br><?php echo $MULTILANG_DesTablas; ?>
                        </td>
                        <td>
                        <form action="" method="post">
                        <input type="hidden" name="PCO_Accion" value="PCO_AdministrarTablas">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-table fa-fw fa-4x"></i></button>
                        </form>
                        </td>
                    </tr>
                    <tr>
                        <td valign=top><h2><span class="label label-success">2</span></h2></td>
                        <td align=left valign=top>
                        <?php echo $MULTILANG_Disene; ?> <u><b><?php echo strtoupper($MULTILANG_Formularios); ?></b> </u> <?php echo $MULTILANG_DefForms; ?>
                        <br><?php echo $MULTILANG_DesForms; ?>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="PCO_Accion" value="PCO_AdministrarFormularios">
								<button type="submit" class="btn btn-success"><i class="fa fa-list-alt fa-fw fa-4x"></i></button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td valign=top><h2><span class="label label-danger">3</span></h2></td>
                        <td align=left valign=top>
                        <?php echo $MULTILANG_Disene; ?> <u><b><?php echo strtoupper($MULTILANG_Informes); ?></b> </u> <?php echo $MULTILANG_DefInformes; ?>
                        <br><?php echo $MULTILANG_DesInformes; ?>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="PCO_Accion" value="PCO_AdministrarInformes">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-file-text fa-fw fa-4x"></i></button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td valign=top><h2><span class="label label-default">4</span></h2></td>
                        <td align=left valign=top>
                        <?php echo $MULTILANG_Administre; ?> <u><b><?php echo strtoupper($MULTILANG_OpcionesMenu); ?></b> </u> <?php echo $MULTILANG_DefMenus; ?>
                        <br><?php echo $MULTILANG_DesMenus; ?>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="PCO_Accion" value="PCOFUNC_AdministrarMenu">
                                <button type="submit" class="btn btn-default"><i class="fa fa-external-link-square fa-fw fa-4x"></i></button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td valign=top><h2><span class="label label-warning">5</span></h2></td>
                        <td align=left valign=top>
                        <?php echo $MULTILANG_Defina; ?> <u><b><?php echo strtoupper($MULTILANG_UsuariosPermisos); ?></b> </u> <?php echo $MULTILANG_DefUsuarios; ?>
                        <br><?php echo $MULTILANG_DesUsuarios; ?>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="PCO_Accion" value="PCO_ListarUsuarios">
                                <button type="button" class="btn btn-warning" onclick="document.PCO_ListarUsuarios.submit();" ><i class="fa fa-user fa-fw fa-4x"></i></button>
                            </form>
                        </td>
                    </tr>
                </table>

			</div>
			<div class="col-md-1">
			</div>
			<div class="col-md-5">
				
				<!--<div align=center><h4>Diseño avanzado</h4></div>-->

				<ul class="nav nav-tabs nav-justified">
				<li class="active"><a href="#avanzada1" data-toggle="tab"><i class="fa fa-cogs fa-fw"></i> <?php echo $MULTILANG_DefAvanzadas; ?></a></li>
				<li><a href="#avanzada2" data-toggle="tab"><i class="fa fa-tachometer fa-fw"></i> <?php echo $MULTILANG_DefMantenimientos; ?></a></li>
				</ul>

				<div class="tab-content">



						<!-- INICIO TAB AVANZADAS 1 -->
						<div class="tab-pane fadein active" id="avanzada1">
							<div class="well btn-xs">
							
								<?php
									$PCO_EnlacePCODER="javascript:PCO_VentanaPopup('mod/pcoder','Pcoder','toolbar=no, location=no, directories=0, directories=no, status=no, location=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, titlebar=no, width=1024, height=700');";
                        			//Verifica si esta o no en modo DEMO para hacer la operacion
                        			if ($PCO_ModoDEMO==1)
									   $PCO_EnlacePCODER="javascript:PCOJS_MostrarMensaje('".$MULTILANG_TitDemo."','".$MULTILANG_MsjDemo."');";
								?>
								<a class="btn btn-primary btn-block" href="<?php echo $PCO_EnlacePCODER; ?>"><i class="fa fa-file-code-o fa-fw"></i> <?php echo $MULTILANG_DefPcoder; ?>: {P}Coder</a>
								
								<!-- Formulario para la carga directa de PMyDB -->
								<form target="_blank" action='mod/pmydb/index.php' method='post' name="PMyDB" style="display:inline;">
									<?php 
										//Establece el motor predefinido para PMyDB segun el establecido en Practico
										if ($MotorBD=="mysql") $MotorPMyDB="server";
										//if ($MotorBD=="") $MotorPMyDB="sqlite";
										if ($MotorBD=="sqlite") $MotorPMyDB="sqlite2";
										if ($MotorBD=="pgsql") $MotorPMyDB="pgsql";
										if ($MotorBD=="oracle") $MotorPMyDB="oracle";
										if ($MotorBD=="mssql" || $MotorBD=="sqlsrv" || $MotorBD=="dblib_mssql") $MotorPMyDB="mssql";
										if ($MotorBD=="fbd") $MotorPMyDB="firebird";
										//if ($MotorBD=="") $MotorPMyDB="simpledb";
										//if ($MotorBD=="") $MotorPMyDB="mongo";
										//if ($MotorBD=="") $MotorPMyDB="elastic";
									?>
									<input type="hidden" name="auth[driver]"	value="<?php echo $MotorPMyDB; ?>">
									<input type="hidden" name="auth[server]"	value="<?php echo $ServidorBD; ?>">
									<input type="hidden" name="auth[username]"	value="<?php echo $UsuarioBD; ?>">
									<input type="hidden" name="auth[password]"	value="<?php echo $PasswordBD; ?>">
									<input type="hidden" name="auth[db]"		value="<?php echo $BaseDatos; ?>">
									<input type="hidden" name="auth[lang]"		value="en">
								</form><br>
								<?php
									$PCO_EnlacePMyDB="javascript:if(confirm('$MULTILANG_ConfirmaPMyDB'))document.PMyDB.submit();";
                        			//Verifica si esta o no en modo DEMO para hacer la operacion
                        			if ($PCO_ModoDEMO==1)
									   $PCO_EnlacePMyDB="javascript:PCOJS_MostrarMensaje('".$MULTILANG_TitDemo."','".$MULTILANG_MsjDemo."');";
								?>
								<a class="btn btn-warning btn-block" href="<?php echo $PCO_EnlacePMyDB; ?>"><i class="fa fa-database fa-fw"></i> <?php echo $MULTILANG_DefPMyDB; ?>: {P}MyDB</a>
                                <br>
                                
								<a class="btn btn-info btn-block" href="javascript:document.PCO_ExplorarTablerosKanban.submit();"><i class="fa fa-thumb-tack fa-fw"></i> <?php echo $MULTILANG_TablerosKanban; ?></a>
                                <br>
                                
								<a class="btn btn-danger btn-block" href="javascript:document.PCO_BugTrackingForm.submit();"><i class="fa fa-bug fa-fw"></i> <?php echo $MULTILANG_BTPanel; ?></a>
                                <br>

								<a class="btn btn-default btn-block" href="javascript:PCO_VentanaPopup('mod/pcoder/mod/pboard','PBoard','toolbar=no, location=no, directories=0, directories=no, status=no, location=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, titlebar=no, width=1024, height=700')"><i class="fa fa-paint-brush fa-fw"></i> Editor gr&aacute;fico y pizarra: {P}Board</a>
								<br>
								
								<a class="btn btn-success btn-block" href="javascript:PCO_VentanaPopup('mod/pcoder/mod/mxgraph/javascript/scripts/grapheditor/www/','PDiagram','toolbar=no, location=no, directories=0, directories=no, status=no, location=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, titlebar=no, width=1024, height=700')"><i class="fa fa-sitemap fa-fw"></i> Editor de diagramas: {P}Diagram</a>

							</div> <!--well-->
						</div>
						<!-- FIN TAB AVANZADAS 1 -->
						
						<!-- INICIO TAB AVANZADAS 2 -->
						<div class="tab-pane fade" id="avanzada2">
							<div class="well btn-xs">

								<a class="btn btn-warning btn-block" OnClick="PCO_VentanaPopup('index.php?PCO_Accion=limpiar_temporales&Presentar_FullScreen=1&Precarga_EstilosBS=1','Mantenimiento','toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=yes, resizable=yes, fullscreen=no, width=700, height=500');"><i class="fa fa-trash fa-fw"></i> <?php echo $MULTILANG_DefLimpiarTemp; ?></a>
								<a class="btn btn-danger btn-block" OnClick="if (confirm('<?php echo $MULTILANG_Confirma; ?>')) { PCO_VentanaPopup('index.php?PCO_Accion=limpiar_backups&Presentar_FullScreen=1&Precarga_EstilosBS=1','Mantenimiento','toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=yes, resizable=yes, fullscreen=no, width=700, height=500'); }"><i class="fa fa-trash fa-fw"></i> <?php echo $MULTILANG_DefLimpiarBackups; ?></a>
								
								<?php
									//Presenta opciones de optimizacion de motor solo para los motores en que aplica
									if($MotorBD=='mysql')
										{
								?>
									<hr>
									<div class="row">
										<div class="col-md-6">
											<a class="btn btn-info btn-block" OnClick="if (confirm('<?php echo $MULTILANG_Confirma; ?>')) { PCO_VentanaPopup('index.php?PCO_Accion=mantenimiento_tablas&PCO_PrefijoTablas=<?php echo $TablasApp; ?>&PCO_TipoOperacion=ANALYZE&Presentar_FullScreen=1&Precarga_EstilosBS=1','Mantenimiento','toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=yes, resizable=yes, fullscreen=no, width=700, height=500'); }"><i class="fa fa-eye fa-fw"></i> <?php echo $MULTILANG_TblAnaliza; ?>: <b><?php echo $MULTILANG_Aplicacion; ?></b></a>
											<a class="btn btn-primary btn-block" OnClick="if (confirm('<?php echo $MULTILANG_Confirma; ?>')) { PCO_VentanaPopup('index.php?PCO_Accion=mantenimiento_tablas&PCO_PrefijoTablas=<?php echo $TablasApp; ?>&PCO_TipoOperacion=OPTIMIZE&Presentar_FullScreen=1&Precarga_EstilosBS=1','Mantenimiento','toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=yes, resizable=yes, fullscreen=no, width=700, height=500'); }"><i class="fa fa-line-chart fa-fw"></i> <?php echo $MULTILANG_TblOptimizar; ?>: <b><?php echo $MULTILANG_Aplicacion; ?></b></a>
											<a class="btn btn-danger btn-block" OnClick="if (confirm('<?php echo $MULTILANG_Confirma; ?>')) { PCO_VentanaPopup('index.php?PCO_Accion=mantenimiento_tablas&PCO_PrefijoTablas=<?php echo $TablasApp; ?>&PCO_TipoOperacion=REPAIR&Presentar_FullScreen=1&Precarga_EstilosBS=1','Mantenimiento','toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=yes, resizable=yes, fullscreen=no, width=700, height=500'); }"><i class="fa fa-wrench fa-fw"></i> <?php echo $MULTILANG_TblReparar; ?>: <b><?php echo $MULTILANG_Aplicacion; ?></b></a>
										</div>
										<div class="col-md-6">
											<a class="btn btn-info btn-block" OnClick="if (confirm('<?php echo $MULTILANG_Confirma; ?>')) { PCO_VentanaPopup('index.php?PCO_Accion=mantenimiento_tablas&PCO_PrefijoTablas=<?php echo $TablasCore; ?>&PCO_TipoOperacion=ANALYZE&Presentar_FullScreen=1&Precarga_EstilosBS=1','Mantenimiento','toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=yes, resizable=yes, fullscreen=no, width=700, height=500'); }"><i class="fa fa-eye fa-fw"></i> <?php echo $MULTILANG_TblAnaliza; ?>: <b><?php echo $NombreRAD; ?></b></a>
											<a class="btn btn-primary btn-block" OnClick="if (confirm('<?php echo $MULTILANG_Confirma; ?>')) { PCO_VentanaPopup('index.php?PCO_Accion=mantenimiento_tablas&PCO_PrefijoTablas=<?php echo $TablasCore; ?>&PCO_TipoOperacion=OPTIMIZE&Presentar_FullScreen=1&Precarga_EstilosBS=1','Mantenimiento','toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=yes, resizable=yes, fullscreen=no, width=700, height=500'); }"><i class="fa fa-line-chart fa-fw"></i> <?php echo $MULTILANG_TblOptimizar; ?>: <b><?php echo $NombreRAD; ?></b></a>
											<a class="btn btn-danger btn-block" OnClick="if (confirm('<?php echo $MULTILANG_Confirma; ?>')) { PCO_VentanaPopup('index.php?PCO_Accion=mantenimiento_tablas&PCO_PrefijoTablas=<?php echo $TablasCore; ?>&PCO_TipoOperacion=REPAIR&Presentar_FullScreen=1&Precarga_EstilosBS=1','Mantenimiento','toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=yes, resizable=yes, fullscreen=no, width=700, height=500'); }"><i class="fa fa-wrench fa-fw"></i> <?php echo $MULTILANG_TblReparar; ?>: <b><?php echo $NombreRAD; ?></b></a>
										</div>
									</div>
								<?php
										} //Fin motores con soporte
								?>

							</div> <!--well-->
						</div>
						<!-- FIN TAB AVANZADAS 2 -->


				</div>
				
			</div>
		</div>






<?php 
    $barra_herramientas_modal='
        <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
    PCO_CerrarDialogoModal($barra_herramientas_modal);
    echo '</div>';