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
		java -jar dev/yuicompressor/yuicompressor-2.4.8.jar $SaltosDeLinea $SetCaracteres $NoOfuscarCodigo $MantenerComilla $NoOptimizar --type js -o "$i$PrefijoArchivo$ExtensionArchivosJS" "$i$ExtensionArchivosJS"
	done

	for i in $ListaArchivosCSS
	do
		echo "Optimizando $i$ExtensionArchivosCSS"
		java -jar dev/yuicompressor/yuicompressor-2.4.8.jar $SaltosDeLinea $SetCaracteres $NoOfuscarCodigo $MantenerComilla $NoOptimizar --type css -o "$i$PrefijoArchivo$ExtensionArchivosCSS" "$i$ExtensionArchivosCSS"
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