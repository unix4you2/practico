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
				Title: Modulo usuarios
				Ubicacion *[/core/usuarios.php]*.  Archivo de funciones relacionadas con la administracion de usuarios y permisos del sistema.
			*/
?>
<?php
			/*
				Section: Administracion de permisos
				Funciones asociadas a la gestion de permisos, roles y demas posibilidades de acceso que puedan tener los usuarios en el aplicativo.
			*/
?>
<script language="Javascript">
	function buscar_texto_en_plantilla(texto,plantilla){
	   for(i=0; i<texto.length; i++){
		  if (plantilla.indexOf(texto.charAt(i),0)!=-1){
			 return 1;
		  }
	   }
	   return 0;
	} 

	function tiene_simbolos(texto){
		return buscar_texto_en_plantilla(texto,"!#$%&*");
	} 

	function tiene_numeros(texto){
		return buscar_texto_en_plantilla(texto,"0123456789");
	} 

	function tiene_letras(texto){
		return buscar_texto_en_plantilla(texto,"abcdefghyjklmnñopqrstuvwxyz");
	} 

	function tiene_minusculas(texto){
		return buscar_texto_en_plantilla(texto,"abcdefghyjklmnñopqrstuvwxyz");
	} 

	function tiene_mayusculas(texto){
		return buscar_texto_en_plantilla(texto,"ABCDEFGHYJKLMNÑOPQRSTUVWXYZ");
	} 

/* ################################################################## */
/* ################################################################## */
/*
	Function: seguridad_clave
	Retorna un valor asociado al nivel de seguridad de la clave recibida despues de buscar ciertos caracteres sobre esta.

	Variables de entrada:

		clave - Valor del campo clave digitado por el usuario

		(start code)
				if (tiene_numeros(clave)) seguridad += 10;
				if (tiene_minusculas (clave)) seguridad += 20;
				if (tiene_mayusculas(clave)) seguridad += 20;
				if (tiene_simbolos(clave)) seguridad += 20;
				if (tiene_minusculas(clave) && tiene_mayusculas(clave)) seguridad += 30;
				if (tiene_simbolos(clave) && (tiene_mayusculas(clave) || tiene_minusculas (clave))) seguridad += 10;
				if (clave.length <= 7) seguridad -= 40;
				if (clave.length >= 8) seguridad += 10;
		(end)

	Salida:
		Valor de la variable entera llamada seguridad.
		
			Ver tambien:
				<muestra_seguridad_clave> | <PCO_CambiarContrasena>
*/
	function seguridad_clave(clave){
		var seguridad = 0;
		if (clave.length!=0)
			{
				if (tiene_numeros(clave)) seguridad += 10;
				if (tiene_minusculas (clave)) seguridad += 20;
				if (tiene_mayusculas(clave)) seguridad += 20;
				if (tiene_simbolos(clave)) seguridad += 20;
				if (tiene_minusculas(clave) && tiene_mayusculas(clave)) seguridad += 30;
				if (tiene_simbolos(clave) && (tiene_mayusculas(clave) || tiene_minusculas (clave))) seguridad += 10;
				if (clave.length <= 7) seguridad -= 40;
				if (clave.length >= 8) seguridad += 10;
			}
		if (seguridad>100) seguridad=100;
		if (seguridad<0) seguridad=0;
		return seguridad;
	}

/* ################################################################## */
/* ################################################################## */
/*
	Function: muestra_seguridad_clave
	Visualiza el valor asociado al nivel de seguridad de la clave sobre el formulario de diligenciamiento

	Variables de entrada:

		clave - Valor del campo clave digitado por el usuario
		formulario - Nombre del formulario sobre el que se actualiza el valor del campo seguridad.

		(start code)
			seguridad=seguridad_clave(clave);
			formulario.seguridad.value=seguridad;
		(end)

	Salida:
		Campo (visual del formulario) actualizado
		
	Ver tambien:
		<seguridad_clave> | <PCO_CambiarContrasena>
*/
	function muestra_seguridad_clave(clave,formulario){
		seguridad=seguridad_clave(clave);
		formulario.seguridad.value=seguridad;
	}
</script>



<?php



/* ################################################################## */
/* ################################################################## */
	if ($PCO_Accion=="PCO_GuardarPerfilUsuario")
		{
			/*
				Function: PCO_GuardarPerfilUsuario
				Actualiza la informacion del perfil de usuario en su registro

				Salida de la funcion:
					* Usuario actualizado en el sistema.

				Ver tambien:
					<PCO_ActualizarPerfilUsuario>
			*/

			//Verifica si esta o no en modo DEMO para hacer la operacion
			if ($PCO_ModoDEMO==1)
				{
					PCO_Mensaje($MULTILANG_TitDemo, $MULTILANG_MsjDemo, '', 'fa fa-fw fa-2x fa-thumbs-down', 'alert alert-dismissible alert-danger');
					echo '<div align="center"><button onclick="document.PCO_FormVerMenu.submit()" class="btn btn-warning"><i class="fa fa-home"></i> '.$MULTILANG_IrEscritorio.'</button></div><br>';
					die();
				}

			$mensaje_error="";

			// Verifica campos nulos
			if ($nombre=="" || $correo=="")
				$mensaje_error=$MULTILANG_UsrErrCrea2;

			if ($mensaje_error=="")
				{
					// Actualiza datos del usuario
					PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."usuario SET nombre=?,correo=? WHERE login='$PCOSESS_LoginUsuario' ","$nombre$_SeparadorCampos_$correo");
					PCO_Auditar("Actualiza su perfil");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_VerMenu">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_Actualizacion.': '.$MULTILANG_UsrPerfil.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$MULTILANG_ProcesoFin.'">
                        <input type="Hidden" name="PCO_ErrorIcono" value="fa-thumbs-o-up">
                        <input type="Hidden" name="PCO_ErrorEstilo" value="alert-info">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
					//echo '<script type="" language="JavaScript"> document.PCO_FormVerMenu.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_ActualizarPerfilUsuario">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}



/* ################################################################## */
/* ################################################################## */
if ($PCO_Accion=="PCO_ActualizarPerfilUsuario")
	{
        /*
            Function: PCO_ActualizarPerfilUsuario
            Presenta el formulario con los datos del usuario actual para actualizar su informacion basica

            Salida de la funcion:
                * Registro del usuario actualizado en el sistema

            Ver tambien:
                <PCO_PermisosUsuario> | <PCO_EliminarUsuario> | <PCO_CambiarEstadoUsuario> | <muestra_seguridad_clave> | <seguridad_clave>
        */
        
        //Busca datos del usuario actual
        $registro_usuario=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."usuario WHERE login=? ","$PCOSESS_LoginUsuario")->fetch();
?>

                <?php
                    //Permite cambio solamente si es admin o el motor de autenticacion es practico
                    if ($Auth_TipoMotor=="practico" || PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
                        {
                ?>

				<form name="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
					<input type="hidden" name="PCO_Accion" value="PCO_GuardarPerfilUsuario">

                    <div class="form-group input-group">
                        <span class="input-group-addon">
                            <?php echo $MULTILANG_UsrLogin; ?>:
                        </span>
                        <input readonly name="login" maxlength="250" type="text" class="form-control" value="<?php echo $PCOSESS_LoginUsuario; ?>">
                        <span class="input-group-addon">
                            <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
                            <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<?php echo $MULTILANG_UsrDesLogin; ?>"><i class="fa fa-question-circle fa-fw "></i></a>
                        </span>
                    </div>

                    <div class="form-group input-group">
                        <span class="input-group-addon">
                            <?php echo $MULTILANG_UsrNombre; ?>:
                        </span>
                        <input name="nombre"  onkeypress="return validar_teclado(event, 'alfanumerico');" maxlength="100" type="text" class="form-control" value="<?php echo $registro_usuario["nombre"]; ?>">
                        <span class="input-group-addon">
                            <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
                        </span>
                    </div>

                    <div class="form-group input-group">
                        <span class="input-group-addon">
                            <?php echo $MULTILANG_Correo; ?>:
                        </span>
                        <input name="correo" type="text" class="form-control" value="<?php echo $registro_usuario["correo"]; ?>">
                        <span class="input-group-addon">
                            <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
                            <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<b><?php echo $MULTILANG_UsrTitCorreo; ?></b><br><?php echo $MULTILANG_UsrDesCorreo; ?>"><i class="fa fa-question-circle fa-fw "></i></a>
                        </span>
                    </div>
                </form>
            <br>
                <?php
                            echo '
                                <a class="btn btn-success" href="javascript:document.datos.submit();"><i class="fa fa-floppy-o"></i> '.$MULTILANG_Actualizar.'</a>
                                <a class="btn btn-default" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-home"></i> '.$MULTILANG_IrEscritorio.'</a>';

                        }
                    else
                        {
                            PCO_Mensaje($MULTILANG_Atencion, $MULTILANG_UsrHlpNoPW.' (<b>'.$MULTILANG_TipoMotor.': '.$Auth_TipoMotor.'</b>)', '', 'fa fa-remove fa-5x texto-rojo texto-blink', 'alert alert-danger alert-dismissible');
                        }
    }


/* ################################################################## */
/* ################################################################## */
if ($PCO_Accion=="PCO_RecuperarContrasena" && $PCO_SubAccion=="establecer_nueva_contrasena")
	{
        /*
            Function: establecer_nueva_contrasena
            Establece la nueva contrasena para un usuario.

            Ver tambien:
                <PCO_RecuperarContrasena>
        */
        PCO_AbrirVentana($MULTILANG_OlvideClave, 'panel-primary');

        $PCO_MensajeError="";
		// Verifica campos nulos
		if ($clave1=="" || $clave2=="")
			$PCO_MensajeError=$MULTILANG_UsrErrPW1.".<br>";
		// Verifica contrasena diferentes
		if ($clave1 != $clave2)
			$PCO_MensajeError.=$MULTILANG_UsrErrPW2.".<br>";
		// Verifica nivel de seguridad
		if ($seguridad < 81)
			$PCO_MensajeError.=$MULTILANG_UsrErrPW3.".<br>";
        
        //Busca si realmente el usuario ha solicitado un restablecimiento de clave
        // y compara con la llave recibida para que sea correcta y no haya caducado
        $Llave_esperada="PCO".substr(strtoupper(md5($PCO_UsuarioRestablecimiento.date("u"))),5,20);
        $registro_usuario=PCO_EjecutarSQL("SELECT ".$ListaCamposSinID_usuario." FROM ".$TablasCore."usuario WHERE login=? AND llave_recuperacion=? AND llave_recuperacion=? ","$PCO_UsuarioRestablecimiento$_SeparadorCampos_$PCO_llave$_SeparadorCampos_$Llave_esperada")->fetch();
        if ($registro_usuario["login"]=="")
            $PCO_MensajeError.=$MULTILANG_ErrorDatos.".<br>";
		
        //Restablece la clave si todos los datos suministrados son correctos
        if ($PCO_UsuarioRestablecimiento!="" && $PCO_llave!="" && $PCO_MensajeError=="")
            {
				//Limpia de nuevo la llave de recuperacion
                $LlaveRecuperacion="";
                //Actualiza registros
                PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."usuario SET llave_recuperacion=? WHERE login=?","$LlaveRecuperacion$_SeparadorCampos_$PCO_UsuarioRestablecimiento");
                PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."usuario SET clave=MD5('$clave1') WHERE login=? ","$PCO_UsuarioRestablecimiento");
                PCO_Mensaje($MULTILANG_UsrResetCuenta,$MULTILANG_UsrResetOK,'','fa fa-unlock-alt fa-4x','alert alert-info alert-dismissible');
                PCO_Auditar("Restablece clave de acceso desde $PCO_DireccionAuditoria",$PCO_UsuarioRestablecimiento);
            }
        else
            {
                PCO_Mensaje($MULTILANG_Error,$PCO_MensajeError,'','fa fa-exclamation-triangle fa-4x','alert alert-danger alert-dismissible');
            }
        echo '<a class="btn btn-default btn-warning" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-arrow-circle-left"></i> '.$MULTILANG_Regresar.'</a>';
        PCO_CerrarVentana();
    }


