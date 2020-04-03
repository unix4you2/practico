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
				Title: Modulo kanban
				Ubicacion *[/core/kanban.php]*.  Archivo de funciones relacionadas con la administracion tareas y proyectos bajo metodologia kanban.
			*/
?>
<?php
			/*
				Section: Operaciones basicas de administracion
				Funciones asociadas al mantenimiento de tableros kanban en el sistema.
			*/
?>



<?php
	// Valida sesion activa de Practico
	@session_start();
	if (!isset($PCOSESS_SesionAbierta)) 
		{
			echo '<head><title>Error</title><style type="text/css"> body { background-color: #000000; color: #7f7f7f; font-family: sans-serif,helvetica; } </style></head><body><table width="100%" height="100%" border=0><tr><td align=center>&#9827; Acceso no autorizado !</td></tr></table></body>';
			die();
		}
	//Valida que pueda seguir adelante con la aplicacion
	if (@$PCOSESS_LoginUsuario=="" || @!$PCOSESS_SesionAbierta)
		die();


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_RedireccionATableroKanbanResumido
	Lleva al usuario hasta las lista de tableros kanban

	Ver tambien:
		<PCO_ExplorarTablerosKanban>
*/
	function PCO_RedireccionATableroKanbanResumido()
		{
			echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
				<input type="Hidden" name="PCO_Accion" value="PCO_ExplorarTablerosKanbanResumido">
                <input type="Hidden" name="Presentar_FullScreen" value="'.@$Presentar_FullScreen.'">
                <input type="Hidden" name="Precarga_EstilosBS" value="'.@$Precarga_EstilosBS.'">
				<input type="Hidden" name="PCO_ErrorIcono" value="'.@$PCO_ErrorIcono.'">
				<input type="Hidden" name="PCO_ErrorEstilo" value="'.@$PCO_ErrorEstilo.'">
				<input type="Hidden" name="PCO_ErrorTitulo" value="'.@$PCO_ErrorTitulo.'">
				<input type="Hidden" name="ID_TableroKanban" value="'.@$ID_TableroKanban.'">
				<input type="Hidden" name="PCO_ErrorDescripcion" value="'.@$PCO_ErrorDescripcion.'">
				</form>
			<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
		}
		
	
/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_RedireccionATableroKanban
	Lleva al usuario hasta el tablero kanban

	Ver tambien:
		<PCO_ExplorarTablerosKanban>
*/
	function PCO_RedireccionATableroKanban($ID_TableroKanban="")
		{
			echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
				<input type="Hidden" name="PCO_Accion" value="PCO_ExplorarTablerosKanban">
                <input type="Hidden" name="Presentar_FullScreen" value="'.@$Presentar_FullScreen.'">
                <input type="Hidden" name="Precarga_EstilosBS" value="'.@$Precarga_EstilosBS.'">
				<input type="Hidden" name="PCO_ErrorIcono" value="'.@$PCO_ErrorIcono.'">
				<input type="Hidden" name="PCO_ErrorEstilo" value="'.@$PCO_ErrorEstilo.'">
				<input type="Hidden" name="PCO_ErrorTitulo" value="'.@$PCO_ErrorTitulo.'">
				<input type="Hidden" name="ID_TableroKanban" value="'.@$ID_TableroKanban.'">
				<input type="Hidden" name="PCO_ErrorDescripcion" value="'.@$PCO_ErrorDescripcion.'">
				</form>
			<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: GuardarPersonalizacionKanban
	Actualiza la informacion asociada al tablero kanban y sus propiedades

	Salida:
		Registro actualizado en la tabla de aplicacion

	Ver tambien:
		<PCO_ExplorarTablerosKanban>
*/
	if ($PCO_Accion=="GuardarPersonalizacionKanban")
		{
			// Actualiza los datos
			PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."kanban SET descripcion='$titulos_columnas',compartido_rw='$compartido_rw'    WHERE categoria='[PRACTICO][ColumnasTablero]' AND id='$ID_TableroKanban'  ");
			PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."kanban SET descripcion='$titulos_categorias'  WHERE categoria='[PRACTICO][CategoriasTareas]' AND tablero='$ID_TableroKanban' ");
			PCO_Auditar("Actualiza propiedades de tablero Kanban $ID_TableroKanban");
			PCO_RedireccionATableroKanban($ID_TableroKanban);
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: EliminarTareaKanban
	Elimina la informacion asociada a una tarea sobre el tablero kanban

	Salida:
		Registro eliminado en la tabla de aplicacion

	Ver tambien:
		<PCO_ExplorarTablerosKanban>
*/
	if ($PCO_Accion=="EliminarTareaKanban")
		{
			// Elimina los datos
			PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."kanban WHERE id=?","$IdTareaKanban");
			PCO_Auditar("Elimina tarea Kanban $IdTareaKanban");
			PCO_RedireccionATableroKanban($ID_TableroKanban);
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: ArchivarTareaKanban
	Saca una tarea del tablero (esta debe estar primero en su ultima columna) y la pasa al historico de tareas

	Salida:
		Registro de tarea actualizado, tablero visualizado sin la tarea indicada

	Ver tambien:
		<PCO_ExplorarTablerosKanban>
*/
	if ($PCO_Accion=="ArchivarTareaKanban")
		{
			// Elimina los datos
			PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."kanban SET archivado=1 WHERE id=?","$IdTareaKanban");
			PCO_Auditar("Archiva tarea Kanban $IdTareaKanban");
			PCO_RedireccionATableroKanban($ID_TableroKanban);
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: GuardarTareaKanban
	Almacena la informacion asociada a una tarea sobre el tablero kanban

	Salida:
		Registro almacenado en la tabla de aplicacion

	Ver tambien:
		<PCO_ExplorarTablerosKanban>
*/
	if ($PCO_Accion=="GuardarTareaKanban")
		{
			$mensaje_error="";
			// Elimina los datos
			PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."kanban (login_admintablero,titulo,descripcion,asignado_a,categoria,columna,peso,estilo,fecha,archivado,compartido_rw,tablero,porcentaje) VALUES ('$PCOSESS_LoginUsuario','$titulo','$descripcion','$asignado_a','$categoria','$columna','$peso','$estilo','$fecha','0','',$ID_TableroKanban,'$porcentaje') ");
			PCO_Auditar("Agrega tarea Kanban a tablero $ID_TableroKanban");
			PCO_RedireccionATableroKanban($ID_TableroKanban);
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: GuardarCreacionKanban
	Crea un nuevo tablero para el usuario activo

	Salida:
		Registro almacenado en la tabla de aplicacion

	Ver tambien:
		<PCO_ExplorarTablerosKanban>
