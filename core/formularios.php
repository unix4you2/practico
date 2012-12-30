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

			$consulta_campos_unicos=ejecutar_sql("SELECT * FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND visible=1 AND valor_unico=1");
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
			$consulta_campos_unicos=ejecutar_sql("SELECT * FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND visible=1 AND valor_unico=1");
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

					$consulta_campos=ejecutar_sql("SELECT * FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND visible=1");
					while ($registro_campos = $consulta_campos->fetch())
						{
							//Agrega el campo a la lista solamente si es de datos (objetos de tipo etiqueta o iframes son pasados por alto)
							if ($registro_campos["tipo"]!="url_iframe" && $registro_campos["tipo"]!="etiqueta" && $registro_campos["tipo"]!="informe")
								{
									$lista_campos.=$registro_campos["campo"].",";
									$lista_valores.="'".$$registro_campos["campo"]."',";
									if ($registro_campos["campo"]=="id")
										$existe_id=1;
								}
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
					ejecutar_sql_unaria("DELETE FROM ".$TablasCore."formulario_objeto WHERE id='$campo' ");
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
			if ($titulo=="" && ($tipo_objeto!="etiqueta" && $tipo_objeto!="url_iframe" && $tipo_objeto!="informe" && $tipo_objeto!="frm") ) $mensaje_error="Debe indicar un t&iacute;tulo o etiqueta v&aacute;lida para el campo.";
			if ($campo==""  && ($tipo_objeto!="etiqueta" && $tipo_objeto!="url_iframe" && $tipo_objeto!="informe" && $tipo_objeto!="frm") ) $mensaje_error="Debe indicar un campo v&aacute;lido para vincular con la tabla de datos asociada al formulario.";
			if ($mensaje_error=="")
				{
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."formulario_objeto VALUES (0,'$tipo_objeto','$titulo','$campo','$ayuda_titulo','$ayuda_texto','$formulario','$peso','$columna','$obligatorio','$visible','$valor_predeterminado','$validacion_datos','$etiqueta_busqueda','$ajax_busqueda','$valor_unico','$solo_lectura','$teclado_virtual','$ancho','$alto','$barra_herramientas','$fila_unica','$lista_opciones','$origen_lista_opciones','$origen_lista_valores','$valor_etiqueta','$url_iframe','$objeto_en_ventana','$informe_vinculado')");
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

		<script TYPE="text/javascript" LANGUAGE="JavaScript">
			function OcultarCampos(cantidad_campos_existentes)
				{
					for (i=1;i<=cantidad_campos_existentes;i++)
						{
							var formdiv = document.getElementById("campo"+i);
							formdiv.style.display="none";
						}
				}
			function VisualizarCampos(formdiv_ids)
				{
					var parametros = formdiv_ids;
					var lista_campos = parametros.split(',');

					for (i=0;i<lista_campos.length;i++)
						{
							var formdiv = document.getElementById("campo"+lista_campos[i]);
							formdiv.style.display="block";
						}
				}
			//Cambia los campos visibles en el formulario segun el select
			function CambiarCamposVisibles(tipo_objeto_activo)
				{
					// Oculta todos los campos (se debe indicar el valor maximo de los id dados a campoXX
					OcultarCampos(24);
					// Muestra campos segun tipo de objeto
					if (tipo_objeto_activo=="texto_corto")   VisualizarCampos("1,2,3,4,5,6,7,8,9,10,11,12,13,17");
					if (tipo_objeto_activo=="texto_largo")   VisualizarCampos("1,2,6,7,8,9,10,14,15,17");
					if (tipo_objeto_activo=="texto_formato") VisualizarCampos("1,2,6,7,8,9,10,14,15,16,17");
					if (tipo_objeto_activo=="lista_seleccion") VisualizarCampos("1,2,7,8,9,10,17,18,19,20");
					if (tipo_objeto_activo=="etiqueta")   VisualizarCampos("9,17,21");
					if (tipo_objeto_activo=="url_iframe")   VisualizarCampos("9,14,15,17,22,24");
					if (tipo_objeto_activo=="informe")   VisualizarCampos("9,17,23,24");
					//Vuelve a centrar el formulario de acuerdo al nuevo contenido
					AbrirPopUp("FormularioCampos");
				}
		</script>


		<!-- INICIO DE MARCOS POPUP -->

		<div id='FormularioCampos' class="FormularioPopUps">
				<?php 
				abrir_ventana('Agregar un elemento al formulario','#BDB9B9',''); 
				?>
				<form name="datosform" id="datosform" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="accion" value="guardar_campo_formulario">
				<input type="Hidden" name="nombre_tabla" value="<?php echo $nombre_tabla; ?>">
				<input type="Hidden" name="formulario" value="<?php echo $formulario; ?>">
				<div align=center>


					<table class="TextosVentana">
						<tr>
							<td align="right">Tipo de objeto que desea agregar</td>
							<td>
								<select  name="tipo_objeto" class="Combos" OnChange="CambiarCamposVisibles(this.options[this.selectedIndex].value);">
									<option value="0">SELECCIONE UNO</option>
									<optgroup label="Controles de datos">
										<option value="texto_corto">Campo de texto corto</option>
										<option value="texto_largo">Campo de texto libre</option>
										<option value="texto_formato">Campo de texto con formato enriquecido</option>
										<option value="lista_seleccion">Campo de selecci&oacute;n (ComboBox)</option>
									</optgroup>
									<!--
									<optgroup label="Informaci&oacute;n externa">
										<option value="archivo_adjunto">Archivo adjunto</option>
									</optgroup>
									-->
									<optgroup label="Presentaci&oacute;n y otros contenidos">
										<option value="etiqueta">Texto enriquecido (como etiqueta)</option>
										<option value="url_iframe">URL embebida (IFrame)</option>
									</optgroup>
									<optgroup label="Objetos internos">
										<option value="informe">Informe predise&ntilde;ado (Tabla de datos o Gr&aacute;fico)</option>
										<!--<option value="frm">Formulario anidado</option>-->
									</optgroup>
								</select>
								<a href="#" title="Campo obligatorio" name=""><img src="img/icn_12.gif" border=0></a>
							</td>
						</tr>
						</table>
						<hr>
 
 
						<div id='campo1' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">T&iacute;tulo o etiqueta:</td>
								<td width="400" ><input type="text" name="titulo" size="20" class="CampoTexto">
									<a href="#" title="Campo obligatorio" name=""><img src="img/icn_12.gif" border=0></a>
									<a href="#" title="Ayuda r&aacute;pida:" name="Texto que aparecer&aacute; al lado del indicando al usuario la informacion que debe ingresar.  Puede usar HTML b&aacute;sico para dar formato adicional."><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo2' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">Campo enlazado</td>
								<td width="400" >
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
									<a href="#" title="Campo obligatorio para controles de datos" name=""><img src="img/icn_12.gif" border=0></a>
									<a href="#" title="Ayuda r&aacute;pida:" name="Campo de la tabla de datos al cual se vincular&aacute; la informaci&oacute;n"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo3' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">Campo de valor &uacute;nico:</td>
								<td width="400" >
									<input type="checkbox" value=1 name="valor_unico">
									<a href="#" title="Unicidad para los valores ingresados" name="Indica si el campo puede almacenar o no valores repetidos en la base de datos.  Deber&iacute;a estar habilitado para campos que representen claves primarias en su dise&ntilde;o y deshabilitado para el resto."><img src="img/icn_10.gif" border=0></a>	</td>
							</tr>
							</table>
						</div>


						<div id='campo4' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">Valor predeterminado:</td>
								<td width="400" ><input type="text" name="valor_predeterminado" size="20" class="CampoTexto">
									<a href="#" title="Ayuda r&aacute;pida:" name="Establece el valor que aparece diligenciado automaticamente en el campo al abrir la vista del formulario.  Este valor puede estar en contravia de la validaci&oacute;n de datos."><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo5' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">Validacion de datos:</td>
								<td width="400" >
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
							</table>
						</div>


						<div id='campo6' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">Campo de solo lectura</td>
								<td width="400" >
									<select  name="solo_lectura" class="Combos" >
										<option value="READONLY">Si</option>
										<option value="" selected>No</option>
									</select>
									<a href="#" title="Define si se puede cambiar su valor" name="Propiedad util para campos o formuarios de consulta por parte del usuario donde se requiere visualizar el valor pero no permitir su modificacion"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo7' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">T&iacute;tulo de ayuda</td>
								<td width="400" ><input type="text" name="ayuda_titulo" size="20" class="CampoTexto"><a href="#" title="Ayuda r&aacute;pida:" name="Texto que aparecer&aacute; como encabezado para el texto de ayuda del campo explicando al usuario qu&eacute; debe ingresar."><img src="img/icn_10.gif" border=0></a>	</td>
							</tr>
							</table>
						</div>


						<div id='campo8' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200"   valign="top" align="right">Texto de ayuda</td>
								<td width="400"  colspan=2 valign="top">
									<textarea name="ayuda_texto" cols="25" rows="2" class="AreaTexto" onkeypress="return FiltrarTeclas(this, event)"></textarea>
								<a href="#" title="Ayuda r&aacute;pida:" name="Texto completo con la descripcion de funciones resumida para el campo.  Puede incluir instrucciones de formato, advertencias o cualquier otro mensaje para el usuario."><img align="top" src="img/icn_10.gif" border=0></a>	</td>
							</tr>
							</table>
						</div>


						<div id='campo9' style="display:none;">
							<table class="TextosVentana">
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
							</table>
						</div>


						<div id='campo10' style="display:none;">
							<table class="TextosVentana">
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
							</table>
						</div>


						<div id='campo11' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">Utilizar para b&uacute;squedas? Etiqueta:</td>
								<td width="400" ><input type="text" name="etiqueta_busqueda" size="10" class="CampoTexto"><a href="#" title="Indica si el campo es usado para buscar registros" name="Deje el espacio en blanco para indicar que es un campo normal o ingrese la etiqueta que debe ir en el boton de comando ubicado al lado derecho del campo para realizar la busqueda de registros."><img src="img/icn_10.gif" border=0></a>	</td>
							</tr>
							</table>
						</div>


						<div id='campo12' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">Usar AJAX para buscar:</td>
								<td width="400" >
									<input type="checkbox" value=1 name="ajax_busqueda" checked>
								<a href="#" title="Modo de recuperaci&oacute;n de registros:" name="Cuando la casilla se encuentra activada Practico intenta recuperar la informaci&oacute;n del registro para el formulario mediante AJAX, de lo contrario se utiliza el metodo est&aacute;ndar de envio de solicitud y recarga de la p&aacute;gina con los resultados.  Puede ser deshabilitado para mejorar compatibilidad con navegadores viejos."><img src="img/icn_10.gif" border=0></a>	</td>
							</tr>
							</table>
						</div>


						<div id='campo13' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">Agregar teclado virtual:</td>
								<td width="400" >
									<select  name="teclado_virtual" class="Combos" >
										<option value="1">Si</option>
										<option value="0" selected>No</option>
									</select>
								<a href="#" title="Ingreso de informaci&oacute;n sin teclado" name="Cuando es habilitado en el formulario se despliega un teclado virtual para el ingreso de informaci&oacute;n;.  Por ahora el uso del teclado puede violar las validaciones."><img src="img/icn_10.gif" border=0></a>	</td>
							</tr>
							</table>
						</div>


						<div id='campo14' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">Ancho:</td>
								<td width="400" ><input type="text" name="ancho" size="4" class="CampoTexto">
									<a href="#" title="Cu&aacute;nto espacio de ancho debe ocupar el control" name="IMPORTANTE: en n&uacute;mero de caracteres para texto simple o en pixeles para texto con formato. Indique un n&uacute;mero de columnas, sin embargo, tenga presente que el ancho en pixeles ser&aacute; variable de acuerdo al tipo de fuente utilizada por el tema actual."><img src="img/icn_10.gif" border=0></a>
									<i>(M&iacute;nimo recomendado en campos con formato: 350)</i>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo15' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">Alto (l&iacute;neas):</td>
								<td width="400" ><input type="text" name="alto" size="4" class="CampoTexto">
									<a href="#" title="Cu&aacute;ntas filas deben estar visibles en el control?" name="IMPORTANTE: en n&uacute;mero de filas para texto simple o en pixeles para texto con formato.  En caso que el texto supere el n&uacute;mero de filas se agregar&aacute;n autom&aacute;ticamente barras de desplazamiento."><img src="img/icn_10.gif" border=0></a>
									<i>(M&iacute;nimo recomendado en campos con formato: 100)</i>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo16' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">Barra de edici&oacute;n:</td>
								<td width="400" >
									<select  name="barra_herramientas" class="Combos" >
										<option value="0">B&aacute;sica: Documento, formato de caracter y p&aacute;rrafo</option>
										<option value="1">Est&aacute;ndar: B&aacute;sica + Enlaces, estilos de fuente</option>
										<option value="2">Extendida: Est&aacute;ndar + Portapapeles, buscar-reemplazar y ortograf&iacute;a</option>
										<option value="3">Avanzada: Extendida + Insertar objetos y colores</option>
										<option value="4">Completa: Avanzada +  Formularios y pantalla completa</option>
									</select>
									<a href="#" title="Tipo de editor utilizado:" name="Indica el tipo de barra de herramientas que aparecer&aacute; en la parte superior del control y que permitir&aacute; realizar al usuario las diferentes tareas de edici&oacute;n del texto. IMPORTANTE: Cada tipo de editor requiere un espacio diferente en el formulario ya que debe desplegar un n&uacute;mero de iconos y opciones diferentes."><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo17' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">Fila &uacute;nica para este objeto?</td>
								<td width="400" >
									<select  name="fila_unica" class="Combos" >
										<option value="0">No</option>
										<option value="1">Si</option>
									</select>
									<a href="#" title="Se debe utilizar una fila completa para el objeto?" name="Permite desplegar el objeto en una fila exclusiva de la tabla usada en el formulario."><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo18' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">Lista de opciones:</td>
								<td width="400" ><input type="text" name="lista_opciones" size="30" class="CampoTexto">
									<a href="#" title="Qu&eacute; opciones aparecen para ser escogidas" name="Ingrese una lista de opciones separadas por coma.  Si requiere tomar las opciones din&aacute;micamente desde otra tabla de la aplicaci&oacute;n utilice los campos de Origen de datos para opciones.  En caso de llenar ambas opciones (lista fija y origen de datos) el resultado ser&aacute; su combinaci&oacute;n."><img src="img/icn_10.gif" border=0></a>
									(Separadas por coma)
								</td>
							</tr>
							</table>
						</div>


						<div id='campo19' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">Origen de la lista de opciones:</td>
								<td width="400" >
									<select  name="origen_lista_opciones" class="Combos" >
										<option value="">Seleccione uno</option>
									<?php
										$resultado=consultar_tablas();
										while ($registro = $resultado->fetch())
											{
												// Imprime solamente las tablas de aplicacion, es decir, las que no cumplen prefijo de internas de Practico
												if (strpos($registro[0],$TablasCore)===FALSE)  // Booleana requiere === o !==
													{
														echo '<optgroup label="'.str_replace($TablasApp,'',$registro[0]).'" >';
														//Busca los campos de la tabla
														$nombre_tabla=$registro[0];
														$resultado_campos=ejecutar_sql("DESCRIBE $nombre_tabla ");
														while($registro_campos = $resultado_campos->fetch())
															{
																echo '<option value="'.$nombre_tabla.'.'.$registro_campos["Field"].'">'.$registro_campos["Field"].'</option>';
															}
														echo '</optgroup>';
													}
											}
									?>
									</select>
									<a href="#" title="Debe especificar el mismo origen de la lista de valores" name=""><img src="img/icn_12.gif" border=0></a>
									<a href="#" title="Que es esto?" name="Campo desde el cual se toman las opciones que despliega la lista."><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo20' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">Origen de la lista de valores:</td>
								<td width="400" >
									<select  name="origen_lista_valores" class="Combos" >
										<option value="">Seleccione uno</option>
									<?php
										$resultado=consultar_tablas();
										while ($registro = $resultado->fetch())
											{
												// Imprime solamente las tablas de aplicacion, es decir, las que no cumplen prefijo de internas de Practico
												if (strpos($registro[0],$TablasCore)===FALSE)  // Booleana requiere === o !==
													{
														echo '<optgroup label="'.str_replace($TablasApp,'',$registro[0]).'" >';
														//Busca los campos de la tabla
														$nombre_tabla=$registro[0];
														$resultado_campos=ejecutar_sql("DESCRIBE $nombre_tabla ");
														while($registro_campos = $resultado_campos->fetch())
															{
																echo '<option value="'.$nombre_tabla.'.'.$registro_campos["Field"].'">'.$registro_campos["Field"].'</option>';
															}
														echo '</optgroup>';
													}
											}
									?>
									</select>
									<a href="#" title="Debe especificar el mismo origen de la lista de opciones" name=""><img src="img/icn_12.gif" border=0></a>
									<a href="#" title="Que es esto?" name="Campo desde el cual se toman los valores internos (a ser procesados) para cada opcion de la lista."><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo21' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td colspan=2>
									Valor de la etiqueta (ser&aacute; impresa en el formulario en formato HTML):<br>
									<textarea cols="100" rows="20" name="valor_etiqueta" id="valor_etiqueta" class="ckeditor"></textarea>
									<script type="text/javascript" src="inc/ckeditor/ckeditor.js"></script>
									<script type="text/javascript">
										CKEDITOR.replace( 'valor_etiqueta', {	toolbar : [ 
											['-']
											['Source','-','NewPage','DocProps','Preview','Print','-','Templates']
											['Bold', 'Italic', 'Underline', 'Strike', 'Subscript','Superscript','-','RemoveFormat']
											['NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl']
											['Link','Unlink','Anchor']
											['Styles','Format','Font','FontSize']
											['Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo']
											['Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt']
											['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe']
											['TextColor','BGColor']
											['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField']
											['Maximize', 'ShowBlocks']
										 ] } );
										CKEDITOR.config.width = '550';
										CKEDITOR.config.height = '450';
									</script>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo22' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">URL para IFrame:</td>
								<td width="400" ><input type="text" name="url_iframe" size="40" class="CampoTexto">
									<a href="#" title="Ayuda r&aacute;pida:" name="Ingrese la direcci&oacute;n de la p&aacute;gina que sera embebida en el marco."><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo23' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">Informe vinculado:</td>
								<td width="400" >
									<select  name="informe_vinculado" class="Combos">
									<option value="">SELECCIONE UNO</option>
									<?php
										$consulta_informs=ejecutar_sql("SELECT * FROM ".$TablasCore."informe ORDER BY titulo");
										while($registro_informes = $consulta_informs->fetch())
											{
												echo '<option value="'.$registro_informes["id"].'">(Id.'.$registro_informes["id"].') '.$registro_informes["titulo"].'</option>';
											}
									?>
									</select>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo24' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right">Ventana propia para el objeto?</td>
								<td width="400" >
									<select  name="objeto_en_ventana" class="Combos" >
										<option value="0">No</option>
										<option value="1">Si</option>
									</select>
									<a href="#" title="Ayuda importante!" name="No se recomienda activar este campo cuando desee empotrar informes de tipo GRAFICA."><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


					<table class="TextosVentana">
						<tr>
							<td>
								</form>
							</td>
							<td>
								<input type="Button"  class="Botones" value="Agregar objeto/campo" onClick="document.datosform.submit()">
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
								<a href="#" title="Ayuda r&aacute;pida:" name="Nombre de la acci&oacute;n definida en el archivo de personalizaci&oacute;n que procesar&aacute; la informaci&oacute;n o comando en JavaScript a ser ejecutado de manera inmediata en la p&aacute;gina (si requiere par&aacute;metros dentro de su comando utilice comillas sencillas para encerrarlos). Para cargar objetos de Pr&aacute;ctico como formularios o informes puede usar la misma notaci&oacute;n de menus: frm:XX:Par1:Par2:ParN o inf:XX...  El comando javascript ImprimirMarco('seccion_impresion') le permite imprimir el contenido del formulario."><img src="img/icn_10.gif" border=0></a>
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
							<td bgcolor="#D6D6D6"><b>Titulo (Tipo)</b></td>
							<td bgcolor="#d6d6d6"><b>Campo</b></td>
							<td bgcolor="#d6d6d6"><b>Columna</b></td>
							<td bgcolor="#d6d6d6"><b>Peso</b></td>
							<td bgcolor="#d6d6d6"><b>Obligatorio</b> <a href="#" title="Importante:" name="Tenga presente que los campos obligatorios deber&iacute;an estar visibles."><img src="img/icn_10.gif" align="absmiddle" border=0></a></td>
							<td bgcolor="#d6d6d6"><b>Visible</b></td>
							<td></td>
							<td></td>
						</tr>
			 <?php


				$consulta=ejecutar_sql("SELECT * FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' ORDER BY columna,peso,titulo");
				while($registro = $consulta->fetch())
					{
						$peso_aumentado=$registro["peso"]+1;
						if ($registro["peso"]-1>=1) $peso_disminuido=$registro["peso"]-1; else $peso_disminuido=1;
						echo '<tr>
								<td><b>'.$registro["titulo"].'</b> ('.$registro["tipo"].')</td>
								<td><b>'.$registro["campo"].'</b></td>
								<td align=center>
									<form action="'.$ArchivoCORE.'" method="POST" name="ifoc'.$registro["id"].'" id="ifoc'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
										<input type="hidden" name="accion" value="cambiar_estado_campo">
										<input type="hidden" name="id" value="'.$registro["id"].'">
										<input type="hidden" name="tabla" value="formulario_objeto">
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
											<input type="hidden" name="tabla" value="formulario_objeto">
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
											<input type="hidden" name="tabla" value="formulario_objeto">
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
											<input type="hidden" name="tabla" value="formulario_objeto">
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
												<input type="hidden" name="tabla" value="formulario_objeto">
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
				Objetos y Campos de datos<br>
				<a href='javascript:AbrirPopUp("FormularioCampos");' title="Agregar un objeto o campo de datos" name=" "><img border='0' src='img/icono_campo.png'/></a>
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
					ejecutar_sql_unaria("DELETE FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario'");
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
