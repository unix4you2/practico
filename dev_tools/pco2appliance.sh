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

# COMANDOS BASICOS PARA EJECUTAR EN INSTALACIONES TIPO APPLIANCE

# Configuraciones basicas
	RAIZWEBSERVER="/srv/www/htdocs";	#OpenSuSE

# Obtengo la ruta de ejecucion del script
	SCRIPT=$(readlink -f "$0")
	SCRIPTPATH=`dirname "$SCRIPT"`

#Ejecucion al final de creacion de instancia
	cd $RAIZWEBSERVER
	find . -type d -exec chmod 755 {} \;
	find . -type f -exec chmod 644 {} \;
	chown -R wwwrun:www *
	chkconfig apache2 on

#Ejecucion al inicio de cada instancia
	clear
echo Usted puede ingresar mediante un navegador en:
ip addr | grep 'state UP' -A2 | tail -n1 | awk '{print $2}' | cut -f1  -d'/'


	echo "    _                   "
	echo "   |_) _ _  _ _|_. _ _  "
	echo "   |  | (_|(_  | |(_(_) "
	echo "-----------------------------------------------------------------"
	echo "Esta utilidad genera un nuevo paquete de distribucion de Practico"
	echo "Cualquier archivo existente con el mismo nombre sera sobreescrito"
	echo "-----------------------------------------------------------------"

	FECHA=$(date)  # Obtengo la fecha y hora actual



# Me ubico en la ruta inicial del script
	cd $SCRIPTPATH

exit 0  # Finalizo ejecucion normal del script
