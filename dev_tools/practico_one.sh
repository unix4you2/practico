#!/bin/bash

#	Copyright (C) 2013  John F. Arroyave Gutierrez
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

#                              __  _                                   
#       ____  _________ ______/ /_(_)________          ____  ____  ___ 
#      / __ \/ ___/ __ `/ ___/ __/ / ___/ __ \        / __ \/ __ \/ _ \
#     / /_/ / /  / /_/ / /__/ /_/ / /__/ /_/ /  _    / /_/ / / / /  __/
#    / .___/_/   \__,_/\___/\__/_/\___/\____/  (_)   \____/_/ /_/\___/ 
#   /_/ 


########################################################################
########################################################################
# Function Inicializar
# Carga o define algunas variables de ambiente en tiempo de ejecucion
Inicializar()
	{
		# Variables generales
			PCOVAR_Aplicacion="Practico.ONE"
			PCOVAR_Version="22.1"
			PCOVAR_ValorVacio=""
			PCOVAR_SaltoLinea="\n"
			PCOVAR_PathActual=$(pwd);
			PCOVAR_TimeoutPausas=4;		#Tiempo en segundos para cierre automatico de ventanas informativas
			LFS=${PCOVAR_PathActual}/pco_filesystem
			TTYName=$(tty);
			TTYCols=$(tput cols);
			TTYRows=$(tput lines);
			SYSUser=$USER;
			PCOVAR_HOME=$HOME
			PCOVAR_TERM=$TERM
			PCOVAR_PS1=$PS1
			SYSUserHome=$(eval echo ~$USER);
			typeset -r __SYSScriptName="${0##*/}"
			typeset -r __SYSScriptDir="${0%/*}"
			typeset -r __SYSScriptRealPath=$( cd -P -- "$(dirname -- "$(command -v -- "$0")")" && pwd -P )
			CurrentDate=$(date +%Y%m%d)
			CurrentTime=$(date +%H%M)
			CurrentDateTime=${CurrentDate}_${CurrentTime}

		# Variables de aplicacion
			PCOVAR_Title="[$PCOVAR_Aplicacion ver:$PCOVAR_Version] ejecutansose como $SYSUser SBU=${PCOVAR_SBU_Binutils}s"

		# Pregunta si esta en terminal cruda o grafica.  Si la variable Display contiene algo como :1
		PCOVAR_CmdDialogos="dialog"
		PCOVAR_TTYXMode="NO";
		if [[ "$DISPLAY" == *":1__DELETEME"* ]]; then
			PCOVAR_TTYXMode="YES";
			#Crea un alias para que se use el comando grafico en lugar de los de consola
			PCOVAR_CmdDialogos="gdialog"
		fi

		##########################################################################################################
		# Define variables PREDETERMINADAS de configuracion (posteriormente reescritas desde el conf (si aplica) #
		##########################################################################################################
			# Multiplicador usado en procesos de compilacion. Numero total de trabajos tipo 'make' se da por los nucleos de CPUs detectadas multiplicados por el JobFactor
			PCOVAR_JobsFactor=1;

			# Parametros enviados a GCC durante la compilacion
			PCOVAR_CFlags="-Os -s -fno-stack-protector -fomit-frame-pointer -U_FORTIFY_SOURCE"

			# Detecta cantidad de nucleos en el sistema
			PCOVAR_NumNucleos=$(grep ^processor /proc/cpuinfo | wc -l)

			# Calcula numero de procesos 'make' para ser lanzados luego
			PCOVAR_NumProcesosMake=$((PCOVAR_NumNucleos * PCOVAR_JobsFactor))
			
			#Establece por defecto la variable ambiente para cantidad de hilos en la compilacion
			export MAKEFLAGS='-j'$PCOVAR_NumProcesosMake

			set +h
			umask 022
			LC_ALL=POSIX
			LFS_TGT=$(uname -m)-lfs-linux-gnu
			PATH=/usr/bin
			if [ ! -L /bin ]; then PATH=/bin:$PATH; fi
			PATH=$LFS/tools/bin:$PATH
			CONFIG_SITE=$LFS/usr/share/config.site
			export LFS LC_ALL LFS_TGT PATH CONFIG_SITE

		# Reescribe configuraciones (si se tiene el archivo)
		#	. conf/base.conf

		CrearCarpetasTrabajo
		GenerarRepositorios
	}


########################################################################
########################################################################
# Function LimpiarVariablesAmbiente
# Borra todas las variables de ambiente dejando solamente unas basicas
LimpiarVariablesAmbiente()
	{
		#TODO: Revisar uso de:   unsetenv *
		# get USER, HOME and DISPLAY and then completely clear environment
		U=$USER
		H=$HOME
		D=$DISPLAY

		for i in $(env | awk -F"=" '{print $1}') ; do
		unset $i ; done

		# set USER, HOME and DISPLAY and set minimal path.
		export USER=$U
		export HOME=$H
		export DISPLAY=$D

		# initial path
		export PATH=/usr/kerberos/bin:/bin:/usr/bin:/usr/bin/X11:/usr/local/bin
	}


