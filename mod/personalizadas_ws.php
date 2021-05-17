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
	
			/*
			Title: Funciones personalizadas para WebServices
			Ubicacion *[/personalizadas_ws.php]*.  Archivo que contiene la declaracion de variables y funciones por parte del usuario o administrador del sistema para la ejecucion de webservices

			Codigo de ejemplo:
				(start code)
					<?php if ($WS=="Mi_WebService") 
						{
							// Mis operaciones a realizar
						}
					?>
				(end)

			Comentario:
			Este archivo solamente es ejecutado ante el llamado de webservices con llave correcta.
			Si desea personalizar funciones de uso general para los usuarios deberia utilizar el archivo personalizadas.php
			Utilice el condicional para diferenciar el web service solicitado y ser asi ejecutado.
			
			Los WebServices disponibles y predefinidos por Practico se encuentran definidos en core/ws_funciones.php pero
			no deberia ser editado pues ante cualquier actualizacion el archivo cambiaria borrando sus web-services.  Use solo este archivo para
			sus funciones personalizadas para webservices garantizando su disponibilidad despues de cada actualizacion de la herramienta.

			El consumo de los web services requiere el envio de los siguientes parametros minimos a la raiz de Practico en cada llamado:
			
			* WS=1: Siempre iniciado en 1 indica a Practico que debe activar el modo de WebServices
			* PCO_WSKey: La llave generada para consumir los WebServices, la llave de paso de instalacion es incluida por defecto
			* PCO_WSId: El identificador unico del metodo o funcion de webservices a llamar
			* OTROS: Parametros adicionales requeridos por la funcion pueden ser enviados por URL o metodo POST al llamar el WebService.

			Ejemplo:  www.sudominio.com/practico/?PCO_WSOn=1&PCO_WSKey=AFSX345DF&PCO_WSId=verificar_credenciales
			*/


if ($PCO_WSId=="Mi_WebService") 
	{


	}