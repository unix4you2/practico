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

<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">

<table class="table table-unbordered">
	<tr>
		<td valign=top align=center><font size=2 color=black><b>
            
            <img src="../img/practico_login.png" border=0 ALT="Logo Practico">
			<h1><b>Versi&oacute;n <?php include("../inc/version_actual.txt"); ?></b></h1>

			<font color=gray>
			Welcome &nbsp;&nbsp; Willkommen &nbsp;&nbsp; Ongi Etorri<br>
			<font size=5>Bienvenido<br></font>
			 Bienvenuto &nbsp;&nbsp; Bienvenue &nbsp;&nbsp; bem-vindo &nbsp;&nbsp; स्वागत<br><br>
			</font>

            <hr>
            <label for="Idioma">[ Seleccione el idioma deseado / Select your language ]:</label>
            <div class="form-group input-group">
                <span class="input-group-addon">
                    <i class="fa fa-globe"></i>
                </span>
                    <select id="Idioma" name="Idioma" class="form-control" >
                        <?php
                        // Incluye archivos de idioma para ser seleccionados
                        $path_idiomas="../inc/practico/idiomas/";
                        $directorio_idiomas=opendir($path_idiomas);
                        while (($PCOVAR_Elemento=readdir($directorio_idiomas))!=false)
                            {
                                //Lo procesa solo si es un archivo diferente del index
                                if (!is_dir($path_idiomas.$PCOVAR_Elemento) && $PCOVAR_Elemento!="." && $PCOVAR_Elemento!=".."  && $PCOVAR_Elemento!="index.html")
                                    {
                                        include($path_idiomas.$PCOVAR_Elemento);
                                        //Establece espanol como predeterminado
                                        $seleccion="";
                                        if ($PCOVAR_Elemento=="es.php") $seleccion="SELECTED";
                                        $valor_opcion=str_replace(".php","",$PCOVAR_Elemento);
                                        //Presenta la opcion
                                        echo '<option value="'.$valor_opcion.'" '.$seleccion.'>'.$MULTILANG_DescripcionIdioma.' ('.$PCOVAR_Elemento.')</option>';
                                        if (file_exists("mod/".$PCOVAR_Elemento."/index.php"))
                                            include("mod/".$PCOVAR_Elemento."/index.php");
                                    }
                            }		
                        ?>
                    </select>
            </div>
		</font></td>
	</tr>
</table>


<?php
	PCO_AbrirBarraEstado();
	$anterior=$paso-1;
	$siguiente=$paso+1;
	echo '
            <button onclick="document.continuar.submit();" type="button" class="btn btn-primary navbar-btn">Continuar / Next <i class="fa fa-caret-square-o-right texto-amarillo"></i></button>
			<input type="Hidden" name="paso" value="'.$siguiente.'">
		</form>';
	PCO_CerrarBarraEstado();
?>