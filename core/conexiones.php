<?php
	/*
		Title: Conexiones PDO
		Ubicacion *[/core/conexiones.php]*.  Define las conexiones para uso de base de datos mediante PDO
	*/
?>

<?php
	/*
		Section: Definicion de conexion PDO
		Establece una conexion mediante objetos de datos PHP al inicio del script de manera que se usa una sola conexion para la mayoria de operaciones.

		Variables de entrada:

			BaseDatos - Variable que contiene el nombre de la base de datos de trabajo
			Servidor - Nombre del host al que se debe conectar para accesar el motor de bases de datos
			UsuarioBD - Usuario con privilegios suficientes para operar sobre la base de datos
			PasswordBD - Contrasena del usuario que accesa al motor

		Proceso simplificado:
			(start code)
				$ConexionPDO = new PDO("mysql:dbname=$BaseDatos;host=$Servidor","$UsuarioBD","$PasswordBD");
				$ConexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::PARAM_INT);
			(end)

		Salida:
			Establece la variable ConexionPDO para ejecutar cualquier query en el motor.
			Retorna un mensaje de error en la parte superior del aplicativo cuando no se alcanza una conexion exitosa.

		Ver tambien:
		<Definicion de conexion PDO> | <Configuracion base>
	*/


/*

//Initialize class and connects to the database
	public function __construct($database_type,$host,$database,$user,$password,$port){
		$this->database_type = strtolower($database_type);
		$this->host = $host;
		$this->database = $database;
		$this->user = $user;
		$this->password = $password;
		$this->port = $port;
	}

	//Initialize class and connects to the database
	public function Cnxn(){
		if(in_array($this->database_type, $this->database_types)){
			try{
				switch($this->database_type){
					case "mssql":
						$this->con = new PDO("mssql:host=".$this->host.";dbname=".$this->database, $this->user, $this->password);
						break;
					case "sqlsrv":
						$this->con = new PDO("sqlsrv:server=".$this->host.";database=".$this->database, $this->user, $this->password);
						break;
					case "ibm": //default port = ?
						$this->con = new PDO("ibm:DRIVER={IBM DB2 ODBC DRIVER};DATABASE=".$this->database."; HOSTNAME=".$this->host.";PORT=".$this->port.";PROTOCOL=TCPIP;", $this->user, $this->password);
						break;
					case "dblib": //default port = 10060
						$this->con = new PDO("dblib:host=".$this->host.":".$this->port.";dbname=".$this->database,$this->user,$this->password);
						break;
					case "odbc":
						$this->con = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb)};Dbq=C:\accounts.mdb;Uid=".$this->user);
						break;
					case "oracle":
						$this->con = new PDO("OCI:dbname=".$this->database.";charset=UTF-8", $this->user, $this->password);
						break;
					case "ifmx":
						$this->con = new PDO("informix:DSN=InformixDB", $this->user, $this->password);
						break;
					case "fbd":
						$this->con = new PDO("firebird:dbname=".$this->host.":".$this->database, $this->user, $this->password);
						break;
					case "mysql":
						$this->con = (is_numeric($this->port)) ? new PDO("mysql:host=".$this->host.";port=".$this->port.";dbname=".$this->database, $this->user, $this->password) : new PDO("mysql:host=".$this->host.";dbname=".$this->database, $this->user, $this->password);
						break;
					case "sqlite2": //ej: "sqlite:/path/to/database.sdb"
						$this->con = new PDO("sqlite:".$this->host);
						break;
					case "sqlite3":
						$this->con = new PDO("sqlite::memory");
						break;
					case "pg":
						$this->con = (is_numeric($this->port)) ? new PDO("pgsql:dbname=".$this->database.";port=".$this->port.";host=".$this->host, $this->user, $this->password) : new PDO("pgsql:dbname=".$this->database.";host=".$this->host, $this->user, $this->password);
						break;
					default:
						$this->con = null;
						break;






*/










	try
		{
			$ConexionPDO = new PDO("mysql:dbname=$BaseDatos;host=$Servidor","$UsuarioBD","$PasswordBD");
			$ConexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::PARAM_INT);
		}
	catch( PDOException $ErrorPDO)
		{
			echo "<hr><center><blink><b><font color=yellow>ATENCION:</font></b></blink> Error de conexion con la base de datos.<br>Verifique los valores existentes en el archivo <b>configuracion.php</b> y la disponibilidad de PDO y modulos asociados a su motor de bases de datos en su <b>php.ini</b>.  <br><b>Detalles:</b> ".$ErrorPDO->getMessage()."</center><hr>";
			
		}
/*
foreach(PDO::getAvailableDrivers() as $driver)
{
echo $driver;
} */



	function consultar_tablas($driver_activo_pdo)
		{
			/*
				Function: consultar_tablas
				Para operaciones no soportadas por PDO.  Consulta las tablas disponibles dentro de una base de datos y las devuelve como listado.

				Variables de entrada:

					driver_activo_pdo - El driver detectado en la conexion activa de PDO
					
				Salida:
					Listado estandarizado de las tablas disponibles
				
				Ver tambien:
				<Definicion de conexion PDO>
			*/
			if ($driver_activo_pdo=="mysql")
				{
					
				}
		}

?>
