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
		Title: Seccion inferior
		Ubicacion *[/core/marco_abajo.php]*.  Archivo dedicado a la diagramacion de contenidos en el pie de pagina de la aplicacion, incluye valores de accion y tiempos para el usuario administrador.

	Variables de entrada:

		PCOSESS_LoginUsuario - Nombre de usuario que se encuentra logueado en el sistema
		accion - Accion llamada actualmente en Practico (identificador unico de funcion interna o personalizada)
		tiempo_inicio_script - Hora en microtime marcada para el incio del script

		(start code)
			if(PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && $PCO_Accion!="")
				{
					$tiempo_final_script = PCO_ObtenerMicrotime();
					$tiempo_total_script = $tiempo_final_script - $tiempo_inicio_script;
				}
		(end)

	Salida:
		Pie de pagina de aplicacion e informacion asociada a la accion y tiempos de ejecucion en caso de ser el usuario administrador

	Ver tambien:
		<Seccion superior> | <Articulador>
	*/
?>
 



						<div id="PCODIV_AbajoEscritorio"></div>

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->



		<!-- Modal para mensajes generales -->
		<div id="PCO_Modal_Mensaje" class="modal fade oculto_impresion">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
						<h4 id="PCO_Modal_MensajeTitulo" class="modal-title"></h4>
					</div>
					<div class="modal-body">
						<p id="PCO_Modal_MensajeCuerpo"></p>
					</div>
					<div class="modal-footer">
						<div id="PCO_Modal_MensajeBotones"><button type="button" class="btn btn-outline btn-info" data-dismiss="modal">Cerrar</button></div>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->


		<!-- Modal para mensajes de carga -->
		<div id="PCO_Modal_MensajeCargando" class="modal fade oculto_impresion"  data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button id="PCO_Modal_MensajeCargandoBotonCerrar" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
						<h4 id="PCO_Modal_MensajeCargandoTitulo" class="modal-title"></h4>
					</div>
					<div class="modal-body">
						<div class="progress" id="PCO_Modal_MensajeCargandoBarra">
							<div id="PCO_Modal_MensajeCargandoPorcentaje" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%"></div>
						</div>
						<p id="PCO_Modal_MensajeCargandoCuerpo"></p>
						<div align="right"><i class="fa fa-circle-o-notch fa-fw fa-spin fa-1x"></i></div>
						
						<a href="javascript:PCOJS_OcultarMensajeCargando();"><?php echo $MULTILANG_Cerrar; ?></a>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- Modal para mensajes de carga -->
		<div id="PCO_Modal_MensajeCargandoSimple" class="modal oculto_impresion" data-backdrop="false">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-body" align="center">
						<div class="progress" id="PCO_Modal_MensajeCargandoBarra">
							<div id="PCO_Modal_MensajeCargandoPorcentaje" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
						</div>
						<i class="fa fa-circle-o-notch fa-fw fa-spin fa-1x"></i> <?php echo $MULTILANG_Cargando; ?>...
						
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->


    </div>
    <!-- /#wrapper inicial -->

