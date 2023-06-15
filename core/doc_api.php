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

    //Permite WebServices propios mediante el acceso a este script en solicitudes Cross-Domain
    header('Access-Control-Allow-Origin: *');
	header('Content-type: text/html; charset=utf-8');
	header('X-XSS-Protection:0');

    // Inicio de la sesion
    @session_start();
 
    //Determina si es un primer inicio o no hay configuracion
    include '../core/configuracion.php';

    //Incluye idioma espanol, o sobreescribe vbles por configuracion de usuario
    include '../inc/practico/idiomas/es.php';
    include '../inc/practico/idiomas/'.$IdiomaPredeterminado.'.php';

    error_reporting(0);

    // Recupera variables recibidas para su uso como globales (equivale a register_globals=on en php.ini)
    if (!ini_get('register_globals'))
        {
            $PCO_NumeroParametros = count($_REQUEST);
            $PCO_NombresParametros = array_keys($_REQUEST);// obtiene los nombres de las varibles
            $PCO_ValoresParametros = array_values($_REQUEST);// obtiene los valores de las varibles
            // crea las variables y les asigna el valor
            for($i=0;$i<$PCO_NumeroParametros;$i++)
                {
                    ${$PCO_NombresParametros[$i]}=$PCO_ValoresParametros[$i];
                    //Si alguna de las variables proviene de un combo multiple la transforma a su variable original
					if (strstr($PCO_NombresParametros[$i],"PCO_ComboMultiple_")!=FALSE)
					    ${substr($PCO_NombresParametros[$i], strlen("PCO_ComboMultiple_"))}=$PCO_ValoresParametros[$i];
                }
            // Agrega ademas las variables de sesion
            if (!empty($_SESSION)) extract($_SESSION);
        }

    // Inicia las conexiones con la BD y las deja listas para las operaciones
    include_once '../core/conexiones.php';

    // Incluye definiciones comunes de la base de datos
    include_once '../inc/practico/def_basedatos.php';

    // Incluye archivo con algunas funciones comunes usadas por la herramienta
    include_once '../core/comunes.php';
?><!DOCTYPE html>
<html lang="<?php echo $IdiomaPredeterminado; ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="generator" content="Practico <?php  $PCO_VersionActual = file("inc/version_actual.txt"); $PCO_VersionActual = trim($PCO_VersionActual[0]); echo $PCO_VersionActual; ?>" />
	<meta name="description" content="Generador de aplicaciones web - www.practico.org" />
    <meta name="author" content="John Arroyave G. - {www.practico.org} - {unix4you2 at gmail.com}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">

	<title><?php echo $NombreRAD; ?> <?php echo $Version_Aplicacion; ?></title>

    <link href="../inc/bootstrap/css/tema_bootstrap.min.css" rel="stylesheet" id="tema-base-bootstrap" media="screen">
    <link href="../inc/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet"  media="screen">

    <!-- CSS Plugins BootStrap -->
    <link href="../inc/bootstrap/css/plugins/toggle/bootstrap-toggle.css" rel="stylesheet">

    <link href="../inc/bootstrap/css/practico.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../inc/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<script language="JavaScript">
		function PCO_VentanaPopup(theURL,winName,features)
			{ 
				window.open(theURL,winName,features);
			}
        function PCO_AgregarElementoDiv(marco,elemento)
            {
                //carga dinamicamente objetos html a marcos
                var capa = document.getElementById(marco);
                var zona = document.createElement("NuevoElemento");
                zona.innerHTML = elemento;
                capa.appendChild(zona);
            }
	</script>

    <!-- jQuery -->
	<script type="text/javascript" src="../inc/jquery/jquery/jquery-3.6.1.min.js"></script>
	<script type="text/javascript" src="../inc/jquery/migrate/jquery-migrate-3.4.0.min.js"></script> <!-- sin min y desde /migrate-devel/ para desarrollo -->

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="../inc/bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../inc/bootstrap/js/plugins/toggle/bootstrap-toggle.min.js"></script>
</head>