*/
	if ($PCO_Accion=="GuardarCreacionKanban")
		{
			$mensaje_error="";
			// Agrega los datos
			PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."kanban (login_admintablero,titulo,descripcion,asignado_a,categoria,columna,peso,estilo,fecha,archivado,compartido_rw) VALUES ('$PCOSESS_LoginUsuario','$titulo_tablero','$titulos_columnas','','[PRACTICO][ColumnasTablero]','-2','0','','20000101','0','') ");
			$idObjetoInsertado=PCO_ObtenerUltimoIDInsertado($ConexionPDO);
			PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."kanban (login_admintablero,titulo,descripcion,asignado_a,categoria,columna,peso,estilo,fecha,archivado,compartido_rw,tablero) VALUES ('$PCOSESS_LoginUsuario','','$titulos_categorias','','[PRACTICO][CategoriasTareas]','-2','0','','20000101','0','',$idObjetoInsertado) ");
			PCO_Auditar("Agrega Tablero Kanban $titulo_tablero Id:$idObjetoInsertado");
			$_SESSION["PCOSESS_TableroKanbanActivo"]=(string)$idObjetoInsertado;
			PCO_RedireccionATableroKanban($idObjetoInsertado);
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: EliminarTableroKanban
	Elimina el tablero seleccionado junto con todas sus tareas

	Salida:
		Registros eliminados

	Ver tambien:
		<PCO_ExplorarTablerosKanban>
*/
	if ($PCO_Accion=="EliminarTableroKanban")
		{
			$mensaje_error="";
			// Elimina los datos
			PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."kanban WHERE id=$ID_TableroKanban ");
			PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."kanban WHERE tablero=$ID_TableroKanban ");
			PCO_Auditar("Elimina Tablero Kanban $ID_TableroKanban");
			PCO_RedireccionATableroKanbanResumido();
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: VerTareasArchivadas
	Presenta una lista de todas las tareas archivadas sobre un tablero kanban

	Salida:
		Reporte ID -3

	Ver tambien:
		<PCO_ExplorarTablerosKanban>
