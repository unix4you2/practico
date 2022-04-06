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