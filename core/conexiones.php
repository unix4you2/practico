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

			MotorBD - Motor de base de datos a utilizar en la conexion
			BaseDatos - Variable que contiene el nombre de la base de datos de trabajo
			Servidor - Nombre del host al que se debe conectar para accesar el motor de bases de datos
			UsuarioBD - Usuario con privilegios suficientes para operar sobre la base de datos
			PasswordBD - Contrasena del usuario que accesa al motor
			PuertoBD - Puerto a traves del cual se hace la conexion a la base de datos (si aplica)

		Proceso simplificado para MySQL (ver detalles sobre el codigo para otros motores):
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

	try
		{
			// Crea la conexion de acuerdo al tipo de motor
			if ($MotorBD=="mysql")
				{
					// Si no se ha definido un numero de puerto
					if ($PuertoBD=="")
						$ConexionPDO = new PDO("mysql:dbname=$BaseDatos;host=$Servidor","$UsuarioBD","$PasswordBD");
					else
						$ConexionPDO = new PDO("mysql:dbname=$BaseDatos;host=$Servidor;port=$PuertoBD","$UsuarioBD","$PasswordBD");
				}
			if ($MotorBD=="pg")
				{
					// Si no se ha definido un numero de puerto
					if ($PuertoBD=="")
						$ConexionPDO = new PDO("pgsql:dbname=$BaseDatos;host=$Servidor","$UsuarioBD","$PasswordBD");
					else
						$ConexionPDO = new PDO("mysql:dbname=$BaseDatos;host=$Servidor;port=$PuertoBD","$UsuarioBD","$PasswordBD");
				}
			if ($MotorBD=="sqlite2")
						$ConexionPDO = new PDO("sqlite:$BaseDatos");
			if ($MotorBD=="sqlite3")
						$ConexionPDO = new PDO("sqlite::memory");
			if ($MotorBD=="fbd")
						$ConexionPDO = new PDO("firebird:dbname=$Servidor".":"."$BaseDatos","$UsuarioBD","$PasswordBD");
			if ($MotorBD=="oracle")
						$ConexionPDO = new PDO("OCI:dbname=$BaseDatos;charset=UTF-8","$UsuarioBD","$PasswordBD");
			if ($MotorBD=="mssql")
						$ConexionPDO = new PDO("mssql:dbname=$BaseDatos;host=$Servidor","$UsuarioBD","$PasswordBD");
			if ($MotorBD=="sqlsrv")
						$ConexionPDO = new PDO("sqlsrv:database=$BaseDatos;server=$Servidor","$UsuarioBD","$PasswordBD");
			if ($MotorBD=="ibm")
						$ConexionPDO = new PDO("ibm:DRIVER={IBM DB2 ODBC DRIVER};DATABASE=$BaseDatos; HOSTNAME=$Servidor; PORT=$PuertoBD; PROTOCOL=TCPIP;","$UsuarioBD","$PasswordBD");
			if ($MotorBD=="dblib")
						$ConexionPDO = new PDO("dblib:dbname=$BaseDatos;host=$Servidor".":"."$PuertoBD","$UsuarioBD","$PasswordBD");
			if ($MotorBD=="odbc")
						$ConexionPDO = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb)};Dbq=C:\accounts.mdb;Uid=$UsuarioBD");
			if ($MotorBD=="ifmx")
						$ConexionPDO = new PDO("informix:DSN=InformixDB","$UsuarioBD","$PasswordBD");

			// Establece parametros para la conexion
			$ConexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::PARAM_INT);
			//$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			//$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
			//$this->con->setAttribute(PDO::SQLSRV_ATTR_DIRECT_QUERY => true);
		}
	catch( PDOException $ErrorPDO)
		{
			echo "<hr><center><blink><b><font color=yellow>ATENCION:</font></b></blink> Error de conexion con la base de datos.<br>Verifique los valores existentes en el archivo <b>configuracion.php</b> y la disponibilidad de PDO y modulos asociados a su motor de bases de datos en su <b>php.ini</b>.  <br><b>Detalles:</b> ".$ErrorPDO->getMessage()."</center><hr>";
			
		}



/*
REVISAR ESTE OTRO:
* http://www.phpclasses.org/browse/file/34541.html
http://www.phpclasses.org/package/6809-PHP-Access-different-types-of-SQL-database-using-PDO.html
*/


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
