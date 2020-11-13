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

    Generador de archivos XML durante empaquetamiento y distribucion
*/
    
    include_once '../core/configuracion.php';
    include_once '../core/conexiones.php';
    include_once '../inc/practico/def_basedatos.php';
    include_once '../core/comunes.php';

    // Establece la zona horaria por defecto para la aplicacion
    date_default_timezone_set($ZonaHoraria);
    
    // Datos de fecha, hora y direccion IP para algunas operaciones
    $PCO_FechaOperacion=date('Ymd');
    $PCO_FechaOperacionGuiones=date('Y-m-d');
    $PCO_HoraOperacion=date('His');
    $PCO_HoraOperacionPuntos=date('H:i');

    //Exporta los formularios
    PCO_ExportarDefinicionesXML("Frm","-10000-0","XML_IdEstatico");

    //Exporta los informes
    PCO_ExportarDefinicionesXML("Inf","-10000-0","XML_IdEstatico");