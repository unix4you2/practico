<?php
	/*
	Copyright (C) 2013  John F. Arroyave Gutiérrez
						unix4you2@gmail.com
						www.practico.org

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
				Title: Modulo replicacion de operaciones
				Ubicacion *[/core/replicacion.php]*.  Archivo de funciones relacionadas con la replica automatia de operaciones en bases de datos
			*/
?>


<?php 
/* ################################################################## */
/* ################################################################## */
if ($PCO_Accion=="eliminar_replica")
	{
		/*
			Function: eliminar_replica
			Elimina un servidor registrado para replica de operaciones de bases de datos.

			Variables de entrada:

				id - Identificador unico en la tabla de replicasbd

			(start code)
				DELETE FROM ".$TablasCore."replicasbd WHERE id=$id
			(end)

			Salida:
				Replicas actualizadas.

			Ver tambien:
			<administrar_monitoreo> | <guardar_monitoreo>
		*/
		// Elimina los datos del servidor
		PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."replicasbd WHERE id=? ","$id");
		PCO_Auditar("Elimina replicacion para $id");
					echo '
					<form name="continuar_admin_mon" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="administrar_replicacion">
					</form>
					<script type="" language="JavaScript"> 
					document.continuar_admin_mon.submit();  </script>';
	}


/* ################################################################## */
/* ################################################################## */
		/*
			Function: guardar_replicacion
			Almacena un nuevo servidor de replicacion definido por el usuario

			(start code)
				Insetar registro en tabla de replicacionbd
				Llevar auditoria
			(end)

			Salida:
				Entradas en la tabla de replicacion actualizadas

			Ver tambien:
			<administrar_replicacion>
		*/
	if ($PCO_Accion=="guardar_replicacion")
		{
			$mensaje_error="";
			// Verifica campos nulos
			if ($nombre=="")
				$mensaje_error.=$MULTILANG_MonErr."<br>";

			if ($mensaje_error=="")
				{
					// Guarda los datos 
					PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."replicasbd (".$ListaCamposSinID_replicasbd.") VALUES (?,?,?,?,?,?,?,?)","$nombre$_SeparadorCampos_$servidorbd$_SeparadorCampos_$basedatos$_SeparadorCampos_$usuariobd$_SeparadorCampos_$passwordbd$_SeparadorCampos_$motorbd$_SeparadorCampos_$puertobd$_SeparadorCampos_$tipo_replica");
					PCO_Auditar("Agrega servidor de replica: $nombre");
					echo '
					<form name="continuar_admin_mon" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="administrar_replicacion">
					</form>
					<script type="" language="JavaScript"> 
					alert("'.$MULTILANG_Aplicando.'");
					document.continuar_admin_mon.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="administrar_replicacion">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
		/*
			Function: actualizar_replicacion
			Actualiza los datos de un servidor de replica definido por el usuario

			Salida:
				Entradas en la tabla de replicasbd actualizadas

			Ver tambien:
			<administrar_replicacion>
		*/
	if ($PCO_Accion=="actualizar_replicacion")
		{
			$mensaje_error="";
			// Verifica campos nulos
			if ($nombre=="")
				$mensaje_error.=$MULTILANG_MonErr."<br>";

			if ($mensaje_error=="")
				{
					// Actualiza los datos
					PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."replicasbd SET tipo_replica='$tipo_replica',nombre='$nombre',servidorbd='$servidorbd',basedatos='$basedatos',usuariobd='$usuariobd',passwordbd='$passwordbd',motorbd='$motorbd',puertobd='$puertobd' WHERE id='$IDRegistroReplica'");
					PCO_Auditar("Actualiza replica: $IDRegistroReplica");
					echo '
					<form name="continuar_admin_mon" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="administrar_replicacion">
					</form>
					<script type="" language="JavaScript"> 
					alert("'.$MULTILANG_Aplicando.'");
					document.continuar_admin_mon.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="administrar_monitoreo">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
		/*
			Function: formato_monitor
			Presenta el formato utilizado para agregar servidores de replica
		*/
	function FormatoReplicacion($IDRegistroReplica)
		{
			global $ArchivoCORE,$ListaCamposSinID_replicasbd,$TablasCore,$MULTILANG_MonNuevo,$MULTILANG_Tipo,$MULTILANG_Etiqueta,$MULTILANG_Maquina,$MULTILANG_MonCommShell,$MULTILANG_MonCommSQL,$MULTILANG_Imagen,$MULTILANG_Embebido;
			global $MULTILANG_Actualizar,$MULTILANG_Regresar,$MULTILANG_MnuURL,$MULTILANG_InfAlto,$MULTILANG_Ayuda,$MULTILANG_MonDesTipo,$MULTILANG_Pagina,$MULTILANG_Peso,$MULTILANG_Nombre,$MULTILANG_MonSaltos,$MULTILANG_MonMsLectura,$MULTILANG_Agregar,$MULTILANG_IrEscritorio,$MULTILANG_Maquina,$MULTILANG_AplicaPara,$MULTILANG_Tipo,$MULTILANG_Puerto,$MULTILANG_MonMetodo,$MULTILANG_MonCommSQL,$MULTILANG_MonCommShell,$MULTILANG_FrmAncho,$MULTILANG_Imagen,$MULTILANG_Embebido,$MULTILANG_MonTamano,$MULTILANG_Etiqueta,$MULTILANG_MonOcultaTit,$MULTILANG_No,$MULTILANG_Si,$MULTILANG_MonCorreoAlerta,$MULTILANG_MonAlertaSnd,$MULTILANG_MonAlertaVibrar;
			
			global $MULTILANG_AyudaReplica,$MULTILANG_ReplicaTodo,$MULTILANG_Puerto,$MULTILANG_Contrasena,$MULTILANG_Usuario,$MULTILANG_AyudaTitBD,$MULTILANG_AyudaDesBD,$MULTILANG_AgregarReplica,$MULTILANG_TipoMotor,$MULTILANG_AyudaTitMotor,$MULTILANG_AyudaDesMotor,$MULTILANG_Servidor,$MULTILANG_Basedatos;
			
			
			//Busca los datos del servidor de replica
			if ($IDRegistroReplica!="")
				$Maquina=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_replicasbd." FROM ".$TablasCore."replicasbd WHERE id='$IDRegistroReplica' ")->fetch();

			//Define la accion a ejecutar
			if ($IDRegistroReplica=="")
				{
					$AccionFormulario="guardar_replicacion";
					$TextoBotonFormulario=$MULTILANG_Agregar;
					$TextoBotonCancelar=$MULTILANG_IrEscritorio;
				}
			else
				{
					$AccionFormulario="actualizar_replicacion";
					$TextoBotonFormulario=$MULTILANG_Actualizar;
					$TextoBotonCancelar=$MULTILANG_Regresar;
				}

			echo '
        <form name="datos" action="'.$ArchivoCORE.'" method="POST">


            <input type="hidden" name="PCO_Accion" value="'.$AccionFormulario.'">
            <input type="hidden" name="IDRegistroReplica" value="'.$IDRegistroReplica.'">
            
            <div class="row">
                <div class="col-md-6">
                    <h4><b><i class="fa fa-code-fork fa-fw icon-orange"></i>'.$MULTILANG_AgregarReplica.':</b></h4>

                    <label for="nombre">'.$MULTILANG_Nombre.':</label>
                    <div class="form-group input-group">
                        <input type="text" name="nombre" value="'.@$Maquina["nombre"].'"class="form-control" placeholder="A-Z 0-9" onkeypress="return validar_teclado(event, \'alfanumerico\');" >
                    </div>

                    <label for="tipo">'.$MULTILANG_TipoMotor.':</label>
                    <div class="form-group input-group">
                        <select id="motorbd" name="motorbd" class="form-control" >';
					//Define los estados de seleccion para las listas
					if (@$Maquina["motorbd"]=="mysql") 		$Seleccion_mysql="SELECTED";
					if (@$Maquina["motorbd"]=="pgsql") 		$Seleccion_pgsql="SELECTED";
					if (@$Maquina["motorbd"]=="sqlite") 	$Seleccion_sqlite="SELECTED";
					if (@$Maquina["motorbd"]=="sqlsrv")		$Seleccion_sqlsrv="SELECTED";
					if (@$Maquina["motorbd"]=="mssql") 		$Seleccion_mssql="SELECTED";
					if (@$Maquina["motorbd"]=="ibm") 		$Seleccion_ibm="SELECTED";
					if (@$Maquina["motorbd"]=="dblib") 		$Seleccion_dblib="SELECTED";
					if (@$Maquina["motorbd"]=="odbc") 		$Seleccion_odbc="SELECTED";
					if (@$Maquina["motorbd"]=="oracle") 	$Seleccion_oracle="SELECTED";
					if (@$Maquina["motorbd"]=="ifmx")		$Seleccion_ifmx="SELECTED";
					if (@$Maquina["motorbd"]=="fbd") 		$Seleccion_fbd="SELECTED";
					echo '
                            <option value="mysql"	'.$Seleccion_mysql.'>MySQL - MariaDB (3.x/4.x/5.x)</option>
                            <option value="pgsql"	'.$Seleccion_pgsql.'>PostgreSQL</option>
                            <option value="sqlite"	'.$Seleccion_sqlite.'>SQLite v2 - SQLite v3</option>
                            <option value="sqlsrv"	'.$Seleccion_sqlsrv.'>FreeTDS/Microsoft SQL Server: Win32 [max version 2008]</option>
                            <option value="mssql"	'.$Seleccion_mssql.'>FreeTDS/Microsoft SQL Server: Win32&Linux, [max version 2000]</option>
                            <option value="ibm"		'.$Seleccion_ibm.'>IBM (DB2)</option>
                            <option value="dblib"	'.$Seleccion_dblib.'>DBLIB</option>
                            <option value="odbc"	'.$Seleccion_odbc.'>Microsoft Access (ODBC v3: IBM DB2, unixODBC, Win32 ODBC)</option>
                            <option value="oracle"	'.$Seleccion_oracle.'>ORACLE (OCI Oracle Call Interface)</option>
                            <option value="ifmx"	'.$Seleccion_ifmx.'>Informix (IBM Informix Dynamic Server)</option>
                            <option value="fbd"		'.$Seleccion_fbd.'>Firebird (Firebird/Interbase 6)</option>
                        </select>
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="<b>'.$MULTILANG_AyudaTitMotor.'</b><br>'.$MULTILANG_AyudaDesMotor.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                    </div>

                    <label for="tipo_replica">'.$MULTILANG_ReplicaTodo.':</label>
                    <div class="form-group input-group">
                        <select id="tipo_replica" name="tipo_replica" class="form-control" >';
					//Define los estados de seleccion para las listas
					if (@$Maquina["tipo_replica"]=="0") 		$Seleccion_NoAV="SELECTED";
					if (@$Maquina["tipo_replica"]=="1") 		$Seleccion_SiAV="SELECTED";
			echo '
                            <option value="0" '.$Seleccion_NoAV.'>'.$MULTILANG_No.'</option>
                            <option value="1" '.$Seleccion_SiAV.'>'.$MULTILANG_Si.'</option>
                        </select>
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_AyudaReplica.'"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                    </div>


					<br>

                    <a class="btn btn-success btn-block" href="javascript:document.datos.submit();"><i class="fa fa-save"></i> '.$TextoBotonFormulario.'</a>
                    <a class="btn btn-default btn-block" href="javascript:document.core_ver_menu.submit();"><i class="fa fa-home"></i> '.$TextoBotonCancelar.'</a>

                </div>
                <div class="col-md-6">

                    <label for="nombre">'.$MULTILANG_Servidor.':</label>
                    <div class="form-group input-group">
                        <input type="text" name="servidorbd" value="'.@$Maquina["servidorbd"].'"class="form-control">
                        <span class="input-group-addon">
                            <i class="fa fa-laptop fa-fw "></i>
                        </span>
                    </div>
                    
                    <label for="nombre">'.$MULTILANG_Basedatos.':</label>
                    <div class="form-group input-group">
                        <input type="text" name="basedatos" value="'.@$Maquina["basedatos"].'"class="form-control">
                        <span class="input-group-addon">
                            <a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_AyudaTitBD.' '.$MULTILANG_AyudaDesBD.'"><i class="fa fa-database fa-fw text-warning"></i></a>
                        </span>
                    </div>
                    
                    <label for="nombre">'.$MULTILANG_Usuario.':</label>
                    <div class="form-group input-group">
                        <input type="text" name="usuariobd" value="'.@$Maquina["usuariobd"].'"class="form-control">
                        <span class="input-group-addon">
                            <i class="fa fa-user fa-fw"></i>
                        </span>
                    </div>
                    
                    <label for="nombre">'.$MULTILANG_Contrasena.':</label>
                    <div class="form-group input-group">
                        <input type="password" name="passwordbd" value="'.@$Maquina["passwordbd"].'"class="form-control">
                        <span class="input-group-addon">
                            <i class="fa fa-key fa-fw"></i>
                        </span>
                    </div>
                    
                    <label for="nombre">'.$MULTILANG_Puerto.':</label>
                    <div class="form-group input-group">
                        <input type="text" name="puertobd" value="'.@$Maquina["puertobd"].'"class="form-control">
                        <span class="input-group-addon">
                            <i class="fa fa-plug fa-fw"></i>
                        </span>
                    </div>

                </div>
            </div>

        </form>';

		}


/* ################################################################## */
/* ################################################################## */
		/*
			Function: detalles_replicacion
			Presenta formulario para editar un servidor de replicacion

			Ver tambien:
			<guardar_replicacion>
		*/
if ($PCO_Accion=="detalles_replicacion")
	{
		abrir_ventana($MULTILANG_ReplicaTitulo,'panel-primary');
		FormatoReplicacion($IDRegistroReplica);
        cerrar_ventana();
    } //Fin detalles_monitoreo


/* ################################################################## */
/* ################################################################## */
		/*
			Function: administrar_replicacion
			Presenta la lista de todos los servidores definidos para replicacion

			(start code)
				SELECT * FROM ".$TablasCore."replicasbd WHERE 1
			(end)

			Salida:
				Listado de servidores de replicacion configurados

			Ver tambien:
			<guardar_replicacion>
		*/
if ($PCO_Accion=="administrar_replicacion")
	{
		$PCO_Accion=escapar_contenido($PCO_Accion); //Limpia cadena para evitar XSS
		abrir_ventana($MULTILANG_ReplicaTitulo,'panel-primary');
		
		FormatoReplicacion();
		
?>


        <hr>
		
		 <?php

				$resultado_conteo=PCO_EjecutarSQL("SELECT COUNT(id) as conteo FROM ".$TablasCore."replicasbd WHERE tipo_replica=1 ")->fetch();
				if ($resultado_conteo["conteo"]>0)
					{
						echo '<h4><b><i class="fa fa-server" aria-hidden="true"></i> '.$MULTILANG_ReplicaDefinidos.'</b></h4>';
						echo '
						<table class="table table-unbordered table-condensed table-hover btn-xs">
							<thead>
							<tr>
								<th><b>'.$MULTILANG_Nombre.'</b></th>
								<th><b>'.$MULTILANG_Servidor.'</b></th>
								<th><b>'.$MULTILANG_Basedatos.'</b></th>
								<th><b>'.$MULTILANG_TipoMotor.'</b></th>
								<th></th>
								<th></th>
							</tr>
							</thead>
							<tbody>';

						$resultado=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_replicasbd." FROM ".$TablasCore."replicasbd WHERE tipo_replica=1 ");
						while($registro = $resultado->fetch())
							{
								echo '<tr>
										<td>'.$registro["nombre"].'</td>
										<td>'.$registro["servidorbd"].'</td>
										<td>'.$registro["basedatos"].'</td>
										<td>'.$registro["motorbd"].'</td>
										<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" name="f'.$registro["id"].'" id="f'.$registro["id"].'">
														<input type="hidden" name="PCO_Accion" value="eliminar_replica">
														<input type="hidden" name="id" value="'.$registro["id"].'">
														<input type="button" value="'.$MULTILANG_Eliminar.'" class="btn btn-danger btn-xs" onClick="confirmar_evento(\''.$MULTILANG_MnuAdvElimina.'\',f'.$registro["id"].');">
												</form>
										</td>
										<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST">
														<input type="hidden" name="PCO_Accion" value="detalles_replicacion">
														<input type="hidden" name="IDRegistroReplica" value="'.$registro["id"].'">
														<input type="submit" value="'.$MULTILANG_Detalles.'" class="btn btn-info btn-xs">
												</form>
										</td>
									</tr>';
							}
						echo '
						</tbody>
						</table>';
					}

				$resultado_conteo=PCO_EjecutarSQL("SELECT COUNT(id) as conteo FROM ".$TablasCore."replicasbd WHERE tipo_replica=0 ")->fetch();
				if ($resultado_conteo["conteo"]>0)
					{
						echo '<h4><b><i class="fa fa-server" aria-hidden="true"></i> '.$MULTILANG_ConnAdicionales.'</b></h4>';
						echo '
						<table class="table table-unbordered table-condensed table-hover btn-xs">
							<thead>
							<tr>
								<th><b>'.$MULTILANG_Nombre.'</b></th>
								<th><b>'.$MULTILANG_Servidor.'</b></th>
								<th><b>'.$MULTILANG_Basedatos.'</b></th>
								<th><b>'.$MULTILANG_TipoMotor.'</b></th>
								<th></th>
								<th></th>
							</tr>
							</thead>
							<tbody>';

						$resultado=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_replicasbd." FROM ".$TablasCore."replicasbd WHERE tipo_replica=0 ");
						while($registro = $resultado->fetch())
							{
								echo '<tr>
										<td>'.$registro["nombre"].'</td>
										<td>'.$registro["servidorbd"].'</td>
										<td>'.$registro["basedatos"].'</td>
										<td>'.$registro["motorbd"].'</td>
										<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" name="f'.$registro["id"].'" id="f'.$registro["id"].'">
														<input type="hidden" name="PCO_Accion" value="eliminar_replica">
														<input type="hidden" name="id" value="'.$registro["id"].'">
														<input type="button" value="'.$MULTILANG_Eliminar.'" class="btn btn-danger btn-xs" onClick="confirmar_evento(\''.$MULTILANG_MnuAdvElimina.'\',f'.$registro["id"].');">
												</form>
										</td>
										<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST">
														<input type="hidden" name="PCO_Accion" value="detalles_replicacion">
														<input type="hidden" name="IDRegistroReplica" value="'.$registro["id"].'">
														<input type="submit" value="'.$MULTILANG_Detalles.'" class="btn btn-info btn-xs">
												</form>
										</td>
									</tr>';
							}
						echo '
						</tbody>
						</table>';
					}


        cerrar_ventana();
        $VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
    } //Fin administrar_replicacion