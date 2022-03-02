<?php 
    // Inicio de la sesion
    @session_start();
    date_default_timezone_set('America/Bogota');
    
	//PARAMETROS BASICOS DE CONFIGURACION
	$UsarLoginUsuarios=true;				//Activa o desactiva necesidad de login
	$MotorBD="mysql";						//Si desea otros motores amplie funcion segun Practico Framework
	$PuertoBD="";
	$BaseDatos="pcofe";
	$ServidorBD="localhost";
	$UsuarioBD="MyUser";
	$PasswordBD="MyPasswordBD";
	$CalcularTamanoDirectorios=true; 		//Para carpetas con miles de elementos puede tardar
	$DirectorioInicial=".";					//Donde comienza la navegacion del script
	$PermitirSubdirectorios = true;
	$ElementosOcultos = Array("MiArchivo.Ext","MiCarpetaOculta");
	
	
	/*
		SCRIPT SIMPLIFICADO DE BASE DE DATOS (Si aplica)
		
		CREATE DATABASE pcofe;
		USE pcofe;
		DROP TABLE IF EXISTS usuarios;
		CREATE TABLE usuarios ( login varchar(250) NOT NULL, clave varchar(250) NOT NULL, PRIMARY KEY  (login) );
		
		Actualice el siguiente INSERT por el valor de usuario y clave deseado o agregue mas si aplica
		INSERT INTO usuarios VALUES ('admin','admin');

		CREATE USER 'MyUser'@'localhost' IDENTIFIED BY 'MyPasswordBD';
		CREATE USER 'MyUser'@'%' IDENTIFIED BY 'MyPasswordBD';
		GRANT SELECT ON pcofe.usuarios TO 'MyUser'@'localhost';
		GRANT SELECT ON pcofe.usuarios TO 'MyUser'@'%';
	*/



/***************************************************************************/
/**  INICIO DEL CODIGO DE APLICACION                                      **/
/***************************************************************************/
chdir($DirectorioInicial);
$hiddenFilesWildcards = Array();
$snifServer = $_SERVER['HTTP_HOST'];
$hiddenFilesRegex = $ElementosOcultos;
$separationString = "\t";
$descriptionFilenamesCaseSensitive = false;
$protectDirsWithHtaccess = true;

/***************************************************************************/
/**  INITIALIZACION                                                       **/
/***************************************************************************/

// make sure all the notices don't come up in some configurations
error_reporting (E_ALL ^ E_NOTICE);

$displayError = Array();

// safify all GET variables
foreach($_GET AS $key => $value) {
	$_GET[$key] = strip_tags($value);
	if ($_GET[$key] != $value) {
		$displayError[] = "Caracteres ilegales detectados en la URL.  Ignorando.";
	}
	if (!get_magic_quotes_gpc()) {
		$_GET[$key] = stripslashes($value);
	}
}

// first of all, security: prevent any unauthorized paths
// if sub directories are forbidden, ignore any path setting
if (!$PermitirSubdirectorios) {
	$path = "";
} else {
	$path = $_GET["path"];
	
	// ignore any potentially malicious paths
	$path = safeDirectory($path);
}

// default sorting is by name
if ($_GET["sort"]=="") 
	$_GET["sort"] = "name";

// default order is ascending
if ($_GET["order"]=="") {
	$_GET["order"] = "asc";
} else {
	$_GET["order"] = strtolower($_GET["order"]);
}

$hiddenFilesWildcards[] = ".";
$hiddenFilesWildcards[] = basename($_SERVER["PHP_SELF"]);

// Construye expresion regular para archivos ocultos
for ($i=0;$i<count($hiddenFilesWildcards);$i++) {
	$translate = Array(
		"." => "\\.",
		"*" => ".*",
		"?" => ".?",
		"+" => "\\+",
		"[" => "\\[",
		"]" => "\\]",
		"(" => "\\(",
		")" => "\\)",
		"{" => "\\{",
		"}" => "\\}",
		"^" => "\\^",
		"\$" => "\\\$",
		"\\" => "\\\\",
	);
	$hiddenFilesRegex[] = "^".strtr($hiddenFilesWildcards[$i],$translate)."$";
}
// Oculta .*
$hiddenFilesRegex[] = "^\\.[^.].*$";
$hiddenFilesWholeRegex = "/".join("|",$hiddenFilesRegex)."/i";


