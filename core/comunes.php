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
		Title: Libreria base 
		Ubicacion *[/core/comunes.php]*.  Archivo que contiene las funciones de uso global.
	*/
	/*
		Section: Funciones asociadas a las operaciones con bases de datos - Ejecucion de consultas
	*/

/* ################################################################## */
/* ################################################################## */
	function ejecutar_sql($query,$param="")
		{
			/*
				Function: ejecutar_sql
				Ejecuta consultas que retornan registros (SELECTs).

				Variables de entrada:

					query - Consulta preformateada para ser ejecutada en el motor
					param - Lista de parametros que deben ser preparados para el query separados por coma
					
				Salida:
					Retorna mensaje en pantalla con la descripcion devuelta por el driver en caso de error
					Retorna una variable con el arreglo de resultados en caso de ser exitosa la consulta
			*/
			global $ConexionPDO;
			global $MULTILANG_ErrorTiempoEjecucion,$MULTILANG_Detalles;
			try
				{
					$consulta = $ConexionPDO->prepare($query);
					$consulta->execute();
					return $consulta;
					//return $consulta->fetchAll();
				}
			catch( PDOException $ErrorPDO)
				{
					mensaje($MULTILANG_ErrorTiempoEjecucion,$ErrorPDO->getMessage().'<br><b>'.$MULTILANG_Detalles.'</b>: '.$query,'80%','icono_error.png','TextosEscritorio');
					return 1;
				}
		}



/* ################################################################## */
/* ################################################################## */
	function ejecutar_sql_unaria($query,$param="")
		{
			/*
				Function: ejecutar_sql_unaria
				Ejecuta consultas que no retornan registros tales como CREATE, INSERT, DELETE, UPDATE entre otros.

				Variables de entrada:

					query - Consulta preformateada para ser ejecutada en el motor
					param - Lista de parametros que deben ser preparados para el query separados por coma

				Salida:
					Retorna una cadena que contiene una descripcion de error PDO en caso de error y agrega un mensaje en pantalla con la descripcion devuelta por el driver
					Retorna una cadena vacia si la consulta es ejecutada sin problemas.
			*/
			global $ConexionPDO;
			try
				{
					$consulta = $ConexionPDO->prepare($query);
					$consulta->execute();
					return "";
				}
			catch( PDOException $ErrorPDO)
				{
					echo '<script language="JavaScript"> alert("'.$MULTILANG_ErrorTiempoEjecucion.'\n'.$MULTILANG_Detalles.': '.$query.'\n\n'.$MULTILANG_MotorBD.': '.$ErrorPDO->getMessage().'.\n\n'.$MULTILANG_ContacteAdmin.'");  </script>';
					//mensaje('Error durante la ejecuci&oacute;n',$ErrorPDO->getMessage(),'90%','icono_error.png','TextosEscritorio');
					return $ErrorPDO->getMessage();
				}
		}



/* ################################################################## */
/* ################################################################## */
	function ejecutar_sql_procedimiento($procedimiento)
		{
			/*
				Function: ejecutar_sql_procedimiento
				Ejecuta procedimientos almacenados por la base de datos

				Variables de entrada:

					procedimiento - Procedimiento que debe residir en la base de datos y que ha de ser ejecutado

				Salida:
					Retorna 0 en caso de tener problemas con la ejecucion del procedimiento
					Retorna una cadena vacia si el procedimiento es llamado y ejecutado sin problemas
			*/
			global $ConexionPDO;
			try
				{
					$ConexionPDO->exec($procedimiento);
					return "";
				}
			catch(PDOException $e)
				{
					return $e->getMessage();
				}
		}





/* ################################################################## */
/* ################################################################## */
/*
	Function: auditar
	Lleva un registro de auditoria en el sistema

	Variables de entrada:

		accion - Descripcion de la accion a ser almacenada en la auditoria

	(start code)

	(end)

	Salida:

		Registro de auditoria llevado sobre la tabla
*/
	function auditar($accion)
		{
			global $ConexionPDO,$ArchivoCORE,$TablasCore;
			global $ListaCamposSinID_auditoria;
			global $Login_usuario,$fecha_operacion,$hora_operacion;
			//Lleva el registro
			ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria (".$ListaCamposSinID_auditoria.") VALUES ('$Login_usuario','$accion','$fecha_operacion','$hora_operacion')");
		}



/* ################################################################## */
/* ################################################################## */
	function existe_valor($tabla,$campo,$valor)
		{
			/*
				Function: existe_valor
				Busca dentro de alguna tabla para verificar si existe o no un valor determinado.  Funcion utilizada para validacion de unicidad de valores en formularios de datos.
				
				Variables de entrada:

					tabla - Nombre de la tabla donde se desea buscar.
					campo - Campo de la tabla sobre el cual se desea comparar la existencia del valor.
					valor - Valor a buscar dentro del campo.
					
				Salida:
					Retorna 1 en caso de encontrar un valor dentro de la tabla y campo especificadas y que coincida con el parametro buscado
					Retorna 0 cuando no se encuentra un valor en la tabla que coincida con el buscado
			*/
			global $ConexionPDO;
			$consulta = $ConexionPDO->prepare("SELECT $campo FROM $tabla WHERE $campo='$valor'");
			$consulta->execute();
			$registro = $consulta->fetch();
			if ($registro[0]!="")
				{
					return 1;
				}
			else
				{
					return 0;
				}
		}



/* ################################################################## */
/* ################################################################## */
	/*
		Section: Funciones asociadas al retorno de informacion sobre la conexion y estructura de la BD
	*/
/* ################################################################## */
/* ################################################################## */
	function informacion_conexion()
		{
			/*
				Function: informacion_conexion
				Imprime la informacion asociada a la conexion establecida mediante PDO.

				Ver tambien:
				<imprimir_drivers_disponibles> | <Definicion de conexion PDO>
			*/
			echo "<hr><center><blink><b><font color=yellow>".$MULTILANG_Detalles.":</font></b></blink><br>";
			echo $MULTILANG_Controlador.': '.$ConexionPDO->getAttribute(PDO::ATTR_DRIVER_NAME).'<br>';
			echo $MULTILANG_Version.' '.$MULTILANG_Servidor.': '.$ConexionPDO->getAttribute(PDO::ATTR_SERVER_VERSION).'<br>';
			echo $MULTILANG_Estado.': '.$ConexionPDO->getAttribute(PDO::ATTR_CONNECTION_STATUS).'<br>';
			echo $MULTILANG_Version.' '.$MULTILANG_Cliente.': '.$ConexionPDO->getAttribute(PDO::ATTR_CLIENT_VERSION).'<br>';
			echo $MULTILANG_InfoAdicional.': '.$ConexionPDO->getAttribute(PDO::ATTR_SERVER_INFO).'<hr>';
		}



/* ################################################################## */
/* ################################################################## */
	function imprimir_drivers_disponibles()
		{
			/*
				Function: imprimir_drivers_disponibles
				Imprime el arreglo devuelto por la funcion getAvailableDrivers() para conocer los drivers soportados por la instalacion actual de PHP del lado del servidor.

				Salida:
					Listado de drivers PDO soportados
				
				Ver tambien:
				<informacion_conexion>
			*/
			
			/*foreach(PDO::getAvailableDrivers() as $driver)
				{
					echo "<hr>".$driver;
				}*/
			print_r(PDO::getAvailableDrivers());
		}



/* ################################################################## */
/* ################################################################## */
	function consultar_tablas($prefijo="")
		{
			/*
				Function: consultar_tablas
				Determina las tablas en la base de datos activa para la conexion dependiendo del motor utilizado.

				Variables de entrada:

					prefijo - Prefijo del nombre de tablas que seran retornadas

				Salida:
					Resultado de un query con las tablas  o falso en caso de error
				
				Ver tambien:
				<Definicion de conexion PDO>
			*/
			global $ConexionPDO;
			global $MotorBD;
			global $BaseDatos;
			global $MULTILANG_ErrorTiempoEjecucion;

			if($MotorBD=="sqlsrv" || $MotorBD=="mssql" || $MotorBD=="ibm" || $MotorBD=="dblib" || $MotorBD=="odbc" || $MotorBD=="sqlite")
					$consulta = "SELECT name FROM sysobjects WHERE xtype='U';";
			if($MotorBD=="oracle")
					$consulta = "SELECT table_name FROM cat;";  //  Si falla probar con esta:  $consulta = "SELECT table_name FROM tabs;";
			if($MotorBD=="ifmx" || $MotorBD=="fbd")
					$consulta = "SELECT RDB$RELATION_NAME FROM RDB$RELATIONS WHERE RDB$SYSTEM_FLAG = 0 AND RDB$VIEW_BLR IS NULL ORDER BY RDB$RELATION_NAME;";
			if($MotorBD=="mysql")
					$consulta = "SHOW tables FROM ".$BaseDatos." ";
			if($MotorBD=="pgsql")
					$consulta = "SELECT relname AS name FROM pg_stat_user_tables ORDER BY relname;";

			try
				{
					$consulta_tablas=ejecutar_sql($consulta);
					return $consulta_tablas;
				}
			catch( PDOException $ErrorPDO)
				{
					mensaje($MULTILANG_ErrorTiempoEjecucion,$ErrorPDO->getMessage(),'90%','icono_error.png','TextosEscritorio');
					return false;
				}
		}



