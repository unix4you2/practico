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
		Title: Seccion marco de configuracion
		Ubicacion *[/core/marco_conf.php]*.  Archivo con el panel de configuracion de la herramienta

	Ver tambien:
		<Seccion superior> | <Articulador>
	*/

	//Valida que quien llame este marco tenga permisos suficientes
	if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario) || !$PCOSESS_SesionAbierta)
		die();

?>

    <div class="oculto_impresion">
    <!-- Modal Configuracion -->
    <?php abrir_dialogo_modal("myModalCONFIGURACION",$NombreRAD.' - '.$MULTILANG_ConfiguracionGeneral,"modal-wide oculto_impresion"); ?>

					<form action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
					<input type="hidden" name="PCO_Accion" value="guardar_configuracion">

                        
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#configvarias-tab" data-toggle="tab"><?php echo $MULTILANG_ConfiguracionVarias; ?></a>
                                </li>
                                <li><a href="#basedatos-tab" data-toggle="tab"><?php echo $MULTILANG_MotorBD; ?></a>
                                </li>
                                <li><a href="#motorauth-tab" data-toggle="tab"><?php echo $MULTILANG_MotorAuth; ?></a>
                                </li>
                                <li><a href="#estadophp-tab" data-toggle="tab"><?php echo $MULTILANG_EstadoPHP; ?></a>
                                </li>
                            </ul>

                            <!-- INICIO de las pestanas -->
                            <div class="tab-content">
                                <div class="tab-pane fade" id="basedatos-tab">
                                    <label for="MotorBDNEW"><i class="fa fa-database fa-2x fa-fw"></i> <?php echo $MULTILANG_TipoMotor; ?>:</label>
                                    <div class="form-group input-group">
                                        <select id="MotorBDNEW" name="MotorBDNEW" class="selectpicker" >
                                            <option value="mysql"	 <?php if ($MotorBD=="mysql") echo "SELECTED"; ?> >MySQL - MariaDB (3.x/4.x/5.x)</option>
                                            <option value="pgsql"	 <?php if ($MotorBD=="pgsql") echo "SELECTED"; ?> >PostgreSQL</option>
                                            <option value="sqlite"	 <?php if ($MotorBD=="sqlite") echo "SELECTED"; ?> >SQLite v2 - SQLite v3</option>
                                            <option value="sqlsrv"	 <?php if ($MotorBD=="sqlsrv") echo "SELECTED"; ?> >FreeTDS/Microsoft SQL Server: Win32 [max version 2008]</option>
                                            <option value="mssql"	 <?php if ($MotorBD=="mssql") echo "SELECTED"; ?> >FreeTDS/Microsoft SQL Server: Win32&Linux, [max version 2000]</option>
                                            <option value="ibm"		 <?php if ($MotorBD=="ibm") echo "SELECTED"; ?> >IBM (DB2)</option>
                                            <option value="dblib"	 <?php if ($MotorBD=="dblib") echo "SELECTED"; ?> >DBLIB</option>
                                            <option value="odbc"	 <?php if ($MotorBD=="odbc") echo "SELECTED"; ?> >Microsoft Access (ODBC v3: IBM DB2, unixODBC, Win32 ODBC)</option>
                                            <option value="oracle"	 <?php if ($MotorBD=="oracle") echo "SELECTED"; ?> >ORACLE (OCI Oracle Call Interface)</option>
                                            <option value="ifmx"	 <?php if ($MotorBD=="ifmx") echo "SELECTED"; ?> >Informix (IBM Informix Dynamic Server)</option>
                                            <option value="fbd"		 <?php if ($MotorBD=="fbd") echo "SELECTED"; ?> >Firebird (Firebird/Interbase 6)</option>
                                        </select>
                                        <span class="input-group-addon">
                                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_AyudaTitMotor; ?></b><br><?php echo $MULTILANG_AyudaDesMotor; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>
                                    
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-laptop fa-fw"></i> <?php echo $MULTILANG_Servidor; ?>:
                                        </span>
                                        <input name="ServidorNEW" value="<?php echo $ServidorBD; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <i class="fa fa-plug fa-fw"></i> <?php echo $MULTILANG_Puerto; ?>:
                                        </span>
                                        <input name="PuertoBDNEW" value="<?php echo $PuertoBD; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_PuertoNoPredeterminado; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>
                                    
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-database fa-fw"></i> <?php echo $MULTILANG_Basedatos; ?>:
                                        </span>
                                        <input name="BaseDatosNEW" value="<?php echo $BaseDatos; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_AyudaTitBD; ?></b><br><?php echo $MULTILANG_AyudaDesBD; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                        <span class="input-group-addon">
                                            <i class="fa fa-user fa-fw"></i> <?php echo $MULTILANG_Usuario; ?>:
                                        </span>
                                        <input name="UsuarioBDNEW" value="<?php echo $UsuarioBD; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <i class="fa fa-key fa-fw"></i> <?php echo $MULTILANG_Contrasena; ?>:
                                        </span>
                                        <input name="PasswordBDNEW" value="<?php echo $PasswordBD; ?>" type="password" class="form-control">
                                    </div>
                                    
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_PrefijoCore; ?>:
                                        </span>
                                        <input name="TablasCoreNEW" value="<?php echo $TablasCore; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_AyudaTitPreCore; ?></b><br><?php echo $MULTILANG_AyudaDesPreCore; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw"></i></a>
                                        </span>
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_PrefijoApp; ?>:
                                        </span>
                                        <input name="TablasAppNEW" value="<?php echo $TablasApp; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_AyudaTitPreApp; ?></b><br><?php echo $MULTILANG_AyudaDesPreApp; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>
                                    
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-random fa-fw"></i> <?php echo $MULTILANG_LlavePaso; ?>:
                                        </span>
                                        <input name="LlaveDePasoNEW" value="<?php echo $LlaveDePaso; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_AyudaLlave; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>
                                </div>

                                <div class="tab-pane fade in active" id="configvarias-tab">

									<div class="row">
										<div class="col-md-6">
											
											<label for="ZonaHorariaNEW"><i class="fa fa-globe fa-2x fa-fw"></i> <?php echo $MULTILANG_ZonaHoraria; ?>:</label>
											<div class="form-group input-group">
												<select id="ZonaHorariaNEW" name="ZonaHorariaNEW" class="selectpicker" >
													<?php
														$archivo_origen="inc/practico/zonas_horarias.txt";
														$archivo = fopen($archivo_origen, "r");
														//descarta comentario inicial de archivo
														if ($archivo)
															{
																$PCO_Linea = fgets($archivo, 1024);
																while (!feof($archivo))
																	{
																		$PCO_Linea = fgets($archivo, 1024);
																		if (trim($PCO_Linea)==$ZonaHoraria)
																			echo "<option value='".trim($PCO_Linea)."' selected>".trim($PCO_Linea)."</option>";
																		else
																			echo "<option value='".trim($PCO_Linea)."'>".trim($PCO_Linea)."</option>";
																	}
																fclose($archivo);
															}
													?>
												</select>
											</div>
											
											<label for="CaracteresCaptchaNEW"><i class="fa fa-key fa-2x fa-fw"></i> <?php echo $MULTILANG_CaracteresCaptcha; ?>:</label>
											<div class="form-group input-group">
												<select id="CaracteresCaptchaNEW" name="CaracteresCaptchaNEW" class="selectpicker" >
													<option value="0" <?php if ($CaracteresCaptcha=="0") echo "SELECTED"; ?> >0 (<?php echo $MULTILANG_Deshabilitado." - ".$MULTILANG_NoRecomendado; ?>)</option>
													<option value="1" <?php if ($CaracteresCaptcha=="1") echo "SELECTED"; ?> >1</option>
													<option value="2" <?php if ($CaracteresCaptcha=="2") echo "SELECTED"; ?> >2</option>
													<option value="3" <?php if ($CaracteresCaptcha=="3") echo "SELECTED"; ?> >3</option>
													<option value="4" <?php if ($CaracteresCaptcha=="4") echo "SELECTED"; ?> >4</option>
													<option value="5" <?php if ($CaracteresCaptcha=="5") echo "SELECTED"; ?> >5</option>
													<option value="6" <?php if ($CaracteresCaptcha=="6") echo "SELECTED"; ?> >6</option>
												</select>
												<span class="input-group-addon">
													<a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_AyudaTitCaptcha; ?></b><br><?php echo $MULTILANG_AyudaDesCaptcha; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
												</span>
											</div>

											<label for="Activar_ModuloChatNEW"><i class="fa fa-comments fa-2x fa-fw"></i> <?php echo $MULTILANG_ChatActivar; ?>:</label>
											<div class="form-group input-group">
												<select id="Activar_ModuloChatNEW" name="Activar_ModuloChatNEW" class="selectpicker" >
													<option value="0" <?php if (@$Activar_ModuloChat=="0") echo "SELECTED"; ?> ><?php echo $MULTILANG_No; ?>, <?php echo $MULTILANG_Apagado; ?></option>
													<option value="1" <?php if (@$Activar_ModuloChat=="1") echo "SELECTED"; ?> ><?php echo $MULTILANG_Si; ?>, <?php echo $MULTILANG_ChatTipo1; ?></option>
													<option value="2" <?php if (@$Activar_ModuloChat=="2") echo "SELECTED"; ?> ><?php echo $MULTILANG_Si; ?>, <?php echo $MULTILANG_ChatTipo2; ?></option>
													<option value="3" <?php if (@$Activar_ModuloChat=="3") echo "SELECTED"; ?> ><?php echo $MULTILANG_Si; ?>, <?php echo $MULTILANG_ChatTipo3; ?></option>
													<option value="4" <?php if (@$Activar_ModuloChat=="4") echo "SELECTED"; ?> ><?php echo $MULTILANG_Si; ?>, <?php echo $MULTILANG_ChatTipo4; ?></option>
												</select>
											</div>

											<div class="form-group input-group">
												<span class="input-group-addon">
													<i class="fa fa-tag fa-fw"></i> <?php echo $MULTILANG_NombreRAD; ?>:
												</span>
												<input name="NombreRADNEW" value="<?php echo $NombreRAD; ?>" type="text" class="form-control">
											</div>

											<div class="form-group input-group">
												<span class="input-group-addon">
													<i class="fa fa-text-width fa-fw"></i> <?php echo $MULTILANG_SeparadorCampos; ?>:
												</span>
												<input name="_SeparadorCampos_NEW" value="<?php echo $_SeparadorCampos_; ?>" type="text" class="form-control" readonly>
												<span class="input-group-addon">
													<a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_Ayuda; ?></b><br><?php echo $MULTILANG_SeparadorCamposDes; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
												</span>
											</div>

											<div class="form-group input-group">
												<span class="input-group-addon">
													<i class="fa fa-users fa-fw"></i> <?php echo $MULTILANG_UsuariosAdmin; ?>:
												</span>
												<input name="PCOVAR_AdministradoresNEW" value="<?php echo $PCOVAR_Administradores; ?>" type="text" class="form-control">
												<span class="input-group-addon">
													<a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_Ayuda; ?></b><br><?php echo $MULTILANG_UsuariosAdminDes; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
												</span>
											</div>

										</div>
										<div class="col-md-6">

											<label for="IdiomaPredeterminadoNEW"><i class="fa fa-language fa-fw fa-2x"></i> <?php echo $MULTILANG_IdiomaPredeterminado; ?>:</label>
											<div class="form-group input-group">
												<select id="IdiomaPredeterminadoNEW" name="IdiomaPredeterminadoNEW" class="selectpicker" >
													<?php
													// Incluye archivos de idioma para ser seleccionados
													$path_idiomas="inc/practico/idiomas/";
													$directorio_idiomas=opendir($path_idiomas);
													$IdiomaPredeterminadoActual=$IdiomaPredeterminado;
													while (($PCOVAR_Elemento=readdir($directorio_idiomas))!=false)
														{
															//Lo procesa solo si es un archivo diferente del index
															if (!is_dir($path_idiomas.$PCOVAR_Elemento) && $PCOVAR_Elemento!="." && $PCOVAR_Elemento!=".."  && $PCOVAR_Elemento!="index.html")
																{
																	include($path_idiomas.$PCOVAR_Elemento);
																	//Establece espanol como predeterminado
																	$seleccion="";
																	$valor_opcion=str_replace(".php","",$PCOVAR_Elemento);
																	if ($valor_opcion==$IdiomaPredeterminadoActual) $seleccion="SELECTED";
																	//Presenta la opcion
																	echo '<option value="'.$valor_opcion.'" '.$seleccion.'>'.$MULTILANG_DescripcionIdioma.' ('.$PCOVAR_Elemento.')</option>';
																}
														}		
													//Vuelve a cargar el predeterminado actual
													include("inc/practico/idiomas/".$IdiomaPredeterminado.".php");
													?>
												</select>
											</div>

											<label for="ModoDepuracionNEW"><i class="fa fa-bug fa-2x fa-fw"></i>  <?php echo $MULTILANG_ModoDepuracion; ?>:</label>
											<div class="form-group input-group">
												<select id="ModoDepuracionNEW" name="ModoDepuracionNEW" class="selectpicker" >
													<option value="1" <?php if ($ModoDepuracion=="1") echo "SELECTED"; ?> ><?php echo $MULTILANG_Encendido; ?></option>
													<option value="0" <?php if ($ModoDepuracion=="0") echo "SELECTED"; ?> ><?php echo $MULTILANG_Apagado; ?></option>
												</select>
												<span class="input-group-addon">
													<a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_AyudaTitDebug; ?></b><br><?php echo $MULTILANG_AyudaDesDebug; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
												</span>
											</div>

											<label for="BuscarActualizacionesNEW"><i class="fa fa-upload fa-2x fa-fw"></i> <?php echo $MULTILANG_BuscarActual; ?>:</label>
											<div class="form-group input-group">
												<select id="BuscarActualizacionesNEW" name="BuscarActualizacionesNEW" class="selectpicker" >
													<option value="1" <?php if (@$BuscarActualizaciones=="1") echo "SELECTED"; ?> ><?php echo $MULTILANG_Encendido; ?></option>
													<option value="0" <?php if (@$BuscarActualizaciones=="0") echo "SELECTED"; ?> ><?php echo $MULTILANG_Apagado; ?></option>
												</select>
												<span class="input-group-addon">
													<a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_Ayuda; ?></b><br><?php echo $MULTILANG_DescActual; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
												</span>
											</div>

											<div class="form-group input-group">
												<span class="input-group-addon">
													<i class="fa fa-line-chart fa-fw"></i> <?php echo $MULTILANG_IDGABeacon; ?>:
												</span>
												<input name="CodigoGoogleAnalyticsNEW" value="<?php if (@$CodigoGoogleAnalytics!="") echo $CodigoGoogleAnalytics; ?>" type="text" class="form-control">
												<span class="input-group-addon">
													<a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_Ayuda; ?></b><br><?php echo $MULTILANG_AyudaGABeacon; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
												</span>
											</div>

										</div>
									</div>
                                </div>


                                <div class="tab-pane fade" id="motorauth-tab">

									<div class="row">
										<div class="col-md-6">

											<label for="Auth_TipoMotorNEW"><i class="fa fa-cogs fa-2x fa-fw"></i> <?php echo $MULTILANG_Tipo; ?>:</label>
											<div class="form-group input-group">
												<select id="Auth_TipoMotorNEW" name="Auth_TipoMotorNEW" class="selectpicker" >
													<option value="practico" <?php if ($Auth_TipoMotor=="practico") echo "SELECTED"; ?> ><?php echo $MULTILANG_AuthPractico; ?></option>
													<option value="ldap" <?php if ($Auth_TipoMotor=="ldap") echo "SELECTED"; ?> ><?php echo $MULTILANG_AuthLDAP; ?></option>
													<option value="federado" <?php if ($Auth_TipoMotor=="federado") echo "SELECTED"; ?> ><?php echo $MULTILANG_AuthFederado; ?></option>
												</select>
												<span class="input-group-addon">
													<a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_Importante; ?></b><br><?php echo $MULTILANG_AyudaDesAuth; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
												</span>
											</div>

											<label for="Auth_ProtoTransporteNEW"><i class="fa fa-exchange fa-2x fa-fw"></i> <?php echo $MULTILANG_ProtoTransporte; ?>:</label>
											<div class="form-group input-group">
												<select id="Auth_ProtoTransporteNEW" name="Auth_ProtoTransporteNEW" class="selectpicker" >
													<option value="" <?php if (@$Auth_ProtoTransporte=="") echo "SELECTED"; ?> ><?php echo $MULTILANG_ProtoTransAUTO; ?></option>
													<option value="http" <?php if (@$Auth_ProtoTransporte=="http") echo "SELECTED"; ?> ><?php echo $MULTILANG_ProtoTransHTTP; ?></option>
													<option value="https" <?php if (@$Auth_ProtoTransporte=="https") echo "SELECTED"; ?> ><?php echo $MULTILANG_ProtoTransHTTPS; ?></option>
												</select>
												<span class="input-group-addon">
													<a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_Importante; ?></b><br><?php echo $MULTILANG_ProtoDescripcion; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
												</span>
											</div>

											<label for="Auth_PermitirResteoClavesNEW"><i class="fa fa-key fa-2x fa-fw"></i> <?php echo $MULTILANG_PermitirReseteoClave; ?>:</label>
											<div class="form-group input-group">
												<select id="Auth_PermitirReseteoClavesNEW" name="Auth_PermitirReseteoClavesNEW" class="selectpicker" >
													<option value="1" <?php if (@$Auth_PermitirReseteoClaves=="1") echo "SELECTED"; ?> ><?php echo $MULTILANG_Si; ?></option>
													<option value="0" <?php if (@$Auth_PermitirReseteoClaves=="0") echo "SELECTED"; ?> ><?php echo $MULTILANG_No; ?></option>
												</select>
												<span class="input-group-addon">
													<a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_Ayuda; ?></b><br><?php echo $MULTILANG_DesPermitirReseteoClave; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
												</span>
											</div>

											<label for="Auth_PermitirAutoRegistroNEW"><i class="fa fa-user-plus fa-2x fa-fw"></i> <?php echo $MULTILANG_PermitirAutoRegistro; ?>:</label>
											<div class="form-group input-group">
												<select id="Auth_PermitirAutoRegistroNEW" name="Auth_PermitirAutoRegistroNEW" class="selectpicker" >
													<option value="1" <?php if (@$Auth_PermitirAutoRegistro=="1") echo "SELECTED"; ?> ><?php echo $MULTILANG_Si; ?></option>
													<option value="0" <?php if (@$Auth_PermitirAutoRegistro=="0" || @$Auth_PermitirAutoRegistro=="") echo "SELECTED"; ?> ><?php echo $MULTILANG_No; ?></option>
												</select>
												<span class="input-group-addon">
													<a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_Ayuda; ?></b><br><?php echo $MULTILANG_DesPermitirAutoRegistro; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
												</span>
											</div>

											<div class="form-group input-group">
												<span class="input-group-addon">
													<?php echo $MULTILANG_UsuarioAutoRegistro; ?>
												</span>
												<input name="Auth_PlantillaAutoRegistroNEW" value="<?php echo $Auth_PlantillaAutoRegistro; ?>" type="text" class="form-control">
												<span class="input-group-addon">
													<a  href="#" data-toggle="tooltip" data-html="true"  title="(<?php echo $MULTILANG_Opcional; ?>) <?php echo $MULTILANG_DesUsuarioAutoRegistro; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
												</span>
											</div>

										</div>
										<div class="col-md-6">

											<h4><i class="fa fa-external-link fa-fw fa-2x"></i> [<?php echo $MULTILANG_AuthLDAPTitulo; ?>]</h4>

											<label for="Auth_TipoEncripcionNEW"><i class="fa fa-puzzle-piece fa-fw"></i> <?php echo $MULTILANG_AlgoritmoCripto; ?>:</label>
											<div class="form-group input-group">
												<select id="Auth_TipoEncripcionNEW" name="Auth_TipoEncripcionNEW" class="selectpicker" >
													<option  <?php if ($Auth_TipoEncripcion=="plano") echo "SELECTED"; ?> value="plano">Texto plano/Plain text</option>
													<option  <?php if ($Auth_TipoEncripcion=="md5") echo "SELECTED"; ?> value="md5">MD5</option>
													<option  <?php if ($Auth_TipoEncripcion=="md4") echo "SELECTED"; ?> value="md4">MD4</option>
													<option  <?php if ($Auth_TipoEncripcion=="md2") echo "SELECTED"; ?> value="md2">MD2</option>
													<option  <?php if ($Auth_TipoEncripcion=="sha1") echo "SELECTED"; ?> value="sha1">SHA 1</option>
													<option  <?php if ($Auth_TipoEncripcion=="sha256") echo "SELECTED"; ?> value="sha256">SHA 256</option>
													<option  <?php if ($Auth_TipoEncripcion=="sha384") echo "SELECTED"; ?> value="sha384">SHA 384</option>
													<option  <?php if ($Auth_TipoEncripcion=="sha512") echo "SELECTED"; ?> value="sha512">SHA 512</option>
													<option  <?php if ($Auth_TipoEncripcion=="crc32") echo "SELECTED"; ?> value="crc32">CRC 32</option>
													<option  <?php if ($Auth_TipoEncripcion=="crc32b") echo "SELECTED"; ?> value="crc32b">CRC 32B</option>
													<option  <?php if ($Auth_TipoEncripcion=="adler32") echo "SELECTED"; ?> value="adler32">Adler 32</option>
													<option  <?php if ($Auth_TipoEncripcion=="gost") echo "SELECTED"; ?> value="gost">Gost</option>
													<option  <?php if ($Auth_TipoEncripcion=="whirlpool") echo "SELECTED"; ?> value="whirlpool">Whirlpool</option>
													<option  <?php if ($Auth_TipoEncripcion=="snefru") echo "SELECTED"; ?> value="snefru">Snefru</option>
													<option  <?php if ($Auth_TipoEncripcion=="ripemd128") echo "SELECTED"; ?> value="ripemd128">Ripemd 128</option>
													<option  <?php if ($Auth_TipoEncripcion=="ripemd160") echo "SELECTED"; ?> value="ripemd160">Ripemd 160</option>
													<option  <?php if ($Auth_TipoEncripcion=="ripemd256") echo "SELECTED"; ?> value="ripemd256">Ripemd 256</option>
													<option  <?php if ($Auth_TipoEncripcion=="ripemd320") echo "SELECTED"; ?> value="ripemd320">Ripemd 320</option>
													<option  <?php if ($Auth_TipoEncripcion=="tiger128,3") echo "SELECTED"; ?> value="tiger128,3">Tiger 128,3</option>
													<option  <?php if ($Auth_TipoEncripcion=="tiger128,4") echo "SELECTED"; ?> value="tiger128,4">Tiger 128,4</option>
													<option  <?php if ($Auth_TipoEncripcion=="tiger160,3") echo "SELECTED"; ?> value="tiger160,3">Tiger 160,3</option>
													<option  <?php if ($Auth_TipoEncripcion=="tiger160,4") echo "SELECTED"; ?> value="tiger160,4">Tiger 160,4</option>
													<option  <?php if ($Auth_TipoEncripcion=="tiger192,3") echo "SELECTED"; ?> value="tiger192,3">Tiger 192,3</option>
													<option  <?php if ($Auth_TipoEncripcion=="tiger192,4") echo "SELECTED"; ?> value="tiger192,4">Tiger 192,4</option>
													<option  <?php if ($Auth_TipoEncripcion=="haval128,3") echo "SELECTED"; ?> value="haval128,3">Haval 128,3</option>
													<option  <?php if ($Auth_TipoEncripcion=="haval128,4") echo "SELECTED"; ?> value="haval128,4">Haval 128,4</option>
													<option  <?php if ($Auth_TipoEncripcion=="haval128,5") echo "SELECTED"; ?> value="haval128,5">Haval 128,5</option>
													<option  <?php if ($Auth_TipoEncripcion=="haval160,3") echo "SELECTED"; ?> value="haval160,3">Haval 160,3</option>
													<option  <?php if ($Auth_TipoEncripcion=="haval160,4") echo "SELECTED"; ?> value="haval160,4">Haval 160,4</option>
													<option  <?php if ($Auth_TipoEncripcion=="haval160,5") echo "SELECTED"; ?> value="haval160,5">Haval 160,5</option>
													<option  <?php if ($Auth_TipoEncripcion=="haval192,3") echo "SELECTED"; ?> value="haval192,3">Haval 192,3</option>
													<option  <?php if ($Auth_TipoEncripcion=="haval192,4") echo "SELECTED"; ?> value="haval192,4">Haval 192,4</option>
													<option  <?php if ($Auth_TipoEncripcion=="haval192,5") echo "SELECTED"; ?> value="haval192,5">Haval 192,5</option>
													<option  <?php if ($Auth_TipoEncripcion=="haval224,3") echo "SELECTED"; ?> value="haval224,3">Haval 224,3</option>
													<option  <?php if ($Auth_TipoEncripcion=="haval224,4") echo "SELECTED"; ?> value="haval224,4">Haval 224,4</option>
													<option  <?php if ($Auth_TipoEncripcion=="haval224,5") echo "SELECTED"; ?> value="haval224,5">Haval 224,5</option>
													<option  <?php if ($Auth_TipoEncripcion=="haval256,3") echo "SELECTED"; ?> value="haval256,3">Haval 256,3</option>
													<option  <?php if ($Auth_TipoEncripcion=="haval256,4") echo "SELECTED"; ?> value="haval256,4">Haval 256,4</option>
													<option  <?php if ($Auth_TipoEncripcion=="haval256,5") echo "SELECTED"; ?> value="haval256,5">Haval 256,5</option>
												</select>
												<span class="input-group-addon">
													<a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_AyudaTitCript; ?></b><br><?php echo $MULTILANG_AyudaDesCript; ?>"><i class="fa fa-exclamation-triangle icon-orange fa-fw"></i></a>
												</span>
											</div>

											<div class="form-group input-group">
												<span class="input-group-addon">
													<?php echo $MULTILANG_Servidor; ?>:
												</span>
												<input name="Auth_LDAPServidorNEW" value="<?php echo $Auth_LDAPServidor; ?>" type="text" class="form-control">
												<span class="input-group-addon">
													<a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_AyudaDesLdapIP; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
												</span>
												<span class="input-group-addon">
													<?php echo $MULTILANG_Puerto; ?>:
												</span>
												<input name="Auth_LDAPPuertoNEW" value="<?php echo $Auth_LDAPPuerto; ?>" type="text" class="form-control">
											</div>

											<div class="form-group input-group">
												<span class="input-group-addon">
													<?php echo $MULTILANG_Dominio; ?>: (dc=)
												</span>
												<input name="Auth_LDAPDominioNEW" value="<?php echo $Auth_LDAPDominio; ?>" type="text" class="form-control">
												<span class="input-group-addon">
													<a  href="#" data-toggle="tooltip" data-html="true"  title="(<?php echo $MULTILANG_Opcional; ?>) <?php echo $MULTILANG_AyudaDesLdapDominio; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
												</span>
											</div>

											<div class="form-group input-group">
												<span class="input-group-addon">
													<?php echo $MULTILANG_UO; ?>: (ou=)
												</span>
												<input name="Auth_LDAPOUNEW" value="<?php echo $Auth_LDAPOU; ?>" type="text" class="form-control">
												<span class="input-group-addon">
													<a  href="#" data-toggle="tooltip" data-html="true"  title="(<?php echo $MULTILANG_Opcional; ?>) <?php echo $MULTILANG_AyudaDesLdapUO; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
												</span>
											</div>
										</div>
									</div>




                                </div>


                                <div class="tab-pane fade" id="estadophp-tab" style="HEIGHT:20000px;">
									<br>
										<style type="text/css">
											/*#PCO_phpinfo {}
											#PCO_phpinfo pre {}
											#PCO_phpinfo a:link {}
											#PCO_phpinfo a:hover {}
											#PCO_phpinfo table { border:1px solid #000000; width:90%; box-shadow: 10px 10px 5px #888888;}
											#PCO_phpinfo .center {}
											#PCO_phpinfo .center table {}
											#PCO_phpinfo .center th {text-align:center; background-color:#323232; color:#ffffff;}
											#PCO_phpinfo td, th {padding: 3px; background-color:#cccccc; border:1px solid #000000;}
											#PCO_phpinfo h1 {text-align:center;}
											#PCO_phpinfo h2 {text-align:center;}
											#PCO_phpinfo .p {}
											#PCO_phpinfo .e {}
											#PCO_phpinfo .h {}
											#PCO_phpinfo .v {}
											#PCO_phpinfo .vr {}
											#PCO_phpinfo img {width:0px;heigh:0px; visible:none;}
											#PCO_phpinfo hr {}*/
										</style>
											
											<!-- Nav tabs -->
											<ul class="nav nav-pills btn-xs">
												<li class="active"><a href="#phpINFO_GENERAL-tab" data-toggle="tab"><?php echo $MULTILANG_General; ?></a>
												</li>
												<li><a href="#phpINFO_CONFIGURATION-tab" data-toggle="tab"><?php echo $MULTILANG_Configuracion; ?></a>
												</li>
												<li><a href="#phpINFO_MODULES-tab" data-toggle="tab"><?php echo $MULTILANG_Modulos; ?></a>
												</li>
												<li><a href="#phpINFO_ENVIRONMENT-tab" data-toggle="tab"><?php echo $MULTILANG_Ambiente; ?></a>
												</li>
												<li><a href="#phpINFO_VARIABLES-tab" data-toggle="tab"><?php echo $MULTILANG_Variables; ?></a>
												</li>
												<li><a href="#phpINFO_LICENSE-tab" data-toggle="tab"><?php echo $MULTILANG_Licencia; ?></a>
												</li>
												<li><a href="#phpINFO_CREDITS-tab" data-toggle="tab"><?php echo $MULTILANG_Creditos; ?></a>
												</li>
											</ul>

											<div class="tab-pane fade in active" id="phpINFO_GENERAL-tab">
												<DIV id="PCO_phpinfo" align=center style="background:#FFFFFF; DISPLAY: compact; OVERFLOW: auto; WIDTH: 95%; POSITION: absolute;">
												<br>
												<?php
													ob_start () ;
													phpinfo (INFO_GENERAL) ;
													$pinfo = ob_get_contents () ;
													ob_end_clean () ;
													// the name attribute "module_Zend Optimizer" of an anker-tag is not xhtml valide, so replace it with "module_Zend_Optimizer"
													echo ( str_replace ( "module_Zend Optimizer", "module_Zend_Optimizer", preg_replace ( '%^.*<body>(.*)</body>.*$%ms', '$1', $pinfo ) ) ) ;
												?>
												<br><br><br><br><br>
												</DIV>
											</div>

											<div class="tab-pane fade" id="phpINFO_CONFIGURATION-tab">
												<DIV id="PCO_phpinfo" align=center style="background:#FFFFFF; DISPLAY: compact; OVERFLOW: auto; WIDTH: 95%; POSITION: absolute;">
												<?php
													ob_start () ;
													phpinfo (INFO_CONFIGURATION) ;
													$pinfo = ob_get_contents () ;
													ob_end_clean () ;
													// the name attribute "module_Zend Optimizer" of an anker-tag is not xhtml valide, so replace it with "module_Zend_Optimizer"
													echo ( str_replace ( "module_Zend Optimizer", "module_Zend_Optimizer", preg_replace ( '%^.*<body>(.*)</body>.*$%ms', '$1', $pinfo ) ) ) ;
												?>
												<br><br><br><br><br>
												</DIV>
											</div>

											<div class="tab-pane fade" id="phpINFO_MODULES-tab">
												<DIV id="PCO_phpinfo" align=center style="background:#FFFFFF; DISPLAY: block; OVERFLOW: auto; WIDTH: 95%; POSITION: absolute;">
												<?php
													ob_start () ;
													phpinfo (INFO_MODULES) ;
													$pinfo = ob_get_contents () ;
													ob_end_clean () ;
													// the name attribute "module_Zend Optimizer" of an anker-tag is not xhtml valide, so replace it with "module_Zend_Optimizer"
													echo ( str_replace ( "module_Zend Optimizer", "module_Zend_Optimizer", preg_replace ( '%^.*<body>(.*)</body>.*$%ms', '$1', $pinfo ) ) ) ;
												?>
												<br><br><br><br><br>
												</DIV>
											</div>

											<div class="tab-pane fade" id="phpINFO_ENVIRONMENT-tab">
												<DIV id="PCO_phpinfo" align=center style="background:#FFFFFF; DISPLAY: block; OVERFLOW: auto; WIDTH: 95%; POSITION: absolute;">
												<?php
													ob_start () ;
													phpinfo (INFO_ENVIRONMENT) ;
													$pinfo = ob_get_contents () ;
													ob_end_clean () ;
													// the name attribute "module_Zend Optimizer" of an anker-tag is not xhtml valide, so replace it with "module_Zend_Optimizer"
													echo ( str_replace ( "module_Zend Optimizer", "module_Zend_Optimizer", preg_replace ( '%^.*<body>(.*)</body>.*$%ms', '$1', $pinfo ) ) ) ;
												?>
												<br><br><br><br><br>
												</DIV>
											</div>
											
											<div class="tab-pane fade" id="phpINFO_VARIABLES-tab">
												<DIV id="PCO_phpinfo" align=center style="background:#FFFFFF; DISPLAY: block; OVERFLOW: auto; WIDTH: 95%; POSITION: absolute;">
												<?php
													ob_start () ;
													phpinfo (INFO_VARIABLES) ;
													$pinfo = ob_get_contents () ;
													ob_end_clean () ;
													// the name attribute "module_Zend Optimizer" of an anker-tag is not xhtml valide, so replace it with "module_Zend_Optimizer"
													echo ( str_replace ( "module_Zend Optimizer", "module_Zend_Optimizer", preg_replace ( '%^.*<body>(.*)</body>.*$%ms', '$1', $pinfo ) ) ) ;
												?>
												<br><br><br><br><br>
												</DIV>
											</div>
											
											<div class="tab-pane fade" id="phpINFO_LICENSE-tab">
												<DIV id="PCO_phpinfo" align=center style="background:#FFFFFF; DISPLAY: block; OVERFLOW: auto; WIDTH: 95%; POSITION: absolute;">
												<?php
													ob_start () ;
													phpinfo (INFO_LICENSE) ;
													$pinfo = ob_get_contents () ;
													ob_end_clean () ;
													// the name attribute "module_Zend Optimizer" of an anker-tag is not xhtml valide, so replace it with "module_Zend_Optimizer"
													echo ( str_replace ( "module_Zend Optimizer", "module_Zend_Optimizer", preg_replace ( '%^.*<body>(.*)</body>.*$%ms', '$1', $pinfo ) ) ) ;
												?>
												<br><br><br><br><br>
												</DIV>
											</div>

											<div class="tab-pane fade" id="phpINFO_CREDITS-tab">
												<DIV id="PCO_phpinfo" align=center style="background:#FFFFFF; DISPLAY: block; OVERFLOW: auto; WIDTH: 95%; POSITION: absolute;">
												<?php
													ob_start () ;
													phpinfo (INFO_CREDITS) ;
													$pinfo = ob_get_contents () ;
													ob_end_clean () ;
													// the name attribute "module_Zend Optimizer" of an anker-tag is not xhtml valide, so replace it with "module_Zend_Optimizer"
													echo ( str_replace ( "module_Zend Optimizer", "module_Zend_Optimizer", preg_replace ( '%^.*<body>(.*)</body>.*$%ms', '$1', $pinfo ) ) ) ;
												?>
												<br><br><br><br><br>
												</DIV>
											</div>
                                </div>

                            </div>
                            <!-- FIN de las pestanas -->
    <?php 
        $barra_herramientas_modal='
            <button type="submit" class="btn btn-success">'.$MULTILANG_Guardar.' <i class="fa fa-save"></i></button>
            <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
        cerrar_dialogo_modal($barra_herramientas_modal);
    ?>

    </form>
    </div>
