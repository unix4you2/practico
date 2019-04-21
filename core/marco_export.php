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
		<PCO_CargarInforme>
	*/

	//Variables globales
	global $NombreRAD,$ArchivoCORE;
	global $MULTILANG_InfFormato,$MULTILANG_Importante,$MULTILANG_InfGeneraPDFInfoDesc,$MULTILANG_Exportar,$MULTILANG_Cerrar,$MULTILANG_InfTitulo,$MULTILANG_ParamNombreApp,$MULTILANG_Encabezados,$MULTILANG_Ninguno,$MULTILANG_InfAutoajusteAncho,$MULTILANG_Si,$MULTILANG_No,$MULTILANG_InfBordesCelda,$MULTILANG_InfBordesTodos,$MULTILANG_InfBordesArriba,$MULTILANG_InfBordesAbajo,$MULTILANG_InfBordesArrAba,$MULTILANG_InfBordesIzq,$MULTILANG_InfBordesDer,$MULTILANG_InfBordesIzqDer,$MULTILANG_OrientacionPagina,$MULTILANG_Vertical,$MULTILANG_Horizontal,$MULTILANG_InfTamanoPapel,$MULTILANG_Basicos,$MULTILANG_Otros,$MULTILANG_InfReducir,$MULTILANG_FrmAncho,$MULTILANG_Pagina,$MULTILANG_InfAlto,$MULTILANG_InfTitPersonalizar;
