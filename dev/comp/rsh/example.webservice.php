if ($PCO_WSId=="push_node_info") 
	{
        // Datos de fecha, hora y direccion IP para algunas operaciones
        $PHP_REMOTE_ADDR=$_SERVER ['REMOTE_ADDR'];
        $PHP_HTTP_CLIENT_IP=$_SERVER ['HTTP_CLIENT_IP'];
        $PHP_HTTP_X_FORWARDED_FOR=$_SERVER ['HTTP_X_FORWARDED_FOR'];
        
	    //Decode all parameters received
	    $Decodificados=base64_decode($SHYNC_PARAMETERS);
	    //Recorre los parametros separados por [[--]]
	    $ListaParametros=explode ("[[--]]" , $Decodificados);
	    foreach ($ListaParametros as $Parametro)
	        {
                //Desglosa cada parametro separado de su valor por signo igual
                $PartesParametro=explode ("=" , $Parametro);
                //Identificador de maquina
                if ($PartesParametro[0]=="SHYNC_ScriptVersion") $SHYNC_ScriptVersion=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_OperativeSystem") $SHYNC_OperativeSystem=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_KernelName") $SHYNC_KernelName=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_KernelRelease") $SHYNC_KernelRelease=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_KernelVersion") $SHYNC_KernelVersion=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_Machine") $SHYNC_Machine=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_Processor") $SHYNC_Processor=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_HardwarePlatform") $SHYNC_HardwarePlatform=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_NodeName") $SHYNC_NodeName=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_HostName") $SHYNC_HostName=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_CPUsCount") $SHYNC_CPUsCount=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_KernelSerial") $SHYNC_KernelSerial=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_HardDrivesSUM") $SHYNC_HardDrivesSUM=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_BIOSVendor") $SHYNC_BIOSVendor=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_BIOSVersion") $SHYNC_BIOSVersion=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_BIOSAddress") $SHYNC_BIOSAddress=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_SystemVendor") $SHYNC_SystemVendor=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_SystemProductName") $SHYNC_SystemProductName=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_SystemSerialNumber") $SHYNC_SystemSerialNumber=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_SystemUUID") $SHYNC_SystemUUID=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_BoardVendor") $SHYNC_BoardVendor=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_BoardProductName") $SHYNC_BoardProductName=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_BoardSerialNumber") $SHYNC_BoardSerialNumber=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_ChassisVendor") $SHYNC_ChassisVendor=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_ChassisType") $SHYNC_ChassisType=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_ChassisSerialNumber") $SHYNC_ChassisSerialNumber=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_ProcessorFamily") $SHYNC_ProcessorFamily=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_ProcessorVersion") $SHYNC_ProcessorVersion=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_ProcessorCoreCount") $SHYNC_ProcessorCoreCount=trim($PartesParametro[1]);
                if ($PartesParametro[0]=="SHYNC_ProcessorID") $SHYNC_ProcessorID=trim($PartesParametro[1]);
            }
	    
        //Verify if the node exists
	    $RegistroHost=PCO_EjecutarSQL("SELECT * FROM app_rshync_hosts WHERE SHYNC_SystemUUID='$SHYNC_SystemUUID' ")->fetch();

	    //Inserta el host si no existe
	    if ($RegistroHost["id"]=="")
	        {
	            auditar("Reportada maquina nueva $SHYNC_SystemUUID");
	            PCO_EjecutarSQLUnaria("INSERT INTO app_rshync_hosts (SHYNC_ScriptVersion,SHYNC_OperativeSystem,SHYNC_KernelName,SHYNC_KernelRelease,SHYNC_KernelVersion,SHYNC_Machine,SHYNC_Processor,SHYNC_HardwarePlatform,SHYNC_NodeName,SHYNC_HostName,SHYNC_CPUsCount,SHYNC_KernelSerial,SHYNC_HardDrivesSUM,SHYNC_BIOSVendor,SHYNC_BIOSVersion,SHYNC_BIOSAddress,SHYNC_SystemVendor,SHYNC_SystemProductName,SHYNC_SystemSerialNumber,SHYNC_SystemUUID,SHYNC_BoardVendor,SHYNC_BoardProductName,SHYNC_BoardSerialNumber,SHYNC_ChassisVendor,SHYNC_ChassisType,SHYNC_ChassisSerialNumber,SHYNC_ProcessorFamily,SHYNC_ProcessorVersion,SHYNC_ProcessorCoreCount,SHYNC_ProcessorID,PHP_REMOTE_ADDR,PHP_HTTP_CLIENT_IP,PHP_HTTP_X_FORWARDED_FOR) VALUES ('$SHYNC_ScriptVersion','$SHYNC_OperativeSystem','$SHYNC_KernelName','$SHYNC_KernelRelease','$SHYNC_KernelVersion','$SHYNC_Machine','$SHYNC_Processor','$SHYNC_HardwarePlatform','$SHYNC_NodeName','$SHYNC_HostName','$SHYNC_CPUsCount','$SHYNC_KernelSerial','$SHYNC_HardDrivesSUM','$SHYNC_BIOSVendor','$SHYNC_BIOSVersion','$SHYNC_BIOSAddress','$SHYNC_SystemVendor','$SHYNC_SystemProductName','$SHYNC_SystemSerialNumber','$SHYNC_SystemUUID','$SHYNC_BoardVendor','$SHYNC_BoardProductName','$SHYNC_BoardSerialNumber','$SHYNC_ChassisVendor','$SHYNC_ChassisType','$SHYNC_ChassisSerialNumber','$SHYNC_ProcessorFamily','$SHYNC_ProcessorVersion','$SHYNC_ProcessorCoreCount','$SHYNC_ProcessorID','$PHP_REMOTE_ADDR','$PHP_HTTP_CLIENT_IP','$PHP_HTTP_X_FORWARDED_FOR')");
	        }
        else
            {

            }

        # Actualiza ultimo registro del host
        PCO_EjecutarSQLUnaria("UPDATE app_rshync_hosts SET PHP_REMOTE_ADDR='$PHP_REMOTE_ADDR',PHP_HTTP_CLIENT_IP='$PHP_HTTP_CLIENT_IP',PHP_HTTP_X_FORWARDED_FOR='$PHP_HTTP_X_FORWARDED_FOR', SHYNC_LastBeat=NOW() WHERE SHYNC_SystemUUID='$SHYNC_SystemUUID' ");
        //Finish
        ob_clean();
	}


