<?php
	/*
	   PCODER (Editor de Codigo en la Nube)
	   Copyright (C) 2013  John F. Arroyave Gutiérrez
						   unix4you2@gmail.com
						   www.practico.org

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

	 GENERADOR DE DIFERENCIAS ENTRE ARCHIVOS ###########################
	 Recibe variables mediante GET para presentar el Diff entre cadenas o archivos
	 PARAMETROS:
		* EstiloCSS: Nombre de la hoja de estilos a utilizar													(oscuro|claro)
		* TipoEntrada: Determina desde donde toma la entrada, por defecto archivos								(cadenas|archivos)
		* ModoVisual: Determina como presentar los resultados del diff											(ladoalado|enlinea|unificado|encontexto)
		* ArchivoViejo: Path relativo completo para leer el archivo viejo que sera comparado o cadena inicial	(por defecto asigna archivos demo)
		* ArchivoNuevo: Path relativo completo para leer el archivo frente al cual se compara o cadena final	(por defecto asigna archivos demo)
	*/

	//Determina estilo CSS
	$EstiloCSS="oscuro";
	if ($_GET["EstiloCSS"]!="") $EstiloCSS=$_GET["EstiloCSS"];
	
	//Determina tipo de entrada a procesar 
	$TipoEntrada="archivos";
	if ($_GET["TipoEntrada"]!="") $TipoEntrada=$_GET["TipoEntrada"];

	//Determina modo de visualizacion
	$ModoVisual="ladoalado";
	if ($_GET["ModoVisual"]!="") $ModoVisual=$_GET["ModoVisual"];

	//Segun el tipo de entrada procesa archivos o cadenas
	if ($TipoEntrada=="archivos")
		{
			//Carga los archivos a procesar
			$ArchivoViejo=file_get_contents(dirname(__FILE__).'/demo_limpio.txt');
			//$ArchivoViejo=file_get_contents(dirname(__FILE__).'/demo_viejo.txt');
			if ($_GET["ArchivoViejo"]!="") $ArchivoViejo=file_get_contents($_GET["ArchivoViejo"]);
			
			if ($_GET["Archivo2DesdeHistorial"]!="1")
			    {
        			$ArchivoNuevo=file_get_contents(dirname(__FILE__).'/demo_limpio.txt');
        			//$ArchivoNuevo=file_get_contents(dirname(__FILE__).'/demo_nuevo.txt');
        			if ($_GET["ArchivoNuevo"]!="") $ArchivoNuevo=file_get_contents($_GET["ArchivoNuevo"]);			        
			    }
		    else
		        {
		            //Toma el texto desde un historial de version
		            //TENER EN CUENTA QUE PARA LLEGAR AQUI SE TUVO QUE USAR LA OPCION DE INFORME EMBEBIDO.  LUEGO SE INCLUYEN LIBRERIAS DE PRACTICO
                    // Incluye archivo de configuracion de base
                    include_once '../../../../../core/configuracion.php';
                    // Inicia las conexiones con la BD y las deja listas para las operaciones
                    include_once '../../../../../core/conexiones.php';
                    // Incluye definiciones comunes de la base de datos
                    include_once '../../../../../inc/practico/def_basedatos.php';
                    // Incluye archivo con algunas funciones comunes usadas por la herramienta
                    include_once '../../../../../core/comunes.php';
                    $ArchivoNuevo=PCO_EjecutarSQL("SELECT contenido FROM core_pcoder_historial WHERE id='".$_GET["ArchivoNuevo"]."'")->fetchColumn();
		        }
		}
	if ($TipoEntrada=="cadenas")
		{
			//Asume el contenido de los archivos desde cadenas recibidas en los nombres de archivos
			$ArchivoViejo=$_GET["ArchivoViejo"];
			$ArchivoNuevo=$_GET["ArchivoNuevo"];
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
		<title>Diff: <?php echo $ModoVisual; ?></title>
		<link rel="stylesheet" href="estilo_<?php echo $EstiloCSS; ?>.css?<?php echo filemtime('estilo_'.$EstiloCSS.'.css'); ?>" type="text/css" charset="utf-8"/>
	</head>
	<body>
		<script language="JavaScript">
			//alert(document.location);		//DEPURACION: habilitar para revisar que la URL llega completa y bien
		</script>
		<?php
			// Incluye la clase diff (php-diff-1.0)
			require_once dirname(__FILE__).'/../lib/Diff.php';

			// Genera las dos cadenas a comparar separadas por saltos de linea
			$Cadena1 = explode("\n", $ArchivoViejo);
			$Cadena2 = explode("\n", $ArchivoNuevo);

			// Opciones para la generacion del Diff
			$options = array(
			);

			// Inicializa la clase y su resultado
			$diff = new Diff($Cadena1, $Cadena2, $options);
			
			//Presenta el resultado segun el tipo de visualizacion deseado
			if ($ModoVisual=="ladoalado")
				{
					require_once dirname(__FILE__).'/../lib/Diff/Renderer/Html/SideBySide.php';
					$renderer = new Diff_Renderer_Html_SideBySide;
					echo $diff->Render($renderer);
				}
			if ($ModoVisual=="enlinea")
				{
					require_once dirname(__FILE__).'/../lib/Diff/Renderer/Html/Inline.php';
					$renderer = new Diff_Renderer_Html_Inline;
					echo $diff->render($renderer);
				}
			if ($ModoVisual=="unificado")
				{
					require_once dirname(__FILE__).'/../lib/Diff/Renderer/Text/Unified.php';
					$renderer = new Diff_Renderer_Text_Unified;
					echo "<pre>".htmlspecialchars($diff->render($renderer))."</pre>";
				}
			if ($ModoVisual=="encontexto")
				{
					require_once dirname(__FILE__).'/../lib/Diff/Renderer/Text/Context.php';
					$renderer = new Diff_Renderer_Text_Context;
					echo "<pre>".htmlspecialchars($diff->render($renderer))."</pre>";
				}
		?>
	</body>
</html>