/* ################################################################## */
/* ################################################################## */
if ($PCO_Accion=="PCO_RecuperarContrasena" && $PCO_SubAccion=="ingresar_clave_nueva")
	{
        /*
            Function: ingresar_clave_nueva
            Presenta formulario para el ingreso de la nueva clave de usuario

            Ver tambien:
                <establecer_nueva_contrasena>
        */
?>
			<form name="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<?php
				PCO_Mensaje($MULTILANG_Importante,$MULTILANG_UsrDesPW,'60%','fa fa-exclamation-triangle fa-5x','TextosEscritorio');

                //Continua las Banderas recibidas para el tipo de carga de contenido
                if (@$Presentar_FullScreen==1)  echo '<input type="Hidden" name="Presentar_FullScreen" value="1">';
                if (@$Precarga_EstilosBS==1)    echo '<input type="Hidden" name="Precarga_EstilosBS" value="1">';
			?>
                <input type="hidden" name="PCO_Accion" value="PCO_RecuperarContrasena">
                <input type="hidden" name="PCO_SubAccion" value="establecer_nueva_contrasena">
                <input type="hidden" name="PCO_UsuarioRestablecimiento" value="<?php echo $usuario?>">
                <input type="hidden" name="PCO_llave" value="<?php echo $llave?>">
                <br><font face="" size="3" color="Navy"><b><?php echo $MULTILANG_UsrCambioPW; ?></b></font>

                <div class="form-group input-group">
                    <span class="input-group-addon">
                        <?php echo $MULTILANG_UsrNuevoPW; ?>:
                    </span>
                    <input name="clave1"   onkeyup="muestra_seguridad_clave(this.value, this.form)" type="password" class="form-control" placeholder="<?php echo $MULTILANG_Contrasena; ?>">
                    <span class="input-group-addon">
                        <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
                    </span>
                    <span class="input-group-addon">
                        <?php echo $MULTILANG_UsrNivelPW; ?>:
                    </span>
                    <input id="seguridad" value="0" size="3" name="seguridad" class="form-control" type="text" readonly onfocus="blur()">
                    <span class="input-group-addon">
                        %
                    </span>
                </div>

                <div class="form-group input-group">
                    <span class="input-group-addon">
                        <?php echo $MULTILANG_UsrVerificaPW; ?>:
                    </span>
                    <input name="clave2" type="password" class="form-control" placeholder="<?php echo $MULTILANG_Contrasena; ?> (Confirma)">
                    <span class="input-group-addon">
                        <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
                    </span>
                </div>            

            </form>
            <div align=center>
                <hr>
                <?php
                    //Permite cambio solamente si es admin o el motor de autenticacion es practico
                    if ($Auth_TipoMotor=="practico" || PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
                        {
                            echo '<a class="btn btn-success" href="javascript:document.datos.submit();"><i class="fa fa-floppy-o"></i> '.$MULTILANG_Actualizar.'</a>';
                        }
                    else
                        {
                            echo '<br><h4>'.$MULTILANG_Importante.': '.$MULTILANG_UsrHlpNoPW.' ('.$Auth_TipoMotor.')</h4>';
                        }
                ?>
            </div>
<?php
    }



/* ################################################################## */
/* ################################################################## */
if ($PCO_Accion=="PCO_RecuperarContrasena" && $PCO_SubAccion=="enviar_correo_llave")
	{
        /*
            Function: enviar_correo_llave
            Envia un correo para un usuario con un enlace de restablecimiento de contrasena

            Ver tambien:
                <PCO_RecuperarContrasena>
        */
		PCO_AbrirVentana($MULTILANG_OlvideClave, 'panel-primary');
        //Busca si realmente hay un usuario registrado con ese login y le envia el mensaje
        if (PCO_ExisteValor($TablasCore."usuario","login",$usuario) && $usuario!="")
            {
                //Busca los datos del usuario
                $registro=PCO_EjecutarSQL("SELECT $ListaCamposSinID_usuario FROM ".$TablasCore."usuario WHERE login=?","$usuario")->fetch();
				//Genera la llave unica de recuperacion y la lleva al usuario
                $LlaveRecuperacion="PCO".substr(strtoupper(md5($usuario.date("u"))),5,20);
                PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."usuario SET llave_recuperacion=? WHERE login=?","$LlaveRecuperacion$_SeparadorCampos_$usuario");

                //Genera el enlace de recuperacion
                // Determina si la conexion actual de Practico esta encriptada
                if(empty($_SERVER["HTTPS"]))
                    $EnlaceRecuperacion="http://";
                else
                    $EnlaceRecuperacion="https://";
                $EnlaceRecuperacion.=$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['PHP_SELF'];
                $EnlaceRecuperacion.="?PCO_Accion=PCO_RecuperarContrasena&PCO_SubAccion=ingresar_clave_nueva&usuario=$usuario&llave=".$LlaveRecuperacion;
                //Datos para el correo
                $cuenta_destinatario="___".substr($registro["correo"],3,strlen($registro["correo"])-6)."_____";
                $remitente=$registro["correo"];
                $destinatario=$registro["correo"];
                $asunto="[".$NombreRAD."] ".$MULTILANG_UsrAsuntoReset;
                $cuerpo_mensaje="<br><br>".$MULTILANG_UsrResetLink.":<br><b><a href=$EnlaceRecuperacion>$EnlaceRecuperacion</a></b>";
                PCO_EnviarCorreo($remitente,$destinatario,$asunto,$cuerpo_mensaje);
                PCO_Mensaje("$MULTILANG_UsrResetCuenta: $cuenta_destinatario",$MULTILANG_UsrMensajeReset,'','fa fa-unlock-alt fa-4x','alert alert-info alert-dismissible');
            }
        else
            {
                PCO_Mensaje($MULTILANG_Error,$MULTILANG_UsrErrorReset,'','fa fa-exclamation-triangle fa-4x','alert alert-danger alert-dismissible');
            }
        echo '<a class="btn btn-default btn-warning" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-arrow-circle-left"></i> '.$MULTILANG_Regresar.'</a>';
        PCO_CerrarVentana();
    }



