##Funcionalidades por implementar


- [ ] Validar codificación de caracteres sobre fuentes y BBDD
* Prioridad: Baja
* Descripción: Enlace de referencia: http://www.pedroventura.com/php/problemas-codificacion-web-configurar-codificacion-utf8-php-mysql-y-html/
* Estimado: 15 de agosto de 2013 

- [ ] Agregar funcion que permite activar en caliente con JS las celdas de un informe.  Generalizar la existente.
* Prioridad: Baja
* Descripción:
	function ActivarInline()
		{
			//TablaInforme_3
			//Activa el editor en linea para la tabla cuando se hace clic en una celda
			$('#TablaInforme_3').on( 'click', 'tbody td:not(:first-child)', function (e) {
				editor.inline( this );
			} );
		}
* Estimado: Julio 2016



- [ ] Personalizar la App desplegada en AppEngine para el rastreo del uso de la aplicación
* Prioridad: Media
* Descripción: Permitir que cada desarrollador pueda direccionar a una aplicación de rastreo propia sobre AppEngine de Google las solicitudes de la herramienta
* Estimado: 5 de mayo de 2016

- [ ] Permitir nombre del admin personalizable
* Prioridad: Media
* Descripción: Durante el proceso de instalación, permitir seleccionar o establecer el nombre del usuario admin (o desde panel de configuración)
* Estimado: 2 de julio de 2013

- [ ] Actualización automática de informes
* Prioridad: Baja
* Descripción: Permitir la actualización cada cierto tiempo para los informes generados de manera que puedan servir como paneles de monitoreo en tiempo real
* Estimado: 8 de agosto de 2013

- [ ] Multi-tenancy
* Prioridad: Media
* Descripción: Soporte a múltiples bases de datos y multitenancy.  Tener definición de cluster de servidores separados del configuracion.php y permitir su escogencia cuando es mas de uno durante el login o en barra superior en escritorio
* Estimado: 4 de diciembre de 2013

- [ ] Informes con filtro por campo
* Prioridad: Media
* Descripción: Permitir agregar condición de filtrado a informes con el fin de vincular subinformes a formularios.
* Estimado: 31 de octubre de 2013

- [ ] Personalizar informes PDF
* Prioridad: Media
* Descripción: Permitir agregar imágenes, encabezados y pies de pagina para informes en formato PDF
* Estimado: 31 de octubre de 2013

- [ ] Sistema de caché
* Prioridad: Baja
* Descripción: Implementar un sistema de caché interno que sirva páginas más rápido para sistemas con alto tráfico.  Revisar https://github.com/ecoal95/php-cache/
* Estimado: 3 de enero de 2014

- [ ] Fórmula para campos
* Prioridad: Baja
* Descripción: Posibilidad de incluir una fórmula que calcule el valor del campo en función de otros (usando javascript)
* Estimado: 20 de febrero de 2014

- [ ] Editor de plantillas
* Prioridad: Baja
* Descripción: Permitir el cambio de los CSS desde la herramienta
* Estimado: XXXXXXXXX

- [ ] Benchmark
* Prioridad: Baja
* Descripción: Aunque los tiempos iniciales son mas bájos que los demás, se debe hacer un benchmark oficial.  Voluntarios para algo como http://www.techempower.com/benchmarks/
* Estimado: 21 de marzo de 2014

- [ ] Exportación de objetos
* Prioridad: Baja
* Descripción: Permitir exportar los botones de un formulario para ser agregados a otro
* Estimado: 

- [ ] Set de iconos nuevo
* Prioridad: Baja
* Descripción: https://design.google.com/icons/ - http://google.github.io/material-design-icons/
* Estimado: 

