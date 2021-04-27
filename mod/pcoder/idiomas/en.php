<?php
	/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2020
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
    Redistribution and use in source and binary forms, with or without
    modification, are permitted provided that the following conditions are met:
    
    1. Redistributions of source code must retain the above copyright notice, this
       list of conditions and the following disclaimer.
    
    2. Redistributions in binary form must reproduce the above copyright notice,
       this list of conditions and the following disclaimer in the documentation
       and/or other materials provided with the distribution.
    
    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
    AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
    IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
    DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
    FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
    DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
    SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
    CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
    OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
    OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
    
		Title: Idioma ingles para modulo de PCoder
		Ubicacion *[idioma/en.php]*.  Incluye la definicion de variables utilizadas para presentar mensajes en el idioma correspondiente
		NOTAS IMPORTANTES:
			* Por cuestiones de rendimiento se recomienda la definicion usando comillas simples.
			* Usar las dobles solo cuando se requieran variables o caracteres especiales.
			* Se pueden definir cadenas en funcion de otras definidas con anterioridad
			* Se puede hacer uso de notacion HTML dentro de las cadenas para dar formato
	*/

	// Cadena que describe el archivo de idioma para su escogencia
	$MULTILANG_PCODER_DescripcionIdioma='Ingles - English';

	//Lexico general
	$MULTILANG_PCODER_Abrir='Open';
	$MULTILANG_PCODER_Aceptar='Accept';
	$MULTILANG_PCODER_Activar='Enable';
	$MULTILANG_PCODER_Archivo='File';
	$MULTILANG_PCODER_Acercar='Zoom in';
	$MULTILANG_PCODER_Alejar='Zoom out';
	$MULTILANG_PCODER_Ayuda='Help';
	$MULTILANG_PCODER_Basicos='Basics';
	$MULTILANG_PCODER_Buscar='Find';
	$MULTILANG_PCODER_Cancelar='Cancel';
	$MULTILANG_PCODER_Caracteres='Characters';
	$MULTILANG_PCODER_Cargando='Loading';
	$MULTILANG_PCODER_Carpeta='Folder';
	$MULTILANG_PCODER_Cerrar='Close';
	$MULTILANG_PCODER_Columna='Column';
	$MULTILANG_PCODER_Copiar='Copy';
	$MULTILANG_PCODER_Cortar='Cut';
	$MULTILANG_PCODER_Depurar='Debug';
	$MULTILANG_PCODER_Desactivar='Disable';
	$MULTILANG_PCODER_Deshacer='Undo';
	$MULTILANG_PCODER_Desplazar='Move';
	$MULTILANG_PCODER_Editar='Edit';
	$MULTILANG_PCODER_Eliminado='Deleted';
	$MULTILANG_PCODER_Error='Error';
	$MULTILANG_PCODER_Estado='Status';
	$MULTILANG_PCODER_Explorar='Explore';
	$MULTILANG_PCODER_Finalizado='Finished';
	$MULTILANG_PCODER_Formato='Format';
	$MULTILANG_PCODER_Guardando='Saving';
	$MULTILANG_PCODER_Guardar='Save';
	$MULTILANG_PCODER_Herramientas='Tools';
	$MULTILANG_PCODER_Ir='Go';
	$MULTILANG_PCODER_Linea='Line';
	$MULTILANG_PCODER_Lineas='Lines';
	$MULTILANG_PCODER_Modificado='Modified';
	$MULTILANG_PCODER_No='No';
	$MULTILANG_PCODER_Nombre='Name';
	$MULTILANG_PCODER_Nuevo='New';
	$MULTILANG_PCODER_Operacion='Operation';
	$MULTILANG_PCODER_Otros='Others';
	$MULTILANG_PCODER_Pegar='Paste';
	$MULTILANG_PCODER_Permisos='Permissions';
	$MULTILANG_PCODER_Predeterminado='Default';
	$MULTILANG_PCODER_Preferencias='{P}Coder editors Preferences';
	$MULTILANG_PCODER_Propietario='Owner';
	$MULTILANG_PCODER_Reemplazar='Replace';
	$MULTILANG_PCODER_Rehacer='Redo';
	$MULTILANG_PCODER_Salir='Quit';
	$MULTILANG_PCODER_Seleccionar='Select';
	$MULTILANG_PCODER_Si='Yes';
	$MULTILANG_PCODER_Tamano='Size';
	$MULTILANG_PCODER_Tipo='Type';
	$MULTILANG_PCODER_Trabajando='Working';
	$MULTILANG_PCODER_Ubicacion='Location';
	$MULTILANG_PCODER_Ver='View';

	//Mensajes de error y varios
	$MULTILANG_PCODER_Minimap='Code Minimap';
	$MULTILANG_PCODER_AumSangria='Increase indent';
	$MULTILANG_PCODER_DisSangria='Decrease indent';
	$MULTILANG_PCODER_ConvMay='Convert to uppercase';
	$MULTILANG_PCODER_ConvMin='Convert to lowercase';
	$MULTILANG_PCODER_OrdenaSel='Order selection';
	$MULTILANG_PCODER_CargarArchivo='Load file';
    $MULTILANG_PCODER_Ajuste='Window adjustment';
	$MULTILANG_PCODER_DefPcoder='Online Code Editor';
	$MULTILANG_PCODER_EnlacePcoder='Code Editor {P}Coder';
	$MULTILANG_PCODER_AtajosTitPcoder='Keyboard shortcuts';
	$MULTILANG_PCODER_PcoderAjuste='Window adjustment';
	$MULTILANG_PCODER_ErrorRW='You dont have rights to write this file! Any change will be lost!';
	$MULTILANG_PCODER_SaltarLinea='Jump to line';
	$MULTILANG_PCODER_Acerca='About';
	$MULTILANG_PCODER_AparienciaEditor='Editor theme';
	$MULTILANG_PCODER_TamanoFuente='Font size';
	$MULTILANG_PCODER_LenguajeProg='Programming language';
	$MULTILANG_PCODER_VerCaracteres='Show hidden chars';
	$MULTILANG_PCODER_CerrarVentana='Changes may lost';
	$MULTILANG_PCODER_PathFull='WebServer Root';
	$MULTILANG_PCODER_PathDisco='Hard disk root';
	$MULTILANG_PCODER_CaracNoImprimibles='Show/Hide Invisible characters';
	$MULTILANG_PCODER_PantallaCompleta='Full screen';
	$MULTILANG_PCODER_PanelIzq='Left panel';
	$MULTILANG_PCODER_PanelDer='Right panel';
	$MULTILANG_PCODER_OcultarPanel='Panel hide';
	$MULTILANG_PCODER_RevisarSintaxis='Check language syntax while I write';
	$MULTILANG_PCODER_SeleccionarTodo='Select all';
	$MULTILANG_PCODER_DepuraErrorSiguiente='Go to next error';
	$MULTILANG_PCODER_DepuraErrorPrevio='Go to previous error';
	$MULTILANG_PCODER_EnrollarSeleccion='Fold selected text';
	$MULTILANG_PCODER_DesenrollarTodo='Unfold all';
	$MULTILANG_PCODER_DuplicarSeleccion='Duplicate selection';
	$MULTILANG_PCODER_InvertirSeleccion='Invert Selection';
	$MULTILANG_PCODER_UnirSeleccion='Join selected in one line';
	$MULTILANG_PCODER_DividirNO='No split code editor';
	$MULTILANG_PCODER_DividirHorizontal='Horizontal split';
	$MULTILANG_PCODER_DividirVertical='Vertical split';
	$MULTILANG_PCODER_ClicSeleccionar='Click to select';
	$MULTILANG_PCODER_ExploradorColores='Color explorer Tool';
	$MULTILANG_PCODER_TerminalRemota='Remote terminal';
	$MULTILANG_PCODER_EditorArchivos='File editor';
	$MULTILANG_PCODER_NavegadorEmbebido='Embedded web browser';
	$MULTILANG_PCODER_AdvertenciaCierre='You are trying to shut down the entire {P} Coder editor. Edited files youve stored still not to be missed. Your confirmation is required to continue.';
	$MULTILANG_PCODER_ErrGuardarDefecto='You must specify a valid file to save or open a file to edit!';
	$MULTILANG_PCODER_ErrGuardarNoPermiso='You dont have rights to write this file using your webserver user!.  Check permissions and try again.';
	$MULTILANG_PCODER_CrearArchivo='New file';
	$MULTILANG_PCODER_CrearCarpeta='New folder';
	$MULTILANG_PCODER_EditarPermisos='Edit permissions';
	$MULTILANG_PCODER_SubirArchivo='Upload file';
	$MULTILANG_PCODER_RecargarExplorador='Explorer reload';
	$MULTILANG_PCODER_EliminarElemento='Delete file/folder';
	$MULTILANG_PCODER_OperacionesFS='Files, Folders and Permissions tasks';
	$MULTILANG_PCODER_ElementoCreado='The element has been created';
	$MULTILANG_PCODER_ElementoExiste='The element already exists';
	$MULTILANG_PCODER_ElementoNoCreado='The element can not be created, deleted or modified over file system.  Please check your permissions';
	$MULTILANG_PCODER_NrosLinea='Show/Hide line numbers, folding and syntax check';
	$MULTILANG_PCODER_CheqSintaxis='Syntax check';
	$MULTILANG_PCODER_LenguajeResaltado='Highlighted language';
	$MULTILANG_PCODER_ExtensionNoSoportada='The file extension that you are trying to open is not supported.  You could add it to the supported extensions if you want to edit this file using PCoder.';
	$MULTILANG_PCODER_HerramientaDiferencias='Differences tool';
	$MULTILANG_PCODER_SensibleMayusculas='Case sensitive';
	$MULTILANG_PCODER_Autocompletado='Autocomplete as you type';
	$MULTILANG_PCODER_HistorialVersiones='Version history';
	$MULTILANG_PCODER_ChatDesarrolladores='Developers chat only';
	$MULTILANG_PCODER_ErrorRO='ERROR: This file is locked for open it simultaneously. Only the user or super user (admin) can unlock it.';
	$MULTILANG_PCODER_AdvertenciaCierre='WARNING: This file was opened by you in the past but this was not closed propertly.  We advice you to close your sessions and files correctly to avoid simultaneous file locks for other users.';
	$MULTILANG_PCODER_AdvConcurrencia='<font color=red>WARNING WARNING WARNING !!!</font><br>This may also indicate that even you have this file open from another workstation. The file will be open but be careful not to overwrite changes when loading the same work file from different computers or use the <b> File-> Version History </b> option to verify any changes.';