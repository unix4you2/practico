<?php
/*
=====================================================================
   PBROWSER (Practico Browser)
   Sistema Simple de Navegacion por Proxy basado en PHP
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


	/*	Define si PCoder se ejecuta en modo StandAlone (Independiente)
		para cualquier proyecto o servidor o como un modulo de Practico
		Posibles Valores:  1=StandAlone   0=Modulo de Practico        */
	$PCO_PCODER_StandAlone=0;


	/*	Define el Path inicial sobre el cual el usuario puede navegar
		por el sistema de archivos del servidor para editarlos. A mayor
		numero de carpetas a leer sera mas lenta la apertura del editor.
		Posibles valores:	/							-> Todo su disco!!!
							.							-> Directorio Actual de PCoder (generalmente sobre mod/pcoder)
							../							-> Raiz de PCoder (generalmente sobre mod/pcoder/mod)
							../../						-> Raiz de PCoder (Donde reside LICENSE, AUTHORS, Etc)
							../../../  					-> Raiz Instalacion PCoder cuando es independiente o Raiz de Practico si esta como modulo
							Otros						-> Agregue aqui tantos niveles superiores como desee segun su ruta de instalacion
							$_SERVER['DOCUMENT_ROOT']	-> Raiz de Todo el servidor web  */
	$PCO_PCODER_RaizExploracionArchivos=$_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR;

	$ZonaHoraria='America/Bogota';
	$IdiomaPredeterminado='es';