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


//#################################################################################
//#################################################################################
//Presenta una tarea especifica tomando la informacion desde un registro de BD
	function SGSST_PresentarTarea($registro)
		{
		    global $PCO_FechaOperacion;
            
		    //Determina el numero de participantes
		    $total_participantes=0;
		    if($registro["responsables"]!="")
		        $total_participantes=substr_count($registro["responsables"],",")+1;
            
            if ($total_participantes>0)         $EtiquetaPersonas="<i href='javascript:return false;' class='fa fa-fw fa-users' data-toggle='tooltip' data-placement='top' title='".$total_participantes." participantes' ></i>";
            if ($registro["presupuesto"]>0)     $EtiquetaPresupuesto="<i href='javascript:return false;' class='fa fa-fw fa-money' data-toggle='tooltip' data-placement='top' title='Presupuesto: $".$registro["presupuesto"]."' ></i>";
            if ($registro["horas_estimadas"]>0) $EtiquetaHoras="<i href='javascript:return false;' class='fa fa-fw fa-clock-o' data-toggle='tooltip' data-placement='top' title='".$registro["horas_estimadas"]." horas' ></i>";
                                                $EtiquetaCalendario="<i href='javascript:return false;' class='fa fa-fw fa-calendar' data-toggle='tooltip' data-placement='top' title='De ".$registro["fecha_inicio"]." a ".$registro["fecha_fin"]."' ></i>";
            if ($registro["porcentaje"]>0)      $EtiquetaCompletado="<i href='javascript:return false;' class='fa fa-fw fa-flag-checkered' data-toggle='tooltip' data-placement='top' title='".$registro["porcentaje"]."% completado' ></i>";
            //$EtiquetaIconoTareas="<i class='fa fa-fw fa-thumb-tack'></i>";  //OPCIONAL

		    //Determina el estilo por defecto para el cuadro
		    $EstiloCuadro="info";
		    //Si esta completada la pone en verde
		    if ($registro["porcentaje"]==100)
		        {
		            $EstiloCuadro="green";
		        }
		    else
		        {
		            //Tareas sin completar con alta prioridad y sin vencer pasan a ser naranja o amarillo
		            if ($registro["prioridad"]=="Alta" || $registro["prioridad"]=="Urgente") $EstiloCuadro="yellow";
		            //Si la fecha final ya paso entonces pasa a ser rojo
		            if (strtotime($PCO_FechaOperacion) > strtotime($registro["fecha_fin"]))
		                $EstiloCuadro="red";
		        }
            
            //Genera la salida
            $Salida = '
                <div class="panel panel-'.$EstiloCuadro.'">
                    <div class="panel-heading">
                        <div class="row">
                            <div>&nbsp;
                                '.$EtiquetaIconoTareas.'
                                '.$EtiquetaCompletado.'
                                '.$EtiquetaCalendario.'
                                '.$EtiquetaPersonas.'
                                '.$EtiquetaPresupuesto.'
                                '.$EtiquetaHoras.'
                            </div>
                            <div class="text-right">
                                <div class="btn-xs">
                                '.$registro["titulo"].'
                                </div>
                            </div>
                        </div>
                        <div class="btn btn-xs btn-block">
                            <a class="btn btn-xs btn-block btn-default" href="index.php?PCO_Accion=cargar_objeto&objeto=frm:16:1:id:'.$registro["id"].'"><i class="fa fa-edit text-info"></i> Detalles</a>
                        </div>
                    </div>
                </div>';
            return $Salida;
		}


