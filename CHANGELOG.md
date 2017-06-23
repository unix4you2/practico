```
 _                      _                            _     _           
| |    ___   __ _    __| | ___    ___ __ _ _ __ ___ | |__ (_) ___  ___ 
| |   / _ \ / _` |  / _` |/ _ \  / __/ _` | '_ ` _ \| '_ \| |/ _ \/ __|
| |__| (_) | (_| | | (_| |  __/ | (_| (_| | | | | | | |_) | | (_) \__ \
|_____\___/ \__, |  \__,_|\___|  \___\__,_|_| |_| |_|_.__/|_|\___/|___/
            |___/ 
```

## Versión 17.7 (2017-07-02)
* Added: Posibilidad de seleccionar el tema grafico para el framework gracias a bootswatch
* Enhan: Tema predeterminado de bootstrap es ahora tomado desde el archivo optimizado
* Enhan: Eliminados archivos innecesarios de bootstrap sobre produccion.  Se dejan solo los optimizados.
* Added: Creada funcion PCO_BuscarErroresSintaxisPHP(path_archivo) que permite evaluar el codigo realizado en modulos externos a Practico y creados por el programador, de manera que se pueda validar la sintaxis de un archivo antes de ser incluido en la ejecucion.  Retorna 0 si no hay errores o 1 si hay errores de sintaxis en el archivo.
* Added: Creadas funciones propias para la captura de errores y excepciones de PHP durante y presentacion de los detalles al usuario cuando se encuentra activado el modo de depuracion.
* Added: Aquellos botones tipo comando JavaScript agregados a los informes pueden ahora transportar sobre JavaScript el valor de las variables de identificador de registro mediante el formulario document.FRMBASEINFORME.PCO_Valor.value
* Enhan: El sistema de monitoreo se simplifica para presentar los embebidos sin su direccion y titulo mas pequeno.
* Enhan: Elementos de formulario marcados como fila unica ahora son maquetados dentro de una tabla al 100% del ancho del formulario.
* Enhan: Eliminada la impresión del título de formulario en funciones de ImprimirMarco.
* Fixed: Clonación de informes presenta correctamente el ID del nuevo informe clonado.
* Enhan: Las condiciones y campos en informes ahora soportan más de una variable PHP.  Para esto se debe recordar que la sintaxis es mediante la oficial de PHP encerrada entre llaves y comenzando por signo pesos: {$ variable}.  Cualquier informe donde se relacionen las variables PHP simplemente con signo pesos al comienzo debe ser actualizado previamente a la sintaxis sugerida para garantizar la compatibilidad.
* Added: Las etiquetas en opciones de menu ahora soportan variables PHP bajo la notación oficial de llaves y empezando por signo pesos.  Dando mayor compatibilidad hacia aplicaciones que soportan multiples idiomas. 
* Added: Las etiquetas en campos de formulario ahora soportan variables PHP bajo la notación oficial de llaves y empezando por signo pesos.  Dando mayor compatibilidad hacia aplicaciones que soportan multiples idiomas.  Esto incluye además las etiquetas o contenidos fijos que puedan agregarse sobre controles HTML y botones de comando facilitando el diseño de aplicaciones multiligue.
* Enhan: Marcos para presentacion de contenidos emergentes son ahora ocultados en formatos de impresion
* Enhan: El marco superior que contiene la barra de titulo, logo y dropdown ha sido marcado con el id BarraNavegacionSuperior para facilitar operaciones desde JS
* Enhan: Simplificados los estilos de la barra de navegacion izquierda para facilitar su compatibilidad con el nuevo disenador de formularios.
* Added: Creada una nueva seccion (marco) llamado PCODIV_SeccionLateralFlotante al que se puede insertar contenidos dinamicamente y que puede ser visualizada mediante triggers al elemento $("#menu-toggle").click() o mediante las funciones PCOJS_OcultarBarraFlotanteIzquierda, PCOJS_VerBarraFlotanteIzquierda o PCOJS_AlternarBarraFlotanteIzquierda
* Added: Mejorada la edicion de formularios.  Ahora se permite realizar algunas operaciones en caliente sobre los campos.
* Enhan: Se mueven las funciones de cambios de estado para los campos hacia el archivo de ajax.php facilitando los procesos de depuracion.
* Enhan: Mejorada la búsqueda en Zonas horarias para el panel de configuración. 
* Enhan: Disenador de formularios se presenta ahora en pantalla completa mostrando el tamaño real final del objeto.  Su edición de elementos se hace ahora desde la barra deslizante izquierda.
* Enhan: Mejorada la selección de algoritmos de encripción para autenticación por LDAP el panel de configuración. 
* Enhan: Mejorada la selección de algoritmos de encripción para autenticación federada en el panel de parámetros. 
* Added: Agregadas las funciones "bAutoWidth": true, "fnInitComplete": function() { this.fnAdjustColumnSizing(true); },  a todas las tablas de datos para facilitar su redimensionamiento cuando cambia de tamano la ventana activa.
* Fixed: Eliminacion de formularios tiene en cuenta el eliminar los eventos JS asociados a sus elementos internos.
* Fixed: Eliminacion individual de controles tiene en cuenta el eliminar los eventos JS asociados a este.
* Enhan: La edicion de scripts JS asociados al formulario se hacen directamente sobre este, permitiendo actualizar sobre el mismo editor sin necesidad de cerrar la ventana y actualizar todo el formulario. 
* Fixed: Por defecto cuando no se especifica un proveedor SMTP predeterminado para el envío de mensajes el sistema tomará por defecto el proveedor Interno (Sendmail, Postfix, etc.)
* Fixed: Para aquellos desarrolladores que eliminan las funciones FrmAutoRun de sus formularios ahora el sistema detecta ese escenario y solo llama a la funcion FrmAutoRun cuando en realidad existe.
* Added: La clonación en línea y mediante archivos XML de formularios incluye ahora los eventos JS internos definidos en cada control.

## Versión 17.4 (2017-04-02)
Added: Ahora los formularios con campos marcados como obligatorios realizan su proceso de validación en caliente del lado del cliente. El proceso de validación del lado del servidor continúa para efectos de garantizar integridad de los datos. Los usuarios verán una ventana emergente de manera automática cuando les falte algún campo por diligenciar indicando además su nombre.
Added: Posibilidad de seleccionar el idioma en la ventana de login de manera independiente para cada usuario. Configurable desde el panel de control, sección de idioma. Esto crea una variable de sesión llamada $PCOSESS_IdiomaUsuario con lo seleccionado por éste que podrá ser utilizada posteriormente por el programador.
Added: El sistema de monitoreo permite agregar monitores donde se requiere medir rangos especificos. El valor a comparar entre el rango minimo y maximo puede ser obtenido mediante comandos SQL y Shell que deberan retornar unicamente valores enteros.
Added: Actualizacion del plugin DataTables a la versión 1.10.13 y en versiones optimizadas de archivos (minimizadas)
Fixed: Cierre adecuado de los pie de pagina en tablas de informes al momento de ser embebidos.
Added: Ayudas en adición de monitores.
Added: Visor del sistema de monitoreo permite configurar una página para que sea recurrente y se actualice sólo esta, en lugar de rotar por todas las páginas definidas.
Added: Scripts especificos de instalacion sobre SQL Server bajo conexiones DBLib
Fixed: Módulo de gestion de archivos ahora distingue entre usuarios definidos como administratores en el panel de configuración para agregar los recursos.
Added: Compatibilidad MariaDB y MySQL 5.7 en clausulas order by cuando sql_mode=only_full_group_by se agregan los campos de id al order by para evitar conflictos con esta nueva configuración.
Fixed: Login automático desde el panel de desarrollo hacia gestores de bases de datos configurados bajo SQL Server y drivers dblib.
Enhan: Ahora la funcion ejecutar_sql_unaria() retorna el arreglo asociativo fetch(PDO::FETCH_ASSOC) correspondiente al resultado de la ejecucion en caso de ser requerido.
Added: Nueva funcion obtener_ultimo_id_insertado($ConexionPDO) devuelve el id de registro del último registro insertado por medio de la conexion.
Added: Los objetos de tipo botón de comando sobre formularios soportan ahora la propiedad id_html para ser manipulables desde JS y crear eventos.
Fixed: #78 Ahora durante el diseño de informes se inhabilita la adición de operadores lógicos cuando se ha hecho cambios en alguno de los campos de expresiones u operadores de comparación para evitar errores de sintaxis posteriores sobre SQL.
Added: Ahora cuando se cuenta con proveedores OAuth registrados se puede configurar para que la pantalla de acceso al sistema los presente de manera predeterminada en lugar del acceso por autenticación nativa.
Fixed: Ahora no se generan múltiples funciones de validación en los casos donde se proyectos subformularios con campos obligatorios. Sólo es generada una función para todos. La variable PCOJS_ListaCamposValidar queda con el arreglo de campos a validar en caso que se requiera intervenir.
Enhan: Los sensores por rango para el sistema de monitoreo permiten evaluar ahora valores fijos. Si el valor mínimo y máximo de un valor de sensor en rango son iguales entonces el sensor cambiará el modo a evaluación de igualdad del valor.
Added: Se agrega posibilidad de detectar el estado de conexion del cliente (sin importar si es PC, movil, tableta, etc) y presentar un mensaje para impedir la actividad del sistema hasta que se retorne la conexion. Opera en ambas vías, tanto para cuando el cliente tiene problemas de conectividad como cuando el servidor donde corre el sistema no puede responder. Para probar simplemente desconecte su red y espere el cambio de estado, luego conecte la red y vera que es restablecido el sistema. El tiempo preestablecido para estos chequeos es de 5 segundos, no personalizables por ahora.
NOTA: Personas que hayan aplicado parches 17.3-Actualizacion_XXX pueden observar mensajes de error al ejecutar esta actualizacion derivados de scripts SQL previamente ejecutados.

## Versión 17.3 (2017-03-05)
* Added: Sistema de autoregistro en la plataforma permite ahora a los usuarios crear sus propias credenciales y verificarlas por correo
* Added: Ahora se permite activar o desactivar el código captcha durante el login por medio del panel de configuración
* Added: Panel de configuración de la herramienta ahora permite definir cuándo tener activos los enlaces de recuperar contraseña y auto-reistro cuando el motor de autenticación utilizado es el interno.
* Added: Vagrantfile lista para su uso con Vagrant
* Added: Modulo simulador de dispositivos moviles sobre /mod/pmobile puede ser llamado con el parametro URL (entre otros como Ancho y Alto) para simular su presentacion sobre un dispositivo movil.
* Added: Posibilidad de automatizar casi 100 tipos de eventos JAvaScript diferentes sobre controles de formulario, ventanas, marcos, batería de dispositivos, ratón, etc.
* Fixed: Imagen de logo social inexistente es retirada de la ventana de login. Mejorada maquetación.
* Enhan: Ahora la etiqueta de boton de inicio con sesion de Práctico contiene el nombre de la aplicación configurada por el usuario.
* Added: Ahora los campos de tipo texto, texto largo y tipo contraseñas soportan el uso de etiquetas placeholder desde el diseño del formulario
* Added: Ahora los campos pueden especificar si se desea o no presentar la etiqueta o label sobre el formulario
* Added: Los objetos tipo boton de comando en formularios ahora pueden agregar su propio ID de html usando la propiedad oculta de campo de base de datos
* Fixed: Ahora se muestra mensaje de error cuando no se cuenta con un Driver de bases de datos válido
* Fixed: Compatibilidad para PHP 7. Error en variables $$vble["campo"] ahora son cambiadas a ${$vble["campo"]}
* Fixed: Problema con valor predeterminado sobre la tabla core_chat, campo sent. Es dejado sin valor predeterminado.
* Fixed: Compatibilidad PHP 7. Reemplazadas funciones deprecated de ereg_replace (Sintaxis POSIX) por preg_replace (Sintaxis PCRE)
* Fixed: Compatibilidad PHP 7. BarCode Coder Library (BCC Library). Reemplazo de variables $$
* Fixed: Agregadas definiciones de campos y tablas nuevas en def_basedatos.php
* Enhan: Ampliada longitud del campo de accion sobre las auditorías para permitir hacer log completo y captura de los eventos SQL
* Added: Modo de depuración del SQL permite almacenar sobre auditoría todas las operaciones enviadas al motor de base de datos.
* Added: Nueva propiedad de ID_HTML permite identificar de manera única los elementos agregados al formulario. Todos los valores de campo en instalaciones existentes son transferidos automáticamente a este nuevo campo para efectos de compatibilidad. La funcionalidad genera además un marco contenedor invisible llamado PCOContenedor_xxxxxx con el id html del objeto para efectos de poder realizar manipulaciones en caliente del árbol DOM y programar eventos a cada elemento. Se excluyen controles RadioButton, CheckBox
* Fixed: Mejora a las funciones para recuperación de variables globales en PHP
* Enhan: Se evitan mensajes de warning durante tiempo de instalación.
* Enhan: Durante la edición del nombre de campo en un control de formulario (desde la lista o manual) se asigna automáticamente el valor al campo de ID_HTML para efectos de mantener uniformidad en los controles y unicidad para sus eventos. Si se requiere un ID_HTML diferente al nombre del campo entonces se debería realizar su edición posterior.
* Added: Actualizada la versión de Font-Awesome de 4.6.1 a 4.7
* Added: Actualizada la versión de PMyDB a 17.3 con mejoras sobre múltiples motores, temas y dependencias bootstrap eliminadas.
* Added: Actualizado el editor ACE a version 1.2.6

## Versión 16.5 (2016-05-29)
* Added: Posibilidad de agregar múltiples conexiones a diferentes servidores y motores de bases de datos al mismo tiempo para realizar operaciones independientes en cada una mediante su llamado como $NombreConexion en funciones personalizadas.
* Added: Sistema automático de réplica de operaciones sobre múltiples servidores y motores de bases de datos.
* Added: Los campos de origen para los valores en informes ahora pueden involucrar variables PHP dentro de sus operaciones.  La sintaxis para que una variable PHP sea reconocida dentro de los campos es {$SuVariablePHP}.  En caso de requerir el uso de llaves podrán utilizar la llaves dobles.
* Added: Ahora puede definir múltiples usuarios admin.  Esto no sólo le permitirá múltiples usuarios administradores de plataforma y diseñadores, sino que también por seguridad le permitiría anular el usuario admin por defecto y crear uno con nombre diferente para realizar sus operaciones. 
* Added: Nueva función PCO_DistanciaCoordenadasSimple(Latitud1,Longitud1,Latitud2,Longitud2,UnidadMedida) permite calcular la distancia entre dos puntos en metros, kilometros o millas desde código PHP.
* Added: Nuevas funciones para obtener el nombre de un sitio en lenguaje natural mediante API de Google:
		 PCO_DireccionPorCoordenas(Latitud, Longitud, APIKey_GoogleMaps)
		 PCO_DireccionPorIDSitio(PlaceID, APIKey_GoogleMaps)
		 PCOJS.GoogleMaps_DireccionPorCoordenadas(DireccionNatural,APIKey_GoogleMaps) permite conocer las coordenadas en latitud y longitud y demás información extra entregada por Google Maps
* Added: Las pestanas de formulario cuentan ahora con un identificador PCO_LinkPestanaFormulario_XXX que permite llamar su enlace desde JQuery por ejemplo así:  $("#PCO_LinkPestanaFormulario_2").trigger("click");
* Added: Los formularios ahora pueden especificar el tipo de pestañas a utilizar (pestanas, botones, ocultas).  En el caso de ocultar sus pestanas y contar con varias el diseño de interfaz debería tener los elementos necesarios para navegar entre pestañas en caso de ser necesario.
* Added: Inicio de soporte a motores NoSQL: CouchBase
* Added: Nuevas funciones en JavaScript PCOJS.EsDispositivoMovil y en PHP PCO_EsDispositivoMovil() pueden ser utilizadas para detectar si el dispositivo en que se ejecuta la aplicación es un dispositivo móvil o PC de escritorio.
* Added: Ahora los botones de acción en los informes soportan imágenes (iconos) en la misma notación de las opciones de menú, lo que permitirá agregar botones de sólo gráficos sin texto y ahorrar más espacio en su interfaz de usuario.
* Added: Ahora los controles de tipo IFrame sobre formularios son etiquetados automáticamente con el titulo del control (Los títulos pueden ser asignados cambiando momentaneamente el tipo de control a otro que los soporte)
* Added: Las etiqeutas en campos de texto y listas de seleccion son ahora marcadas con su propio ID en el arbol DOM para permitir operarlas mediante JQuery con el prefijo PCOEtiqueta_  seguido del nombre de campo.
* Fixed: La información de ayuda asociada a algunas opciones como tooltips es ahora presentada de manera flotante y sin interferir con la funcionalidad del aplicativo.  Esto aplica para todos los tooltip incluyendo los forms ya diseñados evitando al usuario el tener que hacer clic sobre las ayudas para poder verlas y los marcos extras y barras de desplazamiento cuando son extensas.
* Fixed: Definido por defecto el valor vacio como retorno de la funcion PCO_ObtenerContenidoAjax para evitar errores JS.
* Fixed: Formularios utilizados para transportar datos y realizar acciones en la parte superior del documento están ahora disponibles incluso cuando se ejecuta la aplicación a fullscreen 
* Enhan: Mejorados los estilos de tablas responsive para formularios cuando no se presentan bordes y en versiones moviles
* Enhan: Confirmada eliminacion de la variable $_SeparadorCampos_ anunciada para la versión 16.1.  Se había dejado hasta la versión 16.3 para dar tiempo a versiones previas de ser actualizadas.  Quienes no lo hayan hecho podrán entrar a su archivo configuracion.php y agregarla manualmente.  
* Enhan: Ahora los SuperUsuarios aparecen dentro de la lista de usuarios disponibles para realizar copia de permisos e informes en otros usuarios, sin embargo se debe tener en cuenta que aún así sus permisos podrán estar en blanco pues los SuperUsuarios no usan las mismas ACL que los usuarios estándar.
* Enhan: Los SuperUsuarios aparecen dentro de los listados de usuarios, sin embargo no se dejan suspender, eliminar o resetear claves.
* Enhan: Actualización de FontAwesome versión 4.6.1
* Enhan: Mejorada la maquetacion de bordes para dispositivos móviles
* Enhan: Mejorada la carga de tooltips de manera automática al pasar el ratón, se autoajustan cuando su contenido es muy extenso y ahora soportan HTML dentro de ellos

## Versión 16.3 (2016-03-10)
* Added: Se agrega una vista previa del Query SQL que es generado por los parámetros definidos en los informes
* Added: Nueva función para geolocalización: PCOJS.GeoLocalizarUsuario().  La funcion le devolvera siempre sobre la variable JS llamada PCO.Geolocalizacion una cadena separada por comas así: Latitud,Longitud,Altitud,Precision,Direccion,Velocidad.  Cualquiera de los parametros que no sea soportado por el cliente GPS será null o NaN.
* Added: Sistema de monitoreo mejorado, nueva maquetacion y opciones.  Si cuenta con sistemas de monitoreo corriendo es bueno que revise los ajustes de presentacion pues han cambiado los parametros de algunos tipos de monitor.  Se permite edición de monitores en caliente.
* Fixed: Al cambiar pesos y realizar acciones entre campos y condiciones de informes se cruzaban los ID de elementos.  Ahira se evita el error de JS derivado.
* Fixed: [Reportado: José Llanos (Venezuela)]:  Al empotrar un informe con botón de exportación en un formulario ese botón hace que todas las acciones de botones en el formulario cambien a la descarga del informe.  Se corrige para evitar que en informes embebidos se incluya tal botón.
* Fixed: Agregado campo descripcion a tabla de usuarios para permitir busquedas durante login por OAuth
* Fixed: Creacion de usuarios por OAuth ahora reconoce desde qué proveedor ha sido creado el registro de usuario
* Fixed: Paginas de monitoreo vacias ahora pasan a la siguiente sin problema despues de 1ms
* Enhan: Se hace énfasis en ventana de login mediante zoom y velocidad de transición.
* Enhan: Actualización a mejoras PCoder
* Enhan: Mejorada ventana de login para opciones OAuth
* Enhan: Actualizado el AppEngine para rastreo de visitas a la aplicación
* Enhan: Ahora el monitoreo es responsive y sus monitores tipo máquina pueden controlar de manera independiente las alertas a correo, sonoras o de vibración.
* Enhan: Establecidos valores predeterminados durante la creación de monitores.  Mejora adicional a las ayudas

## Versión 16.2 (2016-02-07)
* Added: Agregados acordiones colapsables para presentar resultados de procesos de importacion
* Added: Plugin de JQuery para exploracion de archivos
* Added: Actualización de PCoder a su ultima versión: 16.3
* Added: Plugin para selección de colores y paletas
* Enhan: Mejorado el estilo para oscurecer la aplicación cuando se abre un diálogo modal y poder dar así un mayor énfasis al mensaje en pantalla.

## Versión 16.1 (2015-12-24)
* Added: Funciones para operar listas de selección: PCOJS_ActualizarComboBox(), PCOJS_LimpiarComboBox(), PCOJS_AgregarOpcionComboBox(), PCOJS_OpcionesCombo_DesdeCSV()
* Added: Seleccion visual de los estilos para botones de informes, acciones de formularios y botones sobre formularios
* Added: Acceso y conteo de informes en el panel de inicio del admin
* Added: Acceso y conteo de menues creados en el panel de inicio del admin
* Added: Actualizacion completa de PCoder a su última versión
* Added: Se imprime la descripción de los informes en la parte superior de los mismos cuando esta es diligenciada
* Added: Marco responsive para tablas muy extensas permite ahora desplazarlas horizontalmente
* Added: Nueva funcion PCOJS_StrReplace() disponible como un equivalente de str_replace de PHP en JavaScript
* Added: Nuevo formato en carga de archivos permite extraer la extension del archivo original
* Added: Administrador completo para el motor de base de datos basado en PMyDB https://github.com/unix4you2/pmydb
* Added: Ahora los informes pueden ser personalizados para permitir edicion en linea de algunas de sus columnas por los usuarios
* Added: Nuevas función permite visualizar mensajes de carga temporales durante ciertos milisegundos PCOJS_MostrarMensajeCargandoSimple(Milisegundos);
* Added: Las condiciones de filtrado en controles de listas de seleccion y listas de radio ahora aceptan multiples variables encerradas entre llaves
* Added: Los procesos de importacion de tablas pueden ser ahora intervenidos indicando los campos ignorados, campos fijos y valores de campos fijos mediante listas que utilicen la variable de $_SeparadorCampos_.  Las listas posibles son: $PCO_lista_campos_ignorados, $PCO_lista_campos_fijos y $PCO_lista_valores_fijos
* Added: Los procesos de importacion soportan ahora el establecimiento de politicas de accion para los tipos de registro encontrados.  La unicidad de los registros puede ser establecida por dos variables: $PCO_condicion_fija_campo_unico con condiciones fijas para el WHERE y $PCO_condicion_variable_campos_llave con la lista de campos separada por comas para aquellos campos que deben ser comparados dinamicamente con su valor actual
* Fixed: Se evita inclusión del módulo PCoder directamente desde Práctico pues ya es autogestionado
* Fixed: [Tester: Jaime Berrio A.] Cláusulas ORDER BY y GROUP BY no son tomadas en informes
* Fixed: Eliminado texto innecesario en mensajes de progreso
* Fixed: Opciones de menu son presentadas de manera consistente de acuerdo a su peso
* Enhan: Controles de acceso por sesion para pbrowser
* Enhan: La inclusion de JQuery es cambiada al principio para tenerla siempre disponible
* Enhan: Mejora en maquetacion para adicion de controles a formularios ahorra espacio y permite vistas previas
* Enhan: Mejorada la maquetación en el panel de inicio para el admin
* Enhan: Las funciones personalizadas de JS de los form se agregan al final de todo el documento
* Enhan: Ocultados warnings innecesarios en generacion de informes y aplicacion de parches de actualización en modo de depuración
* Enhan: La opción para recuperación de contraseña en el login es presentada sólo para el motor de autenticación interna de Práctico.  Motores federados o externos no tendrían por qué presentarla.
* Enhan: Las alertas sobre el directorio de instalacion presente y la actualizacion de datos son ahora presentadas al usuario administrador solamente y en el escritorio.
* Enhan: Las listas de radio limpian sus valores vacios presentando solamente aquellos con informacion y opciones validas
* Enhan: Se evita salto de linea adicional en secciones sin sesion activa

## Versión 16.0 (2015-10-03)
* Added: Nuevos marcos agregados permiten ahora que el diseñador agregue contenido dinámicamente a las diferentes áreas de la aplicación.  Los marcos disponibles son:
	* PCODIV_ArribaMenuSuperior: Justo antes de las opciones de menu programadas para la parte superior
	* PCODIV_AbajoMenuSuperior: Justos después de las opciones de menú programadas para la parte superior
	* PCODIV_ArribaMenuLateral: Justo antes del buscador de la herramienta
	* PCODIV_AbajoMenuLateral: Justo después de las opciones definidas para el menú lateral de la aplicación
	* PCODIV_ArribaEscritorio: Justo después del título "Escritorio" y su línea divisoria
	* PCODIV_AbajoEscritorio: Justo antes de cerrar la aplicación en la parte inferior del escritorio
	* PCODIV_TituloAplicacion: En la parte superior de la aplicación, incluye los valores por defecto
* Added: Asistente de importación de datos desde archivos de hoja de cálculo
* Added: Módulo de chat permite búsquedas de usuario mediante control datatable
* Added: Panel de configuración permite activar o desactivar el módulo de chat a diferentes niveles de usuario
* Added: Función PCO_HTMLSpecialChars_Decode() se encuentra disponible como un equivalente en JavaScript a la funcion htmlspecialchars_decode de PHP
* Added: Función PCO_HTMLSpecialChars() se encuentra disponible como un equivalente en JavaScript a la funcion htmlspecialchars de PHP
* Fixed: Acentos idioma portugues
* Fixed: Nombres de usuario filtrados para evitar errores de JS en modulo de chat
* Fixed: Inserción de mensajes en módulo de chat basados en la variable de separacion de campos
* Fixed: Al hacer clic sobre un botón de chat con un usuario se abre la ventana de chat y se cierra automáticamente la de selección de usuarios
* Fixed: Precarga de estilos en botones de informe
* Fixed: Reubicados los marcos para mensajes y para barras de progreso al final en marco_abajo.php
* Enhan: Variable de separador de campos es movida al archivo de configuracion principal
* Enhan: Eliminados warnings por zona horaria no definida en el modulo de chat
* Enhan: Módulo de chat mejora controles mediante bootstrap y disminuye tiempos en el heartbeat
* Enhan: Reorganización de la configuración de opciones varias en el panel de la herramienta
* Enhan: Eliminado mensaje de uso de dobles comillas en javascript de formularios pues ya no es necesario
* Enhan: Mejoras al sistema de navegación por Proxy

## Versión 15.9 (2015-08-31)
* Added: Las acciones en botones de informes pueden ser transferidas a ventanas nuevas, misma ventana, ventana padre o marco superior según los target disponibles para el estándar HTML
* Added: El sistema de plantillas utilizado por la autenticación por OAuth ahora está disponible dentro de los usuarios estándar de la aplicación
* Added: Funciones para desplegar dialogo emergente con estados y progresos
* Fixed: Apariencia de botones de menu en Firefox.  Se agrega por defecto el tema de botones a las opciones del escritorio para mejorar su visualización.
* Fixed: Eliminacion de warnings del lado del servidor web por variable WS_On no definida
* Enhan: El boton de eliminar tabla en la administración de tablas de datos ha sido movido a la zona de peligro
* Enhan: El campo de comandos de usuario en las acciones de informes ha sido ampliado a longitud indefinida
* Enhan: Las operaciones de copia de informes y menues entre usuarios son ahora realizadas mediante una función.
* Enhan: El campo de nombre de usuario es ampliado para permitir nombres de hasta 250 caracteres
* Enhan: Agregadas optimizaciones a archivos CSS y JS. Incorporados los scripts para automatizar las optimizaciones en cada construccion

## Versión 15.8 (2015-08-01)
* Added: Disponibilidad de idioma Hindú
* Added: Autoajuste por páginas para informes exportados
* Added: Tamaños de papel específicos para la generación de informes
* Added: Orientaciones vertical y horizontal para las hojas generadas en el informe
* Added: Posibilidad de definir bordes alrededor de resultados en informes
* Added: Posibilidad de encabezados en informes (Aplicacion + Titulo) y (Usuario + Fecha)
* Added: Autoajuste de celdas en informes exportados
* Added: Exportación automática de informes a formato CSV
* Added: Exportación automática de informes a formato HTML
* Added: La funcion para exploración de archivos tiene ahora un parámetro adicional para ocultar los botones de descarga asociados a cada elemento
* Added: Funciones de mantenimiento en el panel de desarrollo permiten ahora limpiar los archivos temporales y de copias de seguridad.
* Added: Funciones de mantenimiento para base de datos y tablas de aplicación y propias de Práctico sobre motores MySQL y MariaDB
* Added: Un modo DEMO que impide el cambio de contraseñas, aplicación de parches, cambios de configuración y cambios de perfil ha sido agregado por medio del archivo DEMO en la raiz para aquellas instalaciones que se deseen con esta finalidad.
* Added: Opciones de mantenimiento a tablas directamente sobre el listado de tablas del sistema
* Fixed: Botones automaticos de formularios de filtrado aparecían sin estilo.
* Fixed: Etiquetas de idiomas al momento de instalación.
* Fixed: Correciones menores en archivos de idioma
* Fixed: Errores de sintaxis en listas de seleccion y controles tipo radio de formularios ahora no evitan la continuidad de ejecucion cuando sus sentencias tienen problemas de ejecución en el motor
* Fixed: Errores de sintaxis SQL en informes ahora no evitan la continuidad de ejecucion cuando sus sentencias tienen problemas de ejecución en el motor
* Fixed: Se evitan errores que detienen ejecucion de la herramienta cuando se empotran subformularios inexistentes o que han sido eliminados
* Fixed: [Tester: Jaime A. Berrio] El modo DEMO inhabilita los login al ingresar el usuario al modo webservices y devolver un XML mal formado
* Enhan: La función de exploración de archivos hace uso de una función extra para retorno de los valores, lo que permite usar sus resultados con otros fines como backups, etc.
* Enhan: Reducción de código y optimización a funciones de exportación
* Enhan: Adición de iconos a opciones de exportación
* Enhan: Reescritura de panel de desarrollo para permitir futuras adiciones.
* Enhan: La funcion para exploración de archivos usada por el módulo de actualización se mueve a un punto donde pueda ser utilizada por cualquier módulo
* Enhan: Funcion de exploracion de archivos presenta sumar la cantidad en KBytes de los archivos
* Enhan: Ahora las consultas y funciones SQL presentan siempre el mensaje con los detalles del error al usuario admin, aún cuando el modo de depueración se encuentre apagado.

## Versión 15.7 (2015-07-05)
* Added: Agregado un tipo de validación de campos: ahora se soporta Tiempos/Horas
* Added: Agregado un tipo de validación de campos: ahora se soporta Fechas con Horas con selectores independientes y también unificados
* Added: Agregado un tipo de validación de campos: Sólo fechas con seleccion por años, meses y dias separados
* Added: La exportación de tablas ahora permite codificar o decodificar los contenidos al vuelo sobre diferentes sets de caracteres y transliterarlos si es necesario
* Added: Nuevo editor WYSIWYG Responsive
* Added: Agregado el control de formulario tipo checkbox o caja de verificación
* Added: Ahora se soportan estilos e iconos diferentes basados en bootstrap y AwesomeFont para los mensajes de retorno al escritorio a través de botones de comando en formularios
* Added: Exportación automatica a Excel 5 (.xls) de los resultados de informes
* Added: Exportación automatica a Excel 2007 (.xlsx) de los resultados de informes
* Added: Exportación automatica a LibreOffice (.ods) de los resultados de informes
* Fixed: Eliminada la impresion de cadena_valor en las listas usadas para recuperar registros.
* Fixed: [Tester Jonathan Sánchez Giraldo] Valores de título y texto de retorno no eran visualizados correctamente en el escritorio después de realizar una acción.  Variables PCO_ErrorIcono,PCO_ErrorEstilo,PCO_ErrorTitulo y PCO_ErrorDescripcion ahora son transportadas entre acciones.
* Fixed: Corrección en cierre de etiqueta DIV para marco_dev
* Enhan: Nuevo editor WYSIWYG Responsive es cambiado a predeterminado en la edición de controles tipo etiquetas (textos estáticos) sobre formularios.
* Enhan: Se cambia el area disponible en la seleccion de propiedades para los controles de formulario
* Enhan: Se elimina el filtrado de cadenas con htmlentities en campos de texto recuperados desde base de datos.  No se hace necesario cuando el charset está correctamente configurado en servidor y base de datos.
* Enhan: La selección de estilos gráficos para mensajes de retorno se hace ahora desde una lista de selección para facilitar su ingreso
* Enhan: Campo de valor único para eliminación de datos en formularios ahora no tiene que ser visible
* Enhan: Separados algunos apartados de código por legibilidad
* Enhan: Enlace a Practico se abre en ventana separa para evitar que expire la sesion al regresar
* Enhan: Separada la generación de botones y consultas en informes
* Enhan: Separadas la generación de consultas y campos ocultos en informes

## Versión 15.6 (2015-05-31)
* Added: Las opciones de menu ahora soportan imagenes sobre rutas relativas a cualquier parte de la aplicación o módulo.  Al ingresar un archivo en el campo imagen en la creacion de menus el sistema deja de un lado los estilos y agrega la imagen cruda en su tamaño total.
* Added: El asistente de actualización permite ahora escoger el tipo de backup realizado al sistema entre sólo y scripts y scripts+base de datos
* Added: Los informes ahora permiten recibir variables PHP declaradas en sus variables de filtro y además variables PHP ingresadas en sus condiciones.  Para estas últimas no se requiere su declaración en el informe pues son buscadas en su entorno global en caso de no ser encontradas y estar escapadas entre llaves.
* Added: Se permite vincular formularios de filtro a informes para captura de variables PHP previas requeridas por las condiciones.  Esta funcion autodetecta formularios cargados como filtro y genera automaticamente el boton de redireccion al informe asociado.
* Added: Ahora los campos de un informe pueden ser establecidos como visibles u ocultos.  Esto permitirá utilizar campos de ID para operaciones estando de primeros en el informe y además ocultos junto con otros campos a los que se defina esta propiedad.
* Added: Generación de archivos XML con objetos tipo formulario e informe que permiten transportar diseños entre instancias de aplicaciones en Práctico
* Added: Pestana de informacion sobre PHP en el marco de configuración.
* Added: Los controles de listas de selección sobre formularios ahora soportan el uso de variables PHP dentro de sus variables de filtrado.
* Added: El modo de depuracion informa a todos los usuarios cuando se encuentra activo.
* Added: Se permite realización de copias de seguridad independientes por tabla con sentencias de creacion, inserción de datos y creación más inserción de datos.
* Fixed: Corregida la seleccion del tipo de encripcion para motores de autenticacion federados. Ahora se aplica la encripcion correcta.
* Fixed: Cuando no se ingresa nada en el buscador la busqueda arrojaba errores
* Fixed: Menus superiores y laterales generaban conflicto por doble Id de formulario
* Fixed: Textos de confirmación para botones de formulario e informes son activados.  Ahora al agregar un texto de confirmación éste es tenido en cuenta para preguntarle al usuario antes de ejecutar la acción.
* Fixed: Eliminacion de informes no eliminaba botones asociados
* Enhan: Sobreescritura de variables para WebServices asi: WSId a PCO_WSId, WSOn a PCO_WSOn, WSKey a PCO_WSKey, WSSecret a PCO_WSSecret
* Enhan: Autenticación federada prohibe actualizar perfiles de usuario y cambiar sus claves pues todo se toma del sistema federado.  Solo el admin sigue con la independencia.
* Enhan: Reubicación de pestaña de historico de actualizaciones a la segunda posición, dejando las copias de seguridad al final.
* Enhan: Agregada variable PCO_VersionActual para indicar la versión de la herramienta.
* Enhan: Agregado indicador de modo de depuracion encendido en la parte superior.  Ademas el modo de depuración solo afecta al admin para evitar que otros usuarios vean mensajes de alerta que pueden no interesarles
* Enhan: Mejorada la clase de copias de bases de datos.  Se reescribe totalmente para lograr mayor flexibilidad en copias de una, varias o todas las tablas.  con o sin estructura o datos.
IMPORTANTE:  Aquellos usuarios que hagan uso extensivo de webservices deberian hacer los ajustes de nombre para sus variables de modo que estos sigan operantes despues del cambio.  Un simple buscar y reemplazar WSId por PCO_WSId en todos sus documentos debería ser suficiente.  Igual para las demás variables.

## Versión 15.5 (2015-05-01)
* Added: Disponible la copia/Clonado rápido de informes desde el listado de informes
* Added: Se permite ubicacion de opciones en la barra de menu izquierda. Será ubicados debajo de las opciones administrativas predeterminadas.
* Added: Copia de permisos para informes desde un usuario a otro
* Added: Tester [Jaime A. Berrio] Ahora los botones de acción en informes y vinculados a una acción de usuario transportan de manera automática el valor del ID de registro, el nombre de la tabla y el campo de la tabla.
* Added: Boton nuevo permite saltar entre los permisos para menues y reportes de un usuario sin tener que regresar al escritorio
* Added: PCoder ahora puede almacenar archivos sin actualizar hoja y mover el cursor de punto mediante llamados AJAX
* Added: Iniciada implementacion de HTML2CANVAS
* Added: Adicion de campos personalizables sobre parametros de aplicacion
* Added: Soporte para autenticación federada. Ahora se pueden autenticar los usuarios frente a bases de datos en otros sistemas.
* Added: Agregado un archivo para funciones personalizadas tanto al comienzo como al final de la aplicacion (personalizadas pre y pos)
* Fixed: Se mejora escapado de caracteres en campos de filtrado de listas para formularios
* Fixed: Búsquedas dinámicas sobre subformularios ahora usan los registros maestros
* Fixed: Tester [Jaime A. Berrio] Valores Hidden sobre formularios con variables PHP
* Fixed: Tester [Nestor Ramos Arteaga] Ajuste a parámetros de conexión por LDAP para ActiveDirectory
* Fixed: Funcion de creacion de usuarios por Oauth y accesos federados
* Enhan: Mejorada la apariencia y disposición de controles gráficos en formularios.  El espacio disponible se divide por el número de columnas del formulario
* Enhan: Eliminados warnings en informes sin resultados que no capturan nombres de columna
* Enhan: Los informes embebidos ahora no presentan sus totales para hacerlos más limpios sobre otros formularios.  El total se conserva en informes con vista estándar.
* Enhan: Agregado el atajo Ctrl+S para facilitar el guardar archivos editados en PCoder
* Enhan: Copia de formularios ahora es dinamica segun la definicion de la base de datos
* Enhan: ErrorLog del lado del servidor ahora es mas limpio
* Enhan: Cambio de variables globales en posible conflicto hacia el formato $PCO_
* Enhan: Cambio de la forma de conexion a enfoque funcional para mejorar procesos de autenticacion federada
* Enhan: Cambio en funciones de ejecución de sentencias SQL para que permitan ejecución sobre múltiples conexiones
* Enhan: En motores de autenticacion diferentes a los internos, la creacion del usuario se hace sólo si este no existe todavía.

## Versión 15.3 (2015-03-01)
* Added: Ahora se permite definir informes para ser presentados en formato DataTable, con filtrados, ordenamiento, búsquedas y paginación en caliente.
* Added: La ficha de cada usuario es editable haciendo clic sobre su nombre en el menu de usuario.  Adicionalmente después de la instalación de la plataforma el usuario admin es redirigido en su primer ingreso para cambiar/actualizar su ficha.
* Added: Ahora los informes embebidos soportan botones de comando sin importar si se encuentran dentro de otros formularios
* Added: Algunos controles de formulario pueden soportar ahora el modo de estilo inline durante su publicacion sobre el formulario
* Added: Nuevos controles de botones de comando para formularios permiten agregar botones en medio del form y no sólo en su barra de estado
* Added: Algunos controles de formulario podrán soportar imágenes derivadas de las librerías de iconos disponibles.
* Added: Las opciones de menu ahora soportan targets diferentes y direcciones de URL extensas además de comandos JavaScript
* Added: Editor de código en línea de Práctico. Módulo PCODER (Practico CODe EditoR)
* Added: Funcion JavaScript generica para obtener valores mediante AJAX: PCO_ObtenerContenidoAjax
* Added: Funcion Ajax para devolver como WS valores de campos.  Pendiente ajustar restricciones de campos
* Added: Asistente de actualización y aplicación de parches puede ahora presentar el histórico de parches aplicados basado en la auditoría
* Added: Buscador presenta dentro de sus resultados posibles informes autorizados al usuario actual
* Added: Los botones dentro de formularios ahora permiten el uso de imagenes e iconos de cualquiera de las librerías existentes en Práctico (los mismos de los menues)
* Fixed: Mensaje de confirmación en cambio de perfil
* Fixed: Reactivado el control tipo Canvas
* Fixed: Campos de tipo etiqueta con valores de variables PHP ahora indican su valor sin encerrarlos en la expresion HTML
* Fixed: Gráficos Morris con valores cero
* Fixed: Errores de base de datos no desplegados por falta de librerías son ahora presentados con descripciones completas.
* Fixed: Tester: [Jaime A. Berrio Arenas] Clonacionde formularios no opera correctamente por diferencia entre campos
* Enhan: Se cambia correo de instalación predeterminado a uno genérico.
* Enhan: Agregada funcion JavaScript PCO_AgregarElementoDiv que permite agregar dinamicamente elementos HTML a un marco determinado.
* Enhan: Informes DataTable tienen ahora soporte multiidioma
* Enhan: El modo de depuracion muestra ahora el query generador al final de cada informe para el usuario admin
* Enhan: Design: [Natalia Arroyave] Mejora en el logo de la aplicación. Geometrización y mejora de paleta.
* Enhan: Multiarchivos en PCoder y ayudas de teclado
* Enhan: Al agregar usuarios se redirecciona al perfil del mismo para agregarle permisos
* Enhan: Se evita el plugin social buttons de Bootstrap para acelerar la carga evitando descargas de netdna.bootstrapcdn.com
* Enhan: El enlace a PCoder es ahora omnipresente para los admin en la parte superior.  De esa manera se garantiza su uso cuando involuntariamente se genere un error de sintaxis por el programador sobre algún código propio.  De esta manera PCoder estará disponible para poder ingresar a editar y reparar el error.
* Enhan: Las listas de selección ahora pueden especificar si su primer valor será vacío o será el valor del primer registro encontrado.  Simplemente agrega una coma sola al campo de lista de valores para indicar este comportamiento.
* Enhan: Las listas de permiten fusionar valores estaticos (ingresados en la lista de valores separados por coma) y valores obtenidos desde una tabla dinámicamente.
* Enhan: Forzado de charset UTF8 para evitar problemas de multiples confirguraciones

## Versión 15.2 (2015-02-08)
* Added: Personalización de Tags HTML para el diseñador de formularios
* Added: Soporte para datepicker por bootstrap
* Added: Ahora los campos dotados de DatePicker identifican el idioma de la plataforma y se autotraducen
* Added: Campos tipo slider son ahora responsive, soportan dispositivos touch y tienen mejores estilos incluyendo disposición vertical.
* Added: Controles tipo lista de selección han sido preparados para bootstrap, estilos y búsquedas en caliente.
* Added: Funcionalidad de pestañas automáticas para objetos de formularios
* Added: Además del tiempo de carga del lado del servidor ahora se presenta el tiempo de carga del lado del cliente mediante JS
* Added: Posibilidad de controles de selección mútiples mediante personalización del Tag
* Added: Listas de selección presentan ahora un Check para el elemento seleccionado
* Added: Libreria IonIcons (602 iconos)
* Added: Libreria Weather Icons (124 iconos)
* Added: Libreria Map Icons (170 iconos)
* Added: Libreria Oct Icons (176 iconos)
* Added: Libreria Typ Icons (336 iconos)
* Added: Libreria Elusive Icons (299 iconos)
* Added: Picker de iconos con soporte para más de 2480 iconos repartidos en diferentes librerías
* Added: Se aplica el tema por defecto de bootstrap
* Added: Variable de peso para ordenar campos dentro de los informes
* Added: Ahora campos de selección soportan búsquedas dinámicas mediante personalización de Tags
* Added: Modulo adicional para edición de scripts en línea basado en ACE [Ajax Cloud Editor]
* Added: Ahora las variables de contexto PCO_ValorBusquedaBD y PCO_CampoBusquedaBD pueden ser utilizadas para filtros en generación de informes
* Added: Los informes cuentan con la posibilidad de filtrar mediante variables PHP definidas por el usuario.  Las variables pueden estar siendo recibidas por formularios previos donde se tomaran los nombres de campo como nombres de variable o cualquier otra variable global existente.
* Added: Los informes puede ahora filtrar por patrones (LIKEs) visualmente, antes se podia ingresar su valor de operador manual solamente.
* Added: Los controles de datos de listas de selección que toman valores desde tablas ahora pueden ser actualizados mediante AJAX
* Added: El modo fullScreen determinado por la variable Presentar_FullScreen permite ahora combinado con otra variable Precarga_EstilosBS definir si sera en modo crudo o al menos con estilos de bootstrap
* Added: Buscador del dashboard habilitado para al menos cuatro palabras sensibles permite ahora encontrar opciones en el perfil del usuario asociadas a la expresión de búsqueda
* Added: Nueva pestaña en la opción de actualización permite ahora revisar las copias de seguridad generadas durante cada proceso de actualización realizado en la herramienta.
* Added: Posibilidad para recuperación de contraseñas
* Fixed: Durante copia de permisos, al seleccionar eliminar o borrar permisos la operacion se ejecuta sin problemas cuando no se indica un usuario de origen.
* Fixed: Se preautoriza la funcion de actualizacion de clave por ser comun a todos los usuarios
* Fixed: Lanzamiento de ventana de monitoreo con accion incorrecta.  Igual su proceso de autollamado.
* Fixed: Cambio de peso en condiciones no dejaba activo su PopUp
* Fixed: Generacion de informes no tomaba el tipo correcto
* Fixed: Se agrega un data-container como body a las listas de seleccion para que sean visibles aun cuando el contenedor sea pequeño
* Fixed: Llamado de informes desde opciones de menu sin estilos
* Fixed: Insercion de informes nuevos corre los campos hacia la derecha por parametro adicional
* Fixed: Visualizacion de bordes de tabla en diseño de formularios ahora aplican propiedad correctamente
* Fixed: Tester: [Ricardo Beltran ] Botones de búsqueda en campos y de operaciones diferentes a la adición no operan correctamente sobre Forms
* Fixed: Tester: [Jonathan Sánchez] Campo de correo en registro de clientes tenía el tipo como password.
* Fixed: Tester: [Jonathan Sánchez] Se corrigen procesos de actualización de registros para campos que no son controles de datos sobre formularios
* Fixed: Tester: [Jaime A. Berrio ] Se corrigen los IDs de informe generados en los enlaces para los usuarios, opción Mis Informes
* Fixed: Develo: [Christian Faure ] Las operaciones bind en base de datos son ahora depuradas para determinar valores en los parámetros. En caso de no existir son usados valores Null
* Enhan: Tester: [Christian Faure ] Ahora para evitar que se apliquen de manera incompleta los parches se verifican los permisos de escritura sobre cada archivo que lo compone
* Enhan: Develo: [Christian Faure ] Ahora la depuración permite ver el query completo (con sus valores por parámetro).
* Enhan: Campos de edición de JavaScript para formularios pueden usar ahora ACE
* Enhan: Reubicación de funciones de conteo de tiempos
* Enhan: Limpieza del instalador, ya no se requieren skins
* Enhan: Mejorada la interfaz de administracion de permisos de menu e informes para usuarios.
* Enhan: Los mensajes complementarios y de ayuda sobre campos de formularios son ahora PopOvers
* Enhan: La presentación de los campos en los informes se hace ahora de acuerdo a su peso
* Enhan: Ahora la documentación del proyecto es generada automáticamente en cada liberación
* Enhan: Enlace a la documentación de funciones desde la web
* Enhan: Por compatibilidad las variables internas de valorbase y campobase ahora son llamadas PCO_ValorBusquedaBD y PCO_CampoBusquedaBD
* Enhan: Se elimina doble título en informes.  Ahora se despliega el título solo en la barra de ventana.  Embebidos desaparece.
* Enhan: El administrador de archivos permite la gestion desde la raiz para instalaciones realizadas en carpetas diferentes a las llamadas "practico"
* Enhan: Mensaje complementario para edicion de scripts
* Enhan: Todos los botones de formularios han sido convertidos al tag <a> para mayor flexibilidad
* Enhan: Eliminacion de enlaces a videotutoriales. Se quedan obsoletos rapidamente asi que seran vinculados desde la pagina oficial.
* Enhan: Cambio de variables por compatibilidad: error_titulo a PCO_ErrorTitulo, error_descripcion a PCO_ErrorDescripcion, fecha_operacion_guiones a PCO_FechaOperacionGuiones, hora_operacion_puntos a PCO_HoraOperacionPuntos, hora_operacion a PCO_HoraOperacion, fecha_operacion a PCO_FechaOperacion, Login_usuario (sesion) por PCOSESS_LoginUsuario, Sesion_abierta a PCOSESS_SesionAbierta
* Enhan: Los estados de pantalla completa y de precarga de estilos son transportados en cada operacion de formulario
* Enhan: El campo de accion personalizada del usuario para botones de formulario es ahora de tipo text, de manera que se puedan ingresar instrucciones largas.
* Enhan: Depuracion de variables cadena_altura y cadena_valor en listas de seleccion
* Enhan: Adición de tooltip a botones de actualización automática
* Enhan: Botón de búsqueda agregado sobre etiquetas SPAN para unificar su presentación cuando hay otros controles al lado
* Enhan: El diseño de formularios ahora presenta la pestaña a que pertenecen los elementos y los ordena por pestaña, columna y peso.
* Enhan: Durante adición de permisos a los usuarios se agregan los iconos de cada opción de menú en la lista de selección para facilitar su identificación
* Enhan: Cambiados los logos de la herramienta para unos más limpios
* Enhan: Agregadas las estadísticas del proyecto en OpenHub al README
* Enhan: Módulo de correos es ahora multiligue

## Versión 15.1 (2015-01-01)
* Added: Implementacion basada en BootStrap 3.3.1
* Added: Ahora todo es responsive!  Sus aplicaciones corriendo sin problemas en la web para escritorios, tabletas y smartphones
* Added: Filtro de listas de seleccion.  Ahora se permite definir condiciones de filtrado para las listas utilizadas en los controles combobox y radiobutton
* Added: Se inicia con el uso de awesome-font.  Se sustituyen varias expresiones de iconos por las existentes en la fuente de iconos nueva
* Added: Actualizacion de mucha iconografia a fuentes Awesome
* Added: Uso de bootstrap. Ahora toda la aplicación es responsive y maquetada mediante bootstrap.
* Added: Se ajustan métodos para cierre de marcos mediante la tecla Esc.
* Added: Marcos de configuración diagramados de manera independiente
* Added: Barra de menu/herramientas lateral e iconos de contexto en barra superior
* Added: Inclusión de GlyphIcons
* Added: Adición de librerías nuevas para elaboración de gráficos
* Added: Se cambia la ventana de login por OAuth a modal.
* Added: Panel administrativo al inicio con resumenes del sistema
* Added: Panel de dashboard para el administrador de aplicacion
* Added: Modulo SOPA.  Una aproximación al Social Parsing y demo de funciones para obtener URLs con Práctico.
* Added: Nuevos estilos de presentacion para menues superiores, de acordeon y de escritorio
* Added: El panel de informes ahora diferencia el tipo de informe y presenta icono asociado
* Enhan: Tamaño del instalador disminuido en varias megas
* Enhan: Se aumenta longitud del campo de estilo para botones y se permite ademas el uso de texto libre para ingresar estilos bootstrap
* Enhan: La variable de control de practico ahora se llama $PCO_Accion en lugar de simplemente $PCO_Accion para evitar conflictos.  Usuarios que deseen compatibilidad a versiones anteriores podrán hacer una asignación de la nueva variable así: $PCO_Accion=$PCO_Accion;
* Enhan: Eliminadas variables de idioma: $MULTILANG_FrmEstilo1, $MULTILANG_FrmEstilo1b, $MULTILANG_FrmEstilo2
* Enhan: Eliminada la restriccion de imagen para opciones de menu, ahora todas se imprimen.
* Enhan: Eliminada la seleccion de imagenes de opciones de menu. En adelante sólo librerias Glyp y Awesome son permitidas
* Enhan: El titulo de informes es presentado completo aunque sea largo
* Fixed: Se simplifica script de inicio para login y cambio dinámico de marcos.
* Fixed: Actualizados scripts de instalacion pues ya no requieren creación de menues
* Fixed: Se evita cierre de sesion involuntario por enlaces mal generados al escritorio
* Fixed: Se retira campo de color de formularios e informes pues ahora todo se hace con estilos de BootStrap
* Fixed: Se retira opcion de teclado virtual en controles de formularios
* Fixed: Formatos de color directos en HTML son removidos para ser controlados ahora desde BootStrap
* Fixed: El orden de los campos en los informes se hace basado en su ID
* Fixed: Se reduce numero de columnas en formularios a 12 para posterior compatibilidad con BootStrap
* Fixed: El tipo de objeto al aumentar o disminuir pesos de controles es ahora identificado.
* Fixed: Administrador de archivos ahora es responsive
* Fixed: Asistente de actualización es ahora responsive
* Fixed: Ahora todos los niveles de usuario son establecidos a -1 como valor para transicion a su eliminacion
* Fixed: Durante creacion de usuarios se valida login solo si es diferente de vacio para evitar error fatal del query
* Fixed: Eliminadas las columnas innecesarias de nivel y descripcion de la tabla de usuarios
* Fixed: Se elimina la seleccion de plantillas, ahora todo se hace por bootstrap
* Fixed: Presentación de indicadores numericos sobre graficos Morris.
* Fixed: Marco de configuracion de aplicación, de parámetros y de oauth ahora son responsive mediante bootstrap tabs
* Fixed: Cambio de clave responsive
* Fixed: Variables desconocidas durante extracción de parches de actualización
* Fixed: Comandos de menu superior corregidos para cargue de objetos internos

## Versión 14.912 (2014-11-24)
* Fixed: Vinculos de subformularios
* Added: Actualizar ahora verifica versiones estrictamente inferiores
* Fixed: Corrección de scripts de instalación
* Added: Se agrega la lista de tipos de dato específicos de motores MySQL y MariaDB cuando se configuran instalaciones de este tipo
* Added: Preparación de Font-Awesome para futuros releases

## Versión 14.911 (2014-11-09)
* Added: Se introducen los subformularios en modo de consulta recomendados para solo consulta.  Todos sus campos deberian estar en modo de etiqueta Aunque el sistema permite cualquier tipo por ahora.
* Fixed: Modulo de chat actualizado.  Versiones anteriores no parchaban correctamente los cambios de este modulo
* Added: Nuevo parámetro permite determinar si los forms cuentan con etiquetas FORM o no, para permitir así anidar múltiples formularios para construir sólo uno como derivado
* Fixed: ID de formulario no es mostrado durante su seleccion en el diseño de campos
* Fixed: Monitoreo presentaba salto de linea aún cuando se le indique un valor de cero.
* Added: Se simplifica la creacion de menues e informes eliminando los niveles de usuario.  Ahora predeterminado en todos los usuarios.

## Versión 14.9 (2014-10-07)
* Added: Soporte a login basado en sockets para servidores sin cURL o allow_urlfopen activado
* Added: Actualizada clase OAuth
* Added: Actualización de scrips de construccion
* Added: Soporte para travis
* Added: Soporte para heroku
* Added: Se cambia el método para buscar nuevas actualizaciones a la función interna
* Fixed: Se mueven funciones de carga de URLs a un punto común para su uso en toda la herramienta
* Added: Ahora el método o función cargar_url() está disponible para funciones personalizadas
* Added: Se agregan estadisticas anonimas de uso de la herramienta para saber enfasis en mejoras
* Added: Se permite hacer seguimiento al uso de la herramienta por medio de Google Analytics para quienes deseen configurar su ID de Google.

## Versión 14.8 (2014-08-07)
* Added: Adicion de control de datos para captura de imágenes desde la webcam en diseño de formularios
* Added: Presentacion de archivos adjuntos referenciados por registros
* Added: Campos de tipo archivo en diseño de formularios ahora permiten adjuntar multiples archivos
* Added: Se simplifica creacion de opciones de menu eliminando campos de padre y columna
* Added: Mejora al almacenamiento de datos sobre formularios disenados impide inyecciones SQL y escapa todas las cadenas, incluso comillas y barras
* Added: Los valores sobre formularios de consulta en campos de texto corto son pasados por htmlentities para obtener valores más limpios en el navegador.
* Fixed: [Tester: Jaime Berrio Arenas]  El login por proveedores OAuth no estaba operando en version 14.7
* Added: BETA. Autenticacion federada frente a otros motores y aplicaciones!
* Added: Identificacion del tipo MIME de adjunto en tiempo de carga y descarga
* Added: Adicion de objetos y controles multiples tipo canvas HTML5 a diseño de formularios
* Added: El almacenamiento de campos canvas y de imagen se hace ahora de manera comprimida de manera predeterminada para economizar espacio sobre las tablas
* Fixed: Se agrega una cadena separadora de campos que permita generalizar las operaciones de bases de datos a cadenas improbables en su combinacion, sobretodo para su uso con campos de tipo canvas comprimidos

## Versión 14.7 (2014-06-23)
* Added: Vinculacion manual de tablas de datos durante creacion y actualizacion de formularios
* Added: Opcion de reinicio de claves para usuarios
* Added: Impresion de campos de base de datos tipo etiqueta en formularios como códigos de barra en múltiples formatos
* Added: Clasificacion de packs de iconos durante creacion de opciones de menu
* Added: BETA. Autenticacion federada frente a otros motores y aplicaciones!
* Added: Monitoreo por configuracion visual
* Added: Documentacion de funciones actualizada
* Added: Generador de codigos QR disponible en campos tipo etiqueta
* Added: Alertas en tiempo de ejecucion son ahora presentadas tambien en JavaScript además del HTML
* Added: Alertas por correo para monitoreo
* Fixed: Alineación de objetos de la barra de herramientas de ventanas para navegadores firefox
* Fixed: Iconos en creación y edición de opciones de menú
* Fixed: Copia de formularios con formatos de salida especiales
* Fixed: Warning en imagenes de ayuda para textos iniciales de formularios

## Versión 14.6 (2014-06-02)
* Added: Actualizacion JQuery a version 2.1.0
* Added: Mejora a la clase HTTP (actualizada a version abril 30/2014) 
* Added: Compatibilidad para cualquier motor de base de datos en el modulo de chat
* Fixed: Inclusion de JQuery se hace al comienzo de la herramienta y no al final
* Fixed: Modulo de chat ahora es dependiente de la version actualizada de JQuery
* Added: Ahora para facilitar diseño o para cuando su finalidad sea ésta, se permite dejar visibles las líneas de borde para la tabla usada en un formulario.
* Added: Inclusion del finder de archivos por defecto
* Added: Inclusion de todos los iconos en temas disponibles por defecto
* Added: BETA. Autenticacion federada frente a otros motores y aplicaciones!
* Fixed: [Tester: Eisenhower Renza Guzman]  Cuando se tienen demasiados campos en un formulario al momento de edicion no se cuenta con scrollbar

## Versión 14.5 (2014-05-04)
* Added: Sistema de chat interno tipo Gmail entre usuarios de la herramienta
* Added: Ahora cada formulario puede especificar su color de fondo de manera independiente a la del tema seleccionado.
* Added: Ahora cada informe puede especificar su color de fondo de manera independiente a la del tema seleccionado.
* Added: Ahora algunos controles de datos permiten definir como su valor predeterminado a una variable PHP, valores iniciando con signo de $ seran evaluados como variables PHP en caso de estar definidas.
* Added: Generador de diagramas de Gantt automatico
* Fixed: Enlaces y logos de proveedores Oauth VK y Withings
* Added: Mejoras de rendimiento en renderizado de formularios
* Added: Agregada una plantilla en colores claros

## Versión 14.3 (2014-03-16)
* Added: Nueva funcion para buscar campos dentro de una tabla
* Added: Ahora se permite definir campos manuales dentro de los formularios, esos campos seran obviados dentro de los insert y updates cuando no se encuentren en la tabla
* Added: Ahora las operaciones de almacenamiento validan si los campos existen realmente en la tabla para evitar errores del programador y uso de campos manuales
* Added: Generacion de codigos QR mediante una nueva funcion
* Added: Ahora los campos definidos como ocultos en los formularios son tratados como tipo hidden
* Added: Definicion de funciones personalizadas para accesos seguros
* Added: Ahora las funciones de SQL soportan parámetros separados por doble pipe || para preparar las consultas antes de su ejecución
* Added: Nuevos tipos de campo para formularios donde el valor para la etiqueta es tomado desde el valor de un campo
* Fixed: La actualización de informes retorna a la edición del mismo en lugar del escritorio
* Fixed: Preparación de consultas y funciones SQL para prevenir inyecciones mediante uso de la nueva funcion ejecutar_sql y ejecutar_sql_unaria
* Fixed: Posible error SQL derivado de la adicion de botones de comando javascript a informes
* Fixed: Funciones personalizadas pueden ser agradas a permisos en todos los usuarios mediante el panel de configuración
* Fixed: Actualizado el archivo de definición de bases de datos.
* Fixed: Posible XSS derivado de las variables de mensaje de error ha sido suprimido

## Versión 14.2 (2014-01-20)
* Added: [Tester Jaime Alejandro Zapata]:  Ahora en los campos de condiciones para informes se puede agregar cualquier variable de sesion de PHP del usuario para que esta sea tomada en la comparación del query
* Added: [Tester Javier Enrique]: Ahora Practico detecta el puerto sobre el cual corre el servidor web para los procesos de autenticación.
* Added: Soporte de autenticacion OAuth para red social rusa VK y para Withings
* Added: Agregado soporte para Google OAuth 1.0a (ya se soportaba el 2.0)
* Added: Los campos ID de registro no son visualizados en diseno de formularios para evitar inconsistencias en tratamiento de registros durante actualizaciones
* Added: Boton de actualizacion de registros automatico
* Added: Nueva función basada en cURL es utilizada automáticamente cuando la función nativa de php file_get_contents falla
* Added: Vista previa de los wallpapers por cada tema grafico seleccionado desde el panel de configuracion
* Added: Modulo de ejemplo practico sobre el uso de MVC con el framework
* Fixed: Metodos para la autenticacion por web services son ahora accesibles por ByPass en proveedores OAuth
* Fixed: [Tester Jaime Alejandro Zapata]:  Al llamar informes desde opciones de menu se agrega una columna inicial que desfasa los resultados.  Se agrega aclaracion en ayuda para agregar :htm:Informes al comando generado
* Fixed: [Tester Jaime Alejandro Zapata]:  Se agrega mensaje aclaratorio para cuando se ejecuta Practico sobre instalacion PHP con allow_url_fopen desactivado.  Es una configuracion que solo se cambia desde servidor o con archivos de configuración de PHP
* Fixed: [Tester Jaime Alejandro Zapata]:  Cuando la funcion file_get_contents no retorna nada por tener allow_url_fopen desactivado se hace el paso a funciones cURL para el proceso de autenticacion

## Versión 14.1 (2014-01-19)
* Added: Ahora se pueden clonar formularios rapidamente mediante una función de copia en la administración de formularios
* Added: Tester: Victor Hugo Marin.  Ahora se puede indicar el protocolo preferido para el transporte en el momento de autenticación cuando se utilizan protocolos HTTP o HTTPS.  Aquellos con certificados autofirmados o no emitidos por un CA reconocido pueden presentar problemas con la recuperación de los tokens al momento de autenticación por lo que se deja la posibilidad al administrador de definir la forma de autenticar.
* Added: Tester: Victor Hugo Marin.  Los campos marcados como obligatorios en el diseno de formularios ahora no son sólo informativos, sino que son validados antes de enviar la consulta para almacenar el registro.
* Added: Tester: Jaime Alejandro Zapata.  Algunos servidores no devuelven correctamente el archivo XML utilizado por el webservice de autenticación.
* Added: Funcion propia dentro del framework para envio de correos
* Added: Ahora se cuenta con un modo de impresión para los formularios, ubicado en la parte superior (título de las ventanas generadas) con el fin de permitir la impresión rápida de una ficha, informe o cualquier contenido publicado en un form.
* Added: Los controles tipo ComboBox o Listas de selección pueden convertirse ahora en controles ListBox especificando el alto deseado para la lista de opciones.
* Added: Ahora el usuario admin puede controlar si desea buscar o no actualizaciones automáticas de Práctico.
* Added: Definicion de webservices (API de Practico) permite ahora muchos parametros adicionales y se cambia a base de datos.
* Added: Ventana de edición para propiedades inciales de formularios en el modo de edición de los mismos
* Added: Ahora Práctico cuenta con una función para verificar si las funciones específicas de PHP están o no disponibles.  En este caso se inicia probando la existencia de file_get_contents para procesos de autenticacion.
* Added: Documentación mejorada y actualizada sobre la web oficial (Manuales)
* Added: Mejora a la funcion de auditoria, ahora permite especificar usuarios arbitrarios en funciones de API
* Fixed: Ahora los campos tipo deslizador se inicializan automáticamente al cargar un formulario de ingreso de datos nuevo
* Fixed: Se retira de las opciones para motores de autenticación a Google, pues ya se encuentra disponible como proveedor OAuth
* Fixed: Reemplazo de función obsoleta de PHP ereg_replace por preg_replace (core/comunes.php|283)
* Fixed: Se elimina la posibilidad de indicar la posición del campo en la tabla durante su edición por compatibilidad con todos los motores
* Fixed: Cambio del prefijo de tablas en procesos de actualizacion para que se pueda tomar ajustes a bases de datos
* Fixed: Mensaje de advertencia en eliminación de formularios presentaba un texto mal por falta de actualización en los archivos de idioma
* Fixed: Mejora en la detección del protocolo de transporte y warnings de variables inexistentes
* Fixed: Seleccion de campos en edición de controles de datos sobre formularios tomaba última tabla del sistema.
* Fixed: Eliminación de warning para tabla desconocida durante inserción de registros
* Fixed: Seleccion de campos con valores dinamicos desde otras tablas afectaba la seleccion de campos en la tabla del form
* Fixed: Apertura de formularios de datos con campos de seleccion en registros previos detecta ahora los valores de registro y selecciona de la lista el valor correspondiente
* Fixed: Apertura de formularios de datos con campos de radio button en registros previos detecta ahora los valores de registro y selecciona de la lista el valor correspondiente
* Fixed: Se corrige no inicialización de valores post en la clase oauth_client. Actualizacion de la clase por el autor.

### El proyecto Práctico agradece a las siguientes personas por su apoyo mediante donaciones
para la liberación de la versión 14.1 realizadas en www.indiegogo.com/projects/practico/:
 * Daniel Morales

## Versión 13.912 (2013-12-07)
 * Added: Posibilidad de inicio de sesion mediante Google.  Solo inicio de sesion, los permisos continuan independientes en la plataforma para el usuario con el mismo login de Google (OAuth 2.0)
 * Added: Asistente de instalación y panel de configuración soportan ahora los parámetros de autenticación por Google
 * Added: Cálculo automático del URI para autenticación por Google
 * Added: Inicio de sesion con OAuth para 22 proveedores diferentes:  Google, Facebook, LinkedIn, Instagram, Dropbox, Microsoft (Live), Flickr, Twitter, Foursquare, XING, Salesforce, Bitbucket, Yahoo, Box, Disqus, Eventful, SurveyMonkey, RightSignature, Fitbit, Scoop.it, Tumblr, StockTwits
 * Added: Marco para selección de red social o proveedor OAuth durante el login cuando se encuentra al menos uno activo
 * Added: Nuevo campo de datos tipo contrasena durante el diseno de formularios
 * Added: Ahora Practico puede comparar la version actualmente instalada con los ultimos lanzamientos para avisar al administrador del sistema sobre su disponibilidad
 * Fixed: [Tester: Jonathan Sánchez Giraldo] Adición de campos a formularios podía cambiar su estado a acutalización erroneamente cuando se reciben los parámetros después de la adición previa de otro campo, generando error la siguiente adición.
 * Fixed: Mensajes de validación para el proceso de autenticación cuando la función file_get_contents() no opera correctamente
 * Fixed: Solucionado posible XSS al limpiar la variable accion durante cada ejecución.  Gracias a la empresa Secunia por su análisis.
 * Fixed: Inclusión de logo de google para no depender de instalaciones sin conexión a Internet
 * Fixed: Generación del archivo de configuración incluye todos los comentarios desde el momento de instalación
 * Fixed: Actualización de archivos de idioma
 * Fixed: Se verifica que se cuente con el modulo de google-api de Práctico cuando se habilite ese modo de autenticación
 * Fixed: Texto multi-idioma para seleccion de gráficos de tipo torta en la generación de informes
 * Fixed: Enlace a sitio web oficial en pie de pagina actualizado (practico.org)
 * Fixed: Se limpia en cada ejecucion el contenido de error_titulo y error_descripcion para evitar XSS
 * Fixed: Campos deslizadores presentaban warning como valor predeterminado en modo de depuración

### El proyecto Práctico agradece a las siguientes personas por su apoyo mediante donaciones
para la liberación de la versión 13.912 realizadas en www.indiegogo.com/projects/practico/:
 * Daniel Morales

## Versión 13.911 (2013-11-01)
 * Added: Inicio de construccion de modulo PAM propio para permitir a escritorios de equipo autenticarse frente al modelo de webservices de Practico
 * Fixed: Importantes mejoras a la seguridad y llamado de funciones.  Gracias especiales al equipo de Zero Science Lab por su completa revisión de vulnerabilidades
 * Fixed: Se suprimen mensajes de error en los motores retornados a los usuarios para evitar posibles SQLInjection sobre 40 funciones diferentes.  Gracias a Zero Science Lab
 * Fixed: Se filtran cadenas y variables de entrada a funciones sensibles para evitar posible XSS.  Gracias a Zero Science Lab

## Versión 13.9 (2013-09-17)
 * Added: Conversion automatica de informes tabulares a formato PDF
 * Added: Disponibilidad de nuevo modulo para pasar a PDF
 * Added: Adicion de encabezados y pies de pagina a informes PDF desde la personalizacion de parametros
 * Added: La generacion de PDFs se puede especificar por cada informe de manera separada
 * Added: Personalizacion de margenes, fuentes, etc en generacion de PDFs
 * Added: Modo de webservices, definicion de llaves para consumidores webservices y validacion de las mismas
 * Added: Autenticacion interna basada en WebServices y XML, esto permite ademas creacion de sistemas centralizados de autenticacion basados en Practico
 * Fixed: Mensajes de advertencia en generacion de informes
 * Fixed: Cambio de idioma en generador de PDFs de acuerdo a la parametrizacion del sistema
 * Fixed: MetaTAGs nuevos en la generacion de las paginas

## Versión 13.7 (2013-07-07)
 * Added: Nuevo control de deslizador para seleccion de valores por rangos en formularios
 * Added: Seleccion visual de formularios e informes durante la creacion de menues
 * Added: Variable E_DEPRECATED es presentada ahora en los mensajes del modo de depuracion
 * Added: Actualizado y optimizado el editor Wysiwyg
 * Added: Optimización del codigo y reducción en 0.5 MB el tamano de instalador
 * Added: Dos plantillas adicionales de ejemplo: Bluez y Nature  disponibles para descarga.  Por defecto se incluyen Nomo y Nature.
 * Added: Ampliacion de ayudas en creacion de menues
 * Added: Soporte a modulo de administracion de archivos
 * Fixed: Correcion en boton cancelar de creacion de menues
 * Fixed: Correcion en creacion de tablas SQLite y PostgreSQL, se independiza para especificar script en otros motores
 * Fixed: Obtencion de informacion de campos por tabla
 * Fixed: Supresión de SQLInjection
 * Fixed: Supresion de mensajes de advertencia innecesarios en multiples modulos
 * Fixed: Correcion en asignacion de valores predeterminados de texto largo y con formato a formularios
 * Fixed: Textos multi-idioma botones en creacion de campos para formularios

## Versión 13.6 (2013-06-03)
 * Added: Idioma inglEs basado en Google Translator
 * Added: Multi-idioma a mOdulos de tablas, usuarios y menUes
 * Added: Seleccion visual de plantillas
 * Added: Botones de administraciOn cambiados por CSS en lugar de imAgenes para permitir multi-idioma
 * Added: El asistente de actualizaciOn ahora permite parches sin firma de versiOn
 * Fixed: Las consultas SQL eran impresas durante el proceso de instalaciOn (se eliminan)
 * Fixed: [Tester: Esteban Rodriguez] AcciOn vacIa con sesiOn abierta ya no presenta ventana de login nuevamente.
 * Fixed: [Tester: Esteban Rodriguez] Posible inyecciOn SQL en login.
 * Fixed: [Tester: Esteban Rodriguez] Visualizacion de query con info sensible en errores capturados por PDO.
 * Fixed: Intento de login con caracteres invAlidos redirecciona a login nuevamente.

## Versión 13.5 (2013-05-02)
  * Added: Panel de control de configuración por el admin
  * Added: Autenticacion externa opcional mediante LDAP
  * Added: Soporte a encripción de claves en motores de autenticación externos sobre 11 tipos de algoritmo diferentes
  * Added: Nuevo módulo embebido para administracion LDAP disponible para descarga usando phpldapadmin-1.2.3
  * Added: Archivo def_basedatos contiene ahora la lista de campos por tabla para mejorar consultas
  * Added: Ahora los errores en tiempo de ejecución asociados a base de datos muestran el detalle del query para facilitar su depuración
  * Added: Mejora sustancial en la edición de campos sobre diseño de formularios. Dinámicamente permite cambio de tipos y propiedades
  * Added: Inicio del soporte multi-idioma
  * Added: Funcion de auditar para simplificar el codigo y dejarla disponible en el framework para funciones personalizadas
  * Added: Campo para almacenar scripts de java sobre formularios con funciones de autoejecucion y cualquier otra definida por el usuario
  * Fixed: Scripts PostgreSQL para proceso de instalación
  * Fixed: Scripts SQLite para procesdo de instalación
  * Fixed: Modo de depuracion siempre era desactivado en edición de configuración
  * Fixed: Se deja numero de version informativo al inicio del instalador
  * Fixed: Bloqueo de cambio de claves en motores de autenticación externos
  * Fixed: Autonomía del admin para cambios de clave siempre sobre Práctico
  * Fixed: Validaciones en tiempo de instalación de PHP y extensiones requeridas
  * Fixed: Consultas que requieren valor boobleano en postgresql se reemplazan de vble por vble=1
  * Fixed: Asistente de instalación, selección de motores y scripts asociados sobre /sql
  * Fixed: Error en conexiones PostgreSQL derivado de setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  * Fixed: Especificación de lista de campos para cada query Insert para mejora de compatibilidad entre motores
  * Fixed: Ajuste sobre captcha (posición sobre arreglo plantilla) para compatibilidad PHP 5.3+
  * Fixed: Corrección en creación de ruta cuando el motor seleccionado es SQLite durante instalación
  * Fixed: Valores MD5 son calculados por PHP para compatibilidad con motores que no tienen esa función
  * Fixed: Ajuste a instalador para selección de motor SQLite.
  * Fixed: Ajuste paso de isntalación con ayudas para selección de motor y condiciones

## Versión 13.4 (2013-04-01)
  * Added: Se permite la consulta de auditoria por usuario especifico
           por medio del listado de usuarios
  * Added: Se permite consultar la auditoria general de usuarios
           mediante el listado de usuarios
  * Added: Modo de monitoreo general, presenta en tiempo real las
           actividades por medio del listado de usuarios
  * Added: Se permite la creacion de modulos independientes sobre /mod,
           cada carpeta alli definida sera interpretada como un modulo
           cuyo punto de ingreso es un index.php y sera incluido en la
           ejecucion del modulo central.
  * Fixed: Correccion en textos de menu
  * Fixed: Instalaciones sobre MySQL activan ahora el buffer de consulta

## Versión 13.3 (2013-03-08)
  * Fixed: Sintaxis compatible para explode con PHP 5.3+ sobre comunes.php
  * Fixed: Generacion de graficos basados en su ID y no titulo para
           evitar problemas en nombre de archivo
  * Fixed: Mensajes tipo Notice en algunos scripts suprimidos cuando el
           modo de depuración es desactivado
  * Fixed: Definicion de variable durante generacion de captcha en
           servidores bajo windows evita su visualizacion, corregido
  * Fixed: Variable de host en conexiones a base de datos

## Versión 13.2 (2013-02-13)
  * Fixed: Sintaxis compatible para explode y PHP 5.3+ sobre comunes.php

## Versión 13.2 (2013-02-13)
  * Adición de longitudes máximas para campos de texto corto
  * Personalización del tamaño para campos de texto corto
  * Adición de objetos para los campos de selección de tipo radio-button
  * Botón de acceso directo a la vista previa de informes
  * Adición de acciones para informes
  * Utilidad de empaquetamiento en dev_tools (bajo Git)

## Versión 13.1 (2013-01-15)
  * Primer lanzamiento oficial