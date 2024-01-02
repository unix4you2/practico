<?php
	/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2012-2022
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
	 This program is free software: you can redistribute it and/or modify
	 it under the terms of the GNU General Public License as published by
	 the Free Software Foundation, either version 3 of the License, or
	 (at your option) any later version.

	 This program is distributed in the hope that it will be useful,
	 but WITHOUT ANY WARRANTY; without even the implied warranty of
	 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 GNU General Public License for more details.

	 You should have received a copy of the GNU General Public License
	 along with this program.  If not, see <http://www.gnu.org/licenses/>
	 
	            --- TRADUCCION NO OFICIAL DE LA LICENCIA ---

     Esta es una traducción no oficial de la Licencia Pública General de
     GNU al español. No ha sido publicada por la Free Software Foundation
     y no establece los términos jurídicos de distribución del software 
     publicado bajo la GPL 3 de GNU, solo la GPL de GNU original en inglés
     lo hace. De todos modos, esperamos que esta traducción ayude a los
     hispanohablantes a comprender mejor la GPL de GNU:
	 
     Este programa es software libre: puede redistribuirlo y/o modificarlo
     bajo los términos de la Licencia General Pública de GNU publicada por
     la Free Software Foundation, ya sea la versión 3 de la Licencia, o 
     (a su elección) cualquier versión posterior.

     Este programa se distribuye con la esperanza de que sea útil pero SIN
     NINGUNA GARANTÍA; incluso sin la garantía implícita de MERCANTIBILIDAD
     o CALIFICADA PARA UN PROPÓSITO EN PARTICULAR. Vea la Licencia General
     Pública de GNU para más detalles.

     Usted ha debido de recibir una copia de la Licencia General Pública de
     GNU junto con este programa. Si no, vea <http://www.gnu.org/licenses/>

	*/

	/*
		Title: Idioma ingles
		Ubicacion *[/inc/idioma/en.php]*.  Incluye la definicion de variables utilizadas para presentar mensajes en el idioma correspondiente
		NOTAS IMPORTANTES:
			* Por cuestiones de rendimiento se recomienda la definicion usando comillas simples.
			* Usar las dobles solo cuando se requieran variables o caracteres especiales.
			* Se pueden definir cadenas en funcion de otras definidas con anterioridad
			* Se puede hacer uso de notacion HTML dentro de las cadenas para dar formato
	*/

	// Cadena que describe el archivo de idioma para su escogencia
	$MULTILANG_DescripcionIdioma='Ingles - English';

	//Lexico general (palabras y frases comunes a varios modulos)
	$MULTILANG_Accion='Action';
	$MULTILANG_Actualizacion='Update';
	$MULTILANG_Actualizar='Upgrade';
	$MULTILANG_Administre='Manage';
	$MULTILANG_Agregar='Add';
	$MULTILANG_Ambiente='Environment';
	$MULTILANG_Ambos='Both';
	$MULTILANG_Anonimo='Anonymous';
	$MULTILANG_Anterior='Previous';
	$MULTILANG_Apagado='Off';
	$MULTILANG_Apariencia='Appearance';
	$MULTILANG_Aplicacion='Application';
    $MULTILANG_Aplicando='Applying';
    $MULTILANG_Archivo='File';
	$MULTILANG_Asistente='Wizard';
	$MULTILANG_Atencion='Attention';
	$MULTILANG_Avanzado='Advanced';
	$MULTILANG_Ayuda='Help';
	$MULTILANG_Basedatos='Database';
	$MULTILANG_Basicos='Basics';
    $MULTILANG_BarraHtas='Toolbar';
    $MULTILANG_Bienvenido='Wellcome';
    $MULTILANG_Buscar='Search';
	$MULTILANG_Campo='Field';
	$MULTILANG_Cancelar='Cancel';
	$MULTILANG_Capturar='Capture';
    $MULTILANG_Cargando='Loading';
    $MULTILANG_Cargar='Upload';
	$MULTILANG_Cerrar='Close';
	$MULTILANG_CerrarSesion='Log out';
	$MULTILANG_Cliente='Client';
	$MULTILANG_CodigoBarras='Bar code';
	$MULTILANG_Columna='Column';
	$MULTILANG_Comando='Commando';
	$MULTILANG_ConfiguracionGeneral='General Settings';
	$MULTILANG_Configuracion='Configuration';
	$MULTILANG_ConfiguracionVarias='Configuring multiple options';
	$MULTILANG_Confirma='Are you sure you want to continue?';
	$MULTILANG_Continuar='Continue';
	$MULTILANG_Contrasena='Password';
	$MULTILANG_Controlador='Driver';
    $MULTILANG_Copias='Backups';
	$MULTILANG_Correcto='Right';
	$MULTILANG_Correo='Email';
	$MULTILANG_Creditos='About';
	$MULTILANG_Cualquiera='Any';
	$MULTILANG_Defina='Define';
	$MULTILANG_Descargar='Download';
    $MULTILANG_Deshabilitado='Disabled';
	$MULTILANG_Desplazar='Displace';
    $MULTILANG_Detalles='Details';
	$MULTILANG_Disene='Design';
	$MULTILANG_Editar='Edit';
	$MULTILANG_Ejecutar='Execute';
	$MULTILANG_Elementos='Elements';
	$MULTILANG_Eliminar='Delete';
	$MULTILANG_Embebido='Embed';
	$MULTILANG_Encabezados='Headers';
	$MULTILANG_Encendido='On';
	$MULTILANG_Error='Error';
    $MULTILANG_Escritorio='Desktop';
	$MULTILANG_Estado='Status';
	$MULTILANG_Etiqueta='Label';
    $MULTILANG_Evento='Event';
    $MULTILANG_Existentes='Existing';
    $MULTILANG_Explorar='Explore';
	$MULTILANG_Exportar='Export';
	$MULTILANG_Fecha='Date';
	$MULTILANG_Finalizado='Finished';
    $MULTILANG_Filtro='Filter';
	$MULTILANG_Formularios='Forms';
	$MULTILANG_Funciones='Preauthorized functions';
	$MULTILANG_FuncionesDes='For security reasons, your custom functions or modules should be pre-authorized in this field. Add the functions or actions separated by any character.';
	$MULTILANG_GeneradoPor='Powered by';
	$MULTILANG_General='General';
	$MULTILANG_Grande='Big';
	$MULTILANG_Grafico='Graphic';
	$MULTILANG_Guardar='Save';
    $MULTILANG_Guardando='Saving';
	$MULTILANG_Habilitado='Enabled';
	$MULTILANG_Habilitar='Enable';
    $MULTILANG_Historico='History';
	$MULTILANG_Hora='Time';
	$MULTILANG_Horizontal='Landscape';
	$MULTILANG_IdiomaPredeterminado='Default language';
	$MULTILANG_Imagen='Picture';
	$MULTILANG_Importando='Importing';
	$MULTILANG_Importante='Important';
	$MULTILANG_Importar='Import';
	$MULTILANG_InfoAdicional='Additional information';
	$MULTILANG_Informes='Reports';
	$MULTILANG_Ingresar='Sign in';
	$MULTILANG_Instante='Instant';
    $MULTILANG_Ir='Go';
	$MULTILANG_IrEscritorio='Go to my desk';
	$MULTILANG_Licencia='License';
	$MULTILANG_LlavePaso='Sign Key';
	$MULTILANG_Maquina='Host';
	$MULTILANG_Matriz='Matrix';
	$MULTILANG_Mediano='Medium';
    $MULTILANG_Modulos='Modules';
    $MULTILANG_Mostrando='Showing';
	$MULTILANG_MotorBD='Database Engine';
	$MULTILANG_Ninguno='None';
	$MULTILANG_No='No';
	$MULTILANG_Nombre='Name';
	$MULTILANG_NombreRAD='RAD Name';
    $MULTILANG_Objeto='Object';
    $MULTILANG_OlvideClave='I forgot my password';
	$MULTILANG_Opcional='Optional';
    $MULTILANG_Opcion='Option';
	$MULTILANG_OpcionesMenu='Menu options';
	$MULTILANG_Otros='Others';
	$MULTILANG_Pagina='Page';
	$MULTILANG_ParamApp='Aplication parameters';
	$MULTILANG_Paso='Step';
	$MULTILANG_Pausar='Pause';
	$MULTILANG_Peso='Weight';
	$MULTILANG_Pequeno='small';
	$MULTILANG_Personalizado='Custom';
    $MULTILANG_Pestana='Tab';
    $MULTILANG_Plantilla='Template';
	$MULTILANG_Predeterminado='Default';
    $MULTILANG_Previo='Previous';
	$MULTILANG_Primero='First';
    $MULTILANG_Prioridad='Priority';
    $MULTILANG_Procesando='Processing';
    $MULTILANG_ProcesoFin='Process completed';
    $MULTILANG_Proveedores='Providers';
	$MULTILANG_Puerto='Port';
    $MULTILANG_Recurrente='Recurrent';
    $MULTILANG_Registrarme='Sign In';
    $MULTILANG_Regresar='Return';
    $MULTILANG_Resultados='Results';
	$MULTILANG_SaltarLinea='Jump to line';
    $MULTILANG_Si='Yes';
    $MULTILANG_Siguiente='Next';
	$MULTILANG_Seleccionar='Select';
    $MULTILANG_SeleccioneUno='Choose one';
    $MULTILANG_Servidor='Server';
	$MULTILANG_Suspender='Suspend';
	$MULTILANG_Tablas='Tables';
	$MULTILANG_TablaDatos='Data table';
	$MULTILANG_Tamano='Size';
	$MULTILANG_Tareas='Tasks';
	$MULTILANG_TiempoCarga='Load time';
	$MULTILANG_Tipo='Type';
	$MULTILANG_TipoMotor='Engine type';
	$MULTILANG_Titulo='Title';
	$MULTILANG_TotalRegistros='Total records found';
	$MULTILANG_Trazabilidad='Traceability';
	$MULTILANG_Truncar='Truncate';
	$MULTILANG_Ultimo='Last';
    $MULTILANG_Usuario='User';
	$MULTILANG_Vacio='Empty';
	$MULTILANG_Variables='Variables';
	$MULTILANG_Version='Version';
	$MULTILANG_Vertical='Portrait';
	$MULTILANG_ZonaHoraria='Time zone';
	$MULTILANG_ZonaPeligro='Danger zone';
	$MULTILANG_VistaImpresion='Printer view';
	$MULTILANG_IDGABeacon='Google Analytics ID';
	$MULTILANG_AyudaGABeacon='Those developers who want to have a full log or real time statistics about their software using Google Analytics can put here the unique ID from their Google Analytics Panel.  Practico will send all statistics tu your Analytics Panel in real time and install statistics to Framework developers.';

	//Ventana de login
	$MULTILANG_TituloLogin='System Login';
	$MULTILANG_CodigoSeguridad='Security code';
	$MULTILANG_IngreseCodigoSeguridad='Enter the code';
	$MULTILANG_AccesoExclusivo='Access to this software is only for registered users. For your safety, never share your username and password.';
	$MULTILANG_LoginNoWSTit='Error trying to load the authentication webservice';
	$MULTILANG_LoginNoWSDes='The file_get_contents() function can not to load the XML output file built by Practico authentication process.<br>  Check your web server configuration/installation to see that this funtion can works correctly and without restrictions.<br>  A way to check that Practicos process is fine but your server doesnt allow to load the XML file<br>is opening the next link and checking if your browser loads the XML correctly.  Activating debug mode on your Practicos config you could see more details: ';
	$MULTILANG_OauthLogin='Login using my social network';
	$MULTILANG_LoginClasico='Login with my account of ';
	$MULTILANG_LoginOauthDes='Click over the logo of your favorite social network or provider to login using the same username and password.';
	$MULTILANG_CaracteresCaptcha='Number of characters or symbols for captcha?';
	$MULTILANG_TipoCaptcha='Type of captcha used for access screen';
	$MULTILANG_TipoCaptchaTradicional='Traditional (numbers and letters) requires PHP GD enabled.';
	$MULTILANG_TipoCaptchaVisual='Visual selection of images. No GD library required';
	$MULTILANG_TipoCaptchaPrefijo='Click on the';
	$MULTILANG_TipoCaptchaPosfijo='icon to validate';
    $MULTILANG_SimboloCaptchaCarro='CAR';
    $MULTILANG_SimboloCaptchaTijeras='SCISSORS';
    $MULTILANG_SimboloCaptchaCalculadora='CALCULATOR';
    $MULTILANG_SimboloCaptchaBomba='BOMB';
    $MULTILANG_SimboloCaptchaLibro='BOOK';
    $MULTILANG_SimboloCaptchaPastel='CAKE';
    $MULTILANG_SimboloCaptchaCafe='CAFE';
    $MULTILANG_SimboloCaptchaNube='CLOUD';
    $MULTILANG_SimboloCaptchaDiamante='DIAMOND';
    $MULTILANG_SimboloCaptchaMujer='WOMAN';
    $MULTILANG_SimboloCaptchaHombre='MAN';
    $MULTILANG_SimboloCaptchaBalon='BALL';
    $MULTILANG_SimboloCaptchaControl='GAMEPAD';
    $MULTILANG_SimboloCaptchaCasa='HOUSE';
    $MULTILANG_SimboloCaptchaCelular='CELLPHONE';
    $MULTILANG_SimboloCaptchaArbol='TREE';
    $MULTILANG_SimboloCaptchaTrofeo='TROPHY';
    $MULTILANG_SimboloCaptchaSombrilla='UMBRELLA';
    $MULTILANG_SimboloCaptchaUniversidad='UNIVERSITY';
    $MULTILANG_SimboloCaptchaCamara='CAMERA';
    $MULTILANG_SimboloCaptchaAmbulancia='AMBULANCE';
    $MULTILANG_SimboloCaptchaAvion='AIRPLANE';
    $MULTILANG_SimboloCaptchaTren='TRAIN';
    $MULTILANG_SimboloCaptchaBicicleta='BIKE';
    $MULTILANG_SimboloCaptchaCamion='TRUCK';
    $MULTILANG_SimboloCaptchaCorazon='HEART';
	$MULTILANG_LogoParteSuperior='Logo at the top left of your application';
	$MULTILANG_LogoDuranteLogin='Logo at the moment of your application login';
	$MULTILANG_ResolucionLogos='If the loaded image does not have the indicated resolution, it will be resized every time it is presented to the user.';

	//Banderas de campos en formularios
	$MULTILANG_TitValorUnico='The value entered does not accept duplicate';
	$MULTILANG_DesValorUnico='The system will validate the information entered in this field, if there is already a record with that value in the database will not be allowed entry.';
	$MULTILANG_TitObligatorio='Required field';
	$MULTILANG_DesObligatorio='You should enter a value for this field.';

	//Errores y avisos varios
	$MULTILANG_VistaPrev='Preview';
	$MULTILANG_TituloInsExiste='ATTENTION: The installation folder exists on the server';
	$MULTILANG_TextoInsExiste='This message appears permanently to all users as you do not delete the directory used for the installation of Practico. It is essential that the folder is deleted after the end of an installation to prevent any anonymous user initiate the process again overwritting configuration files or databases with information of importance to you<br><br>If you have already completed an install of Practico for use in production is important to remove this folder before proceeding. If you want to delete this folder you can choose to rename in temporary or trial. <br> <br> If you are viewing this message when running this script for the first time and want to make a new installation, you can launch the wizard  <a class="btn btn-primary btn-xs" href="javascript:document.location=\'ins\';"><i class="fa fa-rocket"></i> Clicking HERE</a> ';
	$MULTILANG_ErrorTiempoEjecucion='RunTime Error';
	$MULTILANG_ErrorModulo='Main module is trying to include a module located in <b>mod/</b> but Practico can not find your access point. <br> Check the module status, consult your administrator or delete the conflicting module to avoid this message.';
	$MULTILANG_ContacteAdmin='Contact your system administrator and report this post.';
	$MULTILANG_ReinicieWeb='Please make the required settings and restart your web service.';
	$MULTILANG_PHPSinSoporte='Your PHP installation appears to have no support';
	$MULTILANG_ErrExtension='PHP Extension missing, disabled or a module is required';
	$MULTILANG_ErrLDAP=$MULTILANG_PHPSinSoporte.' LDAP support is required for use as external authentication method.<br>'.$MULTILANG_ReinicieWeb.'.<br>The admin user authentication will remain independent to avoid loss of access.';
	$MULTILANG_ErrHASH=$MULTILANG_PHPSinSoporte.' HASH support is required.<br>This extension is required if you selected a different encryption type for passwords on engines up external authentication.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrSESS=$MULTILANG_PHPSinSoporte.' sessions support is required. '.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrGD=$MULTILANG_PHPSinSoporte.' GD Graphics Library is required.<br>Those who are using debian, ubuntu or its derivatives can try a <b> apt-get install php5-gd </ b> to add it. RedHat or CentOS users <b> yum install php-gd </ b>. Users from other platfroms should chech their documentation.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrCURL=$MULTILANG_PHPSinSoporte.' cURL Library is required.<br>Those who are using debian, ubuntu or its derivatives can try a <b> apt-get install php5-gd </ b> to add it.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrSimpleXML=$MULTILANG_PHPSinSoporte.' SimpleXML Library is required.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrExtensionGenerica=$MULTILANG_PHPSinSoporte.' activated for this library or extension.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrPDO=$MULTILANG_PHPSinSoporte.' PDO support is required.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrDriverPDO=$MULTILANG_PHPSinSoporte.' for PDO. '.$MULTILANG_ReinicieWeb;
	$MULTILANG_ObjetoNoExiste='The object associated with this request does not exist.';
	$MULTILANG_ErrorDatos='Problem in the input data';
	$MULTILANG_ErrorTitAuth='<blink>ACCESS DENIED!</blink>';
	$MULTILANG_ErrorDesAuth='<div align=left>The credentials supplied for access to the system were not accepted. Some common causes are:<br><li> The username or password is incorrect. <br> <li> Security code entered incorrectly. <br> <li> Your Login is disabled. <br> <li> Account locked access by multiple attempts with incorrect password.</div>';
	$MULTILANG_ErrorSoloAdmin='Only admin user can see the transaction details with debug mode turned On';
	$MULTILANG_ErrGoogleAPIMod='OAuth2 for Google was configured as default auth method.<br>Anyway the Practicos module for google-api is not installed yet.<br>Please download the google-api module from Practicos website and reload again.';
	$MULTILANG_ErrFuncion='<br>PHP Function doesnt exists or is disabled in your server: ';
	$MULTILANG_ErrDirectiva='The environment var should be enabled on your PHP or web server configuration';
    $MULTILANG_AdminArchivos='File manager';
    $MULTILANG_ErrorConnLDAP='An error ocured during LDAP server connection. Please check your settings and try again.  Details:<br>';
    $MULTILANG_ErrorRW='There is not rights to write the file! Any change to its content could be lost';
    $MULTILANG_ErrorExistencia='The filename you asked for edittion doesnt exists!';
    $MULTILANG_ErrorNoACE='ACE module was not found trying to edit file';
    $MULTILANG_AyudaExplorador='Important:  Some folders are showed as information about it exists only.  Perhaps, folders expand if they have editable files only.';
    $MULTILANG_EnlacePcoder='{PCoder}: Code Editor';
    $MULTILANG_AtajosTitPcoder='Keyboard shortcut';
    $MULTILANG_AvisoSistema='System message';
    $MULTILANG_PcoderAjuste='Window adjustment';
    $MULTILANG_PcoderAjusteConfirma='You are going to reload this window to resize window as your maximum resolution.  When you reload this window you can lost any change that you dont already saved.  Do you want to continue?';
    $MULTILANG_BuscaCriterios='You should enter a key word to search';
    $MULTILANG_EstadoPHP='PHP Info';
    $MULTILANG_ArchivosLimpiados='Cleaned/Purged files';
    $MULTILANG_EspacioLiberado='Disk space freed';
    $MULTILANG_TitDemo='The function requested is not available';
    $MULTILANG_MsjDemo='You are in a facility in DEMO (or demonstration) mode. Such facilities do not allow you to interact freely with all security controls. This helps ensure that you will always be available for all users who want to try the platform.';
    $MULTILANG_SeparadorCampos='String value for field separator';
    $MULTILANG_SeparadorCamposDes='Used to separate values in queries over the data base engine.  This should be an uncommon value to keep any match with the data entered by users';
    $MULTILANG_SelectorIdioma='Users can change language at login time';
    $MULTILANG_SelectorIdiomaAyuda='Shows a select list during the login with all languages availables in the platform.';
    $MULTILANG_ErrorConexionInternet='It looks like you have run out of Internet, the connection to the system will be restored when your Internet connection is normal.<br><br>Check that your network connection or data signal is active.';
    $MULTILANG_NombreRADDes='Name used for the application generator.  This is used for window titles too';
    $MULTILANG_SaltoEdicion='You are about to close the edit of the current element and jump to the edit window of the selected element. Do you wish to continue?';
    $MULTILANG_ExportacionMasiva='Massive export';
    $MULTILANG_AgregarAExportacion='Add item to bulk export list';
    $MULTILANG_ImagenFondo='Background image';
    $MULTILANG_ImagenFondoDes='Define a background image to customize your application. It is recommended wide but light. Recommendation: You should combine theme colors and controls with the image palette to harmonize your design. By default the value is img/fondo.jpg but you can change it to any relative path from the root of the system, even to animated files.';
    $MULTILANG_ImagenDefecto='Empty for nothing or relative path';
    
	//Asistente disenador aplicaciones
	$MULTILANG_DesAppBoton='Application design';
	$MULTILANG_TitDisenador='Designing the application <b>is simple and fast:</b>';
	$MULTILANG_DefTablas='Table Definition';
	$MULTILANG_DesTablas='Tables are those structures in which information is stored using forms associated with them.';
	$MULTILANG_DefForms='for data entry and querying info';
	$MULTILANG_DesForms='They allow the user to enter information according to certain validations or formats, consult or even delete records. Display also allow other elements such as pages or predesigned reports.';
	$MULTILANG_DefInformes='(graphics or tables)';
	$MULTILANG_DesInformes='They present existing information within tables to users in different formats and filters defined. You can create tabular or chart type and subsequently also be embedded in other spaces.';
	$MULTILANG_DefMenus='for the users';
	$MULTILANG_DesMenus='Link objects designed as forms or reports with graphical icons and text descriptions that may be selected by a user with that permission. It also allows you to link external functions or custom command execution.';
	$MULTILANG_UsuariosPermisos='Users and Permissions';
	$MULTILANG_DefUsuarios='to access your application';
	$MULTILANG_DesUsuarios='Sets the access credentials for each user, and the permissions available to each to access forms, reports or any previously defined menu options.';
	$MULTILANG_DefAvanzadas='Advanced tools';
	$MULTILANG_DefMantenimientos='Maintenance';
	$MULTILANG_DefPcoder='Online code editor';
	$MULTILANG_DefLimpiarTemp='Clean temporary folder /tmp';
	$MULTILANG_DefLimpiarBackups='Clean existing backups on /bkp';
	$MULTILANG_DefPMyDB='Advanced database administrator';
	$MULTILANG_ConfirmaPMyDB='IMPORTANT: Improper handling of the tables and their information through advanced database administrator may cause partial or total loss of information as well as unpredictable performances in its application. We recommend using this database manager with the care involved.';

	//Cierre de sesion
	$MULTILANG_SesionCerrada='Your session has been closed';
	$MULTILANG_TituloCierre='This can result from actions taken by the user like';
	$MULTILANG_ExplicacionCierre='<li>Close your session voluntarily</li>
			<li>Stop using the system for a long time</li>
			<li>Having multiple windows open at the same time system in restricted sections by admin</li>
			<li>Your username or password is invalid for further operation</li>
			<li>Navigate using links or other buttons than those permitted</li>
			<br><strong>Also for configurations or actions on your computer like:</strong><br>
			<li>Your browser is not supporting cookies</li>
			<li>Cleaned cache of browser cookies or sessions while using the system</li>
			<br><strong>System configurations also like:</strong><br>
			<li>You have completed an installation process of the platform requires a restart of session</li>
			<li>The SignKey of the user does not corresponds to the key required by this system</li>
			<li>The credentials to sign an operation are not valid</li>';

	//Actualizacion de plataforma
	$MULTILANG_ActMsj1='ATTENTION: Please read this information before continuing';
	$MULTILANG_ActMsj2='Pr&aacute;ctico provides this mechanism to implement automatic updates to your system with incremental patches downloaded from the official website or by project wizard for updates, however, before applying any patch is essential that:<br><br>
			<li>Make a backup of your databases. Some updates may require modification of structures on the basis of data information that may affect.
			<li>Back up your files or Practico folder.
			<li>CLEAN the Practico working folder (path tmp /) it will be used by the wizard to decompress and scan files.';
	$MULTILANG_ActUsando='Currently you are using version';
	$MULTILANG_ActPaquete='Package / Manual update Patch';
	$MULTILANG_ActSobreescritos='Previous files will be overwritten';
	$MULTILANG_CargarArchivo='Upload file';
	$MULTILANG_Adjuntando='Attaching a new file to the system';
	$MULTILANG_ErrorTamano='<b> WARNING: </b> interrupted process. The file exceeds the size limit';
	$MULTILANG_ErrorFormato='<b> WARNING: </b> interrupted process. The format of the uploaded file is not valid';
	$MULTILANG_CargaCorrecta='The file has been uploaded correctly';
	$MULTILANG_ErrorDesconocido='<b> WARNING: </b> An unknown error occurred while uploading the file';
	$MULTILANG_ErrorDescomprimiendo='Unpacking file';
	$MULTILANG_ContenidoParche='File contents';
	$MULTILANG_ErrorVerAct='Error loading the current version of Practico. File not found';
	$MULTILANG_ErrorActualiza='The uploaded file does not appears to be a valid upgrade package. File not found';
	$MULTILANG_ErrorAntigua='The uploaded patch file references a oldest update that your current version';
	$MULTILANG_ErrorVersion='The uploaded patch file requires the following version';
	$MULTILANG_AvisoIncremental='You must first apply incremental patches required to raise their minimum system version that requires patch.';
	$MULTILANG_Integridad='Integrity';
	$MULTILANG_ResumenParche='Summary of changes and functionalities provided by the patch';
	$MULTILANG_ResumenInstrucciones='Instructions to be executed on system tables';
	$MULTILANG_FinRevision='REVIEW PROCESS FINISHED';
	$MULTILANG_ActMsj3='In applying the above listed files will upgrade your system to the next version';
	$MULTILANG_ActErrGral='File structure, type or version unsupported';
	$MULTILANG_ActDesde='Updating from version';
	$MULTILANG_ErrLista='Error loading list of files to backup';
	$MULTILANG_HaciendoBkp='Making backup';
	$MULTILANG_ErrBkpBD='An error occurred during the database backup';
	$MULTILANG_ActMsj4='If any of the files could not be written by this wizard by permissions issues, the patch can also be applied manually by the administrator or by copying only files missing';
	$MULTILANG_ActMsj5='File structure or type unsupported';
	$MULTILANG_ActAlertaVersion='There is a new version of Practico available to download.<br>We recommend you to download the new version or upgrade package from the official website and upgrade your system to have the new features.';
	$MULTILANG_ActBuscarVersion='Look for new versions automatically';
    $MULTILANG_ActErrEscritura='Write error';
    $MULTILANG_ActDesEscritura='WARNING: There are write errors in the files that are going to be upgraded.
        <br><br>To keep the integrity in the software you cant upgrade until you fix the file permissions to be writable by Practico.  Files are marked in the list in red color and the text "'.$MULTILANG_ActErrEscritura.'".  
        <br><br>Fix the problem and try again.';
    $MULTILANG_ActBackupTipo='Backup mode';
    $MULTILANG_ActBackup1='Scripts replaced during this process only';
    $MULTILANG_ActBackup3='Scripts replaced and all my database';
    $MULTILANG_ActBackupDes='Doing a full backup could be a heavy task for the system.  In systems widely used a full backup process should be done by another tool that allow you to have consistent files even with users working on the fly.';

	//Formularios
	$MULTILANG_ErrFrmDuplicado='Failed duplicate value in the field. The value you entered already exists in the database. Field: ';
	$MULTILANG_ErrFrmObligatorio='You forgot to enter mandatory field: ';
	$MULTILANG_ErrFrmDatos='There is a problem in the input data';
	$MULTILANG_ErrFrmCampo1='You must enter a valid title or label for the field.';
	$MULTILANG_ErrFrmCampo2='You must enter a valid field to link to the data table associated with the form.';
	$MULTILANG_ErrFrmCampo3='You must enter a valid title or label for the button.';
	$MULTILANG_ErrFrmCampo4='You must enter a valid action to be executed when control is activated.';
	$MULTILANG_FrmMsj1='Add an item to the form';
	$MULTILANG_FrmTipoObjeto='Type of object to add';
	$MULTILANG_FrmTipoTit1='Data Controls';
	$MULTILANG_FrmTipo1='Short text field';
	$MULTILANG_FrmTipo2='Free/Unlimited text field';
	$MULTILANG_FrmTipo3='Richly formatted text field (CKEditor)';
	$MULTILANG_FrmTipo4='Selection field (ComboBox dropdown list)';
	$MULTILANG_FrmTipo5='Selection field (RadioButton)';
	$MULTILANG_FrmTipoTit2='Presentation and other content';
	$MULTILANG_FrmTipo6='Rich Text (as a label)';
	$MULTILANG_FrmTipo7='Wrapper (iFrame)';
	$MULTILANG_FrmTipoTit3='Internal objects';
	$MULTILANG_FrmTipo8='Report predesigned (Data Table or Graph)';
	$MULTILANG_FrmTipo9='Slider (numeric range selector - HTML5)';
	$MULTILANG_FrmTipo10='Password field';
	$MULTILANG_FrmTipo11='Field value as label';
	$MULTILANG_FrmTipoTit4='Special Data Controls';
	$MULTILANG_FrmTipo12='Attached file';
	$MULTILANG_FrmTipo13='Canvas (Drawing area - HTML5)';
	$MULTILANG_FrmTipo14='Canvas (Webcam capture - HTML5)';
	$MULTILANG_FrmTipo15='SubForm (To query and ReadOnly)';
    $MULTILANG_FrmTipo16='Command button';
    $MULTILANG_FrmTipo17='Richly formatted text field (Responsive)';
	$MULTILANG_FrmTipo18='Verify field (CheckBox)';
	$MULTILANG_FrmTipoPincel='Brush size';
	$MULTILANG_FrmTipoColor='Line color';
	$MULTILANG_FrmTipoAdvertencia='This kind of data controls should be stored in your table into a long text or unlimited field';
	$MULTILANG_FrmValorMinimo='Minimum value';
	$MULTILANG_FrmValorMaximo='Maximum value';
	$MULTILANG_FrmValorSalto='Step value';
	$MULTILANG_FrmTitValorSalto='How many units jump the slider on each movement?';
	$MULTILANG_FrmTitulo='Title or Tag';
	$MULTILANG_FrmDesTitulo='Text that will appear next to the field telling the user the information that must be entered. You can use basic HTML to additional format.';
	$MULTILANG_FrmCampo='Linked field';
	$MULTILANG_FrmFiltroLista='List filter condition';
	$MULTILANG_FrmDesFiltroLista='Special condition that records must have to be displayed.  This condition could use any field in your source table that are not selected as values too.  Fixed values should be enclosed in double cuotes and you can use another expresions like ORDER BY, GROUP BY, LIMIT, Etc. This field will be added after a WHERE clausule in the query.  REMEMBER: If you dont have a Condition but you want a ORDER BY OR GROUP BY then add at least an 1=1 before to apply to the condittion. You could use {$Variable} to refer a PHP Variable too';
	$MULTILANG_FrmCampoOb1='Mandatory field for data binding controls';
	$MULTILANG_FrmDesCampo='Field data table which will link information.  In file fields this could contain the relative path to the file uploaded in the server.  Every file should have at least one field to store its path';
	$MULTILANG_FrmValUnico='Single value field';
	$MULTILANG_FrmTitUnico='Uniqueness for input values';
	$MULTILANG_FrmDesUnico='Indicates whether the field can store or repeated values ​​in the database. Should be enabled for fields representing primary keys in their Design and disabled for the rest.  You should take care in that forms that you need this field to do upgrades and its duplicate error message.';
	$MULTILANG_FrmPredeterminado='Default value';
	$MULTILANG_FrmDesPredeterminado='Sets the value that appears automatically filled in the field to open the form view. This value can be out of data validation.  If a PHP session variable is entered then Practico will take its value.';
	$MULTILANG_FrmValida='Data validation';
	$MULTILANG_FrmValida1='Numbers only 0-9 (with decimal)';
	$MULTILANG_FrmValida2='Only letters a-z A-Z';
	$MULTILANG_FrmValida3='Letters and numbers';
	$MULTILANG_FrmValida4='Date field using unified calendar';
	$MULTILANG_FrmValida7='Date field using separated pickers (year, month and day)';
	$MULTILANG_FrmValida5='Time field';
	$MULTILANG_FrmValida6='Date and Time field';
	$MULTILANG_FrmValida8='Date and Time field using unified selector';
	$MULTILANG_FrmValidaDes='Filter type to be applied when the user enters information by keyboard';
	$MULTILANG_FrmLectura='Read only field';
	$MULTILANG_FrmTitLectura='Defines whether you can change its value or not';
	$MULTILANG_FrmDesLectura='Property useful for fields or forms from the user query which is required to display the value but not allow modification';
	$MULTILANG_FrmAyuda='Help title';
	$MULTILANG_FrmDesAyuda='Text that will appear as a header for the field help text explaining to the user what to enter';
	$MULTILANG_FrmTxtAyuda='Help text';
	$MULTILANG_FrmDesTxtAyuda='Full Text with summary function description for the field. You can include formatting instructions, warnings or any other message to the user';
	$MULTILANG_FrmDesPeso='Position in which the field appears on the form when it is displayed on screen. Order.';
	$MULTILANG_FrmDesColumna='Column to locate the field when the form view has multiple columns. Those fields larger than the defined columns in the form will not be drawn';
	$MULTILANG_FrmObligatorio='Mandatory';
	$MULTILANG_FrmVisible='Visible';
	$MULTILANG_FrmDesVisible='Determines whether the control is visible or not to the user. If left control is not used but as a hidden';
	$MULTILANG_FrmLblBusqueda='Use for record search? Label';
	$MULTILANG_FrmTitBusqueda='Indicates whether the field is used to search for records';
	$MULTILANG_FrmDesBusqueda='Leave blank to indicate that it is a normal field or enter the label that should go in the command button located on the right side to make the search for records';
	$MULTILANG_FrmAjax='Use AJAX to reload all item list';
	$MULTILANG_FrmAjaxDinamico='Use AJAX to retrieve items dinamically when you type';
	$MULTILANG_FrmTitAjax='Record Recovery Mode';
	$MULTILANG_FrmDesAjax='When the box is turned on, Practico attempts to retrieve the log information to the form using AJAX. In a combo box that takes its values from a table you can use it to add a button to refresh its contents online.';
	$MULTILANG_FrmTeclado='Add virtual keyboard';
	$MULTILANG_FrmTitTeclado='Allow data entry by on-screen keyboard';
	$MULTILANG_FrmDesTeclado='When enabled on the form displays a virtual keyboard for entering information,. For now the keyboard use may violate validations';
	$MULTILANG_FrmAncho='Width';
	$MULTILANG_FrmTitAncho='How wide should occupy space control';
	$MULTILANG_FrmDesAncho='IMPORTANT: in characters number for simple text fields and pixels rich-text fields or drop down lists.  An empty or zero value means automatic.  Enter a number of columns, however, note that the width in pixels will vary according to the type of font used by the current theme.  For image or bar code fields this value is for the size of the picture.  For canvas objects you can specify the width and the final scale percent using a pipe character. IE: 400|0.3 will create a 400 pixels object but it will save it as 30% of scale.';
	$MULTILANG_FrmDesAncho2='Minimum recommended for rich-text format fields: 350';
	$MULTILANG_FrmAlto='Height (lines)';
	$MULTILANG_FrmTitAlto='How many rows should be visible in the control?';
	$MULTILANG_FrmDesAlto='IMPORTANT: the number of rows for simple text or in pixels for rich-text formatting. If the text exceeds the number of rows are automatically added scrollbars.  For image or bar code fields this value is for the size of the picture.';
	$MULTILANG_FrmDesAlto2='Minimum recommended format fields: 100';
	$MULTILANG_FrmBarra='Formatting bar';
	$MULTILANG_FrmBarraCKEditor='Available for CKEditor';
	$MULTILANG_FrmBarraSummer='Available for SummerNote (Responsive)';
	$MULTILANG_FrmBarraTipo1='Basic: Document, character and paragraph formatting';
	$MULTILANG_FrmBarraTipo2='Standard: Basic + links and font styles';
	$MULTILANG_FrmBarraTipo3='Extended: Standard + clipboard, search-replace and spelling';
	$MULTILANG_FrmBarraTipo4='Advanced: Extended + Insert objects and colors';
	$MULTILANG_FrmBarraTipo5='Full: Advanced + Forms and full screen';
	$MULTILANG_FrmBarraTipo1Summer='Basic: Character and paragraph formatting';
	$MULTILANG_FrmBarraTipo2Summer='Standard: Basic + font styles';
	$MULTILANG_FrmBarraTipo3Summer='Extended: Standard + Tables, links and lines';
	$MULTILANG_FrmBarraTipo4Summer='Advanced: Extended + FullScreen and HTML Source';
	$MULTILANG_FrmBarraTipo5Summer='Full: Advanced + Insert images and videos';
	$MULTILANG_FrmTitBarra='Editor type used';
	$MULTILANG_FrmDesBarra='Indicates the type of toolbar that appears at the top of the control and the user to perform different tasks of editing. IMPORTANT: Each type of editor requires a different space on the form as it should deploy a number of icons and different options';
	$MULTILANG_FrmFila='Single row for this object?';
	$MULTILANG_FrmTitFila='Must Practico use a full row for the object?';
	$MULTILANG_FrmDesFila='Allows to display the object in a unique row of the table used in the form';
	$MULTILANG_FrmLista='Options list';
	$MULTILANG_FrmTitLista='What options are to be chosen.  Enter a comma character only to say Practico that put an empty value at the beginning.  Leave in blank to use as default the first record founded.    Enter _OPTGROUP_|Label to group some options and _OPTGROUP_ only to close groups of options.';
	$MULTILANG_FrmDesLista='Enter a list of options separated by commas. If you need to take the options table dynamically from another application to use the Data Source fields for options. Should fill both options (fixed list and data source) the result will be the combination';
	$MULTILANG_FrmDesLista2='Commas separated';
	$MULTILANG_FrmOrigen='Options list source';
	$MULTILANG_FrmTitOrigen='You must specify the same source (table) from the list of values';
	$MULTILANG_FrmDesOrigen='From which Field are made the choices that displays the list';
	$MULTILANG_FrmTitOrigen2='What is this?';
	$MULTILANG_FrmOrigenVal='List of values source';
	$MULTILANG_FrmTitOrigenVal='You must specify the same source (table) from the list of options';
	$MULTILANG_FrmDesOrigenVal='Field from which values ​​are taken internally (to be processed) for each option in the list.    If the field value contains _OPTGROUP_|Label this will create a group of options and if the value is  _OPTGROUP_ only then this will close the group of options.';
	$MULTILANG_FrmEtiqueta='Value of the label (it will be printed on the form in HTML format)';
	$MULTILANG_FrmURL='IFrame URL';
	$MULTILANG_FrmDesURL='Enter the address of the page that will be embedded in the IFrame';
	$MULTILANG_FrmInforme='Linked report';
	$MULTILANG_FrmFormulario='Linked Subform';
	$MULTILANG_FrmDesCampoVinculo='Put here the local fields name (parent form field) to be used for search data in the sub-form';
	$MULTILANG_FrmDesCampoForaneo='Put here the Foreign field from the subform to be used to compare or search data in the local field to show data.';
	$MULTILANG_FrmVentana='Create a window for the object?';
	$MULTILANG_FrmDesVentana='It is NOT recommended to activate this field when you want to embed GRAPHIC type reports';
	$MULTILANG_FrmLongMaxima='Maximum length';
	$MULTILANG_FrmTit1LongMaxima='How many characters can the field store?';
	$MULTILANG_FrmTit2LongMaxima='Value between 1 and N, 0 to disable limits';
	$MULTILANG_FrmBtnGuardar='Add or update the object / field';
	$MULTILANG_FrmAgregaBot='Add buttons and actions to form';
	$MULTILANG_FrmTituloBot='Title or Tag';
	$MULTILANG_FrmDesBot='Text to appear on the button';
	$MULTILANG_FrmEstilo='Style';
	$MULTILANG_FrmDesEstilo='Graphical appearance for the control';
	$MULTILANG_FrmTipoAccion='Action type';
	$MULTILANG_FrmAccionT1='Internal actions';
	$MULTILANG_FrmAccionGuardar='Save data';
	$MULTILANG_FrmAccionLimpiar='Clean data';
	$MULTILANG_FrmAccionEliminar='Delete data (requires a unique value field ,even hidden)';
	$MULTILANG_FrmAccionActualizar='Update data';
	$MULTILANG_FrmAccionRegresar='Go back to desktop';
	$MULTILANG_FrmAccionCargar='Object load';
	$MULTILANG_FrmAccionT2='User defined';
	$MULTILANG_FrmAccionExterna='In personalizadas.php or any other module installed';
	$MULTILANG_FrmAccionJS='JavaScript command';
	$MULTILANG_FrmDesAccion='Command to be run when clicked control. For actions defined is personalizadas.php form data will be sent to that routine for processing';
	$MULTILANG_FrmAccionCMD='User command';
	$MULTILANG_FrmAccionDesCMD='Action name that should exists in personalizadas.php or any other module that will process the information or a JavaScript command to be executed inmediately for the App (if you need to send some parameter you could use sigle quotes to enclose them). If you need to load Practicos Objects like a forms or report you could use the same sintax used for menues items: frm:XX:Par1:Par2:ParN o inf:XX...  There is a javascript command available called ImprimirMarco(\'PCO_MarcoImpresionXX\') that let you print the active form content.  You can use commands like PCO_VentanaPopup(\'http://www.google.com\',\'YourTitle\',\'toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, width=640, height=480\'); .Check docs for a complete guide.';
	$MULTILANG_FrmDesPeso='Position in which the field appears in the status bar of the form when it is displayed on screen. Order from left to right';
	$MULTILANG_FrmBotDesVisible='Determines whether the control is visible or not to the user';
	$MULTILANG_FrmRetorno='Return title';
	$MULTILANG_FrmDesRetorno='Text that will appear as a header on the desktop after performing the action indicated by the user';
	$MULTILANG_FrmTxtRetorno='Return text';
	$MULTILANG_FrmTxtDesRetorno='Full Text with description of action taken or delivered to the user message after running control';
	$MULTILANG_FrmTxtRetornoIcono='Icon for return';
	$MULTILANG_FrmTxtDesRetornoIcono='Set an icon to put in the message.  Use AwesomeFonts notation.  I.E.:  fa-info-circle  to show an information icon.';
	$MULTILANG_FrmTxtRetornoEstilo='CSS style for the return message (if applies)';
	$MULTILANG_FrmConfirma='Confirmation Text';
	$MULTILANG_FrmDesConfirma='If its filled, Text that will appear as a popup warning control execution and waiting for user confirmation to proceed';
	$MULTILANG_FrmBtnGuardarBut='Add Action / Button';
	$MULTILANG_FrmDisCampos='General fields design';
	$MULTILANG_FrmDesObliga='Note that the required fields should be visible';
	$MULTILANG_FrmGuardaCol='Save column';
	$MULTILANG_FrmAumentaPeso='Increase weight (down)';
	$MULTILANG_FrmDisminuyePeso='Decrease Weight (up)';
	$MULTILANG_FrmHlpCambiaEstado='Change status';
	$MULTILANG_FrmAdvDelCampo='IMPORTANT: Deleting this field users can not see it and you can not undo this operation.\n'.$MULTILANG_Confirma;
	$MULTILANG_FrmTitComandos='General definition of actions and commands';
	$MULTILANG_FrmTipoAcc='Action type';
	$MULTILANG_FrmAccUsuario='User action';
	$MULTILANG_FrmOrden='Command';
	$MULTILANG_FrmAdvDelBoton='IMPORTANT: When removing the button / action users can not view or run the command associated with this and you can not undo this operation later.\n'.$MULTILANG_Confirma;
	$MULTILANG_FrmObjetos='Objects and Data Fields';
	$MULTILANG_FrmDesObjetos='Add an object or data field';
	$MULTILANG_FrmDesCampos='Fields general design';
	$MULTILANG_FrmAcciones='Actions, buttons and commands';
	$MULTILANG_FrmDesBoton='Add button or action';
	$MULTILANG_FrmDesAcciones='General definition of actions';
	$MULTILANG_FrmVolverLista='Back to list of forms';
	$MULTILANG_FrmErr1='You must enter a valid title for the form.';
	$MULTILANG_FrmErr2='Please specify a valid name for the data table associated with the form.';
	$MULTILANG_FrmAgregar='Add New Form';
	$MULTILANG_FrmActualizar='Update initial configurations';
	$MULTILANG_FrmDetalles='Define the form details';
	$MULTILANG_FrmTitVen='Window title';
	$MULTILANG_FrmDesTit='Text that appears at the top of the window';
	$MULTILANG_FrmHlp='Help Title';
	$MULTILANG_FrmDesHlp='Text that will appear as a caption for the support of the form';
	$MULTILANG_FrmTxt='Help Text';
	$MULTILANG_FrmDesTxt='Full Text with summary function description for the form. Introductory text for any user';
	$MULTILANG_FrmImagen='Background color';
	$MULTILANG_FrmImagenDes='If your web browser has HTML5 support you could choose the background color.  If not you can type an hexadecimal color code i.e. #F2F2F2 or its name as HTML notation i.e. LightGray';
	$MULTILANG_FrmNumeroCols='Number of columns';
	$MULTILANG_FrmDesNumeroCols='Indicates how many columns to be deployed in fields when the form is loaded';
	$MULTILANG_FrmCreaDisena='Create and design';
	$MULTILANG_FrmTitForms='Forms defined in the system';
	$MULTILANG_FrmCamposAcciones='Fields and actions';
	$MULTILANG_FrmAdvDelForm='IMPORTANT: Deleting the form users can not access it again to query operations or data entry defined. You can not undo this operation. This also eliminates any internal design of the form.\n'.$MULTILANG_Confirma;
	$MULTILANG_FrmAdvScriptForm='Scripts edit (Advanced)';
	$MULTILANG_FrmHlpFunciones='All JavaScript functions defined here will be included in the form.<br>The FrmAutoRun function must be exist (even empty) cause it will be executed automatically on every form load.';
	$MULTILANG_FrmCopiar='Make a copy';
	$MULTILANG_FrmAdvCopiar='A new copy of this object will be created.  Are you sure?';
	$MULTILANG_FrmMsjCopia='Now you can go to edit your new object.  A copy was made as: ';
	$MULTILANG_FrmBordesVisibles='Are table borders visible?';
	$MULTILANG_FrmFormatoSalida='Output format';
	$MULTILANG_FrmFormatoEntrada='Input format';
	$MULTILANG_FrmPlantillaArchivo='Name template for the file';
	$MULTILANG_FrmDesPlantillaArchivo='The template is the form or pattern that will be renamed the file after the user uploaded to the server. This may include different variables to alter the name and extension thereof as examples. You can also leave it blank so that the files are loaded with the original name of the folder system loads (not recommended for security).';
	$MULTILANG_FrmErrorCargaGeneral='There was an error during the upload';
	$MULTILANG_FrmErrorCargaTamano='The file size is greater than the allowed size';
	$MULTILANG_FrmPlantillaEjemplos='<i>Some format modifiers:<li>_ORIGINAL_ : Original file name</li><li>_CAMPOTABLA_ : Linked field name over the table</li><li>_FECHA_ : Actual date in AAAAMMDD format</li><li>_HORA_ : Actual server time in  HHMMSS format</li><li>_MICRO_ : Time microseconds</li><li>_HORAINTERNET_ : Internet time between 000 and 999</li><li>_USUARIO_ : User login name</li><li>_EXTENSION_ : File extension</li></i><b>Examples:</b><li>_USUARIO__ORIGINAL_: Renames the original file with the user name login</li><li>formatos/_ORIGINAL_: Will upload the file into a formatos/ folder using the original name.  This folder have to be created by admin user before using the file manager in the cargas folder.</li><li>_FECHA__HORA__USUARIO_.pdf: Renames all the original file for something like 20140502_135400_admin.pdf</li><li>reportes/_FECHA_.xls: Will upload the file into reportes folder and will force the final extension to .xls too.</li><li>foto__USUARIO_.jpg: This file will have two fixed strings (foto_ at beginning and .jpg at the end) but inside them Practico will append the username.  Pay attention to the double underline character, one of them will separate the name and the other is for the format modifier.  You will obtain something like foto_avelez.jpg</li>A general rule: any string inside the pattern that dont match any format modifier will be a fixed string in the file name.';
	$MULTILANG_FrmArchivoLink='[Open already uploaded file]';
	$MULTILANG_FrmCanvasLink='[Open drawing already added]';
	$MULTILANG_FrmErrorCam='There is an error with the video device.  Please check that you have a video device or webcam installed and the you answer Affirmative or Accept in your browser to allow Practico to use the device.';
    $MULTILANG_FrmPestana='Forms tab title in which the control will be published';
    $MULTILANG_FrmDesPestana='Assign the tab for this object in the form.  Practico automatically creates tabs according to the values entered in each object.  If you specify a PCO_NoVisible tab the eyelash will not appear to standard users (it will be hidden) but its elements will normally be added to the form in order to process them.';
    $MULTILANG_FrmTagPersonalizado='HTML Custom Tag';
    $MULTILANG_FrmDesTagPersonalizado='Allow to add parameters to the HTML Tag created over the form by Practico. 
            <br><b>Select lists (combo-box):</b>
                <li><u>data-live-search=true</u> Enable search field in a list.</li>
                <li><u>multiple</u> Enable multiple select.</li>
                <li><u>data-selected-text-format=count</u> Count selected items instead values.</li>
                <li><u>data-max-options=#</u> Maximum of elements selected.
                <li><u>data-size=auto|#</u> How many rows are showed in the item list.</li>
                <li><u>data-style=btn-primary|btn-info|btn-success|btn-warning|btn-danger|btn-inverse</u> Graphic style
                <li><u>disabled</u> Disables the control</li>
                <li><u>PCO_Delayed</u> If this keyword is found the load of the value is charged at onready time by javascript. Usefull when you have manual items in your combobox and you need to recover its value from the database on form load.</li>
                <BR>
                <b>Buttons (command button):</b>
                <li><u>btn-group btn-group-justified</u> Expand the button to its containers width.</li>
                <BR>
                <b>Checkboxes (checkbox):</b>
                <li><u>data-toggle=toggle</u> Convert this control to toggle button</li>
                <li><u>data-on=Text</u> Set text when the control is on. It could have HTML code and even icon declarations.</li>
                <li><u>data-off=Text</u> Same that previous property when control is off</li>
                <li><u>data-onstyle=Style</u> Set the style for the button: primary|info|warning|danger|success|default</li>
                <li><u>data-offstyle=Style</u> Same that previous property when control is off</li>
                <li><u>data-style=ControlType</u> Visual appearance:  ninguno|ios|android</li>
                <li><u>data-size=Size</u> Size of the control: large|normal|small|mini</li>
                <li><u>data-width=Width</u> Width of the control in pixels</li>
                <li><u>data-height=Height</u> Height of the control in pixels</li>';
    $MULTILANG_FrmBtnFull='Load in FullScreen';
    $MULTILANG_FrmBtnObjetivo='HTML Target';
    $MULTILANG_FrmActualizaAjax='Dynamic reload';
    $MULTILANG_FrmActivarInline='<i>Inline</i> view: Work in conjunction with next and previous elements';
    $MULTILANG_FrmActivarInlineDes='Allow to put the control using an inline style to keep a new line before publish the control over the form. Acording the effect you want, previous or next element should activate this property too';
    $MULTILANG_FrmTipoCopia='Select what kind of copy do you want';
    $MULTILANG_FrmTipoCopia1='Online';
    $MULTILANG_FrmTipoCopia2='XML with current ID';
    $MULTILANG_FrmTipoCopia3='XML with dynamic ID';
    $MULTILANG_FrmTipoCopiaDes1='Online: Creates a new object with a new ID.  That includes all the components linked to allow you create new forms or reports from an existing object. This works immediately over the running system, cloning the selected object.';
    $MULTILANG_FrmTipoCopiaDes2='XML with current ID: Exports/Imports the object using XML syntax to allow you import it over other system using the current ID.  Usefull if you want to overwrite forms or reports with enhancements from other systems.';
    $MULTILANG_FrmTipoCopiaDes3='XML with dynamic ID: Exports/Imports the object using XML syntax but the new ID for the object is generated dynamically each time you import the file, with a different ID.  Useful to replicate the functionality of "Online" option but over differents systems.';
	$MULTILANG_FrmTipoCopiaExporta='Copying / Exporting';
	$MULTILANG_FrmCopiaFinalizada='The copy process already finished.  You could click on download button to get the XML file.';
	$MULTILANG_FrmImportar='Import a design from a file';
	$MULTILANG_FrmImportarConflicto='There are conflicts that you need to solve before continue with the importing process';
	$MULTILANG_FrmImportarGenerado='New object has been created';
	$MULTILANG_FrmImportarAlerta='An element with the same internal ID and type that you want to import was founded in the system.  The file that you want to import will delete  the actual object and will fill it with the elements in the file.  We recommend you to check previously if you really want to overwrite the element before continue.';
	$MULTILANG_FrmValOnCheck= 'Value when is activated';
	$MULTILANG_FrmValOffCheck='Value when is not activated';
	$MULTILANG_FrmValCheckDes='Define the value to be assigned to the field that will be stored in the database according to the control status';
	$MULTILANG_FrmEstiloPestanas='Tabs style (if applies)';
	$MULTILANG_FrmEstiloTabs='Tabs (nav-tab)';
	$MULTILANG_FrmEstiloPills='Buttons (nav-pills)';
	$MULTILANG_FrmEstiloOculto='Hidden';
	$MULTILANG_FrmTextoPlaceHolder='Placeholder text';
	$MULTILANG_FrmDesPlaceHolder='A text to show in the field when this doesnt have a value that help users to know what should enter there';
	$MULTILANG_FrmOcultarEtiqueta='Hide the field label in the form';
	$MULTILANG_FrmIdHTML='Unique HTML identifier for this object.  Is useful when you want to program events for this control using JQuery or JS on runtime';
	$MULTILANG_FrmValidaExtra='Extra characters allowed';
	$MULTILANG_FrmValidaAyuda='Any character here will be allowed for the validator';
	$MULTILANG_FrmValida9='Numbers only 0-9 (integer)';
	$MULTILANG_FrmValida10='Only charset in the extra validation field';
	$MULTILANG_FrmNombreHTML='Warning: This value is used to generate the unique identifier of the element in HTML and from it automatically generate all the events of the controls and tools linked to your form. If you change this value you may lose that specific event programming and JavaScript in general that you made prior to your change.';
    $MULTILANG_FrmClaseContenedor='CSS Class of Container';
    $MULTILANG_FrmClaseContenedorDes='It indicates whether the container of the object has some native CSS or bootstrap specifies to be applied at the time of the on-screen control.';
    $MULTILANG_FrmHuerfanos='Orphaned fields have been found (outside the visible design of the form).';
    $MULTILANG_FrmIDHTMDuplicado='Fields with HTML ID or field name in database dupicated have been found.';
    $MULTILANG_FrmCamposAProposito='These fields are there and can affect the functionality of the form in JS gions or when processing your data. If you have generated fields of this type of field on purpose then ignore this message. The fields found are:';
    $MULTILANG_FrmTipoMaquetacion='Type of layout';
    $MULTILANG_FrmTipoMaquetacionDes='Determine how Practico will make multi-column forms. Traditional: use tables and standard columns in HTML. Responsive: use columns based on bootstrap col classes, for which you must specify the class of each in the corresponding fields.';
    $MULTILANG_FrmTradicional='Traditional';
    $MULTILANG_FrmCampoHuerfano='This fields exists in the table linked to the form and doesnt have any field or object linked to them in the form or embeded forms';
    $MULTILANG_FrmDesplazarObjetos='Move down one position all the objects in the column below this element';
    $MULTILANG_FrmEstaSeguro='Are you sure?';

	//Informes
	$MULTILANG_InfErr1='You must specify values ​​for the fields corresponding to at least one data series. <br> If you dont want to generate a graph then you must change the report type to data table';
	$MULTILANG_InfErr2='You must enter a valid title for the report.';
	$MULTILANG_InfErr3='Please specify a valid name for the category associated to the report.';
	$MULTILANG_InfErrCondicion='The specified condition is invalid or lacks at least one side for comparison.';
	$MULTILANG_InfErrCampo='You must enter a valid field name for the data source of the report.';
	$MULTILANG_InfErrTabla='You must enter a valid table name for the data source of the report.';
	$MULTILANG_InfErr4='You must enter a valid title, label or image for the button.';
	$MULTILANG_InfErr5='You must enter a valid action to be executed when control is activated.';
	$MULTILANG_InfAgregaTabla='Add a new table to the report';
	$MULTILANG_InfTablaManual='Enter a table manually';
	$MULTILANG_InfDesTablaManual='If you dont want to select a table from top list, you could type here a table name.  This option is useful when you need to access information in internal tables of Practico or tables created by other applications';
	$MULTILANG_InfAliasManual='Specify an alias manually';
	$MULTILANG_InfDesAliasManual='Useful to define the name of a table generated from a sub query or manually specified';
	$MULTILANG_InfBtnAgregaTabla='Add Table';
	$MULTILANG_InfTablasDef='Tables defined in this report';
	$MULTILANG_InfAlias='Alias';
	$MULTILANG_InfAdvBorrado='IMPORTANT: If you delete the selected object the query or report could be inconsistent.\n'.$MULTILANG_Confirma;
	$MULTILANG_InfAgregaCampo='Add a new field to the report';
	$MULTILANG_InfCampoDatos='Data Field';
	$MULTILANG_InfCampoManual='Specify a field manually';
	$MULTILANG_InfDesCampoManual='If you dont want to select a field from top list you could type here a field name.  This option is useful when you need to access information in Practico internal fields or fields created by other applications';
	$MULTILANG_InfDesAliasManual2='Useful to define the name of a field generated manually or a grouped sub query';
	$MULTILANG_InfBtnAgregaCampo='Add Field';
	$MULTILANG_InfCamposDef='Fields defined in this report';
	$MULTILANG_InfAddCondicion='Add a new condition to the report';
	$MULTILANG_InfPrimer='First field or value';
	$MULTILANG_InfOperador='Comparison operator';
	$MULTILANG_InfSegundo='Second field or value';
	$MULTILANG_InfMayorQue='Greater than ';
	$MULTILANG_InfMenorQue='Less than';
	$MULTILANG_InfMayorIgualQue='Greater than or equal';
	$MULTILANG_InfMenorIgualQue='Less than or equal';
	$MULTILANG_InfDiferenteDe='Different';
	$MULTILANG_InfIgualA='Equal';
    $MULTILANG_InfPatron='Match pattern (Uses % as joker)';
	$MULTILANG_InfDesManual='In any manual fields you can enclose expressions or character string values ​​using double quotes.   You can compare with session vars putting the PHP variable.  i.e.: $PCOSESS_LoginUsuario, $Nombre_usuario, $Descripcion_usuario, $Nivel_usuario, $Correo_usuario, $LlaveDePasoUsuario.  If you want to use PHP variables in the middle of a string you can put it inside braces Ie: {$Variable} and they will be replaced by their global value.';
	$MULTILANG_InfOperador='Add an aggregator of expressions or a logical operator ';
	$MULTILANG_InfOpParentesisA='Parenthesis open';
	$MULTILANG_InfOpParentesisC='Parenthesis close';
	$MULTILANG_InfOpAND='AND logical';
	$MULTILANG_InfOpOR='OR logical';
	$MULTILANG_InfOpNOT='NOT';
	$MULTILANG_InfOpXOR='XOR';
	$MULTILANG_InfTitOp='When to use this option?';
	$MULTILANG_InfDesOp='If you require more than one sentence to add to its status filtering group results or require several conditions to take precedence over some operations then you can use this option. Works independently and must be added as a separate record of the consultation';
	$MULTILANG_InfReco1='Advice';
	$MULTILANG_InfReco2='Do not forget to add ANDs followed each condition linking foreign keys between different tables of the report where applicable (usually when you use more than one table).';
	$MULTILANG_InfBtnAddCondic='Add condition / operator';
	$MULTILANG_InfDefCond='Filter and conditions defined in this report';
	$MULTILANG_InfTitGrafico='Specifies types of charts to be generated by the report';
	$MULTILANG_InfSeriesGrafico1='SERIES FOR THE CHART';
	$MULTILANG_InfSeriesGrafico2='Multiple series charts must return the same number of labels';
	$MULTILANG_InfNomSerie='Series Name';
	$MULTILANG_InfCampoEtiqSerie='Label Field (X axis)';
	$MULTILANG_InfCampoValor='Value field (must be numeric)';
	$MULTILANG_InfVistaGrafico1='APPEARANCE and DISTRIBUTION';
	$MULTILANG_InfVistaGrafico2='Select according to the number of desired series';
	$MULTILANG_InfTipoGrafico='Chart type';
	$MULTILANG_InfGrafico1='Area';
	$MULTILANG_InfGrafico3='Line';
	$MULTILANG_InfGrafico5='Bar';
	$MULTILANG_InfGrafico7='Donut (only one series)';
	$MULTILANG_InfActGraf='Update chart format';
	$MULTILANG_InfAgrupa='Sorting and grouping';
	$MULTILANG_InfReco3='Use only fields defined in your query.';
	$MULTILANG_InfCriterioAgrupa='Grouping criteria';
	$MULTILANG_InfCriterioOrdena='Ordering criteria';
	$MULTILANG_InfTitAgrupa='How the results will be grouped?';
	$MULTILANG_InfDesAgrupa='Use this option only if your report handles operations such as sum, average or count within the fields displayed. Eg SUM (field), AVG (field), COUNT (*). In that cases enter which fields (separated by comma) should group the results';
	$MULTILANG_InfTitOrdena='How the results will be sorted?';
	$MULTILANG_InfDesOrdena='To sort the results using any of the fields added. Fields must be separated by commas to sort your results, if you wish after each field can use the modifier ASC or DESC to indicate whether ascendant or descending';
	$MULTILANG_InfActCriterios='Reload sorting and grouping criteria';
	$MULTILANG_InfTitBotones='Add buttons or actions to each record';
	$MULTILANG_InfDelReg='Delete Record';
	$MULTILANG_InfCargaForm='Load a form by ID';
	$MULTILANG_InfHlpAccion='If you want to load a form use this syntax  ID:1:FieldForSearch<br>If you want to load a report use this syntax  ID:1<br>To delete the associated record type the table.field used to compare it.';
	$MULTILANG_InfVinculo='Linked field';
	$MULTILANG_InfDesVinculo='IMPORTANT: We assume the first field or column as a single and primary key value<br>
				to do removal or form opening operations.<br>
				It is recommended to use fields that has a really single value<br>
				unless you are wishing group operations.';
	$MULTILANG_InfDesPeso='Position on the button that appears within the set on the right side of each record. Order from left to right.';
	$MULTILANG_InfFiltrar='Filter results by specific conditions';
	$MULTILANG_InfCampoAgrupa='Let you grouping Sets fields for reporting operations sum, average or count and fields for the ordering of results';
	$MULTILANG_InfTablasOrigen='Source data tables';
	$MULTILANG_InfCamposOrigen='Data Fields';
	$MULTILANG_InfCondiciones='Conditions';
	$MULTILANG_InfPropGraf='Chart Properties';
	$MULTILANG_InfDesGraf='Defines the properties and appearance of the chart displayed by the report';
	$MULTILANG_InfDesAccion='Defines actions that can be performed on each record displayed by the report as Delete, Open a form, user functions, etc..';
	$MULTILANG_InfVolver='Back to list of reports';
	$MULTILANG_InfTitulo='Title of the report or chart';
	$MULTILANG_InfDesTitulo='Text that appears at the top of the generated report';
	$MULTILANG_InfDescripcion='Description';
	$MULTILANG_InfDesDescrip='Descriptive text of the report. Not in his generation but is used to guide the user in his selection';
	$MULTILANG_InfCategoria='Category';
	$MULTILANG_InfDesCateg='When the user accesses the system panel reports these are classified by categories. Enter here a category name under which you want to publish this report to the users.';
	$MULTILANG_InfNivelUsuario='User Level';
	$MULTILANG_InfTodoUsuario='All users';
	$MULTILANG_InfParam='Edit general settings of the report';
	$MULTILANG_InfTitNivel='Who can see this report?';
	$MULTILANG_InfDesNivel='Specify the user profile must be to see this report as available.';
	$MULTILANG_InfAlto='Height';
	$MULTILANG_InfTitAncho='Set fixed width?';
	$MULTILANG_InfDesAncho='This value also applies if you have specified a Height value. If you require the report to appear within a specified fixed width size in pixels, leave blank to be deployed data without size restrictions. In the case of chart image specifies its size.';
	$MULTILANG_InfTitAlto='Set fixed height?';
	$MULTILANG_InfDesAlto='This value also applies if you have specified a Width value. If you require the report to appear within a specified fixed width size in pixels, leave blank to be deployed data without size restrictions. In the case of chart image specifies its size.';
	$MULTILANG_InfHlpAnchoalto='Add a <b>px</b> or <b>%</b> as you need';
	$MULTILANG_InfFormato='Final format';
	$MULTILANG_InfTitFormato='How this report is displayed?';
	$MULTILANG_InfDesFormato='Indicates whether the final product will be a report of the data table or a chart.';
	$MULTILANG_InfActualizar='Refresh Report';
	$MULTILANG_InfVistaPrev='Report Preview';
	$MULTILANG_InfCargaPrev='Load preview';
	$MULTILANG_InfHlpCarga='This option will close the design mode and will show you the report as it will be displayed to a user of the application';
	$MULTILANG_InfErrInforme1='You must enter a valid title for the report.';
	$MULTILANG_InfErrInforme2='Please specify a valid name for the category associated with report.';
	$MULTILANG_InfTituloAgr='Add new report or chart';
	$MULTILANG_InfDetalles='Define the details of the report / chart';
	$MULTILANG_InfDefinidos='Reports / charts already defined in the system';
	$MULTILANG_InfcamTabCond='Fields, Tables and Conditions';
	$MULTILANG_InfAdvEliminar='IMPORTANT: Deleting this report users can not access it again. You can not undo this operation. This also eliminates any internal design of the report.\n'.$MULTILANG_Confirma;
	$MULTILANG_InfErrTamano='The report you are trying to generate is a graph type  report but the designer did not specify the height and width of the resulting graph.<br>Should provide an valid size of graphic to generate an image.';
	$MULTILANG_InfGeneraPDF='Allow native export for this report?';
	$MULTILANG_InfGeneraPDFInfoTit='Available for tabular reports only';
	$MULTILANG_InfGeneraPDFInfoDesc='This option requires php_xml and php_zip extensions if you want to export LibreOffice, OpenOffice or Office 2007 files.  If you activate this option the report time could be more than a normal report when you have a lot of records in your results because user will launch the query to see the records on screen, and then launch the same query if he wants to export them.  OTHER WAYS TO EXPORT ARE AVAILABLE ACTIVATING THE DATATABLE SUPPORT FOR THIS REPORT.';
    $MULTILANG_InfVblesFiltro='Global variables required for filter';
    $MULTILANG_InfVblesDesFiltro='PHP variables (without dollar character $ and comma separated only) that should be taked from global environment to be available for filter in the condittions option while you build a query';
    $MULTILANG_InfDataTableResXPag='records per page';
    $MULTILANG_InfDataTableViendoP='Viewing page';
    $MULTILANG_InfDataTableDe='of';
    $MULTILANG_InfDataTableFiltradoDe='Filtered from';
    $MULTILANG_InfDataTableRegTotal='total records';
    $MULTILANG_InfDataTableNoDatos='No data available in table';
    $MULTILANG_InfDataTableNoRegistros='There is no records that match search criteria';
    $MULTILANG_InfDataTableNoRegistrosDisponibles='No records available';
    $MULTILANG_InfDataTableTit='DataTables support?';
    $MULTILANG_InfDataTableDes='Allow to transform the report in a DataTable to filter, search, sort and get pages of results dynamically';
    $MULTILANG_InfFormFiltrado='Form with Filter variables';
    $MULTILANG_InfFormFiltradoDes='Select a form designed to enter the filter variables for the report.  This help you to link a form that ask users for some data before to load the report.';
    $MULTILANG_InfRetornoFormFiltrado='See filtered report';
    $MULTILANG_InfAutoajusteAncho='Auto-width for generated cells';
    $MULTILANG_InfBordesCelda='Draw cell border';
    $MULTILANG_InfBordesTodos='All sides';
    $MULTILANG_InfBordesArriba='Top only';
    $MULTILANG_InfBordesAbajo='Bottom only';
    $MULTILANG_InfBordesArrAba='Top and Bottom';
    $MULTILANG_InfBordesIzq='Left side only';
    $MULTILANG_InfBordesDer='Right side only';
    $MULTILANG_InfBordesIzqDer='Left and right sides';
	$MULTILANG_OrientacionPagina='Page layout';
	$MULTILANG_InfTamanoPapel='Paper size';
	$MULTILANG_InfReducir='Auto-size content';
	$MULTILANG_InfTitPersonalizar='Custom presentation and layout (optional)';
	$MULTILANG_InfEjecutarAccionEn='Run this action in';
	$MULTILANG_InfPrecargarEstilos='Preload Bootstrap CSS style sheets';
	$MULTILANG_BtnEstiloSimple='Simple button, plain style';
	$MULTILANG_BtnEstiloPredeterminado='Default style';
	$MULTILANG_BtnEstiloPrimario='Primary style';
	$MULTILANG_BtnEstiloFinalizado='Success style';
	$MULTILANG_BtnEstiloInformacion='Information style';
	$MULTILANG_BtnEstiloAdvertencia='Warning style';
	$MULTILANG_BtnEstiloPeligro='Danger style';
	$MULTILANG_InfEditableLinea='Online editable';
	$MULTILANG_InfPaginacionDatatable='Page size for DataTables';
	$MULTILANG_InfPaginacionDatatableDes='Tells Practico how many records should it show in default view of a datatable';
	$MULTILANG_InfCargaInforme='Load a report by ID';
	$MULTILANG_InfSubtotalesColumna='AutoSum column';
	$MULTILANG_InfSubtotalesColumnaDes='Tells Practico which is the column number to be used for the autosum in each page.  LEAVE IT IN BLANK TO AVOID ANY CALCULATION.';
	$MULTILANG_InfSubtotalesFormato='AutoSum format';
	$MULTILANG_InfSubtotalesFormatoDes='Tells Practico what is the output format for the autosum results.  <b>This allow basic HTML and templates</b> Example: _TOTAL_PAGINA_ show the total for the actual page, _TOTAL_INFORME_ shows the total of all report, _COLUMNA_ show the column number used for totalize values.  For example this HTML code shows the results centered and in bold: < div align=center>< b>Total page < i>(column: _COLUMNA_)< /i> _TOTAL_PAGINA_ Total report: _TOTAL_INFORME_< /b>< /div>';
	$MULTILANG_InfTituloArbitrario='Arbitrary title';
	$MULTILANG_InfTituloArbitrarioDes='Allows you to ignore the column title delivered by the database engine and instead use this value as a title in the submitted report. <b> Allows basic HTML and PHP variables </b>';
	$MULTILANG_InfSQL='If you add any content greater than 5 characters to this SQL script field, the report generator will omit any configuration of tables, fields, conditions or any other query definition that you have defined and will try to directly execute this Script and from it generate the results table. You can use PHP variables in notation {$ Variable} to include environment variables.';
	$MULTILANG_InfFormsUsan='Detected forms that use this report in an embedded manner';
	$MULTILANG_InfTootipTitulo='Create a tooltip for graphic reports using the reports title';
    $MULTILANG_InfBotonPpio='Put in the first column';
    $MULTILANG_ExportaDT=' client side export tools?';
    $MULTILANG_ExportaDTDes='Allow to enable some options to this report to export its data in different formats.  The process will take only the data filtered by the user in the data table.';
    $MULTILANG_InfEncabezado='Rich text for the header';
    $MULTILANG_InfEncabezadoDes='In this field you can enter any rich text, links, images or another elements that will be used in the top of the report as a header or title';
    $MULTILANG_InfSinDatos='There is no data for this graph';
    $MULTILANG_InfTablaResponsive='Use a responsive layout';
    $MULTILANG_InfTablaResponsiveDes='Allow to draw a table in a 100% responsive format hidding the columns that overflow the content and converting them to a new child row.  Important: This mode disable any footer section for the table.';
    $MULTILANG_InfEnHome='Direct publishing for authorized users';
    $MULTILANG_InfBarraSuperior='Over the navigation bar alerts';

	//Menus
	$MULTILANG_MnuTitEditar='Edit menu item';
	$MULTILANG_MnuSelImagen='Click on an image to select';
	$MULTILANG_MnuPropiedad='Item properties';
	$MULTILANG_MnuApariencia='APPEARANCE AND LOCATION CONFIGURATION';
	$MULTILANG_MnuTexto='Text';
	$MULTILANG_MnuPadre='Father';
	$MULTILANG_MnuSiAplica='If applies';
	$MULTILANG_MnuUbicacion='Location of this option';
	$MULTILANG_MnuArriba='TopMenu Possible?';
	$MULTILANG_MnuEscritorio='Desktop Possible?';
	$MULTILANG_MnuCentro='Middle Possible?';
    $MULTILANG_MnuIzquierda='Sidebar Possible?';
	$MULTILANG_MnuSeccion='Section';
	$MULTILANG_MnuDesArriba='You must enable this option to be displayed in the top menu-bar horizontally?';
	$MULTILANG_MnuDesEscritorio='You must enable this option to be displayed as an icon on the users desktop?';
	$MULTILANG_MnuDesCentro='You must enable this option to be deployed in the central part of the application, within windows classified / grouped by the value defined in the Section field?';
	$MULTILANG_MnuDesIzquierdo='You must enable this option to be deployed in the side bar of the application';
    $MULTILANG_MnuDesImagen='Display a list of images available on the system';
	$MULTILANG_MnuComandos='CONFIGURATION COMMANDS AND ACTIONS';
	$MULTILANG_MnuClic='Possible to click?';
	$MULTILANG_MnuURL='Static URL or commando in format javascript:command()';
	$MULTILANG_MnuTitURL='Bring to a URL or execute a javascript?';
	$MULTILANG_MnuDesURL='Enter full URL or a command defined javascript javascript: command to be replaced within an anchor HREF generated around the object. If you need to pass string parameters to javascript commands you could use single cuotes';
	$MULTILANG_MnuTipo='Command type';
	$MULTILANG_MnuInterno='Internal';
	$MULTILANG_MnuPersonal='Personal';
	$MULTILANG_MnuObjeto='Object';
	$MULTILANG_MnuAccion='Internal action / command / object';
	$MULTILANG_MnuTitAccion='Type one of three possible values ​​as follows:';
	$MULTILANG_MnuDesAccion='1) AN OBJECT in Practico that you want to link to this menu option using this syntax frm:XXX  or  inf:XXX  where you should replace XXX with the object ID (ID form or ID for the report),  2) INTERNAL ACTION in Practico where you want to redirect the user (you can see in Practicos footer as admin), or 3) CUSTOM COMMAND: A command secuence defined by the user, this secuence should exists in personalizadas.php file or any other module installed.';
	$MULTILANG_MnuTitNivel='Who can see this option?';
	$MULTILANG_MnuDesNivel='Specify the user profile must be to see this option available.';
	$MULTILANG_MnuActualiza='Reload menu';
	$MULTILANG_MnuErr='It requires at least the text field.';
	$MULTILANG_MnuAdmin='Main menu administration';
	$MULTILANG_MnuAgregar='Add menu option';
	$MULTILANG_MnuDefinidos='Sections and menu commands defined';
	$MULTILANG_MnuNivel='Level';
	$MULTILANG_MnuComando='Command';
	$MULTILANG_MnuAdvElimina='IMPORTANT: Deleting this registry you could unlink some system options.\n'.$MULTILANG_Confirma;
	$MULTILANG_MnuHlpComandoInf='Maybe you want to add to the command this srtring <b>:htm:Informes</b>  to say Practico <br>that puts all the data in Html format and with that CSS style sheet';
	$MULTILANG_MnuHlpAwesome='You can use the same syntax used for menu icons';
    $MULTILANG_MnuTgtBlank='New window or tab';
    $MULTILANG_MnuTgtSelf='Same window or frame that it was clicked';
    $MULTILANG_MnuTgtParent='Parent frame or window';
    $MULTILANG_MnuTgtTop='Full body of the window';
    $MULTILANG_MnuTgt='Target (Only options using an URL or JavaScript command)';
    $MULTILANG_ImagenMenu='Image: Select an icon or enter a relative path';

	//Objetos, seguridad y otros
	$MULTILANG_ObjError='The type of object received in this command is unknown';
	$MULTILANG_SecErrorTit='Commands & reports security control';
	$MULTILANG_SecErrorDes='You have attempted to execute a function, command or report for which you are unauthorized.<br>System will be taking an audit log:';
	
	//Tablas
	$MULTILANG_TblError1='Design integrity problem';
	$MULTILANG_TblError2='DATABASE ERROR';
	$MULTILANG_TblError3='During the execution engine has returned the following message';
	$MULTILANG_TblAgrCampo='Add fields in the data table';
	$MULTILANG_TblAgrCampoTabla='Add a field to the table';
	$MULTILANG_TblEntero='Integer';
	$MULTILANG_TblCadena='String (Max length 255)';
	$MULTILANG_TblTexto='Text (Unlimited)';
	$MULTILANG_TblFecha='Date (without time)';
	$MULTILANG_TblTitNombre='Format help for field name';
	$MULTILANG_TblDesNombre='Field name without dashes, dots, spaces or special characters';
	$MULTILANG_TblLongitud='Length';
	$MULTILANG_TblAutoinc='Autoincrement';
	$MULTILANG_TblDesLongitud='This field may be mandatory depending on the type of data to be stored, such as type String fields';
	$MULTILANG_TblDesLongitud2='Format: If you ever need to put a backslash (backslash) or a single quote between these values​​, always place an additional backslash (backslash). For enum fields or set, use the format: \'a\',\'b\',\'c\'...';
	$MULTILANG_TblTitAutoinc='Primary key alert';
	$MULTILANG_TblDesAutoinc='This value can be defined only by advanced administrators who have been removed for some reason the default autoincrement ID field';
	$MULTILANG_TblNulos='Allow null value?';
	$MULTILANG_TblDefUsuario='User-defined';
	$MULTILANG_TblNulo='Null';
	$MULTILANG_TblFechaHora='Current date';
	$MULTILANG_TblDesPredet='Format: Only one value, unescaped. For strings use single quotation marks at the beginning and end';
	$MULTILANG_TblAgregando='Add the field';
	$MULTILANG_TblCamposDef='Fields already defined in the table';
	$MULTILANG_TblTipoClave='Key type';
	$MULTILANG_TblNoElim='Cant be eliminated';
	$MULTILANG_TblAdvDelCampo='IMPORTANT: Deleting the selected column of the table are also deleted all data stored in it then you can not undo this operation.\n'.$MULTILANG_Confirma;
	$MULTILANG_TblErrDel1='Error removing the table!';
	$MULTILANG_TblErrDel2='The specified table can not be deleted. Some common causes are: <br> <li> is used by any of the automated forms or reports, in that case you can try editing. <br> <li> The table has relationships defined by the designer to other data tables. <br> <li> user role defined for the active session can not delete objects in Practico';
	$MULTILANG_TblErrCrear='Please specify a valid name for the table. This must not contain dashes, dots, spaces or special characters';
	$MULTILANG_TblCrearListar='Create / List data tables defined in the system';
	$MULTILANG_TblCreaTabla='Create a new table in the database';
	$MULTILANG_TblDesTabla='A data table is a structure that allows you to store information. Enter in this field the name of the table without dashes, dots, spaces or special characters. CAPS SENSITIVE';
	$MULTILANG_TblCreaTabCampos='Create table and define fields';
	$MULTILANG_TblTitAsis='Use Wizard?';
	$MULTILANG_TblDesAsis='Lets you select from some predefined common tables';
	$MULTILANG_TblTablasBD='Tables defined in the database';
	$MULTILANG_TblRegistros='Records';
	$MULTILANG_TblAdvDelTabla='IMPORTANT: Deleting the data table are also deleted all the records stored in it then you can not undo this operation.\n'.$MULTILANG_Confirma;
	$MULTILANG_TblErrPlantilla='You must select a template from which you want to create your new table';
	$MULTILANG_TblAsistente='Table Generation Wizard';
	$MULTILANG_TblAsistNombre='Name for the new table';
	$MULTILANG_TblAsistPlant='Template selected';
	$MULTILANG_TblAsCampos='Fields containing';
	$MULTILANG_TblTotCampos='Total fields';
	$MULTILANG_TblHlpAsist='All tables and fields can be personalized in the next step, <br> adding, removing or changing the properties of those that you want.';
    $MULTILANG_TblTipoCopia1='Structure only (CREATE Sentence)';
    $MULTILANG_TblTipoCopia2='Data (INSERT Sentences)';
    $MULTILANG_TblTipoCopia3='Structure and Data (CREATE and INSERT sentences)';
    $MULTILANG_TblImportar='Import from file';
    $MULTILANG_TblImportarSQL='Upload a compressed SQL script';
    $MULTILANG_TblSQLConsejo='If you execute the SQL sentences of this file you could be erasing, creating or overwriting tables and many other information, even designs and other things the you exported in that records. <br><br><b>We recomend you that make a backup before continue.</b>';
    $MULTILANG_TblEjecutarSQL='Run SQL sentences in this file (could take some time)';
    $MULTILANG_TblDecodificarActual='Collation or charset for the actual records or data table';
    $MULTILANG_TblCodificar='ENCODE records before save them to the backup file using';
    $MULTILANG_TblCodificacionNINGUNO='NONE, Use the original table collation or charset';
    $MULTILANG_TblTransliteracion='Use character transliteration';
    $MULTILANG_TblTransliteracionHlp='If transliteration is activated when a character cant be represented in the target charset, it can be approximated through one or several similarly looking characters. If you decide to ignore then invalid characters will be omited, Otherwise the string is truncated and, E_NOTICE is generated and the function will return FALSE.';
    $MULTILANG_TblTranslit='Translitering';
    $MULTILANG_TblIgnora='Ignoring';
    $MULTILANG_TblAnaliza='Analyze tables';
    $MULTILANG_TblReparar='Repair tables';
    $MULTILANG_TblOptimizar='Optimize tables';
    $MULTILANG_TblVaciar='Empty';
    $MULTILANG_TblVaciarAdv='This action will delete all records in this table, are you sure?';
    $MULTILANG_TblImportarXLS='Upload from spreadsheet';
    $MULTILANG_TblXLSConsejo='Loading and match fields in a spreadsheet file with your current database you might be deleting, creating or overwriting tables, records and other related information, as well as designs and other elements contained in the associated records. <br><br><b>It is recommended that you make a backup prior to this process before continuing.</b><br><br>The first row of the spreadsheet should contain as headings the exact name of the field in the table on which you want to import values.';
    $MULTILANG_TblTablaImportacion='Please select the table on which you want to import data';
    $MULTILANG_TblCorrespondencia='Correspondence between table fields and columns of file';
    $MULTILANG_TblApareaMsg='Check the fields on the left side of the table and matched by their name from the selection list column. If necessary make the pairings manuals preview according to existing columns in the file at the top. <br> <br> unpaired Fields will be ignored and filled with the default value is taken into the engine';
	$MULTILANG_TblPoliticaImportacion='<b>What to do if a record that is being imported already exists?:</b><br>Specify how you want it to be processed each duplicate record in the system in case when trying to import already in the database.';
	$MULTILANG_TblIgnorarRegistro='Ignore the record';
	
	//Usuarios
	$MULTILANG_UsrCopia='Permissions copy completed. Please check below.';
	$MULTILANG_UsrDesPW='Passwords with minimum safety conditions should have a length of <b>at least 8 characters</b>, numbers, uppercase and lowercase symbols such as <font color=blue>$ * </font>. To have your password is considered safe by this system <b> must meet at least one security level of 81%</b>';
	$MULTILANG_UsrCambioPW='Change Password';
	$MULTILANG_UsrAnteriorPW='Old Password';
	$MULTILANG_UsrNuevoPW='New password';
	$MULTILANG_UsrNivelPW='Security level';
	$MULTILANG_UsrVerificaPW='Verify Password';
	$MULTILANG_UsrHlpNoPW='The authentication engine is defined for the external type tool.<br>
				The password change and user profile updates are disabled as it should be managed centrally for you in the tool defined by your system administrator';
	$MULTILANG_UsrErrPW1='You forgot to enter any of the requested data';
	$MULTILANG_UsrErrPW2='You have entered two different passwords';
	$MULTILANG_UsrErrPW3='The key for you entered does not meet the minimum safety recommendations';
	$MULTILANG_UsrErrPW4='The actual password doesnt match with the password registered in the system.  For security reasons your password wont change until you enter your actual password as verification.';
	$MULTILANG_UsrErrInf='The user already has the selected permission';
	$MULTILANG_UsrAdmInf='User reports Administration';
	$MULTILANG_UsrAgreInf='Add a report to the user menu';
	$MULTILANG_UsrInfDisp='Available Reports';
	$MULTILANG_UsrAdvDel='IMPORTANT: Deleting the registry can be no link some system options for this user.\n'.$MULTILANG_Confirma;
	$MULTILANG_UsrAdmPer='User Rights Management';
	$MULTILANG_UsrCopiaPer='Initially make a permissions copy from the user';
	$MULTILANG_UsrDelPer='Only delete permissions';
	$MULTILANG_UsrAgreOpc='Add option to the user menu';
	$MULTILANG_UsrSecc='Sections already available';
	$MULTILANG_UsrErrCrea1='The user entered already exists, please check or change the login entered for the account and try again';
	$MULTILANG_UsrErrCrea2='You forgot to enter any of the requested data as required';
	$MULTILANG_UsrErrCrea3='The password entered must be at least six characters';
	$MULTILANG_UsrAdicion='Adding users';
	$MULTILANG_UsrLogin='NickName / Login';
	$MULTILANG_UsrDesLogin='Unique login to identify the user in the system. CAPS SENSITIVE';
	$MULTILANG_UsrNombre='Full name';
	$MULTILANG_UsrTitCorreo='Address for alerts and notifications';
	$MULTILANG_UsrDesCorreo='E-mail of possible use for automatic notifications system in some modules';
	$MULTILANG_UsrEstado='Initial state';
	$MULTILANG_UsrNivel='Access level';
	$MULTILANG_UsrInterno='Internal user?';
	$MULTILANG_UsrDesInterno='An internal user is for people who work inside the company that deploy the ERP or system.  An external user is for example for people that is from a customer or another company that login to the system';
	$MULTILANG_UsrTitNivel='Initial safety profile';
	$MULTILANG_UsrDesNivel='Users security profile. CAUTION: This option is different to individual user permissions defined by the designer for the created objects. This page only applies to the internal operations of Practico';
	$MULTILANG_UsrAudit1='Tracking operations';
	$MULTILANG_UsrAudDes='Details of the action';
	$MULTILANG_UsrAudUsrs='Monitoring transactions for all users';
	$MULTILANG_UsrAudAccion='With the ACTION';
	$MULTILANG_UsrAudUsuario='for the <b>user</b>';
	$MULTILANG_UsrAudDesde='From (Day / Month)';
	$MULTILANG_UsrAudHasta='to';
	$MULTILANG_UsrAudAno='Referring year audit';
	$MULTILANG_UsrAudIniReg='Start on record';
	$MULTILANG_UsrAudVisual='Viewing';
	$MULTILANG_UsrAudMonit='Monitoring mode';
	$MULTILANG_UsrAudHisto='History of user operations (from most recent to oldest)';
	$MULTILANG_UsrLista='List of users in the system';
	$MULTILANG_UsrLisNombre='See only users whose NAME contains';
	$MULTILANG_UsrLisLogin='See only users whose LOGIN contains';
	$MULTILANG_UsrFiltro='Due to the number of registered users you should filter the output.<br>
				Enter the desired filter type at the top and click the corresponding button.';
	$MULTILANG_UsrAcceso='Last access';
	$MULTILANG_UsrAdvSupr='IMPORTANT: You are going to delete the user and lose links to records associated with this, this action can not be recovered unless you recreate the user with the same credentials later.\n'.$MULTILANG_Confirma;
	$MULTILANG_UsrAddMenu='Add Menus';
	$MULTILANG_UsrAddInfo='Add Reports';
	$MULTILANG_UsrAuditoria='Audit';
	$MULTILANG_UsrAgregar='Add a User';
	$MULTILANG_UsrVerAudit='View user audit';
	$MULTILANG_UsrReset='Password reset';
    $MULTILANG_UsrOlvideClave='I forgot my password';
    $MULTILANG_UsrOlvideUsuario='I forgot my username';
    $MULTILANG_UsrIngreseUsuario='Type your username';
    $MULTILANG_UsrIngreseCorreo='Type the registered email';
    $MULTILANG_UsrResetAdmin='If you dont have a successfull access to the system after a password restore you can write to your system administrator who could reset your password for you..';
    $MULTILANG_UsrAsuntoReset='Access reset';
    $MULTILANG_UsrMensajeReset='An email with the information for the user and keys restoration was sent.  Remember to check your email in your inbox and spam folder to see the instructions.<br><br>Any link to reset your password will expire at the next day or when that link is succefully used.<hr>The subjet for the email will be something like : <b>['.$NombreRAD.'] '.$MULTILANG_UsrAsuntoReset.'</b>';
    $MULTILANG_UsrErrorReset='The information entered for the password reset process was invalid, the username or email entered doesnt exists in the system.  Check the data and try again.';
    $MULTILANG_UsrResetLink='Follow this link to restore your password';
    $MULTILANG_UsrResetCuenta='Message sent to';
    $MULTILANG_UsrResetOK='Password restored. Please try to login again';
    $MULTILANG_UsrPerfil='User profile';
    $MULTILANG_UsrActualizarAdmin='Your settings says that you should change your profile to update the email address for the admin user.<br>Please go to the upper user menu and Clic over Super user or user name option to change it.';
    $MULTILANG_UsrCreacionOK='The account user was added.  Now is filtered to add any menu option or report that you need.  You could cancel this operation if is not necessary to assign right at this moment.';
    $MULTILANG_UsrSaltarInformes='Jump to REPORT rights for this user';
    $MULTILANG_UsrSaltarMenues='Jump to MENU rights for this user';
    $MULTILANG_UsrEsPlantilla='Use this as a template user permissions for others?';
    $MULTILANG_UsrEsPlantillaDes='Menu rigths and reports assigned to this user will be automatically copied during each entry to persons using it as a template. This allows you to maintain user profiles updated according to general templates.  Remember: template users cannot login into the system.';
    $MULTILANG_UsrPlantillaAplicar='Template permissions to apply to each entry';
    $MULTILANG_UsrPlantillaAplicarDes='The permissions assigned to the user selected in the list they will be transferred to this new user each to make an income';
    $MULTILANG_UsrPermisoManual='Manual rights';
    $MULTILANG_UsrDesClaveACorreo='Please check that the email account is correct.  This account will be verified because in that account we will send you a random password to access the system.';
    $MULTILANG_UsrFinRegistro='Your sign up process was finished succesfully.  Please check your mail inbox where you find a welcome message with a random password to access the system.<br><br>Important: Remember to check your SPAM folder too if you dont see any message in your standar inbox.';

	//Proceso de instalacion
	$MULTILANG_Instalacion='Installation Process';
	$MULTILANG_SubtituloPractico1='WEB Application Generator';
	$MULTILANG_SubtituloPractico2='Free and cross-platform';
	$MULTILANG_InstaladorAplicacion='Application installer';
	$MULTILANG_BienvenidaInstalacion='Welcome to the installation process';
	$MULTILANG_BienvenidaDescripcion='This wizard will guide you every step of the initial configurations to use Practico as a visual environment for web application development';
	$MULTILANG_ResumenLicencia='This tool is released under GNU-GPL v2';
	$MULTILANG_AmpliacionLicencia='An online copy of this license can be found in different formats and languages ​​in the <a href="http://www.gnu.org/licenses/gpl-2.0.html">GNU website</a>';
	$MULTILANG_ChequeoPreprocesador='Checking preprocessor settings';
	$MULTILANG_VistaPreprocesador='A view of your PHP configuration is available in <b> <a target="_blank" href="paso_i.php">[this link]</a>';
	$MULTILANG_CumplirRequisitos='Must meet the following';
	$MULTILANG_CumplirPDO='PDO extension enabled';
	$MULTILANG_CumplirDrivers='PDO Driver for the type of engine of your target database';
	$MULTILANG_CumplirGD='GD Extension 2 + handling of graphics and support for FreeType 2 +.<li>SimpleXML extension.<li>POSIX extension';
	$MULTILANG_ChequeoDirectorios1='Checking directories';
	$MULTILANG_ChequeoDirectorios2='The following files and directories must have write permissions for the application to operate correctly';
	$MULTILANG_ErrorEscritura='<b> found errors when trying to write to the installation directories! </b>: <br> rule path must belong to the user running webserver Practical scripts (usually apache <br> www, www-data or similar) and have 755 permissions for folders and 644 case for. <br> A quick way to update these permissions can be run from the root of the Practical commands: <li> find. -type d-exec chmod 755 {} \; (change all folder permissions) <li> find. -type f-exec chmod 644 {} \; (change all file permissions) <li> chown-R www-data * (assuming that www-data is the user who runs the web service)';
	$MULTILANG_ProbarNuevamente='Test again';
	$MULTILANG_ConfiguracionDescripcion='Specify the desired settings to store user applications and information generated by Practical as well as other important options of the tool. This window will be presented only once so be sure to fill out and confirm all required information';
	$MULTILANG_PuertoNoPredeterminado='(if not the default)';
	$MULTILANG_AyudaTitMotor='MySQL and MariaDB';
	$MULTILANG_AyudaDesMotor='Engines are official. Above them is the development and testing of the tool, but thanks to PDO you can use the tool in other engines you may need to make adjustments to these specific operations.';
	$MULTILANG_AyudaTitBD='The database must already exist';
	$MULTILANG_AyudaDesBD='For different engines you must have created SQLite database first. For SQLite only required to specify the file name associated with BD (eg practico.sqlite3) and Practico will try to create for you the file if you have the appropriate permissions on your web server.';
	$MULTILANG_PrefijoCore='Pr&aacute;ctico internal tables prefix';
	$MULTILANG_PrefijoApp='Application tables prefix';
	$MULTILANG_AyudaTitPreCore='Its not recomended an empty value or upper cases';
	$MULTILANG_AyudaDesPreCore='';
	$MULTILANG_AyudaTitPreApp='Important';
	$MULTILANG_AyudaDesPreApp='The prefix used for application tables can be used to separate different Practical facilities on the same database or it can be left empty to link / integrate with other applications Practical pre-existing. Not recommended uppercase for compatibility between engines.';
	$MULTILANG_AyudaLlave='Sign value for user accounts';
	$MULTILANG_NotasImportantesInst1=' <u>IMPORTANT 1 </u>: The database used for Practico must already exist to connect to it and generate the required structures. Check with your hosting provider or system administrator how to create a database with sufficient privilege to work with Practico. <br> <br> <u> IMPORTANT 2 </u>: The installer will remove all existing tables on database indicated and that match the names of tables that Practico uses. If you think you may have important information in them is recommended to make a backup before proceeding. To share a single database between different Practico installations you can change the table prefixes used by each.';
	$MULTILANG_ParametrosApp='Parameters for your application';
	$MULTILANG_ParamNombreEmpresaLargo='Full name of your organization or company';
	$MULTILANG_ParamNombreEmpresa='Short name of your organization or company';
	$MULTILANG_ParamFechaLanzamiento='Date of deployment';
	$MULTILANG_ParamNombreApp='Application name';
	$MULTILANG_ParamVersionApp='Initial release version of its application';
	$MULTILANG_AyudaTitNomEmp='Name to display on top';
	$MULTILANG_AyudaDesNomEmp='This text will be used in reports and application areas that require a name to identify your organization.';
	$MULTILANG_AyudaTitNomApp='Descriptive name';
	$MULTILANG_AyudaDesNomApp='The specified name always appears at the top of your application.';
	$MULTILANG_NotasImportantesInst2='<u>IMPORTANT</u>: Other parameters such as long and short name of your company, release date, license texts and credits will be able to be modified later in the options available for the administrator user.';
	$MULTILANG_AyudaTitCaptcha='Wordlength';
	$MULTILANG_AyudaDesCaptcha='Indicates the number of symbols used in the security word that users must enter to access the system each.';
	$MULTILANG_ModoDepuracion='Debug mode';
	$MULTILANG_AyudaTitDebug='Show errors and warnings';
	$MULTILANG_AyudaDesDebug='For production sites this option should be off. When you turn on this value, Practico will show you during application execution all errors and messages that can be generated by the Hypertext Preprocessor - PHP';
	$MULTILANG_AyudaTitDebugBD='Save query log';
	$MULTILANG_AyudaDesDebugBD='For production sites this option should be off.  When you turn on this value, Practico will save a copy of all query and transactions sent to your database over the audit module.';
	$MULTILANG_MotorAuth='Authentication engine';
	$MULTILANG_AuthPractico='Internal (Practico Tables using MD5)';
	$MULTILANG_AuthLDAP='LDAP (Directory server)';
	$MULTILANG_AuthFederado='Federated (See config under application parameters)';
	$MULTILANG_AyudaDesAuth='Using a different authentication engine Practico not preclude the creation of users of the tool. The outboard motor will serve as a method to validate the login and corresponding password as a centralized authentication method, but the other features of the profile are taken from the Practico user. The Practico password change will be disabled to be controlled only by the external motor. The admin user will always remain autonomous to keep access control configuration errors.';
	$MULTILANG_AyudaTitCript='Key encryption type used by the engine';
	$MULTILANG_AyudaDesCript='Specify the type of encryption used by the authentication system to be used. Practico will encrypt the key value entered by the user before sending the verification engine.';
	$MULTILANG_AlgoritmoCripto='Encryption Algorithm';
	$MULTILANG_Dominio='Domain';
	$MULTILANG_UO='Organizational unit or context';
	$MULTILANG_AyudaDesLdapIP='Enter the server IP address or name directory where it can be resolved.';
	$MULTILANG_AyudaDesLdapDominio='Domain used by the server. Example: This will be created midominio.com.co internal chain dc=midominio,dc=com,dc=co';
	$MULTILANG_AyudaDesLdapUO='User Context Connection. Must exist on the LDAP server, eg people, sales, marketing, etc.';
	$MULTILANG_TitInsPaso3='Writing Configuration and connecting to Database';
	$MULTILANG_DesInsPaso3='I am writing configuracion.php file located in / core with the parameters you specified and is being tested Connects to the specified database.';
	$MULTILANG_ErrorEscribirConfig='<b>Found errors when trying to write the configuration file! </b>: <br> If you want an alternative may be to change your own default values ​​contained in the file core/configuracion.php or ws_llaves.php or core/ws_oauth.php depending of your desired changes.<br> <br> You can also change file permissions for configuracion.php and try again with this wizard.';
	$MULTILANG_ErrorConexBD='<b> found errors when connecting to the database! </b>: <br> Check the values ​​entered in the previous step and try again.';
	$MULTILANG_InfoPaso3='<b> Everything seems fine with the basic configuration of PDO. </b> <br> The last step is to tell the installation wizard like trying your database:<br><br>
				<li><b>1.</b> Add data start the database, this includes the initial user (admin), menus and other records on Practico Core tables. This is the best choice for new installations.
				<li><b>2.</b> Leave the database as it is, indicating that no operation is to be executed on the database. This option is useful when trying to install over an existing database that contains applications designed and active users. It can also be understood as a blank database for new installations will not even users to access and options to select.';
	$MULTILANG_BtnAplicarBD='1. Add initial info to the BD';
	$MULTILANG_BtnNoAplicarBD='2. Do not modify the BD connected';
	$MULTILANG_ExeScripts='Running database scripts (if applicable)';
	$MULTILANG_ErrorScripts='Error executing the query on the database';
	$MULTILANG_IrInstalacion='Go to your Practico installation';
	$MULTILANG_Totalejecutado='Total queries executed';
	$MULTILANG_MsjFinal1='If this is a new installation can enter the system through <b> credentials admin / admin </ b> and change then as you desire.<hr><b><font color=red>FIRST TIME YOU LOGIN WILL BE A LONG TIME WHILE POST-INSTALLATION SCRIPTS ARE EXECUTED</font></b><hr>';
	$MULTILANG_MsjFinal2='Remember to completely remove the installation directory (folder / ins) </b> </u> to prevent other person run these scripts again on a production system can cause any damage.';
	$MULTILANG_MsjFinal2='Summary of operations executed';
	$MULTILANG_AuthLDAPTitulo='LDAP based login';
	$MULTILANG_AuthOauthPlantilla='Template user';
	$MULTILANG_AuthOauthId='Client ID';
	$MULTILANG_AuthOauthSecret='Client Secret';
	$MULTILANG_AuthOauthURI='Redirect URI';
	$MULTILANG_OauthTitURI='Before you continue, you should register a new application with the provider to obtain an ID, Secret and URI to config the auth service.  The URI to register is calculated automatically by Practico in each URI field for this form.';
	$MULTILANG_OauthDesURI='Important: Your return URI should be under a domain or public IP because your provider will need to link with that. This URI is automatically created acording to the path during installation time.  Clic over each providers logo to go to their API registration website.';
	$MULTILANG_OauthPredeterminado='Once you register an OAuth provider, you can configure your system so that the OAuth options are presented by default at the time of login from the configuration panel.';
	$MULTILANG_BuscarActual='Search for upgrades automatically';
	$MULTILANG_DescActual='Search randomly on admin logins to check for new Practicos versions.  This option could turn a little slower admin loads while checks for new versions';
	$MULTILANG_ConfGraficas='Change graphic configurations';
	$MULTILANG_UsuariosAdmin='Super users';
	$MULTILANG_UsuariosAdminDes='A comma separated list of the users that are the platform administrators and application designers.  If you want to remove the admin user please be sure that you have another super user or you will lost admin rights.';
	$MULTILANG_PermitirReseteoClave='Allow to recover passwords';
	$MULTILANG_DesPermitirReseteoClave='Puts a password recovery option in the login window that allow users to open a password recovery wizard.  This is available only for the Practicos internal auth engine.';
	$MULTILANG_PermitirAutoRegistro='Allow users self sign up in the system';
	$MULTILANG_DesPermitirAutoRegistro='Puts a sign-up option in the login window that allow users to open a form to self register in the system.  This is available only for the Practicos internal auth engine.';
	$MULTILANG_UsuarioAutoRegistro='Template user for self-sign up';
	$MULTILANG_DesUsuarioAutoRegistro='Says which user will be used for the rights in the self-registered users';
	$MULTILANG_NoRecomendado='Not recommended for security reasons';
	$MULTILANG_UbicacionOauth='Prefered location for Oauth options at login time';
	$MULTILANG_OauthOpcionBoton='As a button that open the OAuth providers';
	$MULTILANG_OauthOpcionDirecta='As extra options directly over standar login window';

	//API-Webservices
	$MULTILANG_WSErrTitulo='Practico WebServices - Error';
	$MULTILANG_WSErr01='[Cod. 01] Invalid key';
	$MULTILANG_WSErr02='[Cod. 01] Secret value is not valid';
	$MULTILANG_WSErr03='[Cod. 03] WebServices functions file does not found';
	$MULTILANG_WSErr04='[Cod. 04] Webservice consumers key is empty or null. Check the value you sent or your Practico installation process.';
	$MULTILANG_WSErr05='[Cod. 05] The service identifier, function or method could not be executed, is uknown or is empty.';
	$MULTILANG_WSErr06='[Cod. 06] You dont have permission to run the service: ';
	$MULTILANG_WSErr07='[Cod. 07] API access unauthorized for the address: ';
	$MULTILANG_WSErr08='[Cod. 08] API access unauthorized for the domain: ';
	$MULTILANG_WSConfigButt='WebServices keys';
	$MULTILANG_WSLlavesDefinidas='<b>WebServices consumer Keys</b> (one each line)';
	$MULTILANG_WSLlavesAyuda='Those are the webservices keys that you allow to use Pr&aacute;ctico Webservices or user custom services.  It is not necessary to add your setup pass key cause it is allowed by default over all domains and functions';
	$MULTILANG_WSLlavesNuevo='Add a new API client';
	$MULTILANG_WSLlavesBorrar='You are going to delete the API keys selected.  Any application o foreign connection using that keys will be forbidden by Practico.  This operation can not be undo later, Are you sure?';
	$MULTILANG_WSLlavesNombre='Client name';
	$MULTILANG_WSLlavesLlave='Key';
	$MULTILANG_WSLlavesSecreto='Secret';
	$MULTILANG_WSLlavesURI='Redirect URI';
	$MULTILANG_WSLlavesDominio='Authorized domain(s)';
	$MULTILANG_WSLlavesIP='Authorized IP(s)';
	$MULTILANG_WSLlavesFunciones='Allowed services';
	$MULTILANG_WSLlavesAsterisco='(*) asterisk for any';


	//OAuth
	$MULTILANG_OauthButt='OAuth Autentication';
	$MULTILANG_PreferirOauth='Display default OAuth options during login';
	$MULTILANG_ProtoTransporte='Prefered transport protocol';
	$MULTILANG_ProtoTransAUTO='Autodetect by URL';
	$MULTILANG_ProtoTransHTTP='HTTP standard';
	$MULTILANG_ProtoTransHTTPS='HTTP secured';
	$MULTILANG_ProtoDescripcion='Autodetect will check URLs used to access and will enable or disable SSL,  HTTP standard allow people with self-signed certs to connect with the Practicos auth webservice.  This is an unsafe mode but very effective if you need to access.   HTTP Secured requieres a valid SSL cert by a CA on your web server.';

	//Login Federado
	$MULTILANG_TitFederado='Federated Login';

	//Modulo de monitoreo
	$MULTILANG_MonTitulo='Monitoring system';
	$MULTILANG_MonPgInicio='Start page';
	$MULTILANG_MonConfig='Monitor configure';
	$MULTILANG_MonNuevo='Add a new monitor';
	$MULTILANG_MonCommShell='Shell command';
	$MULTILANG_MonCommSQL='SQL Query';
	$MULTILANG_MonDesTipo='This is the element that you want to add to the monitoring page';
	$MULTILANG_MonMetodo='Used method';
	$MULTILANG_MonSaltos='Line brakes';
	$MULTILANG_MonTamano='SQL font size';
	$MULTILANG_MonOcultaTit='Title hidding';
	$MULTILANG_MonCorreoAlerta='Alerts email';
	$MULTILANG_MonAlertaSnd='Soundest alert';
	$MULTILANG_MonMsLectura='Milliseconds for reading';
	$MULTILANG_MonDefinidos='Pages & Monitors defined';
	$MULTILANG_MonErr='Name field is mandatory';
	$MULTILANG_MonEstado='System status';
	$MULTILANG_MonAcerca='&copy; Monitoring system based on <a target="_blank" href="http://www.practico.org" style="color:#FFFFFF"><font color=white><b>Practico.org</b></font></a>';
	$MULTILANG_AplicaPara='This applies for: ';
	$MULTILANG_MonLinea='ON LINE';
	$MULTILANG_MonCaido='DOWN';
	$MULTILANG_MonAlertaVibrar='Vibrate on mobile devices';
	$MULTILANG_MonSensorRango='Sensor in a range';
	$MULTILANG_MonModoCompacto='Use compact mode';

    //Modulo de correos
    $MULTILANG_MailIntro1='Automatic platform message';
    $MULTILANG_MailIntro2='Details about this message could be available in the system <span style="font-weight: bold;">'.$NombreRAD.'</span> using your user name and password.';
    $MULTILANG_MailIntro3='This message was delivered by an automatic system, please dont reply to it.';
    $MULTILANG_MailIntro4='Remember that our messages never ask you about personal information, security keys by email</span>, dont answer any message or fill any form that ask you about this kind of information out of our '.$NombreRAD.' system.';
    $MULTILANG_MailIntro5='All the information in this email and all its attachments is confidential for the bussiness and could be used for people who is related to it only. If you receive this message by error please delete it and tell sender about the error, any other operation with this email and its content will be under legal protection.';
    $MULTILANG_MailIntro6='<br><br>A system powered by <a href=http://www.practico.org>www.practico.org</a>';

	//Modulo de chat
	$MULTILANG_UsuariosChat='Users that are offline at this moment will see all the messages when they login again to the system.';
	$MULTILANG_ChatActivar='Enable chat module?';
	$MULTILANG_ChatTipo1='Only between internal users';
	$MULTILANG_ChatTipo2='Only between external users';
	$MULTILANG_ChatTipo3='For all users';
	$MULTILANG_ChatTipo4='Only for admin';
	$MULTILANG_ChatDevel='Developers chat';

	//Modulo de replicas
	$MULTILANG_ReplicaTitulo='Extra Connections and Replication';
	$MULTILANG_ReplicaDefinidos='Automatic replication servers defined';
	$MULTILANG_AgregarReplica='Add a new connection';
	$MULTILANG_ReplicaTodo='Use it as a mirror';
	$MULTILANG_AyudaReplica='Define if all database operations over the main system should be replicated over this connection.  If this valus is NO, Practico will define the connection and make it ready to be used by code or individual operations only when you want.  This applies for data upgrade operations (Insert,Update,Delete) that was maked by the PCO_EjecutarSQLUnaria() internal function';
	$MULTILANG_ConnAdicionales='Extra database connections defined';
	$MULTILANG_ConnPredeterminada='Default (Same connection used by Practico)';
	$MULTILANG_ConnOrigenDatos='Data origin';
	$MULTILANG_ConnOrigenDatosDes='Determines where the data will be taken to make the report. By default it uses the connection and database engine configured to work with Practical; but you can also select other engines or external connections and be able to extract data from there. To add other data sources, use the Extra Connections and Replication option.';
    $MULTILANG_ConnAdvCambioOrigen='CAUTION: Altering the connection or data source used for a report after its design can generate run-time errors because data structures, tables, and fields may not be found in the newly selected connection. Be careful.';

	//Eventos javascript
    $MULTILANG_EventosTit='Object events & triggers';
    $MULTILANG_EventosPrevio='Before you can automate operations using events or triggers with an object or form control you must first create the base control and then enter edit it again to activate the options.';
    $MULTILANG_EventoClick='Click over an element';
    $MULTILANG_EventoDobleClick='Double click over an element';
    $MULTILANG_EventoMouseDown='Mouse button is pressed over an element';
    $MULTILANG_EventoMouseEnter='Mouse pointer get in an element';
    $MULTILANG_EventoMouseLeave='Mouse pointer get out of an element';
    $MULTILANG_EventoMouseMove='Mouse pointer is moving over an element';
    $MULTILANG_EventoMouseOver='Mouse pointer is over an element';
    $MULTILANG_EventoMouseOut='Mouse pointer goes out of an element or its childs';
    $MULTILANG_EventoMouseUp='Mouse button is released over an element';
    $MULTILANG_EventoContextMenu='Mouse right button pressed (before context menu appears)';
    $MULTILANG_EventoKeyDown='User has a pressed key (form controls and body)';
    $MULTILANG_EventoKeyPress='User press a key (moment in that is pressed) (form elements and body)';
    $MULTILANG_EventoKeyUp='User release a key that was pressed (form elements and body)';
    $MULTILANG_EventoFocus='A form element gets the focus';
    $MULTILANG_EventoBlur='A form element loses the focus';
    $MULTILANG_EventoChange='A form element changes';
    $MULTILANG_EventoSelect='User selects text from an input or textarea';
    $MULTILANG_EventoSubmit='Form submit button is pressed (before sending)';
    $MULTILANG_EventoReset='Form reset button is pressed';
    $MULTILANG_EventoCut='Data selected in a text control were cutted';
    $MULTILANG_EventoCopy='Data selected in a text control were copied';
    $MULTILANG_EventoPaste='Content was pasted in a text control';
    $MULTILANG_EventoLoad='Window or frame load was completed';
    $MULTILANG_EventoUnload='User close window or frame';
    $MULTILANG_EventoResize='User changes window o frame sizes';
    $MULTILANG_EventoClose='User try to close window or frame';
    $MULTILANG_EventoScroll='User do a scroll over windows or control that support it';
    $MULTILANG_EventoAnimFin='A CSS animation was ended';
    $MULTILANG_EventoAnimInicio='A CSS animation was started';
    $MULTILANG_EventoAnimIteracion='A CSS animation was restarted/repeated';
    $MULTILANG_EventoTipoRaton='Mouse Events or Pointing Device';
    $MULTILANG_EventoTipoTeclado='Keyboard Events';
    $MULTILANG_EventoTipoFormulario='Form Control Events';
    $MULTILANG_EventoTipoVentana='Events for windows and frames';
    $MULTILANG_EventoTipoAnima='Events for animations and transitions';
    $MULTILANG_EventoTipoBateria='Events related to battery and its charge';
    $MULTILANG_EventoTipoLlamadas='Events associated with calls and telephony';
    $MULTILANG_EventoTipoDOM='Events on the DOM tree';
    $MULTILANG_EventoTipoArrastrar='Events associated with drag and drop elements';
    $MULTILANG_EventoTipoAudio='Audio and video events';
    $MULTILANG_EventoTipoInternet='Internet Connection Events';

    //ModuloKanban
    $MULTILANG_TablerosKanban='Kanban Boards';
    $MULTILANG_AgregarNuevaTarea='Add new task';
    $MULTILANG_DesTarea='General description of the task or activity to be added to the Kanban board. You can even use other description techniques such as user stories or any other methodology you want to document the activity.';
    $MULTILANG_AsignadoA='Assigned to';
    $MULTILANG_AsignadoADes='Registered user in the system that is responsible for the completion of this task or activity (if applicable)';
    $MULTILANG_FechaLimite='Date due';
    $MULTILANG_DelKanban='You are going to delete a task from the board and this action could not be undone later. Are you sure?';
    $MULTILANG_Historia1='Minimal user history: [Rol,Functionality,Purpose]';
    $MULTILANG_Historia1Des='As ________ I need ___________ with the purpose of ________.';
    $MULTILANG_Historia2='Intermediate user history: [Rol,Functionality,Purpose]+[Context/Acceptance requirements,Event]';
    $MULTILANG_Historia2Des='As ________ I need ___________ with the purpose of ________.BRBRIn case _______ it should _______';
    $MULTILANG_Historia3='Detailed user history: [ID,Rol,Functionality,Purpose]+[Stage,Context/Acceptance requirements,Event]';
    $MULTILANG_Historia3Des='ID: ______BRAs ________ I need ___________ with the purpose of ________.BRBRScene: ________. In case _______ it should _______';
    $MULTILANG_ListaColumnas='Columns list';
    $MULTILANG_ListaCategorias='Category list';
    $MULTILANG_ArchivarTarea='Archive task';
    $MULTILANG_ArchivarTareaAdv='The task will be archived, it will leave the board and will go to the historical one. do you wish to continue?';
    $MULTILANG_TareasArchivadas='Archived tasks';
    $MULTILANG_CompartidosConmigo='Shared with me';
    $MULTILANG_CrearTablero='Add board';
    $MULTILANG_CompartirCon='Shared with';
    $MULTILANG_NoTablero='There is not a Kanban board created by you or shared with you by another user';
    $MULTILANG_ArrastrarTarea='Move tasks quickly draggind and dropping over this title.';
    $MULTILANG_TodosLosTableros='All Kanban boards';

    //ModuloBugTracker
    $MULTILANG_BTReporteBugs='Report errors or improvements';
    $MULTILANG_BTUltimaActualizacion='Last update date';
    $MULTILANG_BTSeveridad='Severity';
    $MULTILANG_BTUsuarioReporte='Reported by';
    $MULTILANG_BTAsignadoA='Assigned to';
    $MULTILANG_BTPasos='Steps to reproduce the problem';
    $MULTILANG_BTOrigen='Origin system';
    $MULTILANG_BTTrazas='Traces associated with the error';
    $MULTILANG_BTVersion='Version of the project or product';
    $MULTILANG_BTDescripcion='Description of the error or improvement';
    $MULTILANG_BTFechaCierre='Deadline';
    $MULTILANG_BTProyectoAsociado='Associated project';
    $MULTILANG_BTFechaApertura='Date of opening of the case';
    $MULTILANG_BTHistorial='Management history';
    $MULTILANG_BTCategoriaDes='Please select if this is an application error, an enhancement or a question about Functionality';
    $MULTILANG_BTComplementoDes='If applies, write the step by step procedure to reproduce the error over the sysmte.';
    $MULTILANG_BTPanel='Panel de gesti&oacute;n de errores o bugs';
    $MULTILANG_BTBugtracking='Bugtracking';
    $MULTILANG_BTPermitirReporte='Allow users to send bug reports';

    //Opciones de Documentacion
    $MULTILANG_Documentar='Document';
    $MULTILANG_DocumentarDes='Add to the beginning of the code a documentation template for functions or procedures in NaturalDocs notation';
    $MULTILANG_DocumentarLink='Open extra documentation help for NaturalDocs';

    //PWA
    $MULTILANG_PWAActivar='Activate the use of Progressive Web Applications';
    $MULTILANG_PWAAyuda='It allows activating in the application the PWA technology that allows your application to make a request for installation as a mobile application from browsers in devices that support this technology. For more information see the links  https://w3c.github.io/manifest/  y  https://developers.google.com/web/progressive-web-apps/';
    $MULTILANG_PWAIconos='Definition of icons for the App';
    $MULTILANG_PWADescripcion='Progressive Web Application generated automatically by Practico Framework';
    $MULTILANG_PWADireccionTexto='Text direction';
    $MULTILANG_PWADisplayPreferido='Preferred display mode';
    $MULTILANG_PWAOrientacionPantalla='Screen orientation';
    $MULTILANG_PWAGCM='Firebase Cloud Messaging ID';
    $MULTILANG_PWAScope='Scope';
    $MULTILANG_PWAScopeDes='If your Practico installation resides on the root of your web server or subdomain, you can leave this blank. If your installation resides on any folder please indicate ./folder/ to establish the scope of the Service Worker and the PWA manifest.';
    $MULTILANG_PWAAutorizarGPS='Request authorization to obtain location (GPS)';
    $MULTILANG_PWAAutorizarFCM='Request authorization of sending notifications (PUSH)';
    $MULTILANG_PWAAutorizarCAM='Request authorization to use video device (CAMERA)';
    $MULTILANG_PWAAutorizarMIC='Request authorization to use audio device (MICROPHONE)';
    $MULTILANG_PWAOcultarBarrasExtra='Hide navigation bars to standard users?';
    $MULTILANG_PWAOcultarBarrasExtraDes='It saves space for the application of writing or mobile. Applies only to standard users (non-designers). The developer should guarantee access to certain hidden functions of the bar by means of its own controls, such as, for example, session closing, among others.';

    //Planificador de tareas
    $MULTILANG_CronTitulo='Task scheduler';
    $MULTILANG_CronComando='Cron command';
    $MULTILANG_CronComando='Absolute URL';
    $MULTILANG_CronPlanificacion='Type of schedule';
    $MULTILANG_CronAyuda='You can schedule the execution of your scheduled task using the cron daemon and the indicated command or the use of free external tools such as GCP CloudScheduler and the indicated absolute URL. Remember not to disclose the safety code or the execution of the task could be done by anyone who knows it.';
    
    //Pcoder
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
	$MULTILANG_PCODER_DefPcoder='Code Editor';
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