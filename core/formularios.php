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
	Function: PCO_EliminarDatosFormulario
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
		<PCO_GuardarDatosFormulario>

*/
	if ($PCO_Accion=="PCO_EliminarDatosFormulario")
		{
			//Define valores de postacciones y campos de transporte de datos adicionales para redireccion de flujos de aplicacion cuando aplica 
			if (@$PCO_PostAccion=="") $PCO_PostAccion="PCO_VerMenu"; //Por defecto va al menu principal si no hay postaccion definida
			if (@$PCO_NombreCampoTransporte1=="") $PCO_NombreCampoTransporte1="PCO_NombreCampoTransporte1";
			if (@$PCO_ValorCampoTransporte1=="" )  $PCO_ValorCampoTransporte1="PCO_ValorCampoTransporte1";
			if (@$PCO_NombreCampoTransporte2=="") $PCO_NombreCampoTransporte2="PCO_NombreCampoTransporte2";
			if (@$PCO_ValorCampoTransporte2=="" )  $PCO_ValorCampoTransporte2="PCO_ValorCampoTransporte2";
			$mensaje_error="";
			// Busca datos del formulario
			$consulta_formulario=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id=?","$formulario");
			$registro_formulario = $consulta_formulario->fetch();
			$tabla=$registro_formulario["tabla_datos"];

			$consulta_campos_unicos=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND valor_unico=1","$formulario");
			while ($registro_campos_unicos = $consulta_campos_unicos->fetch())
				{
					$campo=$registro_campos_unicos["campo"];
					$valor=${$campo};

				    //Busca todos los campos tipo adjunto para eliminar el arachivo correspondiente
				    $consulta_campos_adjuntos=PCO_EjecutarSQL("SELECT campo FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND tipo='archivo_adjunto' ","$formulario");
                    while ($registro_campos_adjuntos=$consulta_campos_adjuntos->fetch())
                        {
                            //Busca nombre del archivo
                            $RutaArchivo=PCO_EjecutarSQL("SELECT ".$registro_campos_adjuntos["campo"]." FROM $tabla WHERE $campo=$valor ")->fetchColumn();
                            $RutaArchivo=explode("|",$RutaArchivo);
                            $RutaArchivo=$RutaArchivo[0];
                            if ($RutaArchivo!="")
                                {
                                    PCO_Auditar("Elimina archivo $RutaArchivo asociado a registro donde ".$campo." = ".$valor." en ".$tabla);
                                    unlink($RutaArchivo);
                                }
                        }

					// Elimina los datos
					PCO_EjecutarSQLUnaria("DELETE FROM ".$tabla." WHERE $campo = '$valor' ");

					//POSIBILIDAD DE REEMPLAZAR POR ESTE QUERY SI LA TABLA MANEJA CAMPO ID:  PCO_EjecutarSQLUnaria("DELETE FROM ".$tabla." WHERE id=$id_registro_datos ");
        			PCO_Auditar("Elimina registro donde ".$campo." = ".$valor." en ".$tabla);
				}
			echo '<form name="PCO_FormContinuarFlujo_EliminarDatos" action="'.$ArchivoCORE.'" method="POST">
				<input type="Hidden" name="PCO_Accion" value="'.$PCO_PostAccion.'">
				<input type="Hidden" name="'.$PCO_NombreCampoTransporte1.'" value="'.$PCO_ValorCampoTransporte1.'">
				<input type="Hidden" name="'.$PCO_NombreCampoTransporte2.'" value="'.$PCO_ValorCampoTransporte2.'">
				<input type="Hidden" name="nombre_tabla" value="'.$tabla.'">
				<input type="Hidden" name="formulario" value="'.$formulario.'">
				<input type="Hidden" name="popup_activo" value="FormularioCampos">
                <input type="Hidden" name="Presentar_FullScreen" value="'.@$Presentar_FullScreen.'">
                <input type="Hidden" name="Precarga_EstilosBS" value="'.@$Precarga_EstilosBS.'">
				<input type="Hidden" name="PCO_ErrorIcono" value="'.@$PCO_ErrorIcono.'">
				<input type="Hidden" name="PCO_ErrorEstilo" value="'.@$PCO_ErrorEstilo.'">
				<input type="Hidden" name="PCO_ErrorTitulo" value="'.@PCO_ReemplazarVariablesPHPEnCadena($PCO_ErrorTitulo).'">
				<input type="Hidden" name="PCO_ErrorDescripcion" value="'.@PCO_ReemplazarVariablesPHPEnCadena($PCO_ErrorDescripcion).'">';
            //Redirecciona al siguiente flujo de aplicacion a menos que la PostAccion indique paso directamente
            if ($PCO_PostAccionDirecta!="1")
			    echo '<script type="" language="JavaScript"> document.PCO_FormContinuarFlujo_EliminarDatos.submit();  </script>';
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_ActualizarDatosFormulario
	Actualiza un registro sobre la tabla de aplicacion cuando es llamada la accion de actualizar datos sobre un formulario.
	Tomando todos los datos del formulario construye un query valido en SQL para hacer la actualizacion de los datos que debieron recibirse por metodo POST desde el formulario

	Variables de entrada:

		formulario - ID unico de formulario sobre el cual se realiza la operacion de actualizacion
		lista de valores - obtenidos dinamicamente dependiendo de la definicion del formulario

	Salida:
		Registro agregado a la tabla de aplicacion

	Ver tambien:
		<PCO_EliminarDatosFormulario> | <PCO_GuardarDatosFormulario>
*/
	if ($PCO_Accion=="PCO_ActualizarDatosFormulario")
		{
			// POR CORREGIR:  Si el diseno cuenta con varios campos que ven hacia un mismo campo de base de datos el query PUEDE no ser valido

			//Define valores de postacciones y campos de transporte de datos adicionales para redireccion de flujos de aplicacion cuando aplica 
			if (@$PCO_PostAccion=="") $PCO_PostAccion="PCO_VerMenu"; //Por defecto va al menu principal si no hay postaccion definida
			if (@$PCO_NombreCampoTransporte1=="") $PCO_NombreCampoTransporte1="PCO_NombreCampoTransporte1";
			if (@$PCO_ValorCampoTransporte1=="" )  $PCO_ValorCampoTransporte1="PCO_ValorCampoTransporte1";
			if (@$PCO_NombreCampoTransporte2=="") $PCO_NombreCampoTransporte2="PCO_NombreCampoTransporte2";
			if (@$PCO_ValorCampoTransporte2=="" )  $PCO_ValorCampoTransporte2="PCO_ValorCampoTransporte2";

			$mensaje_error="";

			// Busca datos del formulario
			$consulta_formulario=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id=?","$formulario");
			$registro_formulario = $consulta_formulario->fetch();

/*
			// Busca los campos del form marcados como valor unico y verifica que no existan valores en la tabla
			$tabla=$registro_formulario["tabla_datos"];
			$consulta_campos_unicos=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND visible=1 AND valor_unico=1");
			while ($registro_campos_unicos = $consulta_campos_unicos->fetch())
				{
					$campo=$registro_campos_unicos["campo"];
					$valor=${$campo};
					// Busca si el campo cuenta con el valor en la tabla
					$consulta_existente=PCO_EjecutarSQL("SELECT id FROM ".$tabla." WHERE $campo='$valor'");
					$registro_existente = $consulta_existente->fetch();
					if ($registro_existente["id"]!="")
						$mensaje_error.=$MULTILANG_ErrFrmDuplicado.$campo.'<br>';
				}
*/

			// Busca los campos del form marcados como obligatorios a los que no se les ingreso valor
			$tabla=$registro_formulario["tabla_datos"];
			$consulta_campos_obligatorios=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1 AND obligatorio=1","$formulario");
			while ($registro_campos_obligatorios = $consulta_campos_obligatorios->fetch())
				{
					$campo=$registro_campos_obligatorios["campo"];
					$valor=${$campo};
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
                    //Define los tipos de control que no son tenidos en cuenta en procesos de actualizacion
                    //Agregar el campo a la lista solamente si es de datos y si es diferente al campo ID que es usado para la actualizacion (objetos de tipo etiqueta o iframes son pasados por alto)
                    $cadena_tipos_excluidos=" AND tipo<>'etiqueta' AND tipo<>'url_iframe' AND tipo<>'informe' AND tipo<>'campo_etiqueta' AND tipo<>'boton_comando' ";
					
                    $consulta_campos=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1 AND campo<>'id' $cadena_tipos_excluidos ","$formulario");
					while ($registro_campos = $consulta_campos->fetch())
						{
					        if ($registro_campos["tipo"]!="form_consulta")
					            {
                                    //Verifica que el campo se encuentre dentro de la tabla, para descartar campos manuales mal escritos o usados para javascripts y otros fines.
                                    if (PCO_ExisteCampoTabla($registro_campos["campo"],$registro_formulario["tabla_datos"]))
                                        {
											// Si el tipos de campo es archivo lo procesa como adjunto, sino lo pasa al insert
											if ($registro_campos["tipo"]=="archivo_adjunto" )
												{
        											$variable_de_archivo=$registro_campos["campo"];
        											$nombre_archivo = $_FILES[$variable_de_archivo]['name']; //Contiene el nombre original
												    if ($nombre_archivo!="")
												        {
        													// Procesa el archivo y lo almacena en el path de acuerdo a la plantilla definida
        													$tipo_archivo = $_FILES[$variable_de_archivo]['type']; //Contiene el tipo original, ej: application/octet-stream, application/x-php, image/jpeg
        													$tamano_archivo = $_FILES[$variable_de_archivo]['size']; //Tamano del archivo cargado
        													$nombre_archivo_temporal = $_FILES[$variable_de_archivo]['tmp_name']; //Nombre del archivo temporal en servidor
        													$peso_final_permitido=$registro_campos["peso_archivo"]*1024;
        													//Determina la extension del archivo
        													$extension_archivo=end(explode(".", $nombre_archivo));
        													if ($extension_archivo==$nombre_archivo) $extension_archivo="";
        													
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
        															    {
            																$path_final_archivo.=$registro_campos["plantilla_archivo"];
            															    $path_final_archivo=PCO_GenerarNombreAdjunto($nombre_archivo,$registro_campos["campo"],$extension_archivo,$path_final_archivo);
        															    }
        																
        															// Intenta la carga del archivo solo si realmente se recibio uno
        															if($nombre_archivo!="")
        																if (!move_uploaded_file($nombre_archivo_temporal, $path_final_archivo ))
        																	$errores_de_carga.=$nombre_archivo.'- '.$MULTILANG_FrmErrorCargaGeneral;
        																else
        																    {
        																        //Busca el archivo anterior asociado en el registro y lo elimina
        																        $RutaArchivoAnterior=PCO_EjecutarSQL("SELECT ".$registro_campos["campo"]." FROM ".$registro_formulario["tabla_datos"]." WHERE id=$id_registro_datos")->fetchColumn();
        																        $RutaArchivoAnterior=explode("|",$RutaArchivoAnterior);
        																        $RutaArchivoAnterior=$RutaArchivoAnterior[0];
        																        unlink($RutaArchivoAnterior);
        																        
                    															//Agrega el campo y su path a la lista de campos para el query
                    															$cadena_campos_interrogantes.=$registro_campos["campo"]."=?,";
                    															$cadena_nuevos_valores.=  $path_final_archivo."|".$tipo_archivo.$_SeparadorCampos_;
        																    }
        														}
												        }
												}
											else
												{
                                                    $cadena_campos_interrogantes.=$registro_campos["campo"]."=?,";
                                                    
                                                    //Si el campo es combo multiple formatea el valor de acuerdo al campo extra para datos sanitizados, sino toma valor normal
                									if ($registro_campos["tipo"]=="lista_seleccion" && strstr($registro_campos["personalizacion_tag"],"multiple")!=FALSE)
                									    $cadena_nuevos_valores.=${"PCO_ComboMultiple_".$registro_campos["campo"]}.$_SeparadorCampos_;
                									else
                                                        $cadena_nuevos_valores.=${$registro_campos["campo"]}.$_SeparadorCampos_;
												}
					                    }
					            }
					        else
					            {
                                    $IdSubformulario=$registro_campos["formulario_vinculado"];
                                    $consulta_campos_subformulario=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1 AND campo<>'id' $cadena_tipos_excluidos AND tipo<>'form_consulta' ","$IdSubformulario");
                					while ($registro_campos_subformulario = $consulta_campos_subformulario->fetch())
                						{
							                // #############################################################
							                // TODO:  Unificar en una sola funcion con lo de arriba PILAS!!!
							                // #############################################################
                                            //Verifica que el campo se encuentre dentro de la tabla, para descartar campos manuales mal escritos o usados para javascripts y otros fines.
                                            if (PCO_ExisteCampoTabla($registro_campos_subformulario["campo"],$registro_formulario["tabla_datos"]))
                                                {
                                                    $cadena_campos_interrogantes.=$registro_campos_subformulario["campo"]."=?,";
                                                    
                                                    //Si el campo es combo multiple formatea el valor de acuerdo al campo extra para datos sanitizados, sino toma valor normal
                									if ($registro_campos_subformulario["tipo"]=="lista_seleccion" && strstr($registro_campos_subformulario["personalizacion_tag"],"multiple")!=FALSE)
                									    $cadena_nuevos_valores.=${"PCO_ComboMultiple_".$registro_campos_subformulario["campo"]}.$_SeparadorCampos_;
                									else
                                                        $cadena_nuevos_valores.=${$registro_campos_subformulario["campo"]}.$_SeparadorCampos_;
                                                }
                						}
					            }

						}

					// Elimina comas al final de las listas
					$cadena_campos_interrogantes=substr($cadena_campos_interrogantes, 0, strlen($cadena_campos_interrogantes)-1);

					// Actualiza los datos
					PCO_EjecutarSQLUnaria("UPDATE ".$registro_formulario["tabla_datos"]." SET $cadena_campos_interrogantes WHERE id=? ",$cadena_nuevos_valores.$id_registro_datos);

					PCO_Auditar("Actualiza registro $id_registro_datos en ".$registro_formulario["tabla_datos"]);
					//echo '<script type="" language="JavaScript"> document.PCO_FormVerMenu.submit();  </script>';

					if ($errores_de_carga=="")
						echo '<form name="PCO_FormContinuarFlujo_ActualizarDatos" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="'.$PCO_PostAccion.'">
						<input type="Hidden" name="'.$PCO_NombreCampoTransporte1.'" value="'.$PCO_ValorCampoTransporte1.'">
						<input type="Hidden" name="'.$PCO_NombreCampoTransporte2.'" value="'.$PCO_ValorCampoTransporte2.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
                        <input type="Hidden" name="Presentar_FullScreen" value="'.@$Presentar_FullScreen.'">
                        <input type="Hidden" name="Precarga_EstilosBS" value="'.@$Precarga_EstilosBS.'">
						<input type="Hidden" name="PCO_ErrorIcono" value="'.@$PCO_ErrorIcono.'">
						<input type="Hidden" name="PCO_ErrorEstilo" value="'.@$PCO_ErrorEstilo.'">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.@PCO_ReemplazarVariablesPHPEnCadena($PCO_ErrorTitulo).'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.@PCO_ReemplazarVariablesPHPEnCadena($PCO_ErrorDescripcion).'">
						</form>';
					else
						echo '<form name="PCO_FormContinuarFlujo_ActualizarDatos" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="'.$PCO_PostAccion.'">
						<input type="Hidden" name="'.$PCO_NombreCampoTransporte1.'" value="'.$PCO_ValorCampoTransporte1.'">
						<input type="Hidden" name="'.$PCO_NombreCampoTransporte2.'" value="'.$PCO_ValorCampoTransporte2.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
                        <input type="Hidden" name="Presentar_FullScreen" value="'.@$Presentar_FullScreen.'">
                        <input type="Hidden" name="Precarga_EstilosBS" value="'.@$Precarga_EstilosBS.'">
						<input type="Hidden" name="PCO_ErrorIcono" value="'.@$PCO_ErrorIcono.'">
						<input type="Hidden" name="PCO_ErrorEstilo" value="'.@$PCO_ErrorEstilo.'">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrFrmDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$errores_de_carga.'">
						</form>';
				}
			else
				{
						echo '<form name="PCO_FormContinuarFlujo_ActualizarDatos" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="'.$PCO_PostAccion.'">
						<input type="Hidden" name="'.$PCO_NombreCampoTransporte1.'" value="'.$PCO_ValorCampoTransporte1.'">
						<input type="Hidden" name="'.$PCO_NombreCampoTransporte2.'" value="'.$PCO_ValorCampoTransporte2.'">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrFrmDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
                        <input type="Hidden" name="Presentar_FullScreen" value="'.@$Presentar_FullScreen.'">
                        <input type="Hidden" name="Precarga_EstilosBS" value="'.@$Precarga_EstilosBS.'">
						</form>';
				}
            //Redirecciona al siguiente flujo de aplicacion a menos que la PostAccion indique paso directamente
            if ($PCO_PostAccionDirecta!="1")
			    echo '<script type="" language="JavaScript"> document.PCO_FormContinuarFlujo_ActualizarDatos.submit();  </script>';
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_GuardarDatosFormulario
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
		<PCO_EliminarDatosFormulario>
*/
	if ($PCO_Accion=="PCO_GuardarDatosFormulario")
		{
			// POR CORREGIR:  Si el diseno cuenta con varios campos que ven hacia un mismo campo de base de datos el query no es valido
			//Define valores de postacciones y campos de transporte de datos adicionales para redireccion de flujos de aplicacion cuando aplica 
			if (@$PCO_PostAccion=="") $PCO_PostAccion="PCO_VerMenu"; //Por defecto va al menu principal si no hay postaccion definida
			if (@$PCO_NombreCampoTransporte1=="") $PCO_NombreCampoTransporte1="PCO_NombreCampoTransporte1";
			if (@$PCO_ValorCampoTransporte1=="" )  $PCO_ValorCampoTransporte1="PCO_ValorCampoTransporte1";
			if (@$PCO_NombreCampoTransporte2=="") $PCO_NombreCampoTransporte2="PCO_NombreCampoTransporte2";
			if (@$PCO_ValorCampoTransporte2=="" )  $PCO_ValorCampoTransporte2="PCO_ValorCampoTransporte2";

			$mensaje_error="";

			// Busca datos del formulario
			$consulta_formulario=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id=? ","$formulario");
			$registro_formulario = $consulta_formulario->fetch();

			// Busca los campos del form marcados como valor unico y verifica que no existan valores en la tabla
			$tabla=$registro_formulario["tabla_datos"];
			$consulta_campos_unicos=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1 AND valor_unico=1","$formulario");
			while ($registro_campos_unicos = $consulta_campos_unicos->fetch())
				{
					$campo=$registro_campos_unicos["campo"];
					$valor=${$campo};
					// Busca si el campo cuenta con el valor en la tabla
					$consulta_existente=PCO_EjecutarSQL("SELECT id FROM ".$tabla." WHERE $campo='$valor'");
					$registro_existente = $consulta_existente->fetch();
					if ($registro_existente["id"]!="")
						$mensaje_error.=$MULTILANG_ErrFrmDuplicado.$campo.'<br>';
				}

			// Busca los campos del form marcados como obligatorios a los que no se les ingreso valor
			$tabla=$registro_formulario["tabla_datos"];
			$consulta_campos_obligatorios=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1 AND obligatorio=1","$formulario");
			while ($registro_campos_obligatorios = $consulta_campos_obligatorios->fetch())
				{
					$campo=$registro_campos_obligatorios["campo"];
					$valor=${$campo};
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

					$consulta_campos=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1","$formulario");
					while ($registro_campos = $consulta_campos->fetch())
						{
							//Hace la operacion con el campo solamente si es de datos (objetos de tipo etiqueta o iframes son pasados por alto)
							if ($registro_campos["tipo"]!="url_iframe" && $registro_campos["tipo"]!="etiqueta" && $registro_campos["tipo"]!="informe" && $registro_campos["tipo"]!="form_consulta" && $registro_campos["tipo"]!="campo_etiqueta" && $registro_campos["tipo"]!="boton_comando")
								{
									//Verifica que el campo se encuentre dentro de la tabla, para descartar campos manuales mal escritos o usados para javascripts y otros fines.
									if (PCO_ExisteCampoTabla($registro_campos["campo"],$registro_formulario["tabla_datos"]))
										{
											// Si el tipos de campo es archivo lo procesa como adjunto, sino lo pasa al insert
											if ($registro_campos["tipo"]=="archivo_adjunto")
												{
													// Procesa el archivo y lo almacena en el path de acuerdo a la plantilla definida
													$variable_de_archivo=$registro_campos["campo"];
													$nombre_archivo = $_FILES[$variable_de_archivo]['name']; //Contiene el nombre original
													
													if ($nombre_archivo!="")
													    {
        													$tipo_archivo = $_FILES[$variable_de_archivo]['type']; //Contiene el tipo original, ej: application/octet-stream, application/x-php, image/jpeg
        													$tamano_archivo = $_FILES[$variable_de_archivo]['size']; //Tamano del archivo cargado
        													$nombre_archivo_temporal = $_FILES[$variable_de_archivo]['tmp_name']; //Nombre del archivo temporal en servidor
        													$peso_final_permitido=$registro_campos["peso_archivo"]*1024;
        													//Determina la extension del archivo
        													$extension_archivo=end(explode(".", $nombre_archivo));
        													if ($extension_archivo==$nombre_archivo) $extension_archivo="";
        													
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
        															    {
            																$path_final_archivo.=$registro_campos["plantilla_archivo"];
            															    $path_final_archivo=PCO_GenerarNombreAdjunto($nombre_archivo,$registro_campos["campo"],$extension_archivo,$path_final_archivo);
        															    }
        																
        															// Intenta la carga del archivo
    																if (!move_uploaded_file($nombre_archivo_temporal, $path_final_archivo ))
    																	$errores_de_carga.=$nombre_archivo.'- '.$MULTILANG_FrmErrorCargaGeneral;
    																else
    																    {
    																        //OPERACION DE ALMACENADO DE ARCHIVO EXITOSA, LUEGO GUARDA LAS RUTAS.
                															//Agrega el campo y su path a la lista de campos para el query
                															$lista_campos.=$registro_campos["campo"].",";
                															$lista_valores.="'".$path_final_archivo."|".$tipo_archivo."',";
                															//Cadenas de valores usados para hacer consultas Binded con PDO
                															$lista_valores_interrogantes.="?,";
                															$lista_valores_concatenados.=$path_final_archivo."|".$tipo_archivo.$_SeparadorCampos_;
    																    }
        														}
													    }
												}
											else
												{
													$nombre_de_campo_query=$registro_campos["campo"].",";
													//ANTES DE QUERY CON PARAMETROS $valor_de_campo_query="'".${$registro_campos["campo"]}."',";
													$valor_de_campo_query=${$registro_campos["campo"]};
													
													//Si el campo es combo multiple formatea el valor de acuerdo al campo extra para datos sanitizados
													if ($registro_campos["tipo"]=="lista_seleccion" && strstr($registro_campos["personalizacion_tag"],"multiple")!=FALSE)
													    $valor_de_campo_query=${"PCO_ComboMultiple_".$registro_campos["campo"]};

													//Compresion previa para campos especiales (MUY experimental por cuanto puede generar errores de query)
														if ($registro_campos["tipo"]=="objeto_canvasDEPRECATED" || $registro_campos["tipo"]=="objeto_camara")
															$valor_de_campo_query=gzencode($valor_de_campo_query,9);
													//Agrega el campo y su valor a la lista de campos para el query
													$lista_campos.=$nombre_de_campo_query;
													$lista_valores.=$valor_de_campo_query;
													$lista_valores_interrogantes.="?,";
													$lista_valores_concatenados.=$valor_de_campo_query.$_SeparadorCampos_;
												}
										}
								}
							else
							    {
							        if ($registro_campos["tipo"]=="form_consulta")
							            {
							                // #############################################################
							                // TODO:  Unificar en una sola funcion con lo de arriba PILAS!!!
							                // #############################################################
                                            $IdSubformulario=$registro_campos["formulario_vinculado"];
                        					$consulta_campos_subformulario=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario='{$IdSubformulario}' AND visible=1");
                        					while ($registro_campos_subformulario = $consulta_campos_subformulario->fetch())
                        						{
                        							//Hace la operacion con el campo solamente si es de datos (objetos de tipo etiqueta o iframes son pasados por alto)
                        							if ($registro_campos_subformulario["tipo"]!="url_iframe" && $registro_campos_subformulario["tipo"]!="etiqueta" && $registro_campos_subformulario["tipo"]!="informe" && $registro_campos_subformulario["tipo"]!="form_consulta" && $registro_campos_subformulario["tipo"]!="campo_etiqueta" && $registro_campos_subformulario["tipo"]!="boton_comando")
                        								{
                        									//Verifica que el campo se encuentre dentro de la tabla, para descartar campos manuales mal escritos o usados para javascripts y otros fines.
                        									if (PCO_ExisteCampoTabla($registro_campos_subformulario["campo"],$tabla))
                        										{
                        											// Si el tipos de campo es archivo lo procesa como adjunto, sino lo pasa al insert
                        											if ($registro_campos_subformulario["tipo"]=="archivo_adjunto")
                        												{
                        													// Procesa el archivo y lo almacena en el path de acuerdo a la plantilla definida
                        													$variable_de_archivo=$registro_campos_subformulario["campo"];
                        													$nombre_archivo = $_FILES[$variable_de_archivo]['name']; //Contiene el nombre original
                        													if ($nombre_archivo!="")
                            													{
                                													$tipo_archivo = $_FILES[$variable_de_archivo]['type']; //Contiene el tipo original, ej: application/octet-stream, application/x-php, image/jpeg
                                													$tamano_archivo = $_FILES[$variable_de_archivo]['size']; //Tamano del archivo cargado
                                													$nombre_archivo_temporal = $_FILES[$variable_de_archivo]['tmp_name']; //Nombre del archivo temporal en servidor
                                													$peso_final_permitido=$registro_campos_subformulario["peso_archivo"]*1024;
                                													//Determina la extension del archivo
                                													if ($extension_archivo==$nombre_archivo) $extension_archivo="";
                                													
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
                                															if ($registro_campos_subformulario["plantilla_archivo"]=="")
                                																$path_final_archivo.=$nombre_archivo;
                                															else
                                															    {
                                    																$path_final_archivo.=$registro_campos_subformulario["plantilla_archivo"];
                                    															    $path_final_archivo=PCO_GenerarNombreAdjunto($nombre_archivo,$registro_campos_subformulario["campo"],$extension_archivo,$path_final_archivo);
                                															    }

                            																if (!move_uploaded_file($nombre_archivo_temporal, $path_final_archivo ))
                            																	$errores_de_carga.=$nombre_archivo.'- '.$MULTILANG_FrmErrorCargaGeneral;
                            																else
                            																    {
                                        															//Agrega el campo y su path a la lista de campos para el query
                                        															$lista_campos.=$registro_campos_subformulario["campo"].",";
                                        															$lista_valores.="'".$path_final_archivo."|".$tipo_archivo."',";
                                        															//Cadenas de valores usados para hacer consultas Binded con PDO
                                        															$lista_valores_interrogantes.="?,";
                                        															$lista_valores_concatenados.=$path_final_archivo."|".$tipo_archivo.$_SeparadorCampos_;
                            																    }
                                														}
                            													}
                        												}
                        											else
                        												{
                        													$nombre_de_campo_query=$registro_campos_subformulario["campo"].",";
                        													//ANTES DE QUERY CON PARAMETROS $valor_de_campo_query="'".${$registro_campos_subformulario["campo"]}."',";
                        													$valor_de_campo_query=${$registro_campos_subformulario["campo"]};
                        													
                        													//Si el campo es combo multiple formatea el valor de acuerdo al campo extra para datos sanitizados
                        													if ($registro_campos_subformulario["tipo"]=="lista_seleccion" && strstr($registro_campos_subformulario["personalizacion_tag"],"multiple")!=FALSE)
                        													    $valor_de_campo_query=${"PCO_ComboMultiple_".$registro_campos_subformulario["campo"]};
                        
                        													//Compresion previa para campos especiales (MUY experimental por cuanto puede generar errores de query)
                        														if ($registro_campos_subformulario["tipo"]=="objeto_canvasDEPRECATED" || $registro_campos_subformulario["tipo"]=="objeto_camara")
                        															$valor_de_campo_query=gzencode($valor_de_campo_query,9);
                        													//Agrega el campo y su valor a la lista de campos para el query
                        													$lista_campos.=$nombre_de_campo_query;
                        													$lista_valores.=$valor_de_campo_query;
                        													$lista_valores_interrogantes.="?,";
                        													$lista_valores_concatenados.=$valor_de_campo_query.$_SeparadorCampos_;
                        												}
                        										}
                        								}
                        						} //Fin while que recorre campos subform
							            } //Fin si es objeto subformulario
							    }
						}
					// Elimina comas al final de las listas
					$lista_campos=substr($lista_campos, 0, strlen($lista_campos)-1);
					$lista_valores=substr($lista_valores, 0, strlen($lista_valores)-1);
					$lista_valores_interrogantes=substr($lista_valores_interrogantes, 0, strlen($lista_valores_interrogantes)-1);
					//Elimina separador de campo al final de valores concatenados
					$lista_valores_concatenados=substr($lista_valores_concatenados, 0, strlen($lista_valores_concatenados)-strlen($_SeparadorCampos_));					
					//$lista_valores_concatenados=substr($lista_valores_concatenados, 0, -strlen($_SeparadorCampos_));					

					//Inserta los datos del registro en BD
					PCO_EjecutarSQLUnaria("INSERT INTO ".$registro_formulario["tabla_datos"]." (".$lista_campos.") VALUES (".$lista_valores_interrogantes.")",$lista_valores_concatenados);
					$UltimoIDRegistroInsertado=PCO_ObtenerUltimoIDInsertado($ConexionPDO);
					PCO_Auditar("Inserta registro en ".$registro_formulario["tabla_datos"]);
					//Si no hay errores en carga de archivos redirecciona normal, sino redirecciona con los errores

                    //Valida si alguno de los valores de campo de transporte requiere el ultimo id de registro afectado
        			if (@$PCO_ValorCampoTransporte1=="_OBTENER_ULTIMO_ID_" )  $PCO_ValorCampoTransporte1=$UltimoIDRegistroInsertado;
        			if (@$PCO_ValorCampoTransporte2=="_OBTENER_ULTIMO_ID_" )  $PCO_ValorCampoTransporte2=$UltimoIDRegistroInsertado;

					if ($errores_de_carga=="")
						//echo '<script type="" language="JavaScript"> document.PCO_FormVerMenu.submit();  </script>';
						echo '<form name="PCO_FormContinuarFlujo_GuardarDatos" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="'.$PCO_PostAccion.'">
						<input type="Hidden" name="'.$PCO_NombreCampoTransporte1.'" value="'.$PCO_ValorCampoTransporte1.'">
						<input type="Hidden" name="'.$PCO_NombreCampoTransporte2.'" value="'.$PCO_ValorCampoTransporte2.'">
						<input type="Hidden" name="PCO_ErrorIcono" value="'.@$PCO_ErrorIcono.'">
						<input type="Hidden" name="PCO_ErrorEstilo" value="'.@$PCO_ErrorEstilo.'">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.@PCO_ReemplazarVariablesPHPEnCadena($PCO_ErrorTitulo).'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.@PCO_ReemplazarVariablesPHPEnCadena($PCO_ErrorDescripcion).'">
                        <input type="Hidden" name="Presentar_FullScreen" value="'.@$Presentar_FullScreen.'">
                        <input type="Hidden" name="Precarga_EstilosBS" value="'.@$Precarga_EstilosBS.'">
						</form>';
					else
						echo '<form name="PCO_FormContinuarFlujo_GuardarDatos" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="'.$PCO_PostAccion.'">
						<input type="Hidden" name="'.$PCO_NombreCampoTransporte1.'" value="'.$PCO_ValorCampoTransporte1.'">
						<input type="Hidden" name="'.$PCO_NombreCampoTransporte2.'" value="'.$PCO_ValorCampoTransporte2.'">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrFrmDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$errores_de_carga.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
                        <input type="Hidden" name="Presentar_FullScreen" value="'.@$Presentar_FullScreen.'">
                        <input type="Hidden" name="Precarga_EstilosBS" value="'.@$Precarga_EstilosBS.'">
						</form>';
				}
			else
				{
					echo '<form name="PCO_FormContinuarFlujo_GuardarDatos" action="'.$ArchivoCORE.'" method="POST">
						<!-- <input type="Hidden" name="PCO_Accion" value="PCO_EditarFormulario"> -->
						<input type="Hidden" name="PCO_Accion" value="'.$PCO_PostAccion.'">
						<input type="Hidden" name="'.$PCO_NombreCampoTransporte1.'" value="'.$PCO_ValorCampoTransporte1.'">
						<input type="Hidden" name="'.$PCO_NombreCampoTransporte2.'" value="'.$PCO_ValorCampoTransporte2.'">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrFrmDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
                        <input type="Hidden" name="Presentar_FullScreen" value="'.@$Presentar_FullScreen.'">
                        <input type="Hidden" name="Precarga_EstilosBS" value="'.@$Precarga_EstilosBS.'">
						</form>';
				}
            //Redirecciona al siguiente flujo de aplicacion a menos que la PostAccion indique paso directamente
            if ($PCO_PostAccionDirecta!="1")
			    echo '<script type="" language="JavaScript"> document.PCO_FormContinuarFlujo_GuardarDatos.submit();  </script>';
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_EliminarAccionFormulario
	Elimina un boton creado para un formulario

	Variables de entrada:

		boton - ID unico del boton sobre el cual se realiza la operacion de eliminacion

	(start code)
		DELETE FROM ".$TablasCore."formulario_boton WHERE id='$boton'
	(end)

	Salida:
		Registro de boton eliminado y formulario actualizado en pantalla

	Ver tambien:
		<PCO_EliminarCampoFormulario>
