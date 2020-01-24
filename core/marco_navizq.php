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
            <div id="barra_navegacion_izquierda" class="navbar-default sidebar" role="navigation" style="z-indexxxx:1000;">
                <!-- DEPRECATED para el marco inferior <div class="sidebar-nav navbar-collapse">-->
                <div id="PCO_BarraNavegacionIzquierda">
                    <!--INICIO DE OPCIONES BARRA LATERAL-->
                        <ul class="nav" id="side-menu">
                            
                            <div id="PCODIV_ArribaMenuLateral"></div>
                            
                            <form name="datos_busqueda_home" action="<?php echo $ArchivoCORE; ?>" method="POST">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input name="PCO_BusquedaPermisos" type="text" class="form-control" placeholder="<?php echo $MULTILANG_Buscar; ?>...">
                                    <input type="hidden" name="PCO_Accion" value="PCO_BuscarPermisosPractico">
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
                                <a href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-dashboard fa-fw"></i> <?php echo $MULTILANG_Escritorio; ?></a>
                            </li>
                            <li>
                                <a href="javascript:document.PCO_MisInformes.submit();"><i class="fa fa-pie-chart fa-fw"></i> <?php echo $MULTILANG_UsrInfDisp; ?></a>
                            </li>

							
                            <?php
                            	// Carga las opciones del ACORDEON
                            	echo '<li>';
                            	// Si el usuario es diferente al administrador agrega condiciones al query
                            	if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
                            		{
                            			$Complemento_tablas=",".$TablasCore."usuario_menu";
                            			$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.hash_unico AND ".$TablasCore."usuario_menu.usuario='$PCOSESS_LoginUsuario'";  // AND nivel>0
                            		}
                            	$ResultadoConteoSecciones=PCO_EjecutarSQL("SELECT COUNT(*) as conteo,seccion FROM ".$TablasCore."menu ".@$Complemento_tablas." WHERE (padre=0 OR padre='') AND posible_izquierda=1 AND formulario_vinculado=0 ".@$Complemento_condicion." GROUP BY seccion ORDER BY peso,seccion");
                            	// Imprime las secciones encontradas para el usuario
                            	while($RegistroConteoSecciones = $ResultadoConteoSecciones->fetch())
                            		{
                            			//Crea la seccion en el acordeon
                            			$seccion_menu_activa=$RegistroConteoSecciones["seccion"];
                            			$conteo_opciones=$RegistroConteoSecciones["conteo"];
                            
                            			echo '<div style="background: darkgray !important; margin:0px; paddign:0px; width: 100%; font-size:0.95em; font-weight:bold;" class="well well-sm" align=center>'.$seccion_menu_activa.'</div>';
                            
                            			//PCO_AbrirVentana($seccion_menu_activa.' ('.$conteo_opciones.')', 'panel-primary');
                            			// Busca las opciones dentro de la seccion
                            
                            			// Si el usuario es diferente al administrador agrega condiciones al query
                            			if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
                            				{
                            					$Complemento_tablas=",".$TablasCore."usuario_menu";
                            					$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.hash_unico AND ".$TablasCore."usuario_menu.usuario='$PCOSESS_LoginUsuario'";  // AND nivel>0
                            				}
                            			$resultado_opciones_acordeon=PCO_EjecutarSQL("SELECT ".$TablasCore."menu.id as id,$ListaCamposSinID_menu FROM ".$TablasCore."menu ".@$Complemento_tablas." WHERE (padre=0 OR padre='') AND posible_izquierda=1 AND formulario_vinculado=0 AND seccion='".$seccion_menu_activa."' ".@$Complemento_condicion." ORDER BY peso,texto");
                            			while($registro_opciones_acordeon = $resultado_opciones_acordeon->fetch())
                            				PCO_ImprimirOpcionMenu($registro_opciones_acordeon,'lateral');
                            		}
                            	echo '</li>';
                            ?>

                            <li>
                                <div id="PCODIV_AbajoMenuLateral"></div>

                                <div class="alert alert-info btn-xs">
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
                            </li>

                        </ul>
                    <!--FIN DE OPCIONES BARRA LATERAL-->

                </div>
                <!-- DEPRECATED </div> FIN DEL /.sidebar-collapse -->
            </div>
            <!-- FIN DEL /.navbar-static-side -->
<?php
		} //Fin Presentar opciones de la barra a usuarios
?>

<script language="JavaScript">
    //Oculta la barra de navegacion superior a los usuarios estandar segun la configuracion y en algunas secciones fijas del sistema
    //VEASE FUNCION HERMANA EN MARCO_NAV.PHP QUE SE ENCARGA DE OCULTAR LA BARRA SUPERIOR
    <?php
        if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && $PWA_OcultarBarrasHerramientas=="1" )
            echo '$("#boton_menu_izquierdo").hide();';
    ?>
</script>