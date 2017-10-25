<?php
	/*
	Copyright (C) 2013  John F. Arroyave Gutiérrez
						unix4you2@gmail.com
						www.practico.org

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
	function PresentarEstadoMaquina($IDRegistroMonitor)
		{
			/*
				Function: PresentarEstadoMaquina
				Presenta una tabla formateada con el estado de una maquina en particular

				Ver tambien:

					<MaquinaOnline>
			*/
			global $ListaCamposSinID_monitoreo,$TablasCore;
			global $Imagen_fallo,$Imagen_ok;
			global $ErroresMonitoreoPractico; 			// Una variable global que inciada en cero, cambia su valor en esta funcion cuando hay errores
			global $ErroresMonitoreoAlertaAuditiva; 	// Una variable global que inciada en cero, cambia su valor en esta funcion cuando hay error en el monitor y este tiene activada la alerta sonora
			global $ErroresMonitoreoAlertaVibratoria; 	// Una variable global que inciada en cero, cambia su valor en esta funcion cuando hay error en el monitor y tiene habilitada la alerta vibratoria
			
			global $MULTILANG_MonTitulo,$PCO_FechaOperacionGuiones,$PCO_HoraOperacionPuntos;
			global $MULTILANG_MonLinea,$MULTILANG_MonCaido;
			
			//Busca los datos del monitor
			$Maquina=ejecutar_sql("SELECT id,".$ListaCamposSinID_monitoreo." FROM ".$TablasCore."monitoreo WHERE id='$IDRegistroMonitor' ")->fetch();
			
			//Verifica estado de la maquina y servicio
			$estado_actual=ServicioOnline($Maquina["host"],$Maquina["puerto"],$Maquina["tipo_ping"]);
			$estilo_caja_estado="panel-primary";
			$estilo_texto_estado="text-primary";

			if ($estado_actual)
				$estado_final="$Imagen_ok $MULTILANG_MonLinea";
			else
				{
					$estado_final="$Imagen_fallo $MULTILANG_MonCaido $Imagen_fallo";
					$estilo_caja_estado="panel-danger";
					$estilo_texto_estado="text-danger";
					
					$ErroresMonitoreoPractico=1;

					//Si tiene activada la alerta auditiva la agenda
					if ($Maquina["alerta_sonora"]==1)
						$ErroresMonitoreoAlertaAuditiva=1;
					//Si tiene activada la alerta vibratoria la agenda
					if ($Maquina["alerta_vibracion"]==1)
						$ErroresMonitoreoAlertaVibratoria=1;
				}

			//Actualiza el estado del monitor en caso de haber cambiado y envia alertas
			$EstadoMonitor=$MULTILANG_MonLinea;
			if ($ErroresMonitoreoPractico==1)	$EstadoMonitor=$MULTILANG_MonCaido;
			$EstadoAnteriorMonitor=$Maquina["ultimo_estado"];
			if ($EstadoAnteriorMonitor!=$EstadoMonitor)
				{
					//Envia mensaje de alerta de cambios por correo si el buzon ha sido indicado
					if ($Maquina["correo_alerta"]!="")
						PCO_EnviarCorreo("noreply@practico.org",$Maquina["correo_alerta"],$Maquina["nombre"]." $EstadoMonitor [$PCO_FechaOperacionGuiones $PCO_HoraOperacionPuntos] ",$Maquina["nombre"]." [".$Maquina["host"].":".$Maquina["puerto"]."] -> ".$Maquina["tipo_ping"]);
				
					//Actualiza el estado actual del monitor
					ejecutar_sql_unaria("UPDATE ".$TablasCore."monitoreo SET ultimo_estado='$EstadoMonitor' WHERE id='$IDRegistroMonitor' ");
				}
			
			//Determina si a la maquina o servicio es validado por socket
			$Separador_DosPuntos = "";
			if ($Maquina["tipo_ping"]=="socket")
				$Separador_DosPuntos = ":";

			//Determina icono a mostrar si esta inactiva la alerta sonora
			$IconoAlertaSonora='<i class="fa fa-volume-up text-success"></i>';
			if ($Maquina["alerta_sonora"]==0)
				$IconoAlertaSonora='';

			//Determina icono a mostrar si esta inactiva la alerta de vibracion
			$IconoAlertaVibracion='<i class="fa fa-mobile text-success"></i>';
			if ($Maquina["alerta_vibracion"]==0)
				$IconoAlertaVibracion='';

			echo '
				<!--<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">-->
				<div class="col-md-2 col-lg-2">
					<div class="panel '.$estilo_caja_estado.'">
						<div class="panel-heading">
							<div class="row">
								<!--<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">-->
								<div class="col-md-1 col-lg-1">
									<i class="fa fa-desktop fa-2x "></i>
								</div>
								<!--<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 text-right">-->
								<div class="col-md-10 col-lg-10 text-right">
									<div>'.$Maquina["nombre"].'<br>
									<font size=1>('.$Maquina["host"].$Separador_DosPuntos.$Maquina["puerto"].')</font> 
									</div>
								</div>
							</div>
						</div>
						<a href="#">
							<div class="panel-footer">
								<span class="pull-left '.$estilo_texto_estado.'" >
									<font><b>'.$estado_final.'</b></font>
								</span>
								<span class="pull-right">  '.$IconoAlertaSonora.'  '.$IconoAlertaVibracion.'  <i class="fa fa-bar-chart '.$estilo_texto_estado.'"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
			';
		}