/* ################################################################## */
/* ################################################################## */
if ($PCO_Accion=="PCO_RecuperarContrasena" && $PCO_SubAccion=="enviar_correo_con_usuario")
	{
        /*
            Function: enviar_correo_con_usuario
            Busca un usuario por su correo electronico y le hace llegar su nombre de usuario al correo

            Ver tambien:
                <PCO_RecuperarContrasena> | <enviar_correo_llave>
        */
		PCO_AbrirVentana($MULTILANG_OlvideClave, 'panel-info');
        //Busca si realmente hay un usuario registrado con ese correo y le envia el mensaje
        if (PCO_ExisteValor($TablasCore."usuario","correo",$correo) && $correo!="")
            {
                //Busca los datos del usuario y los envia al correo registrado
                $registro=PCO_EjecutarSQL("SELECT $ListaCamposSinID_usuario FROM ".$TablasCore."usuario WHERE correo=?","$correo")->fetch();
				
                $remitente=$registro["correo"];
                $destinatario=$registro["correo"];
                $asunto="[".$NombreRAD."] ".$MULTILANG_UsrAsuntoReset;
                $cuerpo_mensaje="<br><br>".$MULTILANG_Usuario." ".$NombreRAD.": <b>".$registro["login"]."</b>";
                PCO_EnviarCorreo($remitente,$destinatario,$asunto,$cuerpo_mensaje);
                PCO_Mensaje($MULTILANG_Atencion,$MULTILANG_UsrMensajeReset,'','fa fa-unlock-alt fa-4x','alert alert-info alert-dismissible');
            }
        else
            {
                PCO_Mensaje($MULTILANG_Error,$MULTILANG_UsrErrorReset,'','fa fa-exclamation-triangle fa-4x','alert alert-danger alert-dismissible');
            }
        echo '<a class="btn btn-default btn-warning" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-arrow-circle-left"></i> '.$MULTILANG_Regresar.'</a>';
        PCO_CerrarVentana();
    }



/* ################################################################## */
/* ################################################################## */
if ($PCO_Accion=="PCO_RecuperarContrasena" && $PCO_SubAccion=="formulario_recuperacion")
	{
        /*
            Function: formulario_recuperacion
            Presenta el formulario para recuperacion de contrasenas

            Ver tambien:
                <PCO_RecuperarContrasena>
        */
		PCO_AbrirVentana($MULTILANG_OlvideClave, 'panel-info');
        PCO_Mensaje($MULTILANG_Importante,$MULTILANG_UsrResetAdmin,'','fa fa-key fa-4x','alert alert-info alert-dismissible');
?>
                <?php echo $MULTILANG_Opcion; ?> <span class="badge">1</span>
				<form name="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
					<input type="hidden" name="PCO_Accion" value="PCO_RecuperarContrasena">
                    <input type="hidden" name="PCO_SubAccion" value="enviar_correo_llave">
                    <label for="usuario"><?php echo $MULTILANG_UsrOlvideClave; ?>:</label>
                    <div class="form-group input-group">
                        <span class="input-group-addon">
                            <?php echo $MULTILANG_UsrIngreseUsuario; ?>:
                        </span>
                        <input id="usuario" name="usuario" maxlength="250" type="text" class="form-control">
                        <span class="input-group-addon">
                            <button type="submit" class="btn btn-info btn-xs"><?php echo $MULTILANG_Continuar; ?> <i class="fa fa-arrow-circle-right"></i></button>
                        </span>
                    </div>
                </form>
                
                <hr>
                <?php echo $MULTILANG_Opcion; ?> <span class="badge">2</span>
				<form name="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
					<input type="hidden" name="PCO_Accion" value="PCO_RecuperarContrasena">
                    <input type="hidden" name="PCO_SubAccion" value="enviar_correo_con_usuario">
                    <label for="correo"><?php echo $MULTILANG_UsrOlvideUsuario; ?>:</label>
                    <div class="form-group input-group">
                        <span class="input-group-addon">
                            <?php echo $MULTILANG_UsrIngreseCorreo; ?>:
                        </span>
                        <input id="correo" name="correo" maxlength="250" type="text" class="form-control">
                        <span class="input-group-addon">
                            <button type="submit" class="btn btn-info btn-xs"><?php echo $MULTILANG_Continuar; ?> <i class="fa fa-arrow-circle-right"></i></button>
                        </span>
                    </div>
                </form>

		 <?php
            echo '<br><br><a class="btn btn-default btn-warning" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-arrow-circle-left"></i> '.$MULTILANG_Regresar.'</a>';
            PCO_CerrarVentana();
    }


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_CopiarInformes
	Elimina los permisos definidos en informes para un usuario y los reemplaza  con los permisos definidos actualmente para otro usuario

	Variables de entrada:

		usuariod - Usuario destino (al que seran copiados los informes)
		usuarioo - Usuario oorigen (del que se toman los permisos de informes como base para ser copiados)

	Salida:
		Informes del usuario destino actualizados

	Ver tambien:
		<PCO_PermisosUsuario> | <PCO_InformesUsuario>
