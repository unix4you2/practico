<?php
	/*
		Title: Libreria base 
		Ubicacion *[/core/comunes.php]*.  Archivo que contiene las funciones de uso global.
	*/

/* ################################################################## */
	/*
		Section: Funciones asociadas a las operaciones con bases de datos - Ejecucion de consultas
	*/

/* ################################################################## */
	function ejecutar_sql($query,$param="")
		{
			/*
				Function: ejecutar_sql
				Ejecuta consultas que retornan registros (SELECTs).

				Variables de entrada:

					query - Consulta preformateada para ser ejecutada en el motor
					param - Lista de parametros que deben ser preparados para el query separados por coma
					
				Salida:
					Retorna mensaje en pantalla con la descripcion devuelta por el driver en caso de error
					Retorna una variable con el arreglo de resultados en caso de ser exitosa la consulta
			*/
			global $ConexionPDO;
			try
				{
					$consulta = $ConexionPDO->prepare($query);
					$consulta->execute();
					return $consulta;
					//return $consulta->fetchAll();
				}
			catch( PDOException $ErrorPDO)
				{
					mensaje('Error durante la ejecuci&oacute;n',$ErrorPDO->getMessage(),'90%','icono_error.png','TextosEscritorio');
					return 1;
				}
		}

/* ################################################################## */
	function ejecutar_sql_unaria($query,$param="")
		{
			/*
				Function: ejecutar_sql_unaria
				Ejecuta consultas que no retornan registros tales como CREATE, INSERT, DELETE, UPDATE entre otros.

				Variables de entrada:

					query - Consulta preformateada para ser ejecutada en el motor
					param - Lista de parametros que deben ser preparados para el query separados por coma

				Salida:
					Retorna una cadena que contiene una descripcion de error PDO en caso de error y agrega un mensaje en pantalla con la descripcion devuelta por el driver
					Retorna una cadena vacia si la consulta es ejecutada sin problemas.
			*/
			global $ConexionPDO;
			try
				{
					$consulta = $ConexionPDO->prepare($query);
					$consulta->execute();
					return "";
				}
			catch( PDOException $ErrorPDO)
				{
					echo '<script language="JavaScript"> alert("Ha ocurrido un error interno durante la ejecucion del Query: '.$query.'\n\nEl motor ha devuelto: '.$ErrorPDO->getMessage().'.\n\nPongase en contacto con el administrador del sistema y comunique este mensaje.");  </script>';					
					//mensaje('Error durante la ejecuci&oacute;n',$ErrorPDO->getMessage(),'90%','icono_error.png','TextosEscritorio');
					return $ErrorPDO->getMessage();
				}
		}

/* ################################################################## */
	function ejecutar_sql_procedimiento($procedimiento)
		{
			/*
				Function: ejecutar_sql_procedimiento
				Ejecuta procedimientos almacenados por la base de datos

				Variables de entrada:

					procedimiento - Procedimiento que debe residir en la base de datos y que ha de ser ejecutado

				Salida:
					Retorna 0 en caso de tener problemas con la ejecucion del procedimiento
					Retorna una cadena vacia si el procedimiento es llamado y ejecutado sin problemas
			*/
			global $ConexionPDO;
			try
				{
					$ConexionPDO->exec($procedimiento);
					return "";
				}
			catch(PDOException $e)
				{
					return $e->getMessage();
				}
		}

/* ################################################################## */
	function existe_valor($tabla,$campo,$valor)
		{
			/*
				Function: existe_valor
				Busca dentro de alguna tabla para verificar si existe o no un valor determinado.  Funcion utilizada para validacion de unicidad de valores en formularios de datos.
				
				Variables de entrada:

					tabla - Nombre de la tabla donde se desea buscar.
					campo - Campo de la tabla sobre el cual se desea comparar la existencia del valor.
					valor - Valor a buscar dentro del campo.
					
				Salida:
					Retorna 1 en caso de encontrar un valor dentro de la tabla y campo especificadas y que coincida con el parametro buscado
					Retorna 0 cuando no se encuentra un valor en la tabla que coincida con el buscado
			*/
			global $ConexionPDO;
			$consulta = $ConexionPDO->prepare("SELECT $campo FROM $tabla WHERE $campo='$valor'");
			$consulta->execute();
			$registro = $consulta->fetch();
			if ($registro[0]!="")
				{
					return 1;
				}
			else
				{
					return 0;
				}
		}

/* ################################################################## */
	/*
		Section: Funciones asociadas al retorno de informacion sobre la conexion y estructura de la BD
	*/

/* ################################################################## */
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

/* ################################################################## */
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

