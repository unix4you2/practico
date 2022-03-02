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

	Informacion general de la API:
	* https://hitbtc.com/api#orderbook
	* https://github.com/hitbtc-com/hitbtc-api#errors

		Symbol		Lot size	Price step
		BTCUSD		0.01 BTC	0.01
		BTCEUR		0.01 BTC	0.01
		LTCBTC		0.1 LTC		0.00001
		LTCUSD		0.1 LTC		0.001
		LTCEUR		0.1 LTC		0.001
		DSHBTC		1 DSH		0.00000001
		ETHBTC		0.001 ETH	0.000001
		ETHEUR		0.001 ETH	0.0001
		NXTBTC		1 NXT		0.00000001
		BCNBTC		100 BCN		0.0000000001
		XDNBTC		100 XDN		0.0000000001
		DOGEBTC		1000 DOGE	0.000000001
		XMRBTC		0.01 XMR	0.000001
		QCNBTC		0.01 QCN	0.000001
		FCNBTC		0.01 FCN	0.000001
		LSKBTC		1 LSK		0.0000001
		LSKEUR		1 LSK		0.0001
		STEEMBTC	0.001 STEEM	0.00001
		STEEMEUR	0.001 STEEM	0.0001
		SBDBTC		0.001 SBD	0.00001
		DASHBTC		0.001 DASH	0.000001
		XEMBTC		1 XEM		0.00000001
		EMCBTC		0.1 EMC		0.00000001
		SCBTC		100 SC		0.000000001
		ARDRBTC		1 ARDR		0.000000001
		ZECBTC		0.001 ZEC	0.000001
		WAVESBTC	0.01 WAVES	0.0000001

	DICCIONARIO DE FUNCIONES DISPONIBLES (API de supervivencia):		EJEMPLO DE PARAMETROS
	-------------------------------------------------------------------------------------------------------------
		EstablecerOrden(TipoOperacion,CriptoMoneda,Cantidad,Valor)		"VENTA|COMPRA","BCN","100","0.0000003225"
		ObtenerSaldoTrading(CriptoMoneda,TipoSaldo);					"BCN","DISPONIBLE|RESERVADO"
		ObtenerSaldoMain(CriptoMoneda);									"BCN"
		TransferirSaldo_TradingAMain(CriptoMoneda,Cantidad)				"BCN",100
		TransferirSaldo_MainATrading(CriptoMoneda,Cantidad)				"BCN",100
		VerOrdenesActivas();
		VerOrdenesRecientes();
		VerTransacciones();
		VerTrading(DivisaComparadoraMercado);							"BCNBTC"
		ObtenerLimiteVenta(CriptoMoneda)								"BCN"
		ObtenerLimiteCompra(CriptoMoneda)								"BCN"
*/


//######################################################################
//######################################################################
//Pone una orden compra o venta en el mercado Ej:EstablecerOrden("COMPRA","BCNBTC","1","0.0000010102");
function EstablecerOrden($TipoOperacion,$CriptoMoneda,$Cantidad,$Valor)
	{
		global $APIKEY_Trader,$APISECRET_Trader;
		$client = new \Hitbtc\ProtectedClient($APIKEY_Trader, $APISECRET_Trader, $demo = false);
		$newOrder = new \Hitbtc\Model\NewOrder();
		if ($TipoOperacion=="VENTA")
			$newOrder->setSide($newOrder::SIDE_SELL);
		if ($TipoOperacion=="COMPRA")
			$newOrder->setSide($newOrder::SIDE_BUY);
		$newOrder->setSymbol($CriptoMoneda);
		$newOrder->setTimeInForce($newOrder::TIME_IN_FORCE_GTC);
		$newOrder->setType($newOrder::TYPE_LIMIT);
		$newOrder->setQuantity($Cantidad);
		$newOrder->setPrice($Valor);

		$EstadoError="";
		try {
			$order = $client->newOrder($newOrder);
			return $order->getOrderId();
			//var_dump($order->getStatus()); // new
		} catch (\Hitbtc\Exception\RejectException $e) {
			$EstadoError=$e; // if creating order will rejected
		} catch (\Hitbtc\Exception\InvalidRequestException $e) {
			$EstadoError= $e->getMessage(); // error in request
		} catch (\Exception $e) {
			$EstadoError= $e->getMessage(); // other error like network issue
		}
		if ($EstadoError!="")	MensajeError($EstadoError);
	}


