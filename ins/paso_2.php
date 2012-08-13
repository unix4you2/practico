<div align=center>
<table width="700" cellspacing=10>
	<tr>
		<td width=100><img src="../img/practico_login.png" border=0 ALT="Logo Practico" width="116" height="80"></td>
		<td valign=top><font size=2 color=black><br><b>
			[Configuraci&oacute;n de Base de Datos]</b><br><br>
			Indique la configuraci&oacute;n deseada para el almacenamiento de aplicaciones e informaci&oacute;n de usuario generada por Pr&aacute;ctico:
		</font></td>
	</tr>
</table>
<hr>
<table cellspacing=10>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				Tipo de motor
			</font>
		</td>
		<td valign=top>
			<select  name="campo" class="Combos" >
				<option value="">Seleccione uno</option>
				<option value="sqlite2">SQLite2</option>
				<option value="sqlite3">SQLite3</option>
				<option value="sqlsrv">Microsoft SQL Server: Win32 [max version 2008]</option>
				<option value="mssql">Microsoft SQL Server: Win32&Linux, [max version 2000]</option>
				<option value="mysql">MySQL</option>
				<option value="pg">PostgreSQL</option>
				<option value="ibm">IBM</option>
				<option value="dblib">DBLIB</option>
				<option value="odbc">Microsoft Access (ODBC)</option>
				<option value="oracle">ORACLE</option>
				<option value="ifmx">Informix</option>
				<option value="fbd">Firebird</option>
			</select>
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				Host/Servidor
			</font>
		</td>
		<td valign=top>
			<input type="text" name="servidor" size="20" class="CampoTexto" class="keyboardInput">
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				Base de datos
			</font>
		</td>
		<td valign=top>
			<input type="text" name="basedatos" size="20" class="CampoTexto" class="keyboardInput">
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				Usuario
			</font>
		</td>
		<td valign=top>
			<input type="text" name="usuario" size="20" class="CampoTexto" class="keyboardInput">
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				Contrase&ntilde;a
			</font>
		</td>
		<td valign=top>
			<input type="password" name="contrasena" size="20" class="CampoTexto" class="keyboardInput">
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				Prefijo tablas internas de Pr&aacute;ctico
			</font>
		</td>
		<td valign=top>
			<input type="text" name="prefijocore" size="7" value="Core_" class="CampoTexto" class="keyboardInput">
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				Prefijo tablas de Aplicaci&oacute;n
			</font>
		</td>
		<td valign=top>
			<input type="text" name="prefijocore" size="7" value="App_" class="CampoTexto" class="keyboardInput">
		</td>
	</tr>

</table>
<?php
	if ($hay_error)
		{
			echo '<b>Se han encontrado errores al tratar de escribir en los directorios de instalaci&oacute;n !!!</b>:<br>Las rutas indicadas deben pertenecer al usuario del webserver que ejecuta los scripts de Pr&aacute;ctico (generalmente apache)<br> y contar con permisos 755 para el caso de carpetas y 644 para los archivos.<br>Una forma r&aacute;pida de actualizar estos permisos puede ser ejecutando desde la raiz de Pr&aacute;ctico los comandos:<li>find . -type d -exec chmod 755 {} \;<li>find . -type f -exec chmod 644 {} \;';
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

	echo '<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">';	
	if ($hay_error)
		{
			echo '<input type="Hidden" name="paso" value="1">';
			echo '<input type="Button" class="BotonesEstado" value=" Probar de nuevo " onclick="document.continuar.submit();">';
		}
	else
		{
			echo '<input type="Hidden" name="paso" value="'.$siguiente.'">';
			echo '<input type="Button" class="BotonesEstadoCuidado" value=" Continuar >>> " onclick="document.continuar.submit();">';
		}
	echo '</form>';

	cerrar_barra_estado();
?>

