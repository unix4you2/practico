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
	Function: PCO_ReportarBugs
	Permite reportar errores o mejoras de la aplicacion por parte de los usuarios
*/
if ($PCO_Accion=="PCO_ReportarBugs")
	{
        //PCO_AbrirDialogoModal("myModalOAUTH",$MULTILANG_ConfiguracionGeneral.": ".$MULTILANG_OauthButt,"modal-wide"); 
        //Carga el formulario con el diseno para gestionar proveedores OAuth.  Deberia deshabilitarse su cargue en modo de diseno del mismo para permitir cambios.
        PCO_CargarFormulario("-3",1);
        //PCO_CerrarDialogoModal();
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: limpiar_backups
	Limpia los archivos de backups contenidos en la carpeta /bkp y que normalmente son realizados despues de cada proceso de parcheo o actualizacion
*/
if ($PCO_Accion=="limpiar_backups")
	{

		//Presenta el listado de archivos
		echo PCO_ListadoExploracionArchivosVisual("bkp/","",$MULTILANG_ArchivosLimpiados,0);
		
		//Elimina los archivos presentados, menos el index
		$ListadoArchivosEliminar=PCO_ListadoExploracionArchivos("bkp/","");
		$TotalAhorro=0;
		foreach ($ListadoArchivosEliminar as $Archivo)
			{
				if ($Archivo["Nombre"]!="index.html")
					{
						@unlink($Archivo["Enlace"]);
						$TotalAhorro+=$Archivo["Tamano"];
					}
			}

		PCO_AbrirBarraEstado();
		echo '<div align=center><h3>'.$MULTILANG_EspacioLiberado.': <b>'.$TotalAhorro.' Kb</b></h3></div>
		<a class="btn btn-warning btn-block" href="javascript:window.close();"><i class="fa fa-times"></i> '.$MULTILANG_Cerrar.'</a>';
		PCO_CerrarBarraEstado();
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
		echo PCO_ListadoExploracionArchivosVisual("tmp/","",$MULTILANG_ArchivosLimpiados,0);
		
		//Elimina los archivos presentados, menos el index
		$ListadoArchivosEliminar=PCO_ListadoExploracionArchivos("tmp/","");
		$TotalAhorro=0;
		foreach ($ListadoArchivosEliminar as $Archivo)
			{
				if ($Archivo["Nombre"]!="index.html")
					{
						@unlink($Archivo["Enlace"]);
						$TotalAhorro+=$Archivo["Tamano"];
					}
			}

		PCO_AbrirBarraEstado();
		echo '<div align=center><h3>'.$MULTILANG_EspacioLiberado.': <b>'.$TotalAhorro.' Kb</b></h3></div>
		<a class="btn btn-warning btn-block" href="javascript:window.close();"><i class="fa fa-times"></i> '.$MULTILANG_Cerrar.'</a>';
		PCO_CerrarBarraEstado();
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: mantenimiento_tablas
	
	Ejecuta operaciones de mantenimiento a las tablas del motor.  Aplica solo MySQL y MariaDB
	
	Variables de entrada:

		PCO_PrefijoTablas - Prefijo utilizado para identificar las tablas a realizar el mantenimiento.  Hacer llegar un nombre completo de tabla equivale a realizar el mantenimiento a una tabla especifica a menos que esta coincida con otra tabla de nombre mas largo.
		PCO_TipoOperacion - Tipo de operacion a realizar:  ANALYZE|OPTIMIZE|REPAIR|TRUNCATE|DELETE
*/
if ($PCO_Accion=="mantenimiento_tablas")
	{
		
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

		//Si la operacion es de mantenimientos
		if ($PCO_TipoOperacion=="ANALYZE" || $PCO_TipoOperacion=="OPTIMIZE" || $PCO_TipoOperacion=="REPAIR")
			{
				//Busca las tablas son el prefijo especificado
				$resultado_conteos_tablas=PCO_ConsultarTablas($PCO_PrefijoTablas);
				//Recorre las tablas y presenta resultados de la operacion con cada una
				while ($registro_conteos_tablas = $resultado_conteos_tablas->fetch())
					{
						$nombre_tabla=@$registro_conteos_tablas[0];
						//Si la tabla es de aplicacion hace la operacion
						if (@strpos($nombre_tabla,$PCO_PrefijoTablas)!==FALSE)
							{
								$registro_conteos_tablas=PCO_EjecutarSQL("$PCO_TipoOperacion TABLE $nombre_tabla")->fetch();
								echo '
									<tr>
										<td>'.$registro_conteos_tablas[0].'</td>
										<td>'.$registro_conteos_tablas[1].'</td>
										<td>'.$registro_conteos_tablas[2].'</td>
										<td>'.$registro_conteos_tablas[3].'</td>
									</tr>';
							}
					}
			}

		if ($PCO_TipoOperacion=="TRUNCATE")
			$resultado_consulta=PCO_EjecutarSQL("TRUNCATE TABLE $PCO_PrefijoTablas");

		if ($PCO_TipoOperacion=="DELETE")
			$resultado_consulta=PCO_EjecutarSQL("DELETE FROM $PCO_PrefijoTablas");

		echo '
			<tr>
				<td colspan=4><h4><b>'.$PCO_TipoOperacion.'</b> '.$PCO_PrefijoTablas.': <b>'.$MULTILANG_Finalizado.' <i class="fa fa-thumbs-o-up fa-fw"></i></b></h4></td>
			</tr>';
				
        //Finaliza tabla de resultados
		echo '</tbody>
			</table>';
		PCO_AbrirBarraEstado();
		echo '<a class="btn btn-warning btn-block" href="javascript:window.close();"><i class="fa fa-times"></i> '.$MULTILANG_Cerrar.'</a>';
		PCO_CerrarBarraEstado();
	}