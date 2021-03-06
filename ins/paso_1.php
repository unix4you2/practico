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

<div align=center>
	

<table  class="table table-unbordered">
	<tr>
		<td width=100 valign=top><img src="../img/practico_login.png" border=0 ALT="Logo Practico" width="116" height="80"></td>
		<td valign=top>
			<b>[<?php echo $MULTILANG_ChequeoPreprocesador; ?>]</b><br>
			<?php echo $MULTILANG_VistaPreprocesador; ?></b>.
				<table class="table table-unbordered"><tr><td valign=top>
					<div align=left>
						<u><?php echo $MULTILANG_CumplirRequisitos; ?>:</u>
						<li><?php echo $MULTILANG_CumplirPDO; ?>
						<li><?php echo $MULTILANG_CumplirDrivers; ?>
						<li><?php echo $MULTILANG_CumplirGD; ?>
					</div>
				</td></tr></table>

			
			<hr><b>[<?php echo $MULTILANG_ChequeoDirectorios1; ?>]</b><br>
				<?php echo $MULTILANG_ChequeoDirectorios2; ?>:<br><br>

                <?php
                    $hay_error=0;
                    //informar_prueba_escritura("..");
                    @informar_prueba_escritura("../bkp",1);
                    @informar_prueba_escritura("../core",1);
                    //informar_prueba_escritura("../core/configuracion.php",2);
                    @informar_prueba_escritura("../tmp",1);
                    @informar_prueba_escritura("../ins",1);
                    @informar_prueba_escritura("../xml",1);
                ?>

		</td>
	</tr>
</table>

<?php
	if ($hay_error)
        PCO_Mensaje('<i class="fa fa-warning fa-2x text-danger texto-blink"></i> ', $MULTILANG_ErrorEscritura, '', '', 'alert alert-danger alert-dismissible');
?>
</div>

<?php
	PCO_AbrirBarraEstado();

	$anterior=$paso-1;
	$siguiente=$paso+1;
	echo '<form name="regresar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			<input type="Hidden" name="paso" value="'.$anterior.'">
			<input type="Hidden" name="Idioma" value="'.$Idioma.'">
            <button onclick="document.regresar.submit();" type="button" class="btn btn-primary navbar-btn"><i class="fa fa-caret-square-o-left texto-amarillo"></i> '.$MULTILANG_Anterior.'</button>
		  </form>';

	echo '<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">';	
	if ($hay_error)
		{
			echo '<input type="Hidden" name="paso" value="'.$paso.'">
				  <input type="Hidden" name="Idioma" value="'.$Idioma.'">
			';
			echo '<button onclick="document.continuar.submit();" type="button" class="btn btn-primary navbar-btn">'.$MULTILANG_ProbarNuevamente.' <i class="fa fa-refresh texto-amarillo"></i></button>';
		}
	else
		{
			echo '<input type="Hidden" name="paso" value="'.$siguiente.'">
				  <input type="Hidden" name="Idioma" value="'.$Idioma.'">
			';
			echo '<button onclick="document.continuar.submit();" type="button" class="btn btn-primary navbar-btn">'.$MULTILANG_Continuar.' <i class="fa fa-caret-square-o-right texto-amarillo"></i></button>';
		}
	echo '</form>';

	PCO_CerrarBarraEstado();
?>