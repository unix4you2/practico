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
?>

<?php
	// Valida sesion activa de Practico
	@session_start();
	if (!isset($PCOSESS_SesionAbierta)) 
		{
			echo '<head><title>Error</title><style type="text/css"> body { background-color: #000000; color: #7f7f7f; font-family: sans-serif,helvetica; } </style></head><body><table width="100%" height="100%" border=0><tr><td align=center>&#9827; Acceso no autorizado !</td></tr></table></body>';
			die();
		}
?>

<?php
/* ################################################################## */
/* ################################################################## */
/*
	Function: fileman_admin_embebido
	Presenta IFrame con la herramienta de administracion de archivos embebida
	
	IMPORTANTE:  Este archivo se mantiene por compatibilidad hacia atras con el gestor ElFinder.  Este enlce sera eliminado enversiones 23.x y superiores.  Se recomienda actualizar sus enlaces directos para que usen la nueva version de explorador.
	IMPORTANTE:  Este archivo se mantiene por compatibilidad hacia atras con el gestor ElFinder.  Este enlce sera eliminado enversiones 23.x y superiores.  Se recomienda actualizar sus enlaces directos para que usen la nueva version de explorador.
	IMPORTANTE:  Este archivo se mantiene por compatibilidad hacia atras con el gestor ElFinder.  Este enlce sera eliminado enversiones 23.x y superiores.  Se recomienda actualizar sus enlaces directos para que usen la nueva version de explorador.
	IMPORTANTE:  Este archivo se mantiene por compatibilidad hacia atras con el gestor ElFinder.  Este enlce sera eliminado enversiones 23.x y superiores.  Se recomienda actualizar sus enlaces directos para que usen la nueva version de explorador.
	IMPORTANTE:  Este archivo se mantiene por compatibilidad hacia atras con el gestor ElFinder.  Este enlce sera eliminado enversiones 23.x y superiores.  Se recomienda actualizar sus enlaces directos para que usen la nueva version de explorador.
	IMPORTANTE:  Este archivo se mantiene por compatibilidad hacia atras con el gestor ElFinder.  Este enlce sera eliminado enversiones 23.x y superiores.  Se recomienda actualizar sus enlaces directos para que usen la nueva version de explorador.
	IMPORTANTE:  Este archivo se mantiene por compatibilidad hacia atras con el gestor ElFinder.  Este enlce sera eliminado enversiones 23.x y superiores.  Se recomienda actualizar sus enlaces directos para que usen la nueva version de explorador.
	IMPORTANTE:  Este archivo se mantiene por compatibilidad hacia atras con el gestor ElFinder.  Este enlce sera eliminado enversiones 23.x y superiores.  Se recomienda actualizar sus enlaces directos para que usen la nueva version de explorador.
	IMPORTANTE:  Este archivo se mantiene por compatibilidad hacia atras con el gestor ElFinder.  Este enlce sera eliminado enversiones 23.x y superiores.  Se recomienda actualizar sus enlaces directos para que usen la nueva version de explorador.
	IMPORTANTE:  Este archivo se mantiene por compatibilidad hacia atras con el gestor ElFinder.  Este enlce sera eliminado enversiones 23.x y superiores.  Se recomienda actualizar sus enlaces directos para que usen la nueva version de explorador.
	IMPORTANTE:  Este archivo se mantiene por compatibilidad hacia atras con el gestor ElFinder.  Este enlce sera eliminado enversiones 23.x y superiores.  Se recomienda actualizar sus enlaces directos para que usen la nueva version de explorador.
	IMPORTANTE:  Este archivo se mantiene por compatibilidad hacia atras con el gestor ElFinder.  Este enlce sera eliminado enversiones 23.x y superiores.  Se recomienda actualizar sus enlaces directos para que usen la nueva version de explorador.
	IMPORTANTE:  Este archivo se mantiene por compatibilidad hacia atras con el gestor ElFinder.  Este enlce sera eliminado enversiones 23.x y superiores.  Se recomienda actualizar sus enlaces directos para que usen la nueva version de explorador.
	IMPORTANTE:  Este archivo se mantiene por compatibilidad hacia atras con el gestor ElFinder.  Este enlce sera eliminado enversiones 23.x y superiores.  Se recomienda actualizar sus enlaces directos para que usen la nueva version de explorador.

	Salida:
		IFrame con contenido generado por la herramienta
*/
if ($PCO_Accion=="fileman_admin_embebido") 
	{
		echo '
            <div class="embed-responsive embed-responsive-4by3">
                <iframe src="index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=frm:-34:0&Presentar_FullScreen=1&Precarga_EstilosBS=1&PFE_PresentarCarpetasEspeciales=1&PFE_OcultarMigasPan=1" frameborder="0" marginheight="0" marginwidth="0">Cargando...</iframe>
            </div>';
	}

?>