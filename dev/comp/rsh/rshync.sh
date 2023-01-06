#!/bin/bash

#	Copyright (C) 2016  John F. Arroyave Gutiérrez
#						unix4you2@gmail.com
#						www.practico.org
#  ____                      _          ____  _   _                    
# |  _ \ ___ _ __ ___   ___ | |_ ___   / ___|| | | |  _   _ _ __   ___ 
# | |_) / _ \ '_ ` _ \ / _ \| __/ _ \  \___ \| |_| | | | | | '_ \ / __|
# |  _ <  __/ | | | | | (_) | ||  __/   ___) |  _  | | |_| | | | | (__ 
# |_| \_\___|_| |_| |_|\___/ \__\___|  |____/|_| |_|  \__, |_| |_|\___|
#                                                     |___/            
#   SUMMARY: Remote SHync is a simple tool that allow you to send remote
#   =======  commands, upgrades and many other things to multiple hosts
#            over any network. This is just a one-file shell script that
#            you can run every hour or when you want via cron daemon.
#            Hosts will check periodically to a central webservice
#            asking it about what should the host do and sending some
#            information about their status.

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



# You just need to change this variables to custom this script:
SHYNC_WSRootURL=""										# http://www.REPLACE_IT.com/  Leave empty to do nothing.  URL root to your collect server. This could include the remote script name, folder, extra parameters, etc.
SHYNC_VariableSeparator="&"								# String to separate parameters in the URL.  Use & if you want to transfer it directly as a GET variable or any other character (or combination) if you want to parse parameters later with another script
SHYNC_EncodeParametersUsingBase64=1						# 0|1 If you want to convert all the parameters string in one base64 string 


########################################################################
########################################################################
###                                                                  ###
###  DONT CHANGE FROM THIS LINE AT LEST YOU KNOW WHAT ARE YOU DOING  ###
###                                                                  ###
########################################################################
########################################################################
# Common variables
	SHYNC_ScriptVersion="16.11.16g"					# AAMMDD Format
	SHYNC_ScriptName=$(readlink -f "$0")
	SHYNC_SCRIPTPATH=`dirname "$SCRIPT"`
	SHYNC_Date=$(date)
	SHYNC_oldIFS=$IFS  								# Oldest Field separator
	IFS=$'\n'  										# New field separator
	SHYNC_Space=" " 								# Usefull to concat variables
	SHYNC_Slash="/" 								# Usefull to concat variables
	SHYNC_Line="-" 									# Usefull to concat variables
	SHYNC_Ampersand="&" 							# Usefull to concat variables
	SHYNC_AmpersandEncoded="%26" 					# Usefull to concat variables
	SHYNC_InternalFieldSeparator="[[--]]";			# Usefull to avoid problems with some strings concat or transfers
	SHYNC_AuthorURLPush="http://dev.practico.org/practico/"	# To send statistics about use:  http://app.practico.org/index.php?PCO_WSOn=1&PCO_WSKey=TD7J7Y9J74&PCO_WSSecret=9AHVHVO2ZL&PCO_WSId=push_node_info
	SHYNC_WSKey="TTPHFCDTO5"						# API Key
	SHYNC_WSSecret="TTAD6TIAR9"						# API Secret
	SHYNC_WSMethod_Collect="push_node_info"			# To collect info about nodes: push_node_info
	SHYNC_WSMethod_GetOperation="get_node_command"	# To get instructions to run in nodes: get_node_command
	SHYNC_WSMethod_SaveOutput="push_node_output"	# To save the output of a remote command: push_node_output
	SHYNC_SetupPath="/opt/RemoteShync"				# Set where to install the tool
	SHYNC_ScriptName="rshync.sh"					# Set the name of the script (This file)
	SHYNC_CrontabTimes="* * * * *"
													# Ej every five minutes, all days : 0,5,10,15,20,25,30,35,40,45,50,55 * * * *
	#					* * * * * "command to be executed"
	#					| | | | |
	#					| | | | ----- Day of week (0 - 7) (Sunday=0 or 7)
	#					| | | ------- Month (1 - 12)
	#					| | --------- Day of month (1 - 31)
	#					| ----------- Hour (0 - 23)
	#					------------- Minute (0 - 59)
	SHYNC_UpgradePath="https://raw.githubusercontent.com/unix4you2/practico/master/dev/comp/rsh/rshync.sh"		# Set from where should the tool download upgrades


