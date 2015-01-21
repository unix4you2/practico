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

    #chown -R www-data *
    #chown -R www *
    #chown -R apache *
    #chown -R http *
    #chown -R root *
