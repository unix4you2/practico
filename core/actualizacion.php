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
				Title: Modulo actualizar
				Ubicacion *[/core/actualizacion.php]*.  Archivo de funciones para el proceso de actualizacion de la plataforma mediante parches incrementales
			*/
?>

<?php


/* ################################################################## */
/* ################################################################## */
/*
	Function: listado_exploracion_archivos
	Presenta una lista de los archivos contenidos en una carpeta con modificadores para las opciones
*/
function listado_exploracion_archivos($RutaExploracion="",$Filtro_contenido="",$TituloExploracion="")
    {
        global $MULTILANG_TotalRegistros,$MULTILANG_Explorar,$MULTILANG_Filtro,$MULTILANG_Descargar,$MULTILANG_Tipo,$MULTILANG_Fecha,$MULTILANG_Peso;
        //Si la ruta de exploracion es diferente de vacio hace el proceso de busqueda de archivos
        if ($RutaExploracion!="")
            {
                //Inicia Marco de presentacion de archivos
                echo '
                    <div class="panel panel-default"> <!-- Clase chat-panel para altura -->
                        <div class="well well-sm"><span class="label label-primary">'.$TituloExploracion.'</span> '.$MULTILANG_Explorar.' <b>'.$RutaExploracion.'</b> '.$MULTILANG_Filtro.' '.$Filtro_contenido.':</div>
                        <div class="panel-body">
                            <ul class="chat">';

                $ConteoElementos=0;
                $ContenidoDirectorio = opendir($RutaExploracion);
                while (($Elemento = readdir($ContenidoDirectorio)) !== false)
                    {
                        if (($Elemento != ".") && ($Elemento != "..") && stristr($Elemento,$Filtro_contenido))
                            {
                                $TamanoElemento=round(filesize($RutaExploracion.$Elemento)/1024);
                                $TipoElemento=filetype($RutaExploracion.$Elemento);
                                $FechaElemento=date("d F Y H:i:s", filemtime($RutaExploracion.$Elemento));
                                echo '
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <i class="fa fa-file-archive-o fa-2x fa-fw icon-gray"></i>
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">'.$Elemento.'</strong> 
                                            <small class="pull-right text-muted">
                                                <a  href="'.$RutaExploracion.$Elemento.'" class="btn btn-xs btn-default"><i class="fa fa-download fa-fw"></i> '.$MULTILANG_Descargar.'</a>
                                                <br>
                                                '.$MULTILANG_Peso.' <span class="badge">'.$TamanoElemento.' Kb</span>
                                            </small>
                                        </div>
                                        <p>
                                            <i class="icon-gray">&nbsp;&nbsp;&nbsp;
                                            '.$MULTILANG_Fecha.': '.$FechaElemento.'
                                            ('.$MULTILANG_Tipo.' '.$TipoElemento.')
                                            </i>
                                        </p>
                                    </div>
                                </li>';    
                                $ConteoElementos++;
                            }
                    }

                //Cierra Marco de presentacion de archivos
                echo '
                            </ul>
                        </div> <!-- /.panel-body -->
                    <div class="well well-sm">'.$MULTILANG_TotalRegistros.': <b>'.$ConteoElementos.'</b></div>
                    </div> <!-- /.panel .chat-panel -->';
            }
    }



