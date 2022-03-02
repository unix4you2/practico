#!/bin/ksh

# Copyright (c) 2018,  John F. Arroyave Gutiérrez
#                      unix4you2@gmail.com
#                      www.practico.org.
# 
# Redistribution and use in source and binary forms, with or without modification,
# are permitted provided that the following conditions are met:
# 
# 1. Redistributions of source code must retain the above copyright notice,
#    this list of conditions and the following disclaimer.
# 
# 2. Redistributions in binary form must reproduce the above copyright notice,
#    this list of conditions and the following disclaimer in the documentation
#    and/or other materials provided with the distribution.
# 
# 3. Neither the name of the copyright holder nor the names of its contributors 
#    may be used to endorse or promote products derived from this software 
#    without specific prior written permission.
# 
# THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS 
# "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,  
# THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE 
# ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS  BE LIABLE 
# FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES 
# (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS 
# OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY 
# THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING 
# NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, 
# EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.


########################################################################
########################################################################
# Function Initialize
# Load or define some environment variables at run-time
Initialize()
	{
		# General variables
			TUI_Version="19.1"
			EmptyValue="";
			TTYName=$(tty);
			TTYCols=$(tput cols);
			TTYRows=$(tput lines);
			SYSUser=$USER;
			SYSUserHome=$(eval echo ~$USER);
			typeset -r __SYSScriptName="${0##*/}"
			typeset -r __SYSScriptDir="${0%/*}"
			typeset -r __SYSScriptRealPath=$( cd -P -- "$(dirname -- "$(command -v -- "$0")")" && pwd -P )
			CurrentDate=$(date +%Y%m%d)
			CurrentTime=$(date +%H%M)
			CurrentDateTime=${CurrentDate}_${CurrentTime}
		# Application variables
			TUI_Title="[VMMCTL-TUI ver:$TUI_Version] running as $SYSUser"
		# Load configuration files
			. conf/base.conf
		
		# Ask for an XTerminal or text only console.  If Display CONTAINS something like 0:0
		TTYXMode="NO";
		if [[ "$DISPLAY" == *"0.0"* ]]; then
			TTYXMode="YES";
		fi
	}


########################################################################
########################################################################
# Function BaseConfig
# Presents the form to edit the base configuration for the tool
BaseConfig()
	{
		# Label,Row,Col,Variable/Value,Row,Col,FLen(0=RO,VisualLen),ILen(MaxLen),TYPE (mixedform) 0=Standar,1=hidden,2=ReadOnly
		ConfigValues=$(dialog --ok-label "Apply config" --backtitle "$TUI_Title" --output-fd 1 --title "General configuration" --form "Paths to get, save or recover some configurations\n\nIMPORTANT: Configuration will apply at runtime (inmediately) and will be writted/saved (definitely) when you close this tool" 15 60 0 \
			"VM Definitions:"	1 1	"$TUI_DefaultVMMPath" 	1 17 200 200 \
			"Virtual Disks:"	2 1	"$TUI_DefaultVDDPath"  	2 17 200 0 \
			"ISO files:"		3 1	"$TUI_DefaultISOPath"  	3 17 200 0 )

		# Parse form values to assing the value to variables
		# Variables values are taken IN ORDEN from their order in the form
		typeset -i PosValue=1
		set -A ArrayValues
		for VariableValue in $ConfigValues
			do
				case $PosValue in
					1) TUI_DefaultVMMPath=$VariableValue;;
					2) TUI_DefaultVDDPath=$VariableValue;;
					3) TUI_DefaultISOPath=$VariableValue;;
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
		if [[ "$TTYXMode" == "YES" ]]; then
			Notify "$1"  
		fi
		logger "[vmctl-tui] $1"
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
# Function DependencesCheck
# Check if the system has all the dependences installed
DependencesCheck()
	{
		#dialog
		if ! [ -x "$(command -v dialog)" ]; then
			echo "ERROR: vmctl-tui require the 'dialog' package.\n       Try installing it by 'doas pkg_add dialog' and try again.";
			exit 1;
		fi

		#If script is running under an X terminal then search for some packages for GUI
		if [[ "$TTYXMode" == "YES" ]]; then
			#zenity
			if ! [ -x "$(command -v gdialog)" ]; then
				echo "INFO: vmctl-tui could use the 'zenity' package for GUI\n      Try installing it by 'doas pkg_add zenity' and try again.\n      This app will not work in graphic mode until you install it.\n      Press [Enter] to continue in text mode only";
				read EnterPress
			fi
			#Xdialog - DEPRECATED during migration to Go web application
			#if ! [ -x "$(command -v Xdialog)" ]; then
			#	echo "INFO: vmctl-tui could use the 'Xdialog' package for GUI\n      Try installing it by 'doas pkg_add Xdialog' and try again.\n      This app will not work in graphic mode until you install it.\n      Press [Enter] to continue in text mode only";
			#	read EnterPress
			#fi
		fi
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
		CreateDiskParameters=$(dialog --ok-label "Create" --cancel-label "Discard" --backtitle "$TUI_Title" --output-fd 1 --title "Creating a new virtual disk" --mixedform "  Default path: $TUI_DefaultVDDPath" 9 70 0 \
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
					1) TUI_DiskName=$VariableValue;;
					2) TUI_DiskSize=$VariableValue;;
				esac
				((PosValue=PosValue+1))
			done
		# Launch the operation.  This dont need to check anything cause vmctl validate every parameter. Just take output and show it to the user
		if [[ "$TUI_DiskName" != "$EmptyValue" ]] && [[ "$TUI_DiskSize" != "EmptyValue" ]]; then
			CreateDiskOutput=$(vmctl create ${TUI_DefaultVDDPath}/${TUI_DiskName} -s ${TUI_DiskSize} 2>&1 ) # 2>&1 Redirect output to show later
			echo [$CurrentDate $CurrentTime] $TUI_DiskName $CreateDiskOutput >> logs/Disks.log
			dialog --title "Status" --msgbox "${TUI_DefaultVDDPath}/${TUI_DiskName} \n\n$CreateDiskOutput" 8 50
		fi
	}