/***************************************************************************/
/**  REQUEST HANDLING                                                     **/
/***************************************************************************/
// captura solicitud de cierre
if ($_GET["cerrar_sesion"]!="") {
	@session_destroy();
	header('Location: '.$_SERVER["PHP_SELF"]);
}

// captura solicitud de descarga siempre y cuando tenga activa la sesion
if ($_GET["download"]!="") 
	if (isset($_SESSION["PCOSESS_LoginUsuario"]))
	{
		$download = stripslashes($_GET["download"]);
		$filename = safeDirectory($path.rawurldecode($download));
		if (
			!file_exists($filename)
			OR fileIsHidden($filename)) {
			
			Header("HTTP/1.0 404 Not Found");
			$displayError[] = sprintf("Archivo no encontrado: %s", $filename);
		} else {
			//doConditionalGet($filename, filemtime($filename));
			Header("Content-Length: ".filesize($filename));
			Header("Content-Type: application/x-download");
			Header("Content-Disposition: attachment; filename=\"".rawurlencode($download)."\"");
			readfile($filename);
			die();
		}
	}


/***************************************************************************/
/**  FUNCTIONS                                                            **/
/***************************************************************************/

// create a HTTP conform date
function createHTTPDate($time) {
	return gmdate("D, d M Y H:i:s", $time)." GMT";
}

// this function is from http://simon.incutio.com/archive/2003/04/23/conditionalGet
function doConditionalGet($file, $timestamp) {
	$last_modified = createHTTPDate($timestamp);
	$etag = '"'.md5($file.$last_modified).'"';
	// Send the headers
	Header("Last-Modified: $last_modified");
	Header("ETag: $etag");
	// See if the client has provided the required headers
	$if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ?
		stripslashes($_SERVER['HTTP_IF_MODIFIED_SINCE']) :
		false;
	$if_none_match = isset($_SERVER['HTTP_IF_NONE_MATCH']) ?
		stripslashes($_SERVER['HTTP_IF_NONE_MATCH']) : 
		false;
	if (!$if_modified_since && !$if_none_match) {
		return;
	}
	// At least one of the headers is there - check them
	if ($if_none_match && $if_none_match != $etag) {
		return; // etag is there but doesn't match
	}
	if ($if_modified_since && $if_modified_since != $last_modified) {
		return; // if-modified-since is there but doesn't match
	}
	// Nothing has changed since their last request - serve a 304 and exit
	Header('HTTP/1.0 304 Not Modified');
	die();
}


function safeDirectory($path) {
	GLOBAL $displayError;
	$result = $path;
	if (strpos($path,"..")!==false)
		$result = "";
	if (substr($path,0,1)=="/") {
		$result = "";
	}
	if ($result!=$path) {
		$displayError[] = "Se ha detectado una ruta de sistema ilegal, Ignorando.";
	}
	return $result;
}


/**
 * Formatea el tamano de archivo en unidades comprensibles (750 B, 3.4 KB etc.)
 **/
function niceSize($size) {
	define("SIZESTEP", 1024.0);
	static $sizeUnits = Array();
	if (count($sizeUnits)==0) {
		$sizeUnits[] = "&nbsp;B";
		$sizeUnits[] = "KB";
		$sizeUnits[] = "MB";
		$sizeUnits[] = "GB";
		$sizeUnits[] = "TB";
	}
	
	if ($size==="")
		return "";
	
	$unitIndex = 0;
	while ($size>SIZESTEP) {
		$size = $size / SIZESTEP;
		$unitIndex++;
	}
	
	if ($unitIndex==0) {
		return number_format($size, 0)."&nbsp;".$sizeUnits[$unitIndex];
	} else {
		return number_format($size, 1, ".", ",")."&nbsp;".$sizeUnits[$unitIndex];
	}
}

/**
 * Compare two strings or numbers. Return values as strcmp().
 **/
