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
		<Definicion de conexion PDO> | <Configuracion base> | <informacion_conexion>
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
			return $ConexionPDO;
		}
	catch( PDOException $ErrorPDO)
		{
			echo "<hr><center><blink><b><font color=yellow>ATENCION:</font></b></blink> Error de conexion con la base de datos.<br>Verifique los valores existentes en el archivo <b>configuracion.php</b> y la disponibilidad de PDO y modulos asociados a su motor de bases de datos en su <b>php.ini</b>.  <br><b>Detalles:</b> ".$ErrorPDO->getMessage()."</center><hr>";
		}


/*
REVISAR ESTE OTRO:
http://www.phpclasses.org/browse/file/34541.html
http://www.phpclasses.org/package/6809-PHP-Access-different-types-of-SQL-database-using-PDO.html
*/




	function informacion_conexion()
		{
			/*
				Function: informacion_conexion
				Imprime la informacion asociada a la conexion establecida mediante PDO.

				Ver tambien:
				<imprimir_drivers_disponibles> | <Definicion de conexion PDO>
			*/
			echo "<hr><center><blink><b><font color=yellow>Informaci&oacute;n de conexi&oacute;n:</font></b></blink><br>";
			echo "Driver: ".$ConexionPDO->getAttribute(PDO::ATTR_DRIVER_NAME)."<br>";
			echo "Versi&oacute;n del servidor: ".$ConexionPDO->getAttribute(PDO::ATTR_SERVER_VERSION)."<br>";
			echo "Estado: ".$ConexionPDO->getAttribute(PDO::ATTR_CONNECTION_STATUS)."<br>";
			echo "Versi&oacute;n del cliente: ".$ConexionPDO->getAttribute(PDO::ATTR_CLIENT_VERSION)."<br>";
			echo "Informaci&oacute;n adicional: ".$ConexionPDO->getAttribute(PDO::ATTR_SERVER_INFO)."<hr>";
		}

	function imprimir_drivers_disponibles()
		{
			/*
				Function: imprimir_drivers_disponibles
				Imprime el arreglo devuelto por la funcion getAvailableDrivers() para conocer los drivers soportados por la instalacion actual de PHP del lado del servidor.

				Salida:
					Listado de drivers PDO soportados
				
				Ver tambien:
				<informacion_conexion>
			*/
			
			/*foreach(PDO::getAvailableDrivers() as $driver)
				{
					echo "<hr>".$driver;
				}*/
			print_r(PDO::getAvailableDrivers());
		}
		
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


















