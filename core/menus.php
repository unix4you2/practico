<?php
			/*
				Title: Modulo menues
				Ubicacion *[/core/menus.php]*.  Archivo de funciones relacionadas con la administracion de opciones de menu.
			*/
?>

<?php
			/*
				Section: Operaciones basicas de administracion
				Funciones asociadas al mantenimiento de menues en el sistema.
			*/
?>

<?php
/* ################################################################## */
/*
	Function: actualizar_menu
	Cambia el registro asociado a un menu de la aplicacion

	Variables de entrada:

		id - ID del menu que se desea cambiarse

		(start code)
			UPDATE ".$TablasCore."menu SET formulario='$formulario', accion='$accion_int', columna='$columna', peso=$peso, texto='$texto', seccion='$seccion', imagen='$imagen', padre=$padre, url='$url' WHERE id=$id
		(end)

	Salida:
		Registro de menu actualizado

	Ver tambien:

		<detalles_menu>
*/
if ($accion=="actualizar_menu")
	{
		// Actualiza los datos del item
		ejecutar_sql_unaria("UPDATE ".$TablasCore."menu SET texto='$texto',padre='$padre',peso='$peso',url='$url',posible_clic='$posible_clic',tipo_comando='$tipo_comando',comando='$comando',nivel_usuario='$nivel_usuario',columna='$columna',posible_arriba='$posible_arriba',posible_centro='$posible_centro',posible_escritorio='$posible_escritorio',seccion='$seccion',imagen='$imagen' WHERE id=$id");
		// Lleva a auditoria
		ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Actualiza menu item $texto c&oacute;digo $id','$fecha_operacion','$hora_operacion')");
		echo '<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
	}
