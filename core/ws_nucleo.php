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
	if (@$PCO_WSId=='PCO_AutenticacionOauth')
		$ByPassWS=1;

	// Verifica si se trata de un llamado por web-services
	$ModoWSActivado=0;
	if (@$PCO_WSOn==1)
		{
			// Verifica si se ha recibido una llave
			if (@$PCO_WSKey!="" || $ByPassWS)
				{
					// Verifica si se ha recibido un identificador de servicio
					if (@$PCO_WSId!="")
						{
							// Verifica validez de la llave recibida para el webservice
							$llave_ws_valida=0;
							// Verifica si la llave es la misma de instalacion (llave propia)
							if (@$PCO_WSKey==$LlaveDePaso || $ByPassWS)
								{
									$llave_ws_valida=1;
									// Define valores para la llave de instalacion
									$nombre_cliente="Practico";
									$funciones_autorizadas='verificar_credenciales,PCO_AutenticacionOauth';
									$ip_autorizada="*";
									$dominio_autorizado="*";
								}
							else
								{
									// Valida si la llave esta en la BD de API
									$consulta_llave=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_llaves_api." FROM ".$TablasCore."llaves_api WHERE llave=? ","$PCO_WSKey");
									// Si no se retorno error en la consulta y tiene datos hace el fetch
									if($consulta_llave!="1" && $consulta_llave!="")
										$registro_llave = $consulta_llave->fetch();
									// Si encuentra una llave valida entonces su secreto
									if ($registro_llave["llave"]!="")
										{
											if($registro_llave["secreto"]==$PCO_WSSecret)
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
													PCO_Mensaje($MULTILANG_WSErrTitulo,$MULTILANG_WSErr02, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
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
									if (strpos($funciones_autorizadas, $PCO_WSId)!==FALSE || $funciones_autorizadas=="*" || $ByPassWS)
										{
											//Valida si la IP del cliente es una de las autorizadas
											if (@strpos($ip_autorizada, $_SERVER['REMOTE_ADDR'])!==FALSE || $ip_autorizada=="*" || $ByPassWS)
												{
													//Valida si el dominio del cliente es uno de las autorizadas
													if (@strpos($dominio_autorizado, $_SERVER['REMOTE_HOST'])!==FALSE || $dominio_autorizado=="*" || $ByPassWS)
														{
															//Todo OK a este punto
															if (!file_exists("core/ws_funciones.php"))
                                                                PCO_Mensaje($MULTILANG_WSErrTitulo,$MULTILANG_WSErr03, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
															else
																{
																	@ob_clean(); //Limpia salida antes de llamar los WS
																	include_once("core/ws_funciones.php");
																	if (PCO_BuscarErroresSintaxisPHP("mod/personalizadas_ws.php")==0)
																	    include_once("mod/personalizadas_ws.php");
																}
															// Lleva a auditoria
															PCO_Auditar("$PCO_WSId","API.".$nombre_cliente);
														}
													else
														{
                                                            PCO_Mensaje($MULTILANG_WSErrTitulo,$MULTILANG_WSErr08.$_SERVER['REMOTE_HOST'], '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
														}
												}
											else
												{
													PCO_Mensaje($MULTILANG_WSErrTitulo,$MULTILANG_WSErr07.$_SERVER['REMOTE_ADDR'], '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
												}
										}
									else
										{
											PCO_Mensaje($MULTILANG_WSErrTitulo,$MULTILANG_WSErr06.$PCO_WSId, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
										}		
								}
							else
								PCO_Mensaje($MULTILANG_WSErrTitulo,$MULTILANG_WSErr01, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
						}
					else
						PCO_Mensaje($MULTILANG_WSErrTitulo,$MULTILANG_WSErr05, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
				}
			else
				PCO_Mensaje($MULTILANG_WSErrTitulo,$MULTILANG_WSErr04, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
			die(); // Finaliza script para presentar solo el resultado del WebService ejecutado
		}