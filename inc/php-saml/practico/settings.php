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
	Title: Modulo SSO-SAML
	Establece configuraciones para conectores SAML
*/
include_once '../../../core/configuracion.php';
// Inicia las conexiones con la BD y las deja listas para las operaciones
include_once '../../../core/conexiones.php';
// Incluye definiciones comunes de la base de datos
include_once '../../../inc/practico/def_basedatos.php';
// Incluye archivo con algunas funciones comunes usadas por la herramienta
include_once '../../../core/comunes.php';

//Toma el primer conector SAML definido
$RegistroConectorSAML=PCO_EjecutarSQL("SELECT * FROM core_samlconector WHERE activado='S' LIMIT 0,1 ")->fetch();

//Asigna los valores del conector a las variables usadas por la libreria php-saml
$spBaseUrl = $RegistroConectorSAML["sp_baseurl"];

$settingsInfo = array (
    'sp' => array (
        'entityId' => $spBaseUrl.$RegistroConectorSAML["sp_entity_id"],
        'assertionConsumerService' => array (
            'url' => $spBaseUrl.$RegistroConectorSAML["sp_assertion_consumer_service"],
        ),
        'singleLogoutService' => array (
            'url' => $spBaseUrl.$RegistroConectorSAML["sp_single_logout_service"],
        ),
        'NameIDFormat' => $RegistroConectorSAML["sp_nameid_format_full"],
    ),
    'idp' => array (
        'entityId' => $RegistroConectorSAML["idp_entityid"],
        'singleSignOnService' => array (
            'url' => $RegistroConectorSAML["idp_single_signon_service"],
        ),
        'singleLogoutService' => array (
            'url' => $RegistroConectorSAML["idp_single_logout_service"],
        ),
        'x509cert' => $RegistroConectorSAML["idp_x509cert"],
    ),
);