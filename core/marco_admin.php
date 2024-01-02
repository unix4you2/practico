<?php
/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2012-2022
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
	 This program is free software: you can redistribute it and/or modify
	 it under the terms of the GNU General Public License as published by
	 the Free Software Foundation, either version 3 of the License, or
	 (at your option) any later version.

	 This program is distributed in the hope that it will be useful,
	 but WITHOUT ANY WARRANTY; without even the implied warranty of
	 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 GNU General Public License for more details.

	 You should have received a copy of the GNU General Public License
	 along with this program.  If not, see <http://www.gnu.org/licenses/>
	 
	            --- TRADUCCION NO OFICIAL DE LA LICENCIA ---

     Esta es una traducción no oficial de la Licencia Pública General de
     GNU al español. No ha sido publicada por la Free Software Foundation
     y no establece los términos jurídicos de distribución del software 
     publicado bajo la GPL 3 de GNU, solo la GPL de GNU original en inglés
     lo hace. De todos modos, esperamos que esta traducción ayude a los
     hispanohablantes a comprender mejor la GPL de GNU:
	 
     Este programa es software libre: puede redistribuirlo y/o modificarlo
     bajo los términos de la Licencia General Pública de GNU publicada por
     la Free Software Foundation, ya sea la versión 3 de la Licencia, o 
     (a su elección) cualquier versión posterior.

     Este programa se distribuye con la esperanza de que sea útil pero SIN
     NINGUNA GARANTÍA; incluso sin la garantía implícita de MERCANTIBILIDAD
     o CALIFICADA PARA UN PROPÓSITO EN PARTICULAR. Vea la Licencia General
     Pública de GNU para más detalles.

     Usted ha debido de recibir una copia de la Licencia General Pública de
     GNU junto con este programa. Si no, vea <http://www.gnu.org/licenses/>
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
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <h3 class="page-header" style="margin-top:0px;"><b><i class="fa fa-dashboard fa-fw"></i> <?php echo $MULTILANG_Aplicacion; ?></b> <i>(<?php echo $MULTILANG_MonEstado; ?>)</i></h3>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="pull-right" style="margin-top:0px;"><a href="index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=frm:-42:0" class="btn btn-info"><i class="fa fa-bar-chart-o fa-fw"></i> Ver anal&iacute;tica</a></div>
                </div>
            </div>
            <div class="row">
                <?php
                    if ($ModoDesarrolladorPractico!="-10000")
                        $ModoDesarrolladorPractico=0;
                                                          //$ClaseColumnas,                         $EstiloPanel,   $ClaseIconoFA,                      $Titulo,                                                                                $SubTitulo,                     $EnlaceTexto,               $EnlaceURL,                                                     $ClaseTextoTitulo="huge")
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "primary",      "fa-table fa-3x",                   PCO_ConsultarTablas()->rowCount(),                                                      "$MULTILANG_Tablas",            "$MULTILANG_TablaDatos",    "javascript:document.PCO_AdministrarTablas.submit();",          "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "green",        "fa-newspaper-o fa-3x",             PCO_ContarRegistrosTabla($TablasCore."formulario","id>".$ModoDesarrolladorPractico),    "$MULTILANG_Formularios",       "$MULTILANG_Detalles",      "javascript:document.PCO_AdministrarFormularios.submit();",     "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "red",          "fa-file-text fa-3x",               PCO_ContarRegistrosTabla($TablasCore."informe","id>".$ModoDesarrolladorPractico),       "$MULTILANG_Informes",          "$MULTILANG_Detalles",      "javascript:document.PCO_AdministrarInformes.submit();",        "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "default",      "fa-external-link-square fa-3x",    PCO_ContarRegistrosTabla($TablasCore."menu","seccion<>'PCO_NoVisible'"),                "Menu(s)",                      "$MULTILANG_Detalles",      "javascript:document.PCOFUNC_AdministrarMenu.submit();",        "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "yellow",       "fa-users fa-3x",                   PCO_ContarRegistrosTabla($TablasCore."usuario"),                                        "$MULTILANG_Usuario(s)",        "$MULTILANG_Detalles",      "javascript:document.PCO_ListarUsuarios.submit();",             "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "info",         "fa-eye fa-3x",                     PCO_ContarRegistrosTabla($TablasCore."auditoria"),                                      "$MULTILANG_UsrAuditoria(s)",   "$MULTILANG_Detalles",      "index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=frm:-7:1",    "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "success",      "fa-thumb-tack fa-3x",              PCO_ContarRegistrosTabla($TablasCore."kanban"),                                         "$MULTILANG_Tareas",            "$MULTILANG_TablerosKanban","javascript:document.PCO_ExplorarTablerosKanban.submit();",     "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "danger",       "fa-bug fa-3x",                     PCO_ContarRegistrosTabla($TablasCore."bugtracker"),                                     "$MULTILANG_TblRegistros",      "$MULTILANG_BTBugtracking", "javascript:document.PCO_BugTrackingForm.submit();",            "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "primary",      "fa-history fa-3x",                 PCO_ContarRegistrosTabla($TablasCore."tareascron"),                                     "CRON(s)",                      "$MULTILANG_Detalles",      "javascript:document.PCO_VerTareasCron.submit();",              "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "green",        "fa-database fa-3x",                PCO_ContarRegistrosTabla($TablasCore."replicasbd"),                                     "Replica(s)",                   "$MULTILANG_Detalles",      "javascript:document.PCO_VerReplicaciones.submit();",           "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "red",          "fa-globe fa-3x",                   PCO_ContarRegistrosTabla($TablasCore."acortadorurls"),                                  "URL(s)",                       "$MULTILANG_Detalles",      "javascript:document.PCO_AcortadorDirecciones.submit();",       "");
                    echo PCO_ImprimirPanelSimpleDashboard("col-xs-12 col-sm-6 col-md-3 col-lg-2",   "default",      "fa-bell fa-3x",                    PCO_ContarRegistrosTabla($TablasCore."monitoreo"),                                      "Monitor(es)",                  "$MULTILANG_Detalles",      "javascript:document.PCO_VerMonitoreo.submit();",               "");
                ?>
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