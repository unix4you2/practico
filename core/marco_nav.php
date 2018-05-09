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
	Title: Seccion superior
	Ubicacion *[/core/marco_nav.php]*.  Archivo dedicado a la diagramacion de barras de navegacion de la aplicacion (superior, izquierda, etc)

	Ver tambien:
		<Seccion inferior> | <Articulador>
	*/
?>


<!-- Navigation -->
<nav  id="BarraNavegacionSuperior" class="navbar navbar-default navbar-static-top oculto_impresion" role="navigation" style="margin-bottom: 0">
	
	<div class="navbar-header">
		<button OnClick="document.getElementById('barra_navegacion_izquierda').style.visibility='visible';" type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="javascript:document.core_ver_menu.submit();"><img width="115" height="30" src="img/logo.png?<?php echo filemtime('img/logo.png'); ?>" border="0" ALT="Practico"></a>
	</div>
	<!-- /.navbar-header -->


<?php
    function ImprimirArregloCompleto($Arreglo,$Separador)
        {
            $SalidaFuncion="";
            foreach ($Arreglo as $Elemento)
                {
                    //Si el tipo de datos es arreglo llama a la funcion nuevamente, sino lo imprime
                    if (strtolower(gettype ( $Elemento )) == "array")
                        {
                            $SalidaFuncion.=ImprimirArregloCompleto($Elemento,$Separador);
                        }
                    else
                        {
                            $SalidaFuncion.=$Separador;
                            if (key($Elemento)!="")
                                $SalidaFuncion.= key($Elemento).":";
                            $SalidaFuncion.= $Elemento;
                        }
                }
            return $SalidaFuncion;
        }
    
    function ImprimirArregloVariablesInternas($Funcion)
        {
            if ($Funcion=="get_loaded_extensions")  echo ImprimirArregloCompleto(get_loaded_extensions(),", ");
            if ($Funcion=="ini_get_all")            echo ImprimirArregloCompleto(ini_get_all(),", ");
            if ($Funcion=="request")                echo ImprimirArregloCompleto(array_keys($_REQUEST),"\\n    ");
            if ($Funcion=="debug_backtrace")        echo ImprimirArregloCompleto(debug_backtrace(),"\\n    ");
            if ($Funcion=="get_browser")            echo ImprimirArregloCompleto(get_browser(null, true),"\\n    ");
            if ($Funcion=="getallheaders")          echo ImprimirArregloCompleto(getallheaders(),"\\n    ");
        }

    function PCO_DetectarSistemaOperativoCliente()
        {
        	$SistemasABuscar=array("WIN","MAC","LINUX");
        	# definimos unos valores por defecto para el navegador y el sistema operativo
        	$SistemaDetectado = "OTHER";
        	foreach($SistemasABuscar as $Sistema)
        	{
        		if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$Sistema)!==false)
        			$SistemaDetectado = $Sistema;
        	}
        	return $SistemaDetectado;
        }
