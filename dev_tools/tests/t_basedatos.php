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

	<pre>
	<b>Importante: Si usted esta visualizando este mensaje en su navegador,
	entonces PHP no esta instalado correctamente en su servidor web!</b>
	</pre>
	*/

	/*
		Title: t_basedatos
		Ubicacion *[dev_tools/tests/t_basedatos.php]*.  Pruebas para evaluacion de bases de datos al momento de instalacion
	*/

	// Definicion de variables para almacenar resultado
	$estado_final="0";
	include_once("dev_tools/tests/z_consola.php");
	include_once("dev_tools/tests/t_bdconfig.php");
	include_once("core/conexiones.php");
	include_once("core/comunes.php");
	$accion="";
	$hay_error=0;

    //Presenta estado sobre TravisCI
    PCOCLI_MensajeSimple(" EJECUTANDO PRUEBAS DE BASE DE DATOS ");

	//PASO 1: Agrega las tablas y ejecuta consultas iniciales sobre la base de datos
		$total_ejecutadas=0;
		//Abre el archivo con los queries dependiendo del motor
		$RutaScriptSQL="ins/sql/practico.".$MotorBD;
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
						echo "\n\rSQL: ".$consulta." ==>> ".$ErrorPDO->getMessage();
						$hay_error=1;
					}
			}

	//PASO 2: Verifica las tablas creadas en la base de datos
		echo '\n\r\n\r';
        PCOCLI_Mensaje("Resumen de operacion");
		$resultado=consultar_tablas();
        $total_tablas=0;
		while ($registro = $resultado->fetch())
			{
				$total_registros=ContarRegistros($registro["0"]);
				echo '\n\r  Tabla: '.$registro[0].'='.$total_registros.' registros. ';
                $total_tablas++;
			}
        echo '  TOTAL TABLAS: '.$total_tablas;

	if (@$hay_error==1)
		$estado_final=1;

	// Devuelve resultado final de las pruebas
	return $estado_final;