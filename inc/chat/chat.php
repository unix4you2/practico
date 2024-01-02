<?php

/*

Copyright (c) 2009 Anant Garg (anantgarg.com | inscripts.com)

This script may be used for non-commercial purposes only. For any
commercial purposes, please contact the author at 
anant.garg@inscripts.com

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.

*/

session_start();

//███▓▓▓▒▒▒        IMPORTANTE !!!  IMPORTANTE !!!  IMPORTANTE !!!  IMPORTANTE !!!         ▒▒▒▓▓▓███
//███▓▓▓▒▒▒ UNA COPIA DE ESTE ARCHIVO EXISTE SOLO POR COMPATIBILIDAD CON INCLUSIONES DEL  ▒▒▒▓▓▓███
//███▓▓▓▒▒▒ FRAMEWORK SOBRE EL MODULO DE PCODER/INC ALTERANDO LA VARIABLE DE PATH         ▒▒▒▓▓▓███

$PathRaizPCO="../..";
$PosfijoTablaPCO="";

//Antes de seguir adelante valida una sesion activa
if ($_SESSION['username']=="") die();

//Incluye los archivos de configuracion de Practico y define vbles de conexion
include_once("$PathRaizPCO/core/configuracion.php");

// Inicia las conexiones con la BD y las deja listas para las operaciones
include_once("$PathRaizPCO/core/conexiones.php");

// Incluye definiciones comunes de la base de datos
include_once("$PathRaizPCO/inc/practico/def_basedatos.php");

// Incluye archivo con algunas funciones comunes usadas por la herramienta
include_once("$PathRaizPCO/core/comunes.php");

if ($_GET['action'] == "chatheartbeat") { chatHeartbeat(); } 
if ($_GET['action'] == "sendchat") { sendChat(); } 
if ($_GET['action'] == "closechat") { closeChat(); } 
if ($_GET['action'] == "startchatsession") { startChatSession(); } 

if (!isset($_SESSION['chatHistory'])) {
	$_SESSION['chatHistory'] = array();	
}

if (!isset($_SESSION['openChatBoxes'])) {
	$_SESSION['openChatBoxes'] = array();	
}

function chatHeartbeat() {
	
	global $TablasCore,$ZonaHoraria,$PosfijoTablaPCO;
	
	$usuario_chat=$_SESSION['username'];
	$consulta=PCO_EjecutarSQL("select * from ".$TablasCore."chat".$PosfijoTablaPCO." where (".$TablasCore."chat".$PosfijoTablaPCO.".destinatario = ? AND recd = 0) order by id ASC","$usuario_chat");
	
	$items = '';

	$chatBoxes = array();

	while ($chat = $consulta->fetch()) {

		if (!isset($_SESSION['openChatBoxes'][$chat['remitente']]) && isset($_SESSION['chatHistory'][$chat['remitente']])) {
			$items = $_SESSION['chatHistory'][$chat['remitente']];
		}

		$chat['message'] = sanitize($chat['message']);

		$items .= <<<EOD
					   {
			"s": "0",
			"f": "{$chat['remitente']}",
			"m": "{$chat['message']}"
	   },
EOD;

	if (!isset($_SESSION['chatHistory'][$chat['remitente']])) {
		$_SESSION['chatHistory'][$chat['remitente']] = '';
	}

	$_SESSION['chatHistory'][$chat['remitente']] .= <<<EOD
						   {
			"s": "0",
			"f": "{$chat['remitente']}",
			"m": "{$chat['message']}"
	   },
EOD;
		
		unset($_SESSION['tsChatBoxes'][$chat['remitente']]);
		$_SESSION['openChatBoxes'][$chat['remitente']] = $chat['sent'];
	}

	if (!empty($_SESSION['openChatBoxes'])) {
	foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
		if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
			date_default_timezone_set($ZonaHoraria);
			$now = time()-strtotime($time);
			$time = date('g:iA M dS', strtotime($time));

			$message = "Sent at $time";
			if ($now > 180) {
				$items .= <<<EOD
{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;

	if (!isset($_SESSION['chatHistory'][$chatbox])) {
		$_SESSION['chatHistory'][$chatbox] = '';
	}

	$_SESSION['chatHistory'][$chatbox] .= <<<EOD
		{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;
			$_SESSION['tsChatBoxes'][$chatbox] = 1;
		}
		}
	}
}

	$usuario_chat=$_SESSION['username'];
	PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."chat".$PosfijoTablaPCO." SET recd = 1 WHERE ".$TablasCore."chat".$PosfijoTablaPCO.".destinatario = ? and recd = 0","$usuario_chat");

	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}

<?php
			exit(0);
}

function chatBoxSession($chatbox) {
	
	$items = '';
	
	if (isset($_SESSION['chatHistory'][$chatbox])) {
		$items = $_SESSION['chatHistory'][$chatbox];
	}

	return $items;
}

function startChatSession() {
	$items = '';
	if (!empty($_SESSION['openChatBoxes'])) {
		foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
			$items .= chatBoxSession($chatbox);
		}
	}


	if ($items != '') {
		$items = substr($items, 0, -1);
	}

header('Content-type: application/json');
$UsuarioChat = @$_SESSION['username'];
?>
{
		"username": "<?php echo $UsuarioChat; ?>",
		"items": [
			<?php echo $items;?>
        ]
}

<?php

	exit(0);
}

function sendChat() {
	global $TablasCore,$_SeparadorCampos_,$ZonaHoraria,$PosfijoTablaPCO;
	$remitente = $_SESSION['username'];
	$destinatario = $_POST['destinatario'];
	$message = $_POST['message'];
	date_default_timezone_set($ZonaHoraria);
	$_SESSION['openChatBoxes'][$_POST['destinatario']] = date('Y-m-d H:i:s', time());
	
	$messagesan = sanitize($message);

	if (!isset($_SESSION['chatHistory'][$_POST['destinatario']])) {
		$_SESSION['chatHistory'][$_POST['destinatario']] = '';
	}

	$_SESSION['chatHistory'][$_POST['destinatario']] .= <<<EOD
					   {
			"s": "1",
			"f": "{$destinatario}",
			"m": "{$messagesan}"
	   },
EOD;


	unset($_SESSION['tsChatBoxes'][$_POST['destinatario']]);

	PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."chat".$PosfijoTablaPCO." (".$TablasCore."chat".$PosfijoTablaPCO.".remitente,".$TablasCore."chat".$PosfijoTablaPCO.".destinatario,message,sent) values (?,?,?,NOW());","$remitente$_SeparadorCampos_$destinatario$_SeparadorCampos_$message");
	echo "1";
	exit(0);
}

function closeChat() {

	unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);
	
	echo "1";
	exit(0);
}

function sanitize($text) {
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br>",$text);
	return $text;
}

function analytics() {
        // Estadisticas de uso anonimo con GABeacon
        $PrefijoGA='<img src="https://rastreador-visitas.appspot.com/';
        $PosfijoGA='/Practico/Chat?pixel" border=0 ALT=""/>';
        // Este valor indica un ID generico de GA UA-847800-9 No edite esta linea sobre el codigo
        // Para validar que su ID es diferente al generico de seguimiento.  En lugar de esto cambie
        // su valor a traves del panel de configuracion de Practico con el entregado como ID de GoogleAnalytics
        $Infijo=base64_decode("VUEtODQ3ODAwLTk=");
        echo $PrefijoGA.$Infijo.$PosfijoGA;
        if(@$CodigoGoogleAnalytics!="")
            echo $PrefijoGA.$CodigoGoogleAnalytics.$PosfijoGA;	
}