*/
	if ($PCO_Accion=="VerTareasArchivadas")
		{
		    $BotonRetorno = '<a class="btn btn-info" data-toggle="tooltip" data-html="true" href=\''.$ArchivoCORE.'?PCO_Accion=PCO_ExplorarTablerosKanban&ID_TableroKanban='.$ID_TableroKanban.'\'><i class="fa fa-arrow-left"></i> '.$MULTILANG_TablerosKanban.'</a><br><br>';
		    echo $BotonRetorno;
		    PCO_CargarInforme(-3,1,"","",1);
		    echo $BotonRetorno;
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_AgregarFuncionesEdicionTarea
	Genera el codigo HTML y CSS correspondiente los botones y demas elementos para la edicion en caliente de un objeto

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		tipo_elemento - Tipo de elemento a ser generado

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
	function PCO_AgregarFuncionesEdicionTarea($RegistroTareas,$ColumnasDisponibles,$ID_TableroKanban,$ResultadoColumnas)
		{
		    global $PCOSESS_LoginUsuario,$MULTILANG_ArchivarTareaAdv,$MULTILANG_ArchivarTarea,$MULTILANG_DelKanban,$MULTILANG_Evento,$TablasCore,$MULTILANG_Cerrar,$ArchivoCORE,$MULTILANG_Editar,$MULTILANG_FrmAdvDelCampo,$MULTILANG_Eliminar,$MULTILANG_FrmAumentaPeso,$MULTILANG_FrmDisminuyePeso,$MULTILANG_Anterior,$MULTILANG_Columna,$MULTILANG_Siguiente;
			$salida='';
            //Determina estados de activacion o no para controles segun valores actuales del registro
            $EstadoDeshabilitadoMoverIzquierda="";
            $EstadoDeshabilitadoMoverDerecha="";
            $EstadoDeshabilitadoMoverArriba="";
            if($RegistroTareas["columna"]-1<=0) $EstadoDeshabilitadoMoverIzquierda="disabled";
            if($RegistroTareas["columna"]+1>$ColumnasDisponibles) $EstadoDeshabilitadoMoverDerecha="disabled";
            if($RegistroTareas["peso"]-1<=0) $EstadoDeshabilitadoMoverArriba="disabled";

            //Determina si la tarea esta en la ultima columna (candidata a ser archivada)
            $ComplementoArchivar="";
            if ($RegistroTareas["columna"]==$ColumnasDisponibles && $PCOSESS_LoginUsuario==$ResultadoColumnas["login_admintablero"])
                $ComplementoArchivar='&nbsp;&nbsp;<a onclick=\'return confirm("'.$MULTILANG_ArchivarTareaAdv.'");\' href=\''.$ArchivoCORE.'?PCO_Accion=ArchivarTareaKanban&ID_TableroKanban='.$ID_TableroKanban.'&IdTareaKanban='.$RegistroTareas["id"].'\' class="btn btn-warning btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_ArchivarTarea.'"><i class="fa fa-archive"></i></a>';

            //Determina si la tarea se puede o no eliminar
            $ComplementoEliminar="";
            if ($PCOSESS_LoginUsuario==$ResultadoColumnas["login_admintablero"])
                $ComplementoEliminar='<a onclick=\'return confirm("'.$MULTILANG_DelKanban.'");\' href=\''.$ArchivoCORE.'?PCO_Accion=EliminarTareaKanban&ID_TableroKanban='.$ID_TableroKanban.'&ID_TableroKanban='.$ID_TableroKanban.'&IdTareaKanban='.$RegistroTareas["id"].'\' class="btn btn-danger btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Eliminar.'"><i class="fa fa-trash"></i></a>';


            //Pone controles
            $salida='<div id="PCOEditorContenedor_Col'.$RegistroTareas["columna"].'_'.$RegistroTareas["id"].'" style="margin:2px; display:none; visibility:hidden; position: absolute; z-index:1000;">
                    <div align="center" style="display: inline-block">
                        <!--<a class="btn btn-xs btn-warning" data-toggle="tooltip" data-html="true" data-placement="top" title="'.$MULTILANG_Editar.'" href=\''.$ArchivoCORE.'?PCO_Accion=PCO_EditarFormulario&campo='.$RegistroTareas["id"].'&formulario='.$RegistroTareas["formulario"].'&popup_activo=FormularioCampos&nombre_tabla='.$registro_formulario["tabla_datos"].'\'><i class="fa fa-fw fa-pencil"></i></a>-->
                        <a class="btn btn-xs btn-info '.$EstadoDeshabilitadoMoverIzquierda.'"           data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Anterior.' '.$MULTILANG_Columna.'" href=\''.$ArchivoCORE.'?PCO_Accion=cambiar_estado_campo&id='.$RegistroTareas["id"].'&tabla=kanban&campo=columna&accion_retorno=PCO_ExplorarTablerosKanban&ID_TableroKanban='.$ID_TableroKanban.'&valor='.($RegistroTareas["columna"]-1).'\'><i class="fa fa-arrow-left"></i></a>
                        <a class="btn btn-xs btn-info" data-toggle="tooltip" data-html="true"           data-placement="top" title="'.$MULTILANG_FrmAumentaPeso.' a '.($RegistroTareas["peso"]+1).'" href=\''.$ArchivoCORE.'?PCO_Accion=cambiar_estado_campo&id='.$RegistroTareas["id"].'&tabla=kanban&campo=peso&accion_retorno=PCO_ExplorarTablerosKanban&ID_TableroKanban='.$ID_TableroKanban.'&valor='.($RegistroTareas["peso"]+1).'\'><i class="fa fa-arrow-down"></i></a>
                        <a class="btn btn-xs btn-info '.$EstadoDeshabilitadoMoverArriba.'"              data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_FrmDisminuyePeso.' a '.($RegistroTareas["peso"]-1).'" href=\''.$ArchivoCORE.'?PCO_Accion=cambiar_estado_campo&id='.$RegistroTareas["id"].'&tabla=kanban&campo=peso&accion_retorno=PCO_ExplorarTablerosKanban&ID_TableroKanban='.$ID_TableroKanban.'&valor='.($RegistroTareas["peso"]-1).'\'><i class="fa fa-arrow-up"></i></a>
                        <a class="btn btn-xs btn-info '.$EstadoDeshabilitadoMoverDerecha.'"             data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Siguiente.' '.$MULTILANG_Columna.'" href=\''.$ArchivoCORE.'?PCO_Accion=cambiar_estado_campo&id='.$RegistroTareas["id"].'&tabla=kanban&campo=columna&accion_retorno=PCO_ExplorarTablerosKanban&ID_TableroKanban='.$ID_TableroKanban.'&valor='.($RegistroTareas["columna"]+1).'\'><i class="fa fa-arrow-right"></i></a>
                        '.$ComplementoEliminar.'
                        '.$ComplementoArchivar.'
                    </div>
                </div>';

			return $salida;
		}


//#################################################################################
//#################################################################################
//Presenta una tarea especifica tomando la informacion desde un registro de BD
	function PCO_PresentarTareaKanban($RegistroTareas,$ColumnasDisponibles,$ID_TableroKanban,$ResultadoColumnas)
		{
		    global $PCO_FechaOperacion;
		    global $MULTILANG_FechaLimite,$MULTILANG_AsignadoA,$MULTILANG_InfCategoria,$MULTILANG_DelKanban,$MULTILANG_Finalizado;
            
            $EtiquetaIconoTareas=  "<i href='javascript:return false;' class='fa fa-fw fa-thumb-tack' data-toggle='tooltip' data-placement='top' title='".$RegistroTareas["categoria"]."' ></i>";
            $EtiquetaPersonas=  "<i href='javascript:return false;' class='fa fa-fw fa-users' data-toggle='tooltip' data-placement='top' title='".$MULTILANG_AsignadoA.": ".$RegistroTareas["asignado_a"]."' ></i>";
            $EtiquetaCalendario="<i href='javascript:return false;' class='fa fa-fw fa-calendar' data-toggle='tooltip' data-placement='top' title='".$MULTILANG_FechaLimite.": ".$RegistroTareas["fecha"]."' ></i>";

		    //Determina el estilo por defecto para el cuadro
		    $EstiloCuadro=$RegistroTareas["estilo"];
            //Genera la salida
            $AccionesTarea=PCO_AgregarFuncionesEdicionTarea($RegistroTareas,$ColumnasDisponibles,$ID_TableroKanban,$ResultadoColumnas);

            $EventoComplemento='onmouseenter="$(this).css(\'border\', \'1px solid\'); $(this).css(\'border-color\', \'#ff0000\');  //c2a7a7
            $(\'#PCOEditorContenedor_Col'.$RegistroTareas["columna"].'_'.$RegistroTareas["id"].'\').css({\'visibility\':\'visible\'});
            $(\'#PCOEditorContenedor_Col'.$RegistroTareas["columna"].'_'.$RegistroTareas["id"].'\').css({\'display\':\'block\'}); "
            onmouseleave="$(this).css(\'border\', \'0px solid\'); $(\'#PCOEditorContenedor_Col'.$RegistroTareas["columna"].'_'.$RegistroTareas["id"].'\').css({\'visibility\':\'hidden\'}); $(\'#PCOEditorContenedor_Col'.$RegistroTareas["columna"].'_'.$RegistroTareas["id"].'\').css({\'display\':\'none\'});  "';

            $Salida = '
                <div id="Dragable'.$RegistroTareas["id"].'" draggable="true" ondragstart="Arrastrar(event,'.$RegistroTareas["id"].')">
                <div class="panel panel-'.$EstiloCuadro.'" '.$EventoComplemento.'>
                    <div class="panel-heading">
                        <div class="row">
                            <div>&nbsp;
                                '.$EtiquetaIconoTareas.'
                                '.$EtiquetaCalendario.'
                                '.$EtiquetaPersonas.'
                                &nbsp;&nbsp;<i>'.$MULTILANG_Finalizado.'</i>
                                <select id="porcentaje" name="porcentaje" style="color:darkblue; font-weight: bold; border:0px; background-color: transparent;" onchange="document.location=\''.$ArchivoCORE.'?PCO_Accion=cambiar_estado_campo&id='.$RegistroTareas["id"].'&tabla=kanban&campo=porcentaje&accion_retorno=PCO_ExplorarTablerosKanban&ID_TableroKanban='.$ID_TableroKanban.'&valor=\'+this.value;">';
                                for ($i=0;$i<=100;$i++)
                                    {
                                        $EstadoSeleccion="";
                                        if ($i==$RegistroTareas["porcentaje"])
                                            $EstadoSeleccion="SELECTED";
                                        $Salida .= '<option value="'.$i.'" '.$EstadoSeleccion.'>'.$i.'%</option>';
                                    }
            $Salida .='         </select>
                            </div>
                            <div class="text-center">
                                <div class="btn-xs">
                                <b>'.$RegistroTareas["titulo"].'</b>
                                </div>
                            </div>
                            <div class="text-left">
                                <div class="btn-xs">
                                <hr style="border-top: 1px dotted; margin:0; padding:0;">
                                '.nl2br($RegistroTareas["descripcion"]).'
                                </div>
                            </div>
                            <div class="text-center">
                                '.$AccionesTarea.'<br>
                            </div>
                        </div>
                    </div>
                </div>
                </div>';
            return $Salida;
		}


//#################################################################################
//#################################################################################
//Presenta un tablero completo de Kanban
function PCO_PresentarTableroKanban($ID_TableroKanban)
	{
		    global $ArchivoCORE,$PCO_FechaOperacion,$TablasCore,$PCOSESS_LoginUsuario;
		    global $MULTILANG_ZonaPeligro,$MULTILANG_Confirma,$MULTILANG_TablerosKanban,$MULTILANG_Eliminar,$MULTILANG_TareasArchivadas,$MULTILANG_Atencion,$MULTILANG_Configuracion;
            global $MULTILANG_ArrastrarTarea,$MULTILANG_AgregarNuevaTarea,$MULTILANG_CrearTablero,$MULTILANG_FechaLimite;
            global $MULTILANG_Personalizado,$MULTILANG_ListaColumnas,$MULTILANG_FrmDesLista2,$MULTILANG_TitObligatorio,$MULTILANG_ListaCategorias,$MULTILANG_CompartirCon;
            global $MULTILANG_Guardar,$MULTILANG_Cancelar,$MULTILANG_InfDescripcion,$MULTILANG_DesTarea;
            global $MULTILANG_FrmTituloBot,$MULTILANG_Plantilla,$MULTILANG_Ninguno,$MULTILANG_Historia1Des,$MULTILANG_Historia2Des,$MULTILANG_Historia3Des;
            global $MULTILANG_Historia1,$MULTILANG_Historia2,$MULTILANG_Historia3,$PCO_FechaOperacionGuiones,$MULTILANG_Columna;
            global $funciones_activacion_datepickers,$IdiomaPredeterminado,$MULTILANG_FrmEstilo,$MULTILANG_InfCategoria,$MULTILANG_Finalizado;
            global $MULTILANG_BtnEstiloPredeterminado,$MULTILANG_BtnEstiloPrimario,$MULTILANG_BtnEstiloFinalizado,$MULTILANG_BtnEstiloInformacion,$MULTILANG_BtnEstiloAdvertencia,$MULTILANG_BtnEstiloPeligro;
            global $MULTILANG_AsignadoA,$MULTILANG_SeleccioneUno,$MULTILANG_AsignadoADes,$MULTILANG_Peso,$MULTILANG_Prioridad;
            global $CadenaTablerosDisponibles,$MULTILANG_Actualizar,$MULTILANG_InfDataTableRegTotal,$MULTILANG_Tareas,$MULTILANG_ListaCategorias;

            //Busca las columnas definidas en el tablero
            $ResultadoColumnas=PCO_EjecutarSQL("SELECT descripcion,compartido_rw,login_admintablero,titulo FROM ".$TablasCore."kanban WHERE id='$ID_TableroKanban' ")->fetch();
            $ArregloColumnasTablero=explode(",",$ResultadoColumnas["descripcion"]);
            $ResultadoCategorias=PCO_EjecutarSQL("SELECT descripcion FROM ".$TablasCore."kanban WHERE categoria='[PRACTICO][CategoriasTareas]' AND tablero='$ID_TableroKanban' ")->fetch();
            $ArregloCategoriasTareas=explode(",",$ResultadoCategorias["descripcion"]);
    ?>

        <!-- INICIO MODAL  PERSONALIZACION COLUMNAS Y CATEGORIAS -->
            <?php PCO_AbrirDialogoModal("myModalPersonalizarKanban".$ID_TableroKanban,$MULTILANG_TablerosKanban." ".$MULTILANG_Personalizado); ?>
    			<form name="datospersonalizacion<?php echo $ID_TableroKanban; ?>" id="datospersonalizacion<?php echo $ID_TableroKanban; ?>" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    				<input type="Hidden" name="PCO_Accion" value="GuardarPersonalizacionKanban">
    				<input type="Hidden" name="ID_TableroKanban" value="<?php echo $ID_TableroKanban; ?>">
    
            		<div class="row">
            			<div class="col col-md-12">
                                <label for="titulos_columnas"><?php echo $MULTILANG_ListaColumnas; ?> (<?php echo $MULTILANG_FrmDesLista2; ?>)</label>
                                <div class="form-group input-group">
                                    <input type="text" id="titulos_columnas" name="titulos_columnas" class="form-control" value="<?php echo $ResultadoColumnas["descripcion"]; ?>">
                                    <span class="input-group-addon">
                                        <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    </span>
                                </div>
    
                                <label for="titulos_categorias"><?php echo $MULTILANG_ListaCategorias; ?> (<?php echo $MULTILANG_FrmDesLista2; ?>)</label>
                                <div class="form-group input-group">
                                    <input type="text" id="titulos_categorias" name="titulos_categorias" class="form-control" value="<?php echo $ResultadoCategorias["descripcion"]; ?>">
                                    <span class="input-group-addon">
                                        <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    </span>
                                </div>

                                <label for="compartido_rw"><?php echo $MULTILANG_CompartirCon; ?></label>
                                <div class="form-group input-group">
                                    <textarea class="input input-sm btn-block" id="compartido_rw" name="compartido_rw"><?php echo $ResultadoColumnas["compartido_rw"]; ?></textarea>
                                    <span class="input-group-addon">
                                        <a  href="#" data-toggle="tooltip" data-html="true"  title="Encerrados siempre por barras de canalizacion. Ej: |pepito.perez|maria.robles|<br>Always enclosed by pipes. Ej: |pepito.perez|maria.robles|"><i class="fa fa-info"></i></a>
                                    </span>
                                </div>
            			</div>
            		</div>
                </form>
            <?php 
                $barra_herramientas_modal='
                    <input type="Button" class="btn btn-success" value="'.$MULTILANG_Guardar.'" onClick="document.datospersonalizacion'.$ID_TableroKanban.'.submit()">
                    <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cancelar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
                PCO_CerrarDialogoModal($barra_herramientas_modal);
            ?>
        <!-- FIN MODAL PERSONALIZACION COLUMNAS Y CATEGORIAS -->

            <!-- INICIO MODAL ADICION DE TAREAS -->
            <?php PCO_AbrirDialogoModal("myModalActividadKanban".$ID_TableroKanban,$MULTILANG_AgregarNuevaTarea,"modal-wide"); ?>
    			<form name="datosfield<?php echo $ID_TableroKanban; ?>" id="datosfield<?php echo $ID_TableroKanban; ?>" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    				<input type="Hidden" name="PCO_Accion" value="GuardarTareaKanban">
    
            		<div class="row">
            			<div class="col col-md-6">
            
                                <div class="form-group input-group">
                                    <input type="text" name="titulo" class="form-control" placeholder="<?php echo $MULTILANG_FrmTituloBot; ?>">
                                    <span class="input-group-addon">
                                        <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    </span>
                                </div>
    
                                <label for="plantilla"><?php echo $MULTILANG_Plantilla; ?></label>
                                <div class="form-group input-group">
                                    <select id="plantilla" name="plantilla" class="form-control" onchange="document.datosfield<?php echo $ID_TableroKanban; ?>.descripcion.value=this.value.replace(/BR/g,'\n');">
            							<option value=""><?php echo $MULTILANG_Ninguno; ?></option>
                                        <option value="<?php echo $MULTILANG_Historia1Des; ?>"><?php echo $MULTILANG_Historia1; ?></option>
                                        <option value="<?php echo $MULTILANG_Historia2Des; ?>"><?php echo $MULTILANG_Historia2; ?></option>
                                        <option value="<?php echo $MULTILANG_Historia3Des; ?>"><?php echo $MULTILANG_Historia3; ?></option>
                                    </select>
                                    <span class="input-group-addon">
                                        <a  href="#" data-toggle="tooltip" data-html="true"  title="Plantillas de texto predisenadas / Text templates"><i class="fa fa-question-circle text-info"></i></a>
                                    </span>
                                </div>
    
                                <div class="form-group input-group">
                                    <textarea name="descripcion" id="descripcion" rows="15" class="form-control" placeholder="<?php echo $MULTILANG_InfDescripcion; ?> (Se admite HTML / This allow HTML)"></textarea>
                                    <span class="input-group-addon">
                                        <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_DesTarea; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                    </span>
                                </div>
            
            			</div>
            			<div class="col col-md-6">
            
            					<div class="row">
            						<div class="col col-md-6">
            							<label for="fecha"><?php echo $MULTILANG_FechaLimite; ?>:</label>
                                        <div class="form-group input-group">
                                            <input type="text" data-date-format="YYYY-MM-DD" name="fecha" value="<?php echo $PCO_FechaOperacionGuiones; ?>" id="fecha" readonly  class="form-control">
                                            <?php
                                                @$funciones_activacion_datepickers.="
                                                    $(function () {
                                                        $('#fecha').datetimepicker({
                                                            language: '$IdiomaPredeterminado',
                                                            pickTime: false
                                                        });
                                                    });";
                                            ?>
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-calendar"></i>
                                            </span>
                                        </div>
            						</div>
            						<div class="col col-md-6">
            							<label for="estilo"><?php echo $MULTILANG_FrmEstilo; ?> (color):</label>
            							<div class="form-group input-group">
            								<select id="estilo" name="estilo" class="selectpicker">
            									<option value=""><?php echo $MULTILANG_Ninguno; ?></option>
            									<option value="default "><?php echo $MULTILANG_BtnEstiloPredeterminado; ?> (gris)</option>
            									<option value="primary "><?php echo $MULTILANG_BtnEstiloPrimario; ?> (azul oscuro)</option>
            									<option value="success "><?php echo $MULTILANG_BtnEstiloFinalizado; ?> (verde)</option>
            									<option value="info "><?php echo $MULTILANG_BtnEstiloInformacion; ?> (azul claro)</option>
            									<option value="warning "><?php echo $MULTILANG_BtnEstiloAdvertencia; ?> (naranja)</option>
            									<option value="danger "><?php echo $MULTILANG_BtnEstiloPeligro; ?> (rojo)</option>
            								</select>
            							</div>
            						</div>
            					</div>
            
            					<div class="row">
            						<div class="col col-md-6">
                                        <label for="asignado_a"><?php echo $MULTILANG_AsignadoA; ?></label>
                                        <div class="form-group input-group">
                                            <select id="asignado_a" name="asignado_a" class="selectpicker" data-live-search=true>
                                                <option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
                                                <?php
                                                    $ResultadoUsuarios=PCO_EjecutarSQL("SELECT login,nombre FROM ".$TablasCore."usuario ORDER BY login");
                                                    while($RegistroUsuario=$ResultadoUsuarios->fetch())
                                                        echo "<option value='".$RegistroUsuario["login"]."'>".$RegistroUsuario["nombre"]." (".$RegistroUsuario["login"].") </option>";
                                                ?>
                                            </select>
                                            <span class="input-group-addon">
                                                <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_AsignadoADes; ?>"><i class="fa fa-question-circle text-info"></i></a>
                                            </span>
                                        </div>
            						</div>
            						<div class="col col-md-6">
                                        <label for="categoria"><?php echo $MULTILANG_InfCategoria; ?></label>
                                        <div class="form-group input-group">
                                            <select id="categoria" name="categoria" class="selectpicker">
                                                <option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
                                                <?php
                                                    foreach ($ArregloCategoriasTareas as $NombreCategoria)
                                                        echo "<option value='$NombreCategoria'>$NombreCategoria</option>";
                                                ?>
                                            </select>
                                        </div>
            						</div>
            					</div>
    
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="columna"><?php echo $MULTILANG_Columna; ?></label>
                                        <div class="form-group input-group">
                                            <select id="columna" name="columna" class="form-control" data-style="btn-warning">
                                                <?php
                                                    $ConteoColumna=1;
                                                    foreach ($ArregloColumnasTablero as $NombreColumna)
                                                        {
                                                            echo "<option value='$ConteoColumna'>$ConteoColumna. $NombreColumna</option>";
                                                            $ConteoColumna++;
                                                        }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="peso"><?php echo $MULTILANG_Peso; ?> (<?php echo $MULTILANG_Prioridad; ?>)</label>
                                        <div class="form-group input-group">
                                            <select id="peso" name="peso" class="selectpicker">
                                                <?php
                                                    for ($i=1;$i<=100;$i++)
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="porcentaje"><?php echo $MULTILANG_Finalizado; ?> (%)</label>
                                        <div class="form-group input-group">
                                            <select id="porcentaje" name="porcentaje" class="form-control" data-style="btn-warning">
                                                <?php
                                                    for ($i=0;$i<=100;$i++)
                                                        echo '<option value="'.$i.'">'.$i.' %</option>';
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="ID_TableroKanban">ID Kanban</label>
                                        <div class="form-group input-group">
                                            <input type="Text" id="ID_TableroKanban" name="ID_TableroKanban" value="<?php echo $ID_TableroKanban; ?>" readonly  class="form-control">
                                        </div>
                                    </div>
                                </div>
    
            			</div>
            		</div>
                </form>
        <?php 
            $barra_herramientas_modal='
                <input type="Button" class="btn btn-success" value="'.$MULTILANG_AgregarNuevaTarea.'" onClick="document.datosfield'.$ID_TableroKanban.'.submit()">
                <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cancelar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
            PCO_CerrarDialogoModal($barra_herramientas_modal);
        ?>
        <!-- FIN MODAL ADICION DE TAREAS -->


<?php
        //Si el usuario es el mismo creador o propietario del tablero le da la posibilidad de eliminarlo
        $ComplementoHerramientasEliminacion="";
        if ($PCOSESS_LoginUsuario==$ResultadoColumnas["login_admintablero"])
            $ComplementoHerramientasEliminacion='<div class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick=\'return confirm(" '.$MULTILANG_Atencion.'  '.$MULTILANG_Atencion.'  '.$MULTILANG_Atencion.' \\n---------------------------------------------\\n '.$MULTILANG_Eliminar.' '.$MULTILANG_TablerosKanban.'\\n\\n\\n'.$MULTILANG_Confirma.'");\' href=\''.$ArchivoCORE.'?PCO_Accion=EliminarTableroKanban&ID_TableroKanban='.$ID_TableroKanban.'\' class="btn btn-danger btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_ZonaPeligro.'!!!<br><b>'.$MULTILANG_Eliminar.' '.$MULTILANG_TablerosKanban.'</b>"><i class="fa fa-trash"></i></a></div>';

        //Cuenta el numero de tareas en el tablero
        $CantidadTareasTotal=PCO_EjecutarSQL("SELECT COUNT(*) as conteo FROM {$TablasCore}kanban WHERE tablero='$ID_TableroKanban' AND categoria<>'[PRACTICO][ColumnasTablero]' AND categoria<>'[PRACTICO][CategoriasTareas]' ")->fetchColumn();
        $CantidadTareasArchivadas=PCO_EjecutarSQL("SELECT COUNT(*) as conteo FROM {$TablasCore}kanban WHERE archivado=1 AND tablero='$ID_TableroKanban' ")->fetchColumn();
        $PorcentajeTotalAvance=0;
        if ($CantidadTareasTotal!=0)
            $PorcentajeTotalAvance=round($CantidadTareasArchivadas*100/$CantidadTareasTotal);

        $ComplementoHerramientasArchivadas="";
        if ($ID_TableroKanban!="")
            $ComplementoHerramientasArchivadas="<div class='pull-left'>
                                                    <a class='btn btn-default btn-xs' href='".$ArchivoCORE."?PCO_Accion=VerTareasArchivadas&ID_TableroKanban=$ID_TableroKanban'>
                                                        <i class='fa fa-archive fa-fw fa-1x'></i> $MULTILANG_TareasArchivadas <b>($CantidadTareasArchivadas $MULTILANG_InfDataTableRegTotal)</b>
                                                    </a>
                                                </div>";

        $ComplementoHerramientasPersonalizacion="";
        if ($ID_TableroKanban!="" && $PCOSESS_LoginUsuario==$ResultadoColumnas["login_admintablero"])
            $ComplementoHerramientasPersonalizacion="<div class='pull-right'><div class='btn btn-inverse btn-xs' onclick='$(\"#myModalPersonalizarKanban$ID_TableroKanban\").modal(\"show\");'><i class='fa fa-cogs fa-fw fa-1x'></i> $MULTILANG_Configuracion</div></div>";

        echo "
            <!-- Barra de herramientas del tablero -->
            <div class='well well-sm'>
                <div class='row'>
                    <div align=center style='font-size:18px;' class='col col-md-12 col-sm-12 col-lg-12 col-xs-12'>
                        <i class='fa fa-sticky-note text-orange' style='color:orange'></i> Kanban <b>".$ResultadoColumnas["titulo"]." </b><i>(ID: $ID_TableroKanban $MULTILANG_Tareas: $CantidadTareasTotal)</i>
                    </div>
                </div>
                <div class='row'>
                    <div class='col col-md-5 col-sm-5 col-lg-5 col-xs-5'>
                        <div class='pull-left btn-xs'> <a class='btn btn-primary btn-xs' onclick='document.recarga_tablero_kanban.CadenaTablerosAVisualizar.value=$ID_TableroKanban; document.recarga_tablero_kanban.submit();'><i class='fa fa-refresh'></i> $MULTILANG_Actualizar</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
                        $ComplementoHerramientasArchivadas
                    </div>
                    <div class='col col-md-2 col-sm-2 col-lg-2 col-xs-2'>
                        <div class='progress'>
                            <div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' aria-valuenow='{$PorcentajeTotalAvance}' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>
                                <b>{$PorcentajeTotalAvance}%</b> {$MULTILANG_Finalizado}
                            </div>
                        </div>
                    </div>
                    <div class='col col-md-5 col-sm-5 col-lg-5 col-xs-5'>
                        $ComplementoHerramientasEliminacion
                        <div class='pull-right'></div>
                        $ComplementoHerramientasPersonalizacion
                    </div>
                </div>
            </div>";

        //Estadisticas basicas del tablero 
        echo "
                <table width='100%' border=0 cellspacing=15 cellpadding=15>
                    <tr>
                        <td valign=top align=center>
                            <b><i class='fa fa-tags fa-fw fa-2x'></i>Actividades por categor&iacute;a / Activities by cathegory</b><br>";
                            PCO_CargarInforme(0,0,"","",1,0,0,0,"SELECT categoria as '{$MULTILANG_ListaCategorias}', COUNT(*) as '{$MULTILANG_Tareas}'  FROM {$TablasCore}kanban WHERE tablero='$ID_TableroKanban' AND categoria<>'[PRACTICO][ColumnasTablero]' AND categoria<>'[PRACTICO][CategoriasTareas]' GROUP BY categoria ORDER BY categoria ");
        echo "          </td>
                        <td>&nbsp;&nbsp;</td>
                        <td valign=top align=center>
                            <b><i class='fa fa-user fa-fw fa-2x'></i>Tareas por usuario / Tasks by user</b><br>";
                            PCO_CargarInforme(0,0,"","",1,0,0,0,"SELECT asignado_a as '{$MULTILANG_AsignadoA}', COUNT(*) as '{$MULTILANG_Tareas}' FROM {$TablasCore}kanban WHERE tablero='$ID_TableroKanban' AND categoria<>'[PRACTICO][ColumnasTablero]' AND categoria<>'[PRACTICO][CategoriasTareas]' GROUP BY asignado_a ORDER BY asignado_a ");
        echo "          </td>
                    </tr>
                </table>";

        echo "<!-- Tareas definidas en el tablero -->
            <div class='panel panel-default well'>
                <table border=1 width='100%' class='table table-responsive table-condensed btn-xs' style='border: 1px solid lightgray;'><tr>";

                            //Recorre las columnas del tablero
                            $ConteoColumna=1;
                            $ColumnasDisponibles=count($ArregloColumnasTablero);
                            $AnchoColumnas=round(100/$ColumnasDisponibles);
                            foreach ($ArregloColumnasTablero as $NombreColumna) {
                                //Cuenta el numero de tareas en esta columna VS la cantidad de tareas activas en el tablero para obtener el porcentaje de representacion en el tablero
                                $CantidadTareasColumna=PCO_EjecutarSQL("SELECT COUNT(*) as conteo FROM {$TablasCore}kanban WHERE columna=$ConteoColumna AND archivado=0 AND tablero='$ID_TableroKanban' ")->fetchColumn();
                                $PorcentajeTotalAvanceColumna=0;
                                if ($CantidadTareasTotal-$CantidadTareasArchivadas!=0)
                                    $PorcentajeTotalAvanceColumna=round($CantidadTareasColumna*100/($CantidadTareasTotal-$CantidadTareasArchivadas));
                                
                                echo "<td  valign=top width='$AnchoColumnas%'>";
                                echo "<div data-toggle='tooltip' data-html='true'  data-placement='top' title='".$MULTILANG_ArrastrarTarea."' class='btn pull-left' id='MarcoBotonOcultar".$ConteoColumna."' ondrop='Soltar(event,$ConteoColumna)' ondragover='PermitirSoltar(event,$ConteoColumna)'><i class='fa-1x'><i class='fa fa-stack-overflow'></i> <b>".$NombreColumna."</b> <font color=red>{$PorcentajeTotalAvanceColumna}%</font></i></div>";
                                echo "<div data-toggle='tooltip' data-html='true'  data-placement='top' title='<b>".$MULTILANG_AgregarNuevaTarea.":</b> ".$NombreColumna."' class='btn text-primary btn-xs pull-right' onclick='$(\"#myModalActividadKanban$ID_TableroKanban\").modal(\"show\"); document.datosfield$ID_TableroKanban.columna.value=$ConteoColumna;'><i class='fa fa-plus fa-fw fa-2x'></i></div>";
                                
                                echo "<br>";
                                
                                echo "<div id='MarcoTareasColumna$ConteoColumna'>
                                <br><br><div id='ColumnaKanbanMarcoArrastre".$ConteoColumna."'></div>";
                                //Busca las tarjetas de la columna siempre y cuando no esten ya archivadas
                                $ResultadoTareas=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."kanban WHERE archivado<>1 AND columna=$ConteoColumna AND tablero='$ID_TableroKanban' ORDER BY peso ASC ");
                                while ($RegistroTareas=$ResultadoTareas->fetch())
                                    echo PCO_PresentarTareaKanban($RegistroTareas,$ColumnasDisponibles,$ID_TableroKanban,$ResultadoColumnas);
                                echo "</div></td>";
                                $ConteoColumna++;
                            }

        echo "  <tr></table>";
        echo "</div>";

		}


//#################################################################################
//#################################################################################
/*
	Function: PCO_ExplorarTablerosKanban
	PResenta la lista de tableros kanban a los que el usuario tiene acceso y permite realizar operaciones en cada uno

	Variables de entrada:

		multiples - Recibidas mediante formulario unico asociado al proceso

	Salida:
		Tablero predeterminado en pantalla, junto con lista de seleccion para cargar otros tableros
*/
if (@$PCO_Accion=="PCO_ExplorarTablerosKanban")
    {
        //Si recibe un ID de tablero desde el informe de resumen entonces lo usa para ser visualizado
        if ($PCO_Valor!="" || $PCOSESS_TableroKanbanActivo!="")
            {
                if ($PCO_Valor!="") { $CadenaTablerosAVisualizar=$PCO_Valor; $_SESSION["PCOSESS_TableroKanbanActivo"]=(string)$PCO_Valor; }
                if ($PCOSESS_TableroKanbanActivo!="" && $PCO_Valor=="") $CadenaTablerosAVisualizar=$PCOSESS_TableroKanbanActivo;
                //Establece una variable de sesion para saber en que tablero esta trabajando en el momento
            }
        //Agrega boton de regreso al escritorio
        echo '<div align=center>
                <a href="index.php" class="btn btn-warning"><i class="fa fa-fw fa-chevron-circle-left"></i>'.$MULTILANG_FrmAccionRegresar.'</a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="javascript:document.PCO_ExplorarTablerosKanban.submit();" class="btn btn-success"><i class="fa fa-fw fa-eye"></i>'.$MULTILANG_TodosLosTableros.'</a>
                <br><br>
            </div>';


        echo "<form name='recarga_tablero_kanban' action='$ArchivoCORE' method='POST' style='display: inline!important;'>
            <input type='Hidden' name='PCO_Accion' value='PCO_ExplorarTablerosKanban'>
            <input type='Hidden' name='CadenaTablerosAVisualizar' value=''>
            </form>";
    ?>

		<script type="" language="JavaScript">
		    var TareaArrastrarActiva=0;
		    function CargarCrearTarea(Columna,Tablero)
		        {
            		// Se muestra el cuadro modal
            		$('#myModalActividadKanban').modal('show');
            		//Asigna el valor predeterminado segun lo que llegue en columna
            		document.datosfield.columna.value=Columna;
            		document.datosfield.ID_TableroKanban.value=Tablero;
		        }
            function PermitirSoltar(ev,columna)
                {
                    ev.preventDefault();                                                            //Evita el evento predeterminado sobre el elemento
                }
            
            function Arrastrar(ev,tarea)
                {
                    TareaArrastrarActiva=tarea;                                                     //Define la vble global con la tarea que se arrastra
                    ev.dataTransfer.setData("text", ev.target.id);
                    <?php
                        //Verifica si esta en multitablero y agrega control para tal fin
                        if ($CadenaTablerosAVisualizar=="")
                            echo "alert('Arrastrar/Soltar no disponible con multiples tableros activos.\\nDrag&Drop not available when multiple active boards.');";
                    ?>
                }
                
            function Soltar(ev,columna)
                {
                    ev.preventDefault();
                    var data = ev.dataTransfer.getData("text");                                     //Obtiene el elemento origen
                    //ev.target.appendChild(document.getElementById(data));                         //Agrega el elemento al objetivo (generico)
                    ColumnaDestino=document.getElementById("ColumnaKanbanMarcoArrastre"+columna);    //Asigna el elemento a la columna en cuestion
                    ColumnaDestino.appendChild(document.getElementById(data));                      //Agrega el elemento a la columna destino
                    //Realiza la operacion para cambiar la columna de la tarea
                    VariableTransporte=PCO_ObtenerContenidoAjax(0,"index.php","PCO_Accion=cambiar_estado_campo&id="+TareaArrastrarActiva+"&tabla=kanban&campo=columna&valor="+columna); //Obtiene de manera sincrónica un valor
                }
		</script>

<?php
        //Busca la lista de tableros si no recibe la cadena de tableros.  Sino entonces presenta la recibida
        if ($CadenaTablerosAVisualizar=="")
            {
                //Tableros propios
                $ResultadoTableros=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."kanban WHERE archivado<>1 AND categoria='[PRACTICO][ColumnasTablero]' AND login_admintablero='$PCOSESS_LoginUsuario' ORDER BY titulo ASC ");
                while ($RegistroTableros=$ResultadoTableros->fetch())
                    $CadenaTablerosAVisualizar.=$RegistroTableros["id"]."|";
                //Tableros compartidos
                $ResultadoTablerosCompartidos=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."kanban WHERE archivado<>1 AND categoria='[PRACTICO][ColumnasTablero]' AND compartido_rw LIKE '%|$PCOSESS_LoginUsuario|%' ORDER BY titulo ASC ");
                while ($RegistroTablerosCompartidos=$ResultadoTablerosCompartidos->fetch())
                    $CadenaTablerosAVisualizar.=$RegistroTablerosCompartidos["id"]."|";
            }

        //Recorre la lista de tableros encontrados
        $TablerosEncontrados=explode("|",$CadenaTablerosAVisualizar);
        $HayTableroKanban=0;
        foreach ($TablerosEncontrados as $ID_TableroKanban)
            {
                if (trim($ID_TableroKanban)!="")
                    {
                        echo PCO_PresentarTableroKanban($ID_TableroKanban);
                        $HayTableroKanban=1;
                    }
            }
        
        if (!$HayTableroKanban)
            echo "<center>".$MULTILANG_NoTablero."<br><br><BR></center>";

    }