*/
if ($PCO_Accion=="PCO_CopiarInformes")
	{
		PCO_CopiarInformes($usuarioo,$usuariod);
		PCO_Auditar("Copia informes de $usuarioo al usuario $usuariod");
		echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
			<input type="Hidden" name="PCO_Accion" value="PCO_InformesUsuario">
			<input type="Hidden" name="usuario" value="'.$usuariod.'">
			</form>
			<script type="" language="JavaScript">
			alert("'.$MULTILANG_UsrCopia.'");
			document.cancelar.submit();  </script>';
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_CopiarPermisos
	Llama a la funcion interna de copia de permisos

	Variables de entrada:

		usuariod - Usuario destino (al que seran copiados los permisos)
		usuarioo - Usuario oorigen (del que se toman los permisos como base para ser copiados)

	Ver tambien:
		<PCO_PermisosUsuario> | <PCO_InformesUsuario>
*/
if ($PCO_Accion=="PCO_CopiarPermisos")
	{
		PCO_CopiarPermisos($usuarioo,$usuariod);
		PCO_Auditar("Copia permisos de $usuarioo al usuario $usuariod");
		echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
			<input type="Hidden" name="PCO_Accion" value="PCO_PermisosUsuario">
			<input type="Hidden" name="usuario" value="'.$usuariod.'">
			</form>
			<script type="" language="JavaScript">
			alert("'.$MULTILANG_UsrCopia.'");
			document.cancelar.submit();  </script>';
	} 


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_CambiarContrasena
	Presenta formulario para actualizar la clave de un usuario

	Salida:
		Variables pasadas a la accion <PCO_ActualizarContrasena>

	Ver tambien:
		<PCO_ActualizarContrasena>

*/
if ($PCO_Accion=="PCO_CambiarContrasena")
	{
        //Permite cambio solamente si es admin o el motor de autenticacion es practico
        if ($Auth_TipoMotor=="practico" || PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
            PCO_CargarFormulario("-18",1);
        else
            PCO_Mensaje($MULTILANG_Atencion, $MULTILANG_UsrHlpNoPW.' (<b>'.$MULTILANG_TipoMotor.': '.$Auth_TipoMotor.'</b>)', '', 'fa fa-remove fa-5x texto-rojo texto-blink', 'alert alert-danger alert-dismissible');
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_ActualizarContrasena
	Actualiza la clave de un usuario determinado

	Variables de entrada:

		PCOSESS_LoginUsuario - Variable de sesion con el UID/Login de usuario al que se desea actualizar la clave
		clave1 y clave2 - Valores ingresados para la nueva contrasena
		seguridad - Nivel de seguridad calculado para la contrasena

		(start code)
			"UPDATE ".$TablasCore."usuario SET clave=MD5('$clave1') WHERE login='$PCOSESS_LoginUsuario'"
		(end)

	Salida:
		Tabla de usuarios actualizada en el registro correspondiente
*/
if ($PCO_Accion=="PCO_ActualizarContrasena")
	{

		//Verifica si esta o no en modo DEMO para hacer la operacion
		if ($PCO_ModoDEMO==1)
			{
				PCO_Mensaje($MULTILANG_TitDemo, $MULTILANG_MsjDemo, '', 'fa fa-fw fa-2x fa-thumbs-down', 'alert alert-dismissible alert-danger');
				echo '<div align="center"><button onclick="document.PCO_FormVerMenu.submit()" class="btn btn-warning"><i class="fa fa-home"></i> '.$MULTILANG_IrEscritorio.'</button></div><br>';
				die();
			}

		$mensaje_error="";
        //Verifica que la contrasena actual recibida si sea
    	$ClaveEnMD5=hash("md5", $clave0);
    	$LoginValido=PCO_EjecutarSQL("SELECT login FROM ".$TablasCore."usuario WHERE estado=1 AND login='$PCOSESS_LoginUsuario' AND clave='$ClaveEnMD5' ")->fetchColumn();
		if ($LoginValido=="")
			$mensaje_error=$MULTILANG_UsrErrPW4.".<br>";
		// Verifica campos nulos
		if ($clave1=="" || $clave2=="")
			$mensaje_error=$MULTILANG_UsrErrPW1.".<br>";
		// Verifica contrasena diferentes
		if ($clave1 != $clave2)
			$mensaje_error.=$MULTILANG_UsrErrPW2.".<br>";
		// Verifica nivel de seguridad
		if ($seguridad < 81)
			$mensaje_error.=$MULTILANG_UsrErrPW3.".<br>";

		if ($mensaje_error=="")
			{
				PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."usuario SET clave=MD5('$clave1') WHERE login=? ","$PCOSESS_LoginUsuario");
				PCO_Auditar("Actualiza clave de acceso");
				echo '<script language="javascript"> document.PCO_FormVerMenu.submit(); </script>';
			}
		else
			{
				echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="PCO_CambiarContrasena">
					<input type="Hidden" name="Presentar_FullScreen" value="'.@$Presentar_FullScreen.'">
					<input type="Hidden" name="Precarga_EstilosBS" value="'.@$Precarga_EstilosBS.'">
					<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
					<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
					</form>
					<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
			}
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_EliminarInformeUsuario
	Elimina un informe a un usuario determinado.

	Variables de entrada:

		usuario - UID/Login de usuario al que se desea eliminar el permiso
		informe - ID del informe que se desea eliminar del perfil del usuario

		(start code)
			DELETE FROM usuario_informe WHERE informe=$informe AND usuario='$usuario'
		(end)

	Salida:
		Tabla de permisos actualizada al eliminar el registro correspondiente
	
	Ver tambien:
		<PCO_InformesUsuario> | <PCO_AgregarInformeUsuario>
*/
if ($PCO_Accion=="PCO_EliminarInformeUsuario")
	{
		// Elimina el informe
		PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."usuario_informe WHERE informe=? AND usuario=? ","$informe$_SeparadorCampos_$usuario");
		PCO_Auditar("Elimina informe $informe a $usuario");
		echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="PCO_Accion" value="PCO_InformesUsuario"><input type="Hidden" name="usuario" value="'.$usuario.'"></form>
				<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_AgregarInformeUsuario
	Agrega un informe definido en el sistema a un usuario determinado.

	Variables de entrada:

		usuario - UID/Login de usuario al que se desea agregar el permiso
		informe - ID del informe que se desea agregar al perfil del usuario

		(start code)
			SELECT * FROM ".$TablasCore."usuario_informe WHERE usuario='$usuario' AND informe='$informe'
			INSERT INTO ".$TablasCore."usuario_informe VALUES (0,'$usuario','$informe')
		(end)

	Salida:
		Tabla de permisos actualizada al agregar el registro correspondiente

	Ver tambien:
		<PCO_EliminarInformeUsuario> | <PCO_InformesUsuario>
*/
	if ($PCO_Accion=="PCO_AgregarInformeUsuario")
		{
			$mensaje_error="";
			// Busca si existe ese permiso para el usuario
			$resultado=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_usuario_informe." FROM ".$TablasCore."usuario_informe WHERE usuario=? AND informe=? ","$usuario$_SeparadorCampos_$informe");
			$registro_menu = $resultado->fetch();
			if($registro_menu["informe"]!="")
				$mensaje_error=$MULTILANG_UsrErrInf;

			if ($mensaje_error=="")
				{
					// Guarda el permiso para el usuario
					PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."usuario_informe (".$ListaCamposSinID_usuario_informe.") VALUES (?,?)","$usuario$_SeparadorCampos_$informe");
					PCO_Auditar("Agrega informe $informe al usuario $usuario");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
							<input type="Hidden" name="PCO_Accion" value="PCO_InformesUsuario">
							<input type="Hidden" name="usuario" value="'.$usuario.'">
							</form>
							<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="PCO_Accion" value="PCO_InformesUsuario"><input type="Hidden" name="usuario" value="'.$usuario.'"></form>
							<script type="" language="JavaScript"> 
							window.alert("'.$mensaje_error.'");
							document.cancelar.submit();  </script>';
				}
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_InformesUsuario
	Despliega una lista con los informes definidos para un usuario determinado con la posibilidad de agregar mas informes

	Variables de entrada:

		usuario - UID/Login de usuario al que se desea agregar el permiso

		(start code)
			SELECT ".$TablasCore."informe.* FROM ".$TablasCore."informe WHERE nivel_usuario<=".$Nivel_usuario
			SELECT ".$TablasCore."informe.* FROM ".$TablasCore."informe,".$TablasCore."usuario_informe WHERE ".$TablasCore."usuario_informe.informe=".$TablasCore."informe.id AND ".$TablasCore."usuario_informe.usuario='$usuario'
		(end)

	Salida:
		Listado de informes disponibles en el perfil del usuario

	Ver tambien:
		<PCO_EliminarInformeUsuario> | <PCO_AgregarInformeUsuario>
*/
if ($PCO_Accion=="PCO_InformesUsuario")
    {
        PCO_AbrirVentana($MULTILANG_UsrAdmInf,'panel-info');
?>
			<form name="salto" action="<?php echo $ArchivoCORE; ?>" method="POST">
                <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
                <input type="hidden" name="PCO_Accion" value="PCO_PermisosUsuario">
            </form>
            
			<form name="datoscopia" id="datoscopia"  action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="hidden" name="usuariod" value="<?php echo $usuario; ?>">
			<input type="hidden" name="PCO_Accion" value="PCO_CopiarInformes">

			<font face="" size="3" color="#971515"><b><?php echo $MULTILANG_UsrCopiaPer; ?>: </b></font>
				<select name="usuarioo" class="selectpicker " data-live-search=true data-size=5 data-style="btn btn-default btn-xs ">
						<option value=""><?php echo $MULTILANG_UsrDelPer; ?></option>
						<?php
							$resultado=PCO_EjecutarSQL("SELECT login FROM ".$TablasCore."usuario WHERE login<>? ORDER BY login","$usuario");
							while($registro = $resultado->fetch())
								{
									echo '<option value="'.$registro["login"].'">'.$registro["login"].'</option>';
								}
						?>
				</select>
					<input type="Button" name="" value="<?php echo $MULTILANG_Ejecutar; ?>" class="btn btn-xs btn-danger" onClick="document.datoscopia.submit()">
			</form><hr>

			<form name="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
                <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
                <input type="hidden" name="PCO_Accion" value="PCO_AgregarInformeUsuario">
                <font face="" size="3" color="Navy"><b><?php echo $MULTILANG_UsrAgreInf; ?>: <?php echo $usuario; ?></b></font>
                <br>
				<select name="informe"  class="selectpicker " data-live-search=true data-size=10 data-style="btn btn-default btn-xs ">
					<?php
						//Despliega opciones de informes para agregar, aunque solamente las que este por debajo del perfil del usuario
						//No se permite agregar opciones por encima del perfil actual del usuario
						$resultado=PCO_EjecutarSQL("SELECT ".$TablasCore."informe.* FROM ".$TablasCore."informe WHERE id>=0 ");
						while($registro = $resultado->fetch())
							{
								echo '<option  data-icon="glyphicon glyphicon-list-alt fa-fw"  value="'.$registro["id"].'">'.$registro["titulo"].'</option>';
							}
					?>
				</select>
                <button class="btn btn-success btn-xs"  onClick="document.datos.submit()"><i class="fa fa-plus fa-fw"></i> <?php echo $MULTILANG_Agregar; ?></button>
				<br><br>
                <a href="javascript:document.PCO_FormVerMenu.submit();" class="btn btn-default btn-xs"><i class="fa fa-home"></i> <?php echo $MULTILANG_FrmAccionRegresar; ?></a>
                <a id="btn_salto_permisos" href="javascript:document.salto.submit();" class="btn btn-warning btn-xs"><i class="fa fa-external-link-square"></i> <?php echo $MULTILANG_UsrSaltarMenues; ?></a>

            </form>
        <hr>
		<font face="" size="3" color="Navy"><b><?php echo $MULTILANG_UsrInfDisp; ?></b></font>
		<?php
			echo '
			<table class="table table-responsive btn-xs table-unbordered table-hover">
				<thead>
                <tr>
					<th><b>ID</b></th>
					<th><b>'.$MULTILANG_Titulo.'</b></th>
					<th><b>'.$MULTILANG_InfCategoria.'</b></th>
					<th></th>
				</tr>
                </thead>
                <tbody>
                ';

			$resultado=PCO_EjecutarSQL("SELECT ".$TablasCore."informe.* FROM ".$TablasCore."informe,".$TablasCore."usuario_informe WHERE ".$TablasCore."usuario_informe.informe=".$TablasCore."informe.id AND ".$TablasCore."usuario_informe.usuario=? ","$usuario");
			while($registro = $resultado->fetch())
				{
					echo '<tr>
							<td>'.$registro["id"].'</td>
							<td><strong>'.$registro["titulo"].'</strong></td>
							<td>'.$registro["categoria"].'</td>
							<td align="center">
									<form action="'.$ArchivoCORE.'" method="POST" name="f'.$registro["id"].'" id="f'.$registro["id"].'">
											<input type="hidden" name="PCO_Accion" value="PCO_EliminarInformeUsuario">
											<input type="hidden" name="usuario" value="'.$usuario.'">
											<input type="hidden" name="informe" value="'.$registro["id"].'">
                                            <a  href="javascript:confirmar_evento(\''.$MULTILANG_UsrAdvDel.'\',f'.$registro["id"].');" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> '.$MULTILANG_Eliminar.'</a>
									</form>
							</td>
						</tr>';
				}
			echo '</tbody>
            </table>';

        PCO_CerrarVentana();
	}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_EliminarPermiso
	Elimina un permiso a un usuario determinado.

	Variables de entrada:

		usuario - UID/Login de usuario al que se desea eliminar el permiso
		menu - ID del menu que se desea eliminar del perfil del usuario

		(start code)
			DELETE FROM usuario_menu WHERE menu=$menu AND usuario='$usuario'
		(end)

	Salida:
		Tabla de permisos actualizada al eliminar el registro correspondiente
	
	Ver tambien:
		<PCO_AgregarPermiso>
*/
if ($PCO_Accion=="PCO_EliminarPermiso")
	{
	    //Divide las partes recibidas
	    $PartesCampos=explode("|",$PCO_Valor);
	    $menu=$PartesCampos[0];
	    $usuario=$PartesCampos[1];
		// Elimina los datos de la opcion
		PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."usuario_menu WHERE menu=? AND usuario=? ","$menu$_SeparadorCampos_$usuario");
		PCO_Auditar("Elimina permiso $menu a $usuario");

		echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="PCO_Accion" value="PCO_PermisosUsuario"><input type="Hidden" name="usuario" value="'.$usuario.'"></form>
				<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
	}



/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_AgregarPermiso
	Agrega un permiso a un usuario determinado.

	Variables de entrada:

		usuario - UID/Login de usuario al que se desea agregar el permiso
		menu - ID del menu que se desea agregar del perfil del usuario

		(start code)
			SELECT * FROM ".$TablasCore."usuario_menu WHERE usuario='$usuario' AND menu='$menu'
			INSERT INTO ".$TablasCore."usuario_menu VALUES (0,'$usuario','$menu')
		(end)

	Salida:
		Tabla de permisos actualizada al agregar el registro correspondiente
	
	Ver tambien:
		<PCO_EliminarPermiso>
*/
	if ($PCO_Accion=="PCO_AgregarPermiso")
		{
			$mensaje_error="";
			// Busca si existe ese permiso para el usuario
			$resultado=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_usuario_menu." FROM ".$TablasCore."usuario_menu WHERE usuario=? AND menu=? ","$usuario$_SeparadorCampos_$menu");
			$registro_menu = $resultado->fetch();
			if($registro_menu["menu"]!="")
				$mensaje_error=$MULTILANG_UsrErrInf;

			if ($mensaje_error=="")
				{
					// Guarda el permiso para el usuario
					PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."usuario_menu (".$ListaCamposSinID_usuario_menu.") VALUES (?,?)","$usuario$_SeparadorCampos_$menu");
					PCO_Auditar("Agrega permiso $menu al usuario $usuario");
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
							<input type="Hidden" name="PCO_Accion" value="PCO_PermisosUsuario">
							<input type="Hidden" name="usuario" value="'.$usuario.'">
							</form>
							<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="PCO_Accion" value="PCO_PermisosUsuario"><input type="Hidden" name="usuario" value="'.$usuario.'"></form>
							<script type="" language="JavaScript"> 
							window.alert("'.$mensaje_error.'");
							document.cancelar.submit();  </script>';
				}
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_PermisosUsuario
	Despliega una lista con las opciones de menu definidas para un usuario determinado con la posibilidad de agregar o eliminar

	Variables de entrada:

		usuario - UID/Login de usuario al que se desea agregar el permiso

	Salida:
		Listado de opciones de menu disponibles en el perfil del usuario

	Ver tambien:
		<PCO_InformesUsuario>
