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
		Title: SOPA - Social Parser
		Ubicacion *[/mod/sopa/index.php]*.  Archivo que contiene las funciones de enlace al modulo de Social Parser
        
        Este modulo permite hacer el parsing de redes sociales de usuarios especificos hacia tablas de la aplicacion

		Section: Modulos complementarios
	*/

	// Valida sesion activa de Practico
	@session_start();
	if (!isset($PCOSESS_SesionAbierta)) 
		{
			echo '<head><title>Error</title><style type="text/css"> body { background-color: #000000; color: #7f7f7f; font-family: sans-serif,helvetica; } </style></head><body><table width="100%" height="100%" border=0><tr><td align=center>&#9827; Acceso no autorizado !</td></tr></table></body>';
			die();
		}

	// Configuraciones basicas del modulo
	$SOPA_raiz_modulo = "mod/sopa/";
	$SOPA_modelos = $SOPA_raiz_modulo."modelo/";
	$SOPA_vistas = $SOPA_raiz_modulo."vista/";
	$SOPA_controladores = $SOPA_raiz_modulo."controlador/";
	$SOPA_idiomas = $SOPA_raiz_modulo."idiomas/";

    //Llamar al controlador inicial de la aplicacion o modulo
    require($SOPA_modelos.'modelo.php');
    require($SOPA_vistas.'vista.php');
    require($SOPA_controladores.'controlador.php');
