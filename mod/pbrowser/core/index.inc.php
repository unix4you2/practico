<?php 

    // BLOQUE BASICO DE INCLUSION ######################################
    // Inicio de la sesion
    @session_start();

    //Incluye archivo inicial de configuracion
	include_once("configuracion.php");

    //Incluye idioma espanol, o sobreescribe vbles por configuracion de usuario
    include("../inc/idiomas/es.php");
    include("../inc/idiomas/".$IdiomaPredeterminado.".php");
    // #################################################################

if (basename(__FILE__) == basename($_SERVER['PHP_SELF']))
{
    exit(0);
}

echo '<?xml version="1.0" encoding="utf-8"?>';

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
<head>
	<title>PBrowser</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  
    <!-- CSS Core de Bootstrap -->
    <link href="../../../inc/bootstrap/css/bootstrap.min.css" rel="stylesheet"  media="screen">
    <link href="../../../inc/bootstrap/css/bootstrap-theme.css" rel="stylesheet"  media="screen">

    <!-- Custom Fonts -->
    <link href="../../../inc/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>

<div id="wrapper">
	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
<!-- INICIO  DE CONTENIDOS DE APLICACION -->


	<!-- 
	#######################################################################################
	DISPOSICION PARA NAVEGADOR  ###########################################################
	#######################################################################################  -->
			<div class="row">
				<div class="col-md-12" align="center">
					
					
					

						<!-- INICIO FORMULARIO DE NAVEGACION -->
						<?php
							//Presenta el formulario solo si se desea
							if ($PCO_PBROWSER_IncluirForm=="")
								{
						?>
						<font size=1><br></font>
						<form id="formulario_navegacion" target="iframe_navegacion" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">			
						
							<!-- INICIO DIRECCION -->
								<div class="form-group input-group">										
									<span class="input-group-addon">
										<i class="fa fa-2x fa-globe text-info"> <b><a href="<?php echo $_SERVER['PHP_SELF'] ?>">PBrowser</a></b></i>
									</span>
									<input class="form-control input-lg alert-warning" placeholder="<?php echo $MULTILANG_PBROWSER_DireccionWeb; ?>" id="address_box" type="text" name="<?php echo $GLOBALS['_config']['url_var_name'] ?>" value="<?php echo isset($GLOBALS['_url']) ? htmlspecialchars($GLOBALS['_url']) : '' ?>" onfocus="this.select()" />
									<span class="input-group-addon">
										<button id="go" type="submit" class="btn btn-success"><i class="fa fa-fw fa-arrow-circle-right"></i></button>
										&nbsp;
										<a data-toggle="modal" class="btn btn-info" href="#myModalCONFIGURACIONPBROWSER"><i class="fa fa-fw fa-cog"></i></a>
									</span>
								</div>
							<!-- FIN DIRECCION -->

							<!-- INICIO CONFIGURACIONES -->
								<div class="modal fade" id="myModalCONFIGURACIONPBROWSER" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
												<h4 class="modal-title" id="myModalLabel"><?php echo $MULTILANG_PBROWSER_PanelConfig; ?></h4>
											</div>
											<div class="modal-body mdl-primary">

													<!-- Nav tabs -->
													<ul class="nav nav-tabs">
														<li class="active"><a href="#configbasicas-tab" data-toggle="tab"><?php echo $MULTILANG_PBROWSER_Config; ?></a>
														</li>
														<li><a href="#acercapbrowser-tab" data-toggle="tab"><?php echo $MULTILANG_PBROWSER_Acerca; ?></a>
														</li>
													</ul>

													<!-- INICIO de las pestanas -->
													<div class="tab-content">
														<div class="tab-pane fade in active" id="configbasicas-tab">

																<!-- INICIO INFORMACION DE SESION -->
																	<br>
																	<?php 
																		//Informacion general del navegante
																		echo $MULTILANG_PBROWSER_NavegandoComo; ?> <b><?php if ($_SESSION['PCOSESS_LoginUsuario']!="") echo $_SESSION['PCOSESS_LoginUsuario']; else echo $MULTILANG_PBROWSER_Anonimo; ?> (<?php echo $PCO_PBROWSER_DireccionAuditoria; 
																	?>)</b><hr>
																<!-- FIN INFORMACION DE SESION -->
																
																<!-- INICIO BANDERAS DE CONFIGURACION -->
																	<div align="left" >

																		<div class="checkbox" ><label>
																			<input 	type="checkbox" name="PCO_PBROWSER_IncluirForm" checked="checked" /><?php echo $MULTILANG_PBROWSER_MiniformFull; ?>
																		</label></div>

																		<div class="checkbox" ><label>
																			<input 	type="checkbox" name="hl[remove_scripts]"/><?php echo $MULTILANG_PBROWSER_RemoverScriptFull; ?>
																		</label></div>

																		<div class="checkbox" ><label>
																			<input 	type="checkbox" name="hl[accept_cookies]" checked="checked" /><?php echo $MULTILANG_PBROWSER_CookiesFull; ?>
																		</label></div>

																		<div class="checkbox" ><label>
																			<input 	type="checkbox" name="hl[show_images]" checked="checked" /><?php echo $MULTILANG_PBROWSER_ImagenesFull; ?>
																		</label></div>

																		<div class="checkbox" ><label>
																			<input 	type="checkbox" name="hl[show_referer]" /><?php echo $MULTILANG_PBROWSER_ReferenciaFull; ?>
																		</label></div>

																		<div class="checkbox" ><label>
																			<input 	type="checkbox" name="hl[rotate13]" /><?php echo $MULTILANG_PBROWSER_Rotate13Full; ?>
																		</label></div>

																		<div class="checkbox" ><label>
																			<input 	type="checkbox" name="hl[base64_encode]" checked="checked" /><?php echo $MULTILANG_PBROWSER_Base64Full; ?>
																		</label></div>

																		<div class="checkbox" ><label>
																			<input 	type="checkbox" name="hl[strip_meta]" /><?php echo $MULTILANG_PBROWSER_MetaTagsFull; ?>
																		</label></div>

																		<div class="checkbox" ><label>
																			<input 	type="checkbox" name="hl[strip_title]" /><?php echo $MULTILANG_PBROWSER_TituloFull; ?>
																		</label></div>

																		<div class="checkbox" ><label>
																			<input 	type="checkbox" name="hl[session_cookies]" checked="checked" /><?php echo $MULTILANG_PBROWSER_CookiesOtroFull; ?>
																		</label></div>
																	</div>
																<!-- INICIO BANDERAS DE CONFIGURACION -->

																<i class="fa fa-question-circle"> <?php echo $MULTILANG_PBROWSER_ConfigQueHace; ?></i>
																<br><font size=1 color=gray><?php echo $MULTILANG_PBROWSER_ConfigDes; ?></font>
														</div>
														<div class="tab-pane fade" id="acercapbrowser-tab">
																<br><img align="absmiddle" src="../../../img/pbrowser.png" border=0> <br>
																<i>[PBrowser ver <?php echo $GLOBALS['_version'] ?>]</i> Powered by <a href="http://www.practico.org/"><i>Practico Framework PHP (www.practico.org)</i></a><hr>

																   <b>Sistema Simple de Navegacion por Proxy basado en PHP<br></b>
																   Copyright (C) 2015  John F. Arroyave Guti&eacute;rrez<br><br>
																<?php echo $MULTILANG_PBROWSER_ResumenLicencia; ?><br>
														</div>
													</div>
													<!-- FIN de las pestanas -->

											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $MULTILANG_PBROWSER_Cerrar; ?> {<i class="fa fa-keyboard-o"></i> Esc}</button>
											</div>
										</div>
									</div>
								</div>
							<!-- FIN CONFIGURACIONES -->

						</form>
						<?php
								} //FinSi PBROWSER_IncluirForm
						?>
						<!-- FIN FORMULARIO DE NAVEGACION -->
				
				
				
				
				</div> <!-- col encabezado -->
			</div> <!-- row encabezado -->
			<div class="row">

				<div class="col-md-12">
					
					<?php
						/*#################################################################################
						PRESENTACION DE RESULTADOS ########################################################
						###################################################################################*/

								switch ($data['category'])
									{
										case 'auth':
											?>
												<div id="auth">
													<p>
														<b><?php echo $MULTILANG_PBROWSER_UsuarioClave; ?> "<?php echo htmlspecialchars($data['realm']) ?>" <?php echo $MULTILANG_PBROWSER_En; ?> <?php echo $GLOBALS['_url_parts']['host'] ?></b>
														<form method="post" action="">
															<input type="hidden" name="<?php echo $GLOBALS['_config']['basic_auth_var_name'] ?>" value="<?php echo base64_encode($data['realm']) ?>" />
															<label><?php echo $MULTILANG_PBROWSER_Usuario; ?> <input type="text" name="username" value="" /></label> <label><?php echo $MULTILANG_PBROWSER_Clave; ?> <input type="password" name="password" value="" /></label> <input type="submit" value="<?php echo $MULTILANG_PBROWSER_Entrar; ?>" />
														</form>
													</p>
												</div>
											<?php
											break;
										case 'error':
											echo '<div id="error"><p>';
											switch ($data['group'])
												{
													case 'url':
														echo '<b><i class="fa fa-2x fa-pull-left text-danger fa-exclamation-circle"> '. $MULTILANG_PBROWSER_ErrorURL .' (' . $data['error'] . '):</i></b><hr> ';
														switch ($data['type'])
															{
																case 'internal':
																	$message = $MULTILANG_PBROWSER_FalloHost;
																	break;
																case 'external':
																	switch ($data['error'])
																		{
																			case 1:
																				$message = $MULTILANG_PBROWSER_ListaNegra;
																				break;
																			case 2:
																				$message = $MULTILANG_PBROWSER_URLMala;
																				break;
																		}
																	break;
															}
														break;
													case 'resource':
														echo '<b><i class="fa fa-2x fa-pull-left text-danger fa-exclamation-circle"> '. $MULTILANG_PBROWSER_ErrorRecurso .':</i></b><hr>  ';
														switch ($data['type'])
															{
																case 'file_size':
																	$message = $MULTILANG_PBROWSER_ArchivoGrande.'<br />'
																	. $MULTILANG_PBROWSER_MaximoPosible.' <b>' . number_format($GLOBALS['_config']['max_file_size']/1048576, 2) . ' MB</b><br />'
																	. $MULTILANG_PBROWSER_PesoArchivo.' <b>' . number_format($GLOBALS['_content_length']/1048576, 2) . ' MB</b>';
																	break;
																case 'hotlinking':
																	$message = $MULTILANG_PBROWSER_HotLink;
																	break;
															}
														break;
												}
											echo $MULTILANG_PBROWSER_ErrorTitulo.' <br />' . $message . '</p></div>';
											break;
									}


						/*#################################################################################
						FIN PRESENTACION DE RESULTADOS ####################################################
						###################################################################################*/
					?>

					<div id="area_navegacion">
							<iframe style="display:block; width:100%; height:100vh;" height="100vh" name="iframe_navegacion" id="iframe_navegacion" frameborder="0" src="">
							</iframe>
					</div> <!-- area_navegacion -->

				</div>
			</div> <!-- ROW -->
	<!-- 
	#######################################################################################
	FIN DISPOSICION PARA NAVEGADOR ########################################################
	#######################################################################################  -->


<!-- FIN  DE CONTENIDOS DE APLICACION -->
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
	<script type="text/javascript" src="../../../inc/jquery/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="../../../inc/bootstrap/js/bootstrap.min.js"></script>
    
	<script type="text/javascript">
		/*
		//Establece la accion predeterminada del form "formulario_navegacion" para que sea cargado en el div "area_navegacion"
		$("#formulario_navegacion").submit(function(event){
			event.preventDefault();
			$.post( "index.php" , $("#formulario_navegacion").serialize(), function(data){
				$("#area_navegacion").html(data);
			});
		});
		*/
	</script>

</body>
</html>
