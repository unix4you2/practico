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
		Title: Conexiones PDO
		Ubicacion *[/core/conexiones_extra.php]*.  Define las conexiones para operaciones individuales o replicacion

		Section: Definicion de conexion PDO
		Establece una conexion segun lo definido por el usuario mediante objetos de datos PHP.

		Variables de entrada:

			Registro de definicion de xonexiones extra

		Proceso simplificado para MySQL (ver detalles sobre el codigo para otros motores):
			(start code)
				Revision de conexiones definidas
				Establecimiento de variable de conexion
			(end)

		Salida:
			Variable lista para ser utilizada

		Ver tambien:
		<Definicion de conexion PDO> | <Configuracion base> | <PCO_InformacionConexionBD>
	*/


/* ################################################################## */
/* ################################################################## */

	//Busca conexiones adicionales definidas y genera la variable correspondiente
	$PCO_ConexionesExtra=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_replicasbd." FROM ".$TablasCore."replicasbd WHERE 1=1 ");
	while($registro = $PCO_ConexionesExtra->fetch())
		{
		    //Obtiene los datos de configuracion para la conexion sin importar su tipo
			$ConexExtra_id=$registro["id"];
			$ConexExtra_nombre=$registro["nombre"];
			$ConexExtra_servidorbd=$registro["servidorbd"];
			$ConexExtra_basedatos=$registro["basedatos"];
			$ConexExtra_usuariobd=$registro["usuariobd"];
			$ConexExtra_passwordbd=$registro["passwordbd"];
			$ConexExtra_motorbd=$registro["motorbd"];
			$ConexExtra_puertobd=$registro["puertobd"];
			$ConexExtra_tipo_replica=$registro["tipo_replica"];
			
		    //Determina si la conexion es para motores estandar o NoSQL y genera la variable de conexion
		    if ($ConexExtra_motorbd!="couchbase")
        		${$ConexExtra_nombre}=PCO_NuevaConexionBD($ConexExtra_motorbd,$ConexExtra_puertobd,$ConexExtra_basedatos,$ConexExtra_servidorbd,$ConexExtra_usuariobd,$ConexExtra_passwordbd);
		    else
                ${$ConexExtra_nombre}=PCO_ConexionNoSQL($ConexExtra_motorbd,$ConexExtra_servidorbd,$ConexExtra_puertobd,$ConexExtra_basedatos,$ConexExtra_usuariobd,$ConexExtra_passwordbd);
		}
		
		