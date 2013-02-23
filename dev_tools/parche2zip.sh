#!/bin/bash

#	Copyright (C) 2013  John F. Arroyave Gutiérrez
#						unix4you2@gmail.com

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
	clear
	echo "    _                                      _                  "
	echo "   (_  _ _  _  _  _     _ _|_ _  _| _  _  |_) _ _  _ _|_. _ _ "
	echo "   (_ | | ||_)(_|(_||_|(/_ | (_|(_|(_)|   |  | (_|(_  | |(_(_)"
	echo "           |       |                                          "
	echo "-----------------------------------------------------------------"
	echo "Esta utilidad genera un parche de actualizacion para Practico    "
	echo "teniendo como base el archivo log_cambios.txt ubicado en el path."
	echo "Cualquier archivo existente con el mismo nombre sera sobreescrito"
	echo "-----------------------------------------------------------------"

	FECHA=$(date)  # Obtengo la fecha y hora actual

# Obtengo la ruta de ejecucion del script
	SCRIPT=$(readlink -f "$0")
	SCRIPTPATH=`dirname "$SCRIPT"`
	# Me ubico en la ruta del script y subo dos niveles
	cd $SCRIPTPATH
	cd ..

# Variables de trabajo adicionales
	oldIFS=$IFS  # conserva el separador de campo
	IFS=$'\n'  # nuevo separador de campo, el caracter fin de línea
	Espacio=" " # Usado en concatenaciones
	Slash="/" # Usado en concatenaciones
	Guion="-" # Usado en concatenaciones
	Punto="." # Usado en concatenaciones
	Underline="_" # Usado en concatenaciones
	To="_to_" # Usado en concatenaciones

#Incluye los datos/parametros para generacion del parche
source dev_tools/log_cambios.txt

# PARAMETROS BASICOS DEL EMPAQUETADO
	#Nombre del archivo resultante
	NombreArchivo="Practico";
	Version=`head -n 1 inc/version_actual.txt`
	Extension=".zip"
	VersionCompatibleMnemo=$VersionCompatibleAno$Guion$VersionCompatibleMes
	VersionFinalMnemo=$VersionFinalAno$Guion$VersionFinalMes
	ArchivoParche=$NombreArchivo$Underline$VersionCompatibleMnemo$To$VersionFinalMnemo$Extension

# Banderas para la compresion
	Comando="zip "
	NivelCompresion=" -9 " # -9 (mejor)
	VerDetalles=" -v " # -v  (v)erbose
	Recursividad=" -r "
	ProbarIntegridad=" -T "

# Pregunta por continuar o abortar
	echo ""
	echo "Version compatible    : " $VersionCompatibleAno$Punto$VersionCompatibleMes
	echo "Version final         : " $VersionFinalAno$Punto$VersionFinalMes
	echo "Nombre del empaquetado: " $ArchivoParche
	echo "Fecha de empaquetado  : " $FECHA
	echo ""
	echo "ARCHIVOS A INCLUIR EN ESTE PARCHE (separados por espacios): "
	echo $ListaArchivos
	echo ""
	read -p "Presione [Enter] para continuar o [Ctrl+C] para abortar" vble
	echo "-----------------------------------------------------------------"

#Procesa si el formato es ZIP (identificado por el comando)
	if [ $Comando == "zip " ]; then
		ComandoFinal=${Comando}${NivelCompresion}${VerDetalles}${Recursividad}${ProbarIntegridad}${Espacio}${SCRIPTPATH}${Slash}${ArchivoParche}${Espacio}${ListaArchivos}
		eval ${ComandoFinal}
	fi

exit 0




# Presenta resultados, restablece variables y termina
	IFS=$old_IFS  # restablece el separador de campo predeterminado
	echo "-----------------------------------------------------------------"
	read -p "Presione [Enter] para finalizar. " vble
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
