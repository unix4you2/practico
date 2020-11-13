<?php
	/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2020
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
    Redistribution and use in source and binary forms, with or without
    modification, are permitted provided that the following conditions are met:
    
    1. Redistributions of source code must retain the above copyright notice, this
       list of conditions and the following disclaimer.
    
    2. Redistributions in binary form must reproduce the above copyright notice,
       this list of conditions and the following disclaimer in the documentation
       and/or other materials provided with the distribution.
    
    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
    AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
    IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
    DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
    FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
    DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
    SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
    CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
    OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
    OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
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