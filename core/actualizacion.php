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
		abrir_ventana('Actualizacion de la plataforma','f2f2f2','');
?>
		<div align="center">
			<table border="0" width="100%"  cellspacing="0" cellpadding="0" align="center" class="TextosVentana"><tr height="100%">
				<td align=center height="100%">
					<img src="img/tango_package-x-generic.png" alt="" border=0>
					<form action="<?php echo $ArchivoSNT; ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="formato_archivo" value=".zip">
						<input type="hidden" name="MAX_FILE_SIZE" value="1024000">
						<input type="Hidden" name="accion" value="cargar_archivo">
						<input type="Hidden" name="carpeta" value="tmp">
						<br>
						<br>
						<b>Paquete/Parche de actualizacion manual: </b><br>Descargado desde la web (ZIP Max.1MB)
						<br>
						<input name="userfile" type="file">
						<br><br>
						<input type="submit" value="Cargar el paquete y actualizar"  class="BotonesCuidado">
					</form> 
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
	if ($accion=="guardar_adjuntar_documento")
		{
			echo '<div align="center">';
			abrir_ventana('Adjuntando documento a historia','','');
?>

		<div align="center">
		<DIV style="DISPLAY: block; OVERFLOW: auto; WIDTH: 100%; POSITION: relative;">
			
			<table border="0" width="400"  cellspacing="0" cellpadding="0" align="center"><tr height="100%"><td align=center height="100%">
			<br><br>
				<?php
				//datos del arhivo
				$fecha_operacion=date("Ymd");
				$documento=ereg_replace( '[^A-Za-z0-9]', '', $documento );
				$nombre_archivo = $_FILES['userfile']['name'];
				$tipo_archivo = $_FILES['userfile']['type'];
				$tamano_archivo = $_FILES['userfile']['size'];
				$nombre_archivo_temporal = $_FILES['userfile']['tmp_name'];
				$tamano_permitido=$MAX_FILE_SIZE/1000;
				//compruebo si las características del archivo son las que deseo
				//if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 100000))) {
				if ($tamano_archivo > $MAX_FILE_SIZE) {
					echo "<b>ATENCION:</b> El tamano del archivo no debe exceder los ".$tamano_permitido." Bytes. Proceso interrumpido.";
				}else{
					if (move_uploaded_file($nombre_archivo_temporal, "../".$carpeta."/".$prefijo.$documento.$posfijo.$formato_archivo))
						{
					   		echo "El archivo ha sido cargado correctamente.";
							$mysql_enlace = mysql_connect($Servidor, $UsuarioBD, $PasswordBD);
							mysql_select_db($BaseDatos, $mysql_enlace);
						// Lo actualiza en la cola cuando solo tiene espiro
						
						if ($carpeta=="spi" && $retirar_cola)
						  {
							 $fecha_operacion=date("Ymd");
							 $consultaup = "UPDATE cola_atencion SET att_visio='SI', att_bloqueo='NO' WHERE paciente='$documento' AND fecha_accion='$fecha_operacion'";
							 $resultadoup = mysql_query($consultaup,$mysql_enlace);
							// Lleva a auditoria
								$hora_operacion=date("His");
								$consulta = "INSERT INTO auditoria VALUES (0,'$Id_usuario','Retira $documento de cola Visio al adjuntar $carpeta marcando casilla.','$fecha_operacion','$hora_operacion')";
								$resultado = mysql_query($consulta,$mysql_enlace);
						  }	
						// Lleva a auditoria
							$hora_operacion=date("His");
							$consulta = "INSERT INTO auditoria VALUES (0,'$Id_usuario','Adjunta $carpeta al sistema para $documento','$fecha_operacion','$hora_operacion')";
							$resultado = mysql_query($consulta,$mysql_enlace);				
						}
					else
						{
					   		echo "<b>ATENCION:</b> Ocurrió algún error al subir el fichero.";
							$mysql_enlace = mysql_connect($Servidor, $UsuarioBD, $PasswordBD);
							mysql_select_db($BaseDatos, $mysql_enlace);
						// Lleva a auditoria
							$fecha_operacion=date("Ymd");
							$hora_operacion=date("His");
							$consulta = "INSERT INTO auditoria VALUES (0,'$Id_usuario','Adjunta $carpeta CON ERRORES al sistema para $documento','$fecha_operacion','$hora_operacion')";
							$resultado = mysql_query($consulta,$mysql_enlace);	
						}
				}
				?>
			<br><br>
				<form name="cancelar" action="<?php echo $ArchivoSNT; ?>" method="POST">
					<input type="Hidden" name="accion" value="Ver_menu">
					<input type="submit" value="Regresar">
				</form>
			</td></tr></table>
		</DIV>
		</div>
		<?php
				cerrar_ventana();
				 }
		?>
