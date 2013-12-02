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
		<td width=100><img src="../img/practico_login.png" border=0 ALT="Logo Practico" width="116" height="80"></td>
		<td valign=top><font size=2 color=black><br><b>
			[<?php echo $MULTILANG_ConfiguracionGeneral; ?>]</b><br><br>
			<?php echo $MULTILANG_ConfiguracionDescripcion; ?>:
		</font></td>
	</tr>
</table>
<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
<input type="hidden" name="NombreRADNEW" value="Practico">
<input type="hidden" name="PlantillaActivaNEW" value="nomo">
<input type="hidden" name="IdiomaPredeterminadoNEW" value="<?php echo $Idioma; ?>">

<hr>
<font size=2 color=black><br><b>
	[<?php echo $MULTILANG_MotorBD; ?>]</b>
</font>
<table cellspacing=2 width="700">
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				<?php echo $MULTILANG_TipoMotor; ?>
			</font>
		</td>
		<td valign=top width="380">
			<select name="MotorBDNEW" class="Combos" >
				<option value="mysql">MySQL - MariaDB (3.x/4.x/5.x)</option>
				<option value="pgsql">PostgreSQL</option>
				<option value="sqlite">SQLite v2 - SQLite v3</option>
				<option value="sqlsrv">FreeTDS/Microsoft SQL Server: Win32 [max version 2008]</option>
				<option value="mssql">FreeTDS/Microsoft SQL Server: Win32&Linux, [max version 2000]</option>
				<option value="ibm">IBM (DB2)</option>
				<option value="dblib">DBLIB</option>
				<option value="odbc">Microsoft Access (ODBC v3: IBM DB2, unixODBC, Win32 ODBC)</option>
				<option value="oracle">ORACLE (OCI Oracle Call Interface)</option>
				<option value="ifmx">Informix (IBM Informix Dynamic Server)</option>
				<option value="fbd">Firebird (Firebird/Interbase 6)</option>
			</select>
			<a href="#" title="<?php echo $MULTILANG_AyudaTitMotor; ?>" name="<?php echo $MULTILANG_AyudaDesMotor; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				<?php echo $MULTILANG_Servidor; ?>
			</font>
		</td>
		<td valign=top>
			<font size=2 color=black>
			<input type="text" name="ServidorNEW" size="20" class="CampoTexto" class="keyboardInput">
			<?php echo $MULTILANG_Puerto; ?>: <input type="text" name="PuertoBDNEW" size="4" class="CampoTexto" class="keyboardInput"> <?php echo $MULTILANG_PuertoNoPredeterminado; ?>
			</font>
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				<?php echo $MULTILANG_Basedatos; ?>
			</font>
		</td>
		<td valign=top>
			<font size=2 color=black>
			<input type="text" name="BaseDatosNEW" size="20" class="CampoTexto" class="keyboardInput"> 
			<a href="#" title="<?php echo $MULTILANG_AyudaTitBD; ?>" name="<?php echo $MULTILANG_AyudaDesBD; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
			</font>
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				<?php echo $MULTILANG_Usuario; ?>
			</font>
		</td>
		<td valign=top>
			<input type="text" name="UsuarioBDNEW" size="20" class="CampoTexto" class="keyboardInput">
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				<?php echo $MULTILANG_Contrasena; ?>
			</font>
		</td>
		<td valign=top>
			<input type="password" name="PasswordBDNEW" size="20" class="CampoTexto" class="keyboardInput">
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				<?php echo $MULTILANG_PrefijoCore; ?>
			</font>
		</td>
		<td valign=top>
			<input type="text" name="TablasCoreNEW" size="7" value="core_" class="CampoTexto" class="keyboardInput">
			<a href="#" title="<?php echo $MULTILANG_AyudaTitPreCore; ?>" name="<?php echo $MULTILANG_AyudaDesPreCore; ?>"><img src="img/icn_12.gif" border=0 align=absmiddle></a>
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				<?php echo $MULTILANG_PrefijoApp; ?>
			</font>
		</td>
		<td valign=top>
			<input type="text" name="TablasAppNEW" size="7" value="app_" class="CampoTexto" class="keyboardInput">
			<a href="#" title="<?php echo $MULTILANG_AyudaTitPreApp; ?>" name="<?php echo $MULTILANG_AyudaDesPreApp; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				<?php echo $MULTILANG_LlavePaso; ?>
			</font>
		</td>
		<td valign=top>
			<font size=2 color=black>
				<input type="text" name="LlaveDePasoNEW" size="12" value="<?php echo TextoAleatorio(10); ?>" class="CampoTexto" class="keyboardInput">
				(<?php echo $MULTILANG_AyudaLlave; ?>)
			</font>
		</td>
	</tr>
	<tr>
		<td valign=top colspan=2>
			<font size=1 color=darkblue>
				<?php echo $MULTILANG_NotasImportantesInst1; ?>
			</font>
		</td>
	</tr>
