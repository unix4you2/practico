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

		fecha_operacion_guiones - Fecha actual en formato AAAA-MM-DD
		hora_operacion_puntos - Hora actual en formato HH:MM:SS
		Login_usuario - Nombre de usuario que se encuentra logueado en el sistema
		accion - Accion llamada actualmente en Practico (identificador unico de funcion interna o personalizada)
		tiempo_inicio_script - Hora en microtime marcada para el incio del script

		(start code)
			if($Login_usuario=="admin" && $accion!="")
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





</div> <!-- FINALIZA MARCO DE CHAT -->










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
    <!-- Plugins JavaScript adicionales -->
    <script src="inc/bootstrap/js/plugins/metisMenu/metisMenu.min.js"></script>
    <!-- Morris Charts JavaScript -->
    <script src="inc/bootstrap/js/plugins/morris/raphael.min.js"></script>
    <script src="inc/bootstrap/js/plugins/morris/morris.min.js"></script>
    <script src="inc/bootstrap/js/plugins/morris/morris-data.js"></script>
	<!-- Canvas -->
    <!--<script type="text/javascript" src="inc/jquery/plugins/sketch.js"></script>-->

    <!-- JavaScript Personalizado del tema -->
    <script src="inc/bootstrap/js/sb-admin-2.js"></script>
    <script src="inc/bootstrap/js/practico.js"></script>
    <!-- Chat -->
    <script type="text/javascript" src="inc/chat/js/chat.js"></script>

    <?php
        //Si el usuario es admin por defecto presenta la barra lateral activa
        if ($Login_usuario=="admin" && $Sesion_abierta && $accion=="Ver_menu")
            echo '<script language="JavaScript">
                    ver_navegacion_izquierda_responsive();
                </script>';
    ?>

    <script language="JavaScript">
        //Carga los tooltips programados en la hoja.  Por defecto todos los elementos con data-toggle=tootip
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <?php
        // Estadisticas de uso anonimo con GABeacon
        $PrefijoGA='<img src="https://ga-beacon.appspot.com/';
        $PosfijoGA='/Practico/'.$accion.'?pixel" border=0 ALT=""/>';
        // Este valor indica un ID generico de GA UA-847800-9 No edite esta linea sobre el codigo
        // Para validar que su ID es diferente al generico de seguimiento.  En lugar de esto cambie
        // su valor a traves del panel de configuracion de Practico con el entregado como ID de GoogleAnalytics
        $Infijo=base64_decode("VUEtODQ3ODAwLTk=");
        echo $PrefijoGA.$Infijo.$PosfijoGA;
        if(@$CodigoGoogleAnalytics!="")
            echo $PrefijoGA.$CodigoGoogleAnalytics.$PosfijoGA;	
    ?>
</body>
</html>
