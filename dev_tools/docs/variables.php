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
		$PCO_NombreCampoTransporte1, $PCO_ValorCampoTransporte1, $PCO_NombreCampoTransporte2, $PCO_ValorCampoTransporte2 - Disponible en almacenamiento de datos de formulario permiten definir variables adicionales que serán pasadas a la siguiente acción. 

    */