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
		Title: Seccion marco de configuracion
		Ubicacion *[/core/marco_conf.php]*.  Archivo con el panel de configuracion de la herramienta

	Ver tambien:
		<Seccion superior> | <Articulador>
	*/

	//Valida que quien llame este marco tenga permisos suficientes
	if (@$PCOSESS_LoginUsuario!="admin" || !$PCOSESS_SesionAbierta)
		die();

?>

    <div class="oculto_impresion">
    <!-- Modal Configuracion -->
    <?php abrir_dialogo_modal("myModalCONFIGURACION",$NombreRAD.' - '.$MULTILANG_ConfiguracionGeneral,"modal-wide oculto_impresion"); ?>

					<form action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
					<input type="hidden" name="PCO_Accion" value="guardar_configuracion">

                        
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#basedatos-tab" data-toggle="tab"><?php echo $MULTILANG_MotorBD; ?></a>
                                </li>
                                <li><a href="#configvarias-tab" data-toggle="tab"><?php echo $MULTILANG_ConfiguracionVarias; ?></a>
                                </li>
                                <li><a href="#motorauth-tab" data-toggle="tab"><?php echo $MULTILANG_MotorAuth; ?></a>
                                </li>
                            </ul>

                            <!-- INICIO de las pestanas -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="basedatos-tab">
                                    <label for="MotorBDNEW"><?php echo $MULTILANG_TipoMotor; ?>:</label>
                                    <div class="form-group input-group">
                                        <select id="MotorBDNEW" name="MotorBDNEW" class="selectpicker" >
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
                                        <span class="input-group-addon">
                                            <a href="#" title="<?php echo $MULTILANG_AyudaTitMotor; ?>: <?php echo $MULTILANG_AyudaDesMotor; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>
                                    
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_Servidor; ?>:
                                        </span>
                                        <input name="ServidorNEW" value="<?php echo $ServidorBD; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_Puerto; ?>:
                                        </span>
                                        <input name="PuertoBDNEW" value="<?php echo $PuertoBD; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a href="#" title="<?php echo $MULTILANG_PuertoNoPredeterminado; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>
                                    
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_Basedatos; ?>:
                                        </span>
                                        <input name="BaseDatosNEW" value="<?php echo $BaseDatos; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a href="#" title="<?php echo $MULTILANG_AyudaTitBD; ?>: <?php echo $MULTILANG_AyudaDesBD; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_Usuario; ?>:
                                        </span>
                                        <input name="UsuarioBDNEW" value="<?php echo $UsuarioBD; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_Contrasena; ?>:
                                        </span>
                                        <input name="PasswordBDNEW" value="<?php echo $PasswordBD; ?>" type="password" class="form-control">
                                    </div>
                                    
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_PrefijoCore; ?>:
                                        </span>
                                        <input name="TablasCoreNEW" value="<?php echo $TablasCore; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a href="#" title="<?php echo $MULTILANG_AyudaTitPreCore; ?>: <?php echo $MULTILANG_AyudaDesPreCore; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw"></i></a>
                                        </span>
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_PrefijoApp; ?>:
                                        </span>
                                        <input name="TablasAppNEW" value="<?php echo $TablasApp; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a href="#" title="<?php echo $MULTILANG_AyudaTitPreApp; ?>: <?php echo $MULTILANG_AyudaDesPreApp; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>
                                    
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_LlavePaso; ?>:
                                        </span>
                                        <input name="LlaveDePasoNEW" value="<?php echo $LlaveDePaso; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a href="#" title="<?php echo $MULTILANG_AyudaLlave; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="configvarias-tab">
                                    <label for="ZonaHorariaNEW"><?php echo $MULTILANG_ZonaHoraria; ?>:</label>
                                    <div class="form-group input-group">
                                        <select id="ZonaHorariaNEW" name="ZonaHorariaNEW" class="selectpicker" >
                                            <?php
                                                $archivo_origen="inc/practico/zonas_horarias.txt";
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
                                    </div>

                                    <label for="IdiomaPredeterminadoNEW"><?php echo $MULTILANG_IdiomaPredeterminado; ?>:</label>
                                    <div class="form-group input-group">
                                        <select id="IdiomaPredeterminadoNEW" name="IdiomaPredeterminadoNEW" class="selectpicker" >
                                            <?php
                                            // Incluye archivos de idioma para ser seleccionados
                                            $path_idiomas="inc/practico/idiomas/";
                                            $directorio_idiomas=opendir($path_idiomas);
                                            $IdiomaPredeterminadoActual=$IdiomaPredeterminado;
                                            while (($PCOVAR_Elemento=readdir($directorio_idiomas))!=false)
                                                {
                                                    //Lo procesa solo si es un archivo diferente del index
                                                    if (!is_dir($path_idiomas.$PCOVAR_Elemento) && $PCOVAR_Elemento!="." && $PCOVAR_Elemento!=".."  && $PCOVAR_Elemento!="index.html")
                                                        {
                                                            include($path_idiomas.$PCOVAR_Elemento);
                                                            //Establece espanol como predeterminado
                                                            $seleccion="";
                                                            $valor_opcion=str_replace(".php","",$PCOVAR_Elemento);
                                                            if ($valor_opcion==$IdiomaPredeterminadoActual) $seleccion="SELECTED";
                                                            //Presenta la opcion
                                                            echo '<option value="'.$valor_opcion.'" '.$seleccion.'>'.$MULTILANG_DescripcionIdioma.' ('.$PCOVAR_Elemento.')</option>';
                                                        }
                                                }		
                                            //Vuelve a cargar el predeterminado actual
                                            include("inc/practico/idiomas/".$IdiomaPredeterminado.".php");
                                            ?>
                                        </select>
                                    </div>

                                    <label for="CaracteresCaptchaNEW"><?php echo $MULTILANG_CaracteresCaptcha; ?>:</label>
                                    <div class="form-group input-group">
                                        <select id="CaracteresCaptchaNEW" name="CaracteresCaptchaNEW" class="selectpicker" >
                                            <option value="1" <?php if ($CaracteresCaptcha=="1") echo "SELECTED"; ?> >1</option>
                                            <option value="2" <?php if ($CaracteresCaptcha=="2") echo "SELECTED"; ?> >2</option>
                                            <option value="3" <?php if ($CaracteresCaptcha=="3") echo "SELECTED"; ?> >3</option>
                                            <option value="4" <?php if ($CaracteresCaptcha=="4") echo "SELECTED"; ?> >4</option>
                                            <option value="5" <?php if ($CaracteresCaptcha=="5") echo "SELECTED"; ?> >5</option>
                                            <option value="6" <?php if ($CaracteresCaptcha=="6") echo "SELECTED"; ?> >6</option>
                                        </select>
                                        <span class="input-group-addon">
                                            <a href="#" title="<?php echo $MULTILANG_AyudaTitCaptcha; ?>: <?php echo $MULTILANG_AyudaDesCaptcha; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>

                                    <label for="ModoDepuracionNEW"><?php echo $MULTILANG_ModoDepuracion; ?>:</label>
                                    <div class="form-group input-group">
                                        <select id="ModoDepuracionNEW" name="ModoDepuracionNEW" class="selectpicker" >
                                            <option value="1" <?php if ($ModoDepuracion=="1") echo "SELECTED"; ?> ><?php echo $MULTILANG_Encendido; ?></option>
                                            <option value="0" <?php if ($ModoDepuracion=="0") echo "SELECTED"; ?> ><?php echo $MULTILANG_Apagado; ?></option>
                                        </select>
                                        <span class="input-group-addon">
                                            <a href="#" title="<?php echo $MULTILANG_AyudaTitDebug; ?>: <?php echo $MULTILANG_AyudaDesDebug; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>

                                    <label for="BuscarActualizacionesNEW"><?php echo $MULTILANG_BuscarActual; ?>:</label>
                                    <div class="form-group input-group">
                                        <select id="BuscarActualizacionesNEW" name="BuscarActualizacionesNEW" class="selectpicker" >
                                            <option value="1" <?php if (@$BuscarActualizaciones=="1") echo "SELECTED"; ?> ><?php echo $MULTILANG_Encendido; ?></option>
                                            <option value="0" <?php if (@$BuscarActualizaciones=="0") echo "SELECTED"; ?> ><?php echo $MULTILANG_Apagado; ?></option>
                                        </select>
                                        <span class="input-group-addon">
                                            <a href="#" title="<?php echo $MULTILANG_Ayuda; ?>: <?php echo $MULTILANG_DescActual; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_NombreRAD; ?>:
                                        </span>
                                        <input name="NombreRADNEW" value="<?php echo $NombreRAD; ?>" type="text" class="form-control">
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_IDGABeacon; ?>:
                                        </span>
                                        <input name="CodigoGoogleAnalyticsNEW" value="<?php if (@$CodigoGoogleAnalytics!="") echo $CodigoGoogleAnalytics; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a href="#" title="<?php echo $MULTILANG_Ayuda; ?>: <?php echo $MULTILANG_AyudaGABeacon; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="motorauth-tab">

                                    <label for="Auth_TipoMotorNEW"><?php echo $MULTILANG_Tipo; ?>:</label>
                                    <div class="form-group input-group">
                                        <select id="Auth_TipoMotorNEW" name="Auth_TipoMotorNEW" class="selectpicker" >
                                            <option value="practico" <?php if ($Auth_TipoMotor=="practico") echo "SELECTED"; ?> ><?php echo $MULTILANG_AuthPractico; ?></option>
                                            <option value="ldap" <?php if ($Auth_TipoMotor=="ldap") echo "SELECTED"; ?> ><?php echo $MULTILANG_AuthLDAP; ?></option>
                                        </select>
                                        <span class="input-group-addon">
                                            <a href="#" title="<?php echo $MULTILANG_Importante; ?>: <?php echo $MULTILANG_AyudaDesAuth; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>

                                    <label for="Auth_ProtoTransporteNEW"><?php echo $MULTILANG_ProtoTransporte; ?>:</label>
                                    <div class="form-group input-group">
                                        <select id="Auth_ProtoTransporteNEW" name="Auth_ProtoTransporteNEW" class="selectpicker" >
                                            <option value="" <?php if (@$Auth_ProtoTransporte=="") echo "SELECTED"; ?> ><?php echo $MULTILANG_ProtoTransAUTO; ?></option>
                                            <option value="http" <?php if (@$Auth_ProtoTransporte=="http") echo "SELECTED"; ?> ><?php echo $MULTILANG_ProtoTransHTTP; ?></option>
                                            <option value="https" <?php if (@$Auth_ProtoTransporte=="https") echo "SELECTED"; ?> ><?php echo $MULTILANG_ProtoTransHTTPS; ?></option>
                                        </select>
                                        <span class="input-group-addon">
                                            <a href="#" title="<?php echo $MULTILANG_Importante; ?>: <?php echo $MULTILANG_ProtoDescripcion; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>

                                    <hr>
                                    <h4>[<?php echo $MULTILANG_AuthLDAPTitulo; ?>]</h4>

                                    <label for="Auth_TipoEncripcionNEW"><?php echo $MULTILANG_AlgoritmoCripto; ?>:</label>
                                    <div class="form-group input-group">
                                        <select id="Auth_TipoEncripcionNEW" name="Auth_TipoEncripcionNEW" class="selectpicker" >
                                            <option  <?php if ($Auth_TipoEncripcion=="plano") echo "SELECTED"; ?> value="plano">Texto plano/Plain text</option>
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
                                        <span class="input-group-addon">
                                            <a href="#" title="<?php echo $MULTILANG_AyudaTitCript; ?>: <?php echo $MULTILANG_AyudaDesCript; ?>"><i class="fa fa-exclamation-triangle icon-orange fa-fw"></i></a>
                                        </span>
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_Servidor; ?>:
                                        </span>
                                        <input name="Auth_LDAPServidorNEW" value="<?php echo $Auth_LDAPServidor; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a href="#" title="<?php echo $MULTILANG_AyudaDesLdapIP; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_Puerto; ?>:
                                        </span>
                                        <input name="Auth_LDAPPuertoNEW" value="<?php echo $Auth_LDAPPuerto; ?>" type="text" class="form-control">
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_Dominio; ?>: (dc=)
                                        </span>
                                        <input name="Auth_LDAPDominioNEW" value="<?php echo $Auth_LDAPDominio; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a href="#" title="(<?php echo $MULTILANG_Opcional; ?>) <?php echo $MULTILANG_AyudaDesLdapDominio; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <?php echo $MULTILANG_UO; ?>: (ou=)
                                        </span>
                                        <input name="Auth_LDAPOUNEW" value="<?php echo $Auth_LDAPOU; ?>" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <a href="#" title="(<?php echo $MULTILANG_Opcional; ?>) <?php echo $MULTILANG_AyudaDesLdapUO; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                        </span>
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
    </div>
