DROP TABLE IF EXISTS core_parametros;
CREATE TABLE core_parametros (
  id serial,
  nombre_empresa_largo varchar(250) NOT NULL,
  nombre_empresa_corto varchar(50) NOT NULL,
  nombre_aplicacion varchar(100) NOT NULL,
  version varchar(20),
  fecha_lanzamiento date,
  licencia text,
  creditos text,
  funciones_personalizadas text,
  federado_servidor varchar(255) NULL DEFAULT '',
  federado_usuario varchar(255) NULL DEFAULT '',
  federado_clave varchar(255) NULL DEFAULT '',
  federado_motor varchar(255) NULL DEFAULT '',
  federado_basedatos varchar(255) NULL DEFAULT '',
  federado_tabla varchar(255) NULL DEFAULT '',
  federado_campousuario varchar(255) NULL DEFAULT '',
  federado_campoclave varchar(255) NULL DEFAULT '',
  federado_encripcion varchar(255) NULL DEFAULT '',
  federado_puerto varchar(255) NULL DEFAULT '',
  PRIMARY KEY  (id)
);

INSERT INTO core_parametros (id,nombre_empresa_largo,nombre_empresa_corto,nombre_aplicacion,version,fecha_lanzamiento,licencia,creditos) VALUES (0,'Nombre completo de su empresa','PAR_NombreCortoEmpresa','PAR_NombreAplicacion','PAR_VersionApp','20120101','Texto de su licencia','Texto asociado a los creditos de su aplicacion');

DROP TABLE IF EXISTS core_usuario;
CREATE TABLE core_usuario (
  login varchar(250) NOT NULL,
  clave varchar(50) NOT NULL default 'd41d8cd98fd41d8cd98fd41d8cd98fd41d8cd98f',
  nombre varchar(100) NOT NULL default '',
  estado integer NOT NULL default '1',
  correo varchar(200) NOT NULL default '',
  ultimo_acceso date NOT NULL default '20000101',
  llave_paso varchar(50) NOT NULL default 'd41d8cd98f00b204e9800998ecf8427e',
  usuario_interno integer DEFAULT 0,
  llave_recuperacion varchar(250) NOT NULL default '',
  es_plantilla integer DEFAULT 0,
  plantilla_permisos varchar(250) default '',
  descripcion varchar(250) NULL,
  PRIMARY KEY  (login)
);

INSERT INTO core_usuario VALUES ('admin','21232f297a57a5a743894a0e4a801fc3','Super usuario',1,'sucorreo@dominio.com','20110601','d41d8cd98f00b204e9800998ecf8427e',1,'',0,'','');

UPDATE core_usuario SET ultimo_acceso=CAST(now() AS date);

DROP TABLE IF EXISTS core_auditoria;
CREATE TABLE core_auditoria (
  id serial,
  usuario_login varchar(250) NOT NULL,
  accion text,
  fecha date NOT NULL,
  hora time NOT NULL,
  PRIMARY KEY  (id)
);

DROP TABLE IF EXISTS core_menu;
CREATE TABLE core_menu (
  id serial,
  texto varchar(250) default '',
  padre integer default '0',
  peso integer default '0',
  url text,
  destino varchar(250) default '',
  tipo_comando varchar(15) default 'Interno', 
  comando text,
  nivel_usuario integer default '0',
  columna integer default '1',
  posible_arriba integer default '0',
  posible_centro integer default '1',
  posible_escritorio integer default '0',
  seccion varchar(250) default '', 
  imagen varchar(250) default '',
  posible_izquierda integer default '0',
  tipo_menu varchar(10) default 'opc',
  formulario_vinculado integer default '0',
  clase_contenedor varchar(250) default '',
  PRIMARY KEY  (id)
);

DROP TABLE IF EXISTS core_usuario_menu;
CREATE TABLE core_usuario_menu (
  id serial,
  usuario varchar(250) NOT NULL default '',
  menu integer NOT NULL default '0',
  PRIMARY KEY  (id)
);

