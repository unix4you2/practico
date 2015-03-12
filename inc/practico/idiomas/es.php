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
	$MULTILANG_DescripcionIdioma='Espanol - Spanish';

	//Lexico general (palabras y frases comunes a varios modulos)
	$MULTILANG_Accion='Accion';
	$MULTILANG_Actualizacion='Actualizaci&oacute;n';
	$MULTILANG_Actualizar='Actualizar';
    $MULTILANG_Administre='Administre';
	$MULTILANG_Agregar='Agregar';
	$MULTILANG_Anonimo='An&oacute;nimo';
	$MULTILANG_Anterior='Anterior';
	$MULTILANG_Apagado='Apagado';
	$MULTILANG_Aplicacion='Aplicaci&oacute;n';
    $MULTILANG_Aplicando='Aplicando';
	$MULTILANG_Asistente='Asistente';
	$MULTILANG_Atencion='Atenci&oacute;n';
	$MULTILANG_Ayuda='Ayuda';
	$MULTILANG_Basedatos='Base de datos';
	$MULTILANG_Basicos='B&aacute;sicos';
    $MULTILANG_BarraHtas='Barra de herramientas';
    $MULTILANG_Buscar='Buscar';
	$MULTILANG_Campo='Campo';
	$MULTILANG_Cancelar='Cancelar';
	$MULTILANG_Capturar='Capturar';
	$MULTILANG_CaracteresCaptcha='N&uacute;mero de caracteres para captcha?';
    $MULTILANG_Cargando='Cargando';
	$MULTILANG_Cerrar='Cerrar';
	$MULTILANG_CerrarSesion='Cerrar sesi&oacute;n';
	$MULTILANG_Cliente='Cliente';
	$MULTILANG_CodigoBarras='C&oacute;digo de barras';
	$MULTILANG_Columna='Columna';
	$MULTILANG_Comando='Comando';
	$MULTILANG_ConfiguracionGeneral='Configuraci&oacute;n General';
	$MULTILANG_ConfiguracionVarias='Configuraci&oacute;n de opciones varias';
	$MULTILANG_Confirma='Est&aacute; seguro que desea continuar ?';
	$MULTILANG_Continuar='Continuar';
	$MULTILANG_Contrasena='Contrase&ntilde;a';
	$MULTILANG_Controlador='Controlador';
    $MULTILANG_Copias='Copias de seguridad';
	$MULTILANG_Correcto='Correcto';
	$MULTILANG_Correo='Correo';
	$MULTILANG_Cualquiera='Cualquiera';
	$MULTILANG_Defina='Defina';
	$MULTILANG_Descargar='Descargar';
    $MULTILANG_Deshabilitado='Deshabilitado';
    $MULTILANG_Desplazar='Desplazar';
	$MULTILANG_Detalles='Detalles';
	$MULTILANG_Disene='Dise&ntilde;e';
	$MULTILANG_Editar='Editar';
	$MULTILANG_Ejecutar='Ejecutar';
	$MULTILANG_Eliminar='Eliminar';
	$MULTILANG_Embebido='Embebido';
	$MULTILANG_Encendido='Encendido';
	$MULTILANG_Error='Error';
	$MULTILANG_Escritorio='Escritorio';
    $MULTILANG_Estado='Estado';
	$MULTILANG_Etiqueta='Etiqueta';
    $MULTILANG_Explorar='Explorar';
	$MULTILANG_Fecha='Fecha';
	$MULTILANG_Finalizado='Finalizado';
    $MULTILANG_Filtro='Filtro';
	$MULTILANG_Formularios='Formularios';
	$MULTILANG_Funciones='Funciones preautorizadas';
	$MULTILANG_FuncionesDes='Por motivos de seguridad, sus funciones personalizadas o modulos desarrollados usted debe preautorizar su uso en este cuadro para los usuarios.  Agregue las funciones o acciones separadas por cualqueir caracter.';
	$MULTILANG_Grande='Grande';
	$MULTILANG_Grafico='Gr&aacute;fico';
	$MULTILANG_Guardar='Guardar';
	$MULTILANG_Habilitado='Habilitado';
	$MULTILANG_Habilitar='Habilitar';
    $MULTILANG_Historico='Hist&oacute;rico';
	$MULTILANG_Hora='Hora';
	$MULTILANG_IdiomaPredeterminado='Idioma predeterminado';
	$MULTILANG_Imagen='Imagen';
	$MULTILANG_Importante='Importante';
	$MULTILANG_InfoAdicional='Informaci&oacute;n adicional';
	$MULTILANG_Informes='Informes';
	$MULTILANG_Ingresar='Ingresar';
	$MULTILANG_Instante='Instante';
    $MULTILANG_Ir='Ir';
	$MULTILANG_IrEscritorio='Ir a mi escritorio';
	$MULTILANG_LlavePaso='Llave de paso';
	$MULTILANG_Maquina='Maquina';
	$MULTILANG_Matriz='Matriz';
	$MULTILANG_Mostrando='Mostrando';
    $MULTILANG_MotorBD='Motor de Base de Datos';
	$MULTILANG_Ninguno='Ninguno';
	$MULTILANG_No='No';
	$MULTILANG_Nombre='Nombre';
	$MULTILANG_NombreRAD='Nombre RAD';
	$MULTILANG_OlvideClave='Olvid&eacute; mi clave';
    $MULTILANG_Opcional='Opcional';
    $MULTILANG_Opcion='Opci&oacute;n';
	$MULTILANG_OpcionesMenu='Opciones de menu';
	$MULTILANG_Otros='Otros';
	$MULTILANG_Pagina='Pagina';
	$MULTILANG_ParamApp='Par&aacute;metros de aplicaci&oacute;n';
	$MULTILANG_Paso='Paso';
	$MULTILANG_Peso='Peso';
	$MULTILANG_Pequeno='peque&ntilde;o';
    $MULTILANG_Pestana='Pesta&ntilde;a';
	$MULTILANG_Predeterminado='Predeterminado';
    $MULTILANG_Previo='Previo';
    $MULTILANG_Primero='Primero';
	$MULTILANG_Procesando='Procesando';
    $MULTILANG_ProcesoFin='Proceso finalizado';
	$MULTILANG_Puerto='Puerto';
	$MULTILANG_Registrarme='Registrarme';
    $MULTILANG_Regresar='Regresar';
    $MULTILANG_Resultados='Resultados';
    $MULTILANG_SaltarLinea='Saltar a l&iacute;nea';
    $MULTILANG_Si='Si';
	$MULTILANG_Siguiente='Siguiente';
    $MULTILANG_Seleccionar='Seleccionar';
    $MULTILANG_SeleccioneUno='Seleccione uno';
    $MULTILANG_Servidor='Servidor';
	$MULTILANG_Suspender='Suspender';
	$MULTILANG_Tablas='Tablas';
	$MULTILANG_TablaDatos='Tabla de datos';
	$MULTILANG_TiempoCarga='Tiempo de carga';
	$MULTILANG_Tipo='Tipo';
	$MULTILANG_TipoMotor='Tipo de motor';
	$MULTILANG_Titulo='T&iacute;tulo';
	$MULTILANG_TotalRegistros='Total registros encontrados';
	$MULTILANG_Ultimo='Ultimo';
    $MULTILANG_Usuario='Usuario';
	$MULTILANG_Vacio='Vac&iacute;o';
	$MULTILANG_Version='Versi&oacute;n';
	$MULTILANG_ZonaHoraria='Zona horaria';
	$MULTILANG_VistaImpresion='Vista de impresion';
	$MULTILANG_IDGABeacon='ID Google Analytics';
	$MULTILANG_AyudaGABeacon='Aquellos desarrolladores que deseen tener un seguimiento historico detallado o incluso en tiempo real del uso de su herramienta a traves de Google Analytics pueden diligenciar aqui el ID obtenido en su panel de Google.  Practico reportara todo movimiento a su panel de Analytics';
	
	//Ventana de login
	$MULTILANG_TituloLogin='Ingreso al sistema';
	$MULTILANG_CodigoSeguridad='Codigo de seguridad';
	$MULTILANG_IngreseCodigoSeguridad='Ingrese el codigo';
	$MULTILANG_AccesoExclusivo='El acceso a este software es exclusivo para usuarios registrados. Por su seguridad, nunca comparta su nombre de usuario y contrase&ntilde;a.';
	$MULTILANG_LoginNoWSTit='Error tratando de alcanzar el webservice de autenticacion';
	$MULTILANG_LoginNoWSDes='La funcion file_get_contents() no puede cargar correctamente el archivo XML generado por el web service de autenticacion de Practico.<br>  Verifique la instalacion de su servidor web para validar que la funcion opera correctamente y sin restricciones.<br>  Una forma de validar si el proceso de autenticacion es correcto pero es su servidor quien no deja abrir el resultado<br>es abriendo el siguiente enlace y viendo si carga correctamente el XML.<br>  Activar el modo de depuracion en la configuracion de Practico puede ayudar a ver mas detalles.';
	$MULTILANG_OauthLogin='Iniciar con mi red social';
	$MULTILANG_LoginClasico='Usar mi cuenta Practico';
	$MULTILANG_LoginOauthDes='<b>Redes sociales y proveedores externos disponibles</b><br>Haga clic sobre el logo para ingresar usando las credenciales de su sitio favorito.';

	//Banderas de campos en formularios
	$MULTILANG_TitValorUnico='El valor ingresado no acepta duplicados';
	$MULTILANG_DesValorUnico='El sistema validar&aacute; la informaci&oacute;n ingresada en este campo, en caso de ya existir en la base de datos no se permitir&aacute; su ingreso.';
	$MULTILANG_TitObligatorio='Campo obligatorio';
	$MULTILANG_DesObligatorio='Este campo ha sido marcado como obligatorio.  Si no se ingresa un valor para &eacute;ste el sistema no almacenar&aacute; el registro ingresado por el usuario.';

	//Errores y avisos varios
	$MULTILANG_TituloInsExiste='ATENCION: La carpeta de instalaci&oacute;n existe en el servidor';
	$MULTILANG_TextoInsExiste='Este mensaje aparecer&aacute; de manera permanente a todos sus usuarios mientras usted no elimine el directorio utilizado durante el proceso de instalaci&oacute;n de Pr&aacute;ctico.  Es fundamental que la carpeta sea eliminada despu&eacute;s de finalizar una instalaci&oacute;n para evitar que algun usuario an&oacute;nimo inicie nuevamente el proceso sobreescribiendo archivos de configuraci&oacute;n o bases de datos con informaci&oacute;n de importancia para usted.<br><br>Si ya ha finalizado un proceso de instalaci&oacute;n de Pr&aacute;ctico para su uso en producci&oacute;n es importante que elimine esta carpeta antes de continuar.  Si no desea eliminar esta carpeta puede optar por renombrarla en instalaciones temporales o de prueba.<br><br>Si est&aacute; visualizando este mensaje al ejecutar este script por primera vez y desea realizar una instalaci&oacute;n nueva, puede iniciar el asistente haciendo <a class="btn btn-primary btn-xs" href="javascript:document.location=\'ins\';"><i class="fa fa-rocket"></i> Clic AQUI</a> ';
	$MULTILANG_ErrorTiempoEjecucion='Error en tiempo de ejecucion';
	$MULTILANG_ErrorModulo='El modulo central esta tratando de incluir un modulo ubicado en <b>mod/</b> pero no encuentra su punto de accceso.<br>Verifique el estado del m&oacute;dulo, consulte con su administrador o elimine el m&oacute;dulo en conflicto para evitar este mensaje.';
	$MULTILANG_ContacteAdmin='Contacte con el administrador de su sistema y comunique este mensaje.';
	$MULTILANG_ReinicieWeb='Por favor haga los ajustes requeridos y reinicie su servicio web.';
	$MULTILANG_PHPSinSoporte='Su instalacion de PHP parece no tener soporte';
	$MULTILANG_ErrExtension='Extensi&oacute;n PHP faltante, sin activar o Modulo requerido';
	$MULTILANG_ErrLDAP=$MULTILANG_PHPSinSoporte.' para LDAP activado para ser usado como metodo de autenticacion externa.<br>'.$MULTILANG_ReinicieWeb.'.<br>La autenticaci&oacute;n del usuario admin seguir&aacute; siendo independiente para evitar p&eacute;rdida de acceso.';
	$MULTILANG_ErrHASH=$MULTILANG_PHPSinSoporte.' para HASH activado.<br>Este se requiere cuando es seleccionado un tipo de encripci&oacute;n diferente al plano para contrase&ntilde;as sobre motores de autenticaci&oacute;n externos.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrSESS=$MULTILANG_PHPSinSoporte.' para sesiones activado. '.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrGD=$MULTILANG_PHPSinSoporte.' para librer&iacute;a gr&aacute;fica GD &oacute; GD2 activado.<br>Aquellos utilizando debian, ubuntu o sus derivados pueden intentar un <b>apt-get install php5-gd</b> para agregarlo.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrCURL=$MULTILANG_PHPSinSoporte.' para librer&iacute;a cURL activado.<br>Aquellos utilizando debian, ubuntu o sus derivados pueden intentar un <b>apt-get install php5-curl</b> para agregarlo.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrSimpleXML=$MULTILANG_PHPSinSoporte.' para librer&iacute;a SimpleXML activado.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrPDO=$MULTILANG_PHPSinSoporte.' para PDO activado.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrDriverPDO=$MULTILANG_PHPSinSoporte.' para PDO activado. '.$MULTILANG_ReinicieWeb;
	$MULTILANG_ObjetoNoExiste='El objeto asociado a esta solicitud no existe.';
	$MULTILANG_ErrorDatos='Problema en los datos ingresados';
	$MULTILANG_ErrorTitAuth='<blink>ACCESO NEGADO!</blink>';
	$MULTILANG_ErrorDesAuth='<div align=left>Las credenciales suministradas para el acceso al sistema no fueron aceptadas.  Algunas causas comunes son:<br><li>El nombre de usuario o clave son incorrectos.<br><li>Captcha de seguridad ingresado de manera incorrecta.<br><li>Su usuario se encuentra deshabilitado.<br><li>Cuenta bloqueada por varios intentos de acceso con clave incorrecta.</div>';
	$MULTILANG_ErrorSoloAdmin='Solo el usuario admin puede ver los detalles de la transaccion con el modo de depuracion encendido.';
	$MULTILANG_ErrGoogleAPIMod='El metodo de autenticacion esta configurado como OAuth2 para Google.<br>Sin embargo el modulo de Practico google-api no se encuentra instalado.<br>Descargue e instale el modulo desde la web oficial de Practico y actualice la pagina nuevamente.';
	$MULTILANG_ErrFuncion='<br>Funcion de PHP no existe o se encuentra deshabilitada en su servidor: ';
	$MULTILANG_ErrDirectiva='La directiva o variable de configuracion PHP indicada debe estar habilitada en su configuracion de PHP o servidor web';
	$MULTILANG_UsuariosChat='Aquellos usuarios desconectados en el momento recibiran los mensajes cuando ingresen nuevamente al sistema.';
    $MULTILANG_AdminArchivos='Administrador de archivos';
    $MULTILANG_ErrorConnLDAP='Ha ocurrido un error durante la conexion con el servidor de autenticacion LDAP. Verifique sus configuraciones e intente nuevamente.  Detalles:<br>';
    $MULTILANG_ErrorRW='No se tienen permisos para escribir sobre el archivo! Cualquier cambio realizado podr&iacute;a perderse';
    $MULTILANG_ErrorExistencia='El archivo indicado para edicion no existe!';
    $MULTILANG_ErrorNoACE='No se encuentra el modulo ACE para edici&oacute;n del archivo';
    $MULTILANG_AyudaExplorador='Importante:  Algunas carpetas son presentadas a manera informativa sobre su existencia.  Sin embargo, estas son expandibles solamente cuando tienen archivos editables';
    $MULTILANG_EnlacePcoder='Editor de C&oacute;digo {PCoder}';
    $MULTILANG_AtajosTitPcoder='Atajos de teclado';
    $MULTILANG_AvisoSistema='Aviso del sistema';
    $MULTILANG_PcoderAjuste='Ajuste de ventana';
    $MULTILANG_PcoderAjusteConfirma='Esta a punto de recargar el documento actual con el fin de establecer el tamano de ventana al tamano maximo disponible segun su pantalla.  Al recargar el documento puede perder cualquier cambio no almacenado.  Desea continuar?';

	//Asistente disenador aplicaciones
	$MULTILANG_DesAppBoton='Dise&ntilde;ar aplicaci&oacute;n';
	$MULTILANG_TitDisenador='Dise&ntilde;ar la aplicaci&oacute;n, <b>es simple y r&aacute;pido:</b>';
	$MULTILANG_DefTablas='Definici&oacute;n de tablas';
	$MULTILANG_DesTablas='Las tablas son aquellas estructuras en las que ser&aacute; almacenada la informaci&oacute;n que sus usuarios diligencien por medio de formularios asociados a &eacute;stas.';
	$MULTILANG_DefForms='para ingreso y consulta de informaci&oacute;n';
	$MULTILANG_DesForms='Permiten al usuario ingresar informaci&oacute;n de acuerdo a ciertas validaciones o formatos, consultar registros o incluso eliminarlos. Permiten tambi&eacute;n desplegar otros elementos como p&aacute;ginas externas o informes predise&ntilde;ados.';
	$MULTILANG_DefInformes='(tablas o gr&aacute;ficos)';
	$MULTILANG_DesInformes='Presentan la informaci&oacute;n existente dentro de las tablas a los usuarios, bajo diferentes formatos y filtros definidos.  Se pueden crear informes tabulares o de tipo gr&aacute;fico y adem&aacute;s posteriormente ser embebidos en otros espacios.';
	$MULTILANG_DefMenus='para los usuarios';
	$MULTILANG_DesMenus='Enlaza objetos dise&ntilde;ados como formularios o informes con iconos gr&aacute;ficos y descripciones textuales que pueden ser seleccionadas por un usuario que posea ese permiso.  Tambi&eacute;n permite vincular funciones externas o ejecuci&oacute;n de comandos personalizados.';
	$MULTILANG_UsuariosPermisos='Usuarios y permisos';
	$MULTILANG_DefUsuarios='para acceder a su aplicaci&oacute;n';
	$MULTILANG_DesUsuarios='Establece las credenciales de acceso para cada usuario, as&iacute; como los permisos con que cuenta cada uno para accesar formularios, informes o cualquier opcion de menu previamente definida.';

	//Cierre de sesion
	$MULTILANG_SesionCerrada='Su sesi&oacute;n ha sido cerrada';
	$MULTILANG_TituloCierre='Esto puede ocasionarse por acciones ejecutadas por el usuario como';
	$MULTILANG_ExplicacionCierre='<li>Cerrar de manera voluntaria su sesi&oacute;n</li>
			<li>Dejar de usar el sistema durante un tiempo prolongado</li>
			<li>Tener abiertas varias ventanas del sistema al mismo tiempo en secciones restringidas por el administrador</li>
			<li>Su usuario o contrase&ntilde;a son inv&aacute;lidos para realizar alguna operaci&oacute;n</li>
			<li>Navegar utilizando enlaces o botones diferentes a los permitidos</li>
			<br><strong>Tambi&eacute;n por configuraciones o acciones de su equipo como:</strong><br>
			<li>Su navegador no est&aacute; soportando cookies</li>
			<li>Se ha lipiado la cach&eacute; cookies o sesiones del navegador mientras se usaba el sistema</li>
			<br><strong>Tambi&eacute;n por configuraciones del sistema como:</strong><br>
			<li>Haber finalizado un proceso de instalaci&oacute;n de la plataforma que requiere un reinicio de sesi&oacute;n</li>
			<li>La llave de paso de su usuario no corresponde a la llave solicitada por este sistema</li>
			<li>Las credenciales para firmar un registro de operaci&oacute;n no son v&aacute;lidas</li>';

	//Actualizacion de plataforma
	$MULTILANG_ActMsj1='ATENCION: Lea esta informaci&oacute;n antes de continuar';
	$MULTILANG_ActMsj2='Pr&aacute;ctico le ofrece este mecanismo para aplicar actualizaciones autom&aacute;ticas a su sistema mediante parches incrementales descargados desde la web oficial del proyecto o mediante el asistente para b&uacute;squeda de actualizaciones, sin embargo, antes de aplicar cualquier parche es fundamental que:<br><br><li>Haga una copia de seguridad de sus bases de datos. Algunas actualizaciones puede que requieran la modificaci&oacute;n de estructuras sobre la base de datos que pueden afectar la informaci&oacute;n.<li>Haga una copia de seguridad de sus archivos o carpeta de Pr&aacute;ctico.<li>LIMPIE la carpeta de trabajo de practico (ruta  tmp/), ser&aacute; utilizada por el asistente para descomprimir y analizar los archivos.';
	$MULTILANG_ActUsando='Actualmente usted utiliza la versi&oacute;n';
	$MULTILANG_ActPaquete='Paquete/Parche de actualizacion manual';
	$MULTILANG_ActSobreescritos='Archivos previos ser&aacute;n sobreescritos';
	$MULTILANG_CargarArchivo='Cargar el archivo';
	$MULTILANG_Adjuntando='Adjuntando un nuevo archivo al sistema';
	$MULTILANG_ErrorTamano='<b>ATENCION:</b> Proceso interrumpido.  El archivo excede el tama&ntilde;o permitido';
	$MULTILANG_ErrorFormato='<b>ATENCION:</b> Proceso interrumpido.  El formato del archivo cargado no es el solicitado';
	$MULTILANG_CargaCorrecta='El archivo ha sido cargado correctamente';
	$MULTILANG_ErrorDesconocido='<b>ATENCION:</b>  Ocurri&oacute; un error desconocido al cargar el archivo';
	$MULTILANG_ErrorDescomprimiendo='Descomprimiendo archivo';
	$MULTILANG_ContenidoParche='Contenido del parche';
	$MULTILANG_ErrorVerAct='Error cargando la versi&oacute;n actual de Pr&aacute;ctico.  No se encuentra el archivo';
	$MULTILANG_ErrorActualiza='El archivo cargado parece no ser un paquete de actualizacion v&aacute;lido.  No se encuentra el archivo';
	$MULTILANG_ErrorAntigua='El archivo de parche cargado hace referencia a una actualizaci&oacute;n mas antigua que su version actual';
	$MULTILANG_ErrorVersion='El archivo de parche cargado requiere la siguiente version';
	$MULTILANG_AvisoIncremental='Debe aplicar primero los parches incrementales requeridos hasta elevar su sistema a la versi&oacute;n minima que necesita el parche.';
	$MULTILANG_Integridad='Integridad';
	$MULTILANG_ResumenParche='Resumen de los cambios y funcionalidades suministradas por el parche';
	$MULTILANG_ResumenInstrucciones='Instrucciones a ser ejecutadas sobre las tablas de del sistema';
	$MULTILANG_FinRevision='PROCESO DE REVISION FINALIZADO';
	$MULTILANG_ActMsj3='Al aplicar los archivos listados arriba se actualizar&aacute; su sistema a la siguiente versi&oacute;n';
	$MULTILANG_ActErrGral='Archivo con estructura, tipo o versi&oacute;n no compatible';
	$MULTILANG_ActDesde='Actualizando desde la version';
	$MULTILANG_ErrLista='Error cargando lista de archivos para backup';
	$MULTILANG_HaciendoBkp='Haciendo backup de';
	$MULTILANG_ErrBkpBD='Ha ocurrido un error durante la copia de seguridad de la base de datos';
	$MULTILANG_ActMsj4='Si alguno de los archivos no ha podido ser escrito por este asistente por problemas de permisos el parche tambien puede ser aplicado manualmente por el administrador o escribiendo solamente los archivos faltantes';
	$MULTILANG_ActMsj5='Archivo con estructura o tipo no compatible';
	$MULTILANG_ActAlertaVersion='Existe una nueva version de Practico disponible.<br>Se recomienda descargar la nueva version o el paquete de actualizacion desde la web oficial y actualizar su sistema para contar con las nuevas mejoras de seguridad y funcionalidad';
	$MULTILANG_ActBuscarVersion='Buscar nuevas versiones automaticamente';
    $MULTILANG_ActErrEscritura='Error de escritura';
    $MULTILANG_ActDesEscritura='ATENCION: Se han encontrado errores de escritura en los archivos que van a ser actualizados.
        <br><br>Para mantener la integridad de la plataforma no se permitira actualizar hasta que no corrija o actualice los permisos de los archivos indicados en el listado anterior en color rojo y con el texto "'.$MULTILANG_ActErrEscritura.'" de manera que puedan ser escribibles por Practico.
        <br><br>Una vez actualizados los permisos intente nuevamente.';

	//Formularios
	$MULTILANG_ErrFrmDuplicado='Ha ocurrido un error de valor duplicado en el campo. El valor ingresado ya existe en la base de datos. Campo: ';
	$MULTILANG_ErrFrmObligatorio='Ha olvidado diligenciar el campo obligatorio: ';
	$MULTILANG_ErrFrmDatos='Problema en los datos ingresados';
	$MULTILANG_ErrFrmCampo1='Debe indicar un t&iacute;tulo o etiqueta v&aacute;lida para el campo.';
	$MULTILANG_ErrFrmCampo2='Debe indicar un campo v&aacute;lido para vincular con la tabla de datos asociada al formulario.';
	$MULTILANG_ErrFrmCampo3='Debe indicar un t&iacute;tulo o etiqueta v&aacute;lida para el bot&oacute;n.';
	$MULTILANG_ErrFrmCampo4='Debe indicar una acci&oacute;n v&aacute;lido para ser ejecutada cuando se active el control.';
	$MULTILANG_FrmMsj1='Agregar un elemento al formulario';
	$MULTILANG_FrmTipoObjeto='Tipo de objeto que desea agregar';
	$MULTILANG_FrmTipoTit1='Controles de datos';
	$MULTILANG_FrmTipo1='Campo de texto corto';
	$MULTILANG_FrmTipo2='Campo de texto libre';
	$MULTILANG_FrmTipo3='Campo de texto con formato enriquecido';
	$MULTILANG_FrmTipo4='Campo de selecci&oacute;n (ComboBox o lista desplegable)';
	$MULTILANG_FrmTipo5='Campo de selecci&oacute;n (RadioButton)';
	$MULTILANG_FrmTipoTit2='Presentaci&oacute;n y otros contenidos';
	$MULTILANG_FrmTipo6='Texto enriquecido (como etiqueta)';
	$MULTILANG_FrmTipo7='URL embebida (IFrame)';
	$MULTILANG_FrmTipoTit3='Objetos internos';
	$MULTILANG_FrmTipo8='Informe predise&ntilde;ado (Tabla de datos o Gr&aacute;fico)';
	$MULTILANG_FrmTipo9='Deslizador (selector de rangos num&eacute;ricos - HTML5)';
	$MULTILANG_FrmTipo10='Campo de contrasena';
	$MULTILANG_FrmTipo11='Valor de campo como etiqueta';
	$MULTILANG_FrmTipoTit4='Controles de datos especiales';
	$MULTILANG_FrmTipo12='Archivo adjunto';
	$MULTILANG_FrmTipo13='Canvas (Area de dibujo - HTML5)';
	$MULTILANG_FrmTipo14='Canvas (Captura Webcam - HTML5)';
	$MULTILANG_FrmTipo15='SubFormulario (Para consulta en Solo lectura)';
    $MULTILANG_FrmTipo16='Boton de comando';
	$MULTILANG_FrmTipoPincel='Tama&ntilde;o del pincel';
	$MULTILANG_FrmTipoColor='Color del trazo';
	$MULTILANG_FrmTipoAdvertencia='Este tipo de controles deberia ser almacenado en su tabla dentro de campos de texto largo/ilimitado';
	$MULTILANG_FrmValorMinimo='Valor m&iacute;nimo';
	$MULTILANG_FrmValorMaximo='Valor m&aacute;ximo';
	$MULTILANG_FrmValorSalto='Valor de salto';
	$MULTILANG_FrmTitValorSalto='Cuantas unidades salta la barra en cada desplazamiento?';
	$MULTILANG_FrmTitulo='T&iacute;tulo o etiqueta';
	$MULTILANG_FrmDesTitulo='Texto que aparecer&aacute; al lado del indicando al usuario la informacion que debe ingresar.  Puede usar HTML b&aacute;sico para dar formato adicional.';
	$MULTILANG_FrmCampo='Campo enlazado';
	$MULTILANG_FrmFiltroLista='Condicion de filtrado de la lista';
	$MULTILANG_FrmDesFiltroLista='Condicion especial que deben cumplir los registros de la lista para poder ser desplegados.  Puede hacer referencia a campos que no se encuentren dentro de los seleccionados o valores fijos encerrados en comillas dobles.  En esencia lo aqui ingresado sera agregado a la consulta de registros despues del WHERE, asi que puede agregar tambien otras clausulas como ORDER BY, GROUP BY, LIMIT, entre otras.  RECUERDE: Si usted desea un GROUP BY o un ORDER BY sin una condicion entonces al menos deberia agregar una condicion de 1=1 al comienzo para cumplir con la sintaxis de SQL despues del WHERE.';
	$MULTILANG_FrmCampoOb1='Campo obligatorio para controles de datos';
	$MULTILANG_FrmDesCampo='Campo de la tabla de datos al cual se vincular&aacute; la informaci&oacute;n.  Para controles de tipo archivo puede representar el campo donde se almacena el path del archivo sobre el servidor. Cada control tipo archivo deberia tener al menos un campo sobre la tabla donde guardar el path.';
	$MULTILANG_FrmValUnico='Campo de valor &uacute;nico';
	$MULTILANG_FrmTitUnico='Unicidad para los valores ingresados';
	$MULTILANG_FrmDesUnico='Indica si el campo puede almacenar o no valores repetidos en la base de datos.  Deber&iacute;a estar habilitado para campos que representen claves primarias en su dise&ntilde;o y deshabilitado para el resto.  Debera tener especial cuidado con aquellos formularios donde desee dejar el campo para actualizaciones y que pueda generar error de valor duplicado.';
	$MULTILANG_FrmPredeterminado='Valor predeterminado';
	$MULTILANG_FrmDesPredeterminado='Establece el valor que aparece diligenciado automaticamente en el campo al abrir la vista del formulario.  Este valor puede estar en contravia de la validaci&oacute;n de datos.  Si se ingresan variables PHP definidas en la sesion entonces se tomara su valor.';
	$MULTILANG_FrmValida='Validacion de datos';
	$MULTILANG_FrmValida1='S&oacute;lo n&uacute;meros 0-9';
	$MULTILANG_FrmValida2='S&oacute;lo letras A-Z';
	$MULTILANG_FrmValida3='Letras y n&uacute;meros';
	$MULTILANG_FrmValida4='Campo de fecha';
	$MULTILANG_FrmValidaDes='Tipo de filtro a ser aplicado cuando el usuario ingresa informaci&oacute;n por teclado';
	$MULTILANG_FrmLectura='Campo de solo lectura';
	$MULTILANG_FrmTitLectura='Define si se puede cambiar su valor';
	$MULTILANG_FrmDesLectura='Propiedad util para campos o formularios de consulta por parte del usuario donde se requiere visualizar el valor pero no permitir su modificacion';
	$MULTILANG_FrmAyuda='T&iacute;tulo de ayuda';
	$MULTILANG_FrmDesAyuda='Texto que aparecer&aacute; como encabezado para el texto de ayuda del campo explicando al usuario qu&eacute; debe ingresar';
	$MULTILANG_FrmTxtAyuda='Texto de ayuda';
	$MULTILANG_FrmDesTxtAyuda='Texto completo con la descripcion de funciones resumida para el campo.  Puede incluir instrucciones de formato, advertencias o cualquier otro mensaje para el usuario';
	$MULTILANG_FrmDesPeso='Posicion en la que aparece el campo dentro del formulario cuando este se despliega en pantalla. Orden.';
	$MULTILANG_FrmDesColumna='Columna para ubicar el campo cuando la vista del formulario tenga varias columnas. Aquellos campos en columnas superiores a las definidas en el formulario no ser&aacute;n dibujados';
	$MULTILANG_FrmObligatorio='Obligatorio';
	$MULTILANG_FrmVisible='Visible';
	$MULTILANG_FrmDesVisible='Determina si el control es visible o no para el usuario.  Si se deja como No el control es usado pero como un campo oculto';
	$MULTILANG_FrmLblBusqueda='Utilizar para b&uacute;squedas? Etiqueta';
	$MULTILANG_FrmTitBusqueda='Indica si el campo es usado para buscar registros';
	$MULTILANG_FrmDesBusqueda='Deje el espacio en blanco para indicar que es un campo normal o ingrese la etiqueta que debe ir en el boton de comando ubicado al lado derecho del campo para realizar la busqueda de registros';
	$MULTILANG_FrmAjax='Usar AJAX para buscar';
	$MULTILANG_FrmTitAjax='Modo de recuperaci&oacute;n de registros';
	$MULTILANG_FrmDesAjax='Cuando la casilla se encuentra activada Practico intenta recuperar la informaci&oacute;n del registro para el formulario mediante AJAX, En listas de seleccion cuyo valor es obtenido desde tablas esto crea un boton de actualizacion dinamico de la lista.';
	$MULTILANG_FrmTeclado='Agregar teclado virtual';
	$MULTILANG_FrmTitTeclado='Ingreso de informaci&oacute;n sin teclado';
	$MULTILANG_FrmDesTeclado='Cuando es habilitado en el formulario se despliega un teclado virtual para el ingreso de informaci&oacute;n;.  Por ahora el uso del teclado puede violar las validaciones';
	$MULTILANG_FrmAncho='Ancho';
	$MULTILANG_FrmTitAncho='Cu&aacute;nto espacio de ancho debe ocupar el control';
	$MULTILANG_FrmDesAncho='IMPORTANTE: en n&uacute;mero de caracteres para texto simple o en pixeles para texto con formato. Indique un n&uacute;mero de columnas, sin embargo, tenga presente que el ancho en pixeles ser&aacute; variable de acuerdo al tipo de fuente utilizada por el tema actual. Para campos con imagenes o codigos de barra esto representa su tamano en pixeles.';
	$MULTILANG_FrmDesAncho2='M&iacute;nimo recomendado en campos con formato: 350';
	$MULTILANG_FrmAlto='Alto (l&iacute;neas)';
	$MULTILANG_FrmTitAlto='Cu&aacute;ntas filas deben estar visibles en el control?';
	$MULTILANG_FrmDesAlto='IMPORTANTE: en n&uacute;mero de filas para texto simple o en pixeles para texto con formato.  En caso que el texto supere el n&uacute;mero de filas se agregar&aacute;n autom&aacute;ticamente barras de desplazamiento. Para campos con imagenes o codigos de barra esto representa su tamano en pixeles.';
	$MULTILANG_FrmDesAlto2='M&iacute;nimo recomendado en campos con formato: 100';
	$MULTILANG_FrmBarra='Barra de edici&oacute;n';
	$MULTILANG_FrmBarraTipo1='B&aacute;sica: Documento, formato de caracter y p&aacute;rrafo';
	$MULTILANG_FrmBarraTipo2='Est&aacute;ndar: B&aacute;sica + Enlaces, estilos de fuente';
	$MULTILANG_FrmBarraTipo3='Extendida: Est&aacute;ndar + Portapapeles, buscar-reemplazar y ortograf&iacute;a';
	$MULTILANG_FrmBarraTipo4='Avanzada: Extendida + Insertar objetos y colores';
	$MULTILANG_FrmBarraTipo5='Completa: Avanzada +  Formularios y pantalla completa';
	$MULTILANG_FrmTitBarra='Tipo de editor utilizado';
	$MULTILANG_FrmDesBarra='Indica el tipo de barra de herramientas que aparecer&aacute; en la parte superior del control y que permitir&aacute; realizar al usuario las diferentes tareas de edici&oacute;n del texto. IMPORTANTE: Cada tipo de editor requiere un espacio diferente en el formulario ya que debe desplegar un n&uacute;mero de iconos y opciones diferentes';
	$MULTILANG_FrmFila='Fila &uacute;nica para este objeto?';
	$MULTILANG_FrmTitFila='Se debe utilizar una fila completa para el objeto?';
	$MULTILANG_FrmDesFila='Permite desplegar el objeto en una fila exclusiva de la tabla usada en el formulario';
	$MULTILANG_FrmLista='Lista de opciones';
	$MULTILANG_FrmTitLista='Qu&eacute; opciones aparecen para ser escogidas.  Ingrese una coma solamente para indicar que se desea el valor predeterminado como vacio.  Dejar vacio para que se tome el primer valor del registro.';
	$MULTILANG_FrmDesLista='Ingrese una lista de opciones separadas por coma.  Si requiere tomar las opciones din&aacute;micamente desde otra tabla de la aplicaci&oacute;n utilice los campos de Origen de datos para opciones.  En caso de llenar ambas opciones (lista fija y origen de datos) el resultado ser&aacute; su combinaci&oacute;n';
	$MULTILANG_FrmDesLista2='Separadas por coma';
	$MULTILANG_FrmOrigen='Origen de la lista de opciones';
	$MULTILANG_FrmTitOrigen='Debe especificar el mismo origen (tabla) de la lista de valores';
	$MULTILANG_FrmDesOrigen='Campo desde el cual se toman las opciones que despliega la lista';
	$MULTILANG_FrmTitOrigen2='Que es esto?';
	$MULTILANG_FrmOrigenVal='Origen de la lista de valores';
	$MULTILANG_FrmTitOrigenVal='Debe especificar el mismo origen (tabla) de la lista de opciones';
	$MULTILANG_FrmDesOrigenVal='Campo desde el cual se toman los valores internos (a ser procesados) para cada opcion de la lista';
	$MULTILANG_FrmEtiqueta='Valor de la etiqueta (ser&aacute; impresa en el formulario en formato HTML)';
	$MULTILANG_FrmURL='URL para IFrame';
	$MULTILANG_FrmDesURL='Ingrese la direcci&oacute;n de la p&aacute;gina que sera embebida en el marco';
	$MULTILANG_FrmInforme='Informe vinculado';
	$MULTILANG_FrmFormulario='Formulario vinculado';
	$MULTILANG_FrmDesCampoVinculo='Indique el nombre del CAMPO DEL FORMULARIO PADRE (el que esta disenando en este momento) que sera utilizado para tomar el valor y buscarlo en el sub-formulario para enlazar sus datos.';
	$MULTILANG_FrmDesCampoForaneo='Indique el nombre del CAMPO FORANEAO DEL SUB-FORMULARIO (del formulario o tabla que alimenta el subformulario) y sobre el cual se debe buscar el dato del campo local para ser enlazado y presentar sus datos';
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
	$MULTILANG_FrmDesEstilo='Apariencia gr&aacute;fica del control';
	$MULTILANG_FrmTipoAccion='Tipo de acci&oacute;n';
	$MULTILANG_FrmAccionT1='Acciones internas';
	$MULTILANG_FrmAccionGuardar='Guardar datos';
	$MULTILANG_FrmAccionLimpiar='Limpiar datos';
	$MULTILANG_FrmAccionEliminar='Eliminar datos';
	$MULTILANG_FrmAccionActualizar='Actualizar datos';
	$MULTILANG_FrmAccionRegresar='Regresar a escritorio';
	$MULTILANG_FrmAccionCargar='Cargar un objeto';
	$MULTILANG_FrmAccionT2='Definidas por el usuario';
	$MULTILANG_FrmAccionExterna='En personalizadas.php o cualquier otro m&oacute;dulo instalado';
	$MULTILANG_FrmAccionJS='Comando en JavaScript';
	$MULTILANG_FrmDesAccion='Comando que deber&aacute; ejecutar el control al ser pulsado.  Para acciones definidas es personalizadas.php los datos del formulario ser&aacute;n enviados a esa rutina para ser procesados';
	$MULTILANG_FrmAccionCMD='Comando del usuario';
	$MULTILANG_FrmAccionDesCMD='Nombre de la acci&oacute;n definida en el archivo de personalizaci&oacute;n que procesar&aacute; la informaci&oacute;n o comando en JavaScript a ser ejecutado de manera inmediata en la p&aacute;gina (si requiere par&aacute;metros dentro de su comando utilice comillas sencillas para encerrarlos). Para cargar objetos de Pr&aacute;ctico como formularios o informes puede usar la misma notaci&oacute;n de menus: frm:XX:Par1:Par2:ParN o inf:XX...  El comando javascript ImprimirMarco(\'MARCO_IMPRESION\') le permite imprimir el contenido del formulario.  Tambien puede usar comandos como PCO_VentanaPopup(\'http://www.google.com\',\'SuTitulo\',\'toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, width=640, height=480\'); .Revise siempre la documentacion para una lista completa y actualizada de comandos.';
	$MULTILANG_FrmDesPeso='Posicion en la que aparece el campo dentro de la barra de estado del formulario cuando este se despliega en pantalla. Orden de izquierda a derecha';
	$MULTILANG_FrmBotDesVisible='Determina si el control es visible o no para el usuario';
	$MULTILANG_FrmRetorno='T&iacute;tulo de retorno';
	$MULTILANG_FrmDesRetorno='Texto que aparecer&aacute; como encabezado en el escritorio despu&eacute;s de realizar la acci&oacute;n indicada por el usuario';
	$MULTILANG_FrmTxtRetorno='Texto de retorno';
	$MULTILANG_FrmTxtDesRetorno='Texto completo con la descripci&oacute;n de acci&oacute;n realizada o mensaje entregado al usuario despu&eacute;s de ejecutar el control';
	$MULTILANG_FrmConfirma='Texto de confirmaci&oacute;n';
	$MULTILANG_FrmDesConfirma='En caso de ser diligenciado: Texto que aparecer&aacute; como ventana emergente advirtiendo la ejecuci&oacute;n del control y esperando confirmaci&oacute;n del usuario para proceder';
	$MULTILANG_FrmBtnGuardarBut='Agregar acci&oacute;n/bot&oacute;n';
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
	$MULTILANG_FrmActualizar='Actualizar configuraciones iniciales';
	$MULTILANG_FrmDetalles='Defina los detalles del formulario';
	$MULTILANG_FrmTitVen='T&iacute;tulo de ventana';
	$MULTILANG_FrmDesTit='Texto que aparecer&aacute; en la parte superior de la ventana de formulario o barra de t&iacute;tulo';
	$MULTILANG_FrmHlp='T&iacute;tulo de ayuda';
	$MULTILANG_FrmDesHlp='Texto que aparecer&aacute; como encabezado para el texto de ayuda del formulario';
	$MULTILANG_FrmTxt='Texto de ayuda';
	$MULTILANG_FrmDesTxt='Texto completo con la descripcion de funciones resumida para el formulario.  Puede ser cualquier texto introductorio para el usuario';
	$MULTILANG_FrmImagen='Color de fondo';
	$MULTILANG_FrmImagenDes='Si su navegador soporta HTML5 puede seleccionar el color, de lo contrario ingrese un codigo en hexadecimal como por ejemplo #F2F2F2 o su nombre en HTML como por ejemplo LightGray';
	$MULTILANG_FrmNumeroCols='N&uacute;mero columnas';
	$MULTILANG_FrmDesNumeroCols='Indica en cuantas columnas deben desplegarse los campos cuando el formulario sea cargado';
	$MULTILANG_FrmCreaDisena='Crear y dise&ntilde;ar';
	$MULTILANG_FrmTitForms='Formularios ya definidos en el sistema';
	$MULTILANG_FrmCamposAcciones='Campos y acciones';
	$MULTILANG_FrmAdvDelForm='IMPORTANTE:  Al eliminar el formulario los usuarios no podr&aacute;n accesarlo nuevamente para operaciones de consulta o ingreso de datos definidas en &eacute;l y no podr&aacute; deshacer esta operaci&oacute;n. Esto tambien elimina cualquier dise&ntilde;o interno del formulario.\n'.$MULTILANG_Confirma;
	$MULTILANG_FrmAdvScriptForm='Editar scripts (avanzado)';
	$MULTILANG_FrmHlpFunciones='Todas las funciones JavaScript definidas en este espacio ser&aacute;n inclu&iacute;das al formulario cada vez que sea cargado.<br>Si requiere comportamientos adicionales o eventos especificos lanzados por medio de botones o dem&aacute;s objetos<br> en su formulario este es el espacio para definirlos.<br><b>Al utilizar comillas en parametros y funciones estas deben ser siempre dobles</b>, no simples.<br>La funci&oacute;n FrmAutoRun siempre debe existir (aunque sea vac&iacute;a) pues ser&aacute; ejecutada autom&aacute;ticamente en cada carga del Formulario.';
    $MULTILANG_FrmHlpFinalFunciones='Este codigo hace parte del formulario.  Cierre y haga clic en Crear/Actualizar formulario para aplicar los cambios.';
	$MULTILANG_FrmCopiar='Crear copia';
	$MULTILANG_FrmAdvCopiar='Se creara una copia nueva del formulario actual.  Esta seguro?';
	$MULTILANG_FrmMsjCopia='Ahora puede ingresar a editar su nuevo formulario.  Se ha creado una copia como: ';
	$MULTILANG_FrmBordesVisibles='Bordes de tabla visibles?';
	$MULTILANG_FrmFormatoSalida='Formato de salida';
	$MULTILANG_FrmPlantillaArchivo='Plantilla para el nombre del archivo';
	$MULTILANG_FrmDesPlantillaArchivo='La plantilla es la forma o patron en que sera renombrado el archivo una vez subido por el usuario al servidor.  Esto puede incluir diferentes variables para alterar el nombre y la extension del mismo como los ejemplos. Tambien puede dejarla en blanco para que los archivos sean cargados con el nombre original sobre la carpeta de cargas del sistema (No recomendado por seguridad).';
	$MULTILANG_FrmErrorCargaGeneral='Ha ocurrido un error durante la carga del archivo';
	$MULTILANG_FrmErrorCargaTamano='El archivo excede el tamano permitido';
	$MULTILANG_FrmPlantillaEjemplos='<i><b>Algunas variables de formato:</b><li>_ORIGINAL_ : Nombre original del archivo</li><li>_CAMPOTABLA_ : Nombre del campo de tabla vinculado</li><li>_FECHA_ : Fecha actual en formato AAAAMMDD</li><li>_HORA_ : Hora del servidor en formato HHMMSS</li><li>_MICRO_ : Microsegundos de la hora del sistema</li><li>_HORAINTERNET_ : Valor hora de internet de 000 a 999</li><li>_USUARIO_ : Login del usuario que hace el cargue</li><b>Ejemplos:</b><li>_USUARIO__ORIGINAL_: Renombra el archivo original anteponiendo el login del usuario que lo carga</li><li>formatos/_ORIGINAL_: Carga el archivo con su nombre original dentro de la carpeta formatos.  La carpeta debe haber sido creada previamente por el usuario admin mediante el administrador de archivos dentro de la carpeta de cargas.</li><li>_FECHA__HORA__USUARIO_.pdf: Ademas de renombrar el archivo original por una cadena con la fecha, hora y usuario que hace el cargue, hace el forzado de la extension de archivo, renombrandolo como PDF.</li><li>reportes/_FECHA_.xls: Ademas de cargar el archivo en la carpeta reportes, lo renombra a la fecha actual y hace el forzado para que su extension sea XLS.</li><li>foto__USUARIO_.jpg: El archivo tendra fijas las cadenas iniciales y finales de foto_ y .jpg pero en el medio se reemplazara el valor del usuario que hace el cargue.  Observe el doble underline, uno para separar el archivo y otro para la variable de formato como tal.  Tendra un resultado final como foto_avelez.jpg</li>En general cualquier cadena dentro del formato que no coincida con las variables de formato quedara intacta en el nombre del archivo.</i>';
	$MULTILANG_FrmArchivoLink='[Abrir archivo ya cargado]';
	$MULTILANG_FrmCanvasLink='[Ver grafico ya cargado]';
	$MULTILANG_FrmErrorCam='Error en el dispositivo de video.  Verifique que cuenta con una camara instalada y que ha hecho clic en Permitir o aceptar para permitir a Practico utilizarla.';
    $MULTILANG_FrmPestana='T&iacute;tulo de la Pesta&ntilde;a a que pertenece en el formulario';
    $MULTILANG_FrmDesPestana='Indica la pesta&ntilde;a a la que pertenece el elemento dentro del formulario.  Practico genera automaticamente las pesta&ntilde;as de acuerdo a los valores ingresados en cada objeto.';
    $MULTILANG_FrmTagPersonalizado='Personalizaci&oacute;n del Tag HTML';
    $MULTILANG_FrmDesTagPersonalizado='Permite agregar par&aacute;metros y otras configuraciones HTML a la etiqeuta generada por Pr&aacute;ctico. 
            <hr>Ejemplos para algunos tipos de control:
            <br><b>Listas de selecci&oacute;n (combo-box):</b>
                <li><u>data-live-search=true</u> Busqueda dinamica sobre la lista.</li>
                <li>Beta <u>multiple</u> Selecciones multiples sobre la lista. Cuidado: Almacena el primer valor seleccionado.</li>
                <li>Beta <u>data-selected-text-format=count</u> Combinado con multiple, cuenta las opciones seleccionadas en lugar de sus valores. Cuidado: Solamente cuenta, pero almacena el primer valor seleccionado.</li>
                <li><u>data-max-options=#</u> Combinado con multiple, determina el maximo de elementos a ser seleccionados.
                <li><u>data-size=auto|#</u> Determina cuantas opciones presentar en la lista. Por defecto es auto.</li>
                <li><u>data-style=btn-primary|btn-info|btn-success|btn-warning|btn-danger|btn-inverse</u> Cambia el estilo grafico del control
                <li><u>disabled</u> Deshabilita el control.</li>
            <br><b>Botones de comando (command buttons):</b>
                <li><u>btn btn-xs btn-primary|btn-info|btn-success|btn-warning|btn-danger|btn-inverse</u></li>';
    $MULTILANG_FrmBtnFull='Cargar en pantalla completa';
    $MULTILANG_FrmBtnObjetivo='Objetivo HTML';
    $MULTILANG_FrmActualizaAjax='Actualizar din&aacute;micamente';
    $MULTILANG_FrmActivarInline='Modo de vista <i>Inline</i> (Conjunto con el elemento anterior y siguiente)';
    $MULTILANG_FrmActivarInlineDes='Permite que el control sea diagramado con estilo inline, lo que impide el salto de linea previo a ser ubicado en el formulario.  Dependiendo del efecto deseado, el control anterior o siguiente tambien debera contar con esta propiedad activada.';

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
    $MULTILANG_InfPatron='Coincide con el patr&oacute;n (Utilice % como comodin)';
	$MULTILANG_InfDesManual='En cualquiera de los campos manuales puede encerrar expresiones o valores tipo cadena de caracteres utilizando comillas dobles.  Tambien puede comparar frente a las variables de sesion del usuario simplemente con poner alguna de ellas en notacion PHP, por ejemplo: $PCOSESS_LoginUsuario, $Nombre_usuario, $Descripcion_usuario, $Nivel_usuario, $Correo_usuario, $LlaveDePasoUsuario';
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
	$MULTILANG_InfGrafico7='Grafico de torta (solo una serie)';
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
	$MULTILANG_InfErrTamano='El informe que intenta generar es de tipo gr&aacute;fico pero el dise&ntilde;ador no ha indicado el alto y ancho del gr&aacute;fico resultante.<br>Debe indicarse un tama&ntilde;o v&aacute;lido de gr&aacute;fico para poder generarse una im&aacute;gen.';
	$MULTILANG_InfGeneraPDF='Exportar PDF?';
	$MULTILANG_InfGeneraPDFInfoTit='Aplica s&oacute;lo para informes tabulares';
	$MULTILANG_InfGeneraPDFInfoDesc='El uso de esta opci&oacute;n requiere la descarga e instalaci&oacute;n del m&oacute;dulo adicional para generaci&oacute;n de PDFs de Pr&aacute;ctico.  Se encuentra disponible en la zona de descargas en web oficial de la herramienta.  Activar esta opci&oacute;n puede represetar tiempos adicionales en la generaci&oacute;n de su informe cuando el vol&uacute;men de resultados es alto.';
    $MULTILANG_InfVblesFiltro='Variables para filtro';
    $MULTILANG_InfVblesDesFiltro='Variables PHP (Sin el signo pesos $ y separadas unicamente por una coma) que deberan ser buscadas en el ambito global para estar disponibles en condiciones de filtrado';
    $MULTILANG_InfDataTableResXPag='resultados por p&aacute;gina';
    $MULTILANG_InfDataTableViendoP='Viendo p&aacute;gina';
    $MULTILANG_InfDataTableDe='de';
    $MULTILANG_InfDataTableFiltradoDe='Filtrado de';
    $MULTILANG_InfDataTableRegTotal='registros en total';
    $MULTILANG_InfDataTableNoDatos='No hay datos en la tabla';
    $MULTILANG_InfDataTableNoRegistros='No hay registros que coincidan con el criterio de b&uacute;squeda';
    $MULTILANG_InfDataTableNoRegistrosDisponibles='No hay registros disponibles';
    $MULTILANG_InfDataTableTit='Soportar DataTables?';
    $MULTILANG_InfDataTableDes='Permite transformar el informe en un DataTable que permite realizar filtros, ordenamiento, busquedas y paginacion en caliente';
    
	
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
	$MULTILANG_MnuDesURL='Ingrese una URL completa o un comando javascript definido por javascript:comando para ser reemplazadas dentro de un HREF de un ancla generada alrededor del objeto.  Si requiere parametros tipo cadena para sus comandos javascript utilice comillas simples para encerrarlos';
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
	$MULTILANG_MnuHlpComandoInf='Es probable que para los tipo Informe quiera agregar al comando final un <b>:htm:Informes</b> para indicar a Practico<br>que debe entregar sus resultados en html y con esa hoja de estilos';
	$MULTILANG_MnuHlpAwesome='Puede usar la misma notacion de los iconos de menu';
    $MULTILANG_MnuTgtBlank='Nueva ventana o pesta&ntilde;a';
    $MULTILANG_MnuTgtSelf='Misma ventana o marco actual';
    $MULTILANG_MnuTgtParent='Ventana padre';
    $MULTILANG_MnuTgtTop='Todo el cuerpo de la ventana actual';
    $MULTILANG_MnuTgt='Destino (S&oacute;lo opciones con URL)';

	//Objetos, seguridad y otros
	$MULTILANG_ObjError='El tipo de objeto recibido en este comando es desconocido';
	$MULTILANG_SecErrorTit='Control de seguridad por comandos e informes';
	$MULTILANG_SecErrorDes='Usted ha intentado ejecutar una funcion, comando o informe para el cual no se encuetra autorizado.<br>Ser&aacute; llevado un registro de auditor&iacute;a:';
	
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
	$MULTILANG_UsrDesPW='Las contrase&ntilde;as con condiciones m&iacute;nimas de seguridad deben tener una longitud de <b>al menos 8 caracteres</b>, n&uacute;meros, letras en may&uacute;scula y en min&uacute;scula o s&iacute;mbolos permitidos como <font color=blue>$ *</font>.  Para que su contrase&ntilde;a sea considerada segura por este sistema <b>debe cumplir al menos con un nivel de seguridad del 81%</b>';
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
	$MULTILANG_UsrInfDisp='Informes disponibles';
	$MULTILANG_UsrAdvDel='IMPORTANTE:  Al eliminar el registro pueden quedar sin vincular algunas opciones del sistema para este usuario.\n'.$MULTILANG_Confirma;
	$MULTILANG_UsrAdmPer='Administraci&oacute;n de permisos del usuario';
	$MULTILANG_UsrCopiaPer='Copiar inicialmente los permisos desde el usuario';
	$MULTILANG_UsrDelPer='Solamente borrar permisos';
	$MULTILANG_UsrAgreOpc='Agregar opci&oacute;n al men&uacute; del usuario';
	$MULTILANG_UsrSecc='Secciones ya disponibles';
	$MULTILANG_UsrErrCrea1='El usuario ingresado ya existe, por favor verifique o cambie el login ingresado para la cuenta e intente de nuevo';
	$MULTILANG_UsrErrCrea2='Usted ha olvidado ingresar alguno de los datos solicitados como obligatorios';
	$MULTILANG_UsrErrCrea3='La contrase&ntilde;a ingresada debe tener al menos seis caracteres';
	$MULTILANG_UsrAdicion='Adici&oacute;n de usuarios';
	$MULTILANG_UsrLogin='NickName / Login';
	$MULTILANG_UsrDesLogin='Login &uacute;nico para identificar el usuario en el sistema. SENSIBLE A MAYUSCULAS';
	$MULTILANG_UsrNombre='Nombre completo';
	$MULTILANG_UsrTitCorreo='Direcci&oacute;n para alertas y notificaciones';
	$MULTILANG_UsrDesCorreo='Direcci&oacute;n electr&oacute;nica de posible uso para notificaciones autom&aacute;ticas del sistema en algunos m&oacute;dulos';
	$MULTILANG_UsrEstado='Estado inicial';
	$MULTILANG_UsrNivel='Nivel de acceso';
	$MULTILANG_UsrInterno='Usuario interno?';
	$MULTILANG_UsrDesInterno='Un usuario interno es aquel diferenciado para tareas especificas de la organizacion o empresa que implementa el ERP.  Asi pues, los usuarios son clasificados como internos o externos, siendo estos ultimos los asociados a los clientes o usuarios de afuera de nuestra organizacion que acceden a los servicios';
	$MULTILANG_UsrTitNivel='Perfil inicial de seguridad';
	$MULTILANG_UsrDesNivel='Perfil de seguridad del usuario.  CUIDADO:  Esta opci&oacute;n es diferente a los permisos individuales de usuario definidos por el disenador para los objetos por el creados.  Este perfil solamente aplica para las operaciones internas de Pr&aacute;ctico';
	$MULTILANG_UsrAudit1='Seguimiento de operaciones (actualizando autom&aacute;ticamente cada 5 segundos)';
	$MULTILANG_UsrAudDes='Descripci&oacute;n de la acci&oacute;n';
	$MULTILANG_UsrAudUsrs='Seguimiento de operaciones para todos los usuarios';
	$MULTILANG_UsrAudAccion='Con la siguiente ACCION';
	$MULTILANG_UsrAudUsuario='para el <b>usuario </b>';
	$MULTILANG_UsrAudDesde='Desde (Dia / Mes)';
	$MULTILANG_UsrAudHasta='hasta';
	$MULTILANG_UsrAudAno='Consultando auditoria del a&ntilde;o';
	$MULTILANG_UsrAudIniReg='Iniciar en el registro';
	$MULTILANG_UsrAudVisual='Visualizando';
	$MULTILANG_UsrAudMonit='Modo de monitoreo';
	$MULTILANG_UsrAudHisto='Historial de operaciones del usuario (de la m&aacute;s reciente a la mas antigua)';
	$MULTILANG_UsrLista='Listado de usuarios en el sistema';
	$MULTILANG_UsrLisNombre='Ver s&oacute;lo los usuarios cuyo NOMBRE contenga';
	$MULTILANG_UsrLisLogin='Ver s&oacute;lo los usuarios cuyo LOGIN contenga';
	$MULTILANG_UsrFiltro='Debido a la cantidad de usuarios registrados usted debe filtrar el resultado.<br>
				Indique el tipo de filtro deseado en la parte superior y haga clic en el bot&oacute;n correspondiente.';
	$MULTILANG_UsrAcceso='Ultimo acceso';
	$MULTILANG_UsrAdvSupr='IMPORTANTE:  Est&aacute; a punto de eliminar el usuario y perder vinculos hacia registros asociados a este, no podr&aacute;n recuperarse esta accion a menos que usted recree el usuario con las mismas credenciales posteriormente.\n'.$MULTILANG_Confirma;
	$MULTILANG_UsrAddMenu='Agregar Men&uacute;es';
	$MULTILANG_UsrAddInfo='Agregar Informes';
	$MULTILANG_UsrAuditoria='Auditor&iacute;a';
	$MULTILANG_UsrAgregar='Agregar un usuario';
	$MULTILANG_UsrVerAudit='Ver auditoria de usuarios';
	$MULTILANG_UsrReset='Resetear clave';
    $MULTILANG_UsrOlvideClave='He olvidado mi clave';
    $MULTILANG_UsrOlvideUsuario='He olvidado mi usuario';
    $MULTILANG_UsrIngreseUsuario='Ingrese su nombre de usuario';
    $MULTILANG_UsrIngreseCorreo='Ingrese su correo electr&oacute;nico registrado';
    $MULTILANG_UsrResetAdmin='Si despu&eacute;s de realizar los pasos de restablecimiento de clave no ha podido obtener acceso al sistema exitosamente puede contactar al administrador de su plataforma, quien podr&aacute; restablecerla por usted.';
    $MULTILANG_UsrAsuntoReset='Restablecimiento de acceso';
    $MULTILANG_UsrMensajeReset='Se ha enviado un mensaje de correo con la informaci&oacute;n asociada al usuario y el restablecimiento de contrase&ntilde;a solicitado.<br><br>Recuerde revisar su buz&oacute;n de correo asociado incluyendo la bandeja de elementos no deseados en busca de las instrucciones.<br><br>Cualquier enlace de restablecimiento caducar&aacute; al dia siguiente de su solicitud o cuando sea utilizado al menos una vez.<hr>El asunto del correo enviado ser&aacute; algo como: <b>['.$NombreRAD.'] '.$MULTILANG_UsrAsuntoReset.'</b>';
    $MULTILANG_UsrErrorReset='La informaci&oacute;n ingresada para el restablecimiento de contrase&ntilde;a no es correcta, el usuario ingresado no existe o el correo ingresado no ha sido registrado en el sistema.  Verifique los datos e intente nuevamente.';
    $MULTILANG_UsrResetLink='Siga el siguiente enlace para restablecer su contrase&ntilde;a';
    $MULTILANG_UsrResetCuenta='Mensaje enviado a la cuenta';
    $MULTILANG_UsrResetOK='Se ha restablecido el acceso a su cuenta con la clave suministrada.  Intente su acceso nuevamente.';
    $MULTILANG_UsrPerfil='Perfil del usuario';
    $MULTILANG_UsrActualizarAdmin='Sus configuraciones indican que a&uacute;n no actualiza la direcci&oacute;n de correo electronico para el super usuario.  Esto es necesario para poder recibir alertas o recuperaciones de contrase&ntilde;a.  Vaya al menu de usuario en la parte superior derecha y haga clic sobre su nombre de usuario para actualizar el perfil.';
    $MULTILANG_UsrCreacionOK='El usuario ha sido creado satisfactoriamente.  Se filtra ahora para agregar cualquier opcion de menu o informe que corresponda.  Puede cancelar si no es necesario definir permisos en este momento.';
    $MULTILANG_UsrSaltarInformes='Saltar a permisos de INFORMES para este usuario';
    $MULTILANG_UsrSaltarMenues='Saltar a permisos de MENUES para este usuario';
   

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
	$MULTILANG_ParametrosApp='Par&aacute;metros para su aplicaci&oacute;n';
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
	$MULTILANG_AuthGoogle='Google / Google+ (Mediante OAuth2)';
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
	$MULTILANG_ErrorEscribirConfig='<b>Se han encontrado errores al tratar de escribir el archivo de configuraci&oacute;n !!!</b>:<br>Si lo desea una alternativa puede ser cambiar usted mismo los valores por defecto incluidos en el archivo core/configuracion.php o core/ws_llaves.php o core/ws_oauth.php dependiendo de la configuracion que estuviese actualizando.<br><br>Tambi&eacute;n puede cambiar los permisos al archivo de configuraci&oacute;n y probar nuevamente con este asistente.';
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
	$MULTILANG_AuthLDAPTitulo='Autenticacion basada en LDAP';
	$MULTILANG_AuthOauthPlantilla='Usuario plantilla';
	$MULTILANG_AuthOauthId='ID de cliente';
	$MULTILANG_AuthOauthSecret='Secreto de cliente';
	$MULTILANG_AuthOauthURI='URI redireccion';
	$MULTILANG_OauthTitURI='Antes de continuar, usted debe registrar una aplicaci&oacute;n con el proveedor correspondiente y obtener el ID, Secreto y URI para asociarla al servicio.  La URI a registrar con su proveedor es aquella calculada automaticamente por Practico en ese campo.';
	$MULTILANG_OauthDesURI='Tenga en cuenta que la URI de retorno debe estar asociada a un dominio o IP publica para poder ser resuelta por el proveedor. Esta URI se calcula automaticamente dependiendo del path al momento de instalacion.  Para ir a la URL donde se registran las aplicaciones haga clic sobre el logo correspondiente.';
	$MULTILANG_BuscarActual='Buscar actualizaciones automaticamente';
	$MULTILANG_DescActual='Se conecta de manera aleatoria durante algunos ingresos del admin para verificar si existen versiones nuevas de Practico.  Puede poner un poco lenta la carga del panel para el usuario admin mientras busca nuevas versiones.';
	$MULTILANG_ConfGraficas='Cambiar configuraciones graficas';

	//API-Webservices
	$MULTILANG_WSErrTitulo='Practico WebServices - Error';
	$MULTILANG_WSErr01='[Cod. 01] La llave suministrada es inv&aacute;lida';
	$MULTILANG_WSErr02='[Cod. 02] El valor secreto suministrado no es valido';
	$MULTILANG_WSErr03='[Cod. 03] No se encuentra el archivo de funciones para webservices.';
	$MULTILANG_WSErr04='[Cod. 04] No se ha suministrado una llave para consumir los servicios o la llave utilizada durante la instalaci&oacute;n fue vac&iacute;a.';
	$MULTILANG_WSErr05='[Cod. 05] El identificador de servicio, funci&oacute;n o m&eacute;todo a ejecutar no ha sido suministrado';
	$MULTILANG_WSErr06='[Cod. 06] Permisos insuficientes para ejecutar servicio: ';
	$MULTILANG_WSErr07='[Cod. 07] Acceso a la API no autorizado para la direccion: ';
	$MULTILANG_WSErr08='[Cod. 08] Acceso a la API no autorizado para el dominio: ';
	$MULTILANG_WSConfigButt='Llaves de WebServices';
	$MULTILANG_WSLlavesDefinidas='<b>Llaves definidas para el consumo de WebServices</b> (una por l&iacute;nea)';
	$MULTILANG_WSLlavesAyuda='Son aquellas autorizadas para ejecutar los webservices definidos en Pr&aacute;ctico o los personalizados por el usuario.  No es necesario agregar la llave de paso del sistema ya que esta se encuentra autorizada por defecto en todos los dominios y funciones';
	$MULTILANG_WSLlavesNuevo='Agregar nuevo cliente de API';
	$MULTILANG_WSLlavesBorrar='Se dispone a eliminar las llaves de API para el cliente seleccionado.  Cualquier aplicacion externa o intento de conexion que utilice este conjunto de llaves sera rechazado por Practico.  La operacion no se puede deshacer luego, Desea continuar?';
	$MULTILANG_WSLlavesNombre='Nombre cliente';
	$MULTILANG_WSLlavesLlave='Llave';
	$MULTILANG_WSLlavesSecreto='Secreto';
	$MULTILANG_WSLlavesURI='URI de redireccion';
	$MULTILANG_WSLlavesDominio='Dominio(s) autorizado(s)';
	$MULTILANG_WSLlavesIP='IP(s) autorizadas(s)';
	$MULTILANG_WSLlavesFunciones='Servicios permitidos';
	$MULTILANG_WSLlavesAsterisco='(*) Asterisco para cualquiera';

	//OAuth
	$MULTILANG_OauthButt='Autenticacion OAuth';
	$MULTILANG_ProtoTransporte='Protocolo de transporte preferido';
	$MULTILANG_ProtoTransAUTO='Autodetectar por URL';
	$MULTILANG_ProtoTransHTTP='HTTP sin cifrar';
	$MULTILANG_ProtoTransHTTPS='HTTP cifrado';
	$MULTILANG_ProtoDescripcion='Autodetectar mira la URL mediante la cual accede el usuario y segun su cabecera determina si usa o no el cifrado,  HTTP sin cifrar permite aquellos con certificados autofirmados no validos poder recibir el webservice de autenticacion.  Es un modo no mas seguro pero si mas efectivo de siempre hacer login.   HTTP Cifrado requiere un certificado SSL valido emitido por un CA en su servidor.';
	
	//Login Federado
	$MULTILANG_TitFederado='Autenticaci&oacute;n Federada';
	$MULTILANG_CampoUsuarioFederado='Campo de usuario';
	$MULTILANG_CampoClaveFederado='Campo de contrase&ntilde;a';

	//Modulo de monitoreo
	$MULTILANG_MonTitulo='Sistema de monitoreo';
	$MULTILANG_MonPgInicio='Pagina de inicio';
	$MULTILANG_MonConfig='Configurar la lista de monitores';
	$MULTILANG_MonNuevo='Agregar un nuevo monitor';
	$MULTILANG_MonCommShell='Comando Shell';
	$MULTILANG_MonCommSQL='Consulta SQL';
	$MULTILANG_MonDesTipo='Indica el tipo de elemento que sera agregado a la pagina de monitoreo';
	$MULTILANG_MonMetodo='Metodo utilizado';
	$MULTILANG_MonSaltos='Saltos de linea';
	$MULTILANG_MonTamano='Tama&ntilde;o fuente SQL';
	$MULTILANG_MonOcultaTit='Ocultar titulos';
	$MULTILANG_MonCorreoAlerta='Correo para alertas';
	$MULTILANG_MonAlertaSnd='Alerta sonora';
	$MULTILANG_MonMsLectura='Milisegundos para lectura';
	$MULTILANG_MonDefinidos='Paginas y Monitores definidos';
	$MULTILANG_MonErr='Se requiere el campo de nombre como minimo';
	$MULTILANG_MonEstado='Estado del sistema';
	$MULTILANG_MonAcerca='&copy; Sistema de monitoreo basado en <a href="http://www.practico.org" style="color:#FFFFFF"><font color=white><b>Practico.org</b></font></a>';
	$MULTILANG_AplicaPara='Esto aplica para: ';
	$MULTILANG_MonLinea='EN LINEA';
	$MULTILANG_MonCaido='CAIDO';

    //Modulo de correos
    $MULTILANG_MailIntro1='Mensaje autom&aacute;tico de la plataforma';
    $MULTILANG_MailIntro2='Informaci&oacute;n detallada sobre este mensaje puede ser encontrada accesando a la herramienta <span style="font-weight: bold;">'.$NombreRAD.'</span> con su nombre de usuario y contrase&ntilde;a';
    $MULTILANG_MailIntro3='Este correo fue generado por un sistema autom&aacute;tico, por favor no responda a este mensaje.';
    $MULTILANG_MailIntro4='Recuerde que nunca le ser&aacute; solicitada informaci&oacute;n personal o contrase&ntilde;as v&iacute;a correo electr&oacute;nico</span>, por lo tanto no conteste o diligencie formularios donde se solicite este tipo de informaci&oacute;n y que se encuentren por fuera del sistema '.$NombreRAD.'.';
    $MULTILANG_MailIntro5='La informaci&oacute;n contenida en este correo electr&oacute;nico y en todos sus archivos anexos, es confidencial y/o exclusiva del negocio y puede ser utilizada &uacute;nicamente por la (s) persona (s) a la (s) cual (es) est&eacute; dirigida. Si usted no es el destinatario autorizado, cualquier modificaci&oacute;n, retenci&oacute;n, difusi&oacute;n, distribuci&oacute;n o copia total o parcial de este mensaje y/o de la informaci&oacute;n contenida en este y/o en sus archivos anexos esta prohibida y son sancionados por la ley. Si recibe este mensaje por error, s&iacute;rvase borrarlo de inmediato, notificarle de su error a la persona que lo envi&oacute; y abstenerse de divulgar su contenido e informaci&oacute;n anexa.';
    $MULTILANG_MailIntro6='<br><br>Sistema potenciado por <a href=http://www.practico.org>www.practico.org</a>';