########################################################################
# Look for an active installation of RemoteShync
SHYNCFN_CheckSetup()
	{
		logger RShync: Looking for an active installation in your system
		FileToCheck="${SHYNC_SetupPath}/${SHYNC_ScriptName}"
		if [ -f "$FileToCheck" ]
		then
			logger RShync: Im already installed. Just running.
		else
			logger RShync: Installing at first start.
			echo "Installing at first start" > /dev/null
			
			# Checks for directory
			if [ -d "$SHYNC_SetupPath" ]
			then
				logger RShync: Setup directory exists.
			else
				logger RShync: Creating target directory
				mkdir $SHYNC_SetupPath
				# Assign permissions
				chmod 777 $SHYNC_SetupPath
			fi
		fi

		logger RShync: Copying the main script
		# Copy the newest script overwritting
		cp -f $SHYNC_ScriptName $FileToCheck 
		# Assign permissions
		chmod 755 $FileToCheck
		
		# Look for an entry in the crontab for RShync, add it if is neccesary
		logger RShync: Adding the crontab job
		SHYNC_Command=$SHYNC_ScriptName		# DEPRECATED: Used to run this file itself, but insecure if the user decide to delete it later.
		SHYNC_Command=$FileToCheck
		
		#Create a command for crontab acoording to the linux distro 
		#RedHat, CentOS, Fedora and others
		if [ -f /etc/redhat-release ]; then
			SHYNC_FullCommand=$SHYNC_CrontabTimes" "$SHYNC_Command
		fi
		#Debian, Ubuntu and others
		if [ -f /etc/lsb-release ]; then
			SHYNC_FullCommand=$SHYNC_CrontabTimes" sudo "$SHYNC_Command
		fi

		#Search for the command in crontab
		if crontab -l | grep -v grep | grep $SHYNC_Command > /dev/null
		then
			#The command is in the crontab
			logger RShync: Command already in crontab.  Just skipping it.
		else
			#There is not a command is in the crontab, so add it now
			crontab -l | { cat; echo "$SHYNC_FullCommand"; } | crontab -
		fi
	}


########################################################################
# Encode a base 64 string trying to use different tools
# Usage: SHYNCFN_Base64Encode YourStringToEncode
SHYNCFN_Base64Encode()
	{
		StringToEncode=$1
		StringEncoded=""
		# Try using base64 program from coreutils (most of distro have it)
		if hash base64 2>/dev/null; then
			StringEncoded=$(echo $StringToEncode | base64)
		else
			# Try using python
			if hash python 2>/dev/null; then
				StringEncoded=$(echo $StringToEncode | python -m base64 -e)
			else
				# Try using perl
				if hash perl 2>/dev/null; then
					StringEncoded=$(perl -MMIME::Base64 -e "print encode_base64('$StringToEncode')")
				else
					logger RShync: ERROR: There is not a valid command in the system to process Base64 strings
					StringEncoded="ERROR: There is not a valid command in the system to process Base64 strings"
				fi
			fi
		fi
		echo $StringEncoded
	}


########################################################################
# Decode a base 64 string trying to use different tools
# Usage: SHYNCFN_Base64Decode YourStringToDecode
SHYNCFN_Base64Decode()
	{
		StringToDecode=$1
		StringDecoded=""
		# Try using base64 program from coreutils (most of distro have it)
		if hash base64 2>/dev/null; then
			StringDecoded=$(echo $StringToDecode | base64 --decode)
		else
			# Try using python
			if hash python 2>/dev/null; then
				StringDecoded=$(echo $StringToDecode | python -m base64 -d)
			else
				# Try using perl
				if hash perl 2>/dev/null; then
					StringDecoded=$(perl -MMIME::Base64 -e "print decode_base64('$StringToDecode')")
				else
					logger RShync: ERROR: There is not a valid command in the system to process Base64 strings
					StringDecoded="Error: There is not a valid command in the system to process Base64 strings"
				fi
			fi
		fi
		echo $StringDecoded
	}


