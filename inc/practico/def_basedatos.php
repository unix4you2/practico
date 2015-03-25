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
		Title: Libreria Definicion de base de datos
		Ubicacion *[/inc/def_basedatos.php]*.  Incluye la lista de campos por tabla en el sistema sin el ID para hacer los diferentes Insert en cada una, evitando tener que alterar todos los queries ante cambios en la estructura de una tabla.
	*/

	$ListaCamposSinID_auditoria='usuario_login,accion,fecha,hora';
	$ListaCamposSinID_usuario='login,clave,nombre,estado,correo,ultimo_acceso,llave_paso,usuario_interno,llave_recuperacion';
	$ListaCamposSinID_usuario_menu='usuario,menu';
	$ListaCamposSinID_usuario_informe='usuario,informe';
	
    //Recordar:  Cambios sobre esta estructura deberian actualizar scripts en formularios.php donde $PCO_Accion=="copiar_formulario"
    $ListaCamposSinID_formulario_objeto='tipo,titulo,campo,ayuda_titulo,ayuda_texto,formulario,peso,columna,obligatorio,visible,valor_predeterminado,validacion_datos,etiqueta_busqueda,ajax_busqueda,valor_unico,solo_lectura,ancho,alto,barra_herramientas,fila_unica,lista_opciones,origen_lista_opciones,origen_lista_valores,valor_etiqueta,url_iframe,objeto_en_ventana,informe_vinculado,maxima_longitud,valor_minimo,valor_maximo,valor_salto,formato_salida,plantilla_archivo,peso_archivo,tamano_pincel,color_trazo,formulario_vinculado,formulario_campo_vinculo,formulario_campo_foraneo,condicion_filtrado_listas,pestana_objeto,personalizacion_tag,modo_inline,imagen,tipo_accion,accion_usuario';
	//Recordar:  Cambios sobre esta estructura deberian actualizar scripts en formularios.php donde $PCO_Accion=="copiar_formulario"
    $ListaCamposSinID_formulario_boton='titulo,estilo,formulario,tipo_accion,accion_usuario,visible,peso,retorno_titulo,retorno_texto,confirmacion_texto';

    $ListaCamposSinID_formulario='titulo,ayuda_titulo,ayuda_texto,tabla_datos,columnas,javascript,borde_visible';
	$ListaCamposSinID_informe_condiciones='informe,valor_izq,operador,valor_der,peso';
	$ListaCamposSinID_informe_campos='informe,valor_campo,valor_alias,peso';
	$ListaCamposSinID_informe_tablas='informe,valor_tabla,valor_alias';
	$ListaCamposSinID_informe_boton='titulo,estilo,informe,tipo_accion,accion_usuario,visible,peso,confirmacion_texto';
	$ListaCamposSinID_informe='titulo,descripcion,categoria,agrupamiento,ordenamiento,ancho,alto,formato_final,formato_grafico,genera_pdf,variables_filtro,soporte_datatable';
	$ListaCamposSinID_menu='texto,peso,url,destino,tipo_comando,comando,nivel_usuario,posible_arriba,posible_centro,posible_escritorio,seccion,imagen,posible_izquierda';
	$ListaCamposSinID_parametros='nombre_empresa_largo,nombre_empresa_corto,nombre_aplicacion,version,fecha_lanzamiento,licencia,creditos,funciones_personalizadas';
	$ListaCamposSinID_llaves_api='nombre,llave,secreto,uri,dominio_autorizado,ip_autorizada,funciones_autorizadas';
	$ListaCamposSinID_chat='from,to,message,sent,recd';
	$ListaCamposSinID_monitoreo='tipo,pagina,peso,nombre,host,puerto,tipo_ping,saltos,comando,ancho,alto,tamano_resultado,ocultar_titulos,path,correo_alerta,alerta_sonora,milisegundos_lectura';
