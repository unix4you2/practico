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
		Title: Modulo formularios
		Ubicacion *[/core/formularios_post.php]*.  Archivo de ejecucion de funciones asociadas a los post de formularios
	*/


########################################################################
########################################################################
/*
	Function: PCO_EjecutarPostFormulario
	Alias mediante PCO_Accion para el llamado a la funcion interna PCO_EjecutarCodigoPOST

	Ver tambien:
		<PCO_EjecutarCodigoPOST>
*/
	if ($PCO_Accion=="PCO_EjecutarPostFormulario")
		{
		    if ($ByPassDie=="") $ByPassDie=0;
			if ($LlaveDePaso==$Llave && $Formulario!="")
                PCO_EjecutarCodigoPOST($Formulario,$Llave,$ByPassDie);
		}


########################################################################
########################################################################
/*
	Function: PCO_EvaluarCodigoExterno
	Alias mediante PCO_Accion para el llamado a la funcion interna PCO_EvaluarCodigoExterno

	Ver tambien:
		<PCO_EvaluarCodigoExterno>
*/
	if ($PCO_Accion=="PCO_EvaluarCodigoExterno")
		{
		    if ($Silenciar=="") $Silenciar='No';
			if ($LlaveDePaso==$Llave && $Codigo!="")
                PCO_EvaluarCodigoExterno($Codigo,$Silenciar);
		}
		

########################################################################
########################################################################
/*
	Function: PCO_ProbarSoporteLenguaje
	Permite copiar sobre un registro de prueba un script simple de HolaMundo en un lenguaje determinado para revisar su soporte del lado del servidor
*/
	if ($PCO_Accion=="PCO_ProbarSoporteLenguaje")
		{
			if ($LlaveDePaso==$Llave && $Codigo!="")
			    {
			        //Copia sobre el registro -1 del propio del framework los datos para probar el lenguaje
			        $RegistroLenguaje=PCO_EjecutarSQL("SELECT * FROM core_scripts_lenguajes WHERE id={$Codigo}")->fetch();
			        $LenguajePrueba=$RegistroLenguaje["nombre"];
			        $LenguajeCuerpo=$RegistroLenguaje["hola_mundo"];
			        if (trim($LenguajeCuerpo)!="")
			            {
        			        PCO_EjecutarSQLUnaria("UPDATE core_scripts SET cuerpo=?,lenguaje='$LenguajePrueba'  WHERE id='-1'","$LenguajeCuerpo");
                            PCO_EvaluarCodigoExterno('PCO-LMQTP01','No');
			            }
			    }
		}