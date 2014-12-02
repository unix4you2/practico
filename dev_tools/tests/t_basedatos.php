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

	//Divide los queries de un cadena
	function split_sql($sql)
		{
			$sql = trim($sql);
			$sql = ereg_replace("\n#[^\n]*\n", "\n", $sql);

			$buffer = array();
			$ret = array();
			$in_string = false;

			for($i=0; $i<strlen($sql)-1; $i++) {
				if($sql[$i] == ";" && !$in_string) {
					$ret[] = substr($sql, 0, $i);
					$sql = substr($sql, $i + 1);
					$i = 0;
				}

				if($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\") {
					$in_string = false;
				}
				elseif(!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\")) {
					$in_string = $sql[$i];
				}
				if(isset($buffer[1])) {
					$buffer[0] = $buffer[1];
				}
				$buffer[1] = $sql[$i];
			}

			if(!empty($sql)) {
				$ret[] = $sql;
			}
			return($ret);
		}

	// Definicion de variables para almacenar resultado
	$estado_final="0";
	$accion="";
	include_once("dev_tools/tests/t_bdconfig.php");
	include_once("core/conexiones.php");
	include_once("core/comunes.php");
	

	//PASO 1: Agrega las tablas y ejecuta consultas iniciales sobre la base de datos
		$total_ejecutadas=0;
		//Abre el archivo con los queries dependiendo del motor
		$RutaScriptSQL="ins/sql/practico.".$MotorBD;
		$archivo_consultas=fopen($RutaScriptSQL,"r");
		$total_consultas= fread($archivo_consultas,filesize($RutaScriptSQL));
		fclose($archivo_consultas);
		$arreglo_consultas = split_sql($total_consultas);
		foreach($arreglo_consultas as $consulta)
			{
				try
					{
						//Cambia el prefijo predeterminado en caso que haya sido personalizado en la instalacion
						$consulta=str_replace("core_",$TablasCore,$consulta);
						//Ejecuta el query
						$consulta_enviar = $ConexionPDO->prepare($consulta);
						$consulta_enviar->execute();
						$total_ejecutadas++;
					}
				catch( PDOException $ErrorPDO)
					{
						echo "SQL: ".$consulta." ==>> ".$ErrorPDO->getMessage();
						$hay_error=1;
					}
			}

	//PASO 2: Verifica las tablas creadas en la base de datos
		$resultado=consultar_tablas();
		while ($registro = $resultado->fetch())
			{
				$total_registros=ContarRegistros($registro["0"]);
				echo 'Tabla: '.$registro[0].'='.$total_registros.' registros. ';
			}
	

	if (@$hay_error)
		$estado_final=1;

	// Devuelve resultado final de las pruebas
	return $estado_final;
