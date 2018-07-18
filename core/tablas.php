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
	Function: PCO_EliminarCampoTabla
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
		<PCO_EditarTabla> | <PCO_GuardarCrearCampo>
*/
	if ($PCO_Accion=="PCO_EliminarCampoTabla")
		{ 
			$mensaje_error="";
			
			// Busca si existen formularios utilizando el campo de la tabla antes de ser eliminado
			//$consulta = "SELECT * FROM ".$TablasCore."formulario_objeto WHERE id='$formulario'";
			//$resultado = mysql_query($consulta,$mysql_enlace);
			//$registro = mysql_fetch_array($resultado);

			if ($mensaje_error=="")
				{
					// Realiza la operacion
					PCO_EjecutarSQLUnaria("ALTER TABLE $nombre_tabla DROP COLUMN $nombre_campo");
					PCO_Auditar("Elimina campo $nombre_campo de tabla $nombre_tabla");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="PCO_EditarTabla">
					<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
					</form>
							<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_EditarTabla">
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
	Function: PCO_GuardarCrearCampo
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
		<PCO_EditarTabla>
*/
	if ($PCO_Accion=="PCO_GuardarCrearCampo")
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
			PCO_EjecutarSQLUnaria($consulta);

			$ultimo_error=$ConexionPDO->errorInfo();
			$descripcion_ultimo_error=$ultimo_error[2];
			if ($descripcion_ultimo_error!="")
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_EditarTabla">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_TblError2.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$MULTILANG_TblError3.': <i>'.$descripcion_ultimo_error.'</i>">
						</form>
							<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					PCO_Auditar("Agrega campo $nombre_campo tipo $tipo a tabla $nombre_tabla");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_EditarTabla">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						</form>
							<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_EditarTabla
	Permite agregar o eliminar campos en una tabla de datos de aplicacion mediante sentencias ALTER despues de haber consultado su estructura

	Variables de entrada:

		nombre_tabla - Nombre de la tabla a ser editada

		(start code)
			DESCRIBE $nombre_tabla
		(end)

	Salida:
		Tabla con sus campos editados

	Ver tambien:
		<PCO_AsistenteTablas>
*/
if ($PCO_Accion=="PCO_EditarTabla")
	{
		 ?>

<div class="row">
  <div class="col-md-4">
      
			<?php PCO_AbrirVentana($MULTILANG_TblAgrCampo,'panel-danger'); ?>
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="PCO_Accion" value="PCO_GuardarCrearCampo">
			<input type="Hidden" name="nombre_tabla" value="<?php echo $nombre_tabla; ?>">

			<h4><?php echo $MULTILANG_TblAgrCampoTabla; ?>: <b><?php echo $nombre_tabla; ?></b>:</h4>


				<table class="table table-condensed btn-xs table-unbordered ">
					<tr>
						<td>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-magic fa-fw"></i> </span>
                                <input name="nombre_campo" type="text" class="form-control" placeholder="<?php echo $MULTILANG_Nombre; ?>">
                                <span class="input-group-addon">
                                    <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<?php echo $MULTILANG_FrmObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<b><?php echo $MULTILANG_TblTitNombre; ?></b><br><?php echo $MULTILANG_TblDesNombre; ?>"><i class="fa fa-question-circle"></i></a>
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
                                    <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<b><?php echo $MULTILANG_Importante; ?></b><br><?php echo $MULTILANG_TblDesLongitud; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<b><?php echo $MULTILANG_Ayuda; ?></b><br><?php echo $MULTILANG_TblDesLongitud2; ?>"><i class="fa fa-question-circle"></i></a>
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
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_TblTitAutoinc; ?></b><br><?php echo $MULTILANG_TblDesAutoinc; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
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
                                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_TblDesPredet; ?>"><i class="fa fa-question-circle icon-info"></i></a>
                                </span>
                            </div>
                                <div class="form-group input-group">
                                    <input name="predeterminado_valor" type="text" class="form-control">
                                    <span class="input-group-addon">
                                        <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<?php echo $MULTILANG_TblDesPredet; ?>"><i class="fa fa-question-circle"></i></a>
                                    </span>
                                </div>
						</td>
					</tr>
				</table>
                </form>
                <button type="button" class="btn btn-success btn-block" OnClick="document.datos.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_TblAgregando; ?></button>
                <button type="button" class="btn btn-default btn-block" OnClick="document.PCO_FormVerMenu.submit();"><i class="fa fa-desktop"></i> <?php echo $MULTILANG_IrEscritorio; ?></button>


		<?php
		PCO_CerrarVentana();

?>
      
  </div>    
  <div class="col-md-8">

<?php

		PCO_AbrirVentana($MULTILANG_TblCamposDef,'panel-primary');
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
				$registro=PCO_ConsultarColumnas($nombre_tabla);
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
												<input type="hidden" name="PCO_Accion" value="PCO_EliminarCampoTabla">
												<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
												<input type="hidden" name="nombre_campo" value="'.$registro[$i]["nombre"].'">
                                                <a href="#" class="btn btn-danger btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Eliminar.'" onClick="confirmar_evento(\''.$MULTILANG_TblAdvDelCampo.'\',f'.$registro[$i]["nombre"].');"><i class="fa fa-times"></i> '.$MULTILANG_Eliminar.'</a>
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

			PCO_CerrarVentana();

echo '

  </div>
</div>
';

	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_EliminarTabla
	Elimina una tabla de aplicacion

	Variables de entrada:

		nombre_tabla - Nombre de la tabla a ser eliminada

		(start code)
			DROP TABLE $nombre_tabla
		(end)

	Salida:
		Tabla eliminada

	Ver tambien:
		<PCO_AdministrarTablas>
*/
	if ($PCO_Accion=="PCO_EliminarTabla")
		{
			$mensaje_error="";
			if ($mensaje_error=="")
				{
					// Realiza la operacion
					PCO_EjecutarSQLUnaria("DROP TABLE $nombre_tabla");
					PCO_Auditar("Elimina tabla $nombre_tabla");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="PCO_Accion" value="PCO_AdministrarTablas"></form>
							<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
                    PCO_Mensaje('<blink>'.$MULTILANG_TblErrDel1.'</blink>',$MULTILANG_TblErrDel2, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
					echo '<form action="'.$ArchivoCORE.'" method="POST" name="cancelar"><input type="Hidden" name="PCO_Accion" value="PCO_AdministrarTablas"></form>
						<br /><input type="Button" onclick="document.cancelar.submit()" name="" value="Cerrar" class="Botones">';
				}
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_GuardarCrearTabla
	Crea una nueva tabla de aplicacion

	Variables de entrada:

		nombre_tabla - Nombre de la tabla a ser creada

		(start code)
			CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))
		(end)

	Salida:
		Nueva tabla creada con el prefijo de aplicacion y nombre especificado

	Ver tambien:
		<PCO_AdministrarTablas>
*/
	if ($PCO_Accion=="PCO_GuardarCrearTabla")
		{
		    $error_consulta="";
			$mensaje_error="";
			if ($nombre_tabla=="") $mensaje_error=$MULTILANG_TblErrCrear;
			if ($mensaje_error=="")
				{
					// Crea la tabla temporal segun el motor de base de datos
					$operacion_enviada=0;

					if ($MotorBD=="mysql" && !$operacion_enviada)
						{
							$error_consulta=PCO_EjecutarSQLUnaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id));");
							$operacion_enviada=1;
						}

					if ($MotorBD=="pgsql" && !$operacion_enviada)
						{
							$error_consulta=PCO_EjecutarSQLUnaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id serial, PRIMARY KEY  (id) )");
							$operacion_enviada=1;
						}

					if ($MotorBD=="sqlite" && !$operacion_enviada)
						{
							$error_consulta=PCO_EjecutarSQLUnaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id integer PRIMARY KEY AUTOINCREMENT)");
							$operacion_enviada=1;
						}

					if ( ($MotorBD=="sqlsrv" || $MotorBD=="mssql") && !$operacion_enviada)
						{
							$error_consulta=PCO_EjecutarSQLUnaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))");
							$operacion_enviada=1;
						}

					if ($MotorBD=="ibm" && !$operacion_enviada)
						{
							$error_consulta=PCO_EjecutarSQLUnaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))");
							$operacion_enviada=1;
						}

					if ($MotorBD=="dblib" && !$operacion_enviada)
						{
							$error_consulta=PCO_EjecutarSQLUnaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))");
							$operacion_enviada=1;
						}

					if ($MotorBD=="odbc" && !$operacion_enviada)
						{
							$error_consulta=PCO_EjecutarSQLUnaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))");
							$operacion_enviada=1;
						}

					if ($MotorBD=="oracle" && !$operacion_enviada)
						{
							$error_consulta=PCO_EjecutarSQLUnaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))");
							$operacion_enviada=1;
						}

					if ($MotorBD=="ifmx" && !$operacion_enviada)
						{
							$error_consulta=PCO_EjecutarSQLUnaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))");
							$operacion_enviada=1;
						}

					if ($MotorBD=="fbd" && !$operacion_enviada)
						{
							$error_consulta=PCO_EjecutarSQLUnaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))");
							$operacion_enviada=1;
						}

					//Valida si hubo errores
					if (strlen($error_consulta)>5)
						{
							echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
								<input type="Hidden" name="PCO_Accion" value="PCO_AdministrarTablas">
								<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_TblError2.'">
								<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$MULTILANG_TblError3.' <i>'.$error_mysql.'</i>">
								<input type="hidden" name="nombre_tabla" value="'.$TablasApp.$nombre_tabla.'">
								</form>
									<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
						}
					else
						{
							PCO_Auditar("Crea tabla $nombre_tabla");
							echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
								<input type="Hidden" name="PCO_Accion" value="PCO_EditarTabla">
								<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_TblError2.'">
								<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$MULTILANG_TblError3.' <i>'.$error_mysql.'</i>">
								<input type="hidden" name="nombre_tabla" value="'.$TablasApp.$nombre_tabla.'">
							    </form>
									<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
						}
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_AdministrarTablas">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_TblError1.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_CopiarTabla
	Genera el archivo de copia de una tabla

	Ver tambien:
		<PCO_AdministrarTablas>
