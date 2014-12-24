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
				Title: Modulo monitoreo
				Ubicacion *[/core/monitoreo.php]*.  Archivo de funciones relacionadas con el monitoreo del sistema local y remotos
			*/
?>


<?php 
/* ################################################################## */
/* ################################################################## */
	function MedirVelocidad($url_medidor="http://localhost/cargar_bytes.php",$unidad_medida="KB")
		{
			/*
				Function: MedirVelocidad
				Mide la velocidad de descarga desde el servidor actual hacia otra maquina
			*/

			//Se desactiva el limite de tiempo para ejecucion del script
			set_time_limit (0) ; 

			//Toma el tiempo inicial de ejecucion
			$tiempo_micro [1] = microtime();
			$q_espacios = explode (" ", $tiempo_micro[1]);
			$tiempo_[1] = $q_espacios[1]+$q_espacios[0];

			//Carga el contenido o URL mediante la cual mediremos la transferencia y lo guarda en una cadena
			$contenido = file_get_contents($url_medidor);
			//Convierte los bytes recibidos a la unidad de medida requerida.  Tener en cuenta:
			// 1 KB es igual a 1024 Bytes
			// 1 MB es igual a 1024 KB
			// 1 GB es igual a 1024 MB
			// 1 TB es igual a 1024 GB
			$tamano_KB = strlen($contenido)/1024;
			if ($unidad_medida=="MB") $tamano_KB = $tamano_KB/1024;
			if ($unidad_medida=="GB") $tamano_KB = ($tamano_KB/1024)/1024;
			if ($unidad_medida=="TB") $tamano_KB = (($tamano_KB/1024)/1024)/1024;			

			//Toma el tiempo final de ejecucion
			$tiempo_micro[2] = microtime();
			$q_espacios = explode (" ", $tiempo_micro[2]);
			$tiempo_[2] = $q_espacios[1]+$q_espacios[0];

			//Realiza los calculos de tiempos y velocidad
			$tiempo_utilizado = number_format ( ( $tiempo_ [ 2 ] - $tiempo_ [ 1 ] ) , 3 , "." , "," ) ;
			$velocidad = round ( $tamano_KB / $tiempo_utilizado , 2 ) ; 
			
			//Presenta resultados
			echo 'Velocidad de conexión: ' . $velocidad . ' '.$unidad_medida.'ps <br>
			 Se enviarón: ' . $tamano_KB . ' '.$unidad_medida.'ytes , Tiempo utilizado: ' . $tiempo_utilizado . ' Segundos <hr>' ;
		}


/* ################################################################## */
/* ################################################################## */
	function CargarBytes($tamano_transferencia=1024000)
		{
			/*
				Function: CargarBytes
				Genera N bytes para ser transmitidos en pruebas de velocidad

				Ver tambien:
					<MedirVelocidad>
			*/
			echo str_repeat ("X" , $tamano_transferencia);
		}


/* ################################################################## */
/* ################################################################## */
	function GetPing($ip=NULL)
		{
			/*
				Function: GetPing
				Determina si una maquina se encuentra o no encendida y respondiendo mediante el uso del comando ping

				Variables de entrada:

					ip - Direccion de la maquina, router, host o dispositivo que debe responder a la senal de ping

				Ver tambien:
					<ServicioOnline> | <PresentarEstadoMaquina>
			*/
			if(empty($ip))
				{
					$ip = $_SERVER['REMOTE_ADDR'];
				}
			if(getenv("OS")=="Windows_NT")
				{
					$exec = exec("ping -n 1 -l 64 ".$ip);
					return end(explode(" ", $exec ));
				}
			else
				{
					$exec = exec("ping -c 1 -s 64 -t 64 ".$ip);
					$expandidos_inicial=explode("=", $exec ); //1
					$puntero_final = end($expandidos_inicial);
					$array = explode("/", $puntero_final );
					return ceil($array[1]) . 'ms';
				}
		}
		
		
/* ################################################################## */
/* ################################################################## */
	function ServicioOnline($maquina,$puerto,$tipo_monitor="socket")
		{
			/*
				Function: ServicioOnline
				Determina si una maquina se encuentra o no encendida y respondiendo a senales de red

				Variables de entrada:

					maquina - Direccion de la maquina, router, host o dispositivo que debe responder a la senal de ping
					puerto - Puerto sobre el cual se encuentra el servicio que se desea probar.  Aplica para los tipos Socket
					tipo_monitor - Predeterminado en socket (mas veloz) o cambiable a ping (mas compatible) determina como realizar la prueba de conexion hasta la maquina remota

				Ver tambien:
					<GetPing> | <PresentarEstadoMaquina>
			*/
			if($tipo_monitor=="socket")
				{
					$estado_ok = @fsockopen($maquina, $puerto, $errno, $errstr, 30);   
					if($estado_ok)  
						return 1;
					else  
						return 0;
				}
			if($tipo_monitor=="ping")
				{
					if (GetPing($maquina) == 'perdidos),')
						{
							return 0; //echo 'Tiempo agotado';
						}
					else
						if (GetPing($maquina) == '0ms')
							{
								return 0; //echo 'servidor apagado';
							}
						else
							{
								return 1; //echo 'servidor con conectividad';
							}
				}				
		}


