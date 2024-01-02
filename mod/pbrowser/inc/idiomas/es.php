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
    
		Title: Idioma espanol para modulo de PBrowser
		Ubicacion *[/inc/idioma/es.php]*.  Incluye la definicion de variables utilizadas para presentar mensajes en el idioma correspondiente
		NOTAS IMPORTANTES:
			* Por cuestiones de rendimiento se recomienda la definicion usando comillas simples.
			* Usar las dobles solo cuando se requieran variables o caracteres especiales.
			* Se pueden definir cadenas en funcion de otras definidas con anterioridad
			* Se puede hacer uso de notacion HTML dentro de las cadenas para dar formato
	*/

	// Cadena que describe el archivo de idioma para su escogencia
	$MULTILANG_PBROWSER_DescripcionIdioma='Espanol - Spanish';

	//Lexico general
	$MULTILANG_PBROWSER_Cerrar='Cerrar';
	$MULTILANG_PBROWSER_DireccionWeb='Ingrese aqui una direccion web';
	$MULTILANG_PBROWSER_Anonimo='Anonimo';
	$MULTILANG_PBROWSER_En='En';
	$MULTILANG_PBROWSER_Entrar='Entrar';
	$MULTILANG_PBROWSER_Config='Configuraciones';

	//Configuraciones de navegacion
	$MULTILANG_PBROWSER_PanelConfig='Opciones del navegador';
	$MULTILANG_PBROWSER_ConfigQueHace='Que hacen estas configuraciones?';
	$MULTILANG_PBROWSER_ConfigDes='Estas opciones le permiten simular el comportamiento del navegador que es utilizado para cargar las paginas, asi como algunas preferencias sobre el tipo de navegacion y codificacion de caracteres.';
	$MULTILANG_PBROWSER_MiniformFull='Incluir un formulario para introducir una URL en cada pagina';
	$MULTILANG_PBROWSER_RemoverScriptFull='Remueve los scripts del lado del cliente (ej JavaScript)';
	$MULTILANG_PBROWSER_CookiesFull='Permite almacenar cookies';
	$MULTILANG_PBROWSER_CookiesOtroFull='Almacenar cookies para esta sesion solamente';
	$MULTILANG_PBROWSER_ImagenesFull='Mostrar las imagenes en las paginas';
	$MULTILANG_PBROWSER_ReferenciaFull='Ver el sitio de referencia actual';
	$MULTILANG_PBROWSER_Rotate13Full='Usa codificacion ROT13 en la direccion';
	$MULTILANG_PBROWSER_Base64Full='Usa codificacion base64 en la direccion';
	$MULTILANG_PBROWSER_MetaTagsFull='Obviar etiquetas de metainformacion';
	$MULTILANG_PBROWSER_TituloFull='Obvia el titulo de la pagina web';
	$MULTILANG_PBROWSER_NavegandoComo='Usted esta navegando como usuario';
	$MULTILANG_PBROWSER_ResumenLicencia='Esta herramienta es Software Libre distribuido bajo licencia GNU-GPL v3';
	$MULTILANG_PBROWSER_Acerca='Acerca de PBrowser';

	//Mensajes de error y varios
	$MULTILANG_PBROWSER_UsuarioClave='Entre su usuario y clave para';
	$MULTILANG_PBROWSER_Usuario='Usuario';
	$MULTILANG_PBROWSER_Clave='Clave';
	$MULTILANG_PBROWSER_ErrorTitulo='Ocurrio un error mientras se intentaba navegar a traves del proxy';
	$MULTILANG_PBROWSER_ErrorURL='Error URL';
	$MULTILANG_PBROWSER_FalloHost='Fallo al conectar con el host especificado.  Posibles causas son que el servidor no se encuentra, tiempo de espera agotado, o la conexion fue rechazada por el servidor remoto.  Intente nuevamente verificando que la direccion es correcta.';
	$MULTILANG_PBROWSER_ListaNegra='La URL que usted intenta accesar esta dentro de la lista negra de sitios. Intente con otra.';
	$MULTILANG_PBROWSER_URLMala='La URL que usted ingreso se encuentra mal formada o escrita. Por favor verifiquela.';
	$MULTILANG_PBROWSER_ErrorRecurso='Error en el recurso';
	$MULTILANG_PBROWSER_ArchivoGrande='El archivo que intenta descargar es demasiado grande.';
	$MULTILANG_PBROWSER_MaximoPosible='El maximo posible es';
	$MULTILANG_PBROWSER_PesoArchivo='El archivo solicitado pesa';
	$MULTILANG_PBROWSER_HotLink='Parece que usted intenta accesar un recurso de un sitio remoto a traves de este proxy. Por razones de seguridad, por favor utilice el formulario presentado.';