/* ################################################################## */
	function consultar_tablas($prefijo)
		{
			/*
				Function: consultar_tablas
				Determina las tablas en la base de datos activa para la conexion dependiendo del motor utilizado.

				Variables de entrada:

					prefijo - Prefijo del nombre de tablas que seran retornadas

				Salida:
					Resultado de un query con las tablas  o falso en caso de error
				
				Ver tambien:
				<Definicion de conexion PDO>
			*/
			global $ConexionPDO;
			global $MotorBD;
			global $BaseDatos;

			if($MotorBD=="sqlsrv" || $MotorBD=="mssql" || $MotorBD=="ibm" || $MotorBD=="dblib" || $MotorBD=="odbc" || $MotorBD=="sqlite2" || $MotorBD=="sqlite3")
					$consulta = "SELECT name FROM sysobjects WHERE xtype='U';";
			if($MotorBD=="oracle")
					$consulta = "SELECT table_name FROM cat;";  //  Si falla probar con esta:  $consulta = "SELECT table_name FROM tabs;";
			if($MotorBD=="ifmx" || $MotorBD=="fbd")
					$consulta = "SELECT RDB$RELATION_NAME FROM RDB$RELATIONS WHERE RDB$SYSTEM_FLAG = 0 AND RDB$VIEW_BLR IS NULL ORDER BY RDB$RELATION_NAME;";
			if($MotorBD=="mysql")
					$consulta = "SHOW tables FROM ".$BaseDatos." ";
			if($MotorBD=="pg")
					$consulta = "SELECT relname AS name FROM pg_stat_user_tables ORDER BY relname;";

			try
				{
					$consulta_tablas=ejecutar_sql($consulta);
					return $consulta_tablas;
				}
			catch( PDOException $ErrorPDO)
				{
					mensaje('Error durante la ejecuci&oacute;n',$ErrorPDO->getMessage(),'90%','icono_error.png','TextosEscritorio');
					return false;
				}
		}

/* ################################################################## */
	function consultar_columnas($tabla)
		{
			/*
				Function: consultar_columnas
				Devuelve un vector con los nombres de las columnas de una tabla

				Variables de entrada:

					tabla - Nombre de la tabla de la que se desea consultar los nombre de columnas o campos
					
				Salida:
					Vector de campos/columnas
				
				Ver tambien:
				<consultar_tablas>
			*/
			$resultado=ejecutar_sql("SELECT * FROM ".$tabla);
			$columnas = array();
			foreach($resultado->fetch(PDO::FETCH_ASSOC) as $key=>$val)
				{
					$columnas[] = $key;
				}
			return $columnas;
		}

/* ################################################################## */
	function consultar_bases_de_datos()
		{
			/*
				Function: consultar_bases_de_datos
				Determina las bases de datos existentes dependiendo del motor utilizado.

				Salida:
					Resultado de un query con las bases de datos o falso en caso de error
				
				Ver tambien:
				<Definicion de conexion PDO> | <consultar_tablas>
			*/
			global $ConexionPDO;
			global $MotorBD;
			global $BaseDatos;

			if($MotorBD=="sqlsrv" || $MotorBD=="mssql" || $MotorBD=="ibm" || $MotorBD=="dblib" || $MotorBD=="odbc" || $MotorBD=="sqlite2" || $MotorBD=="sqlite3")
				$consulta = "SELECT name FROM sys.Databases;";
			if($MotorBD=="oracle")
				$consulta = 'SELECT * FROM v$database;';  //Si falla intentar con este: $consulta = "SELECT * FROM user_tablespaces";
			if($MotorBD=="ifmx" || $dbtype=="fbd")
				$consulta = "";
			if($MotorBD=="mysql")
				$consulta = "SHOW DATABASES;";
			if($MotorBD=="pg")
				$consulta = "SELECT datname AS name FROM pg_database;";

			try
				{
					$consulta_basesdatos = $ConexionPDO->prepare($consulta);
					$consulta_basesdatos->execute();
					return $consulta_basesdatos;
				}
			catch( PDOException $ErrorPDO)
				{
					mensaje('Error durante la ejecuci&oacute;n',$ErrorPDO->getMessage(),'90%','icono_error.png','TextosEscritorio');
					return false;
				}
	}

/* ################################################################## */
	function ContarRegistros($tabla)
		{
			global $ConexionPDO;
			$consulta = $ConexionPDO->prepare("SELECT count(*) FROM $tabla");
			$consulta->execute();
			$filas = $consulta->fetchColumn();
			return $filas;
		}
/* ################################################################## */


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






/* ################################################################## */
	/*
		Section: Funciones asociadas a la creacion de elementos graficos (ventanas, etc)
	*/