function myCompare($arrA, $arrB, $caseSensitive=false) {
	$a = $arrA[$_GET["sort"]];
	$b = $arrB[$_GET["sort"]];
	
	// sort .. first
	if ($arrA["isBack"]) return -1;
	if ($arrB["isBack"]) return 1;
	// sort directories above everything else
	if ($arrA["isDirectory"]!=$arrB["isDirectory"]) {
		$result = $arrB["isDirectory"]-$arrA["isDirectory"];
	} else if ($arrA["isDirectory"] && $arrB["isDirectory"] && ($_GET["sort"]=="type" || $_GET["sort"]=="size")) {
		$result = 0;
	} else {
		if (is_string($a) OR is_string($b)) {
			if (!$caseSensitive) {
				$a = strtoupper($a);
				$b = strtoupper($b);
			}
			$result = strcoll($a,$b);
		} else {
			$result = $a-$b;
		}
	}
	
	if (strtolower($_GET["order"])=="desc") {
		return -$result;
	} else {
		return $result;
	}
}


/**
 * URLEncodes some characters in a string. PHP's urlencode and rawurlencode
 * produce very unsatisfying results for special and reserved characters in
 * filenames.
 **/
function myEncode($path, $filename) {
	// % must be the first, as it is the escape character
	/*
	$from = Array("%"," ","#","&");
	$to = Array("%25","%20","%23","%26");
	return str_replace($from, $to, $string);
	*/
	return $path.rawurlencode($filename);
}


/**
 * Build a URL using new sorting settings.
 **/
function getNewSortURL($newSort) {
	GLOBAL $path;
	$base = $_SERVER["PHP_SELF"];
	$url = $base."?sort=$newSort";
	if ($newSort==$_GET["sort"]) {
		if ($_GET["order"]=="asc" OR $_GET["order"]=="") {
			$url.= "&amp;order=desc";
		}
	}
	if ($path!="") {
		$url.= "&amp;path=$path";
	}
	return $url;
}

/**
 * Determine a file's file type based on its extension.
 **/
function getFileType($fileInfo) {
	// put any additional extensions in here
	$extension = $fileInfo["type"];
	static $fileTypes = Array(
		//"HTML"		=> Array("html","htm"),
		"image"		=> Array("gif","jpg","jpeg","png","tif","tiff","bmp","art"),
		"text"		=> Array("asp","c","cfg","cpp","css","csv","conf","cue","diz","h","inf","ini","java","js","log","nfo","php","phps","pl","py","rdf","rss","rtf","sql","txt","vbs","xml"),
		//"code"		=> Array("asp","c","cpp","h","java","js","php","phps","pl","py","sql","vbs"),
		"xml"		=> Array("rdf","rss","xml"),
		"binary"	=> Array("asf","au","avi","bin","class","divx","doc","exe","mov","mpg","mpeg","mp3","ogg","ogm","pdf","ppt","ps","rm","swf","wmf","wmv","xls"),
		"document"  => Array("doc","pdf","ppt","ps","rtf","xls"),
		"archive"	=> Array("ace","arc","bz2","cab","gz","lha","jar","rar","sit","tar","tbz2","tgz","z","zip","zoo")
	);
	static $extensions = null;

	if ($extensions==null) {
		$extensions = Array();
		foreach($fileTypes AS $keyType => $value) {
			foreach($value AS $ext) $extensions[$ext] = $keyType;
		}
	}

	if ($fileInfo["isDirectory"]) {
		if ($fileInfo["isBack"]) {
			return "dirup";
		} else {
			return "folder";
		}
	}
	
	$type = $extensions[strtolower($extension)];
	if ($type=="") {
		return "unknown";
	} else {
		return $type;
	}
}

function dirContainsHtAccess($dirname) {
	if(is_dir($dirname)) {
		if ($dirname=="." || $dirname=="..") return false;
		$d = dir($dirname);
		while($f = $d->read()) {
			if ($f==".htaccess")
				return true;
		}
	}
	return false;
}

// checks if a file is hidden from view
function fileIsHidden($filename) {
	GLOBAL $hiddenFilesWholeRegex,$protectDirsWithHtaccess;
	
	if (is_dir($filename) && $protectDirsWithHtaccess) {
		if (!($filename=="." || $filename=="..")) {
			$d = dir($filename);
			while($f = $d->read()) {
				if ($f==".htaccess")
					return true;
			}
		}
	}
	return preg_match($hiddenFilesWholeRegex,$filename);
}

function getPathLink($directory) {
	return $_SERVER["PHP_SELF"]."?path=".urlEncode($directory)."/";
}

function getDirSize($dirname) {
	$dir = dir($dirname);
	$fileCount = 0;
	while ($filename = $dir->read()) {
		if (!fileIsHidden($dirname."/".$filename)) 
			$fileCount++;
	}
	return $fileCount-2; // no incluye . y ..
}