?>



    <div class="oculto_impresion">
    <!-- Modal Configuracion -->
    <?php PCO_AbrirDialogoModal("myModalEXPORTACION",$MULTILANG_Exportar,"oculto_impresion"); ?>

		<form  name="exportacion_informe" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			<input type="Hidden" name="PCO_Accion" value="PCO_ExportarInforme">
			<input type="Hidden" name="PCO_Titulo" value="<?php echo $registro_informe["titulo"]; ?>">
			<input type="Hidden" name="PCO_IDInforme" value="<?php echo $informe; ?>">
			<input type="Hidden" name="PCO_Consulta" value="<?php echo base64_encode(PCO_ConstruirConsultaInforme($informe,1)); ?>">
			<input type="Hidden" name="Precarga_EstilosBS" value="0">
			<input type="Hidden" name="Presentar_FullScreen" value="1">

            <label for="PCO_Formato"><i class="fa fa-file"></i> <?php echo $MULTILANG_InfFormato; ?>:</label>
            <div class="form-group input-group">
                <select id="PCO_Formato" name="PCO_Formato" class="selectpicker" data-style="btn-warning">
                    <option value="xls"  >Excel 5 (.XLS)</option>
                    <option value="xlsx" >Excel 2007 (.XLSX - XML Document)</option>
                    <option value="ods"  >Libre Office (.ODS - Open Document)</option>
                    <option value="csv"  >Separado por comas (.CSV - Comma Separated Values)</option>
                    <option value="html" >Pagina web (.HTML - Web Document)</option>
                </select>
                <span class="input-group-addon">
                    <a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_Importante; ?></b><br><?php echo $MULTILANG_InfGeneraPDFInfoDesc; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                </span>
            </div>

			<hr>
			<h4><b><?php echo $MULTILANG_InfTitPersonalizar; ?></b></h4>
			
            <label for="PCO_Encabezados"><i class="fa fa-list-alt"></i> <?php echo $MULTILANG_Encabezados; ?>:</label>
            <div class="form-group input-group">
                <select id="PCO_Encabezados" name="PCO_Encabezados"  class="selectpicker" data-style="btn-info" >
                    <option value="xls"  ><?php echo $MULTILANG_ParamNombreApp; ?> - <?php echo $MULTILANG_InfTitulo; ?></option>
                    <option value="" ><?php echo $MULTILANG_Ninguno; ?></option>
                </select>
            </div>


			<div class="row">
				<div class="col-md-6">
					<label for="PCO_AnchoAuto"><i class="fa fa-text-width"></i> <?php echo $MULTILANG_InfAutoajusteAncho; ?>:</label>
					<div class="form-group input-group">
						<select id="PCO_AnchoAuto" name="PCO_AnchoAuto"  class="selectpicker" data-style="btn-default" >
							<option value="1" ><?php echo $MULTILANG_Si; ?></option>
							<option value="0" ><?php echo $MULTILANG_No; ?></option>
						</select>
					</div>	
				</div>
				<div class="col-md-6">
					<label for="PCO_BordesCelda"><i class="fa fa-table"></i> <?php echo $MULTILANG_InfBordesCelda; ?>:</label>
					<div class="form-group input-group">
						<select id="PCO_BordesCelda" name="PCO_BordesCelda" class="selectpicker" data-style="btn-default"  >
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
				</div>
			</div>


			<div class="row">
				<div class="col-md-6">
					<label for="PCO_Orientacion"><i class="fa fa-repeat"></i> <?php echo $MULTILANG_OrientacionPagina; ?>:</label>
					<div class="form-group input-group">
						<select id="PCO_Orientacion" name="PCO_Orientacion" class="selectpicker" data-style="btn-default"  >
							<option value="ORIENTATION_PORTRAIT" ><?php echo $MULTILANG_Vertical; ?></option>
							<option value="ORIENTATION_LANDSCAPE" ><?php echo $MULTILANG_Horizontal; ?></option>
						</select>
					</div>	
				</div>
				<div class="col-md-6">
					<label for="PCO_TamanoPapel"><i class="fa fa-file-o"></i> <?php echo $MULTILANG_InfTamanoPapel; ?>:</label>
					<div class="form-group input-group">
						<select id="PCO_TamanoPapel" name="PCO_TamanoPapel" class="selectpicker" data-style="btn-default"  >
							<optgroup label="<?php echo $MULTILANG_Basicos; ?>">
								<option value="PAPERSIZE_LETTER" >LETTER (Carta)</option>
								<option value="PAPERSIZE_LEGAL" >LEGAL (Oficio)</option>
								<option value="PAPERSIZE_A4" >A4</option>
								<option value="PAPERSIZE_EXECUTIVE" >EXECUTIVE</option>
								<option value="PAPERSIZE_FOLIO" >FOLIO</option>
								<option value="PAPERSIZE_TABLOID" >TABLOIDE</option>
							</optgroup>
							<optgroup label="<?php echo $MULTILANG_Otros; ?>">
								<option value="PAPERSIZE_6_3_4_ENVELOPE" >6_3_4_ENVELOPE</option>
								<option value="PAPERSIZE_A2_PAPER" >A2</option>
								<option value="PAPERSIZE_A3" >A3</option>
								<option value="PAPERSIZE_A3_EXTRA_PAPER" >A3_EXTRA</option>
								<option value="PAPERSIZE_A3_EXTRA_TRANSVERSE_PAPER" >A3_EXTRA_TRANSVERSE</option>
								<option value="PAPERSIZE_A3_TRANSVERSE_PAPER" >A3_TRANSVERSE</option>
								<option value="PAPERSIZE_A4_EXTRA_PAPER" >A4_EXTRA</option>
								<option value="PAPERSIZE_A4_PLUS_PAPER" >A4_PLUS</option>
								<option value="PAPERSIZE_A4_SMALL" >A4_SMALL</option>
								<option value="PAPERSIZE_A4_TRANSVERSE_PAPER" >A4_TRANSVERSE</option>
								<option value="PAPERSIZE_A5" >A5</option>
								<option value="PAPERSIZE_A5_EXTRA_PAPER" >A5_EXTRA</option>
								<option value="PAPERSIZE_A5_TRANSVERSE_PAPER" >A5_TRANSVERSE</option>
								<option value="PAPERSIZE_B4" >B4</option>
								<option value="PAPERSIZE_B4_ENVELOPE" >B4_ENVELOPE</option>
								<option value="PAPERSIZE_B5" >B5</option>
								<option value="PAPERSIZE_B5_ENVELOPE" >B5_ENVELOPE</option>
								<option value="PAPERSIZE_B6_ENVELOPE" >B6_ENVELOPE</option>
								<option value="PAPERSIZE_C" >C</option>
								<option value="PAPERSIZE_C3_ENVELOPE" >C3_ENVELOPE</option>
								<option value="PAPERSIZE_C4_ENVELOPE" >C4_ENVELOPE</option>
								<option value="PAPERSIZE_C5_ENVELOPE" >C5_ENVELOPE</option>
								<option value="PAPERSIZE_C6_ENVELOPE" >C6_ENVELOPE</option>
								<option value="PAPERSIZE_C65_ENVELOPE" >C65_ENVELOPE</option>
								<option value="PAPERSIZE_D" >D</option>
								<option value="PAPERSIZE_DL_ENVELOPE" >DL_ENVELOPE</option>
								<option value="PAPERSIZE_E" >E</option>
								<option value="PAPERSIZE_GERMAN_LEGAL_FANFOLD" >GERMAN_LEGAL_FANFOLD</option>
								<option value="PAPERSIZE_GERMAN_STANDARD_FANFOLD" >GERMAN_STANDARD_FANFOLD</option>
								<option value="PAPERSIZE_INVITE_ENVELOPE" >INVITE_ENVELOPE</option>
								<option value="PAPERSIZE_ISO_B4" >ISO_B4</option>
								<option value="PAPERSIZE_ISO_B5_EXTRA_PAPER" >ISO_B5_EXTRA</option>
								<option value="PAPERSIZE_ITALY_ENVELOPE" >ITALY_ENVELOPE</option>
								<option value="PAPERSIZE_JAPANESE_DOUBLE_POSTCARD" >JAPANESE_DOUBLE_POSTCARD</option>
								<option value="PAPERSIZE_JIS_B5_TRANSVERSE_PAPER" >JIS_B5_TRANSVERSE</option>
								<option value="PAPERSIZE_LEDGER" >LEDGER</option>
								<option value="PAPERSIZE_LEGAL_EXTRA_PAPER" >LEGAL_EXTRA</option>
								<option value="PAPERSIZE_LETTER_EXTRA_PAPER" >LETTER_EXTRA</option>
								<option value="PAPERSIZE_LETTER_EXTRA_TRANSVERSE_PAPER" >LETTER_EXTRA_TRANSVERSE</option>
								<option value="PAPERSIZE_LETTER_PLUS_PAPER" >LETTER_PLUS</option>
								<option value="PAPERSIZE_LETTER_SMALL" >LETTER_SMALL</option>
								<option value="PAPERSIZE_LETTER_TRANSVERSE_PAPER" >LETTER_TRANSVERSE</option>
								<option value="PAPERSIZE_MONARCH_ENVELOPE" >MONARCH_ENVELOPE</option>
								<option value="PAPERSIZE_NO9_ENVELOPE" >NO9_ENVELOPE</option>
								<option value="PAPERSIZE_NO10_ENVELOPE" >NO10_ENVELOPE</option>
								<option value="PAPERSIZE_NO11_ENVELOPE" >NO11_ENVELOPE</option>
								<option value="PAPERSIZE_NO12_ENVELOPE" >NO12_ENVELOPE</option>
								<option value="PAPERSIZE_NO14_ENVELOPE" >NO14_ENVELOPE</option>
								<option value="PAPERSIZE_NOTE" >NOTE</option>
								<option value="PAPERSIZE_QUARTO" >QUARTO</option>
								<option value="PAPERSIZE_STANDARD_1" >STANDARD_1</option>
								<option value="PAPERSIZE_STANDARD_2" >STANDARD_2</option>
								<option value="PAPERSIZE_STANDARD_PAPER_1" >STANDARD_PAPER_1</option>
								<option value="PAPERSIZE_STANDARD_PAPER_2" >STANDARD_PAPER_2</option>
								<option value="PAPERSIZE_STANDARD_PAPER_3" >STANDARD_PAPER_3</option>
								<option value="PAPERSIZE_STATEMENT" >STATEMENT</option>
								<option value="PAPERSIZE_SUPERA_SUPERA_A4_PAPER" >SUPERA_SUPERA_A4</option>
								<option value="PAPERSIZE_SUPERB_SUPERB_A3_PAPER" >SUPERB_SUPERB_A3</option>
								<option value="PAPERSIZE_TABLOID_EXTRA_PAPER" >TABLOID_EXTRA</option>
								<option value="PAPERSIZE_US_STANDARD_FANFOLD" >US_STANDARD_FANFOLD</option>
							</optgroup>
						</select>
					</div>
				</div>
			</div>

			<hr>
			<div class="row">
				<div class="col-md-8">
					<label for="PCO_Autoajustar"><i class="fa fa-text-height"></i> <?php echo $MULTILANG_InfReducir; ?> en <?php echo $MULTILANG_Pagina; ?>(s):</label>
					<div class="form-group input-group">
						<select id="PCO_Autoajustar" name="PCO_Autoajustar" class="selectpicker" data-style="btn-default"  >
							<option value="0" ><?php echo $MULTILANG_No; ?></option>
							<option value="1" ><?php echo $MULTILANG_Si; ?></option>
						</select>
					</div>
				</div>
				<div class="col-md-2">
					<label for="PCO_Ancho"><?php echo $MULTILANG_FrmAncho; ?>:</label>
					<div class="form-group input-group">
						<select id="PCO_Ancho" name="PCO_Ancho" class="selectpicker" data-style="btn-default"  >
							<option value="1" >1</option>
							<option value="2" >2</option>
							<option value="3" >3</option>
							<option value="4" >4</option>
							<option value="5" >5</option>
							<option value="6" >6</option>
							<option value="7" >7</option>
							<option value="8" >8</option>
							<option value="9" >9</option>
							<option value="10" >10</option>
							<option value="11" >11</option>
							<option value="12" >12</option>
							<option value="13" >13</option>
							<option value="14" >14</option>
							<option value="15" >15</option>
							<option value="16" >16</option>
							<option value="17" >17</option>
							<option value="18" >18</option>
							<option value="19" >19</option>
							<option value="20" >20</option>
							<option value="21" >21</option>
							<option value="22" >22</option>
							<option value="23" >23</option>
							<option value="24" >24</option>
							<option value="25" >25</option>
							<option value="26" >26</option>
							<option value="27" >27</option>
							<option value="28" >28</option>
							<option value="29" >29</option>
							<option value="30" >30</option>
						</select>
					</div>
				</div>
				<div class="col-md-2">
					<label for="PCO_Alto"><?php echo $MULTILANG_InfAlto; ?>:</label>
					<div class="form-group input-group">
						<select id="PCO_Alto" name="PCO_Alto" class="selectpicker" data-style="btn-default"  >
							<option value="1" >1</option>
							<option value="2" >2</option>
							<option value="3" >3</option>
							<option value="4" >4</option>
							<option value="5" >5</option>
							<option value="6" >6</option>
							<option value="7" >7</option>
							<option value="8" >8</option>
							<option value="9" >9</option>
							<option value="10" >10</option>
							<option value="11" >11</option>
							<option value="12" >12</option>
							<option value="13" >13</option>
							<option value="14" >14</option>
							<option value="15" >15</option>
							<option value="16" >16</option>
							<option value="17" >17</option>
							<option value="18" >18</option>
							<option value="19" >19</option>
							<option value="20" >20</option>
							<option value="21" >21</option>
							<option value="22" >22</option>
							<option value="23" >23</option>
							<option value="24" >24</option>
							<option value="25" >25</option>
							<option value="26" >26</option>
							<option value="27" >27</option>
							<option value="28" >28</option>
							<option value="29" >29</option>
							<option value="30" >30</option>
						</select>
					</div>
				</div>
			</div>
			
			
			



		</form>

    <?php 
    $barra_herramientas_modal='
        <button type="button" class="btn btn-success" OnClick="document.forms.exportacion_informe.submit();">'.$MULTILANG_Exportar.' <i class="fa fa-floppy-o"></i></button>
        <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
    PCO_CerrarDialogoModal($barra_herramientas_modal);
    echo '</div>';