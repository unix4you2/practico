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
	$MULTILANG_PCODER_Archivo='Arquivo';
	$MULTILANG_PCODER_Ayuda='Socorro';
	$MULTILANG_PCODER_Basicos='B&aacute;sico';
	$MULTILANG_PCODER_Buscar='Encontrar';
	$MULTILANG_PCODER_Cancelar='Cancelar';
	$MULTILANG_PCODER_Caracteres='Caracter';
	$MULTILANG_PCODER_Cargando='Carregando';
	$MULTILANG_PCODER_Cerrar='Fechar';
	$MULTILANG_PCODER_Copiar='C&aacute;pia';
	$MULTILANG_PCODER_Cortar='Cortar';
	$MULTILANG_PCODER_Deshacer='Desfazer';
	$MULTILANG_PCODER_Desplazar='Passo';
	$MULTILANG_PCODER_Editar='Editar';
	$MULTILANG_PCODER_Error='Erro';
	$MULTILANG_PCODER_Estado='Estatuto';
	$MULTILANG_PCODER_Explorar='Explorar';
	$MULTILANG_PCODER_Finalizado='Terminado';
	$MULTILANG_PCODER_Formato='Formato';
	$MULTILANG_PCODER_Guardando='Guardar';
	$MULTILANG_PCODER_Guardar='Guardar';
	$MULTILANG_PCODER_Ir='Ir';
	$MULTILANG_PCODER_Lineas='Linhas';
	$MULTILANG_PCODER_Modificado='Modificado';
	$MULTILANG_PCODER_No='Não';
	$MULTILANG_PCODER_Otros='Outros';
	$MULTILANG_PCODER_Pegar='Colar';
	$MULTILANG_PCODER_Predeterminado='Padrão';
	$MULTILANG_PCODER_Preferencias='Preferências';
	$MULTILANG_PCODER_Reemplazar='Substituir';
	$MULTILANG_PCODER_Rehacer='Refazer';
	$MULTILANG_PCODER_Salir='Sair';
	$MULTILANG_PCODER_Seleccionar='Selecionar';
	$MULTILANG_PCODER_Si='Sim';
	$MULTILANG_PCODER_Tamano='Tamanho';
	$MULTILANG_PCODER_Tipo='Tipo';

	//Mensajes de error y varios
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
	$MULTILANG_PCODER_ErrorExistencia='O arquivo que você deseja abrir doesnt existe!';
	$MULTILANG_PCODER_ErrorRW='Você não tem direitos para escrever este arquivo! Qualquer alteração ser&aacute; perdida!';
	$MULTILANG_PCODER_ErrorNoACE='Não h&aacute; módulo ACE instalado para editar este arquivo';
	$MULTILANG_PCODER_AyudaExplorador='Importante: Algumas pastas estão showd como uma opção informativo sobre eles. De qualquer forma, eles são expandidos se eles têm apenas arquivos edit&aacute;veis';
	$MULTILANG_PCODER_SaltarLinea='Ir para linha';
	$MULTILANG_PCODER_Acerca='Cerca de';
	$MULTILANG_PCODER_ResumenLicencia='Esta ferramenta &eacute; um Software Livre sob GNU-GPL v3 License';
	$MULTILANG_PCODER_AparienciaEditor='Tema editor';
	$MULTILANG_PCODER_TamanoFuente='Tamanho da fonte';
	$MULTILANG_PCODER_LenguajeProg='Linguagem de programação';
	$MULTILANG_PCODER_VerCaracteres='Mostrar escondido caracteres';
	$MULTILANG_PCODER_CerrarVentana='As alterações podem perder';
	$MULTILANG_PCODER_PathDisponible='Caminhos de exploração dispon&iacute;veis';
	$MULTILANG_PCODER_Path1Punto='Pasta atual de PCoder (geralmente mais mod/pcoder)';
	$MULTILANG_PCODER_Path2Punto='Raiz de PCoder como Module (geralmente mais mod/pcoder/mod)';
	$MULTILANG_PCODER_Path3Punto='Raiz de PCoder como autônomo (onde você pode encontrar LICENSE, AUTHORS, Etc)';
	$MULTILANG_PCODER_Path4Punto='Instale raiz para PCoder como autônomo ou Practico raiz se &eacute; um módulo';
	$MULTILANG_PCODER_PathFull='WebServer Root. Poderia ser monitores segundo lento para os ficheiros dispon&iacute;veis.';
	$MULTILANG_PCODER_CaracNoImprimibles='Exposição / Esconder personagens invis&iacute;veis';