<!--</div>--> <!-- FINALIZA MARCO DE CHAT -->



    <!-- Plugins JavaScript requeridos por DateTimePicker -->
    <script src="inc/bootstrap/js/plugins/moment/moment-with-locales.min.js"></script>

    <!-- Plugins JavaScript adicionales -->
    <script type="text/javascript" src="inc/bootstrap/js/plugins/transition.js"></script>
    <script type="text/javascript" src="inc/bootstrap/js/plugins/collapse.js"></script>
    <script type="text/javascript" src="inc/bootstrap/js/plugins/slider/bootstrap-slider.js"></script>
    <script type="text/javascript" src="inc/bootstrap/js/plugins/metisMenu/metisMenu.min.js"></script>
    <!-- Bootstrap-Iconpicker Fuentes de iconos -->
    <script type="text/javascript" src="inc/bootstrap/js/plugins/iconpicker/iconset/iconset-fontawesome-4.2.0.min.js"></script>
    <script type="text/javascript" src="inc/bootstrap/js/plugins/iconpicker/iconset/iconset-glyphicon.min.js"></script>
    <script type="text/javascript" src="inc/bootstrap/js/plugins/iconpicker/iconset/iconset-ionicon-1.5.2.min.js"></script>
    <script type="text/javascript" src="inc/bootstrap/js/plugins/iconpicker/iconset/iconset-octicon-2.1.2.min.js"></script>
    <script type="text/javascript" src="inc/bootstrap/js/plugins/iconpicker/iconset/iconset-typicon-2.0.6.min.js"></script>
    <script type="text/javascript" src="inc/bootstrap/js/plugins/iconpicker/iconset/iconset-weathericon-1.2.0.min.js"></script>
    <!--<script type="text/javascript" src="inc/bootstrap/js/plugins/iconpicker/iconset/iconset-elusiveicon-2.0.0.min.js"></script>-->
    <!--<script type="text/javascript" src="inc/bootstrap/js/plugins/iconpicker/iconset/iconset-mapicon-2.1.0.min.js"></script>-->
    <script type="text/javascript" src="inc/bootstrap/js/plugins/iconpicker/bootstrap-iconpicker.min.js"></script>

    <!-- Plugins JavaScript requeridos por DateTimePicker -->
    <script src="inc/bootstrap/js/plugins/datepicker/bootstrap-datetimepicker.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <?php
        //Carga solo Morris cuando es pagina principal por ahora para evitar conflictos con DatePicker
        if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && @$PCOSESS_SesionAbierta && @$PCO_Accion=="PCO_VerMenu")
        // Incluye archivo con las consultas y datos para ser diagramados por Morris
            include_once("core/marco_admin_morris.php");
    ?>
    
    <!-- Gantt -->
    <script src="inc/jquery/plugins/gantt-master/js/jquery.fn.gantt.js"></script>

    <!-- DataTables JavaScript -->
    <script src="inc/bootstrap/js/plugins/dataTables/jquery.dataTables.min.js"></script>
    <script src="inc/bootstrap/js/plugins/dataTables/dataTables.buttons.min.js"></script><!--N-->
    <script src="inc/bootstrap/js/plugins/dataTables/buttons.html5.min.js"></script><!--N-->
    <script src="inc/bootstrap/js/plugins/dataTables/buttons.colVis.min.js"></script><!--N-->

    <script src="inc/bootstrap/js/plugins/dataTables/dataTables.bootstrap.min.js"></script>
    
    <script src="inc/bootstrap/js/plugins/dataTables/dataTables.select.min.js"></script>
    <script src="inc/bootstrap/js/plugins/dataTables/dataTables.searchPanes.min.js"></script>

    <!-- DataTables Responsive -->
    <script src="inc/bootstrap/js/plugins/dataTables/dataTables.responsive.min.js"></script><!--N-->

	<!-- Canvas -->
    <script type="text/javascript" src="inc/jquery/plugins/sketch.js"></script>
    
    <!-- SummerNote -->
    <script src="inc/summernote/summernote.min.js"></script>
    <script src="inc/summernote/lang/summernote-<?php echo $IdiomaPredeterminado; ?>-<?php echo strtoupper($IdiomaPredeterminado); ?>.min.js"></script>

    <!-- JavaScript Personalizado del tema -->
    <script src="inc/bootstrap/js/sb-admin-2.js"></script>
    <script src="inc/bootstrap/js/practico.min.js?<?php echo filemtime('inc/bootstrap/js/practico.min.js'); ?>"></script>
    <?php
    	//Carga marco de chat solamente si esta habilitado
    	if (isset($Activar_ModuloChat) && $Activar_ModuloChat>0 && @$_SESSION['username']!="")
        	{
	?>
                <!-- Chat -->
                <script type="text/javascript" src="inc/chat/js/chat.js"></script>
    <?php
    	    }
    ?>


    <?php
        //Si el usuario es admin por defecto presenta la barra lateral activa
        // DEPRECATED: (PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && @$PCOSESS_SesionAbierta && @$PCO_Accion=="PCO_VerMenu") || 
        if ((@$PCOSESS_LoginUsuario!="" && @$PCOSESS_SesionAbierta && @$VerNavegacionIzquierdaResponsive==1))
            echo '<script language="JavaScript">
                    ver_navegacion_izquierda_responsive();
                </script>';
    ?>

    <?php
        // Habilita el popup activo
        if (@$popup_activo=="FormularioCampos")	
            echo '<script type="text/javascript"> $(window).load(function(){ $("#myModalElementoFormulario").modal("show"); }); </script>';
        if (@$popup_activo=="FormularioBotones")
            echo '<script type="text/javascript"> $(window).load(function(){ $("#myModalBotonFormulario").modal("show"); }); </script>';
        if (@$popup_activo=="FormularioDiseno")
            echo '<script type="text/javascript"> $(window).load(function(){ $("#myModalDisenoFormulario").modal("show"); }); </script>';
        if (@$popup_activo=="FormularioAcciones")
            echo '<script type="text/javascript"> $(window).load(function(){ $("#myModalDisenoBotones").modal("show"); }); </script>';
        if (@$popup_activo=="InformeAcciones")
            echo '<script type="text/javascript"> $(window).load(function(){ $("#myModalEditaAccionesInforme").modal("show"); }); </script>';
        if (@$popup_activo=="InformeCampos")
            echo '<script type="text/javascript"> $(window).load(function(){ $("#myModalCamposInforme").modal("show"); }); </script>';
        if (@$popup_activo=="InformeTablas")
            echo '<script type="text/javascript"> $(window).load(function(){ $("#myModalTablaInforme").modal("show"); }); </script>';
        if (@$popup_activo=="InformeCondiciones")
            echo '<script type="text/javascript"> $(window).load(function(){ $("#myModalCondicionesInforme").modal("show"); }); </script>';
        //Habilita pesatanas activas en el popup activo
        if (@$pestana_activa_editor=="eventos_objeto-tab")
            echo '<script type="text/javascript"> $(window).load(function(){ $(\'.nav-tabs a[href="#eventos_objeto-tab"]\').tab(\'show\'); }); </script>';
    ?>

    <script language="JavaScript">
        //Actualiza tamano del marco principal para garantizar siempre un tamano adecuado de fondo
        //TODO: Verificar consistencia en paginas grades como la administrativa
        $( function() {
            var PCOJSVAR_HayScroll=false;
            //Verifica si hay scroll  METODO 1
            if (document.getElementById("page-wrapper").scrollHeight==$(document).height())
                PCOJSVAR_HayScroll=true;
            //Si hay scroll el alto debe tener !important para que se estire hasta abajo en la página.  Si no hay scroll solo 100%
            if( PCOJSVAR_HayScroll )
                {
                    //$("#page-wrapper").css({ 'height': "100% !important" }); //SI Hay scroll  
                    //console.log("Scroll detectado");
                }
            else
                {
                    $("#page-wrapper").css({ 'height': "100%" }); // NO Hay scroll  
                    //console.log("Scroll NO detectado");
                }
        });
    </script>

    <script language="JavaScript">
        //Carga los tooltips programados en la hoja.  Por defecto todos los elementos con data-toggle=tootip
        $(function () {
          $('[data-toggle="tooltip"]').tooltip({'container':'body'});
        })
    </script>

    <script language="JavaScript">
        //Carga los popovers programados en la hoja.  Por defecto todos los elementos con data-toggle=popover
        $(function () {
          $('[data-toggle="popover"]').popover()
        })
    </script>

    <script language="JavaScript">
        //Carga las tablas en formato DataTable
        $( function() {
            <?php
                //Desglosa la cadena de posibles tablas con formato DataTable y las convierte
                $TablasDataTable=@explode("|",$PCO_InformesDataTable);
                $TablasDataTablePaginaciones=@explode("|",$PCO_InformesDataTablePaginaciones);
                $TablasDataTableTotales=@explode("|",$PCO_InformesDataTableTotales);
                $TablasDataTableFormatosTotales=@explode("|",$PCO_InformesDataTableFormatoTotales);
                $TablasDataTableExportaCLP=@explode("|",$PCO_InformesDataTableExrpotaCLP);
                $TablasDataTableExportaCSV=@explode("|",$PCO_InformesDataTableExrpotaCSV);
                $TablasDataTableExportaXLS=@explode("|",$PCO_InformesDataTableExrpotaXLS);
                $TablasDataTableExportaPDF=@explode("|",$PCO_InformesDataTableExrpotaPDF);
                $TablasDataTableDefineCOLS=@explode("|",$PCO_InformesDataTableDefineCOLS);
                $TablasDataTableIdCache=@explode("|",$PCO_InformesIdCache);
                $TablasDataTableRecuperacionAJAX=@explode("|",$PCO_InformesRecuperacionAJAX);
                $TablasDataTableColumnas=@explode("|",$PCO_InformesListaColumnasDT);
                $TablasDataTable_pane_activado=@explode("|",$PCO_InformesDataTable_pane_activado);
                $TablasDataTable_pane_cascada=@explode("|",$PCO_InformesDataTable_pane_cascada);
                $TablasDataTable_pane_colapsado=@explode("|",$PCO_InformesDataTable_pane_colapsado);
                $TablasDataTable_pane_columnas=@explode("|",$PCO_InformesDataTable_pane_columnas);
                $TablasDataTable_pane_subtotalesrelativos=@explode("|",$PCO_InformesDataTable_pane_subtotalesrelativos);
                $TablasDataTable_pane_conteos=@explode("|",$PCO_InformesDataTable_pane_conteos);
                $TablasDataTable_pane_controles=@explode("|",$PCO_InformesDataTable_pane_controles);
                $TablasDataTable_pane_control_colapsar=@explode("|",$PCO_InformesDataTable_pane_control_colapsar);
                $TablasDataTable_pane_control_ordenar=@explode("|",$PCO_InformesDataTable_pane_control_ordenar);
                
                if (1==1)  //Solo para efectos de depuracion, cambiar a condicion invalida en produccion
                echo "
                    /*
                        Activacion de elementos tipo DATATABLE (depuracion):
                        PCO_InformesDataTable=$PCO_InformesDataTable
                        PCO_InformesDataTablePaginaciones=$PCO_InformesDataTablePaginaciones
                        PCO_InformesDataTableTotales=$PCO_InformesDataTableTotales
                        PCO_InformesDataTableFormatoTotales=$PCO_InformesDataTableFormatoTotales
                        PCO_InformesDataTableExrpotaCLP=$PCO_InformesDataTableExrpotaCLP
                        PCO_InformesDataTableExrpotaCSV=$PCO_InformesDataTableExrpotaCSV
                        PCO_InformesDataTableExrpotaXLS=$PCO_InformesDataTableExrpotaXLS
                        PCO_InformesDataTableExrpotaPDF=$PCO_InformesDataTableExrpotaPDF
                        PCO_InformesTablasDataTableDefineCOLS=$PCO_InformesDataTableDefineCOLS
                        PCO_InformesIdCache=$PCO_InformesIdCache
                        PCO_InformesRecuperacionAJAX=$PCO_InformesRecuperacionAJAX
                        PCO_InformesListaColumnasDT=$PCO_InformesListaColumnasDT
                    */";
                
                for ($i=0; $i<count($TablasDataTable);$i++)
                    {
                        //Agrega codigo para activacion de DataTable solamente cuando se tenga un ID de tabla valido
                        if ($TablasDataTable[$i]!="")
                            {
                                $Paginacion=trim($TablasDataTablePaginaciones[$i]);
                                $ColumnaTotales=trim($TablasDataTableTotales[$i])-1;
                                $ColumnaTotalesVisual=trim($TablasDataTableTotales[$i]);
                                $CadenaFormateadaTotales=trim($TablasDataTableFormatosTotales[$i]);
                                $CadenaExportaCLP=trim($TablasDataTableExportaCLP[$i]); if ($CadenaExportaCLP=="S") $CadenaExportaCLP='{ extend: "copy",    className: "InformeBotonCopiar" },'; else $CadenaExportaCLP='';
                                $CadenaExportaCSV=trim($TablasDataTableExportaCSV[$i]); if ($CadenaExportaCSV=="S") $CadenaExportaCSV='{ extend: "csv",     className: "InformeBotonCsv" },   '; else $CadenaExportaCSV='';
                                $CadenaExportaXLS=trim($TablasDataTableExportaXLS[$i]); if ($CadenaExportaXLS=="S") $CadenaExportaXLS='{ extend: "excel",   className: "InformeBotonExcel" ,  title: "" }, '; else $CadenaExportaXLS='';
                                $CadenaExportaPDF=trim($TablasDataTableExportaPDF[$i]); if ($CadenaExportaPDF=="S") $CadenaExportaPDF='{ extend: "pdf",     className: "InformeBotonPdf" },   '; else $CadenaExportaPDF='';
                                $CadenaPersonalizarColumnas=trim($TablasDataTableDefineCOLS[$i]); if ($CadenaPersonalizarColumnas=="S") $CadenaPersonalizarColumnas='{ extend: "colvis",  text:"'.$MULTILANG_Columna.'(s)",  className: "InformeBotonCopiar" }, '; else $CadenaPersonalizarColumnas='';

                                //DEFINE CADENAS EN PANELES DE FILTRADO
                                $CadenaPosicionPanelesArriba="";
                                $CadenaPosicionPanelesAbajo="";
                                $Cadena_pane_cascada="";
                                $Cadena_pane_colapsado="";
                                $Cadena_pane_columnas="";
                                $Cadena_pane_subtotalesrelativos="";
                                $Cadena_pane_conteos="";
                                $Cadena_pane_controles="";
                                $Cadena_pane_control_colapsar="";
                                $Cadena_pane_control_ordenar="";
                                if ($TablasDataTable_pane_activado[$i]=="S") $CadenaPosicionPanelesArriba="P";
                                if ($TablasDataTable_pane_activado[$i]=="I") $CadenaPosicionPanelesAbajo="P";
                                if ($TablasDataTable_pane_cascada[$i]=="S") $Cadena_pane_cascada=" cascadePanes: true, ";
                                if ($TablasDataTable_pane_colapsado[$i]=="S") $Cadena_pane_colapsado=" initCollapsed: true, ";
                                if ($TablasDataTable_pane_columnas[$i]!="") $Cadena_pane_columnas=' layout: "columns-'.$TablasDataTable_pane_columnas[$i].'", ';
                                if ($TablasDataTable_pane_subtotalesrelativos[$i]=="S") $Cadena_pane_subtotalesrelativos=" viewTotal: false, ";
                                if ($TablasDataTable_pane_conteos[$i]!="S") $Cadena_pane_conteos=" viewCount: false, ";
                                if ($TablasDataTable_pane_controles[$i]!="S") $Cadena_pane_controles=" controls: false, ";
                                if ($TablasDataTable_pane_control_colapsar[$i]!="S") $Cadena_pane_control_colapsar=" collapse: false, ";
                                if ($TablasDataTable_pane_control_ordenar[$i]!="S") $Cadena_pane_control_ordenar=" orderable: false, ";
                                $CadenaPanelesFiltrado='
                                            searchPanes:
                                                {
                                                    '.$Cadena_pane_cascada.'
                                                    '.$Cadena_pane_colapsado.'
                                                    '.$Cadena_pane_columnas.'
                                                    '.$Cadena_pane_subtotalesrelativos.'
                                                    '.$Cadena_pane_conteos.'
                                                    '.$Cadena_pane_controles.'
                                                    '.$Cadena_pane_control_colapsar.'
                                                    '.$Cadena_pane_control_ordenar.'
                                                },
                                        ';

/*
INICIALIZACION CON AJAX
$(document).ready( function() {
  var table = $('#example').DataTable({
    ajax: '../resources/options.json',
    dom: 'Plfrtip',
    columns: [
        { data: "users.first_name" },
        { data: "users.last_name" },
        { data: "users.phone" },
        { data: "sites.name" }
    ],
    columnDefs: [{
        searchPanes: {
            show: true,
        },
        targets: [0, 1, 2, 3]
    }],
  });
} );
*/

                                //Realiza operaciones de reemplazo de patrones sobre la cadena de formato de Totales si aplica
                                $CadenaFormateadaTotales=str_replace("_TOTAL_PAGINA_","'+pageTotal +'",$CadenaFormateadaTotales);
                                $CadenaFormateadaTotales=str_replace("_TOTAL_INFORME_","'+total +'",$CadenaFormateadaTotales);
                                $CadenaFormateadaTotales=str_replace("_COLUMNA_","$ColumnaTotalesVisual",$CadenaFormateadaTotales);
        
                                if ($Paginacion=="" || $Paginacion==0) $Paginacion=10;  //Si no hay paginacion personalizada pone 10 por defecto

                                echo '
                                    var oTable'.$i.' = $("#'.$TablasDataTable[$i].'").dataTable(
                                        {
                                            destroy: true,   //Habilita autodestruccion de objeto si se necesita reinicializar
                                            dom: "'.$CadenaPosicionPanelesArriba.'Blfrtip'.$CadenaPosicionPanelesAbajo.'",  //Ej:  Blfrtip  Da formato a la tabla: Ver https://datatables.net/reference/option/dom
                                            buttons: [
                                                '.$CadenaPersonalizarColumnas.'
                                                '.$CadenaExportaCLP.'
                                                '.$CadenaExportaCSV.'
                                                '.$CadenaExportaXLS.'
                                                '.$CadenaExportaPDF.'
                                                //{ extend: "print", className: "InformeBotonPrint" }
                                            ],
                                            '.$CadenaPanelesFiltrado.'
                                            "pageLength": '.$Paginacion.',
                                            //"responsive": true, //Opcional, no necesario activarlo si la tabla ya tiene la clase nowrap y responsive (y ya esto se hace en la generacion del informe)
                                            "scrollX": true,
                                            "bAutoWidth": true,
                                            //"bSort": false,
                                            //"autoWidth": true,
                                            //aoColumns: [ { sWidth: "45%" }, { sWidth: "45%" }, { sWidth: "10%", bSearchable: false, bSortable: false } ],
                                            //"aaSorting": [],  //Un alias a versiones viejas de order:
                                            "order": [],
                                            "fnInitComplete": function() {
                                            this.fnAdjustColumnSizing(true);
                                            },';

                                //Agrega configuraciones especificas para tablas con recuperacion por AJAX
                                if($TablasDataTableRecuperacionAJAX[$i]=="1")
                                    {
                                        //Genera la definicion requerida por DT con la lista de columnas 
                                        $ListaCamposDT=explode(",",$TablasDataTableColumnas[$i]); //Genera arreglo para los campos
                                        //FORMA OPCIONAL: Recuperar la lista de columnas directo desde la cache (menos rapido): $ListaCamposDT=explode(",",PCO_EjecutarSQL("SELECT columnas FROM {$TablasCore}informe_cache WHERE id='".$TablasDataTableIdCache[$i]."' ")->fetchColumn());
                                        $CadenaCamposDT="";
                                        foreach ($ListaCamposDT as $CampoDT)
                                            $CadenaCamposDT.="{ data: '{$CampoDT}' } ,";
                                        echo "
                                            'processing': true,
                                            'serverSide': true,
                                            'serverMethod': 'post',
                                            
                                            'ajax': {
                                                'url':'core/ajax.php?PCO_Accion=PCO_RecuperarRecordsetJSON_DataTable&IdRegistro_CacheSQL=".$TablasDataTableIdCache[$i]."&NroFilasBase={$Paginacion}'
                                            },
                                            
                                            'columns': [
                                                {$CadenaCamposDT}
                                            ],
    columnDefs: [{
        searchPanes: {
            show: true,
        },
        //targets: [7]
    }],
                                        ";
                                    }
        
                                //Agrega al datatable el footer con autosuma cuando aplica
                                if (trim($TablasDataTableTotales[$i])!="" && $CadenaFormateadaTotales!="")
                                    echo '
                                            "footerCallback": function ( row, data, start, end, display ) {
                                                var api = this.api(), data;
                                                // Remueve el formato de la celda para obtener solamente el numero entero para la suma
                                                    var intVal = function ( i ) {
                                                        return typeof i === \'string\' ?
                                                            i.replace(/[\$,]/g, \'\')*1 :
                                                            typeof i === \'number\' ?
                                                                i : 0;
                                                    };
                                                // Total de todas las paginas
                                                    total = api
                                                        .column( '.$ColumnaTotales.' )
                                                        .data()
                                                        .reduce( function (a, b) {
                                                            return intVal(a) + intVal(b);
                                                        }, 0 );
                                                // Total de la pagina actual
                                                    pageTotal = api
                                                        .column( '.$ColumnaTotales.', { page: \'current\'} )
                                                        .data()
                                                        .reduce( function (a, b) {
                                                            return intVal(a) + intVal(b);
                                                        }, 0 );
                                                // Actualiza el pie de pagina del datatable siempre en la columna 0
                                                $( api.column( 0 ).footer() ).html(
                                                    \''.$CadenaFormateadaTotales.'\'
                                                );
                                            },';
                                echo '
                                            "language": {
                                                    "lengthMenu": "'.$MULTILANG_Mostrando.' _MENU_ '.$MULTILANG_InfDataTableResXPag.'",
                                                    "zeroRecords": "Nothing found - sorry",
                                                    "info": "'.$MULTILANG_InfDataTableViendoP.' _PAGE_ '.$MULTILANG_InfDataTableDe.' _PAGES_",
                                                    "infoEmpty": "'.$MULTILANG_InfDataTableNoRegistrosDisponibles.'",
                                                    "infoFiltered": "('.$MULTILANG_InfDataTableFiltradoDe.' _MAX_ '.$MULTILANG_InfDataTableRegTotal.')",
                                                    oPaginate: { sFirst:"'.$MULTILANG_Primero.'",sLast:"'.$MULTILANG_Ultimo.'",sNext:"'.$MULTILANG_Siguiente.'",sPrevious:"'.$MULTILANG_Previo.'" },
                                                    sEmptyTable:"'.$MULTILANG_InfDataTableNoDatos.'",
                                                    sSearch:"'.$MULTILANG_Buscar.':",
                                                    sLoadingRecords:"'.$MULTILANG_Cargando.'...",
                                                    sProcessing:"'.$MULTILANG_Procesando.'...",
                                                    sZeroRecords:"'.$MULTILANG_InfDataTableNoRegistros.'",

                                                    searchPanes: {
                                                            title: {
                                                                _: "Filtros aplicados: %d",
                                                                0: "Sin filtros aplicados",
                                                                1: "Un filtro aplicado",
                                                            },
                                                            collapse: {
                                                                0: "Opciones de filtro",
                                                                1: "Filtro (uno aplicado)",
                                                                _: "Opciones de filtro (%d)"
                                                            },
                                                            collapseMessage: "Colapsar todo",
                                                            showMessage: "Mostrar todo",
                                                            clearMessage: "Quitar filtros",
                                                            count: "{total}",
                                                            countFiltered: "{shown} / ({total})"
                                                        }
                                                }
                                        }
                                    );
                                ';
                            } //Fin si hay un ID valido de DataTable
                    } //Fin activacion de todas las DT
            ?>
            
            //Ejecucion de algunas funciones para correcion de estilos y responsive sobre datatables
            //Ref: https://www.gyrocode.com/articles/jquery-datatables-column-width-issues-with-bootstrap-tabs/
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
               $($.fn.dataTable.tables(true)).DataTable()
                  .columns.adjust();
            });
        });

        //Busca por posibles graficos sin datos
        $( function() {
            <?php
                //Desglosa la cadena de posibles graficos sin datos
                $PCO_MarcosGraficosSinDatos=@explode("|",$PCO_InformesGraficosSinDatos);
                for ($i=0; $i<count($PCO_MarcosGraficosSinDatos);$i++)
                    if (trim($PCO_MarcosGraficosSinDatos[$i])!="")
                        echo '$("#'.$PCO_MarcosGraficosSinDatos[$i].'").html("<br><div align=center style=\'color:lightgray; text-shadow: 1px 1px 2px gray;\'><i class=\'fa fa-bar-chart-o fa-fw fa-4x\'></i> &nbsp; <i class=\'fa fa-pie-chart fa-fw fa-4x\'></i><br><i>'.$MULTILANG_InfSinDatos.'</i></div>");';
            ?>
        });

		//Si hay tablas con propiedad de editables espera por eventos sobre sus campos
		$(function(){
			$("td[contenteditable=true]").on("blur", function(){
			//$("td[contenteditable=true]").blur( function(){
				var nuevo_valor_campo = $(this).text();
				var datos_campo_peticion = $(this).attr("id");
				var partes_campo_peticion = datos_campo_peticion.split(":");
				var tabla_peticion=partes_campo_peticion[0];
				var campo_peticion=partes_campo_peticion[1];
				var PCO_CambioEstado_CampoLlave=partes_campo_peticion[2];
				var id_peticion=partes_campo_peticion[3];
				
				var ParametrosApertura="PCO_Accion=cambiar_estado_campo&Presentar_FullScreen=1&PCO_CambioEstado_NoUsarCore=1&PCO_CambioEstado_NegarRetorno=1&tabla="+tabla_peticion+"&campo="+campo_peticion+"&id="+id_peticion+"&valor="+nuevo_valor_campo+"&PCO_CambioEstado_CampoLlave="+PCO_CambioEstado_CampoLlave;
				Actualizacion=PCO_ObtenerContenidoAjax(1,"index.php",ParametrosApertura);
				
				//Presenta mensaje temporal de actualizacion durante 1 segundo
				PCOJS_MostrarMensajeCargandoSimple(1000);
			});
		});

    </script>


    <?php
        //Carga las funciones activadoras de diferentes tipos de control (si fue encontrado algun campo de ese tipo)
        //DatePicker
        if (@$funciones_activacion_datepickers!="")
            echo '<script type="text/javascript">'.$funciones_activacion_datepickers.'</script>';
        //Deslizadores
        if (@$funciones_activacion_sliders!="")
            echo '<script type="text/javascript">'.$funciones_activacion_sliders.'</script>';
        //Canvas
        if (@$funciones_activacion_canvas!="")
            echo '<script type="text/javascript">'.$funciones_activacion_canvas.'</script>';
    ?>

    <?php
        // Calcula tiempos de ejecucion del script
        $tiempo_final_script = PCO_ObtenerMicrotime();
        $tiempo_total_script = $tiempo_final_script - @$tiempo_inicio_script;
        $tiempo_total_script = round($tiempo_total_script,3);
    ?>

    <script language="JavaScript">
        //Actualiza marco con el tiempo de carga (inclusiones y PHP del lado del servidor)
        $('#PCO_TCarga').text("<?php echo $tiempo_total_script; ?>");
    </script>

    <?php
        //Si se requiere selector de iconos genera los eventos
        if (@$PCO_Accion=="PCOFUNC_AdministrarMenu")
            {
    ?>
        <script language="JavaScript">
            //Crea evento para el selector de iconos (cuando aplica)
            $('#lib_glyphicon').iconpicker().on('change', function(e) {
                document.PCO_FormItemMenu.imagen.value='glyphicon '+e.icon;
            });
            $('#lib_ionicon').iconpicker().on('change', function(e) {
                document.PCO_FormItemMenu.imagen.value='fa '+e.icon;
            });
            $('#lib_fontawesome').iconpicker().on('change', function(e) {
                document.PCO_FormItemMenu.imagen.value='fa '+e.icon;
            });
            $('#lib_weathericon').iconpicker().on('change', function(e) {
                document.PCO_FormItemMenu.imagen.value='wi fa '+e.icon;
            });
            $('#lib_mapicon').iconpicker().on('change', function(e) {
                document.PCO_FormItemMenu.imagen.value=e.icon;
            });
            $('#lib_octicon').iconpicker().on('change', function(e) {
                document.PCO_FormItemMenu.imagen.value='octicon '+e.icon;
            });
            $('#lib_typicon').iconpicker().on('change', function(e) {
                document.PCO_FormItemMenu.imagen.value='typcn fa '+e.icon;
            });
            $('#lib_elusiveicon').iconpicker().on('change', function(e) {
                document.PCO_FormItemMenu.imagen.value=e.icon;
            });
        </script>
    <?php
            } //Fin de eventos para selector de iconos
    ?>

    <?php
        // Si existe el directorio para el editor ACE lo incluye
        if (@file_exists("inc/ace"))
            {
    ?>
            <script src="inc/ace/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
            <script>
                // Habilita el editor ACE para los textareas con el atributo data-editor
                $(function () {
                    $('textarea[data-editor]').each(function () {
                        var textarea = $(this);

                        var mode = textarea.data('editor');

                        var editDiv = $('<div>', {
                            position: 'absolute',
                            width: textarea.width(),
                            height: textarea.height(),
                            'class': textarea.attr('class')
                        }).insertBefore(textarea);

                        textarea.css('visibility', 'hidden');
                        textarea.css('display', 'none');

                        var editor = ace.edit(editDiv[0]);
                        //editor.renderer.setShowGutter(false); //Ocultar numero de lineas, ayudas, opciones de colapsar, etc
                        editor.getSession().setValue(textarea.val());
                        editor.getSession().setMode("ace/mode/" + mode);
                        editor.setTheme("ace/theme/eclipse"); //Establece el tema a utilizar twilight|eclipse
                        
                        /*
                        // copy back to textarea on form submit...
                        textarea.closest('form').submit(function () {
                            textarea.val(editor.getSession().getValue());
                        })
                        */

                        //En cada evento de cambio actualiza el textarea
                        editor.getSession().on('change', function(){
                          textarea.val(editor.getSession().getValue());
                        });
                        
                    });
                });
            </script>
    <?php        
            } // Fin Si existe ACE
    ?>
	
    <script language="JavaScript">
		//Activa visualmente todos los div tipo SummerNote y los asocia a cada textarea
        $( function() {
            <?php
				//Activa el summernote para la edicion de controles de texto como etiqueta en formularios si se esta en esa accion
				if ($PCO_Accion=="PCO_EditarFormulario")
					{
						echo "
							$('#Summer_valor_etiqueta').summernote({
							lang: 'es-ES',
							  height: 300,
							  toolbar: [
								['Estilos', ['style']],
								['Fuentes1', ['fontname']],
								['Fuentes2', ['fontsize']],
								['Operaciones', ['undo', 'redo']],
								['Caracter', ['bold', 'italic', 'underline', 'strikethrough', 'clear', 'color']],
								['Parrafo1', ['ul', 'ol']],
								['Parrafo2', ['paragraph']],
								['Parrafo3', ['height']],
								['Insertar1', ['link', 'table', 'hr']],
								['Otros', ['fullscreen', 'codeview']], 
								['Insertar2', ['picture', 'video']],
								],
							  //ANTERIORonChange: function(contents) { document.datosform.valor_etiqueta.value=contents; }
                              callbacks: {
                                onChange: function(contents) {
                                   document.datosform.valor_etiqueta.value=contents;
                                }
                              }
							});
							//ANTERIOR$('#Summer_valor_etiqueta').code(document.datosform.valor_etiqueta.value);
							$('#Summer_valor_etiqueta').summernote('code',document.datosform.valor_etiqueta.value);
						";
					}
            ?>
        }); //Fin del document.ready
    </script>

    <!-- Menu Toggle Script -->
    <script language="JavaScript">
    $("#menu-toggle").on("click",function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

    <script language="JavaScript">
		/*
		//Activa visualmente todos los div tipo SummerNote y los asocia a cada textarea
        $(document).ready(function() {
			$('#Summer_valor_etiqueta').summernote({
			lang: 'es-ES',
			  height: 300,
			  toolbar: [
				['Estilos', ['style']],
				['Fuentes1', ['fontname']],
				['Fuentes2', ['fontsize']],
				['Operaciones', ['undo', 'redo']],
				['Caracter', ['bold', 'italic', 'underline', 'strikethrough', 'clear', 'color']],
				['Parrafo1', ['ul', 'ol']],
				['Parrafo2', ['paragraph']],
				['Parrafo3', ['height']],
				['Insertar1', ['link', 'table', 'hr']],
				['Otros', ['fullscreen', 'codeview']], 
				['Insertar2', ['picture', 'video']],
				],

			  onChange: function(contents) { document.datos.valor_etiqueta.value=contents; }
			});
			$('#Summer_valor_etiqueta').code(document.datos.valor_etiqueta.value);
        }); //Fin del document.ready
        */
    </script>

	<?php
        //Agrega funcion para la intercepcion del submit del formulario
        echo '
        <script type="text/javascript">
            PCOJS_ListaCamposValidar="'.$POSTForm_ListaCamposObligatorios.'".split("|");
            PCOJS_ListaCombosMultiplesJoin="'.@$PCO_ListaCombosMultiplesJoin.'".split("|");
            PCOJS_ListaTitulosValidar="'.PCO_ReemplazarVariablesPHPEnCadena($POSTForm_ListaTitulosObligatorios).'".split("|");
            
            function PCOJS_SanitizarValoresListaMultiple()
                {
                    //Antes de hacer el submit definitivo sanitiza valores de combos multiples
                    for (var ComboMultiple of PCOJS_ListaCombosMultiplesJoin) 
                        {
                            ComboMultiple=ComboMultiple.trim();             //Elimina posibles espacios en el id del elemento
                            if (ComboMultiple!="")
                                {
                                    ValorComboMultiple=$("#"+ComboMultiple).val();
                                    if (ValorComboMultiple!=null)
                                        {
                                            ValorSanitizadoComboMultiple=$("#"+ComboMultiple).val().join(",");
                                            //Asigna al campo extra del combo multiple los valores sanitizados
                                            $("#PCO_ComboMultiple_"+ComboMultiple).val(ValorSanitizadoComboMultiple);
                                        }
                                    else
                                        {
                                            //Si el combo es null porque se dejo sin valores entonces limpia campo sanitizado
                                            $("#PCO_ComboMultiple_"+ComboMultiple).val("");
                                        }
                                }
                        }
                }
            
            
            function PCOJS_ValidarCamposYProcesarFormulario(FormularioProcesar="datos",AnularSubmit=0)
                {
                    MensajeCamposObligatorios="";
                    //Recorre todos los campos de la lista en busca de sus valores
                    ConteoCamposValidacion=0;
                    for (Campo in PCOJS_ListaCamposValidar)
                        {
                            //Si se tiene un nombre de campo como obligatorio valida que tenga valor
                            if (PCOJS_ListaCamposValidar[Campo]!="")
                                {
                                    //Valida su valor actual
                                    if ($("#"+PCOJS_ListaCamposValidar[Campo]).val() == "" || $("#"+PCOJS_ListaCamposValidar[Campo]).val() == null )
                                        MensajeCamposObligatorios+="<br><i class=\'fa fa-info-circle\'></i> '.$MULTILANG_ErrFrmObligatorio.' <b>"+PCOJS_ListaTitulosValidar[ConteoCamposValidacion]+"</b>";
                                }
                            ConteoCamposValidacion++;
                        }
                    // Valida si hay errores y muestra el emerente, sino continua adelante y procesa el form
                    if (MensajeCamposObligatorios!="")
                        PCOJS_MostrarMensaje("'.$MULTILANG_AvisoSistema.'", MensajeCamposObligatorios);
                    else
                        {
                            if (AnularSubmit==0)
                                {
                                    PCOJS_SanitizarValoresListaMultiple();
                                    //Hace el envio del formulario
                                    document.getElementById(FormularioProcesar).submit();
                                }
                        }
                }
        </script> ';

		//Si existen funciones JavaScript generadas por algun formulario del usuario entonces las imprime
		if(@$PCO_FuncionesJSInternasFORM!="")
			echo $PCO_FuncionesJSInternasFORM;
	?>

	<?php
        //Agrega funcion para verificar periodicamente la conectividad del cliente
        if (@$PCOSESS_SesionAbierta)
            echo '
            <script type="text/javascript">
                function VerificarConectividad()
                    {
                        $.ajax({
                            url: "inc/version_actual.txt",
                            cache: false
                        })
                        .done(function( contenido_respuesta_html ) {
                            $("#PCO_Modal_MensajeCargando").modal("hide");
                        });
                    }
                var ValidadorConexion = setInterval(VerificarConectividad, 5000);
                $(document).ajaxError(function(){
                    if (window.console && window.console.error) {
                        PCOJS_MostrarMensajeCargando("'.$MULTILANG_EventoTipoInternet.'", " <i class=\"fa fa-4x fa-globe fa-pull-left fa-border \"></i>'.$MULTILANG_ErrorConexionInternet.'", 0, 100);
                    }
                });
            </script> ';
	?>

	<?php
	    //Carga tema de MaterialDesign cuando aplica
        if ($Tema_PracticoFramework=="material")
            {
                echo '
                    <script src="inc/bootstrap-material-design/js/material.min.js"></script>
                    <script src="inc/bootstrap-material-design/js/ripples.min.js"></script>
                
                    <script language="JavaScript">
                        $.material.init();
                    </script>';
            }
	?>

	<?php
	    //Solicita autorizacion de ubicar al usuario de acuerdo a la configuracion actual
        if ($PWA_AutorizacionGPS=="1")
            {
                echo '<script language="JavaScript">
                        PCOJS.GeoLocalizarUsuario();
                    </script>';
            }

	    //Solicita autorizacion para uso de camara y microfono de acuerdo a la configuracion actual
        if ($PWA_AutorizacionCAM=="1" || $PWA_AutorizacionMIC=="1")
            {
                $PCO_SolicitudCAM='false';
                $PCO_SolicitudMIC='false';
                if ($PWA_AutorizacionCAM==1) $PCO_SolicitudCAM='true';
                if ($PWA_AutorizacionMIC==1) $PCO_SolicitudMIC='true';
                echo '<script language="JavaScript">
                        navigator.getUserMedia = ( navigator.getUserMedia ||
                                               navigator.webkitGetUserMedia ||
                                               navigator.mozGetUserMedia ||
                                               navigator.msGetUserMedia);
                        navigator.getUserMedia (

                           // Indica el tipo de medio al que se solicita el acceso
                               {
                                  video: '.$PCO_SolicitudCAM.',
                                  audio: '.$PCO_SolicitudMIC.'
                               },
                           // Si no hay error, es devuelto en el objeto LocalMediaStream en un tag video:
                               function(localMediaStream) {
                                  var video = document.querySelector(video);
                                  video.src = window.URL.createObjectURL(localMediaStream);
                               },
                           // Si hay errores lleva log a consola de depuracion
                               function(err) {
                                console.log("Practico Framework: No autorizado el uso de dispositivo de video/audio: " + err);
                               }
                        );
                    </script>';
            }
	?>

    <?php
        // Estadisticas de uso anonimo con GABeacon(Deprecated) Directo por Google Analytics
        PCO_AgregarFaroAnalytics();
    ?>

    <script language="JavaScript">
        //Limpia parametros de la URL si aplica
        if(window.location.href.indexOf("?") > -1)
            window.history.pushState({data:true}, "", window.location.href.split("?")[0].split("index.php")[0] );

        <?php
            //Agrega scripts de postcarga para listas de seleccion si aplica
            echo $PCO_ScriptsListaCombosPostCarga;
        ?>

        //Actualiza marco con el tiempo de carga JavaScript (tiempo de carga y transferencia)
        var tiempo_final_javascript = (new Date()).getTime();
        var tiempo_final_javascript_segs = (tiempo_final_javascript-tiempo_inicio_javascript)/1000;
        $('#PCO_TCargaJS').text(tiempo_final_javascript_segs);

        //Mensajes de advertencia en consola de desarrollo del navegador
        console.log('%c Practico Framework: <?php echo $MULTILANG_ZonaPeligro; ?>! %c\nEsta caracteristica del navegador existe para desarrolladores.  Si alguien te sugiere copiar y pegar algun comando aqui puede comprometer tu seguridad. / This is a browser feature intended for developers. If someone told you to copy-paste something here this could break your security.', 'color: yellow; background: darkred; font-size:1.5rem;font-weight:bold; box-shadow: 10px 3px 3px gray;', 'font-size:1.25rem;line-height:1.1;margin-top:.5em');

    </script>

</body>
</html>