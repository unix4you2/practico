<?php
	/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2012-2022
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
	 This program is free software: you can redistribute it and/or modify
	 it under the terms of the GNU General Public License as published by
	 the Free Software Foundation, either version 3 of the License, or
	 (at your option) any later version.

	 This program is distributed in the hope that it will be useful,
	 but WITHOUT ANY WARRANTY; without even the implied warranty of
	 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 GNU General Public License for more details.

	 You should have received a copy of the GNU General Public License
	 along with this program.  If not, see <http://www.gnu.org/licenses/>
	 
	            --- TRADUCCION NO OFICIAL DE LA LICENCIA ---

     Esta es una traducción no oficial de la Licencia Pública General de
     GNU al español. No ha sido publicada por la Free Software Foundation
     y no establece los términos jurídicos de distribución del software 
     publicado bajo la GPL 3 de GNU, solo la GPL de GNU original en inglés
     lo hace. De todos modos, esperamos que esta traducción ayude a los
     hispanohablantes a comprender mejor la GPL de GNU:
	 
     Este programa es software libre: puede redistribuirlo y/o modificarlo
     bajo los términos de la Licencia General Pública de GNU publicada por
     la Free Software Foundation, ya sea la versión 3 de la Licencia, o 
     (a su elección) cualquier versión posterior.

     Este programa se distribuye con la esperanza de que sea útil pero SIN
     NINGUNA GARANTÍA; incluso sin la garantía implícita de MERCANTIBILIDAD
     o CALIFICADA PARA UN PROPÓSITO EN PARTICULAR. Vea la Licencia General
     Pública de GNU para más detalles.

     Usted ha debido de recibir una copia de la Licencia General Pública de
     GNU junto con este programa. Si no, vea <http://www.gnu.org/licenses/>
	*/
?>

<div align=center>

<table class="table table-unbordered btn-xs">
	<tr>
		<td width=100><img src="../img/practico_login.png" border=0 ALT="Logo Practico" width="116" height="80"></td>
		<td valign=top><b>
			[<?php echo $MULTILANG_ConfiguracionGeneral; ?>]</b><br><br>
			<?php echo $MULTILANG_ConfiguracionDescripcion; ?>:
		</td>
	</tr>
</table>
<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
<input type="hidden" name="NombreRADNEW" value="Practico">
<input type="hidden" name="IdiomaPredeterminadoNEW" value="<?php echo $Idioma; ?>">




    <b class="icon-red">[<?php echo $MULTILANG_MotorBD; ?>]</b>
    <div class="form-group input-group">
        <span class="input-group-addon">
            <?php echo $MULTILANG_TipoMotor; ?>:
        </span>
        <select id="MotorBDNEW" name="MotorBDNEW" class="form-control" >
				<option value="mysql">MySQL - MariaDB (3.x/4.x/5.x)</option>
				<optgroup label="Soporte de segundo nivel / Second level support">
				</optgroup>
				<optgroup label="Disponibles despues de instalar / Available after install">
    				<option value="pgsql" disabled>PostgreSQL</option>
    				<option value="sqlite" disabled>SQLite v2 - SQLite v3</option>
    				<option value="sqlsrv" disabled>FreeTDS/Microsoft SQL Server: Win32 [max version 2008]</option>
    				<option value="mssql" disabled>FreeTDS/Microsoft SQL Server: Win32&Linux, [max version 2000]</option>
    				<option value="dblib_mssql" disabled>DBLIB: Microsoft SQL Server via FreeTDS (requiere indicar puerto)</option>
    				<option value="dblib" disabled>DBLIB: Sybase</option>
    				<option value="ibm" disabled>IBM (DB2)</option>
    				<option value="odbc" disabled>Microsoft Access (ODBC v3: IBM DB2, unixODBC, Win32 ODBC)</option>
    				<option value="oracle" disabled>ORACLE (OCI Oracle Call Interface)</option>
    				<option value="ifmx" disabled>Informix (IBM Informix Dynamic Server)</option>
    				<option value="fbd" disabled>Firebird (Firebird/Interbase 6)</option>
				</optgroup>
        </select>
        <span class="input-group-addon">
            <a href="#" title="<?php echo $MULTILANG_AyudaTitMotor; ?>: <?php echo $MULTILANG_AyudaDesMotor; ?>"><i class="fa fa-question-circle fa-fw"></i></a>
        </span>
    </div>

    <div class="form-group input-group">
        <span class="input-group-addon">
            <?php echo $MULTILANG_Servidor; ?>:
        </span>
        <input name="ServidorNEW" type="text" class="form-control">
        <span class="input-group-addon">
            <?php echo $MULTILANG_Puerto; ?>:
        </span>
        <input name="PuertoBDNEW" type="text" class="form-control">
        <span class="input-group-addon">
            <a href="#" title="<?php echo $MULTILANG_PuertoNoPredeterminado; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
        </span>
    </div>

    <div class="form-group input-group">
        <span class="input-group-addon">
            <?php echo $MULTILANG_Basedatos; ?>:
        </span>
        <input name="BaseDatosNEW" type="text" class="form-control">
        <span class="input-group-addon">
            <a href="#" title="<?php echo $MULTILANG_AyudaTitBD; ?>: <?php echo $MULTILANG_AyudaDesBD; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
        </span>
        <span class="input-group-addon">
            <?php echo $MULTILANG_Usuario; ?>:
        </span>
        <input name="UsuarioBDNEW" type="text" class="form-control">
        <span class="input-group-addon">
            <?php echo $MULTILANG_Contrasena; ?>:
        </span>
        <input name="PasswordBDNEW" type="password" class="form-control">
    </div>

    <div class="form-group input-group">
        <span class="input-group-addon">
            <?php echo $MULTILANG_PrefijoCore; ?>:
        </span>
        <input name="TablasCoreNEW" value="core_" type="text" class="form-control">
        <span class="input-group-addon">
            <a href="#" title="<?php echo $MULTILANG_AyudaTitPreCore; ?>: <?php echo $MULTILANG_AyudaDesPreCore; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw"></i></a>
        </span>
        <span class="input-group-addon">
            <?php echo $MULTILANG_PrefijoApp; ?>:
        </span>
        <input name="TablasAppNEW" value="app_" type="text" class="form-control">
        <span class="input-group-addon">
            <a href="#" title="<?php echo $MULTILANG_AyudaTitPreApp; ?>: <?php echo $MULTILANG_AyudaDesPreApp; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
        </span>
    </div>

    <div class="form-group input-group">
        <span class="input-group-addon">
            <?php echo $MULTILANG_LlavePaso; ?>:
        </span>
        <input name="LlaveDePasoNEW" value="<?php echo PCO_TextoAleatorio(10); ?>" type="text" class="form-control">
        <span class="input-group-addon">
            <a href="#" title="<?php echo $MULTILANG_AyudaLlave; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
        </span>
    </div>
    <div class="btn-xs"><?php echo $MULTILANG_NotasImportantesInst1; ?></div>

