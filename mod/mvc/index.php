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
		UN EJEMPLO SENCILLO DE COMO PASAR DE ALGO COMO ESTE SCRIPT PARA
		CONSULTAR USUARIOS A LO MISMO EN MVC Y FUNCIONES DE PRACTICO
		
			<?php
				$conexion = mysql_connect('servidor','usuario','clave');
				mysql_select_db('basedatos', $conexion);
				$registros=mysql_query('SELECT * FROM core_usuario', $conexion);
			?>
			<h1>Listado de Usuarios</h1>
			<table>
				<tr>
					<td>Fecha</td>
					<td>Titulo</td>
				</tr>
				<?php
					while($fila= mysql_fetch_array($registros, MYSQL_ASSOC))
						{
							echo "<tr>";
							echo "<td> ".$fila['fecha']." </td>";
							echo "<td> ".$fila['titulo']." </td>";
							echo "</tr>";
						}
				?>
			</table>
			<?php
				mysql_close($conexion);
			?>
		El ejemplo anterior se encuentra totalmente mezclado, no MVC.

		Ver archivo LEAME como en todos los modulos para conocer como activar
		este modulo y revisar su funcionamiento
	*/
?>

<?php
	// Valida sesion activa de Practico
	@session_start();
	if (!isset($PCOSESS_SesionAbierta)) 
		{
			echo '<head><title>Error</title><style type="text/css"> body { background-color: #000000; color: #7f7f7f; font-family: sans-serif,helvetica; } </style></head><body><table width="100%" height="100%" border=0><tr><td align=center>&#9827; Acceso no autorizado !</td></tr></table></body>';
			die();
		}

	// Configuraciones basicas de su modulo (si aplican)
	$raiz_modulo = "mod/mvc/";
	$ruta_modelos = $raiz_modulo."modelo/";
	$ruta_vistas = $raiz_modulo."vista/";
	$ruta_controladores = $raiz_modulo."controlador/";
	$ruta_idiomas = $raiz_modulo."idiomas/";

/* ################################################################## */
/* ################################################################## */
/*
	Function: probar_ejemplo_mvc
	Ejecuta el ejemplo de MVC para una consulta sencilla de auditoria en Practico.  Es solo un ejemplo
	pues en realidad como modelo aplicaria para cualquier operacion y sobre cualquier tabla.

	Salida:
		Listado de acciones de auditoria utilizando MVC y algunos estilos y funciones de Practico
*/
if ($PCO_Accion=="probar_ejemplo_mvc") 
	{
		//Llamar al controlador inicial de la aplicacion o modulo
		require($ruta_controladores.'controlador.php');
	}