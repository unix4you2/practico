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

/* ##################################################################
   ################################################################## */


//Verifica si existe la tabla de usuarios
$consulta_existencia_tablas = "SELECT name FROM sqlite_master WHERE type IN ('table','view') AND name NOT LIKE 'sqlite_%' UNION ALL SELECT name FROM sqlite_temp_master WHERE type IN ('table','view') ORDER BY 1";
$tablas_en_motor=ejecutar_sql($consulta_existencia_tablas)->fetch();
//Si existe al menos una tabla entonces asume la existencia de la BD
if($tablas_en_motor["name"]!="")
	{
		//echo $tablas_en_motor["name"];
		
	}
else
	{
		//Crea la tabla basica de usuarios
		//ejecutar_sql_unaria($PCODER_TablaUsuariosDDL);
		//Inserta el primer registro de usuario admin y clave admin
		//ejecutar_sql_unaria("INSERT INTO $PCODER_TablaUsuarios VALUES ('admin','21232f297a57a5a743894a0e4a801fc3','usuario@dominio.com') ");
	}

//$registro_admin=ejecutar_sql("SELECT * FROM $PCODER_TablaUsuarios WHERE login='admin' ")->fetch();


