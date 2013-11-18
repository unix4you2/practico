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
	Title: Seccion superior
	Ubicacion *[/core/marco_arriba.php]*.  Archivo dedicado a la diagramacion de contenidos en el encabezado de la aplicacion, incluye el menu superior horizontal

	Variables de entrada:

		NombreRAD - Nombre de la aplicacion para encabezado
		PlantillaActiva - Nombre de la plantilla activa para diagramar el sistema
		Login_usuario - Nombre de usuario que se encuentra logueado en el sistema
		Sesion_abierta - Bandera que indica si hay una sesion activa
		ArchivoCORE - Nombre del archivo principal que procesa todas las solicitudes

		(start code)
			if ($Login_usuario!="admin")
				{
					$Complemento_tablas=",".$TablasCore."usuario_menu";
					$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.id AND ".$TablasCore."usuario_menu.usuario='$Login_usuario'";  // AND nivel>0
				}
			SELECT * FROM ".$TablasCore."menu ".$Complemento_tablas." WHERE posible_arriba ".$Complemento_condicion
		(end)

	Salida:
		Encabezado de aplicacion y menu superior disponible para el usuario activo

	Ver tambien:
		<Seccion inferior> | <Articulador>
	*/
?>

<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="generator" content="Practico <?php  $version = file("inc/version_actual.txt"); echo trim($version[0]); ?>" />
	<meta name="description" content="Generador de aplicaciones web - www.codigoabierto.org" />

	<title><?php echo $NombreRAD; ?> <?php echo trim($version[0]); ?></title>

	<script type="text/javascript" src="inc/practico/javascript/tooltips.js"></script>
	<script type="text/javascript" src="inc/practico/javascript/validaform.js"></script>
	<script type="text/javascript" src="inc/practico/javascript/popup.js"></script>
	<script type="text/javascript" src="inc/practico/javascript/calendario.js"></script>
	<script type="text/javascript" src="inc/practico/javascript/tecladovirtual.js"></script>
	<script type="text/javascript" src="inc/practico/javascript/html5slider.js"></script>

	<link rel="stylesheet" type="text/css" href="skin/<?php echo $PlantillaActiva; ?>/general.css">
	<link rel="stylesheet" type="text/css" href="skin/<?php echo $PlantillaActiva; ?>/calendario.css">
	<link rel="stylesheet" type="text/css" href="skin/<?php echo $PlantillaActiva; ?>/tecladovirtual.css">

	<link rel="shortcut icon" href="skin/<?php echo $PlantillaActiva; ?>/img/favicon.ico"/>

	<script language="JavaScript">
		function abrir_ventana_popup(theURL,winName,features)
			{ 
				window.open(theURL,winName,features);
			}
	</script>
</head>
<body leftmargin="0"  margin="0" topmargin="0" oncontextmenu="return false;">
<div id='FondoPopUps' class="FondoOscuroPopUps"></div>


