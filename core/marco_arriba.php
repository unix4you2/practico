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

<html>
<head>
	<title>
		<?php echo $NombreRAD; ?> <?php include("inc/version_actual.txt"); ?>
  	</title>

	<script type="text/javascript" src="js/tooltips.js"></script>
	<script type="text/javascript" src="js/validaform.js"></script>
	<script type="text/javascript" src="js/popup.js"></script>
	<script type="text/javascript" src="js/calendario.js"></script>
	<script type="text/javascript" src="js/tecladovirtual.js"></script>

	<link rel="stylesheet" type="text/css" href="skin/<?php echo $PlantillaActiva; ?>/general.css">
	<link rel="stylesheet" type="text/css" href="skin/<?php echo $PlantillaActiva; ?>/calendario.css">
	<link rel="stylesheet" type="text/css" href="skin/<?php echo $PlantillaActiva; ?>/tecladovirtual.css">

	<link rel="shortcut icon" href="skin/<?php echo $PlantillaActiva; ?>/img/favicon.ico"/>

	<script language="JavaScript">
		function abrir_ventana_popup(theURL,winName,features)
			{ 
				window.open(theURL,winName,features);
			}
	</script>
</head>
<body leftmargin="0"  margin="0" topmargin="0" oncontextmenu="return false;">
<div id='FondoPopUps' class="FondoOscuroPopUps"></div>


<?php 
	//Despliega marco de administracion a ser activado por el boton superior
	if ($Login_usuario=="admin" && $Sesion_abierta)
		{
?>
		<!-- INICIO DE MARCOS POPUP -->
		<div id='BarraFlotanteDesarrollo' class="FormularioPopUps">
			<?php
			abrir_ventana('Pr&aacute;ctico - Primeros pasos','#BDB9B9','600'); 
			?>
				<br>
				<div align=center>
				<font color=black face="Tahoma,Verdana,Arial">
					<font size=5>
						Dise&ntilde;ar la aplicaci&oacute;n, <b>es simple y r&aacute;pido:</b>
					</font>
					
					<table width="100%" cellspacing=2 cellpadding=2><tr>
						<td><img src="img/1.png" border=0></td>
						<td>
							Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos.
						</td>
					</tr></table>

					<table width="100%" cellspacing=2 cellpadding=2><tr>
						<td><img src="img/2.png" border=0></td>
						<td>
							Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos.
						</td>
					</tr></table>

					<table width="100%" cellspacing=2 cellpadding=2><tr>
						<td><img src="img/3.png" border=0></td>
						<td>
							Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos.
						</td>
					</tr></table>

					<table width="100%" cellspacing=2 cellpadding=2><tr>
						<td><img src="img/4.png" border=0></td>
						<td>
							Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos.
						</td>
					</tr></table>


					<table width="100%" cellspacing=2 cellpadding=2><tr>
						<td><img src="img/5.png" border=0></td>
						<td>
							Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos.
						</td>
					</tr></table>

					<table width="100%" cellspacing=2 cellpadding=2><tr>
						<td><img src="img/6.png" border=0></td>
						<td>
							Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos.
						</td>
					</tr></table>

					<table width="100%" cellspacing=2 cellpadding=2><tr>
						<td><img src="img/7.png" border=0></td>
						<td>
							Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos.
						</td>
					</tr></table>

					<table width="100%" cellspacing=2 cellpadding=2><tr>
						<td><img src="img/8.png" border=0></td>
						<td>
							Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos.
						</td>
					</tr></table>

					<table width="100%" cellspacing=2 cellpadding=2><tr>
						<td><img src="img/9.png" border=0></td>
						<td>
							Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos.
						</td>
					</tr></table>

				</font>
				</div>

			<?php
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>
<?php 
		} // Finsi para el marco con opciones administrativas
?>


<form action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;" name="core_ver_menu">
	<input type="Hidden" name="accion" value="Ver_menu">
</form>


<!-- INICIA LA TABLA PRINCIPAL -->
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="left">

	<!-- INICIO DEL ENCABEZADO -->
	<tr><td>
		<table width="100%" cellspacing="0" cellpadding="0" border=0 class="MarcoSuperior"><tr>
			<td valign="bottom" width="20%">
				<img src="<?php echo 'skin/'.$PlantillaActiva.'/img/logo.png'; ?>" border="0">
				<?php 
					if ($accion!="Ver_menu" && $Sesion_abierta)
						echo '<a href="javascript:document.core_ver_menu.submit();" title="Ir a mi escritorio"><img src="img/tango_user-desktop.png" width="24" height="24" border=0></a>';
				?>
				<?php 
					//Despliega boton de administracion
					if ($Login_usuario=="admin" && $Sesion_abierta)
						echo '<a href=\'javascript:AbrirPopUp("BarraFlotanteDesarrollo"); \'><img src="img/icono_admin.png" border="0"></a>';
				?>
			</td>
			<td align="center" valign="middle" width="60%">
				<b>
				<?php
					if ($Sesion_abierta)
						echo '<font color="#d4dce4">'.$Nombre_Empresa_Corto.'</font> - '.$Nombre_Aplicacion.' </b> <i> v'.$Version_Aplicacion.'</i>';
					else
						echo '<font color="#d4dce4">Generador de Aplicaciones WEB</font> Libre y multiplataforma';
				?>
			</td>
			<td align="right"  width="20%" valign="bottom">
				<?php 
					if ($Sesion_abierta) {
				?>
							<?php echo $Nombre_usuario;?>
							(<font color="#ffff00"><?php 
								for ($i=1;$i<=$Nivel_usuario;$i++)
								echo "&#9733;";
							?></font>)&nbsp;
							<br>
							<img src="<?php echo 'skin/'.$PlantillaActiva.'/img/cerrar.gif'; ?>" border="0" OnClick="cerrar_sesion.submit();" style="cursor:pointer;">&nbsp;
				<?php 
					}
				?>
			</td>
		</tr></table>
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
						$resultado=ejecutar_sql("SELECT * FROM ".$TablasCore."menu ".$Complemento_tablas." WHERE posible_arriba ".$Complemento_condicion);

						while($registro = $resultado->fetch())
							{
								// Imprime la imagen asociada si esta definida
								if ($registro["imagen"]!="") echo '<img src="img/'.$registro["imagen"].'" border=0 alt="" valign="absmiddle" align="absmiddle" width="14" height="13" >&nbsp;';
								
								// Verifica si se trata de un comando interno y crea formulario y enlace correspondiente
								if ($registro["tipo_comando"]=="Interno")
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
