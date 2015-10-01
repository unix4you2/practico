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
		Title: Seccion Escritorio Administrativo
		Ubicacion *[/core/marco_admin.php]*.  Presenta opciones de escritorio para el usuario administrador

	Ver tambien:
		<Seccion superior> | <Articulador>
	*/

	//Valida que quien llame este marco tenga permisos suficientes
	if (@$PCOSESS_LoginUsuario!="admin" || !$PCOSESS_SesionAbierta)
		die();


/* ################################################################## */
/* ################################################################## */
/*
	Function: ObtenerEntradas_GitHub
	Recupera el ATOM de una cuenta GitHub para presentarla dentro de las noticias
	
	Variables de entrada:

		Login - Login utilizado en GitHub
		
	Salida:
		Retorna variable con las entradas del Feed
*/
function ObtenerEntradas_GitHub($ID_Usuario="",$Cantidad=5)
    {
        //Cuando ya se cuenta con un ID de FanPage hace la consulta
        if ($ID_Usuario!="")
            {
                $URL_Recuperacion="https://github.com/$ID_Usuario.atom";
                $contenido_url = @cargar_url($URL_Recuperacion);
                //Si se ha obtenido respuesta entonces procesa entradas
                if ($contenido_url!="")
                    {
                        // Usa SimpleXML Directamente para interpretar respuesta
                        $EntradasObtenidas = simplexml_load_string($contenido_url);
                        // Procesa la respuesta recibida en el XML
                        $NumEntradaProcesada=1;
                        foreach($EntradasObtenidas->entry as $Entrada)
                            {
/*                                
                                //Parsea contenido HTML mediante DOM/XML
                                $Contenido_Entrada=$Entrada->content;
                                # Crea objeto DOM y carga el contenido
                                $dom = new DOMDocument();
                                @$dom->loadHTML("<html><body> $Contenido_Entrada </body></html>");
                                
                                $contenidosss= $dom->getElementsByTagName('a');
                                echo $contenidosss->getAttribute('href');
                                
                                //Carga los de tipo enlace solamente
                                ///$link=$dom->getElementsByTagName('a') ;

                                  //      echo $link->getAttribute('href');
                                //echo $Contenido_Entrada->$blockquote;
  */
                                
                                $EntradasGitHub[]=@array(Fecha => $Entrada->published, Titulo => $Entrada->title, Enlace => $Entrada->content);
                                //Cuenta la entrada procesada y se detiene segun las deseadas
                                $NumEntradaProcesada++;
                                if($NumEntradaProcesada > $Cantidad)
                                    break;
                            }
                    }
            }
        return $EntradasGitHub;
    }

?>

<form name="administrar_tablas" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="administrar_tablas">
</form>
<form name="administrar_formularios" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="administrar_formularios">
</form>
<form name="administrar_menu" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="administrar_menu">
</form>
<form name="administrar_informes" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="administrar_informes">
</form>
<form name="listar_usuarios" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="listar_usuarios">
</form>
<form name="ver_seguimiento_monitoreo" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="ver_seguimiento_monitoreo">
</form>


<!-- Presenta DashBoard del admin -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><?php echo $MULTILANG_Aplicacion; ?></h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
 
     <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-table fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php
                                    $resultado=consultar_tablas();
                                    $cantidad_tablas=0;
                                    while ($registro = $resultado->fetch())
                                        $cantidad_tablas++;
                                    echo $cantidad_tablas;
                                ?>
                            </div>
                            <div><?php echo $MULTILANG_TablaDatos; ?></div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer" OnClick="document.administrar_tablas.submit();">
                        <span class="pull-left"><?php echo $MULTILANG_Detalles?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-newspaper-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo ContarRegistros($TablasCore."formulario"); ?></div>
                            <div><?php echo $MULTILANG_Formularios; ?>(s)</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer" OnClick="document.administrar_formularios.submit();">
                        <span class="pull-left" ><?php echo $MULTILANG_Detalles?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-file-text fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo ContarRegistros($TablasCore."informe"); ?></div>
                            <div><?php echo $MULTILANG_Informes; ?></div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer" OnClick="document.administrar_informes.submit();">
                        <span class="pull-left" ><?php echo $MULTILANG_Detalles?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-external-link-square fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo ContarRegistros($TablasCore."menu"); ?></div>
                            <div><?php echo $MULTILANG_OpcionesMenu; ?></div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer" OnClick="document.administrar_menu.submit();">
                        <span class="pull-left" ><?php echo $MULTILANG_Detalles?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo ContarRegistros($TablasCore."usuario"); ?></div>
                            <div><?php echo $MULTILANG_Usuario; ?>(s)</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer" OnClick="document.listar_usuarios.submit();">
                        <span class="pull-left" ><?php echo $MULTILANG_Detalles?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-eye fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo ContarRegistros($TablasCore."auditoria"); ?></div>
                            <div><?php echo $MULTILANG_UsrAuditoria; ?>(s)</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer" OnClick="document.ver_seguimiento_monitoreo.submit();">
                        <span class="pull-left" ><?php echo $MULTILANG_Detalles?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

    </div>

<hr>

    <div class="row">
        <div  class="col-lg-3 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $MULTILANG_MsjFinal2; ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="uso-general-aplicativo"></div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-8 -->

        <div  class="col-lg-3 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $MULTILANG_TotalRegistros; ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="conteos-generales-aplicacion"></div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->

<?php

    //Obtiene entradas del canal RSS de Practico
    if (1==2) 
        {
            //Llamado a la funcion derivada de SOPA de Practico
            $EntradasGitHub = ObtenerEntradas_GitHub("unix4you2");
            //Despliegue de resultados

            //Abre un contenedor (Opcional)
            abrir_ventana('Ultimas '.count($EntradasGitHub).' Entradas ATOM', 'panel-primary');

            //Encabezados de la tabla
            echo '
                <table class="table table-hover table-striped table-bordered btn-xs">
                    <thead>
                        <tr>
                          <th>Titulo</td>
                          <th>Fecha</td>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach($EntradasGitHub as $fila):
                            echo '
                                <tr>
                                    <td>'.$fila['Titulo'].'
                                    
                                    '.$fila['Enlace'].'
                                    </td>
                                    <td>'.$fila['Fecha'].'</td>
                                </tr>';
                        endforeach;
            echo '  </tbody>
                </table>';
            //Cierra el contenedor (Obligatorio si se ha abierto alguno)
            cerrar_ventana();

        }

?>



    <!--SEPARADOR-->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><?php echo $MULTILANG_Escritorio; ?></h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>

