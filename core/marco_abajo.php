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





<!--</div>--> <!-- FINALIZA MARCO DE CHAT -->




                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->



    </div>
    <!-- /#wrapper inicial -->



    <!-- jQuery -->
	<script type="text/javascript" src="inc/jquery/jquery-2.1.0.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="inc/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugins JavaScript requeridos por DateTimePicker -->
    <script src="inc/bootstrap/js/plugins/moment/moment-with-locales.min.js"></script>

    <!-- Plugins JavaScript adicionales -->
    <script type="text/javascript" src="inc/bootstrap/js/plugins/transition.js"></script>
    <script type="text/javascript" src="inc/bootstrap/js/plugins/collapse.js"></script>
    <script type="text/javascript" src="inc/bootstrap/js/plugins/slider/bootstrap-slider.js"></script>
    <script type="text/javascript" src="inc/bootstrap/js/plugins/select/bootstrap-select.min.js"></script>
    <script src="inc/bootstrap/js/plugins/metisMenu/metisMenu.min.js"></script>
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
    <!--<script type="text/javascript" src="inc/jquery/plugins/sketch.js"></script>-->

    <!-- JavaScript Personalizado del tema -->
    <script src="inc/bootstrap/js/sb-admin-2.js"></script>
    <script src="inc/bootstrap/js/practico.js"></script>
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
                            "language": {
                                "lengthMenu": "'.$MULTILANG_InfDataTableMostrando.' _MENU_ '.$MULTILANG_InfDataTableResXPag.'",
                                "zeroRecords": "Nothing found - sorry",
                                "info": "'.$MULTILANG_InfDataTableViendoP.' _PAGE_ '.$MULTILANG_InfDataTableDe.' _PAGES_",
                                "infoEmpty": "No records available",
                                "infoFiltered": "('.$MULTILANG_InfDataTableFiltradoDe.' _MAX_ '.$MULTILANG_InfDataTableRegTotal.')"
                            }
                        }
                    );';
            ?>
        });
    </script>

    <?php
        //Carga las funciones activadoras de DatePicker (si fue encontrado algun campo de ese tipo)
        if (@$funciones_activacion_datepickers!="")
            echo '<script type="text/javascript">'.$funciones_activacion_datepickers.'</script>';
    ?>

    <?php
        //Carga las funciones activadoras de Deslizadores (si fue encontrado algun campo de ese tipo)
        if (@$funciones_activacion_sliders!="")
            echo '<script type="text/javascript">'.$funciones_activacion_sliders.'</script>';
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
