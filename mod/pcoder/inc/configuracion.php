<?php
/*
=====================================================================
   PBROWSER (Practico Browser)
   Sistema Simple de Navegacion por Proxy basado en PHP
   Copyright (C) 2013  John F. Arroyave Gutiérrez
                       unix4you2@gmail.com
                       www.practico.org

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