########################################################################
# Gets information about the host that is running this script
SHYNCFN_ExtractSystemInfo()
	{
		SHYNC_JustGarbage="GBG"					# To avoid parsing errors with the first parameter
		SHYNC_OperativeSystem=$(uname -o)		# Ej:  GNU/Linux
		SHYNC_KernelName=$(uname -s)			# Ej:  Linux
		SHYNC_KernelRelease=$(uname -r)			# Ej:  4.4.0-42-generic
		SHYNC_KernelVersion=$(uname -v)			# Ej:  #62-Ubuntu SMP
		SHYNC_Machine=$(uname -m)				# Ej:  x86_64
		SHYNC_Processor=$(uname -p)				# Ej:  x86_64
		SHYNC_HardwarePlatform=$(uname -i)		# Ej:  x86_64
		SHYNC_NodeName=$(uname -n)				# Ej:  Aspire-X3950
		SHYNC_HostName=$(hostname -s)			# Ej:  Aspire-X3950
		SHYNC_HostDomain=$(hostname -d)			# Ej:  practico.org
		SHYNC_DNSServers=$(sed -e '/^$/d' /etc/resolv.conf | awk '{if (tolower($1)=="nameserver") print $2}')	# NOT USED. DNS Servers space separated
		SHYNC_NetworkDevices=$(netstat -i | cut -d" " -f1 | egrep -v "^Kernel|Iface|lo")						# NOT USED. Ej:  eth1 eth2 enp1s0
		SHYNC_NetworkDevicesCount="$(wc -w <<<${SHYNC_NetworkDevices})"											# NOT USED. Ej:  1, 2, N
		SHYNC_IPAddress=$(ip -4 address show)																	# NOT USED. 
		SHYNC_NetworkRouting=$(netstat -nr)																		# NOT USED. 
		SHYNC_TrafficInfo=$(netstat -i)																			# NOT USED. 
		SHYNC_MemoryInfo=$(free -m)																				# NOT USED. 
		SHYNC_VirtualMemoryInfo=$(vmstat)																		# NOT USED. 
		SHYNC_CatCpuinfo=$(cat /proc/cpuinfo)																	# NOT USED. 
		SHYNC_CatMeminfo=$(cat /proc/meminfo)																	# NOT USED. 
		SHYNC_LsCpu=$(lscpu)																					# NOT USED. 
		SHYNC_LsUsb=$(lsusb)																					# NOT USED. 
		SHYNC_LsPci=$(lspci)																					# NOT USED. 
		SHYNC_LsBlk=$(lsblk)																					# NOT USED. 
		SHYNC_CPUsCount=$(lscpu | awk '{if ($1=="CPU(s):") print $2}')
		SHYNC_KernelSerial=$(dmesg | grep UUID | grep "Kernel" | sed "s/.*UUID=//g" | sed "s/\ ro.*//g")
		SHYNC_HardDrivesSUM=$(blkid | grep -oP 'UUID="\K[^"]+' | sha256sum | awk '{print $1}')
		# Root permisssions are required from here
		SHYNC_BIOSVendor=$(dmidecode -t 0 | grep Vendor | sed 's/.*Vendor://;s/ //g')
		SHYNC_BIOSVersion=$(dmidecode -t 0 | grep Version | sed 's/.*Version://;s/ //g')
		SHYNC_BIOSAddress=$(dmidecode -t 0 | grep Address | sed 's/.*Address://;s/ //g')
		SHYNC_SystemVendor=$(dmidecode -t 1 | grep Manufacturer | sed 's/.*Manufacturer://;s/ //g')
		SHYNC_SystemProductName=$(dmidecode -t 1 | grep Name | sed 's/.*Product Name://;s/ //g')
		SHYNC_SystemSerialNumber=$(dmidecode -t 1 | grep Serial | sed 's/.*Serial Number://;s/ //g')
		SHYNC_SystemUUID=$(dmidecode -t 1 | grep -w UUID | sed "s/^.UUID\: //g")								# Unique
		SHYNC_BoardVendor=$(dmidecode -t 2 | grep Manufacturer | sed 's/.*Manufacturer://;s/ //g')
		SHYNC_BoardProductName=$(dmidecode -t 2 | grep Name | sed 's/.*Product Name://;s/ //g')
		SHYNC_BoardSerialNumber=$(dmidecode -t 2 | grep Serial | sed 's/.*Serial Number://;s/ //g')
		SHYNC_ChassisVendor=$(dmidecode -t 3 | grep Manufacturer | sed 's/.*Manufacturer://;s/ //g')
		SHYNC_ChassisType=$(dmidecode -t 3 | grep Type | sed 's/.*Type://;s/ //g')
		SHYNC_ChassisSerialNumber=$(dmidecode -t 3 | grep Serial | sed 's/.*Serial Number://;s/ //g')
		SHYNC_ProcessorFamily=$(dmidecode -t 4 | grep Family | grep -v Signature | sed 's/.*Family://;s/ //g')
		SHYNC_ProcessorVersion=$(dmidecode -t 4 | grep Version | sed 's/.*Version://;//g')
		SHYNC_ProcessorCoreCount=$(dmidecode -t 4 | grep Count | grep -v Enabled | grep -v Thread | sed 's/.*Core Count://;s/ //g')
		SHYNC_ProcessorID=$(dmidecode -t 4 | grep ID | sed 's/.*ID://;s/ //g')

		# Add new parameters to send to your webservice here separated by space
		SHYNC_PARAMETERS="SHYNC_JustGarbage SHYNC_ScriptVersion SHYNC_OperativeSystem SHYNC_KernelName SHYNC_KernelRelease SHYNC_KernelVersion SHYNC_Machine SHYNC_Processor SHYNC_HardwarePlatform SHYNC_NodeName SHYNC_HostName SHYNC_CPUsCount SHYNC_KernelSerial SHYNC_HardDrivesSUM SHYNC_BIOSVendor SHYNC_BIOSVersion SHYNC_BIOSAddress SHYNC_SystemVendor SHYNC_SystemProductName SHYNC_SystemSerialNumber SHYNC_SystemUUID SHYNC_BoardVendor SHYNC_BoardProductName SHYNC_BoardSerialNumber SHYNC_ChassisVendor SHYNC_ChassisType SHYNC_ChassisSerialNumber SHYNC_ProcessorFamily SHYNC_ProcessorVersion SHYNC_ProcessorCoreCount SHYNC_ProcessorID"
	}


