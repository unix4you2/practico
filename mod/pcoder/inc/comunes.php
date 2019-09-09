<?php
	/*
	   PCODER (Editor de Codigo en la Nube)
	   Sistema de Edicion de Codigo basado en PHP
	   Copyright (C) 2013  John F. Arroyave Gutiérrez
						   unix4you2@gmail.com
						   www.practico.org

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
	*/



/* ################################################################## */
/* #####  CLON de PCO_AbrirDialogoModal                          #### */
/* ################################################################## */
function PCODER_AbrirDialogoModal($identificador,$titulo="",$estilo_modal="",$impresion_directa=1,$subtitulo="")
    {
        $salida= '
            <div class="modal fade '.$estilo_modal.'" id="'.$identificador.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">'.$titulo.'</h4>';

        //Si se recibe un subtitulo lo agrega al modal
        if ($subtitulo!="")
            $salida.='<h6 id="myModalLabelSubtitulo"><i>'.$subtitulo.'</i></h6>';

        $salida.='                </div>
                        <div class="modal-body mdl-primary">';
        if($impresion_directa==1)
            echo $salida;
        else
            return $salida;
    }


/* ################################################################## */
/* #####  CLON de PCO_CerrarDialogoModal                         #### */
/* ################################################################## */
function PCODER_CerrarDialogoModal($contenido_piepagina,$impresion_directa=1)
    {
        $salida= '
                            </div>
                            <div class="modal-footer">
                                '.$contenido_piepagina.'
                            </div>
                        </div>
                    </div>
                </div>';
        if($impresion_directa==1)
            echo $salida;
        else
            return $salida;
    }


/* ################################################################## */
/* #####  CLON de PCO_Mensaje                                    #### */
/* ################################################################## */
$MULTILANG_Cerrar=$MULTILANG_PCODER_Cerrar;
function PCODER_Mensaje($titulo,$texto,$DEPRECATED_ancho="",$icono,$estilo)
    {
        global $MULTILANG_Cerrar;
        echo '<div class="'.$estilo.'" role="alert">
            <i class="'.$icono.' pull-left"></i>
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">'.$MULTILANG_Cerrar.'</span></button>
            <strong>'.$titulo.'</strong><br>'.$texto.'
        </div>';
    }