*/
	if ($PCO_Accion=="PCO_EliminarAccionFormulario")
		{
			PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."formulario_boton WHERE id=? ","$boton");
			PCO_Auditar("Elimina accion del formulario $formulario");
			echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
			<input type="Hidden" name="PCO_Accion" value="PCO_EditarFormulario">
			<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
			<input type="Hidden" name="formulario" value="'.$formulario.'">
			<input type="Hidden" name="popup_activo" value="'.$popup_activo.'">
			</form>
			<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_EliminarCampoFormulario
	Elimina un campo de datos, etiqueta, marco externo o informe creado para un formulario

	Variables de entrada:

		campo - ID unico del elemento sobre el cual se realiza la operacion de eliminacion

	(start code)
		DELETE FROM ".$TablasCore."formulario_objeto WHERE id='$campo' 
	(end)

	Salida:
		Registro de campo eliminado y formulario actualizado en pantalla

	Ver tambien:
		<PCO_EliminarAccionFormulario>
*/
	if ($PCO_Accion=="PCO_EliminarCampoFormulario")
		{
		    //Elimina los eventos relacionados
			PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."evento_objeto WHERE objeto=? ","$campo");
            //Elimina el control como tal
			PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."formulario_objeto WHERE id=? ","$campo");
			PCO_Auditar("Elimina campo del formulario $formulario");
			echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
			<input type="Hidden" name="PCO_Accion" value="PCO_EditarFormulario">
			<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
			<input type="Hidden" name="formulario" value="'.$formulario.'">
			<input type="Hidden" name="popup_activo" value="'.$popup_activo.'">
			</form>
			<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_ActualizarCampoFormulario
	Actualiza un campo de datos, etiqueta, marco externo o informe en un formulario

	Variables de entrada:

		multiples - Recibidas mediante formulario unico asociado al proceso de creacion/edicion del elemento.

	(start code)
		UPDATE ".$TablasCore."formulario_objeto SET ... Lista da campos
	(end)

	Salida:
		Registro de campo alterado y formulario actualizado en pantalla

	Ver tambien:
		<PCO_EliminarCampoFormulario> | <agregar_campo_formulario>
