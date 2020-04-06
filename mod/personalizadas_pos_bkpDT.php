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
			Title: Funciones personalizadas
			Ubicacion *[/personalizadas_pos.php]*.  Archivo que contiene la declaracion de variables y funciones por parte del usuario o administrador del sistema que deben ser cargadas justo antes de finalizar la aplicacion

			Codigo de ejemplo:
				(start code)
					<?php if ($PCO_Accion=="Mi_accion_XYZ") 
						{
							// Mis operaciones a realizar
						}
					?>
				(end)

			Comentario:
			Agregue en este archivo las funciones o acciones que desee vincular a menues especificos o realizacion de operaciones internas.
			Utilice el condicional para diferenciar la accion recibida y ser asi ejecutada. Puede vincularlos mediante forms.

            Por favor considere la construccion de un nuevo modulo antes que implementar rutinas sobre este archivo
            Please consider to build a new module before to deploy rutines in this file
            */

if ($PCO_Accion=="Mi_AccionPoscarga_XYZ") 
	{


	}
	

?>
<table id='empTable' class='display dataTable'>
<thead>
<tr>
    
<!--
    
<th>id</th>
<th>documento</th>
<th>nombre</th>
-->
<th>id</th>
<th>empresa</th>
<th>documento</th>
<th>tipo_identificacion</th>
<th>digito_verificacion</th>
<th>nombre</th>
<th>direccion</th>
<th>genero</th>
<th>departamento</th>
<th>municipio</th>
<th>tel_residencia</th>
<th>tel_movil</th>
<th>tel_trabajo</th>
<th>fecha_nacimiento</th>
<th>correo</th>
<th>correo_empresa</th>
<th>ubicacion_fisica</th>
<th>notas</th>
<th>estado</th>
<th>salario</th>
<th>cuenta_numero</th>
<th>cuenta_entidad</th>
<th>cuenta_tipo</th>
<th>cargo</th>
<th>entidad_eps</th>
<th>codigo_eps</th>
<th>entidad_afp</th>
<th>codigo_afp</th>
<th>tipo_vinculacion</th>
<th>fecha_primer_ingreso</th>
<th>fecha_ultimo_retiro</th>
<th>extension</th>
<th>area</th>
<th>sede</th>
<th>id_sede</th>
<th>usuario</th>
<th>jefe_inmediato</th>
<th>estrato</th>
<th>grupo_etnico</th>
<th>condicion_discapacidad</th>
<th>escolaridad</th>
<th>rh</th>
<th>nro_hijos</th>
<th>estado_civil</th>
<th>turno</th>
<th>perfil_cargo</th>
<th>cumple_sgsst</th>
<th>talla_camisa</th>
<th>talla_pantalon</th>
<th>talla_zapatos</th>
<th>es_responsable_sgsst</th>

</tr>
</thead>
</table>


<script language="javascript">
    
    
$(document).ready(function(){
   $('#empTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'responsive':true,

      'ajax': {
          'url':'/practico/index.php?PCO_Accion=recordset_json&Presentar_FullScreen=1&Precarga_EstilosBS=0'
      },

      'columns': [
            { data: 'id' } ,
            { data: 'empresa' } ,
            { data: 'documento' } ,
            { data: 'tipo_identificacion' } ,
            { data: 'digito_verificacion' } ,
            { data: 'nombre' } ,
            { data: 'direccion' } ,
            { data: 'genero' } ,
            { data: 'departamento' } ,
            { data: 'municipio' } ,
            { data: 'tel_residencia' } ,
            { data: 'tel_movil' } ,
            { data: 'tel_trabajo' } ,
            { data: 'fecha_nacimiento' } ,
            { data: 'correo' } ,
            { data: 'correo_empresa' } ,
            { data: 'ubicacion_fisica' } ,
            { data: 'notas' } ,
            { data: 'estado' } ,
            { data: 'salario' } ,
            { data: 'cuenta_numero' } ,
            { data: 'cuenta_entidad' } ,
            { data: 'cuenta_tipo' } ,
            { data: 'cargo' } ,
            { data: 'entidad_eps' } ,
            { data: 'codigo_eps' } ,
            { data: 'entidad_afp' } ,
            { data: 'codigo_afp' } ,
            { data: 'tipo_vinculacion' } ,
            { data: 'fecha_primer_ingreso' } ,
            { data: 'fecha_ultimo_retiro' } ,
            { data: 'extension' } ,
            { data: 'area' } ,
            { data: 'sede' } ,
            { data: 'id_sede' } ,
            { data: 'usuario' } ,
            { data: 'jefe_inmediato' } ,
            { data: 'estrato' } ,
            { data: 'grupo_etnico' } ,
            { data: 'condicion_discapacidad' } ,
            { data: 'escolaridad' } ,
            { data: 'rh' } ,
            { data: 'nro_hijos' } ,
            { data: 'estado_civil' } ,
            { data: 'turno' } ,
            { data: 'perfil_cargo' } ,
            { data: 'cumple_sgsst' } ,
            { data: 'talla_camisa' } ,
            { data: 'talla_pantalon' } ,
            { data: 'talla_zapatos' } ,
            { data: 'es_responsable_sgsst' },
      ],

   });
});    
    
    
</script>






<br><br><br><br><br><br><br><br><br><br>