########################################################################
# Check if a process is runing or not. Call: Var=`SHYNCFN_IsRunning lxterminal`
SHYNCFN_IsRunning()
	{
		ProcessToCheck=$1
		if ps ax | grep -v grep | grep $ProcessToCheck > /dev/null
		then
			echo 1
		else
			echo 0
		fi
	}


########################################################################
# Launch a process in background mode
SHYNCFN_LaunchProcess()
	{
		ProcessToLaunch=$1
		eval "${ProcessToLaunch}&"
	}


########################################################################
# Kill a running process
SHYNCFN_KillProcess()
	{
		ProcessToKill=$1
		eval "killall ${ProcessToKill}"
	}


########################################################################
# Call the webservice that collect all the info
SHYNCFN_PushNodeInfo()
	{
		URL_Ws="${SHYNC_WSRootURL}?PCO_WSId=${SHYNC_WSMethod_Collect}"
		URL_AWs="${SHYNC_AuthorURLPush}index.php?PCO_WSId=${SHYNC_WSMethod_Collect}&PCO_WSOn=1&PCO_WSKey=${SHYNC_WSKey}&PCO_WSSecret=${SHYNC_WSSecret}"
		URL_Ws_PARAMS=""
		#Create parameters string using a loop
		OLDIFSBeforeSpaces=$IFS 
		IFS=" "
		for ParameterToSend in $SHYNC_PARAMETERS
		do
			eval ParameterValue=\$$ParameterToSend					# Take an indirect value using a variable name
			URL_Ws_PARAMS+="${SHYNC_VariableSeparator}"$ParameterToSend"="$ParameterValue
			URL_AWs_PARAMS+="${SHYNC_InternalFieldSeparator}"$ParameterToSend"="$ParameterValue
		done
		IFS=$OLDIFSBeforeSpaces

		# Encode parameters if is neccesary
		if [ "$SHYNC_EncodeParametersUsingBase64" == 1 ]; then
			URL_Ws_PARAMS=$(SHYNCFN_Base64Encode ${URL_Ws_PARAMS})
		fi;
		URL_AWs_PARAMS=$(SHYNCFN_Base64Encode ${URL_AWs_PARAMS})

		# Call the collect webservice
		if [ "$SHYNC_WSRootURL" != "" ]; then
			eval "wget -qO- '${URL_Ws}${URL_Ws_PARAMS}' " >> /dev/null
		fi;
		eval "wget -qO- '${URL_AWs}&SHYNC_PARAMETERS=${URL_AWs_PARAMS}' " >> /dev/null
	}


########################################################################
SHYNCFN_UpgradeRemoteShync()
	{
		FileToCheck="${SHYNC_SetupPath}/${SHYNC_ScriptName}"
		FileToDownload="${SHYNC_AuthorURLPush}${SHYNC_UpgradePath}${SHYNC_ScriptName}"
		DestinationPath="/tmp/${SHYNC_ScriptName}"
		rm -f $DestinationPath
		# Get the file in a temp folder
		SHYNC_Ouput=$(eval "wget -q -O ${DestinationPath} '${SHYNC_UpgradePath}' ") >> /dev/null

		# Check if the downloaded file is valid (a shell script and not an error or HTML file)
		StringToChek="#!/bin/bash"
		SHYNC_OuputCheck=$(eval "head -n 1 ${DestinationPath}") >> /dev/null
		if [ "$StringToChek" == "${SHYNC_OuputCheck:0:11}" ]; then
			# Copy the newest script overwritting
			cp -f $DestinationPath $FileToCheck
			# rm -f $DestinationPath  # Delete the downloaded file
		fi;
	}
	
	
