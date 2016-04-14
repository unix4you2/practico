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
				Title: Modulo informes
				Ubicacion *[/core/informes.php]*.  Archivo de funciones relacionadas con la gestion de informes de la aplicacion.
			*/
?>
<?php
			/*
				Section: Operaciones Basicas de Administracion
				Funciones asociadas al mantenimiento de informes en el sistema.
			*/
?>


<?php 



/* ################################################################## */
/* ################################################################## */
/*
	Function: calcular_columna_hojacalculo
	Recibe un numero de columa y retorna su notacion en letras 1=A, 2=B... 26=Z, 27=AA, 28=AB...

	Variables de entrada:

		ColumnaDeseada - Numero de columna a convertir

	Salida:
		Cadena de letras correspondiente a la columna para una hoja de calculo estandar
*/
function calcular_columna_hojacalculo($ColumnaDeseada)
	{
		//TODO:  Esto genera maximo hasta 702 Columnas (iniciando desde 0=A hasta 701=ZZ) aumentar a ilimitado
		if ($ColumnaDeseada>702) $ColumnaDeseada=702;
		
		$CadenaLetrasColumna='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$LongitudLetrasColumna=strlen($CadenaLetrasColumna);
		$ColumnaGenerada=0;
		$PosicionPrefijo=-1;
		$PosicionCaracter=0;
		$ColumnasIteradas=array();
		
		while($ColumnaGenerada<$ColumnaDeseada)
			{
				//Si hay un prefijo definido
				if ($PosicionPrefijo>=0)
					{
						$Prefijo=$CadenaLetrasColumna[$PosicionPrefijo];
					}
				$ColumnasIteradas[]=$Prefijo.$CadenaLetrasColumna[$PosicionCaracter];

				$PosicionCaracter++;
				$ColumnaGenerada++;	

				//Si llega al final de la cadena empieza nuevamente
				if($PosicionCaracter>$LongitudLetrasColumna-1)
					{
						$PosicionCaracter=0;
						$PosicionPrefijo++;
					}
			}

		return $ColumnasIteradas[$ColumnaDeseada-1];
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: exportar_informe
	Elimina un boton creado para los registros desplegados por un informe tabular

	Variables de entrada:

		PCO_Consulta - Consulta en SQL que genera los datos a ser exportados
		PCO_Formato - El formato en que debe ser devuelto el informe  xls|
		PCO_Titulo - El titulo del informe generado
		PCO_IDInforme - El ID del informe que se esta generando en el momento

	Ejemplos de asignacion de celdas:
		* VALORES FIJOS: 	$PCO_ObjetoPHPExcel->setActiveSheetIndex(0)->setCellValue("A3", "MiValor");
		* FORMULAS:      	$PCO_ObjetoPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', '=sum(A2:B2)');

							$objXLS->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
							$objXLS->getActiveSheet()->getColumnDimension('B')->setWidth(12);
							$objXLS->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
							$objXLS->getActiveSheet()->getRowDimension('1')->setRowHeight(30);

							OTROS FORMATOS:
							$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("A$FilaActiva")->getAlignment()->setWrapText(true);
							$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("A$FilaActiva")->getFont()->setSize(16);
							$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("A$FilaActiva")->getFont()->setBold(true);
							
							UNIR CELDAS:
							$PCO_ObjetoPHPExcel->getActiveSheet()->mergeCells('A1:C1');
							$PCO_ObjetoPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:C1');
							
							DIBUJAR BORDES:
							$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("A1")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK); //Grueso
							$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("A1")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); //Delgado



							ASIGNACION DE ESTILOS DE BORDE
							$borders = array(
								  'borders' => array(
									'allborders' => array(
									  'style' => PHPExcel_Style_Border::BORDER_THIN,
									  'color' => array('argb' => 'FF000000'),
									)
								  ),
								);
							$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($borders);
							 
							Otra: $PCO_ObjetoPHPExcel->getActiveSheet()->getStyle('A')->applyFromArray($borders);

							ASIGNACION DE ESTILOS DE FUENTE:
							$styleArray = array(
								'font' => array(
									'bold' => true,
								),
								'alignment' => array(
									'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
								),
								'borders' => array(
									'top' => array(
										'style' => PHPExcel_Style_Border::BORDER_THIN,
									),
								),
								'fill' => array(
									'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
									'rotation' => 90,
									'startcolor' => array(
										'argb' => 'FFA0A0A0',
									),
									'endcolor' => array(
										'argb' => 'FFFFFFFF',
									),
								),
							);
							 
							$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($styleArray);


	Salida:
		Datos del informe en archivo entregado para descarga
*/
	if ($PCO_Accion=="exportar_informe")
		{

			//Devuelve la consulta a su valor inicial
			$PCO_Consulta=base64_decode($PCO_Consulta);
		
			//Limpia la salida generada hasta el momento para entregar un archivo limpio
			ob_clean();

			//Exporta a los diferentes formatos segun lo recibido como parametro
			if ($PCO_Formato=="xls" || $PCO_Formato=="xlsx" || $PCO_Formato=="ods" || $PCO_Formato=="csv" || $PCO_Formato=="html")
				{
					// Crea nuevo objeto PHPExcel
					$PCO_ObjetoPHPExcel = new PHPExcel();

					// Establece propiedades del documento
					$PCO_ObjetoPHPExcel->getProperties()->setCreator("Practico Framework PHP")
												 ->setLastModifiedBy($PCOSESS_LoginUsuario)
												 ->setTitle($PCO_Titulo)
												 ->setSubject("$Nombre_Aplicacion $PCO_FechaOperacionGuiones desde $PCO_DireccionAuditoria")
												 ->setDescription("Reporte formato $PCO_Formato, generado por Practico Framework PHP. www.practico.org")
												 ->setKeywords("$PCO_Formato Reporte Practico")
												 ->setCategory("$PCO_Formato");
					
					//Establece orientacion de la hoja
					if ($PCO_Orientacion=="ORIENTATION_PORTRAIT")
						$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
					else
						$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
					
					//Establece tamano del papel
					switch ($PCO_TamanoPapel)
						{
							case "PAPERSIZE_6_3_4_ENVELOPE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_6_3_4_ENVELOPE); break;
							case "PAPERSIZE_A2_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A2_PAPER); break;
							case "PAPERSIZE_A3":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3); break;
							case "PAPERSIZE_A3_EXTRA_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3_EXTRA_PAPER); break;
							case "PAPERSIZE_A3_EXTRA_TRANSVERSE_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3_EXTRA_TRANSVERSE_PAPER); break;
							case "PAPERSIZE_A3_TRANSVERSE_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3_TRANSVERSE_PAPER); break;
							case "PAPERSIZE_A4":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4); break;
							case "PAPERSIZE_A4_EXTRA_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4_EXTRA_PAPER); break;
							case "PAPERSIZE_A4_PLUS_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4_PLUS_PAPER); break;
							case "PAPERSIZE_A4_SMALL":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4_SMALL); break;
							case "PAPERSIZE_A4_TRANSVERSE_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4_TRANSVERSE_PAPER); break;
							case "PAPERSIZE_A5":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A5); break;
							case "PAPERSIZE_A5_EXTRA_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A5_EXTRA_PAPER); break;
							case "PAPERSIZE_A5_TRANSVERSE_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A5_TRANSVERSE_PAPER); break;
							case "PAPERSIZE_B4":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_B4); break;
							case "PAPERSIZE_B4_ENVELOPE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_B4_ENVELOPE); break;
							case "PAPERSIZE_B5":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_B5); break;
							case "PAPERSIZE_B5_ENVELOPE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_B5_ENVELOPE); break;
							case "PAPERSIZE_B6_ENVELOPE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_B6_ENVELOPE); break;
							case "PAPERSIZE_C":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_C); break;
							case "PAPERSIZE_C3_ENVELOPE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_C3_ENVELOPE); break;
							case "PAPERSIZE_C4_ENVELOPE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_C4_ENVELOPE); break;
							case "PAPERSIZE_C5_ENVELOPE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_C5_ENVELOPE); break;
							case "PAPERSIZE_C6_ENVELOPE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_C6_ENVELOPE); break;
							case "PAPERSIZE_C65_ENVELOPE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_C65_ENVELOPE); break;
							case "PAPERSIZE_D":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_D); break;
							case "PAPERSIZE_DL_ENVELOPE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_DL_ENVELOPE); break;
							case "PAPERSIZE_E":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_E); break;
							case "PAPERSIZE_EXECUTIVE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_EXECUTIVE); break;
							case "PAPERSIZE_FOLIO":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_FOLIO); break;
							case "PAPERSIZE_GERMAN_LEGAL_FANFOLD":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_GERMAN_LEGAL_FANFOLD); break;
							case "PAPERSIZE_GERMAN_STANDARD_FANFOLD":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_GERMAN_STANDARD_FANFOLD); break;
							case "PAPERSIZE_INVITE_ENVELOPE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_INVITE_ENVELOPE); break;
							case "PAPERSIZE_ISO_B4":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_ISO_B4); break;
							case "PAPERSIZE_ISO_B5_EXTRA_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_ISO_B5_EXTRA_PAPER); break;
							case "PAPERSIZE_ITALY_ENVELOPE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_ITALY_ENVELOPE); break;
							case "PAPERSIZE_JAPANESE_DOUBLE_POSTCARD":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_JAPANESE_DOUBLE_POSTCARD); break;
							case "PAPERSIZE_JIS_B5_TRANSVERSE_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_JIS_B5_TRANSVERSE_PAPER); break;
							case "PAPERSIZE_LEDGER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEDGER); break;
							case "PAPERSIZE_LEGAL":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL); break;
							case "PAPERSIZE_LEGAL_EXTRA_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL_EXTRA_PAPER); break;
							case "PAPERSIZE_LETTER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER); break;
							case "PAPERSIZE_LETTER_EXTRA_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER_EXTRA_PAPER); break;
							case "PAPERSIZE_LETTER_EXTRA_TRANSVERSE_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER_EXTRA_TRANSVERSE_PAPER); break;
							case "PAPERSIZE_LETTER_PLUS_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER_PLUS_PAPER); break;
							case "PAPERSIZE_LETTER_SMALL":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER_SMALL); break;
							case "PAPERSIZE_LETTER_TRANSVERSE_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER_TRANSVERSE_PAPER); break;
							case "PAPERSIZE_MONARCH_ENVELOPE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_MONARCH_ENVELOPE); break;
							case "PAPERSIZE_NO9_ENVELOPE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_NO9_ENVELOPE); break;
							case "PAPERSIZE_NO10_ENVELOPE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_NO10_ENVELOPE); break;
							case "PAPERSIZE_NO11_ENVELOPE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_NO11_ENVELOPE); break;
							case "PAPERSIZE_NO12_ENVELOPE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_NO12_ENVELOPE); break;
							case "PAPERSIZE_NO14_ENVELOPE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_NO14_ENVELOPE); break;
							case "PAPERSIZE_NOTE":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_NOTE); break;
							case "PAPERSIZE_QUARTO":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_QUARTO); break;
							case "PAPERSIZE_STANDARD_1":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_STANDARD_1); break;
							case "PAPERSIZE_STANDARD_2":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_STANDARD_2); break;
							case "PAPERSIZE_STANDARD_PAPER_1":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_STANDARD_PAPER_1); break;
							case "PAPERSIZE_STANDARD_PAPER_2":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_STANDARD_PAPER_2); break;
							case "PAPERSIZE_STANDARD_PAPER_3":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_STANDARD_PAPER_3); break;
							case "PAPERSIZE_STATEMENT":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_STATEMENT); break;
							case "PAPERSIZE_SUPERA_SUPERA_A4_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_SUPERA_SUPERA_A4_PAPER); break;
							case "PAPERSIZE_SUPERB_SUPERB_A3_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_SUPERB_SUPERB_A3_PAPER); break;
							case "PAPERSIZE_TABLOID":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_TABLOID); break;
							case "PAPERSIZE_TABLOID_EXTRA_PAPER":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_TABLOID_EXTRA_PAPER); break;
							case "PAPERSIZE_US_STANDARD_FANFOLD":	$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_US_STANDARD_FANFOLD); break;
						}

					//Autoajuste de impresion en contenidos
					if ($PCO_Autoajustar==1)
						{
							$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
							$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth($PCO_Ancho);
							$PCO_ObjetoPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight($PCO_Alto);
						}

					//INICIO: ADICION DE CONTENIDOS
						$FilaActiva=1;
						
						//Agrega espacios para encabezados cuando aplica
						if ($PCO_Encabezados!="")
							$FilaActiva+=2;

						//Encabezados (primera fila)
							//Determina si el informe tiene o no campos ocultos
							$PCO_ColumnasOcultas=determinar_campos_ocultos($PCO_IDInforme);
							
							//Obtiene ColumnasVisibles, NumerosColumnasOcultas, NumeroColumnas dentro de EtiquetasConsulta
							$EtiquetasConsulta=generar_etiquetas_consulta($PCO_Consulta,$PCO_IDInforme); //Enviar el informe para que se determinen tambien sus columnas ocultas

							//Genera columnas del encabezado
							$ConteoColumna=1;
							foreach($EtiquetasConsulta[0]["ColumnasVisibles"] as $EtiquetaColumna)
								{
									$ColumnaSalida=calcular_columna_hojacalculo($ConteoColumna);
									$PCO_ObjetoPHPExcel->setActiveSheetIndex(0)->setCellValue("$ColumnaSalida$FilaActiva", $EtiquetaColumna);
									$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("$ColumnaSalida$FilaActiva")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('A3F7FF');
									$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("$ColumnaSalida$FilaActiva")->getFont()->setBold(true);
									
									//Dibuja los bordes de columnas de enbcabezado si aplica
									if ($PCO_BordesCelda!="")
										{
											$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("$ColumnaSalida$FilaActiva")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
											$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("$ColumnaSalida$FilaActiva")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
											$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("$ColumnaSalida$FilaActiva")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
											$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("$ColumnaSalida$FilaActiva")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
										}

									$ConteoColumna++;
									
									//Si se activa el ancho automatico
									if ($PCO_AnchoAuto==1)	$PCO_ObjetoPHPExcel->getActiveSheet()->getColumnDimension($ColumnaSalida)->setAutoSize(true);
								}

						//Agrega encabezados. Fusiona celdas del titulo y le da formato cuando aplica
						$MaximaColumna=calcular_columna_hojacalculo($ConteoColumna);
						if ($PCO_Encabezados!="")
							{
								$EncabezadoInforme=$Nombre_Aplicacion.' - '.$PCO_Titulo;
								$PCO_ObjetoPHPExcel->setActiveSheetIndex(0)->setCellValue("A1", $EncabezadoInforme);
								//Da formato a la primera fila de encabezado
								$ColumnasAUnir=calcular_columna_hojacalculo($ConteoColumna-1);
								$PCO_ObjetoPHPExcel->getActiveSheet()->mergeCells("A1:$ColumnasAUnir"."1");
								$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setSize(14);
								$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
								$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("A1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('D0D0D0');
								$PCO_ObjetoPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(-1);

								$EncabezadoAdicionalInforme=$MULTILANG_GeneradoPor.': '.$PCOSESS_LoginUsuario.' - '.$MULTILANG_Fecha.': '.$PCO_FechaOperacionGuiones.' '.$PCO_HoraOperacionPuntos;
								$PCO_ObjetoPHPExcel->setActiveSheetIndex(0)->setCellValue("A2", $EncabezadoAdicionalInforme);
								//Da formato a la segunda fila de encabezado
								$PCO_ObjetoPHPExcel->getActiveSheet()->mergeCells("A2:$ColumnasAUnir"."2");
								$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setSize(9);
								$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setItalic(true);
								$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("A2")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('D0D0D0');
							}
								
						//Registros con los resultados
							$consulta_ejecucion=ejecutar_sql($PCO_Consulta);
							while($registro_informe=$consulta_ejecucion->fetch())
								{
									//Se mueve a la siguiente fila
									$FilaActiva++;
									for ($i=0;$i<$EtiquetasConsulta[0]["NumeroColumnas"];$i++)
										{
											//Muestra la columna solo si no se trata de una de las ocultas
											if (!in_array($i,$EtiquetasConsulta[0]["NumerosColumnasOcultas"]))
												{											
													$ColumnaSalida=calcular_columna_hojacalculo($i+1);
													$PCO_ObjetoPHPExcel->setActiveSheetIndex(0)->setCellValue("$ColumnaSalida$FilaActiva", $registro_informe[$i]);
												
													//Dibuja los bordes si aplica
													if ($PCO_BordesCelda!="")
														{
															//Se distingue el lado del borde por TBLR (Top,Bottom,Left,Right)
															if (!stripos($PCO_BordesCelda,"T")===FALSE)
																$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("$ColumnaSalida$FilaActiva")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
															if (!stripos($PCO_BordesCelda,"B")===FALSE)
																$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("$ColumnaSalida$FilaActiva")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
															if (!stripos($PCO_BordesCelda,"L")===FALSE)
																$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("$ColumnaSalida$FilaActiva")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
															if (!stripos($PCO_BordesCelda,"R")===FALSE)
																$PCO_ObjetoPHPExcel->getActiveSheet()->getStyle("$ColumnaSalida$FilaActiva")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
														}
												}
										}
								}

					//FIN: ADICION DE CONTENIDOS

					// Establece la celda activa
					$PCO_ObjetoPHPExcel->setActiveSheetIndex(0);
					// Renombra la hoja del libro
					$PCO_ObjetoPHPExcel->getActiveSheet()->setTitle($MULTILANG_Resultados);
					// Establece la hoja activa para cuando se abra el archivo en la aplicacion del usuario
					$PCO_ObjetoPHPExcel->setActiveSheetIndex(0);

					// Redirecciona la salida al navegador del cliente
					if ($PCO_Formato=="xls") //Exporta a Excel 5 (.XLS)
						header('Content-Type: application/vnd.ms-excel');
					if ($PCO_Formato=="xlsx") //Exporta a Excel 2007 (.XLSX)
						header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
					if ($PCO_Formato=="ods") //Exporta a LibreOffice (.ODS)
						header('Content-Type: application/vnd.oasis.opendocument.spreadsheet');
					if ($PCO_Formato=="csv") //Exporta a valores separados por comas (.CSV)
						header('Content-Type: application/csv; charset=UTF-8');
					if ($PCO_Formato=="html") //Exporta a formato web (.HTML)
						header('Content-Type: application/html; charset=UTF-8');
					
					header('Content-Disposition: attachment;filename="'.$MULTILANG_Resultados.'_'.$PCO_FechaOperacionGuiones.'_'.$PCO_HoraOperacion.'.'.$PCO_Formato.'"');
					header('Cache-Control: max-age=0');
					// Establece control de cache para internet explorer 9
					header('Cache-Control: max-age=1');
					// Establece otros parametros cuando se trabaja con internet explorer sobre SSL
					header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Fecha en el pasado para que siempre se considere expirado en cache
					header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // Siempre se considera modificado
					header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
					header ('Pragma: public'); // HTTP/1.0

					if ($PCO_Formato=="xls") //Exporta a Excel 5 (.XLS)
						$objWriter = PHPExcel_IOFactory::createWriter($PCO_ObjetoPHPExcel, 'Excel5');
					if ($PCO_Formato=="xlsx") //Exporta a Excel 2007 (.XLSX)
						$objWriter = PHPExcel_IOFactory::createWriter($PCO_ObjetoPHPExcel, 'Excel2007');
					if ($PCO_Formato=="ods") //Exporta a LibreOffice (.ODS)
						$objWriter = PHPExcel_IOFactory::createWriter($PCO_ObjetoPHPExcel, 'OpenDocument');
					if ($PCO_Formato=="csv") //Exporta a valores separados por comas (.CSV)
						$objWriter = PHPExcel_IOFactory::createWriter($PCO_ObjetoPHPExcel, 'CSV');
					if ($PCO_Formato=="html") //Exporta a formato web (.HTML)
						$objWriter = PHPExcel_IOFactory::createWriter($PCO_ObjetoPHPExcel, 'HTML');
					
					//Escribe el archivo hacia el navegador del usuario
					$objWriter->save('php://output');
				}

		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: eliminar_accion_informe
	Elimina un boton creado para los registros desplegados por un informe tabular

	Variables de entrada:

		boton - ID unico del boton sobre el cual se realiza la operacion de eliminacion

	(start code)
		DELETE FROM ".$TablasCore."informe_boton WHERE id='$boton'
	(end)

	Salida:
		Registro de boton eliminado e informe actualizado