//#################################################################################
//#################################################################################
//Presenta el planeador de trabajo para un mes determinado

	function mostrar_calendario($mes,$ano,$porcentaje_filtro,$codigo_empresa,$ano_aplicacion)
		{
		    global $PCO_FechaOperacion;
		    global $PCO_FestivosColombia;
			global  $y,$dia_festivo,$mes_festivo,$festivo; //usadas por websys_festivos

		   //construyo la tabla general
		   echo '<table class="table table-responsive table-condensed table-bordered " width="100%" cellspacing="5" cellpadding="5" border="0">';
		   //fila con todos los días de la semana
		   echo ' <tr>
					<td width="14%" align=center bgcolor="#63635F"><font color=white><b>Lunes</b></font></td>
					<td width="14%" align=center bgcolor="#63635F"><font color=white><b>Martes</b></font></td>
					<td width="14%" align=center bgcolor="#63635F"><font color=white><b>Miercoles</b></font></td>
					<td width="14%" align=center bgcolor="#63635F"><font color=white><b>Jueves</b></font></td>
					<td width="14%" align=center bgcolor="#63635F"><font color=white><b>Viernes</b></font></td>
					<td width="14%" align=center bgcolor="#63635F"><font color=white><b>Sabado</b></font></td>
					<td width="14%" align=center bgcolor="#63635F"><font color=white><b>Domingo</b></font></td>
				 </tr>';

		   //Variable para llevar la cuenta del dia actual
		   $dia_actual = 1;

		   //calculo el numero del dia de la semana del primer dia
		   $numero_dia = calcula_numero_dia_semana(1,$mes,$ano);
		   //echo "Numero del dia de demana del primer: $numero_dia <br>";

		   //calculo el último dia del mes
		   $ultimo_dia = ultimoDia($mes,$ano);

			//PARTE 1: Escribe la primera fila de la semana
			echo "<tr>";
			for ($i=0;$i<7;$i++)
				{
					if ($i < $numero_dia)
						{
						 //si el dia de la semana i es menor que el numero del primer dia de la semana no pongo nada en la celda
						 echo '<td></td>';
						}
					else 
						{
							//Busca tareas para ese dia
							if ($dia_actual>=10) $dia_busqueda=$dia_actual;
							if ($dia_actual<10 ) $dia_busqueda="0".$dia_actual;
							if (strlen($mes)<2 ) $mes="0".$mes;
							
							$fecha_busqueda=$ano.$mes.$dia_busqueda;
							$cadena_tareas="";
							$resultado = ejecutar_sql("SELECT * FROM sgsst_planeador WHERE codigo_empresa='$codigo_empresa' AND ano_aplicacion='$ano_aplicacion' AND '$fecha_busqueda' >=fecha_inicio  AND '$fecha_busqueda' <= fecha_fin AND $porcentaje_filtro ");
							$cantidad_tareas=0;
							while($registro = $resultado->fetch())
								{
        						    //Agrega el cuadro con informacion de la tarea
        							$cadena_tareas.=SGSST_PresentarTarea($registro);
        							$cantidad_tareas++;
								}
							
							//Determina si el dia es festivo para presentar titulos
        					$cadena_festivo="";
        					$color_festivo="";
        					if ($numero_dia==6) $color_festivo="#E0E0E0"; //Domingo
        					if (isset($PCO_FestivosColombia[$ano*1][$mes*1][$dia_busqueda*1]))
        						{
        							$cadena_festivo=" <i class='text-info'>(Festivo)</i> ";
        							$color_festivo="#FFFFCF";
        						}

        					//OPCIONAL --- Usa la cantidad de tareas para agregar un titulo al dia del mes 
        					$titulo_cantidad_tareas="";
        					/*if ($cantidad_tareas!=0) $titulo_cantidad_tareas='<span class="badge fa fa-1x">'.$cantidad_tareas.' tarea(s)</span>';*/
        					
							if ($dia_actual<10) $dia_actual="0".$dia_actual;

        					//Imprime la celda con los datos
        					echo '<td valign=top bgcolor="'.$color_festivo.'">';
        					    echo '<div class="fa-2x"><b>'.$dia_actual.'</b>'.$cadena_festivo.'</div>'.$titulo_cantidad_tareas.'';
            					echo $cadena_tareas;
        					echo '</td>';

							$dia_actual++;
						}
				}
			echo "</tr>";
			//PARTE 1: Finaliza la primera fila del calendario

            //////////////////////////////////////////////////////////////
			//PARTE 2: Recorre todos los demás días hasta el final del mes
			$numero_dia = 0;
			while ($dia_actual <= $ultimo_dia)
				{
					//si estamos a principio de la semana escribo el <TR>
					if ($numero_dia == 0)
						echo "<tr>";
					
					//Busca tareas para ese dia
					if ($dia_actual>=10) $dia_busqueda=$dia_actual;
					if ($dia_actual<10 ) $dia_busqueda="0".$dia_actual;
					if (strlen($mes)<2 ) $mes="0".$mes;
					
					$fecha_busqueda=$ano.$mes.$dia_busqueda;
					$cadena_tareas="";
					$resultado = ejecutar_sql("SELECT * FROM sgsst_planeador WHERE codigo_empresa='$codigo_empresa' AND ano_aplicacion='$ano_aplicacion' AND '$fecha_busqueda' >=fecha_inicio  AND '$fecha_busqueda' <= fecha_fin AND $porcentaje_filtro ");
					$cantidad_tareas=0;
					while($registro = $resultado->fetch())
						{
						    //Agrega el cuadro con informacion de la tarea
							$cadena_tareas.=SGSST_PresentarTarea($registro);
							$cantidad_tareas++;
						}
					
					//Determina si el dia es festivo para presentar titulos
					$cadena_festivo="";
					$color_festivo="";
					if ($numero_dia==6) $color_festivo="#E0E0E0"; //Domingo
					if (isset($PCO_FestivosColombia[$ano*1][$mes*1][$dia_busqueda*1]))
						{
							$cadena_festivo=" <i class='text-info'>(Festivo)</i> ";
							$color_festivo="#FFFFCF";
						}

					//OPCIONAL --- Usa la cantidad de tareas para agregar un titulo al dia del mes 
					$titulo_cantidad_tareas="";
					/*if ($cantidad_tareas!=0) $titulo_cantidad_tareas='<span class="badge fa fa-1x">'.$cantidad_tareas.' tarea(s)</span>';*/

					if ($dia_actual<10) $dia_actual="0".$dia_actual;
					
					//Imprime la celda con los datos
					echo '<td valign=top bgcolor="'.$color_festivo.'">';
					    echo '<div class="fa-2x"><b>'.$dia_actual.'</b>'.$cadena_festivo.'</div>'.$titulo_cantidad_tareas.'';
    					echo $cadena_tareas;
					echo '</td>';
					
					//Se mueve al dia siguiente
					$dia_actual++;
					$numero_dia++;
					//Si es el ultimo de la semana, me pongo al principio de la semana y escribo el </tr>
					if ($numero_dia == 7){
						$numero_dia = 0;
						echo "</tr>";
					}
				}

			//OPCIONAL --- compruebo que celdas me faltan por escribir vacias de la última semana del mes 
			/*for ($i=$numero_dia;$i<7;$i++)
				echo '<td></td>';*/

            //PARTE 2: Finalizacion
			echo "</tr>";
			
			//Finaliza la tabla inicial (la responsive)
			echo "</table>";
		}




