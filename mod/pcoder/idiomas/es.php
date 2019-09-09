<?php
	/*
	   PCODER (Editor de Codigo en la Nube)
	   Sistema de Edicion de Codigo basado en PHP
	   Copyright (C) 2013  John F. Arroyave Gutiérrez
						   unix4you2@gmail.com
						   www.practico.org

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
	*/

	/*
		Title: Idioma espanol para modulo de PCoder
		Ubicacion *[idioma/es.php]*.  Incluye la definicion de variables utilizadas para presentar mensajes en el idioma correspondiente
		NOTAS IMPORTANTES:
			* Por cuestiones de rendimiento se recomienda la definicion usando comillas simples.
			* Usar las dobles solo cuando se requieran variables o caracteres especiales.
			* Se pueden definir cadenas en funcion de otras definidas con anterioridad
			* Se puede hacer uso de notacion HTML dentro de las cadenas para dar formato
	*/

	// Cadena que describe el archivo de idioma para su escogencia
	$MULTILANG_PCODER_DescripcionIdioma='Espanol - Spanish';

	//Lexico general
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
	$MULTILANG_PCODER_DefPcoder='Editor de c&oacute;digo en l&iacute;nea';
	$MULTILANG_PCODER_EnlacePcoder='Editor de C&oacute;digo {P}Coder';
	$MULTILANG_PCODER_AtajosTitPcoder='Atajos de teclado';
	$MULTILANG_PCODER_PcoderAjuste='Ajuste de ventana';
	$MULTILANG_PCODER_ErrorRW='No se tienen permisos para escribir sobre el archivo! Cualquier cambio realizado podr&iacute;a perderse';
	$MULTILANG_PCODER_SaltarLinea='Saltar a l&iacute;nea';
	$MULTILANG_PCODER_Acerca='Acerca de';
	$MULTILANG_PCODER_ResumenLicencia='Esta herramienta es Software Libre distribuido bajo licencia GNU-GPL v3';
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
	$MULTILANG_PCODER_ErrGuardarDefecto='Debe especificar o abrir un arcihvo diferente al predeterminado del editor!';
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
	$MULTILANG_PCODER_AdvertenciaMalCierre='ADVERTENCIA: El archivo fue abierto anteriormente por usted pero no fue cerrado adecuadamente.  Se le recomienda cerrar correctamente sus archivos y sesi&oacute;n de {P}Coder para evitar bloqueos de apertura simult&aacute;nea para otros usuarios.  <b><font color=blue>Para evitar esto simplemente utilice la opcion Archivo->Salir la pr&oacute;xima vez.</font></b>';
	$MULTILANG_PCODER_AdvConcurrencia='<font color=red>CUIDADO CUIDADO CUIDADO !!!</font><br>Esto tambi&eacute;n puede indicar que incluso usted mismo tiene abierto este archivo desde otra estaci&oacute;n de trabajo.  El archivo ser&aacute; abierto pero tenga cuidado de no sobreescribir cambios al cargar desde diferentes computadoras el mismo archivo de trabajo o utilice la opci&oacute;n <b>Archivo->Historial de versiones</b> para verificar cualquier cambio.';