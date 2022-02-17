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
	Title: Modulo SSO-SAML
	Establece funciones y captura envios y estados para conectores SAML
*/

session_start();
require_once dirname(__DIR__).'/_toolkit_loader.php';
require_once 'settings.php';

$auth = new OneLogin_Saml2_Auth($settingsInfo);



########################################################################
########################################################################
//Presenta mensajes con un formato basico cuando no se tienen contextos
//completos del framework, maquetaciones, etc.
function PCO_SAML_MensajeBasico($Titulo,$Mensaje,$ColorBarra="darkred",$ColorFondo="lightgray",$IncluirHeaders=0,$LimpiarBuffer=1)
    {
        if ($LimpiarBuffer==1)
            ob_clean();
        //Agrega encabezados completos cuando asi lo requiere la pagina
        if ($IncluirHeaders==1)
            echo "<!DOCTYPE html><body style='margin:0; padding:0; background-color:{$ColorFondo};'>";
        //Imprime mensaje
        echo "
            <center><br>
                <div align=center id='PCOContenedor_MsjSAML' style='font-family: monospace,serif,terminal; font-size:11px; margin:0px; padding:3px; background-color:lightgray; width:98%; box-shadow: 3px 3px 3px gray; border-radius:5px;'>
                    <div align=center id='PCOContenedor_TituloSAML' style='border-radius:3px; margin:3px; padding:5px; color:white; background-color:{$ColorBarra}; box-shadow: 2px 2px 2px {$ColorBarra};'>
                        <b>{$Titulo}</b>
                    </div>
                    <div id='PCOContenedor_MensajeSAML' style='margin:5px;'>
                        {$Mensaje}
                    </div>
                </div>
            </center>";
        //Agrega encabezados completos cuando asi lo requiere la pagina
        if ($IncluirHeaders==1)
            echo '</body></html>';
    }



########################################################################
########################################################################
if (isset($_GET['sso']))
    {
        $auth->login();
        # If AuthNRequest ID need to be saved in order to later validate it, do instead
        // $ssoBuiltUrl = $auth->login(null, array(), false, false, true);
        // $_SESSION['AuthNRequestID'] = $auth->getLastRequestID();
        // $_SESSION['PracticoSAML'] = (string)"SSO_On";
        // header('Pragma: no-cache');
        // header('Cache-Control: no-cache, must-revalidate');
        // header('Location: ' . $ssoBuiltUrl);
        // exit();
    }



########################################################################
########################################################################
if (isset($_GET['slo']))
    {
        $returnTo = "../../../index.php";
        $parameters = array();
        $nameId = null;
        $sessionIndex = null;
        $nameIdFormat = null;
        $samlNameIdNameQualifier = null;
        $samlNameIdSPNameQualifier = null;
    
        if (isset($_SESSION['samlNameId']))
            {
                $nameId = $_SESSION['samlNameId'];
            }
            
        if (isset($_SESSION['samlNameIdFormat'])) 
            {
                $nameIdFormat = $_SESSION['samlNameIdFormat'];
            }
            
        if (isset($_SESSION['samlNameIdNameQualifier'])) 
            {
                $samlNameIdNameQualifier = $_SESSION['samlNameIdNameQualifier'];
            }
            
        if (isset($_SESSION['samlNameIdSPNameQualifier'])) 
            {
                $samlNameIdSPNameQualifier = $_SESSION['samlNameIdSPNameQualifier'];
            }
            
        if (isset($_SESSION['samlSessionIndex']))
            {
                $sessionIndex = $_SESSION['samlSessionIndex'];
            }

        $auth->logout($returnTo, $parameters, $nameId, $sessionIndex, false, $nameIdFormat, $samlNameIdNameQualifier, $samlNameIdSPNameQualifier);
    
        # If LogoutRequest ID need to be saved in order to later validate it, do instead
        # $sloBuiltUrl = $auth->logout(null, $paramters, $nameId, $sessionIndex, true);
        # $_SESSION['LogoutRequestID'] = $auth->getLastRequestID();
        # header('Pragma: no-cache');
        # header('Cache-Control: no-cache, must-revalidate');
        # header('Location: ' . $sloBuiltUrl);
        # exit();
    }