*/
	if ($PCO_Accion=="eliminar_accion_informe")
		{
			ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_boton WHERE id=? ","$boton");
			auditar("Elimina accion del informe $informe");
			echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
			<input type="Hidden" name="PCO_Accion" value="editar_informe">
			<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
			<input type="Hidden" name="informe" value="'.$informe.'">
			<input type="Hidden" name="popup_activo" value="InformeAcciones">
			</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: actualizar_agrupamiento_informe
	Cambia el registro asociado a un informe de la aplicacion para el campo de agrupamiento y ordenamiento

	Variables de entrada:

		id - ID del informe que se desea cambiarse
		agrupamiento - Nuevo valor de campo para agrupamiento del query
		ordenamiento - Nuevo valor de campo para ordenamiento del query

		(start code)
			UPDATE ".$TablasCore."informe SET agrupamiento='$agrupamiento',ordenamiento='$ordenamiento' WHERE id=$id
		(end)

	Salida:
		Registro de informe actualizado

	Ver tambien:

		<editar_informe>
*/
if ($PCO_Accion=="actualizar_agrupamiento_informe")
	{
		// Actualiza los datos
		ejecutar_sql_unaria("UPDATE ".$TablasCore."informe SET agrupamiento=?,ordenamiento=? WHERE id=? ","$agrupamiento$_SeparadorCampos_$ordenamiento$_SeparadorCampos_$informe");
		auditar("Actualiza agrupamiento/ordenamiento informe $informe");
		echo '
			<form name="regresar" action="'.$ArchivoCORE.'" method="POST">
			<input type="Hidden" name="PCO_Accion" value="editar_informe">
			<input type="Hidden" name="informe" value="'.$informe.'">
			</form>
		<script type="" language="JavaScript">
		 document.regresar.submit();  </script>';
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: actualizar_grafico_informe
	Cambia el registro asociado a un informe de la aplicacion para el campo de formato de graficos

	Variables de entrada:

		id - ID del informe que se desea cambiarse
		cadena_formato - Formato utilizado para la generacion del grafico incluyendo el tipo y valores para cada una de sus series (nombre, campo usado como etiqueta y campo usado como valor)

		(start code)
			UPDATE ".$TablasCore."informe SET formato_grafico='$cadena_formato' WHERE id=$id
		(end)

	Salida:
		Registro de informe actualizado

	Ver tambien:

		<editar_informe>
*/
if ($PCO_Accion=="actualizar_grafico_informe")
	{
		$mensaje_error="";
		if ($nombre_serie_1=="" || $campo_etiqueta_serie_1=="" || $campo_valor_serie_1=="") $mensaje_error.=$MULTILANG_InfErr1;
		if ($mensaje_error=="")
			{
				//Construye la cadena de formato
				$cadena_formato="";
				$cadena_formato.=$tipo_grafico."|";
				$cadena_formato.=$nombre_serie_1."!".$nombre_serie_2."!".$nombre_serie_3."!".$nombre_serie_4."!".$nombre_serie_5."|";
				$cadena_formato.=$campo_etiqueta_serie_1."!".$campo_etiqueta_serie_2."!".$campo_etiqueta_serie_3."!".$campo_etiqueta_serie_4."!".$campo_etiqueta_serie_5."|";
				$cadena_formato.=$campo_valor_serie_1."!".$campo_valor_serie_2."!".$campo_valor_serie_3."!".$campo_valor_serie_4."!".$campo_valor_serie_5;

				// Actualiza los datos
				ejecutar_sql_unaria("UPDATE ".$TablasCore."informe SET formato_grafico=? WHERE id=? ","$cadena_formato$_SeparadorCampos_$informe");
				auditar("Actualiza informe grafico $informe");
				echo '
					<form name="regresar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="editar_informe">
					<input type="Hidden" name="informe" value="'.$informe.'">
					</form>
				<script type="" language="JavaScript">
				 document.regresar.submit();  </script>';
			}
		else
			{
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="editar_informe">
					<input type="Hidden" name="informe" value="'.$informe.'">
					<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
					<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: actualizar_informe
	Cambia el registro asociado a un informe de la aplicacion

	Variables de entrada:

		id - ID del informe que se desea cambiarse
		variables - Nuevos valores de variable para formato_final, alto,ancho,titulo,descripcion,categoria

		(start code)
			UPDATE ".$TablasCore."informe SET formato_final='$formato_final', alto='$alto',ancho='$ancho',titulo='$titulo',descripcion='$descripcion',categoria='$categoria' WHERE id=$id
		(end)

	Salida:
		Registro de informe actualizado

	Ver tambien:

		<editar_informe> | <actualizar_grafico_informe> | <actualizar_agrupamiento_informe>
*/
if ($PCO_Accion=="actualizar_informe")
	{
		$mensaje_error="";
		if ($titulo=="") $mensaje_error.=$MULTILANG_InfErr2.'<br>';
		if ($categoria=="") $mensaje_error.=$MULTILANG_InfErr3.'<br>';
		if ($mensaje_error=="")
			{
				// Actualiza los datos 
				ejecutar_sql_unaria("UPDATE ".$TablasCore."informe SET formulario_filtrado=?, soporte_datatable=?, variables_filtro=?, genera_pdf=?, formato_final=?, alto=?,ancho=?,titulo=?,descripcion=?,categoria=? WHERE id=? ","$formulario_filtrado$_SeparadorCampos_$soporte_datatable$_SeparadorCampos_$variables_filtro$_SeparadorCampos_$genera_pdf$_SeparadorCampos_$formato_final$_SeparadorCampos_$alto$_SeparadorCampos_$ancho$_SeparadorCampos_$titulo$_SeparadorCampos_$descripcion$_SeparadorCampos_$categoria$_SeparadorCampos_$id");
				auditar("Actualiza informe $id");
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="editar_informe">
					<input type="Hidden" name="informe" value="'.$id.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				//echo '<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
			}
		else
			{
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="editar_informe">
					<input type="Hidden" name="informe" value="'.$id.'">
					<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
					<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: eliminar_informe_condicion
	Elimina una condicion de filtrado para un informe de la aplicacion

	Variables de entrada:

		id - ID de la condicion a eliminar

		(start code)
			DELETE FROM ".$TablasCore."informe_condiciones WHERE id='$condicion'
		(end)

	Salida:
		Registro de informe actualizado

	Ver tambien:

		<editar_informe> | <guardar_informe_condicion>
*/
if ($PCO_Accion=="eliminar_informe_condicion")
	{
		ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_condiciones WHERE id=? ","$condicion");
		@auditar("Elimina condicion $condicion");
		echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
			<input type="Hidden" name="PCO_Accion" value="editar_informe">
			<input type="Hidden" name="informe" value="'.$informe.'">
			<input type="Hidden" name="popup_activo" value="InformeCondiciones">
			</form>
				<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_informe_condicion
	Agrega una condicion de filtrado para un informe de la aplicacion

	Variables de entrada:

		id - ID de la condicion a eliminar

		(start code)
			SELECT MAX(peso) as peso FROM ".$TablasCore."informe_condiciones WHERE informe='$informe'
			INSERT INTO ".$TablasCore."informe_condiciones VALUES (0, '$informe','$valor_i','$valor_o','$valor_d','$peso')
		(end)

	Salida:
		Registro de informe actualizado

	Ver tambien:

		<editar_informe> | <eliminar_informe_condicion>
*/
	if ($PCO_Accion=="guardar_informe_condicion")
		{
			$mensaje_error="";
			$valor_i=$valor_izq.$valor_izq_manual.$operador_logico;
			$valor_d=$valor_der.$valor_der_manual;
			$valor_o=$operador.$operador_manual;
			if ($valor_i=="" && $valor_d=="") $mensaje_error=$MULTILANG_InfErrCondicion;
			if ($mensaje_error=="")
				{
					//Busca el peso del ultimo elemento para agregar el nuevo con peso+1
					$peso=1;
					$consulta_peso=ejecutar_sql("SELECT MAX(peso) as peso FROM ".$TablasCore."informe_condiciones WHERE informe=? ","$informe");
					$registro = $consulta_peso->fetch();
					if($registro[0]!="")$peso=$registro[0] + 1;
					//Agrega la condicion
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_condiciones (".$ListaCamposSinID_informe_condiciones.") VALUES (?,?,?,?,?)","$informe$_SeparadorCampos_$valor_i$_SeparadorCampos_$valor_o$_SeparadorCampos_$valor_d$_SeparadorCampos_$peso");
					auditar("Agrega condicion al informe $informe");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="PCO_Accion" value="editar_informe">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="popup_activo" value="InformeCondiciones">
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="editar_informe">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: eliminar_informe_campo
	Elimina un campo definido para un informe de la aplicacion

	Variables de entrada:

		id - ID del campo a eliminar

		(start code)
			DELETE FROM ".$TablasCore."informe_campos WHERE id='$campo'
		(end)

	Salida:
		Campo eliminado de la lista agregada al informe

	Ver tambien:

		<editar_informe>
*/
if ($PCO_Accion=="eliminar_informe_campo")
	{
		ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_campos WHERE id=? ","$campo");
		auditar("Elimina campo $campo del informe $informe");
		echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
			<input type="Hidden" name="PCO_Accion" value="editar_informe">
			<input type="Hidden" name="informe" value="'.$informe.'">
			<input type="Hidden" name="popup_activo" value="InformeCampos">
			</form>
		<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_informe_campo
	Agrega un campo definido para un informe de la aplicacion

	Variables de entrada:

		informe - ID del informe al que sera agregado el campo
		campo_datos - Nombre del campo, normalmente seleccionado de los disponibles
		campo_manual - Valor manual para un nombre de campo, puede ser usado tambien en funciones de agrupacion
		alias_manual - Valor de alias para el campo, usado en la impresion
		campo_definitivo - concatenacion resultante de campo_manual y campo_datos (interno, no ercibido)

		(start code)
			INSERT INTO ".$TablasCore."informe_campos VALUES (0, '$informe','$campo_definitivo','$alias_manual')
		(end)

	Salida:
		Campo agregado a la lista en el informe

	Ver tambien:

		<editar_informe> | <eliminar_informe_campo>
*/
	if ($PCO_Accion=="guardar_informe_campo")
		{
			$mensaje_error="";
			if ($campo_manual.$campo_datos=="") $mensaje_error=$MULTILANG_InfErrCampo;
			if ($mensaje_error=="")
				{
                    //Busca el maximo peso de los elementos actuales para asignar el peso del nuevo elemento
                    $registro_pesos=ejecutar_sql("SELECT MAX(peso) as pesomaximo FROM ".$TablasCore."informe_campos WHERE informe=$informe")->fetch();
                    $peso=$registro_pesos["pesomaximo"]+1;
					$campo_definitivo=$campo_manual.$campo_datos;
                    //Agrega el nuevo campo
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_campos (".$ListaCamposSinID_informe_campos.") VALUES (?,?,?,?,1,0)","$informe$_SeparadorCampos_$campo_definitivo$_SeparadorCampos_$alias_manual$_SeparadorCampos_$peso");
					auditar("Agrega campo $campo_definitivo al informe $informe");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="PCO_Accion" value="editar_informe">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="popup_activo" value="InformeCampos">
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="editar_informe">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: eliminar_informe_tabla
	Elimina una tabla de datos definida para un informe de la aplicacion

	Variables de entrada:

		tabla - ID de la tabla que debe ser eliminada

		(start code)
			DELETE FROM ".$TablasCore."informe_tablas WHERE id='$tabla'
		(end)

	Salida:
		Tabla eliminada del informe

	Ver tambien:

		<editar_informe> | <eliminar_informe_campo>
*/
if ($PCO_Accion=="eliminar_informe_tabla")
	{
		ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_tablas WHERE id=? ","$tabla");
		auditar("Elimina tabla $tabla del informe $informe");
		echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
			<input type="Hidden" name="PCO_Accion" value="editar_informe">
			<input type="Hidden" name="informe" value="'.$informe.'">
			<input type="Hidden" name="popup_activo" value="InformeTablas">
			</form>
		<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_informe_tabla
	Agrega una tabla de datos para un informe de la aplicacion

	Variables de entrada:

		informe - ID del informe al que sera agregada la tabla
		tabla_datos - Nombre de la tabla, normalmente seleccionada de las disponibles
		tabla_manual - Valor manual para un nombre de tabla
		alias_manual - Valor de alias para la tabla
		tabla_definitiva - concatenacion resultante de campo_manual y campo_datos (interno, no ercibido)

		(start code)
			INSERT INTO ".$TablasCore."informe_tablas VALUES (0, '$informe','$tabla_definitiva','$alias_manual')
		(end)

	Salida:
		Tabla agregada al informe

	Ver tambien:

		<editar_informe>
*/
	if ($PCO_Accion=="guardar_informe_tabla")
		{
			$mensaje_error="";
			if ($tabla_manual.$tabla_datos=="") $mensaje_error=$MULTILANG_InfErrTabla;
			if ($mensaje_error=="")
				{
					$tabla_definitiva=$tabla_manual.$tabla_datos;
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_tablas (".$ListaCamposSinID_informe_tablas.") VALUES (?,?,?)","$informe$_SeparadorCampos_$tabla_definitiva$_SeparadorCampos_$alias_manual");
					auditar("Agrega tabla $tabla_definitiva al informe $informe");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="PCO_Accion" value="editar_informe">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="popup_activo" value="InformeTablas">
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="editar_informe">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_accion_informe
	Agrega un boton con una accion determinada para un registro desplegado por un informe tabular

	Variables de entrada:

		multiples - Recibidas mediante formulario unico asociado al proceso de creacion del elemento.

	(start code)
		INSERT INTO ".$TablasCore."formulario_boton VALUES (0, '$titulo','$estilo','$formulario','$tipo_accion','$accion_usuario','$visible','$peso','$retorno_titulo','$retorno_texto','$confirmacion_texto')
	(end)

	Salida:
		Registro agregado y formulario actualizado en pantalla

	Ver tambien:
		<eliminar_accion_informe>
*/
	if ($PCO_Accion=="guardar_accion_informe")
		{
			$mensaje_error="";
			if ($titulo=="") $mensaje_error=$MULTILANG_InfErr4;
			if ($tipo_accion=="") $mensaje_error=$MULTILANG_InfErr5;
			if ($mensaje_error=="")
				{
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_boton (".$ListaCamposSinID_informe_boton.") VALUES (?,?,?,?,?,?,?,?,?,?,?)","$titulo$_SeparadorCampos_$estilo$_SeparadorCampos_$informe$_SeparadorCampos_$tipo_accion$_SeparadorCampos_$accion_usuario$_SeparadorCampos_$visible$_SeparadorCampos_$peso$_SeparadorCampos_$confirmacion_texto$_SeparadorCampos_$destino$_SeparadorCampos_$pantalla_completa$_SeparadorCampos_$precargar_estilos");
					auditar("Crea boton $titulo para informe $informe");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="PCO_Accion" value="editar_informe">
						<input type="Hidden" name="informe" value="'.$informe.'">
						<input type="Hidden" name="popup_activo" value="FormularioBotones">
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="editar_informe">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						<input type="Hidden" name="informe" value="'.$informe.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: eliminar_registro_informe
	Elimina los registros coincidentes con los datos de un boton de accion sobre un informe tabular

	Variables de entrada:

		tabla - nombre de la tabla sobre la que se hace la operacion
		campo - nombre del campo que debe ser usado para filtrar
		valor - valor a comparar sobre el campo y que es usado para determinar que registro eliminar

	(start code)
		DELETE FROM ".$tabla." WHERE $campo='$valor'
	(end)

	Salida:
		Registro eliminado de la tabla de aplicacion

*/
	if ($PCO_Accion=="eliminar_registro_informe")
		{
			ejecutar_sql_unaria("DELETE FROM ".$tabla." WHERE $campo='$valor'");
			auditar("Elimina registro donde $campo = $valor en $tabla");
			echo '<script language="JavaScript"> document.core_ver_menu.submit();  </script>';
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: editar_informe
	Actualiza la informacion asociada a un informe mediante dos ventanas.  En una se cargan los datos basicos y que pueden ser actualizados directamente.  En otra se cargan accesos a ventanas emergentes que permiten cambiar otros parámetros mas especificos.

	Salida:
		Ventanas con los campos y enlaces requeridos para la edicion

*/
if ($PCO_Accion=="editar_informe")
	{
		// Busca datos del informe
		$resultado_informe=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe." FROM ".$TablasCore."informe WHERE id=? ","$informe");
		$registro_informe = $resultado_informe->fetch();
  ?>

            <!-- Modal Tablas del informe -->
            <?php abrir_dialogo_modal("myModalTablaInforme",$MULTILANG_InfAgregaTabla); ?>

				<form name="datosform" id="datosform" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
                    <input type="Hidden" name="PCO_Accion" value="guardar_informe_tabla">
                    <input type="Hidden" name="informe" value="<?php echo $informe; ?>">

                    <label for="tabla_datos"><?php echo $MULTILANG_TablaDatos; ?>:</label>
                    <div class="form-group input-group">
                        <select id="tabla_datos" name="tabla_datos" class="form-control" >
                            <option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
                             <?php
                                    $resultado=consultar_tablas();
                                    while ($registro = $resultado->fetch())
                                        {
                                            // Imprime solamente las tablas de aplicacion, es decir, las que no cumplen prefijo de internas de Practico
                                            if (strpos($registro[0],$TablasCore)===FALSE)  // Booleana requiere === o !==
                                                echo '<option value="'.$registro[0].'" >'.str_replace($TablasApp,'',$registro[0]).'</option>';
                                        }
                            ?>
                        </select>
                        <span class="input-group-addon">
                            <a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                        </span>
                    </div>

                    <div class="form-group input-group">
                        <input name="tabla_manual" type="text" class="form-control" placeholder="<?php echo $MULTILANG_InfTablaManual; ?>">
                        <span class="input-group-addon">
                            (<?php echo $MULTILANG_Opcional; ?>)
                        </span>
                        <span class="input-group-addon">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_InfDesTablaManual; ?>"><i class="fa fa-question-circle fa-fw "></i></a>
                        </span>
                    </div>

                    <div class="form-group input-group">
                        <input name="alias_manual" type="text" class="form-control" placeholder="<?php echo $MULTILANG_InfAliasManual; ?>">
                        <span class="input-group-addon">
                            (<?php echo $MULTILANG_Opcional; ?>)
                        </span>
                        <span class="input-group-addon">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_InfDesAliasManual; ?>"><i class="fa fa-question-circle fa-fw "></i></a>
                        </span>
                    </div>
                    
                </form>
            <a class="btn btn-success btn-block" href="javascript:document.datosform.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_InfBtnAgregaTabla; ?></a>


				<h4><?php echo $MULTILANG_InfTablasDef; ?>:</h4>
				<table class="table table-condensed btn-xs table-unbordered table-hover">
					<thead>
                    <tr>
						<td><b><?php echo $MULTILANG_Tablas; ?></b></td>
						<td><b><?php echo $MULTILANG_InfAlias; ?></b></td>
						<td></td>
					</tr>
                    </thead>
                    <tbody>
				 <?php

						$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_tablas." FROM ".$TablasCore."informe_tablas WHERE informe=? ORDER BY valor_tabla","$informe");
						while($registro = $consulta_forms->fetch())
							{
								echo '<tr>
										<td><b>'.$registro["valor_tabla"].'</b></td>
										<td>'.$registro["valor_alias"].'</td>
										<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" name="df'.$registro["id"].'" id="df'.$registro["id"].'">
														<input type="hidden" name="PCO_Accion" value="eliminar_informe_tabla">
														<input type="hidden" name="tabla" value="'.$registro["id"].'">
														<input type="hidden" name="informe" value="'.$informe.'">
                                                        <a class="btn btn-danger btn-xs" href="javascript:confirmar_evento(\''.$MULTILANG_InfAdvBorrado.'\',df'.$registro["id"].');"><i class="fa fa-times"></i> '.$MULTILANG_Eliminar.'</a>
												</form>
										</td>
									</tr>';
							}
						echo '</tbody>
                        </table>';
				?>

        <?php 
            $barra_herramientas_modal='
                <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
            cerrar_dialogo_modal($barra_herramientas_modal);
        ?>




            <!-- Modal Campos del informe -->
            <?php abrir_dialogo_modal("myModalCamposInforme",$MULTILANG_InfAgregaCampo); ?>

				<form name="datosformc" id="datosformc" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
                    <input type="Hidden" name="PCO_Accion" value="guardar_informe_campo">
                    <input type="Hidden" name="informe" value="<?php echo $informe; ?>">


                    <label for="campo_datos"><?php echo $MULTILANG_InfCampoDatos; ?>:</label>
                    <div class="form-group input-group">
                        <select id="campo_datos" name="campo_datos" class="form-control" >
									<option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
									<?php
											$resultado=ejecutar_sql("SELECT valor_tabla FROM ".$TablasCore."informe_tablas WHERE informe=? ","$informe");
											//$resultado=consultar_tablas(); //Presenta todas las tablas
											while ($registro = $resultado->fetch())
												{
													// Imprime solamente las tablas de aplicacion, es decir, las que no cumplen prefijo de internas de Practico
													if (strpos($registro[0],$TablasCore)===FALSE)  // Booleana requiere === o !==
														{
															echo '<optgroup label="'.str_replace($TablasApp,'',$registro[0]).'" >';
															$nombre_tabla=$registro[0];
															//Busca los campos de la tabla
															$resultadocampos=consultar_columnas($registro[0]);
															for($i=0;$i<count($resultadocampos);$i++)
																echo '<option value="'.$nombre_tabla.'.'.$resultadocampos[$i]["nombre"].'">'.$resultadocampos[$i]["nombre"].'</option>';
															echo '</optgroup>';
														}
												}
									?>
                        </select>
                        <span class="input-group-addon">
                            <a href="#" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange"></i></a>
                        </span>
                    </div>

                    <div class="form-group input-group">
                        <input name="campo_manual" type="text" class="form-control" placeholder="<?php echo $MULTILANG_InfCampoManual; ?>">
                        <span class="input-group-addon">
                            (<?php echo $MULTILANG_Opcional; ?>)
                        </span>
                        <span class="input-group-addon">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_InfDesCampoManual; ?>"><i class="fa fa-question-circle fa-fw "></i></a>
                        </span>
                    </div>

                    <div class="form-group input-group">
                        <input name="alias_manual" type="text" class="form-control" placeholder="<?php echo $MULTILANG_InfAliasManual; ?>">
                        <span class="input-group-addon">
                            (<?php echo $MULTILANG_Opcional; ?>)
                        </span>
                        <span class="input-group-addon">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_InfDesAliasManual2; ?>"><i class="fa fa-question-circle fa-fw "></i></a>
                        </span>
                    </div>
                </form>
            <a class="btn btn-success btn-block" href="javascript:document.datosformc.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_InfBtnAgregaCampo; ?></a>
					

				<hr><h4><?php echo $MULTILANG_InfCamposDef; ?>:</h4>
				<table class="table table-condensed btn-xs table-unbordered table-hover">
					<thead>
                        <tr>
                            <td><b><?php echo $MULTILANG_Campo; ?></b></td>
                            <td><b><?php echo $MULTILANG_InfAlias; ?></b></td>
                            <td><b><?php echo $MULTILANG_Peso; ?></b></td>
                            <td><b><?php echo $MULTILANG_FrmVisible; ?></b></td>
                            <td><b><?php echo $MULTILANG_InfEditableLinea; ?></b></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
				 <?php

						$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_campos." FROM ".$TablasCore."informe_campos WHERE informe=? ORDER BY peso","$informe");
						while($registro = $consulta_forms->fetch())
							{
								$peso_aumentado=$registro["peso"]+1;
								if ($registro["peso"]-1>=1) $peso_disminuido=$registro["peso"]-1; else $peso_disminuido=1;
								echo '<tr>
										<td><b>'.$registro["valor_campo"].'</b></td>
										<td>'.$registro["valor_alias"].'</td>
										<td nowrap>
											<form action="'.$ArchivoCORE.'" method="POST" name="caifoce'.$registro["id"].'" id="caifoce'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
												<input type="hidden" name="PCO_Accion" value="cambiar_estado_campo">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="hidden" name="tabla" value="informe_campos">
												<input type="hidden" name="campo" value="peso">
												<input type="hidden" name="informe" value="'.$informe.'">
												<input type="hidden" name="nombre_tabla" value="'.@$nombre_tabla.'">
												<input type="hidden" name="accion_retorno" value="editar_informe">
												<input type="hidden" name="valor" value="'.$peso_aumentado.'">
												<input type="Hidden" name="popup_activo" value="InformeCampos">
											</form>
											<form action="'.$ArchivoCORE.'" method="POST" name="caifopa'.$registro["id"].'" id="caifopa'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
												<input type="hidden" name="PCO_Accion" value="cambiar_estado_campo">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="hidden" name="tabla" value="informe_campos">
												<input type="hidden" name="campo" value="peso">
												<input type="hidden" name="informe" value="'.$informe.'">
												<input type="hidden" name="nombre_tabla" value="'.@$nombre_tabla.'">
												<input type="hidden" name="accion_retorno" value="editar_informe">
												<input type="hidden" name="valor" value="'.$peso_disminuido.'">
												<input type="Hidden" name="popup_activo" value="InformeCampos">
											</form>';
										if (@$registro["campo"]!="id")
											echo '
												<a href="javascript:caifoce'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmAumentaPeso.'" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="auto" ><i class="fa fa-caret-down"></i></a> 
												'.$registro["peso"].'
												<a href="javascript:caifopa'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmDisminuyePeso.'" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="auto" ><i class="fa fa-caret-up"></i></a>
												';
								echo '		
										</td>';
										
								echo '<td align=center>
											<form action="'.$ArchivoCORE.'" method="POST" name="caifv'.$registro["id"].'" id="caifv'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
												<input type="hidden" name="PCO_Accion" value="cambiar_estado_campo">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="hidden" name="tabla" value="informe_campos">
												<input type="hidden" name="campo" value="visible">
												<input type="hidden" name="informe" value="'.$informe.'">
												<input type="hidden" name="nombre_tabla" value="'.@$nombre_tabla.'">
												<input type="hidden" name="accion_retorno" value="editar_informe">
												<input type="Hidden" name="popup_activo" value="InformeCampos">
											';
									if ($registro["visible"])
										echo '<input type="hidden" name="valor" value="0"><a href="javascript:caifv'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'" class="btn btn-warning btn-xs"><i class="fa fa-lightbulb-o"></i></a>';
									else
										echo '<input type="hidden" name="valor" value="1"><a href="javascript:caifv'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'" class="btn btn-default btn-xs"><i class="fa fa-lightbulb-o"></i></a>';
								echo '</form></td>';

								echo '<td align=center>
											<form action="'.$ArchivoCORE.'" method="POST" name="caife'.$registro["id"].'" id="caife'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
												<input type="hidden" name="PCO_Accion" value="cambiar_estado_campo">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="hidden" name="tabla" value="informe_campos">
												<input type="hidden" name="campo" value="editable">
												<input type="hidden" name="informe" value="'.$informe.'">
												<input type="hidden" name="nombre_tabla" value="'.@$nombre_tabla.'">
												<input type="hidden" name="accion_retorno" value="editar_informe">
												<input type="Hidden" name="popup_activo" value="InformeCampos">
											';
									if ($registro["editable"])
										echo '<input type="hidden" name="valor" value="0"><a href="javascript:caife'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>';
									else
										echo '<input type="hidden" name="valor" value="1"><a href="javascript:caife'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>';
								echo '</form></td>';

								echo '		<td>
												<form action="'.$ArchivoCORE.'" method="POST" name="cadfc'.$registro["id"].'" id="cadfc'.$registro["id"].'">
														<input type="hidden" name="PCO_Accion" value="eliminar_informe_campo">
														<input type="hidden" name="campo" value="'.$registro["id"].'">
														<input type="hidden" name="informe" value="'.$informe.'">
                                                        <a class="btn btn-danger btn-xs" href="javascript:confirmar_evento(\''.$MULTILANG_InfAdvBorrado.'\',cadfc'.$registro["id"].');"><i class="fa fa-times"></i> '.$MULTILANG_Eliminar.'</a>
												</form>
										</td>
									</tr>';
							}
						echo '
                        </tbody>
                        </table>';
				?>
        <?php 
            $barra_herramientas_modal='
                <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
            cerrar_dialogo_modal($barra_herramientas_modal);
        ?>


            <!-- Modal Condiciones del informe -->
            <?php abrir_dialogo_modal("myModalCondicionesInforme",$MULTILANG_InfAddCondicion,"modal-wide"); ?>

				<form name="datosformco" id="datosformco" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
					<input type="Hidden" name="PCO_Accion" value="guardar_informe_condicion">
					<input type="Hidden" name="informe" value="<?php echo $informe; ?>">

                    <div class="row">
                      <div class="col-md-4">
                            <div class="form-group input-group">
                                <select id="valor_izq" name="valor_izq" class="form-control" >
                                            <option value=""><?php echo $MULTILANG_Vacio; ?></option>
                                            <?php
                                                $consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_campos." FROM ".$TablasCore."informe_campos WHERE informe=? ","$informe");
                                                while($registro = $consulta_forms->fetch())
                                                    {
                                                        echo '<option value="'.$registro["valor_campo"].'">'.$registro["valor_campo"].'</option>';
                                                    }
                                            ?>
                                </select>
                                <span class="input-group-addon">
                                    <a href="#" title="<?php echo $MULTILANG_InfPrimer; ?>"><i class="fa fa-question-circle  fa-fw icon-info"></i></a>
                                </span>
                            </div>
                      </div>    
                      <div class="col-md-4">
                            <div class="form-group input-group">
                                <select id="operador" name="operador" class="form-control" >
                                            <option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
                                            <option value="="><?php echo $MULTILANG_InfIgualA; ?>: = </option>
                                            <option value="<>"><?php echo $MULTILANG_InfDiferenteDe; ?>: <> </option>
                                            <option value=">"><?php echo $MULTILANG_InfMayorQue; ?>: > </option>
                                            <option value="<"><?php echo $MULTILANG_InfMenorQue; ?>: < </option>
                                            <option value=">="><?php echo $MULTILANG_InfMayorIgualQue; ?>: >= </option>
                                            <option value="<="><?php echo $MULTILANG_InfMenorIgualQue; ?>: <= </option>
                                            <option value="LIKE"><?php echo $MULTILANG_InfPatron; ?></option>
                                </select>
                                <span class="input-group-addon">
                                    <a href="#" title="<?php echo $MULTILANG_InfOperador; ?>"><i class="fa fa-question-circle  fa-fw icon-info"></i></a>
                                </span>
                            </div>
                      </div>
                      <div class="col-md-4">
                            <div class="form-group input-group">
                                <select id="valor_der" name="valor_der" class="form-control" >
                                            <option value=""><?php echo $MULTILANG_Vacio; ?></option>
                                            <?php
                                                $consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_campos." FROM ".$TablasCore."informe_campos WHERE informe=? ","$informe");
                                                while($registro = $consulta_forms->fetch())
                                                    {
                                                        echo '<option value="'.$registro["valor_campo"].'">'.$registro["valor_campo"].'</option>';
                                                    }
                                            ?>
                                </select>
                                <span class="input-group-addon">
                                    <a href="#" title="<?php echo $MULTILANG_InfSegundo; ?>"><i class="fa fa-question-circle  fa-fw icon-info"></i></a>
                                </span>
                            </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4">
                                                    
                                <div class="form-group input-group">
                                    <input name="valor_izq_manual" type="text" class="form-control" placeholder="<?php echo $MULTILANG_InfCampoManual; ?>">
                                </div>
                      </div>    
                      <div class="col-md-4">
                                <div class="form-group input-group">
                                    <input name="operador_manual" type="text" class="form-control" placeholder="<?php echo $MULTILANG_InfCampoManual; ?>">
                                </div>
                      </div>
                      <div class="col-md-4">
                                <div class="form-group input-group">
                                    <input name="valor_der_manual" type="text" class="form-control" placeholder="<?php echo $MULTILANG_InfCampoManual; ?>">
                                    <span class="input-group-addon">
                                        <a href="#" title="<?php echo $MULTILANG_InfDesManual; ?>"><i class="fa fa-question-circle  fa-fw icon-info"></i></a>
                                    </span>
                                </div>
                      </div>
                    </div>


                    <div class="form-group input-group form-inline">
                        <span class="input-group-addon">
                            <?php echo $MULTILANG_InfOperador; ?>
                        </span>
                        <select id="operador_logico" name="operador_logico" class="form-control" >
                            <option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
                            <option value="("><?php echo $MULTILANG_InfOpParentesisA; ?> - (</option>
                            <option value=")"><?php echo $MULTILANG_InfOpParentesisC; ?> - )</option>
                            <option value="AND"><?php echo $MULTILANG_InfOpAND; ?> - AND</option>
                            <option value="OR"><?php echo $MULTILANG_InfOpOR; ?> - OR</option>
                            <option value="NOT"><?php echo $MULTILANG_InfOpNOT; ?> - NOT</option>
                            <option value="XOR"><?php echo $MULTILANG_InfOpXOR; ?> - XOR</option>
                        </select>
                        <span class="input-group-addon">
                            <a href="#" title="<?php echo $MULTILANG_InfTitOp; ?>: <?php echo $MULTILANG_InfDesOp; ?>"><i class="fa fa-question-circle  fa-fw icon-info"></i></a>
                        </span>
                    </div>
                    <b><?php echo $MULTILANG_InfReco1; ?>:</b> <?php echo $MULTILANG_InfReco2; ?>

                </form>
                <br><br>
                <a class="btn btn-success btn-block" href="javascript:document.datosformco.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_InfBtnAddCondic; ?></a>


				<hr><b><?php echo $MULTILANG_InfDefCond; ?></b>
				<table class="table table-condensed btn-xs table-unbordered table-hover">
				 <?php

						$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_condiciones." FROM ".$TablasCore."informe_condiciones WHERE informe=? ORDER BY peso","$informe");
						while($registro = $consulta_forms->fetch())
							{
								$peso_aumentado=$registro["peso"]+1;
								if ($registro["peso"]-1>=1) $peso_disminuido=$registro["peso"]-1; else $peso_disminuido=1;
								echo '<tr>
										<td>'.$registro["valor_izq"].'</td>
										<td><b>'.$registro["operador"].'</b></td>
										<td>'.$registro["valor_der"].'</td>
										<td>
											<form action="'.$ArchivoCORE.'" method="POST" name="ifoce'.$registro["id"].'" id="ifoce'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
												<input type="hidden" name="PCO_Accion" value="cambiar_estado_campo">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="hidden" name="tabla" value="informe_condiciones">
												<input type="hidden" name="campo" value="peso">
												<input type="hidden" name="informe" value="'.$informe.'">
												<input type="hidden" name="nombre_tabla" value="'.@$nombre_tabla.'">
												<input type="hidden" name="accion_retorno" value="editar_informe">
												<input type="hidden" name="valor" value="'.$peso_aumentado.'">
												<input type="Hidden" name="popup_activo" value="InformeCondiciones">
											</form>
											<form action="'.$ArchivoCORE.'" method="POST" name="ifopa'.$registro["id"].'" id="ifopa'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
												<input type="hidden" name="PCO_Accion" value="cambiar_estado_campo">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="hidden" name="tabla" value="informe_condiciones">
												<input type="hidden" name="campo" value="peso">
												<input type="hidden" name="informe" value="'.$informe.'">
												<input type="hidden" name="nombre_tabla" value="'.@$nombre_tabla.'">
												<input type="hidden" name="accion_retorno" value="editar_informe">
												<input type="hidden" name="valor" value="'.$peso_disminuido.'">
												<input type="Hidden" name="popup_activo" value="InformeCondiciones">
											</form>';
										if (@$registro["campo"]!="id")
											echo '
												<a href="javascript:ifoce'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmAumentaPeso.'" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="auto" ><i class="fa fa-caret-down"></i></a> 
												'.$registro["peso"].'
												<a href="javascript:ifopa'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmDisminuyePeso.'" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="auto" ><i class="fa fa-caret-up"></i></a>
												';
								echo '		
										</td>
										<td>
												<form action="'.$ArchivoCORE.'" method="POST" name="dfco'.$registro["id"].'" id="dfco'.$registro["id"].'">
														<input type="hidden" name="PCO_Accion" value="eliminar_informe_condicion">
														<input type="hidden" name="condicion" value="'.$registro["id"].'">
														<input type="hidden" name="informe" value="'.$informe.'">
                                                        <a href="javascript:confirmar_evento(\''.$MULTILANG_InfAdvBorrado.'\',dfco'.$registro["id"].');" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="auto" title="'.$MULTILANG_Eliminar.'"><i class="fa fa-times"></i></a>
												</form>
										</td>
									</tr>';
							}
						echo '</table>';
                ?>
                <?php 
                    $barra_herramientas_modal='
                        <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
                    cerrar_dialogo_modal($barra_herramientas_modal);
                ?>



            <!-- Modal Graficos del informe -->
            <?php abrir_dialogo_modal("myModalGraficosInforme",$MULTILANG_InfTitGrafico,"modal-wide"); ?>

				<form name="datosformcograf" id="datosformcograf" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
					<input type="Hidden" name="PCO_Accion" value="actualizar_grafico_informe">
					<input type="Hidden" name="informe" value="<?php echo $informe; ?>">

				<!-- SELECCION DE SERIES  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
				<hr>
				<div align=center><b><?php echo $MULTILANG_InfSeriesGrafico1; ?></b> - <?php echo $MULTILANG_InfSeriesGrafico2; ?></div>
						<table class="TextosVentana" width="100%">
						<?php
							//Consulta el formato de grafico y datos de series para ponerlo en los campos
							//Dado por: Tipo|Nombre1!NombreN|Etiqueta1!EtiquetaN|Valor1!ValorN|
							$consulta_formato_grafico=ejecutar_sql("SELECT formato_grafico FROM ".$TablasCore."informe WHERE id=? ","$informe");
							$registro_formato = $consulta_formato_grafico->fetch();
							$formato_base=explode("|",$registro_formato["formato_grafico"]);
							$tipo_grafico_leido=$formato_base[0];
							$lista_nombre_series=@explode("!",$formato_base[1]);
							$lista_etiqueta_series=@explode("!",$formato_base[2]);
							$lista_valor_series=@explode("!",$formato_base[3]);

							//Crea las series
							$numero_series=5;
							for ($cs=1;$cs<=$numero_series;$cs++)
								{
						?>
							<tr>
								<td align="center" valign="TOP">
									<b><?php echo $MULTILANG_InfNomSerie?> <?php echo $cs; ?></b><br>
									<input type="text" name="nombre_serie_<?php echo $cs; ?>" value="<?php echo @$lista_nombre_series[$cs-1]; ?>" maxlength="20" size="20" class="CampoTexto">
								</td>
								<td align="center" valign="TOP">
									<b><?php echo $MULTILANG_InfCampoEtiqSerie; ?></b><br>
									<select name="campo_etiqueta_serie_<?php echo $cs; ?>" class="Combos" >
										<option value=""></option>
										<?php
										$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_campos." FROM ".$TablasCore."informe_campos WHERE informe=? ","$informe");
										while($registro = $consulta_forms->fetch())
											{
												$estado_seleccionado="";
												$cadena_alias="";
												if ($lista_etiqueta_series[$cs-1]==$registro["valor_campo"] || $lista_etiqueta_series[$cs-1]==$registro["valor_campo"]." AS ".$registro["valor_alias"]) $estado_seleccionado="SELECTED";
												if ($registro["valor_alias"]!="") $cadena_alias=" AS ".$registro["valor_alias"];
												echo '<option value="'.$registro["valor_campo"].$cadena_alias.'" '.$estado_seleccionado.'>'.$registro["valor_campo"].$cadena_alias.'</option>';
											}
									?>
									</select>
								</td>
								<td align="center" valign="TOP">
									<b><?php echo $MULTILANG_InfCampoValor; ?></b><br>
									<select name="campo_valor_serie_<?php echo $cs; ?>" class="Combos">
										<option value=""></option>
									<?php
										$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_campos." FROM ".$TablasCore."informe_campos WHERE informe=? ","$informe");
										while($registro = $consulta_forms->fetch())
											{
												$estado_seleccionado="";
												$cadena_alias="";
												if ($lista_valor_series[$cs-1]==$registro["valor_campo"] || $lista_valor_series[$cs-1]==$registro["valor_campo"]." AS ".$registro["valor_alias"]) $estado_seleccionado="SELECTED";
												if ($registro["valor_alias"]!="") $cadena_alias=" AS ".$registro["valor_alias"];
												echo '<option value="'.$registro["valor_campo"].$cadena_alias.'" '.$estado_seleccionado.'>'.$registro["valor_campo"].$cadena_alias.'</option>';
											}
									?>
									</select>
								</td>
							</tr>
							
						<?php
							} // Fin del for que crea series
						?>
						</table>

			<!-- SELECCION DEL TIPO DE GRAFICO  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
				<hr>
						<div align=center><b><?php echo $MULTILANG_InfVistaGrafico1; ?></b> - <?php echo $MULTILANG_InfVistaGrafico2; ?></div>
						<table class="TextosVentana">
							<tr>
								<td align="LEFT" valign="TOP">
									<b><?php echo $MULTILANG_InfTipoGrafico; ?>:</b><br>
									<select name="tipo_grafico" class="Combos" >
											<option value="barrah" <?php if ($tipo_grafico_leido=="barrah") echo "SELECTED"; ?>><?php echo $MULTILANG_InfGrafico1; ?></option>
											<option value="barrah_multiples" <?php if ($tipo_grafico_leido=="barrah_multiples") echo "SELECTED"; ?>><?php echo $MULTILANG_InfGrafico2; ?></option>
											<option value="linea" <?php if ($tipo_grafico_leido=="linea") echo "SELECTED"; ?>><?php echo $MULTILANG_InfGrafico3; ?></option>
											<option value="linea_multiples" <?php if ($tipo_grafico_leido=="linea_multiples") echo "SELECTED"; ?>><?php echo $MULTILANG_InfGrafico4; ?></option>
											<option value="barrav" <?php if ($tipo_grafico_leido=="barrav") echo "SELECTED"; ?>><?php echo $MULTILANG_InfGrafico5; ?></option>
											<option value="barrav_multiples" <?php if ($tipo_grafico_leido=="barrav_multiples") echo "SELECTED"; ?>><?php echo $MULTILANG_InfGrafico6; ?></option>
											<option value="torta" <?php if ($tipo_grafico_leido=="torta") echo "SELECTED"; ?>><?php echo $MULTILANG_InfGrafico7; ?></option>
									</select>
								</td>
								<td align="RIGHT">
									<img src="img/tipos_grafico.png" border=0 alt="">
								</td>
							</tr>
						</table>
				</form>
				<hr><center>
				<input type="Button"  class="Botones" value="<?php echo $MULTILANG_InfActGraf; ?> >>>" onClick="document.datosformcograf.submit()">
				<br><br><br>
				</center>

                <?php 
                    $barra_herramientas_modal='
                        <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
                    cerrar_dialogo_modal($barra_herramientas_modal);
                ?>



            <!-- Modal Agrupacion y ordenamiento del informe -->
            <?php abrir_dialogo_modal("myModalAgrupacionInforme",$MULTILANG_InfAgrupa); ?>

                        <?php
                        $consulta_agrupacion=ejecutar_sql("SELECT ordenamiento,agrupamiento FROM ".$TablasCore."informe WHERE id=? ","$informe");
                        $registro_agrupacion = $consulta_agrupacion->fetch();
                        ?>
                        <form name="datosformcogrup" id="datosformcogrup" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
                            <input type="Hidden" name="PCO_Accion" value="actualizar_agrupamiento_informe">
                            <input type="Hidden" name="informe" value="<?php echo $informe; ?>">

                                <div class="form-group input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                    <input name="agrupamiento" type="text" value="<?php echo $registro_agrupacion["agrupamiento"]; ?>" class="form-control" placeholder="<?php echo $MULTILANG_InfCriterioAgrupa; ?>">
                                    <span class="input-group-addon">
                                        <a href="#" title="<?php echo $MULTILANG_InfTitAgrupa; ?>: <?php echo $MULTILANG_InfDesAgrupa; ?>"><i class="fa fa-question-circle  fa-fw icon-info"></i></a>
                                    </span>
                                </div>
                                <b><?php echo $MULTILANG_InfReco1; ?>:</b> <?php echo $MULTILANG_InfReco3; ?>

                                <div class="form-group input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-sort-alpha-asc"></i>
                                    </span>
                                    <input name="ordenamiento" type="text" value="<?php echo $registro_agrupacion["ordenamiento"]; ?>" class="form-control" placeholder="<?php echo $MULTILANG_InfCriterioOrdena; ?>">
                                    <span class="input-group-addon">
                                        <a href="#" title="<?php echo $MULTILANG_InfTitOrdena; ?>: <?php echo $MULTILANG_InfDesOrdena; ?>"><i class="fa fa-question-circle  fa-fw icon-info"></i></a>
                                    </span>
                                </div>
                                <b><?php echo $MULTILANG_InfReco1; ?>:</b> <?php echo $MULTILANG_InfReco3; ?>
                        </form>
                        <br><br>
                        <a class="btn btn-success btn-block" href="javascript:document.datosformcogrup.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_InfActCriterios; ?></a>
                <?php 
                    $barra_herramientas_modal='
                        <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
                    cerrar_dialogo_modal($barra_herramientas_modal);
                ?>



            <!-- Modal Agregar acciones del informe -->
            <?php abrir_dialogo_modal("myModalAgregaAccionesInforme",$MULTILANG_InfTitBotones,"modal-wide"); ?>

				<form name="datosfield" id="datosfield" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="PCO_Accion" value="guardar_accion_informe">
				<input type="Hidden" name="informe" value="<?php echo $informe; ?>">

				<script language="JavaScript">
					function ActualizarTexto_boton_vista_previa(texto_nuevo)
						{
							//Asigna la etiqueta
							$('#boton_vista_previa').text(texto_nuevo);
						}
						
					function ActualizarEstilo_boton_vista_previa()
						{
							//Remueve estilos actuales
							$("#boton_vista_previa").removeClass();
							//Aplica los estilos segun el campo
							$( "#boton_vista_previa" ).addClass(document.datosfield.estilo.value);
						}
					
					function Actualizar_boton_vista_previa(texto_nuevo)
						{
							//Actualiza el campo de estilos
							document.datosfield.estilo.value=document.datosfield.estilo0.value+document.datosfield.estilo1.value;
							//Aplica el estilo
							ActualizarEstilo_boton_vista_previa();
						}
				</script>


		<div class="row">
			<div class="col col-md-6">

                    <div class="form-group input-group">
                        <input name="titulo" type="text" class="form-control" placeholder="<?php echo $MULTILANG_FrmTitulo; ?>" OnInput="ActualizarTexto_boton_vista_previa(this.value);">
                        <span class="input-group-addon">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
                            <a href="#" title="<?php echo $MULTILANG_Ayuda; ?>: <?php echo $MULTILANG_FrmDesBot; ?>"><i class="fa fa-question-circle  fa-fw icon-info"></i></a>
                        </span>
                    </div>

					<div class="row">
						<div class="col col-md-5">
							<label for="estilo0"><?php echo $MULTILANG_FrmEstilo; ?>:</label>
							<div class="form-group input-group">
								<select id="estilo0" name="estilo0" class="form-control input-sm" OnChange="Actualizar_boton_vista_previa();">
									<option value=""><?php echo $MULTILANG_Ninguno; ?></option>
									<option value=" btn "><?php echo $MULTILANG_BtnEstiloSimple; ?></option>
									<option value=" btn btn-default "><?php echo $MULTILANG_BtnEstiloPredeterminado; ?></option>
									<option value=" btn btn-primary "><?php echo $MULTILANG_BtnEstiloPrimario; ?></option>
									<option value=" btn btn-success "><?php echo $MULTILANG_BtnEstiloFinalizado; ?></option>
									<option value=" btn btn-info "><?php echo $MULTILANG_BtnEstiloInformacion; ?></option>
									<option value=" btn btn-warning "><?php echo $MULTILANG_BtnEstiloAdvertencia; ?></option>
									<option value=" btn btn-danger "><?php echo $MULTILANG_BtnEstiloPeligro; ?></option>
								</select>
							</div>

							<label for="estilo1"><?php echo $MULTILANG_Tamano; ?>:</label>
							<div class="form-group input-group">
								<select id="estilo1" name="estilo1" class="form-control input-sm" OnChange="Actualizar_boton_vista_previa();">
									<option value=""><?php echo $MULTILANG_Predeterminado; ?></option>
									<option value=" btn-xs "><?php echo $MULTILANG_Pequeno; ?></option>
									<option value=" btn-sm "><?php echo $MULTILANG_Mediano; ?></option>
									<option value=" btn-lg "><?php echo $MULTILANG_Grande; ?></option>
								</select>
							</div>
							
							<label for="estilo"><?php echo $MULTILANG_Personalizado; ?>:</label>
							<div class="form-group input-group">
								<input type="text" id="estilo" name="estilo" class="form-control input-sm" placeholder="<?php echo $MULTILANG_Avanzado; ?>: BootStrap o Customizado"  OnInput="ActualizarEstilo_boton_vista_previa();">
								<span class="input-group-addon">
									<a href="#" title="<?php echo $MULTILANG_FrmDesEstilo; ?>"><i class="fa fa-question-circle text-info"></i></a>
								</span>
							</div>
						</div>
						<div class="col col-md-7 jumbotron">
							<div align="center">
								<?php echo $MULTILANG_VistaPrev; ?>:<br><br>
								<button type="button" name="boton_vista_previa" id="boton_vista_previa" class=""></button>
							</div>
						</div>
					</div>


                    <label for="tipo_accion"><?php echo $MULTILANG_FrmTipoAccion; ?>:</label>
                    <div class="form-group input-group">
                        <select id="tipo_accion" name="tipo_accion" class="form-control">
                            <option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
                            <optgroup label="<?php echo $MULTILANG_FrmAccionT1; ?>">
                                <option value="interna_eliminar"><?php echo $MULTILANG_InfDelReg; ?></option>
                                <option value="interna_cargar"><?php echo $MULTILANG_InfCargaForm; ?></option>
                            </optgroup>
                            <optgroup label="<?php echo $MULTILANG_FrmAccionT2; ?>">
                                <option value="externa_formulario"><?php echo $MULTILANG_FrmAccionExterna; ?></option>
                                <option value="externa_javascript"><?php echo $MULTILANG_FrmAccionJS; ?></option>
                            </optgroup>
                        </select>
                        <span class="input-group-addon">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
                            <a href="#" title="<?php echo $MULTILANG_FrmDesAccion; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                        </span>
                    </div>

                    <div class="form-group input-group">
                        <input name="accion_usuario" type="text" class="form-control" placeholder="<?php echo $MULTILANG_FrmAccionCMD; ?>">
                        <span class="input-group-addon">
                            <a href="#" title="<?php echo $MULTILANG_FrmAccionDesCMD; ?>"><i class="fa fa-question-circle  fa-fw icon-info"></i></a>
                        </span>
                    </div>
                    
                    <div class="btn-xs">
                    <?php echo $MULTILANG_InfHlpAccion; ?><br><br>
                    
                    <b><?php echo $MULTILANG_InfVinculo; ?>:</b>
                    <br><?php echo $MULTILANG_InfDesVinculo; ?>
                    </div>

			</div>
			<div class="col col-md-6">

                    <div class="row">
                        <div class="col-md-6">
                            
                            <label for="peso"><?php echo $MULTILANG_Peso; ?>:</label>
                            <div class="form-group input-group">
                                <select id="peso" name="peso" class="form-control">
										<?php
											for ($i=1;$i<=20;$i++)
												echo '<option value="'.$i.'">'.$i.'</option>';
										?>
                                </select>
                                <span class="input-group-addon">
                                    <a href="#" title="<?php echo $MULTILANG_InfDesPeso; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                </span>
                            </div>

                        </div>    
                        <div class="col-md-6">
                            
                            <label for="visible"><?php echo $MULTILANG_FrmVisible; ?>:</label>
                            <div class="form-group input-group">
                                <select id="visible" name="visible" class="form-control">
										<option value="1"><?php echo $MULTILANG_Si; ?></option>
										<option value="0"><?php echo $MULTILANG_No; ?></option>
                                </select>
                                <span class="input-group-addon">
                                    <a href="#" title="<?php echo $MULTILANG_FrmDesVisible; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                                </span>
                            </div>
                            
                        </div>
                    </div>

                    <div class="form-group input-group">
                        <input name="confirmacion_texto" type="text" class="form-control" placeholder="<?php echo $MULTILANG_FrmConfirma; ?>">
                        <span class="input-group-addon">
                            <a href="#" title="<?php echo $MULTILANG_FrmDesConfirma; ?>"><i class="fa fa-question-circle  fa-fw icon-info"></i></a>
                        </span>
                    </div>
                    
                    <hr>
                    <label for="destino"><?php echo $MULTILANG_InfEjecutarAccionEn; ?>:</label>
                    <div class="form-group input-group">
                        <select id="destino" name="destino" class="form-control">
							<option value="_self"><?php echo $MULTILANG_MnuTgtSelf; ?> (_SELF)</option>
							<option value="_blank"><?php echo $MULTILANG_MnuTgtBlank; ?> (_BLANK)</option>
							<option value="_parent"><?php echo $MULTILANG_MnuTgtParent; ?> (_PARENT)</option>
							<option value="_top"><?php echo $MULTILANG_MnuTgtTop; ?> (_TOP)</option>
                        </select>
                    </div>

                    <label for="pantalla_completa"><?php echo $MULTILANG_FrmBtnFull; ?>:</label>
                    <div class="form-group input-group">
                        <select id="pantalla_completa" name="pantalla_completa" class="form-control">
							<option value="0"><?php echo $MULTILANG_No; ?></option>
							<option value="1"><?php echo $MULTILANG_Si; ?></option>
                        </select>
                    </div>

                    <label for="precargar_estilos"><?php echo $MULTILANG_InfPrecargarEstilos; ?>:</label>
                    <div class="form-group input-group">
                        <select id="precargar_estilos" name="precargar_estilos" class="form-control">
							<option value="1"><?php echo $MULTILANG_Si; ?></option>
							<option value="0"><?php echo $MULTILANG_No; ?></option>
                        </select>
                    </div>


			</div>
		</div>

                </form>
                <a class="btn btn-success btn-block" href="javascript:document.datosfield.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_FrmBtnGuardar; ?></a>
            <?php 
                $barra_herramientas_modal='
                    <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
                cerrar_dialogo_modal($barra_herramientas_modal);
            ?>





            <!-- Modal Agregar acciones del informe -->
            <?php abrir_dialogo_modal("myModalEditaAccionesInforme",$MULTILANG_FrmTitComandos); ?>
					<table class="table table-condensed table-unbordered table-hover">
						<thead>
                        <tr>
							<td><b><?php echo $MULTILANG_Etiqueta; ?></b></td>
							<td><b><?php echo $MULTILANG_FrmTipoAccion; ?></b></td>
							<td><b><?php echo $MULTILANG_FrmAccUsuario; ?></b></td>
							<td><b><?php echo $MULTILANG_FrmOrden; ?></b></td>
							<td><b><?php echo $MULTILANG_FrmVisible; ?></b></td>
							<td></td>
							<td></td>
						</tr>
                        </thead>
                        <tbody>
			 <?php
				$consulta_botones=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe_boton." FROM ".$TablasCore."informe_boton WHERE informe=? ORDER BY peso,id","$informe");
				while($registro = $consulta_botones->fetch())
					{
						$peso_aumentado=$registro["peso"]+1;
						if ($registro["peso"]-1>=1) $peso_disminuido=$registro["peso"]-1;
						echo '<tr>
								<td><b>'.$registro["titulo"].'</b></td>
								<td><b>'.$registro["tipo_accion"].'</b></td>
								<td>'.$registro["accion_usuario"].'</td>';
						echo '		<td align=center>
										<form action="'.$ArchivoCORE.'" method="POST" name="bifoce'.$registro["id"].'" id="bifoce'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
											<input type="hidden" name="PCO_Accion" value="cambiar_estado_campo">
											<input type="hidden" name="id" value="'.$registro["id"].'">
											<input type="hidden" name="tabla" value="informe_boton">
											<input type="hidden" name="campo" value="peso">
											<input type="hidden" name="informe" value="'.$informe.'">
											<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
											<input type="hidden" name="accion_retorno" value="editar_informe">
											<input type="hidden" name="valor" value="'.$peso_aumentado.'">
											<input type="Hidden" name="popup_activo" value="FormularioAcciones">
										</form>
										<form action="'.$ArchivoCORE.'" method="POST" name="bifopa'.$registro["id"].'" id="bifopa'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
											<input type="hidden" name="PCO_Accion" value="cambiar_estado_campo">
											<input type="hidden" name="id" value="'.$registro["id"].'">
											<input type="hidden" name="tabla" value="informe_boton">
											<input type="hidden" name="campo" value="peso">
											<input type="hidden" name="informe" value="'.$informe.'">
											<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
											<input type="hidden" name="accion_retorno" value="editar_informe">
											<input type="hidden" name="valor" value="'.@$peso_disminuido.'">
											<input type="Hidden" name="popup_activo" value="FormularioAcciones">
										</form>
									';

									echo '
										<a href="javascript:bifoce'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmAumentaPeso.'"  class="btn btn-success btn-xs"><i class="fa fa-caret-down"></i></a> 
										'.$registro["peso"].'
										<a href="javascript:bifopa'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmDisminuyePeso.'"  class="btn btn-success btn-xs"><i class="fa fa-caret-up"></i></a>
										';
								
								echo '</td>';

								echo '<td align=center>
											<form action="'.$ArchivoCORE.'" method="POST" name="bif'.$registro["id"].'" id="bif'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
												<input type="hidden" name="PCO_Accion" value="cambiar_estado_campo">
												<input type="hidden" name="id" value="'.$registro["id"].'">
												<input type="hidden" name="tabla" value="informe_boton">
												<input type="hidden" name="campo" value="visible">
												<input type="hidden" name="informe" value="'.$informe.'">
												<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
												<input type="hidden" name="accion_retorno" value="editar_informe">
												<input type="Hidden" name="popup_activo" value="FormularioAcciones">
											';
									if ($registro["visible"])
										echo '<input type="hidden" name="valor" value="0"><a href="javascript:bif'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'"  class="btn btn-warning btn-xs"><i class="fa fa-lightbulb-o"></i></a>';
									else
										echo '<input type="hidden" name="valor" value="1"><a href="javascript:bif'.$registro["id"].'.submit();" title="'.$MULTILANG_FrmHlpCambiaEstado.'"  class="btn btn-default btn-xs"><i class="fa fa-lightbulb-o"></i></a>';
								echo '</form></td>';
										echo '<td align="center">
												<form action="'.$ArchivoCORE.'" method="POST" name="bf'.$registro["id"].'" id="bf'.$registro["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
														<input type="hidden" name="PCO_Accion" value="eliminar_accion_informe">
														<input type="hidden" name="boton" value="'.$registro["id"].'">
														<input type="hidden" name="informe" value="'.$informe.'">
														<input type="hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
														<input type="Hidden" name="popup_activo" value="FormularioAcciones">
                                                        <a href="javascript:confirmar_evento(\''.$MULTILANG_FrmAdvDelBoton.'\',bf'.$registro["id"].');" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="'.$MULTILANG_Eliminar.'"><i class="fa fa-times"></i></a>
												</form>
										</td>';

							echo '</tr>';
					}
				echo '
                    </tbody>
                </table>';
			?>
            <?php 
                $barra_herramientas_modal='
                    <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
                cerrar_dialogo_modal($barra_herramientas_modal);
            ?>



		<?php
			// Habilita el popup activo
			if (@$popup_activo=="FormularioTablas")	echo '<script type="text/javascript">	AbrirPopUp("FormularioTablas"); </script>';
			if (@$popup_activo=="FormularioCampos")	echo '<script type="text/javascript">	AbrirPopUp("FormularioCampos"); </script>';
			if (@$popup_activo=="FormularioCondiciones")	echo '<script type="text/javascript">	AbrirPopUp("FormularioCondiciones"); </script>';
			if (@$popup_activo=="FormularioGraficos")	echo '<script type="text/javascript">	AbrirPopUp("FormularioGraficos"); </script>';
			if (@$popup_activo=="FormularioAgrupacion")	echo '<script type="text/javascript">	AbrirPopUp("FormularioAgrupacion"); </script>';
			if (@$popup_activo=="FormularioBotones")	echo '<script type="text/javascript">	AbrirPopUp("FormularioBotones"); </script>';
			if (@$popup_activo=="FormularioAcciones")	echo '<script type="text/javascript">	AbrirPopUp("FormularioAcciones"); </script>';
		?>

<div class="row">
  <div class="col-md-4">
			<?php 
				abrir_ventana($MULTILANG_BarraHtas, 'panel-primary'); 
			?>
				<div align=center>
				<?php echo $MULTILANG_InfTablasOrigen; ?><br>
				<a data-toggle="modal" href='#myModalTablaInforme' title="<?php echo $MULTILANG_InfAgregaTabla; ?>" name=" "><i class="fa fa-database fa-3x"></i></a>
				<hr>
				<?php echo $MULTILANG_InfCamposOrigen; ?><br>
				<a data-toggle="modal" href='#myModalCamposInforme' title="<?php echo $MULTILANG_InfAgregaCampo; ?>" name=" "><i class="fa fa-th-list fa-3x"></i></a>
				<hr>
				<?php echo $MULTILANG_InfCondiciones; ?><br>
				<a data-toggle="modal" href='#myModalCondicionesInforme' title="<?php echo $MULTILANG_InfFiltrar; ?>"><i class="fa fa-filter fa-3x"></i></a>
				<hr>
				<?php echo $MULTILANG_InfAgrupa; ?><br>
				<a data-toggle="modal" href='#myModalAgrupacionInforme' title="<?php echo $MULTILANG_InfCampoAgrupa; ?>"><i class="fa fa-plus fa-3x fa-fw"></i><i class="fa fa-sort-alpha-asc fa-3x fa-fw"></i></a>

				<?php
					// Si se trata de un informe con grafico como resultado agrega el boton de graficos
					if ($registro_informe['formato_final']=='G')
						{
				?>
					<hr>
					<?php echo $MULTILANG_InfPropGraf; ?><br>
					<a data-toggle="modal" href='#myModalGraficosInforme' title="<?php echo $MULTILANG_InfDesGraf; ?>"><i class="fa fa-pie-chart fa-3x"></i></a>
				<?php
						}// Fin si es grafico
				?>

				<?php
					// Si se trata de un informe tabular permite agregarle acciones a los registros
					if ($registro_informe['formato_final']=='T')
						{
				?>
					<hr>
					Acciones para cada registro<br>
					<a data-toggle="modal" href='#myModalAgregaAccionesInforme' title="<?php echo $MULTILANG_InfDesAccion; ?>"><i class="fa fa-bolt fa-3x fa-fw icon-red"></i></a>
					<a data-toggle="modal" href='#myModalEditaAccionesInforme' title="<?php echo $MULTILANG_FrmDesAcciones; ?>"><i class="fa fa-pencil-square-o fa-3x fa-fw"></i></a>
				<?php
						}// Fin si es grafico
				?>

				<br><br>
				<form action="<?php echo $ArchivoCORE; ?>" method="POST" name="cancelar"><input type="Hidden" name="PCO_Accion" value="administrar_informes"></form>
                <a class="btn btn-warning btn-block" href="javascript:document.cancelar.submit();"><i class="fa fa-home"></i> <?php echo $MULTILANG_InfVolver; ?></a>

				</div><br>
			<?php
				cerrar_ventana();
			?>
			

  </div>    
  <div class="col-md-8">



			<?php abrir_ventana($MULTILANG_InfParam, 'panel-primary'); ?>
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="PCO_Accion" value="actualizar_informe">
			<input type="Hidden" name="id" value="<?php echo $registro_informe['id']; ?>">

            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-magic fa-fw"></i> </span>
                <input name="titulo" value="<?php echo $registro_informe['titulo']; ?>" type="text" class="form-control" placeholder="<?php echo $MULTILANG_InfTitulo; ?>">
                <span class="input-group-addon">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_InfDesTitulo; ?>"><i class="fa fa-question-circle fa-fw "></i></a>
                </span>
            </div>

            <div class="form-group input-group">
                <input name="descripcion" type="text" value="<?php echo $registro_informe['descripcion']; ?>" class="form-control" placeholder="<?php echo $MULTILANG_InfDescripcion; ?>">
                <span class="input-group-addon">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_InfDesDescrip; ?>"><i class="fa fa-question-circle fa-fw "></i></a>
                </span>
            </div>

            <div class="form-group input-group">
                <input name="categoria" type="text" value="<?php echo $registro_informe['categoria']; ?>" class="form-control" placeholder="<?php echo $MULTILANG_InfCategoria; ?>">
                <span class="input-group-addon">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_InfDesCateg; ?>"><i class="fa fa-question-circle fa-fw "></i></a>
                </span>
            </div>

            <div class="form-group input-group">
                <input name="ancho" type="text" value="<?php echo $registro_informe['ancho']; ?>" class="form-control" placeholder="<?php echo $MULTILANG_FrmAncho; ?>">
                <span class="input-group-addon">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_InfTitAncho; ?>: <?php echo $MULTILANG_InfDesAncho; ?> (<?php echo $MULTILANG_InfHlpAnchoalto; ?>)"><i class="fa fa-question-circle fa-fw "></i></a>
                </span>
            </div>

            <div class="form-group input-group">
                <input name="alto" type="text" value="<?php echo $registro_informe['alto']; ?>" class="form-control" placeholder="<?php echo $MULTILANG_InfAlto; ?>">
                <span class="input-group-addon">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_InfTitAlto; ?>: <?php echo $MULTILANG_InfDesAlto; ?> (<?php echo $MULTILANG_InfHlpAnchoalto; ?>)"><i class="fa fa-question-circle fa-fw "></i></a>
                </span>
            </div>

            <label for="formato_final"><?php echo $MULTILANG_InfFormato; ?>:</label>
            <div class="form-group input-group">
                <select id="formato_final" name="formato_final" class="form-control" >
                    <option value="T"  <?php if ($registro_informe["formato_final"]=="T") echo 'selected'; ?> ><?php echo $MULTILANG_TablaDatos; ?></option>
                    <option value="G"  <?php if ($registro_informe["formato_final"]=="G") echo 'selected'; ?> ><?php echo $MULTILANG_Grafico; ?></option>
                </select>
                <span class="input-group-addon">
                    <a href="#" title="<?php echo $MULTILANG_InfTitFormato; ?>: <?php echo $MULTILANG_InfDesFormato; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                </span>
            </div>

            <label for="genera_pdf"><?php echo $MULTILANG_InfGeneraPDF; ?>:</label>
            <div class="form-group input-group">
                <select id="genera_pdf" name="genera_pdf" class="form-control" >
                    <option value="S" <?php if ($registro_informe["genera_pdf"]=="S") echo 'selected'; ?> ><?php echo $MULTILANG_Si; ?></option>
                    <option value="N" <?php if ($registro_informe["genera_pdf"]=="N") echo 'selected'; ?> ><?php echo $MULTILANG_No; ?></option>
                </select>
                <span class="input-group-addon">
                    <a href="#" title="<?php echo $MULTILANG_InfGeneraPDFInfoTit; ?>: <?php echo $MULTILANG_InfGeneraPDFInfoDesc; ?>"><i class="fa fa-exclamation-triangle icon-orange fa-fw"></i></a>
                </span>
            </div>
            
            <label for="variables_filtro"><?php echo $MULTILANG_InfVblesFiltro; ?>:</label>
            <div class="form-group input-group">
                <input name="variables_filtro" id="variables_filtro" value="<?php echo $registro_informe['variables_filtro']; ?>" type="text" class="form-control" placeholder="<?php echo $MULTILANG_InfVblesFiltro; ?>">
                <span class="input-group-addon">
                    <a href="#" title="<?php echo $MULTILANG_InfVblesDesFiltro; ?>"><i class="fa fa-question-circle fa-fw "></i></a>
                </span>
            </div>

            <label for="formulario_filtrado"><?php echo $MULTILANG_InfFormFiltrado; ?>:</label>
            <div class="form-group input-group">
                <select id="formulario_filtrado" name="formulario_filtrado" class="form-control" >
					<option value=""></option>
					<?php
						$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario ORDER BY titulo");
						while($registro_formularios = $consulta_forms->fetch())
							{
								$seleccion_campo="";
								if (@$registro_informe["formulario_filtrado"]==$registro_formularios["id"])
									$seleccion_campo="SELECTED";
								echo '<option value="'.$registro_formularios["id"].'" '.$seleccion_campo.'>(Id.'.$registro_formularios["id"].') '.$registro_formularios["titulo"].'</option>';
							}
					?>
                </select>
                <span class="input-group-addon">
                    <a href="#" title="<?php echo $MULTILANG_InfFormFiltradoDes; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                </span>
            </div>

            <label for="soporte_datatable"><?php echo $MULTILANG_InfDataTableTit; ?>:</label>
            <div class="form-group input-group">
                <select id="soporte_datatable" name="soporte_datatable" class="form-control" >
                    <option value="S" <?php if ($registro_informe["soporte_datatable"]=="S") echo 'selected'; ?> ><?php echo $MULTILANG_Si; ?></option>
                    <option value="N" <?php if ($registro_informe["soporte_datatable"]=="N") echo 'selected'; ?> ><?php echo $MULTILANG_No; ?></option>
                </select>
                <span class="input-group-addon">
                    <a href="#" title="<?php echo $MULTILANG_Ayuda; ?>: <?php echo $MULTILANG_InfDataTableDes; ?>"><i class="fa fa-question-circle fa-fw"></i></a>
                </span>
            </div>

            </form>
            <a class="btn btn-success btn-block" href="javascript:document.datos.submit();"><i class="fa  fa-floppy-o"></i> <?php echo $MULTILANG_InfActualizar; ?></a>

			<?php
				cerrar_ventana();
			?>


			<?php abrir_ventana($MULTILANG_InfVistaPrev, 'panel-primary'); ?>

			<form action="<?php echo $ArchivoCORE; ?>" method="post" name="datosprevios" id="datosprevios" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
			
			<input type="hidden" name="PCO_Accion" value="cargar_objeto">
			<input type="hidden" name="objeto" value="inf:<?php echo $registro_informe['id']; ?>:1:htm:Informes:0">
			</form>

				<table width="100%" class="TextosVentana">
					<tr>
						<td>
							</form>
						</td>
						<td align=center>
							<?php echo $MULTILANG_InfHlpCarga; ?>: <br>
                            <a class="btn btn-info btn-block" href="javascript:document.datosprevios.submit();"><i class="fa fa-print"></i> <?php echo $MULTILANG_InfCargaPrev; ?></a>
						</td>
					</tr>
				</table>
				
			<br>
            <div class="well well-sm btn-xs" style="color:Blue;">
				<font color="#FF0000"><b><?php echo strtoupper($MULTILANG_VistaPrev); ?> </b>(<?php echo $MULTILANG_MonCommSQL?>, <i>variables reemplazadas/vars replaced</i>):<br></font>
				<?php echo construir_consulta_informe($registro_informe['id'],0); ?>
            </div>
            

			<?php
				cerrar_ventana();
			?>

	<?php
		echo '
  </div>
</div>        
        
        ';
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOFUNC_eliminar_informe
	Elimina un informe definido para la aplicacion incluyendo todos los objetos definidos en su interior

	Variables de entrada:

		informe - ID unico de identificacion del formulario a eliminar

	(start code)
		DELETE FROM ".$TablasCore."formulario WHERE id='$formulario'
		DELETE FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario'
		DELETE FROM ".$TablasCore."formulario_boton WHERE formulario=? ","$formulario
	(end)

	Salida:
		Registro eliminado

	Ver tambien:
		<administrar_formularios>
*/
	function PCOFUNC_eliminar_informe($informe="")
		{
			global $TablasCore;
			if ($informe!="")
				{
					ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe WHERE id=? ","$informe");
					ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_campos WHERE informe=? ","$informe");
					ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_tablas WHERE informe=? ","$informe");
					ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_condiciones WHERE informe=? ","$informe");
					ejecutar_sql_unaria("DELETE FROM ".$TablasCore."informe_boton WHERE informe=? ","$informe");
					ejecutar_sql_unaria("DELETE FROM ".$TablasCore."usuario_informe WHERE informe=? ","$informe");
					auditar("Elimina informe $informe");
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: eliminar_informe
	Elimina un informe de la aplicacion, incluyendo todos los registros asociados en otras tablas

	Variables de entrada:

		informe - ID del informe que sera eliminado

	Salida:
		Informe eliminado

	Ver tambien:

		<editar_informe>
*/
if ($PCO_Accion=="eliminar_informe")
	{
		PCOFUNC_eliminar_informe($informe);
		echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="PCO_Accion" value="administrar_informes"></form>
				<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: guardar_informe
	Agrega un informe a la aplicacion

		(start code)
			INSERT INTO ".$TablasCore."informe VALUES (0, '$titulo','$descripcion','$categoria','$agrupamiento','$ordenamiento','$ancho','$alto','$formato_final','|!|!|!|')
		(end)

	Salida:
		Informe agregado al sistema

	Ver tambien:

		<editar_informe>
*/
if ($PCO_Accion=="guardar_informe")
	{
		$mensaje_error="";
		if ($titulo=="") $mensaje_error.=$MULTILANG_InfErrInforme1."<br>";
		if ($categoria=="") $mensaje_error.=$MULTILANG_InfErrInforme2."<br>";
		if ($mensaje_error=="")
			{
				$agrupamiento='';
                $ordenamiento='';
                ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe (".$ListaCamposSinID_informe.") VALUES (?,?,?,?,?,?,?,?,'|!|!|!|',?,?,?,?)","$titulo$_SeparadorCampos_$descripcion$_SeparadorCampos_$categoria$_SeparadorCampos_$agrupamiento$_SeparadorCampos_$ordenamiento$_SeparadorCampos_$ancho$_SeparadorCampos_$alto$_SeparadorCampos_$formato_final$_SeparadorCampos_$genera_pdf$_SeparadorCampos_$variables_filtro$_SeparadorCampos_$soporte_datatable$_SeparadorCampos_$formulario_filtro");
				$id=$ConexionPDO->lastInsertId();
				auditar("Crea informe $id");
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
				<input type="Hidden" name="PCO_Accion" value="editar_informe">
				<input type="Hidden" name="informe" value="'.$id.'"></form>
							<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
		else
			{
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="administrar_informes">
					<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
					<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: clonar_diseno_informe
	Agrega un informe a partir de otro para la aplicacion

	Salida:
		Registro agregado y paso al administrador de informes

	Ver tambien:
		<administrar_informes>
*/
	if ($PCO_Accion=="clonar_diseno_informe")
		{
			$mensaje_error="";
			if ($informe=="")
				$mensaje_error=$MULTILANG_ErrorTiempoEjecucion.".  No ingreso ID de Informe - Report ID not entered";
			if ($tipo_copia_objeto=="")
				$mensaje_error=$MULTILANG_ErrorTiempoEjecucion.".  No indicado modo de copia - Copy mode not entered";
				
			$Contenido_XML="";

			if ($mensaje_error=="")
				{
					//Hace la copia del objeto segun el tipo solicitado
					if ($tipo_copia_objeto=="EnLinea")
						{	
							// Busca datos y Crea copia del informe
							$consulta=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe." FROM ".$TablasCore."informe WHERE id=?","$informe");
							$registro = $consulta->fetch();
							// Establece valores para cada campo a insertar en el nuevo informe
							/* ##########################################################################################################*/
							/* ####### IMPORTANTE:  Ajustes sobre esta funcionde copia se deberian replicar en importaciones XML ########*/
							/* ##########################################################################################################*/
							$titulo='[COPIA] '.$registro["titulo"];
							$descripcion=$registro["descripcion"];
							$categoria=$registro["categoria"];
							$agrupamiento=$registro["agrupamiento"];
							$ordenamiento=$registro["ordenamiento"];
							$ancho=$registro["ancho"];
							$alto=$registro["alto"];
							$formato_final=$registro["formato_final"];
							$formato_grafico=$registro["formato_grafico"];
							$genera_pdf=$registro["genera_pdf"];
							$variables_filtro=$registro["variables_filtro"];
							$soporte_datatable=$registro["soporte_datatable"];
							$formulario_filtrado=$registro["formulario_filtrado"];

							// Inserta el nuevo informe
							ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe (".$ListaCamposSinID_informe.") VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?) ","$titulo$_SeparadorCampos_$descripcion$_SeparadorCampos_$categoria$_SeparadorCampos_$agrupamiento$_SeparadorCampos_$ordenamiento$_SeparadorCampos_$ancho$_SeparadorCampos_$alto$_SeparadorCampos_$formato_final$_SeparadorCampos_$formato_grafico$_SeparadorCampos_$genera_pdf$_SeparadorCampos_$variables_filtro$_SeparadorCampos_$soporte_datatable$_SeparadorCampos_$formulario_filtrado");
							
							$idObjetoInsertado=$ConexionPDO->lastInsertId();

							// Busca los elementos que componen el informe para hacerles la copia
							//Determina cuantos campos tiene la tabla
							$ArregloCampos=explode(',',$ListaCamposSinID_informe_condiciones);
							$TotalCampos=count($ArregloCampos);
							// Registros de informe_condiciones
							$consulta=ejecutar_sql("SELECT * FROM ".$TablasCore."informe_condiciones WHERE informe=?","$informe");
							while($registro = $consulta->fetch())
								{
									//Genera cadena de interrogantes y valores segun cantidad de campos
									$CadenaInterrogantes='?'; //Agrega el primer interrogante
									$CadenaValores=$idObjetoInsertado;
									for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
										{
											//Cadena de interrogantes
											$CadenaInterrogantes.=',?';
											//Cadena de valores (el campo No 0 corresponde al ID de informe nuevo)
											if ($PCOCampo!=0)
												$CadenaValores.=$_SeparadorCampos_.$registro[$PCOCampo+1];
											else
												$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
										}
									//Inserta el nuevo objeto al informe
									ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_condiciones ($ListaCamposSinID_informe_condiciones) VALUES ($CadenaInterrogantes) ","$CadenaValores");                            
								}				

							//Determina cuantos campos tiene la tabla
							$ArregloCampos=explode(',',$ListaCamposSinID_informe_tablas);
							$TotalCampos=count($ArregloCampos);
							// Registros de formulario_boton
							$consulta=ejecutar_sql("SELECT * FROM ".$TablasCore."informe_tablas WHERE informe=? ","$informe");
							while($registro = $consulta->fetch())
								{
									//Genera cadena de interrogantes y valores segun cantidad de campos
									$CadenaInterrogantes='?'; //Agrega el primer interrogante
									$CadenaValores=$idObjetoInsertado;
									for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
										{
											//Cadena de interrogantes
											$CadenaInterrogantes.=',?';
											//Cadena de valores (el campo No 0 corresponde al ID de informe nuevo)
											if ($PCOCampo!=0)
												$CadenaValores.=$_SeparadorCampos_.$registro[$PCOCampo+1];
											else
												$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
										}
									//Inserta el nuevo objeto al informe
									ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_tablas ($ListaCamposSinID_informe_tablas) VALUES ($CadenaInterrogantes) ","$CadenaValores");
								}
								
								
							//Determina cuantos campos tiene la tabla
							$ArregloCampos=explode(',',$ListaCamposSinID_informe_campos);
							$TotalCampos=count($ArregloCampos);
							// Registros de formulario_boton
							$consulta=ejecutar_sql("SELECT * FROM ".$TablasCore."informe_campos WHERE informe=? ","$informe");
							while($registro = $consulta->fetch())
								{
									//Genera cadena de interrogantes y valores segun cantidad de campos
									$CadenaInterrogantes='?'; //Agrega el primer interrogante
									$CadenaValores=$idObjetoInsertado;
									for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
										{
											//Cadena de interrogantes
											$CadenaInterrogantes.=',?';
											//Cadena de valores (el campo No 0 corresponde al ID de informe nuevo)
											if ($PCOCampo!=0)
												$CadenaValores.=$_SeparadorCampos_.$registro[$PCOCampo+1];
											else
												$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
										}
									//Inserta el nuevo objeto al informe
									ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_campos ($ListaCamposSinID_informe_campos) VALUES ($CadenaInterrogantes) ","$CadenaValores");
								}

							//Determina cuantos campos tiene la tabla
							$ArregloCampos=explode(',',$ListaCamposSinID_informe_boton);
							$TotalCampos=count($ArregloCampos);
							// Registros de informe_boton
							$consulta=ejecutar_sql("SELECT * FROM ".$TablasCore."informe_boton WHERE informe=? ","$informe");
							while($registro = $consulta->fetch())
								{
									//Genera cadena de interrogantes y valores segun cantidad de campos
									$CadenaInterrogantes='?'; //Agrega el primer interrogante
									$CadenaValores=$registro[1];
									for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
										{
											//Cadena de interrogantes
											$CadenaInterrogantes.=',?';
											//Cadena de valores (el campo No 0 corresponde al ID de informe nuevo)
											if ($PCOCampo!=2)
												$CadenaValores.=$_SeparadorCampos_.$registro[$PCOCampo+1];
											else
												$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
										}
									//Inserta el nuevo objeto al informe
									ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_boton ($ListaCamposSinID_informe_boton) VALUES ($CadenaInterrogantes) ","$CadenaValores");
								}

							auditar("Crea copia de informe $informe");

							// Regresa a la administracion de informes
							echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
							<input type="Hidden" name="PCO_Accion" value="administrar_informes">
							</form>
							<script type="" language="JavaScript"> 
							alert("'.$MULTILANG_FrmMsjCopia.$nuevo_titulo.' ID: '.$id.'");
							document.cancelar.submit();  </script>';
						}


					//Hace la copia del objeto segun el tipo solicitado
					if ($tipo_copia_objeto=="XML_IdEstatico" || $tipo_copia_objeto=="XML_IdDinamico")
						{
							// Inicia el archivo XML
							$Contenido_XML.="<?xml version=\"1.0\" encoding=\"utf-8\" ?>
<objetos_practicos>
	<descripcion>
		<tipo_objeto>Informe</tipo_objeto>
		<version_practico>$PCO_VersionActual</version_practico>
		<tipo_exportacion>$tipo_copia_objeto</tipo_exportacion>
		<sistema_origen>$Nombre_Aplicacion</sistema_origen>
		<version>$Version_Aplicacion</version>
		<usuario_generador>$PCOSESS_LoginUsuario</usuario_generador>
		<fecha_exportacion>$PCO_FechaOperacionGuiones</fecha_exportacion>
		<hora_exportacion>$PCO_HoraOperacionPuntos</hora_exportacion>
	</descripcion>";
							// Exporta tabla core_informe
							$Contenido_XML .= "
	<core_informe>";
							// Busca datos y genera XML de cada registro
							$consulta=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe." FROM ".$TablasCore."informe WHERE id=?","$informe");
							$registro = $consulta->fetch();
							$Contenido_XML .=registro_a_xml($registro,"id,".$ListaCamposSinID_informe);
							$Contenido_XML .= "
	</core_informe>";
							// Registros de informe_boton
							$consulta=ejecutar_sql("SELECT * FROM ".$TablasCore."informe_boton WHERE informe=?","$informe");
							$conteo_elementos_xml=0;
							while($registro = $consulta->fetch())
								{
									//Exporta la tabla de core_informe_boton
									$Contenido_XML .= "
	<core_informe_boton>";
									$Contenido_XML .=registro_a_xml($registro,"id,".$ListaCamposSinID_informe_boton);
							$Contenido_XML .= "
	</core_informe_boton>";
									$conteo_elementos_xml++;
								}
							//Agrega el total de elementos y resetea contador para el siguiente
									$Contenido_XML .= "
	<total_core_informe_boton><cantidad_objetos>$conteo_elementos_xml</cantidad_objetos></total_core_informe_boton>";
							$conteo_elementos_xml=0;

							// Registros de informe_campos
							$consulta=ejecutar_sql("SELECT * FROM ".$TablasCore."informe_campos WHERE informe=?","$informe");
							while($registro = $consulta->fetch())
								{
									//Exporta la tabla de core_informe_campos
									$Contenido_XML .= "
	<core_informe_campos>";
									$Contenido_XML .=registro_a_xml($registro,"id,".$ListaCamposSinID_informe_campos);
							$Contenido_XML .= "
	</core_informe_campos>";
									$conteo_elementos_xml++;
								}
							//Agrega el total de elementos y resetea contador para el siguiente
									$Contenido_XML .= "
	<total_core_informe_campos><cantidad_objetos>$conteo_elementos_xml</cantidad_objetos></total_core_informe_campos>";
							$conteo_elementos_xml=0;

							// Registros de informe_condiciones
							$consulta=ejecutar_sql("SELECT * FROM ".$TablasCore."informe_condiciones WHERE informe=?","$informe");
							while($registro = $consulta->fetch())
								{
									//Exporta la tabla de core_informe_condiciones
									$Contenido_XML .= "
	<core_informe_condiciones>";
									$Contenido_XML .=registro_a_xml($registro,"id,".$ListaCamposSinID_informe_condiciones);
							$Contenido_XML .= "
	</core_informe_condiciones>";
									$conteo_elementos_xml++;
								}
							//Agrega el total de elementos y resetea contador para el siguiente
									$Contenido_XML .= "
	<total_core_informe_condiciones><cantidad_objetos>$conteo_elementos_xml</cantidad_objetos></total_core_informe_condiciones>";
							$conteo_elementos_xml=0;

							// Registros de informe_tablas
							$consulta=ejecutar_sql("SELECT * FROM ".$TablasCore."informe_tablas WHERE informe=?","$informe");
							while($registro = $consulta->fetch())
								{
									//Exporta la tabla de core_informe_tablas
									$Contenido_XML .= "
	<core_informe_tablas>";
									$Contenido_XML .=registro_a_xml($registro,"id,".$ListaCamposSinID_informe_tablas);
							$Contenido_XML .= "
	</core_informe_tablas>";
									$conteo_elementos_xml++;
								}
							//Agrega el total de elementos y resetea contador para el siguiente
									$Contenido_XML .= "
	<total_core_informe_tablas><cantidad_objetos>$conteo_elementos_xml</cantidad_objetos></total_core_informe_tablas>";
							$conteo_elementos_xml=0;

							// Finaliza el archivo XML
							$Contenido_XML .= "
</objetos_practicos>";

							auditar("Crea copia $tipo_copia_objeto de informe $informe");
							
							//Guarda la cadena generada en el archivo XML
							$PCO_NombreArchivoXML="RepID_".$informe."_".$PCO_FechaOperacion."_".$PCO_HoraOperacion.".xml";
							$PCO_PunteroArchivo = fopen("tmp/".$PCO_NombreArchivoXML, "w");
							if($PCO_PunteroArchivo==false)
								die("No se puede abrir el archivo de exportacion");
							fputs ($PCO_PunteroArchivo, $Contenido_XML);
							fclose ($PCO_PunteroArchivo);

							//Presenta la ventana con informacion y enlace de descarga
							abrir_ventana($MULTILANG_FrmTipoCopiaExporta, 'panel-primary'); ?>
								<div align=center>
								<?php echo $MULTILANG_FrmCopiaFinalizada; ?>
								<br><br>
								<a class="btn btn-success" href="tmp/<?php echo $PCO_NombreArchivoXML; ?>" target="_BLANK" download><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_Descargar; ?></a>
								<a class="btn btn-default" href="javascript:document.core_ver_menu.submit();"><i class="fa fa-home"></i> <?php echo $MULTILANG_IrEscritorio; ?></a>
								</div>

							<?php
							cerrar_ventana();
						}

				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="administrar_informes">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: definir_copia_informes
	Presenta opciones para generar una copia del informe seleccionado usando diferentes formatos
*/
if ($PCO_Accion=="definir_copia_informes")
	{
		 ?>

        <form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="PCO_Accion" value="clonar_diseno_informe">
			<input type="Hidden" name="informe" value="<?php echo $informe; ?>">

            <br>
			<?php abrir_ventana($MULTILANG_FrmTipoObjeto, 'panel-primary'); ?>
			<h4><?php echo $MULTILANG_FrmTipoCopiaExporta; ?>: <b><?php echo $titulo_informe; ?></b> (ID=<?php echo $informe; ?>)</h4>
            <label for="tipo_copia_objeto"><?php echo $MULTILANG_FrmTipoCopia; ?>:</label>
            <select id="tipo_copia_objeto" name="tipo_copia_objeto" class="form-control btn-warning" >
                <option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
                <option value="EnLinea"><?php echo $MULTILANG_FrmTipoCopia1; ?></option>
                <option value="XML_IdEstatico"><?php echo $MULTILANG_FrmTipoCopia2; ?></option>
                <option value="XML_IdDinamico"><?php echo $MULTILANG_FrmTipoCopia3; ?></option>
            </select>
			<hr>
			<b><?php echo $MULTILANG_Ayuda; ?></b><br>
			<li><?php echo $MULTILANG_FrmTipoCopiaDes1; ?></li>
			<li><?php echo $MULTILANG_FrmTipoCopiaDes2; ?></li>
			<li><?php echo $MULTILANG_FrmTipoCopiaDes3; ?></li>
            </form>
            <br>
            <div align=center>
            <a class="btn btn-success" href="javascript:document.datos.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_FrmCopiar; ?></a>
            <a class="btn btn-default" href="javascript:document.core_ver_menu.submit();"><i class="fa fa-home"></i> <?php echo $MULTILANG_IrEscritorio; ?></a>
            </div>

		<?php
		cerrar_ventana();
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: confirmar_importacion_informe
	Lee el archivo cargado sobre /tmp y regenera el objeto alli existente

	Variables de entrada:

		archivo_cargado - Ruta absoluta hacia el archivo analizado en el paso anterior del asistente

	Salida:
		Objetos generados a partir de la definicion del archivo
*/
if ($PCO_Accion=="confirmar_importacion_informe")
	{
		echo "<br>";
		$mensaje_error="";
		abrir_ventana($MULTILANG_FrmImportar.' <b>'.$archivo_cargado.'</b>', 'panel-info');
		if ($archivo_cargado=="")
			$mensaje_error=$MULTILANG_ErrorTiempoEjecucion;
		else
			{
                //Carga el archivo en una cadena
                $cadena_xml_importado = file_get_contents($archivo_cargado);
				// Usa SimpleXML Directamente para interpretar respuesta
				$xml_importado = @simplexml_load_string($cadena_xml_importado);
			}
		if ($xml_importado->descripcion[0]->version_practico!=$PCO_VersionActual) $mensaje_error=$MULTILANG_ActErrGral;

		if ($mensaje_error=="")
			{
				//Si es tipo estatico elimina el informe existente con el mismo ID
				$ListaCamposParaID="";
				$InterroganteParaID="";
				$ValorInsercionParaID="";
				if ($xml_importado->descripcion[0]->tipo_exportacion=="XML_IdEstatico")
					{
						$ListaCamposParaID="id,";
						$InterroganteParaID="?,";
						$ValorInsercionParaID=base64_decode($xml_importado->core_informe[0]->id).$_SeparadorCampos_;
						PCOFUNC_eliminar_informe(base64_decode($xml_importado->core_informe[0]->id));
					}

				// Establece valores para cada campo a insertar en el nuevo informe
				/* ##########################################################################################################*/
				/* ####### IMPORTANTE: Ajustes sobre esta funcion se deberian replicar en funcion de copia asociadas ########*/
				/* ##########################################################################################################*/
				$titulo=base64_decode($xml_importado->core_informe[0]->titulo);
				$descripcion=base64_decode($xml_importado->core_informe[0]->descripcion);
				$categoria=base64_decode($xml_importado->core_informe[0]->categoria);
				$agrupamiento=base64_decode($xml_importado->core_informe[0]->agrupamiento);
				$ordenamiento=base64_decode($xml_importado->core_informe[0]->ordenamiento);
				$ancho=base64_decode($xml_importado->core_informe[0]->ancho);
				$alto=base64_decode($xml_importado->core_informe[0]->alto);
				$formato_final=base64_decode($xml_importado->core_informe[0]->formato_final);
				$formato_grafico=base64_decode($xml_importado->core_informe[0]->formato_grafico);
				$genera_pdf=base64_decode($xml_importado->core_informe[0]->genera_pdf);
				$variables_filtro=base64_decode($xml_importado->core_informe[0]->variables_filtro);
				$soporte_datatable=base64_decode($xml_importado->core_informe[0]->soporte_datatable);
				$formulario_filtrado=base64_decode($xml_importado->core_informe[0]->formulario_filtrado);

				// Inserta el nuevo informe
				ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe (".$ListaCamposParaID.$ListaCamposSinID_informe.") VALUES (".$InterroganteParaID."?,?,?,?,?,?,?,?,?,?,?,?,?) ","$ValorInsercionParaID$titulo$_SeparadorCampos_$descripcion$_SeparadorCampos_$categoria$_SeparadorCampos_$agrupamiento$_SeparadorCampos_$ordenamiento$_SeparadorCampos_$ancho$_SeparadorCampos_$alto$_SeparadorCampos_$formato_final$_SeparadorCampos_$formato_grafico$_SeparadorCampos_$genera_pdf$_SeparadorCampos_$variables_filtro$_SeparadorCampos_$soporte_datatable$_SeparadorCampos_$formulario_filtrado");
				
				//Determina el ID del registro
				if ($xml_importado->descripcion[0]->tipo_exportacion=="XML_IdEstatico")
					$idObjetoInsertado=base64_decode($xml_importado->core_informe[0]->id);
				else
					$idObjetoInsertado=$ConexionPDO->lastInsertId();

				// Busca los elementos que componen el informe para hacerles la copia
				//Determina cuantos campos tiene la tabla
				$ArregloCampos=explode(',',$ListaCamposSinID_informe_condiciones);
				$TotalCampos=count($ArregloCampos);
				// Registros de informe_condiciones
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_informe_condiciones[0]->cantidad_objetos;$PCO_i++)
					{
						//Genera cadena de interrogantes y valores segun cantidad de campos
						$CadenaInterrogantes='?'; //Agrega el primer interrogante
						$CadenaValores=$idObjetoInsertado;

						for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
							{
								//Cadena de interrogantes
								$CadenaInterrogantes.=',?';
								//Cadena de valores (el campo No 0 corresponde al ID de informe nuevo)
								if ($PCOCampo!=0)
									$CadenaValores.=$_SeparadorCampos_.base64_decode($xml_importado->core_informe_condiciones[$PCO_i]->$ArregloCampos[$PCOCampo]);
								else
									$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
							}
						//Inserta el nuevo objeto al informe
						ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_condiciones ($ListaCamposSinID_informe_condiciones) VALUES ($CadenaInterrogantes) ","$CadenaValores");
					}

				//Determina cuantos campos tiene la tabla
				$ArregloCampos=explode(',',$ListaCamposSinID_informe_tablas);
				$TotalCampos=count($ArregloCampos);
				// Registros de informe_tablas
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_informe_tablas[0]->cantidad_objetos;$PCO_i++)
					{
						//Genera cadena de interrogantes y valores segun cantidad de campos
						$CadenaInterrogantes='?'; //Agrega el primer interrogante
						$CadenaValores=$idObjetoInsertado;

						for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
							{
								//Cadena de interrogantes
								$CadenaInterrogantes.=',?';
								//Cadena de valores (el campo No 0 corresponde al ID de informe nuevo)
								if ($PCOCampo!=0)
									$CadenaValores.=$_SeparadorCampos_.base64_decode($xml_importado->core_informe_tablas[$PCO_i]->$ArregloCampos[$PCOCampo]);
								else
									$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
							}
						//Inserta el nuevo objeto al informe
						ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_tablas ($ListaCamposSinID_informe_tablas) VALUES ($CadenaInterrogantes) ","$CadenaValores");
					}

				//Determina cuantos campos tiene la tabla
				$ArregloCampos=explode(',',$ListaCamposSinID_informe_campos);
				$TotalCampos=count($ArregloCampos);
				// Registros de informe_campos
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_informe_campos[0]->cantidad_objetos;$PCO_i++)
					{
						//Genera cadena de interrogantes y valores segun cantidad de campos
						$CadenaInterrogantes='?'; //Agrega el primer interrogante
						$CadenaValores=$idObjetoInsertado;

						for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
							{
								//Cadena de interrogantes
								$CadenaInterrogantes.=',?';
								//Cadena de valores (el campo No 0 corresponde al ID de informe nuevo)
								if ($PCOCampo!=0)
									$CadenaValores.=$_SeparadorCampos_.base64_decode($xml_importado->core_informe_campos[$PCO_i]->$ArregloCampos[$PCOCampo]);
								else
									$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
							}
						//Inserta el nuevo objeto al informe
						ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_campos ($ListaCamposSinID_informe_campos) VALUES ($CadenaInterrogantes) ","$CadenaValores");
					}

				//Determina cuantos campos tiene la tabla
				$ArregloCampos=explode(',',$ListaCamposSinID_informe_boton);
				$TotalCampos=count($ArregloCampos);
				// Registros de informe_boton
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_informe_boton[0]->cantidad_objetos;$PCO_i++)
					{
						//Genera cadena de interrogantes y valores segun cantidad de campos
						$CadenaInterrogantes='?'; //Agrega el primer interrogante
						$CadenaValores=base64_decode($xml_importado->core_informe_boton[$PCO_i]->titulo);

						for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
							{
								//Cadena de interrogantes
								$CadenaInterrogantes.=',?';
								//Cadena de valores (el campo No 0 corresponde al ID de informe nuevo)
								if ($PCOCampo!=2)
									$CadenaValores.=$_SeparadorCampos_.base64_decode($xml_importado->core_informe_boton[$PCO_i]->$ArregloCampos[$PCOCampo]);
								else
									$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
							}
						//Inserta el nuevo objeto al informe
						ejecutar_sql_unaria("INSERT INTO ".$TablasCore."informe_boton ($ListaCamposSinID_informe_boton) VALUES ($CadenaInterrogantes) ","$CadenaValores");
					}

				echo '
				<b>'.$MULTILANG_FrmImportarGenerado.':</b><br>
				<li>ID: '.$idObjetoInsertado.'</li>
				<li>Titulo: '.$titulo.'</li>
				<br>
				<a class="btn btn-block btn-success" href="javascript:document.core_ver_menu.submit();"><i class="fa fa-thumbs-up"></i> '.$MULTILANG_Finalizado.'</a>';
				auditar("Importa $archivo_cargado en objeto $idObjetoInsertado");
				
			}
		else
			{
				echo '			
				<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="Ver_menu">
					<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ActErrGral.'">
					<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
		echo '</center>';

		cerrar_ventana();
        $VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: analizar_importacion_informe
	Revisa el archivo cargado sobre /tmp para validar si se trata de un objeto definido correctamente

	Variables de entrada:

		archivo_cargado - Ruta absoluta hacia el archivo cargado en el paso anterior del asistente

	Salida:
		Analisis del archivo y detalles del objeto
*/
if ($PCO_Accion=="analizar_importacion_informe")
	{
		echo "<br>";
		abrir_ventana($MULTILANG_FrmImportar.' <b>'.$archivo_cargado.'</b>', 'panel-info');

		if ($mensaje_error=="")
			{
                $existen_conflictos_entre_ids=0;
                //Carga el archivo en una cadena
                $cadena_xml_importado = file_get_contents($archivo_cargado);
				// Usa SimpleXML Directamente para interpretar respuesta
				$xml_importado = @simplexml_load_string($cadena_xml_importado);

                //Presenta alerta cuando encuentra otro elemento con el mismo ID y se trata de una importacion estatica
                if ($xml_importado->descripcion[0]->tipo_exportacion=="XML_IdEstatico")
					if (existe_valor($TablasCore."informe","id",base64_decode($xml_importado->core_informe[0]->id)))
						mensaje($MULTILANG_Atencion, $MULTILANG_FrmImportarAlerta, '', 'fa fa-fw fa-2x fa-warning', 'alert alert-dismissible alert-danger');
                
                //Presenta contenido del archivo
                echo "<b>$MULTILANG_Detalles $MULTILANG_Archivo</b>:<br>
					<li> <u>$MULTILANG_Version (Practico)</u>: {$xml_importado->descripcion[0]->version_practico}<br>
					<li> <u>$MULTILANG_Tipo $MULTILANG_Archivo</u>: ";
				if ($xml_importado->descripcion[0]->tipo_exportacion=="XML_IdEstatico") echo $MULTILANG_FrmTipoCopiaDes2;
				else echo $MULTILANG_FrmTipoCopiaDes3;

				echo "<br>
					<li> <u>$MULTILANG_Aplicacion</u>: {$xml_importado->descripcion[0]->sistema_origen} {$xml_importado->descripcion[0]->version}<br>
					<li> <u>$MULTILANG_GeneradoPor</u>: {$xml_importado->descripcion[0]->usuario_generador} ({$xml_importado->descripcion[0]->fecha_exportacion} {$xml_importado->descripcion[0]->hora_exportacion})<hr>
					<b>$MULTILANG_Detalles $MULTILANG_Objeto</b>:<br>
					<li> $MULTILANG_Tipo: {$xml_importado->descripcion[0]->tipo_objeto}<br>
					<li> $MULTILANG_Titulo: ".base64_decode($xml_importado->core_informe[0]->titulo)."<br>
					<li> ID: ".base64_decode($xml_importado->core_informe[0]->id)."<br>
                <hr>";
                
				//Recorre los core_informe_tablas
				echo '<div class="btn btn-block btn-primary">'.$MULTILANG_InfTablasOrigen.'</div><ul class="list-group">';
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_informe_tablas[0]->cantidad_objetos;$PCO_i++)
					echo '<a class="list-group-item">
						<span class="badge">ID '.$MULTILANG_Objeto.': '.base64_decode($xml_importado->core_informe_tablas[$PCO_i]->id).'</span>
						<b>'.base64_decode($xml_importado->core_informe_tablas[$PCO_i]->valor_tabla).'</b><i>
						&nbsp;&nbsp;&nbsp;<u>'.$MULTILANG_InfAlias.'</u>: '.base64_decode($xml_importado->core_informe_tablas[$PCO_i]->valor_alias).'
						</i></a>';
				echo '</ul>';
                
				//Recorre los core_informe_campos
				echo '<div class="btn btn-block btn-primary">'.$MULTILANG_InfCamposDef.'</div><ul class="list-group">';
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_informe_campos[0]->cantidad_objetos;$PCO_i++)
					echo '<a class="list-group-item">
						<span class="badge">ID '.$MULTILANG_Objeto.': '.base64_decode($xml_importado->core_informe_campos[$PCO_i]->id).'</span>
						<b>'.base64_decode($xml_importado->core_informe_campos[$PCO_i]->valor_campo).'</b><i>
						&nbsp;&nbsp;&nbsp;<u>'.$MULTILANG_InfAlias.'</u>: '.base64_decode($xml_importado->core_informe_campos[$PCO_i]->valor_alias).'
						</i></a>';
				echo '</ul>';

				//Recorre los core_informe_condiciones
				echo '<div class="btn btn-block btn-primary">'.$MULTILANG_InfDefCond.'</div><ul class="list-group">';
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_informe_condiciones[0]->cantidad_objetos;$PCO_i++)
					echo '<a class="list-group-item">
						<span class="badge">ID '.$MULTILANG_Objeto.': '.base64_decode($xml_importado->core_informe_condiciones[$PCO_i]->id).'</span>
						<b>'.base64_decode($xml_importado->core_informe_condiciones[$PCO_i]->valor_izq).' '.base64_decode($xml_importado->core_informe_condiciones[$PCO_i]->operador).' '.base64_decode($xml_importado->core_informe_condiciones[$PCO_i]->valor_der).'</b><i>
						</i></a>';
				echo '</ul>';

				//Recorre los core_informe_boton
				echo '<div class="btn btn-block btn-primary">'.$MULTILANG_FrmTitComandos.'</div><ul class="list-group">';
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_informe_boton[0]->cantidad_objetos;$PCO_i++)
					echo '<a class="list-group-item">
						<span class="badge">ID '.$MULTILANG_Objeto.': '.base64_decode($xml_importado->core_informe_boton[$PCO_i]->id).'</span>
						<b>'.base64_decode($xml_importado->core_informe_boton[$PCO_i]->titulo).'</b><i>
						&nbsp;&nbsp;&nbsp;<u>'.$MULTILANG_FrmTipoAcc.'</u>: '.base64_decode($xml_importado->core_informe_boton[$PCO_i]->tipo_accion).'
						&nbsp;&nbsp;&nbsp;<u>'.$MULTILANG_FrmAccUsuario.'</u>: '.base64_decode($xml_importado->core_informe_boton[$PCO_i]->accion_usuario).'
						</i></a>';
				echo '</ul>';

                echo "<br><hr>";
                //Agrega el boton de continuar solamente si no hay conflictos entre IDs
                if ($existen_conflictos_entre_ids==0)
                    echo '
                    <form name="goahead" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="confirmar_importacion_informe">
						<input type="Hidden" name="archivo_cargado" value="'.$archivo_cargado.'">
                        <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-warning texto-blink icon-yellow"></i> '.$MULTILANG_Importar.' <i class="fa fa-warning texto-blink icon-yellow"></i></button>
					</form>';
                else
                    mensaje('<i class="fa fa-warning fa-2x text-red texto-blink"></i> '.$MULTILANG_Error, $MULTILANG_FrmImportarConflicto, '', '', 'alert alert-danger alert-dismissible');
			}
		else
			{
				echo '			
				<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="Ver_menu">
					<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ActErrGral.'">
					<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
		echo '</center>';
		echo '<br><a class="btn btn-default btn-block" href="javascript:document.core_ver_menu.submit();"><i class="fa fa-home"></i> '.$MULTILANG_Cancelar.'</a>';

		cerrar_ventana();
        $VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: importar_informe
	Presenta el paso 1 de importacion de informes
*/
if ($PCO_Accion=="importar_informe")
	{
		echo "<br>";
		abrir_ventana($NombreRAD.' - '.$MULTILANG_FrmImportar,'panel-info');
?>

    <ul class="nav nav-tabs nav-justified">
    <li class="active"><a href="#pestana_importacion" data-toggle="tab"><i class="fa fa-cloud-upload"></i> <?php echo $MULTILANG_Cargar; ?> XML</a></li>
    <li><a href="#historico_importaciones" data-toggle="tab"><i class="fa fa-history"></i> <?php echo $MULTILANG_Historico; ?></a></li>
    </ul>

    <div class="tab-content">
        
        <!-- INICIO TAB IMPORTACION -->
        <div class="tab-pane fadein active" id="pestana_importacion">
            <br>
            <div align="center">
                        <form action="<?php echo $ArchivoCORE; ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="extension_archivo" value=".xml">
                            <input type="hidden" name="MAX_FILE_SIZE" value="8192000">
                            <input type="Hidden" name="PCO_Accion" value="cargar_archivo">
                            <input type="Hidden" name="siguiente_accion" value="analizar_importacion_informe">
                            <input type="Hidden" name="texto_boton_siguiente" value="Continuar con la revisi&oacute;n">
                            <input type="Hidden" name="carpeta" value="tmp">
                            <input name="archivo" type="file" class="form-control btn btn-info">
                            <br>
                            <button type="submit"  class="btn btn-success"><i class="fa fa-cloud-upload"></i> <?php echo $MULTILANG_CargarArchivo; ?></button> (<?php echo $MULTILANG_ActSobreescritos; ?>)
                        </form> 
                        <hr>
            </div>
        </div>
        <!-- FIN TAB IMPORTACION -->
        

        <!-- INICIO TAB HISTORICO DE IMPORTACIONES -->
        <div class="tab-pane fade" id="historico_importaciones">
                <div class="well well-sm"><b>Ultimos 30 registros / Last 30 records</b></div>
                <table id="TablaAcciones" class="table table-condensed table-hover table-unbordered btn-xs table-striped">
                    <thead>
					<tr>
						<th><b><?php echo $MULTILANG_UsrLogin; ?></b></th>
						<th><b><?php echo $MULTILANG_UsrAudDes; ?></b></th>
						<th><b><?php echo $MULTILANG_Fecha; ?></b></th>
						<th><b><?php echo $MULTILANG_Hora; ?></b></th>
					</tr>
                    </thead>
                    <tbody>
                    <?php
                        // Busca por las auditorias asociadas a actualizacion de plataforma:
                        // Acciones:  Actualiza version de plataforma | _Actualizacion_ | Analiza archivo tmp/Practico | Carga archivo en carpeta tmp - Practico
                        $resultado=@ejecutar_sql("SELECT $ListaCamposSinID_auditoria FROM ".$TablasCore."auditoria WHERE accion LIKE '%Import%' AND accion LIKE '%.xml en objeto%' ORDER BY fecha DESC, hora DESC LIMIT 0,30");
                        while($registro = $resultado->fetch())
                            {
                                echo '<tr>
                                        <td>'.$registro["usuario_login"].'</td>
                                        <td>'.$registro["accion"].'</td>
                                        <td>'.$registro["fecha"].'</td>
                                        <td>'.$registro["hora"].'</td>
                                    </tr>';
                            }
                    ?>
                    </tbody>
                </table>

        </div>
        <!-- FIN TAB HISTORICO DE IMPORTACIONES -->
        
    </div>

<?php
		abrir_barra_estado();
		echo '<a class="btn btn-warning btn-block" href="javascript:document.core_ver_menu.submit();"><i class="fa fa-home"></i> '.$MULTILANG_Cancelar.'</a>';
		cerrar_barra_estado();
		cerrar_ventana();
        $VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: administrar_informes
	Presenta la lista de todos los informes definidos en el sistema con la posibilidad de agregar nuevos o de administrar los existentes.

	(start code)
		SELECT * FROM ".$TablasCore."informe ORDER BY titulo
	(end)

	Salida:
		Listado de informes y formulario para creacion de nuevos

	Ver tambien:
	<guardar_informe> | <eliminar_informe>
*/
if ($PCO_Accion=="administrar_informes")
	{
		 ?>

<div class="row">
  <div class="col-md-4">

			<?php abrir_ventana($MULTILANG_InfTituloAgr, 'panel-primary'); ?>
			<form name="datos" id="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="PCO_Accion" value="guardar_informe">

			<h4><?php echo $MULTILANG_InfDetalles; ?>:</h4>

            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-magic fa-fw"></i> </span>
                <input name="titulo" type="text" class="form-control" placeholder="<?php echo $MULTILANG_InfTitulo; ?>">
                <span class="input-group-addon">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_InfDesTitulo; ?>"><i class="fa fa-question-circle fa-fw "></i></a>
                </span>
            </div>

            <div class="form-group input-group">
                <input name="descripcion" type="text" class="form-control" placeholder="<?php echo $MULTILANG_InfDescripcion; ?>">
                <span class="input-group-addon">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_InfDesDescrip; ?>"><i class="fa fa-question-circle fa-fw "></i></a>
                </span>
            </div>

            <div class="form-group input-group">
                <input name="categoria" type="text" class="form-control" placeholder="<?php echo $MULTILANG_InfCategoria; ?>">
                <span class="input-group-addon">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_InfDesCateg; ?>"><i class="fa fa-question-circle fa-fw "></i></a>
                </span>
            </div>

            <div class="form-group input-group">
                <input name="ancho" type="text" class="form-control" placeholder="<?php echo $MULTILANG_FrmAncho; ?>">
                <span class="input-group-addon">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_InfTitAncho; ?>: <?php echo $MULTILANG_InfDesAncho; ?> (<?php echo $MULTILANG_InfHlpAnchoalto; ?>)"><i class="fa fa-question-circle fa-fw "></i></a>
                </span>
            </div>

            <div class="form-group input-group">
                <input name="alto" type="text" class="form-control" placeholder="<?php echo $MULTILANG_InfAlto; ?>">
                <span class="input-group-addon">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $MULTILANG_InfTitAlto; ?>: <?php echo $MULTILANG_InfDesAlto; ?> (<?php echo $MULTILANG_InfHlpAnchoalto; ?>)"><i class="fa fa-question-circle fa-fw "></i></a>
                </span>
            </div>

            <label for="formato_final"><?php echo $MULTILANG_InfFormato; ?>:</label>
            <div class="form-group input-group">
                <select id="formato_final" name="formato_final" class="form-control" >
                    <option value="T"><?php echo $MULTILANG_TablaDatos; ?></option>
                    <option value="G"><?php echo $MULTILANG_Grafico; ?></option>
                </select>
                <span class="input-group-addon">
                    <a href="#" title="<?php echo $MULTILANG_InfTitFormato; ?>: <?php echo $MULTILANG_InfDesFormato; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                </span>
            </div>

            <label for="genera_pdf"><?php echo $MULTILANG_InfGeneraPDF; ?>:</label>
            <div class="form-group input-group">
                <select id="genera_pdf" name="genera_pdf" class="selectpicker" >
                    <option value="S"><?php echo $MULTILANG_Si; ?></option>
                    <option value="N" selected><?php echo $MULTILANG_No; ?></option>
                </select>
                <span class="input-group-addon">
                    <a href="#" title="<?php echo $MULTILANG_InfGeneraPDFInfoTit; ?>: <?php echo $MULTILANG_InfGeneraPDFInfoDesc; ?>"><i class="fa fa-exclamation-triangle icon-orange fa-fw"></i></a>
                </span>
            </div>

            <div class="form-group input-group">
                <input name="variables_filtro" type="text" class="form-control" placeholder="<?php echo $MULTILANG_InfVblesFiltro; ?>">
                <span class="input-group-addon">
                    <a href="#" title="<?php echo $MULTILANG_InfVblesDesFiltro; ?>"><i class="fa fa-question-circle fa-fw "></i></a>
                </span>
            </div>

            <label for="formulario_filtrado"><?php echo $MULTILANG_InfFormFiltrado; ?>:</label>
            <div class="form-group input-group">
                <select id="formulario_filtrado" name="formulario_filtrado" class="form-control" >
					<option value=""></option>
					<?php
						$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario ORDER BY titulo");
						while($registro_formularios = $consulta_forms->fetch())
							echo '<option value="'.$registro_formularios["id"].'">(Id.'.$registro_formularios["id"].') '.$registro_formularios["titulo"].'</option>';
					?>
                </select>
                <span class="input-group-addon">
                    <a href="#" title="<?php echo $MULTILANG_InfFormFiltradoDes; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
                </span>
            </div>

            <label for="soporte_datatable"><?php echo $MULTILANG_InfDataTableTit; ?>:</label>
            <div class="form-group input-group">
                <select id="soporte_datatable" name="soporte_datatable" class="selectpicker" >
                    <option value="S"><?php echo $MULTILANG_Si; ?></option>
                    <option value="N" selected><?php echo $MULTILANG_No; ?></option>
                </select>
                <span class="input-group-addon">
                    <a href="#" title="<?php echo $MULTILANG_Ayuda; ?>: <?php echo $MULTILANG_InfDataTableDes; ?>"><i class="fa fa-question-circle fa-fw"></i></a>
                </span>
            </div>


            </form>

            <a class="btn btn-success btn-block" href="javascript:document.datos.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_FrmCreaDisena; ?></a>
            <a class="btn btn-default btn-block" href="javascript:document.core_ver_menu.submit();"><i class="fa fa-home"></i> <?php echo $MULTILANG_IrEscritorio; ?></a>

		<?php cerrar_ventana(); ?>

        <form name="importacion" id="importacion" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="PCO_Accion" value="importar_informe">
			<?php abrir_ventana($MULTILANG_InfTituloAgr." ($MULTILANG_Avanzado)", 'panel-default'); ?>
            </form>
            <a class="btn btn-warning btn-block" href="javascript:document.importacion.submit();"><i class="fa fa-cloud-upload"></i> <?php echo $MULTILANG_FrmImportar; ?></a>
		<?php	cerrar_ventana();	?>

  </div>
  <div class="col-md-8">


<?php

		abrir_ventana($MULTILANG_InfDefinidos, 'panel-primary');
		?>
				<table class="table table-condensed btn-xs table-unbordered ">
					<thead>
                    <tr>
						<td><b>Id</b></td>
						<td><b><?php echo $MULTILANG_Titulo; ?></b></td>
						<td><b><?php echo $MULTILANG_InfCategoria; ?></b></td>
						<td></td>
						<td></td>
					</tr>
                    </thead>
                    <tbody>
		 <?php

				$consulta_forms=ejecutar_sql("SELECT id,".$ListaCamposSinID_informe." FROM ".$TablasCore."informe ORDER BY titulo");
				while($registro = $consulta_forms->fetch())
					{
						echo '<tr>
								<td><b>'.$registro["id"].'</b></td>
								<td>'.$registro["titulo"].'</td>
								<td>'.$registro["categoria"].'</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST" name="dco'.$registro["id"].'" id="dco'.$registro["id"].'">
												<input type="hidden" name="PCO_Accion" value="definir_copia_informes">
												<input type="hidden" name="informe" value="'.$registro["id"].'">
												<input type="hidden" name="titulo_informe" value="'.$registro["titulo"].'">
                                                <a class="btn btn-default btn-xs" href="javascript:confirmar_evento(\''.$MULTILANG_FrmAdvCopiar.'\',dco'.$registro["id"].');"><i class="fa fa-code-fork"></i> '.$MULTILANG_FrmCopiar.'</a>
										</form>
								</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST" name="df'.$registro["id"].'" id="df'.$registro["id"].'">
												<input type="hidden" name="PCO_Accion" value="eliminar_informe">
												<input type="hidden" name="informe" value="'.$registro["id"].'">
                                                <a class="btn btn-danger btn-xs" href="javascript:confirmar_evento(\''.$MULTILANG_InfAdvEliminar.'\',df'.$registro["id"].');"><i class="fa fa-times"></i> '.$MULTILANG_Eliminar.'</a>
										</form>
								</td>
								<td align="center">
										<form action="'.$ArchivoCORE.'" method="POST">
												<input type="hidden" name="PCO_Accion" value="editar_informe">
												<input type="hidden" name="informe" value="'.$registro["id"].'">
                                                <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-bars"></i> '.$MULTILANG_InfcamTabCond.'</button>
										</form>
								</td>
							</tr>';
					}
				echo '</tbody>
                </table>';
		?>

<?php
			cerrar_ventana();
echo '
  </div>
</div>
';
	}



/*
	Section: Operaciones de usuario final
	Funciones asociadas a la presentacion de informes para los usuarios finales de la aplicacion
*/

/* ################################################################## */
/* ################################################################## */
/*
	Function: mis_informes
	Presenta las ventanas organizando los informes por categoria segun los permisos del usuario.  Para el usuario administrador se visualizan todos los informes.

	Variables de entrada:

		PCOSESS_LoginUsuario - Identificador de usuario para filtrar los resultados

	(start code)
		SELECT COUNT(*) as conteo,categoria FROM ".$TablasCore."informe ".$Complemento_tablas." WHERE 1 ".$Complemento_condicion." GROUP BY categoria ORDER BY categoria
		Repetir por cada categoria
			SELECT * FROM ".$TablasCore."informe ".$Complemento_tablas." WHERE 1 AND categoria='".$seccion_menu_activa."' ".$Complemento_condicion." ORDER BY titulo
	(end)

	Salida:
		Listado de informes disponibles para el usuario organizados por Categoria en ventanas independientes

	Ver tambien:
	<administrar_informes>
*/
if ($PCO_Accion=="mis_informes")
	{
			// Carga las opciones del ACORDEON DE INFORMES
			echo '<div align="center"><button onclick="document.core_ver_menu.submit()" class="btn btn-warning"><i class="fa fa-home"></i> '.$MULTILANG_IrEscritorio.'</button></div><br>';
			// Si el usuario es diferente a un Administrador agrega condiciones al query
			if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
				{
					$Complemento_tablas=",".$TablasCore."usuario_informe";
					$Complemento_condicion=" AND ".$TablasCore."usuario_informe.informe=".$TablasCore."informe.id AND ".$TablasCore."usuario_informe.usuario='$PCOSESS_LoginUsuario'";  // AND nivel>0
				}
			$resultado=ejecutar_sql("SELECT COUNT(*) as conteo,categoria FROM ".$TablasCore."informe ".@$Complemento_tablas." WHERE 1 ".@$Complemento_condicion." GROUP BY categoria ORDER BY categoria");

			// Imprime las categorias encontradas para el usuario
			while($registro = $resultado->fetch())
				{
					//Crea la categoria en el acordeon
					$seccion_menu_activa=$registro["categoria"];
					$conteo_opciones=$registro["conteo"];
					abrir_ventana($MULTILANG_Informes.': '.$seccion_menu_activa.' ('.$conteo_opciones.')', 'panel-primary');
					// Busca las opciones dentro de la categoria

					// Si el usuario es diferente a un Administrador agrega condiciones al query
					if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
						{
							$Complemento_tablas=",".$TablasCore."usuario_informe";
							$Complemento_condicion=" AND ".$TablasCore."usuario_informe.informe=".$TablasCore."informe.id AND ".$TablasCore."usuario_informe.usuario='$PCOSESS_LoginUsuario'";  // AND nivel>0
						}
					$resultado_opciones_acordeon=ejecutar_sql("SELECT * FROM ".$TablasCore."informe ".@$Complemento_tablas." WHERE 1 AND categoria='".$seccion_menu_activa."' ".@$Complemento_condicion." ORDER BY titulo");

					while($registro_opciones_acordeon = $resultado_opciones_acordeon->fetch())
						{
                            //Determina si el informe es texto o grafico y cambia el icono asociado
                            $icono_informe="fa-file-text-o";
                            if($registro_opciones_acordeon["formato_final"]=="G")
                                $icono_informe="fa-pie-chart";
                            //Determina si el registro fue generado para un Administrador o un usuario estandar y genera el objeto a enlazar
                            $objeto_enlazar=$registro_opciones_acordeon["id"];
                            if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario)) $objeto_enlazar=$registro_opciones_acordeon["informe"];
                            //Presenta el enlace al informe
							echo '<div style="float:left">
									<form action="'.$ArchivoCORE.'" method="post" name="acordeinf_'.$registro_opciones_acordeon["id"].'" id="acordeinf_'.$registro_opciones_acordeon["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
                                        <table class="table table-unbordered table-hover table-condensed"><tr><td align=center>
                                            <input type="hidden" name="PCO_Accion" value="cargar_objeto">
                                            <input type="hidden" name="objeto" value="inf:'.$objeto_enlazar.':1">
                                            <a class="btn-xs" title="'.$registro_opciones_acordeon["titulo"].'" name="" href="javascript:document.acordeinf_'.$registro_opciones_acordeon["id"].'.submit();">
                                            <i class="fa '.$icono_informe.' fa-3x fa-fw"></i><br>'.$registro_opciones_acordeon["titulo"].'</a>
                                        </td></tr></table>
									</form>
								</div>';
						}
					cerrar_ventana();
				}
	}
?>
