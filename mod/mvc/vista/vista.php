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

<?php
	//Abre un contenedor (Opcional)
	PCO_AbrirVentana('Registros de auditoria', 'panel-primary');
?>

	<h1>Listado de acciones encontradas</h1>
	<table class="TextosVentana">
		<tr>
		  <td>Id</td>
		  <td>Usuario</td>
		  <td>Accion</td>
		  <td>Fecha</td>
		  <td>Hora</td>
		</tr>
		<?php foreach($registros as $fila): ?>
			<tr>
				<td><?php echo $fila['id']?></td>
				<td><?php echo $fila['usuario_login']?></td>
				<td><?php echo $fila['accion']?></td>
				<td><?php echo $fila['fecha']?></td>
				<td><?php echo $fila['hora']?></td>
			</tr>
		<?php endforeach;?>
	</table>

<?php
	//Crea una barra de estado (opcional)
	PCO_AbrirBarraEstado();
		echo '<input type="Button"  class="BotonesEstadoCuidado" value="'.$MULTILANG_Cerrar.'" onClick="document.PCO_FormVerMenu.submit();">';
	PCO_CerrarBarraEstado();
?>

<?php
	//Cierra el contenedor (Obligatorio si se ha abierto alguno)
	PCO_CerrarVentana();
?>

<?php
/* ANOTACIONES IMPORTANTES:
===========================
Todos los mensajes podrian ser en multiples idiomas creando sus propios
archivos de inclusion y llamando a estos de acuerdo a la variable de
Practico $IdiomaPredeterminado que indica  por ejemplo 'es' o 'en' para 
que usted pueda hacer algo como:
	include($ruta_idiomas.$IdiomaPredeterminado.".php");

Las tablas, marcos y demas etiquetas HTML pueden hacer uso de los estilos
CSS definidos por Practico para que asi cuando el usuario cambie plantillas
o versiones su modulo siga siendo presentado de manera consistente.  Ver
estilo aplicado a la tabla.

Puede hacer uso de todas las funciones existentes, por ejemplo la de
creacion de barras de estado o herramientas como se muestra al final e
incluso hacer uso de las constantes de idioma predefinidas en Practico
como se muestra en el boton y elementos y formularios preexistentes como
se ve en su evento onclick.
*/