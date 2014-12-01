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
/*
	Function: eliminar_datos_formulario
	Elimina los datos asociados sobre las tablas de aplicacion para un registro determinado.  Esta funcion es utilizada por los botones de Eliminar registro definidos como accion en un formulario

	Variables de entrada:

		formulario - ID unico de formulario sobre el cual se realiza la operacion de eliminacion
		campo - nombre del campo que debe ser usado para filtrar
		valor - valor a comparar sobre el campo y que es usado para determinar que registro eliminar

	(start code)
		SELECT * FROM ".$TablasCore."formulario WHERE id='$formulario'
		SELECT * FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND visible=1 AND valor_unico=1
		DELETE FROM ".$tabla." WHERE $campo='$valor'
	(end)

	Salida:
		Registro eliminado de la tabla de aplicacion

	Ver tambien:
		<guardar_datos_formulario>

*/
	if ($accion=="eliminar_datos_formulario")
		{
			$mensaje_error="";
			// Busca datos del formulario
			$consulta_formulario=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id=?","$formulario");
			$registro_formulario = $consulta_formulario->fetch();

			// Busca los campos del form marcados como valor unico y verifica que no existan valores en la tabla
			$tabla=$registro_formulario["tabla_datos"];

			$consulta_campos_unicos=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1 AND valor_unico=1","$formulario");
			while ($registro_campos_unicos = $consulta_campos_unicos->fetch())
				{
					$campo=$registro_campos_unicos["campo"];
					$valor=$$campo;
					// Busca si el campo cuenta con el valor en la tabla

					// Inserta los datos
					ejecutar_sql_unaria("DELETE FROM ".$tabla." WHERE $campo = $valor ");
					auditar("Elimina registro donde ".$campo." = ".$valor." en ".$tabla);
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="editar_formulario">
						<input type="Hidden" name="nombre_tabla" value="'.$tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="popup_activo" value="FormularioCampos">
					<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: actualizar_datos_formulario
	Actualiza un registro sobre la tabla de aplicacion cuando es llamada la accion de actualizar datos sobre un formulario.
	Tomando todos los datos del formulario construye un query valido en SQL para hacer la actualizacion de los datos que debieron recibirse por metodo POST desde el formulario

	Variables de entrada:

		formulario - ID unico de formulario sobre el cual se realiza la operacion de actualizacion
		lista de valores - obtenidos dinamicamente dependiendo de la definicion del formulario

	Salida:
		Registro agregado a la tabla de aplicacion

	Ver tambien:
		<eliminar_datos_formulario> | <guardar_datos_formulario>
*/
	if ($accion=="actualizar_datos_formulario")
		{
			// POR CORREGIR:  Si el diseno cuenta con varios campos que ven hacia un mismo campo de base de datos el query PUEDE no ser valido

			$mensaje_error="";

			// Busca datos del formulario
			$consulta_formulario=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id=?","$formulario");
			$registro_formulario = $consulta_formulario->fetch();

/*
			// Busca los campos del form marcados como valor unico y verifica que no existan valores en la tabla
			$tabla=$registro_formulario["tabla_datos"];
			$consulta_campos_unicos=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND visible=1 AND valor_unico=1");
			while ($registro_campos_unicos = $consulta_campos_unicos->fetch())
				{
					$campo=$registro_campos_unicos["campo"];
					$valor=$$campo;
					// Busca si el campo cuenta con el valor en la tabla
					$consulta_existente=ejecutar_sql("SELECT id FROM ".$tabla." WHERE $campo='$valor'");
					$registro_existente = $consulta_existente->fetch();
					if ($registro_existente["id"]!="")
						$mensaje_error.=$MULTILANG_ErrFrmDuplicado.$campo.'<br>';
				}
*/

			// Busca los campos del form marcados como obligatorios a los que no se les ingreso valor
			$tabla=$registro_formulario["tabla_datos"];
			$consulta_campos_obligatorios=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1 AND obligatorio=1","$formulario");
			while ($registro_campos_obligatorios = $consulta_campos_obligatorios->fetch())
				{
					$campo=$registro_campos_obligatorios["campo"];
					$valor=$$campo;
					// Verifica si es vacio para retornar el error
					if ($valor=="")
						$mensaje_error.=$MULTILANG_ErrFrmObligatorio.$campo.'<br>';
				}

			//Ejecuta consulta de actualizacion de datos
			if ($mensaje_error=="")
				{
					$cadena_nuevos_valores="";
					// Busca los campos del form y construye cadenas de valores para consulta
					$lista_campos="";
					$lista_valores="";

					$consulta_campos=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1 AND campo<>'id' ","$formulario");
					while ($registro_campos = $consulta_campos->fetch())
						{
							//Agrega el campo a la lista solamente si es de datos y si es diferente al campo ID que es usado para la actualizacion (objetos de tipo etiqueta o iframes son pasados por alto)
							if ($registro_campos["tipo"]!="url_iframe" && $registro_campos["tipo"]!="etiqueta" && $registro_campos["tipo"]!="informe")
								{
									//Verifica que el campo se encuentre dentro de la tabla, para descartar campos manuales mal escritos o usados para javascripts y otros fines.
									if (existe_campo_tabla($registro_campos["campo"],$registro_formulario["tabla_datos"]))
										{
											$cadena_nuevos_valores.=$registro_campos["campo"]."='".$$registro_campos["campo"]."',";
										}
								}
						}
					// Elimina comas al final de las listas
					$cadena_nuevos_valores=substr($cadena_nuevos_valores, 0, strlen($cadena_nuevos_valores)-1);

					// Actualiza los datos
					ejecutar_sql_unaria("UPDATE ".$registro_formulario["tabla_datos"]." SET $cadena_nuevos_valores WHERE id=? ","$id_registro_datos");
					auditar("Actualiza registro $id_registro_datos en ".$registro_formulario["tabla_datos"]);
					echo '<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<!-- <input type="Hidden" name="accion" value="editar_formulario"> -->
						<input type="Hidden" name="accion" value="Ver_menu">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrFrmDatos.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_datos_formulario
	Guarda un registro sobre la tabla de aplicacion cuando es llamada la accion de guardar datos sobre un formulario.  Tomando todos los datos del formulario construye un query valido en SQL para hacer la insercion de los datos que debieron recibirse por metodo POST desde el formulario

	Variables de entrada:

		formulario - ID unico de formulario sobre el cual se realiza la operacion de eliminacion
		lista de valores - obtenidos dinamicamente dependiendo de la definicion del formulario

	(start code)
		SELECT * FROM ".$TablasCore."formulario WHERE id='$formulario'
		SELECT * FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND visible=1 AND valor_unico=1
		SELECT id FROM ".$tabla." WHERE $campo='$valor'
		SELECT * FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND visible=1
		INSERT INTO ".$registro_formulario["tabla_datos"]." (".$lista_campos.") VALUES (".$lista_valores.")"
	(end)

	Salida:
		Registro agregado a la tabla de aplicacion

	Ver tambien:
		<eliminar_datos_formulario>
*/
	if ($accion=="guardar_datos_formulario")
		{
			// POR CORREGIR:  Si el diseno cuenta con varios campos que ven hacia un mismo campo de base de datos el query no es valido

			$mensaje_error="";

			// Busca datos del formulario
			$consulta_formulario=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id=? ","$formulario");
			$registro_formulario = $consulta_formulario->fetch();

			// Busca los campos del form marcados como valor unico y verifica que no existan valores en la tabla
			$tabla=$registro_formulario["tabla_datos"];
			$consulta_campos_unicos=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1 AND valor_unico=1","$formulario");
			while ($registro_campos_unicos = $consulta_campos_unicos->fetch())
				{
					$campo=$registro_campos_unicos["campo"];
					$valor=$$campo;
					// Busca si el campo cuenta con el valor en la tabla
					$consulta_existente=ejecutar_sql("SELECT id FROM ".$tabla." WHERE $campo='$valor'");
					$registro_existente = $consulta_existente->fetch();
					if ($registro_existente["id"]!="")
						$mensaje_error.=$MULTILANG_ErrFrmDuplicado.$campo.'<br>';
				}

			// Busca los campos del form marcados como obligatorios a los que no se les ingreso valor
			$tabla=$registro_formulario["tabla_datos"];
			$consulta_campos_obligatorios=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1 AND obligatorio=1","$formulario");
			while ($registro_campos_obligatorios = $consulta_campos_obligatorios->fetch())
				{
					$campo=$registro_campos_obligatorios["campo"];
					$valor=$$campo;
					// Verifica si es vacio para retornar el error
					if ($valor=="")
						$mensaje_error.=$MULTILANG_ErrFrmObligatorio.$campo.'<br>';
				}

			//Ejecuta consulta de insercion de datos
			$errores_de_carga="";
			if ($mensaje_error=="")
				{
					// Busca los campos visibles del form y construye cadenas de valores para consulta
					$lista_campos="";
					$lista_valores="";
					$lista_valores_interrogantes="";
					$lista_valores_concatenados="";

					$consulta_campos=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1","$formulario");
					while ($registro_campos = $consulta_campos->fetch())
						{
							//Hace la operacion con el campo solamente si es de datos (objetos de tipo etiqueta o iframes son pasados por alto)
							if ($registro_campos["tipo"]!="url_iframe" && $registro_campos["tipo"]!="etiqueta" && $registro_campos["tipo"]!="informe")
								{
									//Verifica que el campo se encuentre dentro de la tabla, para descartar campos manuales mal escritos o usados para javascripts y otros fines.
									if (existe_campo_tabla($registro_campos["campo"],$registro_formulario["tabla_datos"]))
										{
											// Si el tipos de campo es archivo lo procesa como adjunto, sino lo pasa al insert
											if ($registro_campos["tipo"]=="archivo_adjunto")
												{
													// Procesa el archivo y lo almacena en el path de acuerdo a la plantilla definida
													$variable_de_archivo=$registro_campos["campo"];
													$nombre_archivo = $_FILES[$variable_de_archivo]['name']; //Contiene el nombre original
													$tipo_archivo = $_FILES[$variable_de_archivo]['type']; //Contiene el tipo original, ej: application/octet-stream, application/x-php, image/jpeg
													$tamano_archivo = $_FILES[$variable_de_archivo]['size']; //Tamano del archivo cargado
													$nombre_archivo_temporal = $_FILES[$variable_de_archivo]['tmp_name']; //Nombre del archivo temporal en servidor
													$peso_final_permitido=$registro_campos["peso_archivo"]*1024;
													// Comprueba tamano del archivo
													if ($tamano_archivo > $peso_final_permitido)
														{
															$errores_de_carga.=$nombre_archivo.'- '.$MULTILANG_FrmErrorCargaTamano;
														}
													else
														{
															// Crea el path definitivo del archivo
															$path_final_archivo="mod/fileman/cargas/"; // Path predeterminado
															//En caso de no tener plantilla intentara cargarlo con su nombre original
															if ($registro_campos["plantilla_archivo"]=="")
																$path_final_archivo.=$nombre_archivo;
															else
																$path_final_archivo.=$registro_campos["plantilla_archivo"];
															// Busca ocurrencias de las cadenas de formato y las reemplaza
															$cadena_formato_a_buscar="_ORIGINAL_";
															$cadena_formato_a_reemplazar=$nombre_archivo;
															if (strpos($path_final_archivo,$cadena_formato_a_buscar)!==FALSE) // Booleana requiere === o !==
																$path_final_archivo=str_replace($cadena_formato_a_buscar,$cadena_formato_a_reemplazar,$path_final_archivo);
															$cadena_formato_a_buscar="_CAMPOTABLA_";
															$cadena_formato_a_reemplazar=$registro_campos["campo"];
															if (strpos($path_final_archivo,$cadena_formato_a_buscar)!==FALSE) // Booleana requiere === o !==
																$path_final_archivo=str_replace($cadena_formato_a_buscar,$cadena_formato_a_reemplazar,$path_final_archivo);
															$cadena_formato_a_buscar="_FECHA_";
															$cadena_formato_a_reemplazar=$fecha_operacion;
															if (strpos($path_final_archivo,$cadena_formato_a_buscar)!==FALSE) // Booleana requiere === o !==
																$path_final_archivo=str_replace($cadena_formato_a_buscar,$cadena_formato_a_reemplazar,$path_final_archivo);
															$cadena_formato_a_buscar="_HORA_";
															$cadena_formato_a_reemplazar=$hora_operacion;
															if (strpos($path_final_archivo,$cadena_formato_a_buscar)!==FALSE) // Booleana requiere === o !==
																$path_final_archivo=str_replace($cadena_formato_a_buscar,$cadena_formato_a_reemplazar,$path_final_archivo);
															$cadena_formato_a_buscar="_HORAINTERNET_";
															$cadena_formato_a_reemplazar=date("B");
															if (strpos($path_final_archivo,$cadena_formato_a_buscar)!==FALSE) // Booleana requiere === o !==
																$path_final_archivo=str_replace($cadena_formato_a_buscar,$cadena_formato_a_reemplazar,$path_final_archivo);
															$cadena_formato_a_buscar="_USUARIO_";
															$cadena_formato_a_reemplazar=$Login_usuario;
															if (strpos($path_final_archivo,$cadena_formato_a_buscar)!==FALSE) // Booleana requiere === o !==
																$path_final_archivo=str_replace($cadena_formato_a_buscar,$cadena_formato_a_reemplazar,$path_final_archivo);
															$cadena_formato_a_buscar="_MICRO_";
															$cadena_formato_a_reemplazar=date("u");
															if (strpos($path_final_archivo,$cadena_formato_a_buscar)!==FALSE) // Booleana requiere === o !==
																$path_final_archivo=str_replace($cadena_formato_a_buscar,$cadena_formato_a_reemplazar,$path_final_archivo);
															// Intenta la carga del archivo solo si realmente se recibio uno
															if($nombre_archivo!="")
																if (!move_uploaded_file($nombre_archivo_temporal, $path_final_archivo ))
																	$errores_de_carga.=$nombre_archivo.'- '.$MULTILANG_FrmErrorCargaGeneral;
															//Agrega el campo y su path a la lista de campos para el query
															$lista_campos.=$registro_campos["campo"].",";
															$lista_valores.="'".$path_final_archivo."|".$tipo_archivo."',";
															//Cadenas de valores usados para hacer consultas Binded con PDO
															$lista_valores_interrogantes.="?,";
															$lista_valores_concatenados.=$path_final_archivo."|".$tipo_archivo.$_SeparadorCampos_;
														}
												}
											else
												{
													$nombre_de_campo_query=$registro_campos["campo"].",";
													//ANTES DE QUERY CON PARAMETROS $valor_de_campo_query="'".$$registro_campos["campo"]."',";
													$valor_de_campo_query=$$registro_campos["campo"];
													//Compresion previa para campos especiales (MUY experimental por cuanto puede generar errores de query)
														if ($registro_campos["tipo"]=="objeto_canvas" || $registro_campos["tipo"]=="objeto_camara")
															$valor_de_campo_query=gzencode($valor_de_campo_query,9);
													//Agrega el campo y su valor a la lista de campos para el query
													$lista_campos.=$nombre_de_campo_query;
													$lista_valores.=$valor_de_campo_query;
													$lista_valores_interrogantes.="?,";
													$lista_valores_concatenados.=$valor_de_campo_query.$_SeparadorCampos_;
												}
										}
								}
						}

					// Elimina comas al final de las listas
					$lista_campos=substr($lista_campos, 0, strlen($lista_campos)-1);
					$lista_valores=substr($lista_valores, 0, strlen($lista_valores)-1);
					$lista_valores_interrogantes=substr($lista_valores_interrogantes, 0, strlen($lista_valores_interrogantes)-1);
					//Elimina separador de campo al final de valores concatenados
					$lista_valores_concatenados=substr($lista_valores_concatenados, 0, strlen($lista_valores_concatenados)-strlen($_SeparadorCampos_));					

					//Inserta los datos del registro en BD
					//ANTES DEL QUERY CON PARAMETROS: ejecutar_sql_unaria("INSERT INTO ".$registro_formulario["tabla_datos"]." (".$lista_campos.") VALUES (".$lista_valores.")");
					ejecutar_sql_unaria("INSERT INTO ".$registro_formulario["tabla_datos"]." (".$lista_campos.") VALUES (".$lista_valores_interrogantes.")",$lista_valores_concatenados);
					auditar("Inserta registro en ".$registro_formulario["tabla_datos"]);
					//Si no hay errores en carga de archivos redirecciona normal, sino redirecciona con los errores
					if ($errores_de_carga=="")
						echo '<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
					else
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="Ver_menu">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrFrmDatos.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="error_descripcion" value="'.$errores_de_carga.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<!-- <input type="Hidden" name="accion" value="editar_formulario"> -->
						<input type="Hidden" name="accion" value="Ver_menu">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrFrmDatos.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: eliminar_accion_formulario
	Elimina un boton creado para un formulario

	Variables de entrada:

		boton - ID unico del boton sobre el cual se realiza la operacion de eliminacion

	(start code)
		DELETE FROM ".$TablasCore."formulario_boton WHERE id='$boton'
	(end)

	Salida:
		Registro de boton eliminado y formulario actualizado en pantalla

	Ver tambien:
		<eliminar_campo_formulario>
*/
	if ($accion=="eliminar_accion_formulario")
		{
			ejecutar_sql_unaria("DELETE FROM ".$TablasCore."formulario_boton WHERE id=? ","$boton");
			auditar("Elimina accion del formulario $formulario");
			echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
			<input type="Hidden" name="accion" value="editar_formulario">
			<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
			<input type="Hidden" name="formulario" value="'.$formulario.'">
			<input type="Hidden" name="popup_activo" value="FormularioAcciones">
			</form>
			<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: eliminar_campo_formulario
	Elimina un campo de datos, etiqueta, marco externo o informe creado para un formulario

	Variables de entrada:

		campo - ID unico del elemento sobre el cual se realiza la operacion de eliminacion

	(start code)
		DELETE FROM ".$TablasCore."formulario_objeto WHERE id='$campo' 
	(end)

	Salida:
		Registro de campo eliminado y formulario actualizado en pantalla

	Ver tambien:
		<eliminar_accion_formulario>
*/
	if ($accion=="eliminar_campo_formulario")
		{
			ejecutar_sql_unaria("DELETE FROM ".$TablasCore."formulario_objeto WHERE id=? ","$campo");
			auditar("Elimina campo del formulario $formulario");
			echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
			<input type="Hidden" name="accion" value="editar_formulario">
			<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
			<input type="Hidden" name="formulario" value="'.$formulario.'">
			<input type="Hidden" name="popup_activo" value="FormularioDiseno">
			</form>
			<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: actualizar_campo_formulario
	Actualiza un campo de datos, etiqueta, marco externo o informe en un formulario

	Variables de entrada:

		multiples - Recibidas mediante formulario unico asociado al proceso de creacion/edicion del elemento.

	(start code)
		UPDATE ".$TablasCore."formulario_objeto SET ... Lista da campos
	(end)

	Salida:
		Registro de campo alterado y formulario actualizado en pantalla

	Ver tambien:
		<eliminar_campo_formulario> | <agregar_campo_formulario>
*/
	if ($accion=="actualizar_campo_formulario")
		{
			$mensaje_error="";

			//Concatena el campo manual en caso de encontrar alguno
			$campo=$campo.$campo_manual;

			if (@$valor_unico=="on") $valor_unico=1; else $valor_unico=0;
			if (@$ajax_busqueda=="on") $ajax_busqueda=1; else $ajax_busqueda=0;
			$tipo_objeto=$tipo;
			if ($titulo=="" && ($tipo_objeto!="etiqueta" && $tipo_objeto!="url_iframe" && $tipo_objeto!="informe" && $tipo_objeto!="frm" && $tipo_objeto!="form_consulta") ) $mensaje_error=$MULTILANG_ErrFrmCampo1;
			if ($campo==""  && ($tipo_objeto!="etiqueta" && $tipo_objeto!="url_iframe" && $tipo_objeto!="informe" && $tipo_objeto!="frm" && $tipo_objeto!="form_consulta") ) $mensaje_error=$MULTILANG_ErrFrmCampo2;
			if ($mensaje_error=="")
				{
					//Genera la lista de campos a ser actualizados desde la definicion de tabla para no olvidar ninguno
					$ListaCampos=explode(",",$ListaCamposSinID_formulario_objeto);
					for ($i=0; $i<count($ListaCampos);$i++)
						@$ListaCamposyValores.=$ListaCampos[$i]."='".$$ListaCampos[$i]."',";
					$ListaCamposyValores.="id=id"; //Agregado para evitar coma final

					ejecutar_sql_unaria("UPDATE ".$TablasCore."formulario_objeto SET ".$ListaCamposyValores." WHERE id=?","$idcampomodificado");
					auditar("Modifica diseno campo $idcampomodificado para formulario $formulario");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="accion" value="editar_formulario">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="editar_formulario">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrFrmDatos.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_campo_formulario
	Agrega un campo de datos, etiqueta, marco externo o informe a un formulario

	Variables de entrada:

		multiples - Recibidas mediante formulario unico asociado al proceso de creacion del elemento.

	(start code)
		INSERT INTO ".$TablasCore."formulario_objeto VALUES (0,'$tipo_objeto','$titulo','$campo','$ayuda_titulo','$ayuda_texto','$formulario','$peso','$columna','$obligatorio','$visible','$valor_predeterminado','$validacion_datos','$etiqueta_busqueda','$ajax_busqueda','$valor_unico','$solo_lectura','$teclado_virtual','$ancho','$alto','$barra_herramientas','$fila_unica','$lista_opciones','$origen_lista_opciones','$origen_lista_valores','$valor_etiqueta','$url_iframe','$objeto_en_ventana','$informe_vinculado')
	(end)

	Salida:
		Registro agregado y formulario actualizado en pantalla

	Ver tambien:
		<eliminar_campo_formulario>
*/
	if ($accion=="guardar_campo_formulario")
		{
			$mensaje_error="";
			$tipo_objeto=$tipo;

			//Concatena el campo manual en caso de encontrar alguno
			$campo=$campo.$campo_manual;

			if (@$valor_unico=="on") $valor_unico=1; else $valor_unico=0;
			if (@$ajax_busqueda=="on") $ajax_busqueda=1; else $ajax_busqueda=0;
			if (@$titulo=="" && ($tipo_objeto!="etiqueta" && $tipo_objeto!="url_iframe" && $tipo_objeto!="informe" && $tipo_objeto!="frm" && $tipo_objeto!="form_consulta") ) $mensaje_error=$MULTILANG_ErrFrmCampo1;
			if (@$campo==""  && ($tipo_objeto!="etiqueta" && $tipo_objeto!="url_iframe" && $tipo_objeto!="informe" && $tipo_objeto!="frm" && $tipo_objeto!="form_consulta") ) $mensaje_error=$MULTILANG_ErrFrmCampo2;

			if ($mensaje_error=="")
				{
					//Genera la lista de campos a ser insertados desde la definicion de tabla para no olvidar ninguno
					$ListaCampos=explode(",",$ListaCamposSinID_formulario_objeto);
					$ListaInterrogantes="";
					for ($i=0; $i<count($ListaCampos);$i++)
						{
							$ListaInterrogantes.="?,";
							@$ListaCamposyValores.=$$ListaCampos[$i].$_SeparadorCampos_;
						}
					//Elimina partes finales innecesarias (coma y separador de campos)
					$ListaInterrogantes = substr ($ListaInterrogantes, 0, - 1);
					$ListaCamposyValores = substr ($ListaCamposyValores, 0, strlen($_SeparadorCampos_)*(-1));
					// Define la consulta de insercion del nuevo campo
					$consulta_insercion="INSERT INTO ".$TablasCore."formulario_objeto (".$ListaCamposSinID_formulario_objeto.") VALUES (".$ListaInterrogantes.")";
					ejecutar_sql_unaria($consulta_insercion,"$ListaCamposyValores");
					$id=$ConexionPDO->lastInsertId();
					auditar("Crea campo $id para formulario $formulario");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="accion" value="editar_formulario">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="editar_formulario">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrFrmDatos.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_accion_formulario
	Agrega un boton con una accion determinada para un formulario

	Variables de entrada:

		multiples - Recibidas mediante formulario unico asociado al proceso de creacion del elemento.

	(start code)
		INSERT INTO ".$TablasCore."formulario_boton VALUES (0, '$titulo','$estilo','$formulario','$tipo_accion','$accion_usuario','$visible','$peso','$retorno_titulo','$retorno_texto','$confirmacion_texto')
	(end)

	Salida:
		Registro agregado y formulario actualizado en pantalla

	Ver tambien:
		<eliminar_accion_formulario>
*/
	if ($accion=="guardar_accion_formulario")
		{
			$mensaje_error="";
			if ($titulo=="") $mensaje_error=$MULTILANG_ErrFrmCampo3;
			if ($tipo_accion=="") $mensaje_error=$MULTILANG_ErrFrmCampo4;
			if ($mensaje_error=="")
				{
					$accion_usuario=addslashes($accion_usuario);
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."formulario_boton (".$ListaCamposSinID_formulario_boton.") VALUES (?,?,?,?,?,?,?,?,?,?)","$titulo$_SeparadorCampos_$estilo$_SeparadorCampos_$formulario$_SeparadorCampos_$tipo_accion$_SeparadorCampos_$accion_usuario$_SeparadorCampos_$visible$_SeparadorCampos_$peso$_SeparadorCampos_$retorno_titulo$_SeparadorCampos_$retorno_texto$_SeparadorCampos_$confirmacion_texto");
					$id=$ConexionPDO->lastInsertId();
					auditar("Crea boton $id para formulario $formulario");
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
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrFrmDatos.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: editar_formulario
	Despliega las ventanas requeridas para agregar los diferentes elementos al formulario como campos, etiquetas, marcos y acciones

	Variables de entrada:

		formulario - ID unico de identificacion del formulario sobre el cual se hace la edicion

	(start code)
		SELECT * FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' ORDER BY columna,peso,titulo
	(end)

	Salida:
		Ventanas con herramientas de edicion y vista previa del formulario en pantalla
*/
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
					OcultarCampos(31);
					// Muestra campos segun tipo de objeto
					if (tipo_objeto_activo=="texto_corto")   VisualizarCampos("1,2,3,4,5,6,7,8,9,10,11,12,13,14,17,25");
					if (tipo_objeto_activo=="texto_clave")   VisualizarCampos("1,2,6,7,8,9,10,13,17,25");
					if (tipo_objeto_activo=="texto_largo")   VisualizarCampos("1,2,6,7,8,9,10,14,15,17");
					if (tipo_objeto_activo=="texto_formato") VisualizarCampos("1,2,6,7,8,9,10,14,15,16,17");
					if (tipo_objeto_activo=="lista_seleccion") VisualizarCampos("1,2,7,8,9,10,15,17,18,19,20,35");
					if (tipo_objeto_activo=="lista_radio") VisualizarCampos("1,2,7,8,9,10,17,18,19,20,35");
					if (tipo_objeto_activo=="etiqueta")   VisualizarCampos("9,17,21");
					if (tipo_objeto_activo=="url_iframe")   VisualizarCampos("9,14,15,17,22,24");
					if (tipo_objeto_activo=="informe")   VisualizarCampos("9,17,23,24");
					if (tipo_objeto_activo=="deslizador")   VisualizarCampos("1,2,4,7,8,9,17,26");
					if (tipo_objeto_activo=="campo_etiqueta")   VisualizarCampos("1,2,4,9,17,14,15,27");
					if (tipo_objeto_activo=="archivo_adjunto")   VisualizarCampos("1,2,7,8,9,17,28,29");
					if (tipo_objeto_activo=="objeto_canvas")   VisualizarCampos("1,2,7,8,9,10,14,15,17,24,30,31");
					if (tipo_objeto_activo=="objeto_camara")   VisualizarCampos("1,2,7,8,9,10,14,15,17,24,31");
					if (tipo_objeto_activo=="form_consulta")   VisualizarCampos("9,17,24,32,33,34");
					//Vuelve a centrar el formulario de acuerdo al nuevo contenido
					AbrirPopUp("FormularioCampos");
				}
		</script>


		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioCampos' class="FormularioPopUps">
				<?php 
				abrir_ventana($MULTILANG_FrmMsj1,'#BDB9B9','');
				
				//Si se trata de la edicion de un campo entonces busca su registro para agregar valores al form
				if (@$popup_activo=="FormularioCampos")
					{
						$consulta_campo_editar=@ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE id=? ","$campo");
						$registro_campo_editar = $consulta_campo_editar->fetch();
					}
				?>
				<form name="datosform" id="datosform" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<?php 
					//Define tipo de accion si se trata de creacion o modificacion
					if (@$popup_activo=="FormularioCampos")
						echo '<input type="Hidden" name="accion" value="actualizar_campo_formulario">';
					else
						echo '<input type="Hidden" name="accion" value="guardar_campo_formulario">';
				?>
				<input type="Hidden" name="nombre_tabla" value="<?php echo $nombre_tabla; ?>">
				<input type="Hidden" name="formulario" value="<?php echo $formulario; ?>">
				<input type="Hidden" name="idcampomodificado" value="<?php echo $campo; ?>">
				<div align=center>

					<table class="TextosVentana">
						<tr>
							<td align="right"><?php echo $MULTILANG_FrmTipoObjeto; ?></td>
							<td>
								<select  name="tipo" class="Combos" OnChange="CambiarCamposVisibles(this.options[this.selectedIndex].value);">
									<option value="0"><?php echo $MULTILANG_SeleccioneUno; ?></option>
									<optgroup label="<?php echo $MULTILANG_FrmTipoTit1; ?>">
										<option value="texto_corto"     <?php if (@$registro_campo_editar["tipo"]=="texto_corto")     echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmTipo1; ?></option>
										<option value="texto_clave"     <?php if (@$registro_campo_editar["tipo"]=="texto_clave")     echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmTipo10; ?></option>
										<option value="texto_largo"     <?php if (@$registro_campo_editar["tipo"]=="texto_largo")     echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmTipo2; ?></option>
										<option value="texto_formato"   <?php if (@$registro_campo_editar["tipo"]=="texto_formato")   echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmTipo3; ?></option>
										<option value="lista_seleccion" <?php if (@$registro_campo_editar["tipo"]=="lista_seleccion") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmTipo4; ?></option>
										<option value="lista_radio"     <?php if (@$registro_campo_editar["tipo"]=="lista_radio")     echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmTipo5; ?></option>
										<option value="deslizador"      <?php if (@$registro_campo_editar["tipo"]=="deslizador")      echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmTipo9; ?></option>
										<option value="campo_etiqueta"  <?php if (@$registro_campo_editar["tipo"]=="campo_etiqueta")  echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmTipo11; ?></option>
									</optgroup>
									<optgroup label="<?php echo $MULTILANG_FrmTipoTit4; ?>">
										<option value="archivo_adjunto" <?php if (@$registro_campo_editar["tipo"]=="archivo_adjunto") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmTipo12; ?></option>
										<option value="objeto_canvas" <?php if (@$registro_campo_editar["tipo"]=="objeto_canvas") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmTipo13; ?></option>
										<option value="objeto_camara" <?php if (@$registro_campo_editar["tipo"]=="objeto_camara") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmTipo14; ?></option>
									</optgroup>
									<optgroup label="<?php echo $MULTILANG_FrmTipoTit2; ?>">
										<option value="etiqueta"        <?php if (@$registro_campo_editar["tipo"]=="etiqueta")        echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmTipo6; ?></option>
										<option value="url_iframe"      <?php if (@$registro_campo_editar["tipo"]=="url_iframe")      echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmTipo7; ?></option>
									</optgroup>
									<optgroup label="<?php echo $MULTILANG_FrmTipoTit3; ?>">
										<option value="informe"         <?php if (@$registro_campo_editar["tipo"]=="informe")         echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmTipo8; ?></option>
										<option value="form_consulta"	  <?php if (@$registro_campo_editar["tipo"]=="form_consulta")   echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmTipo15; ?></option>
									</optgroup>
								</select>
								<a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>" name=""><img src="img/icn_12.gif" border=0></a>
							</td>
						</tr>
						</table>
						<hr>

						<div id='campo1' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmTitulo; ?>:</td>
								<td width="400" >
									<input type="text" name="titulo" size="20" class="CampoTexto" value="<?php echo @$registro_campo_editar["titulo"]; ?>">
									<a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>" name=""><img src="img/icn_12.gif" border=0></a>
									<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesTitulo; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>

						<div id='campo2' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmCampo; ?></td>
								<td width="400" ><?php echo $nombre_tabla; ?>.
									<select  name="campo" class="Combos" >
										<option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
										<?php
											$resultadocampos=consultar_columnas($nombre_tabla);
											for($i=0;$i<count($resultadocampos);$i++)
												{
													$seleccion_campo="";
													if ($resultadocampos[$i]["nombre"]!="id")
														{
															if (@$registro_campo_editar["campo"]==@$resultadocampos[$i]["nombre"])
																$seleccion_campo="SELECTED";
															if (@strtolower($resultadocampos["nombre"])!="id")
																echo '<option value="'.$resultadocampos[$i]["nombre"].'" '.$seleccion_campo.'>'.$resultadocampos[$i]["nombre"].'&nbsp;&nbsp;&nbsp;'.$resultadocampos[$i]["tipo"].'</option>';								
														}
												}
										?>
									</select>
									<a href="#" title="<?php echo $MULTILANG_FrmCampoOb1; ?>" name=""><img src="img/icn_12.gif" border=0></a>
									<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesCampo; ?>"><img src="img/icn_10.gif" border=0></a>
									<br>
									<?php echo $MULTILANG_InfCampoManual; ?>: <input type="text" name="campo_manual" size="20" class="CampoTexto" value="<?php if (!@existe_campo_tabla($registro_campo_editar["campo"],$nombre_tabla)) echo @$registro_campo_editar["campo"]; ?>">
								</td>
							</tr>
							</table>
						</div>


						<div id='campo3' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmValUnico; ?>:</td>
								<td width="400" >
									<input type="checkbox" name="valor_unico" <?php if (@$registro_campo_editar["valor_unico"]==1) echo 'checked'; ?>>
									<a href="#" title="<?php echo $MULTILANG_FrmTitUnico; ?>" name="<?php echo $MULTILANG_FrmDesUnico; ?>"><img src="img/icn_10.gif" border=0></a>	</td>
							</tr>
							</table>
						</div>


						<div id='campo4' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmPredeterminado; ?>:</td>
								<td width="400" >
									<input type="text" name="valor_predeterminado" size="20" class="CampoTexto" value="<?php echo @$registro_campo_editar["valor_predeterminado"]; ?>">
									<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesPredeterminado; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo5' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmValida; ?>:</td>
								<td width="400" >
									<select  name="validacion_datos" class="Combos" >
										<option value=""><?php $MULTILANG_Ninguno; ?></option>
										<option value="numerico"     <?php if (@$registro_campo_editar["validacion_datos"]=="numerico")     echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmValida1; ?></option>
										<option value="alfabetico"   <?php if (@$registro_campo_editar["validacion_datos"]=="alfabetico")   echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmValida2; ?></option>
										<option value="alfanumerico" <?php if (@$registro_campo_editar["validacion_datos"]=="alfanumerico") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmValida3; ?></option>
										<option value="fecha"        <?php if (@$registro_campo_editar["validacion_datos"]=="fecha")        echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmValida4; ?></option>
									</select>
									<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmValidaDes; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo6' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmLectura; ?></td>
								<td width="400" >
									<select  name="solo_lectura" class="Combos" >
										<option value="READONLY" <?php if (@$registro_campo_editar["solo_lectura"]=="READONLY") echo 'SELECTED'; ?>><?php echo $MULTILANG_Si; ?></option>
										<option value=""         <?php if (@$registro_campo_editar["solo_lectura"]=="")         echo 'SELECTED'; ?>><?php echo $MULTILANG_No; ?></option>
									</select>
									<a href="#" title="<?php echo $MULTILANG_FrmTitLectura; ?>" name="<?php echo $MULTILANG_FrmDesLectura; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo7' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmAyuda; ?></td>
								<td width="400" >
									<input type="text" name="ayuda_titulo" size="20" class="CampoTexto" value="<?php echo @$registro_campo_editar["ayuda_titulo"]; ?>">
									<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesAyuda; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo8' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200"   valign="top" align="right"><?php echo $MULTILANG_FrmTxtAyuda; ?></td>
								<td width="400"  colspan=2 valign="top">
									<textarea name="ayuda_texto" cols="25" rows="2" class="AreaTexto" onkeypress="return FiltrarTeclas(this, event)"><?php echo @$registro_campo_editar["ayuda_texto"]; ?></textarea>
									<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesTxtAyuda; ?>"><img align="top" src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo9' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td colspan=2>
								<table width="100%" class="TextosVentana"><tr>
									<td align="right"><?php echo $MULTILANG_Peso; ?>:</td>
									<td>
										<select name="peso" class="selector_01" >
											<?php
												for ($i=1;$i<=100;$i++)
													{
														$seleccion_campo="";
														if ($registro_campo_editar["peso"]==$i)
															$seleccion_campo="SELECTED";														
														echo '<option value="'.$i.'" '.$seleccion_campo.'>'.$i.'</option>';
													}
											?>
										</select><a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesPeso; ?>"><img align="top" src="img/icn_10.gif" border=0></a>
									</td>
									<td align="right"><?php echo $MULTILANG_Columna; ?></td>
									<td>
										<select name="columna" class="selector_01" >
											<?php
												// Obtiene numero de columnas para el formulario
												$consulta_columnas=ejecutar_sql("SELECT columnas FROM ".$TablasCore."formulario WHERE id=? ","$formulario");
												$registro_columnas = $consulta_columnas->fetch();
												$columnas_formulario=$registro_columnas["columnas"];
												for ($i=1;$i<=$columnas_formulario;$i++)
													{
														$seleccion_campo="";
														if ($registro_campo_editar["columna"]==$i)
															$seleccion_campo="SELECTED";
														echo '<option value="'.$i.'" '.$seleccion_campo.'>'.$i.'</option>';
													}
											?>
										</select><a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesColumna; ?>"><img src="img/icn_10.gif" border=0></a>
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
								<td align="right"><?php echo $MULTILANG_FrmObligatorio; ?></td>
								<td>
									<select  name="obligatorio" class="Combos" >
										<option value="1" <?php if (@$registro_campo_editar["obligatorio"]==1) echo 'SELECTED'; ?>><?php echo $MULTILANG_Si; ?></option>
										<option value="0" <?php if (@$registro_campo_editar["obligatorio"]==0) echo 'SELECTED'; ?>><?php echo $MULTILANG_No; ?></option>
									</select>
								</td>
								<td align="right"><?php echo $MULTILANG_FrmVisible; ?></td>
								<td>
									<select  name="visible" class="Combos" >
										<option value="1" <?php if (@$registro_campo_editar["visible"]=="1") echo 'SELECTED'; ?>><?php echo $MULTILANG_Si; ?></option>
										<option value="0" <?php if (@$registro_campo_editar["visible"]=="0") echo 'SELECTED'; ?>><?php echo $MULTILANG_No; ?></option>
									</select>
									<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesVisible; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
								</tr></table>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo11' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmLblBusqueda; ?>:</td>
								<td width="400" >
									<input type="text" name="etiqueta_busqueda" size="10" class="CampoTexto" value="<?php echo @$registro_campo_editar["etiqueta_busqueda"]; ?>">
									<a href="#" title="<?php echo $MULTILANG_FrmTitBusqueda; ?>" name="<?php echo $MULTILANG_FrmDesBusqueda; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo12' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmAjax; ?>:</td>
								<td width="400" >
									<input type="checkbox" name="ajax_busqueda" <?php if (@$registro_campo_editar["ajax_busqueda"]==1) echo 'checked'; ?>>
									<a href="#" title="<?php echo $MULTILANG_FrmTitAjax; ?>" name="<?php echo $MULTILANG_FrmDesAjax; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo13' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmTeclado; ?>:</td>
								<td width="400" >
									<select  name="teclado_virtual" class="Combos" >
										<option value="1" <?php if (@$registro_campo_editar["teclado_virtual"]==1) echo 'SELECTED'; ?>><?php echo $MULTILANG_Si; ?></option>
										<option value="0" <?php if (@$registro_campo_editar["teclado_virtual"]==0) echo 'SELECTED'; ?>><?php echo $MULTILANG_No; ?></option>
									</select>
									<a href="#" title="<?php echo $MULTILANG_FrmTitTeclado; ?>" name="<?php echo $MULTILANG_FrmDesTeclado; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo14' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmAncho; ?>:</td>
								<td width="400" >
									<input type="text" name="ancho" size="4" class="CampoTexto" value="<?php echo @$registro_campo_editar["ancho"]; ?>">
									<a href="#" title="<?php echo $MULTILANG_FrmTitAncho; ?>" name="<?php echo $MULTILANG_FrmDesAncho; ?>"><img src="img/icn_10.gif" border=0></a>
									<i>(<?php echo $MULTILANG_FrmDesAncho2; ?>)</i>
								</td>
							</tr>
							</table>
						</div>

						<div id='campo15' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmAlto; ?>:</td>
								<td width="400" >
									<input type="text" name="alto" size="4" class="CampoTexto" value="<?php echo @$registro_campo_editar["alto"]; ?>">
									<a href="#" title="<?php echo $MULTILANG_FrmTitAlto; ?>" name="<?php echo $MULTILANG_FrmDesAlto; ?>"><img src="img/icn_10.gif" border=0></a>
									<i>(<?php echo $MULTILANG_FrmDesAlto2; ?>)</i>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo16' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmBarra; ?>:</td>
								<td width="400" >
									<select  name="barra_herramientas" class="Combos" >
										<option value="0" <?php if (@$registro_campo_editar["barra_herramientas"]=="0") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmBarraTipo1; ?></option>
										<option value="1" <?php if (@$registro_campo_editar["barra_herramientas"]=="1") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmBarraTipo2; ?></option>
										<option value="2" <?php if (@$registro_campo_editar["barra_herramientas"]=="2") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmBarraTipo3; ?></option>
										<option value="3" <?php if (@$registro_campo_editar["barra_herramientas"]=="3") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmBarraTipo4; ?></option>
										<option value="4" <?php if (@$registro_campo_editar["barra_herramientas"]=="4") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmBarraTipo5; ?></option>
									</select>
									<a href="#" title="<?php echo $MULTILANG_FrmTitBarra; ?>" name="<?php echo $MULTILANG_FrmDesBarra; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo17' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmFila; ?></td>
								<td width="400" >
									<select  name="fila_unica" class="Combos" >
										<option value="0" <?php if (@$registro_campo_editar["fila_unica"]=="0") echo 'SELECTED'; ?>><?php echo $MULTILANG_No; ?></option>
										<option value="1" <?php if (@$registro_campo_editar["fila_unica"]=="1") echo 'SELECTED'; ?>><?php echo $MULTILANG_Si; ?></option>
									</select>
									<a href="#" title="<?php echo $MULTILANG_FrmTitFila; ?>" name="<?php echo $MULTILANG_FrmDesFila; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo18' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmLista; ?>:</td>
								<td width="400" >
									<input type="text" name="lista_opciones" size="30" class="CampoTexto" value="<?php echo @$registro_campo_editar["lista_opciones"]; ?>">
									<a href="#" title="<?php echo $MULTILANG_FrmTitLista; ?>" name="<?php echo $MULTILANG_FrmDesLista; ?>"><img src="img/icn_10.gif" border=0></a>
									(<?php echo $MULTILANG_FrmDesLista2; ?>)
								</td>
							</tr>
							</table>
						</div>


						<div id='campo19' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmOrigen; ?>:</td>
								<td width="400" >
									<select  name="origen_lista_opciones" class="Combos" >
										<option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
									<?php
										$resultado=consultar_tablas();
										while ($registro = $resultado->fetch())
											{
												// Imprime solamente las tablas de aplicacion, es decir, las que no cumplen prefijo de internas de Practico
												if (strpos($registro[0],$TablasCore)===FALSE)  // Booleana requiere === o !==
													{
														echo '<optgroup label="'.str_replace($TablasApp,'',$registro[0]).'" >';
														//Busca los campos de la tabla
														$nombre_tabla_opc=$registro[0];
														$resultadocampos=consultar_columnas($nombre_tabla_opc);
														for($i=0;$i<count($resultadocampos);$i++)
															{
																$seleccion_campo="";
																if (@$registro_campo_editar["origen_lista_opciones"]==$nombre_tabla_opc.'.'.$resultadocampos[$i]["nombre"])
																	$seleccion_campo="SELECTED";
																echo '<option value="'.$nombre_tabla_opc.'.'.$resultadocampos[$i]["nombre"].'" '.$seleccion_campo.'>'.$resultadocampos[$i]["nombre"].'&nbsp;&nbsp;&nbsp;'.$resultadocampos[$i]["tipo"].'</option>';								
															}
														echo '</optgroup>';
													}
											}
									?>
									</select>
									<a href="#" title="<?php echo $MULTILANG_FrmTitOrigen; ?>" name=""><img src="img/icn_12.gif" border=0></a>
									<a href="#" title="<?php echo $MULTILANG_FrmTitOrigen2; ?>" name="<?php echo $MULTILANG_FrmDesOrigen; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo20' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmOrigenVal; ?>:</td>
								<td width="400" >
									<select  name="origen_lista_valores" class="Combos" >
										<option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
									<?php
										$resultado=consultar_tablas();
										while ($registro = $resultado->fetch())
											{
												// Imprime solamente las tablas de aplicacion, es decir, las que no cumplen prefijo de internas de Practico
												if (strpos($registro[0],$TablasCore)===FALSE)  // Booleana requiere === o !==
													{
														echo '<optgroup label="'.str_replace($TablasApp,'',$registro[0]).'" >';
														//Busca los campos de la tabla
														$nombre_tabla_val=$registro[0];
														$resultadocampos=consultar_columnas($nombre_tabla_val);
														for($i=0;$i<count($resultadocampos);$i++)
															{
																$seleccion_campo="";
																if (@$registro_campo_editar["origen_lista_valores"]==$nombre_tabla_val.'.'.$resultadocampos[$i]["nombre"])
																	$seleccion_campo="SELECTED";
																echo '<option value="'.$nombre_tabla_val.'.'.$resultadocampos[$i]["nombre"].'" '.$seleccion_campo.'>'.$resultadocampos[$i]["nombre"].'&nbsp;&nbsp;&nbsp;'.$resultadocampos[$i]["tipo"].'</option>';								
															}
														echo '</optgroup>';
													}
											}
									?>
									</select>
									<a href="#" title="<?php echo $MULTILANG_FrmTitOrigenVal; ?>" name=""><img src="img/icn_12.gif" border=0></a>
									<a href="#" title="<?php echo $MULTILANG_FrmTitOrigen2; ?>" name="<?php echo $MULTILANG_FrmDesOrigenVal; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo21' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td colspan=2>
									<?php echo $MULTILANG_FrmEtiqueta; ?>:<br>
									<textarea cols="100" rows="20" name="valor_etiqueta" id="valor_etiqueta" class="ckeditor"><?php echo @$registro_campo_editar["valor_etiqueta"]; ?></textarea>
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
								<td width="200" align="right"><?php echo $MULTILANG_FrmURL; ?>:</td>
								<td width="400" >
									<input type="text" name="url_iframe" size="40" class="CampoTexto" value="<?php echo @$registro_campo_editar["url_iframe"]; ?>">
									<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesURL; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo23' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmInforme; ?>:</td>
								<td width="400" >
									<select  name="informe_vinculado" class="Combos">
									<option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
									<?php
										$consulta_informs=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe." FROM ".$TablasCore."informe ORDER BY titulo");
										while($registro_informes = $consulta_informs->fetch())
											{
												$seleccion_campo="";
												if ($registro_campo_editar["informe_vinculado"]==$registro_informes["id"])
													$seleccion_campo="SELECTED";
												echo '<option value="'.$registro_informes["id"].'" '.$seleccion_campo.'>(Id.'.$registro_informes["id"].') '.$registro_informes["titulo"].'</option>';
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
								<td width="200" align="right"><?php echo $MULTILANG_FrmVentana; ?></td>
								<td width="400" >
									<select  name="objeto_en_ventana" class="Combos" >
										<option value="0" <?php if (@$registro_campo_editar["objeto_en_ventana"]=="0") echo 'SELECTED'; ?>><?php echo $MULTILANG_No; ?></option>
										<option value="1" <?php if (@$registro_campo_editar["objeto_en_ventana"]=="1") echo 'SELECTED'; ?>><?php echo $MULTILANG_Si; ?></option>
									</select>
									<a href="#" title="<?php echo $MULTILANG_Importante; ?>" name="<?php echo $MULTILANG_FrmDesVentana; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo25' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmLongMaxima; ?>:</td>
								<td width="400" >
									<input type="text" name="maxima_longitud" size="4" class="CampoTexto" value="<?php echo @$registro_campo_editar["maxima_longitud"]; ?>">
									<a href="#" title="<?php echo $MULTILANG_FrmTit1LongMaxima; ?>"><img src="img/icn_10.gif" border=0></a>
									<i>(<?php echo $MULTILANG_FrmTit2LongMaxima; ?>)</i>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo26' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmValorMinimo; ?>:</td>
								<td width="400" >
									<input type="text" name="valor_minimo" size="4" class="CampoTexto" value="<?php if (@$registro_campo_editar["valor_minimo"]!='1') echo @$registro_campo_editar["valor_minimo"]; else echo '1'; ?>">
								</td>
							</tr>
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmValorMaximo; ?>:</td>
								<td width="400" >
									<input type="text" name="valor_maximo" size="4" class="CampoTexto" value="<?php if (@$registro_campo_editar["valor_maximo"]!='100') echo @$registro_campo_editar["valor_maximo"]; else echo '100'; ?>">
								</td>
							</tr>
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmValorSalto; ?>:</td>
								<td width="400" >
									<input type="text" name="valor_salto" size="4" class="CampoTexto" value="<?php if (@$registro_campo_editar["valor_salto"]!='1') echo @$registro_campo_editar["valor_salto"]; else echo '1'; ?>">
									<a href="#" title="<?php echo $MULTILANG_FrmTitValorSalto; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo27' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmFormatoSalida; ?> <img src="img/icn_bar.png" border=0 align=absmiddle>:</td>
								<td width="400" >
									<select  name="formato_salida" class="Combos">
									<option value=""><?php echo $MULTILANG_MnuTexto; ?></option>
									<optgroup label="<?php echo $MULTILANG_CodigoBarras; ?>">
										<option value="std25" <?php if (@$registro_campo_editar["formato_salida"]=="std25") echo "SELECTED"; ?> >Standard 2 of 5 (industrial, Numerio Sin limite)</option>
										<option value="int25" <?php if (@$registro_campo_editar["formato_salida"]=="int25") echo "SELECTED"; ?> >Interleaved 2 of 5</option>
										<option value="ean8" <?php if (@$registro_campo_editar["formato_salida"]=="ean8") echo "SELECTED"; ?> >EAN 8 (Numerico 7 caracteres)</option>
										<option value="ean13" <?php if (@$registro_campo_editar["formato_salida"]=="ean13") echo "SELECTED"; ?> >EAN 13 (Numerico 12 caracteres)</option>
										<option value="upc" <?php if (@$registro_campo_editar["formato_salida"]=="upc") echo "SELECTED"; ?> >UPC</option>
										<option value="code11" <?php if (@$registro_campo_editar["formato_salida"]=="code11") echo "SELECTED"; ?> >Code 11</option>
										<option value="code39" <?php if (@$registro_campo_editar["formato_salida"]=="code39") echo "SELECTED"; ?> >Code 39</option>
										<option value="code93" <?php if (@$registro_campo_editar["formato_salida"]=="code93") echo "SELECTED"; ?> >Code 93</option>
										<option value="code128" <?php if (@$registro_campo_editar["formato_salida"]=="code128") echo "SELECTED"; ?> >Code 128</option>
										<option value="codabar" <?php if (@$registro_campo_editar["formato_salida"]=="codabar") echo "SELECTED"; ?> >CodaBar</option>
										<option value="msi" <?php if (@$registro_campo_editar["formato_salida"]=="msi") echo "SELECTED"; ?> >MSI</option>
									</optgroup>
									<optgroup label="<?php echo $MULTILANG_Matriz; ?>">
										<option value="datamatrix" <?php if (@$registro_campo_editar["formato_salida"]=="datamatrix") echo "SELECTED"; ?> >Datamatrix (ASCII+extended)</option>
										<option value="qrcode" <?php if (@$registro_campo_editar["formato_salida"]=="qrcode") echo "SELECTED"; ?> >QR-Code</option>
									</optgroup>
									</select>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo28' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right" valign=top><?php echo $MULTILANG_FrmPlantillaArchivo; ?></td>
								<td width="400" >
									<input type="text" name="plantilla_archivo" size="40" class="CampoTexto" value="<?php echo @$registro_campo_editar["plantilla_archivo"]; ?>">
									<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesPlantillaArchivo; ?>"><img src="img/icn_10.gif" border=0></a>
									<br><?php echo $MULTILANG_FrmPlantillaEjemplos; ?>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo29' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_Peso; ?> (Max)</td>
								<td width="400" >
									<select  name="peso_archivo" class="Combos">
										<option value="50">50 KB</option>
										<option value="100" <?php if (@$registro_campo_editar["peso_archivo"]=="100") echo "SELECTED"; ?> >100 KB</option>
										<option value="150" <?php if (@$registro_campo_editar["peso_archivo"]=="150") echo "SELECTED"; ?> >150 KB</option>
										<option value="250" <?php if (@$registro_campo_editar["peso_archivo"]=="250") echo "SELECTED"; ?> >250 KB</option>
										<option value="500" <?php if (@$registro_campo_editar["peso_archivo"]=="500") echo "SELECTED"; ?> >500 KB</option>
										<option value="750" <?php if (@$registro_campo_editar["peso_archivo"]=="750") echo "SELECTED"; ?> >750 KB</option>
										<option value="1000" <?php if (@$registro_campo_editar["peso_archivo"]=="1000") echo "SELECTED"; ?> >1 MB</option>
										<option value="1500" <?php if (@$registro_campo_editar["peso_archivo"]=="1500") echo "SELECTED"; ?> >1.5 MB</option>
										<option value="2000" <?php if (@$registro_campo_editar["peso_archivo"]=="2000") echo "SELECTED"; ?> >2 MB</option>
										<option value="4000" <?php if (@$registro_campo_editar["peso_archivo"]=="4000") echo "SELECTED"; ?> >4 MB</option>
										<option value="8000" <?php if (@$registro_campo_editar["peso_archivo"]=="8000") echo "SELECTED"; ?> >8 MB</option>
										<option value="16000" <?php if (@$registro_campo_editar["peso_archivo"]=="16000") echo "SELECTED"; ?> >16 MB</option>
									</select>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo30' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmTipoPincel; ?></td>
								<td width="400" >
									<img src="img/ginux_Prorgrams.png" border=0 width="20" height="20" align="absmiddle">
									<select  name="tamano_pincel" class="Combos">
										<option value="1">1</option>
										<option value="2" <?php if (@$registro_campo_editar["tamano_pincel"]=="2") echo "SELECTED"; ?> >2</option>
										<option value="3" <?php if (@$registro_campo_editar["tamano_pincel"]=="3") echo "SELECTED"; ?> >3</option>
										<option value="4" <?php if (@$registro_campo_editar["tamano_pincel"]=="4") echo "SELECTED"; ?> >4</option>
										<option value="5" <?php if (@$registro_campo_editar["tamano_pincel"]=="5") echo "SELECTED"; ?> >5</option>
										<option value="7" <?php if (@$registro_campo_editar["tamano_pincel"]=="7") echo "SELECTED"; ?> >7</option>
										<option value="10" <?php if (@$registro_campo_editar["tamano_pincel"]=="10") echo "SELECTED"; ?> >10</option>
										<option value="15" <?php if (@$registro_campo_editar["tamano_pincel"]=="15") echo "SELECTED"; ?> >15</option>
										<option value="20" <?php if (@$registro_campo_editar["tamano_pincel"]=="20") echo "SELECTED"; ?> >20</option>
										<option value="25" <?php if (@$registro_campo_editar["tamano_pincel"]=="25") echo "SELECTED"; ?> >25</option>
									</select> (Pixels)
								</td>
							</tr>
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmTipoColor; ?> (Hex)</td>
								<td width="400" >
									<img src="img/dev_UniversalBinary.png" border=0 width="20" height="20" align="absmiddle">
									<input type="color" name="color_trazo" size="10" value="<?php if ($registro_campo_editar["color_trazo"]!="") echo $registro_campo_editar["color_trazo"]; else echo '#000000'; ?>" class="CampoTexto">
									<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmImagenDes; ?>"><img align="top" src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo31' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td colspan=2 align="center"><?php echo $MULTILANG_FrmTipoAdvertencia; ?></td>
							</tr>							
							</table>
						</div>


						<div id='campo32' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmFormulario; ?>:</td>
								<td width="400" >
									<select  name="formulario_vinculado" class="Combos">
									<option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
									<?php
										$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario ORDER BY titulo");
										while($registro_formularios = $consulta_forms->fetch())
											{
												$seleccion_campo="";
												if ($registro_campo_editar["formulario_vinculado"]==$registro_formularios["id"])
													$seleccion_campo="SELECTED";
												echo '<option value="'.$registro_formularios["id"].'" '.$seleccion_campo.'>(Id.'.$registro_formularios["id"].') '.$registro_formularios["titulo"].'</option>';
											}
									?>
									</select>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo33' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmCampo; ?></td>
								<td width="400" >
									<input type="text" name="formulario_campo_vinculo" size="20" class="CampoTexto" value="<?php echo @$registro_campo_editar["formulario_campo_vinculo"]; ?>">
									<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesCampoVinculo; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo34' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmCampo; ?></td>
								<td width="400" >
									<input type="text" name="formulario_campo_foraneo" size="20" class="CampoTexto" value="<?php echo @$registro_campo_editar["formulario_campo_foraneo"]; ?>">
									<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesCampoForaneo; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo35' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td width="200" align="right"><?php echo $MULTILANG_FrmFiltroLista; ?></td>
								<td width="400" >
									<input type="text" name="condicion_filtrado_listas" size="50" class="CampoTexto" value="<?php echo @$registro_campo_editar["condicion_filtrado_listas"]; ?>">
									<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesFiltroLista; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr>
							</table>
						</div>


					<?php
						//Despues de agregar todos los parametros de campos, Si se detecta que es edicion de un campo se llama a la funcion de visualizacion de campos especificos
						if (@$popup_activo=="FormularioCampos")
							echo '	<script TYPE="text/javascript" LANGUAGE="JavaScript">
										CambiarCamposVisibles("'.$registro_campo_editar["tipo"].'");
									</script>';
					?>

					<table class="TextosVentana">
						<tr>
							<td>
								</form>
							</td>
							<td>
								<input type="Button"  class="Botones" value="<?php echo $MULTILANG_FrmBtnGuardar; ?>" onClick="document.datosform.submit()">
							</td>
						</tr>
					</table>
			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value=" '.$MULTILANG_Cancelar.' " onClick="OcultarPopUp(\'FormularioCampos\')">';
				cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>

		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioBotones' class="FormularioPopUps">
			<?php
			abrir_ventana($MULTILANG_FrmAgregaBot,'BDB9B9','');
			?>
				<form name="datosfield" id="datosfield" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="accion" value="guardar_accion_formulario">
				<input type="Hidden" name="nombre_tabla" value="<?php echo $nombre_tabla; ?>">
				<input type="Hidden" name="formulario" value="<?php echo $formulario; ?>">
				<div align=center>

					<table class="TextosVentana">
						<tr>
							<td align="right"><?php echo $MULTILANG_FrmTituloBot; ?>:</td>
							<td ><input type="text" name="titulo" size="20" class="CampoTexto">
								<a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>" name=""><img src="img/icn_12.gif" border=0></a>
								<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesBot; ?>"><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td align="right"><?php echo $MULTILANG_FrmEstilo; ?></td>
							<td>
								<select  name="estilo" class="Combos" >
									<option value="BotonesEstado"><?php echo $MULTILANG_FrmEstilo1; ?></option>
									<option value="BotonesEstadoCuidado"><?php echo $MULTILANG_FrmEstilo2; ?></option>
								</select>
							<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesEstilo; ?>"><img src="img/icn_10.gif" border=0></a>	</td>
						</tr>
						<tr>
							<td align="right"><?php echo $MULTILANG_FrmTipoAccion; ?></td>
							<td>
								<select  name="tipo_accion" class="Combos" >
									<option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
									<optgroup label="<?php echo $MULTILANG_FrmAccionT1; ?>">
										<option value="interna_guardar"><?php echo $MULTILANG_FrmAccionGuardar; ?></option>
										<option value="interna_actualizar"><?php echo $MULTILANG_FrmAccionActualizar; ?></option>
										<option value="interna_eliminar"><?php echo $MULTILANG_FrmAccionEliminar; ?></option>
										<option value="interna_escritorio"><?php echo $MULTILANG_FrmAccionRegresar; ?></option>
										<option value="interna_cargar"><?php echo $MULTILANG_FrmAccionCargar; ?></option>
										<option value="interna_limpiar"><?php echo $MULTILANG_FrmAccionLimpiar; ?></option>
									</optgroup>
									<optgroup label="<?php echo $MULTILANG_FrmAccionT2; ?>">
										<option value="externa_formulario"><?php echo $MULTILANG_FrmAccionExterna; ?></option>
										<option value="externa_javascript"><?php echo $MULTILANG_FrmAccionJS; ?></option>
									</optgroup>
								</select>
							<a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>" name=""><img src="img/icn_12.gif" border=0></a>
							<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesAccion; ?>"><img src="img/icn_10.gif" border=0></a>	</td>
						</tr>
						<tr>
							<td align="right"><?php echo $MULTILANG_FrmAccionCMD; ?>:</td>
							<td ><input type="text" name="accion_usuario" size="20" class="CampoTexto">
								<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmAccionDesCMD; ?>"><img src="img/icn_10.gif" border=0></a>
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
									</select><a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesPeso; ?>"><img align="top" src="img/icn_10.gif" border=0></a>
								</td>
								<td align="right"><?php echo $MULTILANG_FrmVisible; ?></td>
								<td>
									<select  name="visible" class="Combos" >
										<option value="1"><?php echo $MULTILANG_Si; ?></option>
										<option value="0"><?php echo $MULTILANG_No; ?></option>
									</select><a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmBotDesVisible; ?>"><img src="img/icn_10.gif" border=0></a>
								</td>
							</tr></table>
							</td>
						</tr>
						<tr>
							<td align="right"><?php echo $MULTILANG_FrmRetorno; ?></td>
							<td >
								<input type="text" name="retorno_titulo" size="20" class="CampoTexto">
								<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesRetorno; ?>"><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td   valign="top" align="right"><?php echo $MULTILANG_FrmTxtRetorno; ?></td>
							<td  colspan=2 valign="top">
								<textarea name="retorno_texto" cols="25" rows="1" class="AreaTexto"></textarea>
								<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmTxtDesRetorno; ?>"><img align="top" src="img/icn_10.gif" border=0></a>
							</td>
						</tr>
						<tr>
							<td align="right"><?php echo $MULTILANG_FrmConfirma; ?></td>
							<td >
								<input type="text" name="confirmacion_texto" size="20" class="CampoTexto">
								<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesConfirma; ?>"><img src="img/icn_10.gif" border=0></a>
							</td>
						</tr>

						<tr>
							<td>
								</form>
							</td>
							<td>
								<input type="Button"  class="Botones" value="<?php echo $MULTILANG_FrmBtnGuardarBut; ?>" onClick="document.datosfield.submit()">
							</td>
						</tr>
					</table>
				</br>
			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value=" '.$MULTILANG_Cancelar.' " onClick="OcultarPopUp(\'FormularioBotones\')">';
				cerrar_barra_estado();
				cerrar_ventana();		// Cierra adicion de botones
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>



		<!-- INICIO DE MARCOS POPUP -->
		<div id='FormularioDiseno' class="FormularioPopUps">
			<?php
				abrir_ventana($MULTILANG_FrmDisCampos,'#BDB9B9','');
			?>
				<DIV style="DISPLAY: block; OVERFLOW: auto; WIDTH: 100%; POSITION: relative; HEIGHT: 550px">
					<table width="100%" border="0" cellspacing="5" align="CENTER" class="TextosVentana">
						<tr>
							<td bgcolor="#D6D6D6"><b><?php echo $MULTILANG_Titulo; ?> (<?php echo $MULTILANG_Tipo?>)</b></td>
							<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_Campo; ?></b></td>
							<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_Columna; ?></b></td>
							<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_Peso; ?></b></td>
							<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_FrmObligatorio; ?></b> <a href="#" title="<?php echo $MULTILANG_Importante; ?>" name="<?php echo $MULTILANG_FrmDesObliga; ?>"><img src="img/icn_10.gif" align="absmiddle" border=0></a></td>
							<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_FrmVisible; ?></b></td>
							<td></td>
							<td></td>
						</tr>
			 <?php


				$consulta=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? ORDER BY columna,peso,titulo","$formulario");
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
						echo '		</select></form> <a href="javascript:ifoc'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmGuardaCol.'" name=""><img src="img/guardar.gif" border=0></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								
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
										<a href="javascript:ifoce'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmAumentaPeso.'" name=""><img src="img/bajar.png" border=0></a> 
										'.$registro["peso"].'
										<a href="javascript:ifopa'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmDisminuyePeso.'" name=""><img src="img/subir.png" border=0></a>
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
											echo '<input type="hidden" name="valor" value="0"><a href="javascript:ifo'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'" name=""><img src="img/on.png" border=0></a>';
										else
											echo '<input type="hidden" name="valor" value="1"><a href="javascript:ifo'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'" name=""><img src="img/off.png" border=0></a>';
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
										echo '<input type="hidden" name="valor" value="0"><a href="javascript:if'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'" name=""><img src="img/on.png" border=0></a>';
									else
										echo '<input type="hidden" name="valor" value="1"><a href="javascript:if'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'" name=""><img src="img/off.png" border=0></a>';
								echo '</form></td>';
								if ($registro["peso"]!="0")
									{
										echo '<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" name="f'.$registro["id"].'" id="f'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
														<input type="hidden" name="accion" value="eliminar_campo_formulario">
														<input type="hidden" name="campo" value="'.$registro["id"].'">
														<input type="hidden" name="formulario" value="'.$formulario.'">
														<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
														<input type="button" value="'.$MULTILANG_Eliminar.'"  class="BotonesCuidado" onClick="confirmar_evento(\''.$MULTILANG_FrmAdvDelCampo.'\',f'.$registro["id"].');">
														<input type="Hidden" name="popup_activo" value="FormularioDiseno">
												</form>
										</td>

										<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
														<input type="hidden" name="accion" value="editar_formulario">
														<input type="hidden" name="campo" value="'.$registro["id"].'">
														<input type="hidden" name="formulario" value="'.$formulario.'">
														<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
														<input type="Submit" value="'.$MULTILANG_Editar.'"  class="Botones">
														<input type="Hidden" name="popup_activo" value="FormularioCampos">
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
				</DIV>
			</div>
			<?php
				abrir_barra_estado();
					echo '<input type="Button"  class="BotonesEstadoCuidado" value=" '.$MULTILANG_Cancelar.' " onClick="OcultarPopUp(\'FormularioDiseno\')">';
				cerrar_barra_estado();
				cerrar_ventana();
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
							<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_FrmTipoAcc; ?></b></td>
							<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_FrmAccUsuario; ?></b></td>
							<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_FrmOrden; ?></b></td>
							<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_FrmVisible; ?></b></td>
							<td></td>
							<td></td>
						</tr>
			 <?php
				$consulta_botones=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_boton." FROM ".$TablasCore."formulario_boton WHERE formulario='$formulario' ORDER BY peso,id");
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
												<input type="hidden" name="tabla" value="formulario_boton">
												<input type="hidden" name="campo" value="visible">
												<input type="hidden" name="formulario" value="'.$formulario.'">
												<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
												<input type="hidden" name="accion_retorno" value="editar_formulario">
												<input type="Hidden" name="popup_activo" value="FormularioAcciones">
											';
									if ($registro["visible"])
										echo '<input type="hidden" name="valor" value="0"><a href="javascript:bif'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'" name=""><img src="img/on.png" border=0></a>';
									else
										echo '<input type="hidden" name="valor" value="1"><a href="javascript:bif'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'" name=""><img src="img/off.png" border=0></a>';
								echo '</form></td>';
										echo '<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" name="bf'.$registro["id"].'" id="bf'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
														<input type="hidden" name="accion" value="eliminar_accion_formulario">
														<input type="hidden" name="boton" value="'.$registro["id"].'">
														<input type="hidden" name="formulario" value="'.$formulario.'">
														<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
														<input type="button" value="'.$MULTILANG_Eliminar.'"  class="BotonesCuidado" onClick="confirmar_evento(\''.$MULTILANG_FrmAdvDelBoton.'\',bf'.$registro["id"].');">
														<input type="Hidden" name="popup_activo" value="FormularioAcciones">
												</form>
										</td>
										<!--
										<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
														<input type="hidden" name="accion" value="editar_campo_formulario">
														<input type="hidden" name="campo" value="'.$registro["id"].'">
														<input type="hidden" name="formulario" value="'.$formulario.'">
														<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
														<input type="Button" value="'.$MULTILANG_Editar.'"  class="Botones">
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
					echo '<input type="Button"  class="BotonesEstadoCuidado" value=" '.$MULTILANG_Cancelar.' " onClick="OcultarPopUp(\'FormularioAcciones\')">';
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

		<table><tr><td align=center valign=top>
			<?php 
				abrir_ventana($MULTILANG_BarraHtas,'#BDB9B9','100%'); 
			?>
				<div align=center>
				<?php echo $MULTILANG_FrmObjetos; ?><br>
				<a href='javascript:AbrirPopUp("FormularioCampos");' title="<?php echo $MULTILANG_FrmDesObjetos; ?>" name=" "><img border='0' src='img/icono_campo.png'/></a>
				&nbsp;&nbsp;
				<a href='javascript:AbrirPopUp("FormularioDiseno");' title="<?php echo $MULTILANG_FrmDesCampos; ?>"><img border='0' src='img/icono_diseno.png'/></a>
				<hr>
				<?php echo $MULTILANG_FrmAcciones; ?><br>
				<a href='javascript:AbrirPopUp("FormularioBotones");' title="<?php echo $MULTILANG_FrmDesBoton; ?>"><img border='0' src='img/icono_boton.png'/></a>
				&nbsp;&nbsp;
				<a href='javascript:AbrirPopUp("FormularioAcciones");' title="<?php echo $MULTILANG_FrmDesAcciones; ?>"><img border='0' src='img/icono_acciones.png'/></a>
				<hr>
				<form action="<?php echo $ArchivoCORE; ?>" method="POST" name="cancelar"><input type="Hidden" name="accion" value="administrar_formularios"></form>
				<input type="Button" onclick="document.cancelar.submit()" value="<?php echo $MULTILANG_FrmVolverLista; ?>" class="Botones">
				</div><br>
			<?php
				cerrar_ventana();



				// Inicia presentacion de ventana de edicion de formulario
				$consulta_form=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id=? ","$formulario");
				$registro_form = $consulta_form->fetch();
				abrir_ventana($MULTILANG_FrmActualizar,'f2f2f2','100%');
			?>
			<form name="datosact" id="datosact" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="accion" value="actualizar_formulario">
			<input type="Hidden" name="nombre_tabla" value="<?php echo $nombre_tabla; ?>">
			<input type="Hidden" name="formulario" value="<?php echo $registro_form["id"]; ?>">

				<!-- INICIO DE MARCOS POPUP -->
				<div id='FormularioScripts' class="FormularioPopUps">
					<?php
						abrir_ventana($MULTILANG_FrmTitComandos,'#BDB9B9','');
					?>
						<table width="100%" border="0" cellspacing="5" align="CENTER" class="TextosVentana">
							<tr>
								<td>
									<?php echo $MULTILANG_FrmHlpFunciones; ?>
								</td>
							</tr>
							<tr>
								<td align=center>
									<textarea name="javascript" cols="100" rows="20" style="font-size:12px; font-family: Monospace, Sans-serif, Tahoma; border: 1px dotted #000099;"><?php echo $registro_form["javascript"]; ?></textarea>
								</td>
							</tr>
						</table>
					<?php
						abrir_barra_estado();
							echo '<input type="Button"  class="BotonesEstadoCuidado" value=" '.$MULTILANG_Finalizado.' " onClick="OcultarPopUp(\'FormularioScripts\')">';
						cerrar_barra_estado();
						cerrar_ventana();
					?>
				<!-- FIN DE MARCOS POPUP -->
				</div>

			<div align=center>
						
			<br><?php echo $MULTILANG_FrmDetalles; ?>:
				<table class="TextosVentana">
					<tr>
						<td align="right"><?php echo $MULTILANG_FrmTitVen; ?>:</td>
						<td>
							<input type="text" value="<?php echo $registro_form["titulo"]; ?>" name="titulo" size="20" class="CampoTexto">
							<a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>" name=""><img src="img/icn_12.gif" border=0></a>
							<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesTit; ?>"><img src="img/icn_10.gif" border=0></a>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $MULTILANG_FrmHlp; ?></td>
						<td>
							<input type="text" value="<?php echo $registro_form["ayuda_titulo"]; ?>" name="ayuda_titulo" size="20" class="CampoTexto">
							<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesHlp; ?>"><img src="img/icn_10.gif" border=0></a>
						</td>
					</tr>
					<tr>
						<td valign="top" align="right"><?php echo $MULTILANG_FrmTxt; ?></td>
						<td valign="top">
							<textarea name="ayuda_texto" cols="25" rows="3" class="AreaTexto" onkeypress="return FiltrarTeclas(this, event)"><?php echo $registro_form["ayuda_texto"]; ?></textarea>
							<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesTxt; ?>"><img align="top" src="img/icn_10.gif" border=0></a>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $MULTILANG_FrmImagen; ?></td>
						<td>
							<input type="color" name="color_fondo" size="10" value="<?php if ($registro_form["color_fondo"]!="") echo $registro_form["color_fondo"]; else echo '#f2f2f2'; ?>" class="CampoTexto">
							<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmImagenDes; ?>"><img align="top" src="img/icn_10.gif" border=0></a>
						</td>
					</tr>
					<tr>
						<td align="right" valign=top><?php echo $MULTILANG_TablaDatos; ?>:</td>
						<td>
							<select  name="tabla_datos" class="Combos" >
								<option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
								 <?php
										//Asumimos que la tabla es manual
										$es_tabla_manual=1;
										//Recorre las tablas definidas
										$resultado=consultar_tablas();
										while ($registro = $resultado->fetch())
											{
												// Imprime solamente las tablas de aplicacion, es decir, las que no cumplen prefijo de internas de Practico
												if (strpos($registro[0],$TablasCore)===FALSE)  // Booleana requiere === o !==
													{
														$estado_seleccion_tabla="";
														if ($registro[0]==$registro_form["tabla_datos"])
															{
																$estado_seleccion_tabla="SELECTED";
																//Si se detecta el nombre dentro de la lista la tabla deja de ser manual
																$es_tabla_manual=0;
															}
														echo '<option value="'.$registro[0].'" '.$estado_seleccion_tabla.'>'.str_replace($TablasApp,'',$registro[0]).'</option>';
													}
											}		
								?>
							</select><a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>" name=""><img src="img/icn_12.gif" border=0></a>
							<br>&nbsp;&nbsp;&nbsp;&nbsp;<i><?php echo $MULTILANG_InfTablaManual; ?>:</i>
							<br>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="tabla_datos_manual" value="<?php if($es_tabla_manual==1) echo $registro_form["tabla_datos"]; ?>" size="20" class="CampoTexto">
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $MULTILANG_FrmNumeroCols; ?></td>
						<td>
							<select name="columnas" class="selector_01" >
								<?php
									for ($i=1;$i<=20;$i++)
										{
											$estado_seleccion_cols="";
											if ($i==$registro_form["columnas"])
												$estado_seleccion_cols="SELECTED";
											echo '<option value="'.$i.'" '.$estado_seleccion_cols.'>'.$i.'</option>';
										}
								?>
							</select><a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesNumeroCols; ?>"><img src="img/icn_10.gif" border=0></a>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $MULTILANG_FrmBordesVisibles; ?></td>
						<td>
							<select name="borde_visible" class="selector_01" >
								<option value="0" <?php if ($registro_form["borde_visible"]==0) echo "SELECTED"; ?> ><?php echo $MULTILANG_No; ?></option>
								<option value="1" <?php if ($registro_form["borde_visible"]==1) echo "SELECTED"; ?> ><?php echo $MULTILANG_Si; ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td align="right"></td>
						<td>
							<input type="Button"  class="Botones" value="<?php echo $MULTILANG_FrmAdvScriptForm; ?>" onClick="javascript:AbrirPopUp('FormularioScripts');">
						</td>
					</tr>
					<tr>
						<td>
							</form>
						</td>
						<td>
							<input type="Button"  class="BotonesCuidado" value="<?php echo $MULTILANG_Actualizar; ?>" onClick="document.datosact.submit()">
						</td>
					</tr>
				</table>

		<?php
			//Cierra actualizacion de formulario
			cerrar_ventana();
		?>

		<?php
		echo '</td><td valign=top align=center>';  // Inicia segunda columna del diseñador
			cargar_formulario($formulario);
		echo '</td></tr></table>'; // Cierra la tabla de dos columnas
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: eliminar_formulario
	Elimina un formulario definido para la aplicacion incluyendo todos los objetos definidos en su interior

	Variables de entrada:

		formulario - ID unico de identificacion del formulario a eliminar

	(start code)
		DELETE FROM ".$TablasCore."formulario WHERE id='$formulario'
		DELETE FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario'
		DELETE FROM ".$TablasCore."formulario_boton WHERE formulario=? ","$formulario
	(end)

	Salida:
		Registro eliminado

	Ver tambien:
		<administrar_formularios>
*/
	if ($accion=="eliminar_formulario")
		{
			ejecutar_sql_unaria("DELETE FROM ".$TablasCore."formulario WHERE id=? ","$formulario");
			ejecutar_sql_unaria("DELETE FROM ".$TablasCore."formulario_objeto WHERE formulario=? ","$formulario");
			ejecutar_sql_unaria("DELETE FROM ".$TablasCore."formulario_boton WHERE formulario=? ","$formulario");
			auditar("Elimina formulario $formulario");
			echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="accion" value="administrar_formularios"></form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: actualizar_formulario
	Actualiza los datos basicos de un formulario

	Salida:
		Registro de formulario actualizado

	Ver tambien:
		<administrar_formularios>
*/
	if ($accion=="actualizar_formulario")
		{
			$mensaje_error="";
			if ($titulo=="") $mensaje_error.=$MULTILANG_FrmErr1.'<br>';
			$tabla_datos.=$tabla_datos_manual;
			if ($tabla_datos=="") $mensaje_error.=$MULTILANG_FrmErr2.'<br>';

			if ($mensaje_error=="")
				{
					ejecutar_sql_unaria("UPDATE ".$TablasCore."formulario SET titulo=?,ayuda_titulo=?,ayuda_texto=?,color_fondo=?,tabla_datos=?,columnas=?,javascript=?,borde_visible=? WHERE id= ? ","$titulo$_SeparadorCampos_$ayuda_titulo$_SeparadorCampos_$ayuda_texto$_SeparadorCampos_$color_fondo$_SeparadorCampos_$tabla_datos$_SeparadorCampos_$columnas$_SeparadorCampos_$javascript$_SeparadorCampos_$borde_visible$_SeparadorCampos_$formulario");
					auditar("Actualiza formulario $formulario para $tabla_datos");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="nombre_tabla" value="'.$tabla_datos.'">
					<input type="Hidden" name="accion" value="editar_formulario">
					<input type="Hidden" name="formulario" value="'.$formulario.'"></form>
								<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="administrar_formularios">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_formulario
	Agrega un formulario vacio para la aplicacion

	(start code)
		INSERT INTO ".$TablasCore."formulario VALUES (0, '$titulo','$ayuda_titulo','$ayuda_texto','$color_fondo','$tabla_datos','$columnas')
	(end)

	Salida:
		Registro agregado y paso a las ventanas de edicion de formulario para agregar los elementos internos

	Ver tambien:
		<administrar_formularios>
*/
	if ($accion=="guardar_formulario")
		{
			$mensaje_error="";
			if ($titulo=="") $mensaje_error.=$MULTILANG_FrmErr1.'<br>';
			$tabla_datos.=$tabla_datos_manual;
			if ($tabla_datos=="") $mensaje_error.=$MULTILANG_FrmErr2.'<br>';
			//escapa cadenas antes de ser enviadas a consulta
			//$javascript=$ConexionPDO->quote($javascript);

			if ($mensaje_error=="")
				{
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."formulario (".$ListaCamposSinID_formulario.") VALUES (?,?,?,?,?,?,?,?)","$titulo$_SeparadorCampos_$ayuda_titulo$_SeparadorCampos_$ayuda_texto$_SeparadorCampos_$color_fondo$_SeparadorCampos_$tabla_datos$_SeparadorCampos_$columnas$_SeparadorCampos_$javascript$_SeparadorCampos_$borde_visible");
					$id=$ConexionPDO->lastInsertId();
					auditar("Crea formulario $id para $tabla_datos");
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
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: copiar_formulario
	Agrega un formulario vacio para la aplicacion

	(start code)
		INSERT INTO ".$TablasCore."formulario VALUES (0, '$titulo','$ayuda_titulo','$ayuda_texto','$color_fondo','$tabla_datos','$columnas')
	(end)

	Salida:
		Registro agregado y paso a las ventanas de edicion de formulario para agregar los elementos internos

	Ver tambien:
		<administrar_formularios>
*/
	if ($accion=="copiar_formulario")
		{
			$mensaje_error="";
			if ($formulario=="")
				$mensaje_error=$MULTILANG_ErrorTiempoEjecucion.".  No ID Form";

			if ($mensaje_error=="")
				{
					// Busca datos y Crea copia del formulario
					$consulta=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id=?","$formulario");
					$registro = $consulta->fetch();
					// Establece valores para cada campo a insertar en el nuevo form
					$nuevo_titulo='[COPIA] '.$registro["titulo"];
					$ayuda_titulo=$registro["ayuda_titulo"];
					$ayuda_texto=$registro["ayuda_texto"];
					$color_fondo=$registro["color_fondo"];
					$tabla_datos=$registro["tabla_datos"];
					$columnas=$registro["columnas"];
					$javascript=$registro["javascript"];
					$borde_visible=$registro["borde_visible"];
					// Inserta el nuevo objeto al form
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."formulario (".$ListaCamposSinID_formulario.") VALUES (?,?,?,?,?,?,?,?) ","$nuevo_titulo$_SeparadorCampos_$ayuda_titulo$_SeparadorCampos_$ayuda_texto$_SeparadorCampos_$color_fondo$_SeparadorCampos_$tabla_datos$_SeparadorCampos_$columnas$_SeparadorCampos_$javascript$_SeparadorCampos_$borde_visible");
					$id=$ConexionPDO->lastInsertId();
					// Busca los elementos que componen el formulario para hacerles la copia
					// Registros de formulario_objeto
					$consulta=ejecutar_sql("SELECT * FROM ".$TablasCore."formulario_objeto WHERE formulario=?","$formulario");
					while($registro = $consulta->fetch())
						{
							//Establece valores para cada campo a insertar
							$tipo=$registro["tipo"];
							$titulo=$registro["titulo"];
							$campo=$registro["campo"];
							$ayuda_titulo=$registro["ayuda_titulo"];
							$ayuda_texto=$registro["ayuda_texto"];
							$nuevo_formulario=$id;
							$peso=$registro["peso"];
							$columna=$registro["columna"];
							$obligatorio=$registro["obligatorio"];
							$visible=$registro["visible"];
							$valor_predeterminado=$registro["valor_predeterminado"];
							$validacion_datos=$registro["validacion_datos"];
							$etiqueta_busqueda=$registro["etiqueta_busqueda"];
							$ajax_busqueda=$registro["ajax_busqueda"];
							$valor_unico=$registro["valor_unico"];
							$solo_lectura=$registro["solo_lectura"];
							$teclado_virtual=$registro["teclado_virtual"];
							$ancho=$registro["ancho"];
							$alto=$registro["alto"];
							$barra_herramientas=$registro["barra_herramientas"];
							$fila_unica=$registro["fila_unica"];
							$lista_opciones=$registro["lista_opciones"];
							$origen_lista_opciones=$registro["origen_lista_opciones"];
							$origen_lista_valores=$registro["origen_lista_valores"];
							$valor_etiqueta=$registro["valor_etiqueta"];
							$url_iframe=$registro["url_iframe"];
							$objeto_en_ventana=$registro["objeto_en_ventana"];
							$informe_vinculado=$registro["informe_vinculado"];
							$maxima_longitud=$registro["maxima_longitud"];
							$valor_minimo=$registro["valor_minimo"];
							$valor_maximo=$registro["valor_maximo"];
							$valor_salto=$registro["valor_salto"];
							$formato_salida=$registro["formato_salida"];
							$plantilla_archivo=$registro["plantilla_archivo"];
							$peso_archivo=$registro["peso_archivo"];
							$tamano_pincel=$registro["tamano_pincel"];
							$color_trazo=$registro["color_trazo"];
							$formulario_vinculado=$registro["formulario_vinculado"];
							$formulario_campo_vinculo=$registro["formulario_campo_vinculo"];
							$formulario_campo_foraneo=$registro["formulario_campo_foraneo"];

							//Inserta el nuevo objeto al form
							ejecutar_sql_unaria("INSERT INTO ".$TablasCore."formulario_objeto (".$ListaCamposSinID_formulario_objeto.") VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ","$tipo$_SeparadorCampos_$titulo$_SeparadorCampos_$campo$_SeparadorCampos_$ayuda_titulo$_SeparadorCampos_$ayuda_texto$_SeparadorCampos_$nuevo_formulario$_SeparadorCampos_$peso$_SeparadorCampos_$columna$_SeparadorCampos_$obligatorio$_SeparadorCampos_$visible$_SeparadorCampos_$valor_predeterminado$_SeparadorCampos_$validacion_datos$_SeparadorCampos_$etiqueta_busqueda$_SeparadorCampos_$ajax_busqueda$_SeparadorCampos_$valor_unico$_SeparadorCampos_$solo_lectura$_SeparadorCampos_$teclado_virtual$_SeparadorCampos_$ancho$_SeparadorCampos_$alto$_SeparadorCampos_$barra_herramientas$_SeparadorCampos_$fila_unica$_SeparadorCampos_$lista_opciones$_SeparadorCampos_$origen_lista_opciones$_SeparadorCampos_$origen_lista_valores$_SeparadorCampos_$valor_etiqueta$_SeparadorCampos_$url_iframe$_SeparadorCampos_$objeto_en_ventana$_SeparadorCampos_$informe_vinculado$_SeparadorCampos_$maxima_longitud$_SeparadorCampos_$valor_minimo$_SeparadorCampos_$valor_maximo$_SeparadorCampos_$valor_salto$_SeparadorCampos_$formato_salida$_SeparadorCampos_$plantilla_archivo$_SeparadorCampos_$peso_archivo$_SeparadorCampos_$tamano_pincel$_SeparadorCampos_$color_trazo$_SeparadorCampos_$formulario_vinculado$_SeparadorCampos_$formulario_campo_vinculo$_SeparadorCampos_$formulario_campo_foraneo");
						}				
					// Registros de formulario_boton
					$consulta=ejecutar_sql("SELECT * FROM ".$TablasCore."formulario_boton WHERE formulario=? ","$formulario");
					while($registro = $consulta->fetch())
						{
							//Establece valores para cada campo a insertar
							$titulo=$registro["titulo"];
							$estilo=$registro["estilo"];
							$nuevo_formulario=$id;
							$tipo_accion=$registro["tipo_accion"];
							$accion_usuario=$registro["accion_usuario"];
							$visible=$registro["visible"];
							$peso=$registro["peso"];
							$retorno_titulo=$registro["retorno_titulo"];
							$retorno_texto=$registro["retorno_texto"];
							$confirmacion_texto=$registro["confirmacion_texto"];
							//Inserta el nuevo objeto al form
							ejecutar_sql_unaria("INSERT INTO ".$TablasCore."formulario_boton (".$ListaCamposSinID_formulario_boton.") VALUES (?,?,?,?,?,?,?,?,?,?) ","$titulo$_SeparadorCampos_$estilo$_SeparadorCampos_$nuevo_formulario$_SeparadorCampos_$tipo_accion$_SeparadorCampos_$accion_usuario$_SeparadorCampos_$visible$_SeparadorCampos_$peso$_SeparadorCampos_$retorno_titulo$_SeparadorCampos_$retorno_texto$_SeparadorCampos_$confirmacion_texto");
						}
					auditar("Crea copia de formulario $formulario");

					// Regresa a la administracion de formularios
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="administrar_formularios">
					</form>
					<script type="" language="JavaScript"> 
					alert("'.$MULTILANG_FrmMsjCopia.$nuevo_titulo.' ID: '.$id.'");
					document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="administrar_formularios">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: administrar_formularios
	Presenta ventanas con la posibilidad de agregar nuevo formulario a la aplicacion y el listado para administrar o editar los existentes

	(start code)
		SELECT * FROM ".$TablasCore."formulario ORDER BY titulo
	(end)
*/
if ($accion=="administrar_formularios")
	{
		echo "<a href='javascript:abrir_ventana_popup(\"http://www.youtube.com/embed/-50HOcXa9tY\",\"VideoTutorial\",\"toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, width=640, height=480\");'><img src='img/icono_screencast.png' alt='ScreenCast-VideoTutorial'></a>";

		 ?>

		<table class="TextosVentana"><tr><td valign=top>
			<?php abrir_ventana($MULTILANG_FrmAgregar,'f2f2f2',''); ?>
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="accion" value="guardar_formulario">
			<input type="Hidden" name="nombre_tabla" value="<?php echo $nombre_tabla; ?>">


				<!-- INICIO DE MARCOS POPUP -->
				<div id='FormularioScripts' class="FormularioPopUps">
					<?php
						abrir_ventana($MULTILANG_FrmTitComandos,'#BDB9B9','');
					?>
						<table width="100%" border="0" cellspacing="5" align="CENTER" class="TextosVentana">
							<tr>
								<td>
									<?php echo $MULTILANG_FrmHlpFunciones; ?>
								</td>
							</tr>
							<tr>
								<td align=center>
<textarea name="javascript" cols="100" rows="20"  style="font-size:12px; font-family: Monospace, Sans-serif, Tahoma; border: 1px dotted #000099;">
function FrmAutoRun()
	{
		//Aqui sus instrucciones
	}
</textarea>
								</td>
							</tr>
						</table>
					<?php
						abrir_barra_estado();
							echo '<input type="Button"  class="BotonesEstadoCuidado" value=" '.$MULTILANG_Finalizado.' " onClick="OcultarPopUp(\'FormularioScripts\')">';
						cerrar_barra_estado();
						cerrar_ventana();
					?>
				<!-- FIN DE MARCOS POPUP -->
				</div>



			<div align=center>
						
			<br><?php echo $MULTILANG_FrmDetalles; ?>:
				<table class="TextosVentana">
					<tr>
						<td align="right"><?php echo $MULTILANG_FrmTitVen; ?>:</td>
						<td>
							<input type="text" name="titulo" size="20" class="CampoTexto">
							<a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>" name=""><img src="img/icn_12.gif" border=0></a>
							<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesTit; ?>"><img src="img/icn_10.gif" border=0></a>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $MULTILANG_FrmHlp; ?></td>
						<td>
							<input type="text" name="ayuda_titulo" size="20" class="CampoTexto">
							<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesHlp; ?>"><img src="img/icn_10.gif" border=0></a>
						</td>
					</tr>
					<tr>
						<td valign="top" align="right"><?php echo $MULTILANG_FrmTxt; ?></td>
						<td valign="top">
							<textarea name="ayuda_texto" cols="25" rows="3" class="AreaTexto" onkeypress="return FiltrarTeclas(this, event)"></textarea>
							<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesTxt; ?>"><img align="top" src="img/icn_10.gif" border=0></a>
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
						<td align="right" valign=top><?php echo $MULTILANG_TablaDatos; ?>:</td>
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
							<br>&nbsp;&nbsp;&nbsp;&nbsp;<i><?php echo $MULTILANG_InfTablaManual; ?>:</i>
							<br>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="tabla_datos_manual" size="20" class="CampoTexto">
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $MULTILANG_FrmNumeroCols; ?></td>
						<td>
							<select name="columnas" class="selector_01" >
								<?php
									for ($i=1;$i<=20;$i++)
										echo '<option value="'.$i.'">'.$i.'</option>';
								?>
							</select><a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesNumeroCols; ?>"><img src="img/icn_10.gif" border=0></a>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $MULTILANG_FrmBordesVisibles; ?></td>
						<td>
							<select name="borde_visible" class="selector_01" >
								<option value="0"><?php echo $MULTILANG_No; ?></option>
								<option value="1"><?php echo $MULTILANG_Si; ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td align="right"></td>
						<td>
							<input type="Button"  class="Botones" value="<?php echo $MULTILANG_FrmAdvScriptForm; ?>" onClick="javascript:AbrirPopUp('FormularioScripts');">
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
		abrir_ventana($MULTILANG_FrmTitForms,'f2f2f2','');
		?>
				<table width="100%" border="0" cellspacing="5" align="CENTER"  class="TextosVentana">
					<tr>
						<td bgcolor="#d6d6d6"><b>Id</b></td>
						<td bgcolor="#D6D6D6"><b><?php echo $MULTILANG_Titulo; ?></b></td>
						<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_TablaDatos; ?></b></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
		 <?php

				$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario ORDER BY titulo");
				while($registro = $consulta_forms->fetch())
					{
						echo '<tr>
								<td><b>'.$registro["id"].'</b></td>
								<td>'.$registro["titulo"].'</td>
								<td>'.str_replace($TablasApp,'',$registro["tabla_datos"]).'</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST" name="dco'.$registro["id"].'" id="dco'.$registro["id"].'">
												<input type="hidden" name="accion" value="copiar_formulario">
												<input type="hidden" name="formulario" value="'.$registro["id"].'">
												<input type="hidden" name="nombre_tabla" value="'.$registro["tabla_datos"].'">
												<input type="button" value="'.$MULTILANG_FrmCopiar.'"  class="Botones" onClick="confirmar_evento(\''.$MULTILANG_FrmAdvCopiar.'\',dco'.$registro["id"].');">
										</form>
								</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST" name="df'.$registro["id"].'" id="df'.$registro["id"].'">
												<input type="hidden" name="accion" value="eliminar_formulario">
												<input type="hidden" name="formulario" value="'.$registro["id"].'">
												<input type="button" value="'.$MULTILANG_Eliminar.'"  class="BotonesCuidado" onClick="confirmar_evento(\''.$MULTILANG_FrmAdvDelForm.'\',df'.$registro["id"].');">
										</form>
								</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST">
												<input type="hidden" name="accion" value="editar_formulario">
												<input type="hidden" name="formulario" value="'.$registro["id"].'">
												<input type="hidden" name="nombre_tabla" value="'.$registro["tabla_datos"].'">
												<input type="Submit" value="'.$MULTILANG_FrmCamposAcciones.'"  class="Botones">
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
