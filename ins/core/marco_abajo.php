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
				<i>&copy; Codigoabierto.org</i>&nbsp;&nbsp;
			</td>
		</tr></table>
	</td></tr>

<!-- FINALIZA LA TABLA PRINCIPAL -->
</table>



</body>
</html>