/*
	//Execute the transactional operations
	function transaction($arg){
		$this->err_msg = "";
		if($this->con!=null){
			try{
				if($arg=="B")
					$this->con->beginTransaction();
				elseif($arg=="C")
					$this->con->commit();
				elseif($arg=="R")
					$this->con->rollBack();
				else{
					$this->err_msg = "Error: The passed param is wrong! just allow [B=begin, C=commit or R=rollback]";
					return false;
				}
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	//Iterate over rows
	function query($sql_statement){
		$this->err_msg = "";
		if($this->con!=null){
			try{
				$this->sql=$sql_statement;
				return $this->con->query($this->sql);
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	//Querys Anti SQL Injections
	function query_secure($sql_statement, $params, $fetch_rows=false, $unnamed=false, $delimiter="|"){
		$this->err_msg = "";
		if(!isset($unnamed)) $unnamed = false;
		if(trim((string)$delimiter)==""){
			$this->err_msg = "Error: Delimiter are required.";
			return false;
		}
		if($this->con!=null){
			$obj = $this->con->prepare($sql_statement);
			if(!$unnamed){
				for($i=0;$i<count($params);$i++){
					$params_split = explode($delimiter,$params[$i]);
					(trim($params_split[2])=="INT") ? $obj->bindParam($params_split[0], $params_split[1], PDO::PARAM_INT) : $obj->bindParam($params_split[0], $params_split[1], PDO::PARAM_STR);
				}
				try{
					$obj->execute();
				}catch(PDOException $e){
					$this->err_msg = "Error: ". $e->getMessage();
					return false;
				}
			}else{
				try{
					$obj->execute($params);
				}catch(PDOException $e){
					$this->err_msg = "Error: ". $e->getMessage();
					return false;
				}
			}
			if($fetch_rows)
				return $obj->fetchAll();
			if(is_numeric($this->con->lastInsertId()))
				return $this->con->lastInsertId();
			return true;
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	//Fetch the first row
	function query_first($sql_statement){
		$this->err_msg = "";
		if($this->con!=null){
			try{
				$sttmnt = $this->con->prepare($sql_statement);
				$sttmnt->execute();
				return $sttmnt->fetch();
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	//Select single table cell from first record
	function query_single($sql_statement){
		$this->err_msg = "";
		if($this->con!=null){
			try{
				$sttmnt = $this->con->prepare($sql_statement);
				$sttmnt->execute();
				return $sttmnt->fetchColumn();
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	//Return total records from query as integer
	function rowcount(){
		$this->err_msg = "";
		if($this->con!=null){
			try{
				$stmnt_tmp = $this->stmntCount($this->sql);
				if($stmnt_tmp!=false && $stmnt_tmp!=""){
					return $this->query_single($stmnt_tmp);
				}else{
					$this->err_msg = "Error: A few data required.";
					return -1;
				}
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return -1;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	//Return name columns as vector
	function columns($table){
		$this->err_msg = "";
		$this->sql="SELECT * FROM $table";
		if($this->con!=null){
			try{
				$q = $this->con->query($this->sql);
				$column = array();
				foreach($q->fetch(PDO::FETCH_ASSOC) as $key=>$val){
					$column[] = $key;
				}
				return $column;
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	//Insert and get newly created id
	function insert($table, $data){
		$this->err_msg = "";
		if($this->con!=null){
			try{
				$txt_fields = "";
				$txt_values = "";
				$data_column = explode(",", $data);
				for($x=0;$x<count($data_column);$x++){
					list($field, $value) = explode("=", $data_column[$x]);
					$txt_fields.= ($x==0) ? $field : ",".$field;
					$txt_values.= ($x==0) ? $value : ",".$value;
				}
				$this->con->exec("INSERT INTO ".$table." (".$txt_fields.") VALUES(".$txt_values.");");
				return $this->con->lastInsertId();
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	//Update tables
	function update($table, $data, $condition=""){
		$this->err_msg = "";
		if($this->con!=null){
			try{
				return (trim($condition)!="") ? $this->con->exec("UPDATE ".$table." SET ".$data." WHERE ".$condition.";") : $this->con->exec("UPDATE ".$table." SET ".$data.";");
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	//Delete records from tables
	function delete($table, $condition=""){
		$this->err_msg = "";
		if($this->con!=null){
			try{
				return (trim($condition)!="") ? $this->con->exec("DELETE FROM ".$table." WHERE ".$condition.";") : $this->con->exec("DELETE FROM ".$table.";");
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	//Execute Store Procedures
	function execute($sp_query){
		$this->err_msg = "";
		if($this->con!=null){
			try{
				$this->con->exec($sp_query);
				return true;
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	//Get latest specified id from specified table
	function getLatestId($db_table, $table_field){
		$this->err_msg = "";
		$sql_statement = "";
		$dbtype = $this->database_type;

		if($dbtype=="sqlsrv" || $dbtype=="mssql" || $dbtype=="ibm" || $dbtype=="dblib" || $dbtype=="odbc"){
			$sql_statement = "SELECT TOP 1 ".$table_field." FROM ".$db_table." ORDER BY ".$table_field." DESC;";
		}elseif($dbtype=="oracle"){
			$sql_statement = "SELECT ".$table_field." FROM ".$db_table." WHERE ROWNUM<=1 ORDER BY ".$table_field." DESC;";
		}elseif($dbtype=="ifmx" || $dbtype=="fbd"){
			$sql_statement = "SELECT FIRST 1 ".$table_field." FROM ".$db_table." ORDER BY ".$table_field." DESC;";
		}elseif($dbtype=="mysql" || $dbtype=="sqlite2" || $dbtype=="sqlite3"){
			$sql_statement = "SELECT ".$table_field." FROM ".$db_table." ORDER BY ".$table_field." DESC LIMIT 1;";
		}elseif($dbtype=="pg"){
			$sql_statement = "SELECT ".$table_field." FROM ".$db_table." ORDER BY ".$table_field." DESC LIMIT 1 OFFSET 0;";
		}

		if($this->con!=null){
			try{
				return $this->query_single($sql_statement);
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	//Get all tables from specified database
	function ShowTables($database){
		$this->err_msg = "";
		$complete = "";
		$sql_statement = "";
		$dbtype = $this->database_type;

		if($dbtype=="sqlsrv" || $dbtype=="mssql" || $dbtype=="ibm" || $dbtype=="dblib" || $dbtype=="odbc" || $dbtype=="sqlite2" || $dbtype=="sqlite3"){
			$sql_statement = "SELECT name FROM sysobjects WHERE xtype='U';";
		}elseif($dbtype=="oracle"){
			//If the query statement fail, try with uncomment the next line:
			//$sql_statement = "SELECT table_name FROM tabs;";
			$sql_statement = "SELECT table_name FROM cat;";
		}elseif($dbtype=="ifmx" || $dbtype=="fbd"){
			$sql_statement = 'SELECT RDB$RELATION_NAME FROM RDB$RELATIONS WHERE RDB$SYSTEM_FLAG = 0 AND RDB$VIEW_BLR IS NULL ORDER BY RDB$RELATION_NAME;';
		}elseif($dbtype=="mysql"){
			if($database!="") $complete=" FROM $database";
			$sql_statement = "SHOW tables ".$complete.";";
		}elseif($dbtype=="pg"){
			$sql_statement = "SELECT relname AS name FROM pg_stat_user_tables ORDER BY relname;";
		}

		if($this->con!=null){
			try{
				$this->sql=$sql_statement;
				return $this->con->query($this->sql);
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	//Get all databases from your server
	function ShowDBS(){
		$this->err_msg = "";
		$sql_statement = "";
		$dbtype = $this->database_type;

		if($dbtype=="sqlsrv" || $dbtype=="mssql" || $dbtype=="ibm" || $dbtype=="dblib" || $dbtype=="odbc" || $dbtype=="sqlite2" || $dbtype=="sqlite3"){
			$sql_statement = "SELECT name FROM sys.Databases;";
		}elseif($dbtype=="oracle"){
			//If the query statement fail, try with uncomment the next line:
			//$sql_statement = "SELECT * FROM user_tablespaces";
			$sql_statement = 'SELECT * FROM v$database;';
		}elseif($dbtype=="ifmx" || $dbtype=="fbd"){
			$sql_statement = "";
		}elseif($dbtype=="mysql"){
			$sql_statement = "SHOW DATABASES;";
		}elseif($dbtype=="pg"){
			$sql_statement = "SELECT datname AS name FROM pg_database;";
		}

		if($this->con!=null){
			try{
				$this->sql=$sql_statement;
				return $this->con->query($this->sql);
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	//Get the latest error ocurred in the connection
	function getError(){
		return trim($this->err_msg)!="" ? "<span style='display:block;color:#FF0000;background:#FFEDED;font-weight:bold;border:2px solid #FF0000;padding:2px 4px 2px 4px;margin-bottom:5px'>".$this->err_msg."</span><br />" : "";
	}

	//Disconnect database
	function disconnect(){
		$this->err_msg = "";
		if($this->con){
			$this->con = null;
			return true;
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	//Build the query neccesary for the count(*) in rowcount method
	function stmntCount($query_stmnt){
		if(trim($query_stmnt)!=""){
			$query_stmnt = trim($query_stmnt);
			$query_split = explode(" ",$query_stmnt);
			$query_flag = false;
			$query_final = "";

			for($x=0;$x<count($query_split);$x++){
				//Checking "SELECT"
				if($x==0 && strtoupper(trim($query_split[$x]))=="SELECT")
					$query_final = "SELECT count(*) ";
				if($x==0 && strtoupper(trim($query_split[$x]))!="SELECT")
					return false;

				//Checking "FROM"
				if(strtoupper(trim($query_split[$x]))=="FROM"){
					$query_final .= "FROM ";
					$query_flag = true;
					continue;
				}

				//Checking "ORDER"
				if(strtoupper(trim($query_split[$x]))=="ORDER" || strtoupper(trim($query_split[$x]))=="GROUP"){
					break;
				}

				//Building the query
				if(trim($query_split[$x])!="" && $query_flag)
					$query_final .= " " . trim($query_split[$x]) . " ";
			}
			return trim($query_final);
		}
		return false;
	}




/******************************************
 *
 * PDO Database Class Manual
 *
 * @author:    	Evert Ulises German Soto
 * @copyright: 	wArLeY996 2012
 * @version: 	2.1
 *
 *
 *		CHANGELOG:
 *
 * v2.1: Added transactional method, now you can feel the power and care for the integrity of your database with transactions.
 * v2.0: Optimized all class code, added unnamed placeholder option in query_secure(), added method properties() for get information about server and connection. Manual updated for provide more clearly examples.
 * v1.9: Added method for secure querys and avoid SQL Injections.
 * v1.8: Optimized methods update, delete and getLatestId. Methods update and delete allow empty conditions for several changes.
 * v1.7: Optimized method rowcount(), now build automatic query for count(*).
 * v1.6: Fix the error handler in the connection database, modified the constructor of the class. (Critical)
 * v1.5: Added 2 methods: 1.- ShowDBS and 2.- ShowTables, return databases existing on host, return all tables of database relatively.
 * v1.4: Added method getError(), this return error description if exist.
 * v1.3: Fix the "insert" operation works in any database.
 * v1.2: Added method getLatestId(table, id), return the latest id (primary key autoincrement).
 * v1.1: After insert, delete or update operations, the result is the affected rows.
 * v1.0: First version working.

 * 		INTRODUCTION:
 * Why you Should be using PHP's PDO for Database Access...
 * PDO – PHP Data Objects, is a database access layer providing a uniform method of access to multiple databases.
 * It doesn’t account for database-specific syntax, but can allow for the process of switching databases and platforms to be fairly painless, simply by switching the connection string in many instances.
 *
 *		DATABASES SUPPORT:
 *  You need use this shortcuts for the database type:
 *
 * sqlite2	-> SQLite2 - TESTED
 * sqlite3	-> SQLite3
 * sqlsrv 	-> Microsoft SQL Server (Works under Windows, accept all SQL Server versions [max version 2008]) - TESTED
 * mssql 	-> Microsoft SQL Server (Works under Windows and Linux, but just work with SQL Server 2000) - TESTED
 * mysql 	-> MySQL - TESTED
 * pg 		-> PostgreSQL - TESTED
 * ibm		-> IBM
 * dblib	-> DBLIB
 * odbc		-> Microsoft Access
 * oracle	-> ORACLE
 * ifmx 	-> Informix
 * fbd		-> Firebird - TESTED
 
 * 		HOW TO USE:
 * Ok, I hope the following lines of code will help...
 ************************************************************************************************************************************************/








