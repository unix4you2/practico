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
				Title: Modulo tablas
				Ubicacion *[/core/tablas.php]*.  Archivo de funciones relacionadas con la administracion de tablas de la aplicacion.
			*/
?>
<?php
			/*
				Section: Operaciones basicas de administracion
				Funciones asociadas al mantenimiento de tablas en el sistema.
			*/
?>



<?php
/* ################################################################## */
/* ################################################################## */
/*
	Function: eliminar_campo
	Elimina un campo de una tabla de datos durante su proceso de edicion

	Variables de entrada:

		nombre_tabla - Nombre de la tabla sobre la cual sera eliminado el campo
		nombre_campo - Nombre del campo a eliminar

		(start code)
			ALTER TABLE $nombre_tabla DROP COLUMN $nombre_campo
		(end)

	Salida:
		Campo eliminado de la tabla.
		
	Ver tambien:
		<editar_tabla> | <guardar_crear_campo>
*/
	if ($PCO_Accion=="eliminar_campo")
		{ 
			$mensaje_error="";
			
			// Busca si existen formularios utilizando el campo de la tabla antes de ser eliminado
			//$consulta = "SELECT * FROM ".$TablasCore."formulario_objeto WHERE id='$formulario'";
			//$resultado = mysql_query($consulta,$mysql_enlace);
			//$registro = mysql_fetch_array($resultado);

			if ($mensaje_error=="")
				{
					// Realiza la operacion
					ejecutar_sql_unaria("ALTER TABLE $nombre_tabla DROP COLUMN $nombre_campo");
					auditar("Elimina campo $nombre_campo de tabla $nombre_tabla");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="editar_tabla">
					<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
					</form>
							<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="editar_tabla">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_TblError.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_crear_campo
	Agrega un nuevo campo a una tabla de datos durante su proceso de edicion

	Variables de entrada:

		nombre_tabla - Nombre de la tabla sobre la cual sera agregado el campo
		nombre_campo - Nombre del nuevo campo
		tipo - Tipo de dato asociado al campo

		(start code)
			ALTER TABLE $nombre_tabla ADD COLUMN $nombre_campo $tipo
		(end)

	Salida:
		Nuevo campo creado en la tabla.  Algunos parametros adicionales pueden ser usados durante el proceso de creacion del campo.
		
	Ver tambien:
		<editar_tabla>
*/
	if ($PCO_Accion=="guardar_crear_campo")
		{
			// Construye la consulta para la creacion del campo (sintaxis mysql por ahora)
			$consulta = "ALTER TABLE $nombre_tabla ADD COLUMN $nombre_campo $tipo";
			if ($longitud!="")
				$consulta .= "($longitud) ";
			$consulta .= " $valores_nulos ";
			if ($predeterminado!="")
				if ($predeterminado!="USER_DEFINED")
					$consulta .= " DEFAULT $predeterminado ";
				else
					$consulta .= " DEFAULT $predeterminado_valor ";

			// Realiza la operacion
			ejecutar_sql_unaria($consulta);

			$ultimo_error=$ConexionPDO->errorInfo();
			$descripcion_ultimo_error=$ultimo_error[2];
			if ($descripcion_ultimo_error!="")
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="editar_tabla">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_TblError2.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$MULTILANG_TblError3.': <i>'.$descripcion_ultimo_error.'</i>">
						</form>
							<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					auditar("Agrega campo $nombre_campo tipo $tipo a tabla $nombre_tabla");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="editar_tabla">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						</form>
							<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: editar_tabla
	Permite agregar o eliminar campos en una tabla de datos de aplicacion mediante sentencias ALTER despues de haber consultado su estructura

	Variables de entrada:

		nombre_tabla - Nombre de la tabla a ser editada

		(start code)
			DESCRIBE $nombre_tabla
		(end)

	Salida:
		Tabla con sus campos editados

	Ver tambien:
		<asistente_tablas>
*/
if ($PCO_Accion=="editar_tabla")
	{
		 ?>

<div class="row">
  <div class="col-md-4">
      
			<?php abrir_ventana($MULTILANG_TblAgrCampo,'panel-danger'); ?>
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="PCO_Accion" value="guardar_crear_campo">
			<input type="Hidden" name="nombre_tabla" value="<?php echo $nombre_tabla; ?>">

			<h4><?php echo $MULTILANG_TblAgrCampoTabla; ?>: <b><?php echo $nombre_tabla; ?></b>:</h4>


				<table class="table table-condensed btn-xs table-unbordered ">
					<tr>
						<td>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-magic fa-fw"></i> </span>
                                <input name="nombre_campo" type="text" class="form-control" placeholder="<?php echo $MULTILANG_Nombre; ?>">
                                <span class="input-group-addon">
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_FrmObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_TblTitNombre; ?>: <?php echo $MULTILANG_TblDesNombre; ?>"><i class="fa fa-question-circle"></i></a>
                                </span>
                            </div>
                        </td>
					</tr>
					<tr>
						<td>
							<label for="tipo"><?php echo $MULTILANG_Tipo; ?>:</label>
                            <select id="tipo" name="tipo" class="form-control">
								<option value="INT"><?php echo $MULTILANG_TblEntero; ?></option>
								<option value="VARCHAR"><?php echo $MULTILANG_TblCadena; ?></option>
								<option value="TEXT"><?php echo $MULTILANG_TblTexto; ?></option>
								<option value="DATE"><?php echo $MULTILANG_TblFecha; ?></option>
								<?php
									//Verifica si se trata de un motor MySQL o compatible y agrega los tipos especificos
									if ($MotorBD=="mysql")
										{
											echo '
											<optgroup label="Tipos numericos comunes">
												<option value="TINYINT">TINYINT</option>
												<option value="SMALLINT">SMALLINT</option>
												<option value="MEDIUMINT">MEDIUMINT</option>
												<option value="INT">INT</option>
												<option value="BIGINT">BIGINT</option>
												<option value="-">-</option>
												<option value="DECIMAL">DECIMAL</option>
												<option value="FLOAT">FLOAT</option>
												<option value="DOUBLE">DOUBLE</option>
												<option value="REAL">REAL</option>
												<option value="-">-</option>
												<option value="BIT">BIT</option>
												<option value="BOOLEAN">BOOLEAN</option>
												<option value="SERIAL">SERIAL</option>
											</optgroup>
											<optgroup label="Tipos de Fecha y Hora">
												<option value="DATE">DATE</option>
												<option value="DATETIME">DATETIME</option>
												<option value="TIMESTAMP">TIMESTAMP</option>
												<option value="TIME">TIME</option>
												<option value="YEAR">YEAR</option>
											</optgroup>
											<optgroup label="Tipos de cadenas de caracteres">
												<option value="CHAR">CHAR</option>
												<option value="VARCHAR">VARCHAR</option>
												<option value="-">-</option>
												<option value="TINYTEXT">TINYTEXT</option>
												<option value="TEXT">TEXT</option>
												<option value="MEDIUMTEXT">MEDIUMTEXT</option>
												<option value="LONGTEXT">LONGTEXT</option>
												<option value="-">-</option>
												<option value="BINARY">BINARY</option>
												<option value="VARBINARY">VARBINARY</option>
												<option value="-">-</option>
												<option value="TINYBLOB">TINYBLOB</option>
												<option value="MEDIUMBLOB">MEDIUMBLOB</option>
												<option value="BLOB">BLOB</option>
												<option value="LONGBLOB">LONGBLOB</option>
												<option value="-">-</option>
												<option value="ENUM">ENUM</option>
												<option value="SET">SET</option>
											</optgroup>
											<optgroup label="Tipos espaciales">
												<option value="GEOMETRY">GEOMETRY</option>
												<option value="POINT">POINT</option>
												<option value="LINESTRING">LINESTRING</option>
												<option value="POLYGON">POLYGON</option>
												<option value="MULTIPOINT">MULTIPOINT</option>
												<option value="MULTILINESTRING">MULTILINESTRING</option>
												<option value="MULTIPOLYGON">MULTIPOLYGON</option>
												<option value="GEOMETRYCOLLECTION">GEOMETRYCOLLECTION</option>
											</optgroup>';
										}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
                            <div class="form-group input-group">
                                <input name="longitud" type="text" class="form-control" placeholder="<?php echo $MULTILANG_TblLongitud; ?> (<?php echo $MULTILANG_MnuSiAplica; ?>)">
                                <span class="input-group-addon">
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_Importante; ?>: <?php echo $MULTILANG_TblDesLongitud; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_Ayuda; ?>: <?php echo $MULTILANG_TblDesLongitud2; ?>"><i class="fa fa-question-circle"></i></a>
                                </span>
                            </div>
						</td>
					</tr>
					<tr>
						<td>
                            <label for="autoincremento"><?php echo $MULTILANG_TblAutoinc; ?>:</label>
                            <div class="form-group input-group">
                                <select id="autoincremento" name="autoincremento" class="form-control" >
                                    <option value="AUTO_INCREMENT"><?php echo $MULTILANG_Si; ?></option>
                                    <option value="" selected><?php echo $MULTILANG_No; ?></option>
                                </select>
                                <span class="input-group-addon">
                                    <a href="#" title="<?php echo $MULTILANG_TblTitAutoinc; ?>: <?php echo $MULTILANG_TblDesAutoinc; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                </span>
                            </div>
						</td>
					</tr>
					
					<tr>
						<td>
							<label for="valores_nulos"><?php echo $MULTILANG_TblNulos; ?>:</label>
							<select id="valores_nulos" name="valores_nulos" class="form-control">
								<option value=""><?php echo $MULTILANG_Si; ?></option>
								<option value="NOT NULL"><?php echo $MULTILANG_No; ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label for="predeterminado"><?php echo $MULTILANG_FrmPredeterminado; ?>:</label>
                            <div class="form-group input-group">
                                <select id="predeterminado" name="predeterminado" class="form-control">
                                    <option value="" ><?php echo $MULTILANG_Ninguno; ?></option>
                                    <option value="USER_DEFINED" ><?php echo $MULTILANG_TblDefUsuario; ?>:</option>
                                    <option value="NULL" ><?php echo $MULTILANG_TblNulo; ?></option>
                                    <option value="CURRENT_TIMESTAMP" ><?php echo $MULTILANG_TblFechaHora; ?></option>
                                </select>
                                <span class="input-group-addon">
                                    <a href="#" title="<?php echo $MULTILANG_TblDesPredet; ?>"><i class="fa fa-question-circle icon-info"></i></a>
                                </span>
                            </div>
                                <div class="form-group input-group">
                                    <input name="predeterminado_valor" type="text" class="form-control">
                                    <span class="input-group-addon">
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_TblDesPredet; ?>"><i class="fa fa-question-circle"></i></a>
                                    </span>
                                </div>
						</td>
					</tr>
				</table>
                </form>
                <button type="button" class="btn btn-success btn-block" OnClick="document.datos.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_TblAgregando; ?></button>
                <button type="button" class="btn btn-default btn-block" OnClick="document.core_ver_menu.submit();"><i class="fa fa-desktop"></i> <?php echo $MULTILANG_IrEscritorio; ?></button>


		<?php
		cerrar_ventana();

?>
      
  </div>    
  <div class="col-md-8">

<?php

		abrir_ventana($MULTILANG_TblCamposDef,'panel-primary');
		?>
				<div class="table-responsive">
                <table class="table table-condensed btn-xs table-unbordered table-hover table-responsive">
					<thead>
                    <tr>
						<td><b><?php echo $MULTILANG_Campo; ?></b></td>
						<td><b><?php echo $MULTILANG_Tipo; ?></b></td>
						<td><b><?php echo $MULTILANG_TblNulos; ?></b></td>
						<td><b><?php echo $MULTILANG_TblTipoClave; ?></b></td>
						<td><b><?php echo $MULTILANG_Predeterminado; ?></b></td>
						<td><b><?php echo $MULTILANG_Otros; ?></b></td>
						<td></td>
					</tr>
                    <thead>
                    <tbody>
		 <?php
				$registro=consultar_columnas($nombre_tabla);
				for($i=0;$i<count($registro);$i++)
					{
						$imagen="";
						if ($registro[$i]["llave"] != "") $imagen=' <i class="fa fa-key fa-2x fa-flip-horizontal texto-rojo"></i> ';
						echo '<tr>
								<td><b>'.$registro[$i]["nombre"].$imagen.'</b></td>
								<td>'.$registro[$i]["tipo"].'</td>
								<td>'.$registro[$i]["nulo"].'</td>
								<td>'.$registro[$i]["llave"].'</td>
								<td>'.$registro[$i]["predefinido"].'</td>
								<td>'.$registro[$i]["extras"].'</td>';
						// Permite eliminar aquellos campos diferentes al Id
						if ($registro[$i]["nombre"] != "id")
							echo '
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST" name="f'.$registro[$i]["nombre"].'" id="f'.$registro[$i]["nombre"].'">
												<input type="hidden" name="PCO_Accion" value="eliminar_campo">
												<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
												<input type="hidden" name="nombre_campo" value="'.$registro[$i]["nombre"].'">
                                                <a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="'.$MULTILANG_Eliminar.'" onClick="confirmar_evento(\''.$MULTILANG_TblAdvDelCampo.'\',f'.$registro[$i]["nombre"].');"><i class="fa fa-times"></i> '.$MULTILANG_Eliminar.'</a>
												&nbsp;&nbsp;
										</form>
								</td>';
						else
							echo '
								<td align="center">
								['.$MULTILANG_TblNoElim.']
								</td>';

						echo '	</tr>';

					}
				echo '
                </tbody>
                </table>
                </div>
                ';

			cerrar_ventana();

echo '

  </div>
</div>
';

	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: eliminar_tabla
	Elimina una tabla de aplicacion

	Variables de entrada:

		nombre_tabla - Nombre de la tabla a ser eliminada

		(start code)
			DROP TABLE $nombre_tabla
		(end)

	Salida:
		Tabla eliminada

	Ver tambien:
		<administrar_tablas>
*/
	if ($PCO_Accion=="eliminar_tabla")
		{
			$mensaje_error="";
			if ($mensaje_error=="")
				{
					// Realiza la operacion
					ejecutar_sql_unaria("DROP TABLE $nombre_tabla");
					auditar("Elimina tabla $nombre_tabla");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="PCO_Accion" value="administrar_tablas"></form>
							<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
                    mensaje('<blink>'.$MULTILANG_TblErrDel1.'</blink>',$MULTILANG_TblErrDel2, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
					echo '<form action="'.$ArchivoCORE.'" method="POST" name="cancelar"><input type="Hidden" name="PCO_Accion" value="administrar_tablas"></form>
						<br /><input type="Button" onclick="document.cancelar.submit()" name="" value="Cerrar" class="Botones">';
				}
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_crear_tabla
	Crea una nueva tabla de aplicacion

	Variables de entrada:

		nombre_tabla - Nombre de la tabla a ser creada

		(start code)
			CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))
		(end)

	Salida:
		Nueva tabla creada con el prefijo de aplicacion y nombre especificado

	Ver tambien:
		<administrar_tablas>
*/
	if ($PCO_Accion=="guardar_crear_tabla")
		{
			$mensaje_error="";
			if ($nombre_tabla=="") $mensaje_error=$MULTILANG_TblErrCrear;
			if ($mensaje_error=="")
				{
					// Crea la tabla temporal segun el motor de base de datos
					$operacion_enviada=0;

					if ($MotorBD=="mysql" && !$operacion_enviada)
						{
							$error_consulta=ejecutar_sql_unaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))");
							$operacion_enviada=1;
						}

					if ($MotorBD=="pgsql" && !$operacion_enviada)
						{
							$error_consulta=ejecutar_sql_unaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id serial, PRIMARY KEY  (id) )");
							$operacion_enviada=1;
						}

					if ($MotorBD=="sqlite" && !$operacion_enviada)
						{
							$error_consulta=ejecutar_sql_unaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id integer PRIMARY KEY AUTOINCREMENT)");
							$operacion_enviada=1;
						}

					if ( ($MotorBD=="sqlsrv" || $MotorBD=="mssql") && !$operacion_enviada)
						{
							$error_consulta=ejecutar_sql_unaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))");
							$operacion_enviada=1;
						}

					if ($MotorBD=="ibm" && !$operacion_enviada)
						{
							$error_consulta=ejecutar_sql_unaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))");
							$operacion_enviada=1;
						}

					if ($MotorBD=="dblib" && !$operacion_enviada)
						{
							$error_consulta=ejecutar_sql_unaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))");
							$operacion_enviada=1;
						}

					if ($MotorBD=="odbc" && !$operacion_enviada)
						{
							$error_consulta=ejecutar_sql_unaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))");
							$operacion_enviada=1;
						}

					if ($MotorBD=="oracle" && !$operacion_enviada)
						{
							$error_consulta=ejecutar_sql_unaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))");
							$operacion_enviada=1;
						}

					if ($MotorBD=="ifmx" && !$operacion_enviada)
						{
							$error_consulta=ejecutar_sql_unaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))");
							$operacion_enviada=1;
						}

					if ($MotorBD=="fbd" && !$operacion_enviada)
						{
							$error_consulta=ejecutar_sql_unaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))");
							$operacion_enviada=1;
						}

					//Valida si hubo errores
					if ($error_consulta!="")
						{
							echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
								<input type="Hidden" name="PCO_Accion" value="administrar_tablas">
								<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_TblError2.'">
								<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$MULTILANG_TblError3.' <i>'.$error_mysql.'</i>">
								</form>
									<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
						}
					else
						{
							auditar("Crea tabla $nombre_tabla");
							echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="PCO_Accion" value="administrar_tablas"></form>
									<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
						}
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="administrar_tablas">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_TblError1.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: copiar_tabla
	Genera el archivo de copia de una tabla

	Ver tambien:
		<administrar_tablas>