/* ################################################################## */
/* ################################################################## */
	function PresentarSensorRango($IDRegistroMonitor)
		{
			/*
				Function: PresentarSensorRango
				Presenta un grafico con el estado numerico de un sensor, minimos y maximos
			*/
			global $ListaCamposSinID_monitoreo,$TablasCore;
			global $Imagen_fallo,$Imagen_ok;
			global $ErroresMonitoreoPractico; 			// Una variable global que inciada en cero, cambia su valor en esta funcion cuando hay errores
			global $ErroresMonitoreoAlertaAuditiva; 	// Una variable global que inciada en cero, cambia su valor en esta funcion cuando hay error en el monitor y este tiene activada la alerta sonora
			global $ErroresMonitoreoAlertaVibratoria; 	// Una variable global que inciada en cero, cambia su valor en esta funcion cuando hay error en el monitor y tiene habilitada la alerta vibratoria
			
			global $MULTILANG_MonTitulo,$PCO_FechaOperacionGuiones,$PCO_HoraOperacionPuntos;
			global $MULTILANG_MonLinea,$MULTILANG_MonCaido;
			global $MULTILANG_FrmValorMinimo,$MULTILANG_FrmValorMaximo;
			
			//Busca los datos del monitor
			$Sensor=ejecutar_sql("SELECT id,".$ListaCamposSinID_monitoreo." FROM ".$TablasCore."monitoreo WHERE id='$IDRegistroMonitor' ")->fetch();

            //Obtiene el valor de acuerdo al tipo de comando
            $Palabras = explode(' ',trim($Sensor["comando"]));
            if (strtoupper($Palabras[0])=="SELECT")
                {
                    //Si usa una conexion externa usa su configuracion
                    if($Sensor["conexion_origen_datos"]!="")
                        {
                            global ${$Sensor["conexion_origen_datos"]};
                            $registro_sensor=ejecutar_sql($Sensor["comando"],"",${$Sensor["conexion_origen_datos"]})->fetch();
                        }
                    else
                        $registro_sensor=ejecutar_sql($Sensor["comando"])->fetch();
        			$valor_sensor=trim($registro_sensor[0]);
                }
            else
                {
		        	$valor_sensor = trim(shell_exec($Sensor["comando"]));
                }

            //Evalua el valor encontrado para saber si esta en el rango deseado
            $SensorFueraRango=0;
            //Si los valores minimos y maximos son iguales entonces el sensor cambia a comparar por igualdad, dandole capacidad de evaluar valores fijos.
            if ($Sensor["valor_minimo"] == $Sensor["valor_maximo"])
                {
        			if ($valor_sensor != $Sensor["valor_minimo"])
        				{
        					$ErroresMonitoreoPractico=1;
        					$SensorFueraRango=1;
        					//Si tiene activada la alerta auditiva la agenda
        					if ($Sensor["alerta_sonora"]==1)
        						$ErroresMonitoreoAlertaAuditiva=1;
        					//Si tiene activada la alerta vibratoria la agenda
        					if ($Sensor["alerta_vibracion"]==1)
        						$ErroresMonitoreoAlertaVibratoria=1;
        				}
                }
            else
                {
        			if ($valor_sensor < $Sensor["valor_minimo"] || $valor_sensor > $Sensor["valor_maximo"] )
        				{
        					$ErroresMonitoreoPractico=1;
        					$SensorFueraRango=1;
        					//Si tiene activada la alerta auditiva la agenda
        					if ($Sensor["alerta_sonora"]==1)
        						$ErroresMonitoreoAlertaAuditiva=1;
        					//Si tiene activada la alerta vibratoria la agenda
        					if ($Sensor["alerta_vibracion"]==1)
        						$ErroresMonitoreoAlertaVibratoria=1;
        				}
                }

			//Actualiza el estado del monitor en caso de haber cambiado y envia alertas
			$EstadoMonitor=$MULTILANG_MonLinea;
			if ($SensorFueraRango==1)	$EstadoMonitor=$MULTILANG_MonCaido;
			$EstadoAnteriorMonitor=$Sensor["ultimo_estado"];
			if ($EstadoAnteriorMonitor!=$EstadoMonitor)
				{
					//Envia mensaje de alerta de cambios por correo si el buzon ha sido indicado
					if ($Sensor["correo_alerta"]!="")
						PCO_EnviarCorreo("noreply@practico.org",$Sensor["correo_alerta"],$Sensor["nombre"]." $EstadoMonitor [$PCO_FechaOperacionGuiones $PCO_HoraOperacionPuntos] ",$Sensor["nombre"]);
				
					//Actualiza el estado actual del monitor
					ejecutar_sql_unaria("UPDATE ".$TablasCore."monitoreo SET ultimo_estado='$EstadoMonitor' WHERE id='$IDRegistroMonitor' ");
				}

            //Define cadena de colores cuando el sensor esta fuera de rango
            $CadenaColores=""; //Asume color predeterminado
            if ($SensorFueraRango)
                $CadenaColores='colors: ["#FF1C00", "#D73B3E", "#B22222"]'; //Asume color predeterminado
			
			echo '
                <!--Agrega marco para el grafico de dona-->
				<div class="col-md-'.$Sensor["ancho"].' col-lg-'.$Sensor["ancho"].'">
                    <div id="grafico-sensor-'.$Sensor["id"].'"></div>
				</div>

                <script language="JavaScript">
                //Agrega la funcion para generar la dona con los datos
                $(function() {
                    grafico=Morris.Donut({
                        element: "grafico-sensor-'.$Sensor["id"].'",
                        data: [
                                                {
                                                    label: "Min",
                                                    value: "'.$Sensor["valor_minimo"].'"
                                                },
                                                {
                                                    label: "Max",
                                                    value: "'.$Sensor["valor_maximo"].'"
                                                },
                                                {
                                                    label: "'.$Sensor["nombre"].'",
                                                    value: "'.$valor_sensor.'"
                                                },
                        ],
                        resize: false,
                        labelColor: "#eeeeee",
                        backgroundColor: "#FFFFFF",
                        '.$CadenaColores.'
                    });
                    //Establece por defecto el item de grafico a mostrar
                    grafico.select(2);
                });
                </script>';
		}


