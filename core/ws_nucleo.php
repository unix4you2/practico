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

	// Bypass para casos de URI de redireccion por Oauth
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
							// Verifica validez de la llave recibida para el webservice
							$llave_ws_valida=0;
							// Verifica si la llave es la misma de instalacion (llave propia)
							if ($WSKey==$LlaveDePaso)
								{
									$llave_ws_valida=1;
									// Define valores para la llave de instalacion
									$nombre_cliente="Practico";
									$funciones_autorizadas='verificar_credenciales,autenticacion_oauth';
									$ip_autorizada="*";
									$dominio_autorizado="*";
								}
							else
								{
									// Valida si la llave esta en la BD de API
									$consulta_llave=ejecutar_sql("SELECT id,".$ListaCamposSinID_llaves_api." FROM ".$TablasCore."llaves_api WHERE llave='$WSKey' ");
									$registro_llave = $consulta_llave->fetch();
									// Si encuentra una llave valida entonces su secreto
									if ($registro_llave["llave"]!="")
										{
											if($registro_llave["secreto"]==$WSSecret)
												{
													$llave_ws_valida=1;
													// Define valores para la llave
													$nombre_cliente=$registro_llave["nombre"];
													$ip_autorizada=$registro_llave["ip_autorizada"];
													$dominio_autorizado=$registro_llave["dominio_autorizado"];
													$funciones_autorizadas=$registro_llave["funciones_autorizadas"];												
												}
											else
												{
													mensaje($MULTILANG_WSErrTitulo,$MULTILANG_WSErr02,'','icono_error.png','TextosEscritorio');
												}
										}
								}

							// Verifica si se tiene una llave valida y activa los WS
							if($llave_ws_valida || $ByPassWS)
								$ModoWSActivado=1;

							// Si la llave es correcta incluye los webservices de la herramienta y los del usuario, sino presenta error
							if ($ModoWSActivado)
								{
									//Valida si tiene acceso a la funcion llamada
									if (strpos($funciones_autorizadas, $WSId)!==FALSE || $funciones_autorizadas=="*" || $ByPassWS)
										{
											//Valida si la IP del cliente es una de las autorizadas
											if (strpos($ip_autorizada, $_SERVER['REMOTE_ADDR'])!==FALSE || $ip_autorizada=="*" || $ByPassWS)
												{
													//Valida si el dominio del cliente es uno de las autorizadas
													if (strpos($dominio_autorizado, $_SERVER['REMOTE_HOST'])!==FALSE || $dominio_autorizado=="*" || $ByPassWS)
														{
															//Todo OK a este punto
															if (!file_exists("core/ws_funciones.php")) mensaje($MULTILANG_WSErrTitulo,$MULTILANG_WSErr03,'','icono_error.png','TextosEscritorio');
															else
																{
																	@ob_clean(); //Limpia salida antes de llamar los WS
																	include_once("core/ws_funciones.php");
																	include_once("mod/personalizadas_ws.php");
																}
															// Lleva a auditoria
															auditar("$WSId","API.".$nombre_cliente);
														}
													else
														{
															mensaje($MULTILANG_WSErrTitulo,$MULTILANG_WSErr08.$_SERVER['REMOTE_HOST'],'','icono_error.png','TextosEscritorio');	
														}
												}
											else
												{
													mensaje($MULTILANG_WSErrTitulo,$MULTILANG_WSErr07.$_SERVER['REMOTE_ADDR'],'','icono_error.png','TextosEscritorio');	
												}
										}
									else
										{
											mensaje($MULTILANG_WSErrTitulo,$MULTILANG_WSErr06.$WSId,'','icono_error.png','TextosEscritorio');	
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