/* ################################################################## */
	function ventana_login()
	  {
		/*
			Function: ventana_login
			Despliega la ventana de ingreso al sistema con el formulario para usuario, contrasena y captcha.
		*/
		  global $ArchivoCORE;
			echo '
					<br><br>
					<div align="center">
					';
			abrir_ventana('Ingreso al sistema','#EADEDE','620');
			?>
						<div align="center">
						<form name="login_usuario" method="POST" action="<?php echo $ArchivoCORE; ?>" style="margin-top: 0px; margin-bottom: 0px;" onsubmit="if (document.login_usuario.captcha.value=='' || document.login_usuario.uid.value=='' || document.login_usuario.clave.value=='') { alert('Debe diligenciar los valores necesarios (Usuario, Clave y Codigo de seguridad).'); return false; }">
						<input type="Hidden" name="accion" value="Iniciar_login">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr>
								<td align="center">
										<table width="100%" border="0" cellspacing="10" cellpadding="0" class="TextosVentana" align="center">
										<tr>
											<td align="right"><font face="Verdana,Tahoma, Arial" style="font-size: 9px;">Usuario&nbsp;</td>
											<td><input type="text" name="uid" size="18" class="CampoTexto" class="keyboardInput"></td>
										</tr>
										<tr>
											<td align="right"><font face="Verdana,Tahoma, Arial" style="font-size: 9px;">Contrase&ntilde;a&nbsp;</td>
											<td><input type="password" name="clave" size="18" class="CampoTexto keyboardInput" class="keyboardInput" style="border-width: 1px; font-size: 9px; font-family: VErdana, Tahoma, Arial;"></td>
										</tr>
										<tr>
											<td align="right" valign="middle"><font face="Verdana,Tahoma, Arial" style="font-size: 9px;">Codigo de seguridad</td>
											<td valign="middle">
											<img src="core/captcha.php">
											</td>
										</tr>
										<tr>
											<td width="150" align="right" valign="middle"><font face="Verdana,Tahoma, Arial" style="font-size: 9px;">Ingrese aqui el codigo de seguridad</td>
											<td valign="middle">
											<img src="img/tango/16x16/actions/go-next.png" align="absmiddle"> <input type="text" name="captcha" size="7" maxlength=6 style="border-width: 1px; font-size: 9px; font-family: VErdana, Tahoma, Arial;">
											</td>
										</tr>
										<tr>
											<td></td>
											<td>
											<input type="image" src="img/ingresa.gif">
											</td>
										</tr>
										</table>
								</td>
								<td align="center">
										<img src="img/practico_login.png" alt="" border="0">
								</td>
						</tr></table>
						</form>
						<script language="JavaScript"> login_usuario.uid.focus(); </script>
						</div>
						
			<?php
			mensaje('Importante','El acceso a este software es exlusivo para usuarios registrados. Por su seguridad, nunca comparta su nombre de usuario y contrase&ntilde;a.','100%','../img/tango/32x32/status/dialog-information.png','TextosVentana');
			cerrar_ventana();
			echo '</div>';
	  }

/* ################################################################## */
	function abrir_ventana($titulo,$fondo,$ancho='100%')
	  {
		global $PlantillaActiva;
		/*
			Procedure: abrir_ventana
			Abre los espacios de trabajo dinamicos sobre el contenedor principal donde se despliega informacion

			Variables de entrada:

				titulo - Nombre de la ventana a visualizar en la parte superior.  Acepta modificadores HTML.
				fondo - Color de fondo de la ventana en formato Hexadecimal. Si no es enviado se crea transparente.  Si llega un nombre de imagen es usado.
				ancho - Ancho del espacio de trabajo definido en pixels o porcentaje sobre el contenedor principal.
				
			Ver tambien:
			<cerrar_ventana>	
		*/

		// Determina si fue enviado un nombre de archivo como fondo y lo usa
		$ruta_fondo_imagen='';
		$color_fondo='';
		if (strpos($fondo, ".png") || strpos($fondo, ".jpg") || strpos($fondo, ".gif"))
			$ruta_fondo_imagen='skin/'.$PlantillaActiva.'/img/'.$fondo;
		else
			$color_fondo=$fondo;

		echo '
			<table width="'.$ancho.'" border="0" cellspacing="0" cellpadding="0" class="EstiloVentana">
				<tr>
					<td>
							<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
									<td><img src="skin/'.$PlantillaActiva.'/img/bar_i.gif" border=0 alt=" "></td>
									<td width="100%" align="CENTER" background="skin/'.$PlantillaActiva.'/img/bar_c.jpg">
										<font face="" style="font-family: Verdana, Tahoma, Arial; font-size: 10px; color: Black;"><b>
												'.$titulo.'
										</b></font>
									</td>
									<td><img src="skin/'.$PlantillaActiva.'/img/bar_d.gif " border=0 alt=""></td>
							</tr></table>
					</td>
				</tr>
				<tr>
					<td width="100%" align="CENTER">
							<table width="100%" border="1" cellspacing="0" cellpadding="0" align="center"  bgcolor="'.$color_fondo.'" BACKGROUND="'.$ruta_fondo_imagen.'" class="TextosVentana"><tr><td>
				';
	  }

