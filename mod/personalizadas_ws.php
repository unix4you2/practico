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