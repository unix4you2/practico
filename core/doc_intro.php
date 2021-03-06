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

