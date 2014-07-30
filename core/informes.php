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
	Function: eliminar_accion_informe
	Elimina un boton creado para los registros desplegados por un informe tabular

	Variables de entrada:

		boton - ID unico del boton sobre el cual se realiza la operacion de eliminacion

	(start code)
		DELETE FROM ".$TablasCore."informe_boton WHERE id='$boton'
	(end)

	Salida:
		Registro de boton eliminado e informe actualizado
*/
	if ($accion=="eliminar_accion_informe")
		{
			ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_boton WHERE id=? ","$boton");
			auditar("Elimina accion del informe $informe");
			echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
			<input type="Hidden" name="accion" value="editar_informe">
			<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
			<input type="Hidden" name="informe" value="'.$informe.'">
			<input type="Hidden" name="popup_activo" value="FormularioAcciones">
			</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: actualizar_agrupamiento_informe
	Cambia el registro asociado a un informe de la aplicacion para el campo de agrupamiento y ordenamiento

	Variables de entrada:

		id - ID del informe que se desea cambiarse
		agrupamiento - Nuevo valor de campo para agrupamiento del query
		ordenamiento - Nuevo valor de campo para ordenamiento del query

		(start code)
			UPDATE ".$TablasCore."informe SET agrupamiento='$agrupamiento',ordenamiento='$ordenamiento' WHERE id=$id
		(end)

	Salida:
		Registro de informe actualizado

	Ver tambien:

		<editar_informe>
*/
if ($accion=="actualizar_agrupamiento_informe")
	{
		// Actualiza los datos
		ejecutar_sql_unaria("UPDATE ".$TablasCore."informe SET agrupamiento=?,ordenamiento=? WHERE id=? ","$agrupamiento$_SeparadorCampos_$ordenamiento$_SeparadorCampos_$informe");
		auditar("Actualiza agrupamiento/ordenamiento informe $informe");
		echo '
			<form name="regresar" action="'.$ArchivoCORE.'" method="POST">
			<input type="Hidden" name="accion" value="editar_informe">
			<input type="Hidden" name="informe" value="'.$informe.'">
			</form>
		<script type="" language="JavaScript">
		 document.regresar.submit();  </script>';
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: actualizar_grafico_informe
	Cambia el registro asociado a un informe de la aplicacion para el campo de formato de graficos

	Variables de entrada:

		id - ID del informe que se desea cambiarse
		cadena_formato - Formato utilizado para la generacion del grafico incluyendo el tipo y valores para cada una de sus series (nombre, campo usado como etiqueta y campo usado como valor)

		(start code)
			UPDATE ".$TablasCore."informe SET formato_grafico='$cadena_formato' WHERE id=$id
		(end)

	Salida:
		Registro de informe actualizado

	Ver tambien:

		<editar_informe>
*/
if ($accion=="actualizar_grafico_informe")
	{
		$mensaje_error="";
		if ($nombre_serie_1=="" || $campo_etiqueta_serie_1=="" || $campo_valor_serie_1=="") $mensaje_error.=$MULTILANG_InfErr1;
		if ($mensaje_error=="")
			{
				//Construye la cadena de formato
				$cadena_formato="";
				$cadena_formato.=$tipo_grafico."|";
				$cadena_formato.=$nombre_serie_1."!".$nombre_serie_2."!".$nombre_serie_3."!".$nombre_serie_4."!".$nombre_serie_5."|";
				$cadena_formato.=$campo_etiqueta_serie_1."!".$campo_etiqueta_serie_2."!".$campo_etiqueta_serie_3."!".$campo_etiqueta_serie_4."!".$campo_etiqueta_serie_5."|";
				$cadena_formato.=$campo_valor_serie_1."!".$campo_valor_serie_2."!".$campo_valor_serie_3."!".$campo_valor_serie_4."!".$campo_valor_serie_5;

				// Actualiza los datos
				ejecutar_sql_unaria("UPDATE ".$TablasCore."informe SET formato_grafico=? WHERE id=? ","$cadena_formato$_SeparadorCampos_$informe");
				auditar("Actualiza informe grafico $informe");
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
					<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorDatos.'">
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
		variables - Nuevos valores de variable para formato_final, alto,ancho,titulo,descripcion,categoria,nivel_usuario

		(start code)
			UPDATE ".$TablasCore."informe SET formato_final='$formato_final', alto='$alto',ancho='$ancho',titulo='$titulo',descripcion='$descripcion',categoria='$categoria',nivel_usuario='$nivel_usuario' WHERE id=$id
		(end)

	Salida:
		Registro de informe actualizado

	Ver tambien:

		<editar_informe> | <actualizar_grafico_informe> | <actualizar_agrupamiento_informe>
*/
if ($accion=="actualizar_informe")
	{
		$mensaje_error="";
		if ($titulo=="") $mensaje_error.=$MULTILANG_InfErr2.'<br>';
		if ($categoria=="") $mensaje_error.=$MULTILANG_InfErr3.'<br>';
		if ($mensaje_error=="")
			{
				// Actualiza los datos
				ejecutar_sql_unaria("UPDATE ".$TablasCore."informe SET color_fondo=?,genera_pdf=?,formato_final=?, alto=?,ancho=?,titulo=?,descripcion=?,categoria=?,nivel_usuario=? WHERE id=? ","$color_fondo$_SeparadorCampos_$genera_pdf$_SeparadorCampos_$formato_final$_SeparadorCampos_$alto$_SeparadorCampos_$ancho$_SeparadorCampos_$titulo$_SeparadorCampos_$descripcion$_SeparadorCampos_$categoria$_SeparadorCampos_$nivel_usuario$_SeparadorCampos_$id");
				auditar("Actualiza informe $id");
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="editar_informe">
					<input type="Hidden" name="informe" value="'.$id.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				//echo '<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
			}
		else
			{
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="editar_informe">
					<input type="Hidden" name="informe" value="'.$id.'">
					<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorDatos.'">
					<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: eliminar_informe_condicion
	Elimina una condicion de filtrado para un informe de la aplicacion

	Variables de entrada:

		id - ID de la condicion a eliminar

		(start code)
			DELETE FROM ".$TablasCore."informe_condiciones WHERE id='$condicion'
		(end)

	Salida:
		Registro de informe actualizado

	Ver tambien:

		<editar_informe> | <guardar_informe_condicion>
*/
if ($accion=="eliminar_informe_condicion")
	{
		ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_condiciones WHERE id=? ","$condicion");
		@auditar("Elimina condicion $condicion");
		echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
			<input type="Hidden" name="accion" value="editar_informe">
			<input type="Hidden" name="informe" value="'.$informe.'">
			<input type="Hidden" name="popup_activo" value="FormularioCondiciones">
			</form>
				<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_informe_condicion
	Agrega una condicion de filtrado para un informe de la aplicacion

	Variables de entrada:

		id - ID de la condicion a eliminar

		(start code)
			SELECT MAX(peso) as peso FROM ".$TablasCore."informe_condiciones WHERE informe='$informe'
			INSERT INTO ".$TablasCore."informe_condiciones VALUES (0, '$informe','$valor_i','$valor_o','$valor_d','$peso')
		(end)

	Salida:
		Registro de informe actualizado

	Ver tambien:

		<editar_informe> | <eliminar_informe_condicion>
*/
	if ($accion=="guardar_informe_condicion")
		{
			$mensaje_error="";
			$valor_i=$valor_izq.$valor_izq_manual.$operador_logico;
			$valor_d=$valor_der.$valor_der_manual;
			$valor_o=$operador.$operador_manual;
			if ($valor_i=="" && $valor_d=="") $mensaje_error=$MULTILANG_InfErrCondicion;
			if ($mensaje_error=="")
				{
					//Busca el peso del ultimo elemento para agregar el nuevo con peso+1
					$peso=1;
					$consulta_peso=ejecutar_sql("SELECT MAX(peso) as peso FROM ".$TablasCore."informe_condiciones WHERE informe=? ","$informe");
					$registro = $consulta_peso->fetch();
					if($registro[0]!="")$peso=$registro[0] + 1;
					//Agrega la condicion
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_condiciones (".$ListaCamposSinID_informe_condiciones.") VALUES (?,?,?,?,?)","$informe$_SeparadorCampos_$valor_i$_SeparadorCampos_$valor_o$_SeparadorCampos_$valor_d$_SeparadorCampos_$peso");
					auditar("Agrega condicion al informe $informe");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="accion" value="editar_informe">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="popup_activo" value="FormularioCondiciones">
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="editar_informe">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: eliminar_informe_campo
	Elimina un campo definido para un informe de la aplicacion

	Variables de entrada:

		id - ID del campo a eliminar

		(start code)
			DELETE FROM ".$TablasCore."informe_campos WHERE id='$campo'
		(end)

	Salida:
		Campo eliminado de la lista agregada al informe

	Ver tambien:

		<editar_informe>
*/
if ($accion=="eliminar_informe_campo")
	{
		ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_campos WHERE id=? ","$campo");
		auditar("Elimina campo $campo del informe $informe");
		echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
			<input type="Hidden" name="accion" value="editar_informe">
			<input type="Hidden" name="informe" value="'.$informe.'">
			<input type="Hidden" name="popup_activo" value="FormularioCampos">
			</form>
		<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_informe_campo
	Agrega un campo definido para un informe de la aplicacion

	Variables de entrada:

		informe - ID del informe al que sera agregado el campo
		campo_datos - Nombre del campo, normalmente seleccionado de los disponibles
		campo_manual - Valor manual para un nombre de campo, puede ser usado tambien en funciones de agrupacion
		alias_manual - Valor de alias para el campo, usado en la impresion
		campo_definitivo - concatenacion resultante de campo_manual y campo_datos (interno, no ercibido)

		(start code)
			INSERT INTO ".$TablasCore."informe_campos VALUES (0, '$informe','$campo_definitivo','$alias_manual')
		(end)

	Salida:
		Campo agregado a la lista en el informe

	Ver tambien:

		<editar_informe> | <eliminar_informe_campo>
*/
	if ($accion=="guardar_informe_campo")
		{
			$mensaje_error="";
			if ($campo_manual.$campo_datos=="") $mensaje_error=$MULTILANG_InfErrCampo;
			if ($mensaje_error=="")
				{
					$campo_definitivo=$campo_manual.$campo_datos;
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_campos (".$ListaCamposSinID_informe_campos.") VALUES (?,?,?)","$informe$_SeparadorCampos_$campo_definitivo$_SeparadorCampos_$alias_manual");
					auditar("Agrega campo $campo_definitivo al informe $informe");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="accion" value="editar_informe">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="popup_activo" value="FormularioCampos">
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="editar_informe">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: eliminar_informe_tabla
	Elimina una tabla de datos definida para un informe de la aplicacion

	Variables de entrada:

		tabla - ID de la tabla que debe ser eliminada

		(start code)
			DELETE FROM ".$TablasCore."informe_tablas WHERE id='$tabla'
		(end)

	Salida:
		Tabla eliminada del informe

	Ver tambien:

		<editar_informe> | <eliminar_informe_campo>
*/
if ($accion=="eliminar_informe_tabla")
	{
		ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_tablas WHERE id=? ","$tabla");
		auditar("Elimina tabla $tabla del informe $informe");
		echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
			<input type="Hidden" name="accion" value="editar_informe">
			<input type="Hidden" name="informe" value="'.$informe.'">
			<input type="Hidden" name="popup_activo" value="FormularioTablas">
			</form>
		<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_informe_tabla
	Agrega una tabla de datos para un informe de la aplicacion

	Variables de entrada:

		informe - ID del informe al que sera agregada la tabla
		tabla_datos - Nombre de la tabla, normalmente seleccionada de las disponibles
		tabla_manual - Valor manual para un nombre de tabla
		alias_manual - Valor de alias para la tabla
		tabla_definitiva - concatenacion resultante de campo_manual y campo_datos (interno, no ercibido)

		(start code)
			INSERT INTO ".$TablasCore."informe_tablas VALUES (0, '$informe','$tabla_definitiva','$alias_manual')
		(end)

	Salida:
		Tabla agregada al informe

	Ver tambien:

		<editar_informe>
*/
	if ($accion=="guardar_informe_tabla")
		{
			$mensaje_error="";
			if ($tabla_manual.$tabla_datos=="") $mensaje_error=$MULTILANG_InfErrTabla;
			if ($mensaje_error=="")
				{
					$tabla_definitiva=$tabla_manual.$tabla_datos;
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_tablas (".$ListaCamposSinID_informe_tablas.") VALUES (?,?,?)","$informe$_SeparadorCampos_$tabla_definitiva$_SeparadorCampos_$alias_manual");
					auditar("Agrega tabla $tabla_definitiva al informe $informe");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="accion" value="editar_informe">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="popup_activo" value="FormularioTablas">
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="editar_informe">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_accion_informe
	Agrega un boton con una accion determinada para un registro desplegado por un informe tabular

	Variables de entrada:

		multiples - Recibidas mediante formulario unico asociado al proceso de creacion del elemento.

	(start code)
		INSERT INTO ".$TablasCore."formulario_boton VALUES (0, '$titulo','$estilo','$formulario','$tipo_accion','$accion_usuario','$visible','$peso','$retorno_titulo','$retorno_texto','$confirmacion_texto')
	(end)

	Salida:
		Registro agregado y formulario actualizado en pantalla

	Ver tambien:
		<eliminar_accion_informe>
*/
	if ($accion=="guardar_accion_informe")
		{
			$mensaje_error="";
			if ($titulo=="") $mensaje_error=$MULTILANG_InfErr4;
			if ($tipo_accion=="") $mensaje_error=$MULTILANG_InfErr5;
			if ($mensaje_error=="")
				{
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_boton (".$ListaCamposSinID_informe_boton.") VALUES (?,?,?,?,?,?,?,?)","$titulo$_SeparadorCampos_$estilo$_SeparadorCampos_$informe$_SeparadorCampos_$tipo_accion$_SeparadorCampos_$accion_usuario$_SeparadorCampos_$visible$_SeparadorCampos_$peso$_SeparadorCampos_$confirmacion_texto");
					auditar("Crea boton $id para informe $informe");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="accion" value="editar_informe">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="popup_activo" value="FormularioBotones">
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="editar_informe">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						<input type="Hidden" name="informe" value="'.$informe.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: eliminar_registro_informe
	Elimina los registros coincidentes con los datos de un boton de accion sobre un informe tabular

	Variables de entrada:

		tabla - nombre de la tabla sobre la que se hace la operacion
		campo - nombre del campo que debe ser usado para filtrar
		valor - valor a comparar sobre el campo y que es usado para determinar que registro eliminar

	(start code)
		DELETE FROM ".$tabla." WHERE $campo='$valor'
	(end)

	Salida:
		Registro eliminado de la tabla de aplicacion

*/
	if ($accion=="eliminar_registro_informe")
		{
			ejecutar_sql_unaria("DELETE FROM ".$tabla." WHERE $campo='$valor'");
			auditar("Elimina registro donde $campo = $valor en $tabla");
			echo '<script language="JavaScript"> document.core_ver_menu.submit();  </script>';
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: editar_informe
	Actualiza la informacion asociada a un informe mediante dos ventanas.  En una se cargan los datos basicos y que pueden ser actualizados directamente.  En otra se cargan accesos a ventanas emergentes que permiten cambiar otros parámetros mas especificos.

	Salida:
		Ventanas con los campos y enlaces requeridos para la edicion

*/
if ($accion=="editar_informe")
	{
		// Busca datos del informe
		$resultado_informe=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe." FROM ".$TablasCore."informe WHERE id=? ","$informe");
		$registro_informe = $resultado_informe->fetch();
  ?>

		<!-- INICIO DE MARCOS POPUP -->

		<div id='FormularioTablas' class="FormularioPopUps">
				<?php
				abrir_ventana($MULTILANG_InfAgregaTabla,'#BDB9B9','');
				?>
				<form name="datosform" id="datosform" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="accion" value="guardar_informe_tabla">
				<input type="Hidden" name="informe" value="<?php echo $informe; ?>">
				<div align=center>

					<table class="TextosVentana">
						<tr>
							<td align="right"><?php echo $MULTILANG_TablaDatos; ?>:</td>
							<td>
								<select  name="tabla_datos" class="Combos" >
									<option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
									 <?php
											$resultado=consultar_tablas();
											while ($registro = $resultado->fetch())
												{
													// Imprime solamente las tablas de aplicacion, es decir, las que no cumplen prefijo de internas de Practico
													if (strpos($registro[0],$TablasCore)===FALSE)  // Booleana requiere === o !==
														echo '<option value="'.$registro[0].'" >'.str_replace($TablasApp,'',$registro[0]).'</option>';
												}
									?>
								</select><a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>" name=""><img src="img/icn_12.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td align="right"><?php echo $MULTILANG_InfTablaManual; ?>:</td>
							<td><input type="text" name="tabla_manual" size="20" class="CampoTexto"> (<?php echo $MULTILANG_Opcional; ?>)
								<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_InfDesTablaManual; ?>"><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td align="right"><?php echo $MULTILANG_InfAliasManual; ?>:</td>
							<td><input type="text" name="alias_manual" size="20" class="CampoTexto"> (<?php echo $MULTILANG_Opcional; ?>)
								<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_InfDesAliasManual; ?>"><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td>
								</form>
								
							</td>
							<td>
								<input type="Button"  class="Botones" value="<?php echo $MULTILANG_InfBtnAgregaTabla; ?>" onClick="document.datosform.submit()">
							</td>
						</tr>
					</table>
					

				<hr><b><?php echo $MULTILANG_InfTablasDef; ?></b>
				<table width="100%" border="0" cellspacing="2" align="CENTER"  class="TextosVentana">
					<tr>
						<td bgcolor="#D6D6D6"><b><?php echo $MULTILANG_Tablas; ?></b></td>
						<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_InfAlias; ?></b></td>
						<td></td>
					</tr>
				 <?php

						$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_tablas." FROM ".$TablasCore."informe_tablas WHERE informe=? ORDER BY valor_tabla","$informe");
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
														<input type="button" value="'.$MULTILANG_Eliminar.'"  class="BotonesCuidado" onClick="confirmar_evento(\''.$MULTILANG_InfAdvBorrado.'\',df'.$registro["id"].');">
												</form>
										</td>
									</tr>';
							}
						echo '</table>';
				?>
	
			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="'.$MULTILANG_Cerrar.'" onClick="OcultarPopUp(\'FormularioTablas\')">';
				cerrar_barra_estado();
			cerrar_ventana();

			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>


		<!-- INICIO DE MARCOS POPUP -->

		<div id='FormularioCampos' class="FormularioPopUps">
				<?php
				abrir_ventana($MULTILANG_InfAgregaCampo,'#BDB9B9',''); 
				?>
				<form name="datosformc" id="datosformc" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="accion" value="guardar_informe_campo">
				<input type="Hidden" name="informe" value="<?php echo $informe; ?>">
				<div align=center>

					<table class="TextosVentana">
						<tr>
							<td align="right"><?php echo $MULTILANG_InfCampoDatos; ?>:</td>
							<td>
								<select  name="campo_datos" class="Combos" >
									<option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
									<?php
											$resultado=ejecutar_sql("SELECT valor_tabla FROM ".$TablasCore."informe_tablas WHERE informe=? ","$informe");
											//$resultado=consultar_tablas(); //Presenta todas las tablas
											while ($registro = $resultado->fetch())
												{
													// Imprime solamente las tablas de aplicacion, es decir, las que no cumplen prefijo de internas de Practico
													if (strpos($registro[0],$TablasCore)===FALSE)  // Booleana requiere === o !==
														{
															echo '<optgroup label="'.str_replace($TablasApp,'',$registro[0]).'" >';
															$nombre_tabla=$registro[0];
															//Busca los campos de la tabla
															$resultadocampos=consultar_columnas($registro[0]);
															for($i=0;$i<count($resultadocampos);$i++)
																echo '<option value="'.$nombre_tabla.'.'.$resultadocampos[$i]["nombre"].'">'.$resultadocampos[$i]["nombre"].'</option>';
															echo '</optgroup>';
														}
												}
									?>
								</select><a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>" name=""><img src="img/icn_12.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td align="right"><?php echo $MULTILANG_InfCampoManual; ?>:</td>
							<td><input type="text" name="campo_manual" size="20" class="CampoTexto"> (<?php echo $MULTILANG_Opcional; ?>)
								<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_InfDesCampoManual; ?>"><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td align="right"><?php echo $MULTILANG_InfAliasManual; ?>:</td>
							<td><input type="text" name="alias_manual" size="20" class="CampoTexto"> (<?php echo $MULTILANG_Opcional; ?>)
								<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_InfDesAliasManual2; ?>"><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td>
								</form>
								
							</td>
							<td>
								<input type="Button"  class="Botones" value="<?php echo $MULTILANG_InfBtnAgregaCampo; ?>" onClick="document.datosformc.submit()">
							</td>
						</tr>
					</table>
					

				<hr><b><?php echo $MULTILANG_InfCamposDef; ?></b>
				<table width="100%" border="0" cellspacing="2" align="CENTER"  class="TextosVentana">
					<tr>
						<td bgcolor="#D6D6D6"><b><?php echo $MULTILANG_Campo; ?></b></td>
						<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_InfAlias; ?></b></td>
						<td></td>
						<td></td>
					</tr>
				 <?php

						$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_campos." FROM ".$TablasCore."informe_campos WHERE informe=? ","$informe");
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
														<input type="button" value="'.$MULTILANG_Eliminar.'"  class="BotonesCuidado" onClick="confirmar_evento(\''.$MULTILANG_InfAdvBorrado.'\',dfc'.$registro["id"].');">
												</form>
										</td>
									</tr>';
							}
						echo '</table>';
				?>

			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="'.$MULTILANG_Cerrar.'" onClick="OcultarPopUp(\'FormularioCampos\')">';
				cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>


		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioCondiciones' class="FormularioPopUps">
				<?php
				abrir_ventana($MULTILANG_InfAddCondicion,'#BDB9B9','600'); 
				?>
				<form name="datosformco" id="datosformco" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
					<input type="Hidden" name="accion" value="guardar_informe_condicion">
					<input type="Hidden" name="informe" value="<?php echo $informe; ?>">
					<div align=center>

					<table class="TextosVentana" width="100%">
						<tr>
							<th>
								<?php echo $MULTILANG_InfPrimer; ?>
							</th>
							<th>
								<?php echo $MULTILANG_InfOperador; ?>
							</th>
							<th>
								<?php echo $MULTILANG_InfSegundo; ?>
							</th>
						</tr>
						<tr>
							<td align=center valign=top>
								<select  name="valor_izq" class="Combos" >
									<option value=""><?php echo $MULTILANG_Vacio; ?></option>
									<?php
										$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_campos." FROM ".$TablasCore."informe_campos WHERE informe=? ","$informe");
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
									<option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
									<option value="="><?php echo $MULTILANG_InfIgualA; ?>: = </option>
									<option value="<>"><?php echo $MULTILANG_InfDiferenteDe; ?>: <> </option>
									<option value=">"><?php echo $MULTILANG_InfMayorQue; ?>: > </option>
									<option value="<"><?php echo $MULTILANG_InfMenorQue; ?>: < </option>
									<option value=">="><?php echo $MULTILANG_InfMayorIgualQue; ?>: >= </option>
									<option value="<="><?php echo $MULTILANG_InfMenorIgualQue; ?>: <= </option>
								</select><br>
								<input type="text" name="operador_manual" size="20" class="CampoTexto">
							</td>
							<td align=center valign=top>
								<select  name="valor_der" class="Combos" >
									<option value=""><?php echo $MULTILANG_Vacio; ?></option>
									<?php
										$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_campos." FROM ".$TablasCore."informe_campos WHERE informe=? ","$informe");
										while($registro = $consulta_forms->fetch())
											{
												echo '<option value="'.$registro["valor_campo"].'">'.$registro["valor_campo"].'</option>';
											}
									?>
								</select><br>
								<input type="text" name="valor_der_manual" size="20" class="CampoTexto">
								<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_InfDesManual; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td align=center colspan=3>
								<br><?php echo $MULTILANG_InfOperador; ?>
								<select  name="operador_logico" class="Combos" >
									<option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
									<option value="("><?php echo $MULTILANG_InfOpParentesisA; ?> - (</option>
									<option value=")"><?php echo $MULTILANG_InfOpParentesisC; ?> - )</option>
									<option value="AND"><?php echo $MULTILANG_InfOpAND; ?> - AND</option>
									<option value="OR"><?php echo $MULTILANG_InfOpOR; ?> - OR</option>
									<option value="NOT"><?php echo $MULTILANG_InfOpNOT; ?> - NOT</option>
									<option value="XOR"><?php echo $MULTILANG_InfOpXOR; ?> - XOR</option>
								</select>
								<a href="#" title="<?php echo $MULTILANG_InfTitOp; ?>" name="<?php echo $MULTILANG_InfDesOp; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
								<br><b><?php echo $MULTILANG_InfReco1; ?>:</b> <?php echo $MULTILANG_InfReco2; ?>
							</td>
						</tr>
						<tr>
							<td align=center colspan=3>
								<br><input type="Button"  class="Botones" value=" <?php echo $MULTILANG_InfBtnAddCondic; ?> >>> " onClick="document.datosformco.submit()">
							</td>
						</tr>
					</table>
				</form>

				<hr><b><?php echo $MULTILANG_InfDefCond; ?></b>
				<table width="100%" border="0" cellspacing="2" align="CENTER"  class="TextosVentana">
				 <?php

						$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_condiciones." FROM ".$TablasCore."informe_condiciones WHERE informe=? ORDER BY peso","$informe");
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
										if (@$registro["campo"]!="id")
											echo '
												<a href="javascript:ifoce'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmAumentaPeso.'" name=""><img src="img/bajar.png" border=0></a> 
												'.$registro["peso"].'
												<a href="javascript:ifopa'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmDisminuyePeso.'" name=""><img src="img/subir.png" border=0></a>
												';
								echo '		
										</td>
										<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" name="dfco'.$registro["id"].'" id="dfco'.$registro["id"].'">
														<input type="hidden" name="accion" value="eliminar_informe_condicion">
														<input type="hidden" name="condicion" value="'.$registro["id"].'">
														<input type="hidden" name="informe" value="'.$informe.'">
														<input type="button" value="'.$MULTILANG_Eliminar.'"  class="BotonesCuidado" onClick="confirmar_evento(\''.$MULTILANG_InfAdvBorrado.'\',dfco'.$registro["id"].');">
												</form>
										</td>
									</tr>';
							}
						echo '</table>';
				?>

			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="'.$MULTILANG_Cerrar.'" onClick="OcultarPopUp(\'FormularioCondiciones\')">';
				cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>


		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioGraficos' class="FormularioPopUps">
				<?php
				abrir_ventana($MULTILANG_InfTitGrafico,'#BDB9B9','600'); 
				?>
				<form name="datosformcograf" id="datosformcograf" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
					<input type="Hidden" name="accion" value="actualizar_grafico_informe">
					<input type="Hidden" name="informe" value="<?php echo $informe; ?>">

				<!-- SELECCION DE SERIES  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
				<hr>
				<div align=center><b><?php echo $MULTILANG_InfSeriesGrafico1; ?></b> - <?php echo $MULTILANG_InfSeriesGrafico2; ?></div>
						<table class="TextosVentana" width="100%">
						<?php
							//Consulta el formato de grafico y datos de series para ponerlo en los campos
							//Dado por: Tipo|Nombre1!NombreN|Etiqueta1!EtiquetaN|Valor1!ValorN|
							$consulta_formato_grafico=ejecutar_sql("SELECT formato_grafico FROM ".$TablasCore."informe WHERE id=? ","$informe");
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
									<b><?php echo $MULTILANG_InfNomSerie?> <?php echo $cs; ?></b><br>
									<input type="text" name="nombre_serie_<?php echo $cs; ?>" value="<?php echo @$lista_nombre_series[$cs-1]; ?>" maxlength="20" size="20" class="CampoTexto">
								</td>
								<td align="center" valign="TOP">
									<b><?php echo $MULTILANG_InfCampoEtiqSerie; ?></b><br>
									<select name="campo_etiqueta_serie_<?php echo $cs; ?>" class="Combos" >
										<option value=""></option>
										<?php
										$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_campos." FROM ".$TablasCore."informe_campos WHERE informe=? ","$informe");
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
									<b><?php echo $MULTILANG_InfCampoValor; ?></b><br>
									<select name="campo_valor_serie_<?php echo $cs; ?>" class="Combos">
										<option value=""></option>
									<?php
										$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_campos." FROM ".$TablasCore."informe_campos WHERE informe=? ","$informe");
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
						<div align=center><b><?php echo $MULTILANG_InfVistaGrafico1; ?></b> - <?php echo $MULTILANG_InfVistaGrafico2; ?></div>
						<table class="TextosVentana">
							<tr>
								<td align="LEFT" valign="TOP">
									<b><?php echo $MULTILANG_InfTipoGrafico; ?>:</b><br>
									<select name="tipo_grafico" class="Combos" >
											<option value="barrah" <?php if ($tipo_grafico_leido=="barrah") echo "SELECTED"; ?>><?php echo $MULTILANG_InfGrafico1; ?></option>
											<option value="barrah_multiples" <?php if ($tipo_grafico_leido=="barrah_multiples") echo "SELECTED"; ?>><?php echo $MULTILANG_InfGrafico2; ?></option>
											<option value="linea" <?php if ($tipo_grafico_leido=="linea") echo "SELECTED"; ?>><?php echo $MULTILANG_InfGrafico3; ?></option>
											<option value="linea_multiples" <?php if ($tipo_grafico_leido=="linea_multiples") echo "SELECTED"; ?>><?php echo $MULTILANG_InfGrafico4; ?></option>
											<option value="barrav" <?php if ($tipo_grafico_leido=="barrav") echo "SELECTED"; ?>><?php echo $MULTILANG_InfGrafico5; ?></option>
											<option value="barrav_multiples" <?php if ($tipo_grafico_leido=="barrav_multiples") echo "SELECTED"; ?>><?php echo $MULTILANG_InfGrafico6; ?></option>
											<option value="torta" <?php if ($tipo_grafico_leido=="torta") echo "SELECTED"; ?>><?php echo $MULTILANG_InfGrafico7; ?></option>
									</select>
								</td>
								<td align="RIGHT">
									<img src="img/tipos_grafico.png" border=0 alt="">
								</td>
							</tr>
						</table>
				</form>
				<hr><center>
				<input type="Button"  class="Botones" value="<?php echo $MULTILANG_InfActGraf; ?> >>>" onClick="document.datosformcograf.submit()">
				<br><br><br>
				</center>
			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="'.$MULTILANG_Cerrar.'" onClick="OcultarPopUp(\'FormularioGraficos\')">';
				cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>


		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioAgrupacion' class="FormularioPopUps">
				<?php
				abrir_ventana($MULTILANG_InfAgrupa,'#BDB9B9','600'); 
				$consulta_agrupacion=ejecutar_sql("SELECT ordenamiento,agrupamiento FROM ".$TablasCore."informe WHERE id=? ","$informe");
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
									<b><?php echo $MULTILANG_InfCriterioAgrupa; ?></b>
								</td>
								<td align="left" valign="TOP">
									<input type="text" name="agrupamiento" value="<?php echo $registro_agrupacion["agrupamiento"]; ?>" size="40" class="CampoTexto">
									<a href="#" title="<?php echo $MULTILANG_InfTitAgrupa; ?>" name="<?php echo $MULTILANG_InfDesAgrupa; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
									<br><b><?php echo $MULTILANG_InfReco1; ?>:</b> <?php echo $MULTILANG_InfReco3; ?>
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
									<b><?php echo $MULTILANG_InfCriterioOrdena; ?></b>
								</td>
								<td align="left" valign="TOP">
									<input type="text" name="ordenamiento" value="<?php echo $registro_agrupacion["ordenamiento"]; ?>" size="40" class="CampoTexto">
									<a href="#" title="<?php echo $MULTILANG_InfTitOrdena; ?>" name="<?php echo $MULTILANG_InfDesOrdena; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
									<br><b><?php echo $MULTILANG_InfReco1; ?>:</b> <?php echo $MULTILANG_InfReco3; ?>
								</td>
							</tr>
						</table>
				</form>
				<hr><center>
				<input type="Button"  class="Botones" value="<?php echo $MULTILANG_InfActCriterios; ?> >>>" onClick="document.datosformcogrup.submit()">
				<br><br><br>
				</center>
			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="'.$MULTILANG_Cerrar.'" onClick="OcultarPopUp(\'FormularioAgrupacion\')">';
				cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>


		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioBotones' class="FormularioPopUps">
			<?php
			abrir_ventana($MULTILANG_InfTitBotones,'BDB9B9','');
			?>
				<form name="datosfield" id="datosfield" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="accion" value="guardar_accion_informe">
				<input type="Hidden" name="informe" value="<?php echo $informe; ?>">
				<div align=center>
							
					<table class="TextosVentana">
						<tr>
							<td align="right"><?php echo $MULTILANG_FrmTitulo; ?>:</td>
							<td ><input type="text" name="titulo" size="20" class="CampoTexto">
								<a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>" name=""><img src="img/icn_12.gif" border=0></a>
								<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesBot; ?>"><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td align="right"><?php echo $MULTILANG_FrmEstilo; ?></td>
							<td>
								<select  name="estilo" class="Combos" >
									<option value="BotonesEstado"><?php echo $MULTILANG_FrmEstilo1; ?> (<?php echo $MULTILANG_Pequeno; ?>)</option>
									<option value="BotonesEstadoCuidado"><?php echo $MULTILANG_FrmEstilo2; ?> (<?php echo $MULTILANG_Pequeno; ?>)</option>
									<option value="Botones"><?php echo $MULTILANG_FrmEstilo1b; ?> (<?php echo $MULTILANG_Grande; ?>)</option>
									<option value="BotonesCuidado"><?php echo $MULTILANG_FrmEstilo2; ?> (<?php echo $MULTILANG_Grande; ?>)</option>
								</select>
								<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesEstilo; ?>"><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td align="right"><?php echo $MULTILANG_FrmTipoAccion; ?></td>
							<td>
								<select  name="tipo_accion" class="Combos" >
									<option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
									<optgroup label="<?php echo $MULTILANG_FrmAccionT1; ?>">
										<option value="interna_eliminar"><?php echo $MULTILANG_InfDelReg; ?></option>
										<option value="interna_cargar"><?php echo $MULTILANG_InfCargaForm; ?></option>
									</optgroup>
									<optgroup label="<?php echo $MULTILANG_FrmAccionT2; ?>">
										<option value="externa_formulario"><?php echo $MULTILANG_FrmAccionExterna; ?></option>
										<option value="externa_javascript"><?php echo $MULTILANG_FrmAccionJS; ?></option>
									</optgroup>
								</select>
								<a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>" name=""><img src="img/icn_12.gif" border=0></a>
								<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesAccion; ?>"><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td align="right"><?php echo $MULTILANG_FrmAccionCMD; ?>:</td>
							<td ><input type="text" name="accion_usuario" size="20" class="CampoTexto">
								<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmAccionDesCMD; ?>"><img src="img/icn_10.gif" border=0></a>
								<br><?php echo $MULTILANG_InfHlpAccion; ?>
							</td>
						</tr>
						<tr>
							<td align="right"><?php echo $MULTILANG_InfVinculo; ?>:</td>
							<td >
								<br><?php echo $MULTILANG_InfDesVinculo; ?><br>
								<!--
								<select name="campo_vinculoformulario" class="Combos" >
									<option value=""></option>
									<?php
									$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_campos." FROM ".$TablasCore."informe_campos WHERE informe=? ","$informe");
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
								<a href="#" title="Ayuda r&aacute;pida:" name="Nombre del campo que es utilizado para abrir formularios vinculados a datos con este registro.  Opera como una busqueda sobre el formulario a desplegar. Se recomienda usar campos de valor &uacute;nico."><img src="img/icn_10.gif" border=0></a>
								-->
							</td>
						</tr>
						<tr>
							<td colspan=2>
							<table width="100%" class="TextosVentana"><tr>
								<td align="right"><?php echo $MULTILANG_Peso; ?>:</td>
								<td>
									<select name="peso" class="selector_01" >
										<?php
											for ($i=1;$i<=20;$i++)
												echo '<option value="'.$i.'">'.$i.'</option>';
										?>
									</select><a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_InfDesPeso; ?>"><img align="top" src="img/icn_10.gif" border=0></a>
								</td>
								<td align="right"><?php echo $MULTILANG_FrmVisible; ?></td>
								<td>
									<select  name="visible" class="Combos" >
										<option value="1"><?php echo $MULTILANG_Si; ?></option>
										<option value="0"><?php echo $MULTILANG_No; ?></option>
									</select><a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesVisible; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr></table>
							</td>
						</tr>
						<tr>
							<td align="right"><?php echo $MULTILANG_FrmConfirma; ?></td>
							<td ><input type="text" name="confirmacion_texto" size="20" class="CampoTexto">
							<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesConfirma; ?>"><img src="img/icn_10.gif" border=0></a>	</td>
						</tr>

						<tr>
							<td>
								</form>
							</td>
							<td>
								<input type="Button"  class="Botones" value="<?php echo $MULTILANG_FrmBtnGuardar; ?>" onClick="document.datosfield.submit()">
							</td>
						</tr>
					</table>
				</br>
			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="'.$MULTILANG_Cerrar.'" onClick="OcultarPopUp(\'FormularioBotones\')">';
				cerrar_barra_estado();
				cerrar_ventana();		// Cierra adicion de botones
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>


		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioAcciones' class="FormularioPopUps">
			<?php
				abrir_ventana($MULTILANG_FrmTitComandos,'#BDB9B9','');
			?>
					<table width="100%" border="0" cellspacing="5" align="CENTER" class="TextosVentana">
						<tr>
							<td bgcolor="#D6D6D6"><b><?php echo $MULTILANG_Etiqueta; ?></b></td>
							<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_FrmTipoAccion; ?></b></td>
							<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_FrmAccUsuario; ?></b></td>
							<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_FrmOrden; ?></b></td>
							<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_FrmVisible; ?></b></td>
							<td></td>
							<td></td>
						</tr>
			 <?php
				$consulta_botones=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_boton." FROM ".$TablasCore."informe_boton WHERE informe=? ORDER BY peso,id","$informe");
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
											<input type="hidden" name="tabla" value="informe_boton">
											<input type="hidden" name="campo" value="peso">
											<input type="hidden" name="informe" value="'.$informe.'">
											<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
											<input type="hidden" name="accion_retorno" value="editar_informe">
											<input type="hidden" name="valor" value="'.$peso_aumentado.'">
											<input type="Hidden" name="popup_activo" value="FormularioAcciones">
										</form>
										<form action="'.$ArchivoCORE.'" method="POST" name="bifopa'.$registro["id"].'" id="bifopa'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
											<input type="hidden" name="accion" value="cambiar_estado_campo">
											<input type="hidden" name="id" value="'.$registro["id"].'">
											<input type="hidden" name="tabla" value="informe_boton">
											<input type="hidden" name="campo" value="peso">
											<input type="hidden" name="informe" value="'.$informe.'">
											<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
											<input type="hidden" name="accion_retorno" value="editar_informe">
											<input type="hidden" name="valor" value="'.@$peso_disminuido.'">
											<input type="Hidden" name="popup_activo" value="FormularioAcciones">
										</form>
									';

									echo '
										<a href="javascript:bifoce'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmAumentaPeso.'" name=""><img src="img/bajar.png" border=0></a> 
										'.$registro["peso"].'
										<a href="javascript:bifopa'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmDisminuyePeso.'" name=""><img src="img/subir.png" border=0></a>
										';
								
								echo '</td>';
								
								
								echo '<td align=center>
											<form action="'.$ArchivoCORE.'" method="POST" name="bif'.$registro["id"].'" id="bif'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
												<input type="hidden" name="accion" value="cambiar_estado_campo">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="hidden" name="tabla" value="informe_boton">
												<input type="hidden" name="campo" value="visible">
												<input type="hidden" name="informe" value="'.$informe.'">
												<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
												<input type="hidden" name="accion_retorno" value="editar_informe">
												<input type="Hidden" name="popup_activo" value="FormularioAcciones">
											';
									if ($registro["visible"])
										echo '<input type="hidden" name="valor" value="0"><a href="javascript:bif'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'" name=""><img src="img/on.png" border=0></a>';
									else
										echo '<input type="hidden" name="valor" value="1"><a href="javascript:bif'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'" name=""><img src="img/off.png" border=0></a>';
								echo '</form></td>';
										echo '<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" name="bf'.$registro["id"].'" id="bf'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
														<input type="hidden" name="accion" value="eliminar_accion_informe">
														<input type="hidden" name="boton" value="'.$registro["id"].'">
														<input type="hidden" name="informe" value="'.$informe.'">
														<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
														<input type="button" value="'.$MULTILANG_Eliminar.'"  class="BotonesCuidado" onClick="confirmar_evento(\''.$MULTILANG_FrmAdvDelBoton.'\',bf'.$registro["id"].');">
														<input type="Hidden" name="popup_activo" value="FormularioAcciones">
												</form>
										</td>
										<!--<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
														<input type="hidden" name="accion" value="editar_campo_formulario">
														<input type="hidden" name="campo" value="'.$registro["id"].'">
														<input type="hidden" name="formulario" value="'.@$formulario.'">
														<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
														<input type="Button" value="Editar (Deshabilitado)"  class="Botones">
														<input type="Hidden" name="popup_activo" value="FormularioAcciones">
												</form>
										</td>-->';

							echo '</tr>';
					}
				echo '</table>';
			?>
				
			</div>
			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value="'.$MULTILANG_Cerrar.'" onClick="OcultarPopUp(\'FormularioAcciones\')">';
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
			if (@$popup_activo=="FormularioBotones")	echo '<script type="text/javascript">	AbrirPopUp("FormularioBotones"); </script>';
			if (@$popup_activo=="FormularioAcciones")	echo '<script type="text/javascript">	AbrirPopUp("FormularioAcciones"); </script>';
		?>

		<table><tr><td valign=top>
			<?php 
				abrir_ventana($MULTILANG_BarraHtas,'#BDB9B9',''); 
			?>
				<div align=center>
				<?php echo $MULTILANG_InfTablasOrigen; ?><br>
				<a href='javascript:AbrirPopUp("FormularioTablas");' title="<?php echo $MULTILANG_InfAgregaTabla; ?>" name=" "><img border='0' src='img/icono_tabla.png'/></a>
				<hr>
				<?php echo $MULTILANG_InfCamposOrigen; ?><br>
				<a href='javascript:AbrirPopUp("FormularioCampos");' title="<?php echo $MULTILANG_InfAgregaCampo; ?>" name=" "><img border='0' src='img/icono_campo.png'/></a>
				<hr>
				<?php echo $MULTILANG_InfCondiciones; ?><br>
				<a href='javascript:AbrirPopUp("FormularioCondiciones");' title="<?php echo $MULTILANG_InfFiltrar; ?>"><img border='0' src='img/icono_diseno.png'/></a>
				<hr>
				<?php echo $MULTILANG_InfAgrupa; ?><br>
				<a href='javascript:AbrirPopUp("FormularioAgrupacion");' title="<?php echo $MULTILANG_InfCampoAgrupa; ?>"><img border='0' src='img/icono_totalizar.png'/><img border='0' src='img/icono_ordenar.png'/></a>

				<?php
					// Si se trata de un informe con grafico como resultado agrega el boton de graficos
					if ($registro_informe['formato_final']=='G')
						{
				?>
					<hr>
					<?php echo $MULTILANG_InfPropGraf; ?><br>
					<a href='javascript:AbrirPopUp("FormularioGraficos");' title="<?php echo $MULTILANG_InfDesGraf; ?>"><img border='0' src='img/icono_grafico.png'/></a>
				<?php
						}// Fin si es grafico
				?>

				<?php
					// Si se trata de un informe tabular permite agregarle acciones a los registros
					if ($registro_informe['formato_final']=='T')
						{
				?>
					<hr>
					Acciones para cada registro<br>
					<a href='javascript:AbrirPopUp("FormularioBotones");' title="<?php echo $MULTILANG_InfDesAccion; ?>"><img border='0' src='img/icono_boton.png'/></a>
					&nbsp;&nbsp;
					<a href='javascript:AbrirPopUp("FormularioAcciones");' title="<?php echo $MULTILANG_FrmDesAcciones; ?>"><img border='0' src='img/icono_acciones.png'/></a>
				<?php
						}// Fin si es grafico
				?>

				<hr>
				<form action="<?php echo $ArchivoCORE; ?>" method="POST" name="cancelar"><input type="Hidden" name="accion" value="administrar_informes"></form>
				<input type="Button" onclick="document.cancelar.submit()" value="<?php echo $MULTILANG_InfVolver; ?>" class="Botones">
				</div><br>
			<?php
				cerrar_ventana();
			?>
			
		<?php
		echo '</td><td valign=top align=center>';  // Inicia segunda columna del diseñador
		?>


			<?php abrir_ventana($MULTILANG_InfParam,'f2f2f2',''); ?>
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="accion" value="actualizar_informe">
			<input type="Hidden" name="id" value="<?php echo $registro_informe['id']; ?>">

				<table class="TextosVentana">
					<tr>
						<td align="right"><?php echo $MULTILANG_InfTitulo; ?>:</td>
						<td><input type="text" name="titulo" value="<?php echo $registro_informe['titulo']; ?>" size="20" class="CampoTexto">
							<a href="#" title="<?php echo $MULTILANG_FrmObligatorio; ?>" name=""><img src="img/icn_12.gif" border=0></a>
							<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_InfDesTitulo; ?>"><img src="img/icn_10.gif" border=0></a>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $MULTILANG_InfDescripcion; ?></td>
						<td><input type="text" name="descripcion" size="20" value="<?php echo $registro_informe['descripcion']; ?>" class="CampoTexto">
							<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_InfDesDescrip; ?>"><img src="img/icn_10.gif" border=0></a>	</td>
					</tr>
					<tr>
						<td align="right"><?php echo $MULTILANG_InfCategoria; ?></td>
						<td><input type="text" name="categoria" value="<?php echo $registro_informe['categoria']; ?>" size="20" class="CampoTexto">
							<a href="#" title="<?php echo $MULTILANG_FrmObligatorio; ?>" name=""><img src="img/icn_12.gif" border=0></a>
							<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_InfDesCateg; ?>"><img src="img/icn_10.gif" border=0></a>
						</td>
					</tr>
					<tr>
						<td align="RIGHT" valign="TOP"><strong><?php echo $MULTILANG_InfNivelUsuario; ?></strong></td>
						<td>
							<select  name="nivel_usuario" id="nivel_usuario" class="Combos">
								<option value="-1" <?php if (@$registro_informe["nivel_usuario"]=="-1") echo 'selected'; ?> ><?php echo $MULTILANG_InfTodoUsuario; ?></option>
								<option value="1"  <?php if (@$registro_informe["nivel_usuario"]=="1") echo 'selected'; ?> >&#9733;</option>
								<option value="2"  <?php if (@$registro_informe["nivel_usuario"]=="2") echo 'selected'; ?> >&#9733;&#9733;</option>
								<option value="3"  <?php if (@$registro_informe["nivel_usuario"]=="3") echo 'selected'; ?> >&#9733;&#9733;&#9733;</option>
								<option value="4"  <?php if (@$registro_informe["nivel_usuario"]=="4") echo 'selected'; ?> >&#9733;&#9733;&#9733;&#9733;</option>
								<option value="5"  <?php if (@$registro_informe["nivel_usuario"]=="5") echo 'selected'; ?> >&#9733;&#9733;&#9733;&#9733;&#9733; SuperAdmin</option>
							</select>
							<a href="#" title="<?php echo $MULTILANG_InfTitNivel; ?>" name="<?php echo $MULTILANG_InfDesNivel; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $MULTILANG_FrmImagen; ?></td>
						<td>
							<input type="color" name="color_fondo" size="10" value="<?php if ($registro_informe["color_fondo"]!="") echo $registro_informe["color_fondo"]; else echo '#f2f2f2'; ?>" class="CampoTexto">
							<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmImagenDes; ?>"><img align="top" src="img/icn_10.gif" border=0></a>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $MULTILANG_FrmAncho; ?>:</td>
						<td><input type="text" name="ancho"  value="<?php echo $registro_informe['ancho']; ?>" size="4" class="CampoTexto"> (<?php echo $MULTILANG_InfHlpAnchoalto; ?>)
							<a href="#" title="<?php echo $MULTILANG_InfTitAncho; ?>" name="<?php echo $MULTILANG_InfDesAncho; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $MULTILANG_InfAlto; ?>:</td>
						<td><input type="text" name="alto"  value="<?php echo $registro_informe['alto']; ?>" size="4" class="CampoTexto">  (<?php echo $MULTILANG_InfHlpAnchoalto; ?>)
							<a href="#" title="<?php echo $MULTILANG_InfTitAlto; ?>" name="<?php echo $MULTILANG_InfDesAlto; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="RIGHT" valign="TOP"><strong><?php echo $MULTILANG_InfFormato; ?></strong></td>
						<td>
							<select  name="formato_final" id="formato_final" class="Combos">
								<option value="T"  <?php if ($registro_informe["formato_final"]=="T") echo 'selected'; ?> ><?php echo $MULTILANG_TablaDatos; ?></option>
								<option value="G"  <?php if ($registro_informe["formato_final"]=="G") echo 'selected'; ?> ><?php echo $MULTILANG_Grafico; ?></option>
							</select>
							<a href="#" title="<?php echo $MULTILANG_InfTitFormato; ?>" name="<?php echo $MULTILANG_InfDesFormato; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="RIGHT" valign="TOP"><?php echo $MULTILANG_InfGeneraPDF; ?></td>
						<td>
							<select  name="genera_pdf" id="genera_pdf" class="Combos">
								<option value="S" <?php if ($registro_informe["genera_pdf"]=="S") echo 'selected'; ?> ><?php echo $MULTILANG_Si; ?></option>
								<option value="N" <?php if ($registro_informe["genera_pdf"]=="N") echo 'selected'; ?> ><?php echo $MULTILANG_No; ?></option>
							</select>
							<a href="#" title="<?php echo $MULTILANG_InfGeneraPDFInfoTit; ?>" name="<?php echo $MULTILANG_InfGeneraPDFInfoDesc; ?>"><img src="img/icn_12.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td>
							</form>
						</td>
						<td>
							<input type="Button"  class="Botones" value="<?php echo $MULTILANG_InfActualizar; ?>" onClick="document.datos.submit()">
						</td>
					</tr>
				</table>
			<?php
				cerrar_ventana();
			?>


			<?php abrir_ventana($MULTILANG_InfVistaPrev,'f2f2f2',''); ?>

			<form action="<?php echo $ArchivoCORE; ?>" method="post" name="datosprevios" id="datosprevios" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			
			<input type="hidden" name="accion" value="cargar_objeto">
			<input type="hidden" name="objeto" value="inf:<?php echo $registro_informe['id']; ?>:1:htm:Informes:0">
			</form>

				<table width="100%" class="TextosVentana">
					<tr>
						<td>
							</form>
						</td>
						<td align=center>
							<?php echo $MULTILANG_InfHlpCarga; ?>: <br>
							<input type="Button"  class="Botones" value="<?php echo $MULTILANG_InfCargaPrev; ?>" onClick="document.datosprevios.submit()">
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
/*
	Function: eliminar_informe
	Elimina un informe de la aplicacion, incluyendo todos los registros asociados en otras tablas

	Variables de entrada:

		informe - ID del informe que sera eliminado

		(start code)
			DELETE FROM ".$TablasCore."informe WHERE id='$informe'
			DELETE FROM ".$TablasCore."informe_campos WHERE informe='$informe'
			DELETE FROM ".$TablasCore."informe_tablas WHERE informe='$informe'
			DELETE FROM ".$TablasCore."informe_condiciones WHERE informe='$informe'
			DELETE FROM ".$TablasCore."usuario_informe WHERE informe='$informe'
		(end)

	Salida:
		Informe eliminado

	Ver tambien:

		<editar_informe>
*/
if ($accion=="eliminar_informe")
	{
		ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe WHERE id=? ","$informe");
		ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_campos WHERE informe=? ","$informe");
		ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_tablas WHERE informe=? ","$informe");
		ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_condiciones WHERE informe=? ","$informe");
		ejecutar_sql_unaria("DELETE FROM ".$TablasCore."usuario_informe WHERE informe=? ","$informe");
		auditar("Elimina informe $informe");
		echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="accion" value="administrar_informes"></form>
				<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_informe
	Agrega un informe a la aplicacion

		(start code)
			INSERT INTO ".$TablasCore."informe VALUES (0, '$titulo','$descripcion','$categoria','$agrupamiento','$ordenamiento','$nivel_usuario','$ancho','$alto','$formato_final','|!|!|!|')
		(end)

	Salida:
		Informe agregado al sistema

	Ver tambien:

		<editar_informe>
*/
if ($accion=="guardar_informe")
	{
		$mensaje_error="";
		if ($titulo=="") $mensaje_error.=$MULTILANG_InfErrInforme1."<br>";
		if ($categoria=="") $mensaje_error.=$MULTILANG_InfErrInforme2."<br>";
		if ($mensaje_error=="")
			{
				ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe (".$ListaCamposSinID_informe.") VALUES (?,?,?,?,?,?,?,?,?,'|!|!|!|',?,?)","$titulo$_SeparadorCampos_$descripcion$_SeparadorCampos_$categoria$_SeparadorCampos_$agrupamiento$_SeparadorCampos_$ordenamiento$_SeparadorCampos_$nivel_usuario$_SeparadorCampos_$ancho$_SeparadorCampos_$alto$_SeparadorCampos_$formato_final$_SeparadorCampos_$genera_pdf$_SeparadorCampos_$color_fondo");
				$id=$ConexionPDO->lastInsertId();
				auditar("Crea informe $id");
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
				<input type="Hidden" name="accion" value="editar_informe">
				<input type="Hidden" name="informe" value="'.$id.'"></form>
							<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
		else
			{
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="administrar_informes">
					<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorDatos.'">
					<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: administrar_informes
	Presenta la lista de todos los informes definidos en el sistema con la posibilidad de agregar nuevos o de administrar los existentes.

	(start code)
		SELECT * FROM ".$TablasCore."informe ORDER BY titulo
	(end)

	Salida:
		Listado de informes y formulario para creacion de nuevos

	Ver tambien:
	<guardar_informe> | <eliminar_informe>
*/
if ($accion=="administrar_informes")
	{
		echo "<a href='javascript:abrir_ventana_popup(\"http://www.youtube.com/embed/M4kYe9nTeTA\",\"VideoTutorial\",\"toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, width=640, height=480\");'><img src='img/icono_screencast.png' alt='ScreenCast-VideoTutorial'></a>";
		 ?>

		<table class="TextosVentana"><tr><td valign=top>
			<?php abrir_ventana($MULTILANG_InfTituloAgr,'f2f2f2',''); ?>
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="accion" value="guardar_informe">
			<div align=center>

			<br><?php echo $MULTILANG_InfDetalles; ?>:
				<table class="TextosVentana">
					<tr>
						<td align="right"><?php echo $MULTILANG_InfTitulo; ?>:</td>
						<td><input type="text" name="titulo" size="20" class="CampoTexto">
							<a href="#" title="<?php echo $MULTILANG_FrmObligatorio; ?>" name=""><img src="img/icn_12.gif" border=0 align=absmiddle></a>
							<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_InfDesTitulo; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $MULTILANG_InfDescripcion; ?></td>
						<td><input type="text" name="descripcion" size="20" class="CampoTexto">
						<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_InfDesDescrip; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $MULTILANG_InfCategoria; ?></td>
						<td><input type="text" name="categoria" size="20" class="CampoTexto">
							<a href="#" title="<?php echo $MULTILANG_FrmObligatorio; ?>" name=""><img src="img/icn_12.gif" border=0 align=absmiddle></a>
							<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_InfDesCateg; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="RIGHT" valign="TOP"><strong><?php echo $MULTILANG_InfNivelUsuario; ?></strong></td>
						<td>
							<select  name="nivel_usuario" id="nivel_usuario" class="Combos">
								<option value="-1" <?php if (@$registro["nivel_usuario"]=="-1") echo 'selected'; ?> ><?php echo $MULTILANG_InfTodoUsuario; ?></option>
								<option value="1"  <?php if (@$registro["nivel_usuario"]=="1") echo 'selected'; ?> >&#9733;</option>
								<option value="2"  <?php if (@$registro["nivel_usuario"]=="2") echo 'selected'; ?> >&#9733;&#9733;</option>
								<option value="3"  <?php if (@$registro["nivel_usuario"]=="3") echo 'selected'; ?> >&#9733;&#9733;&#9733;</option>
								<option value="4"  <?php if (@$registro["nivel_usuario"]=="4") echo 'selected'; ?> >&#9733;&#9733;&#9733;&#9733;</option>
								<option value="5"  <?php if (@$registro["nivel_usuario"]=="5") echo 'selected'; ?> >&#9733;&#9733;&#9733;&#9733;&#9733; SuperAdmin</option>
							</select>
							<a href="#" title="<?php echo $MULTILANG_InfTitNivel; ?>" name="<?php echo $MULTILANG_InfDesNivel; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $MULTILANG_FrmImagen; ?></td>
						<td>
							<input type="color" name="color_fondo" size="10" value="#f2f2f2" class="CampoTexto">
							<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmImagenDes; ?>"><img align="top" src="img/icn_10.gif" border=0></a>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $MULTILANG_FrmAncho; ?>:</td>
						<td><input type="text" name="ancho" size="4" class="CampoTexto">  (<?php echo $MULTILANG_InfHlpAnchoalto; ?>)
							<a href="#" title="<?php echo $MULTILANG_InfTitAncho; ?>" name="<?php echo $MULTILANG_InfDesAncho; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $MULTILANG_InfAlto; ?>:</td>
						<td><input type="text" name="alto" size="4" class="CampoTexto">  (<?php echo $MULTILANG_InfHlpAnchoalto; ?>)
							<a href="#" title="<?php echo $MULTILANG_InfTitAlto; ?>" name="<?php echo $MULTILANG_InfDesAlto; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="RIGHT" valign="TOP"><strong><?php echo $MULTILANG_InfFormato; ?></strong></td>
						<td>
							<select  name="formato_final" id="formato_final" class="Combos">
								<option value="T"><?php echo $MULTILANG_TablaDatos; ?></option>
								<option value="G"><?php echo $MULTILANG_Grafico; ?></option>
							</select>
							<a href="#" title="<?php echo $MULTILANG_InfTitFormato; ?>" name="<?php echo $MULTILANG_InfDesFormato; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td align="RIGHT" valign="TOP"><?php echo $MULTILANG_InfGeneraPDF; ?></td>
						<td>
							<select  name="genera_pdf" id="genera_pdf" class="Combos">
								<option value="S"><?php echo $MULTILANG_Si; ?></option>
								<option value="N" selected><?php echo $MULTILANG_No; ?></option>
							</select>
							<a href="#" title="<?php echo $MULTILANG_InfGeneraPDFInfoTit; ?>" name="<?php echo $MULTILANG_InfGeneraPDFInfoDesc; ?>"><img src="img/icn_12.gif" border=0 align=absmiddle></a>
						</td>
					</tr>
					<tr>
						<td>
							</form>
						</td>
						<td>
							<input type="Button"  class="Botones" value="<?php echo $MULTILANG_FrmCreaDisena; ?>" onClick="document.datos.submit()">
							&nbsp;&nbsp;<input type="Button" onclick="document.core_ver_menu.submit()" value="<?php echo $MULTILANG_IrEscritorio; ?>" class="Botones">
						</td>
					</tr>
				</table>


		<?php
		cerrar_ventana();	
		
		echo '</td><td valign=top>';  // Inicia segunda columna del diseñador
		abrir_ventana($MULTILANG_InfDefinidos,'f2f2f2','');
		?>
				<table width="100%" border="0" cellspacing="5" align="CENTER"  class="TextosVentana">
					<tr>
						<td bgcolor="#d6d6d6"><b>Id</b></td>
						<td bgcolor="#D6D6D6"><b><?php echo $MULTILANG_Titulo; ?></b></td>
						<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_InfCategoria; ?></b></td>
						<td></td>
						<td></td>
					</tr>
		 <?php

				$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe." FROM ".$TablasCore."informe ORDER BY titulo");
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
												<input type="button" value="'.$MULTILANG_Eliminar.'"  class="BotonesCuidado" onClick="confirmar_evento(\''.$MULTILANG_InfAdvEliminar.'\',df'.$registro["id"].');">
										</form>
								</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST">
												<input type="hidden" name="accion" value="editar_informe">
												<input type="hidden" name="informe" value="'.$registro["id"].'">
												<input type="Submit" value="'.$MULTILANG_InfcamTabCond.'"  class="Botones">
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



/*
	Section: Operaciones de usuario final
	Funciones asociadas a la presentacion de informes para los usuarios finales de la aplicacion
*/

/* ################################################################## */
/* ################################################################## */
/*
	Function: mis_informes
	Presenta las ventanas organizando los informes por categoria segun los permisos del usuario.  Para el usuario administrador se visualizan todos los informes.

	Variables de entrada:

		Login_usuario - Identificador de usuario para filtrar los resultados

	(start code)
		SELECT COUNT(*) as conteo,categoria FROM ".$TablasCore."informe ".$Complemento_tablas." WHERE 1 ".$Complemento_condicion." GROUP BY categoria ORDER BY categoria
		Repetir por cada categoria
			SELECT * FROM ".$TablasCore."informe ".$Complemento_tablas." WHERE 1 AND categoria='".$seccion_menu_activa."' ".$Complemento_condicion." ORDER BY titulo
	(end)

	Salida:
		Listado de informes disponibles para el usuario organizados por Categoria en ventanas independientes

	Ver tambien:
	<administrar_informes>
*/
if ($accion=="mis_informes")
	{
			// Carga las opciones del ACORDEON DE INFORMES
			echo '<div align="center">
			<input type="Button" onclick="document.core_ver_menu.submit()" value=" <<< '.$MULTILANG_IrEscritorio.' " class="Botones">
			';
			// Si el usuario es diferente al administrador agrega condiciones al query
			if ($Login_usuario!="admin")
				{
					$Complemento_tablas=",".$TablasCore."usuario_informe";
					$Complemento_condicion=" AND ".$TablasCore."usuario_informe.informe=".$TablasCore."informe.id AND ".$TablasCore."usuario_informe.usuario='$Login_usuario'";  // AND nivel>0
				}
			$resultado=ejecutar_sql("SELECT COUNT(*) as conteo,categoria FROM ".$TablasCore."informe ".@$Complemento_tablas." WHERE 1 ".@$Complemento_condicion." GROUP BY categoria ORDER BY categoria");

			// Imprime las categorias encontradas para el usuario
			while($registro = $resultado->fetch())
				{
					//Crea la categoria en el acordeon
					$seccion_menu_activa=$registro["categoria"];
					$conteo_opciones=$registro["conteo"];
					abrir_ventana($MULTILANG_Informes.': '.$seccion_menu_activa.' ('.$conteo_opciones.')','fondo_ventanas2.gif','85%');
					// Busca las opciones dentro de la categoria

					// Si el usuario es diferente al administrador agrega condiciones al query
					if ($Login_usuario!="admin")
						{
							$Complemento_tablas=",".$TablasCore."usuario_informe";
							$Complemento_condicion=" AND ".$TablasCore."usuario_informe.informe=".$TablasCore."informe.id AND ".$TablasCore."usuario_informe.usuario='$Login_usuario'";  // AND nivel>0
						}
					$resultado_opciones_acordeon=ejecutar_sql("SELECT * FROM ".$TablasCore."informe ".@$Complemento_tablas." WHERE 1 AND categoria='".$seccion_menu_activa."' ".@$Complemento_condicion." ORDER BY titulo");

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
