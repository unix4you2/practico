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

	/*
		Title: Seccion inferior
		Ubicacion *[/core/marco_abajo.php]*.  Archivo dedicado a la diagramacion de contenidos en el pie de pagina de la aplicacion, incluye valores de accion y tiempos para el usuario administrador.
	*/
?>

	<!-- INICIO DEL MENU INFERIOR -->	
	<tr><td>
		<table width="100%" cellspacing="0" cellpadding="0" border=0 class="MarcoInferior"><tr>
			<td align="left" valign="bottom" width="50%">
				&nbsp;&nbsp;Instante:&nbsp;&nbsp;<?php echo $fecha_operacion_guiones;?>&nbsp;&nbsp;<?php echo $hora_operacion_puntos;?>
				<?php 
					// Muestra la accion actual si el usuario es administrador y la accion no es vacia - Sirve como guia a la hora de crear objetos
					if($Login_usuario=="admin" && $accion!="")
						{
							// Calcula tiempos de ejecucion del script
							$tiempo_final_script = obtener_microtime();
							$tiempo_total_script = $tiempo_final_script - $tiempo_inicio_script;
							echo " - <font color=yellow>Accion: ".$accion."</font> <font color=black>Usados (seg):";  echo round($tiempo_total_script,3);
						}
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
