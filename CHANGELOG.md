```
 _                      _                            _     _           
| |    ___   __ _    __| | ___    ___ __ _ _ __ ___ | |__ (_) ___  ___ 
| |   / _ \ / _` |  / _` |/ _ \  / __/ _` | '_ ` _ \| '_ \| |/ _ \/ __|
| |__| (_) | (_| | | (_| |  __/ | (_| (_| | | | | | | |_) | | (_) \__ \
|_____\___/ \__, |  \__,_|\___|  \___\__,_|_| |_| |_|_.__/|_|\___/|___/
            |___/ 
```

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
