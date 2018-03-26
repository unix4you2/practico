#!/bin/sh
#	Copyright (C) 2013  John F. Arroyave Gutiérrez
#						unix4you2@gmail.com
#
#	This program is free software; you can redistribute it and/or
#	modify it under the terms of the GNU General Public License
#	as published by the Free Software Foundation; either version 2
#	of the License, or (at your option) any later version.
#
#	This program is distributed in the hope that it will be useful,
#	but WITHOUT ANY WARRANTY; without even the implied warranty of
#	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#	GNU General Public License for more details.
#
#	You should have received a copy of the GNU General Public License
#	along with this program; if not, write to the Free Software
#	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
#
#   Ejecuta php -l en todos los archivos PHP para verifica su sintaxis

# Establece que debe salirse al primer comando que retorne error
set -e

# Recorre recursivamente las carpetas en busca de scripts y prueba su sintaxis
echo "##############################"
echo " Verificando sintaxis general"
echo "##############################"
find . -name "*.php" -print0 | xargs -0 -n1 -P8 php -l