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

function confirmar_evento(mensaje,formulario)
	{
		if (window.confirm(mensaje))
		{
			formulario.submit();
		}
	}

function validar()
	{
		if (document.f1.cedula.value=="" || document.f1.clave.value=="")
			{
				alert("Faltan datos por llenar");
			}
		else
			{
				document.f1.submit();
			}
	}

function FiltrarCTRLV(e)
	{
		return !(e.keyCode==86 && e.ctrlKey)
	}

function validar_teclado(elEvento, permitidos)
	{
		// Variables que definen los caracteres permitidos
		var numeros = "0123456789";
		var caracteres = " abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
		var numeros_caracteres = numeros + caracteres;
		var teclas_especiales = [8, 37, 39, 46, 9];
		// 8 = BackSpace, 46 = Supr, 37 = flecha izquierda, 39 = flecha derecha 9=suprimir
									 
		// Seleccionar los caracteres a partir del parámetro de la función 
		switch(permitidos)
			{
				case 'numerico':
					permitidos = numeros;
					break;
				case 'alfabetico':
					permitidos = caracteres;
					break;
				case 'alfanumerico':
					permitidos = numeros_caracteres;
					break;
			}

		// Obtener la tecla pulsada
		var evento = elEvento || window.event;
		var codigoCaracter = evento.charCode || evento.keyCode;
		var caracter = String.fromCharCode(codigoCaracter);

		if(codigoCaracter=="37" || codigoCaracter=="39")
			{
				return false;
			}
		// Comprobar si la tecla pulsada es alguna de las teclas especiales
		// (teclas de borrado y flechas horizontales)
		var tecla_especial = false;
		for(var i in teclas_especiales)
			{    
				if(codigoCaracter == teclas_especiales[i])
					{
						tecla_especial = true;
						break;
					}
			}
		return permitidos.indexOf(caracter) != -1 || tecla_especial;
	}
