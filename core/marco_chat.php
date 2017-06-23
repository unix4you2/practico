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

    echo '<div class="oculto_impresion">';
    // Modal Ventana de chat
    abrir_dialogo_modal("Dialogo_Chat",$MULTILANG_UsrLista,"modal-wide");

    echo $MULTILANG_UsuariosChat;
    //Consulta los usuarios siempre y cuando tenga sesion activa
    if ($PCOSESS_SesionAbierta)
        {
            $resultado=ejecutar_sql("SELECT $ListaCamposSinID_usuario from ".$TablasCore."usuario WHERE login<>'$PCOSESS_LoginUsuario' ");

            //Presenta la lista de usuarios
            @$PCO_InformesDataTable.="TablaUsuariosChat|"; //Agrega la tabla a la lista de DataTables para ser convertida
            echo '<hr><table width="100%" class="table table-condensed table-hover btn-xs table-responsive  table-unbordered  table-striped " id="TablaUsuariosChat">
							<thead>
								<tr>
									<th valign=middle align=center  bgcolor=darkgray>
										<font size=2 color=black>
											<b>'.$MULTILANG_Usuario.'</b>
										</font>
									</th>
									<th valign=middle align=center  bgcolor=darkgray>
										<font size=2 color=black>
											'.$MULTILANG_Nombre.'
										</font>
									</th>
									<th  bgcolor=darkgray valign=middle align=center>
										<font size=2 color=black>
											'.$MULTILANG_UsrAcceso.'
										</font>
									</th>
									<th bgcolor=darkgray></th>
								</tr>
							</thead>
                        <tbody>';
            while($usuarios_chat = $resultado->fetch())
                {
                    $NombreUsuarioChat = preg_replace("/[^a-zA-Z0-9]/", "_", $usuarios_chat["login"] );
                    echo '
                        <tr>
                            <td valign=middle align=left>
                                <i class="fa fa-user texto-azul"></i>
                                <font size=2 color=black>
                                    <b>'.$NombreUsuarioChat.'</b>
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
                                <button type="button" class="btn btn-success btn-xs" onClick="chatWith(\''.$NombreUsuarioChat.'\'); PCOJS_OcultarVentanaChat(); "><i class="fa fa-weixin "></i> Chat</button>
                            </td>
                        </tr>
                    ';
                }
            echo '
				</tbody>
				</table>';
        }

    $barra_herramientas_modal='
        <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
    cerrar_dialogo_modal($barra_herramientas_modal);

    echo '</div>';