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
?>

<?php
	//Incluye el archivo de idioma
	if (!isset($Idioma)) $Idioma="es";
	include_once("../inc/practico/idiomas/".$Idioma.".php");
?>


<html>
	<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
<head>
	<title>
		Pr&aacute;ctico - <?php echo $MULTILANG_Instalacion; ?>
  	</title>
	<script type="text/javascript" src="js/tooltips.js"></script>
    <link rel="stylesheet" href="../inc/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../skin/nomo/general.css">
	<script language="JavaScript">
		function abrir_ventana_popup(theURL,winName,features)
			{ 
				window.open(theURL,winName,features);
			}
	</script>
</head>
<body leftmargin="0"  margin="0" topmargin="0" oncontextmenu="return false;">

<!-- INICIA LA TABLA PRINCIPAL -->
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="left">
	<!-- INICIO DEL ENCABEZADO -->
	<tr><td>
		<table width="100%" cellspacing="0" cellpadding="0" border=0 class="MarcoSuperior"><tr>
			<td valign="bottom" width="20%">
				<img src="../skin/nomo/img/logo.png" border="0"><b><font color=yellow> <?php echo $MULTILANG_Version; ?> <?php include("../inc/version_actual.txt"); ?></font></b>
			</td>
			<td align="center" valign="middle" width="60%">
				<b>
					<font color="#d4dce4"><?php echo $MULTILANG_SubtituloPractico1; ?></font> <?php echo $MULTILANG_SubtituloPractico2; ?>
			</td>
			<td align="right"  width="20%" valign="middle">
					&nbsp;&nbsp;
			</td>
		</tr></table>
		<!-- FIN DEL ENCABEZADO -->

		<table width="100%" cellspacing="0" cellpadding="0" border=0 class="MenuSuperior"><tr>
			<td valign="top">
				<?php echo $MULTILANG_InstaladorAplicacion; ?>&nbsp;&nbsp;<?php echo $MULTILANG_Usuario; ?>@<?php echo $MULTILANG_Anonimo; ?>>
			</td>
		</tr></table>
		<form method="POST" name="cerrar_sesion" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			<input type="Hidden" name="accion" value="Terminar_sesion">
		</form>
	</td></tr>
		
	<!-- INICIO  DE CONTENIDOS DE APLICACION -->
	<!-- INICIO DEL CONTENIDO CENTRAL -->
	<tr><td height="100%" valign="MIDDLE" align="center">
	<!-- INICIO DEL CONTENIDO CENTRAL -->


