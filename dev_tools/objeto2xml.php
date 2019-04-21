<?php
/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2013
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com

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
    Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,MA 02110-1301,USA.

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
