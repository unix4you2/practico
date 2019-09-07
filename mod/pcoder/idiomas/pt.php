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
		Title: Idioma portugues para modulo de PCoder
		Ubicacion *[idioma/pt.php]*.  Incluye la definicion de variables utilizadas para presentar mensajes en el idioma correspondiente
		NOTAS IMPORTANTES:
			* Por cuestiones de rendimiento se recomienda la definicion usando comillas simples.
			* Usar las dobles solo cuando se requieran variables o caracteres especiales.
			* Se pueden definir cadenas en funcion de otras definidas con anterioridad
			* Se puede hacer uso de notacion HTML dentro de las cadenas para dar formato
	*/

	// Cadena que describe el archivo de idioma para su escogencia
	$MULTILANG_PCODER_DescripcionIdioma='Português - Portuguese (by GoogleTranslator)';

	//Lexico general
	$MULTILANG_PCODER_Abrir='Aberto';
	$MULTILANG_PCODER_Aceptar='Aceitar';
	$MULTILANG_PCODER_Activar='Habilitar';
	$MULTILANG_PCODER_Archivo='Arquivo';
	$MULTILANG_PCODER_Acercar='Mais Zoom';
	$MULTILANG_PCODER_Alejar='Menos zoom';
	$MULTILANG_PCODER_Ayuda='Socorro';
	$MULTILANG_PCODER_Basicos='B&aacute;sico';
	$MULTILANG_PCODER_Buscar='Encontrar';
	$MULTILANG_PCODER_Cancelar='Cancelar';
	$MULTILANG_PCODER_Caracteres='Caracter';
	$MULTILANG_PCODER_Cargando='Carregando';
	$MULTILANG_PCODER_Carpeta='Pasta';
	$MULTILANG_PCODER_Cerrar='Fechar';
	$MULTILANG_PCODER_Columna='Coluna';
	$MULTILANG_PCODER_Copiar='C&aacute;pia';
	$MULTILANG_PCODER_Cortar='Cortar';
	$MULTILANG_PCODER_Depurar='Depurar';
	$MULTILANG_PCODER_Desactivar='Incapacitar';
	$MULTILANG_PCODER_Deshacer='Desfazer';
	$MULTILANG_PCODER_Desplazar='Passo';
	$MULTILANG_PCODER_Editar='Editar';
	$MULTILANG_PCODER_Eliminado='Suprimido';
	$MULTILANG_PCODER_Error='Erro';
	$MULTILANG_PCODER_Estado='Estatuto';
	$MULTILANG_PCODER_Explorar='Explorar';
	$MULTILANG_PCODER_Finalizado='Terminado';
	$MULTILANG_PCODER_Formato='Formato';
	$MULTILANG_PCODER_Guardando='Guardar';
	$MULTILANG_PCODER_Guardar='Guardar';
	$MULTILANG_PCODER_Herramientas='Ferramentas';
	$MULTILANG_PCODER_Ir='Ir';
	$MULTILANG_PCODER_Linea='Linha';
	$MULTILANG_PCODER_Lineas='Linhas';
	$MULTILANG_PCODER_Modificado='Modificado';
	$MULTILANG_PCODER_No='Não';
	$MULTILANG_PCODER_Nombre='Nome';
	$MULTILANG_PCODER_Nuevo='Novo';
	$MULTILANG_PCODER_Operacion='Operação';
	$MULTILANG_PCODER_Otros='Outros';
	$MULTILANG_PCODER_Pegar='Colar';
	$MULTILANG_PCODER_Permisos='Permissões';
	$MULTILANG_PCODER_Predeterminado='Padrão';
	$MULTILANG_PCODER_Preferencias='Preferências do editor {P}Coder';
	$MULTILANG_PCODER_Propietario='Proprietário';
	$MULTILANG_PCODER_Reemplazar='Substituir';
	$MULTILANG_PCODER_Rehacer='Refazer';
	$MULTILANG_PCODER_Salir='Sair';
	$MULTILANG_PCODER_Seleccionar='Selecionar';
	$MULTILANG_PCODER_Si='Sim';
	$MULTILANG_PCODER_Tamano='Tamanho';
	$MULTILANG_PCODER_Tipo='Tipo';
	$MULTILANG_PCODER_Trabajando='Trabalhando';
	$MULTILANG_PCODER_Ubicacion='Localização';
	$MULTILANG_PCODER_Ver='Visão';

	//Mensajes de error y varios
	$MULTILANG_PCODER_Minimap='Code Minimap';
	$MULTILANG_PCODER_AumSangria='Aumenta o travessão';
	$MULTILANG_PCODER_DisSangria='Diminuir travessão';
	$MULTILANG_PCODER_ConvMay='Converter para mai&uacute;sculas';
	$MULTILANG_PCODER_ConvMin='Converter para min&uacute;sculas';
	$MULTILANG_PCODER_OrdenaSel='Seleção de ordem';
	$MULTILANG_PCODER_CargarArchivo='Carregar arquivo';
    $MULTILANG_PCODER_Ajuste='Ajuste janela';
	$MULTILANG_PCODER_DefPcoder='Editor de c&oacute;digo on-line';
	$MULTILANG_PCODER_EnlacePcoder='Editor de C&oacute;digo {P}Coder';
	$MULTILANG_PCODER_AtajosTitPcoder='Atalhos do teclado';
	$MULTILANG_PCODER_PcoderAjuste='Ajuste janela';
	$MULTILANG_PCODER_ErrorRW='Você não tem direitos para escrever este arquivo! Qualquer alteração ser&aacute; perdida!';
	$MULTILANG_PCODER_SaltarLinea='Ir para linha';
	$MULTILANG_PCODER_Acerca='Cerca de';
	$MULTILANG_PCODER_ResumenLicencia='Esta ferramenta &eacute; um Software Livre sob GNU-GPL v3 License';
	$MULTILANG_PCODER_AparienciaEditor='Tema editor';
	$MULTILANG_PCODER_TamanoFuente='Tamanho da fonte';
	$MULTILANG_PCODER_LenguajeProg='Linguagem de programação';
	$MULTILANG_PCODER_VerCaracteres='Mostrar escondido caracteres';
	$MULTILANG_PCODER_CerrarVentana='As alterações podem perder';
	$MULTILANG_PCODER_PathFull='Raiz do WebServer';
	$MULTILANG_PCODER_PathDisco='Raiz do disco rígido';
	$MULTILANG_PCODER_CaracNoImprimibles='Exposição / Esconder personagens invis&iacute;veis';
	$MULTILANG_PCODER_PantallaCompleta='Tela cheia';
	$MULTILANG_PCODER_PanelIzq='Painel esquerdo';
	$MULTILANG_PCODER_PanelDer='Painel direito';
	$MULTILANG_PCODER_OcultarPanel='Painel cerrar';
	$MULTILANG_PCODER_RevisarSintaxis='Verifique a sintaxe da linguagem, enquanto eu escrevo';
	$MULTILANG_PCODER_SeleccionarTodo='Selecionar tudo';
	$MULTILANG_PCODER_DepuraErrorSiguiente='Ir para o próximo erro';
	$MULTILANG_PCODER_DepuraErrorPrevio='Ir de erro anterior';
	$MULTILANG_PCODER_EnrollarSeleccion='Dobre texto selecionado';
	$MULTILANG_PCODER_DesenrollarTodo='Desdobrar tudo';
	$MULTILANG_PCODER_DuplicarSeleccion='Seleção duplicado';
	$MULTILANG_PCODER_InvertirSeleccion='Seleção invertida';
	$MULTILANG_PCODER_UnirSeleccion='Adira selecionado em uma linha';
	$MULTILANG_PCODER_DividirNO='Nenhum editor de código de divisão';
	$MULTILANG_PCODER_DividirHorizontal='Divisão horizontal';
	$MULTILANG_PCODER_DividirVertical='Divisão vertical';
	$MULTILANG_PCODER_ClicSeleccionar='Clique para selecionar';
	$MULTILANG_PCODER_ExploradorColores='Explorador Cor';
	$MULTILANG_PCODER_TerminalRemota='Terminal remoto';
	$MULTILANG_PCODER_EditorArchivos='Editor de arquivo';
	$MULTILANG_PCODER_NavegadorEmbebido='Navegador web embutido';
	$MULTILANG_PCODER_AdvertenciaCierre='Você está tentando desligar todo o editor {PI} Código. Arquivos editados que você armazenou ainda a não perder. Sua confirmação é necessária para continuar.';
	$MULTILANG_PCODER_ErrGuardarDefecto='Você deve especificar uma arquivo válido para salvar ou abrir um arquivo para editar!';
	$MULTILANG_PCODER_ErrGuardarNoPermiso='Você não tem direitos para escrever este arquivo usando o seu usuário do servidor web !. Verifique as permissões e tente novamente.';
	$MULTILANG_PCODER_CrearArchivo='Novo arquivo';
	$MULTILANG_PCODER_CrearCarpeta='Novo pasta';
	$MULTILANG_PCODER_EditarPermisos='Editar permissões';
	$MULTILANG_PCODER_SubirArchivo='Subir arquivo';
	$MULTILANG_PCODER_RecargarExplorador='Explorador de recarga';
	$MULTILANG_PCODER_EliminarElemento='Excluir o arquivo / pasta';
	$MULTILANG_PCODER_OperacionesFS='Archivos, carpetas y tareas de permisos';
	$MULTILANG_PCODER_ElementoCreado='O elemento foi criado';
	$MULTILANG_PCODER_ElementoExiste='O elemento já existe';
	$MULTILANG_PCODER_ElementoNoCreado='O elemento não pode ser criado, excluído ou modificado ao longo do sistema de arquivos. Por favor verifique as suas permissões';
	$MULTILANG_PCODER_NrosLinea='N&uacute;meros de linha Si / No';
	$MULTILANG_PCODER_CheqSintaxis='Verificação de sintaxe';
	$MULTILANG_PCODER_LenguajeResaltado='Idioma realçado';
	$MULTILANG_PCODER_ExtensionNoSoportada='A extensão do arquivo que você está tentando abrir não é suportado. Você pode adicioná-lo às extensões suportadas se você quiser editar esse arquivo usando PCoder.';
	$MULTILANG_PCODER_HerramientaDiferencias='Ferramenta de diferenças';
	$MULTILANG_PCODER_SensibleMayusculas='Maiúsculas e minúsculas';
	$MULTILANG_PCODER_Autocompletado='Autocomplete enquanto você digita';
	$MULTILANG_PCODER_HistorialVersiones='Version history';
	$MULTILANG_PCODER_ChatDesarrolladores='Developers chat only';
	$MULTILANG_PCODER_ErrorRO='ERROR: This file is locked for open it simultaneously. Only the user or super user (admin) can unlock it.';
	$MULTILANG_PCODER_AdvertenciaCierre='WARNING: This file was opened by you in the past but this was not closed propertly.  We advice you to close your sessions and files correctly to avoid simultaneous file locks for other users.';
	$MULTILANG_PCODER_AdvConcurrencia='<font color=red>WARNING WARNING WARNING !!!</font><br>This may also indicate that even you have this file open from another workstation. The file will be open but be careful not to overwrite changes when loading the same work file from different computers or use the <b> File-> Version History </b> option to verify any changes.';