/* ################################################################## */
/* ################################################################## */
	function PresentarEstadoSQL($IDRegistroMonitor,$color_fondo_estado_sql,$color_texto_estado_sql)
		{
			/*
				Function: PresentarEstadoSQL
				Ejecuta un query SQL y presenta el resultado formateado como tabla
			*/
			global $Imagen_generica_sql,$Tamano_iconos,$MULTILANG_MonCommSQL,$ListaCamposSinID_monitoreo,$TablasCore;

			//Busca los datos del monitor
			$ComandoSQL=ejecutar_sql("SELECT id,".$ListaCamposSinID_monitoreo." FROM ".$TablasCore."monitoreo WHERE id='$IDRegistroMonitor' ")->fetch();

            //Si usa una conexion externa usa su configuracion
            if($ComandoSQL["conexion_origen_datos"]!="")
                global ${$ComandoSQL["conexion_origen_datos"]};

			$SalidaFinalInforme='<table class="table table-responsive table-condensed btn-xs table-unbordered table-hover" style="font-family: Monospace, Sans-serif, Terminal, Tahoma;">';
			$estilo_caja_comandos="panel-warning";

			// Busca e Imprime encabezados de columna si no se tienen que ocultar
                if($ComandoSQL["conexion_origen_datos"]!="")
                    $resultado_columnas=ejecutar_sql($ComandoSQL["comando"],"",${$ComandoSQL["conexion_origen_datos"]});
                else
    			    $resultado_columnas=ejecutar_sql($ComandoSQL["comando"]);
				$numero_columnas=0;
				$SalidaFinalInforme.='<thead><tr>';
				foreach($resultado_columnas->fetch(PDO::FETCH_ASSOC) as $key=>$val)
					{
						if ($ComandoSQL["ocultar_titulos"]==0)
							{
								$SalidaFinalInforme.= '<th align="LEFT">'.ucwords(strtolower($key)).'</th>';
							}
						$numero_columnas++;
					}
				$SalidaFinalInforme.="</tr></thead>";

			//Ejecuta el query
            //Si usa una conexion externa usa su configuracion
            if($ComandoSQL["conexion_origen_datos"]!="")
                $consulta_ejecucion=ejecutar_sql($ComandoSQL["comando"],"",${$ComandoSQL["conexion_origen_datos"]});
            else
			    $consulta_ejecucion=ejecutar_sql($ComandoSQL["comando"]);
			
			//Presenta resultados
			while($registro_informe=$consulta_ejecucion->fetch())
				{
					$SalidaFinalInforme.= '<tr>';
					for ($i=0;$i<$numero_columnas;$i++)
						{
							$SalidaFinalInforme.= '<td style="font-family: Monospace, Sans-serif, Terminal, Tahoma; font-size: '.$ComandoSQL["tamano_resultado"].'px;">'.$registro_informe[$i].'</td>';
						}
					$SalidaFinalInforme.= '</tr>';
				}
			$SalidaFinalInforme.="</tr></table>";

			$icono_maquina=$Imagen_generica_sql;

			echo '
				<div class="col-lg-'.$ComandoSQL["ancho"].' col-md-'.$ComandoSQL["ancho"].'">
					<div class="panel '.$estilo_caja_comandos.'">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-1">
									<i class="fa fa-database fa-2x "></i>					
								</div>
								<div class="col-xs-10 text-right">
									<div>'.$ComandoSQL["nombre"].'<br>
									<font size=1>('.$MULTILANG_MonCommSQL.')</font>
									</div>
								</div>
							</div>
						</div>
						<div align=left class="panel-footer panel-info" style="color: black; margin-left:0px;">
								'.$SalidaFinalInforme.'
			 			</div>
					</div>
				</div>
			';


		}


/* ################################################################## */
/* ################################################################## */
	function PresentarTextoASCII($texto)
		{
			/*
				Function: PresentarTextoASCII
				Crea un cuadro de texto y presenta en él un resultado determinado
			*/
			global $color_fondo_ascii,$color_texto_ascii,$barras_texto_ascii;

			//Presenta la salida
			echo '<divs align="left" style="font-size:11px; font-family: Monospace, Sans-serif, Terminal, Tahoma;">'.str_replace(" ","&nbsp;",nl2br($texto)).'</divs>';

			//echo '<textarea cols="'.$ancho.'" rows="'.$alto.'" style="overflow: '.$barras_texto_ascii.'; margin-left:0; margin-right:0; margin-top:0; margin-bottom:0; font-size:11px; font-family: Monospace, Sans-serif, Tahoma; display: inline!important; border:0px;">'.$texto.'</textarea>';
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
			//echo '<img src="'.$ImagenRRD["Path"].'" width="'.$ImagenRRD["Ancho"].'" height="'.$ImagenRRD["Alto"].'" border=0>';
			$estilo_caja_imagenes="panel-info";

			$ImagenOrigen =$ImagenRRD["Path"];
			//verificamos si en la ruta nos han indicado el directorio en el que se encuentra. En ese caso elimina y deja solo el archivo
			if ( strpos($ImagenOrigen, '/') !== FALSE )
				$ImagenOrigen = preg_replace('/\.php$/', '' ,array_pop(explode('/', $ImagenOrigen)));

			echo '
				<div class="col-lg-'.$ImagenRRD["Ancho"].' col-md-'.$ImagenRRD["Ancho"].'">
					<div class="panel '.$estilo_caja_imagenes.'">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-1">
									<i class="fa fa-picture-o fa-2x"></i>					
								</div>
								<div class="col-xs-10 text-right">
									<div>'.$ImagenRRD["Nombre"].'<br>
									<font size=1>('.$ImagenOrigen.')</font>
									</div>
								</div>
							</div>
						</div>
						<div align=left class="" style="margin:0;">
								<img src="'.$ImagenRRD["Path"].'" width="100%" height="'.$ImagenRRD["Alto"].'" border=0>
			 			</div>
					</div>
				</div>
			';

		}
												

/* ################################################################## */
/* ################################################################## */
	function PresentarEmbebido($nombre,$path,$ancho,$alto)
		{
			/*
				Function: PresentarImagen
				Muestra una imagen en un path relativo a la ejecucion de la herramienta y de un tamano en pixeles determinado
			*/

			//Presenta la imagen
			//echo '<iframe src="'.$path.'" width="'.$ancho.'" height="'.$alto.'"></iframe>';
			$estilo_caja_imagenes="panel-success";
			
			echo '
				<div class="col-lg-'.$ancho.' col-md-'.$ancho.'">
					<div class="panel '.$estilo_caja_imagenes.'">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-1">
									<i class="fa fa-globe fa-1x"></i>					
								</div>
								<div class="col-xs-10 text-right">
									<div>'.$nombre.'<br>
									<!--<font size=1>('.$path.')</font>-->
									</div>
								</div>
							</div>
						</div>
						<div align=left class="" style="margin:0;">
								<iframe src="'.$path.'" border=0 width="100%" height="'.$alto.'"></iframe>
			 			</div>
					</div>
				</div>
			';
		}



/* ################################################################## */
/* ################################################################## */
	function EjecutarComando($comando_ejecutar)
		{
			/*
				Function: EjecutarComando
				Ejecuta comandos autorizados en el servidor para mostrar su respuesta
			*/
			global $Imagen_generica_shell,$Tamano_iconos,$color_fondo_ascii, $MULTILANG_MonCommShell;
			
			//Ejecuta el comando
			$salida_comando = shell_exec($comando_ejecutar["Comando"]);
			//Presenta la salida
			$icono_maquina=$Imagen_generica_shell;
			$estilo_caja_comandos="panel-success";

			echo '
				<div class="col-lg-'.$comando_ejecutar["Ancho"].' col-md-'.$comando_ejecutar["Ancho"].'">
					<div class="panel '.$estilo_caja_comandos.'">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-1">
									<i class="fa fa-terminal fa-2x "></i>					
								</div>
								<div class="col-xs-10 text-right">
									<div>'.$comando_ejecutar["Nombre"].'<br>
									<font size=1>('.$MULTILANG_MonCommShell.')</font>
									</div>
								</div>
							</div>
						</div>
						<div align=left class="panel-footer panel-info" style="color: black; margin-left:0px;">';
								PresentarTextoASCII($salida_comando);
			echo ' 		</div>
						
					</div>
				</div>
			';
		}


