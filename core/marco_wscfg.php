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
	if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario) || !$PCOSESS_SesionAbierta)
		die();


/* ################################################################## */
/* ################################################################## */
/*
	Function: agregar_configws
	Agrega una nueva combinacion de configuraciones para un cliente de API

	Salida:
		Registro con llaves de API agregado
*/
	if ($PCO_Accion=="agregar_configws")
		{
			$mensaje_error="";
			if ($nombre=="") $mensaje_error.=$MULTILANG_WSLlavesNombre.'<br>';

			if ($mensaje_error=="")
				{
					PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."llaves_api (".$ListaCamposSinID_llaves_api.") VALUES (?,?,?,?,?,?,?)","$nombre$_SeparadorCampos_$llave$_SeparadorCampos_$secreto$_SeparadorCampos_$uri$_SeparadorCampos_$dominio_autorizado$_SeparadorCampos_$ip_autorizada$_SeparadorCampos_$funciones_autorizadas");
					PCO_Auditar("Agrega llave API para $nombre");
					echo '<script type="" language="JavaScript"> document.PCO_FormVerMenu.submit(); </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_VerMenu">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
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
	if ($PCO_Accion=="actualizar_llavews")
		{
			$mensaje_error="";
			if ($mensaje_error=="")
				{
					PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."llaves_api SET uri=?,dominio_autorizado=?,ip_autorizada=?,funciones_autorizadas=? WHERE id=? ","$uri$_SeparadorCampos_$dominio_autorizado$_SeparadorCampos_$ip_autorizada$_SeparadorCampos_$funciones_autorizadas$_SeparadorCampos_$id");
					PCO_Auditar("Actualiza llave API para $id");
					echo '<script type="" language="JavaScript"> document.PCO_FormVerMenu.submit(); </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_VerMenu">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
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
	if ($PCO_Accion=="eliminar_llavews")
		{
			$mensaje_error="";
			if ($mensaje_error=="")
				{
					PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."llaves_api WHERE id=? ","$id");
					PCO_Auditar("Elimina llave API para $id");
					echo '<script type="" language="JavaScript"> document.PCO_FormVerMenu.submit(); </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_VerMenu">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}
?>
    <div class="oculto_impresion">
    <!-- Modal WebServices -->
    <?php PCO_AbrirDialogoModal("myModalWEBSERVICES",$NombreRAD.' - '.$MULTILANG_WSLlavesNuevo,"modal-wide"); ?>


            <form name="nuevallave" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
                <input type="hidden" name="PCO_Accion" value="agregar_configws">
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group input-group">
                            <input name="nombre" type="text" class="form-control" placeholder="<?php echo $MULTILANG_WSLlavesNombre; ?>">
                            <span class="input-group-addon">
                                <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                            </span>
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon">
                                <?php echo $MULTILANG_WSLlavesLlave; ?>:
                            </span>
                            <input name="llave" type="text" class="form-control" value="<?php echo PCO_TextoAleatorio(10); ?>" readonly>
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon">
                                <?php echo $MULTILANG_WSLlavesSecreto; ?>:
                            </span>
                            <input name="secreto" type="text" class="form-control" value="<?php echo PCO_TextoAleatorio(10); ?>" readonly>
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-globe"></i>
                            </span>
                            <input name="uri" type="text" class="form-control" placeholder="<?php echo $MULTILANG_WSLlavesURI; ?>">
                        </div>

                        <div class="form-group input-group">
                            <input name="dominio_autorizado" type="text" class="form-control" placeholder="<?php echo $MULTILANG_WSLlavesDominio; ?>">
                            <span class="input-group-addon">
                                <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_WSLlavesAsterisco; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                            </span>
                        </div>

                        <div class="form-group input-group">
                            <input name="ip_autorizada" type="text" class="form-control" placeholder="<?php echo $MULTILANG_WSLlavesIP; ?>">
                            <span class="input-group-addon">
                                <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_WSLlavesAsterisco; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                            </span>
                        </div>

                    </div>    
                    <div class="col-md-6">
                        
                        <?php echo $MULTILANG_WSLlavesFunciones; ?>
                        <div class="form-group input-group">
                            <textarea name="funciones_autorizadas" rows=8 class="form-control"><?php echo @$parametros["funciones_autorizadas"]; ?></textarea>
                            <span class="input-group-addon">
                                <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_WSLlavesAsterisco; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                            </span>
                        </div>

                        <button type="button" class="btn btn-success btn-block" onclick="document.forms.nuevallave.submit();"><i class="fa fa-save"></i> <?php echo $MULTILANG_Agregar; ?></button>

                    </div>
                </div>

			</form>


			<hr>
			<?php echo $MULTILANG_WSLlavesDefinidas; ?><br><?php echo $MULTILANG_WSLlavesAyuda; ?>

				<table class="table table-unbordered table-striped table-hover table-condensed btn-xs">
                    <thead>
					<tr>
						<th><b><?php echo $MULTILANG_WSLlavesNombre; ?><br><?php echo $MULTILANG_WSLlavesLlave; ?><br><?php echo $MULTILANG_WSLlavesSecreto; ?></b></th>
						<th><b><?php echo $MULTILANG_WSLlavesURI; ?></b></th>
						<th><b><?php echo $MULTILANG_WSLlavesDominio; ?></b></th>
						<th><b><?php echo $MULTILANG_WSLlavesIP; ?></b></th>
						<th><b><?php echo $MULTILANG_WSLlavesFunciones; ?></b></th>
						<th></th>
						<th></th>
					</tr>
                    </thead>
                    <tbody>
				<?php
					$consulta_forms=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_llaves_api." FROM ".$TablasCore."llaves_api");
					while($registro = $consulta_forms->fetch())
						{
							echo '
							<form action="'.$ArchivoCORE.'" method="POST" name="dactf'.$registro["id"].'" id="dactf'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
								<input type="hidden" name="PCO_Accion" value="actualizar_llavews">
								<input type="hidden" name="id" value="'.$registro["id"].'">
								<tr>
									<td><b><font color=blue>'.$registro["nombre"].'</font></b><br>'.$registro["llave"].'<br>'.$registro["secreto"].'</td>
									<td><input type="text" name="uri" value="'.$registro["uri"].'" size="13" maxlength=255 class="CampoTexto"></td>
									<td><input type="text" name="dominio_autorizado" value="'.$registro["dominio_autorizado"].'" size="13" maxlength=255 class="CampoTexto"></td>
									<td><input type="text" name="ip_autorizada" value="'.$registro["ip_autorizada"].'" size="13" maxlength=255 class="CampoTexto"></td>
									<td><textarea name="funciones_autorizadas" cols=20 rows=1>'.$registro["funciones_autorizadas"].'</textarea></td>
									<td align="center">													
                                <button type="submit" class="btn btn-xs btn-info"><i class="fa fa-refresh"></i> '.$MULTILANG_Actualizar.'</button>
							</form>
									</td>
									<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST" name="delf'.$registro["id"].'" id="delf'.$registro["id"].'">
												<input type="hidden" name="PCO_Accion" value="eliminar_llavews">
												<input type="hidden" name="id" value="'.$registro["id"].'">
                                                <a class="btn btn-danger btn-xs" href="javascript:confirmar_evento(\''.$MULTILANG_WSLlavesBorrar.'\',delf'.$registro["id"].');"><i class="fa fa-times"></i> '.$MULTILANG_Eliminar.'</a>
										</form>
									</td>
								</tr>';
						}
					echo '
                        </tbody>
                    </table>';
				?>

        <?php 
            $barra_herramientas_modal='
                <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
            PCO_CerrarDialogoModal($barra_herramientas_modal);
        ?>

    </div>