########################################################################
########################################################################
# Function CrearCarpetasTrabajo
# Crea carpetas minimas de trabajo donde se almacena todo
CrearCarpetasTrabajo()
	{
		#Genera carpetas de trabajo propias de Practico.one
		mkdir -p $PCOVAR_PathActual/pco_down				#Cache de paquetes descargados
		mkdir -p $PCOVAR_PathActual/pco_conf				#Almacenamiento de configuraciones
		mkdir -p $PCOVAR_PathActual/pco_repo				#Repositorios autogenerados

		#Genera carpetas asociadas al LFS
		mkdir -p $PCOVAR_PathActual/pco_temp				#Archivos temporales de trabajo

		mkdir -p $LFS										#Carpeta de destino final - $LFS pco_filesystem

		mkdir -p $LFS/sources								#LFS sources
		chmod -v a+wt $LFS/sources							#Habilita write+sticky al directorio de fuentes

		mkdir -p $LFS/tools
		mkdir -p $LFS/tools/bin
		mkdir -p $LFS/tools/$LFS_TGT/bin

		#Genera el esquema basico de directorios del filesystem final
			sudo mkdir -p $LFS/{etc,var} $LFS/usr/{bin,lib,sbin}

			for i in bin lib sbin; do
			sudo ln -s usr/$i $LFS/$i
			done

			case $(uname -m) in
			x86_64) sudo mkdir -p $LFS/lib64 ;;
			esac

		#Asegura que el usuario actual tenga permisos sobre el filesystem de destino
			sudo chown $USER $LFS/{usr{,/*},lib,var,etc,bin,sbin,tools}
			case $(uname -m) in
			x86_64) sudo chown $USER $LFS/lib64 ;;
			esac

			sudo chown  $USER $LFS/sources

		#Verifica algunas variables de ambiente requeridas para trabajar
		PS1='\u:\w\$ '

	}


########################################################################
########################################################################
# Function ChequearPermisos
# Verifica si se cuenta con acceso de super usuario para realizar algunas tareas
ChequearPermisos()
	{
		#Llama al menos una vez al sudo para tener las credenciales listas
		#Todos los comandos seran ejecutados como usuario estandar
		#sudo quedara habilitado para comandos que asi lo requieran solamente
		clear
		echo; echo "Practico.ONE"; echo "============"; echo; 
		echo -e "Esta herramienta requiere acceso de super usuario para algunas"
		echo -e "tareas.  Por favor ingrese la clave para poder continuar."
		echo 
		echo -e "Si la clave ingresada no es correcta o no cuenta con permisos"
		echo -e "podra continuar para tareas basicas PERO OTRAS PODRAN FALLAR."
		echo 
		sudo clear
	}


########################################################################
########################################################################
# Function ChequearDependencias
# Define y verifica si todas las dependencias se encuentran instaladas
ChequearDependencias()
	{
		ListaDependencias=("dialog")
		ListaDependencias+=("wget")
		ListaDependencias+=("bc")
		ListaDependencias+=("flex")
		ListaDependencias+=("xorriso")
		ListaDependencias+=("bash")				#3.2
		ListaDependencias+=("bison")			#2.7
		ListaDependencias+=("gawk")				#4.0.1
		ListaDependencias+=("gcc")				#6.2
		ListaDependencias+=("make")				#4.0
		ListaDependencias+=("patch")			#2.5.4
		ListaDependencias+=("perl")				#5.8.8
		ListaDependencias+=("python3")			#3.4
		ListaDependencias+=("sed")				#4.1.5
		ListaDependencias+=("tar")				#1.22
		ListaDependencias+=("xz")				#5.0.0
		ListaDependencias+=("ld")				#Binutils 2.25
		ListaDependencias+=("bzip2")			#2-1.0.4
		ListaDependencias+=("chown")			#Coreutils	6.9
		ListaDependencias+=("diff")				#Diffutils	2.8.1
		ListaDependencias+=("find")				#Findutils	4.2.31
		ListaDependencias+=("grep")				#2.5.1a
		ListaDependencias+=("gzip")				#1.3.12
		ListaDependencias+=("makeinfo")			#Texinfo 4.7
		ListaDependencias+=("m4")				#1.4.10
		ListaDependencias+=("ldd")				#Glibc 2.11

		clear
		for Dependencia in "${ListaDependencias[@]}"
		do
			if ! [ -x "$(command -v ${Dependencia})" ]; then
				echo -e "-----------------\n$PCOVAR_Aplicacion $PCOVAR_Version\n-----------------\nERROR: Se requiere el paquete '${Dependencia}' instalado.";
				exit 1;
			fi
		done

		# TODO: Verificar si se tienen estas dependencias de tipo fuente instaladas: libelf-dev libssl-dev

		#zenity: Si se esta ejecutando sobre consola grafica
		if [[ "$PCOVAR_TTYXMode" == "YES" ]]; then
			if ! [ -x "$(command -v gdialog)" ]; then
				echo -e "-----------------\n$PCOVAR_Aplicacion $PCOVAR_Version\n-----------------\nADVERTENCIA: Este programa es compatible con Zenity para su interfaz.\n      Se recomienda instalar zenity si desea usar el modo grafico.\n      Presione [Enter] para continuar en modo de texto";
				read EnterPress
				#Devuelve el valor a dialog para intentar su ejecucion en texto
				PCOVAR_CmdDialogos="dialog"
			fi
		fi
	}


########################################################################
########################################################################
# Function ChequearPermisos
# Verifica si se cuenta con acceso de super usuario para realizar algunas tareas
ChequearPermisos()
	{
		#Llama al menos una vez al sudo para tener las credenciales listas
		#Todos los comandos seran ejecutados como usuario estandar
		#sudo quedara habilitado para comandos que asi lo requieran solamente
		clear
		echo; echo "Practico.ONE"; echo "============"; echo; 
		echo -e "Esta herramienta requiere acceso de super usuario para algunas"
		echo -e "tareas.  Por favor ingrese la clave para poder continuar."
		echo 
		echo -e "Si la clave ingresada no es correcta o no cuenta con permisos"
		echo -e "podra continuar para tareas basicas PERO OTRAS PODRAN FALLAR."
		echo 
		sudo clear
	}


########################################################################
########################################################################
# Function VerDependenciasInstaladas
# Muestra las versiones de las diferentes herramientas instaladas
VerDependenciasInstaladas()
	{
		clear
		export LC_ALL=C
		bash --version | head -n1 | cut -d" " -f2-4
		MYSH=$(readlink -f /bin/sh)
		echo "/bin/sh -> $MYSH"
		echo $MYSH | grep -q bash || echo "ERROR: /bin/sh does not point to bash"
		unset MYSH

		echo -n "Binutils: "; ld --version | head -n1 | cut -d" " -f3-
		bison --version | head -n1

		if [ -h /usr/bin/yacc ]; then
		echo "/usr/bin/yacc -> `readlink -f /usr/bin/yacc`";
		elif [ -x /usr/bin/yacc ]; then
		echo yacc is `/usr/bin/yacc --version | head -n1`
		else
		echo "yacc not found" 
		fi

		bzip2 --version 2>&1 < /dev/null | head -n1 | cut -d" " -f1,6-
		echo -n "Coreutils: "; chown --version | head -n1 | cut -d")" -f2
		diff --version | head -n1
		find --version | head -n1
		gawk --version | head -n1

		if [ -h /usr/bin/awk ]; then
		echo "/usr/bin/awk -> `readlink -f /usr/bin/awk`";
		elif [ -x /usr/bin/awk ]; then
		echo awk is `/usr/bin/awk --version | head -n1`
		else 
		echo "awk not found" 
		fi

		gcc --version | head -n1
		g++ --version | head -n1
		ldd --version | head -n1 | cut -d" " -f2-  # glibc version
		grep --version | head -n1
		gzip --version | head -n1
		cat /proc/version
		m4 --version | head -n1
		make --version | head -n1
		patch --version | head -n1
		echo Perl `perl -V:version`
		python3 --version
		sed --version | head -n1
		tar --version | head -n1
		makeinfo --version | head -n1  # texinfo version
		xz --version | head -n1

		echo 'int main(){}' > dummy.c && g++ -o dummy dummy.c
		if [ -x dummy ]
		then echo "g++ compilation OK";
		else echo "g++ compilation failed"; fi
		rm -f dummy.c dummy

		sleep 10
	}


########################################################################
########################################################################
# Function Compilar_PaqueteBINUTILS
Compilar_PaqueteBINUTILS()
	{
		mkdir -v build
		cd       build

		../configure --prefix=$LFS/tools \
					--with-sysroot=$LFS \
					--target=$LFS_TGT   \
					--disable-nls       \
					--disable-werror
		make

		make install -j1
	}


########################################################################
########################################################################
# Function Compilar_PaqueteGCC
Compilar_PaqueteGCC()
	{
		#Procesa primero las dependencias y las mueve a los fuentes de GCC quien los tomara luego en su compilacion
		ExtraerPaquete mpfr.sh
		ExtraerPaquete gmp.sh
		ExtraerPaquete mpc.sh
		#Recarga configuraciones del paquete GCC
		source $PCOVAR_PathActual/pco_repo/gcc.sh
		mv -v $LFS/sources/gmp $LFS/sources/$PCOVAR_PaqueteARCHIVO/gmp
		mv -v $LFS/sources/mpfr $LFS/sources/$PCOVAR_PaqueteARCHIVO/mpfr
		mv -v $LFS/sources/mpc $LFS/sources/$PCOVAR_PaqueteARCHIVO/mpc

		#En los hosts de 64 bits establece el directorio por defecto para las librerias de 64 bit como 'lib'
		case $(uname -m) in
		x86_64)
			sed -e '/m64=/s/lib64/lib/' \
				-i.orig gcc/config/i386/t-linux64
		;;
		esac

		#Inicia la compilacion en carpeta independiente
		mkdir -v build
		cd       build

		../configure                                       \
			--target=$LFS_TGT                              \
			--prefix=$LFS/tools                            \
			--with-glibc-version=2.11                      \
			--with-sysroot=$LFS                            \
			--with-newlib                                  \
			--without-headers                              \
			--enable-initfini-array                        \
			--disable-nls                                  \
			--disable-shared                               \
			--disable-multilib                             \
			--disable-decimal-float                        \
			--disable-threads                              \
			--disable-libatomic                            \
			--disable-libgomp                              \
			--disable-libquadmath                          \
			--disable-libssp                               \
			--disable-libvtv                               \
			--disable-libstdcxx                            \
			--enable-languages=c,c++

		make
		make install

		cd ..
		cat gcc/limitx.h gcc/glimits.h gcc/limity.h > \
		`dirname $($LFS_TGT-gcc -print-libgcc-file-name)`/install-tools/include/limits.h

		#Copia los Linux API Headers desde la instalacion actual de usuario
		make mrproper
		make headers
		find usr/include -name '.*' -delete
		rm usr/include/Makefile
		cp -rv usr/include $LFS/usr
	}


########################################################################
########################################################################
# Function Compilar_PaqueteGLIBC
Compilar_PaqueteGLIBC()
	{
		#Crea enlaces simbolicos para cumplimiento del LSB y compatibilidad para cargados de librerias dinamicas de 64bit
		case $(uname -m) in
			i?86)   ln -sfv ld-linux.so.2 $LFS/lib/ld-lsb.so.3
			;;
			x86_64) ln -sfv ../lib/ld-linux-x86-64.so.2 $LFS/lib64
					ln -sfv ../lib/ld-linux-x86-64.so.2 $LFS/lib64/ld-lsb-x86-64.so.3
			;;
		esac

		#Aplica parche de actualizacion para non-FHS
		patch -Np1 -i ../glibc.patch

		#Inicia la compilacion en carpeta independiente
		mkdir -v build
		cd       build

		#Asegura que ldconfig y sln se encuentren dentro de /usr/sbin
		echo "rootsbindir=/usr/sbin" > configparms   

		../configure                             \
			--prefix=/usr                      \
			--host=$LFS_TGT                    \
			--build=$(../scripts/config.guess) \
			--enable-kernel=3.2                \
			--with-headers=$LFS/usr/include    \
			libc_cv_slibdir=/usr/lib

		make -j1

		dialog --title "ALERTA!!! Verificando variable LFS." --msgbox "\nSi no se tiene un valor aqui puede danar su sistema base\n\nVALOR = ${LFS}\n\nSi el valor no es lo esperado presione CTRL+C DE INMEDIATO Y EN REPETIDAS OCASIONES PARA DETENER y salir al shell.\n\nSi decide continuar sin un valor adecuado puede danar por completo su sistema." 20 75
		sleep 2
		make DESTDIR=$LFS install

		#Repara el path al cargador ejecutable en script de ldd:
		sed '/RTLDLIST=/s@/usr@@g' -i $LFS/usr/bin/ldd

			echo 'int main(){}' > dummy.c
			$LFS_TGT-gcc dummy.c
			(readelf -l a.out | grep '/ld-linux') 2>&1 | tee $PCOVAR_PathActual/pco_temp/log.txt
		dialog --title "ALERTA!!! Verificando Compilador y Linker." --msgbox "$(echo RESULTADO_PRUEBAS_COMPILACION; echo; cat $PCOVAR_PathActual/pco_temp/log.txt; echo; echo BUSQUE_ARRIBA_POR_EL_VALOR_o_similar; echo [Requesting program interpreter: /lib64/ld-linux-x86-64.so.2]; echo; echo Si el valor no es lo esperado presione CTRL+C DE INMEDIATO Y EN REPETIDAS OCASIONES PARA DETENER y salir al shell; echo Si decide continuar sin un valor adecuado puede danar por completo su sistema )" 20 75
		sleep 5
			rm -v dummy.c a.out

		$LFS/tools/libexec/gcc/$LFS_TGT/11.2.0/install-tools/mkheaders
	}


########################################################################
########################################################################
# Function RecompilarPaquete
# Limpia y Recompila un paquete especifico recibido como parametro ($1)
RecompilarPaquete()
	{
		PCOVAR_HoraInicioCompilacion=$(date +%s)



		#TODO: PDTE validar si el paquete existe y ha sido descargado!!!!



		#Ejecuta archivo de repositorio para cargar las variables correspondientes
		source $PCOVAR_PathActual/pco_repo/$1.sh

		#INICIO: Determina el tiempo estimado en SBU (basados en el SBU=1 de binutils)
		PCOVAR_TiempoMinutos=$((${PCOVAR_SBU_Binutils}/60))
		PCOVAR_TiempoEstimado=$(echo "$PCOVAR_PaqueteSBU*$PCOVAR_TiempoMinutos" | bc)

		#Presenta mensaje
		clear
		echo -e "\n###############################################"
		echo -e " Construyendo: $PCOVAR_PaqueteNOMBRE"
		echo -e " Tiempo estimado: $PCOVAR_TiempoEstimado minutos"
		echo -e "###############################################"
		echo -e "Limpiando construcciones previas de ${PCOVAR_PaqueteARCHIVO}.  Espere..."
		sleep 1

		#Extrae de nuevo los fuentes para evitar cualquier basura
		ExtraerPaquete ${PCOVAR_PaqueteARCHIVO}.sh

		# Ingresa a la carpeta del paquete
		cd $LFS/sources/$PCOVAR_PaqueteARCHIVO

		# Llama la rutina de compilacion especifica segun el paquete
			if [[ "$PCOVAR_PaqueteARCHIVO" == "binutils" ]]; then
				Compilar_PaqueteBINUTILS
			fi
			if [[ "$PCOVAR_PaqueteARCHIVO" == "gcc" ]]; then
				Compilar_PaqueteGCC
			fi
			if [[ "$PCOVAR_PaqueteARCHIVO" == "glibc" ]]; then
				Compilar_PaqueteGLIBC
			fi

		# Regresa a la carpeta de trabajo inicial
		cd $PCOVAR_PathActual

		echo -e "\nFinalizado: $PCOVAR_PaqueteNOMBRE\nRegresando al menu..."
		sleep 2

		#FIN: Determina el tiempo estimado en SBU (basados en el SBU=1 de binutils)
		PCOVAR_HoraFinCompilacion=$(date +%s)
		PCOVAR_SegundosConstruccion=$(($PCOVAR_HoraFinCompilacion-$PCOVAR_HoraInicioCompilacion))
		if [[ "$PCOVAR_PaqueteARCHIVO" == "binutils" ]]; then
			PCOVAR_SBU_Binutils=$PCOVAR_SegundosConstruccion
			PCOVAR_Title="[$PCOVAR_Aplicacion ver:$PCOVAR_Version] ejecutansose como $SYSUser SBU=${PCOVAR_SBU_Binutils}s"
		fi
	}


########################################################################
########################################################################
# Function RecompilarTodosLosPaquetes
# Reconstruye aboslutamente todo, de manera lineal
RecompilarTodosLosPaquetes()
	{
		RecompilarPaquete binutils
		RecompilarPaquete gcc
		RecompilarPaquete glibc
	}


########################################################################
########################################################################
# Function RecompilarArchivoEspecifico
# Presenta una lista de paquetes disponibles para recompilar
RecompilarArchivoEspecifico()
	{
		MenuOptions=""
		for ArchivoRepositorio in $(ls -C1 $PCOVAR_PathActual/pco_repo/)
		do
			source ./pco_repo/$ArchivoRepositorio
			MenuOptions=${MenuOptions}"${PCOVAR_PaqueteARCHIVO} ${PCOVAR_PaqueteNOMBRE} "
		done
		MenuOptions="PAQUETE DETALLES "${MenuOptions} # Agrega un titulo para al menos tener una opcion en la sintaxis de dialog
		PaqueteSeleccionado=$(dialog --output-fd 1 --clear --backtitle "$PCOVAR_Title" --title "CONSTRUIR: Paquetes disponibles en repositorio" --menu "" 15 60 10 $MenuOptions )

		if [[ "$PaqueteSeleccionado" != "$PCOVAR_ValorVacio" ]] && [[ "$PaqueteSeleccionado" != "PAQUETE" ]]; then
			RecompilarPaquete ${PaqueteSeleccionado}
		fi
	}


########################################################################
########################################################################
# Function LimpiezaYPreliminares
# Presenta un menu para limpiar carpetas de trabajo, descargas, etc
LimpiezaYPreliminares()
	{
		while true
		do
			RespuestaMenuPreliminares=$(dialog --output-fd 1 --clear --backtitle "$PCOVAR_Title" --title "Limpieza, mantenimiento y preliminares" --menu "" 15 65 10 \
			L "LIMPIAR carpetas de trabajo (pco_filesystem/pco_temp)" \
			X "LIMPIAR carpeta de descargas (pco_down)" \
			F "LIMPIAR carpeta de fuentes (pco_filesystem/sources)" \
			D "DESCARGAR todos los paquetes necesarios (pco_down)" \
			P "DESCARGAR un paquete especifico (pco_down)" \
			Z "DESCOMPRIMIR todos los fuentes descargados (pco_filesystem/sources)" \
			A "DESCOMPRIMIR un paquete especifico (pco_filesystem/sources)" \
			R "RE-CONSTRUIR un paquete especifico (pco_filesystem/sources)" \
			E "Volver al menu principal" )

			case $RespuestaMenuPreliminares in
				L) Limpieza_WorkTemp;;
				X) Limpieza_Descargas;;
				F) Limpieza_Fuentes;;
				D) DescargarFuentesCompletos;;
				P) DescargarArchivoEspecifico;;
				Z) DescomprimirTodosLosFuentes;;
				A) DescomprimirArchivoEspecifico;;
				R) RecompilarArchivoEspecifico;;
				E) break;;
				$PCOVAR_ValorVacio) break;;
			esac
		done
	}


########################################################################
########################################################################
# Function Limpieza_WorkTemp
Limpieza_WorkTemp()
	{
		dialog --timeout $PCOVAR_TimeoutPausas --title "Limpieza de carpetas de Trabajo: FILESYSTEM DESTINO" --msgbox "$(sudo rm -rfv pco_filesystem poc_temp; echo -e \\n-------------------\\nFINALIZADA LIMPIEZA)" 20 75
		CrearCarpetasTrabajo
	}


########################################################################
########################################################################
# Function Limpieza_WorkTemp
Limpieza_Descargas()
	{
		dialog --timeout $PCOVAR_TimeoutPausas --title "Limpieza de carpetas de descargas: DOWN" --msgbox "$(rm -rfv pco_down; echo -e \\n-------------------\\nFINALIZADA LIMPIEZA)" 20 75
	}


########################################################################
########################################################################
# Function Limpieza_Fuentes
Limpieza_Fuentes()
	{
		echo -e "Limpiando fuentes.  Puede tardar..."
		rm -rfv $LFS/sources  > /dev/null
		mkdir -p $LFS/sources
		chmod -v a+wt $LFS/sources
	}


########################################################################
########################################################################
# Function DescargarPaquete
# Descarga los fuentes de un paquete especifico recibido como parametro ($1)
DescargarPaquete()
	{
		#Ejecuta archivo de repositorio para cargar las variables correspondientes
		source ./pco_repo/$1.sh
		#Presenta mensaje
		echo -e "\nDescargando: $PCOVAR_PaqueteNOMBRE \nURL_Origen:  $PCOVAR_PaqueteURLBASE \nArchivo:     $PCOVAR_PaqueteCOMPRIMIDO"
		wget -q --show-progress -O $PCOVAR_PathActual/pco_down/${PCOVAR_PaqueteCOMPRIMIDO} ${PCOVAR_PaqueteURLBASE}${PCOVAR_PaqueteCOMPRIMIDO}

		#Si el paquete cuenta con parches tambien los descarga
		if [[ "$PCOVAR_PaquetePARCHE" != "N/A" ]]; then
			wget -q --show-progress -O $PCOVAR_PathActual/pco_down/${PCOVAR_PaqueteARCHIVO}.patch ${PCOVAR_PaquetePARCHE}
		fi
	}


########################################################################
########################################################################
# Function DescargarFuentes
# Descarga todos los paquetes fuente requeridos para ser compilados
DescargarFuentesCompletos()
	{
		for ArchivoRepositorio in $(ls -C1 $PCOVAR_PathActual/pco_repo/)
		do
			source ./pco_repo/$ArchivoRepositorio
			DescargarPaquete ${PCOVAR_PaqueteARCHIVO}
		done
	}


########################################################################
########################################################################
# Function DescargarArchivoEspecifico
# Permite listar y descargar un paquete del repositorio
DescargarArchivoEspecifico()
	{
		MenuOptions=""
		for ArchivoRepositorio in $(ls -C1 $PCOVAR_PathActual/pco_repo/)
		do
			source ./pco_repo/$ArchivoRepositorio
			MenuOptions=${MenuOptions}"${PCOVAR_PaqueteARCHIVO} ${PCOVAR_PaqueteNOMBRE} "
		done
		MenuOptions="PAQUETE DETALLES "${MenuOptions} # Agrega un titulo para al menos tener una opcion en la sintaxis de dialog
		PaqueteSeleccionado=$(dialog --output-fd 1 --clear --backtitle "$PCOVAR_Title" --title "DESCARGAR: Paquetes disponibles en repositorio" --menu "" 15 60 10 $MenuOptions )

		if [[ "$PaqueteSeleccionado" != "$PCOVAR_ValorVacio" ]] && [[ "$PaqueteSeleccionado" != "PAQUETE" ]]; then
			DescargarPaquete ${PaqueteSeleccionado}
		fi
	}


########################################################################
########################################################################
# Function ExtraerPaquete
# Extrae los fuentes de un paquete determinado
ExtraerPaquete()
	{
		source $PCOVAR_PathActual/pco_repo/$1
		echo -e "Descomprimiendo version limpia de ${PCOVAR_PaqueteARCHIVO}..."
		sleep 1
		rm -rf $LFS/sources/${PCOVAR_PaqueteARCHIVO} > /dev/null
		mkdir -p $LFS/sources/${PCOVAR_PaqueteARCHIVO}
		tar --strip-components 1 -xf $PCOVAR_PathActual/pco_down/${PCOVAR_PaqueteCOMPRIMIDO} --directory $LFS/sources/${PCOVAR_PaqueteARCHIVO}

		#Si cuenta con parche lo copia a la raiz de fuentes por si se requiere en la compilacion
		if [[ "$PCOVAR_PaquetePARCHE" != "N/A" ]]; then
			cp $PCOVAR_PathActual/pco_down/${PCOVAR_PaqueteARCHIVO}.patch $LFS/sources/
		fi
	}


########################################################################
########################################################################
# Function DescomprimirArchivoEspecifico
# Presenta una lista de todos los paquetes descargados para seleccionar
DescomprimirArchivoEspecifico()
	{
		MenuOptions=""
		for ArchivoRepositorio in $(ls -C1 $PCOVAR_PathActual/pco_repo/)
		do
			source ./pco_repo/$ArchivoRepositorio
			MenuOptions=${MenuOptions}"${PCOVAR_PaqueteARCHIVO}.sh ${PCOVAR_PaqueteNOMBRE} "
		done
		MenuOptions="PAQUETE DETALLES "${MenuOptions} # Agrega un titulo para al menos tener una opcion en la sintaxis de dialog
		PaqueteSeleccionado=$(dialog --output-fd 1 --clear --backtitle "$PCOVAR_Title" --title "EXTRAER: Paquetes disponibles en repositorio" --menu "" 15 60 10 $MenuOptions )

		if [[ "$PaqueteSeleccionado" != "$PCOVAR_ValorVacio" ]] && [[ "$PaqueteSeleccionado" != "PAQUETE" ]]; then
			ExtraerPaquete ${PaqueteSeleccionado}
		fi
	}


########################################################################
########################################################################
# Function DescomprimirTodosLosFuentes
# Descomprime todos los archivos fuente existentes desde DOWN hasta COMP
DescomprimirTodosLosFuentes()
	{
		Limpieza_Fuentes
		mkdir -p $LFS/sources
		for ArchivoFuente in $(ls -C1 $PCOVAR_PathActual/pco_repo/)
		do
			ExtraerPaquete ${ArchivoFuente}
		done
	}


########################################################################
########################################################################
# Function RegenerarTodo
# Ejecuta el llamado a cada funcion en orden requerido para construccion
RegenerarTodo()
	{
		Inicializar
		Limpieza_WorkTemp
		Limpieza_Descargas
		Limpieza_Fuentes
		CrearCarpetasTrabajo
		GenerarRepositorios
		DescargarFuentesCompletos
		DescomprimirTodosLosFuentes
		RecompilarTodosLosPaquetes
	}


########################################################################
########################################################################
# Function VerificarEntornoEjecucion
# Presenta detalles de algunas variables utilizadas durante el proceso por la aplicacion
VerificarEntornoEjecucion()
	{
		dialog --title "Variables de entorno activas" --msgbox "$(printenv)" 20 75
	}


########################################################################
########################################################################
# Function MenuPrincipal
# Presenta menu mediante un loop hasta que el usuario decida salir
MenuPrincipal()
	{
		Inicializar  #Se llama cada vez para tener las configuraciones actualizadas en cada cambio
		while true
		do
			# Refresh date and time in every menu load
			CurrentDate=$(date +%Y%m%d)
			CurrentTime=$(date +%H%M)
			CurrentDateTime=${CurrentDate}_${CurrentTime}

			MainMenuAnswer=$( $PCOVAR_CmdDialogos --output-fd 1 --clear --backtitle "$PCOVAR_Title" --ok-label "Ejecutar" --cancel-label "Salir" --title "Menu principal" --menu "Por favor seleccione una opcion:" 17 50 17 \
			L "Limpieza y operaciones preliminares" \
			V "Verificar entorno de ejecucion" \
			D "Ver todas las dependencias instaladas" \
			R "Ejecutar regeneracion completa" \
			A "Acerca de esta herramienta" \
			E "Salir")

			case $MainMenuAnswer in
				L) LimpiezaYPreliminares;;
				V) VerificarEntornoEjecucion;;
				D) VerDependenciasInstaladas;;
				R) RegenerarTodo;;
				A) AcercaDe;;
				E) break;;
				$PCOVAR_ValorVacio) break;;
			esac
		done
	}


########################################################################
########################################################################
# Function Finalizar
# Ejecuta algunas tareas antes de finalizar la aplicacion
Finalizar()
	{
		#SaveConfigs
		#clear

		#Restablece variables iniciales
		HOME=$PCOVAR_HOME
		TERM=$PCOVAR_TERM
		PS1=$PCOVAR_PS1

		exit 0;
	}


########################################################################
########################################################################
# Function AcercaDe
# Presenta informacion basica de herramienta, desarrollador y contacto
AcercaDe()
	{
		dialog --clear --backtitle "$PCOVAR_Title" --title "Acerca de" --msgbox "
			\nPractico.ONE es una herramienta para la generacion rapida de una distribucion liviana de Linux que puede ser desplegada como escritorio de usuario o servidor de alto rendimiento preconfigurado para aplicaciones desarrolladas mediante Practico Framework.
			\n
			\n  Copyright (c) 2018   John F. Arroyave Gutierrez
			\n                       unix4you2@gmail.com
			\n                       www.practico.org
			\n
			\n  Este es un SOFTWARE LIBRE bajo licencia GNU-GPL ver. 3
			\n
			\n  Mas inforamcion en: https://github.com/unix4you2/practico.one
			" 18 60;
	}


########################################################################
########################################################################
# Function GenerarArchivoRepositorio
# Crea un archivo con la configuracion de un paquete en el repositorio
GenerarArchivoRepositorio()
	{
		PCOVAR_ArchivoRepositorio="${PCOVAR_PathActual}/pco_repo/${1}.sh"
		echo '#!/bin/bash' > ${PCOVAR_ArchivoRepositorio}
		echo 'PCOVAR_PaqueteNOMBRE="'$4'"' >> ${PCOVAR_ArchivoRepositorio}
		echo 'PCOVAR_PaqueteARCHIVO="'$1'"' >> ${PCOVAR_ArchivoRepositorio}
		echo 'PCOVAR_PaqueteURLBASE="'$2'"' >> ${PCOVAR_ArchivoRepositorio}
		echo 'PCOVAR_PaqueteCOMPRIMIDO="'$3'"' >> ${PCOVAR_ArchivoRepositorio}
		echo 'PCOVAR_PaqueteMD5SUM="'$7'"' >> ${PCOVAR_ArchivoRepositorio}
		echo 'PCOVAR_PaqueteDEPENDENCIAS="'$5'"' >> ${PCOVAR_ArchivoRepositorio}
		echo 'PCOVAR_PaquetePARCHE="'$6'"' >> ${PCOVAR_ArchivoRepositorio}
		echo 'PCOVAR_PaqueteSBU="'$8'"' >> ${PCOVAR_ArchivoRepositorio}
		echo 'PCOVAR_PaqueteURLDESCARGA="'${2}${3}'"' >> ${PCOVAR_ArchivoRepositorio}
		chmod +x ${PCOVAR_ArchivoRepositorio}
	}


########################################################################
########################################################################
# Function GenerarRepositorios
# Crear los archivos basicos que contienen los repositorios de paquetes
# Funcion extensa que contiene todos los posibles paquetes del sistema
GenerarRepositorios()
	{
		rm -rf ${PCOVAR_PathActual}/pco_repo  > /dev/null
		mkdir -p ${PCOVAR_PathActual}/pco_repo

		PCOVAR_PaqueteARCHIVO="kernel"
		PCOVAR_PaqueteURLBASE="https://www.kernel.org/pub/linux/kernel/v5.x/"
		PCOVAR_PaqueteCOMPRIMIDO="linux-5.13.12.tar.xz"
		PCOVAR_PaqueteNOMBRE="Kernel_de_Linux_5_13_12"
		PCOVAR_PaqueteMD5SUM="6e1728b2021ca19cc9273f080e6c44c7"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="binutils"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/binutils/"
		PCOVAR_PaqueteCOMPRIMIDO="binutils-2.37.tar.xz"
		PCOVAR_PaqueteNOMBRE="Binutils_2_37"
		PCOVAR_PaqueteMD5SUM="e78d9ff2976b745a348f4c1f27c77cb1"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="https://www.linuxfromscratch.org/patches/lfs/11.0/binutils-2.37-upstream_fix-1.patch"
		PCOVAR_PaqueteSBU="1"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="acl"
		PCOVAR_PaqueteURLBASE="https://download.savannah.gnu.org/releases/acl/"
		PCOVAR_PaqueteCOMPRIMIDO="acl-2.3.1.tar.xz"
		PCOVAR_PaqueteNOMBRE="ACL_POSIX_Access_Control_Lists_2_3_1"
		PCOVAR_PaqueteMD5SUM="95ce715fe09acca7c12d3306d0f076b2"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="attr"
		PCOVAR_PaqueteURLBASE="https://download.savannah.gnu.org/releases/attr/"
		PCOVAR_PaqueteCOMPRIMIDO="attr-2.5.1.tar.gz"
		PCOVAR_PaqueteNOMBRE="Attr_Filesystem_Extended_Attributes_2_5_1"
		PCOVAR_PaqueteMD5SUM="ac1c5a7a084f0f83b8cace34211f64d8"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="autoconf"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/autoconf/"
		PCOVAR_PaqueteCOMPRIMIDO="autoconf-2.71.tar.xz"
		PCOVAR_PaqueteNOMBRE="Autoconf_2_71"
		PCOVAR_PaqueteMD5SUM="12cfa1687ffa2606337efe1a64416106"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="automake"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/automake/"
		PCOVAR_PaqueteCOMPRIMIDO="automake-1.16.4.tar.xz"
		PCOVAR_PaqueteNOMBRE="AutoMake_1_16_4"
		PCOVAR_PaqueteMD5SUM="86e8e682bd74e6390a016c4d9c11267c"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="bash"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/bash/"
		PCOVAR_PaqueteCOMPRIMIDO="bash-5.1.8.tar.gz"
		PCOVAR_PaqueteNOMBRE="BASH_Shell_5_1_8"
		PCOVAR_PaqueteMD5SUM="23eee6195b47318b9fd878e590ccb38c"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="bc"
		PCOVAR_PaqueteURLBASE="https://github.com/gavinhoward/bc/releases/download/5.0.0/"
		PCOVAR_PaqueteCOMPRIMIDO="bc-5.0.0.tar.xz"
		PCOVAR_PaqueteNOMBRE="BC_5_0_0"
		PCOVAR_PaqueteMD5SUM="8345bb81c576ddfc8c27e0842370603c"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="bison"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/bison/"
		PCOVAR_PaqueteCOMPRIMIDO="bison-3.7.6.tar.xz"
		PCOVAR_PaqueteNOMBRE="Bison_3_7_6"
		PCOVAR_PaqueteMD5SUM="d61aa92e3562cb7292b004ce96173cf7"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="bzip"
		PCOVAR_PaqueteURLBASE="https://www.sourceware.org/pub/bzip2/"
		PCOVAR_PaqueteCOMPRIMIDO="bzip2-1.0.8.tar.gz"
		PCOVAR_PaqueteNOMBRE="BZip_2_1_0_8"
		PCOVAR_PaqueteMD5SUM="67e051268d0c475ea773822f7500d0e5"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="https://www.linuxfromscratch.org/patches/lfs/11.0/bzip2-1.0.8-install_docs-1.patch"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="check"
		PCOVAR_PaqueteURLBASE="https://github.com/libcheck/check/releases/download/0.15.2/"
		PCOVAR_PaqueteCOMPRIMIDO="check-0.15.2.tar.gz"
		PCOVAR_PaqueteNOMBRE="Check_0_15_2"
		PCOVAR_PaqueteMD5SUM="50fcafcecde5a380415b12e9c574e0b2"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="coreutils"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/coreutils/"
		PCOVAR_PaqueteCOMPRIMIDO="coreutils-8.32.tar.xz"
		PCOVAR_PaqueteNOMBRE="CoreUtils_8_32"
		PCOVAR_PaqueteMD5SUM="022042695b7d5bcf1a93559a9735e668"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="https://www.linuxfromscratch.org/patches/lfs/11.0/coreutils-8.32-i18n-1.patch"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="dbus"
		PCOVAR_PaqueteURLBASE="https://dbus.freedesktop.org/releases/dbus/"
		PCOVAR_PaqueteCOMPRIMIDO="dbus-1.12.20.tar.gz"
		PCOVAR_PaqueteNOMBRE="DBus_1_12_20"
		PCOVAR_PaqueteMD5SUM="dfe8a71f412e0b53be26ed4fbfdc91c4"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="dejagnu"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/dejagnu/"
		PCOVAR_PaqueteCOMPRIMIDO="dejagnu-1.6.3.tar.gz"
		PCOVAR_PaqueteNOMBRE="DejaGNU_1_6_3"
		PCOVAR_PaqueteMD5SUM="68c5208c58236eba447d7d6d1326b821"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="diffutils"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/diffutils/"
		PCOVAR_PaqueteCOMPRIMIDO="diffutils-3.8.tar.xz"
		PCOVAR_PaqueteNOMBRE="Diffutils_3_8"
		PCOVAR_PaqueteMD5SUM="6a6b0fdc72acfe3f2829aab477876fbc"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="e2fsprogs"
		PCOVAR_PaqueteURLBASE="https://downloads.sourceforge.net/project/e2fsprogs/e2fsprogs/v1.46.4/"
		PCOVAR_PaqueteCOMPRIMIDO="e2fsprogs-1.46.4.tar.gz"
		PCOVAR_PaqueteNOMBRE="E2FSProgs_1_46_4"
		PCOVAR_PaqueteMD5SUM="128f5b0f0746b28d1e3ca7e263c57094"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="elfutils"
		PCOVAR_PaqueteURLBASE="https://sourceware.org/ftp/elfutils/0.185/"
		PCOVAR_PaqueteCOMPRIMIDO="elfutils-0.185.tar.bz2"
		PCOVAR_PaqueteNOMBRE="ELFUtils_0_185"
		PCOVAR_PaqueteMD5SUM="2b6e94c2eebc1f2194173e31bca9396e"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="expat"
		PCOVAR_PaqueteURLBASE="https://prdownloads.sourceforge.net/expat/"
		PCOVAR_PaqueteCOMPRIMIDO="expat-2.4.1.tar.xz"
		PCOVAR_PaqueteNOMBRE="Expat_2_4_1"
		PCOVAR_PaqueteMD5SUM="a4fb91a9441bcaec576d4c4a56fa3aa6"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="expect"
		PCOVAR_PaqueteURLBASE="https://prdownloads.sourceforge.net/expect/"
		PCOVAR_PaqueteCOMPRIMIDO="expect5.45.4.tar.gz"
		PCOVAR_PaqueteNOMBRE="Expect_5_45_4"
		PCOVAR_PaqueteMD5SUM="00fce8de158422f5ccd2666512329bd2"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="file"
		PCOVAR_PaqueteURLBASE="https://astron.com/pub/file/"
		PCOVAR_PaqueteCOMPRIMIDO="file-5.40.tar.gz"
		PCOVAR_PaqueteNOMBRE="File_5_40"
		PCOVAR_PaqueteMD5SUM="72540ea1cc8c6e1dee35d6100ec66589"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="findutils"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/findutils/"
		PCOVAR_PaqueteCOMPRIMIDO="findutils-4.8.0.tar.xz"
		PCOVAR_PaqueteNOMBRE="Findutils_4_8_0"
		PCOVAR_PaqueteMD5SUM="eeefe2e6380931a77dfa6d9350b43186"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="flex"
		PCOVAR_PaqueteURLBASE="https://github.com/westes/flex/releases/download/v2.6.4/"
		PCOVAR_PaqueteCOMPRIMIDO="flex-2.6.4.tar.gz"
		PCOVAR_PaqueteNOMBRE="Flex_2_6_4"
		PCOVAR_PaqueteMD5SUM="2882e3179748cc9f9c23ec593d6adc8d"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="gawk"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/gawk/"
		PCOVAR_PaqueteCOMPRIMIDO="gawk-5.1.0.tar.xz"
		PCOVAR_PaqueteNOMBRE="GAWK_5_1_0"
		PCOVAR_PaqueteMD5SUM="8470c34eeecc41c1aa0c5d89e630df50"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="gcc"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/gcc/gcc-11.2.0/"
		PCOVAR_PaqueteCOMPRIMIDO="gcc-11.2.0.tar.xz"
		PCOVAR_PaqueteNOMBRE="GCC_11_2_0"
		PCOVAR_PaqueteMD5SUM="31c86f2ced76acac66992eeedce2fce2"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="13"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="gdbm"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/gdbm/"
		PCOVAR_PaqueteCOMPRIMIDO="gdbm-1.20.tar.gz"
		PCOVAR_PaqueteNOMBRE="Gdbm_database_functions_1_20"
		PCOVAR_PaqueteMD5SUM="006c19b8b60828fd6916a16f3496bd3c"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="gettext"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/gettext/"
		PCOVAR_PaqueteCOMPRIMIDO="gettext-0.21.tar.xz"
		PCOVAR_PaqueteNOMBRE="GetText_0_21"
		PCOVAR_PaqueteMD5SUM="40996bbaf7d1356d3c22e33a8b255b31"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="glibc"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/glibc/"
		PCOVAR_PaqueteCOMPRIMIDO="glibc-2.34.tar.xz"
		PCOVAR_PaqueteNOMBRE="GLIBC_2_34"
		PCOVAR_PaqueteMD5SUM="31998b53fb39cb946e96abc310af1c89"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="https://www.linuxfromscratch.org/patches/lfs/11.0/glibc-2.34-fhs-1.patch"
		PCOVAR_PaqueteSBU="4.2"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="gmp"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/gmp/"
		PCOVAR_PaqueteCOMPRIMIDO="gmp-6.2.1.tar.xz"
		PCOVAR_PaqueteNOMBRE="GMP_Multiple_Precision_Arithmetic_6_2_1"
		PCOVAR_PaqueteMD5SUM="0b82665c4a92fd2ade7440c13fcaa42b"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="gperf"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/gperf/"
		PCOVAR_PaqueteCOMPRIMIDO="gperf-3.1.tar.gz"
		PCOVAR_PaqueteNOMBRE="Gperf_Perfect_hash_function_3_1"
		PCOVAR_PaqueteMD5SUM="9e251c0a618ad0824b51117d5d9db87e"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="grep"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/grep/"
		PCOVAR_PaqueteCOMPRIMIDO="grep-3.7.tar.xz"
		PCOVAR_PaqueteNOMBRE="Grep_3_7"
		PCOVAR_PaqueteMD5SUM="7c9cca97fa18670a21e72638c3e1dabf"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="groff"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/groff/"
		PCOVAR_PaqueteCOMPRIMIDO="groff-1.22.4.tar.gz"
		PCOVAR_PaqueteNOMBRE="Groff_1_22_4"
		PCOVAR_PaqueteMD5SUM="08fb04335e2f5e73f23ea4c3adbf0c5f"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="grub"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/grub/"
		PCOVAR_PaqueteCOMPRIMIDO="grub-2.06.tar.xz"
		PCOVAR_PaqueteNOMBRE="Grub_2_06"
		PCOVAR_PaqueteMD5SUM="cf0fd928b1e5479c8108ee52cb114363"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="gzip"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/gzip/"
		PCOVAR_PaqueteCOMPRIMIDO="gzip-1.10.tar.xz"
		PCOVAR_PaqueteNOMBRE="GZip_1_10"
		PCOVAR_PaqueteMD5SUM="691b1221694c3394f1c537df4eee39d3"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="iana-etc"
		PCOVAR_PaqueteURLBASE="https://github.com/Mic92/iana-etc/releases/download/20210611/"
		PCOVAR_PaqueteCOMPRIMIDO="iana-etc-20210611.tar.gz"
		PCOVAR_PaqueteNOMBRE="iana_etc_20210611"
		PCOVAR_PaqueteMD5SUM="f2854be57fe281e3ffc7364984467d2f"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="inetutils"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/inetutils/"
		PCOVAR_PaqueteCOMPRIMIDO="inetutils-2.1.tar.xz"
		PCOVAR_PaqueteNOMBRE="INetUtils_2_1"
		PCOVAR_PaqueteMD5SUM="4e7676d1980e57c7df665e5c5c3c1047"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="intltool"
		PCOVAR_PaqueteURLBASE="https://launchpad.net/intltool/trunk/0.51.0/+download/"
		PCOVAR_PaqueteCOMPRIMIDO="intltool-0.51.0.tar.gz"
		PCOVAR_PaqueteNOMBRE="IntlTool_0_51_0"
		PCOVAR_PaqueteMD5SUM="12e517cac2b57a0121cda351570f1e63"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="iproute2"
		PCOVAR_PaqueteURLBASE="https://www.kernel.org/pub/linux/utils/net/iproute2/"
		PCOVAR_PaqueteCOMPRIMIDO="iproute2-5.13.0.tar.xz"
		PCOVAR_PaqueteNOMBRE="IPRoute2_5_13_0"
		PCOVAR_PaqueteMD5SUM="15fc3786303a173a14e180afe4cd2ecd"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="jinja2"
		PCOVAR_PaqueteURLBASE="https://files.pythonhosted.org/packages/source/J/Jinja2/"
		PCOVAR_PaqueteCOMPRIMIDO="Jinja2-3.0.1.tar.gz"
		PCOVAR_PaqueteNOMBRE="Jinja2_3_0_1"
		PCOVAR_PaqueteMD5SUM="25ba6ef98c164878acff1036fbd72a1d"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="kbd"
		PCOVAR_PaqueteURLBASE="https://www.kernel.org/pub/linux/utils/kbd/"
		PCOVAR_PaqueteCOMPRIMIDO="kbd-2.4.0.tar.xz"
		PCOVAR_PaqueteNOMBRE="KBD_Linux_keyboard_tools_2_4_0"
		PCOVAR_PaqueteMD5SUM="3cac5be0096fcf7b32dcbd3c53831380"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="https://www.linuxfromscratch.org/patches/lfs/11.0/kbd-2.4.0-backspace-1.patch"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="kmod"
		PCOVAR_PaqueteURLBASE="https://www.kernel.org/pub/linux/utils/kernel/kmod/"
		PCOVAR_PaqueteCOMPRIMIDO="kmod-29.tar.xz"
		PCOVAR_PaqueteNOMBRE="KMod_29"
		PCOVAR_PaqueteMD5SUM="e81e63acd80697d001c8d85c1acb38a0"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="less"
		PCOVAR_PaqueteURLBASE="https://www.greenwoodsoftware.com/less/"
		PCOVAR_PaqueteCOMPRIMIDO="less-590.tar.gz"
		PCOVAR_PaqueteNOMBRE="Less_590"
		PCOVAR_PaqueteMD5SUM="f029087448357812fba450091a1172ab"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="libcap"
		PCOVAR_PaqueteURLBASE="https://www.kernel.org/pub/linux/libs/security/linux-privs/libcap2/"
		PCOVAR_PaqueteCOMPRIMIDO="libcap-2.53.tar.xz"
		PCOVAR_PaqueteNOMBRE="Libcap_2_53"
		PCOVAR_PaqueteMD5SUM="094994d4554c6689cf98ae4f717b8e19"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="libffi"
		PCOVAR_PaqueteURLBASE="https://github.com/libffi/libffi/releases/download/v3.4.2/"
		PCOVAR_PaqueteCOMPRIMIDO="libffi-3.4.2.tar.gz"
		PCOVAR_PaqueteNOMBRE="Libffi_3_4_2"
		PCOVAR_PaqueteMD5SUM="294b921e6cf9ab0fbaea4b639f8fdbe8"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="libpipeline"
		PCOVAR_PaqueteURLBASE="https://download.savannah.gnu.org/releases/libpipeline/"
		PCOVAR_PaqueteCOMPRIMIDO="libpipeline-1.5.3.tar.gz"
		PCOVAR_PaqueteNOMBRE="LibPipeline_1_5_3"
		PCOVAR_PaqueteMD5SUM="dad443d0911cf9f0f1bd90a334bc9004"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="libtool"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/libtool/"
		PCOVAR_PaqueteCOMPRIMIDO="libtool-2.4.6.tar.xz"
		PCOVAR_PaqueteNOMBRE="LibTool_2_4_6"
		PCOVAR_PaqueteMD5SUM="1bfb9b923f2c1339b4d2ce1807064aa5"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="m4"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/m4/"
		PCOVAR_PaqueteCOMPRIMIDO="m4-1.4.19.tar.xz"
		PCOVAR_PaqueteNOMBRE="M4_Unix_macro_processor_1_4_19"
		PCOVAR_PaqueteMD5SUM="0d90823e1426f1da2fd872df0311298d"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="make"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/make/"
		PCOVAR_PaqueteCOMPRIMIDO="make-4.3.tar.gz"
		PCOVAR_PaqueteNOMBRE="Make_4_3"
		PCOVAR_PaqueteMD5SUM="fc7a67ea86ace13195b0bce683fd4469"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="man-db"
		PCOVAR_PaqueteURLBASE="https://download.savannah.gnu.org/releases/man-db/"
		PCOVAR_PaqueteCOMPRIMIDO="man-db-2.9.4.tar.xz"
		PCOVAR_PaqueteNOMBRE="Man_DB_2_9_4"
		PCOVAR_PaqueteMD5SUM="6e233a555f7b9ae91ce7cd0faa322bce"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="man-pages"
		PCOVAR_PaqueteURLBASE="https://www.kernel.org/pub/linux/docs/man-pages/"
		PCOVAR_PaqueteCOMPRIMIDO="man-pages-5.13.tar.xz"
		PCOVAR_PaqueteNOMBRE="Manual_Pages_5_13"
		PCOVAR_PaqueteMD5SUM="3ac24e8c6fae26b801cb87ceb63c0a30"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="markupsafe"
		PCOVAR_PaqueteURLBASE="https://files.pythonhosted.org/packages/source/M/MarkupSafe/"
		PCOVAR_PaqueteCOMPRIMIDO="MarkupSafe-2.0.1.tar.gz"
		PCOVAR_PaqueteNOMBRE="MarkupSafe_2_0_1"
		PCOVAR_PaqueteMD5SUM="892e0fefa3c488387e5cc0cad2daa523"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="meson"
		PCOVAR_PaqueteURLBASE="https://github.com/mesonbuild/meson/releases/download/0.59.1/"
		PCOVAR_PaqueteCOMPRIMIDO="meson-0.59.1.tar.gz"
		PCOVAR_PaqueteNOMBRE="Meson_0_59_1"
		PCOVAR_PaqueteMD5SUM="9c8135ecde820094be2f42f457fb6535"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="mpc"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/mpc/"
		PCOVAR_PaqueteCOMPRIMIDO="mpc-1.2.1.tar.gz"
		PCOVAR_PaqueteNOMBRE="MPC_Arithmetic_complex_numbers_1_2_1"
		PCOVAR_PaqueteMD5SUM="9f16c976c25bb0f76b50be749cd7a3a8"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="mpfr"
		PCOVAR_PaqueteURLBASE="https://www.mpfr.org/mpfr-4.1.0/"
		PCOVAR_PaqueteCOMPRIMIDO="mpfr-4.1.0.tar.xz"
		PCOVAR_PaqueteNOMBRE="MPFR_multiple_precision_floating_point_4_1_0"
		PCOVAR_PaqueteMD5SUM="bdd3d5efba9c17da8d83a35ec552baef"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="ncurses"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/ncurses/"
		PCOVAR_PaqueteCOMPRIMIDO="ncurses-6.2.tar.gz"
		PCOVAR_PaqueteNOMBRE="NCurses_6_2"
		PCOVAR_PaqueteMD5SUM="e812da327b1c2214ac1aed440ea3ae8d"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="ninja"
		PCOVAR_PaqueteURLBASE="https://github.com/ninja-build/ninja/archive/v1.10.2/"
		PCOVAR_PaqueteCOMPRIMIDO="ninja-1.10.2.tar.gz"
		PCOVAR_PaqueteNOMBRE="Ninja_1_10_2"
		PCOVAR_PaqueteMD5SUM="639f75bc2e3b19ab893eaf2c810d4eb4"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="openssl"
		PCOVAR_PaqueteURLBASE="https://www.openssl.org/source/"
		PCOVAR_PaqueteCOMPRIMIDO="openssl-1.1.1l.tar.gz"
		PCOVAR_PaqueteNOMBRE="OpenSSL_1_1_1l"
		PCOVAR_PaqueteMD5SUM="ac0d4387f3ba0ad741b0580dd45f6ff3"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="patch"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/patch/"
		PCOVAR_PaqueteCOMPRIMIDO="patch-2.7.6.tar.xz"
		PCOVAR_PaqueteNOMBRE="Patch_2_7_6"
		PCOVAR_PaqueteMD5SUM="78ad9937e4caadcba1526ef1853730d5"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="perl"
		PCOVAR_PaqueteURLBASE="https://www.cpan.org/src/5.0/"
		PCOVAR_PaqueteCOMPRIMIDO="perl-5.34.0.tar.xz"
		PCOVAR_PaqueteNOMBRE="Perl_5_34_0"
		PCOVAR_PaqueteMD5SUM="df7ecb0653440b26dc951ad9dbfab517"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="https://www.linuxfromscratch.org/patches/lfs/11.0/perl-5.34.0-upstream_fixes-1.patch"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="pkg-config"
		PCOVAR_PaqueteURLBASE="https://pkg-config.freedesktop.org/releases/"
		PCOVAR_PaqueteCOMPRIMIDO="pkg-config-0.29.2.tar.gz"
		PCOVAR_PaqueteNOMBRE="PKG_Config_0_29_2"
		PCOVAR_PaqueteMD5SUM="f6e931e319531b736fadc017f470e68a"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="procps-ng"
		PCOVAR_PaqueteURLBASE="https://sourceforge.net/projects/procps-ng/files/Production/"
		PCOVAR_PaqueteCOMPRIMIDO="procps-ng-3.3.17.tar.xz"
		PCOVAR_PaqueteNOMBRE="Procps_NG_3_3_17"
		PCOVAR_PaqueteMD5SUM="d60613e88c2f442ebd462b5a75313d56"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="psmisc"
		PCOVAR_PaqueteURLBASE="https://sourceforge.net/projects/psmisc/files/psmisc/"
		PCOVAR_PaqueteCOMPRIMIDO="psmisc-23.4.tar.xz"
		PCOVAR_PaqueteNOMBRE="PSMisc_23_4"
		PCOVAR_PaqueteMD5SUM="8114cd4489b95308efe2509c3a406bbf"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="python"
		PCOVAR_PaqueteURLBASE="https://www.python.org/ftp/python/3.9.6/"
		PCOVAR_PaqueteCOMPRIMIDO="Python-3.9.6.tar.xz"
		PCOVAR_PaqueteNOMBRE="Python_3_9_6"
		PCOVAR_PaqueteMD5SUM="ecc29a7688f86e550d29dba2ee66cf80"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="python-3-9-6-docs-html"
		PCOVAR_PaqueteURLBASE="https://www.python.org/ftp/python/doc/3.9.6/"
		PCOVAR_PaqueteCOMPRIMIDO="python-3.9.6-docs-html.tar.bz2"
		PCOVAR_PaqueteNOMBRE="Python_3_9_6_Docs_HTML"
		PCOVAR_PaqueteMD5SUM="0dae29e4c38af1b6b1a86b35c9e48923"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="readline"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/readline/"
		PCOVAR_PaqueteCOMPRIMIDO="readline-8.1.tar.gz"
		PCOVAR_PaqueteNOMBRE="Readline_8_1"
		PCOVAR_PaqueteMD5SUM="e9557dd5b1409f5d7b37ef717c64518e"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="sed"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/sed/"
		PCOVAR_PaqueteCOMPRIMIDO="sed-4.8.tar.xz"
		PCOVAR_PaqueteNOMBRE="SED_StreamEditor_4_8"
		PCOVAR_PaqueteMD5SUM="6d906edfdb3202304059233f51f9a71d"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="shadow"
		PCOVAR_PaqueteURLBASE="https://github.com/shadow-maint/shadow/releases/download/v4.9/"
		PCOVAR_PaqueteCOMPRIMIDO="shadow-4.9.tar.xz"
		PCOVAR_PaqueteNOMBRE="Shadow_4_9"
		PCOVAR_PaqueteMD5SUM="126924090caf72f3de7e9261fd4e10ac"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="systemd"
		PCOVAR_PaqueteURLBASE="https://github.com/systemd/systemd/archive/v249/"
		PCOVAR_PaqueteCOMPRIMIDO="systemd-249.tar.gz"
		PCOVAR_PaqueteNOMBRE="Systemd_249"
		PCOVAR_PaqueteMD5SUM="8e8adf909c255914dfc10709bd372e69"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="https://www.linuxfromscratch.org/patches/lfs/11.0/systemd-249-upstream_fixes-1.patch"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="systemd-man-pages"
		PCOVAR_PaqueteURLBASE="https://anduin.linuxfromscratch.org/LFS/"
		PCOVAR_PaqueteCOMPRIMIDO="systemd-man-pages-249.tar.xz"
		PCOVAR_PaqueteNOMBRE="Systemd_manual_pages_249"
		PCOVAR_PaqueteMD5SUM="d9f2508d6b114b1c02476cd79b8fc786"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="tar"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/tar/"
		PCOVAR_PaqueteCOMPRIMIDO="tar-1.34.tar.xz"
		PCOVAR_PaqueteNOMBRE="TAR_Tape_archiver_1_34"
		PCOVAR_PaqueteMD5SUM="9a08d29a9ac4727130b5708347c0f5cf"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="tcl"
		PCOVAR_PaqueteURLBASE="https://downloads.sourceforge.net/tcl/"
		PCOVAR_PaqueteCOMPRIMIDO="tcl8.6.11-src.tar.gz"
		PCOVAR_PaqueteNOMBRE="TCL_8_6_11"
		PCOVAR_PaqueteMD5SUM="8a4c004f48984a03a7747e9ba06e4da4"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="tcl-html"
		PCOVAR_PaqueteURLBASE="https://downloads.sourceforge.net/tcl/"
		PCOVAR_PaqueteCOMPRIMIDO="tcl8.6.11-html.tar.gz"
		PCOVAR_PaqueteNOMBRE="TCL_8_6_11_DocsHTML"
		PCOVAR_PaqueteMD5SUM="e358a9140c3a171e42f18c8a7f6a36ea"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="texinfo"
		PCOVAR_PaqueteURLBASE="https://ftp.gnu.org/gnu/texinfo/"
		PCOVAR_PaqueteCOMPRIMIDO="texinfo-6.8.tar.xz"
		PCOVAR_PaqueteNOMBRE="TexInfo_6_8"
		PCOVAR_PaqueteMD5SUM="a91b404e30561a5df803e6eb3a53be71"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="tzdata"
		PCOVAR_PaqueteURLBASE="https://www.iana.org/time-zones/repository/releases/"
		PCOVAR_PaqueteCOMPRIMIDO="tzdata2021a.tar.gz"
		PCOVAR_PaqueteNOMBRE="Time_Zone_Data_2021a"
		PCOVAR_PaqueteMD5SUM="20eae7d1da671c6eac56339c8df85bbd"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="util-linux"
		PCOVAR_PaqueteURLBASE="https://www.kernel.org/pub/linux/utils/util-linux/v2.37/"
		PCOVAR_PaqueteCOMPRIMIDO="util-linux-2.37.2.tar.xz"
		PCOVAR_PaqueteNOMBRE="Util_Linux_2_37_2"
		PCOVAR_PaqueteMD5SUM="d659bf7cd417d93dc609872f6334b019"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="vim"
		PCOVAR_PaqueteURLBASE="https://anduin.linuxfromscratch.org/LFS/"
		PCOVAR_PaqueteCOMPRIMIDO="vim-8.2.3337.tar.gz"
		PCOVAR_PaqueteNOMBRE="Vim_8_2_3337"
		PCOVAR_PaqueteMD5SUM="e0325a4988b1b99b9c2e46fa853c1980"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="xml-parser"
		PCOVAR_PaqueteURLBASE="https://cpan.metacpan.org/authors/id/T/TO/TODDR/"
		PCOVAR_PaqueteCOMPRIMIDO="XML-Parser-2.46.tar.gz"
		PCOVAR_PaqueteNOMBRE="XML_Parser_2_46"
		PCOVAR_PaqueteMD5SUM="80bb18a8e6240fcf7ec2f7b57601c170"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="xz"
		PCOVAR_PaqueteURLBASE="https://tukaani.org/xz/"
		PCOVAR_PaqueteCOMPRIMIDO="xz-5.2.5.tar.xz"
		PCOVAR_PaqueteNOMBRE="XZ_Data_compression_5_2_5"
		PCOVAR_PaqueteMD5SUM="aa1621ec7013a19abab52a8aff04fe5b"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="zlib"
		PCOVAR_PaqueteURLBASE="https://zlib.net/"
		PCOVAR_PaqueteCOMPRIMIDO="zlib-1.2.11.tar.xz"
		PCOVAR_PaqueteNOMBRE="ZLib_1_2_11"
		PCOVAR_PaqueteMD5SUM="85adef240c5f370b308da8c938951a68"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU

		PCOVAR_PaqueteARCHIVO="zstd"
		PCOVAR_PaqueteURLBASE="https://github.com/facebook/zstd/releases/download/v1.5.0/"
		PCOVAR_PaqueteCOMPRIMIDO="zstd-1.5.0.tar.gz"
		PCOVAR_PaqueteNOMBRE="Zstd_Fast_compression_algorithm_1_5_0"
		PCOVAR_PaqueteMD5SUM="a6eb7fb1f2c21fa80030a47993853e92"
		PCOVAR_PaqueteDEPENDENCIAS="N/A"
		PCOVAR_PaquetePARCHE="N/A"
		PCOVAR_PaqueteSBU="0"
		GenerarArchivoRepositorio  	$PCOVAR_PaqueteARCHIVO $PCOVAR_PaqueteURLBASE $PCOVAR_PaqueteCOMPRIMIDO $PCOVAR_PaqueteNOMBRE $PCOVAR_PaqueteURLDESCARGA $PCOVAR_PaqueteDEPENDENCIAS $PCOVAR_PaquetePARCHE $PCOVAR_PaqueteMD5SUM $PCOVAR_PaqueteSBU
	}


########################################################################
########################################################################
# Principal:  Este es el programa principal que inicia todo
	PCOVAR_SBU_Binutils=0	#Inicializa unidad estandar de construccion

	ChequearPermisos
	Inicializar
	ChequearDependencias

	#Test zone:  A line to put some functions for a quickly test
	#ServiceIsRunning sshd
	#exit 0

	MenuPrincipal
	Finalizar



































########################################################################
########################################################################
# Function Compilar_PaqueteBUSYBOX
Compilar_PaqueteBUSYBOX()
	{
		echo -e "\nPreparando area de trabajo para ${PCOVAR_PaqueteARCHIVO}.  Espere..."
		sleep 1
		make distclean -j $PCOVAR_NumProcesosMake
		echo -e "\nGenerando configuracion por defecto para ${PCOVAR_PaqueteARCHIVO}.  Espere..."
		make defconfig -j $PCOVAR_NumProcesosMake

		# Indicamos a Busybox que use el area de sysroot definida agregando ese parametro al archivo
		sed -i "s|.*CONFIG_SYSROOT.*|CONFIG_SYSROOT=\"$PCOVAR_SysRoot\"|" .config

		# Configuramos banderas del compilador y linkeamos Busybox con GLIBC desde el sysroot   #MIRAR -L ESPACIO
		sed -i "s|.*CONFIG_EXTRA_CFLAGS.*|CONFIG_EXTRA_CFLAGS=\"$PCOVAR_CFlags -L $PCOVAR_SysRoot/lib\"|" .config

		# Compila el paquete con optimizacion para "procesos en paralelo"
		echo -e "Compilando $PCOVAR_PaqueteARCHIVO"
		make \
		  busybox -j $PCOVAR_NumProcesosMake

		make \
		  CONFIG_PREFIX="${PCOVAR_PathActual}/pco_sources/busybox" \
		  install -j $PCOVAR_NumProcesosMake
	}


########################################################################
########################################################################
# Function CompilarPaquete_LINUX
CompilarPaquete_LINUX()
	{
		make mrproper -j $PCOVAR_NumProcesosMake

# Read the 'USE_PREDEFINED_KERNEL_CONFIG' property from '.config'
USE_PREDEFINED_KERNEL_CONFIG=`read_property USE_PREDEFINED_KERNEL_CONFIG`
BUILD_KERNEL_MODULES=`read_property BUILD_KERNEL_MODULES`

if [ "$USE_PREDEFINED_KERNEL_CONFIG" = "true" -a ! -f $SRC_DIR/minimal_config/kernel.config ] ; then
  echo "Config file '$SRC_DIR/minimal_config/kernel.config' does not exist."
  USE_PREDEFINED_KERNEL_CONFIG=false
fi

if [ "$USE_PREDEFINED_KERNEL_CONFIG" = "true" ] ; then
  # Use predefined configuration file for the kernel.
  echo "Using config file '$SRC_DIR/minimal_config/kernel.config'."
  cp -f $SRC_DIR/minimal_config/kernel.config .config
else
  # Create default configuration file for the kernel.
  make defconfig -j $NUM_JOBS
  echo "Generated default kernel configuration."

  # Changes the name of the system to 'minimal'.
  sed -i "s/.*CONFIG_DEFAULT_HOSTNAME.*/CONFIG_DEFAULT_HOSTNAME=\"minimal\"/" .config

  # OVERLAYFS - BEGIN - most features are disabled (you don't really need them)

  # Enable overlay support, e.g. merge ro and rw directories (3.18+).
  sed -i "s/.*CONFIG_OVERLAY_FS.*/CONFIG_OVERLAY_FS=y/" .config

  # Turn on redirect dir feature by default (4.10+).
  echo "# CONFIG_OVERLAY_FS_REDIRECT_DIR is not set" >> .config

  # Turn on inodes index feature by default (4.13+).
  echo "# CONFIG_OVERLAY_FS_INDEX is not set" >> .config

  # Follow redirects even if redirects are turned off (4.15+).
  echo "CONFIG_OVERLAY_FS_REDIRECT_ALWAYS_FOLLOW=y" >> .config

  # Turn on NFS export feature by default (4.16+).
  echo "# CONFIG_OVERLAY_FS_NFS_EXPORT is not set" >> .config

  # Auto enable inode number mapping (4.17+).
  echo "# CONFIG_OVERLAY_FS_XINO_AUTO is not set" >> .config

  # Тurn on metadata only copy up feature by default (4.19+).
  echo "# CONFIG_OVERLAY_FS_METACOPY is not set" >> .config

  # OVERLAYFS - END

  # Step 1 - disable all active kernel compression options (should be only one).
  sed -i "s/.*\\(CONFIG_KERNEL_.*\\)=y/\\#\\ \\1 is not set/" .config

  # Step 2 - enable the 'xz' compression option.
  sed -i "s/.*CONFIG_KERNEL_XZ.*/CONFIG_KERNEL_XZ=y/" .config

  # Enable the VESA framebuffer for graphics support.
  sed -i "s/.*CONFIG_FB_VESA.*/CONFIG_FB_VESA=y/" .config

  # Read the 'USE_BOOT_LOGO' property from '.config'
  USE_BOOT_LOGO=`read_property USE_BOOT_LOGO`

  if [ "$USE_BOOT_LOGO" = "true" ] ; then
    sed -i "s/.*CONFIG_LOGO_LINUX_CLUT224.*/CONFIG_LOGO_LINUX_CLUT224=y/" .config
    echo "Boot logo is enabled."
  else
    sed -i "s/.*CONFIG_LOGO_LINUX_CLUT224.*/\\# CONFIG_LOGO_LINUX_CLUT224 is not set/" .config
    echo "Boot logo is disabled."
  fi

  # Disable debug symbols in kernel => smaller kernel binary.
  sed -i "s/^CONFIG_DEBUG_KERNEL.*/\\# CONFIG_DEBUG_KERNEL is not set/" .config

  # Enable the EFI stub
  sed -i "s/.*CONFIG_EFI_STUB.*/CONFIG_EFI_STUB=y/" .config

  # Request that the firmware clear the contents of RAM after reboot (4.14+).
  echo "CONFIG_RESET_ATTACK_MITIGATION=y" >> .config

  # Disable Apple Properties (Useful for Macs but useless in general)
  echo "CONFIG_APPLE_PROPERTIES=n" >> .config

  # Check if we are building 64-bit kernel.
  if [ "`grep "CONFIG_X86_64=y" .config`" = "CONFIG_X86_64=y" ] ; then
    # Enable the mixed EFI mode when building 64-bit kernel.
    echo "CONFIG_EFI_MIXED=y" >> .config
  fi
fi

# Compile the kernel with optimization for 'parallel jobs' = 'number of processors'.
# Good explanation of the different kernels:
# http://unix.stackexchange.com/questions/5518/what-is-the-difference-between-the-following-kernel-makefile-terms-vmlinux-vmlinux
echo "Building kernel."
make \
  CFLAGS="$CFLAGS" \
  bzImage -j $NUM_JOBS

if [ "$BUILD_KERNEL_MODULES" = "true" ] ; then
  echo "Building kernel modules."
  make \
    CFLAGS="$CFLAGS" \
    modules -j $NUM_JOBS
fi

# Prepare the kernel install area.
echo "Removing old kernel artifacts. This may take a while."
rm -rf $KERNEL_INSTALLED
mkdir $KERNEL_INSTALLED

echo "Installing the kernel."
# Install the kernel file.
cp arch/x86/boot/bzImage \
  $KERNEL_INSTALLED/kernel

if [ "$BUILD_KERNEL_MODULES" = "true" ] ; then
  make INSTALL_MOD_PATH=$KERNEL_INSTALLED \
    modules_install -j $NUM_JOBS
fi

# Install kernel headers which are used later when we build and configure the
# GNU C library (glibc).
echo "Generating kernel headers."
make \
  INSTALL_HDR_PATH=$KERNEL_INSTALLED \
  headers_install -j $NUM_JOBS

cd $SRC_DIR

echo "*** BUILD KERNEL END ***"
	}



########################################################################
########################################################################
# Function CompilarPaquete_GLIBC
CompilarPaquete_GLIBC()
	{

# Prepare the work area, e.g. 'work/glibc/glibc_objects'.
echo "Preparing glibc object area. This may take a while."
rm -rf $GLIBC_OBJECTS
mkdir $GLIBC_OBJECTS

# Prepare the install area, e.g. 'work/glibc/glibc_installed'.
echo "Preparing glibc install area. This may take a while."
rm -rf $GLIBC_INSTALLED
mkdir $GLIBC_INSTALLED

# Find the glibc source directory, e.g. 'glibc-2.23' and remember it.
GLIBC_SRC=`ls -d $WORK_DIR/glibc/glibc-*`

# All glibc work is done from the working area.
cd $GLIBC_OBJECTS

# 'glibc' is configured to use the root folder (--prefix=) and as result all
# libraries will be installed in '/lib'. Note that on 64-bit machines Busybox
# will be linked with the libraries in '/lib' while the Linux loader is expected
# to be in '/lib64'. Kernel headers are taken from our already prepared kernel
# header area (see xx_build_kernel.sh). Packages 'gd' and 'selinux' are disabled
# for better build compatibility with the host system.
echo "Configuring glibc."
$GLIBC_SRC/configure \
  --prefix= \
  --with-headers=$KERNEL_INSTALLED/include \
  --without-gd \
  --without-selinux \
  --disable-werror \
  CFLAGS="$CFLAGS"

# Compile glibc with optimization for "parallel jobs" = "number of processors".
echo "Building glibc."
make -j $NUM_JOBS

# Install glibc in the installation area, e.g. 'work/glibc/glibc_installed'.
echo "Installing glibc."
make install \
  DESTDIR=$GLIBC_INSTALLED \
  -j $NUM_JOBS

cd $SRC_DIR

echo "*** BUILD GLIBC END ***"
	}


########################################################################
########################################################################
# Function RecompilarPaquete
# Limpia y Recompila un paquete especifico recibido como parametro ($1)
RecompilarPaqueteOLD()
	{


		#TODO: PDTE validar si el paquete existe y ha sido descargado!!!!


		#Ejecuta archivo de repositorio para cargar las variables correspondientes
		source ./pco_repo/$1.sh
		#Presenta mensaje
		echo -e "\nConstruyendo: $PCOVAR_PaqueteNOMBRE"
		echo -e "Limpiando construcciones previas de ${PCOVAR_PaqueteARCHIVO}.  Espere..."
		sleep 1

		#Extrae de nuevo los fuentes para evitar cualquier basura
		ExtraerPaquete ${PCOVAR_PaqueteARCHIVO}.sh

		# Ingresa a la carpeta del paquete
		cd $PCOVAR_PathActual/pco_sources/$PCOVAR_PaqueteARCHIVO

		# Llama la rutina de compilacion especifica segun el paquete
			if [[ "$PCOVAR_PaqueteARCHIVO" == "busybox" ]]; then
				Compilar_PaqueteBUSYBOX
			fi
			if [[ "$PCOVAR_PaqueteARCHIVO" == "linux" ]]; then
				CompilarPaquete_LINUX
			fi
			if [[ "$PCOVAR_PaqueteARCHIVO" == "glibc" ]]; then
				CompilarPaquete_GLIBC
			fi


		# Regresa a la carpeta de trabajo inicial
		cd $PCOVAR_PathActual

		echo -e "\nFinalizado: $PCOVAR_PaqueteNOMBRE\nRegresando al menu..."
		sleep 2
	}




########################################################################
########################################################################
# Function BaseConfig
# Presents the form to edit the base configuration for the tool
BaseConfig()
	{
		# Label,Row,Col,Variable/Value,Row,Col,FLen(0=RO,VisualLen),ILen(MaxLen),TYPE (mixedform) 0=Standar,1=hidden,2=ReadOnly
		ConfigValues=$(dialog --ok-label "Apply config" --backtitle "$PCOVAR_Title" --output-fd 1 --title "General configuration" --form "Paths to get, save or recover some configurations\n\nIMPORTANT: Configuration will apply at runtime (inmediately) and will be writted/saved (definitely) when you close this tool" 15 60 0 \
			"VM Definitions:"	1 1	"$PCOVAR_DefaultVMMPath" 	1 17 200 200 \
			"Virtual Disks:"	2 1	"$PCOVAR_DefaultVDDPath"  	2 17 200 0 \
			"ISO files:"		3 1	"$PCOVAR_DefaultISOPath"  	3 17 200 0 )

		# Parse form values to assing the value to variables
		# Variables values are taken IN ORDEN from their order in the form
		typeset -i PosValue=1
		set -A ArrayValues
		for VariableValue in $ConfigValues
			do
				case $PosValue in
					1) PCOVAR_DefaultVMMPath=$VariableValue;;
					2) PCOVAR_DefaultVDDPath=$VariableValue;;
					3) PCOVAR_DefaultISOPath=$VariableValue;;
				esac
				((PosValue=PosValue+1))
			done
	}


