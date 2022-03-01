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