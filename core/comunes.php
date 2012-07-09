<?php
	/*
		Title: Libreria base 
		Ubicacion *[/core/comunes.php]*.  Archivo que contiene las funciones de uso global.
	*/

/* ################################################################## */
	/*
		Section: Funciones de uso general de la herramienta
	*/
	function ventana_login()
	  {
		/*
			Function: ventana_login
			Despliega la ventana de ingreso al sistema con el formulario para usuario, contrasena y captcha.
		*/
		  global $ArchivoCORE;
			echo '
					<br><br>
					<div align="center">
					';
			abrir_ventana('Ingreso al sistema','#EADEDE','620');
			?>
						<div align="center">
						<form name="login_usuario" method="POST" action="<?php echo $ArchivoCORE; ?>" style="margin-top: 0px; margin-bottom: 0px;" onsubmit="if (document.login_usuario.captcha.value=='' || document.login_usuario.uid.value=='' || document.login_usuario.clave.value=='') { alert('Debe diligenciar los valores necesarios (Usuario, Clave y Codigo de seguridad).'); return false; }">
						<input type="Hidden" name="accion" value="Iniciar_login">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr>
								<td align="center">
										<table width="100%" border="0" cellspacing="10" cellpadding="0" class="TextosVentana" align="center">
										<tr>
											<td align="right"><font face="Verdana,Tahoma, Arial" style="font-size: 9px;">Usuario&nbsp;</td>
											<td><input type="text" name="uid" size="18" class="CampoTexto" class="keyboardInput"></td>
										</tr>
										<tr>
											<td align="right"><font face="Verdana,Tahoma, Arial" style="font-size: 9px;">Contrase&ntilde;a&nbsp;</td>
											<td><input type="password" name="clave" size="18" class="CampoTexto keyboardInput" class="keyboardInput" style="border-width: 1px; font-size: 9px; font-family: VErdana, Tahoma, Arial;"></td>
										</tr>
										<tr>
											<td align="right" valign="middle"><font face="Verdana,Tahoma, Arial" style="font-size: 9px;">Codigo de seguridad</td>
											<td valign="middle">
											<img src="core/captcha.php">
											</td>
										</tr>
										<tr>
											<td width="150" align="right" valign="middle"><font face="Verdana,Tahoma, Arial" style="font-size: 9px;">Ingrese aqui el codigo de seguridad</td>
											<td valign="middle">
											<img src="img/tango/16x16/actions/go-next.png" align="absmiddle"> <input type="text" name="captcha" size="7" maxlength=6 style="border-width: 1px; font-size: 9px; font-family: VErdana, Tahoma, Arial;">
											</td>
										</tr>
										<tr>
											<td></td>
											<td>
											<input type="image" src="img/ingresa.gif">
											</td>
										</tr>
										</table>
								</td>
								<td align="center">
										<img src="img/practico_login.png" alt="" border="0">
								</td>
						</tr></table>
						</form>
						<script language="JavaScript"> login_usuario.uid.focus(); </script>
						</div>
						
			<?php
			mensaje('Importante','El acceso a este software es exlusivo para usuarios registrados. Por su seguridad, nunca comparta su nombre de usuario y contrase&ntilde;a.','100%','../img/tango/32x32/status/dialog-information.png','TextosVentana');
			cerrar_ventana();
			echo '</div>';
	  }

/* ################################################################## */
	function ejecutar_sql_unaria($query,$param="")
	  {
		/*
			Function: ejecutar_sql_unaria
			Ejecuta consultas que no retornan registros tales como CREATE, INSERT, DELETE, UPDATE entre otros.

			Variables de entrada:

				query - Consulta preformateada para ser ejecutada en el motor
				param - Lista de parametros que deben ser preparados para el query separados por coma

			Salida:
				Retorna una cadena que contiene una descripcion de error PDO en caso de error y agrega un mensaje en pantalla con la descripcion devuelta por el driver
				Retorna una cadena vacia si la consulta es ejecutada sin problemas.
		*/
			global $ConexionPDO;
			try
				{
					$consulta = $ConexionPDO->prepare($query);
					$consulta->execute();
					return "";
				}
			catch( PDOException $ErrorPDO)
				{
					echo '<script language="JavaScript"> alert("Ha ocurrido un error interno durante la ejecucion del Query: '.$query.'\n\nEl motor ha devuelto: '.$ErrorPDO->getMessage().'.\n\nPongase en contacto con el administrador del sistema y comunique este mensaje.");  </script>';					
					//mensaje('Error durante la ejecuci&oacute;n',$ErrorPDO->getMessage(),'90%','icono_error.png','TextosEscritorio');
					return $ErrorPDO->getMessage();
				}
	  }