/*

//First... you need include the class file.
require("pdo_database.class.php");

//Instantiate the class
# object = new wArLeY_DBMS(shortcut_database_type, server, database_name, user, password, port);
$db = new wArLeY_DBMS("mysql", "127.0.0.1", "test", "root", "", "");
$dbCN = $db->Cnxn(); //This step is really neccesary for create connection to database, and getting the errors in methods.
if($dbCN==false) die("Error: Cant connect to database.");
//Every operation you execute can try print this line, for get the latest error ocurred
echo $db->getError(); //Show error description if exist, else is empty.
//For get the conecction and server information only require this:
$db->properties();

//Creating table and execute all sql statements
#Drop table
$db->query('DROP TABLE TB_USERS;');
#Instruction SQL in variable
$query_create_table = <<< EOD
CREATE TABLE TB_USERS (
  ID INTEGER NOT NULL,
  NAME VARCHAR(100) NOT NULL,
  ADDRESS VARCHAR(100) NOT NULL,
  COMPANY VARCHAR(100) NOT NULL
);
EOD;
#Create table
$db->query($query_create_table);
#Alter table
$db->query('ALTER TABLE TB_USERS ADD CONSTRAINT INTEG_13 PRIMARY KEY (ID);');

//Inserting data in table with 2 methods...
//Method 1:
$result = $db->query("INSERT INTO TB_USERS (NAME, ADDRESS, COMPANY) VALUES ('Evert Ulises German', 'Internet #996 Culiacan Sinaloa', 'Freelancer');");
# $result false if operation fail.
//Method 2:
#insert(table_name, data_to_insert[field=data]);
$result = $db->insert("TB_USERS", "NAME='Evert Ulises German',ADDRESS='Tetameche #3035 Culiacan Sin. Mexico',COMPANY='Freelancer'");
# $result have the inserted id or false if operation fail. IMPORTANT: For getting the currently id inserted is neccessary define the id field how primary key autoincrement.

//Retrieving rows from query...
$rs = $db->query("SELECT NAME,ADDRESS FROM TB_USERS");
foreach($rs as $row){
	$tmp_name = $row["NAME"];
	$tmp_address = $row["ADDRESS"];
	echo "The user $tmp_name lives in: $tmp_address<br/>";
}

//Once that you have execute any query, you can get total rows.
echo "Total rows: " . $db->rowcount() . "<br/>";

//You can update rows from table with 2 methods...
//Method 1:
$db->query("UPDATE TB_USERS SET NAME='wArLeY996',COMPANY='Freelancer MX' WHERE ID=1;");
//Method 2:
# update(table_name, set_new_data[field=data], condition_if_need_but_not_required);
$getAffectedRows = $db->update("TB_USERS", "NAME='wArLeY996',COMPANY='Freelancer MX'", "ID=1");
$getAffectedRows = $db->update("TB_USERS", "NAME='wArLeY996',COMPANY='Freelancer MX'"); //This works too, must be careful!

//You can delete rows from table with 2 methods...
//Method 1:
$result = $db->query("DELETE FROM TB_USERS WHERE ID=1;");
# $result false if operation fail.
//Method 2:
# delete(table_name, condition_if_need_but_not_required);
$getAffectedRows = $db->delete("TB_USERS", "ID=1");
$getAffectedRows = $db->delete("TB_USERS"); //This works too, must be careful!

//You can get the latest id inserted in your table...
# getLatestId(table_name, field_id);
$latestInserted = $db->getLatestId("TB_USERS","ID");
//IMPORTANT: For getting the latest id inserted is neccessary define the id field how autoincrement.

//Disconnect from database
$db->disconnect();

# NEW!!!
//Using Transactions
$db->transaction("B"); //Begin the Transaction
$db->delete("TB_USERS", "ID=1");
$db->delete("TB_USERS", "ID=2");
$db->transaction("C"); //Commit and apply changes
$db->transaction("R"); //OR you can Rollback and undo changes like Ctrl+Z

#------------------------------------------ SECURE METHODS ANTI SQL INJECTIONS ----------------------------------------------------------------
# METHOD: query_secure, "first_param": query statement, "second_param": array with params, "third_param": if you specify true, you can get the recordset, else you get true, "fourth_param": unnamed or named placeholders is your choice, "fifth_param": for change your delimiter.
# Note: the third_param, fourth_param and fifth_param not are required, have a default values: false, false, "|" relatively.
# IMPORTANT: the delimiter default is "|" (pipe), is neccessary change this delimiter if exist in your data.
#----------------------------------------------------------------------------------------------------------------------------------------------
//SELECT statement with option "NAMED PLACEHOLDERS":
$params = array(":id|2|INT");
$rows = $db->query_secure("SELECT NAME FROM TB_USERS WHERE ID=:id;", $params, false);
if($rows!=false){
	foreach($rows as $row){
		echo "User: ". $row["NAME"] ."<br />";
	}
}
$rows = null;
//SELECT statement with option "UNNAMED PLACEHOLDERS":
$params = array(2);
$rows = $db->query_secure("SELECT NAME FROM TB_USERS WHERE ID=?;", $params, false);
if($rows!=false){
	foreach($rows as $row){
		echo "User: ". $row["NAME"] ."<br />";
	}
}
$rows = null;

//INSERT data with option "NAMED PLACEHOLDERS":
$params = array(":id|2|INT", ":name|Amy Julyssa German|STR", ":address|Internet #996 Culiacan Sinaloa|STR", ":company|Nothing|STR");
$result = $db->query_secure("INSERT INTO TB_USERS (ID,NAME,ADDRESS,COMPANY) VALUES(:id,:name,:address,:company);", $params, false);
//INSERT data with option "UNNAMED PLACEHOLDERS":
$params = array(2, "Amy Julyssa German", "Internet #996 Culiacan Sinaloa", "Nothing");
$result = $db->query_secure("INSERT INTO TB_USERS (ID,NAME,ADDRESS,COMPANY) VALUES(?,?,?,?);", $params, false, true);

//UPDATE data with option "NAMED PLACEHOLDERS":
$params = array(":id|2|INT", ":address|Internet #996 Culiacan, Sinaloa, Mexico|STR", ":company|Nothing!|STR");
$result = $db->query_secure("UPDATE TB_USERS SET ADDRESS=:address,COMPANY=:company WHERE ID=:id;", $params, false);
//UPDATE data with option "UNNAMED PLACEHOLDERS":
$params = array("Internet #996 Culiacan, Sinaloa, Mexico", "Nothing!", 2);
$result = $db->query_secure("UPDATE TB_USERS SET ADDRESS=?,COMPANY=? WHERE ID=?;", $params, false, true);

//DELETE data with option "NAMED PLACEHOLDERS":
$params = array(":id|2|INT");
$result = $db->query_secure("DELETE FROM TB_USERS WHERE ID=:id;", $params, false);
//DELETE data with option "UNNAMED PLACEHOLDERS":
$params = array(2);
$result = $db->query_secure("DELETE FROM TB_USERS WHERE ID=?;", $params, false, true);

//IMPORTANT: UPDATE and DELETE works fine but not return the affected rows, just return false if fails.
echo "AFFECTEDS -> " . (($result===false) ? "NO... ".$db->getError() : "YES") . "<br />";

//----------------------------------------------------------------------------------------------------------------

//For general information are added this methods:
//If you need get columns name, you can do it...
$column_array = $db->columns("TB_USERS");
if($column_array!=false){
	foreach($column_array as $column){
		echo "$column<br/>";
	}
}else{
	//ERROR
	echo $db->getError();
}

//If you need get all tables from you database...
$rs = $db->ShowTables("test");  //Depending of your type database you can specify the database
foreach($rs as $row){
	$tmp_table = $row[0];
	echo "The table from database is: $tmp_table<br/>";
}

//If you need get all databases of your server...
$rs = $db->ShowDBS();  //Depending of your type database you can get results
foreach($rs as $row){
	$tmp_table = $row[0];
	echo "Database named: $tmp_table<br/>";
}





*/

?>
