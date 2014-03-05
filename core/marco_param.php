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
		Title: Seccion Proveedores OAuth
		Ubicacion *[/core/marco_oauth.php]*.  Archivo con los proveedores definidos para OAuth

	Ver tambien:
		<Seccion superior> | <Articulador>
	*/

	//Valida que quien llame este marco tenga permisos suficientes
	if (@$Login_usuario!="admin" || !$Sesion_abierta)
		die();


/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_params
	Guarda los parametros de funcionamiento de la aplicacion

	Salida:
		Registro de parametros actualizado en tablas core
*/
	if ($accion=="guardar_params")
		{
			$mensaje_error="";
			if ($nombre_empresa_corto=="" || $nombre_aplicacion=="" || $version=="") $mensaje_error.=$MULTILANG_ErrorDatos.'<br>';

			if ($mensaje_error=="")
				{
					ejecutar_sql_unaria("UPDATE ".$TablasCore."parametros SET nombre_empresa_corto=?,nombre_aplicacion=?,version=?,funciones_personalizadas=? ","$nombre_empresa_corto||$nombre_aplicacion||$version||$funciones_personalizadas");
					auditar("Actualiza parametros de aplicacion");
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
		<div id='BarraFlotanteParametros' class="FormularioPopUps">
			<?php
				abrir_ventana($NombreRAD.' - '.$MULTILANG_ParametrosApp,'#f2f2f2',''); 

				//Consulta parametros de la aplicacion
				$resultado=ejecutar_sql("SELECT id,$ListaCamposSinID_parametros from ".$TablasCore."parametros ");
				$parametros = $resultado->fetch();

			?>

					<form name="configparams" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
					<input type="hidden" name="accion" value="guardar_params">


					<font size=2 color=black><br><b>
						[<?php echo $MULTILANG_ParametrosApp; ?>]</b>
					</font>
					<table cellspacing=2 width="700">
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									<?php echo $MULTILANG_ParamNombreEmpresa; ?>
								</font>
							</td>
							<td valign=top>
								<font size=2 color=black>
								<input type="text" name="nombre_empresa_corto" size="50" class="CampoTexto" value="<?php echo $parametros["nombre_empresa_corto"]; ?>">
								<a href="#" title="<?php echo $MULTILANG_AyudaTitNomEmp; ?>" name="<?php echo $MULTILANG_AyudaDesNomEmp; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
								</font>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									<?php echo $MULTILANG_ParamNombreApp; ?>
								</font>
							</td>
							<td valign=top>
								<font size=2 color=black>
								<input type="text" name="nombre_aplicacion" size="50" class="CampoTexto" value="<?php echo $parametros["nombre_aplicacion"]; ?>">
								<a href="#" title="<?php echo $MULTILANG_AyudaTitNomApp; ?>" name="<?php echo $MULTILANG_AyudaDesNomApp; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
								</font>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									<?php echo $MULTILANG_ParamVersionApp; ?>
								</font>
							</td>
							<td valign=top>
								<font size=2 color=black>
								<input type="text" name="version" size="10" class="CampoTexto" value="<?php echo $parametros["version"]; ?>">
								</font>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<font size=2 color=black>
									<?php echo $MULTILANG_Funciones; ?>
								</font>
							</td>
							<td valign=top>
								<font size=2 color=black>
								<textarea name="funciones_personalizadas" cols="50" rows="5" class="AreaTexto" onkeypress="return FiltrarTeclas(this, event)"><?php echo $parametros["funciones_personalizadas"]; ?></textarea>
								<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_FuncionesDes; ?>"><img src="img/icn_10.gif" border=0 align=absmiddle></a>
								</font>
							</td>
						</tr>
					</table>

					</form>


			<?php
			abrir_barra_estado();
				echo '<input type="Button"  class="BotonesEstadoCuidado" value=" <<< '.$MULTILANG_IrEscritorio.' " onClick="OcultarPopUp(\'BarraFlotanteParametros\')">';
				echo '<input type="Button"  class="BotonesEstado" value=" '.$MULTILANG_Guardar.' >>> " onClick="document.forms.configparams.submit();">';
			cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>
