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



<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
<table cellspacing=10>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				Tipo de motor
			</font>
		</td>
		<td valign=top>
			<select name="MotorBD" class="Combos" >
				<option value="mysql">MySQL (3.x/4.x/5.x)</option>
				<option value="sqlite2">SQLite2</option>
				<option value="sqlite3">SQLite3</option>
				<option value="sqlsrv">FreeTDS/Microsoft SQL Server: Win32 [max version 2008]</option>
				<option value="mssql">FreeTDS/Microsoft SQL Server: Win32&Linux, [max version 2000]</option>
				<option value="pg">PostgreSQL</option>
				<option value="ibm">IBM (DB2)</option>
				<option value="dblib">DBLIB</option>
				<option value="odbc">Microsoft Access (ODBC v3: IBM DB2, unixODBC, Win32 ODBC)</option>
				<option value="oracle">ORACLE (OCI Oracle Call Interface)</option>
				<option value="ifmx">Informix (IBM Informix Dynamic Server)</option>
				<option value="fbd">Firebird (Firebird/Interbase 6)</option>
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
			<font size=2 color=black>
			<input type="text" name="Servidor" size="20" class="CampoTexto" class="keyboardInput">
			Puerto: <input type="text" name="PuertoBD" size="4" class="CampoTexto" class="keyboardInput"> (si no es el predeterminado)
			</font>
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				Base de datos
			</font>
		</td>
		<td valign=top>
			<font size=2 color=black>
			<input type="text" name="BaseDatos" size="20" class="CampoTexto" class="keyboardInput"> (debe existir)
			</font>
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				Usuario
			</font>
		</td>
		<td valign=top>
			<input type="text" name="UsuarioBD" size="20" class="CampoTexto" class="keyboardInput">
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				Contrase&ntilde;a
			</font>
		</td>
		<td valign=top>
			<input type="password" name="PasswordBD" size="20" class="CampoTexto" class="keyboardInput">
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				Prefijo tablas internas de Pr&aacute;ctico
			</font>
		</td>
		<td valign=top>
			<input type="text" name="TablasCore" size="7" value="Core_" class="CampoTexto" class="keyboardInput">
		</td>
	</tr>
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				Prefijo tablas de Aplicaci&oacute;n
			</font>
		</td>
		<td valign=top>
			<input type="text" name="TablasApp" size="7" value="App_" class="CampoTexto" class="keyboardInput">
		</td>
	</tr>
</table>

<br><br>
</div>

<?php
	abrir_barra_estado();

	$anterior=$paso-1;
	$siguiente=$paso+1;

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
	echo '<form name="regresar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			<input type="Hidden" name="paso" value="'.$anterior.'">
			<input type="Button" class="BotonesEstado" value=" <<< Anterior " onclick="document.regresar.submit();">
		  </form>';
	cerrar_barra_estado();
?>

