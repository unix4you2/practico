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
		echo $ScriptPHPAutorun > ${SCRIPTPATH}${Slash}../xml/autorun_patch.php
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
		rm ${SCRIPTPATH}${Slash}../xml/autorun_patch.php
	fi

#Limpia los XML generados para el instalador de manera que no sean contemplados o re-ejecutados nuevamente en la recarga de desarrollo
	cd $SCRIPTPATH
	cd ..
	cd xml
	rm *.xml
	rm *.php

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