?>


	<ul class="nav navbar-top-links navbar-right">
    <script language="javascript">
        function PCO_CargarReportarBugs()
            {
                //Activa el proceso de captura de trazas y demas informacion
                $('#PCO_IconoBugTracker').addClass('fa fa-spin fa-spinner').removeClass('fa-bug');
                $('#PCO_TextoBugTracker').text(' <?php echo $MULTILANG_Cargando; ?>...');
                //Captura otros datos informativos de la aplicacion
                document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="TRAZAS DE APLICACION / APPLICATION DEBUG\n==================================================\n";
                document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="<?php echo $MULTILANG_TiempoCarga; ?>:"+$('#PCO_TCarga').text()+" seg.";
                document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="      <?php echo $MULTILANG_TiempoCarga; ?> JS:"+$('#PCO_TCargaJS').text()+" seg.\n";
                document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="<?php echo $MULTILANG_Instante; ?>: <?php echo $PCO_FechaOperacionGuiones;?> <?php echo $PCO_HoraOperacionPuntos;?>"+"\n";
                document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="<?php echo $MULTILANG_Accion; ?>: <?php echo $PCO_Accion;?>"+"\n";
                document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="<?php echo $MULTILANG_Usuario; ?>:  <?php echo $PCOSESS_LoginUsuario;?>"+"\n";
                document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="Inclusiones: <?php echo (count(get_included_files())); ?>"+"+1?\n";
                document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="PHP_VERSION: <?php echo phpversion(); ?>   MEMORY_GET_USAGE: <?php echo memory_get_usage(); ?> bytes"+"\n";
                document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="MEMORY_PEAK_USAGE: <?php echo memory_get_peak_usage(); ?> bytes"+"\n";
                document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nOS CLIENTE: <?php echo PCO_DetectarSistemaOperativoCliente(); ?>"+"\n";
                document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nGET_BROWSER: <?php ImprimirArregloVariablesInternas("get_browser"); ?>"+"\n";
                document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nGET_DEFINED_VARS: <?php ImprimirArregloVariablesInternas("request"); ?>"+"\n";
                document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nGET_ALL_HEADERS: <?php ImprimirArregloVariablesInternas("getallheaders"); ?>"+"\n";
                document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nGET_LOADED_EXTENSIONS: <?php ImprimirArregloVariablesInternas("get_loaded_extensions"); ?>"+"\n";
                document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nDEBUG_TRACE: <?php ImprimirArregloVariablesInternas("debug_backtrace"); ?>"+"\n";
                document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nINI_GET_ALL: <?php ImprimirArregloVariablesInternas("ini_get_all"); ?>"+"\n";
                //Captura pantallazo del navegador
                CapturarCanvasPantallaAImagen('','PCO_ReportarBugsCapturaOculta','image/png',0,0,"PCO_ReportarBugs","PCO_CapturaPantalla");
            }
    </script>

		<?php 
			//Agrega boton de reporte de Bugs si esta habilitado el sistema
			if ($PermitirReporteBugs==1 && $PCOSESS_SesionAbierta && $PCO_Accion!="PCO_ReportarBugs")
				echo '<a class="btn btn-xs" href="javascript:PCO_CargarReportarBugs();" data-toggle="tooltip" data-html="true"  data-placement="auto" title="'.$MULTILANG_BTReporteBugs.'" href="javascript:document.location=\'index.php?PCO_Accion=cargar_objeto&objeto=frm:-3:1\';"><i id="PCO_IconoBugTracker" class="fa fa-bug"></i></a><i id="PCO_TextoBugTracker"></i>&nbsp;';
		?>
		<?php
			//Presenta titulo de la aplicacion
			if ($PCOSESS_SesionAbierta)
				echo '<div id="PCODIV_TituloAplicacion" style="display:inline;"><b>'.$Nombre_Empresa_Corto.' - '.$Nombre_Aplicacion.' </b> <i> v'.$Version_Aplicacion.'</i></div>';
			//else
			//	echo $MULTILANG_SubtituloPractico1.' '.$MULTILANG_SubtituloPractico2;
		?>
		<?php 
			//Despliega boton de desarrollo
			if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && $PCOSESS_SesionAbierta)    
				echo '<a data-toggle="modal" class="btn btn-danger btn-xs" href="#myModalDESARROLLO"><i class="fa fa-puzzle-piece"></i> '.$MULTILANG_DesAppBoton.'</a>';
		?>
		<?php 
			//Agrega boton de retorno al inicio si la accion es diferente al escritorio
			if ($PCO_Accion!="Ver_menu" && $PCOSESS_SesionAbierta)
				echo '<a class="btn btn-success btn-xs" href="javascript:document.location=\'index.php\';"><i class="fa fa-home"></i></a>';
		?>
		<?php 
			//Despliega opciones de configuracion
			if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && $PCOSESS_SesionAbierta)
				{
		?>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-cog fa-fw text-danger"></i>  <i class="fa fa-caret-down text-danger"></i>
						</a>
						<ul class="dropdown-menu dropdown-alerts">
							<li>
								<a data-toggle="modal" href="#myModalCONFIGURACION">
									<div>
										<i class="fa fa-wrench fa-fw"></i> <?php echo $MULTILANG_ConfiguracionGeneral; ?>
									</div>
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a data-toggle="modal" href="#myModalPARAMETROS">
									<div>
										<i class="fa fa-tasks fa-fw"></i> <?php echo $MULTILANG_ParamApp; ?>
									</div>
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="javascript:document.PCO_EditarConfiguracionOAuth.submit();">
									<div>
										<i class="fa fa-soundcloud fa-fw"></i> <?php echo $MULTILANG_OauthButt; ?>
										<span class="pull-right text-muted small"><?php echo PCO_ContarProveedoresOAuthConfigurados(); ?></span>
									</div>
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a data-toggle="modal" href="#myModalWEBSERVICES">
									<div>
										<i class="fa fa-link fa-fw"></i> <?php echo $MULTILANG_WSConfigButt; ?>
										<span class="pull-right text-muted small"><?php echo ContarRegistros($TablasCore."llaves_api",""); ?></span>
									</div>
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a data-toggle="modal" href="javascript:document.PCO_VerReplicaciones.submit();">
									<div>
										<i class="fa fa-cubes fa-fw"></i> <?php echo $MULTILANG_ReplicaTitulo; ?>
										<span class="pull-right text-muted small"><?php echo ContarRegistros($TablasCore."replicasbd",""); ?></span>
									</div>
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a data-toggle="modal" href="javascript:document.ver_monitoreo.submit();">
									<div>
										<form name="ver_monitoreo" action="<?php echo $ArchivoCORE; ?>" method="POST">
											<input type="Hidden" name="PCO_Accion" value="administrar_monitoreo">
										</form>
										<i class="fa fa-lightbulb-o fa-fw"></i> <?php echo $MULTILANG_MonTitulo; ?>
										<span class="pull-right text-muted small"><?php echo ContarRegistros($TablasCore."monitoreo",""); ?></span>
									</div>
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a data-toggle="modal" href="javascript:document.actualizarad.submit();">
									<div>
										<form name="actualizarad" action="<?php echo $ArchivoCORE; ?>" method="POST">
											<input type="Hidden" name="PCO_Accion" value="actualizar_practico">
										</form>
										<i class="fa fa-download fa-fw"></i> <?php echo $MULTILANG_Actualizacion; ?>/<?php echo $MULTILANG_Copias; ?>
									</div>
								</a>
							</li>
						</ul>
						<!-- /.dropdown-alerts -->
					</li>
		<?php 
				}// Fin de despliegue opciones de configuracion
		?>

		<?php
			//Presenta el menu de login de usuario
			if ($PCOSESS_SesionAbierta)
				{
		?>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
						</a>
						<ul class="dropdown-menu dropdown-user">
							<li><a href="javascript:document.actualizar_perfil.submit();"><i class="fa fa-user fa-fw"></i> <?php echo $Nombre_usuario;?></a></li>
							<li><a href="javascript:document.reseteo_clave.submit();"><i class="fa fa-key fa-fw"></i> <?php echo $MULTILANG_UsrReset; ?></a></li>
							<?php
								//Carga opcion de chat solamente si esta habilitado
								if (isset($Activar_ModuloChat) && $Activar_ModuloChat>0)
								{
							?>	
									<li><a data-toggle="modal" href="#Dialogo_Chat"><i class="fa fa-comment fa-fw"></i> Chat</a></li>
							<?php
								}
							?>
							<li class="divider"></li>
							<li><a href="javascript:cerrar_sesion.submit();"><i class="fa fa-sign-out fa-fw texto-blink"></i> <?php echo $MULTILANG_CerrarSesion; ?></a></li>
						</ul>
						<!-- /.dropdown-user -->
					</li>
		<?php
				}
		?>

	</ul>
	<!-- CIERRA /.navbar-top-links -->

</nav>

<?php
	// Incluye marcos con barras de navegacion
	include_once("core/marco_navizq.php");
?>