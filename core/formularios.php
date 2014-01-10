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
			$consulta_formulario=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id='$formulario'");
			$registro_formulario = $consulta_formulario->fetch();

			// Busca los campos del form marcados como valor unico y verifica que no existan valores en la tabla
			$tabla=$registro_formulario["tabla_datos"];

			$consulta_campos_unicos=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND visible=1 AND valor_unico=1");
			while ($registro_campos_unicos = $consulta_campos_unicos->fetch())
				{
					$campo=$registro_campos_unicos["campo"];
					$valor=$$campo;
					// Busca si el campo cuenta con el valor en la tabla

					// Inserta los datos
					ejecutar_sql_unaria("DELETE FROM ".$tabla." WHERE $campo='$valor'");
					auditar("Elimina registro donde ".$campo." = ".$valor." en ".$tabla);
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
			$consulta_formulario=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id='$formulario'");
			$registro_formulario = $consulta_formulario->fetch();

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

			// Busca los campos del form marcados como obligatorios a los que no se les ingreso valor
			$tabla=$registro_formulario["tabla_datos"];
			$consulta_campos_obligatorios=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND visible=1 AND obligatorio=1");
			while ($registro_campos_obligatorios = $consulta_campos_obligatorios->fetch())
				{
					$campo=$registro_campos_obligatorios["campo"];
					$valor=$$campo;
					// Verifica si es vacio para retornar el error
					if ($valor=="")
						$mensaje_error.=$MULTILANG_ErrFrmObligatorio.$campo.'<br>';
				}

			//Ejecuta consulta de insercion de datos
			if ($mensaje_error=="")
				{
					// Busca los campos del form y construye cadenas de valores para consulta
					$lista_campos="";
					$lista_valores="";
					$existe_id=0; // Define si dentro de los valores recibidos esta o no el ID autonumerico.  Sino se agrega

					$consulta_campos=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND visible=1");
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
					/*
					Por compatibilidad entre motores ahora se envia la lista de campos sin el Id en cero. El id sera generado internamente
					if (!$existe_id)
						{
							$lista_campos="id,".$lista_campos;
							$lista_valores="'0',".$lista_valores;
						}
					*/

					// Inserta los datos
					ejecutar_sql_unaria("INSERT INTO ".$registro_formulario["tabla_datos"]." (".$lista_campos.") VALUES (".$lista_valores.")");
					auditar("Inserta registro en ".$registro_formulario["tabla_datos"]);
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
			ejecutar_sql_unaria("DELETE FROM ".$TablasCore."formulario_boton WHERE id='$boton' ");
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
			ejecutar_sql_unaria("DELETE FROM ".$TablasCore."formulario_objeto WHERE id='$campo' ");
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
			if ($valor_unico=="on") $valor_unico=1; else $valor_unico=0;
			if ($ajax_busqueda=="on") $ajax_busqueda=1; else $ajax_busqueda=0;
			$tipo_objeto=$tipo;
			if ($titulo=="" && ($tipo_objeto!="etiqueta" && $tipo_objeto!="url_iframe" && $tipo_objeto!="informe" && $tipo_objeto!="frm") ) $mensaje_error=$MULTILANG_ErrFrmCampo1;
			if ($campo==""  && ($tipo_objeto!="etiqueta" && $tipo_objeto!="url_iframe" && $tipo_objeto!="informe" && $tipo_objeto!="frm") ) $mensaje_error=$MULTILANG_ErrFrmCampo2;
			if ($mensaje_error=="")
				{
					//Genera la lista de campos a ser actualizados desde la definicion de tabla para no olvidar ninguno
					$ListaCampos=explode(",",$ListaCamposSinID_formulario_objeto);
					for ($i=0; $i<count($ListaCampos);$i++)
						$ListaCamposyValores.=$ListaCampos[$i]."='".$$ListaCampos[$i]."',";
					$ListaCamposyValores.="id=id"; //Agregado para evitar coma final

					ejecutar_sql_unaria("UPDATE ".$TablasCore."formulario_objeto SET ".$ListaCamposyValores." WHERE id='$idcampomodificado'");
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
			if ($valor_unico=="on") $valor_unico=1; else $valor_unico=0;
			if ($ajax_busqueda=="on") $ajax_busqueda=1; else $ajax_busqueda=0;
			if ($titulo=="" && ($tipo_objeto!="etiqueta" && $tipo_objeto!="url_iframe" && $tipo_objeto!="informe" && $tipo_objeto!="frm") ) $mensaje_error=$MULTILANG_ErrFrmCampo1;
			if ($campo==""  && ($tipo_objeto!="etiqueta" && $tipo_objeto!="url_iframe" && $tipo_objeto!="informe" && $tipo_objeto!="frm") ) $mensaje_error=$MULTILANG_ErrFrmCampo2;

			if ($mensaje_error=="")
				{
					// Define la consulta de insercion del nuevo campo
					$consulta_insercion="INSERT INTO ".$TablasCore."formulario_objeto (".$ListaCamposSinID_formulario_objeto.") VALUES ('$tipo_objeto','$titulo','$campo','$ayuda_titulo','$ayuda_texto','$formulario','$peso','$columna','$obligatorio','$visible','$valor_predeterminado','$validacion_datos','$etiqueta_busqueda','$ajax_busqueda','$valor_unico','$solo_lectura','$teclado_virtual','$ancho','$alto','$barra_herramientas','$fila_unica','$lista_opciones','$origen_lista_opciones','$origen_lista_valores','$valor_etiqueta','$url_iframe','$objeto_en_ventana','$informe_vinculado','$maxima_longitud','$valor_minimo','$valor_maximo','$valor_salto')";
					ejecutar_sql_unaria($consulta_insercion);
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
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."formulario_boton (".$ListaCamposSinID_formulario_boton.") VALUES ('$titulo','$estilo','$formulario','$tipo_accion','$accion_usuario','$visible','$peso','$retorno_titulo','$retorno_texto','$confirmacion_texto')");
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
					OcultarCampos(26);
					// Muestra campos segun tipo de objeto
					if (tipo_objeto_activo=="texto_corto")   VisualizarCampos("1,2,3,4,5,6,7,8,9,10,11,12,13,14,17,25");
					if (tipo_objeto_activo=="texto_clave")   VisualizarCampos("1,2,6,7,8,9,10,13,17,25");
					if (tipo_objeto_activo=="texto_largo")   VisualizarCampos("1,2,6,7,8,9,10,14,15,17");
					if (tipo_objeto_activo=="texto_formato") VisualizarCampos("1,2,6,7,8,9,10,14,15,16,17");
					if (tipo_objeto_activo=="lista_seleccion") VisualizarCampos("1,2,7,8,9,10,15,17,18,19,20");
					if (tipo_objeto_activo=="lista_radio") VisualizarCampos("1,2,7,8,9,10,17,18,19,20");
					if (tipo_objeto_activo=="etiqueta")   VisualizarCampos("9,17,21");
					if (tipo_objeto_activo=="url_iframe")   VisualizarCampos("9,14,15,17,22,24");
					if (tipo_objeto_activo=="informe")   VisualizarCampos("9,17,23,24");
					if (tipo_objeto_activo=="deslizador")   VisualizarCampos("1,2,4,7,8,9,17,26");
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
						$consulta_campo_editar=@ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE id='$campo' ");
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
									</optgroup>
									<!--
									<optgroup label="Informaci&oacute;n externa">
										<option value="archivo_adjunto">Archivo adjunto</option>
									</optgroup>
									-->
									<optgroup label="<?php echo $MULTILANG_FrmTipoTit2; ?>">
										<option value="etiqueta"        <?php if (@$registro_campo_editar["tipo"]=="etiqueta")        echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmTipo6; ?></option>
										<option value="url_iframe"      <?php if (@$registro_campo_editar["tipo"]=="url_iframe")      echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmTipo7; ?></option>
									</optgroup>
									<optgroup label="<?php echo $MULTILANG_FrmTipoTit3; ?>">
										<option value="informe"         <?php if (@$registro_campo_editar["tipo"]=="informe")         echo 'SELECTED'; ?>><?php echo $MULTILANG_FrmTipo8; ?></option>
										<!--<option value="frm">Formulario anidado</option>-->
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
													if (@$registro_campo_editar["campo"]==@$resultadocampos[$i]["nombre"])
														$seleccion_campo="SELECTED";
													if (@strtolower($resultadocampos["nombre"])!="id")
														echo '<option value="'.$resultadocampos[$i]["nombre"].'" '.$seleccion_campo.'>'.$resultadocampos[$i]["nombre"].'&nbsp;&nbsp;&nbsp;'.$resultadocampos[$i]["tipo"].'</option>';								
												}
										?>
									</select>
									<a href="#" title="<?php echo $MULTILANG_FrmCampoOb1; ?>" name=""><img src="img/icn_12.gif" border=0></a>
									<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FrmDesCampo; ?>"><img src="img/icn_10.gif" border=0></a>
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
												$consulta_columnas=ejecutar_sql("SELECT columnas FROM ".$TablasCore."formulario WHERE id='$formulario' ");
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
														$nombre_tabla=$registro[0];
														$resultadocampos=consultar_columnas($nombre_tabla);
														for($i=0;$i<count($resultadocampos);$i++)
															{
																$seleccion_campo="";
																if (@$registro_campo_editar["origen_lista_opciones"]==$nombre_tabla.'.'.$resultadocampos[$i]["nombre"])
																	$seleccion_campo="SELECTED";
																echo '<option value="'.$nombre_tabla.'.'.$resultadocampos[$i]["nombre"].'" '.$seleccion_campo.'>'.$resultadocampos[$i]["nombre"].'&nbsp;&nbsp;&nbsp;'.$resultadocampos[$i]["tipo"].'</option>';								
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
														$nombre_tabla=$registro[0];
														$resultadocampos=consultar_columnas($nombre_tabla);
														for($i=0;$i<count($resultadocampos);$i++)
															{
																$seleccion_campo="";
																if (@$registro_campo_editar["origen_lista_valores"]==$nombre_tabla.'.'.$resultadocampos[$i]["nombre"])
																	$seleccion_campo="SELECTED";
																echo '<option value="'.$nombre_tabla.'.'.$resultadocampos[$i]["nombre"].'" '.$seleccion_campo.'>'.$resultadocampos[$i]["nombre"].'&nbsp;&nbsp;&nbsp;'.$resultadocampos[$i]["tipo"].'</option>';								
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
										<option value="interna_limpiar"><?php echo $MULTILANG_FrmAccionLimpiar; ?></option>
										<option value="interna_eliminar"><?php echo $MULTILANG_FrmAccionEliminar; ?></option>
										<option value="interna_escritorio"><?php echo $MULTILANG_FrmAccionRegresar; ?></option>
										<option value="interna_cargar"><?php echo $MULTILANG_FrmAccionCargar; ?></option>
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


				$consulta=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' ORDER BY columna,peso,titulo");
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
											<input type="hidden" name="valor" value="'.$peso_disminuido.'">
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
				$consulta_form=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id='$formulario'");
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
							<select  name="ayuda_imagen" class="Combos" >
								<option value=""><?php echo $MULTILANG_Deshabilitado; ?></option>
							</select>
						</td>
					</tr>
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
													{
														$estado_seleccion_tabla="";
														if ($registro[0]==$registro_form["tabla_datos"])
															$estado_seleccion_tabla="SELECTED";
														echo '<option value="'.$registro[0].'" '.$estado_seleccion_tabla.'>'.str_replace($TablasApp,'',$registro[0]).'</option>';
													}
											}		
								?>
							</select><a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>" name=""><img src="img/icn_12.gif" border=0></a>
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
	(end)

	Salida:
		Registro eliminado

	Ver tambien:
		<administrar_formularios>
*/
	if ($accion=="eliminar_formulario")
		{
			ejecutar_sql_unaria("DELETE FROM ".$TablasCore."formulario WHERE id='$formulario'");
			ejecutar_sql_unaria("DELETE FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario'");
			auditar("Elimina formulario $id");
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
			if ($tabla_datos=="") $mensaje_error.=$MULTILANG_FrmErr2.'<br>';

			if ($mensaje_error=="")
				{
					ejecutar_sql_unaria("UPDATE ".$TablasCore."formulario SET titulo='$titulo',ayuda_titulo='$ayuda_titulo',ayuda_texto='$ayuda_texto',ayuda_imagen='$ayuda_imagen',tabla_datos='$tabla_datos',columnas='$columnas',javascript='$javascript' WHERE id='$formulario'");
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
		INSERT INTO ".$TablasCore."formulario VALUES (0, '$titulo','$ayuda_titulo','$ayuda_texto','$ayuda_imagen','$tabla_datos','$columnas')
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
			if ($tabla_datos=="") $mensaje_error.=$MULTILANG_FrmErr2.'<br>';
			//escapa cadenas antes de ser enviadas a consulta
			//$javascript=$ConexionPDO->quote($javascript);

			if ($mensaje_error=="")
				{
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."formulario (".$ListaCamposSinID_formulario.") VALUES ('$titulo','$ayuda_titulo','$ayuda_texto','$ayuda_imagen','$tabla_datos','$columnas','$javascript')");
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
		INSERT INTO ".$TablasCore."formulario VALUES (0, '$titulo','$ayuda_titulo','$ayuda_texto','$ayuda_imagen','$tabla_datos','$columnas')
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
					$consulta=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id='$formulario'");
					$registro = $consulta->fetch();
					// Establece valores para cada campo a insertar en el nuevo form
					$nuevo_titulo='[COPIA] '.$registro["titulo"];
					$ayuda_titulo=$registro["ayuda_titulo"];
					$ayuda_texto=$registro["ayuda_texto"];
					$ayuda_imagen=$registro["ayuda_imagen"];
					$tabla_datos=$registro["tabla_datos"];
					$columnas=$registro["columnas"];
					$javascript=$registro["javascript"];
					// Inserta el nuevo objeto al form
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."formulario (".$ListaCamposSinID_formulario.") VALUES ('$nuevo_titulo','$ayuda_titulo','$ayuda_texto','$ayuda_imagen','$tabla_datos','$columnas','$javascript') ");
					$id=$ConexionPDO->lastInsertId();
					// Busca los elementos que componen el formulario para hacerles la copia
					// Registros de formulario_objeto
					$consulta=ejecutar_sql("SELECT * FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario'");
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
							//Inserta el nuevo objeto al form
							ejecutar_sql_unaria("INSERT INTO ".$TablasCore."formulario_objeto (".$ListaCamposSinID_formulario_objeto.") VALUES ('$tipo','$titulo','$campo','$ayuda_titulo','$ayuda_texto','$nuevo_formulario','$peso','$columna','$obligatorio','$visible','$valor_predeterminado','$validacion_datos','$etiqueta_busqueda','$ajax_busqueda','$valor_unico','$solo_lectura','$teclado_virtual','$ancho','$alto','$barra_herramientas','$fila_unica','$lista_opciones','$origen_lista_opciones','$origen_lista_valores','$valor_etiqueta','$url_iframe','$objeto_en_ventana','$informe_vinculado','$maxima_longitud','$valor_minimo','$valor_maximo','$valor_salto') ");
						}				
					// Registros de formulario_boton
					$consulta=ejecutar_sql("SELECT * FROM ".$TablasCore."formulario_boton WHERE formulario='$formulario'");
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
							ejecutar_sql_unaria("INSERT INTO ".$TablasCore."formulario_boton (".$ListaCamposSinID_formulario_boton.") VALUES ('$titulo','$estilo','$nuevo_formulario','$tipo_accion','$accion_usuario','$visible','$peso','$retorno_titulo','$retorno_texto','$confirmacion_texto') ");
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
							<select  name="ayuda_imagen" class="Combos" >
								<option value=""><?php echo $MULTILANG_Deshabilitado; ?></option>
							</select>
						</td>
					</tr>
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