########################################################################
########################################################################
# Function Notify
# Push a message in the notification area for the user
# $1 = The message to show to the user
# $2 = The expire time in milliseconds.  If is empty the default will be 5 seconds
Notify()
	{
		ExpireTime=$2
		if [[ "$ExpireTime" == "" ]]; then
			ExpireTime=5000
		fi
		notify-send $1 -t $ExpireTime
	}


########################################################################
########################################################################
# Function Logger
# Push a message in the system logs
# $1 = The message to put
Logger()
	{
		# Put the same message on the screen
		if [[ "$PCOVAR_TTYXMode" == "YES" ]]; then
			Notify "$1"
		fi
		logger "[vmctl-PCOVAR] $1"
	}


########################################################################
########################################################################
# Function HttpClient
# Get an HTML page or URL using wget command
# $1 = The URL to get
HttpClient()
	{
		case "$1" in
		  http://*)
			;;
		  *)
			Logger "Correct_Usage: http://server[:port]/[...]"
			;;
		esac
		HttpContentLoaded=$(eval "wget -qO- '${1}' ") >> /dev/null
	}



########################################################################
########################################################################
# Function DiskCreationForm
# Presents the form for virtual disk creation
DiskCreationForm()
	{
		#Get date and time to use it i the name of the disk
		CurrentDate=$(date +%Y%m%d)
		CurrentTime=$(date +%H%M)
		CurrentDateTime=${CurrentDate}_${CurrentTime}
		# Label,Row,Col,Variable/Value,Row,Col,FLen(0=RO,VisualLen),ILen(MaxLen),TYPE (mixedform) 0=Standar,1=hidden,2=ReadOnly
		CreateDiskParameters=$(dialog --ok-label "Create" --cancel-label "Discard" --backtitle "$PCOVAR_Title" --output-fd 1 --title "Creating a new virtual disk" --mixedform "  Default path: $PCOVAR_DefaultVDDPath" 9 70 0 \
			"Disk name:"	1 1	"MyDisk_$CurrentDateTime.hd" 	1 12 200 200 0\
			"Size:               (It should finish in M=Megas or G=Gigas)"			2 1	"8G"				2 12 7 6 0\
			"Base disk: (Not available)"	3 1	""  	3 60 2 0 2)

		# Parse form values to assing the value to variables
		# Variables values are taken IN ORDEN from their order in the form
		typeset -i PosValue=1
		set -A ArrayValues
		for VariableValue in $CreateDiskParameters
			do
				case $PosValue in
					1) PCOVAR_DiskName=$VariableValue;;
					2) PCOVAR_DiskSize=$VariableValue;;
				esac
				((PosValue=PosValue+1))
			done
		# Launch the operation.  This dont need to check anything cause vmctl validate every parameter. Just take output and show it to the user
		if [[ "$PCOVAR_DiskName" != "$PCOVAR_ValorVacio" ]] && [[ "$PCOVAR_DiskSize" != "PCOVAR_ValorVacio" ]]; then
			CreateDiskOutput=$(vmctl create ${PCOVAR_DefaultVDDPath}/${PCOVAR_DiskName} -s ${PCOVAR_DiskSize} 2>&1 ) # 2>&1 Redirect output to show later
			echo [$CurrentDate $CurrentTime] $PCOVAR_DiskName $CreateDiskOutput >> logs/Disks.log
			dialog --title "Status" --msgbox "${PCOVAR_DefaultVDDPath}/${PCOVAR_DiskName} \n\n$CreateDiskOutput" 8 50
		fi
	}