########################################################################
########################################################################
# Function DeleteImageList
# Take a disk name as $1 parameter and delete it from the VDD directory
DeleteImageList()
	{
		ConfirmAnswer=$(dialog --output-fd 1 --clear --backtitle "$TUI_Title" --title "WARNING - WARNING - WARNING"  --yesno "You are going to delete the disk:\n$1\n\nThis operation can not be undone later!\n\nARE YOU SURE?" 11 65 )
		ConfirmAnswer=$?   # 0=YES, 1=NO
		# Delete de disk file if the answer is YES
		if [[ "$ConfirmAnswer" == 0 ]]; then
			rm ${TUI_DefaultVDDPath}/${1}
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
		#MenuOptions=$(ls ${TUI_DefaultVDDPath} | while read -r OutputLine; do
		#	echo ${OutputLine}" disk"
		#done)
		MenuOptions=$(ls -lh $TUI_DefaultVDDPath | awk '{print $9,$5}' | grep -viw "_blank" ) # Without the _blank file
		MenuOptions="VIRTUAL_DISK_NAME SIZE"${MenuOptions} # Add a title to have at least one option for dialog syntax  
		DiskOperationMenuAnswer=$(dialog --output-fd 1 --clear --backtitle "$TUI_Title" --title "Virtual Disks Found" --menu "" 15 50 10 $MenuOptions )

		if [[ "$DiskOperationMenuAnswer" != "$EmptyValue" ]] && [[ "$DiskOperationMenuAnswer" != "VIRTUAL_DISK_NAME" ]]; then
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
			DiskMenuAnswer=$(dialog --output-fd 1 --clear --backtitle "$TUI_Title" --title "Virtual Disks Menu" --menu "" 15 50 10 \
			N "Create a new virtual disk" \
			L "Delete a virtual disk" \
			V "View virtual disks logs" \
			E "Return to the main menu" )

			case $DiskMenuAnswer in
				N) DiskCreationForm;;
				V) dialog --title "Virtual disks LOGS" --msgbox "$(cat logs/Disks.log)" 20 75 ;;
				L) DiskImageList;;
				E) break;;
				$EmptyValue) break;;
			esac
		done
	}


