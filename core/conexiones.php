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
