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
	if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario) || !$PCOSESS_SesionAbierta)
		die();


/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_params
	Guarda los parametros de funcionamiento de la aplicacion

	Salida:
		Registro de parametros actualizado en tablas core
*/
	if ($PCO_Accion=="guardar_params")
		{
			$mensaje_error="";
			if ($nombre_empresa_corto=="" || $nombre_aplicacion=="" || $version_nueva=="") $mensaje_error.=$MULTILANG_ErrorDatos.'<br>';

			if ($mensaje_error=="")
				{
					PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."parametros SET federado_puerto=?,federado_servidor=?,federado_usuario=?,federado_clave=?,federado_motor=?,federado_basedatos=?,federado_tabla=?,federado_campousuario=?,federado_campoclave=?,federado_encripcion=?,nombre_empresa_largo=?,fecha_lanzamiento=?,nombre_empresa_corto=?,nombre_aplicacion=?,version=?,funciones_personalizadas=? ","$federado_puerto$_SeparadorCampos_$federado_servidor$_SeparadorCampos_$federado_usuario$_SeparadorCampos_$federado_clave$_SeparadorCampos_$federado_motor$_SeparadorCampos_$federado_basedatos$_SeparadorCampos_$federado_tabla$_SeparadorCampos_$federado_campousuario$_SeparadorCampos_$federado_campoclave$_SeparadorCampos_$federado_encripcion$_SeparadorCampos_$nombre_empresa_largo$_SeparadorCampos_$fecha_lanzamiento$_SeparadorCampos_$nombre_empresa_corto$_SeparadorCampos_$nombre_aplicacion$_SeparadorCampos_$version_nueva$_SeparadorCampos_$funciones_personalizadas");
					PCO_Auditar("Actualiza parametros de aplicacion");
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

    echo '<div class="oculto_impresion">';
    // Modal Parametros
    PCO_AbrirDialogoModal("myModalPARAMETROS",$NombreRAD.' - '.$MULTILANG_ParametrosApp);

				//Consulta parametros de la aplicacion
				$resultado=PCO_EjecutarSQL("SELECT id,$ListaCamposSinID_parametros from ".$TablasCore."parametros ");
				$parametros = $resultado->fetch();

			?>

					<form name="configparams" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
					<input type="hidden" name="PCO_Accion" value="guardar_params">



                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#paramapp-tab" data-toggle="tab"><?php echo $MULTILANG_ParametrosApp; ?></a>
                                </li>
                                <li><a href="#authfederada-tab" data-toggle="tab"><?php echo $MULTILANG_TitFederado; ?></a>
                                </li>
                            </ul>

                            <!-- INICIO de las pestanas -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="paramapp-tab">



                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_ParamNombreEmpresaLargo; ?>:
                                        </span>
                                        <input name="nombre_empresa_largo" value="<?php echo $parametros["nombre_empresa_largo"]; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<b>(<?php echo $MULTILANG_AyudaTitNomEmp; ?>)</b><br><?php echo $MULTILANG_AyudaDesNomEmp; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_ParamNombreEmpresa; ?>:
                                        </span>
                                        <input name="nombre_empresa_corto" value="<?php echo $parametros["nombre_empresa_corto"]; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<b>(<?php echo $MULTILANG_AyudaTitNomEmp; ?>)</b><br><?php echo $MULTILANG_AyudaDesNomEmp; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_ParamNombreApp; ?>:
                                        </span>
                                        <input name="nombre_aplicacion" value="<?php echo $parametros["nombre_aplicacion"]; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<b>(<?php echo $MULTILANG_AyudaTitNomApp; ?>)</b><br><?php echo $MULTILANG_AyudaDesNomApp; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_ParamVersionApp; ?>:
                                        </span>
                                        <input name="version_nueva" value="<?php echo $parametros["version"]; ?>" type="text" class="form-control">
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_ParamFechaLanzamiento; ?>:
                                        </span>
                                        <input name="fecha_lanzamiento" value="<?php echo $parametros["fecha_lanzamiento"]; ?>" type="text" class="form-control">
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_Funciones; ?>:
                                        </span>
                                        <textarea name="funciones_personalizadas" rows="5" class="form-control"><?php echo $parametros["funciones_personalizadas"]; ?></textarea>
                                        <span class="input-group-addon">
                                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<b>(<?php echo $MULTILANG_Ayuda; ?>)</b><br><?php echo $MULTILANG_FuncionesDes; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="authfederada-tab">
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_Servidor; ?>:
                                        </span>
                                        <input name="federado_servidor" value="<?php echo @$parametros["federado_servidor"]; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_Puerto; ?>:
                                        </span>
                                        <input name="federado_puerto" value="<?php echo @$parametros["federado_puerto"]; ?>" type="text" class="form-control">
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_Usuario; ?>:
                                        </span>
                                        <input name="federado_usuario" value="<?php echo @$parametros["federado_usuario"]; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_Contrasena; ?>:
                                        </span>
                                        <input name="federado_clave" value="<?php echo @$parametros["federado_clave"]; ?>" type="text" class="form-control">
                                    </div>

                                    <label for="federado_motor"><?php echo $MULTILANG_MotorBD; ?>:</label>
                                    <div class="form-group input-group">
                                        <select id="federado_motor" name="federado_motor" class="selectpicker" >
                                            <option value="mysql"	 <?php if (@$parametros["federado_motor"]=="mysql") echo "SELECTED"; ?> >MySQL - MariaDB (3.x/4.x/5.x)</option>
                                            <option value="pgsql"	 <?php if (@$parametros["federado_motor"]=="pgsql") echo "SELECTED"; ?> >PostgreSQL</option>
                                            <option value="sqlite"	 <?php if (@$parametros["federado_motor"]=="sqlite") echo "SELECTED"; ?> >SQLite v2 - SQLite v3</option>
                                            <option value="sqlsrv"	 <?php if (@$parametros["federado_motor"]=="sqlsrv") echo "SELECTED"; ?> >FreeTDS/Microsoft SQL Server: Win32 [max version 2008]</option>
                                            <option value="mssql"	 <?php if (@$parametros["federado_motor"]=="mssql") echo "SELECTED"; ?> >FreeTDS/Microsoft SQL Server: Win32&Linux, [max version 2000]</option>
                                            <option value="ibm"		 <?php if (@$parametros["federado_motor"]=="ibm") echo "SELECTED"; ?> >IBM (DB2)</option>
                                            <option value="dblib"	 <?php if (@$parametros["federado_motor"]=="dblib") echo "SELECTED"; ?> >DBLIB</option>
                                            <option value="odbc"	 <?php if (@$parametros["federado_motor"]=="odbc") echo "SELECTED"; ?> >Microsoft Access (ODBC v3: IBM DB2, unixODBC, Win32 ODBC)</option>
                                            <option value="oracle"	 <?php if (@$parametros["federado_motor"]=="oracle") echo "SELECTED"; ?> >ORACLE (OCI Oracle Call Interface)</option>
                                            <option value="ifmx"	 <?php if (@$parametros["federado_motor"]=="ifmx") echo "SELECTED"; ?> >Informix (IBM Informix Dynamic Server)</option>
                                            <option value="fbd"		 <?php if (@$parametros["federado_motor"]=="fbd") echo "SELECTED"; ?> >Firebird (Firebird/Interbase 6)</option>
                                        </select>
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_Basedatos; ?>:
                                        </span>
                                        <input name="federado_basedatos" value="<?php echo @$parametros["federado_basedatos"]; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_TablaDatos; ?>:
                                        </span>
                                        <input name="federado_tabla" value="<?php echo @$parametros["federado_tabla"]; ?>" type="text" class="form-control">
                                    </div>
                                    
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_CampoUsuarioFederado; ?>:
                                        </span>
                                        <input name="federado_campousuario" value="<?php echo @$parametros["federado_campousuario"]; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_CampoClaveFederado; ?>:
                                        </span>
                                        <input name="federado_campoclave" value="<?php echo @$parametros["federado_campoclave"]; ?>" type="text" class="form-control">
                                    </div>
                                    
                                    <label for="federado_encripcion"><?php echo $MULTILANG_AlgoritmoCripto; ?>:</label>
                                    <div class="form-group input-group">
                                        <select id="federado_encripcion" name="federado_encripcion" class="selectpicker"  data-size=10 data-live-search=true>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="plano") echo "SELECTED"; ?> value="plano">Texto plano/Plain text</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="md5") echo "SELECTED"; ?> value="md5">MD5</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="md4") echo "SELECTED"; ?> value="md4">MD4</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="md2") echo "SELECTED"; ?> value="md2">MD2</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="sha1") echo "SELECTED"; ?> value="sha1">SHA 1</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="sha256") echo "SELECTED"; ?> value="sha256">SHA 256</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="sha384") echo "SELECTED"; ?> value="sha384">SHA 384</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="sha512") echo "SELECTED"; ?> value="sha512">SHA 512</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="crc32") echo "SELECTED"; ?> value="crc32">CRC 32</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="crc32b") echo "SELECTED"; ?> value="crc32b">CRC 32B</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="adler32") echo "SELECTED"; ?> value="adler32">Adler 32</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="gost") echo "SELECTED"; ?> value="gost">Gost</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="whirlpool") echo "SELECTED"; ?> value="whirlpool">Whirlpool</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="snefru") echo "SELECTED"; ?> value="snefru">Snefru</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="ripemd128") echo "SELECTED"; ?> value="ripemd128">Ripemd 128</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="ripemd160") echo "SELECTED"; ?> value="ripemd160">Ripemd 160</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="ripemd256") echo "SELECTED"; ?> value="ripemd256">Ripemd 256</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="ripemd320") echo "SELECTED"; ?> value="ripemd320">Ripemd 320</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="tiger128,3") echo "SELECTED"; ?> value="tiger128,3">Tiger 128,3</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="tiger128,4") echo "SELECTED"; ?> value="tiger128,4">Tiger 128,4</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="tiger160,3") echo "SELECTED"; ?> value="tiger160,3">Tiger 160,3</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="tiger160,4") echo "SELECTED"; ?> value="tiger160,4">Tiger 160,4</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="tiger192,3") echo "SELECTED"; ?> value="tiger192,3">Tiger 192,3</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="tiger192,4") echo "SELECTED"; ?> value="tiger192,4">Tiger 192,4</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="haval128,3") echo "SELECTED"; ?> value="haval128,3">Haval 128,3</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="haval128,4") echo "SELECTED"; ?> value="haval128,4">Haval 128,4</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="haval128,5") echo "SELECTED"; ?> value="haval128,5">Haval 128,5</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="haval160,3") echo "SELECTED"; ?> value="haval160,3">Haval 160,3</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="haval160,4") echo "SELECTED"; ?> value="haval160,4">Haval 160,4</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="haval160,5") echo "SELECTED"; ?> value="haval160,5">Haval 160,5</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="haval192,3") echo "SELECTED"; ?> value="haval192,3">Haval 192,3</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="haval192,4") echo "SELECTED"; ?> value="haval192,4">Haval 192,4</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="haval192,5") echo "SELECTED"; ?> value="haval192,5">Haval 192,5</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="haval224,3") echo "SELECTED"; ?> value="haval224,3">Haval 224,3</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="haval224,4") echo "SELECTED"; ?> value="haval224,4">Haval 224,4</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="haval224,5") echo "SELECTED"; ?> value="haval224,5">Haval 224,5</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="haval256,3") echo "SELECTED"; ?> value="haval256,3">Haval 256,3</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="haval256,4") echo "SELECTED"; ?> value="haval256,4">Haval 256,4</option>
                                            <option  <?php if (@$parametros["federado_encripcion"]=="haval256,5") echo "SELECTED"; ?> value="haval256,5">Haval 256,5</option>
                                        </select>
                                    </div>                                    


                                </div>
                            </div>
                            <!-- FIN de las pestanas -->

                <?php 
                    $barra_herramientas_modal='
                        <button type="submit" class="btn btn-success">'.$MULTILANG_Guardar.' <i class="fa fa-save"></i></button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
                    PCO_CerrarDialogoModal($barra_herramientas_modal);
                ?>


					</form>
    </div>