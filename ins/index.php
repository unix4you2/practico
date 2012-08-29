<?php 
	$NombreRAD="Pr&aacute;ctico";
	$PlantillaActiva="nomo";
	$fecha_operacion=date("Ymd");
	$fecha_operacion_guiones=date("Y-m-d");
	$hora_operacion=date("His");
	$hora_operacion_puntos=date("H:i");
	$direccion_auditoria=$_SERVER ['REMOTE_ADDR'];

	// Recupera variables recibidas para su uso como globales (como si tuviese register_globals=on en php.ini)
	if (!ini_get('register_globals'))
	{
		$numero = count($_REQUEST);
		$tags = array_keys($_REQUEST);// obtiene los nombres de las varibles
		$valores = array_values($_REQUEST);// obtiene los valores de las varibles
		// crea las variables y les asigna el valor
		for($i=0;$i<$numero;$i++)
			{
				$$tags[$i]=$valores[$i];
			}
		// Agrega ademas las variables de sesion
		if (!empty($_SESSION)) extract($_SESSION);
		//foreach($HTTP_POST_VARS as $postvar => $postval){ ${$postvar} = $postval; }
		//foreach($HTTP_GET_VARS as $getvar => $getval){ ${$getvar} = $getval; }		  
	}

	function TextoAleatorio($longitud)
		{
			$plantilla = "23456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			for($i=0;$i<$longitud;$i++)
				{
					$clave .= $plantilla{rand(0,strlen($plantilla)-1)};
				}
			return $clave;
		}

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

	//Crea un archivo para probar acceso de escritura, luego lo elimina
	function temp_file($archivo)
		{
			$fp=fopen($archivo,"w");
			if ($fp==NULL)
				return false;
			fwrite($fp,"x",1);
			fclose($fp);
			if (!is_file($archivo))
				return false;
			unlink($archivo);
			return true;
		}
		
	// Determina si se puede escribir en un directorio
	function puede_escribirse($archivo,$tipo=1) // dir pass with /   1=si es carpeta,2=si es archivo
		{
			if ($tipo==1)
				{
					if (is_dir($archivo))
						{
							$archivo.="/temp";
							return temp_file($archivo);
						}
					else
						if(is_file($archivo))
							{
								return temp_file($archivo);
							}
						else
							return false;
				}
			if ($tipo==2)
				{
					return is_writable ($archivo);
				}
		}

	function informar_prueba_escritura($path_a_probar) // dir pass with / 
		{
			global $hay_error;
			echo "<li>Probando archivo/carpeta:&nbsp;&nbsp;&nbsp;".$path_a_probar."&nbsp;&nbsp;&nbsp;";
			if(puede_escribirse($path_a_probar))
				{
					echo '<b><font color="green">[OK]</font></b>';
				}
			else
				{
					echo  '<b><font color="red">[FALLO]</font></b>';
					$hay_error=1;
				}
		}

	include("../core/comunes.php");
	include("core/marco_arriba.php");
	
	//Determina paso actual de instalacion
	if(!isset($paso)) $paso=0;

	abrir_ventana('Proceso de instalaci&oacute;n - Paso '.$paso,'#B5B5B5','');
	include("paso_".$paso.".php");
	cerrar_ventana();

	include("core/marco_abajo.php");
?>