/* ################################################################## */
/* ################################################################## */
/*
	Function: actualizar_practico
	Presenta el paso 1 del asistente de actualizacion de Practico para la carga del archivo con el parche
*/
if ($PCO_Accion=="actualizar_practico")
	{
		abrir_ventana($NombreRAD.' - '.$MULTILANG_Actualizacion,'panel-info');
?>

    <ul class="nav nav-tabs nav-justified">
    <li class="active"><a href="#pestana_actualizacion" data-toggle="tab"><i class="fa fa-upload"></i> <?php echo $MULTILANG_Actualizacion; ?></a></li>
    <li><a href="#pestana_copias" data-toggle="tab"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_Copias; ?></a></li>
    <li><a href="#historico_actualizaciones" data-toggle="tab"><i class="fa fa-history"></i> <?php echo $MULTILANG_Historico; ?></a></li>
    </ul>

    <div class="tab-content">
        
        <!-- INICIO TAB ACTUALIZACION -->
        <div class="tab-pane fadein active" id="pestana_actualizacion">
            <br><br>
            <?php
                mensaje($MULTILANG_ActMsj1,$MULTILANG_ActMsj2,'100%','fa fa-exclamation-triangle fa-5x','TextosVentana');
            ?>
            <div align="center">
                <br>
                <i class="fa fa-inbox fa-2x fa-fw"></i><b> <?php echo $MULTILANG_ActUsando; ?>: <?php include("inc/version_actual.txt"); ?></b><br>
                <hr>
                        <form action="<?php echo $ArchivoCORE; ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="extension_archivo" value=".zip">
                            <input type="hidden" name="MAX_FILE_SIZE" value="8192000">
                            <input type="Hidden" name="PCO_Accion" value="cargar_archivo">
                            <input type="Hidden" name="siguiente_accion" value="analizar_parche">
                            <input type="Hidden" name="texto_boton_siguiente" value="Continuar con la revisi&oacute;n">
                            <input type="Hidden" name="carpeta" value="tmp">
                            <b><?php echo $MULTILANG_ActPaquete; ?>: </b><br>
                            <input name="archivo" type="file" class="form-control btn btn-info">
                            <br>
                            <button type="submit"  class="btn btn-success"><i class="fa fa-upload"></i> <?php echo $MULTILANG_CargarArchivo; ?></button> (<?php echo $MULTILANG_ActSobreescritos; ?>)
                        </form> 
                        <hr>

            </div>
        </div>
        <!-- FIN TAB ACTUALIZACION -->
        
        <!-- INICIO TAB COPIAS DE SEGURIDAD -->
        <div class="tab-pane fade" id="pestana_copias">
            <?php
                listado_exploracion_archivos("bkp/","_bdd.gz","Base de datos");
                listado_exploracion_archivos("bkp/","_app.zip","Archivos y Scripts de Pr&aacute;ctico");
            ?>
        </div>
        <!-- FIN TAB COPIAS DE SEGURIDAD -->

        <!-- INICIO TAB HISTORICO DE ACTUALIZACIONES -->
        <div class="tab-pane fade" id="historico_actualizaciones">
                <div class="well well-sm"><b>Ultimos 30 registros / Last 30 records</b></div>
                <table id="TablaAcciones" class="table table-condensed table-hover table-unbordered btn-xs table-striped">
                    <thead>
					<tr>
						<th><b><?php echo $MULTILANG_UsrLogin; ?></b></th>
						<th><b><?php echo $MULTILANG_UsrAudDes; ?></b></th>
						<th><b><?php echo $MULTILANG_Fecha; ?></b></th>
						<th><b><?php echo $MULTILANG_Hora; ?></b></th>
					</tr>
                    </thead>
                    <tbody>
                    <?php
                        // Busca por las auditorias asociadas a actualizacion de plataforma:
                        // Acciones:  Actualiza version de plataforma | _Actualizacion_ | Analiza archivo tmp/Practico | Carga archivo en carpeta tmp - Practico
                        $resultado=@ejecutar_sql("SELECT $ListaCamposSinID_auditoria FROM ".$TablasCore."auditoria WHERE (accion LIKE '%Actualiza version de plataforma%' OR accion LIKE '%_Actualizacion_%' OR accion LIKE '%Analiza archivo tmp/Practico%' OR accion LIKE '%Carga archivo en carpeta tmp - Practico%') ORDER BY fecha DESC, hora DESC LIMIT 0,30");
                        while($registro = $resultado->fetch())
                            {
                                echo '<tr>
                                        <td>'.$registro["usuario_login"].'</td>
                                        <td>'.$registro["accion"].'</td>
                                        <td>'.$registro["fecha"].'</td>
                                        <td>'.$registro["hora"].'</td>
                                    </tr>';
                            }
                    ?>
                    </tbody>
                </table>

        </div>
        <!-- FIN TAB HISTORICO DE ACTUALIZACIONES -->
        
    </div>

<?php
		abrir_barra_estado();
		echo '<a class="btn btn-warning btn-block" href="javascript:document.core_ver_menu.submit();"><i class="fa fa-home"></i> '.$MULTILANG_Cancelar.'</a>';
		cerrar_barra_estado();
		cerrar_ventana();
        $VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: cargar_archivo
	Toma el archivo entregado por el paso 1 del asistente de actualizacion y lo carga sobre la ruta relativa a la instalacion de Practico /tmp para ser analizado.

	Variables de entrada:

		archivo - Archivo recibido mediante el formulario Multipart del paso 1

	Salida:
		Archivo cargado sobre /tmp o mensaje de error en caso de fallo

	Ver tambien:
		<actualizar_practico>
*/
if ($PCO_Accion=="cargar_archivo")
	{
		abrir_ventana($MULTILANG_Adjuntando, 'panel-primary');

		//datos del arhivo
		$mensaje_error="";
		$nombre_archivo = $_FILES['archivo']['name'];
		$tipo_archivo = $_FILES['archivo']['type'];
		$tamano_archivo = $_FILES['archivo']['size'];
		$nombre_archivo_temporal = $_FILES['archivo']['tmp_name'];
		$tamano_permitido=$MAX_FILE_SIZE/1000;

		//Comprueba si las características del archivo son las deseadas
		if ($tamano_archivo > $MAX_FILE_SIZE)
			$mensaje_error.=$MULTILANG_ErrorTamano.' ('.$tamano_permitido.' Bytes).';

		if (strpos($nombre_archivo, $extension_archivo)===FALSE)
			$mensaje_error.=$MULTILANG_ErrorFormato;

		// Solo intenta la carga del archivo si cumple las condiciones
		if ($mensaje_error=="")
			if (!move_uploaded_file($nombre_archivo_temporal, $carpeta."/".$nombre_archivo))
				$mensaje_error.=$MULTILANG_ErrorDesconocido.' '.$nombre_archivo.' --> '.$carpeta.'/. '.$MULTILANG_ContacteAdmin;

		if ($mensaje_error=="")
			{				
				echo '<i class="fa fa-check fa-fw fa-3x"></i> '.$MULTILANG_CargaCorrecta.'.<br><br>
					<form action="'.$ArchivoCORE.'" method="post">
						<input type="Hidden" name="archivo_cargado" value="'.$carpeta.'/'.$nombre_archivo.'">
						<input type="Hidden" name="PCO_Accion" value="'.$siguiente_accion.'">
                        <button type="submit" class="btn btn-success btn-block"><i class="fa fa-list"></i> '.$texto_boton_siguiente.'</button>
					</form>';
				auditar("Carga archivo en carpeta $carpeta - $nombre_archivo");
			}
		else
			{
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="Ver_menu">
					<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_Actualizacion.' - '.$MULTILANG_Error.'">
					<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}


		echo '<br><a class="btn btn-default btn-block" href="javascript:document.core_ver_menu.submit();"><i class="fa fa-home"></i> '.$MULTILANG_Cancelar.'</a>';

		cerrar_ventana();
        $VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: analizar_parche
	Revisa el archivo cargado sobre /tmp para validar si se trata de un parche con una estructura valida para Practico y muestra ademas el resumen de cambios que implementara.

	Variables de entrada:

		archivo_cargado - Ruta absoluta hacia el archivo cargado en el paso anterior del asistente

	Salida:
		Analisis del archivo y detalles del parche

	Ver tambien:
		<actualizar_practico>
*/
if ($PCO_Accion=="analizar_parche")
	{
		abrir_ventana($MULTILANG_ErrorDescomprimiendo.' '.$archivo_cargado, 'panel-info');

		echo '
		<form action="'.$ArchivoCORE.'" method="post">
			<label for="PCO_TipoBackup">'.$MULTILANG_ActBackupTipo.':</label>
			<div class="form-group input-group">
				<select id="PCO_TipoBackup" name="PCO_TipoBackup" class="selectpicker btn-warning" >
					<option value="Archivos">'.$MULTILANG_ActBackup1.'</option>
					<option value="Archivos+Basedatos">'.$MULTILANG_ActBackup3.'</option>
				</select>
				<span class="input-group-addon">
					<a href="#" title="'.$MULTILANG_ActBackupDes.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
				</span>
			</div>
		'.$MULTILANG_ActBackupDes.'<hr>';	
		
		echo '<u>'.$MULTILANG_ContenidoParche.':</u><br>';
		$mensaje_error="";

		//Lee la version actualmente instalada de practico
		$archivo_origen="inc/version_actual.txt";
		$archivo = fopen($archivo_origen, "r");
		if ($archivo)
			{
				$version_actual = trim(fgets($archivo, 1024));
				fclose($archivo);
			}
		else
			$mensaje_error.='<br>'.$MULTILANG_ErrorVerAct.' <b>inc/version_actual.txt</b>';

		//Libreria necesaria para extraer el archivo
		include("inc/pclzip/pclzip.lib.php");
		$archivo = new PclZip($archivo_cargado);
        $carpeta_destino=""; //Define donde se descomprime el archivo.  Por defecto es la ruta vacia para tomar la actual o raiz
		//Obtiene archivo compat.txt con el numero de version compatible del parche
		$lista_contenido = $archivo->extract(PCLZIP_OPT_BY_NAME, "tmp/par_compat.txt",PCLZIP_OPT_PATH, $carpeta_destino,PCLZIP_OPT_EXTRACT_AS_STRING);
		$version_compatible=trim($lista_contenido[0]['content']);
		if ($lista_contenido == 0 || $version_compatible=="")
			$mensaje_error.='<br>'.$MULTILANG_ErrorActualiza.' tmp/par_compat.txt <br>';

		//Obtiene archivo version.txt con la version que se aplicaria al sistema
		$lista_contenido = $archivo->extract(PCLZIP_OPT_BY_NAME, "inc/version_actual.txt",PCLZIP_OPT_PATH, $carpeta_destino,PCLZIP_OPT_EXTRACT_AS_STRING);
		$version_final=trim($lista_contenido[0]['content']);
		if ($lista_contenido == 0 || $version_final=="")
			$mensaje_error.='<br>'.$MULTILANG_ErrorActualiza.' inc/version_actual.txt <br>';

		//Obtiene archivo cambios.txt con la informacion de funcionalidades implementadas por el parche
		$lista_contenido = $archivo->extract(PCLZIP_OPT_BY_NAME, "tmp/par_cambios.txt",PCLZIP_OPT_PATH, $carpeta_destino,PCLZIP_OPT_EXTRACT_AS_STRING);
		$resumen_cambios=$lista_contenido[0]['content'];
		if ($lista_contenido == 0 || $resumen_cambios=="")
			$mensaje_error.='<br>'.$MULTILANG_ErrorActualiza.' tmp/par_cambios.txt <br>';

		//Obtiene archivo sql.txt con las instrucciones a ejecutar
		$lista_contenido = $archivo->extract(PCLZIP_OPT_BY_NAME, "tmp/par_sql.txt",PCLZIP_OPT_PATH, $carpeta_destino,PCLZIP_OPT_EXTRACT_AS_STRING);
		$resumen_sql=$lista_contenido[0]['content'];
		if ($lista_contenido == 0)
			$mensaje_error.='<br>'.$MULTILANG_ErrorActualiza.' tmp/par_sql.txt <br>';

		//Hace verificaciones adicionales cuando la version compatible es diferente de un punto (. = cualquiera)
		if ($version_compatible!=".")
			{
				//Verifica que no sea un parche mas viejo que la version actual
				if ($mensaje_error=="")
					if ($version_final < $version_actual)
						$mensaje_error.='<br>'.$MULTILANG_ErrorAntigua.' Ver:'.$version_final.' <= Ver:'.$version_actual;

				//Verifica si la version actualmente instalada es la requerida por el parche
				if ($mensaje_error=="")
					if ($version_compatible != $version_actual)
						$mensaje_error.="<br>".$MULTILANG_ErrorVersion." ".$version_compatible."<br>".$MULTILANG_AvisoIncremental;
			}

		if ($mensaje_error=="")
			{
				$errores_permisos_escritura=0;
                //Presenta contenido del archivo
				if (($lista_contenido = $archivo->listContent()) == 0)
					echo $MULTILANG_Error.": ".$archivo->errorInfo(true);
				echo '<OL>';
				for ($i=0; $i<sizeof($lista_contenido); $i++)
                    {
                        echo "<li><font color=blue>".@$lista_contenido[$i][filename]."</font> ... ".$MULTILANG_Integridad.": <b>".@$lista_contenido[$i][status]."</b>";  /*Propiedades adicionales:  filename, stored_filename, size, compressed_size, mtime, comment, folder, index, status*/
                        //Verifica que pueda ser escrito el archivo de destino
                        $archivo_a_escribir=@$lista_contenido[$i][filename];
                        if (!is_writable($archivo_a_escribir) && file_exists ($archivo_a_escribir))
                            {
                                echo " <font color=red><b>[$MULTILANG_ActErrEscritura]</b></font>";
                                $errores_permisos_escritura=1;
                            }
                    }
				echo '</OL>';
				echo '<center>
				<hr><b>'.$MULTILANG_ResumenParche.'</b>:<br>
				<textarea rows=7 class="form-control btn-xs">'.$resumen_cambios.'</textarea>
				<hr><b>'.$MULTILANG_ResumenInstrucciones.'</b>:<br>
				<textarea rows=7 class="form-control btn-xs">'.$resumen_sql.'</textarea>
				<br><br><b>'.$MULTILANG_FinRevision.'<br>
				 <font color=blue>- '.$MULTILANG_ActMsj3.': '.$version_final.' -</font></b><br>
				 <br><br>
					';
                
                //Agrega el boton de continuar solamente si todos los archivos pueden escribirse para evitar inconsistencias
                if ($errores_permisos_escritura==0)
                    echo '
						<input type="Hidden" name="PCO_Accion" value="aplicar_parche">
						<input type="Hidden" name="version_actual" value="'.$version_actual.'">
						<input type="Hidden" name="version_final" value="'.$version_final.'">
						<input type="Hidden" name="archivo_cargado" value="'.$archivo_cargado.'">
                        <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-warning texto-blink icon-yellow"></i> '.$MULTILANG_Continuar.' <i class="fa fa-warning texto-blink icon-yellow"></i></button>
					</form>';
                else
                    mensaje('<i class="fa fa-warning fa-2x text-red texto-blink"></i> '.$MULTILANG_Error, $MULTILANG_ActDesEscritura, '', '', 'alert alert-danger alert-dismissible');
				auditar("Analiza archivo $archivo_cargado");
			}
		else
			{
				echo '
				</form> <!-- Cierra Form de curso normal -->
				
				<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="Ver_menu">
					<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ActErrGral.'">
					<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
		echo '</center>';
		echo '<br><a class="btn btn-default btn-block" href="javascript:document.core_ver_menu.submit();"><i class="fa fa-home"></i> '.$MULTILANG_Cancelar.'</a>';

		cerrar_ventana();
        $VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: aplicar_parche
	Hace una copia de seguridad del sistema actual y toma el archivo entregado por el paso 2 del asistente de actualizacion y ejecuta todos los scripts encontrados en el, ademas de copiar los archivos correspondientes.

	Variables de entrada:

		archivo_cargado - Ruta absoluta hacia el archivo cargado en el paso anterior del asistente

	Salida:
		Actualizacion de Practico ejecutada, nueva version del aplicativo disponible

	Ver tambien:
		<actualizar_practico>
*/
if ($PCO_Accion=="aplicar_parche")
	{
		//Divide los queries de un cadena
		function split_sql($sql)
			{
				$sql = trim($sql);
				$sql = ereg_replace("\n#[^\n]*\n", "\n", $sql);

				$buffer = array();
				$ret = array();
				$in_string = false;

				for($i=0; $i<strlen($sql)-1; $i++) {
					if($sql[$i] == ";" && !$in_string) {
						$ret[] = substr($sql, 0, $i);
						$sql = substr($sql, $i + 1);
						$i = 0;
					}

					if($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\") {
						$in_string = false;
					}
					elseif(!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\")) {
						$in_string = $sql[$i];
					}
					if(isset($buffer[1])) {
						$buffer[0] = $buffer[1];
					}
					$buffer[1] = $sql[$i];
				}

				if(!empty($sql)) {
					$ret[] = $sql;
				}
				return($ret);
			}

		abrir_ventana($MULTILANG_Aplicando.': '.$archivo_cargado, 'panel-primary');
		echo '<table class="table table-unbordered table-condensed"><tr><td>
		<u>'.$MULTILANG_ActDesde.' '.$version_actual.' ---> '.$version_final.':</u><br><br>';
		$mensaje_error="";

		//VERIFICAR PERMISOS DE ESCRITURA EN CADA RUTA DEL PARCHE

		//Libreria necesaria para extraer el archivo
		include("inc/pclzip/pclzip.lib.php");
		$archivo = new PclZip($archivo_cargado);
		
		if ($mensaje_error=="")
			{				
				//Hace una copia de seguridad de los archivos a reemplazar por el parche
				if ($PCO_TipoBackup=="Archivos" || $PCO_TipoBackup=="Archivos+Basedatos")
					{
						$archivo_destino_backup_app="bkp/bkp_".$PCO_FechaOperacion."-".date("Hi")."_app.zip";
						$archivo_backup = new PclZip($archivo_destino_backup_app);

						if (($lista_contenido = $archivo->listContent()) == 0)
							echo $MULTILANG_ErrLista.": ".$archivo->errorInfo(true);

						$lista_archivos_a_comprimir="";
						for ($i=0; $i<sizeof($lista_contenido); $i++)
							{
								//Si el archivo destino existe entonces lo agrega a la lista de archivos del backup
								if (file_exists($lista_contenido[$i][filename]) && !is_dir($lista_contenido[$i][filename]))
									{
										$lista_archivos_a_comprimir.=$lista_contenido[$i][filename].",";
										echo "<li> ".$MULTILANG_HaciendoBkp.": ".$lista_contenido[$i][filename];
									}
							}
						$lista_archivos_a_comprimir=substr($lista_archivos_a_comprimir, 0, strlen($lista_archivos_a_comprimir)-1);
						$lista_archivos_backup = $archivo_backup->create($lista_archivos_a_comprimir);				
					}

				//Hace copia de seguridad de la base de datos
				if ($PCO_TipoBackup=="Archivos+Basedatos")
					{
						$archivo_destino_backup_bdd="bkp/bkp_".$PCO_FechaOperacion."-".date("Hi")."_bdd.gz";
						include("core/backups.php");
						$objeto_backup_db = new DBBackup(array(
							'driver' => $MotorBD,
							'host' => $ServidorBD,
							'user' => $UsuarioBD,
							'password' => $PasswordBD,
							'database' => $BaseDatos,
							'prefix' => $TablasCore
						));
						$resultado_backup = $objeto_backup_db->backup();
						if(!$resultado_backup['error'])
							{
								// Un echo nl2br($backup['msg']); podría mostrar contenido
								// Por ahora, comprime el archivo resultante y lo guarda.
								$resultado_backup_comprimido = gzencode($resultado_backup['msg'], 9);
								$puntero_archivo_destino_backup_bdd = fopen($archivo_destino_backup_bdd, "w");
								fwrite($puntero_archivo_destino_backup_bdd, $resultado_backup_comprimido);
								fclose($puntero_archivo_destino_backup_bdd);
							}
						else
							{
								echo '<hr><b>'.$MULTILANG_ErrBkpBD.'.</b>';
							}
					}

				//Descomprime el archivo de parche
				$carpeta_destino='';
				//Extrae el archivo
				if ($archivo->extract(PCLZIP_OPT_PATH, $carpeta_destino, PCLZIP_OPT_REPLACE_NEWER) == 0)
					echo $MULTILANG_Error.": ".$archivo->errorInfo(true)."<br>";

				//Abre el archivo con los queries
				$RutaScriptSQL="tmp/par_sql.txt";
				$archivo_consultas=fopen($RutaScriptSQL,"r");
				$total_consultas= fread($archivo_consultas,filesize($RutaScriptSQL));
				fclose($archivo_consultas);

				$arreglo_consultas = split_sql($total_consultas);
				foreach($arreglo_consultas as $consulta)
					{
						try
							{
								//Cambia el prefijo predeterminado en caso que haya sido personalizado en la instalacion
								$consulta=str_replace("core_",$TablasCore,$consulta);
								//Ejecuta el query
								$consulta_enviar = $ConexionPDO->prepare($consulta);
								$estado_ok = $consulta_enviar->execute();
							}
						catch( PDOException $ErrorPDO)
							{
								echo "<hr><b><font color=red>".$MULTILANG_ErrorTiempoEjecucion.": </font><br>".$MULTILANG_Detalles.":</b> $consulta <b><br>".$MULTILANG_MotorBD.": ".$ErrorPDO->getMessage()."</b>";
								$hay_error=1; //usada globalmente durante el proceso de instalacion
							}
					}

				echo '<center>
				<hr><font color=blue>- '.$MULTILANG_ActMsj4.'. -</font></b>
				<hr>
				<b>'.$MULTILANG_ProcesoFin.'<br>';
				auditar("Actualiza version de plataforma desde $version_actual hacia $version_final");
			}
		else
			{
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="Ver_menu">
					<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ActMsj5.'">
					<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
		echo '</center></td></tr></table>';

		echo '<br><a class="btn btn-success btn-block" href="javascript:document.core_ver_menu.submit();"><i class="fa fa-home"></i> '.$MULTILANG_IrEscritorio.'</a>';
		cerrar_ventana();
        $VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
	}
?>
