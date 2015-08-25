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


/* ################################################################## */
/* ################################################################## */
/*
	Function: selector_objetos_menu
	Despliega marco para seleccionar objetos de formulario e informes durante creacion de menues

	Ver tambien:

		<administrar_menu> | <detalles_menu>
*/
function selector_objetos_menu()
    {
        global $MULTILANG_SeleccioneUno,$MULTILANG_Formularios,$MULTILANG_MnuHlpComandoInf,$MULTILANG_Si,$MULTILANG_No,$MULTILANG_Informes,$MULTILANG_FrmVentana,$MULTILANG_Guardar,$MULTILANG_Cerrar;
        global $ListaCamposSinID_formulario,$ListaCamposSinID_informe,$TablasCore;
        global $registro_informes;
        ?>
            <!-- Modal Selector de objetos -->
            <div class="modal fade" id="myModalSelectorObjetos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo $MULTILANG_SeleccioneUno; ?></h4>
                  </div>
                  <div class="modal-body mdl-primary">
                      
                    <form name="selector_objetos" method="POST">

                        <label for="objeto_seleccionado"><?php echo $MULTILANG_Formularios; ?> / <?php echo $MULTILANG_Informes; ?>:</label>
                        <select id="objeto_seleccionado" name="objeto_seleccionado" class="form-control" >
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

                        <label for="definir_ventana_propia"><?php echo $MULTILANG_FrmVentana; ?></label>
                        <select id="definir_ventana_propia" name="definir_ventana_propia" class="form-control" >
                            <option value=":1"><?php echo $MULTILANG_Si; ?></option>
                            <option value=":0"><?php echo $MULTILANG_No; ?></option>
                        </select>
                        <br>
                        <?php echo $MULTILANG_MnuHlpComandoInf; ?>
                    </form>
            
                  </div>
                  <div class="modal-footer">
                    <button onClick="document.datos.comando.value=document.selector_objetos.objeto_seleccionado.options[document.selector_objetos.objeto_seleccionado.selectedIndex].value + document.selector_objetos.definir_ventana_propia.options[document.selector_objetos.definir_ventana_propia.selectedIndex].value;" type="button" class="btn btn-success" data-dismiss="modal"><?php echo $MULTILANG_Guardar; ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $MULTILANG_Cerrar; ?> {<i class="fa fa-keyboard-o"></i> Esc}</button>
                  </div>
                </div>
              </div>
            </div>
<?php        
    }


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
if ($PCO_Accion=="actualizar_menu")
	{
		// Actualiza los datos del item
		ejecutar_sql_unaria("UPDATE ".$TablasCore."menu SET posible_izquierda=?,texto=?,peso=?,url=?,destino=?,tipo_comando=?,comando=?,nivel_usuario=?,posible_arriba=?,posible_centro=?,posible_escritorio=?,seccion=?,imagen=? WHERE id=? ","$posible_izquierda$_SeparadorCampos_$texto$_SeparadorCampos_$peso$_SeparadorCampos_$url$_SeparadorCampos_$destino$_SeparadorCampos_$tipo_comando$_SeparadorCampos_$comando$_SeparadorCampos_$nivel_usuario$_SeparadorCampos_$posible_arriba$_SeparadorCampos_$posible_centro$_SeparadorCampos_$posible_escritorio$_SeparadorCampos_$seccion$_SeparadorCampos_$imagen$_SeparadorCampos_$id");
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
if ($PCO_Accion=="detalles_menu")
	{
		abrir_ventana($MULTILANG_MnuTitEditar,'panel-danger');

		// Busca detalles del item
		$resultado=ejecutar_sql("SELECT id,".$ListaCamposSinID_menu." FROM ".$TablasCore."menu WHERE id=? ","$id");
		$registro = $resultado->fetch();
		
        selector_iconos_awesome();
        selector_objetos_menu();
        ?>


			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="hidden" name="PCO_Accion" value="actualizar_menu">
			<input type="hidden" name="id" value="<?php echo $registro["id"]; ?>">
			<input type="hidden" name="nivel_usuario" value="-1">
			<h4><b><?php echo $MULTILANG_MnuPropiedad; ?></b></h4>


                <div class="row">
                    <div class="col-md-6">

                            [<?php echo $MULTILANG_MnuApariencia; ?>]

                            <div class="form-group input-group">
                                <input name="texto" value="<?php echo $registro["texto"]; ?>" maxlength="250" type="text" class="form-control" placeholder="<?php echo $MULTILANG_MnuTexto; ?>">
                                <span class="input-group-addon">
                                    <a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle fa-fw icon-orange"></i></a>
                                </span>
                            </div>

                            <label for="peso"><?php echo $MULTILANG_Peso; ?>:</label>
                            <select id="peso" name="peso" class="form-control selectpicker" >
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

                            <div class="row">
                                <div class="col-md-3">
                                        <label for="posible_arriba"><?php echo $MULTILANG_MnuArriba; ?>:</label>
                                        <div class="form-group input-group">
                                            <select id="posible_arriba" name="posible_arriba" class="form-control" >
                                                <option value="0"><?php echo $MULTILANG_No; ?></option>
                                                <option value="1" <?php if ($registro["posible_arriba"]) echo 'selected'; ?> ><?php echo $MULTILANG_Si; ?></option>
                                            </select>
                                            <span class="input-group-addon">
                                                <a href="#" title="<?php echo $MULTILANG_MnuUbicacion; ?>: <?php echo $MULTILANG_MnuDesArriba; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                            </span>
                                        </div>
                                </div>    
                                <div class="col-md-3">
                                        <label for="posible_escritorio"><?php echo $MULTILANG_MnuEscritorio; ?>:</label>
                                        <div class="form-group input-group">
                                            <select id="posible_escritorio" name="posible_escritorio" class="form-control" >
                                                <option value="0"><?php echo $MULTILANG_No; ?></option>
                                                <option value="1" <?php if ($registro["posible_escritorio"]) echo 'selected'; ?> ><?php echo $MULTILANG_Si; ?></option>
                                            </select>
                                            <span class="input-group-addon">
                                                <a href="#" title="<?php echo $MULTILANG_MnuUbicacion; ?>: <?php echo $MULTILANG_MnuDesEscritorio; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                            </span>
                                        </div>
                                </div>    
                                <div class="col-md-3">
                                        <label for="posible_centro"><?php echo $MULTILANG_MnuCentro; ?>:</label>
                                        <div class="form-group input-group">
                                            <select id="posible_centro" name="posible_centro" class="form-control" >
                                                <option value="0"><?php echo $MULTILANG_No; ?></option>
                                                <option value="1" <?php if ($registro["posible_centro"]) echo 'selected'; ?> ><?php echo $MULTILANG_Si; ?></option>
                                            </select>
                                            <span class="input-group-addon">
                                                <a href="#" title="<?php echo $MULTILANG_MnuUbicacion; ?>: <?php echo $MULTILANG_MnuDesCentro; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                            </span>
                                        </div>
                                </div>
                                <div class="col-md-3">
                                        <label for="posible_izquierda"><?php echo $MULTILANG_MnuIzquierda; ?>:</label>
                                        <div class="form-group input-group">
                                            <select id="posible_izquierda" name="posible_izquierda" class="form-control" >
                                                <option value="0"><?php echo $MULTILANG_No; ?></option>
                                                <option value="1" <?php if ($registro["posible_izquierda"]) echo 'selected'; ?> ><?php echo $MULTILANG_Si; ?></option>
                                            </select>
                                            <span class="input-group-addon">
                                                <a href="#" title="<?php echo $MULTILANG_MnuUbicacion; ?>: <?php echo $MULTILANG_MnuDesIzquierdo; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                            </span>
                                        </div>
                                </div>
                            </div>


                            <div class="form-group input-group">
                                <input name="seccion" value="<?php echo $registro["seccion"]; ?>" maxlength="250" type="text" class="form-control" placeholder="<?php echo $MULTILANG_MnuSeccion; ?>">
                                <span class="input-group-addon">
                                    <a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle fa-fw icon-orange"></i></a>
                                </span>
                            </div>

                            <div class="form-group input-group">
                                <input name="imagen" value="<?php echo $registro["imagen"]; ?>" maxlength="250" type="text" class="form-control" placeholder="<?php echo $MULTILANG_Imagen; ?>">
                                <span class="input-group-addon">
                                    <a data-toggle="modal" href="#myModalSelectorIconos" title="<?php echo $MULTILANG_MnuDesImagen; ?>">
                                           <i class="fa fa-hand-o-right"></i> <i class="fa fa-picture-o"></i>
                                    </a>
                                </span>
                            </div>

                    </div>    
                    <div class="col-md-6">
                            
                            [<?php echo $MULTILANG_MnuComandos; ?>]

                            <br><label for="destino"><?php echo $MULTILANG_MnuTgt; ?>:</label>
                            <select id="destino" name="destino" class="form-control" >
                                <option value="_self" <?php if ($registro["destino"]=="_self") echo 'selected'; ?> ><?php echo $MULTILANG_MnuTgtSelf; ?></option>
                                <option value="_blank" <?php if ($registro["destino"]=="_blank") echo 'selected'; ?> ><?php echo $MULTILANG_MnuTgtBlank; ?></option>
                                <option value="_parent" <?php if ($registro["destino"]=="_parent") echo 'selected'; ?> ><?php echo $MULTILANG_MnuTgtParent; ?></option>
                                <option value="_top" <?php if ($registro["destino"]=="_top") echo 'selected'; ?> ><?php echo $MULTILANG_MnuTgtTop; ?></option>
                            </select>

                            <div class="form-group input-group">
                                <input name="url" value="<?php echo $registro["url"]; ?>" type="text" class="form-control" placeholder="<?php echo $MULTILANG_MnuURL; ?>">
                                <span class="input-group-addon">
                                    <a href="#" title="<?php echo $MULTILANG_MnuTitURL; ?>: <?php echo $MULTILANG_MnuDesURL; ?>"><i class="fa fa-exclamation-triangle fa-fw icon-orange"></i></a>
                                </span>
                            </div>
                            
                            <label for="tipo_comando"><?php echo $MULTILANG_MnuTipo; ?>:</label>
                            <div class="form-group input-group">
                                <select id="tipo_comando" name="tipo_comando" class="form-control" >
                                    <option value="Objeto" <?php if ($registro["tipo_comando"]=="Objeto") echo 'selected'; ?> >1. <?php echo $MULTILANG_MnuObjeto; ?></option>
                                    <option value="Interno" <?php if ($registro["tipo_comando"]=="Interno") echo 'selected'; ?> >2. <?php echo $MULTILANG_MnuInterno; ?></option>
                                    <option value="Personal" <?php if ($registro["tipo_comando"]=="Personal") echo 'selected'; ?> >3. <?php echo $MULTILANG_MnuPersonal; ?></option>
                                </select>
                                <span class="input-group-addon">
                                    <a href="#" title="<?php echo $MULTILANG_MnuTitAccion; ?>: <?php echo $MULTILANG_MnuDesAccion; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                </span>
                            </div>
                            
                            <div class="form-group input-group">
                                <input name="comando" value="<?php echo $registro["comando"]; ?>" maxlength="250" type="text" class="form-control" placeholder="<?php echo $MULTILANG_MnuAccion; ?>">
                                <span class="input-group-addon">
                                    <a data-toggle="modal" href="#myModalSelectorObjetos" title="<?php echo $MULTILANG_SeleccioneUno; ?> <?php echo $MULTILANG_MnuObjeto; ?> o <?php echo $MULTILANG_MnuTitAccion; ?> <?php echo $MULTILANG_MnuDesAccion; ?>">
                                           <i class="fa fa-hand-o-right"></i> <i class="fa fa-folder-open"></i>
                                    </a>
                                </span>
                            </div>
                            
                            <br>
                            <a class="btn btn-success btn-block" href="javascript:document.datos.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_MnuActualiza; ?></a>
                            <a class="btn btn-block btn-default" href="javascript:document.core_ver_menu.submit();"><i class="fa fa-times"></i> <?php echo $MULTILANG_Cancelar; ?></a>

                    </div>
                </div>
            </form>

 <?php
		cerrar_ventana();
	}



/* ################################################################## */
/* ################################################################## */
if ($PCO_Accion=="eliminar_menu")
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
	if ($PCO_Accion=="guardar_menu")
		{
			$mensaje_error="";
			// Verifica campos nulos
			if ($texto=="")
				$mensaje_error.=$MULTILANG_MnuErr."<br>";

			if ($mensaje_error=="")
				{
					// Guarda los datos del comando o item de menu
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."menu (".$ListaCamposSinID_menu.") VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)","$texto$_SeparadorCampos_$peso$_SeparadorCampos_$url$_SeparadorCampos_$destino$_SeparadorCampos_$tipo_comando$_SeparadorCampos_$comando$_SeparadorCampos_$nivel_usuario$_SeparadorCampos_$posible_arriba$_SeparadorCampos_$posible_centro$_SeparadorCampos_$posible_escritorio$_SeparadorCampos_$seccion$_SeparadorCampos_$imagen$_SeparadorCampos_$posible_izquierda");
					auditar("Agrega en menu: $texto");
					echo '<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="administrar_menu">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
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
if ($PCO_Accion=="administrar_menu")
	{
		$PCO_Accion=escapar_contenido($PCO_Accion); //Limpia cadena para evitar XSS
		echo '<div align="center"><br>';
		abrir_ventana($MULTILANG_MnuAdmin, 'panel-primary');
        
        selector_iconos_awesome();
        selector_objetos_menu();
?>
          
            




			<form name="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="hidden" name="PCO_Accion" value="guardar_menu">
			<input type="hidden" name="nivel_usuario" value="-1">
			<h4><b><?php echo $MULTILANG_MnuAgregar; ?></b></h4>


                <div class="row">
                    <div class="col-md-6">

                            [<?php echo $MULTILANG_MnuApariencia; ?>]

                            <div class="form-group input-group">
                                <input name="texto"  maxlength="250" type="text" class="form-control" placeholder="<?php echo $MULTILANG_MnuTexto; ?>">
                                <span class="input-group-addon">
                                    <a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle fa-fw icon-orange"></i></a>
                                </span>
                            </div>

                            <label for="peso"><?php echo $MULTILANG_Peso; ?>:</label>
                            <select id="peso" name="peso" class="form-control" >
                                <?php
                                    for ($i=1;$i<=100;$i++)
                                        {
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                ?>
                            </select>

                            <div class="row">
                                <div class="col-md-3">
                                        <label for="posible_arriba"><?php echo $MULTILANG_MnuArriba; ?>:</label>
                                        <div class="form-group input-group">
                                            <select id="posible_arriba" name="posible_arriba" class="form-control" >
                                                <option value="0"><?php echo $MULTILANG_No; ?></option>
                                                <option value="1"><?php echo $MULTILANG_Si; ?></option>
                                            </select>
                                            <span class="input-group-addon">
                                                <a href="#" title="<?php echo $MULTILANG_MnuUbicacion; ?>: <?php echo $MULTILANG_MnuDesArriba; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                            </span>
                                        </div>
                                </div>    
                                <div class="col-md-3">
                                        <label for="posible_escritorio"><?php echo $MULTILANG_MnuEscritorio; ?>:</label>
                                        <div class="form-group input-group">
                                            <select id="posible_escritorio" name="posible_escritorio" class="form-control" >
                                                <option value="0"><?php echo $MULTILANG_No; ?></option>
                                                <option value="1" selected><?php echo $MULTILANG_Si; ?></option>
                                            </select>
                                            <span class="input-group-addon">
                                                <a href="#" title="<?php echo $MULTILANG_MnuUbicacion; ?>: <?php echo $MULTILANG_MnuDesEscritorio; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                            </span>
                                        </div>
                                </div>    
                                <div class="col-md-3">
                                        <label for="posible_centro"><?php echo $MULTILANG_MnuCentro; ?>:</label>
                                        <div class="form-group input-group">
                                            <select id="posible_centro" name="posible_centro" class="form-control" >
                                                <option value="0"><?php echo $MULTILANG_No; ?></option>
                                                <option value="1"><?php echo $MULTILANG_Si; ?></option>
                                            </select>
                                            <span class="input-group-addon">
                                                <a href="#" title="<?php echo $MULTILANG_MnuUbicacion; ?>: <?php echo $MULTILANG_MnuDesCentro; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                            </span>
                                        </div>
                                </div>
                                <div class="col-md-3">
                                        <label for="posible_izquierda"><?php echo $MULTILANG_MnuIzquierda; ?>:</label>
                                        <div class="form-group input-group">
                                            <select id="posible_izquierda" name="posible_izquierda" class="form-control" >
                                                <option value="0"><?php echo $MULTILANG_No; ?></option>
                                                <option value="1"><?php echo $MULTILANG_Si; ?></option>
                                            </select>
                                            <span class="input-group-addon">
                                                <a href="#" title="<?php echo $MULTILANG_MnuUbicacion; ?>: <?php echo $MULTILANG_MnuDesIzquierdo; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                            </span>
                                        </div>
                                </div>
                            </div>


                            <div class="form-group input-group">
                                <input name="seccion"  maxlength="250" type="text" class="form-control" placeholder="<?php echo $MULTILANG_MnuSeccion; ?>">
                                <span class="input-group-addon">
                                    <a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle fa-fw icon-orange"></i></a>
                                </span>
                            </div>

                            <div class="form-group input-group">
                                <input name="imagen"  maxlength="250" type="text" class="form-control" placeholder="<?php echo $MULTILANG_ImagenMenu; ?>">
                                <span class="input-group-addon">
                                    <a data-toggle="modal" href="#myModalSelectorIconos" title="<?php echo $MULTILANG_MnuDesImagen; ?>">
                                           <i class="fa fa-hand-o-right"></i> <i class="fa fa-picture-o"></i>
                                    </a>
                                </span>
                            </div>


                    </div>    
                    <div class="col-md-6">
                            
                            [<?php echo $MULTILANG_MnuComandos; ?>]
                            
                            <br><label for="destino"><?php echo $MULTILANG_MnuTgt; ?>:</label>
                            <select id="destino" name="destino" class="form-control" >
                                <option value="_self"><?php echo $MULTILANG_MnuTgtSelf; ?></option>
                                <option value="_blank"><?php echo $MULTILANG_MnuTgtBlank; ?></option>
                                <option value="_parent"><?php echo $MULTILANG_MnuTgtParent; ?></option>
                                <option value="_top"><?php echo $MULTILANG_MnuTgtTop; ?></option>
                            </select>
                            
                            <div class="form-group input-group">
                                <input name="url" type="text" class="form-control" placeholder="<?php echo $MULTILANG_MnuURL; ?>">
                                <span class="input-group-addon">
                                    <a href="#" title="<?php echo $MULTILANG_MnuTitURL; ?>: <?php echo $MULTILANG_MnuDesURL; ?>"><i class="fa fa-exclamation-triangle fa-fw icon-orange"></i></a>
                                </span>
                            </div>
                            
                            <label for="tipo_comando"><?php echo $MULTILANG_MnuTipo; ?>:</label>
                            <div class="form-group input-group">
                                <select id="tipo_comando" name="tipo_comando" class="form-control" >
                                    <option value="Objeto">1. <?php echo $MULTILANG_MnuObjeto; ?></option>
                                    <option value="Interno">2. <?php echo $MULTILANG_MnuInterno; ?></option>
                                    <option value="Personal">3. <?php echo $MULTILANG_MnuPersonal; ?></option>
                                </select>
                                <span class="input-group-addon">
                                    <a href="#" title="<?php echo $MULTILANG_MnuTitAccion; ?>: <?php echo $MULTILANG_MnuDesAccion; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                </span>
                            </div>
                            
                            <div class="form-group input-group">
                                <input name="comando"  maxlength="250" type="text" class="form-control" placeholder="<?php echo $MULTILANG_MnuAccion; ?>">
                                <span class="input-group-addon">
                                    <a data-toggle="modal" href="#myModalSelectorObjetos" title="<?php echo $MULTILANG_SeleccioneUno; ?> <?php echo $MULTILANG_MnuObjeto; ?> o <?php echo $MULTILANG_MnuTitAccion; ?> <?php echo $MULTILANG_MnuDesAccion; ?>">
                                           <i class="fa fa-hand-o-right"></i> <i class="fa fa-folder-open"></i>
                                    </a>
                                </span>
                            </div>

                            <a class="btn btn-success btn-block" href="javascript:document.datos.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_Agregar; ?></a>
                            <a class="btn btn-block btn-default" href="javascript:document.core_ver_menu.submit();"><i class="fa fa-times"></i> <?php echo $MULTILANG_Cancelar; ?></a>


                    </div>
                </div>
            </form>

        <hr>

		<h4><b><?php echo $MULTILANG_MnuDefinidos; ?></b></h4>
		 <?php
				echo '
				<table class="table table-condensed btn-xs table-unbordered table-hover">
					<thead>
                    <tr>
						<td><b>Id</b></td>
						<td></td>
						<td><b>'.$MULTILANG_MnuTexto.'</b></td>
						<td><b>'.$MULTILANG_MnuComando.'</b></td>
						<td></td>
						<td></td>
					</tr>
                    </thead>
                    <tbody>
                    	';

				$resultado=ejecutar_sql("SELECT id,".$ListaCamposSinID_menu." FROM ".$TablasCore."menu WHERE 1=1");
				while($registro = $resultado->fetch())
					{
						echo '<tr>
								<td>'.$registro["id"].'</td>
								<td><i class="'.$registro["imagen"].'"></i></td>
								<td><strong>'.$registro["texto"].'</strong></td>
								<td>'.$registro["comando"].'</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST" name="f'.$registro["id"].'" id="f'.$registro["id"].'">
												<input type="hidden" name="PCO_Accion" value="eliminar_menu">
												<input type="hidden" name="id" value="'.$registro["id"].'">
                                                <a href="javascript:confirmar_evento(\''.$MULTILANG_MnuAdvElimina.'\',f'.$registro["id"].');" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="'.$MULTILANG_Eliminar.'"><i class="fa fa-times"></i></a>
										</form>
								</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST">
												<input type="hidden" name="PCO_Accion" value="detalles_menu">
												<input type="hidden" name="id" value="'.$registro["id"].'">
                                                <button type="submit" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="'.$MULTILANG_Editar.'"><i class="fa fa-pencil-square-o"></i></button>
										</form>
								</td>
							</tr>';
					}
				echo '</tbody>
                </table>';
		 ?>



		 <?php
		 				cerrar_ventana();
		 		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: buscar_permisos_practico
	Busca dentro de los permisos asignados al usuario aquellos que puedan coincidir dentro de los menues y los informes a la busqueda realizada

	Variables de entrada:

		PCO_BusquedaPermisos - la palabra o expresion a buscar

	Salida:
		Escritorio de usuario con la lista de posibles permisos que coinciden con su busqueda

	Observacion:
		Se retornan unicamente aquellos permisos e informes asignados al usuario

	Ver tambien:
		<Ver_menu>
*/
	if ($PCO_Accion=="buscar_permisos_practico" && $PCOSESS_SesionAbierta)
		{ 
			echo '<div align="center"><button onclick="document.core_ver_menu.submit()" class="btn btn-warning"><i class="fa fa-home"></i> '.$MULTILANG_IrEscritorio.'</button></div><br>';

            //Presenta el buscador nuevamente
            echo '
                <form name="datos_busqueda_home" action="'.$ArchivoCORE.'" method="POST">
                <input type="hidden" name="PCO_Accion" value="buscar_permisos_practico">
                <div class="chat-panel panel panel-default">
                    <div class="panel-heading">
                        <div class="input-group">
                            <input id="btn-input" name="PCO_BusquedaPermisos" value="'.@$PCO_BusquedaPermisos.'" type="text" class="form-control input-sm" placeholder="'.$MULTILANG_Buscar.'..." />
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-info btn-sm" id="btn-chat">
                                    <i class="fa fa-search"></i> '.$MULTILANG_Buscar.'
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                </form>';

			//Realiza el proceso de busqueda solamente si recibe algun criterio
			if ($PCO_BusquedaPermisos!="")
				{
					
					//Descompone la frase de busqueda en palabras para buscar las cuatro primeras como las mas relevantes
						$PalabrasBusqueda=explode(" ",$PCO_BusquedaPermisos);
						$Palabra1=@$PalabrasBusqueda[0];
						$Palabra2=@$PalabrasBusqueda[1];
						$Palabra3=@$PalabrasBusqueda[2];
						$Palabra4=@$PalabrasBusqueda[3];
					$complemento_palabras_like="";
					if ($Palabra1!="") $complemento_palabras_like.=" texto LIKE '%$Palabra1%' ";
					if ($Palabra2!="") $complemento_palabras_like.=" OR texto LIKE '%$Palabra2%' ";
					if ($Palabra3!="") $complemento_palabras_like.=" OR texto LIKE '%$Palabra3%' ";
					if ($Palabra4!="") $complemento_palabras_like.=" OR texto LIKE '%$Palabra4%' ";

					//Inicia el marco con resultados
					echo '
							<h3>'.$MULTILANG_Resultados.':</h3>
							<div class="panel panel-default"> <!-- Clase chat-panel para altura -->
								<div class="panel-body">
									<ul class="chat">';


							// Busca y carga las opciones de menu
							// Si el usuario es diferente al administrador agrega condiciones al query
							if ($PCOSESS_LoginUsuario!="admin")
								{
									$Complemento_tablas=",".$TablasCore."usuario_menu";
									$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.id AND ".$TablasCore."usuario_menu.usuario='$PCOSESS_LoginUsuario'";
								}
							$resultado=ejecutar_sql("SELECT * FROM ".$TablasCore."menu ".@$Complemento_tablas." WHERE 1 AND ( $complemento_palabras_like) ".@$Complemento_condicion);

							// Imprime las opciones con sus formularios
							$conteo_opciones=0;
							while($registro = $resultado->fetch())
								{
									echo '<form action="'.$ArchivoCORE.'" method="post" name="desk_'.$registro["id"].'" id="desk_'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">';
									// Verifica si se trata de un comando interno o personal y crea formulario y enlace correspondiente (ambos funcionan igual)
									if ($registro["tipo_comando"]=="Interno" || $registro["tipo_comando"]=="Personal")
										{
											echo '<input type="hidden" name="PCO_Accion" value="'.$registro["comando"].'"></form>';
										}
									// Verifica si se trata de una opcion para cargar un objeto de practico
									if ($registro["tipo_comando"]=="Objeto")
										{
											echo'<input type="hidden" name="PCO_Accion" value="cargar_objeto">
												 <input type="hidden" name="objeto" value="'.$registro["comando"].'"></form>';
										}
									//Presenta la opcion de menu
									echo '
										<li class="left clearfix">
											<span class="chat-img pull-left">
												<i class="'.$registro["imagen"].' fa-2x fa-fw icon-gray"></i>
											</span>
											<div class="chat-body clearfix">
												<div class="header">
													<a href="javascript:document.desk_'.$registro["id"].'.submit();">
														<strong class="primary-font">'.$registro["texto"].'</strong> 
													</a>
													<small class="pull-right text-muted">
														<i class="fa fa-rocket fa-fw"></i> ['.$registro["tipo_comando"].']='.$registro["comando"].'
													</small>
												</div>
												<p>
													<i class="icon-gray">&nbsp;&nbsp;&nbsp;'.$registro["seccion"].'</i>
												</p>
											</div>
										</li>';
									$conteo_opciones++;
								}

							
							// Busca y carga las opciones de informes
							$complemento_palabras_like="";
							if ($Palabra1!="") $complemento_palabras_like.=" titulo LIKE '%$Palabra1%' ";
							if ($Palabra2!="") $complemento_palabras_like.=" OR titulo LIKE '%$Palabra2%' ";
							if ($Palabra3!="") $complemento_palabras_like.=" OR titulo LIKE '%$Palabra3%' ";
							if ($Palabra4!="") $complemento_palabras_like.=" OR titulo LIKE '%$Palabra4%' ";
							// Si el usuario es diferente al administrador agrega condiciones al query
							if ($PCOSESS_LoginUsuario!="admin")
								{
									$Complemento_tablas=",".$TablasCore."usuario_informe";
									$Complemento_condicion=" AND ".$TablasCore."usuario_informe.informe=".$TablasCore."informe.id AND ".$TablasCore."usuario_informe.usuario='$PCOSESS_LoginUsuario'";
								}
							$resultado=ejecutar_sql("SELECT * FROM ".$TablasCore."informe ".@$Complemento_tablas." WHERE 1 AND ( $complemento_palabras_like) ".@$Complemento_condicion);

							// Imprime las opciones con sus formularios
							while($registro = $resultado->fetch())
								{
									echo '<form action="'.$ArchivoCORE.'" method="post" name="deskinf_'.$registro["id"].'" id="deskinf_'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">';
									echo'<input type="hidden" name="PCO_Accion" value="cargar_objeto">
										 <input type="hidden" name="objeto" value="inf:'.$registro["id"].'"></form>';
									//Presenta la opcion de menu
									echo '
										<li class="left clearfix">
											<span class="chat-img pull-left">
												<i class="fa fa-file-text fa-2x fa-fw icon-gray"></i>
											</span>
											<div class="chat-body clearfix">
												<div class="header">
													<a href="javascript:document.deskinf_'.$registro["id"].'.submit();">
														<strong class="primary-font">'.$registro["titulo"].'</strong> 
													</a>
													<small class="pull-right text-muted">
														<i class="fa fa-file-text fa-fw"></i> [Reporte]=inf:'.$registro["id"].'
													</small>
												</div>
												<p>
													<i class="icon-gray">&nbsp;&nbsp;&nbsp;'.$registro["categoria"].'</i>
												</p>
											</div>
										</li>';
									$conteo_opciones++;
								}


					//Finaliza el marco de resultados
					echo '
									</ul>
								</div> <!-- /.panel-body -->
							</div> <!-- /.panel .chat-panel -->
							<h4>'.$MULTILANG_TotalRegistros.': '.$conteo_opciones.'</h4>
							';	
					
				} //Fin si realmente recibio un criterio
			else
				{
					mensaje($MULTILANG_Resultados, $MULTILANG_BuscaCriterios.'<br>'.$MULTILANG_InfDataTableNoRegistros, '', 'fa fa-search fa-3x', 'alert alert-warning alert-dismissible');
				}

	} 


/* ################################################################## */
/* ################################################################## */
/*
	Function: Ver_menu
	Despliega el escritorio de un usuario, incluyendo el menu superior, iconos de escritorio y opciones agrupadas en el acordeon central

	Variables de entrada:

		PCOSESS_LoginUsuario - UID/Login de usuario al que se desea agregar el permiso almacenado como variable de sesion despues del login
		PCOSESS_SesionAbierta - Variable que establece si realmente se ha iniciado una sesion

	Salida:
		Escritorio de usuario con las opciones asignadas

	Observacion:
		La funcion agrega un filtrado para aquellos usuarios diferentes del administrador.  El usuario administrador mostrara siempre todas las opciones existentes por defecto.

	Ver tambien:
		<administrar_menu>
*/
	if ($PCO_Accion=="Ver_menu" && $PCOSESS_SesionAbierta)
		{ 
			// Carga las opciones del ESCRITORIO
			echo '<table class="table table-unbordered table-condensed"><tr><td>';
			// Si el usuario es diferente al administrador agrega condiciones al query
			if ($PCOSESS_LoginUsuario!="admin")
				{
					$Complemento_tablas=",".$TablasCore."usuario_menu";
					$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.id AND ".$TablasCore."usuario_menu.usuario='$PCOSESS_LoginUsuario'";  // AND nivel>0
				}
			$resultado=ejecutar_sql("SELECT * FROM ".$TablasCore."menu ".@$Complemento_tablas." WHERE posible_escritorio=1 ".@$Complemento_condicion);

			// Imprime las opciones con sus formularios
			while($registro = $resultado->fetch())
				{
                    echo '<form action="'.$ArchivoCORE.'" method="post" name="desk_'.$registro["id"].'" id="desk_'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">';
                    // Verifica si se trata de un comando interno o personal y crea formulario y enlace correspondiente (ambos funcionan igual)
                    if ($registro["tipo_comando"]=="Interno" || $registro["tipo_comando"]=="Personal")
                        {
                            echo '<input type="hidden" name="PCO_Accion" value="'.$registro["comando"].'"></form>';
                        }
                    // Verifica si se trata de una opcion para cargar un objeto de practico
                    if ($registro["tipo_comando"]=="Objeto")
                        {
                            echo'<input type="hidden" name="PCO_Accion" value="cargar_objeto">
                                 <input type="hidden" name="objeto" value="'.$registro["comando"].'"></form>';
                        }
                    
                    // Imprime la imagen
                    //Si tiene una URL trata la opcion como enlace estandar, sino como opcion de menu especial
                    if ($registro["url"]!="")
                        echo '<a title="'.$registro["texto"].'" href="'.$registro["url"].'" target="'.$registro["destino"].'">';
                    else
                        echo '<a title="'.$registro["texto"].'" href="javascript:document.desk_'.$registro["id"].'.submit();">';

                    //Determina si la opcion es una imagen o no
                    $PCO_EsImagen=0;
                    if (strpos($registro["imagen"],".png") || strpos($registro["imagen"],".jpg") || strpos($registro["imagen"],".gif"))
						$PCO_EsImagen=1;
                    //Si no detecta ninguna extension de archivo de imagen entonces pone boton en bootstrap
                    if (!$PCO_EsImagen)
						echo '<button class="btn btn-default">
							<i class="'.$registro["imagen"].' fa-3x fa-fw"></i><br>
							<span class="btn-xs">'.$registro["texto"].'</span>
							</button>';
                    else
						echo '<img src="'.$registro["imagen"].'" border="0" />';
                    echo '</a>';
				}
			echo '</td></tr></table><br>';



			// Carga las opciones del ACORDEON
			echo '<div align="center">';
			// Si el usuario es diferente al administrador agrega condiciones al query
			if ($PCOSESS_LoginUsuario!="admin")
				{
					$Complemento_tablas=",".$TablasCore."usuario_menu";
					$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.id AND ".$TablasCore."usuario_menu.usuario='$PCOSESS_LoginUsuario'";  // AND nivel>0
				}
			$resultado=ejecutar_sql("SELECT COUNT(*) as conteo,seccion FROM ".$TablasCore."menu ".@$Complemento_tablas." WHERE posible_centro=1 ".@$Complemento_condicion." GROUP BY seccion ORDER BY seccion");
			// Imprime las secciones encontradas para el usuario
			while($registro = $resultado->fetch())
				{
					//Crea la seccion en el acordeon
					$seccion_menu_activa=$registro["seccion"];
					$conteo_opciones=$registro["conteo"];
					abrir_ventana($seccion_menu_activa.' ('.$conteo_opciones.')', 'panel-primary');
					// Busca las opciones dentro de la seccion

					// Si el usuario es diferente al administrador agrega condiciones al query
					if ($PCOSESS_LoginUsuario!="admin")
						{
							$Complemento_tablas=",".$TablasCore."usuario_menu";
							$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.id AND ".$TablasCore."usuario_menu.usuario='$PCOSESS_LoginUsuario'";  // AND nivel>0
						}
					$resultado_opciones_acordeon=ejecutar_sql("SELECT * FROM ".$TablasCore."menu ".@$Complemento_tablas." WHERE posible_centro=1 AND seccion='".$seccion_menu_activa."' ".@$Complemento_condicion." ORDER BY peso");

					while($registro_opciones_acordeon = $resultado_opciones_acordeon->fetch())
						{
                            echo '<form action="'.$ArchivoCORE.'" method="post" name="acorde_'.$registro_opciones_acordeon["id"].'" id="acorde_'.$registro_opciones_acordeon["id"].'"
                             style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">';
                            // Verifica si se trata de un comando interno o personal y crea formulario y enlace correspondiente (ambos funcionan igual)
                            if ($registro_opciones_acordeon["tipo_comando"]=="Interno" || $registro_opciones_acordeon["tipo_comando"]=="Personal")
                                {
                                    echo '<input type="hidden" name="PCO_Accion" value="'.$registro_opciones_acordeon["comando"].'"></form>';
                                }
                            // Verifica si se trata de una opcion para cargar un objeto de practico
                            if ($registro_opciones_acordeon["tipo_comando"]=="Objeto")
                                {
                                    echo'<input type="hidden" name="PCO_Accion" value="cargar_objeto">
                                         <input type="hidden" name="objeto" value="'.$registro_opciones_acordeon["comando"].'"></form>';
                                }
                            //Si tiene una URL trata la opcion como enlace estandar, sino como opcion de menu especial
                            if ($registro_opciones_acordeon["url"]!="")
                                echo '<a title="'.$registro_opciones_acordeon["texto"].'" href="'.$registro_opciones_acordeon["url"].'" target="'.$registro_opciones_acordeon["destino"].'">';
                            else
                                echo '<a title="'.$registro_opciones_acordeon["texto"].'" href="javascript:document.acorde_'.$registro_opciones_acordeon["id"].'.submit();">';

							//Determina si la opcion es una imagen o no
							$PCO_EsImagen=0;
							if (strpos($registro_opciones_acordeon["imagen"],".png") || strpos($registro_opciones_acordeon["imagen"],".jpg") || strpos($registro_opciones_acordeon["imagen"],".gif"))
								$PCO_EsImagen=1;
							//Si no detecta ninguna extension de archivo de imagen entonces pone boton en bootstrap
							if (!$PCO_EsImagen)
                            echo '<button type="button" class="btn btn-default btn-outline"><i class="'.$registro_opciones_acordeon["imagen"].' fa-fw"></i>
                                    <span class="btn-xs">'.$registro_opciones_acordeon["texto"].'</span>
                                    </button>';
							else
								echo '<img src="'.$registro_opciones_acordeon["imagen"].'" border="0" />';
                            echo '</a>&nbsp;';
						}
					cerrar_ventana();
				}
			echo '</div>';

	} 
?>
