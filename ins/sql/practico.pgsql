
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
  PRIMARY KEY  (id)
);

INSERT INTO core_parametros VALUES (0,'Nombre completo de su empresa','PAR_NombreCortoEmpresa','PAR_NombreAplicacion','PAR_VersionAplicacion','20120101','Texto de su licencia','Texto asociado a los creditos de su aplicacion','');

DROP TABLE IF EXISTS core_usuario;
CREATE TABLE core_usuario (
  login varchar(250) NOT NULL,
  clave varchar(50) NOT NULL default 'd41d8cd98fd41d8cd98fd41d8cd98fd41d8cd98f',
  nombre varchar(100) NOT NULL default '',
  descripcion varchar(250) NOT NULL default '',
  estado integer NOT NULL default '1',
  nivel integer NOT NULL default '0',
  correo varchar(200) NOT NULL default '',
  ultimo_acceso date NOT NULL default '20000101',
  llave_paso varchar(50) NOT NULL default 'd41d8cd98f00b204e9800998ecf8427e',
  PRIMARY KEY  (login)
);

INSERT INTO core_usuario VALUES ('admin','21232f297a57a5a743894a0e4a801fc3','Super usuario','Administrador del sistema',1,5,'unix4you2@gmail.com','20110601','d41d8cd98f00b204e9800998ecf8427e');

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
  url varchar(250) default '',
  posible_clic integer default '1',
  tipo_comando varchar(15) default 'Interno', 
  comando varchar(250) default '',
  nivel_usuario integer default '0',
  columna integer default '1',
  posible_arriba integer default '0',
  posible_centro integer default '1',
  posible_escritorio integer default '0',
  seccion varchar(250) default '', 
  imagen varchar(250) default '',
  PRIMARY KEY  (id)
);

INSERT INTO core_menu VALUES (1,'Cambio de clave',0,0,'',1,'Interno','cambiar_clave' ,5,3,1,0,0,'Opciones generales de usuario','icono_llave.png');
INSERT INTO core_menu VALUES (2,'Actualizaciones',0,0,'',1,'Interno','actualizar_practico' ,5,3,1,0,0,'Administrativas - Dise&ntilde;ador de aplicaciones','bajar.png');
INSERT INTO core_menu VALUES (3,'Mis Informes',0,0,'',1,'Interno','mis_informes' ,5,3,0,0,1,'Opciones generales de usuario','compfile.png');


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
  ayuda_imagen varchar(250) default '',
  tabla_datos varchar(250) default '',
  columnas integer default '1',
  javascript text,
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
  teclado_virtual integer default '0',
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
  PRIMARY KEY  (id)
);

DROP TABLE IF EXISTS core_formulario_boton;
CREATE TABLE core_formulario_boton (
  id serial,
  titulo varchar(250) default '',
  estilo varchar(20) default '',
  formulario integer,
  tipo_accion varchar(250) default '',
  accion_usuario varchar(250) default '',
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
  nivel_usuario integer default '0',
  ancho varchar(5),
  alto varchar(5),
  formato_final char(1), 
  formato_grafico text, 
  genera_pdf char(1), 
  PRIMARY KEY  (id)
);

DROP TABLE IF EXISTS core_informe_campos;
CREATE TABLE core_informe_campos (
  id serial,
  informe integer,
  valor_campo varchar(250),
  valor_alias varchar(250),
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
  estilo varchar(20) default '',
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