/* ################################################################## */
	function ejecutar_sql($query,$param="")
	  {
		/*
			Function: ejecutar_sql
			Ejecuta consultas que retornan registros (SELECTs).

			Variables de entrada:

				query - Consulta preformateada para ser ejecutada en el motor
				param - Lista de parametros que deben ser preparados para el query separados por coma
				
			Salida:
				Retorna mensaje en pantalla con la descripcion devuelta por el driver en caso de error
				Retorna una variable con el arreglo de resultados en caso de ser exitosa la consulta
		*/
			global $ConexionPDO;
			try
				{
					$consulta = $ConexionPDO->prepare($query);
					$consulta->execute();
					return $consulta;
					//return $consulta->fetchAll();
				}
			catch( PDOException $ErrorPDO)
				{
					mensaje('Error durante la ejecuci&oacute;n',$ErrorPDO->getMessage(),'90%','icono_error.png','TextosEscritorio');
					return 1;
				}
	  }

/* ################################################################## */
	function existe_valor($tabla,$campo,$valor)
	  {
		/*
			Function: existe_valor
			Busca dentro de alguna tabla para verificar si existe o no un valor determinado.  Funcion utilizada para validacion de unicidad de valores en formularios de datos.
			
			Variables de entrada:

				tabla - Nombre de la tabla donde se desea buscar.
				campo - Campo de la tabla sobre el cual se desea comparar la existencia del valor.
				valor - Valor a buscar dentro del campo.
				
			Salida:
				Retorna 1 en caso de encontrar un valor dentro de la tabla y campo especificadas y que coincida con el parametro buscado
				Retorna 0 cuando no se encuentra un valor en la tabla que coincida con el buscado
		*/
			global $ConexionPDO;
			$consulta = $ConexionPDO->prepare("SELECT $campo FROM $tabla WHERE $campo='$valor'");
			$consulta->execute();
			$registro = $consulta->fetch();
			if ($registro[0]!="")
				{
					return 1;
				}
			else
				{
					return 0;
				}
	  }

/* ################################################################## */
	function abrir_ventana($titulo,$fondo,$ancho='100%')
	  {
		 global $PlantillaActiva;
		/*
			Procedure: abrir_ventana
			Abre los espacios de trabajo dinamicos sobre el contenedor principal donde se despliega informacion

			Variables de entrada:

				titulo - Nombre de la ventana a visualizar en la parte superior.  Acepta modificadores HTML.
				fondo - Color de fondo de la ventana en formato Hexadecimal. Si no es enviado se crea transparente.
				ancho - Ancho del espacio de trabajo definido en pixels o porcentaje sobre el contenedor principal.
				
			Ver tambien:
			<cerrar_ventana>	
		*/

		echo '
			<table width="'.$ancho.'" border="0" cellspacing="0" cellpadding="0" class="EstiloVentana">
				<tr>
					<td>
							<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
									<td><img src="skin/'.$PlantillaActiva.'/img/bar_i.gif" border=0 alt=" "></td>
									<td width="100%" align="CENTER" background="skin/'.$PlantillaActiva.'/img/bar_c.jpg">
										<font face="" style="font-family: Verdana, Tahoma, Arial; font-size: 10px; color: White;"><b>
												'.$titulo.'
										</b></font>
									</td>
									<td><img src="skin/'.$PlantillaActiva.'/img/bar_d.gif " border=0 alt=""></td>
							</tr></table>
					</td>
				</tr>
				<tr>
					<td width="100%" align="CENTER">
							<table width="100%" border="1" cellspacing="0" cellpadding="0" align="center"  bgcolor="'.$fondo.'"  class="TextosVentana"><tr><td>
				';
	  }
		  
