#!/bin/bash
#	 _
#	|_) _ _  _ _|_. _ _					  	Copyright (C) 2012-2022
#	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
#	  www.practico.org					  	unix4you2@gmail.com
#                                            All rights reserved.
#    
#	 This program is free software: you can redistribute it and/or modify
#	 it under the terms of the GNU General Public License as published by
#	 the Free Software Foundation, either version 3 of the License, or
#	 (at your option) any later version.
#
#	 This program is distributed in the hope that it will be useful,
#	 but WITHOUT ANY WARRANTY; without even the implied warranty of
#	 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#	 GNU General Public License for more details.
#
#	 You should have received a copy of the GNU General Public License
#	 along with this program.  If not, see <http://www.gnu.org/licenses/>
#	 
#	            --- TRADUCCION NO OFICIAL DE LA LICENCIA ---
#
#     Esta es una traducción no oficial de la Licencia Pública General de
#     GNU al español. No ha sido publicada por la Free Software Foundation
#     y no establece los términos jurídicos de distribución del software 
#     publicado bajo la GPL 3 de GNU, solo la GPL de GNU original en inglés
#     lo hace. De todos modos, esperamos que esta traducción ayude a los
#     hispanohablantes a comprender mejor la GPL de GNU:
#	 
#     Este programa es software libre: puede redistribuirlo y/o modificarlo
#     bajo los términos de la Licencia General Pública de GNU publicada por
#     la Free Software Foundation, ya sea la versión 3 de la Licencia, o 
#     (a su elección) cualquier versión posterior.
#
#     Este programa se distribuye con la esperanza de que sea útil pero SIN
#     NINGUNA GARANTÍA; incluso sin la garantía implícita de MERCANTIBILIDAD
#     o CALIFICADA PARA UN PROPÓSITO EN PARTICULAR. Vea la Licencia General
#     Pública de GNU para más detalles.
#
#     Usted ha debido de recibir una copia de la Licencia General Pública de
#     GNU junto con este programa. Si no, vea <http://www.gnu.org/licenses/>

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