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

