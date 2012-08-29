	<!-- INICIO DEL MENU INFERIOR -->	

	<tr><td>
		<table width="100%" cellspacing="0" cellpadding="0" border=0 class="MarcoInferior"><tr>
			<td align="left" valign="bottom" width="50%">
				&nbsp;&nbsp;Instante:&nbsp;&nbsp;<?php echo $fecha_operacion_guiones;?>&nbsp;&nbsp;<?php echo $hora_operacion_puntos;?>
				<?php
					$url = $_SERVER['SERVER_NAME'];
					$root = $url.$_SERVER['PHP_SELF'];
					echo " - <font color=yellow>URL actual: <b>".$root."</b></font>";
				?>
			</td>
			<td align="right" valign="bottom" width="50%">
				Software por John F. Arroyave Guti&eacute;rrez&nbsp;&nbsp;
			</td>
		</tr></table>
	</td></tr>

<!-- FINALIZA LA TABLA PRINCIPAL -->
</table>



</body>
</html>
