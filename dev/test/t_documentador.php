<?php
/*  C1 - 
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

session_start();

// C2 - BIENVENIDO A LA ZONA DE PRUEBAS - Archivo usado para pruebas del documentador automatico
$UnaSentencia="Previa a un";    // C3 - Comentario con doble slash
$OtraSentencia="Previa a";      #  C4 - Comentario con numeral - NO SOPORTADO inicialmente
$OtraInstruccion="Previa a";    /* C5 - Comentario entre bloque a una linea*/
$SentenciaIndependiente="Sin comentarios de ningun tipo";
/* C6 - Aqui un Comentario de bloque
de multiples lineas*/

    /* C7 - Aqui un Comentario de bloque
    de multiples lineas
    con tabulaciones y sangrias*/

    /* C8 - Aqui un Comentario de bloque
    de multiples lineas incluyendo //Comentario a ignorar
    con tabulaciones y sangrias*/

$AsignacionOtraVariable="LMQTP";

// C9 - TODO1:  {P}Coder y almacenamiento de objetos internos deben ser intervenidor para parsear y actualizar documentacion en linea
// C10 - TODO2:  {P}Coder con jerarquía de edicion Formulario->Script Formulario->Objeto-ScriptEvento

########################################################################
########################################################################
/* C11 - 
	Function: PCO_ObtenerBloquesDocumentacion
	Obtiene todos los bloques de documentacion del codigo fuente entregado

	Variables de entrada:

		CadenaAnalizada - Cadena que contiene el codigo fuente de lenguaje a analizar
		Lenguaje - Nombre corto descriptor del lenguaje de programacion desde el cual proviene el codigo.  Uno de PHP|JavaScript
		MaximoComentariosAnalisis - -1 para Ilimitado o una cantidad máxima de comentarios que serán analizados.  Por defecto se define en el valor de pruebas del propio archivo

	Salida:
		Arreglo con todos los elementos encontrados que contienen comentarios o bloques de comentarios 
*/
function PCO_ObtenerBloquesDocumentacion($CodigoAnalizado="",$Lenguaje="PHP")
    {
        $docComments = array_filter( token_get_all( file_get_contents( __FILE__ ) ), function($entry) { return $entry[0] == T_DOC_COMMENT; } );
        $fileDocComment = array_shift( $docComments );
        return $fileDocComment[1];
    }

function PCO_ObtenerBloquesDocumentacionDEPRECATED_ONLYPHP($CodigoAnalizado="",$Lenguaje="PHP")
    {
        $tokens = token_get_all('Cadena de codigo analizada');
        $tokens = token_get_all(file_get_contents( __FILE__ ));
        $tokens = token_get_all(file_get_contents( "../inc/bootstrap/js/practico.js" ));
        return $tokens;
    }


########################################################################
########################################################################
/*
    C12 - 
    @Seccion@ Funciones principales - Usadas durante toda la ejecucion
	@Funcion@ stripWhitespace
	Utilizada para quitar algunos espacios en blanco dentro de una cadena

	Variables de entrada:

		ArregloComentarios - Arreglo que contiene todos los comentarios de un codigo fuente analizado
		@Var@ Edad - Edad del trabajador al que se desea liquidar vacaciones
		@Var@ Salario - Salario base del trabajador
*/
function stripWhitespace($source)
     {
         if (!function_exists('token_get_all')) {
             return $source;
         }
         $output = '';
         foreach (token_get_all($source) as $token) {
             if (is_string($token)) {
                 $output .= $token;
             } elseif (in_array($token[0], array(T_COMMENT, T_DOC_COMMENT))) {
                 // $output .= $token[1];
                 $output .= str_repeat("\n", substr_count($token[1], "\n"));
             } elseif (T_WHITESPACE === $token[0]) {
                 // reduce wide spaces
                 $whitespace = preg_replace('{[ \\t]+}', ' ', $token[1]);
                 // normalize newlines to \n
                 $whitespace = preg_replace('{(?:\\r\\n|\\r|\\n)}', "\n", $whitespace);
                 // trim leading spaces
                 $whitespace = preg_replace('{\\n +}', "\n", $whitespace);
                 $output .= $whitespace;
             } else {
                 $output .= $token[1];
             }
         }
         return $output;
     }


########################################################################
########################################################################
/*
    C12 - 
    @seccion@ Alternas - Llamadas durante __procesos__ especificos __**no**__ criticos dentro de **todo** el programa °°Tener en cuenta todos los exportados °°Guardar logs 
	@Funcion@ parse
	Recorre diferentes elementos hasta obtener una cadena esperada
    °°Tener en cuenta todos los exportados°°
	Variables de entrada:

		ArregloComentarios - Arreglo que contiene todos los comentarios de un codigo fuente analizado
		@Var@ Edad - Edad del trabajador al que se desea liquidar vacaciones
		@Var@ Salario - Salario base del trabajador
	>>
	function PCO_ObtenerBloquesDocumentacionDEPRECATED_ONLYPHP($CodigoAnalizado="",$Lenguaje="PHP")
            {
                $tokens = token_get_all('Cadena de codigo analizada');
                $tokens = token_get_all(file_get_contents( __FILE__ ));
                $tokens = token_get_all(file_get_contents( "../inc/bootstrap/js/practico.js" ));
                return $tokens;
            }	
	
	<<
	
	
	@menu@ Detalles - www.google.com
*/
function parse($src, $interestedClass = null)
     {
         $this->tokens = token_get_all($src);
         $classes = $uses = array();
         $namespace = '';
         while ($token = $this->next()) {
             if (T_NAMESPACE === $token[0]) {
                 $namespace = $this->parseNamespace();
                 $uses = array();
             } elseif (T_CLASS === $token[0] || T_INTERFACE === $token[0]) {
                 if ('' !== $namespace) {
                     $class = $namespace . '\\' . $this->nextValue();
                 } else {
                     $class = $this->nextValue();
                 }
                 $classes[$class] = $uses;
                 if (null !== $interestedClass && $interestedClass === $class) {
                     return $classes;
                 }
             } elseif (T_USE === $token[0]) {
                 foreach ($this->parseUseStatement() as $useStatement) {
                     list($alias, $class) = $useStatement;
                     $uses[strtolower($alias)] = $class;
                 }
             }
         }
         return $classes;
     }

// Definicion de variables para almacenar resultado
$estado_final="0";
//Devuelve resultado final de las pruebas
return $estado_final;