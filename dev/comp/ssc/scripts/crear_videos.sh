#!/bin/bash
#=====================================================================
#                                SISI-CAM
#            Sistema Simple de Grabación de Camaras por Shell
#            Simple System to Record Webcams using only Shell
#        MODULO: Generador de videos AVI a partir de imagenes JPG
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

# Este script pasa las imagenes contenidas en los directorios AAAAMMDD
# a un video con el mismo nombre sobre el directorio de la camara.  Se supone
# que solamente se tienen directorios con imagenes. No deben existir otros!
#
#  motion                         <-- Raiz de instalacion, configuracion y ejecucion de todo (motion,mencoder,scripts,etc)
#   +-- motion.conf               <-- Enlace simbolico a config/motion.conf
#   +-- motion.pid                <-- Archivo de proceso
#   +-- config                    <-- Definicion de configuraciones de motion y de sus camaras
#        +-- motion.conf          <-- Configuracion motion, debe incluir al final los .conf de las camaras
#        +-- camara1.conf
#        +-- camara2.conf
#        +-- camaraN.conf
#       camaras                   <-- Raiz del Script crear_videos.sh
#        +-- crear_videos.sh
#        +-- CarpetaCamara1       <-- Carpeta donde se guardan grabaciones de una camara
#        +-- CarpetaCamara2
#        +-- CarpetaCamaraN
#           +-- 20130930          <-- Carpeta con JPGs de ultimas capturas. Fomrato AAAAMMDD
#           +-- 20130815
#           +-- 20130701.avi      <-- Videos ya procesados
#           +-- 20130702.avi
#---------------------------------------------------------------------

clear
# Obtengo la ruta de ejecucion del script 
SCRIPT=$(readlink -f "$0")
SCRIPTPATH=`dirname "$SCRIPT"`

#Busco todos los directorios que contienen las camaras y sus grabaciones en el directorio actual
for dircamaras in `find $SCRIPTPATH -maxdepth 1 -type d`
    do
	# Se excluye la ruta actual
	if [ $SCRIPTPATH != $dircamaras ]; then
		cd $dircamaras
		# Busco todos los directorios contenidos en la carpeta y se exluyen
	        # los que tienen menos de un dia creados para no tocar el de trabajo actual
		for directorio in `find $SCRIPTPATH -mtime +0 -type d`
	        	do
				# Se excluye la ruta actual
				if [ $SCRIPTPATH != $directorio ]; then
					# Genera el video con el nombre de directorio
					mencoder "mf://$directorio/*.jpg" -mf fps=5 -o $directorio.avi -ovc lavc -lavcopts vcodec=mpeg4
					# Asigna permisos al archivo para poderlo leer sin problemas
					chmod 555 $directorio.avi
					# Elimina el directorio con fotos despues de generar el video
					# PELIGROSO Si hay errores en disco se ejecuta sobre otro Path...  rm -rf $directorio
					# Elimina los archivos de fotos encontrados que comienzan con nombre Evento*
					find $directorio -type f -name "Evento*" -exec rm -f {} \;
					rmdir $directorio
				fi
			done
		# Busca videos de mas de 10 dias (se agrego )
		for video in `find . -name "*.avi" -mtime +13 -type f`
	        	do
				# Elimina el archivo de video
				rm $video
			done
		# Regresa a la carpeta raiz con todas las camaras
		cd ..
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