</table>
<!--
<hr>
<font size=2 color=black><br><b>
	[Autenticaci&oacute;n de credenciales personalizada]</b>
</font>
-->

<hr>
<font size=2 color=black><br><b>
	[<?php echo $MULTILANG_ParametrosApp; ?>]</b>
</font>
<table cellspacing=2 width="700">
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				<?php echo $MULTILANG_ParamNombreEmpresa; ?>
			</font>
		</td>
		<td valign=top>
			<font size=2 color=black>
			<input type="text" name="NombreCortoEmpresa" size="50" class="CampoTexto" value="">
			<a href="#" title="<?php echo $MULTILANG_AyudaTitNomEmp; ?>" name="<?php echo $MULTILANG_AyudaDesNomEmp; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
			</font>
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				<?php echo $MULTILANG_ParamNombreApp; ?>
			</font>
		</td>
		<td valign=top>
			<font size=2 color=black>
			<input type="text" name="NombreAplicacion" size="50" class="CampoTexto" value="">
			<a href="#" title="<?php echo $MULTILANG_AyudaTitNomApp; ?>" name="<?php echo $MULTILANG_AyudaDesNomApp; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
			</font>
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				<?php echo $MULTILANG_ParamVersionApp; ?>
			</font>
		</td>
		<td valign=top>
			<font size=2 color=black>
			<input type="text" name="VersionAplicacion" size="10" class="CampoTexto" value="1.0">
			</font>
		</td>
	</tr>
	<tr>
		<td valign=top colspan=2>
			<font size=1 color=darkblue>
				<?php echo $MULTILANG_NotasImportantesInst2; ?><br><br>
			</font>
		</td>
	</tr>
</table>

<hr>
<font size=2 color=black><br><b>
	[<?php echo $MULTILANG_ConfiguracionVarias; ?>]</b>
</font>
<table cellspacing=2 width="700">
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				<?php echo $MULTILANG_ZonaHoraria; ?>
			</font>
		</td>
		<td valign=top width="380">
			<select  name="ZonaHorariaNEW" class="Combos">
				<?php
					$archivo_origen="../inc/practico/zonas_horarias.txt";
					$archivo = fopen($archivo_origen, "r");
					//descarta comentario inicial de archivo
					if ($archivo)
						{
							$linea = fgets($archivo, 1024);
							while (!feof($archivo))
								{
									$linea = fgets($archivo, 1024);
									if (trim($linea)=="America/Bogota")
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
			<font size=2 color=black>
				<?php echo $MULTILANG_CaracteresCaptcha; ?>
			</font>
		</td>
		<td valign=top width="380">
			<select name="CaracteresCaptchaNEW" class="Combos" >
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4" selected>4</option>
				<option value="5">5</option>
				<option value="6">6</option>
			</select>
			<a href="#" title="<?php echo $MULTILANG_AyudaTitCaptcha; ?>" name="<?php echo $MULTILANG_AyudaDesCaptcha; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				<?php echo $MULTILANG_ModoDepuracion; ?>
			</font>
		</td>
		<td valign=top width="380">
			<select name="ModoDepuracionNEW" class="Combos" >
				<option value="1"><?php echo $MULTILANG_Encendido; ?></option>
				<option value="0" selected><?php echo $MULTILANG_Apagado; ?></option>
			</select>
			<a href="#" title="<?php echo $MULTILANG_AyudaTitDebug; ?>" name="<?php echo $MULTILANG_AyudaDesDebug; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
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




<br><br>
</div>

<?php
	abrir_barra_estado();

	$anterior=$paso-1;
	$siguiente=$paso+1;

	if ($hay_error)
		{
			echo '<input type="Hidden" name="paso" value="1">
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
	echo '<form name="regresar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			<input type="Hidden" name="paso" value="'.$anterior.'">
			<input type="Hidden" name="Idioma" value="'.$Idioma.'">
			<input type="Button" class="BotonesEstado" value=" <<< '.$MULTILANG_Anterior.' " onclick="document.regresar.submit();">
		  </form>';
	cerrar_barra_estado();
?>