/***************************************************************************/
/**  LIST BUILDING                                                        **/
/***************************************************************************/

// change directory
// must be done before description file is parsed
if ($path!="") {
	$hidden = fileIsHidden(substr($path,0,-1));
	if ($hidden || !@chdir($path)) {
		$displayError[] = sprintf("%s no es un subdirectorio del directorio actual.", $path);
		$path = "";
	}
} 
$dir = dir(".");

// build a two dimensional array containing the files in the chosen directory and their meta data
$files = Array();
while($entry = $dir->read()) {
	// if the filename matches one of the hidden files wildcards, skip the file
	if (fileIsHidden($entry))
		continue;
		
	// if the file is a directory and if directories are forbidden, skip it
	if (!$PermitirSubdirectorios AND is_dir($entry))
		continue;
	
	$f = Array();

	$f["name"] = $entry;
	$f["isDownloadable"] = 1; //Asume que todo es descargable
	$f["isDirectory"] = is_dir($entry);
	$fDate = @filemtime($entry);
	$f["date"] = $fDate;
	$f["fullDate"] = date("r", $fDate);
	$f["shortDate"] = date("Y-m-d H:m", $fDate);
	//setlocale(LC_ALL,"German");
	//$f["shortDate"] = strftime("%x");
	if ($f["isDirectory"]) {
		$f["type"] = "&lt;DIR&gt;";
		$f["size"] = "";
		$f["niceSize"] = "";
		
		// building the link
		if ($entry=="..") {
			// strip the last directory from the path
			$pathArr = explode("/",$path);
			$link = implode("/",array_slice($pathArr,0,count($pathArr)-2));
			
			// if there is no path set, don't add it to the link
			if ($link=="") {
				// we're already in $baseDir, so skip the file
				if ($path=="")
					continue;
				$f["link"] = $_SERVER["PHP_SELF"];
			} else {
				$link.= "/";
				$f["link"] = $_SERVER["PHP_SELF"]."?path=".urlEncode($link);
			}
			$f["isBack"] = true;
			$f["displayName"] = "[ Subir un directorio ]";
		} else {
			if ($CalcularTamanoDirectorios)
				{
					$filesInDir = getDirSize($entry);
					if ($filesInDir==1) {
						$f["niceSize"] = "1 item";
					} else {
						$f["niceSize"] = sprintf("%d items",$filesInDir);
					}
				}
			else
				{
					$f["niceSize"] = "Sin calcular";
				}
			
			$f["link"] = getPathLink($path.$entry);
		}
	} else {
		if (is_link($entry)) {
			$linkTarget = readlink($entry);
			$pi = pathinfo($linkTarget);
			$scriptDir = dirname($_SERVER["SCRIPT_FILENAME"]);
			if (strpos($pi["dirname"], $scriptDir)===0) {
				$f["type"] = "&lt;LINK&gt;";
				// links have no date, so take the target's date
				$f["date"] = filemtime($linkTarget);
				$f["link"] = $path.urlencode(substr($linkTarget, strlen($scriptDir)+1));
			} else {
				// link target is outside of script directory, so skip it
				continue;
			}
		} else {
			$fSize = @filesize($entry);
			$f["size"] = $fSize;
			$f["fullSize"] = number_format($fSize,0,".",",");
			$f["niceSize"] = nicesize($fSize);
			$pi = pathinfo($entry);
			$f["type"] = $pi["extension"];
			$f["link"] = myEncode($path,$entry);
		}
	}
	if (!$f["isBack"]) {
		$f["displayName"] = htmlentities($f["name"]);
	}
	$f["filetype"] = getFileType($f);

	$files[] = $f;
}

usort($files, "myCompare");






/* ################################################################## */
/* ################################################################## */
/*
    Function: PCO_Mensaje
    Funcion generica para la presentacion de mensajes.  Ver variables para personalizacion.

    Variables de entrada:

        titulo - Texto que aparece en resaltado como encabezado del texto.  Acepta modificadores HTML.
        texto - Mensaje completo a desplegar en formato de texto normal.  Acepta modificadores HTML.
        icono - Formato Awesome Fonts o Iconos de Bootstrap
        estilo - Especifica el punto donde sera publicado el mensaje para definir la hoja de estilos correspondiente.
*/
function PCO_Mensaje($titulo,$texto,$icono,$estilo)
    {
        echo '<div class="'.$estilo.'" role="alert">
            <i class="'.$icono.' pull-left"></i>
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
            <strong>'.$titulo.'</strong><br>'.$texto.'
        </div>';
    }
 
 
