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