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
	Ubicacion *[/core/marco_arriba.php]*.  Archivo dedicado a la diagramacion de contenidos en el encabezado de la aplicacion, incluye el menu superior horizontal

	Variables de entrada:

		NombreRAD - Nombre de la aplicacion para encabezado
		PlantillaActiva - Nombre de la plantilla activa para diagramar el sistema
		Login_usuario - Nombre de usuario que se encuentra logueado en el sistema
		Sesion_abierta - Bandera que indica si hay una sesion activa
		ArchivoCORE - Nombre del archivo principal que procesa todas las solicitudes

		(start code)
			if ($Login_usuario!="admin")
				{
					$Complemento_tablas=",".$TablasCore."usuario_menu";
					$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.id AND ".$TablasCore."usuario_menu.usuario='$Login_usuario'";  // AND nivel>0
				}
			SELECT * FROM ".$TablasCore."menu ".$Complemento_tablas." WHERE posible_arriba ".$Complemento_condicion
		(end)

	Salida:
		Encabezado de aplicacion y menu superior disponible para el usuario activo

	Ver tambien:
		<Seccion inferior> | <Articulador>
	*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="generator" content="Practico <?php  $version = file("inc/version_actual.txt"); echo trim($version[0]); ?>" />
	<meta name="description" content="Generador de aplicaciones web - www.practico.org" />
    <meta name="author" content="John Arroyave G. - {www.practico.org} - {unix4you2 at gmail.com}">

	<title><?php echo $NombreRAD; ?> <?php echo trim($version[0]); ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="inc/bootstrap/css/bootstrap.min.css" rel="stylesheet"  media="screen">
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- MetisMenu CSS -->
    <link href="inc/bootstrap/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- CSS Personalizado -->
    <link href="inc/bootstrap/css/sb-admin-2.css" rel="stylesheet">
    <link href="inc/bootstrap/css/practico.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="inc/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">



<!--

	<script type="text/javascript" src="inc/practico/javascript/tooltips.js"></script>
	<script type="text/javascript" src="inc/practico/javascript/validaform.js"></script>
	<script type="text/javascript" src="inc/practico/javascript/popup.js"></script>
	<script type="text/javascript" src="inc/practico/javascript/html5slider.js"></script>

	<link rel="stylesheet" href="inc/font-awesome/css/font-awesome.min.css">

	<link type="text/css" rel="stylesheet" media="all" href="inc/chat/css/chat.css" />
	<link type="text/css" rel="stylesheet" media="all" href="inc/chat/css/screen.css" />
-->

	<!--[if lte IE 7]>
	<link type="text/css" rel="stylesheet" media="all" href="inc/chat/css/screen_ie.css" />
	<![endif]-->



	<link rel="shortcut icon" href="skin/<?php echo $PlantillaActiva; ?>/img/favicon.ico"/>

	<script language="JavaScript">
		function abrir_ventana_popup(theURL,winName,features)
			{ 
				window.open(theURL,winName,features);
			}
	</script>
</head>
<body oncontextmenu="return false;">

    <div id="wrapper" class="wrapper">

<!--
<nav class="navbar navbar-inverse navbar-static-top"  role="navigation">
  <div class="container">
    ...
  </div>
</nav>
-->


        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $ArchivoCORE; ?>"><img src="img/logo.png" border="0" ALT="Practico"></a>
            </div>
            <!-- /.navbar-header -->






            <ul class="nav navbar-top-links navbar-right">


				<?php
                    //Presenta titulo de la aplicacion
					if ($Sesion_abierta)
						echo '<b>'.$Nombre_Empresa_Corto.' - '.$Nombre_Aplicacion.' </b> <i> v'.$Version_Aplicacion.'</i>';
					//else
					//	echo $MULTILANG_SubtituloPractico1.' '.$MULTILANG_SubtituloPractico2;
				?>
                                    
				<?php 
					//Despliega botones de desarrollo
					if (@$Login_usuario=="admin" && $Sesion_abierta)
						echo '<a data-toggle="modal" class="btn btn-danger btn-xs" href="#myModalDESARROLLO"><i class="fa fa-puzzle-piece"></i> '.$MULTILANG_DesAppBoton.'</a>';
				?>
				<?php 
                    //Agrega boton de retorno al inicio si la accion es diferente al escritorio
					if ($accion!="Ver_menu" && $Sesion_abierta)
						echo '<a class="btn btn-success btn-xs" href="javascript:document.core_ver_menu.submit();"><i class="fa fa-home"></i></a>';
				?>
				<?php 
					//Despliega opciones de configuracion
					if (@$Login_usuario=="admin" && $Sesion_abierta)
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
                                            <input type="Hidden" name="accion" value="administrar_monitoreo">
                                        </form>
                                        <i class="fa fa-lightbulb-o fa-fw"></i> <?php echo $MULTILANG_MonTitulo; ?>
                                        <span class="pull-right text-muted small">4</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>...</strong>
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
					if ($Sesion_abierta) {
				?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $Nombre_usuario;?></a>
                            </li>
                            <li><a data-toggle="modal" href="#Dialogo_Chat"><i class="fa fa-comment fa-fw"></i> Chat</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="javascript:cerrar_sesion.submit();"><i class="fa fa-sign-out fa-fw"></i> <?php echo $MULTILANG_CerrarSesion; ?></a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
				<?php
					}
				?>


            </ul>
            <!-- CIERRA /.navbar-top-links -->




            <div id="menu_izquierdo" class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Buscar...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Flot Charts</a>
                                </li>
                                <li>
                                    <a href="morris.html">Morris.js Charts</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>
                        </li>
                        <li>
                            <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="panels-wells.html">Panels and Wells</a>
                                </li>
                                <li>
                                    <a href="buttons.html">Buttons</a>
                                </li>
                                <li>
                                    <a href="notifications.html">Notifications</a>
                                </li>
                                <li>
                                    <a href="typography.html">Typography</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grid</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li class="active">
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a class="active" href="blank.html">Blank Page</a>
                                </li>
                                <li>
                                    <a href="login.html">Login Page</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                
                

                    <div class="alert alert-info" role="alert">
                        <?php 
                        //Presenta informacion de carga del aplicativo
                        echo $MULTILANG_Instante; ?>:&nbsp;&nbsp;<?php echo $fecha_operacion_guiones;?>&nbsp;&nbsp;<?php echo $hora_operacion_puntos;?>
                        <br>
                        <?php
                            // Muestra la accion actual si el usuario es administrador y la accion no es vacia - Sirve como guia a la hora de crear objetos
                            if(@$Login_usuario=="admin" && $accion!="")
                                {
                                    // Calcula tiempos de ejecucion del script
                                    $tiempo_final_script = obtener_microtime();
                                    $tiempo_total_script = $tiempo_final_script - $tiempo_inicio_script;
                                    echo "$MULTILANG_Accion: $accion <br>$MULTILANG_TiempoCarga: ";
                                    echo round($tiempo_total_script,3);
                                    echo " s<br>Inclusiones: ".count(get_included_files()); // Retorna arreglo con cantidad de archivos incluidos
                                }
                        ?>
                        <hr>
                        <i><i class="fa fa-copyright"></i> <a href="http://www.practico.org">Practico.org</a></i>&nbsp;&nbsp;
                    </div>


                </div>
                <!-- FIN DEL /.sidebar-collapse -->
            </div>
            <!-- FIN DEL /.navbar-static-side -->
            



        </nav>



        <!-- CONTENIDO DE APLICACION -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">







