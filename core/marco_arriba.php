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
		PCOSESS_LoginUsuario - Nombre de usuario que se encuentra logueado en el sistema
		PCOSESS_SesionAbierta - Bandera que indica si hay una sesion activa
		ArchivoCORE - Nombre del archivo principal que procesa todas las solicitudes

		(start code)
			if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
				{
					$Complemento_tablas=",".$TablasCore."usuario_menu";
					$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.id AND ".$TablasCore."usuario_menu.usuario='$PCOSESS_LoginUsuario'";  // AND nivel>0
				}
			SELECT * FROM ".$TablasCore."menu ".$Complemento_tablas." WHERE posible_arriba ".$Complemento_condicion
		(end)

	Salida:
		Encabezado de aplicacion y menu superior disponible para el usuario activo

	Ver tambien:
		<Seccion inferior> | <Articulador>
	*/
?>

<?php
    //Segun el tema actual asigna la variable body-bg del tema al background de los elementos principales y escritorio
    if ($Tema_PracticoFramework=="bootstrap") { $PCO_ColorFondoGeneral="#ffffff"; }
    if ($Tema_PracticoFramework=="cerulean") { $PCO_ColorFondoGeneral="#ffffff"; }
    if ($Tema_PracticoFramework=="cosmo") { $PCO_ColorFondoGeneral="#060606"; }
    if ($Tema_PracticoFramework=="cyborg") { $PCO_ColorFondoGeneral="#060606"; }
    if ($Tema_PracticoFramework=="darkly") { $PCO_ColorFondoGeneral="#222222"; }
    if ($Tema_PracticoFramework=="flatly") { $PCO_ColorFondoGeneral="#2f324a"; }
    if ($Tema_PracticoFramework=="journal") { $PCO_ColorFondoGeneral="#ffffff"; }
    if ($Tema_PracticoFramework=="lumen") { $PCO_ColorFondoGeneral="#ffffff"; }
    if ($Tema_PracticoFramework=="paper") { $PCO_ColorFondoGeneral="#ffffff"; }
    if ($Tema_PracticoFramework=="readable") { $PCO_ColorFondoGeneral="#ffffff"; }
    if ($Tema_PracticoFramework=="sandstone") { $PCO_ColorFondoGeneral="#1a221c"; }
    if ($Tema_PracticoFramework=="simplex") { $PCO_ColorFondoGeneral="#fcfcfc"; }
    if ($Tema_PracticoFramework=="slate") { $PCO_ColorFondoGeneral="#272b30"; }
    if ($Tema_PracticoFramework=="spacelab") { $PCO_ColorFondoGeneral="#ffffff"; }
    if ($Tema_PracticoFramework=="superhero") { $PCO_ColorFondoGeneral="#2b3e50"; }
    if ($Tema_PracticoFramework=="united") { $PCO_ColorFondoGeneral="#ffffff"; }
    if ($Tema_PracticoFramework=="yeti") { $PCO_ColorFondoGeneral="#2f2f2f"; }
    if ($Tema_PracticoFramework=="amelia") { $PCO_ColorFondoGeneral="#108a93"; }
    if ($Tema_PracticoFramework=="material") { $PCO_ColorFondoGeneral="#ffffff"; }

    // Incluye encabezados, estilos y demas del HEAD
    include_once("core/marco_arriba_bs.php");

    //Establece ruta estatica para la carga de imagen de fondo (si aplica)
	if(empty($_SERVER["HTTPS"]))
		$protocolo_sitioweb="http://";
	else
		$protocolo_sitioweb="https://";
	// Si se tiene un protocolo preferido sobreescribe lo auto-detectado
	if (@$Auth_ProtoTransporte=="http" || @$Auth_ProtoTransporte=="https")
		$protocolo_sitioweb=$Auth_ProtoTransporte."://";
	// Construye la URL para solicitar el webservice.  La URL se debe poder resolver por el servidor web correctamente, ya sea por dominio o IP (interna o publica).  Ver /etc/hosts si algo.
	$PCOVAR_CadenaImagenFondo=""; //Define cadena vacia en caso que no se haya definido una imagen para el fondo
	if ($PCO_ArchivoImagenFondo!="")
	    {
			$prefijo_sitioweb=$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].str_replace("index.php","",$_SERVER['PHP_SELF']);
			$PCOVAR_UrlImagenFondo = $protocolo_sitioweb.$prefijo_sitioweb."/".$PCO_ArchivoImagenFondo."?".filemtime($PCO_ArchivoImagenFondo);
			$PCOVAR_CadenaImagenFondo="background-image: url('$PCOVAR_UrlImagenFondo'); background-repeat: no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;";
	    }

?>