*/
	if ($PCO_Accion=="PCO_CopiarTabla")
		{
			$mensaje_error="";
			if ($nombre_tabla=="")
				$mensaje_error=$MULTILANG_ErrorTiempoEjecucion.".  No ingresado el nombre de tabla / Table name not entered";

			if ($mensaje_error=="")
				{
					$archivo_destino_backup_bdd="tmp/Tbl_".$nombre_tabla."_".$PCO_FechaOperacion."_".$PCO_HoraOperacion.".gz";
					//Hace copia de seguridad de la tabla seleccionada
					if (PCO_Backup($nombre_tabla,$archivo_destino_backup_bdd,$tipo_copia_objeto,$codificacion_actual,$codificacion_destino))
						{
							//Presenta la ventana con informacion y enlace de descarga
							PCO_AbrirVentana($MULTILANG_FrmTipoCopiaExporta, 'panel-primary'); ?>
								<div align=center>
								<?php echo $MULTILANG_FrmCopiaFinalizada; ?>
								<br><br>
								<a class="btn btn-success" href="<?php echo $archivo_destino_backup_bdd; ?>" target="_BLANK" download><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_Descargar; ?></a>
								<a class="btn btn-default" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-home"></i> <?php echo $MULTILANG_IrEscritorio; ?></a>
								</div>
							<?php
							PCO_CerrarVentana();
						}
					else
						{
							echo '<hr><b>'.$MULTILANG_ErrBkpBD.'.</b>';
						}
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_AdministrarFormularios">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_DefinirCopiaTablas
	Presenta opciones para generar una copia de la tabla seleccionada
*/
if ($PCO_Accion=="PCO_DefinirCopiaTablas")
	{
		 ?>

		<div class="row">
			<div class="col col-md-12">

				<?php PCO_AbrirVentana($MULTILANG_FrmTipoObjeto, 'panel-primary'); ?>
				<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
					<input type="Hidden" name="PCO_Accion" value="PCO_CopiarTabla">
					<input type="Hidden" name="nombre_tabla" value="<?php echo $nombre_tabla; ?>">

					<br>
					<h4><?php echo $MULTILANG_FrmTipoCopiaExporta; ?>: <b><?php echo $nombre_tabla; ?></b></h4>
					<label for="tipo_copia_objeto"><?php echo $MULTILANG_FrmTipoCopia; ?>:</label>
					<select id="tipo_copia_objeto" name="tipo_copia_objeto" class="form-control btn-warning" >
						<option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
						<option value="Estructura"><?php echo $MULTILANG_TblTipoCopia1; ?></option>
						<option value="Datos"><?php echo $MULTILANG_TblTipoCopia2; ?></option>
						<option value="Estructura+Datos"><?php echo $MULTILANG_TblTipoCopia3; ?></option>
					</select>
					<br>
					<label for="codificacion_actual"><?php echo $MULTILANG_TblDecodificarActual; ?>:</label>
					<select id="codificacion_actual" name="codificacion_actual" class="form-control btn-info" >
						<optgroup label="Comunes">
							<option value="UTF-8">UTF-8</option>
							<option value="ASCII">ASCII</option>
							<option value="Windows-1252">Windows-1252</option>
							<option value="ISO-8859-1">ISO-8859-1</option>
						</optgroup>
						<optgroup label="Otras disponibles MbString">
							<?php
								//Presenta las listas de set de caracteres soportadas por la extension mbstring de PHP (si esta instalada)
								if (function_exists('mb_list_encodings'))
									{
										$arreglo_charsets=mb_list_encodings();
										for ($i=0;$i<count($arreglo_charsets);$i++)
											echo '<option value="'.$arreglo_charsets[$i].'">'.$arreglo_charsets[$i].'</option>';
									}
								else
									{
										echo '<option value="">Para ver mas opciones instale y active mbstring en su PHP</option>';
									}
							?>
						</optgroup>                
					</select>

					<br>
					<label for="codificacion_destino"><?php echo $MULTILANG_TblCodificar; ?>:</label>
					<select id="codificacion_destino" name="codificacion_destino" class="form-control btn-info" >
						<option value=""><?php echo $MULTILANG_TblCodificacionNINGUNO; ?></option>
						<optgroup label="Comunes">
							<option value="UTF-8">UTF-8</option>
							<option value="ASCII">ASCII</option>
							<option value="Windows-1252">Windows-1252</option>
							<option value="ISO-8859-1">ISO-8859-1</option>
						</optgroup>
						<optgroup label="Otras disponibles MbString">
							<?php
								//Presenta las listas de set de caracteres soportadas por la extension mbstring de PHP (si esta instalada)
								if (function_exists('mb_list_encodings'))
									{
										$arreglo_charsets=mb_list_encodings();
										for ($i=0;$i<count($arreglo_charsets);$i++)
											echo '<option value="'.$arreglo_charsets[$i].'">'.$arreglo_charsets[$i].'</option>';
									}
								else
									{
										echo '<option value="">Para ver mas opciones instale y active mbstring en su PHP</option>';
									}
							?>
						</optgroup>
					</select>

					<br>
					<label for="transliterar_conversion"><?php echo $MULTILANG_TblTransliteracion; ?>:</label>
					<?php echo $MULTILANG_TblTransliteracionHlp; ?>
					<select id="transliterar_conversion" name="transliterar_conversion" class="form-control btn-default" >
						<option value="0"><?php echo $MULTILANG_No; ?></option>
						<option value="1"><?php echo $MULTILANG_Si; ?> (<?php echo  $MULTILANG_TblTranslit; ?>)</option>
						<option value="2"><?php echo $MULTILANG_Si; ?> (<?php echo  $MULTILANG_TblIgnora; ?>)</option>
						<option value="3"><?php echo $MULTILANG_Si; ?> (<?php echo  "$MULTILANG_Ambos: $MULTILANG_TblIgnora / $MULTILANG_TblTranslit"; ?>)</option>
					</select>

				</form>
				<br>
				<div align=center>
				<a class="btn btn-success" href="javascript:document.datos.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_FrmCopiar; ?></a>
				<a class="btn btn-default" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-home"></i> <?php echo $MULTILANG_IrEscritorio; ?></a>
				</div>
				<?php PCO_CerrarVentana(); ?>

			</div>

		</div>

		<?php
		PCO_CerrarVentana();
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_ConfirmarImportacionTabla
	Lee el archivo cargado sobre /tmp y ejecuta los scripts SQL

	Variables de entrada:

		archivo_cargado - Ruta absoluta hacia el archivo analizado en el paso anterior del asistente

	Salida:
		Tablas generadas a partir de la definicion del archivo
*/
if ($PCO_Accion=="PCO_ConfirmarImportacionTabla")
	{
		echo "<br>";
		$mensaje_error="";
		PCO_AbrirVentana($MULTILANG_FrmImportar.' <b>'.$archivo_cargado.'</b>', 'panel-info');
		
		if ($archivo_cargado=="") $mensaje_error=$MULTILANG_ErrorTiempoEjecucion;

		if ($mensaje_error=="")
			{
				$RutaScriptSQL=$archivo_cargado;
				$archivo_consultas=fopen($RutaScriptSQL,"r");
				$total_consultas= fread($archivo_consultas,filesize($RutaScriptSQL));
				fclose($archivo_consultas);
				//Descomprime el archivo
				$total_consultas = gzdecode($total_consultas);
				//Crea arreglo de consultas y las recorre
				$arreglo_consultas = PCO_SegmentarSQL($total_consultas);
				foreach($arreglo_consultas as $consulta)
					{
						//Ejecuta el query
						PCO_EjecutarSQLUnaria($consulta);
						$total_ejecutadas++;
					}
				//Presenta mensaje de finalizacion
				echo '
				<b>'.$MULTILANG_FrmImportarGenerado.':</b><br>
				<br>
				<a class="btn btn-block btn-success" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-thumbs-up"></i> '.$MULTILANG_Finalizado.'</a>';
				PCO_Auditar("Importa $archivo_cargado en tablas de aplicacion");
			}
		else
			{
				echo '			
				<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="PCO_VerMenu">
					<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ActErrGral.'">
					<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
		echo '</center>';

		PCO_CerrarVentana();
        $VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_EjecutarImportacionCSV
	Pasa los registros desde la hoja de calculo a una tabla de datos

	Variables de entrada:

		archivo_cargado - Ruta absoluta hacia el archivo analizado en el paso anterior del asistente
		nombre_tabla - Nombre de la tabla donde se hace la importacion
		lista_campos_apareados (arreglo) - Una lista de posibles variables definidas (o no) con los campos hacia los cuales debe apuntar cada una.  Los campos obedecen al patron generado por la funcion PCO_AparearCamposTabla_vs_HojaCalculo() asi: PCO_campoimportado_XXXXXX donde XXXXXX es el nombre del campo en la tabla y su valor es el numero de la columna en el archivo cargado

	Salida:
		Consultas SQL generadas y ejecutadas para la adicion de registros en la base de datos
*/
if ($PCO_Accion=="PCO_EjecutarImportacionCSV")
	{
		//Define los arreglos con campos fijos, sus valores y campos ignorados
		$ArregloCamposIgnorados=explode($_SeparadorCampos_,$PCO_lista_campos_ignorados);
		$ArregloCamposFijos=explode($_SeparadorCampos_,$PCO_lista_campos_fijos);
		$ArregloValoresFijos=explode($_SeparadorCampos_,$PCO_lista_valores_fijos);
		$ArregloCamposLlave=explode(",",$PCO_condicion_variable_campos_llave);
		
		$RegistrosIgnorados=0;
		$RegistrosInsertados=0;
		
		//Si no recibe una condicion de filtrado fija entonces asigna una minima (1==1)
		if ($PCO_condicion_fija_campo_unico=="") $PCO_condicion_fija_campo_unico=" 1=1 ";
		
		echo "<br>";
		$mensaje_error="";
		PCO_AbrirVentana($MULTILANG_Importar.' <b>'.$archivo_cargado.'</b>', 'panel-info');
		
		if ($archivo_cargado=="") $mensaje_error=$MULTILANG_ErrorTiempoEjecucion;
		
		if ($mensaje_error=="")
			{
				//Crea el objeto para lectura del archivo
				$XLFileType = PHPExcel_IOFactory::identify($archivo_cargado);
				$objReader = PHPExcel_IOFactory::createReader($XLFileType);
				$objReader->setLoadSheetsOnly(0);	//Asume que la primera hoja tiene los datos.  ALTERNATIVA INDICANDO EL NOMBRE DE HOJA : $objReader->setLoadSheetsOnly('Hoja1');
				$objPHPExcel = $objReader->load($archivo_cargado);

				//Recorre el archivo mientras no encuentre un valor vacio en la primer fila (asumido como llave)
				$Fila=1;
				$ColumnaDeLlave=0;
				$FinEscaneo=0; //Pasa a 1 si se llega a una fila con la columna 0 vacia
				$CadenaRegistrosInsertados="";
				$CadenaRegistrosIgnorados="";

				$Fila++; //Obvia la primera fila pues se trata del encabezado
				while (!$FinEscaneo)
					{
						//Asume que la primera columna siempre tiene dato (llave o algo minimo) para agregarla a la tabla, sino no es agregada
						if ($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($ColumnaDeLlave, $Fila)->getFormattedValue()!="")
							{
								//Busca las columnas definidas en la tabla
								$CamposTabla=PCO_ConsultarColumnas($nombre_tabla);

								//Busca por cada campo de tabla algun equivalente en las columnas
								$ListaCamposImportacion="";
								$ListaValoresImportacion="";
								$ListaCamposLlaveUnica="";
								for ($i=0;$i<count($CamposTabla);$i++)
									{				
										$CampoAProcesar = $CamposTabla[$i]["nombre"];
										$VariableDinamicaNombreCampo="PCO_campoimportado_".$CampoAProcesar;
										$ColumnaDinamicaArchivo=${$VariableDinamicaNombreCampo};
										
										//echo $VariableDinamicaNombreCampo;
										if ($ColumnaDinamicaArchivo!=0) //Descarta el primer indice de combo
											{
												$ListaCamposImportacion.=$CampoAProcesar.",";
												$ListaValoresImportacion.='"'.$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($ColumnaDinamicaArchivo-1, $Fila)->getFormattedValue().'",';
												
												//Verifica si el campo es de tipo llave unica y lo agrega a los campos de condicion
												if (  in_array($CamposTabla[$i]["nombre"],$ArregloCamposLlave)  )
													$ListaCamposLlaveUnica.=$CampoAProcesar."='".$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($ColumnaDinamicaArchivo-1, $Fila)->getFormattedValue()."' AND ";
											}
									}
								
								//Agrega los campos de valor fijo, que se supone no fueron agregados a la consulta en el FOR previo
								for($i=0;$i<count($ArregloCamposFijos);$i++)
									{				
										$ListaCamposImportacion.=$ArregloCamposFijos[$i].",";
										$ListaValoresImportacion.='"'.$ArregloValoresFijos[$i].'",';
									}

								//Elimina coma en la lista de campos y valores
								$ListaCamposImportacion=substr($ListaCamposImportacion, 0, strlen($ListaCamposImportacion)-1);
								$ListaValoresImportacion=substr($ListaValoresImportacion, 0, strlen($ListaValoresImportacion)-1);
								//Construye la consulta
								$ConsultaImportacionSQL="INSERT INTO $nombre_tabla ($ListaCamposImportacion) VALUES ($ListaValoresImportacion) ";
								
								//Verifica si el registro ya existe o no segun los campos de llave y si realmente recibio listas y campos para filtrar
								if ($ListaCamposLlaveUnica=="") $ListaCamposLlaveUnica=" 1=1 AND ";
								if ($ListaCamposLlaveUnica!=" 1=1 AND " || $PCO_condicion_fija_campo_unico!=" 1=1 ")
									{
										$ConsultaUnicidad="SELECT id FROM $nombre_tabla WHERE $ListaCamposLlaveUnica $PCO_condicion_fija_campo_unico ";
										$registro_existencia=PCO_EjecutarSQL($ConsultaUnicidad)->fetch();
										if ($registro_existencia["id"]!="")
											{
												$RegistrosIgnorados++;
												$CadenaRegistrosIgnorados.=$ListaCamposLlaveUnica;
											}
										else
											{
												//Ejecuta la consulta
												PCO_EjecutarSQL($ConsultaImportacionSQL);
												$RegistrosInsertados++;
												$CadenaRegistrosInsertados.=$ListaCamposLlaveUnica;
											}
									}
							}
						else
							{
								$FinEscaneo=1;
							}
						$Fila++;
					}
				$Fila-=2; //Quita el encabezado y la ultima vacia
				echo "<hr><b>$MULTILANG_TotalRegistros:</b> $Fila <br>";
		?>
			<div class="panel-group" id="accordion">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><b>Total IMPORTADOS: <?php echo $RegistrosInsertados; ?></b>.  Clic para ver el detalle</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse">
						<div class="panel-body">
							<p><?php echo str_replace(" AND ","<BR>",$CadenaRegistrosInsertados); ?></p>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><b>Total IGNORADOS: <?php echo $RegistrosIgnorados; ?></b>.  Clic para ver el detalle</a>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse">
						<div class="panel-body">
							<p><?php echo str_replace(" AND ","<BR>",$CadenaRegistrosIgnorados); ?></p>
						</div>
					</div>
				</div>
			</div>
		<?php
				//Presenta mensaje de finalizacion
				echo '
				<a class="btn btn-block btn-success" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-thumbs-up"></i> '.$MULTILANG_Finalizado.'</a>';
				PCO_Auditar("Importa tabla desde $archivo_cargado en $nombre_tabla");
			}
		else
			{
				echo '			
				<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="PCO_VerMenu">
					<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ActErrGral.'">
					<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
		echo '</center>';

		PCO_CerrarVentana();
        $VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_AnalizarImportacionCSV
	Revisa los archivos de hoja de calculo cargados antes de subirlos a la tabla de datos
*/
if ($PCO_Accion=="PCO_AnalizarImportacionCSV")
	{

		//Determina el tipo de archivo detectado
		$XLFileType = PHPExcel_IOFactory::identify($archivo_cargado);
	?>

		<h3><?php echo $MULTILANG_Importando; ?>  <b><?php echo str_replace("tmp/","",$archivo_cargado); ?> (<?php echo $XLFileType; ?>) <i class="fa fa-arrow-right"></i> <?php echo $nombre_tabla; ?></b></h3>
		<div class="row">
			<div class="col col-md-12">
				<?php
					PCO_AbrirVentana($MULTILANG_InfCargaPrev.' '.str_replace("tmp/","",$archivo_cargado).' (primeras 50 lineas - first 50 lines)', 'panel-primary'); 
					echo PCO_DatatableDesdeHojaCalculo($archivo_cargado,50);
				?>
				<?php PCO_CerrarVentana(); ?>
			</div>
		</div>
		
		<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
		<div class="row">
			<div class="col col-md-6">
				<?php
					PCO_AbrirVentana($MULTILANG_TblCorrespondencia, 'panel-danger'); 
				?>
						<input type="Hidden" name="PCO_Accion" value="PCO_EjecutarImportacionCSV">
						<input type="Hidden" name="archivo_cargado" value="<?php echo $archivo_cargado; ?>">
						<input type="Hidden" name="PCO_lista_campos_fijos" value="<?php echo $PCO_lista_campos_fijos; ?>">
						<input type="Hidden" name="PCO_lista_valores_fijos" value="<?php echo $PCO_lista_valores_fijos; ?>">
						<input type="Hidden" name="PCO_lista_campos_ignorados" value="<?php echo $PCO_lista_campos_ignorados; ?>">
						<input type="Hidden" name="nombre_tabla" value="<?php echo $nombre_tabla; ?>">
						<input type="Hidden" name="PCO_condicion_fija_campo_unico" value="<?php echo $PCO_condicion_fija_campo_unico; ?>">
						<input type="Hidden" name="PCO_condicion_variable_campos_llave" value="<?php echo $PCO_condicion_variable_campos_llave; ?>">
						<?php
							echo PCO_AparearCamposTabla_vs_HojaCalculo($nombre_tabla,$archivo_cargado);
						?>

				<?php PCO_CerrarVentana(); ?>
			</div>
			<div class="col col-md-6">
					<div align="center">
						<div class="alert alert-warning">
							<h3><?php echo $MULTILANG_Atencion; ?></h3>
							<?php echo $MULTILANG_TblApareaMsg; ?><hr>
							
							<?php echo $MULTILANG_TblPoliticaImportacion; ?><hr>							
							<select id="PCO_politica_registros_duplicados" name="PCO_politica_registros_duplicados" class="form-control btn-warning">
								<option value="ignorar"><?php echo $MULTILANG_TblIgnorarRegistro; ?></option>
							</select>
							<hr>
							
							<b><?php echo $MULTILANG_Confirma; ?><br></b>
							
							<a class="btn btn-danger" href="javascript:document.datos.submit();"><i class="fa fa-arrow-circle-right"></i> <?php echo $MULTILANG_Si; ?>, <?php echo $MULTILANG_Importar; ?></a>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a class="btn btn-default" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-times"></i> <?php echo $MULTILANG_No; ?>, <?php echo $MULTILANG_Cancelar; ?></a>
							<br><br>
						</div>
					</div>
			</div>
		</div>
		</form>


		<?php
		PCO_CerrarVentana();
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_AnalizarImportacionCSV
	Revisa los archivos de hoja de calculo cargados antes de subirlos a la tabla de datos
*/
if ($PCO_Accion=="PCO_EscogerTablaImportacionCSV")
	{
		PCO_AbrirVentana($MULTILANG_Seleccionar, 'panel-primary'); ?>
				<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
					<input type="Hidden" name="PCO_Accion" value="PCO_AnalizarImportacionCSV">
					<input type="Hidden" name="archivo_cargado" value="<?php echo $archivo_cargado; ?>">

					<h4><label for="nombre_tabla"><?php echo $MULTILANG_TablaDatos; ?>:</label></h4>
					
					<?php echo $MULTILANG_TblTablaImportacion; ?>
					<select id="nombre_tabla" name="nombre_tabla" class="form-control btn-warning">
					<option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
						 <?php
								$resultado=PCO_ConsultarTablas();
								while ($registro = $resultado->fetch())
									{
										// Imprime solamente las tablas de aplicacion, es decir, las que no cumplen prefijo de internas de Practico
										if (strpos($registro[0],$TablasCore)===FALSE)  // Booleana requiere === o !==
											echo '<option value="'.$registro[0].'" >'.str_replace($TablasApp,'',$registro[0]).'</option>';
									}
						?>
					</select>

				</form>
				<br>
				<div align=center>
				<a class="btn btn-success" href="javascript:document.datos.submit();"><i class="fa fa-arrow-circle-right"></i> <?php echo $MULTILANG_Continuar; ?></a>
				<a class="btn btn-default" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-home"></i> <?php echo $MULTILANG_IrEscritorio; ?></a>
				</div>
		<?php
		PCO_CerrarVentana();
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_ImportarTabla
	Presenta el paso 1 de importacion de tablas
*/
if ($PCO_Accion=="PCO_ImportarTabla")
	{
		echo "<br>";
		PCO_AbrirVentana($NombreRAD.' - '.$MULTILANG_TblImportar,'panel-info');
?>

    <ul class="nav nav-tabs nav-justified">
    <li class="active"><a href="#pestana_importacion" data-toggle="tab"><i class="fa fa-cloud-upload"></i> <?php echo $MULTILANG_TblImportarSQL; ?></a></li>
    <li><a href="#pestana_importacion_csv" data-toggle="tab"><i class="fa fa-cloud-upload"></i> <?php echo $MULTILANG_TblImportarXLS; ?></a></li>
    <li><a href="#historico_importaciones" data-toggle="tab"><i class="fa fa-history"></i> <?php echo $MULTILANG_Historico; ?></a></li>
    </ul>

    <div class="tab-content">
        
        <!-- INICIO TAB IMPORTACION SQL -->
        <div class="tab-pane fadein active" id="pestana_importacion">
            <br>
            <b><?php echo $MULTILANG_Atencion.":</b><br>".$MULTILANG_TblSQLConsejo; ?>
            <br><hr>
                        <form action="<?php echo $ArchivoCORE; ?>" method="post" enctype="multipart/form-data">
							<label for="extension_archivo"><?php echo $MULTILANG_FrmFormatoEntrada; ?>:</label>
							<select id="extension_archivo" name="extension_archivo" class="form-control">
								<option value=".gz">.GZ (<?php echo $MULTILANG_TblImportarSQL; ?>)</option>
							</select>
                            <input type="hidden" name="MAX_FILE_SIZE" value="8192000">
                            <input type="Hidden" name="PCO_Accion" value="cargar_archivo">
                            <input type="Hidden" name="siguiente_accion" value="PCO_ConfirmarImportacionTabla">
                            <input type="Hidden" name="texto_boton_siguiente" value="<?php echo $MULTILANG_TblEjecutarSQL; ?>">
                            <input type="Hidden" name="carpeta" value="tmp">
                            <input name="archivo" type="file" class="form-control btn btn-info">
                            <br>
                            <button type="submit"  class="btn btn-success"><i class="fa fa-cloud-upload"></i> <?php echo $MULTILANG_CargarArchivo; ?></button> (<?php echo $MULTILANG_ActSobreescritos; ?>)
                        </form> 
                        <br><hr>
        </div>
        <!-- FIN TAB IMPORTACION SQL -->

        <!-- INICIO TAB IMPORTACION HOJAS DE CALCULO-->
        <div class="tab-pane fadein" id="pestana_importacion_csv">
            <br>
            <b><?php echo $MULTILANG_Atencion.":</b><br>".$MULTILANG_TblXLSConsejo; ?>
            <br><hr>
                        <form action="<?php echo $ArchivoCORE; ?>" method="post" enctype="multipart/form-data">
							<label for="extension_archivo"><?php echo $MULTILANG_FrmFormatoEntrada; ?>:</label>
							<select id="extension_archivo" name="extension_archivo" class="form-control">
								<option value=".xls"  >Excel 5 (.XLS)</option>
								<option value=".xlsx" >Excel 2007 (.XLSX - XML Document)</option>
								<!-- <option value=".ods"  >Libre Office (.ODS - Open Document)</option> -->
								<!-- <option value=".csv"  >Separado por comas (.CSV - Comma Separated Values)</option>-->
							</select>
							<br>
                            <input type="hidden" name="MAX_FILE_SIZE" value="8192000">
                            <input type="Hidden" name="PCO_Accion" value="cargar_archivo">
                            <input type="Hidden" name="siguiente_accion" value="PCO_EscogerTablaImportacionCSV">
                            <input type="Hidden" name="texto_boton_siguiente" value="<?php echo $MULTILANG_Continuar; ?>">
                            <input type="Hidden" name="carpeta" value="tmp">
                            <input name="archivo" type="file" class="form-control btn btn-info">
                            <br>
                            <button type="submit"  class="btn btn-success"><i class="fa fa-cloud-upload"></i> <?php echo $MULTILANG_CargarArchivo; ?></button> (<?php echo $MULTILANG_ActSobreescritos; ?>)
                        </form> 
                        <br><hr>
        </div>
        <!-- FIN TAB IMPORTACION HOJAS DE CALCULO -->


        <!-- INICIO TAB HISTORICO DE IMPORTACIONES -->
        <div class="tab-pane fade" id="historico_importaciones">
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
                        $resultado=@PCO_EjecutarSQL("SELECT $ListaCamposSinID_auditoria FROM ".$TablasCore."auditoria WHERE accion LIKE '%Import%' AND accion LIKE '%.gz%' ORDER BY fecha DESC, hora DESC LIMIT 0,30");
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
        <!-- FIN TAB HISTORICO DE IMPORTACIONES -->
        
    </div>

<?php
		PCO_AbrirBarraEstado();
		echo '<a class="btn btn-warning btn-block" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-home"></i> '.$MULTILANG_Cancelar.'</a>';
		PCO_CerrarBarraEstado();
		PCO_CerrarVentana();
        $VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
	}

	
/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_AdministrarTablas
	Detecta las tablas existentes en la base de datos enlazada y permite realizar operaciones basicas con ellas, asi como la creacion de nuevas tablas de aplicacion.  Esta funciona hace uso de la funcion generalizada <PCO_ConsultarTablas>

	Ver tambien:
		<PCO_AsistenteTablas> | <PCO_ConsultarTablas>
*/
	if ($PCO_Accion=="PCO_AdministrarTablas")
		{
			PCO_AbrirVentana($MULTILANG_TblCrearListar,'panel-primary'); ?>
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="PCO_Accion" value="PCO_GuardarCrearTabla">
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
                                    <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<?php echo $MULTILANG_FrmObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<b><?php echo $MULTILANG_Ayuda; ?></b><br><?php echo $MULTILANG_TblDesTabla; ?>" name="<?php echo $MULTILANG_TblDesTabla; ?>"><i class="fa fa-question-circle"></i></a>
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
							<button type="button" class="btn btn-default" OnClick="document.PCO_FormVerMenu.submit();"><i class="fa fa-desktop"></i> <?php echo $MULTILANG_IrEscritorio; ?></button>
						</td>
					</tr>
				</table>
			</td>
			<td width=50></td>
			<td align=center>
				<form name="datosasis" id="datosasis" action="<?php echo $ArchivoCORE; ?>" method="POST">
				<input type="Hidden" name="PCO_Accion" value="PCO_AsistenteTablas">
				<?php echo $MULTILANG_Asistente; ?><br>
				<a href="javascript:document.datosasis.submit();"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<b><?php echo $MULTILANG_TblTitAsis; ?></b><br><?php echo $MULTILANG_TblDesAsis; ?>"><i class="btn fa fa-magic fa-5x texto-naranja"></i></a>
				</form>
			</td>
			<td width=50></td>
			<td align=center>
				<form name="importacion" id="importacion" action="<?php echo $ArchivoCORE; ?>" method="POST">
					<input type="Hidden" name="PCO_Accion" value="PCO_ImportarTabla">
				</form>
				<a class="btn btn-warning btn-block" href="javascript:document.importacion.submit();"><i class="fa fa-cloud-upload"></i> <?php echo $MULTILANG_TblImportar; ?></a>
			</td>
			<tr>
			</table>
			<hr>

		<h3><?php echo $MULTILANG_TblTablasBD; ?></h3>
				<table class="table table-hover table-condensed btn-xs table-striped table-responsive" >
                    <thead>
                        <tr>
                            <th><b><?php echo $MULTILANG_Nombre; ?></b></th>
                            <th><b><?php echo $MULTILANG_TblRegistros; ?></b></th>
                            <th><?php echo $MULTILANG_Tareas; ?></th>
                            <th class="warning"><?php echo $MULTILANG_DefMantenimientos; ?></th>
                            <th class="danger"><?php echo $MULTILANG_ZonaPeligro; ?></th>
                        </tr>
                    </thead>
                    <tbody>
		<?php
			$resultado=PCO_ConsultarTablas();

			while ($registro = $resultado->fetch())
				{
					$total_registros=PCO_ContarRegistrosTabla($registro["0"]);

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
								<td>'.$total_registros.'</td>';
						echo '<td>';
						
								//Boton de copiar tabla
								echo '<form action="'.$ArchivoCORE.'" method="POST" name="dco'.$registro["0"].'" id="dco'.$registro["0"].'" style="display:inline;">
										<input type="hidden" name="PCO_Accion" value="PCO_DefinirCopiaTablas">
										<input type="hidden" name="nombre_tabla" value="'.$registro["0"].'">
										<a class="btn btn-default btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_FrmCopiar.'" href="javascript:confirmar_evento(\''.$MULTILANG_FrmAdvCopiar.'\',dco'.$registro["0"].');"><i class="fa fa-code-fork fa-fw"></i></a>
									</form>';					
								
								//Determina si activa o no el boton de editar
								if ($PrefijoRegistro!=$TablasCore)
									echo '<form action="'.$ArchivoCORE.'" method="POST" style="display:inline;">
											<input type="hidden" name="PCO_Accion" value="PCO_EditarTabla">
											<input type="hidden" name="nombre_tabla" value="'.$registro["0"].'">
											<button type="submit" class="btn btn-warning btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Editar.'"><i class="fa fa-pencil-square-o fa-fw"></i></button>
										</form>';
								else
									echo '<form style="display:inline;">
											<button type="submit" class="btn btn-warning btn-xs" disabled="disabled"><i class="fa fa-pencil-square-o fa-fw"></i></button>
										</form>';
						echo '</td>';


						//ZONA MANTENIMIENTO
						echo '<td class="warning">';
								echo '<form style="display:inline;">
										<a class="btn btn-info btn-xs"   data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_TblAnaliza.'"  OnClick=\'if (confirm("'.$MULTILANG_Confirma.'")) { PCO_VentanaPopup("index.php?PCO_Accion=mantenimiento_tablas&PCO_PrefijoTablas='.$registro["0"].'&PCO_TipoOperacion=ANALYZE&Presentar_FullScreen=1&Precarga_EstilosBS=1","Mantenimiento","toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=yes, resizable=yes, fullscreen=no, width=700, height=500"); }\'><i class="fa fa-eye fa-fw"></i></a>
									</form>';
								echo '<form style="display:inline;">
										<a class="btn btn-primary btn-xs"   data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_TblOptimizar.'"  OnClick=\'if (confirm("'.$MULTILANG_Confirma.'")) { PCO_VentanaPopup("index.php?PCO_Accion=mantenimiento_tablas&PCO_PrefijoTablas='.$registro["0"].'&PCO_TipoOperacion=OPTIMIZE&Presentar_FullScreen=1&Precarga_EstilosBS=1","Mantenimiento","toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=yes, resizable=yes, fullscreen=no, width=700, height=500"); }\'><i class="fa fa-line-chart fa-fw"></i></a>
									</form>';
								echo '<form style="display:inline;">
										<a class="btn btn-default btn-xs"   data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_TblReparar.'"  OnClick=\'if (confirm("'.$MULTILANG_Confirma.'")) { PCO_VentanaPopup("index.php?PCO_Accion=mantenimiento_tablas&PCO_PrefijoTablas='.$registro["0"].'&PCO_TipoOperacion=REPAIR&Presentar_FullScreen=1&Precarga_EstilosBS=1","Mantenimiento","toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=yes, resizable=yes, fullscreen=no, width=700, height=500"); }\'><i class="fa fa-wrench fa-fw"></i></a>
									</form>';
						echo '</td>';

						//ZONA DE PELIGRO
						//Inhabilita las tablas del nucleo
						$EstadoActivacion=' ';
						if ($PrefijoRegistro==$TablasCore) $EstadoActivacion=' disabled="disabled" ';
						echo '<td class="danger">';
								echo '<form style="display:inline;">
										<a class="btn btn-danger btn-xs" '.$EstadoActivacion.'  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Truncar.'"  OnClick=\'if (confirm("'.$MULTILANG_Confirma.'")) { PCO_VentanaPopup("index.php?PCO_Accion=mantenimiento_tablas&PCO_PrefijoTablas='.$registro["0"].'&PCO_TipoOperacion=TRUNCATE&Presentar_FullScreen=1&Precarga_EstilosBS=1","Mantenimiento","toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=yes, resizable=yes, fullscreen=no, width=700, height=500"); }\'><i class="fa fa-eraser fa-fw"></i></a>
									</form>';
								echo '<form style="display:inline;">
										<a class="btn btn-danger btn-xs" '.$EstadoActivacion.'  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_TblVaciar.'"  OnClick=\'if (confirm("'.$MULTILANG_Confirma.'")) { PCO_VentanaPopup("index.php?PCO_Accion=mantenimiento_tablas&PCO_PrefijoTablas='.$registro["0"].'&PCO_TipoOperacion=DELETE&Presentar_FullScreen=1&Precarga_EstilosBS=1","Mantenimiento","toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=yes, resizable=yes, fullscreen=no, width=700, height=500"); }\'><i class="fa fa-trash-o fa-fw"></i></a>
									</form>';

								//Determina si activar o no el boton de eliminar
								if ($PrefijoRegistro!=$TablasCore && $total_registros==0)							
									echo '<form action="'.$ArchivoCORE.'" method="POST" name="f'.$registro["0"].'" id="f'.$registro["0"].'" style="display:inline;">
											<input type="hidden" name="PCO_Accion" value="PCO_EliminarTabla">
											<input type="hidden" name="nombre_tabla" value="'.$registro["0"].'">
											<a href="#" class="btn btn-danger btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Eliminar.'" onClick="confirmar_evento(\''.$MULTILANG_TblAdvDelTabla.'\',f'.$registro["0"].');"><i class="fa fa-times fa-fw"></i></a>
										</form>';
								else
									echo '<form style="display:inline;">
												<a href="#" class="btn btn-danger btn-xs" disabled="disabled"><i class="fa fa-times fa-fw"></i></a>
											</form>';	

						echo '</td>';


						echo '	</tr>';
				}
				echo '</tbody>
                    </table>';	
			PCO_CerrarVentana();
			$VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_GuardarCrearTablaAsistente
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
		<PCO_AsistenteTablas>
*/
	if ($PCO_Accion=="PCO_GuardarCrearTablaAsistente")
		{
			$mensaje_error="";
			if ($nombre_tabla=="") $mensaje_error=$MULTILANG_TblErrCrear;
			if ($plantilla_tabla=="") $mensaje_error.="<br>".$MULTILANG_TblErrPlantilla;
			if ($mensaje_error=="")
				{
					// Crea la tabla temporal
					$error_consulta=PCO_EjecutarSQLUnaria("CREATE TABLE ".$TablasApp."$nombre_tabla (id int(11) AUTO_INCREMENT,PRIMARY KEY  (id))");
					if ($error_consulta!="")
						{
							echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
								<input type="Hidden" name="PCO_Accion" value="PCO_AsistenteTablas">
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
													PCO_EjecutarSQLUnaria($consulta);
												}
										}
									fclose($archivo);
								}
							PCO_Auditar("Crea tabla $nombre_tabla");
							echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
							<input type="Hidden" name="PCO_Accion" value="PCO_EditarTabla">
							<input type="hidden" name="nombre_tabla" value="'.$TablasApp.''.$nombre_tabla.'">
							</form>
									<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
						}
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_AsistenteTablas">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_TblError1.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_AsistenteTablas
	Despliega el asistente para creacion de tablas basado en los archivos inc/practico/asistentes/*

	Variables de entrada:

		archivos en inc/practico/asistentes/*.txt - Contienen la definicion de tablas que pueden ser creadas con el asistente

	Salida:
		Tabla seleccionada para su creacion
		
	Ver tambien:
		<PCO_GuardarCrearTablaAsistente>
*/
	if ($PCO_Accion=="PCO_AsistenteTablas")
		{
			PCO_AbrirVentana($MULTILANG_TblAsistente,'panel-primary'); ?>
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="PCO_Accion" value="PCO_GuardarCrearTablaAsistente">
			<div align=center>
			<h3><?php echo $MULTILANG_TblCreaTabla; ?> <b><?php echo $BaseDatos; ?></b>:</h3>
				<table class="table table-unbordered">
					<tr>
                        <td>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-magic fa-fw"></i> <?php echo $TablasApp; ?></span>
                                <input name="nombre_tabla" type="text" class="form-control" placeholder="<?php echo $MULTILANG_TblAsistNombre; ?>">
                                <span class="input-group-addon">
                                    <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<?php echo $MULTILANG_FrmObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                                    <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<b><?php echo $MULTILANG_Ayuda; ?></b><br><?php echo $MULTILANG_TblDesTabla; ?>" name="<?php echo $MULTILANG_TblDesTabla; ?>"><i class="fa fa-question-circle"></i></a>
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
                <button type="button" class="btn btn-default btn-block" OnClick="document.PCO_FormVerMenu.submit();"><i class="fa fa-desktop"></i> <?php echo $MULTILANG_IrEscritorio; ?></button>

<?php
			$VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
            PCO_CerrarVentana();
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
			PCO_AbrirVentana('Crear/Listar tablas de datos definidias en el sistema','panel-warning'); ?>
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="PCO_Accion" value="PCO_GuardarCrearTabla">
			<div align=center>
			<br>Crear una nueva tabla de datos en <b><?php echo $BaseDatos; ?></b>:
				<table class="TextosVentana">
					<tr>
						<td align="center">Nombre:</td>
						<td><?php echo $TablasApp; ?><input type="text" name="nombre_tabla" size="20" class="CampoTexto">
						<a  href="#" data-toggle="tooltip" data-html="true"  title="Campo obligatorio" name=""><i class="fa fa-exclamation-triangle icon-orange"></i></a>
						<a  href="#" data-toggle="tooltip" data-html="true"  title="Ayuda general de tablas" name="Una tabla de datos es una estrctura que le permite almacenar informaci&oacute;n. Ingrese en este espacio el nombre de la tabla sin guiones, puntos, espacios o caracteres especiales. SENSIBLE A MAYUSCULAS"><i class="fa fa-question-circle"></i></a></td>
					</tr>
					<tr>
						<td>
							</form>
						</td>
						<td>
							<input type="Button"  class="Botones" value="Crear tabla y definir campos" onClick="document.datos.submit()">
							&nbsp;&nbsp;<input type="Button" onclick="document.PCO_FormVerMenu.submit()" value="Volver al menu" class="Botones">
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
												<input type="hidden" name="PCO_Accion" value="PCO_EliminarTabla">
												<input type="hidden" name="nombre_tabla" value="'.$registro["Name"].'">
												<input type="button" value="Eliminar"  class="BotonesCuidado" onClick="confirmar_evento(\'IMPORTANTE:  Al eliminar la tabla de datos '.$registro["Name"].' se eliminar&aacute;n tambi&eacute;n todos los registros en ella almacenados y luego no podr&aacute; deshacer esta operaci&oacute;n.\nEst&aacute; seguro que desea continuar ?\',f'.$registro["Name"].');">
												&nbsp;&nbsp;
										</form>
								</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST">
												<input type="hidden" name="PCO_Accion" value="PCO_EditarTabla">
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
			PCO_CerrarVentana();
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