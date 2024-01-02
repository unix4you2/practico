<?php
	/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2012-2022
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
	 This program is free software: you can redistribute it and/or modify
	 it under the terms of the GNU General Public License as published by
	 the Free Software Foundation, either version 3 of the License, or
	 (at your option) any later version.

	 This program is distributed in the hope that it will be useful,
	 but WITHOUT ANY WARRANTY; without even the implied warranty of
	 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 GNU General Public License for more details.

	 You should have received a copy of the GNU General Public License
	 along with this program.  If not, see <http://www.gnu.org/licenses/>
	 
	            --- TRADUCCION NO OFICIAL DE LA LICENCIA ---

     Esta es una traducción no oficial de la Licencia Pública General de
     GNU al español. No ha sido publicada por la Free Software Foundation
     y no establece los términos jurídicos de distribución del software 
     publicado bajo la GPL 3 de GNU, solo la GPL de GNU original en inglés
     lo hace. De todos modos, esperamos que esta traducción ayude a los
     hispanohablantes a comprender mejor la GPL de GNU:
	 
     Este programa es software libre: puede redistribuirlo y/o modificarlo
     bajo los términos de la Licencia General Pública de GNU publicada por
     la Free Software Foundation, ya sea la versión 3 de la Licencia, o 
     (a su elección) cualquier versión posterior.

     Este programa se distribuye con la esperanza de que sea útil pero SIN
     NINGUNA GARANTÍA; incluso sin la garantía implícita de MERCANTIBILIDAD
     o CALIFICADA PARA UN PROPÓSITO EN PARTICULAR. Vea la Licencia General
     Pública de GNU para más detalles.

     Usted ha debido de recibir una copia de la Licencia General Pública de
     GNU junto con este programa. Si no, vea <http://www.gnu.org/licenses/>

	*/

	/*
		Title: Idioma hindi
		Ubicacion *[/inc/idioma/hi.php]*.  Incluye la definicion de variables utilizadas para presentar mensajes en el idioma correspondiente
		NOTAS IMPORTANTES:
			* Por cuestiones de rendimiento se recomienda la definicion usando comillas simples.
			* Usar las dobles solo cuando se requieran variables o caracteres especiales.
			* Se pueden definir cadenas en funcion de otras definidas con anterioridad
			* Se puede hacer uso de notacion HTML dentro de las cadenas para dar formato
	*/

	// Cadena que describe el archivo de idioma para su escogencia
	$MULTILANG_DescripcionIdioma='हिंदी - Hindi (by GoogleTranslator)';

	//Lexico general (palabras y frases comunes a varios modulos)
	$MULTILANG_Accion='कार्य';
	$MULTILANG_Actualizacion='अपडेट';
	$MULTILANG_Actualizar='नवीनीकरण';
	$MULTILANG_Administre='प्रबंधित करें';
	$MULTILANG_Agregar='जोड़ें';
	$MULTILANG_Ambiente='वातावरण';
	$MULTILANG_Ambos='दोनों';
	$MULTILANG_Anonimo='गुमनाम';
	$MULTILANG_Anterior='पिछला';
	$MULTILANG_Apagado='बंद';
	$MULTILANG_Apariencia='Appearance';
	$MULTILANG_Aplicacion='आवेदन';
    $MULTILANG_Aplicando='आवेदन करना';
    $MULTILANG_Archivo='फ़ाइल';
	$MULTILANG_Asistente='जादूगर';
	$MULTILANG_Atencion='ध्यान दें';
	$MULTILANG_Avanzado='विकसित';
	$MULTILANG_Ayuda='मदद';
	$MULTILANG_Basedatos='डाटा बेस';
	$MULTILANG_Basicos='मूल बातें';
    $MULTILANG_BarraHtas='टूलबार';
    $MULTILANG_Bienvenido='वेलकम';
    $MULTILANG_Buscar='खोज';
	$MULTILANG_Campo='क्षेत्र';
	$MULTILANG_Cancelar='रद्द';
	$MULTILANG_Capturar='कैद';
    $MULTILANG_Cargando='लोड हो रहा है';
    $MULTILANG_Cargar='अपलोड';
	$MULTILANG_Cerrar='बंद करे';
	$MULTILANG_CerrarSesion='लॉग आउट';
	$MULTILANG_Cliente='ग्राहक';
	$MULTILANG_CodigoBarras='बार कोड';
	$MULTILANG_Columna='स्तंभ';
	$MULTILANG_Comando='कमांडो';
	$MULTILANG_ConfiguracionGeneral='सामान्य सेटिंग्स';
	$MULTILANG_Configuracion='विन्यास';
	$MULTILANG_ConfiguracionVarias='कई विकल्पों का विन्यास';
	$MULTILANG_Confirma='क्या आप वाकई जारी रखना चाहते हैं?';
	$MULTILANG_Continuar='जारी रखें';
	$MULTILANG_Contrasena='पासवर्ड';
	$MULTILANG_Controlador='ड्राइवर';
    $MULTILANG_Copias='बैकअप';
	$MULTILANG_Correcto='सही';
	$MULTILANG_Correo='ईमेल';
	$MULTILANG_Creditos='के बारे में';
	$MULTILANG_Cualquiera='कोई';
	$MULTILANG_Defina='परिभाषित करें';
	$MULTILANG_Descargar='डाउनलोड';
    $MULTILANG_Deshabilitado='विकलांग';
	$MULTILANG_Desplazar='विस्थापित';
    $MULTILANG_Detalles='विवरण';
	$MULTILANG_Disene='डिज़ाइन';
	$MULTILANG_Editar='संपादित करें';
	$MULTILANG_Ejecutar='निष्पादित करें';
	$MULTILANG_Elementos='तत्वों';
	$MULTILANG_Eliminar='हटाना';
	$MULTILANG_Embebido='एम्बेड';
	$MULTILANG_Encabezados='हेडर';
	$MULTILANG_Encendido='पर';
	$MULTILANG_Error='त्रुटि';
    $MULTILANG_Escritorio='डेस्कटॉप';
	$MULTILANG_Estado='स्थिति';
	$MULTILANG_Etiqueta='लेबल';
    $MULTILANG_Evento='Evento';
    $MULTILANG_Existentes='Existing';
    $MULTILANG_Explorar='अन्वेषण';
	$MULTILANG_Exportar='निर्यात';
	$MULTILANG_Fecha='तारीख';
	$MULTILANG_Finalizado='तैयार';
    $MULTILANG_Filtro='फ़िल्टर';
	$MULTILANG_Formularios='फार्म';
	$MULTILANG_Funciones='पूर्व प्राधिकृत कार्यों';
	$MULTILANG_FuncionesDes='सुरक्षा कारणों से, अपने कस्टम कार्य या मॉड्यूल को इस क्षेत्र में पूर्व अधिकृत किया जाना चाहिए। किसी भी चरित्र के द्वारा अलग कार्य या कार्यों में जोड़ें.';
	$MULTILANG_GeneradoPor='द्वारा संचालित';
	$MULTILANG_General='सामान्य';
	$MULTILANG_Grande='बड़े';
	$MULTILANG_Grafico='ग्राफिक';
	$MULTILANG_Guardar='सहेजें';
    $MULTILANG_Guardando='बचत';
	$MULTILANG_Habilitado='सक्षम किया';
	$MULTILANG_Habilitar='सक्षम करें';
    $MULTILANG_Historico='इतिहास';
	$MULTILANG_Hora='समय';
	$MULTILANG_Horizontal='परिदृश्य';
	$MULTILANG_IdiomaPredeterminado='डिफ़ॉल्ट भाषा';
	$MULTILANG_Imagen='चित्र';
	$MULTILANG_Importando='आयात';
	$MULTILANG_Importante='जरूरी';
	$MULTILANG_Importar='आयात';
	$MULTILANG_InfoAdicional='अतिरिक्त जानकारी';
	$MULTILANG_Informes='रिपोर्ट';
	$MULTILANG_Ingresar='साइन इन करें';
	$MULTILANG_Instante='तुरंत';
    $MULTILANG_Ir='जाना';
	$MULTILANG_IrEscritorio='मेरी मेज पर जाएं';
	$MULTILANG_Licencia='लाइसेंस';
	$MULTILANG_LlavePaso='महत्वपूर्ण संकेत';
	$MULTILANG_Maquina='मेज़बान';
	$MULTILANG_Matriz='मैट्रिक्स';
	$MULTILANG_Mediano='मध्यम';
    $MULTILANG_Modulos='मॉड्यूल';
    $MULTILANG_Mostrando='दिखा रहा है';
	$MULTILANG_MotorBD='डेटाबेस इंजन';
	$MULTILANG_Ninguno='कोई नहीं';
	$MULTILANG_No='नहीं';
	$MULTILANG_Nombre='नाम';
	$MULTILANG_NombreRAD='रेड नाम';
    $MULTILANG_Objeto='वस्तु';
    $MULTILANG_OlvideClave='मैं अपना पासवर्ड भूल गया';
	$MULTILANG_Opcional='ऐच्छिक';
    $MULTILANG_Opcion='विकल्प';
	$MULTILANG_OpcionesMenu='व्यंजना सूची';
	$MULTILANG_Otros='दूसरों';
	$MULTILANG_Pagina='पृष्ठ';
	$MULTILANG_ParamApp='आवेदन मापदंडों';
	$MULTILANG_Paso='चरण';
	$MULTILANG_Pausar='Pause';
	$MULTILANG_Peso=' भार';
	$MULTILANG_Pequeno='छोटा';
	$MULTILANG_Personalizado='रिवाज';
    $MULTILANG_Pestana='टैब';
    $MULTILANG_Plantilla='Template';
	$MULTILANG_Predeterminado='चूक';
    $MULTILANG_Previo='पिछला';
	$MULTILANG_Primero='पहले';
    $MULTILANG_Prioridad='प्राथमिकता';
    $MULTILANG_Procesando='प्रसंस्करण';
    $MULTILANG_ProcesoFin='प्रक्रिया पूरी की';
    $MULTILANG_Proveedores='Providers';
	$MULTILANG_Puerto='बंदरगाह';
    $MULTILANG_Recurrente='Recurrent';
    $MULTILANG_Registrarme='साइन इन करें';
    $MULTILANG_Regresar='वापसी';
    $MULTILANG_Resultados='परिणाम';
	$MULTILANG_SaltarLinea='लाइन पर चलें';
    $MULTILANG_Si='हाँ';
    $MULTILANG_Siguiente='अगला';
	$MULTILANG_Seleccionar='का चयन करें';
    $MULTILANG_SeleccioneUno='एक का चयन';
    $MULTILANG_Servidor='सर्वर';
	$MULTILANG_Suspender='निलंबित';
	$MULTILANG_Tablas='टेबल्स';
	$MULTILANG_TablaDatos='डेटा तालिका';
	$MULTILANG_Tamano='आकार';
	$MULTILANG_Tareas='कार्य';
	$MULTILANG_TiempoCarga='लोड होने का समय';
	$MULTILANG_Tipo='टाइप';
	$MULTILANG_TipoMotor='इंजन के प्रकार';
	$MULTILANG_Titulo='शीर्षक';
	$MULTILANG_TotalRegistros='कुल अभिलेख पाया';
	$MULTILANG_Trazabilidad='Traceability';
	$MULTILANG_Truncar='छोटा कर';
	$MULTILANG_Ultimo='अंतिम';
    $MULTILANG_Usuario='उपयोगकर्ता';
	$MULTILANG_Vacio='खाली';
	$MULTILANG_Variables='चर';
	$MULTILANG_Version='संस्करण';
	$MULTILANG_Vertical='चित्र';
	$MULTILANG_ZonaHoraria='समय क्षेत्र';
	$MULTILANG_ZonaPeligro='खतरनाक क्षेत्र';
	$MULTILANG_VistaImpresion='मुद्रक देखें';
	$MULTILANG_IDGABeacon='गूगल विश्लेषिकी आईडी';
	$MULTILANG_AyudaGABeacon='जो लोग चाहते हैं डेवलपर्स यहां अपने Google Analytics कक्ष से अद्वितीय पहचान डाल सकता है गूगल विश्लेषिकी का उपयोग कर अपने सॉफ्टवेयर के बारे में एक पूर्ण प्रवेश या वास्तविक समय आँकड़े है। Practico वास्तविक समय में सभी आंकड़े तू अपने Analytics पैनल भेज देंगे।';

	//Ventana de login
	$MULTILANG_TituloLogin='सिस्टम लॉगिन';
	$MULTILANG_CodigoSeguridad='सुरक्षा कोड';
	$MULTILANG_IngreseCodigoSeguridad='कोड दर्ज करें';
	$MULTILANG_AccesoExclusivo='इस सॉफ्टवेयर का उपयोग केवल पंजीकृत उपयोगकर्ताओं के लिए है। अपनी सुरक्षा के लिए, अपने यूज़रनेम और पासवर्ड का हिस्सा कभी नहीं।';
	$MULTILANG_LoginNoWSTit='प्रमाणीकरण वेब सेवा लोड करने की कोशिश में त्रुटि';
	$MULTILANG_LoginNoWSDes='The file_get_contents() function can not to load the XML output file built by Practico authentication process.<br>  Check your web server configuration/installation to see that this funtion can works correctly and without restrictions.<br>  A way to check that Practicos process is fine but your server doesnt allow to load the XML file<br>is opening the next link and checking if your browser loads the XML correctly.  Activating debug mode on your Practicos config you could see more details: ';
	$MULTILANG_OauthLogin='मेरे सामाजिक नेटवर्क का उपयोग कर लॉगिन';
	$MULTILANG_LoginClasico='Practicos खाते के साथ लॉगिन';
	$MULTILANG_LoginOauthDes='<b>सामाजिक नेटवर्क और अन्य प्रमाणीकरण प्रदाताओं</b><br>अपने पसंदीदा साइट से यूज़रनेम और पासवर्ड का उपयोग कर लॉगइन करने के लोगो पर क्लिक करें.';
	$MULTILANG_CaracteresCaptcha='कैप्चा के लिए पात्रों की संख्या?';
	$MULTILANG_TipoCaptcha='एक्सेस स्क्रीन के लिए उपयोग किए गए कैप्चा का प्रकारा नहीं है';
	$MULTILANG_TipoCaptchaTradicional='पारंपरिक (संख्याएं और अक्षरों) को PHP जीडी सक्षम होना चाहिए';
	$MULTILANG_TipoCaptchaVisual='Visual selection of images. No GD library required';
	$MULTILANG_TipoCaptchaPrefijo='Click on the';
	$MULTILANG_TipoCaptchaPosfijo='icon to validate';
    $MULTILANG_SimboloCaptchaCarro='CAR';
    $MULTILANG_SimboloCaptchaTijeras='SCISSORS';
    $MULTILANG_SimboloCaptchaCalculadora='CALCULATOR';
    $MULTILANG_SimboloCaptchaBomba='BOMB';
    $MULTILANG_SimboloCaptchaLibro='BOOK';
    $MULTILANG_SimboloCaptchaPastel='CAKE';
    $MULTILANG_SimboloCaptchaCafe='CAFE';
    $MULTILANG_SimboloCaptchaNube='CLOUD';
    $MULTILANG_SimboloCaptchaDiamante='DIAMOND';
    $MULTILANG_SimboloCaptchaMujer='WOMAN';
    $MULTILANG_SimboloCaptchaHombre='MAN';
    $MULTILANG_SimboloCaptchaBalon='BALL';
    $MULTILANG_SimboloCaptchaControl='GAMEPAD';
    $MULTILANG_SimboloCaptchaCasa='HOUSE';
    $MULTILANG_SimboloCaptchaCelular='CELLPHONE';
    $MULTILANG_SimboloCaptchaArbol='TREE';
    $MULTILANG_SimboloCaptchaTrofeo='TROPHY';
    $MULTILANG_SimboloCaptchaSombrilla='UMBRELLA';
    $MULTILANG_SimboloCaptchaUniversidad='UNIVERSITY';
    $MULTILANG_SimboloCaptchaCamara='CAMERA';
    $MULTILANG_SimboloCaptchaAmbulancia='AMBULANCE';
    $MULTILANG_SimboloCaptchaAvion='AIRPLANE';
    $MULTILANG_SimboloCaptchaTren='TRAIN';
    $MULTILANG_SimboloCaptchaBicicleta='BIKE';
    $MULTILANG_SimboloCaptchaCamion='TRUCK';
    $MULTILANG_SimboloCaptchaCorazon='HEART';
	$MULTILANG_LogoParteSuperior='आपके आवेदन के शीर्ष बाईं ओर लोगो';
	$MULTILANG_LogoDuranteLogin='अपने आवेदन लॉगिन के समय में लोगो';
	$MULTILANG_ResolucionLogos='यदि भरी हुई छवि में संकेत दिया गया संकल्प नहीं है, तो इसे उपयोगकर्ता के लिए हर बार पेश किया जाएगा।';

	//Banderas de campos en formularios
	$MULTILANG_TitValorUnico='डुप्लिकेट को स्वीकार नहीं करता गई वैल्यू';
	$MULTILANG_DesValorUnico='पहले से ही प्रवेश की अनुमति नहीं किया जाएगा डेटाबेस में है कि मूल्य के साथ एक रिकॉर्ड है, अगर वहाँ प्रणाली है, इस क्षेत्र में दर्ज की गई जानकारी को मान्य होगा.';
	$MULTILANG_TitObligatorio='आवश्यक क्षेत्र';
	$MULTILANG_DesObligatorio='इस क्षेत्र अनिवार्य रूप में चिह्नित किया गया है। आप इस के लिए एक मान दर्ज नहीं करते हैं तो सिस्टम उपयोगकर्ता इनपुट रिकॉर्ड की दुकान नहीं करता है।';

	//Errores y avisos varios
	$MULTILANG_VistaPrev='पूर्वावलोकन';
	$MULTILANG_TituloInsExiste='ध्यान दें: स्थापना फ़ोल्डर सर्वर पर मौजूद';
	$MULTILANG_TextoInsExiste='इस संदेश को आप Practico की स्थापना के लिए प्रयोग किया जाता निर्देशिका को नष्ट नहीं है के रूप में सभी उपयोगकर्ताओं के लिए स्थायी रूप से दिखाई देता है। यह आप पहले से ही के लिए Practico के स्थापित एक पूरा कर लिया है, तो प्रक्रिया फिर से व्यापार <br> आप को महत्व की जानकारी के साथ विन्यास फाइल या डेटाबेस overwritting आरंभ फ़ोल्डर किसी भी बेनामी उपयोगकर्ता को रोकने के लिए एक अधिष्ठापन के अंत के बाद हटा दिया गया है कि आवश्यक है उत्पादन में प्रयोग आगे बढ़ने से पहले इस फ़ोल्डर को दूर करने के लिए महत्वपूर्ण है। आप इस फ़ोल्डर को नष्ट करना चाहते हैं तो आप अस्थायी या परीक्षण में नाम बदलने के लिए चुन सकते हैं। शब्दकोश हिन्दी यदि आप पहली बार इस स्क्रिप्ट चल रहा है और एक नया स्थापना करना चाहते हैं जब यह संदेश देख रहे हैं, तो आप विज़ार्ड शुरू कर सकते हैं  <a class="btn btn-primary btn-xs" href="javascript:document.location=\'ins\';"><i class="fa fa-rocket"></i> यहाँ पर क्लिक</a> ';
	$MULTILANG_ErrorTiempoEjecucion='रनटाइम त्रुटि';
	$MULTILANG_ErrorModulo='मुख्य मॉड्यूल में स्थित एक मॉड्यूल शामिल करने के लिए कोशिश कर रहा है <b>mod/</b> लेकिन Practico अपनी पहुँच बिंदु नहीं मिल सकता है।<br> मॉड्यूल स्थिति की जांच करें अपने व्यवस्थापक से परामर्श या इस संदेश से बचने के लिए परस्पर विरोधी मॉड्यूल को हटा दें।';
	$MULTILANG_ContacteAdmin='अपने सिस्टम व्यवस्थापक से संपर्क करें और इस पोस्ट की रिपोर्ट।';
	$MULTILANG_ReinicieWeb='आवश्यक सेटिंग्स बनाने के लिए और अपने वेब सेवा को पुनः प्रारंभ करें.';
	$MULTILANG_PHPSinSoporte='आपका पीएचपी स्थापना कोई समर्थन नहीं है प्रकट होता है';
	$MULTILANG_ErrExtension=' अक्षम लोगों के लापता या एक मॉड्यूल की आवश्यकता है PHP एक्सटेंशन';
	$MULTILANG_ErrLDAP=$MULTILANG_PHPSinSoporte.' LDAP समर्थन बाहरी प्रमाणीकरण पद्धति के रूप में उपयोग के लिए आवश्यक है।<br>'.$MULTILANG_ReinicieWeb.'.<br>व्यवस्थापक उपयोगकर्ता प्रमाणीकरण का उपयोग कर के नुकसान से बचने के लिए स्वतंत्र रहेगा.';
	$MULTILANG_ErrHASH=$MULTILANG_PHPSinSoporte.' हैश समर्थन की आवश्यकता है.<br>आप बाहरी प्रमाणीकरण अप इंजन पर पासवर्ड के लिए एक अलग एन्क्रिप्शन प्रकार चयनित अगर इस विस्तार की आवश्यकता है.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrSESS=$MULTILANG_PHPSinSoporte.' सत्र समर्थन की आवश्यकता है. '.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrGD=$MULTILANG_PHPSinSoporte.' जी डी ग्राफिक्स पुस्तकालय की आवश्यकता है.<br>डेबियन उपयोग कर रहे हैं जो लोग, Ubuntu या उसके डेरिवेटिव एक कोशिश कर सकते हैं <b> apt-get install php5-gd </ b> to add it. RedHat or CentOS users <b> yum install php-gd </ b>. अन्य platfroms से उपयोगकर्ता अपने प्रलेखन Chech चाहिए.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrCURL=$MULTILANG_PHPSinSoporte.' कर्ल पुस्तकालय की आवश्यकता है.<br>डेबियन उपयोग कर रहे हैं जो लोग, Ubuntu या उसके डेरिवेटिव एक कोशिश कर सकते हैं <b> apt-get install php5-gd </ b> इसे जोड़ने के लिए.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrSimpleXML=$MULTILANG_PHPSinSoporte.' SimpleXML पुस्तकालय की आवश्यकता है.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrExtensionGenerica=$MULTILANG_PHPSinSoporte.' activated for this library or extension.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrPDO=$MULTILANG_PHPSinSoporte.' पीडीओ समर्थन की आवश्यकता है.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrDriverPDO=$MULTILANG_PHPSinSoporte.' for PDO. '.$MULTILANG_ReinicieWeb;
	$MULTILANG_ObjetoNoExiste='इस अनुरोध के साथ जुड़े वस्तु मौजूद नहीं है.';
	$MULTILANG_ErrorDatos='इनपुट डेटा में समस्या';
	$MULTILANG_ErrorTitAuth='<blink>पहुंच अस्वीकृत!</blink>';
	$MULTILANG_ErrorDesAuth='<div align=left>प्रणाली का उपयोग करने के लिए आपूर्ति की क्रेडेंशियल्स स्वीकार नहीं किया गया। कुछ आम कारण होते हैं:<br><li>उपयोगकर्ता नाम या पासवर्ड ग़लत है. <br> <li> सुरक्षा कोड गलत दर्ज. <br> <li> अपना लॉगिन अक्षम लोगों के लिए है. <br> <li> खाता गलत पासवर्ड के साथ कई प्रयासों के द्वारा उपयोग बंद कर दिया.</div>';
	$MULTILANG_ErrorSoloAdmin='केवल व्यवस्थापक उपयोगकर्ता डिबग मोड के साथ लेन-देन के विवरण पर दिया देख सकते हैं';
	$MULTILANG_ErrGoogleAPIMod='OAuth2 गूगल के लिए डिफ़ॉल्ट प्रमाणन पद्धति के रूप में विन्यस्त किया गया था.<br>Anyway the Practicos module for google-api is not installed yet.<br>Please download the google-api module from Practicos website and reload again.';
	$MULTILANG_ErrFuncion='<br>PHP समारोह नहीं मौजूद है या अपने सर्वर में अक्षम है करता है: ';
	$MULTILANG_ErrDirectiva='पर्यावरण वर अपने PHP या वेब सर्वर विन्यास पर सक्रिय किया जाना चाहिए';
    $MULTILANG_AdminArchivos='फ़ाइल प्रबंधक';
    $MULTILANG_ErrorConnLDAP='एक त्रुटि LDAP सर्वर कनेक्शन के दौरान हुई। कृपया अपनी सेटिंग देखें और पुनः प्रयास करें। विवरण:<br>';
    $MULTILANG_ErrorRW='फ़ाइल लिखने के लिए अधिकार नहीं है! इसकी सामग्री में कोई परिवर्तन खो दिया जा सकता है';
    $MULTILANG_ErrorExistencia='आप संस्करण के लिए कहा फ़ाइल नाम नहीं मौजूद करता है!';
    $MULTILANG_ErrorNoACE='ऐस मॉड्यूल फ़ाइल संपादित करने की कोशिश नहीं मिला था';
    $MULTILANG_AyudaExplorador='महत्वपूर्ण: यह केवल मौजूद है के बारे में कुछ फ़ोल्डरों जानकारी के रूप में दिखाया जाता है। वे संपादन योग्य फ़ाइलों ही किया है, शायद, फ़ोल्डरों का विस्तार.';
    $MULTILANG_EnlacePcoder='{PCoder}: कोड संपादक';
    $MULTILANG_AtajosTitPcoder='कुंजीपटल संक्षिप्त रीति';
    $MULTILANG_AvisoSistema='सिस्टम संदेश';
    $MULTILANG_PcoderAjuste='विंडो समायोजन';
    $MULTILANG_PcoderAjusteConfirma='आप अपनी अधिकतम संकल्प के रूप में खिड़की के आकार करने के लिए इस विंडो को फिर से लोड करने के लिए जा रहे हैं। आप इस विंडो को फिर से लोड जब आप पहले से ही बचाया न कि किसी भी परिवर्तन खो सकते हैं। क्या आप जारी रखना चाहते हैं?';
    $MULTILANG_BuscaCriterios='आप खोज करने के लिए एक महत्वपूर्ण शब्द दर्ज करना चाहिए';
    $MULTILANG_EstadoPHP='PHP जानकारी';
    $MULTILANG_ArchivosLimpiados='साफ / पर्ज फ़ाइलों';
    $MULTILANG_EspacioLiberado='डिस्क स्थान मुक्त कर दिया';
    $MULTILANG_TitDemo='समारोह उपलब्ध अनुरोध नहीं किया है';
    $MULTILANG_MsjDemo='आप डेमो (या प्रदर्शन) मोड में एक सुविधा में हैं। इस तरह की सुविधा से आप सभी सुरक्षा नियंत्रण के साथ स्वतंत्र रूप से बातचीत करने की अनुमति नहीं है। यह आपको हमेशा मंच कोशिश करना चाहते हैं सभी उपयोगकर्ताओं के लिए उपलब्ध हो जाएगा सुनिश्चित करता है।';
    $MULTILANG_SeparadorCampos='क्षेत्र विभाजक के लिए स्ट्रिंग मान';
    $MULTILANG_SeparadorCamposDes='डेटा बेस के इंजन से अधिक प्रश्नों में अलग मूल्यों के लिए इस्तेमाल किया। यह उपयोगकर्ताओं द्वारा दर्ज किया गया डेटा के साथ किसी भी मैच को रखने के लिए एक असामान्य मूल्य होना चाहिए';
    $MULTILANG_SelectorIdioma='उपयोगकर्ता लॉगिन समय पर भाषा बदल सकते हैं';
    $MULTILANG_SelectorIdiomaAyuda='प्लेटफार्म में सभी भाषाओं के लाभों के साथ प्रवेश के दौरान एक चयन सूची दिखाता है।';
    $MULTILANG_ErrorConexionInternet='ऐसा लगता है कि इंटरनेट कनेक्शन के बिना किया गया है, इस प्रणाली के लिए कनेक्शन जब आपका इंटरनेट कनेक्शन आम हो बहाल हो जाएगा। देखें कि आपका नेटवर्क कनेक्शन या डेटा संकेत सक्रिय हैं।';
    $MULTILANG_NombreRADDes='नाम अनुप्रयोग जनरेटर के लिए इस्तेमाल किया। यह विंडो खिताब के लिए भी प्रयोग किया जाता है';
    $MULTILANG_SaltoEdicion='आप वर्तमान तत्व के संपादन को बंद करने वाले हैं और चयनित तत्व के संपादन विंडो पर कूदते हैं। क्या आप जारी रखना चाहते हैं?';
    $MULTILANG_ExportacionMasiva='भारी निर्यात';
    $MULTILANG_AgregarAExportacion='थोक निर्यात सूची में आइटम जोड़ें';
    $MULTILANG_ImagenFondo='Background image';
    $MULTILANG_ImagenFondoDes='Define a background image to customize your application. It is recommended wide but light. Recommendation: You should combine theme colors and controls with the image palette to harmonize your design. By default the value is img/fondo.jpg but you can change it to any relative path from the root of the system, even to animated files.';
    $MULTILANG_ImagenDefecto='Empty for nothing or relative path';
    
	//Asistente disenador aplicaciones
	$MULTILANG_DesAppBoton='आवेदन डिजाइन';
	$MULTILANG_TitDisenador='आवेदन डिजाइन <b>सरल और तेज है:</b>';
	$MULTILANG_DefTablas='तालिका परिभाषा';
	$MULTILANG_DesTablas='टेबल्स जानकारी उनके साथ जुड़े रूपों का उपयोग कर संग्रहीत किया जाता है, जिसमें उन संरचनाओं हैं.';
	$MULTILANG_DefForms='डेटा प्रविष्टि और क्वैरी जानकारी के लिए';
	$MULTILANG_DesForms='वे उपयोगकर्ता, कुछ सत्यापन या प्रारूपों के अनुसार जानकारी दर्ज परामर्श करें या यहाँ तक के रिकॉर्ड को नष्ट करने की अनुमति देते हैं। प्रदर्शन भी ऐसे पन्नों या पहले से डिज़ाइन रिपोर्ट के रूप में अन्य तत्वों की अनुमति देते हैं.';
	$MULTILANG_DefInformes='(ग्राफिक्स या टेबल)';
	$MULTILANG_DesInformes='वे परिभाषित विभिन्न स्वरूपों और फिल्टर में उपयोगकर्ताओं के लिए टेबल के भीतर सूचना मौजूदा प्रस्तुत करते हैं। आप सारणीबद्ध या चार्ट प्रकार बना सकते हैं और बाद में भी अन्य स्थानों में एम्बेडेड हो.';
	$MULTILANG_DefMenus='उपयोगकर्ताओं के लिए';
	$MULTILANG_DesMenus='कि अनुमति के साथ एक उपयोगकर्ता द्वारा चयनित किया जा सकता है कि चित्रमय प्रतीक और पाठ विवरण के साथ रूपों या रिपोर्टों के रूप में तैयार लिंक वस्तुओं। यह भी आप बाहरी कार्यों या कस्टम आदेश निष्पादन लिंक करने के लिए अनुमति देता है.';
	$MULTILANG_UsuariosPermisos='उपयोगकर्ता और अनुमतियाँ';
	$MULTILANG_DefUsuarios='अपने आवेदन का उपयोग करने के लिए';
	$MULTILANG_DesUsuarios='पहुँच प्रपत्र, रिपोर्ट या किसी भी पहले से परिभाषित मेनू विकल्पों के लिए प्रत्येक के लिए उपलब्ध प्रत्येक उपयोगकर्ता के लिए पहुँच साख, और अनुमतियाँ सेट करता है.';
	$MULTILANG_DefAvanzadas='अग्रिम औज़ार';
	$MULTILANG_DefMantenimientos='रखरखाव';
	$MULTILANG_DefPcoder='ऑनलाइन कोड संपादक';
	$MULTILANG_DefLimpiarTemp='स्वच्छ अस्थायी फ़ोल्डर /tmp';
	$MULTILANG_DefLimpiarBackups='पर साफ मौजूदा बैकअप /bkp';
	$MULTILANG_DefPMyDB='उन्नत डेटाबेस व्यवस्थापक';
	$MULTILANG_ConfirmaPMyDB='महत्वपूर्ण: अनुचित तालिकाओं की हैंडलिंग और जानकारी के आंशिक या कुल नुकसान के साथ-साथ अपने आवेदन में अप्रत्याशित प्रदर्शन के कारण हो सकता है उन्नत डाटाबेस प्रशासक के माध्यम से उनके बारे में जानकारी। हम शामिल देखभाल के साथ इस डेटाबेस प्रबंधक का उपयोग करना चाहिये।';

	//Cierre de sesion
	$MULTILANG_SesionCerrada='आपका सत्र बंद कर दिया गया है';
	$MULTILANG_TituloCierre='इस तरह उपयोगकर्ता द्वारा की गई कार्रवाई से परिणाम कर सकते हैं';
	$MULTILANG_ExplicacionCierre='<li>स्वेच्छा से अपने सत्र बंद</li>
			<li>एक लंबे समय के लिए इस प्रणाली का उपयोग कर बंद करो</li>
			<li>व्यवस्थापक द्वारा प्रतिबंधित वर्गों में एक ही समय प्रणाली पर खुले कई खिड़कियों के बाद</li>
			<li>आपका उपयोगकर्ता नाम या पासवर्ड आगे ऑपरेशन के लिए अमान्य है</li>
			<li>अनुमति दी उन लोगों से लिंक या अन्य बटन का उपयोग नेविगेट</li>
			<br><strong>यह भी पसंद कर अपने कंप्यूटर पर विन्यास या कार्रवाई के लिए:</strong><br>
			<li>आपका ब्राउज़र कुकीज़ का समर्थन नहीं है</li>
			<li>ब्राउज़र कुकीज़ या सत्र की साफ कैश प्रणाली का उपयोग करते हुए</li>
			<br><strong>सिस्टम विन्यास भी पसंद:</strong><br>
			<li>आप मंच की स्थापना की प्रक्रिया के सत्र की एक पुनः आरंभ करने की आवश्यकता पूरी कर ली है</li>
			<li>उपयोगकर्ता के साइन कुंजी इस प्रणाली के लिए आवश्यक कुंजी से मेल खाती नहीं करता</li>
			<li>एक ऑपरेशन पर हस्ताक्षर करने के लिए क्रेडेंशियल्स मान्य नहीं हैं</li>';

	//Actualizacion de plataforma
	$MULTILANG_ActMsj1='ध्यान दें: जारी रखने से पहले इस जानकारी पढ़ें';
	$MULTILANG_ActMsj2='Practico किसी भी पैच लागू करने से पहले, हालांकि, आधिकारिक वेबसाइट से या अपडेट के लिए इस परियोजना के जादूगर द्वारा डाउनलोड वृद्धिशील पैच के साथ अपने सिस्टम के लिए स्वत: अद्यतन को लागू करने के लिए इस तंत्र प्रदान करता है कि आवश्यक :<br><br>
			<li>अपने डेटाबेस का बैकअप बना। कुछ अपडेट को प्रभावित कर सकता है कि डेटा सूचना के आधार पर संरचनाओं के संशोधन की आवश्यकता हो सकती है।
			<li>आपकी फ़ाइलों या Practico फ़ोल्डर बैकअप लें।
			<li>Practico कार्य फ़ोल्डर (पथ tmp /) यह दबाव हटाना और फ़ाइलों को स्कैन करने के लिए विज़ार्ड द्वारा उपयोग किया जाएगा साफ।';
	$MULTILANG_ActUsando='वर्तमान में आप संस्करण का उपयोग कर रहे हैं';
	$MULTILANG_ActPaquete='पैकेज / मैन्युअल अद्यतन पैच';
	$MULTILANG_ActSobreescritos='पिछले फ़ाइलें ओवरराइट किया जाएगा';
	$MULTILANG_CargarArchivo='फ़ाइल अपलोड करें';
	$MULTILANG_Adjuntando='प्रणाली के लिए एक नया फ़ाइल संलग्न';
	$MULTILANG_ErrorTamano='<b> चेतावनी: </b> बाधित प्रक्रिया। फ़ाइल आकार सीमा से अधिक';
	$MULTILANG_ErrorFormato='<b> चेतावनी: </b> बाधित प्रक्रिया। अपलोड की गई फ़ाइल का स्वरूप मान्य नहीं है';
	$MULTILANG_CargaCorrecta='फ़ाइल सही ढंग से अपलोड किया गया है';
	$MULTILANG_ErrorDesconocido='<b> चेतावनी: </b> फाइल अपलोड करते समय एक अज्ञात त्रुटि हुई';
	$MULTILANG_ErrorDescomprimiendo='फ़ाइल decompressing';
	$MULTILANG_ContenidoParche='फाइल सामग्री';
	$MULTILANG_ErrorVerAct='Practico के वर्तमान संस्करण को लोड करने में त्रुटि। फ़ाइल प्राप्त नहीं हुई';
	$MULTILANG_ErrorActualiza='अपलोड की गई फ़ाइल एक वैध उन्नयन पैकेज प्रतीत होता नहीं है। फ़ाइल प्राप्त नहीं हुई';
	$MULTILANG_ErrorAntigua='अपलोड किए गए पैच फ़ाइल एक सबसे पुराना अद्यतन को संदर्भ के लिए अपने मौजूदा संस्करण';
	$MULTILANG_ErrorVersion='अपलोड किए गए पैच फ़ाइल निम्न संस्करण की आवश्यकता है';
	$MULTILANG_AvisoIncremental='आप पहली बार पैच की आवश्यकता है कि अपने न्यूनतम सिस्टम संस्करण को बढ़ाने के लिए आवश्यक वृद्धिशील सुधारों को लागू करना होगा।';
	$MULTILANG_Integridad='ईमानदारी';
	$MULTILANG_ResumenParche='पैच द्वारा प्रदान की जाने वाली परिवर्तन और सुविधाओं का सारांश';
	$MULTILANG_ResumenInstrucciones='निर्देश प्रणाली टेबल पर निष्पादित किया जाना है';
	$MULTILANG_FinRevision='समीक्षा प्रक्रिया समाप्त';
	$MULTILANG_ActMsj3='ऊपर सूचीबद्ध फ़ाइलों को लागू करने में अगले संस्करण के लिए अपने सिस्टम का उन्नयन होगा';
	$MULTILANG_ActErrGral='फ़ाइल संरचना, प्रकार या असमर्थित संस्करण';
	$MULTILANG_ActDesde='संस्करण से अद्यतन कर रहा है';
	$MULTILANG_ErrLista='बैकअप के लिए फ़ाइलों का लोड करने में त्रुटि सूची';
	$MULTILANG_HaciendoBkp='बैकअप बनाने';
	$MULTILANG_ErrBkpBD='एक त्रुटि डेटाबेस बैकअप के दौरान हुई';
	$MULTILANG_ActMsj4='फ़ाइलों के किसी भी अनुमतियाँ मुद्दों से इस जादूगर ने नहीं लिखा जा सकता है, तो पैच भी व्यवस्थापक द्वारा या लापता केवल फाइलों को कॉपी करके मैन्युअल रूप से लागू किया जा सकता है';
	$MULTILANG_ActMsj5='फ़ाइल संरचना या असमर्थित प्रकार';
	$MULTILANG_ActAlertaVersion='डाउनलोड करने के लिए उपलब्ध Practico का एक नया संस्करण है।<br>हम नए संस्करण डाउनलोड करें या oficial वेबसाइट से पैकेज के उन्नयन और नई सुविधाओं के लिए अपने सिस्टम को अपग्रेड करने के लिए आप की सिफारिश.';
	$MULTILANG_ActBuscarVersion='स्वचालित रूप से नए संस्करणों के लिए देखो';
    $MULTILANG_ActErrEscritura='लिखने त्रुटि';
    $MULTILANG_ActDesEscritura='चेतावनी: उन्नत किया जा करने के लिए जा रहे हैं कि फाइल में लिखने त्रुटियाँ हैं.
        <br><br>आप Practico द्वारा लेखनीय होने की अनुमति फ़ाइल को ठीक जब तक आप उन्नयन नहीं कर सकते सॉफ्टवेयर में ईमानदारी रखने के लिए। फ़ाइलों को लाल रंग और पाठ में सूची में चिह्नित कर रहे हैं "'.$MULTILANG_ActErrEscritura.'".  
        <br><br>समस्या को ठीक करें और पुन: प्रयास.';
    $MULTILANG_ActBackupTipo='बैकअप मोड';
    $MULTILANG_ActBackup1='लिपियों इस प्रक्रिया के दौरान की जगह केवल';
    $MULTILANG_ActBackup3='लिपियों की जगह है और सभी अपने डेटाबेस';
    $MULTILANG_ActBackupDes='एक पूर्ण बैकअप कर प्रणाली के लिए एक भारी काम हो सकता है। सिस्टम में व्यापक रूप से एक पूर्ण बैकअप प्रक्रिया आप भी उपयोगकर्ताओं मक्खी पर काम करने के साथ संगत फ़ाइलों की अनुमति है कि एक और उपकरण के द्वारा किया जाना चाहिए इस्तेमाल किया.';

	//Formularios
	$MULTILANG_ErrFrmDuplicado='क्षेत्र में दोहराया मूल्य में विफल रहा। आपने जो मूल्य पहले से ही डेटाबेस में मौजूद है। क्षेत्र: ';
	$MULTILANG_ErrFrmObligatorio='आप अनिवार्य क्षेत्र में प्रवेश करने के लिए भूल गया: ';
	$MULTILANG_ErrFrmDatos='इनपुट डेटा में कोई समस्या है';
	$MULTILANG_ErrFrmCampo1='आप क्षेत्र के लिए एक वैध शीर्षक या लेबल दर्ज करना होगा.';
	$MULTILANG_ErrFrmCampo2='आप फार्म के साथ जुड़े डेटा तालिका से जोड़ने के लिए एक वैध क्षेत्र में प्रवेश करना होगा.';
	$MULTILANG_ErrFrmCampo3='आप बटन के लिए एक वैध शीर्षक या लेबल दर्ज करना होगा.';
	$MULTILANG_ErrFrmCampo4='नियंत्रण सक्रिय होता है जब आप क्रियान्वित किया जा करने के लिए एक वैध कार्रवाई दर्ज करना होगा.';
	$MULTILANG_FrmMsj1='फार्म के लिए एक आइटम जोड़ें';
	$MULTILANG_FrmTipoObjeto='वस्तु के प्रकार जोड़ने के लिए';
	$MULTILANG_FrmTipoTit1='डेटा नियंत्रण';
	$MULTILANG_FrmTipo1='लघु पाठ क्षेत्र';
	$MULTILANG_FrmTipo2='मुफ्त / असीमित पाठ क्षेत्र';
	$MULTILANG_FrmTipo3='बड़े पैमाने पर स्वरूपित पाठ क्षेत्र (CKEditor)';
	$MULTILANG_FrmTipo4='चुनाव क्षेत्र (ComboBox ड्रॉपडाउन सूची)';
	$MULTILANG_FrmTipo5='चुनाव क्षेत्र (RadioButton)';
	$MULTILANG_FrmTipoTit2='प्रस्तुति और अन्य सामग्री';
	$MULTILANG_FrmTipo6='(एक लेबल के रूप में) रिच टेक्स्ट';
	$MULTILANG_FrmTipo7='आवरण (iFrame)';
	$MULTILANG_FrmTipoTit3='आंतरिक वस्तुओं';
	$MULTILANG_FrmTipo8='रिपोर्ट पहले से डिज़ाइन (डेटा तालिका या ग्राफ़)';
	$MULTILANG_FrmTipo9='स्लाइडर (संख्यात्मक सीमा चयनकर्ता - एचटीएमएल 5)';
	$MULTILANG_FrmTipo10='पासवर्ड क्षेत्र';
	$MULTILANG_FrmTipo11='लेबल के रूप में मैदान मूल्य';
	$MULTILANG_FrmTipoTit4='विशेष डेटा नियंत्रण';
	$MULTILANG_FrmTipo12='संलग्न फाइल';
	$MULTILANG_FrmTipo13='कैनवास (आरेखण क्षेत्र - एचटीएमएल 5)';
	$MULTILANG_FrmTipo14='कैनवास (वेब कैमरा कब्जा - एचटीएमएल 5)';
	$MULTILANG_FrmTipo15='उप-प्रपत्र (क्वेरी और केवल पठनीय करने के लिए)';
    $MULTILANG_FrmTipo16='कमांड बटन';
    $MULTILANG_FrmTipo17='बड़े पैमाने पर स्वरूपित पाठ क्षेत्र (उत्तरदायी)';
	$MULTILANG_FrmTipo18='क्षेत्र सत्यापित (चेक बॉक्स)';
	$MULTILANG_FrmTipoPincel='ब्रश का आकार';
	$MULTILANG_FrmTipoColor='रेखा रंग';
	$MULTILANG_FrmTipoAdvertencia='डेटा नियंत्रण के इस तरह के एक लंबे पाठ या असीमित क्षेत्र में अपनी तालिका में संग्रहित किया जाना चाहिए';
	$MULTILANG_FrmValorMinimo='न्यूनतम मूल्य';
	$MULTILANG_FrmValorMaximo='ज्यादा से ज्यादा मूल्य';
	$MULTILANG_FrmValorSalto='चरण मूल्य';
	$MULTILANG_FrmTitValorSalto='कितने इकाइयों प्रत्येक आंदोलन पर स्लाइडर कूद?';
	$MULTILANG_FrmTitulo='शीर्षक या टैग';
	$MULTILANG_FrmDesTitulo='उपयोगकर्ता दर्ज होना चाहिए कि जानकारी बता रही है क्षेत्र के बगल में दिखाई देगा कि पाठ। आप अतिरिक्त प्रारूप करने के लिए मूल HTML का उपयोग कर सकते हैं.';
	$MULTILANG_FrmCampo='लिंक्ड क्षेत्र';
	$MULTILANG_FrmFiltroLista='सूची फिल्टर हालत';
	$MULTILANG_FrmDesFiltroLista='विशेष स्थिति के रिकॉर्ड प्रदर्शित करने के लिए आपके पास आवश्यक। इस हालत में भी मूल्यों के रूप में चयनित नहीं हैं कि अपने स्रोत तालिका में किसी भी क्षेत्र इस्तेमाल कर सकते हैं। फिक्स्ड मूल्यों डबल cuotes में संलग्न किया जाना चाहिए और आप इस क्षेत्र क्वेरी में एक कहां clausule बाद में जोड़ दिया जाएगा आदि आदेश से, समूह द्वारा सीमा की तरह एक और expresions उपयोग कर सकते हैं। याद रखें: आप एक शर्त है न, लेकिन आप condittion को लागू करने के लिए पहले तब तक या समूह द्वारा एक आदेश में कम से कम एक 1 = 1 जोड़ने चाहते हैं। आप एक PHP चर भी उल्लेख करने के लिए {$ चर} इस्तेमाल कर सकते हैं';
	$MULTILANG_FrmCampoOb1='डेटा नियंत्रण बाध्यकारी के लिए अनिवार्य क्षेत्र';
	$MULTILANG_FrmDesCampo='जानकारी कड़ी होगी जो फील्ड डेटा तालिका। फ़ाइल क्षेत्रों में इस सर्वर में अपलोड की गई फ़ाइल के सापेक्ष पथ को नियंत्रित कर सके। हर फाइल अपने पथ स्टोर करने के लिए कम से कम एक क्षेत्र होना चाहिए';
	$MULTILANG_FrmValUnico='एकल मान क्षेत्र';
	$MULTILANG_FrmTitUnico='इनपुट मूल्यों के लिए विशिष्टता';
	$MULTILANG_FrmDesUnico='क्षेत्र की दुकान या डेटाबेस में मान दोहराया जा सकता है या नहीं। प्राथमिक उनके डिजाइन में कुंजी और आराम के लिए अक्षम लोगों का प्रतिनिधित्व करने वाले क्षेत्रों के लिए सक्षम होना चाहिए। कि आप उन्नयन और अपने दोहराया त्रुटि संदेश क्या करने के लिए इस क्षेत्र की जरूरत है कि रूपों में आपको ध्यान रखना चाहिए.';
	$MULTILANG_FrmPredeterminado='डिफ़ॉल्ट मान';
	$MULTILANG_FrmDesPredeterminado='स्वचालित रूप से प्रपत्र दृश्य को खोलने के लिए क्षेत्र में भरा प्रतीत होता है कि मूल्य सेट। यह मान डेटा मान्यता से बाहर हो सकता है। एक PHP सत्र चर दर्ज किया गया है तो Practico अपने मूल्य के लिए ले जाएगा.';
	$MULTILANG_FrmValida='डेटा मान्य';
	$MULTILANG_FrmValida1='संख्या केवल 0-9';
	$MULTILANG_FrmValida2='केवल अक्षर ए-ज़ेड';
	$MULTILANG_FrmValida3='पत्र और नंबर';
	$MULTILANG_FrmValida4='एकीकृत कैलेंडर का उपयोग दिनांक क्षेत्र';
	$MULTILANG_FrmValida7='अलग हो बीनने का उपयोग करने की तिथि क्षेत्र (वर्ष, महीना और दिन)';
	$MULTILANG_FrmValida5='समय क्षेत्र';
	$MULTILANG_FrmValida6='दिनांक और समय क्षेत्र';
	$MULTILANG_FrmValida8='एकीकृत चयनकर्ता का उपयोग करते हुए दिनांक और समय क्षेत्र';
	$MULTILANG_FrmValidaDes='उपयोगकर्ता कीबोर्ड से जानकारी में प्रवेश करती है जब फिल्टर प्रकार लागू किया जाएगा';
	$MULTILANG_FrmLectura='केवल क्षेत्र पढ़ें';
	$MULTILANG_FrmTitLectura='आप अपने मूल्य बदल सकते हैं या नहीं कर सकते हैं कि क्या परिभाषित करता है';
	$MULTILANG_FrmDesLectura='मान प्रदर्शित लेकिन संशोधन की अनुमति नहीं करने के लिए आवश्यक है जो उपयोगकर्ता की क्वेरी से खेतों या रूपों के लिए संपत्ति उपयोगी';
	$MULTILANG_FrmAyuda='सहायता शीर्षक';
	$MULTILANG_FrmDesAyuda='दर्ज करने के लिए क्या उपयोगकर्ता को समझा क्षेत्र मदद पाठ के लिए एक शीर्षक के रूप में दिखाई देगा कि पाठ';
	$MULTILANG_FrmTxtAyuda='मदद पाठ';
	$MULTILANG_FrmDesTxtAyuda='क्षेत्र के लिए सारांश समारोह के विवरण के साथ पूर्ण पाठ। आप उपयोगकर्ता के लिए स्वरूपण निर्देश, चेतावनी या किसी भी अन्य संदेश शामिल कर सकते हैं';
	$MULTILANG_FrmDesPeso='यह स्क्रीन पर प्रदर्शित किया जाता है जब स्थिति में जो क्षेत्र फॉर्म में दिखाई देता है। क्रम.';
	$MULTILANG_FrmDesColumna='प्रपत्र दृश्य कई कॉलम है जब कॉलम क्षेत्र का पता लगाने के लिए। फार्म में परिभाषित स्तंभों से बड़ा उन क्षेत्रों बनाया नहीं जाएगा';
	$MULTILANG_FrmObligatorio='अनिवार्य';
	$MULTILANG_FrmVisible='दर्शनीय';
	$MULTILANG_FrmDesVisible='नियंत्रण दिखाई दे या नहीं उपयोगकर्ता के लिए है कि क्या निर्धारित करता है। छोड़ दिया नियंत्रण नहीं किया जाता है तो लेकिन एक छुपा के रूप में';
	$MULTILANG_FrmLblBusqueda='रिकॉर्ड खोज के लिए प्रयोग करें? लेबल';
	$MULTILANG_FrmTitBusqueda='क्षेत्र के रिकॉर्ड के लिए खोज करने के लिए प्रयोग किया जाता है कि क्या यह बताता है';
	$MULTILANG_FrmDesBusqueda='यह एक सामान्य क्षेत्र संकेत मिलता है कि या रिकॉर्ड के लिए खोज करने के लिए सही पक्ष पर स्थित कमांड बटन में जाना चाहिए कि लेबल दर्ज करने के लिए खाली छोड़ें';
	$MULTILANG_FrmAjax='खोज करने के लिए AJAX का उपयोग (all items)';
	$MULTILANG_FrmAjaxDinamico='Use AJAX to retrieve items dinamically when you type';
	$MULTILANG_FrmTitAjax='रिकॉर्ड वसूली मोड';
	$MULTILANG_FrmDesAjax='बॉक्स पर दिया जाता है, तो Practico AJAX का उपयोग कर फार्म के लिए प्रवेश जानकारी को पुनः प्राप्त करने के लिए प्रयास करता है। एक मेज से अपनी मान लेता है कि किसी कॉम्बो बॉक्स में आप ऑनलाइन अपनी सामग्री को ताज़ा करने के लिए एक बटन जोड़ने के लिए इसका इस्तेमाल कर सकते.';
	$MULTILANG_FrmTeclado='वर्चुअल कीबोर्ड जोड़ें';
	$MULTILANG_FrmTitTeclado='ऑन-स्क्रीन कीबोर्ड से डेटा प्रवेश की अनुमति';
	$MULTILANG_FrmDesTeclado='फॉर्म में सक्षम होने पर जानकारी दर्ज करने के लिए एक आभासी कीबोर्ड प्रदर्शित करता है,. सत्यापन का उल्लंघन हो सकता है अब कीबोर्ड का उपयोग करने के लिए';
	$MULTILANG_FrmAncho='चौड़ाई';
	$MULTILANG_FrmTitAncho='कैसे विस्तृत अंतरिक्ष नियंत्रण ले लेना चाहिए';
	$MULTILANG_FrmDesAncho='IMPORTANT: in characters number for simple text fields and pixels rich-text fields. Enter a number of columns, however, note that the width in pixels will vary according to the type of font used by the current theme.  For image or bar code fields this value is for the size of the picture.  For canvas objects you can specify the width and the final scale percent using a pipe character. IE: 400|0.3 will create a 400 pixels object but it will save it as 30% of scale.';
	$MULTILANG_FrmDesAncho2='अमीर-पाठ प्रारूप क्षेत्रों के लिए अनुशंसित न्यूनतम: 350';
	$MULTILANG_FrmAlto='ऊँचाई (पंक्तियां)';
	$MULTILANG_FrmTitAlto='नियंत्रण में दिखाई दे कितने पंक्तियों होना चाहिए?';
	$MULTILANG_FrmDesAlto='महत्वपूर्ण: साधारण पाठ के लिए या अमीर-पाठ स्वरूपण के लिए पिक्सल में पंक्तियों की संख्या। पाठ से अधिक है तो पंक्तियों की संख्या स्वचालित रूप से स्क्रॉल जोड़ रहे हैं। छवि या बार कोड क्षेत्रों के लिए यह मान चित्र के आकार के लिए है.';
	$MULTILANG_FrmDesAlto2='न्यूनतम सिफारिश प्रारूप क्षेत्रों: 100';
	$MULTILANG_FrmBarra='प्रारूपण बार';
	$MULTILANG_FrmBarraCKEditor='के लिए उपलब्ध CKEditor';
	$MULTILANG_FrmBarraSummer='के लिए उपलब्ध SummerNote (उत्तरदायी)';
	$MULTILANG_FrmBarraTipo1='मूल दस्तावेज़, चरित्र और पैरा स्वरूपण';
	$MULTILANG_FrmBarraTipo2='मानक: + बेसिक लिंक और फ़ॉन्ट शैली';
	$MULTILANG_FrmBarraTipo3='विस्तारित: मानक + क्लिपबोर्ड, खोज की जगह है और वर्तनी';
	$MULTILANG_FrmBarraTipo4='उन्नत: विस्तारित + डालें वस्तुओं और रंग';
	$MULTILANG_FrmBarraTipo5='पूर्ण: उन्नत + फार्म और पूर्ण स्क्रीन';
	$MULTILANG_FrmBarraTipo1Summer='बेसिक: चरित्र और पैरा स्वरूपण';
	$MULTILANG_FrmBarraTipo2Summer='मानक: बेसिक + फ़ॉन्ट शैली';
	$MULTILANG_FrmBarraTipo3Summer='विस्तारित: मानक + टेबल्स, लिंक और लाइनों';
	$MULTILANG_FrmBarraTipo4Summer='उन्नत: + फुलस्क्रीन और HTML स्रोत विस्तारित';
	$MULTILANG_FrmBarraTipo5Summer='पूर्ण: उन्नत + डालें चित्र और वीडियो';
	$MULTILANG_FrmTitBarra='संपादक प्रकार का इस्तेमाल किया';
	$MULTILANG_FrmDesBarra='नियंत्रण और संपादन के विभिन्न कार्य करने के लिए उपयोगकर्ता के शीर्ष पर दिखाई देने वाले उपकरण पट्टी के प्रकार इंगित करता है। महत्वपूर्ण: संपादक के प्रत्येक प्रकार यह चिह्न और विभिन्न विकल्पों में से एक नंबर को तैनात करना चाहिए के रूप में फार्म पर एक अलग स्थान की आवश्यकता है';
	$MULTILANG_FrmFila='इस उद्देश्य के लिए एकल पंक्ति?';
	$MULTILANG_FrmTitFila='Practico वस्तु के लिए एक पूर्ण पंक्ति उपयोग करना चाहिए?';
	$MULTILANG_FrmDesFila='के रूप में प्रयोग तालिका का एक अनूठा पंक्ति में वस्तु प्रदर्शित करने के लिए अनुमति देता है';
	$MULTILANG_FrmLista='विकल्पों की सूची';
	$MULTILANG_FrmTitLista='क्या विकल्प चुना जा रहे हैं। शुरुआत में एक खाली मान रखा है कि Practico कहने के लिए केवल एक अल्पविराम चरित्र दर्ज करें। स्थापित पहले रिकॉर्ड डिफ़ॉल्ट के रूप में उपयोग करने के लिए रिक्त में छोड़ दो.      Enter _OPTGROUP_|Label to group some options and _OPTGROUP_ only to close groups of options.';
	$MULTILANG_FrmDesLista='अल्पविराम के द्वारा अलग विकल्पों की सूची दर्ज करें। आप विकल्प के लिए डेटा स्रोत क्षेत्रों का उपयोग करने के लिए किसी अन्य अनुप्रयोग से गतिशील रूप विकल्पों तालिका लेने की जरूरत है। परिणाम संयोजन किया जाएगा (फिक्स्ड सूची और डेटा स्रोत) दोनों विकल्प भरने चाहिए';
	$MULTILANG_FrmDesLista2='अल्पविराम अलग किया';
	$MULTILANG_FrmOrigen='विकल्पों की सूची स्रोत';
	$MULTILANG_FrmTitOrigen='आप मूल्यों की सूची में से एक ही स्रोत (टेबल) निर्दिष्ट करना होगा';
	$MULTILANG_FrmDesOrigen='जिसमें से फील्ड सूची प्रदर्शित करता है कि विकल्प बना रहे हैं';
	$MULTILANG_FrmTitOrigen2='यह क्या है?';
	$MULTILANG_FrmOrigenVal='मूल्यों स्रोत की सूची';
	$MULTILANG_FrmTitOrigenVal='आप विकल्पों की सूची से एक ही स्रोत (टेबल) निर्दिष्ट करना होगा';
	$MULTILANG_FrmDesOrigenVal='फील्ड जहाँ से मूल्यों की सूची में प्रत्येक विकल्प के लिए (संसाधित करने के लिए) आंतरिक रूप से लिया जाता है.     If the field value contains _OPTGROUP_|Label this will create a group of options and if the value is  _OPTGROUP_ only then this will close the group of options.';
	$MULTILANG_FrmEtiqueta='लेबल के मूल्य (यह एचटीएमएल प्रारूप में फार्म पर मुद्रित किया जाएगा)';
	$MULTILANG_FrmURL='आईफ्रेम यूआरएल';
	$MULTILANG_FrmDesURL='Iframe में एम्बेडेड हो जाएगा कि पेज के पते दर्ज करें';
	$MULTILANG_FrmInforme='लिंक्ड रिपोर्ट';
	$MULTILANG_FrmFormulario='लिंक्ड उप प्रपत्र';
	$MULTILANG_FrmDesCampoVinculo='यहां स्थानीय खेतों नाम (माता पिता के फार्म क्षेत्र) रखो उप-प्रपत्र में खोज डेटा के लिए इस्तेमाल किया जाएगा';
	$MULTILANG_FrmDesCampoForaneo='यहाँ डाल उप-प्रपत्र से दायर विदेशी तुलना करने के लिए या स्थानीय क्षेत्र में खोज डेटा डेटा दिखाने के लिए इस्तेमाल किया जाएगा।';
	$MULTILANG_FrmVentana='वस्तु के लिए एक खिड़की बनाएँ?';
	$MULTILANG_FrmDesVentana='आप ग्राफिक प्रकार रिपोर्टों एम्बेड करना चाहते हैं जब यह इस क्षेत्र को सक्रिय करने की सिफारिश नहीं है';
	$MULTILANG_FrmLongMaxima='ज्यादा से ज्यादा लंबाई';
	$MULTILANG_FrmTit1LongMaxima='कितने पात्रों क्षेत्र स्टोर कर सकते हैं?';
	$MULTILANG_FrmTit2LongMaxima='1 और एन, 0 के बीच मूल्य सीमा को निष्क्रिय करने के लिए';
	$MULTILANG_FrmBtnGuardar='जोड़ें या वस्तु / क्षेत्र का अद्यतन';
	$MULTILANG_FrmAgregaBot='Aडीडी बटन और फार्म के लिए कार्रवाई';
	$MULTILANG_FrmTituloBot='शीर्षक या टैग';
	$MULTILANG_FrmDesBot='पाठ बटन पर प्रदर्शित करने के लिए';
	$MULTILANG_FrmEstilo='अंदाज';
	$MULTILANG_FrmDesEstilo='नियंत्रण के लिए ग्राफिकल उपस्थिति';
	$MULTILANG_FrmTipoAccion='प्रक्रिया का प्रकार';
	$MULTILANG_FrmAccionT1='आंतरिक क्रियाओं';
	$MULTILANG_FrmAccionGuardar='डेटा सहेजें';
	$MULTILANG_FrmAccionLimpiar='साफ डेटा';
	$MULTILANG_FrmAccionEliminar='डेटा हटाएं (एक अनूठा मूल्य क्षेत्र की आवश्यकता है, यहां तक कि छिपी हुई)';
	$MULTILANG_FrmAccionActualizar='अद्यतन आकड़ें';
	$MULTILANG_FrmAccionRegresar='डेस्कटॉप पर वापस जाएं';
	$MULTILANG_FrmAccionCargar='वस्तु भार';
	$MULTILANG_FrmAccionT2='उपयोगकर्ता परिभाषित';
	$MULTILANG_FrmAccionExterna='Personalizadas.php में या किसी भी अन्य मॉड्यूल स्थापित';
	$MULTILANG_FrmAccionJS='जावास्क्रिप्ट आदेश';
	$MULTILANG_FrmDesAccion='नियंत्रण जब क्लिक कमान चलाने के लिए। निर्धारित कार्य है personalizadas.php फार्म डाटा प्रोसेसिंग के लिए है कि नियमित करने के लिए भेजा जाएगा';
	$MULTILANG_FrmAccionCMD='उपयोगकर्ता का आदेश';
	$MULTILANG_FrmAccionDesCMD='चाहिए personalizadas.php या (आप sigle उन्हें बंद करने के लिए उद्धरण चिह्नों का उपयोग कर सकता है कुछ पैरामीटर भेजने की जरूरत है तो) जानकारी या एक जावास्क्रिप्ट आदेश inmediately अनुप्रयोग के लिए निष्पादित की जाने वाली कार्रवाई करेंगे कि किसी भी अन्य मॉड्यूल में मौजूद है कि कार्रवाई के नाम पर। \'XX ... ImprimirMarco (बुलाया उपलब्ध एक जावास्क्रिप्ट आदेश है: एफ आर: XX: Par1: Par2: ParN ओ संसाधनों आप एक रूपों की तरह Practicos वस्तुओं लोड या आप menues मदों के लिए इस्तेमाल किया वही sintax इस्तेमाल कर सकते रिपोर्ट करने के लिए की जरूरत है आप सक्रिय रूप सामग्री मुद्रित करते हैं कि PCO_MarcoImpresionXX \')। \': //www.google.com \ HTTP\', \'YourTitle \' \'टूलबार = नहीं, स्थान = नहीं, निर्देशिका = नहीं, स्थिति = नहीं, मेनू बार = नहीं, स्क्रॉल तुम \ PCO_VentanaPopup (जैसे आदेशों का उपयोग कर सकते हैं = नहीं, resizable = हाँ, फुलस्क्रीन = नहीं, चौड़ाई = 640, ऊंचाई = 480 \'); एक पूरा गाइड के लिए .Check डॉक्स।';
	$MULTILANG_FrmDesPeso='यह स्क्रीन पर प्रदर्शित किया जाता है जब स्थिति में जो क्षेत्र फार्म की स्थिति पट्टी में दिखाई देता है। बाएं से दाएं आदेश';
	$MULTILANG_FrmBotDesVisible='उपयोगकर्ता के लिए नियंत्रण दिख रहा है कि क्या निर्धारित करता है या नहीं';
	$MULTILANG_FrmRetorno='वापसी का शीर्षक';
	$MULTILANG_FrmDesRetorno='उपयोगकर्ता द्वारा संकेत क्रिया करने के बाद डेस्कटॉप पर एक हेडर के रूप में दिखाई देगा कि पाठ';
	$MULTILANG_FrmTxtRetorno='वापसी का पाठ';
	$MULTILANG_FrmTxtDesRetorno='कार्रवाई ले लिया है या नियंत्रण चलने के बाद उपयोगकर्ता संदेश को डिलीवर के विवरण के साथ पूर्ण पाठ';
	$MULTILANG_FrmTxtRetornoIcono='वापसी के लिए चिह्न';
	$MULTILANG_FrmTxtDesRetornoIcono='संदेश में डाल करने के लिए एक आइकन सेट करें। AwesomeFonts अंकन का प्रयोग करें। आईई: एफए-जानकारी-चक्र एक जानकारी आइकन दिखाने के लिए।';
	$MULTILANG_FrmTxtRetornoEstilo='वापसी संदेश के लिए सीएसएस शैली (लागू होता है)';
	$MULTILANG_FrmConfirma='संपुष्टि पाठ';
	$MULTILANG_FrmDesConfirma='इसके भरा है, पाठ कि एक पॉपअप चेतावनी नियंत्रण निष्पादन के रूप में दिखाई देगा और उपयोगकर्ता की पुष्टि के लिए इंतजार कर आगे बढ़ने के लिए है';
	$MULTILANG_FrmBtnGuardarBut='लड़ाई / बटन जोड़ें';
	$MULTILANG_FrmDisCampos='जनरल क्षेत्रों डिजाइन';
	$MULTILANG_FrmDesObliga='आवश्यक फ़ील्ड दिखाई जानी चाहिए कि नोट';
	$MULTILANG_FrmGuardaCol='सहेजें स्तंभ';
	$MULTILANG_FrmAumentaPeso='(नीचे) के वजन में वृद्धि';
	$MULTILANG_FrmDisminuyePeso='(उत्तर प्रदेश) वजन घटाएं';
	$MULTILANG_FrmHlpCambiaEstado='अवस्था बदलो';
	$MULTILANG_FrmAdvDelCampo='महत्वपूर्ण: इस क्षेत्र को हटाया जा रहा है उपयोगकर्ताओं को यह नहीं देख सकते हैं और है कि इस कार्य पूर्ववत नहीं कर सकते.\n'.$MULTILANG_Confirma;
	$MULTILANG_FrmTitComandos='कार्यों और आदेशों की सामान्य परिभाषा';
	$MULTILANG_FrmTipoAcc='प्रक्रिया का प्रकार';
	$MULTILANG_FrmAccUsuario='उपयोगकर्ता की क्रिया';
	$MULTILANG_FrmOrden='आदेश';
	$MULTILANG_FrmAdvDelBoton='महत्वपूर्ण: बटन हटा / कार्रवाई उपयोगकर्ताओं को देखने या इस के साथ जुड़े आदेश को चलाते हैं और आप इस ऑपरेशन के बाद में पूर्ववत नहीं कर सकते नहीं कर सकते.\n'.$MULTILANG_Confirma;
	$MULTILANG_FrmObjetos='वस्तुओं और डेटा फ़ील्ड';
	$MULTILANG_FrmDesObjetos='एक वस्तु या डेटा फ़ील्ड जोड़ें';
	$MULTILANG_FrmDesCampos='फील्ड्स सामान्य डिजाइन';
	$MULTILANG_FrmAcciones='प्रक्रिया, बटन और आदेश';
	$MULTILANG_FrmDesBoton='बटन या कार्रवाई जोड़ें';
	$MULTILANG_FrmDesAcciones='कार्यों की सामान्य परिभाषा';
	$MULTILANG_FrmVolverLista='वापस रूपों की सूची में';
	$MULTILANG_FrmErr1='आप फार्म के लिए एक वैध शीर्षक दर्ज करना होगा.';
	$MULTILANG_FrmErr2='फार्म के साथ जुड़े डेटा तालिका के लिए मान्य नाम निर्दिष्ट करें.';
	$MULTILANG_FrmAgregar='नए रूप में जोड़ें';
	$MULTILANG_FrmActualizar='प्रारंभिक विन्यास अद्यतन';
	$MULTILANG_FrmDetalles='फार्म विवरण को परिभाषित';
	$MULTILANG_FrmTitVen='विंडो शीर्षक';
	$MULTILANG_FrmDesTit='विंडो के शीर्ष पर प्रकट होने वाले पाठ';
	$MULTILANG_FrmHlp='सहायता शीर्षक';
	$MULTILANG_FrmDesHlp='प्रपत्र के समर्थन के लिए एक शीर्षक के रूप में दिखाई देगा कि पाठ';
	$MULTILANG_FrmTxt='मदद पाठ';
	$MULTILANG_FrmDesTxt='फार्म के लिए सारांश समारोह के विवरण के साथ पूर्ण पाठ। किसी भी उपयोगकर्ता के लिए परिचयात्मक पाठ';
	$MULTILANG_FrmImagen='पृष्ठभूमि का रंग';
	$MULTILANG_FrmImagenDes='कृपया अपने वेब ब्राउजर एचटीएमएल 5 का समर्थन किया है, तो आप पृष्ठभूमि रंग चुन सकते हैं। आप एक हेक्साडेसिमल रंग # F2F2F2 यानी कोड या HTML अंकन के रूप में अपने नाम टाइप कर सकते हैं यदि नहीं, यानी LightGray';
	$MULTILANG_FrmNumeroCols='स्तंभों की संख्या';
	$MULTILANG_FrmDesNumeroCols='फार्म लोड होने पर कितने कॉलम क्षेत्रों में तैनात किया जा को इंगित करता है';
	$MULTILANG_FrmCreaDisena='बनाएँ और डिजाइन';
	$MULTILANG_FrmTitForms='प्रणाली में परिभाषित प्रपत्र';
	$MULTILANG_FrmCamposAcciones='फील्ड्स और कार्रवाई';
	$MULTILANG_FrmAdvDelForm='महत्वपूर्ण: फार्म उपयोगकर्ताओं को हटाने परिभाषित क्वेरी कार्रवाई या डेटा प्रविष्टि के लिए इसे फिर से उपयोग नहीं कर सकते। आप इस कार्रवाई को पूर्ववत नहीं कर सकते हैं। यह भी फार्म के किसी भी आंतरिक डिजाइन समाप्त.\n'.$MULTILANG_Confirma;
	$MULTILANG_FrmAdvScriptForm='स्क्रिप्ट संपादित (उन्नत)';
	$MULTILANG_FrmHlpFunciones='यहां निर्धारित सभी जावास्क्रिप्ट कार्यों के रूप में शामिल किया जाएगा.<br>यह हर रूप लोड पर स्वचालित रूप से क्रियान्वित किया जाएगा कारण FrmAutoRun समारोह (यहां तक कि खाली) मौजूद किया जाना चाहिए.';
	$MULTILANG_FrmCopiar='एक प्रति बनाएँ';
	$MULTILANG_FrmAdvCopiar='इस वस्तु की एक नई प्रतिलिपि बनाई जाएगी। क्या आपको यकीन है?';
	$MULTILANG_FrmMsjCopia='अब आप अपने नए ऑब्जेक्ट को संपादित करने के लिए जा सकते हैं। एक प्रति के रूप maded किया गया था: ';
	$MULTILANG_FrmBordesVisibles='तालिका दिखाई दे सीमाओं हैं?';
	$MULTILANG_FrmFormatoSalida='आउटपुट स्वरूप';
	$MULTILANG_FrmFormatoEntrada='इनपुट प्रारूप';
	$MULTILANG_FrmPlantillaArchivo='फ़ाइल के लिए नाम टेम्पलेट';
	$MULTILANG_FrmDesPlantillaArchivo='टेम्पलेट प्रपत्र या सर्वर पर अपलोड उपयोगकर्ता के बाद फाइल का नाम होगा कि पैटर्न है। इस उदाहरण के रूप में उसका नाम और एक्सटेंशन को बदलने के लिए विभिन्न चर शामिल हो सकते हैं। फ़ाइलें फ़ोल्डर प्रणाली भार के मूल नाम के साथ लोड कर रहे हैं कि (सुरक्षा के लिए अनुशंसित नहीं) तो आप भी इसे खाली छोड़ सकते हैं.';
	$MULTILANG_FrmErrorCargaGeneral='एक त्रुटि अपलोड करने के दौरान हुई थी';
	$MULTILANG_FrmErrorCargaTamano='फ़ाइल आकार की अनुमति आकार से बड़ा है';
	$MULTILANG_FrmPlantillaEjemplos='<i>कुछ प्रारूप संशोधक:<li>_ORIGINAL_ : मूल फ़ाइल का नाम</li><li>_CAMPOTABLA_ : टेबल पर लिंक्ड क्षेत्र का नाम</li><li>_FECHA_ : में वास्तविक तारीख AAAAMMDD format</li><li>_HORA_ : में वास्तविक सर्वर समय  HHMMSS format</li><li>_MICRO_ : Time microseconds</li><li>_HORAINTERNET_ : के बीच इंटरनेट का समय 000 - 999</li><li>_USUARIO_ : उपयोगकर्ता लॉगिन नाम</li><li>_EXTENSION_ : अपलोड की फाइल का एक्सटेंशन</li></i><b>उदाहरण:</b><li>_USUARIO__ORIGINAL_: उपयोगकर्ता नाम लॉगिन के साथ मूल फ़ाइल का नाम बदलता</li><li>formatos/_ORIGINAL_: मूल नाम का उपयोग करते हुए एक formatos / फ़ोल्डर में फाइल अपलोड करेंगे। यह फ़ोल्डर cargas फ़ोल्डर में फ़ाइल प्रबंधक उपयोग करने से पहले व्यवस्थापक उपयोगकर्ता द्वारा बनाया जाना है.</li><li>_FECHA__HORA__USUARIO_.pdf: ऐसा कुछ के लिए सभी मूल फ़ाइल का नाम बदलता 20140502_135400_admin.pdf</li><li>reportes/_FECHA_.xls: Reportes फ़ोल्डर में फाइल अपलोड करेंगे और करने के लिए अंतिम विस्तार के लिए मजबूर करेंगे .xls too.</li><li>foto__USUARIO_.jpg: इस फ़ाइल में दो तय तार होगा (foto_ at beginning and .jpg at the end)  लेकिन उन्हें अंदर Practico उपयोगकर्ता नाम संलग्न करेंगे. उनमें से एक का नाम अलग कर देगा, डबल रेखांकित चरित्र पर ध्यान दे और अन्य प्रारूप संशोधक के लिए है.  आप की तरह कुछ प्राप्त करेंगे foto_avelez.jpg</li>एक सामान्य नियम: किसी भी स्वरूप संशोधक न मैच उस पैटर्न के अंदर किसी भी स्ट्रिंग फ़ाइल के नाम में एक निश्चित स्ट्रिंग हो जाएगा.';
	$MULTILANG_FrmArchivoLink='[पहले से ही खुले अपलोड की गई फ़ाइल]';
	$MULTILANG_FrmCanvasLink='[ओपन ड्राइंग पहले से ही जोड़ा]';
	$MULTILANG_FrmErrorCam='वीडियो डिवाइस के साथ कोई त्रुटि है। यदि आप एक वीडियो डिवाइस या वेब कैमरा स्थापित किया है कि cheack करें और आप Afirmative जवाब या Practico डिवाइस का उपयोग करने के लिए अनुमति देने के लिए अपने ब्राउज़र में स्वीकार करें.';
    $MULTILANG_FrmPestana='नियंत्रण प्रकाशित किया जाएगा जिसमें टैब शीर्षक है-';
    $MULTILANG_FrmDesPestana='फार्म में इस उद्देश्य के लिए टैब निरुपित। Practico स्वचालित रूप से प्रत्येक वस्तु में दर्ज किए गए मूल्यों के अनुसार टैब बनाता है.  यदि आप एक पीसीओ_निवेब टैब निर्दिष्ट करते हैं, तो बरौनी मानक उपयोगकर्ताओं को प्रकट नहीं होगी (यह छिपाई जाएगी) लेकिन उनके तत्वों को सामान्य रूप से उन्हें प्रोसेस करने के लिए फ़ॉर्म में जोड़ा जाएगा।';
    $MULTILANG_FrmTagPersonalizado='एचटीएमएल कस्टम टैग';
    $MULTILANG_FrmDesTagPersonalizado='Practico द्वारा फार्म खत्म बनाया एचटीएमएल टैग करने के लिए मापदंडों को जोड़ने की अनुमति. 
            <br><b>का चयन सूची (कॉम्बो-बॉक्स):</b>
                <li><u>data-live-search=true</u> एक सूची में खोज क्षेत्र सक्षम करें.</li>
                <li><u>multiple</u> चयन के लिए कई सक्षम करें.</li>
                <li><u>data-selected-text-format=count</u> मूल्यों के बजाय चयनित आइटम गणना.</li>
                <li><u>data-max-options=#</u> तत्वों की अधिकतम चयनित.
                <li><u>data-size=auto|#</u> आइटम की सूची में पता चला रहे हैं कितने पंक्तियाँ.</li>
                <li><u>data-style=btn-primary|btn-info|btn-success|btn-warning|btn-danger|btn-inverse</u> ग्राफिक शैली
                <li><u>disabled</u> नियंत्रण अक्षम</li>
                <li><u>PCO_Delayed</u> If this keyword is found the load of the value is charged at onready time by javascript. Usefull when you have manual items in your combobox and you need to recover its value from the database on form load.</li>
                <BR>
                <b>Botones (command button):</b>
                <li><u>btn-group btn-group-justified</u> Expande control al ancho del contenedor.</li>
                <BR>
                <b>Checkboxes (checkbox):</b>
                <li><u>data-toggle=toggle</u> Convert this control to toggle button</li>
                <li><u>data-on=Text</u> Set text when the control is on. It could have HTML code and even icon declarations.</li>
                <li><u>data-off=Text</u> Same that previous property when control is off</li>
                <li><u>data-onstyle=Style</u> Set the style for the button: primary|info|warning|danger|success|default</li>
                <li><u>data-offstyle=Style</u> Same that previous property when control is off</li>
                <li><u>data-style=ControlType</u> Visual appearance:  ninguno|ios|android</li>
                <li><u>data-size=Size</u> Size of the control: large|normal|small|mini</li>
                <li><u>data-width=Width</u> Width of the control in pixels</li>
                <li><u>data-height=Height</u> Height of the control in pixels</li>';
    $MULTILANG_FrmBtnFull='फुल स्क्रीन में लोड';
    $MULTILANG_FrmBtnObjetivo='एचटीएमएल लक्ष्य';
    $MULTILANG_FrmActualizaAjax='गतिशील पुनः लोड';
    $MULTILANG_FrmActivarInline='<i>इन - लाइन</i> राय: अगले और पिछले तत्वों के साथ संयोजन के रूप में कार्य';
    $MULTILANG_FrmActivarInlineDes='पहले एक नई लाइन रखने के फार्म पर नियंत्रण प्रकाशित करने के लिए एक इनलाइन शैली का उपयोग नियंत्रण डाल देते हैं। आप चाहते हैं प्रभाव अनुसार, पिछले या अगले तत्व भी इस संपत्ति को सक्रिय करना चाहिए';
    $MULTILANG_FrmTipoCopia='क्या आप चाहते हैं नकल किस तरह का चयन';
    $MULTILANG_FrmTipoCopia1='ऑनलाइन';
    $MULTILANG_FrmTipoCopia2='XML वर्तमान के साथ ID';
    $MULTILANG_FrmTipoCopia3='XML गतिशील साथ ID';
    $MULTILANG_FrmTipoCopiaDes1='ऑनलाइन: एक नई पहचान के साथ एक नई वस्तु बनाता है। यही कारण है कि आप एक मौजूदा वस्तु से नए रूपों या रिपोर्ट बनाने की अनुमति देने के जुड़े सभी घटक शामिल हैं। यह चयनित वस्तु क्लोनिंग, चल व्यवस्था पर तुरंत काम करता है.';
    $MULTILANG_FrmTipoCopiaDes2='XML वर्तमान के साथ ID: एक्सएमएल सिंटैक्स का उपयोग निर्यात / आयात वस्तु मौजूदा आईडी का उपयोग कर आप अन्य व्यवस्था पर आयात की अनुमति है। आप अन्य प्रणालियों से संवर्द्धन के साथ रूपों या रिपोर्टों के ऊपर लिख करना चाहते हैं तो उपयोगी.';
    $MULTILANG_FrmTipoCopiaDes3='XML गतिशील साथ ID: निर्यात / आयात एक्सएमएल सिंटैक्स का उपयोग वस्तु लेकिन वस्तु के लिए नए आईडी एक अलग पहचान पत्र के साथ गतिशील आप फ़ाइल आयात हर बार उत्पन्न होता है। "ऑनलाइन" विकल्प की लेकिन विभिन्न प्रणालियों पर कार्यक्षमता को दोहराने के लिए उपयोगी.';
	$MULTILANG_FrmTipoCopiaExporta='प्रतिलिपि बनाई जा रही / निर्यात';
	$MULTILANG_FrmCopiaFinalizada='नकल की प्रक्रिया पहले से ही समाप्त हो गया। आप एक्सएमएल फ़ाइल को प्राप्त करने के लिए डाउनलोड बटन पर क्लिक कर सकते हैं.';
	$MULTILANG_FrmImportar='एक फ़ाइल से एक डिजाइन आयात';
	$MULTILANG_FrmImportarConflicto='आप आयात करने की प्रक्रिया के साथ आगे बढ़ने से पहले हल करने की जरूरत है कि संघर्ष कर रहे हैं';
	$MULTILANG_FrmImportarGenerado='नई वस्तु बना दिया गया है';
	$MULTILANG_FrmImportarAlerta='एक ही आंतरिक आईडी और आप आयात करना चाहते हैं उस प्रकार के साथ एक तत्व प्रणाली में स्थापित किया गया था। आप आयात करना चाहते हैं कि फ़ाइल वास्तविक वस्तु को नष्ट करेगा और फ़ाइल में तत्वों से भर देगी। हम आपको वास्तव में पहले की तरह जारी तत्व अधिलेखित करना चाहते हैं यदि आप पहले से जाँच करने की सिफारिश.';
	$MULTILANG_FrmValOnCheck= 'मूल्य जब सक्रिय होता है';
	$MULTILANG_FrmValOffCheck='मूल्य जब सक्रिय नहीं है';
	$MULTILANG_FrmValCheckDes='मूल्य निर्धारित नियंत्रण की स्थिति के अनुसार डेटाबेस में संग्रहीत किया जाएगा कि क्षेत्र के लिए आवंटित किया जाना';
	$MULTILANG_FrmEstiloPestanas='टैब्स शैली (यदि लागू होता है)';
	$MULTILANG_FrmEstiloTabs='टैब्स (nav-tab)';
	$MULTILANG_FrmEstiloPills='बटन (nav-pills)';
	$MULTILANG_FrmEstiloOculto='छिपा हुआ';
	$MULTILANG_FrmTextoPlaceHolder='प्लेसहोल्डर पाठ';
	$MULTILANG_FrmDesPlaceHolder='एक पाठ क्षेत्र में दिखाने के लिए जब यह एक मूल्य है कि उपयोगकर्ताओं को मदद पता है कि वहाँ क्या प्रवेश करना चाहिए नहीं है';
	$MULTILANG_FrmOcultarEtiqueta='फार्म में क्षेत्र लेबल छुपाएं';
	$MULTILANG_FrmIdHTML='HTML में वस्तु का अद्वितीय पहचानकर्ता';
	$MULTILANG_FrmValidaExtra='अतिरिक्त पात्रों की अनुमति दी';
	$MULTILANG_FrmValidaAyuda='यहां किसी भी पात्र को मान्यकर्ता के लिए अनुमति दी जाएगी';
	$MULTILANG_FrmValida9='नंबर केवल 0- 9 (पूर्णांक)';
	$MULTILANG_FrmValida10='अतिरिक्त सत्यापन फ़ील्ड में केवल अक्षरसेट';
	$MULTILANG_FrmNombreHTML='चेतावनी: यह मान एचटीएमएल में तत्व के अद्वितीय पहचानकर्ता उत्पन्न करने के लिए प्रयोग किया जाता है और इससे स्वचालित रूप से आपके प्रपत्र से जुड़े नियंत्रणों और उपकरणों की सभी घटनाएं उत्पन्न होती हैं। यदि आप इस मान को बदलते हैं तो आप सामान्य रूप से उस विशिष्ट इवेंट प्रोग्रामिंग और जावास्क्रिप्ट को खो सकते हैं जो आपने अपने परिवर्तन से पहले किया था।';
    $MULTILANG_FrmClaseContenedor='कंटेनर का सीएसएस वर्ग';
    $MULTILANG_FrmClaseContenedorDes='यह इंगित करने की अनुमति देता है कि ऑब्जेक्ट के कंटेनर के पास कुछ मूल सीएसएस या बूटस्ट्रैप स्क्रीन पर नियंत्रण को आरेखण के समय लागू करने के लिए निर्दिष्ट है।';
    $MULTILANG_FrmHuerfanos='अनाथ क्षेत्रों पाए गए हैं (फॉर्म के दृश्य डिजाइन के बाहर)।';
    $MULTILANG_FrmIDHTMDuplicado='डुप्लिकेट डेटाबेस में HTML आईडी या फ़ील्ड नाम वाले फ़ील्ड पाए गए हैं।';
    $MULTILANG_FrmCamposAProposito='ये फ़ील्ड वहां हैं और जेएस गियंस में फॉर्म की कार्यक्षमता को प्रभावित कर सकते हैं या आपके डेटा को प्रोसेस करते समय। यदि आपने उद्देश्य के इस क्षेत्र के फ़ील्ड को उद्देश्य पर जनरेट किया है तो इस संदेश को अनदेखा करें। पाए गए फ़ील्ड हैं:';
    $MULTILANG_FrmTipoMaquetacion='Type of layout';
    $MULTILANG_FrmTipoMaquetacionDes='Determine how Practico will make multi-column forms. Traditional: use tables and standard columns in HTML. Responsive: use columns based on bootstrap col classes, for which you must specify the class of each in the corresponding fields.';
    $MULTILANG_FrmTradicional='Traditional';
    $MULTILANG_FrmCampoHuerfano='This fields exists in the table linked to the form and doesnt have any field or object linked to them in the form or embeded forms';
    $MULTILANG_FrmDesplazarObjetos='Move down one position all the objects in the column below this element';
    $MULTILANG_FrmEstaSeguro='Are you sure?';


	//Informes
	$MULTILANG_InfErr1='आप कम से कम एक डेटा श्रृंखला के लिए इसी क्षेत्रों के लिए मूल्यों को निर्दिष्ट करना होगा। यदि आप एक ग्राफ उत्पन्न करने के लिए चाहते हैं न तो हिन्दी तो आप डेटा तालिका करने के लिए रिपोर्ट प्रकार में परिवर्तन करना होगा';
	$MULTILANG_InfErr2='आप रिपोर्ट के लिए एक वैध शीर्षक दर्ज करना होगा.';
	$MULTILANG_InfErr3='रिपोर्ट के जुड़े वर्ग के लिए मान्य नाम निर्दिष्ट करें.';
	$MULTILANG_InfErrCondicion='निर्दिष्ट शर्त अवैध है या तुलना के लिए कम से कम एक पक्ष का अभाव.';
	$MULTILANG_InfErrCampo='आप रिपोर्ट के डेटा स्रोत के लिए एक वैध क्षेत्र का नाम दर्ज करना होगा.';
	$MULTILANG_InfErrTabla='आप रिपोर्ट के डेटा स्रोत के लिए एक वैध तालिका नाम दर्ज करना होगा.';
	$MULTILANG_InfErr4='आप बटन के लिए एक वैध शीर्षक या लेबल दर्ज करना होगा.';
	$MULTILANG_InfErr5='आप नियंत्रण सक्रिय होता है जब एक वैध कार्रवाई निष्पादित किए जाने दर्ज करना होगा।';
	$MULTILANG_InfAgregaTabla='रिपोर्ट करने के लिए एक नया टेबल जोड़ें';
	$MULTILANG_InfTablaManual='स्वयं एक मेज दर्ज';
	$MULTILANG_InfDesTablaManual='आप शीर्ष सूची में से एक तालिका का चयन करना चाहते हैं न, तो आप यहां एक टेबल नाम टाइप कर सकते हैं। आप अन्य अनुप्रयोगों के द्वारा बनाई गई Practico या मेज की आंतरिक तालिकाओं में जानकारी का उपयोग करने की आवश्यकता है जब यह विकल्प उपयोगी है';
	$MULTILANG_InfAliasManual='मैन्युअल रूप से कोई अन्य नाम निर्दिष्ट करें';
	$MULTILANG_InfDesAliasManual='एक उप क्वेरी से उत्पन्न एक तालिका के नाम को परिभाषित करने के लिए उपयोगी है या मैन्युअल निर्दिष्ट';
	$MULTILANG_InfBtnAgregaTabla='तालिका में जोड़ें';
	$MULTILANG_InfTablasDef='इस रिपोर्ट में परिभाषित टेबल्स';
	$MULTILANG_InfAlias='उपनाम';
	$MULTILANG_InfAdvBorrado='महत्वपूर्ण: आपके द्वारा चयनित वस्तु को हटाते हैं क्वेरी या रिपोर्ट असंगत हो सकता है.\n'.$MULTILANG_Confirma;
	$MULTILANG_InfAgregaCampo='रिपोर्ट के एक नए क्षेत्र में जोड़ें';
	$MULTILANG_InfCampoDatos='डेटा क्षेत्र';
	$MULTILANG_InfCampoManual='मैन्युअल रूप से एक क्षेत्र निर्दिष्ट करें';
	$MULTILANG_InfDesCampoManual='तुम यहाँ एक क्षेत्र का नाम टाइप कर सकते हैं शीर्ष सूची में से एक क्षेत्र का चयन करना चाहते हैं न। आप Practico में अन्य अनुप्रयोगों के द्वारा बनाई गई आंतरिक क्षेत्रों या क्षेत्रों में जानकारी का उपयोग करने की आवश्यकता है जब यह विकल्प उपयोगी है';
	$MULTILANG_InfDesAliasManual2='मैन्युअल रूप से उत्पन्न एक क्षेत्र का नाम या एक समूहीकृत उप क्वेरी को परिभाषित करने के लिए उपयोगी';
	$MULTILANG_InfBtnAgregaCampo='क्षेत्र जोड़ें';
	$MULTILANG_InfCamposDef='इस रिपोर्ट में परिभाषित क्षेत्रों';
	$MULTILANG_InfAddCondicion='रिपोर्ट करने के लिए एक नई शर्त जोड़ें';
	$MULTILANG_InfPrimer='पहली बार मैदान या मूल्य';
	$MULTILANG_InfOperador='तुलना ऑपरेटर';
	$MULTILANG_InfSegundo='दूसरे क्षेत्र या मूल्य';
	$MULTILANG_InfMayorQue='से अधिक ';
	$MULTILANG_InfMenorQue='से कम';
	$MULTILANG_InfMayorIgualQue='से बड़ा या बराबर';
	$MULTILANG_InfMenorIgualQue='इससे कम या इसके बराबर';
	$MULTILANG_InfDiferenteDe='विभिन्न';
	$MULTILANG_InfIgualA='बराबर';
    $MULTILANG_InfPatron='मिलान पैटर्न (जोकर के रूप में% का उपयोग करता)';
	$MULTILANG_InfDesManual='किसी भी मैनुअल क्षेत्रों में आप दोहरे उद्धरण चिह्नों का उपयोग कर अभिव्यक्ति या चरित्र स्ट्रिंग मान बंद कर सकते हैं। आप सत्र वार्स पीएचपी चर डालने के साथ तुलना कर सकते हैं।  i.e.: $PCOSESS_LoginUsuario, $Nombre_usuario, $Descripcion_usuario, $Nivel_usuario, $Correo_usuario, $LlaveDePasoUsuario.  आप एक स्ट्रिंग के बीच में PHP चर का उपयोग करना चाहते हैं तो आप ब्रेसिज़ के अंदर डाल सकते हैं Ie: {$Variable} और वे अपने वैश्विक मूल्य से बदल दिया जाएगा.';
	$MULTILANG_InfOperador='अभिव्यक्ति की एक एग्रीगेटर या एक तार्किक ऑपरेटर जोड़ें ';
	$MULTILANG_InfOpParentesisA='खुला कोष्ठक';
	$MULTILANG_InfOpParentesisC='कोष्ठक करीब';
	$MULTILANG_InfOpAND='AND तार्किक';
	$MULTILANG_InfOpOR='OR तार्किक';
	$MULTILANG_InfOpNOT='NOT';
	$MULTILANG_InfOpXOR='XOR';
	$MULTILANG_InfTitOp='जब इस विकल्प का उपयोग करने के लिए?';
	$MULTILANG_InfDesOp='आप अपनी स्थिति को छानने समूह के परिणाम में जोड़ने के लिए एक से अधिक की सजा की आवश्यकता होती है या कुछ कार्रवाई पर पूर्वता ले करने के लिए कई स्थितियों की आवश्यकता है तो आप इस विकल्प का उपयोग कर सकते हैं। स्वतंत्र रूप से काम करता है और परामर्श के लिए एक अलग रिकॉर्ड के रूप में जोड़ा जाना चाहिए';
	$MULTILANG_InfReco1='सलाह';
	$MULTILANG_InfReco2='Ands रिपोर्ट के विभिन्न तालिकाओं के बीच विदेशी कुंजी को जोड़ने के प्रत्येक शर्त का पालन जोड़ने के लिए मत भूलना जहां लागू (आम तौर पर आप एक से अधिक तालिका का उपयोग करते समय).';
	$MULTILANG_InfBtnAddCondic='स्थिति / ऑपरेटर जोड़ें';
	$MULTILANG_InfDefCond='फ़िल्टर और इस रिपोर्ट में परिभाषित शर्तों';
	$MULTILANG_InfTitGrafico='चार्ट के प्रकार के रिपोर्ट के द्वारा उत्पन्न की जा करने के लिए निर्दिष्ट';
	$MULTILANG_InfSeriesGrafico1='चार्ट के लिए श्रृंखला';
	$MULTILANG_InfSeriesGrafico2='काधिक श्रृंखला के चार्ट लेबल की एक ही नंबर लौटना चाहिए';
	$MULTILANG_InfNomSerie='श्रृंखला का नाम';
	$MULTILANG_InfCampoEtiqSerie='लेबल फील्ड';
	$MULTILANG_InfCampoValor='मूल्य क्षेत्र (संख्यात्मक होनी चाहिए)';
	$MULTILANG_InfVistaGrafico1='प्रदर्शन और वितरण';
	$MULTILANG_InfVistaGrafico2='वांछित श्रृंखला की संख्या के हिसाब से चुनें';
	$MULTILANG_InfTipoGrafico='चार्ट प्रकार';
	$MULTILANG_InfGrafico1='क्षैतिज सलाखों';
	$MULTILANG_InfGrafico3='पंक्ति चार्ट';
	$MULTILANG_InfGrafico5='ऊर्ध्वाधर सलाखों';
	$MULTILANG_InfGrafico7='पाई चार्ट (केवल एक श्रृंखला)';
	$MULTILANG_InfActGraf='अद्यतन चार्ट प्रारूप';
	$MULTILANG_InfAgrupa='छँटाई मापदंड और समूह को निर्दिष्ट करता है';
	$MULTILANG_InfReco3='आपकी क्वेरी में परिभाषित केवल फ़ील्ड का उपयोग करें.';
	$MULTILANG_InfCriterioAgrupa='मापदंड समूहन';
	$MULTILANG_InfCriterioOrdena='आदेश मापदंड';
	$MULTILANG_InfTitAgrupa='परिणामों वर्गीकृत किया जाएगा कैसे?';
	$MULTILANG_InfDesAgrupa='अपनी रिपोर्ट में इस तरह प्रदर्शित क्षेत्रों के भीतर राशि, औसत या गिनती के रूप में अभियानों का संचालन केवल यदि इस विकल्प का प्रयोग करें। उदाहरण के लिए राशि (क्षेत्र), औसत (क्षेत्र), COUNT (*)। कि मामलों में (अल्पविराम द्वारा अलग) करना चाहिए समूह के परिणाम खेतों जो दर्ज';
	$MULTILANG_InfTitOrdena='परिणामों हल हो जाएगा कैसे?';
	$MULTILANG_InfDesOrdena='जोड़ा क्षेत्रों में से किसी का उपयोग कर परिणाम सॉर्ट करने के लिए। आप संशोधक ए एस सी या DESC उपयोग कर सकते हैं प्रत्येक क्षेत्र लग्न या उतरते बताएं कि क्या करने के बाद चाहें तो फील्ड्स, अपने परिणामों को सॉर्ट करने के लिए अल्पविराम के द्वारा अलग किया जाना चाहिए';
	$MULTILANG_InfActCriterios='मापदंड छँटाई और समूह को पुनः लोड करें';
	$MULTILANG_InfTitBotones='प्रत्येक रिकॉर्ड करने के लिए बटन या कार्रवाई जोड़ें';
	$MULTILANG_InfDelReg='रिकॉर्ड हटाएं';
	$MULTILANG_InfCargaForm='द्वारा एक फार्म लोड ID';
	$MULTILANG_InfHlpAccion='आप लोड करना चाहते हैं एक फार्म इस वाक्य रचना का उपयोग  ID:1:FieldForSearch<br>यह तुलना करने के लिए इस्तेमाल किया जुड़े रिकार्ड प्रकार को हटाने के लिए.';
	$MULTILANG_InfVinculo='लिंक्ड क्षेत्र';
	$MULTILANG_InfDesVinculo='महत्वपूर्ण: हम एक एकल और प्राथमिक कुंजी मान के रूप में पहली बार मैदान या स्तंभ मान<br>
				हटाने कर या खोलने के संचालन के लिए फार्म.<br>
				यह एक बहुत ही महत्व है कि क्षेत्रों का उपयोग करने के लिए सिफारिश की है<br>
				जब तक आप समूह के संचालन चाह रहे हैं.';
	$MULTILANG_InfDesPeso='प्रत्येक रिकॉर्ड के सही पक्ष पर सेट के भीतर दिखाई देने वाले बटन पर स्थिति। बाएं से दाएं आदेश.';
	$MULTILANG_InfFiltrar='विशिष्ट परिस्थितियों द्वारा फ़िल्टर परिणाम';
	$MULTILANG_InfCampoAgrupa='आप रिपोर्टिंग के संचालन योग, औसत के लिए सेट क्षेत्रों समूहीकरण या परिणाम का आदेश देने के लिए गिनती और खेतों दें';
	$MULTILANG_InfTablasOrigen='स्रोत डेटा तालिकाओं';
	$MULTILANG_InfCamposOrigen='डेटा फ़ील्ड';
	$MULTILANG_InfCondiciones='शर्तेँ';
	$MULTILANG_InfPropGraf='चार्ट गुण';
	$MULTILANG_InfDesGraf='रिपोर्ट के द्वारा प्रदर्शित गुण और चार्ट की उपस्थिति को परिभाषित करता है';
	$MULTILANG_InfDesAccion='हटाएँ के रूप में रिपोर्ट द्वारा प्रदर्शित प्रत्येक रिकॉर्ड पर किया जा सकता है कि कार्रवाई, एक प्रपत्र खोलें, उपयोगकर्ता कार्यों को परिभाषित करता है etc..';
	$MULTILANG_InfVolver='वापस रिपोर्टों की सूची में';
	$MULTILANG_InfTitulo='रिपोर्ट या चार्ट के शीर्षक';
	$MULTILANG_InfDesTitulo='उत्पन्न रिपोर्ट के शीर्ष पर प्रकट होने वाले पाठ';
	$MULTILANG_InfDescripcion='विवरण';
	$MULTILANG_InfDesDescrip='रिपोर्ट के वर्णनात्मक पाठ। अपनी पीढ़ी में लेकिन उनके चयन में उपयोगकर्ता का मार्गदर्शन करने के लिए किया जाता है न';
	$MULTILANG_InfCategoria='श्रेणी';
	$MULTILANG_InfDesCateg='उपयोगकर्ता तक पहुँचता है जब सिस्टम पैनल इन श्रेणियों के आधार पर वर्गीकृत किया जाता है रिपोर्ट। आप उपयोगकर्ताओं के लिए इस रिपोर्ट को प्रकाशित करना चाहते हैं, जिसके तहत यहां एक वर्ग का नाम दर्ज.';
	$MULTILANG_InfNivelUsuario='उपयोगकर्ता स्तर';
	$MULTILANG_InfTodoUsuario='सभी उपयोगकर्ता';
	$MULTILANG_InfParam='रिपोर्ट के सामान्य सेटिंग संपादित करें';
	$MULTILANG_InfTitNivel='कौन इस रिपोर्ट को देख सकते हैं?';
	$MULTILANG_InfDesNivel='उपलब्ध के रूप में इस रिपोर्ट को देखने के लिए होना चाहिए उपयोगकर्ता प्रोफ़ाइल निर्दिष्ट करें.';
	$MULTILANG_InfAlto='ऊंचाई';
	$MULTILANG_InfTitAncho='सेट तय की चौड़ाई?';
	$MULTILANG_InfDesAncho='यदि आप एक ऊंचाई मूल्य निर्दिष्ट किया है कि अगर यह मान भी लागू होता है। आप पिक्सल में एक निर्धारित तय की चौड़ाई आकार के भीतर प्रदर्शित करने के लिए रिपोर्ट की आवश्यकता है, आकार प्रतिबंध के बिना डेटा तैनात होने के लिए खाली छोड़ दें। चार्ट छवि के मामले में अपने आकार को निर्दिष्ट.';
	$MULTILANG_InfTitAlto='सेट निश्चित ऊंचाई?';
	$MULTILANG_InfDesAlto='यदि आप एक चौड़ाई मूल्य निर्दिष्ट किया है कि अगर यह मान भी लागू होता है। आप पिक्सल में एक निर्धारित तय की चौड़ाई आकार के भीतर प्रदर्शित करने के लिए रिपोर्ट की आवश्यकता है, आकार प्रतिबंध के बिना डेटा तैनात होने के लिए खाली छोड़ दें। चार्ट छवि के मामले में अपने आकार को निर्दिष्ट.';
	$MULTILANG_InfHlpAnchoalto='एक जोड़ें <b>px</b> या <b>%</b> जैसी तुम्हारी ज़रूरत है';
	$MULTILANG_InfFormato='अंतिम प्रारूप';
	$MULTILANG_InfTitFormato='इस रिपोर्ट को प्रदर्शित किया जाता है कैसे?';
	$MULTILANG_InfDesFormato='अंतिम उत्पाद डेटा तालिका या एक चार्ट की एक रिपोर्ट हो जाएगा कि क्या संकेत करता है.';
	$MULTILANG_InfActualizar='ताज़ा करे रिपोर्ट';
	$MULTILANG_InfVistaPrev='रिपोर्ट का पूर्वावलोकन';
	$MULTILANG_InfCargaPrev='लोड पूर्वावलोकन';
	$MULTILANG_InfHlpCarga='यह विकल्प डिज़ाइन मोड शब्दकोश बंद हो जाएगा और आप इसे आवेदन के एक उपयोगकर्ता के लिए हिन्दी प्रदर्शित किया जाएगा के रूप में रिपोर्ट दिखाएगा';
	$MULTILANG_InfErrInforme1='आप रिपोर्ट के लिए एक वैध शीर्षक दर्ज करना होगा.';
	$MULTILANG_InfErrInforme2='रिपोर्ट के साथ जुड़े वर्ग के लिए मान्य नाम निर्दिष्ट करें.';
	$MULTILANG_InfTituloAgr='नई रिपोर्ट या चार्ट जोड़ें';
	$MULTILANG_InfDetalles='रिपोर्ट / चार्ट के विवरण को परिभाषित';
	$MULTILANG_InfDefinidos='रिपोर्ट / चार्ट पहले से ही व्यवस्था में परिभाषित';
	$MULTILANG_InfcamTabCond='फील्ड्स, टेबल्स और शर्तें';
	$MULTILANG_InfAdvEliminar='महत्वपूर्ण: इस रिपोर्ट उपयोगकर्ताओं को हटाने इसे फिर से उपयोग नहीं कर सकते। आप इस कार्रवाई को पूर्ववत नहीं कर सकते हैं। यह भी रिपोर्ट के किसी भी आंतरिक डिजाइन समाप्त.\n'.$MULTILANG_Confirma;
	$MULTILANG_InfErrTamano='आप उत्पन्न करने के लिए कोशिश कर रहे हैं रिपोर्ट एक ग्राफ प्रकार की रिपोर्ट है लेकिन डिजाइनर जिसके परिणामस्वरूप ग्राफ की ऊंचाई और चौड़ाई निर्दिष्ट नहीं किया। <br> एक छवि उत्पन्न करने के लिए ग्राफिक का एक मान्य आकार प्रदान करना चाहिए.';
	$MULTILANG_InfGeneraPDF='इस रिपोर्ट को निर्यात करने की अनुमति?';
	$MULTILANG_InfGeneraPDFInfoTit='सारणीबद्ध रिपोर्टों के लिए ही उपलब्ध';
	$MULTILANG_InfGeneraPDFInfoDesc='आप लिब्रे ऑफिस, ओपेन आफिस या कार्यालय 2007 फ़ाइलों को निर्यात करना चाहते हैं तो यह विकल्प php_xml और php_zip एक्सटेंशन की आवश्यकता है। यदि आप इस विकल्प को सक्रिय करें यदि उपयोगकर्ता को स्क्रीन पर अभिलेखों को देखने के लिए क्वेरी का शुभारंभ करेंगे क्योंकि आप अपने परिणामों में अभिलेखों का एक बहुत कुछ है जब रिपोर्ट समय एक सामान्य रिपोर्ट से भी अधिक हो सकता है, और वह उन्हें निर्यात करना चाहता है तो एक ही प्रश्न का शुभारंभ.    OTHER WAYS TO EXPORT ARE AVAILABLE ACTIVATING THE DATATABLE SUPPORT FOR THIS REPORT.';
    $MULTILANG_InfVblesFiltro='फिल्टर के लिए आवश्यक ग्लोबल चर';
    $MULTILANG_InfVblesDesFiltro='यदि आप एक क्वेरी का निर्माण, जबकि वैश्विक वातावरण से taked जाना चाहिए कि (डॉलर चरित्र $ और केवल अलग हो अल्पविराम के बिना) PHP चर condittions विकल्प में फिल्टर करने के लिए उपलब्ध होने की';
    $MULTILANG_InfDataTableResXPag='प्रति पृष्ठ अभिलेखॉ';
    $MULTILANG_InfDataTableViendoP='देखने पेज';
    $MULTILANG_InfDataTableDe='का';
    $MULTILANG_InfDataTableFiltradoDe='से फ़िल्टर';
    $MULTILANG_InfDataTableRegTotal='कुल अभिलेख';
    $MULTILANG_InfDataTableNoDatos='तालिका में आंकड़े उपलब्ध नहीं';
    $MULTILANG_InfDataTableNoRegistros='खोज मापदंड से मेल खाने वाली कोई रिकॉर्ड नहीं है';
    $MULTILANG_InfDataTableNoRegistrosDisponibles='उपलब्ध कोई अभिलेख';
    $MULTILANG_InfDataTableTit='DataTables समर्थन?';
    $MULTILANG_InfDataTableDes='सॉर्ट, फ़िल्टर खोज करने के लिए एक DataTable में रिपोर्ट बदलने और गतिशील रूप से परिणाम के पन्नों प्राप्त करने की अनुमति';
    $MULTILANG_InfFormFiltrado='फ़िल्टर चर के साथ पर्चा';
    $MULTILANG_InfFormFiltradoDes='रिपोर्ट के लिए फिल्टर चर में प्रवेश के लिए बनाया गया एक फार्म का चयन करें। रिपोर्ट को लोड करने से पहले यह मदद से आप कुछ डेटा के लिए उपयोगकर्ताओं को पूछना एक रूप है कि लिंक करने के लिए।';
    $MULTILANG_InfRetornoFormFiltrado='फ़िल्टर्ड रिपोर्ट देखें';
    $MULTILANG_InfAutoajusteAncho='उत्पन्न कोशिकाओं के लिए ऑटो-चौड़ाई';
    $MULTILANG_InfBordesCelda='सेल सीमा ड्रा';
    $MULTILANG_InfBordesTodos='सभी दिशाएं';
    $MULTILANG_InfBordesArriba='केवल शीर्ष';
    $MULTILANG_InfBordesAbajo='सिर्फ नीचे';
    $MULTILANG_InfBordesArrAba='ऊपर और नीचे';
    $MULTILANG_InfBordesIzq='बाईं ओर ही';
    $MULTILANG_InfBordesDer='दाईं ओर ही';
    $MULTILANG_InfBordesIzqDer='बाएँ और दाएँ पक्ष';
	$MULTILANG_OrientacionPagina='पेज लेआउट';
	$MULTILANG_InfTamanoPapel='पेपर का आकार';
	$MULTILANG_InfReducir='ऑटो-आकार सामग्री';
	$MULTILANG_InfTitPersonalizar='कस्टम प्रस्तुति और लेआउट (वैकल्पिक)';
	$MULTILANG_InfEjecutarAccionEn='में इस कार्रवाई चलाएँ';
	$MULTILANG_InfPrecargarEstilos='प्रीलोड बूटस्ट्रैप सीएसएस शैली पत्रक';
	$MULTILANG_BtnEstiloSimple='सरल बटन, सादे शैली';
	$MULTILANG_BtnEstiloPredeterminado='डिफ़ॉल्ट शैली';
	$MULTILANG_BtnEstiloPrimario='प्राथमिक शैली';
	$MULTILANG_BtnEstiloFinalizado='सफलता शैली';
	$MULTILANG_BtnEstiloInformacion='सूचना शैली';
	$MULTILANG_BtnEstiloAdvertencia='चेतावनी शैली';
	$MULTILANG_BtnEstiloPeligro='डेंजर शैली';
	$MULTILANG_InfEditableLinea='ऑनलाइन संपादन योग्य';
	$MULTILANG_InfPaginacionDatatable='Page size for DataTables';
	$MULTILANG_InfPaginacionDatatableDes='Tells Practico how many records should it show in default view of a datatable';
	$MULTILANG_InfCargaInforme='Load a report by ID';
	$MULTILANG_InfSubtotalesColumna='AutoSum column';
	$MULTILANG_InfSubtotalesColumnaDes='Tells Practico which is the column number to be used for the autosum in each page.  LEAVE IT IN BLANK TO AVOID ANY CALCULATION.';
	$MULTILANG_InfSubtotalesFormato='AutoSum format';
	$MULTILANG_InfSubtotalesFormatoDes='Tells Practico what is the output format for the autosum results.  <b>This allow basic HTML and templates</b> Example: _TOTAL_PAGINA_ show the total for the actual page, _TOTAL_INFORME_ shows the total of all report, _COLUMNA_ show the column number used for totalize values.  For example this HTML code shows the results centered and in bold: < div align=center>< b>Total page < i>(column: _COLUMNA_)< /i> _TOTAL_PAGINA_ Total report: _TOTAL_INFORME_< /b>< /div>';
	$MULTILANG_InfTituloArbitrario='मनमाना शीर्षक';
	$MULTILANG_InfTituloArbitrarioDes='आपको डेटाबेस इंजिन द्वारा दिया गया स्तंभ शीर्षक को अनदेखा करने की अनुमति देता है और इसके बजाय प्रस्तुत रिपोर्ट में एक शीर्षक के रूप में इस मान का उपयोग करें। <b> मूलभूत HTML और PHP चर को अनुमति देता है </b>';
	$MULTILANG_InfSQL='यदि आप इस SQL स्क्रिप्ट फ़ील्ड में 5 वर्णों से अधिक सामग्री जोड़ते हैं, तो रिपोर्ट जनरेटर टेबल, फ़ील्ड, शर्तों या किसी अन्य क्वेरी परिभाषा के किसी भी कॉन्फ़िगरेशन को छोड़ देगा जिसे आपने परिभाषित किया है और सीधे इस स्क्रिप्ट को निष्पादित करने का प्रयास करेगा और इससे उत्पन्न होगा परिणाम तालिका पर्यावरण चर शामिल करने के लिए आप {चर परिवर्तनीय} नोटेशन में PHP चर का उपयोग कर सकते हैं।';
	$MULTILANG_InfFormsUsan='पता लगाए गए फॉर्म जो इस रिपोर्ट का उपयोग एम्बेडेड तरीके से करते हैं';
	$MULTILANG_InfTootipTitulo='Create a tooltip for graphic reports using the reports title';
    $MULTILANG_InfBotonPpio='Put in the first column';
    $MULTILANG_ExportaDT=' client side export tools?';
    $MULTILANG_ExportaDTDes='Allow to enable some options to this report to export its data in different formats.  The process will take only the data filtered by the user in the data table.';
    $MULTILANG_InfEncabezado='Rich text for the header';
    $MULTILANG_InfEncabezadoDes='In this field you can enter any rich text, links, images or another elements that will be used in the top of the report as a header or title';
    $MULTILANG_InfSinDatos='There is no data for this graph';
    $MULTILANG_InfTablaResponsive='Use a responsive layout';
    $MULTILANG_InfTablaResponsiveDes='Allow to draw a table in a 100% responsive format hidding the columns that overflow the content and converting them to a new child row.  Important: This mode disable any footer section for the table.';
    $MULTILANG_InfEnHome='Direct publishing for authorized users';
    $MULTILANG_InfBarraSuperior='Over the navigation bar alerts';


	//Menus
	$MULTILANG_MnuTitEditar='संपादन मेनू आइटम';
	$MULTILANG_MnuSelImagen='चयन करने के लिए एक छवि पर क्लिक करें';
	$MULTILANG_MnuPropiedad='आइटम गुण';
	$MULTILANG_MnuApariencia='अपीयरेंस और स्थान विन्यास';
	$MULTILANG_MnuTexto='टेक्स्ट';
	$MULTILANG_MnuPadre='पिता';
	$MULTILANG_MnuSiAplica='लागू होता है';
	$MULTILANG_MnuUbicacion='इस विकल्प का स्थान';
	$MULTILANG_MnuArriba='संभव TopMenu?';
	$MULTILANG_MnuEscritorio='संभव डेस्कटॉप?';
	$MULTILANG_MnuCentro='संभव मध्य?';
    $MULTILANG_MnuIzquierda='संभव साइडबार?';
	$MULTILANG_MnuSeccion='अनुभाग';
	$MULTILANG_MnuDesArriba='आप इस विकल्प को सक्षम करना होगा क्षैतिज शीर्ष मेनू बार में प्रदर्शित करने के लिए?';
	$MULTILANG_MnuDesEscritorio='अगर आपको लगता डेस्कटॉप पर एक चिह्न के रूप में प्रदर्शित करने के लिए इस विकल्प को सक्षम करना होगा?';
	$MULTILANG_MnuDesCentro='आपको खंड क्षेत्र में परिभाषित मूल्य के आधार पर समूहीकृत / वर्गीकृत खिड़कियों के भीतर, आवेदन के मध्य भाग में तैनात किया जा करने के लिए इस विकल्प को सक्षम करना होगा?';
	$MULTILANG_MnuDesIzquierdo='आप आवेदन के साइड बार में तैनात किया जा करने के लिए इस विकल्प को सक्षम करना होगा';
    $MULTILANG_MnuDesImagen='सिस्टम पर उपलब्ध चित्रों की एक सूची प्रदर्शित करें';
	$MULTILANG_MnuComandos='विन्यास कमानों और कार्रवाई';
	$MULTILANG_MnuClic='क्लिक करने के लिए संभावित?';
	$MULTILANG_MnuURL='स्थैतिक यूआरएल';
	$MULTILANG_MnuTitURL='एक यूआरएल को लाओ या एक जावास्क्रिप्ट को अंजाम?';
	$MULTILANG_MnuDesURL='पूर्ण URL या किसी आदेश परिभाषित जावास्क्रिप्ट जावास्क्रिप्ट दर्ज करें: आदेश वस्तु के चारों ओर उत्पन्न एक लंगर HREF भीतर बदला जाएगा। आप स्ट्रिंग पैरामीटर पारित करने के लिए की जरूरत है जावास्क्रिप्ट को आप एकल cuotes इस्तेमाल कर सकते हैं आज्ञाओं';
	$MULTILANG_MnuTipo='आदेश टाइप';
	$MULTILANG_MnuInterno='आंतरिक';
	$MULTILANG_MnuPersonal='व्यक्तिगत';
	$MULTILANG_MnuObjeto='वस्तु';
	$MULTILANG_MnuAccion='आंतरिक लड़ाई / आदेश / वस्तु';
	$MULTILANG_MnuTitAccion='के रूप में तीन संभव मूल्यों का एक प्रकार:';
	$MULTILANG_MnuDesAccion='1) पीआर और aacute Practico आप इस sintax एफ आर एम का उपयोग कर इस मेनू विकल्प के लिए लिंक करना चाहते हैं: एरोटिक या INF: आप रिपोर्ट के लिए वस्तु आईडी (आईडी फार्म या आईडी के साथ एरोटिक जगह चाहिए जहां एरोटिक), 2) आंतरिक कार्रवाई पीआर और aacute में, अगर आप उपयोगकर्ता पुनर्निर्देशित करना चाहते हैं, जहां ctico (आप व्यवस्थापक के रूप में Practicos पाद लेख में देख सकते हैं), या 3) कस्टम आदेश: उपयोगकर्ता द्वारा परिभाषित आदेश secuence, इस secuence चाहिए personalizadas.php फ़ाइल या स्थापित किसी भी अन्य मॉड्यूल में मौजूद है ।';
	$MULTILANG_MnuTitNivel='कौन इस विकल्प को देख सकते हैं?';
	$MULTILANG_MnuDesNivel='इस विकल्प उपलब्ध देखने के लिए होना चाहिए उपयोगकर्ता प्रोफ़ाइल निर्दिष्ट करें.';
	$MULTILANG_MnuActualiza='पुनः लोड मेनू';
	$MULTILANG_MnuErr='यह कम से कम पाठ क्षेत्र की आवश्यकता है.';
	$MULTILANG_MnuAdmin='मुख्य मेनू प्रशासन';
	$MULTILANG_MnuAgregar='मेनू विकल्प जोड़ें';
	$MULTILANG_MnuDefinidos='अनुभागों और मेनू आदेश परिभाषित';
	$MULTILANG_MnuNivel='स्तर';
	$MULTILANG_MnuComando='आदेश';
	$MULTILANG_MnuAdvElimina='महत्वपूर्ण: इस रजिस्ट्री हटाया जा रहा है कि आप कुछ सिस्टम विकल्प लिंक रद्द कर सकता है.\n'.$MULTILANG_Confirma;
	$MULTILANG_MnuHlpComandoInf='हो सकता है कि आप आदेश इस srtring में जोड़ना चाहते हैं <b>:htm:Informes</b>  Practico कहने के लिए <br>कि एचटीएमएल प्रारूप में और कहा कि सीएसएस शैली पत्रक के साथ सभी डेटा डालता है';
	$MULTILANG_MnuHlpAwesome='आप मेनू चिह्न के लिए इस्तेमाल एक ही वाक्य रचना का उपयोग कर सकते हैं';
    $MULTILANG_MnuTgtBlank='नया विंडो या टैब';
    $MULTILANG_MnuTgtSelf='यह क्लिक किया गया था कि एक ही खिड़की या फ्रेम';
    $MULTILANG_MnuTgtParent='जनक फ्रेम या खिड़की';
    $MULTILANG_MnuTgtTop='विंडो के पूरे शरीर';
    $MULTILANG_MnuTgt='लक्ष्य (एक URL का उपयोग केवल विकल्प)';
    $MULTILANG_ImagenMenu='चित्र: एक आइकन का चयन करें या एक रिश्तेदार पथ दर्ज';

	//Objetos, seguridad y otros
	$MULTILANG_ObjError='इस आदेश में प्राप्त वस्तु के प्रकार अज्ञात है';
	$MULTILANG_SecErrorTit='कमानों और रिपोर्टें सुरक्षा नियंत्रण';
	$MULTILANG_SecErrorDes='। क्या आप हिन्दी प्रणाली एक लेखा परीक्षा प्रवेश ले जाएगा अनधिकृत जो कर रहे हैं के लिए एक समारोह है, आदेश या रिपोर्ट पर अमल करने का प्रयास किया:';
	
	//Tablas
	$MULTILANG_TblError1='डिजाइन अखंडता समस्या';
	$MULTILANG_TblError2='डाटाबेस त्रुटि';
	$MULTILANG_TblError3='निष्पादन इंजन के दौरान निम्न संदेश वापस आ गया है';
	$MULTILANG_TblAgrCampo='डेटा तालिका में खेतों में जोड़ें';
	$MULTILANG_TblAgrCampoTabla='मेज पर एक फ़ील्ड जोड़ें';
	$MULTILANG_TblEntero='पूर्णांक';
	$MULTILANG_TblCadena='तार (Max length 255)';
	$MULTILANG_TblTexto='टेक्स्ट (Unlimited)';
	$MULTILANG_TblFecha='तारीख (without time)';
	$MULTILANG_TblTitNombre='क्षेत्र का नाम प्रारूप मदद';
	$MULTILANG_TblDesNombre='डैश, डॉट्स, रिक्त स्थान या विशेष वर्ण के बिना क्षेत्र का नाम';
	$MULTILANG_TblLongitud='लंबाई';
	$MULTILANG_TblAutoinc='स्वयं वेतन वृद्धि';
	$MULTILANG_TblDesLongitud='इस क्षेत्र डेटा के प्रकार पर निर्भर करता है अनिवार्य हो सकता है इस प्रकार स्ट्रिंग क्षेत्रों के रूप में, संग्रहीत करने के लिए';
	$MULTILANG_TblDesLongitud2='प्रारूप: आप कभी भी एक बैकस्लैश (बैकस्लैश) या इन मूल्यों के बीच एक भी बोली डाल करने की आवश्यकता है, हमेशा एक अतिरिक्त बैकस्लैश (बैकस्लैश) रखें। इनम खेतों या सेट के लिए, स्वरूप का उपयोग: \'a\',\'b\',\'c\'...';
	$MULTILANG_TblTitAutoinc='प्राथमिक कुंजी चेतावनी';
	$MULTILANG_TblDesAutoinc='यह मान ही किसी कारण डिफ़ॉल्ट autoincrement के लिए हटा दिया गया है, जो उन्नत प्रशासकों द्वारा परिभाषित किया जा सकता है ID field';
	$MULTILANG_TblNulos='नल मान की अनुमति दें?';
	$MULTILANG_TblDefUsuario='उपयोगकर्ता परिभाषित';
	$MULTILANG_TblNulo='शून्य';
	$MULTILANG_TblFechaHora='आज की तारीख';
	$MULTILANG_TblDesPredet='प्रारूप: केवल एक मान, जोखिमयुक्त। तार के लिए शुरुआत और अंत में एकल उद्धरण चिह्नों का उपयोग';
	$MULTILANG_TblAgregando='क्षेत्र जोड़ें';
	$MULTILANG_TblCamposDef='फील्ड्स तालिका में पहले से परिभाषित';
	$MULTILANG_TblTipoClave='कुंजी प्रकार';
	$MULTILANG_TblNoElim='सफाया नहीं कर सकते';
	$MULTILANG_TblAdvDelCampo='महत्वपूर्ण: तालिका के चयनित स्तंभ नष्ट कर रहे हैं यह भी तो है कि इस कार्य पूर्ववत नहीं कर सकते में संग्रहीत सभी डेटा हटा.\n'.$MULTILANG_Confirma;
	$MULTILANG_TblErrDel1='त्रुटि तालिका हटाने!';
	$MULTILANG_TblErrDel2='निर्दिष्ट तालिका हटाया नहीं जा सकता। कुछ आम कारण हैं:<br> <li> स्वचालित रूपों या रिपोर्टों में से किसी ने इस्तेमाल किया जाता है, उस मामले में आप संपादन कोशिश कर सकते हैं. <br> <li> तालिका रिश्तों अन्य डेटा तालिकाओं के लिए डिजाइनर द्वारा परिभाषित किया गया है. <br> <li> सक्रिय सत्र के लिए परिभाषित उपयोगकर्ता भूमिका Practico में वस्तुओं को नष्ट नहीं कर सकते';
	$MULTILANG_TblErrCrear='तालिका के लिए मान्य नाम निर्दिष्ट करें। इस डैश, डॉट्स, रिक्त स्थान या विशेष वर्ण नहीं करना चाहिए';
	$MULTILANG_TblCrearListar='प्रणाली में परिभाषित / सूची डेटा टेबल बनाएँ';
	$MULTILANG_TblCreaTabla='डेटाबेस में एक नया टेबल बना';
	$MULTILANG_TblDesTabla='एक डेटा तालिका आप जानकारी स्टोर करने के लिए अनुमति देता है कि एक संरचना है। डैश, डॉट्स, रिक्त स्थान या विशेष वर्ण के बिना इस क्षेत्र में तालिका के नाम दर्ज करें। संवेदनशील कैप्स';
	$MULTILANG_TblCreaTabCampos='तालिका बनाने और क्षेत्रों को परिभाषित';
	$MULTILANG_TblTitAsis='का प्रयोग करें जादूगर?';
	$MULTILANG_TblDesAsis='यदि आप कुछ पूर्वनिर्धारित आम टेबल से चुन सकते हैं';
	$MULTILANG_TblTablasBD='डेटाबेस में परिभाषित टेबल्स';
	$MULTILANG_TblRegistros='अभिलेख';
	$MULTILANG_TblAdvDelTabla='महत्वपूर्ण: भी सभी रिकॉर्ड में संग्रहित नष्ट हो जाती हैं डेटा तालिका हटाया जा रहा है तो आप इस कार्रवाई पूर्ववत नहीं कर सकते.\n'.$MULTILANG_Confirma;
	$MULTILANG_TblErrPlantilla='आप अपने नए तालिका बनाना चाहते हैं, जिसमें से एक टेम्पलेट का चयन करना होगा';
	$MULTILANG_TblAsistente='तालिका पीढ़ी जादूगर';
	$MULTILANG_TblAsistNombre='नई तालिका के लिए नाम';
	$MULTILANG_TblAsistPlant='टेम्पलेट चयनित';
	$MULTILANG_TblAsCampos='युक्त फील्ड्स';
	$MULTILANG_TblTotCampos='कुल खेतों';
	$MULTILANG_TblHlpAsist='सभी तालिकाओं और खेतों अगले चरण में व्यक्तिगत कर सकते हैं, आप चाहते हैं कि उन के गुणों को हटाने या बदलने, जोड़ने <br>.';
    $MULTILANG_TblTipoCopia1='संरचना केवल (वाक्य बनाने)';
    $MULTILANG_TblTipoCopia2='डेटा (डालने वाक्य)';
    $MULTILANG_TblTipoCopia3='संरचना और डेटा (बना सकते हैं और वाक्य डालने)';
    $MULTILANG_TblImportar='फ़ाइल से आयात';
    $MULTILANG_TblImportarSQL='एक संकुचित एसक्यूएल अपलोड';
    $MULTILANG_TblSQLConsejo='आप इस फाइल के एसक्यूएल वाक्य पर अमल यदि आप बनाने या टेबल और कई अन्य जानकारी भी डिजाइन और अन्य चीजों overwriting, मिटाकर किया जा सकता है आप के रिकॉर्ड में है कि निर्यात किया। शब्दकोश हिन्दी <b> हम एक बैकअप पहले की तरह जारी करना है कि आप सलाह देते हैं।';
    $MULTILANG_TblEjecutarSQL='इस फाइल में चलाएँ एसक्यूएल वाक्य (कुछ समय लग सकता है)';
    $MULTILANG_TblDecodificarActual='वास्तविक रिकॉर्ड या डेटा तालिका के लिए मिलान या वर्णसमूह';
    $MULTILANG_TblCodificar='एन्कोड अभिलेखों से पहले का उपयोग कर बैकअप फाइल करने के लिए उन्हें बचाने के लिए';
    $MULTILANG_TblCodificacionNINGUNO='कोई नहीं, मूल तालिका कोलेशन या वर्णसमूह का प्रयोग करें';
    $MULTILANG_TblTransliteracion='चरित्र लिप्यंतरण का उपयोग';
    $MULTILANG_TblTransliteracionHlp='एक चरित्र लक्ष्य वर्णसमूह में प्रतिनिधित्व नहीं कर सकते हो जब लिप्यंतरण सक्रिय हो जाता है, तो यह एक या कई इसी तरह की तलाश में पात्रों के माध्यम से अनुमानित किया जा सकता है। यदि आप अमान्य वर्ण omited किया जाएगा तो की अनदेखी करने का निर्णय लेते हैं तो स्ट्रिंग छोटा कर दिया है और, E_NOTICE उत्पन्न होता है और समारोह झूठी वापसी करेंगे।';
    $MULTILANG_TblTranslit='Translitering';
    $MULTILANG_TblIgnora='उपेक्षा कर';
    $MULTILANG_TblAnaliza='तालिकाओं का विश्लेषण करें';
    $MULTILANG_TblReparar='मरम्मत टेबल';
    $MULTILANG_TblOptimizar='टेबल का अनुकूलन';
    $MULTILANG_TblVaciar='खाली';
    $MULTILANG_TblVaciarAdv='इस क्रिया को इस तालिका में सभी रिकॉर्ड को हटाना होगा, तो आप यकीन कर रहे हैं?';
    $MULTILANG_TblImportarXLS='स्प्रेडशीट से अपलोड';
    $MULTILANG_TblXLSConsejo='अपने मौजूदा डेटाबेस के साथ एक स्प्रेडशीट फ़ाइल में लोड हो रहा है और मैच के खेतों आप को हटाने टेबल, रिकॉर्ड और अन्य संबंधित जानकारी, साथ ही डिजाइन और जुड़े अभिलेखों में निहित अन्य तत्वों बनाने या overwritting किया जा सकता है।. <br><br><b>यह आपको जारी रखने से पहले इस प्रक्रिया के लिए एक बैकअप से पहले बनाने की सिफारिश की है.</b><br><br>स्प्रेडशीट की पहली पंक्ति में आप मूल्यों को आयात करना चाहते हैं, जिस पर तालिका में शीर्षकों के रूप में क्षेत्र का सही नाम शामिल करना चाहिए।';
    $MULTILANG_TblTablaImportacion='आप डेटा आयात करने के लिए चाहते हैं जिस पर तालिका का चयन करें';
    $MULTILANG_TblCorrespondencia='तालिका के खेतों और फ़ाइल के स्तंभों के बीच पत्राचार';
    $MULTILANG_TblApareaMsg='तालिका के बाईं ओर के खेतों की जाँच करें और चयन सूची स्तंभ से उनके नाम से मेल नहीं खाते। यदि आवश्यक हो pairings के मैनुअल शीर्ष पर फ़ाइल में मौजूदा कॉलम के अनुसार पूर्वावलोकन कर सकते हैं। व्यापार निर्देशिका अयुगल फील्ड्स को नजरअंदाज कर दिया और इंजन में ले लिया है डिफ़ॉल्ट मान के साथ भरा जाएगा';
	$MULTILANG_TblPoliticaImportacion='<b>आयात किया जा रहा है कि एक रिकॉर्ड पहले से ही मौजूद है, तो क्या करें?:</b><br>आप डेटाबेस में पहले से ही आयात करने की कोशिश कर रही है कि यह मामले में सिस्टम में प्रत्येक डुप्लिकेट रिकॉर्ड संसाधित करने के लिए चाहते हैं कि कैसे निर्दिष्ट करें।';
	$MULTILANG_TblIgnorarRegistro='रिकॉर्ड की अनदेखी';
	
	//Usuarios
	$MULTILANG_UsrCopia='अनुमतियां पूरा कॉपी करें। नीचे की जाँच करें।';
	$MULTILANG_UsrDesPW='न्यूनतम सुरक्षा शर्तों के साथ पासवर्ड का <b> कम से कम 8 वर्णों की लंबाई होना चाहिए </ b> नंबर, ऐसे <font color = नीले> $ * </ font> के रूप में बड़े और छोटे प्रतीकों। अपना पासवर्ड इस प्रणाली से सुरक्षित माना जाता है है करने के लिए <b> 81% कम से कम एक सुरक्षा स्तर को पूरा करना होगा </ b>';
	$MULTILANG_UsrCambioPW='पासवर्ड बदलें';
	$MULTILANG_UsrAnteriorPW='पुराना पासवर्ड';
	$MULTILANG_UsrNuevoPW='नया पासवर्ड';
	$MULTILANG_UsrNivelPW='सुरक्षा स्तर';
	$MULTILANG_UsrVerificaPW='पासवर्ड को सत्यापित करें';
	$MULTILANG_UsrHlpNoPW='प्रमाणीकरण इंजन बाहरी प्रकार के उपकरण के लिए परिभाषित किया गया है.<br>
				यह आपके सिस्टम व्यवस्थापक द्वारा परिभाषित उपकरण में आप के लिए केन्द्र में कामयाब किया जाना चाहिए के रूप में पासवर्ड बदलें और उपयोगकर्ता प्रोफाइल अपडेट अक्षम हैं';
	$MULTILANG_UsrErrPW1='आप का अनुरोध किया डेटा के किसी भी दाखिल करना भूल गए';
	$MULTILANG_UsrErrPW2='आप दो अलग-अलग पासवर्ड दर्ज किया है';
	$MULTILANG_UsrErrPW3='आपके द्वारा दर्ज के लिए कुंजी न्यूनतम सुरक्षा सिफारिशों को पूरा नहीं करता';
	$MULTILANG_UsrErrPW4='The actual password doesnt match with the password registered in the system.  For security reasons your password wont change until you enter your actual password as verification.';
	$MULTILANG_UsrErrInf='उपयोगकर्ता पहले से ही चयनित अनुमति है';
	$MULTILANG_UsrAdmInf='उपयोगकर्ता रिपोर्ट प्रशासन';
	$MULTILANG_UsrAgreInf='उपयोगकर्ता मेनू के लिए एक रिपोर्ट में जोड़ें';
	$MULTILANG_UsrInfDisp='उपलब्ध रिपोर्टों';
	$MULTILANG_UsrAdvDel='महत्वपूर्ण: रजिस्ट्री हटाया जा रहा है कोई लिंक इस उपयोगकर्ता के लिए कुछ प्रणाली के विकल्प हो सकता है.\n'.$MULTILANG_Confirma;
	$MULTILANG_UsrAdmPer='उपयोगकर्ता अधिकार प्रबंधन';
	$MULTILANG_UsrCopiaPer='शुरू में एक अनुमतियाँ उपयोगकर्ता से प्रतिलिपि बनाना';
	$MULTILANG_UsrDelPer='केवल अनुमति हटाना';
	$MULTILANG_UsrAgreOpc='उपयोगकर्ता मेनू में विकल्प जोड़ें';
	$MULTILANG_UsrSecc='पहले से ही उपलब्ध धारा';
	$MULTILANG_UsrErrCrea1='पहले से ही मौजूद दर्ज उपयोगकर्ता, चेक या लॉगिन खाते के लिए प्रवेश बदलने के लिए और फिर से कोशिश करें';
	$MULTILANG_UsrErrCrea2='आवश्यकता के रूप में आप का अनुरोध किया डेटा के किसी भी दाखिल करना भूल गए';
	$MULTILANG_UsrErrCrea3='दर्ज किया गया पासवर्ड कम से कम छह अक्षरों का होना चाहिए';
	$MULTILANG_UsrAdicion='उपयोगकर्ताओं को जोड़ने';
	$MULTILANG_UsrLogin='उपनाम / लॉगिन';
	$MULTILANG_UsrDesLogin='अद्वितीय प्रवेश प्रणाली में उपयोगकर्ता की पहचान करने के लिए। संवेदनशील कैप्स';
	$MULTILANG_UsrNombre='पूरा नाम';
	$MULTILANG_UsrTitCorreo='सचेतक और सूचनाओं के लिए पता';
	$MULTILANG_UsrDesCorreo='कुछ मॉड्यूल में स्वत सूचनाएं प्रणाली के लिए संभव उपयोग की ई-मेल';
	$MULTILANG_UsrEstado='प्रारंभिक अवस्था';
	$MULTILANG_UsrNivel='पहुंच स्तर';
	$MULTILANG_UsrInterno='आंतरिक उपयोगकर्ता?';
	$MULTILANG_UsrDesInterno='एक आंतरिक उपयोगकर्ता ईआरपी या प्रणाली की तैनाती है कि कंपनी के अंदर काम करने वाले लोगों के लिए है। किसी बाहरी उपयोगकर्ता प्रणाली में प्रवेश कि एक ग्राहक या किसी अन्य कंपनी से है कि लोगों के लिए उदाहरण के लिए है';
	$MULTILANG_UsrTitNivel='प्रारंभिक सुरक्षा प्रोफ़ाइल';
	$MULTILANG_UsrDesNivel='उपयोगकर्ताओं को सुरक्षा प्रोफ़ाइल। चेतावनी: यह विकल्प बनाई गई वस्तुओं के लिए डिजाइनर द्वारा परिभाषित व्यक्तिगत उपयोगकर्ता अनुमतियों के लिए अलग है। इस पृष्ठ पर केवल Practico की आंतरिक संचालन करने के लिए लागू होता है';
	$MULTILANG_UsrAudit1='आपरेशनों ट्रैकिंग';
	$MULTILANG_UsrAudDes='कार्रवाई का विवरण';
	$MULTILANG_UsrAudUsrs='सभी उपयोगकर्ताओं के लिए लेन-देन की निगरानी';
	$MULTILANG_UsrAudAccion='कार्रवाई के साथ';
	$MULTILANG_UsrAudUsuario='के लिए <b>उपयोगकर्ता</b>';
	$MULTILANG_UsrAudDesde='से (Day / Month)';
	$MULTILANG_UsrAudHasta='को';
	$MULTILANG_UsrAudAno='जिक्र करते हुए वर्ष लेखापरीक्षा';
	$MULTILANG_UsrAudIniReg='रिकॉर्ड पर प्रारंभ';
	$MULTILANG_UsrAudVisual='देखना';
	$MULTILANG_UsrAudMonit='निगरानी मोड';
	$MULTILANG_UsrAudHisto='उपयोगकर्ता के संचालन का इतिहास (सबसे पुराना करने से सबसे हाल ही में)';
	$MULTILANG_UsrLista='सिस्टम में उपयोगकर्ताओं की सूची';
	$MULTILANG_UsrLisNombre='जिसका नाम शामिल है केवल उपयोगकर्ताओं को देखें';
	$MULTILANG_UsrLisLogin='जिसका लॉग इन गये हैं केवल उपयोगकर्ताओं को देखें';
	$MULTILANG_UsrFiltro='कारण पंजीकृत उपयोगकर्ताओं की संख्या के लिए आप आउटपुट फ़िल्टर करना चाहिए.<br>
				शीर्ष पर वांछित फिल्टर प्रकार दर्ज करें और इसी बटन पर क्लिक करें.';
	$MULTILANG_UsrAcceso='अंतिम पहुंच';
	$MULTILANG_UsrAdvSupr='महत्वपूर्ण: यदि आप बाद में एक ही पहचान के साथ उपयोगकर्ता बहलाना जब तक आप उपयोगकर्ता को हटाना है और इस के साथ जुड़े रिकॉर्ड करने के लिए लिंक खोने के लिए जा रहे हैं, इस कार्रवाई बरामद नहीं किया जा सकता.\n'.$MULTILANG_Confirma;
	$MULTILANG_UsrAddMenu='मेनू जोड़ें';
	$MULTILANG_UsrAddInfo='रिपोर्ट में जोड़ें';
	$MULTILANG_UsrAuditoria='आडिट';
	$MULTILANG_UsrAgregar='एक उपयोगकर्ता जोड़ें';
	$MULTILANG_UsrVerAudit='देखें उपयोगकर्ता लेखा परीक्षा';
	$MULTILANG_UsrReset='पासवर्ड रीसेट';
    $MULTILANG_UsrOlvideClave='मैं अपना पासवर्ड भूल गया';
    $MULTILANG_UsrOlvideUsuario='मैं अपना उपयोगकर्ता नाम भूल गया';
    $MULTILANG_UsrIngreseUsuario='अपने उपयोगकर्ता नाम टाइप करें';
    $MULTILANG_UsrIngreseCorreo='पंजीकृत ईमेल लिखें';
    $MULTILANG_UsrResetAdmin='यदि आप एक पासवर्ड के बाद सिस्टम के लिए एक सफल उपयोग कर सकते है अगर तुम न आप के लिए अपना पासवर्ड रीसेट कर सकता है जो आपके सिस्टम प्रशासक को लिख सकते हैं बहाल।.';
    $MULTILANG_UsrAsuntoReset='पहुंच रीसेट';
    $MULTILANG_UsrMensajeReset='उपयोगकर्ता और चाबी बहाली के लिए जानकारी के साथ एक ईमेल भेजा गया था। निर्देश देखने के लिए आपके इनबॉक्स और स्पैम फोल्डर में अपने ईमेल की जांच करने के लिए याद रखें। व्यापार लिस्टिंग कोई लिंक अगले दिन में समाप्त हो जाएगी या उस लिंक succefully प्रयोग किया जाता है जब अपना पासवर्ड रीसेट करने के लिए। <HR> ईमेल के लिए subjet ऐसा कुछ हो जाएगा : <b>['.$NombreRAD.'] '.$MULTILANG_UsrAsuntoReset.'</b>';
    $MULTILANG_UsrErrorReset='पासवर्ड रीसेट करने की प्रक्रिया के लिए प्रवेश जानकारी अमान्य था, में प्रवेश किया नाम या ईमेल नहीं करता है प्रणाली में मौजूद है। डेटा की जाँच करें और पुन: प्रयास करें.';
    $MULTILANG_UsrResetLink='अपना पासवर्ड बहाल करने के लिए इस लिंक का पालन करें';
    $MULTILANG_UsrResetCuenta='संदेश भेजा';
    $MULTILANG_UsrResetOK='पासवर्ड बहाल। फिर से प्रवेश करने की कोशिश करें';
    $MULTILANG_UsrPerfil='उपयोगकर्ता प्रोफ़ाइल';
    $MULTILANG_UsrActualizarAdmin='आपकी सेटिंग्स आप व्यवस्थापक उपयोगकर्ता के लिए ईमेल पते अपडेट करने के लिए अपने प्रोफ़ाइल में परिवर्तन होना चाहिए कि कहते हैं। शब्दकोश सुपर उपयोगकर्ता या इसे बदलने के लिए उपयोगकर्ता नाम विकल्प पर ऊपरी उपयोगकर्ता मेनू और Clic के लिए जाओ।';
    $MULTILANG_UsrCreacionOK='खाता उपयोगकर्ता जोड़ा गया है। अब जरूरत है कि आप किसी भी मेनू विकल्प या रिपोर्ट में जोड़ने के लिए फ़िल्टर किया जाता है। इस पल में सही आवंटित करने के लिए आवश्यक नहीं है, तो आप इस कार्रवाई को रद्द कर सकता है.';
    $MULTILANG_UsrSaltarInformes='इस प्रयोक्ता के लिए अधिकारों की रिपोर्ट करने के लिए कूदो';
    $MULTILANG_UsrSaltarMenues='इस उपयोगकर्ता के लिए मेनू के अधिकार के लिए कूदो';
    $MULTILANG_UsrEsPlantilla='दूसरों के लिए एक टेम्पलेट उपयोगकर्ता अनुमतियों के रूप में इस का प्रयोग करें?';
    $MULTILANG_UsrEsPlantillaDes='मेनू अधिकार और इस उपयोगकर्ता को सौंपा रिपोर्टों स्वचालित रूप से एक टेम्पलेट के रूप में प्रयोग व्यक्तियों के लिए प्रत्येक प्रविष्टि के दौरान नकल की जाएगी। यह आपको सामान्य टेम्पलेट्स के अनुसार अद्यतन यूजर प्रोफाइल को बनाए रखने के लिए अनुमति देता है।  Remember: template users cannot login into the system.';
    $MULTILANG_UsrPlantillaAplicar='खाका अनुमतियों प्रत्येक प्रविष्टि को लागू करने के लिए';
    $MULTILANG_UsrPlantillaAplicarDes='वे एक एक आय बनाने के लिए इस नए उपयोगकर्ता को हस्तांतरित किया जाएगा सूची में चयनित उपयोगकर्ता को सौंपा अनुमतियों';
    $MULTILANG_UsrPermisoManual='मैनुअल अधिकार';
    $MULTILANG_UsrDesClaveACorreo='कृपया जाँच करें कि ई-मेल खाते से सही है। क्योंकि उस खाते में हम आप प्रणाली का उपयोग करने के लिए एक यादृच्छिक पासवर्ड भेज देंगे इस खाते को सत्यापित किया जाएगा';
    $MULTILANG_UsrFinRegistro='अपने हस्ताक्षर की प्रक्रिया को सफलतापूर्वक समाप्त हो गया था। जहां आप प्रणाली का उपयोग करने के लिए एक यादृच्छिक पासवर्ड के साथ एक स्वागत संदेश मिल आपके मेल इनबॉक्स की जाँच करें व्यापार निर्देशिका महत्वपूर्ण:। अपने स्पैम फ़ोल्डर की जाँच करने के लिए भी अगर आप अपने standar इनबॉक्स में किसी भी संदेश को देख न याद रखें।';

	//Proceso de instalacion
	$MULTILANG_Instalacion='अधिष्ठापन प्रक्रिया';
	$MULTILANG_SubtituloPractico1='वेब आवेदन जेनरेटर';
	$MULTILANG_SubtituloPractico2='नि: शुल्क और क्रॉस-प्लेटफॉर्म';
	$MULTILANG_InstaladorAplicacion='आवेदन संस्थापक को';
	$MULTILANG_BienvenidaInstalacion='स्थापना प्रक्रिया में आपका स्वागत है';
	$MULTILANG_BienvenidaDescripcion='यह विज़ार्ड वेब अनुप्रयोग विकास के लिए एक दृश्य के वातावरण के रूप Practico उपयोग करने के लिए आप प्रारंभिक विन्यास के हर कदम पर मार्गदर्शन करेंगे';
	$MULTILANG_ResumenLicencia='इस उपकरण के तहत जारी की है GNU-GPL v2';
	$MULTILANG_AmpliacionLicencia='इस लाइसेंस की एक ऑनलाइन नकल में विभिन्न स्वरूपों और भाषाओं में पाया जा सकता है <a href="http://www.gnu.org/licenses/gpl-2.0.html">GNU वेबसाइट</a>';
	$MULTILANG_ChequeoPreprocesador='पूर्वप्रक्रमक सेटिंग जांच';
	$MULTILANG_VistaPreprocesador='अपने PHP विन्यास के एक दृश्य में उपलब्ध है <b> <a target="_blank" href="paso_i.php">[इस लिंक]</a>';
	$MULTILANG_CumplirRequisitos='निम्नलिखित को पूरा करना होगा';
	$MULTILANG_CumplirPDO='पीडीओ एक्सटेंशन सक्षम';
	$MULTILANG_CumplirDrivers='अपने लक्ष्य डेटाबेस के इंजन के प्रकार के लिए पीडीओ चालक';
	$MULTILANG_CumplirGD='जीडी एक्सटेंशन 2 + freetype 2 के लिए ग्राफिक्स और समर्थन की हैंडलिंग +';
	$MULTILANG_ChequeoDirectorios1='निर्देशिका जाँच हो रही है';
	$MULTILANG_ChequeoDirectorios2='निम्न फ़ाइलें और निर्देशिका सही ढंग से संचालित करने के लिए आवेदन के लिए लिखने की अनुमति होना आवश्यक है';
	$MULTILANG_ErrorEscritura='<b> पाया त्रुटियों स्थापना निर्देशिकाओं करने के लिए लिखने की कोशिश कर जब! </b>: <br> नियम पथ उपयोगकर्ता चल वेबसर्वर प्रैक्टिकल लिपियों (आमतौर पर अपाचे हिन्दी www, www के डेटा या समान) के हैं और फ़ोल्डरों के लिए 755 अनुमतियों और के लिए 644 मामले होनी चाहिए। इन अनुमतियों को अद्यतन करने के लिए एक त्वरित तरीका प्रैक्टिकल आदेशों की जड़ से चलाया जा सकता है <br>: <ली> पाते हैं। प्रकार D-चलाना chmod 755 {} \; <li> लगता है (सभी फ़ोल्डर अनुमतियाँ परिवर्तित)। प्रकार एफ चलाना chmod 644 {} \; (सभी फ़ाइल अनुमतियाँ परिवर्तित) <ली> chown-आर www-डेटा * (www-डेटा वेब सेवा चलाता है जो उपयोगकर्ता है कि संभालने)';
	$MULTILANG_ProbarNuevamente='फिर से परीक्षण करें';
	$MULTILANG_ConfiguracionDescripcion='उपकरण के प्रैक्टिकल के साथ ही अन्य महत्वपूर्ण विकल्प के द्वारा उत्पन्न की दुकान उपयोगकर्ता अनुप्रयोगों और जानकारी के लिए इच्छित सेटिंग्स निर्दिष्ट करें। इस विंडो में एक बार तो भरें और सभी आवश्यक जानकारी की पुष्टि करने के लिए सुनिश्चित होना ही प्रस्तुत किया जाएगा';
	$MULTILANG_PuertoNoPredeterminado='(नहीं डिफ़ॉल्ट अगर)';
	$MULTILANG_AyudaTitMotor='MySQL and MariaDB';
	$MULTILANG_AyudaDesMotor='इंजन अधिकारी कर रहे हैं। उनके ऊपर क्या आप इन विशिष्ट आपरेशन करने के लिए समायोजन करने के लिए आवश्यकता हो सकती है अन्य इंजनों में उपकरण का उपयोग कर सकते हैं पीडीओ के लिए विकास और उपकरण के परीक्षण, लेकिन धन्यवाद है।';
	$MULTILANG_AyudaTitBD='डेटाबेस पहले से ही मौजूद होना चाहिए';
	$MULTILANG_AyudaDesBD='अलग इंजनों के लिए यदि आप पहले SQLite डेटाबेस बनाया गया होगा। SQLite के केवल आप अपने वेब सर्वर पर उचित अनुमति है अगर आप के लिए फ़ाइल बनाने की कोशिश करेंगे बी.डी. (जैसे practico.sqlite3) और Practico के साथ जुड़े फ़ाइल नाम निर्दिष्ट करने के लिए आवश्यक के लिए.';
	$MULTILANG_PrefijoCore='Practico आंतरिक टेबल उपसर्ग';
	$MULTILANG_PrefijoApp='आवेदन टेबल उपसर्ग';
	$MULTILANG_AyudaTitPreCore='इसकी एक खाली मूल्य या ऊपरी मामलों की सिफारिश नहीं';
	$MULTILANG_AyudaDesPreCore='';
	$MULTILANG_AyudaTitPreApp='जरूरी';
	$MULTILANG_AyudaDesPreApp='आवेदन तालिकाओं के लिए इस्तेमाल किया उपसर्ग एक ही डेटाबेस पर विभिन्न व्यावहारिक सुविधाएं अलग करने के लिए इस्तेमाल किया जा सकता है या यह / लिंक अन्य अनुप्रयोगों के साथ प्रैक्टिकल पूर्व मौजूदा एकीकृत करने के लिए खाली छोड़ा जा सकता है। इंजन के बीच अनुकूलता के लिए अपरकेस नहीं की सिफारिश की.';
	$MULTILANG_AyudaLlave='उपयोगकर्ता खातों के लिए साइन मूल्य';
	$MULTILANG_NotasImportantesInst1=' <u>जरूरी 1 </u>: पहले से ही मौजूद होना चाहिए Practico के लिए इस्तेमाल किया डेटाबेस इसे करने के लिए कनेक्ट करने और आवश्यक संरचनाओं उत्पन्न करने के लिए। अपने होस्टिंग प्रदाता या Practico के साथ काम करने के लिए पर्याप्त विशेषाधिकार के साथ एक डेटाबेस बनाने के लिए कैसे तंत्र प्रशासक से संपर्क करें। शब्दकोश हिन्दी <u> महत्वपूर्ण 2 </ u>: संस्थापक को डेटाबेस संकेत दिया और कहा कि मैच Practico का उपयोग करता है कि टेबल के नाम पर सभी मौजूदा तालिकाओं को हटा देगा। आप उन्हें में महत्वपूर्ण जानकारी हो सकती है यदि आपको लगता है आगे बढ़ने से पहले एक बैकअप बनाने की सिफारिश की है। अलग Practico प्रतिष्ठानों के बीच एक एकल डाटाबेस साझा करने के लिए प्रत्येक द्वारा इस्तेमाल किया तालिका उपसर्गों को बदल सकते हैं.';
	$MULTILANG_ParametrosApp='आपके आवेदन के लिए पैरामीटर';
	$MULTILANG_ParamNombreEmpresaLargo='आपके संगठन या कंपनी का पूरा नाम';
	$MULTILANG_ParamNombreEmpresa='आपके संगठन या कंपनी का संक्षिप्त नाम';
	$MULTILANG_ParamFechaLanzamiento='तैनाती की तिथि';
	$MULTILANG_ParamNombreApp='आवेदन का नाम';
	$MULTILANG_ParamVersionApp='अपने आवेदन के प्रारंभिक रिलीज़ संस्करण';
	$MULTILANG_AyudaTitNomEmp='शीर्ष पर प्रदर्शित करने के लिए नाम';
	$MULTILANG_AyudaDesNomEmp='यह पाठ अपने संगठन की पहचान करने के लिए एक नाम की आवश्यकता होती है कि रिपोर्ट और आवेदन क्षेत्रों में उपयोग किया जाएगा.';
	$MULTILANG_AyudaTitNomApp='विवरणात्मक नाम';
	$MULTILANG_AyudaDesNomApp='निर्दिष्ट नाम हमेशा के लिए अपने आवेदन के शीर्ष पर प्रकट होता है.';
	$MULTILANG_NotasImportantesInst2='<u> महत्वपूर्ण </ u>: ऐसी लंबी और छोटी अपनी कंपनी का नाम, रिलीज की तारीख, लाइसेंस ग्रंथों और क्रेडिट के रूप में अन्य मापदंडों व्यवस्थापक उपयोगकर्ता के लिए उपलब्ध विकल्पों में बाद में संशोधित किया जा करने में सक्षम हो जाएगा.';
	$MULTILANG_AyudaTitCaptcha='शब्द लंबाई';
	$MULTILANG_AyudaDesCaptcha='उपयोगकर्ताओं प्रणाली प्रत्येक का उपयोग करने में दर्ज करना होगा कि सुरक्षा शब्द में इस्तेमाल प्रतीकों की संख्या को इंगित.';
	$MULTILANG_ModoDepuracion='डिबग मोड';
	$MULTILANG_AyudaTitDebug='दिखाएँ त्रुटियों और चेतावनियों';
	$MULTILANG_AyudaDesDebug='उत्पादन साइटों के लिए इस विकल्प को बंद किया जाना चाहिए। आप यह मान पर बारी, Practico आवेदन निष्पादन के दौरान Hypertext पूर्वप्रक्रमक द्वारा उत्पन्न किया जा सकता है कि सभी त्रुटियों और संदेश आपको दिखाई देगा - पीएचपी';
	$MULTILANG_MotorAuth='प्रमाणीकरण इंजन';
	$MULTILANG_AuthPractico='आंतरिक (एमडी 5 का उपयोग कर Practico टेबल्स)';
	$MULTILANG_AuthLDAP='एलडीएपी (निर्देशिका सर्वर)';
	$MULTILANG_AuthFederado='संघीय (आवेदन मापदंडों के तहत कॉन्फ़िग देखें)';
	$MULTILANG_AyudaDesAuth='एक अलग प्रमाणीकरण इंजन का प्रयोग Practico उपकरण के उपयोगकर्ताओं की रचना नहीं रोकता। जहाज़ के बाहर मोटर एक केंद्रीकृत प्रमाणीकरण पद्धति के रूप में लॉग इन और इसी पासवर्ड मान्य करने के लिए एक विधि के रूप में काम करेंगे, लेकिन प्रोफ़ाइल के अन्य सुविधाओं Practico उपयोगकर्ता से ले रहे हैं। Practico पासवर्ड परिवर्तन बाहरी मोटर से ही नियंत्रित किया जा करने के लिए अक्षम हो जाएगा। व्यवस्थापक उपयोगकर्ता हमेशा अभिगम नियंत्रण विन्यास त्रुटियों को रखने के लिए स्वायत्त रहेगा.';
	$MULTILANG_AyudaTitCript='इंजन द्वारा इस्तेमाल किए गए मुख्य एन्क्रिप्शन प्रकार';
	$MULTILANG_AyudaDesCript='प्रमाणीकरण प्रणाली द्वारा इस्तेमाल के लिए एन्क्रिप्शन के प्रकार को निर्दिष्ट इस्तेमाल किया जाएगा। Practico सत्यापन इंजन भेजने से पहले उपयोगकर्ता द्वारा दर्ज कुंजी मान एन्क्रिप्ट जाएगा।';
	$MULTILANG_AlgoritmoCripto='एन्क्रिप्शन एल्गोरिथम';
	$MULTILANG_Dominio='डोमेन';
	$MULTILANG_UO='संगठनात्मक इकाई या प्रसंग';
	$MULTILANG_AyudaDesLdapIP='इसे सुलझाया जा सकता है, जहां सर्वर आईपी पते या नाम निर्देशिका दर्ज.';
	$MULTILANG_AyudaDesLdapDominio='सर्वर द्वारा उपयोग डोमेन। उदाहरण: यह बनाया जाएगा midominio.com.co internal chain dc=midominio,dc=com,dc=co';
	$MULTILANG_AyudaDesLdapUO='उपयोगकर्ता प्रसंग कनेक्शन। LDAP सर्वर पर मौजूद होना चाहिए, जैसे लोगों को, बिक्री, विपणन, आदि.';
	$MULTILANG_TitInsPaso3='विन्यास लेखन और डेटाबेस से कनेक्ट';
	$MULTILANG_DesInsPaso3='मैं आपके द्वारा निर्दिष्ट मापदंडों के साथ / कोर में स्थित configuracion.php फ़ाइल लिख रहा हूँ और परीक्षण किया जा रहा है निर्दिष्ट डेटाबेस से कनेक्ट.';
	$MULTILANG_ErrorEscribirConfig='<b> मिला त्रुटियों विन्यास फाइल लिखने की कोशिश कर रहा है! </ b>:। शब्दकोश आप एक विकल्प के अपने खुद के मूलभूत मूल्यों / फ़ाइल कोर / configuracion.php या ws_llaves.php या कोर में ws_oauth.php अपने वांछित परिवर्तन के आधार पर निहित बदलने के लिए हो सकता है चाहते हैं br <> आप भी configuracion.php के लिए फ़ाइल अनुमतियाँ बदलने और इस विज़ार्ड के साथ फिर से कोशिश कर सकते हैं शब्दकोश।';
	$MULTILANG_ErrorConexBD='डेटाबेस से कनेक्ट करते <b> त्रुटियों को मिल गया! </ b>: पिछले चरण में प्रवेश किया मूल्यों की जाँच करें और पुन: प्रयास शब्दकोश।';
	$MULTILANG_InfoPaso3='<b> सब कुछ पीडीओ के बुनियादी विन्यास के साथ ठीक लगता है। अंतिम चरण के लिए अपने डेटाबेस कोशिश कर रहा तरह स्थापना विज़ार्ड बताने के लिए </ b> हिन्दी:<br><br>
				<li><b>1.</b> जोड़ें डेटा डेटाबेस, इस Practico कोर टेबल पर प्रारंभिक उपयोगकर्ता (प्रशासन), मेनू और अन्य रिकॉर्ड भी शामिल है शुरू करते हैं। इस नए प्रतिष्ठानों के लिए सबसे अच्छा विकल्प है।
				<li><b>2.</b> यह कोई आपरेशन डेटाबेस पर निष्पादित किया जाना यह दर्शाता है कि, के रूप में डेटाबेस छोड़ दें। यह विकल्प डिजाइन किए अनुप्रयोगों और सक्रिय उपयोगकर्ताओं में शामिल है कि एक मौजूदा डेटाबेस पर स्थापित करने की कोशिश कर जब उपयोगी है। यह भी नया भी उपयोगकर्ताओं का उपयोग करने के लिए नहीं किया जाएगा प्रतिष्ठानों और चयन करने के लिए विकल्प के लिए एक खाली डेटाबेस के रूप में समझा जा सकता है.';
	$MULTILANG_BtnAplicarBD='1. BD के प्रारंभिक जानकारी जोड़ें';
	$MULTILANG_BtnNoAplicarBD='2. लॉग इन बी.डी. संशोधित न करें';
	$MULTILANG_ExeScripts='रनिंग डेटाबेस स्क्रिप्ट (यदि लागू हो)';
	$MULTILANG_ErrorScripts='डेटाबेस पर क्वेरी को क्रियान्वित करने में त्रुटि';
	$MULTILANG_IrInstalacion='अपने Practico स्थापना करने के लिए जाओ';
	$MULTILANG_Totalejecutado='कुल प्रश्नों मार डाला';
	$MULTILANG_MsjFinal1='If this is a new installation can enter the system through <b> credentials admin / admin </ b> and change then as you desire.';
	$MULTILANG_MsjFinal2='पूरी तरह से अन्य व्यक्ति को किसी भी नुकसान हो सकता है एक उत्पादन प्रणाली पर फिर से इन स्क्रिप्ट चलाने को रोकने के लिए </ u> </ b> स्थापना निर्देशिका (फ़ोल्डर / आईएनएस) को हटाने के लिए याद रखें।';
	$MULTILANG_MsjFinal2='आपरेशन के सारांश को मार डाला';
	$MULTILANG_AuthLDAPTitulo='एलडीएपी आधारित लॉगिन';
	$MULTILANG_AuthOauthPlantilla='टेम्पलेट उपयोगकर्ता';
	$MULTILANG_AuthOauthId='ग्राहक ID';
	$MULTILANG_AuthOauthSecret='हमारे ग्राहकों का सीक्रेट';
	$MULTILANG_AuthOauthURI='यूआरआई पुन: निर्देशित करें';
	$MULTILANG_OauthTitURI='आगे बढ़ने से पहले, आपको एक आईडी प्राप्त करने के लिए प्रदाता के साथ एक नया आवेदन रजिस्टर करना चाहिए, गुप्त और ऊरी प्रमाणन सेवा config करने के लिए। यूआरआई इस फार्म के लिए प्रत्येक यूआरआई क्षेत्र में Practico द्वारा स्वचालित रूप से गणना की है रजिस्टर करने के लिए।';
	$MULTILANG_OauthDesURI='महत्वपूर्ण: अपने प्रदाता उस के साथ लिंक करने के लिए की आवश्यकता होगी, क्योंकि आपकी वापसी यूआरआई एक डोमेन या सार्वजनिक आईपी के तहत होना चाहिए। इस URI स्वचालित रूप से स्थापना के समय के दौरान पथ के अनुसार बनाया जाता है। प्रत्येक प्रदाताओं के लोगो पर Clic अपने एपीआई पंजीकरण वेबसाइट पर जाने के लिए.';
	$MULTILANG_OauthPredeterminado='एक बार किसी भी OAuth प्रदाता पंजीकृत है, तो आप इतना है कि OAuth विकल्प उन डिफ़ॉल्ट रूप से प्रस्तुत कर रहे हैं आपके सिस्टम स्थापित कर सकते हैं जब सेटिंग्स पैनल से लॉगिन।';
	$MULTILANG_BuscarActual='उन्नयन के लिए खोज स्वचालित रूप से';
	$MULTILANG_DescActual='नई Practicos संस्करणों के लिए जाँच करने के लिए व्यवस्थापक लॉगिन पर बेतरतीब ढंग से खोज करें। इस विकल्प के लिए एक छोटे से धीमी व्यवस्थापक भार बदल सकती है नए संस्करणों के लिए जाँच करता है, जबकि';
	$MULTILANG_ConfGraficas='ग्राफिक विन्यास बदलें';
	$MULTILANG_UsuariosAdmin='सुपर उपयोगकर्ताओं';
	$MULTILANG_UsuariosAdminDes='एक अल्पविराम उपयोगकर्ताओं है कि मंच प्रशासकों और आवेदन डिजाइनरों की सूची अलग कर दिया। आप व्यवस्थापक उपयोगकर्ता निकालना चाहते हैं, तो सुनिश्चित करें कि आप एक और सुपर प्रयोक्ता हो या आप व्यवस्थापक अधिकार खो दिया जाएगा कृपया';
	$MULTILANG_PermitirReseteoClave='पासवर्ड को ठीक करने के लिए अनुमति';
	$MULTILANG_DesPermitirReseteoClave='लॉगिन विंडो कि उपयोगकर्ताओं को एक पासवर्ड रिकवरी जादूगर खोलने के लिए अनुमति में एक पासवर्ड वसूली विकल्प डालता है। यह केवल Practico आंतरिक प्रमाणीकरण इंजन के लिए उपलब्ध है।';
	$MULTILANG_PermitirAutoRegistro='उन ऑटो प्रणाली में साइन अप करने की अनुमति दें';
	$MULTILANG_DesPermitirAutoRegistro='लॉगिन विंडो है कि उपयोगकर्ताओं प्रणाली में आत्म रजिस्टर करने के लिए एक प्रपत्र खोलने के लिए अनुमति में एक साइन-अप विकल्प डालता है। यह केवल Practicos आंतरिक प्रमाणीकरण इंजन के लिए उपलब्ध है।';
	$MULTILANG_UsuarioAutoRegistro='के लिए खाका उपयोगकर्ता को आत्म हस्ताक्षर';
	$MULTILANG_DesUsuarioAutoRegistro='कहते हैं जो उपयोगकर्ता आत्म-पंजीकृत उपयोगकर्ताओं में अधिकारों के लिए इस्तेमाल किया जाएगा';
	$MULTILANG_NoRecomendado='सुरक्षा कारणों के लिए नहीं की सिफारिश की';
	$MULTILANG_UbicacionOauth='Prefered location for Oauth options at login time';
	$MULTILANG_OauthOpcionBoton='As a button that open the OAuth providers';
	$MULTILANG_OauthOpcionDirecta='As extra options directly over standar login window';

	//API-Webservices
	$MULTILANG_WSErrTitulo='Practico WebServices - त्रुटि';
	$MULTILANG_WSErr01='[Cod. 01] अवैध कुंजी';
	$MULTILANG_WSErr02='[Cod. 01] गुप्त मूल्य मान्य नहीं है';
	$MULTILANG_WSErr03='[Cod. 03] WebServices कार्यों फ़ाइल नहीं मिला करता है';
	$MULTILANG_WSErr04='[Cod. 04] Webservice consumers key is empty or null. Check the value you sent or your Practico installation process.';
	$MULTILANG_WSErr05='[Cod. 05] The service identifier, function or method could not be executed, is uknown or is empty.';
	$MULTILANG_WSErr06='[Cod. 06] You dont have permission to run the service: ';
	$MULTILANG_WSErr07='[Cod. 07] API access unauthorized for the address: ';
	$MULTILANG_WSErr08='[Cod. 08] API access unauthorized for the domain: ';
	$MULTILANG_WSConfigButt='WebServices keys';
	$MULTILANG_WSLlavesDefinidas='<b>WebServices consumer Keys</b> (one each line)';
	$MULTILANG_WSLlavesAyuda='Those are the webservices keys that you allow to use Pr&aacute;ctico Webservices or user custom services.  It is not necessary to add your setup pass key cause it is allowed by default over all domains and functions';
	$MULTILANG_WSLlavesNuevo='Add a new API client';
	$MULTILANG_WSLlavesBorrar='You are going to delete the API keys selected.  Any application o foreign connection using that keys will be forbidden by Practico.  This operation can not be undo later, Are you sure?';
	$MULTILANG_WSLlavesNombre='ग्राहक का नाम';
	$MULTILANG_WSLlavesLlave='Key';
	$MULTILANG_WSLlavesSecreto='रहस्य';
	$MULTILANG_WSLlavesURI='Redirect URI';
	$MULTILANG_WSLlavesDominio='Authorized domain(s)';
	$MULTILANG_WSLlavesIP='Authorized IP(s)';
	$MULTILANG_WSLlavesFunciones='अनुमति प्राप्त सेवाएं';
	$MULTILANG_WSLlavesAsterisco='(*) asterisk for any';


	//OAuth
	$MULTILANG_OauthButt='OAuth Autentication';
	$MULTILANG_PreferirOauth='OAuth प्रवेश के दौरान डिफ़ॉल्ट विकल्प पेश';
	$MULTILANG_ProtoTransporte='पसंदीदा परिवहन प्रोटोकॉल';
	$MULTILANG_ProtoTransAUTO='Autodetect by URL';
	$MULTILANG_ProtoTransHTTP='HTTP standard';
	$MULTILANG_ProtoTransHTTPS='HTTP secured';
	$MULTILANG_ProtoDescripcion='Autodetect will check URLs used to access and will enable or disable SSL,  HTTP standard allow people with self-signed certs to connect with the Practicos auth webservice.  This is an unsafe mode but very effective if you need to access.   HTTP Secured requieres a valid SSL cert by a CA on your web server.';

	//Login Federado
	$MULTILANG_TitFederado='संघीय लॉगिन';

	//Modulo de monitoreo
	$MULTILANG_MonTitulo='निगरानी प्रणाली';
	$MULTILANG_MonPgInicio='पृष्ठ प्रारंभ करें';
	$MULTILANG_MonConfig='मॉनिटर विन्यस्त करें';
	$MULTILANG_MonNuevo='एक नए निगरानी जोड़ें';
	$MULTILANG_MonCommShell='शैल कमांड';
	$MULTILANG_MonCommSQL='एसक्यूएल क्वेरी';
	$MULTILANG_MonDesTipo='यह आपको निगरानी पेज को जोड़ना चाहते हैं जो तत्व है';
	$MULTILANG_MonMetodo='इस्तेमाल की विधि';
	$MULTILANG_MonSaltos='लाइन ब्रेक';
	$MULTILANG_MonTamano='एसक्यूएल फ़ॉन्ट आकार';
	$MULTILANG_MonOcultaTit='शीर्षक hidding';
	$MULTILANG_MonCorreoAlerta='अलर्ट ईमेल';
	$MULTILANG_MonAlertaSnd='Soundest alert';
	$MULTILANG_MonMsLectura='पढ़ने के लिए मिलीसेकेंड';
	$MULTILANG_MonDefinidos='Pages & Monitors defined';
	$MULTILANG_MonErr='Name field is mandatory';
	$MULTILANG_MonEstado='व्यवस्था की स्थिति';
	$MULTILANG_MonAcerca='&copy; Monitoring system based on <a target="_blank" href="http://www.practico.org" style="color:#FFFFFF"><font color=white><b>Practico.org</b></font></a>';
	$MULTILANG_AplicaPara='इस के लिए लागू होता है: ';
	$MULTILANG_MonLinea='लाइन पर';
	$MULTILANG_MonCaido='नीचे';
	$MULTILANG_MonAlertaVibrar='मोबाइल उपकरणों पर कंपन';
	$MULTILANG_MonSensorRango='किसी श्रेणी में सेंसर';
	$MULTILANG_MonModoCompacto='कॉम्पैक्ट मोड का उपयोग करें';

    //Modulo de correos
    $MULTILANG_MailIntro1='स्वचालित मंच संदेश';
    $MULTILANG_MailIntro2='Details about this message could be available in the system <span style="font-weight: bold;">'.$NombreRAD.'</span> using your user name and password.';
    $MULTILANG_MailIntro3='This message was delivered by an automatic system, please dont reply to it.';
    $MULTILANG_MailIntro4='Remember that our messages never ask you about personal information, security keys by email</span>, dont answer any message or fill any form that ask you about this kind of information out of our '.$NombreRAD.' system.';
    $MULTILANG_MailIntro5='All the information in this email and all its attachments is confidential for the bussiness and could be used for people who is related to it only. If you receive this message by error please delete it and tell sender about the error, any other operation with this email and its content will be under legal protection.';
    $MULTILANG_MailIntro6='<br><br>A system powered by <a href=http://www.practico.org>www.practico.org</a>';

	//Modulo de chat
	$MULTILANG_UsuariosChat='वे व्यवस्था करने के लिए फिर से प्रवेश जब इस पल में ऑफ़लाइन हैं कि उपयोगकर्ता सभी संदेशों को देखेंगे।';
	$MULTILANG_ChatActivar='चैट मॉड्यूल सक्षम करें?';
	$MULTILANG_ChatTipo1='केवल आंतरिक उपयोगकर्ताओं के बीच';
	$MULTILANG_ChatTipo2='केवल बाहरी उपयोगकर्ताओं के बीच';
	$MULTILANG_ChatTipo3='सभी उपयोगकर्ताओं के लिए';
	$MULTILANG_ChatTipo4='केवल व्यवस्थापक के लिए';
	$MULTILANG_ChatDevel='Developers chat';

	//Modulo de replicas
	$MULTILANG_ReplicaTitulo='अतिरिक्त कनेक्शन और प्रतिकृति';
	$MULTILANG_ReplicaDefinidos='स्वचालित प्रतिकृति सर्वर परिभाषित';
	$MULTILANG_AgregarReplica='एक नए कनेक्शन जोड़े';
	$MULTILANG_ReplicaTodo='एक दर्पण के रूप में प्रयोग करें';
	$MULTILANG_AyudaReplica='परिभाषित मुख्य प्रणाली पर सभी डेटाबेस कार्रवाई इस कनेक्शन पर दोहराया जाना चाहिए। इस valus नहीं है, तो Practico कनेक्शन को परिभाषित करने और इसे तैयार कोड या व्यक्ति के संचालन के द्वारा इस्तेमाल किया जा केवल जब आप चाहते कर देगा।.   This applies for data upgrade operations (Insert,Update,Delete) that was maked by the PCO_EjecutarSQLUnaria() internal function';
	$MULTILANG_ConnAdicionales='अतिरिक्त डेटाबेस कनेक्शन परिभाषित';
	$MULTILANG_ConnPredeterminada='डिफ़ॉल्ट (व्यावहारिक द्वारा प्रयोग किया गया समान कनेक्शन)';
	$MULTILANG_ConnOrigenDatos='डेटा स्रोत';
	$MULTILANG_ConnOrigenDatosDes='निर्धारित करता है कि रिपोर्ट बनाने के लिए डेटा कहाँ लिया जाएगा। डिफ़ॉल्ट रूप से यह प्रैक्टिकल के साथ काम करने के लिए कनेक्शन और डेटाबेस इंजन का उपयोग करता है; लेकिन आप अन्य इंजन या बाहरी कनेक्शन भी चुन सकते हैं और वहां से डेटा निकालने में सक्षम होंगे। अन्य डेटा स्रोत जोड़ने के लिए, अतिरिक्त कनेक्शन और प्रतिकृति विकल्प का उपयोग करें।';
    $MULTILANG_ConnAdvCambioOrigen='सावधानी: किसी डिज़ाइन के बाद रिपोर्ट के लिए उपयोग किए जाने वाले कनेक्शन या डेटा स्रोत को बदलने से रन-टाइम त्रुटियां उत्पन्न हो सकती हैं क्योंकि डेटा संरचना, तालिकाओं और फ़ील्ड नए चयनित कनेक्शन में नहीं मिल सकते हैं। सावधान रहें';

    //Eventos javascript
    $MULTILANG_EventosTit='घटनाक्रम और ट्रिगर वस्तु';
    $MULTILANG_EventosPrevio='इससे पहले कि आप घटनाओं के माध्यम से संचालन को स्वचालित या चलाता कर सकते हैं एक वस्तु या प्रपत्र नियंत्रण पहला बुनियादी नियंत्रण बना सकते हैं और तब संपादन विकल्प को सक्रिय करने के लिए फिर से दर्ज करना होगा।';
    $MULTILANG_EventoClick='एक तत्व पर क्लिक करें';
    $MULTILANG_EventoDobleClick='एक तत्व पर डबल क्लिक करें';
    $MULTILANG_EventoMouseDown='माउस बटन एक तत्व पर दबाया जाता है';
    $MULTILANG_EventoMouseEnter='एक तत्व में माउस संकेतक पाने';
    $MULTILANG_EventoMouseLeave='माउस सूचक एक तत्व से बाहर निकलना';
    $MULTILANG_EventoMouseMove='माउस सूचक एक तत्व के ऊपर बढ़ रहा है';
    $MULTILANG_EventoMouseOver='माउस सूचक एक तत्व खत्म हो गया है';
    $MULTILANG_EventoMouseOut='माउस सूचक एक तत्व या अपने बच्चे के बाहर चला जाता है';
    $MULTILANG_EventoMouseUp='माउस बटन एक तत्व पर जारी की है';
    $MULTILANG_EventoContextMenu='माउस सही बटन दबाया (पहले संदर्भ मेनू दिखाई देता है)';
    $MULTILANG_EventoKeyDown='उपयोगकर्ता एक दबाया कुंजी (प्रपत्र नियंत्रण और शरीर) है';
    $MULTILANG_EventoKeyPress='उपयोगकर्ता प्रेस एक कुंजी (जो पल में दबाया जाता है) (फार्म तत्वों और शरीर)';
    $MULTILANG_EventoKeyUp='उपयोगकर्ता एक चाबी है कि दबाया गया था (फार्म तत्वों और शरीर) जारी';
    $MULTILANG_EventoFocus='एक प्रपत्र तत्व ध्यान केंद्रित हो जाता है';
    $MULTILANG_EventoBlur='एक प्रपत्र तत्व फोकस खो देता है';
    $MULTILANG_EventoChange='एक प्रपत्र तत्व परिवर्तन';
    $MULTILANG_EventoSelect='उपयोगकर्ता एक इनपुट या textarea से पाठ का चयन';
    $MULTILANG_EventoSubmit='फार्म जमा बटन (भेजने से पहले) दबाया जाता है';
    $MULTILANG_EventoReset='पर्चा रीसेट बटन दबाया जाता है';
    $MULTILANG_EventoCut='एक पाठ नियंत्रण में चयनित डेटा cutted थे';
    $MULTILANG_EventoCopy='एक पाठ नियंत्रण में चयनित डेटा नकल थे';
    $MULTILANG_EventoPaste='सामग्री एक पाठ नियंत्रण में पारित किया गया था';
    $MULTILANG_EventoLoad='खिड़की या फ्रेम लोड पूरा किया गया';
    $MULTILANG_EventoUnload='उपयोगकर्ता विंडो बंद करें या फ्रेम';
    $MULTILANG_EventoResize='उपयोगकर्ता बदलता खिड़की ओ फ्रेम आकार';
    $MULTILANG_EventoClose='उपयोगकर्ता विंडो या फ्रेम बंद करने की कोशिश';
    $MULTILANG_EventoScroll='उपयोगकर्ता Windows या नियंत्रण पर एक पुस्तक है कि यह समर्थन करते हैं';
    $MULTILANG_EventoAnimFin='एक सीएसएस एनीमेशन समाप्त हो गया है गया था';
    $MULTILANG_EventoAnimInicio='एक सीएसएस एनीमेशन शुरू किया गया था';
    $MULTILANG_EventoAnimIteracion='एक सीएसएस एनीमेशन फिर आरंभ / दोहराया गया था';
    $MULTILANG_EventoTipoRaton='माउस ईवेंट या पॉइंटिंग डिवाइस';
    $MULTILANG_EventoTipoTeclado='कीबोर्ड ईवेंट';
    $MULTILANG_EventoTipoFormulario='प्रपत्र नियंत्रण घटनाक्रम';
    $MULTILANG_EventoTipoVentana='खिड़कियां और फ़्रेम के लिए ईवेंट';
    $MULTILANG_EventoTipoAnima='एनिमेशन और संक्रमण के लिए ईवेंट';
    $MULTILANG_EventoTipoBateria='बैटरी और इसके चार्ज से संबंधित घटनाएं';
    $MULTILANG_EventoTipoLlamadas='कॉल और टेलिफोनी के साथ जुड़े ईवेंट';
    $MULTILANG_EventoTipoDOM='Events on the DOM tree';
    $MULTILANG_EventoTipoArrastrar='खींचें और ड्रॉप तत्वों से संबंधित ईवेंट';
    $MULTILANG_EventoTipoAudio='ऑडियो और वीडियो इवेंट्स';
    $MULTILANG_EventoTipoInternet='इंटरनेट कनेक्शन घटनाएं';

    //ModuloKanban
    $MULTILANG_TablerosKanban='कंबान बोर्ड';
    $MULTILANG_AgregarNuevaTarea='Add new task';
    $MULTILANG_DesTarea='Kanban बोर्ड में जोड़े जाने वाले कार्य या गतिविधि का सामान्य विवरण। आप उपयोगकर्ता की कहानियों या किसी भी अन्य कार्यप्रणाली जैसे गतिविधि को दस्तावेज बनाना चाहते हैं जैसे अन्य विवरण तकनीकों का भी उपयोग कर सकते हैं।';
    $MULTILANG_AsignadoA='Assigned to';
    $MULTILANG_AsignadoADes='प्रणाली में पंजीकृत उपयोगकर्ता कार्य या गतिविधि एस्टा की यही कारण है कि पूरा करने के लिए जिम्मेदार (यदि लागू हो) है';
    $MULTILANG_FechaLimite='Fecha de finalizaci&oacute;n';
    $MULTILANG_DelKanban='You are going to delete a task from the board and this action could not be undone later. Are you sure?';
    $MULTILANG_Historia1='Minimal user history: [Rol,Functionality,Purpose]';
    $MULTILANG_Historia1Des='As ________ I need ___________ with the purpose of ________.';
    $MULTILANG_Historia2='Intermediate user history: [Rol,Functionality,Purpose]+[Context/Acceptance requirements,Event]';
    $MULTILANG_Historia2Des='As ________ I need ___________ with the purpose of ________.BRBRIn case _______ it should _______';
    $MULTILANG_Historia3='Detailed user history: [ID,Rol,Functionality,Purpose]+[Stage,Context/Acceptance requirements,Event]';
    $MULTILANG_Historia3Des='ID: ______BRAs ________ I need ___________ with the purpose of ________.BRBRScene: ________. In case _______ it should _______';
    $MULTILANG_ListaColumnas='Columns list';
    $MULTILANG_ListaCategorias='Category list';
    $MULTILANG_ArchivarTarea='पुरालेख कार्य';
    $MULTILANG_ArchivarTareaAdv='यह कार्य संग्रहीत किया जाएगा, बोर्ड छोड़ जाएगा और ऐतिहासिक एक पर जाएंगे। क्या आप जारी रखना चाहते हैं?';
    $MULTILANG_TareasArchivadas='Archived tasks';
    $MULTILANG_CompartidosConmigo='Shared with me';
    $MULTILANG_CrearTablero='Add board';
    $MULTILANG_CompartirCon='Shared with';
    $MULTILANG_NoTablero='There is not a Kanban board created by you or shared with you by another user';
    $MULTILANG_ArrastrarTarea='Mueva tareas rapidamente arrastr&aacute;ndolas sobre este t&iacute;tulo.';
    $MULTILANG_TodosLosTableros='All Kanban boards';

    //ModuloBugTracker
    $MULTILANG_BTReporteBugs='Report errors or improvements';
    $MULTILANG_BTUltimaActualizacion='Last update date';
    $MULTILANG_BTSeveridad='Severity';
    $MULTILANG_BTUsuarioReporte='Reported by';
    $MULTILANG_BTAsignadoA='Assigned to';
    $MULTILANG_BTPasos='Steps to reproduce the problem';
    $MULTILANG_BTOrigen='Origin system';
    $MULTILANG_BTTrazas='Traces associated with the error';
    $MULTILANG_BTVersion='Version of the project or product';
    $MULTILANG_BTDescripcion='Description of the error or improvement';
    $MULTILANG_BTFechaCierre='Deadline';
    $MULTILANG_BTProyectoAsociado='Associated project';
    $MULTILANG_BTFechaApertura='Date of opening of the case';
    $MULTILANG_BTHistorial='Management history';
    $MULTILANG_BTCategoriaDes='Please select if this is an application error, an enhancement or a question about Functionality';
    $MULTILANG_BTComplementoDes='If applies, write the step by step procedure to reproduce the error over the sysmte.';
    $MULTILANG_BTPanel='Panel de gesti&oacute;n de errores o bugs';
    $MULTILANG_BTBugtracking='Bugtracking';
    $MULTILANG_BTPermitirReporte='Allow users to send bug reports';

    //Opciones de Documentacion
    $MULTILANG_Documentar='दस्तावेज़';
    $MULTILANG_DocumentarDes='नैसर्गिक दस्तावेज़ संकेतन में कार्य या कार्यविधियों के लिए कोड की शुरुआत में एक प्रलेखन टेम्पलेट जोड़ें';
    $MULTILANG_DocumentarLink='NaturalDocs के लिए अतिरिक्त दस्तावेज़ मदद खोलें';

    //PWA
    $MULTILANG_PWAActivar='प्रगतिशील वेब अनुप्रयोगों के उपयोग को सक्रिय करें';
    $MULTILANG_PWAAyuda='यह पीडब्लूए प्रौद्योगिकी के आवेदन में सक्रिय करने की अनुमति देता है जो आपके एप्लिकेशन को इस तकनीक का समर्थन करने वाले उपकरणों में ब्राउज़रों से मोबाइल एप्लिकेशन के रूप में स्थापना के लिए अनुरोध करने की अनुमति देता है। अधिक जानकारी के लिए लिंक देखें  https://w3c.github.io/manifest/  y  https://developers.google.com/web/progressive-web-apps/';
    $MULTILANG_PWAIconos='ऐप के लिए आइकन की परिभाषा';
    $MULTILANG_PWADescripcion='प्रोग्रेसिव वेब एप्लिकेशन आधिकारिक रूपरेखा द्वारा स्वचालित रूप से तैयार किया गया';
    $MULTILANG_PWADireccionTexto='पाठ दिशा';
    $MULTILANG_PWADisplayPreferido='पसंदीदा डिस्प्ले मोड';
    $MULTILANG_PWAOrientacionPantalla='स्क्रीन अभिविन्यास';
    $MULTILANG_PWAGCM='Firebase क्लाउड मेसेजिंग आईडी';
    $MULTILANG_PWAScope='क्षेत्र (Scope)';
    $MULTILANG_PWAScopeDes='यदि आपका प्रैक्टिको इंस्टॉलेशन आपके वेब सर्वर या सबडोमेन की जड़ पर रहता है, तो आप इसे रिक्त छोड़ सकते हैं। यदि आपकी स्थापना किसी भी फ़ोल्डर पर मौजूद है तो सेवा कर्मचा.री और पीडब्ल्यूए मैनिफेस्ट के दायरे को स्थापित करने के लिए संकेत / फ़ोल्डर दें।';
    $MULTILANG_PWAAutorizarGPS='स्थान प्राप्त करने के लिए प्राधिकरण का अनुरोध (जीपीएस)';
    $MULTILANG_PWAAutorizarFCM='अधिसूचनाएं भेजने का प्राधिकरण अनुरोध (पुश)';
    $MULTILANG_PWAAutorizarCAM='Request authorization to use video device (CAMERA)';
    $MULTILANG_PWAAutorizarMIC='Request authorization to use audio device (MICROPHONE)';
    $MULTILANG_PWAOcultarBarrasExtra='Hide navigation bars to standard users?';
    $MULTILANG_PWAOcultarBarrasExtraDes='It saves space for the application of writing or mobile. Applies only to standard users (non-designers). The developer should guarantee access to certain hidden functions of the bar by means of its own controls, such as, for example, session closing, among others.';
    
    //Planificador de tareas
    $MULTILANG_CronTitulo='Task scheduler';
    $MULTILANG_CronComando='Cron command';
    $MULTILANG_CronComando='Absolute URL';
    $MULTILANG_CronPlanificacion='Type of schedule';
    $MULTILANG_CronAyuda='You can schedule the execution of your scheduled task using the cron daemon and the indicated command or the use of free external tools such as GCP CloudScheduler and the indicated absolute URL. Remember not to disclose the safety code or the execution of the task could be done by anyone who knows it.';
    
	//Pcoder
	$MULTILANG_PCODER_Abrir='खुला';
	$MULTILANG_PCODER_Aceptar='स्वीकार करना';
	$MULTILANG_PCODER_Activar='सक्षम';
	$MULTILANG_PCODER_Archivo='फ़ाइल';
	$MULTILANG_PCODER_Acercar='ज़ूम इन';
	$MULTILANG_PCODER_Alejar='ज़ूम आउट';
	$MULTILANG_PCODER_Ayuda='मदद';
	$MULTILANG_PCODER_Basicos='मूल बातें';
	$MULTILANG_PCODER_Buscar='खोज';
	$MULTILANG_PCODER_Cancelar='रद्द करना';
	$MULTILANG_PCODER_Caracteres='वर्ण';
	$MULTILANG_PCODER_Cargando='लदान';
	$MULTILANG_PCODER_Carpeta='फ़ोल्डर';
	$MULTILANG_PCODER_Cerrar='बंद करे';
	$MULTILANG_PCODER_Columna='स्तंभ';
	$MULTILANG_PCODER_Copiar='प्रतिलिपि';
	$MULTILANG_PCODER_Cortar='कमी';
	$MULTILANG_PCODER_Depurar='डीबग';
	$MULTILANG_PCODER_Desactivar='अक्षम करें';
	$MULTILANG_PCODER_Deshacer='पूर्ववत';
	$MULTILANG_PCODER_Desplazar='चाल';
	$MULTILANG_PCODER_Editar='संपादित';
	$MULTILANG_PCODER_Eliminado='नष्ट कर दिया';
	$MULTILANG_PCODER_Error='एरर';
	$MULTILANG_PCODER_Estado='स्थिति';
	$MULTILANG_PCODER_Explorar='अन्वेषण';
	$MULTILANG_PCODER_Finalizado='समाप्त';
	$MULTILANG_PCODER_Formato='प्रारूप';
	$MULTILANG_PCODER_Guardando='रखना';
	$MULTILANG_PCODER_Guardar='सहेजें';
	$MULTILANG_PCODER_Herramientas='उपकरण';
	$MULTILANG_PCODER_Ir='जाना';
	$MULTILANG_PCODER_Linea='पंक्तियां';
	$MULTILANG_PCODER_Lineas='पंक्तियां';
	$MULTILANG_PCODER_Modificado='संशोधित';
	$MULTILANG_PCODER_No='नहीं';
	$MULTILANG_PCODER_Nombre='नाम';
	$MULTILANG_PCODER_Nuevo='नई';
	$MULTILANG_PCODER_Operacion='आपरेशन';
	$MULTILANG_PCODER_Otros='अन्य लोग';
	$MULTILANG_PCODER_Pegar='पेस्ट';
	$MULTILANG_PCODER_Permisos='अनुमतियां';
	$MULTILANG_PCODER_Predeterminado='चूक';
	$MULTILANG_PCODER_Preferencias='{P}Coder संपादक वरीयताओं';
	$MULTILANG_PCODER_Propietario='मालिक';
	$MULTILANG_PCODER_Reemplazar='की जगह';
	$MULTILANG_PCODER_Rehacer='फिर से करना';
	$MULTILANG_PCODER_Salir='छोड़ना';
	$MULTILANG_PCODER_Seleccionar='चुनना';
	$MULTILANG_PCODER_Si='हाँ';
	$MULTILANG_PCODER_Tamano='आकार';
	$MULTILANG_PCODER_Tipo='टाइप';
	$MULTILANG_PCODER_Trabajando='कार्य';
	$MULTILANG_PCODER_Ubicacion='स्थान';
	$MULTILANG_PCODER_Ver='राय';

	//Mensajes de error y varios
	$MULTILANG_PCODER_Minimap='Code Minimap';
	$MULTILANG_PCODER_AumSangria='बढ़ते हुए अंतर में';
	$MULTILANG_PCODER_DisSangria='समान का आर्डर कम करें';
	$MULTILANG_PCODER_ConvMay='अपरकेस कन्वर्ट';
	$MULTILANG_PCODER_ConvMin='लोअरकेस करने के लिए कन्वर्ट';
	$MULTILANG_PCODER_OrdenaSel='आदेश चयन';
	$MULTILANG_PCODER_CargarArchivo='फाइल लोड करो';
    $MULTILANG_PCODER_Ajuste='विंडो समायोजन';
	$MULTILANG_PCODER_DefPcoder='ऑनलाइन कोड संपादक';
	$MULTILANG_PCODER_EnlacePcoder='कोड संपादक {P}Coder';
	$MULTILANG_PCODER_AtajosTitPcoder='कुंजीपटल अल्प मार्ग';
	$MULTILANG_PCODER_PcoderAjuste='विंडो समायोजन';
	$MULTILANG_PCODER_ErrorRW='आप इस फ़ाइल को लिखने के लिए अधिकार नहीं है! कोई भी परिवर्तन खो जाएगा!';
	$MULTILANG_PCODER_SaltarLinea='लाइन के लिए कूदो';
	$MULTILANG_PCODER_Acerca='के बारे में';
	$MULTILANG_PCODER_AparienciaEditor='संपादक विषय';
	$MULTILANG_PCODER_TamanoFuente='फ़ॉन्ट आकार';
	$MULTILANG_PCODER_LenguajeProg='प्रोग्रामिंग भाषा';
	$MULTILANG_PCODER_VerCaracteres='शो छिपा घर का काम';
	$MULTILANG_PCODER_CerrarVentana='परिवर्तन खो सकता है';
	$MULTILANG_PCODER_PathFull='वेबसर्वर रूट। उपलब्ध फाइल करने के लिए धीमी गति अनुसार हो सकता है।';
	$MULTILANG_PCODER_PathDisco='हार्ड डिस्क जड़';
	$MULTILANG_PCODER_CaracNoImprimibles='दिखाएँ / छुपाएँ अदृश्य पात्रों';
	$MULTILANG_PCODER_PantallaCompleta='पूर्ण स्क्रीन';
	$MULTILANG_PCODER_PanelIzq='बाएं पैनल';
	$MULTILANG_PCODER_PanelDer='राइट पैनल';
	$MULTILANG_PCODER_OcultarPanel='पैनल को छिपाने';
	$MULTILANG_PCODER_RevisarSintaxis='मैं लिखना, जबकि भाषा वाक्यविन्यास चेक';
	$MULTILANG_PCODER_SeleccionarTodo='सबका चयन करें';
	$MULTILANG_PCODER_DepuraErrorSiguiente='अगले त्रुटि के लिए जाना';
	$MULTILANG_PCODER_DepuraErrorPrevio='पिछली त्रुटि के लिए जाना';
	$MULTILANG_PCODER_EnrollarSeleccion='चयनित पाठ मोड़ो';
	$MULTILANG_PCODER_DesenrollarTodo='सभी प्रकट करना';
	$MULTILANG_PCODER_DuplicarSeleccion='डुप्लीकेट चयन';
	$MULTILANG_PCODER_InvertirSeleccion='उलटा चयन';
	$MULTILANG_PCODER_UnirSeleccion='एक लाइन में चयनित शामिल हों';
	$MULTILANG_PCODER_DividirNO='कोई विभाजन कोड संपादक';
	$MULTILANG_PCODER_DividirHorizontal='क्षैतिज विभाजन';
	$MULTILANG_PCODER_DividirVertical='कार्यक्षेत्र विभाजन';
	$MULTILANG_PCODER_ClicSeleccionar='चुनने के लिए क्लिक करें';
	$MULTILANG_PCODER_ExploradorColores='रंग एक्सप्लोरर';
	$MULTILANG_PCODER_TerminalRemota='दूरस्थ टर्मिनल';
	$MULTILANG_PCODER_EditorArchivos='फ़ाइल संपादक';
	$MULTILANG_PCODER_NavegadorEmbebido='एंबेडेड वेब ब्राउज़र';
	$MULTILANG_PCODER_AdvertenciaCierre='आप पूरे {पीआई} कोड संपादक को बंद करने के प्रयास कर रहे हैं। आप संग्रहित किया है एडिट फ़ाइलों को अभी भी याद नहीं होगा। आपका पुष्टि जारी रखने के लिए आवश्यक है।';
	$MULTILANG_PCODER_ErrGuardarDefecto='आप को बचाने या संपादित करने के लिए एक फ़ाइल को खोलने के लिए एक वैध फ़ाइल निर्दिष्ट करना होगा!';
	$MULTILANG_PCODER_ErrGuardarNoPermiso='यदि आप अपने वेब सर्वर उपयोगकर्ता का उपयोग कर इस फाइल को लिखने के अधिकार के लिए है न !. अनुमतियों की जाँच करें और फिर कोशिश करें।';
	$MULTILANG_PCODER_CrearArchivo='नई फ़ाइल';
	$MULTILANG_PCODER_CrearCarpeta='नया फोल्डर';
	$MULTILANG_PCODER_EditarPermisos='अनुमतियाँ संपादित';
	$MULTILANG_PCODER_SubirArchivo='दस्तावेज अपलोड करें';
	$MULTILANG_PCODER_RecargarExplorador='एक्सप्लोरर पुनः लोड';
	$MULTILANG_PCODER_EliminarElemento='फ़ाइल / फ़ोल्डर हटाना';
	$MULTILANG_PCODER_OperacionesFS='फाइल, फोल्डर और अनुमतियाँ कार्यों';
	$MULTILANG_PCODER_ElementoCreado='तत्व बनाया गया है';
	$MULTILANG_PCODER_ElementoExiste='तत्व पहले से मौजूद है';
	$MULTILANG_PCODER_ElementoNoCreado='तत्व, बनाया नहीं जा सकता है नष्ट कर दिया या फ़ाइल प्रणाली पर संशोधित। अपनी अनुमतियाँ जाँच';
	$MULTILANG_PCODER_NrosLinea='दिखाएँ / छुपाएँ लाइन नंबर';
	$MULTILANG_PCODER_CheqSintaxis='सिंटेक्स की जांच';
	$MULTILANG_PCODER_LenguajeResaltado='प्रकाश डाला भाषा';
	$MULTILANG_PCODER_ExtensionNoSoportada='फाइल एक्सटेंशन है कि आप को खोलने के लिए कोशिश कर रहे हैं समर्थित नहीं है। आप समर्थित एक्सटेंशन के लिए इसे जोड़ने सकता है अगर आप इस फाइल को PCoder का उपयोग कर संपादित करना चाहते हैं';
	$MULTILANG_PCODER_HerramientaDiferencias='मतभेद उपकरण';
	$MULTILANG_PCODER_SensibleMayusculas='अक्षर संवेदनशील';
	$MULTILANG_PCODER_Autocompletado='स्वत: पूर्ण रूप में आप टाइप';
	$MULTILANG_PCODER_HistorialVersiones='Version history';
	$MULTILANG_PCODER_ChatDesarrolladores='Developers chat only';
	$MULTILANG_PCODER_ErrorRO='ERROR: This file is locked for open it simultaneously. Only the user or super user can unlock it.';
	$MULTILANG_PCODER_AdvertenciaCierre='WARNING: This file was opened by you in the past but this was not closed propertly.  We advice you to close your sessions and files correctly to avoid simultaneous file locks for other users.';
	$MULTILANG_PCODER_AdvConcurrencia='<font color=red>WARNING WARNING WARNING !!!</font><br>This may also indicate that even you have this file open from another workstation. The file will be open but be careful not to overwrite changes when loading the same work file from different computers or use the <b> File-> Version History </b> option to verify any changes.';