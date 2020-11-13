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