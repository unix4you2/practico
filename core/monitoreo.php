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


/* ################################################################## */
/* ################################################################## */
/*
	Function: MedirVelocidad
	Mide la velocidad de descarga desde el servidor actual hacia otra maquina
*/
function MedirVelocidad($url_medidor="http://localhost/cargar_bytes.php",$unidad_medida="KB")
	{
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
/*
	Function: GetPing
	Determina si una maquina se encuentra o no encendida y respondiendo mediante el uso del comando ping

	Variables de entrada:

		ip - Direccion de la maquina, router, host o dispositivo que debe responder a la senal de ping

	Ver tambien:
		<ServicioOnline> | <PresentarEstadoMaquina>
*/
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
				$expandidos_inicial=explode("=", $exec ); //1
				$puntero_final = end($expandidos_inicial);
				$array = explode("/", $puntero_final );
				return ceil($array[1]) . 'ms';
			}
	}
	
		
/* ################################################################## */
/* ################################################################## */
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
					return 0; //echo 'Tiempo agotado';
				else
					if (GetPing($maquina) == '0ms')
						return 0; //echo 'servidor apagado';
					else
						return 1; //echo 'servidor con conectividad';
			}				
        //Lo monitores tipo curl:XX tienen dos puntos en el medio, los usa para identificarlos
		if( strpos ( $tipo_monitor , ":" ))
			{
			    $TimeOut=explode(":",$tipo_monitor);
			    $TimeOut=$TimeOut[1];
			    //Inicia la conexion cURL al host
                $ConexioncURL = curl_init($maquina);
                curl_setopt($ConexioncURL,CURLOPT_CONNECTTIMEOUT,$TimeOut);
                curl_setopt($ConexioncURL,CURLOPT_TIMEOUT,$TimeOut);
                curl_setopt($ConexioncURL,CURLOPT_HEADER,true);
                curl_setopt($ConexioncURL,CURLOPT_NOBODY,true);
                curl_setopt($ConexioncURL,CURLOPT_RETURNTRANSFER,true);
                $RespuestacURL = curl_exec($ConexioncURL);
                curl_close($ConexioncURL);
                if ($RespuestacURL) return 1;
                return 0;
			}	
		if($tipo_monitor=="headers")
			{
		        //$maquina deberia ser una URL completa ej http://www.google.com
                $ChequeoCabeceras = get_headers($maquina);
                $CodigoRespuestaHTTP = $ChequeoCabeceras[0];
                return $CodigoRespuestaHTTP; //Devuelve el codigo HTTP correspondiente, no necesariamente 1 o 0
			}
		//Solo por resolucion de IP para el nombre (DNS interno)  $maquina deberia ser un dominio  ej google.com
		if($tipo_monitor=="dnssolve")
			{
			    //Puede retornar verdadero aun cuando el Host este abajo pues valida solo la resolucion del nombre, no el estado del host
                if(gethostbyname($maquina) != $maquina )
                    return 1;
                else
                    return 0;
			}
	}


