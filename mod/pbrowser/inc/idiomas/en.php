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
		Title: Idioma ingles para modulo de PBrowser
		Ubicacion *[/inc/idioma/en.php]*.  Incluye la definicion de variables utilizadas para presentar mensajes en el idioma correspondiente
		NOTAS IMPORTANTES:
			* Por cuestiones de rendimiento se recomienda la definicion usando comillas simples.
			* Usar las dobles solo cuando se requieran variables o caracteres especiales.
			* Se pueden definir cadenas en funcion de otras definidas con anterioridad
			* Se puede hacer uso de notacion HTML dentro de las cadenas para dar formato
	*/

	// Cadena que describe el archivo de idioma para su escogencia
	$MULTILANG_DescripcionIdioma='Ingles - English';

	//Lexico general
	$MULTILANG_PBROWSER_Cerrar='Close';
	$MULTILANG_PBROWSER_DireccionWeb='Enter a web address here';
	$MULTILANG_PBROWSER_Anonimo='Anonymous';
	$MULTILANG_PBROWSER_En='In';
	$MULTILANG_PBROWSER_Entrar='Login';
	$MULTILANG_PBROWSER_Config='Settings';

	//Configuraciones de navegacion
	$MULTILANG_PBROWSER_PanelConfig='Browser options';
	$MULTILANG_PBROWSER_ConfigQueHace='What does this settings?';
	$MULTILANG_PBROWSER_ConfigDes='This settings allow you to simulate the browser settings that are used to load web pages and another things like type of navigation, character codification, etc.';
	$MULTILANG_PBROWSER_MiniformFull='Include a form to enter a web address in the top of the web';
	$MULTILANG_PBROWSER_RemoverScriptFull='Remove client side scripts (ie. JavaScript)';
	$MULTILANG_PBROWSER_CookiesFull='Allow cookies storage';
	$MULTILANG_PBROWSER_CookiesOtroFull='Storage cookies for this session only';
	$MULTILANG_PBROWSER_ImagenesFull='Load images on the web site';
	$MULTILANG_PBROWSER_ReferenciaFull='See the actual referer site';
	$MULTILANG_PBROWSER_Rotate13Full='Use an ROT13 codification in the address';
	$MULTILANG_PBROWSER_Base64Full='Use a base64 codification in the address';
	$MULTILANG_PBROWSER_MetaTagsFull='Avoid meta tags';
	$MULTILANG_PBROWSER_TituloFull='Avoid page title';
	$MULTILANG_PBROWSER_NavegandoComo='You are browsing as user';
	$MULTILANG_PBROWSER_ResumenLicencia='This tool is Free Software under GNU-GPL v3 license';
	$MULTILANG_PBROWSER_Acerca='About PBrowser';

	//Mensajes de error y varios
	$MULTILANG_PBROWSER_UsuarioClave='Enter your username and password for';
	$MULTILANG_PBROWSER_Usuario='User';
	$MULTILANG_PBROWSER_Clave='Password';
	$MULTILANG_PBROWSER_ErrorTitulo='An error has occured while trying to browse through the proxy';
	$MULTILANG_PBROWSER_ErrorURL='URL Error';
	$MULTILANG_PBROWSER_FalloHost='Failed to connect to the specified host.  Possible problems are that the server was not found, the connection timed out, or the connection refused by the host.  Try connecting again and check if the address is correct.';
	$MULTILANG_PBROWSER_ListaNegra='The URL you are attempting to access is blacklisted by this server. Please select another URL.';
	$MULTILANG_PBROWSER_URLMala='The URL you entered is malformed. Please check whether you entered the correct URL or not.';
	$MULTILANG_PBROWSER_ErrorRecurso='Resource Error';
	$MULTILANG_PBROWSER_ArchivoGrande='The file your are attempting to download is too large.';
	$MULTILANG_PBROWSER_MaximoPosible='Maxiumum permissible file size is ';
	$MULTILANG_PBROWSER_PesoArchivo='Requested file size is ';
	$MULTILANG_PBROWSER_HotLink='It appears that you are trying to access a resource through this proxy from a remote Website. For security reasons, please use the form below to do so.';
	
