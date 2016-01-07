<?php
	/*
	   PCODER (Editor de Codigo en la Nube)
	   Sistema de Edicion de Codigo basado en PHP
	   Copyright (C) 2013  John F. Arroyave Gutiérrez
						   unix4you2@gmail.com
						   www.practico.org

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
	*/

	/*
		Title: Libreria base 
		Ubicacion *[/core/comunes_bd.php]*.  Archivo que contiene las funciones de uso global.
	*/
	/*
		Section: Funciones asociadas a las operaciones con bases de datos - Ejecucion de consultas
	*/


/* ################################################################## */
/* ################################################################## */
/*
	Function: listado_exploracion_archivos
	Construye una lista de los archivos contenidos en una carpeta y que coinciden con un flitro determinado

	Variables de entrada:

		RutaExploracion - El Path donde se desean buscar los archivos, preferible terminando en /
		Filtro_contenido - Un texto que debe ser contenido en el nombre de archivo para poder ser presentado.  Vacio indica cualquier archivo

	Salida:
		Arreglo de elementos asociados a cada archivo encontrado
*/
function listado_exploracion_archivos($RutaExploracion="",$Filtro_contenido="")
    {
        $PCO_ListadoArchivos=array();
        //Si la ruta de exploracion es diferente de vacio hace el proceso de busqueda de archivos
        if ($RutaExploracion!="")
            {
                $ContenidoDirectorio = opendir($RutaExploracion);
                while (($Elemento = readdir($ContenidoDirectorio)) !== false)
                    {
                        if (($Elemento != ".") && ($Elemento != "..") && (stristr($Elemento,$Filtro_contenido) || $Filtro_contenido=="")  )
                            {
                                $TamanoElemento=round(filesize($RutaExploracion.$Elemento)/1024);
                                $TipoElemento=filetype($RutaExploracion.$Elemento);
                                $FechaElemento=date("d F Y H:i:s", filemtime($RutaExploracion.$Elemento));
                                $EnlaceElemento=$RutaExploracion.$Elemento;
                                $PCO_ListadoArchivos[]=array(Ruta => $RutaExploracion, Nombre=>$Elemento, Enlace => $EnlaceElemento,Fecha => $FechaElemento, Tipo => $TipoElemento, Tamano => $TamanoElemento);
                            }
                    }
            }
		
		//Retorna la lista de archivos construida
		return $PCO_ListadoArchivos;
    }