/* ################################################################## */
	function cerrar_ventana()
	  {
		/*
			Function: cerrar_ventana
			Cierra los espacios de trabajo dinamicos generados por <abrir_ventana>	

			Ver tambien:
			<abrir_ventana>	
		*/
			echo '
							</td></tr></table>
					</td>
				</tr>
			</table>
				';		  
	  }

/* ################################################################## */
	function abrir_barra_estado($alineacion="CENTER")
	  {
		 global $PlantillaActiva;
		/*
			Procedure: abrir_barra_estado
			Abre los espacios para despliegue de informacion en la parte inferior de los objetos tales como botones o mensajes

			Variables de entrada:

				alineacion - Alineacion que tendran los objetos en la barra (center, left, right).  Por defecto CENTER cuando no es recibido el parametro
				
			Ver tambien:
			<cerrar_barra_estado>	
		*/

		echo '
			<table width="100%" border="0" cellspacing="0" cellpadding="1" class="EstiloBarraEstado">
				<tr>
					<td width="100%" align="'.$alineacion.'">
				';
	  }

/* ################################################################## */
	function cerrar_barra_estado()
	  {
		/*
			Function: cerrar_barra_estado
			Cierra los espacios de trabajo dinamicos generados por <abrir_barra_estado>

			Ver tambien:
			<abrir_barra_estado>	
		*/
			echo '
					</td>
				</tr>
			</table>
				';		  
	  }

/* ################################################################## */
	function mensaje($titulo,$texto,$ancho,$icono,$estilo)
	  {
		/*
			Function: mensaje
			Funcion generica para la presentacion de mensajes.  Ver variables para personalizacion.

			Variables de entrada:

				titulo - Texto que aparece en resaltado como encabezado del texto.  Acepta modificadores HTML.
				texto - Mensaje completo a desplegar en formato de texto normal.  Acepta modificadores HTML.
				icono - Imagen que acompana el texto ubicada al lado izquierdo.  Tamano y formato libre.
				ancho - Ancho del espacio de trabajo definido en pixels o porcentaje sobre el contenedor principal.
				estilo - Especifica el punto donde sera publicado el mensaje para definir la hoja de estilos correspondiente.
		*/
		echo '<table width="'.$ancho.'" border="0" cellspacing="5" cellpadding="0" align="center" class="'.$estilo.'">
				<tr>
					<td valign="top"><img src="img/'.$icono.'" alt="" border="0">
					</td>
					<td valign="top"><strong>'.$titulo.':<br></strong>
					'.$texto.'
					</td>
				</tr>
			</table>';
	  }


/* ################################################################## */
	/*
		Section: Acciones a ser ejecutadas (si aplica) en cada cargue de la herramienta
	*/
/* ################################################################## */
	if ($accion=="cambiar_estado_campo")
		{		
			/*
				Function: cambiar_estado_campo
				Abre los espacios de trabajo dinamicos sobre el contenedor principal donde se despliega informacion

				Variables de entrada:

					tabla - Nombre de la tabla que contiene el registro a actualizar.
					campo - Nombre del campo que sera actualizado.
					id - Identificador unico del campo a ser actualizado.
					valor - Valor a ser asignado en el campo del registro cuyo identificador coincida con el recibido.

				Salida:

					Valor actualizado en el campo y retorno al escritorio de la aplicacion.  En caso de error se retorna al escritorio sin realizar cambios ante el fallo del query.
			*/

			$mensaje_error="";
			if ($mensaje_error=="")
				{
					ejecutar_sql_unaria("UPDATE ".$TablasCore."$tabla SET $campo = $valor WHERE id = '$id'");
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Id_usuario','Cambia estado del campo $campo en formulario $formulario','$fecha_operacion','$hora_operacion')");

					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="'.$accion_retorno.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="popup_activo" value="'.$popup_activo.'">
						<script type="" language="JavaScript">
						//setTimeout ("document.cancelar.submit();", 10); 
						document.cancelar.submit();
						</script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="editar_formulario">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="error_titulo" value="Problema en los datos ingresados">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}
?>
