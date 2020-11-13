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