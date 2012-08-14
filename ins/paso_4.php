<div align=center>
<table width="700" cellspacing=10>
	<tr>
		<td width=100><img src="../img/practico_login.png" border=0 ALT="Logo Practico" width="116" height="80"></td>
		<td valign=top><font size=2 color=black><br><b>
			[Ejecutando scripts de base de datos (si aplica)]</b><br><br>
		</font></td>
	</tr>
</table>
<hr>

<?php
	// Ejecuta los scripts de creacion de la BD si se requiere
	if ($aplicar_script_basedatos)
		{
			include("../core/configuracion.php");
			include("../core/conexiones.php");
			include("../core/comunes.php");

			//Abre el archivo con los queries
			$archivo_consultas=fopen("sql/practico.sql","r");
			$total_consultas= fread($archivo_consultas,filesize("sql/practico.sql"));
			fclose($archivo_consultas);
 
			$total_ejecutadas=0;
			$arreglo_consultas = split_sql($total_consultas);
			foreach($arreglo_consultas as $consulta)
				{
					$consulta_enviar = $ConexionPDO->prepare($consulta);
					$consulta_enviar->execute();
					$total_ejecutadas++;
				}
		}
?>
</div>

<?php
	echo '
	<table width="700" cellspacing=10><tr><td align=left><font size=2 color=black>
		<b>Total consultas ejecutadas:</b> '.$total_ejecutadas.'<br>
		Si esta es una instalaci&oacute;n nueva puede ingresar al sistema mediante las credenciales<b> admin/admin</b> y cambiarlas luego por las que usted desee.<br>
		<br>
		<font size=4 color=red><b>IMPORTANTE:</b></font><br>
		Recuerde eliminar por completo el directorio de instalaci&oacute;n para evitar que otra persona ejecute nuevamente estos scripts sobre un sistema en producci&oacute;n pudiendo ocasionar alg&uacute;n tipo de da&ntilde;o.
		<br><br>
	</td></tr></table>
	';

	abrir_barra_estado();

	if (!$hay_error)
		{
			echo '<form name="continuar" action="../" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Submit" class="BotonesEstadoCuidado" value=" Ir a su instalaci&oacute;n de Pr&aacute;ctico " onclick="document.continuar.submit();">
				</form>';
		}

	cerrar_barra_estado();
?>

