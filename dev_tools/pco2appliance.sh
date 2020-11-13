#!/bin/bash

#    _
#   |_) _ _  _ _|_. _ _					  	Copyright (C) 2020
#   |  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
#     www.practico.org					  	unix4you2@gmail.com
#                                           All rights reserved.
#   
#   Redistribution and use in source and binary forms, with or without
#   modification, are permitted provided that the following conditions are met:
#   
#   1. Redistributions of source code must retain the above copyright notice, this
#      list of conditions and the following disclaimer.
#   
#   2. Redistributions in binary form must reproduce the above copyright notice,
#      this list of conditions and the following disclaimer in the documentation
#      and/or other materials provided with the distribution.
#   
#   THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
#   AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
#   IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
#   DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
#   FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
#   DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
#   SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
#   CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
#   OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
#   OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

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