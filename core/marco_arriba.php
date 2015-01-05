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

    <!-- CSS Core de Bootstrap -->
    <link href="inc/bootstrap/css/bootstrap.min.css" rel="stylesheet"  media="screen">
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- CSS Plugins BootStrap -->
    <link href="inc/bootstrap/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/morris.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/timeline.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/social-buttons.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/datepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/slider/slider.css" rel="stylesheet">
    <link href="inc/bootstrap/css/plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- CSS Personalizado (Plantilla y Practico) -->
    <link href="inc/bootstrap/css/sb-admin-2.css" rel="stylesheet">
    <link href="inc/bootstrap/css/practico.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="inc/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- JavaScript Personalizado -->
	<script type="text/javascript" src="inc/practico/javascript/validaform.js"></script>
	<script type="text/javascript" src="inc/practico/javascript/html5slider.js"></script>

	<link type="text/css" rel="stylesheet" media="all" href="inc/chat/css/chat.css" />
	<link type="text/css" rel="stylesheet" media="all" href="inc/chat/css/screen.cssXXX" />
	<!--[if lte IE 7]>
	<link type="text/css" rel="stylesheet" media="all" href="inc/chat/css/screen_ie.css" />
	<![endif]-->


	<link rel="shortcut icon" href="img/favicon.ico"/>
	<script language="JavaScript">
		function abrir_ventana_popup(theURL,winName,features)
			{ 
				window.open(theURL,winName,features);
			}
	</script>
</head>
<body oncontextmenu="return false;">

    <div id="wrapper">


        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
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
					if ($PCO_Accion!="Ver_menu" && $Sesion_abierta)
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
                                        <i class="fa fa-download fa-fw"></i> <?php echo $MULTILANG_Actualizar; ?> <?php echo $NombreRAD; ?>
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
					if ($Sesion_abierta) {
				?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $Nombre_usuario;?></a></li>
                            <li><a href="javascript:document.reseteo_clave.submit();"><i class="fa fa-key fa-fw"></i> <?php echo $MULTILANG_UsrReset; ?></a></li>
                            <li><a data-toggle="modal" href="#Dialogo_Chat"><i class="fa fa-comment fa-fw"></i> Chat</a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:cerrar_sesion.submit();"><i class="fa fa-sign-out fa-fw texto-blink"></i> <?php echo $MULTILANG_CerrarSesion; ?></a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
				<?php
					}
				?>


            </ul>
            <!-- CIERRA /.navbar-top-links -->


        <?php
            //Presenta las opciones de la barra izquierda a los usuarios
            if ($Sesion_abierta && @$Login_usuario!="")
                {
        ?>
            <div id="boton_menu_izquierdo" style="position: absolute; left: 1px; top: 60px;  z-index: 2;">
                <i class="fa fa-indent fa-border texto-negro texto-blink" OnClick="javascript:barra_navegacion_izquierda_toggle('<?php if (@$ModoBarraMenuRecibido=="flotante") echo "flotante"; else echo "responsive"; ?>');"></i>
            </div>
            <div id="barra_navegacion_izquierda" class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    
                    <!--INICIO DE OPCIONES BARRA LATERAL-->
                        <ul class="nav" id="side-menu">
                            

                            <br>
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="<?php echo $MULTILANG_Buscar; ?>...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="javascript:document.core_ver_menu.submit();"><i class="fa fa-dashboard fa-fw"></i> <?php echo $MULTILANG_Escritorio; ?></a>
                            </li>
                            <li>
                                <a href="javascript:document.mis_informes.submit();"><i class="fa fa-pie-chart fa-fw"></i> <?php echo $MULTILANG_UsrInfDisp; ?></a>
                            </li>

                            <?php
                                //Siempre presenta el administrador de archivos al superusuario
                                if($Sesion_abierta && @$Login_usuario=="admin" && $PCO_Accion!="")
                                    {
                            ?>
                                        <li>
                                            <a href="javascript:document.fileman_admin_embebido.submit();"><i class="fa fa fa-cloud-upload fa-fw"></i> <?php echo $MULTILANG_AdminArchivos; ?></a>
                                        </li>
                            <?php
                                    }
                            ?>
                        </ul>
                    <!--FIN DE OPCIONES BARRA LATERAL-->

                    <div class="alert alert-info btn-xs" role="alert">
                        <strong><i class='fa fa-bolt fa-fw'></i> 
                        <?php 
                        //Presenta informacion de carga del aplicativo
                        echo $MULTILANG_Instante; ?>:</strong>&nbsp;&nbsp;<?php echo $fecha_operacion_guiones;?>&nbsp;&nbsp;<?php echo $hora_operacion_puntos;?>
                        <br>
                        <?php
                            // Muestra la accion actual si el usuario es administrador y la accion no es vacia - Sirve como guia a la hora de crear objetos
                            if(@$Login_usuario=="admin" && $PCO_Accion!="")
                                {
                                    echo "<strong><i class='fa fa-cog fa-fw'></i> $MULTILANG_Accion:</strong> $PCO_Accion <br><strong><i class='fa fa-clock-o fa-fw'></i> $MULTILANG_TiempoCarga:</strong> <div id='PCO_TCarga' name='PCO_TCarga' style='display: inline-block;'></div> s<br>";
                                    echo "<strong><i class='fa fa-file-code-o fa-fw'></i> Inclusiones:</strong> ".(count(get_included_files()))."<hr>"; // Retorna arreglo con cantidad de archivos incluidos
                                }
                        ?>
                        <div align=center>
                        <i>Copyright <i class="fa fa-copyright"></i> <a href="http://www.practico.org">Practico.org</a></i>
                        </div>
                    </div>

                </div>
                <!-- FIN DEL /.sidebar-collapse -->
            </div>
            <!-- FIN DEL /.navbar-static-side -->
        <?php
                } //Fin Presentar opciones de la barra a usuarios
        ?>
            
            
        </nav>





        <!-- CONTENIDO DE APLICACION -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <br>