/* ################################################################## */
/* ################################################################## */
	function consultar_columnas($tabla)
		{
			/*
				Function: consultar_columnas
				Devuelve un vector con los nombres de las columnas de una tabla

				Variables de entrada:

					tabla - Nombre de la tabla de la que se desea consultar los nombre de columnas o campos
					
				Salida:
					Vector de campos/columnas
				
				Ver tambien:
				<consultar_tablas>
			*/
			$resultado=ejecutar_sql("SELECT * FROM ".$tabla);
			$columnas = array();
			foreach($resultado->fetch(PDO::FETCH_ASSOC) as $key=>$val)
				{
					$columnas[] = $key;
				}
			return $columnas;
		}



/* ################################################################## */
/* ################################################################## */
	function verificar_extensiones()
		{
			/*
				Function: verificar_extensiones
				Verifica si las extensiones minimas requeridas por la herramienta se encuentran activadas y despliega mensaje de error si aplica.
					
				Salida:
					Mensajes de error asociados a la no activacion de cada extension
			*/
			global $MotorBD;
			global $Auth_TipoMotor;
			global $Auth_TipoEncripcion;
			global $MULTILANG_ErrExtension,$MULTILANG_ErrLDAP,$MULTILANG_ErrHASH,$MULTILANG_ErrSESS,$MULTILANG_ErrGD,$MULTILANG_ErrPDO,$MULTILANG_ErrDriverPDO;
			
			//Verifica soporte para LDAP cuando esta activado en la herramienta
			if ($Auth_TipoMotor=='ldap' &&  !extension_loaded('ldap'))
				mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrLDAP,'','icono_error.png','TextosEscritorio');

			//Verifica soporte para HASH cuando se requiere encripcion
			if ($Auth_TipoEncripcion!="plano" && !extension_loaded('hash'))
				mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrHASH,'','icono_error.png','TextosEscritorio');

			//Verifica soporte para sesiones
			if (!extension_loaded('session'))
				mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrSESS,'','icono_error.png','TextosEscritorio');

			//Verifica soporte para GD2
			if (!extension_loaded('gd'))
				mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrGD,'','icono_error.png','TextosEscritorio');

			//Verifica soporte para PDO
			if (!extension_loaded('pdo'))
				mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrPDO,'','icono_error.png','TextosEscritorio');

			//Verifica soporte para el driver PDO correspondiente al motor utilizado
			if (!extension_loaded('pdo_'.$MotorBD))
				mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrDriverPDO,'','icono_error.png','TextosEscritorio');
		}


/* ################################################################## */
/* ################################################################## */
	function consultar_bases_de_datos()
		{
			/*
				Function: consultar_bases_de_datos
				Determina las bases de datos existentes dependiendo del motor utilizado.

				Salida:
					Resultado de un query con las bases de datos o falso en caso de error
				
				Ver tambien:
				<Definicion de conexion PDO> | <consultar_tablas>
			*/
			global $ConexionPDO;
			global $MotorBD;
			global $BaseDatos;
			global $MULTILANG_ErrorTiempoEjecucion;

			if($MotorBD=="sqlsrv" || $MotorBD=="mssql" || $MotorBD=="ibm" || $MotorBD=="dblib" || $MotorBD=="odbc" || $MotorBD=="sqlite2" || $MotorBD=="sqlite3")
				$consulta = "SELECT name FROM sys.Databases;";
			if($MotorBD=="oracle")
				$consulta = 'SELECT * FROM v$database;';  //Si falla intentar con este: $consulta = "SELECT * FROM user_tablespaces";
			if($MotorBD=="ifmx" || $dbtype=="fbd")
				$consulta = "";
			if($MotorBD=="mysql")
				$consulta = "SHOW DATABASES;";
			if($MotorBD=="pg")
				$consulta = "SELECT datname AS name FROM pg_database;";

			try
				{
					$consulta_basesdatos = $ConexionPDO->prepare($consulta);
					$consulta_basesdatos->execute();
					return $consulta_basesdatos;
				}
			catch( PDOException $ErrorPDO)
				{
					mensaje($MULTILANG_ErrorTiempoEjecucion,$ErrorPDO->getMessage(),'90%','icono_error.png','TextosEscritorio');
					return false;
				}
	}



/* ################################################################## */
/* ################################################################## */
	function ContarRegistros($tabla)
		{
			global $ConexionPDO;
			$consulta = $ConexionPDO->prepare("SELECT count(*) FROM $tabla");
			$consulta->execute();
			$filas = $consulta->fetchColumn();
			return $filas;
		}



/* ################################################################## */
/* ################################################################## */
	/*
		Section: Funciones asociadas a la creacion de elementos graficos (ventanas, etc)
	*/
/* ################################################################## */
/* ################################################################## */
	function ventana_login()
	  {
		/*
			Function: ventana_login
			Despliega la ventana de ingreso al sistema con el formulario para usuario, contrasena y captcha.
		*/
		  global $ArchivoCORE;
		  global $MULTILANG_Usuario,$MULTILANG_Contrasena,$MULTILANG_CodigoSeguridad,$MULTILANG_IngreseCodigoSeguridad,$MULTILANG_TituloLogin,$MULTILANG_Importante,$MULTILANG_AccesoExclusivo,$MULTILANG_Ingresar;
			echo '
					<br><br>
					<div align="center">
					';
			abrir_ventana($MULTILANG_TituloLogin,'#EADEDE','620');
			?>
						<div align="center">
						<form name="login_usuario" method="POST" action="<?php echo $ArchivoCORE; ?>" style="margin-top: 0px; margin-bottom: 0px;" onsubmit="if (document.login_usuario.captcha.value=='' || document.login_usuario.uid.value=='' || document.login_usuario.clave.value=='') { alert('Debe diligenciar los valores necesarios (Usuario, Clave y Codigo de seguridad).'); return false; }">
						<input type="Hidden" name="accion" value="Iniciar_login">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr>
								<td align="center">
										<table width="100%" border="0" cellspacing="10" cellpadding="0" class="TextosVentana" align="center">
										<tr>
											<td align="right"><font face="Verdana,Tahoma, Arial" style="font-size: 9px;"><?php echo $MULTILANG_Usuario; ?>&nbsp;</td>
											<td><input type="text" name="uid" size="18" class="CampoTexto" class="keyboardInput"></td>
										</tr>
										<tr>
											<td align="right"><font face="Verdana,Tahoma, Arial" style="font-size: 9px;"><?php echo $MULTILANG_Contrasena; ?>&nbsp;</td>
											<td><input type="password" name="clave" size="18" class="CampoTexto keyboardInput" class="keyboardInput" style="border-width: 1px; font-size: 9px; font-family: VErdana, Tahoma, Arial;"></td>
										</tr>
										<tr>
											<td align="right" valign="middle"><font face="Verdana,Tahoma, Arial" style="font-size: 9px;"><?php echo $MULTILANG_CodigoSeguridad; ?></td>
											<td valign="middle">
											<img src="core/captcha.php">
											</td>
										</tr>
										<tr>
											<td width="150" align="right" valign="middle"><font face="Verdana,Tahoma, Arial" style="font-size: 9px;"><?php echo $MULTILANG_IngreseCodigoSeguridad; ?></td>
											<td valign="middle">
											<img src="img/tango_go-next.png" align="absmiddle"> <input type="text" name="captcha" size="7" maxlength=6 style="border-width: 1px; font-size: 9px; font-family: VErdana, Tahoma, Arial;">
											</td>
										</tr>
										<tr>
											<td></td>
											<td>
												<input type="Submit"  class="Botones" value=" <?php echo $MULTILANG_Ingresar; ?> >>>" >
											</td>
										</tr>
										</table>
								</td>
								<td align="center">
										<img src="img/practico_login.png" alt="" border="0">
								</td>
						</tr></table>
						</form>
						<script language="JavaScript"> login_usuario.uid.focus(); </script>
						</div>
						
			<?php
			mensaje($MULTILANG_Importante,$MULTILANG_AccesoExclusivo,'100%','../img/tango_dialog-information.png','TextosVentana');
			cerrar_ventana();
			echo '</div>';
	  }



/* ################################################################## */
/* ################################################################## */
	function abrir_ventana($titulo,$fondo,$ancho='100%')
	  {
		global $PlantillaActiva;
		/*
			Procedure: abrir_ventana
			Abre los espacios de trabajo dinamicos sobre el contenedor principal donde se despliega informacion

			Variables de entrada:

				titulo - Nombre de la ventana a visualizar en la parte superior.  Acepta modificadores HTML.
				fondo - Color de fondo de la ventana en formato Hexadecimal. Si no es enviado se crea transparente.  Si llega un nombre de imagen es usado.
				ancho - Ancho del espacio de trabajo definido en pixels o porcentaje sobre el contenedor principal.
				
			Ver tambien:
			<cerrar_ventana>	
		*/

		// Determina si fue enviado un nombre de archivo como fondo y lo usa
		$ruta_fondo_imagen='';
		$color_fondo='';
		if (strpos($fondo, ".png") || strpos($fondo, ".jpg") || strpos($fondo, ".gif"))
			$ruta_fondo_imagen='skin/'.$PlantillaActiva.'/img/'.$fondo;
		else
			$color_fondo=$fondo;

		echo '
			<table width="'.$ancho.'" border="0" cellspacing="0" cellpadding="0" class="EstiloVentana">
				<tr>
					<td>
							<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
									<td><img src="skin/'.$PlantillaActiva.'/img/bar_i.gif" border=0 alt=" "></td>
									<td width="100%" align="CENTER" background="skin/'.$PlantillaActiva.'/img/bar_c.jpg">
										<font face="" style="font-family: Verdana, Tahoma, Arial; font-size: 10px; color: Black;"><b>
												'.$titulo.'
										</b></font>
									</td>
									<td><img src="skin/'.$PlantillaActiva.'/img/bar_d.gif " border=0 alt=""></td>
							</tr></table>
					</td>
				</tr>
				<tr>
					<td width="100%" align="CENTER">
							<table width="100%" border="1" cellspacing="0" cellpadding="0" align="center"  bgcolor="'.$color_fondo.'" BACKGROUND="'.$ruta_fondo_imagen.'" class="TextosVentana"><tr><td>
				';
	  }



