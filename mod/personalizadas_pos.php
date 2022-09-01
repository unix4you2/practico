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
			Title: Funciones personalizadas
			Ubicacion *[/personalizadas_pos.php]*.  Archivo que contiene la declaracion de variables y funciones por parte del usuario o administrador del sistema que deben ser cargadas justo antes de finalizar la aplicacion

			Codigo de ejemplo:
				(start code)
					<?php if ($PCO_Accion=="Mi_accion_XYZ") 
						{
							// Mis operaciones a realizar
						}
					?>
				(end)

			Comentario:
			Agregue en este archivo las funciones o acciones que desee vincular a menues especificos o realizacion de operaciones internas.
			Utilice el condicional para diferenciar la accion recibida y ser asi ejecutada. Puede vincularlos mediante forms.

            Por favor considere la construccion de un nuevo modulo antes que implementar rutinas sobre este archivo
            Please consider to build a new module before to deploy rutines in this file
            
            IMPORTANTE: Muchas de estas acciones podrían ser realizadas directamente sobre los scripts POST de formularios e informes
                        ofreciendo un mayor encapsulamiento y portabilidad de las funcionalidades cuando se hagan despliegues a produccion.
            */

if ($PCO_Accion=="Mi_AccionPoscarga_XYZ") 
	{


	}

?>