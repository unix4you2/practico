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
*/

	/*
		Title: Seccion Escritorio Administrativo
		Ubicacion *[/core/marco_admin_morris.php]*.  Genera datos para el panel administrativo y graficas con Morris

	Ver tambien:
		<Seccion superior> | <Articulador>
	*/

	//Valida que quien llame este marco tenga permisos suficientes
	if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario) || !$PCOSESS_SesionAbierta)
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
            $resultado_auditoria=PCO_EjecutarSQL("SELECT fecha,count(*) as cantidad FROM ".$TablasCore."auditoria WHERE fecha>=date_sub(date(now()),INTERVAL 30 DAY) GROUP BY fecha ORDER BY fecha");
            $cadena_datos="";
            while ($registro_auditoria = $resultado_auditoria->fetch())
                {
                    //Cuenta ingresos unicos de usuarios
                    $registro_auditoria_usuarios=PCO_EjecutarSQL("SELECT count(*) as cantidad FROM ".$TablasCore."auditoria WHERE fecha='".$registro_auditoria["fecha"]."' GROUP BY usuario_login")->fetch();
                    $total_usuarios_unicos=$registro_auditoria_usuarios["cantidad"];
                    if ($total_usuarios_unicos=="") $total_usuarios_unicos=0;
                    //Cuenta registros de la API
                    $registro_auditoria_api=PCO_EjecutarSQL("SELECT count(*) as cantidad FROM ".$TablasCore."auditoria WHERE fecha='".$registro_auditoria["fecha"]."' AND usuario_login LIKE 'API.%' GROUP BY usuario_login")->fetch();
                    $total_uso_api=$registro_auditoria_api["cantidad"];
                    if ($total_uso_api=="") $total_uso_api=0;
                    //Agrega datos al arreglo
                    $fecha_grafico=$registro_auditoria["fecha"];
                    $cantidad_grafico=$registro_auditoria["cantidad"];
                    $cadena_datos.= "
                        {
                            fecha: '".$fecha_grafico."',
                            Operaciones: ".$cantidad_grafico.",
                            Usuarios: ".$total_usuarios_unicos.",
                            UsoAPI: ".$total_uso_api."
                        },
                        ";
                }
            $cadena_datos = substr($cadena_datos, 0, -1);
            echo $cadena_datos;
        ?>
        ],
        xkey: 'fecha',
        ykeys: ['Operaciones','Usuarios','UsoAPI'],
        labels: ['Operaciones','Usuarios','UsoAPI'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
        element: 'conteos-generales-aplicacion',
        data: [
        <?php
            //Inicia la generacion del arreglo con los datos
            //$resultado_auditoria=PCO_EjecutarSQL("SELECT fecha,count(*) as cantidad FROM ".$TablasCore."auditoria WHERE fecha>=date_sub(date(now()),INTERVAL 30 DAY) GROUP BY fecha ORDER BY fecha");
            $resultado_conteos_tablas=PCO_ConsultarTablas($TablasApp);
            $cadena_datos="";
            while ($registro_conteos_tablas = $resultado_conteos_tablas->fetch())
                {
                    $nombre_tabla=@$registro_conteos_tablas[0];
                    //Si la tabla es de aplicacion hace los conteos
                    if (@strpos($nombre_tabla,$TablasApp)!==FALSE)
                        {
                            $total_registros_tabla=0;
                            $registro_conteos_tablas=PCO_EjecutarSQL("SELECT count(*) FROM ".$nombre_tabla."")->fetch();
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