/* ################################################################## */
/* ################################################################## */
function DibujarEstadoMaquina($Maquina,$estado_final,$Separador_DosPuntos,$estilo_caja_estado,$estilo_texto_estado)
	{
	    global $IconoAlertaSonora,$IconoAlertaVibracion;
	    
	    
	    $AnchoControl=$Maquina["ancho"];
	    
	    //Si el modo de presentacion es NORMAL
	    if($Maquina["modo_compacto"]==0)
	        {
    			echo '
    				<div class="col-xs-'.$AnchoControl.' col-sm-'.$AnchoControl.' col-md-'.$AnchoControl.' col-lg-'.$AnchoControl.'">
    					<div class="panel '.$estilo_caja_estado.'">
    						<div class="panel-heading">
    							<div class="row">
    								<div class="col-md-1 col-lg-1">
    									<i class="fa fa-desktop fa-2x "></i>
    								</div>
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
    				</div>';
	        }

	    //Si el modo de presentacion es COMPACTO
	    if($Maquina["modo_compacto"]==1)
		    {
    			echo '
    				<div data-toggle="tooltip" data-html="true" data-placement="auto" title="'.$Maquina["host"].$Separador_DosPuntos.$Maquina["puerto"].'" class="col-xs-'.$AnchoControl.' col-sm-'.$AnchoControl.' col-md-'.$AnchoControl.' col-lg-'.$AnchoControl.'">
    					<div class="panel '.$estilo_caja_estado.'">
    						<div class="panel-heading">
    							<i class="fa fa-desktop fa-1x pull-left"></i>'.$Maquina["nombre"].'
    						</div>
    					</div>
    				</div>';
		    }

	    //Si el modo de presentacion es ULTRA-COMPACTO
	    if($Maquina["modo_compacto"]==2)
		    {
		        $NombreMonitor=$Maquina["nombre"][0];
		        $AnchoControl=1;
		        $IconoMonitor="fa-check";
		        //Aun para el modo Ultra-Compacto SI EL MONITOR ESTA CAIDO amplia su nombre para visualizacion rapida
		        if ($estilo_caja_estado=="panel-danger")
		            {
		                $NombreMonitor=$Maquina["nombre"];
		                $AnchoControl=$Maquina["ancho"];
		                $IconoMonitor="fa-times";
		            }
		        
    			echo '
    				<div data-toggle="tooltip" data-html="true" data-placement="auto" title="<b>'.$Maquina["nombre"].'</b><br>'.$Maquina["host"].$Separador_DosPuntos.$Maquina["puerto"].'" class="col-xs-'.$AnchoControl.' col-sm-'.$AnchoControl.' col-md-'.$AnchoControl.' col-lg-'.$AnchoControl.'">
    					<div class="panel '.$estilo_caja_estado.'">
    						<div class="panel-heading">
    							<i class="fa '.$IconoMonitor.' fa-1x pull-left"></i>'.$NombreMonitor.'
    						</div>
    					</div>
    				</div>';
		    }

	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PresentarEstadoMaquina
	Presenta una tabla formateada con el estado de una maquina en particular

	Ver tambien:

		<MaquinaOnline>
*/
function PresentarEstadoMaquina($IDRegistroMonitor)
	{
		global $ListaCamposSinID_monitoreo,$TablasCore;
		global $Imagen_fallo,$Imagen_ok;
		global $ErroresMonitoreoPractico; 			// Una variable global que inciada en cero, cambia su valor en esta funcion cuando hay errores
		global $ErroresMonitoreoAlertaAuditiva; 	// Una variable global que inciada en cero, cambia su valor en esta funcion cuando hay error en el monitor y este tiene activada la alerta sonora
		global $ErroresMonitoreoAlertaVibratoria; 	// Una variable global que inciada en cero, cambia su valor en esta funcion cuando hay error en el monitor y tiene habilitada la alerta vibratoria
		
		global $MULTILANG_MonTitulo,$PCO_FechaOperacionGuiones,$PCO_HoraOperacionPuntos;
		global $MULTILANG_MonLinea,$MULTILANG_MonCaido;
		
		//Busca los datos del monitor
		$Maquina=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_monitoreo." FROM ".$TablasCore."monitoreo WHERE id='$IDRegistroMonitor' ")->fetch();
		
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
				PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."monitoreo SET ultimo_estado='$EstadoMonitor' WHERE id='$IDRegistroMonitor' ");
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

        DibujarEstadoMaquina($Maquina,$estado_final,$Separador_DosPuntos,$estilo_caja_estado,$estilo_texto_estado);
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PresentarSensorRango
	Presenta un grafico con el estado numerico de un sensor, minimos y maximos
