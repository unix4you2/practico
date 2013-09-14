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
			* WSKey: La llave generada para consumir los WebServices, la llave de paso de instalacion es incluida por defecto
			* WSId: El identificador unico del metodo o funcion de webservices a llamar
			* OTROS: Parametros adicionales requeridos por la funcion pueden ser enviados por URL o metodo POST al llamar el WebService.

			Ejemplo:  www.sudominio.com/practico/?WSOn=1&WSKey=AFSX345DF&WSId=verificar_credenciales
			*/


if ($WSId=="Mi_WebService") 
	{


	}