########################################################################
########################################################################
if (isset($_GET['acs']))
    {
        if (isset($_SESSION) && isset($_SESSION['AuthNRequestID'])) 
            {
                $requestID = $_SESSION['AuthNRequestID'];
            } 
        else
            {
                $requestID = null;
            }
            
        $auth->processResponse($requestID);
    
        $errors = $auth->getErrors();
    
        if (!empty($errors))
            {
                echo '<p>',implode(', ', $errors),'</p>';
                if ($auth->getSettings()->isDebugActive())
                    {
                        echo '<p>'.$auth->getLastErrorReason().'</p>';
                    }
            }

        if (!$auth->isAuthenticated())
            {
                PCO_SAML_MensajeBasico("&#9940; No autenticado / Not authenticated &#9940;",$auth->getLastErrorReason(),"darkred","darkgray",1,1); //Tit,Msj,Color,Fondo,Head,ClsBuff
                exit();
            }
    
        $_SESSION['samlUserdata'] = $auth->getAttributes();
        $_SESSION['samlNameId'] = $auth->getNameId();                                   //Variable de interes: Nombre del usuario
        $_SESSION['samlNameIdFormat'] = $auth->getNameIdFormat();
        $_SESSION['samlNameIdNameQualifier'] = $auth->getNameIdNameQualifier();
        $_SESSION['samlNameIdSPNameQualifier'] = $auth->getNameIdSPNameQualifier();
        $_SESSION['samlSessionIndex'] = $auth->getSessionIndex();                       //Variable de interes: Identificador de sesion

        //SE EVITA POR AHORA LA REDIRECCION.  La redireccion del framework es estatica hacia el Menu
        // unset($_SESSION['AuthNRequestID']);
        // if (isset($_POST['RelayState']) && OneLogin_Saml2_Utils::getSelfURL() != $_POST['RelayState'])
        //     {
        //         $auth->redirectTo($_POST['RelayState']);
        //     }
    }



########################################################################
########################################################################
if (isset($_GET['sls']))
    {
        if (isset($_SESSION) && isset($_SESSION['LogoutRequestID'])) 
            {
                $requestID = $_SESSION['LogoutRequestID'];
            }
        else 
            {
                $requestID = null;
            }
    
        $auth->processSLO(false, $requestID);
        $errors = $auth->getErrors();
        if (empty($errors)) 
            {
                echo '<p>Sucessfully logged out</p>';
            }
        else
            {
                echo '<p>', implode(', ', $errors), '</p>';
                if ($auth->getSettings()->isDebugActive()) 
                    {
                        echo '<p>'.$auth->getLastErrorReason().'</p>';
                    }
            }
    }