*/
if ($PCO_Accion=="PCO_PermisosUsuario")
    {
        PCO_AbrirVentana($MULTILANG_UsrAdmPer, 'panel-info');
?>
			<form name="salto" action="<?php echo $ArchivoCORE; ?>" method="POST">
                <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
                <input type="hidden" name="PCO_Accion" value="PCO_InformesUsuario">
            </form>

			<form name="datoscopia" id="datoscopia"  action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="hidden" name="usuariod" value="<?php echo $usuario; ?>">
			<input type="hidden" name="PCO_Accion" value="PCO_CopiarPermisos">

			<font face="" size="3" color="#971515"><b><?php echo $MULTILANG_UsrCopiaPer; ?>: </b></font>
				<select name="usuarioo" class="selectpicker " data-live-search=true data-size=5 data-style="btn btn-default btn-xs ">
						<option value=""><?php echo $MULTILANG_UsrDelPer; ?></option>
						<?php
							$resultado=PCO_EjecutarSQL("SELECT login FROM ".$TablasCore."usuario WHERE login<>? ORDER BY login","$usuario");
							while($registro = $resultado->fetch())
								{
									echo '<option value="'.$registro["login"].'">'.$registro["login"].'</option>';
								}
						?>
				</select>
					<input type="Button" name="" value="<?php echo $MULTILANG_Ejecutar; ?>" class="btn btn-xs btn-danger" onClick="document.datoscopia.submit()">
			</form><hr>

			<form name="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
                <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
                <input type="hidden" name="PCO_Accion" value="PCO_AgregarPermiso">
                <font face="" size="3" color="Navy"><b><?php echo $MULTILANG_UsrAgreOpc; ?>: <?php echo $usuario; ?></b></font>
				<br>
                <select name="menu"  class="selectpicker " data-live-search=true data-size=10 data-style="btn btn-default btn-xs ">
					<?php
						//Despliega opciones de menu para agregar, Solamente las que no pertenecen a formularios
						$resultado=PCO_EjecutarSQL("SELECT ".$TablasCore."menu.* FROM ".$TablasCore."menu WHERE (padre=0 OR padre='') AND formulario_vinculado=0 ");
						while($registro = $resultado->fetch())
							{
								echo '<option data-icon="'.$registro["imagen"].' fa-fw" value="'.$registro["hash_unico"].'">'.$registro["texto"].'</option>';
								//Busca posibles opciones de segundo nivel y las agrega
								$resultadohijas=PCO_EjecutarSQL("SELECT ".$TablasCore."menu.* FROM ".$TablasCore."menu WHERE (padre='".$registro["hash_unico"]."') AND formulario_vinculado=0 ");
								if ($resultadohijas->rowCount()>0)
								    echo '<optgroup label="Opciones de/Childs of: '.$registro["texto"].'">';
        						while($registrohija = $resultadohijas->fetch())
        							{
        								echo '<option data-icon="'.$registrohija["imagen"].' fa-fw" value="'.$registrohija["hash_unico"].'">'.$registrohija["texto"].'</option>';
        							}
								if ($resultadohijas->rowCount()>0)
								    echo '</optgroup>';
							}
					?>
				</select>
                <button class="btn btn-success btn-xs"  onClick="document.datos.submit()"><i class="fa fa-plus fa-fw"></i> <?php echo $MULTILANG_Agregar; ?></button>
				<br><br>
                <a href="javascript:document.PCO_FormVerMenu.submit();" class="btn btn-default btn-xs"><i class="fa fa-home"></i> <?php echo $MULTILANG_FrmAccionRegresar; ?></a>
                <a id="btn_salto_permisos" href="javascript:document.salto.submit();" class="btn btn-warning btn-xs"><i class="fa fa-external-link-square"></i> <?php echo $MULTILANG_UsrSaltarInformes; ?></a>
            </form>
            <hr>

<?php
		PCO_CargarInforme(-30,1,"","",1);

        PCO_CerrarVentana();
    }



