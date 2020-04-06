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

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="inc/bootstrap/js/bootstrap.min.js"></script>

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

    <!-- DataTables JavaScript -->
    <script src="inc/bootstrap/js/plugins/dataTables/jquery.dataTables.min.js"></script>
    <script src="inc/bootstrap/js/plugins/dataTables/dataTables.buttons.min.js"></script><!--N-->
    <script src="inc/bootstrap/js/plugins/dataTables/buttons.html5.min.js"></script><!--N-->

    <script src="inc/bootstrap/js/plugins/dataTables/dataTables.bootstrap.min.js"></script>

    <!-- DataTables Responsive -->
    <script src="inc/bootstrap/js/plugins/dataTables/dataTables.responsive.min.js"></script><!--N-->

	<!-- Canvas -->
    <script type="text/javascript" src="inc/jquery/plugins/sketch.js"></script>
    
    <!-- SummerNote -->
    <script src="inc/summernote/summernote.min.js"></script>
    <script src="inc/summernote/plugin/summernote-ext-video.js"></script>
    <script src="inc/summernote/lang/summernote-<?php echo $IdiomaPredeterminado; ?>-<?php echo strtoupper($IdiomaPredeterminado); ?>.js"></script>

    <!-- JavaScript Personalizado del tema -->
    <script src="inc/bootstrap/js/sb-admin-2.js"></script>
    <script src="inc/bootstrap/js/practico.min.js?<?php echo filemtime('inc/bootstrap/js/practico.min.js'); ?>"></script>
    <!-- Chat -->
    <script type="text/javascript" src="inc/chat/js/chat.js"></script>

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
        $( document ).ready(function() {
            var PCOJSVAR_HayScroll=false;
            //Verifica si hay scroll  METODO 1
            if (document.getElementById("page-wrapper").scrollHeight==$(document).height())
                PCOJSVAR_HayScroll=true;
            //Si hay scroll el alto debe tener !important para que se estire hasta abajo en la página.  Si no hay scroll solo 100%
            if( PCOJSVAR_HayScroll )
                {
                    //$("#page-wrapper").css({ 'height': "100% !important" }); //SI Hay scroll  
                    console.log("Scroll detectado");
                }
            else
                {
                    $("#page-wrapper").css({ 'height': "100%" }); // NO Hay scroll  
                    console.log("Scroll NO detectado");
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
        $(document).ready(function() {
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
                for ($i=0; $i<count($TablasDataTable);$i++)
                    {
                        $Paginacion=trim($TablasDataTablePaginaciones[$i]);
                        $ColumnaTotales=trim($TablasDataTableTotales[$i])-1;
                        $ColumnaTotalesVisual=trim($TablasDataTableTotales[$i]);
                        $CadenaFormateadaTotales=trim($TablasDataTableFormatosTotales[$i]);
                        $CadenaExportaCLP=trim($TablasDataTableExportaCLP[$i]); if ($CadenaExportaCLP=="S") $CadenaExportaCLP='{ extend: "copy",    className: "InformeBotonCopiar" },'; else $CadenaExportaCLP='';
                        $CadenaExportaCSV=trim($TablasDataTableExportaCSV[$i]); if ($CadenaExportaCSV=="S") $CadenaExportaCSV='{ extend: "csv",     className: "InformeBotonCsv" },   '; else $CadenaExportaCSV='';
                        $CadenaExportaXLS=trim($TablasDataTableExportaXLS[$i]); if ($CadenaExportaXLS=="S") $CadenaExportaXLS='{ extend: "excel",   className: "InformeBotonExcel" ,  title: "" }, '; else $CadenaExportaXLS='';
                        $CadenaExportaPDF=trim($TablasDataTableExportaPDF[$i]); if ($CadenaExportaPDF=="S") $CadenaExportaPDF='{ extend: "pdf",     className: "InformeBotonPdf" },   '; else $CadenaExportaPDF='';
                        //Realiza operaciones de reemplazo de patrones sobre la cadena de formato de Totales si aplica
                        $CadenaFormateadaTotales=str_replace("_TOTAL_PAGINA_","'+pageTotal +'",$CadenaFormateadaTotales);
                        $CadenaFormateadaTotales=str_replace("_TOTAL_INFORME_","'+total +'",$CadenaFormateadaTotales);
                        $CadenaFormateadaTotales=str_replace("_COLUMNA_","$ColumnaTotalesVisual",$CadenaFormateadaTotales);

                        if ($Paginacion=="" || $Paginacion==0) $Paginacion=10;  //Si no hay paginacion personalizada pone 10 por defecto
                        echo '
                            //alert(" '.$TablasDataTable[$i].' Paginacion:'.$Paginacion.'  ColumnaTotales:'.$ColumnaTotales.'  CadenaFormateadaTotales:'.$CadenaFormateadaTotales.'  "); //Depuracion solamente
                            var oTable'.$i.' = $("#'.$TablasDataTable[$i].'").dataTable(
                                {
                                    destroy: true,   //Habilita autodestruccion de objeto si se necesita reinicializar
                                    dom: "Blfrtip",  //Ej:  Blfrtip  Da formato a la tabla: Ver https://datatables.net/reference/option/dom
                                    buttons: [
                                        '.$CadenaExportaCLP.'
                                        '.$CadenaExportaCSV.'
                                        '.$CadenaExportaXLS.'
                                        '.$CadenaExportaPDF.'
                                        //{ extend: "print", className: "InformeBotonPrint" }
                                    ],

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
                                            sZeroRecords:"'.$MULTILANG_InfDataTableNoRegistros.'"
                                        }
                                }
                            );
                        ';
                    }
            ?>
            
            //Ejecucion de algunas funciones para correcion de estilos y responsive sobre datatables
            //Ref: https://www.gyrocode.com/articles/jquery-datatables-column-width-issues-with-bootstrap-tabs/
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
               $($.fn.dataTable.tables(true)).DataTable()
                  .columns.adjust();
            });
        });

        //Busca por posibles graficos sin datos
        $(document).ready(function() {
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
			$("td[contenteditable=true]").blur(function(){
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
        $(document).ready(function() {
            <?php
                //Desglosa la cadena de posibles SummerNote
                $CamposSummerNote=@explode("|",$PCO_CamposSummerNote);
                $AlturasSummerNote=@explode("|",$PCO_AlturasCamposSummerNote);
                $HerramientasSummerNote=@explode("|",$PCO_HerramientasCamposSummerNote);
                
                for ($i=0; $i<count($CamposSummerNote);$i++)
					{
						$NombreCampoSummer=$CamposSummerNote[$i];
						//Si hay un valor de ID lo activa (Para evitar pipe al final)

						if ($NombreCampoSummer!="")
							{
								//Si el campo tiene una altura la agrega
								$cadena_altura="";
								if ($AlturasSummerNote[$i]!="" && $AlturasSummerNote[$i]!="0")
									$cadena_altura="height: ".$AlturasSummerNote[$i].", ";
									
								//Construye el tipo de barra de herramientas, iniciando por la completa o sino asignando la que corresponda
								$cadena_barraherramientas_Base="
										['Operaciones', ['undo', 'redo']],";
								$cadena_barraherramientas_Basica="
									['Caracter', ['bold', 'italic', 'underline', 'strikethrough', 'clear', 'color']],
									['Parrafo1', ['ul', 'ol']],
									['Parrafo2', ['paragraph']],
									['Parrafo3', ['height']],";
								$cadena_barraherramientas_Estandar="
									['Estilos', ['style']],
									['Fuentes1', ['fontname']],
									['Fuentes2', ['fontsize']],";
								$cadena_barraherramientas_Extendida="
									['Insertar1', ['link', 'table', 'hr']],";
								$cadena_barraherramientas_Avanzada="
									['Otros', ['fullscreen', 'codeview']], ";
								$cadena_barraherramientas_Completa="
									['Insertar2', ['picture', 'video']], ";

								$cadena_barraherramientas=$cadena_barraherramientas_Base;
								if ($HerramientasSummerNote[$i]=="5") //BASICA
									$cadena_barraherramientas=$cadena_barraherramientas_Base.$cadena_barraherramientas_Basica;
								if ($HerramientasSummerNote[$i]=="6") //ESTANDAR
									$cadena_barraherramientas=$cadena_barraherramientas_Estandar.$cadena_barraherramientas_Base.$cadena_barraherramientas_Basica;								
								if ($HerramientasSummerNote[$i]=="7") //EXTENDIDA
									$cadena_barraherramientas=$cadena_barraherramientas_Estandar.$cadena_barraherramientas_Base.$cadena_barraherramientas_Basica.$cadena_barraherramientas_Extendida;
								if ($HerramientasSummerNote[$i]=="8") //AVANZADA
									$cadena_barraherramientas=$cadena_barraherramientas_Estandar.$cadena_barraherramientas_Base.$cadena_barraherramientas_Basica.$cadena_barraherramientas_Extendida.$cadena_barraherramientas_Avanzada;
								if ($HerramientasSummerNote[$i]=="9") //COMPLETA
									$cadena_barraherramientas=$cadena_barraherramientas_Estandar.$cadena_barraherramientas_Base.$cadena_barraherramientas_Basica.$cadena_barraherramientas_Extendida.$cadena_barraherramientas_Avanzada.$cadena_barraherramientas_Completa;

								$cadena_barraherramientas="toolbar: [".$cadena_barraherramientas."],";

								echo "
									$('#Summer_$NombreCampoSummer').summernote({
									lang: '".$IdiomaPredeterminado."-".strtoupper($IdiomaPredeterminado)."', // default: 'en-US'
									  $cadena_altura
									  $cadena_barraherramientas
									  onChange: function(contents) { document.datos.$NombreCampoSummer.value=contents; }
									});";
								//Asigna el valor inicial del textarea al marco visual a manera de codigo
								echo "$('#Summer_".$NombreCampoSummer."').code(document.datos.".$NombreCampoSummer.".value);";
							}
					}
					
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
							  onChange: function(contents) { document.datosform.valor_etiqueta.value=contents; }
							});
							$('#Summer_valor_etiqueta').code(document.datosform.valor_etiqueta.value);
						";
					}
            ?>
        }); //Fin del document.ready
    </script>

    <!-- Menu Toggle Script -->
    <script language="JavaScript">
    $("#menu-toggle").click(function(e) {
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
                            ValorComboMultiple=$("#"+ComboMultiple).val();
                            if (ComboMultiple!="")
                                {
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
        // Estadisticas de uso anonimo con GABeacon
        $PrefijoGA='<img src="https://rastreador-visitas.appspot.com/';
        $PosfijoGA='/Practico/'.$_SERVER['SERVER_NAME'].'/ACT/'.$PCO_Accion.'/SCR/'.$_SERVER['PHP_SELF'].'/?pixel" border=0 ALT=""/>';
        // Este valor indica un ID generico de GA UA-847800-9 No edite esta linea sobre el codigo
        // Para validar que su ID es diferente al generico de seguimiento.  En lugar de esto cambie
        // su valor a traves del panel de configuracion de Practico con el entregado como ID de GoogleAnalytics
        $Infijo=base64_decode("VUEtODQ3ODAwLTk=");
        echo $PrefijoGA.$Infijo.$PosfijoGA;
        if(@$CodigoGoogleAnalytics!="")
            echo $PrefijoGA.$CodigoGoogleAnalytics.$PosfijoGA;	
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
    </script>

</body>
</html>