<?php
/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2020
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
    Redistribution and use in source and binary forms, with or without
    modification, are permitted provided that the following conditions are met:
    
    1. Redistributions of source code must retain the above copyright notice, this
       list of conditions and the following disclaimer.
    
    2. Redistributions in binary form must reproduce the above copyright notice,
       this list of conditions and the following disclaimer in the documentation
       and/or other materials provided with the distribution.
    
    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
    AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
    IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
    DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
    FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
    DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
    SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
    CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
    OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
    OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
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
			PCO_Auditar("Actualiza propiedades de tablero Kanban $ID_TableroKanban");
			PCO_RedireccionATableroKanban($ID_TableroKanban);
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: AceptarPruebasTareaKanban
	Actualiza el estado de aceptacion de las pruebas asociadas a una tarea del tablero

	Salida:
		Registro de tarea actualizado, tablero visualizado con la tarea actualizada

	Ver tambien:
		<PCO_ExplorarTablerosKanban>
*/
	if ($PCO_Accion=="AceptarPruebasTareaKanban")
		{
			//Define el campo a actualizar segun el tipo de prueba recibido
			if ($TipoPrueba=="PF") $Campo="aceptacion_pf";
			if ($TipoPrueba=="PNF") $Campo="aceptacion_pnf";
			
			// Actualiza los datos
			PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."kanban SET $Campo='Si' WHERE id=?","$IdTareaKanban");
			PCO_Auditar("Acepta pruebas $TipoPrueba tarea Kanban $IdTareaKanban");
			if ($Retorno=="")
			    PCO_RedireccionATableroKanban($ID_TableroKanban);
            if ($Retorno=="BancoPruebas")
                {
        			echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
        				<input type="Hidden" name="PCO_Accion" value="PCO_CargarObjeto">
                        <input type="Hidden" name="Presentar_FullScreen" value="'.@$Presentar_FullScreen.'">
                        <input type="Hidden" name="Precarga_EstilosBS" value="'.@$Precarga_EstilosBS.'">
        				<input type="Hidden" name="PCO_ErrorIcono" value="'.@$PCO_ErrorIcono.'">
        				<input type="Hidden" name="PCO_ErrorEstilo" value="'.@$PCO_ErrorEstilo.'">
        				<input type="Hidden" name="PCO_ErrorTitulo" value="'.@$PCO_ErrorTitulo.'">
        				<input type="Hidden" name="PCO_Objeto" value="inf:-40:1">
        				<input type="Hidden" name="PCO_ErrorDescripcion" value="'.@$PCO_ErrorDescripcion.'">
        				</form>
        			<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
                    exit;
                }
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
		    global $PCOSESS_LoginUsuario,$MULTILANG_ArchivarTareaAdv,$MULTILANG_Error,$MULTILANG_ArchivarTarea,$MULTILANG_DelKanban,$MULTILANG_Evento,$TablasCore,$MULTILANG_Cerrar,$ArchivoCORE,$MULTILANG_Editar,$MULTILANG_FrmAdvDelCampo,$MULTILANG_Eliminar,$MULTILANG_FrmAumentaPeso,$MULTILANG_FrmDisminuyePeso,$MULTILANG_Anterior,$MULTILANG_Columna,$MULTILANG_Siguiente;
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
                {
                    //Deja archivar la tarea solo si no esta pendiente por alguna prueba
                    if (($RegistroTareas["aceptacion_pf"]!="No" || trim($RegistroTareas["pruebas_funcionales"])=="") && ($RegistroTareas["aceptacion_pnf"]!="No" || trim($RegistroTareas["pruebas_nofuncionales"])==""))
                        $ComplementoArchivar='&nbsp;<a onclick=\'return confirm("'.$MULTILANG_ArchivarTareaAdv.'");\' href=\''.$ArchivoCORE.'?PCO_Accion=ArchivarTareaKanban&ID_TableroKanban='.$ID_TableroKanban.'&IdTareaKanban='.$RegistroTareas["id"].'\' class="btn btn-warning btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_ArchivarTarea.'"><i class="fa fa-archive"></i></a>';                    
                    else
                        $ComplementoArchivar='&nbsp;<a onclick=\'return PCOJS_MostrarMensaje("'.$MULTILANG_Error.'","No se pueden archivar tareas que esten <b>pendientes por aceptacion de pruebas funcionales o no funcionales</b>.<br>Por favor acepte la realizacion de pruebas de manera explicita antes de poder continuar.<hr><u>Pruebas funcionales requeridas</u>: '.$RegistroTareas["pruebas_funcionales"].'<br><u>Usuario responsable</u>: '.$RegistroTareas["usuario_aceptacion_pf"].'<hr><u>Pruebas no funcionales requeridas</u>: '.$RegistroTareas["pruebas_nofuncionales"].'<br><u>Usuario responsable</u>: '.$RegistroTareas["usuario_aceptacion_pnf"].'");\' href=\'#\' class="btn btn-warning btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_ArchivarTarea.'"><i class="fa fa-archive"></i></a>';
                }

            //Agrega botones de aceptacion de pruebas funcionales si aplica
            $ComplementoAceptacionPruebas="";
            if ($RegistroTareas["usuario_aceptacion_pf"]==$PCOSESS_LoginUsuario  || $RegistroTareas["usuario_aceptacion_pnf"]==$PCOSESS_LoginUsuario)
                {
                    //Agrega boton para aceptacion de pruebas funcionales
                    if ($RegistroTareas["aceptacion_pf"]!="Si" && trim($RegistroTareas["usuario_aceptacion_pf"])==$PCOSESS_LoginUsuario)
                        $ComplementoAceptacionPruebas.='<a onclick=\'return confirm("Se dispone a aceptar las pruebas funcionales. \\n\\n SEGURO QUE DESEA CONTINUAR?");\' href=\''.$ArchivoCORE.'?PCO_Accion=AceptarPruebasTareaKanban&TipoPrueba=PF&ID_TableroKanban='.$ID_TableroKanban.'&IdTareaKanban='.$RegistroTareas["id"].'\' class="btn btn-success btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="Aceptar pruebas funcionales"> <i class="fa fa-check-circle fa-1x"></i> OK P.F.</a>';
                    //Agrega boton para aceptacion de pruebas no funcionales
                    if ($RegistroTareas["aceptacion_pnf"]!="Si" && trim($RegistroTareas["usuario_aceptacion_pnf"])==$PCOSESS_LoginUsuario)
                        $ComplementoAceptacionPruebas.='&nbsp;<a onclick=\'return confirm("Se dispone a aceptar las pruebas NO funcionales. \\n\\n SEGURO QUE DESEA CONTINUAR?");\' href=\''.$ArchivoCORE.'?PCO_Accion=AceptarPruebasTareaKanban&TipoPrueba=PNF&ID_TableroKanban='.$ID_TableroKanban.'&IdTareaKanban='.$RegistroTareas["id"].'\' class="btn btn-success btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="Aceptar pruebas NO funcionales"> <i class="fa fa-check-circle fa-1x"></i> OK P.N.F.</a>';
                }

            //Determina si la tarea se puede o no eliminar
            $ComplementoEliminar="";
            if ($PCOSESS_LoginUsuario==$ResultadoColumnas["login_admintablero"])
                $ComplementoEliminar='<a onclick=\'return confirm("'.$MULTILANG_DelKanban.'");\' href=\''.$ArchivoCORE.'?PCO_Accion=EliminarTareaKanban&ID_TableroKanban='.$ID_TableroKanban.'&ID_TableroKanban='.$ID_TableroKanban.'&IdTareaKanban='.$RegistroTareas["id"].'\' class="btn btn-danger btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Eliminar.'"><i class="fa fa-trash"></i></a>';

            //Determina si la tarea se puede o no editar
            $ComplementoEditar="";
            if ($PCOSESS_LoginUsuario==$ResultadoColumnas["login_admintablero"] || stripos($RegistroTareas["usuarios_edicion"],$PCOSESS_LoginUsuario)!==false )   
                $ComplementoEditar='<a onclick=\'PCO_CargarPopUP(0,0,'.$RegistroTareas["id"].');\' class="btn btn-default btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Editar.'"><i class="fa fa-pencil"></i></a>';

            //Determina si la tarea permite reportar bugs o no
            $TituloBUG=urlencode("[Kanban] ".$ResultadoColumnas["titulo"]." [Tarea] ".$RegistroTareas["titulo"]);
            $ComplementoReporteBugs='&nbsp;<a href=\'index.php?PCO_Accion=PCO_ReportarBugs&PCO_TituloRecibidoBUG='.$TituloBUG.'&PCO_CapturaTrazas=KanbanID:'.$RegistroTareas["id"].'\' class="btn btn-success btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="Reportar Bug o Error asociado a esta tarea"> <i class="fa fa-bug fa-1x"></i></a>';

            //Pone controles
            $salida='<div class="well well-sm" id="PCOEditorContenedor_Col'.$RegistroTareas["columna"].'_'.$RegistroTareas["id"].'" style=" margin:2px; display:none; visibility:hidden; position: absolute; z-index:1000;">
                    <div align="left" style="display: inline-block">
                        <div style="margin-top:3px;">
                            <a class="btn btn-xs btn-info '.$EstadoDeshabilitadoMoverIzquierda.'"           data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Anterior.' '.$MULTILANG_Columna.'" href=\''.$ArchivoCORE.'?PCO_Accion=cambiar_estado_campo&id='.$RegistroTareas["id"].'&tabla=kanban&campo=columna&accion_retorno=PCO_ExplorarTablerosKanban&ID_TableroKanban='.$ID_TableroKanban.'&valor='.($RegistroTareas["columna"]-1).'\'><i class="fa fa-arrow-left"></i></a>
                            <a class="btn btn-xs btn-info" data-toggle="tooltip" data-html="true"           data-placement="top" title="'.$MULTILANG_FrmAumentaPeso.' a '.($RegistroTareas["peso"]+1).'" href=\''.$ArchivoCORE.'?PCO_Accion=cambiar_estado_campo&id='.$RegistroTareas["id"].'&tabla=kanban&campo=peso&accion_retorno=PCO_ExplorarTablerosKanban&ID_TableroKanban='.$ID_TableroKanban.'&valor='.($RegistroTareas["peso"]+1).'\'><i class="fa fa-arrow-down"></i></a>
                            <a class="btn btn-xs btn-info '.$EstadoDeshabilitadoMoverArriba.'"              data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_FrmDisminuyePeso.' a '.($RegistroTareas["peso"]-1).'" href=\''.$ArchivoCORE.'?PCO_Accion=cambiar_estado_campo&id='.$RegistroTareas["id"].'&tabla=kanban&campo=peso&accion_retorno=PCO_ExplorarTablerosKanban&ID_TableroKanban='.$ID_TableroKanban.'&valor='.($RegistroTareas["peso"]-1).'\'><i class="fa fa-arrow-up"></i></a>
                            <a class="btn btn-xs btn-info '.$EstadoDeshabilitadoMoverDerecha.'"             data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Siguiente.' '.$MULTILANG_Columna.'" href=\''.$ArchivoCORE.'?PCO_Accion=cambiar_estado_campo&id='.$RegistroTareas["id"].'&tabla=kanban&campo=columna&accion_retorno=PCO_ExplorarTablerosKanban&ID_TableroKanban='.$ID_TableroKanban.'&valor='.($RegistroTareas["columna"]+1).'\'><i class="fa fa-arrow-right"></i></a>
                            '.$ComplementoEditar.'
                        </div>
                        <div style="margin-top:3px;">
                            '.$ComplementoAceptacionPruebas.'
                        </div>
                        <div style="margin-top:3px;">
                            '.$ComplementoEliminar.'
                            '.$ComplementoArchivar.'
                            '.$ComplementoReporteBugs.'
                        </div>
                    </div>
                </div>';

			return $salida;
		}


