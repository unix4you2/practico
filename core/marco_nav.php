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
<nav id="BarraNavegacionSuperior" class="navbar navbar-default navbar-static-top oculto_impresion" role="navigation" style="margin-bottom: 0">

	
	<div class="navbar-header" >
		<button OnClick="document.getElementById('barra_navegacion_izquierda').style.visibility='visible';" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#PCO_BarraNavegacionIzquierda">
			<i class="fa fa-bars"></i>
		</button>
		<a class="navbar-brand" href="javascript:document.PCO_FormVerMenu.submit();"><img id="PCO_LogoAplicacion" width="115" height="30" src="img/logo.png?<?php echo filemtime('img/logo.png'); ?>" border="0" ALT="Practico"></a>
	</div>


	<!-- /.navbar-header -->

<?php
    function ImprimirArregloCompleto($Arreglo,$Separador)
        {
            $SalidaFuncion="";
            foreach ($Arreglo as $Elemento)
                {
                    //Si el tipo de datos es arreglo llama a la funcion nuevamente, sino lo imprime
                    if (strtolower(gettype($Elemento)) == "array")
                        $SalidaFuncion.=ImprimirArregloCompleto($Elemento,$Separador);
                    else
                        {
                            $SalidaFuncion.=$Separador;
                            if (key($Elemento)!="") $SalidaFuncion.= key($Elemento).":";
                            $SalidaFuncion.= $Elemento;
                        }
                }
            return $SalidaFuncion;
        }
    
    function ImprimirArregloVariablesInternas($Funcion)
        {
            switch($Funcion) {
                case 'get_loaded_extensions': echo ImprimirArregloCompleto(get_loaded_extensions(),", "); break;
                case 'ini_get_all':           echo ImprimirArregloCompleto(ini_get_all(),", "); break;
                case 'request':               echo ImprimirArregloCompleto(array_keys($_REQUEST),"\\n    "); break;
                case 'debug_backtrace':       echo ImprimirArregloCompleto(debug_backtrace(),"\\n    "); break;
                case 'get_browser':           echo ImprimirArregloCompleto(get_browser(null, true),"\\n    "); break;
                case 'getallheaders':         echo ImprimirArregloCompleto(getallheaders(),"\\n    "); break;
            }
        }

    function PCO_DetectarSistemaOperativoCliente()
        {
        	$SistemasABuscar=array("WIN","MAC","LINUX");
        	# definimos unos valores por defecto para el navegador y el sistema operativo
        	$SistemaDetectado = "OTHER";
        	foreach($SistemasABuscar as $Sistema)
        		if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$Sistema)!==false) $SistemaDetectado = $Sistema;
        	return $SistemaDetectado;
        }
    ?>


	<ul class="nav navbar-top-links navbar-right">

	<?php
		if ($PCOSESS_SesionAbierta)
		{
			//Agrega boton de reporte de Bugs si esta habilitado el sistema
			if ($PermitirReporteBugs==1 && $PCO_Accion!="PCO_ReportarBugs")
				echo '<a class="btn btn-xs" href="javascript:PCO_CargarReportarBugs();" data-toggle="tooltip" data-html="true" data-placement="auto" title="'.$MULTILANG_BTReporteBugs.'" href="javascript:document.location=\'index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=frm:-3:1\';"><i id="PCO_IconoBugTracker" class="fa fa-bug"></i></a><i id="PCO_TextoBugTracker"></i>&nbsp;';

			//Presenta titulo de la aplicacion
				echo '<div id="PCODIV_TituloAplicacion" style="display:inline;"><b>'.$Nombre_Empresa_Corto.' - '.$Nombre_Aplicacion.' </b> <i> v'.$Version_Aplicacion.'</i></div>&nbsp;';
			//else
			//	echo $MULTILANG_SubtituloPractico1.' '.$MULTILANG_SubtituloPractico2;

			//Despliega boton de desarrollo
			if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
				echo '<a data-toggle="modal" class="btn btn-danger btn-xs" href="#myModalDESARROLLO"><i class="fa fa-puzzle-piece"></i> '.$MULTILANG_DesAppBoton.'</a>&nbsp;';

			//Agrega boton de retorno al inicio si la accion es diferente al escritorio
			if ($PCO_Accion!="PCO_VerMenu")
				echo '<a class="btn btn-success btn-xs" href="javascript:document.location=\'index.php\';"><i class="fa fa-home"></i></a>&nbsp;';


    ?>
				<li class="dropdown" id="PCODIV_IconoAlertasBarraSuperior">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-bell fa-fw text-success"></i> <span class="badge" id="PCODIV_ConteoAlertasBarraSuperior"></span> <i class="fa fa-caret-down text-success pull-right"></i>
						
					</a>
					<ul class="dropdown-menu dropdown-alerts">
						<li id="PCODIV_MarcoContenidoAlertas">
                            <?php
                                //Presenta informes marcados como de publicacion automatica en el home para el usuario actual.  PILAS. esto no aplica para el admin a menos que -por debajo- se haga la insercion del registro de permisos a modo pruebas
                                $InformesHome=PCO_EjecutarSQL("SELECT ".$TablasCore."informe.id,ancho FROM ".$TablasCore."informe,".$TablasCore."usuario_informe WHERE ".$TablasCore."usuario_informe.usuario='$PCOSESS_LoginUsuario' AND ".$TablasCore."usuario_informe.informe=".$TablasCore."informe.id AND (permitido_home='B' OR permitido_home='A') ORDER BY titulo ");
                                $PCO_ConteoRegistrosAlertas=0;
                                while ($RegistroInformeHome=$InformesHome->fetch())
                                    {
                                        if ($RegistroInformeHome["ancho"]!="")
                                            echo "<div class='".$RegistroInformeHome["ancho"]."'>";
                                        PCO_CargarInforme($RegistroInformeHome["id"],0);
                                        $PCO_ConteoRegistrosAlertas+=$PCOVAR_ConteoRegistrosUltimoInforme;
                                        if ($RegistroInformeHome["ancho"]!="")
                                            echo "</div>";
                                    }
                            ?>
						</li>
					</ul>
					<!-- /.dropdown-alerts -->
				</li>
				<script language="javascript">
				    //Asigna el numero albadget de alertas segun la cantidad de registros en los informes superiores, sino oculta el icono de alertas
				    var PCO_ConteoRegistrosAlertas=<?php echo $PCO_ConteoRegistrosAlertas; ?>;
				    if (PCO_ConteoRegistrosAlertas>0)
				        $("#PCODIV_ConteoAlertasBarraSuperior").html(PCO_ConteoRegistrosAlertas);
				    else
				        $("#PCODIV_IconoAlertasBarraSuperior").hide();
				</script>

    <?php
			//Despliega opciones de configuracion
			if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
			{
    ?>

				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-cog fa-fw text-danger"></i> <i class="fa fa-caret-down text-danger"></i>
					</a>
					<ul class="dropdown-menu dropdown-alerts">
                        <h6 class="dropdown-header"><?php echo ($MULTILANG_Configuracion); ?>:</h6>
						<li>
							<a data-toggle="modal" href="#myModalCONFIGURACION">
								<div>
									<i class="fa fa-wrench fa-fw"></i> <?php echo $MULTILANG_ConfiguracionGeneral; ?>
								</div>
							</a>
						</li>
						<li>
							<a href="javascript:document.PCO_EditarConfiguracionOAuth.submit();">
								<div>
									<i class="fa fa-soundcloud fa-fw"></i> <?php echo $MULTILANG_OauthButt; ?>
									<span class="pull-right badge"><?php echo PCO_ContarProveedoresOAuthConfigurados(); ?></span>
								</div>
							</a>
						</li>
						<li>
							<a data-toggle="modal" href="javascript:document.PCO_VerReplicaciones.submit();">
								<div>
									<i class="fa fa-cubes fa-fw"></i> <?php echo $MULTILANG_ReplicaTitulo; ?>
									<span class="pull-right badge"><?php echo PCO_ContarRegistrosTabla($TablasCore."replicasbd",""); ?></span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
                        <h6 class="dropdown-header"><?php echo $MULTILANG_Aplicacion; ?>:</h6>
						<li>
							<a data-toggle="modal" href="#myModalPARAMETROS">
								<div>
									<i class="fa fa-tasks fa-fw"></i> <?php echo $MULTILANG_ParamApp; ?>
								</div>
							</a>
						</li>
						<li>
							<a data-toggle="modal" href="#myModalWEBSERVICES">
								<div>
									<i class="fa fa-link fa-fw"></i> <?php echo $MULTILANG_WSConfigButt; ?>
									<span class="pull-right badge"><?php echo PCO_ContarRegistrosTabla($TablasCore."llaves_api",""); ?></span>
								</div>
							</a>
						</li>
						<li>
							<a data-toggle="modal" href="javascript:document.PCO_VerTareasCron.submit();">
								<div>
									<i class="fa fa-clock-o fa-fw"></i> <?php echo $MULTILANG_CronTitulo; ?>
									<span class="pull-right badge"><?php echo PCO_ContarRegistrosTabla($TablasCore."tareascron",""); ?></span>
								</div>
							</a>
						</li>
						<li>
							<a data-toggle="modal" href="javascript:document.PCO_VerMonitoreo.submit();">
								<div>
									<i class="fa fa-lightbulb-o fa-fw"></i> <?php echo $MULTILANG_MonTitulo; ?>
									<span class="pull-right badge"><?php echo PCO_ContarRegistrosTabla($TablasCore."monitoreo",""); ?></span>
								</div>
							</a>
						</li>
						<li>
							<a data-toggle="modal" href="javascript:document.PCO_AcortadorDirecciones.submit();">
								<div>
									<i class="fa fa-external-link fa-fw"></i> Generador de URLs cortas
									<span class="pull-right badge"><?php echo PCO_ContarRegistrosTabla($TablasCore."acortadorurls",""); ?></span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
                        <h6 class="dropdown-header"><?php echo ($MULTILANG_Otros); ?>:</h6>
                        <?php
								$PCO_EnlaceExplorador="javascript:document.fileman_admin_embebido.submit();";
                    			//Verifica si esta o no en modo DEMO para hacer la operacion
                    			if ($PCO_ModoDEMO==1)
								   $PCO_EnlaceExplorador="javascript:PCOJS_MostrarMensaje('".$MULTILANG_TitDemo."','".$MULTILANG_MsjDemo."');";
                            //Siempre presenta el administrador de archivos al superusuario
                            if($PCOSESS_SesionAbierta && PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && $PCO_Accion!="")
                                {
                        ?>
                                    <li>
                                        <a href="<?php echo $PCO_EnlaceExplorador; ?>"><i class="fa fa fa-cloud-upload fa-fw"></i> <?php echo $MULTILANG_AdminArchivos; ?></a>
                                    </li>
                        <?php
                                }
                        ?>
						<li>
							<a data-toggle="modal" href="javascript:document.actualizarad.submit();">
								<div>
									<i class="fa fa-download fa-fw"></i> <?php echo $MULTILANG_Actualizacion; ?>/<?php echo $MULTILANG_Copias; ?>
								</div>
							</a>
						</li>
						<li>
							<a data-toggle="modal" href="https://gitter.im/unix4you2/practico/" target="_blank">
								<div>
									<i class="fa fa-comment-o fa-fw"></i> <?php echo $MULTILANG_ChatDevel; ?>
								</div>
							</a>
						</li>
						<li>
							<a data-toggle="modal" href="https://www.practico.org/agradecimientos" target="_blank">
								<div>
									<i class="fa fa-smile-o fa-fw"></i> Da las gracias!&nbsp; <img src="https://img.shields.io/badge/Say%20Thanks-!-1EAEDB.svg">
								</div>
							</a>
						</li>
					</ul>
					<!-- /.dropdown-alerts -->
				</li>
	<?php 
			}// Fin de despliegue opciones de configuracion

		//Presenta el menu de login de usuario
	?>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li><a href="javascript:document.actualizar_perfil.submit();"><i class="fa fa-user fa-fw"></i> <?php echo $Nombre_usuario;?></a></li>
						<li><a href="javascript:document.reseteo_clave.submit();"><i class="fa fa-key fa-fw"></i> <?php echo $MULTILANG_UsrReset; ?></a></li>
	                    <?php
							/*Carga opcion de chat solamente si esta habilitado
							  0=Apagado
							  1=Solo entre usuarios internos
							  2=Solo entre usuarios externos
							  3=Entre todos los usuarios
							  4=Exclusivo admin             */
							if (isset($Activar_ModuloChat) && $Activar_ModuloChat>0)
    							{
    							    $ComplementoOpcionMenu='<li><a data-toggle="modal" href="#Dialogo_Chat"><i class="fa fa-comment fa-fw"></i> Chat</a></li>';
    							    //Verifica si el chat es activo solo para admin
							        if ($Activar_ModuloChat==4 && PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
    								    echo $ComplementoOpcionMenu;

    							    //Verifica si el chat es activo para todos
							        if ($Activar_ModuloChat==3)
    								    echo $ComplementoOpcionMenu;

    							    //Verifica si el chat es activo para usuarios externos y el usuario lo es
							        if ($Activar_ModuloChat==2 && !PCO_EsUsuarioInterno(@$PCOSESS_LoginUsuario))
    								    echo $ComplementoOpcionMenu;

    							    //Verifica si el chat es activo para usuarios internos y el usuario lo es
							        if ($Activar_ModuloChat==1 && PCO_EsUsuarioInterno(@$PCOSESS_LoginUsuario))
    								    echo $ComplementoOpcionMenu;
    							}
    					?>
    					<?php
                            //Busca si tiene tableros kanban o le han compartido alguno
                            $RegistroTableros=PCO_EjecutarSQL("SELECT id FROM ".$TablasCore."kanban WHERE archivado<>1 AND categoria='[PRACTICO][ColumnasTablero]' AND (login_admintablero='$PCOSESS_LoginUsuario' OR compartido_rw LIKE '%|$PCOSESS_LoginUsuario|%') LIMIT 0,1 ")->fetch();
                            if ($RegistroTableros["id"]!="")
                                echo '<li><a href="javascript:document.PCO_ExplorarTablerosKanban.submit();"><i class="fa fa-sticky-note fa-fw"></i> '.$MULTILANG_TablerosKanban.'</a></li>';
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

<script language="JavaScript">
    //Oculta la barra de navegacion superior a los usuarios estandar segun la configuracion y en algunas secciones fijas del sistema
    //VEASE FUNCION HERMANA AL FINAL DE MARCO_NAVIZQ PARA OCULTAR BOTON DE DESPLIEGUE DE BARRA IZQUIERDA
    <?php
        if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && $PWA_OcultarBarrasHerramientas=="1" )
            echo '$("#BarraNavegacionSuperior").hide();';
        else
            {
                //oculta la barra en acciones especificas sin importar el tipo de usuario
                if ( ( $PCO_Accion=="" && !$PCOSESS_SesionAbierta ) )
                    echo '$("#BarraNavegacionSuperior").hide();';
            }
    ?>
</script>

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
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nGET_BROWSER: <?php ImprimirArregloVariablesInternas('get_browser'); ?>"+"\n";
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nGET_DEFINED_VARS: <?php ImprimirArregloVariablesInternas('request'); ?>"+"\n";
            //document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nGET_ALL_HEADERS: <?php /*ImprimirArregloVariablesInternas('getallheaders');*/ ?>"+"\n"; //Removido compatibilidad GAE
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nGET_LOADED_EXTENSIONS: <?php ImprimirArregloVariablesInternas('get_loaded_extensions'); ?>"+"\n";
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nDEBUG_TRACE: <?php ImprimirArregloVariablesInternas('debug_backtrace'); ?>"+"\n";
            document.PCO_ReportarBugs.PCO_CapturaTrazas.value+="\nINI_GET_ALL: <?php ImprimirArregloVariablesInternas('ini_get_all'); ?>"+"\n";
            //Captura pantallazo del navegador
            CapturarCanvasPantallaAImagen('','PCO_ReportarBugsCapturaOculta','image/png',0,0,'PCO_ReportarBugs','PCO_CapturaPantalla');
        }
</script>



<?php
	// Incluye marcos con barras de navegacion
	include_once 'core/marco_navizq.php';
?>