/* ################################################################## */
/*
	Function: detalles_menu
	Presenta la ficha de edicion para el registro asociado a un menu de la aplicacion

	Variables de entrada:

		id - ID del menu que se desea cambiarse

		(start code)
			SELECT * FROM ".$TablasCore."menu WHERE id=$id
		(end)

	Ver tambien:

		<actualizar_menu>
*/
if ($accion=="detalles_menu")
	{
		echo '<div align="center">';
		abrir_ventana('Edici&oacute;n del item de menu','f2f2f2','');

		// Busca detalles del item
		$resultado=ejecutar_sql("SELECT * FROM ".$TablasCore."menu WHERE id=$id");
		$registro = $resultado->fetch();
		?>

		<div align="center">
		<DIV style="DISPLAY: block; OVERFLOW: auto; WIDTH: 100%; POSITION: relative;">
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="hidden" name="accion" value="actualizar_menu">
			<input type="hidden" name="id" value="<?php echo $registro["id"]; ?>">
			<br><font face="" size="3" color="Navy"><b>Propiedades del item</b></font>

			<table border="0" cellspacing="10" cellpadding="0" class="TextosVentana"><tr>
				<td valign="TOP" align=center>
					[CONFIGURACION DE APARIENCIA Y UBICACION]
					<table border="0" cellspacing="5" cellpadding="0" align="CENTER" class="TextosVentana">
						<tr>
							<td align="RIGHT"><b>ID</b></td><td width="10"></td>
							<td>
									<?php echo $registro["id"]; ?>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Texto</b></td><td width="10"></td>
							<td><input value="<?php echo $registro["texto"]; ?>" class="CampoTexto" type="text" name="texto" size="40" maxlength="250"></td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Padre</b></td><td width="10"></td>
							<td>
									<select name="padre" class="Combos" >
										<option value="0">Ninguno</option>
										<?php
											$resultado_padre=ejecutar_sql("SELECT * FROM ".$TablasCore."menu WHERE 1 ORDER BY texto");
											while($registro_padre = $resultado_padre->fetch())
												{
													if ($registro["padre"]==$registro_padre["id"])
														echo '<option value="'.$registro_padre["id"].'" selected>'.$registro_padre["texto"].'</option>';
													else
														echo '<option value="'.$registro_padre["id"].'">'.$registro_padre["texto"].'</option>';
												}
										?>
									</select>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Columna</b></td><td width="10"></td>
							<td>
									<select name="columna" class="Combos" >
											<?php
													for ($i=1;$i<=9;$i++)
														{
															if ($registro["columna"]==$i)
																echo '<option value="'.$i.'" selected>'.$i.'</option>';
															else
																echo '<option value="'.$i.'">'.$i.'</option>';
														}
											?>
									</select> (si aplica)
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Peso</b></td><td width="10"></td>
							<td>
									<select name="peso" class="Combos" >
											<?php
													for ($i=1;$i<=100;$i++)
														{
															if ($registro["peso"]==$i)
																echo '<option value="'.$i.'" selected>'.$i.'</option>';
															else
																echo '<option value="'.$i.'">'.$i.'</option>';
														}
											?>
									</select>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Posible arriba?</b></td><td width="10"></td>
							<td>
									<select  name="posible_arriba" class="Combos" >
										<option value="0">No</option>
										<option value="1" <?php if ($registro["posible_arriba"]) echo 'selected'; ?> >Si</option>
									</select>
									<a href="#" title="Ubicaci&oacute;n de esta opci&oacute;n" name="Se debe habilitar esta opci&oacute;n para ser desplegada en la barra de menu superior-horizontal?"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Posible escritorio?</b></td><td width="10"></td>
							<td>
									<select  name="posible_escritorio" class="Combos" >
										<option value="0">No</option>
										<option value="1" <?php if ($registro["posible_escritorio"]) echo 'selected'; ?> >Si</option>
									</select>
									<a href="#" title="Ubicaci&oacute;n de esta opci&oacute;n" name="Se debe habilitar esta opci&oacute;n para ser desplegada como un icono en el escritorio del usuario?"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Posible en el centro?</b></td><td width="10"></td>
							<td>
									<select  name="posible_centro" class="Combos" >
										<option value="0">No</option>
										<option value="1" <?php if ($registro["posible_centro"]) echo 'selected'; ?> >Si</option>
									</select>
									<a href="#" title="Ubicaci&oacute;n de esta opci&oacute;n" name="Se debe habilitar esta opci&oacute;n para ser desplegada en la parte central del aplicativo, dentro de ventanas clasificadas/agrupadas por el valor definido en el campo Seccion?"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Secci&oacute;n</b></td><td width="10"></td>
							<td><input value="<?php echo $registro["seccion"]; ?>" class="CampoTexto" type="text" name="seccion" size="40" maxlength="250" class="texto_01"></td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Imagen</b></td><td width="10"></td>
							<td><input value="<?php echo $registro["imagen"]; ?>" class="CampoTexto" type="text" name="imagen" size="40" maxlength="250" class="texto_01"></td>
						</tr>
					</table>
				</td>
				<td align="CENTER" valign="TOP">
					[CONFIGURACION DE COMANDOS Y ACCIONES]
					<table border="0" cellspacing="5" cellpadding="0" align="CENTER"  class="TextosVentana" style="font-family: Verdana, Tahoma, Arial; font-size: 10px; margin-top: 10px; margin-right: 10px; margin-left: 10px; margin-bottom: 10px;" class="link_menu">
						<tr>
							<td align="RIGHT"><b>Posible hacer clic?</b></td><td width="10"></td>
							<td>
									<select  name="posible_clic" class="Combos" >
										<option value="0">No</option>
										<option value="1" <?php if ($registro["posible_clic"]) echo 'selected'; ?> >Si</option>
									</select>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>URL est&aacute;tica</b></td><td width="10"></td>
							<td><input value="<?php echo $registro["url"]; ?>"  class="CampoTexto" type="text" name="url" size="35" maxlength="250" class="texto_01">
								<a href="#" title="Llevar a una URL o ejecutar un javascript?" name="ingrese una URL completa o un comando javascript definido por javascript:comando para ser reemplazadas dentro de un HREF de un ancla generada alrededor del objeto."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Tipo de comando</b></td><td width="10"></td>
							<td>
									<select name="tipo_comando" class="Combos" >
										<option value="Interno" <?php if ($registro["tipo_comando"]=="Interno") echo 'selected'; ?> >Interno</option>
										<option value="Personal" <?php if ($registro["tipo_comando"]=="Personal") echo 'selected'; ?> >Personal</option>
										<option value="Objeto" <?php if ($registro["tipo_comando"]=="Objeto") echo 'selected'; ?> >Objeto</option>
									</select>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Acci&oacute;n interna/comando/objeto</b></td><td width="10"></td>
							<td><input value="<?php echo $registro["comando"]; ?>"  class="CampoTexto" type="text" name="comando" size="30" maxlength="250" class="texto_01">
								<a href="#" title="Indique uno de tres valores posibles as&iacute;" name="1) EL OBJETO dise&ntilde;ado en Pr&aacute;ctico y al cual se quiere enlazar la opci&oacute;n mediante el formato frm:XXX &oacute; inf:XXX donde debe reemplazar XXX por el identificador &uacute;nico del objeto que se obtiene despu&eacute;s de haber sido creado (ID del formulario o del informe),  2) LA ACCION INTERNA de Pr&aacute;ctico hacia la cual debe ser direccionado el usuario (normalmente se encuentra en la parte inferior de la pantalla), &oacute; 3) COMANDO PERSONALIZADO: La secuencia de comandos definida/programada por el usuario y existente en el archivo personalizadas.php"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT" valign="TOP"><strong>Nivel de usuario</strong></td><td width="10"></td>
							<td>
								<select  name="nivel_usuario" id="nivel_usuario" class="Combos">
									<option value="-1" <?php if ($registro["nivel_usuario"]=="-1") echo 'selected'; ?> >Todos los usuarios</option>
									<option value="1"  <?php if ($registro["nivel_usuario"]=="1") echo 'selected'; ?> >&#9733;</option>
									<option value="2"  <?php if ($registro["nivel_usuario"]=="2") echo 'selected'; ?> >&#9733;&#9733;</option>
									<option value="3"  <?php if ($registro["nivel_usuario"]=="3") echo 'selected'; ?> >&#9733;&#9733;&#9733;</option>
									<option value="4"  <?php if ($registro["nivel_usuario"]=="4") echo 'selected'; ?> >&#9733;&#9733;&#9733;&#9733;</option>
									<option value="5"  <?php if ($registro["nivel_usuario"]=="5") echo 'selected'; ?> >&#9733;&#9733;&#9733;&#9733;&#9733; SuperAdmin</option>
								</select>
								<a href="#" title="Quienes pueden ver esta opci&oacute;n?" name="Indique el perfil de usuario que se debe tener para ver esta opci&oacute;n como disponible."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
					</table>
				</td>
			</tr></table>

			<table width="90%" border="0" cellspacing="0" cellpadding="0"><tr>
				<td align="RIGHT" valign="TOP">
					<table border="0" cellspacing="5" cellpadding="0" align="CENTER" style="font-family: Verdana, Tahoma, Arial; font-size: 10px; margin-top: 10px; margin-right: 10px; margin-left: 10px; margin-bottom: 10px;" class="link_menu">
						<tr>
							<td align="RIGHT">
									</form>
							</td><td width="5"></td>
							<td align="RIGHT">
									<input type="Button" name="" value="Actualizar datos"  class="Botones" onClick="document.datos.submit()">
									&nbsp;&nbsp;<input type="Button" onclick="document.core_ver_menu.submit()" name="" value="Cerrar" class="Botones">
							</td>
						</tr>
					</table>
				</td>
			</tr></table>

		</DIV>
		</div>

 <?php
		cerrar_ventana();
	}
 ?>