########################################################################
########################################################################
# Function ISOsManager
# Presents a list with all the ISO images availables to create virtual machinnes
ISOsManager()
	{
		MenuOptions=$(ls -lh $TUI_DefaultISOPath | awk '{print $9,$5}' | grep -viw "_blank" ) # Without the _blank file
		MenuOptions="ISOS_IMAGES_AVAILABLES SIZE"${MenuOptions} # Add a title to have at least one option for dialog syntax  
		DiskOperationMenuAnswer=$(dialog --colors  --hline "\Zb\Z1REMEMBER_To_add_more_just_copy_them_to_your_ISOS_folder" --output-fd 1 --clear --backtitle "$TUI_Title" --title "ISOS Found under $TUI_DefaultISOPath" --menu "" 15 70 10 $MenuOptions )

		if [[ "$DiskOperationMenuAnswer" != "$EmptyValue" ]] && [[ "$DiskOperationMenuAnswer" != "ISOS_IMAGES_AVAILABLES" ]]; then
			DeleteImageList $DiskOperationMenuAnswer
		fi
	}


########################################################################
########################################################################
# Function GuestEdit
# Presents the form to edit the configuration for a guest
GuestEdit()
	{
		MenuGuests=$(ls -lh $TUI_DefaultVMMPath | awk '{printf("%s %s%s\n",$9,$6,$7)}' | grep -viw "New_Machinne_TEMPLATE.conf" ) # Without the template file
		MenuGuests="GUESTS_MACHINNES_DEFINED MODIFIED"${MenuGuests} # Add a title to have at least one option for dialog syntax  
		GuestSelectedToEdit=$(dialog --colors --output-fd 1 --clear --backtitle "$TUI_Title" --title "Edit a Guest configuration" --menu "" 15 70 10 $MenuGuests )

		if [[ "$GuestSelectedToEdit" != "$EmptyValue" ]] && [[ "$GuestSelectedToEdit" != "GUESTS_MACHINNES_DEFINED" ]]; then
			# Load configuration files for the VM
			. $TUI_DefaultVMMPath/$GuestSelectedToEdit

			# Label,Row,Col,Variable/Value,Row,Col,FLen(0=RO,VisualLen),ILen(MaxLen),TYPE (mixedform) 0=Standar,1=hidden,2=ReadOnly
			GuestValues=$(dialog --ok-label "Save config" --colors --nocancel --cancel-label "Discard" --backtitle "$TUI_Title" --output-fd 1 --title "Base machinne configuration" --mixedform "WARNING: You should take care of the paths and file names when you are editting a guest manually.\n\nIf the guest is already running changes will take effect in the next boot.\n\Zb\Z1** TIP: Change the guest name if you want to create a new machinne using this values as template." 17 70 0\
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
				echo '#              This was created automatically by vmctl-tui\n' >> ${GuestConfigFile}
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
		dialog --backtitle "$TUI_Title" --infobox "Machinne wizard" 4 20
		sleep 1

		# Basic parameters
		# Label,Row,Col,Variable/Value,Row,Col,FLen(0=RO,VisualLen),ILen(MaxLen),TYPE (mixedform) 0=Standar,1=hidden,2=ReadOnly

		GuestValues=$(dialog --ok-label "Next" --no-cancel --cancel-label "Back" --backtitle "$TUI_Title" --output-fd 1 --title "Base machinne configuration" --mixedform "  This wizard will help you to define the most commons parameters to create a new virtual machine.  Please fill all the fields below.\n\nCTRL+C at any time to cancel this app" 12 70 0\
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
		# DEPRECATED ISODisc=$(dialog --title "Please choose a file for your ISO install image" --fselect ${TUI_DefaultISOPath} 8 60)
		MenuOptions=$(ls -lh $TUI_DefaultISOPath | awk '{print $9,$5}' | grep -viw "_blank" ) # Without the _blank file
		MenuOptions="ISOS_IMAGES_AVAILABLES SIZE"${MenuOptions} # Add a title to have at least one option for dialog syntax  
		GUEST_ISO_Image=$(dialog  --output-fd 1 --clear --backtitle "$TUI_Title" --title "Please choose an ISO file for your install process" --menu "" 15 70 10 $MenuOptions )

		# HDD image selection for the guest
		MenuOptions=$(ls -lh $TUI_DefaultVDDPath | awk '{print $9,$5}' | grep -viw "_blank" ) # Without the _blank file
		MenuOptions="VIRTUAL_DISKS_AVAILABLES SIZE"${MenuOptions} # Add a title to have at least one option for dialog syntax  
		GUEST_VDD_Image=$(dialog  --output-fd 1 --clear --backtitle "$TUI_Title" --title "Please choose a DISC image to deploy your install" --menu "" 15 70 10 $MenuOptions )
		
		#Write config file for the guest
			GuestConfigFile="data/guests/${GUEST_Name}.sh"
			echo $GuestConfigFile
			echo '#!/bin/ksh' > ${GuestConfigFile}
			echo '\n# WARNING !!!  Do not edit this file manually or will be overwrited' >> ${GuestConfigFile}
			echo '#              This was created automatically by vmctl-tui\n' >> ${GuestConfigFile}
			Copyright >> ${GuestConfigFile}
			echo '' >> ${GuestConfigFile}
			echo 'GUEST_Name="'$GUEST_Name'"' >> ${GuestConfigFile}
			echo 'GUEST_RAMSize="'$GUEST_RAMSize'"' >> ${GuestConfigFile}
			echo 'GUEST_ISO_Image="'$GUEST_ISO_Image'"' >> ${GuestConfigFile}
			echo 'GUEST_VDD_Image="'$GUEST_VDD_Image'"' >> ${GuestConfigFile}

		echo [$CurrentDate $CurrentTime] $GUEST_Name Created >> logs/Guests.log
		ConfirmRunNow=$(dialog --output-fd 1 --yes-label "Yes, save config and run it!"  --no-label "No, just create it" --clear --backtitle "$TUI_Title" --title "Final check!"  --yesno "\nGuest configuration brief\n\n  Guest name:      $GUEST_Name\n  Memory RAM size: $GUEST_RAMSize\n  CD/DVDROM:       $GUEST_ISO_Image\n  Virtual Disk:    $GUEST_VDD_Image\n\nDo you want to launch this VM now?" 14 65 )
		ConfirmRunNow=$?   # 0=YES, 1=NO
		# Try to launch the guest right now
		if [[ "$ConfirmRunNow" == 0 ]]; then
			RunOutput=$(doas vmctl start ${GUEST_Name} -d ${TUI_DefaultISOPath}/${GUEST_ISO_Image} -d ${TUI_DefaultVDDPath}/${GUEST_VDD_Image} -m ${GUEST_RAMSize} )
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
		MenuGuests=$(ls -lh $TUI_DefaultVMMPath | awk '{printf("%s %s%s\n",$9,$6,$7)}' | grep -viw "New_Machinne_TEMPLATE.conf" ) # Without the template file
		MenuGuests="GUESTS_MACHINNES_DEFINED MODIFIED"${MenuGuests} # Add a title to have at least one option for dialog syntax  
		GuestSelectedToRun=$(dialog --colors --output-fd 1 --clear --backtitle "$TUI_Title" --title "Start a Guest from $TUI_DefaultVMMPath" --menu "" 15 70 10 $MenuGuests )

		if [[ "$GuestSelectedToRun" != "$EmptyValue" ]] && [[ "$GuestSelectedToRun" != "GUESTS_MACHINNES_DEFINED" ]]; then
			# Load configuration files for the VM
			. $TUI_DefaultVMMPath/$GuestSelectedToRun

			ConfirmRunNow=$(dialog --output-fd 1 --yes-label "Yes, run it!"  --no-label "Cancel" --clear --backtitle "$TUI_Title" --title "Please confirm"  --yesno "\nYou are going to start this guest:\n\n  Guest name:      $GUEST_Name\n  Memory RAM size: $GUEST_RAMSize\n  CD/DVDROM:       $GUEST_ISO_Image\n  Virtual Disk:    $GUEST_VDD_Image\n\nDo you want to launch this VM now?" 14 65 )
			ConfirmRunNow=$?   # 0=YES, 1=NO
			# Try to launch the guest right now
			if [[ "$ConfirmRunNow" == 0 ]]; then
				RunOutput=$(doas vmctl start ${GUEST_Name} -d ${TUI_DefaultISOPath}/${GUEST_ISO_Image} -d ${TUI_DefaultVDDPath}/${GUEST_VDD_Image} -m ${GUEST_RAMSize} 2>&1 ) # 2>&1 Redirect output to show later
				echo [$CurrentDate $CurrentTime] $GUEST_Name Started >> logs/Guests.log
				dialog --title "Status" --backtitle "$TUI_Title" --msgbox "\n\n$RunOutput" 13 65
			fi
		fi
	}


########################################################################
########################################################################
# Function StopGuest
# Ask for a process id to stop a running virtual machinne
StopGuest()
	{
		GuestProcessToStop=$(dialog --backtitle "$TUI_Title" --title "Stopping a running guest" --clear --output-fd 1 --inputbox "ID of the running process:" 0 0 )
		if [[ "$GuestProcessToStop" != "$EmptyValue" ]]; then
			RunOutput=$(doas vmctl stop ${GuestProcessToStop} 2>&1 ) # 2>&1 Redirect output to show later
			echo [$CurrentDate $CurrentTime] $GuestProcessToStop PID Stopped >> logs/Guests.log
			dialog --title "Status" --backtitle "$TUI_Title" --msgbox "Stopping PID # $GuestProcessToStop \n\n$RunOutput" 10 65
		fi
	}


########################################################################
########################################################################
# Function VirtualMachineMonitor
# Presents all guests running right now
VirtualMachineMonitor()
	{
		doas vmctl show > temp/status.log
		dialog --title "VMCTL Status" --backtitle "$TUI_Title" --textbox temp/status.log 15 74
	}


########################################################################
########################################################################
# Function MainMenu
# Presents the main menu for the tool.  Its a loop until the user wants to end
MainMenu()
	{
		Initialize  #This call initialization rutine every time to have all config up to date with every change
		while true
		do
			# Refresh date and time in every menu load
			CurrentDate=$(date +%Y%m%d)
			CurrentTime=$(date +%H%M)
			CurrentDateTime=${CurrentDate}_${CurrentTime}

			MainMenuAnswer=$(dialog --output-fd 1 --clear --backtitle "$TUI_Title" --ok-label "Go!" --cancel-label "Exit" --title "Main menu" --menu "Please select the operation:" 17 50 17 \
			C "General configuration" \
			D "Virtual disks image manager" \
			I "ISOs image manager" \
			G "CREATE a guest (VM)" \
			M "EDIT   a guest (VM)" \
			S "START  a guest (VM)" \
			K "STOP   a guest (VM)" \
			3 "Virtual Machine monitor" \
			A "About this tool" \
			E "Exit")

			case $MainMenuAnswer in
				A) About;;
				C) BaseConfig;;
				D) DisksManager;;
				I) ISOsManager;;
				G) GuestsCreateWizard;;
				S) StartGuest;;
				3) VirtualMachineMonitor;;
				M) GuestEdit;;
				K) StopGuest;;
				E) break;;
				$EmptyValue) break;;
			esac
		done
	}


