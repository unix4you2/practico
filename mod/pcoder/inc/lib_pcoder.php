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



/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_GuardarArchivo
	Almacena un archivo previamente abierto con el PCODER

	Salida:
		Archivo para edicion en pantalla
*/
if ($PCO_Accion=="PCOMOD_GuardarArchivo") 
	{
        //Guarda el archivo
        $PCODER_Respuesta = file_put_contents($PCODER_archivo, $_POST["PCODER_AreaTexto"]) or die("No se puede abrir el archivo para escritura");
        //Vuelve a cargar el archivo para continuar con su edicion
        auditar("Modifica archivo $PCODER_archivo");
        //Continua presentando todo el editor solo si se pide el echo
        if ($PCO_ECHO==1)
            echo '
                <body>
                <form name="continuar_edicion" action="index.php" method="POST">
                    <input type="Hidden" name="PCO_Accion" value="PCOMOD_CargarPcoder">
                    <input type="Hidden" name="PCODER_archivo" value="'.$PCODER_archivo.'">
                    <input type="Hidden" name="PCODER_TokenEdicion" value="'.$PCODER_TokenEdicion.'">
                    <input type="Hidden" name="Presentar_FullScreen" value="'.@$Presentar_FullScreen.'">
                    <input type="Hidden" name="Precarga_EstilosBS" value="'.@$Precarga_EstilosBS.'">
                <script type="" language="JavaScript"> document.continuar_edicion.submit();  </script>
                </body>';
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_ObtenerPermisosArchivo
	Determina cuales son los permisos de un archivo
*/
if ($PCO_Accion=="PCOMOD_ObtenerPermisosArchivo") 
	{
		$permisos_encontrados=@substr(sprintf('%o', fileperms($PCODER_archivo)), -4);
        echo $permisos_encontrados;
	}
	

/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_VerificarPermisosRW
	Verifica si el archivo cuenta o no con permisos de escritura por parte del usuario que corre el proceso web (generalmente Apache)
*/
if ($PCO_Accion=="PCOMOD_VerificarPermisosRW") 
	{
		$permisos_ok=1;
		$permisos_encontrados=@substr(sprintf('%o', fileperms($PCODER_archivo)), -4);
		if (!is_writable($PCODER_archivo)) { $permisos_ok=0; }
        echo $permisos_ok;
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_ObtenerTipoElemento
	Obtiene el tipo de elemento o archivo indicado
*/
if ($PCO_Accion=="PCOMOD_ObtenerTipoElemento") 
	{
		$PCODER_TipoElemento=@filetype($PCODER_archivo);
		@ob_clean();
        echo $PCODER_TipoElemento;
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_ObtenerTamanoDocumento
	Obtiene el tamano de elemento o archivo indicado
*/
if ($PCO_Accion=="PCOMOD_ObtenerTamanoDocumento") 
	{
        $PCODER_TamanoElemento=@round(filesize($PCODER_archivo)/1024);
		@ob_clean();
        echo $PCODER_TamanoElemento;
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_ObtenerFechaElemento
	Obtiene  la fecha de modificacion de elemento o archivo indicado
*/
if ($PCO_Accion=="PCOMOD_ObtenerFechaElemento") 
	{
        $PCODER_FechaElemento=@date("d F Y H:i:s", @filemtime($PCODER_archivo));
		@ob_clean();
        echo $PCODER_FechaElemento;
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_ObtenerTokenEdicion
	Obtiene el token de edicion de elemento o archivo indicado
*/
if ($PCO_Accion=="PCOMOD_ObtenerTokenEdicion") 
	{
		//Obtiene algunos valores del archivo necesarios para el token
		$PCODER_FechaElemento=@date("d F Y H:i:s", @filemtime($PCODER_archivo));
		$PCODER_TamanoElemento=@round(filesize($PCODER_archivo)/1024);
        $PCODERcontenido_original_archivo=@file_get_contents($PCODER_archivo);
        
        //Define un Token con el antes y despues
        $PCODER_TokenEdicion=md5($PCODER_archivo.$PCODER_TamanoElemento.$PCODER_FechaElemento.$PCODERcontenido_original_archivo);
   		@ob_clean();
        echo $PCODER_TokenEdicion;
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_ObtenerModoEditor
	Detecta el tipo de archivo y especifica el modo que se debe utilizar en el editor
*/
if ($PCO_Accion=="PCOMOD_ObtenerModoEditor") 
	{
        global $PCODER_Modos;
        
        //Obtiene la extension del archivo
        $PCODER_partes_extension = explode(".",$PCODER_archivo);
        $PCODER_extension = $PCODER_partes_extension[count($PCODER_partes_extension)-1];

        //Identifica el tipo de documento a ser aplicado segun la extension del archivo
        $PCODER_ModoEditor='';
        for ($i=0;$i<count($PCODER_Modos) && $PCODER_ModoEditor=='';$i++)
            {
               if(strpos($PCODER_Modos[$i]["Extensiones"], $PCODER_extension) !== false)
                    $PCODER_ModoEditor=$PCODER_Modos[$i]["Nombre"];
            }

   		@ob_clean();
        echo $PCODER_ModoEditor;
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_ObtenerNombreArchivo
	Establece el nombre del archivo abierto (sin su ruta, solo nombre.extension)
*/
if ($PCO_Accion=="PCOMOD_ObtenerNombreArchivo") 
	{
        //Obtiene el nombre del archivo para el titulo de ventana
        $PCODER_PartesNombreArchivo=explode(DIRECTORY_SEPARATOR,$PCODER_archivo);
        $PCODER_NombreArchivo = $PCODER_PartesNombreArchivo[count($PCODER_PartesNombreArchivo)-1];

   		@ob_clean();
        echo $PCODER_NombreArchivo;
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOMOD_ObtenerContenidoArchivo
	Obtiene el contenido del archivo indicado
*/
if ($PCO_Accion=="PCOMOD_ObtenerContenidoArchivo") 
	{
        //Carga y Escapa el contenido del archivo
        $PCODER_Contenido_original_archivo=@file_get_contents($PCODER_archivo, FILE_BINARY);   // FILE_TEXT | FILE_BINARY | FILE_USE_INCLUDE_PATH
        //$PCODER_ContenidoArchivo=@htmlspecialchars($PCODER_Contenido_original_archivo); //Para cargue como estaba en forma original (Sin Ajax)
        $PCODER_ContenidoArchivo= $PCODER_Contenido_original_archivo;

        //DOCS: http://stackoverflow.com/questions/15186558/loading-a-html-file-into-ace-editor-pre-tag
        //DOCS: <pre id="editor"><INTE ? php echo htmlentities(file_get_contents($input_dir."abc.html")); ? ></pre>
        //$PCODER_ContenidoArchivo=@htmlspecialchars(addslashes($PCODER_ContenidoArchivo));
   		@ob_clean();
        echo $PCODER_ContenidoArchivo;
	}
