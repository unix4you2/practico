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