DROP TABLE IF EXISTS core_formulario;
CREATE TABLE core_formulario (
  id serial,
  titulo varchar(250) default '',
  ayuda_titulo varchar(250) default '',
  ayuda_texto text,
  tabla_datos varchar(250) default '',
  columnas integer default '1',
  javascript text,
  borde_visible integer default '0',
  estilo_pestanas varchar(10) default 'nav-tabs',
  id_html varchar(255) DEFAULT '',
  tipo_maquetacion varchar(11) DEFAULT 'tradicional',
  css_columnas text,
  PRIMARY KEY  (id)
);

DROP TABLE IF EXISTS core_formulario_objeto;
CREATE TABLE core_formulario_objeto (
  id serial,
  tipo varchar(20),
  titulo varchar(250) default '',
  campo varchar(250) default '',
  ayuda_titulo varchar(50) default '',
  ayuda_texto text,
  formulario integer,
  peso integer,
  columna integer default '1',
  obligatorio integer default '0',
  visible integer default '1',
  valor_predeterminado varchar(250) default '',
  validacion_datos varchar(20) default '',
  etiqueta_busqueda varchar(50) default '',
  ajax_busqueda integer default '1',
  valor_unico integer default '0',
  solo_lectura varchar(10) default '',
  ancho integer default '0',
  alto integer default '0',
  barra_herramientas integer,
  fila_unica integer,
  lista_opciones text,
  origen_lista_opciones varchar(250),
  origen_lista_valores varchar(250),
  valor_etiqueta text,
  url_iframe varchar(250),
  objeto_en_ventana integer,
  informe_vinculado integer,
  maxima_longitud integer default '0',
  valor_minimo integer default '0',
  valor_maximo integer default '100',
  valor_salto integer default '1',
  formato_salida varchar(250) default '',
  plantilla_archivo varchar(250) default '',
  peso_archivo integer,
  tamano_pincel integer,
  color_trazo varchar(20) default '',
  formulario_vinculado integer,
  formulario_campo_vinculo varchar(250) default '',
  formulario_campo_foraneo varchar(250) default '',
  condicion_filtrado_listas varchar(250) default '',
  pestana_objeto varchar(250) default '',
  personalizacion_tag text,
  modo_inline integer default 0,
  imagen varchar(250) default '',
  tipo_accion varchar(250) default '',
  accion_usuario text,
  valor_check_activo varchar(250) DEFAULT '',
  valor_check_inactivo varchar(250) DEFAULT '',
  valor_placeholder varchar(255) DEFAULT '',
  ocultar_etiqueta integer DEFAULT 0,
  id_html varchar(255) DEFAULT '',
  validacion_extras varchar(255) DEFAULT '',
  clase_contenedor varchar(255) DEFAULT '',
  ajax_busqueda_dinamica integer default '0',
  PRIMARY KEY  (id)
);

DROP TABLE IF EXISTS core_evento_objeto;
CREATE TABLE core_evento_objeto (
  id serial,
  objeto integer,
  evento varchar(250) default '',
  javascript text,
  PRIMARY KEY  (id)
);

DROP TABLE IF EXISTS core_evento_inventario;
CREATE TABLE core_evento_inventario (
  id serial,
  evento varchar(250) default '',
  categoria varchar(250) default '',
  descripcion varchar(250) default '',
  PRIMARY KEY  (id)
);

INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onclick',                    '01. Raton (Mouse)',        '$MULTILANG_EventoClick');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('ondblclick',                 '01. Raton (Mouse)',        '$MULTILANG_EventoDobleClick');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onmousedown',                '01. Raton (Mouse)',        '$MULTILANG_EventoMouseDown');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onmouseenter',               '01. Raton (Mouse)',        '$MULTILANG_EventoMouseEnter');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onmouseleave',               '01. Raton (Mouse)',        '$MULTILANG_EventoMouseLeave');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onmousemove',                '01. Raton (Mouse)',        '$MULTILANG_EventoMouseMove');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onmouseover',                '01. Raton (Mouse)',        '$MULTILANG_EventoMouseOver');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onmouseout',                 '01. Raton (Mouse)',        '$MULTILANG_EventoMouseOut');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onmouseup',                  '01. Raton (Mouse)',        '$MULTILANG_EventoMouseUp');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('contextmenu',                '01. Raton (Mouse)',        '$MULTILANG_EventoContextMenu');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onkeydown',                  '02. Teclado (Keyboard)',   '$MULTILANG_EventoKeyDown');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onkeypress',                 '02. Teclado (Keyboard)',   '$MULTILANG_EventoKeyPress');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onkeyup',                    '02. Teclado (Keyboard)',   '$MULTILANG_EventoKeyUp');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onfocus',                    '03. Formularios (Forms)',  '$MULTILANG_EventoFocus');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onblur',                     '03. Formularios (Forms)',  '$MULTILANG_EventoBlur');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onchange',                   '03. Formularios (Forms)',  '$MULTILANG_EventoChange');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onselect',                   '03. Formularios (Forms)',  '$MULTILANG_EventoSelect');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onsubmit',                   '03. Formularios (Forms)',  '$MULTILANG_EventoSubmit');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onreset',                    '03. Formularios (Forms)',  '$MULTILANG_EventoReset');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('oncut',                      '03. Formularios (Forms)',  '$MULTILANG_EventoCut');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('oncopy',                     '03. Formularios (Forms)',  '$MULTILANG_EventoCopy');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onpaste',                    '03. Formularios (Forms)',  '$MULTILANG_EventoPaste');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onload',                     '04. Ventanas y Marcos (Windows & Frames)','$MULTILANG_EventoLoad');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onunload',                   '04. Ventanas y Marcos (Windows & Frames)','$MULTILANG_EventoUnload');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onresize',                   '04. Ventanas y Marcos (Windows & Frames)','$MULTILANG_EventoResize');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onclose',                    '04. Ventanas y Marcos (Windows & Frames)','$MULTILANG_EventoClose');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onscroll',                   '04. Ventanas y Marcos (Windows & Frames)','$MULTILANG_EventoScroll');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('animationend',               '05. Animaciones y Transiciones','$MULTILANG_EventoAnimFin');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('animationiteration',         '05. Animaciones y Transiciones','$MULTILANG_EventoAnimIteracion');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('animationstart',             '05. Animaciones y Transiciones','$MULTILANG_EventoAnimInicio');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('beginEvent',                 '05. Animaciones y Transiciones','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('endEvent',                   '05. Animaciones y Transiciones','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('repeatEvent',                '05. Animaciones y Transiciones','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('transitionend',              '05. Animaciones y Transiciones','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('chargingchange',             '06. Bateria y carga (Battery & charge)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('chargingtimechange',         '06. Bateria y carga (Battery & charge)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('dischargingtimechange',      '06. Bateria y carga (Battery & charge)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('levelchange',                '06. Bateria y carga (Battery & charge)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('alerting',                   '07. Llamadas y Telefonia (Calls)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('busy',                       '07. Llamadas y Telefonia (Calls)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('callschanged',               '07. Llamadas y Telefonia (Calls)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('connected',                  '07. Llamadas y Telefonia (Calls)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('connecting',                 '07. Llamadas y Telefonia (Calls)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('dialing',                    '07. Llamadas y Telefonia (Calls)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('disconnected',               '07. Llamadas y Telefonia (Calls)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('disconnecting',              '07. Llamadas y Telefonia (Calls)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('error',                      '07. Llamadas y Telefonia (Calls)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('held',                       '07. Llamadas y Telefonia (Calls)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('holding',                    '07. Llamadas y Telefonia (Calls)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('incoming',                   '07. Llamadas y Telefonia (Calls)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('resuming',                   '07. Llamadas y Telefonia (Calls)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('statechange',                '07. Llamadas y Telefonia (Calls)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('DOMAttrModified',            '08. Cambios DOM (DOM changes)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('DOMCharacterDataModified',   '08. Cambios DOM (DOM changes)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('DOMContentLoaded',           '08. Cambios DOM (DOM changes)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('DOMElementNameChanged',      '08. Cambios DOM (DOM changes)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('DOMNodeInserted',            '08. Cambios DOM (DOM changes)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('DOMNodeInsertedIntoDocument','08. Cambios DOM (DOM changes)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('DOMNodeRemoved',             '08. Cambios DOM (DOM changes)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('DOMNodeRemovedFromDocument', '08. Cambios DOM (DOM changes)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('DOMSubtreeModified',         '08. Cambios DOM (DOM changes)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('drag',                       '09. Arrastre de elementos (Drag&Drop)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('dragend',                    '09. Arrastre de elementos (Drag&Drop)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('dragenter',                  '09. Arrastre de elementos (Drag&Drop)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('dragleave',                  '09. Arrastre de elementos (Drag&Drop)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('dragover',                   '09. Arrastre de elementos (Drag&Drop)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('dragstart',                  '09. Arrastre de elementos (Drag&Drop)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('drop',                       '09. Arrastre de elementos (Drag&Drop)','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('audioprocess',               '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('canplay',                    '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('canplaythrough',             '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('durationchange',             '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('emptied',                    '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('ended',                      '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('loadeddata',                 '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('loadedmetadata',             '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('pause',                      '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('play',                       '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('playing',                    '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('ratechange',                 '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('seeked',                     '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('seeking',                    '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('stalled',                    '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('suspend',                    '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('timeupdate',                 '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('volumechange',               '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('waiting',                    '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('complete',                   '10. Audio & Video','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('disabled',                   '11. Conexion a Internet','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('enabled',                    '11. Conexion a Internet','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('onoffline',                  '11. Conexion a Internet','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('ononline',                   '11. Conexion a Internet','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('statuschange',               '11. Conexion a Internet','');
INSERT INTO core_evento_inventario (evento,categoria,descripcion) VALUES ('connectionInfoUpdate',       '11. Conexion a Internet','');

DROP TABLE IF EXISTS core_formulario_boton;
CREATE TABLE core_formulario_boton (
  id serial,
  titulo varchar(250) default '',
  estilo varchar(250) default '',
  formulario integer,
  tipo_accion varchar(250) default '',
  accion_usuario text,
  visible integer default '1',
  peso integer,
  retorno_titulo varchar(50) default '',
  retorno_texto text,
  confirmacion_texto varchar(250) default '',
  retorno_icono varchar(50) DEFAULT '',
  retorno_estilo varchar(50) DEFAULT '',
  PRIMARY KEY  (id)
);

DROP TABLE IF EXISTS core_informe;
CREATE TABLE core_informe (
  id serial,
  titulo varchar(250),
  descripcion varchar(250),
  categoria varchar(250), 
  agrupamiento varchar(250),
  ordenamiento varchar(250),
  ancho varchar(5),
  alto varchar(5),
  formato_final char(1), 
  formato_grafico text, 
  genera_pdf char(1), 
  variables_filtro text,
  soporte_datatable char(1) DEFAULT 'N',
  formulario_filtrado VARCHAR(5) DEFAULT '',
  tamano_paginacion integer DEFAULT '10',
  subtotales_columna varchar(255) DEFAULT '',
  subtotales_formato varchar(255) DEFAULT '',
  conexion_origen_datos varchar(255) DEFAULT '',
  consulta_sql text,
  tooltip_titulo char(1) DEFAULT 'N',
  exportar_dtclp char(1) DEFAULT 'N',
  exportar_dtcsv char(1) DEFAULT 'N',
  exportar_dtxls char(1) DEFAULT 'N',
  exportar_dtpdf char(1) DEFAULT 'N',
  ocultar_encabezado integer DEFAULT '0',
  ocultar_piepagina integer DEFAULT '0',
  anular_acciones integer DEFAULT '0',
  PRIMARY KEY  (id)
);

DROP TABLE IF EXISTS core_informe_campos;
CREATE TABLE core_informe_campos (
  id serial,
  informe integer,
  valor_campo varchar(250),
  valor_alias varchar(250),
  peso integer,
  visible integer DEFAULT 1,
  editable integer DEFAULT 0,
  titulo_arbitrario varchar(255) DEFAULT '',
  PRIMARY KEY (id)
);

DROP TABLE IF EXISTS core_informe_tablas;
CREATE TABLE core_informe_tablas (
  id serial,
  informe integer,
  valor_tabla varchar(250),
  valor_alias varchar(250),
  PRIMARY KEY (id)
);

DROP TABLE IF EXISTS core_informe_condiciones;
CREATE TABLE core_informe_condiciones (
  id serial,
  informe integer,
  valor_izq varchar(250),
  operador varchar(250),
  valor_der varchar(250),
  peso integer default '0',
  PRIMARY KEY (id)
);

DROP TABLE IF EXISTS core_informe_boton;
CREATE TABLE core_informe_boton (
  id serial,
  titulo varchar(250) default '',
  estilo varchar(250) default '',
  informe integer,
  tipo_accion varchar(250) default '',
  accion_usuario varchar(250) default '',
  visible integer default '1',
  peso integer,
  confirmacion_texto varchar(250) default '',
  destino varchar(250) default '_self',
  pantalla_completa integer default '0',
  precargar_estilos integer default '1',
  imagen varchar(250) DEFAULT '',
  ubicar_principio integer default '0',
  PRIMARY KEY  (id)
);

DROP TABLE IF EXISTS core_usuario_informe;
CREATE TABLE core_usuario_informe (
  id serial,
  usuario varchar(250) NOT NULL,
  informe integer NOT NULL,
  PRIMARY KEY  (id)
);

DROP TABLE IF EXISTS core_llaves_api;
CREATE TABLE core_llaves_api (
  id serial,
  nombre varchar(15) NOT NULL,
  llave varchar(50) NOT NULL,
  secreto varchar(50) NOT NULL,
  uri varchar(255) NOT NULL,
  dominio_autorizado varchar(255) NOT NULL,
  ip_autorizada varchar(255) NOT NULL,
  funciones_autorizadas text,
  PRIMARY KEY (id)
);

DROP TABLE IF EXISTS core_chat;
CREATE TABLE core_chat (
  id serial,
  remitente VARCHAR(255) NOT NULL DEFAULT '',
  destinatario VARCHAR(255) NOT NULL DEFAULT '',
  message TEXT,
  sent TIMESTAMP,
  recd INTEGER NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
);	

DROP TABLE IF EXISTS core_monitoreo;
CREATE TABLE core_monitoreo (
  id serial,
  tipo VARCHAR(20) NOT NULL DEFAULT '',
  pagina integer NOT NULL,
  peso integer NOT NULL,
  nombre VARCHAR(255) NOT NULL DEFAULT '',
  host VARCHAR(255) NOT NULL DEFAULT '',
  puerto VARCHAR(255) NOT NULL DEFAULT '',
  tipo_ping VARCHAR(255) NOT NULL DEFAULT '',
  saltos integer NOT NULL,
  comando TEXT,
  ancho integer NOT NULL,
  alto integer NOT NULL, 
  tamano_resultado integer NOT NULL,
  ocultar_titulos integer NOT NULL,
  path VARCHAR(255) NOT NULL DEFAULT '',
  correo_alerta VARCHAR(255) NOT NULL DEFAULT '',
  alerta_sonora integer default '0',
  milisegundos_lectura integer default '1',
  alerta_vibracion integer default '0',
  ultimo_estado VARCHAR(250) DEFAULT '',
  valor_minimo integer,
  valor_maximo integer,
  conexion_origen_datos varchar(255) DEFAULT '',
  modo_compacto integer DEFAULT '0',
  PRIMARY KEY (id)
);

DROP TABLE IF EXISTS core_replicasbd;
CREATE TABLE core_replicasbd (
  id serial,
  nombre VARCHAR(255) NOT NULL DEFAULT '',
  servidorbd VARCHAR(255) NOT NULL DEFAULT '',
  basedatos VARCHAR(255) NOT NULL DEFAULT '',
  usuariobd VARCHAR(255) NOT NULL DEFAULT '',
  passwordbd VARCHAR(255) NOT NULL DEFAULT '',
  motorbd VARCHAR(255) NOT NULL DEFAULT '',
  puertobd VARCHAR(255) NOT NULL DEFAULT '',
  tipo_replica INTEGER DEFAULT '0',
  PRIMARY KEY (id)
);

DROP TABLE IF EXISTS core_kanban;
CREATE TABLE core_kanban (
  id serial,
  login_admintablero varchar(250),
  titulo varchar(255),
  descripcion text,
  asignado_a varchar(250),
  categoria varchar(255),
  columna integer,
  peso integer,
  estilo varchar(15),
  fecha  date NOT NULL default '20000101',
  archivado integer,
  compartido_rw TEXT,
  tablero integer,
  porcentaje integer default '0',
  PRIMARY KEY (id)
);
ALTER TABLE core_kanban ADD INDEX columna(columna);
ALTER TABLE core_kanban ADD INDEX login_admintablero(login_admintablero);

DROP TABLE IF EXISTS core_opcionlista;
CREATE TABLE core_opcionlista (
  id serial,
  identificador_lista varchar(250),
  valor_interno varchar(255),
  valor_visual varchar(255),
  ordenamiento integer,
  PRIMARY KEY (id)
);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_grafico','T','{$MULTILANG_TablaDatos}',1);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_grafico','G','{$MULTILANG_Grafico}',2);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('dicotomico_sino','S','{$MULTILANG_Si}',1);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('dicotomico_sino','N','{$MULTILANG_No}',2);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('dicotomico_nosi','N','{$MULTILANG_No}',1);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('dicotomico_nosi','S','{$MULTILANG_Si}',2);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('booleano_nosi','0','{$MULTILANG_No}',1);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('booleano_nosi','1','{$MULTILANG_Si}',2);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('booleano_sino','1','{$MULTILANG_Si}',1);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('booleano_sino','0','{$MULTILANG_No}',2);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('visibilidad_oauth','1','{$MULTILANG_OauthOpcionBoton}',1);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('visibilidad_oauth','0','{$MULTILANG_OauthOpcionDirecta}',2);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('motores_bd','mysql','MySQL - MariaDB (3.x/4.x/5.x)',1);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('motores_bd','pgsql','PostgreSQL',2);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('motores_bd','sqlite','SQLite v2 - SQLite v3',3);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('motores_bd','sqlsrv','FreeTDS/Microsoft SQL Server: Win32 [max version 2008]',4);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('motores_bd','mssql','FreeTDS/Microsoft SQL Server: Win32&Linux, [max version 2000]',5);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('motores_bd','ibm','IBM (DB2)',6);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('motores_bd','dblib','DBLIB',7);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('motores_bd','odbc','Microsoft Access (ODBC v3: IBM DB2, unixODBC, Win32 ODBC)',8);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('motores_bd','oracle','ORACLE (OCI Oracle Call Interface)',9);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('motores_bd','ifmx','Informix (IBM Informix Dynamic Server)',10);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('motores_bd','fbd','Firebird (Firebird/Interbase 6)',11);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipo_monitor','{$MULTILANG_Deshabilitado}','{$MULTILANG_Deshabilitado}',1);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipo_monitor','Etiqueta','{$MULTILANG_Etiqueta}',2);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipo_monitor','Maquina','{$MULTILANG_Maquina}',3);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipo_monitor','ComandoShell','{$MULTILANG_MonCommShell}',4);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipo_monitor','ComandoSQL','{$MULTILANG_MonCommSQL}',5);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipo_monitor','Imagen','{$MULTILANG_Imagen}',6);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipo_monitor','Embebido','{$MULTILANG_Embebido}',7);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipo_monitor','SensorRango','{$MULTILANG_MonSensorRango}',8);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipo_monitor','SensorMaquina','{$MULTILANG_MonSensorRango} ({$MULTILANG_Apariencia} {$MULTILANG_Maquina})',9);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('metodos_monitor','socket','Socket',1);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('metodos_monitor','ping','Ping',2);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('metodos_monitor','curl:1','cURL (HTTP 01 sec. Timeout)',3);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('metodos_monitor','curl:3','cURL (HTTP 03 sec. Timeout)',4);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('metodos_monitor','curl:5','cURL (HTTP 05 sec. Timeout)',5);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('metodos_monitor','curl:10','cURL (HTTP 10 sec. Timeout)',6);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('metodos_monitor','curl:15','cURL (HTTP 15 sec. Timeout)',7);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('metodos_monitor','curl:30','cURL (HTTP 30 sec. Timeout)',8);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('opciones_menu','opc','{$MULTILANG_Opcion}',1);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('opciones_menu','grp','{$MULTILANG_Agrupador}',2);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('destino_menu','_self','{$MULTILANG_MnuTgtSelf}',1);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('destino_menu','_blank','{$MULTILANG_MnuTgtBlank}',2);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('destino_menu','_parent','{$MULTILANG_MnuTgtParent}',3);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('destino_menu','_top','{$MULTILANG_MnuTgtTop}',4);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('comando_menu','Objeto','1. {$MULTILANG_MnuObjeto}',1);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('comando_menu','Interno','2. {$MULTILANG_MnuInterno}',2);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('comando_menu','Personal','3. {$MULTILANG_MnuPersonal}',3);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('motores_bd','---------------','-------------------------------------- NoSQL -------------------------------------',12);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('motores_bd','couchbase','CouchBase',13);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('modo_monitor','0','{$MULTILANG_No}',1);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('modo_monitor','1','{$MULTILANG_Si}',2);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('modo_monitor','2','Ultra',3);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_maquetacion','tradicional','{$MULTILANG_FrmTradicional}',1);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_maquetacion','responsive','Responsive',2);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('estilos_pestanas','nav-tabs','{$MULTILANG_FrmEstiloTabs}',1);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('estilos_pestanas','nav-pills','{$MULTILANG_FrmEstiloPills}',2);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('estilos_pestanas','','{$MULTILANG_FrmEstiloOculto}',3);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'_OPTGROUP_|Planificacion simple / Simple schedule',	'',	1);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'@reboot',	'Al inicio del sistema / At system boot',	2);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'@annually',	'Una vez al ano / Once per year',	3);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'@monthly',	'Una vez al mes / Once per month',	4);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'@weekly',	'Una vez a la semana / Once per week',	5);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'@daily',	'Una vez al dia / Once per day',	6);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'@hourly',	'Una vez por hora / Once per hour',	7);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'_OPTGROUP_',	'',	8);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'_OPTGROUP_|Ejemplos de otras combinaciones / Other schedules examples',	'',	9);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'15 10 * * *',	'Diario a las 10:15 AM / Daily at 10:15 AM',	10);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'15 22 * * *',	'Diario a las 10:15 PM / Daily at 10:15 PM',	11);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'00 10 * * 0',	'Domingos a las 10:00 AM / Sundays at 10:00 AM',	12);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'30 7 20 11 *',	'Noviembre 20 a las 7:30 AM / November 20th 7:30AM',	13);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'01 * * * *',	'Cada minuto / Each minute',	14);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'_OPTGROUP_',	'',	15);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'_OPTGROUP_|Ejemplos de uso de rangos / Interval examples',	'',	16);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'30 17 * * 1,2,3,4,5',	'De lunes a viernes, 5:30 PM / Lun-Fri 5:30PM',	17);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'00 12 1,15 * *',	'Dias 1 y 15 a las 12M / Days 1 and 5 at 12M',	18);
INSERT INTO core_opcionlista (identificador_lista,valor_interno,valor_visual,ordenamiento) VALUES ('tipos_planificacion',	'_OPTGROUP_',	'',	19);

DROP TABLE IF EXISTS core_bugtracker;
CREATE TABLE core_bugtracker (
  id serial,
  fecha_apertura timestamp,
  fecha_actualizacion timestamp,
  fecha_cierre timestamp,
  proyecto varchar(255),
  proyecto_version varchar(30),
  titulo varchar(255),
  descripcion text,
  categoria varchar(255),
  estado varchar(20),
  severidad varchar(20),
  prioridad varchar(20),
  reportado_por varchar(250),
  asignado_a varchar(250),
  pasos_reproduccion text,
  sistema_origen varchar(255),
  trazas text,
  adjunto bytea,
  historial_gestion text,
  PRIMARY KEY (id)
);

DROP TABLE IF EXISTS core_tabla_comodin;
CREATE TABLE core_tabla_comodin (
  id serial,
  PRIMARY KEY (id)
);

DROP TABLE IF EXISTS core_tareascron;
CREATE TABLE core_tareascron (
  id serial,
  fecha_creacion date,
  codigo_tarea varchar(255),
  titulo varchar(255),
  script_php text,
  habilitado int(1),
  historial_ejecucion text,
  PRIMARY KEY (id)
);