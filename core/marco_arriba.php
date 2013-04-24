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
			abrir_ventana('Pr&aacute;ctico - Primeros pasos','#000000','600'); 
			?>
				<table width="100%" cellspacing=0 cellpadding=0 background="skin/nomo/img/fondo_ventanas1.png"><tr><td>
					<br>
					
					<div align=center>
					<font color=yellow face="Tahoma,Verdana,Arial">
						<font size=5>
							Dise&ntilde;ar la aplicaci&oacute;n, <b>es simple y r&aacute;pido:</b>
						</font>
						<hr>
						<table width="100%" cellspacing=2 cellpadding=5 style="color:#FFFFFF; font-size:14px;"><tr>
							<td><img src="img/1.png" border=0></td>
							<td align=left valign=top>
								Defina las tablas para su <u><b><font color="#FFF022">BASE DE DATOS</font></b></u>
								<br><font color=lightgray size=1>Las tablas son aquellas estructuras en las que ser&aacute; almacenada la informaci&oacute;n que sus usuarios diligencien por medio de formularios asociados a &eacute;stas.</font>
							</td>
							<td>
								<form action="" method="post" name="wzd_1" id="wzd_1" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
									<input type="hidden" name="accion" value="administrar_tablas">
								</form>
								<table class="EstiloBotones"><tr><td width="30" height="30" align=center>
									<img src="img/icono_tabla.png" onClick="document.wzd_1.submit();" width="20" height="20">
								</tr></td></table>
							</td>
						</tr>
						<tr><td colspan="3"><hr></td></tr>
						<tr>
							<td><img src="img/2.png" border=0></td>
							<td align=left valign=top >
								Cree sus <u><b><font color="#FFF022">FORMULARIOS</font></b></u> para ingreso y consulta de informaci&oacute;n
								<br><font color=lightgray size=1>Permiten al usuario ingresar informaci&oacute;n de acuerdo a ciertas validaciones o formatos, consultar registros o incluso eliminarlos. Permiten tambi&eacute;n desplegar otros elementos como p&aacute;ginas externas o informes predise&ntilde;ados.</font>
							</td>
							<td>
								<form action="" method="post" name="wzd_2" id="wzd_2" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
									<input type="hidden" name="accion" value="administrar_formularios">
								</form>
								<table class="EstiloBotones"><tr><td width="30" height="30" align=center>
									<img src="img/icono_form.png" onClick="document.wzd_2.submit();" width="20" height="20">
								</tr></td></table>
							</td>
						</tr>
						<tr><td colspan="3"><hr></td></tr>
						<tr>
							<td><img src="img/3.png" border=0></td>
							<td align=left valign=top >
								Genere sus <u><b><font color="#FFF022">INFORMES</font></b></u> (tablas o gr&aacute;ficos)
								<br><font color=lightgray size=1>Presentan la informaci&oacute;n existente dentro de las tablas a los usuarios, bajo diferentes formatos y filtros definidos.  Se pueden crear informes tabulares o de tipo gr&aacute;fico y adem&aacute;s posteriormente ser embebidos en otros espacios.</font>
							</td>
							<td>
								<form action="" method="post" name="wzd_3" id="wzd_3" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
									<input type="hidden" name="accion" value="administrar_informes">
								</form>
								<table class="EstiloBotones"><tr><td width="30" height="30" align=center>
									<img src="img/compfile.png" onClick="document.wzd_3.submit();" width="20" height="20">
								</tr></td></table>
							</td>
						</tr>
						<tr><td colspan="3"><hr></td></tr>
						<tr>
							<td><img src="img/4.png" border=0></td>
							<td align=left valign=top >
								Administre las <u><b><font color="#FFF022">OPCIONES DE MENU</font></b></u> para los usuarios
								<br><font color=lightgray size=1>Enlaza objetos dise&ntilde;ados como formularios o informes con iconos gr&aacute;ficos y descripciones textuales que pueden ser seleccionadas por un usuario que posea ese permiso.  Tambi&eacute;n permite vincular funciones externas o ejecuci&oacute;n de comandos personalizados.</font>
							</td>
							<td>
								<form action="" method="post" name="wzd_4" id="wzd_4" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
									<input type="hidden" name="accion" value="administrar_menu">
								</form>
								<table class="EstiloBotones"><tr><td width="30" height="30" align=center>
									<img src="img/icono_menus.png" onClick="document.wzd_4.submit();" width="20" height="20">
								</tr></td></table>
							</td>
						</tr>
						<tr><td colspan="3"><hr></td></tr>
						<tr>
							<td><img src="img/5.png" border=0></td>
							<td align=left valign=top >
								Defina <u><b><font color="#FFF022">USUARIOS Y PERMISOS</font></b></u> para acceder a su aplicaci&oacute;n
								<br><font color=lightgray size=1>Establece las credenciales de acceso para cada usuario, as&iacute; como los permisos con que cuenta cada uno para accesar formularios, informes o cualquier opcion de menu previamente definida.</font>
							</td>
							<td>
								<form action="" method="post" name="wzd_5" id="wzd_5" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
									<input type="hidden" name="accion" value="listar_usuarios">
								</form>
								<table class="EstiloBotones"><tr><td width="30" height="30" align=center>
									<img src="img/icono_usuarios.png" onClick="document.wzd_5.submit();" width="20" height="20">
								</tr></td></table>
							</td>
						</tr></table>

					</font>
					</div>
				</td></tr></table> <!-- cierra tabla para el fondo -->
			<?php
			abrir_barra_estado();
				echo '<input type="Button"  class="BotonesEstadoCuidado" value=" <<< Volver al escritorio " onClick="OcultarPopUp(\'BarraFlotanteDesarrollo\')">';
			cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>


		<!-- INICIO DE MARCOS POPUP -->
		<div id='BarraFlotanteConfiguracion' class="FormularioPopUps">
			<?php
			abrir_ventana('Pr&aacute;ctico - Configuracion de la plataforma','#f2f2f2','600'); 
			?>
				<DIV style="DISPLAY: block; OVERFLOW: auto; WIDTH: 100%; POSITION: relative;">

					<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
					<input type="hidden" name="accion" value="guardar_configuracion">
					<font size=2 color=black><br><b>
						[Motor de Base de Datos]</b>
					</font>
					<table cellspacing=2 width="700">
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									Tipo de motor
								</font>
							</td>
							<td valign=top width="380">
								<select name="MotorBDNEW" class="Combos" >
									<option value="mysql"	 <?php if ($MotorBD=="mysql") echo "SELECTED"; ?> >MySQL - MariaDB (3.x/4.x/5.x)</option>
									<option value="pgsql"	 <?php if ($MotorBD=="pgsql") echo "SELECTED"; ?> >PostgreSQL</option>
									<option value="sqlite"	 <?php if ($MotorBD=="sqlite") echo "SELECTED"; ?> >SQLite v2 - SQLite v3</option>
									<option value="sqlsrv"	 <?php if ($MotorBD=="sqlsrv") echo "SELECTED"; ?> >FreeTDS/Microsoft SQL Server: Win32 [max version 2008]</option>
									<option value="mssql"	 <?php if ($MotorBD=="mssql") echo "SELECTED"; ?> >FreeTDS/Microsoft SQL Server: Win32&Linux, [max version 2000]</option>
									<option value="ibm"		 <?php if ($MotorBD=="ibm") echo "SELECTED"; ?> >IBM (DB2)</option>
									<option value="dblib"	 <?php if ($MotorBD=="dblib") echo "SELECTED"; ?> >DBLIB</option>
									<option value="odbc"	 <?php if ($MotorBD=="odbc") echo "SELECTED"; ?> >Microsoft Access (ODBC v3: IBM DB2, unixODBC, Win32 ODBC)</option>
									<option value="oracle"	 <?php if ($MotorBD=="oracle") echo "SELECTED"; ?> >ORACLE (OCI Oracle Call Interface)</option>
									<option value="ifmx"	 <?php if ($MotorBD=="ifmx") echo "SELECTED"; ?> >Informix (IBM Informix Dynamic Server)</option>
									<option value="fbd"		 <?php if ($MotorBD=="fbd") echo "SELECTED"; ?> >Firebird (Firebird/Interbase 6)</option>
								</select>
								<a href="#" title="MySQL y MariaDB" name="Son los motores oficiales.  Sobre ellos se hace el desarrollo y pruebas de la herramienta y aunque gracias a PDO usted podr&aacute; utilizar la herramienta en otros motores es probable que deba hacer ajustes a operaciones espec&iacute;ficas de &eacute;stos."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									Host/Servidor
								</font>
							</td>
							<td valign=top>
								<font size=2 color=black>
								<input type="text" name="ServidorNEW"  value="<?php echo $ServidorBD; ?>" size="20" class="CampoTexto" class="keyboardInput">
								Puerto: <input type="text"  value="<?php echo $PuertoBD; ?>" name="PuertoBDNEW" size="4" class="CampoTexto" class="keyboardInput"> (si no es el predeterminado)
								</font>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									Base de datos
								</font>
							</td>
							<td valign=top>
								<font size=2 color=black>
								<input type="text" name="BaseDatosNEW"  value="<?php echo $BaseDatos; ?>" size="20" class="CampoTexto" class="keyboardInput"> (debe existir)
								</font>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									Usuario
								</font>
							</td>
							<td valign=top>
								<input type="text" name="UsuarioBDNEW"  value="<?php echo $UsuarioBD; ?>" size="20" class="CampoTexto" class="keyboardInput">
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									Contrase&ntilde;a
								</font>
							</td>
							<td valign=top>
								<input type="password" name="PasswordBDNEW"  value="<?php echo $PasswordBD; ?>" size="20" class="CampoTexto" class="keyboardInput">
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									Prefijo tablas internas de Pr&aacute;ctico
								</font>
							</td>
							<td valign=top>
								<input type="text" name="TablasCoreNEW" size="7"  value="<?php echo $TablasCore; ?>" value="Core_" class="CampoTexto" class="keyboardInput">
								<a href="#" title="Se recomienda NO vac&iacute;o" name=""><img src="img/icn_12.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									Prefijo tablas de Aplicaci&oacute;n
								</font>
							</td>
							<td valign=top>
								<input type="text" name="TablasAppNEW" size="7"  value="<?php echo $TablasApp; ?>" value="App_" class="CampoTexto" class="keyboardInput">
								<a href="#" title="Importante" name="El prefijo utilizado para las tablas de aplicaci&oacute;n puede ser utilizado para separar diferentes instalaciones de Pr&aacute;ctico sobre una misma base de datos o tambi&eacute;n puede ser dejado vac&iacute;o para enlazar/integrar a Pr&aacute;ctico con otras aplicaciones pre-existentes."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									Llave de paso
								</font>
							</td>
							<td valign=top>
								<font size=2 color=black>
									<input type="text" name="LlaveDePasoNEW" size="12" value="<?php echo $LlaveDePaso; ?>" class="CampoTexto" class="keyboardInput">
									(valor para firmar cuentas de usuario)
								</font>
							</td>
						</tr>
					</table>

					<hr>
					<font size=2 color=black><br><b>
						[Configuraci&oacute;n de opciones varias]</b>
					</font>
					<table cellspacing=2 width="700">
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									Zona horaria
								</font>
							</td>
							<td valign=top width="380">
								<select  name="ZonaHorariaNEW" class="Combos">
									<?php
										$archivo_origen="inc/zonas_horarias.txt";
										$archivo = fopen($archivo_origen, "r");
										//descarta comentario inicial de archivo
										if ($archivo)
											{
												$linea = fgets($archivo, 1024);
												while (!feof($archivo))
													{
														$linea = fgets($archivo, 1024);
														if (trim($linea)==$ZonaHoraria)
															echo "<option value='".trim($linea)."' selected>".trim($linea)."</option>";
														else
															echo "<option value='".trim($linea)."'>".trim($linea)."</option>";
													}
												fclose($archivo);
											}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									N&uacute;mero de caracteres para captcha?
								</font>
							</td>
							<td valign=top width="380">
								<select name="CaracteresCaptchaNEW" class="Combos" >
									<option value="1" <?php if ($CaracteresCaptcha=="1") echo "SELECTED"; ?> >1</option>
									<option value="2" <?php if ($CaracteresCaptcha=="2") echo "SELECTED"; ?> >2</option>
									<option value="3" <?php if ($CaracteresCaptcha=="3") echo "SELECTED"; ?> >3</option>
									<option value="4" <?php if ($CaracteresCaptcha=="4") echo "SELECTED"; ?> >4</option>
									<option value="5" <?php if ($CaracteresCaptcha=="5") echo "SELECTED"; ?> >5</option>
									<option value="6" <?php if ($CaracteresCaptcha=="6") echo "SELECTED"; ?> >6</option>
								</select>
								<a href="#" title="Longitud de la palabra" name="Indica el n&uacute;mero de s&iacute;mbolos utilizados en la palabra de seguridad que deben ingresar los usuarios para cada acceso al sistema."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									Activar modo de depuraci&oacute;n?
								</font>
							</td>
							<td valign=top width="380">
								<select name="ModoDepuracionNEW" class="Combos" >
									<option value="1" <?php if ($ModoDepuracion=="1") echo "SELECTED"; ?> >Encendido</option>
									<option value="0" <?php if ($ModoDepuracion=="0") echo "SELECTED"; ?> >Apagado</option>
								</select>
								<a href="#" title="Presentar errores y advertencias" name="Para sitios en producci&oacute;n esta opci&oacute;n debe estar apagada.  Cuando se enciende ense&ntilde;a durante la ejecuci&oacute;n de la aplicaci&oacute;n todos los errores y mensajes que puedan ser generados por el preprocesador de hipertexto - PHP"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									Plantilla gr&aacute;fica activa
								</font>
							</td>
							<td valign=top width="380">
								<font size=2 color=black>
									<input type="text" name="PlantillaActivaNEW" size="12" value="<?php echo $PlantillaActiva; ?>" class="CampoTexto" class="keyboardInput">
								</font>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									Nombre RAD
								</font>
							</td>
							<td valign=top width="380">
								<font size=2 color=black>
									<input type="text" name="NombreRADNEW" size="12" value="<?php echo $NombreRAD; ?>" class="CampoTexto" class="keyboardInput">
								</font>
							</td>
						</tr>
					</table>


					<hr>
					<font size=2 color=black><br><b>
						[Motor de autenticaci&oacute;n]</b>
					</font>
					<table cellspacing=2 width="700">
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									Tipo
								</font>
							</td>
							<td valign=top>
								<select  name="Auth_TipoMotorNEW" class="Combos">
									<option value="practico" <?php if ($Auth_TipoMotor=="practico") echo "SELECTED"; ?> >Interno (Tablas propias de Pr&aacute;ctico usando MD5)</option>
									<option value="ldap" <?php if ($Auth_TipoMotor=="ldap") echo "SELECTED"; ?> >LDAP (Servidor de directorio)</option>
								</select>
								<a href="#" title="Importante" name="El uso de un motor de autenticaci&oacute;n diferente a Pr&aacute;ctico no excluye la creaci&oacute;n de los usuarios sobre la herramienta.  El motor externo servira como metodo para validar el login y clave correspondiente como un m&eacute;todo de autenticaci&oacute;n centralizado; pero el resto de caracter&iacute;sticas del perfil ser&aacute;n tomadas desde el usuario Pr&aacute;ctico.  El cambio de contrase&ntilde;a en Pr&aacute;ctico ser&aacute; deshabilitado para que sea controlada solamente por el motor externo.  El usuario admin seguir&aacute; siendo siempre aut&oacute;nomo para no perder control de acceso por errores de configuraci&oacute;n."><img src="img/icn_12.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									Algoritmo de encripci&oacute;n
								</font>
							</td>
							<td valign=top>
								<select  name="Auth_TipoEncripcionNEW" class="Combos">
									<option  <?php if ($Auth_TipoEncripcion=="plano") echo "SELECTED"; ?> value="plano">Texto plano</option>
									<option  <?php if ($Auth_TipoEncripcion=="md5") echo "SELECTED"; ?> value="md5">MD5</option>
									<option  <?php if ($Auth_TipoEncripcion=="md4") echo "SELECTED"; ?> value="md4">MD4</option>
									<option  <?php if ($Auth_TipoEncripcion=="md2") echo "SELECTED"; ?> value="md2">MD2</option>
									<option  <?php if ($Auth_TipoEncripcion=="sha1") echo "SELECTED"; ?> value="sha1">SHA 1</option>
									<option  <?php if ($Auth_TipoEncripcion=="sha256") echo "SELECTED"; ?> value="sha256">SHA 256</option>
									<option  <?php if ($Auth_TipoEncripcion=="sha384") echo "SELECTED"; ?> value="sha384">SHA 384</option>
									<option  <?php if ($Auth_TipoEncripcion=="sha512") echo "SELECTED"; ?> value="sha512">SHA 512</option>
									<option  <?php if ($Auth_TipoEncripcion=="crc32") echo "SELECTED"; ?> value="crc32">CRC 32</option>
									<option  <?php if ($Auth_TipoEncripcion=="crc32b") echo "SELECTED"; ?> value="crc32b">CRC 32B</option>
									<option  <?php if ($Auth_TipoEncripcion=="adler32") echo "SELECTED"; ?> value="adler32">Adler 32</option>
									<option  <?php if ($Auth_TipoEncripcion=="gost") echo "SELECTED"; ?> value="gost">Gost</option>
									<option  <?php if ($Auth_TipoEncripcion=="whirlpool") echo "SELECTED"; ?> value="whirlpool">Whirlpool</option>
									<option  <?php if ($Auth_TipoEncripcion=="snefru") echo "SELECTED"; ?> value="snefru">Snefru</option>
									<option  <?php if ($Auth_TipoEncripcion=="ripemd128") echo "SELECTED"; ?> value="ripemd128">Ripemd 128</option>
									<option  <?php if ($Auth_TipoEncripcion=="ripemd160") echo "SELECTED"; ?> value="ripemd160">Ripemd 160</option>
									<option  <?php if ($Auth_TipoEncripcion=="ripemd256") echo "SELECTED"; ?> value="ripemd256">Ripemd 256</option>
									<option  <?php if ($Auth_TipoEncripcion=="ripemd320") echo "SELECTED"; ?> value="ripemd320">Ripemd 320</option>
									<option  <?php if ($Auth_TipoEncripcion=="tiger128,3") echo "SELECTED"; ?> value="tiger128,3">Tiger 128,3</option>
									<option  <?php if ($Auth_TipoEncripcion=="tiger128,4") echo "SELECTED"; ?> value="tiger128,4">Tiger 128,4</option>
									<option  <?php if ($Auth_TipoEncripcion=="tiger160,3") echo "SELECTED"; ?> value="tiger160,3">Tiger 160,3</option>
									<option  <?php if ($Auth_TipoEncripcion=="tiger160,4") echo "SELECTED"; ?> value="tiger160,4">Tiger 160,4</option>
									<option  <?php if ($Auth_TipoEncripcion=="tiger192,3") echo "SELECTED"; ?> value="tiger192,3">Tiger 192,3</option>
									<option  <?php if ($Auth_TipoEncripcion=="tiger192,4") echo "SELECTED"; ?> value="tiger192,4">Tiger 192,4</option>
									<option  <?php if ($Auth_TipoEncripcion=="haval128,3") echo "SELECTED"; ?> value="haval128,3">Haval 128,3</option>
									<option  <?php if ($Auth_TipoEncripcion=="haval128,4") echo "SELECTED"; ?> value="haval128,4">Haval 128,4</option>
									<option  <?php if ($Auth_TipoEncripcion=="haval128,5") echo "SELECTED"; ?> value="haval128,5">Haval 128,5</option>
									<option  <?php if ($Auth_TipoEncripcion=="haval160,3") echo "SELECTED"; ?> value="haval160,3">Haval 160,3</option>
									<option  <?php if ($Auth_TipoEncripcion=="haval160,4") echo "SELECTED"; ?> value="haval160,4">Haval 160,4</option>
									<option  <?php if ($Auth_TipoEncripcion=="haval160,5") echo "SELECTED"; ?> value="haval160,5">Haval 160,5</option>
									<option  <?php if ($Auth_TipoEncripcion=="haval192,3") echo "SELECTED"; ?> value="haval192,3">Haval 192,3</option>
									<option  <?php if ($Auth_TipoEncripcion=="haval192,4") echo "SELECTED"; ?> value="haval192,4">Haval 192,4</option>
									<option  <?php if ($Auth_TipoEncripcion=="haval192,5") echo "SELECTED"; ?> value="haval192,5">Haval 192,5</option>
									<option  <?php if ($Auth_TipoEncripcion=="haval224,3") echo "SELECTED"; ?> value="haval224,3">Haval 224,3</option>
									<option  <?php if ($Auth_TipoEncripcion=="haval224,4") echo "SELECTED"; ?> value="haval224,4">Haval 224,4</option>
									<option  <?php if ($Auth_TipoEncripcion=="haval224,5") echo "SELECTED"; ?> value="haval224,5">Haval 224,5</option>
									<option  <?php if ($Auth_TipoEncripcion=="haval256,3") echo "SELECTED"; ?> value="haval256,3">Haval 256,3</option>
									<option  <?php if ($Auth_TipoEncripcion=="haval256,4") echo "SELECTED"; ?> value="haval256,4">Haval 256,4</option>
									<option  <?php if ($Auth_TipoEncripcion=="haval256,5") echo "SELECTED"; ?> value="haval256,5">Haval 256,5</option>
								</select>
								<a href="#" title="Tipo de encripcion de claves usado por el motor" name="Especifique el tipo de encripcion utilizado por el sistema de autenticacion que va a utilizar.  Pr&aacute;ctico encriptar&aacute; el valor de clave ingresado por el usuario antes de enviarla al motor a verificaci&oacute;n."><img src="img/icn_12.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									LDAP Servidor
								</font>
							</td>
							<td valign=top width="380">
								<input type="text" name="Auth_LDAPServidorNEW" size="20" class="CampoTexto" value="<?php echo $Auth_LDAPServidor; ?>" >
								<a href="#" title="Servidor LDAP" name="Indique la direccion IP del servidor de directorio o su nombre en caso de poder ser resuelto."><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									LDAP Puerto
								</font>
							</td>
							<td valign=top width="380">
								<input type="text" name="Auth_LDAPPuertoNEW" size="5" class="CampoTexto" value="<?php echo $Auth_LDAPPuerto; ?>" >
								<a href="#" title="Puerto de conexion" name=""><img src="img/icn_10.gif" border=0 align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									LDAP Dominio (dc=)
								</font>
							</td>
							<td valign=top width="380">
								<font size=2 color=black>
								<input type="text" name="Auth_LDAPDominioNEW" size="15" class="CampoTexto" value="<?php echo $Auth_LDAPDominio; ?>">
								<a href="#" title="Dominio utilizado por el servidor" name="Ejemplo: midominio.com.co  Con esto sera creada la cadena interna dc=midominio,dc=com,dc=co"><img src="img/icn_10.gif" border=0 align=absmiddle></a> (opcional)
								</font>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									LDAP Unidad organizacional o contexto (ou=)
								</font>
							</td>
							<td valign=top width="380">
								<font size=2 color=black>
								<input type="text" name="Auth_LDAPOUNEW" size="15" class="CampoTexto" value="<?php echo $Auth_LDAPOU; ?>">
								<a href="#" title="Contexto de conexion del usuario" name="Debe existir sobre el servidor LDAP, ej: people, ventas, mercadeo, etc"><img src="img/icn_10.gif" border=0 align=absmiddle></a> (opcional)
								</font>
							</td>
						</tr>
					</table>


					</form>
				</DIV>

			<?php
			abrir_barra_estado();
				echo '<input type="Button"  class="BotonesEstadoCuidado" value=" <<< Volver al escritorio " onClick="OcultarPopUp(\'BarraFlotanteConfiguracion\')">';
				echo '<input type="Button"  class="BotonesEstado" value=" Guardar configuraci&oacute;n >>> " onClick="document.forms.continuar.submit();">';
			cerrar_barra_estado();
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
					//Despliega botones de administracion
					if ($Login_usuario=="admin" && $Sesion_abierta)
						echo '
						<div id="marco_cluster" style="position: absolute; left: 140px; top: 0px;">
							<a href=\'javascript:AbrirPopUp("BarraFlotanteDesarrollo"); \'><img src="img/icono_admin.png" border="0"></a>
							<a href=\'javascript:AbrirPopUp("BarraFlotanteConfiguracion"); \'><img src="img/icono_config.png" border=0 algin=middle></a>
						</div>';
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
			<td align="right"  width="20%" valign="top">
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
						$resultado=ejecutar_sql("SELECT * FROM ".$TablasCore."menu ".$Complemento_tablas." WHERE posible_arriba=1 ".$Complemento_condicion);

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