<?php 
	//Despliega marco de administracion a ser activado por el boton superior
	if (@$Login_usuario=="admin" && $Sesion_abierta)
		{
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
									<img src="img/icono_tabla.png" onClick="document.wzd_1.submit();" width="20" height="20">
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
									<img src="img/icono_form.png" onClick="document.wzd_2.submit();" width="20" height="20">
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
									<img src="img/compfile.png" onClick="document.wzd_3.submit();" width="20" height="20">
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
							<td valign=top align=right>
								<?php echo $MULTILANG_ZonaHoraria; ?>
							</td>
							<td valign=top width="480">
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
								<?php echo $MULTILANG_PlantillaActiva; ?>
							</td>
							<td valign=top>
									<select name="PlantillaActivaNEW" class="Combos" >
										<?php
										// Incluye archivos de idioma para ser seleccionados
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
										//Vuelve a cargar el predeterminado actual
										include("inc/practico/idiomas/".$IdiomaPredeterminado.".php");
										?>
									</select>
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
									<option value="oauth2" <?php if ($Auth_TipoMotor=="oauth2") echo "SELECTED"; ?> ><?php echo $MULTILANG_AuthGoogle; ?></option>
								</select>
								<a href="#" title="<?php echo $MULTILANG_Importante; ?>" name="<?php echo $MULTILANG_AyudaDesAuth; ?>"><img src="img/icn_12.gif" border=0 align=absmiddle></a>
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
							<td valign=top  align=center>
								<b>[<?php echo $MULTILANG_AuthGoogleTitulo; ?>]</b>
								<table cellspacing=0 width="100%" style="font-size:11px; color:000000;">
									<tr>
										<td valign=top align=right>
											<?php echo $MULTILANG_AuthGoogleApp; ?>
										</td>
										<td valign=top>
											<input type="text" name="APIGoogle_ApplicationNameNEW" size="30" class="CampoTexto" value="<?php echo $APIGoogle_ApplicationName; ?>" >
										</td>
									</tr>
									<tr>
										<td valign=top align=right>
											<?php echo $MULTILANG_AuthGoogleId; ?>
										</td>
										<td valign=top>
											<input type="text" name="APIGoogle_ClientIdNEW" size="30" class="CampoTexto" value="<?php echo $APIGoogle_ClientId; ?>" >
										</td>
									</tr>
									<tr>
										<td valign=top align=right>
											<?php echo $MULTILANG_AuthGoogleSecret; ?>
										</td>
										<td valign=top>
											<input type="text" name="APIGoogle_ClientSecretNEW" size="30" class="CampoTexto" value="<?php echo $APIGoogle_ClientSecret; ?>" >
										</td>
									</tr>
									<tr>
										<td valign=top align=right>
											<?php echo $MULTILANG_AuthGoogleURI; ?>
										</td>
										<td valign=top>
											<?php
												// Determina si la conexion actual de Practico esta encriptada
												if(empty($_SERVER["HTTPS"]))
													$protocolo_webservice="http://";
												else
													$protocolo_webservice="https://";
												// Construye la URI de retorno para Google
												$prefijo_webservice=$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
												$URIGoogle = $protocolo_webservice.$prefijo_webservice."?WSOn=1&WSId=verificacion_google";
												if ($URIGoogle!=$APIGoogle_RedirectUri)
													echo '<a href="#" title="'.$MULTILANG_Estado.'" name="'.$MULTILANG_GoogleWarnURI.'">'.$MULTILANG_Atencion.'<img src="img/icn_12.gif" border=0 align=absmiddle></a><br>';
											?>
											<input type="text" name="APIGoogle_RedirectUriNEW" size="25" class="CampoTexto" value="<?php echo $APIGoogle_RedirectUri; ?>" readonly>
											<a href="#" title="<?php echo $MULTILANG_GoogleTitURI; ?>" name="<?php echo $MULTILANG_GoogleDesURI; ?>"><img src="img/icn_12.gif" border=0 align=absmiddle></a>
										</td>
									</tr>
									<tr>
										<td valign=top align=right>
											<?php echo $MULTILANG_AuthGoogleKey; ?>
										</td>
										<td valign=top>
											<input type="text" name="APIGoogle_DeveloperKeyNEW" size="30" class="CampoTexto" value="<?php echo $APIGoogle_DeveloperKey; ?>" >
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
				echo '<input type="Button"  class="BotonesEstado" value=" '.$MULTILANG_WSConfigButt.' >>> " onClick="OcultarPopUp(\'BarraFlotanteConfiguracion\'); AbrirPopUp(\'ConfiguracionWebServices\');">';
				echo '<input type="Button"  class="BotonesEstado" value=" '.$MULTILANG_Guardar.' >>> " onClick="document.forms.continuar.submit();">';
			cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>


		<!-- INICIO DE MARCOS POPUP -->
		<div id='ConfiguracionWebServices' class="FormularioPopUps">
			<?php
			abrir_ventana($NombreRAD.' - '.$MULTILANG_ConfiguracionGeneral,'#f2f2f2','500'); 
			?>
				<!--<DIV style="DISPLAY: block; OVERFLOW: auto; WIDTH: 800; POSITION: relative; HEIGHT: 400px">-->

					<form name="configws" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
					<input type="hidden" name="accion" value="guardar_configws">
					<table cellspacing=0 width="100%" style="font-size:11px; color:000000;">
						<tr>
							<td colspan=2 valign=top align=center>
								<br><?php echo $MULTILANG_WSLlavesDefinidas; ?><br><br><?php echo $MULTILANG_WSLlavesAyuda; ?>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<textarea name="llaves_definidas" cols="15" rows="10" class="AreaTexto" onkeypress="return FiltrarTeclas(this, event)"><?php
									// Carga las llaves definidas
									include_once("core/ws_llaves.php");
										for ($r=0;$r<count(@$Auth_WSKeys);$r++)
											echo $Auth_WSKeys[$r]."\n";
									?></textarea>
							</td>
							<td valign=top align=left>
								<?php
									$llave_temp=TextoAleatorio(10);
								?>
								<br>
								<input type="Button" name="bot0" id="bot0" class="Botones" value=" <<< <?php echo $MULTILANG_WSLlavesAgregar.' '.$llave_temp; ?> " onClick="document.forms.configws.llaves_definidas.value+='<?php echo $llave_temp; ?>\n'; bot0.style.visibility='hidden'; alert('<?php echo $MULTILANG_Finalizado?>');" style="visibility:visible; " >
							</td>
						</tr>
					</table>

					</form>
				<!-- </DIV> -->
			<?php
			abrir_barra_estado();
				echo '<input type="Button"  class="BotonesEstadoCuidado" value=" <<< '.$MULTILANG_IrEscritorio.' " onClick="OcultarPopUp(\'ConfiguracionWebServices\')">';
				echo '<input type="Button"  class="BotonesEstado" value=" '.$MULTILANG_Guardar.' >>> " onClick="document.forms.configws.submit();">';
			cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>


<?php 
		} // Finsi para el marco con opciones administrativas
?>


