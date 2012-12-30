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
	Function: actualizar_agrupamiento_informe
	Cambia el registro asociado a un informe de la aplicacion para el campo de agrupamiento y ordenamiento

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
if ($accion=="actualizar_agrupamiento_informe")
	{
		$mensaje_error="";
		if ($mensaje_error=="")
			{
				// Actualiza los datos
				ejecutar_sql_unaria("UPDATE ".$TablasCore."informe SET agrupamiento='$agrupamiento',ordenamiento='$ordenamiento' WHERE id='$informe'");
				// Lleva a auditoria
				ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Actualiza agrupamiento/ordenamiento informe $informe','$fecha_operacion','$hora_operacion')");
				echo '
					<form name="regresar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="editar_informe">
					<input type="Hidden" name="informe" value="'.$informe.'">
					</form>
				<script type="" language="JavaScript">
				 document.regresar.submit();  </script>';
			}
		else
			{
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="editar_informe">
					<input type="Hidden" name="informe" value="'.$informe.'">
					<input type="Hidden" name="error_titulo" value="Problema en los datos ingresados">
					<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: actualizar_grafico_informe
	Cambia el registro asociado a un informe de la aplicacion para el campo de formato de graficos

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
if ($accion=="actualizar_grafico_informe")
	{
		$mensaje_error="";
		if ($nombre_serie_1=="" || $campo_etiqueta_serie_1=="" || $campo_valor_serie_1=="") $mensaje_error.="Se debe indicar los valores para los campos correspondientes al menos a una serie de datos.<br>Si no desea generar un gr&aacute;fico entonces debe cambiar el tipo de informe a tabla de datos.";
		if ($mensaje_error=="")
			{
				//Construye la cadena de formato
				$cadena_formato="";
				$cadena_formato.=$tipo_grafico."|";
				$cadena_formato.=$nombre_serie_1."!".$nombre_serie_2."!".$nombre_serie_3."!".$nombre_serie_4."!".$nombre_serie_5."|";
				$cadena_formato.=$campo_etiqueta_serie_1."!".$campo_etiqueta_serie_2."!".$campo_etiqueta_serie_3."!".$campo_etiqueta_serie_4."!".$campo_etiqueta_serie_5."|";
				$cadena_formato.=$campo_valor_serie_1."!".$campo_valor_serie_2."!".$campo_valor_serie_3."!".$campo_valor_serie_4."!".$campo_valor_serie_5;

				// Actualiza los datos
				ejecutar_sql_unaria("UPDATE ".$TablasCore."informe SET formato_grafico='$cadena_formato' WHERE id='$informe'");
				// Lleva a auditoria
				ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Actualiza informe grafico $informe','$fecha_operacion','$hora_operacion')");
				echo '
					<form name="regresar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="editar_informe">
					<input type="Hidden" name="informe" value="'.$informe.'">
					</form>
				<script type="" language="JavaScript">
				 document.regresar.submit();  </script>';
			}
		else
			{
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="editar_informe">
					<input type="Hidden" name="informe" value="'.$informe.'">
					<input type="Hidden" name="error_titulo" value="Problema en los datos ingresados">
					<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
	}


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
				ejecutar_sql_unaria("UPDATE ".$TablasCore."informe SET formato_final='$formato_final', alto='$alto',ancho='$ancho',titulo='$titulo',descripcion='$descripcion',categoria='$categoria',nivel_usuario='$nivel_usuario' WHERE id='$id'");
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


if ($accion=="eliminar_informe_condicion")
	{
		$mensaje_error="";
		if ($mensaje_error=="")
			{
				ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_condiciones WHERE id='$condicion'");
				// Lleva a auditoria
				ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Elimina condicion $campo del informe $informe','$fecha_operacion','$hora_operacion')");
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="editar_informe">
					<input type="Hidden" name="informe" value="'.$informe.'">
					<input type="Hidden" name="popup_activo" value="FormularioCondiciones">
					</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
	}


/* ################################################################## */
/* ################################################################## */


	if ($accion=="guardar_informe_condicion")
		{
			$mensaje_error="";
			$valor_i=$valor_izq.$valor_izq_manual.$operador_logico;
			$valor_d=$valor_der.$valor_der_manual;
			$valor_o=$operador.$operador_manual;
			if ($valor_i=="" && $valor_d=="") $mensaje_error="La condici&oacute;n especificada no es v&aacute;lida o carece de al menos uno de sus lados de comparaci&oacute;n.";
			if ($mensaje_error=="")
				{
					//Busca el peso del ultimo elemento para agregar el nuevo con peso+1
					$peso=1;
					$consulta_peso=ejecutar_sql("SELECT MAX(peso) as peso FROM ".$TablasCore."informe_condiciones WHERE informe='$informe'");
					$registro = $consulta_peso->fetch();
					if($registro[0]!="")$peso=$registro[0] + 1;
					//Agrega la condicion
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_condiciones VALUES (0, '$informe','$valor_i','$valor_o','$valor_d','$peso')");
					// Lleva a auditoria
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Agrega condicion al informe $informe','$fecha_operacion','$hora_operacion')");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="accion" value="editar_informe">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="popup_activo" value="FormularioCondiciones">
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="editar_informe">
						<input type="Hidden" name="error_titulo" value="Problema en los datos ingresados">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
if ($accion=="eliminar_informe_campo")
	{
		$mensaje_error="";
		if ($mensaje_error=="")
			{
				ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_campos WHERE id='$campo'");
				// Lleva a auditoria
				ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Elimina campo $campo del informe $informe','$fecha_operacion','$hora_operacion')");
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="editar_informe">
					<input type="Hidden" name="informe" value="'.$informe.'">
					<input type="Hidden" name="popup_activo" value="FormularioCampos">
					</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
	}


/* ################################################################## */
/* ################################################################## */


	if ($accion=="guardar_informe_campo")
		{
			$mensaje_error="";
			if ($campo_manual.$campo_datos=="") $mensaje_error="Debe indicar un nombre de campo v&aacute;lida para el origen de datos del informe.";
			if ($mensaje_error=="")
				{
					$campo_definitivo=$campo_manual.$campo_datos;
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_campos VALUES (0, '$informe','$campo_definitivo','$alias_manual')");
					// Lleva a auditoria
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Agrega campo $campo_definitivo al informe $informe','$fecha_operacion','$hora_operacion')");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="accion" value="editar_informe">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="popup_activo" value="FormularioCampos">
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="editar_informe">
						<input type="Hidden" name="error_titulo" value="Problema en los datos ingresados">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
if ($accion=="eliminar_informe_tabla")
	{
		$mensaje_error="";
		if ($mensaje_error=="")
			{
				ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_tablas WHERE id='$tabla'");
				// Lleva a auditoria
				ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Elimina tabla $tabla del informe $informe','$fecha_operacion','$hora_operacion')");
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="editar_informe">
					<input type="Hidden" name="informe" value="'.$informe.'">
					<input type="Hidden" name="popup_activo" value="FormularioTablas">
					</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
	}


/* ################################################################## */
/* ################################################################## */


	if ($accion=="guardar_informe_tabla")
		{
			$mensaje_error="";
			if ($tabla_manual.$tabla_datos=="") $mensaje_error="Debe indicar un nombre de tabla v&aacute;lida para el origen de datos del informe.";
			if ($mensaje_error=="")
				{
					$tabla_definitiva=$tabla_manual.$tabla_datos;
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_tablas VALUES (0, '$informe','$tabla_definitiva','$alias_manual')");
					// Lleva a auditoria
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Login_usuario','Agrega tabla $tabla_definitiva al informe $informe','$fecha_operacion','$hora_operacion')");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="accion" value="editar_informe">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="popup_activo" value="FormularioTablas">
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="editar_informe">
						<input type="Hidden" name="error_titulo" value="Problema en los datos ingresados">
						<input type="Hidden" name="informe" value="'.$informe.'">
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
		$resultado_informe=ejecutar_sql("SELECT * FROM ".$TablasCore."informe WHERE id='$informe'");
		$registro_informe = $resultado_informe->fetch();
  ?>

		<!-- INICIO DE MARCOS POPUP -->

		<div id='FormularioTablas' class="FormularioPopUps">
				<?php
				abrir_ventana('Agregar una nueva tabla al informe','#BDB9B9',''); 
				?>
				<form name="datosform" id="datosform" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="accion" value="guardar_informe_tabla">
				<input type="Hidden" name="informe" value="<?php echo $informe; ?>">
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
							<td align="right">Especificar tabla manualmente:</td>
							<td><input type="text" name="tabla_manual" size="20" class="CampoTexto"> (opcional)
								<a href="#" title="Avanzado:" name="En caso de no seleccionar una tabla en la parte superior puede indicar aqu&iacute; el nombre de una tabla.  Esta opci&oacuten es &uacute;til cuando requiere acceder a informaci&oacute;n contenida en tablas internas de Pr&aacute;ctico o tablas creadas mediante otras aplicaciones."><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td align="right">Especificar un alias manualmente:</td>
							<td><input type="text" name="alias_manual" size="20" class="CampoTexto"> (opcional)
								<a href="#" title="Avanzado:" name="Util para definir el nombre de una tabla generada a partir de una subconsulta o indicada manualmente."><img src="img/icn_10.gif" border=0></a>
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
					

				<hr><b>Tablas definidas en este informe</b>
				<table width="100%" border="0" cellspacing="2" align="CENTER"  class="TextosVentana">
					<tr>
						<td bgcolor="#D6D6D6"><b>Tabla</b></td>
						<td bgcolor="#d6d6d6"><b>Alias</b></td>
						<td></td>
					</tr>
				 <?php

						$consulta_forms=ejecutar_sql("SELECT * FROM ".$TablasCore."informe_tablas WHERE informe='$informe' ORDER BY valor_tabla");
						while($registro = $consulta_forms->fetch())
							{
								echo '<tr>
										<td><b>'.$registro["valor_tabla"].'</b></td>
										<td>'.$registro["valor_alias"].'</td>
										<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" name="df'.$registro["id"].'" id="df'.$registro["id"].'">
														<input type="hidden" name="accion" value="eliminar_informe_tabla">
														<input type="hidden" name="tabla" value="'.$registro["id"].'">
														<input type="hidden" name="informe" value="'.$informe.'">
														<input type="button" value="Eliminar"  class="BotonesCuidado" onClick="confirmar_evento(\'IMPORTANTE:  Al eliminar el campo del informe la consulta puede ser inconsistente.\nEst&aacute; seguro que desea continuar ?\',df'.$registro["id"].');">
												</form>
										</td>
									</tr>';
							}
						echo '</table>';
				?>
	
			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="Cerrar" onClick="OcultarPopUp(\'FormularioTablas\')">';
				cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>


		<!-- INICIO DE MARCOS POPUP -->

		<div id='FormularioCampos' class="FormularioPopUps">
				<?php
				abrir_ventana('Agregar un nuevo campo al informe','#BDB9B9',''); 
				?>
				<form name="datosformc" id="datosformc" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="accion" value="guardar_informe_campo">
				<input type="Hidden" name="informe" value="<?php echo $informe; ?>">
				<div align=center>

					<table class="TextosVentana">
						<tr>
							<td align="right">Campo de datos:</td>
							<td>
								<select  name="campo_datos" class="Combos" >
									<option value="">Seleccione uno</option>
									<?php
											$resultado=ejecutar_sql("SELECT valor_tabla FROM ".$TablasCore."informe_tablas WHERE informe='$informe'");
											//$resultado=consultar_tablas();
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
								</select><a href="#" title="Campo obligatorio" name=""><img src="img/icn_12.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td align="right">Especificar campo manualmente:</td>
							<td><input type="text" name="campo_manual" size="20" class="CampoTexto"> (opcional)
								<a href="#" title="Avanzado:" name="En caso de no seleccionar un campo en la parte superior puede indicar aqu&iacute; el nombre de un campo.  Esta opci&oacuten es &uacute;til cuando requiere acceder a informaci&oacute;n contenida en campos internos de Pr&aacute;ctico o campos creadas mediante otras aplicaciones."><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td align="right">Especificar un alias manualmente:</td>
							<td><input type="text" name="alias_manual" size="20" class="CampoTexto"> (opcional)
								<a href="#" title="Avanzado:" name="Util para definir el nombre del campo generada a partir de una subconsulta de agrupaci&oacute;n o indicado manualmente."><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td>
								</form>
								
							</td>
							<td>
								<input type="Button"  class="Botones" value="Agregar campo" onClick="document.datosformc.submit()">
							</td>
						</tr>
					</table>
					

				<hr><b>Campos definidos en este informe</b>
				<table width="100%" border="0" cellspacing="2" align="CENTER"  class="TextosVentana">
					<tr>
						<td bgcolor="#D6D6D6"><b>Campo</b></td>
						<td bgcolor="#d6d6d6"><b>Alias</b></td>
						<td></td>
						<td></td>
					</tr>
				 <?php

						$consulta_forms=ejecutar_sql("SELECT * FROM ".$TablasCore."informe_campos WHERE informe='$informe' ORDER BY valor_campo");
						while($registro = $consulta_forms->fetch())
							{
								echo '<tr>
										<td><b>'.$registro["valor_campo"].'</b></td>
										<td>'.$registro["valor_alias"].'</td>
										<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" name="dfc'.$registro["id"].'" id="dfc'.$registro["id"].'">
														<input type="hidden" name="accion" value="eliminar_informe_campo">
														<input type="hidden" name="campo" value="'.$registro["id"].'">
														<input type="hidden" name="informe" value="'.$informe.'">
														<input type="button" value="Eliminar"  class="BotonesCuidado" onClick="confirmar_evento(\'IMPORTANTE:  Al eliminar el campo del informe la consulta puede ser inconsistente.\nEst&aacute; seguro que desea continuar ?\',dfc'.$registro["id"].');">
												</form>
										</td>
									</tr>';
							}
						echo '</table>';
				?>

			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="Cerrar" onClick="OcultarPopUp(\'FormularioCampos\')">';
				cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>


		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioCondiciones' class="FormularioPopUps">
				<?php
				abrir_ventana('Agregar una nueva condici&oacute;n al informe','#BDB9B9','600'); 
				?>
				<form name="datosformco" id="datosformco" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
					<input type="Hidden" name="accion" value="guardar_informe_condicion">
					<input type="Hidden" name="informe" value="<?php echo $informe; ?>">
					<div align=center>

					<table class="TextosVentana" width="100%">
						<tr>
							<th>
								Primer campo o valor
							</th>
							<th>
								Operador de comparaci&oacute;n
							</th>
							<th>
								Segundo campo o valor
							</th>
						</tr>
						<tr>
							<td align=center valign=top>
								<select  name="valor_izq" class="Combos" >
									<option value="">Vac&iacute;o</option>
									<?php
										$consulta_forms=ejecutar_sql("SELECT * FROM ".$TablasCore."informe_campos WHERE informe='$informe'");
										while($registro = $consulta_forms->fetch())
											{
												echo '<option value="'.$registro["valor_campo"].'">'.$registro["valor_campo"].'</option>';
											}
									?>
								</select><br>
								<input type="text" name="valor_izq_manual" size="20" class="CampoTexto">
							</td>
							<td align=center valign=top>
								<select  name="operador" class="Combos" >
									<option value="">Seleccione uno</option>
									<option value="=">Igual: = </option>
									<option value="<>">Diferente: <> </option>
									<option value=">">Mayor: > </option>
									<option value="<">Menor: < </option>
									<option value=">=">Mayor o Igual: >= </option>
									<option value="<=">Menor o Igual: <= </option>
								</select><br>
								<input type="text" name="operador_manual" size="20" class="CampoTexto">
							</td>
							<td align=center valign=top>
								<select  name="valor_der" class="Combos" >
									<option value="">Vac&iacute;o</option>
									<?php
										$consulta_forms=ejecutar_sql("SELECT * FROM ".$TablasCore."informe_campos WHERE informe='$informe'");
										while($registro = $consulta_forms->fetch())
											{
												echo '<option value="'.$registro["valor_campo"].'">'.$registro["valor_campo"].'</option>';
											}
									?>
								</select><br>
								<input type="text" name="valor_der_manual" size="20" class="CampoTexto">
								<a href="#" title="Ayuda de formato" name="En cualquiera de los campos manuales puede encerrar expresiones o valores tipo cadena de caracteres utilizando comillas dobles."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align=center colspan=3>
								<br>Agregar un agrupador de expresiones o un operador l&oacute;gico 
								<select  name="operador_logico" class="Combos" >
									<option value="">Seleccione uno</option>
									<option value="(">Abrir par&eacute;ntesis - (</option>
									<option value=")">Cerrar par&eacute;ntesis - )</option>
									<option value="AND">AND</option>
									<option value="OR">OR</option>
									<option value="NOT">NOT</option>
									<option value="XOR">XOR</option>
								</select>
								<a href="#" title="Cu&aacute;ndo utilizar esta opci&oacute;n?:" name="Si usted requiere agregar m&aacute;s de una sentencia a su condici&oacute;n de filtrado de resultados o si requiere agrupar varias condiciones para tener precedencia sobre algunas operaciones entonces puede utilizar esta opci&oacute;n.  Trabaja de manera independiente y debe ser agregada como un registro aparte de la consulta."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
								<br><b>Recomendaci&oacute;n:</b> No olvide agregar operadores AND seguidos de cada condici&oacute;n que relacione llaves for&aacute;neas entre las diferentes tablas del informe cuando aplique (generalmente cuando usa m&aacute;s de una tabla).
							</td>
						</tr>
						<tr>
							<td align=center colspan=3>
								<br><input type="Button"  class="Botones" value=" Agregar condicion / operador >>> " onClick="document.datosformco.submit()">
							</td>
						</tr>
					</table>
				</form>

				<hr><b>Condiciones definidas en este informe</b>
				<table width="100%" border="0" cellspacing="2" align="CENTER"  class="TextosVentana">
				 <?php

						$consulta_forms=ejecutar_sql("SELECT * FROM ".$TablasCore."informe_condiciones WHERE informe='$informe' ORDER BY peso");
						while($registro = $consulta_forms->fetch())
							{
								$peso_aumentado=$registro["peso"]+1;
								if ($registro["peso"]-1>=1) $peso_disminuido=$registro["peso"]-1; else $peso_disminuido=1;
								echo '<tr>
										<td align=left>'.$registro["valor_izq"].'</td>
										<td align=left><b>'.$registro["operador"].'</b></td>
										<td align=left>'.$registro["valor_der"].'</td>
										<td align="center">
											<form action="'.$ArchivoCORE.'" method="POST" name="ifoce'.$registro["id"].'" id="ifoce'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
												<input type="hidden" name="accion" value="cambiar_estado_campo">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="hidden" name="tabla" value="informe_condiciones">
												<input type="hidden" name="campo" value="peso">
												<input type="hidden" name="informe" value="'.$informe.'">
												<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
												<input type="hidden" name="accion_retorno" value="editar_informe">
												<input type="hidden" name="valor" value="'.$peso_aumentado.'">
												<input type="Hidden" name="popup_activo" value="FormularioCondiciones">
											</form>
											<form action="'.$ArchivoCORE.'" method="POST" name="ifopa'.$registro["id"].'" id="ifopa'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
												<input type="hidden" name="accion" value="cambiar_estado_campo">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="hidden" name="tabla" value="informe_condiciones">
												<input type="hidden" name="campo" value="peso">
												<input type="hidden" name="informe" value="'.$informe.'">
												<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
												<input type="hidden" name="accion_retorno" value="editar_informe">
												<input type="hidden" name="valor" value="'.$peso_disminuido.'">
												<input type="Hidden" name="popup_activo" value="FormularioCondiciones">
											</form>';
										if ($registro["campo"]!="id")
											echo '
												<a href="javascript:ifoce'.$registro["id"].'.submit();" title="Aumentar peso (bajar)" name=""><img src="img/bajar.png" border=0></a> 
												'.$registro["peso"].'
												<a href="javascript:ifopa'.$registro["id"].'.submit();" title="Disminuir peso (subir)" name=""><img src="img/subir.png" border=0></a>
												';
								echo '		
										</td>
										<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" name="dfco'.$registro["id"].'" id="dfco'.$registro["id"].'">
														<input type="hidden" name="accion" value="eliminar_informe_condicion">
														<input type="hidden" name="condicion" value="'.$registro["id"].'">
														<input type="hidden" name="informe" value="'.$informe.'">
														<input type="button" value="Eliminar"  class="BotonesCuidado" onClick="confirmar_evento(\'IMPORTANTE:  Al eliminar la condici&oacute;n del informe la consulta puede ser inconsistente.\nEst&aacute; seguro que desea continuar ?\',dfco'.$registro["id"].');">
												</form>
										</td>
									</tr>';
							}
						echo '</table>';
				?>

			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="Cerrar" onClick="OcultarPopUp(\'FormularioCondiciones\')">';
				cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>


		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioGraficos' class="FormularioPopUps">
				<?php
				abrir_ventana('Especifica tipos de gr&aacute;fico a generar por el informe','#BDB9B9','600'); 
				?>
				<form name="datosformcograf" id="datosformcograf" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
					<input type="Hidden" name="accion" value="actualizar_grafico_informe">
					<input type="Hidden" name="informe" value="<?php echo $informe; ?>">

				<!-- SELECCION DE SERIES  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
				<hr>
				<div align=center><b>SERIES PARA EL GRAFICO</b> - Gr&aacute;ficos con m&uacute;ltiples series deben devolver el mismo n&uacute;mero de etiquetas</div>
						<table class="TextosVentana" width="100%">
						<?php
							//Consulta el formato de grafico y datos de series para ponerlo en los campos
							//Dado por: Tipo|Nombre1!NombreN|Etiqueta1!EtiquetaN|Valor1!ValorN|
							$consulta_formato_grafico=ejecutar_sql("SELECT formato_grafico FROM ".$TablasCore."informe WHERE id='$informe'");
							$registro_formato = $consulta_formato_grafico->fetch();
							$formato_base=explode("|",$registro_formato["formato_grafico"]);
							$tipo_grafico_leido=$formato_base[0];
							$lista_nombre_series=explode("!",$formato_base[1]);
							$lista_etiqueta_series=explode("!",$formato_base[2]);
							$lista_valor_series=explode("!",$formato_base[3]);

							//Crea las series
							$numero_series=5;
							for ($cs=1;$cs<=$numero_series;$cs++)
								{
						?>
							<tr>
								<td align="center" valign="TOP">
									<b>Nombre de la Serie <?php echo $cs; ?></b><br>
									<input type="text" name="nombre_serie_<?php echo $cs; ?>" value="<?php echo $lista_nombre_series[$cs-1]; ?>" maxlength="20" size="20" class="CampoTexto">
								</td>
								<td align="center" valign="TOP">
									<b>Campo de etiqueta</b><br>
									<select name="campo_etiqueta_serie_<?php echo $cs; ?>" class="Combos" >
										<option value=""></option>
										<?php
										$consulta_forms=ejecutar_sql("SELECT * FROM ".$TablasCore."informe_campos WHERE informe='$informe'");
										while($registro = $consulta_forms->fetch())
											{
												$estado_seleccionado="";
												$cadena_alias="";
												if ($lista_etiqueta_series[$cs-1]==$registro["valor_campo"] || $lista_etiqueta_series[$cs-1]==$registro["valor_campo"]." AS ".$registro["valor_alias"]) $estado_seleccionado="SELECTED";
												if ($registro["valor_alias"]!="") $cadena_alias=" AS ".$registro["valor_alias"];
												echo '<option value="'.$registro["valor_campo"].$cadena_alias.'" '.$estado_seleccionado.'>'.$registro["valor_campo"].$cadena_alias.'</option>';
											}
									?>
									</select>
								</td>
								<td align="center" valign="TOP">
									<b>Campo de valor (debe ser num&eacute;rico)</b><br>
									<select name="campo_valor_serie_<?php echo $cs; ?>" class="Combos">
										<option value=""></option>
									<?php
										$consulta_forms=ejecutar_sql("SELECT * FROM ".$TablasCore."informe_campos WHERE informe='$informe'");
										while($registro = $consulta_forms->fetch())
											{
												$estado_seleccionado="";
												$cadena_alias="";
												if ($lista_valor_series[$cs-1]==$registro["valor_campo"] || $lista_valor_series[$cs-1]==$registro["valor_campo"]." AS ".$registro["valor_alias"]) $estado_seleccionado="SELECTED";
												if ($registro["valor_alias"]!="") $cadena_alias=" AS ".$registro["valor_alias"];
												echo '<option value="'.$registro["valor_campo"].$cadena_alias.'" '.$estado_seleccionado.'>'.$registro["valor_campo"].$cadena_alias.'</option>';
											}
									?>
									</select>
								</td>
							</tr>
							
						<?php
							} // Fin del for que crea series
						?>
						</table>

			<!-- SELECCION DEL TIPO DE GRAFICO  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
				<hr>
						<div align=center><b>APARIENCIA y DISTRIBUCION</b> - Seleccione de acuerdo al n&uacute;mero de series deseadas</div>
						<table class="TextosVentana">
							<tr>
								<td align="LEFT" valign="TOP">
									<b>Tipo de gr&aacute;fico:</b><br>
									<select name="tipo_grafico" class="Combos" >
											<option value="barrah" <?php if ($tipo_grafico_leido=="barrah") echo "SELECTED"; ?>>Barras horizontales</option>
											<option value="barrah_multiples" <?php if ($tipo_grafico_leido=="barrah_multiples") echo "SELECTED"; ?>>Barras horizontales (multiples series)</option>
											<option value="linea" <?php if ($tipo_grafico_leido=="linea") echo "SELECTED"; ?>>Grafico de linea</option>
											<option value="linea_multiples" <?php if ($tipo_grafico_leido=="linea_multiples") echo "SELECTED"; ?>>Grafico de linea (multiples series)</option>
											<option value="barrav" <?php if ($tipo_grafico_leido=="barrav") echo "SELECTED"; ?>>Barras verticales</option>
											<option value="barrav_multiples" <?php if ($tipo_grafico_leido=="barrav_multiples") echo "SELECTED"; ?>>Barras verticales (multiples series)</option>
											<option value="torta" <?php if ($tipo_grafico_leido=="torta") echo "SELECTED"; ?>>Grafico de torta (solo una serie)</option>
									</select>
								</td>
								<td align="RIGHT">
									<img src="img/tipos_grafico.png" border=0 alt="">
								</td>
							</tr>
						</table>
				</form>
				<hr><center>
				<input type="Button"  class="Botones" value="Actualizar formato del gr&aacute;fico >>>" onClick="document.datosformcograf.submit()">
				<br><br><br>
				</center>
			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="Cerrar" onClick="OcultarPopUp(\'FormularioGraficos\')">';
				cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>


		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioAgrupacion' class="FormularioPopUps">
				<?php
				abrir_ventana('Especifica criterios de agrupaci&oacute;n y ordenamiento','#BDB9B9','600'); 
				$consulta_agrupacion=ejecutar_sql("SELECT ordenamiento,agrupamiento FROM ".$TablasCore."informe WHERE id='$informe'");
				$registro_agrupacion = $consulta_agrupacion->fetch();
				?>
				<form name="datosformcogrup" id="datosformcogrup" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
					<input type="Hidden" name="accion" value="actualizar_agrupamiento_informe">
					<input type="Hidden" name="informe" value="<?php echo $informe; ?>">

						<table class="TextosVentana" width="100%">
							<tr>
								<td align="right" valign="TOP">
									<img border='0' src='img/icono_totalizar.png'/>
								</td>
								<td align="right" valign="TOP">
									<b>Criterio de agrupamiento</b>
								</td>
								<td align="left" valign="TOP">
									<input type="text" name="agrupamiento" value="<?php echo $registro_agrupacion["agrupamiento"]; ?>" size="40" class="CampoTexto">
									<a href="#" title="Como se agrupan los resultados?" name="Utilice esta opcion solamente si su informe maneja operaciones como suma, promedio o conteo dentro de los campos desplegados.  Ej. SUM(campo), AVG(campo), COUNT(*).  En esos casos indique por cu&aacute;l o cuales campos separados por coma se debe agrupar los resultados"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
									<br><b>Recomendaci&oacute;n:</b> Utilice solamente campos definidos en su consulta.
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<hr>
								</td>
							</tr>
							<tr>
								<td align="right" valign="TOP">
									<img border='0' src='img/icono_ordenar.png'/>
								</td>
								<td align="right" valign="TOP">
									<b>Criterio de ordenamiento</b>
								</td>
								<td align="left" valign="TOP">
									<input type="text" name="ordenamiento" value="<?php echo $registro_agrupacion["ordenamiento"]; ?>" size="40" class="CampoTexto">
									<a href="#" title="Como se ordenan los resultados?" name="Permite ordenar los resultados por alguno de los desplegados.  Indique por cu&aacute;l o cuales campos separados por coma se debe ordenar los resultados, si lo desea despu&eacute;s de cada campo puede utilizar el modificador ASC o DESC para indicar si es ascedente o descendente."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
									<br><b>Recomendaci&oacute;n:</b> Utilice solamente campos definidos en su consulta.
								</td>
							</tr>
						</table>
				</form>
				<hr><center>
				<input type="Button"  class="Botones" value="Actualizar criterios de agrupoaci&oacute;n y ordenamiento >>>" onClick="document.datosformcogrup.submit()">
				<br><br><br>
				</center>
			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="Cerrar" onClick="OcultarPopUp(\'FormularioAgrupacion\')">';
				cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>

		<?php
			// Habilita el popup activo
			if (@$popup_activo=="FormularioTablas")	echo '<script type="text/javascript">	AbrirPopUp("FormularioTablas"); </script>';
			if (@$popup_activo=="FormularioCampos")	echo '<script type="text/javascript">	AbrirPopUp("FormularioCampos"); </script>';
			if (@$popup_activo=="FormularioCondiciones")	echo '<script type="text/javascript">	AbrirPopUp("FormularioCondiciones"); </script>';
			if (@$popup_activo=="FormularioGraficos")	echo '<script type="text/javascript">	AbrirPopUp("FormularioGraficos"); </script>';
			if (@$popup_activo=="FormularioAgrupacion")	echo '<script type="text/javascript">	AbrirPopUp("FormularioAgrupacion"); </script>';
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
				<hr>
				Condiciones<br>
				<a href='javascript:AbrirPopUp("FormularioCondiciones");' title="Filtrar los resultados mediante condiciones espec&iacute;ficas"><img border='0' src='img/icono_diseno.png'/></a>
				<hr>
				Agrupaci&oacute;n y ordenamiento<br>
				<a href='javascript:AbrirPopUp("FormularioAgrupacion");' title="Permite definir campos de agrupaci&oacute;n para informes con operaciones de suma, promedio o conteo y los campos para el ordenamiento de resultados"><img border='0' src='img/icono_totalizar.png'/><img border='0' src='img/icono_ordenar.png'/></a>

				<?php
					// Si se trata de un informe con grafico como resultado agrega el boton de graficos
					if ($registro_informe['formato_final']=='G')
						{
				?>
					<hr>
					Propiedades del Gr&aacute;fico<br>
					<a href='javascript:AbrirPopUp("FormularioGraficos");' title="Define las propiedades y apariencia del gr&aacute;fico desplegado por el informe"><img border='0' src='img/icono_grafico.png'/></a>
				<?php
						}// Fin si es grafico
				?>

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
						<td align="right">T&iacute;tulo del informe o gr&aacute;fico:</td>
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
						<td align="right">Ancho:</td>
						<td><input type="text" name="ancho"  value="<?php echo $registro_informe['ancho']; ?>" size="4" class="CampoTexto"> (agregar <b>px</b> &oacute; <b>%</b> seg&uacute;n el caso)
							<a href="#" title="Establecer ancho fijo?" name="Este valor aplica si ha especificado tambien un alto. Si requiere que el informe aparezca dentro de un marco de ancho fijo especifique su tama&ntilde;o en pixeles, deje en blanco para que se desplieguen los datos sin restricciones de tama&ntilde;o.  En el caso de los gr&aacute;ficos especifica su tama&ntilde;o de imagen."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="right">Alto:</td>
						<td><input type="text" name="alto"  value="<?php echo $registro_informe['alto']; ?>" size="4" class="CampoTexto">  (agregar <b>px</b> &oacute; <b>%</b> seg&uacute;n el caso)
							<a href="#" title="Establecer alto fijo?" name="Este valor aplica si ha especificado tambien un ancho. Si requiere que el informe aparezca dentro de un marco de alto fijo especifique su tama&ntilde;o en pixeles, deje en blanco para que se desplieguen los datos sin restricciones de tama&ntilde;o.  En el caso de los gr&aacute;ficos especifica su tama&ntilde;o de imagen."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="RIGHT" valign="TOP"><strong>Formato final</strong></td>
						<td>
							<select  name="formato_final" id="formato_final" class="Combos">
								<option value="T"  <?php if ($registro_informe["formato_final"]=="T") echo 'selected'; ?> >Tabla de datos</option>
								<option value="G"  <?php if ($registro_informe["formato_final"]=="G") echo 'selected'; ?> >Gr&aacute;fico</option>
							</select>
							<a href="#" title="Como se visualiza este informe?" name="Indica si el producto final del informe ser&aacute; un tabla de datos o un gr&aacute;fico."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
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
				ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe VALUES (0, '$titulo','$descripcion','$categoria','$agrupamiento','$ordenamiento','$nivel_usuario','$ancho','$alto','$formato_final','|!|!|!|')");
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
			<?php abrir_ventana('Agregar nuevo informe o gr&aacute;fico','f2f2f2',''); ?>
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="accion" value="guardar_informe">
			<div align=center>
						
			<br>Defina los detalles del informe/gr&aacute;fico:
				<table class="TextosVentana">
					<tr>
						<td align="right">T&iacute;tulo del informe o gr&aacute;fico:</td>
						<td><input type="text" name="titulo" size="20" class="CampoTexto">
							<a href="#" title="Campo obligatorio" name=""><img src="img/icn_12.gif" border=0 align=absmiddle></a>
							<a href="#" title="Ayuda r&aacute;pida:" name="Texto que aparecer&aacute; en la parte superior del informe generado"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="right">Descripci&oacute;n</td>
						<td><input type="text" name="descripcion" size="20" class="CampoTexto">
						<a href="#" title="Ayuda r&aacute;pida:" name="Texto descriptivo del informe.  No aparece en su generaci&oacute;n pero es usado para orientar al usuario en su selecci&oacute;n"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="right">Categor&iacute;a</td>
						<td><input type="text" name="categoria" size="20" class="CampoTexto">
							<a href="#" title="Campo obligatorio" name=""><img src="img/icn_12.gif" border=0 align=absmiddle></a>
							<a href="#" title="Ayuda r&aacute;pida:" name="Cuando el usuario tiene acceso al panel de informes del sistema estos son clasificados por categor&iacute;as.  Ingrese aqui un nombre de categor&iacute;a bajo el cual desee presentar este informe a los usuarios."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
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
						<td align="right">Ancho:</td>
						<td><input type="text" name="ancho" size="4" class="CampoTexto">  (agregar <b>px</b> &oacute; <b>%</b> seg&uacute;n el caso)
							<a href="#" title="Establecer ancho fijo?" name="Este valor aplica si ha especificado tambien un alto. Si requiere que el informe aparezca dentro de un marco de ancho fijo especifique su tama&ntilde;o en pixeles, deje en blanco para que se desplieguen los datos sin restricciones de tama&ntilde;o.  En el caso de los gr&aacute;ficos especifica su tama&ntilde;o de imagen."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="right">Alto:</td>
						<td><input type="text" name="alto" size="4" class="CampoTexto">  (agregar <b>px</b> &oacute; <b>%</b> seg&uacute;n el caso)
							<a href="#" title="Establecer alto fijo?" name="Este valor aplica si ha especificado tambien un ancho. Si requiere que el informe aparezca dentro de un marco de alto fijo especifique su tama&ntilde;o en pixeles, deje en blanco para que se desplieguen los datos sin restricciones de tama&ntilde;o.  En el caso de los gr&aacute;ficos especifica su tama&ntilde;o de imagen."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="RIGHT" valign="TOP"><strong>Formato final</strong></td>
						<td>
							<select  name="formato_final" id="formato_final" class="Combos">
								<option value="T">Tabla de datos</option>
								<option value="G">Gr&aacute;fico</option>
							</select>
							<a href="#" title="Como se visualiza este informe?" name="Indica si el producto final del informe ser&aacute; un tabla de datos o un gr&aacute;fico."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
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
		abrir_ventana('Informes/Gr&aacute;ficos ya definidos en el sistema','f2f2f2','');
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



/* ################################################################## */
/* ################################################################## */
if ($accion=="mis_informes")
	{
			// Carga las opciones del ACORDEON DE INFORMES
			echo '<div align="center">
			<input type="Button" onclick="document.core_ver_menu.submit()" value=" <<< Volver a mi escritorio " class="Botones">
			';
			// Si el usuario es diferente al administrador agrega condiciones al query
			if ($Login_usuario!="admin")
				{
					$Complemento_tablas=",".$TablasCore."usuario_informe";
					$Complemento_condicion=" AND ".$TablasCore."usuario_informe.informe=".$TablasCore."informe.id AND ".$TablasCore."usuario_informe.usuario='$Login_usuario'";  // AND nivel>0
				}
			$resultado=ejecutar_sql("SELECT COUNT(*) as conteo,categoria FROM ".$TablasCore."informe ".$Complemento_tablas." WHERE 1 ".$Complemento_condicion." GROUP BY categoria ORDER BY categoria");

			// Imprime las categorias encontradas para el usuario
			while($registro = $resultado->fetch())
				{
					//Crea la categoria en el acordeon
					$seccion_menu_activa=$registro["categoria"];
					$conteo_opciones=$registro["conteo"];
					abrir_ventana('Informes '.$seccion_menu_activa.' ('.$conteo_opciones.')','fondo_ventanas2.gif','85%');
					// Busca las opciones dentro de la categoria

					// Si el usuario es diferente al administrador agrega condiciones al query
					if ($Login_usuario!="admin")
						{
							$Complemento_tablas=",".$TablasCore."usuario_informe";
							$Complemento_condicion=" AND ".$TablasCore."usuario_informe.informe=".$TablasCore."informe.id AND ".$TablasCore."usuario_informe.usuario='$Login_usuario'";  // AND nivel>0
						}
					$resultado_opciones_acordeon=ejecutar_sql("SELECT * FROM ".$TablasCore."informe ".$Complemento_tablas." WHERE 1 AND categoria='".$seccion_menu_activa."' ".$Complemento_condicion." ORDER BY titulo");

					while($registro_opciones_acordeon = $resultado_opciones_acordeon->fetch())
						{
							$limite_texto_iconos=15;
							$texto_icono=$registro_opciones_acordeon["titulo"];
							if (strlen($texto_icono)>$limite_texto_iconos) $texto_icono = substr($texto_icono,0,$limite_texto_iconos)."...";
							echo '
								<div align=center style="float:left">
									<form action="'.$ArchivoCORE.'" method="post" name="acordeinf_'.$registro_opciones_acordeon["id"].'" id="acordeinf_'.$registro_opciones_acordeon["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
									<table cellspacing=5 class="TextosEscritorio"><tr><td align=center>
									<input type="hidden" name="accion" value="cargar_objeto">
									<input type="hidden" name="objeto" value="inf:'.$registro_opciones_acordeon["id"].':1:htm:Informes:0">
									<a title="'.$registro_opciones_acordeon["titulo"].'" name="" href="javascript:document.acordeinf_'.$registro_opciones_acordeon["id"].'.submit();"><img src="img/tango_text-x-generic.png" alt="'.$registro_opciones_acordeon["titulo"].'"  valign="absmiddle" align="absmiddle"></a>
									</td></tr>
									<tr><td align=center>
									'.$texto_icono.'
									</td></tr></table>
									</form>
								</div>';

						}
					cerrar_ventana();
				}
			echo '</div>';
	}
?>
