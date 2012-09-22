<?php
			/*
				Title: Modulo informes
				Ubicacion *[/core/informes.php]*.  Archivo de funciones relacionadas con la administracion de informes de la aplicacion.
			*/
?>
<?php
			/*
				Section: Operaciones basicas de administracion
				Funciones asociadas al mantenimiento de informes en el sistema.
			*/
?>


<?php 
/* ################################################################## */
/* ################################################################## */
/*
	Function: actualizar_informe
	Cambia el registro asociado a un informe de la aplicacion

	Variables de entrada:

		id - ID del informe que se desea cambiarse

		(start code)
			UPDATE ".$TablasCore."informe SET ... WHERE id=$id
		(end)

	Salida:
		Registro de informe actualizado

	Ver tambien:

		<detalles_informe>
*/
if ($accion=="actualizar_informe")
	{
		$mensaje_error="";
		if ($titulo=="") $mensaje_error.="Debe indicar un t&iacute;tulo v&aacute;lido para el informe.<br>";
		if ($categoria=="") $mensaje_error.="Debe indicar un nombre v&aacute;lido para la categor&iacute;a asociada al informe.<br>";
		if ($mensaje_error=="")
			{
				// Actualiza los datos
				ejecutar_sql_unaria("UPDATE ".$TablasCore."informe SET titulo='$titulo',descripcion='$descripcion',categoria='$categoria',nivel_usuario='$nivel_usuario' WHERE id='$id'");
				// Lleva a auditoria
				ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Actualiza informe $id','$fecha_operacion','$hora_operacion')");
				echo '<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
			}
		else
			{
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="editar_informe">
					<input type="Hidden" name="informe" value="'.$id.'">
					<input type="Hidden" name="error_titulo" value="Problema en los datos ingresados">
					<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
	}



/* ################################################################## */
/* ################################################################## */


	if ($accion=="guardar_tabla_informe")
		{
			$mensaje_error="";
			if ($titulo=="") $mensaje_error="Debe indicar un t&iacute;tulo o etiqueta v&aacute;lida para el campo.";
			if ($campo=="") $mensaje_error="Debe indicar un campo v&aacute;lido para vincular con la tabla de datos asociada al formulario.";
			if ($mensaje_error=="")
				{
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."formulario_campo VALUES (0, '$titulo','$campo','$ayuda_titulo','$ayuda_texto','$formulario','$peso','$columna','$obligatorio','$visible','$valor_predeterminado','$validacion_datos','$etiqueta_busqueda','$ajax_busqueda','$valor_unico','$solo_lectura','$teclado_virtual')");
					// Lleva a auditoria
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Crea campo $id para formulario $formulario','$fecha_operacion','$hora_operacion')");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="accion" value="editar_formulario">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="popup_activo" value="FormularioCampos">
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="editar_formulario">
						<input type="Hidden" name="error_titulo" value="Problema en los datos ingresados">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */


if ($accion=="editar_informe")
	{
		// Busca datos del informe
		$resultado_informe=ejecutar_sql("SELECT * FROM ".$TablasCore."informe WHERE id=$informe");
		$registro_informe = $resultado_informe->fetch();
  ?>

		<!-- INICIO DE MARCOS POPUP -->

		<div id='FormularioTablas' class="FormularioPopUps">
				<?php
				abrir_ventana('Agregar una nueva tabla al informe','#BDB9B9',''); 
				?>
				<form name="datosform" id="datosform" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="accion" value="guardar_tabla_informe">
				<input type="Hidden" name="nombre_tabla" value="<?php echo $nombre_tabla; ?>">
				<input type="Hidden" name="formulario" value="<?php echo $formulario; ?>">
				<div align=center>

					<table class="TextosVentana">
						<tr>
							<td align="right">Tabla de datos:</td>
							<td>
								<select  name="tabla_datos" class="Combos" >
									<option value="">Seleccione una</option>
									 <?php
											$resultado=consultar_tablas();
											while ($registro = $resultado->fetch())
												{
													// Imprime solamente las tablas de aplicacion, es decir, las que no cumplen prefijo de internas de Practico
													if (strpos($registro[0],$TablasCore)===FALSE)  // Booleana requiere === o !==
														echo '<option value="'.$registro[0].'" >'.str_replace($TablasApp,'',$registro[0]).'</option>';
												}		
									?>
								</select><a href="#" title="Campo obligatorio" name=""><img src="img/icn_12.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td>
								</form>
								
							</td>
							<td>
								<input type="Button"  class="Botones" value="Agregar tabla" onClick="document.datosform.submit()">
							</td>
						</tr>
					</table>
			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="Cerrar" onClick="OcultarPopUp(\'FormularioTablas\')">';
				cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>






		<div id='FondoPopUps' class="FondoOscuroPopUps"></div>
		<?php
			// Habilita el popup activo
			if (@$popup_activo=="FormularioTablas")	echo '<script type="text/javascript">	AbrirPopUp("FormularioTablas"); </script>';
			//if (@$popup_activo=="FormularioBotones")	echo '<script type="text/javascript">	AbrirPopUp("FormularioBotones"); </script>';
			//if (@$popup_activo=="FormularioDiseno")	echo '<script type="text/javascript">	AbrirPopUp("FormularioDiseno"); </script>';
			//if (@$popup_activo=="FormularioAcciones")	echo '<script type="text/javascript">	AbrirPopUp("FormularioAcciones"); </script>';
		?>

		<table><tr><td valign=top>
			<?php 
				abrir_ventana('Barra de herramientas','#BDB9B9',''); 
			?>
				<div align=center>
				Tablas de datos origen<br>
				<a href='javascript:AbrirPopUp("FormularioTablas");' title="Agregar tabla de datos al informe" name=" "><img border='0' src='img/icono_tabla.png'/></a>
				<hr>




				Campos de datos<br>
				<a href='javascript:AbrirPopUp("FormularioCampos");' title="Agregar campo de datos" name=" "><img border='0' src='img/icono_campo.png'/></a>
				&nbsp;&nbsp;
				<a href='javascript:AbrirPopUp("FormularioDiseno");' title="Dise&ntilde;o general de campos"><img border='0' src='img/icono_diseno.png'/></a>
				<hr>
				Acciones, botones y comandos<br>
				<a href='javascript:AbrirPopUp("FormularioBotones");' title="Agregar bot&oacute;n o acci&oacute;n"><img border='0' src='img/icono_boton.png'/></a>
				&nbsp;&nbsp;
				<a href='javascript:AbrirPopUp("FormularioAcciones");' title="Definici&oacute;n general de acciones"><img border='0' src='img/icono_acciones.png'/></a>
				<hr>
				<form action="<?php echo $ArchivoCORE; ?>" method="POST" name="cancelar"><input type="Hidden" name="accion" value="administrar_informes"></form>
				<input type="Button" onclick="document.cancelar.submit()" value="Volver a lista de informes" class="Botones">
				</div><br>
			<?php
				cerrar_ventana();
			?>
			
		<?php
		echo '</td><td valign=top align=center>';  // Inicia segunda columna del diseñador
		?>


			<?php abrir_ventana('Editar par&aacute;metros generales del informe','f2f2f2',''); ?>
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="accion" value="actualizar_informe">
			<input type="Hidden" name="id" value="<?php echo $registro_informe['id']; ?>">

				<table class="TextosVentana">
					<tr>
						<td align="right">T&iacute;tulo del informe:</td>
						<td><input type="text" name="titulo" value="<?php echo $registro_informe['titulo']; ?>" size="20" class="CampoTexto">
							<a href="#" title="Campo obligatorio" name=""><img src="img/icn_12.gif" border=0></a>
							<a href="#" title="Ayuda r&aacute;pida:" name="Texto que aparecer&aacute; en la parte superior del informe generado"><img src="img/icn_10.gif" border=0></a>
						</td>
					</tr>
					<tr>
						<td align="right">Descripci&oacute;n</td>
						<td><input type="text" name="descripcion" size="20" value="<?php echo $registro_informe['descripcion']; ?>" class="CampoTexto"><a href="#" title="Ayuda r&aacute;pida:" name="Texto descriptivo del informe.  No aparece en su generaci&oacute;n pero es usado para orientar al usuario en su selecci&oacute;n"><img src="img/icn_10.gif" border=0></a>	</td>
					</tr>
					<tr>
						<td align="right">Categor&iacute;a</td>
						<td><input type="text" name="categoria" value="<?php echo $registro_informe['categoria']; ?>" size="20" class="CampoTexto">
							<a href="#" title="Campo obligatorio" name=""><img src="img/icn_12.gif" border=0></a>
							<a href="#" title="Ayuda r&aacute;pida:" name="Cuando el usuario tiene acceso al panel de informes del sistema estos son clasificados por categor&iacute;as.  Ingrese aqui un nombre de categor&iacute;a bajo el cual desee presentar este informe a los usuarios."><img src="img/icn_10.gif" border=0></a>
						</td>
					</tr>
					<tr>
						<td align="RIGHT" valign="TOP"><strong>Nivel de usuario</strong></td>
						<td>
							<select  name="nivel_usuario" id="nivel_usuario" class="Combos">
								<option value="-1" <?php if ($registro_informe["nivel_usuario"]=="-1") echo 'selected'; ?> >Todos los usuarios</option>
								<option value="1"  <?php if ($registro_informe["nivel_usuario"]=="1") echo 'selected'; ?> >&#9733;</option>
								<option value="2"  <?php if ($registro_informe["nivel_usuario"]=="2") echo 'selected'; ?> >&#9733;&#9733;</option>
								<option value="3"  <?php if ($registro_informe["nivel_usuario"]=="3") echo 'selected'; ?> >&#9733;&#9733;&#9733;</option>
								<option value="4"  <?php if ($registro_informe["nivel_usuario"]=="4") echo 'selected'; ?> >&#9733;&#9733;&#9733;&#9733;</option>
								<option value="5"  <?php if ($registro_informe["nivel_usuario"]=="5") echo 'selected'; ?> >&#9733;&#9733;&#9733;&#9733;&#9733; SuperAdmin</option>
							</select>
							<a href="#" title="Quienes pueden ver este informe?" name="Indique el perfil de usuario que se debe tener para ver este informe como disponible."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="right">Im&aacute;gen de ayuda</td>
						<td>
							<select  name="ayuda_imagen" class="Combos" >
								<option value="">Deshabilitado</option>
							</select>
						</td>
					</tr>

					<tr>
						<td>
							</form>
						</td>
						<td>
							<input type="Button"  class="Botones" value="Actualizar informe" onClick="document.datos.submit()">
						</td>
					</tr>
				</table>
			<?php
				cerrar_ventana();
			?>

	<?php
		echo '</td></tr></table>'; // Cierra la tabla de dos columnas
	}



/* ################################################################## */
/* ################################################################## */
if ($accion=="eliminar_informe")
	{
		$mensaje_error="";
		if ($mensaje_error=="")
			{
				ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe WHERE id='$informe'");
				ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_campos WHERE informe='$informe'");
				ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_tablas WHERE informe='$informe'");
				ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_condiciones WHERE informe='$informe'");
				ejecutar_sql_unaria("DELETE FROM ".$TablasCore."usuario_informe WHERE informe='$informe'");
				// Lleva a auditoria
				ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Elimina informe $id','$fecha_operacion','$hora_operacion')");
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="accion" value="administrar_informes"></form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
		else
			{
				mensaje('<blink>Error eliminando informe!</blink>','El informe especificado no se puede eliminar.','60%','icono_error.png','TextosEscritorio');
				echo '<form action="'.$ArchivoCORE.'" method="POST" name="cancelar"><input type="Hidden" name="accion" value="administrar_informes"></form>
					<br /><input type="Button" onclick="document.cancelar.submit()" name="" value="Cerrar" class="Botones">';
			}
	}



/* ################################################################## */
/* ################################################################## */
if ($accion=="guardar_informe")
	{
		$mensaje_error="";
		if ($titulo=="") $mensaje_error.="Debe indicar un t&iacute;tulo v&aacute;lido para el informe.<br>";
		if ($categoria=="") $mensaje_error.="Debe indicar un nombre v&aacute;lido para la categor&iacute;a asociada al informe.<br>";
		if ($mensaje_error=="")
			{
				ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe VALUES (0, '$titulo','$descripcion','$categoria','$agrupamiento','$ordenamiento','$nivel_usuario')");
				$id=$ConexionPDO->lastInsertId();
				// Lleva a auditoria
				ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Crea informe $id','$fecha_operacion','$hora_operacion')");
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
				<input type="Hidden" name="accion" value="editar_informe">
				<input type="Hidden" name="informe" value="'.$id.'"></form>
							<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
		else
			{
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="administrar_informes">
					<input type="Hidden" name="error_titulo" value="Problema en los datos ingresados">
					<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
	}



/* ################################################################## */
/* ################################################################## */
if ($accion=="administrar_informes")
	{
		 ?>

		<table class="TextosVentana"><tr><td valign=top>
			<?php abrir_ventana('Agregar nuevo informe','f2f2f2',''); ?>
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="accion" value="guardar_informe">
			<div align=center>
						
			<br>Defina los detalles del informe:
				<table class="TextosVentana">
					<tr>
						<td align="right">T&iacute;tulo del informe:</td>
						<td><input type="text" name="titulo" size="20" class="CampoTexto">
							<a href="#" title="Campo obligatorio" name=""><img src="img/icn_12.gif" border=0></a>
							<a href="#" title="Ayuda r&aacute;pida:" name="Texto que aparecer&aacute; en la parte superior del informe generado"><img src="img/icn_10.gif" border=0></a>
						</td>
					</tr>
					<tr>
						<td align="right">Descripci&oacute;n</td>
						<td><input type="text" name="descripcion" size="20" class="CampoTexto"><a href="#" title="Ayuda r&aacute;pida:" name="Texto descriptivo del informe.  No aparece en su generaci&oacute;n pero es usado para orientar al usuario en su selecci&oacute;n"><img src="img/icn_10.gif" border=0></a>	</td>
					</tr>
					<tr>
						<td align="right">Categor&iacute;a</td>
						<td><input type="text" name="categoria" size="20" class="CampoTexto">
							<a href="#" title="Campo obligatorio" name=""><img src="img/icn_12.gif" border=0></a>
							<a href="#" title="Ayuda r&aacute;pida:" name="Cuando el usuario tiene acceso al panel de informes del sistema estos son clasificados por categor&iacute;as.  Ingrese aqui un nombre de categor&iacute;a bajo el cual desee presentar este informe a los usuarios."><img src="img/icn_10.gif" border=0></a>
						</td>
					</tr>
					<tr>
						<td align="RIGHT" valign="TOP"><strong>Nivel de usuario</strong></td>
						<td>
							<select  name="nivel_usuario" id="nivel_usuario" class="Combos">
								<option value="-1" <?php if ($registro["nivel_usuario"]=="-1") echo 'selected'; ?> >Todos los usuarios</option>
								<option value="1"  <?php if ($registro["nivel_usuario"]=="1") echo 'selected'; ?> >&#9733;</option>
								<option value="2"  <?php if ($registro["nivel_usuario"]=="2") echo 'selected'; ?> >&#9733;&#9733;</option>
								<option value="3"  <?php if ($registro["nivel_usuario"]=="3") echo 'selected'; ?> >&#9733;&#9733;&#9733;</option>
								<option value="4"  <?php if ($registro["nivel_usuario"]=="4") echo 'selected'; ?> >&#9733;&#9733;&#9733;&#9733;</option>
								<option value="5"  <?php if ($registro["nivel_usuario"]=="5") echo 'selected'; ?> >&#9733;&#9733;&#9733;&#9733;&#9733; SuperAdmin</option>
							</select>
							<a href="#" title="Quienes pueden ver este informe?" name="Indique el perfil de usuario que se debe tener para ver este informe como disponible."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="right">Im&aacute;gen de ayuda</td>
						<td>
							<select  name="ayuda_imagen" class="Combos" >
								<option value="">Deshabilitado</option>
							</select>
						</td>
					</tr>

					<tr>
						<td>
							</form>
						</td>
						<td>
							<input type="Button"  class="Botones" value="Crear y dise&ntilde;ar" onClick="document.datos.submit()">
							&nbsp;&nbsp;<input type="Button" onclick="document.core_ver_menu.submit()" value="Volver al menu" class="Botones">
						</td>
					</tr>
				</table>


		<?php
		cerrar_ventana();	
		
		echo '</td><td valign=top>';  // Inicia segunda columna del diseñador
		abrir_ventana('Informes ya definidos en el sistema','f2f2f2','');
		?>
				<table width="100%" border="0" cellspacing="5" align="CENTER"  class="TextosVentana">
					<tr>
						<td bgcolor="#d6d6d6"><b>Id</b></td>
						<td bgcolor="#D6D6D6"><b>Titulo</b></td>
						<td bgcolor="#d6d6d6"><b>Categor&iacute;a</b></td>
						<td></td>
						<td></td>
					</tr>
		 <?php

				$consulta_forms=ejecutar_sql("SELECT * FROM ".$TablasCore."informe ORDER BY titulo");
				while($registro = $consulta_forms->fetch())
					{
						echo '<tr>
								<td><b>'.$registro["id"].'</b></td>
								<td>'.$registro["titulo"].'</td>
								<td>'.$registro["categoria"].'</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST" name="df'.$registro["id"].'" id="df'.$registro["id"].'">
												<input type="hidden" name="accion" value="eliminar_informe">
												<input type="hidden" name="informe" value="'.$registro["id"].'">
												<input type="button" value="Eliminar"  class="BotonesCuidado" onClick="confirmar_evento(\'IMPORTANTE:  Al eliminar el informe los usuarios no podr&aacute;n accesarlo nuevamente para operaciones de consulta definidas en &eacute;l y no podr&aacute; deshacer esta operaci&oacute;n. Esto tambien elimina cualquier dise&ntilde;o interno del informe.\nEst&aacute; seguro que desea continuar ?\',df'.$registro["id"].');">
										</form>
								</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST">
												<input type="hidden" name="accion" value="editar_informe">
												<input type="hidden" name="informe" value="'.$registro["id"].'">
												<input type="Submit" value="Campos, Tablas y Condiciones"  class="Botones">
										</form>
								</td>
							</tr>';
					}
				echo '</table>';			
		?>

			</div>
<?php
			cerrar_ventana();
		echo '</td></tr></table>'; // Cierra la tabla de dos columnas
					
	}
?>
