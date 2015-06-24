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
<nav class="navbar navbar-default navbar-static-top oculto_impresion" role="navigation" style="margin-bottom: 0">
	
	
	<div class="navbar-header">
		<button OnClick="document.getElementById('barra_navegacion_izquierda').style.visibility='visible';" type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="javascript:document.core_ver_menu.submit();"><img src="img/logo.png" border="0" ALT="Practico"></a>
	</div>
	<!-- /.navbar-header -->


	<ul class="nav navbar-top-links navbar-right">


		<?php
			//Presenta titulo de la aplicacion
			if ($PCOSESS_SesionAbierta)
				echo '<b>'.$Nombre_Empresa_Corto.' - '.$Nombre_Aplicacion.' </b> <i> v'.$Version_Aplicacion.'</i>';
			//else
			//	echo $MULTILANG_SubtituloPractico1.' '.$MULTILANG_SubtituloPractico2;
		?>
		<?php 
			//Despliega botones de desarrollo
			$PCO_EnlacePCODER="javascript:PCO_VentanaPopup('index.php?PCO_Accion=PCOMOD_CargarPcoder&Presentar_FullScreen=1&Precarga_EstilosBS=1','Pcoder','toolbar=no, location=no, directories=0, directories=no, status=no, location=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, titlebar=no, width=800, height=600');";
			if (@$PCOSESS_LoginUsuario=="admin" && $PCOSESS_SesionAbierta)    
				echo '<a data-toggle="modal" class="btn btn-primary btn-xs " href="'.$PCO_EnlacePCODER.'"><i class="fa fa-file-code-o"></i> PCoder</a>
				<a data-toggle="modal" class="btn btn-danger btn-xs" href="#myModalDESARROLLO"><i class="fa fa-puzzle-piece"></i> '.$MULTILANG_DesAppBoton.'</a>';
		?>
		<?php 
			//Agrega boton de retorno al inicio si la accion es diferente al escritorio
			if ($PCO_Accion!="Ver_menu" && $PCOSESS_SesionAbierta)
				echo '<a class="btn btn-success btn-xs" href="javascript:document.core_ver_menu.submit();"><i class="fa fa-home"></i></a>';
		?>
		<?php 
			//Despliega opciones de configuracion
			if (@$PCOSESS_LoginUsuario=="admin" && $PCOSESS_SesionAbierta)
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
										<span class="pull-right text-muted small">1</span>
									</div>
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a data-toggle="modal" href="#myModalPARAMETROS">
									<div>
										<i class="fa fa-tasks fa-fw"></i> <?php echo $MULTILANG_ParamApp; ?>
										<span class="pull-right text-muted small">2</span>
									</div>
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a data-toggle="modal" href="#myModalOAUTH">
									<div>
										<i class="fa fa-soundcloud fa-fw"></i> <?php echo $MULTILANG_OauthButt; ?>
										<span class="pull-right text-muted small">3</span>
									</div>
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a data-toggle="modal" href="#myModalWEBSERVICES">
									<div>
										<i class="fa fa-link fa-fw"></i> <?php echo $MULTILANG_WSConfigButt; ?>
										<span class="pull-right text-muted small">4</span>
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
										<span class="pull-right text-muted small">5</span>
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
										<span class="pull-right text-muted small">6</span>
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
							<li><a data-toggle="modal" href="#Dialogo_Chat"><i class="fa fa-comment fa-fw"></i> Chat</a></li>
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


<?php
	// Incluye marcos con barras de navegacion
	include_once("core/marco_navizq.php");
?>

</nav>
