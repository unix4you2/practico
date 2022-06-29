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


    ############################################################################
    ############################################################################
	//Genera dialogo modal para abrir archivos
	global $MULTILANG_PCODER_OperacionesFS,$MULTILANG_PCODER_Ubicacion,$MULTILANG_PCODER_Explorar,$MULTILANG_PCODER_Operacion;
	global $MULTILANG_PCODER_CrearArchivo,$MULTILANG_PCODER_CrearCarpeta,$MULTILANG_PCODER_EditarPermisos,$MULTILANG_PCODER_SubirArchivo,$MULTILANG_PCODER_EliminarElemento;
	global $MULTILANG_PCODER_Nombre,$MULTILANG_PCODER_Permisos,$MULTILANG_PCODER_Propietario,$MULTILANG_PCODER_Aceptar,$MULTILANG_Cancelar,$MULTILANG_Cerrar;
	global $MULTILANG_PCODER_Comunes,$MULTILANG_PCODER_Predeterminado,$MULTILANG_PCODER_PathDisco,$MULTILANG_PCODER_PathFull;

//<iframe width="100%" height=400 src="index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=frm:-34:0&Presentar_FullScreen=1&Precarga_EstilosBS=1&PFE_OcultarMigasPan=0&PFE_VistaBasicaArchivos=1&PFE_VisibleBotonDT=0&PFE_VisibleBotonCargarArchivo=0&PFE_VisibleBotonCargarCloud=0&PFE_VisibleBotonDescargar=0&PFE_ActivarDataTable=0&PFE_VisibleBotonCargarArchivo=0&PFE_VisibleBotonCargarCloud=0&PFE_VisibleBotonDT=0&PFE_OcultarBarraHerramientas=0&PFE_VisibleBotonEliminar=0&PFE_VisibleBotonRenombrar=0&PFE_VisibleBotonPermisos=0&PFE_VisibleBotonNuevoArchivo=0&PFE_VisibleBotonNuevoDirectorio=0&PFE_ActivarCargarEnPcoder=1" frameborder="0" marginheight="0" marginwidth="0">Cargando...</iframe>
	PCO_AbrirDialogoModal("myModalABRIRFS","<b><font color=navy>{P}Coder</font></b> - Abrir/Editar un archivo"); ?>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">


					
				</div>
			</div>
    <?php 
        $barra_herramientas_modal='
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> '.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
        PCO_CerrarDialogoModal($barra_herramientas_modal);

    

    ############################################################################
    ############################################################################
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

                                <script language="JavaScript">
                                    function OperacionFS_AbrirArchivo()
                                    	{
                                    	    //Oculta el cuadro de desarrollo
                                    		$('#myModalDESARROLLO').modal('hide');

                                    		//Presenta el cuadro de dialogo
                                    		$('#myModalABRIRFS').modal('show');
                                    		
                                    		
                                            //Si detecta que se tiene activado el filtro de colores inverso (modo noche) deja el editor en su formato oscuro original revirtiendo el filtro
                                            if ("{$PCO_TransformacionColores}"=="inverso")
                                                $(".modal-backdrop").css("filter","invert(0%)");
                                    	}
                            	</script>

								<?php
									$PCO_EnlacePCODER="javascript:PCO_VentanaPopup('index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=frm:-33:0&Presentar_FullScreen=1&Precarga_EstilosBS=1&PCODER_archivo=inc/practico/PCoder','PcoderNG','toolbar=no, location=no, directories=0, directories=no, status=no, location=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, titlebar=no, width='+screen.width+', height='+screen.height);";
                        			//Verifica si esta o no en modo DEMO para hacer la operacion
                        			if ($PCO_ModoDEMO==1)
									   $PCO_EnlacePCODER="javascript:PCOJS_MostrarMensaje('".$MULTILANG_TitDemo."','".$MULTILANG_MsjDemo."');";
								?>
								<div class="row">
    								<div class="col col-xs-12 col-sm-12 col-md-10 col-lg-10"><a class="btn btn-primary btn-block" href="<?php echo $PCO_EnlacePCODER; ?>"><i class="fa fa-file-code-o fa-fw"></i> <?php echo $MULTILANG_DefPcoder; ?>: {P}Coder</a></div>
    								<!--<div class="col col-xs-12 col-sm-12 col-md-10 col-lg-10"><a class="btn btn-primary btn-block" href="javascript:var LMQTP=OperacionFS_AbrirArchivo();"><i class="fa fa-file-code-o fa-fw"></i> <?php echo $MULTILANG_DefPcoder; ?>: {P}Coder</a></div>-->
    								<div class="col col-xs-12 col-sm-12 col-md-2 col-lg-2"><a data-toggle='tooltip' data-placement='bottom' title='Limpiar almacenamiento local de sesiones de archivo' class="btn btn-info btn-block" href="javascript:localStorage.clear();"><i class="fa fa-trash fa-fw"></i></a></div>
								</div>
								
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

								<a class="btn btn-primary btn-block" href="index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=frm:-32:1"><i class="fa fa-cubes fa-fw"></i> <?php echo $MULTILANG_Modulos.' '.$MULTILANG_Aplicacion; ?></a>
                                <br>

								<a class="btn btn-default btn-block" href="javascript:PCO_VentanaPopup('mod/pcoder/mod/pboard','PBoard','toolbar=no, location=no, directories=0, directories=no, status=no, location=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, titlebar=no, width=1024, height=700')"><i class="fa fa-paint-brush fa-fw"></i> Editor gr&aacute;fico y pizarra: {P}Board</a>
								<br>
								
								<a class="btn btn-success btn-block" href="javascript:PCO_VentanaPopup('inc/mxgraph/javascript/scripts/grapheditor/www/','PDiagram','toolbar=no, location=no, directories=0, directories=no, status=no, location=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, titlebar=no, width=1024, height=700')"><i class="fa fa-sitemap fa-fw"></i> Editor de diagramas: {P}Diagram</a>

							</div> <!--well-->
						</div>
						<!-- FIN TAB AVANZADAS 1 -->
						
						<!-- INICIO TAB AVANZADAS 2 -->
						<div class="tab-pane fade" id="avanzada2">
							<div class="well btn-xs">

								<a class="btn btn-default btn-block" OnClick="PCO_VentanaPopup('index.php?PCO_Accion=PCO_LimpiarCacheSQL&Presentar_FullScreen=1&Precarga_EstilosBS=1','Mantenimiento','toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=yes, resizable=yes, fullscreen=no, width=700, height=500');"><i class="fa fa-database fa-fw"></i> Limpiar cach&eacute; de consultas / Clean Query Cache</a>
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