<!-- INICIA MARCO DE CHAT -->
<!--<div id="main_container" style="overflow: auto;">-->




<form method="POST" name="core_ver_menu" action="<?php echo $ArchivoCORE; ?>" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="Ver_menu">
</form>
<form method="POST" name="cerrar_sesion" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="Terminar_sesion">
</form>
<form method="POST" name="reseteo_clave" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="cambiar_clave">
</form>
<form method="POST" name="mis_informes" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="mis_informes">
</form>
<form method="POST" name="fileman_admin_embebido" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="fileman_admin_embebido">
</form>


<?php 
	//Despliega marcos de administracion a ser activados por el menu superior
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



				<?php
					if ($Sesion_abierta && $PCO_Accion=="Ver_menu") {
						echo '<ul class="nav nav-pills btn-xs">';
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
								echo '<li role="presentation">';
								// Verifica si se trata de un comando interno y crea formulario y enlace correspondiente
								//if ($registro["tipo_comando"]=="Interno")
									{
										echo '<form action="'.$ArchivoCORE.'" method="post" name="top_'.$registro["id"].'" id="top_'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">';
                                        // Verifica si se trata de un comando interno o personal y crea formulario y enlace correspondiente (ambos funcionan igual)
                                        if ($registro["tipo_comando"]=="Interno" || $registro["tipo_comando"]=="Personal")
                                            {
                                                echo '<input type="hidden" name="PCO_Accion" value="'.$registro["comando"].'"></form>';
                                            }
                                        // Verifica si se trata de una opcion para cargar un objeto de practico
                                        if ($registro["tipo_comando"]=="Objeto")
                                            {
                                                echo'<input type="hidden" name="PCO_Accion" value="cargar_objeto">
                                                     <input type="hidden" name="objeto" value="'.$registro["comando"].'"></form>';
                                            }
										echo '<a href="javascript:document.top_'.$registro["id"].'.submit();">
                                        <button class="btn-circle btn-info btn-xs">
                                        <i class="'.$registro["imagen"].'"></i>
                                        </button> '.$registro["texto"].'</a>';
									}
                                echo '</li>';
							}
                        echo '</ul>';
					}
				?>




	<!-- INICIO  DE CONTENIDOS DE APLICACION -->