/* ################################################################## */
/* ################################################################## */
	function PresentarEstadoMaquina($Maquina,$color_fondo_estado,$color_texto_estado)
		{
			/*
				Function: PresentarEstadoMaquina
				Presenta una tabla formateada con el estado de una maquina en particular

				Ver tambien:

					<MaquinaOnline>
			*/
			global $ancho_tablas_maquinas,$Path_imagenes,$Imagen_fallo,$Imagen_generica,$Imagen_ok,$Tamano_iconos;
			global $ErroresMonitoreoPractico; // Una variable global que inciada en cero, cambia su valor en esta funcion cuando hay errores
			global $MULTILANG_MonTitulo,$fecha_operacion_guiones,$hora_operacion_puntos;
			global $MULTILANG_MonLinea,$MULTILANG_MonCaido;
			
			//Verifica estado de la maquina y servicio
			$estado_actual=ServicioOnline($Maquina["Host"],$Maquina["Puerto"],$Maquina["TipoMonitor"]);

			if ($estado_actual)
				$estado_final="$Imagen_ok $MULTILANG_MonLinea";
			else
				{
					$estado_final="<blink> $Imagen_fallo $MULTILANG_MonCaido $Imagen_fallo</blink>";
					$color_fondo_estado="#FF3B36";
					$color_texto_estado="#FFFF00";
					$ErroresMonitoreoPractico=1;
					//Envia mensaje de notificacion por correo
					enviar_correo("noreply@practico.org",$Maquina["CorreoAlerta"],$MULTILANG_MonTitulo." $MULTILANG_MonCaido [$fecha_operacion_guiones $hora_operacion_puntos] ",$Maquina["Nombre"]." [".$Maquina["Host"].":".$Maquina["Puerto"]."] -> ".$Maquina["TipoMonitor"]);				
				}
			
			//Determina si a la maquina o servicio se le ha indicado un icono
			$Separador_DosPuntos = "";
			if ($Maquina["TipoMonitor"]=="socket")
				$Separador_DosPuntos = ":";
            
            /*
			if ($Maquina["Icono"]!="")
				$icono_maquina='<img src="'.$Path_imagenes.$Maquina["Icono"].'" border=0 '.$Tamano_iconos.'>';
			else*/
				$icono_maquina=$Imagen_generica;

			echo '
				<table width="'.$ancho_tablas_maquinas.'" border=1 cellpadding=1 cellspacing=0 bgcolor="#DDDDDD" style="color:black; width:'.$ancho_tablas_maquinas.'px; display: inline!important; font-family: Verdana, Tahoma, Arial; font-size: 9px; margin-top: 5px; margin-right: 5px; margin-left: 5px; margin-bottom: 5px;">
					<tr>
						<td width="'.$ancho_tablas_maquinas.'" bgcolor="#D8D8FF" align=center>
							<table width="100%" border=0 cellpadding=2 cellspacing=0 style="color:black; font-family: Verdana, Tahoma, Arial; font-size: 11px;"><tr>
								<td>
									'.$icono_maquina.'
								</td>
								<td bgcolor="#D8D8FF" align=right>
									<font size=2><b>'.$Maquina["Nombre"].'</b></font><br>
								</td>
							</tr></table>
							('.$Maquina["Host"].$Separador_DosPuntos.$Maquina["Puerto"].')
						</td>
					</tr>
					<tr>
						<td colspan=2 align=center bgcolor="'.$color_fondo_estado.'">
							<font size=3 color="'.$color_texto_estado.'"><b>'.$estado_final.'</b></font>
						</td>
					</tr>
				</table>
			';
		
		}


