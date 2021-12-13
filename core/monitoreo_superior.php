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

    // BARRA DE MENU DEL MONITOREO
?>

<script language="JavaScript">
function IntercambiarPantallaCompleta()
	{
		if (!document.fullscreenElement &&    // alternative standard method
		  !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current working methods
			if (document.documentElement.requestFullscreen) {
			  document.documentElement.requestFullscreen();
			} else if (document.documentElement.msRequestFullscreen) {
			  document.documentElement.msRequestFullscreen();
			} else if (document.documentElement.mozRequestFullScreen) {
			  document.documentElement.mozRequestFullScreen();
			} else if (document.documentElement.webkitRequestFullscreen) {
			  document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
			}
		} else {
			if (document.exitFullscreen) {
			  document.exitFullscreen();
			} else if (document.msExitFullscreen) {
			  document.msExitFullscreen();
			} else if (document.mozCancelFullScreen) {
			  document.mozCancelFullScreen();
			} else if (document.webkitExitFullscreen) {
			  document.webkitExitFullscreen();
			}
		}
	}
</script>

<div class="row">
	<div class="col-md-12">

		<div id="panel_superior" >
			
			<nav class="navbar navbar-default navbar-inverse navbar-xs" style="margin:0px; padding:0px;"> <!-- navbar-fixed-top navbar-fixed-bottom navbar-static-top navbar-inverse -->
				<div class="container-fluid">
					<!-- Logo y boton colapsable -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#barra_menu_superior" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand text-primary"><b><i class="text-primary" style="cursor:pointer;"><i class="fa fa-tachometer text-primary">&nbsp;</i>Monitor</i></b></a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="barra_menu_superior">
						<ul class="nav navbar-nav">

							<!-- MENU DE PAGINAS -->
							<li class="dropdown">
								<a style="cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $MULTILANG_Archivo; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<?php
										//Genera opciones de menu para las paginas
										for ($IndicePagina=$PaginaInicio;$IndicePagina<=$MaximoPaginas;$IndicePagina++)
											echo '<li><a id="boton_navegador_archivos" style="cursor:pointer;" OnClick="document.location=\'index.php?PCO_Accion=PCO_VerMonitoreo&Presentar_FullScreen=1&Pagina='.$IndicePagina.'\';">		<i class="fa fa-file-o fa-fw"></i> '.$MULTILANG_Pagina.' #'.$IndicePagina.'</a></li>';
									?>
									<li role="separator" class="divider"></li>
									<li><a style="cursor:pointer;" OnClick="self.close();"><i class="fa fa-sign-out fa-fw"></i> <?php echo $MULTILANG_Cerrar; ?></a></li>
								</ul>


							</li>

							<!-- BOTONES INDEPENDIENTES -->
							<li><a style="cursor:pointer;" OnClick="EstadoPausa=1;" data-toggle="tooltip" data-placement="bottom" title="Pausa en esta ventana / Pause this window"><i class="fa fa-pause fa-fw text-danger "></i> <?php echo $MULTILANG_Pausar; ?></a></li>
							<li><a style="cursor:pointer;" OnClick="document.formulario_monitoreo.Pagina.value='<?php echo $PaginaMonitoreo; ?>'; document.formulario_monitoreo.PaginaRecurrente.value='<?php echo $PaginaMonitoreo; ?>';" data-toggle="tooltip" data-placement="bottom" title="Permanecer y actualizar solo esta pagina / Stay and upgrade only this page"><i class="fa fa-refresh fa-fw text-warning "></i> <?php echo $MULTILANG_Recurrente; ?></a></li>
							<li><a style="cursor:pointer;" OnClick="document.formulario_monitoreo.Pagina.value=(document.formulario_monitoreo.Pagina.value)*1-1; EstadoPausa=0; document.formulario_monitoreo.PaginaRecurrente.value=''; actualizar();" data-toggle="tooltip" data-placement="bottom" title="Continuar monitoreo / Resume monitoring"><i class="fa fa-play fa-fw text-success"></i> <?php echo $MULTILANG_Continuar; ?></a></li>
							<li><a style="cursor:pointer;" OnClick="IntercambiarPantallaCompleta();" data-toggle="tooltip" data-placement="bottom" title="Pantalla completa / FullScreen"> <i class="fa fa-desktop fa-fw text-default"></i>&nbsp;</a></li>

							<li><a data-toggle="tooltip" data-placement="bottom" title="Tiempo antes de saltar / Time before jump"><i class="fa fa-clock-o fa-fw text-info"></i> <div id="MarcoCronometro" style="display: inline!important;">0s</div></a></li>

						</ul>
							
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a style="cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-question-circle text-info"></i> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a style="cursor:pointer;"><i class="fa fa-info fa-fw"></i> <?php echo $MULTILANG_Ayuda; ?></a></li>
								</ul>
							</li>

						</ul>

					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>

		</div><!-- /.contenedor -->

	</div>
</div>