########################################################################
########################################################################
# Function DeleteImageList
# Take a disk name as $1 parameter and delete it from the VDD directory
DeleteImageList()
	{
		ConfirmAnswer=$(dialog --output-fd 1 --clear --backtitle "$PCOVAR_Title" --title "WARNING - WARNING - WARNING"  --yesno "You are going to delete the disk:\n$1\n\nThis operation can not be undone later!\n\nARE YOU SURE?" 11 65 )
		ConfirmAnswer=$?   # 0=YES, 1=NO
		# Delete de disk file if the answer is YES
		if [[ "$ConfirmAnswer" == 0 ]]; then
			rm ${PCOVAR_DefaultVDDPath}/${1}
			echo [$CurrentDate $CurrentTime] Deleted disk $1 >> logs/Disks.log
        fi
	}


########################################################################
########################################################################
# Function DiskImageList
# Presents a list with all the disk images created
DiskImageList()
	{
		#DEPRECATED Process the ls command output line by line and store it in MenuOptions
		#MenuOptions=$(ls ${PCOVAR_DefaultVDDPath} | while read -r OutputLine; do
		#	echo ${OutputLine}" disk"
		#done)
		MenuOptions=$(ls -lh $PCOVAR_DefaultVDDPath | awk '{print $9,$5}' | grep -viw "_blank" ) # Without the _blank file
		MenuOptions="VIRTUAL_DISK_NAME SIZE"${MenuOptions} # Add a title to have at least one option for dialog syntax
		DiskOperationMenuAnswer=$(dialog --output-fd 1 --clear --backtitle "$PCOVAR_Title" --title "Virtual Disks Found" --menu "" 15 50 10 $MenuOptions )

		if [[ "$DiskOperationMenuAnswer" != "$PCOVAR_ValorVacio" ]] && [[ "$DiskOperationMenuAnswer" != "VIRTUAL_DISK_NAME" ]]; then
			DeleteImageList $DiskOperationMenuAnswer
		fi
	}