/* ################################################################## */
/* ################################################################## */
/*
	Function: GuardarTareaKanban
	Almacena la informacion asociada a una tarea sobre el tablero kanban

	Salida:
		Registro almacenado en la tabla de aplicacion

	Ver tambien:
		<ExplorarTablerosKanban>
*/
	if ($PCO_Accion=="GuardarTareaKanban")
		{
			$mensaje_error="";

			// Elimina los datos
			ejecutar_sql_unaria("INSERT INTO ".$TablasCore."kanban (login_admintablero,titulo,descripcion,asignado_a,categoria,columna,peso,estilo,fecha) VALUES ('$PCOSESS_LoginUsuario','$titulo','$descripcion','$asignado_a','$categoria','$columna','$peso','$estilo','$fecha') ");
			auditar("Agrega tarea Kanban");
			echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
				<input type="Hidden" name="PCO_Accion" value="ExplorarTablerosKanban">
                <input type="Hidden" name="Presentar_FullScreen" value="'.@$Presentar_FullScreen.'">
                <input type="Hidden" name="Precarga_EstilosBS" value="'.@$Precarga_EstilosBS.'">
				<input type="Hidden" name="PCO_ErrorIcono" value="'.@$PCO_ErrorIcono.'">
				<input type="Hidden" name="PCO_ErrorEstilo" value="'.@$PCO_ErrorEstilo.'">
				<input type="Hidden" name="PCO_ErrorTitulo" value="'.@$PCO_ErrorTitulo.'">
				<input type="Hidden" name="PCO_ErrorDescripcion" value="'.@$PCO_ErrorDescripcion.'">
			<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
		}


