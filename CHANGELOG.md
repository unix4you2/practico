```
 _                      _                            _     _           
| |    ___   __ _    __| | ___    ___ __ _ _ __ ___ | |__ (_) ___  ___ 
| |   / _ \ / _` |  / _` |/ _ \  / __/ _` | '_ ` _ \| '_ \| |/ _ \/ __|
| |__| (_) | (_| | | (_| |  __/ | (_| (_| | | | | | | |_) | | (_) \__ \
|_____\___/ \__, |  \__,_|\___|  \___\__,_|_| |_| |_|_.__/|_|\___/|___/
            |___/ 
```

## Versión 20.3 (2020-04-04)

* Added [CORE]: Agregado el soporte nativo para ReactJS.  Las librerías de base de producción de ReactJS se encuentran incluidas en el core del aplicativo y pueden ser aplicadas desde cualquier JS de formularios, eventos o personalizado. Si se cuenta con entornos separados de desarrollo y produccion podrá utilizar lass versiones de desarrollo de ReactJS reemplazando directamente las librerías en su entorno de desarrollo si así lo desea.  Más información de cómo integrar fácilmente ReactJS a su proyecto puede ser encontrada en la documentación oficial aquí:  https://es.reactjs.org/docs/add-react-to-a-website.html  No se soporta JSX por defecto, si lo desea el desarrollador podrá incluirlo por su cuenta. 
* Enhan [CORE]: Cambios de clave para usuarios han sido reemplazados por objetos internos
* Enhan [CORE]: Reajustado el menu de configuracion
* Added [CORE]: Se ha agregado un generador y consumidor nativo de URLs cortas disponible en el menú de configuración.  Puede ser utilizado para consumos internos o incluso para sistemas de reventa de direcciones.  Cualquier variable recibida en los parámetros como q (letra cu, q) será interpretada como variable de enlace corto y será procesada como tal.
* Added [PCODER]: Soporte de editor {P}Coder para archivos gcloudignore
* Added [FORMS]: Los botones de acción agregados a los formularios en su barra inferior permiten ahora definir un ID de HTML único, lo que permitirá su fácil manipulación en tiempo de ejecución mediante JS o JQuery 
* Added [CORE]: Agregadas directivas en app.yaml para despliegues rápidos y elásticos sobre GAE (Google Application Engine)
* Enhan [MENUS]: Las opciones agregadas al menú izquierdo en formatos dropdown son agregadas dentro de items independientes con su propio salto de línea y clasificadas automáticamente según su sección
* Fixed [CORE]: Se retira la recoleccion de informacion mediante getallheaders() para el reporte automático de Bugs por compatibilidad con despliegues elásticos sobre Google Application Engine.
* Enhan [INFORMES]: Aumentado el tamano del campo ancho para la tabla de informes de manera que permita establecer el ancho según una clase CSS de Bootstrap para informes disponibles en el home de ususario y ajustadas las ayudas correspondientes en formulario de edicion de informes.
* Added [INFORMES]: Ahora sobre los informes se puede definir si éstos estarán o no disponibles para publicar directamente en el home como una forma rápida de generación de tableros de mando de usuario.  Un informe podrá entonces ser visualizado por medio del embebido de un formulario (forma tradicional) o la activación de disponibilidad en el home y posterior asignación como permiso al usuario.  Práctico automáticamente buscará informes de home asignados directamente al usuario y los presentará automáticamente en el escritorio.
* Enhan [CORE]: Actualizada clase para elementos ocultos en impresion que sobreescribe el estado previo de visibilidad como !important para garantizar su ocultamiento.
* Enhan [INFORMES]: Habilitada bandera de autodestruccion automatica de objetos tipo DataTable para cuando estos requieran ser reinicializados.  Si no existe el objeto lo inicializa, caso contrario lo elimina y reinicializa.
* Fixed [MENUS]: Corregido ocultamiento de menues laterales sobre dispositivos móviles.
* Enhan [CORE]: Funciones de generacion de paneles PCO_ImprimirPanelSimpleDashboard() soportan la especificacion de la clase CSS usada para sus titulos
* Added [PCODER]: El editor de codigo {P}Coder almacena el tipo de origen del codigo operado: A=rchivo F=ormulario I=nforme
* Added [CORE]: La funcion de CallBack para reemplazo de variables en cadenas PHP ha cambiado y permite ahora utilizar parametros para obtener valores directos desde un registro de datos del formulario que se esta cargando en el momento.  Para obtener valores de campos del formulario cargado actualmente directamente desde su variable PHP utilice la notacion {$ PCO_RegistroDatosActivo[PosicionONombreCampo]} lo que retorna el valor del campo para el registro que actualmente se esta recuperando sobre el formulario.  Puede ser utilizada en:  Campos texto corto (placeholder, valor, label y ayudas), Campos texto largo (placeholder, valor, label y ayudas), Campos de texto con formato no responsive (ayudas), Listas de selección (label, valores de opciones, etiquetas de opciones, condiciones de filtrado y ayudas), Etiquetas (valor), Valor de campo como etiqueta (ayudas), Listas tipo radio (label, valor del elemento, etiqueta del elemento y ayudas), Campos tipo check (label, tag personalizado), Deslizadores (label y ayudas), Archivos adjuntos (label y ayudas), Objetos canvas (label y ayudas), Objetos webcam (label y ayudas), Botones de comando (mensajes de confirmación, label),
* Enhan [MENUS]: Las opciones del menu de navegacion izquierdo son presentadas de acuerdo a su peso de manera ascendente
* Enhan [CORE]: Eliminado acceso a Waffle para seguimiento de Issues y PR. Agregado indicador de listo para PHP7.  Eliminado acceso a Hackpad para control de actividades e ideas por ejecutar.
* Fixed [CORE]: Corregido script en fallo durante pruebas unitarias de SQLite.
* Fixed [INFORMES]: Valor por defecto en parametro de ubicacion para función PCO_GenerarBotonesInforme
* Enhan [CORE]: Agregadas llaves foraneas entre objetos internos para aumentar velocidad en recuperacion de elementos durante el diseño.
* Enhan [CORE]: Eliminado el soporte de Postgresql y SQLite para operación del framework.  En adelante todo el framework corre internamente con MySQL o MariaDB.  El soporte para Postgresql y SQlite sigue operativo desde las conexiones extra que pueden ser creadas posterior a la instalación.  Aquellos que utilicen alguno de estos motores pueden hacer una migración directa de sus tablas a MySQL y crear una conexión extra para el motor actualmente trabajado bajo la opción Conexiones Extra y Replicación.
* Added [KANBAN]: Tableros Kanban presentan ahora cantidad de tareas total sobre el tablero y cantidad de tareas archivadas
* Added [KANBAN]: Tableros kanban presentan una barra de progreso indicando el avance total del tablero frente a las tareas activas y las archivadas
* Added [KANBAN]: Las columnas de tareas sobre tableros Kanban presentan el total de peso porcentual de su número de tareas frente al número de tareas total del tablero activo.
* Enhan [PCODER]: Actualizacion de PMyDB y PCoder a versiones 20.4
* Added [KANBAN]: El acceso a los tableros Kanban presenta ahora un estado resumido de todos los tableros a los cuales el usuario tiene acceso y solamente deja realizar su navegación a través de un solo tablero al tiempo para agilizar operaciones de gestión de tareas mediante arrastre-soltar y facilitar visualización a tableros complejos.
* Enhan [KANBAN]: La creación de tableros Kanban se restringe sólo a usuarios administradores.
* Fixed [KANBAN]: Creación de tablero kanban redirige automáticamente al usuario al tablero recién creado para finalizar su configuración o realizar actividades en él.
* Fixed [KANBAN]: Eliminación de tableros kanban redirigirá al usuario al resumen de tableros definidos para éste.
* Added [KANBAN]: Informes extra sobre cada tablero Kanban presentan districución de tareas por usuario y por categoría.
* Added [FORMS]: Diseñador de formularios permite introducción de valores manuales para orígenes de valores y etiquetas en controles de lista de selección.
* Added [CORE]: Agregada nuevo botón de alertas en la barra de navegación superior.  Dicho botón presenta automáticamente los informes asignados al usuario y que puedan entregar algún registro.  Adicionalmente cuenta los registros resultantes de cada informe (el usuario puede tener varios) y los presenta como conteo al lado del botón de campana de alertas.
* Added [CORE]: Nuevos identificadores de ID de marco HTML para manipular sección de alertas y sus conteos:  PCODIV_IconoAlertasBarraSuperior, PCODIV_ConteoAlertasBarraSuperior y PCODIV_MarcoContenidoAlertas


## Versión 19.8 (2019-11-21)

* Fixed [CORE]: Scripts de despliegue para tablas de PCoder sobre PostgreSQL y SQLite
* Fixed [MENUS]: Durante la asignación de permisos a usuarios solamente son desplegadas las opciones de menu externas. Aquellas asociadas a formularios son ocultadas pues son controladas por el acceso al formulario que las contiene.
* Enahn [PCODER]: Mejorada presentación de estadísticas sobre PCoder en informes y maquetación
* Enahn [INFORMES]: Cambiado el modo SQL por defecto para conexiones MariaDB y MySQL evitando el STRICT_TRANS_TABLES para aquellos que tengan problemas de compatibilidad.  Si usted desea mantener activado el STRICT_TRANS_TABLES en su motor posterior a esta actualizacion puede comentar la linea relacionada sobre core/conexiones.php
* Enahn [CORE]: Muchas de las funciones internas de gestión de usuarios han sido reemplazadas por objetos propios del framework ahorrando varios cientos de líneas de código.
* Enhan [INFORMES]: El ocultamiento de encabezados o pies de pagina en informes también ahorra el espacio asociado a éstos en la maquetación.
* Added [INFORMES]: Los encabezados y pies de pagina de los informes tabulares pueden ser ahora manipulados en el DOM mediante los ID HTML PCO_EncabezadosInforme_XXX y PCO_PiePaginaInforme_XXX reemplazando XXX por el ID de informe correspondiente.
* Added [CORE]: Agregada una nueva variable de control de flujo llamada PCO_PostAccionDirecta.  Combinada con las variables de la familia PCO_PostAccion permite definir en las operaciones automaticas de Almacenamiento, Actualización y eliminación de registros que no se haga la redirección y carga de la PostAccion en un nuevo flujo sino que se continúe en el mismo flujo actual.  Esto permite procesar variables ilimitadas preguntando en cualquier módulo personalizado por éstas en la entrada asociada a la PCO_PostAccion (En lugar de PCO_Accion).
* Added [GENERAL]: Texto aclaratorio en el asistente de actualizaciones recuerda al usuario que para instalaciones o servidores restringidos para carga de archivos grandes puede lanzar el proceso manualmente mediante URL y ciertos parámetros.
* Enhan [INFORMES]: En los informes exportables a excel directamente por datatables se elimina la primera fila correspondiente al título para que los datos salgan crudos solamente con sus títulos de columna y sea más fácil su manipulación.
* Added [GENERAL]: Scripts iniciales para la capa de soporte a las fases de documentación automática del proyecto
* Enhan [INFORMES]: Aumentada la longitud máxima de caracteres por defecto para los resultados de las funciones group_concat a un total de 15Kb
* Enhan [FORMS]: Mejorado el almacenamiento de objetos gráficos canvas.  Ahora se hace directamente en formato PNG para ser fácilmente recuperado.
* Enhan [FORMS]: Los objetos tipo canvas cambian su formato de comprimido a PNG nativos y automáticamente se recortan para eliminar áreas sin utilizar en el objeto.
* Otros [CORE]: Generada pagina como formulario público en el sitio web para reemplazo del proyecto (ahora extinto) de SayThanks
* Added [INFORMES]: Ahora los informes tipo gráfico que no contengan datos y puedan arrojar un valor visual NaN son reemplazados por un mensaje informativo automatico que indica al usuario que los datos para generar el grafico no están disponibles o no son adecuados.
* Added [INFORMES]: Los informes permiten definir un texto o encabezado enriquecido o en HTML que permite ser agregado en la parte superior del informe tabular o de gráfico.
* Added [INFORMES]: Ahora la función de generación de informes permite su llamado con simplemente una sentencia SQL generando la tabla correspondiente de registros.  Ejemplo de llamado:  PCO_CargarInforme(0,0,"","",0,0,0,0,"SELECT * FROM MiTabla LIMIT 0,10");  Tener en cuenta que esto es sólo un llamado a la tabla que puede ser realizado directamente por código, su formateo y presentación dependen del programador.
* Enhan [CORE]: Por defecto el chequeo dinámico de sintaxis se encuentra desactivado para efectos de compatibilidad y velocidad.  Quienes deseen activarlo pueden agregar a su archivo de configucación la variable $ PCO_ChequeoDinamicoSintaxis=1
* Added [FORMS]: El diseñador de formularios permite establecer estilos de ventna diferentes para cada uno de los formularios de la aplicación.
* Added [INFORMES]: Los informes soportan ahora su maquetación y despliegue con tablas 100% responsive.  Cuando las columnas no quepan dentro de la pantalla o dispositivo éstas serán reducidas de manera automática y aquellas ocultas (incluyendo posibles botones) podrán ser desplegadas por el usuario a voluntad.
* Enhan [CORE]: Actualizada la versión de PMyDB a 19.8 permitiendo mejoras visuales en maquetación y recuperando el resaltado de código SQL
* Added [FORMS]: Ahora para elementos tipo canvas se permite agregar en el ancho y el alto el porcentaje final o proporción que debe ser aplicado al dibujo o elemento canvas separado por una barra de canalización. Ej:  300|50  Especifica que se debe crear el objeto con un ancho en pantalla de 300 pixels; pero que al guardarlo se debe redimensionar a un 50% de ancho.  Igual aplica para el alto.  En caso de no encontrarse un segundo valor se asume que la escala es al 100%
* Enhan [MENUS]: Los menues generados para el sistema central, así como los creados dependientes de formularios cuentan ahora con un hash único que los identifica para que puedan ser fácilmente clonados y transportados entre sistemas sin perder sus vínculos o propiedades.
* Enhan [GENERAL]: El administrador de archivos es reubicado al menú de configuración de le harremienta, de esa manera se deja el menú izquierdo como exclusivo para opciones de aplicación para los usuarios.
* Enhan [CORE]: Se confinan los formularios asociados a operaciones de adminitración para que sólo sean generados cuando el usuario activo sea un administrador de plataforma haciendo mas rápido y seguro el cargue de la herramienta por parte de usuarios estándar.
* Enhan [MENUS]: Se mejora la selección de permisos para usuarios indicando cuando algunos de éstos se encuentren como opciones de segundo nivel de otras ya que antes eran desplegados al mismo nivel y orden de las demás.
* Enhan [CORE]: Se sustituyen más de 350 líneas de código dentro de los módulos de permisos y usuarios por objetos internos del framework.  
* Added [FORMS]: En modo de diseño de formularios cuenta en la barra de edición de cada objeto con un botón que permite desplazar de manera general todos los elementos de la columna aumentando el peso en una unidad.  De esta manera se facilita la adición de nuevos elementos cuando los pesos de los elementos ya se encuentran totalmente ocupados.


## Versión 19.7 (2019-09-10)

* Added [FORMS]: Ahora los formularios identifican de manera unica los elementos de sus menues superiores como MENU_FORMULARIO_OPCION_XXX de acuerdo a su orden de aparicion con el fin de brindar mayor control sobre los mismos en tiempo de ejecucion.
* Enhan [CORE]: Actualizada la versión base de PMyDB a 19.6
* Enhan [FORMS]: Mejorada presentacion grafica y estilos para listas con carga dinámica
* Enhan [GENERAL]: Agregada nueva variable de sesion PCOSESS_NombreUsuario
* Enhan [PCODER]: Actualizada la versión de PCoder a la 19.7 con las siguientes mejoras:
* Added [PCODER]: Copias de seguridad automaticas en cada edición de archivo.
* Added [PCODER]: Comparación dinámica entre versiones anteriores de código y la versión actual de archivo tomadas desde el historial de versiones automático.
* Added [PCODER]: Control de concurrencia y cierre adecuado de archivos cuando varios desarrolladores trabajan al tiempo.
* Added [PCODER]: Mensajería entre desarrolladores heredada de Práctico Framework permite una interacción simplificada además de emitir mensajes automáticos de advertencia sobre ciertos eventos.
* Added [PCODER]: Inclusión de {P}Board (beta).  Una característica que permite al desarrollador editar además de código, archivos gráficos en diferentes formatos con retoques, filtros y otras posibilidades.  Se proyecta a {P}Board como herramienta de pizarra compartida entre desarrolladores para futuras versiones.
* Added [PCODER]: Inclusión de {P}Diagram (beta).  Un editor de diagramas multipropósito tanto para documentación del sistema bajo UML, flujogramas, etc.  Como la documentación para modelos de BPM.  Se proyectará como herramienta para el almacenamiento de diagramas complementarios por Formulario e informes del Framework.
* Added [PCODER]: Inclusión de {P}Mettings (beta).  Herramienta que permite interacción más completa entre desarrolladores.  Por ahora se incluye solamente el chat y el seguimiento de punteros.  Se proyecta como herramienta de audioconferencia Peer-to-Peer entre desarrolladores y herramienta para compartir pantalla en versiones futuras.
* Added [PCODER]: Mejoradas algunas funcionalidades internas del editor en recuperación y almacenamiento de archivos.


## Versión 19.6 (2019-08-15)

* Added [INFORMES]: Los informes con DataTables activado permiten ahora ser exportados directamente del lado del usuario en diferentes formatos (Portapapeles, CSV, XLS y PDF)
* Enhan [INFORMES]: El disenador de informes presenta opciones de datatables solamente cuando estan activadas.
* Enhan [INFORMES]: Durante la generacion de informes se pregunta solamente por los datos básicos.  Sus opciones avanzadas y personalización serán configurados posteriormente en el paso siguiente a su creación.
* Enhan [INFORMES]: Ahora se puede personalizar en la configuracion de informes si se desea presentar o no sus encabezados de olumna o pie de paginas por separado.
* Enhan [INFORMES]: Las variables que contienen los administradores del sistema y la zona horaria son ahora transferidos a cada consulta realizada por el motor bajo los nombres @PCOVAR_Administradores y @PCOVAR_ZonaHoraria en caso de ser requeridos por el programador y adicionalmente el motor asigna la zona horaria indicada por defecto.
* Added [FORM]: Ahora se permite crear listas desplegables que recuperan sus datos dinamicamente mientras se escribe.  Util cuando se manejan tablas con una cantidad alta de registros para poblar la tabla.  Para tal fin se utilizan los mismos parametros de lista donde se definen las tablas y campos de origen así como las condiciones de filtrado
* Fixed [FORM]: Los formularios que contengan otros formularios embebidos y con multiples pestanas cada uno ahora diferencian sus pestanas en los embebidos como PCO_PestanaSubFormulario_X 
* Enhan [FORM]: Ahora los elementos como pestañas de formulario, botones de comando inferiores y contenidos de pestañas con nombre PCO_NoVisible son ocultadas en formatos de impresión. 
* Fixed [FORM]: La generacion de formularios internos y sus funciones de AutoRun son ahora etiquetadas como LTZ y su signo negativo es restirado para evitar errores de JavaScript
* Fixed [USUARIOS]: La asignacion de permisos de informes de usuarios evita los informes internos del framework


## Versión 19.5 (2019-07-10)

* Added: [FORMS] Ahora durante el almacenamiento de datos de un formulario se permite utilizar variables de postaccion para capturar el valor del ID de registro asociado a los datos almacenados.  Para esto el VALOR de la variable de postaccion debe ser establecido a _OBTENER_ULTIMO_ID_ y con esto en la siguiente acción se contará con dicho valor en el nombre de variable transportado para trabajar.
* Added: [GRAL] Agregado un identificador único PCO_LogoAplicacion a la imágen de logo utilizada en la barra de navegación de la plataforma.  De esta manera el desarrollador podrá cambiarla de manera dinámica.
* Added: [GRAL] Ahora los mensajes modales generados mediante PCOJS_MostrarMensaje permiten la modificación del contenido del marco que incluye los botones inferiores mediante el identificador de HTML PCO_Modal_MensajeBotones
* Added: [LIBS] Se ha cambiado la libreria por defecto para la generación de gráficos de Morris 0.5.1 (Olly Smith) a su versión mejorada 0.6.2 (mantenida por @pierresh) permitiendo otras variedades de gráficos, etiquetas y demás.  Es posible experimentar algunos cambios en color de gráfico pero esto no altera su presentación, maquetación o representación de datos.
* Added: [GRAL] Posibilidad de importar automaticamente scripts de ejecucion única de PHP sobre la carpeta xml/ donde se almacenan las definiciones de archivos que se corren una unica vez en procesos de actualización de framework.
* Added: [INFORMES] A partir de ahora los informes cuentan con dos parametros adicionales que permiten ocultar de raiz sus botones de comando por registro y sus pie de pagina con conteo de resultados cuando son llamados desde código mediante la función PCO_CargarInforme
* Added: [INFORMES] Ahora el diseñador de informes presenta la vista previa de la consulta de dos maneras diferentes: Vista previa con reemplazos de variables y estilos y vista previa sin los reemplazos para ser utilizada en pruebas directamente sobre el motor.
* Added: [INFORMES] El diseñador de informes permite especificar si por defecto se presentan o no los valores asociados a cada elemento del gráfico, además de permitir definir si dichos valores se ubican dentro o fuera del elemento (casco, torta, barra, etc)
* Added: [INFORMES] Se permite a los diseñadores agregar los arreglos de colores que desean utilizar para cada uno de sus gráficos.
* Added: [FORMS] Los diseñadores de formularios advierten al desarrollador cuando por algún motivo se encuentren campos sobre la tabla vinculada que aún no han sido agregados al formulario o cualquier otro formulario embebido.
* Added: [GRAL] La actualizacion y eliminacion de registros que incluyan archivos adjuntos ahora hacen la actualización o eliminación de los archivos correspondientes.  SOLAMENTE para campos de tipo adjunto sobre el formulario principal, no se contemplan los campos de este tipo en formularios emebebidos.  Gracias a @rafaelposadaf
* Added: [INFORMES] Ahora los botones de acción agregados a los informes permiten definir si su ubicación será al principio de las columnas o al final
* Added: [INFORMES] Ahora los gráficos de barra pueden ser diagramados en sentido horizontal y vertical de acuerdo a lo configurado en sus propiedades.
* Added: [INFORMES] Agregados los tipos de gráfico de torta completa tradicionales como una transformación de los gráficos tipo dona.
* Enhan: [LIBS] Actualizada versión de Rapahel de Dmitry Baranovskiy a 2.2.8
* Enhan: [LIBS] Agregada librería Regression 1.4.0 de Tom Alexander para soportar nuevos tipos de gráfico sobre Morris (líneas de tendencia polinomiales, logarítimcas y exponenciales)
* Enhan: [INFORMES] Actualizacion de la librería PHPExcel a la versión 1.8.2
* Enhan: [GRAL] Se evita rutinas de chequeo de sintaxis en sistemas FreeBSD
* Enhan: [GRAL] Ayudas de uso extra para entornos de desarrollo en Vagrant
* Enhan: [GRAL] Los colores en los botones del modal de desarrollo han sido cambiados para que coincidan con los colores de los controles de acceso a los mismos modulos disponibles en el escritorio
* Enhan: [GRAL] Optimizado código de reemplazo de nombres de archivo durante operaciones de almacenamiento de adjuntos gracias a @rafaelposadaf 
* Fixed: [LIBS] Actualización a Pcoder en Asignacion de variables tipo variables compatible con versiones nuevas de PHP
* Fixed: [GRAL] Ajustada la sintaxis en procesos de importacion de definiciones XML para sistemas windows que impedían retornar los valores de manera adecuada al revisar los nodos generados por SimpleXML
* Fixed: [FORMS] Formularios embebidos en otros y con funciones autorun son reemplazadas por nombres unicos para evitar duplicidad de nombres de funciones en JS
* Fixed: [FORMS] Campos de subformularios tenidos en cuenta durante almacenamiento y actualizacion en tablas de formulario padre
* Fixed: [FORMS] Icono de información de elemento sobre la barra de herramientas flotante durante el diseño de formularios contaba con la misma acción que el botón de cambio de columna.  Se elimina la acción y se deja sólo como botón informativo.
* Fixed: [SESION] Eliminado cierre de sesion que impedía los inicios de sesion en servidores windows y fedora debido a un no mantenimiento de la sesion activa por parte del servidor web.


## Versión 19.2 (2019-02-01)

* Added: [FORMS] La personalizacion de tags soporta ahora parámetros que requieran espacios encerrados por comillas dobles.
* Added: [FORMS] Controles de tipo checkbox convertidos a boton tipo toggle mediante personalización de Tag soportan ahora traducción de variables en notacion PHP {$} para multiples idiomas y otros usos.
* Added: [FORMS] Durante la adicion de formularios embebidos se permite realizar busqueda sobre la lista para proyectos con gran cantidad de formularios.
* Added: [FORMS] Ahora se permite establecer el tipo de maquetacion para columnas de formularios como tradicional (Tablas HTML) o responsive (Cols de bootstrap) lo que permite hcaer más fluido y responsive el contenido diagramado para ciertos dispositivos.  Esto permitirá convertir de manera automática maquetaciones tradicionales a otras más fluidas y responsives.
* Added: [FORMS] Para cada columna de formulario se permite definir su clase para aplicación de estilos CSS y responsive.  Cuando el número de clases especificadas es menor al número de columnas éstas serán aplicadas en orden y la última será utilizada para aplicar a las columnas restantes permitiendo definir una sola cadena de clases para formularios con múltiples columnas.
* Added: [MONIT] Los monitores tipo máquina sobre el sistema de monitoreo soportan ahora un modo Ultra compacto que consume sólo una unidad de la rejilla; pero que se expande automáticamente a modo compacto cuando el monitor está caído para facilitar su visualización.
* Added: [MONIT] El sistema de monitoreo permite intercambiar entre pantallas fullscreen o normal mediante botón en su barra superior.
* Added: [CRON] Agregado modulo que permite generar planificacion de tareas.
* Fixed: [MONIT] Error de tipado en variable de página recurrente.
* Enhan: [FORMS] Llamado de funciones personalizadas u bjetos internos desde formularios se hace ahora a través de la función de validación de campos de formularios para unificar su uso con los botones de almacenamiento y actualización de datos.
* Enhan: [FORMS] Automáticamente en cada llamado al framework se hace la reasignación de variables que provienen de listas múltiples a sus variables estandar para su uso de manera tradicional.
* Enhan: [FORMS] La opción para definición de scripts de un formulario es elimnada desde su creación.  Esto ahorra espacio en diseño; pero seguirá estando disponible a través del diseño detallado de formulario pues una vez creado es que generalmente se definen comportamientos extra.
* Enhan: [FORMS] Mejorada aun mas la velocidad de carga de los controles tipo lista bajo version 1.6.5 haciendo render anticipado del control.
* Enhan: [FORMS] Reducción de código en módulo de formularios por cambio a formulario dinámico
* Enhan: [LIBS]  Cambio de version en libreria select-boostrap de  version 1.12.4 a 1.6.5
* Enhan: [LIBS] Se valida la previa instalacion/disponibilidad de la extension mbstring de PHP sobre el servidor.
* Enhan: [AUDIT] Redistribucion de elementos en auditoria.
* Added: [AUDIT] Posibilidad de hacer seguimiento a eventos de tareas programadas bajo el usuario PCO.Cron
* Added: [GRAL] Agregada nueva funcion PCO_EvaluarCodigo permite reemplazar funciones inseguras eval de PHP mediante la generación de archivos temporales de inclusión de código.  Se depura todo el codigo de aplicacion reemplazando el uso de la funcion eval por otras alternativas.
* Enhan: [GRAL] Agregado enlace al proyecto SayThanks.
* Enhan: [GRAL] Agregado enlace al chat de desarrolladores en Gitter para facilitar interacción.
* Enhan: [GRAL] Limpieza de algunas advertencias para variables de sesion e idioma no definidas.
* Enhan: [GRAL] Actualizada versión de PMyDB a 19.1 incluyendo entre otras, las siguientes mejoras: automcompletacion de atributos en login, compatibilidad con Clickhouse, SQLite oculta el servidor al login, permitir deshabilitación de campos booleanos en postgresql, permitir almacenar queries en favoritos, permitir agregar más de dos índices en campos foráneaos al tiempo, evitar sobreescribir tablas existentes durante copias, se incremente el login a maximo 80 caracteres, permite que las tablas se puedan desplazar horizontalmente, corrige índices descendentes, reconoce disparadores ON UPDATE en funciones current_timestamp(), otros.
* Enhan: [GRAL] Actualizada versión de PCoder a 19.2 incluyendo entre otras, las siguientes mejoras: agregados atajos de teclas de sublime, agregada la opción de rtl, corregidas las opciones de regrsión para vim, mejorada la captura de eventos de teclado para internet explorer y ipads, nuevos elementos de resaltado de sintaxis, se remueve el uso de innerhtml, se agrega soporte para números de líneas relativas, se mejora el sistema de popups de autocompletacion, se usa css para la animación del cursor, otros.
* Enhan: [GRAL] Se eliminan pruebas automatizadas de Travis para la máquina HHVM
* Enhan: [GRAL] Se eliminan modulos adicionales de gestor embebido de servidores LDAP y modulo de ejemplo de Social Parser de Práctico.  En adelante quien lo requiera lo podrá agregar manualmente utilizando sus fuentes sobre /dep ahorrando así mas de 4.5 MB de codigo en mas de 6100 archivos.
* Enhan: [VIEW] Ajustes a presentacion de imagenes de fondo
* Enhan: [VIEW] Actualizacion del logo de plataforma
* Fixed: [FORMS] Cuando se trate de campos no existentes dentro de la base de datos asociada al formulario, no se intentará hacer una carga del dato desde el registro pues siempre será vacío.
* Fixed: [INFORMES] Asignacion automática de formularios de filtrado derivados del mismo ID de informe.
* Enhan: [INFORMES] Ampliada la longitud del campo de descripcion para los informes.
* Added: [SESION] Ahora por defecto la autenticacion de la plataforma se hace mediante comparacion directa con las tablas de sistema.  Si se desea activar el modo heredado o anterior de servicios web internos se puede utilizar la variable Auth_MotorWS=1 en el archivo de configuracion


## Versión 19.1 (2018-10-28)
*IMPORTANTE:*  Quienes actualizan desde versiones 18.8 requiere que se aplique a éstas el último parche de actualización de dicha versión (Practico_18.8-Actualizacion_002) que las convierte a versión 18.9.

LEAME: ADVERTENCIA: Para quienes actualizan desde versiones previas con el fin de evitar colisiones y estandarizar la llamada de acciones internas, las siguientes acciones han cambiado de nombre:
Accion autenticacion_oauth cambia a PCO_AutenticacionOauth  Esto puede implicar cambiar sus API de redireccion con los proveedores asociados.
Funcion enviar_correo cambia a PCO_EnviarCorreo

* Added: [OAUTH] Ahora se soportan más de 60 proveedores OAuth.  Agregados: 37Signals,Amazon,AOL,Bitly,Buffer,Copy,Dailymotion,Discogs,Etsy,Fitbit2,Garmin,Garmin2Legged,Google1,iHealth,imgur,Infusionsoft,Intuit,Jawbone,LinkedIn2,Livecoding,MailChimp,Mavenlink,mail.ru,Meetup,MicrosoftOpenIDConnect,Misfit,oDesk,Odnoklassniki,Paypal,PaypalSandbox,PaypalApplication,Pinterest,Rdio,Reddit,RunKeeper,Uber,TeamViewer,Twitter2,Vimeo,Wordpress,Xero,Yammer,Yandex
* Added: [FORMS] Ahora las listas de seleccion (combobox) soportan elementos para agrupacion de opciones.  Para tal fin se debera contar con la palabra clave (usando los underline pegados al parametro) _ OPTGROUP _|EtiquetaDeseada como *valor* en la apertura del elemento. Elementos que carezcan de una etiqueta seran considerados automaticamente como elementos de cierre de grupo.  Aplica tanto para opciones fijas como opciones tomadas desde base de datos.
* Added: [FORMS] NUEVO TIPO DE CONTROL: Los controles de datos tipo checkbox pueden ser fácilmente transformados a controles de boton tipo Toggle.  Para esto puede ser utilizado el campo de personalización del TAG disponible ahora sobre estos controles.  Vease ayuda del campo para amplias posibilidades de personalizaciones completas!
* Added: [FORMS] Los controles de datos tipo checkbox permiten la ocultación de su etiqueta sobre los formularios para adecuarse ante textos predefinidos en controles nuevos como los tipo toggle.
* Added: [FORMS] Almacenamiento y recuperación automática de listas de selección múltiple que almacenan sus valores separados únicamente por comas.
* Added: [INFORMES] En los reportes/informes de tipo grafico se permite ahora generar un tootip con el título del reporte sobre el resultado final activando dicha bandera en su diseño.
* Added: [MENU] Se agrega la columna informativa de seccion a la administracion de menues, ordenando las opciones de acuerdo a su sección y peso.
* Added: [MENU] Ayuda extra para el campo de imagen durante la creacion de menues.
* Added: [KANBAN] Usuarios con tableros propios o compartidos cuentan con acceso automático a éstos a través del menú de perfil.
* Added: [KANBAN] El explorador de tableros ahora permite visualizarlos todos al tiempo.
* Added: [CHAT] El sistema de chat diferencia entre los niveles de chat configurados para presentar la opción de menu al usuario y la lista de usuarios disponibles para chat.
* Added: [AUDIT] Ahora cualquier consulta al motor de base de datos que genere algún error será llevada automáticamente al log de auditoría bajo el usuario SQLog:error
* Added: [AUDIT] Agregadas nuevas opciones de filtro de usuario en módulo de auditorías para permitir filtrar operaciones realizadas por funciones internas del framework.
* Added: [AUDIT] Se agrega a la opción general de auditoría un gráfico que presenta de manera automática los errores SQL generados internamente para el rango de fechas establecido.
* Added: [PWA] Se permite control de configuración para solicitar el envío de notificaciones al usuario.
* Added: [PWA] Se agrega control de configuración para solicitar al usuario el envío automático de su ubicación geográfica estimada por GPS o WiFi cercanas.
* Added: [PWA] Se agregan controles de configuración para solicitar al usuario permiso para el uso de camara y/o microfono.
* Added: [GENERAL] Ahora desde la configuracion de apariencia de la aplicacion se permite ocultar la barra superior a los usuarios estandar, lo que permite mayor espacio para las aplicaciones.  El programador deberá garantizar por sus medios algunas acciones comunes como cierre de sesión o similares.
* Enhan: [MONITOREO] Actualizada alarma de monitoreo a formato OGG para compatibilidad con reproduccion automatica en navegadores sin necesidad de codecs extra.
* Enhan: [LIBS] Actualizacion de version 1.92 a 1.94 del cliente HTTP para PHP.
* Enhan: [LIBS] Actualizacion de version 1.109 a 1.165 del cliente OAuth para PHP.
* Enhan: [LIBS] Actualizacion del plugin DataTables a la versión 1.10.18
* Enhan: [LIBS] Ahora la funcion interna de PCOJS_MostrarMensaje soporta un tercer parámetro que indica la clases adicionales para personalizar el dialogo modal.
* Enhan: [FORMS] Las ayudas de personalizacion de etiquetas son tan amplias que ahora se imprimen directamente sobre el disenador de campos facilitando además su copy-paste
* Enhan: [MENU] Al igual que las pestanas de formulario, ahora las opciones de menu definidas dentro de una sección con nombre PCO_NoVisible no serán presentadas al usuario.
* Enhan: [KANBAN] Sólo los usuarios propietarios de un tablero pueden eliminar o archivar tareas sobre éste.
* Enhan: [KANBAN] Sólo los usuarios propietarios de un tablero lo pueden personalizar, configurar o compartir.
* Enhan: [CHAT] Suprimido codigo interno a cambio de objeto en Práctico para marco de chat.
* Enhan: [INFORMES] Ayuda de complemento en activacion de campos editables sobre informes.
* Enhan: [LOGIN] Se oculta barra superior cuando no se tiene sesion y se va a pantalla de login ahorrando así espacio cuando se trata de aplicaciones móviles.
* Enhan: [GENERAL] Se evita errores 404 al buscar imagen de fondo de aplicación cuando esta realmente no ha sido definida en la configuración.
* Enhan: [PWA] Se migra de servicios GCM a Firebase cloud messaging para notificaciones push.
* Enhan: [LOGIN] Por seguridad se evita el autocompletado o almacenamiento en campos de login.
* Enhan: [SE] Ahora cualquier versión estándar puede ser convertida a versión SE.
* Enhan: [GENERAL] Ahora se pueden correr multiples funciones AutoRun de formularios cuando están definidas al mismo tiempo.  Por defecto se ejecutan primero las funciones AutoRun de formularios embebidos y luego las de sus formularios contenedores.
* Fixed: [PWA] Se conservan valores de scope (alcance) para aplicaciones móviles que residen sobre carpetas del dominio en lugar de su raíz.
* Fixed: [MONITOREO] Cuando valores de cronometro en monitoreo sobrepasan el limite cero (negativos en conteo) autoenvia formulario de monitoreo al bajar de -10 segundos.
* Fixed: [INTERNO] Preautorización de funcion interna PCO_CargarObjeto para evitar su registro en funciones autorizadas
* Fixed: [OAUTH] Los valores de URI de redireccion para configuraciones OAuth son ahora calculados nuevamente de manera automática.  Los campos en configuración quedan como solo lectura con ayudas de formato.
* Fixed: [MENU] Se evita limpieza automática de secciones durante la edición de opciones de menú que no se encuentran agrupadas por otra.
* Fixed: [MENU] Opciones hijas de otra que están ubicadas en la sección central son evitadas por defecto, ya que dependen de la ubicación de su padre.
* Fixed: [MENU] Permisos extendidos sobre submenues.
* Fixed: [AUDIT] Corregido el orden de los campos de fecha para filtros de auditoría y evitar confusiones en su uso.
* Fixed: [FORMS] Informes de tipo dataTable embebidos en pestañas diferentes a la inicial del formulario autoajustan sus encabezados de columnas

## Versión 18.8 (2018-07-29)
LEAME: ADVERTENCIA: Para quienes actualizan desde versiones previas con el fin de evitar colisiones y estandarizar la llamada a metodos y funciones internas, las siguientes funciones han cambiado de nombre:
file_get_contents_curl() cambia a PCO_FileGetContents_CURL()
file_get_contents_socket() cambia a PCO_FileGetContents_SOCKET()
file_get_contents_nativo() cambia a PCO_FileGetContents_NATIVO()
cargar_url() cambia a PCO_CargarURL()
registro_a_xml() cambia a PCO_ConvertirRegistroXML()
PCOFUNC_eliminar_formulario() cambia a PCO_EliminarFormulario()
PCO_copiar_permisos() cambia a PCO_CopiarPermisos()
PCO_copiar_informes() cambia a PCO_CopiarInformes()
listado_exploracion_archivos() cambia a PCO_ListadoExploracionArchivos()
listado_visual_exploracion_archivos() cambia a PCO_ListadoExploracionArchivosVisual()
opciones_combo_desdecsv() cambia a PCO_OpcionesComboDesdeCSV()
aparear_campostabla_vs_hojacalculo() cambia a PCO_AparearCamposTabla_vs_HojaCalculo()
columnas_desde_hojacalculo() cambia a PCO_ColumnasDesdeHojaCalculo()
datatable_desde_hojacalculo() cambia a PCO_DatatableDesdeHojaCalculo()
TextoAleatorio() cambia a PCO_TextoAleatorio()
CodigoQR() cambia a PCO_CodigoQR()
obtener_ultimo_id_insertado() cambia a PCO_ObtenerUltimoIDInsertado()
existe_valor() cambia a PCO_ExisteValor()
ContarRegistros() cambia a PCO_ContarRegistrosTabla()
abrir_ventana() cambia a PCO_AbrirVentana()
cerrar_ventana() cambia a PCO_CerrarVentana()
abrir_barra_estado() cambia a PCO_AbrirBarraEstado()
cerrar_barra_estado() cambia a PCO_CerrarBarraEstado()
abrir_dialogo_modal() cambia a PCO_AbrirDialogoModal()
cerrar_dialogo_modal() cambia a PCO_CerrarDialogoModal()
mensaje() cambia a PCO_Mensaje()
cargar_objeto_texto_corto() cambia a PCO_CargarObjetoTextoCorto()
cargar_objeto_texto_largo() cambia a PCO_CargarObjetoTextoLargo()
cargar_objeto_lista_seleccion() cambia a PCO_CargarObjetoListaSeleccion()

LEAME: ADVERTENCIA: Para quienes actualizan desde versiones previas con el fin de evitar colisiones y estandarizar la llamada de acciones internas, las siguientes acciones han cambiado de nombre:
Accion cargar_objeto cambia a  PCO_CargarObjeto
Accion actualizar_clave cambia a  PCO_ActualizarContrasena
Accion cambiar_clave cambia a  PCO_CambiarContrasena
Accion ejecutar_importacion_csv cambia a PCO_EjecutarImportacionCSV
Accion escogertabla_importacion_csv cambia a PCO_EscogerTablaImportacionCSV
Accion analizar_importacion_csv cambia a PCO_AnalizarImportacionCSV
Accion confirmar_importacion_tabla cambia a PCO_ConfirmarImportacionTabla
Accion importar_tabla cambia a PCO_ImportarTabla
Accion Ver_menu cambia a PCO_VerMenu

LEAME: ADVERTENCIA: Para quienes actualizan desde versiones previas con el fin de evitar colisiones y estandarizar nombres de variables internas, las siguientes variables han cambiado de nombre:
Variable objeto (usada en las acciones de cargar_objeto) cambia a  PCO_Objeto
Formulario interno core_ver_menu cambia a PCO_FormVerMenu

Se recomienda encarecidamente que si usted hace llamados manuales a este tipo de funciones primero haga un reemplazo de las mismas dentro de su codigo fuente para evitar conflictos. Lo cual podría llevar a cabo con un simple reemplazo de cadena en sus archivos (Ctrl+H en su {P}Coder).
Desarrolladores que no hagan llamado a estas funciones en su código y que sólo utilicen funciones nativas no tienen que hacer ajuste alguno. Las funciones de advertencia serán mantenidas sólo hasta la versión 18.9.

A partir de PHP 5.6 aquellos desarrolladores que deseen utilizar sus funciones anteriores "Tal como están" podrán utilizar un alias para ellas agregando las definiciones correspondientes en las primeras lineas de su archivo personalizadas_pre.php, por ejemplo:
use function PCO_AbrirVentana as abrir_ventana;  Aunque en la práctica esto sería una mala idea pues más adelante puede que sean totalmente obsoletas dichas funciones.

El nombre del marco especial sobre formularios llamado MARCO_IMPRESION ha sido generalizado a PCO_MarcoImpresionXX  donde XX representa el ID del formulario que lo contiene.  De esa manera se pueden tener diferentes acciones de impresión cuando se tienen varios formularios anidados o sobre la misma página al tiempo.

* Added: Posibilidad de menues desplegables agrupadores de opciones a un nivel en cualquiera de las ubicaciones.
* Added: Tareas sobre tableros Kanban soportan ahora definición de porcentajes de avance particular.
* Added: Durante la selección de informes para inserción en formularios se permite la búsqueda por su ID o nombre, para falicitar los casos donde la cantidad de informes es numerosa.
* Added: Se permite saltar entre el diseño de un campo y el diseño general del formulario mediante un botón en la barra de herramientas inferior.
* Added: Posibilidad de agregar subtítulos como parámetros extra sobre la función de diálogos modales.
* Added: Generalizacion del nombre de marco de impresion de cada formulario a PCO_MarcoImpresionXX permitiendo múltiples marcos sobre una misma carga de página.
* Added: Durante el almacenamiento, actualizacion o eliminación de datos de formulario se permite definir variables y valores para redireccionar el flujo de la aplicacion bajo los siguientes nombres: PCO_PostAccion, PCO_NombreCampoTransporte1, PCO_ValorCampoTransporte1, PCO_NombreCampoTransporte2, PCO_ValorCampoTransporte2
* Added: Posibilidad de crear conexiones a motores NoSQL directamente desde la opción de Conexiones extra y replicación
* Added: Adicion de recortes de codigo propios de Practico Framework sobre el editor para facilitar la autocompletacion de código en variables y funciones propias.
* Added: Sistema de monitoreo para máquinas en modo compacto presenta ahora información extendida del monitor al pasar el ratón sobre la máquina.
* Enhan: Mejorada barra de navegación responsive para menu lateral.
* Enhan: Los contenedores de pestañas (tab-pane) en formularios son generados unicamente cuando se tiene más de una pestaña.  En los otros casos no es necesario.  Con eso se evita la creacion innecesaria de elementos con ID html PCO_PestanaFormulario_XX innecesarios.
* Enhan: Renombrado de funciones internas
* Enhan: Presentado el numero de elementos internos de cada formulario en la lista de formularios.
* Enhan: Generalizacion y optimizacion de funcion encargada de la impresion de opciones de menu.
* Enhan: Por defecto se deja oculta la barra de navegacion izquierda para mejorar la maquetacion responsive.  Se deja el boton para su despliegue manual cuando sea necesario.
* Enhan: Pestañas de etiqueta PCO_NoVisible presentes sólo en modo de diseño para desarrolladores de funciones internas.
* Enhan: Reduccion de código en administracion de menues
* Enhan: Actualizacion de plugin Bootstrap-select a version 1.12.4
* Enhan: Aumentada la velocidad de carga de aplicación durante la conversion de listas HTML a BootStrap
* Enhan: Reemplazo de funciones de informes por objetos internos
* Enhan: Actualizacion a PMyDB 18.7: Seleccion de idiomas en caliente, cambio de tema por defecto, copiado de hablas incluye ahora sus triggers, soporte elastic search, prohibicion de usar bases de datos sin clave, etc.
* Enhan: Optimizadas funciones de auditoria de usuarios.  Supresion de funciones y codigo obsoleto.
* Enhan: Para desarrolladores del framework se protege las carpetas de instalación automáticamente.
* Fixed: Edicion de URLS con interrogantes sobre IFrames en formularios
* Fixed: Buscador de permisos evita presentar informes de desarrollo del framework (negativos)

## Versión 18.7 (2018-07-01)
* Added: Ahora se advierte acerca de la existencia de campos con ID HTML duplicado o nombre de campo vinculado en base de datos duplicado durante el diseño de formularios.
* Added: Ahora se valida la existencia de campos huerfanos durante el diseño de formularios.  Esto evita que el programador olvide la existencia de posibles campos por fuera del esquema del formulario; pero sin privarlo de sus funcionalidades derivadas.
* Added: Posibilidad de establecer imagenes de fondo de aplicacion.
* Enhan: Las conexiones de bases de datos (SQL, NoSQL y replicaciones) presentan detalles de su nombre o identificador cuando su ejecución devuelve un error.  De esa manera se depura de manera se facilita la depuración sobre aplicaciones que utilizan múltiples motores.
* Enhan: Después de la creación de tablas se redirige al editor de la misma para que el programador agregue los campos que correspondan.
* Enhan: Ventanas de login ajustadas
* Enhan: Optimizado proceso de exportacion de elementos
* Enhan: Procesos de empaquetado son ahora automatizados para aquellos usuarios con modo de desarrollador interno activado.
* Enhan: Actualización del explorador de archivos (ver 2.1.39)
* Fixed: Cadenas faltantes en idioma francés.
* Fixed: Mensajes de error al crear tablas.  Eran falsos positivos, la operación de creación en realidad se ejecutaba sin problemas.
* Fixed: Scripts duplicados de SQL en tiempo de instalacion

## Versión 18.5 (2018-05-01)
* Added: Se permite seleccion del operador NOT LIKE durante las condiciones de informes.
* Added: Consultas avanzadas sobre los informes.  Se permite ingresar código específico para las consultas, aunque éstas no se beneficiarán de algunas propiedades de las definidas internamente por el Framework pero permitirá la generación de consultas SQL o llamados a procedimientos almacenados directamente.
* Added: Soporte para ejecucion de la aplicacion en fullscreen sobre iOS y Safari.
* Enhan: Actualizacion {P}Coder 18.6
* Enhan: Se protege la edicion de parametros basicos de configuracion para el motor.  Estos deberan ser tocados solo por archivo para hacer de manera más consciente esa tarea para los usuarios administradores avanzados que por error involuntario o de navegador podrían dejar inactiva la aplicación.
* Enhan: Reemplazo de archivos asociados a gestión de conexiones extra y replicación por funciones internas del Framework.
* Enhan: Reemplazo de funciones asociados a al sistema de monitoreo por funciones internas del Framework.
* Enhan: Valores de placeholder para campos de tipo texto soportan ahora reemplazo de variables en formato {PHP} para facilitar aplicaciones multi-idioma.
* Fixed: Usuarios que no han guardado configuraciones en su panel de admin despues de actualizar no pueden ver graficos del panel
* Fixed: Mejorada funcion callback de reemplazo de variables para versiones muy obsoletas de PHP que no soportan llamado recursivo. 
* Fixed: Supresion de las funciones de verificacion automatica de sintaxis en servidores windows, ya que estos no soportan el comando de PHP sobre el PATH general a menos que se especifique su path especifico.
* Fixed: Corrección a la librería de exploración de archivos para {P}Coder sobre servidores windows que no soportan una raiz establecida por defecto.

## Versión 18.3 (2018-03-29)
* LEAME: ADVERTENCIA:  Para quienes actualizan desde versiones previas con el fin de evitar colisiones y estandarizar la llamada a metodos y funciones internas, las siguientes funciones han cambiado de nombre:
  cargar_informe() cambia a PCO_CargarInforme()
  cargar_formulario() cambia a PCO_CargarFormulario()
  ejecutar_sql_unaria() cambia a PCO_EjecutarSQLUnaria()
  ejecutar_sql() cambia a PCO_EjecutarSQL()
  ejecutar_nosql() cambia a PCO_EjecutarNoSQL()
  ejecutar_sql_procedimiento() cambia a PCO_ProcedimientoSQL()
  auditar() cambia a PCO_Auditar()
  Se recomienda encarecidamente que si usted hace llamados manuales a este tipo de funciones primero haga un reemplazo de las mismas dentro de su codigo fuente para evitar conflictos. Lo cual podría llevar a cabo con un simple reemplazo de cadena en sus archivos (Ctrl+H en su {P}Coder).
  Este cambio se hace necesario ademas para preparar el framework para la adopcion organizada de Bootstrap4 en futuras versiones.  Desarrolladores que no hagan llamado a estas funciones en su código y que sólo utilicen funciones nativas no tienen que hacer ajuste alguno.  Las funciones de advertencia serán mantenidas sólo hasta la versión 18.9.
* Added: Ademas de las posbilidades de motores de autenticacion externos, OAuth y metodos similares disponibles para realizar el Login al framework, ahora se dispone de dos variables que al ser enviadas como parámetro permiten prediligenciar los campos de usuario y clave al momento de iniciar sesión.  Las variables son AUTO_uid y AUTO_clave
* Added: Las tareas sobre tableros Kanban ahora pueden ser arrastradas a los nombres de cada columna del tablero cuando desean moverse rápidamente.  Conservarán su peso, prioridad y demás propiedades aún cuando se vean al final en cada adición inicialmente.
* Added: La funcion de conteo de registros sobre tablas ContarRegistros($tabla,$condicion) ahora puede recibir un segundo parametro opcional llamado $condicion que indica el filtro de registros que se deberia tener en cuenta a la hora de realizar el conteo.  Si no se recibe una condicion la funcion seguirá retornando la totalidad de registros sobre la tabla.
* Added: Las pestañas de formularios de datos soportan ahora uso de variables en notación {PHP} para generar títulos dinámicamente, por ejemplo en aplicaciones multi-idioma.
* Added: Los mensajes de retorno programados en botones de comando sobre formularios de datos soportan ahora variables en notacion {PHP} como soporte a aplicaciones multi-idioma.
* Added: Ahora los valores predeterminados en campos de texto permiten varias variables bajo notación {PHP} y también textos mezclados con éstas.  Por compatibilidad hacia atrás se conservan aquellas notaciones con un sólo signo de pesos al comienzo del valor. 
* Added: La configuración de proveedores OAuth permite especificar la manera en que éstos serán presentados al usuario durante el login.
* Added: Soporte para el uso de variables en notacion {PHP} para soportar traducciones automaticas y mensajes de validacion de formularios sobre campos obligatorios.
* Added: Sistema básico para el reporte y trazabilidad de errores incluyendo trazas y capturas de pantalla del usuario.  El desarrollador podrá gestionar y el usuario revisar detalles de gestión.
* Added: Campos tipo etiqueta pueden definir ahora el ID HTML que los contiene en caso que luega deban ser manipulados en el DOM mediante JS.
* Added: Campos de tipo texto libre permiten el reemplazo automatico de variables en notación {PHP} sobre sus valores predeterminados
* Added: La impresion de valores de campos en formato de etiqueta es capaz de identificar si el contenido es una imagen bajo formatos data:image y la agrega como tal a la salida del formulario. 
* Added: Mejorado el modulo de auditorias, ahora permite obtener movimientos filtrados e indicadores de movimientos por día, movimientos por usuarios y horas pico del sistema.
* Enhan: Actualización de PMyDB 17.2 a 17.9
* Enhan: Indicadores numéricos sobre el menu de configuración no son usados como numeración, ahora indican la cantidad real de elementos dentro del item. 
* Enhan: Se protegen funciones adicionales para las instalaciones en modo de demostracion y se agregan mensajes aclaratorios. Se incluye Pcoder, PMyDB y Explorador de archivos.
* Enhan: Las listas de seleccion en sus campos de opciones (visuales) permiten realizar operaciones SQL.  De ahora en adelante el nombre de la tabla para consulta será tomado exclusivamente del campo de lista de valores (que se supone es el mismo origen de lista de opciones para todas las versiones previas). 
* Enhan: Los botones de informes ahora transportan el valor de la variable correspondiente a la primera columna del informe cuando la acción de botón consisten en llamar a otro informe.  Esto es útil para realizar informes que requieren como insumo la selección de algún valor previo desde otro informe.
* Enhan: Mejorada la precision y tiempos de caducidad para monitores tipo cURL.
* Enhan: Mejorada la diagramación del panel de configuración para proveedores OAuth.  Optimización de código.
* Enhan: Mejoras a ventana de login, distribución de elementos y opciones OAuth.
* Enhan: Limpieza automatica de la barra de direccion del navegador despues de cada carga.
* Enhan: Actualizada librería de HTML2Canvas de 0.5 a 1.0
* Enhan: Aquellos campos con nombre manual sobre un formulario y no pertenecientes a la tabla asociada al formulario tomarán valores por defecto definidos para éstos en lugar de quedar en blanco ante la carga de un registro sobre el formulario.
* Enhan: Por seguridad el panel de configuración de la herramienta no permite el cambio de motor directamente ya que puede ocasionar pérdida de control del sistema.  Quien desee migrar entre motores de bases de datos de diferente tipo deberá ajustar su valor manualmente sobre configuracion.php para hacerlo así de manera consciente.
* Enhan: Optimizado codigo en panel de administración.  Se generaliza función para dejarla disponible del lado de los desarrolladores como PCO_ImprimirPanelSimpleDashboard();
* Enhan: Accion interna ver_seguimiento_monitoreo ha sido cambiada a PCO_PanelAuditoriaMovimientos
* Enhan: Centralizados los formularios comunes sobre un único archivo.
* Enhan: Eliminados formularios innecesarios de acceso a opciones internas.
* Enhan: Mejorado codigo de segmentacion de SQL en funciones de instalación, actualización y guiones para pruebas de bases de datos en TravisCI.
* Enhan: Agregadas etiquetas de ancho y alto durante la edición de elementos de formularios para facilitar su identificación.
* Enhan: Mejorada la velocidad de carga en algunos componentes.
* Fixed: Procesos de importacion de tablas consideran los valores entregados por los parametros de complementa a condiciones de filtrado correctamente.
* Fixed: Validaciones de ejecucion sobre webservices.  Si los WS previos han sido creados bajo los estandares y requerimientos de operacion no se deberian tener problemas durante migraciones.  Se recomienda verificar que los llamados a WS previos se encuentren correctamente parametrizados.
* Fixed: Retirados de la creacion y edicion de menues y los formularios los elementos internos de Práctico (Forms e informes) que no son necesarios para el usuario estándar.
* Fixed: Botones de busqueda automaticos sobre campos de texto y listas de seleccion operan sin problema sobre formularios donde se ha personalizado su nombre.
* Fixed: Texto de advertencia en lanzamiento de PMyDB
* Fixed: Opción de Mis Informes presenta ahora solamente los informes con acceso para el usuario, incluyendo cuando se tiene o no activado el modo de desarrollo del Framework.
* Fixed: Limpieza de sesion despues de un primer intento de usuario, clave o captcha inválido.  Al siguiente intento correcto pasará sin problemas la autenticación.
* Fixed: Sistema de chat valida primero por sesión activa para evitar error 500 al tratar de buscar mensajes sin usuario definido.
* Fixed: Script de instalación para SQLite3
* Fixed: Ajuste menor a librería PCoder para normalización de saltos de línea sobre servidores unix-like y la inetrpretación de guiones por BASH.

## Versión 18.2 (2017-12-22)
* Added: Ahora las conexiones principal, extra o de replicación presentan información adicional de depuración cuando su configuración es incorrecta o no se logra hacer conexión al servidor.
* Added: Ahora los elementos de monitoreo de tipo base de datos y rango de valores permiten especificar la conexión sobre la cuál realizan sus consultas.
* Added: Ahora los monitores de tipo rango pueden ser presentados de manera alterna bajo el esquema de máquinas.
* Added: Lo monitores permiten ahora ser visualizados en modo compacto.
* Added: Los monitores de tipo máquina respetan ahora el ancho indicado por su parametrización. Valor recomendado inicial: 2
* Added: Agregado el soporte para convertir automaticamente las aplicaciones a Aplicaciones Web Progresivas (WPA) desde el panel de configuracion!!!
* Added: Agregado soporte para -Add to Home- en Safari sobre iOS
* Added: Los informes embebidos presentan subtotales cuando se encuentran en formato datatable y además se han configurado columnas de subtotales para estos.
* Added: En modo diseño de formularios se presenta el titulo de los elementos embebidos (informes o formularios) sobre su botón de edición.
* Added: La lista de informes presenta clasificado el tipo de informe como tabla o gráfico para facilitar su identificación
* Added: La edición general de campos para un formulario presenta el título en los elementos embebidos.
* Added: Durante la edición de eventos ahora se presenta el ID HTML del objeto asociado.
* Added: Se permite exportacion masiva de elementos tipo informe o formulario mediante la especificación de rangos de ID.
* Added: Ahora se permite la traduccion de textos en placeholders a partir de variables bajo notacion { $Variable} en PHP
* Added: Ahora se permite la traduccion de textos en tooltips a partir de variables bajo notacion { $Variable} en PHP
* Added: Nuevos métodos de verificación para monitores tipo máquina basados en cURL (a diferentes timeout) funcionan extremadamente rapido en circunstancias donde los tipos Socket y Ping presentan lentitud y cuando se desea chequear el estado de URLs especificas.
* Added: Agregadas funciones para verificacion del estado de un host o URL mediante GetHeaders y GetHostByName. Complemento de la funcion interna ServicioOnline() aun en modo experimental.
* Added: Tablero kanban: permite archivar tareas cuando estas se encuentran en la ultima columna definida de manera que pasen a un historico aquellas realizadas y mantengan despejado el tablero.
* Added: Tablero kanban: multiples tableros!. Ahora cada usuario con acceso al kanban puede crear tantos tableros como desee. Solo se permite eliminar tableros completos al propietario del mismo.
* Added: Tablero kanban: Se agrega Posibilidad de compartir con otros usuarios su tablero Kanban. Por ahora, la lista de usuarios es manual y debe estar cada usuario encerrado por barras de canalizacion (pipes)
* Added: Usuarios estandar del sistema pueden usar tableros Kanban propios. Para esto simplemente se debe agregar un acceso a la accion interna ExplorarTablerosKanban para sus usuarios
* Enhan: Sensores de rango con valores iguales en máximos y mínimos presentan ahora una dona sin divisiones y su resultado.
* Enhan: Mejorada interfaz en paneles de configuración.
* Enhan: Optimizada la forma en que se generan copias de formularios e informes para independizar procesos masivos
* Enhan: La version de aplicacion en los titulos de ventana es tomada ahora desde la configuracion de la aplicacion.
* Enhan: Se retira el nombre de la aplicación de todos los títulos de informes.
* Enhan: Durante los procesos de exportación de elementos en linea se permite ahora saltar a la edición del elemento recién creado directamente.
* Enhan: Ahora algunos listados y formularios internos del propio framework son presentados mediante elementos creados sobre el mismo Práctico, disminuyendo la cantidad de líneas de código y optimizando su ejecución. Dichos elementos tendrán identificadores negativos dentro de las tablas de aplicación.
* Enhan: Se dispone de nueva arquitectura que permitira generar funcionalidades de desarrolladores de Practico dentro del mismo framework. Como complemento el entorno importa de manera automatica cualquier definicion XML de objetos, formularios o informes ubicada sobre la carpeta /xml de la instalacion.
* Fixed: Clonacion de formularios desde XML ignoraba los eventos.
* Fixed: Los objetos de monitoreo en rangos actualizan correctamente sus valores mínimo y máximo esperados.
* Fixed: La resolucion maxima del logo en pantallas de login ahora no supera los bordes de pantalla, se ajusta automaticamente segun el dispositivo y no supera su resolucion predeterminada en dispositivos de pantalla grande.
* Fixed: Los sistemas de monitoreo sobre conexiones seguras ahora redirigen correctamente las alertas auditivas.

## Versión 18.1 (2017-10-22)
* Added: Ahora los controles de formulario presentan informacion básica resumida en modo de diseño sobre tooltip asociado al íncono de información.
* Added: Los controles embebidos en formularios del tipo informe o formulario de consulta permiten ahora saltar a la edición de éstos directamente desde la edición de su formulario padre mediante un botón en la barra de herramientas del control.
* Added: Ahora los gráficos de Dona interpretan y agregan los valores pre y pos ingresados para las donas.
* Added: Los controles de datos de tipo lista de seleccion ahora permiten establecer dentro de sus propiedades si el control inicia o no como solo lectura
* Added: Ahora la pantalla de acceso puede ser configurada para utilizar captchas visuales, facilitando su uso en dispositivos moviles. 
* Added: Los campos de tipo archivo adjunto sobre formularios ahora soportan las propiedades de Visible y Obligatorio.
* Added: La personalización de logos en el encabezado y al momento de login puede ser realizada directamente por el panel de configuración.
* Added: Los formularios permiten ahora especificar cuál será el nombre o id de HTML asignado al mismo.  De esa manera varios formularios pueden convivir en el mismo momento en pantalla manteniendo sus acciones separadas.
* Added: Ahora los nombres de tabla en informes pueden soportar variables PHP en notacion {$Variable} lo que permite flexibilidad en construcción de consultas dinámicas desde variables del sistema o definidas por el usuario.
* Added: Los botones de comando en informes permiten ahora establecer su etiqueta como una imágen y también el texto agregando la palabra especial _TEXTOIZQ_ _TEXTODER_ al campo de imagen donde dependiendo de la ubicacion de la palabra clave se mostrará el texto sobre el botón (Izquierda o derecha).
* Added: Etiquetas de botones en acciones de informes y sus textos de confirmacion soportan ahora variables PHP en notacion {$Variable}
* Added: Los correos de autoregistro enviados por el sistema ahora contienen un enlace para facilitar el acceso al mismo sin que el usuario deba redigitar los datos.
* Added: Las columnas de informes permiten especificar títulos arbitrarios y no derivados de la consulta al motor de bases de datos.  Esto permite incluso agregar formatos HTML, imágenes, etc. a los títulos de columna.  Adicionalmente, este tipo de títulos soportan traducción y variables PHP en notacion {$Variable} para aplicaciones multi-idioma.
* Added: Ahora los informes permiten especificar conexiones y orígenes de datos alternos.  Ideal cuando se desean crear paneles unificados, informes y demás operaciones desde diferentes orígenes de datos, servidores o motores de bases de datos diferentes al predeterminado del framework.  Tenga en cuenta que cuando se utilizan motores externos se pueden tener tiempos de respuesta aumentados según su velocidad de conexión entre el sistema donde reside práctico y el origen de datos externo.
* Added: Nunca antes el seguimiento al uso de sus aplicaciones fue tan simple.  Ahora el faro rastreador de Google Analytics envía además del uso de su aplicación la ubicación accedida y de esa manera podrá tener múltiples aplicaciones rastreadas a la vez con un solo código de GoogleAnalytics.  Para esto y el seguimiento que cada desarrollador puede hacer al uso de su aplicación a través de Analytics se dispuso la estructura de URL así: /Practico/[SuDominio]/ACT/[SuAccion]/SCR/[SuScript]
* Added: Agregado archivo inicial de soporte para idioma francés.
* Added: Los controles de formulario permiten establecer una clase CSS personalizada o de bootstrap para sus contenedores.  Esto permite generar nuevos diseños enriquecidos de interfaz y maquetaciones sobre cada formulario.  Aquellos que presenten comportamientos de autoredimensionado de controles en fila unica pueden agregar la clase table-responsive para obtener compatibilidad hacia atrás.  Esto permite además redefinir y personalizar la maquetación completa de un formulario por columnas o cualquier otro estilo dado por la clase dinámicamente.  Ej:  col col-xs-4 col-md-4 col-sm-4
* Enhan: Eliminados parámetros de ancho y alto de informes durante su diseño pues ahora se aplican sólo diseños responsive.
* Enhan: Actualizada version de JavaScript Vector Library Raphael 2.1.2 a 2.2.1  
* Enhan: Actualizada version de Morris Library v0.5.0 a v0.5.1
* Enhan: La funcion PCOJS_ValidarCamposYProcesarFormulario ha cambiado para ofrecer otros escenarios con más posibilidades como formularios cohexistiendo en la misma página con diferentes acciones.  Ahora se deben enviar los parámetros de nombre del formulario (id html) y si se desea o no anular su envío cuando se hagan llamados manuales a esta función a través del código.  Programadores que deseen mantener compatibilidad hacia atrás con llamados manuales podrán cambiar su llamado de función a este formato PCOJS_ValidarCamposYProcesarFormulario(FormularioProcesar,AnularSubmit)
* Enhan: Se simplifica el proceso de instalacion solicitando menos valores en configuracion que posteriormente serán configurados por el panel de aplicación.
* Enhan: El envio de correos ahora se hace utilizando como reply la direccion del host o nombre de servidor que hospeda la aplicacion. 
* Enhan: Optimizacion en funciones de importacion de informes y formularios desde especificaciones XML.  Funciones independientes pueden realizar ahora el trabajo de manera autonoma y sin verificaciones de versionamiento: PCO_ImportarXMLInforme($xml_importado), PCO_ImportarXMLFormulario($xml_importado)
* Enhan: Algunos mensajes de excepción de errores de ejecución de sentencias SQL presentan el archivo y la línea aproximada donde ocurren. 
* Fixed: Alineación vertical del botón de edicion en la barra de herramientas de controles de formularios.
* Fixed: Clonacion de formularios e informes considera ahora los pesos y los id de los elementos a la hora de generar los nuevos objetos de manera que se conserve el orden de los mismos en el nuevo elemento.
* Fixed: Se elimina retorno de valor para la función de validación de campos en el envío de formularios para evitar problemas de compatibilidad con Firefox.  Reportado por @rafaelposadaf
* Fixed: Ahora los datatables respetan las posibles cláusulas ORDER BY incluidas en los Queries de los informes al evitar su ordenamiento inicial automáticamente.
* Fixed: Procesos de actualización automática de valores sobre registros contemplan ahora escapar las cadenas correctamente para evitar caracteres especiales, interrogantes y similares.
* Fixed: Eliminados parámetros innecesarios durante llamado a función de creación de botones de comando.

## Versión 17.9 (2017-09-02)
* Enhan:  Informes en modo de diseño presentan el ID en la parte superior por comodidad de Rafagol.
* Added:  Información resumida de las tareas en el tablero de Kanban sobre el dashboard del admin. 
* Enhan:  Los usuarios definidos como plantilla son ahora restringidos para hacer login al sistema.  Así se mantiene la integridad de permisos sobre los mismos.
* Added:  Se agrega botón de acceso directo para edición de los formularios en usuarios diseñadores de aplicación o administradores.
* Added:  Ahora los botones de edición de eventos sobre controles presentan un resúmen de los tipos de evento asociados al control actualmente.
* Added:  Se agrega botón de acceso directo para edición de los informes en usuarios diseñadores de aplicación o administradores.
* Added:  La generacion de eventos para controles de formulario incluye ahora un encabezado con plantillas de documentacion en notación NaturalDocs.
* Added:  Ahora las pestanas de formulario con etiqueta PCO_NoVisible no seran presentadas a usuarios estandar.  Solamente apareceran a los diseñadores de aplicacion.
* Added:  Se han unificado los campos de etiqueta de informes gráficos a sólo el campo de etiqueta para el eje X asignado por la primer serie de gráfico cuando se manejen múltiples series.
* Enhan:  **ATENCION!!** Librería Practico Libchart ha sido reemplazada.  Ahora todos los gráficos del sistema son generados mediante librerías Morris y Raphael dando mayor interactividad y mejorando notablemente la presentación.  Los gráficos anteriores deberían conservar su compatibilidad, sin embargo tenga en cuenta que esto puede cambiar la apariencia de su aplicación por lo que se recomienda que verifique la operatividad de sus informes de tipo gráfico pues ya se ajustan además al tamaño de su contenedor.
* Added:  Compatibilidad de gráficos y transparencias para diferentes temas de aplicación.
* Enhan:  Mejorado el asistente para generación de informes gráficos.  Se agrega además la posibilidad de personalizar la apariencia de algunas partes del gráfico generado.
* Enhan:  Se amplían los tipos de gráfico (algunos apilables) a Dona, Linea, Áreas y Barras.
* Fixed:  Boton de ocultamiento de opciones sobre controles de formulario devuelve un [object Object] en navegadores Firefox y derivados.  Se convierten a función los métodos asociados.
* Enhan:  Suprimirdas las librerías asociadas a Practico-Libchart. Ahorro de 392Kb por cada cargue.

## Versión 17.8 (2017-08-02)
* Added: Tema gráfico basado en Material Design de Google 0.5.10 para Bootstrap
* Added: Marco de advertencia para aquellos usuarios que no se encuentren con JavaScript habilitado en sus navegadores 
* Added: Los siguientes elementos soportan ahora variables en notación {$PHP} para facilitar el diseño de aplicaciones multi-idioma: botones en la barra de acciones de formulario, titulos de formulario, titulos de informes, titulos y textos de ayuda en formularios, descripción de informes, todos los titulos y textos de ayuda para controles de formulario, textos de confirmación en botones de comando, textos de confirmación sobre botones de acción en informes.
* Added: Tema gráfico Amelia.
* Fixed: Corrección en aplicación de estilos gráficos para fondos de aplicación.
* Enhan: Al hacer clic sobre el icono home de la barra superior se limpia cualquier contenido de la URL redireccionando al index.php
* Added: Nueva opcion de validacion de numeros sin punto decimal para controles de formulario
* Added: Los controles con validaciones soportan ahora cadenas con caracteres extra permitidos para el ingreso de datos.
* Enhan: A partir de ahora campos validados como solo letras no contendran el caracter punto.  Si se desea tener el caracter punto dentro del set permitido se deberá agregar a la personalización del control sobre los caracteres extra permitidos.
* Enhan: Mejoradas algunas ayudas y tooltips del sistema.
* Fixed: Agregado el parametro PCOJS_Evento por defecto a todos los eventos JS generados.
* Added: Validacion de entrada para campos de texto largo (textareas).
* Added: Nuevo módulo para manejo de tableros Kanban con el fin de apoyar procesos de desarrollo implicitos de la herramienta y las aplicaciones de cada usuario.
* Enhan: Ahora la funcion existente de validacion de campos en formularios permite anular el envío del formulario mediante un parámetro extra que anula esa funcionalidad.  Util si se desea interceptar la operación o realizar validaciones de manera independiente.
* Added: Durante la creación de informes se puede establecer ahora el tamaño de página predeterminado (cuántos registros presentar por página).
* Added: Los botones de acción para registros en informes ahora permiten llamar a otros informes por su ID.
* Added: Ahora se puede especificar cáculos de suma automáticos para alguna columna de los reportes que soportan datatables y presentarlos como resúmen al final de cada uno tanto por página como por total general.
* Fixed: Acceso a mod/pcoder es ahora restringido para usuarios que no son tipo administrador o diseñador de aplicación.

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
* Added: Agregados botones para edicion rápida de eventos en controles que tengan alguno creado.

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