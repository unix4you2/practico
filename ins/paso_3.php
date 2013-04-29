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
			[<?php echo $MULTILANG_TitInsPaso3; ?>]</b><br><br>
			<?php echo $MULTILANG_TitDesPaso3; ?>
		</font></td>
	</tr>
</table>
<hr>

<?php
	$hay_error=0;

	// Crea la cadena de salida con la configuracion de practico
	$salida=sprintf("<?php
	\$ServidorBD='%s';
	\$BaseDatos='%s';
	\$UsuarioBD='%s';
	\$PasswordBD='%s';
	\$MotorBD='%s';
	\$PuertoBD='%s';
	\$NombreRAD='Pr&aacute;ctico';
	\$PlantillaActiva='nomo';
	\$ArchivoCORE='';
	\$TablasCore='%s';
	\$TablasApp='%s';
	\$LlaveDePaso='%s';
	\$ModoDepuracion=%s;
	\$ZonaHoraria='%s';
	\$IdiomaPredeterminado='%s';
	\$CaracteresCaptcha=%s;
	\$Auth_TipoMotor='%s';
	\$Auth_TipoEncripcion='%s';
	\$Auth_LDAPServidor='%s';
	\$Auth_LDAPPuerto='%s';
	\$Auth_LDAPDominio='%s';
	\$Auth_LDAPOU='%s';
?>",$Servidor,$BaseDatos,$UsuarioBD,$PasswordBD,$MotorBD,$PuertoBD,$TablasCore,$TablasApp,$LlaveDePaso,$ModoDepuracion,$ZonaHoraria,$Idioma,$CaracteresCaptcha,$Auth_TipoMotor,$Auth_TipoEncripcion,$Auth_LDAPServidor,$Auth_LDAPPuerto,$Auth_LDAPDominio,$Auth_LDAPOU);
	// Escribe el archivo de configuracion
	$archivo_config=fopen("../core/configuracion.php","w");
	if($archivo_config==null)
		{
			$hay_error=1;
			echo $MULTILANG_ErrorEscribirConfig;
		}
	else
		{
			fwrite($archivo_config,$salida,strlen($salida)); 
			fclose($archivo_config);
		}
	
	//Si no hay errores creando el archvio continua con la BD
	if (!$hay_error)
		{
			include("../core/configuracion.php");
			include("../core/conexiones.php");
			if ($hay_error)
				{
					echo $MULTILANG_ErrorConexBD;
				}
		}

	// Si no se encontro ningun error muestra mensaje OK
	if (!$hay_error)
		{
			echo '<table width="700" cellspacing=10><tr><td align=left><font size=2 color=black>
				'.$MULTILANG_InfoPaso3.'
			</td></tr></table>';
		}

?>

<br><br>
</div>

<?php
	abrir_barra_estado();

	$anterior=$paso-1;
	$siguiente=$paso+1;
	echo '<form name="regresar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			<input type="Hidden" name="paso" value="'.$anterior.'">
			<input type="Hidden" name="Idioma" value="'.$Idioma.'">
			<input type="Button" class="BotonesEstado" value=" <<< '.$MULTILANG_Anterior.' " onclick="document.regresar.submit();">
		  </form>';

	if (!$hay_error)
		{
			echo '<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="paso" value="'.$siguiente.'">
				<input type="Hidden" name="aplicar_script_basedatos" value="1">
				<input type="Hidden" name="Idioma" value="'.$Idioma.'">
				<input type="Hidden" name="NombreCortoEmpresa" value="'.$NombreCortoEmpresa.'">
				<input type="Hidden" name="NombreAplicacion" value="'.$NombreAplicacion.'">
				<input type="Hidden" name="VersionAplicacion" value="'.$VersionAplicacion.'">
				<input type="Submit" class="BotonesEstadoCuidado" value=" '.$MULTILANG_BtnAplicarBD.' >>> " onclick="document.continuar.submit();">
				</form>';

			echo '<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="paso" value="'.$siguiente.'">
				<input type="Hidden" name="Idioma" value="'.$Idioma.'">
				<input type="Hidden" name="aplicar_script_basedatos" value="0">
				<input type="Submit" class="BotonesEstadoCuidado" value=" '.$MULTILANG_BtnNoAplicarBD.' >>> "  onclick="document.continuar.submit();">
				</form>';
		}
	cerrar_barra_estado();
?>

