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