/* ################################################################## */
/* ################################################################## */
/*
	Function: listado_exploracion_archivos
	Presenta una lista de los archivos contenidos en una carpeta con modificadores para las opciones
*/
function listado_visual_exploracion_archivos($RutaExploracion="",$Filtro_contenido="",$TituloExploracion="",$PermitirDescarga=1)
    {
        global $MULTILANG_TotalRegistros,$MULTILANG_Explorar,$MULTILANG_Filtro,$MULTILANG_Descargar,$MULTILANG_Tipo,$MULTILANG_Fecha,$MULTILANG_Peso;
        //Si la ruta de exploracion es diferente de vacio hace el proceso de busqueda de archivos
        if ($RutaExploracion!="")
            {
                //Inicia Marco de presentacion de archivos
                echo '
                    <div class="panel panel-default"> <!-- Clase chat-panel para altura -->
                        <div class="well well-sm">
                        <span class="label label-primary">'.$TituloExploracion.'</span> '.$MULTILANG_Explorar.' <b>'.$RutaExploracion.'</b> '.$MULTILANG_Filtro.' '.$Filtro_contenido.':
                        </div>
                        <div class="panel-body">
                            <ul class="chat">';

                $ConteoElementos=0;
                $TotalTamanoElementos=0;
                
                //Obtiene la lista de archivos
                $ListadoArchivos=listado_exploracion_archivos($RutaExploracion,$Filtro_contenido);
                
                //Recorre el arreglo de archivos encontrados para presentarlo
                $ContenidoDirectorio = opendir($RutaExploracion);
                foreach ($ListadoArchivos as $Archivo)
                    {
						echo '
						<li class="left clearfix">
							<span class="chat-img pull-left">
								<i class="fa fa-file-archive-o fa-2x fa-fw icon-gray"></i>
							</span>
							<div class="chat-body clearfix">
								<div class="header">
									<strong class="primary-font">'.$Archivo["Nombre"].'</strong> 
									<small class="pull-right text-muted">';
										//Si se debe presentar el boton de descarga lo agrega (por defecto), sino no lo muestra
										if($PermitirDescarga==1)
											echo '
												<a  href="'.$Archivo["Enlace"].'" class="btn btn-xs btn-default"><i class="fa fa-download fa-fw"></i> '.$MULTILANG_Descargar.'</a>
												<br>';

										echo ''.$MULTILANG_Peso.' <span class="badge">'.$Archivo["Tamano"].' Kb</span>
									</small>
								</div>
								<p>
									<i class="icon-gray">&nbsp;&nbsp;&nbsp;
									'.$MULTILANG_Fecha.': '.$Archivo["Fecha"].'
									('.$MULTILANG_Tipo.' '.$Archivo["Tipo"].')
									</i>
								</p>
							</div>
						</li>';    
						$ConteoElementos++;
						$TotalTamanoElementos+=$Archivo["Tamano"];
                    }

                //Cierra Marco de presentacion de archivos
                echo '
                            </ul>
                        </div> <!-- /.panel-body -->
                    <div class="well well-sm">'.$MULTILANG_TotalRegistros.': <b>'.$ConteoElementos.'</b> '.$MULTILANG_Peso.': <b>'.$TotalTamanoElementos.' Kb</b></div>
                    </div> <!-- /.panel .chat-panel -->';
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
			global $PCO_Accion;

			if ($PCO_Accion=="Iniciar_login")
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
	function ejecutar_sql($query,$lista_parametros="",$ConexionBD="")
		{
			/*
				Function: ejecutar_sql
				Ejecuta consultas que retornan registros (SELECTs).

				Variables de entrada:

					query - Consulta preformateada para ser ejecutada en el motor
					lista_parametros - Lista de variables PHP con parametros que deben ser preparados para el query separados por $_SeparadorCampos_
					ConexionBD - Determina si la consulta debe ser ejecutada en otra conexion o motor.  Se hace obligatorio enviar parametros cuando se envia otra conexion
					
				Salida:
					Retorna mensaje en pantalla con la descripcion devuelta por el driver en caso de error
					Retorna una variable con el arreglo de resultados en caso de ser exitosa la consulta
			*/
			
			//Determina si se debe usar la conexion global del sistema o una especifica de usuario
			if($ConexionBD=="")
				global $ConexionPDO;
			else
				$ConexionPDO=$ConexionBD;
			
			global $ModoDepuracion;
			global $MULTILANG_ErrorTiempoEjecucion,$MULTILANG_Detalles,$MULTILANG_ErrorSoloAdmin;
			global $PCO_Accion;
			global $PCOSESS_LoginUsuario,$_SeparadorCampos_;
			
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
							$parametros=@explode($_SeparadorCampos_,$lista_parametros);
							// if ($cantidad_parametros!=count($parametros)) //La cantidad de parametros en query es diferente a los recibidos
							//Recorre cada parametro y toma su valor
							for ($i=1;$i<=$cantidad_parametros;$i++)
								{
                                    /*
                                    //Si no recibe valor en el parametro hace el bind con vacio para al menos hacerlo valido
                                    if($parametros[$i-1] == "")
                                        $consulta->bindValue($i,'');  // $consulta->bindValue($i,PDO::PARAM_NULL);
                                    else
                                    */
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
					echo $ErrorPDO->getMessage();
					return 1;
				}
		}



/* ################################################################## */
/* ################################################################## */
	function ejecutar_sql_unaria($query,$lista_parametros="",$ConexionBD="")
		{
			/*
				Function: ejecutar_sql_unaria
				Ejecuta consultas que no retornan registros tales como CREATE, INSERT, DELETE, UPDATE entre otros.

				Variables de entrada:

					query - Consulta preformateada para ser ejecutada en el motor
					param - Lista de parametros que deben ser preparados para el query separados por coma
					ConexionBD - Determina si la consulta debe ser ejecutada en otra conexion o motor.  Se hace obligatorio enviar parametros cuando se envia otra conexion

				Salida:
					Retorna una cadena que contiene una descripcion de error PDO en caso de error y agrega un mensaje en pantalla con la descripcion devuelta por el driver
					Retorna una cadena vacia si la consulta es ejecutada sin problemas.
			*/

			//Determina si se debe usar la conexion global del sistema o una especifica de usuario
			if($ConexionBD=="")
				global $ConexionPDO;
			else
				$ConexionPDO=$ConexionBD;
			
			global $ModoDepuracion;
			global $PCOSESS_LoginUsuario,$_SeparadorCampos_;
			global $MULTILANG_ErrorTiempoEjecucion,$MULTILANG_Detalles,$MULTILANG_ErrorSoloAdmin,$MULTILANG_ContacteAdmin,$MULTILANG_MotorBD;
			try
				{
					$consulta = $ConexionPDO->prepare($query);
					//Cuando se reciben parametros entonces se asume recepcion de querys con  interrogaciones  ?
					//que deben ser preparados antes de ejecutarse con cada uno de los parametros recibidos
					if ($lista_parametros!="")
						{
							$cantidad_parametros=substr_count($query,'?');
							$parametros=@explode($_SeparadorCampos_,$lista_parametros);
							// if ($cantidad_parametros!=count($parametros)) //La cantidad de parametros en query es diferente a los recibidos
							//Recorre cada parametro y toma su valor
							for ($i=1;$i<=$cantidad_parametros;$i++)
								{
                                    //Si no recibe valor en el parametro hace el bind con null para al menos hacerlo valido
                                    /*
                                    if($parametros[$i-1] == '')
                                        //$consulta->bindValue($i,PDO::PARAM_NULL);
                                        //$consulta->bindValue($i,'');
                                        //$consulta->bindValue($i,$parametros[$i-1]);
                                        $consulta->bindParam($i,$parametros[$i-1]);
                                    else
                                        //$consulta->bindValue($i, $parametros[$i-1]);
                                    */
                                        //$consulta->bindValue($i, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $parametros[$i-1]));
                                        //$consulta->bindValue($i, utf8_encode($parametros[$i-1]));
                                        $consulta->bindValue($i, $parametros[$i-1]);
									//echo 'Parametro '.$i.'='.$parametros[$i-1]."<br>"; //PARA DEPURACION
								}
						}
					$consulta->execute();
					return "";
				}
			catch( PDOException $ErrorPDO)
				{
					echo $ErrorPDO->getMessage();
					return $MULTILANG_ErrorTiempoEjecucion;
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
	function auditar($PCO_Accion,$usuario="")
		{
			global $ArchivoCORE,$TablasCore;
			global $ListaCamposSinID_auditoria,$_SeparadorCampos_;
			global $PCOSESS_LoginUsuario,$PCO_FechaOperacion,$PCO_HoraOperacion;
			//Establece el usuario para el registro
			if ($usuario=="")
				$usuario_auditar=$PCOSESS_LoginUsuario;
			else
				$usuario_auditar=$usuario;
			//Lleva el registro
			ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria (".$ListaCamposSinID_auditoria.") VALUES (?,?,?,?)","$usuario_auditar$_SeparadorCampos_$PCO_Accion$_SeparadorCampos_$PCO_FechaOperacion$_SeparadorCampos_$PCO_HoraOperacion");
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
					mensaje($MULTILANG_ErrFuncion,$funcion_evaluada.': '.$MULTILANG_ErrDirectiva, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
			
			//Verifica soporte para LDAP cuando esta activado en la herramienta
			if ($Auth_TipoMotor=='ldap' &&  !extension_loaded('ldap'))
				mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrLDAP, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

			//Verifica soporte para HASH cuando se requiere encripcion
			if ($Auth_TipoEncripcion!="plano" && !extension_loaded('hash'))
				mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrHASH, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

			//Verifica soporte para sesiones
			if (!extension_loaded('session'))
				mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrSESS, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

			//Verifica soporte para GD2
			if (!extension_loaded('gd'))
				mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrGD, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

			//Verifica soporte para PDO
			if (!extension_loaded('pdo'))
				mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrPDO, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

			//Verifica soporte para el driver PDO correspondiente al motor utilizado
			if (!extension_loaded('pdo_'.$MotorBD))
				mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrDriverPDO, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

			//Verifica soporte para SimpleXML
			if (!extension_loaded('SimpleXML'))
				mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrSimpleXML, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
			
			// Bloqueos por IP/pais http://stackoverflow.com/questions/15835274/file-get-contents-failed-to-open-stream-connection-refused
			
			// Verifica el soporte para funciones especificas PHP
			$funcion_evaluada='file_get_contents';
			if (!function_exists($funcion_evaluada))
                mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrFuncion.'<b>'.$funcion_evaluada.'</b>', '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
			
		}