//#################################################################################
//#################################################################################
/*
	Function: ExplorarTablerosKanban
	PResenta la lista de tableros kanban a los que el usuario tiene acceso y permite realizar operaciones en cada uno

	Variables de entrada:

		multiples - Recibidas mediante formulario unico asociado al proceso

	Salida:
		Tablero predeterminado en pantalla, junto con lista de seleccion para cargar otros tableros
*/
if (@$PCO_Accion=="ExplorarTablerosKanban")
    {
        //Busca las columnas definidas en el tablero
        $ResultadoColumnas=ejecutar_sql("SELECT descripcion FROM ".$TablasCore."kanban WHERE columna='-2' AND titulo='[PRACTICO][ColumnasTablero]' AND login_admintablero='$PCOSESS_LoginUsuario' ")->fetch();
        $ArregloColumnasTablero=explode(",",$ResultadoColumnas["descripcion"]);
    ?>

                    <a data-toggle="modal" href="#myModalActividadKanban" title="'.$MULTILANG_FrmDesBoton.'">
                            <i class="fa fa-bolt fa-3x fa-fw"></i>
                    </a>

    <!-- INICIO MODAL ADICION DE BOTONES -->
    <?php abrir_dialogo_modal("myModalActividadKanban",$MULTILANG_AgregarNuevaTarea,"modal-wide"); ?>
				<form name="datosfield" id="datosfield" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="PCO_Accion" value="GuardarTareaKanban">


		<div class="row">
			<div class="col col-md-6">

                    <div class="form-group input-group">
                        <input type="text" name="titulo" class="form-control" placeholder="<?php echo $MULTILANG_FrmTituloBot; ?>">
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                        </span>
                    </div>

                    <div class="form-group input-group">
                        <textarea name="descripcion" rows="15" class="form-control" placeholder="<?php echo $MULTILANG_InfDescripcion; ?>"></textarea>
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
                                <input type="text" data-date-format="YYYY-MM-DD" name="fecha" id="fecha" readonly  class="form-control">
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
								<select id="estilo" name="estilo" class="form-control">
									<option value=""><?php echo $MULTILANG_Ninguno; ?></option>
									<option value=" "><?php echo $MULTILANG_BtnEstiloSimple; ?></option>
									<option value=" default "><?php echo $MULTILANG_BtnEstiloPredeterminado; ?> (gris)</option>
									<option value=" primary "><?php echo $MULTILANG_BtnEstiloPrimario; ?> (azul oscuro)</option>
									<option value=" success "><?php echo $MULTILANG_BtnEstiloFinalizado; ?> (verde)</option>
									<option value=" info "><?php echo $MULTILANG_BtnEstiloInformacion; ?> (azul claro)</option>
									<option value=" warning "><?php echo $MULTILANG_BtnEstiloAdvertencia; ?> (naranja)</option>
									<option value=" danger "><?php echo $MULTILANG_BtnEstiloPeligro; ?> (rojo)</option>
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
                                        $ResultadoUsuarios=ejecutar_sql("SELECT login,nombre FROM ".$TablasCore."usuario ORDER BY login");
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
                                <select id="categoria" name="categoria" class="form-control">
                                    <option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
        
                                </select>
                            </div>
						</div>
					</div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="columna"><?php echo $MULTILANG_Columna; ?></label>
                            <div class="form-group input-group">
                                <select id="columna" name="columna" class="form-control">
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
                            <label for="peso"><?php echo $MULTILANG_Peso; ?></label>
                            <div class="form-group input-group">
                                <select id="peso" name="peso" class="form-control">
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
    <!-- FIN MODAL ADICION DE BOTONES -->


   
        
<?php


        echo "<div class='panel panel-default well'>
                <table width='100%'><tr>";
                    //Recorre las columnas del tablero
                    foreach ($ArregloColumnasTablero as $NombreColumna) {
                        echo "<td>";
                        echo "<i class=''><center><b>".$NombreColumna."</b></center></i>";
                        echo "<div class='btn btn-info btn-xs'><i class='fa fa-plus fa-fw'></i></div>";
                        echo "<div class='btn btn-default btn-xs'><i class='fa fa-sort-alpha-asc fa-fw'></i></div>";
                        echo "<div class='btn btn-default btn-xs'><i class='fa fa-sort-numeric-asc fa-fw'></i></div>";
                        echo "<div class='btn btn-default btn-xs'><i class='fa fa-sort-amount-asc fa-fw'></i></div>";
                        echo "<div class='btn btn-default btn-xs'><i class='fa fa-random fa-fw'></i></div>";
                        echo "<hr>";
                        //Busca las tarjetas de la columna
                        
                        
                        
                        
                        
                        
                        echo "</td>";
                    }
        echo "  <tr></table>
            
            <br><br><br><br><br><br>
            &nbsp;&nbsp;&nbsp;
            <a href='#' class='btn btn-xs btn-danger'><i class='fa fa-fw fa-thumb-tack'></i></a>=Vencida&nbsp;&nbsp;&nbsp;
            <a href='#' class='btn btn-xs btn-info'><i class='fa fa-fw fa-thumb-tack'></i></a>=Normal, en proceso&nbsp;&nbsp;&nbsp;
            <a href='#' class='btn btn-xs btn-success'><i class='fa fa-fw fa-thumb-tack'></i></a>=Finalizada&nbsp;&nbsp;&nbsp;
            <a href='#' class='btn btn-xs btn-warning'><i class='fa fa-fw fa-thumb-tack'></i></a>=Prioridad alta/urgente&nbsp;&nbsp;&nbsp;<br><br>";
        //mostrar_calendario($mes_filtro,$ano_filtro,$porcentaje_filtro,$codigo_empresa,$ano_aplicacion);
        echo "</div>";
        //Agrega boton de regreso al escritorio
        echo '<div align=center><a href="index.php" class="btn btn-warning"><i class="fa fa-fw fa-chevron-circle-left"></i>Regresar al escritorio</a></div><br><br>';
    }


?>