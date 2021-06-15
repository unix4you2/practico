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

#Genera algunos elementos internos
php objeto2xml.php

# Mensajes de inicio e introduccion al script
#	clear
	echo "    _                                      _                  "
	echo "   (_  _ _  _  _  _     _ _|_ _  _| _  _  |_) _ _  _ _|_. _ _ "
	echo "   (_ | | ||_)(_|(_||_|(/_ | (_|(_|(_)|   |  | (_|(_  | |(_(_)"
	echo "           |       |                                          "
	echo "-----------------------------------------------------------------"
	echo "Esta utilidad genera un nuevo paquete de distribucion de Practico"
	echo "Cualquier archivo existente con el mismo nombre sera sobreescrito"
	echo "-----------------------------------------------------------------"

	FECHA=$(date)  # Obtengo la fecha y hora actual

# Obtengo la ruta de ejecucion del script
	SCRIPT=$(readlink -f "$0")
	SCRIPTPATH=`dirname "$SCRIPT"`
	# Me ubico en la ruta del script y subo dos niveles
	cd $SCRIPTPATH
	cd ..

#Incluye el archivo que ajusta todos los permisos previa generacion del zip
	source dev_tools/chmod2zip.sh

#Incluye la compresion de archivos CSS y JS
	source dev_tools/cssjs2min.sh

# PARAMETROS BASICOS DEL EMPAQUETADO
	#Lista de archivos y carpetas a empaquetar (relativos a la raiz y separados por espacio)
	ListaArchivos=" AUTHORS index.php LICENSE DEMO.md CHANGELOG.md README.md bkp core img inc ins mod skin tmp pwa xml "
	#Nombre del archivo resultante
	NombreArchivo="Practico";
	Version=`head -n 1 inc/version_actual.txt`
	Extension=".zip"

# Pregunta por continuar o abortar
	echo ""
	echo "Version detectada     : " $Version
	echo "Nombre del empaquetado: " $NombreArchivo$Version$Extension
	echo "Fecha de empaquetado  : " $FECHA
	echo ""
	echo "Presione [Enter] para continuar o [Ctrl+C] para abortar"
#	read -p "" vble
	echo "-----------------------------------------------------------------"

# Variables de trabajo adicionales
	oldIFS=$IFS  # conserva el separador de campo
	IFS=$'\n'  # nuevo separador de campo, el caracter fin de línea
	Espacio=" " # Usado en concatenaciones
	Slash="/" # Usado en concatenaciones
	Guion="-" # Usado en concatenaciones

#Incluye los datos/parametros para generacion del parche
#source dev_tools/log_cambios.txt

#[ArchivosExcluidos] Separados por espacio. Residen en alguna carpeta a comprimir pero deben evitarse
ListaExcluidos=" inc/practico_se\* skin/nomo_editada\* mod/sopa\* mod/ldap\* mod/pam\* mod/pdf\* core/configuracion.php core/doc_configuracion.php core/doc_intro.php practico.sqlite3 "

# Banderas para la compresion
	Comando="zip "
	NivelCompresion=" -9 " # -9 (mejor)
	VerDetalles="  " # -v  (v)erbose
	Recursividad=" -r "
	Exclusion=" -x "
	ProbarIntegridad=" -T "

#Procesa si el formato es ZIP (identificado por el comando)
	if [ $Comando == "zip " ]; then
		rm ${SCRIPTPATH}${Slash}${NombreArchivo}${Guion}${Version}${Extension}
		ComandoFinal=${Comando}${NivelCompresion}${VerDetalles}${Recursividad}${Exclusion}${ListaExcluidos}${ProbarIntegridad}${Espacio}${SCRIPTPATH}${Slash}${NombreArchivo}${Guion}${Version}${Extension}${Espacio}${ListaArchivos}
		eval ${ComandoFinal}
	fi

# Actualizacion automatica de documentacion del proyecto (NaturalDocs)
	echo " _                                   "
	echo "| \ _  _    _ _  _  _ _|_ _  _. _  _ "
	echo "|_/(_)(_|_|| | |(/_| | | (_|(_|(_)| |"
	echo "-----------------------------------------------------------------"
	echo "Actualizando documentación NaturalDocs para el proyecto para ser "
	echo "publicada sobre http://unix4you2.github.io/docs mediante commit  "
	echo "-----------------------------------------------------------------"
	# Me ubico en la ruta del script y entro a la de documentacion
	cd $SCRIPTPATH
	cd natural_docs
    ./GenerarDocumentacion.sh
    # Pasa archivos generados al repositorio web
    cp -r Salida_DOC/* ../../../unix4you2.github.io/dev_docs/
    cd ..

#Limpia los XML generados para el instalador de manera que no sean contemplados o re-ejecutados nuevamente en la recarga de desarrollo
	cd $SCRIPTPATH
	cd ..
	cd xml
	rm *.xml
	rm *.php

# Presenta resultados, restablece variables y termina
	IFS=$old_IFS  # restablece el separador de campo predeterminado
	echo "-----------------------------------------------------------------"
	echo "Presione [Enter] para finalizar. "

#	read -p "" vble
	exit 0  # Finalizo ejecucion normal del script


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
#Fuentes: patorjk.com/software/taag/  (Favoritas: Small, Standar y Mini)