<?php
/* ################################################################## */
if ($accion=="eliminar_menu")
	{
		/*
			Function: eliminar_menu
			Elimina una opcion del menu, escritorio o demas ubicaciones definidas por el administrador incluyendo el vinculo a todos los usuarios que la tengan.

			Variables de entrada:

				id - Identificador unico en la tabla de menu

			Salida:
				Entradas de menu actualizadas.

			Ver tambien:
			<administrar_menu>  <detalles_menu>
		*/
		// Elimina los datos de la opcion
		ejecutar_sql_unaria("DELETE FROM ".$TablasCore."menu WHERE id=$id");
		// Elimina el enlace para todos los usuarios que utilizan esa opcion
		ejecutar_sql_unaria("DELETE FROM ".$TablasCore."usuario_menu WHERE menu=$id");
		// Lleva a auditoria
		ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Elimina en menu $id','$fecha_operacion','$hora_operacion')");
		echo '<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
	}
/* ################################################################## */
	if ($accion=="guardar_menu")
		{
			$mensaje_error="";
			// Verifica campos nulos
			if ($texto=="")
				$mensaje_error.="Se requiere el campo de texto como m&iacute;nimo.<br>";

			if ($mensaje_error=="")
				{
					// Guarda los datos del comando o item de menu
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."menu VALUES (0,'$texto','$padre','$peso','$url','$posible_clic','$tipo_comando','$comando','$nivel_usuario','$columna','$posible_arriba','$posible_escritorio','$posible_centro','$seccion','$imagen')");
					// Lleva a auditoria
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Agrega en menu: $texto','$fecha_operacion','$hora_operacion')");
					echo '<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="administrar_menu">
						<input type="Hidden" name="error_titulo" value="Problema en los datos ingresados">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}