*/
function PresentarSensorRango($IDRegistroMonitor,$PresentarEnFormatoMaquina=0)
	{
		global $ListaCamposSinID_monitoreo,$TablasCore;
		global $Imagen_fallo,$Imagen_ok;
		global $ErroresMonitoreoPractico; 			// Una variable global que inciada en cero, cambia su valor en esta funcion cuando hay errores
		global $ErroresMonitoreoAlertaAuditiva; 	// Una variable global que inciada en cero, cambia su valor en esta funcion cuando hay error en el monitor y este tiene activada la alerta sonora
		global $ErroresMonitoreoAlertaVibratoria; 	// Una variable global que inciada en cero, cambia su valor en esta funcion cuando hay error en el monitor y tiene habilitada la alerta vibratoria
		
		global $MULTILANG_MonTitulo,$PCO_FechaOperacionGuiones,$PCO_HoraOperacionPuntos;
		global $MULTILANG_MonLinea,$MULTILANG_MonCaido;
		global $MULTILANG_FrmValorMinimo,$MULTILANG_FrmValorMaximo;
		
		//Busca los datos del monitor
		$Sensor=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_monitoreo." FROM ".$TablasCore."monitoreo WHERE id='$IDRegistroMonitor' ")->fetch();

        //Obtiene el valor de acuerdo al tipo de comando
        $Palabras = explode(' ',trim($Sensor["comando"]));
        if (strtoupper($Palabras[0])=="SELECT")
            {
                //Si usa una conexion externa usa su configuracion
                if($Sensor["conexion_origen_datos"]!="")
                    {
                        global ${$Sensor["conexion_origen_datos"]};
                        $registro_sensor=PCO_EjecutarSQL($Sensor["comando"],"",${$Sensor["conexion_origen_datos"]})->fetch();
                    }
                else
                    $registro_sensor=PCO_EjecutarSQL($Sensor["comando"])->fetch();
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
    				    if ($valor_sensor=="") $valor_sensor=1;
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
				PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."monitoreo SET ultimo_estado='$EstadoMonitor' WHERE id='$IDRegistroMonitor' ");
			}

        //Define cadena de colores cuando el sensor esta fuera de rango
        $CadenaColores=""; //Asume color predeterminado
        if ($SensorFueraRango)
            {
                //Si el sensor tiene valor diferente de maximo y minimo usa paleta de tres colores, sino una paleta simple
                if ($Sensor["valor_minimo"] != $Sensor["valor_maximo"])
                    $CadenaColores='colors: ["#FF1C00", "#D73B3E", "#B22222"]';
                else
                    $CadenaColores='colors: ["#B22222"]';
            }
		
		if ($PresentarEnFormatoMaquina==0)
		    {
    			echo '
                    <!--Agrega marco para el grafico de dona-->
    				<div class="col-md-'.$Sensor["ancho"].' col-lg-'.$Sensor["ancho"].'">
                        <div id="grafico-sensor-'.$Sensor["id"].'"></div>
    				</div>
    
                    <script language="JavaScript">
                    //Agrega la funcion para generar la dona con los datos
                    $(function() {
                        grafico_'.$Sensor["id"].'=Morris.Donut({
                            element: "grafico-sensor-'.$Sensor["id"].'",
                            data: [
                            ';
                        //Si el sensor tiene valor de igualdad en maximo y minimo solamente presenta el resultado
                        if ($Sensor["valor_minimo"] != $Sensor["valor_maximo"])
                            echo '
                                                    {
                                                        label: "Min",
                                                        value: "'.$Sensor["valor_minimo"].'"
                                                    },
                                                    {
                                                        label: "Max",
                                                        value: "'.$Sensor["valor_maximo"].'"
                                                    },';
                echo '
                                                    {
                                                        label: "'.$Sensor["nombre"].'",
                                                        value: "'.$valor_sensor.'"
                                                    },
                            ],
                            resize: false,
                            labelColor: "#eeeeee",
                            backgroundColor: "#FFFFFF",
                            '.$CadenaColores.'
                        });';
                        //Establece por defecto el item de grafico a mostrar
                        if ($Sensor["valor_minimo"] != $Sensor["valor_maximo"])
                            echo 'grafico_'.$Sensor["id"].'.select(2);';
                        else
                            echo 'grafico_'.$Sensor["id"].'.select(0);';
                echo '
                    });
                    </script>';
		    }
        else
            {
    			$estilo_caja_estado="panel-primary";
    			$estilo_texto_estado="text-primary";

    			$Separador_DosPuntos = "";
    			if ($Sensor["tipo_ping"]=="socket")
    				$Separador_DosPuntos = ":";

    			if ($SensorFueraRango==0)
    				$estado_final="$Imagen_ok $MULTILANG_MonLinea";
    			else
    				{
    					$estado_final="$Imagen_fallo $MULTILANG_MonCaido $Imagen_fallo";
    					$estilo_caja_estado="panel-danger";
    					$estilo_texto_estado="text-danger";
    				}
                DibujarEstadoMaquina($Sensor,$estado_final,$Separador_DosPuntos,$estilo_caja_estado,$estilo_texto_estado);
            }
            
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PresentarEstadoSQL
	Ejecuta un query SQL y presenta el resultado formateado como tabla
