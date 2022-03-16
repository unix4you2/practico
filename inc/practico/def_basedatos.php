<?php
	/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2012-2022
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
	 This program is free software: you can redistribute it and/or modify
	 it under the terms of the GNU General Public License as published by
	 the Free Software Foundation, either version 3 of the License, or
	 (at your option) any later version.

	 This program is distributed in the hope that it will be useful,
	 but WITHOUT ANY WARRANTY; without even the implied warranty of
	 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 GNU General Public License for more details.

	 You should have received a copy of the GNU General Public License
	 along with this program.  If not, see <http://www.gnu.org/licenses/>
	 
	            --- TRADUCCION NO OFICIAL DE LA LICENCIA ---

     Esta es una traducción no oficial de la Licencia Pública General de
     GNU al español. No ha sido publicada por la Free Software Foundation
     y no establece los términos jurídicos de distribución del software 
     publicado bajo la GPL 3 de GNU, solo la GPL de GNU original en inglés
     lo hace. De todos modos, esperamos que esta traducción ayude a los
     hispanohablantes a comprender mejor la GPL de GNU:
	 
     Este programa es software libre: puede redistribuirlo y/o modificarlo
     bajo los términos de la Licencia General Pública de GNU publicada por
     la Free Software Foundation, ya sea la versión 3 de la Licencia, o 
     (a su elección) cualquier versión posterior.

     Este programa se distribuye con la esperanza de que sea útil pero SIN
     NINGUNA GARANTÍA; incluso sin la garantía implícita de MERCANTIBILIDAD
     o CALIFICADA PARA UN PROPÓSITO EN PARTICULAR. Vea la Licencia General
     Pública de GNU para más detalles.

     Usted ha debido de recibir una copia de la Licencia General Pública de
     GNU junto con este programa. Si no, vea <http://www.gnu.org/licenses/>

	*/

	/*
		Title: Libreria Definicion de base de datos
		Ubicacion *[/inc/def_basedatos.php]*.  Incluye la lista de campos por tabla en el sistema sin el ID para hacer los diferentes Insert en cada una, evitando tener que alterar todos los queries ante cambios en la estructura de una tabla.
	*/

	$ListaCamposSinID_auditoria='usuario_login,accion,fecha,hora';
	$ListaCamposSinID_usuario='login,clave,nombre,estado,correo,ultimo_acceso,llave_paso,usuario_interno,llave_recuperacion,es_plantilla,plantilla_permisos,descripcion,transformacion_colores,idioma,avatar,redes_permitidas';
	$ListaCamposSinID_usuario_menu='usuario,menu';
	$ListaCamposSinID_usuario_informe='usuario,informe';
    $ListaCamposSinID_formulario_objeto='tipo,titulo,campo,ayuda_titulo,ayuda_texto,formulario,peso,columna,obligatorio,visible,valor_predeterminado,validacion_datos,etiqueta_busqueda,ajax_busqueda,valor_unico,solo_lectura,ancho,alto,barra_herramientas,fila_unica,lista_opciones,origen_lista_opciones,origen_lista_valores,valor_etiqueta,url_iframe,objeto_en_ventana,informe_vinculado,maxima_longitud,valor_minimo,valor_maximo,valor_salto,formato_salida,plantilla_archivo,peso_archivo,tamano_pincel,color_trazo,formulario_vinculado,formulario_campo_vinculo,formulario_campo_foraneo,condicion_filtrado_listas,pestana_objeto,personalizacion_tag,modo_inline,imagen,tipo_accion,accion_usuario,valor_check_activo,valor_check_inactivo,valor_placeholder,ocultar_etiqueta,id_html,validacion_extras,clase_contenedor,ajax_busqueda_dinamica,etiqueta_colapsable';
    $ListaCamposSinID_formulario_boton='titulo,estilo,formulario,tipo_accion,accion_usuario,visible,peso,retorno_titulo,retorno_texto,confirmacion_texto,retorno_icono,retorno_estilo,id_html';
    $ListaCamposSinID_evento_objeto='objeto,evento,javascript';
    $ListaCamposSinID_formulario='titulo,ayuda_titulo,ayuda_texto,tabla_datos,columnas,javascript,borde_visible,estilo_pestanas,id_html,tipo_maquetacion,css_columnas,estilo_ventana,pre_script,post_script,modulo';
	$ListaCamposSinID_informe_condiciones='informe,valor_izq,operador,valor_der,peso';
	$ListaCamposSinID_informe_campos='informe,valor_campo,valor_alias,peso,visible,editable,titulo_arbitrario';
	$ListaCamposSinID_informe_tablas='informe,valor_tabla,valor_alias';
	$ListaCamposSinID_informe_boton='titulo,estilo,informe,tipo_accion,accion_usuario,visible,peso,confirmacion_texto,destino,pantalla_completa,precargar_estilos,imagen,ubicar_principio';
	$ListaCamposSinID_informe='titulo,descripcion,categoria,agrupamiento,ordenamiento,ancho,alto,formato_final,formato_grafico,genera_pdf,variables_filtro,soporte_datatable,formulario_filtrado,tamano_paginacion,subtotales_columna,subtotales_formato,conexion_origen_datos,consulta_sql,tooltip_titulo,exportar_dtclp,exportar_dtcsv,exportar_dtxls,exportar_dtpdf,ocultar_encabezado,ocultar_piepagina,anular_acciones,encabezado_html,tabla_responsive,permitido_home,javascript,pre_script,post_script,usar_ajax,definir_cols,pane_activado,pane_cascada,pane_colapsado,pane_columnas,pane_subtotalesrelativos,pane_conteos,pane_controles,pane_control_colapsar,pane_control_ordenar,modulo';
	$ListaCamposSinID_menu='texto,padre,peso,url,destino,tipo_comando,comando,nivel_usuario,columna,posible_arriba,posible_centro,posible_escritorio,seccion,imagen,posible_izquierda,tipo_menu,formulario_vinculado,clase_contenedor,hash_unico,posible_usuario';
	$ListaCamposSinID_parametros='nombre_empresa_largo,nombre_empresa_corto,nombre_aplicacion,version,fecha_lanzamiento,licencia,creditos,funciones_personalizadas,federado_servidor,federado_usuario,federado_clave,federado_motor,federado_basedatos,federado_tabla,federado_campousuario,federado_campoclave,federado_encripcion,federado_puerto';
	$ListaCamposSinID_llaves_api='nombre,llave,secreto,uri,dominio_autorizado,ip_autorizada,funciones_autorizadas';
	$ListaCamposSinID_chat='from,to,message,sent,recd';
	$ListaCamposSinID_monitoreo='tipo,pagina,peso,nombre,host,puerto,tipo_ping,saltos,comando,ancho,alto,tamano_resultado,ocultar_titulos,path,correo_alerta,alerta_sonora,milisegundos_lectura,alerta_vibracion,ultimo_estado,valor_minimo,valor_maximo,conexion_origen_datos,modo_compacto';
	$ListaCamposSinID_replicasbd='nombre,servidorbd,basedatos,usuariobd,passwordbd,motorbd,puertobd,tipo_replica';
	$ListaCamposSinID_tareascron='titulo,fecha_creacion,codigo_tarea,script_php,habilitado,historial_ejecucion';
	$ListaCamposSinID_acortadorurls='url_larga,url_corta,usuario,fecha_creacion,hora_creacion,contador_uso';
	$ListaCamposSinID_modulos_app='nombre,descripcion,desarrolladores';