/* ################################################################## */
/* ################################################################## */
	function cerrar_ventana()
	  {
		/*
			Function: cerrar_ventana
			Cierra los espacios de trabajo dinamicos generados por <abrir_ventana>	

			Ver tambien:
			<abrir_ventana>	
		*/
			echo '
							</td></tr></table>
					</td>
				</tr>
			</table>
				';		  
	  }



/* ################################################################## */
/* ################################################################## */
	function abrir_barra_estado($alineacion="CENTER")
	  {
		 global $PlantillaActiva;
		/*
			Procedure: abrir_barra_estado
			Abre los espacios para despliegue de informacion en la parte inferior de los objetos tales como botones o mensajes

			Variables de entrada:

				alineacion - Alineacion que tendran los objetos en la barra (center, left, right).  Por defecto CENTER cuando no es recibido el parametro
				
			Ver tambien:
			<cerrar_barra_estado>	
		*/

		echo '
			<table width="100%" border="0" cellspacing="0" cellpadding="1" class="EstiloBarraEstado">
				<tr>
					<td width="100%" align="'.$alineacion.'">
				';
	  }



/* ################################################################## */
/* ################################################################## */
	function obtener_microtime()
		{
		/*
			Function: obtener_microtime
			Obtiene un tiempo en microsegundos utilizado para calcular tiempos de inicio y fin de operaciones
		*/
			list($useg, $seg) = explode(" ", microtime());
			return ((float)$useg + (float)$seg);
		}



/* ################################################################## */
/* ################################################################## */
	function cerrar_barra_estado()
	  {
		/*
			Function: cerrar_barra_estado
			Cierra los espacios de trabajo dinamicos generados por <abrir_barra_estado>

			Ver tambien:
			<abrir_barra_estado>	
		*/
			echo '
					</td>
				</tr>
			</table>
				';		  
	  }



/* ################################################################## */
/* ################################################################## */
	function mensaje($titulo,$texto,$ancho,$icono,$estilo)
	  {
		/*
			Function: mensaje
			Funcion generica para la presentacion de mensajes.  Ver variables para personalizacion.

			Variables de entrada:

				titulo - Texto que aparece en resaltado como encabezado del texto.  Acepta modificadores HTML.
				texto - Mensaje completo a desplegar en formato de texto normal.  Acepta modificadores HTML.
				icono - Imagen que acompana el texto ubicada al lado izquierdo.  Tamano y formato libre.
				ancho - Ancho del espacio de trabajo definido en pixels o porcentaje sobre el contenedor principal.
				estilo - Especifica el punto donde sera publicado el mensaje para definir la hoja de estilos correspondiente.
		*/
		echo '<table width="'.$ancho.'" border="0" cellspacing="5" cellpadding="0" align="center" class="'.$estilo.'">
				<tr>
					<td valign="top"><img src="img/'.$icono.'" alt="" border="0">
					</td>
					<td valign="top"><strong>'.$titulo.':<br></strong>
					'.$texto.'
					</td>
				</tr>
			</table>';
	  }


