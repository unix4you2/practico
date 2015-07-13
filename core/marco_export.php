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
	global $MULTILANG_InfFormato,$MULTILANG_Importante,$MULTILANG_InfGeneraPDFInfoDesc,$MULTILANG_Exportar,$MULTILANG_Cerrar,$MULTILANG_InfTitulo,$MULTILANG_ParamNombreApp,$MULTILANG_Encabezados,$MULTILANG_Ninguno,$MULTILANG_InfAutoajusteAncho,$MULTILANG_Si,$MULTILANG_No,$MULTILANG_InfBordesCelda,$MULTILANG_InfBordesTodos,$MULTILANG_InfBordesArriba,$MULTILANG_InfBordesAbajo,$MULTILANG_InfBordesArrAba,$MULTILANG_InfBordesIzq,$MULTILANG_InfBordesDer,$MULTILANG_InfBordesIzqDer;

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

            <label for="PCO_Formato"><?php echo $MULTILANG_InfFormato; ?>:</label>
            <div class="form-group input-group">
                <select id="PCO_Formato" name="PCO_Formato" class="form-control" >
                    <option value="xls"  >Excel 5 (.XLS)</option>
                    <option value="xlsx" >Excel 2007 (.XLSX - XML Document)</option>
                    <option value="ods"  >Libre Office (.ODS - Open Document)</option>
                    <option value="csv"  >Separado por comas (.CSV - Comma Separated Values)</option>
                    <option value="html" >Pagina web (.HTML - Web Document)</option>
                </select>
                <span class="input-group-addon">
                    <a href="#" title="<?php echo $MULTILANG_Importante; ?>: <?php echo $MULTILANG_InfGeneraPDFInfoDesc; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                </span>
            </div>		

            <label for="PCO_Encabezados"><?php echo $MULTILANG_Encabezados; ?>:</label>
            <div class="form-group input-group">
                <select id="PCO_Encabezados" name="PCO_Encabezados" class="form-control" >
                    <option value="xls"  ><?php echo $MULTILANG_ParamNombreApp; ?> - <?php echo $MULTILANG_InfTitulo; ?></option>
                    <option value="" ><?php echo $MULTILANG_Ninguno; ?></option>
                </select>
            </div>	

            <label for="PCO_AnchoAuto"><?php echo $MULTILANG_InfAutoajusteAncho; ?>:</label>
            <div class="form-group input-group">
                <select id="PCO_AnchoAuto" name="PCO_AnchoAuto" class="form-control" >
                    <option value="1" ><?php echo $MULTILANG_Si; ?></option>
                    <option value="0" ><?php echo $MULTILANG_No; ?></option>
                </select>
            </div>	

            <label for="PCO_BordesCelda"><?php echo $MULTILANG_InfBordesCelda; ?>:</label>
            <div class="form-group input-group">
                <select id="PCO_BordesCelda" name="PCO_BordesCelda" class="form-control" >
                    <option value="" ><?php echo $MULTILANG_Ninguno; ?></option>
                    <option value="_LRTB" ><?php echo $MULTILANG_InfBordesTodos; ?></option>
                    <option value="_T" ><?php echo $MULTILANG_InfBordesArriba; ?></option>
                    <option value="_B" ><?php echo $MULTILANG_InfBordesAbajo; ?></option>
                    <option value="_TB" ><?php echo $MULTILANG_InfBordesArrAba; ?></option>
                    <option value="_L" ><?php echo $MULTILANG_InfBordesIzq; ?></option>
                    <option value="_R" ><?php echo $MULTILANG_InfBordesDer; ?></option>
                    <option value="_LR" ><?php echo $MULTILANG_InfBordesIzqDer; ?></option>
                </select>
            </div>	

		</form>

    <?php 
    $barra_herramientas_modal='
        <button type="button" class="btn btn-success" OnClick="document.forms.exportacion_informe.submit();">'.$MULTILANG_Exportar.' <i class="fa fa-floppy-o"></i></button>
        <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
    cerrar_dialogo_modal($barra_herramientas_modal);
    echo '</div>';
