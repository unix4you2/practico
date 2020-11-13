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