<!-- INICIA MARCO DE CHAT -->
<div id="main_container" style="overflow: auto;">

<div id='FondoPopUps' class="FondoOscuroPopUps"></div>

<form action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;" name="core_ver_menu">
	<input type="Hidden" name="accion" value="Ver_menu">
</form>

<?php 
	//Despliega marco de administracion a ser activado por el boton superior
	if (@$Login_usuario=="admin" && $Sesion_abierta)
		{
			include_once("core/marco_dev.php");
			include_once("core/marco_conf.php");
			include_once("core/marco_wscfg.php");
			include_once("core/marco_oauth.php");
			include_once("core/marco_param.php");
		}
	include_once("core/marco_chat.php");
?>

<!-- INICIA LA TABLA PRINCIPAL -->
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="left">

	<!-- INICIO DEL ENCABEZADO -->
	<tr><td>

		<!-- FIN DEL ENCABEZADO -->

		<table width="100%" cellspacing="0" cellpadding="0" border=0 class="MenuSuperior"><tr>
			<td valign="top">
				<?php

					if ($Sesion_abierta && $accion=="Ver_menu") {
						echo '&nbsp;@<b>'.@$Login_usuario.'</b>>&nbsp;&nbsp;&nbsp;';
						// Carga las opciones del menu superior

						// Si el usuario es diferente al administrador agrega condiciones al query
						if ($Login_usuario!="admin")
							{
								$Complemento_tablas=",".$TablasCore."usuario_menu";
								$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.id AND ".$TablasCore."usuario_menu.usuario='$Login_usuario'";  // AND nivel>0
							}
						$resultado=ejecutar_sql("SELECT ".$TablasCore."menu.id as id,$ListaCamposSinID_menu FROM ".$TablasCore."menu ".@$Complemento_tablas." WHERE posible_arriba=1 ".@$Complemento_condicion);

						while($registro = $resultado->fetch())
							{
								// Imprime la imagen asociada si esta definida
								if ($registro["imagen"]!="")
									{
										// Verifica si se tiene el string  .png en la cadena para saber si es icono de imagen, sino lo asume como font awesome
										$es_imagen_png=strpos($registro["imagen"],".png");
										if ($es_imagen_png) echo '<img src="img/'.$registro["imagen"].'" border=0 alt="" valign="absmiddle" align="absmiddle" width="14" height="13" >&nbsp;';
										else  echo '<i class="'.$registro["imagen"].'"></i>&nbsp;';									
									}

								// Verifica si se trata de un comando interno y crea formulario y enlace correspondiente
								//if ($registro["tipo_comando"]=="Interno")
									{
										echo '<form action="'.$ArchivoCORE.'" method="post" name="top_'.$registro["id"].'" id="top_'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;"><input type="hidden" name="accion" value="'.$registro["comando"].'"></form>';
										echo '<a href="javascript:document.top_'.$registro["id"].'.submit();">'.$registro["texto"].'</a>';
									}

								// Agrega un separador de menu
								echo '<img src="skin/'.$PlantillaActiva.'/img/sep1.gif" border=0 alt="" valign="absmiddle" align="absmiddle" >';
							}
				?>
				<?php 
					}
					else
						echo '<br>';
				?>
			</td>
		</tr></table>
		<form method="POST" name="cerrar_sesion" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			<input type="Hidden" name="accion" value="Terminar_sesion">
		</form>
	</td></tr>

	<!-- INICIO  DE CONTENIDOS DE APLICACION -->


	<!-- INICIO DEL CONTENIDO CENTRAL -->
	<tr><td height="100%" valign="<?php if ($accion=="Ver_menu") echo 'TOP'; else echo 'MIDDLE'; ?>" align="center">
	<!-- INICIO DEL CONTENIDO CENTRAL -->
