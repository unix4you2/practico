<?php
	/*
	PMobile (Simulador de resoluciones para dispositivos moviles)
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

    // BLOQUE BASICO DE INCLUSION ######################################
    // Inicio de la sesion
    @session_start();

	// Agrega las variables de sesion
	if (!empty($_SESSION)) extract($_SESSION);
	
    // Recupera variables recibidas para su uso como globales (equivale a register_globals=on en php.ini)
    if (!ini_get('register_globals'))
    {
        $PCO_PBROWSER_NumeroParametros = count($_REQUEST);
        $PCO_PBROWSER_NombresParametros = array_keys($_REQUEST);// obtiene los nombres de las varibles
        $PCO_PBROWSER_ValoresParametros = array_values($_REQUEST);// obtiene los valores de las varibles
        // crea las variables y les asigna el valor
        for($i=0;$i<$PCO_PBROWSER_NumeroParametros;$i++)
            {
                ${$PCO_PBROWSER_NombresParametros[$i]}=$PCO_PBROWSER_ValoresParametros[$i];
            }
        // Agrega ademas las variables de sesion
        if (!empty($_SESSION)) extract($_SESSION);
    }


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_SimularMovil
	Presenta un telefono movil de determinado tamano para presentar paginas web simuladas en celulares

    Entradas:

        * Ancho: 		Resolucion horizontal del movil		Ej:  400	360
        * Alto:  		Resolucion vertical del movil		Ej:	 770	640
        * Orientacion:	V=Vertical|H=Horizontal
        * URL:   		Direccion a cargar dentro del iframe

	Salida:
		URL cargada en pantalla en la resolucion especificada
*/

if ($PCO_Accion=="PCOMOD_SimularMovil") 
	{
		//Si no recibe variables entonces asigna las por defecto
		if ($Ancho=="")			$Ancho=400;
		if ($Alto=="")			$Alto=770;
		if ($Orientacion=="")	$Orientacion="V";
		if ($URL=="")			$URL="https://www.practico.org";
?>
 <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
<head>
	<title>{P}Mobile</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="generator" content="PCoder <?php  echo $PCO_PCODER_VersionActual; ?>" />
 	<meta name="description" content="Simulador de dispositivos moviles basado en Practico Framework PHP" />
    <meta name="author" content="John Arroyave G. - {www.practico.org} - {unix4you2 at gmail.com}">

	<style type="text/css">
		img {
				margin:0px;
				padding: 0px;
				float: left;
				border:0px;
			}
		iframe {
				margin:0px;
				padding: 0px;
				float: left;
				border:0px;
			}
	</style>

    <!-- Custom Fonts -->
    <link href="../../inc/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
	<script type="text/javascript" src="../../inc/jquery/jquery-2.2.4.min.js"></script>
	<script>
        var currFFZoom = 1;
        var currIEZoom = 100;

        function AumentarZoom(){
            //alert('sad');
                var step = 0.02;
                currFFZoom += step;
                $('body').css('MozTransform','scale(' + currFFZoom + ')');
                var stepie = 2;
                currIEZoom += stepie;
                $('body').css('zoom', ' ' + currIEZoom + '%');

        };
        function DisminuirZoom(){
            //alert('sad');
                var step = 0.02;
                currFFZoom -= step;
                $('body').css('MozTransform','scale(' + currFFZoom + ')');
                var stepie = 2;
                currIEZoom -= stepie;
                $('body').css('zoom', ' ' + currIEZoom + '%');
        };
    </script>
</head>
<body bgcolor="#E9E9E9">
                        
	<table border=0 cellspacing=0 cellpadding=0 align=center width="<?php echo $Ancho; ?>" height="<?php echo $Alto; ?>" style="font-family: tahoma, Verdana, Arial; border-spacing: 0px;">
		<tr>
			<td colspan=3>
				<div align=right>
					<i  onclick="DisminuirZoom()" class="fa fa-search-minus fa-2x fa-fw icon-info"></i>
					<i  onclick="AumentarZoom()"  class="fa fa-search-plus  fa-2x fa-fw"></i>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
				<img src="movil_arribaV.png" width="<?php echo $Ancho+50; ?>" border=0 align="bottom" height="55" style="margin:0;">
			</td>
		</tr>
		<tr style="margin:0px; border-spacing: 0px;">
			<td height="<?php echo $Alto; ?>">
				<img src="movil_izquierdaV.png" height="<?php echo $Alto; ?>">
			</td>
			<td width="<?php echo $Ancho; ?>" height="<?php echo $Alto; ?>">
				<iframe src="<?php echo $URL; ?>" frameborder=0 height="<?php echo $Alto; ?>" marginheight=0 marginwidth=0 name="PCOMobile" scrolling="auto" width="<?php echo $Ancho; ?>"></iframe>
			</td>
			<td height="<?php echo $Alto; ?>">
				<img src="movil_derechaV.png" height="<?php echo $Alto; ?>">
			</td>
		</tr>
		<tr style="margin:0px; border-spacing: 0px;">
			<td colspan=3>
				<img src="movil_abajoV.png" width="<?php echo $Ancho+50; ?>" border=0 align="bottom" height="55">
			</td>
		</tr>
		<tr>
			<td align=center colspan=3><font size=1><i><a href="http://practico.org" target="_BLANK" style="text-decoration:none;">Copyright PMobile - 2016</a></i></font></td>
		</tr>
	</table>

</body>
</html>
<?php
	} // Fin $PCO_Accion=="PCOMOD_SimularMovil"