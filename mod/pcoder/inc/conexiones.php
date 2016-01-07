<?php
	/*
	   PCODER (Editor de Codigo en la Nube)
	   Sistema de Edicion de Codigo basado en PHP
	   Copyright (C) 2013  John F. Arroyave Gutiérrez
						   unix4you2@gmail.com
						   www.practico.org

	 This program is free software: you can redistribute it and/or modify
	 it under the terms of the GNU General Public License as published by
	 the Free Software Foundation, either version 3 of the License, or
	 (at your option) any later version.

	 This program is distributed in the hope that it will be useful,
	 but WITHOUT ANY WARRANTY; without even the implied warranty of
	 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 GNU General Public License for more details.

	 You should have received a copy of the GNU General Public License
	 along with this program.  If not, see <http://www.gnu.org/licenses/>
	*/

	/*
		Title: Conexiones PDO
		Ubicacion *[/core/conexiones.php]*.  Define las conexiones para uso de base de datos mediante PDO

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




/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_NuevaConexionBD
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
	function PCO_NuevaConexionBD($PCOConnMotorBD,$PCOConnPuertoBD,$PCOConnBaseDatos,$PCOConnServidorBD,$PCOConnUsuarioBD,$PCOConnPasswordBD)
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
					if ($PCOConnMotorBD=="pgsql")
						{
							// Si no se ha definido un numero de puerto
							if ($PCOConnPuertoBD=="")
								$ConexionPDO = new PDO("pgsql:dbname=$PCOConnBaseDatos;host=$PCOConnServidorBD","$PCOConnUsuarioBD","$PCOConnPasswordBD");
							else
								$ConexionPDO = new PDO("pgsql:dbname=$PCOConnBaseDatos;host=$PCOConnServidorBD;port=$PCOConnPuertoBD","$PCOConnUsuarioBD","$PCOConnPasswordBD");
						}
					if ($PCOConnMotorBD=="sqlite")
						{
							//Si se encuentra en tiempo de instalacion añade prefijo para guardar BD en nivel superior
							if (@$tiempo_instalacion_activa==1)
								$PCOConnBaseDatos="../".$PCOConnBaseDatos;
							$ConexionPDO = new PDO("sqlite:$PCOConnBaseDatos");  // SQLite 3??? $ConexionPDO = new PDO("sqlite::memory");	
						}
					if ($PCOConnMotorBD=="fbd")
								$ConexionPDO = new PDO("firebird:dbname=$PCOConnServidorBD".":"."$PCOConnBaseDatos","$PCOConnUsuarioBD","$PCOConnPasswordBD");
					if ($PCOConnMotorBD=="oracle")
								$ConexionPDO = new PDO("OCI:dbname=$PCOConnBaseDatos;charset=UTF-8","$PCOConnUsuarioBD","$PCOConnPasswordBD");
					if ($PCOConnMotorBD=="mssql")
								$ConexionPDO = new PDO("mssql:dbname=$PCOConnBaseDatos;host=$PCOConnServidorBD","$PCOConnUsuarioBD","$PCOConnPasswordBD");
					if ($PCOConnMotorBD=="sqlsrv")
								$ConexionPDO = new PDO("sqlsrv:database=$PCOConnBaseDatos;server=$PCOConnServidorBD","$PCOConnUsuarioBD","$PCOConnPasswordBD");
					if ($PCOConnMotorBD=="ibm")
								$ConexionPDO = new PDO("ibm:DRIVER={IBM DB2 ODBC DRIVER};DATABASE=$PCOConnBaseDatos; HOSTNAME=$PCOConnServidorBD; PORT=$PCOConnPuertoBD; PROTOCOL=TCPIP;","$PCOConnUsuarioBD","$PCOConnPasswordBD");
					if ($PCOConnMotorBD=="dblib")
								$ConexionPDO = new PDO("dblib:dbname=$PCOConnBaseDatos;host=$PCOConnServidorBD".":"."$PCOConnPuertoBD","$PCOConnUsuarioBD","$PCOConnPasswordBD");
					if ($PCOConnMotorBD=="odbc")
								$ConexionPDO = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb)};Dbq=C:\accounts.mdb;Uid=$PCOConnUsuarioBD");
					if ($PCOConnMotorBD=="ifmx")
								$ConexionPDO = new PDO("informix:DSN=InformixDB","$PCOConnUsuarioBD","$PCOConnPasswordBD");


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

					//$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
					//$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
					//$this->con->setAttribute(PDO::SQLSRV_ATTR_DIRECT_QUERY => true);
					
					//Retorna la variable de conexion creada
					return $ConexionPDO;
				}
			catch( PDOException $ErrorPDO)
				{
					@include_once("core/comunes.php"); //Incluye la libreria de base al menos para presentar mensaje de error
					$mensaje_final="Error de conexion con la base de datos. <hr>Verifique los valores existentes en el archivo <b>configuracion.php</b> y la disponibilidad de PDO y modulos asociados a su motor de bases de datos en su <b>php.ini</b>.";
					mensaje('<i class="fa fa-warning fa-3x text-danger texto-blink"></i> '.$mensaje_final, "<li><b>Detalles:</b> ".$ErrorPDO->getMessage(), '', '', 'alert alert-danger alert-dismissible');
					$hay_error=1; //usada globalmente durante el proceso de instalacion
				}
			
		}


