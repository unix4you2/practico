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
	$MULTILANG_Ambiente='Ambiente';
	$MULTILANG_Ambos='Ambos';
	$MULTILANG_Anonimo='An&oacute;nimo';
	$MULTILANG_Anterior='Anterior';
	$MULTILANG_Apagado='Apagado';
	$MULTILANG_Apariencia='Apariencia';
	$MULTILANG_Aplicacion='Aplicaci&oacute;n';
    $MULTILANG_Aplicando='Aplicando';
    $MULTILANG_Archivo='Archivo';
	$MULTILANG_Asistente='Asistente';
	$MULTILANG_Atencion='Atenci&oacute;n';
	$MULTILANG_Avanzado='Avanzado';
	$MULTILANG_Ayuda='Ayuda';
	$MULTILANG_Basedatos='Base de datos';
	$MULTILANG_Basicos='B&aacute;sicos';
    $MULTILANG_BarraHtas='Barra de herramientas';
    $MULTILANG_Bienvenido='Bienvenido';
    $MULTILANG_Buscar='Buscar';
	$MULTILANG_Campo='Campo';
	$MULTILANG_Cancelar='Cancelar';
	$MULTILANG_Capturar='Capturar';
    $MULTILANG_Cargando='Cargando';
    $MULTILANG_Cargar='Cargar';
	$MULTILANG_Cerrar='Cerrar';
	$MULTILANG_CerrarSesion='Cerrar sesi&oacute;n';
	$MULTILANG_Cliente='Cliente';
	$MULTILANG_CodigoBarras='C&oacute;digo de barras';
	$MULTILANG_Columna='Columna';
	$MULTILANG_Comando='Comando';
	$MULTILANG_Configuracion='Configuraci&oacute;n';
	$MULTILANG_ConfiguracionGeneral='Configuraci&oacute;n General';
	$MULTILANG_ConfiguracionVarias='Configuraci&oacute;n de opciones varias';
	$MULTILANG_Confirma='Est&aacute; seguro que desea continuar ?';
	$MULTILANG_Continuar='Continuar';
	$MULTILANG_Contrasena='Contrase&ntilde;a';
	$MULTILANG_Controlador='Controlador';
    $MULTILANG_Copias='Copias de seguridad';
	$MULTILANG_Correcto='Correcto';
	$MULTILANG_Correo='Correo';
	$MULTILANG_Creditos='Cr&eacute;ditos';
	$MULTILANG_Cualquiera='Cualquiera';
	$MULTILANG_Defina='Defina';
	$MULTILANG_Descargar='Descargar';
    $MULTILANG_Deshabilitado='Deshabilitado';
    $MULTILANG_Desplazar='Desplazar';
	$MULTILANG_Detalles='Detalles';
	$MULTILANG_Disene='Dise&ntilde;e';
	$MULTILANG_Editar='Editar';
	$MULTILANG_Ejecutar='Ejecutar';
	$MULTILANG_Elementos='Elementos';
	$MULTILANG_Eliminar='Eliminar';
	$MULTILANG_Embebido='Embebido';
	$MULTILANG_Encabezados='Encabezados';
	$MULTILANG_Encendido='Encendido';
	$MULTILANG_Error='Error';
	$MULTILANG_Escritorio='Escritorio';
    $MULTILANG_Estado='Estado';
	$MULTILANG_Etiqueta='Etiqueta';
    $MULTILANG_Evento='Evento';
    $MULTILANG_Existentes='Existentes';
    $MULTILANG_Explorar='Explorar';
    $MULTILANG_Exportar='Exportar';
	$MULTILANG_Fecha='Fecha';
	$MULTILANG_Finalizado='Finalizado';
    $MULTILANG_Filtro='Filtro';
	$MULTILANG_Formularios='Formularios';
	$MULTILANG_Funciones='Funciones preautorizadas';
	$MULTILANG_FuncionesDes='Por motivos de seguridad, sus funciones personalizadas o modulos desarrollados usted debe preautorizar su uso en este cuadro para los usuarios.  Agregue las funciones o acciones separadas por cualqueir caracter.';
	$MULTILANG_GeneradoPor='Generado por';
	$MULTILANG_General='General';
	$MULTILANG_Grande='Grande';
	$MULTILANG_Grafico='Gr&aacute;fico';
	$MULTILANG_Guardar='Guardar';
    $MULTILANG_Guardando='Guardando';
	$MULTILANG_Habilitado='Habilitado';
	$MULTILANG_Habilitar='Habilitar';
    $MULTILANG_Historico='Hist&oacute;rico';
	$MULTILANG_Hora='Hora';
	$MULTILANG_Horizontal='Horizontal';
	$MULTILANG_IdiomaPredeterminado='Idioma predeterminado';
	$MULTILANG_Imagen='Imagen';
	$MULTILANG_Importando='Importando';
	$MULTILANG_Importante='Importante';
	$MULTILANG_Importar='Importar';
	$MULTILANG_InfoAdicional='Informaci&oacute;n adicional';
	$MULTILANG_Informes='Informes';
	$MULTILANG_Ingresar='Ingresar';
	$MULTILANG_Instante='Instante';
    $MULTILANG_Ir='Ir';
	$MULTILANG_IrEscritorio='Ir a mi escritorio';
	$MULTILANG_Licencia='Licencia';
	$MULTILANG_LlavePaso='Llave de paso';
	$MULTILANG_Maquina='Maquina';
	$MULTILANG_Matriz='Matriz';
	$MULTILANG_Mediano='Mediano';
	$MULTILANG_Modulos='M&oacute;dulos';
	$MULTILANG_Mostrando='Mostrando';
    $MULTILANG_MotorBD='Motor de Base de Datos';
	$MULTILANG_Ninguno='Ninguno';
	$MULTILANG_No='No';
	$MULTILANG_Nombre='Nombre';
	$MULTILANG_NombreRAD='Nombre RAD';
	$MULTILANG_Objeto='Objeto';
	$MULTILANG_OlvideClave='Olvid&eacute; mi clave';
    $MULTILANG_Opcional='Opcional';
    $MULTILANG_Opcion='Opci&oacute;n';
	$MULTILANG_OpcionesMenu='Opciones de menu';
	$MULTILANG_Otros='Otros';
	$MULTILANG_Pagina='Pagina';
	$MULTILANG_ParamApp='Par&aacute;metros de aplicaci&oacute;n';
	$MULTILANG_Paso='Paso';
	$MULTILANG_Pausar='Pausar';
	$MULTILANG_Peso='Peso';
	$MULTILANG_Pequeno='peque&ntilde;o';
	$MULTILANG_Personalizado='Personalizado';
    $MULTILANG_Pestana='Pesta&ntilde;a';
    $MULTILANG_Plantilla='Plantilla';
	$MULTILANG_Predeterminado='Predeterminado';
    $MULTILANG_Previo='Previo';
    $MULTILANG_Primero='Primero';
    $MULTILANG_Prioridad='Prioridad';
	$MULTILANG_Procesando='Procesando';
    $MULTILANG_ProcesoFin='Proceso finalizado';
    $MULTILANG_Proveedores='Proveedores';
	$MULTILANG_Puerto='Puerto';
    $MULTILANG_Recurrente='Recurrente';
	$MULTILANG_Registrarme='Registrarme';
    $MULTILANG_Repetir='Repetir';
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
	$MULTILANG_Tamano='Tama&ntilde;o';
	$MULTILANG_Tareas='Tareas';
	$MULTILANG_TiempoCarga='Tiempo de carga';
	$MULTILANG_Tipo='Tipo';
	$MULTILANG_TipoMotor='Tipo de motor';
	$MULTILANG_Titulo='T&iacute;tulo';
	$MULTILANG_TotalRegistros='Total registros encontrados';
	$MULTILANG_Trazabilidad='Trazabilidad';
	$MULTILANG_Truncar='Truncar';
	$MULTILANG_Ultimo='Ultimo';
    $MULTILANG_Usuario='Usuario';
	$MULTILANG_Vacio='Vac&iacute;o';
	$MULTILANG_Variables='Variables';
	$MULTILANG_Version='Versi&oacute;n';
	$MULTILANG_Vertical='Vertical';
	$MULTILANG_ZonaHoraria='Zona horaria';
	$MULTILANG_ZonaPeligro='Zona de peligro';
	$MULTILANG_VistaImpresion='Vista de impresion';
	$MULTILANG_IDGABeacon='ID Google Analytics';
	$MULTILANG_AyudaGABeacon='Aquellos desarrolladores que deseen tener un seguimiento historico detallado o incluso en tiempo real del uso de su herramienta a traves de Google Analytics pueden diligenciar aqui el ID obtenido en su panel de Google.  Practico reportara todo movimiento a su panel de Analytics asi como registros de instalacion a los desarrolladores del Framework.';

	//Ventana de login
	$MULTILANG_TituloLogin='Ingreso al sistema';
	$MULTILANG_CodigoSeguridad='C&oacute;digo de seguridad';
	$MULTILANG_IngreseCodigoSeguridad='Ingrese el c&oacute;digo';
	$MULTILANG_AccesoExclusivo='El acceso a este software es exclusivo para usuarios registrados. Por su seguridad, nunca comparta su nombre de usuario y contrase&ntilde;a.';
	$MULTILANG_LoginNoWSTit='Error tratando de alcanzar el webservice de autenticacion';
	$MULTILANG_LoginNoWSDes='La funcion file_get_contents() no puede cargar correctamente el archivo XML generado por el web service de autenticacion de Practico.<br>  Verifique la instalacion de su servidor web para validar que la funcion opera correctamente y sin restricciones.<br>  Una forma de validar si el proceso de autenticacion es correcto pero es su servidor quien no deja abrir el resultado<br>es abriendo el siguiente enlace y viendo si carga correctamente el XML.<br>  Activar el modo de depuracion en la configuracion de Practico puede ayudar a ver mas detalles.';
	$MULTILANG_OauthLogin='Iniciar con mi red social';
	$MULTILANG_LoginClasico='Usar mi cuenta';
	$MULTILANG_LoginOauthDes='Seleccione el logo de su red social o proveedor favorito para ingresar al sistema usando las mismas credenciales.';
	$MULTILANG_CaracteresCaptcha='N&uacute;mero de caracteres o simbolos para captcha?';
	$MULTILANG_TipoCaptcha='Tipo de captcha utilizado pantalla de acceso';
	$MULTILANG_TipoCaptchaTradicional='Tradicional (numeros y letras), requiere PHP GD habilitado.';
	$MULTILANG_TipoCaptchaVisual='Seleccion visual de imagenes. No requiere libreria GD';
	$MULTILANG_TipoCaptchaPrefijo='Haga clic o toque el icono de';
	$MULTILANG_TipoCaptchaPosfijo='para validar';
    $MULTILANG_SimboloCaptchaCarro='CARRO';
    $MULTILANG_SimboloCaptchaTijeras='TIJERAS';
    $MULTILANG_SimboloCaptchaCalculadora='CALCULADORA';
    $MULTILANG_SimboloCaptchaBomba='BOMBA';
    $MULTILANG_SimboloCaptchaLibro='LIBRO';
    $MULTILANG_SimboloCaptchaPastel='PASTEL';
    $MULTILANG_SimboloCaptchaCafe='CAFE';
    $MULTILANG_SimboloCaptchaNube='NUBE';
    $MULTILANG_SimboloCaptchaDiamante='DIAMANTE';
    $MULTILANG_SimboloCaptchaMujer='MUJER';
    $MULTILANG_SimboloCaptchaHombre='HOMBRE';
    $MULTILANG_SimboloCaptchaBalon='BALON';
    $MULTILANG_SimboloCaptchaControl='CONTROL';
    $MULTILANG_SimboloCaptchaCasa='CASA';
    $MULTILANG_SimboloCaptchaCelular='CELULAR';
    $MULTILANG_SimboloCaptchaArbol='ARBOL';
    $MULTILANG_SimboloCaptchaTrofeo='TROFEO';
    $MULTILANG_SimboloCaptchaSombrilla='SOMBRILLA';
    $MULTILANG_SimboloCaptchaUniversidad='UNIVERSIDAD';
    $MULTILANG_SimboloCaptchaCamara='CAMARA';
    $MULTILANG_SimboloCaptchaAmbulancia='AMBULANCIA';
    $MULTILANG_SimboloCaptchaAvion='AVION';
    $MULTILANG_SimboloCaptchaTren='TREN';
    $MULTILANG_SimboloCaptchaBicicleta='BICICLETA';
    $MULTILANG_SimboloCaptchaCamion='CAMION';
    $MULTILANG_SimboloCaptchaCorazon='CORAZON';
	$MULTILANG_LogoParteSuperior='Logo en la parte superior izquierda de su aplicaci&oacute;n';
	$MULTILANG_LogoDuranteLogin='Logo al momento de login de su aplicaci&oacute;n';
	$MULTILANG_ResolucionLogos='Si la imagen cargada no cuenta con la resoluci&oacute;n indicada esta ser&aacute; redimensionada cada que se presente al usuario.';

	//Banderas de campos en formularios
	$MULTILANG_TitValorUnico='El valor ingresado no acepta duplicados';
	$MULTILANG_DesValorUnico='El sistema validar&aacute; la informaci&oacute;n ingresada en este campo, en caso de ya existir en la base de datos no se permitir&aacute; su ingreso.';
	$MULTILANG_TitObligatorio='Campo obligatorio';
	$MULTILANG_DesObligatorio='Usted debe ingresar un valor en este campo';

	//Errores y avisos varios
	$MULTILANG_VistaPrev='Vista previa';
	$MULTILANG_TituloInsExiste='ATENCION: La carpeta de instalaci&oacute;n existe en el servidor';
	$MULTILANG_TextoInsExiste='Este mensaje aparecer&aacute; de manera permanente a todos sus usuarios mientras usted no elimine el directorio utilizado durante el proceso de instalaci&oacute;n de Pr&aacute;ctico.  Es fundamental que la carpeta sea eliminada despu&eacute;s de finalizar una instalaci&oacute;n para evitar que algun usuario an&oacute;nimo inicie nuevamente el proceso sobreescribiendo archivos de configuraci&oacute;n o bases de datos con informaci&oacute;n de importancia para usted.<br><br>Si ya ha finalizado un proceso de instalaci&oacute;n de Pr&aacute;ctico para su uso en producci&oacute;n es importante que elimine esta carpeta antes de continuar.  Si no desea eliminar esta carpeta puede optar por renombrarla en instalaciones temporales o de prueba.<br><br>Si est&aacute; visualizando este mensaje al ejecutar este script por primera vez y desea realizar una instalaci&oacute;n nueva, puede iniciar el asistente haciendo <a class="btn btn-primary btn-xs" href="javascript:document.location=\'ins\';"><i class="fa fa-rocket"></i> Clic AQUI</a> ';
	$MULTILANG_ErrorTiempoEjecucion='Error en tiempo de ejecuci&oacute;n';
	$MULTILANG_ErrorModulo='El modulo central esta tratando de incluir un modulo ubicado en <b>mod/</b> pero no encuentra su punto de accceso.<br>Verifique el estado del m&oacute;dulo, consulte con su administrador o elimine el m&oacute;dulo en conflicto para evitar este mensaje.';
	$MULTILANG_ContacteAdmin='Contacte con el administrador de su sistema y comunique este mensaje.';
	$MULTILANG_ReinicieWeb='Por favor haga los ajustes requeridos y reinicie su servicio web.';
	$MULTILANG_PHPSinSoporte='Su instalacion de PHP parece no tener soporte';
	$MULTILANG_ErrExtension='Extensi&oacute;n PHP faltante, sin activar o Modulo requerido';
	$MULTILANG_ErrLDAP=$MULTILANG_PHPSinSoporte.' para LDAP activado para ser usado como metodo de autenticacion externa.<br>'.$MULTILANG_ReinicieWeb.'.<br>La autenticaci&oacute;n del usuario admin seguir&aacute; siendo independiente para evitar p&eacute;rdida de acceso.';
	$MULTILANG_ErrHASH=$MULTILANG_PHPSinSoporte.' para HASH activado.<br>Este se requiere cuando es seleccionado un tipo de encripci&oacute;n diferente al plano para contrase&ntilde;as sobre motores de autenticaci&oacute;n externos.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrSESS=$MULTILANG_PHPSinSoporte.' para sesiones activado. '.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrGD=$MULTILANG_PHPSinSoporte.' para librer&iacute;a gr&aacute;fica GD &oacute; GD2 activado.<br>Aquellos utilizando debian, ubuntu o sus derivados pueden intentar un <b>apt-get install php5-gd</b> para agregarlo. Usuarios de Redhat/CentOS <b>yum install php-gd</b>.  Usuarios de otros sistemas revisar su documentacion.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrCURL=$MULTILANG_PHPSinSoporte.' para librer&iacute;a cURL activado.<br>Aquellos utilizando debian, ubuntu o sus derivados pueden intentar un <b>apt-get install php5-curl</b> para agregarlo.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrSimpleXML=$MULTILANG_PHPSinSoporte.' para librer&iacute;a SimpleXML activado.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrExtensionGenerica=$MULTILANG_PHPSinSoporte.' activado para esta librer&iacute;a o extensi&oacute;n.<br>'.$MULTILANG_ReinicieWeb;
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
    $MULTILANG_BuscaCriterios='Debe indicar al menos una palabra o criterio de b&uacute;squeda';
    $MULTILANG_EstadoPHP='Informaci&oacute;n de su PHP';
    $MULTILANG_ArchivosLimpiados='Archivos Limpiados/Purgados';
    $MULTILANG_EspacioLiberado='Espacio liberado en disco';
    $MULTILANG_TitDemo='La funcion solicitada no se encuentra disponible';
    $MULTILANG_MsjDemo='<b>Usted se encuentra en una instalacion en modo DEMO (o demostracion).</b>  Este tipo de instalaciones no permiten interactuar libremente con todos los controles por seguridad.  Esto ayuda a garantizar que el acceso siempre este disponible para todos los usuarios que quieran probar la plataforma.  <br><br>Si desea probar estas funciones haga una instalacion propia de Practico Framework.';
    $MULTILANG_SeparadorCampos='Cadena separadora de campos';
    $MULTILANG_SeparadorCamposDes='Utilizada para separar valores en Queries y consultas sobre el motor de base de datos.  Generalmente debe ser un valor poco comun que no pueda ser encontrado en las variables entradas por el usuario';
    $MULTILANG_SelectorIdioma='El usuario puede cambiar idioma en login';
    $MULTILANG_SelectorIdiomaAyuda='Presenta una lista de seleccion durante el inicio de sesi&oacute;n con los idiomas disponibles en la plataforma para que el usuario lo seleccione.';
    $MULTILANG_ErrorConexionInternet='Parece que te has quedado sin conexion a Internet, la conexión al sistema será restablecida cuando tu conexión a Internet se encuentre normal.<br><br>Verifica que tu conexión de red o señal de datos se encuentren activos.';
    $MULTILANG_NombreRADDes='Nombre del generador de aplicaciones.  Utilizado adem&aacute;s como t&iacute;tulo de todas las ventanas en la aplicaci&oacute;n.';
    $MULTILANG_SaltoEdicion='Usted se dispone a cerrar la edicion del elemento actual y saltar a la ventana de edicion del elemento selecionado.  Desea continuar?';
    $MULTILANG_ExportacionMasiva='Exportación masiva';
    $MULTILANG_AgregarAExportacion='Agregar elemento a lista de exportación masiva';
    $MULTILANG_ImagenFondo='Imagen de fondo';
    $MULTILANG_ImagenFondoDes='Define una imagen de fondo para personalizar su aplicacion.  Se recomienda amplia pero livianada.  Recomendacion:  Deberia combinar los colores de tema y controles con la paleta de imagen para armonizar su diseno.   Por defecto el valor es img/fondo.jpg pero podra cambiarlo a cualquier ruta relativa desde la raiz del sistema, incluso hacia archivos animados.';
    $MULTILANG_ImagenDefecto='Vacio para ninguna o path relativo';
    
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
	$MULTILANG_DefAvanzadas='Herramientas avanzadas';
	$MULTILANG_DefMantenimientos='Mantenimientos';
	$MULTILANG_DefPcoder='Editor de c&oacute;digo';
	$MULTILANG_DefLimpiarTemp='Limpiar carpeta de trabajo /tmp';
	$MULTILANG_DefLimpiarBackups='Limpiar copias de seguridad existentes en /bkp';
	$MULTILANG_DefPMyDB='Administrador avanzado de base de datos';
	$MULTILANG_ConfirmaPMyDB='IMPORTANTE: La incorrecta manipulacion de las tablas y su informacion por medio del administrador avanzado de base de datos puede ocasionar perdida parcial o total de la informacion asi como funcionamientos impredecibles en su aplicacion.  Se recomienda utilizar este gestor de base de datos con el cuidado que implica.';

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
    $MULTILANG_ActBackupTipo='Tipo de copia de seguridad';
    $MULTILANG_ActBackup1='Solo scripts reemplazados por el parche';
    $MULTILANG_ActBackup3='Scripts reemplazados y base de datos actual';
    $MULTILANG_ActBackupDes='La realizacion de copias de seguridad puede ser una tarea costosa para el sistema.  En sistemas ampliamente utilizados una copia de seguridad incluyendo su base de datos deber&iacute;a ser realizada por otros medios donde garantice que no se ve alterada por el trabajo concurrente de los usuarios.';

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
	$MULTILANG_FrmTipo3='Campo de texto con formato (CKEditor)';
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
    $MULTILANG_FrmTipo17='Campo de texto con formato (Responsive)';
    $MULTILANG_FrmTipo18='Casilla de verificaci&oacute;n (CheckBox)';
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
	$MULTILANG_FrmDesFiltroLista='Condicion especial que deben cumplir los registros de la lista para poder ser desplegados.  Puede hacer referencia a campos que no se encuentren dentro de los seleccionados o valores fijos encerrados en comillas dobles.  En esencia lo aqui ingresado sera agregado a la consulta de registros despues del WHERE, asi que puede agregar tambien otras clausulas como ORDER BY, GROUP BY, LIMIT, entre otras.  RECUERDE: Si usted desea un GROUP BY o un ORDER BY sin una condicion entonces al menos deberia agregar una condicion de 1=1 al comienzo para cumplir con la sintaxis de SQL despues del WHERE. Tambien puede usar notacion {$Variable} para referirse a variables PHP';
	$MULTILANG_FrmCampoOb1='Campo obligatorio para controles de datos';
	$MULTILANG_FrmDesCampo='Campo de la tabla de datos al cual se vincular&aacute; la informaci&oacute;n.  Para controles de tipo archivo puede representar el campo donde se almacena el path del archivo sobre el servidor. Cada control tipo archivo deberia tener al menos un campo sobre la tabla donde guardar el path.';
	$MULTILANG_FrmValUnico='Campo de valor &uacute;nico';
	$MULTILANG_FrmTitUnico='Unicidad para los valores ingresados';
	$MULTILANG_FrmDesUnico='Indica si el campo puede almacenar o no valores repetidos en la base de datos.  Deber&iacute;a estar habilitado para campos que representen claves primarias en su dise&ntilde;o y deshabilitado para el resto.  Debera tener especial cuidado con aquellos formularios donde desee dejar el campo para actualizaciones y que pueda generar error de valor duplicado.';
	$MULTILANG_FrmPredeterminado='Valor predeterminado';
	$MULTILANG_FrmDesPredeterminado='Establece el valor que aparece diligenciado automaticamente en el campo al abrir la vista del formulario.  Este valor puede estar en contrav&iacute;a de la validaci&oacute;n de datos.  Si se ingresan variables PHP definidas en la sesi&oacute;n entonces se tomara su valor.';
	$MULTILANG_FrmValida='Validaci&oacute;n de datos';
	$MULTILANG_FrmValida1='S&oacute;lo n&uacute;meros 0-9 (con decimales)';
	$MULTILANG_FrmValida2='S&oacute;lo letras a-z A-Z';
	$MULTILANG_FrmValida3='Letras y n&uacute;meros';
	$MULTILANG_FrmValida4='Campo de fecha usando calendario unificado';
	$MULTILANG_FrmValida7='Campo de fecha usando selectores independientes (ano, mes y dia)';
	$MULTILANG_FrmValida5='Campo de hora';
	$MULTILANG_FrmValida6='Campo de fecha y hora';
	$MULTILANG_FrmValida8='Campo de fecha y hora con selector unificado';
	$MULTILANG_FrmValidaDes='Tipo de filtro a ser aplicado cuando el usuario ingresa informaci&oacute;n por teclado';
	$MULTILANG_FrmLectura='Campo de solo lectura';
	$MULTILANG_FrmTitLectura='Define si se puede cambiar su valor';
	$MULTILANG_FrmDesLectura='Propiedad util para campos o formularios de consulta por parte del usuario donde se requiere visualizar el valor pero no permitir su modificaci&oacute;n';
	$MULTILANG_FrmAyuda='T&iacute;tulo de ayuda';
	$MULTILANG_FrmDesAyuda='Texto que aparecer&aacute; como encabezado para el texto de ayuda del campo explicando al usuario qu&eacute; debe ingresar';
	$MULTILANG_FrmTxtAyuda='Texto de ayuda';
	$MULTILANG_FrmDesTxtAyuda='Texto completo con la descripci&oacute;n de funciones resumida para el campo.  Puede incluir instrucciones de formato, advertencias o cualquier otro mensaje para el usuario';
	$MULTILANG_FrmDesPeso='Posici&oacute;n en la que aparece el campo dentro del formulario cuando este se despliega en pantalla. Orden.';
	$MULTILANG_FrmDesColumna='Columna para ubicar el campo cuando la vista del formulario tenga varias columnas. Aquellos campos en columnas superiores a las definidas en el formulario no ser&aacute;n dibujados';
	$MULTILANG_FrmObligatorio='Obligatorio';
	$MULTILANG_FrmVisible='Visible';
	$MULTILANG_FrmDesVisible='Determina si el control es visible o no para el usuario.  Si se deja como No el control es usado pero como un campo oculto';
	$MULTILANG_FrmLblBusqueda='Utilizar para b&uacute;squedas? Etiqueta';
	$MULTILANG_FrmTitBusqueda='Indica si el campo es usado para buscar registros';
	$MULTILANG_FrmDesBusqueda='Deje el espacio en blanco para indicar que es un campo normal o ingrese la etiqueta que debe ir en el boton de comando ubicado al lado derecho del campo para realizar la busqueda de registros';
	$MULTILANG_FrmAjax='Usar AJAX para recargar la lista completa de opciones';
	$MULTILANG_FrmAjaxDinamico='Usar AJAX para recuperar items din&aacute;micamente mientras digita';
	$MULTILANG_FrmTitAjax='Modo de recuperaci&oacute;n de registros';
	$MULTILANG_FrmDesAjax='Cuando la casilla se encuentra activada Practico intenta recuperar la informaci&oacute;n del registro para el formulario mediante AJAX, En listas de seleccion cuyo valor es obtenido desde tablas esto crea un boton de actualizacion dinamico de la lista.';
	$MULTILANG_FrmTeclado='Agregar teclado virtual';
	$MULTILANG_FrmTitTeclado='Ingreso de informaci&oacute;n sin teclado';
	$MULTILANG_FrmDesTeclado='Cuando es habilitado en el formulario se despliega un teclado virtual para el ingreso de informaci&oacute;n;.  Por ahora el uso del teclado puede violar las validaciones';
	$MULTILANG_FrmAncho='Ancho';
	$MULTILANG_FrmTitAncho='Cu&aacute;nto espacio de ancho debe ocupar el control';
	$MULTILANG_FrmDesAncho='IMPORTANTE: en n&uacute;mero de caracteres para texto simple o en pixeles para texto con formato o campos de selecci&oacute;n.  Vacio o cero indica automatico.  Indique un n&uacute;mero de columnas, sin embargo, tenga presente que el ancho en pixeles ser&aacute; variable de acuerdo al tipo de fuente utilizada por el tema actual. Para campos con imagenes o codigos de barra esto representa su tamano en pixeles.  Para objetos tipo area de dibujo canvas se puede indicar el ancho o el alto y su porcentaje final separado por barra de canalizacion.  Ej: 400|0.3 Crea el objeto con un tamano de 400 pixels en pantalla pero lo almacena a un tamano final del 30% de su escala inicial.  Si no se indica el segundo parametro se asume 100% de escala';
	$MULTILANG_FrmDesAncho2='M&iacute;nimo recomendado en campos con formato: 350';
	$MULTILANG_FrmAlto='Alto (l&iacute;neas)';
	$MULTILANG_FrmTitAlto='Cu&aacute;ntas filas deben estar visibles en el control?';
	$MULTILANG_FrmDesAlto='IMPORTANTE: en n&uacute;mero de filas para texto simple o en pixeles para texto con formato.  En caso que el texto supere el n&uacute;mero de filas se agregar&aacute;n autom&aacute;ticamente barras de desplazamiento. Para campos con imagenes o codigos de barra esto representa su tamano en pixeles.';
	$MULTILANG_FrmDesAlto2='M&iacute;nimo recomendado en campos con formato: 100';
	$MULTILANG_FrmBarra='Barra de edici&oacute;n';
	$MULTILANG_FrmBarraCKEditor='Disponibles para CKEditor';
	$MULTILANG_FrmBarraSummer='Disponibles para SummerNote (Responsive)';
	$MULTILANG_FrmBarraTipo1='B&aacute;sica: Documento, formato de caracter y p&aacute;rrafo';
	$MULTILANG_FrmBarraTipo2='Est&aacute;ndar: B&aacute;sica + Enlaces, estilos de fuente';
	$MULTILANG_FrmBarraTipo3='Extendida: Est&aacute;ndar + Portapapeles, buscar-reemplazar y ortograf&iacute;a';
	$MULTILANG_FrmBarraTipo4='Avanzada: Extendida + Insertar objetos y colores';
	$MULTILANG_FrmBarraTipo5='Completa: Avanzada +  Formularios y pantalla completa';
	$MULTILANG_FrmBarraTipo1Summer='B&aacute;sica: Formato de caracter y p&aacute;rrafo';
	$MULTILANG_FrmBarraTipo2Summer='Est&aacute;ndar: B&aacute;sica + Estilos de fuente';
	$MULTILANG_FrmBarraTipo3Summer='Extendida: Est&aacute;ndar + Tablas, enlaces y lineas';
	$MULTILANG_FrmBarraTipo4Summer='Avanzada: Extendida + Pantalla completa y Fuente HTML';
	$MULTILANG_FrmBarraTipo5Summer='Completa: Avanzada + Insertar objetos de video o imagen';
	$MULTILANG_FrmTitBarra='Tipo de editor utilizado';
	$MULTILANG_FrmDesBarra='Indica el tipo de barra de herramientas que aparecer&aacute; en la parte superior del control y que permitir&aacute; realizar al usuario las diferentes tareas de edici&oacute;n del texto. IMPORTANTE: Cada tipo de editor requiere un espacio diferente en el formulario ya que debe desplegar un n&uacute;mero de iconos y opciones diferentes';
	$MULTILANG_FrmFila='Fila &uacute;nica para este objeto?';
	$MULTILANG_FrmTitFila='Se debe utilizar una fila completa para el objeto?';
	$MULTILANG_FrmDesFila='Permite desplegar el objeto en una fila exclusiva de la tabla usada en el formulario';
	$MULTILANG_FrmLista='Lista de opciones';
	$MULTILANG_FrmTitLista='Qu&eacute; opciones aparecen para ser escogidas.  Ingrese una coma solamente para indicar que se desea el valor predeterminado como vacio.  Dejar vacio para que se tome el primer valor del registro.  Ingrese _OPTGROUP_|Etiqueta para generar grupos de opciones y _OPTGROUP_ solo para cerrar grupos de opciones.';
	$MULTILANG_FrmDesLista='Ingrese una lista de opciones separadas por coma.  Si requiere tomar las opciones din&aacute;micamente desde otra tabla de la aplicaci&oacute;n utilice los campos de Origen de datos para opciones.  En caso de llenar ambas opciones (lista fija y origen de datos) el resultado ser&aacute; su combinaci&oacute;n';
	$MULTILANG_FrmDesLista2='Separadas por coma';
	$MULTILANG_FrmOrigen='Origen de la lista de opciones';
	$MULTILANG_FrmTitOrigen='Debe especificar el mismo origen (tabla) de la lista de valores';
	$MULTILANG_FrmDesOrigen='Campo desde el cual se toman las opciones que despliega la lista';
	$MULTILANG_FrmTitOrigen2='Que es esto?';
	$MULTILANG_FrmOrigenVal='Origen de la lista de valores';
	$MULTILANG_FrmTitOrigenVal='Debe especificar el mismo origen (tabla) de la lista de opciones';
	$MULTILANG_FrmDesOrigenVal='Campo desde el cual se toman los valores internos (a ser procesados) para cada opcion de la lista.    Si el campo contiene _OPTGROUP_|Etiqueta se genera un grupo de opciones y  si contiene _OPTGROUP_ solo se cierra un grupo de opciones.';
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
	$MULTILANG_FrmAccionEliminar='Eliminar datos (requiere un campo de valor unico, aunque sea oculto)';
	$MULTILANG_FrmAccionActualizar='Actualizar datos';
	$MULTILANG_FrmAccionRegresar='Regresar a escritorio';
	$MULTILANG_FrmAccionCargar='Cargar un objeto';
	$MULTILANG_FrmAccionT2='Definidas por el usuario';
	$MULTILANG_FrmAccionExterna='En personalizadas.php o cualquier otro m&oacute;dulo instalado';
	$MULTILANG_FrmAccionJS='Comando en JavaScript';
	$MULTILANG_FrmDesAccion='Comando que deber&aacute; ejecutar el control al ser pulsado.  Para acciones definidas es personalizadas.php los datos del formulario ser&aacute;n enviados a esa rutina para ser procesados';
	$MULTILANG_FrmAccionCMD='Comando del usuario';
	$MULTILANG_FrmAccionDesCMD='Nombre de la acci&oacute;n definida en el archivo de personalizaci&oacute;n que procesar&aacute; la informaci&oacute;n o comando en JavaScript a ser ejecutado de manera inmediata en la p&aacute;gina (si requiere par&aacute;metros dentro de su comando utilice comillas sencillas para encerrarlos). Para cargar objetos de Pr&aacute;ctico como formularios o informes puede usar la misma notaci&oacute;n de menus: frm:XX:Par1:Par2:ParN o inf:XX...  El comando javascript ImprimirMarco(\'PCO_MarcoImpresionXX\') le permite imprimir el contenido del formulario.  Tambien puede usar comandos como PCO_VentanaPopup(\'http://www.google.com\',\'SuTitulo\',\'toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, width=640, height=480\'); .Revise siempre la documentacion para una lista completa y actualizada de comandos.';
	$MULTILANG_FrmDesPeso='Posici&oacute;n en la que aparece el campo dentro de la barra de estado del formulario cuando este se despliega en pantalla. Orden de izquierda a derecha';
	$MULTILANG_FrmBotDesVisible='Determina si el control es visible o no para el usuario';
	$MULTILANG_FrmRetorno='T&iacute;tulo de retorno';
	$MULTILANG_FrmDesRetorno='Texto que aparecer&aacute; como encabezado en el escritorio despu&eacute;s de realizar la acci&oacute;n indicada por el usuario';
	$MULTILANG_FrmTxtRetorno='Texto de retorno';
	$MULTILANG_FrmTxtDesRetorno='Texto completo con la descripci&oacute;n de acci&oacute;n realizada o mensaje entregado al usuario despu&eacute;s de ejecutar el control';
	$MULTILANG_FrmTxtRetornoIcono='Icono de retorno';
	$MULTILANG_FrmTxtDesRetornoIcono='Indica la imagen o icono ubicado al lado izquierdo del mensaje.  Utilice notacion AwesomeFonts.  Ejemplo:  fa-info-circle  para presentar un icono de informacion.';
	$MULTILANG_FrmTxtRetornoEstilo='Estilo grafico del mensaje de retorno (si aplica)';
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
	$MULTILANG_FrmDesTxt='Texto completo con la descripci&oacute;n de funciones resumida para el formulario.  Puede ser cualquier texto introductorio para el usuario';
	$MULTILANG_FrmImagen='Color de fondo';
	$MULTILANG_FrmImagenDes='Si su navegador soporta HTML5 puede seleccionar el color, de lo contrario ingrese un c&oacute;digo en hexadecimal como por ejemplo #F2F2F2 o su nombre en HTML como por ejemplo LightGray';
	$MULTILANG_FrmNumeroCols='N&uacute;mero columnas';
	$MULTILANG_FrmDesNumeroCols='Indica en cuantas columnas deben desplegarse los campos cuando el formulario sea cargado';
	$MULTILANG_FrmCreaDisena='Crear y dise&ntilde;ar';
	$MULTILANG_FrmTitForms='Formularios ya definidos en el sistema';
	$MULTILANG_FrmCamposAcciones='Campos y acciones';
	$MULTILANG_FrmAdvDelForm='IMPORTANTE:  Al eliminar el formulario los usuarios no podr&aacute;n accesarlo nuevamente para operaciones de consulta o ingreso de datos definidas en &eacute;l y no podr&aacute; deshacer esta operaci&oacute;n. Esto tambien elimina cualquier dise&ntilde;o interno del formulario.\n'.$MULTILANG_Confirma;
	$MULTILANG_FrmAdvScriptForm='Editar scripts (avanzado)';
	$MULTILANG_FrmHlpFunciones='Todas las funciones JavaScript definidas en este espacio ser&aacute;n inclu&iacute;das al formulario cada vez que sea cargado.<br>La funci&oacute;n FrmAutoRun siempre debe existir (aunque sea vac&iacute;a) pues ser&aacute; ejecutada autom&aacute;ticamente en cada carga del Formulario.';
	$MULTILANG_FrmCopiar='Crear copia';
	$MULTILANG_FrmAdvCopiar='Se creara una copia nueva del objeto seleccionado.  Esta seguro?';
	$MULTILANG_FrmMsjCopia='Ahora puede ingresar a editar su nuevo objeto.  Se ha creado una copia como: ';
	$MULTILANG_FrmBordesVisibles='Bordes de tabla visibles?';
	$MULTILANG_FrmFormatoSalida='Formato de salida';
	$MULTILANG_FrmFormatoEntrada='Formato de entrada';
	$MULTILANG_FrmPlantillaArchivo='Plantilla para el nombre del archivo';
	$MULTILANG_FrmDesPlantillaArchivo='La plantilla es la forma o patron en que sera renombrado el archivo una vez subido por el usuario al servidor.  Esto puede incluir diferentes variables para alterar el nombre y la extension del mismo como los ejemplos. Tambien puede dejarla en blanco para que los archivos sean cargados con el nombre original sobre la carpeta de cargas del sistema (No recomendado por seguridad).';
	$MULTILANG_FrmErrorCargaGeneral='Ha ocurrido un error durante la carga del archivo';
	$MULTILANG_FrmErrorCargaTamano='El archivo excede el tamano permitido';
	$MULTILANG_FrmPlantillaEjemplos='<i><b>Algunas variables de formato:</b><li>_ORIGINAL_ : Nombre original del archivo</li><li>_CAMPOTABLA_ : Nombre del campo de tabla vinculado</li><li>_FECHA_ : Fecha actual en formato AAAAMMDD</li><li>_HORA_ : Hora del servidor en formato HHMMSS</li><li>_MICRO_ : Microsegundos de la hora del sistema</li><li>_HORAINTERNET_ : Valor hora de internet de 000 a 999</li><li>_USUARIO_ : Login del usuario que hace el cargue</li><li>_EXTENSION_ : Extension del archivo cargado</li><b>Ejemplos:</b><li>_USUARIO__ORIGINAL_: Renombra el archivo original anteponiendo el login del usuario que lo carga</li><li>formatos/_ORIGINAL_: Carga el archivo con su nombre original dentro de la carpeta formatos.  La carpeta debe haber sido creada previamente por el usuario admin mediante el administrador de archivos dentro de la carpeta de cargas.</li><li>_FECHA__HORA__USUARIO_.pdf: Ademas de renombrar el archivo original por una cadena con la fecha, hora y usuario que hace el cargue, hace el forzado de la extension de archivo, renombrandolo como PDF.</li><li>reportes/_FECHA_.xls: Ademas de cargar el archivo en la carpeta reportes, lo renombra a la fecha actual y hace el forzado para que su extension sea XLS.</li><li>foto__USUARIO_.jpg: El archivo tendra fijas las cadenas iniciales y finales de foto_ y .jpg pero en el medio se reemplazara el valor del usuario que hace el cargue.  Observe el doble underline, uno para separar el archivo y otro para la variable de formato como tal.  Tendra un resultado final como foto_avelez.jpg</li>En general cualquier cadena dentro del formato que no coincida con las variables de formato quedara intacta en el nombre del archivo.</i>';
	$MULTILANG_FrmArchivoLink='[Abrir archivo ya cargado]';
	$MULTILANG_FrmCanvasLink='[Ver grafico ya cargado]';
	$MULTILANG_FrmErrorCam='Error en el dispositivo de video.  Verifique que cuenta con una camara instalada y que ha hecho clic en Permitir o aceptar para permitir a Practico utilizarla.';
    $MULTILANG_FrmPestana='T&iacute;tulo de la Pesta&ntilde;a a que pertenece en el formulario';
    $MULTILANG_FrmDesPestana='Indica la pesta&ntilde;a a la que pertenece el elemento dentro del formulario.  Practico genera automaticamente las pesta&ntilde;as de acuerdo a los valores ingresados en cada objeto.  Si especifica una pestana <b>PCO_NoVisible</b> la pestana no aparecera a los usuarios estandar (quedara oculta) pero sus elementos seran agregados normalmente al form para poder procesarlos.';
    $MULTILANG_FrmTagPersonalizado='Personalizaci&oacute;n del Tag HTML';
    $MULTILANG_FrmDesTagPersonalizado='Permite agregar par&aacute;metros y otras configuraciones HTML a la etiqueta generada por Pr&aacute;ctico as&iacute;:
            <br><b>Listas de selecci&oacute;n (combo-box):</b>
                <li><u>data-live-search=true</u> Busqueda dinamica sobre la lista.</li>
                <li><u>multiple</u> Selecciones multiples sobre la lista. Guarda las selecciones separadas por coma.  Por defecto las listas multiples son tratadas posteriormente como PCO_Delayed.</li>
                <li>Beta <u>data-selected-text-format=count</u> Combinado con multiple, cuenta las opciones seleccionadas en lugar de sus valores. Cuidado: Solamente cuenta, pero almacena el primer valor seleccionado.</li>
                <li><u>data-max-options=#</u> Combinado con multiple, determina el maximo de elementos a ser seleccionados.
                <li><u>data-size=auto|#</u> Determina cuantas opciones presentar en la lista. Por defecto es auto.</li>
                <li><u>data-style=btn-primary|btn-info|btn-success|btn-warning|btn-danger|btn-inverse</u> Cambia el estilo grafico del control
                <li><u>disabled</u> Deshabilita el control.</li>
                <li><u>PCO_Delayed</u> Si se encuentra hara una carga/actualizacion posterior (en el onready) del valor del control mediante javascript. Util en listas con opciones cargadas manualmente que requieren recuperar su valor desde BD posteriormente.</li>
                <BR>
                <b>Botones (command button):</b>
                <li><u>btn-group btn-group-justified</u> Expande control al ancho del contenedor.</li>
                <BR>
                <b>Casillas de verificacion (checkbox):</b>
                <li><u>data-toggle=toggle</u> Convierte control a tipo boton deslizador</li>
                <li><u>data-on=SuTexto</u> Define el texto a presentar cuando esta encendido. Puede contener HTML e incluso declaraciones de iconos.</li>
                <li><u>data-off=SuTexto</u> Igual que propiedad anterior para control apagado</li>
                <li><u>data-onstyle=Estilo</u> Define estilo del boton: primary|info|warning|danger|success|default</li>
                <li><u>data-offstyle=Estilo</u> Igual que propiedad anterior para control apagado</li>
                <li><u>data-style=TipoControl</u> Define apariencia grafica:  ninguno|ios|android</li>
                <li><u>data-size=Tamano</u> Tamano del control: large|normal|small|mini</li>
                <li><u>data-width=Ancho</u> Ancho del control en pixeles</li>
                <li><u>data-height=Alto</u> Alto del control en pixeles</li><br><i>Parametros que requieran cadenas con espacios pueden ser encerrados en comilla doble.</i>';
    $MULTILANG_FrmBtnFull='Cargar en pantalla completa';
    $MULTILANG_FrmBtnObjetivo='Objetivo HTML';
    $MULTILANG_FrmActualizaAjax='Actualizar din&aacute;micamente';
    $MULTILANG_FrmActivarInline='Modo de vista <i>Inline</i> (Conjunto con el elemento anterior y siguiente)';
    $MULTILANG_FrmActivarInlineDes='Permite que el control sea diagramado con estilo inline, lo que impide el salto de linea previo a ser ubicado en el formulario.  Dependiendo del efecto deseado, el control anterior o siguiente tambien debera contar con esta propiedad activada.';
    $MULTILANG_FrmTipoCopia='Indique el tipo de copia que desea realizar';
    $MULTILANG_FrmTipoCopia1='En linea';
    $MULTILANG_FrmTipoCopia2='XML con ID Actual';
    $MULTILANG_FrmTipoCopia3='XML con ID Din&aacute;mico';
    $MULTILANG_FrmTipoCopiaDes1='En linea: Crea un nuevo objeto con ID independiente identico al actual pero con todos sus elementos internos vinculados de manera que se pueda manipular para generar nuevas pantallas, formularios o informes derivados.  Esto opera inmediatamente sobre el sistema en ejecuci&oacute;n, clonando el objeto seleccionado.';
    $MULTILANG_FrmTipoCopiaDes2='XML con ID Actual: Exporta/Importa el objeto actual en formato XML para que pueda ser importado sobre otro sistema conservando su mismo ID de objeto.  Util si desea sobreescribir formularios o informes previos con mejoras desde otros sistemas.';
    $MULTILANG_FrmTipoCopiaDes3='XML con ID Din&aacute;mico: Exporta/Importa el objeto en formato XML pero generando este de manera dinamica para que cuando sea importado se genere un nuevo objeto cada vez, con ID diferente por cada vez que importe el archivo.  Util para replicar el comportamiento de la opci&oacute;n "En Linea" pero sobre diferentes sistemas.';
	$MULTILANG_FrmTipoCopiaExporta='Copiando / Exportando';
	$MULTILANG_FrmCopiaFinalizada='Se ha finalizado la copia del objeto.  Puede hacer clic en el boton de descargar para obtener su archivo XML equivalente.';
	$MULTILANG_FrmImportar='Importar dise&ntilde;o desde archivo';
	$MULTILANG_FrmImportarConflicto='Existen conflictos que deben ser resueltos antes de continuar con la importacion.';
	$MULTILANG_FrmImportarGenerado='Se ha generado el nuevo objeto';
	$MULTILANG_FrmImportarAlerta='Se ha encontrado otro elemento con el mismo ID interno y tipo que el que usted desea importar.  El elemento que desea importar eliminara el existente y reemplazara el mismo con las definiciones desde el archivo XML.  Se recomienda que verifique previamente si desea sobreescribir el elemento en cuesti&oacute;n antes de continuar.';
	$MULTILANG_FrmValOnCheck= 'Valor cuando esta activado';
	$MULTILANG_FrmValOffCheck='Valor cuando esta sin activar';
	$MULTILANG_FrmValCheckDes='Establece el valor que debe ser asignado internamente al campo que sera almacenado en base de datos dependiendo del estado del control';
	$MULTILANG_FrmEstiloPestanas='Estilo de pesta&ntilde;as (si aplica)';
	$MULTILANG_FrmEstiloTabs='Pesta&ntilde;as (nav-tab)';
	$MULTILANG_FrmEstiloPills='Botones (nav-pills)';
	$MULTILANG_FrmEstiloOculto='Ocultas';
	$MULTILANG_FrmTextoPlaceHolder='Texto para el placeholder';
	$MULTILANG_FrmDesPlaceHolder='Un texto que aparecer&aacute; en el campo cuando se encuentre vac&iacute;o para que el usuario tenga una gu&iacute;a de lo que debe diligenciar all&iacute;';
	$MULTILANG_FrmOcultarEtiqueta='Ocultar la etiqueta del campo en el formulario';
	$MULTILANG_FrmIdHTML='Identificador único del objeto en HTML.  Requerido si desea realizar programacion por eventos para este control, usar sentencias JQuery, y JS en general sobre el en tiempo de ejecuci&oacute;n.';
	$MULTILANG_FrmValidaExtra='Caracteres extra permitidos';
	$MULTILANG_FrmValidaAyuda='Cualquier caracter ingresado en el campo ser&aacute; permitido por el validador.  No se permiten las comillas dobles o simples.';
	$MULTILANG_FrmValida9='S&oacute;lo n&uacute;meros 0-9 (enteros)';
	$MULTILANG_FrmValida10='S&oacute;lo los indicados en el campo de validaci&oacute;n extra';
	$MULTILANG_FrmNombreHTML='Advertencia: Este valor es utilizado para generar el identificador &uacute;nico del elemento en HTML y a partir de &eacute;l generar autom&aacute;ticamente todos los eventos de los controles y herramientas vinculados a su formulario.  Si usted cambia este valor podr&iacute;a perder aquella programaci&oacute;n espec&iacute;fica de eventos y JavaScript en general que haya realizado con anterioridad a su cambio.';
    $MULTILANG_FrmClaseContenedor='Clase CSS del Contenedor';
    $MULTILANG_FrmClaseContenedorDes='Permite indicar si el contenedor del objeto cuenta con alguna clase CSS nativa o de bootstrap especifica para ser aplicada al momento de diagramar el control en pantalla.';
    $MULTILANG_FrmHuerfanos='Se han encontrado campos hu&eacute;rfanos (por fuera del dise&ntilde;o visible del formulario).';
    $MULTILANG_FrmIDHTMDuplicado='Se han encontrado campos con ID HTML o nombre de campo en base de datos duplicado.';
    $MULTILANG_FrmCamposAProposito='Esos campos se encuentran all&iacute; y pueden afectar la funcionalidad del formulario en giones JS o al procesar sus datos. Si usted ha generado campos de este tipo a prop&oacute;sito entonces ignore este mensaje.  Los campos encontrados son:';
    $MULTILANG_FrmTipoMaquetacion='Tipo de maquetaci&oacute;n';
    $MULTILANG_FrmTipoMaquetacionDes='Determina la forma en que Practico maquetara formularios de multiples columnas.  Tradicional: utiliza tablas y columnas estandar en HTML.  Responsive: utiliza columnas basadas en clases col de bootstrap, para las cuales debera especificar la clase de cada una en los campos correspondientes.';
    $MULTILANG_FrmTradicional='Tradicional';
    $MULTILANG_FrmCampoHuerfano='Los siguientes campos existen en la tabla principal asociada al formulario y aun no han sido vinculados a ningun control del formulario o alguno de sus formularios embebidos';
    $MULTILANG_FrmDesplazarObjetos='Desplazar hacia abajo una posici&oacute;n todos los objetos de esta columna a partir de este elemento';
    $MULTILANG_FrmEstaSeguro='Esta seguro?';

	//Informes
	$MULTILANG_InfErr1='Se debe indicar los valores para los campos correspondientes al menos a una serie de datos.<br>Si no desea generar un gr&aacute;fico entonces debe cambiar el tipo de informe a tabla de datos';
	$MULTILANG_InfErr2='Debe indicar un t&iacute;tulo v&aacute;lido para el informe.';
	$MULTILANG_InfErr3='Debe indicar un nombre v&aacute;lido para la categor&iacute;a asociada al informe.';
	$MULTILANG_InfErrCondicion='La condici&oacute;n especificada no es v&aacute;lida o carece de al menos uno de sus lados de comparaci&oacute;n.';
	$MULTILANG_InfErrCampo='Debe indicar un nombre de campo v&aacute;lida para el origen de datos del informe.';
	$MULTILANG_InfErrTabla='Debe indicar un nombre de tabla v&aacute;lida para el origen de datos del informe.';
	$MULTILANG_InfErr4='Debe indicar un t&iacute;tulo, etiqueta v&aacute;lida o imagen para el bot&oacute;n.';
	$MULTILANG_InfErr5='Debe indicar una acci&oacute;n v&aacute;lido para ser ejecutada cuando se active el control.';
	$MULTILANG_InfAgregaTabla='Agregar una nueva tabla al informe';
	$MULTILANG_InfTablaManual='Especificar tabla manualmente';
	$MULTILANG_InfDesTablaManual='En caso de no seleccionar una tabla en la parte superior puede indicar aqu&iacute; el nombre de una tabla.  Esta opci&oacuten es &uacute;til cuando requiere acceder a informaci&oacute;n contenida en tablas internas de Pr&aacute;ctico o tablas creadas mediante otras aplicaciones';
	$MULTILANG_InfAliasManual='Especificar un alias manualmente';
	$MULTILANG_InfDesAliasManual='&Uacute;til para definir el nombre de una tabla generada a partir de una subconsulta o indicada manualmente';
	$MULTILANG_InfBtnAgregaTabla='Agregar tabla';
	$MULTILANG_InfTablasDef='Tablas definidas en este informe';
	$MULTILANG_InfAlias='Alias';
	$MULTILANG_InfAdvBorrado='IMPORTANTE:  Al eliminar el objeto seleccionado la consulta o informe puede ser inconsistente.\n'.$MULTILANG_Confirma;
	$MULTILANG_InfAgregaCampo='Agregar un nuevo campo al informe';
	$MULTILANG_InfCampoDatos='Campo de datos';
	$MULTILANG_InfCampoManual='Especificar campo manualmente';
	$MULTILANG_InfDesCampoManual='En caso de no seleccionar un campo en la parte superior puede indicar aqu&iacute; el nombre de un campo.  Esta opci&oacuten es &uacute;til cuando requiere acceder a informaci&oacute;n contenida en campos internos de Pr&aacute;ctico o campos creadas mediante otras aplicaciones';
	$MULTILANG_InfDesAliasManual2='&Uacute;til para definir el nombre de un campo generado a partir de una subconsulta de agrupaci&oacute;n o indicado manualmente';
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
	$MULTILANG_InfDesManual='En cualquiera de los campos manuales puede encerrar expresiones o valores tipo cadena de caracteres utilizando comillas dobles.  Tambien puede comparar frente a las variables de sesi&oacute;n del usuario simplemente con poner alguna de ellas en notacion PHP, por ejemplo: $PCOSESS_LoginUsuario, $Nombre_usuario, $Descripcion_usuario, $Nivel_usuario, $Correo_usuario, $LlaveDePasoUsuario o cualquier otra del entorno global.  Para usar variables PHP en medio de una cadena puede encerrarlas entre llaves Ej:{$Variable} y estas seran reemplazadas por su valor global.';
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
	$MULTILANG_InfCampoEtiqSerie='Campo de etiqueta (Eje X)';
	$MULTILANG_InfCampoValor='Campo de valor (debe ser num&eacute;rico)';
	$MULTILANG_InfVistaGrafico1='APARIENCIA y DISTRIBUCION';
	$MULTILANG_InfVistaGrafico2='Seleccione de acuerdo al n&uacute;mero de series deseadas';
	$MULTILANG_InfTipoGrafico='Tipo de gr&aacute;fico';
	$MULTILANG_InfGrafico1='Areas';
	$MULTILANG_InfGrafico3='Barra';
	$MULTILANG_InfGrafico5='Linea';
	$MULTILANG_InfGrafico7='Dona (solo una serie)';
	$MULTILANG_InfActGraf='Actualizar formato del gr&aacute;fico';
	$MULTILANG_InfAgrupa='Agrupaci&oacute;n y ordenamiento';
	$MULTILANG_InfReco3='Utilice solamente campos definidos en su consulta.';
	$MULTILANG_InfCriterioAgrupa='Criterio de agrupamiento';
	$MULTILANG_InfCriterioOrdena='Criterio de ordenamiento';
	$MULTILANG_InfTitAgrupa='Como se agrupan los resultados?';
	$MULTILANG_InfDesAgrupa='Utilice esta opcion solamente si su informe maneja operaciones como suma, promedio o conteo dentro de los campos desplegados.  Ej. SUM(campo), AVG(campo), COUNT(*).  En esos casos indique por cu&aacute;l o cuales campos separados por coma se debe agrupar los resultados';
	$MULTILANG_InfTitOrdena='Como se ordenan los resultados?';
	$MULTILANG_InfDesOrdena='Permite ordenar los resultados por alguno de los desplegados.  Indique por cu&aacute;l o cuales campos separados por coma se debe ordenar los resultados, si lo desea despu&eacute;s de cada campo puede utilizar el modificador ASC o DESC para indicar si es ascedente o descendente';
	$MULTILANG_InfActCriterios='Actualizar criterios de agrupaci&oacute;n y ordenamiento';
	$MULTILANG_InfTitBotones='Acciones por registro';
	$MULTILANG_InfDelReg='Eliminar registro';
	$MULTILANG_InfCargaForm='Cargar un formulario por ID';
	$MULTILANG_InfHlpAccion='Si desea cargar un formulario simple utilice la notaci&oacute;n  <b>IDFormulario:1</b><br>Si desea cargar un formulario con busqueda de registro, utilice la notaci&oacute;n  <b>IDFormulario:1:CampoBusqueda</b><br>Si desea cargar un formulario transportando el valor de la primera columna sobre la variable $PCO_ValorBusquedaBD utilice la notaci&oacute;n  <b>IDFormulario:1:</b><br>Si desea cargar un informe utilice la notaci&oacute;n  <b>IDInforme:1:CampoBusqueda</b> (tomado como la primer columna del informe)<br>Si desea eliminar el registro asociado indique la <b>tabla.campo</b> usada para comparar con el valor de la primera columna';
	$MULTILANG_InfVinculo='Campo de v&iacute;nculo';
	$MULTILANG_InfDesVinculo='IMPORTANTE: Se asumir&aacute; el primer campo o columna como de valor &uacute;nico<br>
				para realizar las operaciones de eliminaci&oacute;n o apertura de<br>
				nuevos formularios.  Se recomienda utilizar campos que realmente sean de<br>
				valor &uacute;nico a menos que se deseen operaciones grupales.';
	$MULTILANG_InfDesPeso='Posici&oacute;n en la que aparece el boton dentro de los creados al lado derecho de cada registro. Orden de izquierda a derecha.';
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
	$MULTILANG_InfHlpCarga='Esta opci&oacute;n cerrar&aacute; el modo de dise&ntilde;o y cargar&aacute; el informe tal y como ser&aacute; visualizado por un usuario de la aplicaci&oacute;n';
	$MULTILANG_InfErrInforme1='Debe indicar un t&iacute;tulo v&aacute;lido para el informe.';
	$MULTILANG_InfErrInforme2='Debe indicar un nombre v&aacute;lido para la categor&iacute;a asociada al informe.';
	$MULTILANG_InfTituloAgr='Agregar nuevo informe o gr&aacute;fico';
	$MULTILANG_InfDetalles='Defina los detalles del informe/gr&aacute;fico';
	$MULTILANG_InfDefinidos='Informes/Gr&aacute;ficos ya definidos en el sistema';
	$MULTILANG_InfcamTabCond='Campos, Tablas y Condiciones';
	$MULTILANG_InfAdvEliminar='IMPORTANTE:  Al eliminar el informe los usuarios no podr&aacute;n accesarlo nuevamente para operaciones de consulta definidas en &eacute;l y no podr&aacute; deshacer esta operaci&oacute;n. Esto tambien elimina cualquier dise&ntilde;o interno del informe.\n'.$MULTILANG_Confirma;
	$MULTILANG_InfErrTamano='El informe que intenta generar es de tipo gr&aacute;fico pero el dise&ntilde;ador no ha indicado el alto y ancho del gr&aacute;fico resultante.<br>Debe indicarse un tama&ntilde;o v&aacute;lido de gr&aacute;fico para poder generarse una im&aacute;gen.';
	$MULTILANG_InfGeneraPDF='Permitir exportaci&oacute;n nativa de este reporte?';
	$MULTILANG_InfGeneraPDFInfoTit='Aplica s&oacute;lo para informes tabulares';
	$MULTILANG_InfGeneraPDFInfoDesc='El uso de esta opci&oacute;n con archivos LibreOffice, OpenOffice u Office 2007 o superiores requiere que su instalacion de PHP cuente con las extensiones php_zip, php_xml, php_gd2.  Activar esta opci&oacute;n puede representar tiempos adicionales en la generaci&oacute;n de su informe cuando el vol&uacute;men de resultados es alto ya que el usuario podria lanzar dos veces la consulta, una para visualizar el resultado en pantalla y otra para descargarlo.  OTRAS FORMAS DE EXPORTACION ESTAN DISPONIBLES MEDIANTE DATATABLES.';
    $MULTILANG_InfVblesFiltro='Variables globales requeridas para filtro';
    $MULTILANG_InfVblesDesFiltro='Variables PHP (Sin el signo pesos $ y separadas unicamente por una coma) que deberan ser tomadas del ambito global para estar disponibles en la opcion de Condiciones durante la construcci&oacute;n de querys';
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
    $MULTILANG_InfFormFiltrado='Fomulario con variables de filtrado';
    $MULTILANG_InfFormFiltradoDes='Seleccione un formulario disenado para capturar variables de filtro que seran pasadas a las condiciones del informe.  Esto le permite vincular un formulario que solicite siempre datos de filtrado al usuario antes de cargar los resultados.';
    $MULTILANG_InfRetornoFormFiltrado='Ver informe filtrado';
    $MULTILANG_InfAutoajusteAncho='Autoajustar ancho de celdas';
    $MULTILANG_InfBordesCelda='Dibujar bordes a las celdas';
    $MULTILANG_InfBordesTodos='Todos los lados';
    $MULTILANG_InfBordesArriba='Solo arriba';
    $MULTILANG_InfBordesAbajo='Solo abajo';
    $MULTILANG_InfBordesArrAba='Arriba y abajo';
    $MULTILANG_InfBordesIzq='Solo al lado izquierdo';
    $MULTILANG_InfBordesDer='Solo al lado derecho';
    $MULTILANG_InfBordesIzqDer='Al lado izquierdo y derecho';
	$MULTILANG_OrientacionPagina='Orientaci&oacute;n de p&aacute;gina';
	$MULTILANG_InfTamanoPapel='Tama&ntilde;o de papel';
	$MULTILANG_InfReducir='Auto-ajustar contenidos';
	$MULTILANG_InfTitPersonalizar='Personalizar presentaci&oacute;n y distribuci&oacute;n (opcional)';
	$MULTILANG_InfEjecutarAccionEn='Ejecutar esta accion en';
	$MULTILANG_InfPrecargarEstilos='Precargar hojas de estilo CSS Bootstrap';
	$MULTILANG_BtnEstiloSimple='Boton simple, Estilo plano';
	$MULTILANG_BtnEstiloPredeterminado='Estilo predeterminado';
	$MULTILANG_BtnEstiloPrimario='Estilo primario';
	$MULTILANG_BtnEstiloFinalizado='Estilo finalizado';
	$MULTILANG_BtnEstiloInformacion='Estilo informacion';
	$MULTILANG_BtnEstiloAdvertencia='Estilo advertencia';
	$MULTILANG_BtnEstiloPeligro='Estilo peligro';
	$MULTILANG_InfEditableLinea='Editable en l&iacute;nea';
	$MULTILANG_InfPaginacionDatatable='Tama&ntilde;o de p&aacute;gina';
	$MULTILANG_InfPaginacionDatatableDes='Indica el n&uacute;mero de registros que son presentados en los resultados de manera predeterminada';
	$MULTILANG_InfCargaInforme='Cargar un informe por ID';
	$MULTILANG_InfSubtotalesColumna='Columna de AutoSuma';
	$MULTILANG_InfSubtotalesColumnaDes='Indica el numero de la columna del informe que sera utilizada para calcular la funcion de autosuma automatica por pagina e informe.  DEJAR EN BLANCO PARA NO CALCULAR.';
	$MULTILANG_InfSubtotalesFormato='Formato de AutoSuma';
	$MULTILANG_InfSubtotalesFormatoDes='Indica el formato que sera utilizado para imprimir los resultados de la funcion autosuma al final del informe.  <b>Permite HTML basico y plantillas</b> asi: _TOTAL_PAGINA_ Presentara el total de la columna para la pagina actual, _TOTAL_INFORME_ presentara el total de registros de todos el informe, _COLUMNA_ presenta el numero de la columna del informe utilizada para la operacion de autosuma.  Por ejemplo el siguiente codigo HTML presentara el estado de la AutoSumna centrado y en negrita: < div align=center>< b>Total de pagina < i>(columna: _COLUMNA_)< /i> _TOTAL_PAGINA_ Total reporte: _TOTAL_INFORME_< /b>< /div>';
	$MULTILANG_InfTituloArbitrario='Titulo arbitrario';
	$MULTILANG_InfTituloArbitrarioDes='Permite ignorar el titulo de columna entregado por el motor de base de datos y en su lugar utilizar este valor como titulo en el informe presentado.  <b>Permite HTML basico y variables PHP</b>';
	$MULTILANG_InfSQL='Si usted agrega cualquier contenido mayor a 5 caracteres a este campo de script SQL el generador de informes omitir&aacute; cualquier configuraci&oacute;n de tablas, campos, condiciones o cualquier otra definici&oacute;n de consulta que usted tenga definida e intentar&aacute; ejecutar directamente este Script y a partir de &eacute;l generar la tabla de resultados.  Puede utilizar variables PHP en notaci&oacute;n {$ Variable} para incluir variables de entorno.';
	$MULTILANG_InfFormsUsan='Formularios detectados que utilizan este informe de manera embebida';
	$MULTILANG_InfTootipTitulo='Generar tooltip para informes gr&aacute;ficos con el t&iacute;tulo del informe';
    $MULTILANG_InfBotonPpio='Ubicar en la primera columna';
    $MULTILANG_ExportaDT=' Exportaci&oacute;n del lado del cliente?';
    $MULTILANG_ExportaDTDes='Permite habilitar opciones adicionales en la parte superior derecha del informe para que el usuario pueda exportar sus datos en diferentes formatos.  La exportaci&oacute;n se hace solamente sobre los datos contenidos por la tabla.  Si el usuario realiza alg&uacute;n filtro o b&uacute;squeda din&aacute;mica sobre &eacute;sta los datos a exportar ser&aacute;n los filtrados por el usuario solamente.';
    $MULTILANG_InfEncabezado='Texto enriquecido para el encabezado';
    $MULTILANG_InfEncabezadoDes='Aqui puede agregar cualquier texto enriquecido, imagen, enlaces y demás elementos que serán agregados como encabezado en la parte superior del informe tabular o de gráfico';
    $MULTILANG_InfSinDatos='No hay datos para el gr&aacute;fico';
    $MULTILANG_InfTablaResponsive='Usar distribucion responsive';
    $MULTILANG_InfTablaResponsiveDes='Permite diagramar la tabla en un formato 100% responsive ocultando automaticamente las columnas que no quepan en pantalla y convirtiendolas automaticamente en una fila hija debajo de la actual.  Importante: El uso de este formato anula la seccion de pie de pagina de la tabla.';
    $MULTILANG_InfEnHome='Publicaci&oacute;n directa para usuarios autorizados';
    $MULTILANG_InfBarraSuperior='En alertas de barra de navegacion superior';

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
    $MULTILANG_MnuIzquierda='Posible lateral?';
	$MULTILANG_MnuSeccion='Secci&oacute;n';
	$MULTILANG_MnuDesArriba='Se debe habilitar esta opci&oacute;n para ser desplegada en la barra de menu superior-horizontal?';
	$MULTILANG_MnuDesEscritorio='Se debe habilitar esta opci&oacute;n para ser desplegada como un icono en el escritorio del usuario?';
	$MULTILANG_MnuDesCentro='Se debe habilitar esta opci&oacute;n para ser desplegada en la parte central del aplicativo, dentro de ventanas clasificadas/agrupadas por el valor definido en el campo Seccion?';
    $MULTILANG_MnuDesIzquierdo='Se debe habilitar esta opci&oacute;n para ser desplegada en la barra lateral izquierda del aplicativo?';
	$MULTILANG_MnuDesImagen='Desplegar una lista de im&aacute;genes disponibles en el sistema.  En opciones de submenus desplegables utilice la palabra clave _SEPARADOR_ en lugar de una imagen para generar separadores de opciones dentro del submenu.';
	$MULTILANG_MnuComandos='CONFIGURACION DE COMANDOS Y ACCIONES';
	$MULTILANG_MnuClic='Posible hacer clic?';
	$MULTILANG_MnuURL='URL est&aacute;tica o comando en formato javascript:comando()';
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
    $MULTILANG_MnuTgt='Destino (S&oacute;lo opciones con URL o comandos Javascript:)';
    $MULTILANG_ImagenMenu='Imagen: Seleccione un icono o indique la ruta relativa';
    $MULTILANG_Agrupador='Agrupador de opciones';
    $MULTILANG_AgrupadorDes='Define si la opcion sera presentada directamente en la ubicacion indicada o si se desea generar un menu desplegable (dropdown) con mas opciones dentro.';

	//Objetos, seguridad y otros
	$MULTILANG_ObjError='El tipo de objeto recibido en este comando es desconocido';
	$MULTILANG_SecErrorTit='Control de seguridad por comandos e informes';
	$MULTILANG_SecErrorDes='Usted ha intentado ejecutar una funcion, comando o informe para el cual no se encuetra autorizado.<br>Ser&aacute; llevado un registro de auditor&iacute;a:';
	
	//Tablas
	$MULTILANG_TblError1='Problema de integridad en dise&ntilde;o';
	$MULTILANG_TblError2='ERROR DE BASE DE DATOS';
	$MULTILANG_TblError3='Durante la ejecuci&oacute;n el motor ha retornado el siguiente mensaje';
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
    $MULTILANG_TblTipoCopia1='Solo estructura (Sentencia CREATE)';
    $MULTILANG_TblTipoCopia2='Datos (Sentencias INSERT)';
    $MULTILANG_TblTipoCopia3='Estructura y datos (Sentencias CREATE e INSERT)';
    $MULTILANG_TblImportar='Importar desde archivo';
    $MULTILANG_TblImportarSQL='Cargar script SQL comprimido';
    $MULTILANG_TblSQLConsejo='Al ejecutar las sentencias SQL contenidas en el archivo usted podria estar eliminando, creando o sobreescribiendo tablas, registros y demas informacion asociada, asi como dise&ntilde;os y otros elementos contenidos en los registros asociados. <br><br><b>Se recomienda que haga una copia de seguridad previo a este proceso antes de continuar.</b>';
    $MULTILANG_TblEjecutarSQL='Ejecutar sentencias SQL del archivo (puede tardar)';
    $MULTILANG_TblDecodificarActual='Codificacion o set de caracteres actual de los registros o tabla de datos';
    $MULTILANG_TblCodificar='CODIFICAR los registros antes de ser llevados al backup usando';
    $MULTILANG_TblCodificacionNINGUNO='NINGUNO, Use la codificaci&oacute;n o set de caracteres original de la tabla';
    $MULTILANG_TblTransliteracion='Usar transliteracion o ignorado de caracteres';
    $MULTILANG_TblTransliteracionHlp='La transliteraci&oacute;n significa que cuando un caracter no puede ser representado en el set de caracteres final, se puede aproximar a uno o varios caracteres parecidos. Si decide ignorarlos entonces cuando el caracter no pueda ser traducido sera descartado sin generar error. De otro modo, se corta desde el primer caracter ilegal y se genera un E_NOTICE.';
    $MULTILANG_TblTranslit='Transliterando';
    $MULTILANG_TblIgnora='Ignorando';
    $MULTILANG_TblAnaliza='Analizar tablas';
    $MULTILANG_TblReparar='Reparar tablas';
    $MULTILANG_TblOptimizar='Optimizar tablas';
    $MULTILANG_TblVaciar='Vaciar';
    $MULTILANG_TblVaciarAdv='Esta operacion eliminara todos los registros de la tabla, esta seguro?';
    $MULTILANG_TblImportarXLS='Desde hojas de c&aacute;lculo';
    $MULTILANG_TblXLSConsejo='Al cargar y aparear campos de un archivo de hoja de calculo con su base de datos actual usted podria estar eliminando, creando o sobreescribiendo tablas, registros y demas informacion asociada, asi como dise&ntilde;os y otros elementos contenidos en los registros asociados. <br><br><b>Se recomienda que haga una copia de seguridad previo a este proceso antes de continuar.</b><br><br><font color=red><b>Importante:</b> </font>La primera fila de la hoja de calculo debera contener como encabezados el nombre exacto del campo en la tabla sobre la cual se desea importar los valores.';
    $MULTILANG_TblTablaImportacion='Por favor seleccione la tabla sobre la cual desea importar los datos';
    $MULTILANG_TblCorrespondencia='Correspondencia entre campos de tabla y columnas de archivo';
    $MULTILANG_TblApareaMsg='Revise al lado izquierdo los campos de la tabla y la columna apareada por su nombre desde la lista de seleccion.  Si es necesario haga los apareamientos manuales segun la vista previa de las columnas existentes en el archivo en la parte superior. <br><br>Los campos sin aparear seran ignorados y llenados con el valor predeterminado que se tenga en el motor.';
    $MULTILANG_TblPoliticaImportacion='<b>Qu&eacute; hacer si un registro que se est&aacute; importando ya existe?:</b><br>Especifique c&oacute;mo quiere que sea procesado cada registro duplicado o ya existente en el sistema en caso que al tratar de importarlo ya se encuentre en la base de datos.';
    $MULTILANG_TblIgnorarRegistro='Ignorar el registro';
    
	//Usuarios
	$MULTILANG_UsrCopia='Copia de permisos finalizada.  Por favor verifique a continuacion.';
	$MULTILANG_UsrDesPW='Las contrase&ntilde;as con condiciones m&iacute;nimas de seguridad deben tener una longitud de <b>al menos 8 caracteres</b>, n&uacute;meros, letras en may&uacute;scula y en min&uacute;scula o s&iacute;mbolos permitidos como <font color=blue>$ *</font>.  Para que su contrase&ntilde;a sea considerada segura por este sistema <b>debe cumplir al menos con un nivel de seguridad del 81%</b>';
	$MULTILANG_UsrCambioPW='Cambio de contrase&ntilde;a';
	$MULTILANG_UsrAnteriorPW='Contrase&ntilde;a anterior';
	$MULTILANG_UsrNuevoPW='Nueva contrase&ntilde;a';
	$MULTILANG_UsrNivelPW='Nivel de seguridad';
	$MULTILANG_UsrVerificaPW='Verificar contrase&ntilde;a';
	$MULTILANG_UsrHlpNoPW='El motor de autenticaci&oacute;n definido para la herramienta es de tipo externo.<br>
				Los cambios de clave o actualizacion de perfil de usuarios se encuentran deshabilitados pues deben ser gestionados de manera centralizada por usted en la herramienta definida por el administrador del sistema.';
	$MULTILANG_UsrErrPW1='Usted ha olvidado ingresar alguno de los datos solicitados';
	$MULTILANG_UsrErrPW2='Usted ha ingresado dos contrase&ntilde;as diferentes';
	$MULTILANG_UsrErrPW3='La clave por usted ingresada no cumple con las recomendaciones minimas de seguridad';
	$MULTILANG_UsrErrPW4='La clave actual ingresada no coincide con la registrada en el sistema.  Por razones de seguridad no se actualiza su clave por una nueva si no ingresa su clave actual como verificacion.';
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
	$MULTILANG_UsrAudit1='Seguimiento de operaciones';
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
    $MULTILANG_UsrEsPlantilla='Utilizar este usuario como plantilla de permisos para otros?. ';
    $MULTILANG_UsrEsPlantillaDes='Los permisos de menu e informes asignados a este usuario seran copiados automaticamente durante cada ingreso a los usuarios que lo utilicen como plantilla. Esto le permite mantener perfiles de usuario actualizados de acuerdo a plantillas generales.   Tenga en cuenta que los usuarios plantilla son desactivados para su login puesto que son utilizados unicamente para establecer roles y perfiles de permisos.';
    $MULTILANG_UsrPlantillaAplicar='Plantilla de permisos para aplicar en cada ingreso';
    $MULTILANG_UsrPlantillaAplicarDes='Los permisos asignados al usuario seleccionado en la lista seran tranferidos a este nuevo usuario cada que haga un ingreso';
    $MULTILANG_UsrPermisoManual='Permisos manuales';
    $MULTILANG_UsrDesClaveACorreo='Verifique que la cuenta de correo es correcta.  Sera verificada posteriormente ya que a esta cuenta sera enviada una clave aleatoria inicial para su ingreso al sistema.';
    $MULTILANG_UsrFinRegistro='El registro de usuario ha sido realizado de manera satisfactoria.  Revise su buzon de correo donde encontrara la contrasena inicial para ingresar.<br><br>Nota: Recuerde revisar tambien su carpeta de elementos no deseados o SPAM en caso de no recibir su mensaje en su bandeja de entrada estandar.';

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
	$MULTILANG_CumplirGD='Extensi&oacute;n GD 2+ para manipulaci&oacute;n de gr&aacute;ficos y su soporte para FreeType 2+<li>Extension SimpleXML.<li>Extension cURL.<li>Extension POSIX';
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
	$MULTILANG_ParamNombreEmpresaLargo='Nombre largo de su Organizaci&oacute;n o empresa';
	$MULTILANG_ParamNombreEmpresa='Nombre corto de su Organizaci&oacute;n o empresa';
	$MULTILANG_ParamFechaLanzamiento='Fecha de lanzamiento';
	$MULTILANG_ParamNombreApp='Nombre de su aplicaci&oacute;n';
	$MULTILANG_ParamVersionApp='Versi&oacute;n inicial de su aplicaci&oacute;n';
	$MULTILANG_AyudaTitNomEmp='Nombre a desplegar en la parte superior';
	$MULTILANG_AyudaDesNomEmp='Este texto ser&aacute; utilizado en informes y espacios de la aplicaci&oacute;n que requieran un nombre para identificar su organizaci&oacute;n.';
	$MULTILANG_AyudaTitNomApp='Nombre descriptivo';
	$MULTILANG_AyudaDesNomApp='El nombre especificado aparecer&aacute; siempre en la parte superior de su aplicaci&oacute;n.';
	$MULTILANG_NotasImportantesInst2='<u>IMPORTANTE</u>: Otros parametros como nombre largo y corto de su empresa, fecha de lanzamiento, textos de licencia y creditos podran ser modificados posteriormente mediante las opciones disponibles para el usuario administrador.';
	$MULTILANG_AyudaTitCaptcha='Longitud de la palabra';
	$MULTILANG_AyudaDesCaptcha='Indica el n&uacute;mero de s&iacute;mbolos utilizados en la palabra de seguridad que deben ingresar los usuarios para cada acceso al sistema.';
	$MULTILANG_ModoDepuracion='Modo de depuraci&oacute;n';
	$MULTILANG_AyudaTitDebug='Presentar errores y advertencias';
	$MULTILANG_AyudaDesDebug='Para sitios en producci&oacute;n esta opci&oacute;n debe estar apagada.  Cuando se enciende ense&ntilde;a durante la ejecuci&oacute;n de la aplicaci&oacute;n todos los errores y mensajes que puedan ser generados por el preprocesador de hipertexto - PHP';
	$MULTILANG_AyudaTitDebugBD='Guardar log de consultas';
	$MULTILANG_AyudaDesDebugBD='Para sitios en producci&oacute;n esta opci&oacute;n debe estar apagada.  Cuando se enciende permite guardar una copia sobre el modulo de auditoria de todas las transacciones realizadas sobre el motor de base de datos';
	$MULTILANG_MotorAuth='Motor de autenticaci&oacute;n';
	$MULTILANG_AuthPractico='Interno (Tablas propias de Pr&aacute;ctico usando MD5)';
	$MULTILANG_AuthLDAP='LDAP (Servidor de directorio)';
	$MULTILANG_AuthFederado='Federado (Ver configuraci&oacute;n en parametros de aplicaci&oacute;n)';
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
	$MULTILANG_MsjFinal1='Si esta es una instalaci&oacute;n nueva puede ingresar al sistema mediante las credenciales<b> admin/admin</b> y cambiarlas luego por las que usted desee.<hr><b><font color=red>LA PRIMERA VEZ QUE INGRESE TARDARA MAS DE LO NORMAL MIENTRAS SE EJECUTAN LOS SCRIPTS DE POST-INSTALACION</font></b><hr>';
	$MULTILANG_MsjFinal2='Recuerde eliminar por completo el directorio de instalaci&oacute;n (carpeta /ins)</b></u> para evitar que otra persona ejecute nuevamente estos scripts sobre un sistema en producci&oacute;n pudiendo ocasionar alg&uacute;n tipo de da&ntilde;o.';
	$MULTILANG_MsjFinal2='Resumen de operaciones ejecutadas';
	$MULTILANG_AuthLDAPTitulo='Autenticacion basada en LDAP';
	$MULTILANG_AuthOauthPlantilla='Usuario plantilla';
	$MULTILANG_AuthOauthId='ID de cliente';
	$MULTILANG_AuthOauthSecret='Secreto de cliente';
	$MULTILANG_AuthOauthURI='URI redireccion';
	$MULTILANG_OauthTitURI='Antes de continuar, usted debe registrar una aplicaci&oacute;n con el proveedor correspondiente y obtener el ID, Secreto y URI para asociarla al servicio.  La URI a registrar con su proveedor es aquella calculada automaticamente por Practico en ese campo.';
	$MULTILANG_OauthDesURI='Tenga en cuenta que la URI de retorno debe estar asociada a un dominio o IP publica para poder ser resuelta por el proveedor. Esta URI se calcula automaticamente dependiendo del path al momento de instalacion.  Para ir a la URL donde se registran las aplicaciones haga clic sobre el logo correspondiente.';
	$MULTILANG_OauthPredeterminado='Una vez registrado algun proveedor de OAuth, usted puede configurar su sistema para que las opciones OAuth sean las presentadas de manera predeterminada al momento de login desde el panel de configuracion.';
	$MULTILANG_BuscarActual='Buscar actualizaciones automaticamente';
	$MULTILANG_DescActual='Se conecta de manera aleatoria durante algunos ingresos del admin para verificar si existen versiones nuevas de Practico.  Puede poner un poco lenta la carga del panel para el usuario admin mientras busca nuevas versiones.';
	$MULTILANG_ConfGraficas='Cambiar configuraciones graficas';
	$MULTILANG_UsuariosAdmin='Usuarios administradores';
	$MULTILANG_UsuariosAdminDes='Lista de usuarios separados unicamente por coma y que seran considerados como administradores de la plataforma y dise&ntilde;adores de aplicaci&oacute;n.  En caso de retirar al admin por defecto asegurese de contar con otro usuario administrador, de lo contrario tendra que editar manualmente su archivo de configuracion para restablecer los accesos administrativos.';
	$MULTILANG_PermitirReseteoClave='Permitir recuperaci&oacute;n de claves';
	$MULTILANG_DesPermitirReseteoClave='Presenta una opcion en la ventana de acceso al sistema que permite a los usuarios abrir el asistente de recuperacion de claves.  Unicamente cuando el motor de autenticacion utilizado es el interno de Practico.';
	$MULTILANG_PermitirAutoRegistro='Permitir auto-registro de usuarios al sistema';
	$MULTILANG_DesPermitirAutoRegistro='Presenta una opcion en la ventana de acceso al sistema que permite a los nuevos usuarios hacer su registro de manera autonoma.  Unicamente cuando el motor de autenticacion utilizado es el interno de Practico.';
	$MULTILANG_UsuarioAutoRegistro='Usuario plantilla auto-registros';
	$MULTILANG_DesUsuarioAutoRegistro='Determina el usuario plantilla utilizado para inicializar los permisos a los usuarios que hacen un auto-registro en el sistema';
	$MULTILANG_NoRecomendado='No recomendado por seguridad';
	$MULTILANG_UbicacionOauth='Ubicacion de las opciones de OAuth durante el Login';
	$MULTILANG_OauthOpcionBoton='Como boton separado que abre los proveedores disponibles';
	$MULTILANG_OauthOpcionDirecta='Como opciones extra sobre la ventana de login estandar';

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
	$MULTILANG_PreferirOauth='Presentar las opciones OAuth por defecto durante el login';
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
	$MULTILANG_MonAcerca='&copy; Sistema de monitoreo basado en <a target="_blank" href="http://www.practico.org" style="color:#FFFFFF"><font color=white><b>Practico.org</b></font></a>';
	$MULTILANG_AplicaPara='Esto aplica para: ';
	$MULTILANG_MonLinea='EN LINEA';
	$MULTILANG_MonCaido='CAIDO';
	$MULTILANG_MonAlertaVibrar='Vibrar en dispositivos moviles';
	$MULTILANG_MonSensorRango='Sensor en un rango';
	$MULTILANG_MonModoCompacto='Usar modo compacto';

    //Modulo de correos
    $MULTILANG_MailIntro1='Mensaje autom&aacute;tico de la plataforma';
    $MULTILANG_MailIntro2='Informaci&oacute;n detallada sobre este mensaje puede ser encontrada accesando a la herramienta <span style="font-weight: bold;">'.$NombreRAD.'</span> con su nombre de usuario y contrase&ntilde;a';
    $MULTILANG_MailIntro3='Este correo fue generado por un sistema autom&aacute;tico, por favor no responda a este mensaje.';
    $MULTILANG_MailIntro4='Recuerde que nunca le ser&aacute; solicitada informaci&oacute;n personal o contrase&ntilde;as v&iacute;a correo electr&oacute;nico</span>, por lo tanto no conteste o diligencie formularios donde se solicite este tipo de informaci&oacute;n y que se encuentren por fuera del sistema '.$NombreRAD.'.';
    $MULTILANG_MailIntro5='La informaci&oacute;n contenida en este correo electr&oacute;nico y en todos sus archivos anexos, es confidencial y/o exclusiva del negocio y puede ser utilizada &uacute;nicamente por la (s) persona (s) a la (s) cual (es) est&eacute; dirigida. Si usted no es el destinatario autorizado, cualquier modificaci&oacute;n, retenci&oacute;n, difusi&oacute;n, distribuci&oacute;n o copia total o parcial de este mensaje y/o de la informaci&oacute;n contenida en este y/o en sus archivos anexos esta prohibida y son sancionados por la ley. Si recibe este mensaje por error, s&iacute;rvase borrarlo de inmediato, notificarle de su error a la persona que lo envi&oacute; y abstenerse de divulgar su contenido e informaci&oacute;n anexa.';
    $MULTILANG_MailIntro6='<br><br>Sistema potenciado por <a href=http://www.practico.org>www.practico.org</a>';

	//Modulo de chat
	$MULTILANG_UsuariosChat='Aquellos usuarios desconectados en el momento recibiran los mensajes cuando ingresen nuevamente al sistema.';
	$MULTILANG_ChatActivar='Activar el modulo de chat?';
	$MULTILANG_ChatTipo1='Solo entre usuarios Internos';
	$MULTILANG_ChatTipo2='Solo entre usuarios Externos';
	$MULTILANG_ChatTipo3='Entre todos los usuarios';
	$MULTILANG_ChatTipo4='Exclusivo para admin';
	$MULTILANG_ChatDevel='Chat para desarrolladores';

	//Modulo de replicas
	$MULTILANG_ReplicaTitulo='Conexiones extra y Replicaci&oacute;n';
	$MULTILANG_ReplicaDefinidos='Servidores de replicaci&oacute;n autom&aacute;tica definidos';
	$MULTILANG_AgregarReplica='Agregar nueva conexion';
	$MULTILANG_ReplicaTodo='Usar como replica espejo';
	$MULTILANG_AyudaReplica='Determina si todas las operaciones realizadas sobre la base de datos del sistema deben ser replicadas sobre esta conexion.  Si asigna su valor en NO, Practico solamente creara la conexion y la dejara lista para ser usada por c&oacute;digo o por operaciones individuales cuando usted lo requiera.  Esto solo aplicara para operaciones de alteracion (Insertar,Actualizar,Eliminar) realizadas mediante la funcion PCO_EjecutarSQLUnaria()';
	$MULTILANG_ConnAdicionales='Conexiones a bases de datos adicionales';
	$MULTILANG_ConnPredeterminada='Predeterminado (Misma conexi&oacute;n usada por Practico)';
	$MULTILANG_ConnOrigenDatos='Origen de datos';
	$MULTILANG_ConnOrigenDatosDes='Determina desde d&oacute;nde ser&aacute;n tomados los datos para realizar el informe.  Por defecto utiliza la conexi&oacute;n y motor de base de datos configurado para trabajar con Pr&aacute;ctico; pero tambi&eacute;n puede seleccionar otros motores o conexiones externas y poder extraer desde all&iacute; datos.  Para agregar otros or&iacute;genes de datos utilice la opci&oacute;n de Conexiones extra y replicaci&oacute;n.';
    $MULTILANG_ConnAdvCambioOrigen='CUIDADO: Alterar la conexi&oacute;n u origen de datos utilizado para un informe despu&eacute;s de su dise&ntilde;o puede generar errores en tiempo de ejecuci&oacute;n debido a que las estructuras de datos, tablas y campos pueden no ser encontradas en la nueva conexi&oacute;n seleccionada.  Sea cuidadoso.';
	
	//Eventos javascript
    $MULTILANG_EventosTit='Eventos y disparadores del objeto';
    $MULTILANG_EventosPrevio='Antes de que usted pueda automatizar operaciones mediante eventos o disparadores con un objeto o control de formulario primero debe crear el control base y luego entrar a editarlo nuevamente para activar las opciones.';
    $MULTILANG_EventoClick='Click sobre un elemento';
    $MULTILANG_EventoDobleClick='Doble click sobre un elemento';
    $MULTILANG_EventoMouseDown='Se pulsa un botón del ratón sobre un elemento';
    $MULTILANG_EventoMouseEnter='El puntero del ratón entra en el área de un elemento';
    $MULTILANG_EventoMouseLeave='El puntero del ratón sale del área de un elemento';
    $MULTILANG_EventoMouseMove='El puntero del ratón se está moviendo sobre el área de un elemento';
    $MULTILANG_EventoMouseOver='El puntero del ratón se sitúa encima del área de un elemento';
    $MULTILANG_EventoMouseOut='El puntero del ratón sale fuera del área del elemento o fuera de uno de sus hijos';
    $MULTILANG_EventoMouseUp='Un botón del ratón se libera estando sobre un elemento';
    $MULTILANG_EventoContextMenu='Se pulsa el botón derecho del ratón (antes de que aparezca el menú contextual)';
    $MULTILANG_EventoKeyDown='El usuario tiene pulsada una tecla (para elementos de formulario y body)';
    $MULTILANG_EventoKeyPress='El usuario pulsa una tecla (momento justo en que la pulsa) (para elementos de formulario y body)';
    $MULTILANG_EventoKeyUp='El usuario libera una tecla que tenía pulsada (para elementos de formulario y body)';
    $MULTILANG_EventoFocus='Un elemento del formulario toma el foco';
    $MULTILANG_EventoBlur='Un elemento del formulario pierde el foco';
    $MULTILANG_EventoChange='Un elemento del formulario cambia';
    $MULTILANG_EventoSelect='El usuario selecciona el texto de un elemento input o textarea';
    $MULTILANG_EventoSubmit='Se pulsa el botón de envío del formulario (antes del envío)';
    $MULTILANG_EventoReset='Se pulsa el botón reset del formulario';
    $MULTILANG_EventoCut='Los datos seleccionados en un cuadro de texto son cortados';
    $MULTILANG_EventoCopy='Los datos seleccionados en un cuadro de texto son copiados';
    $MULTILANG_EventoPaste='Se ha pegado un contenido en un cuadro de texto';
    $MULTILANG_EventoLoad='Se ha completado la carga de la ventana o marco';
    $MULTILANG_EventoUnload='El usuario ha cerrado la ventana o marco';
    $MULTILANG_EventoResize='El usuario ha cambiado el tamaño de la ventana o marco';
    $MULTILANG_EventoClose='El usuario intenta cerrar la ventana o marco';
    $MULTILANG_EventoScroll='El usuario desplaza el contenido en una ventana o control que soporta scroll';
    $MULTILANG_EventoAnimFin='Una animacion CSS ha finalizado';
    $MULTILANG_EventoAnimInicio='Una animacion CSS ha iniciado';
    $MULTILANG_EventoAnimIteracion='Una animacion CSS ha reiniciado/repetido';
    $MULTILANG_EventoTipoRaton='Eventos de Raton o Dispositivo apuntador';
    $MULTILANG_EventoTipoTeclado='Eventos de Teclado';
    $MULTILANG_EventoTipoFormulario='Eventos sobre controles de formulario';
    $MULTILANG_EventoTipoVentana='Eventos para ventanas y marcos';
    $MULTILANG_EventoTipoAnima='Eventos para animaciones y transiciones';
    $MULTILANG_EventoTipoBateria='Eventos relacionados con la bateria y su carga';
    $MULTILANG_EventoTipoLlamadas='Eventos asociados a llamadas y telefonia';
    $MULTILANG_EventoTipoDOM='Eventos sobre el arbol DOM';
    $MULTILANG_EventoTipoArrastrar='Eventos asociados a arrastrar y soltar elementos';
    $MULTILANG_EventoTipoAudio='Eventos sobre audio y video';
    $MULTILANG_EventoTipoInternet='Eventos sobre la conexion a Internet';
    
    //ModuloKanban
    $MULTILANG_TablerosKanban='Tableros Kanban';
    $MULTILANG_AgregarNuevaTarea='Agregar nueva tarea';
    $MULTILANG_DesTarea='Descripci&oacute;n general de la tarea o actividad que ser&aacute; agregada al tablero Kanban.   Puede incluso utilizar otras t&eacute;cnicas de descripci&oacute;n como historias de usuario o cualquier otra metodolog&iacute;a que desee para documentar la actividad.';
    $MULTILANG_AsignadoA='Asignada a';
    $MULTILANG_AsignadoADes='Usuario registrado en el sistema que es responsable por la finalizaci&oacute;n de esta tarea o actividad (si aplica)';
    $MULTILANG_FechaLimite='Fecha de vencimiento';
    $MULTILANG_DelKanban='Usted va a eliminar una tarea del tablero y esta accion no se puede deshacer posteriormente.  Esta seguro que desea continuar?';
    $MULTILANG_Historia1='Historia de usuario minima: [Rol,Funcionalidad,Finalidad]';
    $MULTILANG_Historia1Des='Como ________ Se necesita ___________ con el fin de ________.';
    $MULTILANG_Historia2='Historia de usuario intermedia: [Rol,Funcionalidad,Finalidad]+[Contexto/Criterio aceptacion,Evento]';
    $MULTILANG_Historia2Des='Como ________ Se necesita ___________ con el fin de ________.BRBREn caso que _______ se debe _______';
    $MULTILANG_Historia3='Historia de usuario detallada: [ID,Rol,Funcionalidad,Finalidad]+[Escenario,Contexto/Criterio aceptacion,Evento]';
    $MULTILANG_Historia3Des='ID: ______BRComo ________ Se necesita ___________ con el fin de ________.BRBREscenario: ________. En caso que _______ se debe _______';
    $MULTILANG_ListaColumnas='Lista de columnas';
    $MULTILANG_ListaCategorias='Lista de categorias';
    $MULTILANG_ArchivarTarea='Archivar tarea';
    $MULTILANG_ArchivarTareaAdv='La tarea sera archivada, saldra del tablero y pasara al historico.  ¿Desea continuar?';
    $MULTILANG_TareasArchivadas='Tareas archivadas';
    $MULTILANG_CompartidosConmigo='Compartidos conmigo';
    $MULTILANG_CrearTablero='Crear tablero';
    $MULTILANG_CompartirCon='Compartir con';
    $MULTILANG_NoTablero='No hay un tablero kanban asociado a su usuario o compartido por otro usuario con usted';
    $MULTILANG_ArrastrarTarea='Mueva tareas rapidamente arrastr&aacute;ndolas sobre este t&iacute;tulo.';
    $MULTILANG_TodosLosTableros='Todos los tableros kanban';

    //ModuloBugTracker
    $MULTILANG_BTReporteBugs='Reporte de errores o mejoras';
    $MULTILANG_BTUltimaActualizacion='Ultima fecha de actualizaci&oacute;n';
    $MULTILANG_BTSeveridad='Severidad';
    $MULTILANG_BTUsuarioReporte='Reportado por';
    $MULTILANG_BTAsignadoA='Asignado a';
    $MULTILANG_BTPasos='Pasos para reproducir el problema';
    $MULTILANG_BTOrigen='Sistema origen';
    $MULTILANG_BTTrazas='Trazas asociadas al error';
    $MULTILANG_BTVersion='Versi&oacute;n del proyecto o producto';
    $MULTILANG_BTDescripcion='Descripci&oacute;n del error o mejora';
    $MULTILANG_BTFechaCierre='Fecha de cierre:';
    $MULTILANG_BTProyectoAsociado='Proyecto asociado';
    $MULTILANG_BTFechaApertura='Fecha de apertura del caso';
    $MULTILANG_BTHistorial='Historial de gesti&oacute;n';
    $MULTILANG_BTCategoriaDes='Por favor indique si el reporte que hace corresponde a un Error de aplicaci&oacute;n, una posible idea de mejora detectada o una pregunta sobre las funcionalidades';
    $MULTILANG_BTComplementoDes='Si aplica, describa el paso a paso que se debería realizar para reproducir el problema.';
    $MULTILANG_BTRetornoMsj='El reporte de error o posibilidad de mejora ha sido enviado al equipo de desarrollo.';
    $MULTILANG_BTConfirmacionMsj='Esta a punto de reportar un Bug/Error/Mejora en el sistema.  Esta seguro que desea continuar?';
    $MULTILANG_BTPanel='Panel de gesti&oacute;n de errores o bugs';
    $MULTILANG_BTBugtracking='Bugtracking';
    $MULTILANG_BTPermitirReporte='Permitir a usuarios reportar errores';
    $MULTILANG_BTVistaUsuario='Vista del navegador del usuario al momento de enviar el reporte';
    $MULTILANG_BTAccionRealizada='Accion o revision realizada para el caso';
    $MULTILANG_BTEstadoNuevo='Nuevo';
    $MULTILANG_BTEstadoProgreso='EnProgreso';
    $MULTILANG_BTEstadoCerrado='Cerrado';
    $MULTILANG_BTPrevios='Ver estado de reportes enviados anteriormente';

    //Opciones de Documentacion
    $MULTILANG_Documentar='Documentar';
    $MULTILANG_DocumentarDes='Agregar al comienzo del c&oacute;digo una plantilla de documentaci&oacute;n para funciones o procedimientos en notaci&oacute;n NaturalDocs';
    $MULTILANG_DocumentarLink='Abrir ayuda de documentaci&oacute;n extra para NaturalDocs';
    
    //PWA
    $MULTILANG_PWAActivar='Activar el uso de Aplicaciones Web Progresivas';
    $MULTILANG_PWAAyuda='Permite activar en la aplicaci&oacute;n la tecnolog&iacute;a PWA que permite que su aplicaci&oacute;n haga una solicitud de instalaci&oacute;n como aplicaci&oacute;n m&oacute;vil desde los navegadores en dispositivos que soporten dicha tecnolog&iacute;a.   Para m&aacute;s informaci&oacute;n consulte los enlaces  https://w3c.github.io/manifest/  y  https://developers.google.com/web/progressive-web-apps/';
    $MULTILANG_PWAIconos='Definici&oacute;n de iconos para la App';
    $MULTILANG_PWADescripcion='Aplicacion Web Progresiva generada automaticamente por Practico Framework';
    $MULTILANG_PWADireccionTexto='Direcci&oacute;n del texto';
    $MULTILANG_PWADisplayPreferido='Modo de visualizaci&oacute;n preferido';
    $MULTILANG_PWAOrientacionPantalla='Orientaci&oacute;n de pantalla';
    $MULTILANG_PWAGCM='ID de Firebase Cloud Messaging';
    $MULTILANG_PWAScope='Alcance (Scope)';
    $MULTILANG_PWAScopeDes='Si su instalaci&oacute;n de Pr&aacute;ctico reside sobre la raiz de su servidor web o subdominio puede dejar esto en blanco.  Si su instalaci&oacute;n reside sobre alguna carpeta por favor indique ./carpeta/ para establecer el alcance del Service Worker y el manifiesto de PWA.';
    $MULTILANG_PWAAutorizarGPS='Solicitar autorizaci&oacute;n para obtener ubicaci&oacute;n (GPS)';
    $MULTILANG_PWAAutorizarFCM='Solicitar autorizaci&oacute;n de env&iacute;o notificaciones (PUSH)';
    $MULTILANG_PWAAutorizarCAM='Solicitar autorizaci&oacute;n para dispositivo de video (CAMARA)';
    $MULTILANG_PWAAutorizarMIC='Solicitar autorizaci&oacute;n para dispositivo de audio (MICROFONO)';
    $MULTILANG_PWAOcultarBarrasExtra='Ocultar barras de navegacion a usuarios estandar?';
    $MULTILANG_PWAOcultarBarrasExtraDes='Permite ahorrar espacio para la aplicacion de escritoio o movil mediante el ocultamiento de dichos elementos.  Aplica solo para usuarios estandar (no disenadores).  El desarrollador deberia garantizar acceso a ciertas funcionalidades ocultas de la barra mediante controles propios pues el usuario ya no podra verlos en las opciones por defecto, como por ejemplo el cierre de sesion entre otros.';
    
    //Planificador de tareas
    $MULTILANG_CronTitulo='Planificador de tareas';
    $MULTILANG_CronComando='Comando cron';
    $MULTILANG_CronComando='URL absoluta';
    $MULTILANG_CronPlanificacion='Tipo de planificaci&oacute;n';
    $MULTILANG_CronAyuda='Puede programar la ejecuci&oacute;n de su tarea mediante el demonio cron de su sistema operativo y el comando correspondiente o mediante el uso de herramientas externas gratuitas como CloudScheduler de GCP y la URL absoluta indicada. Recuerde no revelar el c&oacute;digo de tarea pues su ejecuci&oacute;n podria ser realizada por cualquiera que lo conozca, lo que a su vez puede ser &uacute;til para la creaci&oacute;n de tareas totalmente p&uacute;blicas con ejecuci&oacute;n sin control de usuario, llaves o similares.';
    
    //PCoder
	$MULTILANG_PCODER_Abrir='Abrir';
	$MULTILANG_PCODER_Aceptar='Aceptar';
	$MULTILANG_PCODER_Activar='Activar';
	$MULTILANG_PCODER_Archivo='Archivo';
	$MULTILANG_PCODER_Acercar='Acercar';
	$MULTILANG_PCODER_Alejar='Alejar';
	$MULTILANG_PCODER_Ayuda='Ayuda';
	$MULTILANG_PCODER_Basicos='B&aacute;sicos';
	$MULTILANG_PCODER_Buscar='Buscar';
	$MULTILANG_PCODER_Cancelar='Cancelar';
	$MULTILANG_PCODER_Caracteres='Caracteres';
	$MULTILANG_PCODER_Cargando='Cargando';
	$MULTILANG_PCODER_Carpeta='Carpeta';
	$MULTILANG_PCODER_Cerrar='Cerrar';
	$MULTILANG_PCODER_Columna='Columna';
	$MULTILANG_PCODER_Comunes='Comunes';
	$MULTILANG_PCODER_Copiar='Copiar';
	$MULTILANG_PCODER_Cortar='Cortar';
	$MULTILANG_PCODER_Depurar='Depurar';
	$MULTILANG_PCODER_Desactivar='Desactivar';
	$MULTILANG_PCODER_Deshacer='Deshacer';
	$MULTILANG_PCODER_Desplazar='Desplazar';
	$MULTILANG_PCODER_Editar='Editar';
	$MULTILANG_PCODER_Eliminado='Eliminado';
	$MULTILANG_PCODER_Error='Error';
	$MULTILANG_PCODER_Estado='Estado';
	$MULTILANG_PCODER_Explorar='Explorar';
	$MULTILANG_PCODER_Finalizado='Finalizado';
	$MULTILANG_PCODER_Formato='Formato';
	$MULTILANG_PCODER_Guardando='Guardando';
	$MULTILANG_PCODER_Guardar='Guardar';
	$MULTILANG_PCODER_Herramientas='Herramientas';
	$MULTILANG_PCODER_Ir='Ir';
	$MULTILANG_PCODER_Linea='L&iacute;nea';
	$MULTILANG_PCODER_Lineas='L&iacute;neas';
	$MULTILANG_PCODER_Modificado='Modificado';
	$MULTILANG_PCODER_No='No';
	$MULTILANG_PCODER_Nombre='Nombre';
	$MULTILANG_PCODER_Nuevo='Nuevo';
	$MULTILANG_PCODER_Operacion='Operaci&oacute;n';
	$MULTILANG_PCODER_Otros='Otros';
	$MULTILANG_PCODER_Pegar='Pegar';
	$MULTILANG_PCODER_Permisos='Permisos';
	$MULTILANG_PCODER_Predeterminado='Predeterminado';
	$MULTILANG_PCODER_Preferencias='Preferencias del editor {P}Coder';
	$MULTILANG_PCODER_Propietario='Propietario';
	$MULTILANG_PCODER_Reemplazar='Reemplazar';
	$MULTILANG_PCODER_Rehacer='Rehacer';
	$MULTILANG_PCODER_Salir='Salir';
	$MULTILANG_PCODER_Seleccionar='Seleccionar';
	$MULTILANG_PCODER_Si='Si';
	$MULTILANG_PCODER_Tamano='Tama&ntilde;o';
	$MULTILANG_PCODER_Tipo='Tipo';
	$MULTILANG_PCODER_Trabajando='Trabajando';
	$MULTILANG_PCODER_Ubicacion='Ubicaci&oacute;n';
	$MULTILANG_PCODER_Ver='Ver';

	//Mensajes de error y varios
	$MULTILANG_PCODER_Minimap='Minimapa de c&oacute;digo';
	$MULTILANG_PCODER_AumSangria='Aumentar sangr&iacute;a';
	$MULTILANG_PCODER_DisSangria='Disminuir sangr&iacute;a';
	$MULTILANG_PCODER_ConvMay='Convertir a may&uacute;scula';
	$MULTILANG_PCODER_ConvMin='Convertir a min&uacute;scula';
	$MULTILANG_PCODER_OrdenaSel='Ordenar la seleccion';
	$MULTILANG_PCODER_CargarArchivo='Cargar el archivo';
    $MULTILANG_PCODER_Ajuste='Ajuste de ventana';
	$MULTILANG_PCODER_DefPcoder='Editor de c&oacute;digo';
	$MULTILANG_PCODER_EnlacePcoder='Editor de C&oacute;digo {P}Coder';
	$MULTILANG_PCODER_AtajosTitPcoder='Atajos de teclado';
	$MULTILANG_PCODER_PcoderAjuste='Ajuste de ventana';
	$MULTILANG_PCODER_ErrorRW='No se tienen permisos para escribir sobre el archivo! Cualquier cambio realizado podr&iacute;a perderse';
	$MULTILANG_PCODER_SaltarLinea='Saltar a l&iacute;nea';
	$MULTILANG_PCODER_Acerca='Acerca de';
	$MULTILANG_PCODER_AparienciaEditor='Apariencia del editor';
	$MULTILANG_PCODER_TamanoFuente='Tama&ntilde;o de la fuente';
	$MULTILANG_PCODER_LenguajeProg='Lenguaje de programaci&oacute;n';
	$MULTILANG_PCODER_VerCaracteres='Ver caracteres invisibles';
	$MULTILANG_PCODER_CerrarVentana='Finalizar edici&oacute;n';
	$MULTILANG_PCODER_PathFull='Raiz de Todo el servidor web';
	$MULTILANG_PCODER_PathDisco='Raiz del disco duro';
	$MULTILANG_PCODER_CaracNoImprimibles='Ver/Ocultar Caracteres no imprimibles';
	$MULTILANG_PCODER_PantallaCompleta='Pantalla completa';
	$MULTILANG_PCODER_PanelIzq='Panel izquierdo';
	$MULTILANG_PCODER_PanelDer='Panel derecho';
	$MULTILANG_PCODER_OcultarPanel='Ocultar panel';
	$MULTILANG_PCODER_RevisarSintaxis='Revisar sintaxis del lenguaje mientras se escribe';
	$MULTILANG_PCODER_SeleccionarTodo='Seleccionar todo';
	$MULTILANG_PCODER_DepuraErrorSiguiente='Ir al error siguiente';
	$MULTILANG_PCODER_DepuraErrorPrevio='Ir al error previo';
	$MULTILANG_PCODER_EnrollarSeleccion='Enrollar la selecci&oacute;n';
	$MULTILANG_PCODER_DesenrollarTodo='Desenrollar todo';
	$MULTILANG_PCODER_DuplicarSeleccion='Duplicar selecci&oacute;n';
	$MULTILANG_PCODER_InvertirSeleccion='Invertir selecci&oacute;n';
	$MULTILANG_PCODER_UnirSeleccion='Convertir selecci&oacute;n a una linea';
	$MULTILANG_PCODER_DividirNO='No dividir editor de c&oacute;digo';
	$MULTILANG_PCODER_DividirHorizontal='Dividir horizontalmente';
	$MULTILANG_PCODER_DividirVertical='Dividir verticalmente';
	$MULTILANG_PCODER_ClicSeleccionar='Clic para seleccionar';
	$MULTILANG_PCODER_ExploradorColores='Explorador de colores';
	$MULTILANG_PCODER_TerminalRemota='Terminal remota';
	$MULTILANG_PCODER_EditorArchivos='Editor de archivos';
	$MULTILANG_PCODER_NavegadorEmbebido='Navegador web embebido';
	$MULTILANG_PCODER_AdvertenciaCierre='Esta intentando cerrar todo el editor {P}Coder y sus archivos actuales seran liberados del bloqueo de apertura. Esto tomara un momento segun el numero de archivos abiertos actualmente.\n\n\nLa edicion de archivos que haya realizado y no haya almacenado todavia se puede perder.  Se requiere su confirmacion para continuar.';
	$MULTILANG_PCODER_ErrGuardarDefecto='Debe especificar o abrir un archivo diferente al predeterminado del editor!';
	$MULTILANG_PCODER_ErrGuardarNoPermiso='No tiene permisos de escritura sobre este archivo!.  Verifique los permisos del mismo e intente nuevamente';
	$MULTILANG_PCODER_CrearArchivo='Nuevo Archivo';
	$MULTILANG_PCODER_CrearCarpeta='Nueva Carpeta';
	$MULTILANG_PCODER_EditarPermisos='Editar permisos';
	$MULTILANG_PCODER_SubirArchivo='Subir archivo';
	$MULTILANG_PCODER_RecargarExplorador='Recargar explorador';
	$MULTILANG_PCODER_EliminarElemento='Eliminar archivo/carpeta';
	$MULTILANG_PCODER_OperacionesFS='Operaciones con archivos, carpetas y permisos';
	$MULTILANG_PCODER_ElementoCreado='El elemento ha sido creado';
	$MULTILANG_PCODER_ElementoExiste='El elemento indicado ya existe';
	$MULTILANG_PCODER_ElementoNoCreado='El elemento no puede ser creado, eliminado o modificado sobre el sistema de ficheros.  Verifique que cuenta con permisos suficientes';
	$MULTILANG_PCODER_NrosLinea='Ver/Ocultar Numeros de linea, plegado y chequeo de sintaxis';
	$MULTILANG_PCODER_CheqSintaxis='Chequeo de sintaxis';
	$MULTILANG_PCODER_LenguajeResaltado='Lenguaje de resaltado';
	$MULTILANG_PCODER_ExtensionNoSoportada='La extensión del archivo que intenta abrir no se encuentra soprotada.  Si lo desea puede agregarla a la lista de extensiones soportadas en caso que aun quiera editarla mediante PCoder.';
	$MULTILANG_PCODER_HerramientaDiferencias='Visor de diferencias';
	$MULTILANG_PCODER_SensibleMayusculas='Distinguir May&uacute;sculas / Min&uacute;sculas';
	$MULTILANG_PCODER_Autocompletado='Autocompletado mientras se escribe';
	$MULTILANG_PCODER_HistorialVersiones='Historial de versiones';
	$MULTILANG_PCODER_ChatDesarrolladores='Herramientas de colaboracion<br>para desarrolladores';
	$MULTILANG_PCODER_ErrorRO='ERROR: El archivo se encuentra bloqueado contra apertura simult&aacute;nea. S&oacute;lo el usuario asociado o el super usuario (admin) pueden desbloquear su acceso.';
	$MULTILANG_PCODER_AdvertenciaMalCierre='ADVERTENCIA: El archivo fue abierto anteriormente por usted pero no fue cerrado adecuadamente.  Se le recomienda cerrar correctamente sus archivos y sesi&oacute;n de {P}Coder para evitar bloqueos de apertura simult&aacute;nea para otros usuarios.  <b><font color=blue>Para evitar esto simplemente utilice la opcion Archivo->Salir la pr&oacute;xima vez o cierre su archivo desde el boton naranja en la parte superior izquierda.<button class=\'btn btn-warning btn-xs\'><b>X</b></button></font></b>';
	$MULTILANG_PCODER_AdvConcurrencia='<font color=red>CUIDADO CUIDADO CUIDADO !!!</font><br>Esto tambi&eacute;n puede indicar que incluso usted mismo tiene abierto este archivo desde otra estaci&oacute;n de trabajo.  El archivo ser&aacute; abierto pero tenga cuidado de no sobreescribir cambios al cargar desde diferentes computadoras el mismo archivo de trabajo o utilice la opci&oacute;n <b>Archivo->Historial de versiones</b> para verificar cualquier cambio.';