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
	Title: Seccion superior
	Ubicacion *[/core/marco_navizq.php]*.  Diagramacion de barras de opciones del lado izquierdo

	Ver tambien:
		<Seccion inferior> | <Articulador>
	*/
?>


<?php
	//Presenta las opciones de la barra izquierda a los usuarios
	if ($PCOSESS_SesionAbierta && @$PCOSESS_LoginUsuario!="")
		{
?>

            <div id="boton_menu_izquierdo" style="position: absolute; left: 1px; top: 60px;  z-index: 2;">
                <i class="fa fa-indent fa-border texto-negro texto-blink" OnClick="javascript:barra_navegacion_izquierda_toggle('<?php if (@$ModoBarraMenuRecibido=="flotante") echo "flotante"; else echo "responsive"; ?>');"></i>
            </div>
            <div id="barra_navegacion_izquierda" class="navbar-default sidebar" role="navigation">
                <!-- DEPRECATED <div class="sidebar-nav navbar-collapse">-->
                    <!--INICIO DE OPCIONES BARRA LATERAL-->
                        <ul class="nav" id="side-menu">
                            

                            <div id="PCODIV_ArribaMenuLateral" align=right></div>
                            
                            <form name="datos_busqueda_home" action="<?php echo $ArchivoCORE; ?>" method="POST">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input name="PCO_BusquedaPermisos" type="text" class="form-control" placeholder="<?php echo $MULTILANG_Buscar; ?>...">
                                    <input type="hidden" name="PCO_Accion" value="buscar_permisos_practico">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            </form>
                            
                            <li>
                                <a href="javascript:document.core_ver_menu.submit();"><i class="fa fa-dashboard fa-fw"></i> <?php echo $MULTILANG_Escritorio; ?></a>
                            </li>
                            <li>
                                <a href="javascript:document.mis_informes.submit();"><i class="fa fa-pie-chart fa-fw"></i> <?php echo $MULTILANG_UsrInfDisp; ?></a>
                            </li>

                            <?php
									$PCO_EnlaceExplorador="javascript:document.fileman_admin_embebido.submit();";
                        			//Verifica si esta o no en modo DEMO para hacer la operacion
                        			if ($PCO_ModoDEMO==1)
									   $PCO_EnlaceExplorador="javascript:PCOJS_MostrarMensaje('".$MULTILANG_TitDemo."','".$MULTILANG_MsjDemo."');";
                                //Siempre presenta el administrador de archivos al superusuario
                                if($PCOSESS_SesionAbierta && PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && $PCO_Accion!="")
                                    {
                            ?>
                                        <li>
                                            <a href="<?php echo $PCO_EnlaceExplorador; ?>"><i class="fa fa fa-cloud-upload fa-fw"></i> <?php echo $MULTILANG_AdminArchivos; ?></a>
                                        </li>
                            <?php
                                    }
                            ?>
                            
                            <?php
                                //Busca las posibles opciones del lado izquierdo
                                // Si el usuario es diferente al administrador agrega condiciones al query
                                if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
                                    {
                                        $Complemento_tablas=",".$TablasCore."usuario_menu";
                                        $Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.id AND ".$TablasCore."usuario_menu.usuario='$PCOSESS_LoginUsuario'";  // AND nivel>0
                                    }
                                $resultado=PCO_EjecutarSQL("SELECT ".$TablasCore."menu.id as id,$ListaCamposSinID_menu FROM ".$TablasCore."menu ".@$Complemento_tablas." WHERE posible_izquierda=1 AND formulario_vinculado=0 ".@$Complemento_condicion." ORDER BY peso");
                                while($registro = $resultado->fetch())
                                    PCO_ImprimirOpcionMenu($registro,'lateral');
                            ?>

							<div id="PCODIV_AbajoMenuLateral"></div>
                        </ul>
                    <!--FIN DE OPCIONES BARRA LATERAL-->

                    <div class="alert alert-info btn-xs" role="alert">
                        <strong><i class='fa fa-bolt fa-fw'></i> 
                        <?php 
                        //Presenta informacion de carga del aplicativo
                        echo $MULTILANG_Instante; ?>:</strong>&nbsp;&nbsp;<?php echo $PCO_FechaOperacionGuiones;?>&nbsp;&nbsp;<?php echo $PCO_HoraOperacionPuntos;?>
                        <br>
                        <?php
                            // Muestra la accion actual si el usuario es administrador y la accion no es vacia - Sirve como guia a la hora de crear objetos
                            if(PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && $PCO_Accion!="")
                                {
                                    echo "<strong><i class='fa fa-cog fa-fw'></i> $MULTILANG_Accion:</strong> $PCO_Accion <br>";
                                    echo "<strong><i class='fa fa-clock-o fa-fw'></i> $MULTILANG_TiempoCarga:</strong> <div id='PCO_TCarga' name='PCO_TCarga' style='display: inline-block;'></div> s<br>";
                                    echo "<strong><i class='fa fa-clock-o fa-fw'></i> $MULTILANG_TiempoCarga (JS):</strong> <div id='PCO_TCargaJS' name='PCO_TCargaJS' style='display: inline-block;'></div> s<br>";
                                    echo "<strong><i class='fa fa-file-code-o fa-fw'></i> Inclusiones:</strong> ".(count(get_included_files()))."<hr>"; // Retorna arreglo con cantidad de archivos incluidos
                                }
                        ?>
                        <div align=center>
							<font size=1><i class="fa fa-copyright"></i> <i><?php echo $MULTILANG_GeneradoPor; ?> <a href="http://www.practico.org" target="_BLANK">Pr&aacute;ctico</a></i></font>
                        </div>
                    </div>

                <!-- DEPRECATED </div> FIN DEL /.sidebar-collapse -->
            </div>
            <!-- FIN DEL /.navbar-static-side -->
<?php
		} //Fin Presentar opciones de la barra a usuarios