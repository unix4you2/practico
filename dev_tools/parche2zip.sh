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

LEAME="
PRACTICO - Generador de Aplicaciones Web             (Texto sin acentos)
------------------------------------------------------------------------

Los parches se componen de archivos que pueden ser agregados a la 
herramienta Practico o que pueden reemplazar archivos existentes.

Dentro de su estructura como minimo se debe contar con los archivos que
describen el parche, cualquier archivo adicional sera interpretado como
un archivo destinado a reemplazar alguno existente o para ser agregado
en la carpeta donde se encuentre sobre la estructura actual de Practico.

------------------------------------------------------------------------
ESTRUCTURA BASICA DE UN PARCHE:

tmp/leame.txt			Este archivo

tmp/par_cambios.txt		Resumen de cambios implementados por el parche

tmp/par_compat.txt		Version con la cual el parche es compatible. La
						Cada parche se liga a una version especifica,
						si el parche solicita una version superior
						primero debe aplicar los parches anteriores.
tmp/par_sql.txt			Script SQL que debe ser ejecutado en el proceso

inc/version_actual.txt	Version que sera asignada al sistema despues de
                        finalizar exitosamente la actualizacion.

------------------------------------------------------------------------
PROCESO DE INSTALACION:

Forma 1 (por medio del asistente incluido en la herramienta):

  * Descargue el archivo asociado al parche en su computadora
  * Ingrese a Practico con las credenciales de administracion (admin)
  * Ejecute la opcion 'Actualizaciones' ubicada en el menu superior
  * Siga los pasos para que el sistema haga un backup automatico y
    aplique los cambios contenidos en el parche.

Forma 2 (usuarios avanzados): 

 Usuarios que no deseen dar permisos completos sobre el path de la
 herramienta a su servicio web pueden optar por hacer una copia de
 seguridad manual de sus archivos (especialmente aquellos reemplazados
 por el parche), copia de seguridad de sus bases de datos y continnuar
 con la descompresion y reemplazo manual de los archivos del parche
 sobre la estructura de Practico, ademas de la ejecucion manual sobre
 el motor de bases de datos de los script que puedan residir en par_sql

------------------------------------------------------------------------
RECOMENDACIONES:

La instalacion de una actualizacion por medio del asistente incluido en
la herramienta requiere que se tengan permisos suficientes para el
usuario del servicio web sobre la estructura de directorios.

Cualquier aplicacion de un parche sin las condiciones suficientes para
que los archvios puedan ser reemplazados por el asistente puede afectar
el funcionamiento general de la herramienta al no contar con scripts
completamente compatibles entre si.

Una descripcion detallada sobre el envio y politicas para la elaboracion
de parches para la herramienta puede ser encontrada en el siguiente
enlace:  http://www.unixlandia.org/index.php/Politicas_envio_de_parches
------------------------------------------------------------------------
"
#Genera algunos elementos internos
php objeto2xml.php

# Mensajes de inicio e introduccion al script
#	clear
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

#Incluye el archivo que ajusta todos los permisos previa generacion del zip
	source dev_tools/chmod2zip.sh

#Incluye la compresion de archivos CSS y JS
	source dev_tools/cssjs2min.sh

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
	VerDetalles="  " # -v  (v)erbose
	Recursividad=" -r "
	Exclusion=" -x "
	ProbarIntegridad="  " # -T (T)est

# Pregunta por continuar o abortar
	echo ""
	echo "Version compatible    : " $VersionCompatibleAno$Punto$VersionCompatibleMes
	echo "Version final         : " $VersionFinalAno$Punto$VersionFinalMes
	echo "Version detectada     : " $Version "( ==" $VersionFinalAno$Punto$VersionFinalMes "?, sino edite /inc/...)"
	echo "Nombre del empaquetado: " $ArchivoParche
	echo "Fecha de empaquetado  : " $FECHA
	echo ""
	echo "ARCHIVOS A INCLUIR EN ESTE PARCHE (separados por espacios): "
	echo $ListaArchivos
	echo ""
	echo "Presione [Enter] para continuar o [Ctrl+C] para abortar"
#	read -p "" vble

#Procesa si el formato es ZIP (identificado por el comando)
	if [ $Comando == "zip " ]; then
		# Elimina cualquier archivo con ese nombre de parche
		echo "-----------------------------------------------------------------"
		echo "Eliminando posibles archivos anteriores..."
		rm ${SCRIPTPATH}${Slash}${ArchivoParche}
		# Crea el archivos para descripcion del parche
		echo "-----------------------------------------------------------------"
		echo "Creando temporales para descripcion..."
		IFS=$old_IFS
		echo $LogCambios > ${SCRIPTPATH}${Slash}../tmp/par_cambios.txt
		echo $ScriptBasedatos > ${SCRIPTPATH}${Slash}../tmp/par_sql.txt
		echo $VersionCompatibleAno$Punto$VersionCompatibleMes > ${SCRIPTPATH}${Slash}../tmp/par_compat.txt
		echo $LEAME > ${SCRIPTPATH}${Slash}../tmp/leame.txt
		IFS=$'\n'

		echo "-----------------------------------------------------------------"
		echo "Empaquetando archivos del parche..."
		ComandoFinal=${Comando}${NivelCompresion}${VerDetalles}${Recursividad}${ProbarIntegridad}${Espacio}${SCRIPTPATH}${Slash}${ArchivoParche}${Espacio}${ArchivosFijos}${ArchivoVersion}${ListaArchivos}
		eval ${ComandoFinal}
		
		#Elimina archivos del parche creados
		echo "-----------------------------------------------------------------"
		echo "Eliminando temporales..."
		rm ${SCRIPTPATH}${Slash}../tmp/par_cambios.txt
		rm ${SCRIPTPATH}${Slash}../tmp/par_sql.txt
		rm ${SCRIPTPATH}${Slash}../tmp/par_compat.txt
		rm ${SCRIPTPATH}${Slash}../tmp/leame.txt
	fi

# Presenta resultados, restablece variables y termina
	IFS=$old_IFS  # restablece el separador de campo predeterminado
	echo "-----------------------------------------------------------------"
	echo "PROCESO FINALIZADO.  Presione [Enter] para finalizar. "
#	read -p "" vble
#	clear
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