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
<?php 
	// Valida sesion activa de Practico
	@session_start();



if (basename(__FILE__) == basename($_SERVER['PHP_SELF']))
{
    exit(0);
}

echo '<?xml version="1.0" encoding="utf-8"?>';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
<head>
  <title>Practico - Proxy</title>
  <link rel="stylesheet" type="text/css" href="style.css" title="Default Theme" media="all" />
</head>
<body onload="document.getElementById('address_box').focus()">
<div id="container">
  <h1 id="title"><img align="absmiddle" src="../../../img/pbrowser.png" border=0></h1>
<?php

switch ($data['category'])
{
    case 'auth':
?>
  <div id="auth"><p>
  <b>Entre su usuario y clave para "<?php echo htmlspecialchars($data['realm']) ?>" en <?php echo $GLOBALS['_url_parts']['host'] ?></b>
  <form method="post" action="">
    <input type="hidden" name="<?php echo $GLOBALS['_config']['basic_auth_var_name'] ?>" value="<?php echo base64_encode($data['realm']) ?>" />
    <label>Usuario <input type="text" name="username" value="" /></label> <label>Clave <input type="password" name="password" value="" /></label> <input type="submit" value="Login" />
  </form></p></div>
<?php
        break;
    case 'error':
        echo '<div id="error"><p>';
        
        switch ($data['group'])
        {
            case 'url':
                echo '<b>URL Error (' . $data['error'] . ')</b>: ';
                switch ($data['type'])
                {
                    case 'internal':
                        $message = 'Fallo al conectar con el host especificado. '
                                 . 'Posibles causas son que el servidor no se encuentra, tiempo de espera agotado, o la conexion fue rechazada por el servidor remoto. '
                                 . 'Intente nuevamente verificando que la direccion es correcta.';
                        break;
                    case 'external':
                        switch ($data['error'])
                        {
                            case 1:
                                $message = 'La URL que usted intenta accesar esta dentro de la lista negra de sitios. Intente con otra.';
                                break;
                            case 2:
                                $message = 'La URL que usted ingreso se encuentra mal formada o escrita. Por favor verifiquela.';
                                break;
                        }
                        break;
                }
                break;
            case 'resource':
                echo '<b>Error en el recurso:</b> ';
                switch ($data['type'])
                {
                    case 'file_size':
                        $message = 'El archivo que intenta descargar es demasiado grande.<br />'
                                 . 'El maximo posible es <b>' . number_format($GLOBALS['_config']['max_file_size']/1048576, 2) . ' MB</b><br />'
                                 . 'El archivo solicitado pesa <b>' . number_format($GLOBALS['_content_length']/1048576, 2) . ' MB</b>';
                        break;
                    case 'hotlinking':
                        $message = 'Para que usted intenta accesar un recurso de un sitio remoto a traves de este proxy.<br />'
                                 . 'Por razones de seguridad, por favor utilice el formulario presentado.';
                        break;
                }
                break;
        }
        
        echo 'Ocurrio un error mientras se intentaba navegar a traves del proxy. <br />' . $message . '</p></div>';
        break;
}
?>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <ul id="form">
      <li id="address_bar"><label>Direccion web <input id="address_box" type="text" name="<?php echo $GLOBALS['_config']['url_var_name'] ?>" value="<?php echo isset($GLOBALS['_url']) ? htmlspecialchars($GLOBALS['_url']) : '' ?>" onfocus="this.select()" /></label> <input id="go" type="submit" value="Navegar" /></li>
      <?php
      
      foreach ($GLOBALS['_flags'] as $flag_name => $flag_value)
      {
          if (!$GLOBALS['_frozen_flags'][$flag_name])
          {
              echo '<li class="option"><label><input type="checkbox" name="' . $GLOBALS['_config']['flags_var_name'] . '[' . $flag_name . ']"' . ($flag_value ? ' checked="checked"' : '') . ' />' . $GLOBALS['_labels'][$flag_name][1] . '</label></li>' . "\n";
          }
      }
      ?>
    </ul>
  </form>
  <div id="footer">Esta navegando como <b><?php echo $_SESSION['PCOSESS_LoginUsuario']; ?></b> - <a href="http://www.practico.org/"><i>Practico.org</i></a> <!--<?php echo $GLOBALS['_version'] ?> --></div>
</div>
</body>
</html>