########################################################################
########################################################################
# Function ServiceIsRunning
# This function search if a gived service name as parameter is running or not. I.E.  ServiceIsRunning  sshd
ServiceIsRunning()
	{
		if P=$(pgrep $1)
		then
			echo "$1 is running, PID is $P"
		else
			echo "$1 is not running"
		fi
	}


########################################################################
########################################################################
# Function DisksManager
# Presents a menu to manage disks for virtual machinnes
DisksManager()
	{
		while true
		do
			DiskMenuAnswer=$(dialog --output-fd 1 --clear --backtitle "$PCOVAR_Title" --title "Virtual Disks Menu" --menu "" 15 50 10 \
			N "Create a new virtual disk" \
			L "Delete a virtual disk" \
			V "View virtual disks logs" \
			E "Return to the main menu" )

			case $DiskMenuAnswer in
				N) DiskCreationForm;;
				V) dialog --title "Virtual disks LOGS" --msgbox "$(cat logs/Disks.log)" 20 75 ;;
				L) DiskImageList;;
				E) break;;
				$PCOVAR_ValorVacio) break;;
			esac
		done
	}


########################################################################
########################################################################
# Function ISOsManager
# Presents a list with all the ISO images availables to create virtual machinnes
ISOsManager()
	{
		MenuOptions=$(ls -lh $PCOVAR_DefaultISOPath | awk '{print $9,$5}' | grep -viw "_blank" ) # Without the _blank file
		MenuOptions="ISOS_IMAGES_AVAILABLES SIZE"${MenuOptions} # Add a title to have at least one option for dialog syntax
		DiskOperationMenuAnswer=$(dialog --colors  --hline "\Zb\Z1REMEMBER_To_add_more_just_copy_them_to_your_ISOS_folder" --output-fd 1 --clear --backtitle "$PCOVAR_Title" --title "ISOS Found under $PCOVAR_DefaultISOPath" --menu "" 15 70 10 $MenuOptions )

		if [[ "$DiskOperationMenuAnswer" != "$PCOVAR_ValorVacio" ]] && [[ "$DiskOperationMenuAnswer" != "ISOS_IMAGES_AVAILABLES" ]]; then
			DeleteImageList $DiskOperationMenuAnswer
		fi
	}


