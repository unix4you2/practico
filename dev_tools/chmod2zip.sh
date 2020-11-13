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
    chmod 777 xml
    chmod 777 pwa
    chmod 777 ins
    chmod 777 mod/pcoder/demos/*
    
    #Permisos de archivos basicos de configuracion
    chmod 777 core/configuracion.php
    chmod 777 core/ws_oauth.php
    chmod 777 pwa/manifest.json

    #chown -R www-data *
    #chown -R www *
    #chown -R apache *
    #chown -R http *
    #chown -R root *

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
#
#Fuentes: patorjk.com/software/taag/  (Favoritas: Small y Standar)