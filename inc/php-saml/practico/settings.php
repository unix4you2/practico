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