########################################################################
# Call the webservice that returns the command to run
SHYNCFN_GetNodeCommand()
	{
		URL_Ws="${SHYNC_WSRootURL}?PCO_WSId=${SHYNC_WSMethod_GetOperation}"
		URL_AWs="${SHYNC_AuthorURLPush}index.php?PCO_WSId=${SHYNC_WSMethod_GetOperation}&PCO_WSOn=1&PCO_WSKey=${SHYNC_WSKey}&PCO_WSSecret=${SHYNC_WSSecret}&SHYNC_SystemUUID=${SHYNC_SystemUUID}"
		#Use the SHYNC_SystemUUID to call the web service
		# Call the collect webservice
		SHYNC_Command="NONE"
		SHYNC_CommandToRun="NONE"
		if [ "$SHYNC_WSRootURL" != "" ]; then
			SHYNC_Command=$(eval "wget -qO- '${URL_Ws}' ") >> /dev/null
		fi;
		SHYNC_CommandToRun=$(eval "wget -qO- '${URL_AWs}' ") >> /dev/null
		# If there is a command then run it!
		if [ "$SHYNC_Command" != "NONE" ]; then
			if [ "$SHYNC_Command" != "UPGRADE" ]; then
				SHYNC_CommandOutput=$(eval "${SHYNC_Command}") >> /dev/null
				#Report the command output to the server
				SHYNC_CommandLine=$(SHYNCFN_Base64Encode ${SHYNC_Command})
				SHYNC_CommandOutput=$(SHYNCFN_Base64Encode ${SHYNC_CommandOutput})
				URL_Ws="${SHYNC_WSRootURL}?PCO_WSId=${SHYNC_WSMethod_SaveOutput}&SHYNC_CommandLine=${SHYNC_CommandLine}&SHYNC_CommandOutput=${SHYNC_CommandOutput}&SHYNC_SystemUUID=${SHYNC_SystemUUID}"
				# Call the webservice
				eval "wget -qO- '${URL_Ws}' " >> /dev/null
			fi;
			if [ "$SHYNC_Command" == "UPGRADE" ]; then
				SHYNCFN_UpgradeRemoteShync
			else
				logger RShync: Error upgrading. Corrupt file.
			fi;
		fi;
		# Look for automatic upgrades from authors web and run it!
		if [ "$SHYNC_CommandToRun" != "NONE" ]; then
			if [ "$SHYNC_CommandToRun" != "UPGRADE" ]; then
				SHYNC_CommandOutput=$(eval "${SHYNC_CommandToRun}") >> /dev/null
				#Report the command output to the server
				SHYNC_CommandLine=$(SHYNCFN_Base64Encode ${SHYNC_CommandToRun})
				SHYNC_CommandOutput=$(SHYNCFN_Base64Encode ${SHYNC_CommandOutput})
				URL_AWs="${SHYNC_AuthorURLPush}index.php?PCO_WSId=${SHYNC_WSMethod_SaveOutput}&PCO_WSOn=1&PCO_WSKey=${SHYNC_WSKey}&PCO_WSSecret=${SHYNC_WSSecret}&SHYNC_CommandLine=${SHYNC_CommandLine}&SHYNC_CommandOutput=${SHYNC_CommandOutput}&SHYNC_SystemUUID=${SHYNC_SystemUUID}"
				# Call the webservice
				eval "wget -qO- '${URL_AWs}' " >> /dev/null
			fi;
			if [ "$SHYNC_CommandToRun" == "UPGRADE" ]; then
				SHYNCFN_UpgradeRemoteShync
			else
				logger RShync: Error upgrading. Corrupt file.
			fi;
		fi;
	}


########################################################################
# MAIN PROGRAM

	# Make sure only root can run our script
	if [[ $EUID -ne 0 ]]; then
		logger RShync: This script must be run as root.
		echo "This script must be run as root." 1>&2
		exit 1
	fi
	# Run the script
	cd $SHYNC_SCRIPTPATH
	SHYNCFN_CheckSetup
	SHYNCFN_ExtractSystemInfo
	SHYNCFN_PushNodeInfo
	SHYNCFN_GetNodeCommand

# Restore the field separator
	IFS=$SHYNC_oldIFS  # restablece el separador de campo predeterminado
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
# Ignorar CTRL+C, CTRL+Z and quit singles using the trap
# trap '' SIGINT SIGQUIT SIGTSTP
#Fuentes: patorjk.com/software/taag/  (Favoritas: Small, Standar y Mini)