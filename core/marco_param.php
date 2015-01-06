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
	if ($PCO_Accion=="guardar_params")
		{
			$mensaje_error="";
			if ($nombre_empresa_corto=="" || $nombre_aplicacion=="" || $version_nueva=="") $mensaje_error.=$MULTILANG_ErrorDatos.'<br>';

			if ($mensaje_error=="")
				{
					ejecutar_sql_unaria("UPDATE ".$TablasCore."parametros SET nombre_empresa_corto=?,nombre_aplicacion=?,version=?,funciones_personalizadas=? ","$nombre_empresa_corto$_SeparadorCampos_$nombre_aplicacion$_SeparadorCampos_$version_nueva$_SeparadorCampos_$funciones_personalizadas");
					auditar("Actualiza parametros de aplicacion");
					echo '<script type="" language="JavaScript"> document.core_ver_menu.submit(); </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="Ver_menu">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


    // Modal Parametros
    abrir_dialogo_modal("myModalPARAMETROS",$NombreRAD.' - '.$MULTILANG_ParametrosApp);

				//Consulta parametros de la aplicacion
				$resultado=ejecutar_sql("SELECT id,$ListaCamposSinID_parametros from ".$TablasCore."parametros ");
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
                                            <?php echo $MULTILANG_ParamNombreEmpresa; ?>:
                                        </span>
                                        <input name="nombre_empresa_corto" value="<?php echo $parametros["nombre_empresa_corto"]; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a href="#" title="(<?php echo $MULTILANG_AyudaTitNomEmp; ?>) <?php echo $MULTILANG_AyudaDesNomEmp; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_ParamNombreApp; ?>:
                                        </span>
                                        <input name="nombre_aplicacion" value="<?php echo $parametros["nombre_aplicacion"]; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a href="#" title="(<?php echo $MULTILANG_AyudaTitNomApp; ?>) <?php echo $MULTILANG_AyudaDesNomApp; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
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
                                            <?php echo $MULTILANG_Funciones; ?>:
                                        </span>
                                        <textarea name="funciones_personalizadas" rows="5" class="form-control"><?php echo $parametros["funciones_personalizadas"]; ?></textarea>
                                        <span class="input-group-addon">
                                            <a href="#" title="(<?php echo $MULTILANG_Ayuda; ?>) <?php echo $MULTILANG_FuncionesDes; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>
                                </div>



                                <div class="tab-pane fade" id="authfederada-tab">
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_Servidor; ?>:
                                        </span>
                                        <input name="servidor_federado" value="<?php echo @$parametros["servidor_federado"]; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_Usuario; ?>:
                                        </span>
                                        <input name="usuario_federado" value="<?php echo @$parametros["usuario_federado"]; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_Contrasena; ?>:
                                        </span>
                                        <input name="clave_federada" value="<?php echo @$parametros["clave_federada"]; ?>" type="text" class="form-control">
                                    </div>

                                    <label for="motor_federado"><?php echo $MULTILANG_MotorBD; ?>:</label>
                                    <div class="form-group input-group">
                                        <select id="motor_federado" name="motor_federado" class="selectpicker" >
                                            <option value="mysql"	 <?php if (@$parametros["motor_federado"]=="mysql") echo "SELECTED"; ?> >MySQL - MariaDB (3.x/4.x/5.x)</option>
                                            <option value="pgsql"	 <?php if (@$parametros["motor_federado"]=="pgsql") echo "SELECTED"; ?> >PostgreSQL</option>
                                            <option value="sqlite"	 <?php if (@$parametros["motor_federado"]=="sqlite") echo "SELECTED"; ?> >SQLite v2 - SQLite v3</option>
                                            <option value="sqlsrv"	 <?php if (@$parametros["motor_federado"]=="sqlsrv") echo "SELECTED"; ?> >FreeTDS/Microsoft SQL Server: Win32 [max version 2008]</option>
                                            <option value="mssql"	 <?php if (@$parametros["motor_federado"]=="mssql") echo "SELECTED"; ?> >FreeTDS/Microsoft SQL Server: Win32&Linux, [max version 2000]</option>
                                            <option value="ibm"		 <?php if (@$parametros["motor_federado"]=="ibm") echo "SELECTED"; ?> >IBM (DB2)</option>
                                            <option value="dblib"	 <?php if (@$parametros["motor_federado"]=="dblib") echo "SELECTED"; ?> >DBLIB</option>
                                            <option value="odbc"	 <?php if (@$parametros["motor_federado"]=="odbc") echo "SELECTED"; ?> >Microsoft Access (ODBC v3: IBM DB2, unixODBC, Win32 ODBC)</option>
                                            <option value="oracle"	 <?php if (@$parametros["motor_federado"]=="oracle") echo "SELECTED"; ?> >ORACLE (OCI Oracle Call Interface)</option>
                                            <option value="ifmx"	 <?php if (@$parametros["motor_federado"]=="ifmx") echo "SELECTED"; ?> >Informix (IBM Informix Dynamic Server)</option>
                                            <option value="fbd"		 <?php if (@$parametros["motor_federado"]=="fbd") echo "SELECTED"; ?> >Firebird (Firebird/Interbase 6)</option>
                                        </select>
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_Basedatos; ?>:
                                        </span>
                                        <input name="basedatos_federada" value="<?php echo @$parametros["basedatos_federada"]; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_TablaDatos; ?>:
                                        </span>
                                        <input name="tabla_federada" value="<?php echo @$parametros["tabla_federada"]; ?>" type="text" class="form-control">
                                    </div>
                                    
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_CampoUsuarioFederado; ?>:
                                        </span>
                                        <input name="campo_usuario_federado" value="<?php echo @$parametros["campo_usuario_federado"]; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_CampoClaveFederado; ?>:
                                        </span>
                                        <input name="campo_clave_federada" value="<?php echo @$parametros["campo_clave_federada"]; ?>" type="text" class="form-control">
                                    </div>
                                    
                                    <label for="encripcion_federada"><?php echo $MULTILANG_AlgoritmoCripto; ?>:</label>
                                    <div class="form-group input-group">
                                        <select id="encripcion_federada" name="encripcion_federada" class="selectpicker" >
                                            <option  <?php if (@$parametros["encripcion_federada"]=="plano") echo "SELECTED"; ?> value="plano">Texto plano/Plain text</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="md5") echo "SELECTED"; ?> value="md5">MD5</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="md4") echo "SELECTED"; ?> value="md4">MD4</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="md2") echo "SELECTED"; ?> value="md2">MD2</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="sha1") echo "SELECTED"; ?> value="sha1">SHA 1</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="sha256") echo "SELECTED"; ?> value="sha256">SHA 256</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="sha384") echo "SELECTED"; ?> value="sha384">SHA 384</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="sha512") echo "SELECTED"; ?> value="sha512">SHA 512</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="crc32") echo "SELECTED"; ?> value="crc32">CRC 32</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="crc32b") echo "SELECTED"; ?> value="crc32b">CRC 32B</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="adler32") echo "SELECTED"; ?> value="adler32">Adler 32</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="gost") echo "SELECTED"; ?> value="gost">Gost</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="whirlpool") echo "SELECTED"; ?> value="whirlpool">Whirlpool</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="snefru") echo "SELECTED"; ?> value="snefru">Snefru</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="ripemd128") echo "SELECTED"; ?> value="ripemd128">Ripemd 128</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="ripemd160") echo "SELECTED"; ?> value="ripemd160">Ripemd 160</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="ripemd256") echo "SELECTED"; ?> value="ripemd256">Ripemd 256</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="ripemd320") echo "SELECTED"; ?> value="ripemd320">Ripemd 320</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="tiger128,3") echo "SELECTED"; ?> value="tiger128,3">Tiger 128,3</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="tiger128,4") echo "SELECTED"; ?> value="tiger128,4">Tiger 128,4</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="tiger160,3") echo "SELECTED"; ?> value="tiger160,3">Tiger 160,3</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="tiger160,4") echo "SELECTED"; ?> value="tiger160,4">Tiger 160,4</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="tiger192,3") echo "SELECTED"; ?> value="tiger192,3">Tiger 192,3</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="tiger192,4") echo "SELECTED"; ?> value="tiger192,4">Tiger 192,4</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="haval128,3") echo "SELECTED"; ?> value="haval128,3">Haval 128,3</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="haval128,4") echo "SELECTED"; ?> value="haval128,4">Haval 128,4</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="haval128,5") echo "SELECTED"; ?> value="haval128,5">Haval 128,5</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="haval160,3") echo "SELECTED"; ?> value="haval160,3">Haval 160,3</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="haval160,4") echo "SELECTED"; ?> value="haval160,4">Haval 160,4</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="haval160,5") echo "SELECTED"; ?> value="haval160,5">Haval 160,5</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="haval192,3") echo "SELECTED"; ?> value="haval192,3">Haval 192,3</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="haval192,4") echo "SELECTED"; ?> value="haval192,4">Haval 192,4</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="haval192,5") echo "SELECTED"; ?> value="haval192,5">Haval 192,5</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="haval224,3") echo "SELECTED"; ?> value="haval224,3">Haval 224,3</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="haval224,4") echo "SELECTED"; ?> value="haval224,4">Haval 224,4</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="haval224,5") echo "SELECTED"; ?> value="haval224,5">Haval 224,5</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="haval256,3") echo "SELECTED"; ?> value="haval256,3">Haval 256,3</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="haval256,4") echo "SELECTED"; ?> value="haval256,4">Haval 256,4</option>
                                            <option  <?php if (@$parametros["encripcion_federada"]=="haval256,5") echo "SELECTED"; ?> value="haval256,5">Haval 256,5</option>
                                        </select>
                                    </div>                                    


                                </div>
                            </div>
                            <!-- FIN de las pestanas -->

                <?php 
                    $barra_herramientas_modal='
                        <button type="submit" class="btn btn-success">'.$MULTILANG_Guardar.' <i class="fa fa-save"></i></button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
                    cerrar_dialogo_modal($barra_herramientas_modal);
                ?>


					</form>
