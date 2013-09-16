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
		Title: Modulo objetos
		Ubicacion *[/core/objetos.php]*.  Archivo de funciones relacionadas con las operaciones de objetos generados por la herramienta
	*/



/* ################################################################## */
/* ################################################################## */
	if ($accion=="cargar_objeto")
		{
			/*
				Function: cargar_objeto
				Abre los objetos creados con practico como formularios, informes, etc.

				Variables de entrada:

					objeto - Cadena con la representacion del objeto en formato frm:xxx  inf:xxx   o similares donde se pueden tener multiples parametros separados por el caracter de *dos puntos*.  El primer parametro indicado despues del tipo de objeto indica el ID interno del objeto creado por practico.

				Codigo de ejemplo para llamadas a objetos comunes:

					(start code)
						frm:1:1:documento:123  //Llama al formulario con id=1, dentro de una ventana y buscando por el valor 123 en el campo documento
						inf:1:1:htm:Informes:0 //Llama el informe con id=1, dentro de una ventana, en formato HTML con el estilo CSS Informes y sin ser embebido
					(end)

				Parametros adicionales para formularios:
					
					parametros[2] - indica si es cargado en ventana o escritorio
					parametros[3] - campo a usar Si se llena el form desde un registro
					parametros[4] - valor a comparar para el campo de busqueda

				Parametros adicionales para informes:
					parametros[2] - indica si es cargado en ventana o escritorio
					parametros[3] - Formato utilizado para desplegar el informe: htm, xls
					parametros[4] - Estilo CSS utilizado para presentar el informe en caso de ser formato htm
					parametros[5] - Embebido? Si=1, No=0

				Salida:

					Objeto indicado por la variable de entrada cargado en pantalla mediante llamado a la funcion correspondiente.

				Ver tambien:
					<cargar_formulario> | <cargar_informe>
			*/

			$mensaje_error="";

			//Divide la cadena de objeto en partes conocidas
			$partes_objeto = explode(":", $objeto);
			if ($partes_objeto[0]!="frm" && $partes_objeto[0]!="inf")
				$mensaje_error=$MULTILANG_ObjError.": ".$partes_objeto[0];

			if ($mensaje_error=="")
				{
					//Si es un formulario lo llama con sus parámetros
					if ($partes_objeto[0]=="frm")
						{
							//Evalua si fueron enviados parametros adicionales
							if (@$partes_objeto[2]!="") $en_ventana=$partes_objeto[2];
							if (@$partes_objeto[3]!="") $campobase =$partes_objeto[3]; 
							if (@$partes_objeto[4]!="") $valorbase =$partes_objeto[4];
							cargar_formulario($partes_objeto[1],@$en_ventana,@$campobase,@$valorbase);
						}
					//Si es un informe lo llama con sus parámetros
					if ($partes_objeto[0]=="inf")
						{
							if (@$partes_objeto[2]!="") $en_ventana=$partes_objeto[2];
							if (@$partes_objeto[3]!="") $formato =$partes_objeto[3];
							if (@$partes_objeto[4]!="") $estilo =$partes_objeto[4];
							if (@$partes_objeto[5]!="") $embebido =$partes_objeto[5];
							cargar_informe($partes_objeto[1],@$en_ventana,@$formato,@$estilo,@$embebido);
						}
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="Ver_menu">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorTiempoEjecucion.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}

/* ################################################################## */
/* ################################################################## */
	if ($accion=="guardar_configuracion")
		{
			/*
				Function: guardar_configuracion
				Actualiza los valores del archivo core/configuracion.php con los ingresados en el formulario por el administrador.  El archivo debe contar con permisos suficientes para que el usuario que ejecuta el servicio web pueda escribirlo.

				Variables de entrada:

					variables desde formulario

				Salida:

					Archivo de configuracion actualizado con los nuevos parametros
			*/

			$mensaje_error="";

			$hay_error=0;
			// Crea la cadena de salida con la configuracion de practico
$salida=sprintf("<?php
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


		Title: Configuracion base
		Ubicacion *[/core/configuracion.php]*.  Archivo que contiene la declaracion de variables basicas para conexion a bases de datos y otros

		Section: Variables de conexion

		Crea las variables de conexion para el motor de bases de datos, segmentos de direcciones, etc.  Ver ejemplo:

		(start code)
			$Servidor='localhost'; // Define servidor de bases de datos
			$BaseDatos='practico'; // Nombre de la base de datos a utilizar
			$UsuarioBD='root'; // Usuario con privilegios suficientes para crear/eliminar tablas y realizar operaciones con registros
			$PasswordBD='toor'; // Contrasena del usuario para accesar al motor
		(end)
	*/

	\$ServidorBD='%s';
	\$BaseDatos='%s';   // Path completo cuando se trata de sqlite2, ej: '/path/to/database.sdb'
	\$UsuarioBD='%s';
	\$PasswordBD='%s';
	\$MotorBD='%s';
	\$PuertoBD='%s';

	/*
		Section: Variables para aplicacion

		(start code)
			$NombreRAD='Pr&aacute;ctico';  // Nombre del aplicativo
			$VersionRAD='11.06';           // Version del aplicativo
			$PlantillaActiva='nomo';       // Mascara visual con la definicion de hojas CSS e imagenes.  Ubicada en /skin
			$ArchivoCORE='';               // Script que procesa todos los formularios. Vacio para la misma pagina o index.php

			$TablasCore='Core_';		   // Prefijo de Tablas base para uso de Practico (Cuidado al cambiar)
			$TablasApp='App_';			   // Prefijo de Tablas de datos definidas por el usuario (Cuidado al cambiar)
		(end)

		*Llave de paso*

		Establezca cualquier valor en la siguiente variable para reforzar la seguridad. Cambiar esto despues de tener usuarios creados puede afectar la autenticacion
		Se recomienda establecer una llave en ambientes de produccion antes de trabajar. Cada usuario debe contar en su registro con una llave de paso equivalente al MD5 definido en este punto

		(start code)
			$LlaveDePaso=''; //Predeterminado en vacio con MD5=d41d8cd98f00b204e9800998ecf8427e
		(end)
	*/

	\$NombreRAD='%s';
	\$PlantillaActiva='%s';
	\$ArchivoCORE='';
	\$TablasCore='%s';  // Cuidado al cambiar: Prefijo de Tablas base para uso de Practico
	\$TablasApp='%s';  // Cuidado al cambiar: Prefijo para Tablas de datos definidas por el usuario
	\$LlaveDePaso='%s';  // Valor unico para firmar los usuarios del aplicativo.  No debe ser cambiado despues de puesto en marcha a menos que se haga un update manual el usuario que no coincida con la llave no podra ingresar.
	\$ModoDepuracion=%s;
	\$ZonaHoraria='%s';
	\$IdiomaPredeterminado='%s';
	\$CaracteresCaptcha=%s;
	\$Auth_TipoMotor='%s';
	\$Auth_TipoEncripcion='%s';
	\$Auth_LDAPServidor='%s';
	\$Auth_LDAPPuerto='%s';
	\$Auth_LDAPDominio='%s';
	\$Auth_LDAPOU='%s';",$ServidorNEW,$BaseDatosNEW,$UsuarioBDNEW,$PasswordBDNEW,$MotorBDNEW,$PuertoBDNEW,$NombreRADNEW,$PlantillaActivaNEW,$TablasCoreNEW,$TablasAppNEW,$LlaveDePasoNEW,$ModoDepuracionNEW,$ZonaHorariaNEW,$IdiomaPredeterminadoNEW,$CaracteresCaptchaNEW,$Auth_TipoMotorNEW,$Auth_TipoEncripcionNEW,$Auth_LDAPServidorNEW,$Auth_LDAPPuertoNEW,$Auth_LDAPDominioNEW,$Auth_LDAPOUNEW);
			// Escribe el archivo de configuracion
			$archivo_config=fopen("core/configuracion.php","w");
			if($archivo_config==null)
				{
					$hay_error=1;
					$mensaje_error=$MULTILANG_ErrorEscribirConfig;
				}
			else
				{
					fwrite($archivo_config,$salida,strlen($salida)); 
					fclose($archivo_config);
				}
			if ($mensaje_error=="")
				{
					echo '<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="Ver_menu">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorTiempoEjecucion.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
	if ($accion=="guardar_configws")
		{
			/*
				Function: guardar_configws
				Actualiza las configuraciones y llaves asociadas a los webservices

				Variables de entrada:

					llaves_activas - Lista de llaves autorizadas para consumir webservices

				Salida:

					Archivo de definicion de llaves actualizado
			*/

			$mensaje_error="";
			$hay_error=0;

			// Crea la cadena de salida con las llaves
			$salida = str_replace("\r\n", "|", $llaves_definidas);
			$arreglo_llaves=explode("|",$salida);
			$salida="<?php
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


		Title: Definicion de llaves
		Ubicacion *[/core/ws_llaves.php]*.  Archivo que contiene la definicion de llaves para consumidores de WebServices

	*/


";
			for ($r=0;$r<count($arreglo_llaves);$r++)
				if (trim($arreglo_llaves[$r])!="")
					$salida.="	\$Auth_WSKeys[]='".trim($arreglo_llaves[$r])."';\n";

			// Escribe el archivo de configuracion
			$archivo_config=fopen("core/ws_llaves.php","w");
			if($archivo_config==null)
				{
					$hay_error=1;
					$mensaje_error=$MULTILANG_ErrorEscribirConfig;
				}
			else
				{
					fwrite($archivo_config,$salida,strlen($salida)); 
					fclose($archivo_config);
				}
			if ($mensaje_error=="")
				{
					echo '<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="Ver_menu">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorTiempoEjecucion.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}
?>