<body oncontextmenu="return false;"  style="background-color: #565668;">
        <!-- CONTENIDO DE APLICACION   -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
<!-- ############################################################################################## -->
<!-- ############################################################################################## -->


    <?php
        //Obtiene todos los parametros de aplicacion
        $ParametrosAplicacion=PCO_EjecutarSQL("SELECT * FROM core_parametros WHERE 1=1 ORDER BY id LIMIT 0,1")->fetch();
    ?>

<br>
<div class="alert alert-warning" align=center>
    <font size=6><b>API <?php echo $ParametrosAplicacion["nombre_aplicacion"]; ?> </b> <font size=3><i>ver. <?php echo $ParametrosAplicacion["version"]; ?></font></i></font><br>
    <font size=2><i>Tecnolog&iacute;a de servicios web basada en <i class="fa fa-rocket fa-fw"></i> <a href="https://www.practico.org" target="_blank"><b>Pr&aacute;ctico Framework</b></a></i></font>
</div>


<?php
    $TotalMetodos=PCO_EjecutarSQL("SELECT COUNT(*) FROM core_llaves_metodo WHERE 1=1")->fetchColumn();
    
    //Presenta total de servicios publicados
        echo '<div align=center class="" style="font-size:18px; color:white; margin-left:40px; margin-right:40px; margin-bottom:15px;">';
        if ($TotalMetodos==0)
            echo '<i class="fa fa-info-circle fa-fw fa-1x"></i>  <b>No se han encontrado Endpoints y/o Servicios publicados en este sistema</b>';
        else
            echo '<i class="fa fa-info-circle fa-fw"></i>  Total Endpoints y/o Servicios publicados en este sistema: <div class="btn btn-success"><b>'.$TotalMetodos.'</b></div>';
        echo '</div>';

    $ResultadoServicios=PCO_EjecutarSQL("SELECT * FROM core_llaves_metodo WHERE 1=1 ORDER BY nombre");
    while ($RegistroServicios=$ResultadoServicios->fetch())
        {
            $IdMetodo=$RegistroServicios["id"];
            $EstiloTipoEjecucion="warning";
            if ($RegistroServicios["tipo_ejecucion"]=="LIBRE") $EstiloTipoEjecucion="warning";
            if ($RegistroServicios["tipo_ejecucion"]=="GET") $EstiloTipoEjecucion="success";
            if ($RegistroServicios["tipo_ejecucion"]=="POST") $EstiloTipoEjecucion="primary";
            if ($RegistroServicios["tipo_ejecucion"]=="PUT") $EstiloTipoEjecucion="default";
            if ($RegistroServicios["tipo_ejecucion"]=="DELETE") $EstiloTipoEjecucion="danger";
            if ($RegistroServicios["tipo_ejecucion"]=="PATCH") $EstiloTipoEjecucion="info";

            echo '
                <div class="alert alert-info" role="alert">
                <details>
                    <summary>
                        <div class="row">
                            <div class="col col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="btn btn-sm btn-'.$EstiloTipoEjecucion.'">'.$RegistroServicios["tipo_ejecucion"].'</div>
                                &nbsp;&nbsp;&nbsp;<font color=black size=4><b>'.$RegistroServicios["nombre"].'</b></font>
                            </div>
                            <div class="col col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                <div class="pull-right">
                                    <span class="btn badge"><font size=2>Salida: <font color="yellow"><b>'.$RegistroServicios["formato"].'</b></font></font></span>
                                </div>
                            </div>
                        </div>
                    </summary>
                    
                    <div class="well well-sm" style="margin-left:40px; margin-top:15px;">
                        <div class=""><i class="fa fa-book fa-fw"></i> <i>'.$RegistroServicios["descripcion"].'</i></div>
                        <div class=""><i class="fa fa-send fa-fw"></i> M&eacute;todo de recepci&oacute;n: <i><b>'.$RegistroServicios["metodo_recepcion"].'</b></i></div>
                    </div>';

                    //Presenta ejemplo de salida solo si se tiene definida
                    if (trim($RegistroServicios["ejemplo_salida"])!="")
                    echo '
                        <div class="well well-sm" style="margin-left:40px; margin-top:15px;">
                            <i class="fa fa-desktop fa-fw"></i>  <b>Ejemplo de salida:</b>
                            <pre style="border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px; height:200px;">'.$RegistroServicios["ejemplo_salida"].'</pre>
                        </div>';
    
                        //Busca posibles parametros
                        $ResultadoParametros=PCO_EjecutarSQL("SELECT * FROM core_llaves_metodoparametro WHERE metodo='{$IdMetodo}' ORDER BY nombre ");
                        $RegistroParametros=$ResultadoParametros->fetch();
                        //Presenta lista de parametros solo si aplica
                        if ($RegistroParametros["id"]!="")
                            {
                                echo '<div class="well well-sm" style="margin-left:40px; margin-top:15px;">
                                <font color=darkred><i class="fa fa-puzzle-piece fa-fw"></i>  <b>Par&aacute;metros requeridos:</b></font>
                                ';
            
                                echo '
                                    <div class="table-responsive">
                                    <table width="100%" class="table table-striped">
                                        <thead>
                                        <tr>
                                            <td><b>Parametro</b></td>
                                            <td><b>Tipo</b></td>
                                            <td><b>Longitud</b></td>
                                            <td><b>Obligatorio</b></td>
                                            <td><b>Descripcion</b></td>
                                            <td><b>Observaciones</b></td>
                                            <td><b>Ejemplo</b></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                    ';
            
                                    do
                                        {
                                            $EstiloObligatorio="default";
                                            if ($RegistroParametros["obligatorio"]=="S") $EstiloObligatorio="danger";
                                            echo '
                                                <tr style="font-size:11px;">
                                                    <td style="color:navy;"><b>'.$RegistroParametros["nombre"].'</b></td>
                                                    <td>'.$RegistroParametros["tipo_dato"].'</td>
                                                    <td>'.$RegistroParametros["longitud"].'</td>
                                                    <td><div class="btn btn-'.$EstiloObligatorio.' btn-xs">'.$RegistroParametros["obligatorio"].'</div></td>
                                                    <td>'.$RegistroParametros["descripcion"].'</td>
                                                    <td>'.$RegistroParametros["observaciones"].'</td>
                                                    <td>'.$RegistroParametros["ejemplo_entrada"].'</td>
                                                </tr>';
                                        }
                                    while ($RegistroParametros=$ResultadoParametros->fetch());
                                    
                                echo '
                                        </tbody>
                                    </table>
                                    </div>';
                                echo '</div>';
                            }

                    //Presenta ejemplo de URL de llamado
                    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
                         $URLBaseSistema = "https://";
                    else
                         $URLBaseSistema = "http://";
                    $URLBaseSistema.= $_SERVER['HTTP_HOST'];
                    $URLBaseSistema.= $_SERVER['REQUEST_URI'];
                    $URLBaseSistema = explode("/core/",$URLBaseSistema);
                    $URLBaseSistema = $URLBaseSistema[0]."/?PCO_WSOn=1&PCO_WSKey=XXXXXXXX&PCO_WSSecret=YYYYYYY&PCO_WSId=".$RegistroServicios["nombre"];

                    echo '
                        <div class="well well-sm" style="margin-left:40px; margin-top:15px;">
                            <i class="fa fa-globe fa-fw"></i>  <b>Ejemplo URL de llamado:</b> <font size=1><i>(complete con sus par&aacute;metros cuando aplique)</i></font>
                            <br><font size=1><a href="'.$URLBaseSistema.'" target="_blank">'.$URLBaseSistema.'</a></font>
                        </div>';

            //Cierra el div asociado al Endpoint
            echo '
                </details>
                </div>';
            $TotalMetodos++;
        }

?>


<!-- ############################################################################################## -->
<!-- ############################################################################################## -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

</body>
</html>