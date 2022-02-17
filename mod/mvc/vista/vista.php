<?php
	/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2012-2022
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
	 This program is free software: you can redistribute it and/or modify
	 it under the terms of the GNU General Public License as published by
	 the Free Software Foundation, either version 3 of the License, or
	 (at your option) any later version.

	 This program is distributed in the hope that it will be useful,
	 but WITHOUT ANY WARRANTY; without even the implied warranty of
	 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 GNU General Public License for more details.

	 You should have received a copy of the GNU General Public License
	 along with this program.  If not, see <http://www.gnu.org/licenses/>
	 
	            --- TRADUCCION NO OFICIAL DE LA LICENCIA ---

     Esta es una traducción no oficial de la Licencia Pública General de
     GNU al español. No ha sido publicada por la Free Software Foundation
     y no establece los términos jurídicos de distribución del software 
     publicado bajo la GPL 3 de GNU, solo la GPL de GNU original en inglés
     lo hace. De todos modos, esperamos que esta traducción ayude a los
     hispanohablantes a comprender mejor la GPL de GNU:
	 
     Este programa es software libre: puede redistribuirlo y/o modificarlo
     bajo los términos de la Licencia General Pública de GNU publicada por
     la Free Software Foundation, ya sea la versión 3 de la Licencia, o 
     (a su elección) cualquier versión posterior.

     Este programa se distribuye con la esperanza de que sea útil pero SIN
     NINGUNA GARANTÍA; incluso sin la garantía implícita de MERCANTIBILIDAD
     o CALIFICADA PARA UN PROPÓSITO EN PARTICULAR. Vea la Licencia General
     Pública de GNU para más detalles.

     Usted ha debido de recibir una copia de la Licencia General Pública de
     GNU junto con este programa. Si no, vea <http://www.gnu.org/licenses/>
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