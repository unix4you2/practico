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
/*
	Function: permiso_accion
	Busca dentro de los permisos del usuario la accion a ejecutar cuando no se encuentra directamente como una opcion del usuario sino como una subrutina de otra de la que si tiene agregada de manera que valida si puede ingresar o no a ella.
	
	Variables de entrada:

		accion - Accion a ser ejectudada, de la que se desea buscar permiso heredado por otra

	Salida:
		Retorna 1 en caso de encontrar el permiso
		Retorna 0 cuando no se encuentra un permiso
*/
	function permiso_heredado_accion($accion)
		{
			global $Login_usuario;
			// Variable que determina el estado de aceptacion o rechazo del permiso 0=no permiso 1=ok permiso
			$retorno=0;

			// Verifica mapeo de permisos para acciones que llaman a otras, heredadas.  Valores en = 1  son funciones publicas:
			// FUNCION_solicitada_por_el_usuario				FUNCION_madre_de_entrada_a_funcion_solicitada
			if ($accion== "mis_informes")						$retorno = 1;
			if ($accion== "guardar_informe")					$retorno = permiso_agregado_accion("administrar_informes");
			if ($accion== "editar_informe")						$retorno = permiso_agregado_accion("administrar_informes");
			if ($accion== "eliminar_informe")					$retorno = permiso_agregado_accion("administrar_informes");
			if ($accion== "actualizar_informe")					$retorno = permiso_agregado_accion("administrar_informes");
			if ($accion== "eliminar_informe_tabla")				$retorno = permiso_agregado_accion("administrar_informes");
			if ($accion== "guardar_informe_tabla")				$retorno = permiso_agregado_accion("administrar_informes");
			if ($accion== "eliminar_informe_campo")				$retorno = permiso_agregado_accion("administrar_informes");
			if ($accion== "guardar_informe_campo")				$retorno = permiso_agregado_accion("administrar_informes");
			if ($accion== "guardar_informe_condicion")			$retorno = permiso_agregado_accion("administrar_informes");
			if ($accion== "eliminar_informe_condicion")			$retorno = permiso_agregado_accion("administrar_informes");
			if ($accion== "actualizar_grafico_informe")			$retorno = permiso_agregado_accion("administrar_informes");
			if ($accion== "actualizar_agrupamiento_informe")	$retorno = permiso_agregado_accion("administrar_informes");
			if ($accion== "guardar_accion_informe")				$retorno = permiso_agregado_accion("administrar_informes");
			if ($accion== "eliminar_registro_informe")			$retorno = permiso_agregado_accion("administrar_informes");
			if ($accion== "eliminar_accion_informe")			$retorno = permiso_agregado_accion("administrar_informes");
			// Funciones en core/usuarios.php
			if ($accion== "cambiar_clave")						$retorno = 1;
			if ($accion== "ver_seguimiento_monitoreo")			$retorno = permiso_agregado_accion("listar_usuarios");
			if ($accion== "resetear_clave")						$retorno = permiso_agregado_accion("listar_usuarios");
			if ($accion== "ver_seguimiento_general")			$retorno = permiso_agregado_accion("listar_usuarios");
			if ($accion== "ver_seguimiento_especifico")			$retorno = permiso_agregado_accion("listar_usuarios");
			if ($accion== "actualizar_clave")					$retorno = permiso_agregado_accion("cambiar_clave");
			if ($accion== "agregar_usuario")					$retorno = permiso_agregado_accion("listar_usuarios");
			if ($accion== "guardar_usuario")					$retorno = permiso_agregado_accion("listar_usuarios");
			if ($accion== "eliminar_usuario")					$retorno = permiso_agregado_accion("listar_usuarios");
			if ($accion== "cambiar_estado_usuario")				$retorno = permiso_agregado_accion("listar_usuarios");
			if ($accion== "permisos_usuario")					$retorno = permiso_agregado_accion("listar_usuarios");
			if ($accion== "agregar_permiso")					$retorno = permiso_agregado_accion("listar_usuarios");
			if ($accion== "eliminar_permiso")					$retorno = permiso_agregado_accion("listar_usuarios");
			if ($accion== "informes_usuario")					$retorno = permiso_agregado_accion("listar_usuarios");
			if ($accion== "agregar_informe_usuario")			$retorno = permiso_agregado_accion("listar_usuarios");
			if ($accion== "eliminar_informe_usuario")			$retorno = permiso_agregado_accion("listar_usuarios");
			if ($accion== "copiar_permisos")					$retorno = permiso_agregado_accion("listar_usuarios");
			// Funciones en core/menus.php
			if ($accion== "Ver_menu")							$retorno = 1;
			if ($accion== "guardar_menu")						$retorno = permiso_agregado_accion("administrar_menu");
			if ($accion== "eliminar_menu")						$retorno = permiso_agregado_accion("administrar_menu");
			if ($accion== "detalles_menu")						$retorno = permiso_agregado_accion("administrar_menu");
			if ($accion== "actualizar_menu")					$retorno = permiso_agregado_accion("administrar_menu");
			// Funciones en core/tablas.php
			if ($accion== "asistente_tablas")					$retorno = permiso_agregado_accion("administrar_tablas");
			if ($accion== "guardar_crear_tabla_asistente")		$retorno = permiso_agregado_accion("asistente_tablas");
			if ($accion== "editar_tabla")						$retorno = permiso_agregado_accion("guardar_crear_tabla_asistente");
			if ($accion== "eliminar_tabla")						$retorno = permiso_agregado_accion("administrar_tablas");
			if ($accion== "eliminar_campo")						$retorno = permiso_agregado_accion("editar_tabla");
			if ($accion== "guardar_crear_campo")				$retorno = permiso_agregado_accion("editar_tabla");
			if ($accion== "guardar_crear_tabla")				$retorno = permiso_agregado_accion("administrar_tablas");
			// Funciones en core/formularios.php
			if ($accion== "guardar_datos_formulario")			$retorno = 1;
			if ($accion== "eliminar_datos_formulario")			$retorno = 1;
			if ($accion== "actualizar_datos_formulario")		$retorno = 1;
			if ($accion== "actualizar_formulario")				$retorno = permiso_agregado_accion("administrar_formularios");
			if ($accion== "copiar_formulario")					$retorno = permiso_agregado_accion("administrar_formularios");
			if ($accion== "actualizar_campo_formulario")		$retorno = permiso_agregado_accion("administrar_formularios");
			if ($accion== "guardar_formulario")					$retorno = permiso_agregado_accion("administrar_formularios");
			if ($accion== "eliminar_formulario")				$retorno = permiso_agregado_accion("administrar_formularios");
			if ($accion== "editar_formulario")					$retorno = permiso_agregado_accion("administrar_formularios");
			if ($accion== "guardar_campo_formulario")			$retorno = permiso_agregado_accion("editar_formulario");
			if ($accion== "eliminar_campo_formulario")			$retorno = permiso_agregado_accion("editar_formulario");
			if ($accion== "guardar_accion_formulario")			$retorno = permiso_agregado_accion("editar_formulario");
			if ($accion== "eliminar_accion_formulario")			$retorno = permiso_agregado_accion("editar_formulario");
			// Funciones en core/sesion.php
			if ($accion== "Iniciar_login")						$retorno = 1;
			if ($accion== "Terminar_sesion")					$retorno = 1;
			if ($accion== "Mensaje_cierre_sesion")				$retorno = 1;
			// Funciones en core/objetos.php
			if ($accion== "cargar_objeto")						$retorno = 1;
			// Funciones en core/actualizacion.php
			if ($accion== "cargar_archivo")						$retorno = permiso_agregado_accion("actualizar_practico");
			if ($accion== "analizar_parche")					$retorno = permiso_agregado_accion("cargar_archivo");
			if ($accion== "aplicar_parche")						$retorno = permiso_agregado_accion("analizar_parche");
			//echo $Login_usuario.':Permiso heredado accion='.$accion.':'.$retorno.'<br>'; //Activar para depuracion permisos
			return $retorno;
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: permiso_agregado_accion
	Busca dentro de los permisos agregados de manera explicita al usuario.
	
	Variables de entrada:

		accion - Accion a ser ejectudada
		estado_aceptacion - Si el usuario cuenta o no con el permiso solicitado
		
	Salida:
		Retorna 1 en caso de encontrar el permiso
		Retorna 0 cuando no se encuentra un permiso
*/
	function permiso_agregado_accion($accion)
		{
			// Variable que determina el estado de aceptacion o rechazo del permiso 0=no permiso 1=ok permiso
			$retorno=0;
			global $ConexionPDO,$TablasCore,$Login_usuario;
			
			$consulta = $ConexionPDO->prepare("SELECT ".$TablasCore."menu.id FROM ".$TablasCore."usuario_menu,".$TablasCore."menu WHERE ".$TablasCore."menu.id=".$TablasCore."usuario_menu.menu AND usuario='$Login_usuario' AND ".$TablasCore."menu.comando='$accion' ");
			$consulta->execute();
			$registro = $consulta->fetch();
			if ($registro[0]!="")
				{
					$retorno=1;
				}
			//echo $Login_usuario.':Permiso agregado accion='.$accion.':'.$retorno.'<br>'; //Activar para depuracion permisos
			return $retorno;
		}


/* ################################################################## */
/* ################################################################## */
/*
	EN DESUSO - EN DESUSO - EN DESUSO: Ahora las acciones para admin siempre son ejecutadas.  Ver funcion permiso_accion
	Function: permiso_raiz_admin
	El super usuario no cuenta con ninguna entrada dentro de la tabla de permisos pues por defecto las ve todas.  En el caso de las funciones administrativas se agregan en el mapeo para el admin de manera que siempre le deje entrar.
	
	Variables de entrada:

		accion - Accion a ser ejectudada
		
	Salida:
		Retorna 1 en caso de encontrar el permiso
		Retorna 0 cuando no se encuentra un permiso
*/
	function permiso_raiz_admin($accion)
		{
			global $Login_usuario;
			// Variable que determina el estado de aceptacion o rechazo del permiso 0=no permiso 1=ok permiso
			$retorno=0;
			// Permisos o acciones raiz para el admin
			if ($Login_usuario=="admin")
				{
					switch ($accion)
						{
							case "cambiar_clave":
							case "guardar_configuracion":
							case "guardar_configws":
							case "guardar_params":
							case "administrar_tablas":
							case "administrar_formularios":
							case "administrar_informes":
							case "administrar_menu":
							case "listar_usuarios":
							case "actualizar_practico":
								$retorno = 1;
								break;
							default:
								$retorno = 0;
								break;
						}
				}
			//echo $Login_usuario.':Permiso raiz admin='.$accion.':'.$retorno.'<br>'; //Activar para depuracion permisos
			return $retorno;
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: permiso_accion
	Busca dentro de los permisos del usuario la accion a ejecutar de manera que valida si puede ingresar o no a ella.

	Variables de entrada:

		accion - Accion a ser ejectudada

	Salida:
		Retorna 1 en caso de encontrar el permiso
		Retorna 0 cuando no se encuentra un permiso
*/
	function permiso_accion($accion)
		{
			global $Login_usuario,$TablasCore;
			// Variable que determina el estado de aceptacion o rechazo del permiso 0=no permiso 1=ok permiso
			$retorno=0;

			// Evalua inicialmente permisos para el admin (evita queries)
			// $retorno=permiso_raiz_admin($accion);
			if ($Login_usuario=="admin") $retorno=1;

			// Si es un usuario estandar siempre entra, si es el admin entra si no es permiso raiz
			if (!$retorno)
				{
					// Busca permisos agregados directamente al usuario
					$retorno=permiso_agregado_accion($accion);
					// Si no encuentra permisos directos, busca en los heredados de los directos
					if (!$retorno)
						{
							// Si no encuentra el permiso directo llama los heredados
							$retorno=permiso_heredado_accion($accion);
						}
					//Si no encuentra en los heredados busca en preautorizados por configuracion
					if (!$retorno)
						{
							$resultado=ejecutar_sql("SELECT id from ".$TablasCore."parametros WHERE funciones_personalizadas LIKE '%$accion%' ");
							$parametros = $resultado->fetch();
							//Si encuentra un registro con la accion preautorizada entonces autoriza al usuario
							if ($parametros["id"]!="")
								$retorno=1;
						}
				}

			//echo $Login_usuario.':Permiso accion='.$accion.':'.$retorno.'<br>'; //Activar para depuracion permisos
			return $retorno;
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: escapar_url
	Limpia cadenas y URLs a ser impresas para evitar posibles ataques por XSS
	En general, se debe limpiar cualquier variable enviada por el usuario y que vaya a ser impresa en su navegador para evitar que al imprimirla se puedan enviar javascripts o similares

	Variables de entrada:

		texto - URL, texto, variable de entrada o cualquier otro valor a escapar.

	Salida:
		Cadena filtrada
*/
	function escapar_contenido($texto)
		{
			//$texto = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $texto); // Muy estricto
			$texto = str_ireplace("script","",$texto);

			return $texto;
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: gzdecode
	Crea una funcion de descompresion en caso de no estar disponible en la instalacion de PHP actual
*/
	if (!function_exists('gzdecode'))
		{
			function gzdecode($cadena)
				{
					return gzinflate(substr($cadena,10,-8));
				}
		}


/* ################################################################## */
/* ################################################################## */
  function limpiar_entradas()
	{
			/*
				Function: limpiar_entradas
				Limpia cadenas y URLs a ser impresas segun acciones para evitar XSS

				Salida:
					Cadenas y variables filtradas sobre sus valores globales
			*/
		global $accion,$error_titulo,$error_descripcion;
		// Escapar siempre las acciones pues deberian tener solo letras, numeros y underlines.
		$accion=escapar_contenido($accion);
		$accion = preg_replace("/[^A-Za-z0-9_]/", "", $accion);
		
		// Escapa siempre los mensajes de error
		$error_titulo=escapar_contenido($error_titulo);
		$error_titulo = preg_replace("/[^A-Za-z0-9_ ><]/", "", $error_titulo);
		$error_descripcion=escapar_contenido($error_descripcion);
		$error_descripcion = preg_replace("/[^A-Za-z0-9_ ><]/", "", $error_descripcion);
		
		// Escapa otras variables de uso comun
		global $error_titulo,$error_descripcion;
		$error_titulo=escapar_contenido($error_titulo);
		$error_descripcion=escapar_contenido($error_descripcion);

		// Escapar algunas variables segun la accion recibida
		if ($accion=="ver_seguimiento_general")
			{
				global $accionbuscar,$fin_reg,$inicio_reg;
				$accionbuscar=escapar_contenido($accionbuscar);
				$inicio_reg=escapar_contenido($inicio_reg);
				$fin_reg=escapar_contenido($fin_reg);
			}

		if ($accion=="administrar_formularios")
			{
				global $error_descripcion,$error_titulo;
				$error_descripcion=escapar_contenido($error_descripcion);
				$error_titulo=escapar_contenido($error_titulo);
			}

		if ($accion=="actualizar_menu")
			{
				global $id;
				$id=escapar_contenido($id);
			}

		if ($accion=="detalles_menu")
			{
				global $id;
				$id=escapar_contenido($id);
			}

		if ($accion=="editar_informe")
			{
				// 
				global $informe;
				$informe=escapar_contenido($informe);
			}

		if ($accion=="listar_usuarios")
			{
				global $login_filtro,$nombre_filtro;
				$login_filtro=escapar_contenido($login_filtro);
				$nombre_filtro=escapar_contenido($nombre_filtro);
			}
			
		if ($accion=="cargar_objeto")
			{
				global $objeto;
				$objeto=escapar_contenido($objeto);
			}

		if ($accion=="guardar_formulario")
			{
				global $tabla_datos;
				$tabla_datos=escapar_contenido($tabla_datos); // Revisar si afecta el script de autorun
			}
			
		if ($accion=="Iniciar_login")
			{
				global $uid,$clave,$captcha;
				$uid=escapar_contenido($uid);
				$clave=escapar_contenido($clave);
				$captcha=escapar_contenido($captcha);
			}
	}


/* ################################################################## */
/* ################################################################## */
	function TextoAleatorio($longitud)
		{
			/*
				Function: TextoAleatorio
				Genera un texto alfanumerico aleatorio de una longitud determinada

				Variables de entrada:

					longitud - Numero de caracteres que deben ser retornados en la cadena

				Salida:
					Cadena aleatoria
			*/
			$plantilla = "23456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$clave="";
			for($i=0;$i<$longitud;$i++)
				{
					$clave .= $plantilla{rand(0,strlen($plantilla)-1)};
				}
			return $clave;
		}


/* ################################################################## */
/* ################################################################## */
	function CodigoQR($contenido,$recuperacion_errores="L",$ancho_pixeles=3,$margen_pixeles=1,$ruta_almacenamiento="tmp/",$archivo="")
		{
			/*
				Function: CodigoQR
				Genera un codigo QR a partir de los parametros recibidos

				Variables de entrada:

					contenido - Texto que debera ser representado en el codigo QR
					recuperacion_errores - Recuperacion de errores para el codigo (L,M,Q,H) L el mas bajo, H el mas alto
					ancho_pixeles - Tamano de cada cuadro del codigo en pixeles
					margen_pixeles - La margen externa del codigo QR
					ruta_almacenamiento - Path sobre el cual se almacenara el codigo, debe contar con permisos de escritura
					archivo - nombre de archivo (sin extension) sobre el cual sera guardado el codigo

				Salida:
					Imagen generada para el codigo QR
			*/
			include_once("inc/qrcode/qrcode.php");
			//Si no se recibe un archivo entonces genera uno aleatorio
			if ($archivo=="") $archivo="QR".TextoAleatorio(15);
			//Genera el archivo con el QR
			$Ruta_QRC=$ruta_almacenamiento.$archivo.".png";
			QRcode::png($contenido, $Ruta_QRC, $recuperacion_errores, $ancho_pixeles, $margen_pixeles);
			//Devuelve el codigo QR como etiqueta de imagen HTML
			return '<img src="'.$Ruta_QRC.'" alt="" border="0">';
		}


/* ################################################################## */
/* ################################################################## */
	function filtrar_cadena_sql($cadena)
		{
			/*
				Function: filtrar_cadena_sql
				Filtra los caracteres existentes en una cadena de manera que no permita comillas sencillas, backslash o cualquier otro caracter que genere problemas en las consultas o posibles fallos de seguridad derivados de un SQLInjection

				Variables de entrada:

					cadena - Cadena a filtrar

				Salida:
					Retorna cadena sin caracteres ilegales o posibles inyecciones

					' or "='
					'' or 1=1 -- and ''=''
					admin' --
					admin' #
					admin'/*
					' or 1=1--
					' or 1=1#
					' or 1=1/*
					') or '1'='1--
					') or ('1'='1--
					1' and ''=' 
					' OR 'A'='A
			*/
			global $accion;

			if ($accion=="Iniciar_login")
				{
					$cadena = str_ireplace("''","'",$cadena);
					$cadena = str_ireplace("\\","",$cadena);
					$cadena = str_ireplace("COPY","",$cadena);
					$cadena = str_ireplace("DELETE","",$cadena);
					$cadena = str_ireplace("DROP","",$cadena);
					$cadena = str_ireplace("DUMP","",$cadena);
					$cadena = str_ireplace(" OR ","",$cadena);
					$cadena = str_ireplace("%","",$cadena);
					$cadena = str_ireplace("LIKE","",$cadena);
					$cadena = str_ireplace("--","",$cadena);
					$cadena = str_ireplace("^","",$cadena);
					$cadena = str_ireplace("[","",$cadena);
					$cadena = str_ireplace("]","",$cadena);
					$cadena = str_ireplace("!","",$cadena);
					$cadena = str_ireplace("¡","",$cadena);
					$cadena = str_ireplace("?","",$cadena);
					$cadena = str_ireplace("&","",$cadena);
				}
				
			// Expresiones que siempre deben ser filtradas	
			$cadena = str_ireplace("BENCHMARK","",$cadena);

			/*
			array_walk($_POST, 'filtrar_cadena_sql');
			array_walk($_GET, 'filtrar_cadena_sql');
			//$cadena = str_ireplace("SELECT","",$cadena);
			//$cadena = str_ireplace("=","",$cadena);
			*/
			return $cadena;
		}


/* ################################################################## */
/* ################################################################## */
	function ejecutar_sql($query,$lista_parametros="")
		{
			/*
				Function: ejecutar_sql
				Ejecuta consultas que retornan registros (SELECTs).

				Variables de entrada:

					query - Consulta preformateada para ser ejecutada en el motor
					lista_parametros - Lista de variables PHP con parametros que deben ser preparados para el query separados por $_SeparadorCampos_
					
				Salida:
					Retorna mensaje en pantalla con la descripcion devuelta por el driver en caso de error
					Retorna una variable con el arreglo de resultados en caso de ser exitosa la consulta
			*/
			global $ConexionPDO,$ModoDepuracion;
			global $MULTILANG_ErrorTiempoEjecucion,$MULTILANG_Detalles,$MULTILANG_ErrorSoloAdmin;
			global $accion;
			global $Login_usuario,$_SeparadorCampos_;
			
			// Filtra la cadena antes de ser ejecutada
			$query=filtrar_cadena_sql($query);

			try
				{
					$consulta = $ConexionPDO->prepare($query);
					//Cuando se reciben parametros entonces se asume recepcion de querys con  interrogaciones  ?
					//que deben ser preparados antes de ejecutarse con cada uno de los parametros recibidos
					if ($lista_parametros!="")
						{
							$cantidad_parametros=substr_count($query,'?');
							$parametros=explode($_SeparadorCampos_,$lista_parametros);
							// if ($cantidad_parametros!=count($parametros)) //La cantidad de parametros en query es diferente a los recibidos
							//Recorre cada parametro y toma su valor
							for ($i=1;$i<=$cantidad_parametros;$i++)
								{
									$consulta->bindValue($i, $parametros[$i-1]);
									//echo 'Parametro '.$i.'='.$parametros[$i-1]."<br>"; //PARA DEPURACION
								}
						}
					$consulta->execute();
					return $consulta;
					//return $consulta->fetchAll();
				}
			catch( PDOException $ErrorPDO)
				{
					//Muestra detalles del query solo al admin y si el modo de depuracion se encuentra activo
					if ($Login_usuario=='admin' && $ModoDepuracion)
						$mensaje_final=$ErrorPDO->getMessage().'<br><b>'.$MULTILANG_Detalles.'</b>: '.$query;
					else
						$mensaje_final='<b>'.$MULTILANG_Detalles.'</b>: '.$MULTILANG_ErrorSoloAdmin;
					//Presenta el mensaje sobre el HTML y como Emergente JS
					mensaje($MULTILANG_ErrorTiempoEjecucion,$mensaje_final,'80%','icono_error.png','TextosEscritorio');
					echo '<script type="" language="JavaScript"> alert("'.$MULTILANG_ErrorTiempoEjecucion.'\\n\\n'.$mensaje_final.'");</script>';
					//Redirecciona segun la accion
					if ($accion=="Iniciar_login")
						echo '<form name="Acceso" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="accion" value=""></form><script type="" language="JavaScript">	document.Acceso.submit();  </script>';
					return 1;
				}
		}



/* ################################################################## */
/* ################################################################## */
	function ejecutar_sql_unaria($query,$lista_parametros="")
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
			global $ConexionPDO,$ModoDepuracion;
			global $Login_usuario,$_SeparadorCampos_;
			global $MULTILANG_ErrorTiempoEjecucion,$MULTILANG_Detalles,$MULTILANG_ErrorSoloAdmin,$MULTILANG_ContacteAdmin,$MULTILANG_MotorBD;
			try
				{
					$consulta = $ConexionPDO->prepare($query);
					//Cuando se reciben parametros entonces se asume recepcion de querys con  interrogaciones  ?
					//que deben ser preparados antes de ejecutarse con cada uno de los parametros recibidos
					if ($lista_parametros!="")
						{
							$cantidad_parametros=substr_count($query,'?');
							$parametros=explode($_SeparadorCampos_,$lista_parametros);
							// if ($cantidad_parametros!=count($parametros)) //La cantidad de parametros en query es diferente a los recibidos
							//Recorre cada parametro y toma su valor
							for ($i=1;$i<=$cantidad_parametros;$i++)
								{
									$consulta->bindValue($i, $parametros[$i-1]);
									//echo 'Parametro '.$i.'='.$parametros[$i-1]."<br>"; //PARA DEPURACION
								}
						}
					$consulta->execute();
					return "";
				}
			catch( PDOException $ErrorPDO)
				{
					//Muestra detalles del query solo al admin y si el modo de depuracion se encuentra activo
					if ($Login_usuario=='admin' && $ModoDepuracion)
						echo '<script language="JavaScript"> alert("'.$MULTILANG_ErrorTiempoEjecucion.'\n'.$MULTILANG_Detalles.': '.$query.'\n\n'.$MULTILANG_MotorBD.': '.$ErrorPDO->getMessage().'.\n\n'.$MULTILANG_ContacteAdmin.'");  </script>';
					else
						echo '<script language="JavaScript"> alert("'.$MULTILANG_ErrorTiempoEjecucion.'\n'.$MULTILANG_Detalles.': '.$MULTILANG_ErrorSoloAdmin.'.\n\n'.$MULTILANG_ContacteAdmin.'");  </script>';
					return $MULTILANG_ErrorTiempoEjecucion;
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
	function auditar($accion,$usuario="")
		{
			global $ConexionPDO,$ArchivoCORE,$TablasCore;
			global $ListaCamposSinID_auditoria,$_SeparadorCampos_;
			global $Login_usuario,$fecha_operacion,$hora_operacion;
			//Establece el usuario para el registro
			if ($usuario=="")
				$usuario_auditar=$Login_usuario;
			else
				$usuario_auditar=$usuario;
			//Lleva el registro
			ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria (".$ListaCamposSinID_auditoria.") VALUES (?,?,?,?)","$usuario_auditar$_SeparadorCampos_$accion$_SeparadorCampos_$fecha_operacion$_SeparadorCampos_$hora_operacion");
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

			if($MotorBD=="sqlsrv" || $MotorBD=="mssql" || $MotorBD=="ibm" || $MotorBD=="dblib" || $MotorBD=="odbc")
					$consulta = "SELECT name FROM sysobjects WHERE xtype='U';";
			if($MotorBD=="sqlite")
					$consulta = "SELECT name FROM sqlite_master WHERE type IN ('table','view') AND name NOT LIKE 'sqlite_%' UNION ALL SELECT name FROM sqlite_temp_master WHERE type IN ('table','view') ORDER BY 1";
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
				Function: consultar_nombres_columnas
				Devuelve un arreglo escalar y asociativo con los nombres de las columnas de una tabla y sus datos generales

				Variables de entrada:

					tabla - Nombre de la tabla de la que se desea consultar los nombre de columnas o campos
					
				Salida:
					Vector de campos/columnas
				
				Ver tambien:
				<consultar_tablas>
			*/
			global $ConexionPDO;
			global $MotorBD;
			global $BaseDatos;
			global $MULTILANG_ErrorTiempoEjecucion;

			//Busca los campos dependiendo del motor de BD configurado actualmente
			if ($MotorBD=="mysql" || $MotorBD=="sqlsrv" || $MotorBD=="mssql" || $MotorBD=="ibm" || $MotorBD=="dblib" || $MotorBD=="odbc" || $MotorBD=="oracle" || $MotorBD=="ifmx" || $MotorBD=="fbd")
				{
					$columna=0;
					$resultado=ejecutar_sql("DESCRIBE $tabla ");
					//echo $resultado;
					//Evalua si se retorno 1 (error) por la funcion para saber si sigue o no
					//if($resultado!="1")
						{
							while($registro = $resultado->fetch())
								{
									$columnas[$columna]["nombre"] = $registro["Field"];
									$columnas[$columna]["tipo"] = $registro["Type"];
									$columnas[$columna]["nulo"] = $registro["Null"];
									$columnas[$columna]["llave"] = $registro["Key"];
									$columnas[$columna]["predefinido"] = $registro["Default"];
									$columnas[$columna]["extras"] = $registro["Extra"];
									$columna++;
								}							
						}
					/*else
						{
									$columnas[$columna]["nombre"] = "ERROR: Tabla no conectada";
									$columnas[$columna]["tipo"] = "ERROR: Tabla no conectada";
									$columnas[$columna]["nulo"] = "ERROR: Tabla no conectada";
									$columnas[$columna]["llave"] = "ERROR: Tabla no conectada";
									$columnas[$columna]["predefinido"] = "ERROR: Tabla no conectada";
									$columnas[$columna]["extras"] = "ERROR: Tabla no conectada";
									$columna++;
						}*/
				}

			if ($MotorBD=="pgsql")
				{
					$columna=0;
					$resultado=ejecutar_sql("SELECT * from INFORMATION_SCHEMA.COLUMNS where table_name = ? ","$tabla");
					while($registro = $resultado->fetch())
						{
							$columnas[$columna]["nombre"] = $registro["column_name"];
							$columnas[$columna]["tipo"] = $registro["data_type"];
							$columnas[$columna]["nulo"] = $registro["is_nullable"];
							$columnas[$columna]["llave"] = "";
							$columnas[$columna]["predefinido"] = $registro["column_default"];
							$columnas[$columna]["extras"] = $registro["udt_name"];
							$columna++;
						}
				}

			if ($MotorBD=="sqlite")
				{
					$columna=0;
					$resultado=ejecutar_sql("SELECT * FROM sqlite_master WHERE type='table' AND name=? ","$tabla");
					$registro = $resultado->fetch();
					//Toma los campos encontrados en el SQL de la tabla, los separa y los depura para devolver valores
					$campos=explode(",",$registro["sql"]);
					for($i=0;$i<count($campos);$i++)
						{
							$campos[$i]=trim($campos[$i]);  // Elimina espacios al comienzo y final
							$campos[$i]=str_replace("  "," ",$campos[$i]);  //Elimina espacios dobles
							if ($i==0) $campos[$i]=str_replace("CREATE TABLE $tabla (","",$campos[$i]);  //Elimina instruccion create del primer campo
							if ($i==count($campos)-1) $campos[$i]=str_replace("))",")",$campos[$i]);  //Elimina ultimos parentesis
							//echo $i." valor:".$campos[$i]."<hr>"; //  Usado para depuracion en tiempo de desarrollo
							$analisis_campo=explode(" ",$campos[$i]);
							$columnas[$columna]["nombre"] = $analisis_campo[0];
							$columnas[$columna]["tipo"] = $analisis_campo[1];
							$palabra_siguiente=2;
							if (trim(strtoupper($analisis_campo[$palabra_siguiente]))=="PRIMARY")
								{
									$columnas[$columna]["llave"] = $analisis_campo[$palabra_siguiente];
									$palabra_siguiente+=2;
								}
							if (trim(strtoupper($analisis_campo[$palabra_siguiente]))=="NOT")
								{
									$columnas[$columna]["nulo"] =  $analisis_campo[$palabra_siguiente]." ".$analisis_campo[$palabra_siguiente+1];
									$palabra_siguiente+=2;
								}
							if (trim(strtoupper($analisis_campo[$palabra_siguiente]))=="DEFAULT")
								{
									$columnas[$columna]["predefinido"] =  $analisis_campo[$palabra_siguiente+1];
									$palabra_siguiente+=2;
								}
							$columnas[$columna]["extras"] = $registro[""];
							$columna++;
						}
				}


			//Retorna el arreglo asociativo
			return $columnas;


			/*//Forma 1 (General solo nombres)
			$resultado=ejecutar_sql("SELECT * FROM ".$tabla);
			$columnas = array();
			foreach($resultado->fetch(PDO::FETCH_ASSOC) as $key=>$val)
				{
					$columnas[]["nombre"] = $key;
				}
			return $columnas;*/

			/*//Forma 2
			$resultado=ejecutar_sql("SELECT * FROM ".$tabla);
			$columnas = array();
			for ($i = 0; $i < $resultado->columnCount(); $i++)
				{
					$col = $resultado->getColumnMeta($i);
					$columnas[] = $col['name'];
				}
			return $columnas;*/
		}


/* ################################################################## */
/* ################################################################## */
	function existe_campo_tabla($campo,$tabla)
		{
			/*
				Function: existe_campo_tabla
				Determina si un campo dado existe dentro de una tabla especifica

				Variables de entrada:

					tabla - Nombre de la tabla de la que se desea buscar el campo
					campo - Nombre del campo a verificar
					
				Salida:
					verdadero o falso dependiendo de si existe o no el campo en la tabla
				
				Ver tambien:
				<consultar_tablas>
			*/
			
			//Asume que el campo no existe
			$estado=false;

			//Busca todos los campos de la tabla
			$resultadocampos=consultar_columnas($tabla);
			for($i=0;$i<count($resultadocampos);$i++)
				{
					//Si el campo en el arreglo es igual al campo buscado cambia el estado a verdadero
					if ($resultadocampos[$i]["nombre"]==$campo)
						$estado=true;
				}

			//Retorna el resultado
			return $estado;
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: file_get_contents_curl
	Un reemplazo para la funcion file_get_contents utilizando cURL

	Salida:
		Contenido de la URL recibida
*/
	function file_get_contents_curl($url)
		{
			global $MULTILANG_ErrExtension,$MULTILANG_ErrCURL;
			//Verifica soporte para cURL
			if (!extension_loaded('curl'))
				mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrCURL,'','icono_error.png','TextosEscritorio');
			//Verifica que la funcion se encuentre activada
			$funcion_evaluada='curl_init'; $valor_esperado='1';
			if (ini_get($funcion_evaluada)==$valor_esperado)
				{
					//Inicializa el objeto cURL y procesa la solicitud
					$objeto_curl = curl_init();
					curl_setopt($objeto_curl, CURLOPT_HEADER, 0);
					curl_setopt($objeto_curl, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($objeto_curl, CURLOPT_URL, $url);
					$datos_recibidos = curl_exec($objeto_curl);
					curl_close($objeto_curl);
				}
			return $datos_recibidos;
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: file_get_contents_socket
	Un reemplazo para la funcion file_get_contents utilizando Sockets
*/
	function file_get_contents_socket($url)
		{
			$url_parsed = parse_url($url);
			$host = $url_parsed["host"];
			$port = $url_parsed["port"];
			if ($port==0)
				$port = 80;
			$path = $url_parsed["path"];
			if ($url_parsed["query"] != "")
				$path .= "?".$url_parsed["query"];

			$out = "GET $path HTTP/1.0\r\nHost: $host\r\n\r\n";

			$fp = fsockopen($host, $port, $errno, $errstr, 30);

			fwrite($fp, $out);
			$body = false;
			while (!feof($fp))
				{
					$s = fgets($fp, 1024);
					if ( $body )
						$in .= $s;
					if ( $s == "\r\n" )
						$body = true;
				}
			fclose($fp);
			return $in;
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: cargar_url
	Recibe una URL y pasa su contenido a una cadena de texto
*/
	function cargar_url($url)
		{
			$contenido_url="";

			//Intenta con cURL si esta habilitado
			$funcion_evaluada='curl_init'; $valor_esperado='1';
			if (@$contenido_url=="")
				if (ini_get($funcion_evaluada)==$valor_esperado)
					$contenido_url = trim(file_get_contents_curl($url));

			$funcion_evaluada='allow_url_fopen'; $valor_esperado='1';
			//Intenta con la funcion nativa de PHP si esta habilitada y no se pudo obtener nada con cURL
			if (@$contenido_url=="")
				if (ini_get($funcion_evaluada)==$valor_esperado)
					$contenido_url = trim(file_get_contents($url));

			//Intenta con funciones de socket si no se pudo obtener nada con file_get_contents
			if (@$contenido_url=="")
				$contenido_url = trim(file_get_contents_socket($url));

			//Retorna el resultado
			return $contenido_url;
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
			global $MULTILANG_ErrExtension,$MULTILANG_ErrSimpleXML,$MULTILANG_ErrCURL,$MULTILANG_ErrLDAP,$MULTILANG_ErrHASH,$MULTILANG_ErrSESS,$MULTILANG_ErrGD,$MULTILANG_ErrPDO,$MULTILANG_ErrDriverPDO,$MULTILANG_ErrGoogleAPIMod,$MULTILANG_ErrFuncion,$MULTILANG_ErrDirectiva;

			//Verifica estado de configuraciones PHP
			$funcion_evaluada='allow_url_fopen'; $valor_esperado='1';
				//Intenta encenderla (para servidores con suPHP)
				if (ini_get($funcion_evaluada)!=$valor_esperado) {ini_set($funcion_evaluada,$valor_esperado);}
				//Verifica si pudo ser encendida en tiempo de ejecucion, sino muestra mensaje y solamente si no hay cURL pues es un sustituto
				if (ini_get($funcion_evaluada)!=$valor_esperado && !extension_loaded('curl'))
					mensaje($MULTILANG_ErrFuncion,$funcion_evaluada.': '.$MULTILANG_ErrDirectiva,'','icono_error.png','TextosEscritorio');
			
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

			//Verifica soporte para SimpleXML
			if (!extension_loaded('SimpleXML'))
				mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrSimpleXML,'','icono_error.png','TextosEscritorio');
			
			// Bloqueos por IP/pais http://stackoverflow.com/questions/15835274/file-get-contents-failed-to-open-stream-connection-refused
			
			// Verifica el soporte para funciones especificas PHP
			$funcion_evaluada='file_get_contents';
			if (!function_exists($funcion_evaluada))
				mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrFuncion.'<b>'.$funcion_evaluada.'</b>','','icono_error.png','TextosEscritorio');
			
		}


/* ################################################################## */
/* ################################################################## */
	function buscar_actualizaciones($Login_usuario='',$accion='')
		{
			global $MULTILANG_Atencion,$MULTILANG_ActAlertaVersion;
			// Genera un aleatorio entre 1 y 10 para no sacar siempre el aviso y buscar nuevas versiones.
			$buscar=rand(0,7);
			if ($Login_usuario=="admin" && $accion=="Ver_menu" && $buscar==1)
				{
					$path_ultima_version="https://raw.githubusercontent.com/unix4you2/practico/master/dev_tools/version_publicada.txt";
					$version_actualizada = @cargar_url($path_ultima_version);
					$archivo_origen="inc/version_actual.txt";
					$archivo = fopen($archivo_origen, "r");
					if ($archivo)
						{
							$version_practico = trim(fgets($archivo, 1024));
							fclose($archivo);
						}
					if ($version_actualizada>$version_practico)
						mensaje($MULTILANG_Atencion,$MULTILANG_ActAlertaVersion,'','fa fa-exclamation-triangle fa-5x','TextosEscritorio');
				}
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
		  global $ArchivoCORE,$LlaveDePaso;
		  global $MULTILANG_Usuario,$MULTILANG_Contrasena,$MULTILANG_CodigoSeguridad,$MULTILANG_IngreseCodigoSeguridad,$MULTILANG_TituloLogin,$MULTILANG_Importante,$MULTILANG_AccesoExclusivo,$MULTILANG_Ingresar,$MULTILANG_OauthLogin,$MULTILANG_LoginClasico,$MULTILANG_LoginOauthDes;
			// Variables para OAuth desde el archivo de configuracion
			global $APIGoogle_ClientId,$APIGoogle_ClientSecret;
			global $APIFacebook_ClientId,$APIFacebook_ClientSecret;
			global $APILinkedIn_ClientId,$APILinkedIn_ClientSecret;
			global $APIInstagram_ClientId,$APIInstagram_ClientSecret;
			global $APIDropbox_ClientId,$APIDropbox_ClientSecret;
			global $APIMicrosoft_ClientId,$APIMicrosoft_ClientSecret;
			global $APIFlickr_ClientId,$APIFlickr_ClientSecret;
			global $APITwitter_ClientId,$APITwitter_ClientSecret;
			global $APIFoursquare_ClientId,$APIFoursquare_ClientSecret;
			global $APIXING_ClientId,$APIXING_ClientSecret;
			global $APISalesforce_ClientId,$APISalesforce_ClientSecret;
			global $APIBitbucket_ClientId,$APIBitbucket_ClientSecret;
			global $APIYahoo_ClientId,$APIYahoo_ClientSecret;
			global $APIBox_ClientId,$APIBox_ClientSecret;
			global $APIDisqus_ClientId,$APIDisqus_ClientSecret;
			global $APIEventful_ClientId,$APIEventful_ClientSecret;
			global $APISurveyMonkey_ClientId,$APISurveyMonkey_ClientSecret;
			global $APIRightSignature_ClientId,$APIRightSignature_ClientSecret;
			global $APIFitbit_ClientId,$APIFitbit_ClientSecret;
			global $APIScoopIt_ClientId,$APIScoopIt_ClientSecret;
			global $APITumblr_ClientId,$APITumblr_ClientSecret;
			global $APIStockTwits_ClientId,$APIStockTwits_ClientSecret;
			global $APIVK_ClientId,$APIVK_ClientSecret;
			global $APIWithings_ClientId,$APIWithings_ClientSecret;

			// Variable que determina si se tiene activo al menos un proveedor OAuth
			$AlMenosUnOAuth=0;

			echo '
					<br><br>
					<div align="center">
					';
			abrir_ventana($MULTILANG_TituloLogin,'#EADEDE','620');
			?>

			<script language="javascript"> 
				function IntercambiarLogin(Seccion,Imagen)
					{
						var ele = document.getElementById(Seccion);
						if (ele.style.display == "none")
							{
								ele.style.display = "block";
								ele.style.visibility = "visible";
							}
						else
							{
								ele.style.display = "none";
								ele.style.visibility = "hidden";
							}
						if (LoginClasico.style.visibility == "visible")
							img_login.src="img/practico_login.png";
						if (LoginOauth.style.visibility == "visible")
							img_login.src="img/practico_social.png";
					}
			</script>

						<div align="center">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr>
								<td align="center">

										<div id="LoginOauth" style="display:none; visibility:hidden; ">
										<table width="350" border="0" cellspacing="10" cellpadding="0" class="TextosVentana" align="center">
												<tr bgcolor="#AAA6AD"><td align="center"><font face="Verdana,Tahoma, Arial" style="font-size: 9px;">
													<?php echo $MULTILANG_LoginOauthDes; ?>
												</td></tr>
												<tr><td align="center"><font face="Verdana,Tahoma, Arial" style="font-size: 9px;">
													
													<?php
														// Crea los formularios de redireccion segun proveedor
														function CreaFormOauth($sitio)
															{
																global $ArchivoCORE;
																// Crea el formulario correspondiente para llamar el login con el proveedor
																echo '
																	<form name="login_'.$sitio.'" method="POST" action="'.$ArchivoCORE.'" style="margin: 2; display: inline!important;">
																	<input type="hidden" name="WSOn" value="1">
																	<input type="hidden" name="OAuthSrv" value="'.$sitio.'">
																	<input type="hidden" name="WSId" value="autenticacion_oauth">
																	<input type="image" src="inc/oauth/logos/'.strtolower($sitio).'.png" border=0 width=81 height=30 style="background:#FFFFFF;"> <!--94x35|81x30-->
																	</form>';
																// Retorna valor de activacion a variable AlMenosUnOAuth
																return 1;
															}
															
														if ($APIGoogle_ClientId!=''			&& $APIGoogle_ClientSecret!='')			$AlMenosUnOAuth+=CreaFormOauth('Google');
														if ($APIFacebook_ClientId!=''		&& $APIFacebook_ClientSecret!='')		$AlMenosUnOAuth+=CreaFormOauth('Facebook');
														if ($APILinkedIn_ClientId!=''		&& $APILinkedIn_ClientSecret!='')		$AlMenosUnOAuth+=CreaFormOauth('LinkedIn');
														if ($APIInstagram_ClientId!=''		&& $APIInstagram_ClientSecret!='')		$AlMenosUnOAuth+=CreaFormOauth('Instagram');
														if ($APIDropbox_ClientId!=''		&& $APIDropbox_ClientSecret!='')		$AlMenosUnOAuth+=CreaFormOauth('Dropbox');
														if ($APIMicrosoft_ClientId!=''		&& $APIMicrosoft_ClientSecret!='')		$AlMenosUnOAuth+=CreaFormOauth('Microsoft');
														if ($APIFlickr_ClientId!=''			&& $APIFlickr_ClientSecret!='')			$AlMenosUnOAuth+=CreaFormOauth('Flickr');
														if ($APITwitter_ClientId!=''		&& $APITwitter_ClientSecret!='')		$AlMenosUnOAuth+=CreaFormOauth('Twitter');
														if ($APIFoursquare_ClientId!=''		&& $APIFoursquare_ClientSecret!='')		$AlMenosUnOAuth+=CreaFormOauth('Foursquare');
														if ($APIXING_ClientId!=''			&& $APIXING_ClientSecret!='')			$AlMenosUnOAuth+=CreaFormOauth('XING');
														if ($APISalesforce_ClientId!=''		&& $APISalesforce_ClientSecret!='')		$AlMenosUnOAuth+=CreaFormOauth('Salesforce');
														if ($APIBitbucket_ClientId!=''		&& $APIBitbucket_ClientSecret!='')		$AlMenosUnOAuth+=CreaFormOauth('Bitbucket');
														if ($APIYahoo_ClientId!=''			&& $APIYahoo_ClientSecret!='')			$AlMenosUnOAuth+=CreaFormOauth('Yahoo');
														if ($APIBox_ClientId!=''			&& $APIBox_ClientSecret!='')			$AlMenosUnOAuth+=CreaFormOauth('Box');
														if ($APIDisqus_ClientId!=''			&& $APIDisqus_ClientSecret!='')			$AlMenosUnOAuth+=CreaFormOauth('Disqus');
														if ($APIEventful_ClientId!=''		&& $APIEventful_ClientSecret!='')		$AlMenosUnOAuth+=CreaFormOauth('Eventful');
														if ($APISurveyMonkey_ClientId!=''	&& $APISurveyMonkey_ClientSecret!='')	$AlMenosUnOAuth+=CreaFormOauth('SurveyMonkey');
														if ($APIRightSignature_ClientId!=''	&& $APIRightSignature_ClientSecret!='')	$AlMenosUnOAuth+=CreaFormOauth('RightSignature');
														if ($APIFitbit_ClientId!=''			&& $APIFitbit_ClientSecret!='')			$AlMenosUnOAuth+=CreaFormOauth('Fitbit');
														if ($APIScoopIt_ClientId!=''		&& $APIScoopIt_ClientSecret!='')		$AlMenosUnOAuth+=CreaFormOauth('ScoopIt');
														if ($APITumblr_ClientId!=''			&& $APITumblr_ClientSecret!='')			$AlMenosUnOAuth+=CreaFormOauth('Tumblr');
														if ($APIStockTwits_ClientId!=''		&& $APIStockTwits_ClientSecret!='')		$AlMenosUnOAuth+=CreaFormOauth('StockTwits');
														if ($APIVK_ClientId!=''				&& $APIVK_ClientSecret!='')				$AlMenosUnOAuth+=CreaFormOauth('VK');
														if ($APIWithings_ClientId!=''		&& $APIWithings_ClientSecret!='')		$AlMenosUnOAuth+=CreaFormOauth('Withings');
													?>
													<hr>
													<input type="Button"  class="BotonesGoogle" value="<<< <?php echo $MULTILANG_LoginClasico; ?> >>>"  OnClick="IntercambiarLogin('LoginOauth');IntercambiarLogin('LoginClasico');">
												</td></tr>
										</table>
										</div>

										<div id="LoginClasico" style="display:block; visibility:visible; ">
										<table width="100%" border="0" cellspacing="3" cellpadding="0" class="TextosVentana" align="center">
												<tr><td align="center"><font face="Verdana,Tahoma, Arial" style="font-size: 9px;">
												
													<form name="login_usuario" method="POST" action="<?php echo $ArchivoCORE; ?>" style="margin-top: 0px; margin-bottom: 0px;" onsubmit="if (document.login_usuario.captcha.value=='' || document.login_usuario.uid.value=='' || document.login_usuario.clave.value=='') { alert('Debe diligenciar los valores necesarios (Usuario, Clave y Codigo de seguridad).'); return false; }">
													<input type="Hidden" name="accion" value="Iniciar_login">
													<table width="350" border="0" cellspacing="7" cellpadding="0" class="TextosVentana" align="center">
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
													</form>
													<?php
														// Muestra boton de login por red social si aplica
														if ($AlMenosUnOAuth>0)
															echo '<hr>
																<input type="Button"  class="BotonesGoogle" value="<<< '.$MULTILANG_OauthLogin.' >>>" OnClick="IntercambiarLogin(\'LoginOauth\');IntercambiarLogin(\'LoginClasico\');">';
													?>
												</td></tr>
										</table>
										</div>


								</td>
								<td align="center">
										<img name="img_login" id="img_login" src="img/practico_login.png" alt="" border="0">
								</td>
						</tr></table>
						
						</div>

						<script language="JavaScript"> login_usuario.uid.focus(); </script>

			<?php
			mensaje($MULTILANG_Importante,$MULTILANG_AccesoExclusivo,'100%','../img/tango_dialog-information.png','TextosVentana');
			cerrar_ventana();
			echo '</div>';
	  }



/* ################################################################## */
/* ################################################################## */
	function abrir_ventana($titulo,$fondo,$ancho='100%',$barra_herramientas='')
	  {
		global $PlantillaActiva,$MULTILANG_VistaImpresion;
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
							<table width="100%" border="0" cellspacing="0" cellpadding="0" background="skin/'.$PlantillaActiva.'/img/bar_c.jpg"><tr>
									<td valign=top><img src="skin/'.$PlantillaActiva.'/img/bar_i.gif" border=0 alt=" "></td>
									<td width="100%" align="CENTER" background="skin/'.$PlantillaActiva.'/img/bar_c.jpg">
										<font face="" style="font-family: Verdana, Tahoma, Arial; font-size: 10px; color: Black;"><b>
												'.$titulo.'
										</b></font>
									</td>
									<!-- Barra de botones de ventana -->
									<td valign=top align="RIGHT" background="skin/'.$PlantillaActiva.'/img/bar_c.jpg">';
										// Si se recibe una barra de herramientas la dibuja
										if ($barra_herramientas!='')
											echo $barra_herramientas;
		echo '						</td>
									<td valign=top><img src="skin/'.$PlantillaActiva.'/img/bar_d.gif " border=0 alt=""></td>
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
				icono - Imagen que acompana el texto ubicada al lado izquierdo.  Tamano y formato libre.  Permite notacion de Awesome Fonts
				ancho - Ancho del espacio de trabajo definido en pixels o porcentaje sobre el contenedor principal.
				estilo - Especifica el punto donde sera publicado el mensaje para definir la hoja de estilos correspondiente.
		*/
        
        //Verifica si es una imagen, sino lo asume como AwesomeFonts
        if (strpos($icono, ".png") || strpos($icono, ".jpg") || strpos($icono, ".gif"))
            $cadena_icono='<img src="img/'.$icono.'" alt="" border="0">';
        else
            $cadena_icono='<i class="'.$icono.'"></i>';

		echo '<table width="'.$ancho.'" border="0" cellspacing="5" cellpadding="0" align="center" class="'.$estilo.'">
				<tr>
					<td valign="top">'.$cadena_icono.'
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
			$tipo_entrada="text"; // Se cambia a date si se trata de un campo con validacion de fecha, si se cambia a password es tipo clave...

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
			//Evalua si el valor predeterminado tiene signo $ al comienzo y ademas es una variable definida para poner su valor.
			if (substr($registro_campos["valor_predeterminado"], 0,1)=="$")
				{
					$nombre_variable = substr($registro_campos["valor_predeterminado"], 1);
					global ${$nombre_variable};
					if (isset($nombre_variable))
						{
							$valor_variable=$$nombre_variable;
							$cadena_valor=' value="'.$valor_variable.'" ';							
						}
				}
			$valor_variable_escapada=$registro_datos_formulario["$nombre_campo"];
			//$valor_variable_escapada=addslashes ( '"'.$valor_variable_escapada.'"' );
			$valor_variable_escapada=htmlentities($valor_variable_escapada); //Presenta la cadena como caracteres especiales HTML para ayudar a presentar correctamente tildes, comillas y barras
			if ($campobase!="" && $valorbase!="") $cadena_valor=' value="'.$valor_variable_escapada.'" ';

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

			// Si el campo es de tipo clave cambia el input a password
			if ($registro_campos["tipo"]=="texto_clave")
				{
					$tipo_entrada="password";
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
	Function: cargar_objeto_oculto
	Genera el codigo HTML y CSS correspondiente a un campo de texto pero oculto (hidden) vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos
		formulario - ID unico del formulario al cual pertenece el objeto

	Salida:

		HTML asociado al objeto publicado dentro del formulario

	Ver tambien:
		<cargar_formulario>
*/
	function cargar_objeto_oculto($registro_campos,$registro_datos_formulario,$formulario,$en_ventana)
		{
			global $campobase,$valorbase;

			$salida='';
			$nombre_campo=$registro_campos["campo"];
			$tipo_entrada="hidden";

			// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
			$cadena_valor='';
			if ($registro_campos["valor_predeterminado"]!="") $cadena_valor=' value="'.$registro_campos["valor_predeterminado"].'" ';
			//Evalua si el valor predeterminado tiene signo $ al comienzo y ademas es una variable definida para poner su valor.
			if (substr($registro_campos["valor_predeterminado"], 0,1)=="$")
				{
					$nombre_variable = substr($registro_campos["valor_predeterminado"], 1);
					global ${$nombre_variable};
					if (isset($nombre_variable))
						{
							$valor_variable=$$nombre_variable;
							$cadena_valor=' value="'.$valor_variable.'" ';							
						}
				}
			if ($campobase!="" && $valorbase!="") $cadena_valor=' value="'.$registro_datos_formulario["$nombre_campo"].'" ';

			// Muestra el campo
			$salida.='<input type="'.$tipo_entrada.'" name="'.$registro_campos["campo"].'" value="'.$cadena_valor.'" >';
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
			if ($registro_campos["valor_predeterminado"]!="") $cadena_valor=$registro_campos["valor_predeterminado"];
			//Evalua si el valor predeterminado tiene signo $ al comienzo y ademas es una variable definida para poner su valor.
			if (substr($registro_campos["valor_predeterminado"], 0,1)=="$")
				{
					$nombre_variable = substr($registro_campos["valor_predeterminado"], 1);
					global ${$nombre_variable};
					if (isset($nombre_variable))
						{
							$valor_variable=$$nombre_variable;
							$cadena_valor=' value="'.$valor_variable.'" ';							
						}
				}
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
			if ($registro_campos["valor_predeterminado"]!="") $cadena_valor=$registro_campos["valor_predeterminado"];
			//Evalua si el valor predeterminado tiene signo $ al comienzo y ademas es una variable definida para poner su valor.
			if (substr($registro_campos["valor_predeterminado"], 0,1)=="$")
				{
					$nombre_variable = substr($registro_campos["valor_predeterminado"], 1);
					global ${$nombre_variable};
					if (isset($nombre_variable))
						{
							$valor_variable=$$nombre_variable;
							$cadena_valor=' value="'.$valor_variable.'" ';							
						}
				}
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
			@$barra_editor.="['-']";
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
	function cargar_objeto_lista_seleccion($registro_campos,$registro_datos_formulario,$formulario,$en_ventana)
		{
			global $campobase,$valorbase;
			global $MULTILANG_TitValorUnico,$MULTILANG_DesValorUnico,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio;

			$salida='';
			$nombre_campo=$registro_campos["campo"];

			// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
			if ($campobase!="" && $valorbase!="") $cadena_valor=$registro_datos_formulario["$nombre_campo"];
			
			// Define si el control es un ComboBox o un ListBox dependiendo de su altura (!=0 es listbox)
			if ($registro_campos["alto"]!='0')
				$cadena_altura='size='.$registro_campos["alto"];

			// Muestra el campo
			$salida.= '<select name="'.$registro_campos["campo"].'" class="Combos" '.$cadena_altura.' >';

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
					//Define si los registros a mostrar en la lista deben estar filtrados por alguna condicion
					$condicion_filtrado_listas=$registro_campos["condicion_filtrado_listas"];
					if ($condicion_filtrado_listas=="") $condicion_filtrado_listas="1";
					// Consulta los campos para el tag select
					$resultado_opciones=ejecutar_sql("SELECT $campo_valores as valores, $campo_opciones as opciones FROM $nombre_tabla_opciones WHERE $condicion_filtrado_listas ORDER BY $campo_opciones");
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
					if ($valores_lista[$i]==$cadena_valor)
						$cadena_predeterminado=' SELECTED ';
					$salida.= "<option value='".$valores_lista[$i]."' ".$cadena_predeterminado.">".$opciones_lista[$i]."</option>";
				}

			$salida.= '</select>';

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
	Function: cargar_objeto_campoetiqueta
	Genera el codigo HTML para imprimir el valor de un campo directamente, sin control de datos.

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML asociado al objeto publicado dentro del formulario

	Ver tambien:
		<cargar_formulario>
*/
	function cargar_objeto_campoetiqueta($registro_campos,$registro_datos_formulario)
		{
			global $campobase,$valorbase;
			// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
			$cadena_valor='';
			$Contenido_BARRAS='';
			$nombre_campo=$registro_campos["campo"];
			if ($registro_campos["valor_predeterminado"]!="") $cadena_valor=$registro_campos["valor_predeterminado"];
			//Evalua si el valor predeterminado tiene signo $ al comienzo y ademas es una variable definida para poner su valor.
			if (substr($registro_campos["valor_predeterminado"], 0,1)=="$")
				{
					$nombre_variable = substr($registro_campos["valor_predeterminado"], 1);
					global ${$nombre_variable};
					if (isset($nombre_variable))
						{
							$valor_variable=$$nombre_variable;
							$cadena_valor=' value="'.$valor_variable.'" ';							
						}
				}
			//Si viene de una busqueda de registro pone el valor de registro
			if ($campobase!="" && $valorbase!="") 
				{
					$cadena_valor=$registro_datos_formulario["$nombre_campo"];
					$Contenido_BARRAS=$cadena_valor; //En caso que se requiera para imprimir en formato especial
				}

			//Si el formato de salida es especial entonces muestra lo que corresponda
			if ($registro_campos["formato_salida"]!="") 
				{
					$Tipo_BARRAS=$registro_campos["formato_salida"];

					//Establece tamanos de imagen segun tipo de grafico (codigo barras o datamatrix)
					if ($Tipo_BARRAS!="datamatrix")
						{
							$Ancho_BARRAS=$registro_campos["ancho"];
							//Si no se definio un ancho fijo entonces trata de calcularlo por la longitud del texto a mostrar
							if ($Ancho_BARRAS=="" || $Ancho_BARRAS=="0")
								$Ancho_BARRAS=110+strlen($Contenido_BARRAS)*10;
							$Alto_BARRAS=$registro_campos["alto"];
						}
					if ($Tipo_BARRAS=="datamatrix")
						{
							$Ancho_BARRAS=$registro_campos["ancho"];
							$Alto_BARRAS=$registro_campos["alto"];
						}
					
					//Si es un codigo desde la libreria de codigos de barras lo muestra, si es un QR usa la otra funcion
					if ($Tipo_BARRAS!="qrcode")
						$cadena_valor='<img src="core/codigobarras.php?Cadena='.$Contenido_BARRAS.'&Tipo='.$Tipo_BARRAS.'&AnchoCodigo=2&AltoCodigo='.($Alto_BARRAS-6).'&AnchoImagen='.$Ancho_BARRAS.'&AltoImagen='.$Alto_BARRAS.'" border=0>';
					else
						$cadena_valor=CodigoQR($Contenido_BARRAS);
				}

			$salida=$cadena_valor;
			//Agrega ademas el valor como hidden para disponer de el cuando se requiera en otro llamado o funcion personalizada
			$tipo_entrada="hidden";
			// Muestra el campo
			//$salida.='<input type="'.$tipo_entrada.'" name="'.$registro_campos["campo"].'" value="'.$cadena_valor.'" >';
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
					//Define si los registros a mostrar en la lista deben estar filtrados por alguna condicion
					$condicion_filtrado_listas=$registro_campos["condicion_filtrado_listas"];
					if ($condicion_filtrado_listas=="") $condicion_filtrado_listas="1";
					// Consulta los campos para el tag select
					$resultado_opciones=ejecutar_sql("SELECT $campo_valores as valores, $campo_opciones as opciones FROM $nombre_tabla_opciones WHERE $condicion_filtrado_listas ORDER BY $campo_opciones");
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
					if ($valores_lista[$i]==$cadena_valor)
						$cadena_predeterminado=' CHECKED ';
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
	Function: cargar_objeto_deslizador
	Genera el codigo HTML y CSS correspondiente a un campo tipo range de HTML5 vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<cargar_formulario>
*/
	function cargar_objeto_deslizador($registro_campos,$registro_datos_formulario)
		{
			global $campobase,$valorbase;
			global $MULTILANG_TitValorUnico,$MULTILANG_DesValorUnico,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio;

			$salida='';
			$nombre_campo=$registro_campos["campo"];

			// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
			$cadena_valor='';
			if ($registro_campos["valor_predeterminado"]!="") $valor_de_campo=$registro_campos["valor_predeterminado"];

			// toma el valor predeterminado como el minimo (formulario de registro nuevo) 
				$valor_de_campo=$registro_campos["valor_minimo"];
			// Busca el valor segun registro en caso de recibir un registro recuperado
			if ($campobase!="" && $valorbase!="")
				$valor_de_campo=$registro_datos_formulario["$nombre_campo"];
			$cadena_valor=' value="'.$valor_de_campo.'" ';

			// Muestra el campo
			$salida.= '<input type="range" name="'.$registro_campos["campo"].'" min="'.$registro_campos["valor_minimo"].'" max="'.$registro_campos["valor_maximo"].'" step="'.$registro_campos["valor_salto"].'" '.$cadena_valor.' onchange="document.getElementById(\'VAL'.$registro_campos["campo"].'\').innerHTML = \'[\'+this.value+\']\';" oninput="document.getElementById(\'VAL'.$registro_campos["campo"].'\').innerHTML = \'[\'+this.value+\']\';"><div id="VAL'.$registro_campos["campo"].'" style="float: right;"></div>';

			// Activa el primer valor del campo
			$salida.= '<script type="text/javascript">document.getElementById(\'VAL'.$registro_campos["campo"].'\').innerHTML = \'['.$valor_de_campo.']\';</script>';

			// Muestra indicadores de obligatoriedad o ayuda
			if ($registro_campos["obligatorio"]) $salida.= '<a href="#" title="'.$MULTILANG_TitObligatorio.'" name="'.$MULTILANG_DesObligatorio.'"><img src="img/icn_12.gif" border=0 align="absmiddle"></a>';
			if ($registro_campos["ayuda_titulo"] != "") $salida.= '<a href="#" title="'.$registro_campos["ayuda_titulo"].'" name="'.$registro_campos["ayuda_texto"].'"><img src="img/icn_10.gif" border=0 border=0 align="absmiddle"></a>';

			return $salida;
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: cargar_objeto_archivo_adjunto
	Genera el codigo HTML y CSS correspondiente a un campo de archivo (file) vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<cargar_formulario>
*/
	function cargar_objeto_archivo_adjunto($registro_campos,$registro_datos_formulario)
		{
			global $campobase,$valorbase;
			global $MULTILANG_TitValorUnico,$MULTILANG_DesValorUnico,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio,$MULTILANG_FrmArchivoLink,$MULTILANG_Tipo;

			$salida='';
			$nombre_campo=$registro_campos["campo"];
			$tipo_entrada="file";

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
			//Evalua si el valor predeterminado tiene signo $ al comienzo y ademas es una variable definida para poner su valor.
			if (substr($registro_campos["valor_predeterminado"], 0,1)=="$")
				{
					$nombre_variable = substr($registro_campos["valor_predeterminado"], 1);
					global ${$nombre_variable};
					if (isset($nombre_variable))
						{
							$valor_variable=$$nombre_variable;
							$cadena_valor=' value="'.$valor_variable.'" ';							
						}
				}

			// Si detecta un path de archivo en el registro entonces agrega el enlace
			$partes_adjunto_archivo=explode("|",$registro_datos_formulario["$nombre_campo"]);
			$adjunto_url_archivo=$partes_adjunto_archivo[0];
			$adjunto_tipo_archivo=$partes_adjunto_archivo[1];
			if ($campobase!="" && $valorbase!="" && $registro_datos_formulario["$nombre_campo"]!="")
				$salida.='<a target="_BLANK" href="'.$adjunto_url_archivo.'"><img src="img/woo_folder_search_32.png" border=0 width="20" height="20" align="absmiddle"><b>'.$MULTILANG_FrmArchivoLink.'</b><img src="img/woo_save_download_32.png" border=0 width="20" height="20" align="absmiddle"></a><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>('.$MULTILANG_Tipo.': '.$adjunto_tipo_archivo.')</i><br>';

			// Muestra el campo
			$salida.='<input type="'.$tipo_entrada.'" name="'.$registro_campos["campo"].'" '.$cadena_valor.' '.$cadena_longitud_visual.' '.$cadena_longitud_permitida.' class="CampoTexto '.$cadena_clase_teclado.'" '.$cadena_validacion.' '.$registro_campos["solo_lectura"].'  >';

			// Muestra indicadores de obligatoriedad o ayuda
			if ($registro_campos["valor_unico"] == "1") $salida.= '<a href="#" title="'.$MULTILANG_TitValorUnico.'" name="'.$MULTILANG_DesValorUnico.'"><img src="img/key.gif" border=0 border=0 align="absmiddle"></a>';
			if ($registro_campos["obligatorio"]) $salida.= '<a href="#" title="'.$MULTILANG_TitObligatorio.'" name="'.$MULTILANG_DesObligatorio.'"><img src="img/icn_12.gif" border=0 align="absmiddle"></a>';
			if ($registro_campos["ayuda_titulo"] != "") $salida.= '<a href="#" title="'.$registro_campos["ayuda_titulo"].'" name="'.$registro_campos["ayuda_texto"].'"><img src="img/icn_10.gif" border=0 border=0 align="absmiddle"></a>';
			return $salida;
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: cargar_objeto_canvas
	Genera el codigo HTML y CSS correspondiente a un campo de canvas vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<cargar_formulario>
*/
	function cargar_objeto_canvas($registro_campos,$registro_datos_formulario)
		{
			global $campobase,$valorbase;
			global $MULTILANG_Cerrar,$MULTILANG_FrmCanvasLink;

			$salida='';
			$nombre_campo=$registro_campos["campo"];

			// Si detecta un valor en el registro entonces agrega el contenido
			if ($campobase!="" && $valorbase!="" && $registro_datos_formulario["$nombre_campo"]!="")
				{
					$cadena_decodificada=$registro_datos_formulario["$nombre_campo"];
					$cadena_decodificada=gzdecode($cadena_decodificada);
					$salida.='<a href="javascript:AbrirPopUp(\'CANVASPrevio'.$registro_campos["campo"].'\');"><img src="img/ginux_Outlook.png" border=0 width="20" height="20" align="absmiddle"><b>'.$MULTILANG_FrmCanvasLink.'</b></a><br>
						<!-- INICIO DE MARCOS POPUP -->
						<div id="CANVASPrevio'.$registro_campos["campo"].'" class="FormularioPopUps">
							<div align=center>
								<table bgcolor="#FFFFFF"><tr><td>
									<img src="'.$cadena_decodificada.'" border=1>
								</td></tr></table>
							</br>
							<input type="Button"  class="Botones" value=" -- '.$MULTILANG_Cerrar.' -- " onClick="OcultarPopUp(\'CANVASPrevio'.$registro_campos["campo"].'\')">
							</div>
						<!-- FIN DE MARCOS POPUP -->
						</div>';
				}

			// Muestra el campo
			$salida.='
				<!--<a href="javascript:" id="upload" style="width: 100px;">Upload</a>-->
				<canvas id="CANVAS_'.$registro_campos["campo"].'" width="'.$registro_campos["ancho"].'" height="'.$registro_campos["alto"].'" style="border: 1px solid #acc;">Su navegador no soporta Canvas</canvas>
				<a href="javascript:limpiar_CANVAS_'.$registro_campos["campo"].'();"><img src="img/woo_close_32.png" border=0 width="20" height="20" align="top"></a>

				<script type="text/javascript">
					$(function ()
						{
							$(\'#CANVAS_'.$registro_campos["campo"].'\').sketch({defaultColor: "'.$registro_campos["color_trazo"].'", defaultSize: "'.$registro_campos["tamano_pincel"].'"});
						});

					/*
					// Genera el vinculo entre el enlace de upload y la funcion
					$("#upload").bind("click", function ()
						{
							var oCanvas = document.getElementById("CANVAS_'.$registro_campos["campo"].'");
							var strDataURI = oCanvas.toDataURL();
							//alert(strDataURI); //Muestra el resultado en base64
						});
					*/

					function limpiar_CANVAS_'.$registro_campos["campo"].'()
						{
							// Busca el contexto del canvas y le reasigna ancho y alto para limpiarlo
							var oCanvas = document.getElementById("CANVAS_'.$registro_campos["campo"].'");
							var oContext = oCanvas.getContext("2d");
							//FORMA1:
								oContext.clearRect(0, 0, oCanvas.width, oCanvas.height);
							/*//FORMA2:
								oCanvas.width = oCanvas.width;*/
							/*//FORMA3:
								oContext.save();
								oContext.fillStyle = "#FFF";
								oContext.fillRect(0, 0, oCanvas.width, oCanvas.height);
								oContext.restore();
								oCanvas.clear();*/
							/*//FORMA4:
								var ancho_anterior = oCanvas.width;
								oCanvas.width = 1;
								oCanvas.width = ancho_anterior;*/
						}

					function actualizar_CANVAS_'.$registro_campos["campo"].'()
						{
							// Pasa el valor del canvas al campo que se usa en almacenamiento
							var oCanvas = document.getElementById("CANVAS_'.$registro_campos["campo"].'");
							var strDataURI = oCanvas.toDataURL();
							document.datos.'.$registro_campos["campo"].'.value=strDataURI;
							window.setTimeout("actualizar_CANVAS_'.$registro_campos["campo"].'()",1000);
						}
					window.setTimeout("actualizar_CANVAS_'.$registro_campos["campo"].'()",1000);
				</script>
				<input type="hidden" name="'.$registro_campos["campo"].'">';
			
			// Muestra indicadores de obligatoriedad o ayuda
			if ($registro_campos["obligatorio"]) $salida.= '<a href="#" title="'.$MULTILANG_TitObligatorio.'" name="'.$MULTILANG_DesObligatorio.'"><img src="img/icn_12.gif" border=0 align="absmiddle"></a>';
			if ($registro_campos["ayuda_titulo"] != "") $salida.= '<a href="#" title="'.$registro_campos["ayuda_titulo"].'" name="'.$registro_campos["ayuda_texto"].'"><img src="img/icn_10.gif" border=0 border=0 align="absmiddle"></a>';
			return $salida;
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: cargar_objeto_camara
	Genera el codigo HTML y CSS correspondiente a un campo de canvas usado para la captura de una imagen desde webcam

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<cargar_formulario>
*/
	function cargar_objeto_camara($registro_campos,$registro_datos_formulario)
		{
			global $campobase,$valorbase;
			global $MULTILANG_Cerrar,$MULTILANG_FrmCanvasLink,$MULTILANG_Capturar,$MULTILANG_FrmErrorCam;

			$salida='';
			$nombre_campo=$registro_campos["campo"];

			// Si detecta un valor en el registro entonces agrega el contenido
			if ($campobase!="" && $valorbase!="" && $registro_datos_formulario["$nombre_campo"]!="")
				{
					$cadena_decodificada=$registro_datos_formulario["$nombre_campo"];
					$cadena_decodificada=gzdecode($cadena_decodificada);
					$salida.='<a href="javascript:AbrirPopUp(\'CANVASPrevio'.$registro_campos["campo"].'\');"><img src="img/ginux_Outlook.png" border=0 width="20" height="20" align="absmiddle"><b>'.$MULTILANG_FrmCanvasLink.'</b></a><br>
						<!-- INICIO DE MARCOS POPUP -->
						<div id="CANVASPrevio'.$registro_campos["campo"].'" class="FormularioPopUps">
							<div align=center>
								<table bgcolor="#FFFFFF"><tr><td>
									<img src="'.$cadena_decodificada.'" border=1>
								</td></tr></table>
							</br>
							<input type="Button"  class="Botones" value=" -- '.$MULTILANG_Cerrar.' -- " onClick="OcultarPopUp(\'CANVASPrevio'.$registro_campos["campo"].'\')">
							</div>
						<!-- FIN DE MARCOS POPUP -->
						</div>';
				}

			// Muestra el campo
			$escala_reduccion=1;
			$salida.='
				<table border=0>
					<tr>
						<td valign=top>
							<div id="container" style="margin: 0px auto; width: '.$registro_campos["ancho"].'px; height: '.$registro_campos["alto"].'px; border: 1px solid #acc;">
								<video autoplay id="videoElement"  style="width: '.$registro_campos["ancho"].'px; height: '.$registro_campos["alto"].'px;">
								</video>
							</div>
						</td>
						<td valign=top>
							<img src="img/woo_camera_32.png" width="20" alt="Capturar" border=0 OnClick="draw(v,context,w,h);"/>
							<br>
							<canvas id="CANVAS_'.$registro_campos["campo"].'" width="'.(($registro_campos["ancho"]/$escala_reduccion)).'" height="'.(($registro_campos["alto"]/$escala_reduccion)).'" style="width: '.(($registro_campos["ancho"]/$escala_reduccion)).'px; height: '.(($registro_campos["alto"]/$escala_reduccion)).'px; background-color: #CCC; visibility:visible;"></canvas>
						</td>
					</tr>
				</table>

				<script>
					var video = document.querySelector("#videoElement");
					navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

					if (navigator.getUserMedia) {       
						navigator.getUserMedia({video: true}, handleVideo, videoError);
					}

					function handleVideo(stream) {
						video.src = window.URL.createObjectURL(stream);
					}

					function videoError(e) {
						alert("'.$MULTILANG_FrmErrorCam.'");
					}

					var v,CANVAS_'.$registro_campos["campo"].',context,w,h;
					var sel = document.getElementById(\'fileselect\');

					document.addEventListener(\'DOMContentLoaded\', function(){
					v = document.getElementById(\'videoElement\');
					CANVAS_'.$registro_campos["campo"].' = document.getElementById(\'CANVAS_'.$registro_campos["campo"].'\');
					context = CANVAS_'.$registro_campos["campo"].'.getContext(\'2d\');
					w = CANVAS_'.$registro_campos["campo"].'.width;
					h = CANVAS_'.$registro_campos["campo"].'.height;
					},false);

					function draw(v,c,w,h) {
					if(v.paused || v.ended) return false;
					context.drawImage(v,0,0,w,h);
					var uri = CANVAS_'.$registro_campos["campo"].'.toDataURL("image/png");
					}

					var fr;
					sel.addEventListener(\'change\',function(e){
					var f = sel.files[0];
					fr = new FileReader();
					fr.readAsDataURL(f);
					})
				</script>';

			$salida.='
				<script>
					function actualizar_CANVAS_'.$registro_campos["campo"].'()
						{
							// Pasa el valor del canvas al campo que se usa en almacenamiento
							var oCanvas = document.getElementById("CANVAS_'.$registro_campos["campo"].'");
							var strDataURI = oCanvas.toDataURL();
							document.datos.'.$registro_campos["campo"].'.value=strDataURI;
							window.setTimeout("actualizar_CANVAS_'.$registro_campos["campo"].'()",1000);
						}
					window.setTimeout("actualizar_CANVAS_'.$registro_campos["campo"].'()",1000);
				</script>
				<input type="hidden" name="'.$registro_campos["campo"].'">';

			// Muestra indicadores de obligatoriedad o ayuda
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
		anular_form - Opcional, indica si las etiquetas del formulario HTML deben ser eliminadas y agregar los campos crudos dentro del form

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
		function cargar_formulario($formulario,$en_ventana=1,$campobase="",$valorbase="",$anular_form=0)
		  {
				global $ConexionPDO,$ArchivoCORE,$TablasCore,$PlantillaActiva;
				global $_SeparadorCampos_;
				// Carga variables de definicion de tablas
				global $ListaCamposSinID_formulario,$ListaCamposSinID_formulario_objeto,$ListaCamposSinID_formulario_boton;
				global $MULTILANG_ErrorTiempoEjecucion,$MULTILANG_ObjetoNoExiste,$MULTILANG_ContacteAdmin,$MULTILANG_Formularios,$MULTILANG_VistaImpresion;
				
				// Busca datos del formulario
				$consulta_formulario=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id=?","$formulario");
				$registro_formulario = @$consulta_formulario->fetch();
				
				

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
						  var marco_contenidos = document.getElementById(nombre);
						  var ventana_impresion = window.open(" ", "PopUpImpresion");
						  
						  //Agrega estilos basicos
							ventana_impresion.document.write( \'<link rel="stylesheet" type="text/css" href="skin/'.$PlantillaActiva.'/general.css">\' );
						  
						  //Agrega titulo del formulario
							ventana_impresion.document.write( \'<div align=CENTER><b>'.$registro_formulario["titulo"].'</b></div><hr>\' );

						  //Agrega el concenito del DIV al documento
							ventana_impresion.document.write( marco_contenidos.innerHTML );
							ventana_impresion.document.close();
						  
						  //Abre ventana de impresion
							ventana_impresion.print( );
						  
						  //Cierra ventana de impresion
							ventana_impresion.close();
						}

				</script>
				<!--<input type=button onclick=\'AgregarElemento("1","1","hello world");\'>-->';


				//Si no encuentra formulario presenta error
				if ($registro_formulario["id"]=="")	mensaje($MULTILANG_ErrorTiempoEjecucion,$MULTILANG_ObjetoNoExiste." ".$MULTILANG_ContacteAdmin."<br>(".$MULTILANG_Formularios." $formulario)","70%","icono_error.png","TextosEscritorio");

				// En caso de recibir un campo base y valor base se hace la busqueda para recuperar la informacion
				if ($campobase!="" && $valorbase!="")
					{
						$consulta_datos_formulario = $ConexionPDO->prepare("SELECT * FROM ".$registro_formulario["tabla_datos"]." WHERE $campobase='$valorbase'");
						$consulta_datos_formulario->execute();
						$registro_datos_formulario = $consulta_datos_formulario->fetch();
					}
				// Define la barra de herramientas mini superior (en barra de titulo)
				@$barra_herramientas_mini.='
						<a href="#" title="'.$MULTILANG_VistaImpresion.'" name="">
							<img src="img/tango_document-print.png" border=0 height=15 width=15 OnClick="ImprimirMarco(\'MARCO_IMPRESION\');">
						</a>';

				// Establece color de fondo para el form
				$color_fondo="#f2f2f2";
				if ($registro_formulario["color_fondo"]!="") $color_fondo=$registro_formulario["color_fondo"];
				// Crea ventana si aplica para el form
				if ($en_ventana) abrir_ventana($registro_formulario["titulo"],$color_fondo,'',$barra_herramientas_mini);
				// Muestra ayuda en caso de tenerla
				$imagen_ayuda="info_icon.png";
				if ($registro_formulario["ayuda_titulo"]!="" || $registro_formulario["ayuda_texto"]!="")
					mensaje($registro_formulario["ayuda_titulo"],$registro_formulario["ayuda_texto"],'100%',$imagen_ayuda,'TextosVentana');

				//Inicia el formulario de datos
				echo '
					<div id="MARCO_IMPRESION">';
				
				//Si se quiere anular el formulario y su accion cuando se trata de un sub-formulario de consulta
				if (!$anular_form)
					echo'<form name="datos" action="'.$ArchivoCORE.'" method="POST" enctype="multipart/form-data" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
						<input type="Hidden" name="accion" value="guardar_datos_formulario">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="id_registro_datos" value="'.@$registro_datos_formulario["id"].'">
						';

				//Booleana que determina si se debe incluir el javascript de ckeditor
				$existe_campo_textoformato=0;

				//DIAGRAMACION DE LA TABLA CON ELEMENTOS DEL FORMULARIO
				$limite_inferior=-9999; // Peso inferior a tener en cuenta en el query
				$constante_limite_superior=+9999;
				$limite_superior=$constante_limite_superior; // Peso superior a tener en cuenta en el query
				//Busca todos los objetos marcados como fila_unica=1 y agrega un registro mas con el limite superior
				$consulta_obj_fila_unica=ejecutar_sql("SELECT id,peso,visible FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND fila_unica='1' AND visible=1 UNION SELECT 0,$limite_superior,0 ORDER BY peso","$formulario");
				//Define si debe o no dibujar borde de las celdas
				$ancho_borde_visible=0;
				if ($registro_formulario["borde_visible"]==1) $ancho_borde_visible=1;
				echo '<div id="seccion_impresion">';
				while ($registro_obj_fila_unica = $consulta_obj_fila_unica->fetch())
					{
						$limite_superior=$registro_obj_fila_unica["peso"];
						$ultimo_id=$registro_obj_fila_unica["id"];
						// Inicia la tabla con los campos
						echo '
						<table cellspacing=0 cellpadding=2 border=0 class="TextosVentana" align=center width="100%"><tr>';
						//Recorre todas las comunas definidas para el formulario buscando objetos
						for ($cl=1;$cl<=$registro_formulario["columnas"];$cl++)
							{
								//Busca los elementos de la coumna actual del formulario con peso menor o igual al peso del objeto fila_unica de la fila unica_actual pero que no son fila_unica
								$consulta_campos=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND columna=? AND visible=1 AND peso >? AND peso <=? ORDER BY peso","$formulario$_SeparadorCampos_$cl$_SeparadorCampos_$limite_inferior$_SeparadorCampos_$limite_superior");
								
									//Inicia columna de formulario
									echo '<td valign=top align=center>';
									// Crea los campos definidos por cada columna de formulario
									echo '<table cellspacing=0 cellpadding=2 border='.$ancho_borde_visible.' class="TextosVentana">';
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
													$tipo_de_objeto=@$registro_campos["tipo"];
													if ($tipo_de_objeto=="texto_corto") $objeto_formateado = @cargar_objeto_texto_corto($registro_campos,@$registro_datos_formulario,$formulario,$en_ventana);
													if ($tipo_de_objeto=="texto_clave") $objeto_formateado = @cargar_objeto_texto_corto($registro_campos,@$registro_datos_formulario,$formulario,$en_ventana);
													if ($tipo_de_objeto=="texto_largo") $objeto_formateado = @cargar_objeto_texto_largo($registro_campos,@$registro_datos_formulario);
													if ($tipo_de_objeto=="texto_formato") { $objeto_formateado = @cargar_objeto_texto_formato($registro_campos,@$registro_datos_formulario,$existe_campo_textoformato); $existe_campo_textoformato=1; }
													if ($tipo_de_objeto=="lista_seleccion") $objeto_formateado = @cargar_objeto_lista_seleccion($registro_campos,@$registro_datos_formulario,$formulario,$en_ventana);
													if ($tipo_de_objeto=="lista_radio") $objeto_formateado = @cargar_objeto_lista_radio($registro_campos,@$registro_datos_formulario);
													if ($tipo_de_objeto=="etiqueta") $objeto_formateado = @cargar_objeto_etiqueta($registro_campos,@$registro_datos_formulario);
													if ($tipo_de_objeto=="url_iframe") $objeto_formateado = @cargar_objeto_iframe($registro_campos,@$registro_datos_formulario);
													if ($tipo_de_objeto=="informe") @cargar_informe($registro_campos["informe_vinculado"],$registro_campos["objeto_en_ventana"],"htm","Informes",1);
													if ($tipo_de_objeto=="deslizador") $objeto_formateado = @cargar_objeto_deslizador($registro_campos,@$registro_datos_formulario);
													if ($tipo_de_objeto=="campo_etiqueta") $objeto_formateado = @cargar_objeto_campoetiqueta($registro_campos,@$registro_datos_formulario);
													if ($tipo_de_objeto=="archivo_adjunto") $objeto_formateado = @cargar_objeto_archivo_adjunto($registro_campos,@$registro_datos_formulario);
													if ($tipo_de_objeto=="objeto_canvas") $objeto_formateado = @cargar_objeto_canvas($registro_campos,@$registro_datos_formulario);
													if ($tipo_de_objeto=="objeto_camara") $objeto_formateado = @cargar_objeto_camara($registro_campos,@$registro_datos_formulario);
													//Carga SubFormulario solo si no es el mismo actual para evitar ciclos infinitos
													if ($tipo_de_objeto=="form_consulta" && $registro_campos["formulario_vinculado"]!=$formulario) @cargar_formulario($registro_campos["formulario_vinculado"],$registro_campos["objeto_en_ventana"],$registro_campos["formulario_campo_foraneo"],$valorbase,1);

													//Imprime el objeto siempre y cuando no sea uno preformateado por practico (informes, formularios, etc)
													if ($registro_campos["tipo"]!="informe" && $registro_campos["tipo"]!="form_consulta")
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
						$consulta_campos=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND id=? ","$formulario$_SeparadorCampos_$ultimo_id");
						$registro_campos = $consulta_campos->fetch();

						//Agrega el campo de fila unica cuando no se trata del agregado de peso 9999
						if ($registro_campos["visible"]=="1")
							{
								//echo '&nbsp;&nbsp;'.$registro_campos["titulo"];
								// Formatea cada campo de acuerdo a su tipo
								// CUIDADO!!! Modificando las lineas de tipo siguientes debe modificar las lineas de tipo un poco mas arriba tambien
								echo '<table cellspacing=0 cellpadding=2 border='.$ancho_borde_visible.' class="TextosVentana" align=center width="100%"><tr><td>';
								$tipo_de_objeto=@$registro_campos["tipo"];
								if ($tipo_de_objeto=="texto_corto") $objeto_formateado = cargar_objeto_texto_corto($registro_campos,@$registro_datos_formulario,$formulario,$en_ventana);
								if ($tipo_de_objeto=="texto_clave") $objeto_formateado = cargar_objeto_texto_corto($registro_campos,@$registro_datos_formulario,$formulario,$en_ventana);
								if ($tipo_de_objeto=="texto_largo") $objeto_formateado = cargar_objeto_texto_largo($registro_campos,@$registro_datos_formulario);
								if ($tipo_de_objeto=="texto_formato") { $objeto_formateado = cargar_objeto_texto_formato($registro_campos,@$registro_datos_formulario,$existe_campo_textoformato); $existe_campo_textoformato=1; }
								if ($tipo_de_objeto=="lista_seleccion") $objeto_formateado = cargar_objeto_lista_seleccion($registro_campos,@$registro_datos_formulario,$formulario,$en_ventana);
								if ($tipo_de_objeto=="lista_radio") $objeto_formateado = cargar_objeto_lista_radio($registro_campos,@$registro_datos_formulario);
								if ($tipo_de_objeto=="etiqueta") $objeto_formateado = cargar_objeto_etiqueta($registro_campos,@$registro_datos_formulario);
								if ($tipo_de_objeto=="url_iframe") $objeto_formateado = cargar_objeto_iframe($registro_campos,@$registro_datos_formulario);
								if ($tipo_de_objeto=="informe") cargar_informe($registro_campos["informe_vinculado"],$registro_campos["objeto_en_ventana"],"htm","Informes",1);
								if ($tipo_de_objeto=="deslizador") $objeto_formateado = @cargar_objeto_deslizador($registro_campos,@$registro_datos_formulario);
								if ($tipo_de_objeto=="campo_etiqueta") $objeto_formateado = @cargar_objeto_campoetiqueta($registro_campos,@$registro_datos_formulario);
								if ($tipo_de_objeto=="archivo_adjunto") $objeto_formateado = @cargar_objeto_archivo_adjunto($registro_campos,@$registro_datos_formulario);
								if ($tipo_de_objeto=="objeto_canvas") $objeto_formateado = @cargar_objeto_canvas($registro_campos,@$registro_datos_formulario);
								if ($tipo_de_objeto=="objeto_camara") $objeto_formateado = @cargar_objeto_camara($registro_campos,@$registro_datos_formulario);
								//Carga SubFormulario solo si no es el mismo actual para evitar ciclos infinitos
								if ($tipo_de_objeto=="form_consulta" && $registro_campos["formulario_vinculado"]!=$formulario) @cargar_formulario($registro_campos["formulario_vinculado"],$registro_campos["objeto_en_ventana"],$registro_campos["formulario_campo_foraneo"],$valorbase,1);

								//Imprime el objeto siempre y cuando no sea uno preformateado por practico (informes, formularios, etc)
								if ($registro_campos["tipo"]!="informe" && $registro_campos["tipo"]!="form_consulta")
									echo $objeto_formateado;
								echo '</td></tr></table>';
							}

						//Actualiza limite inferior para siguiente lista de campos
						$limite_inferior=$registro_obj_fila_unica["peso"];
					}
				echo '</div>
				</div> <!-- cierra MARCO_IMPRESION -->';

			//Busca los campos definidos como visilbe=0 (o NO) para agregarlos como hidden
			$consulta_ocultos=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=0 ","$formulario");
			while ($registro_ocultos = $consulta_ocultos->fetch())
				{
					// Formatea cada campo de acuerdo a su tipo
					$objeto_formateado = @cargar_objeto_oculto($registro_ocultos,$registro_datos_formulario,$formulario,$en_ventana);
					//Imprime el objeto siempre y cuando no sea uno preformateado por practico (informes, formularios, etc)
					if ($registro_campos["tipo"]!="informe")
						echo $objeto_formateado;
				}

			// Si tiene botones agrega barra de estado y los ubica
			$consulta_botones = ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_boton." FROM ".$TablasCore."formulario_boton WHERE formulario=? AND visible=1 ORDER BY peso","$formulario");
			
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
							if ($registro_botones["tipo_accion"]=="interna_actualizar")
								{
									$tipo_boton="Button";
									$comando_javascript="document.datos.accion.value='actualizar_datos_formulario';document.datos.submit()";
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
							if (@$comando_javascript!="" && $tipo_boton!="Reset")
								{
									$cadena_javascript='onclick="'.@$comando_javascript.'"';
								}
							echo '<input type="'.$tipo_boton.'"  class="'.$registro_botones["estilo"].'" value="'.$registro_botones["titulo"].'" '.@$cadena_javascript.' >';
						}
					cerrar_barra_estado();
				}

			//Cierra todo el formulario
			//Si se quiere anular el formulario y su accion cuando se trata de un sub-formulario de consulta
			if (!$anular_form)
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
		global $ConexionPDO,$ArchivoCORE,$TablasCore,$Nombre_Aplicacion;
		// Carga variables de sesion por si son comparadas en alguna condicion
		global $Login_usuario,$Nombre_usuario,$Descripcion_usuario,$Nivel_usuario,$Correo_usuario,$LlaveDePasoUsuario;
		// Carga variables de definicion de tablas
		global $ListaCamposSinID_informe,$ListaCamposSinID_informe_campos,$ListaCamposSinID_informe_tablas,$ListaCamposSinID_informe_condiciones,$ListaCamposSinID_informe_boton;
		global $MULTILANG_TotalRegistros,$MULTILANG_ContacteAdmin,$MULTILANG_ObjetoNoExiste,$MULTILANG_ErrorTiempoEjecucion,$MULTILANG_Informes,$MULTILANG_IrEscritorio,$MULTILANG_ErrorDatos,$MULTILANG_InfErrTamano;
		global $IdiomaPredeterminado;

		// Busca datos del informe
		$consulta_informe=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe." FROM ".$TablasCore."informe WHERE id=? ","$informe");
		$registro_informe=$consulta_informe->fetch();
		$Identificador_informe=$registro_informe["id"];
		//Si no encuentra informe presenta error
		if ($registro_informe["id"]=="") mensaje($MULTILANG_ErrorTiempoEjecucion,$MULTILANG_ObjetoNoExiste." ".$MULTILANG_ContacteAdmin."<br>(".$MULTILANG_Informes." $informe)","70%","icono_error.png","TextosEscritorio");

			// Inicia CONSTRUCCION DE CONSULTA DINAMICA
			$numero_columnas=0;
			//Busca los CAMPOS definidos para el informe
			$consulta="SELECT ";
			$consulta_campos=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_campos." FROM ".$TablasCore."informe_campos WHERE informe=? ","$informe");
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
			$consulta_tablas=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_tablas." FROM ".$TablasCore."informe_tablas WHERE informe=? ","$informe");
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
			$consulta_condiciones=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_condiciones." FROM ".$TablasCore."informe_condiciones WHERE informe=? ORDER BY peso","$informe");
			$hay_condiciones=0;
			while ($registro_condiciones = $consulta_condiciones->fetch())
				{
					//Agrega condicion a la consulta
					$valor_izquierdo=$registro_condiciones["valor_izq"];
					$valor_derecho=$registro_condiciones["valor_der"];
					
					// CONVIERTE VARIABLES DE SESION PHP A VALORES PARA EL QUERY
					//Si el valor Izquierdo a comparar inicia por signo pesos y es una variable PHP la usa como tal
					if (@$valor_izquierdo[0]=="$")
						{
							//Quita el signo pesos inicial para buscar la variable
							$variable_a_buscar=substr($valor_izquierdo, 1, strlen($valor_izquierdo));
							// Si la variable esta definida toma su valor encerrado entre comillas para el query
							if (@isset($variable_a_buscar)) 
								$valor_izquierdo="'".$$variable_a_buscar."'";
						}
					//Si el valor Derecho a comparar inicia por signo pesos y es una variable PHP la usa como tal
					if (@$valor_derecho[0]=="$")
						{
							//Quita el signo pesos inicial para buscar la variable
							$variable_a_buscar=substr($valor_derecho, 1, strlen($valor_derecho));
							// Si la variable esta definida toma su valor encerrado entre comillas para el query
							if (@isset($variable_a_buscar)) 
								$valor_derecho="'".$$variable_a_buscar."'";
						}
					$consulta.=" ".$valor_izquierdo." ".$registro_condiciones["operador"]." ".$valor_derecho." ";
					$hay_condiciones=1;
				}
			if (!$hay_condiciones)
			$consulta.=" 1 ";

			if (@$registro_informe["agrupamiento"]!="")
				{
					$campoagrupa=$registro_informe["agrupamiento"];
					$consulta.= " GROUP BY $campoagrupa";
				}

			if (@$registro_informe["ordenamiento"]!="")
				{
					$campoorden=$registro_informe["ordenamiento"];
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
				$SalidaFinalInforme='';
				$SalidaFinalInformePDF='';
				if ($en_ventana)
					{
						//Cuando es embebido (=1) no imprime el boton de retorno pues se asume dentro de un formulario
						if (!$embebido)
							echo '<input type="Button" onclick="document.core_ver_menu.submit()" value=" <<< '.$MULTILANG_IrEscritorio.' " class="Botones">';
						//Establece el color de fondo del informe
						$color_fondo="#f2f2f2";
						if ($registro_informe["color_fondo"]!="") $color_fondo=$registro_informe["color_fondo"];
						//Carga la ventana con el informe
						abrir_ventana($Nombre_Aplicacion.' - '.$registro_informe["titulo"],$color_fondo,$registro_informe["ancho"]);
					}

				// Si se ha definido un tamano fijo entonces crea el marco
				if ($registro_informe["ancho"]!="" && $registro_informe["alto"]!="")
					echo '<DIV style="DISPLAY: block; OVERFLOW: auto; POSITION: relative; WIDTH: '.$registro_informe["ancho"].'; HEIGHT: '.$registro_informe["alto"].'">';
					
				//Genera enlace al PDF cuando se detecta el modulo y ademas el informe lo tiene activado
				if (@file_exists("mod/pdf") && $registro_informe["genera_pdf"]=='S')
					{
						echo '<div align=right><a href="tmp/Inf_'.$Identificador_informe.'-'.$Login_usuario.'.pdf" target="_BLANK"><img src="img/icono_pdf.gif" border=0 align=absmiddle> PDF&nbsp;</a></div>';
					}

					// Crea encabezado por tipo de formato:  1=html   2=Excel
					if($formato=="htm")
						{
							echo '
								<html>
								<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0" style="font-size: 12px; font-family: Arial, Verdana, Tahoma;">';

							// Si no tiene ancho o alto se asume que es para impresion y agrega titulo
							if ($registro_informe["ancho"]=="" || $registro_informe["alto"]=="")
								{
									$SalidaFinalInforme.= '<table class="'.$estilo.'">
										<thead><tr><td>
										'.$Nombre_Aplicacion.' - '.$registro_informe["titulo"].'
										</td></tr></thead></table>';
									$SalidaFinalInformePDF.= '<table class="'.$estilo.'">
										<thead><tr><td>
										'.$Nombre_Aplicacion.' - '.$registro_informe["titulo"].'
										</td></tr></thead></table>';
								}
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
						{
							$SalidaFinalInforme.= '<table class="'.$estilo.'"><thead><tr>';
							$SalidaFinalInformePDF.= '<table class="'.$estilo.'"><thead><tr>';
						}
					if($formato=="xls")
						{
							$SalidaFinalInforme.= '<table class="font-size: 11px; font-family: Verdana, Tahoma, Arial;"><thead><tr>';
							$SalidaFinalInformePDF.= '<table class="font-size: 11px; font-family: Verdana, Tahoma, Arial;"><thead><tr>';
						}


					// Busca si el informe tiene acciones (botones), los cuenta y prepara dentro de un arreglo para repetir en cada registro
					$consulta_botones=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_boton." FROM ".$TablasCore."informe_boton WHERE informe=? AND visible=1 ORDER BY peso","$informe");
					$total_botones=0;
					while($registro_botones=$consulta_botones->fetch())
						{
							//Construye una cadena generica con todos los botones para ser reemplazada luego con valores
							if ($registro_botones["tipo_accion"]=="interna_eliminar")
								{
									$valores = explode(".",$registro_botones["accion_usuario"]);
									$tabla_vinculada=$valores[0];
									$campo_vinculado=$valores[1];
								
									//Si solo se indico el campo, sin la tabla, intenta usar solo el campo
									if ($campo_vinculado=="" && $tabla_vinculada!="")
										{
											$campo_vinculado=$valores[0];
											$tabla_vinculada="";
										}

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
							@$cadena_generica_botones.='<input type="Button"  class="'.$registro_botones["estilo"].'" value="'.$registro_botones["titulo"].'" '.$cadena_javascript.' >';
							$total_botones++;
						}
					//Si el informe tiene botones se agrega el formulario para procesar las acciones
					if ($total_botones>0)
						{
							$SalidaFinalInforme.= '<form name="FRMBASEINFORME" action="'.$ArchivoCORE.'" method="POST">
								<input type="Hidden" name="accion" value="">
								<input type="Hidden" name="tabla" value="">
								<input type="Hidden" name="campo" value="">
								<input type="Hidden" name="valor" value="">
								<input type="Hidden" name="objeto" value="">
								</form>';
							$SalidaFinalInformePDF.= '<form name="FRMBASEINFORME" action="'.$ArchivoCORE.'" method="POST">
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
					foreach(@$resultado_columnas->fetch(PDO::FETCH_ASSOC) as $key=>$val)
						{
							$SalidaFinalInforme.= '<th align="LEFT">'.$key.'</th>';
							$SalidaFinalInformePDF.= '<th align="LEFT">'.$key.'</th>';
							$numero_columnas++;
						}

					//Si el informe tiene botones entonces agrega columna adicional
					if ($total_botones>0)
						{
							$SalidaFinalInforme.= '<th align="LEFT"></th>';
							$SalidaFinalInformePDF.= '<th align="LEFT"></th>';
						}
					$SalidaFinalInforme.= '</tr></thead><tbody>';
					$SalidaFinalInformePDF.= '</tr></thead><tbody>';

					// Imprime registros del resultado
					$numero_filas=0;
					$consulta_ejecucion=ejecutar_sql($consulta);
					while($registro_informe=$consulta_ejecucion->fetch())
						{
							$SalidaFinalInforme.= '<tr>';
							$SalidaFinalInformePDF.= '<tr>';
							for ($i=0;$i<$numero_columnas;$i++)
								{
									$SalidaFinalInforme.= '<td align=left>'.$registro_informe[$i].'</td>';
									$SalidaFinalInformePDF.= '<td align=left>'.$registro_informe[$i].'</td>';
								}
							//Si el informe tiene botones los agrega
							if ($total_botones>0)
								{
									//Transforma la cadena generica con los datos especificos del registro, toma por ahora el primer campo
									$cadena_botones_registro=str_replace("DELFRMVALVALOR",$registro_informe[0],$cadena_generica_botones);
									$cadena_botones_registro=str_replace("DETFRMVALBASE",$registro_informe[0],$cadena_botones_registro);
									//Muestra los botones preparados para el registro
									$SalidaFinalInforme.= '<th align="LEFT">'.$cadena_botones_registro.'</th>';
									$SalidaFinalInformePDF.= '<th align="LEFT">'.$cadena_botones_registro.'</th>';
								}
							$SalidaFinalInforme.= '</tr>';
							$SalidaFinalInformePDF.= '</tr>';
							$numero_filas++;
						}
					$SalidaFinalInforme.= '</tbody>';
					$SalidaFinalInformePDF.= '</tbody>';
					if ($formato=="htm")
						{
							$SalidaFinalInforme.= '<tfoot>
								<tr><td colspan='.$numero_columnas.'>
									<b>'.$MULTILANG_TotalRegistros.': </b>'.$numero_filas.'
								</td></tr>
							</tfoot>';
							$SalidaFinalInformePDF.= '<tfoot>
								<tr><td colspan='.$numero_columnas.'>
									<b>'.$MULTILANG_TotalRegistros.': </b>'.$numero_filas.'
								</td></tr>
							</tfoot>';
						}
					$SalidaFinalInforme.= '</table>';
					$SalidaFinalInformePDF.= '</table>';

					if($formato=="htm")
						echo '</body></html>';
				//Imprime el HTML generado para el informe
				echo $SalidaFinalInforme;
				
				//Genera el PDF cuando se encuentra el modulo y el informe lo tiene activado
				if (@file_exists("mod/pdf") && $registro_informe["genera_pdf"]=='S')
					{
						require_once('mod/pdf/html2pdf/html2pdf.class.php');
						try
							{
								//Define parametros para generar el PDF
								$IdiomaPDF=$IdiomaPredeterminado;			// Acepta solo ca|cs|da|de|en|es|fr|it|nl|pt|tr
								$OrientacionPDF='P';						// P|ortrait  L|andscape
								$TamanoPaginaPDF='A4';						// A4|A5|LETTER|LEGAL|100×200...|
								$MargenPaginaMM='10';						// Como Entero o arreglo (Izq,Der,Arr,Aba) ej:  10  o  array(1, 25, 25, 5)
								$ModoVistaPDF='fullpage';					// fullpage|fullwidth|real|default
								$FuentePredeterminadaPDF='Arial';			// Arial|Courier|Courier-Bold|Courier-BoldOblique|Courier-Oblique|Helvetica|Helvetica-Bold|Helvetica-BoldOblique|Helvetica-Oblique|Symbol|Times-Roman|Times-Bold|Times-BoldItalic|Times-Italic|ZapfDingbats
								$ContrasenaLecturaPDF='';					// Si se asigna un valor pedira contrasena para poderlo leer
								$JavaScriptPDF='';							// Ej.  print(true);
								// Inicia la generacion del PDF
								$html2pdf = new HTML2PDF($OrientacionPDF,$TamanoPaginaPDF,$IdiomaPDF, true, 'UTF-8', $MargenPaginaMM);
								if ($ContrasenaLecturaPDF!="")
									$html2pdf->pdf->SetProtection(array('print'), $ContrasenaLecturaPDF);
								if ($JavaScriptPDF!="")
									$html2pdf->pdf->IncludeJS($JavaScriptPDF);
								$html2pdf->pdf->SetDisplayMode($ModoVistaPDF);
								$html2pdf->setDefaultFont($FuentePredeterminadaPDF);
								$html2pdf->WriteHTML($SalidaFinalInformePDF);
								$html2pdf->Output('tmp/Inf_'.$Identificador_informe.'-'.$Login_usuario.'.pdf', 'F'); // Antes: $html2pdf->Output('tmp/exemple.pdf'); enviaba salida al navegador directamente
							}
						catch (HTML2PDF_exception $e)
							{
								echo $e;
								exit;
							}
					}

				// Si se ha definido un tamano fijo entonces cierra el marco
				if ($registro_informe["ancho"]!="" && $registro_informe["alto"]!="")
					echo '</DIV>';
			} // Fin si informe es T (tabla)

		//Verifica si es un informe grafico sin dimensiones
		if ($registro_informe["formato_final"]=="G" && ( $registro_informe["ancho"]=="" || $registro_informe["alto"]=="" ))
			{
				echo '<form name="cancelarXTamano" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="accion" value="Ver_menu">
					<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorDatos.'">
					<input type="Hidden" name="error_descripcion" value="'.$MULTILANG_InfErrTamano.'">
					</form>
					<script type="" language="JavaScript"> document.cancelarXTamano.submit();  </script>';
			}

		// Si el informe tiene formato_final = G (grafico)
		if ($registro_informe["formato_final"]=="G" && $registro_informe["ancho"]!="" && $registro_informe["alto"]!="")
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
				echo '<img alt="Grafico" src="tmp/Inf_'.$Identificador_informe.'-'.$Login_usuario.'.png" style="border: 1px solid gray;">';
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
					ejecutar_sql_unaria("UPDATE ".$TablasCore."$tabla SET $campo = $valor WHERE id = ? ","$id");
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