<form action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;" name="core_ver_menu">
	<input type="Hidden" name="accion" value="Ver_menu">
</form>


<!-- INICIA LA TABLA PRINCIPAL -->
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="left">

	<!-- INICIO DEL ENCABEZADO -->
	<tr><td>
		<table width="100%" cellspacing="0" cellpadding="0" border=0 class="MarcoSuperior"><tr>
			<td valign="bottom" width="20%">
				<img src="<?php echo 'skin/'.$PlantillaActiva.'/img/logo.png'; ?>" border="0">
				<?php 
					if ($accion!="Ver_menu" && $Sesion_abierta)
						echo '<a href="javascript:document.core_ver_menu.submit();" title="'.$MULTILANG_IrEscritorio.'"><img src="img/tango_user-desktop.png" width="24" height="24" border=0></a>';
				?>
				<?php 
					//Despliega botones de administracion
					if (@$Login_usuario=="admin" && $Sesion_abierta)
						echo '
						<div id="marco_cluster" style="position: absolute; left: 140px; top: 5px;">
							<input type="button" value="'.$MULTILANG_DesAppBoton.'"  class="BotonesADM" onclick="AbrirPopUp(\'BarraFlotanteDesarrollo\');">
							<input type="button" value="'.$MULTILANG_ConfiguracionGeneral.'"  class="BotonesADM" onclick="AbrirPopUp(\'BarraFlotanteConfiguracion\');">
						</div>';
				?>
			</td>
			<td align="center" valign="middle" width="60%">
				<b>
				<?php
					if ($Sesion_abierta)
						echo '<font color="#d4dce4">'.$Nombre_Empresa_Corto.'</font> - '.$Nombre_Aplicacion.' </b> <i> v'.$Version_Aplicacion.'</i>';
					else
						echo '<font color="#d4dce4">'.$MULTILANG_SubtituloPractico1.'</font> '.$MULTILANG_SubtituloPractico2;
				?>
			</td>
			<td align="right"  width="20%" valign="top">
				<?php
					if ($Sesion_abierta) {
				?>
							<?php echo $Nombre_usuario;?>
							(<font color="#ffff00"><?php 
								for ($i=1;$i<=$Nivel_usuario;$i++)
								echo "&#9733;";
							?></font>)&nbsp;
							<br>
							<input type="Button" class="BotonesEstado" value=" <?php echo $MULTILANG_CerrarSesion; ?> "  OnClick="cerrar_sesion.submit();">&nbsp;
				<?php
					}
				?>
			</td>
		</tr></table>
		<!-- FIN DEL ENCABEZADO -->

		<table width="100%" cellspacing="0" cellpadding="0" border=0 class="MenuSuperior"><tr>
			<td valign="top">
				<?php

					if ($Sesion_abierta && $accion=="Ver_menu") {
						echo '&nbsp;@<b>'.@$Login_usuario.'</b>>&nbsp;&nbsp;&nbsp;';
						// Carga las opciones del menu superior

						// Si el usuario es diferente al administrador agrega condiciones al query
						if ($Login_usuario!="admin")
							{
								$Complemento_tablas=",".$TablasCore."usuario_menu";
								$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.id AND ".$TablasCore."usuario_menu.usuario='$Login_usuario'";  // AND nivel>0
							}
						$resultado=ejecutar_sql("SELECT * FROM ".$TablasCore."menu ".@$Complemento_tablas." WHERE posible_arriba=1 ".@$Complemento_condicion);

						while($registro = $resultado->fetch())
							{
								// Imprime la imagen asociada si esta definida
								if ($registro["imagen"]!="") echo '<img src="img/'.$registro["imagen"].'" border=0 alt="" valign="absmiddle" align="absmiddle" width="14" height="13" >&nbsp;';
								
								// Verifica si se trata de un comando interno y crea formulario y enlace correspondiente
								if ($registro["tipo_comando"]=="Interno")
									{
										echo '<form action="'.$ArchivoCORE.'" method="post" name="top_'.$registro["id"].'" id="top_'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;"><input type="hidden" name="accion" value="'.$registro["comando"].'"></form>';
										echo '<a href="javascript:document.top_'.$registro["id"].'.submit();">'.$registro["texto"].'</a>';
									}

								// Agrega un separador de menu
								echo '<img src="skin/'.$PlantillaActiva.'/img/sep1.gif" border=0 alt="" valign="absmiddle" align="absmiddle" >';
							}
				?>
				<?php 
					}
					else
						echo '<br>';
				?>
			</td>
		</tr></table>
		<form method="POST" name="cerrar_sesion" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			<input type="Hidden" name="accion" value="Terminar_sesion">
		</form>
	</td></tr>

	<!-- INICIO  DE CONTENIDOS DE APLICACION -->


	<!-- INICIO DEL CONTENIDO CENTRAL -->
	<tr><td height="100%" valign="<?php if ($accion=="Ver_menu") echo 'TOP'; else echo 'MIDDLE'; ?>" align="center">
	<!-- INICIO DEL CONTENIDO CENTRAL -->
