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
		Title: Seccion con los contactos de Chat disponibles
		Ubicacion *[/core/marco_chat.php]*.  Presenta la lista de usuarios del sistema para poder entablar chat con ellos

	Ver tambien:
		<Seccion superior> | <Articulador>
	*/


/* ################################################################## */
/* ################################################################## */

    // Modal Ventana de chat
    abrir_dialogo_modal("Dialogo_Chat",$MULTILANG_UsrLista);

    echo $MULTILANG_UsuariosChat;
    //Consulta los usuarios siempre y cuando tenga sesion activa
    if ($PCOSESS_SesionAbierta)
        {
            $resultado=ejecutar_sql("SELECT $ListaCamposSinID_usuario from ".$TablasCore."usuario WHERE login<>'$PCOSESS_LoginUsuario' ");

            //Presenta la lista de usuarios
            echo '<table class="table">
                        <tr>
                            <td valign=middle align=center  bgcolor=darkgray>
                                <font size=2 color=black>
                                    <b>'.$MULTILANG_Usuario.'</b>
                                </font>
                            </td>
                            <td valign=middle align=center  bgcolor=darkgray>
                                <font size=2 color=black>
                                    '.$MULTILANG_Nombre.'
                                </font>
                            </td>
                            <td  bgcolor=darkgray valign=middle align=center>
                                <font size=2 color=black>
                                    '.$MULTILANG_UsrAcceso.'
                                </font>
                            </td>
                            <td bgcolor=darkgray></td>
                        </tr>';
            while($usuarios_chat = $resultado->fetch())
                {
                    echo '
                        <tr>
                            <td valign=middle align=left>
                                <i class="fa fa-user texto-azul"></i>
                                <font size=2 color=black>
                                    <b>'.$usuarios_chat["login"].'</b>
                                </font>
                            </td>
                            <td valign=middle align=left>
                                <font size=2 color=black>
                                    '.$usuarios_chat["nombre"].'
                                </font>
                            </td>
                            <td valign=middle align=left>
                                <font size=2 color=black>
                                    '.$usuarios_chat["ultimo_acceso"].'
                                </font>
                            </td>
                            <td valign=middle>
                                <button type="button" class="btn btn-success" onClick="chatWith(\''.$usuarios_chat["login"].'\'); OcultarPopUp(\'BarraFlotanteChat\'); "><i class="fa fa-weixin "></i></button>
                            </td>
                        </tr>
                    ';
                }
            echo '</table>';
        }

    $barra_herramientas_modal='
        <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
    cerrar_dialogo_modal($barra_herramientas_modal);

