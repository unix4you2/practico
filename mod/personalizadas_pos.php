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