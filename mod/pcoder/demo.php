  _                                           _                            _ 
 | |    ___  __ _ _ __ ___   ___   _ __  _ __(_)_ __ ___   ___ _ __ ___   | |
 | |   / _ \/ _` | '_ ` _ \ / _ \ | '_ \| '__| | '_ ` _ \ / _ \ '__/ _ \  | |
 | |__|  __/ (_| | | | | | |  __/ | |_) | |  | | | | | | |  __/ | | (_) | |_|
 |_____\___|\__,_|_| |_| |_|\___| | .__/|_|  |_|_| |_| |_|\___|_|  \___/  (_)
                                  |_|                                        
                                  
1.  Este es un archivo de demostracion cargado por el editor cuando no se recibe
    un archivo especifico para ser presentado.  Utilice el boton de Abrir en la
    parte superior para cargar un archivo.
                
2.  Los archivos a editar deberian contar con los permisos correctos del lado
    del servidor para poder ser escritos o manipulados.
    
3.  Si requiere crear archivos o carpetas nuevas debera hacerlo por medio del
    administrador de archivos incluido en Practico para garantizar sus permisos,
    luego podra editarlos por medio de esta herramienta.

4.  Este editor tiene control total de los archivos (sin importar formato). Sea
    cuidadoso pues supuestamente esta herramienta está para facilitar la creación
    de nuevos módulos y codigo personalizado del lado del servidor.


  ____                   _                      __  _             _    _ 
 |  _ \  ___   __ _   __| | _ __ ___    ___    / _|(_) _ __  ___ | |_ | |
 | |_) |/ _ \ / _` | / _` || '_ ` _ \  / _ \  | |_ | || '__|/ __|| __|| |
 |  _ <|  __/| (_| || (_| || | | | | ||  __/  |  _|| || |   \__ \| |_ |_|
 |_| \_\\___| \__,_| \__,_||_| |_| |_| \___|  |_|  |_||_|   |___/ \__|(_)

1.  This is a demo file that is used by the code editor when you dont say to it
    a filename to open. You can use the Open button in the top bar to load a file
                
2.  Files to be edited should be with the correct permissions on server side to
    allow save or overwrite them.

3.  If you need to create a new file or folder then you should use the file
    manager included with Practico to be sure that all permissions over files
    are ok.  Then you could edit them here using the open file button.
    
4.  This tool has full control over your Practico files (any format).  Be
    carefull because this tool exists to do easier code edittion over new modules
    or custom code in the server side.

--------------------------------------------------------------------------------
	Copyright (C) 2015  John F. Arroyave Gutiérrez
                        PCODER - Practico CODe EditoR
						unix4you2@gmail.com

================================================================================


<?php
/*
	Function: eliminar_datos_formulario
	Elimina los datos asociados sobre las tablas de aplicacion para un registro determinado.  Esta funcion es utilizada por los botones de Eliminar registro definidos como accion en un formulario

	Salida:
		Registro eliminado de la tabla de aplicacion

	Ver tambien:
		<guardar_datos_formulario>

*/
	if ($PCO_Accion=="eliminar_datos_formulario")
		{
			$mensaje_error="";
			// Busca datos del formulario
			$consulta_formulario=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id=?","$formulario");
			$registro_formulario = $consulta_formulario->fetch();

			// Busca los campos del form marcados como valor unico y verifica que no existan valores en la tabla
			$tabla=$registro_formulario["tabla_datos"];

			$consulta_campos_unicos=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1 AND valor_unico=1","$formulario");
			while ($registro_campos_unicos = $consulta_campos_unicos->fetch())
				{
					$campo=$registro_campos_unicos["campo"];
					$valor=$$campo;
					// Busca si el campo cuenta con el valor en la tabla

					// Inserta los datos
					ejecutar_sql_unaria("DELETE FROM ".$tabla." WHERE $campo = '$valor' ");
					auditar("Elimina registro donde ".$campo." = ".$valor." en ".$tabla);
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="editar_formulario">
						<input type="Hidden" name="nombre_tabla" value="'.$tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="popup_activo" value="FormularioCampos">
                        <input type="Hidden" name="Presentar_FullScreen" value="'.@$Presentar_FullScreen.'">
                        <input type="Hidden" name="Precarga_EstilosBS" value="'.@$Precarga_EstilosBS.'">
					<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
				}

			$mensaje_error="";
			// Busca datos del formulario
			$consulta_formulario=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id=?","$formulario");
			$registro_formulario = $consulta_formulario->fetch();

			// Busca los campos del form marcados como obligatorios a los que no se les ingreso valor
			$tabla=$registro_formulario["tabla_datos"];
			$consulta_campos_obligatorios=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1 AND obligatorio=1","$formulario");
			while ($registro_campos_obligatorios = $consulta_campos_obligatorios->fetch())
				{
					$campo=$registro_campos_obligatorios["campo"];
					$valor=$$campo;
					// Verifica si es vacio para retornar el error
					if ($valor=="")
						$mensaje_error.=$MULTILANG_ErrFrmObligatorio.$campo.'<br>';
				}

			//Ejecuta consulta de actualizacion de datos
			if ($mensaje_error=="")
				{
					$cadena_nuevos_valores="";
					// Busca los campos del form y construye cadenas de valores para consulta
					$lista_campos="";
					$lista_valores="";
                    //Define los tipos de control que no son tenidos en cuenta en procesos de actualizacion
                    //Agregar el campo a la lista solamente si es de datos y si es diferente al campo ID que es usado para la actualizacion (objetos de tipo etiqueta o iframes son pasados por alto)
                    $cadena_tipos_excluidos=" AND tipo<>'etiqueta' AND tipo<>'url_iframe' AND tipo<>'informe' AND tipo<>'form_consulta' AND tipo<>'campo_etiqueta' AND tipo<>'archivo_adjunto' AND tipo<>'boton_comando' ";
					
                    $consulta_campos=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1 AND campo<>'id' $cadena_tipos_excluidos ","$formulario");
					while ($registro_campos = $consulta_campos->fetch())
						{
                            //Verifica que el campo se encuentre dentro de la tabla, para descartar campos manuales mal escritos o usados para javascripts y otros fines.
                            if (existe_campo_tabla($registro_campos["campo"],$registro_formulario["tabla_datos"]))
                                {
                                    $cadena_nuevos_valores.=$registro_campos["campo"]."='".$$registro_campos["campo"]."',";
                                }
						}
					// Elimina comas al final de las listas
					$cadena_nuevos_valores=substr($cadena_nuevos_valores, 0, strlen($cadena_nuevos_valores)-1);

					// Actualiza los datos
					ejecutar_sql_unaria("UPDATE ".$registro_formulario["tabla_datos"]." SET $cadena_nuevos_valores WHERE id=? ","$id_registro_datos");
					auditar("Actualiza registro $id_registro_datos en ".$registro_formulario["tabla_datos"]);
					echo '<script type="" language="JavaScript"> document.core_ver_menu.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<!-- <input type="Hidden" name="PCO_Accion" value="editar_formulario"> -->
						<input type="Hidden" name="PCO_Accion" value="Ver_menu">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrFrmDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
                        <input type="Hidden" name="Presentar_FullScreen" value="'.@$Presentar_FullScreen.'">
                        <input type="Hidden" name="Precarga_EstilosBS" value="'.@$Precarga_EstilosBS.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}

/*
	Function: guardar_datos_formulario
	Guarda un registro sobre la tabla de aplicacion cuando es llamada la accion de guardar datos sobre un formulario.  Tomando todos los datos del formulario construye un query valido en SQL para hacer la insercion de los datos que debieron recibirse por metodo POST desde el formulario
*/
	if ($PCO_Accion=="guardar_datos_formuassasssalario")
		{
			// POR CORREGIR:  Si el diseno cuenta con varios campos que ven hacia un mismo campo de base de datos el query no es valido

			$mensaje_error="";

			// Busca datos del formulario
			$consulta_formulario=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id=? ","$formulario");
			$registro_formulario = $consulta_formulario->fetch();

			// Busca los campos del form marcados como valor unico y verifica que no existan valores en la tabla
			$tabla=$registro_formulario["tabla_datos"];
			$consulta_campos_unicos=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1 AND valor_unico=1","$formulario");
			while ($registro_campos_unicos = $consulta_campos_unicos->fetch())
				{
					$campo=$registro_campos_unicos["campo"];
					$valor=$$campo;
					// Busca si el campo cuenta con el valor en la tabla
					$consulta_existente=ejecutar_sql("SELECT id FROM ".$tabla." WHERE $campo='$valor'");
					$registro_existente = $consulta_existente->fetch();
					if ($registro_existente["id"]!="")
						$mensaje_error.=$MULTILANG_ErrFrmDuplicado.$campo.'<br>';
				}

			// Busca los campos del form marcados como obligatorios a los que no se les ingreso valor
			$tabla=$registro_formulario["tabla_datos"];
			$consulta_campos_obligatorios=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1 AND obligatorio=1","$formulario");
			while ($registro_campos_obligatorios = $consulta_campos_obligatorios->fetch())
				{
					$campo=$registro_campos_obligatorios["campo"];
					$valor=$$campo;
					// Verifica si es vacio para retornar el error
					if ($valor=="")
						$mensaje_error.=$MULTILANG_ErrFrmObligatorio.$campo.'<br>';
				}

			//Ejecuta consulta de insercion de datos
			$errores_de_carga="";
			if ($mensaje_error=="")
				{
					// Busca los campos visibles del form y construye cadenas de valores para consulta
					$lista_campos="";
					$lista_valores="";
					$lista_valores_interrogantes="";
					$lista_valores_concatenados="";

					$consulta_campos=ejecutar_sql("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1","$formulario");
					while ($registro_campos = $consulta_campos->fetch())
						{
							//Hace la operacion con el campo solamente si es de datos (objetos de tipo etiqueta o iframes son pasados por alto)
							if ($registro_campos["tipo"]!="url_iframe" 