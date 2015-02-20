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


	// 1. Llama al modelo, encargado de abstraer las operaciones de consulta a BD
	//require($ruta_modelos.'modelo.php');
	// 2. Pasa los datos generados por una funcion existente en el modelo a un variable independiente
	//$registros = getAuditoria();
	// 3. Llama a la vista, encargada de presentar los datos genericos entregados desde el modelo
	//require($ruta_vistas.'vista.php');


function PCODER_cargar_archivo($PCODER_archivo)
    {
        global $PCODER_extension,$PCODERcontenido_archivo,$PCODER_TamanoElemento,$PCODER_TipoElemento,$PCODER_FechaElemento;
        global $PCODER_Modos,$PCODER_ModoEditor;
        
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

        //Carga y Escapa el contenido del archivo
        $PCODERcontenido_archivo=@file_get_contents($PCODER_archivo);
        $PCODERcontenido_archivo=@htmlspecialchars($PCODERcontenido_archivo);

        //Cargar otras caracteristicas del archivo
        $PCODER_TamanoElemento=@round(filesize($PCODER_archivo)/1024);
        $PCODER_TipoElemento=filetype($PCODER_archivo);
        $PCODER_FechaElemento=date("d F Y H:i:s", filemtime($PCODER_archivo));


        //DOCS: http://stackoverflow.com/questions/15186558/loading-a-html-file-into-ace-editor-pre-tag
        //DOCS: <pre id="editor"><INTE ? php echo htmlentities(file_get_contents($input_dir."abc.html")); ? ></pre>
        //$PCODERcontenido_archivo=@htmlspecialchars(addslashes($PCODERcontenido_archivo));
    }
