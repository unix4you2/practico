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
	Function: RedireccionATableroKanban
	Lleva al usuario hasta el tablero kanban

	Ver tambien:
		<PCO_ExplorarTablerosKanban>
*/
	function RedireccionATableroKanban($ID_TableroKanban="")
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
			RedireccionATableroKanban($ID_TableroKanban);
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
			RedireccionATableroKanban($ID_TableroKanban);
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
			RedireccionATableroKanban($ID_TableroKanban);
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
			PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."kanban (login_admintablero,titulo,descripcion,asignado_a,categoria,columna,peso,estilo,fecha,archivado,compartido_rw,tablero) VALUES ('$PCOSESS_LoginUsuario','$titulo','$descripcion','$asignado_a','$categoria','$columna','$peso','$estilo','$fecha','0','',$ID_TableroKanban) ");
			PCO_Auditar("Agrega tarea Kanban a tablero $ID_TableroKanban");
			RedireccionATableroKanban($ID_TableroKanban);
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
			$idObjetoInsertado=obtener_ultimo_id_insertado($ConexionPDO);
			PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."kanban (login_admintablero,titulo,descripcion,asignado_a,categoria,columna,peso,estilo,fecha,archivado,compartido_rw,tablero) VALUES ('$PCOSESS_LoginUsuario','','$titulos_categorias','','[PRACTICO][CategoriasTareas]','-2','0','','20000101','0','',$idObjetoInsertado) ");
			PCO_Auditar("Agrega Tablero Kanban $titulo_tablero Id:$idObjetoInsertado");
			RedireccionATableroKanban($idObjetoInsertado);
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
			RedireccionATableroKanban("");
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
	Function: agregar_funciones_edicion_objeto
	Genera el codigo HTML y CSS correspondiente los botones y demas elementos para la edicion en caliente de un objeto

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		tipo_elemento - Tipo de elemento a ser generado

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
	function AgregarFuncionesEdicionTarea($RegistroTareas,$ColumnasDisponibles,$ID_TableroKanban)
		{
		    global $MULTILANG_ArchivarTareaAdv,$MULTILANG_ArchivarTarea,$MULTILANG_DelKanban,$MULTILANG_Evento,$TablasCore,$MULTILANG_Cerrar,$ArchivoCORE,$MULTILANG_Editar,$MULTILANG_FrmAdvDelCampo,$MULTILANG_Eliminar,$MULTILANG_FrmAumentaPeso,$MULTILANG_FrmDisminuyePeso,$MULTILANG_Anterior,$MULTILANG_Columna,$MULTILANG_Siguiente;
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
            if ($RegistroTareas["columna"]==$ColumnasDisponibles)
                $ComplementoArchivar='&nbsp;&nbsp;<a onclick=\'return confirm("'.$MULTILANG_ArchivarTareaAdv.'");\' href=\''.$ArchivoCORE.'?PCO_Accion=ArchivarTareaKanban&ID_TableroKanban='.$ID_TableroKanban.'&IdTareaKanban='.$RegistroTareas["id"].'\' class="btn btn-warning btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_ArchivarTarea.'"><i class="fa fa-archive"></i></a>';

            //Pone controles
            $salida='<div id="PCOEditorContenedor_Col'.$RegistroTareas["columna"].'_'.$RegistroTareas["id"].'" style="margin:2px; display:none; visibility:hidden; position: absolute; z-index:1000;">
                    <div align="center" style="display: inline-block">
                        <!--<a class="btn btn-xs btn-warning" data-toggle="tooltip" data-html="true" data-placement="top" title="'.$MULTILANG_Editar.'" href=\''.$ArchivoCORE.'?PCO_Accion=editar_formulario&campo='.$RegistroTareas["id"].'&formulario='.$RegistroTareas["formulario"].'&popup_activo=FormularioCampos&nombre_tabla='.$registro_formulario["tabla_datos"].'\'><i class="fa fa-fw fa-pencil"></i></a>-->
                        <a class="btn btn-xs btn-info '.$EstadoDeshabilitadoMoverIzquierda.'"           data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Anterior.' '.$MULTILANG_Columna.'" href=\''.$ArchivoCORE.'?PCO_Accion=cambiar_estado_campo&id='.$RegistroTareas["id"].'&tabla=kanban&campo=columna&accion_retorno=PCO_ExplorarTablerosKanban&ID_TableroKanban='.$ID_TableroKanban.'&valor='.($RegistroTareas["columna"]-1).'\'><i class="fa fa-arrow-left"></i></a>
                        <a class="btn btn-xs btn-info" data-toggle="tooltip" data-html="true"           data-placement="top" title="'.$MULTILANG_FrmAumentaPeso.' a '.($RegistroTareas["peso"]+1).'" href=\''.$ArchivoCORE.'?PCO_Accion=cambiar_estado_campo&id='.$RegistroTareas["id"].'&tabla=kanban&campo=peso&accion_retorno=PCO_ExplorarTablerosKanban&ID_TableroKanban='.$ID_TableroKanban.'&valor='.($RegistroTareas["peso"]+1).'\'><i class="fa fa-arrow-down"></i></a>
                        <a class="btn btn-xs btn-info '.$EstadoDeshabilitadoMoverArriba.'"              data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_FrmDisminuyePeso.' a '.($RegistroTareas["peso"]-1).'" href=\''.$ArchivoCORE.'?PCO_Accion=cambiar_estado_campo&id='.$RegistroTareas["id"].'&tabla=kanban&campo=peso&accion_retorno=PCO_ExplorarTablerosKanban&ID_TableroKanban='.$ID_TableroKanban.'&valor='.($RegistroTareas["peso"]-1).'\'><i class="fa fa-arrow-up"></i></a>
                        <a class="btn btn-xs btn-info '.$EstadoDeshabilitadoMoverDerecha.'"             data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Siguiente.' '.$MULTILANG_Columna.'" href=\''.$ArchivoCORE.'?PCO_Accion=cambiar_estado_campo&id='.$RegistroTareas["id"].'&tabla=kanban&campo=columna&accion_retorno=PCO_ExplorarTablerosKanban&ID_TableroKanban='.$ID_TableroKanban.'&valor='.($RegistroTareas["columna"]+1).'\'><i class="fa fa-arrow-right"></i></a>
                        <a onclick=\'return confirm("'.$MULTILANG_DelKanban.'");\' href=\''.$ArchivoCORE.'?PCO_Accion=EliminarTareaKanban&ID_TableroKanban='.$ID_TableroKanban.'&ID_TableroKanban='.$ID_TableroKanban.'&IdTareaKanban='.$RegistroTareas["id"].'\' class="btn btn-danger btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Eliminar.'"><i class="fa fa-trash"></i></a>
                        '.$ComplementoArchivar.'
                    </div>
                </div>';

			return $salida;
		}


