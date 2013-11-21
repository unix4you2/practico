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

	<pre>
	<b>Importante: Si usted esta visualizando este mensaje en su navegador,
	entonces PHP no esta instalado correctamente en su servidor web!</b>
	</pre>
	*/

	/*
		Title: Nucleo de WebServices
		Ubicacion *[core/ws_nucleo.php]*.  Archivo con la validacion de llamados a WebServices
		
		El consumo de los web services es validado sobre el motor principal (index.php) que genera cada pagina durante la ejecucion
		Este archivo es incluido desde alli para validar el estado de webservices cada vez que se ejecute la aplicacion
	*/


	// Bypass para casos de URI de redireccion para Google Oauth2
	$ByPassWS=0;
	if (@$WSId=='autenticacion_oauth')
		$ByPassWS=1;

	// Verifica si se trata de un llamado por web-services
	$ModoWSActivado=0;
	if (@$WSOn==1)
		{
			// Verifica si se ha recibido una llave
			if (@$WSKey!="" || $ByPassWS)
				{
					// Verifica si se ha recibido un identificador de servicio
					if (@$WSId!="")
						{
							// Incluye las llaves definidas
							if (!file_exists("core/ws_llaves.php")) mensaje($MULTILANG_WSErrTitulo,$MULTILANG_WSErr02,'','icono_error.png','TextosEscritorio');
							else include_once("core/ws_llaves.php");
							// Agrega llave del sistema de manera predeterminada a la lista de llaves permitidas, no deberia ser vacia o de lo contrario los WS no entraran
							$Auth_WSKeys[]=$LlaveDePaso;
							// Verifica validez de la llave recibida para el webservice
							if(in_array($WSKey, $Auth_WSKeys,true) || $ByPassWS)
								$ModoWSActivado=1;
							// Si la llave es correcta incluye los webservices de la herramienta y los del usuario, sino presenta error
							if ($ModoWSActivado)
								{
									if (!file_exists("core/ws_funciones.php")) mensaje($MULTILANG_WSErrTitulo,$MULTILANG_WSErr03,'','icono_error.png','TextosEscritorio');
									else
										{
											ob_clean(); //Limpia salida antes de llamar los WS
											include_once("core/ws_funciones.php");
											include_once("mod/personalizadas_ws.php");
										}
								}
							else
								mensaje($MULTILANG_WSErrTitulo,$MULTILANG_WSErr01,'','icono_error.png','TextosEscritorio');	
						}
					else
						mensaje($MULTILANG_WSErrTitulo,$MULTILANG_WSErr05,'','icono_error.png','TextosEscritorio');
				}
			else
				mensaje($MULTILANG_WSErrTitulo,$MULTILANG_WSErr04,'','icono_error.png','TextosEscritorio');	
			die(); // Finaliza script para presentar solo el resultado del WebService ejecutado
		}

