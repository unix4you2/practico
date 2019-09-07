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
