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
		Title: Modulo formularios
		Ubicacion *[/core/formularios_post.php]*.  Archivo de ejecucion de funciones asociadas a los post de formularios
	*/


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_EjecutarPostFormulario
	Ejecuta el codigo asociado a la seccion POST de un formulario

	Variables de entrada:

		Formulario - Id unico del formulario del cual se desea evaluar el codigo POST
		Llave - Llave de paso que deberia coincidir con la llave del sistema para poder realizar la operacion
		Otros - Variables que puedan indicar la accion a realizar, los parametros requeridos o cualquier otro control de seguridad o verificacion requerida por el usuario

	Salida:
		Ejecucion del codigo completo encontrado dentro del codigo POST del formulario
*/
	if ($PCO_Accion=="PCO_EjecutarPostFormulario")
		{
			if ($LlaveDePaso==$Llave)
			    {
        			// Busca el registro del formulario
        			$RegistroFormulario=PCO_EjecutarSQL("SELECT id,post_script FROM ".$TablasCore."formulario WHERE id=? ","$Formulario")->fetch();
        			//Si encuentra codigo lo ejecuta
                    if ($RegistroFormulario["id"]!="")
                        {
                            PCO_EvaluarCodigo($RegistroFormulario["post_script"]);
                            //Lleva auditoria de la ejecucion
                            PCO_Auditar("Ejecucion post-accion formulario {$Formulario}","API.Practico");
                        }
			    }
	        die(); //Finaliza ejecucion despues de cualquier tarea
		}