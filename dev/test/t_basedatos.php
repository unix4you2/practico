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
    
		Title: t_basedatos
		Ubicacion *[dev/test/t_basedatos.php]*.  Pruebas para evaluacion de bases de datos al momento de instalacion
	*/

	// Definicion de variables para almacenar resultado
	$estado_final="0";
	include_once("dev/test/z_consola.php");
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