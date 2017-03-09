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


	// 1. Llama al modelo, encargado de abstraer las operaciones de consulta a BD
	require($ruta_modelos.'modelo.php');

	// 2. Pasa los datos generados por una funcion existente en el modelo a un variable independiente
	$registros = getAuditoria();

	// 3. Llama a la vista, encargada de presentar los datos genericos entregados desde el modelo
	require($ruta_vistas.'vista.php');