//#################################################################################
//#################################################################################
/*
	Function: PCO_ExplorarTablerosKanbanResumido
	PResenta la lista de tableros kanban a los que el usuario tiene acceso con sus estadisticas basicas

	Salida:
		Tablero predeterminado en pantalla, junto con lista de seleccion para cargar otros tableros
*/
if (@$PCO_Accion=="PCO_ExplorarTablerosKanbanResumido")
    {
?>
        <!-- INICIO MODAL CREACION DE TABLERO -->
            <?php PCO_AbrirDialogoModal("myModalCreacionTablero",$MULTILANG_TablerosKanban." ".$MULTILANG_Personalizado); ?>

        		<script type="" language="JavaScript">
        		    var TareaArrastrarActiva=0;
        		    function CargarCreacionTablero()
        		        {
                    		// Se muestra el cuadro modal
                    		$('#myModalCreacionTablero').modal('show');
        		        }
        		</script>
		
    			<form name="datoscreacion" id="datoscreacion" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    				<input type="Hidden" name="PCO_Accion" value="GuardarCreacionKanban">
    				<input type="Hidden" name="ID_TableroKanban" value="<?php echo $ID_TableroKanban; ?>">

            		<div class="row">
            			<div class="col col-md-12">
                                <label for="titulo_tablero"><?php echo $MULTILANG_Titulo; ?></label>
                                <div class="form-group input-group">
                                    <input type="text" id="titulo_tablero" name="titulo_tablero" class="form-control" value="">
                                    <span class="input-group-addon">
                                        <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    </span>
                                </div>

                                <label for="titulos_columnas"><?php echo $MULTILANG_ListaColumnas; ?> (<?php echo $MULTILANG_FrmDesLista2; ?>)</label>
                                <div class="form-group input-group">
                                    <input type="text" id="titulos_columnas" name="titulos_columnas" class="form-control" value="">
                                    <span class="input-group-addon">
                                        <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    </span>
                                </div>

                                <label for="titulos_categorias"><?php echo $MULTILANG_ListaCategorias; ?> (<?php echo $MULTILANG_FrmDesLista2; ?>)</label>
                                <div class="form-group input-group">
                                    <input type="text" id="titulos_categorias" name="titulos_categorias" class="form-control" value="">
                                    <span class="input-group-addon">
                                        <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    </span>
                                </div>
            			</div>
            		</div>
                </form>
            <?php 
                $barra_herramientas_modal='
                    <input type="Button" class="btn btn-success" value="'.$MULTILANG_Guardar.'" onClick="document.datoscreacion.submit()">
                    <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cancelar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
                PCO_CerrarDialogoModal($barra_herramientas_modal);
            ?>
        <!-- FIN MODAL CREACION DE TABLERO -->


<?php
        $ResultadoTablerosPropios=PCO_EjecutarSQL("SELECT COUNT(*) FROM ".$TablasCore."kanban WHERE archivado<>1 AND categoria='[PRACTICO][ColumnasTablero]' AND login_admintablero='$PCOSESS_LoginUsuario' ")->fetchColumn();
        $ResultadoTablerosCompartidos=PCO_EjecutarSQL("SELECT COUNT(*) FROM ".$TablasCore."kanban WHERE archivado<>1 AND categoria='[PRACTICO][ColumnasTablero]' AND compartido_rw LIKE '%|$PCOSESS_LoginUsuario|%' ")->fetchColumn();

        //Si hay tableros carga el informe, sino presenta mensaje de que no hay tableros
        if ($ResultadoTablerosPropios!=0 || $ResultadoTablerosCompartidos!=0)
            {
                PCO_CargarInforme(-32,1);
                
            }
        else
            {
                echo "<center>".$MULTILANG_NoTablero."<br><br><BR></center>";
            }

        if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
            echo "      
                <div class='row'>
                    <div class='col col-md-6 col-sm-6 col-lg-6 col-xs-6'>
                        <div class='pull-left'><div class='btn btn-success btn-xs' onclick='CargarCreacionTablero();'><i class='fa fa-plus fa-fw fa-1x'></i> [KANBAN] $MULTILANG_CrearTablero</div></div>
                    </div>
                    <div class='col col-md-6 col-sm-6 col-lg-6 col-xs-6'>
                        <div class='pull-left btn-xs'></div>
                    </div>
                </div><br>";
    }

?>