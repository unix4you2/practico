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
    
    #Ver22.9 se deja seguridad e inmutabilidad del lado del servidor.  Permisos restablecidos para facilitar edicion.
    find . -type d -exec chmod 777 {} \;
    find . -type f -exec chmod 777 {} \;

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