/* ################################################################## */
/* ################################################################## */
	function PresentarEtiqueta($texto_etiqueta,$ancho_etiqueta)
		{
			/*
				Function: PresentarEtiqueta
				Muestra un texto en pantalla
			*/
			//Presenta la salida
			echo '
				<div class="col-lg-'.$ancho_etiqueta.' col-md-'.$ancho_etiqueta.'">
							<div class="alert alert-inverse alert-sm" style="top-margin:0px;">
								<b>'.$texto_etiqueta.'</b>
			 			</div>
				</div>
			';
		}

/* ################################################################## */
/* ################################################################## */
if ($PCO_Accion=="eliminar_monitoreo")
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
						<input type="Hidden" name="PCO_Accion" value="administrar_monitoreo">
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
				Insetar registro en tabla de monitoreo
				Llevar auditoria
			(end)

			Salida:
				Entradas en la tabla de monitoreo actualizadas

			Ver tambien:
			<administrar_monitoreo>
		*/
	if ($PCO_Accion=="guardar_monitoreo")
		{
			$mensaje_error="";
			// Verifica campos nulos
			if ($nombre=="")
				$mensaje_error.=$MULTILANG_MonErr."<br>";

			if ($mensaje_error=="")
				{
					// Guarda los datos del comando de monitoreo
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."monitoreo (".$ListaCamposSinID_monitoreo.") VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)","$tipo$_SeparadorCampos_$pagina$_SeparadorCampos_$peso$_SeparadorCampos_$nombre$_SeparadorCampos_$host$_SeparadorCampos_$puerto$_SeparadorCampos_$tipo_ping$_SeparadorCampos_$saltos$_SeparadorCampos_$comando$_SeparadorCampos_$ancho$_SeparadorCampos_$alto$_SeparadorCampos_$tamano_resultado$_SeparadorCampos_$ocultar_titulos$_SeparadorCampos_$path$_SeparadorCampos_$correo_alerta$_SeparadorCampos_$alerta_sonora$_SeparadorCampos_$milisegundos_lectura$_SeparadorCampos_$alerta_vibracion$_SeparadorCampos_$ultimo_estado$_SeparadorCampos_$valor_minimo$_SeparadorCampos_$valor_maximo$_SeparadorCampos_$conexion_origen_datos");
					auditar("Agrega en monitor: $nombre");
					echo '
					<form name="continuar_admin_mon" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="administrar_monitoreo">
					</form>
					<script type="" language="JavaScript"> 
					alert("'.$MULTILANG_Aplicando.'");
					document.continuar_admin_mon.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="administrar_monitoreo">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
		/*
			Function: actualizar_monitoreo
			Actualiza los datos de un monitor definido por el usuario

			Salida:
				Entradas en la tabla de monitoreo actualizadas

			Ver tambien:
			<administrar_monitoreo>
		*/
	if ($PCO_Accion=="actualizar_monitoreo")
		{
			$mensaje_error="";
			// Verifica campos nulos
			if ($nombre=="")
				$mensaje_error.=$MULTILANG_MonErr."<br>";

			if ($mensaje_error=="")
				{
					// Actualiza los datos del comando de monitoreo
					ejecutar_sql_unaria("UPDATE ".$TablasCore."monitoreo SET tipo='$tipo',pagina='$pagina',peso='$peso',nombre='$nombre',host='$host',puerto='$puerto',tipo_ping='$tipo_ping',saltos='$saltos',comando='$comando',ancho='$ancho',alto='$alto',tamano_resultado='$tamano_resultado',ocultar_titulos='$ocultar_titulos',path='$path',correo_alerta='$correo_alerta',alerta_sonora='$alerta_sonora',milisegundos_lectura='$milisegundos_lectura',alerta_vibracion='$alerta_vibracion', conexion_origen_datos='$conexion_origen_datos', valor_minimo='$valor_minimo',valor_maximo='$valor_maximo' WHERE id='$IDRegistroMonitor'");
					
					auditar("Actualiza el monitor: $IDRegistroMonitor");
					echo '
					<form name="continuar_admin_mon" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="administrar_monitoreo">
					</form>
					<script type="" language="JavaScript"> 
					alert("'.$MULTILANG_Aplicando.'");
					document.continuar_admin_mon.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="administrar_monitoreo">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
		/*
			Function: formato_monitor
			Presenta el formato utilizado para agregar monitores
		*/
	function FormatoMonitor($IDRegistroMonitor)
		{
			global $ArchivoCORE,$ListaCamposSinID_monitoreo,$TablasCore,$MULTILANG_MonNuevo,$MULTILANG_Tipo,$MULTILANG_Etiqueta,$MULTILANG_Maquina,$MULTILANG_MonCommShell,$MULTILANG_MonCommSQL,$MULTILANG_Imagen,$MULTILANG_Embebido;
			global $TablasCore,$ListaCamposSinID_replicasbd,$MULTILANG_ConnOrigenDatosDes,$MULTILANG_ConnAdvCambioOrigen,$MULTILANG_ConnPredeterminada,$MULTILANG_ConnOrigenDatos,$MULTILANG_Comando,$MULTILANG_MonSensorRango,$MULTILANG_FrmValorMinimo,$MULTILANG_FrmValorMaximo,$MULTILANG_Actualizar,$MULTILANG_Regresar,$MULTILANG_MnuURL,$MULTILANG_InfAlto,$MULTILANG_Ayuda,$MULTILANG_MonDesTipo,$MULTILANG_Pagina,$MULTILANG_Peso,$MULTILANG_Nombre,$MULTILANG_MonSaltos,$MULTILANG_MonMsLectura,$MULTILANG_Agregar,$MULTILANG_IrEscritorio,$MULTILANG_Maquina,$MULTILANG_AplicaPara,$MULTILANG_Tipo,$MULTILANG_Puerto,$MULTILANG_MonMetodo,$MULTILANG_MonCommSQL,$MULTILANG_MonCommShell,$MULTILANG_FrmAncho,$MULTILANG_Imagen,$MULTILANG_Embebido,$MULTILANG_MonTamano,$MULTILANG_Etiqueta,$MULTILANG_MonOcultaTit,$MULTILANG_No,$MULTILANG_Si,$MULTILANG_MonCorreoAlerta,$MULTILANG_MonAlertaSnd,$MULTILANG_MonAlertaVibrar;
			
			//Busca los datos del monitor
			if ($IDRegistroMonitor!="")
				$Maquina=ejecutar_sql("SELECT id,".$ListaCamposSinID_monitoreo." FROM ".$TablasCore."monitoreo WHERE id='$IDRegistroMonitor' ")->fetch();

			//Define la accion a ejecutar
			if ($IDRegistroMonitor=="")
				{
					$AccionFormulario="guardar_monitoreo";
					$TextoBotonFormulario=$MULTILANG_Agregar;
					$TextoBotonCancelar=$MULTILANG_IrEscritorio;
				}
			else
				{
					$AccionFormulario="actualizar_monitoreo";
					$TextoBotonFormulario=$MULTILANG_Actualizar;
					$TextoBotonCancelar=$MULTILANG_Regresar;
				}

			echo '
        <form name="datos" action="'.$ArchivoCORE.'" method="POST">

            <input type="hidden" name="PCO_Accion" value="'.$AccionFormulario.'">
            <input type="hidden" name="IDRegistroMonitor" value="'.$IDRegistroMonitor.'">
            
            <div class="row">
                <div class="col-md-6">
                    <h4><b><i class="fa fa-link fa-fw icon-orange"></i>'.$MULTILANG_MonNuevo.':</b></h4>

                    <label for="tipo">'.$MULTILANG_Tipo.':</label>
                    <div class="form-group input-group">
                        <select id="tipo" name="tipo" class="form-control" >';
					//Define los estados de seleccion para las listas
					if (@$Maquina["tipo"]=="Etiqueta") 		$Seleccion_Etiqueta="SELECTED";
					if (@$Maquina["tipo"]=="Maquina") 		$Seleccion_Maquina="SELECTED";
					if (@$Maquina["tipo"]=="ComandoShell") 	$Seleccion_ComandoShell="SELECTED";
					if (@$Maquina["tipo"]=="ComandoSQL")	$Seleccion_ComandoSQL="SELECTED";
					if (@$Maquina["tipo"]=="Imagen") 		$Seleccion_Imagen="SELECTED";
					if (@$Maquina["tipo"]=="Embebido") 		$Seleccion_Embebido="SELECTED";
					if (@$Maquina["tipo"]=="SensorRango") 	$Seleccion_SensorRango="SELECTED";


             echo '
                            <option value="Etiqueta"		'.$Seleccion_Etiqueta.'>'.$MULTILANG_Etiqueta.'</option>
                            <option value="Maquina"			'.$Seleccion_Maquina.'>'.$MULTILANG_Maquina.'</option>
                            <option value="ComandoShell"	'.$Seleccion_ComandoShell.'>'.$MULTILANG_MonCommShell.'</option>
                            <option value="ComandoSQL"		'.$Seleccion_ComandoSQL.'>'.$MULTILANG_MonCommSQL.'</option>
                            <option value="Imagen"			'.$Seleccion_Imagen.'>'.$MULTILANG_Imagen.'</option>
                            <option value="Embebido"		'.$Seleccion_Embebido.'>'.$MULTILANG_Embebido.'</option>
                            <option value="SensorRango"		'.$Seleccion_SensorRango.'>'.$MULTILANG_MonSensorRango.'</option>

                        </select>
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<b>'.$MULTILANG_Ayuda.'</b><br>'.$MULTILANG_MonDesTipo.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                    </div>

                    <label for="tipo">'.$MULTILANG_Pagina.':</label>
                    <div class="form-group input-group">
                        <select id="pagina" name="pagina" class="form-control" >';

                                    for ($i=1;$i<=20;$i++)
                                        {
                                                $EstadoSeleccion='';
                                                if (@$Maquina["pagina"]==$i) $EstadoSeleccion="SELECTED";
                                                echo '<option value="'.$i.'" '.$EstadoSeleccion.'>'.$i.'</option>';
                                        }
             echo '
                        </select>

                    </div>

                    <label for="peso">'.$MULTILANG_Peso.':</label>
                    <div class="form-group input-group">
                        <select id="peso" name="peso" class="form-control" >';

                                    for ($i=1;$i<=50;$i++)
                                        {
                                                $EstadoSeleccion='';
                                                if (@$Maquina["peso"]==$i) $EstadoSeleccion="SELECTED";
                                                echo '<option value="'.$i.'" '.$EstadoSeleccion.'>'.$i.'</option>';
                                        }
            echo '
                        </select>
                    </div>

                    <input type="text" name="nombre" value="'.@$Maquina["nombre"].'"class="form-control" placeholder="'.$MULTILANG_Nombre.'">

                    <label for="saltos">'.$MULTILANG_MonSaltos.':</label>
                    <div class="form-group input-group">
                        <select id="saltos" name="saltos" class="form-control" >';

                                    for ($i=0;$i<=15;$i++)
                                        {
                                                $EstadoSeleccion='';
                                                if (@$Maquina["saltos"]==$i) $EstadoSeleccion="SELECTED";
                                                echo '<option value="'.$i.'" '.$EstadoSeleccion.'>'.$i.'</option>';
                                        }
			echo '
                        </select>
                    </div>

                    <div class="form-group input-group">
                        <span class="input-group-addon">
                            '.$MULTILANG_MonMsLectura.'
                        </span>';
				$MilisengundosMonitor=1000;
				if (@$Maquina["milisegundos_lectura"]!="") $MilisengundosMonitor=@$Maquina["milisegundos_lectura"];
            echo '            
                        <input type="text" name="milisegundos_lectura" value="'.$MilisengundosMonitor.'" class="form-control" placeholder="'.$MULTILANG_MonMsLectura.'">
                    </div>

                    <a class="btn btn-success btn-block" href="javascript:document.datos.submit();"><i class="fa fa-save"></i> '.$TextoBotonFormulario.'</a>
                    <a class="btn btn-default btn-block" href="javascript:document.core_ver_menu.submit();"><i class="fa fa-home"></i> '.$TextoBotonCancelar.'</a>

                </div>
                <div class="col-md-6">

                    <div class="form-group input-group">
                        <input type="text" name="host" value="'.@$Maquina["host"].'" class="form-control" placeholder="'.$MULTILANG_Maquina.' / IP">
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_AplicaPara.' '.$MULTILANG_Tipo.': '.$MULTILANG_Maquina.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                        <input type="text" name="puerto"  value="'.@$Maquina["puerto"].'" class="form-control" placeholder="'.$MULTILANG_Puerto.'">
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_AplicaPara.' '.$MULTILANG_Tipo.': '.$MULTILANG_Maquina.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                    </div>

                    <label for="tipo_ping">'.$MULTILANG_MonMetodo.':</label>
                    <div class="form-group input-group">
                        <select id="tipo_ping" name="tipo_ping" class="form-control" >';
					//Define los estados de seleccion para las listas
					if (@$Maquina["tipo_ping"]=="socket") 		$Seleccion_socket="SELECTED";
					if (@$Maquina["tipo_ping"]=="ping") 		$Seleccion_ping="SELECTED";
            echo '
                            <option value="socket"	'.$Seleccion_socket.'>Socket</option>
                            <option value="ping"  '.$Seleccion_ping.'>Ping</option>
                        </select>
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_AplicaPara.' '.$MULTILANG_Tipo.': '.$MULTILANG_Maquina.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                    </div>

                    <div class="form-group input-group">
                        <textarea name="comando" class="form-control" placeholder="'.$MULTILANG_Comando.'">'.@$Maquina["comando"].'</textarea>
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_AplicaPara.' '.$MULTILANG_Tipo.': '.$MULTILANG_MonCommShell.', '.$MULTILANG_MonCommSQL.', '.$MULTILANG_MonSensorRango.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                    </div>

                    <label for="conexion_origen_datos">'.$MULTILANG_ConnOrigenDatos.':</label>
                    <div class="form-group input-group">
                        <select id="conexion_origen_datos" name="conexion_origen_datos" class="form-control" >
        					<option value="">'.$MULTILANG_ConnPredeterminada.'</option>';
        						$consulta_conexiones=ejecutar_sql("SELECT id,".$ListaCamposSinID_replicasbd." FROM ".$TablasCore."replicasbd WHERE tipo_replica=0 ORDER BY nombre");
        						while($registro_conexiones = $consulta_conexiones->fetch())
        						    {
        						        $seleccion_campo="";
        								if (@$Maquina["conexion_origen_datos"]==$registro_conexiones["nombre"])
        									$seleccion_campo="SELECTED";
        							    echo '<option value="'.$registro_conexiones["nombre"].'" '.$seleccion_campo.' >(Id.'.$registro_conexiones["id"].') '.$registro_conexiones["nombre"].' (Host:'.$registro_conexiones["servidorbd"].' BD:'.$registro_conexiones["basedatos"].')</option>';
        						    }
                    echo '
                        </select>
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_ConnOrigenDatosDes.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_AplicaPara.' '.$MULTILANG_Tipo.': '.$MULTILANG_MonCommSQL.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                    </div>

					<label for="ancho">'.$MULTILANG_FrmAncho.':</label>
					<div class="form-group input-group">
						<select id="ancho" name="ancho" class="form-control" >';

									for ($i=1;$i<=12;$i++)
										{
                                                $EstadoSeleccion='';
                                                if (@$Maquina["ancho"]==$i) $EstadoSeleccion="SELECTED";
												echo '<option value="'.$i.'" '.$EstadoSeleccion.'>'.$i.'</option>';
										}
			echo '
						</select>
						<span class="input-group-addon">
							<a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_AplicaPara.' '.$MULTILANG_Tipo.': '.$MULTILANG_MonCommShell.', '.$MULTILANG_Imagen.', '.$MULTILANG_Embebido.', '.$MULTILANG_MonSensorRango.' "><i class="fa fa-question-circle fa-fw text-info"></i></a>
						</span>
					</div>
						
                    <div class="form-group input-group">
                        <input type="text" name="alto" value="'.@$Maquina["alto"].'" class="form-control" placeholder="'.$MULTILANG_InfAlto.'">
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_AplicaPara.' '.$MULTILANG_Tipo.': '.$MULTILANG_MonCommShell.', '.$MULTILANG_Imagen.', '.$MULTILANG_Embebido.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                    </div>

                    <label for="tamano_resultado">'.$MULTILANG_MonTamano.':</label>
                    <div class="form-group input-group">
                        <select id="tamano_resultado" name="tamano_resultado" class="form-control" >';

                                    for ($i=5;$i<=100;$i++)
                                        {
                                                $EstadoSeleccion='';
                                                if (@$Maquina["tamano_resultado"]==$i) $EstadoSeleccion="SELECTED";
                                                echo '<option value="'.$i.'" '.$EstadoSeleccion.'>'.$i.'</option>';
                                        }
			echo '
                        </select>
                        <span class="input-group-addon">
                            pixeles
                        </span>
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_AplicaPara.' '.$MULTILANG_Tipo.': '.$MULTILANG_MonCommSQL.', '.$MULTILANG_Etiqueta.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                    </div>

                    <label for="ocultar_titulos">'.$MULTILANG_MonOcultaTit.':</label>
                    <div class="form-group input-group">
                        <select id="ocultar_titulos" name="ocultar_titulos" class="form-control" >';
					//Define los estados de seleccion para las listas
					if (@$Maquina["ocultar_titulos"]=="0") 		$Seleccion_No="SELECTED";
					if (@$Maquina["ocultar_titulos"]=="1") 		$Seleccion_Si="SELECTED";
            echo '
                            <option value="0" '.$Seleccion_No.'>'.$MULTILANG_No.'</option>
                            <option value="1" '.$Seleccion_Si.'>'.$MULTILANG_Si.'</option>
                        </select>
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_AplicaPara.' '.$MULTILANG_Tipo.': '.$MULTILANG_MonCommSQL.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                    </div>

                    <div class="form-group input-group">
                        <input type="text" name="path"  value="'.@$Maquina["path"].'" class="form-control" placeholder="'.$MULTILANG_MnuURL.'">
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_AplicaPara.' '.$MULTILANG_Tipo.': '.$MULTILANG_Imagen.', '.$MULTILANG_Embebido.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                    </div>

                    <div class="form-group input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-at fa-fw"></i>
                        </span>
                        <input type="text" name="correo_alerta" value="'.@$Maquina["correo_alerta"].'" class="form-control" placeholder="'.$MULTILANG_MonCorreoAlerta.'">
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_AplicaPara.' '.$MULTILANG_Tipo.': '.$MULTILANG_Maquina.', '.$MULTILANG_MonSensorRango.'  "><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                    </div>

                    <label for="alerta_sonora">'.$MULTILANG_MonAlertaSnd.':</label>
                    <div class="form-group input-group">
                        <select id="alerta_sonora" name="alerta_sonora" class="form-control" >';
					//Define los estados de seleccion para las listas
					if (@$Maquina["alerta_sonora"]=="0") 		$Seleccion_NoAS="SELECTED";
					if (@$Maquina["alerta_sonora"]=="1") 		$Seleccion_SiAS="SELECTED";
            echo '
                            <option value="0" '.$Seleccion_NoAS.'>'.$MULTILANG_No.'</option>
                            <option value="1" '.$Seleccion_SiAS.'>'.$MULTILANG_Si.'</option>
                        </select>
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_AplicaPara.' '.$MULTILANG_Tipo.': '.$MULTILANG_Maquina.', '.$MULTILANG_MonSensorRango.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                    </div>

                    <label for="alerta_vibracion">'.$MULTILANG_MonAlertaVibrar.':</label>
                    <div class="form-group input-group">
                        <select id="alerta_vibracion" name="alerta_vibracion" class="form-control" >';
					//Define los estados de seleccion para las listas
					if (@$Maquina["alerta_vibracion"]=="0") 		$Seleccion_NoAV="SELECTED";
					if (@$Maquina["alerta_vibracion"]=="1") 		$Seleccion_SiAV="SELECTED";
			echo '
                            <option value="0" '.$Seleccion_NoAV.'>'.$MULTILANG_No.'</option>
                            <option value="1" '.$Seleccion_SiAV.'>'.$MULTILANG_Si.'</option>
                        </select>
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_AplicaPara.' '.$MULTILANG_Tipo.': '.$MULTILANG_Maquina.', '.$MULTILANG_MonSensorRango.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                    </div>

                    <div class="form-group input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-thermometer-empty fa-fw"></i>
                        </span>
                        <input type="text" name="valor_minimo" value="'.@$Maquina["valor_minimo"].'" class="form-control" placeholder="'.$MULTILANG_FrmValorMinimo.'">
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_AplicaPara.' '.$MULTILANG_Tipo.': '.$MULTILANG_MonSensorRango.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                    </div>

                    <div class="form-group input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-thermometer-full fa-fw"></i>
                        </span>
                        <input type="text" name="valor_maximo" value="'.@$Maquina["valor_maximo"].'" class="form-control" placeholder="'.$MULTILANG_FrmValorMaximo.'">
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_AplicaPara.' '.$MULTILANG_Tipo.': '.$MULTILANG_MonSensorRango.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                    </div>

                </div>
            </div>

        </form>';

		}


/* ################################################################## */
/* ################################################################## */
		/*
			Function: detalles_monitoreo
			Presenta formulario para editar un monitor

			Ver tambien:
			<guardar_monitoreo>
		*/
if ($PCO_Accion=="detalles_monitoreo")
	{
		abrir_ventana($MULTILANG_MonConfig,'panel-primary');
		FormatoMonitor($IDRegistroMonitor);
        cerrar_ventana();
    } //Fin detalles_monitoreo


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
if ($PCO_Accion=="administrar_monitoreo")
	{
		$PCO_Accion=escapar_contenido($PCO_Accion); //Limpia cadena para evitar XSS
		abrir_ventana($MULTILANG_MonConfig,'panel-primary');
		
		FormatoMonitor();
		
?>

		<br><br>
		<a class="btn btn-warning btn-block" href="index.php?PCO_Accion=ver_monitoreo&Presentar_FullScreen=1" target="_BLANK"><i class="fa fa-globe"></i> <?php echo " $MULTILANG_MonPgInicio -> $MULTILANG_MonTitulo ";?></a>


        <hr>
		<h4><b><i class="glyphicon glyphicon-bullhorn"></i> <?php echo $MULTILANG_MonDefinidos; ?></b></h4>
		 <?php
				echo '
				<table class="table table-unbordered table-condensed table-hover btn-xs">
					<thead>
                    <tr>
						<th><b>'.$MULTILANG_Pagina.'</b></th>
						<th><b>'.$MULTILANG_Peso.'</b></th>
						<th><b>'.$MULTILANG_Tipo.'</b></th>
						<th><b>'.$MULTILANG_Nombre.'</b></th>
						<th><b>'.$MULTILANG_MonMsLectura.'</b></th>
						<th></th>
						<th></th>
					</tr>
                    </thead>
                    <tbody>';

				$resultado=ejecutar_sql("SELECT id,".$ListaCamposSinID_monitoreo." FROM ".$TablasCore."monitoreo WHERE 1=1 ORDER BY pagina,peso ");
				while($registro = $resultado->fetch())
					{
						echo '<tr>
								<td>'.$registro["pagina"].'</td>
								<td>'.$registro["peso"].'</td>
								<td>'.$registro["tipo"].'</td>
								<td>'.$registro["nombre"].'</td>
								<td>'.$registro["milisegundos_lectura"].'</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST" name="f'.$registro["id"].'" id="f'.$registro["id"].'">
												<input type="hidden" name="PCO_Accion" value="eliminar_monitoreo">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="button" value="'.$MULTILANG_Eliminar.'" class="btn btn-danger btn-xs" onClick="confirmar_evento(\''.$MULTILANG_MnuAdvElimina.'\',f'.$registro["id"].');">
										</form>
								</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST">
												<input type="hidden" name="PCO_Accion" value="detalles_monitoreo">
												<input type="hidden" name="IDRegistroMonitor" value="'.$registro["id"].'">
												<input type="submit" value="'.$MULTILANG_Detalles.'" class="btn btn-info btn-xs">
										</form>
								</td>
							</tr>';
					}
				echo '
                </tbody>
                </table>';

        cerrar_ventana();
        $VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
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
if ($PCO_Accion=="ver_monitoreo")
	{
    // Incluye encabezados, estilos y demas del HEAD
    include_once("core/configuracion.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
<head>
	<title>Monitor</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="generator" content="Practico Framework PHP" />
 	<meta name="description" content="Generador de aplicaciones web" />
    <meta name="author" content="John Arroyave G. - {www.practico.org} - {unix4you2 at gmail.com}">

    <!-- CSS Core de Bootstrap -->
    <link href="inc/bootstrap/css/tema_bootstrap.min.css" rel="stylesheet"  media="screen">
    <link href="inc/bootstrap/css/bootstrap-theme.css" rel="stylesheet"  media="screen">

	<!-- Estilos especificos Monitoreo -->
    <link href="inc/bootstrap/css/monitoreo.min.css" rel="stylesheet"  media="screen">
    
    <!-- Custom Fonts -->
    <link href="inc/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- Estilos selector de color -->
    <link href="inc/bootstrap/css/plugins/select/bootstrap-select.min.css" rel="stylesheet">

    <!-- jQuery -->
	<script type="text/javascript" src="inc/jquery/jquery-2.1.0.min.js"></script>
</head>

		<body oncontextmenu="return false;" style="font-family: Verdana, Tahoma, Arial; font-size: 11px;">


		
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
			
			//Si esta encendido el itinerador entonces la pagina siguiente sera la misma pagina siempre
			if($PaginaRecuerrente!="") $SiguientePagina=$PaginaMonitoreo;
			
			//Busca cuantos milisegundos esperar segun la pagina definida y sus elementos
			$resultado=ejecutar_sql("SELECT SUM(milisegundos_lectura) as total_espera FROM ".$TablasCore."monitoreo WHERE pagina='$PaginaMonitoreo' ");
			$registro = $resultado->fetch();
			$MilisegundosPagina=$registro["total_espera"]+1;			
		?>

        <form name="formulario_monitoreo" action="index.php" style="visibility: hidden; display: none;">
            <input type="hidden" name="PCO_Accion" value="ver_monitoreo">
            <input type="hidden" name="Presentar_FullScreen" value="1">
            <input type="hidden" name="Pagina" value="<?php echo $SiguientePagina; ?>">
            <input type="hidden" name="PaginaRecuerrente" value="<?php if($PaginaRecuerrente!="") echo $PaginaMonitoreo; ?>">
        </form>

		<script language="JavaScript">
			var EstadoPausa=0;
			var ValorCronometro=<?php echo round($MilisegundosPagina/1000); ?>;
			function actualizar()
				{
					if (EstadoPausa==0)
					    document.formulario_monitoreo.submit();
						//document.location="index.php?PCO_Accion=ver_monitoreo&Presentar_FullScreen=1&Pagina=<?php echo $SiguientePagina; ?>";
				}
			window.setTimeout("actualizar()",<?php echo $MilisegundosPagina; ?>);

			//Actualiza el cronometro en la parte superior
			function actualizar_reloj()
				{
					$("#MarcoCronometro").html(ValorCronometro+"s");
					//MarcoCronometro
						window.setTimeout("actualizar_reloj()",1000);
					if (EstadoPausa==0)
						ValorCronometro--;	
				}
			actualizar_reloj()
		</script>



	<!-- ################# INICIO DE LA MAQUETACION ################ -->
		<?php include_once ("core/monitoreo_superior.php"); 	?>
		<DIV class="row">
			<div class="col-md-12" style="margin:0px;">

				<!-- INICIA LA TABLA PRINCIPAL -->
				<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="color:white;">
					<tr>
						<td align="right">
							<!-- NOTA COPYRIGHT	 -->
							<font color="#CACACA" size=1><i><?php echo $MULTILANG_MonAcerca; ?></i>&nbsp;&nbsp;<br><br></font>
						</td>
					</tr>
					<tr>
						<td width="100%" height="100%" valign="TOP" align="center">

							<?php
								$ErroresMonitoreoPractico=0;
								$ErroresMonitoreoAlertaAuditiva=0;
								$ErroresMonitoreoAlertaVibratoria=0;

								//Path imagenes e iconos y sus propiedades
								$Imagen_fallo='<i class="fa fa-exclamation-triangle icon-orange"></i>';
								$Imagen_ok='<i class="fa fa-check-circle icon-green"></i>';
								$Imagen_generica='<i class="fa fa-certificate"></i>';
								$Tamano_iconos=" width=20 heigth=20 ";
								$Imagen_generica_sql='<i class="fa fa-database"></i>';
								$Imagen_generica_shell='<i class="fa fa-terminal"></i>';
								$Sonido_alarma="inc/practico/sonidos/alarma.mp3";

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
												PresentarEtiqueta($registro["nombre"],$registro["ancho"]);
											}
										//Evalua elementos tipo Maquina o host
										if ($registro["tipo"]=="Maquina")
											{
												PresentarEstadoMaquina($registro["id"]);
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
												PresentarEstadoSQL($registro["id"],$color_fondo_estado_sql,$color_texto_estado_sql);
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
												PresentarEmbebido($registro["nombre"],$registro["path"],$registro["ancho"],$registro["alto"]);
											}
										//Evalua elementos tipo SensorRango
										if ($registro["tipo"]=="SensorRango")
											{
												PresentarSensorRango($registro["id"]);
											}
										//Agrega los saltos de linea
										for ($i=0;$i<$registro["saltos"];$i++) echo "<br>";
									}

								// Si encuentra algun error en el monitoreo reproduce la alarma
								if ($ErroresMonitoreoPractico)
									{
										//Si alguno de los monitores con error tenia activada la alerta auditiva
										if ($ErroresMonitoreoAlertaAuditiva==1)
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

										//Si alguno de los monitores con error tenia activada la alerta auditiva
										if ($ErroresMonitoreoAlertaVibratoria==1)
											{
												echo '
													<script>
														navigator.vibrate = navigator.vibrate || navigator.webkitVibrate || navigator.mozVibrate || navigator.msVibrate;
														if (navigator.vibrate) {
														navigator.vibrate([100, 50, 100, 50, 100, 250]);
														//Vibra,Pausa,Vibra...
														}
													</script>';
											}
									}

							?>

				<!-- FINALIZA LA TABLA PRINCIPAL -->
				</td></tr></table>

			</div>
		</DIV>
	<!-- ################## FIN DE LA MAQUETACION ################## -->


    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="inc/bootstrap/js/bootstrap.min.js"></script>
    <!-- Plugins JQuery -->
    <script type="text/javascript" src="inc/bootstrap/js/plugins/select/bootstrap-select.min.js"></script>

    <script src="inc/bootstrap/js/plugins/morris/raphael.min.js"></script>
    <script src="inc/bootstrap/js/plugins/morris/morris.min.js"></script>

	<script language="JavaScript">
		function RecargarToolTipsEnlaces()
			{
				//Carga los tooltips programados en la hoja.  Por defecto todos los elementos con data-toggle=tootip
				$(function () {
				  $('[data-toggle="tooltip"]').tooltip();
				})
			}
		RecargarToolTipsEnlaces();
	</script>

	<script language="JavaScript">
		//Carga los popovers programados en la hoja.  Por defecto todos los elementos con data-toggle=popover
		$(function () {
		  $('[data-toggle="popover"]').popover()
		});
	</script>

		<?php
			// Estadisticas de uso anonimo con GABeacon
			$PrefijoGA='<img src="https://rastreador-visitas.appspot.com/';
			$PosfijoGA='/Practico/'.$PCO_Accion.'?pixel" border=0 ALT=""/>';
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