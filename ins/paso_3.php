<div align=center>
<table width="700" cellspacing=10>
	<tr>
		<td width=100><img src="../img/practico_login.png" border=0 ALT="Logo Practico" width="116" height="80"></td>
		<td valign=top><font size=2 color=black><br><b>
			[Escribiendo configuraci&oacute;n y conectando Base de Datos]</b><br><br>
			Se esta escribiendo el archivo de configuracion.php ubicado en /core con los par&aacute;metros por usted indicados
			y se est&aacute; probando la conexi&oacute;n a la base de datos indicada.
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
		\$VersionRAD='12.05';
		\$PlantillaActiva='nomo';
		\$ArchivoCORE='';
		\$TablasCore='%s';
		\$TablasApp='%s';
		\$MotorTablasApp='MyISAM';
		\$LlaveDePaso='';
	?>",$Servidor,$BaseDatos,$UsuarioBD,$PasswordBD,$MotorBD,$PuertoBD,$TablasCore,$TablasApp);
	// Escribe el archivo de configuracion
	$archivo_config=fopen("../core/configuracion.php","w");
	if($archivo_config==null)
		{
			$hay_error=1;
			echo '<b>Se han encontrado errores al tratar de escribir el archivo de configuraci&oacute;n !!!</b>:<br>Si lo desea una alternativa puede ser cambiar usted mismo los valores por defecto incluidos en el archivo core/configuracion.php';
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
					echo '<b>Se han encontrado errores al conectar con la Base de Datos !!!</b>:<br>Verifique los valores ingresados en el paso anterior e intente nuevamente.';
				}
			
		}

	// Si no se encontro ningun error muestra mensaje OK
	if (!$hay_error)
		{
			echo '
			<table width="700" cellspacing=10><tr><td align=left><font size=2 color=black>
				<b>Todo parace estar bien con su configuraci&oacute;n b&aacute;sica de PDO.</b><br>El ultimo paso consiste en indicar al asistente de instalaci&oacute;n como tratar su base de datos:<br><br>
				<li><b>1.</b> Agregar datos de inicio a la base de datos, esto incluye el usuario inicial (admin), menues y dem&aacute;s registros sobre las tablas Core de Pr&aacute;ctico.  Esta es la mejor opci&oacute;n para las instalaciones nuevas.
				<li><b>2.</b> Dejar la base de datos como est&aacute;, lo que indica que no debe ser ejecutada ninguna operaci&oacute;n sobre la base de datos.  Esta opci&oacute;n es &uacute;til cuando se intenta hacer una instalaci&oacute;n sobre una base de datos existente que contiene aplicaciones dise&ntilde;adas y usuarios activos.  Tambi&eacute;n puede entenderse como una base de datos en blanco para instalaciones nuevas que no tendr&aacute; siquiera usuarios para accesar ni opciones para seleccionar.
			</td></tr></table>
			';
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
			<input type="Button" class="BotonesEstado" value=" <<< Anterior " onclick="document.regresar.submit();">
		  </form>';

	if (!$hay_error)
		{
			echo '<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="paso" value="'.$siguiente.'">
				<input type="Hidden" name="aplicar_script_basedatos" value="1">
				<input type="Submit" class="BotonesEstadoCuidado" value=" 1. Agregar info inicial a la BD >>> " onclick="document.continuar.submit();">
				</form>';

			echo '<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="paso" value="'.$siguiente.'">
				<input type="Hidden" name="aplicar_script_basedatos" value="0">
				<input type="Submit" class="BotonesEstadoCuidado" value=" 2. No modificar la BD conectada >>> "  onclick="document.continuar.submit();">
				</form>';
		}

	cerrar_barra_estado();
?>

