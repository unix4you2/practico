<?php
	/*
	Copyright (C) 2013  John F. Arroyave Gutiérrez
						unix4you2@gmail.com

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
	*/

	/*
		Title: Idioma espanol
		Ubicacion *[/inc/idioma/es.php]*.  Incluye la definicion de variables utilizadas para presentar mensajes en el idioma correspondiente
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
	$MULTILANG_Anonimo='Anonymous';
	$MULTILANG_Anterior='Previous';
	$MULTILANG_Apagado='Off';
	$MULTILANG_Aplicando='Applying';
	$MULTILANG_Asistente='Wizard';
	$MULTILANG_Atencion='Attention';
	$MULTILANG_Ayuda='Help';
	$MULTILANG_Basedatos='Data base';
	$MULTILANG_BarraHtas='Toolbar';
	$MULTILANG_Campo='Field';
	$MULTILANG_Cancelar='Cancel';
	$MULTILANG_CaracteresCaptcha='Number of characters for captcha?';
	$MULTILANG_Cerrar='Close';
	$MULTILANG_CerrarSesion='Logout';
	$MULTILANG_Cliente='Client';
	$MULTILANG_Columna='Column';
	$MULTILANG_ConfiguracionGeneral='General Settings';
	$MULTILANG_ConfiguracionVarias='Configuring multiple options';
	$MULTILANG_Confirma='Are you sure you want to continue?';
	$MULTILANG_Continuar='Continue';
	$MULTILANG_Contrasena='Password';
	$MULTILANG_Controlador='Driver';
	$MULTILANG_Correcto='Right';
	$MULTILANG_Correo='Email';
	$MULTILANG_Cualquiera='Any';
	$MULTILANG_Defina='Define';
	$MULTILANG_Deshabilitado='Disabled';
	$MULTILANG_Detalles='Details';
	$MULTILANG_Disene='Design';
	$MULTILANG_Editar='Edit';
	$MULTILANG_Ejecutar='Execute';
	$MULTILANG_Eliminar='Delete';
	$MULTILANG_Encendido='On';
	$MULTILANG_Error='Error';
	$MULTILANG_Estado='Status';
	$MULTILANG_Etiqueta='Label';
	$MULTILANG_Fecha='Date';
	$MULTILANG_Finalizado='Finished';
	$MULTILANG_Formularios='Forms';
	$MULTILANG_Grande='Big';
	$MULTILANG_Grafico='Graphic';
	$MULTILANG_Guardar='Save';
	$MULTILANG_Habilitado='Enabled';
	$MULTILANG_Habilitar='Enable';
	$MULTILANG_Hora='Time';
	$MULTILANG_IdiomaPredeterminado='Default language';
	$MULTILANG_Imagen='Picture';
	$MULTILANG_Importante='Important';
	$MULTILANG_InfoAdicional='Additional information';
	$MULTILANG_Informes='Reports';
	$MULTILANG_Ingresar='Sign in';
	$MULTILANG_Instante='Instant';
	$MULTILANG_IrEscritorio='Go to my desk';
	$MULTILANG_LlavePaso='SignKey';
	$MULTILANG_MotorBD='Database Engine';
	$MULTILANG_Ninguno='None';
	$MULTILANG_No='No';
	$MULTILANG_Nombre='Name';
	$MULTILANG_NombreRAD='RAD Name';
	$MULTILANG_Opcional='Optional';
	$MULTILANG_OpcionesMenu='Menu options';
	$MULTILANG_Otros='Others';
	$MULTILANG_Paso='Step';
	$MULTILANG_Peso='Weight';
	$MULTILANG_Pequeno='small';
	$MULTILANG_PlantillaActiva='Active template';
	$MULTILANG_Predeterminado='Default';
	$MULTILANG_ProcesoFin='Process completed';
	$MULTILANG_Puerto='Port';
	$MULTILANG_Si='Yes';
	$MULTILANG_Servidor='Server';
	$MULTILANG_SeleccioneUno='Choose one';
	$MULTILANG_Suspender='Suspend';
	$MULTILANG_Tablas='Tables';
	$MULTILANG_TablaDatos='Data table';
	$MULTILANG_TiempoCarga='Load time';
	$MULTILANG_Tipo='Type';
	$MULTILANG_TipoMotor='Engine type';
	$MULTILANG_Titulo='Title';
	$MULTILANG_TotalRegistros='Total records found';
	$MULTILANG_Usuario='User';
	$MULTILANG_Vacio='Empty';
	$MULTILANG_Version='Versi&oacute;n';
	$MULTILANG_ZonaHoraria='Time zone';
	
	//Ventana de login
	$MULTILANG_TituloLogin='System Login';
	$MULTILANG_CodigoSeguridad='Security code';
	$MULTILANG_IngreseCodigoSeguridad='Enter here the security code';
	$MULTILANG_AccesoExclusivo='Access to this software is only for registered users. For your safety, never share your username and password.';

	//Banderas de campos en formularios
	$MULTILANG_TitValorUnico='The value entered does not accept duplicate';
	$MULTILANG_DesValorUnico='The system will validate the information entered in this field, if there is already a record with that value in the database will not be allowed entry.';
	$MULTILANG_TitObligatorio='Required field';
	$MULTILANG_DesObligatorio='This field has been marked as mandatory. If you do not enter a value for this the system does not store the user input record.';

	//Errores y avisos varios
	$MULTILANG_TituloInsExiste='ATTENTION: The installation folder exists on the server';
	$MULTILANG_TextoInsExiste='This message appears permanently to all users as you do not delete the directory used for the installation of Practico. It is essential that the folder is deleted after the end of an installation to prevent any anonymous user initiate the process again overwritting configuration files or databases with information of importance to you<br><br>If you have already completed an install of Practico for use in production is important to remove this folder before proceeding. If you want to delete this folder you can choose to rename in temporary or trial. <br> <br> If you are viewing this message when running this script for the first time and want to make a new installation, you can launch the wizard <input type="button" Value="clicking HERE" Onclick="document.location=\'ins\'" class="BotonesCuidado"> ';
	$MULTILANG_ErrorTiempoEjecucion='RunTime Error';
	$MULTILANG_ErrorModulo='Main module is trying to include a module located in <b>mod/</b> but Practico can not find your access point. <br> Check the module status, consult your administrator or delete the conflicting module to avoid this message.';
	$MULTILANG_ContacteAdmin='Contact your system administrator and report this post.';
	$MULTILANG_ReinicieWeb='Please make the required settings and restart your web service.';
	$MULTILANG_PHPSinSoporte='Your PHP installation appears to have no support';
	$MULTILANG_ErrExtension='PHP Extension missing or disabled';
	$MULTILANG_ErrLDAP=$MULTILANG_PHPSinSoporte.' LDAP support is required for use as external authentication method.<br>'.$MULTILANG_ReinicieWeb.'.<br>The admin user authentication will remain independent to avoid loss of access.';
	$MULTILANG_ErrHASH=$MULTILANG_PHPSinSoporte.' HASH support is required.<br>This extension is required if you selected a different encryption type for passwords on engines up external authentication.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrSESS=$MULTILANG_PHPSinSoporte.' sessions support is required. '.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrGD=$MULTILANG_PHPSinSoporte.' GD Graphics Library is required.<br>Those who are using debian, ubuntu or its derivatives can try a <b> apt-get install php5-gd </ b> to add it.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrPDO=$MULTILANG_PHPSinSoporte.' PDO support is required.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrDriverPDO=$MULTILANG_PHPSinSoporte.' for PDO. '.$MULTILANG_ReinicieWeb;
	$MULTILANG_ObjetoNoExiste='The object associated with this request does not exist.';
	$MULTILANG_ErrorDatos='Problem in the input data';
	$MULTILANG_ErrorTitAuth='<blink>ACCESS DENIED!</blink>';
	$MULTILANG_ErrorDesAuth='The credentials supplied for access to the system were not accepted. Some common causes are:<br><li> The username or password is incorrect. <br> <li> Security code entered incorrectly. <br> <li> Your Login is disabled. <br> <li> Account locked access by multiple attempts with incorrect password.';

	//Asistente disenador aplicaciones
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

	//Cierre de sesion
	$MULTILANG_SesionCerrada='Your session has been closed';
	$MULTILANG_TituloCierre='This can result from actions taken by the user like';
	$MULTILANG_ExplicacionCierre='<li>Close your session voluntarily</li>
			<li>Stop using the system for a long time</li>
			<li>Having multiple windows open at the same time system in restricted sections by admin</li>
			<li>Your username or password is invalid for further operation</li>
			<li>Navigate using links or other buttons than those permitted</li>
			<font color="#000000">
			<br><strong>Also for configurations or actions on your computer like:</strong><br>
			<font color="#808080">
			<li>Your browser is not supporting cookies</li>
			<li>Cleaned cache of browser cookies or sessions while using the system</li>
			<font color="#000000">
			<br><strong>System configurations also like:</strong><br>
			<font color="#808080">
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
	
	//Formularios
	$MULTILANG_ErrFrmDuplicado='Failed doubled value (the) field (s): $campo . The value you entered already exists in the database.';
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
	$MULTILANG_FrmTipo3='Richly formatted text field';
	$MULTILANG_FrmTipo4='Selection field (ComboBox dropdown list)';
	$MULTILANG_FrmTipo5='Selection field (RadioButton)';
	$MULTILANG_FrmTipoTit2='Presentation and other content';
	$MULTILANG_FrmTipo6='Rich Text (as a label)';
	$MULTILANG_FrmTipo7='Wrapper (iFrame)';
	$MULTILANG_FrmTipoTit3='Internal objects';
	$MULTILANG_FrmTipo8='Report predesigned (Data Table or Graph)';
	$MULTILANG_FrmTitulo='Title or Tag';
	$MULTILANG_FrmDesTitulo='Text that will appear next to the field telling the user the information that must be entered. You can use basic HTML to additional format.';
	$MULTILANG_FrmCampo='Linked field';
	$MULTILANG_FrmCampoOb1='Mandatory field for data binding controls';
	$MULTILANG_FrmDesCampo='Field data table which will link information';
	$MULTILANG_FrmValUnico='Single value field';
	$MULTILANG_FrmTitUnico='Uniqueness for input values';
	$MULTILANG_FrmDesUnico='Indicates whether the field can store or repeated values ​​in the database. Should be enabled for fields representing primary keys in their Design and disabled for the rest';
	$MULTILANG_FrmPredeterminado='Default value';
	$MULTILANG_FrmDesPredeterminado='Sets the value that appears automatically filled in the field to open the form view. This value can be out of data validation';
	$MULTILANG_FrmValida='Data validation';
	$MULTILANG_FrmValida1='Numbers only 0-9';
	$MULTILANG_FrmValida2='Only letters A-Z';
	$MULTILANG_FrmValida3='Letters and numbers';
	$MULTILANG_FrmValida4='Date field';
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
	$MULTILANG_FrmAjax='Use AJAX to search';
	$MULTILANG_FrmTitAjax='Record Recovery Mode';
	$MULTILANG_FrmDesAjax='When the box is turned on, Practico attempts to retrieve the log information to the form using AJAX (Recommended enable), otherwise using the standard method for sending request and page reload with the results . It can be disabled to improve compatibility with older browsers.';
	$MULTILANG_FrmTeclado='Add virtual keyboard';
	$MULTILANG_FrmTitTeclado='Allow data entry by on-screen keyboard';
	$MULTILANG_FrmDesTeclado='When enabled on the form displays a virtual keyboard for entering information,. For now the keyboard use may violate validations';
	$MULTILANG_FrmAncho='Width';
	$MULTILANG_FrmTitAncho='How wide should occupy space control';
	$MULTILANG_FrmDesAncho='IMPORTANT: in characters number for simple text fields and pixels rich-text fields. Enter a number of columns, however, note that the width in pixels will vary according to the type of font used by the current theme';
	$MULTILANG_FrmDesAncho2='Minimum recommended for rich-text format fields: 350';
	$MULTILANG_FrmAlto='Height (lines)';
	$MULTILANG_FrmTitAlto='How many rows should be visible in the control?';
	$MULTILANG_FrmDesAlto='IMPORTANT: the number of rows for simple text or in pixels for rich-text formatting. If the text exceeds the number of rows are automatically added scrollbars';
	$MULTILANG_FrmDesAlto2='Minimum recommended format fields: 100';
	$MULTILANG_FrmBarra='Formatting bar';
	$MULTILANG_FrmBarraTipo1='Basic: Document, character and paragraph formatting';
	$MULTILANG_FrmBarraTipo2='Standard: Basic + links and font styles';
	$MULTILANG_FrmBarraTipo3='Extended: Standard + clipboard, search-replace and spelling';
	$MULTILANG_FrmBarraTipo4='Advanced: Extended + Insert objects and colors';
	$MULTILANG_FrmBarraTipo5='Full: Advanced + Forms and full screen';
	$MULTILANG_FrmTitBarra='Editor type used';
	$MULTILANG_FrmDesBarra='Indicates the type of toolbar that appears at the top of the control and the user to perform different tasks of editing. IMPORTANT: Each type of editor requires a different space on the form as it should deploy a number of icons and different options';
	$MULTILANG_FrmFila='Single row for this object?';
	$MULTILANG_FrmTitFila='Must Practico use a full row for the object?';
	$MULTILANG_FrmDesFila='Allows to display the object in a unique row of the table used in the form';
	$MULTILANG_FrmLista='Options list';
	$MULTILANG_FrmTitLista='What options are to be chosen';
	$MULTILANG_FrmDesLista='Enter a list of options separated by commas. If you need to take the options table dynamically from another application to use the Data Source fields for options. Should fill both options (fixed list and data source) the result will be the combination';
	$MULTILANG_FrmDesLista2='Commas separated';
	$MULTILANG_FrmOrigen='Options list source';
	$MULTILANG_FrmTitOrigen='You must specify the same source (table) from the list of values';
	$MULTILANG_FrmDesOrigen='From which Field are made the choices that displays the list';
	$MULTILANG_FrmTitOrigen2='What is this?';
	$MULTILANG_FrmOrigenVal='List of values source';
	$MULTILANG_FrmTitOrigenVal='Debe especificar el mismo origen (tabla) de la lista de opciones';
	$MULTILANG_FrmDesOrigenVal='Campo desde el cual se toman los valores internos (a ser procesados) para cada opcion de la lista';
	$MULTILANG_FrmEtiqueta='Valor de la etiqueta (ser&aacute; impresa en el formulario en formato HTML)';
	$MULTILANG_FrmURL='URL para IFrame';
	$MULTILANG_FrmDesURL='Ingrese la direcci&oacute;n de la p&aacute;gina que sera embebida en el marco';
	$MULTILANG_FrmInforme='Informe vinculado';
	$MULTILANG_FrmVentana='Ventana propia para el objeto?';
	$MULTILANG_FrmDesVentana='No se recomienda activar este campo cuando desee empotrar informes de tipo GRAFICA';
	$MULTILANG_FrmLongMaxima='Longitud m&aacute;xima';
	$MULTILANG_FrmTit1LongMaxima='Cu&aacute;ntos caracteres permite el campo?';
	$MULTILANG_FrmTit2LongMaxima='Valor entre 1 y N, 0 para deshabilitar el l&iacute;mite';
	$MULTILANG_FrmBtnGuardar='Agregar o actualizar el objeto/campo';
	$MULTILANG_FrmAgregaBot='Agregar botones y acciones al formulario';
	$MULTILANG_FrmTituloBot='T&iacute;tulo o etiqueta';
	$MULTILANG_FrmDesBot='Texto que aparecer&aacute; sobre el bot&oacute;n';
	$MULTILANG_FrmEstilo='Estilo';
	$MULTILANG_FrmEstilo1='Predeterminado - bot&oacute;n normal';
	$MULTILANG_FrmEstilo1b='Bot&oacute;n normal';
	$MULTILANG_FrmEstilo2='Boton de acci&oacute;n que requiere cuidado';
	$MULTILANG_FrmDesEstilo='Apariencia gr&aacute;fica del control';
	$MULTILANG_FrmTipoAccion='Tipo de acci&oacute;n';
	$MULTILANG_FrmAccionT1='Acciones internas';
	$MULTILANG_FrmAccionGuardar='Guardar datos';
	$MULTILANG_FrmAccionLimpiar='Limpiar datos';
	$MULTILANG_FrmAccionEliminar='Eliminar datos';
	$MULTILANG_FrmAccionRegresar='Regresar a escritorio';
	$MULTILANG_FrmAccionCargar='Cargar un objeto';
	$MULTILANG_FrmAccionT2='Definidas por el usuario';
	$MULTILANG_FrmAccionExterna='En personalizadas.php o cualquier otro m&oacute;dulo instalado';
	$MULTILANG_FrmAccionJS='Comando en JavaScript';
	$MULTILANG_FrmDesAccion='Comando que deber&aacute; ejecutar el control al ser pulsado.  Para acciones definidas es personalizadas.php los datos del formulario ser&aacute;n enviados a esa rutina para ser procesados';
	$MULTILANG_FrmAccionCMD='Comando del usuario';
	$MULTILANG_FrmAccionDesCMD='Nombre de la acci&oacute;n definida en el archivo de personalizaci&oacute;n que procesar&aacute; la informaci&oacute;n o comando en JavaScript a ser ejecutado de manera inmediata en la p&aacute;gina (si requiere par&aacute;metros dentro de su comando utilice comillas sencillas para encerrarlos). Para cargar objetos de Pr&aacute;ctico como formularios o informes puede usar la misma notaci&oacute;n de menus: frm:XX:Par1:Par2:ParN o inf:XX...  El comando javascript ImprimirMarco(\'seccion_impresion\') le permite imprimir el contenido del formulario';
	$MULTILANG_FrmDesPeso='Posicion en la que aparece el campo dentro de la barra de estado del formulario cuando este se despliega en pantalla. Orden de izquierda a derecha';
	$MULTILANG_FrmBotDesVisible='Determina si el control es visible o no para el usuario';
	$MULTILANG_FrmRetorno='T&iacute;tulo de retorno';
	$MULTILANG_FrmDesRetorno='Texto que aparecer&aacute; como encabezado en el escritorio despu&eacute;s de realizar la acci&oacute;n indicada por el usuario';
	$MULTILANG_FrmTxtRetorno='Texto de retorno';
	$MULTILANG_FrmTxtDesRetorno='Texto completo con la descripci&oacute;n de acci&oacute;n realizada o mensaje entregado al usuario despu&eacute;s de ejecutar el control';
	$MULTILANG_FrmConfirma='Texto de confirmaci&oacute;n';
	$MULTILANG_FrmDesConfirma='En caso de ser diligenciado: Texto que aparecer&aacute; como ventana emergente advirtiendo la ejecuci&oacute;n del control y esperando confirmaci&oacute;n del usuario para proceder';
	$MULTILANG_FrmBtnGuardar='Agregar acci&oacute;n/bot&oacute;n';
	$MULTILANG_FrmDisCampos='Dise&ntilde;o general de campos';
	$MULTILANG_FrmDesObliga='Tenga presente que los campos obligatorios deber&iacute;an estar visibles';
	$MULTILANG_FrmGuardaCol='Guardar columna';
	$MULTILANG_FrmAumentaPeso='Aumentar peso (bajar)';
	$MULTILANG_FrmDisminuyePeso='Disminuir peso (subir)';
	$MULTILANG_FrmHlpCambiaEstado='Cambiar estado';
	$MULTILANG_FrmAdvDelCampo='IMPORTANTE:  Al eliminar el campo los usuarios no podr&aacute;n verlo  y no podr&aacute; deshacer esta operaci&oacute;n.\n'.$MULTILANG_Confirma;
	$MULTILANG_FrmTitComandos='Definici&oacute;n general de acciones y comandos';
	$MULTILANG_FrmTipoAcc='Tipo de acci&oacute;n';
	$MULTILANG_FrmAccUsuario='Acci&oacute;n Usuario';
	$MULTILANG_FrmOrden='Orden';
	$MULTILANG_FrmAdvDelBoton='IMPORTANTE:  Al eliminar el bot&oacute;n/acci&oacute;n los usuarios no podr&aacute;n verlo o ejecutar el comando asociado a este y no podr&aacute; deshacer esta operaci&oacute;n luego.\n'.$MULTILANG_Confirma;
	$MULTILANG_FrmObjetos='Objetos y Campos de datos';
	$MULTILANG_FrmDesObjetos='Agregar un objeto o campo de datos';
	$MULTILANG_FrmDesCampos='Dise&ntilde;o general de campos';
	$MULTILANG_FrmAcciones='Acciones, botones y comandos';
	$MULTILANG_FrmDesBoton='Agregar bot&oacute;n o acci&oacute;n';
	$MULTILANG_FrmDesAcciones='Definici&oacute;n general de acciones';
	$MULTILANG_FrmVolverLista='Volver a lista de formularios';
	$MULTILANG_FrmErr1='Debe indicar un t&iacute;tulo v&aacute;lido para el formulario.';
	$MULTILANG_FrmErr2='Debe indicar un nombre v&aacute;lido para la tabla de datos asociada al formulario.';
	$MULTILANG_FrmAgregar='Agregar nuevo formulario';
	$MULTILANG_FrmDetalles='Defina los detalles del formulario';
	$MULTILANG_FrmTitVen='T&iacute;tulo de ventana';
	$MULTILANG_FrmDesTit='Texto que aparecer&aacute; en la parte superior de la ventana de formulario o barra de t&iacute;tulo';
	$MULTILANG_FrmHlp='T&iacute;tulo de ayuda';
	$MULTILANG_FrmDesHlp='Texto que aparecer&aacute; como encabezado para el texto de ayuda del formulario';
	$MULTILANG_FrmTxt='Texto de ayuda';
	$MULTILANG_FrmDesTxt='Texto completo con la descripcion de funciones resumida para el formulario.  Puede ser cualquier texto introductorio para el usuario';
	$MULTILANG_FrmImagen='Im&aacute;gen de ayuda';
	$MULTILANG_FrmNumeroCols='N&uacute;mero columnas';
	$MULTILANG_FrmDesNumeroCols='Indica en cuantas columnas deben desplegarse los campos cuando el formulario sea cargado';
	$MULTILANG_FrmCreaDisena='Crear y dise&ntilde;ar';
	$MULTILANG_FrmTitForms='Formularios ya definidos en el sistema';
	$MULTILANG_FrmCamposAcciones='Campos y acciones';
	$MULTILANG_FrmAdvDelForm='IMPORTANTE:  Al eliminar el formulario los usuarios no podr&aacute;n accesarlo nuevamente para operaciones de consulta o ingreso de datos definidas en &eacute;l y no podr&aacute; deshacer esta operaci&oacute;n. Esto tambien elimina cualquier dise&ntilde;o interno del formulario.\n'.$MULTILANG_Confirma;
	$MULTILANG_FrmAdvDelForm='Editar scripts (avanzado)';
	$MULTILANG_FrmHlpFunciones='Todas las funciones JavaScript definidas en este espacio ser&aacute;n inclu&iacute;das al formulario cada vez que sea cargado.<br>Si requiere comportamientos adicionales o eventos especificos lanzados por medio de botones o dem&aacute;s objetos<br> en su formulario este es el espacio para definirlos.<br><b>Al utilizar comillas en parametros y funciones estas deben ser siempre dobles</b>, no simples.<br>La funci&oacute;n FrmAutoRun siempre debe existir (aunque sea vac&iacute;a) pues ser&aacute; ejecutada autom&aacute;ticamente en cada carga del Formulario.';
	
	//Informes
	$MULTILANG_InfErr1='Se debe indicar los valores para los campos correspondientes al menos a una serie de datos.<br>Si no desea generar un gr&aacute;fico entonces debe cambiar el tipo de informe a tabla de datos';
	$MULTILANG_InfErr2='Debe indicar un t&iacute;tulo v&aacute;lido para el informe.';
	$MULTILANG_InfErr3='Debe indicar un nombre v&aacute;lido para la categor&iacute;a asociada al informe.';
	$MULTILANG_InfErrCondicion='La condici&oacute;n especificada no es v&aacute;lida o carece de al menos uno de sus lados de comparaci&oacute;n.';
	$MULTILANG_InfErrCampo='Debe indicar un nombre de campo v&aacute;lida para el origen de datos del informe.';
	$MULTILANG_InfErrTabla='Debe indicar un nombre de tabla v&aacute;lida para el origen de datos del informe.';
	$MULTILANG_InfErr4='Debe indicar un t&iacute;tulo o etiqueta v&aacute;lida para el bot&oacute;n.';
	$MULTILANG_InfErr5='Debe indicar una acci&oacute;n v&aacute;lido para ser ejecutada cuando se active el control.';
	$MULTILANG_InfAgregaTabla='Agregar una nueva tabla al informe';
	$MULTILANG_InfTablaManual='Especificar tabla manualmente';
	$MULTILANG_InfDesTablaManual='En caso de no seleccionar una tabla en la parte superior puede indicar aqu&iacute; el nombre de una tabla.  Esta opci&oacuten es &uacute;til cuando requiere acceder a informaci&oacute;n contenida en tablas internas de Pr&aacute;ctico o tablas creadas mediante otras aplicaciones';
	$MULTILANG_InfAliasManual='Especificar un alias manualmente';
	$MULTILANG_InfDesAliasManual='Util para definir el nombre de una tabla generada a partir de una subconsulta o indicada manualmente';
	$MULTILANG_InfBtnAgregaTabla='Agregar tabla';
	$MULTILANG_InfTablasDef='Tablas definidas en este informe';
	$MULTILANG_InfAlias='Alias';
	$MULTILANG_InfAdvBorrado='IMPORTANTE:  Al eliminar el objeto seleccionado la consulta o informe puede ser inconsistente.\n'.$MULTILANG_Confirma;
	$MULTILANG_InfAgregaCampo='Agregar un nuevo campo al informe';
	$MULTILANG_InfCampoDatos='Campo de datos';
	$MULTILANG_InfCampoManual='Especificar campo manualmente';
	$MULTILANG_InfDesCampoManual='En caso de no seleccionar un campo en la parte superior puede indicar aqu&iacute; el nombre de un campo.  Esta opci&oacuten es &uacute;til cuando requiere acceder a informaci&oacute;n contenida en campos internos de Pr&aacute;ctico o campos creadas mediante otras aplicaciones';
	$MULTILANG_InfDesAliasManual2='Util para definir el nombre de un campo generado a partir de una subconsulta de agrupaci&oacute;n o indicado manualmente';
	$MULTILANG_InfBtnAgregaCampo='Agregar campo';
	$MULTILANG_InfCamposDef='Campos definidos en este informe';
	$MULTILANG_InfAddCondicion='Agregar una nueva condici&oacute;n al informe';
	$MULTILANG_InfPrimer='Primer campo o valor';
	$MULTILANG_InfOperador='Operador de comparaci&oacute;n';
	$MULTILANG_InfSegundo='Segundo campo o valor';
	$MULTILANG_InfMayorQue='Mayor';
	$MULTILANG_InfMenorQue='Menor';
	$MULTILANG_InfMayorIgualQue='Mayor o Igual';
	$MULTILANG_InfMenorIgualQue='Menor o Igual';
	$MULTILANG_InfDiferenteDe='Diferente';
	$MULTILANG_InfIgualA='Igual';
	$MULTILANG_InfDesManual='En cualquiera de los campos manuales puede encerrar expresiones o valores tipo cadena de caracteres utilizando comillas dobles';
	$MULTILANG_InfOperador='Agregar un agrupador de expresiones o un operador l&oacute;gico ';
	$MULTILANG_InfOpParentesisA='Abrir par&eacute;ntesis';
	$MULTILANG_InfOpParentesisC='Cerrar par&eacute;ntesis';
	$MULTILANG_InfOpAND='Y L&oacute;gico';
	$MULTILANG_InfOpOR='O L&oacute;gico';
	$MULTILANG_InfOpNOT='Negaci&oacute;n';
	$MULTILANG_InfOpXOR='O Exclusivo';
	$MULTILANG_InfTitOp='Cu&aacute;ndo utilizar esta opci&oacute;n?';
	$MULTILANG_InfDesOp='Si usted requiere agregar m&aacute;s de una sentencia a su condici&oacute;n de filtrado de resultados o si requiere agrupar varias condiciones para tener precedencia sobre algunas operaciones entonces puede utilizar esta opci&oacute;n.  Trabaja de manera independiente y debe ser agregada como un registro aparte de la consulta';
	$MULTILANG_InfReco1='Recomendaci&oacute;n';
	$MULTILANG_InfReco2='No olvide agregar operadores AND seguidos de cada condici&oacute;n que relacione llaves for&aacute;neas entre las diferentes tablas del informe cuando aplique (generalmente cuando usa m&aacute;s de una tabla).';
	$MULTILANG_InfBtnAddCondic='Agregar condicion / operador';
	$MULTILANG_InfDefCond='Condiciones definidas en este informe';
	$MULTILANG_InfTitGrafico='Especifica tipos de gr&aacute;fico a generar por el informe';
	$MULTILANG_InfSeriesGrafico1='SERIES PARA EL GRAFICO';
	$MULTILANG_InfSeriesGrafico2='Gr&aacute;ficos con m&uacute;ltiples series deben devolver el mismo n&uacute;mero de etiquetas';
	$MULTILANG_InfNomSerie='Nombre de la Serie';
	$MULTILANG_InfCampoEtiqSerie='Campo de etiqueta';
	$MULTILANG_InfCampoValor='Campo de valor (debe ser num&eacute;rico)';
	$MULTILANG_InfVistaGrafico1='APARIENCIA y DISTRIBUCION';
	$MULTILANG_InfVistaGrafico2='Seleccione de acuerdo al n&uacute;mero de series deseadas';
	$MULTILANG_InfTipoGrafico='Tipo de gr&aacute;fico';
	$MULTILANG_InfGrafico1='Barras horizontales';
	$MULTILANG_InfGrafico2='Barras horizontales (multiples series)';
	$MULTILANG_InfGrafico3='Grafico de linea';
	$MULTILANG_InfGrafico4='Grafico de linea (multiples series)';
	$MULTILANG_InfGrafico5='Barras verticales';
	$MULTILANG_InfGrafico6='Barras verticales (multiples series)';
	$MULTILANG_InfGrafico6='Grafico de torta (solo una serie)';
	$MULTILANG_InfActGraf='Actualizar formato del gr&aacute;fico';
	$MULTILANG_InfAgrupa='Especifica criterios de agrupaci&oacute;n y ordenamiento';
	$MULTILANG_InfReco3='Utilice solamente campos definidos en su consulta.';
	$MULTILANG_InfCriterioAgrupa='Criterio de agrupamiento';
	$MULTILANG_InfCriterioOrdena='Criterio de ordenamiento';
	$MULTILANG_InfTitAgrupa='Como se agrupan los resultados?';
	$MULTILANG_InfDesAgrupa='Utilice esta opcion solamente si su informe maneja operaciones como suma, promedio o conteo dentro de los campos desplegados.  Ej. SUM(campo), AVG(campo), COUNT(*).  En esos casos indique por cu&aacute;l o cuales campos separados por coma se debe agrupar los resultados';
	$MULTILANG_InfTitOrdena='Como se ordenan los resultados?';
	$MULTILANG_InfDesOrdena='Permite ordenar los resultados por alguno de los desplegados.  Indique por cu&aacute;l o cuales campos separados por coma se debe ordenar los resultados, si lo desea despu&eacute;s de cada campo puede utilizar el modificador ASC o DESC para indicar si es ascedente o descendente';
	$MULTILANG_InfActCriterios='Actualizar criterios de agrupoaci&oacute;n y ordenamiento';
	$MULTILANG_InfTitBotones='Agregar botones y acciones a cada registro';
	$MULTILANG_InfDelReg='Eliminar registro';
	$MULTILANG_InfCargaForm='Cargar un formulario por ID';
	$MULTILANG_InfHlpAccion='Si desea cargar un formulario utilice la notaci&oacute;n  ID:1:CampoBusqueda<br>Si desea eliminar el registro asociado indique la tabla.campo usada para comparar';
	$MULTILANG_InfVinculo='Campo de v&iacute;nculo';
	$MULTILANG_InfDesVinculo='IMPORTANTE: Se asumir&aacute; el primer campo o columna como de valor &uacute;nico<br>
				para realizar las operaciones de eliminaci&oacute;n o apertura de<br>
				nuevos formularios.  Se recomienda utilizar campos que realmente sean de<br>
				valor &uacute;nico a menos que se deseen operaciones grupales.';
	$MULTILANG_InfDesPeso='Posicion en la que aparece el boton dentro de los creados al lado derecho de cada registro. Orden de izquierda a derecha.';
	$MULTILANG_InfFiltrar='Filtrar los resultados mediante condiciones espec&iacute;ficas';
	$MULTILANG_InfCampoAgrupa='Permite definir campos de agrupaci&oacute;n para informes con operaciones de suma, promedio o conteo y los campos para el ordenamiento de resultados';
	$MULTILANG_InfTablasOrigen='Tablas de datos origen';
	$MULTILANG_InfCamposOrigen='Campos de datos';
	$MULTILANG_InfCondiciones='Condiciones';
	$MULTILANG_InfPropGraf='Propiedades del Gr&aacute;fico';
	$MULTILANG_InfDesGraf='Define las propiedades y apariencia del gr&aacute;fico desplegado por el informe';
	$MULTILANG_InfDesAccion='Define acciones que pueden ser ejecutadas sobre cada registro desplegado por el informe como Elimina, Abrir un formulario, funciones de usuario, etc.';
	$MULTILANG_InfVolver='Volver a lista de informes';
	$MULTILANG_InfTitulo='T&iacute;tulo del informe o gr&aacute;fico';
	$MULTILANG_InfDesTitulo='Texto que aparecer&aacute; en la parte superior del informe generado';
	$MULTILANG_InfDescripcion='Descripci&oacute;n';
	$MULTILANG_InfDesDescrip='Texto descriptivo del informe.  No aparece en su generaci&oacute;n pero es usado para orientar al usuario en su selecci&oacute;n';
	$MULTILANG_InfCategoria='Categor&iacute;a';
	$MULTILANG_InfDesCateg='Cuando el usuario tiene acceso al panel de informes del sistema estos son clasificados por categor&iacute;as.  Ingrese aqui un nombre de categor&iacute;a bajo el cual desee presentar este informe a los usuarios.';
	$MULTILANG_InfNivelUsuario='Nivel de usuario';
	$MULTILANG_InfTodoUsuario='Todos los usuarios';
	$MULTILANG_InfParam='Editar par&aacute;metros generales del informe';
	$MULTILANG_InfTitNivel='Quienes pueden ver este informe?';
	$MULTILANG_InfDesNivel='Indique el perfil de usuario que se debe tener para ver este informe como disponible.';
	$MULTILANG_InfAlto='Alto';
	$MULTILANG_InfTitAncho='Establecer ancho fijo?';
	$MULTILANG_InfDesAncho='Este valor aplica si ha especificado tambien un alto. Si requiere que el informe aparezca dentro de un marco de ancho fijo especifique su tama&ntilde;o en pixeles, deje en blanco para que se desplieguen los datos sin restricciones de tama&ntilde;o.  En el caso de los gr&aacute;ficos especifica su tama&ntilde;o de imagen.';
	$MULTILANG_InfTitAlto='Establecer alto fijo?';
	$MULTILANG_InfDesAlto='Este valor aplica si ha especificado tambien un ancho. Si requiere que el informe aparezca dentro de un marco de alto fijo especifique su tama&ntilde;o en pixeles, deje en blanco para que se desplieguen los datos sin restricciones de tama&ntilde;o.  En el caso de los gr&aacute;ficos especifica su tama&ntilde;o de imagen.';
	$MULTILANG_InfHlpAnchoalto='agregar <b>px</b> &oacute; <b>%</b> seg&uacute;n el caso';
	$MULTILANG_InfFormato='Formato final';
	$MULTILANG_InfTitFormato='Como se visualiza este informe?';
	$MULTILANG_InfDesFormato='Indica si el producto final del informe ser&aacute; un tabla de datos o un gr&aacute;fico.';
	$MULTILANG_InfActualizar='Actualizar informe';
	$MULTILANG_InfVistaPrev='Vista previa del informe';
	$MULTILANG_InfCargaPrev='Cargar vista previa';
	$MULTILANG_InfHlpCarga='Esta opci&oacute;n cerrar&aacute; el modo de dise&ntilde;o<br> y cargar&aacute; el informe tal y como ser&aacute; visualizado<br> por un usuario de la aplicaci&oacute;n';
	$MULTILANG_InfErrInforme1='Debe indicar un t&iacute;tulo v&aacute;lido para el informe.';
	$MULTILANG_InfErrInforme2='Debe indicar un nombre v&aacute;lido para la categor&iacute;a asociada al informe.';
	$MULTILANG_InfTituloAgr='Agregar nuevo informe o gr&aacute;fico';
	$MULTILANG_InfDetalles='Defina los detalles del informe/gr&aacute;fico';
	$MULTILANG_InfDefinidos='Informes/Gr&aacute;ficos ya definidos en el sistema';
	$MULTILANG_InfcamTabCond='Campos, Tablas y Condiciones';
	$MULTILANG_InfAdvEliminar='IMPORTANTE:  Al eliminar el informe los usuarios no podr&aacute;n accesarlo nuevamente para operaciones de consulta definidas en &eacute;l y no podr&aacute; deshacer esta operaci&oacute;n. Esto tambien elimina cualquier dise&ntilde;o interno del informe.\n'.$MULTILANG_Confirma;
	
	//Menus
	$MULTILANG_MnuTitEditar='Edici&oacute;n del item de menu';
	$MULTILANG_MnuSelImagen='Haga clic sobre una im&aacute;gen para seleccionarla';
	$MULTILANG_MnuPropiedad='Propiedades del item';
	$MULTILANG_MnuApariencia='CONFIGURACION DE APARIENCIA Y UBICACION';
	$MULTILANG_MnuTexto='Texto';
	$MULTILANG_MnuPadre='Padre';
	$MULTILANG_MnuSiAplica='Si aplica';
	$MULTILANG_MnuUbicacion='Ubicaci&oacute;n de esta opci&oacute;n';
	$MULTILANG_MnuArriba='Posible arriba?';
	$MULTILANG_MnuEscritorio='Posible escritorio?';
	$MULTILANG_MnuCentro='Posible en el centro?';
	$MULTILANG_MnuSeccion='Secci&oacute;n';
	$MULTILANG_MnuDesArriba='Se debe habilitar esta opci&oacute;n para ser desplegada en la barra de menu superior-horizontal?';
	$MULTILANG_MnuDesEscritorio='Se debe habilitar esta opci&oacute;n para ser desplegada como un icono en el escritorio del usuario?';
	$MULTILANG_MnuDesCentro='Se debe habilitar esta opci&oacute;n para ser desplegada en la parte central del aplicativo, dentro de ventanas clasificadas/agrupadas por el valor definido en el campo Seccion?';
	$MULTILANG_MnuDesImagen='Desplegar una lista de im&aacute;genes disponibles en el sistema';
	$MULTILANG_MnuComandos='CONFIGURACION DE COMANDOS Y ACCIONES';
	$MULTILANG_MnuClic='Posible hacer clic?';
	$MULTILANG_MnuURL='URL est&aacute;tica';
	$MULTILANG_MnuTitURL='Llevar a una URL o ejecutar un javascript?';
	$MULTILANG_MnuDesURL='Ingrese una URL completa o un comando javascript definido por javascript:comando para ser reemplazadas dentro de un HREF de un ancla generada alrededor del objeto';
	$MULTILANG_MnuTipo='Tipo de comando';
	$MULTILANG_MnuInterno='Interno';
	$MULTILANG_MnuPersonal='Personal';
	$MULTILANG_MnuObjeto='Objeto';
	$MULTILANG_MnuAccion='Acci&oacute;n interna/comando/objeto';
	$MULTILANG_MnuTitAccion='Indique uno de tres valores posibles as&iacute;';
	$MULTILANG_MnuDesAccion='1) EL OBJETO dise&ntilde;ado en Pr&aacute;ctico y al cual se quiere enlazar la opci&oacute;n mediante el formato frm:XXX &oacute; inf:XXX donde debe reemplazar XXX por el identificador &uacute;nico del objeto que se obtiene despu&eacute;s de haber sido creado (ID del formulario o del informe),  2) LA ACCION INTERNA de Pr&aacute;ctico hacia la cual debe ser direccionado el usuario (normalmente se encuentra en la parte inferior de la pantalla), &oacute; 3) COMANDO PERSONALIZADO: La secuencia de comandos definida/programada por el usuario y existente en el archivo personalizadas.php';
	$MULTILANG_MnuTitNivel='Quienes pueden ver esta opci&oacute;n?';
	$MULTILANG_MnuDesNivel='Indique el perfil de usuario que se debe tener para ver esta opci&oacute;n como disponible.';
	$MULTILANG_MnuActualiza='Actualizar menu';
	$MULTILANG_MnuErr='Se requiere el campo de texto como m&iacute;nimo.';
	$MULTILANG_MnuAdmin='Administraci&oacute;n del men&uacute; principal';
	$MULTILANG_MnuAgregar='Agregar opci&oacute;n al men&uacute;';
	$MULTILANG_MnuDefinidos='Secciones y comandos de men&uacute; definidos';
	$MULTILANG_MnuNivel='Nivel';
	$MULTILANG_MnuComando='Comando';
	$MULTILANG_MnuAdvElimina='IMPORTANTE:  Al eliminar el registro pueden quedar sin vincular algunas opciones del sistema.\n'.$MULTILANG_Confirma;

	//Objetos
	$MULTILANG_ObjError='El tipo de objeto recibido en este comando es desconocido';
	
	//Tablas
	$MULTILANG_TblError1='Problema de integridad en dise&ntilde;o';
	$MULTILANG_TblError2='ERROR DE BASE DE DATOS';
	$MULTILANG_TblError3='Durante la ejecucion el motor ha retornado el siguiente mensaje';
	$MULTILANG_TblAgrCampo='Agregar campos en la tabla de datos';
	$MULTILANG_TblAgrCampoTabla='Agregar un campo a la tabla';
	$MULTILANG_TblEntero='Entero';
	$MULTILANG_TblCadena='Cadena (longitud Hasta 255)';
	$MULTILANG_TblTexto='Texto (Ilimitado)';
	$MULTILANG_TblFecha='Fecha (sin hora)';
	$MULTILANG_TblTitNombre='Ayuda de formato para nombre del campo';
	$MULTILANG_TblDesNombre='Nombre del campo sin guiones, puntos, espacios o caracteres especiales';
	$MULTILANG_TblLongitud='Longitud';
	$MULTILANG_TblAutoinc='Autoincremento';
	$MULTILANG_TblDesLongitud='Este campo puede ser de car&aacute;cter obligatorio dependiendo del tipo de dato a ser almacenado, ejemplo campos tipo Cadena';
	$MULTILANG_TblDesLongitud2='Formato: Si alguna vez necesita poner una barra invertida (backslash) o una comilla simple entre esos valores, siempre ponga una barra invertida adicional (backslash).  Para campos enum o set, use el formato: \'a\',\'b\',\'c\'...';
	$MULTILANG_TblTitAutoinc='Alerta de clave primaria';
	$MULTILANG_TblDesAutoinc='Este valor puede ser definido solamente por administradores avanzados que han suprimido por alg&uacute;n motivo el autoincremento del campo Id predeterminado';
	$MULTILANG_TblNulos='Permitir valor nulo?';
	$MULTILANG_TblDefUsuario='Definido por el usuario';
	$MULTILANG_TblNulo='Nulo';
	$MULTILANG_TblFechaHora='Fecha y hora actual';
	$MULTILANG_TblDesPredet='Formato: S&oacute;lo un valor, sin caracteres de escape.  Para cadenas de caracteres utilice comillas simples al principio y al final';
	$MULTILANG_TblAgregando='Agregar el campo';
	$MULTILANG_TblAlFinal='Al final de todos los campos';
	$MULTILANG_TblDespuesDe='Despu&eacute;s de';
	$MULTILANG_TblCamposDef='Campos ya definidos en la tabla';
	$MULTILANG_TblTipoClave='Tipo clave';
	$MULTILANG_TblNoElim='No Puede Eliminarse';
	$MULTILANG_TblAdvDelCampo='IMPORTANTE:  Al eliminar la columna seleccionada de la tabla se eliminar&aacute;n tambi&eacute;n todos los datos en ella almacenados y luego no podr&aacute; deshacer esta operaci&oacute;n.\n'.$MULTILANG_Confirma;
	$MULTILANG_TblErrDel1='Error eliminando tabla de datos!';
	$MULTILANG_TblErrDel2='La tabla especificada no se puede eliminar.  Algunas causas comunes son:<br><li>La es utilizada por alguno de los formularios o informes autom&aacute;ticos, en ese caso puede intentar editarla.<br><li>La tabla cuenta con relaciones definidas por el dise&ntilde;ador hacia otras tablas de datos.<br><li>El rol de usuario definido para el usuario con sesi&oacute;n activa no permite eliminar objetos en DynApps';
	$MULTILANG_TblErrCrear='Debe indicar un nombre v&aacute;lido para la tabla.  Este no debe contener guiones, puntos, espacios o caracteres especiales';
	$MULTILANG_TblCrearListar='Crear/Listar tablas de datos definidias en el sistema';
	$MULTILANG_TblCreaTabla='Crear una nueva tabla en la base de datos';
	$MULTILANG_TblDesTabla='Una tabla de datos es una estrctura que le permite almacenar informaci&oacute;n. Ingrese en este espacio el nombre de la tabla sin guiones, puntos, espacios o caracteres especiales. SENSIBLE A MAYUSCULAS';
	$MULTILANG_TblCreaTabCampos='Crear tabla y definir campos';
	$MULTILANG_TblTitAsis='Utilizar asistente?';
	$MULTILANG_TblDesAsis='Permite seleccionar desde algunas tablas comunes predefinidas';
	$MULTILANG_TblTablasBD='Tablas definidas en la base de datos';
	$MULTILANG_TblRegistros='Registros';
	$MULTILANG_TblAdvDelTabla='IMPORTANTE:  Al eliminar la tabla de datos se eliminar&aacute;n tambi&eacute;n todos los registros en ella almacenados y luego no podr&aacute; deshacer esta operaci&oacute;n.\n'.$MULTILANG_Confirma;
	$MULTILANG_TblErrPlantilla='Debe seleccionar una plantilla desde la cual desea crear su nueva tabla';
	$MULTILANG_TblAsistente='Asistente para generaci&oacute;n de tablas';
	$MULTILANG_TblAsistNombre='Nombre para la nueva tabla';
	$MULTILANG_TblAsistPlant='Plantilla de tabla seleccionada';
	$MULTILANG_TblAsCampos='Campos que contiene';
	$MULTILANG_TblTotCampos='Total campos';
	$MULTILANG_TblHlpAsist='Todas las tablas y sus campos podr&aacute;n ser personalizados en el siguiente paso,<br> agregando, eliminando o cambiando las propiedades de aquellos que desee.';
	
	//Usuarios
	$MULTILANG_UsrCopia='Copia de permisos finalizada.  Por favor verifique a continuacion.';
	$MULTILANG_UsrDesPW='Las contrase&ntilde;as con condiciones m&iacute;nimas de seguridad deben tener una longitud de <b>al menos 8 caracteres</b>, n&uacute;meros, letras en may&uacute;scula y en min&uacute;scula o s&iacute;mbolos como <font color=yellow>! # $ % & - *</font>.  Para que su contrase&ntilde;a sea considerada segura por este sistema <b>debe cumplir al menos con un nivel de seguridad del 81%</b>';
	$MULTILANG_UsrCambioPW='Cambio de contrase&ntilde;a';
	$MULTILANG_UsrAnteriorPW='Contrase&ntilde;a anterior';
	$MULTILANG_UsrNuevoPW='Nueva contrase&ntilde;a';
	$MULTILANG_UsrNivelPW='Nivel de seguridad';
	$MULTILANG_UsrVerificaPW='Verificar contrase&ntilde;a';
	$MULTILANG_UsrHlpNoPW='El motor de autenticaci&oacute;n definido para la herramienta es de tipo externo.<br>
				El cambio de clave se encuentra deshabilitado pues debe ser gestionado de manera centralizada<br>
				por usted en la herramienta definida por el administrador de sistemas';
	$MULTILANG_UsrErrPW1='Usted ha olvidado ingresar alguno de los datos solicitados';
	$MULTILANG_UsrErrPW2='Usted ha ingresado dos contrase&ntilde;as diferentes';
	$MULTILANG_UsrErrPW3='La clave por usted ingresada no cumple con las recomendaciones minimas de seguridad';
	$MULTILANG_UsrErrInf='El usuario ya posee el permiso seleccionado';
	$MULTILANG_UsrAdmInf='Administraci&oacute;n de informes del usuario';
	$MULTILANG_UsrAgreInf='Agregar informe al men&uacute; del usuario';
	$MULTILANG_UsrInfDisp='Informes ya disponibles';
	$MULTILANG_UsrAdvDel='IMPORTANTE:  Al eliminar el registro pueden quedar sin vincular algunas opciones del sistema para este usuario.\n'.$MULTILANG_Confirma;
	$MULTILANG_UsrAdmPer='Administraci&oacute;n de permisos del usuario';
	$MULTILANG_UsrCopiaPer='Copiar inicialmente los permisos desde el usuario';
	$MULTILANG_UsrDelPer='Solamente borrar permisos';
	$MULTILANG_UsrAgreOpc='Agregar opci&oacute;n al men&uacute; del usuario';
	$MULTILANG_UsrSecc='Secciones ya disponibles';
	$MULTILANG_UsrErrCrea1='El usuario ingresado ya existe, por favor verifique o cambie el login ingresado para la cuenta e intente de nuevo';
	$MULTILANG_UsrErrCrea2='Usted ha olvidado ingresar alguno de los datos solicitados como obligatorios: Nombre, Login o Clave';
	$MULTILANG_UsrErrCrea3='La contrase&ntilde;a ingresada debe tener al menos seis caracteres';
	$MULTILANG_UsrAdicion='Adici&oacute;n de usuarios';
	$MULTILANG_UsrLogin='NickName / Login';
	$MULTILANG_UsrDesLogin='Login &uacute;nico para identificar el usuario en el sistema. SENSIBLE A MAYUSCULAS';
	$MULTILANG_UsrNombre='Nombre completo';
	$MULTILANG_UsrTitCorreo='Direcci&oacute;n para alertas y notificaciones';
	$MULTILANG_UsrDesCorreo='Direcci&oacute;n electr&oacute;nica de posible uso para notificaciones autom&aacute;ticas del sistema en algunos m&oacute;dulos';
	$MULTILANG_UsrEstado='Estado inicial';
	$MULTILANG_UsrNivel='Nivel de acceso';
	$MULTILANG_UsrTitNivel='Perfil inicial de seguridad';
	$MULTILANG_UsrDesNivel='Perfil de seguridad del usuario.  CUIDADO:  Esta opci&oacute;n es diferente a los permisos individuales de usuario definidos por el disenador para los objetos por el creados.  Este perfil solamente aplica para las operaciones internas de Pr&aacute;ctico';
	$MULTILANG_UsrAudit1='Seguimiento de operaciones (actualizando autom&aacute;ticamente cada 5 segundos)';
	$MULTILANG_UsrAudDes='Descripci&oacute;n de la acci&oacute;n';
	$MULTILANG_UsrAudUsrs='Seguimiento de operaciones para todos los usuarios';
	$MULTILANG_UsrAudAccion='Con la siguiente <b>acci&oacute;n</b>';
	$MULTILANG_UsrAudUsuario='para el <b>usuario </b>';
	$MULTILANG_UsrAudDesde='Desde (Dia / Mes)';
	$MULTILANG_UsrAudHasta='hasta';
	$MULTILANG_UsrAudAno='Consultando auditoria del a&ntilde;o';
	$MULTILANG_UsrAudIniReg='Iniciar en el registro';
	$MULTILANG_UsrAudVisual='Visualizando';
	$MULTILANG_UsrAudMonit='Modo de monitoreo';
	$MULTILANG_UsrAudHisto='Historial de operaciones del usuario (de la m&aacute;s reciente a la mas antigua)';
	$MULTILANG_UsrLista='Listado de usuarios en el sistema';
	$MULTILANG_UsrLisNombre='Ver s&oacute;lo los usuarios cuyo<strong> nombre</strong> contenga';
	$MULTILANG_UsrLisLogin='Ver s&oacute;lo los usuarios cuyo <strong>login</strong> contenga';
	$MULTILANG_UsrFiltro='Debido a la cantidad de usuarios registrados usted debe filtrar el resultado.<br>
				Indique el tipo de filtro deseado en la parte superior y haga clic en el bot&oacute;n correspondiente.';
	$MULTILANG_UsrAcceso='Ultimo acceso';
	$MULTILANG_UsrAdvSupr='IMPORTANTE:  Est&aacute; a punto de eliminar el usuario y perder vinculos hacia registros asociados a este, no podr&aacute;n recuperarse esta accion a menos que usted recree el usuario con las mismas credenciales posteriormente.\n'.$MULTILANG_Confirma;
	$MULTILANG_UsrAddMenu='Agregar Men&uacute;es';
	$MULTILANG_UsrAddInfo='Agregar Informes';
	$MULTILANG_UsrAuditoria='Auditor&iacute;a';
	$MULTILANG_UsrAgregar='Agregar un usuario';
	$MULTILANG_UsrVerAudit='Ver auditoria de usuarios';

	//Proceso de instalacion
	$MULTILANG_Instalacion='Proceso de instalaci&oacute;n';
	$MULTILANG_SubtituloPractico1='Generador de Aplicaciones WEB';
	$MULTILANG_SubtituloPractico2='Libre y multiplataforma';
	$MULTILANG_InstaladorAplicacion='Instalador de aplicaci&oacute;n';
	$MULTILANG_BienvenidaInstalacion='Bienvenido al proceso de instalaci&oacute;n';
	$MULTILANG_BienvenidaDescripcion='Este asistente le guiar&aacute; en cada paso de las configuraciones iniciales para el uso de Pr&aacute;ctico como un entorno visual para el desarrollo de aplicaciones web';
	$MULTILANG_ResumenLicencia='Esta herramienta es liberada bajo licencia GNU-GPL v2';
	$MULTILANG_AmpliacionLicencia='Una copia en l&iacute;nea de esta licencia puede ser encontrada en diferentes formatos e idiomas en el <a href="http://www.gnu.org/licenses/gpl-2.0.html">sitio web de la GNU</a>';
	$MULTILANG_ChequeoPreprocesador='Chequeo configuraci&oacute;n de preprocesador';
	$MULTILANG_VistaPreprocesador='Una vista de su configuraci&oacute;n de PHP se encuentra disponible en <b><a target="_blank" href="paso_i.php">[este enlace]</a>';
	$MULTILANG_CumplirRequisitos='Debe cumplir con lo siguiente';
	$MULTILANG_CumplirPDO='Extensi&oacute;n PDO activada';
	$MULTILANG_CumplirDrivers='Driver PDO para el tipo de base de datos deseada';
	$MULTILANG_CumplirGD='Extensi&oacute;n GD 2+ para manipulaci&oacute;n de gr&aacute;ficos y su soporte para FreeType 2+';
	$MULTILANG_ChequeoDirectorios1='Chequeo de directorios';
	$MULTILANG_ChequeoDirectorios2='Los siguientes archivos y directorios deben contar con permisos de escritura para que el aplicativo	pueda operar correctamente';
	$MULTILANG_ErrorEscritura='<b>Se han encontrado errores al tratar de escribir en los directorios de instalaci&oacute;n !!!</b>:<br>Las rutas indicadas deben pertenecer al usuario del webserver que ejecuta los scripts de Pr&aacute;ctico (generalmente apache<br>www, www-data u otro similar) y contar con permisos 755 para el caso de carpetas y 644 para los archivos.<br>Una forma r&aacute;pida de actualizar estos permisos puede ser ejecutando desde la raiz de Pr&aacute;ctico los comandos:<li>find . -type d -exec chmod 755 {} \;  &nbsp;&nbsp;(cambiar&aacute; todos los permisos de carpetas)<li>find . -type f -exec chmod 644 {} \;  &nbsp;&nbsp;(cambiar&aacute; todos los permisos de archivos)<li>chown -R www-data *  &nbsp;&nbsp;(asumiendo que www-data es el usuario que corre el servicio web)';
	$MULTILANG_ProbarNuevamente='Probar de nuevo';
	$MULTILANG_ConfiguracionDescripcion='Indique la configuraci&oacute;n deseada para el almacenamiento de aplicaciones e informaci&oacute;n de usuario generada por Pr&aacute;ctico, as&iacute; como otras opciones importantes de la herramienta.  Esta ventana ser&aacute; presentada s&oacute;lo una vez as&iacute; que aseg&uacute;rese de diligenciar y confirmar toda la informaci&oacute;n requerida';
	$MULTILANG_PuertoNoPredeterminado='(si no es el predeterminado)';
	$MULTILANG_AyudaTitMotor='MySQL y MariaDB';
	$MULTILANG_AyudaDesMotor='Son los motores oficiales.  Sobre ellos se hace el desarrollo y pruebas de la herramienta y aunque gracias a PDO usted podr&aacute; utilizar la herramienta en otros motores es probable que deba hacer ajustes a operaciones espec&iacute;ficas de &eacute;stos.';
	$MULTILANG_AyudaTitBD='La base de datos debe existir previamente';
	$MULTILANG_AyudaDesBD='Para motores diferentes a SQLite usted debe haber creado primero la base de datos.  Para SQLite solamente requiere especificar el nombre del archivo asociado a la BD (ej. practico.sqlite3) y Practico intentara crearlo por usted siempre y cuando tenga los permisos adecuados sobre su servidor web.';
	$MULTILANG_PrefijoCore='Prefijo tablas internas de Pr&aacute;ctico';
	$MULTILANG_PrefijoApp='Prefijo tablas de Aplicaci&oacute;n';
	$MULTILANG_AyudaTitPreCore='Se recomienda NO vac&iacute;o Ni Mayusculas';
	$MULTILANG_AyudaDesPreCore='';
	$MULTILANG_AyudaTitPreApp='Importante';
	$MULTILANG_AyudaDesPreApp='El prefijo utilizado para las tablas de aplicaci&oacute;n puede ser utilizado para separar diferentes instalaciones de Pr&aacute;ctico sobre una misma base de datos o tambi&eacute;n puede ser dejado vac&iacute;o para enlazar/integrar a Pr&aacute;ctico con otras aplicaciones pre-existentes. No se recomienda mayusculas para compatibilidad entre motores.';
	$MULTILANG_AyudaLlave='valor para firmar cuentas de usuario';
	$MULTILANG_NotasImportantesInst1='<u>IMPORTANTE 1</u>: La base de datos debe existir previamente para que Pr&aacute;ctico pueda conectarse a ella y generar las estructuras requeridas.  Consulte con su proveedor de hosting o administrador de sistemas c&oacute;mo crear una base de datos con privilegios suficientes para trabajar con Pr&aacute;ctico.<br><br><u>IMPORTANTE 2</u>: El instalador eliminar&aacute; todas las tablas existentes sobre la base de datos indicada y que coincidan con los nombres de tablas que utilizar&aacute; Pr&aacute;ctico.  Si usted considera que puede tener informaci&oacute;n importante en ellas se recomienda realizar una copia de seguridad antes de continuar.  Si desea compartir una misma base de datos entre diferentes instalaciones de Pr&aacute;ctico puede cambiar los prefijos de tabla utilizados por cada una.';
	$MULTILANG_ParametrosApp='Par&aacute;metros para su primera aplicaci&oacute;n';
	$MULTILANG_ParamNombreEmpresa='Nombre corto de su Organizaci&oacute;n o empresa';
	$MULTILANG_ParamNombreApp='Nombre de su aplicaci&oacute;n';
	$MULTILANG_ParamVersionApp='Versi&oacute;n inicial de su aplicaci&oacute;n';
	$MULTILANG_AyudaTitNomEmp='Nombre a desplegar en la parte superior';
	$MULTILANG_AyudaDesNomEmp='Este texto ser&aacute; utilizado en informes y espacios de la aplicaci&oacute;n que requieran un nombre corto para identificar su organizaci&oacute;n.';
	$MULTILANG_AyudaTitNomApp='Nombre descriptivo';
	$MULTILANG_AyudaDesNomApp='El nombre especificado aparecer&aacute; siempre en la parte superior de su aplicaci&oacute;n.';
	$MULTILANG_NotasImportantesInst2='<u>IMPORTANTE</u>: Otros parametros como nombre largo y corto de su empresa, fecha de lanzamiento, textos de licencia y creditos podran ser modificados posteriormente mediante las opciones disponibles para el usuario administrador.';
	$MULTILANG_AyudaTitCaptcha='Longitud de la palabra';
	$MULTILANG_AyudaDesCaptcha='Indica el n&uacute;mero de s&iacute;mbolos utilizados en la palabra de seguridad que deben ingresar los usuarios para cada acceso al sistema.';
	$MULTILANG_ModoDepuracion='Activar modo de depuraci&oacute;n?';
	$MULTILANG_AyudaTitDebug='Presentar errores y advertencias';
	$MULTILANG_AyudaDesDebug='Para sitios en producci&oacute;n esta opci&oacute;n debe estar apagada.  Cuando se enciende ense&ntilde;a durante la ejecuci&oacute;n de la aplicaci&oacute;n todos los errores y mensajes que puedan ser generados por el preprocesador de hipertexto - PHP';
	$MULTILANG_MotorAuth='Motor de autenticaci&oacute;n';
	$MULTILANG_AuthPractico='Interno (Tablas propias de Pr&aacute;ctico usando MD5)';
	$MULTILANG_AuthLDAP='LDAP (Servidor de directorio)';
	$MULTILANG_AyudaDesAuth='El uso de un motor de autenticaci&oacute;n diferente a Pr&aacute;ctico no excluye la creaci&oacute;n de los usuarios sobre la herramienta.  El motor externo servira como metodo para validar el login y clave correspondiente como un m&eacute;todo de autenticaci&oacute;n centralizado; pero el resto de caracter&iacute;sticas del perfil ser&aacute;n tomadas desde el usuario Pr&aacute;ctico.  El cambio de contrase&ntilde;a en Pr&aacute;ctico ser&aacute; deshabilitado para que sea controlada solamente por el motor externo.  El usuario admin seguir&aacute; siendo siempre aut&oacute;nomo para no perder control de acceso por errores de configuraci&oacute;n.';
	$MULTILANG_AyudaTitCript='Tipo de encripcion de claves usado por el motor';
	$MULTILANG_AyudaDesCript='Especifique el tipo de encripcion utilizado por el sistema de autenticacion que va a utilizar.  Pr&aacute;ctico encriptar&aacute; el valor de clave ingresado por el usuario antes de enviarla al motor a verificaci&oacute;n.';
	$MULTILANG_AlgoritmoCripto='Algoritmo de encripci&oacute;n';
	$MULTILANG_Dominio='Dominio';
	$MULTILANG_UO='Unidad organizacional o contexto';
	$MULTILANG_AyudaDesLdapIP='Indique la direccion IP del servidor de directorio o su nombre en caso de poder ser resuelto.';
	$MULTILANG_AyudaDesLdapDominio='Dominio utilizado por el servidor. Ejemplo: midominio.com.co  Con esto sera creada la cadena interna dc=midominio,dc=com,dc=co';
	$MULTILANG_AyudaDesLdapUO='Contexto de conexion del usuario. Debe existir sobre el servidor LDAP, ej: people, ventas, mercadeo, etc';
	$MULTILANG_TitInsPaso3='Escribiendo configuraci&oacute;n y conectando Base de Datos';
	$MULTILANG_DesInsPaso3='Se esta escribiendo el archivo de configuracion.php ubicado en /core con los par&aacute;metros por usted indicados y se est&aacute; probando la conexi&oacute;n a la base de datos indicada.';
	$MULTILANG_ErrorEscribirConfig='<b>Se han encontrado errores al tratar de escribir el archivo de configuraci&oacute;n !!!</b>:<br>Si lo desea una alternativa puede ser cambiar usted mismo los valores por defecto incluidos en el archivo core/configuracion.php.<br><br>Tambi&eacute;n puede cambiar los permisos al archivo de configuraci&oacute;n y probar nuevamente con este asistente.';
	$MULTILANG_ErrorConexBD='<b>Se han encontrado errores al conectar con la Base de Datos !!!</b>:<br>Verifique los valores ingresados en el paso anterior e intente nuevamente.';
	$MULTILANG_InfoPaso3='<b>Todo parace estar bien con su configuraci&oacute;n b&aacute;sica de PDO.</b><br>El ultimo paso consiste en indicar al asistente de instalaci&oacute;n como tratar su base de datos:<br><br>
				<li><b>1.</b> Agregar datos de inicio a la base de datos, esto incluye el usuario inicial (admin), menues y dem&aacute;s registros sobre las tablas Core de Pr&aacute;ctico.  Esta es la mejor opci&oacute;n para las instalaciones nuevas.
				<li><b>2.</b> Dejar la base de datos como est&aacute;, lo que indica que no debe ser ejecutada ninguna operaci&oacute;n sobre la base de datos.  Esta opci&oacute;n es &uacute;til cuando se intenta hacer una instalaci&oacute;n sobre una base de datos existente que contiene aplicaciones dise&ntilde;adas y usuarios activos.  Tambi&eacute;n puede entenderse como una base de datos en blanco para instalaciones nuevas que no tendr&aacute; siquiera usuarios para accesar ni opciones para seleccionar.';
	$MULTILANG_BtnAplicarBD='1. Agregar info inicial a la BD';
	$MULTILANG_BtnNoAplicarBD='2. No modificar la BD conectada';
	$MULTILANG_ExeScripts='Ejecutando scripts de base de datos (si aplica)';
	$MULTILANG_ErrorScripts='Error ejecutando la consulta sobre la base de datos';
	$MULTILANG_IrInstalacion='Ir a su instalaci&oacute;n de Pr&aacute;ctico';
	$MULTILANG_Totalejecutado='Total consultas ejecutadas';
	$MULTILANG_MsjFinal1='Si esta es una instalaci&oacute;n nueva puede ingresar al sistema mediante las credenciales<b> admin/admin</b> y cambiarlas luego por las que usted desee.';
	$MULTILANG_MsjFinal2='Recuerde eliminar por completo el directorio de instalaci&oacute;n (carpeta /ins)</b></u> para evitar que otra persona ejecute nuevamente estos scripts sobre un sistema en producci&oacute;n pudiendo ocasionar alg&uacute;n tipo de da&ntilde;o.';
	$MULTILANG_MsjFinal2='Resumen de operaciones ejecutadas';
?>
