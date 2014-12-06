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

	Variables de entrada:

		fecha_operacion_guiones - Fecha actual en formato AAAA-MM-DD
		hora_operacion_puntos - Hora actual en formato HH:MM:SS
		Login_usuario - Nombre de usuario que se encuentra logueado en el sistema
		accion - Accion llamada actualmente en Practico (identificador unico de funcion interna o personalizada)
		tiempo_inicio_script - Hora en microtime marcada para el incio del script

		(start code)
			if($Login_usuario=="admin" && $accion!="")
				{
					$tiempo_final_script = obtener_microtime();
					$tiempo_total_script = $tiempo_final_script - $tiempo_inicio_script;
				}
		(end)

	Salida:
		Pie de pagina de aplicacion e informacion asociada a la accion y tiempos de ejecucion en caso de ser el usuario administrador

	Ver tambien:
		<Seccion superior> | <Articulador>
	*/
?>

	<!-- INICIO DEL MENU INFERIOR -->	
	<tr><td>
		<table width="100%" cellspacing="0" cellpadding="0" border=0 class="MarcoInferior"><tr>
			<td align="left" valign="bottom" width="50%">
				&nbsp;&nbsp;<?php echo $MULTILANG_Instante; ?>:&nbsp;&nbsp;<?php echo $fecha_operacion_guiones;?>&nbsp;&nbsp;<?php echo $hora_operacion_puntos;?>
				<?php
					// Muestra la accion actual si el usuario es administrador y la accion no es vacia - Sirve como guia a la hora de crear objetos
					if(@$Login_usuario=="admin" && $accion!="")
						{
							// Calcula tiempos de ejecucion del script
							$tiempo_final_script = obtener_microtime();
							$tiempo_total_script = $tiempo_final_script - $tiempo_inicio_script;
							echo " - <font color=yellow>$MULTILANG_Accion: $accion</font> <font color=black>$MULTILANG_TiempoCarga (seg):";
							echo round($tiempo_total_script,3);
							echo " - Inc: ".count(get_included_files()); // Retorna arreglo con cantidad de archivos incluidos
						}
				?>
			</td>
			<td align="right" valign="bottom" width="50%">
				<i><i class="fa fa-copyright"></i> <a href="http://www.practico.org" style="color:#FFFFFF">Practico.org</a></i>&nbsp;&nbsp;
			</td>
		</tr></table>
	</td></tr>

<!-- FINALIZA LA TABLA PRINCIPAL -->
</table>

</div> <!-- FINALIZA MARCO DE CHAT -->
<script type="text/javascript" src="inc/chat/js/chat.js"></script>

<?php
	// Estadisticas de uso anonimo con GABeacon
	$PrefijoGA='<img src="https://ga-beacon.appspot.com/';
	$PosfijoGA='/Practico/'.$accion.'?pixel" border=0 ALT=""/>';
	// Este valor indica un ID generico de GA UA-847800-9 No edite esta linea sobre el codigo
	// Para validar que su ID es diferente al generico de seguimiento.  En lugar de esto cambie
	// su valor a traves del panel de configuracion de Practico con el entregado como ID de GoogleAnalytics
	$Infijo=base64_decode("VUEtODQ3ODAwLTk=");
	echo $PrefijoGA.$Infijo.$PosfijoGA;
	if(@$CodigoGoogleAnalytics!="")
		echo $PrefijoGA.$CodigoGoogleAnalytics.$PosfijoGA;	
?>

    
    <!-- Librería jQuery y sus plugins-->
	<script type="text/javascript" src="inc/jquery/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="inc/jquery/plugins/sketch.js"></script>
    
    <script src="inc/bootstrap/js/bootstrap.min.js"></script>
    <!-- NO REQUERIDO <script type="text/javascript" src="inc/jquery/plugins/bootstrap-modal.js"></script>-->

</body>
</html>
