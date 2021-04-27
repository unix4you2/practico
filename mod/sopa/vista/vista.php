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
        PCO_AbrirBarraEstado();
            echo '<button type="button" class="btn btn-danger" OnClick="document.PCO_FormVerMenu.submit();">'.$MULTILANG_IrEscritorio.'</button>';
        PCO_CerrarBarraEstado();
        //Cierra el contenedor (Obligatorio si se ha abierto alguno)
        PCO_CerrarVentana();
    }