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
	$MULTILANG_PCODER_Ayuda='मदद';
	$MULTILANG_PCODER_Basicos='मूल बातें';
	$MULTILANG_PCODER_Cancelar='रद्द करना';
	$MULTILANG_PCODER_Caracteres='वर्ण';
	$MULTILANG_PCODER_Cargando='लदान';
	$MULTILANG_PCODER_Cerrar='बंद करे';
	$MULTILANG_PCODER_Deshacer='पूर्ववत';
	$MULTILANG_PCODER_Desplazar='चाल';
	$MULTILANG_PCODER_Editar='संपादित';
	$MULTILANG_PCODER_Error='एरर';
	$MULTILANG_PCODER_Estado='स्थिति';
	$MULTILANG_PCODER_Explorar='अन्वेषण';
	$MULTILANG_PCODER_Finalizado='समाप्त';
	$MULTILANG_PCODER_Guardar='सहेजें';
	$MULTILANG_PCODER_Ir='जाना';
	$MULTILANG_PCODER_Lineas='पंक्तियां';
	$MULTILANG_PCODER_Modificado='संशोधित';
	$MULTILANG_PCODER_No='नहीं';
	$MULTILANG_PCODER_Otros='अन्य लोग';
	$MULTILANG_PCODER_Predeterminado='चूक';
	$MULTILANG_PCODER_Preferencias='प्राथमिकताएं';
	$MULTILANG_PCODER_Rehacer='फिर से करना';
	$MULTILANG_PCODER_Salir='छोड़ना';
	$MULTILANG_PCODER_Seleccionar='चुनना';
	$MULTILANG_PCODER_Si='हाँ';
	$MULTILANG_PCODER_Tamano='आकार';
	$MULTILANG_PCODER_Tipo='टाइप';

	//Mensajes de error y varios
	$MULTILANG_PCODER_CargarArchivo='फाइल लोड करो';
    $MULTILANG_PCODER_Ajuste='विंडो समायोजन';
	$MULTILANG_PCODER_DefPcoder='ऑनलाइन कोड संपादक';
	$MULTILANG_PCODER_EnlacePcoder='कोड संपादक {P}Coder';
	$MULTILANG_PCODER_AtajosTitPcoder='कुंजीपटल अल्प मार्ग';
	$MULTILANG_PCODER_PcoderAjuste='विंडो समायोजन';
	$MULTILANG_PCODER_ErrorExistencia='आप खोलना चाहते हैं फ़ाइल नहीं मौजूद करता है!';
	$MULTILANG_PCODER_ErrorRW='आप इस फ़ाइल को लिखने के लिए अधिकार नहीं है! कोई भी परिवर्तन खो जाएगा!';
	$MULTILANG_PCODER_ErrorNoACE='इस फ़ाइल को संपादित करने के लिए कोई स्थापित ऐस मॉड्यूल है';
	$MULTILANG_PCODER_AyudaExplorador='महत्वपूर्ण: कुछ फ़ोल्डरों उनके बारे में एक जानकारीपूर्ण विकल्प के रूप में showd कर रहे हैं। वे केवल संपादन योग्य फाइल किया है वैसे भी, अगर वे विस्तार कर रहे हैं';
	$MULTILANG_PCODER_SaltarLinea='लाइन के लिए कूदो';
	$MULTILANG_PCODER_Acerca='के बारे में';
	$MULTILANG_PCODER_ResumenLicencia='यह उपकरण के तहत नि: शुल्क सॉफ्टवेयर है GNU-GPL v3 License';
	$MULTILANG_PCODER_AparienciaEditor='संपादक विषय';
	$MULTILANG_PCODER_TamanoFuente='फ़ॉन्ट आकार';
	$MULTILANG_PCODER_LenguajeProg='प्रोग्रामिंग भाषा';
	$MULTILANG_PCODER_VerCaracteres='शो छिपा घर का काम';
	$MULTILANG_PCODER_CerrarVentana='परिवर्तन खो सकता है';
	$MULTILANG_PCODER_PathDisponible='उपलब्ध अन्वेषण रास्तों';
	$MULTILANG_PCODER_Path1Punto='PCoder की वर्तमान फ़ोल्डर (आम तौर पर खत्मmod/pcoder)';
	$MULTILANG_PCODER_Path2Punto='मॉड्यूल के रूप में PCoder (आम तौर पर खत्म की जड़mod/pcoder/mod)';
	$MULTILANG_PCODER_Path3Punto='आप पा सकते हैं जहां स्टैंडअलोन के रूप में PCoder (की जड़ LICENSE, AUTHORS, Etc)';
	$MULTILANG_PCODER_Path4Punto='एक मॉड्यूल है, तो स्टैंडअलोन या Practico रूट के रूप में PCoder के लिए रूट स्थापित';
	$MULTILANG_PCODER_PathFull='वेबसर्वर रूट। उपलब्ध फाइल करने के लिए धीमी गति अनुसार हो सकता है।';
	
