function ver_navegacion_izquierda_flotante()
    {
        document.getElementById("barra_navegacion_izquierda").style.visibility="visible";
    }
function ver_navegacion_izquierda_responsive()
    {
        document.getElementById("barra_navegacion_izquierda").style.visibility="visible";
        document.getElementById("page-wrapper").style.margin="0 0 0 250px";
    }
function ocultar_navegacion_izquierda()
    {
        document.getElementById("barra_navegacion_izquierda").style.visibility="hidden";
        document.getElementById("page-wrapper").style.margin="0 0 0 0px";
    }
function barra_navegacion_izquierda_toggle(modo)
    {
        if(document.getElementById("barra_navegacion_izquierda").style.visibility!="visible")
            {
                if (modo!="flotante")
                    ver_navegacion_izquierda_responsive();
                else
                    ver_navegacion_izquierda_flotante();
            }
        else
            ocultar_navegacion_izquierda();
    }
function PCOJS_OcultarBarraFlotanteIzquierda()
    {
        $( "#wrapper" ).removeClass( "toggled" );
    }
function PCOJS_VerBarraFlotanteIzquierda()
    {
        $( "#wrapper" ).addClass( "toggled" );
    }
function PCOJS_AlternarBarraFlotanteIzquierda()
    {
        $( "#wrapper" ).toggleClass( "toggled" );
        //javascript:$("#menu-toggle")[0].click();
    }

function PCOJS_ValidarTeclado(elEvento, permitidos, permitidos_extra)
	{
		// Variables que definen los caracteres permitidos
		var numeros = "0123456789." + permitidos_extra;
		var numeros_enteros = "0123456789" + permitidos_extra;
		var caracteres = " abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ" + permitidos_extra;
		var numeros_caracteres = numeros_enteros + caracteres;
		var teclas_especiales = [8, 9, 13, 33, 34, 35, 36, 37, 38, 39, 40, 45, 46];
        //Fuente 1: https://www.cambiaresearch.com/articles/15/javascript-char-codes-key-codes
        //Fuente 2: https://www.w3schools.com/jsref/tryit.asp?filename=tryjsref_event_key_keycode

		// Seleccionar los caracteres a partir del parámetro de la función 
		switch(permitidos)
			{
				case 'numerico':
					permitidos = numeros;
					break;
				case 'numerico_entero':
					permitidos = numeros_enteros;
					break;
				case 'alfabetico':
					permitidos = caracteres;
					break;
				case 'alfanumerico':
					permitidos = numeros_caracteres;
					break;
				case 'personalizado':
					permitidos = permitidos_extra;
					break;
			}

		// Obtener la tecla pulsada
		var evento = elEvento || window.event;
		var codigoCaracter = "";
		if (permitidos == numeros ||  permitidos == numeros_enteros)
		    codigoCaracter = evento.which || evento.charCode;
		else
		    codigoCaracter = evento.charCode || evento.keyCode;
		
		var caracter = String.fromCharCode(codigoCaracter);

		// Comprobar si la tecla pulsada es alguna de las teclas especiales
		var tecla_especial = false;
		for(var i in teclas_especiales)
			{    
				if(codigoCaracter == teclas_especiales[i])
					{
						//Saber si es un punto (caracter comun con la tecla especial DELETE o SUPR en algunas distribuciones de teclado)
						if (caracter==="." && permitidos==numeros_enteros)
						    tecla_especial = false;
						else
						    tecla_especial = true;
						break;
					}
			}
		return permitidos.indexOf(caracter) != -1 || tecla_especial;
	}

