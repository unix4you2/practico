<?php
	/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2020
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
    Redistribution and use in source and binary forms, with or without
    modification, are permitted provided that the following conditions are met:
    
    1. Redistributions of source code must retain the above copyright notice, this
       list of conditions and the following disclaimer.
    
    2. Redistributions in binary form must reproduce the above copyright notice,
       this list of conditions and the following disclaimer in the documentation
       and/or other materials provided with the distribution.
    
    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
    AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
    IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
    DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
    FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
    DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
    SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
    CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
    OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
    OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
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