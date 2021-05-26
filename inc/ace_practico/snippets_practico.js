var snippetManager = ace.require("ace/snippets").snippetManager;            //Carga la libreria necesaria para API de snippets en el editor
var snippets = snippetManager.parseSnippetFile("snippet test\n  TEST!");    //Carga los Snippets actuales intentando buscar alguno (cualquiera)

//Agrega los diferentes Snippets
snippets.push({ content: "PCOJS_OcultarBarraFlotanteIzquierda();", name: "PCOJS_OcultarBarraFlotanteIzquierda", tabTrigger: "" });
snippets.push({ content: "PCOJS_VerBarraFlotanteIzquierda();", name: "PCOJS_VerBarraFlotanteIzquierda", tabTrigger: "" });
snippets.push({ content: "PCOJS_AlternarBarraFlotanteIzquierda();", name: "PCOJS_AlternarBarraFlotanteIzquierda", tabTrigger: "" });
snippets.push({ content: "PCOJS_ValidarTeclado(${1:Evento},${2:Permitidos},${3:PermitidosExtra});", name: "PCOJS_ValidarTeclado", tabTrigger: "" });
snippets.push({ content: "PCO_ObtenerContenidoAjax(${1:PCO_ASINCRONICO},${2:PCO_URL},${3:PCO_PARAMETROS});", name: "PCO_ObtenerContenidoAjax", tabTrigger: "" });
snippets.push({ content: "PCOJS_StrReplace(${1:busca_por},${2:reemplaza_por},${3:cadena_original});", name: "PCOJS_StrReplace", tabTrigger: "" });
snippets.push({ content: "PCOJS_MostrarMensaje(${1:TituloPopUp},${2:Mensaje});", name: "PCOJS_MostrarMensaje", tabTrigger: "" });
snippets.push({ content: "PCOJS_EstablecerPorcentajeProgreso(${1:Porcentaje});", name: "PCOJS_EstablecerPorcentajeProgreso", tabTrigger: "" });
snippets.push({ content: "PCOJS_OcultarMensajeCargando();", name: "PCOJS_OcultarMensajeCargando", tabTrigger: "" });
snippets.push({ content: "PCOJS_OcultarVentanaChat();", name: "PCOJS_OcultarVentanaChat", tabTrigger: "" });
snippets.push({ content: "PCOJS_MostrarMensajeCargando(${1:TituloPopUp},${2:Mensaje},${3:PermitirCierre},${4:Progreso});", name: "PCOJS_MostrarMensajeCargando", tabTrigger: "" });
snippets.push({ content: "PCOJS_MostrarMensajeCargandoSimple(${1:MiliSegundos});", name: "PCOJS_MostrarMensajeCargandoSimple", tabTrigger: "" });
snippets.push({ content: "PCOJS_OcultarMensajeCargandoSimple();", name: "PCOJS_OcultarMensajeCargandoSimple", tabTrigger: "" });
snippets.push({ content: "PCOJS_ActualizarComboBox(${1:ObjetoListaOpciones});", name: "PCOJS_ActualizarComboBox", tabTrigger: "" });
snippets.push({ content: "PCOJS_LimpiarComboBox(${1:ObjetoListaOpciones});", name: "PCOJS_LimpiarComboBox", tabTrigger: "" });
snippets.push({ content: "PCOJS_AgregarOpcionComboBox(${1:ObjetoListaOpciones},${2:ValorOpcion},${3:EtiquetaOpcion});", name: "PCOJS_AgregarOpcionComboBox", tabTrigger: "" });
snippets.push({ content: "PCOJS_OpcionesCombo_DesdeCSV(${1:ObjetoListaOpciones},${2:Cadena},${3:SeparadorLineas});", name: "PCOJS_OpcionesCombo_DesdeCSV", tabTrigger: "" });
snippets.push({ content: "PCOJS.GeoLocalizar_Exito(${1:objPosition});", name: "PCOJS.GeoLocalizar_Exito", tabTrigger: "" });
snippets.push({ content: "PCOJS.GeoLocalizar_Error(${1:objPositionError});", name: "PCOJS.GeoLocalizar_Error", tabTrigger: "" });
snippets.push({ content: "PCOJS.GeoLocalizarUsuario();", name: "PCOJS.GeoLocalizarUsuario", tabTrigger: "" });
snippets.push({ content: "PCOJS.EsDispositivoMovil();", name: "PCOJS.EsDispositivoMovil", tabTrigger: "" });
snippets.push({ content: "PCOJS.GoogleMaps_DireccionPorCoordenadas(${1:DireccionNatural},${2:APIKey_GoogleMaps});", name: "PCOJS.GoogleMaps_DireccionPorCoordenadas", tabTrigger: "" });
snippets.push({ content: "PCO_HTMLSpecialChars(${1:string});", name: "PCO_HTMLSpecialChars", tabTrigger: "" });
snippets.push({ content: "PCO_HTMLSpecialChars_Decode(${1:string},${2:quote_style});", name: "PCO_HTMLSpecialChars_Decode", tabTrigger: "" });

//Registra todos los snippets para el lenguaje indicado
snippetManager.register(snippets, "javascript");

//snippetManager.register(snippets, "php");