########################################################################
########################################################################
# Function GuestEdit
# Presents the form to edit the configuration for a guest
GuestEdit()
	{
		MenuGuests=$(ls -lh $PCOVAR_DefaultVMMPath | awk '{printf("%s %s%s\n",$9,$6,$7)}' | grep -viw "New_Machinne_TEMPLATE.conf" ) # Without the template file
		MenuGuests="GUESTS_MACHINNES_DEFINED MODIFIED"${MenuGuests} # Add a title to have at least one option for dialog syntax
		GuestSelectedToEdit=$(dialog --colors --output-fd 1 --clear --backtitle "$PCOVAR_Title" --title "Edit a Guest configuration" --menu "" 15 70 10 $MenuGuests )

		if [[ "$GuestSelectedToEdit" != "$PCOVAR_ValorVacio" ]] && [[ "$GuestSelectedToEdit" != "GUESTS_MACHINNES_DEFINED" ]]; then
			# Load configuration files for the VM
			. $PCOVAR_DefaultVMMPath/$GuestSelectedToEdit

			# Label,Row,Col,Variable/Value,Row,Col,FLen(0=RO,VisualLen),ILen(MaxLen),TYPE (mixedform) 0=Standar,1=hidden,2=ReadOnly
			GuestValues=$(dialog --ok-label "Save config" --colors --nocancel --cancel-label "Discard" --backtitle "$PCOVAR_Title" --output-fd 1 --title "Base machinne configuration" --mixedform "WARNING: You should take care of the paths and file names when you are editting a guest manually.\n\nIf the guest is already running changes will take effect in the next boot.\n\Zb\Z1** TIP: Change the guest name if you want to create a new machinne using this values as template." 17 70 0\
				"Guest name:"	1 1	"${GUEST_Name}" 	1 14 200 200 0\
				"RAM Size:               (It should finish in M=Megas)"			2 1	"${GUEST_RAMSize}"				2 14 7 6 0\
				"Run mode:    (Disabled. -c for console auto or none for silent)"	3 1	""  	3 60 2 0 2\
				"ISO Image:"	4 1	"${GUEST_ISO_Image}" 	4 14 200 200 0\
				"Disk Image:"	5 1	"${GUEST_VDD_Image}" 	5 14 200 200 0)

			# Parse form values to assing the value to variables
			# Variables values are taken IN ORDEN from their order in the form
			typeset -i PosValue=1
			set -A ArrayValues
			for VariableValue in $GuestValues
				do
					case $PosValue in
						1) GUEST_Name=$VariableValue;;
						2) GUEST_RAMSize=$VariableValue;;
						3) GUEST_ISO_Image=$VariableValue;;
						4) GUEST_VDD_Image=$VariableValue;;
					esac
					((PosValue=PosValue+1))
				done

			#Write config file for the guest
				GuestConfigFile="data/guests/${GUEST_Name}.sh"
				echo $GuestConfigFile
				echo '#!/bin/ksh' > ${GuestConfigFile}
				echo '\n# WARNING !!!  Do not edit this file manually or will be overwrited' >> ${GuestConfigFile}
				echo '#              This was created automatically by vmctl-PCOVAR\n' >> ${GuestConfigFile}
				Copyright >> ${GuestConfigFile}
				echo '' >> ${GuestConfigFile}
				echo 'GUEST_Name="'$GUEST_Name'"' >> ${GuestConfigFile}
				echo 'GUEST_RAMSize="'$GUEST_RAMSize'"' >> ${GuestConfigFile}
				echo 'GUEST_ISO_Image="'$GUEST_ISO_Image'"' >> ${GuestConfigFile}
				echo 'GUEST_VDD_Image="'$GUEST_VDD_Image'"' >> ${GuestConfigFile}

			echo [$CurrentDate $CurrentTime] $GUEST_Name Config modified >> logs/Guests.log
		fi
	}


