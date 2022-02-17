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
Title: Introduccion

	(see ../img/practico_login.png)

	Practico es un proyecto de *software libre publicado bajo licencia GNU GPL v2.0* para la creacion de aplicaciones web de una manera completamente visual, rapida y sin mayores conocimientos previos de programacion.  Su nucleo incorpora los scripts necesarios para una facil instalacion y la generacion dinamica de objetos como formularios, informes, gestion de usuarios y conexion a multiples motores de bases de datos

Section: Principales caracteristicas

	- Escrito completamente en in PHP, HTML+CSS y Javascript.
	- Interfaz de usuario grafica
	- Funciones integradas para operaciones avanzadas
	- Multiplataforma (GNU/Linux, FreeBSD, Microsoft Windows...).
	- Facil de personalizar con sus propias funciones.
	- Paquete liviano y de ejecucion rapida.
	- Funciones Captcha donde son necesarias.
	- Herramientas graficas para definir base de datos, formularios y generacion de reportes.
	- Administracion simplificada de usuarios y permisos.
	- Codigo fuente simple, facil de entender y ajustar.

Section: Instalacion y uso

	- Desempaquete el archivo de instalacion sobre su servidor web:

	(start code)
	   $ tar zxvf practico-<version>.tar.gz
	(end)

	Ingrese mediante su navegador a http://DominioODireccionIP/practico (o la carpeta que haya indicado en su descompresion) y siga las instrucciones del asistente de instalacion


	- _Desinstalacion_:

	Simplemente elimine todas las carpetas asociadas a Practico en su servidor web y elimine la base de datos configurada al momento de instalacion


Section: Aspectos legales

	Se garantiza permiso para copiar, distribuir y modificar este documento segun los terminos de la GNU Free Documentation License, Version 1.3 o cualquiera posteriormente publicada por la Free Software Foundation, sin secciones invariantes ni textos de cubierta delantera o trasera.

	About: Licencia de documentacion
		GNU FDL version 1.3. Toda la documentacion asociada a este proyecto se encuentra liberada bajo los terminos de la *GNU FDL version 1.3* de la Free Software Foundation.  Una copia completa se encuentra disponible en Internet en el enlace: http://www.gnu.org/licenses/fdl-1.3.html

	About: Licencia del aplicativo
		GNU GPL version 2. La herramienta practico ha sido liberada bajo los terminos de la *GNU GPL version 2* de la Free Software Foundation.  Una copia completa se encuentra disponible en Internet en el enlace: http://www.gnu.org/licenses/gpl-2.0.html

Section: Detalles de licenciamiento (AUTHORS)

	(start code)
		John F. Arroyave Gutierrez
		Copyright (c) 2013 John F. Arroyave Gutierrez <unix4you2@gmail.com>
		License GPLv2
		See the LICENSE file for details

		That is the license for the whole package.
		Parts of the package are under other, compatible licenses:

		PCLZip (PhpConcept Library - Zip Module 2.8.2):
			Location: inc/pclzip/pclzip.lib.php:
			License: GNU GPL version 2
			Made by: Vincent Blavet - August 2009
			http://www.phpconcept.net

		CKEditor
			Location: inc/ckeditor / *
			License: GNU General Public License Version 2, or at your choice as LGPL ó MPL
			Made by: Frederico Knabben - Copyright 2003-2011, CKSource
			http://ckeditor.com
			See inc/ckeditor/LICENSE.html for details

		Media files and CSS files under:
				img / *
				skin / *
				ins/img / *
				ins/skin / *
			License: Free Art License or the GNU GPLv2
			Made by: John F. Arroyave Gutierrez
					 or Edited from images released to the public domain
			http://sourceforge.net/projects/practico/
	(end)

*/