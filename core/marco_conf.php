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
	if (@$Login_usuario!="admin" || !$Sesion_abierta)
		die();

?>


		<!-- INICIO DE MARCOS POPUP -->
		<div id='BarraFlotanteConfiguracion' class="FormularioPopUps">
			<?php
			abrir_ventana($NombreRAD.' - '.$MULTILANG_ConfiguracionGeneral,'#f2f2f2','900'); 
			?>
				<!--<DIV style="DISPLAY: block; OVERFLOW: auto; WIDTH: 800; POSITION: relative; HEIGHT: 400px">-->

					<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
					<input type="hidden" name="accion" value="guardar_configuracion">
					<font size=2 color=black><b>
						[<?php echo $MULTILANG_MotorBD; ?>]</b>
					</font>
					<table cellspacing=0 width="100%" style="font-size:11px; color:000000;">
						<tr>
							<td valign=top align=right>
								<?php echo $MULTILANG_TipoMotor; ?>
							</td>
							<td valign=top width="480">
								<select name="MotorBDNEW" class="Combos" >
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
								<a href="#" title="<?php echo $MULTILANG_AyudaTitMotor; ?>" name="<?php echo $MULTILANG_AyudaDesMotor; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<?php echo $MULTILANG_Servidor; ?>
							</td>
							<td valign=top>
								<input type="text" name="ServidorNEW"  value="<?php echo $ServidorBD; ?>" size="20" class="CampoTexto" class="keyboardInput">
								<?php echo $MULTILANG_Puerto; ?>: <input type="text"  value="<?php echo $PuertoBD; ?>" name="PuertoBDNEW" size="4" class="CampoTexto" class="keyboardInput"> <?php echo $MULTILANG_PuertoNoPredeterminado; ?>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<?php echo $MULTILANG_Basedatos; ?>
							</td>
							<td valign=top>
								<input type="text" name="BaseDatosNEW"  value="<?php echo $BaseDatos; ?>" size="20" class="CampoTexto" class="keyboardInput">
								<a href="#" title="<?php echo $MULTILANG_AyudaTitBD; ?>" name="<?php echo $MULTILANG_AyudaDesBD; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<?php echo $MULTILANG_Usuario; ?>
							</td>
							<td valign=top>
								<input type="text" name="UsuarioBDNEW"  value="<?php echo $UsuarioBD; ?>" size="20" class="CampoTexto" class="keyboardInput">
								<?php echo $MULTILANG_Contrasena; ?>
								<input type="password" name="PasswordBDNEW"  value="<?php echo $PasswordBD; ?>" size="20" class="CampoTexto" class="keyboardInput">
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<?php echo $MULTILANG_PrefijoCore; ?>
							</td>
							<td valign=top>
								<input type="text" name="TablasCoreNEW" size="7"  value="<?php echo $TablasCore; ?>" value="Core_" class="CampoTexto" class="keyboardInput">
								<a href="#" title="<?php echo $MULTILANG_AyudaTitPreCore; ?>" name="<?php echo $MULTILANG_AyudaDesPreCore; ?>"><img src="img/icn_12.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<?php echo $MULTILANG_PrefijoApp; ?>
							</td>
							<td valign=top>
								<input type="text" name="TablasAppNEW" size="7"  value="<?php echo $TablasApp; ?>" value="App_" class="CampoTexto" class="keyboardInput">
								<a href="#" title="<?php echo $MULTILANG_AyudaTitPreApp; ?>" name="<?php echo $MULTILANG_AyudaDesPreApp; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<?php echo $MULTILANG_LlavePaso; ?>
							</td>
							<td valign=top>
								<input type="text" name="LlaveDePasoNEW" size="12" value="<?php echo $LlaveDePaso; ?>" class="CampoTexto" class="keyboardInput">
								(<?php echo $MULTILANG_AyudaLlave; ?>)
							</td>
						</tr>
					</table>

					<hr>
					<font size=2 color=black><b>
						[<?php echo $MULTILANG_ConfiguracionVarias; ?>]</b>
					</font>

					<table cellspacing=0 width="100%" style="font-size:11px; color:000000;">
						<tr>
							<td>
								
								<table cellspacing=0 width="100%" style="font-size:11px; color:000000;">
									<tr>
										<td valign=top align=right>
											<?php echo $MULTILANG_ZonaHoraria; ?>
										</td>
										<td valign=top>
											<select  name="ZonaHorariaNEW" class="Combos">
												<?php
													$archivo_origen="inc/practico/zonas_horarias.txt";
													$archivo = fopen($archivo_origen, "r");
													//descarta comentario inicial de archivo
													if ($archivo)
														{
															$linea = fgets($archivo, 1024);
															while (!feof($archivo))
																{
																	$linea = fgets($archivo, 1024);
																	if (trim($linea)==$ZonaHoraria)
																		echo "<option value='".trim($linea)."' selected>".trim($linea)."</option>";
																	else
																		echo "<option value='".trim($linea)."'>".trim($linea)."</option>";
																}
															fclose($archivo);
														}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td valign=top align=right>
												<?php echo $MULTILANG_IdiomaPredeterminado; ?>
										</td>
										<td valign=top>
											<select name="IdiomaPredeterminadoNEW" class="Combos" >
												<?php
												// Incluye archivos de idioma para ser seleccionados
												$path_idiomas="inc/practico/idiomas/";
												$directorio_idiomas=opendir($path_idiomas);
												$IdiomaPredeterminadoActual=$IdiomaPredeterminado;
												while (($elemento=readdir($directorio_idiomas))!=false)
													{
														//Lo procesa solo si es un archivo diferente del index
														if (!is_dir($path_idiomas.$elemento) && $elemento!="." && $elemento!=".."  && $elemento!="index.html")
															{
																include($path_idiomas.$elemento);
																//Establece espanol como predeterminado
																$seleccion="";
																$valor_opcion=str_replace(".php","",$elemento);
																if ($valor_opcion==$IdiomaPredeterminadoActual) $seleccion="SELECTED";
																//Presenta la opcion
																echo '<option value="'.$valor_opcion.'" '.$seleccion.'>'.$MULTILANG_DescripcionIdioma.' ('.$elemento.')</option>';
															}
													}		
												//Vuelve a cargar el predeterminado actual
												include("inc/practico/idiomas/".$IdiomaPredeterminado.".php");
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td valign=top align=right>
											<?php echo $MULTILANG_CaracteresCaptcha; ?>
										</td>
										<td valign=top>
											<select name="CaracteresCaptchaNEW" class="Combos" >
												<option value="1" <?php if ($CaracteresCaptcha=="1") echo "SELECTED"; ?> >1</option>
												<option value="2" <?php if ($CaracteresCaptcha=="2") echo "SELECTED"; ?> >2</option>
												<option value="3" <?php if ($CaracteresCaptcha=="3") echo "SELECTED"; ?> >3</option>
												<option value="4" <?php if ($CaracteresCaptcha=="4") echo "SELECTED"; ?> >4</option>
												<option value="5" <?php if ($CaracteresCaptcha=="5") echo "SELECTED"; ?> >5</option>
												<option value="6" <?php if ($CaracteresCaptcha=="6") echo "SELECTED"; ?> >6</option>
											</select>
											<a href="#" title="<?php echo $MULTILANG_AyudaTitCaptcha; ?>" name="<?php echo $MULTILANG_AyudaDesCaptcha; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
										</td>
									</tr>
									<tr>
										<td valign=top align=right>
											<?php echo $MULTILANG_ModoDepuracion; ?>
										</td>
										<td valign=top>
											<select name="ModoDepuracionNEW" class="Combos" >
												<option value="1" <?php if ($ModoDepuracion=="1") echo "SELECTED"; ?> ><?php echo $MULTILANG_Encendido; ?></option>
												<option value="0" <?php if ($ModoDepuracion=="0") echo "SELECTED"; ?> ><?php echo $MULTILANG_Apagado; ?></option>
											</select>
											<a href="#" title="<?php echo $MULTILANG_AyudaTitDebug; ?>" name="<?php echo $MULTILANG_AyudaDesDebug; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
										</td>
									</tr>
									<tr>
										<td valign=top align=right>
											<?php echo $MULTILANG_BuscarActual; ?>
										</td>
										<td valign=top>
											<select name="BuscarActualizacionesNEW" class="Combos" >
												<option value="1" <?php if (@$BuscarActualizaciones=="1") echo "SELECTED"; ?> ><?php echo $MULTILANG_Encendido; ?></option>
												<option value="0" <?php if (@$BuscarActualizaciones=="0") echo "SELECTED"; ?> ><?php echo $MULTILANG_Apagado; ?></option>
											</select>
											<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_DescActual; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
										</td>
									</tr>
									<tr>
										<td valign=top align=right>
												<?php echo $MULTILANG_NombreRAD; ?>
										</td>
										<td valign=top>
												<input type="text" name="NombreRADNEW" size="12" value="<?php echo $NombreRAD; ?>" class="CampoTexto" class="keyboardInput">
										</td>
									</tr>

									<tr>
										<td valign=top align=right>
												<?php echo $MULTILANG_IDGABeacon; ?>
										</td>
										<td valign=top>
												<input type="text" name="CodigoGoogleAnalyticsNEW" size="12" value="<?php if (@$CodigoGoogleAnalytics!="") echo $CodigoGoogleAnalytics; ?>" class="CampoTexto" class="keyboardInput">
										</td>
									</tr>
								</table>

							</td>
							<td valign=top>
								
								<table cellspacing=0 width="100%" style="font-size:11px; color:000000;">
									<tr>
										<td valign=top align=right>
											<?php echo $MULTILANG_PlantillaActiva; ?>
										</td>
										<td valign=top>
												<select name="PlantillaActivaNEW" class="Combos"  style="width:200px;" onChange="previa_plantilla.src='skin/'+this.options[this.selectedIndex].value+'/img/fondo.jpg';">
													<?php
													// Incluye archivos de plantilla para ser seleccionados
													$path_plantillas="skin/";
													$directorio_plantillas=opendir($path_plantillas);
													while (($elemento=readdir($directorio_plantillas))!=false)
														{
															//Lo procesa solo si es un directorio
															if (is_dir($path_plantillas.$elemento) && $elemento!="." && $elemento!="..")
																{
																	include($path_plantillas.$elemento.'/index.php');
																	//Establece el seleccionado actualmente como SELECTED
																	$seleccion="";
																	if ($elemento==$PlantillaActiva) $seleccion="SELECTED";
																	//Presenta la opcion
																	echo '<option value="'.$elemento.'" '.$seleccion.'>'.$MULTILANG_NombrePlantilla.' (skin/'.$elemento.')</option>';
																}
														}
													?>
												</select>
												<br><br>
												<img name="previa_plantilla" id="previa_plantilla" src="skin/<?php echo $PlantillaActiva; ?>/img/fondo.jpg" width="130" height="90" />
												<br>
												[<?php echo $MULTILANG_ConfGraficas; ?>]
										</td>
									</tr>
								</table>
								
							</td>
						</tr>
					</table>


					<hr>
					<font size=2 color=black><b>
						[<?php echo $MULTILANG_MotorAuth; ?>]</b>
					</font>
					<table cellspacing=0 align="center" style="font-size:11px; color:000000;">
						<tr>
							<td valign=top align=right>
								<?php echo $MULTILANG_Tipo; ?>
							</td>
							<td valign=top>
								<select  name="Auth_TipoMotorNEW" class="Combos">
									<option value="practico" <?php if ($Auth_TipoMotor=="practico") echo "SELECTED"; ?> ><?php echo $MULTILANG_AuthPractico; ?></option>
									<option value="ldap" <?php if ($Auth_TipoMotor=="ldap") echo "SELECTED"; ?> ><?php echo $MULTILANG_AuthLDAP; ?></option>
								</select>
								<a href="#" title="<?php echo $MULTILANG_Importante; ?>" name="<?php echo $MULTILANG_AyudaDesAuth; ?>"><img src="img/icn_12.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<?php echo $MULTILANG_ProtoTransporte; ?>
							</td>
							<td valign=top>
								<select  name="Auth_ProtoTransporteNEW" class="Combos">
									<option value="" <?php if (@$Auth_ProtoTransporte=="") echo "SELECTED"; ?> ><?php echo $MULTILANG_ProtoTransAUTO; ?></option>
									<option value="http" <?php if (@$Auth_ProtoTransporte=="http") echo "SELECTED"; ?> ><?php echo $MULTILANG_ProtoTransHTTP; ?></option>
									<option value="https" <?php if (@$Auth_ProtoTransporte=="https") echo "SELECTED"; ?> ><?php echo $MULTILANG_ProtoTransHTTPS; ?></option>
								</select>
								<a href="#" title="<?php echo $MULTILANG_Importante; ?>" name="<?php echo $MULTILANG_ProtoDescripcion; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
					</table>
					<hr>


					<table cellspacing=0 cellpadding=10 border=0 align="center" style="font-size:11px; color:000000;">
						<tr>
							<td valign=top align=center>
								<b>[<?php echo $MULTILANG_AuthLDAPTitulo; ?>]</b>
								<table cellspacing=0 width="100%" style="font-size:11px; color:000000;">
									<tr>
										<td valign=top align=right>
											<?php echo $MULTILANG_AlgoritmoCripto; ?>
										</td>
										<td valign=top>
											<select  name="Auth_TipoEncripcionNEW" class="Combos">
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
											<a href="#" title="<?php echo $MULTILANG_AyudaTitCript; ?>" name="<?php echo $MULTILANG_AyudaDesCript; ?>"><img src="img/icn_12.gif" border=0 align=absmiddle></a>
										</td>
									</tr>
									<tr>
										<td valign=top align=right>
											<?php echo $MULTILANG_Servidor; ?>
										</td>
										<td valign=top>
											<input type="text" name="Auth_LDAPServidorNEW" size="20" class="CampoTexto" value="<?php echo $Auth_LDAPServidor; ?>" >
											<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_AyudaDesLdapIP; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
										</td>
									</tr>
									<tr>
										<td valign=top align=right>
											<?php echo $MULTILANG_Puerto; ?>
										</td>
										<td valign=top>
											<input type="text" name="Auth_LDAPPuertoNEW" size="5" class="CampoTexto" value="<?php echo $Auth_LDAPPuerto; ?>" >
										</td>
									</tr>
									<tr>
										<td valign=top align=right>
											<?php echo $MULTILANG_Dominio; ?> (dc=)
										</td>
										<td valign=top>
											<input type="text" name="Auth_LDAPDominioNEW" size="15" class="CampoTexto" value="<?php echo $Auth_LDAPDominio; ?>">
											<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_AyudaDesLdapDominio; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a> (<?php echo $MULTILANG_Opcional; ?>)
										</td>
									</tr>
									<tr>
										<td valign=top align=right>
											<?php echo $MULTILANG_UO; ?> (ou=)
										</td>
										<td valign=top>
											<input type="text" name="Auth_LDAPOUNEW" size="15" class="CampoTexto" value="<?php echo $Auth_LDAPOU; ?>">
											<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_AyudaDesLdapUO; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a> (<?php echo $MULTILANG_Opcional; ?>)
										</td>
									</tr>
								</table>

							</td>
						</tr>
					</table>
					<br>

					</form>
				<!-- </DIV> -->
			<?php
			abrir_barra_estado();
				echo '<input type="Button"  class="BotonesEstadoCuidado" value=" <<< '.$MULTILANG_IrEscritorio.' " onClick="OcultarPopUp(\'BarraFlotanteConfiguracion\')">';
				echo '<input type="Button"  class="BotonesEstado" value=" '.$MULTILANG_ParamApp.' >>> " onClick="OcultarPopUp(\'BarraFlotanteConfiguracion\'); AbrirPopUp(\'BarraFlotanteParametros\');">';
				echo '<input type="Button"  class="BotonesEstado" value=" '.$MULTILANG_WSConfigButt.' >>> " onClick="OcultarPopUp(\'BarraFlotanteConfiguracion\'); AbrirPopUp(\'ConfiguracionWebServices\');">';
				echo '<input type="Button"  class="BotonesEstado" value=" '.$MULTILANG_OauthButt.' >>> " onClick="OcultarPopUp(\'BarraFlotanteConfiguracion\'); AbrirPopUp(\'BarraFlotanteOAuth\');">';
				echo '<input type="Button"  class="BotonesEstado" value=" '.$MULTILANG_Guardar.' >>> " onClick="document.forms.continuar.submit();">';
			cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>