*/
function PresentarEstadoSQL($IDRegistroMonitor,$color_fondo_estado_sql,$color_texto_estado_sql)
	{
		global $Imagen_generica_sql,$Tamano_iconos,$MULTILANG_MonCommSQL,$ListaCamposSinID_monitoreo,$TablasCore;

		//Busca los datos del monitor
		$ComandoSQL=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_monitoreo." FROM ".$TablasCore."monitoreo WHERE id='$IDRegistroMonitor' ")->fetch();

        //Si usa una conexion externa usa su configuracion
        if($ComandoSQL["conexion_origen_datos"]!="")
            global ${$ComandoSQL["conexion_origen_datos"]};

		$SalidaFinalInforme='<table class="table table-responsive table-condensed btn-xs table-unbordered table-hover" style="font-family: Monospace, Sans-serif, Terminal, Tahoma;">';
		$estilo_caja_comandos="panel-warning";

		// Busca e Imprime encabezados de columna si no se tienen que ocultar
            if($ComandoSQL["conexion_origen_datos"]!="")
                $resultado_columnas=PCO_EjecutarSQL($ComandoSQL["comando"],"",${$ComandoSQL["conexion_origen_datos"]});
            else
			    $resultado_columnas=PCO_EjecutarSQL($ComandoSQL["comando"]);
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
            $consulta_ejecucion=PCO_EjecutarSQL($ComandoSQL["comando"],"",${$ComandoSQL["conexion_origen_datos"]});
        else
		    $consulta_ejecucion=PCO_EjecutarSQL($ComandoSQL["comando"]);
		
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
/*
	Function: PresentarImagen
	Muestra una imagen en un path relativo a la ejecucion de la herramienta y de un tamano en pixeles determinado
*/
function PresentarEmbebido($nombre,$path,$ancho,$alto)
	{
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
/*
	Function: EjecutarComando
	Ejecuta comandos autorizados en el servidor para mostrar su respuesta
*/
function EjecutarComando($comando_ejecutar)
	{
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
/*
	Function: PCO_VerMonitoreo
	Presenta las diferentes pantallas de monitoreo

	Salida:
		Pagina web con el sistema de monitoreo
*/
if ($PCO_Accion=="PCO_VerMonitoreo")
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
			$resultado=PCO_EjecutarSQL("SELECT MIN(pagina) as minimo,MAX(pagina) as maximo FROM ".$TablasCore."monitoreo ");
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
			if($PaginaRecurrente!="") $SiguientePagina=$PaginaMonitoreo;
			
			//Busca cuantos milisegundos esperar segun la pagina definida y sus elementos
			$resultado=PCO_EjecutarSQL("SELECT SUM(milisegundos_lectura) as total_espera FROM ".$TablasCore."monitoreo WHERE pagina='$PaginaMonitoreo' ");
			$registro = $resultado->fetch();
			$MilisegundosPagina=$registro["total_espera"]+1;			
		?>

        <form name="formulario_monitoreo" action="index.php" style="visibility: hidden; display: none;">
            <input type="hidden" name="PCO_Accion" value="PCO_VerMonitoreo">
            <input type="hidden" name="Presentar_FullScreen" value="1">
            <input type="hidden" name="Pagina" value="<?php echo $SiguientePagina; ?>">
            <input type="hidden" name="PaginaRecurrente" value="<?php if($PaginaRecurrente!="") echo $PaginaMonitoreo; ?>">
        </form>

		<script language="JavaScript">
			var EstadoPausa=0;
			var ValorCronometro=<?php echo round($MilisegundosPagina/1000); ?>;
			function actualizar()
				{
					if (EstadoPausa==0)
					    document.formulario_monitoreo.submit();
						//document.location="index.php?PCO_Accion=PCO_VerMonitoreo&Presentar_FullScreen=1&Pagina=<?php echo $SiguientePagina; ?>";
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
					if (ValorCronometro<=-10)
					    document.formulario_monitoreo.submit();
				}
			actualizar_reloj();
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
								$Sonido_alarma="inc/practico/sonidos/alarma.ogg";

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
								$resultado=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_monitoreo." FROM ".$TablasCore."monitoreo WHERE pagina='$PaginaMonitoreo' ORDER BY peso ");
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
										//Evalua elementos tipo SensorMaquina que es en esencia un sensor en rango presentado finalmente como formato de maquina
										if ($registro["tipo"]=="SensorMaquina")
											{
												PresentarSensorRango($registro["id"],1);
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
                                    			if(empty($_SERVER["HTTPS"]))
                                    				$protocolo_webservice="http://";
                                    			else
                                    				$protocolo_webservice="https://";
												$Ruta_Servidor=$protocolo_webservice.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
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
	} //Fin PCO_VerMonitoreo