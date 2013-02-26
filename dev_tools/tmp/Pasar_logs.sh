#!/bin/bash

#	Copyright (C) 2013  John F. Arroyave Gutiérrez
#						unix4you2@gmail.com

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

# Mensajes de inicio e introduccion al script
	clear
	echo "     _                  "
	echo "    |_) _ _  _ _|_. _ _ "
	echo "    |  | (_|(_  | |(_(_)"
	echo "-----------------------------------------------------------------"
	echo "Esta utilidad convierte los logs de formato Git y los pasa a     "
	echo "codeswarm, quien los interpreta para generar el video asociado   "
	echo "-----------------------------------------------------------------"

# Obtengo la ruta de ejecucion del script
	SCRIPT=$(readlink -f "$0")
	SCRIPTPATH=`dirname "$SCRIPT"`
	# Me ubico en la ruta del script y subo dos niveles
	cd $SCRIPTPATH
	cd ..

git log --name-status --pretty=format:'%n------------------------------------------------------------------------ %nr%h | %ae | %ai (%aD) | x lines%nChanged paths: %N' > actividad_practico.log 