########################################################################
########################################################################
# Function GuestsCreateWizard
# Presents a menu to manage virtual machinnes and their properties
GuestsCreateWizard()
	{
		dialog --backtitle "$PCOVAR_Title" --infobox "Machinne wizard" 4 20
		sleep 1

		# Basic parameters
		# Label,Row,Col,Variable/Value,Row,Col,FLen(0=RO,VisualLen),ILen(MaxLen),TYPE (mixedform) 0=Standar,1=hidden,2=ReadOnly

		GuestValues=$(dialog --ok-label "Next" --no-cancel --cancel-label "Back" --backtitle "$PCOVAR_Title" --output-fd 1 --title "Base machinne configuration" --mixedform "  This wizard will help you to define the most commons parameters to create a new virtual machine.  Please fill all the fields below.\n\nCTRL+C at any time to cancel this app" 12 70 0\
			"Guest name:"	1 1	"MyMachineName" 	1 14 200 200 0\
			"RAM Size:               (It should finish in M=Megas)"			2 1	"1024M"				2 14 7 6 0\
			"Run mode:    (Disabled. -c for console auto or none for silent)"	3 1	""  	3 60 2 0 2)

		# Parse form values to assing the value to variables
		# Variables values are taken IN ORDEN from their order in the form
		typeset -i PosValue=1
		set -A ArrayValues
		for VariableValue in $GuestValues
			do
				case $PosValue in
					1) GUEST_Name=$VariableValue;;
					2) GUEST_RAMSize=$VariableValue;;
				esac
				((PosValue=PosValue+1))
			done

		# ISO image selection for the install process
		# DEPRECATED ISODisc=$(dialog --title "Please choose a file for your ISO install image" --fselect ${PCOVAR_DefaultISOPath} 8 60)
		MenuOptions=$(ls -lh $PCOVAR_DefaultISOPath | awk '{print $9,$5}' | grep -viw "_blank" ) # Without the _blank file
		MenuOptions="ISOS_IMAGES_AVAILABLES SIZE"${MenuOptions} # Add a title to have at least one option for dialog syntax
		GUEST_ISO_Image=$(dialog  --output-fd 1 --clear --backtitle "$PCOVAR_Title" --title "Please choose an ISO file for your install process" --menu "" 15 70 10 $MenuOptions )

		# HDD image selection for the guest
		MenuOptions=$(ls -lh $PCOVAR_DefaultVDDPath | awk '{print $9,$5}' | grep -viw "_blank" ) # Without the _blank file
		MenuOptions="VIRTUAL_DISKS_AVAILABLES SIZE"${MenuOptions} # Add a title to have at least one option for dialog syntax
		GUEST_VDD_Image=$(dialog  --output-fd 1 --clear --backtitle "$PCOVAR_Title" --title "Please choose a DISC image to deploy your install" --menu "" 15 70 10 $MenuOptions )

		#Write config file for the guest
			GuestConfigFile="data/guests/${GUEST_Name}.sh"
			echo $GuestConfigFile
			echo '#!/bin/ksh' > ${GuestConfigFile}
			echo '\n# WARNING !!!  Do not edit this file manually or will be overwrited' >> ${GuestConfigFile}
			echo '#              This was created automatically by vmctl-PCOVAR\n' >> ${GuestConfigFile}
			Copyright >> ${GuestConfigFile}
			echo '' >> ${GuestConfigFile}
			echo 'GUEST_Name="'$GUEST_Name'"' >> ${GuestConfigFile}
			echo 'GUEST_RAMSize="'$GUEST_RAMSize'"' >> ${GuestConfigFile}
			echo 'GUEST_ISO_Image="'$GUEST_ISO_Image'"' >> ${GuestConfigFile}
			echo 'GUEST_VDD_Image="'$GUEST_VDD_Image'"' >> ${GuestConfigFile}

		echo [$CurrentDate $CurrentTime] $GUEST_Name Created >> logs/Guests.log
		ConfirmRunNow=$(dialog --output-fd 1 --yes-label "Yes, save config and run it!"  --no-label "No, just create it" --clear --backtitle "$PCOVAR_Title" --title "Final check!"  --yesno "\nGuest configuration brief\n\n  Guest name:      $GUEST_Name\n  Memory RAM size: $GUEST_RAMSize\n  CD/DVDROM:       $GUEST_ISO_Image\n  Virtual Disk:    $GUEST_VDD_Image\n\nDo you want to launch this VM now?" 14 65 )
		ConfirmRunNow=$?   # 0=YES, 1=NO
		# Try to launch the guest right now
		if [[ "$ConfirmRunNow" == 0 ]]; then
			RunOutput=$(doas vmctl start ${GUEST_Name} -d ${PCOVAR_DefaultISOPath}/${GUEST_ISO_Image} -d ${PCOVAR_DefaultVDDPath}/${GUEST_VDD_Image} -m ${GUEST_RAMSize} )
			echo [$CurrentDate $CurrentTime] $GUEST_Name Started >> logs/Guests.log
        fi
		dialog --title "Final status" --msgbox "Created ${GUEST_Name} \n\n$RunOutput" 8 50
	}