<body oncontextmenu="return false;"  style="background-color: <?php echo $PCO_ColorFondoGeneral; ?>;">
    <noscript>
      <div style="width: 22em; position: absolute; left: 50%; margin-left: -11em; color: red; background-color: white; border: 1px solid red; padding: 4px; font-family: sans-serif">
        Your web browser must have JavaScript enabled in order for this application to display correctly.
      </div>
    </noscript>
    <!--Marco oculto para generacion de formularios y elementos dinamicos anidados -->
    <div id="PCODIV_FormulariosDinamicos" style="visibility: hidden; display: none;"></div>

<!-- INICIA MARCO DE CHAT -->
<!-- <div id="main_container" style="overflow: auto;"> -->

    <div id="wrapper">
 
 
        <!-- Sidebar oculto al lado izquierdo -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav btn-xs">
                <div id="PCODIV_SeccionLateralFlotanteUsoInterno" align=right></div>
                <div id="PCODIV_SeccionLateralFlotante" align=right></div>
            </ul>
        </div>
        <!--Elemento requerido para uso de barra lateral oculta-->
        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle" style="display: none; visibility:hidden;"></a>
        <!-- /#sidebar-wrapper oculto al lado izquierdo-->

		<?php
            //Presenta barra de navegacion superior solamente cuando hay una accion
            if ($PCO_Accion!="") { }
            
			// Incluye marcos con barras de navegacion
			include_once("core/marco_nav.php");


		?>

        <!-- CONTENIDO DE APLICACION   -->
        <div id="page-wrapper" style="background-color: <?php echo $PCO_ColorFondoGeneral; ?>; <?php echo $PCOVAR_CadenaImagenFondo; ?> ">  <!-- page-content-wrapper -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        
						<?php
							//Agrega un enter minimo para las paginas si hay sesion activa
							if ($PCOSESS_SesionAbierta)
								echo '<br>';
						?>
						<div id="PCODIV_ArribaMenuSuperior"></div>
						<?php
							//Presenta advertencia sobre el modo de depuracion.  Se asume que debe estar siempre apagado en produccion
							if ($ModoDepuracion)
								PCO_Mensaje($MULTILANG_ModoDepuracion, "", '', 'fa fa-fw fa-2x fa-info-circle texto-blink', 'alert alert-dismissible alert-danger');
						?>

<?php 
	//Incluye formularios de uso comun para transporte de datos
	include_once("core/marco_forms.php");

	//Despliega marcos de administracion a ser activados por el menu superior
	if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && $PCOSESS_SesionAbierta)
		{
			include_once("core/marco_dev.php");
			include_once("core/marco_conf.php");
			include_once("core/marco_wscfg.php");
			include_once("core/marco_param.php");
		}
	
	//Carga marco de chat solamente si esta habilitado
	if (isset($Activar_ModuloChat) && $Activar_ModuloChat>0 && @$_SESSION['username']!="")
		include_once("core/marco_chat.php");
?>


				<?php
					if ($PCOSESS_SesionAbierta && $PCO_Accion=="PCO_VerMenu") {
						echo '<ul class="nav nav-pills btn-xs">';
						// Carga las opciones del menu superior

						// Si el usuario es diferente al administrador agrega condiciones al query
						if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
							{
								$Complemento_tablas=",".$TablasCore."usuario_menu";
								$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.hash_unico AND ".$TablasCore."usuario_menu.usuario='$PCOSESS_LoginUsuario'";  // AND nivel>0
							}
						$resultado=PCO_EjecutarSQL("SELECT ".$TablasCore."menu.id as id,$ListaCamposSinID_menu FROM ".$TablasCore."menu ".@$Complemento_tablas." WHERE (padre=0 OR padre='') AND posible_arriba=1 AND formulario_vinculado=0 ".@$Complemento_condicion." ORDER BY peso");

						while($registro = $resultado->fetch())
							PCO_ImprimirOpcionMenu($registro,'arriba');
                        echo '</ul>';
					}

                    // Si el usuario es administrador valida que ya haya cambiado al menos su correo
                    if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && @$Presentar_FullScreen!=1 && $PCO_Accion=="PCO_VerMenu")
                        {
                            $registro_usuario=PCO_EjecutarSQL("SELECT correo FROM ".$TablasCore."usuario WHERE login=? ","$PCOSESS_LoginUsuario")->fetch();
                            if ($registro_usuario["correo"]=="sucorreo@dominio.com" || $registro_usuario["correo"]=="unix4you2@gmail.com")
                                PCO_Mensaje($MULTILANG_Importante, $MULTILANG_UsrActualizarAdmin, '', 'fa fa-bell fa-3x', 'alert alert-danger alert-dismissible');
                        }

				?>
	<div id="PCODIV_AbajoMenuSuperior"></div>

	<!-- INICIO  DE CONTENIDOS DE APLICACION DISENADA POR EL USUARIO -->