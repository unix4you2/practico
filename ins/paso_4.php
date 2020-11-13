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
<table  class="table table-unbordered btn-xs">
	<tr>
		<td width=100><img src="../img/practico_login.png" border=0 ALT="Logo Practico" width="116" height="80"></td>
		<td valign=top><font size=2 color=black><br><b>
			[<?php echo $MULTILANG_ExeScripts; ?>]</b><br><br>
		</font></td>
	</tr>
</table>
<hr>

<?php
	// Ejecuta los scripts de creacion de la BD si se requiere
	$total_ejecutadas=0;
	
	if ($aplicar_script_basedatos)
		{
			// Si el motor es SQLite se requiere una booleana para que conexiones.php agregue un prefijo en la creacion de archivo
			$tiempo_instalacion_activa=1;

			include_once("../core/configuracion.php");
			include_once("../core/conexiones.php");
			include_once("../core/comunes.php");
			
			//Abre el archivo con los queries dependiendo del motor
			$RutaScriptSQL="sql/practico.".$MotorBD;
			
			$archivo_consultas=fopen($RutaScriptSQL,"r");
			$total_consultas= fread($archivo_consultas,filesize($RutaScriptSQL));
			fclose($archivo_consultas);
 
			$arreglo_consultas = PCO_SegmentarSQL($total_consultas);
			foreach($arreglo_consultas as $consulta)
				{
					try
						{
							//Cambia el prefijo predeterminado en caso que haya sido personalizado en la instalacion
							$consulta=str_replace("core_",$TablasCore,$consulta);
							//Cambia parametros iniciales de aplicacion
							$consulta=str_replace("PAR_NombreCortoEmpresa",$NombreCortoEmpresa,$consulta);
							$consulta=str_replace("PAR_NombreAplicacion",$NombreAplicacion,$consulta);
							$consulta=str_replace("PAR_VersionAplicacion",$VersionAplicacion,$consulta);

							//Ejecuta el query
							$consulta_enviar = $ConexionPDO->prepare($consulta);
							$consulta_enviar->execute();
							$total_ejecutadas++;
						}
					catch( PDOException $ErrorPDO)
						{
							echo "<hr><b><font color=red>".$MULTILANG_Atencion."!!!: </font>".$MULTILANG_ErrorScripts.". SQL: ".$consulta." ".$MULTILANG_Error.": ".$ErrorPDO->getMessage()."</b>";
							$hay_error=1; //usada globalmente durante el proceso de instalacion
						}
				}

			//Actualiza las llaves de paso de los usuarios insertados
			$LlaveEnMD5=hash("md5", $LlaveDePaso);
			$consulta="UPDATE ".$TablasCore."usuario SET llave_paso='".$LlaveEnMD5."' ";
			$consulta_enviar = $ConexionPDO->prepare($consulta);
			$consulta_enviar->execute();
		}
?>
</div>

<?php
	echo '
	<table  class="table table-unbordered"><tr><td align=left>
		<b>'.$MULTILANG_Totalejecutado.':</b> '.$total_ejecutadas.'<br>
		'.$MULTILANG_MsjFinal1.'<br>
		<br>
		<b>'.$MULTILANG_Importante.':</b><br>
		<u><b>'.$MULTILANG_MsjFinal2.'
		<br><br>
	<b>'.$MULTILANG_MsjFinal3.'</b> ('.$RutaScriptSQL.'):<br>
	<textarea rows="7" class="form-control">'.$total_consultas.'</textarea>
	</td></tr></table>';

	PCO_AbrirBarraEstado();
	if (!$hay_error)
		{
            //Intenta renombrar carpeta de instalacion
            $nueva_carpeta="../ins_".PCO_TextoAleatorio(10);
            $estado_renombrado = @rename("../ins/" , $nueva_carpeta);
            //Si hay un error intenta un exec
            if (!$estado_renombrado)
                {
                    $cmd = 'mv "../ins" "'.$nueva_carpeta.'"'; 
                    @exec($cmd, $output, $return_val);                    
                }

            //Agrega boton para redirigir a la instalacion
            echo '<form name="continuar" action="../" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="accion" value="Terminar_sesion">
				<input type="Submit" class="btn btn-success" value=" '.$MULTILANG_IrInstalacion.' " onclick="document.continuar.submit();">
				</form>';
		}
	PCO_CerrarBarraEstado();
?>