<br>
<div class="row">
    <div class="col col-md-8">
        <b class="icon-red">[<?php echo $MULTILANG_ParametrosApp; ?>]</b><br>
        <div class="form-group input-group">
            <span class="input-group-addon">
                <?php echo $MULTILANG_ParamNombreEmpresa; ?>:
            </span>
            <input name="NombreCortoEmpresa" type="text" class="form-control">
            <span class="input-group-addon">
                <a href="#" title="(<?php echo $MULTILANG_AyudaTitNomEmp; ?>) <?php echo $MULTILANG_AyudaDesNomEmp; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
            </span>
        </div>
    
        <div class="form-group input-group">
            <span class="input-group-addon">
                <?php echo $MULTILANG_ParamNombreApp; ?>:
            </span>
            <input name="NombreAplicacion" type="text" class="form-control">
            <span class="input-group-addon">
                <a href="#" title="(<?php echo $MULTILANG_AyudaTitNomApp; ?>) <?php echo $MULTILANG_AyudaDesNomApp; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
            </span>
        </div>
        <?php echo $MULTILANG_NotasImportantesInst2; ?>
    </div>
    <div class="col col-md-4">
        <b class="icon-red">[<?php echo $MULTILANG_ConfiguracionVarias; ?>]</b><br>
        <label for="ZonaHorariaNEW"><?php echo $MULTILANG_ZonaHoraria; ?>:</label>
        <div class="form-group input-group">
            <select id="ZonaHorariaNEW" name="ZonaHorariaNEW" class="form-control" >
                <?php
                    $archivo_origen="../inc/practico/zonas_horarias.txt";
                    $archivo = fopen($archivo_origen, "r");
                    //descarta comentario inicial de archivo
                    if ($archivo)
                        {
                            $linea = fgets($archivo, 1024);
                            while (!feof($archivo))
                                {
                                    $linea = fgets($archivo, 1024);
                                    if (trim($linea)=="America/Bogota")
                                        echo "<option value='".trim($linea)."' selected>".trim($linea)."</option>";
                                    else
                                        echo "<option value='".trim($linea)."'>".trim($linea)."</option>";
                                }
                            fclose($archivo);
                        }
                ?>
            </select>
        </div>
    </div>
</div>


    <input type="hidden" name="Auth_TipoMotorNEW" value="practico">
    <input type="hidden" name="Auth_ProtoTransporteNEW" value="">
    <input type="hidden" name="Auth_TipoEncripcionNEW" value="plano">
    <input type="hidden" name="Auth_LDAPServidorNEW" value="">
    <input type="hidden" name="Auth_LDAPPuertoNEW" value="">
    <input type="hidden" name="Auth_LDAPDominioNEW" value="">
    <input type="hidden" name="Auth_LDAPOUNEW" value="">
    <input type="hidden" name="BuscarActualizacionesNEW" value="0">
    <input type="hidden" name="ModoDepuracionNEW" value="0">
    <input type="hidden" name="CaracteresCaptchaNEW" value="4">
    <input type="hidden" name="TipoCaptchaLoginNEW" value="visual">
    <input type="hidden" name="VersionAplicacion" value="1.0">

<?php
	PCO_AbrirBarraEstado();

	$anterior=$paso-1;
	$siguiente=$paso+1;

	if ($hay_error)
		{
			echo '<input type="Hidden" name="paso" value="1">
				  <input type="Hidden" name="Idioma" value="'.$Idioma.'">';
			echo '<input type="Button" class="btn btn-danger" value=" '.$MULTILANG_ProbarNuevamente.' " onclick="document.continuar.submit();">';
		}
	else
		{
			echo '<input type="Hidden" name="paso" value="'.$siguiente.'">
				  <input type="Hidden" name="Idioma" value="'.$Idioma.'">';
			echo '<button onclick="document.continuar.submit();" type="button" class="btn btn-success navbar-btn">'.$MULTILANG_Continuar.' <i class="fa fa-check"></i></button>';
		}
	echo '</form>';
	echo '<form name="regresar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			<input type="Hidden" name="paso" value="'.$anterior.'">
			<input type="Hidden" name="Idioma" value="'.$Idioma.'">
			<button onclick="document.regresar.submit();" type="button" class="btn btn-primary navbar-btn"><i class="fa fa-caret-square-o-left"></i> '.$MULTILANG_Anterior.'</button>
		  </form>';
	PCO_CerrarBarraEstado();
?>