/* ################################################################## */
/* ################################################################## */
			/*
				Section: Operaciones basicas de administracion
				Funciones asociadas al mantenimiento de la informacion de usuarios: Adicion, edicion, eliminacion, cambios de estado.
			*/
/* ################################################################## */
/* ################################################################## */
	if ($PCO_Accion=="PCO_EliminarUsuario")
		{
			/*
				Function: PCO_EliminarUsuario
				Elimina completamente un usuario del sistema.   Tambien elimina todos los permisos que puedan haber sido definidos para el.

				Variables minimas de entrada:
					uid_especifico - Login del usuario

				Proceso simplificado:
					(start code)
						DELETE FROM ".$TablasCore."usuario WHERE login='$uid_especifico'
						DELETE FROM ".$TablasCore."usuario_menu WHERE usuario='$uid_especifico'
					(end)

				Salida de la funcion:
					* Tabla de usuarios actualizada al eliminar el registro asociado

				Ver tambien:
					<PCO_AgregarUsuario> | <PCO_CambiarEstadoUsuario>
			*/
			PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."usuario WHERE login=? ","$uid_especifico");
			PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."usuario_menu WHERE usuario=? ","$uid_especifico");
			PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."usuario_informe WHERE usuario=? ","$uid_especifico");
			PCO_Auditar("Elimina el usuario $uid_especifico");
			echo '<script type="" language="JavaScript"> document.PCO_FormVerMenu.submit();  </script>';
		}



/* ################################################################## */
/* ################################################################## */
	if ($PCO_Accion=="PCO_CambiarEstadoUsuario")
		{
			/*
				Function: PCO_CambiarEstadoUsuario
				Permite inhabilitar un usuario en el sistema sin tener que eliminarlo completamente o habilitarlo cuando ya se encuentre inhabilitado previamente.   Al actualizar el estado del usuario como Habilitado tambien se actualiza la ultima fecha de ingreso como la actual para controles de login posteriores.

				Variables minimas de entrada:
					uid_especifico - Login del usuario
					estado - Estado actual del usuario: 1=Activo, 0=Inactivo

				Proceso simplificado:
					(start code)
						if ($estado==1)
							$consulta = "UPDATE ".$TablasCore."usuario SET estado=0 WHERE login='$uid_especifico'";
						else
							$consulta = "UPDATE ".$TablasCore."usuario SET estado=1, ultimo_acceso='$PCO_FechaOperacion' WHERE login='$uid_especifico'";
					(end)

				Salida de la funcion:
					* Usuario con estado diferente (contrario) al recibido

				Ver tambien:
					<PCO_EliminarUsuario>
			*/
			if ($estado==1)
				PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."usuario SET estado=0 WHERE login=? ","$uid_especifico");
			else
				PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."usuario SET estado=1, ultimo_acceso=? WHERE login=? ","$PCO_FechaOperacion$_SeparadorCampos_$uid_especifico");
			PCO_Auditar("Cambia estado del usuario $uid_especifico");
			echo '<script type="" language="JavaScript"> document.PCO_FormVerMenu.submit();  </script>';
		}


/* ################################################################## */
/* ################################################################## */
	if ($PCO_Accion=="PCO_ResetearContrasena")
		{
			/*
				Function: PCO_ResetearContrasena
				Restablece la contrasena de un usuario por la nueva ingresada

				Variables minimas de entrada:
					uid_especifico - Login del usuario
					nueva_clave - Nueva clave para el usuario

				Salida de la funcion:
					* Usuario con su clave actualizada

				Ver tambien:
					<PCO_EliminarUsuario>
			*/
			PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."usuario SET clave=MD5('$nueva_clave') WHERE login=? ","$uid_especifico");
			PCO_Auditar("Restablece clave de acceso para $uid_especifico");
			echo '<script type="" language="JavaScript"> document.PCO_FormVerMenu.submit();  </script>';
		}


