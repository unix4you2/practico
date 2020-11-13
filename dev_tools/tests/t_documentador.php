<?php
/*  C1 - 
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