//#################################################################################
//#################################################################################
//Presenta una tarea especifica tomando la informacion desde un registro de BD
	function PresentarTareaKanban($RegistroTareas,$ColumnasDisponibles,$ID_TableroKanban)
		{
		    global $PCO_FechaOperacion;
		    global $MULTILANG_FechaLimite,$MULTILANG_AsignadoA,$MULTILANG_InfCategoria,$MULTILANG_DelKanban;
            
            $EtiquetaIconoTareas=  "<i href='javascript:return false;' class='fa fa-fw fa-thumb-tack' data-toggle='tooltip' data-placement='top' title='".$RegistroTareas["categoria"]."' ></i>";
            $EtiquetaPersonas=  "<i href='javascript:return false;' class='fa fa-fw fa-users' data-toggle='tooltip' data-placement='top' title='".$MULTILANG_AsignadoA.": ".$RegistroTareas["asignado_a"]."' ></i>";
            $EtiquetaCalendario="<i href='javascript:return false;' class='fa fa-fw fa-calendar' data-toggle='tooltip' data-placement='top' title='".$MULTILANG_FechaLimite.": ".$RegistroTareas["fecha"]."' ></i>";

		    //Determina el estilo por defecto para el cuadro
		    $EstiloCuadro=$RegistroTareas["estilo"];
            //Genera la salida
            $AccionesTarea=AgregarFuncionesEdicionTarea($RegistroTareas,$ColumnasDisponibles,$ID_TableroKanban);

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

//https://www.w3schools.com/html/html5_draganddrop.asp
            return $Salida;
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

        //Busca la lista de tableros
        $CadenaTablerosDisponibles="<select class='btn-warning btn-xs ' id='ID_TableroKanban' name='ID_TableroKanban' onchange='document.recarga_tablero_kanban.submit();' >";
        //Tableros propios
        $ResultadoTableros=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."kanban WHERE archivado<>1 AND categoria='[PRACTICO][ColumnasTablero]' AND login_admintablero='$PCOSESS_LoginUsuario' ORDER BY titulo ASC ");
        while ($RegistroTableros=$ResultadoTableros->fetch())
            {
                $EstadoSeleccion="";
                if ($RegistroTableros["id"]==$ID_TableroKanban) $EstadoSeleccion=" SELECTED ";
                $CadenaTablerosDisponibles.="<option value='".$RegistroTableros["id"]."' $EstadoSeleccion>".$RegistroTableros["titulo"]."</option>";
                //Si no hay un tablero Kanban definido entonces usa el primero que encuentra para el usuario
                if ($ID_TableroKanban=="") $ID_TableroKanban=$RegistroTableros["id"];
            }
        
        $CadenaTablerosCompartidos="";
        //Tableros compartidos
        $ResultadoTablerosCompartidos=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."kanban WHERE archivado<>1 AND categoria='[PRACTICO][ColumnasTablero]' AND compartido_rw LIKE '%|$PCOSESS_LoginUsuario|%' ORDER BY titulo ASC ");
        while ($RegistroTablerosCompartidos=$ResultadoTablerosCompartidos->fetch())
            {
                $EstadoSeleccion="";
                if ($RegistroTablerosCompartidos["id"]==$ID_TableroKanban) $EstadoSeleccion=" SELECTED ";
                $CadenaTablerosCompartidos.="<option value='".$RegistroTablerosCompartidos["id"]."' $EstadoSeleccion>".$RegistroTablerosCompartidos["titulo"]."</option>";
                //Si no hay un tablero Kanban definido entonces usa el primero que encuentra para el usuario
                if ($ID_TableroKanban=="") $ID_TableroKanban=$RegistroTablerosCompartidos["id"];
            }
        if ($CadenaTablerosCompartidos!="")
            $CadenaTablerosDisponibles.="<optgroup label='$MULTILANG_CompartidosConmigo'>".$CadenaTablerosCompartidos."</optgroup>";

        $CadenaTablerosDisponibles.="</select>";

        //Busca las columnas definidas en el tablero
        $ResultadoColumnas=PCO_EjecutarSQL("SELECT descripcion,compartido_rw,login_admintablero FROM ".$TablasCore."kanban WHERE id='$ID_TableroKanban' ")->fetch();
        $ArregloColumnasTablero=explode(",",$ResultadoColumnas["descripcion"]);
        $ResultadoCategorias=PCO_EjecutarSQL("SELECT descripcion FROM ".$TablasCore."kanban WHERE categoria='[PRACTICO][CategoriasTareas]' AND tablero='$ID_TableroKanban' ")->fetch();
        $ArregloCategoriasTareas=explode(",",$ResultadoCategorias["descripcion"]);
    ?>
		<script type="" language="JavaScript">
		    var TareaArrastrarActiva=0;
		    function CargarCreacionTablero()
		        {
            		// Se muestra el cuadro modal
            		$('#myModalCreacionTablero').modal('show');
		        }
		    function CargarPersonalizaciones()
		        {
            		// Se muestra el cuadro modal
            		$('#myModalPersonalizarKanban').modal('show');
		        }
		    function CargarCrearTarea(Columna)
		        {
            		// Se muestra el cuadro modal
            		$('#myModalActividadKanban').modal('show');
            		//Asigna el valor predeterminado segun lo que llegue en columna
            		document.datosfield.columna.value=Columna;
		        }
		    function CargarPlantilla(ValorPlantilla)
		        {
                    $('#descripcion').val(ValorPlantilla);
                    $('#descripcion').val( $('#descripcion').val().replace(/BR/g,"\n") );
		        }

            function PermitirSoltar(ev,columna)
                {
                    ev.preventDefault();                                                            //Evita el evento predeterminado sobre el elemento
                }
            
            function Arrastrar(ev,tarea)
                {
                    TareaArrastrarActiva=tarea;                                                     //Define la vble global con la tarea que se arrastra
                    ev.dataTransfer.setData("text", ev.target.id);
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


        <!-- INICIO MODAL  PERSONALIZACION COLUMNAS Y CATEGORIAS -->
            <?php abrir_dialogo_modal("myModalPersonalizarKanban",$MULTILANG_TablerosKanban." ".$MULTILANG_Personalizado); ?>
    			<form name="datospersonalizacion" id="datospersonalizacion" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
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
                    <input type="Button" class="btn btn-success" value="'.$MULTILANG_Guardar.'" onClick="document.datospersonalizacion.submit()">
                    <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cancelar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
                cerrar_dialogo_modal($barra_herramientas_modal);
            ?>
        <!-- FIN MODAL PERSONALIZACION COLUMNAS Y CATEGORIAS -->


        <!-- INICIO MODAL CREACION DE TABLERO -->
            <?php abrir_dialogo_modal("myModalCreacionTablero",$MULTILANG_TablerosKanban." ".$MULTILANG_Personalizado); ?>
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
                cerrar_dialogo_modal($barra_herramientas_modal);
            ?>
        <!-- FIN MODAL CREACION DE TABLERO -->


        <!-- INICIO MODAL ADICION DE TAREAS -->
        <?php abrir_dialogo_modal("myModalActividadKanban",$MULTILANG_AgregarNuevaTarea,"modal-wide"); ?>
			<form name="datosfield" id="datosfield" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="PCO_Accion" value="GuardarTareaKanban">
				<input type="Hidden" name="ID_TableroKanban" value="<?php echo $ID_TableroKanban; ?>">

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
                                <select id="plantilla" name="plantilla" class="form-control" onchange="CargarPlantilla(this.value);">
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
        
        			</div>
        		</div>
            </form>
    <?php 
        $barra_herramientas_modal='
            <input type="Button" class="btn btn-success" value="'.$MULTILANG_AgregarNuevaTarea.'" onClick="document.datosfield.submit()">
            <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cancelar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
        cerrar_dialogo_modal($barra_herramientas_modal);
    ?>
    <!-- FIN MODAL ADICION DE TAREAS -->

<?php
        //Si el usuario es el mismo creador o propietario del tablero le da la posibilidad de eliminarlo
        $ComplementoHerramientasEliminacion="";
        if ($PCOSESS_LoginUsuario==$ResultadoColumnas["login_admintablero"])
            $ComplementoHerramientasEliminacion='<div class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick=\'return confirm(" '.$MULTILANG_Atencion.'  '.$MULTILANG_Atencion.'  '.$MULTILANG_Atencion.' \\n---------------------------------------------\\n '.$MULTILANG_Eliminar.' '.$MULTILANG_TablerosKanban.'\\n\\n\\n'.$MULTILANG_Confirma.'");\' href=\''.$ArchivoCORE.'?PCO_Accion=EliminarTableroKanban&ID_TableroKanban='.$ID_TableroKanban.'\' class="btn btn-danger btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_ZonaPeligro.'!!!<br><b>'.$MULTILANG_Eliminar.' '.$MULTILANG_TablerosKanban.'</b>"><i class="fa fa-trash"></i></a></div>';

        $ComplementoHerramientasArchivadas="";
        if ($ID_TableroKanban!="")
            $ComplementoHerramientasArchivadas="<div class='pull-left'><a class='btn btn-inverse btn-xs' href='".$ArchivoCORE."?PCO_Accion=VerTareasArchivadas&ID_TableroKanban=$ID_TableroKanban'><i class='fa fa-archive fa-fw fa-1x'></i> $MULTILANG_TareasArchivadas </a></div>";

        $ComplementoHerramientasPersonalizacion="";
        if ($ID_TableroKanban!="")
            $ComplementoHerramientasPersonalizacion="<div class='pull-right'><div class='btn btn-inverse btn-xs' onclick='CargarPersonalizaciones();'><i class='fa fa-cogs fa-fw fa-1x'></i> $MULTILANG_Configuracion</div></div>";

        echo "
            <!-- Barra de herramientas del tablero -->
            <div class='row'>
                <div class='col col-md-6 col-sm-6 col-lg-6 col-xs-6'>
                    <div class='pull-left btn-xs'><form name='recarga_tablero_kanban' action='$ArchivoCORE' method='POST' style='display: inline!important;'><input type='Hidden' name='PCO_Accion' value='PCO_ExplorarTablerosKanban'>$MULTILANG_TablerosKanban: $CadenaTablerosDisponibles <a class='btn btn-inverse btn-xs' onclick='document.recarga_tablero_kanban.submit();'><i class='fa fa-refresh'></i> $MULTILANG_Actualizar</a>&nbsp;&nbsp;&nbsp;&nbsp;</form></div>
                    $ComplementoHerramientasArchivadas
                </div>
                <div class='col col-md-6 col-sm-6 col-lg-6 col-xs-6'>
                    $ComplementoHerramientasEliminacion
                    <div class='pull-right'><div class='btn btn-inverse btn-xs' onclick='CargarCreacionTablero();'><i class='fa fa-plus fa-fw fa-1x'></i> $MULTILANG_CrearTablero</div></div>
                    $ComplementoHerramientasPersonalizacion
                </div>
            </div>

            <!-- Tareas definidas en el tablero -->
            <div class='panel panel-default well'>
                <table border=1 width='100%' class='table table-responsive table-condensed btn-xs' style='border: 1px solid lightgray;'><tr>";
                    
                    //Verifica si hay al menos algun tablero para trabajar
                    if ($ID_TableroKanban!="")
                        {
                            //Recorre las columnas del tablero
                            $ConteoColumna=1;
                            $ColumnasDisponibles=count($ArregloColumnasTablero);
                            $AnchoColumnas=round(100/$ColumnasDisponibles);
                            foreach ($ArregloColumnasTablero as $NombreColumna) {
                                echo "<td  valign=top width='$AnchoColumnas%'>";
                                echo "<div data-toggle='tooltip' data-html='true'  data-placement='top' title='".$MULTILANG_ArrastrarTarea."' class='btn pull-left' id='MarcoBotonOcultar".$ConteoColumna."' ondrop='Soltar(event,$ConteoColumna)' ondragover='PermitirSoltar(event,$ConteoColumna)'><i class='fa-1x'><i class='fa fa-stack-overflow'></i> <b>".$NombreColumna."</b></i></div>";
                                echo "<div data-toggle='tooltip' data-html='true'  data-placement='top' title='<b>".$MULTILANG_AgregarNuevaTarea.":</b> ".$NombreColumna."' class='btn text-primary btn-xs pull-right' onclick='CargarCrearTarea(".$ConteoColumna.");'><i class='fa fa-plus fa-fw fa-2x'></i></div>";
                                echo "<div id='MarcoTareasColumna$ConteoColumna'>
                                <br><br><div id='ColumnaKanbanMarcoArrastre".$ConteoColumna."'></div>";
                                //Busca las tarjetas de la columna siempre y cuando no esten ya archivadas
                                $ResultadoTareas=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."kanban WHERE archivado<>1 AND columna=$ConteoColumna AND tablero='$ID_TableroKanban' ORDER BY peso ASC ");
                                while ($RegistroTareas=$ResultadoTareas->fetch())
                                    echo PresentarTareaKanban($RegistroTareas,$ColumnasDisponibles,$ID_TableroKanban);
                                echo "</div></td>";
                                $ConteoColumna++;
                            }
                        }
                    else
                        echo "<center>".$MULTILANG_NoTablero."</center>";
        echo "  <tr></table>
            <!--
            <br><br><br><br><br><br>
            &nbsp;&nbsp;&nbsp;
            <a href='#' class='btn btn-xs btn-danger'><i class='fa fa-fw fa-thumb-tack'></i></a>=Vencida&nbsp;&nbsp;&nbsp;
            <a href='#' class='btn btn-xs btn-info'><i class='fa fa-fw fa-thumb-tack'></i></a>=Normal, en proceso&nbsp;&nbsp;&nbsp;
            <a href='#' class='btn btn-xs btn-success'><i class='fa fa-fw fa-thumb-tack'></i></a>=Finalizada&nbsp;&nbsp;&nbsp;
            <a href='#' class='btn btn-xs btn-warning'><i class='fa fa-fw fa-thumb-tack'></i></a>=Prioridad alta/urgente&nbsp;&nbsp;&nbsp;<br><br>
            -->
            ";
        echo "</div>";
        //Agrega boton de regreso al escritorio
        echo '<div align=center><a href="index.php" class="btn btn-warning"><i class="fa fa-fw fa-chevron-circle-left"></i>'.$MULTILANG_FrmAccionRegresar.'</a></div><br><br>';
    }


?>