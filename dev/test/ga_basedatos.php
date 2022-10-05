<?php
/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2012-2022
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
	====================================
	   Set de pruebas: CodeQL y Otros
	====================================
	DESCRIPCION:    Archivo de ejecucion de script para generacion de base de datos sobre el servidor
	CODIGO QL:      php /var/www/html/practico/dev/test/ga_basedatos.php
	                curl http://localhost/practico/dev/test/ga_basedatos.php

*/

    //Define variables requeridas (en ejeucion normal recibidas desde paso 3 del asistente)
	$mensaje_final="";
	$NombreCortoEmpresa="Practico";
	$NombreAplicacion="Framework";
	$VersionAplicacion="1.0";

	// Ejecuta los scripts de creacion de la BD si se requiere
	$total_ejecutadas=0;

			include_once("../../core/configuracion.php");
			include_once("../../core/conexiones.php");
			include_once("../../core/comunes.php");
			
			//Abre el archivo con los queries dependiendo del motor
			$RutaScriptSQL="../../ins/sql/practico.mysql";
			
	echo ">>> Ejecutando SCRIPTS en ".$RutaScriptSQL;
			
			$archivo_consultas=fopen($RutaScriptSQL,"r");
			$total_consultas= fread($archivo_consultas,filesize($RutaScriptSQL));
			fclose($archivo_consultas);
 
    echo ">>> Volcado de SCRIPTS: ".$total_consultas;

			$arreglo_consultas = PCO_SegmentarSQL($total_consultas);
			foreach($arreglo_consultas as $consulta)
				{
					try
						{
							//Cambia el prefijo predeterminado en caso que haya sido personalizado en la instalacion
							$consulta=str_replace("core_",$TablasCore,$consulta);
							//Cambia parametros iniciales de aplicacion
							$consulta=str_replace("PAR_NombreCortoEmpresa",$NombreCortoEmpresa,$consulta);
							$consulta=str_replace("PAR_NombreAplicacion",$NombreAplicacion,$consulta);
							$consulta=str_replace("PAR_VersionAplicacion",$VersionAplicacion,$consulta);

							//Ejecuta el query
							$consulta_enviar = $ConexionPDO->prepare($consulta);
							$consulta_enviar->execute();
							$total_ejecutadas++;
						}
					catch( PDOException $ErrorPDO)
						{
							echo "<hr><b><font color=red>".$MULTILANG_Atencion."!!!: </font>".$MULTILANG_ErrorScripts.". SQL: ".$consulta." ".$MULTILANG_Error.": ".$ErrorPDO->getMessage()."</b>";
							$hay_error=1; //usada globalmente durante el proceso de instalacion
						}
				}

			//Actualiza las llaves de paso de los usuarios insertados
			$LlaveEnMD5=hash("md5", $LlaveDePaso);
			$consulta="UPDATE ".$TablasCore."usuario SET llave_paso='".$LlaveEnMD5."' ";
			$consulta_enviar = $ConexionPDO->prepare($consulta);
			$consulta_enviar->execute();

    echo ">>> Total consultas ejecutadas: ".$total_ejecutadas;
	
	if ($hay_error)
		{
            echo ">>> Se encontraron ERRORES al ejecutar: ";
            exit(1); //Finaliza con error
		}
	else
	    exit(0);
?>
