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

	@session_start();

	include "core/configuracion.php";

	// Determina si trabaja en modo StandAlone y redirecciona a core o sino
	// se queda esperando la accion de Practico para lanzar el modulo
	if ($PCO_PBROWSER_StandAlone==1)
		{
			header("Location: core/");
			die();
		}

	// Valida sesion activa de Practico
	@session_start();
	if (!isset($PCOSESS_SesionAbierta)) 
		{
			echo '<head><title>Error</title><style type="text/css"> body { background-color: #000000; color: #7f7f7f; font-family: sans-serif,helvetica; } </style></head><body><table width="100%" height="100%" border=0><tr><td align=center>&#9827; Acceso no autorizado !</td></tr></table></body>';
			die();
		}

	/* ################################################################## */
	/* ################################################################## */
	/*
		Function: PCO_PBrowser
		Presenta IFrame con el navegador por proxy embebido

		Salida:
			IFrame con contenido generado por la herramienta
	*/
	if ($PCO_Accion=="PCO_PBrowser") 
		{
			header("Location: core/");
			die();
		}

?>
