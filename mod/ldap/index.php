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
/* ################################################################## */
/* ################################################################## */
/*
	Function: ldap_admin_embebido
	Presenta IFrame con la herramienta de administracion de LDAP embebida

	Salida:
		IFrame con contenido generado por la herramienta
*/
if ($accion=="ldap_admin_embebido") 
	{
		echo '<iframe src="mod/ldap/phpldapadmin-1.2.3" width="95%" height="95%" frameborder="0" marginheight="0" marginwidth="0">Cargando...</iframe>';
	}

?>