/* ################################################################## */
	function cerrar_ventana()
	  {
		/*
			Function: cerrar_ventana
			Cierra los espacios de trabajo dinamicos generados por <abrir_ventana>	

			Ver tambien:
			<abrir_ventana>	
		*/
			echo '
							</td></tr></table>
					</td>
				</tr>
			</table>
				';		  
	  }

/* ################################################################## */
	function abrir_barra_estado($alineacion="CENTER")
	  {
		 global $PlantillaActiva;
		/*
			Procedure: abrir_barra_estado
			Abre los espacios para despliegue de informacion en la parte inferior de los objetos tales como botones o mensajes

			Variables de entrada:

				alineacion - Alineacion que tendran los objetos en la barra (center, left, right).  Por defecto CENTER cuando no es recibido el parametro
				
			Ver tambien:
			<cerrar_barra_estado>	
		*/

		echo '
			<table width="100%" border="0" cellspacing="0" cellpadding="1" class="EstiloBarraEstado">
				<tr>
					<td width="100%" align="'.$alineacion.'">
				';
	  }

/* ################################################################## */
	function cerrar_barra_estado()
	  {
		/*
			Function: cerrar_barra_estado
			Cierra los espacios de trabajo dinamicos generados por <abrir_barra_estado>

			Ver tambien:
			<abrir_barra_estado>	
		*/
			echo '
					</td>
				</tr>
			</table>
				';		  
	  }

/* ################################################################## */
	function mensaje($titulo,$texto,$ancho,$icono,$estilo)
	  {
		/*
			Function: mensaje
			Funcion generica para la presentacion de mensajes.  Ver variables para personalizacion.

			Variables de entrada:

				titulo - Texto que aparece en resaltado como encabezado del texto.  Acepta modificadores HTML.
				texto - Mensaje completo a desplegar en formato de texto normal.  Acepta modificadores HTML.
				icono - Imagen que acompana el texto ubicada al lado izquierdo.  Tamano y formato libre.
				ancho - Ancho del espacio de trabajo definido en pixels o porcentaje sobre el contenedor principal.
				estilo - Especifica el punto donde sera publicado el mensaje para definir la hoja de estilos correspondiente.
		*/
		echo '<table width="'.$ancho.'" border="0" cellspacing="5" cellpadding="0" align="center" class="'.$estilo.'">
				<tr>
					<td valign="top"><img src="img/'.$icono.'" alt="" border="0">
					</td>
					<td valign="top"><strong>'.$titulo.':<br></strong>
					'.$texto.'
					</td>
				</tr>
			</table>';
	  }



/* ################################################################## */
	if ($accion=="cambiar_estado_campo")
		{		
			/*
				Function: cambiar_estado_campo
				Abre los espacios de trabajo dinamicos sobre el contenedor principal donde se despliega informacion

				Variables de entrada:

					tabla - Nombre de la tabla que contiene el registro a actualizar.
					campo - Nombre del campo que sera actualizado.
					id - Identificador unico del campo a ser actualizado.
					valor - Valor a ser asignado en el campo del registro cuyo identificador coincida con el recibido.

				Salida:

					Valor actualizado en el campo y retorno al escritorio de la aplicacion.  En caso de error se retorna al escritorio sin realizar cambios ante el fallo del query.
			*/

			$mensaje_error="";
			if ($mensaje_error=="")
				{
					ejecutar_sql_unaria("UPDATE ".$TablasCore."$tabla SET $campo = $valor WHERE id = '$id'");
					ejecutar_sql_unaria("INSERT INTO ".$TablasCore."auditoria VALUES (0,'$Id_usuario','Cambia estado del campo $campo en formulario $formulario','$fecha_operacion','$hora_operacion')");

					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="'.$accion_retorno.'">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="popup_activo" value="'.$popup_activo.'">
						<script type="" language="JavaScript">
						//setTimeout ("document.cancelar.submit();", 10); 
						document.cancelar.submit();
						</script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="accion" value="editar_formulario">
						<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
						<input type="Hidden" name="formulario" value="'.$formulario.'">
						<input type="Hidden" name="error_titulo" value="Problema en los datos ingresados">
						<input type="Hidden" name="error_descripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}
?>