########################################################################
########################################################################
# Function About
# Presents basic information about the tool, developer and contact.
About()
	{
		dialog --clear --backtitle "$TUI_Title" --title "About" --msgbox "
			\nA tool for an easy configuration and management of the OpenBSD Virtualization Daemon
			\n
			\n  Copyright (c) 2018   John F. Arroyave Gutiérrez
			\n                       unix4you2@gmail.com
			\n                       www.practico.org
			\n
			\n  This is FREE SOFTWARE under the BSD 3-Clauses license
			\n  
			\n  More info at: https://github.com/unix4you2/vmctl-tui
			" 15 60;
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
			echo '#              This was created automatically by vmctl-tui\n' >> conf/base.conf
			Copyright >> conf/base.conf
			echo '' >> conf/base.conf
			echo 'TUI_DefaultVMMPath="'$TUI_DefaultVMMPath'"  #Virtual Machines configuration' >> conf/base.conf
			echo 'TUI_DefaultVDDPath="'$TUI_DefaultVDDPath'"  #Virtual disks' >> conf/base.conf
			echo 'TUI_DefaultISOPath="'$TUI_DefaultISOPath'"  #Availables ISOS to deploy or mount in VM' >> conf/base.conf
		#Write network config files
	}


########################################################################
########################################################################
# Function Finish
# Do some tasks before finish the application
Finish()
	{
		SaveConfigs
		clear   #Clear before finish
		exit 0;
	}


########################################################################
########################################################################
# MainFunction:  This is the main program that starts everything
	Initialize
	DependencesCheck

	#Test zone:  A line to put some functions for a quickly test
	#ServiceIsRunning sshd
	#exit 0

	MainMenu
	Finish