*/
	if ($PCO_Accion=="copiar_tabla")
		{
			$mensaje_error="";
			if ($nombre_tabla=="")
				$mensaje_error=$MULTILANG_ErrorTiempoEjecucion.".  No ingresado el nombre de tabla / Table name not entered";

			if ($mensaje_error=="")
				{
				//Hace copia de seguridad de la base de datos
				if ($tipo_copia_objeto=="Estructura+Datos")
					{
						$archivo_destino_backup_bdd="tmp/Tbl_".$nombre_tabla."_".$PCO_FechaOperacion."_".$PCO_HoraOperacion.".gz";
						include_once("core/backups.php");
						$objeto_backup_db = new DBBackup(array(
							'driver' => $MotorBD,
							'host' => $ServidorBD,
							'user' => $UsuarioBD,
							'password' => $PasswordBD,
							'database' => $BaseDatos,
							'prefix' => $nombre_tabla
						));
						$resultado_backup = $objeto_backup_db->backup();
						if(!$resultado_backup['error'])
							{
								// Por ahora, comprime el archivo resultante y lo guarda.
								$resultado_backup_comprimido = gzencode($resultado_backup['msg'], 9);
								$puntero_archivo_destino_backup_bdd = fopen($archivo_destino_backup_bdd, "w");
								fwrite($puntero_archivo_destino_backup_bdd, $resultado_backup_comprimido);
								fclose($puntero_archivo_destino_backup_bdd);
								
								
								//Presenta la ventana con informacion y enlace de descarga
								abrir_ventana($MULTILANG_FrmTipoCopiaExporta, 'panel-primary'); ?>
									<div align=center>
									<?php echo $MULTILANG_FrmCopiaFinalizada; ?>
									<br><br>
									<a class="btn btn-success" href="<?php echo $archivo_destino_backup_bdd; ?>" target="_BLANK" download><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_Descargar; ?></a>
									<a class="btn btn-default" href="javascript:document.core_ver_menu.submit();"><i class="fa fa-home"></i> <?php echo $MULTILANG_IrEscritorio; ?></a>
									</div>

								<?php
								cerrar_ventana();
							}
						else
							{
								echo '<hr><b>'.$MULTILANG_ErrBkpBD.'.</b>';
							}
					}

				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="administrar_formularios">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: definir_copia_tablas
	Presenta opciones para generar una copia de la tabla seleccionada
*/
if ($PCO_Accion=="definir_copia_tablas")
	{
		 ?>

        <form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="PCO_Accion" value="copiar_tabla">
			<input type="Hidden" name="nombre_tabla" value="<?php echo $nombre_tabla; ?>">

            <br>
			<?php abrir_ventana($MULTILANG_FrmTipoObjeto, 'panel-primary'); ?>
			<h4><?php echo $MULTILANG_FrmTipoCopiaExporta; ?>: <b><?php echo $nombre_tabla; ?></b></h4>
            <label for="tipo_copia_objeto"><?php echo $MULTILANG_FrmTipoCopia; ?>:</label>
            <select id="tipo_copia_objeto" name="tipo_copia_objeto" class="form-control btn-warning" >
                <option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
                <option value="Estructura"><?php echo $MULTILANG_TblTipoCopia1; ?></option>
                <option value="Datos"><?php echo $MULTILANG_TblTipoCopia2; ?></option>
                <option value="Estructura+Datos"><?php echo $MULTILANG_TblTipoCopia3; ?></option>
            </select>

            </form>
            <br>
            <div align=center>
            <a class="btn btn-success" href="javascript:document.datos.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_FrmCopiar; ?></a>
            <a class="btn btn-default" href="javascript:document.core_ver_menu.submit();"><i class="fa fa-home"></i> <?php echo $MULTILANG_IrEscritorio; ?></a>
            </div>

		<?php
		cerrar_ventana();
	}
	
	
/* ################################################################## */
/* ################################################################## */
/*
	Function: administrar_tablas
	Detecta las tablas existentes en la base de datos enlazada y permite realizar operaciones basicas con ellas, asi como la creacion de nuevas tablas de aplicacion.  Esta funciona hace uso de la funcion generalizada <consultar_tablas>

	Ver tambien:
		<asistente_tablas> | <consultar_tablas>
*/
	if ($PCO_Accion=="administrar_tablas")
		{
			abrir_ventana($MULTILANG_TblCrearListar,'panel-primary'); ?>
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="PCO_Accion" value="guardar_crear_tabla">
			<div align=center>
			<h3><?php echo $MULTILANG_TblCreaTabla; ?>:<b><?php echo $BaseDatos; ?></b>:</h3>
			<table class="TextosVentana" cellspacing=10>
			</tr>
			<td>
				<table class="TextosVentana">
					<tr>
						<td align="center"></td>
						<td>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-magic fa-fw"></i> <?php echo $TablasApp; ?></span>
                                <input name="nombre_tabla" type="text" class="form-control" placeholder="<?php echo $MULTILANG_Nombre; ?>">
                                <span class="input-group-addon">
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_FrmObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_Ayuda; ?>: <?php echo $MULTILANG_TblDesTabla; ?>" name="<?php echo $MULTILANG_TblDesTabla; ?>"><i class="fa fa-question-circle"></i></a>
                                </span>
                            </div>
                        </td>
					</tr>
					<tr>
						<td>
							</form>
						</td>
						<td>
                            <button type="button" class="btn btn-success" OnClick="document.datos.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_TblCreaTabCampos; ?></button>
							<button type="button" class="btn btn-default" OnClick="document.core_ver_menu.submit();"><i class="fa fa-desktop"></i> <?php echo $MULTILANG_IrEscritorio; ?></button>
						</td>
					</tr>
				</table>
			</td>
			<td width=50>
			</td>
			<td align=center>
				<form name="datosasis" id="datosasis" action="<?php echo $ArchivoCORE; ?>" method="POST">
				<input type="Hidden" name="PCO_Accion" value="asistente_tablas">
				<?php echo $MULTILANG_Asistente; ?><br>
				<a href="javascript:document.datosasis.submit();" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_TblTitAsis; ?>: <?php echo $MULTILANG_TblDesAsis; ?>"><i class="fa fa-magic fa-5x texto-naranja"></i></a>
				</form>
			</td>
			<tr>
			</table>
			<hr>

		<h3><?php echo $MULTILANG_TblTablasBD; ?></h3>
				<table class="table table-hover table-condensed btn-xs table-striped" >
                    <thead>
                        <tr>
                            <th><b><?php echo $MULTILANG_Nombre; ?></b></th>
                            <th><b><?php echo $MULTILANG_TblRegistros; ?></b></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
		<?php
			$resultado=consultar_tablas();

			while ($registro = $resultado->fetch())
				{
					$total_registros=ContarRegistros($registro["0"]);

					if (strpos($registro[0],$TablasCore)!==FALSE) // Booleana requiere === o !==
						{
							$PrefijoRegistro=$TablasCore;
						}
					else
						{
							$PrefijoRegistro=$TablasApp;
						}

						echo '<tr>
								<td><font color=gray>'.$PrefijoRegistro.'</font><b><font size=2>'.str_replace($PrefijoRegistro,'',$registro[0]).'</font></b></td>
								<td>'.$total_registros.'</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST" name="dco'.$registro["0"].'" id="dco'.$registro["0"].'">
												<input type="hidden" name="PCO_Accion" value="definir_copia_tablas">
												<input type="hidden" name="nombre_tabla" value="'.$registro["0"].'">
                                                <a class="btn btn-default btn-xs" href="javascript:confirmar_evento(\''.$MULTILANG_FrmAdvCopiar.'\',dco'.$registro["0"].');"><i class="fa fa-code-fork"></i> '.$MULTILANG_FrmCopiar.'</a>
										</form>
								</td>
								<td align="center">';

					if ($PrefijoRegistro!=$TablasCore && $total_registros==0)							
						echo '
										<form action="'.$ArchivoCORE.'" method="POST" name="f'.$registro["0"].'" id="f'.$registro["0"].'">
												<input type="hidden" name="PCO_Accion" value="eliminar_tabla">
												<input type="hidden" name="nombre_tabla" value="'.$registro["0"].'">
                                                <a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="'.$MULTILANG_Eliminar.'" onClick="confirmar_evento(\''.$MULTILANG_TblAdvDelTabla.'\',f'.$registro["0"].');"><i class="fa fa-times"></i> '.$MULTILANG_Eliminar.'</a>
										</form>';
						echo '
								</td>
								<td align="center">';
					if ($PrefijoRegistro!=$TablasCore)
						echo '
										<form action="'.$ArchivoCORE.'" method="POST">
												<input type="hidden" name="PCO_Accion" value="editar_tabla">
												<input type="hidden" name="nombre_tabla" value="'.$registro["0"].'">
                                                <button type="submit" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="'.$MULTILANG_Editar.'"><i class="fa fa-pencil-square-o"></i> '.$MULTILANG_Editar.'</button>
										</form>';
						echo '
								</td>
							</tr>';
				}
				echo '</tbody>
                    </table>';	
			cerrar_ventana();
			$VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_crear_tabla_asistente
	Genera una nueva tabla a partir de la plantilla seleccionada en el asistente

	Variables de entrada:

		nombre_tabla - Nombre de la tabla a ser creada

		(start code)
			CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))
			Repetir por cada campo en la definicion
				ALTER TABLE ".$TablasApp."$nombre_tabla ADD COLUMN $nombre_campo $tipo
		(end)

	Salida:
		Nueva tabla creada con el prefijo de aplicacion y nombre especificado

	Ver tambien:
		<asistente_tablas>
*/
	if ($PCO_Accion=="guardar_crear_tabla_asistente")
		{
			$mensaje_error="";
			if ($nombre_tabla=="") $mensaje_error=$MULTILANG_TblErrCrear;
			if ($plantilla_tabla=="") $mensaje_error.="<br>".$MULTILANG_TblErrPlantilla;
			if ($mensaje_error=="")
				{
					// Crea la tabla temporal
					$error_consulta=ejecutar_sql_unaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))");
					if ($error_consulta!="")
						{
							echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
								<input type="Hidden" name="PCO_Accion" value="asistente_tablas">
								<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_TblError2.'">
								<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$MULTILANG_TblError3.': <i>'.$error_mysql.'</i>">
								</form>
									<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
						}
					else
						{
							//Busca los campos en la plantilla
							$directorio="inc/practico/asistentes/";
							//Carga el archivo de plantilla
							$archivo_origen=$directorio.$plantilla_tabla;
							$archivo = fopen($archivo_origen, "r");
							if ($archivo)
								{
									$PCO_EvitarLinea = fgets($archivo, 8192); //nombre
									$NombreTabla= fgets($archivo, 8192);
									$PCO_EvitarLinea = fgets($archivo, 8192); //descripcion tabla
									$DescripcionTabla= fgets($archivo, 8192);
									$PCO_EvitarLinea = fgets($archivo, 8192); //campos
									while (!feof($archivo))
										{
											$PCO_Linea = fgets($archivo, 8192);
											$campos = explode("|", $PCO_Linea);
											// Verifica si el campo de texto no es vacio y lo agrega
											if (strlen($PCO_Linea)>5)
												{
													$nombre_campo=$campos[1];
													$tipo=$campos[2];
													$longitud=$campos[3];
													// Construye la consulta para la creacion del campo (sintaxis mysql por ahora)
													$consulta = "ALTER TABLE ".$TablasApp."$nombre_tabla ADD COLUMN $nombre_campo $tipo";
													if ($longitud!="")
														$consulta .= "($longitud) ";
													// Realiza la operacion
													ejecutar_sql_unaria($consulta);
												}
										}
									fclose($archivo);
								}
							auditar("Crea tabla $nombre_tabla");
							echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
							<input type="Hidden" name="PCO_Accion" value="editar_tabla">
							<input type="hidden" name="nombre_tabla" value="'.$TablasApp.''.$nombre_tabla.'">
							</form>
									<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
						}
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="asistente_tablas">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_TblError1.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: asistente_tablas
	Despliega el asistente para creacion de tablas basado en los archivos inc/practico/asistentes/*

	Variables de entrada:

		archivos en inc/practico/asistentes/*.txt - Contienen la definicion de tablas que pueden ser creadas con el asistente

	Salida:
		Tabla seleccionada para su creacion
		
	Ver tambien:
		<guardar_crear_tabla_asistente>
*/
	if ($PCO_Accion=="asistente_tablas")
		{
			abrir_ventana($MULTILANG_TblAsistente,'panel-primary'); ?>
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="PCO_Accion" value="guardar_crear_tabla_asistente">
			<div align=center>
			<h3><?php echo $MULTILANG_TblCreaTabla; ?> <b><?php echo $BaseDatos; ?></b>:</h3>
				<table class="table table-unbordered">
					<tr>
                        <td>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-magic fa-fw"></i> <?php echo $TablasApp; ?></span>
                                <input name="nombre_tabla" type="text" class="form-control" placeholder="<?php echo $MULTILANG_TblAsistNombre; ?>">
                                <span class="input-group-addon">
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_FrmObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_Ayuda; ?>: <?php echo $MULTILANG_TblDesTabla; ?>" name="<?php echo $MULTILANG_TblDesTabla; ?>"><i class="fa fa-question-circle"></i></a>
                                </span>
                            </div>
						</td>
					</tr>
					<tr>
						<td>
                            <div class="form-group input-group">
                            <label for="plantilla_tabla"><?php echo $MULTILANG_TblAsistPlant; ?>:</label>
							<select id="plantilla_tabla" name="plantilla_tabla" class="form-control" onChange="datos.descripciontabla.value=document.datos.plantilla_tabla.options[document.datos.plantilla_tabla.selectedIndex].label; datos.listacampos.value=document.datos.plantilla_tabla.options[document.datos.plantilla_tabla.selectedIndex].title; datos.totalcampos.value=document.datos.plantilla_tabla.options[document.datos.plantilla_tabla.selectedIndex].lang;">
								<option value="" label="" dir="" lang=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
								<?php
									$directorio="inc/practico/asistentes/";
									$dh = opendir($directorio);
									
									while (($file = readdir($dh)) !== false)
										{
											if (($file != ".") && ($file != "..") && stristr($file,"tbl_")  && !stristr($file,"~"))
												{
													//Carga el archivo de plantilla
													$archivo_origen=$directorio.$file;
													$archivo = fopen($archivo_origen, "r");
													if ($archivo)
														{
															$PCO_EvitarLinea = fgets($archivo, 8192); //nombre
															$NombreTabla= fgets($archivo, 8192);
															$PCO_EvitarLinea = fgets($archivo, 8192); //descripcion tabla
															$DescripcionTabla= fgets($archivo, 8192);
															$PCO_EvitarLinea = fgets($archivo, 8192); //campos
															$conteocampo=0;
															$DescripcionCampos="";
															while (!feof($archivo))
																{
																	$PCO_Linea = fgets($archivo, 8192);
																	$campos = explode("|", $PCO_Linea);
																	// Verifica si el campo de texto no es vacio
																	if (strlen($PCO_Linea)>5)
																		{
																			$conteocampo++;
																			$DescripcionCampos.=$campos[0]."\n";
																		}
																}
															fclose($archivo);
														}
													//Presenta la opcion del combo con los datos del archivo
													echo '<option value="'.$file.'" label="'.$DescripcionTabla.'" title="'.$DescripcionCampos.'" lang="'.$conteocampo.'">'.$NombreTabla.'</option>';
												}
										}
								?>
							</select>
                            </div>
						</td>
					</tr>
					<tr>
						<td>
							<textarea name="descripciontabla" id="descripciontabla"  class="form-control" rows="2" readonly placeholder="<?php echo $MULTILANG_InfDescripcion; ?>"></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<textarea name="listacampos" id="listacampos"  class="form-control" rows="10" readonly placeholder="<?php echo $MULTILANG_TblAsCampos; ?>"></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="totalcampos" class="form-control" placeholder="<?php echo $MULTILANG_TblTotCampos; ?>">
						</td>
					</tr>
					<tr>
						<td>
							<?php echo strtoupper($MULTILANG_Importante); ?>:<br>
                            <?php echo $MULTILANG_TblHlpAsist; ?>
						</td>
					</tr>
				</table>
                </form>

                <button class="btn btn-success btn-block" OnClick="document.datos.submit()"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_TblCreaTabCampos; ?></button>
                <button type="button" class="btn btn-default btn-block" OnClick="document.core_ver_menu.submit();"><i class="fa fa-desktop"></i> <?php echo $MULTILANG_IrEscritorio; ?></button>

<?php
			$VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
            cerrar_ventana();
	}
?>



<?php
/* ################################################################## */
/* ################################################################## */
/* ################################################################## */
/* ################################################################## */
/* ################################################################## */
/* ################################################################## */
/* ################################################################## */
/* ################################################################## */
/* AQUI EMPIEZA CODIGO DE VERSIONES ANTERIORES ESPECIFICAS PARA MYSQL y MARIADB ------ EN DESUSO-----   */
 if ($PCO_Accion=="administrar_tablas_solo_mysql")
	{
			abrir_ventana('Crear/Listar tablas de datos definidias en el sistema','panel-warning'); ?>
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="PCO_Accion" value="guardar_crear_tabla">
			<div align=center>
			<br>Crear una nueva tabla de datos en <b><?php echo $BaseDatos; ?></b>:
				<table class="TextosVentana">
					<tr>
						<td align="center">Nombre:</td>
						<td><?php echo $TablasApp; ?><input type="text" name="nombre_tabla" size="20" class="CampoTexto">
						<a href="#" title="Campo obligatorio" name=""><i class="fa fa-exclamation-triangle icon-orange"></i></a>
						<a href="#" title="Ayuda general de tablas" name="Una tabla de datos es una estrctura que le permite almacenar informaci&oacute;n. Ingrese en este espacio el nombre de la tabla sin guiones, puntos, espacios o caracteres especiales. SENSIBLE A MAYUSCULAS"><i class="fa fa-question-circle"></i></a></td>
					</tr>
					<tr>
						<td>
							</form>
						</td>
						<td>
							<input type="Button"  class="Botones" value="Crear tabla y definir campos" onClick="document.datos.submit()">
							&nbsp;&nbsp;<input type="Button" onclick="document.core_ver_menu.submit()" value="Volver al menu" class="Botones">
						</td>
					</tr>
				</table>
		<br><hr>
		<font face="" size="3" color="Navy"><b>Tablas de datos definidas por el dise&ntilde;ador para la aplicaci&oacute;n</b></font><br><br>
				<table width="100%" border="0" cellspacing="5" align="CENTER"  class="TextosVentana" >
					<tr>
						<td bgcolor="#d6d6d6"><b>Nombre</b></td>
						<td bgcolor="#D6D6D6"><b>Motor</b></td>
						<td bgcolor="#d6d6d6"><b>Formato filas</b></td>
						<td bgcolor="#d6d6d6"><b>Registros</b></td>
						<td bgcolor="#d6d6d6"><b>Media de registro</b></td>
						<td bgcolor="#d6d6d6"><b>Tama&ntilde;o</b></td>
						<td bgcolor="#d6d6d6"><b>Auto Incremento</b></td>
						<td bgcolor="#d6d6d6"><b>Creada</b></td>
						<td bgcolor="#d6d6d6"><b>Actualizada</b></td>
						<td bgcolor="#d6d6d6"><b>Set Caracteres</b></td>
						<td></td>
						<td></td>
					</tr>
		 <?php
				// Llamar aqui una equivalencia
		 
				$mysql_enlace = mysql_connect($Servidor, $UsuarioBD, $PasswordBD);
				mysql_select_db($BaseDatos, $mysql_enlace);
				$consulta = "SHOW TABLE STATUS FROM $BaseDatos WHERE Name LIKE '$TablasApp%'";
				$resultado = mysql_query($consulta,$mysql_enlace);
				while($registro = mysql_fetch_array($resultado))
					{
						echo '<tr>
								<td><font color=gray>'.$TablasApp.'</font><b><font size=2>'.str_replace($TablasApp,'',$registro[0]).'</font></b></td>
								<td>'.$registro[1].'</td>
								<td>'.$registro[3].'</td>
								<td>'.$registro[4].'</td>
								<td>'.$registro[5].'</td>
								<td>'.$registro[6].'</td>
								<td>'.$registro[10].'</td>
								<td>'.$registro[11].'</td>
								<td>'.$registro[12].'</td>
								<td>'.$registro[14].'</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST" name="f'.$registro["Name"].'" id="f'.$registro["Name"].'">
												<input type="hidden" name="PCO_Accion" value="eliminar_tabla">
												<input type="hidden" name="nombre_tabla" value="'.$registro["Name"].'">
												<input type="button" value="Eliminar"  class="BotonesCuidado" onClick="confirmar_evento(\'IMPORTANTE:  Al eliminar la tabla de datos '.$registro["Name"].' se eliminar&aacute;n tambi&eacute;n todos los registros en ella almacenados y luego no podr&aacute; deshacer esta operaci&oacute;n.\nEst&aacute; seguro que desea continuar ?\',f'.$registro["Name"].');">
												&nbsp;&nbsp;
										</form>
								</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST">
												<input type="hidden" name="PCO_Accion" value="editar_tabla">
												<input type="hidden" name="nombre_tabla" value="'.$registro["Name"].'">
												<input type="Submit" value="Editar"  class="Botones">
												&nbsp;&nbsp;
										</form>
								</td>
							</tr>';

					}
				echo '</table>';			
		?>

		<br><hr>
		<font face="" size="3" color="darkgray"><b>Tablas de sistema usadas por Practico (solo lectura definido por prefijo)</b></font><br><br>
				<table width="100%" border="0" cellspacing="5" align="CENTER" style="font-size: 9px; font-family: Verdana, Tahoma, Arial; color: gray;">
					<thead>
					<tr>
						<td bgcolor="#d6d6d6" title="Nombre de la tabla"><b>Nombre</b></td>
						<td bgcolor="#D6D6D6"><b>Motor</b></td>
						<td bgcolor="#d6d6d6"><b>Formato filas</b></td>
						<td bgcolor="#d6d6d6"><b>Registros</b></td>
						<td bgcolor="#d6d6d6"><b>Media de registro</b></td>
						<td bgcolor="#d6d6d6"><b>Tama&ntilde;o</b></td>
						<td bgcolor="#d6d6d6"><b>Auto Incremento</b></td>
						<td bgcolor="#d6d6d6"><b>Creada</b></td>
						<td bgcolor="#d6d6d6"><b>Actualizada</b></td>
						<td bgcolor="#d6d6d6"><b>Set Caracteres</b></td>
					</tr>
					</thead>
					<tbody>
		 <?php
				$mysql_enlace = mysql_connect($Servidor, $UsuarioBD, $PasswordBD);
				mysql_select_db($BaseDatos, $mysql_enlace);
				$consulta = "SHOW TABLE STATUS FROM $BaseDatos WHERE Name LIKE '$TablasCore%'";
				$resultado = mysql_query($consulta,$mysql_enlace);
				while($registro = mysql_fetch_array($resultado))
					{
						echo '<tr>
								<td>'.$registro[0].'</td>
								<td>'.$registro[1].'</td>
								<td>'.$registro[3].'</td>
								<td>'.$registro[4].'</td>
								<td>'.$registro[5].'</td>
								<td>'.$registro[6].'</td>
								<td>'.$registro[10].'</td>
								<td>'.$registro[11].'</td>
								<td>'.$registro[12].'</td>
								<td>'.$registro[14].'</td>
							</tr>';

					}
				echo '</tbody></table>
				';
		?>		
				
			</div>
<?php
			cerrar_ventana();
	}
?>







<?php
    function createBackup()
          {
            $key = "Tables_in_".$this->bdconfig["database"];
            $cont = 0;
            $query = "SHOW TABLES";
           
            $peticion = $this->conexion->prepare($query);
           
            $peticion->execute();
         
            while($tables = $peticion->fetch())
            {          
              $table = $tables[$key];
                 
              $backup .= "/***************************
                           Script de la tabla '".$table."'
                          ***************************/
                          CREATE TABLE `".$table."` (";
               
              $query = "SHOW COLUMNS FROM ".$table;
             
              $peticion2 = $this->conexion->prepare($query);
             
              $peticion2->execute();
             
              while($column = $peticion2->fetch())
              {      
                $primary_key;
                             
                if ($column["Null"] == "NO")
                {
                  $null = "NOT NULL";
                }
                else
                {
                  $null = "NULL";
                }
               
                if ($column["Key"] == "PRI")
                {
                  $primary_key = $column["Field"];
                }
               
                $backup .= "`".$column["Field"]."` ".$column["Type"]." DEFAULT '".$column["Default"]."' ".$null." ".$columns["Extra"]." ,
               ";              
              }        
             
              $backup .= "PRIMARY KEY ( `".$primary_key."` ) )
               
             ";
               
              $backup = str_replace("DEFAULT ''", "", $backup);  
               
              // El resto del código para el backup
            }
     
            return $backup;
    }
    
    // REVISAR ADEMAS: http://www.sitepoint.com/forums/php-application-design-147/pdo-getcolumnmeta-bug-497257.html
    
?>

