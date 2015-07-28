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
	Function: limpiar_temporales
	Limpia los archivos temporales contenidos en la instalción de Practico
*/
if ($PCO_Accion=="limpiar_temporales")
	{

		//Presenta el listado de archivos
		echo listado_visual_exploracion_archivos("tmp/","",$MULTILANG_ArchivosLimpiados,0);
		
		//Elimina los archivos presentados, menos el index
		$ListadoArchivosEliminar=listado_exploracion_archivos("tmp/","");
		foreach ($ListadoArchivosEliminar as $Archivo)
			{
				if ($Archivo["Nombre"]!="index.html")
					@unlink($Archivo["Enlace"]);
			}

		abrir_barra_estado();
		echo '<a class="btn btn-warning btn-block" href="javascript:window.close();"><i class="fa fa-times"></i> '.$MULTILANG_Cerrar.'</a>';
		cerrar_barra_estado();
	}


