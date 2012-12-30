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
?>

<div align=center>
<table width="700" cellspacing=10>
	<tr>
		<td><img src="../img/practico_login.png" border=0 ALT="Logo Practico"></td>
		<td valign=top><font size=2 color=black><br><b>
			[Bienvenido al proceso de instalaci&oacute;n]</b><br><br>
			Este asistente le guiar&aacute; en cada paso de las configuraciones iniciales para el uso de Pr&aacute;ctico como un entorno visual para el desarrollo de aplicaciones web.
		</font></td>
	</tr>
</table>
<hr>
<b>Esta herramienta es liberada bajo licencia GNU-GPL v2</b> descrita a continuaci&oacute;n:<br>
<textarea cols="100" rows="7" class="AreaTexto">
	<?php include("../inc/gpl-2.0.txt"); ?>
</textarea>
<br><br>
Una copia en l&iacute;nea de esta licencia puede ser encontrada en diferentes formatos en el sitio web de la GNU<br> a trav&eacute;s de <a href="http://www.gnu.org/licenses/gpl-2.0.html">este enlace</a>. Si usted acepta los terminos de esta licencia, haga clic en el bot&oacute;n continuar.
<br><br>
</div>



<?php
	abrir_barra_estado();
	$anterior=$paso-1;
	$siguiente=$paso+1;
	echo '
		<form name="continuar" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			<input type="Hidden" name="paso" value="'.$siguiente.'">
			<input type="Submit" class="BotonesEstadoCuidado" value=" Acepto la licencia - Continuar >>> ">
		</form>';
	cerrar_barra_estado();

?>



