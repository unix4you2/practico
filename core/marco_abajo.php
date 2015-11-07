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
			if($PCOSESS_LoginUsuario=="admin" && $PCO_Accion!="")
				{
					$tiempo_final_script = obtener_microtime();
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
		<div id="PCO_Modal_Mensaje" class="modal fade">
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
						<button type="button" class="btn btn-outline btn-info" data-dismiss="modal">Cerrar</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->


		<!-- Modal para mensajes de carga -->
		<div id="PCO_Modal_MensajeCargando" class="modal fade"  data-backdrop="static" data-keyboard="false">
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
		<div id="PCO_Modal_MensajeCargandoSimple" class="modal" data-backdrop="false">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-body" align="center">
						<div class="progress" id="PCO_Modal_MensajeCargandoBarra">
							<div id="PCO_Modal_MensajeCargandoPorcentaje" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
						</div>
						<i class="fa fa-circle-o-notch fa-fw fa-spin fa-1x"></i> <?php echo $MULTILANG_Guardando; ?>...
						
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
    <script type="text/javascript" src="inc/bootstrap/js/plugins/select/bootstrap-select.min.js"></script>
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
        if (@$PCOSESS_LoginUsuario=="admin" && @$PCOSESS_SesionAbierta && @$PCO_Accion=="Ver_menu")
        {
    ?>
    <script src="inc/bootstrap/js/plugins/morris/raphael.min.js"></script>
    <script src="inc/bootstrap/js/plugins/morris/morris.min.js"></script>
    <?php
        // Incluye archivo con las consultas y datos para ser diagramados por Morris
		if (@$PCOSESS_LoginUsuario=="admin" && $PCOSESS_SesionAbierta)
            include_once("core/marco_admin_morris.php");
        }
    ?>

    <!-- DataTables JavaScript -->
    <script src="inc/bootstrap/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="inc/bootstrap/js/plugins/dataTables/dataTables.bootstrap.js"></script>

	<!-- Canvas -->
    <script type="text/javascript" src="inc/jquery/plugins/sketch.js"></script>
    
    <!-- SummerNote -->
    <script src="inc/summernote/summernote.min.js"></script>
    <script src="inc/summernote/plugin/summernote-ext-video.js"></script>
    <script src="inc/summernote/lang/summernote-<?php echo $IdiomaPredeterminado; ?>-<?php echo strtoupper($IdiomaPredeterminado); ?>.js"></script>

    <!-- JavaScript Personalizado del tema -->
    <script src="inc/bootstrap/js/sb-admin-2.js"></script>
    <script src="inc/bootstrap/js/practico.min.js"></script>
    <!-- Chat -->
    <script type="text/javascript" src="inc/chat/js/chat.js"></script>

    <?php
        //Si el usuario es admin por defecto presenta la barra lateral activa
        if ((@$PCOSESS_LoginUsuario=="admin" && @$PCOSESS_SesionAbierta && @$PCO_Accion=="Ver_menu") || (@$PCOSESS_LoginUsuario!="" && @$PCOSESS_SesionAbierta && @$VerNavegacionIzquierdaResponsive==1))
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
    ?>

    <script language="JavaScript">
        //Carga los tooltips programados en la hoja.  Por defecto todos los elementos con data-toggle=tootip
        $(function () {
          $('[data-toggle="tooltip"]').tooltip();
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
                for ($i=0; $i<count($TablasDataTable);$i++)
                    echo '$("#'.$TablasDataTable[$i].'").dataTable(
                        {
                            "scrollX": true,
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
                    );';
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
        $tiempo_final_script = obtener_microtime();
        $tiempo_total_script = $tiempo_final_script - @$tiempo_inicio_script;
        $tiempo_total_script = round($tiempo_total_script,3);
    ?>

    <script language="JavaScript">
        //Actualiza marco con el tiempo de carga (inclusiones y PHP del lado del servidor)
        $('#PCO_TCarga').text("<?php echo $tiempo_total_script; ?>");
    </script>

    <?php
        //Si se requiere selector de iconos genera los eventos
        if (@$PCO_Accion=="administrar_menu" || @$PCO_Accion=="detalles_menu")
            {
    ?>
        <script language="JavaScript">
            //Crea evento para el selector de iconos (cuando aplica)
            $('#lib_glyphicon').iconpicker().on('change', function(e) {
                document.datos.imagen.value='glyphicon '+e.icon;
            });
            $('#lib_ionicon').iconpicker().on('change', function(e) {
                document.datos.imagen.value='fa '+e.icon;
            });
            $('#lib_fontawesome').iconpicker().on('change', function(e) {
                document.datos.imagen.value='fa '+e.icon;
            });
            $('#lib_weathericon').iconpicker().on('change', function(e) {
                document.datos.imagen.value='wi fa '+e.icon;
            });
            $('#lib_mapicon').iconpicker().on('change', function(e) {
                document.datos.imagen.value=e.icon;
            });
            $('#lib_octicon').iconpicker().on('change', function(e) {
                document.datos.imagen.value='octicon '+e.icon;
            });
            $('#lib_typicon').iconpicker().on('change', function(e) {
                document.datos.imagen.value='typcn fa '+e.icon;
            });
            $('#lib_elusiveicon').iconpicker().on('change', function(e) {
                document.datos.imagen.value=e.icon;
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
				if ($PCO_Accion=="editar_formulario")
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
		//Si existen funciones JavaScript generadas por algun formulario del usuario entonces las imprime
		if(@$PCO_FuncionesJSInternasFORM!="")
			echo $PCO_FuncionesJSInternasFORM;
	?>

    <?php
        // Estadisticas de uso anonimo con GABeacon
        $PrefijoGA='<img src="https://ga-beacon.appspot.com/';
        $PosfijoGA='/Practico/'.$PCO_Accion.'?pixel" border=0 ALT=""/>';
        // Este valor indica un ID generico de GA UA-847800-9 No edite esta linea sobre el codigo
        // Para validar que su ID es diferente al generico de seguimiento.  En lugar de esto cambie
        // su valor a traves del panel de configuracion de Practico con el entregado como ID de GoogleAnalytics
        $Infijo=base64_decode("VUEtODQ3ODAwLTk=");
        echo $PrefijoGA.$Infijo.$PosfijoGA;
        if(@$CodigoGoogleAnalytics!="")
            echo $PrefijoGA.$CodigoGoogleAnalytics.$PosfijoGA;	
    ?>

    <script language="JavaScript">
        //Actualiza marco con el tiempo de carga JavaScript (tiempo de carga y transferencia)
        var tiempo_final_javascript = (new Date()).getTime();
        var tiempo_final_javascript_segs = (tiempo_final_javascript-tiempo_inicio_javascript)/1000;
        $('#PCO_TCargaJS').text(tiempo_final_javascript_segs);
    </script>

</body>
</html>
