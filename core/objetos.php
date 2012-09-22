<?php
			/*
				Title: Modulo objetos
				Ubicacion *[/core/objetos.php]*.  Archivo de funciones relacionadas con las operaciones de objetos generados por la herramienta
			*/
?>

<?php



/* ################################################################## */
/* ################################################################## */
	if ($accion=="cargar_objeto")
		{
			/*
				Function: cargar_objeto
				Abre los objetos creados con practico como formularios, informes, etc.

				Variables de entrada:

					objeto - Cadena con la representacion del objeto en formato frm:xxx  inf:xxx   o similares

				Salida:

					Objeto indicado por la variable de entrada cargado en pantalla
			*/

			$mensaje_error="";

			//Divide la cadena de objeto en partes conocidas
			$partes_objeto = explode(":", $objeto);
			if ($partes_objeto[0]!="frm")
				$mensaje_error="El tipo de objeto ".$partes_objeto[0]." recibido en este comando es desconocido.";

			if ($mensaje_error=="")
				{
					//Si es un formulario lo llama con sus parámetros
					if ($partes_objeto[0]=="frm")
						{
							//Evalua si fueron enviados parametros adicionales
							if ($partes_objeto[2]!="") $en_ventana=$partes_objeto[2];
							if ($partes_objeto[3]!="") $campobase =$partes_objeto[3];
							if ($partes_objeto[4]!="") $valorbase =$partes_objeto[4];
							cargar_formulario($partes_objeto[1],$en_ventana,$campobase,$valorbase);
						}
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="Ver_menu">
						<input type="Hidden" name="error_titulo" value="Error en tiempo de ejecuci&oacute;n">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}
?>

