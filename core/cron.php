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
		Title: Modulo tareas programadas
		Ubicacion *[/core/cron.php]*.  Archivo de funciones relacionadas con la administracion de tareas programadas y scripts publicos con acceso por codigo de seguridad
	*/



/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_EjecutarCron
	Ejecuta una tarea identificada por su codigo de seguridad interno

	Variables de entrada:

		Tarea - codigo alfanumerico que identifica la tarea a ejecutar

	(start code)
		SELECT * FROM core_tareascron WHERE codigo_tarea='$Tarea'
		CORRER contenido de script_php
	(end)

	Salida:
		Ejecucion de la tarea sobre el sistema
*/
	if ($PCO_Accion=="PCO_EjecutarCron")
		{
			if ($Tarea!="")
			    {
        			// Busca el registro de la tarea
        			$RegistroTarea=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_tareascron." FROM core_tareascron WHERE habilitado=1 AND codigo_tarea=?","$Tarea")->fetch();
        			//Si encuentra una tarea busca sus datos para ejecutarla
                    if ($RegistroTarea["id"]!="")
                        {
                            PCO_EvaluarCodigo($RegistroTarea["script_php"]);
                            //Lleva el historico de ejecucion
                            $HistoricoEjecucion=$RegistroTarea["historial_ejecucion"];
                            PCO_EjecutarSQLUnaria("UPDATE core_tareascron SET historial_ejecucion=RIGHT(CONCAT('".$PCO_FechaOperacionGuiones." ".$PCO_HoraOperacionPuntos."\n',historial_ejecucion),1000) WHERE id=".$RegistroTarea["id"]);
                            //Lleva auditoria de la ejecucion
                            PCO_Auditar("Ejecucion tarea $Tarea","PCO.Cron");
                        }
			    }
	        die(); //Finaliza ejecucion despues de cualquier tarea
		}