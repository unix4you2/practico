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
	if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario) || !$PCOSESS_SesionAbierta)
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
                $contenido_url = @PCO_CargarURL($URL_Recuperacion);
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

<!-- Presenta DashBoard del admin -->
    <div class="well well-sm" style="margin-bottom:0px;">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h3 class="page-header" style="margin-top:0px;"><b><i class="fa fa-dashboard fa-fw"></i> <?php echo $MULTILANG_Aplicacion; ?></b> <i>(<?php echo $MULTILANG_MonEstado; ?>)</i></h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <?php
                    if ($ModoDesarrolladorPractico!="-10000")
                        $ModoDesarrolladorPractico=0;
                                                          //$ClaseColumnas,                         $EstiloPanel,   $ClaseIconoFA,                      $Titulo,                                                                                $SubTitulo,                     $EnlaceTexto,               $EnlaceURL,                                                     $ClaseTextoTitulo="huge")
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "primary",      "fa-table fa-3x",                   PCO_ConsultarTablas()->rowCount(),                                                      "$MULTILANG_Tablas",            "$MULTILANG_TablaDatos",    "javascript:document.PCO_AdministrarTablas.submit();",          "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "green",        "fa-newspaper-o fa-3x",             PCO_ContarRegistrosTabla($TablasCore."formulario","id>".$ModoDesarrolladorPractico),    "$MULTILANG_Formularios",       "$MULTILANG_Detalles",      "javascript:document.PCO_AdministrarFormularios.submit();",     "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "red",          "fa-file-text fa-3x",               PCO_ContarRegistrosTabla($TablasCore."informe","id>".$ModoDesarrolladorPractico),       "$MULTILANG_Informes",          "$MULTILANG_Detalles",      "javascript:document.PCO_AdministrarInformes.submit();",        "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "default",      "fa-external-link-square fa-3x",    PCO_ContarRegistrosTabla($TablasCore."menu"),                                           "Menu(s)",                      "$MULTILANG_Detalles",      "javascript:document.PCOFUNC_AdministrarMenu.submit();",        "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "yellow",       "fa-users fa-3x",                   PCO_ContarRegistrosTabla($TablasCore."usuario"),                                        "$MULTILANG_Usuario(s)",        "$MULTILANG_Detalles",      "javascript:document.PCO_ListarUsuarios.submit();",             "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "info",         "fa-eye fa-3x",                     PCO_ContarRegistrosTabla($TablasCore."auditoria"),                                      "$MULTILANG_UsrAuditoria(s)",   "$MULTILANG_Detalles",      "javascript:document.PCO_PanelAuditoriaMovimientos.submit();",  "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "success",      "fa-thumb-tack fa-3x",              PCO_ContarRegistrosTabla($TablasCore."kanban"),                                         "$MULTILANG_Tareas",            "$MULTILANG_TablerosKanban","javascript:document.PCO_ExplorarTablerosKanban.submit();",     "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "danger",       "fa-bug fa-3x",                     PCO_ContarRegistrosTabla($TablasCore."bugtracker"),                                     "$MULTILANG_TblRegistros",      "$MULTILANG_BTBugtracking", "javascript:document.PCO_BugTrackingForm.submit();",            "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "primary",      "fa-history fa-3x",                 PCO_ContarRegistrosTabla($TablasCore."tareascron"),                                     "CRON(s)",                      "$MULTILANG_Detalles",      "javascript:document.PCO_VerTareasCron.submit();",              "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "green",        "fa-database fa-3x",                PCO_ContarRegistrosTabla($TablasCore."replicasbd"),                                     "Replica(s)",                   "$MULTILANG_Detalles",      "javascript:document.PCO_VerReplicaciones.submit();",           "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "red",          "fa-globe fa-3x",                   PCO_ContarRegistrosTabla($TablasCore."acortadorurls"),                                  "URL(s)",                       "$MULTILANG_Detalles",      "javascript:document.PCO_AcortadorDirecciones.submit();",       "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "default",      "fa-bell fa-3x",                    PCO_ContarRegistrosTabla($TablasCore."monitoreo"),                                      "Monitor(es)",                  "$MULTILANG_Detalles",      "javascript:document.PCO_VerMonitoreo.submit();",               "");
                ?>
            </div>
    
            <div class="row">
                    <div  class="col-md-4 col-lg-4 ">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $MULTILANG_MsjFinal2; ?>
                            </div>
                            <div class="panel-body">
                                <div id="uso-general-aplicativo"></div>
                            </div>
                        </div>
                    </div>
                    <div  class=" col-md-4 col-lg-4">


                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-users fa-fw"></i> Usuarios activos (&uacute;ltimos d&iacute;as)
                                </div>
                                <div class="panel-body">
                                    <div id="">

                                    <table width="100%">
                                        <tr>
                                            <td width=33% align=center>
                                                    Hoy<br>
                                                    <i class="fa-2x" style="color:green;"><b>     <?php echo PCO_EjecutarSQL("SELECT COUNT(DISTINCT usuario_login) FROM core_auditoria WHERE fecha=DATE(NOW()) ")->fetchColumn(); ?>                          </i></b>
                                            </td>
                                            <td width=33% align=center>
                                                    Semana<br>
                                                    <i class="fa-2x" style="color:navy;"><b>     <?php echo PCO_EjecutarSQL("SELECT COUNT(DISTINCT usuario_login) FROM core_auditoria WHERE fecha >= date_sub(now(),INTERVAL 1 WEEK) ")->fetchColumn(); ?>   </i></b>                                   
                                            </td>
                                            <td width=33% align=center>
                                                    Mes<br>
                                                    <i class="fa-2x" style="color:red;"><b>     <?php echo PCO_EjecutarSQL("SELECT COUNT(DISTINCT usuario_login) FROM core_auditoria WHERE fecha >= date_sub(now(),INTERVAL 4 WEEK) ")->fetchColumn(); ?>   </i></b>                                    
                                            </td>
                                        </tr>
                                    </table>
      
                                        
                                    </div>
                                </div>
                            </div>

                        <?php
                                            //$informe,$en_ventana=1,$formato="htm",$estilo="Informes",$embebido=0,$anular_acciones=0,$anular_piepagina=0,$anular_encabezado=0,$SQLPuro="")
                            PCO_CargarInforme(-28,1,"","",1,1,0,0,"");
                        ?>

                    </div>            
                    <div  class="col-md-4 col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $MULTILANG_TotalRegistros; ?>
                            </div>
                            <div class="panel-body">
                                <div id="conteos-generales-aplicacion"></div>
                            </div>
                        </div>
                    </div>

            </div>
    </div>



<?php

    //Obtiene entradas del canal RSS de Practico
    if (1==2) 
        {
            //Llamado a la funcion derivada de SOPA de Practico
            $EntradasGitHub = ObtenerEntradas_GitHub("unix4you2");
            //Despliegue de resultados

            //Abre un contenedor (Opcional)
            PCO_AbrirVentana('Ultimas '.count($EntradasGitHub).' Entradas ATOM', 'panel-primary');

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
            PCO_CerrarVentana();

        }

?>



    <!--SEPARADOR-->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><?php echo $MULTILANG_Escritorio; ?></h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>