//#################################################################################
//#################################################################################
//Presenta una tarea especifica tomando la informacion desde un registro de BD
	function PCO_PresentarTareaKanban($RegistroTareas,$ColumnasDisponibles,$ID_TableroKanban,$ResultadoColumnas)
		{
		    global $PCO_FechaOperacion,$TablasCore;
		    global $MULTILANG_FechaLimite,$MULTILANG_AsignadoA,$MULTILANG_InfCategoria,$MULTILANG_DelKanban,$MULTILANG_Finalizado;
            
            $EtiquetaIconoTareas=  "<i href='javascript:return false;' class='fa fa-fw fa-thumb-tack' data-toggle='tooltip' data-placement='top' title='".$RegistroTareas["categoria"]."' ></i>";
            $EtiquetaPersonas=  "<i href='javascript:return false;' class='fa fa-fw fa-users' data-toggle='tooltip' data-placement='top' title='".$MULTILANG_AsignadoA.": ".$RegistroTareas["asignado_a"]."' ></i>";
            $EtiquetaCalendario="<i href='javascript:return false;' class='fa fa-fw fa-calendar' data-toggle='tooltip' data-placement='top' title='".$MULTILANG_FechaLimite.": ".$RegistroTareas["fecha"]."' ></i>";

			//Busca avatar del responsable
	        $ComplementoImagenPerfil='<i class="fa fa-user-circle-o fa-fw fa-2x"></i>';
	        //Busca si el usuario tiene imagen de perfil
	        $PartesFotoUsuario=explode("|",PCO_EjecutarSQL("SELECT avatar FROM {$TablasCore}usuario WHERE login='".$RegistroTareas["asignado_a"]."' ")->fetchColumn());
	        $RutaFotoUsuario=$PartesFotoUsuario[0];
	        if ($RutaFotoUsuario!="")
		        $ComplementoImagenPerfil="<img src='{$RutaFotoUsuario}' style='width:25px; height:25px; border-radius: 50%; margin-top:0px; margin-bottom:0px;'>";
				    


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
                                '.$ComplementoImagenPerfil.'
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
                            <div class="text-left" style="overflow: auto;">
                                <div class="btn-xs">
                                <hr style="border-top: 1px dotted; margin:0; padding:0;">
                                '.nl2br($RegistroTareas["descripcion"]).'
                                </div>
                            </div>
                            <div class="text-center">
                                '.$AccionesTarea.'
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


<?php
        //Si el usuario es el mismo creador o propietario del tablero le da la posibilidad de eliminarlo
        $ComplementoHerramientasEliminacion="";
        if ($PCOSESS_LoginUsuario==$ResultadoColumnas["login_admintablero"])
            $ComplementoHerramientasEliminacion='<div class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick=\'return confirm(" '.$MULTILANG_Atencion.'  '.$MULTILANG_Atencion.'  '.$MULTILANG_Atencion.' \\n---------------------------------------------\\n '.$MULTILANG_Eliminar.' '.$MULTILANG_TablerosKanban.'\\n\\n\\n'.$MULTILANG_Confirma.'");\' href=\''.$ArchivoCORE.'?PCO_Accion=EliminarTableroKanban&ID_TableroKanban='.$ID_TableroKanban.'\' class="btn btn-danger btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_ZonaPeligro.'!!!<br><b>'.$MULTILANG_Eliminar.' '.$MULTILANG_TablerosKanban.'</b>"><i class="fa fa-trash"></i></a></div>';

        //Cuenta el numero de tareas en el tablero
        $CantidadTareasTotal=PCO_EjecutarSQL("SELECT COUNT(*) as conteo FROM {$TablasCore}kanban WHERE tablero='$ID_TableroKanban' AND categoria<>'[PRACTICO][ColumnasTablero]' ")->fetchColumn();
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
                            PCO_CargarInforme(0,0,"","",1,0,0,0,"SELECT categoria as '{$MULTILANG_ListaCategorias}', COUNT(*) as '{$MULTILANG_Tareas}'  FROM {$TablasCore}kanban WHERE tablero='$ID_TableroKanban' AND categoria<>'[PRACTICO][ColumnasTablero]' GROUP BY categoria ORDER BY categoria ");
        echo "          </td>
                        <td>&nbsp;&nbsp;</td>
                        <td valign=top align=center>
                            <b><i class='fa fa-user fa-fw fa-2x'></i>Tareas por usuario / Tasks by user</b><br>";
                            PCO_CargarInforme(0,0,"","",1,0,0,0,"SELECT asignado_a as '{$MULTILANG_AsignadoA}', COUNT(*) as '{$MULTILANG_Tareas}' FROM {$TablasCore}kanban WHERE tablero='$ID_TableroKanban' AND categoria<>'[PRACTICO][ColumnasTablero]' GROUP BY asignado_a ORDER BY asignado_a ");
        echo "          </td>
                    </tr>
                </table>";

        echo "<!-- Tareas definidas en el tablero -->
            <div class='panel panel-default well'>";

        echo "  <div class='row' style='border: 1px solid lightgray;'>";
                            //Recorre las columnas del tablero
                            $ConteoColumna=1;
                            $ColumnasDisponibles=count($ArregloColumnasTablero);
                            
                            //Intenta obtener el ancho de las columnas como una clase bootstrap en lugar de pixeles
                            //$AnchoColumnas=round(100/$ColumnasDisponibles);
                            $AnchoColumnas=floor(12/$ColumnasDisponibles);

                            $AnchoColumnasXS=12;
                            $AnchoColumnasSM=6;
                            $AnchoColumnasMD=4;
                            $AnchoColumnasLG=$AnchoColumnas;
                            $CadenaColumnas=" col col-xs-{$AnchoColumnasXS} col-sm-{$AnchoColumnasSM} col-md-{$AnchoColumnasMD} col-lg-{$AnchoColumnasLG} ";

                            //Si el ancho de columnas no es suficiente para las 12 unidades reutiliza el espacio en la ulima que es la que mas controles y botones tiene en cada tarea
                            if ($AnchoColumnas*$ColumnasDisponibles!=12)
                                {
                                    $AnchoUltimaColumna=$AnchoColumnas+(12-($AnchoColumnas*$ColumnasDisponibles));
                                    $CadenaColumnasUltimaColumna=" col col-xs-{$AnchoColumnasXS} col-sm-{$AnchoColumnasSM} col-md-{$AnchoUltimaColumna} col-lg-{$AnchoUltimaColumna} ";
                                }

                            foreach ($ArregloColumnasTablero as $NombreColumna) {
                                //Cuenta el numero de tareas en esta columna VS la cantidad de tareas activas en el tablero para obtener el porcentaje de representacion en el tablero
                                $CantidadTareasColumna=PCO_EjecutarSQL("SELECT COUNT(*) as conteo FROM {$TablasCore}kanban WHERE columna=$ConteoColumna AND archivado=0 AND tablero='$ID_TableroKanban' ")->fetchColumn();
                                $PorcentajeTotalAvanceColumna=0;
                                if ($CantidadTareasTotal-$CantidadTareasArchivadas!=0)
                                    $PorcentajeTotalAvanceColumna=round($CantidadTareasColumna*100/($CantidadTareasTotal-$CantidadTareasArchivadas));

                                echo "<div class='{$CadenaColumnas}' ondrop='Soltar(event,$ConteoColumna)' ondragover='PermitirSoltar(event,$ConteoColumna)' id='MarcoBotonOcultar".$ConteoColumna."' style='border-left:1px solid; border-color:lightgray;' >";
                                    echo "<div data-toggle='tooltip' data-html='true' data-placement='top' title='".$MULTILANG_ArrastrarTarea."' class='btn pull-left' ><i class='fa-1x'><i class='fa fa-stack-overflow'></i> <b>".$NombreColumna."</b> <font color=red>{$PorcentajeTotalAvanceColumna}%</font></i></div>";
                                            //echo "<div data-toggle='tooltip' data-html='true'  data-placement='top' title='<b>".$MULTILANG_AgregarNuevaTarea.":</b> ".$NombreColumna."' class='btn text-primary btn-xs pull-right' onclick='$(\"#myModalActividadKanban$ID_TableroKanban\").modal(\"show\"); document.datosfield$ID_TableroKanban.columna.value=$ConteoColumna;'><i class='fa fa-plus fa-fw fa-2x'></i></div>";
                                            echo "<div data-toggle='tooltip' data-html='true'  data-placement='top' title='<b>".$MULTILANG_AgregarNuevaTarea.":</b> ".$NombreColumna."' class='btn text-primary btn-xs pull-right' onclick='PCO_CargarPopUP($ID_TableroKanban,$ConteoColumna,0);'><i class='fa fa-plus fa-fw fa-2x'></i></div>";
                                            echo "<br>";
                                            
                                            echo "<div id='MarcoTareasColumna$ConteoColumna'>
                                            <br><br><div id='ColumnaKanbanMarcoArrastre".$ConteoColumna."'></div>";
                                            //Busca las tarjetas de la columna siempre y cuando no esten ya archivadas
                                            $ResultadoTareas=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."kanban WHERE archivado<>1 AND columna=$ConteoColumna AND tablero='$ID_TableroKanban' ORDER BY peso ASC, id ASC ");
                                            while ($RegistroTareas=$ResultadoTareas->fetch())
                                                echo PCO_PresentarTareaKanban($RegistroTareas,$ColumnasDisponibles,$ID_TableroKanban,$ResultadoColumnas);
                                    echo "</div>";
                                echo "</div>";
                                $ConteoColumna++;
                                //Verifica si ha quedado en la ultima columna y reaprovecha el espacio (si aplica)
                                if ($ConteoColumna==$ColumnasDisponibles && $CadenaColumnasUltimaColumna!="")
                                    $CadenaColumnas=$CadenaColumnasUltimaColumna;
                            }
        echo "  </row>";

        echo "</div>";

        //Genera script de actualizacion para los altos de columna (forzados psara permitir arrastrar y soltar)
        echo '
            <script language="JavaScript">
                var ResolucionCompletaPantalla=window.screen.width;
                var AnchoDocumentoKanban=$(document).width();

                $( document ).ready(function() {
                        //Determina si la resolucion de pantalla es suficiente para hacer transformacion en altos de columna
                        if (AnchoDocumentoKanban>=992)
                            {
                                var MaximoAlto=0; ';        
                                for ($i=1;$i<=$ColumnasDisponibles;$i++)
                                    echo " if (document.getElementById('MarcoBotonOcultar".$i."').clientHeight > MaximoAlto) MaximoAlto=document.getElementById('MarcoBotonOcultar".$i."').clientHeight;";
                                for ($i=1;$i<=$ColumnasDisponibles;$i++)
                                    echo '$("#MarcoBotonOcultar'.$i.'").css("height",MaximoAlto+"px");';
                    echo '  }
                    $("#MarcoBotonOcultar1").css("border-left","0px solid");';
        echo '  });
            </script>';
		}


//#################################################################################
//#################################################################################
/*
	Function: PCO_ExplorarTablerosGantt
	PResenta la lista de tareas de un proyecto en formato Gantt
	
	Salida:
		Diagama Gantt em pantalla
*/
if (@$PCO_Accion=="PCO_ExplorarTablerosGantt")
    {
        //Si recibe un ID de tablero desde el informe de resumen entonces lo usa para ser visualizado
        if ($PCO_Valor!="" || $PCOSESS_TableroKanbanActivo!="")
            {
                if ($PCO_Valor!="") { $CadenaTablerosAVisualizar=$PCO_Valor; $_SESSION["PCOSESS_TableroKanbanActivo"]=(string)$PCO_Valor; }
                if ($PCOSESS_TableroKanbanActivo!="" && $PCO_Valor=="") $CadenaTablerosAVisualizar=$PCOSESS_TableroKanbanActivo;
                //Establece una variable de sesion para saber en que tablero esta trabajando en el momento
            }



/*
VER:  https://twproject.com/

https://taitems.github.io/jQuery.Gantt/



REVISAR LOS PERMISOS DE LA ACCION EN LA ACL
*/
?>







        <div class="container" style="font-family: Helvetica, Arial, sans-serif; font-size: 13px; padding: 0 0 50px 0;">
            <div class="gantt"></div>
        </div>



    <script>
        $(function() {
            "use strict";
            //Genera la variable de arreglo con las actividades
            <?php
                    
                $PCO_SalidaFuenteDatos="
                    var PCO_FuenteDatosGantt = 
                        [ ";
                        //Genera los datos para el diagrama.  SOLO TAREAS SIN ARCHIVAR.
                        $TareasTablero=PCO_EjecutarSQL("
                            SELECT * FROM {$TablasCore}kanban WHERE  archivado = 0  AND    tablero = '{$PCO_Valor}'  AND    columna >= 0 
                            ORDER BY columna ASC, peso, id 
                        
                        ");
                        $UltimaColumna="";
                        $ArregloColumnas=array();
                        while ($RegistroTarea=$TareasTablero->fetch())
                            {
                                //Busca el nombre de la columna para la actividad
                                $TableroActivo=$RegistroTarea["tablero"];
                                $ColumnasTablero=PCO_EjecutarSQL("SELECT descripcion FROM core_kanban WHERE  id = '{$TableroActivo}' ")->fetchColumn();
                                $ArregloColumnas=explode(",",$ColumnasTablero);
                                $NombreColumnaTarea="".trim($ArregloColumnas[$RegistroTarea["columna"]*1-1]);


                                //Si la columna no ha sido agregada al grafico la primnera vez la agrega
                                $NombreColumnaTarea=(string)$NombreColumnaTarea;
                                if (in_array($NombreColumnaTarea, $ArregloColumnas)==true)
                                    {
                                        $ArregloColumnas[]=(string)$NombreColumnaTarea;
                                        $UltimaColumna=(string)$NombreColumnaTarea;
                                    }
                                else
                                    {
                                        $UltimaColumna="";

                                    }
                                    
                                // echo "console.log('Variable UltimaColumna = {$UltimaColumna}');";
                                // echo "console.log('Variable Descrip = ".$RegistroTarea["titulo"]."');";
                                //echo "console.log('Variable color ".$RegistroTarea["id"]." = |".$RegistroTarea["estilo"]."|');";

                                //Define los valores a presentar en el grafico                                
                                $Actividad_Descripcion=" ".$RegistroTarea["titulo"]." (WBS: ".$RegistroTarea["id"].")";
                                $Actividad_FechaInicio=str_replace("-","/",$RegistroTarea["fecha_inicio"]); //Cambia a formato aceptado por plugin AAAA/MM/DD
                                $Actividad_FechaFin=str_replace("-","/",$RegistroTarea["fecha"]);           //Cambia a formato aceptado por plugin AAAA/MM/DD
                                switch (trim($RegistroTarea["estilo"])) {
                                    case '':
                                        $Actividad_Estilo="btn btn-default btn-xs";
                                        break;
                                    case 'default':
                                        $Actividad_Estilo="btn btn-default btn-xs";
                                        break;
                                    case 'primary':
                                        $Actividad_Estilo="btn btn-primary btn-xs";
                                        break;
                                    case 'success':
                                        $Actividad_Estilo="btn btn-success btn-xs";
                                        break;
                                    case 'info':
                                        $Actividad_Estilo="btn btn-info btn-xs";
                                        break;
                                    case 'warning':
                                        $Actividad_Estilo="btn btn-warning btn-xs";
                                        break;
                                    case 'danger':
                                        $Actividad_Estilo="btn btn-danger btn-xs";
                                        break;
                                    default:
                                        $Actividad_Estilo="btn btn-default btn-xs";
                                        break;
                                }


// id	int(10) Incremento automático	
// login_admintablero	varchar(250) NULL	
// titulo	varchar(255) NULL	
// descripcion	text NULL	
// asignado_a	varchar(250) NULL	
// categoria	varchar(255) NULL	
// columna	int(11) NULL	
// peso	int(11) NULL	
// estilo	varchar(15) NULL	
// fecha	date NULL	Fecha de entrega/estimada
// archivado	int(11) NULL	
// compartido_rw	text NULL	
// tablero	int(11) NULL	
// porcentaje	int(11) NULL [0]	
// usuarios_edicion	varchar(255) NULL	Usuarios que pueden editar la tarea
// estado_general	varchar(30) NULL	
// pruebas_funcionales	varchar(500) NULL	
// pruebas_nofuncionales	varchar(500) NULL	
// fecha_inicio	date NULL	
// aceptacion_pf	char(2) NULL [No]	Aceptacion de pruebas funcionales
// aceptacion_pnf	char(2) NULL [No]	Aceptacion de pruebas no funcionales
// usuario_aceptacion_pf	varchar(255) NULL	
// usuario_aceptacion_pnf	varchar(255) NULL	
// historial	text NULL	
// horas_estimadas	int(11) NULL [0]	
// presupuesto	int(11) NULL [0]	
// adjunto_elicitacion	varchar(255) NULL



                                $PCO_SalidaFuenteDatos.= '
                                    {
                                        
                                        name: "<i class=\'fa fa-stack-overflow fa-fw\'></i>'.$UltimaColumna.'",
                                        desc: "'.$RegistroTarea["titulo"].'",
                                        values: [{
                                            from: "'.$Actividad_FechaInicio.'",
                                            to: "'.$Actividad_FechaFin.'",
                                            label: "'.$Actividad_Descripcion.'",
                                            customClass: "'.$Actividad_Estilo.'"
                                        }]
                                    },
                                ';
                            }

                //Cierra el JSON
                $PCO_SalidaFuenteDatos.="  ]; ";
                //Imprime el JS con los datos directamente en la pagina
                echo $PCO_SalidaFuenteDatos;
            ?>
                


            // // shifts dates closer to Date.now()
            // var offset = new Date().setHours(0, 0, 0, 0) -
            //     new Date(PCO_FuenteDatosGantt[0].values[0].from).setDate(35);
            // for (var i = 0, len = PCO_FuenteDatosGantt.length, value; i < len; i++) {
            //     value = PCO_FuenteDatosGantt[i].values[0];
            //     value.from += offset;
            //     value.to += offset;
            // }
            
            //Inicializa el tablero sobre el DIV que tenga la clase gantt asociada
            $(".gantt").gantt({
                source: PCO_FuenteDatosGantt,
                navigate: "scroll",
                scale: "weeks",
                maxScale: "months",
                minScale: "hours",
                itemsPerPage: 25,
                scrollToToday: false,
                useCookie: true,
                onItemClick: function(data) {
                    alert("Item clicked - show some details");
                },
                onAddClick: function(dt, rowId) {
                    alert("Empty space clicked - add an item!");
                },
                onRender: function() {
                    if (window.console && typeof console.log === "function") {
                        console.log("chart rendered");
                    }
                }
            });

            $(".gantt").popover({
                selector: ".bar",
                title: function _getItemText() {
                    return this.textContent;
                },
                container: '.gantt',
                content: "Here's some useful information.",
                trigger: "hover",
                placement: "auto right"
            });

        });
    </script>

<?php
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

            function PCO_CargarPopUP(ID_TableroKanban,ConteoColumna,RegistroTarea)
                {
                    //Determina si es creacion o edicion
                    if (RegistroTarea==0)
                        URLPopUp='index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=frm:-23:0&Presentar_FullScreen=1&Precarga_EstilosBS=1&ID_TableroKanban='+ID_TableroKanban+'&ConteoColumna='+ConteoColumna;
                    else
                        URLPopUp='index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=frm:-23:0:id:'+RegistroTarea+'&Presentar_FullScreen=1&Precarga_EstilosBS=1';
                    
                    //Carga en Popup el formulario de actualizacion
                    PCOJS_MostrarMensaje("<?php echo $MULTILANG_AgregarNuevaTarea; ?>","Cargando...","modal-wide");
                    $("#PCO_Modal_MensajeCuerpo").html('<iframe scrolling="yes" style="margin:10px; border:0px;" height=550 width=100% src="'+URLPopUp+'"></iframe>');
                    $("#PCO_Modal_MensajeBotones").hide();
                }

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

        if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
            {
                //Verifica si tiene tableros compartidos y agrega el/los botones para explorar globalmente tareas de cada tablero
                $CadenaExploracionTareas="";
                if ($ResultadoTablerosPropios!=0 || $ResultadoTablerosCompartidos!=0)
                    $CadenaExploracionTareas.= "
                        &nbsp;&nbsp;&nbsp;&nbsp; <div class='pull-left'><a class='btn btn-info' href='index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=inf:-33:1'><i class='fa fa-eye fa-fw fa-1x'></i> Ver todas las tareas pendientes</a></div>
                        &nbsp;&nbsp;&nbsp;&nbsp; <div class='pull-left'><a class='btn btn-default' href='index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=inf:-34:1'><i class='fa fa-eye fa-fw fa-1x'></i> Ver todas las tareas archivadas</a></div>
                        &nbsp;&nbsp;&nbsp;&nbsp; <div class='pull-left'><a class='btn btn-success' href='index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=inf:-40:1'><i class='fa fa-check fa-fw fa-1x'></i> Banco de pruebas</a></div>
                        ";

                //Presenta botones de crear tablero y volver al menu                
                echo "      
                    <div class='row'>
                        <div class='col col-md-12 col-sm-12 col-lg-12 col-xs-12'>
                            <div class='pull-left'><div class='btn btn-success' onclick='CargarCreacionTablero();'><i class='fa fa-plus fa-fw fa-1x'></i> [KANBAN] $MULTILANG_CrearTablero</div></div>
                            {$CadenaExploracionTareas}
    						&nbsp;&nbsp;&nbsp;&nbsp;<button type='Button' onclick='document.PCO_FormVerMenu.submit()' class='btn btn-warning'><i class='fa fa-home fa-fw'></i> $MULTILANG_IrEscritorio</button>
                        </div>
                        <div class='col col-md-6 col-sm-6 col-lg-6 col-xs-6'>
                            <div class='pull-left btn-xs'></div>
                        </div>
                    </div><br>";
            }
                
        //Si hay tableros carga el informe, sino presenta mensaje de que no hay tableros
        if ($ResultadoTablerosPropios!=0 || $ResultadoTablerosCompartidos!=0)
            {
                PCO_CargarInforme(-32,1,"htm","Informes",1);
            }
        else
            {
                echo "<center>".$MULTILANG_NoTablero."<br><br><BR></center>";
            }

    }

?>