########################################################################
########################################################################
if (isset($_SESSION['samlUserdata']))
    {
        //Presenta los posibles atributos recibidos para el usuario desde el IdP (Por ahora retirados, no necesarios)
        /*
        if (!empty($_SESSION['samlUserdata'])) 
            {
                $attributes = $_SESSION['samlUserdata'];
                echo 'You have the following attributes:<br>';
                echo '<table><thead><th>Name</th><th>Values</th></thead><tbody>';
                foreach ($attributes as $attributeName => $attributeValues)
                    {
                        echo '<tr><td>' . htmlentities($attributeName) . '</td><td><ul>';
                        foreach ($attributeValues as $attributeValue)
                            {
                                echo '<li>' . htmlentities($attributeValue) . '</li>';
                            }
                        echo '</ul></td></tr>';
                    }
                echo '</tbody></table>';
            }
        else
            {
                echo "<p>You don't have any attribute</p>";
            }
        */

        if (trim($_SESSION['samlNameId'])!="")
            {
                //CODIGO MANTENIDO POR COMPATIBILIDAD, REALMENTE NO SE NECESITA MOSTRAR MENSAJE PUES PASA DIRECTO A HACER EL LOGIN
                // $MensajeLogin="<br>Usted ha ingresado como <b>".$_SESSION['samlNameId']."</b><br>
                //     <br>
                //     <a href='?slo' style='text-decoration:none; background-color:gray; border-radius:3px; color:white; padding:5px;'>&#9194; Salir</a>&nbsp;&nbsp;&nbsp;
                //     <a href='?slo' style='text-decoration:none; background-color:gray; border-radius:3px; color:white; padding:5px;'>Ir a la aplicaci&oacute;n &#9193;</a>
        
                // <br><br>";
                // PCO_SAML_MensajeBasico("&#9989; Acceso SSO Concedido &#9989;",$MensajeLogin,"darkgreen","lightgray",1,1); //Tit,Msj,Color,Fondo,Head,ClsBuff
                
                //Intenta el login con el usuario recibido
                PCO_SAML_EjecutarLogin(trim($_SESSION['samlNameId']));
            }
        else
            {
                PCO_SAML_MensajeBasico("Acceso SSO","ERROR: No se cuenta con un Id de usuario valido desde el IdP","darkred","lightgray",1,1); //Tit,Msj,Color,Fondo,Head,ClsBuff
            }
    }



########################################################################
########################################################################
## PRESENTADO A QUIENES LLEGAN A LA OPCION SIN LOGIN O SESION ACTIVA  ##
if (!isset($_SESSION['samlUserdata']))
    {
        ob_clean();
        header('Location: ../../../index.php');
        exit;

        //CODIGO MANTENIDO POR COMPATIBILIDAD, REALMENTE LAS OPCIONES SSO SON PRESENTADAS POR EL LOGIN DE PRACTICO
        // //Recorre todos los conectares SAML para agregar la opcion
        // include_once '../../../core/configuracion.php';
        // // Inicia las conexiones con la BD y las deja listas para las operaciones
        // include_once '../../../core/conexiones.php';
        // // Incluye definiciones comunes de la base de datos
        // include_once '../../../inc/practico/def_basedatos.php';
        // // Incluye archivo con algunas funciones comunes usadas por la herramienta
        // include_once '../../../core/comunes.php';
        
        // //Toma el primer conector SAML definido
        // $ResultadoConectorSAML=PCO_EjecutarSQL("SELECT * FROM core_samlconector WHERE activado='S' ORDER BY nombre_conector LIMIT 0,1 ");
        // //Aunque solo es uno el proceso se hace en un while para descartar si no hubo ninguno o si en futuro hay varios
        // $ListaOpcionesConector="";
        // while ($RegistroConectorSAML=$ResultadoConectorSAML->fetch())
        //     {
        //         $NombreConectorSSO=$RegistroConectorSAML["nombre_conector"];
        //         $ImagenConectorSSO="";
        //         if ($RegistroConectorSAML["ruta_logo"]!="")
        //             {
        //                 $ImagenConectorSSO=explode("|",$RegistroConectorSAML["ruta_logo"]);
        //                 $ImagenConectorSSO=$ImagenConectorSSO[0];
        //                 $ImagenConectorSSO="<img style='border-radius: 5%;' width='50' height='50' src='../../../{$ImagenConectorSSO}'>";
        //             }
        //         $EnlaceSSO="?sso";
        //         $ListaOpcionesConector.="
        //             <br><a href='{$EnlaceSSO}' style='text-decoration:none;'>
        //                 <div>
        //                     {$ImagenConectorSSO}
        //                 </div>
        //                 <div>
        //                     {$NombreConectorSSO}
        //                 </div>
        //             </a>";
        //     }
        // $MensajeLogin="{$ListaOpcionesConector}<br>";
        // PCO_SAML_MensajeBasico("&#9940; Acceso SSO &#9940; </b>&nbsp;Conectores SAML disponibles<b>",$MensajeLogin,"#e81974","darkgray",1,1); //Tit,Msj,Color,Fondo,Head,ClsBuff
    }