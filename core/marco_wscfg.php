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
		Title: Seccion Configuracion WebServices
		Ubicacion *[/core/marco_dev.php]*.  Archivo con las configuraciones de webservices

	Ver tambien:
		<Seccion superior> | <Articulador>
	*/

	//Valida que quien llame este marco tenga permisos suficientes
	if (@$Login_usuario!="admin" || !$Sesion_abierta)
		die();


/* ################################################################## */
/* ################################################################## */
/*
	Function: agregar_configws
	Agrega una nueva combinacion de configuraciones para un cliente de API

	Salida:
		Registro con llaves de API agregado
*/
	if ($accion=="agregar_configws")
		{
			$mensaje_error="";
			if ($nombre=="") $mensaje_error.=$MULTILANG_WSLlavesNombre.'<br>';

			if ($mensaje_error=="")
				{
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."llaves_api (".$ListaCamposSinID_llaves_api.") VALUES (?,?,?,?,?,?,?)","$nombre$_SeparadorCampos_$llave$_SeparadorCampos_$secreto$_SeparadorCampos_$uri$_SeparadorCampos_$dominio_autorizado$_SeparadorCampos_$ip_autorizada$_SeparadorCampos_$funciones_autorizadas");
					auditar("Agrega llave API para $nombre");
					echo '<script type="" language="JavaScript"> document.core_ver_menu.submit(); </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="Ver_menu">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: actualizar_llavews
	Actualiza las configuraciones para un cliente de API

	Salida:
		Registro con llaves de API actualizado
*/
	if ($accion=="actualizar_llavews")
		{
			$mensaje_error="";
			if ($mensaje_error=="")
				{
					ejecutar_sql_unaria("UPDATE ".$TablasCore."llaves_api SET uri=?,dominio_autorizado=?,ip_autorizada=?,funciones_autorizadas=? WHERE id=? ","$uri$_SeparadorCampos_$dominio_autorizado$_SeparadorCampos_$ip_autorizada$_SeparadorCampos_$funciones_autorizadas$_SeparadorCampos_$id");
					auditar("Actualiza llave API para $id");
					echo '<script type="" language="JavaScript"> document.core_ver_menu.submit(); </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="Ver_menu">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: eliminar_llavews
	Elimina las configuraciones para un cliente de API

	Salida:
		Registro con llaves de API eliminado
*/
	if ($accion=="eliminar_llavews")
		{
			$mensaje_error="";
			if ($mensaje_error=="")
				{
					ejecutar_sql_unaria("DELETE FROM ".$TablasCore."llaves_api WHERE id=? ","$id");
					auditar("Elimina llave API para $id");
					echo '<script type="" language="JavaScript"> document.core_ver_menu.submit(); </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="Ver_menu">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}



?>

		<!-- INICIO DE MARCOS POPUP -->
		<div id='ConfiguracionWebServices' class="FormularioPopUps">
			<?php
			abrir_ventana($NombreRAD.' - '.$MULTILANG_ConfiguracionGeneral,'#f2f2f2','750'); 
			?>
			
				<br><div align=center><font size=3><b><?php echo $MULTILANG_WSLlavesNuevo; ?></b></font>
				<form name="nuevallave" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
					<input type="hidden" name="accion" value="agregar_configws">
					<table class="TextosVentana" align=center>
					<tr>
						<td>
								<table class="TextosVentana">
								<tr>
									<td NOWRAP align="right"><?php echo $MULTILANG_WSLlavesNombre; ?>:</td>
									<td>
										<input type="text" name="nombre" size="20" maxlength=15 class="CampoTexto" value="<?php echo @$registro_campo_editar["titulo"]; ?>">
										<a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>" name=""><img src="img/icn_12.gif" border=0></a>
									</td>
								</tr>
								<tr>
									<td align="right"><?php echo $MULTILANG_WSLlavesLlave; ?>:</td>
									<td>
										<input type="text" name="llave" size="15" maxlength=50 class="CampoTexto" value="<?php echo TextoAleatorio(10); ?>" readonly>
									</td>
								</tr>
								<tr>
									<td align="right"><?php echo $MULTILANG_WSLlavesSecreto; ?>:</td>
									<td>
										<input type="text" name="secreto" size="15" maxlength=50 class="CampoTexto" value="<?php echo TextoAleatorio(10); ?>" readonly>
									</td>
								</tr>
								<tr>
									<td align="right"><?php echo $MULTILANG_WSLlavesURI; ?>:</td>
									<td>
										<input type="text" name="uri" size="50" maxlength=255 class="CampoTexto">
									</td>
								</tr>
								<tr>
									<td NOWRAP align="right"><?php echo $MULTILANG_WSLlavesDominio; ?>:</td>
									<td>
										<input type="text" name="dominio_autorizado" size="50" maxlength=255 class="CampoTexto">
										<a href="#" title="<?php echo $MULTILANG_WSLlavesAsterisco; ?>"><img src="img/icn_10.gif" border=0></a>
									</td>
								</tr>
								<tr>
									<td NOWRAP align="right"><?php echo $MULTILANG_WSLlavesIP; ?>:</td>
									<td>
										<input type="text" name="ip_autorizada" size="50" maxlength=255 class="CampoTexto">
										<a href="#" title="<?php echo $MULTILANG_WSLlavesAsterisco; ?>"><img src="img/icn_10.gif" border=0></a>
									</td>
								</tr>
								</table>
						</td>
						<td>
								<?php echo $MULTILANG_WSLlavesFunciones; ?>
								<a href="#" title="<?php echo $MULTILANG_WSLlavesAsterisco; ?>"><img src="img/icn_10.gif" border=0></a>:<br>
								<textarea name="funciones_autorizadas" cols=40 rows=10></textarea>
						</td>
					</tr>
					</table>
					<br>
					<?php
						abrir_barra_estado();
							echo '<input type="Button"  class="BotonesEstadoCuidado" value=" <<< '.$MULTILANG_IrEscritorio.' " onClick="OcultarPopUp(\'ConfiguracionWebServices\')">';
							echo '<input type="Button"  class="BotonesEstado" value=" '.$MULTILANG_Agregar.' >>> " onClick="document.forms.nuevallave.submit();">';
						cerrar_barra_estado();
					?>
				</form>
				</div>

			<br>
			<?php echo $MULTILANG_WSLlavesDefinidas; ?><br><?php echo $MULTILANG_WSLlavesAyuda; ?>
			<DIV style="DISPLAY: block; OVERFLOW: auto; WIDTH: 730; POSITION: relative; HEIGHT: 200px">

				<table width="100%" border="0" cellspacing="5" align="CENTER"  class="TextosVentana">
					<tr>
						<td bgcolor="#D6D6D6" NOWRAP><b><?php echo $MULTILANG_WSLlavesNombre; ?><br><?php echo $MULTILANG_WSLlavesLlave; ?><br><?php echo $MULTILANG_WSLlavesSecreto; ?></b></td>
						<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_WSLlavesURI; ?></b></td>
						<td bgcolor="#D6D6D6"><b><?php echo $MULTILANG_WSLlavesDominio; ?></b></td>
						<td bgcolor="#d6d6d6"><b><?php echo $MULTILANG_WSLlavesIP; ?></b></td>
						<td bgcolor="#D6D6D6"><b><?php echo $MULTILANG_WSLlavesFunciones; ?></b></td>
						<td></td>
						<td></td>
					</tr>

				<?php
					$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_llaves_api." FROM ".$TablasCore."llaves_api");
					while($registro = $consulta_forms->fetch())
						{
							echo '
							<form action="'.$ArchivoCORE.'" method="POST" name="dactf'.$registro["id"].'" id="dactf'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
								<input type="hidden" name="accion" value="actualizar_llavews">
								<input type="hidden" name="id" value="'.$registro["id"].'">
								<tr>
									<td><b><font color=blue>'.$registro["nombre"].'</font></b><br>'.$registro["llave"].'<br>'.$registro["secreto"].'</td>
									<td><input type="text" name="uri" value="'.$registro["uri"].'" size="13" maxlength=255 class="CampoTexto"></td>
									<td><input type="text" name="dominio_autorizado" value="'.$registro["dominio_autorizado"].'" size="13" maxlength=255 class="CampoTexto"></td>
									<td><input type="text" name="ip_autorizada" value="'.$registro["ip_autorizada"].'" size="13" maxlength=255 class="CampoTexto"></td>
									<td><textarea name="funciones_autorizadas" cols=20 rows=1>'.$registro["funciones_autorizadas"].'</textarea></td>
									<td align="center">													
								<input type="submit" value="'.$MULTILANG_Actualizar.'"  class="Botones">
							</form>
									</td>
									<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST" name="delf'.$registro["id"].'" id="delf'.$registro["id"].'">
												<input type="hidden" name="accion" value="eliminar_llavews">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="button" value="'.$MULTILANG_Eliminar.'"  class="BotonesCuidado" onClick="confirmar_evento(\''.$MULTILANG_WSLlavesBorrar.'\',delf'.$registro["id"].');">
										</form>
									</td>
								</tr>';
						}
					echo '</table>';
				?>

				</DIV>
			<?php
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>
