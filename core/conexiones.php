<?php
	/*
	Copyright (C) 2013  John F. Arroyave Gutiérrez
						unix4you2@gmail.com

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
				$ConexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
						$ConexionPDO = new PDO("mysql:dbname=$BaseDatos;host=$ServidorBD","$UsuarioBD","$PasswordBD");
					else
						$ConexionPDO = new PDO("mysql:dbname=$BaseDatos;host=$ServidorBD;port=$PuertoBD","$UsuarioBD","$PasswordBD");
				}
			if ($MotorBD=="pgsql")
				{
					// Si no se ha definido un numero de puerto
					if ($PuertoBD=="")
						$ConexionPDO = new PDO("pgsql:dbname=$BaseDatos;host=$ServidorBD","$UsuarioBD","$PasswordBD");
					else
						$ConexionPDO = new PDO("pgsql:dbname=$BaseDatos;host=$ServidorBD;port=$PuertoBD","$UsuarioBD","$PasswordBD");
				}
			if ($MotorBD=="sqlite")
						$ConexionPDO = new PDO("sqlite:$BaseDatos");  // SQLite 3??? $ConexionPDO = new PDO("sqlite::memory");
			if ($MotorBD=="fbd")
						$ConexionPDO = new PDO("firebird:dbname=$ServidorBD".":"."$BaseDatos","$UsuarioBD","$PasswordBD");
			if ($MotorBD=="oracle")
						$ConexionPDO = new PDO("OCI:dbname=$BaseDatos;charset=UTF-8","$UsuarioBD","$PasswordBD");
			if ($MotorBD=="mssql")
						$ConexionPDO = new PDO("mssql:dbname=$BaseDatos;host=$ServidorBD","$UsuarioBD","$PasswordBD");
			if ($MotorBD=="sqlsrv")
						$ConexionPDO = new PDO("sqlsrv:database=$BaseDatos;server=$ServidorBD","$UsuarioBD","$PasswordBD");
			if ($MotorBD=="ibm")
						$ConexionPDO = new PDO("ibm:DRIVER={IBM DB2 ODBC DRIVER};DATABASE=$BaseDatos; HOSTNAME=$ServidorBD; PORT=$PuertoBD; PROTOCOL=TCPIP;","$UsuarioBD","$PasswordBD");
			if ($MotorBD=="dblib")
						$ConexionPDO = new PDO("dblib:dbname=$BaseDatos;host=$ServidorBD".":"."$PuertoBD","$UsuarioBD","$PasswordBD");
			if ($MotorBD=="odbc")
						$ConexionPDO = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb)};Dbq=C:\accounts.mdb;Uid=$UsuarioBD");
			if ($MotorBD=="ifmx")
						$ConexionPDO = new PDO("informix:DSN=InformixDB","$UsuarioBD","$PasswordBD");

			// Establece parametros para la conexion
			$ConexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			// Evita el "General error: 2014 Cannot execute queries while other unbuffered queries are active"
			if ($MotorBD=="mysql")
				$ConexionPDO->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

			//$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			//$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
			//$this->con->setAttribute(PDO::SQLSRV_ATTR_DIRECT_QUERY => true);
		}
	catch( PDOException $ErrorPDO)
		{
			echo "<hr><center><blink><b><font color=yellow>ATENCION:</font></b></blink> Error de conexion con la base de datos.<br>Verifique los valores existentes en el archivo <b>configuracion.php</b> y la disponibilidad de PDO y modulos asociados a su motor de bases de datos en su <b>php.ini</b>.  <br><b>Detalles:</b> ".$ErrorPDO->getMessage()."</center><hr>";
			$hay_error=1; //usada globalmente durante el proceso de instalacion
		}

?>
