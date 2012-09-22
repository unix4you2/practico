<?php
			/*
				Title: Modulo formularios
				Ubicacion *[/core/formularios.php]*.  Archivo de funciones relacionadas con la administracion de formularios de la aplicacion.
			*/
?>
<?php
			/*
				Section: Operaciones basicas de administracion
				Funciones asociadas al mantenimiento de formularios en el sistema.
			*/
?>



<?php
/* ################################################################## */
/* ################################################################## */
	if ($accion=="eliminar_datos_formulario")
		{
			$mensaje_error="";

			// Busca datos del formulario
			$consulta_formulario=ejecutar_sql("SELECT * FROM ".$TablasCore."formulario WHERE id='$formulario'");
			$registro_formulario = $consulta_formulario->fetch();

			// Busca los campos del form marcados como valor unico y verifica que no existan valores en la tabla
			$tabla=$registro_formulario["tabla_datos"];

			$consulta_campos_unicos=ejecutar_sql("SELECT * FROM ".$TablasCore."formulario_campo WHERE formulario='$formulario' AND visible=1 AND valor_unico=1");
			while ($registro_campos_unicos = $consulta_campos_unicos->fetch())
				{
					$campo=$registro_campos_unicos["campo"];
					$valor=$$campo;
					// Busca si el campo cuenta con el valor en la tabla

					// Inserta los datos
					ejecutar_sql_unaria("DELETE FROM ".$tabla." WHERE $campo='$valor'");
					// Lleva a auditoria
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Inserta registro en ".$registro_formulario["tabla_datos"]."','$fecha_operacion','$hora_operacion')");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="editar_formulario">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="popup_activo" value="FormularioCampos">
					<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
				}
		}



