<div align=center>
<table width="700" cellspacing=10>
	<tr>
		<td width=100><img src="../img/practico_login.png" border=0 ALT="Logo Practico" width="116" height="80"></td>
		<td valign=top><font size=2 color=black><br><b>
			[Escribiendo archivos de configuraci&oacute;n]</b><br><br>
			Se esta escribiendo el archivo de configuracion.php ubicado en /core con los par&aacute;metros por usted indicados.
		</font></td>
	</tr>
</table>
<hr>







<?php

// Crea la cadena de salida con la configuracion de practico
$out=sprintf("<?php
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
?>",$servidor,$basedatos,$usuario,$contrasena,$motor,$puerto,$prefijocore,$prefijoapp);

	// Escribe el archivo de configuracion
	$write_errror=false;
	$fp=fopen("../core/configuracion.php","w");
	if($fp==null)
		{
			$hay_error=1;
		}
	else
		{
			fwrite($fp,$out,strlen($out)); 
			fclose($fp);
		}

	//Muestra errores si los hay
	if ($hay_error)
		{
			echo '<b>Se han encontrado errores al tratar de escribir el archivo de configuraci&oacute;n !!!</b>:<br>Si lo desea una alternativa puede ser cambiar usted mismo los valores por defecto incluidos en el archivo core/configuracion.php';
		}
?>
<br><br>


            <?php			  
					  //Base de datos
					  $fp=fopen($cabsolute_path."install/install.sql","r");
					  $query= fread($fp,filesize($cabsolute_path."install/install.sql"));
					  fclose($fp);
 
					  $query_arr = split_sql($query);
					  foreach($query_arr as $query)
					  	{
						$conn->Execute($query);
						}
					$conn->Execute("INSERT INTO #__users (id,name,username,email,password,usertype,registerDate,gid) 
									VALUES (1,'$cname','$cusername','$cemail','".md5($cpassword)."','Administrator','$time',5)");						
							
					  ?>

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

