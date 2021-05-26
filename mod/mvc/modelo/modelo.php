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
	*/


	// Funcion que pasa un resultado a una variable independiente para procesar luego
	function getAuditoria()
		{
			// Llama las funciones de BD definidas por Practico
			// No hay que definir conexiones ni validar excepciones pues Practico lo hace
			$resultado = PCO_EjecutarSQL("SELECT id,usuario_login,accion,fecha,hora FROM core_auditoria WHERE 1=1");

			// Define variable $registros para guardar los resultados
			$registros = array();

			// Recorre los registros agregandolos al arreglo
			while($registro_auditoria = $resultado->fetch())
				$registros[] = $registro_auditoria;

			// Retorna la variable con el resultado
			return $registros;
		}


/* ANOTACIONES IMPORTANTES:
===========================
Para garantizar portabilidad y compatibilidad puede usar otras variables de entorno de Practico
para que asi su modulo se adecue a otras instalaciones que pueden tener prefijos diferentes o
estructuras de bases de datos diferentes.

Asi por ejemplo, teniendo como base el archivo inc/practico/def_basedatos.php podria usar la variable
que describe la lista de campos de una tabla para garantizar su funcionamiento en cualqueir version asi:
	$resultado = PCO_EjecutarSQL("SELECT id,$ListaCamposSinID_auditoria FROM core_auditoria WHERE 1=1");

Tambien podria utilizar la variable que indica los prefijos configurados durante la instalacion
y hacer compatible su modulo o aplicacion con diferentes configuraciones de la siguiente manera:
	$resultado = PCO_EjecutarSQL("SELECT id,$ListaCamposSinID_auditoria FROM ".$TablasCore."auditoria WHERE 1=1");

El query o consulta anterior es equivalente al definido en la linea 27 de este archivo.  Solo que mas compatible
*/