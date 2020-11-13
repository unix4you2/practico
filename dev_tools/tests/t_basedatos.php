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
    
		Title: t_basedatos
		Ubicacion *[dev_tools/tests/t_basedatos.php]*.  Pruebas para evaluacion de bases de datos al momento de instalacion
	*/

	// Definicion de variables para almacenar resultado
	$estado_final="0";
	include_once("dev_tools/tests/z_consola.php");
	include_once("core/comunes.php");
	$accion="";
	$hay_error=0;

    //Define un arreglo con los motores a probar
    $MotoresPruebas=array("mysql"); // Deprecated: "pgsql", "sqlite"

    //Recorre el arreglo de motores y ejecuta el script en cada uno
    foreach ($MotoresPruebas as $MotorEvaluado)
        {
            //Presenta estado sobre TravisCI
            PCOCLI_MensajeSimple(" Pruebas sobre motor ".$MotorEvaluado);
            if ($MotorEvaluado=="mysql")
                {
                    $ServidorBD='127.0.0.1';
                    $BaseDatos='practico';
                    $UsuarioBD='root';
                    $PasswordBD='';
                    $MotorBD=$MotorEvaluado;
                    $PuertoBD='';
                    $TablasCore='core_';
                    $TablasApp='app_';
                    $ConsultaVersionMotor="SELECT VERSION()";
                }
            if ($MotorEvaluado=="pgsql")
                {
                    $ServidorBD='127.0.0.1';
                    $BaseDatos='practico';
                    $UsuarioBD='postgres';
                    $PasswordBD='';
                    $MotorBD=$MotorEvaluado;
                    $PuertoBD='';
                    $TablasCore='core_';
                    $TablasApp='app_';
                    $ConsultaVersionMotor="SELECT version()";
                }
            if ($MotorEvaluado=="sqlite")
                {
                    //$ServidorBD='127.0.0.1';
                    $BaseDatos='practico.db';
                    //$UsuarioBD='root';
                    //$PasswordBD='';
                    $MotorBD=$MotorEvaluado;
                    //$PuertoBD='';
                    $TablasCore='core_';
                    $TablasApp='app_';
                    $ConsultaVersionMotor="select sqlite_version()";
                }            //Recarga archivo de conexiones para reescribir variables de conexion y redefine la misma justo despues segun el motor
            include_once("core/conexiones.php");
            $ConexionPDO=PCO_NuevaConexionBD($MotorBD,$PuertoBD,$BaseDatos,$ServidorBD,$UsuarioBD,$PasswordBD);

            $RegistroVersionMotor=PCO_EjecutarSQL($ConsultaVersionMotor)->fetch();
            echo "\n\r";
            echo "  VERSION: ".$RegistroVersionMotor[0];


        	//PASO 1: Agrega las tablas y ejecuta consultas iniciales sobre la base de datos
        		$total_ejecutadas=0;
        		//Abre el archivo con los queries dependiendo del motor
        		$RutaScriptSQL="ins/sql/practico.".$MotorEvaluado;
        		
        		$archivo_consultas=fopen($RutaScriptSQL,"r");
        		$total_consultas= fread($archivo_consultas,filesize($RutaScriptSQL));
        		fclose($archivo_consultas);
        		$arreglo_consultas = PCO_SegmentarSQL($total_consultas);
        		foreach($arreglo_consultas as $consulta)
        			{
        				try
        					{
        						//Ejecuta el query
        						$consulta_enviar = $ConexionPDO->prepare($consulta);
        						$consulta_enviar->execute();
        						$total_ejecutadas++;
        					}
        				catch( PDOException $ErrorPDO)
        					{
        					    PCOCLI_Mensaje("ERROR DURANTE EJECUCION SQL:");
        					    echo "\n\r";
        						echo "SQL EJECUTADO: ".$consulta." ==>> ".$ErrorPDO->getMessage();
        						$hay_error=1;
        					}
        			}
        
        	//PASO 2: Verifica las tablas creadas en la base de datos
                PCOCLI_Mensaje("RESUMEN DE OPERACIONES MOTOR: ".$MotorEvaluado);
        		$resultado=PCO_ConsultarTablas();
                $total_tablas=0;
        		while ($registro = $resultado->fetch())
        			{
        				$total_registros=PCO_ContarRegistrosTabla($registro["0"]);
        				echo "\n\r";
        				echo 'Tabla: '.$registro[0].'='.$total_registros.' registros. ';
                        $total_tablas++;
        			}
                echo '  TOTAL TABLAS: '.$total_tablas;
        
        	if (@$hay_error==1)
        		$estado_final=1;
        }

	// Devuelve resultado final de las pruebas
	exit($estado_final);