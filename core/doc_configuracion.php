<?php
	/*
		// ESTE ARCHIVO SE MANTIENE COMO DOCUMENTACION ASOCIADA AL ARCHIVO configuracion.php, EL CUAL SOLO INCLUYE LAS DEFINICIONES DE VARIABLES
		// GENERADAS DURANTE EL PROCESO DE INSTALACION.  LOS VALORES AQUI PROPUESTOS SON SOLAMENTE EJEMPLOS.
		Title: Configuracion base 
		Ubicacion *[/core/configuracion.php]*.  Archivo que contiene la declaracion de variables basicas para conexion a bases de datos y otros
	*/
?>

<?php
	/*
		Section: Variables de conexion

		Crea las variables de conexion para el motor de bases de datos, segmentos de direcciones, etc.  Ver ejemplo:

		(start code)
			$Servidor="localhost"; // Define servidor de bases de datos
			$BaseDatos="practico"; // Nombre de la base de datos a utilizar
			$UsuarioBD="root"; // Usuario con privilegios suficientes para crear/eliminar tablas y realizar operaciones con registros
			$PasswordBD="toor"; // Contrasena del usuario para accesar al motor
		(end)
	*/
	
	$ServidorBD="localhost";
	$BaseDatos="practico_db";  // Path completo cuando se trata de sqlite2, ej: "/path/to/database.sdb"
	$UsuarioBD="root";
	$PasswordBD="miclave";
	$MotorBD="mysql";
	$PuertoBD="";

	/*
		Section: Variables para aplicacion

		(start code)
			$NombreRAD="Pr&aacute;ctico";  // Nombre del aplicativo
			$VersionRAD="11.06";           // Version del aplicativo
			$PlantillaActiva="nomo";       // Mascara visual con la definicion de hojas CSS e imagenes.  Ubicada en /skin
			$ArchivoCORE="";               // Script que procesa todos los formularios. Vacio para la misma pagina o index.php

			$TablasCore="Core_";		   // Prefijo de Tablas base para uso de Practico (Cuidado al cambiar)
			$TablasApp="App_";			   // Prefijo de Tablas de datos definidas por el usuario (Cuidado al cambiar)
		(end)

		*Llave de paso*

		Establezca cualquier valor en la siguiente variable para reforzar la seguridad. Cambiar esto despues de tener usuarios creados puede afectar la autenticacion
		Se recomienda establecer una llave en ambientes de produccion antes de trabajar. Cada usuario debe contar en su registro con una llave de paso equivalente al MD5 definido en este punto

		(start code)
			$LlaveDePaso=""; //Predeterminado en vacio con MD5=d41d8cd98f00b204e9800998ecf8427e
		(end)
	*/

	$NombreRAD="Pr&aacute;ctico";
	$VersionRAD="12.05";
	$PlantillaActiva="nomo";
	$ArchivoCORE="";
	
	$TablasCore="Core_";  // Cuidado al cambiar: Prefijo de Tablas base para uso de Practico
	$TablasApp="App_";  // Cuidado al cambiar: Prefijo para Tablas de datos definidas por el usuario
	$MotorTablasApp="MyISAM";

	$LlaveDePaso=""; // Valor unico para firmar los usuarios del aplicativo.  No debe ser cambiado despues de puesto en marcha a menos que se haga un update manual el usuario que no coincida con la llave no podra ingresar.
?>