/* ################################################################## */
/* ################################################################## */
/*
	Function: cargar_objeto_texto_corto
	Genera el codigo HTML y CSS correspondiente a un campo de texto (text) vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos
		formulario - ID unico del formulario al cual pertenece el objeto

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<cargar_formulario>
*/
	function cargar_objeto_texto_corto($registro_campos,$registro_datos_formulario,$formulario,$en_ventana)
		{
			global $campobase,$valorbase;
			global $MULTILANG_TitValorUnico,$MULTILANG_DesValorUnico,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio;

			$salida='';
			$nombre_campo=$registro_campos["campo"];
			$tipo_entrada="text"; // Se cambia a date si se trata de un campo con validacion de fecha

			// Especifica longitud visual de campo en caso de haber sido definida
			$cadena_longitud_visual=' size="20" ';
			if ($registro_campos["ancho"]!="0")
				$cadena_longitud_visual=' size="'.$registro_campos["ancho"].'" ';

			// Especifica longitud maxima de caracteres en caso de haber sido definida
			$cadena_longitud_permitida=' ';
			if ($registro_campos["maxima_longitud"]!=0)
				$cadena_longitud_permitida=' maxlength="'.$registro_campos["maxima_longitud"].'" ';

			// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
			$cadena_valor='';
			if ($registro_campos["valor_predeterminado"]!="") $cadena_valor=' value="'.$registro_campos["valor_predeterminado"].'" ';
			if ($campobase!="" && $valorbase!="") $cadena_valor=' value="'.$registro_datos_formulario["$nombre_campo"].'" ';

			// Define cadenas en caso de tener validaciones
			$cadena_validacion='';
			$cadena_fechas='';
			if ($registro_campos["validacion_datos"]!="" && $registro_campos["validacion_datos"]!="fecha")
				$cadena_validacion=' onkeypress="return validar_teclado(event, \''.$registro_campos["validacion_datos"].'\');" ';
			if ($registro_campos["validacion_datos"]=="fecha")
				{
					$cadena_longitud_visual=' size="11" ';
					$tipo_entrada="date";
				}

			// Define si muestra o no teclado virtual
			$cadena_clase_teclado="";
			if ($registro_campos["teclado_virtual"])
				$cadena_clase_teclado="keyboardInput";

			// Muestra el campo
			$salida.='<input type="'.$tipo_entrada.'" name="'.$registro_campos["campo"].'" '.$cadena_valor.' '.$cadena_longitud_visual.' '.$cadena_longitud_permitida.' class="CampoTexto '.$cadena_clase_teclado.'" '.$cadena_validacion.' '.$registro_campos["solo_lectura"].'  >';

			// Muestra boton de busqueda cuando el campo sea usado para esto
			if ($registro_campos["etiqueta_busqueda"]!="")
				{
					$salida.= '<input type="Button" class="BotonesEstado" value="'.$registro_campos["etiqueta_busqueda"].'" onclick="document.datos.valorbase.value=document.datos.'.$registro_campos["campo"].'.value;document.datos.accion.value=\'cargar_objeto\';document.datos.submit()">';
					$salida.= '<input type="hidden" name="objeto" value="frm:'.$formulario.'">';
					$salida.= '<input type="Hidden" name="en_ventana" value="'.$en_ventana.'" >';
					$salida.= '<input type="Hidden" name="campobase" value="'.$registro_campos["campo"].'" >';
					$salida.= '<input type="Hidden" name="valorbase" '.$cadena_valor.'>';
				}

			// Muestra indicadores de obligatoriedad o ayuda
			if ($registro_campos["valor_unico"] == "1") $salida.= '<a href="#" title="'.$MULTILANG_TitValorUnico.'" name="'.$MULTILANG_DesValorUnico.'"><img src="img/key.gif" border=0 border=0 align="absmiddle"></a>';
			if ($registro_campos["obligatorio"]) $salida.= '<a href="#" title="'.$MULTILANG_TitObligatorio.'" name="'.$MULTILANG_DesObligatorio.'"><img src="img/icn_12.gif" border=0 align="absmiddle"></a>';
			if ($registro_campos["ayuda_titulo"] != "") $salida.= '<a href="#" title="'.$registro_campos["ayuda_titulo"].'" name="'.$registro_campos["ayuda_texto"].'"><img src="img/icn_10.gif" border=0 border=0 align="absmiddle"></a>';
			return $salida;
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: cargar_objeto_texto_largo
	Genera el codigo HTML y CSS correspondiente a un campo de texto largo (textarea) vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<cargar_formulario>
*/
	function cargar_objeto_texto_largo($registro_campos,$registro_datos_formulario)
		{
			global $campobase,$valorbase;
			global $MULTILANG_TitValorUnico,$MULTILANG_DesValorUnico,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio;

			$salida='';
			$nombre_campo=$registro_campos["campo"];

			// Define cadenas de tamano de campo
			$cadena_ancho_visual=' cols="'.$registro_campos["ancho"].'" ';
			$cadena_alto_visual=' rows="'.$registro_campos["alto"].'" ';
			$cadena_longitud_visual=$cadena_ancho_visual.$cadena_alto_visual;

			// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
			$cadena_valor='';
			if ($registro_campos["valor_predeterminado"]!="") $cadena_valor=' value="'.$registro_campos["valor_predeterminado"].'" ';
			if ($campobase!="" && $valorbase!="") $cadena_valor=$registro_datos_formulario["$nombre_campo"];

			// Muestra el campo
			$salida.= '<textarea name="'.$registro_campos["campo"].'" '.$cadena_longitud_visual.' class="AreaTexto" '.$registro_campos["solo_lectura"].'  >'.$cadena_valor.'</textarea>';

			// Muestra indicadores de obligatoriedad o ayuda
			if ($registro_campos["obligatorio"]) $salida.= '<a href="#" title="'.$MULTILANG_TitObligatorio.'" name="'.$MULTILANG_DesObligatorio.'"><img src="img/icn_12.gif" border=0 align="absmiddle"></a>';
			if ($registro_campos["ayuda_titulo"] != "") $salida.= '<a href="#" title="'.$registro_campos["ayuda_titulo"].'" name="'.$registro_campos["ayuda_texto"].'"><img src="img/icn_10.gif" border=0 border=0 align="absmiddle"></a>';
			return $salida;
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: cargar_objeto_texto_formato
	Genera el codigo HTML y CSS correspondiente a un campo de texto largo (textarea alterado por CKEditor) vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos
		existe_campo_textoformato - Variable que determina si ya han sido cargadas las librerias del CKEditor para evitar una segunda carga y errores derivados de JavaScript

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<cargar_formulario>
*/
	function cargar_objeto_texto_formato($registro_campos,$registro_datos_formulario,$existe_campo_textoformato)
		{
			global $campobase,$valorbase;
			global $MULTILANG_TitValorUnico,$MULTILANG_DesValorUnico,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio;

			$salida='';
			$nombre_campo=$registro_campos["campo"];

			// Define cadenas de tamano de campo
			$cadena_ancho_visual=' cols="'.$registro_campos["ancho"].'" ';
			$cadena_alto_visual=' rows="'.$registro_campos["alto"].'" ';
			$cadena_longitud_visual=$cadena_ancho_visual.$cadena_alto_visual;

			// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
			$cadena_valor='';
			if ($registro_campos["valor_predeterminado"]!="") $cadena_valor=' value="'.$registro_campos["valor_predeterminado"].'" ';
			if ($campobase!="" && $valorbase!="") $cadena_valor=$registro_datos_formulario["$nombre_campo"];

			// Muestra el campo
			$salida.= '<textarea name="'.$registro_campos["campo"].'" '.$cadena_longitud_visual.' class="ckeditor" '.$registro_campos["solo_lectura"].'  >'.$cadena_valor.'</textarea>';
			
			// Define las barras posibles para el editor
			$barra_documento="['Source','-','NewPage','DocProps','Preview','Print','-','Templates']";
			$barra_basica="['Bold', 'Italic', 'Underline', 'Strike', 'Subscript','Superscript','-','RemoveFormat']";
			$barra_parrafo="['NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl']";
			$barra_enlaces="['Link','Unlink','Anchor']";
			$barra_estilos="['Styles','Format','Font','FontSize']";
			$barra_portapapeles="['Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo']";
			$barra_edicion="['Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt']";
			$barra_insertar="['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe']";
			$barra_colores="['TextColor','BGColor']";
			$barra_formularios="['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField']";
			$barra_otros="['Maximize', 'ShowBlocks']";

			// Construye las barras de herramientas de acuerdo a la seleccion del usuario
			$barra_editor.="['-']";
			if ($registro_campos["barra_herramientas"]=="0")
				{
					$barra_editor.=",".$barra_documento;
					$barra_editor.=",".$barra_basica;
					$barra_editor.=",".$barra_parrafo;
				}
			if ($registro_campos["barra_herramientas"]=="1")
				{
					$barra_editor.=",".$barra_documento;
					$barra_editor.=",".$barra_basica;
					$barra_editor.=",".$barra_parrafo;
					$barra_editor.=",".$barra_enlaces;
					$barra_editor.=",".$barra_estilos;
				}
			if ($registro_campos["barra_herramientas"]=="2")
				{
					$barra_editor.=",".$barra_documento;
					$barra_editor.=",".$barra_basica;
					$barra_editor.=",".$barra_parrafo;
					$barra_editor.=",".$barra_enlaces;
					$barra_editor.=",".$barra_estilos;
					$barra_editor.=",".$barra_portapapeles;
					$barra_editor.=",".$barra_edicion;
				}
			if ($registro_campos["barra_herramientas"]=="3")
				{
					$barra_editor.=",".$barra_documento;
					$barra_editor.=",".$barra_basica;
					$barra_editor.=",".$barra_parrafo;
					$barra_editor.=",".$barra_enlaces;
					$barra_editor.=",".$barra_estilos;
					$barra_editor.=",".$barra_portapapeles;
					$barra_editor.=",".$barra_edicion;
					$barra_editor.=",".$barra_insertar;
					$barra_editor.=",".$barra_colores;
				}
			if ($registro_campos["barra_herramientas"]=="4")
				{
					$barra_editor.=",".$barra_documento;
					$barra_editor.=",".$barra_basica;
					$barra_editor.=",".$barra_parrafo;
					$barra_editor.=",".$barra_enlaces;
					$barra_editor.=",".$barra_estilos;
					$barra_editor.=",".$barra_portapapeles;
					$barra_editor.=",".$barra_edicion;
					$barra_editor.=",".$barra_insertar;
					$barra_editor.=",".$barra_colores;
					$barra_editor.=",".$barra_formularios;
					$barra_editor.=",".$barra_otros;
				}
			// Aplica el script del ckeditor al campo
			if (!$existe_campo_textoformato)
				$salida.= '<script type="text/javascript" src="inc/ckeditor/ckeditor.js"></script>';
			$salida.= '	<script type="text/javascript">
						CKEDITOR.replace( \''.$registro_campos["campo"].'\', {	toolbar : [ '.$barra_editor.' ] } );
						CKEDITOR.config.width = '.$registro_campos["ancho"].';
						CKEDITOR.config.height = '.$registro_campos["alto"].';
					</script>';

			// Muestra indicadores de obligatoriedad o ayuda
			if ($registro_campos["obligatorio"]) $salida.= '<a href="#" title="'.$MULTILANG_TitObligatorio.'" name="'.$MULTILANG_DesObligatorio.'"><img src="img/icn_12.gif" border=0 align="absmiddle"></a>';
			if ($registro_campos["ayuda_titulo"] != "") $salida.= '<a href="#" title="'.$registro_campos["ayuda_titulo"].'" name="'.$registro_campos["ayuda_texto"].'"><img src="img/icn_10.gif" border=0 border=0 align="absmiddle"></a>';
			
			//Activa booleana de existencia de tipo de campo para evitar doble inclusion de javascript
			$existe_campo_textoformato=1;
			return $salida;
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: cargar_objeto_lista_seleccion
	Genera el codigo HTML y CSS correspondiente a un campo de lista (select - ComboBox) vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<cargar_formulario>
*/
	function cargar_objeto_lista_seleccion($registro_campos,$registro_datos_formulario)
		{
			global $campobase,$valorbase;
			global $MULTILANG_TitValorUnico,$MULTILANG_DesValorUnico,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio;

			$salida='';
			$nombre_campo=$registro_campos["campo"];

			// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
			if ($campobase!="" && $valorbase!="") $cadena_valor=$registro_datos_formulario["$nombre_campo"];

			// Muestra el campo
			$salida.= '<select name="'.$registro_campos["campo"].'" class="Combos" >';

			// Toma los valores desde la lista de opciones (cuando es estatico)
			$opciones_lista = explode(",", $registro_campos["lista_opciones"]);
			$valores_lista = explode(",", $registro_campos["lista_opciones"]);
			
			// Si se desea tomar los valores del combo desde una tabla hace la consulta
			if ($registro_campos["origen_lista_opciones"]!="" && $registro_campos["origen_lista_valores"]!="")
				{
					$nombre_tabla_opciones = explode(".", $registro_campos["origen_lista_opciones"]);
					$nombre_tabla_opciones = $nombre_tabla_opciones[0];
					$campo_valores=$registro_campos["origen_lista_valores"];
					$campo_opciones=$registro_campos["origen_lista_opciones"];

					// Consulta los campos para el tag select
					$resultado_opciones=ejecutar_sql("SELECT $campo_valores as valores, $campo_opciones as opciones FROM $nombre_tabla_opciones WHERE 1 ORDER BY $campo_opciones");
					while ($registro_opciones = $resultado_opciones->fetch())
						{
							$opciones_lista[] = $registro_opciones["opciones"];
							$valores_lista[] = $registro_opciones["valores"];
						}
				}

			for ($i=0;$i<count($opciones_lista);$i++)
				{
					// Determina si la opcion a agregar es la misma del valor del registro
					$cadena_predeterminado='';
					if ($opciones_lista[$i]==$cadena_valor)
						$cadena_predeterminado=' SELECTED ';
					$salida.= "<option value='".$valores_lista[$i]."' ".$cadena_predeterminado.">".$opciones_lista[$i]."</option>";
				}

			$salida.= '</select>';

			// Muestra indicadores de obligatoriedad o ayuda
			if ($registro_campos["valor_unico"] == "1") $salida.= '<a href="#" title="'.$MULTILANG_TitValorUnico.'" name="'.$MULTILANG_DesValorUnico.'"><img src="img/key.gif" border=0 border=0 align="absmiddle"></a>';
			if ($registro_campos["obligatorio"]) $salida.= '<a href="#" title="'.$MULTILANG_TitObligatorio.'" name="'.$MULTILANG_DesObligatorio.'"><img src="img/icn_12.gif" border=0 align="absmiddle"></a>';
			if ($registro_campos["ayuda_titulo"] != "") $salida.= '<a href="#" title="'.$registro_campos["ayuda_titulo"].'" name="'.$registro_campos["ayuda_texto"].'"><img src="img/icn_10.gif" border=0 border=0 align="absmiddle"></a>';
			return $salida;
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: cargar_objeto_etiqueta
	Genera el codigo HTML y CSS correspondiente a un campo de etiqueta sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<cargar_formulario>
*/
	function cargar_objeto_etiqueta($registro_campos,$registro_datos_formulario)
		{
			global $campobase,$valorbase;
			$salida=$registro_campos["valor_etiqueta"];
			return $salida;
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: cargar_objeto_iframe
	Genera el codigo HTML correspondiente a un campo de IFRAME para empotrar paginas externas sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<cargar_formulario>
*/
	function cargar_objeto_iframe($registro_campos,$registro_datos_formulario)
		{
			global $campobase,$valorbase;
			$salida='<iframe src="'.$registro_campos["url_iframe"].'" width="'.$registro_campos["ancho"].'" height="'.$registro_campos["alto"].'" frameborder="0" marginheight="0" marginwidth="0">Cargando...</iframe>';
			return $salida;
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: cargar_objeto_lista_radio
	Genera el codigo HTML y CSS correspondiente a los radio-button (Radio) vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<cargar_formulario>
*/
	function cargar_objeto_lista_radio($registro_campos,$registro_datos_formulario)
		{
			global $campobase,$valorbase;
			global $MULTILANG_TitValorUnico,$MULTILANG_DesValorUnico,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio;

			$salida='';
			$nombre_campo=$registro_campos["campo"];

			// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
			if ($campobase!="" && $valorbase!="") $cadena_valor=$registro_datos_formulario["$nombre_campo"];

			// Toma los valores desde la lista de opciones (cuando es estatico)
			$opciones_lista = explode(",", $registro_campos["lista_opciones"]);
			$valores_lista = explode(",", $registro_campos["lista_opciones"]);
			
			// Si se desea tomar los valores del combo desde una tabla hace la consulta
			if ($registro_campos["origen_lista_opciones"]!="" && $registro_campos["origen_lista_valores"]!="")
				{
					$nombre_tabla_opciones = explode(".", $registro_campos["origen_lista_opciones"]);
					$nombre_tabla_opciones = $nombre_tabla_opciones[0];
					$campo_valores=$registro_campos["origen_lista_valores"];
					$campo_opciones=$registro_campos["origen_lista_opciones"];

					// Consulta los campos para el tag select
					$resultado_opciones=ejecutar_sql("SELECT $campo_valores as valores, $campo_opciones as opciones FROM $nombre_tabla_opciones WHERE 1 ORDER BY $campo_opciones");
					while ($registro_opciones = $resultado_opciones->fetch())
						{
							$opciones_lista[] = $registro_opciones["opciones"];
							$valores_lista[] = $registro_opciones["valores"];
						}
				}

			for ($i=0;$i<count($opciones_lista);$i++)
				{
					// Determina si la opcion a agregar es la misma del valor del registro
					$cadena_predeterminado='';
					if ($opciones_lista[$i]==$cadena_valor)
						$cadena_predeterminado=' SELECTED ';
					$salida.= "<input class='Radios' type='radio' name='".$registro_campos["campo"]."' value='".$valores_lista[$i]."' ".$cadena_predeterminado.">".$opciones_lista[$i]."<br>";
				}

			// Muestra indicadores de obligatoriedad o ayuda
			if ($registro_campos["valor_unico"] == "1") $salida.= '<a href="#" title="'.$MULTILANG_TitValorUnico.'" name="'.$MULTILANG_DesValorUnico.'"><img src="img/key.gif" border=0 border=0 align="absmiddle"></a>';
			if ($registro_campos["obligatorio"]) $salida.= '<a href="#" title="'.$MULTILANG_TitObligatorio.'" name="'.$MULTILANG_DesObligatorio.'"><img src="img/icn_12.gif" border=0 align="absmiddle"></a>';
			if ($registro_campos["ayuda_titulo"] != "") $salida.= '<a href="#" title="'.$registro_campos["ayuda_titulo"].'" name="'.$registro_campos["ayuda_texto"].'"><img src="img/icn_10.gif" border=0 border=0 align="absmiddle"></a>';
			return $salida;
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: cargar_formulario
	Genera el codigo HTML correspondiente a un formulario de la aplicacion y hace los llamados necesarios para la diagramacion por pantalla de los diferentes objetos que lo componen.

	Variables de entrada:

		formulario - ID unico del formulario que se desea cargar
		en_ventana - Opcional, determina si el formulario es cargado en una ventana o directamente sobre el escritorio
		campobase - Opcional, indica el campo sobre el cual se deben realizar busquedas para el cargue automatico de campos del formulario desde la base de datos
		valorbase - Opcional, indica el valor que sera buscado sobre el campobase para encontrar los valores de cada objeto en el formulario

	(start code)
		SELECT * FROM ".$TablasCore."formulario WHERE id='$formulario'
		SELECT id,peso,visible FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND fila_unica='1' AND visible=1 UNION SELECT 0,$limite_superior,0 ORDER BY peso
		SELECT * FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND columna='$cl' AND visible=1 AND peso >'$limite_inferior' AND peso <='$limite_superior' ORDER BY peso
		Por cada registro
			Llamar creacion de objeto correspondiente
		SELECT * FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND id='$ultimo_id'
		SELECT * FROM ".$TablasCore."formulario_boton WHERE formulario='$formulario' AND visible=1 ORDER BY peso
	(end)

	Salida:

		HTML, CSS y Javascript asociado al formulario

	Ver tambien:
		<cargar_informe>
*/
		function cargar_formulario($formulario,$en_ventana=1,$campobase="",$valorbase="")
		  {
				global $ConexionPDO,$ArchivoCORE,$TablasCore;
				// Carga variables de definicion de tablas
				global $ListaCamposSinID_formulario,$ListaCamposSinID_formulario_objeto,$ListaCamposSinID_formulario_boton;
				global $MULTILANG_ErrorTiempoEjecucion,$MULTILANG_ObjetoNoExiste,$MULTILANG_ContacteAdmin,$MULTILANG_Formularios;

				echo '
				<script type="text/javascript">
					function AgregarElemento(columna,fila,elemento)
						{
							//carga dinamicamente objetos html a marcos
							var capa = document.getElementById(ubicacion);
							var zona = document.createElement("po");
							zona.innerHTML = elemento;
							capa.appendChild(zona);
						}

					function ImprimirMarco(nombre)
						{
						  var ficha = document.getElementById(nombre);
						  var ventimp = window.open(" ", "popimpr");
						  ventimp.document.write( ficha.innerHTML );
						  ventimp.document.close();
						  ventimp.print( );
						  ventimp.close();
						}

				</script>
				<!--<input type=button onclick=\'AgregarElemento("1","1","hello world");\'>-->';

				// Busca datos del formulario
				$consulta_formulario=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id='$formulario'");
				$registro_formulario = $consulta_formulario->fetch();

				//Si no encuentra formulario presenta error
				if ($registro_formulario["id"]=="")	mensaje($MULTILANG_ErrorTiempoEjecucion,$MULTILANG_ObjetoNoExiste." ".$MULTILANG_ContacteAdmin."<br>(".$MULTILANG_Formularios." $formulario)","70%","icono_error.png","TextosEscritorio");

				// En caso de recibir un campo base y valor base se hace la busqueda para recuperar la informacion
				if ($campobase!="" && $valorbase!="")
					{
						$consulta_datos_formulario = $ConexionPDO->prepare("SELECT * FROM ".$registro_formulario["tabla_datos"]." WHERE $campobase='$valorbase'");
						$consulta_datos_formulario->execute();
						$registro_datos_formulario = $consulta_datos_formulario->fetch();
					}
				if ($en_ventana) abrir_ventana($registro_formulario["titulo"],'f2f2f2','');
				// Muestra ayuda en caso de tenerla
				$imagen_ayuda="info_icon.png";
				if ($registro_formulario["ayuda_imagen"]!="") $imagen_ayuda=$registro_formulario["ayuda_imagen"];
				if ($registro_formulario["ayuda_titulo"]!="" || $registro_formulario["ayuda_texto"]!="" || $registro_formulario["ayuda_imagen"]!="")
					mensaje($registro_formulario["ayuda_titulo"],$registro_formulario["ayuda_texto"],'100%',$imagen_ayuda,'TextosVentana');

				//Inicia el formulario de datos
				echo '
					<form name="datos" action="'.$ArchivoCORE.'" method="POST" enctype="multipart/form-data" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
					<input type="Hidden" name="accion" value="guardar_datos_formulario">
					<input type="Hidden" name="formulario" value="'.$formulario.'">';

				//Booleana que determina si se debe incluir el javascript de ckeditor
				$existe_campo_textoformato=0;

				//DIAGRAMACION DE LA TABLA CON ELEMENTOS DEL FORMULARIO
				$limite_inferior=-9999; // Peso inferior a tener en cuenta en el query
				$constante_limite_superior=+9999;
				$limite_superior=$constante_limite_superior; // Peso superior a tener en cuenta en el query
				//Busca todos los objetos marcados como fila_unica=1 y agrega un registro mas con el limite superior
				$consulta_obj_fila_unica=ejecutar_sql("SELECT id,peso,visible FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND fila_unica='1' AND visible=1 UNION SELECT 0,$limite_superior,0 ORDER BY peso");
				echo '<div id="seccion_impresion">';
				while ($registro_obj_fila_unica = $consulta_obj_fila_unica->fetch())
					{
						$limite_superior=$registro_obj_fila_unica["peso"];
						$ultimo_id=$registro_obj_fila_unica["id"];
						// Inicia la tabla con los campos
						echo '
						<table border=0 class="TextosVentana" align=center width="100%"><tr>';
						//Recorre todas las comunas definidas para el formulario buscando objetos
						for ($cl=1;$cl<=$registro_formulario["columnas"];$cl++)
							{
								//Busca los elementos de la coumna actual del formulario con peso menor o igual al peso del objeto fila_unica de la fila unica_actual pero que no son fila_unica
								$consulta_campos=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND columna='$cl' AND visible=1 AND peso >'$limite_inferior' AND peso <='$limite_superior' ORDER BY peso");
								
									//Inicia columna de formulario
									echo '<td valign=top align=center>';
									// Crea los campos definidos por cada columna de formulario
									echo '<table border=0 class="TextosVentana">';
									while ($registro_campos = $consulta_campos->fetch())
										{
											//Crea la fila y celda donde va el campo
											//Imprime el campo solamente si no es fila unica, si es fila_unica guarda en una variable para uso posterior
											if($registro_campos["fila_unica"]=="0")
												{
													echo '<tr>
														<td align="right" valign=top>'.$registro_campos["titulo"].'</td>
														<td valign=top>';
													// Formatea cada campo de acuerdo a su tipo
													// CUIDADO!!! Modificando las lineas de tipo siguientes debe modificar las lineas de tipo un poco mas abajo tambien
													if ($registro_campos["tipo"]=="texto_corto") $objeto_formateado = cargar_objeto_texto_corto($registro_campos,$registro_datos_formulario,$formulario,$en_ventana);
													if ($registro_campos["tipo"]=="texto_largo") $objeto_formateado = cargar_objeto_texto_largo($registro_campos,$registro_datos_formulario);
													if ($registro_campos["tipo"]=="texto_formato") { $objeto_formateado = cargar_objeto_texto_formato($registro_campos,$registro_datos_formulario,$existe_campo_textoformato); $existe_campo_textoformato=1; }
													if ($registro_campos["tipo"]=="lista_seleccion") $objeto_formateado = cargar_objeto_lista_seleccion($registro_campos,$registro_datos_formulario);
													if ($registro_campos["tipo"]=="lista_radio") $objeto_formateado = cargar_objeto_lista_radio($registro_campos,$registro_datos_formulario);
													if ($registro_campos["tipo"]=="etiqueta") $objeto_formateado = cargar_objeto_etiqueta($registro_campos,$registro_datos_formulario);
													if ($registro_campos["tipo"]=="url_iframe") $objeto_formateado = cargar_objeto_iframe($registro_campos,$registro_datos_formulario);
													if ($registro_campos["tipo"]=="informe") cargar_informe($registro_campos["informe_vinculado"],$registro_campos["objeto_en_ventana"],"htm","Informes",1);

													//Imprime el objeto siempre y cuando no sea uno preformateado por practico (informes, formularios, etc)
													if ($registro_campos["tipo"]!="informe")
														echo $objeto_formateado;
													// Cierra la fila y celda donde se puso el objeto
													echo '</td></tr>';
												}
											/*
											else
												{
													echo '<tr>
														<td align="right" valign=top></td>
														<td valign=top>
														</td></tr>';
												}*/
										}
									// Cierra tabla de campos en la columna
									echo '</table>';
									echo '</td>'; //Fin columna de formulario
							}
						// Finaliza la tabla con los campos
						echo '</tr></table>';

						//Busca datos del registro de fila_unica
						$consulta_campos=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND id='$ultimo_id'");
						$registro_campos = $consulta_campos->fetch();

						//Agrega el campo de fila unica cuando no se trata del agregado de peso 9999
						if ($registro_campos["visible"]=="1")
							{
								echo '&nbsp;&nbsp;'.$registro_campos["titulo"];
								// Formatea cada campo de acuerdo a su tipo
								// CUIDADO!!! Modificando las lineas de tipo siguientes debe modificar las lineas de tipo un poco mas arriba tambien
								if ($registro_campos["tipo"]=="texto_corto") $objeto_formateado = cargar_objeto_texto_corto($registro_campos,$registro_datos_formulario,$formulario,$en_ventana);
								if ($registro_campos["tipo"]=="texto_largo") $objeto_formateado = cargar_objeto_texto_largo($registro_campos,$registro_datos_formulario);
								if ($registro_campos["tipo"]=="texto_formato") { $objeto_formateado = cargar_objeto_texto_formato($registro_campos,$registro_datos_formulario,$existe_campo_textoformato); $existe_campo_textoformato=1; }
								if ($registro_campos["tipo"]=="lista_seleccion") $objeto_formateado = cargar_objeto_lista_seleccion($registro_campos,$registro_datos_formulario);
								if ($registro_campos["tipo"]=="lista_radio") $objeto_formateado = cargar_objeto_lista_radio($registro_campos,$registro_datos_formulario);
								if ($registro_campos["tipo"]=="etiqueta") $objeto_formateado = cargar_objeto_etiqueta($registro_campos,$registro_datos_formulario);
								if ($registro_campos["tipo"]=="url_iframe") $objeto_formateado = cargar_objeto_iframe($registro_campos,$registro_datos_formulario);
								if ($registro_campos["tipo"]=="informe") cargar_informe($registro_campos["informe_vinculado"],$registro_campos["objeto_en_ventana"],"htm","Informes",1);

								//Imprime el objeto siempre y cuando no sea uno preformateado por practico (informes, formularios, etc)
								if ($registro_campos["tipo"]!="informe")
									echo $objeto_formateado;
							}

						//Actualiza limite inferior para siguiente lista de campos
						$limite_inferior=$registro_obj_fila_unica["peso"];
					}
				echo '</div> <!-- Fin PR_seccion_impresion_activa -->';

			// Si tiene botones agrega barra de estado y los ubica
			$consulta_botones = $ConexionPDO->prepare("SELECT id,".$ListaCamposSinID_formulario_boton." FROM ".$TablasCore."formulario_boton WHERE formulario='$formulario' AND visible=1 ORDER BY peso");
			$consulta_botones->execute();

			if($consulta_botones->rowCount()>0)
				{
					abrir_barra_estado();
					while ($registro_botones = $consulta_botones->fetch())
						{
							//Define el tipo de boton de acuerdo al tipo de accion como Submit, Reset o Button
							$tipo_boton="Button";
							if ($registro_botones["tipo_accion"]=="interna_guardar")
								{
									$tipo_boton="Submit";
								}
							if ($registro_botones["tipo_accion"]=="interna_limpiar")
								{
									$tipo_boton="Reset";
								}
							if ($registro_botones["tipo_accion"]=="interna_escritorio")
								{
									$tipo_boton="Button";
									$comando_javascript="document.core_ver_menu.submit()";
								}
							if ($registro_botones["tipo_accion"]=="interna_eliminar")
								{
									$tipo_boton="Button";
									$comando_javascript="document.datos.accion.value='eliminar_datos_formulario';document.datos.submit()";
								}
							if ($registro_botones["tipo_accion"]=="interna_cargar")
								{
									echo '<input type="hidden" name="objeto" value="'.$registro_botones["accion_usuario"].'">';
									$tipo_boton="Button";
									$comando_javascript="document.datos.accion.value='cargar_objeto';document.datos.submit()";
								}
							if ($registro_botones["tipo_accion"]=="externa_formulario")
								{
									$tipo_boton="Button";
									$comando_javascript="document.datos.accion.value='".$registro_botones["accion_usuario"]."';document.datos.submit()";
								}
							if ($registro_botones["tipo_accion"]=="externa_javascript")
								{
									$tipo_boton="Button";
									$comando_javascript=$registro_botones["accion_usuario"];
								}
							if ($comando_javascript!="" && $tipo_boton!="Reset")
								{
									$cadena_javascript='onclick="'.@$comando_javascript.'"';
								}
							echo '<input type="'.$tipo_boton.'"  class="'.$registro_botones["estilo"].'" value="'.$registro_botones["titulo"].'" '.$cadena_javascript.' >';
						}
					cerrar_barra_estado();
				}

			//Cierra todo el formulario
			echo '</form>';
			
			//Carga las funciones JavaScript asociadas al formulario y llama la funcion FrmAutoRun()
				echo '<script type="text/javascript">'.$registro_formulario["javascript"].' FrmAutoRun(); </script>';
			
			
			
			if ($en_ventana) cerrar_ventana();
		  }



/* ################################################################## */
/* ################################################################## */
/*
	Function: cargar_informe
	Genera el codigo HTML correspondiente a un formulario de la aplicacion y hace los llamados necesarios para la diagramacion por pantalla de los diferentes objetos que lo componen.

	Variables de entrada:

		informe - ID unico del informe que se desea cargar
		en_ventana - Indica si el informe debe ser cargado en una ventana o directamente sobre el escritorio de aplicacion
		formato - Determina el formato en el cual es generado el informe como HTM o XLS (Alpha)
		estilo - Determina el estilo CSS utilizado para presentar el informe, debe existir dentro de las hojas de estilo de la plantilla
		embebido - Determina si el informe es presentado dentro de otro objeto o no, como por ejemplo un formulario

	(start code)
		SELECT * FROM ".$TablasCore."informe WHERE id='$informe'
		SELECT * FROM ".$TablasCore."informe_campos WHERE informe='$informe'
		SELECT * FROM ".$TablasCore."informe_tablas WHERE informe='$informe'
		SELECT * FROM ".$TablasCore."informe_condiciones WHERE informe='$informe' ORDER BY peso
	(end)

	Salida:

		HTML, CSS y Javascript asociado al formulario

	Ver tambien:
		<cargar_formulario>
*/
function cargar_informe($informe,$en_ventana=1,$formato="htm",$estilo="Informes",$embebido=0)
	{
		global $ConexionPDO,$ArchivoCORE,$TablasCore,$Nombre_Aplicacion,$Login_usuario;
		// Carga variables de definicion de tablas
		global $ListaCamposSinID_informe,$ListaCamposSinID_informe_campos,$ListaCamposSinID_informe_tablas,$ListaCamposSinID_informe_condiciones,$ListaCamposSinID_informe_boton;
		global $MULTILANG_TotalRegistros,$MULTILANG_ContacteAdmin,$MULTILANG_ObjetoNoExiste,$MULTILANG_ErrorTiempoEjecucion,$MULTILANG_Informes,$MULTILANG_IrEscritorio;

		// Busca datos del informe
		$consulta_informe=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe." FROM ".$TablasCore."informe WHERE id='$informe'");
		$registro_informe=$consulta_informe->fetch();

		//Si no encuentra informe presenta error
		if ($registro_informe["id"]=="") mensaje($MULTILANG_ErrorTiempoEjecucion,$MULTILANG_ObjetoNoExiste." ".$MULTILANG_ContacteAdmin."<br>(".$MULTILANG_Informes." $informe)","70%","icono_error.png","TextosEscritorio");

			// Inicia CONSTRUCCION DE CONSULTA DINAMICA
			$numero_columnas=0;
			//Busca los CAMPOS definidos para el informe
			$consulta="SELECT ";
			$consulta_campos=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_campos." FROM ".$TablasCore."informe_campos WHERE informe='$informe'");
			while ($registro_campos = $consulta_campos->fetch())
				{
					//Si tiene alias definido lo agrega
					$posfijo_campo="";
					if ($registro_campos["valor_alias"]!="") $posfijo_campo=" as ".$registro_campos["valor_alias"];
					//Agrega el campo a la consulta
					$consulta.=$registro_campos["valor_campo"].$posfijo_campo.",";
				}
			// Elimina la ultima coma en el listado de campos
			$consulta=substr($consulta, 0, strlen($consulta)-1);

			//Busca las TABLAS definidas para el informe
			$consulta.=" FROM ";
			$consulta_tablas=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_tablas." FROM ".$TablasCore."informe_tablas WHERE informe='$informe'");
			while ($registro_tablas = $consulta_tablas->fetch())
				{
					//Si tiene alias definido lo agrega
					$posfijo_tabla="";
					if ($registro_tablas["valor_alias"]!="") $posfijo_tabla=" as ".$registro_tablas["valor_alias"];
					//Agrega tabla a la consulta
					$consulta.=$registro_tablas["valor_tabla"].$posfijo_tabla.",";
				}
			// Elimina la ultima coma en el listado de tablas
			$consulta=substr($consulta, 0, strlen($consulta)-1);

			// Busca las CONDICIONES para el informe
			$consulta.=" WHERE ";
			$consulta_condiciones=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_condiciones." FROM ".$TablasCore."informe_condiciones WHERE informe='$informe' ORDER BY peso");
			$hay_condiciones=0;
			while ($registro_condiciones = $consulta_condiciones->fetch())
				{
					//Agrega condicion a la consulta
					$consulta.=" ".$registro_condiciones["valor_izq"]." ".$registro_condiciones["operador"]." ".$registro_condiciones["valor_der"]." ";
					$hay_condiciones=1;
				}
			if (!$hay_condiciones)
			$consulta.=" 1 ";

			if ($registro_informe[agrupamiento]!="")
				{
					$campoagrupa=$registro_informe[agrupamiento];	
					$consulta.= " GROUP BY $campoagrupa";
				}

			if ($registro_informe[ordenamiento]!="")
				{
					$campoorden=$registro_informe[ordenamiento];
					$consulta.= " ORDER BY $campoorden";
				}

			/*
			if ($registro_informe[filtro_cliente]!="")
				{
					$campocliente=$registro_informe[filtro_cliente];	
					$consulta.= " AND $campocliente = '$cliente'";
				}

			if ($registro_informe[filtro_fecha]!="")
				{
					$campofecha=$registro_informe[filtro_fecha];	
					if ($registro_informe[motor]=="mysql")
						$consulta.= " AND $campofecha BETWEEN '$anoi$mesi$diai' AND '$anof$mesf$diaf'";
				}

			if ($registro_informe[filtro_texto]!="")
				{
					$campotexto=$registro_informe[filtro_texto];
					$consulta.= " AND $campotexto = '$filtrotexto' ";
				}

			*/


		// Si el informe tiene formato_final = T (tabla de datos)
		if ($registro_informe["formato_final"]=="T")
			{
				if ($en_ventana)
					{
						//Cuando es embebido (=1) no imprime el boton de retorno pues se asume dentro de un formulario
						if (!$embebido)
							echo '<input type="Button" onclick="document.core_ver_menu.submit()" value=" <<< '.$MULTILANG_IrEscritorio.' " class="Botones">';
						abrir_ventana($Nombre_Aplicacion.' - '.$registro_informe["titulo"],'f2f2f2',$registro_informe["ancho"]);
					}

				// Si se ha definido un tamano fijo entonces crea el marco
				if ($registro_informe["ancho"]!="" && $registro_informe["alto"]!="")
					echo '<DIV style="DISPLAY: block; OVERFLOW: auto; POSITION: relative; WIDTH: '.$registro_informe["ancho"].'; HEIGHT: '.$registro_informe["alto"].'">';

					// Crea encabezado por tipo de formato:  1=html   2=Excel
					if($formato=="htm")
						{
							echo '
								<html>
								<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0" style="font-size: 12px; font-family: Verdana, Tahoma, Arial;">';

							// Si no tiene ancho o alto se asume que es para impresion y agrega titulo
							if ($registro_informe["ancho"]=="" || $registro_informe["alto"]=="")
								echo '<table class="'.$estilo.'">
									<thead><tr><td>
									'.$Nombre_Aplicacion.' - '.$registro_informe["titulo"].'
									</td></tr></thead></table>';

							// Pone encabezados de informe
							/*if ($registro_informe[filtro_cliente]!="")
								echo 'Empresa: '.$cliente.'  -  ';
							if ($registro_informe[filtro_fecha]!="")
								echo 'Desde '.$anoi.'/'.$mesi.'/'.$diai.' Hasta '.$anof.'/'.$mesf.'/'.$diaf.'';*/
							//echo '</font></div>';
						}

					if($formato=="xls")
						{
							$fecha = date("d-m-Y");
							$tituloinforme=trim($registro_informe["titulo"]);
							$tituloinforme="Informe";
							$nombrearchivo=$tituloinforme."_".$fecha;
							header('Content-type: application/vnd.ms-excel');
							header("Content-Disposition: attachment; filename=$nombrearchivo.xls");
							header("Pragma: no-cache");
							header("Expires: 0");
						}

					if($formato=="htm")
						echo '<table class="'.$estilo.'">
							<thead><tr>';
					if($formato=="xls")
						echo '<table class="font-size: 11px; font-family: Verdana, Tahoma, Arial;">
							<thead><tr>';


					// Busca si el informe tiene acciones (botones), los cuenta y prepara dentro de un arreglo para repetir en cada registro
					$consulta_botones=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_boton." FROM ".$TablasCore."informe_boton WHERE informe='$informe' AND visible=1 ORDER BY peso");
					$total_botones=0;
					while($registro_botones=$consulta_botones->fetch())
						{
							//Construye una cadena generica con todos los botones para ser reemplazada luego con valores
							if ($registro_botones["tipo_accion"]=="interna_eliminar")
								{
									$valores = explode(".",$registro_botones["accion_usuario"]);
									$tabla_vinculada=$valores[0];
									$campo_vinculado=$valores[1];
									$comando_javascript="
										document.FRMBASEINFORME.accion.value='eliminar_registro_informe';
										document.FRMBASEINFORME.tabla.value='".$tabla_vinculada."';
										document.FRMBASEINFORME.campo.value='".$campo_vinculado."';
										document.FRMBASEINFORME.valor.value='DELFRMVALVALOR';
										document.FRMBASEINFORME.submit()";
								}
							if ($registro_botones["tipo_accion"]=="interna_cargar")
								{
									$comando_javascript="
										document.FRMBASEINFORME.accion.value='cargar_objeto';
										document.FRMBASEINFORME.objeto.value='frm:".$registro_botones["accion_usuario"].":DETFRMVALBASE';
										document.FRMBASEINFORME.submit()";
								}
							if ($registro_botones["tipo_accion"]=="externa_formulario")
								{
									$comando_javascript="
										document.FRMBASEINFORME.accion.value='".$registro_botones["accion_usuario"]."';
										document.FRMBASEINFORME.submit()";
								}
							if ($registro_botones["tipo_accion"]=="externa_javascript")
								{
									$comando_javascript=$registro_botones["accion_usuario"];
								}
							$cadena_javascript='onclick="'.@$comando_javascript.'"';
							$cadena_generica_botones.='<input type="Button"  class="'.$registro_botones["estilo"].'" value="'.$registro_botones["titulo"].'" '.$cadena_javascript.' >';
							$total_botones++;
						}
					//Si el informe tiene botones se agrega el formulario para procesar las acciones
					if ($total_botones>0)
						{
							echo '<form name="FRMBASEINFORME" action="'.$ArchivoCORE.'" method="POST">
								<input type="Hidden" name="accion" value="">
								<input type="Hidden" name="tabla" value="">
								<input type="Hidden" name="campo" value="">
								<input type="Hidden" name="valor" value="">
								<input type="Hidden" name="objeto" value="">
								</form>';
						}

					// Imprime encabezados de columna
					$resultado_columnas=ejecutar_sql($consulta);
					$numero_columnas=0;
					foreach($resultado_columnas->fetch(PDO::FETCH_ASSOC) as $key=>$val)
						{
							echo '<th align="LEFT">'.$key.'</th>';
							$numero_columnas++;
						}

					//Si el informe tiene botones entonces agrega columna adicional
					if ($total_botones>0)
						echo '<th align="LEFT"></th>';
					echo '</tr></thead><tbody>';

					// Imprime registros del resultado
					$numero_filas=0;
					$consulta_ejecucion=ejecutar_sql($consulta);
					while($registro_informe=$consulta_ejecucion->fetch())
						{
							echo '<tr>';
							for ($i=0;$i<$numero_columnas;$i++)
								echo '<td align=left>'.$registro_informe[$i].'</td>';
							//Si el informe tiene botones los agrega
							if ($total_botones>0)
								{
									//Transforma la cadena generica con los datos especificos del registro, toma por ahora el primer campo
									$cadena_botones_registro=str_replace("DELFRMVALVALOR",$registro_informe[0],$cadena_generica_botones);
									$cadena_botones_registro=str_replace("DETFRMVALBASE",$registro_informe[0],$cadena_botones_registro);
									//Muestra los botones preparados para el registro
									echo '<th align="LEFT">'.$cadena_botones_registro.'</th>';
								}
							echo '</tr>';
							$numero_filas++;
						}
					echo '</tbody>';
					if ($formato=="htm")
						echo '<tfoot>
							<tr><td colspan='.$numero_columnas.'>
								<b>'.$MULTILANG_TotalRegistros.': </b>'.$numero_filas.'
							</td></tr>
						</tfoot>';
					echo '</table>';

					if($formato=="htm")
						echo '
							</body>
							</html>';

				// Si se ha definido un tamano fijo entonces cierra el marco
				if ($registro_informe["ancho"]!="" && $registro_informe["alto"]!="")
					echo '</DIV>';
			} // Fin si informe es T (tabla)



		// Si el informe tiene formato_final = G (grafico)
		if ($registro_informe["formato_final"]=="G")
			{
				//Consulta el formato de grafico y datos de series para ponerlo en los campos
				//Dado por: Tipo|Nombre1!NombreN|Etiqueta1!EtiquetaN|Valor1!ValorN|
				$formato_base=explode("|",$registro_informe["formato_grafico"]);
				$tipo_grafico=$formato_base[0];
				$lista_nombre_series=explode("!",$formato_base[1]);
				$lista_etiqueta_series=explode("!",$formato_base[2]);
				$lista_valor_series=explode("!",$formato_base[3]);

				//Elimina los nombres de tabla en caso de tener punto y usa los alias si los tiene
				for ($i=0;$i<5;$i++)
					{
						//Elimina nombres de tabla encontrando el punto y seleccionando siguiente palabra
						if (strpos($lista_etiqueta_series[$i], "."))
							{
								$tmp=explode(".",$lista_etiqueta_series[$i]);
								$lista_etiqueta_series[$i]=$tmp[1];
							}
						if (strpos($lista_valor_series[$i], "."))
							{
								$tmp=explode(".",$lista_valor_series[$i]);
								$lista_valor_series[$i]=$tmp[1];
							}
						// Prefiere los alias sobre los nombres de campo cuando encuentra un AS 
						if (strpos($lista_etiqueta_series[$i], " AS "))
							{
								$tmp=explode(" AS ",$lista_etiqueta_series[$i]);
								$lista_etiqueta_series[$i]=$tmp[1];
							}
						if (strpos($lista_valor_series[$i], " AS "))
							{
								$tmp=explode(" AS ",$lista_valor_series[$i]);
								$lista_valor_series[$i]=$tmp[1];
							}
					}
				$nombre_serie_1=$lista_nombre_series[0];
				$nombre_serie_2=$lista_nombre_series[1];
				$nombre_serie_3=$lista_nombre_series[2];
				$nombre_serie_4=$lista_nombre_series[3];
				$nombre_serie_5=$lista_nombre_series[4];
				$campo_etiqueta_serie_1=$lista_etiqueta_series[0];
				$campo_etiqueta_serie_2=$lista_etiqueta_series[1];
				$campo_etiqueta_serie_3=$lista_etiqueta_series[2];
				$campo_etiqueta_serie_4=$lista_etiqueta_series[3];
				$campo_etiqueta_serie_5=$lista_etiqueta_series[4];
				$campo_valor_serie_1=$lista_valor_series[0];
				$campo_valor_serie_2=$lista_valor_series[1];
				$campo_valor_serie_3=$lista_valor_series[2];
				$campo_valor_serie_4=$lista_valor_series[3];
				$campo_valor_serie_5=$lista_valor_series[4];
				// Libreria para graficos
				include "inc/libchart/classes/libchart.php";

				//Crea las series para el grafico, dependiendo si es torta (una serie) o cualquier otro (multiples series)
				if ($tipo_grafico=="torta")
					{
						$dataSet = new XYDataSet();
						// GENERA DATOS DEL GRAFICO
						$consulta_ejecucion=ejecutar_sql($consulta);
						while($registro=$consulta_ejecucion->fetch())
							{
								if ($nombre_serie_1 != "") $dataSet->addPoint(new Point($registro[$campo_etiqueta_serie_1], $registro[$campo_valor_serie_1]));
							}
					}
				else
					{
						$dataSet = new XYSeriesDataSet();
						if ($nombre_serie_1 != "")	{
							$serie1 = new XYDataSet();
							$dataSet->addSerie($nombre_serie_1, $serie1);	}
						if ($nombre_serie_2 != "")	{
							$serie2 = new XYDataSet();
							$dataSet->addSerie($nombre_serie_2, $serie2);	}
						if ($nombre_serie_3 != "")	{
							$serie3 = new XYDataSet();
							$dataSet->addSerie($nombre_serie_3, $serie3);	}
						if ($nombre_serie_4 != "")	{
							$serie4 = new XYDataSet();
							$dataSet->addSerie($nombre_serie_4, $serie4);	}
						if ($nombre_serie_5 != "")	{
							$serie5 = new XYDataSet();
							$dataSet->addSerie($nombre_serie_5, $serie5);	}

						// GENERA DATOS DEL GRAFICO
						$consulta_ejecucion=ejecutar_sql($consulta);
						while($registro=$consulta_ejecucion->fetch())
							{
								if ($nombre_serie_1 != "") $serie1->addPoint(new Point($registro[$campo_etiqueta_serie_1], $registro[$campo_valor_serie_1]));
								if ($nombre_serie_2 != "") $serie2->addPoint(new Point($registro[$campo_etiqueta_serie_2], $registro[$campo_valor_serie_2]));
								if ($nombre_serie_3 != "") $serie3->addPoint(new Point($registro[$campo_etiqueta_serie_3], $registro[$campo_valor_serie_3]));
								if ($nombre_serie_4 != "") $serie4->addPoint(new Point($registro[$campo_etiqueta_serie_4], $registro[$campo_valor_serie_4]));
								if ($nombre_serie_5 != "") $serie5->addPoint(new Point($registro[$campo_etiqueta_serie_5], $registro[$campo_valor_serie_5]));
							}
					}

				// CREA OBJETO SEGUN TIPO DE GRAFICO
				if ($tipo_grafico=="linea" || $tipo_grafico=="linea_multiples")
					$chart = new LineChart($registro_informe["ancho"], $registro_informe["alto"]);
				if ($tipo_grafico=="barrah" || $tipo_grafico=="barrah_multiples")
					$chart = new HorizontalBarChart($registro_informe["ancho"], $registro_informe["alto"]);
				if ($tipo_grafico=="barrav" || $tipo_grafico=="barrav_multiples")
					$chart = new VerticalBarChart($registro_informe["ancho"], $registro_informe["alto"]);
				if ($tipo_grafico=="torta")
					$chart = new PieChart($registro_informe["ancho"], $registro_informe["alto"]);

				// PRESENTA EL GRAFICO EN PANTALLA
				$chart->setDataSet($dataSet);
				//$chart->getPlot()->setGraphCaptionRatio(0.75);
				$chart->setTitle($registro_informe["titulo"]);
				$chart->render("tmp/Inf_".$registro_informe["id"]."-".$Login_usuario.".png");
				echo '<img alt="Grafico" src="tmp/Inf_'.$registro_informe["id"].'-'.$Login_usuario.'.png" style="border: 1px solid gray;">';
			} // Fin si informe es G (grafico)

		if ($en_ventana) cerrar_ventana();
	}



/* ################################################################## */
/* ################################################################## */
	/*
		Section: Acciones a ser ejecutadas (si aplica) en cada cargue de la herramienta
	*/
/* ################################################################## */
/* ################################################################## */
	if ($accion=="cambiar_estado_campo")
		{		
			/*
				Function: cambiar_estado_campo
				Abre los espacios de trabajo dinamicos sobre el contenedor principal donde se despliega informacion

				Variables de entrada:

					tabla - Nombre de la tabla que contiene el registro a actualizar.
					campo - Nombre del campo que sera actualizado.
					id - Identificador unico del campo a ser actualizado.
					valor - Valor a ser asignado en el campo del registro cuyo identificador coincida con el recibido.

				Salida:

					Valor actualizado en el campo y retorno al escritorio de la aplicacion.  En caso de error se retorna al escritorio sin realizar cambios ante el fallo del query.
			*/

			$mensaje_error="";
			if ($mensaje_error=="")
				{
					ejecutar_sql_unaria("UPDATE ".$TablasCore."$tabla SET $campo = $valor WHERE id = '$id'");
					auditar("Cambia estado del campo $campo en objetoID $formulario");

					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="'.$accion_retorno.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="popup_activo" value="'.$popup_activo.'">
						<script type="" language="JavaScript">
						//setTimeout ("document.cancelar.submit();", 10); 
						document.cancelar.submit();
						</script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="editar_formulario">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}

?>
