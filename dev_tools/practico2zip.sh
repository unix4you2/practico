#!/bin/bash

#	Copyright (C) 2013  John F. Arroyave Gutiérrez
#						unix4you2@gmail.com
#						www.practico.org

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

# PARAMETROS BASICOS DEL EMPAQUETADO
	#Lista de archivos y carpetas a empaquetar (relativos a la raiz y separados por espacio)
	ListaArchivos=" AUTHORS index.php LICENSE README.md bkp core img inc ins mod skin tmp "
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
ListaExcluidos=" skin/nomo_editada\* mod/ldap\* mod/pam\* mod/pdf\* mod/proxy\* core/configuracion.php core/doc_configuracion.php core/doc_intro.php practico.sqlite3 "

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
    cp -r Salida_DOC/* ../../../practico_web/dev_docs/
    cd ..


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
#Fuentes: patorjk.com/software/taag/  (Favoritas: Small y Standar)