if ($PCO_WSId=="push_node_output") 
	{
	    //Decode all parameters received
	    $SHYNC_CommandLine=base64_decode($SHYNC_CommandLine);
	    $SHYNC_CommandOutput=base64_decode($SHYNC_CommandOutput);
	    PCO_EjecutarSQLUnaria("INSERT INTO app_rshync_commands (SHYNC_CommandLine,SHYNC_CommandOutput,SHYNC_SystemUUID) VALUES ('$SHYNC_CommandLine','$SHYNC_CommandOutput','$SHYNC_SystemUUID')");
        //Limpia buffer y entrega solo el comando
        ob_clean();
	}


if ($PCO_WSId=="get_node_command") 
	{
        //Busca por un comando pendiente por ejecucion
	    $RegistroHost=PCO_EjecutarSQL("SELECT SHYNC_CommandToRun FROM app_rshync_hosts WHERE SHYNC_SystemUUID='$SHYNC_SystemUUID' ")->fetch();
        //Limpia el comando para evitar ejecuciones dobles
        PCO_EjecutarSQLUnaria("UPDATE app_rshync_hosts SET SHYNC_CommandToRun='' WHERE SHYNC_SystemUUID='$SHYNC_SystemUUID' ");
        //Limpia buffer y entrega solo el comando
        ob_clean();
        if ($RegistroHost["SHYNC_CommandToRun"]!="")
            echo $RegistroHost["SHYNC_CommandToRun"];
        else
            echo "NONE";
	}