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
if ($PCO_Accion=="PCO_EliminarMenu")
	{
		/*
			Function: PCO_EliminarMenu
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
			<PCOFUNC_AdministrarMenu> | <detalles_menu>
		*/
		
		//Obtiene el hash de la opcion
		$RegistroMenu=PCO_EjecutarSQL("SELECT hash_unico,texto FROM ".$TablasCore."menu WHERE id=? ","$id")->fetch();
		
		//Si hay un formulario activo lo agrega a la condicion de eliminado para evitar borrar otros que tienen mismo hash de otro formulario
		$CondicionFormulario='';
		if ($PCO_FormularioActivoEdicionMenu!="") $CondicionFormulario=" AND formulario_vinculado='$PCO_FormularioActivoEdicionMenu' ";
		
		
		// Elimina los datos de la opcion
		PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."menu WHERE id=? $CondicionFormulario ","$id");

		// Elimina opciones hijas
		PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."menu WHERE padre='".$RegistroMenu["hash_unico"]."' $CondicionFormulario ","$id");
		
		// Elimina el enlace para todos los usuarios que utilizan esa opcion
		PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."usuario_menu WHERE menu=? ",$RegistroMenu["hash_unico"]);

		PCO_Auditar("Elimina menu $id ".$RegistroMenu["texto"]);
        //Redirecciona nuevamente a la edicion del menu
		echo '<script type="" language="JavaScript">
		    document.PCOFUNC_AdministrarMenu.PCO_FormularioActivoEdicionMenu.value='.$PCO_FormularioActivoEdicionMenu.';
		    document.PCOFUNC_AdministrarMenu.submit();
		    </script>';
	}


/*
	Function: PCO_PresentarOpcionesArbolMenu
	Funcion utilizada para la construccion recursiva del arbol de menues y submenues del sistema

	Variables de entrada:

		CondicionFiltrado - Condicion que permite filtrar unicamente ciertas opciones.  Util para llamadas recursivas donde ya se conoce la opcion padre.

	Salida:
		Codigo HTML de una fila con el elemento encontrado

	Ver tambien:
	<PCOFUNC_AdministrarMenu>
*/
function PCO_PresentarOpcionesArbolMenu($CondicionFiltrado='',$Sangria=0,$CondicionFormulario='')
    {
        global $PCO_FormularioActivoEdicionMenu,$TablasCore,$ListaCamposSinID_menu,$MULTILANG_MnuAdvElimina,$MULTILANG_Editar,$MULTILANG_Eliminar,$ArchivoCORE;
		$resultado=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_menu." FROM ".$TablasCore."menu WHERE 1=1 AND $CondicionFiltrado $CondicionFormulario ORDER BY seccion,peso");
		while($registro = $resultado->fetch())
			{
				echo '<tr>';
				echo '	<td><font color=lightgray>'.$registro["id"].'</font></td>
						<td style="padding-left:'.$Sangria.'px;" nowrap><i class="'.$registro["imagen"].' fa-2x"></i> <strong>'.$registro["texto"].'</strong></td>
						<td>'.$registro["seccion"].'</td>
						<td>'.$registro["comando"].'</td>
						<td align=center>'.$registro["peso"].'</td>';
						
				if ($PCO_FormularioActivoEdicionMenu=="0" && $Sangria==0)
				    {
				        echo '<td align=center>';
        						    if ($registro["posible_arriba"]==1) echo '<i class="fa fa-check-circle fa-fw fa-2x text-info"></i>';
        				echo    '</td>
        				         <td align=center>';
        						    if ($registro["posible_escritorio"]==1) echo '<i class="fa fa-check-circle fa-fw fa-2x text-info"></i>';
        				echo    '</td>
        				         <td align=center>';
        						    if ($registro["posible_centro"]==1) echo '<i class="fa fa-check-circle fa-fw fa-2x text-info"></i>';
        				echo    '</td>
        				          <td align=center>';
        						    if ($registro["posible_izquierda"]==1) echo '<i class="fa fa-check-circle fa-fw fa-2x text-info"></i>';
        				echo    '</td>';
				    }
				if ($PCO_FormularioActivoEdicionMenu=="0" && $Sangria!=0)
				    {
				        echo '<td align=center style="font-size:9px; color:gray;">Ver padre/See parent</td>
        				      <td align=center style="font-size:9px; color:gray;">Ver padre/See parent</td>
        				      <td align=center style="font-size:9px; color:gray;">Ver padre/See parent</td>
        				      <td align=center style="font-size:9px; color:gray;">Ver padre/See parent</td>';
				    }

				echo '
						<td align="center">
							<form action="'.$ArchivoCORE.'" method="POST" name="f'.$registro["id"].'" id="f'.$registro["id"].'">
								<input type="hidden" name="PCO_Accion" value="PCO_EliminarMenu">
								<input type="hidden" name="PCO_FormularioActivoEdicionMenu" value="'.$PCO_FormularioActivoEdicionMenu.'">
								<input type="hidden" name="id" value="'.$registro["id"].'">
                                <a href="javascript:confirmar_evento(\''.$MULTILANG_MnuAdvElimina.'\',f'.$registro["id"].');" class="btn btn-danger btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Eliminar.'"><i class="fa fa-times"></i></a>
							</form>
						</td>
						<td align="center">
							<form action="'.$ArchivoCORE.'" method="POST">
								<input type="hidden" name="PCO_Accion" value="PCO_CargarObjeto">
								<input type="hidden" name="PCO_Objeto" value="frm:-12:1:id:'.$registro["id"].'">
								<input type="hidden" name="PCO_FormularioActivoEdicionMenu" value="'.$PCO_FormularioActivoEdicionMenu.'">
								<input type="hidden" name="id" value="'.$registro["id"].'">
                                <button type="submit" class="btn btn-warning btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Editar.'"><i class="fa fa-pencil-square-o"></i></button>
							</form>
						</td>
					</tr>';
				//Si la opcion es una agrupadora busca sus opciones hijas
				if ($registro["tipo_menu"]=='grp')
				    PCO_PresentarOpcionesArbolMenu('padre="'.$registro["hash_unico"].'"',40,$CondicionFormulario);
			}
    }