/* ################################################################## */
/* ################################################################## */
	function PresentarEstadoSQL($ComandoSQL,$color_fondo_estado_sql,$color_texto_estado_sql)
		{
			/*
				Function: PresentarEstadoSQL
				Ejecuta un query SQL y presenta el resultado formateado como tabla
			*/
			global $Path_imagenes,$Imagen_generica_sql,$Tamano_iconos;
			$SalidaFinalInforme='<table border=0 cellspacing=0 cellpadding=2 style="color:black; width:'.$ancho_tablas_maquinas.'px; display: inline!important; font-family: Verdana, Tahoma, Arial; font-size: 11px;">';


			// Busca e Imprime encabezados de columna si no se tienen que ocultar
					$resultado_columnas=ejecutar_sql($ComandoSQL["Comando"]);
					$numero_columnas=0;
					$SalidaFinalInforme.='<thead><tr>';
					foreach($resultado_columnas->fetch(PDO::FETCH_ASSOC) as $key=>$val)
						{
							if ($ComandoSQL["OcultarTitulos"]==0)
								{
									$SalidaFinalInforme.= '<th align="LEFT">'.ucwords(strtolower($key)).'</th>';
								}
							$numero_columnas++;
						}
					$SalidaFinalInforme.="</tr></thead>";

			//Ejecuta el query
			$consulta_ejecucion=ejecutar_sql($ComandoSQL["Comando"]);
			while($registro_informe=$consulta_ejecucion->fetch())
				{
					$SalidaFinalInforme.= '<tr>';
					for ($i=0;$i<$numero_columnas;$i++)
						{
							$SalidaFinalInforme.= '<td style="font-size: '.$ComandoSQL["TamanoResult"].'px;">'.$registro_informe[$i].'</td>';
						}
					$SalidaFinalInforme.= '</tr>';
				}
			$SalidaFinalInforme.="</tr></table>";

			$icono_maquina=$Imagen_generica_sql;
			echo '
				<table width="'.$ancho_tablas_maquinas.'" border=1 cellpadding=1 cellspacing=0 bgcolor="#DDDDDD" style="color:black; width:'.$ancho_tablas_maquinas.'px; display: inline!important; font-family: Verdana, Tahoma, Arial; font-size: 9px; margin-top: 5px; margin-right: 5px; margin-left: 5px; margin-bottom: 5px;">
					<tr>
						<td bgcolor="#D8D8FF" align=center>
							<table width="100%" border=0 cellpadding=2 cellspacing=0 style="color:black; font-family: Verdana, Tahoma, Arial; font-size: 11px;"><tr>
								<td>
									'.$icono_maquina.'
								</td>
								<td bgcolor="#D8D8FF" align=right>
									<font size=2><b>'.$ComandoSQL["Nombre"].'</b></font><br>
								</td>
							</tr></table>
						</td>
					</tr>
					<tr>
						<td colspan=2 align=center bgcolor="'.$color_fondo_estado_sql.'">
							<font size=3 color="'.$color_texto_estado_sql.'"><b>'.$SalidaFinalInforme.'</b></font>
						</td>
					</tr>
				</table>
			';
		}


/* ################################################################## */
/* ################################################################## */
	function PresentarTextoASCII($texto,$ancho,$alto)
		{
			/*
				Function: PresentarTextoASCII
				Crea un cuadro de texto y presenta en él un resultado determinado
			*/
			global $color_fondo_ascii,$color_texto_ascii,$barras_texto_ascii;

			//Presenta la salida
			echo '<textarea cols="'.$ancho.'" rows="'.$alto.'" style="overflow: '.$barras_texto_ascii.'; color: '.$color_texto_ascii.'; background-color: '.$color_fondo_ascii.'; font-size:11px; font-family: Monospace, Sans-serif, Tahoma; display: inline!important; border:0px;">'.$texto.'</textarea>';
		}


/* ################################################################## */
/* ################################################################## */
	function PresentarImagen($ImagenRRD)
		{
			/*
				Function: PresentarImagen
				Muestra una imagen en un path relativo a la ejecucion de la herramienta y de un tamano en pixeles determinado
			*/

			//Presenta la imagen
			echo '<img src="'.$ImagenRRD["Path"].'" width="'.$ImagenRRD["Ancho"].'" height="'.$ImagenRRD["Alto"].'" border=0>';
		}


/* ################################################################## */
/* ################################################################## */
	function EjecutarComando($comando_ejecutar)
		{
			/*
				Function: EjecutarComando
				Ejecuta comandos autorizados en el servidor para mostrar su respuesta
			*/
			global $Path_imagenes,$Imagen_generica_shell,$Tamano_iconos,$color_fondo_ascii;
			
			//Ejecuta el comando
			$salida_comando = shell_exec($comando_ejecutar["Comando"]);
			//Presenta la salida
			$icono_maquina=$Imagen_generica_shell;
			echo '
				<table width="'.$ancho_tablas_maquinas.'" border=1 cellpadding=1 cellspacing=0 style="color:black; width:'.$ancho_tablas_maquinas.'px; display: inline!important; font-family: Verdana, Tahoma, Arial; font-size: 9px; margin-top: 5px; margin-right: 5px; margin-left: 5px; margin-bottom: 5px;">
					<tr>
						<td bgcolor="#D8D8FF" align=center>
							<table width="100%" border=0 cellpadding=2 cellspacing=0 style="color:black; font-family: Verdana, Tahoma, Arial; font-size: 11px;"><tr>
								<td>
									'.$icono_maquina.'
								</td>
								<td bgcolor="#D8D8FF" align=right>
									<font size=2><b>'.$comando_ejecutar["Nombre"].'</b></font><br>
								</td>
							</tr></table>
						</td>
					</tr>
					<tr>
						<td colspan=2 align=center bgcolor="'.$color_fondo_ascii.'">';
							PresentarTextoASCII($salida_comando,$comando_ejecutar["Ancho"],$comando_ejecutar["Alto"]);
			echo '		</td>
					</tr>
				</table>
			';
		}


