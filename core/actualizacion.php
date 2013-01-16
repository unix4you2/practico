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
				Title: Modulo actualizar
				Ubicacion *[/core/actualizacion.php]*.  Archivo de funciones para el proceso de actualizacion de la plataforma mediante parches incrementales
			*/
?>

<?php
/* ################################################################## */
/* ################################################################## */
/*
	Function: actualizar_practico
	Presenta el paso 1 del asistente de actualizacion de Practico para la carga del archivo con el parche
*/
if ($accion=="actualizar_practico")
	{
		echo "<a href='javascript:abrir_ventana_popup(\"http://www.youtube.com/embed/OxheOe-o17s\",\"VideoTutorial\",\"toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, width=640, height=480\");'><img src='img/icono_screencast.png' alt='ScreenCast-VideoTutorial'></a>";
		abrir_ventana('Actualizacion de la plataforma','f2f2f2','600');
		mensaje('ATENCION: Lea esta informaci&oacute;n antes de continuar','Pr&aacute;ctico le ofrece este mecanismo para aplicar actualizaciones autom&aacute;ticas a su sistema mediante parches incrementales descargados desde la web oficial del proyecto o mediante el asistente para b&uacute;squeda de actualizaciones, sin embargo, antes de aplicar cualquier parche es fundamental que:<br><br><li>Haga una copia de seguridad de sus bases de datos. Algunas actualizaciones puede que requieran la modificaci&oacute;n de estructuras sobre la base de datos que pueden afectar la informaci&oacute;n.<li>Haga una copia de seguridad de sus archivos o carpeta de Pr&aacute;ctico.<li>LIMPIE la carpeta de trabajo de practico (ruta  tmp/), ser&aacute; utilizada por el asistente para descomprimir y analizar los archivos.','100%','warning_icon.png','TextosVentana');
?>
		<div align="center">
			<br>
			<img src="img/tango_package-x-generic.png" alt="" border=0 align=absmiddle><b> Actualmente usted utiliza la versi&oacute;n: <?php include("inc/version_actual.txt"); ?> de Pr&aacute;ctico</b><br>
			<br><hr>
			<table border="0" width="100%"  cellspacing="0" cellpadding="0" align="center" class="TextosVentana"><tr height="100%">
				<td align=center height="100%">
					<form action="<?php echo $ArchivoCORE; ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="extension_archivo" value=".zip">
						<input type="hidden" name="MAX_FILE_SIZE" value="8192000">
						<input type="Hidden" name="accion" value="cargar_archivo">
						<input type="Hidden" name="siguiente_accion" value="analizar_parche">
						<input type="Hidden" name="texto_boton_siguiente" value="Continuar con la revisi&oacute;n >>>">
						<input type="Hidden" name="carpeta" value="tmp">
						<b>Paquete/Parche de actualizacion manual: </b><br>
						<input name="archivo" type="file" class="CampoTexto">
						<br><br>
						<input type="submit" value="Cargar el archivo"  class="BotonesCuidado"> (Archivos previos ser&aacute;n sobreescritos)
					</form> 
					<hr>
					<br>
				</td>
			</tr></table>
		</div>
<?php
		abrir_barra_estado();
		echo '<input type="Button" onclick="document.core_ver_menu.submit()" value="<< Cancelar" class="BotonesEstado">';
		cerrar_barra_estado();
		cerrar_ventana();
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: cargar_archivo
	Toma el archivo entregado por el paso 1 del asistente de actualizacion y lo carga sobre la ruta relativa a la instalacion de Practico /tmp para ser analizado.

	Variables de entrada:

		archivo - Archivo recibido mediante el formulario Multipart del paso 1

	Salida:
		Archivo cargado sobre /tmp o mensaje de error en caso de fallo

	Ver tambien:
		<actualizar_practico>
*/
if ($accion=="cargar_archivo")
	{
		abrir_ventana('Adjuntando un nuevo archivo al sistema','f2f2f2','');
		echo '<table border="0" width="400"  cellspacing="0" cellpadding="0" align="center" class="TextosVentana"><tr height="100%"><td align=center height="100%">';

		//datos del arhivo
		$mensaje_error="";
		$nombre_archivo = $_FILES['archivo']['name'];
		$tipo_archivo = $_FILES['archivo']['type'];
		$tamano_archivo = $_FILES['archivo']['size'];
		$nombre_archivo_temporal = $_FILES['archivo']['tmp_name'];
		$tamano_permitido=$MAX_FILE_SIZE/1000;

		//Comprueba si las características del archivo son las deseadas
		if ($tamano_archivo > $MAX_FILE_SIZE)
			$mensaje_error.="<b>ATENCION:</b> El tamano del archivo no debe exceder los ".$tamano_permitido." Bytes. Proceso interrumpido.";

		if (strpos($nombre_archivo, $extension_archivo)===FALSE)
			$mensaje_error.="<b>ATENCION:</b> El formato del archivo cargado no es el solicitado. Proceso interrumpido.";

		// Solo intenta la carga del archivo si cumple las condiciones
		if ($mensaje_error=="")
			if (!move_uploaded_file($nombre_archivo_temporal, $carpeta."/".$nombre_archivo))
				$mensaje_error.="<b>ATENCION:</b>  Ocurri&oacute; un error desconocido al cargar el archivo ".$nombre_archivo." en la ruta ".$carpeta."/. Contacte con su administrador de sistemas.";

		if ($mensaje_error=="")
			{				
				echo '<br><br><img src="img/icn_11.gif" border=0 align="absmiddle"> El archivo ha sido cargado correctamente.<br><br>
					<form action="'.$ArchivoCORE.'" method="post">
						<input type="Hidden" name="archivo_cargado" value="'.$carpeta.'/'.$nombre_archivo.'">
						<input type="Hidden" name="accion" value="'.$siguiente_accion.'">
						<input type="submit" value="'.$texto_boton_siguiente.'"  class="BotonesCuidado">
					</form>';
				// Lleva a auditoria
				ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Carga archivo en carpeta $carpeta - $nombre_archivo','$fecha_operacion','$hora_operacion')");
			}
		else
			{
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="Ver_menu">
					<input type="Hidden" name="error_titulo" value="Problema en la carga del archivo">
					<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
		echo '</td></tr></table><br>';
		abrir_barra_estado();
		echo '<input type="Button" onclick="document.core_ver_menu.submit()" value="<< Volver al escritorio" class="BotonesEstado">';
		cerrar_barra_estado();
		cerrar_ventana();
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: analizar_parche
	Revisa el archivo cargado sobre /tmp para validar si se trata de un parche con una estructura valida para Practico y muestra ademas el resumen de cambios que implementara.

	Variables de entrada:

		archivo_cargado - Ruta absoluta hacia el archivo cargado en el paso anterior del asistente

	Salida:
		Analisis del archivo y detalles del parche

	Ver tambien:
		<actualizar_practico>
*/
if ($accion=="analizar_parche")
	{
		abrir_ventana('Descomprimiendo archivo '.$archivo_cargado,'f2f2f2','700');
		echo '<table border="0" width="100%"  cellspacing="15" cellpadding="0" align="center" class="TextosVentana"><tr height="100%"><td align=left height="100%">
		<u>Contenido del parche:</u><br>';
		$mensaje_error="";

		//Lee la version actualmente instalada de practico
		$archivo_origen="inc/version_actual.txt";
		$archivo = fopen($archivo_origen, "r");
		if ($archivo)
			{
				$version_actual = trim(fgets($archivo, 1024));
				fclose($archivo);
			}
		else
			$mensaje_error.="<br>Error cargando la versi&oacute;n actual de Pr&aacute;ctico.  No se encuentra inc/version_actual.txt";

		//Libreria necesaria para extraer el archivo
		include("inc/pclzip.lib.php");
		$archivo = new PclZip($archivo_cargado);
		
		//Obtiene archivo compat.txt con el numero de version compatible del parche
		$lista_contenido = $archivo->extract(PCLZIP_OPT_BY_NAME, "tmp/par_compat.txt",PCLZIP_OPT_PATH, $carpeta_destino,PCLZIP_OPT_EXTRACT_AS_STRING);
		$version_compatible=trim($lista_contenido[0]['content']);
		if ($lista_contenido == 0 || $version_compatible=="")
			$mensaje_error.="<br>El archivo cargado parece no ser un paquete de actualizacion v&aacute;lido.  No se encuentra el archivo tmp/par_compat.txt"."<br>";

		//Obtiene archivo version.txt con la version que se aplicaria al sistema
		$lista_contenido = $archivo->extract(PCLZIP_OPT_BY_NAME, "inc/version_actual.txt",PCLZIP_OPT_PATH, $carpeta_destino,PCLZIP_OPT_EXTRACT_AS_STRING);
		$version_final=trim($lista_contenido[0]['content']);
		if ($lista_contenido == 0 || $version_final=="")
			$mensaje_error.="<br>El archivo cargado parece no ser un paquete de actualizacion v&aacute;lido.  No se encuentra el archivo inc/version_actual.txt"."<br>";

		//Obtiene archivo cambios.txt con la informacion de funcionalidades implementadas por el parche
		$lista_contenido = $archivo->extract(PCLZIP_OPT_BY_NAME, "tmp/par_cambios.txt",PCLZIP_OPT_PATH, $carpeta_destino,PCLZIP_OPT_EXTRACT_AS_STRING);
		$resumen_cambios=$lista_contenido[0]['content'];
		if ($lista_contenido == 0 || $resumen_cambios=="")
			$mensaje_error.="<br>El archivo cargado parece no ser un paquete de actualizacion v&aacute;lido.  No se encuentra el archivo tmp/par_cambios.txt"."<br>";

		//Obtiene archivo sql.txt con las instrucciones a ejecutar
		$lista_contenido = $archivo->extract(PCLZIP_OPT_BY_NAME, "tmp/par_sql.txt",PCLZIP_OPT_PATH, $carpeta_destino,PCLZIP_OPT_EXTRACT_AS_STRING);
		$resumen_sql=$lista_contenido[0]['content'];
		if ($lista_contenido == 0)
			$mensaje_error.="<br>El archivo cargado parece no ser un paquete de actualizacion v&aacute;lido.  No se encuentra el archivo tmp/par_sql.txt"."<br>";

		//Verifica que no sea un parche mas viejo que la version actual
		if ($mensaje_error=="")
			if ($version_final <= $version_actual)
				$mensaje_error.="<br>El archivo de parche cargado hace referencia a una actualizaci&oacute;n mas antigua que su version actual.";

		//Verifica si la version actualmente instalada es la requerida por el parche
		if ($mensaje_error=="")
			if ($version_compatible != $version_actual)
				$mensaje_error.="<br>El archivo de parche cargado requiere la version ".$version_compatible." y usted cuenta con la version ".$version_actual."<br>Debe aplicar primero los parches incrementales requeridos hasta elevar su sistema a la versi&oacute;n minima que necesita el parche.";

		if ($mensaje_error=="")
			{
				//Presenta contenido del archivo
				if (($lista_contenido = $archivo->listContent()) == 0)
					echo "ERROR: ".$archivo->errorInfo(true);
				echo '<OL>';
				for ($i=0; $i<sizeof($lista_contenido); $i++)
					echo "<li><font color=blue>".$lista_contenido[$i][filename]."</font> ... Integridad: <b>".$lista_contenido[$i][status]."</b>";  /*Propiedades adicionales:  filename, stored_filename, size, compressed_size, mtime, comment, folder, index, status*/
				echo '</OL>';
				echo '<center>
				<hr><b>Resumen de los cambios y funcionalidades suministradas por el parche</b>:<br>
				<textarea cols="100" rows="7" class="AreaTexto">'.$resumen_cambios.'</textarea>
				<hr><b>Instrucciones a ser ejecutadas sobre las tablas de Pr&aacute;ctico</b>:<br>
				<textarea cols="100" rows="7" class="AreaTexto">'.$resumen_sql.'</textarea>
				<br><br><b>PROCESO DE REVISION FINALIZADO.<br>
				 <font color=blue>- Al aplicar los archivos listados arriba se actualizar&aacute; su sistema a la versi&oacute;n '.$version_final.' -</font></b><br>
				 <br><br>
					<form action="'.$ArchivoCORE.'" method="post">
						<input type="Hidden" name="accion" value="aplicar_parche">
						<input type="Hidden" name="version_actual" value="'.$version_actual.'">
						<input type="Hidden" name="version_final" value="'.$version_final.'">
						<input type="Hidden" name="archivo_cargado" value="'.$archivo_cargado.'">
						<input type="submit" value="Continuar aplicando el parche"  class="BotonesCuidado">
					</form>';
				// Lleva a auditoria
				ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Analiza archivo en carpeta $carpeta - $nombre_archivo','$fecha_operacion','$hora_operacion')");
			}
		else
			{
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="Ver_menu">
					<input type="Hidden" name="error_titulo" value="Archivo con estructura, tipo o versi&oacute;n no compatible">
					<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
		echo '</center></td></tr></table>';
		abrir_barra_estado();
		echo '<input type="Button" onclick="document.core_ver_menu.submit()" value="<< Volver al escritorio" class="BotonesEstado">';
		cerrar_barra_estado();
		cerrar_ventana();
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: aplicar_parche
	Hace una copia de seguridad del sistema actual y toma el archivo entregado por el paso 2 del asistente de actualizacion y ejecuta todos los scripts encontrados en el, ademas de copiar los archivos correspondientes.

	Variables de entrada:

		archivo_cargado - Ruta absoluta hacia el archivo cargado en el paso anterior del asistente

	Salida:
		Actualizacion de Practico ejecutada, nueva version del aplicativo disponible

	Ver tambien:
		<actualizar_practico>
*/
if ($accion=="aplicar_parche")
	{
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

		abrir_ventana('Aplicando actualizacion desde '.$archivo_cargado,'f2f2f2','700');
		echo '<table border="0" width="100%"  cellspacing="15" cellpadding="0" align="center" class="TextosVentana"><tr height="100%"><td align=left height="100%">
		<u>Actualizando desde version '.$version_actual.' hacia '.$version_final.':</u><br><br>';
		$mensaje_error="";

		//VERIFICAR PERMISOS DE ESCRITURA EN CADA RUTA DEL PARCHE

		//Libreria necesaria para extraer el archivo
		include("inc/pclzip.lib.php");
		$archivo = new PclZip($archivo_cargado);
		
		if ($mensaje_error=="")
			{				
				//Hace una copia de seguridad de los archivos a reemplazar por el parche
				$archivo_destino_backup_app="bkp/bkp_".$fecha_operacion."-".date("Hi")."_app.zip";
				$archivo_destino_backup_bdd="bkp/bkp_".$fecha_operacion."-".date("Hi")."_bdd.gz";
				$archivo_backup = new PclZip($archivo_destino_backup_app);

				if (($lista_contenido = $archivo->listContent()) == 0)
					echo "Error cargando lista de archivos para backup: ".$archivo->errorInfo(true);

				$lista_archivos_a_comprimir="";
				for ($i=0; $i<sizeof($lista_contenido); $i++)
					{
						//Si el archivo destino existe entonces lo agrega a la lista de archivos del backup
						if (file_exists($lista_contenido[$i][filename]) && !is_dir($lista_contenido[$i][filename]))
							{
								$lista_archivos_a_comprimir.=$lista_contenido[$i][filename].",";
								echo "<li> Haciendo backup de: ".$lista_contenido[$i][filename];
							}
					}
				$lista_archivos_a_comprimir=substr($lista_archivos_a_comprimir, 0, strlen($lista_archivos_a_comprimir)-1);
				$lista_archivos_backup = $archivo_backup->create($lista_archivos_a_comprimir);				

				//Hace copia de seguridad de la base de datos
				include("core/backups.php");
				$objeto_backup_db = new DBBackup(array(
					'driver' => $MotorBD,
					'host' => $ServidorBD,
					'user' => $UsuarioBD,
					'password' => $PasswordBD,
					'database' => $BaseDatos,
					'prefix' => $TablasCore
				));
				$resultado_backup = $objeto_backup_db->backup();
				if(!$resultado_backup['error'])
					{
						// Un echo nl2br($backup['msg']); podría mostrar contenido
						// Por ahora, comprime el archivo resultante y lo guarda.
						$resultado_backup_comprimido = gzencode($resultado_backup['msg'], 9);
						$puntero_archivo_destino_backup_bdd = fopen($archivo_destino_backup_bdd, "w");
						fwrite($puntero_archivo_destino_backup_bdd, $resultado_backup_comprimido);
						fclose($puntero_archivo_destino_backup_bdd);
					}
				else
					{
						echo '<hr><b>Ha ocurrido un error durante la copia de seguridad de la base de datos.</b>';
					}

				//Descomprime el archivo de parche
				$carpeta_destino='';
				//Extrae el archivo
				if ($archivo->extract(PCLZIP_OPT_PATH, $carpeta_destino, PCLZIP_OPT_REPLACE_NEWER) == 0)
					echo "ERROR: ".$archivo->errorInfo(true)."<br>";

				//Abre el archivo con los queries
				$RutaScriptSQL="tmp/par_sql.txt";
				$archivo_consultas=fopen($RutaScriptSQL,"r");
				$total_consultas= fread($archivo_consultas,filesize($RutaScriptSQL));
				fclose($archivo_consultas);

				$arreglo_consultas = split_sql($total_consultas);
				foreach($arreglo_consultas as $consulta)
					{
						try
							{
								//Cambia el prefijo predeterminado en caso que haya sido personalizado en la instalacion
								$consulta=str_replace("Core_",$TablasCore,$consulta);
								//Ejecuta el query
								$consulta_enviar = $ConexionPDO->prepare($consulta);
								$estado_ok = $consulta_enviar->execute();
							}
						catch( PDOException $ErrorPDO)
							{
								echo "<hr><b><font color=red>ATENCION: </font>Error ejecutando la consulta</b> $consulta <b>sobre la base de datos. DETALLES: ".$ErrorPDO->getMessage()."</b>";
								$hay_error=1; //usada globalmente durante el proceso de instalacion
							}
					}

				echo '<center>
				<hr><font color=blue>- Si alguno de los archivos no ha podido ser escrito por este asistente por problemas de permisos el parche tambien puede ser aplicado manualmente por el administrador o escribiendo solamente los archivos faltantes. -</font></b>
				<hr>
				<b>PROCESO FINALIZADO<br>';
				// Lleva a auditoria
				ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Actualiza version de plataforma desde $version_actual hacia $version_final','$fecha_operacion','$hora_operacion')");
			}
		else
			{
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="Ver_menu">
					<input type="Hidden" name="error_titulo" value="Archivo con estructura o tipo no compatible">
					<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
		echo '</center></td></tr></table>';
		abrir_barra_estado();
		echo '<input type="Button" onclick="document.core_ver_menu.submit()" value="<< Volver al escritorio" class="BotonesEstado">';
		cerrar_barra_estado();
		cerrar_ventana();
	}
?>
