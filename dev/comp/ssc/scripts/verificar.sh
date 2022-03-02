#!/bin/bash
#=====================================================================
#                                SISI-CAM
#            Sistema Simple de Grabación de Camaras por Shell
#            Simple System to Record Webcams using only Shell
#         MODULO: Verificador de videos y grabaciones de camaras
#=====================================================================
#
#    Copyright (C) 2013  John F. Arroyave Gutiérrez
#                        unix4you2@gmail.com
#                        www.practico.org
#
#  This program is free software: you can redistribute it and/or modify
#  it under the terms of the GNU General Public License as published by
#  the Free Software Foundation, either version 3 of the License, or
#  (at your option) any later version.
#
#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.
#
#  You should have received a copy of the GNU General Public License
#  along with this program.  If not, see <http://www.gnu.org/licenses/>
# --------------------------------------------------------------------

#IMPORTANTE:  Se debe tener un referenciador de confianza para la maquina bajo la configuracion de webmin si se desea ver las imagenes previas

# Obtengo la ruta de ejecucion del script 
SCRIPT=$(readlink -f "$0")
SCRIPTPATH=`dirname "$SCRIPT"`

#Busco todos los directorios que contienen las camaras y sus grabaciones en el directorio actual
for dircamaras in `find $SCRIPTPATH -maxdepth 1 -type d`
    do
	echo "<br><hr><font size=4 color=darkblue><b>REVISANDO" $dircamaras ":</b></font><hr>"
	# Se excluye la ruta actual
	if [ $SCRIPTPATH != $dircamaras ]; then
		cd $dircamaras
		echo "<font color=black>"
		echo "<font size=3 color=red><b>Carpetas de trabajo:</b></font>"
		find -maxdepth 1 -name "2*" -type d -printf "<li>Carpeta: <b>%f</b> <i>(Ver muestra de enfoque abajo)</i><br>"
		
		#Busca las ultimas capturas para ver si esta bien enfocada la camara
		for dirtrabajo in `find -maxdepth 1 -name "2*" -type d`
		    do
			cd $dirtrabajo
			listado=`ls | head -1`
			echo "<img border=1 width=320 height=240 src=/updown/fetch.cgi"$dircamaras"/"$dirtrabajo"/"$listado">"
			cd ..
		    done
		echo "<br><font size=3 color=red><b>Videos generados:</b></font>"
		find -maxdepth 1 -type f -printf "<li>Video: <b>%f</b> <i>(%k KB)</i><br>"
		echo "</font>"
	fi
    done
exit

# Bash de supervivencia
# $0: Nombre del Shell-Script que se está ejecutando.
# $n: Parámetros pasados en la posición n, n=1,2,...(formato $#)
# $#: Número de argumentos.
# $*: Lista de todos los argumentos menos $0
# $$: PID del proceso que se está ejecutando.
# $!: PID del último proceso ejecutado.
# $?: Salida del último proceso ejecutado.
# read -p "Entra vble: " vble  Lee por teclado (hace eco)
# read -s -p "Entra vble: " vble  Lee por teclado (no hace eco)
# Leer por lineas:
#   oldIFS=$IFS  #Almacenamos el valor original de la variable IFS
#   IFS=$'\n'    #Cambiamos el valor del IFS
#   for line in $(cat file.txt)
#     do
#       echo $line
#     done
#   IFS=$oldIFS  #Restauramos el IFS
