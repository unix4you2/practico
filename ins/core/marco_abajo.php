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
?>

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
	<script type="text/javascript" src="../inc/jquery/jquery-2.2.4.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="../inc/bootstrap/js/bootstrap.min.js"></script>

    <!-- JavaScript Personalizado del tema -->
    <script src="../inc/bootstrap/js/sb-admin-2.js"></script>
    <script src="../inc/bootstrap/js/practico.js"></script>

    <script language="JavaScript">
        //Carga los tooltips programados en la hoja.  Por defecto todos los elementos con data-toggle=tootip
        $(function () {
          $('[data-toggle="tooltip"]').tooltip();
        })
    </script>

    <?php
        // Estadisticas de uso anonimo con GABeacon
        $PrefijoGA='<img src="https://ga-beacon.appspot.com/';
        $PosfijoGA='/Practico/Instalacion?pixel" border=0 ALT=""/>';
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