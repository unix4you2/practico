#!/usr/bin/php
<?php
/*				  
	AUTO-TRADING-BOT						Copyright (C) 2017
	----------------						John F. Arroyave Gutiérrez
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
    Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,MA 02110-1301,USA.
*/
error_reporting (0);
date_default_timezone_set('America/Bogota');

$IntervaloEjecucion=10;								//En segundos, tiempo de descanso del Bot antes de buscar nuevamente los cambios del mercado

require ("include/config.php");						//Configuracion personal de llaves de API
require ("include/z_consola.php");					//Funciones para impresion a consolas basicas (CLI)
include ("vendor-".$API_Trader."/autoload.php");	//Dependencias de la API seleccionada para operar
require ("include/z_api-".$API_Trader.".php");		//Funciones propias para operar el mercado con la API especificada
require ("include/z_divisas.php");					//Configuraciones basicas de divisa o moneda
require ("include/z_motores.php");					//Motores de inferencia disponibles para tomar decisiones de compra y venta



//Llamada al hilo principal del bot segun el motor de inferencia
if ($MotorSeleccionadoOperacion=="SIMPLE")
	OperarDivisa_InferenciaSimple($MonedaOperar);
if ($MotorSeleccionadoOperacion=="TENDENCIA")
	OperarDivisa_InferenciaPorTendencia($MonedaOperar);
