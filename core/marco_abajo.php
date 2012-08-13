	<!-- INICIO DEL MENU INFERIOR -->	

	<tr><td>
		<table width="100%" cellspacing="0" cellpadding="0" border=0 class="MarcoInferior"><tr>
			<td align="left" valign="bottom" width="50%">
				&nbsp;&nbsp;Instante:&nbsp;&nbsp;<?php echo $fecha_operacion_guiones;?>&nbsp;&nbsp;<?php echo $hora_operacion_puntos;?>
				<?php 
				// Muestra la accion actual si el usuario es administrador y la accion no es vacia - Sirve como guia a la hora de crear objetos
				if($Id_usuario="admin" && $accion!="") echo " - <font color=yellow>Accion: ".$accion."</font>"; ?>
			</td>
			<td align="right" valign="bottom" width="50%">
				Software por John F. Arroyave Gutierrez - Proyecto de maestr&iacute;a UNAB&nbsp;&nbsp;
			</td>
		</tr></table>
	</td></tr>


<!-- FINALIZA LA TABLA PRINCIPAL -->
</table>



</body>
</html>
