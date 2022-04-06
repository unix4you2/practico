<?php
	/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2012-2022
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
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
	 
	            --- TRADUCCION NO OFICIAL DE LA LICENCIA ---

     Esta es una traducción no oficial de la Licencia Pública General de
     GNU al español. No ha sido publicada por la Free Software Foundation
     y no establece los términos jurídicos de distribución del software 
     publicado bajo la GPL 3 de GNU, solo la GPL de GNU original en inglés
     lo hace. De todos modos, esperamos que esta traducción ayude a los
     hispanohablantes a comprender mejor la GPL de GNU:
	 
     Este programa es software libre: puede redistribuirlo y/o modificarlo
     bajo los términos de la Licencia General Pública de GNU publicada por
     la Free Software Foundation, ya sea la versión 3 de la Licencia, o 
     (a su elección) cualquier versión posterior.

     Este programa se distribuye con la esperanza de que sea útil pero SIN
     NINGUNA GARANTÍA; incluso sin la garantía implícita de MERCANTIBILIDAD
     o CALIFICADA PARA UN PROPÓSITO EN PARTICULAR. Vea la Licencia General
     Pública de GNU para más detalles.

     Usted ha debido de recibir una copia de la Licencia General Pública de
     GNU junto con este programa. Si no, vea <http://www.gnu.org/licenses/>


		UN EJEMPLO SENCILLO DE COMO PASAR DE ALGO COMO ESTE SCRIPT PARA
		CONSULTAR USUARIOS A LO MISMO EN MVC Y FUNCIONES DE PRACTICO
		
			<?php
				$conexion = mysql_connect('servidor','usuario','clave');
				mysql_select_db('basedatos', $conexion);
				$registros=mysql_query('SELECT * FROM core_usuario', $conexion);
			?>
			<h1>Listado de Usuarios</h1>
			<table>
				<tr>
					<td>Fecha</td>
					<td>Titulo</td>
				</tr>
				<?php
					while($fila= mysql_fetch_array($registros, MYSQL_ASSOC))
						{
							echo "<tr>";
							echo "<td> ".$fila['fecha']." </td>";
							echo "<td> ".$fila['titulo']." </td>";
							echo "</tr>";
						}
				?>
			</table>
			<?php
				mysql_close($conexion);
			?>
		El ejemplo anterior se encuentra totalmente mezclado, no MVC.

		Ver archivo LEAME como en todos los modulos para conocer como activar
		este modulo y revisar su funcionamiento
	*/
?>

<?php
	// Valida sesion activa de Practico
	@session_start();
	if (!isset($PCOSESS_SesionAbierta)) 
		{
			echo '<head><title>Error</title><style type="text/css"> body { background-color: #000000; color: #7f7f7f; font-family: sans-serif,helvetica; } </style></head><body><table width="100%" height="100%" border=0><tr><td align=center>&#9827; Acceso no autorizado !</td></tr></table></body>';
			die();
		}

	// Configuraciones basicas de su modulo (si aplican)
	$raiz_modulo = "mod/mvc/";
	$ruta_modelos = $raiz_modulo."modelo/";
	$ruta_vistas = $raiz_modulo."vista/";
	$ruta_controladores = $raiz_modulo."controlador/";
	$ruta_idiomas = $raiz_modulo."idiomas/";

/* ################################################################## */
/* ################################################################## */
/*
	Function: probar_ejemplo_mvc
	Ejecuta el ejemplo de MVC para una consulta sencilla de auditoria en Practico.  Es solo un ejemplo
	pues en realidad como modelo aplicaria para cualquier operacion y sobre cualquier tabla.

	Salida:
		Listado de acciones de auditoria utilizando MVC y algunos estilos y funciones de Practico
*/
if ($PCO_Accion=="probar_ejemplo_mvc") 
	{
		//Llamar al controlador inicial de la aplicacion o modulo
		require($ruta_controladores.'controlador.php');
	}