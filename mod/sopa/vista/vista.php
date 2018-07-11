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


/* ################################################################## */
/* ################################################################## */
/*
	Function: DemoVista_SOPA_Facebook
	Presenta un arreglo de entradas obtenidas desde FaceBook
	
	Variables de entrada:

		EntradasFaceBook - Arreglo obtenido mediante la funcion SOPA correspondiente para Facebook
		
	Salida:
		Diagramacion de los datos entregados por SOPA
*/
function DemoVista_SOPA_Facebook($EntradasFaceBook)
    {
        global $MULTILANG_IrEscritorio;
        //Abre un contenedor (Opcional)
        PCO_AbrirVentana('Prueba de SO.PA. - (SocialParser by Practico)', 'panel-primary');

        //Encabezados de la tabla
        echo '<h1>Entradas encontradas: <strong>'.count($EntradasFaceBook).'</strong></h1>
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                      <th>Titulo</td>
                      <th>Descripcion</td>
                      <th>Fecha</td>
                    </tr>
                </thead>
                <tbody>';
                    foreach($EntradasFaceBook as $fila):
                        echo '
                            <tr>
                                <td>'.$fila['Titulo'].'</td>
                                <td>'.$fila['Descripcion'].'</td>
                                <td>'.$fila['Fecha'].'</td>
                            </tr>';
                    endforeach;
        echo '  </tbody>
            </table>';

        //Crea una barra de estado (opcional)
        abrir_barra_estado();
            echo '<button type="button" class="btn btn-danger" OnClick="document.core_ver_menu.submit();">'.$MULTILANG_IrEscritorio.'</button>';
        cerrar_barra_estado();
        //Cierra el contenedor (Obligatorio si se ha abierto alguno)
        PCO_CerrarVentana();
    }