//######################################################################
//######################################################################
function ObtenerSaldoTrading($CriptoMoneda,$TipoSaldo="DISPONIBLE")
	{
		global $APIKEY_Trader,$APISECRET_Trader;
		$client = new \Hitbtc\ProtectedClient($APIKEY_Trader, $APISECRET_Trader, $demo = false);
		
		try {
			foreach ($client->getBalanceTrading() as $balance) {
				// Verifica si el $balance->getCurrency() que se esta recorriendo es la moneda deseada para obtener el saldo
				if ($balance->getCurrency() == $CriptoMoneda)
					{
						if ($TipoSaldo=="DISPONIBLE")
							return $balance->getAvailable();
						if ($TipoSaldo=="RESERVADO")
							return $balance->getReserved();						
					}
			}
		} catch (\Hitbtc\Exception\InvalidRequestException $e) {
			echo $e;
		} catch (\Exception $e) {
			echo $e;
		}
	}


//######################################################################
//######################################################################
function ObtenerSaldoMain($CriptoMoneda)
	{
		global $APIKEY_Trader,$APISECRET_Trader;
		$client = new \Hitbtc\ProtectedClient($APIKEY_Trader, $APISECRET_Trader, $demo = false);
		try {
			foreach ($client->getBalanceMain() as $balance) {
				if ($balance->getCurrency() == $CriptoMoneda)
					return $balance->getAmount();
			}
		} catch (\Hitbtc\Exception\InvalidRequestException $e) {
			echo $e;
		} catch (\Exception $e) {
			echo $e;
		}
	}


//######################################################################
//######################################################################
function TransferirSaldo_TradingAMain($CriptoMoneda,$Cantidad)
	{
		global $APIKEY_Trader,$APISECRET_Trader;
		$client = new \Hitbtc\ProtectedClient($APIKEY_Trader, $APISECRET_Trader, $demo = false);
		try {
			$tnxId = $client->transferToMain($CriptoMoneda, $Cantidad);
		} catch (\Hitbtc\Exception\InvalidRequestException $e) {
			echo $e;
		} catch (\Exception $e) {
			echo $e;
		}
	}


//######################################################################
//######################################################################
function TransferirSaldo_MainATrading($CriptoMoneda,$Cantidad)
	{
		global $APIKEY_Trader,$APISECRET_Trader;
		$client = new \Hitbtc\ProtectedClient($APIKEY_Trader, $APISECRET_Trader, $demo = false);
		try {
			$tnxId = $client->transferToTrading($CriptoMoneda, $Cantidad);
		} catch (\Hitbtc\Exception\InvalidRequestException $e) {
			echo $e;
		} catch (\Exception $e) {
			echo $e;
		}
	}


//######################################################################
//######################################################################
function VerOrdenesActivas()
	{
		global $APIKEY_Trader,$APISECRET_Trader;
		$client = new \Hitbtc\ProtectedClient($APIKEY_Trader, $APISECRET_Trader, $demo = false);
		print_r($client->getActiveOrders());
	}


//######################################################################
//######################################################################
function VerOrdenesRecientes()
	{
		global $APIKEY_Trader,$APISECRET_Trader;
		$client = new \Hitbtc\ProtectedClient($APIKEY_Trader, $APISECRET_Trader, $demo = false);
		print_r($client->getRecentOrders());
	}


//######################################################################
//######################################################################
function VerTransacciones()
	{
		global $APIKEY_Trader,$APISECRET_Trader;
		$client = new \Hitbtc\ProtectedClient($APIKEY_Trader, $APISECRET_Trader, $demo = false);
		print_r($client->getTransactions());
	}


//######################################################################
//######################################################################
function VerTrading($DivisaComparadoraMercado)
	{
		global $APIKEY_Trader,$APISECRET_Trader;
		$client = new \Hitbtc\ProtectedClient($APIKEY_Trader, $APISECRET_Trader, $demo = false);
		print_r($client->getTrades("$DivisaComparadoraMercado"));
	}


//######################################################################
//######################################################################
function ObtenerLimiteVenta($CriptoMoneda)
	{
		global $APIKEY_Trader,$APISECRET_Trader;
		$client = new \Hitbtc\ProtectedClient($APIKEY_Trader, $APISECRET_Trader, $demo = false);
        $response = $client->getHttpClient()->get('/api/1/public/'.$CriptoMoneda.'/ticker', array('exceptions' => false));
        $document = $response->json();
		return $document["ask"];		
	}


//######################################################################
//######################################################################
function ObtenerLimiteCompra($CriptoMoneda)
	{
		global $APIKEY_Trader,$APISECRET_Trader;
		$client = new \Hitbtc\ProtectedClient($APIKEY_Trader, $APISECRET_Trader, $demo = false);
        $response = $client->getHttpClient()->get('/api/1/public/'.$CriptoMoneda.'/ticker', array('exceptions' => false));
        $document = $response->json();
		//print_r($client->getLimiteVenta($CriptoMoneda));
		return $document["bid"];
	}