/* ################################################################## */
/* ################################################################## */
		/*
			Function: PCOFUNC_AdministrarMenu
			Presenta la lista de todas las opciones definidas para el menu de usuarios con la posibilidad de agregar nuevas o de administrar las existentes. Incluye la carga de imagenes dentro de marco oculto para su seleccion como iconos.

			FormularioActivo:
				Identificador del formulario del cual se esta editando las entradas del menu

			(start code)
				SELECT * FROM ".$TablasCore."menu WHERE 1
			(end)

			Salida:
				Listado de opciones de menu y formulario para creacion de nuevas

			Ver tambien:
			<guardar_menu> | <detalles_menu> | <PCO_EliminarMenu>
		*/
if ($PCO_Accion=="PCOFUNC_AdministrarMenu")
	{
        //Determina el filtro a aplicar dependiendo si es edicion de menu general o de un formulario especifico
        if ($PCO_FormularioActivoEdicionMenu=="") $PCO_FormularioActivoEdicionMenu=0;
        //Genera equivalente JS para validaciones
        echo '<script language="javascript">
            PCO_FormularioActivoEdicionMenu="'.$PCO_FormularioActivoEdicionMenu.'";
        </script>';

        PCO_SelectorIconosAwesome();
        PCO_SelectorObjetosMenu();
        
		$PCO_Accion=PCO_EscaparContenido($PCO_Accion); //Limpia cadena para evitar XSS
		echo '<div align="center"><br>';

    	//Si encuentra un formulario activo agrega enlace para navegar hasta el
    	if ($PCO_FormularioActivoEdicionMenu!="" && $PCO_FormularioActivoEdicionMenu!="0")
            echo '<a class="btn btn-warning btn-lg" href="index.php?PCO_Accion=PCO_EditarFormulario&popup_activo=&formulario='.$PCO_FormularioActivoEdicionMenu.'">
                    <div><i class="fa fa-pencil-square"></i> <b>'.$MULTILANG_Ir.'</b>: '.$MULTILANG_Editar.' '.$MULTILANG_Formularios.' <i>[ID='.$PCO_FormularioActivoEdicionMenu.']</i> >>></div>
                </a><br><br>';
    	
        PCO_CargarFormulario("-12",1,"","",0,0); //Cargar el form

		PCO_AbrirVentana($MULTILANG_MnuDefinidos, 'panel-warning');
		echo '
		<table class="table table-condensed btn-xs  table-hover table-unbordered">
			<thead>
            <tr>
				<td><b>Id</b></td>
				<td nowrap><b>'.$MULTILANG_MnuTexto.'</b></td>
				<td><b>'.$MULTILANG_MnuSeccion.'</b></td>
				<td><b>'.$MULTILANG_MnuComando.'</b></td>
				<td align=center><b>'.$MULTILANG_Peso.'</b></td>';
				if ($PCO_FormularioActivoEdicionMenu=="0")
        			echo '<td align=center><b>'.$MULTILANG_MnuArriba.'</b></td>
        				<td align=center><b>'.$MULTILANG_MnuEscritorio.'</b></td>
        				<td align=center><b>'.$MULTILANG_MnuCentro.'</b></td>
        				<td align=center><b>'.$MULTILANG_MnuIzquierda.'</b></td>';
		        echo '		
				<td></td>
				<td></td>
			</tr>
            </thead>
            <tbody>';
                PCO_PresentarOpcionesArbolMenu(' (padre="0" OR padre="") ',0,' AND formulario_vinculado='.$PCO_FormularioActivoEdicionMenu);
		echo '</tbody>
        </table>';
		 PCO_CerrarVentana();
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_BuscarPermisosPractico
	Busca dentro de los permisos asignados al usuario aquellos que puedan coincidir dentro de los menues y los informes a la busqueda realizada

	Variables de entrada:

		PCO_BusquedaPermisos - la palabra o expresion a buscar

	Salida:
		Escritorio de usuario con la lista de posibles permisos que coinciden con su busqueda

	Observacion:
		Se retornan unicamente aquellos permisos e informes asignados al usuario

	Ver tambien:
		<PCO_VerMenu>
*/
	if ($PCO_Accion=="PCO_BuscarPermisosPractico" && $PCOSESS_SesionAbierta)
		{ 
			echo '<div align="center"><button onclick="document.PCO_FormVerMenu.submit()" class="btn btn-warning"><i class="fa fa-home"></i> '.$MULTILANG_IrEscritorio.'</button></div><br>';

            //Presenta el buscador nuevamente
            echo '
                <form name="datos_busqueda_home" action="'.$ArchivoCORE.'" method="POST">
                <input type="hidden" name="PCO_Accion" value="PCO_BuscarPermisosPractico">
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
							if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
								{
									$Complemento_tablas=",".$TablasCore."usuario_menu";
									$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.id AND ".$TablasCore."usuario_menu.usuario='$PCOSESS_LoginUsuario'";
								}
							$resultado=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."menu ".@$Complemento_tablas." WHERE 1 AND ( $complemento_palabras_like) ".@$Complemento_condicion);

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
											echo'<input type="hidden" name="PCO_Accion" value="PCO_CargarObjeto">
												 <input type="hidden" name="PCO_Objeto" value="'.$registro["comando"].'"></form>';
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
							if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
								{
									$Complemento_tablas=",".$TablasCore."usuario_informe";
									$Complemento_condicion=" AND ".$TablasCore."usuario_informe.informe=".$TablasCore."informe.id AND ".$TablasCore."usuario_informe.usuario='$PCOSESS_LoginUsuario'";
								}
							$resultado=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."informe ".@$Complemento_tablas." WHERE ".$TablasCore."informe.id>0 AND ( $complemento_palabras_like) ".@$Complemento_condicion);

							// Imprime las opciones con sus formularios
							while($registro = $resultado->fetch())
								{
									echo '<form action="'.$ArchivoCORE.'" method="post" name="deskinf_'.$registro["id"].'" id="deskinf_'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">';
									echo'<input type="hidden" name="PCO_Accion" value="PCO_CargarObjeto">
										 <input type="hidden" name="PCO_Objeto" value="inf:'.$registro["id"].':1"></form>';
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
					PCO_Mensaje($MULTILANG_Resultados, $MULTILANG_BuscaCriterios.'<br>'.$MULTILANG_InfDataTableNoRegistros, '', 'fa fa-search fa-3x', 'alert alert-warning alert-dismissible');
				}

	} 


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_VerMenu
	Despliega el escritorio de un usuario, incluyendo el menu superior, iconos de escritorio y opciones agrupadas en el acordeon central

	Variables de entrada:

		PCOSESS_LoginUsuario - UID/Login de usuario al que se desea agregar el permiso almacenado como variable de sesion despues del login
		PCOSESS_SesionAbierta - Variable que establece si realmente se ha iniciado una sesion

	Salida:
		Escritorio de usuario con las opciones asignadas

	Observacion:
		La funcion agrega un filtrado para aquellos usuarios diferentes del administrador.  El usuario administrador mostrara siempre todas las opciones existentes por defecto.

	Ver tambien:
		<PCOFUNC_AdministrarMenu>