/* ################################################################## */
/* ################################################################## */
	if ($accion=="guardar_datos_formulario")
		{
			// POR CORREGIR:  Si el diseno cuenta con varios campos que ven hacia un mismo campo de base de datos el query no es valido

			$mensaje_error="";

			// Busca datos del formulario
			$consulta_formulario=ejecutar_sql("SELECT * FROM ".$TablasCore."formulario WHERE id='$formulario'");
			$registro_formulario = $consulta_formulario->fetch();

			// Busca los campos del form marcados como valor unico y verifica que no existan valores en la tabla
			$tabla=$registro_formulario["tabla_datos"];
			$consulta_campos_unicos=ejecutar_sql("SELECT * FROM ".$TablasCore."formulario_campo WHERE formulario='$formulario' AND visible=1 AND valor_unico=1");
			while ($registro_campos_unicos = $consulta_campos_unicos->fetch())
				{
					$campo=$registro_campos_unicos["campo"];
					$valor=$$campo;
					// Busca si el campo cuenta con el valor en la tabla
					$consulta_existente=ejecutar_sql("SELECT id FROM ".$tabla." WHERE $campo='$valor'");
					$registro_existente = $consulta_existente->fetch();
					if ($registro_existente["id"]!="")
						$mensaje_error.="Ha ocurrido un error de valor duplicado en el(los) campo(s): $campo . El valor ingresado ya existe en la base de datos.";
				}

			//Ejecuta consulta de insercion de datos
			if ($mensaje_error=="")
				{
					// Busca los campos del form y construye cadenas de valores para consulta
					$lista_campos="";
					$lista_valores="";
					$existe_id=0; // Define si dentro de los valores recibidos esta o no el ID autonumerico.  Sino se agrega

					$consulta_campos=ejecutar_sql("SELECT * FROM ".$TablasCore."formulario_campo WHERE formulario='$formulario' AND visible=1");
					while ($registro_campos = $consulta_campos->fetch())
						{
							$lista_campos.=$registro_campos["campo"].",";
							$lista_valores.="'".$$registro_campos["campo"]."',";
							if ($registro_campos["campo"]=="id")
								$existe_id=1;
						}
					// Elimina comas al final de las listas
					$lista_campos=substr($lista_campos, 0, strlen($lista_campos)-1);
					$lista_valores=substr($lista_valores, 0, strlen($lista_valores)-1);
					// Agrega el autoincremento en caso de no recibirlo
					if (!$existe_id)
						{
							$lista_campos="id,".$lista_campos;
							$lista_valores="'0',".$lista_valores;
						}

					// Inserta los datos
					ejecutar_sql_unaria("INSERT INTO ".$registro_formulario["tabla_datos"]." (".$lista_campos.") VALUES (".$lista_valores.")");
					// Lleva a auditoria
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Inserta registro en ".$registro_formulario["tabla_datos"]."','$fecha_operacion','$hora_operacion')");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="editar_formulario">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="popup_activo" value="FormularioCampos">
					<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<!-- <input type="Hidden" name="accion" value="editar_formulario"> -->
						<input type="Hidden" name="accion" value="Ver_menu">
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
	if ($accion=="eliminar_accion_formulario")
		{
			$mensaje_error="";
			if ($mensaje_error=="")
				{
					// Crea la tabla temporal
					ejecutar_sql_unaria("DELETE FROM ".$TablasCore."formulario_boton WHERE id='$boton' ");
					// Lleva a auditoria
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Elimina accion del formulario $formulario','$fecha_operacion','$hora_operacion')");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="editar_formulario">
					<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
					<input type="Hidden" name="formulario" value="'.$formulario.'">
					<input type="Hidden" name="popup_activo" value="FormularioAcciones">
					</form>
							<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					mensaje('<blink>Error eliminando tabla de datos!</blink>','La acci&oacute;n especificada no se puede eliminar.','60%','icono_error.png','TextosEscritorio');
					echo '<form action="'.$ArchivoCORE.'" method="POST" name="cancelar"><input type="Hidden" name="accion" value="administrar_tablas"></form>
						<br /><input type="Button" onclick="document.cancelar.submit()" name="" value="Cerrar" class="Botones">';
				}
		}



/* ################################################################## */
/* ################################################################## */
	if ($accion=="eliminar_campo_formulario")
		{
			$mensaje_error="";
			if ($mensaje_error=="")
				{
					// Crea la tabla temporal
					ejecutar_sql_unaria("DELETE FROM ".$TablasCore."formulario_campo WHERE id='$campo' ");
					// Lleva a auditoria
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Elimina campo del formulario $formulario','$fecha_operacion','$hora_operacion')");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="editar_formulario">
					<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
					<input type="Hidden" name="formulario" value="'.$formulario.'">
					<input type="Hidden" name="popup_activo" value="FormularioDiseno">
					</form>
							<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					mensaje('<blink>Error eliminando tabla de datos!</blink>','El campo especificado no se puede eliminar.','60%','icono_error.png','TextosEscritorio');
					echo '<form action="'.$ArchivoCORE.'" method="POST" name="cancelar"><input type="Hidden" name="accion" value="administrar_tablas"></form>
						<br /><input type="Button" onclick="document.cancelar.submit()" name="" value="Cerrar" class="Botones">';
				}
		}



/* ################################################################## */
/* ################################################################## */
	if ($accion=="guardar_campo_formulario")
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
	if ($accion=="guardar_accion_formulario")
		{
			$mensaje_error="";
			if ($titulo=="") $mensaje_error="Debe indicar un t&iacute;tulo o etiqueta v&aacute;lida para el bot&oacute;n.";
			if ($tipo_accion=="") $mensaje_error="Debe indicar una acci&oacute;n v&aacute;lido para ser ejecutada cuando se active el control.";
			if ($mensaje_error=="")
				{
					$accion_usuario=addslashes($accion_usuario);
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."formulario_boton VALUES (0, '$titulo','$estilo','$formulario','$tipo_accion','$accion_usuario','$visible','$peso','$retorno_titulo','$retorno_texto','$confirmacion_texto')");
					// Lleva a auditoria
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Crea boton $id para formulario $formulario','$fecha_operacion','$hora_operacion')");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="accion" value="editar_formulario">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="popup_activo" value="FormularioBotones">
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="editar_formulario">
						<input type="Hidden" name="error_titulo" value="Problema en los datos ingresados">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}



/* ################################################################## */
/* ################################################################## */
if ($accion=="editar_formulario")
	{
		  ?>


		<!-- INICIO DE MARCOS POPUP -->

		<div id='FormularioCampos' class="FormularioPopUps">
				<?php 
				abrir_ventana('Agregar un nuevo campo al formulario','#BDB9B9',''); 
				?>
				<form name="datosform" id="datosform" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="accion" value="guardar_campo_formulario">
				<input type="Hidden" name="nombre_tabla" value="<?php echo $nombre_tabla; ?>">
				<input type="Hidden" name="formulario" value="<?php echo $formulario; ?>">
				<div align=center>
							
					<table class="TextosVentana">
						<tr>
							<td align="right">T&iacute;tulo o etiqueta:</td>
							<td ><input type="text" name="titulo" size="20" class="CampoTexto">
								<a href="#" title="Campo obligatorio" name=""><img src="img/icn_12.gif" border=0></a>
								<a href="#" title="Ayuda r&aacute;pida:" name="Texto que aparecer&aacute; al lado del indicando al usuario la informacion que debe ingresar."><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td align="right">Campo enlazado</td>
							<td>
								<select  name="campo" class="Combos" >
									<option value="">Seleccione uno</option>
									<?php
										$resultado=ejecutar_sql("DESCRIBE $nombre_tabla ");
										while($registro = $resultado->fetch())
											{
												echo '<option value="'.$registro["Field"].'" >'.$registro["Field"].'&nbsp;&nbsp;&nbsp;['.$registro["Type"].']</option>';
											}							
									?>
								</select>
							<a href="#" title="Campo obligatorio" name=""><img src="img/icn_12.gif" border=0></a>
							<a href="#" title="Ayuda r&aacute;pida:" name="Campo de la tabla de datos al cual se vincular&aacute; la informaci&oacute;n"><img src="img/icn_10.gif" border=0></a>	</td>
						</tr>
						<tr>
							<td align="right">Campo de valor &uacute;nico:</td>
							<td>
								<input type="checkbox" value=1 name="valor_unico" checked>
								<a href="#" title="Unicidad para los valores ingresados" name="Indica si el campo puede almacenar o no valores repetidos en la base de datos.  Deber&iacute;a estar habilitado para campos que representen claves primarias en su dise&ntilde;o y deshabilitado para el resto."><img src="img/icn_10.gif" border=0></a>	</td>
						</tr>
						<tr>
							<td align="right">Valor predeterminado:</td>
							<td ><input type="text" name="valor_predeterminado" size="20" class="CampoTexto">
								<a href="#" title="Ayuda r&aacute;pida:" name="Establece el valor que aparece diligenciado automaticamente en el campo al abrir la vista del formulario.  Este valor puede estar en contravia de la validaci&oacute;n de datos."><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td align="right">Validacion de datos:</td>
							<td >
								<select  name="validacion_datos" class="Combos" >
									<option value="">Ninguna</option>
									<option value="numerico">S&oacute;lo n&uacute;meros 0-9</option>
									<option value="alfabetico">S&oacute;lo letras A-Z</option>
									<option value="alfanumerico">Letras y n&uacute;meros</option>
									<option value="fecha">Campo de fecha</option>
								</select>
								<a href="#" title="Ayuda r&aacute;pida:" name="Tipo de filtro a ser aplicado cuando el usuario ingresa informaci&oacute;n por teclado."><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td align="right">Campo de solo lectura</td>
							<td >
								<select  name="solo_lectura" class="Combos" >
									<option value="READONLY">Si</option>
									<option value="" selected>No</option>
								</select>
								<a href="#" title="Define si se puede cambiar su valor" name="Propiedad util para campos o formuarios de consulta por parte del usuario donde se requiere visualizar el valor pero no permitir su modificacion"><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td align="right">T&iacute;tulo de ayuda</td>
							<td ><input type="text" name="ayuda_titulo" size="20" class="CampoTexto"><a href="#" title="Ayuda r&aacute;pida:" name="Texto que aparecer&aacute; como encabezado para el texto de ayuda del campo explicando al usuario qu&eacute; debe ingresar."><img src="img/icn_10.gif" border=0></a>	</td>
						</tr>
						<tr>
							<td   valign="top" align="right">Texto de ayuda</td>
							<td  colspan=2 valign="top"><textarea name="ayuda_texto" cols="25" rows="1" class="AreaTexto" onkeypress="return FiltrarTeclas(this, event)"><?php echo str_replace("<br>", "\r\n", $registro["ayuda_facturacion"]);  ?></textarea>
							<a href="#" title="Ayuda r&aacute;pida:" name="Texto completo con la descripcion de funciones resumida para el campo.  Puede incluir instrucciones de formato, advertencias o cualquier otro mensaje para el usuario."><img align="top" src="img/icn_10.gif" border=0></a>	</td>
						</tr>
						<tr>
							<td colspan=2>
							<table width="100%" class="TextosVentana"><tr>
								<td align="right">Peso:</td>
								<td>
									<select name="peso" class="selector_01" >
										<?php
											for ($i=1;$i<=100;$i++)
												echo '<option value="'.$i.'">'.$i.'</option>';
										?>
									</select><a href="#" title="Ayuda r&aacute;pida:" name="Posicion en la que aparece el campo dentro del formulario cuando este se despliega en pantalla. Orden."><img align="top" src="img/icn_10.gif" border=0></a>
								</td>
								<td align="right">Columna</td>
								<td>
									<select name="columna" class="selector_01" >
										<?php
											// Obtiene numero de columnas para el formulario
											$consulta_columnas=ejecutar_sql("SELECT columnas FROM ".$TablasCore."formulario WHERE id='$formulario' ");
											$registro_columnas = $consulta_columnas->fetch();
											$columnas_formulario=$registro_columnas["columnas"];
											for ($i=1;$i<=$columnas_formulario;$i++)
												echo '<option value="'.$i.'">'.$i.'</option>';
										?>
									</select><a href="#" title="Ayuda r&aacute;pida:" name="Columna para ubicar el campo cuando la vista del formulario tenga varias columnas. Aquellos campos en columnas superiores a las definidas en el formulario no ser&aacute;n dibujados."><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr></table>
							</td>
						</tr>
						<tr>
							<td colspan=2>
							<table width="100%" class="TextosVentana"><tr>
							<td align="right">Obligatorio</td>
							<td>
								<select  name="obligatorio" class="Combos" >
									<option value="1">Si</option>
									<option value="0" selected>No</option>
								</select>
							</td>
							<td align="right">Visible</td>
							<td>
								<select  name="visible" class="Combos" >
									<option value="1">Si</option>
									<option value="0">No</option>
								</select><a href="#" title="Ayuda r&aacute;pida:" name="Determina si el control es visible o no para el usuario.  Si se deja como No el control es usado pero como un campo oculto."><img src="img/icn_10.gif" border=0></a>
							</td>
							</tr></table>
							</td>
						</tr>
						<tr>
							<td align="right">Utilizar para b&uacute;squedas? Etiqueta:</td>
							<td ><input type="text" name="etiqueta_busqueda" size="10" class="CampoTexto"><a href="#" title="Indica si el campo es usado para buscar registros" name="Deje el espacio en blanco para indicar que es un campo normal o ingrese la etiqueta que debe ir en el boton de comando ubicado al lado derecho del campo para realizar la busqueda de registros."><img src="img/icn_10.gif" border=0></a>	</td>
						</tr>
						<tr>
							<td align="right">Usar AJAX para buscar:</td>
							<td>
								<input type="checkbox" value=1 name="ajax_busqueda" checked>
							<a href="#" title="Modo de recuperaci&oacute;n de registros:" name="Cuando la casilla se encuentra activada Practico intenta recuperar la informaci&oacute;n del registro para el formulario mediante AJAX, de lo contrario se utiliza el metodo est&aacute;ndar de envio de solicitud y recarga de la p&aacute;gina con los resultados.  Puede ser deshabilitado para mejorar compatibilidad con navegadores viejos."><img src="img/icn_10.gif" border=0></a>	</td>
						</tr>
						<tr>
							<td align="right">Agregar teclado virtual:</td>
							<td>
								<select  name="teclado_virtual" class="Combos" >
									<option value="1">Si</option>
									<option value="0" selected>No</option>
								</select>
							<a href="#" title="Ingreso de informaci&oacute;n sin teclado" name="Cuando es habilitado en el formulario se despliega un teclado virtual para el ingreso de informaci&oacute;n;.  Por ahora el uso del teclado puede violar las validaciones."><img src="img/icn_10.gif" border=0></a>	</td>
						</tr>
						<tr>
							<td>
								</form>
								
							</td>
							<td>
								<input type="Button"  class="Botones" value="Agregar campo" onClick="document.datosform.submit()">
							</td>
						</tr>
					</table>
			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="Cerrar" onClick="OcultarPopUp(\'FormularioCampos\')">';
				cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>

		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioBotones' class="FormularioPopUps">
			<?php
			abrir_ventana('Agregar botones y acciones al formulario','BDB9B9','');
			?>
				<form name="datosfield" id="datosfield" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="accion" value="guardar_accion_formulario">
				<input type="Hidden" name="nombre_tabla" value="<?php echo $nombre_tabla; ?>">
				<input type="Hidden" name="formulario" value="<?php echo $formulario; ?>">
				<div align=center>
							
					<table class="TextosVentana">
						<tr>
							<td align="right">T&iacute;tulo o etiqueta:</td>
							<td ><input type="text" name="titulo" size="20" class="CampoTexto">
								<a href="#" title="Campo obligatorio" name=""><img src="img/icn_12.gif" border=0></a>
								<a href="#" title="Ayuda r&aacute;pida:" name="Texto que aparecer&aacute; sobre el bot&oacute;n."><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td align="right">Estilo</td>
							<td>
								<select  name="estilo" class="Combos" >
									<option value="BotonesEstado">Predeterminado - bot&oacute;n normal</option>
									<option value="BotonesEstadoCuidado">Boton de acci&oacute;n que requiere cuidado</option>
								</select>
							<a href="#" title="Ayuda r&aacute;pida:" name="Apariencia gr&aacute;fica del control"><img src="img/icn_10.gif" border=0></a>	</td>
						</tr>
						<tr>
							<td align="right">Tipo de acci&oacute;n</td>
							<td>
								<select  name="tipo_accion" class="Combos" >
									<option value="">Seleccione una</option>
									<optgroup label="Acciones internas">
										<option value="interna_guardar">Guardar datos</option>
										<option value="interna_limpiar">Limpiar datos</option>
										<option value="interna_eliminar">Eliminar datos</option>
										<option value="interna_escritorio">Regresar a escritorio</option>
										<option value="interna_cargar">Cargar un objeto</option>
									</optgroup>
									<optgroup label="Definidas por el usuario">
										<option value="externa_formulario">En personalizadas.php</option>
										<option value="externa_javascript">Comando en JavaScript</option>
									</optgroup>
								</select>
							<a href="#" title="Campo obligatorio" name=""><img src="img/icn_12.gif" border=0></a>
							<a href="#" title="Ayuda r&aacute;pida:" name="Comando que deber&aacute; ejecutar el control al ser pulsado.  Para acciones definidas es personalizadas.php los datos del formulario ser&aacute;n enviados a esa rutina para ser procesados."><img src="img/icn_10.gif" border=0></a>	</td>
						</tr>
						<tr>
							<td align="right">Comando del usuario:</td>
							<td ><input type="text" name="accion_usuario" size="20" class="CampoTexto">
								<a href="#" title="Ayuda r&aacute;pida:" name="Nombre de la acci&oacute;n definida en el archivo de personalizaci&oacute;n que procesar&aacute; la informaci&oacute;n o comando en JavaScript a ser ejecutado de manera inmediata en la p&aacute;gina (si requiere par&aacute;metros dentro de su comando utilice comillas sencillas para encerrarlos)."><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td colspan=2>
							<table width="100%" class="TextosVentana"><tr>
								<td align="right">Peso:</td>
								<td>
									<select name="peso" class="selector_01" >
										<?php
											for ($i=1;$i<=20;$i++)
												echo '<option value="'.$i.'">'.$i.'</option>';
										?>
									</select><a href="#" title="Ayuda r&aacute;pida:" name="Posicion en la que aparece el campo dentro de la barra de estado del formulario cuando este se despliega en pantalla. Orden de izquierda a derecha."><img align="top" src="img/icn_10.gif" border=0></a>
								</td>
								<td align="right">Visible</td>
								<td>
									<select  name="visible" class="Combos" >
										<option value="1">Si</option>
										<option value="0">No</option>
									</select><a href="#" title="Ayuda r&aacute;pida:" name="Determina si el control es visible o no para el usuario."><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr></table>
							</td>
						</tr>
						<tr>
							<td align="right">T&iacute;tulo de retorno</td>
							<td ><input type="text" name="retorno_titulo" size="20" class="CampoTexto"><a href="#" title="Ayuda r&aacute;pida:" name="Texto que aparecer&aacute; como encabezado en el escritorio despu&eacute;s de realizar la acci&oacute;n indicada por el usuario."><img src="img/icn_10.gif" border=0></a>	</td>
						</tr>
						<tr>
							<td   valign="top" align="right">Texto de retorno</td>
							<td  colspan=2 valign="top"><textarea name="retorno_texto" cols="25" rows="1" class="AreaTexto"></textarea>
							<a href="#" title="Ayuda r&aacute;pida:" name="Texto completo con la descripci&oacute;n de acci&oacute;n realizada o mensaje entregado al usuario despu&eacute;s de ejecutar el control."><img align="top" src="img/icn_10.gif" border=0></a>	</td>
						</tr>
						<tr>
							<td align="right">Texto de confirmaci&oacute;n</td>
							<td ><input type="text" name="confirmacion_texto" size="20" class="CampoTexto">
							<a href="#" title="Ayuda r&aacute;pida:" name="En caso de ser diligenciado: Texto que aparecer&aacute; como ventana emergente advirtiendo la ejecuci&oacute;n del control y esperando confirmaci&oacute;n del usuario para proceder."><img src="img/icn_10.gif" border=0></a>	</td>
						</tr>

						<tr>
							<td>
								</form>
							</td>
							<td>
								<input type="Button"  class="Botones" value="Agregar acci&oacute;n/bot&oacute;n" onClick="document.datosfield.submit()">
							</td>
						</tr>
					</table>
				</br>
			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="Cerrar" onClick="OcultarPopUp(\'FormularioBotones\')">';
				cerrar_barra_estado();
				cerrar_ventana();		// Cierra adicion de botones
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>



		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioDiseno' class="FormularioPopUps">
			<?php
				abrir_ventana('Dise&ntilde;o general de campos','#BDB9B9','');
			?>
					<table width="100%" border="0" cellspacing="5" align="CENTER" class="TextosVentana">
						<tr>
							<td bgcolor="#D6D6D6"><b>Titulo</b></td>
							<td bgcolor="#d6d6d6"><b>Campo</b></td>
							<td bgcolor="#d6d6d6"><b>Columna</b></td>
							<td bgcolor="#d6d6d6"><b>Peso</b></td>
							<td bgcolor="#d6d6d6"><b>Obligatorio</b> <a href="#" title="Importante:" name="Tenga presente que los campos obligatorios deber&iacute;an estar visibles."><img src="img/icn_10.gif" align="absmiddle" border=0></a></td>
							<td bgcolor="#d6d6d6"><b>Visible</b></td>
							<td></td>
							<td></td>
						</tr>
			 <?php


				$consulta=ejecutar_sql("SELECT * FROM ".$TablasCore."formulario_campo WHERE formulario='$formulario' ORDER BY columna,peso,titulo");
				while($registro = $consulta->fetch())
					{
						$peso_aumentado=$registro["peso"]+1;
						if ($registro["peso"]-1>=1) $peso_disminuido=$registro["peso"]-1;
						echo '<tr>
								<td><b>'.$registro["titulo"].'</b></td>
								<td><b>'.$registro["campo"].'</b></td>
								<td align=center>
									<form action="'.$ArchivoCORE.'" method="POST" name="ifoc'.$registro["id"].'" id="ifoc'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
										<input type="hidden" name="accion" value="cambiar_estado_campo">
										<input type="hidden" name="id" value="'.$registro["id"].'">
										<input type="hidden" name="tabla" value="formulario_campo">
										<input type="hidden" name="campo" value="columna">
										<input type="hidden" name="formulario" value="'.$formulario.'">
										<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
										<input type="hidden" name="accion_retorno" value="editar_formulario">
										<input type="Hidden" name="popup_activo" value="FormularioDiseno">
									
								';
								echo '<select name="valor" class="selector_01" >';
										$i=1;
										while($i <= $columnas_formulario)
											{
												// Determina si la opcion actual es la del registro
												if ($registro["columna"]==$i)
													echo '<option value="'.$i.'" selected>'.$i.'</option>';
												else
													echo '<option value="'.$i.'">'.$i.'</option>';
											    $i++;
											}
						echo '		</select></form> <a href="javascript:ifoc'.$registro["id"].'.submit();" title="Guardar columna" name=""><img src="img/guardar.gif" border=0></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								
								</td>
								<td align=center>
										<form action="'.$ArchivoCORE.'" method="POST" name="ifoce'.$registro["id"].'" id="ifoce'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
											<input type="hidden" name="accion" value="cambiar_estado_campo">
											<input type="hidden" name="id" value="'.$registro["id"].'">
											<input type="hidden" name="tabla" value="formulario_campo">
											<input type="hidden" name="campo" value="peso">
											<input type="hidden" name="formulario" value="'.$formulario.'">
											<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
											<input type="hidden" name="accion_retorno" value="editar_formulario">
											<input type="hidden" name="valor" value="'.$peso_aumentado.'">
											<input type="Hidden" name="popup_activo" value="FormularioDiseno">
										</form>
										<form action="'.$ArchivoCORE.'" method="POST" name="ifopa'.$registro["id"].'" id="ifopa'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
											<input type="hidden" name="accion" value="cambiar_estado_campo">
											<input type="hidden" name="id" value="'.$registro["id"].'">
											<input type="hidden" name="tabla" value="formulario_campo">
											<input type="hidden" name="campo" value="peso">
											<input type="hidden" name="formulario" value="'.$formulario.'">
											<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
											<input type="hidden" name="accion_retorno" value="editar_formulario">
											<input type="hidden" name="valor" value="'.$peso_disminuido.'">
											<input type="Hidden" name="popup_activo" value="FormularioDiseno">
										</form>
									';
								
								if ($registro["campo"]!="id")
									echo '
										<a href="javascript:ifoce'.$registro["id"].'.submit();" title="Aumentar peso (bajar)" name=""><img src="img/bajar.png" border=0></a> 
										'.$registro["peso"].'
										<a href="javascript:ifopa'.$registro["id"].'.submit();" title="Disminuir peso (subir)" name=""><img src="img/subir.png" border=0></a>
										';
								
								echo '</td>';
								
								echo '<td align=center>
										<form action="'.$ArchivoCORE.'" method="POST" name="ifo'.$registro["id"].'" id="ifo'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
											<input type="hidden" name="accion" value="cambiar_estado_campo">
											<input type="hidden" name="id" value="'.$registro["id"].'">
											<input type="hidden" name="tabla" value="formulario_campo">
											<input type="hidden" name="campo" value="obligatorio">
											<input type="hidden" name="formulario" value="'.$formulario.'">
											<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
											<input type="hidden" name="accion_retorno" value="editar_formulario">	
											<input type="Hidden" name="popup_activo" value="FormularioDiseno">								
											';
									if ($registro["campo"]!="id")
										if ($registro["obligatorio"])
											echo '<input type="hidden" name="valor" value="0"><a href="javascript:ifo'.$registro["id"].'.submit();" title="Cambiar estado" name=""><img src="img/on.png" border=0></a>';
										else
											echo '<input type="hidden" name="valor" value="1"><a href="javascript:ifo'.$registro["id"].'.submit();" title="Cambiar estado" name=""><img src="img/off.png" border=0></a>';
								echo '</form></td>';
								
								echo '<td align=center>
											<form action="'.$ArchivoCORE.'" method="POST" name="if'.$registro["id"].'" id="if'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
												<input type="hidden" name="accion" value="cambiar_estado_campo">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="hidden" name="tabla" value="formulario_campo">
												<input type="hidden" name="campo" value="visible">
												<input type="hidden" name="formulario" value="'.$formulario.'">
												<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
												<input type="hidden" name="accion_retorno" value="editar_formulario">
												<input type="Hidden" name="popup_activo" value="FormularioDiseno">
											';
									if ($registro["visible"])
										echo '<input type="hidden" name="valor" value="0"><a href="javascript:if'.$registro["id"].'.submit();" title="Cambiar estado" name=""><img src="img/on.png" border=0></a>';
									else
										echo '<input type="hidden" name="valor" value="1"><a href="javascript:if'.$registro["id"].'.submit();" title="Cambiar estado" name=""><img src="img/off.png" border=0></a>';
								echo '</form></td>';
								if ($registro["peso"]!="0")
									{
										echo '<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" name="f'.$registro["id"].'" id="f'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
														<input type="hidden" name="accion" value="eliminar_campo_formulario">
														<input type="hidden" name="campo" value="'.$registro["id"].'">
														<input type="hidden" name="formulario" value="'.$formulario.'">
														<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
														<input type="button" value="Eliminar"  class="BotonesCuidado" onClick="confirmar_evento(\'IMPORTANTE:  Al eliminar el campo los usuarios no podr&aacute;n verlo  y no podr&aacute; deshacer esta operaci&oacute;n.\nEst&aacute; seguro que desea continuar ?\',f'.$registro["id"].');">
														<input type="Hidden" name="popup_activo" value="FormularioDiseno">
												</form>
										</td>
										<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
														<input type="hidden" name="accion" value="editar_campo_formulario">
														<input type="hidden" name="campo" value="'.$registro["id"].'">
														<input type="hidden" name="formulario" value="'.$formulario.'">
														<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
														<input type="Button" value="Editar (Deshabilitado)"  class="Botones">
														<input type="Hidden" name="popup_activo" value="FormularioDiseno">
												</form>
										</td>';
									}
								else
									{
										echo '<td align="center"></td>
										<td align="center"></td>';
									}
							echo '</tr>';
					}
				echo '</table>';			
			?>
				
			</div>
			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="Cerrar" onClick="OcultarPopUp(\'FormularioDiseno\')">';
				cerrar_barra_estado();
				cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>



		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioAcciones' class="FormularioPopUps">
			<?php
				abrir_ventana('Definici&oacute;n general de acciones y comandos','#BDB9B9','');
			?>
					<table width="100%" border="0" cellspacing="5" align="CENTER" class="TextosVentana">
						<tr>
							<td bgcolor="#D6D6D6"><b>Etiqueta</b></td>
							<td bgcolor="#d6d6d6"><b>Tipo de acci&oacute;n</b></td>
							<td bgcolor="#d6d6d6"><b>Acci&oacute;n Usuario</b></td>
							<td bgcolor="#d6d6d6"><b>Orden</b></td>
							<td bgcolor="#d6d6d6"><b>Visible</b></td>
							<td></td>
							<td></td>
						</tr>
			 <?php
				$consulta_botones=ejecutar_sql("SELECT * FROM ".$TablasCore."formulario_boton WHERE formulario='$formulario' ORDER BY peso,titulo");
				while($registro = $consulta_botones->fetch())
					{
						$peso_aumentado=$registro["peso"]+1;
						if ($registro["peso"]-1>=1) $peso_disminuido=$registro["peso"]-1;
						echo '<tr>
								<td><b>'.$registro["titulo"].'</b></td>
								<td><b>'.$registro["tipo_accion"].'</b></td>
								<td>'.$registro["accion_usuario"].'</td>';
						echo '		<td align=center>
										<form action="'.$ArchivoCORE.'" method="POST" name="bifoce'.$registro["id"].'" id="bifoce'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
											<input type="hidden" name="accion" value="cambiar_estado_campo">
											<input type="hidden" name="id" value="'.$registro["id"].'">
											<input type="hidden" name="tabla" value="formulario_boton">
											<input type="hidden" name="campo" value="peso">
											<input type="hidden" name="formulario" value="'.$formulario.'">
											<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
											<input type="hidden" name="accion_retorno" value="editar_formulario">
											<input type="hidden" name="valor" value="'.$peso_aumentado.'">
											<input type="Hidden" name="popup_activo" value="FormularioAcciones">
										</form>
										<form action="'.$ArchivoCORE.'" method="POST" name="bifopa'.$registro["id"].'" id="bifopa'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
											<input type="hidden" name="accion" value="cambiar_estado_campo">
											<input type="hidden" name="id" value="'.$registro["id"].'">
											<input type="hidden" name="tabla" value="formulario_boton">
											<input type="hidden" name="campo" value="peso">
											<input type="hidden" name="formulario" value="'.$formulario.'">
											<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
											<input type="hidden" name="accion_retorno" value="editar_formulario">
											<input type="hidden" name="valor" value="'.$peso_disminuido.'">
											<input type="Hidden" name="popup_activo" value="FormularioAcciones">
										</form>
									';

									echo '
										<a href="javascript:bifoce'.$registro["id"].'.submit();" title="Aumentar peso (bajar)" name=""><img src="img/bajar.png" border=0></a> 
										'.$registro["peso"].'
										<a href="javascript:bifopa'.$registro["id"].'.submit();" title="Disminuir peso (subir)" name=""><img src="img/subir.png" border=0></a>
										';
								
								echo '</td>';
								
								
								echo '<td align=center>
											<form action="'.$ArchivoCORE.'" method="POST" name="bif'.$registro["id"].'" id="bif'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
												<input type="hidden" name="accion" value="cambiar_estado_campo">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="hidden" name="tabla" value="formulario_boton">
												<input type="hidden" name="campo" value="visible">
												<input type="hidden" name="formulario" value="'.$formulario.'">
												<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
												<input type="hidden" name="accion_retorno" value="editar_formulario">
												<input type="Hidden" name="popup_activo" value="FormularioAcciones">
											';
									if ($registro["visible"])
										echo '<input type="hidden" name="valor" value="0"><a href="javascript:bif'.$registro["id"].'.submit();" title="Cambiar estado" name=""><img src="img/on.png" border=0></a>';
									else
										echo '<input type="hidden" name="valor" value="1"><a href="javascript:bif'.$registro["id"].'.submit();" title="Cambiar estado" name=""><img src="img/off.png" border=0></a>';
								echo '</form></td>';
										echo '<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" name="bf'.$registro["id"].'" id="bf'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
														<input type="hidden" name="accion" value="eliminar_accion_formulario">
														<input type="hidden" name="boton" value="'.$registro["id"].'">
														<input type="hidden" name="formulario" value="'.$formulario.'">
														<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
														<input type="button" value="Eliminar"  class="BotonesCuidado" onClick="confirmar_evento(\'IMPORTANTE:  Al eliminar el bot&oacute;n/acci&oacute;n los usuarios no podr&aacute;n verlo o ejecutar el comando asociado a este y no podr&aacute; deshacer esta operaci&oacute;n luego.\nEst&aacute; seguro que desea continuar ?\',bf'.$registro["id"].');">
														<input type="Hidden" name="popup_activo" value="FormularioAcciones">
												</form>
										</td>
										<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
														<input type="hidden" name="accion" value="editar_campo_formulario">
														<input type="hidden" name="campo" value="'.$registro["id"].'">
														<input type="hidden" name="formulario" value="'.$formulario.'">
														<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
														<input type="Button" value="Editar (Deshabilitado)"  class="Botones">
														<input type="Hidden" name="popup_activo" value="FormularioAcciones">
												</form>
										</td>';

							echo '</tr>';
					}
				echo '</table>';			
			?>
				
			</div>
			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="Cerrar" onClick="OcultarPopUp(\'FormularioAcciones\')">';
				cerrar_barra_estado();
				cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>

		<div id='FondoPopUps' class="FondoOscuroPopUps"></div>
		<?php
			// Habilita el popup activo
			if (@$popup_activo=="FormularioCampos")	echo '<script type="text/javascript">	AbrirPopUp("FormularioCampos"); </script>';
			if (@$popup_activo=="FormularioBotones")	echo '<script type="text/javascript">	AbrirPopUp("FormularioBotones"); </script>';
			if (@$popup_activo=="FormularioDiseno")	echo '<script type="text/javascript">	AbrirPopUp("FormularioDiseno"); </script>';
			if (@$popup_activo=="FormularioAcciones")	echo '<script type="text/javascript">	AbrirPopUp("FormularioAcciones"); </script>';
		?>

		<table><tr><td valign=top>
			<?php 
				abrir_ventana('Barra de herramientas','#BDB9B9',''); 
			?>
				<div align=center>
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
				<form action="<?php echo $ArchivoCORE; ?>" method="POST" name="cancelar"><input type="Hidden" name="accion" value="administrar_formularios"></form>
				<input type="Button" onclick="document.cancelar.submit()" value="Volver a lista de formularios" class="Botones">
				</div><br>
			<?php
				cerrar_ventana();
			?>
			
		<?php
		echo '</td><td valign=top align=center>';  // Inicia segunda columna del diseñador
			cargar_formulario($formulario);
		echo '</td></tr></table>'; // Cierra la tabla de dos columnas
	}



/* ################################################################## */
/* ################################################################## */
	if ($accion=="eliminar_formulario")
		{
			$mensaje_error="";
			if ($mensaje_error=="")
				{
					ejecutar_sql_unaria("DELETE FROM ".$TablasCore."formulario WHERE id='$formulario'");
					ejecutar_sql_unaria("DELETE FROM ".$TablasCore."formulario_campo WHERE formulario='$formulario'");
					// Lleva a auditoria
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Elimina formulario $id','$fecha_operacion','$hora_operacion')");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="accion" value="administrar_formularios"></form>
							<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					mensaje('<blink>Error eliminando formulario!</blink>','El formulario especificado no se puede eliminar.','60%','icono_error.png','TextosEscritorio');
					echo '<form action="'.$ArchivoCORE.'" method="POST" name="cancelar"><input type="Hidden" name="accion" value="administrar_formularios"></form>
						<br /><input type="Button" onclick="document.cancelar.submit()" name="" value="Cerrar" class="Botones">';
				}
		}



/* ################################################################## */
/* ################################################################## */
	if ($accion=="guardar_formulario")
		{
			$mensaje_error="";
			if ($titulo=="") $mensaje_error.="Debe indicar un t&iacute;tulo v&aacute;lido para el formulario.<br>";
			if ($tabla_datos=="") $mensaje_error.="Debe indicar un nombre v&aacute;lido para la tabla de datos asociada al formulario.<br>";
			if ($mensaje_error=="")
				{
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."formulario VALUES (0, '$titulo','$ayuda_titulo','$ayuda_texto','$ayuda_imagen','$tabla_datos','$columnas')");
					$id=$ConexionPDO->lastInsertId();
					// Lleva a auditoria
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Crea formulario $id para $tabla_datos','$fecha_operacion','$hora_operacion')");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="nombre_tabla" value="'.$tabla_datos.'">
					<input type="Hidden" name="accion" value="editar_formulario">
					<input type="Hidden" name="formulario" value="'.$id.'"></form>
								<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="administrar_formularios">
						<input type="Hidden" name="error_titulo" value="Problema en los datos ingresados">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}



/* ################################################################## */
/* ################################################################## */
if ($accion=="administrar_formularios")
	{
		 ?>

		<table class="TextosVentana"><tr><td valign=top>
			<?php abrir_ventana('Agregar nuevo formulario','f2f2f2',''); ?>
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="accion" value="guardar_formulario">
			<input type="Hidden" name="nombre_tabla" value="<?php echo $nombre_tabla; ?>">
			<div align=center>
						
			<br>Defina los detalles del formulario:
				<table class="TextosVentana">
					<tr>
						<td align="right">T&iacute;tulo de ventana:</td>
						<td><input type="text" name="titulo" size="20" class="CampoTexto">
							<a href="#" title="Campo obligatorio" name=""><img src="img/icn_12.gif" border=0></a>
							<a href="#" title="Ayuda r&aacute;pida:" name="Texto que aparecer&aacute; en la parte superior de la ventana de formulario o barra de t&iacute;tulo"><img src="img/icn_10.gif" border=0></a>
						</td>
					</tr>
					<tr>
						<td align="right">T&iacute;tulo de ayuda</td>
						<td><input type="text" name="ayuda_titulo" size="20" class="CampoTexto"><a href="#" title="Ayuda r&aacute;pida:" name="Texto que aparecer&aacute; como encabezado para el texto de ayuda del formulario"><img src="img/icn_10.gif" border=0></a>	</td>
					</tr>
					<tr>
						<td valign="top" align="right">Texto de ayuda</td>
						<td valign="top"><textarea name="ayuda_texto" cols="25" rows="3" class="AreaTexto" onkeypress="return FiltrarTeclas(this, event)"></textarea>
						<a href="#" title="Ayuda r&aacute;pida:" name="Texto completo con la descripcion de funciones resumida para el formulario.  Puede ser cualquier texto introductorio para el usuario"><img align="top" src="img/icn_10.gif" border=0></a>	</td>
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
						<td align="right">N&uacute;mero columnas</td>
						<td>
							<select name="columnas" class="selector_01" >
								<?php
									for ($i=1;$i<=20;$i++)
										echo '<option value="'.$i.'">'.$i.'</option>';
								?>
							</select><a href="#" title="Ayuda r&aacute;pida:" name="Indica en cuantas columnas deben desplegarse los campos cuando el formulario sea cargado."><img src="img/icn_10.gif" border=0></a>
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
		abrir_ventana('Formularios ya definidos en el sistema','f2f2f2','');
		?>
				<table width="100%" border="0" cellspacing="5" align="CENTER"  class="TextosVentana">
					<tr>
						<td bgcolor="#d6d6d6"><b>Id</b></td>
						<td bgcolor="#D6D6D6"><b>Titulo</b></td>
						<td bgcolor="#d6d6d6"><b>Tabla de datos</b></td>
						<td></td>
						<td></td>
					</tr>
		 <?php

				$consulta_forms=ejecutar_sql("SELECT * FROM ".$TablasCore."formulario ORDER BY titulo");
				while($registro = $consulta_forms->fetch())
					{
						echo '<tr>
								<td><b>'.$registro["id"].'</b></td>
								<td>'.$registro["titulo"].'</td>
								<td>'.str_replace($TablasApp,'',$registro["tabla_datos"]).'</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST" name="df'.$registro["id"].'" id="df'.$registro["id"].'">
												<input type="hidden" name="accion" value="eliminar_formulario">
												<input type="hidden" name="formulario" value="'.$registro["id"].'">
												<input type="button" value="Eliminar"  class="BotonesCuidado" onClick="confirmar_evento(\'IMPORTANTE:  Al eliminar el formulario los usuarios no podr&aacute;n accesarlo nuevamente para operaciones de consulta o ingreso de datos definidas en &eacute;l y no podr&aacute; deshacer esta operaci&oacute;n. Esto tambien elimina cualquier dise&ntilde;o interno del formulario.\nEst&aacute; seguro que desea continuar ?\',df'.$registro["id"].');">
										</form>
								</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST">
												<input type="hidden" name="accion" value="editar_formulario">
												<input type="hidden" name="formulario" value="'.$registro["id"].'">
												<input type="hidden" name="nombre_tabla" value="'.$registro["tabla_datos"].'">
												<input type="Submit" value="Campos y acciones"  class="Botones">
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
