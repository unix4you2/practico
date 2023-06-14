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
																	
																	//Determina si el endpoint/metodo a ejecutar esta definido en BD de metodos
																	//y si lo encuentra lo prefiere por encima de cualquier inclusion desde archivo
																	//En caso de no encontrarlo hace la inclusion tradicional del archivo por compatibilidad
																	$PCO_RegistroMetodoEnBD=PCO_EjecutarSQL("SELECT * FROM core_llaves_metodo WHERE nombre='{$PCO_WSId}' ")->fetch();
																	if ($PCO_RegistroMetodoEnBD["id"]!="")
																	    {
																	        $PCO_ListaErrores_Parametros="";    //Contiene los errores encontrados en los parametros recibidos
																	        
																	        //Busca si el endpoint o servicio cuenta con parametros definidos y hace las validaciones correspondientes a cada uno
																	        $IdEndpointWS=$PCO_RegistroMetodoEnBD["id"];
																	        $PCO_ResultadoParametros=PCO_EjecutarSQL("SELECT * FROM core_llaves_metodoparametro WHERE metodo='{$IdEndpointWS}' ");
																	        //Recorre todos los parametros, los pasa a globales para su uso y valida sus restricciones
																	        while ($PCO_RegistroParametrosWS=$PCO_ResultadoParametros->fetch())
																	            {
																	                if (trim($PCO_RegistroParametrosWS["nombre"])!="")
																	                    {
																	                        global ${$PCO_RegistroParametrosWS["nombre"]};

																	                        //Valida obligatoriedad
																	                        if ($PCO_RegistroParametrosWS["obligatorio"]=="S" && trim(${$PCO_RegistroParametrosWS["nombre"]})=="")
																	                            $PCO_ListaErrores_Parametros=$PCO_RegistroParametrosWS["nombre"].": es obligatorio";
																	                        
																	                        //Valida longitud maxima
																	                        if ($PCO_RegistroParametrosWS["longitud"]!="0" && strlen(trim(${$PCO_RegistroParametrosWS["nombre"]}))>$PCO_RegistroParametrosWS["longitud"])
																	                            $PCO_ListaErrores_Parametros=$PCO_RegistroParametrosWS["nombre"].": longitud maxima permitida es ".$PCO_RegistroParametrosWS["longitud"];
																	                        
																	                        //Valida los tipos de dato recibidos
																	                        if ($PCO_RegistroParametrosWS["tipo_dato"]!="Cualquiera")
																	                            {
																	                                if ($PCO_RegistroParametrosWS["tipo_dato"]=="Cadena" && gettype(${$PCO_RegistroParametrosWS["nombre"]})!="string")
																	                                    $PCO_ListaErrores_Parametros=$PCO_RegistroParametrosWS["nombre"].": tipo de dato no es ".$PCO_RegistroParametrosWS["tipo_dato"];

																	                                if ($PCO_RegistroParametrosWS["tipo_dato"]=="Booleano (0-1)" && trim(${$PCO_RegistroParametrosWS["nombre"]})!="0" && trim(${$PCO_RegistroParametrosWS["nombre"]})!="1")
																	                                    $PCO_ListaErrores_Parametros=$PCO_RegistroParametrosWS["nombre"].": tipo de dato no es ".$PCO_RegistroParametrosWS["tipo_dato"];

																	                                if ($PCO_RegistroParametrosWS["tipo_dato"]=="Entero" && !is_numeric(${$PCO_RegistroParametrosWS["nombre"]}))
																	                                    $PCO_ListaErrores_Parametros=$PCO_RegistroParametrosWS["nombre"].": tipo de dato no es ".$PCO_RegistroParametrosWS["tipo_dato"];

																	                                if ($PCO_RegistroParametrosWS["tipo_dato"]=="Decimal" && !is_numeric(${$PCO_RegistroParametrosWS["nombre"]}))
																	                                    $PCO_ListaErrores_Parametros=$PCO_RegistroParametrosWS["nombre"].": tipo de dato no es ".$PCO_RegistroParametrosWS["tipo_dato"];

																	                                if ($PCO_RegistroParametrosWS["tipo_dato"]=="JSON" && json_decode(${$PCO_RegistroParametrosWS["nombre"]})==null)
																	                                    $PCO_ListaErrores_Parametros=$PCO_RegistroParametrosWS["nombre"].": tipo de dato no es ".$PCO_RegistroParametrosWS["tipo_dato"];
																	                                    
																	                               // TODO: Validar que sea un XML valido
																	                               // if ($PCO_RegistroParametrosWS["tipo_dato"]=="XML" && json_decode(${$PCO_RegistroParametrosWS["nombre"]})==null)
																	                               //     {
																	                               //         $ContenidoXML = new XMLReader();
																	                               //         if (!$ContenidoXML->xml(trim(${$PCO_RegistroParametrosWS["nombre"]}), NULL, LIBXML_DTDVALID))
    																	                           //             $PCO_ListaErrores_Parametros=$PCO_RegistroParametrosWS["nombre"].": tipo de dato no es ".$PCO_RegistroParametrosWS["tipo_dato"];
																	                               //     }
																	                            }
																	                    }
																	            }
																	        
																	        //Ejecuta el codigo asociado al servicio si no se encontraron errores
																	        if ($PCO_ListaErrores_Parametros=="")
																	            {
                                                                                    //Aumenta estadistica de ejecucion
																	                PCO_EjecutarSQLUnaria("UPDATE core_llaves_metodo SET total_ejecuciones=total_ejecuciones+1 WHERE id='{$IdEndpointWS}' ");

                                                                    		        //Evalua si el codigo ya inicia con <?php y sino lo agrega
                                                                    		        $ComplementoInicioScript="";
                                                                    		        if (substr(trim($PCO_RegistroMetodoEnBD["script"]),0,5)!='<?php')
                                                                    		            $ComplementoInicioScript="<?php\n";
                                                                    		        PCO_EvaluarCodigo($ComplementoInicioScript.$PCO_RegistroMetodoEnBD["script"],1,"Detalles: EndPoint ID=".$PCO_RegistroMetodoEnBD["nombre"],0);
																	            }
																	        else
																	            {
                                                                                    PCO_Mensaje($MULTILANG_WSErrTitulo."[Cod. 09] en parametros",$PCO_ListaErrores_Parametros, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
																	            }
																	    }
																    else
																        {
                                                                            //Hace la inclusion tradicional del archivo por compatibilidad hacia atras
        																	if (PCO_BuscarErroresSintaxisPHP("mod/personalizadas_ws.php")==0)
        																	    include_once("mod/personalizadas_ws.php");
																	    }
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