*/

	if ($PCO_Accion=="PCO_VerMenu" && $PCOSESS_SesionAbierta)
		{ 
            //Presenta informes marcados como de publicacion automatica en el home para el usuario actual.  PILAS. esto no aplica para el admin a menos que -por debajo- se haga la insercion del registro de permisos a modo pruebas
            $InformesHome=PCO_EjecutarSQL("SELECT ".$TablasCore."informe.id,ancho FROM ".$TablasCore."informe,".$TablasCore."usuario_informe WHERE ".$TablasCore."usuario_informe.usuario='$PCOSESS_LoginUsuario' AND ".$TablasCore."usuario_informe.informe=".$TablasCore."informe.id AND (permitido_home='E' OR permitido_home='A') ORDER BY titulo ");
            while ($RegistroInformeHome=$InformesHome->fetch())
                {
                    if ($RegistroInformeHome["ancho"]!="")
                        echo "<div class='".$RegistroInformeHome["ancho"]."'>";
                    PCO_CargarInforme($RegistroInformeHome["id"],0);
                    if ($RegistroInformeHome["ancho"]!="")
                        echo "</div>";
                }

			// Carga las opciones del ESCRITORIO
			echo '
			<div id="PCODIV_ArribaEscritorio"></div>
			<table class="table table-unbordered table-condensed"><tr><td>';
			// Si el usuario es diferente al administrador agrega condiciones al query
			if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
				{
					$Complemento_tablas=",".$TablasCore."usuario_menu";
					$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.hash_unico AND ".$TablasCore."usuario_menu.usuario='$PCOSESS_LoginUsuario'";  // AND nivel>0
				}
			$resultado=PCO_EjecutarSQL("SELECT ".$TablasCore."menu.id as id,$ListaCamposSinID_menu FROM ".$TablasCore."menu ".@$Complemento_tablas." WHERE (padre=0 OR padre='') AND posible_escritorio=1 AND formulario_vinculado=0 ".@$Complemento_condicion." ORDER BY peso");

			// Imprime las opciones con sus formularios
			while($registro = $resultado->fetch())
				PCO_ImprimirOpcionMenu($registro,'escritorio');
			echo '</td></tr></table><br>';

			// Carga las opciones del ACORDEON
			echo '<div align="center">';
			// Si el usuario es diferente al administrador agrega condiciones al query
			if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
				{
					$Complemento_tablas=",".$TablasCore."usuario_menu";
					$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.hash_unico AND ".$TablasCore."usuario_menu.usuario='$PCOSESS_LoginUsuario'";  // AND nivel>0
				}
			$ResultadoConteoSecciones=PCO_EjecutarSQL("SELECT COUNT(*) as conteo,seccion FROM ".$TablasCore."menu ".@$Complemento_tablas." WHERE (padre=0 OR padre='') AND posible_centro=1 AND formulario_vinculado=0 ".@$Complemento_condicion." GROUP BY seccion ORDER BY seccion");
			// Imprime las secciones encontradas para el usuario
			while($RegistroConteoSecciones = $ResultadoConteoSecciones->fetch())
				{
					//Crea la seccion en el acordeon
					$seccion_menu_activa=$RegistroConteoSecciones["seccion"];
					$conteo_opciones=$RegistroConteoSecciones["conteo"];
					PCO_AbrirVentana($seccion_menu_activa.' ('.$conteo_opciones.')', 'panel-primary');
					// Busca las opciones dentro de la seccion

					// Si el usuario es diferente al administrador agrega condiciones al query
					if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
						{
							$Complemento_tablas=",".$TablasCore."usuario_menu";
							$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.hash_unico AND ".$TablasCore."usuario_menu.usuario='$PCOSESS_LoginUsuario'";  // AND nivel>0
						}
					$resultado_opciones_acordeon=PCO_EjecutarSQL("SELECT ".$TablasCore."menu.id as id,$ListaCamposSinID_menu FROM ".$TablasCore."menu ".@$Complemento_tablas." WHERE (padre=0 OR padre='') AND posible_centro=1 AND formulario_vinculado=0 AND seccion='".$seccion_menu_activa."' ".@$Complemento_condicion." ORDER BY peso");

					while($registro_opciones_acordeon = $resultado_opciones_acordeon->fetch())
						PCO_ImprimirOpcionMenu($registro_opciones_acordeon,'centro');
					PCO_CerrarVentana();
				}
			echo '</div>';

	} 
?>