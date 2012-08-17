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
<table cellspacing=10 width="700">
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				Tipo de motor
			</font>
		</td>
		<td valign=top width="380">
			<select name="MotorBD" class="Combos" >
				<option value="mysql">MySQL - MariaDB (3.x/4.x/5.x)</option>
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
			<a href="#" title="MySQL y MariaDB" name="Son los motores oficiales.  Sobre ellos se hace el desarrollo y pruebas de la herramienta y aunque gracias a PDO usted podr&aacute; utilizar la herramienta en otros motores es probable que deba hacer ajustes a operaciones espec&iacute;ficas de &eacute;stos."><img src="img/icn_10.gif" border=0></a>
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
	<tr>
		<td valign=top align=right>
			<font size=2 color=black>
				Llave de paso
			</font>
		</td>
		<td valign=top>
			<font size=2 color=black>
				<input type="text" name="LlaveDePaso" size="12" value="<?php echo TextoAleatorio(10); ?>" class="CampoTexto" class="keyboardInput">
				(valor para firmar cuentas de usuario)
			</font>
		</td>
	</tr>
	<tr>
		<td valign=top colspan=2>
			<font size=1 color=darkblue>
				<u>IMPORTANTE 1</u>: La base de datos debe existir previamente para que Pr&aacute;ctico pueda conectarse a ella y generar las estructuras requeridas.  Consulte con su proveedor de hosting o administrador de sistemas c&oacute;mo crear una base de datos con privilegios suficientes para trabajar con Pr&aacute;ctico.<br><br>
				<u>IMPORTANTE 2</u>: El instalador eliminar&aacute; todas las tablas existentes sobre la base de datos indicada y que coincidan con los nombres de tablas que utilizar&aacute; Pr&aacute;ctico.  Si usted considera que puede tener informaci&oacute;n importante en ellas se recomienda realizar una copia de seguridad antes de continuar.  Si desea compartir una misma base de datos entre diferentes instalaciones de Pr&aacute;ctico puede cambiar los prefijos de tabla utilizados por cada una.
			</font>
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

