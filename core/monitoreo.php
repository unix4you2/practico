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

	//Definicion de maquinas a monitorear
	$Maquinas[]=array(Nombre => "Sofia Servicio Web",	Host => "localhost",	Puerto => "80",		TipoMonitor=>"socket",	Icono=> "icn_rdp.png");
	$Maquinas[]=array(Nombre => "Sofia SSH",			Host => "localhost",	Puerto => "83",		TipoMonitor=>"socket",	Icono=> "");
	$Maquinas[]=array(Nombre => "Sofia MySQL",			Host => "192.168.1.250",	Puerto => "5060",	TipoMonitor=>"socket",	Icono=> "");
	$Maquinas[]=array(Nombre => "Remoto Bogota",		Host => "190.85.123.108",	Puerto => "820",	TipoMonitor=>"ping",	Icono=> "");
	//Comandos de monitoreo por shell validos
	$ComandosShell[]=array(Nombre => "Procesos",	Comando=>"ps -aux",	Ancho=>"80",	Alto=>"6");
	//Comandos monitoreo SQL
	$ComandosSQL[]=array(Nombre => "Consulta SQL",	Comando=>"SELECT COUNT(*) as Conteo FROM core_usuario",	TamanoResult=>"30",	OcultarTitulos=>"1");	

	//Path imagenes e iconos y sus propiedades
	$Path_imagenes="img/";
	$Imagen_fallo="icn_12.gif";
	$Imagen_ok="icn_11.gif";
	$Imagen_generica="tango_network-server.png";
	$Tamano_iconos=" width=20 heigth=20 ";
	$Imagen_generica_sql="tango_utilities-system-monitor.png";
	$Imagen_generica_shell="tango_utilities-terminal.png";

	//Variables de apariencia
	$ancho_tablas_maquinas=200;
	// Valores de presentacion predeterminados
	$color_fondo_estado="#CAF9CB";
	$color_texto_estado="green";

	$color_fondo_estado_sql="#CAF9CB";
	$color_texto_estado_sql="green";

	$color_fondo_ascii="transparent"; 	//Transparent o el codigo de color
	$color_texto_ascii="#FFFFFF";
	$barras_texto_ascii="hidden";		//hidden|auto







/* ################################################################## */
/* ################################################################## */
	function GetPing($ip=NULL)
		{
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
					$array = explode("/", end(explode("=", $exec )) );
					return ceil($array[1]) . 'ms';
				}
		}
		
		
/* ################################################################## */
/* ################################################################## */
	function ServicioOnline($maquina,$puerto,$tipo_monitor="socket")
		{
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
			
			//Verifica estado de la maquina y servicio
			$estado_actual=ServicioOnline($Maquina["Host"],$Maquina["Puerto"]);

			if ($estado_actual)
				$estado_final="<img src=".$Path_imagenes.$Imagen_ok." border=0 align=top ".$Tamano_iconos."> En linea";
			else
				{
					$estado_final="<blink><img src=".$Path_imagenes.$Imagen_fallo." border=0 align=top ".$Tamano_iconos."> Ca&iacute;do <img src=".$Path_imagenes.$Imagen_fallo." border=0 align=top></blink>";
					$color_fondo_estado="#FF3B36";
					$color_texto_estado="#FFFF00";
				}
			
			//Determina si a la maquina o servicio se le ha indicado un icono
			if ($Maquina["Icono"]!="")
				$icono_maquina='<img src="'.$Path_imagenes.$Maquina["Icono"].'" border=0 '.$Tamano_iconos.'>';
			else
				$icono_maquina='<img src="'.$Path_imagenes.$Imagen_generica.'" border=0 '.$Tamano_iconos.'>';

			echo '
				<table width="'.$ancho_tablas_maquinas.'" border=1 cellpadding=1 cellspacing=0 bgcolor="#DDDDDD" style="color:black; width:'.$ancho_tablas_maquinas.'px; display: inline!important; font-family: Verdana, Tahoma, Arial; font-size: 9px; margin-top: 5px; margin-right: 5px; margin-left: 5px; margin-bottom: 5px;">
					<tr>
						<td bgcolor="#D8D8FF" align=center>
							<table width="100%" border=0 cellpadding=2 cellspacing=0 style="color:black; font-family: Verdana, Tahoma, Arial; font-size: 11px;"><tr>
								<td>
									'.$icono_maquina.'
								</td>
								<td bgcolor="#D8D8FF" align=right>
									<font size=2><b>'.$Maquina["Nombre"].'</b></font><br>
								</td>
							</tr></table>
							('.$Maquina["Host"].':'.$Maquina["Puerto"].')
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

			$icono_maquina='<img src="'.$Path_imagenes.$Imagen_generica_sql.'" border=0 '.$Tamano_iconos.'>';
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
			$icono_maquina='<img src="'.$Path_imagenes.$Imagen_generica_shell.'" border=0 '.$Tamano_iconos.'>';
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







	//Recorre todos los servicios y maquinas definidos
	echo '<br>';
	for ($i=0;$i<count($Maquinas);$i++)
		PresentarEstadoMaquina($Maquinas[$i],$color_fondo_estado,$color_texto_estado);

	//Recorre todos los comandos de shell para monitoreo
	echo '<br>';
	for ($i=0;$i<count($ComandosShell);$i++)
		EjecutarComando($ComandosShell[$i]);
		//PresentarEstadoMaquina($Maquinas[$i],$color_fondo_estado,$color_texto_estado);

	//Recorre todos los comandos de monitoreo SQL
	echo '<br>';
	for ($i=0;$i<count($ComandosSQL);$i++)
		PresentarEstadoSQL($ComandosSQL[$i],$color_fondo_estado_sql,$color_texto_estado_sql);

	

