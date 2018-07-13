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
    Title: Documentacion para desarrolladores
    Ubicacion *[/dev_tools/docs/variables.php]*.  Archivo con documentacion general de variables


    Section: Variables de sesion
    Lista de variables de sesion normalmente disponibles en tiempo de ejecucion

    Variables de entrada:

        $PCOSESS_LoginUsuario - Contiene el UID unico del usuario que se encuentra logueado en el sistema
        $PCOSESS_SesionAbierta - Determina si la sesion se ha iniciado correctamente (0=No iniciada, 1=Iniciada)

    Section: Variables generales (Globales)
    Las variables se encuentran disponibles en el entorno global para ser utilizadas en diferentes funciones

        $PCO_ValorBusquedaBD - Para los campos de formulario con boton de busqueda, este es el valor ingresado en el campo y requerido para la consulta del formulario nuevamente
        $PCO_CampoBusquedaBD - Para los campos de formulario con boton de busqueda, este es el campo en la base de datos sobre el cual sera comparada la variable $PCO_ValorBusquedaBD con el fin de retornar el registro unico (o en casos de varios registros coincidentes solo el primero).
        $PCO_FechaOperacion - Fecha de ejecucion del script en formato AAAMMDD
        $PCO_FechaOperacionGuiones - Fecha de ejecucion del script en formato AAA-MM-DD
        $PCO_HoraOperacion - Hora de ejecucion del script en formato HHMMSS
        $PCO_HoraOperacionPuntos - Hora de ejecucion del script en formato HH:MM:SS

    Section: Variables de mensajes en el escritorio (Globales)
    Las variables se encuentran disponibles en el entorno global para ser utilizadas en diferentes funciones asi como pueden ser definidas mediante campos visibles u ocultos dentro de formularios para ser transportadas en su siguiente llamado.

        $PCO_ErrorTitulo - Titulo para el cuadro de mensaje de error o informacion
        $PCO_ErrorDescripcion - Mensaje con la descripcion del error o mensaje
        $PCO_ErrorIcono - Icono deseado para el mensaje (soportado solo FontAwesome). Cuando no se recibe un valor por defecto se utiliza el icono fa-thumbs-down
        $PCO_ErrorEstilo - Estilo BootStrap deseado [alert-info|alert-warning|alert-default|alert-primary|alert-success|alert-danger].  Cuando no se recibe un valor por defecto se utiliza el estilo CSS alert-danger
        $PCO_ErrorAutoclose - Intenta cerrar la ventana de trabajo actual despues de presentar un mensaje de error o informacion deterimnado en el escritorio.
        $PCO_ErrorDetener - Detiene la ejecucion del script justo despues de presentar un mensaje en el escritorio.  Util para presentar mensajes en fullscreen despues de ejecutar una operacion.

    Section: Variables de control de flujo del programa
    Las variables se encuentran disponibles en el entorno global para ser utilizadas en diferentes funciones asi como pueden ser definidas mediante campos visibles u ocultos dentro de formularios para ser transportadas en su siguiente llamado.

		$PCO_Accion - Define la accion que sera ejecutada en el momento.  Puede ser interna o personalizada
		$PCO_PostAccion - Disponible en almacenamiento de datos de formulario permite redireccionar el flujo a otra accion diferente despues que la operacion es realizada.  Es decir, se convierte posteriormente en PCO_Accion
		$PCO_ValorCampoTransporte1, $PCO_ValorCampoTransporte1, $PCO_NombreCampoTransporte2, $PCO_ValorCampoTransporte2 - Disponible en almacenamiento de datos de formulario permiten definir variables adicionales que serán pasadas a la siguiente acción. 

    */