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

?>

		<!-- INICIO DE MARCOS POPUP -->
		<div id='ConfiguracionWebServices' class="FormularioPopUps">
			<?php
			abrir_ventana($NombreRAD.' - '.$MULTILANG_ConfiguracionGeneral,'#f2f2f2','500'); 
			?>
				<!--<DIV style="DISPLAY: block; OVERFLOW: auto; WIDTH: 800; POSITION: relative; HEIGHT: 400px">-->

					<form name="configws" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
					<input type="hidden" name="accion" value="guardar_configws">
					<table cellspacing=0 width="100%" style="font-size:11px; color:000000;">
						<tr>
							<td colspan=2 valign=top align=center>
								<br><?php echo $MULTILANG_WSLlavesDefinidas; ?><br><br><?php echo $MULTILANG_WSLlavesAyuda; ?>
							</td>
						</tr>
						<tr>
							<td valign=top align=right>
								<textarea name="llaves_definidas" cols="15" rows="10" class="AreaTexto" onkeypress="return FiltrarTeclas(this, event)"><?php
									// Carga las llaves definidas
									include_once("core/ws_llaves.php");
										for ($r=0;$r<count(@$Auth_WSKeys);$r++)
											echo $Auth_WSKeys[$r]."\n";
									?></textarea>
							</td>
							<td valign=top align=left>
								<?php
									$llave_temp=TextoAleatorio(10);
								?>
								<br>
								<input type="Button" name="bot0" id="bot0" class="Botones" value=" <<< <?php echo $MULTILANG_WSLlavesAgregar.' '.$llave_temp; ?> " onClick="document.forms.configws.llaves_definidas.value+='<?php echo $llave_temp; ?>\n'; bot0.style.visibility='hidden'; alert('<?php echo $MULTILANG_Finalizado?>');" style="visibility:visible; " >
							</td>
						</tr>
					</table>

					</form>
				<!-- </DIV> -->
			<?php
			abrir_barra_estado();
				echo '<input type="Button"  class="BotonesEstadoCuidado" value=" <<< '.$MULTILANG_IrEscritorio.' " onClick="OcultarPopUp(\'ConfiguracionWebServices\')">';
				echo '<input type="Button"  class="BotonesEstado" value=" '.$MULTILANG_Guardar.' >>> " onClick="document.forms.configws.submit();">';
			cerrar_barra_estado();
			cerrar_ventana();
			?>
		<!-- FIN DE MARCOS POPUP -->
		</div>