*/
	if ($PCO_Accion=="PCO_ActualizarCampoFormulario")
		{
			$mensaje_error="";

			//Concatena el campo manual en caso de encontrar alguno
			$campo=$campo.$campo_manual;
			$origen_lista_opciones=$origen_lista_opciones_manual;
			$origen_lista_valores=$origen_lista_valores_manual;

			if (@$valor_unico=="on") $valor_unico=1; else $valor_unico=0;
			if (@$ajax_busqueda=="on") $ajax_busqueda=1; else $ajax_busqueda=0;
			if (@$ajax_busqueda_dinamica=="on") $ajax_busqueda_dinamica=1; else $ajax_busqueda_dinamica=0;
			$tipo_objeto=$tipo;
			if ($titulo=="" && ($tipo_objeto!="etiqueta" && $tipo_objeto!="url_iframe" && $tipo_objeto!="informe" && $tipo_objeto!="frm" && $tipo_objeto!="form_consulta") ) $mensaje_error=$MULTILANG_ErrFrmCampo1;
			if ($campo==""  && ($tipo_objeto!="etiqueta" && $tipo_objeto!="url_iframe" && $tipo_objeto!="informe" && $tipo_objeto!="frm" && $tipo_objeto!="form_consulta" && $tipo_objeto!="boton_comando") ) $mensaje_error=$MULTILANG_ErrFrmCampo2;
			if ($mensaje_error=="")
				{
					//Genera la lista de campos a ser actualizados desde la definicion de tabla para no olvidar ninguno
					$ListaCampos=explode(",",$ListaCamposSinID_formulario_objeto);
					for ($i=0; $i<count($ListaCampos);$i++)
                        {
                            $nuevo_valor_asignar=${$ListaCampos[$i]};
                            //Escapa algunos campos especiales
                            if ($ListaCampos[$i]=="accion_usuario")
                                {
                                    $nuevo_valor_asignar=addslashes($nuevo_valor_asignar);
                                }
                            @$ListaCamposyValores.=$ListaCampos[$i]."='".$nuevo_valor_asignar."',";
                        }
					$ListaCamposyValores.="id=id"; //Agregado para evitar coma final

					PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."formulario_objeto SET ".$ListaCamposyValores." WHERE id='$idcampomodificado'");
					
					PCO_Auditar("Modifica diseno campo $idcampomodificado para formulario $formulario");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					    <input type="Hidden" name="PCO_Accion" value="PCO_EditarFormulario">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="popup_activo" value="">
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_EditarFormulario">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrFrmDatos.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="popup_activo" value="">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_GuardarCampoFormulario
	Agrega un campo de datos, etiqueta, marco externo o informe a un formulario

	Variables de entrada:

		multiples - Recibidas mediante formulario unico asociado al proceso de creacion del elemento.

	(start code)
		INSERT INTO ".$TablasCore."formulario_objeto VALUES (0,'$tipo_objeto','$titulo','$campo','$ayuda_titulo','$ayuda_texto','$formulario','$peso','$columna','$obligatorio','$visible','$valor_predeterminado','$validacion_datos','$etiqueta_busqueda','$ajax_busqueda','$valor_unico','$solo_lectura','$teclado_virtual','$ancho','$alto','$barra_herramientas','$fila_unica','$lista_opciones','$origen_lista_opciones','$origen_lista_valores','$valor_etiqueta','$url_iframe','$objeto_en_ventana','$informe_vinculado')
	(end)

	Salida:
		Registro agregado y formulario actualizado en pantalla

	Ver tambien:
		<PCO_EliminarCampoFormulario>
*/
	if ($PCO_Accion=="PCO_GuardarCampoFormulario")
		{
			$mensaje_error="";
			$tipo_objeto=$tipo;

			//Concatena el campo manual en caso de encontrar alguno
			$campo=$campo.$campo_manual;
			$origen_lista_opciones=$origen_lista_opciones_manual;
			$origen_lista_valores=$origen_lista_valores_manual;

			if (@$valor_unico=="on") $valor_unico=1; else $valor_unico=0;
			if (@$ajax_busqueda=="on") $ajax_busqueda=1; else $ajax_busqueda=0;
			if (@$ajax_busqueda_dinamica=="on") $ajax_busqueda_dinamica=1; else $ajax_busqueda_dinamica=0;
			if (@$titulo=="" && ($tipo_objeto!="etiqueta" && $tipo_objeto!="url_iframe" && $tipo_objeto!="informe" && $tipo_objeto!="frm" && $tipo_objeto!="form_consulta") ) $mensaje_error=$MULTILANG_ErrFrmCampo1;
			if (@$campo==""  && ($tipo_objeto!="etiqueta" && $tipo_objeto!="url_iframe" && $tipo_objeto!="informe" && $tipo_objeto!="frm" && $tipo_objeto!="form_consulta" && $tipo_objeto!="boton_comando" ) ) $mensaje_error=$MULTILANG_ErrFrmCampo2;

			if ($mensaje_error=="")
				{
					//Genera la lista de campos a ser insertados desde la definicion de tabla para no olvidar ninguno
					$ListaCampos=explode(",",$ListaCamposSinID_formulario_objeto);
					$ListaInterrogantes="";
					for ($i=0; $i<count($ListaCampos);$i++)
						{
							$ListaInterrogantes.="?,";
							$NombreVariableGarbage=$ListaCampos[$i];
							@$ListaCamposyValores.=${$NombreVariableGarbage}.$_SeparadorCampos_;
						}
					//Elimina partes finales innecesarias (coma y separador de campos)
					$ListaInterrogantes = substr ($ListaInterrogantes, 0, - 1);
					$ListaCamposyValores = substr ($ListaCamposyValores, 0, strlen($_SeparadorCampos_)*(-1));
					// Define la consulta de insercion del nuevo campo
					$consulta_insercion="INSERT INTO ".$TablasCore."formulario_objeto (".$ListaCamposSinID_formulario_objeto.") VALUES (".$ListaInterrogantes.")";
					PCO_EjecutarSQLUnaria($consulta_insercion,"$ListaCamposyValores");
					$id=PCO_ObtenerUltimoIDInsertado($ConexionPDO);
					PCO_Auditar("Crea campo $id para formulario $formulario");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					    <input type="Hidden" name="PCO_Accion" value="PCO_EditarFormulario">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="popup_activo" value="">
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_EditarFormulario">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrFrmDatos.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="popup_activo" value="">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_GuardarAccionFormulario
	Agrega un boton con una accion determinada para un formulario

	Variables de entrada:

		multiples - Recibidas mediante formulario unico asociado al proceso de creacion del elemento.

	(start code)
		INSERT INTO ".$TablasCore."formulario_boton VALUES (0, '$titulo','$estilo','$formulario','$tipo_accion','$accion_usuario','$visible','$peso','$retorno_titulo','$retorno_texto','$confirmacion_texto')
	(end)

	Salida:
		Registro agregado y formulario actualizado en pantalla

	Ver tambien:
		<PCO_EliminarAccionFormulario>
*/
	if ($PCO_Accion=="PCO_GuardarAccionFormulario")
		{
			$mensaje_error="";
			if ($titulo=="") $mensaje_error=$MULTILANG_ErrFrmCampo3;
			if ($tipo_accion=="") $mensaje_error=$MULTILANG_ErrFrmCampo4;
			if ($mensaje_error=="")
				{
					//$accion_usuario=addslashes($accion_usuario); //DEPRECATED Version 15.1-
					PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."formulario_boton (".$ListaCamposSinID_formulario_boton.") VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)","$titulo$_SeparadorCampos_$estilo$_SeparadorCampos_$formulario$_SeparadorCampos_$tipo_accion$_SeparadorCampos_$accion_usuario$_SeparadorCampos_$visible$_SeparadorCampos_$peso$_SeparadorCampos_$retorno_titulo$_SeparadorCampos_$retorno_texto$_SeparadorCampos_$confirmacion_texto$_SeparadorCampos_$retorno_icono$_SeparadorCampos_$retorno_estilo$_SeparadorCampos_$id_html");
					$id=PCO_ObtenerUltimoIDInsertado($ConexionPDO);
					PCO_Auditar("Crea boton $id para formulario $formulario");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="PCO_Accion" value="PCO_EditarFormulario">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="popup_activo" value="FormularioBotones">
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_EditarFormulario">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrFrmDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="popup_activo" value="">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_EditarEventoObjeto
	Edita el evento asociado a un objeto determinado en una ventana independiente que se lanza como popup
*/
	if ($PCO_Accion=="PCO_EditarEventoObjeto")
		{
			//Busca si ya existe un evento del mismo tipo para ese objeto
			$registro_evento_previo=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."evento_objeto WHERE objeto=? AND evento=? ","$id_objeto_evento$_SeparadorCampos_$evento_objeto")->fetch();
            $IdEventoPrevio=$registro_evento_previo["id"];
            $JavaScriptEventoPrevio=$registro_evento_previo["javascript"];
            
            //Busca el ID_HTML del objeto
			$registro_objeto=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."formulario_objeto WHERE id=? ","$id_objeto_evento")->fetch();
            
            $NaturalDocs_PlantillaFuncion="\n/*\nFunction: SUNOMBRE_$evento_objeto\n\tIngrese aqui la descripcion de su funcion, procedimiento o proceso realizado por este evento\n\n\tParametros:\n\n\t\tParametro1 - Descripcion del primer parametro de entrada\n\t\tParametro2 - Descripcion del segundo parametro de entrada\n\n\tProceso simplificado:\n\t\t(start code)\n\t\t\tInstrucciones especificas importantes, Scripts u operaciones de BD, Etc\n\t\t(end)\n\n\tSalida:\n\n\t\tDescriba la salida de esta funcion, procedimiento o proceso\n\n\tVea tambien:\n\n\t\t<FuncionRelacionada1> | <FuncionRelacionada2> | <FuncionRelacionada3>\n*/\n\n";
            //Agrega una plantilla base cuando se esta creando el evento
            if($JavaScriptEventoPrevio=="") $JavaScriptEventoPrevio=$NaturalDocs_PlantillaFuncion;
        ?>
            <iframe name="iframe_almacenamiento" src="about:blank" style="visibility: hidden; display: none;"></iframe>
            <form name="form_evento" target="iframe_almacenamiento" action="<?php echo $ArchivoCORE; ?>" style="padding: 0px; margin: 0px;" class="well btn-xs">
                <input type="Hidden" name="PCO_Accion" value="PCO_ActualizarJavaEvento">
                <?php echo $MULTILANG_Evento?>: <input type="text" name="evento_objeto" value="<?php echo $evento_objeto; ?>" readonly style="width:200px; background-color: transparent; border: 0px solid; font-weight: bold;  color: #0000FF;">
                ID_HTML: <input type="text" name="id_html_visual" value="<?php echo $registro_objeto["id_html"]; ?>" readonly style="width:200px; background-color: transparent; border: 0px solid; font-weight: bold; color: #0000FF;">
                <br><?php echo $MULTILANG_Tipo?> <?php echo $MULTILANG_Objeto?>: <input type="text" name="tipo" value="<?php echo $tipo; ?>" readonly style="width:175px; background-color: transparent; border: 0px solid; font-weight: bold; color: #0000FF;">
                <?php echo $MULTILANG_Objeto?> ID: <input type="text" name="id_objeto_evento" value="<?php echo $id_objeto_evento; ?>" readonly style="width:200px; background-color: transparent; border: 0px solid; font-weight: bold; color: #0000FF;">
                <input type="Hidden" name="Presentar_FullScreen" value="1">
                <input type="Hidden" name="Precarga_EstilosBS" value="0">
                <div class="well" style="margin: 0px; padding: 0px;">
                <textarea id="javascript_eventos" name="javascript_eventos" data-editor="javascript" class="form-control" style="width: 783px; height: 480px;"><?php echo $JavaScriptEventoPrevio; ?></textarea>
                </div>
            </form>
            <form name="form_evento_eliminar" action="<?php echo $ArchivoCORE; ?>" style="padding: 0px; margin: 0px;">
                <input type="Hidden" name="PCO_Accion" value="PCO_EliminarEventoObjeto">
                <input type="Hidden" name="evento" value="<?php echo $IdEventoPrevio; ?>">
                <input type="Hidden" name="Presentar_FullScreen" value="1">
                <input type="Hidden" name="Precarga_EstilosBS" value="0">
            </form>
            <?php 
                echo '<br>
                <div class="row">
                    <div class="col col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <button type="button" class="btn btn-success" onclick="PCOJS_MostrarMensajeCargandoSimple(1000); document.form_evento.submit();"><i class="fa fa-save"></i> '.$MULTILANG_Guardar.' </button>
                        &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default" onclick="window.close();"><i class="fa fa-times"></i> '.$MULTILANG_Cerrar.'</button>
                    </div>
                    <div class="col col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <button type="button" class="btn btn-danger" onclick="form_evento_eliminar.submit();"><i class="fa fa-trash"></i> '.$MULTILANG_Eliminar.' '.$MULTILANG_Evento.'</button>
                    </div>
                    <div class="col col-xs-4 col-sm-4 col-md-4 col-lg-4" align=right>
                        <!--<button type="button" class="btn btn-info" data-toggle="tooltip" data-html="true"  data-placement="auto" title="'.$MULTILANG_DocumentarDes.'" onclick="$(\'#javascript_eventos\').val(\''.$NaturalDocs_PlantillaFuncion.'\');"><i class="fa fa-file-code-o"></i> '.$MULTILANG_Documentar.'</button>-->
                        <a class="btn btn-primary" data-toggle="tooltip" data-html="true"  data-placement="auto" title="'.$MULTILANG_DocumentarLink.'" href="http://www.naturaldocs.org/reference/formatting/" target="_blank"><i class="fa fa-book"></i>&nbsp;</a>
                    </div>
                </div>';
		}


/* ################################################################## */
/* ################################################################## */
/*
	Section: Acciones a ser ejecutadas (si aplica) en cada cargue de la herramienta
*/

/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_DesplazarObjetosForm
	Cambia el peso de todos los elementos de un formulario sumando uno +1 para dejar un espacio donde se pueda insertar un nuevo elemento

	Variables de entrada:

		idObjetoForm - Valor Identificador unico del objeto
		nombre_tabla - Nombre de la tabla del formulario al que se retorna

	Salida:

		Valor de paso actualizado para todos los elementos del formulario por debajo del indicado
*/
if (@$PCO_Accion=="PCO_DesplazarObjetosForm")
	{		
		$mensaje_error="";
		if ($idObjetoForm=="") $mensaje_error="ID de elemento base no especificado / Base element ID nos specified";
		if ($mensaje_error=="")
			{
			    $RegistroObjetoBase=PCO_EjecutarSQL("SELECT id,$ListaCamposSinID_formulario_objeto FROM {$TablasCore}formulario_objeto WHERE id='{$idObjetoForm}' ")->fetch();
			    $peso=$RegistroObjetoBase["peso"];
			    $columna=$RegistroObjetoBase["columna"];
			    $pestana=$RegistroObjetoBase["pestana_objeto"];
			    $formulario=$RegistroObjetoBase["formulario"];
				PCO_EjecutarSQLUnaria("UPDATE {$TablasCore}formulario_objeto  SET peso=peso+1  WHERE formulario='{$formulario}' AND columna='{$columna}' AND pestana_objeto='{$pestana}' AND peso>={$peso} ");
				@PCO_Auditar("Desplaza elementos de formulario ");
				
				if (@$PCO_CambioEstado_NegarRetorno=="")
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
							<input type="Hidden" name="PCO_Accion" value="'.$accion_retorno.'">
							<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
							<input type="Hidden" name="formulario" value="'.@$formulario.'">
							<input type="Hidden" name="informe" value="'.@$informe.'">
							<input type="Hidden" name="popup_activo" value="'.$popup_activo.'">
						</form>
						<script type="" language="JavaScript">
						    document.cancelar.submit();
						</script>';
			}
		else
			echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="PCO_VerMenu">
					<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
					<input type="Hidden" name="formulario" value="'.$formulario.'">
					<input type="Hidden" name="informe" value="'.$informe.'">
					<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
					<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
				</form>
				<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_EditarFormulario
	Despliega las ventanas requeridas para agregar los diferentes elementos al formulario como campos, etiquetas, marcos y acciones

	Variables de entrada:

		formulario - ID unico de identificacion del formulario sobre el cual se hace la edicion

	(start code)
		SELECT * FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' ORDER BY columna,peso,titulo
	(end)

	Salida:
		Ventanas con herramientas de edicion y vista previa del formulario en pantalla
*/
/* ################################################################## */
if ($PCO_Accion=="PCO_EditarFormulario")
	{
	    if ($formulario=="") $formulario=$PCO_Valor; //Reasignacion de valor para modelo dinamico de practico
	    //Si no recibe un nombre de tabla intenta averiguarlo desde el formulario
	    if ($nombre_tabla=="")
	        {
	            $RegistroFormulario=PCO_EjecutarSQL("SELECT tabla_datos FROM ".$TablasCore."formulario WHERE id=? ","$formulario")->fetch();
                $nombre_tabla=$RegistroFormulario["tabla_datos"];
                //$nombre_tabla=PCO_ReemplazarVariablesPHPEnCadena($nombre_tabla);
	        }
	    
        //Prepara el selector de iconos para las opciones
        PCO_SelectorIconosAwesome();

		  ?>

		<script TYPE="text/javascript" LANGUAGE="JavaScript">
			function OcultarCampos(cantidad_campos_existentes)
				{
					for (i=1;i<=cantidad_campos_existentes;i++)
						{
							//Hace la operacion para elementos no eliminados previamente.  Algunos eliminados:
                            //13 - Teclado virtual
                            if (i!=13)
                                {
                                    var formdiv = document.getElementById("campo"+i);
                                    formdiv.style.display="none";
                                }
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
					OcultarCampos(48);
					// Muestra campos segun tipo de objeto
					if (tipo_objeto_activo=="texto_corto")   VisualizarCampos("1,2,3,4,5,6,7,8,9,10,11,14,17,25,36,37,44,45,46,47,48");
					if (tipo_objeto_activo=="texto_clave")   VisualizarCampos("1,2,6,7,8,9,10,17,25,36,37,44,45,46,47,48");
					if (tipo_objeto_activo=="texto_largo")   VisualizarCampos("1,2,5,6,7,8,9,10,14,15,17,36,37,44,45,46,47,48");
					if (tipo_objeto_activo=="texto_formato") VisualizarCampos("1,2,6,7,8,9,10,14,15,16,17,36,37,46,47,48");
					if (tipo_objeto_activo=="lista_seleccion") VisualizarCampos("1,2,6,7,8,9,10,12,15,17,18,19,20,35,36,37,45,46,47,48");
					if (tipo_objeto_activo=="lista_radio") VisualizarCampos("1,2,7,8,9,10,17,18,19,20,35,36,37,45,46,47,48");
					if (tipo_objeto_activo=="casilla_check") VisualizarCampos("1,2,4,9,17,36,37,42,45,46,47,48");
					if (tipo_objeto_activo=="etiqueta")   VisualizarCampos("9,17,21,36,46,47,48");
					if (tipo_objeto_activo=="url_iframe")   VisualizarCampos("9,14,15,17,22,24,36,37,46,47,48");
					if (tipo_objeto_activo=="informe")   VisualizarCampos("9,17,23,24,36,46,47,48");
					if (tipo_objeto_activo=="deslizador")   VisualizarCampos("1,2,4,7,8,9,17,26,36,37,45,46,47,48");
					if (tipo_objeto_activo=="campo_etiqueta")   VisualizarCampos("1,2,4,9,17,14,15,27,36,45,46,47,48");
					if (tipo_objeto_activo=="archivo_adjunto")   VisualizarCampos("1,2,7,8,9,10,17,28,29,36,37,45,46,47,48");
					if (tipo_objeto_activo=="objeto_canvas")   VisualizarCampos("1,2,7,8,9,10,14,15,17,24,30,31,36,45,46,47,48");
					if (tipo_objeto_activo=="objeto_camara")   VisualizarCampos("1,2,7,8,9,10,14,15,17,24,31,36,45,46,47,48");
                    if (tipo_objeto_activo=="form_consulta")   VisualizarCampos("9,17,24,32,33,34,36,46,47,48");
                    if (tipo_objeto_activo=="boton_comando")   VisualizarCampos("1,9,36,37,38,39,40,41,43,46,47,48");
					if (tipo_objeto_activo=="area_responsive") VisualizarCampos("1,2,6,9,15,16,17,36,46,47,48");
					//Vuelve a centrar el formulario de acuerdo al nuevo contenido
					AbrirPopUp("FormularioCampos");
				}
		</script>

        <script language="JavaScript">
            function PCOJS_PopUpEventosJavascript()
                {
                    //Verifica que se haya seleccionado un evento y abre el popup, sino muestra error
                    if ($("#tipo_evento").val()!="")
                        PCO_VentanaPopup('index.php?PCO_Accion=PCO_EditarEventoObjeto&id_objeto_evento='+document.datosform.idcampomodificado.value+'&evento_objeto='+$("#tipo_evento").val()+'&tipo='+document.datosform.tipo.value+'&Presentar_FullScreen=1&Precarga_EstilosBS=1','Evento_'+$("#tipo_evento").val()+'_ID'+document.datosform.idcampomodificado.value,'toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=no, resizable=no, fullscreen=no, width=850, height=600');
                    else
                        alert("<?php echo $MULTILANG_Seleccionar; ?> <?php echo $MULTILANG_Evento; ?> !!!");
                }
        </script>

    <!-- INICIO MODAL ADICION DE CAMPOS -->
    <?php PCO_AbrirDialogoModal("myModalElementoFormulario",$MULTILANG_FrmMsj1,"modal-wide oculto_impresion"); ?>

				<?php			
				//Si se trata de la edicion de un campo entonces busca su registro para agregar valores al form
				if (@$popup_activo=="FormularioCampos")
					{
						$consulta_campo_editar=@PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE id=? ","$campo");
						$registro_campo_editar = $consulta_campo_editar->fetch();
					}
				?>


            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#propiedades_basicas-tab" data-toggle="tab"><i class="fa fa-wrench" aria-hidden="true"></i> &nbsp;<?php echo $MULTILANG_FrmTipoTit1; ?>: <?php echo $MULTILANG_Configuracion; ?></a>
                </li>
                <li><a href="#eventos_objeto-tab" data-toggle="tab"><i class="fa fa-bolt" aria-hidden="true"></i> &nbsp;<?php echo $MULTILANG_EventosTit; ?></a>
                </li>
            </ul>


        <!-- INICIO de las pestanas -->
        <div class="tab-content">
            

    <!-- ############################################################## -->
    <!-- ##################  INICIO DE LAS PROPIEDADES ################ -->
    <!-- ############################################################## -->
            <div class="tab-pane  active" id="propiedades_basicas-tab">
                
                <br>
				<form name="datosform" id="datosform" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<?php 
					//Define tipo de accion si se trata de creacion o modificacion
					if (@$popup_activo=="FormularioCampos")
						echo '<input type="Hidden" name="PCO_Accion" value="PCO_ActualizarCampoFormulario">';
					else
						echo '<input type="Hidden" name="PCO_Accion" value="PCO_GuardarCampoFormulario">';
				?>
				<input type="Hidden" name="nombre_tabla" value="<?php echo $nombre_tabla; ?>">
				<input type="Hidden" name="formulario" value="<?php echo $formulario; ?>">
				<input type="Hidden" name="idcampomodificado" value="<?php echo $campo; ?>">


                        <label for="tipo"><?php echo $MULTILANG_FrmTipoObjeto; ?>:</label>
                        <div class="form-group input-group">
                            <select  id="tipo" name="tipo" class="selectpicker"  data-style="btn-info" OnChange="CambiarCamposVisibles(this.options[this.selectedIndex].value);">
                                <option value="0"><?php echo $MULTILANG_SeleccioneUno; ?></option>
                                <optgroup label="<?php echo $MULTILANG_FrmTipoTit1; ?>">
                                    <option value="texto_corto"     data-icon="glyphicon-log-in"					<?php if (@$registro_campo_editar["tipo"]=="texto_corto")     echo 'SELECTED'; ?>> <?php echo $MULTILANG_FrmTipo1; ?></option>
                                    <option value="texto_clave"     data-icon="glyphicon-eye-close"					<?php if (@$registro_campo_editar["tipo"]=="texto_clave")     echo 'SELECTED'; ?>> <?php echo $MULTILANG_FrmTipo10; ?></option>
                                    <option value="texto_largo"     data-icon="glyphicon-text-width"				<?php if (@$registro_campo_editar["tipo"]=="texto_largo")     echo 'SELECTED'; ?>> <?php echo $MULTILANG_FrmTipo2; ?></option>
                                    <option value="texto_formato"   data-icon="glyphicon-font"						<?php if (@$registro_campo_editar["tipo"]=="texto_formato")   echo 'SELECTED'; ?>> <?php echo $MULTILANG_FrmTipo3; ?></option>
                                    <option value="area_responsive" data-icon="glyphicon-edit"						<?php if (@$registro_campo_editar["tipo"]=="area_responsive") echo 'SELECTED'; ?>> <?php echo $MULTILANG_FrmTipo17; ?></option>
                                    <option value="lista_seleccion" data-icon="glyphicon glyphicon-indent-right"	<?php if (@$registro_campo_editar["tipo"]=="lista_seleccion") echo 'SELECTED'; ?>> <?php echo $MULTILANG_FrmTipo4; ?></option>
                                    <option value="lista_radio"     data-icon="glyphicon-record"					<?php if (@$registro_campo_editar["tipo"]=="lista_radio")     echo 'SELECTED'; ?>> <?php echo $MULTILANG_FrmTipo5; ?></option>
                                    <option value="casilla_check"   data-icon="glyphicon glyphicon-check"			<?php if (@$registro_campo_editar["tipo"]=="casilla_check")   echo 'SELECTED'; ?>> <?php echo $MULTILANG_FrmTipo18; ?></option>
                                    <option value="deslizador"      data-icon="glyphicon-resize-horizontal"			<?php if (@$registro_campo_editar["tipo"]=="deslizador")      echo 'SELECTED'; ?>> <?php echo $MULTILANG_FrmTipo9; ?></option>
                                    <option value="campo_etiqueta"  data-icon="glyphicon-tags"						<?php if (@$registro_campo_editar["tipo"]=="campo_etiqueta")  echo 'SELECTED'; ?>> <?php echo $MULTILANG_FrmTipo11; ?></option>
                                </optgroup>
                                <optgroup label="<?php echo $MULTILANG_FrmTipoTit4; ?>">
                                    <option value="archivo_adjunto" data-icon="glyphicon-file"              <?php if (@$registro_campo_editar["tipo"]=="archivo_adjunto") echo 'SELECTED'; ?>> <?php echo $MULTILANG_FrmTipo12; ?></option>
                                    <option value="objeto_canvas"   data-icon="glyphicon-picture"           <?php if (@$registro_campo_editar["tipo"]=="objeto_canvas") echo 'SELECTED'; ?>> <?php echo $MULTILANG_FrmTipo13; ?></option>
                                    <option value="objeto_camara"   data-icon="glyphicon-facetime-video"    <?php if (@$registro_campo_editar["tipo"]=="objeto_camara") echo 'SELECTED'; ?>> <?php echo $MULTILANG_FrmTipo14; ?></option>
                                </optgroup>
                                <optgroup label="<?php echo $MULTILANG_FrmTipoTit2; ?>">
                                    <option value="etiqueta"        data-icon="glyphicon-pencil"            <?php if (@$registro_campo_editar["tipo"]=="etiqueta")        echo 'SELECTED'; ?>> <?php echo $MULTILANG_FrmTipo6; ?></option>
                                    <option value="url_iframe"      data-icon="glyphicon-globe"            <?php if (@$registro_campo_editar["tipo"]=="url_iframe")      echo 'SELECTED'; ?>> <?php echo $MULTILANG_FrmTipo7; ?></option>
                                </optgroup>
                                <optgroup label="<?php echo $MULTILANG_FrmTipoTit3; ?>">
                                    <option value="informe"         data-icon="glyphicon-list-alt" <?php if (@$registro_campo_editar["tipo"]=="informe")         echo 'SELECTED'; ?>> <?php echo $MULTILANG_FrmTipo8; ?></option>
                                    <option value="form_consulta"	  data-icon="glyphicon-search" <?php if (@$registro_campo_editar["tipo"]=="form_consulta")   echo 'SELECTED'; ?>> <?php echo $MULTILANG_FrmTipo15; ?></option>
                                    <option value="boton_comando"	  data-icon="glyphicon-flash" <?php if (@$registro_campo_editar["tipo"]=="boton_comando")   echo 'SELECTED'; ?>> <?php echo $MULTILANG_FrmTipo16; ?></option>
                                </optgroup>
                            </select>
                            <span class="input-group-addon">
                                <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                            </span>
                        </div>
						<hr>


		<div class="row">
			<div class="col col-md-6">


						<div id='campo1' style="display:none;">
                            <div class="form-group input-group">
                                <input type="text" name="titulo" class="form-control input-sm" value="<?php echo @$registro_campo_editar["titulo"]; ?>" placeholder="<?php echo $MULTILANG_FrmTitulo; ?>"  OnInput="ActualizarTexto_botoncomando_vista_previa(this.value);">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesTitulo; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>

						<div id='campo45' style="display:none;">
							<label for="ocultar_etiqueta"><?php echo $MULTILANG_FrmOcultarEtiqueta; ?>:</label>
							<div class="form-group input-group">
								<select id="ocultar_etiqueta" name="ocultar_etiqueta" class="form-control input-sm" >
									<option value="1" <?php if (@$registro_campo_editar["ocultar_etiqueta"]==1) echo 'SELECTED'; ?>><?php echo $MULTILANG_Si; ?></option>
									<option value="0" <?php if (@$registro_campo_editar["ocultar_etiqueta"]==0) echo 'SELECTED'; ?>><?php echo $MULTILANG_No; ?></option>
								</select>
							</div>
						</div>

						<div id='campo2' style="display:none;">
                            <label for="campo"><?php echo $MULTILANG_FrmCampo; ?>:</label>
                            <div class="form-group input-group">
                                <span class="input-group-addon">
                                    <?php echo $nombre_tabla; ?>.
                                </span>
                                    <select id="campo" name="campo" onchange="document.datosform.id_html.value=document.datosform.campo.value+document.datosform.campo_manual.value;" class="form-control input-sm" >
                                    <option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
                                    <?php
                                        $resultadocampos=PCO_ConsultarColumnas($nombre_tabla);
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
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmCampoOb1; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesCampo; ?>"><i class="fa fa-question-circle icon-info"></i></a>
                                </span>
                            </div>

                            <div class="form-group input-group">
                                <input name="campo_manual" onchange="document.datosform.id_html.value=document.datosform.campo.value+document.datosform.campo_manual.value;" value="<?php if (!@PCO_ExisteCampoTabla($registro_campo_editar["campo"],$nombre_tabla)) echo @$registro_campo_editar["campo"]; ?>" type="text" class="form-control input-sm" placeholder="<?php echo $MULTILANG_InfCampoManual; ?>">
                                <span class="input-group-addon">
                                </span>
                            </div>
						</div>

                        <div id='campo46' style="display:none;">
                            <div class="form-group input-group">
                                <input name="id_html"  value="<?php echo @$registro_campo_editar["id_html"]; ?>" type="text" class="form-control input-sm" placeholder="ID HTML">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmIdHTML; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>

						<div id='campo3' style="display:none;">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="valor_unico" name="valor_unico" <?php if (@$registro_campo_editar["valor_unico"]==1) echo 'checked'; ?> > <?php echo $MULTILANG_FrmValUnico; ?>
                                </label>
                                <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmTitUnico; ?>" name="<?php echo $MULTILANG_FrmDesUnico; ?>"><i class="fa fa-question-circle"></i></a>
                            </div>
						</div>

						<div id='campo4' style="display:none;">
                            <div class="form-group input-group">
                                <input type="text" name="valor_predeterminado" class="form-control input-sm" value="<?php echo @$registro_campo_editar["valor_predeterminado"]; ?>" placeholder="<?php echo $MULTILANG_FrmPredeterminado; ?>">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesPredeterminado; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>

						<div id='campo44' style="display:none;">
                            <div class="form-group input-group">
                                <input type="text" name="valor_placeholder" class="form-control input-sm" value="<?php echo @$registro_campo_editar["valor_placeholder"]; ?>" placeholder="<?php echo $MULTILANG_FrmTextoPlaceHolder; ?>">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesPlaceHolder; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>

						<div id='campo5' style="display:none;">
						    
						    
                    		<div class="row">
                    			<div class="col col-md-6">
                                    <label for="validacion_datos"><?php echo $MULTILANG_FrmValida; ?>:</label>
                                    <div class="form-group input-group">
                                        <select  name="validacion_datos" class="form-control input-sm" >
                                            <option value=""><?php $MULTILANG_Ninguno; ?></option>
                                                <option value="numerico"        <?php if (@$registro_campo_editar["validacion_datos"]=="numerico")            echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmValida1;  ?></option>
                                                <option value="numerico_entero" <?php if (@$registro_campo_editar["validacion_datos"]=="numerico_entero")     echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmValida9;  ?></option>
                                                <option value="alfabetico"      <?php if (@$registro_campo_editar["validacion_datos"]=="alfabetico")          echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmValida2;  ?></option>
                                                <option value="alfanumerico"    <?php if (@$registro_campo_editar["validacion_datos"]=="alfanumerico")        echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmValida3;  ?></option>
            									<option value="personalizado"   <?php if (@$registro_campo_editar["validacion_datos"]=="personalizado")       echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmValida10; ?></option>
                                            <optgroup label="<?php echo $MULTILANG_AplicaPara; ?> <?php echo $MULTILANG_FrmTipo1; ?>">
                                                <option value="fecha"           <?php if (@$registro_campo_editar["validacion_datos"]=="fecha")               echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmValida4;  ?></option>
                                                <option value="fechaxanos"      <?php if (@$registro_campo_editar["validacion_datos"]=="fechaxanos")          echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmValida7;  ?></option>
                                                <option value="hora"            <?php if (@$registro_campo_editar["validacion_datos"]=="hora")                echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmValida5;  ?></option>
                                                <option value="fechahora"       <?php if (@$registro_campo_editar["validacion_datos"]=="fechahora")           echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmValida6;  ?></option>
            									<option value="fechahorafull"   <?php if (@$registro_campo_editar["validacion_datos"]=="fechahorafull")       echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmValida8;  ?></option>
                                            </optgroup>
                                        </select>
                                        <span class="input-group-addon">
                                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmValidaDes; ?>"><i class="fa fa-question-circle icon-info"></i></a>
                                        </span>
                                    </div>
                                </div>
                    			<div class="col col-md-6">
                                    <label for="validacion_extras"><?php echo $MULTILANG_FrmValidaExtra; ?>:</label>
                                    <div class="form-group input-group">
                                        <input type="text" name="validacion_extras" class="form-control input-sm" value="<?php echo @$registro_campo_editar["validacion_extras"]; ?>">
                                        <span class="input-group-addon">
                                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmValidaAyuda; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                        </span>
                                    </div>
                    			</div>
                    		</div>
						</div>


						<div id='campo6' style="display:none;">
                            <label for="solo_lectura"><?php echo $MULTILANG_FrmLectura; ?>:</label>
                            <div class="form-group input-group">
                                <select id="solo_lectura" name="solo_lectura" class="form-control input-sm" >
                                    <option value="READONLY" <?php if (@$registro_campo_editar["solo_lectura"]=="READONLY") echo 'SELECTED'; ?>><?php echo $MULTILANG_Si; ?></option>
                                    <option value=""         <?php if (@$registro_campo_editar["solo_lectura"]=="")         echo 'SELECTED'; ?>><?php echo $MULTILANG_No; ?></option>
                                </select>
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_FrmTitLectura; ?></b><br><?php echo $MULTILANG_FrmDesLectura; ?>"><i class="fa fa-question-circle icon-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo7' style="display:none;">
                            <div class="form-group input-group">
                                <input type="text" name="ayuda_titulo" class="form-control input-sm" value="<?php echo @$registro_campo_editar["ayuda_titulo"]; ?>" placeholder="<?php echo $MULTILANG_FrmAyuda; ?>">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesAyuda; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo8' style="display:none;">
                            <div class="form-group input-group">
                                <textarea name="ayuda_texto" rows="2" class="form-control input-sm" placeholder="<?php echo $MULTILANG_FrmTxtAyuda; ?>"><?php echo @$registro_campo_editar["ayuda_texto"]; ?></textarea>
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesTxtAyuda; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo18' style="display:none;">
                            <div class="form-group input-group">
                                <input type="text" name="lista_opciones" class="form-control input-sm" value="<?php echo @$registro_campo_editar["lista_opciones"]; ?>" placeholder="<?php echo $MULTILANG_FrmLista; ?>">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmTitLista; ?> (<?php echo $MULTILANG_FrmDesLista2; ?>)"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo19' style="display:none;">
                            <label for="origen_lista_opciones"><?php echo $MULTILANG_FrmOrigen; ?>:</label>
                            <div class="form-group input-group">
                                <select id="origen_lista_opciones" name="origen_lista_opciones" onchange="document.datosform.origen_lista_opciones_manual.value=document.datosform.origen_lista_opciones.value;" class="form-control input-sm" >
                                    <option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
                                    <?php
                                        $resultado=PCO_ConsultarTablas();
                                        while ($registro = $resultado->fetch())
                                            {
                                                // Imprime solamente las tablas de aplicacion, es decir, las que no cumplen prefijo de internas de Practico
                                                if (strpos($registro[0],$TablasCore)===FALSE)  // Booleana requiere === o !==
                                                    {
                                                        echo '<optgroup label="'.str_replace($TablasApp,'',$registro[0]).'" >';
                                                        //Busca los campos de la tabla
                                                        $nombre_tabla_opc=$registro[0];
                                                        $resultadocampos=PCO_ConsultarColumnas($nombre_tabla_opc);
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
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmTitOrigen; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_FrmTitOrigen2; ?></b><br><?php echo $MULTILANG_FrmDesOrigen; ?>"><i class="fa fa-question-circle icon-info"></i></a>
                                </span>
                            </div>

                            <div class="form-group input-group">
                                <input name="origen_lista_opciones_manual" value="<?php echo @htmlentities($registro_campo_editar["origen_lista_opciones"]); ?>" type="text" class="form-control input-sm" placeholder="<?php echo $MULTILANG_InfCampoManual; ?>: ExpresionSQL o Tabla.Campo">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="Este campo permite comillas dobles para su uso con parametros o valores fijos.  This field allow double cuotes for parameters or fixed values"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo20' style="display:none;">
                            <label for="origen_lista_valores"><?php echo $MULTILANG_FrmOrigenVal; ?>:</label>
                            <div class="form-group input-group">
                                <select id="origen_lista_valores" name="origen_lista_valores" class="form-control input-sm" onchange="document.datosform.origen_lista_valores_manual.value=document.datosform.origen_lista_valores_manual.value;">
                                    <option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
                                    <?php
                                        $resultado=PCO_ConsultarTablas();
                                        while ($registro = $resultado->fetch())
                                            {
                                                // Imprime solamente las tablas de aplicacion, es decir, las que no cumplen prefijo de internas de Practico
                                                if (strpos($registro[0],$TablasCore)===FALSE)  // Booleana requiere === o !==
                                                    {
                                                        echo '<optgroup label="'.str_replace($TablasApp,'',$registro[0]).'" >';
                                                        //Busca los campos de la tabla
                                                        $nombre_tabla_val=$registro[0];
                                                        $resultadocampos=PCO_ConsultarColumnas($nombre_tabla_val);
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
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmTitOrigenVal; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_FrmTitOrigen2; ?></b><br><?php echo $MULTILANG_FrmDesOrigenVal; ?>"><i class="fa fa-question-circle icon-info"></i></a>
                                </span>
                            </div>
                            
                            <div class="form-group input-group">
                                <input name="origen_lista_valores_manual" value="<?php echo @htmlentities($registro_campo_editar["origen_lista_valores"]); ?>" type="text" class="form-control input-sm" placeholder="<?php echo $MULTILANG_InfCampoManual; ?>: ExpresionSQL o Tabla.Campo">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="Este campo permite comillas dobles para su uso con parametros o valores fijos.  This field allow double cuotes for parameters or fixed values"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo35' style="display:none;">
                            <div class="form-group input-group">
                                <input type="text" name="condicion_filtrado_listas" class="form-control input-sm" value="<?php echo @htmlentities($registro_campo_editar["condicion_filtrado_listas"]); ?>" placeholder="<?php echo $MULTILANG_FrmFiltroLista; ?>">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesFiltroLista; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo27' style="display:none;">
                            <label for="formato_salida"><?php echo $MULTILANG_FrmFormatoSalida; ?>:</label>
                            <div class="form-group input-group">
                                <select id="formato_salida" name="formato_salida" class="form-control input-sm">
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
                                <span class="input-group-addon">
                                    <i class="fa fa-barcode texto-negro"></i><i class="fa fa-barcode texto-negro"></i>
                                </span>
                            </div>
						</div>

						<div id='campo29' style="display:none;">
                            <label for="peso_archivo"><?php echo $MULTILANG_Peso; ?> (Max)</label>
                            <div class="form-group input-group">
                                <select id="peso_archivo" name="peso_archivo" class="form-control input-sm">
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
                            </div>
						</div>


						<div id='campo30' style="display:none;">
                            <label for="tamano_pincel"><?php echo $MULTILANG_FrmTipoPincel; ?></label>
                            <div class="form-group input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-paint-brush texto-rojo"></i>
                                </span>
                                <select id="tamano_pincel" name="tamano_pincel" class="form-control input-sm">
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
                                </select>
                                <span class="input-group-addon">
                                    (Pixels)
                                </span>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-yelp texto-verde"></i>
                                </span>
                                <input type="color" name="color_trazo" value="<?php if (@$registro_campo_editar["color_trazo"]!="") echo $registro_campo_editar["color_trazo"]; else echo '#000000'; ?>" class="form-control" placeholder="<?php echo $MULTILANG_FrmTipoColor; ?> (Hex)">
                            </div>
                            <?php
                                PCO_Mensaje('<i class="fa fa-info fa-2x text-info texto-blink"></i> '.$MULTILANG_Ayuda, $MULTILANG_FrmImagenDes, '', '', 'alert alert-info alert-dismissible');
                            ?>
						</div>


						<div id='campo31' style="display:none;">
                            <?php
                                PCO_Mensaje('<i class="fa fa-warning fa-2x text-danger texto-blink"></i> '.$MULTILANG_Atencion, $MULTILANG_FrmTipoAdvertencia, '', '', 'alert alert-warning alert-dismissible');
                            ?>
						</div>


						<div id='campo21' style="display:none;">
							<table class="TextosVentana">
							<tr>
								<td colspan=2>
									<?php echo $MULTILANG_FrmEtiqueta; ?>:<br>
									<div id="Summer_valor_etiqueta" class="summernote"></div>
									<textarea rows="20" name="valor_etiqueta" id="valor_etiqueta" style="visibility:hidden; display:none;"><?php echo @$registro_campo_editar["valor_etiqueta"]; ?></textarea>
								</td>
							</tr>
							</table>
						</div>


						<div id='campo22' style="display:none;">
                            <div class="form-group input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-globe"></i>
                                </span>
                                <input type="text" name="url_iframe" class="form-control input-sm" value="<?php echo @$registro_campo_editar["url_iframe"]; ?>" placeholder="<?php echo $MULTILANG_FrmURL; ?>">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesURL; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo23' style="display:none;">
                            <label for="informe_vinculado"><?php echo $MULTILANG_FrmInforme; ?></label>
                            <div class="form-group input-group">
                                <select id="informe_vinculado" name="informe_vinculado" class="selectpicker combo-informe_vinculado show-tick form-control input-sm" data-live-search=true>
                                <option value="0"><?php echo $MULTILANG_SeleccioneUno; ?></option>
                                <?php
                                    //Define desde donde filtrar informes cuando se esta en modo desarrollador de Practico
                                    $LimiteInferiorBusqueda="-10000";
                                    if ($ModoDesarrolladorPractico!="-10000")
                                        $LimiteInferiorBusqueda=0;
                                    $consulta_informs=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_informe." FROM ".$TablasCore."informe WHERE id>=$LimiteInferiorBusqueda ORDER BY titulo");
                                    while($registro_informes = $consulta_informs->fetch())
                                        {
                                            $seleccion_campo="";
                                            if (@$registro_campo_editar["informe_vinculado"]==$registro_informes["id"])
                                                $seleccion_campo="SELECTED";
                                            echo '<option value="'.$registro_informes["id"].'" '.$seleccion_campo.'>(Id.'.$registro_informes["id"].') '.$registro_informes["titulo"].'</option>';
                                        }
                                ?>
                                </select>
                            </div>
						</div>


						<div id='campo32' style="display:none;">
                            <label for="formulario_vinculado"><?php echo $MULTILANG_FrmFormulario; ?></label>
                            <div class="form-group input-group">
                                <select id="formulario_vinculado" name="formulario_vinculado" class="selectpicker combo-informe_vinculado show-tick form-control input-sm" data-live-search=true>
                                <option value="0"><?php echo $MULTILANG_SeleccioneUno; ?></option>
                                <?php
                                    //Define desde donde filtrar informes cuando se esta en modo desarrollador de Practico
                                    $LimiteInferiorBusqueda="-10000";
                                    if ($ModoDesarrolladorPractico!="-10000")
                                        $LimiteInferiorBusqueda=0;
                                    $consulta_forms=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id>=$LimiteInferiorBusqueda ORDER BY titulo");
                                    while($registro_formularios = $consulta_forms->fetch())
                                        {
                                            $seleccion_campo="";
                                            if (@$registro_campo_editar["formulario_vinculado"]==$registro_formularios["id"])
                                                $seleccion_campo="SELECTED";
                                            echo '<option value="'.$registro_formularios["id"].'" '.$seleccion_campo.'>(Id.'.$registro_formularios["id"].') '.$registro_formularios["titulo"].'</option>';
                                        }
                                ?>
                                </select>
                            </div>
						</div>


						<div id='campo33' style="display:none;">
                            <div class="form-group input-group">
                                <input type="text" name="formulario_campo_vinculo" class="form-control input-sm" value="<?php echo @$registro_campo_editar["formulario_campo_vinculo"]; ?>" placeholder="<?php echo $MULTILANG_FrmCampo; ?>">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesCampoVinculo; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo34' style="display:none;">
                            <div class="form-group input-group">
                                <input type="text" name="formulario_campo_foraneo" class="form-control input-sm" value="<?php echo @$registro_campo_editar["formulario_campo_foraneo"]; ?>" placeholder="<?php echo $MULTILANG_FrmCampo; ?>">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesCampoForaneo; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo38' style="display:none;">
                            <label for="modo_inline"><?php echo $MULTILANG_FrmActivarInline; ?>:</label>
                            <div class="form-group input-group">
                                <select id="modo_inline" name="modo_inline" class="form-control input-sm" >
										<option value="0" <?php if (@$registro_campo_editar["modo_inline"]=="0") echo 'SELECTED'; ?>><?php echo $MULTILANG_No; ?></option>
										<option value="1" <?php if (@$registro_campo_editar["modo_inline"]=="1") echo 'SELECTED'; ?>><?php echo $MULTILANG_Si; ?></option>
                                </select>
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_Ayuda; ?></b><br><?php echo $MULTILANG_FrmActivarInlineDes; ?>"><i class="fa fa-question-circle icon-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo39' style="display:none;">
                            <label for="imagen"><?php echo $MULTILANG_Imagen; ?></label>
                            <div class="form-group input-group">
                                <input type="text" name="imagen" id="imagen" class="form-control input-sm" value="<?php echo @$registro_campo_editar["imagen"]; ?>" placeholder="<?php echo $MULTILANG_MnuHlpAwesome; ?>">
                                <span class="input-group-addon">
                                    <!--
                                    <a data-toggle="modal" href="#myModalSelectorIconos" title="<?php echo $MULTILANG_MnuDesImagen; ?>">
                                           <i class="fa fa-hand-o-right"></i> <i class="fa fa-picture-o"></i>
                                    </a>
                                    -->
                                </span>
                            </div>  
						</div>


						<div id='campo40' style="display:none;">
                            <label for="tipo_accion"><?php echo $MULTILANG_FrmTipoAccion; ?></label>
                            <div class="form-group input-group">
                                <select id="tipo_accion" name="tipo_accion" class="form-control input-sm">
                                    <option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
                                    <optgroup label="<?php echo $MULTILANG_FrmAccionT1; ?>">
                                        <option value="interna_guardar"     <?php if (@$registro_campo_editar["tipo_accion"]=="interna_guardar") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmAccionGuardar; ?></option>
                                        <option value="interna_actualizar"  <?php if (@$registro_campo_editar["tipo_accion"]=="interna_actualizar") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmAccionActualizar; ?></option>
                                        <option value="interna_eliminar"    <?php if (@$registro_campo_editar["tipo_accion"]=="interna_eliminar") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmAccionEliminar; ?></option>
                                        <option value="interna_escritorio"  <?php if (@$registro_campo_editar["tipo_accion"]=="interna_escritorio") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmAccionRegresar; ?></option>
                                        <option value="interna_cargar"      <?php if (@$registro_campo_editar["tipo_accion"]=="interna_cargar") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmAccionCargar; ?></option>
                                        <option value="interna_limpiar"     <?php if (@$registro_campo_editar["tipo_accion"]=="interna_limpiar") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmAccionLimpiar; ?></option>
                                    </optgroup>
                                    <optgroup label="<?php echo $MULTILANG_FrmAccionT2; ?>">
                                        <option value="externa_formulario"  <?php if (@$registro_campo_editar["tipo_accion"]=="externa_formulario") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmAccionExterna; ?></option>
                                        <option value="externa_javascript"  <?php if (@$registro_campo_editar["tipo_accion"]=="externa_javascript") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmAccionJS; ?></option>
                                    </optgroup>
                                </select>
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesAccion; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo41' style="display:none;">
                            <div class="form-group input-group">
                                <input type="text" name="accion_usuario" value="<?php echo @$registro_campo_editar["accion_usuario"]; ?>" class="form-control input-sm" placeholder="<?php echo $MULTILANG_FrmAccionCMD; ?>">
                                <span class="input-group-addon">
                                    <a href="#" data-placement="left"  data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_Ayuda; ?></b><br><?php echo $MULTILANG_FrmAccionDesCMD; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo42' style="display:none;">
                            <div class="row">
                                <div class="col-md-6">
										<div class="form-group input-group">
											<input type="text" name="valor_check_activo" class="form-control input-sm" value="<?php echo @$registro_campo_editar["valor_check_activo"]; ?>" placeholder="<?php echo $MULTILANG_FrmValOnCheck; ?>">
											<span class="input-group-addon">
												<a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmValCheckDes; ?>"><i class="fa fa-question-circle text-info"></i></a>
											</span>
										</div>
                                </div>    
                                <div class="col-md-6">
										<div class="form-group input-group">
											<input type="text" name="valor_check_inactivo" class="form-control input-sm" value="<?php echo @$registro_campo_editar["valor_check_inactivo"]; ?>" placeholder="<?php echo $MULTILANG_FrmValOffCheck; ?>">
											<span class="input-group-addon">
												<a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmValCheckDes; ?>"><i class="fa fa-question-circle text-info"></i></a>
											</span>
										</div>
                                </div>
                            </div>
						</div>


						<div id='campo12' style="display:none;">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="ajax_busqueda" name="ajax_busqueda" <?php if (@$registro_campo_editar["ajax_busqueda"]==1) echo 'checked'; ?> > <?php echo $MULTILANG_FrmAjax; ?>
                                </label>
                                <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_FrmTitAjax; ?></b><br><?php echo $MULTILANG_FrmDesAjax; ?>" name="<?php echo $MULTILANG_FrmDesUnico; ?>"><i class="fa fa-question-circle"></i></a>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="ajax_busqueda_dinamica" name="ajax_busqueda_dinamica" <?php if (@$registro_campo_editar["ajax_busqueda_dinamica"]==1) echo 'checked'; ?> > <?php echo $MULTILANG_FrmAjaxDinamico; ?>
                                </label>
                                <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_FrmTitAjax; ?></b><br>Util en recuperacion de registros sobre tablas con datos masivos. Usefull to retrieve record from tables with massive info"><i class="fa fa-question-circle"></i></a>
                            </div>
						</div>


			</div>
			<div class="col col-md-6">


						<div id='campo9' style="display:none;">
                            <div class="row">
                                <div class="col-md-6">
                                        <label for="peso"><?php echo $MULTILANG_Peso; ?>:</label>
                                        <div class="form-group input-group">
                                            <select id="peso" name="peso" class="form-control input-sm" >
                                                <?php
                                                    for ($i=1;$i<=100;$i++)
                                                        {
                                                            $seleccion_campo="";
                                                            if (@$registro_campo_editar["peso"]==$i)
                                                                $seleccion_campo="SELECTED";														
                                                            echo '<option value="'.$i.'" '.$seleccion_campo.'>'.$i.'</option>';
                                                        }
                                                ?>
                                            </select>
                                            <span class="input-group-addon">
                                                <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesPeso; ?>"><i class="fa fa-question-circle icon-info"></i></a>
                                            </span>
                                        </div>
                                </div>    
                                <div class="col-md-6">
                                        <label for="columna"><?php echo $MULTILANG_Columna; ?>:</label>
                                        <div class="form-group input-group">
                                            <select id="columna" name="columna" class="form-control input-sm" >
                                                <?php
                                                    // Obtiene numero de columnas para el formulario
                                                    $consulta_columnas=PCO_EjecutarSQL("SELECT columnas FROM ".$TablasCore."formulario WHERE id=? ","$formulario");
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
                                            </select>
                                            <span class="input-group-addon">
                                                <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesColumna; ?>"><i class="fa fa-question-circle icon-info"></i></a>
                                            </span>
                                        </div>
                                </div>
                            </div>
						</div>


						<div id='campo10' style="display:none;">
                            <div class="row">
                                <div class="col-md-6">
                                        <label for="obligatorio"><?php echo $MULTILANG_FrmObligatorio; ?>:</label>
                                        <div class="form-group input-group">
                                            <select id="obligatorio" name="obligatorio" class="form-control input-sm" >
                                                <option value="1" <?php if (@$registro_campo_editar["obligatorio"]==1) echo 'SELECTED'; ?>><?php echo $MULTILANG_Si; ?></option>
                                                <option value="0" <?php if (@$registro_campo_editar["obligatorio"]==0) echo 'SELECTED'; ?>><?php echo $MULTILANG_No; ?></option>
                                            </select>
                                        </div>                                    
                                </div>    
                                <div class="col-md-6">
                                        <label for="visible"><?php echo $MULTILANG_FrmVisible; ?>:</label>
                                        <div class="form-group input-group">
                                        <select  id="visible" name="visible" class="form-control" >
                                            <option value="1" <?php if (@$registro_campo_editar["visible"]=="1") echo 'SELECTED'; ?>><?php echo $MULTILANG_Si; ?></option>
                                            <option value="0" <?php if (@$registro_campo_editar["visible"]=="0") echo 'SELECTED'; ?>><?php echo $MULTILANG_No; ?></option>
                                        </select>
                                            <span class="input-group-addon">
                                                <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesVisible; ?>"><i class="fa fa-question-circle icon-info"></i></a>
                                            </span>
                                        </div>
                                </div>
                            </div>
						</div>


						<div id='campo11' style="display:none;">
                            <div class="form-group input-group">
                                <input type="text" name="etiqueta_busqueda" class="form-control input-sm" value="<?php echo @$registro_campo_editar["etiqueta_busqueda"]; ?>" placeholder="<?php echo $MULTILANG_FrmLblBusqueda; ?>">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_FrmTitBusqueda; ?></b><br><?php echo $MULTILANG_FrmDesBusqueda; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo14' style="display:none;">
                            <label for="ancho"><?php echo $MULTILANG_FrmAncho; ?>:</label>
                            <div class="form-group input-group">
                                <input type="text" name="ancho" class="form-control input-sm" value="<?php if (@$registro_campo_editar["ancho"]!="") echo @$registro_campo_editar["ancho"]; else echo "0"; ?>" placeholder="<?php echo $MULTILANG_FrmAncho; ?>">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_FrmTitAncho; ?></b><br><?php echo $MULTILANG_FrmDesAncho; ?> (<?php echo $MULTILANG_FrmDesAncho2; ?>)"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>

						<div id='campo15' style="display:none;">
                            <label for="alto"><?php echo $MULTILANG_FrmAlto; ?>:</label>
                            <div class="form-group input-group">
                                <input type="text" name="alto" class="form-control input-sm" value="<?php if (@$registro_campo_editar["alto"]!="") echo @$registro_campo_editar["alto"]; else echo "0"; ?>" placeholder="<?php echo $MULTILANG_FrmAlto; ?>">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_FrmTitAlto; ?></b><br><?php echo $MULTILANG_FrmDesAlto; ?> (<?php echo $MULTILANG_FrmDesAlto2; ?>)"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>

						<div id='campo16' style="display:none;">
                            <label for="barra_herramientas"><?php echo $MULTILANG_FrmBarra; ?>:</label>
                            <div class="form-group input-group">
                                <select  id="barra_herramientas" name="barra_herramientas" class="form-control input-sm" >
									<optgroup label="<?php echo $MULTILANG_FrmBarraCKEditor; ?>">
										<option value="0" <?php if (@$registro_campo_editar["barra_herramientas"]=="0") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmBarraTipo1; ?></option>
										<option value="1" <?php if (@$registro_campo_editar["barra_herramientas"]=="1") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmBarraTipo2; ?></option>
										<option value="2" <?php if (@$registro_campo_editar["barra_herramientas"]=="2") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmBarraTipo3; ?></option>
										<option value="3" <?php if (@$registro_campo_editar["barra_herramientas"]=="3") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmBarraTipo4; ?></option>
										<option value="4" <?php if (@$registro_campo_editar["barra_herramientas"]=="4") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmBarraTipo5; ?></option>
                                    </optgroup>
									<optgroup label="<?php echo $MULTILANG_FrmBarraSummer; ?>">
										<option value="5" <?php if (@$registro_campo_editar["barra_herramientas"]=="5") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmBarraTipo1Summer; ?></option>
										<option value="6" <?php if (@$registro_campo_editar["barra_herramientas"]=="6") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmBarraTipo2Summer; ?></option>
										<option value="7" <?php if (@$registro_campo_editar["barra_herramientas"]=="7") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmBarraTipo3Summer; ?></option>
										<option value="8" <?php if (@$registro_campo_editar["barra_herramientas"]=="8") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmBarraTipo4Summer; ?></option>
										<option value="9" <?php if (@$registro_campo_editar["barra_herramientas"]=="9") echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmBarraTipo5Summer; ?></option>
                                    </optgroup>
                                </select>
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_FrmTitBarra; ?></b><br><?php echo $MULTILANG_FrmDesBarra; ?>"><i class="fa fa-question-circle icon-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo17' style="display:none;">
                            <label for="solo_lectura"><?php echo $MULTILANG_FrmFila; ?>:</label>
                            <div class="form-group input-group">
                                <select id="fila_unica" name="fila_unica" class="form-control input-sm" >
										<option value="0" <?php if (@$registro_campo_editar["fila_unica"]=="0") echo 'SELECTED'; ?>><?php echo $MULTILANG_No; ?></option>
										<option value="1" <?php if (@$registro_campo_editar["fila_unica"]=="1") echo 'SELECTED'; ?>><?php echo $MULTILANG_Si; ?></option>
                                </select>
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_FrmTitFila; ?></b><br><?php echo $MULTILANG_FrmDesFila; ?>"><i class="fa fa-question-circle icon-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo24' style="display:none;">
                            <label for="objeto_en_ventana"><?php echo $MULTILANG_FrmVentana; ?></label>
                            <div class="form-group input-group">
                                <select id="objeto_en_ventana" name="objeto_en_ventana" class="form-control input-sm">
                                    <option value="0" <?php if (@$registro_campo_editar["objeto_en_ventana"]=="0") echo 'SELECTED'; ?>><?php echo $MULTILANG_No; ?></option>
                                    <option value="1" <?php if (@$registro_campo_editar["objeto_en_ventana"]=="1") echo 'SELECTED'; ?>><?php echo $MULTILANG_Si; ?></option>
                                </select>
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesVentana; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo25' style="display:none;">
                            <div class="form-group input-group">
                                <input type="text" name="maxima_longitud" class="form-control input-sm" value="<?php  if (@$registro_campo_editar["maxima_longitud"]!="") echo @$registro_campo_editar["maxima_longitud"]; else echo "0"; ?>" placeholder="<?php echo $MULTILANG_FrmLongMaxima; ?>">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_FrmTit1LongMaxima; ?></b><br>(<?php echo $MULTILANG_FrmTit2LongMaxima; ?>)"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo26' style="display:none;">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group input-group">
                                        <input type="text" name="valor_minimo" class="form-control input-sm" value="<?php if (@$registro_campo_editar["valor_minimo"]!="1") echo @$registro_campo_editar["valor_minimo"]; else echo "1"; ?>" placeholder="<?php echo $MULTILANG_FrmValorMinimo; ?>">
                                        <span class="input-group-addon">
                                            <i class="fa fa-hand-o-down"></i>
                                        </span>
                                    </div>
                                </div>    
                                <div class="col-md-4">
                                    <div class="form-group input-group">
                                        <input type="text" name="valor_maximo" class="form-control input-sm" value="<?php if (@$registro_campo_editar["valor_maximo"]!="100") echo @$registro_campo_editar["valor_maximo"]; else echo "100"; ?>" placeholder="<?php echo $MULTILANG_FrmValorMaximo; ?>">
                                        <span class="input-group-addon">
                                            <i class="fa fa-hand-o-up"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group input-group">
                                        <input type="text" name="valor_salto" class="form-control input-sm" value="<?php if (@$registro_campo_editar["valor_salto"]!="1") echo @$registro_campo_editar["valor_salto"]; else echo "1"; ?>" placeholder="<?php echo $MULTILANG_FrmValorSalto; ?>">
                                        <span class="input-group-addon">
                                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmTitValorSalto; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
						</div>


						<div id='campo28' style="display:none;">
                            <div class="form-group input-group">
                                <input type="text" name="plantilla_archivo" class="form-control input-sm" value="<?php echo @$registro_campo_editar["plantilla_archivo"]; ?>" placeholder="<?php echo $MULTILANG_FrmPlantillaArchivo; ?>">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesPlantillaArchivo; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
                            <?php
                                PCO_Mensaje('<i class="fa fa-info fa-2x text-info texto-blink"></i> '.$MULTILANG_Ayuda, '<font size=1>'.$MULTILANG_FrmPlantillaEjemplos.'</font>', '', '', 'alert alert-info alert-dismissible');
                            ?>
						</div>



						<div id='campo36' style="display:none;">
                            <div class="form-group input-group">
                                <input type="text" name="pestana_objeto" class="form-control input-sm" value="<?php echo @$registro_campo_editar["pestana_objeto"]; ?>" placeholder="<?php echo $MULTILANG_FrmPestana; ?>">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesPestana; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo48' style="display:none;">
                            <div class="form-group input-group">
                                <input type="text" name="etiqueta_colapsable" class="form-control input-sm" value="<?php echo @$registro_campo_editar["etiqueta_colapsable"]; ?>" placeholder="Etiqueta de colapso / See more label">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="Si se ingresa un valor aqu&iacute; el control ser&aacute; ocultado del formulario y en su lugar se agregar&aacute; la etiqueta para expandirlo al hacer clic. If you enter a value here the control will be hidded in the form and you will see the label to click it and show the whole control."><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>


						<div id='campo43' style="display:none;">
							<script language="JavaScript">
								function ActualizarTexto_botoncomando_vista_previa(texto_nuevo)
									{
										//Asigna la etiqueta
										$('#botoncomando_vista_previa').text(texto_nuevo);
									}
									
								function ActualizarEstilo_botoncomando_vista_previa()
									{
										//Remueve estilos actuales
										$("#botoncomando_vista_previa").removeClass();
										//Aplica los estilos segun el campo
										$( "#botoncomando_vista_previa" ).addClass(document.datosform.personalizacion_tag.value);
									}
								
								function Actualizar_botoncomando_vista_previa(texto_nuevo)
									{
										//Actualiza el campo de estilos
										document.datosform.personalizacion_tag.value=document.datosform.estilo0.value+document.datosform.estilo1.value;
										//Aplica el estilo
										ActualizarEstilo_botoncomando_vista_previa();
									}
							</script>

							<div class="row">
								<div class="col col-md-5">
									<label for="estilo0"><?php echo $MULTILANG_FrmEstilo; ?>:</label>
									<div class="form-group input-group">
										<select id="estilo0" name="estilo0" class="form-control input-sm" OnChange="Actualizar_botoncomando_vista_previa();">
											<option value=""><?php echo $MULTILANG_Ninguno; ?></option>
											<option value=" btn "><?php echo $MULTILANG_BtnEstiloSimple; ?></option>
											<option value=" btn btn-default "><?php echo $MULTILANG_BtnEstiloPredeterminado; ?></option>
											<option value=" btn btn-primary "><?php echo $MULTILANG_BtnEstiloPrimario; ?></option>
											<option value=" btn btn-success "><?php echo $MULTILANG_BtnEstiloFinalizado; ?></option>
											<option value=" btn btn-info "><?php echo $MULTILANG_BtnEstiloInformacion; ?></option>
											<option value=" btn btn-warning "><?php echo $MULTILANG_BtnEstiloAdvertencia; ?></option>
											<option value=" btn btn-danger "><?php echo $MULTILANG_BtnEstiloPeligro; ?></option>
										</select>
									</div>

									<label for="estilo1"><?php echo $MULTILANG_Tamano; ?>:</label>
									<div class="form-group input-group">
										<select id="estilo1" name="estilo1" class="form-control input-sm" OnChange="Actualizar_botoncomando_vista_previa();">
											<option value=""><?php echo $MULTILANG_Predeterminado; ?></option>
											<option value=" btn-xs "><?php echo $MULTILANG_Pequeno; ?></option>
											<option value=" btn-sm "><?php echo $MULTILANG_Mediano; ?></option>
											<option value=" btn-lg "><?php echo $MULTILANG_Grande; ?></option>
										</select>
									</div>
								</div>
								<div class="col col-md-7 jumbotron">
									<div align="center">
										<?php echo $MULTILANG_VistaPrev; ?>:<br><br>
										<button type="button" name="botoncomando_vista_previa" id="botoncomando_vista_previa" class=""></button>
									</div>
								</div>
							</div>
						</div>


						<div id='campo37' style="display:none;">
							<label for="personalizacion_tag"><?php echo $MULTILANG_Personalizado; ?>:</label>
                            <div class="form-group input-group">
                                <input type="text" name="personalizacion_tag" class="form-control input-sm" value="<?php echo @htmlspecialchars($registro_campo_editar["personalizacion_tag"]); ?>" placeholder="<?php echo $MULTILANG_FrmTagPersonalizado; ?>: BootStrap o Customizado"  OnInput="ActualizarEstilo_botoncomando_vista_previa(); ActualizarEstilo_listaopciones_vista_previa(); ">
                                <span class="input-group-addon">
                                    <a href="#"  data-toggle="tooltip" data-html="true" data-placement="auto" title="<b><?php echo $MULTILANG_Ayuda; ?></b><br><?php echo $MULTILANG_FrmDesTagPersonalizado; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
                            <div class='alert alert-info btn-xs'><?php echo $MULTILANG_FrmDesTagPersonalizado; ?></div>
						</div>

						<div id='campo47' style="display:none;">
                            <div class="form-group input-group">
                                <input type="text" name="clase_contenedor" class="form-control input-sm" value="<?php echo @$registro_campo_editar["clase_contenedor"]; ?>" placeholder="<?php echo $MULTILANG_FrmClaseContenedor; ?>">
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmClaseContenedorDes; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
						</div>

			</div>
		</div>

            <div align="center">
            <button type="button" class="btn btn-success" OnClick="document.datosform.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_FrmBtnGuardar; ?></button>
            </div>

            </div>
    <!-- ############################################################## -->
    <!-- ##################  CIERRE DE LAS PROPIEDADES ################ -->
    <!-- ############################################################## -->


    <!-- ############################################################## -->
    <!-- ##################  INICIO DE LOS EVENTOS     ################ -->
    <!-- ############################################################## -->
            <div class="tab-pane" id="eventos_objeto-tab">
                <br>
                
                
                <?php
                    if (@$registro_campo_editar["id"]=="")
                        {
                            echo '  <br><br><table align=center width="60%"><tr><td>
                                    <i class="fa fa-pull-left fa-info-circle fa-4x text-info" aria-hidden="true"></i>'.$MULTILANG_EventosPrevio.'
                                    </td></tr></table><br><br>';
                        }
                    else
                        {
                            ?>
                                        <label for="tipo_evento"><?php echo $MULTILANG_Evento; ?>:</label>
                                        <div class="form-group input-group">
                                            <select  id="tipo_evento" name="tipo_evento" data-size=10 data-live-search=true class="selectpicker"  data-style="btn-warning">
                                                <option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
                                                <?php
                                                    //Presenta los tipos de evento disponibles para controles (01,02 y 03)
                                                    $CategoriaEvento="";
                                                    $resultado_eventos = PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."evento_inventario WHERE (categoria LIKE '01%' or categoria LIKE '02%' or categoria LIKE '03%') ORDER BY categoria");
                                                    while ($registro_eventos = $resultado_eventos->fetch())
                                                        {
                                                            if ($CategoriaEvento!=$registro_eventos["categoria"])
                                                                {
                                                                    echo '<optgroup label="'.$registro_eventos["categoria"].'">';
                                                                    $CategoriaEvento=$registro_eventos["categoria"];
                                                                }
                                                            echo '<option value="'.$registro_eventos["evento"].'" data-subtext="'.${str_replace("$","",$registro_eventos["descripcion"])}.'" >'.$registro_eventos["evento"].': </option>';
                                                            //TODO: Cerrar cada optgroup cuando cambia de categoria para optimizar mas la sintaxis
                                                        }
                                                ?>
                                            </select>

                                            <span class="input-group-addon">
                                                <a class="btn btn-primary btn-xs"  onclick="PCOJS_PopUpEventosJavascript();">
                                                    <i class="fa fa-plus"></i> <?php echo $MULTILANG_Agregar; ?> <?php echo $MULTILANG_Evento; ?>
                                                </a>
                                            </span>
                                        </div>
        						<hr>
                            
                            <?php
                    		        PCO_AbrirVentana($MULTILANG_Existentes, 'panel-primary');
                    		?>
                    				<table class="table table-condensed btn-xs table-hover table-unbordered ">
                    					<thead>
                                        <tr>
                    						<td><b><?php echo $MULTILANG_Evento; ?></b></td>
                    						<td></td>
                    						<td></td>
                    					</tr>
                                        </thead>
                                        <tbody>
                    		 <?php
                                    $IdentificadorObjeto=$registro_campo_editar["id"];
                    				$consulta_eventos_definidos=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_evento_objeto." FROM ".$TablasCore."evento_objeto WHERE objeto='$IdentificadorObjeto' ");
                    				while($registro_eventos_definidos = $consulta_eventos_definidos->fetch())
                    					{
                    						echo '<tr>
                    								<td>'.$registro_eventos_definidos["evento"].'</td>
                    								<td align="center">
                    										<form action="'.$ArchivoCORE.'" method="POST" name="dfe'.$registro_eventos_definidos["id"].'" id="dfe'.$registro_eventos_definidos["id"].'">
                    										</form>
                    								</td>
                    								<td align="right">
                                                            <button class="btn btn-default btn-xs" onclick="PCO_VentanaPopup(\'index.php?PCO_Accion=PCO_EditarEventoObjeto&id_objeto_evento='.$registro_eventos_definidos["objeto"].'&evento_objeto='.$registro_eventos_definidos["evento"].'&tipo=\'+document.datosform.tipo.value+\'&Presentar_FullScreen=1&Precarga_EstilosBS=1\',\'Evento_'.$registro_eventos_definidos["evento"].'_ID'.$registro_eventos_definidos["id"].'\',\'toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=no, resizable=no, fullscreen=no, width=850, height=600\');"><i class="fa fa-pencil"></i> '.$MULTILANG_Editar.' / <i class="fa fa-times"></i> '.$MULTILANG_Eliminar.'</button>
                    								</td>
                    							</tr>';
                    					}
                    				echo '</tbody>
                                    </table>';
                    			PCO_CerrarVentana();
                        }
                ?>
                
            </div>
    <!-- ############################################################## -->
    <!-- ##################  CIERRE DE LOS EVENTOS     ################ -->
    <!-- ############################################################## -->




                            </div>
                            <!-- FIN de las pestanas -->

					<?php
						//Despues de agregar todos los parametros de campos, Si se detecta que es edicion de un campo se llama a la funcion de visualizacion de campos especificos
						if (@$popup_activo=="FormularioCampos")
							echo '	<script TYPE="text/javascript" LANGUAGE="JavaScript">
										CambiarCamposVisibles("'.$registro_campo_editar["tipo"].'");
									</script>';
					?>
                    </form>
    <?php 
        $barra_herramientas_modal='
            <a href="javascript:  $(\'#myModalElementoFormulario\').modal(\'hide\'); $(\'#myModalDisenoFormulario\').modal(\'show\');"><button type="button" class="btn btn-info">'.$MULTILANG_FrmDisCampos.'</button></a>
            <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cancelar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
        PCO_CerrarDialogoModal($barra_herramientas_modal);
    ?>
    <!-- FIN MODAL ADICION DE CAMPOS -->


    <!-- INICIO MODAL ADICION DE BOTONES -->
    <?php PCO_AbrirDialogoModal("myModalBotonFormulario",$MULTILANG_FrmAgregaBot,"modal-wide"); ?>
				<form name="datosfield" id="datosfield" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="PCO_Accion" value="PCO_GuardarAccionFormulario">
				<input type="Hidden" name="nombre_tabla" value="<?php echo $nombre_tabla; ?>">
				<input type="Hidden" name="formulario" value="<?php echo $formulario; ?>">

				<script language="JavaScript">
					function ActualizarTexto_boton_vista_previa(texto_nuevo)
						{
							//Asigna la etiqueta
							$('#boton_vista_previa').text(texto_nuevo);
						}
						
					function ActualizarEstilo_boton_vista_previa()
						{
							//Remueve estilos actuales
							$("#boton_vista_previa").removeClass();
							//Aplica los estilos segun el campo
							$( "#boton_vista_previa" ).addClass(document.datosfield.estilo.value);
						}
					
					function Actualizar_boton_vista_previa(texto_nuevo)
						{
							//Actualiza el campo de estilos
							document.datosfield.estilo.value=document.datosfield.estilo0.value+document.datosfield.estilo1.value;
							//Aplica el estilo
							ActualizarEstilo_boton_vista_previa();
						}
				</script>

		<div class="row">
			<div class="col col-md-6">

                    <div class="form-group input-group">
                        <input type="text" name="titulo" class="form-control" placeholder="<?php echo $MULTILANG_FrmTituloBot; ?>"  OnInput="ActualizarTexto_boton_vista_previa(this.value);">
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesBot; ?>"><i class="fa fa-question-circle text-info"></i></a>
                        </span>
                    </div>

                    <div class="form-group input-group">
                        <input type="text" name="id_html" class="form-control" placeholder="ID HTML">
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmIdHTML; ?>"><i class="fa fa-question-circle text-info"></i></a>
                        </span>
                    </div>

					<div class="row">
						<div class="col col-md-5">
							<label for="estilo0"><?php echo $MULTILANG_FrmEstilo; ?>:</label>
							<div class="form-group input-group">
								<select id="estilo0" name="estilo0" class="form-control input-sm" OnChange="Actualizar_boton_vista_previa();">
									<option value=""><?php echo $MULTILANG_Ninguno; ?></option>
									<option value=" btn "><?php echo $MULTILANG_BtnEstiloSimple; ?></option>
									<option value=" btn btn-default "><?php echo $MULTILANG_BtnEstiloPredeterminado; ?></option>
									<option value=" btn btn-primary "><?php echo $MULTILANG_BtnEstiloPrimario; ?></option>
									<option value=" btn btn-success "><?php echo $MULTILANG_BtnEstiloFinalizado; ?></option>
									<option value=" btn btn-info "><?php echo $MULTILANG_BtnEstiloInformacion; ?></option>
									<option value=" btn btn-warning "><?php echo $MULTILANG_BtnEstiloAdvertencia; ?></option>
									<option value=" btn btn-danger "><?php echo $MULTILANG_BtnEstiloPeligro; ?></option>
								</select>
							</div>

							<label for="estilo1"><?php echo $MULTILANG_Tamano; ?>:</label>
							<div class="form-group input-group">
								<select id="estilo1" name="estilo1" class="form-control input-sm" OnChange="Actualizar_boton_vista_previa();">
									<option value=""><?php echo $MULTILANG_Predeterminado; ?></option>
									<option value=" btn-xs "><?php echo $MULTILANG_Pequeno; ?></option>
									<option value=" btn-sm "><?php echo $MULTILANG_Mediano; ?></option>
									<option value=" btn-lg "><?php echo $MULTILANG_Grande; ?></option>
								</select>
							</div>
							
							<label for="estilo"><?php echo $MULTILANG_Personalizado; ?>:</label>
							<div class="form-group input-group">
								<input type="text" id="estilo" name="estilo" class="form-control input-sm" placeholder="<?php echo $MULTILANG_Avanzado; ?>: BootStrap o Customizado"  OnInput="ActualizarEstilo_boton_vista_previa();">
								<span class="input-group-addon">
									<a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesEstilo; ?>"><i class="fa fa-question-circle text-info"></i></a>
								</span>
							</div>
						</div>
						<div class="col col-md-7 jumbotron">
							<div align="center">
								<?php echo $MULTILANG_VistaPrev; ?>:<br><br>
								<button type="button" name="boton_vista_previa" id="boton_vista_previa" class=""></button>
							</div>
						</div>
					</div>

                    <label for="tipo_accion"><?php echo $MULTILANG_FrmTipoAccion; ?></label>
                    <div class="form-group input-group">
                        <select id="tipo_accion" name="tipo_accion" class="form-control">
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
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesAccion; ?>"><i class="fa fa-question-circle text-info"></i></a>
                        </span>
                    </div>

                    <div class="form-group input-group">
                        <input type="text" name="accion_usuario" class="form-control" placeholder="<?php echo $MULTILANG_FrmAccionCMD; ?>">
                        <span class="input-group-addon">
                            <a href="#" data-placement="left"  data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_Ayuda; ?></b><br><?php echo $MULTILANG_FrmAccionDesCMD; ?>"><i class="fa fa-question-circle text-info"></i></a>
                        </span>
                    </div>

			</div>
			<div class="col col-md-6">

                    <div class="row">
                        <div class="col-md-6">
                            <label for="peso"><?php echo $MULTILANG_Peso; ?></label>
                            <div class="form-group input-group">
                                <select id="peso" name="peso" class="form-control">
                                    <?php
                                        for ($i=1;$i<=20;$i++)
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                    ?>
                                </select>
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesPeso; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
                        </div>    
                        <div class="col-md-6">
                            <label for="visible"><?php echo $MULTILANG_FrmVisible; ?></label>
                            <div class="form-group input-group">
                                <select id="visible" name="visible" class="form-control">
                                    <option value="1"><?php echo $MULTILANG_Si; ?></option>
                                    <option value="0"><?php echo $MULTILANG_No; ?></option>
                                </select>
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmBotDesVisible; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group input-group">
                        <input type="text" name="retorno_titulo" class="form-control" placeholder="<?php echo $MULTILANG_FrmRetorno; ?>">
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesRetorno; ?>"><i class="fa fa-question-circle text-info"></i></a>
                        </span>
                    </div>

                    <div class="form-group input-group">
                        <textarea name="retorno_texto" rows="2" class="form-control" placeholder="<?php echo $MULTILANG_FrmTxtRetorno; ?>"></textarea>
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmTxtDesRetorno; ?>"><i class="fa fa-question-circle text-info"></i></a>
                        </span>
                    </div>

                    <div class="form-group input-group">
                        <input type="text" name="retorno_icono" class="form-control" placeholder="<?php echo $MULTILANG_FrmTxtRetornoIcono; ?>">
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmTxtDesRetornoIcono; ?>"><i class="fa fa-question-circle text-info"></i></a>
                        </span>
                    </div>
                    
                    <div class="form-group input-group">
                        <label for="retorno_estilo"><?php echo $MULTILANG_FrmTxtRetornoEstilo; ?></label>
						<select id="retorno_estilo" name="retorno_estilo" class="form-control">
							<option value=""><?php echo $MULTILANG_Predeterminado; ?> alert-danger</option>
							<option value="alert-success">Finalizado (alert-success)</option>
							<option value="alert-info">Informacion (alert-info)</option>
							<option value="alert-warning">Advertencia (alert-warning)</option>
							<option value="alert-danger">Error/Peligro (alert-danger)</option>
							<option value="alert-default">Sin estilo (alert-default)</option>
						</select>
                    </div>                    

                    <div class="form-group input-group">
                        <input type="text" name="confirmacion_texto" class="form-control" placeholder="<?php echo $MULTILANG_FrmConfirma; ?>">
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_FrmDesConfirma; ?>"><i class="fa fa-question-circle text-info"></i></a>
                        </span>
                    </div>

                    <!--
                    <div class="row">
                        <div class="col-md-6">
                            <label for="target_formulario"><?php echo $MULTILANG_FrmBtnObjetivo; ?></label>
                            <div class="form-group input-group">
                                <select id="target_formulario" name="target_formulario" class="form-control">
                                    <option value="_SELF">_SELF (<?php echo $MULTILANG_Predeterminado; ?>)</option>
                                    <option value="_BLANK">_BLANK</option>
                                    <option value="_PARENT">_PARENT</option>
                                    <option value="_TOP">_TOP</option>
                                </select>
                            </div>
                        </div>    
                        <div class="col-md-6">
                            <label for="pantalla_completa"><?php echo $MULTILANG_FrmBtnFull; ?></label>
                            <div class="form-group input-group">
                                <select id="pantalla_completa" name="pantalla_completa" class="form-control">
                                    <option value="0"><?php echo $MULTILANG_No; ?></option>
                                    <option value="1"><?php echo $MULTILANG_Si; ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    -->
			</div>
		</div>
                    </form>
    <?php 
        $barra_herramientas_modal='
            <input type="Button" class="btn btn-success" value="'.$MULTILANG_FrmBtnGuardarBut.'" onClick="document.datosfield.submit()">
            <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cancelar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
        PCO_CerrarDialogoModal($barra_herramientas_modal);
    ?>
    <!-- FIN MODAL ADICION DE BOTONES -->



    <!-- INICIO MODAL DISENO DE FORMULARIO -->
    <?php PCO_AbrirDialogoModal("myModalDisenoFormulario",$MULTILANG_FrmDisCampos,"modal-wide"); ?>
					<table class="table table-condensed table-hover btn-xs">
						<thead>
                        <tr>
                            <td><b><?php echo $MULTILANG_Titulo; ?> (<?php echo $MULTILANG_Tipo?>)</b></td>
							<td><b><?php echo $MULTILANG_Campo; ?></b></td>
							<td><b>ID_HTML</b></td>
							<td><b><?php echo $MULTILANG_Columna; ?></b></td>
							<td><b><?php echo $MULTILANG_Peso; ?></b></td>
							<td><b><?php echo $MULTILANG_FrmObligatorio; ?></b> <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_Importante; ?></b><br><?php echo $MULTILANG_FrmDesObliga; ?>"><i class="fa fa-question-circle"></i></a></td>
							<td><b><?php echo $MULTILANG_FrmVisible; ?></b></td>
							<td></td>
							<td></td>
						</tr>
                        </thead>
                        <tbody>
			 <?php
                //Determina cual es la pestana para agregar el titulo cada que cambie en el listado
                $pestana_actual="";
				//Busca los controles
                $consulta=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? ORDER BY pestana_objeto,columna,peso","$formulario");
				while($registro = $consulta->fetch())
					{
						//Si el registro cambia de pestana entonces agrega el titulo
                        if ($pestana_actual!=$registro["pestana_objeto"])
                            {
                                echo '<tr><td class="btn-info" colspan=8 align=center>
                                        <h4><b><i class="fa fa-stack-overflow"></i> '.$MULTILANG_Pestana.': '.$registro["pestana_objeto"].'</b></h4>
                                    </td></tr>';
                                //Actualiza la ultima pestana
                                $pestana_actual=$registro["pestana_objeto"];
                            }
                        
                        $peso_aumentado=$registro["peso"]+1;
						if ($registro["peso"]-1>=1) $peso_disminuido=$registro["peso"]-1; else $peso_disminuido=1;
						
                        //Si el elemento es un formulario o informe embebido busca ademas el nombre del mismo
                        $Complemento_NombreEmbebido="";
                        if ($registro["tipo"]=="informe")
                            {
                                $IdentificadorBusqueda=$registro["informe_vinculado"];
                                $RegistroEmbebido=PCO_EjecutarSQL("SELECT titulo FROM ".$TablasCore."informe WHERE id=$IdentificadorBusqueda ")->fetch();
                                $Complemento_NombreEmbebido="<br><i>".$RegistroEmbebido["titulo"]."</i>";
                            }
                        if ($registro["tipo"]=="form_consulta")
                            {
                                $IdentificadorBusqueda=$registro["formulario_vinculado"];
                                $RegistroEmbebido=PCO_EjecutarSQL("SELECT titulo FROM ".$TablasCore."formulario WHERE id=$IdentificadorBusqueda ")->fetch();
                                $Complemento_NombreEmbebido="<br><i>".$RegistroEmbebido["titulo"]."</i>";
                            }
						
						echo '<tr>
                                <td><b>'.$registro["titulo"].'</b> ('.$registro["tipo"].')'.$Complemento_NombreEmbebido.'</td>
								<td><b>'.$registro["campo"].'</b></td>
								<td><b>'.$registro["id_html"].'</b></td>
								<td align=center nowrap>
									<form action="'.$ArchivoCORE.'" method="POST" name="ifoc'.$registro["id"].'" id="ifoc'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
										<input type="hidden" name="PCO_Accion" value="cambiar_estado_campo">
										<input type="hidden" name="id" value="'.$registro["id"].'">
										<input type="hidden" name="tabla" value="formulario_objeto">
										<input type="hidden" name="campo" value="columna">
										<input type="hidden" name="formulario" value="'.$formulario.'">
										<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
										<input type="hidden" name="accion_retorno" value="PCO_EditarFormulario">
										<input type="Hidden" name="popup_activo" value="FormularioDiseno">
								';
								echo '
                                <div class="form-group input-group">
                                
                                <select name="valor" class="form-control form-xs" >';
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
						echo '		</select> 
                                    <span class="input-group-addon"><a href="javascript:ifoc'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmGuardaCol.'"><i class="fa fa-floppy-o"></i></a></span>
                                    </div>
                                    </form>
								</td>
								<td align=center nowrap>
										<form action="'.$ArchivoCORE.'" method="POST" name="ifoce'.$registro["id"].'" id="ifoce'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
											<input type="hidden" name="PCO_Accion" value="cambiar_estado_campo">
											<input type="hidden" name="id" value="'.$registro["id"].'">
											<input type="hidden" name="tabla" value="formulario_objeto">
											<input type="hidden" name="campo" value="peso">
											<input type="hidden" name="formulario" value="'.$formulario.'">
											<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
											<input type="hidden" name="accion_retorno" value="PCO_EditarFormulario">
											<input type="hidden" name="valor" value="'.$peso_aumentado.'">
											<input type="Hidden" name="popup_activo" value="FormularioDiseno">
										</form>
										<form action="'.$ArchivoCORE.'" method="POST" name="ifopa'.$registro["id"].'" id="ifopa'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
											<input type="hidden" name="PCO_Accion" value="cambiar_estado_campo">
											<input type="hidden" name="id" value="'.$registro["id"].'">
											<input type="hidden" name="tabla" value="formulario_objeto">
											<input type="hidden" name="campo" value="peso">
											<input type="hidden" name="formulario" value="'.$formulario.'">
											<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
											<input type="hidden" name="accion_retorno" value="PCO_EditarFormulario">
											<input type="hidden" name="valor" value="'.$peso_disminuido.'">
											<input type="Hidden" name="popup_activo" value="FormularioDiseno">
										</form>
									';
								
								if ($registro["campo"]!="id")
									echo '
										<a href="javascript:ifoce'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmAumentaPeso.'" class="btn btn-success btn-xs"><i class="fa fa-arrow-down"></i></a> 
										'.$registro["peso"].'
										<a href="javascript:ifopa'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmDisminuyePeso.'" class="btn btn-success btn-xs"><i class="fa fa-arrow-up"></i></a>
										';
								
								echo '</td>';
								
								echo '<td align=center>
										<form action="'.$ArchivoCORE.'" method="POST" name="ifo'.$registro["id"].'" id="ifo'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
											<input type="hidden" name="PCO_Accion" value="cambiar_estado_campo">
											<input type="hidden" name="id" value="'.$registro["id"].'">
											<input type="hidden" name="tabla" value="formulario_objeto">
											<input type="hidden" name="campo" value="obligatorio">
											<input type="hidden" name="formulario" value="'.$formulario.'">
											<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
											<input type="hidden" name="accion_retorno" value="PCO_EditarFormulario">	
											<input type="Hidden" name="popup_activo" value="FormularioDiseno">								
											';
									if ($registro["campo"]!="id")
										if ($registro["obligatorio"])
											echo '<input type="hidden" name="valor" value="0"><a href="javascript:ifo'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'" class="btn btn-warning btn-xs"><i class="fa fa-lightbulb-o"></i></a>';
										else
											echo '<input type="hidden" name="valor" value="1"><a href="javascript:ifo'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'" class="btn btn-default btn-xs"><i class="fa fa-lightbulb-o"></i></a>';
								echo '</form></td>';

								echo '<td align=center>
											<form action="'.$ArchivoCORE.'" method="POST" name="if'.$registro["id"].'" id="if'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
												<input type="hidden" name="PCO_Accion" value="cambiar_estado_campo">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="hidden" name="tabla" value="formulario_objeto">
												<input type="hidden" name="campo" value="visible">
												<input type="hidden" name="formulario" value="'.$formulario.'">
												<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
												<input type="hidden" name="accion_retorno" value="PCO_EditarFormulario">
												<input type="Hidden" name="popup_activo" value="FormularioDiseno">
											';
									if ($registro["visible"])
										echo '<input type="hidden" name="valor" value="0"><a href="javascript:if'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'" class="btn btn-warning btn-xs"><i class="fa fa-lightbulb-o"></i></a>';
									else
										echo '<input type="hidden" name="valor" value="1"><a href="javascript:if'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'" class="btn btn-default btn-xs"><i class="fa fa-lightbulb-o"></i></a>';
								echo '</form></td>';
								if ($registro["peso"]!="0")
									{
										echo '<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" name="f'.$registro["id"].'" id="f'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
														<input type="hidden" name="PCO_Accion" value="PCO_EliminarCampoFormulario">
														<input type="hidden" name="campo" value="'.$registro["id"].'">
														<input type="hidden" name="formulario" value="'.$formulario.'">
														<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
			                                            <input type="Hidden" name="popup_activo" value="FormularioDiseno">
                                                        <a href="javascript:confirmar_evento(\''.$MULTILANG_FrmAdvDelCampo.'\',f'.$registro["id"].');" class="btn btn-danger btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Eliminar.'"><i class="fa fa-times"></i></a>
												</form>
										</td>

										<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
														<input type="hidden" name="PCO_Accion" value="PCO_EditarFormulario">
														<input type="hidden" name="campo" value="'.$registro["id"].'">
														<input type="hidden" name="formulario" value="'.$formulario.'">
														<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
														<input type="Hidden" name="popup_activo" value="FormularioCampos">
                                                        <button type="submit" class="btn btn-info btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Editar.'"><i class="fa fa-pencil-square-o"></i></button>
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
				echo '</tbody>
                </table>';			
			?>

    <?php 
        $barra_herramientas_modal='
            <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cancelar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
        PCO_CerrarDialogoModal($barra_herramientas_modal);
    ?>
    <!-- FIN MODAL DISENO DE FORMULARIO -->



    <!-- INICIO MODAL DISENO DE FORMULARIO -->
    <?php PCO_AbrirDialogoModal("myModalDisenoBotones",$MULTILANG_FrmTitComandos,"modal-wide"); ?>
					<table class="table table-hover table-condensed">
						<thead>
                        <tr>
							<td><b><?php echo $MULTILANG_Etiqueta; ?></b></td>
							<td><b><?php echo $MULTILANG_FrmTipoAcc; ?></b></td>
							<td><b><?php echo $MULTILANG_FrmAccUsuario; ?></b></td>
							<td><b><?php echo $MULTILANG_FrmOrden; ?></b></td>
							<td><b><?php echo $MULTILANG_FrmVisible; ?></b></td>
							<td></td>
							<td></td>
						</tr>
                        </thead>
                        <tbody>
			 <?php
				$consulta_botones=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_boton." FROM ".$TablasCore."formulario_boton WHERE formulario='$formulario' ORDER BY peso,id");
				while($registro = $consulta_botones->fetch())
					{
						$peso_aumentado=$registro["peso"]+1;
						if ($registro["peso"]-1>=1) $peso_disminuido=$registro["peso"]-1;
						echo '<tr>
								<td><b>'.$registro["titulo"].'</b></td>
								<td><b>'.$registro["tipo_accion"].'</b></td>
								<td>'.$registro["accion_usuario"].'</td>';
						echo '		<td align=center nowrap>
										<form action="'.$ArchivoCORE.'" method="POST" name="bifoce'.$registro["id"].'" id="bifoce'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
											<input type="hidden" name="PCO_Accion" value="cambiar_estado_campo">
											<input type="hidden" name="id" value="'.$registro["id"].'">
											<input type="hidden" name="tabla" value="formulario_boton">
											<input type="hidden" name="campo" value="peso">
											<input type="hidden" name="formulario" value="'.$formulario.'">
											<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
											<input type="hidden" name="accion_retorno" value="PCO_EditarFormulario">
											<input type="hidden" name="valor" value="'.$peso_aumentado.'">
											<input type="Hidden" name="popup_activo" value="FormularioAcciones">
										</form>
										<form action="'.$ArchivoCORE.'" method="POST" name="bifopa'.$registro["id"].'" id="bifopa'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
											<input type="hidden" name="PCO_Accion" value="cambiar_estado_campo">
											<input type="hidden" name="id" value="'.$registro["id"].'">
											<input type="hidden" name="tabla" value="formulario_boton">
											<input type="hidden" name="campo" value="peso">
											<input type="hidden" name="formulario" value="'.$formulario.'">
											<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
											<input type="hidden" name="accion_retorno" value="PCO_EditarFormulario">
											<input type="hidden" name="valor" value="'.@$peso_disminuido.'">
											<input type="Hidden" name="popup_activo" value="FormularioAcciones">
										</form>
									';

									echo '
										<a href="javascript:bifoce'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmAumentaPeso.'" class="btn btn-success btn-xs"><i class="fa fa-arrow-down"></i></a> 
										'.$registro["peso"].'
										<a href="javascript:bifopa'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmDisminuyePeso.'" class="btn btn-success btn-xs"><i class="fa fa-arrow-up"></i></a> 
										';
								
								echo '</td>';
								
								echo '<td align=center>
											<form action="'.$ArchivoCORE.'" method="POST" name="bif'.$registro["id"].'" id="bif'.$registro["id"].'" >
												<input type="hidden" name="PCO_Accion" value="cambiar_estado_campo">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="hidden" name="tabla" value="formulario_boton">
												<input type="hidden" name="campo" value="visible">
												<input type="hidden" name="formulario" value="'.$formulario.'">
												<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
												<input type="hidden" name="accion_retorno" value="PCO_EditarFormulario">
												<input type="Hidden" name="popup_activo" value="FormularioAcciones">
											';
									if ($registro["visible"])
										echo '<input type="hidden" name="valor" value="0"><a href="javascript:bif'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'" class="btn btn-warning btn-xs"><i class="fa fa-lightbulb-o"></i></a>';
									else
										echo '<input type="hidden" name="valor" value="1"><a href="javascript:bif'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'" class="btn btn-default btn-xs"><i class="fa fa-lightbulb-o"></i></a>';
								echo '</form></td>';
										echo '<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" name="bf'.$registro["id"].'" id="bf'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
														<input type="hidden" name="PCO_Accion" value="PCO_EliminarAccionFormulario">
														<input type="hidden" name="boton" value="'.$registro["id"].'">
														<input type="hidden" name="formulario" value="'.$formulario.'">
														<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
														<input type="Hidden" name="popup_activo" value="FormularioAcciones">
                                                        <a href="javascript:confirmar_evento(\''.$MULTILANG_FrmAdvDelBoton.'\',bf'.$registro["id"].');" class="btn btn-danger btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Eliminar.'"><i class="fa fa-times"></i></a>
												</form>
										</td>';

							echo '</tr>';
					}
				echo '
                    </tbody>
                </table>';
			?>

    <?php 
        $barra_herramientas_modal='
            <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cancelar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
        PCO_CerrarDialogoModal($barra_herramientas_modal);
    ?>
    <!-- FIN MODAL DISENO DE BOTONES -->
        

    <?php
		// Inicia presentacion de ventana de edicion de formulario
		$consulta_form=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id=? ","$formulario");
		$registro_form = $consulta_form->fetch();

        //Barra basica de edicion de contenidos y controles
        $ContenidoBarraFlotante_Herramientas='
            <div align=center style="color:#FFFFFF;"><br>
    			'.$MULTILANG_FrmObjetos.'<br>
                    <a data-toggle="modal" href="#myModalElementoFormulario" title="'.$MULTILANG_FrmDesObjetos.'">
                            <i class="fa fa-th-list fa-3x fa-fw"></i>
                    </a>                
                    <a data-toggle="modal" href="#myModalDisenoFormulario" title="'.$MULTILANG_FrmDesCampos.'">
                            <i class="fa fa-pencil-square-o fa-3x fa-fw"></i>
                    </a>
    			<br>
    			'.$MULTILANG_FrmAcciones.'<br>
                    <a data-toggle="modal" href="#myModalBotonFormulario" title="'.$MULTILANG_FrmDesBoton.'">
                            <i class="fa fa-bolt fa-3x fa-fw"></i>
                    </a>
                    <a data-toggle="modal" href="#myModalDisenoBotones" title="'.$MULTILANG_FrmDesAcciones.'">
                            <i class="fa fa-pencil-square-o fa-3x fa-fw"></i>
                    </a>
    			<br>
    			Menu(s)<br>
                    <a data-toggle="modal" href="javascript:document.PCOFUNC_AdministrarMenu.PCO_FormularioActivoEdicionMenu.value='.$formulario.'; document.PCOFUNC_AdministrarMenu.submit();" title="'.$MULTILANG_Editar.'">
                            <i class="fa fa-bars fa-3x fa-fw"></i>
                    </a>
    			<br>
    			<form action="'.$ArchivoCORE.'" method="POST" name="cancelar"><input type="Hidden" name="PCO_Accion" value="PCO_AdministrarFormularios"></form>
                <button type="button" class="btn btn-danger btn-xs" onclick="document.cancelar.submit()">'.$MULTILANG_FrmVolverLista.'</button>
                <br><br>
                <button class="btn btn-xs btn-warning" onclick="PCOJS_OcultarBarraFlotanteIzquierda();">'.$MULTILANG_Cerrar.' '.$MULTILANG_BarraHtas.'</button>
            </div>';
        //Elimina saltos de linea del contenido para ser asignado directamente al DIV con JQuery
        $ContenidoBarraFlotante_Herramientas=preg_replace("[\n|\r|\n\r]", '', trim($ContenidoBarraFlotante_Herramientas));

        //Formulario de configuracion del formulario
        $ContenidoBarraFlotante_EditForm='
            <div align=center style="color:#FFFFFF;"><hr>
                <b>'.$MULTILANG_FrmDetalles.'</b>

			<form name="datosact" id="datosact" action="'.$ArchivoCORE.'" method="POST">
                <input type="Hidden" name="PCO_Accion" value="PCO_ActualizarFormulario">
                <input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
                <input type="Hidden" name="formulario" value="'.$registro_form["id"].'">';


                //PCO_CargarFormulario($formulario,$en_ventana=1,$PCO_CampoBusquedaBD="",$PCO_ValorBusquedaBD="",$anular_form=0,$modo_diseno_formulario=0)
	            //$ContenidoBarraFlotante_EditForm.=''.PCO_CargarFormulario("-15",0,"","",1,0);


$ContenidoBarraFlotante_EditForm.='
                    <!-- Modal EditorJavascript -->';
                    $ContenidoBarraFlotante_EditForm.=PCO_AbrirDialogoModal("myModalActualizaJAVASCRIPT",$MULTILANG_FrmTitComandos,"modal-wide",0);
                    $ContenidoBarraFlotante_EditForm.='
                        <div class="well" style="color:#000000;">'.$MULTILANG_FrmHlpFunciones.'
                        <textarea name="javascript" id="javascript" data-editor="javascript" class="form-control" style="width: 950px; height: 450px;"></textarea>
                        </div>';
                        $barra_herramientas_modal='
                			<button type="button" class="btn btn-success" onclick="javascript:document.datosact.submit();">'.$MULTILANG_Actualizar.' JS <i class="fa fa-floppy-o"></i></button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
                    $ContenidoBarraFlotante_EditForm.=PCO_CerrarDialogoModal($barra_herramientas_modal,0);
        
        //Define el estilo activo de la ventana
        if($registro_form["estilo_ventana"]=="panel") $SeleccionEstilo1="SELECTED";
        if($registro_form["estilo_ventana"]=="panel-default") $SeleccionEstilo2="SELECTED";
        if($registro_form["estilo_ventana"]=="panel-primary") $SeleccionEstilo3="SELECTED";
        if($registro_form["estilo_ventana"]=="panel-success") $SeleccionEstilo4="SELECTED";
        if($registro_form["estilo_ventana"]=="panel-info") $SeleccionEstilo5="SELECTED";
        if($registro_form["estilo_ventana"]=="panel-warning") $SeleccionEstilo6="SELECTED";
        if($registro_form["estilo_ventana"]=="panel-danger") $SeleccionEstilo7="SELECTED";
        
        $ContenidoBarraFlotante_EditForm.='
                    <!-- Fin Modal EditorJavascript -->


				<table class="table table-condensed table-unbordered" style="color:#FFFFFF; font-size:12px;">
					<tr>
						<td>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-magic fa-fw"></i> </span>
                                <input name="titulo" value="'.$registro_form["titulo"].'" type="text" class="form-control input-sm" placeholder="'.$MULTILANG_FrmTitVen.'">
                                <span class="input-group-addon">
                                    <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_TitObligatorio.'"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
                                    <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_FrmDesTit.': '.$MULTILANG_TblDesNombre.'"><i class="fa fa-question-circle fa-fw "></i></a>
                                </span>
                            </div>
                        </td>
					</tr>
					<tr>
						<td>
                            <div class="form-group input-group">
                                <input name="ayuda_titulo" value="'.$registro_form["ayuda_titulo"].'" type="text" class="form-control input-sm" placeholder="'.$MULTILANG_FrmHlp.'">
                                <span class="input-group-addon">
                                    <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_FrmDesHlp.': '.$MULTILANG_TblDesNombre.'"><i class="fa fa-question-circle fa-fw "></i></a>
                                </span>
                            </div>
						</td>
					</tr>
					<tr>
						<td valign="top">
                            <div class="form-group input-group">
                                <textarea name="ayuda_texto"  class="form-control input-sm" placeholder="'.$MULTILANG_FrmTxt.'" rows="3">'.$registro_form["ayuda_texto"].'</textarea>
                                <span class="input-group-addon">
                                    <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_FrmDesTxt.': '.$MULTILANG_TblDesNombre.'"><i class="fa fa-question-circle  fa-fw "></i></a>
                                </span>
                            </div>
						</td>
					</tr>
					<tr>
						<td valign="top" align=center>
							<label for="estilo_ventana">'.$MULTILANG_FrmEstilo.':</label>
							<div class="form-group input-group">
								<select id="estilo_ventana" name="estilo_ventana" class="form-control">
									<option value="panel"          '.$SeleccionEstilo1.'     >'.$MULTILANG_Ninguno.'</option>
									<option value="panel-default"  '.$SeleccionEstilo2.'     >'.$MULTILANG_BtnEstiloPredeterminado.'</option>
									<option value="panel-primary"  '.$SeleccionEstilo3.'     >'.$MULTILANG_BtnEstiloPrimario.'</option>
									<option value="panel-success"  '.$SeleccionEstilo4.'     >'.$MULTILANG_BtnEstiloFinalizado.'</option>
									<option value="panel-info"     '.$SeleccionEstilo5.'     >'.$MULTILANG_BtnEstiloInformacion.'</option>
									<option value="panel-warning"  '.$SeleccionEstilo6.'     >'.$MULTILANG_BtnEstiloAdvertencia.'</option>
									<option value="panel-danger"   '.$SeleccionEstilo7.'     >'.$MULTILANG_BtnEstiloPeligro.'</option>
								</select>
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="Estilo grafico para el borde de la ventana<br><br>Graphic style for window border"><i class="fa fa-info-circle  fa-fw"></i></a>
                                </span>
							</div>
						</td>
					</tr>
					<tr>
						<td valign="top">
                            <div class="form-group input-group">
                                <input name="id_html" value="'.$registro_form["id_html"].'" type="text" class="form-control" placeholder="ID HTML">
                                <span class="input-group-addon">
                                    <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_FrmIdHTML.'"><i class="fa fa-question-circle fa-fw "></i></a>
                                    <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_TitObligatorio.'"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
                                    <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_FrmNombreHTML.'"><i class="fa fa-exclamation-triangle icon-red  fa-fw "></i></a>
                                </span>
                            </div>
						</td>
					</tr>
					<tr>
						<td align=center>
                            <label for="tabla_datos">'.$MULTILANG_TablaDatos.':</label>
                            <div class="form-group input-group">
                                <select  id="tabla_datos" name="tabla_datos"  class="form-control" >
								<option value="">'.$MULTILANG_SeleccioneUno.'</option>';

										//Asumimos que la tabla es manual
										$es_tabla_manual=1;
										//Recorre las tablas definidas
										$resultado=PCO_ConsultarTablas();
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
														$ContenidoBarraFlotante_EditForm.='<option value="'.$registro[0].'" '.$estado_seleccion_tabla.'>'.str_replace($TablasApp,'',$registro[0]).'</option>';
													}
											}		
        $ContenidoBarraFlotante_EditForm.='
                                </select>
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_TitObligatorio.'"><i class="fa fa-exclamation-triangle  fa-fw icon-orange"></i></a>
                                </span>
                            </div>
                            <input type="text" name="tabla_datos_manual"  value="';
                            if($es_tabla_manual==1) $ContenidoBarraFlotante_EditForm.= $registro_form["tabla_datos"];
        $ContenidoBarraFlotante_EditForm.='" class="form-control" placeholder="'.$MULTILANG_InfTablaManual.'">
						</td>
					</tr>
					<tr>
						<td align=center>
                            <label for="columnas">'.$MULTILANG_FrmNumeroCols.':</label>
                            <div class="form-group input-group">
                                <select id="columnas" name="columnas" class="form-control">';
                                        for ($i=1;$i<=12;$i++)
                                            {
                                                $estado_seleccion_cols="";
                                                if ($i==$registro_form["columnas"])
                                                    $estado_seleccion_cols="SELECTED";
                                                $ContenidoBarraFlotante_EditForm.='<option value="'.$i.'" '.$estado_seleccion_cols.'>'.$i.'</option>';
                                            }
        $ContenidoBarraFlotante_EditForm.='
                                </select>
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_FrmDesNumeroCols.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                </span>
                            </div>
						</td>
					</tr>
					<tr>
						<td align=center>
                            <label for="tipo_maquetacion">'.$MULTILANG_FrmTipoMaquetacion.':</label>
                            <div class="form-group input-group">
                                <select id="tipo_maquetacion" name="tipo_maquetacion" class="form-control">';
                                    $ContenidoBarraFlotante_EditForm.='<option value="tradicional">'.$MULTILANG_FrmTradicional.'</option>';

                                    $estado_seleccion_cols="";
                                    if ($registro_form["tipo_maquetacion"]=="responsive")
                                        $estado_seleccion_cols="SELECTED";
                                    $ContenidoBarraFlotante_EditForm.='<option value="responsive" '.$estado_seleccion_cols.'>Responsive</option>';
        $ContenidoBarraFlotante_EditForm.='
                                </select>
                                <span class="input-group-addon">
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_FrmTipoMaquetacionDes.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                </span>
                            </div>
						</td>
					</tr>
					<tr>
						<td valign="top">
                            <label for="css_columnas">Clases CSS de columnas:</label>
                            <div class="form-group input-group">
                                <textarea name="css_columnas"  class="form-control input-sm" placeholder="Clases CSS o anchos para columnas separados por pipes. Ej: col-xs-2 col-sm-4 col-md-12 col-lg-6 | col-xs-6 col-sm-6 col-md-6 col-lg-6" rows="3">'.$registro_form["css_columnas"].'</textarea>
                                <span class="input-group-addon">
                                    <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="Para maquetacion tipo responsive no sólo puede incluir clases de columna, también puede aplicar clases con estilos gráficos.  Para maquetaciones tipo tabla puede indicar anchos de columna.  En todo caso, si el número de clases indicado es menor al número de columnas del formulario se aplicarán en orden y se tomará el último para aplicar a las columnas restantes."><i class="fa fa-question-circle  fa-fw "></i></a>
                                </span>
                            </div>
						</td>
					</tr>
					<tr>
						<td align=center>
							<label for="borde_visible">'.$MULTILANG_FrmBordesVisibles.':</label>
                            <select id="borde_visible" name="borde_visible" class="form-control">
								<option value="0" ';
								if ($registro_form["borde_visible"]==0) $ContenidoBarraFlotante_EditForm.=' SELECTED ';
        $ContenidoBarraFlotante_EditForm.='>'.$MULTILANG_No.'</option>
								<option value="1" ';
								if ($registro_form["borde_visible"]==1) $ContenidoBarraFlotante_EditForm.=' SELECTED ';
		$ContenidoBarraFlotante_EditForm.='>'.$MULTILANG_Si.'</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align=center>
							<label for="estilo_pestanas">'.$MULTILANG_FrmEstiloPestanas.':</label>
                            <select id="estilo_pestanas" name="estilo_pestanas" class="form-control">
								<option value="nav-tabs" ';
								if ($registro_form["estilo_pestanas"]=="nav-tabs") $ContenidoBarraFlotante_EditForm.=' SELECTED ';
		$ContenidoBarraFlotante_EditForm.='>'.$MULTILANG_FrmEstiloTabs.'</option>
								<option value="nav-pills" ';
								if ($registro_form["estilo_pestanas"]=="nav-pills") $ContenidoBarraFlotante_EditForm.=' SELECTED ';
		$ContenidoBarraFlotante_EditForm.='>'.$MULTILANG_FrmEstiloPills.'</option>
								<option value="" ';
								if ($registro_form["estilo_pestanas"]=="") $ContenidoBarraFlotante_EditForm.=' SELECTED ';
		$ContenidoBarraFlotante_EditForm.='>'.$MULTILANG_FrmEstiloOculto.'</option>
							</select>
						</td>
					</tr>
				</table>
            </form>
            <a class="btn btn-success btn-xs" href="javascript:document.datosact.submit();"><i class="fa fa-floppy-o"></i> '.$MULTILANG_Actualizar.' '.$MULTILANG_Formularios.'</a>

            </div>';
        //Elimina saltos de linea del contenido para ser asignado directamente al DIV con JQuery
        $ContenidoBarraFlotante_EditForm=preg_replace("[\n|\r|\n\r]", '', trim($ContenidoBarraFlotante_EditForm));
    ?>

    <textarea name="ghost_javascript" id="ghost_javascript" style="width: 0px; height: 0px; display:none; visibility:hidden;"><?php echo $registro_form["javascript"]; ?></textarea>
	<script language="JavaScript">
	    //Asigna contenidos generados a la barra flotante
		$('#PCODIV_SeccionLateralFlotanteUsoInterno').html('<?php echo htmlspecialchars_decode($ContenidoBarraFlotante_Herramientas); ?>');
		$('#PCODIV_SeccionLateralFlotanteUsoInterno').append('<?php echo htmlspecialchars_decode($ContenidoBarraFlotante_EditForm); ?>');
		//Reasigna valor de script desde la variable inicial de carga
		document.datosact.javascript.value=ghost_javascript.value;
	</script>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <?php
                //Busca posibles campos huerfanos para presentar advertencia si aplica
                $MensajeCamposHuerfanos='';
                $CantidadColumnasDiseno=$registro_form["columnas"];
                $ConsultaCamposHuerfanos=PCO_EjecutarSQL("SELECT id,$ListaCamposSinID_formulario_objeto FROM ".$TablasCore."formulario_objeto WHERE formulario=$formulario AND (columna>$CantidadColumnasDiseno OR columna<1) ");
                while ($RegistroCamposHuerfanos=$ConsultaCamposHuerfanos->fetch())
                    $MensajeCamposHuerfanos.='<li style="padding-left: 50px;">ID:<b>'.$RegistroCamposHuerfanos["id"].'</b>&nbsp;&nbsp;&nbsp; '.$MULTILANG_Titulo.':<b>'.$RegistroCamposHuerfanos["titulo"].'</b>&nbsp;&nbsp;&nbsp; Campo:<b>'.$RegistroCamposHuerfanos["campo"].'</b>&nbsp;&nbsp;&nbsp; ID_HTML:<b>'.$RegistroCamposHuerfanos["id_html"].'</b>&nbsp;&nbsp;&nbsp; '.$MULTILANG_Columna.':<b>'.$RegistroCamposHuerfanos["columna"].'</b>&nbsp;&nbsp;&nbsp; '.$MULTILANG_Pestana.':<b>'.$RegistroCamposHuerfanos["pestana_objeto"].'</b></li>';
                if ($MensajeCamposHuerfanos!='')
                    PCO_Mensaje($MULTILANG_FrmHuerfanos,"$MULTILANG_FrmCamposAProposito $MensajeCamposHuerfanos","","fa fa-fw fa-2x fa-info-circle","alert alert-dismissible alert-warning btn-xs");

                //Busca posibles campos con nombre o IDHTML duplicado para presentar advertencia si aplica
                $MensajeCamposDuplicados='';
                $ConsultaCamposDuplicadosIDHTML=PCO_EjecutarSQL("SELECT * FROM (SELECT COUNT(*) AS ConteoDuplicados, id,$ListaCamposSinID_formulario_objeto FROM ".$TablasCore."formulario_objeto WHERE id_html<>'' AND formulario=$formulario GROUP BY id_html UNION ALL SELECT COUNT(*) AS ConteoDuplicados, id,$ListaCamposSinID_formulario_objeto FROM ".$TablasCore."formulario_objeto WHERE campo<>'' AND formulario=$formulario GROUP BY campo) as UnionRegistros");
                while ($RegistroCamposDuplicados=$ConsultaCamposDuplicadosIDHTML->fetch())
                    if ($RegistroCamposDuplicados["ConteoDuplicados"]>1) $MensajeCamposDuplicados.='<li style="padding-left: 50px;">ID:<b>'.$RegistroCamposDuplicados["id"].'</b>&nbsp;&nbsp;&nbsp; '.$MULTILANG_Titulo.':<b>'.$RegistroCamposDuplicados["titulo"].'</b>&nbsp;&nbsp;&nbsp; Campo:<b>'.$RegistroCamposDuplicados["campo"].'</b>&nbsp;&nbsp;&nbsp; ID_HTML:<b>'.$RegistroCamposDuplicados["id_html"].'</b>&nbsp;&nbsp;&nbsp; '.$MULTILANG_Columna.':<b>'.$RegistroCamposDuplicados["columna"].'</b>&nbsp;&nbsp;&nbsp; '.$MULTILANG_Pestana.':<b>'.$RegistroCamposDuplicados["pestana_objeto"].'</b></li>';

                if ($MensajeCamposDuplicados!='')
                    PCO_Mensaje($MULTILANG_FrmIDHTMDuplicado,"$MULTILANG_FrmCamposAProposito $MensajeCamposDuplicados","","fa fa-fw fa-2x fa-info-circle","alert alert-dismissible alert-warning btn-xs");

                //Busca posibles campos en la tabla que no han sido agregados al formulario para presentarlos como advertencia
        		$CamposTabla=PCO_ConsultarColumnas($registro_form["tabla_datos"]);
        
        		//Busca por cada campo de tabla algun equivalente en las columnas
        		$MensajeCamposdeTablaHuerfanos='';
        		for($i=0;$i<count($CamposTabla);$i++)
        			{
        			    //Evita el campo de ID
        			    if ($CamposTabla[$i]["nombre"]!="id")
        			        {
        			            //Busca si el campo esta definido dentro de alguno de los campos del form
        			            $ConsultaCamposEnForm=PCO_EjecutarSQL("SELECT id FROM ".$TablasCore."formulario_objeto WHERE formulario='".$registro_form["id"]."' AND campo='".$CamposTabla[$i]["nombre"]."' ")->fetch();
                                if ($ConsultaCamposEnForm["id"]=="")
                                    {
                                        //Busca posibles formularios embebidos y sus campos
        			                    $ConsultaSubformularios=PCO_EjecutarSQL("SELECT formulario_vinculado as id FROM ".$TablasCore."formulario_objeto WHERE formulario='".$registro_form["id"]."' AND tipo='form_consulta' ");
                                        while ($RegistroSubformularios=$ConsultaSubformularios->fetch())
                                            {
        			                            $ConsultaCamposEnFormEmbebido=PCO_EjecutarSQL("SELECT id FROM ".$TablasCore."formulario_objeto WHERE formulario='".$RegistroSubformularios["id"]."' AND campo='".$CamposTabla[$i]["nombre"]."' ")->fetch();
                                                if ($ConsultaCamposEnFormEmbebido["id"]=="")
                                                    $MensajeCamposdeTablaHuerfanos.='<li style="padding-left: 50px;">Campo en tabla '.$registro_form["tabla_datos"].': <b>'.$CamposTabla[$i]["nombre"].'</b></li>';
                                            }
                                    }
        			        }
        			}

                if ($MensajeCamposdeTablaHuerfanos!='')
                    PCO_Mensaje($MULTILANG_FrmCampoHuerfano,"$MensajeCamposdeTablaHuerfanos","","fa fa-fw fa-2x fa-info-circle","alert alert-dismissible alert-info btn-xs");

            	//function PCO_CargarFormulario($formulario,$en_ventana=1,$PCO_CampoBusquedaBD="",$PCO_ValorBusquedaBD="",$anular_form=0,$modo_diseno=0)
                PCO_CargarFormulario($formulario,1,"","",0,1); //Cargar el form en modo de diseno
            ?>
        </div>
    </div>

<?php
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_EliminarFormulario
	Alias de paso para PCO_EliminarFormulario

	Variables de entrada:

		formulario - ID unico de identificacion del formulario a eliminar

	Salida:
		Registro eliminado

	Ver tambien:
		<PCO_AdministrarFormularios>
*/
	if ($PCO_Accion=="PCO_EliminarFormulario")
		{
	        if ($formulario=="") $formulario=$PCO_Valor; //Reasignacion de valor para modelo dinamico de practico
			PCO_EliminarFormulario($formulario);
			echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="PCO_Accion" value="PCO_AdministrarFormularios"></form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_EliminarEventoObjeto
	Elimina el script asociado a un evento javascript de un control de formulario

	Salida:
		Elimina un evento asociado a un objeto
*/
	if ($PCO_Accion=="PCO_EliminarEventoObjeto")
		{
			PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."evento_objeto WHERE id=? ","$evento");
			PCO_Auditar("Elimina evento javascript $evento");
			echo '<script TYPE="text/javascript" LANGUAGE="JavaScript">
    			alert("'.$MULTILANG_Eliminar.' '.$MULTILANG_Evento.' '.$MULTILANG_Finalizado.'");
    			window.close();
			</script>';
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_ActualizarJavaEvento
	Actualiza el script asociado a un evento javascript de un control de formulario

	Salida:
		Registro de evento creado o actualizado
*/
	if ($PCO_Accion=="PCO_ActualizarJavaEvento")
		{
			//Busca si ya existe un evento del mismo tipo para ese objeto
			$registro_evento_previo=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."evento_objeto WHERE objeto=? AND evento=? ","$id_objeto_evento$_SeparadorCampos_$evento_objeto")->fetch();
			if ($registro_evento_previo["id"]=="")
			    {
					PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."evento_objeto (".$ListaCamposSinID_evento_objeto.") VALUES (?,?,?)","$id_objeto_evento$_SeparadorCampos_$evento_objeto$_SeparadorCampos_$javascript_eventos");
					PCO_Auditar("Agrega evento javascript para $id_objeto_evento");
			    }
			else
			    {
					PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."evento_objeto SET javascript=? WHERE objeto=? AND evento=? ","$javascript_eventos$_SeparadorCampos_$id_objeto_evento$_SeparadorCampos_$evento_objeto");
					PCO_Auditar("Actualiza evento javascript para $id_objeto_evento");
			    }
			die();
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_ActualizarFormulario
	Actualiza los datos basicos de un formulario

	Salida:
		Registro de formulario actualizado

	Ver tambien:
		<PCO_AdministrarFormularios>
*/
	if ($PCO_Accion=="PCO_ActualizarFormulario")
		{
			$mensaje_error="";
			if ($titulo=="") $mensaje_error.=$MULTILANG_FrmErr1.'<br>';
			$tabla_datos.=$tabla_datos_manual;
			if ($tabla_datos=="") $mensaje_error.=$MULTILANG_FrmErr2.'<br>';

			if ($mensaje_error=="")
				{
					PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."formulario SET estilo_ventana=?,titulo=?,ayuda_titulo=?,ayuda_texto=?,tabla_datos=?,columnas=?,javascript=?,borde_visible=?,estilo_pestanas=?,id_html=?,tipo_maquetacion=?,css_columnas=? WHERE id= ? ","$estilo_ventana$_SeparadorCampos_$titulo$_SeparadorCampos_$ayuda_titulo$_SeparadorCampos_$ayuda_texto$_SeparadorCampos_$tabla_datos$_SeparadorCampos_$columnas$_SeparadorCampos_$javascript$_SeparadorCampos_$borde_visible$_SeparadorCampos_$estilo_pestanas$_SeparadorCampos_$id_html$_SeparadorCampos_$tipo_maquetacion$_SeparadorCampos_$css_columnas$_SeparadorCampos_$formulario");
					PCO_Auditar("Actualiza formulario $formulario para $tabla_datos");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="nombre_tabla" value="'.$tabla_datos.'">
					<input type="Hidden" name="PCO_Accion" value="PCO_EditarFormulario">
					<input type="Hidden" name="popup_activo" value="">
					<input type="Hidden" name="formulario" value="'.$formulario.'"></form>
								<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_AdministrarFormularios">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
					    <input type="Hidden" name="popup_activo" value="">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_GuardarFormulario
	Agrega un formulario vacio para la aplicacion

	(start code)
		INSERT INTO ".$TablasCore."formulario VALUES (0, '$titulo','$ayuda_titulo','$ayuda_texto','$color_fondo','$tabla_datos','$columnas')
	(end)

	Salida:
		Registro agregado y paso a las ventanas de edicion de formulario para agregar los elementos internos

	Ver tambien:
		<PCO_AdministrarFormularios>
*/
	if ($PCO_Accion=="PCO_GuardarFormulario")
		{
			$mensaje_error="";
			if ($titulo=="") $mensaje_error.=$MULTILANG_FrmErr1.'<br>';
			$tabla_datos.=$tabla_datos_manual;
			if ($tabla_datos=="") $mensaje_error.=$MULTILANG_FrmErr2.'<br>';
			//escapa cadenas antes de ser enviadas a consulta
			//$javascript=$ConexionPDO->quote($javascript);

			if ($mensaje_error=="")
				{
				    $estilo_ventana='panel-primary';
					PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."formulario (".$ListaCamposSinID_formulario.") VALUES (?,?,?,?,?,?,?,?,?,?,?,?)","$titulo$_SeparadorCampos_$ayuda_titulo$_SeparadorCampos_$ayuda_texto$_SeparadorCampos_$tabla_datos$_SeparadorCampos_$columnas$_SeparadorCampos_$javascript$_SeparadorCampos_$borde_visible$_SeparadorCampos_$estilo_pestanas$_SeparadorCampos_$id_html$_SeparadorCampos_$tipo_maquetacion$_SeparadorCampos_$css_columnas$_SeparadorCampos_$estilo_ventana");
					$id=PCO_ObtenerUltimoIDInsertado($ConexionPDO);
					PCO_Auditar("Crea formulario $id para $tabla_datos");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="nombre_tabla" value="'.$tabla_datos.'">
					<input type="Hidden" name="PCO_Accion" value="PCO_EditarFormulario">
					<input type="Hidden" name="popup_activo" value="">
					<input type="Hidden" name="formulario" value="'.$id.'"></form>
								<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_AdministrarFormularios">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						<input type="Hidden" name="popup_activo" value="">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_CopiarFormulario
	Agrega un formulario a partir de otro para la aplicacion

	Salida:
		Archivo con el elemento exportado

	Ver tambien:
		<PCO_AdministrarFormularios>
*/
	if ($PCO_Accion=="PCO_CopiarFormulario")
		{
				//Presenta la ventana con informacion y enlace de descarga
				PCO_AbrirVentana($MULTILANG_FrmTipoCopiaExporta, 'panel-primary'); ?>
					<div align=center>
					<?php
				        echo $MULTILANG_FrmCopiaFinalizada."<hr>"; 
                        PCO_ExportarXMLFormulario($formulario,$tipo_copia_objeto);
					?>
					</div>
				<?php
				PCO_CerrarVentana();
				?>
    			<div align=center>
    			<br><br>
    			<a class="btn btn-default" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-home"></i> <?php echo $MULTILANG_IrEscritorio; ?></a>
    			</div>
		    <?php
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_DefinirCopiaFormularios
	Presenta opciones para generar una copia del formulario seleccionado usando diferentes formatos
*/
if ($PCO_Accion=="PCO_DefinirCopiaFormularios")
	{
	    if ($formulario=="") $formulario=$PCO_Valor; //Reasignacion de valor para modelo dinamico de practico
		 ?>

        <form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="PCO_Accion" value="PCO_CopiarFormulario">
			<input type="Hidden" name="formulario" value="<?php echo $formulario; ?>">

            <br>
			<?php PCO_AbrirVentana($MULTILANG_FrmTipoObjeto, 'panel-primary'); ?>
			<h4><?php echo $MULTILANG_FrmTipoCopiaExporta; ?>: <b><?php echo $titulo_formulario; ?></b> (ID=<?php echo $formulario; ?>)</h4>
            <label for="tipo_copia_objeto"><?php echo $MULTILANG_FrmTipoCopia; ?>:</label>
            <select id="tipo_copia_objeto" name="tipo_copia_objeto" class="form-control btn-warning" >
                <option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
                <option value="EnLinea"><?php echo $MULTILANG_FrmTipoCopia1; ?></option>
                <option value="XML_IdEstatico"><?php echo $MULTILANG_FrmTipoCopia2; ?></option>
                <option value="XML_IdDinamico"><?php echo $MULTILANG_FrmTipoCopia3; ?></option>
            </select>
			<hr>
			<b><?php echo $MULTILANG_Ayuda; ?></b><br>
			<li><?php echo $MULTILANG_FrmTipoCopiaDes1; ?></li>
			<li><?php echo $MULTILANG_FrmTipoCopiaDes2; ?></li>
			<li><?php echo $MULTILANG_FrmTipoCopiaDes3; ?></li>
            </form>
            <br>
            <div align=center>
            <a class="btn btn-success" href="javascript:document.datos.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_FrmCopiar; ?></a>
            <a class="btn btn-default" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-home"></i> <?php echo $MULTILANG_IrEscritorio; ?></a>
            </div>

		<?php
		PCO_CerrarVentana();
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_ConfirmarImportacionFormulario
	Lee el archivo cargado sobre /tmp y regenera el objeto alli existente

	Variables de entrada:

		archivo_cargado - Ruta absoluta hacia el archivo analizado en el paso anterior del asistente

	Salida:
		Objetos generados a partir de la definicion del archivo
*/
if ($PCO_Accion=="PCO_ConfirmarImportacionFormulario")
	{
		echo "<br>";
		$mensaje_error="";
		PCO_AbrirVentana($MULTILANG_FrmImportar.' <b>'.$archivo_cargado.'</b>', 'panel-info');
		if ($archivo_cargado=="")
			$mensaje_error=$MULTILANG_ErrorTiempoEjecucion;
		else
			{
                //Carga el archivo en una cadena
                $cadena_xml_importado = file_get_contents($archivo_cargado);
				// Usa SimpleXML Directamente para interpretar respuesta
				$xml_importado = @simplexml_load_string($cadena_xml_importado);
			}
		if ($xml_importado->descripcion[0]->version_practico!=$PCO_VersionActual) $mensaje_error=$MULTILANG_ActErrGral;

		if ($mensaje_error=="")
			{
			    $ResultadoImportacion=PCO_ImportarXMLFormulario($cadena_xml_importado);
				echo '
				<b>'.$MULTILANG_FrmImportarGenerado.':</b><br>
				<li>ID: '.$ResultadoImportacion.'</li>
				<li>Titulo: '.base64_decode($xml_importado->core_formulario[0]->titulo).'</li>
				<br>
				<a class="btn btn-block btn-success" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-thumbs-up"></i> '.$MULTILANG_Finalizado.'</a>';
				PCO_Auditar("Importa $archivo_cargado en objeto $idObjetoInsertado");
			}
		else
			{
				echo '			
				<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="PCO_VerMenu">
					<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ActErrGral.'">
					<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
		echo '</center>';

		PCO_CerrarVentana();
        $VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_AnalizarImportacionFormulario
	Revisa el archivo cargado sobre /tmp para validar si se trata de un objeto definido correctamente

	Variables de entrada:

		archivo_cargado - Ruta absoluta hacia el archivo cargado en el paso anterior del asistente

	Salida:
		Analisis del archivo y detalles del objeto
*/
if ($PCO_Accion=="PCO_AnalizarImportacionFormulario")
	{
		echo "<br>";
		PCO_AbrirVentana($MULTILANG_FrmImportar.' <b>'.$archivo_cargado.'</b>', 'panel-info');

		if ($mensaje_error=="")
			{
                $existen_conflictos_entre_ids=0;
                //Carga el archivo en una cadena
                $cadena_xml_importado = file_get_contents($archivo_cargado);
				// Usa SimpleXML Directamente para interpretar respuesta
				$xml_importado = @simplexml_load_string($cadena_xml_importado);

                //Presenta alerta cuando encuentra otro elemento con el mismo ID y se trata de una importacion estatica
                if ($xml_importado->descripcion[0]->tipo_exportacion=="XML_IdEstatico")
					if (PCO_ExisteValor($TablasCore."formulario","id",base64_decode($xml_importado->core_formulario[0]->id)))
						PCO_Mensaje($MULTILANG_Atencion, $MULTILANG_FrmImportarAlerta, '', 'fa fa-fw fa-2x fa-warning', 'alert alert-dismissible alert-danger');
                
                //Presenta contenido del archivo
                echo "<b>$MULTILANG_Detalles $MULTILANG_Archivo</b>:<br>
					<li> <u>$MULTILANG_Version (Practico)</u>: {$xml_importado->descripcion[0]->version_practico}<br>
					<li> <u>$MULTILANG_Tipo $MULTILANG_Archivo</u>: ";
				if ($xml_importado->descripcion[0]->tipo_exportacion=="XML_IdEstatico") echo $MULTILANG_FrmTipoCopiaDes2;
				else echo $MULTILANG_FrmTipoCopiaDes3;

				echo "<br>
					<li> <u>$MULTILANG_Aplicacion</u>: {$xml_importado->descripcion[0]->sistema_origen} {$xml_importado->descripcion[0]->version}<br>
					<li> <u>$MULTILANG_GeneradoPor</u>: {$xml_importado->descripcion[0]->usuario_generador} ({$xml_importado->descripcion[0]->fecha_exportacion} {$xml_importado->descripcion[0]->hora_exportacion})<hr>
					<b>$MULTILANG_Detalles $MULTILANG_Objeto</b>:<br>
					<li> $MULTILANG_Tipo: {$xml_importado->descripcion[0]->tipo_objeto}<br>
					<li> $MULTILANG_Titulo: ".base64_decode($xml_importado->core_formulario[0]->titulo)."<br>
					<li> ID: ".base64_decode($xml_importado->core_formulario[0]->id)."<br>
                <hr>";
                
				//Recorre los core_formulario_objeto
				echo '<div class="btn btn-block btn-primary">'.$MULTILANG_FrmDesCampos.'</div><ul class="list-group">';
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_formulario_objeto[0]->cantidad_objetos;$PCO_i++)
					echo '<a class="list-group-item">
						<span class="badge">ID '.$MULTILANG_Objeto.': '.base64_decode($xml_importado->core_formulario_objeto[$PCO_i]->id).'</span>
						<b>'.base64_decode($xml_importado->core_formulario_objeto[$PCO_i]->titulo).'</b><i>
						&nbsp;&nbsp;&nbsp;<u>'.$MULTILANG_Tipo.'</u>: '.base64_decode($xml_importado->core_formulario_objeto[$PCO_i]->tipo).'
						&nbsp;&nbsp;&nbsp;<u>'.$MULTILANG_Campo.'</u>: '.base64_decode($xml_importado->core_formulario_objeto[$PCO_i]->campo).'
						</i></a>';
				echo '</ul>';

				//Recorre los core_evento_objeto
				echo '<div class="btn btn-block btn-primary">'.$MULTILANG_EventosTit.'</div><ul class="list-group">';
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_evento_objeto[0]->cantidad_objetos;$PCO_i++)
					echo '<a class="list-group-item">
						<span class="badge">ID '.$MULTILANG_Evento.': '.base64_decode($xml_importado->core_evento_objeto[$PCO_i]->id).'</span>
						<b>'.$MULTILANG_Objeto.' '.base64_decode($xml_importado->core_evento_objeto[$PCO_i]->objeto).'</b><i>
						&nbsp;&nbsp;&nbsp;<u>'.$MULTILANG_Evento.'</u>: '.base64_decode($xml_importado->core_evento_objeto[$PCO_i]->evento).'
						</i></a>';
				echo '</ul>';

				//Recorre los core_formulario_boton
				echo '<div class="btn btn-block btn-primary">'.$MULTILANG_FrmAcciones.'</div><ul class="list-group">';
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_formulario_boton[0]->cantidad_objetos;$PCO_i++)
					echo '<a class="list-group-item">
						<span class="badge">ID '.$MULTILANG_Objeto.': '.base64_decode($xml_importado->core_formulario_boton[$PCO_i]->id).'</span>
						<b>'.base64_decode($xml_importado->core_formulario_boton[$PCO_i]->titulo).'</b><i>
						&nbsp;&nbsp;&nbsp;<u>'.$MULTILANG_FrmTipoAcc.'</u>: '.base64_decode($xml_importado->core_formulario_boton[$PCO_i]->tipo_accion).'
						&nbsp;&nbsp;&nbsp;<u>'.$MULTILANG_FrmAccUsuario.'</u>: '.base64_decode($xml_importado->core_formulario_boton[$PCO_i]->accion_usuario).'
						</i></a>';
				echo '</ul>';

				//Recorre los core_menu
				echo '<div class="btn btn-block btn-primary">'.$MULTILANG_OpcionesMenu.'</div><ul class="list-group">';
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_menu[0]->cantidad_objetos;$PCO_i++)
					echo '<a class="list-group-item">
						<span class="badge">ID '.$MULTILANG_Objeto.': '.base64_decode($xml_importado->core_menu[$PCO_i]->id).'</span>
						<b>'.base64_decode($xml_importado->core_menu[$PCO_i]->texto).'</b><i>
						</i></a>';
				echo '</ul>';

                echo "<br><hr>";
                //Agrega el boton de continuar solamente si no hay conflictos entre IDs
                if ($existen_conflictos_entre_ids==0)
                    echo '
                    <form name="goahead" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_ConfirmarImportacionFormulario">
						<input type="Hidden" name="archivo_cargado" value="'.$archivo_cargado.'">
                        <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-warning texto-blink icon-yellow"></i> '.$MULTILANG_Importar.' <i class="fa fa-warning texto-blink icon-yellow"></i></button>
					</form>';
                else
                    PCO_Mensaje('<i class="fa fa-warning fa-2x text-red texto-blink"></i> '.$MULTILANG_Error, $MULTILANG_FrmImportarConflicto, '', '', 'alert alert-danger alert-dismissible');
			}
		else
			{
				echo '			
				<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="PCO_VerMenu">
					<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ActErrGral.'">
					<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
		echo '</center>';
		echo '<br><a class="btn btn-default btn-block" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-home"></i> '.$MULTILANG_Cancelar.'</a>';

		PCO_CerrarVentana();
        $VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_ImportarFormulario
	Presenta el paso 1 de importacion de formularios
*/
if ($PCO_Accion=="PCO_ImportarFormulario")
	{
		echo "<br>";
		PCO_AbrirVentana($NombreRAD.' - '.$MULTILANG_FrmImportar,'panel-info');
?>

    <ul class="nav nav-tabs nav-justified">
    <li class="active"><a href="#pestana_importacion" data-toggle="tab"><i class="fa fa-cloud-upload"></i> <?php echo $MULTILANG_Cargar; ?> XML</a></li>
    <li><a href="#historico_importaciones" data-toggle="tab"><i class="fa fa-history"></i> <?php echo $MULTILANG_Historico; ?></a></li>
    </ul>

    <div class="tab-content">
        
        <!-- INICIO TAB IMPORTACION -->
        <div class="tab-pane fadein active" id="pestana_importacion">
            <br>
            <div align="center">
                        <form action="<?php echo $ArchivoCORE; ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="extension_archivo" value=".xml">
                            <input type="hidden" name="MAX_FILE_SIZE" value="8192000">
                            <input type="Hidden" name="PCO_Accion" value="cargar_archivo">
                            <input type="Hidden" name="siguiente_accion" value="PCO_AnalizarImportacionFormulario">
                            <input type="Hidden" name="texto_boton_siguiente" value="Continuar con la revisi&oacute;n">
                            <input type="Hidden" name="carpeta" value="tmp">
                            <input name="archivo" type="file" class="form-control btn btn-info">
                            <br>
                            <button type="submit"  class="btn btn-success"><i class="fa fa-cloud-upload"></i> <?php echo $MULTILANG_CargarArchivo; ?></button> (<?php echo $MULTILANG_ActSobreescritos; ?>)
                        </form> 
                        <hr>
            </div>
        </div>
        <!-- FIN TAB IMPORTACION -->
        

        <!-- INICIO TAB HISTORICO DE IMPORTACIONES -->
        <div class="tab-pane fade" id="historico_importaciones">
                <div class="well well-sm"><b>Ultimos 30 registros / Last 30 records</b></div>
                <table id="TablaAcciones" class="table table-condensed table-hover table-unbordered btn-xs table-striped">
                    <thead>
					<tr>
						<th><b><?php echo $MULTILANG_UsrLogin; ?></b></th>
						<th><b><?php echo $MULTILANG_UsrAudDes; ?></b></th>
						<th><b><?php echo $MULTILANG_Fecha; ?></b></th>
						<th><b><?php echo $MULTILANG_Hora; ?></b></th>
					</tr>
                    </thead>
                    <tbody>
                    <?php
                        // Busca por las auditorias asociadas a actualizacion de plataforma:
                        // Acciones:  Actualiza version de plataforma | _Actualizacion_ | Analiza archivo tmp/Practico | Carga archivo en carpeta tmp - Practico
                        $resultado=@PCO_EjecutarSQL("SELECT $ListaCamposSinID_auditoria FROM ".$TablasCore."auditoria WHERE accion LIKE '%Import%' AND accion LIKE '%.xml en objeto%' ORDER BY fecha DESC, hora DESC LIMIT 0,30");
                        while($registro = $resultado->fetch())
                            {
                                echo '<tr>
                                        <td>'.$registro["usuario_login"].'</td>
                                        <td>'.$registro["accion"].'</td>
                                        <td>'.$registro["fecha"].'</td>
                                        <td>'.$registro["hora"].'</td>
                                    </tr>';
                            }
                    ?>
                    </tbody>
                </table>

        </div>
        <!-- FIN TAB HISTORICO DE IMPORTACIONES -->
        
    </div>

<?php
		PCO_AbrirBarraEstado();
		echo '<a class="btn btn-warning btn-block" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-home"></i> '.$MULTILANG_Cancelar.'</a>';
		PCO_CerrarBarraEstado();
		PCO_CerrarVentana();
        $VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_AdministrarFormularios
	Presenta ventanas con la posibilidad de agregar nuevo formulario a la aplicacion y el listado para administrar o editar los existentes

	(start code)
		SELECT * FROM ".$TablasCore."formulario ORDER BY titulo
	(end)
*/
if ($PCO_Accion=="PCO_AdministrarFormularios")
	{
		 ?>

        <form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="PCO_Accion" value="PCO_GuardarFormulario">
			<input type="Hidden" name="nombre_tabla" value="<?php echo $nombre_tabla; ?>">
            <input type="Hidden" name="javascript" value="
function FrmAutoRun()
    {
        //Aqui sus instrucciones
    }">

<div class="row">
  <div class="col-md-4">

			<?php PCO_AbrirVentana($MULTILANG_FrmAgregar, 'panel-primary'); ?>
			<h4><?php echo $MULTILANG_FrmDetalles; ?>:</h4>

            <label for="tabla_datos"><?php echo $MULTILANG_TablaDatos; ?>:</label>
            <div class="form-group input-group">
                <select id="tabla_datos" name="tabla_datos" class="form-control" >
                    <option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
                    <?php
                            $resultado=PCO_ConsultarTablas();
                            while ($registro = $resultado->fetch())
                                {
                                    // Imprime solamente las tablas de aplicacion, es decir, las que no cumplen prefijo de internas de Practico
                                    if (strpos($registro[0],$TablasCore)===FALSE)  // Booleana requiere === o !==
                                        echo '<option value="'.$registro[0].'" >'.str_replace($TablasApp,'',$registro[0]).'</option>';
                                }
                    ?>
                </select>
                <span class="input-group-addon">
                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle  fa-fw icon-orange"></i></a>
                    <a  href="#" data-toggle="tooltip" data-html="true"  title="Puede usar la tabla manual llamada core_tabla_comodin si no necesita asociar una tabla / You can use a manual table called core_tabla_comodin if you dont need to associate a table to this form. "><i class="fa fa-question-circle  fa-fw icon-blue"></i></a>
                </span>
            </div>
            <input type="text" name="tabla_datos_manual" class="form-control" placeholder="<?php echo $MULTILANG_InfTablaManual; ?>"><br>

            <?php
                //PCO_CargarFormulario($formulario,$en_ventana=1,$PCO_CampoBusquedaBD="",$PCO_ValorBusquedaBD="",$anular_form=0,$modo_diseno_formulario=0)
	            PCO_CargarFormulario("-15",0,"","",1,0);
            ?>
            </form>
            
            <br>
            <a class="btn btn-success btn-block" href="javascript:document.datos.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_FrmCreaDisena; ?></a>
            <a class="btn btn-default btn-block" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-home"></i> <?php echo $MULTILANG_IrEscritorio; ?></a>
		<?php	PCO_CerrarVentana();	?>


		<?php PCO_AbrirVentana($MULTILANG_Importar."/".$MULTILANG_Exportar." ($MULTILANG_Avanzado)", 'panel-default'); ?>
            <form name="importacion" id="importacion" action="<?php echo $ArchivoCORE; ?>" method="POST">
    			<input type="Hidden" name="PCO_Accion" value="PCO_ImportarFormulario">
            </form>
            <a class="btn btn-warning btn-block" href="javascript:document.importacion.submit();"><i class="fa fa-cloud-upload"></i> <?php echo $MULTILANG_FrmImportar; ?></a>
    
            <hr>
            <b><?php echo $MULTILANG_ExportacionMasiva; ?>:</b>
            <form name="exportacion_masiva" id="exportacion_masiva" action="<?php echo $ArchivoCORE; ?>" method="POST">
    			    <input type="Hidden" name="PCO_Accion" value="exportacion_masiva_objetos">
                    <input name="ListaElementos" type="text" class="form-control" placeholder="Lista elementos/List: EJ: 1,2,5-6,8,12-30">
    			    <input type="Hidden" name="TipoElementos" value="Frm"><br>
    			    <?php echo $MULTILANG_FrmTipoCopia; ?>:
                    <div class="form-group input-group">
                        <select id="tipo_copia_objeto" name="tipo_copia_objeto" class="form-control btn-default" >
                            <option value="XML_IdEstatico"><?php echo $MULTILANG_FrmTipoCopia2; ?></option>
                            <option value="XML_IdDinamico"><?php echo $MULTILANG_FrmTipoCopia3; ?></option>
                            <option value="EnLinea"><?php echo $MULTILANG_FrmTipoCopia1; ?></option>
                        </select>
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_Ayuda; ?></b><br><li><?php echo $MULTILANG_FrmTipoCopiaDes1; ?><li><?php echo $MULTILANG_FrmTipoCopiaDes2; ?><li><?php echo $MULTILANG_FrmTipoCopiaDes3; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                    </div>
            </form>
            <a class="btn btn-primary btn-block" href="javascript:document.exportacion_masiva.submit();"><i class="fa fa-download"></i> <?php echo $MULTILANG_Exportar; ?></a>
		<?php	PCO_CerrarVentana();	?>

  </div>    
  <div class="col-md-8">
<?php
        //Carga informe interno con los elementos tipo formulario
		PCO_CargarInforme(-2,1,"","",1);
echo '

  </div>
</div>
';
					
	}
?>