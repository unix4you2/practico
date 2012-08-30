<?php
			/*
				Title: Modulo objetos
				Ubicacion *[/core/objetos.php]*.  Archivo de funciones relacionadas con las operaciones de objetos generados por la herramienta
			*/
?>

<?php
/* ################################################################## */
if ($accion=="actualizar_practico")
	{
		/*
			Function: actualizar_practico
			Actualiza la plataforma manualmente o por medio de descargas de paquetes del repositorio
		*/
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
?>

<?php
/* ################################################################## */
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
				$version_actual = fgets($archivo, 1024);
				fclose($archivo);
			}
		else
			$mensaje_error.="<br>Error cargando la versi&oacute;n actual de Pr&aacute;ctico.  No se encuentra inc/version_actual.txt";

		//Libreria necesaria para extraer el archivo
		include("inc/pclzip.lib.php");
		$archivo = new PclZip($archivo_cargado);
		
		//Obtiene archivo compat.txt con el numero de version compatible del parche
		$lista_contenido = $archivo->extract(PCLZIP_OPT_BY_NAME, "compat.txt",PCLZIP_OPT_PATH, $carpeta_destino,PCLZIP_OPT_EXTRACT_AS_STRING);
		$version_compatible=$lista_contenido[0]['content'];
		if ($lista_contenido == 0 || $version_compatible=="")
			$mensaje_error.="<br>El archivo cargado parece no ser un paquete de actualizacion v&aacute;lido.  No se encuentra el archivo compat.txt"."<br>";

		//Obtiene archivo version.txt con la version que se aplicaria al sistema
		$lista_contenido = $archivo->extract(PCLZIP_OPT_BY_NAME, "version.txt",PCLZIP_OPT_PATH, $carpeta_destino,PCLZIP_OPT_EXTRACT_AS_STRING);
		$version_final=$lista_contenido[0]['content'];
		if ($lista_contenido == 0 || $version_final=="")
			$mensaje_error.="<br>El archivo cargado parece no ser un paquete de actualizacion v&aacute;lido.  No se encuentra el archivo version.txt"."<br>";

		//Obtiene archivo cambios.txt con la informacion de funcionalidades implementadas por el parche
		$lista_contenido = $archivo->extract(PCLZIP_OPT_BY_NAME, "cambios.txt",PCLZIP_OPT_PATH, $carpeta_destino,PCLZIP_OPT_EXTRACT_AS_STRING);
		$resumen_cambios=$lista_contenido[0]['content'];
		if ($lista_contenido == 0 || $resumen_cambios=="")
			$mensaje_error.="<br>El archivo cargado parece no ser un paquete de actualizacion v&aacute;lido.  No se encuentra el archivo cambios.txt"."<br>";

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
				$carpeta_destino='tmp/';
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
/* ################################################################## */
if ($accion=="aplicar_parche")
	{
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
				$carpeta_destino='tmp/';
				//Trata de renombrar los archivos y carpetas existentes en el parche y que pueden coincidir con unas en produccion para tener una copia
				if (($lista_contenido = $archivo->listContent()) == 0)
					echo "ERRROR: ".$archivo->errorInfo(true);
				for ($i=0; $i<sizeof($lista_contenido); $i++)
					@rename ($carpeta_destino.$lista_contenido[$i][filename], $carpeta_destino."bkp_".$fecha_operacion."_".$lista_contenido[$i][filename]);

				//Extrae el archivo
				if ($archivo->extract(PCLZIP_OPT_PATH, $carpeta_destino) == 0)
					echo "ERROR: ".$archivo->errorInfo(true)."<br>";
				echo '<center>
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
