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

	/*
		Title: Seccion marco de exportaciones
		Ubicacion *[/core/marco_export.php]*.  Archivo que presenta las opciones de exportacion disponibles para los informes

	Ver tambien:
		<cargar_informe>
	*/

	//Variables globales
	global $NombreRAD,$ArchivoCORE;
	global $MULTILANG_InfFormato,$MULTILANG_Importante,$MULTILANG_InfGeneraPDFInfoDesc,$MULTILANG_Exportar,$MULTILANG_Cerrar;

?>



    <div class="oculto_impresion">
    <!-- Modal Configuracion -->
    <?php abrir_dialogo_modal("myModalEXPORTACION",$MULTILANG_Exportar,"oculto_impresion"); ?>

		<form  name="exportacion_informe" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			<input type="Hidden" name="PCO_Accion" value="exportar_informe">
			<input type="Hidden" name="PCO_Titulo" value="<?php echo $registro_informe["titulo"]; ?>">
			<input type="Hidden" name="PCO_IDInforme" value="<?php echo $informe; ?>">
			<input type="Hidden" name="PCO_Consulta" value="<?php echo base64_encode(construir_consulta_informe($informe,1)); ?>">
			<input type="Hidden" name="Precarga_EstilosBS" value="0">
			<input type="Hidden" name="Presentar_FullScreen" value="1">

            <label for="formato_final"><?php echo $MULTILANG_InfFormato; ?>:</label>
            <div class="form-group input-group">
                <select id="PCO_Formato" name="PCO_Formato" class="form-control" >
                    <option value="ods"  >Libre Office (.ODS - Open Document)</option>
                    <option value="xls"  >Excel 5 (.XLS)</option>
                    <option value="xlsx" >Excel 2007 (.XLSX - Documento XML)</option>
                </select>
                <span class="input-group-addon">
                    <a href="#" title="<?php echo $MULTILANG_Importante; ?>: <?php echo $MULTILANG_InfGeneraPDFInfoDesc; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                </span>
            </div>		
		</form>

    <?php 
    $barra_herramientas_modal='
        <button type="button" class="btn btn-success" OnClick="document.forms.exportacion_informe.submit();">'.$MULTILANG_Exportar.' <i class="fa fa-floppy-o"></i></button>
        <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
    cerrar_dialogo_modal($barra_herramientas_modal);
    echo '</div>';
