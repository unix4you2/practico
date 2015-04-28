
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

INSERT INTO core_parametros (id,nombre_empresa_largo,nombre_empresa_corto,nombre_aplicacion,version,fecha_lanzamiento,licencia,creditos,funciones_personalizadas) VALUES (0,'Nombre completo de su empresa','PAR_NombreCortoEmpresa','PAR_NombreAplicacion','PAR_VersionAplicacion','20120101','Texto de su licencia','Texto asociado a los creditos de su aplicacion','');

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
  PRIMARY KEY  (login)
);

INSERT INTO core_usuario VALUES ('admin','21232f297a57a5a743894a0e4a801fc3','Super usuario',1,'sucorreo@dominio.com','20110601','d41d8cd98f00b204e9800998ecf8427e',1,'');

UPDATE core_usuario SET ultimo_acceso=CAST(now() AS date);

DROP TABLE IF EXISTS core_auditoria;
CREATE TABLE core_auditoria (
  id serial,
  usuario_login varchar(250) NOT NULL,
  accion varchar(250) NOT NULL,
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
  comando varchar(250) default '',
  nivel_usuario integer default '0',
  columna integer default '1',
  posible_arriba integer default '0',
  posible_centro integer default '1',
  posible_escritorio integer default '0',
  seccion varchar(250) default '', 
  imagen varchar(250) default '',
  posible_izquierda integer default '0',
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
  ancho integer,
  alto integer,
  barra_herramientas integer,
  fila_unica integer,
  lista_opciones text,
  origen_lista_opciones varchar(250),
  origen_lista_valores varchar(250),
  valor_etiqueta text,
  url_iframe varchar(250),
  objeto_en_ventana integer,
  informe_vinculado integer,
  maxima_longitud integer default 0,
  valor_minimo integer,
  valor_maximo integer,
  valor_salto integer,
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
  PRIMARY KEY  (id)
);

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
  PRIMARY KEY  (id)
);

DROP TABLE IF EXISTS core_informe_campos;
CREATE TABLE core_informe_campos (
  id serial,
  informe integer,
  valor_campo varchar(250),
  valor_alias varchar(250),
  peso integer,
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
  PRIMARY KEY (id)
);