/* ################################################################## */
/* ################################################################## */
	if ($PCO_Accion=="PCO_GuardarUsuarioAutoregistro")
		{
			/*
				Function: PCO_GuardarUsuarioAutoregistro
				Almacena la informacion basica de un usuario en la base de datos

				Variables minimas de entrada:
					login - Nickname o login para el usuario.  Debe ser un identificador unico y no existir ya en el sistema
					nombre - Nombre completo del usuario.
					correo - Correo del usuario para envio de la clave

				Salida de la funcion:
					* Usuario registrado en el sistema.  El proceso agrega ademas las claves en MD5 y la llave de paso definida en el archivo de <Libreria base> 

				Ver tambien:
					<PCO_AgregarUsuarioAutoregistro> | <PCO_EliminarUsuario>
			*/
			$mensaje_error="";

			$clave=PCO_TextoAleatorio(10);
			$plantilla_permisos=$Auth_PlantillaAutoRegistro;
			$usuario_interno=0;
			$estado=1;
			$seguridad=100;
			$es_plantilla=0;

			// Verifica que no existe el usuario
			if ($login!="")
				{
					$resultado_usuario=PCO_EjecutarSQL("SELECT login FROM ".$TablasCore."usuario WHERE login=? ","$login");
					$registro_usuario = $resultado_usuario->fetch();
					if ($registro_usuario["login"]!="")
						$mensaje_error=$MULTILANG_UsrErrCrea1;
				}

			// Verifica campos nulos
			if ($nombre=="" || $login=="" || $correo=="")
				$mensaje_error=$MULTILANG_UsrErrCrea2;

			if ($mensaje_error=="")
				{
					// Inserta datos del usuario
					$clavemd5=MD5($clave);
					$pasomd5=MD5($LlaveDePaso);
                    $Llave_recuperacion="";
					PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."usuario (".$ListaCamposSinID_usuario.") VALUES (?,?,?,?,?,?,?,?,?,?,?,?)","$login$_SeparadorCampos_$clavemd5$_SeparadorCampos_$nombre$_SeparadorCampos_$estado$_SeparadorCampos_$correo$_SeparadorCampos_$PCO_FechaOperacion$_SeparadorCampos_$pasomd5$_SeparadorCampos_$usuario_interno$_SeparadorCampos_$Llave_recuperacion$_SeparadorCampos_$es_plantilla$_SeparadorCampos_$plantilla_permisos$_SeparadorCampos_$descripcion_usuario");
					PCO_Auditar("Agrega usuario $login para $nombre",$login);

                    // Construye la URL del sistema para enviarla por correo
        			if(empty($_SERVER["HTTPS"]))
        				$protocolo_webservice="http://";
        			else
        				$protocolo_webservice="https://";
        			// Construye la URL para solicitar el webservice.  La URL se debe poder resolver por el servidor web correctamente, ya sea por dominio o IP (interna o publica).  Ver /etc/hosts si algo.
        			$prefijo_webservice=$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['PHP_SELF'];
        			$URLAcceso = $protocolo_webservice.$prefijo_webservice."?AUTO_uid=".$login."&AUTO_clave=".$clave;

					//Envia correo informativo
					$cuerpo_mensaje="<br>".$MULTILANG_Bienvenido." ".$nombre.",<br><hr>Login: <b>".$login."</b><br>Password: <b>".$clave."</b><br><br><b><a href=".$URLAcceso.">[".$MULTILANG_TituloLogin."]</a></b><br><br>";
					PCO_EnviarCorreo("noreply@".$_SERVER["SERVER_NAME"],$correo,$MULTILANG_Bienvenido." [$NombreRAD]",$cuerpo_mensaje);
                    //Presenta mensaje final
					echo "<br>";
					PCO_Mensaje($MULTILANG_Atencion, $MULTILANG_UsrFinRegistro, '', 'fa fa-fw fa-2x fa-info-circle', 'alert alert-success');
					echo "<center>";
					echo '<a class="btn btn-success" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-sign-in"></i> '.$MULTILANG_Ingresar.'</a>';
				}
			else
				{
					echo "<br>";
					PCO_Mensaje($MULTILANG_ErrorDatos, $mensaje_error, '', 'fa fa-fw fa-3x fa-exclamation-circle', 'alert alert-danger');
					echo "<center>";
					echo '<a class="btn btn-warning" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-times"></i> '.$MULTILANG_Cancelar.'</a>';
				}
		}


/* ################################################################## */
/* ################################################################## */
if ($PCO_Accion=="PCO_AgregarUsuarioAutoregistro")
	{
        /*
            Function: PCO_AgregarUsuarioAutoregistro
            Presenta el formulario base para la adicion de usuarios al sistema en modo de auto-registro

            Salida de la funcion:
                * Llamada al proceso <PCO_GuardarUsuarioAutoregistro> para almacenar la informacion correspondiente al nuevo usuario.

            Ver tambien:
                <PCO_PermisosUsuario> | <PCO_EliminarUsuario> | <PCO_CambiarEstadoUsuario> | <muestra_seguridad_clave> | <seguridad_clave>
        */
		echo "<br>";
		PCO_AbrirVentana($MULTILANG_UsrAdicion, 'panel-info');
        PCO_Mensaje($MULTILANG_Importante,$MULTILANG_UsrDesClaveACorreo,'','fa fa-info-circle fa-5x texto-azul','alert alert-default alert-dismissible');

?>

		<!-- VALOR MD5 PARA VACIO:  d41d8cd98f00b204e9800998ecf8427e-->
				<form name="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
					<input type="hidden" name="PCO_Accion" value="PCO_GuardarUsuarioAutoregistro">

					<div class="row">
						<div class="col-md-12">

							<div class="form-group input-group">
								<input name="login" maxlength="250" type="text" class="form-control" placeholder="<?php echo $MULTILANG_UsrLogin; ?>">
								<span class="input-group-addon">
									<a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
									<a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<?php echo $MULTILANG_UsrDesLogin; ?>"><i class="fa fa-question-circle fa-fw "></i></a>
								</span>
							</div>

							<div class="form-group input-group">
								<input name="nombre"  onkeypress="return validar_teclado(event, 'alfanumerico');" maxlength="250" type="text" class="form-control" placeholder="<?php echo $MULTILANG_UsrNombre; ?>">
								<span class="input-group-addon">
									<a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
								</span>
							</div>

							<div class="form-group input-group">
								<span class="input-group-addon">
									<i class="fa fa-envelope fa-fw "></i>
								</span>
								<input name="correo" type="text" class="form-control" placeholder="<?php echo $MULTILANG_Correo; ?>">
								<span class="input-group-addon">
									<a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<b><?php echo $MULTILANG_UsrTitCorreo; ?></b><br><?php echo $MULTILANG_UsrDesCorreo; ?>"><i class="fa fa-question-circle fa-fw "></i></a>
								</span>
							</div>


						</div>

					</div>

                </form>

            <a class="btn btn-success btn-block" href="javascript:document.datos.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_Registrarme; ?></a>
            <br>
            <a class="btn btn-warning btn-block" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-times"></i> <?php echo $MULTILANG_Cancelar; ?></a>

		 <?php
            PCO_CerrarVentana();
			$VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
    }


/* ################################################################## */
/* ################################################################## */
	if ($PCO_Accion=="PCO_GuardarUsuario")
		{
			/*
				Function: PCO_GuardarUsuario
				Almacena la informacion basica de un usuario en la base de datos

				Variables minimas de entrada:
					login - Nickname o login para el usuario.  Debe ser un identificador unico y no existir ya en el sistema
					nombre - Nombre completo del usuario.
					clave - Contrasena sin encriptar del usuario

				Proceso simplificado:
					(start code)
						SELECT login as uid_db FROM ".$TablasCore."usuario WHERE login='$login'
						INSERT INTO ".$TablasCore."usuario VALUES ('$login','$clavemd5','$nombre','$descripcion',$estado,'$nivel','$correo','$PCO_FechaOperacion','$pasomd5')"
					(end)

				Salida de la funcion:
					* Usuario registrado en el sistema.  El proceso agrega ademas las claves en MD5 y la llave de paso definida en el archivo de <Libreria base> 

				Ver tambien:
					<PCO_AgregarUsuario> | <PCO_EliminarUsuario>
			*/
			$mensaje_error="";

			// Verifica que no existe el usuario
			if ($login!="")
            {
                $resultado_usuario=PCO_EjecutarSQL("SELECT login FROM ".$TablasCore."usuario WHERE login=? ","$login");
                $registro_usuario = $resultado_usuario->fetch();
                if ($registro_usuario["login"]!="")
                    $mensaje_error=$MULTILANG_UsrErrCrea1;
            }

			// Verifica campos nulos
			if ($nombre=="" || $login=="" || $clave=="")
				$mensaje_error=$MULTILANG_UsrErrCrea2;

			// Verifica contrasenas:  longitud e igualdad de la verificacion
			if ($clave!=$clave1)
				$mensaje_error=$MULTILANG_UsrErrPW2;
			if (strlen($clave)<6)
				$mensaje_error=$MULTILANG_UsrErrCrea3;

			if ($mensaje_error=="")
				{
					// Inserta datos del usuario
					$clavemd5=MD5($clave);
					$pasomd5=MD5($LlaveDePaso);
                    $Llave_recuperacion="";
					PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."usuario (".$ListaCamposSinID_usuario.") VALUES (?,?,?,?,?,?,?,?,?,?,?,?)","$login$_SeparadorCampos_$clavemd5$_SeparadorCampos_$nombre$_SeparadorCampos_$estado$_SeparadorCampos_$correo$_SeparadorCampos_$PCO_FechaOperacion$_SeparadorCampos_$pasomd5$_SeparadorCampos_$usuario_interno$_SeparadorCampos_$Llave_recuperacion$_SeparadorCampos_$es_plantilla$_SeparadorCampos_$plantilla_permisos$_SeparadorCampos_$descripcion_usuario");
					PCO_Auditar("Agrega usuario $login para $nombre");
                    //Redirecciona a la lista de usuarios con el usuario prefiltrado por si se le quiere asignar permisos
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_CargarObjeto">
						<input type="Hidden" name="PCO_Objeto" value="frm:-8:1">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_AvisoSistema.'">
                        <input type="Hidden" name="PCO_ErrorDescripcion" value="'.$MULTILANG_UsrCreacionOK.'">
                        <input type="Hidden" name="PCO_ErrorIcono" value="fa-info-circle">
                        <input type="Hidden" name="PCO_ErrorEstilo" value="alert-success">
                        <input type="Hidden" name="FiltroLoginUsuario" value="'.$login.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_AgregarUsuario">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
		}