/* ################################################################## */
/* ################################################################## */
/*
    Function: Presentar_KeyBindings
    Presenta la inforamcion de ayuda de atajos de teclado
*/
function PCODER_PresentarKeyBindings()
    {
        global $MULTILANG_PCODER_Basicos,$MULTILANG_PCODER_Otros,$MULTILANG_PCODER_Desplazar,$MULTILANG_PCODER_Seleccionar;
        echo '
            <div class="btn btn-success btn-block"><b>'.$MULTILANG_PCODER_Basicos.'</b></div>
            <table class="table table-responsive table-bordered table-condensed table-hover btn-xs">
                <thead>
                    <tr>
                        <td><b>PC (Windows/Linux)</b></td>
                        <td><b>Mac</b></td>
                        <td><b>Acci&oacute;n</b></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ctrl-L</td>
                        <td>Command-L</td>
                        <td>Ir a la l&iacute;nea</td>
                    </tr>
                    <tr>
                        <td>Ctrl-F</td>
                        <td>Command-F</td>
                        <td>Buscar</td>
                    </tr>
                    <tr>
                        <td>Ctrl-H</td>
                        <td>Command-Option-F</td>
                        <td>Buscar y reemplazar</td>
                    </tr>
                    <tr>
                        <td>Ctrl-K</td>
                        <td>Command-G</td>
                        <td>Buscar siguiente</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Shift-K</td>
                        <td>Command-Shift-G</td>
                        <td>Buscar anterior</td>
                    </tr>
                    <tr>
                        <td>Tab</td>
                        <td>Tab</td>
                        <td>Agregar sangr&iacute;a</td>
                    </tr>
                    <tr>
                        <td>Shift-Tab</td>
                        <td>Shift-Tab</td>
                        <td>Disminuir sangr&iacute;a</td>
                    </tr>
                    <tr>
                        <td>Alt-L, Ctrl-F1</td>
                        <td>Command-Option-L, Command-F1</td>
                        <td>Recoger/Expandir selecci&oacute;n</td>
                    </tr>
                    <tr>
                        <td>Ctrl-P</td>
                        <td></td>
                        <td>Buscar el siguiente elemento que abre o cierra el actual (llaves, par&eacute;ntesis,cochetes,etc)</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Shift-P</td>
                        <td></td>
                        <td>Buscar el siguiente elemento que abre o cierra el actual (llaves, par&eacute;ntesis,cochetes,etc)</td>
                    </tr>
                </tbody>
            </table>

            <div class="btn btn-success btn-block"><b>'.$MULTILANG_PCODER_Desplazar.'</b></div>
            <table class="table table-responsive table-bordered table-condensed table-hover btn-xs">
                <thead>
                    <tr>
                        <td><b>PC (Windows/Linux)</b></td>
                        <td><b>Mac</b></td>
                        <td><b>Acci&oacute;n</b></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Down</td>
                        <td>Down, Ctrl-N</td>
                        <td>Bajar una l&iacute;nea</td>
                    </tr>
                    <tr>
                        <td>Up</td>
                        <td>Up, Ctrl-P</td>
                        <td>Subir una l&iacute;nea</td>
                    </tr>
                    <tr>
                        <td>Ctrl-End</td>
                        <td>Command-End, Command-Down</td>
                        <td>Ir al final</td>
                    </tr>
                    <tr>
                        <td>Left</td>
                        <td>Left, Ctrl-B</td>
                        <td>Ir a la izquierda</td>
                    </tr>
                    <tr>
                        <td>Alt-Right, End</td>
                        <td>Command-Right, End, Ctrl-E</td>
                        <td>Ir al final de la l&iacute;nea</td>
                    </tr>
                    <tr>
                        <td>Alt-Left, Home</td>
                        <td>Command-Left, Home, Ctrl-A</td>
                        <td>Ir al comienzo de la l&iacute;nea</td>
                    </tr>
                    <tr>
                        <td>PageDown</td>
                        <td>Option-PageDown, Ctrl-V</td>
                        <td>Ir una p&aacute;gina abajo</td>
                    </tr>
                    <tr>
                        <td>PageUp</td>
                        <td>Option-PageUp</td>
                        <td>Ir una p&aacute;gina arriba</td>
                    </tr>
                    <tr>
                        <td>Right</td>
                        <td>Right, Ctrl-F</td>
                        <td>Ir a la derecha</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Home</td>
                        <td>Command-Home, Command-Up</td>
                        <td>Ir al inicio del documento</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Left</td>
                        <td>Option-Left</td>
                        <td>Ir una palabra a la izquierda</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Right</td>
                        <td>Option-Right</td>
                        <td>Ir una palabra a la derecha</td>
                    </tr>
                    <tr>
                        <td>Alt-Down</td>
                        <td>Option-Down</td>
                        <td>Mover una l&iacute;nea abajo</td>
                    </tr>
                    <tr>
                        <td>Alt-Up</td>
                        <td>Option-Up</td>
                        <td>Mover una l&iacute;nea arriba</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Alt-Shift-Up</td>
                        <td>Ctrl-Option-Shift-Up</td>
                        <td>Mover multicursor de la l&iacute;nea actual a la l&iacute;nea superior</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Alt-Shift-Down</td>
                        <td>Ctrl-Option-Shift-Down</td>
                        <td>Mover multicursor de la l&iacute;nea actual a la l&iacute;nea inferior</td>
                    </tr>
                    <tr>
                        <td>Insert</td>
                        <td>Insert</td>
                        <td>Sobreescribir en el cursor</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Alt-Shift-Right</td>
                        <td>Ctrl-Option-Shift-Right</td>
                        <td>Remover la ocurrencia actual de la multiseleccion y moverse al siguiente</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Alt-Shift-Left</td>
                        <td>Ctrl-Option-Shift-Left</td>
                        <td>Remover la ocurrencia actual de la multiseleccion y moverse al anterior</td>
                    </tr>
                    <tr>
                        <td>Ctrl-D</td>
                        <td>Command-D</td>
                        <td>Remover l&iacute;nea</td>
                    </tr>
                    <tr>
                        <td>Alt-Delete</td>
                        <td>Ctrl-K</td>
                        <td>Remover hasta el fin de l&iacute;nea</td>
                    </tr>
                    <tr>
                        <td>Alt-Backspace</td>
                        <td>Command-Backspace</td>
                        <td>Remover hasta el inicio de l&iacute;nea</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Backspace</td>
                        <td>Option-Backspace, Ctrl-Option-Backspace</td>
                        <td>Remover palabra a la izquierda</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Delete</td>
                        <td>Option-Delete</td>
                        <td>Remover palabra a la derecha</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Down</td>
                        <td>Command-Down</td>
                        <td>Desplazar una l&iacute;nea hacia abajo</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Up</td>
                        <td></td>
                        <td>Desplazar una l&iacute;nea hacia arriba</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Option-PageDown	</td>
                        <td>Desplazar una p&aacute;gina hacia abajo</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Option-PageUp</td>
                        <td>Desplazar una p&aacute;gina hacia arriba</td>
                    </tr>
                </tbody>
            </table>

            <div class="btn btn-success btn-block"><b>'.$MULTILANG_PCODER_Seleccionar.'</b></div>
            <table class="table table-responsive table-bordered table-condensed table-hover btn-xs">
                <thead>
                    <tr>
                        <td><b>PC (Windows/Linux)</b></td>
                        <td><b>Mac</b></td>
                        <td><b>Acci&oacute;n</b></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ctrl-A</td>
                        <td>Command-A</td>
                        <td>Seleccionar todo</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Shift-L</td>
                        <td>Ctrl-Shift-L</td>
                        <td>Seleccionar todo de una multiselecci&oacute;n</td>
                    </tr>
                    <tr>
                        <td>Shift-Down</td>
                        <td>Shift-Down</td>
                        <td>Seleccionar hacia abajo</td>
                    </tr>
                    <tr>
                        <td>Shift-Left</td>
                        <td>Shift-Left</td>
                        <td>Seleccionar hacia la izquierda</td>
                    </tr>
                    <tr>
                        <td>Shift-End</td>
                        <td>Shift-End</td>
                        <td>Seleccionar hasta el fin de l&iacute;nea</td>
                    </tr>
                    <tr>
                        <td>Shift-Home</td>
                        <td>Shift-Home</td>
                        <td>Seleccionar hasta el comienzo de l&iacute;nea</td>
                    </tr>
                    <tr>
                        <td>Shift-PageDown</td>
                        <td>Shift-PageDown</td>
                        <td>Seleccionar una p&aacute;gina hacia abajo</td>
                    </tr>
                    <tr>
                        <td>Shift-PageUp</td>
                        <td>Shift-PageUp</td>
                        <td>Seleccionar una p&aacute;gina hacia arriba</td>
                    </tr>
                    <tr>
                        <td>Shift-Right</td>
                        <td>Shift-Right</td>
                        <td>Seleccionar hacia la derecha</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Shift-End</td>
                        <td>Command-Shift-Down</td>
                        <td>Seleccionar hasta el fin del documento</td>
                    </tr>
                    <tr>
                        <td>Alt-Shift-Right</td>
                        <td>Command-Shift-Right	</td>
                        <td>Seleccionar hasta el fin de l&iacute;nea</td>
                    </tr>
                    <tr>
                        <td>Alt-Shift-Left</td>
                        <td>Command-Shift-Left</td>
                        <td>Seleccionar hasta el comienzo de l&iacute;nea</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Shift-Home</td>
                        <td>Command-Shift-Up</td>
                        <td>Seleccionar hasta el inicio del documento</td>
                    </tr>
                    <tr>
                        <td>Shift-Up</td>
                        <td>Shift-Up</td>
                        <td>Seleccionar hacia arriba</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Shift-Left</td>
                        <td>Option-Shift-Left</td>
                        <td>Seleccionar palabra a la izquierda</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Shift-Right</td>
                        <td>Option-Shift-Right</td>
                        <td>Seleccionar palabra a la derecha</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Shift-D</td>
                        <td>Command-Shift-D</td>
                        <td>Duplicar la selecci&oacute;n</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Alt-Up</td>
                        <td>Ctrl-Option-Up</td>
                        <td>Agregar multicursor arriba</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Alt-Down</td>
                        <td>Ctrl-Option-Down</td>
                        <td>Agregar multicursor abajo</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Alt-Right</td>
                        <td>Ctrl-Option-Right</td>
                        <td>A&ntilde;adir siguiente aparici&oacute;n de selecci&oacute;n m&uacute;ltiple</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Alt-Left</td>
                        <td>Ctrl-Option-Left</td>
                        <td>A&ntilde;adir previa aparici&oacute;n de selecci&oacute;n m&uacute;ltiple</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Ctrl-L</td>
                        <td>Centrar la selecci&oacute;n</td>
                    </tr>
                </tbody>
            </table>


            <div class="btn btn-success btn-block"><b>'.$MULTILANG_PCODER_Otros.'</b></div>
            <table class="table table-responsive table-bordered table-condensed table-hover btn-xs">
                <thead>
                    <tr>
                        <td><b>PC (Windows/Linux)</b></td>
                        <td><b>Mac</b></td>
                        <td><b>Acci&oacute;n</b></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ctrl-Alt-E</td>
                        <td></td>
                        <td>Grabar una macro</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Shift-E</td>
                        <td>Command-Shift-E</td>
                        <td>Ejecutar una macro</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Z</td>
                        <td>Command-Z</td>
                        <td>Deshacer</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Shift-Z, Ctrl-Y</td>
                        <td>Command-Shift-Z, Command-Y</td>
                        <td>Rehacer</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Shift-U</td>
                        <td>Ctrl-Shift-U</td>
                        <td>Cambiar a min&uacute;sculas</td>
                    </tr>
                    <tr>
                        <td>Ctrl-U</td>
                        <td>Ctrl-U</td>
                        <td>Cambiar a may&uacute;sculas</td>
                    </tr>
                    <tr>
                        <td>Alt-Shift-Down</td>
                        <td>Command-Option-Down</td>
                        <td>Copiar l&iacute;nea debajo</td>
                    </tr>
                    <tr>
                        <td>Alt-Shift-Up</td>
                        <td>Command-Option-Up</td>
                        <td>Copiar l&iacute;nea encima</td>
                    </tr>
                    <tr>
                        <td>Delete</td>
                        <td></td>
                        <td>Eliminar</td>
                    </tr>
                    <tr>
                        <td>Alt-0</td>
                        <td>Command-Option-0</td>
                        <td>Recoger todo</td>
                    </tr>
                    <tr>
                        <td>Ctrl-Enter, F11</td>
                        <td>Command-Enter</td>
                        <td>Pantalla completa</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Ctrl-O</td>
                        <td>Dividir l&iacute;nea</td>
                    </tr>
                    <tr>
                        <td>Ctrl-/</td>
                        <td>Command-/</td>
                        <td>Cambiar a comentario</td>
                    </tr>
                    <tr>
                        <td>Ctrl-T</td>
                        <td>Ctrl-T</td>
                        <td>Transponer letras</td>
                    </tr>
                    <tr>
                        <td>Alt-Shift-L, Ctrl-Shift-F1</td>
                        <td>Command-Option-Shift-L, Command-Shift-F1</td>
                        <td>Expandir</td>
                    </tr>
                    <tr>
                        <td>Alt-Shift-0</td>
                        <td>Command-Option-Shift-0</td>
                        <td>Expandir todo</td>
                    </tr>
                    <tr>
                        <td>Ctrl- ,</td>
                        <td>Command- ,</td>
                        <td>Ver menu de configuraci&oacute;n</td>
                    </tr>
                </tbody>
            </table>
        ';
    }