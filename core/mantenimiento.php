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
				Title: Modulo mantenimientos
				Ubicacion *[/core/mantenimiento.php]*.  Archivo de funciones para el mantenimiento de la plataforma, verificaciones de tablas, reparacion, etc.
			*/
?>

<?php


/* ################################################################## */
/* ################################################################## */
/*
	Function: limpiar_backups
	Limpia los archivos de backups contenidos en la carpeta /bkp y que normalmente son realizados despues de cada proceso de parcheo o actualizacion
*/
if ($PCO_Accion=="limpiar_backups")
	{

		//Presenta el listado de archivos
		echo listado_visual_exploracion_archivos("bkp/","",$MULTILANG_ArchivosLimpiados,0);
		
		//Elimina los archivos presentados, menos el index
		$ListadoArchivosEliminar=listado_exploracion_archivos("bkp/","");
		$TotalAhorro=0;
		foreach ($ListadoArchivosEliminar as $Archivo)
			{
				if ($Archivo["Nombre"]!="index.html")
					{
						@unlink($Archivo["Enlace"]);
						$TotalAhorro+=$Archivo["Tamano"];
					}
			}

		abrir_barra_estado();
		echo '<div align=center><h3>'.$MULTILANG_EspacioLiberado.': <b>'.$TotalAhorro.' Kb</b></h3></div>
		<a class="btn btn-warning btn-block" href="javascript:window.close();"><i class="fa fa-times"></i> '.$MULTILANG_Cerrar.'</a>';
		cerrar_barra_estado();
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: limpiar_temporales
	Limpia los archivos temporales contenidos en la instalción de Practico
*/
if ($PCO_Accion=="limpiar_temporales")
	{

		//Presenta el listado de archivos
		echo listado_visual_exploracion_archivos("tmp/","",$MULTILANG_ArchivosLimpiados,0);
		
		//Elimina los archivos presentados, menos el index
		$ListadoArchivosEliminar=listado_exploracion_archivos("tmp/","");
		$TotalAhorro=0;
		foreach ($ListadoArchivosEliminar as $Archivo)
			{
				if ($Archivo["Nombre"]!="index.html")
					{
						@unlink($Archivo["Enlace"]);
						$TotalAhorro+=$Archivo["Tamano"];
					}
			}

		abrir_barra_estado();
		echo '<div align=center><h3>'.$MULTILANG_EspacioLiberado.': <b>'.$TotalAhorro.' Kb</b></h3></div>
		<a class="btn btn-warning btn-block" href="javascript:window.close();"><i class="fa fa-times"></i> '.$MULTILANG_Cerrar.'</a>';
		cerrar_barra_estado();
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: analizar_tablas_aplicacion
	Analiza el estado de las tablas de aplicacion.  Aplica solo MySQL y MariaDB
*/
if ($PCO_Accion=="analizar_tablas_aplicacion")
	{
		//Busca las tablas de aplicacion
        $resultado_conteos_tablas=consultar_tablas($TablasApp);
		//Inicia la tabla de resultados
		echo '
			<table class="table table-responsive table-unbordered table-hover table-condensed btn-xs">
				<thead>
					<tr>
						<th>'.$MULTILANG_Tablas.'</th>
						<th>'.$MULTILANG_Accion.'</th>
						<th>'.$MULTILANG_Detalles.'</th>
						<th>'.$MULTILANG_Resultados.'</th>
					</tr>
				</thead>
				<tbody>';
		//Recorre las tablas y presenta resultados de la operacion con cada una
		while ($registro_conteos_tablas = $resultado_conteos_tablas->fetch())
			{
				$nombre_tabla=@$registro_conteos_tablas[0];
				//Si la tabla es de aplicacion hace la operacion
				if (@strpos($nombre_tabla,$TablasApp)!==FALSE)
					{
						$registro_conteos_tablas=ejecutar_sql("ANALYZE TABLE ".$nombre_tabla."")->fetch();
						echo '
							<tr>
								<td>'.$registro_conteos_tablas[0].'</td>
								<td>'.$registro_conteos_tablas[1].'</td>
								<td>'.$registro_conteos_tablas[2].'</td>
								<td>'.$registro_conteos_tablas[3].'</td>
							</tr>';
					}
			}
        //Finaliza tabla de resultados
		echo '</tbody>
			</table>';
		abrir_barra_estado();
		echo '<a class="btn btn-warning btn-block" href="javascript:window.close();"><i class="fa fa-times"></i> '.$MULTILANG_Cerrar.'</a>';
		cerrar_barra_estado();
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: optimizar_tablas_aplicacion
	Optimiza el estado de las tablas de aplicacion.  Aplica solo MySQL y MariaDB
*/
if ($PCO_Accion=="optimizar_tablas_aplicacion")
	{
		//Busca las tablas de aplicacion
        $resultado_conteos_tablas=consultar_tablas($TablasApp);
		//Inicia la tabla de resultados
		echo '
			<table class="table table-responsive table-unbordered table-hover table-condensed btn-xs">
				<thead>
					<tr>
						<th>'.$MULTILANG_Tablas.'</th>
						<th>'.$MULTILANG_Accion.'</th>
						<th>'.$MULTILANG_Detalles.'</th>
						<th>'.$MULTILANG_Resultados.'</th>
					</tr>
				</thead>
				<tbody>';
		//Recorre las tablas y presenta resultados de la operacion con cada una
		while ($registro_conteos_tablas = $resultado_conteos_tablas->fetch())
			{
				$nombre_tabla=@$registro_conteos_tablas[0];
				//Si la tabla es de aplicacion hace la operacion
				if (@strpos($nombre_tabla,$TablasApp)!==FALSE)
					{
						$registro_conteos_tablas=ejecutar_sql("OPTIMIZE TABLE ".$nombre_tabla."")->fetch();
						echo '
							<tr>
								<td>'.$registro_conteos_tablas[0].'</td>
								<td>'.$registro_conteos_tablas[1].'</td>
								<td>'.$registro_conteos_tablas[2].'</td>
								<td>'.$registro_conteos_tablas[3].'</td>
							</tr>';
					}
			}
        //Finaliza tabla de resultados
		echo '</tbody>
			</table>';
		abrir_barra_estado();
		echo '<a class="btn btn-warning btn-block" href="javascript:window.close();"><i class="fa fa-times"></i> '.$MULTILANG_Cerrar.'</a>';
		cerrar_barra_estado();
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: reparar_tablas_aplicacion
	Repara el estado de las tablas de aplicacion.  Aplica solo MySQL y MariaDB
*/
if ($PCO_Accion=="reparar_tablas_aplicacion")
	{
		//Busca las tablas de aplicacion
        $resultado_conteos_tablas=consultar_tablas($TablasApp);
		//Inicia la tabla de resultados
		echo '
			<table class="table table-responsive table-unbordered table-hover table-condensed btn-xs">
				<thead>
					<tr>
						<th>'.$MULTILANG_Tablas.'</th>
						<th>'.$MULTILANG_Accion.'</th>
						<th>'.$MULTILANG_Detalles.'</th>
						<th>'.$MULTILANG_Resultados.'</th>
					</tr>
				</thead>
				<tbody>';
		//Recorre las tablas y presenta resultados de la operacion con cada una
		while ($registro_conteos_tablas = $resultado_conteos_tablas->fetch())
			{
				$nombre_tabla=@$registro_conteos_tablas[0];
				//Si la tabla es de aplicacion hace la operacion
				if (@strpos($nombre_tabla,$TablasApp)!==FALSE)
					{
						$registro_conteos_tablas=ejecutar_sql("REPAIR TABLE ".$nombre_tabla."")->fetch();
						echo '
							<tr>
								<td>'.$registro_conteos_tablas[0].'</td>
								<td>'.$registro_conteos_tablas[1].'</td>
								<td>'.$registro_conteos_tablas[2].'</td>
								<td>'.$registro_conteos_tablas[3].'</td>
							</tr>';
					}
			}
        //Finaliza tabla de resultados
		echo '</tbody>
			</table>';
		abrir_barra_estado();
		echo '<a class="btn btn-warning btn-block" href="javascript:window.close();"><i class="fa fa-times"></i> '.$MULTILANG_Cerrar.'</a>';
		cerrar_barra_estado();
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: analizar_tablas_practico
	Analiza el estado de las tablas de aplicacion.  Aplica solo MySQL y MariaDB
*/
if ($PCO_Accion=="analizar_tablas_practico")
	{
		//Busca las tablas de aplicacion
        $resultado_conteos_tablas=consultar_tablas($TablasCore);
		//Inicia la tabla de resultados
		echo '
			<table class="table table-responsive table-unbordered table-hover table-condensed btn-xs">
				<thead>
					<tr>
						<th>'.$MULTILANG_Tablas.'</th>
						<th>'.$MULTILANG_Accion.'</th>
						<th>'.$MULTILANG_Detalles.'</th>
						<th>'.$MULTILANG_Resultados.'</th>
					</tr>
				</thead>
				<tbody>';
		//Recorre las tablas y presenta resultados de la operacion con cada una
		while ($registro_conteos_tablas = $resultado_conteos_tablas->fetch())
			{
				$nombre_tabla=@$registro_conteos_tablas[0];
				//Si la tabla es de aplicacion hace la operacion
				if (@strpos($nombre_tabla,$TablasCore)!==FALSE)
					{
						$registro_conteos_tablas=ejecutar_sql("ANALYZE TABLE ".$nombre_tabla."")->fetch();
						echo '
							<tr>
								<td>'.$registro_conteos_tablas[0].'</td>
								<td>'.$registro_conteos_tablas[1].'</td>
								<td>'.$registro_conteos_tablas[2].'</td>
								<td>'.$registro_conteos_tablas[3].'</td>
							</tr>';
					}
			}
        //Finaliza tabla de resultados
		echo '</tbody>
			</table>';
		abrir_barra_estado();
		echo '<a class="btn btn-warning btn-block" href="javascript:window.close();"><i class="fa fa-times"></i> '.$MULTILANG_Cerrar.'</a>';
		cerrar_barra_estado();
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: optimizar_tablas_practico
	Optimiza el estado de las tablas de Practico.  Aplica solo MySQL y MariaDB
*/
if ($PCO_Accion=="optimizar_tablas_practico")
	{
		//Busca las tablas de aplicacion
        $resultado_conteos_tablas=consultar_tablas($TablasCore);
		//Inicia la tabla de resultados
		echo '
			<table class="table table-responsive table-unbordered table-hover table-condensed btn-xs">
				<thead>
					<tr>
						<th>'.$MULTILANG_Tablas.'</th>
						<th>'.$MULTILANG_Accion.'</th>
						<th>'.$MULTILANG_Detalles.'</th>
						<th>'.$MULTILANG_Resultados.'</th>
					</tr>
				</thead>
				<tbody>';
		//Recorre las tablas y presenta resultados de la operacion con cada una
		while ($registro_conteos_tablas = $resultado_conteos_tablas->fetch())
			{
				$nombre_tabla=@$registro_conteos_tablas[0];
				//Si la tabla es de aplicacion hace la operacion
				if (@strpos($nombre_tabla,$TablasCore)!==FALSE)
					{
						$registro_conteos_tablas=ejecutar_sql("OPTIMIZE TABLE ".$nombre_tabla."")->fetch();
						echo '
							<tr>
								<td>'.$registro_conteos_tablas[0].'</td>
								<td>'.$registro_conteos_tablas[1].'</td>
								<td>'.$registro_conteos_tablas[2].'</td>
								<td>'.$registro_conteos_tablas[3].'</td>
							</tr>';
					}
			}
        //Finaliza tabla de resultados
		echo '</tbody>
			</table>';
		abrir_barra_estado();
		echo '<a class="btn btn-warning btn-block" href="javascript:window.close();"><i class="fa fa-times"></i> '.$MULTILANG_Cerrar.'</a>';
		cerrar_barra_estado();
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: reparar_tablas_practico
	Repara el estado de las tablas de Practico.  Aplica solo MySQL y MariaDB
*/
if ($PCO_Accion=="reparar_tablas_practico")
	{
		//Busca las tablas de aplicacion
        $resultado_conteos_tablas=consultar_tablas($TablasCore);
		//Inicia la tabla de resultados
		echo '
			<table class="table table-responsive table-unbordered table-hover table-condensed btn-xs">
				<thead>
					<tr>
						<th>'.$MULTILANG_Tablas.'</th>
						<th>'.$MULTILANG_Accion.'</th>
						<th>'.$MULTILANG_Detalles.'</th>
						<th>'.$MULTILANG_Resultados.'</th>
					</tr>
				</thead>
				<tbody>';
		//Recorre las tablas y presenta resultados de la operacion con cada una
		while ($registro_conteos_tablas = $resultado_conteos_tablas->fetch())
			{
				$nombre_tabla=@$registro_conteos_tablas[0];
				//Si la tabla es de aplicacion hace la operacion
				if (@strpos($nombre_tabla,$TablasCore)!==FALSE)
					{
						$registro_conteos_tablas=ejecutar_sql("REPAIR TABLE ".$nombre_tabla."")->fetch();
						echo '
							<tr>
								<td>'.$registro_conteos_tablas[0].'</td>
								<td>'.$registro_conteos_tablas[1].'</td>
								<td>'.$registro_conteos_tablas[2].'</td>
								<td>'.$registro_conteos_tablas[3].'</td>
							</tr>';
					}
			}
        //Finaliza tabla de resultados
		echo '</tbody>
			</table>';
		abrir_barra_estado();
		echo '<a class="btn btn-warning btn-block" href="javascript:window.close();"><i class="fa fa-times"></i> '.$MULTILANG_Cerrar.'</a>';
		cerrar_barra_estado();
	}
