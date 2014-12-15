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
