<div align=center>
	

<table width="700" cellspacing=10>
	<tr>
		<td width=100 valign=top><img src="../img/practico_login.png" border=0 ALT="Logo Practico" width="116" height="80"></td>
		<td valign=top>
			<font size=2 color=black><br>
			<b>[Chequeo configuraci&oacute;n de preprocesador]</b><br>
			Una vista de su configuraci&oacute;n de PHP se encuentra disponible en <b><a target="_blank" href="paso_i.php">[este enlace]</a></b>.
				<table width="100%" cellspacing=10><tr><td valign=top><font size=2 color=black>
					<div align=left>
						<u>Debe cumplir con lo siguiente:</u>
						<li>Extensi&oacute;n PDO activada
						<li>Driver PDO para el tipo de base de datos deseada
						<li>Extensi&oacute;n GD para manipulaci&oacute;n de gr&aacute;ficos
					</div>
				</font></td></tr></table>

			
			<hr><b>[Chequeo de directorios]</b><br>
				Los siguientes archivos y directorios deben contar con permisos de escritura para que el aplicativo	pueda operar correctamente:
			</font>
				<table width="100%" cellspacing=10><tr><td valign=top><font size=2 color=black>
					<div align=left>
						<?php
							$hay_error=0;
							//informar_prueba_escritura("..");
							@informar_prueba_escritura("../bkp",1);
							@informar_prueba_escritura("../core",1);
							//informar_prueba_escritura("../core/configuracion.php",2);
							@informar_prueba_escritura("../tmp",1);
						?>
					</div>
				</font></td></tr></table>
		</td>
	</tr>
</table>

<?php
	if ($hay_error)
		{
			echo '<b>Se han encontrado errores al tratar de escribir en los directorios de instalaci&oacute;n !!!</b>:<br>Las rutas indicadas deben pertenecer al usuario del webserver que ejecuta los scripts de Pr&aacute;ctico (generalmente apache<br>www, www-data u otro similar) y contar con permisos 755 para el caso de carpetas y 644 para los archivos.<br>Una forma r&aacute;pida de actualizar estos permisos puede ser ejecutando desde la raiz de Pr&aacute;ctico los comandos:<li>find . -type d -exec chmod 755 {} \;  &nbsp;&nbsp;(cambiar&aacute; todos los permisos de carpetas)<li>find . -type f -exec chmod 644 {} \;  &nbsp;&nbsp;(cambiar&aacute; todos los permisos de archivos)<li>chown -R www-data *  &nbsp;&nbsp;(asumiendo que www-data es el usuario que corre el servicio web)';
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
			echo '<input type="Hidden" name="paso" value="'.$paso.'">';
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

