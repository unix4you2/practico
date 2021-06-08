<?php
/**
 *  SAML Handler
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
        $returnTo = null;
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
        $_SESSION['samlNameId'] = $auth->getNameId();
        $_SESSION['samlNameIdFormat'] = $auth->getNameIdFormat();
        $_SESSION['samlNameIdNameQualifier'] = $auth->getNameIdNameQualifier();
        $_SESSION['samlNameIdSPNameQualifier'] = $auth->getNameIdSPNameQualifier();
        $_SESSION['samlSessionIndex'] = $auth->getSessionIndex();
        
        
        //samlNameId
        //samlSessionIndex
        //RelayState

        
        unset($_SESSION['AuthNRequestID']);
        if (isset($_POST['RelayState']) && OneLogin_Saml2_Utils::getSelfURL() != $_POST['RelayState'])
            {
                $auth->redirectTo($_POST['RelayState']);
            }
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
    
        echo '<p><a href="?slo" >Logout</a></p>';
        
        var_dump($_SESSION['samlUserdata']);
    }



########################################################################
########################################################################
## PRESENTADO A QUIENES LLEGAN A LA OPCION SIN LOGIN O SESION ACTIVA  ##
if (!isset($_SESSION['samlUserdata']))
    {
        //Recorre todos los conectares SAML para agregar la opcion
        include_once '../../../core/configuracion.php';
        // Inicia las conexiones con la BD y las deja listas para las operaciones
        include_once '../../../core/conexiones.php';
        // Incluye definiciones comunes de la base de datos
        include_once '../../../inc/practico/def_basedatos.php';
        // Incluye archivo con algunas funciones comunes usadas por la herramienta
        include_once '../../../core/comunes.php';
        
        //Toma el primer conector SAML definido
        $ResultadoConectorSAML=PCO_EjecutarSQL("SELECT * FROM core_samlconector WHERE activado='S' ORDER BY nombre_conector LIMIT 0,1 ");
        //Aunque solo es uno el proceso se hace en un while para descartar si no hubo ninguno o si en futuro hay varios
        $ListaOpcionesConector="";
        while ($RegistroConectorSAML=$ResultadoConectorSAML->fetch())
            {
                $Nombre=$RegistroConectorSAML["nombre_conector"];
                $ImagenConector="";
                if ($RegistroConectorSAML["ruta_logo"]!="")
                    {
                        $ImagenConector=explode("|",$RegistroConectorSAML["ruta_logo"]);
                        $ImagenConector=$ImagenConector[0];
                        $ImagenConector="<img style='border-radius: 5%;' width='50' height='50' src='../../../{$ImagenConector}'>";
                    }
                $Enlace="?sso";
                $ListaOpcionesConector.="
                    <br><a href='{$Enlace}' style='text-decoration:none;'>
                        <div>
                            {$ImagenConector}
                        </div>
                        <div>
                            {$Nombre}
                        </div>
                    </a>";
            }
        $MensajeLogin="{$ListaOpcionesConector}<br>";
        PCO_SAML_MensajeBasico("&#9911; Acceso SSO &#9911; </b>&nbsp;Conectores SAML disponibles<b>",$MensajeLogin,"#e81974","darkgray",1,1); //Tit,Msj,Color,Fondo,Head,ClsBuff
    }