function PCO_ObtenerContenidoAjax(PCO_ASINCRONICO,PCO_URL,PCO_PARAMETROS)
    {
        var xmlhttp;
        var contenido_recibido="";
        if (window.XMLHttpRequest)
            {   // codigo for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
        else
            {   // codigo for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

        //funcion que se llama cada vez que cambia la propiedad readyState
        xmlhttp.onreadystatechange=function()
            {
                //readyState 4: peticion finalizada y respuesta lista
                //status 200: OK
                if (xmlhttp.readyState===4 && xmlhttp.status===200)
                    {
                        contenido_recibido=xmlhttp.responseText;
                        contenido_recibido = contenido_recibido.trim();
                        //Cuando es asincronico devuelve la respuesta cuando este lista
                        if(PCO_ASINCRONICO==1)
                            return contenido_recibido;
                    }
            };

        /* open(metodo, url, asincronico)
        * metodo: post o get
        * url: localizacion del archivo en el servidor
        * asincronico: comunicacion asincronica true o false.*/
        if(PCO_ASINCRONICO==1)
            xmlhttp.open("POST",PCO_URL,true);
        else
            xmlhttp.open("POST",PCO_URL,false);

        //establece el header para la respuesta
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

        //enviamos las variables al archivo get_combo2.php
        //xmlhttp.send();
        xmlhttp.send(PCO_PARAMETROS);
        
        //Cuando la solicitud es asincronica devuelve el resultado al momento de llamado
        if(PCO_ASINCRONICO==0)
            return contenido_recibido;
    }

function PCOJS_StrReplace(busca_por, reemplaza_por, cadena_original)
    {
    	str 	= new String(cadena_original);
    	rExp	= "/"+busca_por+"/g";
    	rExp	= eval(rExp);
    	newS	= String(reemplaza_por);
    	str = new String(str.replace(rExp, newS));
    	return str;
    }


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCOJS_MostrarMensaje
	Presenta un mensaje emergente en pantalla utilizando JavaScript y un marco preconstruido para tal fin
	
	Variables de entrada:

		TituloPopUp - El titulo del mensaje
		Mensaje - El mensaje completo que sera desplegado en el modal, puede incluir HTML.
		ClasesAdicionales - Por defecto la funcion retira cualquier clase previa, asigna por defecto las clases modal fade oculto_impresion y luego agrega cualquier otra clase personalizada definida por esta cadena, puede incluir varias clases separadas por espacios.

	Salida:
		Dialogo modal visualizado en la patanlla del usuario
*/
function PCOJS_MostrarMensaje(TituloPopUp, Mensaje, ClasesAdicionales)
	{
		//Lleva los valores a cada parte del dialogo modal
		$('#PCO_Modal_MensajeTitulo').html(TituloPopUp);
		$('#PCO_Modal_MensajeCuerpo').html(Mensaje);

        //Retira cualquier clase preexistente o remanente de cualquier personalizacion previa y agrega las clases base
        $("#PCO_Modal_Mensaje").removeClass();
        $( "#PCO_Modal_Mensaje" ).addClass( "modal" );
        $( "#PCO_Modal_Mensaje" ).addClass( "fade" );
        $( "#PCO_Modal_Mensaje" ).addClass( "oculto_impresion" );

        //Agrega las clases personalizadas por el usuario
        if (ClasesAdicionales!="")
            $( "#PCO_Modal_Mensaje" ).addClass( ClasesAdicionales );

		// Se muestra el cuadro modal
		$('#PCO_Modal_Mensaje').modal('show');

		//Hacer que la ventana este siempre por encima
		$("#PCO_Modal_Mensaje").css("z-index", "1500");
	}

function PCOJS_EstablecerPorcentajeProgreso(Porcentaje)
	{
		$('#PCO_Modal_MensajeCargandoPorcentaje').css('width', Porcentaje+'%').attr('aria-valuenow', Porcentaje);
	}

function PCOJS_OcultarMensajeCargando()
	{
		// Se oculta el cuadro modal
		$('#PCO_Modal_MensajeCargando').modal('hide');
		$('#PCO_Modal_MensajeCargando').hide();
	}

function PCOJS_OcultarVentanaChat()
	{
		// Se oculta el cuadro modal
		$('#Dialogo_Chat').modal('hide');
		$('#Dialogo_Chat').hide();
	}

function PCOJS_MostrarMensajeCargando(TituloPopUp, Mensaje, PermitirCierre, Progreso)
	{
		//Lleva los valores a cada parte del dialogo modal
		$('#PCO_Modal_MensajeCargandoTitulo').html(TituloPopUp);
		$('#PCO_Modal_MensajeCargandoCuerpo').html(Mensaje);
		
		//Si no se habilita el cierre del cuadro oculta el boton
		if (PermitirCierre!=1)
			$('#PCO_Modal_MensajeCargandoBotonCerrar').hide();
			
		//Si se tiene un valor para la barra de progreso la muestra. Si es negativo la oculta
		if (Progreso>=0)
			{
				PCOJS_EstablecerPorcentajeProgreso(Progreso);
			}
		else
			{
				$('#PCO_Modal_MensajeCargandoBarra').hide();
				$('#PCO_Modal_MensajeCargandoPorcentaje').hide();
				$('#PCO_Modal_MensajeCargandoPorcentaje').attr('aria-hidden', 'true').hide();
			}

		// Se muestra el cuadro modal
		$('#PCO_Modal_MensajeCargando').modal('show');

		//Hacer que la ventana este siempre por encima
		$("#PCO_Modal_MensajeCargando").css("z-index", "1500");
	}

function PCOJS_MostrarMensajeCargandoSimple(MiliSegundos)
	{
		// Se muestra el cuadro modal
		$('#PCO_Modal_MensajeCargandoSimple').modal('show');

		//Hacer que la ventana este siempre por encima
		$("#PCO_Modal_MensajeCargandoSimple").css("z-index", "1500");
		
		//Si recibe un valor de segundos diferente de cero entonces programa el cierre automatico
		if (MiliSegundos!=0)
			setTimeout(function(){PCOJS_OcultarMensajeCargandoSimple()},MiliSegundos);
	}

function PCOJS_OcultarMensajeCargandoSimple()
	{
		// Se oculta el cuadro modal
		$('#PCO_Modal_MensajeCargandoSimple').modal('hide');
		$('#PCO_Modal_MensajeCargandoSimple').hide();
	}

function PCOJS_ActualizarComboBox(ObjetoListaOpciones)
    {
		//Actualiza el listpicker y sus opciones identificado por el nombre del campo o id
		var PCO_NombreCombo=".combo-" + ObjetoListaOpciones;
		$(PCO_NombreCombo).selectpicker("refresh");
    }

function PCOJS_LimpiarComboBox(ObjetoListaOpciones)
    {
		//Limpia una lista de seleccion determinada por su propiedad de ID
        document.getElementById(ObjetoListaOpciones).options.length=0;
        //Despues de limpiar un combo obliga a su actualizacion visual
        PCOJS_ActualizarComboBox(ObjetoListaOpciones);
    }

function PCOJS_AgregarOpcionComboBox(ObjetoListaOpciones,ValorOpcion,EtiquetaOpcion)
    {
		//Determina el ID del objeto para realizar la operacion
		var IDObjetoListaOpciones = document.getElementById(ObjetoListaOpciones);
		//Agrega el elemento
		var PCOEtiqueta_option = document.createElement("option");
		PCOEtiqueta_option.value = ValorOpcion;
		PCOEtiqueta_option.text = EtiquetaOpcion;
		IDObjetoListaOpciones.add(PCOEtiqueta_option);
    }

function PCOJS_OpcionesCombo_DesdeCSV(ObjetoListaOpciones,Cadena,SeparadorLineas)
    {
		//Toma los valores contenidos en una cadena y los convierte en opciones de combo
		var ContadorOpciones;
		ArregloOpciones = Cadena.split(SeparadorLineas);
        for (ContadorOpciones in ArregloOpciones) 
			PCOJS_AgregarOpcionComboBox(ObjetoListaOpciones,ArregloOpciones[ContadorOpciones],ArregloOpciones[ContadorOpciones]);
        //Obliga a una actualizacion de la lista despues de agregar todos los elementos
        PCOJS_ActualizarComboBox(ObjetoListaOpciones);
    }


//######################################################################
// Objeto PCO global para Practico    ##################################
	var PCOJS = {};  

	// Propiedades /////////////////////////////////////////////////////
	PCOJS.Geolocalizacion = '';

	// Metodos /////////////////////////////////////////////////////////
	PCOJS.GeoLocalizar_Exito  = function(objPosition)
		{
			var CadenaResultado="";
			var lat = objPosition.coords.latitude;
			var lon = objPosition.coords.longitude;
			var alt = objPosition.coords.altitude;
			var acc = objPosition.coords.accuracy;
			var hea = objPosition.coords.heading;
			var spd = objPosition.coords.speed;
			CadenaResultado=lat+","+lon+","+alt+","+acc+","+hea+","+spd;
			PCOJS.Geolocalizacion = CadenaResultado;
		};

	PCOJS.GeoLocalizar_Error   = function(objPositionError)
		{
			var CadenaResultado="";
			switch (objPositionError.code)
			{
				case objPositionError.PERMISSION_DENIED:
					CadenaResultado = "GPS_DENEGADO";
				break;
				case objPositionError.POSITION_UNAVAILABLE:
					CadenaResultado = "GPS_NOSERVICIO";
				break;
				case objPositionError.TIMEOUT:
					CadenaResultado = "GPS_TIMEOUT";
				break;
				default:
					CadenaResultado = "GPS_ERROR";
			}
			PCOJS.Geolocalizacion = CadenaResultado;
		};

	PCOJS.GeoLocalizarUsuario = function()
		{
			/*Establece la ubicacion del usuario y retorna
					latitude (latitud): La posicion norte-sur sobre la tierra.
					longitude (Longitud): La posicion de occidente a oriente sobre la tierra
					altitude (altitud): La altura de la posicion, solo si el dispositivo de visualizacion tiene la capacidad de medir la altitud.
					accuracy (exactitud): Precision de las alturas, exactitud, que es medida en metros.
					heading: Direccion y recorrido, medida en grados alrededor de un circulo.
					speed (velocidad): La velocidad de desplazamiento en una partida determinada en metros por segundo.
				Retorna:
					Valores separador por coma segun los parametros activados (1)
					GPS_SINSOPORTE: Si el navegador del cliente no soporta geolocalizacion
					GPS_DENEGADO: Si el usuario no autoriza al navegador para accesar su ubicacion
					GPS_NOSERVICIO: Si no se puede acceder a la ubicacion. GPS inactivo?
					GPS_TIMEOUT: El servicio ha tardado demasiado tiempo en responder.  Por defecto 15 segundos, cache de 75 segundos
					GPS_ERROR: Ha ocurrido un error desconocido
				Tenga en cuenta:
					El tiempo de retorno del dispositivo puede no ser inmediato, se recomienda capturar el valor mediante una funcion con delay a menos que la funcion de geolocalizacion sea llamada siempre al comienzo con tiempo suficiente.
					Ej:  setTimeout(function(){ alert("GPS:"+PCOJS.Geolocalizacion); }, 3000);
			*/
			var CadenaResultado="";

			//Determina si el navegador soporta HTML5 y geolocalizacion
			if(navigator.geolocation)
				{
					navigator.geolocation.getCurrentPosition(PCOJS.GeoLocalizar_Exito,PCOJS.GeoLocalizar_Error, {
						maximumAge: 75000,
						timeout: 15000
					});
				}
			else
				{
					CadenaResultado="GPS_SINSOPORTE";
					PCOJS.Geolocalizacion = CadenaResultado;
				}
		};

	PCOJS.EsDispositivoMovil = function()
		{ 
			/*	Determina el tipo de navegador utilizado por el usuario retornando true si es movil o false si es de escritorio
				Vease tambien:
					Funcion disponible en PHP PCO_EsDispositivoMovil() que cumple la misma funcion
			*/
			if( navigator.userAgent.match(/Android/i)
				|| navigator.userAgent.match(/webOS/i)
				|| navigator.userAgent.match(/iPhone/i)
				|| navigator.userAgent.match(/iPad/i)
				|| navigator.userAgent.match(/iPod/i)
				|| navigator.userAgent.match(/BlackBerry/i)
				|| navigator.userAgent.match(/Windows Phone/i)		)
				{
					return true;
				}
			else
				{
					return false;
				}
		};

	PCOJS.GoogleMaps_DireccionPorCoordenadas = function(DireccionNatural,APIKey_GoogleMaps)
		{
			/*	Determina la informacion, incluyendo coordenadas de una direccion en lenguaje natural
			*/
			URLMaps = "https://maps.googleapis.com/maps/api/geocode/json?address="+DireccionNatural+"&key="+APIKey_GoogleMaps+"&language=es";
			ValorRecuperado=PCO_ObtenerContenidoAjax(0,URLMaps,"");
			return ValorRecuperado;
		};


// Fin Objeto PCO global para Practico #################################
//######################################################################










//Funcion para conversion de texto a HTML
function PCO_HTMLSpecialChars(string)
    {
        return $('<span>').text(string).html();
    }

function PCO_HTMLSpecialChars_Decode(string, quote_style) {
  //       discuss at: http://phpjs.org/functions/htmlspecialchars_decode/
  //      original by: Mirek Slugen
  //      improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      bugfixed by: Mateusz "loonquawl" Zalega
  //      bugfixed by: Onno Marsman
  //      bugfixed by: Brett Zamir (http://brett-zamir.me)
  //      bugfixed by: Brett Zamir (http://brett-zamir.me)
  //         input by: ReverseSyntax
  //         input by: Slawomir Kaniecki
  //         input by: Scott Cariss
  //         input by: Francois
  //         input by: Ratheous
  //         input by: Mailfaker (http://www.weedem.fr/)
  //       revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // reimplemented by: Brett Zamir (http://brett-zamir.me)
  //        example 1: htmlspecialchars_decode("<p>this -&gt; &quot;</p>", 'ENT_NOQUOTES');
  //        returns 1: '<p>this -> &quot;</p>'
  //        example 2: htmlspecialchars_decode("&amp;quot;");
  //        returns 2: '&quot;'

  var optTemp = 0,
    i = 0,
    noquotes = false;
  if (typeof quote_style === 'undefined') {
    quote_style = 2;
  }
  string = string.toString()
    .replace(/&lt;/g, '<')
    .replace(/&gt;/g, '>');
  var OPTS = {
    'ENT_NOQUOTES'          : 0,
    'ENT_HTML_QUOTE_SINGLE' : 1,
    'ENT_HTML_QUOTE_DOUBLE' : 2,
    'ENT_COMPAT'            : 2,
    'ENT_QUOTES'            : 3,
    'ENT_IGNORE'            : 4
  };
  if (quote_style === 0) {
    noquotes = true;
  }
  if (typeof quote_style !== 'number') {
    // Allow for a single string or an array of string flags
    quote_style = [].concat(quote_style);
    for (i = 0; i < quote_style.length; i++) {
      // Resolve string input to bitwise e.g. 'PATHINFO_EXTENSION' becomes 4
      if (OPTS[quote_style[i]] === 0) {
        noquotes = true;
      } else if (OPTS[quote_style[i]]) {
        optTemp = optTemp | OPTS[quote_style[i]];
      }
    }
    quote_style = optTemp;
  }
  if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
    string = string.replace(/&#0*39;/g, "'"); // PHP doesn't currently escape if more than one 0, but it should
    // string = string.replace(/&apos;|&#x0*27;/g, "'"); // This would also be useful here, but not a part of PHP
  }
  if (!noquotes) {
    string = string.replace(/&quot;/g, '"');
  }
  // Put this in last place to avoid escape being double-decoded
  string = string.replace(/&amp;/g, '&');

  return string;
}


function CapturarCanvasPantallaAImagen(MarcoOrigen,MarcoVistaPrevia,Formato,Ancho,Alto,FormularioSubmit,CampoAlmacenamiento)
    {
        //Si no especifica formato usa uno predeterminado
        if (Formato=="") Formato='image/png';  //image/png|image/jpeg
        
        //Si no recibe el marco de origen usa todo el Body
        if (MarcoOrigen=="") MarcoOrigen='wrapper';  //wrapper representa el div principal que contiene toda la app

        //Si no recibe el marco de destino usa uno oculto por defecto
        if (MarcoVistaPrevia=="") MarcoVistaPrevia='document.body';
        
        //Si no recibe ancho o alto entonces no los utiliza
        if (Ancho=="" || Ancho==0)  Ancho=$( MarcoOrigen ).width();
        if (Alto=="" || Alto==0)    Alto=$( MarcoOrigen ).height();      

        var ContenidoPantalla = document.getElementById(MarcoOrigen);
        var ContenedorVistaPrevia = document.getElementById(MarcoVistaPrevia);
        html2canvas(ContenidoPantalla, {
            onrendered: function(canvas) {
                ContenedorVistaPrevia.appendChild(canvas);
                ResultadoFinal=canvas;
                //Si encuentra un formulario definido para autoenvio lo ejecuta
                if (FormularioSubmit!="")
                    {
                        //Utiliza el campo de almacenamiento definido para llevar alli los datos.  El campo deberia estar dentro del formularioSubmit
                        var CampoDatos=document.getElementById(CampoAlmacenamiento);
                        ResultadoFinal=ResultadoFinal.toDataURL(); //Convierte el objeto a algo transportable
                        CampoDatos.value=ResultadoFinal;
                        //Envia datos
                        Formulario=document.getElementById(FormularioSubmit);
                        Formulario.submit();
                    }
            },
            width:Ancho,
            height:Alto
        });
    }


/*
            function ImprimirMarco()
                {
                    $("#btnPrint").live("click", function () {
                        var $("#MarcoImpresionCanvas").innerHTML().print();
                        var printWindow = window.open('', '', 'height=400,width=800');
                        printWindow.document.write('<html><head><title>DIV Contents</title>');
                        printWindow.document.write('</head><body >');
                        printWindow.document.write(divContents);
                        printWindow.document.write('</body></html>');
                        printWindow.document.close();
                        printWindow.print();
                    });
                }
*/

function PCO_Canvas_SobrePagina1()
    {
        html2canvas(document.body).then(function(canvas) {
            document.body.appendChild(canvas);
        });
    }

function PCO_Canvas_SobrePagina2()
    {
        html2canvas(document.body, {
	        onrendered: function(canvas) {
	        	$("#page").hide();
	            document.body.appendChild(canvas);
	            window.print();
	            $('canvas').remove();
	            $("#page").show();
	        }
	    });
    }
    
function PCO_Canvas_SobrePagina3()
    {
        html2canvas(document.body, {
	        onrendered: function(canvas) {
	        	$("#page").hide();
                document.getElementById("MarcoImpresionCanvas").appendChild(canvas);    //Agrega el canvas a un marco especifico
                //ImprimirMarco();
	            $("canvas").remove();
	            $("#page").show();
	        }
	    });
    }