<?php
	/*
	Copyright (C) 2013  John F. Arroyave Gutiérrez
						unix4you2@gmail.com

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
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
	$MULTILANG_DescripcionIdioma='हिंदी - Hindi (by GoogleTranslator)';

	//Lexico general
	$MULTILANG_PBROWSER_Cerrar='बंद करे';
	$MULTILANG_PBROWSER_DireccionWeb='यहां एक वेब पता दर्ज';
	$MULTILANG_PBROWSER_Anonimo='गुमनाम';
	$MULTILANG_PBROWSER_En='में';
	$MULTILANG_PBROWSER_Entrar='लॉग इन करें';
	$MULTILANG_PBROWSER_Config='सेटिंग्स';

	//Configuraciones de navegacion
	$MULTILANG_PBROWSER_PanelConfig='ब्राउज़र विकल्प';
	$MULTILANG_PBROWSER_ConfigQueHace='क्या इस सेटिंग करता है?';
	$MULTILANG_PBROWSER_ConfigDes='यह सेटिंग्स आप आदि नेविगेशन के प्रकार, चरित्र संहिताकरण, जैसे वेब पृष्ठों को लोड करने के लिए इस्तेमाल कर रहे हैं कि ब्राउज़र सेटिंग और एक अन्य चीजों का अनुकरण करने की अनुमति';
	$MULTILANG_PBROWSER_MiniformFull='वेब के शीर्ष में एक वेब पता दर्ज करने के लिए एक फार्म शामिल';
	$MULTILANG_PBROWSER_RemoverScriptFull='हटाये ग्राहक साइड स्क्रिप्ट (यानी। जावास्क्रिप्ट)';
	$MULTILANG_PBROWSER_CookiesFull='कुकीज़ भंडारण की अनुमति';
	$MULTILANG_PBROWSER_CookiesOtroFull='इस सत्र के लिए भंडारण कुकीज़ केवल';
	$MULTILANG_PBROWSER_ImagenesFull='वेब साइट पर लोड छवियों';
	$MULTILANG_PBROWSER_ReferenciaFull='वास्तविक संदर्भित साइट देखें';
	$MULTILANG_PBROWSER_Rotate13Full='पते में एक ROT13 संहिताकरण का प्रयोग करें';
	$MULTILANG_PBROWSER_Base64Full='पते में एक Base64 संहिताकरण का प्रयोग करें';
	$MULTILANG_PBROWSER_MetaTagsFull='मेटा टैग से बचें';
	$MULTILANG_PBROWSER_TituloFull='पृष्ठ शीर्षक से बचें';
	$MULTILANG_PBROWSER_NavegandoComo='आप उपयोगकर्ता के रूप में ब्राउज़ कर रहे हैं';
	$MULTILANG_PBROWSER_ResumenLicencia='यह उपकरण जीएनयू-जीपीएल v3 लाइसेंस के तहत नि: शुल्क सॉफ्टवेयर है';
	$MULTILANG_PBROWSER_Acerca='PBrowser बारे में';

	//Mensajes de error y varios
	$MULTILANG_PBROWSER_UsuarioClave='के लिए अपने यूज़रनेम और पासवर्ड दर्ज';
	$MULTILANG_PBROWSER_Usuario='उपयोगकर्ता';
	$MULTILANG_PBROWSER_Clave='पासवर्ड';
	$MULTILANG_PBROWSER_ErrorTitulo='प्रॉक्सी के माध्यम से ब्राउज़ करने के लिए कोशिश कर रहा है, जबकि एक त्रुटि हुई है';
	$MULTILANG_PBROWSER_ErrorURL='यूआरएल त्रुटि';
	$MULTILANG_PBROWSER_FalloHost='निर्दिष्ट मेजबान से कनेक्ट करने में विफल। संभावित समस्याओं सर्वर नहीं मिला था, कनेक्शन का समय समाप्त हो, या मेजबान से इनकार कर दिया संबंध रहे हैं। फिर से कनेक्ट करने का प्रयास करें और पता सही है या नहीं।';
	$MULTILANG_PBROWSER_ListaNegra='आप का उपयोग करने के लिए प्रयास कर रहे हैं यूआरएल इस सर्वर द्वारा काली सूची में डाला गया है। अन्य यूआरएल का चयन करें।';
	$MULTILANG_PBROWSER_URLMala='आपके द्वारा दर्ज URL विकृत है। आप सही URL दर्ज किया है या नहीं इसकी जाँच करें।';
	$MULTILANG_PBROWSER_ErrorRecurso='संसाधन त्रुटि';
	$MULTILANG_PBROWSER_ArchivoGrande='अपने डाउनलोड करने के लिए प्रयास कर रहे हैं फ़ाइल बहुत बड़ी है।';
	$MULTILANG_PBROWSER_MaximoPosible='अधिकतम अनुमेय फ़ाइल का आकार है ';
	$MULTILANG_PBROWSER_PesoArchivo='अनुरोध फ़ाइल आकार है ';
	$MULTILANG_PBROWSER_HotLink='यह आप एक दूरस्थ वेबसाइट से इस प्रॉक्सी के माध्यम से एक संसाधन का उपयोग करने की कोशिश कर रहे हैं कि प्रतीत होता है। सुरक्षा कारणों से ऐसा करने के लिए नीचे दिए गए फ़ॉर्म का उपयोग करें।';
	
