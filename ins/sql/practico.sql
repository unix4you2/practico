
DROP TABLE IF EXISTS Core_parametros;
CREATE TABLE Core_parametros (
  id int(10) NOT NULL AUTO_INCREMENT,
  nombre_empresa_largo varchar(250) NOT NULL,
  nombre_empresa_corto varchar(50) NOT NULL,
  nombre_aplicacion varchar(100) NOT NULL,
  version varchar(20),
  fecha_lanzamiento date,
  licencia text,
  creditos text,
  PRIMARY KEY  (id)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS Core_usuario;
CREATE TABLE Core_usuario (
  login varchar(20) NOT NULL,
  clave varchar(50) NOT NULL default 'd41d8cd98fd41d8cd98fd41d8cd98fd41d8cd98f',
  nombre varchar(100) NOT NULL default '',
  descripcion varchar(250) NOT NULL default '',
  estado int(1) NOT NULL default '1',
  nivel_usuario int(10) NOT NULL default '0',
  correo varchar(200) NOT NULL default '',
  ultimo_acceso date NOT NULL default '20000101',
  llave_paso varchar(50) NOT NULL default 'd41d8cd98f00b204e9800998ecf8427e',
  PRIMARY KEY  (login)
) ENGINE=MyISAM;
INSERT INTO Core_usuario VALUES ('admin','21232f297a57a5a743894a0e4a801fc3','John Arroyave','Administrador del sistema',1,5,'unix4you2@gmail.com','20110601','d41d8cd98f00b204e9800998ecf8427e');

DROP TABLE IF EXISTS Core_auditoria;
CREATE TABLE Core_auditoria (
  id int(10) NOT NULL AUTO_INCREMENT,
  usuario_login varchar(20) NOT NULL,
  accion varchar(250) NOT NULL,
  fecha date NOT NULL,
  hora time NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS Core_menu;
CREATE TABLE Core_menu (
  id int(10) AUTO_INCREMENT,
  texto varchar(250) default '',
  padre int(10) default '0',
  peso int(3) default '0',
  url varchar(250) default '',
  posible_clic int(1) default '1',
  tipo_comando varchar(15) default 'Interno',  #Interno=De sistema,Personal=funciones en archivo,Objeto=creadas por DynApps
  comando varchar(250) default '',
  nivel_usuario int(10) default '0', # -1=No aplica, sino Rol minimo de usuario que accesan la opcion 
  columna int(1) default '1',
  posible_arriba int(1) default '0',
  posible_centro int(1) default '1',
  posible_escritorio int(1) default '0',
  seccion varchar(250) default '',  #Cuando Posible centro=1 define la seccion donde va por agrupacion
  imagen varchar(250) default '',
  PRIMARY KEY  (id)
) ENGINE=MyISAM;

INSERT INTO Core_menu VALUES (0,'Menus'   ,0,0,'',1,'Interno','administrar_menu',5,2,1,1,1,'Administrativas de Práctico','icono_menus.png');
INSERT INTO Core_menu VALUES (0,'Usuarios',0,0,'',1,'Interno','listar_usuarios' ,5,1,1,1,1,'Administrativas de Práctico','icono_usuarios.png');
INSERT INTO Core_menu VALUES (0,'Tablas de datos',0,0,'',1,'Interno','administrar_tablas' ,5,3,1,1,1,'Administrativas de Práctico','icono_tabla.png');
INSERT INTO Core_menu VALUES (0,'Formularios',0,0,'',1,'Interno','administrar_formularios' ,5,3,1,1,1,'Administrativas de Práctico','icono_form.png');

DROP TABLE IF EXISTS Core_formulario;
CREATE TABLE Core_formulario (
  id int(10) AUTO_INCREMENT,
  titulo varchar(250) default '',
  ayuda_titulo varchar(250) default '',
  ayuda_texto text,
  ayuda_imagen varchar(250) default '',
  tabla_datos varchar(250) default '',
  columnas int(10) default '1',
  PRIMARY KEY  (id)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS Core_formulario_campo;
CREATE TABLE Core_formulario_campo (
  id int(10) AUTO_INCREMENT,
  titulo varchar(250) default '',
  campo varchar(250) default '',
  ayuda_titulo varchar(50) default '',
  ayuda_texto text,
  formulario int(10),
  peso int(10),
  columna int(1) default '1',
  obligatorio int(1) default '0',
  visible int(1) default '1',
  valor_predeterminado varchar(250) default '',
  validacion_datos varchar(20) default '',
  etiqueta_busqueda varchar(50) default '',
  ajax_busqueda int(1) default '1',
  valor_unico int(1) default '0',
  solo_lectura varchar(10) default '',
  teclado_virtual int(1) default '0',
  PRIMARY KEY  (id)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS Core_formulario_boton;
CREATE TABLE Core_formulario_boton (
  id int(10) AUTO_INCREMENT,
  titulo varchar(250) default '',
  estilo varchar(20) default '',
  formulario int(10),
  tipo_accion varchar(250) default '',
  accion_usuario varchar(250) default '',
  visible int(1) default '1',
  peso int(10),
  retorno_titulo varchar(50) default '',  
  retorno_texto text,
  confirmacion_texto varchar(250) default '',
  PRIMARY KEY  (id)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS Core_informes;
CREATE TABLE Core_informes (
  id int(10) AUTO_INCREMENT,
  acceso_directo varchar(250),
  titulo varchar(250),
  descripcion varchar(250),
  categoria varchar(250),
  usuarios text,
  campos text,
  alias text,
  tablas varchar(250),
  condiciones text,
  agrupamiento varchar(250),
  ordenamiento varchar(250),
  filtro_fecha varchar(50),
  filtro_cliente varchar(50),
  filtro_texto varchar(50),
  signo_texto varchar(10),
  PRIMARY KEY  (id)
) ENGINE=MyISAM;
