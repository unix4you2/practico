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
    
    
    
    
    
