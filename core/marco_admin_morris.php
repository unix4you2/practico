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
		Title: Seccion Escritorio Administrativo
		Ubicacion *[/core/marco_admin_morris.php]*.  Genera datos para el panel administrativo y graficas con Morris

	Ver tambien:
		<Seccion superior> | <Articulador>
	*/

	//Valida que quien llame este marco tenga permisos suficientes
	if (@$Login_usuario!="admin" || !$Sesion_abierta)
		die();

?>

<script language="JavaScript">

$(function() {

    Morris.Area({
        
        //Nombre del marco que tiene el grafico
        element: 'uso-general-aplicativo',
        data: [
        <?php
            //Inicia la generacion del arreglo con los datos
            $resultado_auditoria=ejecutar_sql("SELECT fecha,count(*) as cantidad FROM ".$TablasCore."auditoria WHERE fecha>=date_sub(date(now()),INTERVAL 30 DAY) GROUP BY fecha ORDER BY fecha");
            $cadena_datos="";
            while ($registro_auditoria = $resultado_auditoria->fetch())
                {
                    $cadena_datos.= "
                        {
                            fecha: '".$registro_auditoria["fecha"]."',
                            operaciones: ".$registro_auditoria["cantidad"]."
                        },
                        ";
                }
            $cadena_datos = substr($cadena_datos, 0, -1);
            echo $cadena_datos;
        ?>
        ],
        xkey: 'fecha',
        ykeys: ['operaciones'],
        labels: ['operaciones'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
        element: 'conteos-generales-aplicacion',
        data: [
        <?php
            //Inicia la generacion del arreglo con los datos
            //$resultado_auditoria=ejecutar_sql("SELECT fecha,count(*) as cantidad FROM ".$TablasCore."auditoria WHERE fecha>=date_sub(date(now()),INTERVAL 30 DAY) GROUP BY fecha ORDER BY fecha");
            $resultado_conteos_tablas=consultar_tablas($TablasApp);
            $cadena_datos="";
            while ($registro_conteos_tablas = $resultado_conteos_tablas->fetch())
                {
                    $nombre_tabla=@$registro_conteos_tablas[0];
                    //Si la tabla es de aplicacion hace los conteos
                    if (@strpos($nombre_tabla,$TablasApp)!==FALSE)
                        {
                            $total_registros_tabla=0;
                            $registro_conteos_tablas=ejecutar_sql("SELECT count(*) FROM ".$nombre_tabla."")->fetch();
                            $registro_conteos_tablas[0];
                            $cadena_datos.= "
                                {
                                    label: '".$nombre_tabla."',
                                    value: ".$registro_conteos_tablas[0]."
                                },
                                ";
                        }
                }
            $cadena_datos = substr($cadena_datos, 0, -1);
            echo $cadena_datos;
        ?>
        ],
        resize: true
    });

});


</script>
