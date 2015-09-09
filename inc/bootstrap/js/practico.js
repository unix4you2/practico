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

function PCO_ObtenerContenidoAjax(PCO_ASINCRONICO,PCO_URL,PCO_PARAMETROS)
    {
        var xmlhttp;
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


function PCOJS_MostrarMensaje(TituloPopUp, Mensaje)
	{
		//Lleva los valores a cada parte del dialogo modal
		$('#PCO_Modal_MensajeTitulo').html(TituloPopUp);
		$('#PCO_Modal_MensajeCuerpo').html(Mensaje);

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
    
