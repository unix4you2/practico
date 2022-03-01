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

    // BARRA DE ESTADO DEL APLICATIVO
?>

<div class="row" id="MarcoContenedorInferior">
	<div class="col-md-12">

		<div id="panel_inferior">
			
			<div class="well well-sm" style="border:0px; margin:0px; padding:0px; padding-bottom:1px; background: #272727;">

						<!-- FORMULARIO DISPOSICION DE PANTALLA -->
						<div style="display:inline;">
							&nbsp;
							<button data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_PCODER_DividirNO; ?>" class="btn btn-success btn-xs" onClick="PCODER_DividirPantalla_NO();"><i class="fa fa-stop fa-fw"></i></button>
							<button data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_PCODER_DividirHorizontal; ?>" class="btn btn-danger btn-xs" onClick="PCODER_DividirPantalla_Horizontal();"><i class="fa fa-pause fa-rotate-90 fa-fw"></i></button>
							<button data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_PCODER_DividirVertical; ?>" class="btn btn-danger btn-xs" onClick="PCODER_DividirPantalla_Vertical();"><i class="fa fa-pause fa-fw"></i></button>
							&nbsp;
						</div>

						<!-- FORMULARIO IR A -->
						<div style="display:inline;">
							<input type="text" id="linea_salto" size=10 name="linea_salto" class="input-mini btn-xs btn-default" placeholder="<?php echo $MULTILANG_PCODER_SaltarLinea; ?>">
							<button class="btn btn-primary btn-xs" onClick="SaltarALinea();"><?php echo $MULTILANG_PCODER_Ir; ?> <i class="fa fa-arrow-circle-right"></i></button>
						</div>

						<font color="gray">
							
							<!-- LINEAS DEL DOCUMENTO -->
							<div id="NroLineasDocumento" class="btn-xs" style="display:inline;">
							</div>

							<!-- COLUMNA ACTUAL DEL DOCUMENTO -->
							<div id="NroColumnaDocumento" class="btn-xs" style="display:inline;">
							</div>

							<!-- CARACTERES DEL DOCUMENTO -->
							<div id="NroCaracteresDocumento" class="btn-xs" style="display:inline;">
							</div>

							<!-- TIPO DOCUMENTO -->
							<div id="TipoDocumento" class="btn-xs" style="display:inline;">
							</div>

							<!-- TAMANO DEL DOCUMENTO -->
							<div id="TamanoDocumento" class="btn-xs" style="display:inline;">
							</div>

							<!-- FECHA MODIFICACION -->
							<div id="FechaModificadoDocumento" class="btn-xs" style="display:inline;">
							</div>

						</font>

			</div>

		</div><!-- /.contenedor -->

	</div>
</div>