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
		ejecutar_sql_unaria("UPDATE ".$TablasCore."menu SET texto=?,padre=?,peso=?,url=?,posible_clic=?,tipo_comando=?,comando=?,nivel_usuario=?,columna=?,posible_arriba=?,posible_centro=?,posible_escritorio=?,seccion=?,imagen=? WHERE id=? ","$texto||$padre||$peso||$url||$posible_clic||$tipo_comando||$comando||$nivel_usuario||$columna||$posible_arriba||$posible_centro||$posible_escritorio||$seccion||$imagen||$id");
		auditar("Actualiza menu item $texto c&oacute;digo $id");
		echo '<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
	}



/* ################################################################## */
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
		abrir_ventana($MULTILANG_MnuTitEditar,'f2f2f2','');

		// Busca detalles del item
		$resultado=ejecutar_sql("SELECT id,".$ListaCamposSinID_menu." FROM ".$TablasCore."menu WHERE id=? ","$id");
		$registro = $resultado->fetch();
		?>

		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioImagenes' class="FormularioPopUps">
			<?php
			abrir_ventana($MULTILANG_MnuSelImagen,'BDB9B9','620');

			//Busca en el directorio de iconos por imagenes listas para ser usadas
			$columnas=15;
			$columna_actual=1;
			$directorio="img/";
			@$TemasIconos[]=array(Nombre => "Tango Desktop",	Tamano => "32x32",	Prefijo => "tango_");
			@$TemasIconos[]=array(Nombre => "Developer",		Tamano => "32x32",	Prefijo => "dev_");
			@$TemasIconos[]=array(Nombre => "Finance",		Tamano => "32x32",	Prefijo => "finance_");
			@$TemasIconos[]=array(Nombre => "Medical",		Tamano => "32x32",	Prefijo => "medical_");
			@$TemasIconos[]=array(Nombre => "Moskis",		Tamano => "32x32",	Prefijo => "moskis_");
			@$TemasIconos[]=array(Nombre => "Social",		Tamano => "32x32",	Prefijo => "social_");
			@$TemasIconos[]=array(Nombre => "Woo",			Tamano => "32x32",	Prefijo => "woo_");
			@$TemasIconos[]=array(Nombre => "Once",			Tamano => "48x48",	Prefijo => "once_");
			@$TemasIconos[]=array(Nombre => "Ginux",			Tamano => "64x64",	Prefijo => "ginux_");
			echo '<DIV style="DISPLAY: block; OVERFLOW: auto; WIDTH: 100%; POSITION: relative; HEIGHT: 350px">';
			for ($i=0;$i<count($TemasIconos);$i++)
				{
					$columna_actual=1;
					$dh = opendir($directorio);
					echo "<font size=3>&nbsp;&nbsp;<b><br><br>".$TemasIconos[$i]["Nombre"]." (".$TemasIconos[$i]["Tamano"]." pixels)<hr></b></font>";
					echo '<table border=0 cellspacing=4>';
					while (($file = readdir($dh)) !== false)
						{
							$impreso=0;
							if (($file != ".") && ($file != "..") && (stristr($file,$TemasIconos[$i]["Prefijo"])  ))
								{
									if ($columna_actual==1)	echo '<tr>';
									echo '<td><a href="javascript:document.datos.imagen.value=\''.$file.'\';OcultarPopUp(\'FormularioImagenes\');" title="'.$file.'"><img src='.$directorio.$file.' border=0 width=32 height=32></a></td>';	
									$impreso=1;
									if ($impreso) $columna_actual++;
									if ($columna_actual==$columnas) $columna_actual=1;
									if ($columna_actual==$columnas)	echo '</tr>';
								}
						}
					echo '</table>';
				}
			echo '</DIV>';

				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="'.$MULTILANG_Cerrar.'" onClick="OcultarPopUp(\'FormularioImagenes\')">';
				cerrar_barra_estado();
				cerrar_ventana();		// Cierra adicion de botones
			?>
		</div>
		<!-- FIN DE MARCOS POPUP -->
		<div id='FondoPopUps' class="FondoOscuroPopUps"></div>

		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioObjetos' class="FormularioPopUps">
			<form name="selector_objetos" method="POST">
			<?php
			abrir_ventana($MULTILANG_SeleccioneUno.' '.$MULTILANG_MnuObjeto,'BDB9B9','');
			?>
				<br><br>
				<table class="TextosVentana">
				<tr>
					<td align="right"><?php echo $MULTILANG_Formularios; ?> / <?php echo $MULTILANG_Informes; ?>:</td>
					<td >
						<select  name="objeto_seleccionado" class="Combos">
						<option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
						<optgroup label="<?php echo $MULTILANG_Formularios; ?>">
							<?php
								$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario ORDER BY titulo");
								while($registro_forms = $consulta_forms->fetch())
									echo '<option value="frm:'.$registro_forms["id"].'">(Id.'.$registro_forms["id"].') '.$registro_forms["titulo"].'</option>';
							?>
						</optgroup>
						<optgroup label="<?php echo $MULTILANG_Informes; ?>">
							<?php
								$consulta_informs=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe." FROM ".$TablasCore."informe ORDER BY titulo");
								while($registro_informes = $consulta_informs->fetch())
									echo '<option value="inf:'.$registro_informes["id"].'">(Id.'.$registro_informes["id"].') '.$registro_informes["titulo"].'</option>';
							?>
						</optgroup>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right"><?php echo $MULTILANG_FrmVentana; ?>:</td>
					<td >
						<select  name="definir_ventana_propia" class="Combos">
							<option value=":1"><?php echo $MULTILANG_Si; ?></option>
							<option value=":0"><?php echo $MULTILANG_No; ?></option>
						</select>
					</td>
				</tr>
				</table>
				<?php echo $MULTILANG_MnuHlpComandoInf; ?>
				<br><br>
			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstado" value=" '.$MULTILANG_Guardar.' " onClick="document.datos.comando.value=document.selector_objetos.objeto_seleccionado.options[document.selector_objetos.objeto_seleccionado.selectedIndex].value + document.selector_objetos.definir_ventana_propia.options[document.selector_objetos.definir_ventana_propia.selectedIndex].value; OcultarPopUp(\'FormularioObjetos\')">';
					echo '<input type="Button"  class="BotonesEstadoCuidado" value=" '.$MULTILANG_Cancelar.' " onClick="OcultarPopUp(\'FormularioObjetos\')">';
				cerrar_barra_estado();
				cerrar_ventana();		// Cierra seleccion de objetos
			?>
			</form>
		</div>
		<!-- FIN DE MARCOS POPUP -->


		<div align="center">
			
		<DIV style="DISPLAY: block; OVERFLOW: auto; WIDTH: 100%; POSITION: relative;">
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="hidden" name="accion" value="actualizar_menu">
			<input type="hidden" name="id" value="<?php echo $registro["id"]; ?>">
			<br><font face="" size="3" color="Navy"><b><?php echo $MULTILANG_MnuPropiedad; ?></b></font>

			<table border="0" cellspacing="10" cellpadding="0" class="TextosVentana"><tr>
				<td valign="TOP" align=center>
					[<?php echo $MULTILANG_MnuApariencia; ?>]
					<table border="0" cellspacing="5" cellpadding="0" align="CENTER" class="TextosVentana">
						<tr>
							<td align="RIGHT"><b>ID</b></td><td width="10"></td>
							<td>
									<?php echo $registro["id"]; ?>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuTexto; ?></b></td><td width="10"></td>
							<td><input value="<?php echo $registro["texto"]; ?>" class="CampoTexto" type="text" name="texto" size="40" maxlength="250"></td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuPadre; ?></b></td><td width="10"></td>
							<td>
									<select name="padre" class="Combos" >
										<option value="0"><?php echo $MULTILANG_Ninguno; ?></option>
										<?php
											$resultado_padre=ejecutar_sql("SELECT id,".$ListaCamposSinID_menu." FROM ".$TablasCore."menu WHERE 1=1 ORDER BY texto");
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
							<td align="RIGHT"><b><?php echo $MULTILANG_Columna; ?></b></td><td width="10"></td>
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
									</select> (<?php echo $MULTILANG_MnuSiAplica; ?>)
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_Peso; ?></b></td><td width="10"></td>
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
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuArriba; ?></b></td><td width="10"></td>
							<td>
									<select  name="posible_arriba" class="Combos" >
										<option value="0"><?php echo $MULTILANG_No; ?></option>
										<option value="1" <?php if ($registro["posible_arriba"]) echo 'selected'; ?> ><?php echo $MULTILANG_Si; ?></option>
									</select>
									<a href="#" title="<?php echo $MULTILANG_MnuUbicacion; ?>" name="<?php echo $MULTILANG_MnuDesArriba; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuEscritorio; ?></b></td><td width="10"></td>
							<td>
									<select  name="posible_escritorio" class="Combos" >
										<option value="0"><?php echo $MULTILANG_No; ?></option>
										<option value="1" <?php if ($registro["posible_escritorio"]) echo 'selected'; ?> ><?php echo $MULTILANG_Si; ?></option>
									</select>
									<a href="#" title="<?php echo $MULTILANG_MnuUbicacion; ?>" name="<?php echo $MULTILANG_MnuDesEscritorio; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuCentro; ?></b></td><td width="10"></td>
							<td>
									<select  name="posible_centro" class="Combos" >
										<option value="0"><?php echo $MULTILANG_No; ?></option>
										<option value="1" <?php if ($registro["posible_centro"]) echo 'selected'; ?> ><?php echo $MULTILANG_Si; ?></option>
									</select>
									<a href="#" title="<?php echo $MULTILANG_MnuUbicacion; ?>" name="<?php echo $MULTILANG_MnuDesCentro; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuSeccion; ?></b></td><td width="10"></td>
							<td><input value="<?php echo $registro["seccion"]; ?>" class="CampoTexto" type="text" name="seccion" size="40" maxlength="250" class="texto_01"></td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_Imagen; ?></b></td><td width="10"></td>
							<td><input value="<?php echo $registro["imagen"]; ?>" class="CampoTexto" type="text" name="imagen" size="34" maxlength="250" class="texto_01">
							<a href='javascript:AbrirPopUp("FormularioImagenes");' title="<?php echo $MULTILANG_MnuDesImagen; ?>">[...]</a></td>
						</tr>
					</table>
				</td>
				<td align="CENTER" valign="TOP">
					[<?php echo $MULTILANG_MnuComandos; ?>]
					<table border="0" cellspacing="5" cellpadding="0" align="CENTER"  class="TextosVentana" style="font-family: Verdana, Tahoma, Arial; font-size: 10px; margin-top: 10px; margin-right: 10px; margin-left: 10px; margin-bottom: 10px;" class="link_menu">
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuClic; ?></b></td><td width="10"></td>
							<td>
									<select  name="posible_clic" class="Combos" >
										<option value="0"><?php echo $MULTILANG_No; ?></option>
										<option value="1" <?php if ($registro["posible_clic"]) echo 'selected'; ?> ><?php echo $MULTILANG_Si; ?></option>
									</select>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuURL; ?></b></td><td width="10"></td>
							<td><input value="<?php echo $registro["url"]; ?>"  class="CampoTexto" type="text" name="url" size="35" maxlength="250" class="texto_01">
								<a href="#" title="<?php echo $MULTILANG_MnuTitURL; ?>" name="<?php echo $MULTILANG_MnuDesURL; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuTipo; ?></b></td><td width="10"></td>
							<td>
									<select name="tipo_comando" class="Combos" >
										<option value="Objeto" <?php if ($registro["tipo_comando"]=="Objeto") echo 'selected'; ?> >1. <?php echo $MULTILANG_MnuObjeto; ?></option>
										<option value="Interno" <?php if ($registro["tipo_comando"]=="Interno") echo 'selected'; ?> >2. <?php echo $MULTILANG_MnuInterno; ?></option>
										<option value="Personal" <?php if ($registro["tipo_comando"]=="Personal") echo 'selected'; ?> >3. <?php echo $MULTILANG_MnuPersonal; ?></option>
									</select>
									<a href="#" title="<?php echo $MULTILANG_MnuTitAccion; ?>" name="<?php echo $MULTILANG_MnuDesAccion; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuAccion; ?></b></td><td width="10"></td>
							<td><input value="<?php echo $registro["comando"]; ?>"  class="CampoTexto" type="text" name="comando" size="30" maxlength="250" class="texto_01">
								<a href='javascript:AbrirPopUp("FormularioObjetos");' title="<?php echo $MULTILANG_SeleccioneUno.' '.$MULTILANG_MnuObjeto; ?>">[...]</a>
								<a href="#" title="<?php echo $MULTILANG_MnuTitAccion; ?>" name="<?php echo $MULTILANG_MnuDesAccion; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT" valign="TOP"><strong><?php echo $MULTILANG_InfNivelUsuario; ?></strong></td><td width="10"></td>
							<td>
								<select  name="nivel_usuario" id="nivel_usuario" class="Combos">
									<option value="-1" <?php if ($registro["nivel_usuario"]=="-1") echo 'selected'; ?> ><?php echo $MULTILANG_InfTodoUsuario; ?></option>
									<option value="1"  <?php if ($registro["nivel_usuario"]=="1") echo 'selected'; ?> >&#9733;</option>
									<option value="2"  <?php if ($registro["nivel_usuario"]=="2") echo 'selected'; ?> >&#9733;&#9733;</option>
									<option value="3"  <?php if ($registro["nivel_usuario"]=="3") echo 'selected'; ?> >&#9733;&#9733;&#9733;</option>
									<option value="4"  <?php if ($registro["nivel_usuario"]=="4") echo 'selected'; ?> >&#9733;&#9733;&#9733;&#9733;</option>
									<option value="5"  <?php if ($registro["nivel_usuario"]=="5") echo 'selected'; ?> >&#9733;&#9733;&#9733;&#9733;&#9733; SuperAdmin</option>
								</select>
								<a href="#" title="<?php echo $MULTILANG_MnuTitNivel; ?>" name="<?php echo $MULTILANG_MnuDesNivel; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
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
									<input type="Button" name="" value="<?php echo $MULTILANG_MnuActualiza; ?>"  class="Botones" onClick="document.datos.submit()">
									&nbsp;&nbsp;<input type="Button" onclick="document.core_ver_menu.submit()" name="" value="<?php echo $MULTILANG_Cerrar; ?>" class="Botones">
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



/* ################################################################## */
/* ################################################################## */
if ($accion=="eliminar_menu")
	{
		/*
			Function: eliminar_menu
			Elimina una opcion del menu, escritorio o demas ubicaciones definidas por el administrador incluyendo el vinculo a todos los usuarios que la tengan.

			Variables de entrada:

				id - Identificador unico en la tabla de menu

			(start code)
				DELETE FROM ".$TablasCore."menu WHERE id=$id
				DELETE FROM ".$TablasCore."usuario_menu WHERE menu=$id
			(end)

			Salida:
				Entradas de menu actualizadas.

			Ver tambien:
			<administrar_menu> | <detalles_menu>
		*/
		// Elimina los datos de la opcion
		ejecutar_sql_unaria("DELETE FROM ".$TablasCore."menu WHERE id=? ","$id");
		// Elimina el enlace para todos los usuarios que utilizan esa opcion
		ejecutar_sql_unaria("DELETE FROM ".$TablasCore."usuario_menu WHERE menu=? ","$id");
		auditar("Elimina en menu $id");
		echo '<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
	}



/* ################################################################## */
/* ################################################################## */
		/*
			Function: guardar_menu
			Almacena una opcion del menu, escritorio o demas ubicaciones definidas por el administrador quedando disponible para ser asignado a los usuarios mediante la opcion que hace el llamado a la funcion de <permisos_usuario>

			Variables de entrada:

				texto - Texto que identifica a la opcion de menu
				peso - Valor entero que define el orden en que debe ser presentada la opcion cuando aparece junto con otras
				tipo_comando - Define el tipo de comando que va a aser ejecutado por la opcion de menu
				imagen - Un nombre de archivo correspondiente a una imagen existente dentro de la carpeta relativa img/ y que sera utilizada como icono para la opcion
				seccion - Texto que indica el nombre de una seccion que puede agrupar la opcion cuando esta se encuentra disponible en el acordeon de opciones en el escritorio
				nivel_usuario - Establece el nivel de usuario minimo requerido para poder visualizar la opcion
				comando - En el caso de tipo_comando personalizado, establece el comando a ser lanzado por practico

			(start code)
				INSERT INTO ".$TablasCore."menu VALUES (0,'$texto','$padre','$peso','$url','$posible_clic','$tipo_comando','$comando','$nivel_usuario','$columna','$posible_arriba','$posible_escritorio','$posible_centro','$seccion','$imagen')
			(end)

			Salida:
				Entradas de menu actualizadas.

			Ver tambien:
			<administrar_menu> | <detalles_menu> | <eliminar_menu>
		*/
	if ($accion=="guardar_menu")
		{
			$mensaje_error="";
			// Verifica campos nulos
			if ($texto=="")
				$mensaje_error.=$MULTILANG_MnuErr."<br>";

			if ($mensaje_error=="")
				{
					// Guarda los datos del comando o item de menu
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."menu (".$ListaCamposSinID_menu.") VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)","$texto||$padre||$peso||$url||$posible_clic||$tipo_comando||$comando||$nivel_usuario||$columna||$posible_arriba||$posible_centro||$posible_escritorio||$seccion||$imagen");
					auditar("Agrega en menu: $texto");
					echo '<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="administrar_menu">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}



/* ################################################################## */
/* ################################################################## */
		/*
			Function: administrar_menu
			Presenta la lista de todas las opciones definidas para el menu de usuarios con la posibilidad de agregar nuevas o de administrar las existentes. Incluye la carga de imagenes dentro de marco oculto para su seleccion como iconos.

			(start code)
				SELECT * FROM ".$TablasCore."menu WHERE 1
			(end)

			Salida:
				Listado de opciones de menu y formulario para creacion de nuevas

			Ver tambien:
			<guardar_menu> | <detalles_menu> | <eliminar_menu>
		*/
if ($accion=="administrar_menu")
	{
		$accion=escapar_contenido($accion); //Limpia cadena para evitar XSS
		echo '<div align="center"><br>';
		echo "<a href='javascript:abrir_ventana_popup(\"http://www.youtube.com/embed/-24qazTBngg\",\"VideoTutorial\",\"toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, width=640, height=480\");'><img src='img/icono_screencast.png' alt='ScreenCast-VideoTutorial'></a>";
		abrir_ventana($MULTILANG_MnuAdmin,'f2f2f2','');
?>

		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioImagenes' class="FormularioPopUps">
			<?php
			abrir_ventana($MULTILANG_MnuSelImagen,'BDB9B9','620');

			//Busca en el directorio de iconos por imagenes listas para ser usadas
			$columnas=15;
			$columna_actual=1;
			$directorio="img/";
			@$TemasIconos[]=array(Nombre => "Tango Desktop",	Tamano => "32x32",	Prefijo => "tango_");
			@$TemasIconos[]=array(Nombre => "Developer",		Tamano => "32x32",	Prefijo => "dev_");
			@$TemasIconos[]=array(Nombre => "Finance",		Tamano => "32x32",	Prefijo => "finance_");
			@$TemasIconos[]=array(Nombre => "Medical",		Tamano => "32x32",	Prefijo => "medical_");
			@$TemasIconos[]=array(Nombre => "Moskis",		Tamano => "32x32",	Prefijo => "moskis_");
			@$TemasIconos[]=array(Nombre => "Social",		Tamano => "32x32",	Prefijo => "social_");
			@$TemasIconos[]=array(Nombre => "Woo",			Tamano => "32x32",	Prefijo => "woo_");
			@$TemasIconos[]=array(Nombre => "Once",			Tamano => "32x32",	Prefijo => "once_");
			@$TemasIconos[]=array(Nombre => "Ginux",			Tamano => "32x32",	Prefijo => "ginux_");
			echo '<DIV style="DISPLAY: block; OVERFLOW: auto; WIDTH: 100%; POSITION: relative; HEIGHT: 350px">';
			for ($i=0;$i<count($TemasIconos);$i++)
				{
					$columna_actual=1;
					$dh = opendir($directorio);
					echo "<font size=3>&nbsp;&nbsp;<b><br><br>".$TemasIconos[$i]["Nombre"]." (".$TemasIconos[$i]["Tamano"]." pixels)<hr></b></font>";
					echo '<table border=0 cellspacing=4>';
					while (($file = readdir($dh)) !== false)
						{
							$impreso=0;
							if (($file != ".") && ($file != "..") && (stristr($file,$TemasIconos[$i]["Prefijo"])  ))
								{
									if ($columna_actual==1)	echo '<tr>';
									echo '<td><a href="javascript:document.datos.imagen.value=\''.$file.'\';OcultarPopUp(\'FormularioImagenes\');" title="'.$file.'"><img src='.$directorio.$file.' border=0 width=32 height=32></a></td>';	
									$impreso=1;
									if ($impreso) $columna_actual++;
									if ($columna_actual==$columnas) $columna_actual=1;
									if ($columna_actual==$columnas)	echo '</tr>';
								}
						}
					echo '</table>';
				}
			echo '</DIV>';

				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value=" '.$MULTILANG_Cerrar.' " onClick="OcultarPopUp(\'FormularioImagenes\')">';
				cerrar_barra_estado();
				cerrar_ventana();		// Cierra seleccion de imagenes
			?>
		</div>
		<!-- FIN DE MARCOS POPUP -->

		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioObjetos' class="FormularioPopUps">
			<form name="selector_objetos" method="POST">
			<?php
			abrir_ventana($MULTILANG_SeleccioneUno.' '.$MULTILANG_MnuObjeto,'BDB9B9','');
			?>
				<br><br>
				<table class="TextosVentana">
				<tr>
					<td align="right"><?php echo $MULTILANG_Formularios; ?> / <?php echo $MULTILANG_Informes; ?>:</td>
					<td >
						<select  name="objeto_seleccionado" class="Combos">
						<option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
						<optgroup label="<?php echo $MULTILANG_Formularios; ?>">
							<?php
								$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario ORDER BY titulo");
								while($registro_forms = $consulta_forms->fetch())
									echo '<option value="frm:'.$registro_forms["id"].'">(Id.'.$registro_forms["id"].') '.$registro_forms["titulo"].'</option>';
							?>
						</optgroup>
						<optgroup label="<?php echo $MULTILANG_Informes; ?>">
							<?php
								$consulta_informs=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe." FROM ".$TablasCore."informe ORDER BY titulo");
								while($registro_informes = $consulta_informs->fetch())
									echo '<option value="inf:'.$registro_informes["id"].'">(Id.'.$registro_informes["id"].') '.$registro_informes["titulo"].'</option>';
							?>
						</optgroup>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right"><?php echo $MULTILANG_FrmVentana; ?>:</td>
					<td >
						<select  name="definir_ventana_propia" class="Combos">
							<option value=":1"><?php echo $MULTILANG_Si; ?></option>
							<option value=":0"><?php echo $MULTILANG_No; ?></option>
						</select>
					</td>
				</tr>
				</table>
				<?php echo $MULTILANG_MnuHlpComandoInf; ?>
				<br><br>
			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstado" value=" '.$MULTILANG_Guardar.' " onClick="document.datos.comando.value=document.selector_objetos.objeto_seleccionado.options[document.selector_objetos.objeto_seleccionado.selectedIndex].value + document.selector_objetos.definir_ventana_propia.options[document.selector_objetos.definir_ventana_propia.selectedIndex].value; OcultarPopUp(\'FormularioObjetos\')">';
					echo '<input type="Button"  class="BotonesEstadoCuidado" value=" '.$MULTILANG_Cancelar.' " onClick="OcultarPopUp(\'FormularioObjetos\')">';
				cerrar_barra_estado();
				cerrar_ventana();		// Cierra seleccion de objetos
			?>
			</form>
		</div>
		<!-- FIN DE MARCOS POPUP -->


		<div id='FondoPopUps' class="FondoOscuroPopUps"></div>

		<div align="center">
			<form name="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="hidden" name="accion" value="guardar_menu">
			<br><font face="" size="3" color="Navy"><b><?php echo $MULTILANG_MnuAgregar; ?></b></font>
			<table border="0" cellspacing="10" cellpadding="0" class="TextosVentana"><tr>
				<td valign="TOP" align=center>
					[<?php echo $MULTILANG_MnuApariencia; ?>]
					<table border="0" cellspacing="5" cellpadding="0" align="CENTER" class="TextosVentana">
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuTexto; ?></b></td><td width="10"></td>
							<td><input class="CampoTexto" type="text" name="texto" size="40" maxlength="250"></td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuPadre; ?></b></td><td width="10"></td>
							<td>
									<select name="padre" class="Combos" >
										<option value="0"><?php echo $MULTILANG_Ninguno; ?></option>
										<?php				
											$resultado=ejecutar_sql("SELECT id,".$ListaCamposSinID_menu." FROM ".$TablasCore."menu ORDER BY texto");
											while($registro = $resultado->fetch())
												{
													echo '<option value="'.$registro["id"].'">'.$registro["texto"].'</option>';
												}
										?>
									</select> (beta)
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_Columna; ?></b></td><td width="10"></td>
							<td>
									<select name="columna" class="Combos" >
											<?php
													for ($i=1;$i<=9;$i++)
														{
																echo '<option value="'.$i.'">'.$i.'</option>';
														}
											?>
									</select> (beta)
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_Peso; ?></b></td><td width="10"></td>
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
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuArriba; ?></b></td><td width="10"></td>
							<td>
									<select  name="posible_arriba" class="Combos" >
										<option value="0"><?php echo $MULTILANG_No; ?></option>
										<option value="1"><?php echo $MULTILANG_Si; ?></option>
									</select>
									<a href="#" title="<?php echo $MULTILANG_MnuUbicacion; ?>" name="<?php echo $MULTILANG_MnuDesArriba; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuEscritorio; ?></b></td><td width="10"></td>
							<td>
									<select  name="posible_escritorio" class="Combos" >
										<option value="0"><?php echo $MULTILANG_No; ?></option>
										<option value="1" selected><?php echo $MULTILANG_Si; ?></option>
									</select>
									<a href="#" title="<?php echo $MULTILANG_MnuUbicacion; ?>" name="<?php echo $MULTILANG_MnuDesEscritorio; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuCentro; ?></b></td><td width="10"></td>
							<td>
									<select  name="posible_centro" class="Combos" >
										<option value="0"><?php echo $MULTILANG_No; ?></option>
										<option value="1"><?php echo $MULTILANG_Si; ?></option>
									</select>
									<a href="#" title="<?php echo $MULTILANG_MnuUbicacion; ?>" name="<?php echo $MULTILANG_MnuDesCentro; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuSeccion; ?></b></td><td width="10"></td>
							<td><input class="CampoTexto" type="text" name="seccion" size="40" maxlength="250" class="texto_01"></td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_Imagen; ?></b></td><td width="10"></td>
							<td>
								<input class="CampoTexto" type="text" name="imagen" size="34" maxlength="250" class="texto_01">
								<a href='javascript:AbrirPopUp("FormularioImagenes");' title="<?php echo $MULTILANG_MnuDesImagen; ?>">[...]</a>
								</td>
						</tr>
					</table>
				</td>
				<td align="CENTER" valign="TOP">
					[<?php echo $MULTILANG_MnuComandos; ?>]
					<table border="0" cellspacing="5" cellpadding="0" align="CENTER"  class="TextosVentana" style="font-family: Verdana, Tahoma, Arial; font-size: 10px; margin-top: 10px; margin-right: 10px; margin-left: 10px; margin-bottom: 10px;" class="link_menu">
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuClic; ?></b></td><td width="10"></td>
							<td>
									<select  name="posible_clic" class="Combos" >
										<option value="0"><?php echo $MULTILANG_No; ?></option>
										<option value="1"><?php echo $MULTILANG_Si; ?></option>
									</select>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuURL; ?></b></td><td width="10"></td>
							<td><input class="CampoTexto" type="text" name="url" size="35" maxlength="250" class="texto_01">
								<a href="#" title="<?php echo $MULTILANG_MnuTitURL; ?>" name="<?php echo $MULTILANG_MnuDesURL; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuTipo; ?></b></td><td width="10"></td>
							<td>
									<select name="tipo_comando" class="Combos" >
										<option value="Objeto">1. <?php echo $MULTILANG_MnuObjeto; ?></option>
										<option value="Interno">2. <?php echo $MULTILANG_MnuInterno; ?></option>
										<option value="Personal">3. <?php echo $MULTILANG_MnuPersonal; ?></option>
									</select>
									<a href="#" title="<?php echo $MULTILANG_MnuTitAccion; ?>" name="<?php echo $MULTILANG_MnuDesAccion; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuAccion; ?></b></td><td width="10"></td>
							<td><input class="CampoTexto" type="text" name="comando" size="30" maxlength="250" class="texto_01">
								<a href='javascript:AbrirPopUp("FormularioObjetos");' title="<?php echo $MULTILANG_SeleccioneUno.' '.$MULTILANG_MnuObjeto; ?>">[...]</a>
								<a href="#" title="<?php echo $MULTILANG_MnuTitAccion; ?>" name="<?php echo $MULTILANG_MnuDesAccion; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT" valign="TOP"><strong><?php echo $MULTILANG_InfNivelUsuario; ?></strong></td><td width="10"></td>
							<td>
								<select  name="nivel_usuario" id="nivel_usuario" class="Combos">
									<option value="-1"><?php echo $MULTILANG_InfTodoUsuario; ?></option>
									<option value="1">&#9733;</option>
									<option value="2">&#9733;&#9733;</option>
									<option value="3">&#9733;&#9733;&#9733;</option>
									<option value="4">&#9733;&#9733;&#9733;&#9733;</option>
									<option value="5">&#9733;&#9733;&#9733;&#9733;&#9733; SuperAdmin</option>
								</select>
								<a href="#" title="<?php echo $MULTILANG_MnuTitNivel; ?>" name="<?php echo $MULTILANG_MnuDesNivel; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
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
									<input type="button" name="" value="<?php echo $MULTILANG_Agregar; ?>" class="Botones" onClick="document.datos.submit()">
									&nbsp;&nbsp;<input type="Button" onclick="document.core_ver_menu.submit()" value="<?php echo $MULTILANG_Cancelar; ?>" value="" class="Botones">
							</td>
						</tr>
					</table>
				</td>
			</tr></table><hr>

		<font face="" size="3" color="Navy"><b><?php echo $MULTILANG_MnuDefinidos; ?></b></font><br><br>
		 <?php
				echo '
				<table width="100%" border="0" cellspacing="3" align="CENTER" class="TextosVentana">
					<tr>
						<td align="left" bgcolor="#d6d6d6"><b>Id</b></td>
						<td align="LEFT" bgcolor="#D6D6D6"><b>'.$MULTILANG_MnuNivel.'</b></td>
						<td></td>
						<td align="left" bgcolor="#d6d6d6"><b>'.$MULTILANG_MnuTexto.'</b></td>
						<td align="LEFT" bgcolor="#D6D6D6"><b>'.$MULTILANG_MnuComando.'</b></td>
						<td></td>
						<td></td>
					</tr>	';

				$resultado=ejecutar_sql("SELECT id,".$ListaCamposSinID_menu." FROM ".$TablasCore."menu WHERE 1=1");
				while($registro = $resultado->fetch())
					{
						$cadena_nivel="";
						for ($i=1;$i<=$registro["nivel_usuario"];$i++)
							$cadena_nivel.="&#9733;";
						echo '<tr>
								<td>'.$registro["id"].'</td>
								<td>'.$cadena_nivel.'</td>
								<td><img src="img/'.$registro["imagen"].'" border=0 alt="" valign="absmiddle" align="absmiddle" width="14" height="13" ></td>
								<td><strong>'.$registro["texto"].'</strong></td>
								<td>'.$registro["comando"].'</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST" name="f'.$registro["id"].'" id="f'.$registro["id"].'">
												<input type="hidden" name="accion" value="eliminar_menu">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="button" value="'.$MULTILANG_Eliminar.'" class="BotonesCuidado" onClick="confirmar_evento(\''.$MULTILANG_MnuAdvElimina.'\',f'.$registro["id"].');">
										</form>
								</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST">
												<input type="hidden" name="accion" value="detalles_menu">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="Submit" value="'.$MULTILANG_Detalles.'" class="Botones">
										</form>
								</td>
							</tr>';
					}
				echo '</table>';
		 ?>
		</div>


		 <?php
		 				cerrar_ventana();
		 		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: Ver_menu
	Despliega el escritorio de un usuario, incluyendo el menu superior, iconos de escritorio y opciones agrupadas en el acordeon central

	Variables de entrada:

		Login_usuario - UID/Login de usuario al que se desea agregar el permiso almacenado como variable de sesion despues del login
		Sesion_abierta - Variable que establece si realmente se ha iniciado una sesion

	Salida:
		Escritorio de usuario con las opciones asignadas

	Observacion:
		La funcion agrega un filtrado para aquellos usuarios diferentes del administrador.  El usuario administrador mostrara siempre todas las opciones existentes por defecto.

	Ver tambien:
		<administrar_menu>
*/
	if ($accion=="Ver_menu" && $Sesion_abierta)
		{ 
			// Carga las opciones del ESCRITORIO
			echo '<table width="100%" border=0><tr><td valign=top>';
			// Si el usuario es diferente al administrador agrega condiciones al query
			if ($Login_usuario!="admin")
				{
					$Complemento_tablas=",".$TablasCore."usuario_menu";
					$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.id AND ".$TablasCore."usuario_menu.usuario='$Login_usuario'";  // AND nivel>0
				}
			$resultado=ejecutar_sql("SELECT * FROM ".$TablasCore."menu ".@$Complemento_tablas." WHERE posible_escritorio=1 ".@$Complemento_condicion);

			// Imprime las opciones con sus formularios
			while($registro = $resultado->fetch())
				{
					// Esta seccion solamente opera con opciones que tienen imagen definida
					if ($registro["imagen"]!="")
						{
							echo '<form action="'.$ArchivoCORE.'" method="post" name="desk_'.$registro["id"].'" id="desk_'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">';
							// Verifica si se trata de un comando interno o personal y crea formulario y enlace correspondiente (ambos funcionan igual)
							if ($registro["tipo_comando"]=="Interno" || $registro["tipo_comando"]=="Personal")
								{
									echo '<input type="hidden" name="accion" value="'.$registro["comando"].'"></form>';
								}
							// Verifica si se trata de una opcion para cargar un objeto de practico
							if ($registro["tipo_comando"]=="Objeto")
								{
									echo'<input type="hidden" name="accion" value="cargar_objeto">
										 <input type="hidden" name="objeto" value="'.$registro["comando"].'"></form>';
								}
							// Imprime la imagen
							echo '<a title="'.$registro["texto"].'" name="" href="javascript:document.desk_'.$registro["id"].'.submit();">';
							echo '<img src="img/'.$registro["imagen"].'" alt="'.$registro["texto"].'" class="IconosEscritorio" valign="absmiddle" align="absmiddle">';
							echo '</a>';
						}
				}
			echo '</td></tr></table>';

			// Carga las opciones del ACORDEON
			echo '<div align="center">';
			// Si el usuario es diferente al administrador agrega condiciones al query
			if ($Login_usuario!="admin")
				{
					$Complemento_tablas=",".$TablasCore."usuario_menu";
					$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.id AND ".$TablasCore."usuario_menu.usuario='$Login_usuario'";  // AND nivel>0
				}
			$resultado=ejecutar_sql("SELECT COUNT(*) as conteo,seccion FROM ".$TablasCore."menu ".@$Complemento_tablas." WHERE posible_centro=1 ".@$Complemento_condicion." GROUP BY seccion ORDER BY seccion");
			// Imprime las secciones encontradas para el usuario
			while($registro = $resultado->fetch())
				{
					//Crea la seccion en el acordeon
					$seccion_menu_activa=$registro["seccion"];
					$conteo_opciones=$registro["conteo"];
					abrir_ventana($seccion_menu_activa.' ('.$conteo_opciones.')','fondo_ventanas2.gif','85%');
					// Busca las opciones dentro de la seccion

					// Si el usuario es diferente al administrador agrega condiciones al query
					if ($Login_usuario!="admin")
						{
							$Complemento_tablas=",".$TablasCore."usuario_menu";
							$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.id AND ".$TablasCore."usuario_menu.usuario='$Login_usuario'";  // AND nivel>0
						}
					$resultado_opciones_acordeon=ejecutar_sql("SELECT * FROM ".$TablasCore."menu ".@$Complemento_tablas." WHERE posible_centro=1 AND seccion='".$seccion_menu_activa."' ".@$Complemento_condicion." ORDER BY peso");

					while($registro_opciones_acordeon = $resultado_opciones_acordeon->fetch())
						{
							// Esta seccion solamente opera con opciones que tienen imagen definida
							if ($registro_opciones_acordeon["imagen"]!="")
								{
									echo '<form action="'.$ArchivoCORE.'" method="post" name="acorde_'.$registro_opciones_acordeon["id"].'" id="acorde_'.$registro_opciones_acordeon["id"].'"
									 style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">';
									// Verifica si se trata de un comando interno o personal y crea formulario y enlace correspondiente (ambos funcionan igual)
									if ($registro_opciones_acordeon["tipo_comando"]=="Interno" || $registro_opciones_acordeon["tipo_comando"]=="Personal")
										{
											echo '<input type="hidden" name="accion" value="'.$registro_opciones_acordeon["comando"].'"></form>';
										}
									// Verifica si se trata de una opcion para cargar un objeto de practico
									if ($registro_opciones_acordeon["tipo_comando"]=="Objeto")
										{
											echo'<input type="hidden" name="accion" value="cargar_objeto">
												 <input type="hidden" name="objeto" value="'.$registro_opciones_acordeon["comando"].'"></form>';
										}
									// Imprime la imagen
									echo '<a title="'.$registro_opciones_acordeon["texto"].'" name="" href="javascript:document.acorde_'.$registro_opciones_acordeon["id"].'.submit();">';
									echo '<img src="img/'.$registro_opciones_acordeon["imagen"].'" alt="'.$registro_opciones_acordeon["texto"].'" class="IconosEscritorio" valign="absmiddle" align="absmiddle">';
									echo '</a>';
								}
						}
					cerrar_ventana();
				}
			echo '</div>';

	} 
?>
