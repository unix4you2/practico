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
		SELECT * FROM ".$TablasCore."tareascron WHERE codigo_tarea='$Tarea'
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
        			$RegistroTarea=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_tareascron." FROM ".$TablasCore."tareascron WHERE habilitado=1 AND codigo_tarea=?","$Tarea")->fetch();
        			//Si encuentra una tarea busca sus datos para ejecutarla
                    if ($RegistroTarea["id"]!="")
                        {
                            PCO_EvaluarCodigo($RegistroTarea["script_php"]);
                            //Lleva el historico de ejecucion
                            $HistoricoEjecucion=$RegistroTarea["historial_ejecucion"];
                            PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."tareascron SET historial_ejecucion=RIGHT(CONCAT('".$PCO_FechaOperacionGuiones." ".$PCO_HoraOperacionPuntos."\n',historial_ejecucion),1000) WHERE id=".$RegistroTarea["id"]);
                            //Lleva auditoria de la ejecucion
                            PCO_Auditar("Ejecucion tarea $Tarea","PCO.Cron");
                        }
			    }
	        die(); //Finaliza ejecucion despues de cualquier tarea
		}