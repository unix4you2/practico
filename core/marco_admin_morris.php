<?php
/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2020
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
    Redistribution and use in source and binary forms, with or without
    modification, are permitted provided that the following conditions are met:
    
    1. Redistributions of source code must retain the above copyright notice, this
       list of conditions and the following disclaimer.
    
    2. Redistributions in binary form must reproduce the above copyright notice,
       this list of conditions and the following disclaimer in the documentation
       and/or other materials provided with the distribution.
    
    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
    AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
    IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
    DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
    FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
    DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
    SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
    CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
    OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
    OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
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