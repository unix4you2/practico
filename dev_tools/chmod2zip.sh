#!/bin/bash

#	Copyright (C) 2013  John F. Arroyave Gutiérrez
#						unix4you2@gmail.com
#						www.practico.org

#	This program is free software; you can redistribute it and/or
#	modify it under the terms of the GNU General Public License
#	as published by the Free Software Foundation; either version 2
#	of the License, or (at your option) any later version.

#	This program is distributed in the hope that it will be useful,
#	but WITHOUT ANY WARRANTY; without even the implied warranty of
#	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#	GNU General Public License for more details.

#	You should have received a copy of the GNU General Public License
#	along with this program; if not, write to the Free Software
#	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

# Ajuste de permisos a directorios y archivos de Practico previo a su distribucion
# Este script asume su ejecucion desde la raiz de Practico

	echo "================================================================="
    echo "                        AJUSTANDO PERMISOS"
	echo "-----------------------------------------------------------------"
    echo " Carpetas=755  Archivos=644  Propietario=www-data|www|apache|http"
	echo "================================================================="

    find . -type d -exec chmod 755 {} \;
    find . -type f -exec chmod 644 {} \;
    find . -name "*.sh" -exec chmod 777 {} \;
    
    #Permisos de carpetas en tiempo de instalacion
    chmod 777 bkp
    chmod 777 core
    chmod 777 tmp
    chmod 777 ins
    chmod 777 mod/pcoder/demo.php
    chmod -R 777 mod/pcc_erp/*
    
    #Permisos de archivos basicos de configuracion
    chmod 777 core/configuracion.php
    chmod 777 core/ws_oauth.php

    #chown -R www-data *
    #chown -R www *
    #chown -R apache *
    #chown -R http *
    #chown -R root *
