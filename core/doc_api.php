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
    <link href="../inc/fortawesome/font-awesome/css/fontawesome.min.css" rel="stylesheet" type="text/css">
    <link href="../inc/fortawesome/font-awesome/css/brands.min.css" rel="stylesheet" type="text/css">
    <link href="../inc/fortawesome/font-awesome/css/solid.min.css" rel="stylesheet" type="text/css">
    <link href="../inc/fortawesome/font-awesome/css/v4-shims.min.css" rel="stylesheet" type="text/css"> <!-- Compatibilidad v4.7 -->

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
            echo '<i class="fa fa-info-circle fa-fw"></i>  Total Endpoints y/o Servicios publicados: <div class="btn btn-success"><b>'.$TotalMetodos.'</b></div>';
        echo '</div>';
        
        //Determina si recibio APIKey y APISecret de pruebas y son validas, sino las borra
        $MensajeVerificacionAPI=">";
        if ($APIKeyUsuario!="" && $APISecretUsuario!="")
            {
                $MensajeVerificacionAPI="";
                $ResultadoConsultaAPI=PCO_EjecutarSQL("SELECT * FROM core_llaves_api WHERE llave=? AND secreto=? ","$APIKeyUsuario$_SeparadorCampos_$APISecretUsuario")->fetch();
                if ($ResultadoConsultaAPI["id"]=="")
                    {
                        $APIKeyUsuario="";
                        $APISecretUsuario="";
                        $MensajeVerificacionAPI="<font color=red><b>Las llaves suministradas no son v&aacute;lidas.  Verifique e intente nuevamente</b></font><br>";
                    }
            }

        //Agrega campos para pruebas directas de la API
        echo '
            <form name="CargarLlaves" id="CargarLlaves" target="_self" method="POST">
                <div class="well alert alert-primary" role="alert alert-dimisible">
                    <div class="row">
                        <div class="col col-xs-12 col-sm-12 col-md-1 col-lg-1">
                            <i class="fa fa-key fa-fw fa-3x"></i> 
                        </div>
                        <div class="col col-xs-12 col-sm-12 col-md-11 col-lg-11">
                            <i class="fa fa-info-circle fa-fw"></i> Si usted cuenta con llaves de acceso puede ingresarlas aqu&iacute; y se activar&aacute;n campos adicionales en cada servicio para que pueda probarlo en linea.<br> 
                            '.$MensajeVerificacionAPI.'
                            <font color=green><b>API Key = <input type="text" name="APIKeyUsuario" value="'.$APIKeyUsuario.'"> &nbsp;&nbsp;API Secret = <input type="text" name="APISecretUsuario" value="'.$APISecretUsuario.'"></font> &nbsp;<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-rocket fa-fw"></i> Recargar usando estas llaves</button></b>
                        </div>
                    </div>
                </div>
            </form>';
        
    //Calcula ejemplo de URL de llamado
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
         $URLBaseSistema = "https://";
    else
         $URLBaseSistema = "http://";

     $URLBaseSistema = "https://";

    $URLBaseSistema.= $_SERVER['HTTP_HOST'];
    $URLBaseSistema.= $_SERVER['REQUEST_URI'];
    $URLBaseSistema = explode("/core/",$URLBaseSistema);

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

            $TextoComplementarioCabeceras="";
            if (trim($RegistroServicios["formato_respuesta"])!="")
                $TextoComplementarioCabeceras='<i style="font-size:10px; color:black;">(MIME Content-Type: '.$RegistroServicios["formato_respuesta"].')</i>';


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
                                    <span class="btn badge"><font size=2>Salida: <font color="yellow"><b>'.$RegistroServicios["formato"].'</b> </font></font> '.$TextoComplementarioCabeceras.' </span>
                                </div>
                            </div>
                        </div>
                    </summary>';



            //Abre formulario de pruebas si hay llaves validas
            if ($MensajeVerificacionAPI=="")
                echo '<form target="_blank" action="'.$URLBaseSistema[0].'">
                        <input type="hidden" name="PCO_WSOn" value="1">
                        <input type="hidden" name="PCO_WSKey" value="'.$APIKeyUsuario.'">
                        <input type="hidden" name="PCO_WSSecret" value="'.$APISecretUsuario.'">
                        <input type="hidden" name="PCO_WSId" value="'.$RegistroServicios["nombre"].'">
                ';
                    
            echo '        
                    <div class="well well-sm" style="margin-left:40px; margin-top:15px;">
                        <div class=""><i class="fa fa-book fa-fw"></i> <i>'.$RegistroServicios["descripcion"].'</i></div>
                        <div class=""><i class="fa fa-send fa-fw"></i> M&eacute;todo de recepci&oacute;n: <i><b>'.$RegistroServicios["metodo_recepcion"].'</b></i></div>
                    </div>';

                    //Presenta ejemplo de salida solo si se tiene definida
                    if (trim($RegistroServicios["ejemplo_salida"])!="")
                    echo '
                        <div class="well well-sm" style="margin-left:40px; margin-top:15px;">
                            <i class="fa fa-desktop fa-fw"></i>  <b>Ejemplo de salida:</b><br>
                            <textarea class="form-control" readonly style="width:70%; margin-left: 22px; margin-right: 80px; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px; height:150px;">'.$RegistroServicios["ejemplo_salida"].'</textarea>
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
                                                    <td style="color:navy;" nowrap><b>'.$RegistroParametros["nombre"].'</b>';
                                                    
                                                    //Si las llaves estan OK (sin errores) agrega campo para pruebas
                                                    if ($MensajeVerificacionAPI=="")
                                                        echo '<br><input style="margin-left:10px;" placeholder="Valor de prueba" type="text" name="'.$RegistroParametros["nombre"].'">';
                                                    
                                            echo '
                                                    </td>
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

                    //Si cuenta con llaves activas agrega boton para lanzar prueba del servicio
                    if ($MensajeVerificacionAPI=="")
                        echo '<table style="margin-left:40px;"><tr><td><button class="btn btn-success btn-sm" type="submit"><i class="fa fa-cog fa-fw fa-spin"></i> Lanzar prueba de servicio!</button></td></tr></table>';
                                    
                    //Define valores de APIKEY y SECRET cuando no fueron recibidos
                    if ($APIKeyUsuario=="") $APIKeyUsuario="_AQUI_SU_KEY_";
                    if ($APISecretUsuario=="") $APISecretUsuario="_AQUI_SU_SECRET_";
                    
                    //CONSTRUYE LOS EJEMPLOS DE LLAMADO
                    $URLBaseSistemaEjemplo = $URLBaseSistema[0]."/index.php?PCO_WSOn=1&PCO_WSKey={$APIKeyUsuario}&PCO_WSSecret={$APISecretUsuario}&PCO_WSId=".$RegistroServicios["nombre"];

                    $Ejemplo_LLAMADO_php_cURL='
                        $curl = curl_init();
                        
                        curl_setopt_array($curl, array(
                          CURLOPT_URL => \''.$URLBaseSistema[0].'/index.php\',
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => \'\',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => \'POST\',
                          CURLOPT_POSTFIELDS => array(\'PCO_WSOn\' => \'1\',\'PCO_WSKey\' => \''.$APIKeyUsuario.'\',\'PCO_WSSecret\' => \''.$APISecretUsuario.'\',\'PCO_WSId\' => \''.$RegistroServicios["nombre"].'\'),
                        ));
                        
                        $response = curl_exec($curl);
                        
                        curl_close($curl);
                        echo $response;';
                    
                    $Ejemplo_LLAMADO_CS_HttpClient='
                        var client = new HttpClient();
                        var request = new HttpRequestMessage(HttpMethod.Post, "'.$URLBaseSistema[0].'/index.php");
                        var content = new MultipartFormDataContent();
                        content.Add(new StringContent("1"), "PCO_WSOn");
                        content.Add(new StringContent("'.$APIKeyUsuario.'"), "PCO_WSKey");
                        content.Add(new StringContent("'.$APISecretUsuario.'"), "PCO_WSSecret");
                        content.Add(new StringContent("'.$RegistroServicios["nombre"].'"), "PCO_WSId");
                        request.Content = content;
                        var response = await client.SendAsync(request);
                        response.EnsureSuccessStatusCode();
                        Console.WriteLine(await response.Content.ReadAsStringAsync());';
                    
                    $Ejemplo_LLAMADO_CS_RestSharp='
                        var options = new RestClientOptions("")
                        {
                          MaxTimeout = -1,
                        };
                        var client = new RestClient(options);
                        var request = new RestRequest("'.$URLBaseSistema[0].'/index.php", Method.Post);
                        request.AlwaysMultipartFormData = true;
                        request.AddParameter("PCO_WSOn", "1");
                        request.AddParameter("PCO_WSKey", "'.$APIKeyUsuario.'");
                        request.AddParameter("PCO_WSSecret", "'.$APISecretUsuario.'");
                        request.AddParameter("PCO_WSId", "'.$RegistroServicios["nombre"].'");
                        RestResponse response = await client.ExecuteAsync(request);
                        Console.WriteLine(response.Content);';
                    
                    $Ejemplo_LLAMADO_cURL='
                        curl --location \''.$URLBaseSistema[0].'/index.php\' \
                        --form \'PCO_WSOn="1"\' \
                        --form \'PCO_WSKey="'.$APIKeyUsuario.'"\' \
                        --form \'PCO_WSSecret="'.$APISecretUsuario.'"\' \
                        --form \'PCO_WSId="'.$RegistroServicios["nombre"].'"\'';
                    
                    $Ejemplo_LLAMADO_DartDio='
                        var data = FormData.fromMap({
                          \'PCO_WSOn\': \'1\',
                          \'PCO_WSKey\': \''.$APIKeyUsuario.'\',
                          \'PCO_WSSecret\': \''.$APISecretUsuario.'\',
                          \'PCO_WSId\': \''.$RegistroServicios["nombre"].'\'
                        });
                        
                        var dio = Dio();
                        var response = await dio.request(
                          \''.$URLBaseSistema[0].'/index.php\',
                          options: Options(
                            method: \'POST\',
                          ),
                          data: data,
                        );
                        
                        if (response.statusCode == 200) {
                          print(json.encode(response.data));
                        }
                        else {
                          print(response.statusMessage);
                        }';
                    
                    $Ejemplo_LLAMADO_DartHttp='
                        var request = http.MultipartRequest(\'POST\', Uri.parse(\''.$URLBaseSistema[0].'/index.php\'));
                        request.fields.addAll({
                          \'PCO_WSOn\': \'1\',
                          \'PCO_WSKey\': \''.$APIKeyUsuario.'\',
                          \'PCO_WSSecret\': \''.$APISecretUsuario.'\',
                          \'PCO_WSId\': \''.$RegistroServicios["nombre"].'\'
                        });

                        http.StreamedResponse response = await request.send();
                        
                        if (response.statusCode == 200) {
                          print(await response.stream.bytesToString());
                        }
                        else {
                          print(response.reasonPhrase);
                        }';
                    
                    $Ejemplo_LLAMADO_GoNative='
                        package main
                        
                        import (
                          "fmt"
                          "bytes"
                          "mime/multipart"
                          "net/http"
                          "io/ioutil"
                        )
                        
                        func main() {
                        
                          url := "'.$URLBaseSistema[0].'/index.php"
                          method := "POST"
                        
                          payload := &bytes.Buffer{}
                          writer := multipart.NewWriter(payload)
                          _ = writer.WriteField("PCO_WSOn", "1")
                          _ = writer.WriteField("PCO_WSKey", "'.$APIKeyUsuario.'")
                          _ = writer.WriteField("PCO_WSSecret", "'.$APISecretUsuario.'")
                          _ = writer.WriteField("PCO_WSId", "'.$RegistroServicios["nombre"].'")
                          err := writer.Close()
                          if err != nil {
                            fmt.Println(err)
                            return
                          }
                        
                          client := &http.Client {
                          }
                          req, err := http.NewRequest(method, url, payload)
                        
                          if err != nil {
                            fmt.Println(err)
                            return
                          }
                          req.Header.Set("Content-Type", writer.FormDataContentType())
                          res, err := client.Do(req)
                          if err != nil {
                            fmt.Println(err)
                            return
                          }
                          defer res.Body.Close()
                        
                          body, err := ioutil.ReadAll(res.Body)
                          if err != nil {
                            fmt.Println(err)
                            return
                          }
                          fmt.Println(string(body))
                        }';
                    
                    $Ejemplo_LLAMADO_JavaOkHttp='
                        OkHttpClient client = new OkHttpClient().newBuilder()
                          .build();
                        MediaType mediaType = MediaType.parse("text/plain");
                        RequestBody body = new MultipartBody.Builder().setType(MultipartBody.FORM)
                          .addFormDataPart("PCO_WSOn","1")
                          .addFormDataPart("PCO_WSKey","'.$APIKeyUsuario.'")
                          .addFormDataPart("PCO_WSSecret","'.$APISecretUsuario.'")
                          .addFormDataPart("PCO_WSId","'.$RegistroServicios["nombre"].'")
                          .build();
                        Request request = new Request.Builder()
                          .url("'.$URLBaseSistema[0].'/index.php")
                          .method("POST", body)
                          .build();
                        Response response = client.newCall(request).execute();';
                    
                    $Ejemplo_LLAMADO_JavaUnirest='
                        Unirest.setTimeouts(0, 0);
                        HttpResponse<String> response = Unirest.post("'.$URLBaseSistema[0].'/index.php")
                          .multiPartContent()
                          .field("PCO_WSOn", "1")
                          .field("PCO_WSKey", "'.$APIKeyUsuario.'")
                          .field("PCO_WSSecret", "'.$APISecretUsuario.'")
                          .field("PCO_WSId", "'.$RegistroServicios["nombre"].'")
                          .asString();';
                    
                    $Ejemplo_LLAMADO_JavascriptFetch='
                        var formdata = new FormData();
                        formdata.append("PCO_WSOn", "1");
                        formdata.append("PCO_WSKey", "'.$APIKeyUsuario.'");
                        formdata.append("PCO_WSSecret", "'.$APISecretUsuario.'");
                        formdata.append("PCO_WSId", "'.$RegistroServicios["nombre"].'");
                        
                        var requestOptions = {
                          method: \'POST\',
                          body: formdata,
                          redirect: \'follow\'
                        };
                        
                        fetch("'.$URLBaseSistema[0].'/index.php", requestOptions)
                          .then(response => response.text())
                          .then(result => console.log(result))
                          .catch(error => console.log(\'error\', error));';
                    
                    $Ejemplo_LLAMADO_JavascriptJQuery='
                        var form = new FormData();
                        form.append("PCO_WSOn", "1");
                        form.append("PCO_WSKey", "'.$APIKeyUsuario.'");
                        form.append("PCO_WSSecret", "'.$APISecretUsuario.'");
                        form.append("PCO_WSId", "'.$RegistroServicios["nombre"].'");
                        
                        var settings = {
                          "url": "'.$URLBaseSistema[0].'/index.php",
                          "method": "POST",
                          "timeout": 0,
                          "processData": false,
                          "mimeType": "multipart/form-data",
                          "contentType": false,
                          "data": form
                        };
                        
                        $.ajax(settings).done(function (response) {
                          console.log(response);
                        });';
                    
                    $Ejemplo_LLAMADO_JavascriptXHR='
                        // WARNING: For POST requests, body is set to null by browsers.
                        var data = new FormData();
                        data.append("PCO_WSOn", "1");
                        data.append("PCO_WSKey", "'.$APIKeyUsuario.'");
                        data.append("PCO_WSSecret", "'.$APISecretUsuario.'");
                        data.append("PCO_WSId", "'.$RegistroServicios["nombre"].'");
                        
                        var xhr = new XMLHttpRequest();
                        xhr.withCredentials = true;
                        
                        xhr.addEventListener("readystatechange", function() {
                          if(this.readyState === 4) {
                            console.log(this.responseText);
                          }
                        });
                        
                        xhr.open("POST", "'.$URLBaseSistema[0].'/index.php");
                        
                        xhr.send(data);';
                    
                    $Ejemplo_LLAMADO_KotlinOkHttp='
                        val client = OkHttpClient()
                        val mediaType = "text/plain".toMediaType()
                        val body = MultipartBody.Builder().setType(MultipartBody.FORM)
                          .addFormDataPart("PCO_WSOn","1")
                          .addFormDataPart("PCO_WSKey","'.$APIKeyUsuario.'")
                          .addFormDataPart("PCO_WSSecret","'.$APISecretUsuario.'")
                          .addFormDataPart("PCO_WSId","'.$RegistroServicios["nombre"].'")
                          .build()
                        val request = Request.Builder()
                          .url("'.$URLBaseSistema[0].'/index.php")
                          .post(body)
                          .build()
                        val response = client.newCall(request).execute()';
                    
                    $Ejemplo_LLAMADO_C_Libcurl='
                        CURL *curl;
                        CURLcode res;
                        curl = curl_easy_init();
                        if(curl) {
                          curl_easy_setopt(curl, CURLOPT_CUSTOMREQUEST, "POST");
                          curl_easy_setopt(curl, CURLOPT_URL, "'.$URLBaseSistema[0].'/index.php");
                          curl_easy_setopt(curl, CURLOPT_FOLLOWLOCATION, 1L);
                          curl_easy_setopt(curl, CURLOPT_DEFAULT_PROTOCOL, "https");
                          struct curl_slist *headers = NULL;
                          curl_easy_setopt(curl, CURLOPT_HTTPHEADER, headers);
                          curl_mime *mime;
                          curl_mimepart *part;
                          mime = curl_mime_init(curl);
                          part = curl_mime_addpart(mime);
                          curl_mime_name(part, "PCO_WSOn");
                          curl_mime_data(part, "1", CURL_ZERO_TERMINATED);
                          part = curl_mime_addpart(mime);
                          curl_mime_name(part, "PCO_WSKey");
                          curl_mime_data(part, "'.$APIKeyUsuario.'", CURL_ZERO_TERMINATED);
                          part = curl_mime_addpart(mime);
                          curl_mime_name(part, "PCO_WSSecret");
                          curl_mime_data(part, "'.$APISecretUsuario.'", CURL_ZERO_TERMINATED);
                          part = curl_mime_addpart(mime);
                          curl_mime_name(part, "PCO_WSId");
                          curl_mime_data(part, "'.$RegistroServicios["nombre"].'", CURL_ZERO_TERMINATED);
                          curl_easy_setopt(curl, CURLOPT_MIMEPOST, mime);
                          res = curl_easy_perform(curl);
                          curl_mime_free(mime);
                        }
                        curl_easy_cleanup(curl);';
                    
                    $Ejemplo_LLAMADO_NodeJsAxios='
                        const axios = require(\'axios\');
                        const FormData = require(\'form-data\');
                        let data = new FormData();
                        data.append(\'PCO_WSOn\', \'1\');
                        data.append(\'PCO_WSKey\', \''.$APIKeyUsuario.'\');
                        data.append(\'PCO_WSSecret\', \''.$APISecretUsuario.'\');
                        data.append(\'PCO_WSId\', \''.$RegistroServicios["nombre"].'\');
                        
                        let config = {
                          method: \'post\',
                          maxBodyLength: Infinity,
                          url: \''.$URLBaseSistema[0].'/index.php\',
                          headers: { 
                            ...data.getHeaders()
                          },
                          data : data
                        };
                        
                        axios.request(config)
                        .then((response) => {
                          console.log(JSON.stringify(response.data));
                        })
                        .catch((error) => {
                          console.log(error);
                        });';
                    
                    $Ejemplo_LLAMADO_NodeJsRequest='
                        var request = require(\'request\');
                        var options = {
                          \'method\': \'POST\',
                          \'url\': \''.$URLBaseSistema[0].'/index.php\',
                          \'headers\': {
                          },
                          formData: {
                            \'PCO_WSOn\': \'1\',
                            \'PCO_WSKey\': \''.$APIKeyUsuario.'\',
                            \'PCO_WSSecret\': \''.$APISecretUsuario.'\',
                            \'PCO_WSId\': \''.$RegistroServicios["nombre"].'\'
                          }
                        };
                        request(options, function (error, response) {
                          if (error) throw new Error(error);
                          console.log(response.body);
                        });';
                    
                    $Ejemplo_LLAMADO_NodeJsUnirest='
                        var unirest = require(\'unirest\');
                        var req = unirest(\'POST\', \''.$URLBaseSistema[0].'/index.php\')
                          .field(\'PCO_WSOn\', \'1\')
                          .field(\'PCO_WSKey\', \''.$APIKeyUsuario.'\')
                          .field(\'PCO_WSSecret\', \''.$APISecretUsuario.'\')
                          .field(\'PCO_WSId\', \''.$RegistroServicios["nombre"].'\')
                          .end(function (res) { 
                            if (res.error) throw new Error(res.error); 
                            console.log(res.raw_body);
                          });';
                    
                    $Ejemplo_LLAMADO_php_Guzzle='
                        $client = new Client();
                        $options = [
                          \'multipart\' => [
                            [
                              \'name\' => \'PCO_WSOn\',
                              \'contents\' => \'1\'
                            ],
                            [
                              \'name\' => \'PCO_WSKey\',
                              \'contents\' => \''.$APIKeyUsuario.'\'
                            ],
                            [
                              \'name\' => \'PCO_WSSecret\',
                              \'contents\' => \''.$APISecretUsuario.'\'
                            ],
                            [
                              \'name\' => \'PCO_WSId\',
                              \'contents\' => \''.$RegistroServicios["nombre"].'\'
                            ]
                        ]];
                        $request = new Request(\'POST\', \''.$URLBaseSistema[0].'/index.php\');
                        $res = $client->sendAsync($request, $options)->wait();
                        echo $res->getBody();';
                    
                    $Ejemplo_LLAMADO_php_HTTPRequest2='
                        require_once \'HTTP/Request2.php\';
                        $request = new HTTP_Request2();
                        $request->setUrl(\''.$URLBaseSistema[0].'/index.php\');
                        $request->setMethod(HTTP_Request2::METHOD_POST);
                        $request->setConfig(array(
                          \'follow_redirects\' => TRUE
                        ));
                        $request->addPostParameter(array(
                          \'PCO_WSOn\' => \'1\',
                          \'PCO_WSKey\' => \''.$APIKeyUsuario.'\',
                          \'PCO_WSSecret\' => \''.$APISecretUsuario.'\',
                          \'PCO_WSId\' => \''.$RegistroServicios["nombre"].'\'
                        ));
                        try {
                          $response = $request->send();
                          if ($response->getStatus() == 200) {
                            echo $response->getBody();
                          }
                          else {
                            echo \'Unexpected HTTP status: \' . $response->getStatus() . \' \' .
                            $response->getReasonPhrase();
                          }
                        }
                        catch(HTTP_Request2_Exception $e) {
                          echo \'Error: \' . $e->getMessage();
                        }';
                    
                    $Ejemplo_LLAMADO_php_PeclHTTP='
                        $client = new http\Client;
                        $request = new http\Client\Request;
                        $request->setRequestUrl(\''.$URLBaseSistema[0].'/index.php\');
                        $request->setRequestMethod(\'POST\');
                        $body = new http\Message\Body;
                        $body->addForm(array(
                          \'PCO_WSOn\' => \'1\',
                          \'PCO_WSKey\' => \''.$APIKeyUsuario.'\',
                          \'PCO_WSSecret\' => \''.$APISecretUsuario.'\',
                          \'PCO_WSId\' => \''.$RegistroServicios["nombre"].'\'
                        ), array(
                        
                        ));
                        $request->setBody($body);
                        $request->setOptions(array());
                        
                        $client->enqueue($request)->send();
                        $response = $client->getResponse();
                        echo $response->getBody();';
                    
                    $Ejemplo_LLAMADO_PythonRequests='
                        import requests
                        
                        url = "'.$URLBaseSistema[0].'/index.php"
                        
                        payload = {\'PCO_WSOn\': \'1\',
                        \'PCO_WSKey\': \''.$APIKeyUsuario.'\',
                        \'PCO_WSSecret\': \''.$APISecretUsuario.'\',
                        \'PCO_WSId\': \''.$RegistroServicios["nombre"].'\'}
                        files=[
                        
                        ]
                        headers = {}
                        
                        response = requests.request("POST", url, headers=headers, data=payload, files=files)
                        
                        print(response.text)';
                    
                    $Ejemplo_LLAMADO_RHttr='
                        library(httr)
                        
                        body = list(
                          \'PCO_WSOn\' = \'1\',
                          \'PCO_WSKey\' = \''.$APIKeyUsuario.'\',
                          \'PCO_WSSecret\' = \''.$APISecretUsuario.'\',
                          \'PCO_WSId\' = \''.$RegistroServicios["nombre"].'\'
                        )
                        
                        res <- VERB("POST", url = "'.$URLBaseSistema[0].'/index.php", body = body, encode = \'multipart\')
                        
                        cat(content(res, \'text\'))';
                    
                    $Ejemplo_LLAMADO_RCurl='
                        library(RCurl)
                        params = c(
                          "PCO_WSOn" = "1",
                          "PCO_WSKey" = "'.$APIKeyUsuario.'",
                          "PCO_WSSecret" = "'.$APISecretUsuario.'",
                          "PCO_WSId" = "'.$RegistroServicios["nombre"].'"
                        )
                        res <- postForm("'.$URLBaseSistema[0].'/index.php", .params = params, .opts=list(followlocation = TRUE), style = "httppost")
                        cat(res)';
                    
                    $Ejemplo_LLAMADO_RubyNetHTTP='
                        require "uri"
                        require "net/http"
                        
                        url = URI("'.$URLBaseSistema[0].'/index.php")
                        
                        https = Net::HTTP.new(url.host, url.port)
                        https.use_ssl = true
                        
                        request = Net::HTTP::Post.new(url)
                        form_data = [[\'PCO_WSOn\', \'1\'],[\'PCO_WSKey\', \''.$APIKeyUsuario.'\'],[\'PCO_WSSecret\', \''.$APISecretUsuario.'\'],[\'PCO_WSId\', \''.$RegistroServicios["nombre"].'\']]
                        request.set_form form_data, \'multipart/form-data\'
                        response = https.request(request)
                        puts response.read_body';
                    
                    $Ejemplo_LLAMADO_RustReqwest='
                        #[tokio::main]
                        async fn main() -> Result<(), Box<dyn std::error::Error>> {
                            let client = reqwest::Client::builder()
                                .build()?;
                        
                            let form = reqwest::multipart::Form::new()
                                .text("PCO_WSOn", "1")
                                .text("PCO_WSKey", "'.$APIKeyUsuario.'")
                                .text("PCO_WSSecret", "'.$APISecretUsuario.'")
                                .text("PCO_WSId", "'.$RegistroServicios["nombre"].'");
                        
                            let request = client.request(reqwest::Method::POST, "'.$URLBaseSistema[0].'/index.php")
                                .multipart(form);
                        
                            let response = request.send().await?;
                            let body = response.text().await?;
                        
                            println!("{}", body);
                        
                            Ok(())';
                    
                    $Ejemplo_LLAMADO_ShellWget='
                        wget --no-check-certificate --quiet \
                          --method POST \
                          --timeout=0 \
                          --header \'\' \
                          --body-data \'PCO_WSOn=1&PCO_WSKey='.$APIKeyUsuario.'&PCO_WSSecret='.$APISecretUsuario.'&PCO_WSId='.$RegistroServicios["nombre"].'\' \
                           \''.$URLBaseSistema[0].'/index.php\'';

                    //Presenta ejemplos de llamado
                    echo '
                            <div class="well well-sm" style="margin-left:40px; margin-top:15px;">
                            <i class="fa fa-rocket fa-fw"></i>  <b>Ejemplos de llamado al servicio:</b><br>

                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">URL Directa</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Recuerde completar con sus llaves y/o par&aacute;metros extra cuando aplique.</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$URLBaseSistemaEjemplo).'</pre></div>
                            </details>

                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">C# - HttpClient</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_CS_HttpClient).'</pre></div>
                            </details>

                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">C# - RestSharp</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_CS_RestSharp).'</pre></div>
                            </details>

                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">cURL</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_cURL).'</pre></div>
                            </details>
                            
                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">Dart - dio</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_DartDio).'</pre></div>
                            </details>
                            
                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">Dart - http</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_DartHttp).'</pre></div>
                            </details>
                            
                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">Go - Native</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_GoNative).'</pre></div>
                            </details>
                            
                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">Java - OkHttp</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_JavaOkHttp).'</pre></div>
                            </details>
                            
                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">Java - Unirest</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_JavaUnirest).'</pre></div>
                            </details>

                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">Javascript - Fetch</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_JavascriptFetch).'</pre></div>
                            </details>
                            
                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">JavaScript - JQuery</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_JavascriptJQuery).'</pre></div>
                            </details>
                            
                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">JavaScript - XHR</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_JavascriptXHR).'</pre></div>
                            </details>
                            
                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">Kotlin - Okhttp</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_KotlinOkHttp).'</pre></div>
                            </details>
                            
                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">C - Libcurl</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_C_Libcurl).'</pre></div>
                            </details>
                            
                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">NodeJS - Axios</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_NodeJsAxios).'</pre></div>
                            </details>
                            
                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">NodeJS - Request</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_NodeJsRequest).'</pre></div>
                            </details>
                            
                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">NodeJS - Unirest</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_NodeJsUnirest).'</pre></div>
                            </details>

                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">PHP - cURL</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_php_cURL).'</pre></div>
                            </details>
                            
                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">PHP - Guzzle</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_php_Guzzle).'</pre></div>
                            </details>

                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">PHP - PECL HTTP</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_php_PeclHTTP).'</pre></div>
                            </details>

                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">Python - Requests</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_PythonRequests).'</pre></div>
                            </details>

                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">R - HTTR</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_RHttr).'</pre></div>
                            </details>

                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">R - RCurl</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_RCurl).'</pre></div>
                            </details>

                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">Ruby - NetHTTP</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_RubyNetHTTP).'</pre></div>
                            </details>

                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">Rust - Reqwest</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_RustReqwest).'</pre></div>
                            </details>

                            <details style="display:inline-block !important;">
                                <summary class="btn btn-default btn-xs">Shell - wget</summary>
                                <br><i class="fa fa-info-circle fa-fw"></i>  <i> <font color=red>Debe completar con sus llaves o par&aacute;metros seg&uacute;n aplique</font></i>:
                                <div class="btn-group btn-group-justified"><pre style="text-align:left; font-size:11px; font-family: terminal,console,monospace;  border-radius:10px; background-color:#2F2F47; color:white; margin-top:5px;">'.str_replace('      ',"",$Ejemplo_LLAMADO_ShellWget).'</pre></div>
                            </details>

                        </div>
                        ';

                //Cierra formulario de pruebas cuando hay llaves activas
                if ($MensajeVerificacionAPI=="")
                    echo '</form>';

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