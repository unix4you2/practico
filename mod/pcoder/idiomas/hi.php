<?php
	/*
	   PCODER (Editor de Codigo en la Nube)
	   Sistema de Edicion de Codigo basado en PHP
	   Copyright (C) 2013  John F. Arroyave Gutiérrez
						   unix4you2@gmail.com
						   www.practico.org

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
	*/

	/*
		Title: Idioma hindi para modulo de PBrowser
		Ubicacion *[/inc/idioma/hi.php]*.  Incluye la definicion de variables utilizadas para presentar mensajes en el idioma correspondiente
		NOTAS IMPORTANTES:
			* Por cuestiones de rendimiento se recomienda la definicion usando comillas simples.
			* Usar las dobles solo cuando se requieran variables o caracteres especiales.
			* Se pueden definir cadenas en funcion de otras definidas con anterioridad
			* Se puede hacer uso de notacion HTML dentro de las cadenas para dar formato
	*/

	// Cadena que describe el archivo de idioma para su escogencia
	$MULTILANG_PCODER_DescripcionIdioma='हिंदी - Hindi (by GoogleTranslator)';

	//Lexico general
	$MULTILANG_PCODER_Abrir='खुला';
	$MULTILANG_PCODER_Archivo='फ़ाइल';
	$MULTILANG_PCODER_Acercar='ज़ूम इन';
	$MULTILANG_PCODER_Alejar='ज़ूम आउट';
	$MULTILANG_PCODER_Ayuda='मदद';
	$MULTILANG_PCODER_Basicos='मूल बातें';
	$MULTILANG_PCODER_Buscar='खोज';
	$MULTILANG_PCODER_Cancelar='रद्द करना';
	$MULTILANG_PCODER_Caracteres='वर्ण';
	$MULTILANG_PCODER_Cargando='लदान';
	$MULTILANG_PCODER_Cerrar='बंद करे';
	$MULTILANG_PCODER_Columna='स्तंभ';
	$MULTILANG_PCODER_Copiar='प्रतिलिपि';
	$MULTILANG_PCODER_Cortar='कमी';
	$MULTILANG_PCODER_Depurar='डीबग';
	$MULTILANG_PCODER_Deshacer='पूर्ववत';
	$MULTILANG_PCODER_Desplazar='चाल';
	$MULTILANG_PCODER_Editar='संपादित';
	$MULTILANG_PCODER_Error='एरर';
	$MULTILANG_PCODER_Estado='स्थिति';
	$MULTILANG_PCODER_Explorar='अन्वेषण';
	$MULTILANG_PCODER_Finalizado='समाप्त';
	$MULTILANG_PCODER_Formato='प्रारूप';
	$MULTILANG_PCODER_Guardando='रखना';
	$MULTILANG_PCODER_Guardar='सहेजें';
	$MULTILANG_PCODER_Ir='जाना';
	$MULTILANG_PCODER_Linea='पंक्तियां';
	$MULTILANG_PCODER_Lineas='पंक्तियां';
	$MULTILANG_PCODER_Modificado='संशोधित';
	$MULTILANG_PCODER_No='नहीं';
	$MULTILANG_PCODER_Otros='अन्य लोग';
	$MULTILANG_PCODER_Pegar='पेस्ट';
	$MULTILANG_PCODER_Predeterminado='चूक';
	$MULTILANG_PCODER_Preferencias='{P}Coder संपादक वरीयताओं';
	$MULTILANG_PCODER_Reemplazar='की जगह';
	$MULTILANG_PCODER_Rehacer='फिर से करना';
	$MULTILANG_PCODER_Salir='छोड़ना';
	$MULTILANG_PCODER_Seleccionar='चुनना';
	$MULTILANG_PCODER_Si='हाँ';
	$MULTILANG_PCODER_Tamano='आकार';
	$MULTILANG_PCODER_Tipo='टाइप';
	$MULTILANG_PCODER_Ver='राय';

	//Mensajes de error y varios
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
	$MULTILANG_PCODER_ResumenLicencia='यह उपकरण के तहत नि: शुल्क सॉफ्टवेयर है GNU-GPL v3 License';
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
	