/* ################################################################## */
/* ################################################################## */
if ($accion=="eliminar_monitoreo")
	{
		/*
			Function: eliminar_monitoreo
			Elimina una opcion del menu, escritorio o demas ubicaciones definidas por el administrador incluyendo el vinculo a todos los usuarios que la tengan.

			Variables de entrada:

				id - Identificador unico en la tabla de menu

			(start code)
				DELETE FROM ".$TablasCore."monitoreo WHERE id=$id
			(end)

			Salida:
				Entradas de menu actualizadas.

			Ver tambien:
			<administrar_monitoreo> | <guardar_monitoreo>
		*/
		// Elimina los datos del monitor
		ejecutar_sql_unaria("DELETE FROM ".$TablasCore."monitoreo WHERE id=? ","$id");
		auditar("Elimina monitor $id");
					echo '
					<form name="continuar_admin_mon" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="administrar_monitoreo">
					</form>
					<script type="" language="JavaScript"> 
					alert("'.$MULTILANG_Aplicando.'");
					document.continuar_admin_mon.submit();  </script>';
	}


/* ################################################################## */
/* ################################################################## */
		/*
			Function: guardar_monitoreo
			Almacena un nuevo monitor definido por el usuario

			(start code)
				INSERT INTO ".$TablasCore."monitoreo VALUES ( ... )
			(end)

			Salida:
				Entradas en la tabla de monitoreo actualizadas

			Ver tambien:
			<administrar_monitoreo>
		*/
	if ($accion=="guardar_monitoreo")
		{
			$mensaje_error="";
			// Verifica campos nulos
			if ($nombre=="")
				$mensaje_error.=$MULTILANG_MonErr."<br>";

			if ($mensaje_error=="")
				{
					// Guarda los datos del comando de monitoreo
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."monitoreo (".$ListaCamposSinID_monitoreo.") VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)","$tipo$_SeparadorCampos_$pagina$_SeparadorCampos_$peso$_SeparadorCampos_$nombre$_SeparadorCampos_$host$_SeparadorCampos_$puerto$_SeparadorCampos_$tipo_ping$_SeparadorCampos_$saltos$_SeparadorCampos_$comando$_SeparadorCampos_$ancho$_SeparadorCampos_$alto$_SeparadorCampos_$tamano_resultado$_SeparadorCampos_$ocultar_titulos$_SeparadorCampos_$path$_SeparadorCampos_$correo_alerta$_SeparadorCampos_$alerta_sonora$_SeparadorCampos_$milisegundos_lectura");
					auditar("Agrega en monitor: $nombre");
					echo '
					<form name="continuar_admin_mon" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="administrar_monitoreo">
					</form>
					<script type="" language="JavaScript"> 
					alert("'.$MULTILANG_Aplicando.'");
					document.continuar_admin_mon.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="administrar_monitoreo">
						<input type="Hidden" name="error_titulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}

/* ################################################################## */
/* ################################################################## */
		/*
			Function: administrar_monitoreo
			Presenta la lista de todos los monitores de red, sql y comandos definidos

			(start code)
				SELECT * FROM ".$TablasCore."monitoreo WHERE 1
			(end)

			Salida:
				Listado de monitores y paginas de monitoreo definidas

			Ver tambien:
			<guardar_monitoreo>
		*/
if ($accion=="administrar_monitoreo")
	{
		$accion=escapar_contenido($accion); //Limpia cadena para evitar XSS
		echo '<div align="center"><br>';
		abrir_ventana($MULTILANG_MonConfig,'panel-primary');
?>

		<div id='FondoPopUps' class="FondoOscuroPopUps"></div>

		<div align="center">
			<form name="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="hidden" name="accion" value="guardar_monitoreo">
			<br><font face="" size="3" color="Navy"><b><?php echo $MULTILANG_MonNuevo; ?></b></font>
			<table border="0" cellspacing="10" cellpadding="0" class="TextosVentana"><tr>
				<td valign="TOP" align=center>
					<i class="fa fa-link"></i><br><br>
					<table border="0" cellspacing="5" cellpadding="0" align="CENTER" class="TextosVentana">
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_Tipo; ?></b></td><td width="10"></td>
							<td>
									<select  name="tipo" class="Combos" >
										<option value="Etiqueta"><?php echo $MULTILANG_Etiqueta; ?></option>
										<option value="Maquina" selected><?php echo $MULTILANG_Maquina; ?></option>
										<option value="ComandoShell"><?php echo $MULTILANG_MonCommShell; ?></option>
										<option value="ComandoSQL"><?php echo $MULTILANG_MonCommSQL; ?></option>
										<option value="Imagen"><?php echo $MULTILANG_Imagen; ?></option>
										<option value="Embebido"><?php echo $MULTILANG_Embebido; ?></option>
									</select>
									<a href="#" title="<?php echo $MULTILANG_Ayuda; ?>" name="<?php echo $MULTILANG_MonDesTipo; ?>"><i class="fa fa-question-circle"></i></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_Pagina; ?></b></td><td width="10"></td>
							<td>
									<select name="pagina" class="Combos" >
											<?php
													for ($i=1;$i<=20;$i++)
														{
																echo '<option value="'.$i.'">'.$i.'</option>';
														}
											?>
									</select>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_Peso; ?></b></td><td width="10"></td>
							<td>
									<select name="peso" class="Combos" >
											<?php
													for ($i=1;$i<=50;$i++)
														{
																echo '<option value="'.$i.'">'.$i.'</option>';
														}
											?>
									</select>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_Nombre; ?></b></td><td width="10"></td>
							<td><input class="CampoTexto" type="text" name="nombre" size="40" maxlength="250"></td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MonSaltos; ?></b></td><td width="10"></td>
							<td>
									<select name="saltos" class="Combos" >
											<?php
													for ($i=0;$i<=15;$i++)
														{
																echo '<option value="'.$i.'">'.$i.'</option>';
														}
											?>
									</select>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MonMsLectura; ?></b></td><td width="10"></td>
							<td><input class="CampoTexto" type="text" value="1000" name="milisegundos_lectura" size="5" maxlength="250"> ms</td>
						</tr>
					</table>

					<br><br><font size=2><b><a href="index.php?accion=ver_monitoreo&Presentar_FullScreen=1" target="_BLANK">[ <i class="fa fa-play"></i> <?php echo " $MULTILANG_MonPgInicio -> $MULTILANG_MonTitulo ";?>]</a></b></font>
				</td>
				<td align="CENTER" valign="TOP">

					<table border="0" cellspacing="5" cellpadding="0" align="CENTER" class="TextosVentana">
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_Maquina; ?> / IP</b></td><td width="10"></td>
							<td><input class="CampoTexto" type="text" name="host" size="20" maxlength="250">
							<a href="#" title="<?php echo $MULTILANG_AplicaPara; ?>" name="<?php echo "$MULTILANG_Tipo: $MULTILANG_Maquina"; ?>"><i class="fa fa-question-circle"></i></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_Puerto; ?></b></td><td width="10"></td>
							<td><input class="CampoTexto" type="text" name="puerto" size="5" maxlength="250">
							<a href="#" title="<?php echo $MULTILANG_AplicaPara; ?>" name="<?php echo "$MULTILANG_Tipo: $MULTILANG_Maquina"; ?>"><i class="fa fa-question-circle"></i></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MonMetodo; ?></b></td><td width="10"></td>
							<td>
									<select  name="tipo_ping" class="Combos" >
										<option value="socket">Socket</option>
										<option value="ping">Ping</option>
									</select>
									<a href="#" title="<?php echo $MULTILANG_AplicaPara; ?>" name="<?php echo "$MULTILANG_Tipo: $MULTILANG_Maquina"; ?>"><i class="fa fa-question-circle"></i></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_Comando; ?></b></td><td width="10"></td>
							<td><textarea name="comando" cols="40" rows="3" class="AreaTexto" onkeypress="return FiltrarTeclas(this, event)"></textarea>
							<a href="#" title="<?php echo $MULTILANG_AplicaPara; ?>" name="<?php echo "$MULTILANG_Tipo: $MULTILANG_MonCommShell, $MULTILANG_MonCommSQL"; ?>"><i class="fa fa-question-circle"></i></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_FrmAncho; ?></b></td><td width="10"></td>
							<td><input class="CampoTexto" type="text" name="ancho" size="5" maxlength="250">
							<a href="#" title="<?php echo $MULTILANG_AplicaPara; ?>" name="<?php echo "$MULTILANG_Tipo: $MULTILANG_MonCommShell (caracteres),$MULTILANG_Imagen (pixeles), $MULTILANG_Embebido (pixeles)"; ?>"><i class="fa fa-question-circle"></i></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_InfAlto; ?></b></td><td width="10"></td>
							<td><input class="CampoTexto" type="text" name="alto" size="5" maxlength="250">
							<a href="#" title="<?php echo $MULTILANG_AplicaPara; ?>" name="<?php echo "$MULTILANG_Tipo: $MULTILANG_MonCommShell (caracteres),$MULTILANG_Imagen (pixeles), $MULTILANG_Embebido (pixeles)"; ?>"><i class="fa fa-question-circle"></i></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MonTamano; ?></b></td><td width="10"></td>
							<td>
									<select name="tamano_resultado" class="Combos" >
											<?php
													for ($i=1;$i<=100;$i++)
														{
																echo '<option value="'.$i.'">'.$i.'</option>';
														}
											?>
									</select> pixeles <a href="#" title="<?php echo $MULTILANG_AplicaPara; ?>" name="<?php echo "$MULTILANG_Tipo: $MULTILANG_MonCommSQL"; ?>"><i class="fa fa-question-circle"></i></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MonOcultaTit; ?></b></td><td width="10"></td>
							<td>
									<select  name="ocultar_titulos" class="Combos" >
										<option value="0"><?php echo $MULTILANG_No; ?></option>
										<option value="1"><?php echo $MULTILANG_Si; ?></option>
									</select> <a href="#" title="<?php echo $MULTILANG_AplicaPara; ?>" name="<?php echo "$MULTILANG_Tipo: $MULTILANG_MonCommSQL"; ?>"><i class="fa fa-question-circle"></i></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MnuURL; ?></b></td><td width="10"></td>
							<td><input class="CampoTexto" type="text" name="path" size="40" maxlength="250">
							<a href="#" title="<?php echo $MULTILANG_AplicaPara; ?>" name="<?php echo "$MULTILANG_Tipo: $MULTILANG_Imagen, $MULTILANG_Embebido"; ?>"><i class="fa fa-question-circle"></i></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MonCorreoAlerta; ?></b></td><td width="10"></td>
							<td><input class="CampoTexto" type="text" name="correo_alerta" size="40" maxlength="250">
							<a href="#" title="<?php echo $MULTILANG_AplicaPara; ?>" name="<?php echo "$MULTILANG_Tipo: $MULTILANG_Maquina"; ?>"><i class="fa fa-question-circle"></i></a>
							</td>
						</tr>
						<tr>
							<td align="RIGHT"><b><?php echo $MULTILANG_MonAlertaSnd; ?></b></td><td width="10"></td>
							<td>
									<select  name="alerta_sonora" class="Combos" >
										<option value="1"><?php echo $MULTILANG_Si; ?></option>
										<option value="0"><?php echo $MULTILANG_No; ?></option>
									</select>
									<a href="#" title="<?php echo $MULTILANG_AplicaPara; ?>" name="<?php echo "$MULTILANG_Tipo: $MULTILANG_Maquina"; ?>"><i class="fa fa-question-circle"></i></a>
							</td>
						</tr>
					</table>

				</td>
			</tr></table>

			<table width="90%" border="0" cellspacing="0" cellpadding="0"  class="TextosVentana"><tr>
				<td align="RIGHT" valign="TOP">
					<table border="0" cellspacing="5" cellpadding="0" align="CENTER" style="font-family: Verdana, Tahoma, Arial; font-size: 10px; margin-top: 10px; margin-right: 10px; margin-left: 10px; margin-bottom: 10px;" class="link_menu">
						<tr>
							<td align="RIGHT">
									</form>
							</td><td width="5"></td>
							<td align="RIGHT">
									<input type="button" name="" value="<?php echo $MULTILANG_Agregar; ?>" class="Botones" onClick="document.datos.submit()">
									&nbsp;&nbsp;<input type="Button" onclick="document.core_ver_menu.submit()" value="<?php echo $MULTILANG_Cancelar; ?>" value="" class="Botones">
							</td>
						</tr>
					</table>
				</td>
			</tr></table><hr>

		<font face="" size="3" color="Navy"><b><?php echo $MULTILANG_MonDefinidos; ?></b></font><br><br>
		 <?php
				echo '
				<table width="100%" border="0" cellspacing="3" align="CENTER" class="TextosVentana">
					<tr>
						<td align="left" bgcolor="#d6d6d6"><b>'.$MULTILANG_Pagina.'</b></td>
						<td align="left" bgcolor="#d6d6d6"><b>'.$MULTILANG_Peso.'</b></td>
						<td align="left" bgcolor="#d6d6d6"><b>'.$MULTILANG_Tipo.'</b></td>
						<td align="LEFT" bgcolor="#D6D6D6"><b>'.$MULTILANG_Nombre.'</b></td>
						<td align="LEFT" bgcolor="#D6D6D6"><b>'.$MULTILANG_MonMsLectura.'</b></td>
						<td></td>
						<td></td>
					</tr>	';

				$resultado=ejecutar_sql("SELECT id,".$ListaCamposSinID_monitoreo." FROM ".$TablasCore."monitoreo WHERE 1=1 ORDER BY pagina,peso ");
				while($registro = $resultado->fetch())
					{
						$cadena_detalles=$MULTILANG_Detalles.": ".$registro["nombre"]." (".$registro["id"].")\\n-----------------\\n"
						."\\n $MULTILANG_Pagina: ".$registro["pagina"]
						."\\n $MULTILANG_Peso: ".$registro["peso"]
						."\\n $MULTILANG_Tipo: ".$registro["tipo"]
						."\\n $MULTILANG_Nombre: ".$registro["nombre"]
						."\\n $MULTILANG_Maquina: ".$registro["host"]
						."\\n $MULTILANG_Puerto: ".$registro["puerto"]
						."\\n $MULTILANG_MonMetodo: ".$registro["tipo_ping"]
						."\\n $MULTILANG_MonSaltos: ".$registro["saltos"]
						."\\n $MULTILANG_Comando: ".$registro["comando"]
						."\\n $MULTILANG_FrmAncho: ".$registro["ancho"]
						."\\n $MULTILANG_InfAlto: ".$registro["alto"]
						."\\n $MULTILANG_MonTamano: ".$registro["tamano_resultado"]
						."\\n $MULTILANG_MonOcultaTit: ".$registro["ocultar_titulos"]
						."\\n $MULTILANG_MnuURL: ".$registro["path"]
						."\\n $MULTILANG_MonCorreoAlerta: ".$registro["correo_alerta"]
						."\\n $MULTILANG_MonAlertaSnd: ".$registro["alerta_sonora"]
						."\\n $MULTILANG_MonMsLectura: ".$registro["milisegundos_lectura"]
						."\\n\\n-------------------\\n".$MULTILANG_Finalizado;
						echo '<tr>
								<td>'.$registro["pagina"].'</td>
								<td>'.$registro["peso"].'</td>
								<td>'.$registro["tipo"].'</td>
								<td>'.$registro["nombre"].'</td>
								<td>'.$registro["milisegundos_lectura"].'</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST" name="f'.$registro["id"].'" id="f'.$registro["id"].'">
												<input type="hidden" name="accion" value="eliminar_monitoreo">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="button" value="'.$MULTILANG_Eliminar.'" class="BotonesCuidado" onClick="confirmar_evento(\''.$MULTILANG_MnuAdvElimina.'\',f'.$registro["id"].');">
										</form>
								</td>
								<td align="center">
									<input type="Button" OnClick="window.alert(\''.$cadena_detalles.'\');" value="'.$MULTILANG_Detalles.'" class="Botones">
								</td>
							</tr>';
					}
				echo '</table>';
		 ?>
		</div>

		 <?php
		 				cerrar_ventana();
		 		} //Fin administrar_monitoreo


/* ################################################################## */
/* ################################################################## */
		/*
			Function: ver_monitoreo
			Presenta las diferentes pantallas de monitoreo

			Salida:
				Pagina web con el sistema de monitoreo

			Ver tambien:
			<guardar_monitoreo>
		*/
if ($accion=="ver_monitoreo")
	{

?>
		<html>
			<head>
				<title><?php echo $MULTILANG_MonEstado; ?></title>
                <link rel="stylesheet" href="inc/font-awesome/css/font-awesome.min.css">
			</head>
		<body bgcolor="#000000" vlink="#000000" leftmargin="0" topmargin="0" oncontextmenu="return false;" style="font-family: Verdana, Tahoma, Arial; font-size: 11px;">

		<?php
			//Busa la mayor y menor pagina definida
			$resultado=ejecutar_sql("SELECT MIN(pagina) as minimo,MAX(pagina) as maximo FROM ".$TablasCore."monitoreo ");
			$registro = $resultado->fetch();
			$PaginaInicio=$registro["minimo"];
			$MaximoPaginas=$registro["maximo"];
			//Define la pagina que debe ser cargada
			if (@$Pagina=="") $PaginaMonitoreo=$PaginaInicio;
			else $PaginaMonitoreo=$Pagina;
			//Salta a la siguiente pagina, si la pagina es mayor a las permitidas retorna a la primera
			$SiguientePagina=$PaginaMonitoreo+1;
			if($SiguientePagina>$MaximoPaginas) $SiguientePagina=$PaginaInicio;
			//Busca cuantos milisegundos esperar segun la pagina definida y sus elementos
			$resultado=ejecutar_sql("SELECT SUM(milisegundos_lectura) as total_espera FROM ".$TablasCore."monitoreo WHERE pagina='$PaginaMonitoreo' ");
			$registro = $resultado->fetch();
			$MilisegundosPagina=$registro["total_espera"];
		?>

		<script language="JavaScript">
			function actualizar()
				{
					document.location="index.php?accion=ver_monitoreo&Presentar_FullScreen=1&Pagina=<?php echo $SiguientePagina; ?>";
				}
			window.setTimeout("actualizar()",<?php echo $MilisegundosPagina; ?>);
		</script>

		<!-- INICIA LA TABLA PRINCIPAL -->
		<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="left" style="color:white;">
			<tr><td height="100%" valign="<?php if ($accion=="Ver_menu") echo 'TOP'; else echo 'MIDDLE'; ?>" align="center">

				<?php
					$ErroresMonitoreoPractico=0;

					//Path imagenes e iconos y sus propiedades
					$Path_imagenes="img/";
					//$Imagen_fallo='<img src=".$Path_imagenes."icn_12.gif border=0 align=top ".$Tamano_iconos.">';
                    $Imagen_fallo='<i class="fa fa-exclamation-triangle icon-orange"></i>';
					//$Imagen_ok='<img src=".$Path_imagenes."icn_11.gif border=0 align=top ".$Tamano_iconos.">';
                    $Imagen_ok='<i class="fa fa-check-circle icon-green"></i>';
					//$Imagen_generica='<img src=".$Path_imagenes."icn_rdp.png border=0 align=top ".$Tamano_iconos.">';
                    $Imagen_generica='<i class="fa fa-certificate"></i>';
					$Tamano_iconos=" width=20 heigth=20 ";
                    //$Imagen_generica_sql='<img src=".$Path_imagenes."icn_03.gif border=0 align=top ".$Tamano_iconos.">';
                    $Imagen_generica_sql='<i class="fa fa-database"></i>';
					//$Imagen_generica_shell='<img src=".$Path_imagenes."icn_07.gif border=0 align=top ".$Tamano_iconos.">';
                    $Imagen_generica_shell='<i class="fa fa-terminal"></i>';
					$Sonido_alarma="inc/practico/sonidos/alarma.mp3";

					//Variables de apariencia
					$ancho_tablas_maquinas=150;
					// Valores de presentacion predeterminados
					$color_fondo_estado="#CAF9CB";
					$color_texto_estado="green";

					$color_fondo_estado_sql="#CAF9CB";
					$color_texto_estado_sql="green";

					$color_fondo_ascii="transparent"; 	//Transparent o el codigo de color
					$color_texto_ascii="#FFFFFF";
					$barras_texto_ascii="hidden";		//hidden|auto

					$PosicionImagenes=0; //La posicion global para saber que imagen sigue

					//Limpia los arreglos de monitores
					unset($Maquinas);
					unset($ComandosShell);
					unset($ComandosSQL);
					unset($Imagenes);
					//Recorre la pagina en cuestion
					$resultado=ejecutar_sql("SELECT id,".$ListaCamposSinID_monitoreo." FROM ".$TablasCore."monitoreo WHERE pagina='$PaginaMonitoreo' ORDER BY peso ");
					while($registro = $resultado->fetch())
						{
							//Evalua elementos tipo Etiqueta
							if ($registro["tipo"]=="Etiqueta")
								{
									echo $registro["nombre"];
								}
							//Evalua elementos tipo Maquina o host
							if ($registro["tipo"]=="Maquina")
								{
									$Maquinas[]=@array(Nombre => $registro["nombre"],	Host => $registro["host"],	Puerto => $registro["puerto"],		TipoMonitor=>$registro["tipo_ping"],	Icono=> $Imagen_generica,		CorreoAlerta=>$registro["correo_alerta"]);
									PresentarEstadoMaquina($Maquinas[count($Maquinas)-1],$color_fondo_estado,$color_texto_estado);
								}
							//Evalua elementos tipo Comando shell
							if ($registro["tipo"]=="ComandoShell")
								{
									$ComandosShell[]=array(Nombre => $registro["nombre"],	Comando=>$registro["comando"],	Ancho=>$registro["ancho"],	Alto=>$registro["alto"]);
									EjecutarComando($ComandosShell[count($ComandosShell)-1]);
								}
							//Evalua elementos tipo Consulta SQL
							if ($registro["tipo"]=="ComandoSQL")
								{
									$ComandosSQL[]=array(Nombre => $registro["nombre"],	Comando=>$registro["comando"],	TamanoResult=>$registro["tamano_resultado"],	OcultarTitulos=>$registro["ocultar_titulos"]);
									PresentarEstadoSQL($ComandosSQL[count($ComandosSQL)-1],$color_fondo_estado_sql,$color_texto_estado_sql);
								}
							//Evalua elementos tipo Imagen
							if ($registro["tipo"]=="Imagen")
								{
									$Imagenes[]=array(Nombre => $registro["nombre"],	Path=>$registro["path"],	Ancho=>$registro["ancho"],	Alto=>$registro["alto"],	Salto=>"0");	
									PresentarImagen($Imagenes[count($Imagenes)-1]);
								}
							//Evalua elementos tipo Embebido
							if ($registro["tipo"]=="Embebido")
								{
									echo '<iframe src="'.$registro["path"].'" width="'.$registro["ancho"].'" height="'.$registro["alto"].'"></iframe>';
								}
							//Agrega los saltos de linea
							for ($i=0;$i<$registro["saltos"];$i++) echo "<br>";
						}

					// Si encuentra algun error en el monitoreo reproduce la alarma
					if ($ErroresMonitoreoPractico)
						{
							$Ruta_Servidor="http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
							$Ruta_Servidor=str_replace(basename($_SERVER['PHP_SELF']),"",$Ruta_Servidor);
							$Ruta_Servidor.=$Sonido_alarma;
							//Tipos de reproduccion
							//echo '<embed height="50" width="100" src="'.$Sonido_alarma.'">';
							//echo '<object height="50" width="100" data="'.$Sonido_alarma.'"></object>';
							//echo '<bgsound src="'.$Sonido_alarma.'" loop="1"></bgsound>';
							//echo '<audio autoplay id="bgsound"><source src="'.$Sonido_alarma.'" type="audio/mp3"><p>Navegador no soporta Audio en HTML5</p></audio>';
							echo '<iframe src="'.$Ruta_Servidor.'" width="0" height="0"></iframe>';
						}

				?>
			<!-- PIE DE PAGINA -->	
			<tr><td>
				<table width="100%" cellspacing="0" cellpadding="0" border=0 class="MarcoInferior"><tr>
					<td align="left" valign="bottom" width="50%">
					</td>
					<td align="right" valign="bottom" width="50%">
						<font color=lightgray size=1><i><?php echo $MULTILANG_MonAcerca; ?></i>&nbsp;&nbsp;</font>
					</td>
				</tr></table>
			</td></tr>
		<!-- FINALIZA LA TABLA PRINCIPAL -->
		</td></tr></table>
		<?php
			// Estadisticas de uso anonimo con GABeacon
			$PrefijoGA='<img src="https://ga-beacon.appspot.com/';
			$PosfijoGA='/Practico/'.$accion.'?pixel" border=0 ALT=""/>';
			// Este valor indica un ID generico de GA UA-847800-9 No edite esta linea sobre el codigo
			// Para validar que su ID es diferente al generico de seguimiento.  En lugar de esto cambie
			// su valor a traves del panel de configuracion de Practico con el entregado como ID de GoogleAnalytics
			$Infijo=base64_decode("VUEtODQ3ODAwLTk=");
			echo $PrefijoGA.$Infijo.$PosfijoGA;
			if(@$CodigoGoogleAnalytics!="")
				echo $PrefijoGA.$CodigoGoogleAnalytics.$PosfijoGA;	
		?>
		</body>
		</html>
<?php
	} //Fin ver_monitoreo