/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOFE_NuevaConexionBD
	Crea una nueva conexion a un motor de base de datos y retorna la variable en cuestion para ser utilizada
	
	Variables de entrada:

		- PCOConnMotorBD: Tipo de motor utilizado
		- PCOConnPuertoBD: Puerto de conexion (opcional)
		- PCOConnBaseDatos: Nombre de la base de datos a conectar
		- PCOConnServidorBD: Host o servidor que ofrece el servicio
		- PCOConnUsuarioBD: Usuario con privilegios para accesar la base de datos
		- PCOConnPasswordBD: Clave del usuario que accesa el motor

	Salida:
		Retorna variable llamada ConexionPDO con la conexion establecida
*/
	function PCOFE_NuevaConexionBD($PCOConnMotorBD,$PCOConnPuertoBD,$PCOConnBaseDatos,$PCOConnServidorBD,$PCOConnUsuarioBD,$PCOConnPasswordBD)
		{
			try
				{
					// Crea la conexion de acuerdo al tipo de motor
					if ($PCOConnMotorBD=="mysql")
						{
							// Si no se ha definido un numero de puerto
							if ($PCOConnPuertoBD=="")
								$ConexionPDO = new PDO("mysql:dbname=$PCOConnBaseDatos;host=$PCOConnServidorBD","$PCOConnUsuarioBD","$PCOConnPasswordBD");
							else
								$ConexionPDO = new PDO("mysql:dbname=$PCOConnBaseDatos;host=$PCOConnServidorBD;port=$PCOConnPuertoBD","$PCOConnUsuarioBD","$PCOConnPasswordBD");
						}

					// Evita el SQLSTATE[HY000]: General error. presentado por PostgreSQL.  Se habilita solo para MySQL
					if ($PCOConnMotorBD=="mysql" || $PCOConnMotorBD=="sqlite")
						{
							// Establece parametros para la conexion
							$ConexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						}
					
					if ($PCOConnMotorBD=="mysql")
						{
							$ConexionPDO->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
							$ConexionPDO->exec("SET NAMES 'utf8';");
							$ConexionPDO->exec("SET NAMES utf8;"); //Forzado UTF8 - Collation recomendada: utf8_general_ci
							//Evita el "General error: 2014 Cannot execute queries while other unbuffered queries are active"
							$ConexionPDO->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
						}
					
					//Retorna la variable de conexion creada
					return $ConexionPDO;
				}
			catch( PDOException $ErrorPDO)
				{
					$mensaje_final.="<div class='alert alert-danger alert-dismissible btn-xs' role='alert'>
					  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						<span aria-hidden='true'><i class='fa fa-eye-slash fa-fw'></i></span>
					  </button>
					<i class='fa fa-database fa-fw fa-3x fa-pull-left text-danger '></i>";
					$mensaje_final.="<strong>Error en tiempo de ejecucion:</strong> <br>";
					echo $mensaje_final.'<b>Detalles:</b><i> '.$ErrorPDO->getMessage().'</i></div>';
				}
		}

/***************************************************************************/
/**  HTML OUTPUT                                                          **/
/***************************************************************************/