########################################################################
########################################################################
# Function StartGuest
# Presents all guests created and allow to run it
StartGuest()
	{
		MenuGuests=$(ls -lh $PCOVAR_DefaultVMMPath | awk '{printf("%s %s%s\n",$9,$6,$7)}' | grep -viw "New_Machinne_TEMPLATE.conf" ) # Without the template file
		MenuGuests="GUESTS_MACHINNES_DEFINED MODIFIED"${MenuGuests} # Add a title to have at least one option for dialog syntax
		GuestSelectedToRun=$(dialog --colors --output-fd 1 --clear --backtitle "$PCOVAR_Title" --title "Start a Guest from $PCOVAR_DefaultVMMPath" --menu "" 15 70 10 $MenuGuests )

		if [[ "$GuestSelectedToRun" != "$PCOVAR_ValorVacio" ]] && [[ "$GuestSelectedToRun" != "GUESTS_MACHINNES_DEFINED" ]]; then
			# Load configuration files for the VM
			. $PCOVAR_DefaultVMMPath/$GuestSelectedToRun

			ConfirmRunNow=$(dialog --output-fd 1 --yes-label "Yes, run it!"  --no-label "Cancel" --clear --backtitle "$PCOVAR_Title" --title "Please confirm"  --yesno "\nYou are going to start this guest:\n\n  Guest name:      $GUEST_Name\n  Memory RAM size: $GUEST_RAMSize\n  CD/DVDROM:       $GUEST_ISO_Image\n  Virtual Disk:    $GUEST_VDD_Image\n\nDo you want to launch this VM now?" 14 65 )
			ConfirmRunNow=$?   # 0=YES, 1=NO
			# Try to launch the guest right now
			if [[ "$ConfirmRunNow" == 0 ]]; then
				RunOutput=$(doas vmctl start ${GUEST_Name} -d ${PCOVAR_DefaultISOPath}/${GUEST_ISO_Image} -d ${PCOVAR_DefaultVDDPath}/${GUEST_VDD_Image} -m ${GUEST_RAMSize} 2>&1 ) # 2>&1 Redirect output to show later
				echo [$CurrentDate $CurrentTime] $GUEST_Name Started >> logs/Guests.log
				dialog --title "Status" --backtitle "$PCOVAR_Title" --msgbox "\n\n$RunOutput" 13 65
			fi
		fi
	}


########################################################################
########################################################################
# Function StopGuest
# Ask for a process id to stop a running virtual machinne
StopGuest()
	{
		GuestProcessToStop=$(dialog --backtitle "$PCOVAR_Title" --title "Stopping a running guest" --clear --output-fd 1 --inputbox "ID of the running process:" 0 0 )
		if [[ "$GuestProcessToStop" != "$PCOVAR_ValorVacio" ]]; then
			RunOutput=$(doas vmctl stop ${GuestProcessToStop} 2>&1 ) # 2>&1 Redirect output to show later
			echo [$CurrentDate $CurrentTime] $GuestProcessToStop PID Stopped >> logs/Guests.log
			dialog --title "Status" --backtitle "$PCOVAR_Title" --msgbox "Stopping PID # $GuestProcessToStop \n\n$RunOutput" 10 65
		fi
	}


########################################################################
########################################################################
# Function VirtualMachineMonitor
# Presents all guests running right now
VirtualMachineMonitor()
	{
		doas vmctl show > temp/status.log
		dialog --title "VMCTL Status" --backtitle "$PCOVAR_Title" --textbox temp/status.log 15 74
	}






########################################################################
########################################################################
# Function Copyright
# Writes the copyright info to the standar out.  Usefull for sign config files
Copyright()
	{
		echo ": <<'END'"
		cat COPYRIGHT
		echo "END"
	}


########################################################################
########################################################################
# Function SaveConfigs
# Write all the config values to the .conf file.
SaveConfigs()
	{
		#Write base config file
			echo '#!/bin/ksh' > conf/base.conf
			echo '\n# WARNING !!!  Do not edit this file manually or will be overwrited' >> conf/base.conf
			echo '#              This was created automatically by vmctl-PCOVAR\n' >> conf/base.conf
			Copyright >> conf/base.conf
			echo '' >> conf/base.conf
			echo 'PCOVAR_DefaultVMMPath="'$PCOVAR_DefaultVMMPath'"  #Virtual Machines configuration' >> conf/base.conf
			echo 'PCOVAR_DefaultVDDPath="'$PCOVAR_DefaultVDDPath'"  #Virtual disks' >> conf/base.conf
			echo 'PCOVAR_DefaultISOPath="'$PCOVAR_DefaultISOPath'"  #Availables ISOS to deploy or mount in VM' >> conf/base.conf
		#Write network config files
	}



#https://www.linuxfromscratch.org/lfs/downloads/stable-systemd/LFS-BOOK-11.0-NOCHUNKS.html
#https://www.linuxfromscratch.org/blfs/downloads/stable/BLFS-BOOK-11.0-nochunks.html


#ANOTACIONES
#sE REQUIERE PARTICIONES PARA ALMACENAR SISTEMA DESTINO
#mkfs -v -t ext4 /dev/<xxx>									sda3 DISCO 40GB
#mkswap /dev/<yyy>											sda2 SWAP
#apt-get -oAcquire::AllowInsecureRepositories=true install bison

#  $LFS  Sera carpeta de _comp