/* ################################################################## */
if ($accion=="administrar_menu")
	{
		echo '<div align="center"><br>';
		abrir_ventana('Administraci&oacute;n del men&uacute; principal','f2f2f2','');
?>

		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioImagenes' class="FormularioPopUps">
			<?php
			abrir_ventana('Haga clic sobre una im&aacute;gen para seleccionarla','BDB9B9','');

			//Busca en el directorio de iconos por imagenes listas para ser usadas
			$columnas=20;
			$columna_actual=0;
			$directorio="img/";
			$dh = opendir($directorio);
			echo '<table border=1 cellspacing=2>';
			while (($file = readdir($dh)) !== false)
				{
					$impreso=0;
					if ($columna_actual==0)	echo '<tr>';
					if (($file != ".") && ($file != "..") && stristr($file,"tango_"))
						{
							//echo '<td>'.$columna_actual.'<a href="#" title="'.$file.'"><img src='.$directorio.$file.' border=0></a></td>';
							echo '<td>'.$columna_actual.'</td>';
							$impreso=1;
						}
					if ($columna_actual==0)	echo '</tr>';
					if ($impreso) $columna_actual++;
					if ($columna_actual==$columnas) $columna_actual=0;
				}
			echo '</table>';

				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="Cerrar" onClick="OcultarPopUp(\'FormularioImagenes\')">';
				cerrar_barra_estado();
				cerrar_ventana();		// Cierra adicion de botones
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>
		<div id='FondoPopUps' class="FondoOscuroPopUps"></div>



		<div align="center">
			<form name="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="hidden" name="accion" value="guardar_menu">
			<br><font face="" size="3" color="Navy"><b>Agregar opci&oacute;n al men&uacute;</b></font>
			<table border="0" cellspacing="10" cellpadding="0" class="TextosVentana"><tr>
				<td valign="TOP" align=center>
					[CONFIGURACION DE APARIENCIA Y UBICACION]
					<table border="0" cellspacing="5" cellpadding="0" align="CENTER" class="TextosVentana">
						<tr>
							<td align="RIGHT"><b>Texto</b></td><td width="10"></td>
							<td><input class="CampoTexto" type="text" name="texto" size="40" maxlength="250"></td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Padre</b></td><td width="10"></td>
							<td>
									<select name="padre" class="Combos" >
										<option value="0">Ninguno</option>
										<?php				
											$resultado=ejecutar_sql("SELECT * FROM ".$TablasCore."menu ORDER BY texto");
											while($registro = $resultado->fetch())
												{
													echo '<option value="'.$registro["id"].'">'.$registro["texto"].'</option>';
												}
										?>
									</select>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Columna</b></td><td width="10"></td>
							<td>
									<select name="columna" class="Combos" >
											<?php
													for ($i=1;$i<=9;$i++)
														{
																echo '<option value="'.$i.'">'.$i.'</option>';
														}
											?>
									</select> (si aplica)
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Peso</b></td><td width="10"></td>
							<td>
									<select name="peso" class="Combos" >
											<?php
													for ($i=1;$i<=100;$i++)
														{
																echo '<option value="'.$i.'">'.$i.'</option>';
														}
											?>
									</select>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Posible arriba?</b></td><td width="10"></td>
							<td>
									<select  name="posible_arriba" class="Combos" >
										<option value="0">No</option>
										<option value="1">Si</option>
									</select>
									<a href="#" title="Ubicaci&oacute;n de esta opci&oacute;n" name="Se debe habilitar esta opci&oacute;n para ser desplegada en la barra de menu superior-horizontal?"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Posible escritorio?</b></td><td width="10"></td>
							<td>
									<select  name="posible_escritorio" class="Combos" >
										<option value="0">No</option>
										<option value="1" selected>Si</option>
									</select>
									<a href="#" title="Ubicaci&oacute;n de esta opci&oacute;n" name="Se debe habilitar esta opci&oacute;n para ser desplegada como un icono en el escritorio del usuario?"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Posible en el centro?</b></td><td width="10"></td>
							<td>
									<select  name="posible_centro" class="Combos" >
										<option value="0">No</option>
										<option value="1">Si</option>
									</select>
									<a href="#" title="Ubicaci&oacute;n de esta opci&oacute;n" name="Se debe habilitar esta opci&oacute;n para ser desplegada en la parte central del aplicativo, dentro de ventanas clasificadas/agrupadas por el valor definido en el campo Seccion?"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Secci&oacute;n</b></td><td width="10"></td>
							<td><input class="CampoTexto" type="text" name="seccion" size="40" maxlength="250" class="texto_01"></td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Imagen</b></td><td width="10"></td>
							<td>
								<input class="CampoTexto" type="text" name="imagen" size="34" maxlength="250" class="texto_01">
								<a href='javascript:AbrirPopUp("FormularioImagenes");' title="Desplegar una lista de im&aacute;genes disponibles en el sistema">[...]</a>
								</td>
						</tr>
					</table>
				</td>
				<td align="CENTER" valign="TOP">
					[CONFIGURACION DE COMANDOS Y ACCIONES]
					<table border="0" cellspacing="5" cellpadding="0" align="CENTER"  class="TextosVentana" style="font-family: Verdana, Tahoma, Arial; font-size: 10px; margin-top: 10px; margin-right: 10px; margin-left: 10px; margin-bottom: 10px;" class="link_menu">
						<tr>
							<td align="RIGHT"><b>Posible hacer clic?</b></td><td width="10"></td>
							<td>
									<select  name="posible_clic" class="Combos" >
										<option value="0">No</option>
										<option value="1">Si</option>
									</select>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>URL est&aacute;tica</b></td><td width="10"></td>
							<td><input class="CampoTexto" type="text" name="url" size="35" maxlength="250" class="texto_01">
								<a href="#" title="Llevar a una URL o ejecutar un javascript?" name="ingrese una URL completa o un comando javascript definido por javascript:comando para ser reemplazadas dentro de un HREF de un ancla generada alrededor del objeto."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Tipo de comando</b></td><td width="10"></td>
							<td>
									<select name="tipo_comando" class="Combos" >
										<option value="Interno">Interno</option>
										<option value="Personal">Personal</option>
										<option value="Objeto">Objeto</option>
									</select>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b>Acci&oacute;n interna/comando/objeto</b></td><td width="10"></td>
							<td><input class="CampoTexto" type="text" name="comando" size="30" maxlength="250" class="texto_01">
								<a href="#" title="Indique uno de tres valores posibles as&iacute;" name="1) EL OBJETO dise&ntilde;ado en Pr&aacute;ctico y al cual se quiere enlazar la opci&oacute;n mediante el formato frm:XXX &oacute; inf:XXX donde debe reemplazar XXX por el identificador &uacute;nico del objeto que se obtiene despu&eacute;s de haber sido creado (ID del formulario o del informe),  2) LA ACCION INTERNA de Pr&aacute;ctico hacia la cual debe ser direccionado el usuario (normalmente se encuentra en la parte inferior de la pantalla), &oacute; 3) COMANDO PERSONALIZADO: La secuencia de comandos definida/programada por el usuario y existente en el archivo personalizadas.php"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT" valign="TOP"><strong>Nivel de usuario</strong></td><td width="10"></td>
							<td>
								<select  name="nivel_usuario" id="nivel_usuario" class="Combos">
									<option value="-1">Todos los usuarios</option>
									<option value="1">&#9733;</option>
									<option value="2">&#9733;&#9733;</option>
									<option value="3">&#9733;&#9733;&#9733;</option>
									<option value="4">&#9733;&#9733;&#9733;&#9733;</option>
									<option value="5">&#9733;&#9733;&#9733;&#9733;&#9733; SuperAdmin</option>
								</select>
								<a href="#" title="Quienes pueden ver esta opci&oacute;n?" name="Indique el perfil de usuario que se debe tener para ver esta opci&oacute;n como disponible."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
					</table>
				</td>
			</tr></table>

			<table width="90%" border="0" cellspacing="0" cellpadding="0"  class="TextosVentana"><tr>
				<td align="RIGHT" valign="TOP">
					<table border="0" cellspacing="5" cellpadding="0" align="CENTER" style="font-family: Verdana, Tahoma, Arial; font-size: 10px; margin-top: 10px; margin-right: 10px; margin-left: 10px; margin-bottom: 10px;" class="link_menu">
						<tr>
							<td align="RIGHT">
									</form>
							</td><td width="5"></td>
							<td align="RIGHT">
									<input type="button" name="" value="Agregar" class="Botones" onClick="document.datos.submit()">
									&nbsp;&nbsp;<input type="Button" onclick="document.core_ver_menu.submit()" name="" value="Cancelar" class="Botones">
							</td>
						</tr>
					</table>
				</td>
			</tr></table>

		<font face="" size="3" color="Navy"><b>Secciones y comandos de men&uacute; definidos</b></font><br><br>
		 <?php
				echo '
				<table width="100%" border="0" cellspacing="5" align="CENTER" class="TextosVentana">
					<tr>
						<td align="left" bgcolor="#d6d6d6"><b>Id</b></td>
						<td align="LEFT" bgcolor="#D6D6D6"><b>Nivel</b></td>
						<td align="LEFT" bgcolor="#D6D6D6"><b>Ubicaci&oacute;n</b></td>
						<td align="left" bgcolor="#d6d6d6"><b>Texto</b></td>
						<td align="left" bgcolor="#d6d6d6"><b>Peso</b></td>
						<td align="left" bgcolor="#d6d6d6"><b>Padre</b></td>
						<td align="left" bgcolor="#d6d6d6"></td>
						<td align="left" bgcolor="#d6d6d6"></td>
					</tr>	';

				$resultado=ejecutar_sql("SELECT * FROM ".$TablasCore."menu WHERE padre=0");
				while($registro = $resultado->fetch())
					{
						echo '<tr>
								<td>'.$registro["id"].'</td>
								<td>'.$registro["nivel_usuario"].'</td>
								<td>'.$registro["columna"].'</td>
								<td><strong>'.$registro["texto"].'</strong></td>
								<td>'.$registro["peso"].'</td>
								<td>'.$registro["padre"].'</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST" name="f'.$registro["id"].'" id="f'.$registro["id"].'">
												<input type="hidden" name="accion" value="eliminar_menu">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="button" value="Eliminar" class="BotonesCuidado" onClick="confirmar_evento(\'IMPORTANTE:  Al eliminar el registro pueden quedar sin vincular algunas opciones del sistema.\nEst&aacute; seguro que desea continuar ?\',f'.$registro["id"].');">
												&nbsp;&nbsp;
										</form>
								</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST">
												<input type="hidden" name="accion" value="detalles_menu">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="Submit" value="Detalles" class="Botones">
												&nbsp;&nbsp;
										</form>
								</td>
							</tr>';


							// Imprime las opciones dentro de la seccion
							$padre=$registro["id"];

							$resultado_nivel1=ejecutar_sql("SELECT * FROM ".$TablasCore."menu WHERE padre=$padre ORDER BY peso");
							while($registro_nivel1 = $resultado_nivel1->fetch())
								{
									echo '<tr>
											<td>'.$registro_nivel1["id"].'</td>
											<td>'.$registro_nivel1["nivel"].'</td>
											<td></td>
											<td>&nbsp;&nbsp;&nbsp;'.$registro_nivel1["texto"].'</td>
											<td>'.$registro_nivel1["peso"].'</td>
											<td>'.$registro_nivel1["padre"].'</td>
											<td align="center">
													<form action="'.$ArchivoCORE.'" method="POST" name="f'.$registro_nivel1["id"].'" id="f'.$registro_nivel1["id"].'">
															<input type="hidden" name="accion" value="eliminar_menu">
															<input type="hidden" name="id" value="'.$registro_nivel1["id"].'">
															<input type="button" value="Eliminar" class="BotonesCuidado" onClick="confirmar_evento(\'IMPORTANTE:  Al eliminar el registro pueden quedar sin vincular algunas opciones del sistema.\nEst&aacute; seguro que desea continuar ?\',f'.$registro_nivel1["id"].');">
															&nbsp;&nbsp;
													</form>
											</td>
											<td align="center">
													<form action="'.$ArchivoCORE.'" method="POST">
															<input type="hidden" name="accion" value="detalles_menu">
															<input type="hidden" name="id" value="'.$registro_nivel1["id"].'">
															<input type="Submit" value="Detalles" class="Botones">
															&nbsp;&nbsp;
													</form>
											</td>
										</tr>';
								}
					}
				echo '</table><br><br>';
		 ?>
		</div>


		 <?php
		 				cerrar_ventana();
		 		}
		 ?>