/* ################################################################## */
/* ################################################################## */
if ($PCO_Accion=="PCO_AgregarUsuario")
	{
        /*
            Function: PCO_AgregarUsuario
            Presenta el formulario base para la adicion de usuarios al sistema.

            Salida de la funcion:
                * Llamada al proceso <PCO_GuardarUsuario> para almacenar la informacion correspondiente al nuevo usuario.

            Ver tambien:
                <PCO_PermisosUsuario> | <PCO_EliminarUsuario> | <PCO_CambiarEstadoUsuario> | <muestra_seguridad_clave> | <seguridad_clave>
        */
		PCO_AbrirVentana($MULTILANG_UsrAdicion, 'panel-info');
        PCO_Mensaje($MULTILANG_Importante,$MULTILANG_UsrDesPW,'','fa fa-info-circle fa-5x texto-azul','alert alert-default alert-dismissible');
?>

		<!-- VALOR MD5 PARA VACIO:  d41d8cd98f00b204e9800998ecf8427e-->
				<form name="datos" action="<?php echo $ArchivoCORE; ?>" method="POST">
					<input type="hidden" name="PCO_Accion" value="PCO_GuardarUsuario">

					<div class="row">
						<div class="col-md-6">

							<div class="form-group input-group">
								<input name="login" maxlength="250" type="text" class="form-control" placeholder="<?php echo $MULTILANG_UsrLogin; ?>">
								<span class="input-group-addon">
									<a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
									<a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<?php echo $MULTILANG_UsrDesLogin; ?>"><i class="fa fa-question-circle fa-fw "></i></a>
								</span>
							</div>

							<div class="form-group input-group">
								<input name="nombre"  onkeypress="return validar_teclado(event, 'alfanumerico');" maxlength="250" type="text" class="form-control" placeholder="<?php echo $MULTILANG_UsrNombre; ?>">
								<span class="input-group-addon">
									<a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
								</span>
							</div>

							<div class="form-group input-group">
								<input name="clave"   onkeyup="muestra_seguridad_clave(this.value, this.form)" type="password" class="form-control" placeholder="<?php echo $MULTILANG_Contrasena; ?>">
								<span class="input-group-addon">
									<a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
								</span>
								<span class="input-group-addon">
									<?php echo $MULTILANG_UsrNivelPW; ?>:
								</span>
								<input id="seguridad" value="0" size="3" name="seguridad" class="form-control" type="text" readonly onfocus="blur()">
								<span class="input-group-addon">
									%
								</span>
							</div>

							<div class="form-group input-group">
								<input name="clave1" type="password" class="form-control" placeholder="<?php echo $MULTILANG_Contrasena; ?> (Confirma)">
								<span class="input-group-addon">
									<a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<?php echo $MULTILANG_TitObligatorio; ?>"><i class="fa fa-exclamation-triangle icon-orange  fa-fw "></i></a>
								</span>
							</div>

							<div class="form-group input-group">
								<span class="input-group-addon">
									<i class="fa fa-envelope fa-fw "></i>
								</span>
								<input name="correo" type="text" class="form-control" placeholder="<?php echo $MULTILANG_Correo; ?>">
								<span class="input-group-addon">
									<a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="<b><?php echo $MULTILANG_UsrTitCorreo; ?></b><br><?php echo $MULTILANG_UsrDesCorreo; ?>"><i class="fa fa-question-circle fa-fw "></i></a>
								</span>
							</div>


						</div>
						<div class="col-md-6">

							<label for="estado"><?php echo $MULTILANG_UsrEstado; ?>:</label>
							<div class="form-group input-group">
								<select id="estado" name="estado" class="form-control" >
									<option value="1"><?php echo $MULTILANG_Habilitado; ?></option>
									<option value="0"><?php echo $MULTILANG_Deshabilitado; ?></option>
								</select>
							</div>

							<label for="usuario_interno"><?php echo $MULTILANG_UsrInterno; ?>:</label>
							<div class="form-group input-group">
								<select id="usuario_interno" name="usuario_interno" class="form-control" >
									<option value="1"><?php echo $MULTILANG_Si; ?></option>
									<option value="0"><?php echo $MULTILANG_No; ?></option>
								</select>
								<span class="input-group-addon">
									<a  href="#" data-toggle="tooltip" data-html="true"  title="<b><?php echo $MULTILANG_UsrTitNivel; ?></b><br><?php echo $MULTILANG_UsrDesInterno; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
								</span>
							</div>

							<label for="es_plantilla"><?php echo $MULTILANG_UsrEsPlantilla; ?>:</label>
							<div class="form-group input-group">
								<select id="es_plantilla" name="es_plantilla" class="form-control" >
									<option value="0"><?php echo $MULTILANG_No; ?></option>
									<option value="1"><?php echo $MULTILANG_Si; ?></option>
								</select>
								<span class="input-group-addon">
									<a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_UsrEsPlantillaDes; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
								</span>
							</div>

							<label for="plantilla_permisos"><?php echo $MULTILANG_UsrPlantillaAplicar; ?>:</label>
							<div class="form-group input-group">
								<select id="plantilla_permisos" name="plantilla_permisos" class="form-control" >
									<option value=""><?php echo $MULTILANG_Ninguno; ?> (<?php echo $MULTILANG_UsrPermisoManual; ?>)</option>
									<?php
										//Busca los usuarios definidos como plantilla
										$usuarios_plantilla=PCO_EjecutarSQL("SELECT ".$ListaCamposSinID_usuario." FROM ".$TablasCore."usuario WHERE es_plantilla=1");
										while ($registro_plantilla=$usuarios_plantilla->fetch())
											echo '<option value="'.$registro_plantilla["login"].'">'.$registro_plantilla["login"].'</option>';									
									?>
								</select>
								<span class="input-group-addon">
									<a  href="#" data-toggle="tooltip" data-html="true"  title="<?php echo $MULTILANG_UsrPlantillaAplicarDes; ?>"><i class="fa fa-question-circle fa-fw text-info"></i></a>
								</span>
							</div>

						</div>
					</div>

                </form>

            <a class="btn btn-success btn-block" href="javascript:document.datos.submit();"><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_Guardar; ?></a>
            <a class="btn btn-default btn-block" href="javascript:document.PCO_FormVerMenu.submit();"><i class="fa fa-home"></i> <?php echo $MULTILANG_IrEscritorio; ?></a>

		 <?php
            PCO_CerrarVentana();
			$VerNavegacionIzquierdaResponsive=1; //Habilita la barra de navegacion izquierda por defecto
    }


/* ################################################################## */
/* ################################################################## */
if ($PCO_Accion=="PCO_PanelAuditoriaMovimientos")
	{
        /*
        	Function: PCO_PanelAuditoriaMovimientos
        	Presenta un panel con informacion general acerca de las ultimas acciones del sistema las ultimas 30 acciones del sistema, permitiendo su actualizacion automatica cada 5 segundos
        
        	Proceso simplificado:
        		(start code)
        			SELECT core_auditoria.id as ID,core_auditoria.usuario_login,core_auditoria.accion,core_auditoria.fecha,core_auditoria.hora FROM ".$TablasCore."auditoria WHERE core_auditoria.fecha >= "" AND core_auditoria.fecha <= "" AND core_auditoria.accion LIKE "%%" AND core_auditoria.usuario_login LIKE "%%" ORDER BY fecha DESC, hora DESC LIMIT 0,30
        		(end)
        
        	Salida de la funcion:
        		* Listado de operaciones realizadas actualizado automaticamente segun los parametros dados
        
        */
			if ($FechaInicioAuditoria=="") $FechaInicioAuditoria=$PCO_FechaOperacionGuiones;
			if ($FechaFinAuditoria=="") $FechaFinAuditoria=$PCO_FechaOperacionGuiones;
			PCO_Auditar("Carga modulo de auditoria");
			PCO_CargarFormulario("-7",1);
	}