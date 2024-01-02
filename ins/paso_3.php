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
<table  class="table table-unbordered">
	<tr>
		<td width=100><img src="../img/practico_login.png" border=0 ALT="Logo Practico" width="116" height="80"></td>
		<td valign=top><font size=2 color=black><br><b>
			[<?php echo $MULTILANG_TitInsPaso3; ?>]</b><br><br>
			<?php echo $MULTILANG_TitDesPaso3; ?>
		</font></td>
	</tr>
</table>

<?php
	$hay_error=0;

	// Crea la cadena de salida con la configuracion de practico
	$salida=sprintf("<?php
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


		Title: Configuracion base
		
		IMPORTANTE: La actualizacion de este archivo se deberia realizar por medio de la ventana de configuracion de la herramienta.  No altere estos valores manualmente a menos que sepa lo que hace.
		
		Ubicacion *[/core/configuracion.php]*.  Archivo que contiene la declaracion de variables basicas para conexion a bases de datos y otros

		Section: Variables de conexion

		Crea las variables de conexion para el motor de bases de datos, segmentos de direcciones, etc.  Ver ejemplo:

		(start code)
			ServidorBD='XXX';
			BaseDatos='XXX';
			UsuarioBD='XXX';
			PasswordBD='XXX';
			MotorBD='XXX';
			PuertoBD='';
		(end)
	*/

	\$ServidorBD='%s';	// Direccion IP o nombre de host
	\$BaseDatos='%s';   // Path completo cuando se trata de sqlite2, ej: '/path/to/database.sdb'
	\$UsuarioBD='%s';
	\$PasswordBD='%s';
	\$MotorBD='%s';		// Puede variar segun el driver PDO: mysql|pgsql|sqlite|sqlsrv|mssql|ibm|dblib|odbc|oracle|ifmx|fbd
	\$PuertoBD='%s';	// Vacio para predeterminado

	/*
		Section: Variables para aplicacion

		(start code)
			NombreRAD='XXX';			// Nombre del aplicativo
			VersionRAD='XXX';			// Version del aplicativo
			ArchivoCORE='';				// Script que procesa todos los formularios. Vacio para la misma pagina o index.php

			TablasCore='Core_';			// Prefijo de Tablas base para uso de Practico (Cuidado al cambiar)
			TablasApp='App_';			// Prefijo de Tablas de datos definidas por el usuario (Cuidado al cambiar)
		(end)

		*Llave de paso*

		Establezca cualquier valor en la siguiente variable para reforzar la seguridad. Cambiar esto despues de tener usuarios creados puede afectar la autenticacion
		Se recomienda establecer una llave en ambientes de produccion antes de trabajar. Cada usuario debe contar en su registro con una llave de paso equivalente al MD5 definido en este punto
		La llave de paso es utilizada tambien como una llave de consumo interno para WebServices.  Aunque se puede compartir con otros sitios o aplicativos, por seguridad se deberian utilizar llaves de paso generadas por el asistente.

		(start code)
			LlaveDePaso=''; //Predeterminado en vacio con MD5=d41d8cd98f00b204e9800998ecf8427e
		(end)
	*/

	\$NombreRAD='%s';
	\$ArchivoCORE='';
	\$TablasCore='%s';  // Cuidado al cambiar: Prefijo de Tablas base para uso de Practico
	\$TablasApp='%s';  // Cuidado al cambiar: Prefijo para Tablas de datos definidas por el usuario
	\$LlaveDePaso='%s';  // Valor unico para firmar los usuarios del aplicativo.  No debe ser cambiado despues de puesto en marcha a menos que se haga un update manual el usuario que no coincida con la llave no podra ingresar.
	\$ModoDepuracion=%s;
	\$BuscarActualizaciones=%s;
	\$ZonaHoraria='%s';
	\$IdiomaPredeterminado='%s';
	\$TipoCaptchaLogin='%s';
	\$CaracteresCaptcha=%s;
	
	// Tipo de motor usado para la autenticacion de usuarios
	\$Auth_TipoMotor='%s';
	\$Auth_ProtoTransporte='%s';
	\$PCO_ArchivoImagenFondo='';

	// Configuracion LDAP - Auth_TipoMotor=ldap
	\$Auth_TipoEncripcion='%s';
	\$Auth_LDAPServidor='%s';
	\$Auth_LDAPPuerto='%s';
	\$Auth_LDAPDominio='%s';
	\$Auth_LDAPOU='%s';
	
	// Especifica si desea activar o no el modulo de chat para usuarios asi:
	// 0=No, 1=Solo usuarios internos, 2=Solo usuarios externos, 3=Todos los usuarios, 4=Exclusivo para admin (podra iniciar conversacion y chat con cualquier otro usuario aun con modulo desactivado)
	\$Activar_ModuloChat=0;
	
	// Define cadena usada para separar campos en operaciones de bases de datos
	\$_SeparadorCampos_='||_||';
	\$ModoDesarrolladorPractico=0;

	// Define cadena separada por comas con usuarios administradores de la aplicacion
	\$PCOVAR_Administradores='admin';",$ServidorNEW,$BaseDatosNEW,$UsuarioBDNEW,$PasswordBDNEW,$MotorBDNEW,$PuertoBDNEW,$NombreRADNEW,$TablasCoreNEW,$TablasAppNEW,$LlaveDePasoNEW,$ModoDepuracionNEW,$BuscarActualizacionesNEW,$ZonaHorariaNEW,$IdiomaPredeterminadoNEW,$TipoCaptchaLoginNEW,$CaracteresCaptchaNEW,$Auth_TipoMotorNEW,$Auth_ProtoTransporteNEW,$Auth_TipoEncripcionNEW,$Auth_LDAPServidorNEW,$Auth_LDAPPuertoNEW,$Auth_LDAPDominioNEW,$Auth_LDAPOUNEW);
	// Escribe el archivo de configuracion
	$archivo_config=fopen("../core/configuracion.php","w");
	if($archivo_config==null)
		{
			$hay_error=1;
			echo $MULTILANG_ErrorEscribirConfig;
		}
	else
		{
			fwrite($archivo_config,$salida,strlen($salida)); 
			fclose($archivo_config);
		}
	
	//Si no hay errores creando el archvio continua con la BD
	if (!$hay_error)
		{
			include("../core/configuracion.php");
			include("../core/conexiones.php");
			if ($hay_error)
				{
					echo $MULTILANG_ErrorConexBD;
				}
		}

	// Si no se encontro ningun error muestra mensaje OK
	if (!$hay_error)
        PCO_Mensaje('<i class="fa fa-check-circle-o fa-4x text-info"></i> ', $MULTILANG_InfoPaso3, '', '', 'alert alert-info alert-dismissible');

?>

<br><br>
</div>

<?php
	PCO_AbrirBarraEstado();

	$anterior=$paso-1;
	$siguiente=$paso+1;
	echo '<form name="regresar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			<input type="Hidden" name="paso" value="'.$anterior.'">
			<input type="Hidden" name="Idioma" value="'.$Idioma.'">
			<input type="Button" class="btn btn-danger" value=" <<< '.$MULTILANG_Anterior.' " onclick="document.regresar.submit();">
		  </form>';

	if (!$hay_error)
		{
			echo '<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="paso" value="'.$siguiente.'">
				<input type="Hidden" name="aplicar_script_basedatos" value="1">
				<input type="Hidden" name="Idioma" value="'.$Idioma.'">
				<input type="Hidden" name="NombreCortoEmpresa" value="'.$NombreCortoEmpresa.'">
				<input type="Hidden" name="NombreAplicacion" value="'.$NombreAplicacion.'">
				<input type="Hidden" name="VersionAplicacion" value="'.$VersionAplicacion.'">
				<input type="Submit" class="btn btn-success" value=" '.$MULTILANG_BtnAplicarBD.' >>> " onclick="document.continuar.submit();">
				</form>';

			echo '<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="paso" value="'.$siguiente.'">
				<input type="Hidden" name="Idioma" value="'.$Idioma.'">
				<input type="Hidden" name="aplicar_script_basedatos" value="0">
				<input type="Submit" class="btn btn-info" value=" '.$MULTILANG_BtnNoAplicarBD.' >>> "  onclick="document.continuar.submit();">
				</form>';
		}
	PCO_CerrarBarraEstado();
?>