Header("Content-Type: text/html; charset=UTF-8");
echo "<?php xml version=\"1.0\" encoding=\"UTF-8\"?>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Practico File Explorer</title>
		<style type="text/css">
		
			/*** COLORS ***/
			body.snif {
				background: #344556;             /* background behind table */
			}

			table.snif {
				border: 1px solid #444444;       /* main table border style */
			}
			table.snif2 {
				border: 1px solid Gray;       /* main table border style */
				background-color: #455667;       /* main table border style */
			}
			td.snDir {
				color: #ffffff;                  /* table header text color */
				background-color: #000000;       /* table header background color */
			}
			td.snDir a {
				color:white;                     /* link text color within table header */
			}
			tr.snHeading, td.snHeading, td.snHeading a {
				color: #dddddd;                  /* column headings text color */
				background-color: #444444;       /* column headings background color */
			}
			tr.snF td a {
				color: #000000;                  /* file listing link text color (filename)*/
			}
			tr.snF td a:hover, a.snif:hover {
				background-color: #bbbbee;       /* file listing link hover background color */
			}
			tr.snEven {
				background-color: #eeeeee;       /* file listing background color for even numbered rows */
			}
			tr.snOdd {
				background-color: #dddddd;       /* file listing background color for odd numbered rows */
			}
			tr.snF td {
				color: #444444;                  /* file listing text color */
			}


			tr.snHeading, td.snHeading, td.snHeading a {
				padding-top: 3px;
				padding-bottom: 3px;
			}
			tr.snF td {
				padding-top: 2px;
				padding-bottom: 2px;
				vertical-align: top;
				padding-left: 10px;
				padding-right: 10px;
				white-space: nowrap;
			}
			.snW {
				white-space: normal;
			}
		</style>

		<link   href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/css/bootstrap.min.css"       rel="stylesheet" type="text/css">
		<link   href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
		<link   href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"         rel="stylesheet" type="text/css">
		<style type="text/css">
			html,body{background:#272727}.navbar-xs{min-height:27px;height:27px;font-size:13px}.navbar-xs .navbar-brand{padding:0 12px;font-size:15px;line-height:27px}.navbar-xs .navbar-nav>li>a{padding-top:0;padding-bottom:0;line-height:27px}.navbar-xs .navbar-nav>li>ul>li{font-size:13px}.navbar-xs .navbar-nav>li>ul{background:darkgray}.navbar-nav>li>a,.navbar-brand{padding-top:0 !important;padding-bottom:0 !important;height:27px}.navbar{min-height:27px !important}.tooltip-inner{max-width:none;white-space:nowrap;font-size:10px}::-webkit-scrollbar{width:10px;height:10px}::-webkit-scrollbar-button:start:decrement,::-webkit-scrollbar-button:end:increment{display:none}::-webkit-scrollbar-track-piece{background-color:#3b3b3b;-webkit-border-radius:6px}::-webkit-scrollbar-thumb:vertical{-webkit-border-radius:6px;background:#666 no-repeat center}::-webkit-scrollbar-thumb:horizontal{-webkit-border-radius:6px;background:#666 no-repeat center}::-webkit-scrollbar-corner{display:none}::-webkit-resizer{display:none}
		</style>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	</head>
<body oncontextmenu="return false;">






<!-- ################# INICIO DE LA MAQUETACION ################ -->


		<div class="row">
			<div class="col-md-12">

				<div id="panel_superior" >
					
					<nav class="navbar navbar-default navbar-inverse navbar-xs" style="margin:0px; padding:0px;"> <!-- navbar-fixed-top navbar-fixed-bottom navbar-static-top navbar-inverse -->
						<div class="container-fluid">
							<!-- Logo y boton colapsable -->
							<div class="navbar-header">
								<div class="navbar-brand text-primary"><b><i class="text-primary"><i class="fa fa-search text-primary">&nbsp;&nbsp;</i>Practico File Explorer</i></b></div>
							</div>

							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="barra_menu_superior">
								<ul class="nav navbar-nav">
									<!-- MENU DE PAGINAS -->
									<li class="dropdown">
										<a style="cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Explorador <span class="caret"></span></a>
										<ul class="dropdown-menu">
											<!--<li role="separator" class="divider"></li>-->
											<li><a style="cursor:pointer;" href="<?php echo $_SERVER["PHP_SELF"]; ?>?cerrar_sesion=1"><i class="fa fa-sign-out fa-fw"></i> Cerrar</a></li>
										</ul>
									</li>

									<!-- BOTONES INDEPENDIENTES
									<li><a style="cursor:pointer;" OnClick="EstadoPausa=1;" data-toggle="tooltip" data-placement="bottom" title="Pausa en esta ventana / Pause this window"><i class="fa fa-pause fa-fw text-danger "></i> <?php echo $MULTILANG_Pausar; ?></a></li>
									<li><a style="cursor:pointer;" OnClick="document.formulario_monitoreo.Pagina.value='<?php echo $PaginaMonitoreo; ?>'; document.formulario_monitoreo.PaginaRecuerrente.value='<?php echo $PaginaMonitoreo; ?>';" data-toggle="tooltip" data-placement="bottom" title="Permanecer y actualizar solo esta pagina / Stay and upgrade only this page"><i class="fa fa-refresh fa-fw text-warning "></i> <?php echo $MULTILANG_Recurrente; ?></a></li>
									<li><a style="cursor:pointer;" OnClick="document.formulario_monitoreo.Pagina.value=(document.formulario_monitoreo.Pagina.value)*1-1; EstadoPausa=0; document.formulario_monitoreo.PaginaRecuerrente.value=''; actualizar();" data-toggle="tooltip" data-placement="bottom" title="Continuar monitoreo / Resume monitoring"><i class="fa fa-play fa-fw text-success"></i> <?php echo $MULTILANG_Continuar; ?></a></li>
									<li><a data-toggle="tooltip" data-placement="bottom" title="Tiempo antes de saltar / Time before jump"><i class="fa fa-clock-o fa-fw text-info"></i> <div id="MarcoCronometro" style="display: inline!important;">0s</div></a></li>
									-->
								</ul>

								<ul class="nav navbar-nav navbar-right">
									<li class="dropdown">
										<a style="cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-question-circle text-info"></i> <span class="caret"></span></a>
										<ul class="dropdown-menu">
											<li><a style="cursor:pointer;"><i class="fa fa-info fa-fw"></i> Gu&iacute;a de configuraci&oacute;n</a></li>
										</ul>
									</li>
								</ul>

							</div><!-- /.navbar-collapse -->
						</div><!-- /.container-fluid -->
					</nav>

				</div><!-- /.contenedor -->

			</div>
		</div>




		<DIV class="row">
			<div class="col-md-12" style="margin:0px;">

				<!-- INICIA LA TABLA PRINCIPAL -->
				<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="color:white;">
					<tr>
						<td width="100%" height="100%" valign="TOP" align="center">






<?php 
	if (!isset($_SESSION["PCOSESS_LoginUsuario"]) && $UsarLoginUsuarios==true)
		{
			//Presenta login o lo evalua en caso de recibir los datos
			if ($_POST["LoginUsuario"]!="" && $_POST["ClaveUsuario"]!="")
				{
						//Genera la conexion inicial del sistema
						$ConexionPDO=PCOFE_NuevaConexionBD($MotorBD,$PuertoBD,$BaseDatos,$ServidorBD,$UsuarioBD,$PasswordBD);

						$consulta = $ConexionPDO->prepare("SELECT login FROM usuarios WHERE login='".$_POST["LoginUsuario"]."' AND clave='".$_POST["ClaveUsuario"]."' ");
						$consulta->execute();
						$registro=$consulta->fetch();
						//Verifica si hay registro del usuario
						if ($registro["login"]!="")
							$_SESSION["PCOSESS_LoginUsuario"]=(string)$registro["login"];
						else
							{
								$MensajeError="<br><br><br><font color=yellow><b><i class='fa fa-warning'></i> Usuario o clave incorrectos</b></font>";
								$_POST["LoginUsuario"]="";
							}
				}
			
			
			if ($_POST["LoginUsuario"]=="" || $_POST["ClaveUsuario"]=="")
				{
					echo $MensajeError;
					//Si no recibe usuario y clave presenta ventana de login
					?>
						<br><br>
						<div class="panel alert-info" style="width:20%;">							
							<div class="panel-body">
								<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" autocomplete="off" method="post">
									<br>
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
										<input type="text" class="form-control" name="LoginUsuario" placeholder="Usuario">
									</div>
									<br>
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
										<input type="password" class="form-control" name="ClaveUsuario" placeholder="Clave">
									</div>
									<br>
									<button type="submit" id="sendlogin" class="btn btn-primary">Ingresar <i class="fa fa-arrow-right fa-fw"></i></button>
								</form>
							</div>
						</div>
					<?php
				}
		}
	else
		{
			//Si el control de usuarios esta desactivado agrega a la sesion el usuario anonimo
			if ($UsarLoginUsuarios==false)
				{
					$_SESSION["PCOSESS_LoginUsuario"]=(string)"Anonimo";
				}
		}

?>



<?php 
if (count($displayError)>0) {
	foreach($displayError AS $error) {
		PCO_Mensaje("Error","$error","fa fa-2x fa-warning","alert alert-danger");
	}
}


if (isset($_SESSION["PCOSESS_LoginUsuario"]))
{
	
?>
<table cellpadding="0" cellspacing="0"  width="93%">
	<tr>
		<td class="btn-xs" colspan="5"> <!-- class="snDir" -->
			<br>
			<?php 
			$baseDirname = $snifServer.htmlentities(dirname($_SERVER["PHP_SELF"]));
			$pathToSnif = explode("/",$baseDirname);
			//echo "http://".join("/",array_slice($pathToSnif, 0, -1))."/";
			echo "<a href=\"".$_SERVER["PHP_SELF"]."/\"><i class='fa fa-folder-open fa-fw fa-1x'></i>Ra&iacute;z&nbsp;".join("/",array_slice($pathToSnif, -1))."</a>";
			$pathArr = explode("/",$path);
			for ($i=0; $i<count($pathArr)-1; $i++) {
				$dirLink = getPathLink(join("/",array_slice($pathArr, 0, $i+1)));
				echo "&nbsp;/&nbsp;<a href=\"$dirLink\">".htmlentities($pathArr[$i])."</a>";
			}
			?>
		</td>
	</tr>

	<tr>
		<td class="snHeading littlepadding">&nbsp;</td>
		<td class="snHeading">
			<a href="<?php echo getNewSortURL("name");?>">Nombre</a>
			<?php 
			$sort = $_GET["sort"];
			if ($sort=="name")
				echo "<i class='fa fa-fw fa-sort'></i>";
			?>
		</td>
		<td class="snHeading">
			<a href="<?php echo getNewSortURL("type");?>">Tipo</a>
			<?php 
			if ($sort=="type")
				echo "<i class='fa fa-fw fa-sort'></i>";
			?>
		</td>
		<td class="snHeading" align="right">
			<?php 
			if ($sort=="size")
				echo "<i class='fa fa-fw fa-sort'></i>";
			?>
			<a href="<?php echo getNewSortURL("size");?>">Tama&ntilde;o&nbsp;</a>
		</td>
		<td class="snHeading" align="center">
			<a href="<?php echo getNewSortURL("date");?>">&nbsp;Fecha</a>
			<?php 
			if ($sort=="date")
				echo "<i class='fa fa-fw fa-sort'></i>";
			?>
		</td>

	</tr>
	
	<?php 
	//Recorre el arreglo de archivos
	for ($i=0;$i<min(count($files),count($files));$i++) {
	?>
	<tr class="snF <?php echo ($i%2==0) ? "snEven" : "snOdd"?>">
		<?php 
		
			//DESCARGA
			echo "<td>";
			if ($files[$i]["isDirectory"] OR !$files[$i]["isDownloadable"]) {
				echo '<i class="fa fa-fw fa-folder" style="color:orange"></i>';
			} else {
			?>
				<a href="<?php echo $PHP_SELF?>?path=<?php echo rawurlencode($path)?>&amp;download=<?php echo rawurlencode($files[$i]["name"]);?>"><i class="fa fa-fw fa-download"></i></a>
			<?php 
			}
			echo "</td>";
			
			//NOMBRE
			echo "<td>"; 
					if ($files[$i]["isDirectory"])
						echo '<a href="'.$files[$i]["link"].'">';
					echo $files[$i]["displayName"];
					if ($files[$i]["isDirectory"])
						echo "</a>";
			echo "</td>";

			//TIPO
			echo "<td>";
			echo $files[$i]["type"];
			echo "</td>";

			//TAMANO
			echo "<td align=\"right\">";
			if ($files[$i]["fullSize"]!="") echo "	<span title=\"".$files[$i]["fullSize"]." Bytes\">";
			echo $files[$i]["niceSize"];
			if ($files[$i]["fullSize"]!="") echo "  </span>";
			echo "</td>";

			//FECHA
			echo "<td align='center'>";
			echo "<span title=\"".$files[$i]["fullDate"]."\">".$files[$i]["shortDate"]."</span>";
			echo "</td>";
		?>
	</tr><?php 
	}
	?>
</table>
<?php
} //Fin si hay sesion:  PCOSESS_LoginUsuario
?>

				<!-- FINALIZA LA TABLA PRINCIPAL -->
				</td></tr>
				<tr>
					<td align="center">
						<!-- NOTA COPYRIGHT	 -->
						<br><font color="#CACACA" size=1><i>&copy; Explorador de archivos basado en <a href="http://www.practico.org"><b>Practico.org</b></a></i>&nbsp;&nbsp;<br><br></font>
					</td>
				</tr>				
				</table>
			</div>
		</DIV>
	<!-- ################## FIN DE LA MAQUETACION ################## -->


	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
