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

# Comprime todos los archivos CSS y JS relacionados para minimizar su 
# peso y optimizar su carga en los navegadores mediante YUI-Compressor
# Este script asume su ejecucion desde la raiz de Practico

# EJEMPLOS DE USO:
    #java -jar yuicompressor-x.y.z.jar myfile.js -o myfile-min.js 
    #java -jar yuicompressor-2.4.8.jar --type css style.css > mini_style.css
    #java -jar yuicompressor-2.4.8.jar --type css -o mini_style.css style.css
    #java -jar yuicompressor-2.4.8.jar --type js nixcraft.js > mini_nixcraft.js

	#for i in ie.css style.css tutorial.css social.css
	#do
	#  java -jar yuicompressor-2.4.8.jar --type css -o "mini_$i" "$i"
	#done


	echo "================================================================="
    echo "             COMPRIMIENDO ARCHIVOS CSS Y JAVASCRIPT"
	echo "================================================================="

# INFORMACION DE ARCHIVOS A PROCESAR
	#Lista de archivos de Hojas de Estilo SIN extension
	ListaArchivosCSS=" inc/bootstrap/css/practico inc/bootstrap/css/monitoreo "
	ExtensionArchivosCSS=".css"
	#Lista de archivos de JavaScript SIN extension
	ListaArchivosJS=" inc/bootstrap/js/practico "
	ExtensionArchivosJS=".js"
	#Prefijo nombre del archivo resultante
	PrefijoArchivo=".min";

# PARAMETROS BASICOS DE APLICACION
	SaltosDeLinea=" "		# --line-break 80 (Genera salto de linea si el codigo pasa la columna especificada)
	SetCaracteres=" "		# --charset utf-8
	NoOfuscarCodigo=" "		# --nomunge  (Solo minimiza, no ofusca o renombra variables)
	MantenerComilla=" " 	# --preserve-semi (Preserva comillas innecesarias por ejemplo a la derecha de '}' )
	NoOptimizar=" "			# --disable-optimizations deshabilita todas las microoptimizaciones

#PROCESA LOS ARCHIVOS
	for i in $ListaArchivosJS
	do
		echo "Optimizando $i$ExtensionArchivosJS"
		java -jar dev_tools/yuicompressor/yuicompressor-2.4.8.jar $SaltosDeLinea $SetCaracteres $NoOfuscarCodigo $MantenerComilla $NoOptimizar --type js -o "$i$PrefijoArchivo$ExtensionArchivosJS" "$i$ExtensionArchivosJS"
	done

	for i in $ListaArchivosCSS
	do
		echo "Optimizando $i$ExtensionArchivosCSS"
		java -jar dev_tools/yuicompressor/yuicompressor-2.4.8.jar $SaltosDeLinea $SetCaracteres $NoOfuscarCodigo $MantenerComilla $NoOptimizar --type css -o "$i$PrefijoArchivo$ExtensionArchivosCSS" "$i$ExtensionArchivosCSS"
	done

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