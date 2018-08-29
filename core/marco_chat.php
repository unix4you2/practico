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
        PCO_AbrirDialogoModal("Dialogo_Chat",$MULTILANG_UsrLista,"modal-wide");

			/*Determina el tipo de filtro a aplicar al informe segun el nivel de chat activado
			  1=Solo entre usuarios internos
			  2=Solo entre usuarios externos  */
			$PCOVAR_FiltroUsuariosChat="";  //$Activar_ModuloChat==3
			if ($Activar_ModuloChat==1)
			    $PCOVAR_FiltroUsuariosChat="1";
			if ($Activar_ModuloChat==2)
			    $PCOVAR_FiltroUsuariosChat="0";
			    
            echo $MULTILANG_UsuariosChat;
            //Consulta los usuarios siempre y cuando tenga sesion activa
            if ($PCOSESS_SesionAbierta)
            	PCO_CargarInforme(-20,0,"","",1);

            $barra_herramientas_modal='
                <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';

        PCO_CerrarDialogoModal($barra_herramientas_modal);

    echo '</div>';