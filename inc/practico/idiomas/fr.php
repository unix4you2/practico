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
		Title: Idioma ingles
		Ubicacion *[/inc/idioma/en.php]*.  Incluye la definicion de variables utilizadas para presentar mensajes en el idioma correspondiente
		NOTAS IMPORTANTES:
			* Por cuestiones de rendimiento se recomienda la definicion usando comillas simples.
			* Usar las dobles solo cuando se requieran variables o caracteres especiales.
			* Se pueden definir cadenas en funcion de otras definidas con anterioridad
			* Se puede hacer uso de notacion HTML dentro de las cadenas para dar formato
	*/

	// Cadena que describe el archivo de idioma para su escogencia
	$MULTILANG_DescripcionIdioma='Frances - French (by GoogleTranslator)';

	//Lexico general (palabras y frases comunes a varios modulos)
	$MULTILANG_Accion='Action';
	$MULTILANG_Actualizacion='Mettre à jour';
	$MULTILANG_Actualizar='Surclassement';
	$MULTILANG_Administre='Gérer';
	$MULTILANG_Agregar='Ajouter';
	$MULTILANG_Ambiente='Environnement';
	$MULTILANG_Ambos='Tous les deux';
	$MULTILANG_Anonimo='Anonyme';
	$MULTILANG_Anterior='Précédent';
	$MULTILANG_Apagado='De';
	$MULTILANG_Apariencia='Apparence';
	$MULTILANG_Aplicacion='Application';
    $MULTILANG_Aplicando='Appliquer';
    $MULTILANG_Archivo='Fichier';
	$MULTILANG_Asistente='Sorcier';
	$MULTILANG_Atencion='Attention';
	$MULTILANG_Avanzado='Avancée';
	$MULTILANG_Ayuda='Aidez-moi';
	$MULTILANG_Basedatos='Base de données';
	$MULTILANG_Basicos='Les bases';
    $MULTILANG_BarraHtas='Barre doutils';
    $MULTILANG_Bienvenido='Bienvenue';
    $MULTILANG_Buscar='Chercher';
	$MULTILANG_Campo='Champ';
	$MULTILANG_Cancelar='Annuler';
	$MULTILANG_Capturar='Capturer';
    $MULTILANG_Cargando='Chargement';
    $MULTILANG_Cargar='Télécharger';
	$MULTILANG_Cerrar='Fermer';
	$MULTILANG_CerrarSesion='Connectez - Out';
	$MULTILANG_Cliente='Client';
	$MULTILANG_CodigoBarras='Code à barre';
	$MULTILANG_Columna='Colonne';
	$MULTILANG_Comando='Commando';
	$MULTILANG_ConfiguracionGeneral='Réglages généraux';
	$MULTILANG_Configuracion='Configuration';
	$MULTILANG_ConfiguracionVarias='Configuration de plusieurs options';
	$MULTILANG_Confirma='Es-tu sur de vouloir continuer?';
	$MULTILANG_Continuar='Continuer';
	$MULTILANG_Contrasena='Mot de passe';
	$MULTILANG_Controlador='Chauffeur';
    $MULTILANG_Copias='Sauvegardes';
	$MULTILANG_Correcto='Droite';
	$MULTILANG_Correo='Email';
	$MULTILANG_Creditos='Sur';
	$MULTILANG_Cualquiera='Tout';
	$MULTILANG_Defina='Définir';
	$MULTILANG_Descargar='Télécharger';
    $MULTILANG_Deshabilitado='Désactivé';
	$MULTILANG_Desplazar='Déplacer';
    $MULTILANG_Detalles='Détails';
	$MULTILANG_Disene='Conception';
	$MULTILANG_Editar='Modifier';
	$MULTILANG_Ejecutar='Exécuter';
	$MULTILANG_Elementos='Éléments';
	$MULTILANG_Eliminar='Effacer';
	$MULTILANG_Embebido='Intégrer';
	$MULTILANG_Encabezados='En-têtes';
	$MULTILANG_Encendido='Sur';
	$MULTILANG_Error='Erreur';
    $MULTILANG_Escritorio='Bureau';
	$MULTILANG_Estado='Statut';
	$MULTILANG_Etiqueta='Étiquette';
    $MULTILANG_Evento='Un événement';
    $MULTILANG_Existentes='Existant';
    $MULTILANG_Explorar='Explorer';
	$MULTILANG_Exportar='Exportation';
	$MULTILANG_Fecha='Date';
	$MULTILANG_Finalizado='Fini';
    $MULTILANG_Filtro='Filtre';
	$MULTILANG_Formularios='Formes';
	$MULTILANG_Funciones='Fonctions pré autorisées';
	$MULTILANG_FuncionesDes='Pour des raisons de sécurité, vos fonctions ou modules personnalisés doivent être préautorisés dans ce champ. Ajoutez les fonctions ou sections séparées par un caractère.';
	$MULTILANG_GeneradoPor='Alimenté par';
	$MULTILANG_General='Général';
	$MULTILANG_Grande='Gros';
	$MULTILANG_Grafico='Graphique';
	$MULTILANG_Guardar='Sauvegarder';
    $MULTILANG_Guardando='Sauvegarde';
	$MULTILANG_Habilitado='Activée';
	$MULTILANG_Habilitar='Habiliter';
    $MULTILANG_Historico='Histoire';
	$MULTILANG_Hora='Temps';
	$MULTILANG_Horizontal='Paysage';
	$MULTILANG_IdiomaPredeterminado='Langage par défaut';
	$MULTILANG_Imagen='Photo';
	$MULTILANG_Importando='Importation';
	$MULTILANG_Importante='Important';
	$MULTILANG_Importar='Importer';
	$MULTILANG_InfoAdicional='Information additionnelle';
	$MULTILANG_Informes='Rapports';
	$MULTILANG_Ingresar='Se connecter';
	$MULTILANG_Instante='Instant';
    $MULTILANG_Ir='Aller';
	$MULTILANG_IrEscritorio='Aller à mon bureau';
	$MULTILANG_Licencia='Licence';
	$MULTILANG_LlavePaso='Clé de signe';
	$MULTILANG_Maquina='Hôte';
	$MULTILANG_Matriz='Matrice';
	$MULTILANG_Mediano='Moyen';
    $MULTILANG_Modulos='Modules';
    $MULTILANG_Mostrando='Montrer';
	$MULTILANG_MotorBD='Moteur de base';
	$MULTILANG_Ninguno='Aucun';
	$MULTILANG_No='Non';
	$MULTILANG_Nombre='Prénom';
	$MULTILANG_NombreRAD='Nom RAD';
    $MULTILANG_Objeto='Objet';
    $MULTILANG_OlvideClave='Jai oublié mon mot de passe';
	$MULTILANG_Opcional='Optionnel';
    $MULTILANG_Opcion='Option';
	$MULTILANG_OpcionesMenu='Options du menu';
	$MULTILANG_Otros='Autres';
	$MULTILANG_Pagina='Page';
	$MULTILANG_ParamApp='Paramètres dapplication';
	$MULTILANG_Paso='Étape';
	$MULTILANG_Pausar='Pause';
	$MULTILANG_Peso='Poids';
	$MULTILANG_Pequeno='Petit';
	$MULTILANG_Personalizado='Douane';
    $MULTILANG_Pestana='Languette';
    $MULTILANG_Plantilla='Modèle';
	$MULTILANG_Predeterminado='Défaut';
    $MULTILANG_Previo='Précédent';
	$MULTILANG_Primero='Premier';
    $MULTILANG_Prioridad='Priorité';
    $MULTILANG_Procesando='En traitement';
    $MULTILANG_ProcesoFin='Processus terminé';
    $MULTILANG_Proveedores='Providers';
	$MULTILANG_Puerto='Port';
    $MULTILANG_Recurrente='Récurrent';
    $MULTILANG_Registrarme='Se connecter';
    $MULTILANG_Regresar='Revenir';
    $MULTILANG_Resultados='Résultats';
	$MULTILANG_SaltarLinea='Aller à la ligne';
    $MULTILANG_Si='Oui';
    $MULTILANG_Siguiente='Prochain';
	$MULTILANG_Seleccionar='Sélectionner';
    $MULTILANG_SeleccioneUno='Choisissez-en un';
    $MULTILANG_Servidor='Serveur';
	$MULTILANG_Suspender='Suspendre';
	$MULTILANG_Tablas='Les tables';
	$MULTILANG_TablaDatos='Tableau de données';
	$MULTILANG_Tamano='Taille';
	$MULTILANG_Tareas='Les tâches';
	$MULTILANG_TiempoCarga='Temps de chargement';
	$MULTILANG_Tipo='Type';
	$MULTILANG_TipoMotor='Type de moteur';
	$MULTILANG_Titulo='Titre';
	$MULTILANG_TotalRegistros='Total des enregistrements trouvés';
	$MULTILANG_Trazabilidad='Traceability';
	$MULTILANG_Truncar='Tronquer';
	$MULTILANG_Ultimo='Dernier';
    $MULTILANG_Usuario='Utilisateur';
	$MULTILANG_Vacio='Vide';
	$MULTILANG_Variables='Variables';
	$MULTILANG_Version='Version';
	$MULTILANG_Vertical='Portrait';
	$MULTILANG_ZonaHoraria='Fuseau horaire';
	$MULTILANG_ZonaPeligro='Zone dangereuse';
	$MULTILANG_VistaImpresion='Affichage de limprimante';
	$MULTILANG_IDGABeacon='ID Google Analytics';
	$MULTILANG_AyudaGABeacon='Les développeurs qui souhaitent disposer d un journal complet ou de statistiques en temps réel sur leurs logiciels utilisant Google Analytics peuvent mettre ici l identifiant unique de leur panneau Google Analytics. Practico enverra toutes les statistiques de votre panneau d analyse en temps réel.';

	//Ventana de login
	$MULTILANG_TituloLogin='Connexion au système';
	$MULTILANG_CodigoSeguridad='Code de sécurité';
	$MULTILANG_IngreseCodigoSeguridad='Entrer le code';
	$MULTILANG_AccesoExclusivo='L accès à ce logiciel est réservé aux utilisateurs enregistrés. Pour votre sécurité, ne partagez jamais votre nom d utilisateur et votre mot de passe.';
	$MULTILANG_LoginNoWSTit='Erreur lors du chargement du service Web d authentification';
	$MULTILANG_LoginNoWSDes='La fonction file_get_contents () ne peut pas charger le fichier de sortie XML construit par le processus d authentification Practico. <br> Vérifiez la configuration / l installation de votre serveur Web pour voir si cette fonction peut fonctionner correctement et sans restrictions. le processus est correct mais votre serveur ne permet pas de charger le fichier XML <br> ouvre le lien suivant et vérifie si votre navigateur charge le XML correctement. Activer le mode débogage sur votre configuration Practicos vous pourriez voir plus de détails:';
	$MULTILANG_OauthLogin='Connectez-vous en utilisant mon réseau social';
	$MULTILANG_LoginClasico='Connectez-vous avec mon compte de ';
	$MULTILANG_LoginOauthDes='Cliquez sur le logo de votre réseau social ou fournisseur favori pour vous connecter en utilisant le même nom d utilisateur et le même mot de passe.';
	$MULTILANG_CaracteresCaptcha='Nombre de caractères ou symboles pour captcha?';
	$MULTILANG_TipoCaptcha='Type de captcha utilisé pour l écran d accès';
	$MULTILANG_TipoCaptchaTradicional='Traditionnel (chiffres et lettres) nécessite PHP GD activé.';
	$MULTILANG_TipoCaptchaVisual='Sélection visuelle des images. Aucune bibliothèque GD requise';
	$MULTILANG_TipoCaptchaPrefijo='Clique sur le';
	$MULTILANG_TipoCaptchaPosfijo='icône pour valider';
    $MULTILANG_SimboloCaptchaCarro='VOITURE';
    $MULTILANG_SimboloCaptchaTijeras='LESCISEAUX';
    $MULTILANG_SimboloCaptchaCalculadora='CALCULATRICE';
    $MULTILANG_SimboloCaptchaBomba='BOMBE';
    $MULTILANG_SimboloCaptchaLibro='LIVRE';
    $MULTILANG_SimboloCaptchaPastel='GÂTEAU';
    $MULTILANG_SimboloCaptchaCafe='CAFÉ';
    $MULTILANG_SimboloCaptchaNube='NUAGE';
    $MULTILANG_SimboloCaptchaDiamante='DIAMANT';
    $MULTILANG_SimboloCaptchaMujer='FEMME';
    $MULTILANG_SimboloCaptchaHombre='HOMME';
    $MULTILANG_SimboloCaptchaBalon='BALLON';
    $MULTILANG_SimboloCaptchaControl='GAMEPAD';
    $MULTILANG_SimboloCaptchaCasa='MAISON';
    $MULTILANG_SimboloCaptchaCelular='TÉLÉPHONE';
    $MULTILANG_SimboloCaptchaArbol='ARBRE';
    $MULTILANG_SimboloCaptchaTrofeo='TROPHÉE';
    $MULTILANG_SimboloCaptchaSombrilla='PARAPLUIE';
    $MULTILANG_SimboloCaptchaUniversidad='UNIVERSITÉ';
    $MULTILANG_SimboloCaptchaCamara='CAMÉRA';
    $MULTILANG_SimboloCaptchaAmbulancia='AMBULANCE';
    $MULTILANG_SimboloCaptchaAvion='AVION';
    $MULTILANG_SimboloCaptchaTren='TRAIN';
    $MULTILANG_SimboloCaptchaBicicleta='BICYCLETTE';
    $MULTILANG_SimboloCaptchaCamion='CAMION';
    $MULTILANG_SimboloCaptchaCorazon='CŒUR';
	$MULTILANG_LogoParteSuperior='Logo en haut à gauche de votre application';
	$MULTILANG_LogoDuranteLogin='Logo au moment de la connexion de votre application';
	$MULTILANG_ResolucionLogos='Si l image chargée n a pas la résolution indiquée, elle sera redimensionnée chaque fois qu elle sera présentée à l utilisateur.';

	//Banderas de campos en formularios
	$MULTILANG_TitValorUnico='La valeur saisie n accepte pas les doublons';
	$MULTILANG_DesValorUnico='Le système va valider les informations entrées dans ce champ, s il y a déjà un enregistrement avec cette valeur dans la base de données ne sera pas autorisé à entrer.';
	$MULTILANG_TitObligatorio='Champs requis';
	$MULTILANG_DesObligatorio='Vous devez entrer une valeur pour ce champ.';

	//Errores y avisos varios
	$MULTILANG_VistaPrev='Aperçu';
	$MULTILANG_TituloInsExiste='ATTENTION: le dossier d installation existe sur le serveur';
	$MULTILANG_TextoInsExiste='Ce message apparaît en permanence à tous les utilisateurs car vous ne supprimez pas le répertoire utilisé pour l installation de Practico. Il est essentiel que le dossier soit supprimé après la fin d une installation pour empêcher tout utilisateur anonyme de recommencer le processus en écrasant les fichiers de configuration ou les bases de données avec des informations importantes pour vous. Si vous avez déjà terminé l installation de Practico pour utilisation en production est important de supprimer ce dossier avant de continuer. Si vous souhaitez supprimer ce dossier, vous pouvez choisir de renommer en temporaire ou en essai. <br> <br> Si vous visualisez ce message lors de la première exécution de ce script et que vous souhaitez effectuer une nouvelle installation, vous pouvez lancer l assistant  <a class="btn btn-primary btn-xs" href="javascript:document.location=\'ins\';"><i class="fa fa-rocket"></i> Cliquez ICI</a> ';
	$MULTILANG_ErrorTiempoEjecucion='Erreur d exécution';
	$MULTILANG_ErrorModulo='Le module principal tente d inclure un module situé dans <b>mod/</b> mais Practico ne peut pas trouver votre point d accès. <br> Vérifiez l état du module, consultez votre administrateur ou supprimez le module en conflit pour éviter ce message.';
	$MULTILANG_ContacteAdmin='Contactez votre administrateur système et signalez ce post.';
	$MULTILANG_ReinicieWeb='Veuillez effectuer les réglages requis et redémarrer votre service Web.';
	$MULTILANG_PHPSinSoporte='Votre installation PHP semble n avoir aucun support';
	$MULTILANG_ErrExtension='Extension PHP manquante, désactivée ou un module est requis';
	$MULTILANG_ErrLDAP=$MULTILANG_PHPSinSoporte.' Le support LDAP est requis pour une utilisation en tant que méthode d authentification externe.<br>'.$MULTILANG_ReinicieWeb.'.<br>L authentification de l utilisateur administrateur restera indépendante pour éviter la perte d accès.';
	$MULTILANG_ErrHASH=$MULTILANG_PHPSinSoporte.' La prise en charge de HASH est requise. <br> Cette extension est requise si vous avez sélectionné un type de cryptage différent pour les mots de passe sur les moteurs jusqu à l authentification externe.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrSESS=$MULTILANG_PHPSinSoporte.' le support des sessions est requis. '.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrGD=$MULTILANG_PHPSinSoporte.' GD Graphics Library est nécessaire. <br> Ceux qui utilisent debian, ubuntu ou ses dérivés peuvent essayer un <b> apt-get install php5-gd </ b> pour l ajouter. Utilisateurs RedHat ou CentOS <b> yum install php-gd </ b>. Les utilisateurs d autres plateformes doivent vérifier leur documentation.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrCURL=$MULTILANG_PHPSinSoporte.' La bibliothèque cURL est requise. <br> Ceux qui utilisent debian, ubuntu ou ses dérivés peuvent essayer <b> apt-get install php5-gd </ b> pour l ajouter.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrSimpleXML=$MULTILANG_PHPSinSoporte.' La bibliothèque SimpleXML est requise.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrExtensionGenerica=$MULTILANG_PHPSinSoporte.' activated for this library or extension.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrPDO=$MULTILANG_PHPSinSoporte.' Un support PDO est requis.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrDriverPDO=$MULTILANG_PHPSinSoporte.' pour PDO. '.$MULTILANG_ReinicieWeb;
	$MULTILANG_ObjetoNoExiste='L objet associé à cette requête n existe pas.';
	$MULTILANG_ErrorDatos='Problème dans les données d entrée';
	$MULTILANG_ErrorTitAuth='<blink>ACCÈS REFUSÉ!</blink>';
	$MULTILANG_ErrorDesAuth='<div align=left>Les informations d identification fournies pour l accès au système n ont pas été acceptées. Certaines causes courantes sont: <br> <li> Le nom d utilisateur ou le mot de passe est incorrect. <br> <li> Code de sécurité entré incorrectement. <br> <li> Votre identifiant est désactivé. <br> <li> Compte bloqué l accès par plusieurs tentatives avec un mot de passe incorrect.</div>';
	$MULTILANG_ErrorSoloAdmin='Seul l utilisateur administrateur peut voir les détails de la transaction avec le mode débogage activé';
	$MULTILANG_ErrGoogleAPIMod='OAuth2 pour Google a été configuré comme méthode d auth. Par défaut, le module Practicos pour google-api n est pas encore installé. <br> Veuillez télécharger le module Google-api depuis le site Practicos et recharger à nouveau.';
	$MULTILANG_ErrFuncion='<br>La fonction PHP n existe pas ou est désactivée sur votre serveur:';
	$MULTILANG_ErrDirectiva='L environnement var doit être activé sur votre configuration PHP ou web server';
    $MULTILANG_AdminArchivos='Gestionnaire de fichiers';
    $MULTILANG_ErrorConnLDAP='Une erreur s est produite pendant la connexion au serveur LDAP. Veuillez vérifier vos paramètres puis essayez une nouvelle fois. Détails:<br>';
    $MULTILANG_ErrorRW='Il n y a pas de droits pour écrire le fichier! Tout changement à son contenu pourrait être perdu';
    $MULTILANG_ErrorExistencia='Le nom de fichier que vous avez demandé pour l édition n existe pas!';
    $MULTILANG_ErrorNoACE='Le module ACE n a pas été trouvé en train de modifier le fichier';
    $MULTILANG_AyudaExplorador='Important: certains dossiers sont affichés car les informations à ce sujet existent uniquement. Peut-être, les dossiers se développent s ils n ont que des fichiers modifiables.';
    $MULTILANG_EnlacePcoder='{PCoder}: Éditeur de code';
    $MULTILANG_AtajosTitPcoder='Raccourci clavier';
    $MULTILANG_AvisoSistema='Message système';
    $MULTILANG_PcoderAjuste='Réglage de la fenêtre';
    $MULTILANG_PcoderAjusteConfirma='Vous allez recharger cette fenêtre pour redimensionner la fenêtre en tant que votre résolution maximale. Lorsque vous rechargez cette fenêtre, vous pouvez perdre tout changement que vous n avez pas déjà enregistré. Voulez-vous continuer?';
    $MULTILANG_BuscaCriterios='Vous devez entrer un mot clé à rechercher';
    $MULTILANG_EstadoPHP='Info PHP';
    $MULTILANG_ArchivosLimpiados='Fichiers nettoyés / purgés';
    $MULTILANG_EspacioLiberado='Espace disque libéré';
    $MULTILANG_TitDemo='La fonction demandée n est pas disponible';
    $MULTILANG_MsjDemo='Vous êtes dans une installation en mode DEMO (ou démonstration). De telles installations ne vous permettent pas d interagir librement avec tous les contrôles de sécurité. Cela permet d assurer que vous serez toujours disponible pour tous les utilisateurs qui veulent essayer la plate-forme.';
    $MULTILANG_SeparadorCampos='Valeur de chaîne pour le séparateur de champs';
    $MULTILANG_SeparadorCamposDes='Utilisé pour séparer les valeurs dans les requêtes sur le moteur de base de données. Cela devrait être une valeur inhabituelle pour garder une correspondance avec les données saisies par les utilisateurs';
    $MULTILANG_SelectorIdioma='Les utilisateurs peuvent changer de langue au moment de la connexion';
    $MULTILANG_SelectorIdiomaAyuda='Affiche une liste de sélection lors de la connexion avec toutes les langues disponibles dans la plate-forme.';
    $MULTILANG_ErrorConexionInternet='Il semble que vous ne disposiez plus d Internet, la connexion au système sera restaurée lorsque votre connexion Internet est normale. <br> <br> Vérifiez que votre connexion réseau ou votre signal de données est actif.';
    $MULTILANG_NombreRADDes='Nom utilisé pour le générateur d application. Ceci est également utilisé pour les titres de fenêtres';
    $MULTILANG_SaltoEdicion='Vous êtes sur le point de fermer la modification de l élément en cours et de passer à la fenêtre d édition de l élément sélectionné. Souhaitez-vous continuer?';
    $MULTILANG_ExportacionMasiva='Exportation massive';
    $MULTILANG_AgregarAExportacion='Ajouter un élément à la liste d exportation en masse';
    $MULTILANG_ImagenFondo='Background image';
    $MULTILANG_ImagenFondoDes='Define a background image to customize your application. It is recommended wide but light. Recommendation: You should combine theme colors and controls with the image palette to harmonize your design. By default the value is img/fondo.jpg but you can change it to any relative path from the root of the system, even to animated files.';
    $MULTILANG_ImagenDefecto='Empty for nothing or relative path';
    
	//Asistente disenador aplicaciones
	$MULTILANG_DesAppBoton='Conception de l application';
	$MULTILANG_TitDisenador='La conception de l application <b> est simple et rapide: </ b>';
	$MULTILANG_DefTablas='Définition du tableau';
	$MULTILANG_DesTablas='Les tableaux sont les structures dans lesquelles les informations sont stockées à l aide de formulaires qui leur sont associés.';
	$MULTILANG_DefForms='pour la saisie de données et l information de requête';
	$MULTILANG_DesForms='Ils permettent à l utilisateur d entrer des informations en fonction de certaines validations ou formats, consulter ou même supprimer des enregistrements. L affichage autorise également d autres éléments tels que des pages ou des rapports prédéfinis.';
	$MULTILANG_DefInformes='(graphiques ou tableaux)';
	$MULTILANG_DesInformes='Ils présentent les informations existantes dans les tableaux aux utilisateurs dans différents formats et filtres définis. Vous pouvez créer un type de tableau ou de graphique et être ensuite incorporé dans d autres espaces.';
	$MULTILANG_DefMenus='Pour les utilisateurs';
	$MULTILANG_DesMenus='Liez des objets conçus sous la forme de formulaires ou de rapports avec des icônes graphiques et des descriptions de texte pouvant être sélectionnés par un utilisateur disposant de cette autorisation. Il vous permet également de lier des fonctions externes ou l exécution de commandes personnalisées.';
	$MULTILANG_UsuariosPermisos='Utilisateurs et autorisations';
	$MULTILANG_DefUsuarios='pour accéder à votre application';
	$MULTILANG_DesUsuarios='Définit les informations d identification d accès pour chaque utilisateur et les autorisations disponibles pour accéder aux formulaires, aux rapports ou aux options de menu définies précédemment.';
	$MULTILANG_DefAvanzadas='Outils avancés';
	$MULTILANG_DefMantenimientos='Entretien';
	$MULTILANG_DefPcoder='Éditeur de code en ligne';
	$MULTILANG_DefLimpiarTemp='Nettoyer le dossier temporaire /tmp';
	$MULTILANG_DefLimpiarBackups='Nettoyer les sauvegardes existantes /bkp';
	$MULTILANG_DefPMyDB='Administrateur de base de données avancé';
	$MULTILANG_ConfirmaPMyDB='IMPORTANT: Une manipulation incorrecte des tables et leurs informations par un administrateur de base de données avancé peut entraîner une perte partielle ou totale des informations ainsi que des performances imprévisibles dans leur application. Nous recommandons d utiliser ce gestionnaire de base de données avec le soin impliqué.';

	//Cierre de sesion
	$MULTILANG_SesionCerrada='Votre session a été fermée';
	$MULTILANG_TituloCierre='Cela peut résulter d actions effectuées par l utilisateur comme';
	$MULTILANG_ExplicacionCierre='<li>Fermez volontairement votre session</li>
			<li>Cessez d utiliser le système pendant une longue période</li>
			<li>Avoir plusieurs fenêtres ouvertes en même temps système dans les sections restreintes par admin</li>
			<li>Votre nom d utilisateur ou votre mot de passe n est pas valide pour une opération ultérieure</li>
			<li>Naviguer à l aide de liens ou d autres boutons que ceux autorisés</li>
			<br><strong>Aussi pour les configurations ou les actions sur votre ordinateur comme:</strong><br>
			<li>Votre navigateur ne prend pas en charge les cookies</li>
			<li>Nettoyé le cache des cookies ou des sessions du navigateur lors de l utilisation du système</li>
			<br><strong>Les configurations système aiment aussi:</strong><br>
			<li>Vous avez terminé un processus d installation de la plateforme nécessite un redémarrage de la session</li>
			<li>Le SignKey de l utilisateur ne correspond pas à la clé requise par ce système</li>
			<li>Les informations d identification pour signer une opération ne sont pas valides</li>';

	//Actualizacion de plataforma
	$MULTILANG_ActMsj1='ATTENTION: Veuillez lire cette information avant de continuer';
	$MULTILANG_ActMsj2='Pr&aacute;ctico fournit ce mécanisme pour mettre en œuvre des mises à jour automatiques sur votre système avec des correctifs incrémentiels téléchargés du site Web officiel ou par l assistant de projet pour les mises à jour. Toutefois, avant d appliquer un correctif, il est essentiel que:<br><br>
			<li>Faites une sauvegarde de vos bases de données. Certaines mises à jour peuvent nécessiter la modification de structures sur la base d informations de données susceptibles d affecter.
			<li>Sauvegardez vos fichiers ou votre dossier Practico.
			<li>NETTOYER le dossier de travail Practico (chemin tmp /) qui sera utilisé par l assistant pour décompresser et analyser les fichiers.';
	$MULTILANG_ActUsando='Actuellement vous utilisez la version';
	$MULTILANG_ActPaquete='Paquet / Mise à jour manuelle Patch';
	$MULTILANG_ActSobreescritos='Les fichiers précédents seront écrasés';
	$MULTILANG_CargarArchivo='Téléverser un fichier';
	$MULTILANG_Adjuntando='Joindre un nouveau fichier au système';
	$MULTILANG_ErrorTamano='<b> ATTENTION: </ b> processus interrompu. Le fichier dépasse la limite de taille';
	$MULTILANG_ErrorFormato='<b> ATTENTION: </ b> processus interrompu. Le format du fichier téléchargé n est pas valide';
	$MULTILANG_CargaCorrecta='Le fichier a été téléchargé correctement';
	$MULTILANG_ErrorDesconocido='<b> ATTENTION: </ b> Une erreur inconnue s est produite lors du téléchargement du fichier';
	$MULTILANG_ErrorDescomprimiendo='Déballage du fichier';
	$MULTILANG_ContenidoParche='Contenu du fichier';
	$MULTILANG_ErrorVerAct='Erreur lors du chargement de la version actuelle de Practico. Fichier non trouvé';
	$MULTILANG_ErrorActualiza='Le fichier téléchargé ne semble pas être un package de mise à niveau valide. Fichier non trouvé';
	$MULTILANG_ErrorAntigua='Le fichier patch téléchargé fait référence à une mise à jour la plus ancienne que votre version actuelle';
	$MULTILANG_ErrorVersion='Le fichier de correctif téléchargé nécessite la version suivante';
	$MULTILANG_AvisoIncremental='Vous devez d abord appliquer les correctifs incrémentiels requis pour augmenter la version minimale du système qui nécessite un correctif.';
	$MULTILANG_Integridad='Intégrité';
	$MULTILANG_ResumenParche='Résumé des changements et des fonctionnalités fournis par le patch';
	$MULTILANG_ResumenInstrucciones='Instructions à exécuter sur les tables système';
	$MULTILANG_FinRevision='PROCESSUS D EXAMEN FINI';
	$MULTILANG_ActMsj3='En appliquant les fichiers énumérés ci-dessus va mettre à niveau votre système à la prochaine version';
	$MULTILANG_ActErrGral='Structure, type ou version du fichier non pris en charge';
	$MULTILANG_ActDesde='Mise à jour de la version';
	$MULTILANG_ErrLista='Erreur lors du chargement de la liste des fichiers à sauvegarder';
	$MULTILANG_HaciendoBkp='Faire de la sauvegarde';
	$MULTILANG_ErrBkpBD='Une erreur s est produite lors de la sauvegarde de la base de données';
	$MULTILANG_ActMsj4='Si l un des fichiers n a pas pu être écrit par cet assistant par des problèmes de permissions, le correctif peut également être appliqué manuellement par l administrateur ou en ne copiant que les fichiers manquants';
	$MULTILANG_ActMsj5='Structure ou type de fichier non pris en charge';
	$MULTILANG_ActAlertaVersion='Il existe une nouvelle version de Practico disponible au téléchargement. <br> Nous vous recommandons de télécharger la nouvelle version ou le package de mise à niveau depuis le site officiel et de mettre à jour votre système pour avoir les nouvelles fonctionnalités.';
	$MULTILANG_ActBuscarVersion='Rechercher de nouvelles versions automatiquement';
    $MULTILANG_ActErrEscritura='Erreur d écriture';
    $MULTILANG_ActDesEscritura='AVERTISSEMENT: Il y a des erreurs d écriture dans les fichiers qui vont être mis à jour.
        <br><br>Pour garder l intégrité dans le logiciel, vous ne pouvez pas mettre à niveau jusqu à ce que vous corrigiez les autorisations de fichier pour être inscriptibles par Practico. Les fichiers sont marqués dans la liste en rouge et le texte "'.$MULTILANG_ActErrEscritura.'".  
        <br><br>Résolvez le problème et réessayez.';
    $MULTILANG_ActBackupTipo='Mode de sauvegarde';
    $MULTILANG_ActBackup1='Scripts remplacés pendant ce processus uniquement';
    $MULTILANG_ActBackup3='Scripts remplacés et toute ma base de données';
    $MULTILANG_ActBackupDes='Faire une sauvegarde complète pourrait être une lourde tâche pour le système. Dans les systèmes largement utilisés, un processus de sauvegarde complète doit être effectué par un autre outil qui vous permet d avoir des fichiers cohérents, même avec les utilisateurs travaillant à la volée.';

	//Formularios
	$MULTILANG_ErrFrmDuplicado='Échec de la valeur dupliquée dans le champ. La valeur que vous avez entrée existe déjà dans la base de données. Champ: ';
	$MULTILANG_ErrFrmObligatorio='Vous avez oublié d entrer le champ obligatoire: ';
	$MULTILANG_ErrFrmDatos='Il y a un problème dans les données d entrée';
	$MULTILANG_ErrFrmCampo1='Vous devez entrer un titre ou une étiquette valide pour le champ.';
	$MULTILANG_ErrFrmCampo2='Vous devez entrer un champ valide à lier à la table de données associée au formulaire.';
	$MULTILANG_ErrFrmCampo3='Vous devez entrer un titre ou une étiquette valide pour le bouton.';
	$MULTILANG_ErrFrmCampo4='Vous devez entrer une action valide à exécuter lorsque le contrôle est activé.';
	$MULTILANG_FrmMsj1='Ajouter un élément au formulaire';
	$MULTILANG_FrmTipoObjeto='Type d objet à ajouter';
	$MULTILANG_FrmTipoTit1='Contrôles de données';
	$MULTILANG_FrmTipo1='Champ de texte court';
	$MULTILANG_FrmTipo2='Champ de texte libre / illimité';
	$MULTILANG_FrmTipo3='Champ de texte richement formaté (CKEditor)';
	$MULTILANG_FrmTipo4='Champ de sélection (liste déroulante ComboBox)';
	$MULTILANG_FrmTipo5='Champ de sélection (bouton radio)';
	$MULTILANG_FrmTipoTit2='Présentation et autres contenus';
	$MULTILANG_FrmTipo6='Texte enrichi (en tant qu étiquette)';
	$MULTILANG_FrmTipo7='Wrapper (iFrame)';
	$MULTILANG_FrmTipoTit3='Objets internes';
	$MULTILANG_FrmTipo8='Rapport pré-conçu (tableau de données ou graphique)';
	$MULTILANG_FrmTipo9='Slider (sélecteur de plage numérique - HTML5)';
	$MULTILANG_FrmTipo10='Mot de passe';
	$MULTILANG_FrmTipo11='Valeur de champ comme étiquette';
	$MULTILANG_FrmTipoTit4='Contrôles spéciaux des données';
	$MULTILANG_FrmTipo12='Pièce jointe';
	$MULTILANG_FrmTipo13='Toile (Zone de dessin - HTML5)';
	$MULTILANG_FrmTipo14='Toile (capture de webcam - HTML5)';
	$MULTILANG_FrmTipo15='Sous-formulaire (pour interroger et lire uniquement)';
    $MULTILANG_FrmTipo16='Bouton de commande';
    $MULTILANG_FrmTipo17='Champ de texte richement formaté (Responsive)';
	$MULTILANG_FrmTipo18='Vérifier le champ (CheckBox)';
	$MULTILANG_FrmTipoPincel='Taille de la brosse';
	$MULTILANG_FrmTipoColor='Couleur de la ligne';
	$MULTILANG_FrmTipoAdvertencia='Ce type de contrôles de données devrait être stocké dans votre table dans un texte long ou champ illimité';
	$MULTILANG_FrmValorMinimo='Valeur minimale';
	$MULTILANG_FrmValorMaximo='Valeur maximum';
	$MULTILANG_FrmValorSalto='Valeur de l étape';
	$MULTILANG_FrmTitValorSalto='Combien d unités sautent le curseur sur chaque mouvement?';
	$MULTILANG_FrmTitulo='Titre ou étiquette';
	$MULTILANG_FrmDesTitulo='Le texte qui apparaît à côté du champ indique à l utilisateur les informations à saisir. Vous pouvez utiliser le HTML de base pour un format supplémentaire.';
	$MULTILANG_FrmCampo='Champ lié';
	$MULTILANG_FrmFiltroLista='Liste la condition du filtre';
	$MULTILANG_FrmDesFiltroLista='Condition spéciale que les enregistrements doivent être affichés. Cette condition peut utiliser n importe quel champ de votre table source qui n est pas sélectionné en tant que valeurs. Les valeurs fixes doivent être incluses dans des doubles cotes et vous pouvez utiliser d autres expressions comme ORDER BY, GROUP BY, LIMIT, Etc. Ce champ sera ajouté après une clause WHERE dans la requête. RAPPELEZ-VOUS: Si vous n avez pas une condition mais que vous voulez une commande par ou groupe par, puis ajouter au moins un 1 = 1 avant de s appliquer à la condittion. Vous pouvez utiliser {$ Variable} pour référencer une variable PHP aussi';
	$MULTILANG_FrmCampoOb1='Champ obligatoire pour les contrôles de liaison de données';
	$MULTILANG_FrmDesCampo='Tableau de données sur le terrain qui reliera les informations. Dans les champs de fichier, cela pourrait contenir le chemin relatif vers le fichier téléchargé sur le serveur. Chaque fichier doit avoir au moins un champ pour stocker son chemin';
	$MULTILANG_FrmValUnico='Champ de valeur unique';
	$MULTILANG_FrmTitUnico='Unicité pour les valeurs d entrée';
	$MULTILANG_FrmDesUnico='Indique si le champ peut stocker ou répéter des valeurs dans la base de données. Doit être activé pour les champs représentant les clés primaires dans leur conception et désactivé pour le reste. Vous devez prendre soin de ces formulaires que vous avez besoin de ce champ pour faire des mises à niveau et son message d erreur en double.';
	$MULTILANG_FrmPredeterminado='Valeur par défaut';
	$MULTILANG_FrmDesPredeterminado='Définit la valeur qui apparaît automatiquement dans le champ pour ouvrir la vue de formulaire. Cette valeur peut être hors validation de données. Si une variable de session PHP est entrée, alors Practico prendra sa valeur.';
	$MULTILANG_FrmValida='La validation des données';
	$MULTILANG_FrmValida1='Numéros seulement 0-9 (avec décimale)';
	$MULTILANG_FrmValida2='Seules les lettres a-z A-Z';
	$MULTILANG_FrmValida3='Lettres et chiffres';
	$MULTILANG_FrmValida4='Champ de date utilisant un calendrier unifié';
	$MULTILANG_FrmValida7='Champ de date utilisant des sélecteurs séparés (année, mois et jour)';
	$MULTILANG_FrmValida5='Champ temporel';
	$MULTILANG_FrmValida6='Champ Date et heure';
	$MULTILANG_FrmValida8='Champ Date et heure à l aide du sélecteur unifié';
	$MULTILANG_FrmValidaDes='Type de filtre à appliquer lorsque l utilisateur entre des informations à l aide du clavier';
	$MULTILANG_FrmLectura='Champ de lecture seule';
	$MULTILANG_FrmTitLectura='Définit si vous pouvez modifier sa valeur ou non';
	$MULTILANG_FrmDesLectura='Propriété utile pour les champs ou les formulaires de la requête de l utilisateur qui est nécessaire pour afficher la valeur mais ne pas autoriser la modification';
	$MULTILANG_FrmAyuda='Titre de l aide';
	$MULTILANG_FrmDesAyuda='Texte qui apparaîtra sous forme d en-tête pour le champ texte d aide expliquant à l utilisateur ce qu il faut saisir';
	$MULTILANG_FrmTxtAyuda='Texte d aide';
	$MULTILANG_FrmDesTxtAyuda='Texte intégral avec description de la fonction récapitulative pour le champ. Vous pouvez inclure des instructions de mise en forme, des avertissements ou tout autre message à l utilisateur';
	$MULTILANG_FrmDesPeso='Position dans laquelle le champ apparaît sur le formulaire lorsqu il est affiché à l écran. Commande.';
	$MULTILANG_FrmDesColumna='Colonne pour localiser le champ lorsque la vue du formulaire comporte plusieurs colonnes. Les champs plus grands que les colonnes définies dans le formulaire ne seront pas dessinés';
	$MULTILANG_FrmObligatorio='Obligatoire';
	$MULTILANG_FrmVisible='Visible';
	$MULTILANG_FrmDesVisible='Détermine si le contrôle est visible ou non pour l utilisateur. Si le contrôle gauche n est pas utilisé mais caché';
	$MULTILANG_FrmLblBusqueda='Utiliser pour la recherche d enregistrements? Étiquette';
	$MULTILANG_FrmTitBusqueda='Indique si le champ est utilisé pour rechercher des enregistrements';
	$MULTILANG_FrmDesBusqueda='Laissez vide pour indiquer qu il s agit d un champ normal ou entrez l étiquette qui devrait aller dans le bouton de commande situé sur le côté droit pour faire la recherche d enregistrements';
	$MULTILANG_FrmAjax='Utilisez AJAX pour rechercher (all items)';
	$MULTILANG_FrmAjaxDinamico='Use AJAX to retrieve items dinamically when you type';
	$MULTILANG_FrmTitAjax='Mode de récupération d enregistrement';
	$MULTILANG_FrmDesAjax='Lorsque la boîte est activée, Practico tente de récupérer les informations de journal dans le formulaire en utilisant AJAX. Dans une zone de liste déroulante qui prend ses valeurs à partir d une table, vous pouvez l utiliser pour ajouter un bouton pour actualiser son contenu en ligne.';
	$MULTILANG_FrmTeclado='Ajouter un clavier virtuel';
	$MULTILANG_FrmTitTeclado='Autoriser la saisie des données par le clavier à l écran';
	$MULTILANG_FrmDesTeclado='Lorsqu il est activé sur le formulaire, il affiche un clavier virtuel pour la saisie des informations. Pour l instant, l utilisation du clavier peut violer les validations';
	$MULTILANG_FrmAncho='Largeur';
	$MULTILANG_FrmTitAncho='Quelle largeur devrait occuper le contrôle de l espace';
	$MULTILANG_FrmDesAncho='IMPORTANT: in characters number for simple text fields and pixels rich-text fields. Enter a number of columns, however, note that the width in pixels will vary according to the type of font used by the current theme.  For image or bar code fields this value is for the size of the picture.  For canvas objects you can specify the width and the final scale percent using a pipe character. IE: 400|0.3 will create a 400 pixels object but it will save it as 30% of scale.';
	$MULTILANG_FrmDesAncho2='Minimum recommandé pour les champs de format texte enrichi: 350';
	$MULTILANG_FrmAlto='Hauteur (lignes)';
	$MULTILANG_FrmTitAlto='Combien de lignes doivent être visibles dans le contrôle?';
	$MULTILANG_FrmDesAlto='IMPORTANT: le nombre de lignes pour le texte simple ou en pixels pour le formatage en texte enrichi. Si le texte dépasse le nombre de lignes sont automatiquement ajoutés barres de défilement. Pour les champs d image ou de code à barres, cette valeur correspond à la taille de l image.';
	$MULTILANG_FrmDesAlto2='Champs de format minimum recommandés: 100';
	$MULTILANG_FrmBarra='Barre de formatage';
	$MULTILANG_FrmBarraCKEditor='Disponible pour CKEditor';
	$MULTILANG_FrmBarraSummer='Disponible pour SummerNote (Responsive)';
	$MULTILANG_FrmBarraTipo1='De base: formatage de documents, de caractères et de paragraphes';
	$MULTILANG_FrmBarraTipo2='Standard: Basic + liens et styles de polices';
	$MULTILANG_FrmBarraTipo3='Etendu: Standard + Presse-papiers, recherche-remplacement et orthographe';
	$MULTILANG_FrmBarraTipo4='Avancé: étendu + Insérer des objets et des couleurs';
	$MULTILANG_FrmBarraTipo5='Complète: Avancé + Formulaires et plein écran';
	$MULTILANG_FrmBarraTipo1Summer='De base: mise en forme des caractères et des paragraphes';
	$MULTILANG_FrmBarraTipo2Summer='Standard: Basic + styles de police';
	$MULTILANG_FrmBarraTipo3Summer='Etendu: Standard + Tableaux, liens et lignes';
	$MULTILANG_FrmBarraTipo4Summer='Avancé: Extended + FullScreen et source HTML';
	$MULTILANG_FrmBarraTipo5Summer='Complet: Avancé + Insérer des images et des vidéos';
	$MULTILANG_FrmTitBarra='Type d éditeur utilisé';
	$MULTILANG_FrmDesBarra='Indique le type de barre d outils qui apparaît en haut du contrôle et l utilisateur à effectuer différentes tâches d édition. IMPORTANT: chaque type d éditeur nécessite un espace différent sur le formulaire car il devrait déployer un certain nombre d icônes et différentes options';
	$MULTILANG_FrmFila='Une seule ligne pour cet objet?';
	$MULTILANG_FrmTitFila='Est-ce que Practico doit utiliser une ligne complète pour l objet?';
	$MULTILANG_FrmDesFila='Permet d afficher l objet dans une ligne unique de la table utilisée dans le formulaire';
	$MULTILANG_FrmLista='Liste des options';
	$MULTILANG_FrmTitLista='Quelles options doivent être choisies. Entrez un caractère virgule uniquement pour dire Practico qui a mis une valeur vide au début. Laissez en blanc pour utiliser par défaut le premier enregistrement créé.      Enter _OPTGROUP_|Label to group some options and _OPTGROUP_ only to close groups of options.';
	$MULTILANG_FrmDesLista='Entrez une liste d options séparées par des virgules. Si vous avez besoin de prendre dynamiquement la table d options à partir d une autre application pour utiliser les champs Source de données pour les options. Doit remplir les deux options (liste fixe et source de données), le résultat sera la combinaison';
	$MULTILANG_FrmDesLista2='Virgules séparées';
	$MULTILANG_FrmOrigen='Source de la liste d options';
	$MULTILANG_FrmTitOrigen='Vous devez spécifier la même source (table) dans la liste des valeurs';
	$MULTILANG_FrmDesOrigen='De quel champ sont faits les choix qui affiche la liste';
	$MULTILANG_FrmTitOrigen2='Qu est-ce que c est?';
	$MULTILANG_FrmOrigenVal='Liste des valeurs source';
	$MULTILANG_FrmTitOrigenVal='Vous devez spécifier la même source (table) dans la liste des options';
	$MULTILANG_FrmDesOrigenVal='Champ à partir duquel les valeurs sont prises en interne (à traiter) pour chaque option de la liste.    If the field value contains _OPTGROUP_|Label this will create a group of options and if the value is  _OPTGROUP_ only then this will close the group of options.';
	$MULTILANG_FrmEtiqueta='Valeur de l étiquette (elle sera imprimée sur le formulaire au format HTML)';
	$MULTILANG_FrmURL='URL IFrame';
	$MULTILANG_FrmDesURL='Entrez l adresse de la page qui sera incorporée dans l IFrame';
	$MULTILANG_FrmInforme='Rapport lié';
	$MULTILANG_FrmFormulario='Sous-formulaire lié';
	$MULTILANG_FrmDesCampoVinculo='Mettez ici le nom des champs locaux (champ de formulaire parent) à utiliser pour les données de recherche dans le sous-formulaire';
	$MULTILANG_FrmDesCampoForaneo='Mettez ici le champ Foreign du sous-formulaire à utiliser pour comparer ou rechercher des données dans le champ local pour afficher des données.';
	$MULTILANG_FrmVentana='Créer une fenêtre pour l objet?';
	$MULTILANG_FrmDesVentana='Il n est PAS recommandé d activer ce champ lorsque vous souhaitez intégrer des rapports de type GRAPHIC';
	$MULTILANG_FrmLongMaxima='Longueur maximale';
	$MULTILANG_FrmTit1LongMaxima='Combien de caractères le magasin peut-il stocker?';
	$MULTILANG_FrmTit2LongMaxima='Valeur entre 1 et N, 0 pour désactiver les limites';
	$MULTILANG_FrmBtnGuardar='Ajouter ou mettre à jour l objet / champ';
	$MULTILANG_FrmAgregaBot='Ajouter des boutons et des actions pour former';
	$MULTILANG_FrmTituloBot='Titre ou étiquette';
	$MULTILANG_FrmDesBot='Texte à afficher sur le bouton';
	$MULTILANG_FrmEstilo='Style';
	$MULTILANG_FrmDesEstilo='Aspect graphique pour le contrôle';
	$MULTILANG_FrmTipoAccion='Type d action';
	$MULTILANG_FrmAccionT1='Actions internes';
	$MULTILANG_FrmAccionGuardar='Enregistrer des données';
	$MULTILANG_FrmAccionLimpiar='Nettoyer les données';
	$MULTILANG_FrmAccionEliminar='Supprimer des données (nécessite un champ de valeur unique, même caché)';
	$MULTILANG_FrmAccionActualizar='Actualiser les données';
	$MULTILANG_FrmAccionRegresar='Retourner au bureau';
	$MULTILANG_FrmAccionCargar='Charge de l objet';
	$MULTILANG_FrmAccionT2='Défini par l utilisateur';
	$MULTILANG_FrmAccionExterna='Dans personalizadas.php ou tout autre module installé';
	$MULTILANG_FrmAccionJS='Commande JavaScript';
	$MULTILANG_FrmDesAccion='Commande à exécuter lorsque le contrôle est cliqué. Pour les actions définies, les données de formulaire personalizadas.php seront envoyées à cette routine pour traitement';
	$MULTILANG_FrmAccionCMD='Commande utilisateur';
	$MULTILANG_FrmAccionDesCMD='Nom de l action qui doit exister dans personalizadas.php ou tout autre module qui traitera les informations ou une commande JavaScript à exécuter immédiatement pour l application (si vous devez envoyer un paramètre, vous pouvez utiliser des guillemets pour les inclure). Si vous avez besoin de charger des objets Practicos comme des formulaires ou un rapport, vous pouvez utiliser le même sintax utilisé pour les éléments de menus: frm:XX:Par1:Par2:ParN o inf:XX...  Il existe une commande javascript disponible appelée ImprimirMarco(\'PCO_MarcoImpresionXX\') qui vous permettent d imprimer le contenu du formulaire actif. Vous pouvez utiliser des commandes comme PCO_VentanaPopup(\'http://www.google.com\',\'YourTitle\',\'toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, width=640, height=480\'); . Consultez docs pour un guide complet.';
	$MULTILANG_FrmDesPeso='Position dans laquelle le champ apparaît dans la barre d état du formulaire lorsqu il est affiché à l écran. Commander de gauche à droite';
	$MULTILANG_FrmBotDesVisible='Détermine si le contrôle est visible ou non pour l utilisateur';
	$MULTILANG_FrmRetorno='Titre du retour';
	$MULTILANG_FrmDesRetorno='Texte qui apparaîtra comme un en-tête sur le bureau après avoir effectué l action indiquée par l utilisateur';
	$MULTILANG_FrmTxtRetorno='Retour du texte';
	$MULTILANG_FrmTxtDesRetorno='Texte intégral avec description des mesures prises ou livrées au message utilisateur après l exécution du contrôle';
	$MULTILANG_FrmTxtRetornoIcono='Icône pour le retour';
	$MULTILANG_FrmTxtDesRetornoIcono='Définir une icône pour mettre dans le message. Utilisez la notation AwesomeFonts. I.E.: fa-info-circle pour afficher une icône d information.';
	$MULTILANG_FrmTxtRetornoEstilo='Style CSS pour le message de retour (le cas échéant)';
	$MULTILANG_FrmConfirma='Texte de confirmation';
	$MULTILANG_FrmDesConfirma='Si elle est remplie, le texte apparaîtra comme une exécution de contrôle d avertissement contextuel et attend la confirmation de l utilisateur pour continuer';
	$MULTILANG_FrmBtnGuardarBut='Ajouter une action / un bouton';
	$MULTILANG_FrmDisCampos='Conception générale des champs';
	$MULTILANG_FrmDesObliga='Notez que les champs obligatoires doivent être visibles';
	$MULTILANG_FrmGuardaCol='Enregistrer la colonne';
	$MULTILANG_FrmAumentaPeso='Augmenter le poids (bas)';
	$MULTILANG_FrmDisminuyePeso='Diminuer le poids (haut)';
	$MULTILANG_FrmHlpCambiaEstado='Changer le statut';
	$MULTILANG_FrmAdvDelCampo='IMPORTANT: la suppression de ce champ ne peut pas être visible par les utilisateurs et vous ne pouvez pas annuler cette opération.\n'.$MULTILANG_Confirma;
	$MULTILANG_FrmTitComandos='Définition générale des actions et des commandes';
	$MULTILANG_FrmTipoAcc='Type d action';
	$MULTILANG_FrmAccUsuario='Action de l utilisateur';
	$MULTILANG_FrmOrden='Commander';
	$MULTILANG_FrmAdvDelBoton='IMPORTANT: lorsque vous supprimez le bouton ou l action, les utilisateurs ne peuvent pas afficher ou exécuter la commande associée et vous ne pouvez pas annuler cette opération ultérieurement.\n'.$MULTILANG_Confirma;
	$MULTILANG_FrmObjetos='Objets et champs de données';
	$MULTILANG_FrmDesObjetos='Ajouter un objet ou un champ de données';
	$MULTILANG_FrmDesCampos='Conception générale des champs';
	$MULTILANG_FrmAcciones='Actions, boutons et commandes';
	$MULTILANG_FrmDesBoton='Ajouter un bouton ou une action';
	$MULTILANG_FrmDesAcciones='Définition générale des actions';
	$MULTILANG_FrmVolverLista='Retour à la liste des formulaires';
	$MULTILANG_FrmErr1='Vous devez entrer un titre valide pour le formulaire.';
	$MULTILANG_FrmErr2='Veuillez spécifier un nom valide pour la table de données associée au formulaire.';
	$MULTILANG_FrmAgregar='Ajouter un nouveau formulaire';
	$MULTILANG_FrmActualizar='Actualiser les configurations initiales';
	$MULTILANG_FrmDetalles='Définir les détails du formulaire';
	$MULTILANG_FrmTitVen='Titre de la fenêtre';
	$MULTILANG_FrmDesTit='Texte qui apparaît en haut de la fenêtre';
	$MULTILANG_FrmHlp='Titre de l aide';
	$MULTILANG_FrmDesHlp='Texte qui apparaîtra sous forme de légende pour le support du formulaire';
	$MULTILANG_FrmTxt='Texte d aide';
	$MULTILANG_FrmDesTxt='Texte intégral avec description de la fonction récapitulative pour le formulaire. Texte d introduction pour tout utilisateur';
	$MULTILANG_FrmImagen='Couleur de fond';
	$MULTILANG_FrmImagenDes='Si votre navigateur Web a la prise en charge HTML5, vous pouvez choisir la couleur d arrière-plan. Sinon, vous pouvez taper un code de couleur hexadécimal, c est-à-dire # F2F2F2 ou son nom sous forme de notation HTML, c est-à-dire LightGray';
	$MULTILANG_FrmNumeroCols='Le nombre de colonnes';
	$MULTILANG_FrmDesNumeroCols='Indique le nombre de colonnes à déployer dans les champs lorsque le formulaire est chargé';
	$MULTILANG_FrmCreaDisena='Créer et concevoir';
	$MULTILANG_FrmTitForms='Formulaires définis dans le système';
	$MULTILANG_FrmCamposAcciones='Champs et actions';
	$MULTILANG_FrmAdvDelForm='IMPORTANT: la suppression du formulaire ne permet pas aux utilisateurs d accéder à nouveau aux opérations d interrogation ou à la saisie de données définies. Vous ne pouvez pas annuler cette opération. Cela élimine également toute conception interne de la forme.\n'.$MULTILANG_Confirma;
	$MULTILANG_FrmAdvScriptForm='Modification des scripts (Avancé)';
	$MULTILANG_FrmHlpFunciones='Toutes les fonctions JavaScript définies ici seront incluses dans le formulaire. <br> La fonction FrmAutoRun doit exister (même vide) car elle sera exécutée automatiquement sur chaque chargement de formulaire.';
	$MULTILANG_FrmCopiar='Faire une copie';
	$MULTILANG_FrmAdvCopiar='Une nouvelle copie de cet objet sera créée. Êtes-vous sûr?';
	$MULTILANG_FrmMsjCopia='Maintenant, vous pouvez aller pour modifier votre nouvel objet. Une copie a été faite comme: ';
	$MULTILANG_FrmBordesVisibles='Les bordures de table sont-elles visibles?';
	$MULTILANG_FrmFormatoSalida='Format de sortie';
	$MULTILANG_FrmFormatoEntrada='Format d entrée';
	$MULTILANG_FrmPlantillaArchivo='Nom modèle pour le fichier';
	$MULTILANG_FrmDesPlantillaArchivo='Le modèle est la forme ou le modèle qui sera renommé le fichier après que l utilisateur a téléchargé sur le serveur. Cela peut inclure différentes variables pour modifier le nom et l extension de celui-ci comme exemples. Vous pouvez également le laisser vide pour que les fichiers soient chargés avec le nom d origine des chargements du système de dossiers (non recommandé pour la sécurité).';
	$MULTILANG_FrmErrorCargaGeneral='Une erreur s est produite lors du téléchargement';
	$MULTILANG_FrmErrorCargaTamano='La taille du fichier est supérieure à la taille autorisée';
	$MULTILANG_FrmPlantillaEjemplos='<li> _CAMPOTABLA_: Nom du champ lié sur la table </ li> <li> _FECHA_: Date réelle au format AAAAMMDD </ li> <li > _HORA_: Temps réel du serveur au format HHMMSS </ li> <li> _MICRO_: Temps microsecondes </ li> <li> _HORAINTERNET_: Temps Internet entre 000 et 999 </ li> <li> _USUARIO_: Nom d utilisateur </ li > <li> _EXTENSION_: Extension de fichier </ li> </ i> <b> Exemples: </ b> <li> _USUARIO__ORIGINAL_: Renomme le fichier original avec le nom d utilisateur </ li> <li> formatos / _ORIGINAL_: Va télécharger le fichier dans un formatos / dossier en utilisant le nom d origine. </ Li> <li> _FECHA__HORA__USUARIO_.pdf: Renomme tout le fichier original pour quelque chose comme 20140502_135400_admin.pdf </ li> <li> reportes / _FECHA_.xls: uploadera le fichier dans le dossier reportes et forcera l extension finale à .xls aussi. </ Li> <li> foto__USUARIO_.jpg: Ce fichier aura deux chaînes fixes (foto_ au début et .jpg à la fin ) mais à l intérieur d eux, Practico ajoutera le nom d utilisateur. Faites attention au caractère de soulignement double, l un d entre eux sépare le nom et l autre est pour le modificateur de format. Vous obtiendrez quelque chose comme foto_avelez.jpg </ li> Règle générale: toute chaîne à l intérieur du motif qui ne correspond à aucun modificateur de format sera une chaîne fixe dans le nom du fichier.';
	$MULTILANG_FrmArchivoLink='[Ouvrir le fichier déjà téléchargé]';
	$MULTILANG_FrmCanvasLink='[Dessin ouvert déjà ajouté]';
	$MULTILANG_FrmErrorCam='Il y a une erreur avec le périphérique vidéo. Veuillez vérifier que vous avez installé un appareil vidéo ou une webcam et que vous répondez affirmativement ou acceptez dans votre navigateur pour permettre à Practico d utiliser l appareil.';
    $MULTILANG_FrmPestana='Le titre de l onglet Formulaires dans lequel le contrôle sera publié';
    $MULTILANG_FrmDesPestana='Attribuez l onglet pour cet objet dans le formulaire. Practico crée automatiquement des onglets en fonction des valeurs saisies dans chaque objet. Si vous spécifiez un onglet PCO_NoVisible, le cil n apparaîtra pas aux utilisateurs standard (il sera masqué) mais ses éléments seront normalement ajoutés au formulaire afin de les traiter.';
    $MULTILANG_FrmTagPersonalizado='Balise personnalisée HTML';
    $MULTILANG_FrmDesTagPersonalizado='Permet d ajouter des paramètres à la balise HTML créée sur le formulaire par Practico.
            <br><b>Sélection de listes (combo-box): </b>
                <li><u>data-live-search=true</u> Activer le champ de recherche dans une liste.</li>
                <li><u>multiple</u> Activer la sélection multiple.</li>
                <li><u>data-selected-text-format=count</u> Comptez les éléments sélectionnés à la place des valeurs.</li>
                <li><u>data-max-options=#</u> Maximum d éléments sélectionnés.
                <li><u>data-size=auto|#</u> Combien de lignes sont affichées dans la liste d éléments.</li>
                <li><u>data-style=btn-primary|btn-info|btn-success|btn-warning|btn-danger|btn-inverse</u> Style graphique
                <li><u>disabled</u> Désactive le contrôle</li>
                <li><u>PCO_Delayed</u> If this keyword is found the load of the value is charged at onready time by javascript. Usefull when you have manual items in your combobox and you need to recover its value from the database on form load.</li>
                <BR>
                <b>Boutons (bouton de commande):</b>
                <li><u>btn-group btn-group-justified</u> Développer le bouton à la largeur de ses conteneurs.</li>
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
    $MULTILANG_FrmBtnFull='Charger en plein écran';
    $MULTILANG_FrmBtnObjetivo='Cible HTML';
    $MULTILANG_FrmActualizaAjax='Rechargement dynamique';
    $MULTILANG_FrmActivarInline='<i>Inline</i>: Travaillez en conjonction avec les éléments suivants et précédents';
    $MULTILANG_FrmActivarInlineDes='Autoriser à mettre le contrôle en utilisant un style en ligne pour garder une nouvelle ligne avant de publier le contrôle sur le formulaire. Selon l effet que vous voulez, l élément précédent ou suivant doit activer cette propriété';
    $MULTILANG_FrmTipoCopia='Sélectionnez quel type de copie voulez-vous';
    $MULTILANG_FrmTipoCopia1='En ligne';
    $MULTILANG_FrmTipoCopia2='XML avec ID actuel';
    $MULTILANG_FrmTipoCopia3='XML avec ID dynamique';
    $MULTILANG_FrmTipoCopiaDes1='En ligne: crée un nouvel objet avec un nouvel ID. Cela inclut tous les composants liés pour vous permettre de créer de nouveaux formulaires ou rapports à partir d un objet existant. Cela fonctionne immédiatement sur le système en cours d exécution, en clonant l objet sélectionné.';
    $MULTILANG_FrmTipoCopiaDes2='XML avec ID actuel: Exporte / Importe l objet en utilisant la syntaxe XML pour vous permettre de l importer sur un autre système en utilisant l ID actuel. Utile si vous voulez écraser des formulaires ou des rapports avec des améliorations d autres systèmes.';
    $MULTILANG_FrmTipoCopiaDes3='XML avec ID dynamique: exporte / importe l objet en utilisant la syntaxe XML, mais le nouvel ID de l objet est généré dynamiquement chaque fois que vous importez le fichier avec un ID différent. Utile pour reproduire la fonctionnalité de l option En ligne mais sur différents systèmes.';
	$MULTILANG_FrmTipoCopiaExporta='Copie / Exportation';
	$MULTILANG_FrmCopiaFinalizada='Le processus de copie est déjà terminé. Vous pouvez cliquer sur le bouton de téléchargement pour obtenir le fichier XML.';
	$MULTILANG_FrmImportar='Importer une création à partir d un fichier';
	$MULTILANG_FrmImportarConflicto='Il y a des conflits que vous devez résoudre avant de poursuivre le processus d importation';
	$MULTILANG_FrmImportarGenerado='Nouvel objet a été créé';
	$MULTILANG_FrmImportarAlerta='Un élément avec le même ID interne et le même type que vous voulez importer a été créé dans le système. Le fichier que vous souhaitez importer supprimera l objet réel et le remplira avec les éléments du fichier. Nous vous recommandons de vérifier précédemment si vous voulez vraiment écraser l élément avant de continuer.';
	$MULTILANG_FrmValOnCheck= 'Valeur quand est activé';
	$MULTILANG_FrmValOffCheck='Valeur quand n est pas activé';
	$MULTILANG_FrmValCheckDes='Définir la valeur à attribuer au champ qui sera stocké dans la base de données en fonction de l état du contrôle';
	$MULTILANG_FrmEstiloPestanas='Style d onglet (le cas échéant)';
	$MULTILANG_FrmEstiloTabs='Onglets (onglet-nav)';
	$MULTILANG_FrmEstiloPills='Boutons (nav-pilules)';
	$MULTILANG_FrmEstiloOculto='Invisible';
	$MULTILANG_FrmTextoPlaceHolder='Texte d espace réservé';
	$MULTILANG_FrmDesPlaceHolder='Un texte à afficher dans le champ quand cela n a pas une valeur qui aide les utilisateurs à savoir ce qui devrait y entrer';
	$MULTILANG_FrmOcultarEtiqueta='Masquer l étiquette de champ dans le formulaire';
	$MULTILANG_FrmIdHTML='Identifiant HTML unique pour cet objet. Utile lorsque vous souhaitez programmer des événements pour ce contrôle à l aide de JQuery ou JS lors de l exécution';
	$MULTILANG_FrmValidaExtra='Caractères supplémentaires autorisés';
	$MULTILANG_FrmValidaAyuda='Tout personnage ici sera autorisé pour le validateur';
	$MULTILANG_FrmValida9='Numéros seulement 0-9 (entier)';
	$MULTILANG_FrmValida10='Seulement charset dans le champ de validation supplémentaire';
	$MULTILANG_FrmNombreHTML='Attention: cette valeur est utilisée pour générer l identifiant unique de l élément en HTML et générer automatiquement tous les événements des contrôles et outils liés à votre formulaire. Si vous changez cette valeur, vous risquez de perdre cette programmation d événement spécifique et JavaScript en général que vous avez fait avant votre changement.';
    $MULTILANG_FrmClaseContenedor='Classe CSS du conteneur';
    $MULTILANG_FrmClaseContenedorDes='Cela permet d indiquer si le conteneur de l objet possède une classe CSS native ou un bootstrap spécifique à appliquer au moment de la création de diagramme sur le contrôle à l écran.';
    $MULTILANG_FrmHuerfanos='Des champs orphelins ont été trouvés (en dehors du design visible du formulaire).';
    $MULTILANG_FrmIDHTMDuplicado='Des champs avec un identifiant HTML ou un nom de champ dans une base de données en double ont été trouvés.';
    $MULTILANG_FrmCamposAProposito='Ces champs sont là et peuvent affecter la fonctionnalité du formulaire dans JS gions ou lors du traitement de vos données. Si vous avez généré des champs de ce type de champ, ignorez ce message. Les champs trouvés sont:';
    $MULTILANG_FrmTipoMaquetacion='Type of layout';
    $MULTILANG_FrmTipoMaquetacionDes='Determine how Practico will make multi-column forms. Traditional: use tables and standard columns in HTML. Responsive: use columns based on bootstrap col classes, for which you must specify the class of each in the corresponding fields.';
    $MULTILANG_FrmTradicional='Traditional';
    $MULTILANG_FrmCampoHuerfano='This fields exists in the table linked to the form and doesnt have any field or object linked to them in the form or embeded forms';
    $MULTILANG_FrmDesplazarObjetos='Move down one position all the objects in the column below this element';
    $MULTILANG_FrmEstaSeguro='Are you sure?';


	//Informes
	$MULTILANG_InfErr1='Vous devez spécifier des valeurs pour les champs correspondant à au moins une série de données. <br> Si vous ne voulez pas générer de graphique, vous devez changer le type de rapport en tableau de données';
	$MULTILANG_InfErr2='Vous devez entrer un titre valide pour le rapport.';
	$MULTILANG_InfErr3='Veuillez indiquer un nom valide pour la catégorie associée au rapport.';
	$MULTILANG_InfErrCondicion='La condition spécifiée est invalide ou manque au moins d un côté pour comparaison.';
	$MULTILANG_InfErrCampo='Vous devez entrer un nom de champ valide pour la source de données du rapport.';
	$MULTILANG_InfErrTabla='Vous devez entrer un nom de table valide pour la source de données du rapport.';
	$MULTILANG_InfErr4='Vous devez entrer un titre, une étiquette ou une image valide pour le bouton.';
	$MULTILANG_InfErr5='Vous devez entrer une action valide à exécuter lorsque le contrôle est activé.';
	$MULTILANG_InfAgregaTabla='Ajouter une nouvelle table au rapport';
	$MULTILANG_InfTablaManual='Entrez une table manuellement';
	$MULTILANG_InfDesTablaManual='Si vous ne souhaitez pas sélectionner une table dans la liste supérieure, vous pouvez taper ici un nom de table. Cette option est utile lorsque vous devez accéder à des informations dans des tables internes de Practico ou des tables créées par d autres applications';
	$MULTILANG_InfAliasManual='Spécifiez un alias manuellement';
	$MULTILANG_InfDesAliasManual='Utile pour définir le nom d une table générée à partir d une sous-requête ou spécifiée manuellement';
	$MULTILANG_InfBtnAgregaTabla='Ajouter une table';
	$MULTILANG_InfTablasDef='Tableaux définis dans ce rapport';
	$MULTILANG_InfAlias='Alias';
	$MULTILANG_InfAdvBorrado='IMPORTANT: Si vous supprimez l objet sélectionné, la requête ou le rapport peut être incohérent.\n'.$MULTILANG_Confirma;
	$MULTILANG_InfAgregaCampo='Ajouter un nouveau champ au rapport';
	$MULTILANG_InfCampoDatos='Champ de données';
	$MULTILANG_InfCampoManual='Spécifiez un champ manuellement';
	$MULTILANG_InfDesCampoManual='Si vous ne souhaitez pas sélectionner un champ dans la liste supérieure, vous pouvez taper ici un nom de champ. Cette option est utile lorsque vous avez besoin d accéder à des informations dans les champs internes de Practico ou dans des champs créés par d autres applications';
	$MULTILANG_InfDesAliasManual2='Utile pour définir le nom d un champ généré manuellement ou une sous-requête groupée';
	$MULTILANG_InfBtnAgregaCampo='Ajouter le champ';
	$MULTILANG_InfCamposDef='Les champs définis dans ce rapport';
	$MULTILANG_InfAddCondicion='Ajouter une nouvelle condition au rapport';
	$MULTILANG_InfPrimer='Premier champ ou valeur';
	$MULTILANG_InfOperador='Opérateur de comparaison';
	$MULTILANG_InfSegundo='Deuxième champ ou valeur';
	$MULTILANG_InfMayorQue='Plus grand que ';
	$MULTILANG_InfMenorQue='Moins que';
	$MULTILANG_InfMayorIgualQue='Meilleur que ou égal';
	$MULTILANG_InfMenorIgualQue='Moins que ou égal';
	$MULTILANG_InfDiferenteDe='Différent';
	$MULTILANG_InfIgualA='Égal';
    $MULTILANG_InfPatron='Modèle de correspondance (utilise% comme joker)';
	$MULTILANG_InfDesManual='Dans tous les champs manuels, vous pouvez inclure des expressions ou des chaînes de caractères à l aide de guillemets. Vous pouvez comparer avec vars de session mettant la variable PHP. c est-à-dire: $ PCOSESS_LoginUsuario, $ Nombre_usuario, $ Descripcion_usuario, $ Nivel_usuario, $ Correo_usuario, $ LlaveDePasoUsuario. Si vous voulez utiliser des variables PHP au milieu d une chaîne, vous pouvez la placer à l intérieur des accolades Ie: {$ Variable} et elles seront remplacées par leur valeur globale.';
	$MULTILANG_InfOperador='Ajouter un agrégateur d expressions ou un opérateur logique';
	$MULTILANG_InfOpParentesisA='Parenthèse ouverte';
	$MULTILANG_InfOpParentesisC='Parenthèse close';
	$MULTILANG_InfOpAND='AND logique';
	$MULTILANG_InfOpOR='OR logique';
	$MULTILANG_InfOpNOT='NOT';
	$MULTILANG_InfOpXOR='XOR';
	$MULTILANG_InfTitOp='Quand utiliser cette option?';
	$MULTILANG_InfDesOp='Si vous avez besoin de plus d une phrase pour ajouter à ses résultats de groupe de filtrage de statut ou si plusieurs conditions doivent prévaloir sur certaines opérations, vous pouvez utiliser cette option. Fonctionne de manière indépendante et doit être ajouté comme un enregistrement distinct de la consultation';
	$MULTILANG_InfReco1='Conseil';
	$MULTILANG_InfReco2='N oubliez pas d ajouter ET à chaque condition liant les clés étrangères entre les différentes tables du rapport, le cas échéant (généralement lorsque vous utilisez plusieurs tables).';
	$MULTILANG_InfBtnAddCondic='Ajouter une condition / opérateur';
	$MULTILANG_InfDefCond='Filtre et conditions définies dans ce rapport';
	$MULTILANG_InfTitGrafico='Spécifie les types de graphiques à générer par le rapport';
	$MULTILANG_InfSeriesGrafico1='SÉRIES POUR LE TABLEAU';
	$MULTILANG_InfSeriesGrafico2='Les diagrammes de séries multiples doivent renvoyer le même nombre d étiquettes';
	$MULTILANG_InfNomSerie='Nom de la série';
	$MULTILANG_InfCampoEtiqSerie='Champ d étiquette (axe X)';
	$MULTILANG_InfCampoValor='Champ de valeur (doit être numérique)';
	$MULTILANG_InfVistaGrafico1='APPARENCE et DISTRIBUTION';
	$MULTILANG_InfVistaGrafico2='Sélectionnez en fonction du nombre de séries souhaitées';
	$MULTILANG_InfTipoGrafico='Type de graphique';
	$MULTILANG_InfGrafico1='Région';
	$MULTILANG_InfGrafico3='Ligne';
	$MULTILANG_InfGrafico5='Bar';
	$MULTILANG_InfGrafico7='Donut (une seule série)';
	$MULTILANG_InfActGraf='Mettre à jour le format';
	$MULTILANG_InfAgrupa='Tri et le regroupement';
	$MULTILANG_InfReco3='Utilisez uniquement les champs définis dans votre requête.';
	$MULTILANG_InfCriterioAgrupa='Critères de regroupement';
	$MULTILANG_InfCriterioOrdena='Critères de commande';
	$MULTILANG_InfTitAgrupa='Comment les résultats seront-ils regroupés?';
	$MULTILANG_InfDesAgrupa='Utilisez cette option uniquement si votre rapport gère des opérations telles que la somme, la moyenne ou le compte dans les champs affichés. Par exemple SUM (champ), AVG (champ), COUNT (*). Dans ce cas, entrez les champs (séparés par des virgules) qui doivent regrouper les résultats';
	$MULTILANG_InfTitOrdena='Comment les résultats seront-ils triés?';
	$MULTILANG_InfDesOrdena='Pour trier les résultats en utilisant l un des champs ajoutés. Les champs doivent être séparés par des virgules pour trier vos résultats, si vous le souhaitez, après chaque champ peut utiliser le modificateur ASC ou DESC pour indiquer si ascendant ou descendant';
	$MULTILANG_InfActCriterios='Recharger les critères de tri et de regroupement';
	$MULTILANG_InfTitBotones='Ajouter des boutons ou des actions à chaque enregistrement';
	$MULTILANG_InfDelReg='Supprimer un enregistrement';
	$MULTILANG_InfCargaForm='Charger un formulaire par ID';
	$MULTILANG_InfHlpAccion='Si vous souhaitez charger un formulaire, utilisez cette syntaxe ID: 1: FieldForSearch <br> Si vous voulez charger un rapport, utilisez cette syntaxe ID: 1 <br> Pour supprimer le type d enregistrement associé, utilisez le champ table.field utilisé pour le comparer.';
	$MULTILANG_InfVinculo='Champ lié';
	$MULTILANG_InfDesVinculo='IMPORTANT: Nous supposons que le premier champ ou la première colonne est une valeur de clé unique et principale<br>
				faire l enlèvement ou former des opérations d ouverture.<br>
				Il est recommandé d utiliser des champs qui ont une valeur unique<br>
				sauf si vous souhaitez des opérations de groupe.';
	$MULTILANG_InfDesPeso='Position sur le bouton qui apparaît dans l ensemble sur le côté droit de chaque enregistrement. Commander de gauche à droite.';
	$MULTILANG_InfFiltrar='Filtrer les résultats par conditions spécifiques';
	$MULTILANG_InfCampoAgrupa='Vous permet de regrouper des champs pour les opérations de rapport somme, moyenne ou nombre et champs pour l ordre des résultats';
	$MULTILANG_InfTablasOrigen='Tableaux de données sources';
	$MULTILANG_InfCamposOrigen='Champs de données';
	$MULTILANG_InfCondiciones='Conditions';
	$MULTILANG_InfPropGraf='Propriétés du graphique';
	$MULTILANG_InfDesGraf='Définit les propriétés et l apparence du graphique affiché par le rapport';
	$MULTILANG_InfDesAccion='Définit les actions pouvant être effectuées sur chaque enregistrement affiché par le rapport en tant que Supprimer, Ouvrir un formulaire, les fonctions utilisateur, etc.';
	$MULTILANG_InfVolver='Retour à la liste des rapports';
	$MULTILANG_InfTitulo='Titre du rapport ou graphique';
	$MULTILANG_InfDesTitulo='Texte qui apparaît en haut du rapport généré';
	$MULTILANG_InfDescripcion='La description';
	$MULTILANG_InfDesDescrip='Texte descriptif du rapport. Pas dans sa génération mais est utilisé pour guider l utilisateur dans sa sélection';
	$MULTILANG_InfCategoria='Catégorie';
	$MULTILANG_InfDesCateg='Lorsque l utilisateur accède aux rapports du panneau système, ceux-ci sont classés par catégories. Entrez ici un nom de catégorie sous lequel vous souhaitez publier ce rapport aux utilisateurs.';
	$MULTILANG_InfNivelUsuario='Niveau de l utilisateur';
	$MULTILANG_InfTodoUsuario='Tous les utilisateurs';
	$MULTILANG_InfParam='Modifier les paramètres généraux du rapport';
	$MULTILANG_InfTitNivel='Qui peut voir ce rapport?';
	$MULTILANG_InfDesNivel='Spécifiez le profil utilisateur doit être pour voir ce rapport comme disponible.';
	$MULTILANG_InfAlto='La taille';
	$MULTILANG_InfTitAncho='Définir une largeur fixe?';
	$MULTILANG_InfDesAncho='Cette valeur s applique également si vous avez spécifié une valeur Height. Si vous souhaitez que le rapport apparaisse dans une taille de largeur fixe spécifiée en pixels, laissez vide pour que les données soient déployées sans restrictions de taille. Dans le cas d une image de graphique spécifie sa taille.';
	$MULTILANG_InfTitAlto='Définir une hauteur fixe?';
	$MULTILANG_InfDesAlto='Cette valeur s applique également si vous avez spécifié une valeur Width. Si vous souhaitez que le rapport apparaisse dans une taille de largeur fixe spécifiée en pixels, laissez vide pour que les données soient déployées sans restrictions de taille. Dans le cas de l image de graphique spécifie sa taille.';
	$MULTILANG_InfHlpAnchoalto='Ajouter un <b>px</b> ou <b>%</b> comme vous avez besoin';
	$MULTILANG_InfFormato='Format final';
	$MULTILANG_InfTitFormato='Comment ce rapport est-il affiché?';
	$MULTILANG_InfDesFormato='Indique si le produit final sera un rapport de la table de données ou un graphique.';
	$MULTILANG_InfActualizar='Actualiser le rapport';
	$MULTILANG_InfVistaPrev='Aperçu du rapport';
	$MULTILANG_InfCargaPrev='Charger l aperçu';
	$MULTILANG_InfHlpCarga='Cette option fermera le mode de conception et vous montrera le rapport tel qu il sera affiché à un utilisateur de l application';
	$MULTILANG_InfErrInforme1='Vous devez entrer un titre valide pour le rapport.';
	$MULTILANG_InfErrInforme2='Veuillez spécifier un nom valide pour la catégorie associée au rapport.';
	$MULTILANG_InfTituloAgr='Ajouter un nouveau rapport ou graphique';
	$MULTILANG_InfDetalles='Définir les détails du rapport / graphique';
	$MULTILANG_InfDefinidos='Rapports / graphiques déjà définis dans le système';
	$MULTILANG_InfcamTabCond='Champs, tableaux et conditions';
	$MULTILANG_InfAdvEliminar='IMPORTANT: en supprimant ce rapport, les utilisateurs ne peuvent plus y accéder. Vous ne pouvez pas annuler cette opération. Cela élimine également toute conception interne du rapport.\n'.$MULTILANG_Confirma;
	$MULTILANG_InfErrTamano='Le rapport que vous essayez de générer est un rapport de type graphique, mais le concepteur n a pas spécifié la hauteur et la largeur du graphique résultant. <br> Doit fournir une taille de graphique valide pour générer une image.';
	$MULTILANG_InfGeneraPDF='Permet d exporter ce rapport?';
	$MULTILANG_InfGeneraPDFInfoTit='Disponible uniquement pour les rapports tabulaires';
	$MULTILANG_InfGeneraPDFInfoDesc='Cette option nécessite les extensions php_xml et php_zip si vous souhaitez exporter des fichiers LibreOffice, OpenOffice ou Office 2007. Si vous activez cette option, l heure du rapport peut être supérieure à un rapport normal lorsque vous avez beaucoup d enregistrements dans vos résultats car l utilisateur lancera la requête pour voir les enregistrements à l écran, puis lancera la même requête s il veut les exporter .   OTHER WAYS TO EXPORT ARE AVAILABLE ACTIVATING THE DATATABLE SUPPORT FOR THIS REPORT.';
    $MULTILANG_InfVblesFiltro='Variables globales requises pour le filtre';
    $MULTILANG_InfVblesDesFiltro='Variables PHP (sans le caractère dollar $ et la virgule séparée uniquement) qui doivent être extraites de l environnement global pour être disponibles pour le filtre dans l option conditions pendant la génération d une requête';
    $MULTILANG_InfDataTableResXPag='enregistrements par page';
    $MULTILANG_InfDataTableViendoP='Voir la page';
    $MULTILANG_InfDataTableDe='de';
    $MULTILANG_InfDataTableFiltradoDe='Filtré à partir de';
    $MULTILANG_InfDataTableRegTotal='nombre total d enregistrements';
    $MULTILANG_InfDataTableNoDatos='aucune donnée disponible';
    $MULTILANG_InfDataTableNoRegistros='Aucun enregistrement ne correspond aux critères de recherche';
    $MULTILANG_InfDataTableNoRegistrosDisponibles='Aucun enregistrement disponible';
    $MULTILANG_InfDataTableTit='Support DataTables?';
    $MULTILANG_InfDataTableDes='Permet de transformer le rapport dans un DataTable pour filtrer, rechercher, trier et obtenir des pages de résultats dynamiquement';
    $MULTILANG_InfFormFiltrado='Formulaire avec variables de filtre';
    $MULTILANG_InfFormFiltradoDes='Sélectionnez un formulaire conçu pour entrer les variables de filtre pour le rapport. Cela vous aide à lier un formulaire qui demande aux utilisateurs certaines données avant de charger le rapport.';
    $MULTILANG_InfRetornoFormFiltrado='Voir le rapport filtré';
    $MULTILANG_InfAutoajusteAncho='Auto-largeur pour les cellules générées';
    $MULTILANG_InfBordesCelda='Dessiner une bordure de cellule';
    $MULTILANG_InfBordesTodos='Tous les côtés';
    $MULTILANG_InfBordesArriba='Top seulement';
    $MULTILANG_InfBordesAbajo='Bas seulement';
    $MULTILANG_InfBordesArrAba='Haut et bas';
    $MULTILANG_InfBordesIzq='Côté gauche seulement';
    $MULTILANG_InfBordesDer='Côté droit seulement';
    $MULTILANG_InfBordesIzqDer='Côtés gauche et droit';
	$MULTILANG_OrientacionPagina='Mise en page';
	$MULTILANG_InfTamanoPapel='Taille de papier';
	$MULTILANG_InfReducir='Auto-dimensionner le contenu';
	$MULTILANG_InfTitPersonalizar='Présentation et mise en page personnalisées (facultatif)';
	$MULTILANG_InfEjecutarAccionEn='Exécutez cette action dans';
	$MULTILANG_InfPrecargarEstilos='Précharger les feuilles de style CSS Bootstrap';
	$MULTILANG_BtnEstiloSimple='Bouton simple, style simple';
	$MULTILANG_BtnEstiloPredeterminado='Style par défaut';
	$MULTILANG_BtnEstiloPrimario='Style primaire';
	$MULTILANG_BtnEstiloFinalizado='Style de succès';
	$MULTILANG_BtnEstiloInformacion='Style d information';
	$MULTILANG_BtnEstiloAdvertencia='Style d avertissement';
	$MULTILANG_BtnEstiloPeligro='Style de danger';
	$MULTILANG_InfEditableLinea='En ligne modifiable';
	$MULTILANG_InfPaginacionDatatable='Taille de la page pour les DataTables';
	$MULTILANG_InfPaginacionDatatableDes='Indique à Practico combien d enregistrements doit-il afficher dans la vue par défaut d un datatable';
	$MULTILANG_InfCargaInforme='Charger un rapport par ID';
	$MULTILANG_InfSubtotalesColumna='Colonne AutoSum';
	$MULTILANG_InfSubtotalesColumnaDes='Indique à Practico quel est le numéro de colonne à utiliser pour l autosum dans chaque page. LAISSER EN BLANC POUR ÉVITER TOUT CALCUL.';
	$MULTILANG_InfSubtotalesFormato='Format AutoSum';
	$MULTILANG_InfSubtotalesFormatoDes='Indique à Practico quel est le format de sortie pour les résultats autosum.  <b>Cela permet le HTML et les modèles de base</b> Exemple: _TOTAL_PAGINA_ affiche le total de la page réelle, _TOTAL_INFORME_ indique le total de tous les rapports, _COLUMNA_ affiche le nombre de colonnes utilisé pour totaliser les valeurs. Par exemple ce code HTML montre les résultats centrés et en gras: < div align=center>< b>Total page < i>(colonne: _COLUMNA_)< /i> _TOTAL_PAGINA_ Rapport total: _TOTAL_INFORME_< /b>< /div>';
	$MULTILANG_InfTituloArbitrario='Titre arbitraire';
	$MULTILANG_InfTituloArbitrarioDes='Vous permet d ignorer le titre de colonne fourni par le moteur de base de données et d utiliser à la place cette valeur comme titre dans le rapport soumis. <b> Autorise les variables HTML et PHP de base </b>';
	$MULTILANG_InfSQL='Si vous ajoutez un contenu supérieur à 5 caractères à ce champ de script SQL, le générateur de rapports omettra toute configuration de tables, champs, conditions ou toute autre définition de requête que vous avez définie et essaiera d exécuter directement ce script et de générer le tableau de résultats. Vous pouvez utiliser des variables PHP dans la notation {$ Variable} pour inclure des variables d environnement.';
	$MULTILANG_InfFormsUsan='Formulaires détectés qui utilisent ce rapport de manière intégrée';
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
	$MULTILANG_MnuTitEditar='Modifier l élément de menu';
	$MULTILANG_MnuSelImagen='Cliquez sur une image pour sélectionner';
	$MULTILANG_MnuPropiedad='Propriétés de l objet';
	$MULTILANG_MnuApariencia='CONFIGURATION DE L APPARITION ET DE L EMPLACEMENT';
	$MULTILANG_MnuTexto='Texte';
	$MULTILANG_MnuPadre='Père';
	$MULTILANG_MnuSiAplica='Si applicable';
	$MULTILANG_MnuUbicacion='Emplacement de cette option';
	$MULTILANG_MnuArriba='TopMenu Possible?';
	$MULTILANG_MnuEscritorio='Bureau possible?';
	$MULTILANG_MnuCentro='Moyen Possible?';
    $MULTILANG_MnuIzquierda='Barre latérale possible?';
	$MULTILANG_MnuSeccion='Section';
	$MULTILANG_MnuDesArriba='Vous devez activer cette option pour être affichée horizontalement dans la barre de menu supérieure?';
	$MULTILANG_MnuDesEscritorio='Vous devez activer cette option pour être affichée en tant qu icône sur le bureau des utilisateurs?';
	$MULTILANG_MnuDesCentro='Vous devez activer cette option pour être déployée dans la partie centrale de l application, dans les fenêtres classées / groupées par la valeur définie dans le champ Section?';
	$MULTILANG_MnuDesIzquierdo='Vous devez activer cette option pour être déployée dans la barre latérale de l application';
    $MULTILANG_MnuDesImagen='Afficher une liste d images disponibles sur le système';
	$MULTILANG_MnuComandos='COMMANDES DE CONFIGURATION ET ACTIONS';
	$MULTILANG_MnuClic='Possible de cliquer?';
	$MULTILANG_MnuURL='URL statique ou commando au format javascript: commande ()';
	$MULTILANG_MnuTitURL='Apporter à une URL ou exécuter un javascript?';
	$MULTILANG_MnuDesURL='Entrez l URL complète ou une commande javascript javascript: commande à remplacer dans une ancre HREF générée autour de l objet. Si vous devez passer des paramètres de chaîne à des commandes javascript, vous pouvez utiliser des cuotes simples';
	$MULTILANG_MnuTipo='Type de commande';
	$MULTILANG_MnuInterno='Interne';
	$MULTILANG_MnuPersonal='Personnel';
	$MULTILANG_MnuObjeto='Objet';
	$MULTILANG_MnuAccion='Action interne / commande / objet';
	$MULTILANG_MnuTitAccion='Tapez l une des trois valeurs possibles comme suit:';
	$MULTILANG_MnuDesAccion='1) OBJET dans Practico que vous voulez lier à cette option de menu en utilisant cette syntaxe frm: XXX ou inf: XXX où vous devez remplacer XXX par l ID de l objet (ID ou ID du rapport), 2) ACTION INTERNE dans Practico où vous voulez rediriger l utilisateur (vous pouvez voir dans le pied de page Practicos en tant qu administrateur), ou 3) COMMANDE PERSONNALISEE: Une séction de commande définie par l utilisateur, cette secuence devrait exister dans le fichier personalizadas.php ou tout autre module installé.';
	$MULTILANG_MnuTitNivel='Qui peut voir cette option?';
	$MULTILANG_MnuDesNivel='Spécifiez le profil utilisateur doit être pour voir cette option disponible.';
	$MULTILANG_MnuActualiza='Recharger le menu';
	$MULTILANG_MnuErr='Il nécessite au moins le champ de texte.';
	$MULTILANG_MnuAdmin='Administration du menu principal';
	$MULTILANG_MnuAgregar='Ajouter une option de menu';
	$MULTILANG_MnuDefinidos='Sections et commandes de menu définies';
	$MULTILANG_MnuNivel='Niveau';
	$MULTILANG_MnuComando='Commander';
	$MULTILANG_MnuAdvElimina='IMPORTANT: si vous supprimez ce registre, vous pouvez dissocier certaines options du système.\n'.$MULTILANG_Confirma;
	$MULTILANG_MnuHlpComandoInf='Peut-être que vous voulez ajouter à la commande cette chaîne<b>:htm:Informes</b>  dire Practico <br>qui met toutes les données au format Html et avec cette feuille de style CSS';
	$MULTILANG_MnuHlpAwesome='Vous pouvez utiliser la même syntaxe que celle utilisée pour les icônes de menu';
    $MULTILANG_MnuTgtBlank='Nouvelle fenêtre ou onglet';
    $MULTILANG_MnuTgtSelf='Même fenêtre ou cadre sur lequel vous avez cliqué';
    $MULTILANG_MnuTgtParent='Cadre parent ou fenêtre';
    $MULTILANG_MnuTgtTop='Corps entier de la fenêtre';
    $MULTILANG_MnuTgt='Target (Seules les options utilisant une commande URL ou JavaScript)';
    $MULTILANG_ImagenMenu='Image: Sélectionnez une icône ou entrez un chemin relatif';

	//Objetos, seguridad y otros
	$MULTILANG_ObjError='Le type d objet reçu dans cette commande est inconnu';
	$MULTILANG_SecErrorTit='Commandes et rapports de contrôle de sécurité';
	$MULTILANG_SecErrorDes='Vous avez tenté d exécuter une fonction, une commande ou un rapport pour lequel vous n êtes pas autorisé. <br> System prendra un journal d audit:';
	
	//Tablas
	$MULTILANG_TblError1='Problème d intégrité de conception';
	$MULTILANG_TblError2='ERREUR DE LA BASE DE DONNÉES';
	$MULTILANG_TblError3='Pendant le moteur d exécution a retourné le message suivant';
	$MULTILANG_TblAgrCampo='Ajouter des champs dans la table de données';
	$MULTILANG_TblAgrCampoTabla='Ajouter un champ à la table';
	$MULTILANG_TblEntero='Entier';
	$MULTILANG_TblCadena='Chaîne (longueur maximale 255)';
	$MULTILANG_TblTexto='Texte (Illimité)';
	$MULTILANG_TblFecha='Date (sans temps)';
	$MULTILANG_TblTitNombre='Formater l aide pour le nom du champ';
	$MULTILANG_TblDesNombre='Nom de champ sans tirets, points, espaces ou caractères spéciaux';
	$MULTILANG_TblLongitud='Longueur';
	$MULTILANG_TblAutoinc='Incrémentation automatique';
	$MULTILANG_TblDesLongitud='Ce champ peut être obligatoire en fonction du type de données à stocker, comme les champs de type String';
	$MULTILANG_TblDesLongitud2='Format: Si vous devez insérer une barre oblique inverse (barre oblique inverse) ou un guillemet simple entre ces valeurs, placez toujours une barre oblique inverse (barre oblique inverse) supplémentaire. Pour les champs enum ou set, utilisez le format: \'a\',\'b\',\'c\'...';
	$MULTILANG_TblTitAutoinc='Alerte de clé primaire';
	$MULTILANG_TblDesAutoinc='Cette valeur peut être définie uniquement par les administrateurs avancés qui ont été supprimés, pour une raison quelconque, du champ ID d auto-incrément par défaut.';
	$MULTILANG_TblNulos='Autoriser la valeur null?';
	$MULTILANG_TblDefUsuario='Défini par l utilisateur';
	$MULTILANG_TblNulo='Nul';
	$MULTILANG_TblFechaHora='Date actuelle';
	$MULTILANG_TblDesPredet='Format: Une seule valeur, non échappée. Pour les chaînes, utilisez des guillemets simples au début et à la fin';
	$MULTILANG_TblAgregando='Ajouter le champ';
	$MULTILANG_TblCamposDef='Champs déjà définis dans le tableau';
	$MULTILANG_TblTipoClave='Type de clé';
	$MULTILANG_TblNoElim='Ne peut être éliminé';
	$MULTILANG_TblAdvDelCampo='IMPORTANT: La suppression de la colonne sélectionnée du tableau est également supprimée toutes les données stockées dans celle-ci, vous ne pouvez pas annuler cette opération.\n'.$MULTILANG_Confirma;
	$MULTILANG_TblErrDel1='Erreur lors de la suppression de la table!';
	$MULTILANG_TblErrDel2='La table spécifiée ne peut pas être supprimée. Les causes les plus fréquentes sont les suivantes: <br> <li> est utilisé par l un des formulaires ou rapports automatisés, dans ce cas vous pouvez essayer d éditer. <br> <li> La table a des relations définies par le concepteur avec d autres tables de données. Le rôle utilisateur <li> défini pour la session active ne peut pas supprimer des objets dans Practico';
	$MULTILANG_TblErrCrear='Veuillez spécifier un nom valide pour la table. Cela ne doit pas contenir de tirets, points, espaces ou caractères spéciaux';
	$MULTILANG_TblCrearListar='Créer / répertorier des tables de données définies dans le système';
	$MULTILANG_TblCreaTabla='Créer une nouvelle table dans la base de données';
	$MULTILANG_TblDesTabla='Une table de données est une structure qui vous permet de stocker des informations. Entrez dans ce champ le nom de la table sans tirets, points, espaces ou caractères spéciaux. CAPS SENSITIVE';
	$MULTILANG_TblCreaTabCampos='Créer une table et définir des champs';
	$MULTILANG_TblTitAsis='Utiliser un assistant?';
	$MULTILANG_TblDesAsis='Vous permet de sélectionner à partir de certaines tables communes prédéfinies';
	$MULTILANG_TblTablasBD='Tables définies dans la base de données';
	$MULTILANG_TblRegistros='Enregistrements';
	$MULTILANG_TblAdvDelTabla='IMPORTANT: La suppression du tableau de données supprime également tous les enregistrements qui y sont stockés, vous ne pouvez donc pas annuler cette opération.\n'.$MULTILANG_Confirma;
	$MULTILANG_TblErrPlantilla='Vous devez sélectionner un modèle à partir duquel vous souhaitez créer votre nouvelle table';
	$MULTILANG_TblAsistente='Assistant de génération de table';
	$MULTILANG_TblAsistNombre='Nom pour la nouvelle table';
	$MULTILANG_TblAsistPlant='Modèle sélectionné';
	$MULTILANG_TblAsCampos='Champs contenant';
	$MULTILANG_TblTotCampos='Total des champs';
	$MULTILANG_TblHlpAsist='Tous les tableaux et champs peuvent être personnalisés à l étape suivante, en ajoutant, supprimant ou modifiant les propriétés de ceux que vous voulez.';
    $MULTILANG_TblTipoCopia1='Structure uniquement (phrase CREATE)';
    $MULTILANG_TblTipoCopia2='Données (INSERT Sentences)';
    $MULTILANG_TblTipoCopia3='Structure et données (phrases CREATE et INSERT)';
    $MULTILANG_TblImportar='Importer à partir du fichier';
    $MULTILANG_TblImportarSQL='Télécharger un script SQL compressé';
    $MULTILANG_TblSQLConsejo='Si vous exécutez les phrases SQL de ce fichier, vous risquez d effacer, de créer ou d écraser des tables et bien d autres informations, même des conceptions et d autres éléments que vous avez exportés dans ces enregistrements. <br><br><b> Nous vous recommandons de faire une sauvegarde avant de continuer.</b>';
    $MULTILANG_TblEjecutarSQL='Exécuter des phrases SQL dans ce fichier (cela peut prendre un certain temps)';
    $MULTILANG_TblDecodificarActual='Collation ou jeu de caractères pour les enregistrements ou la table de données réels';
    $MULTILANG_TblCodificar='ENCODE enregistrements avant de les enregistrer dans le fichier de sauvegarde en utilisant';
    $MULTILANG_TblCodificacionNINGUNO='AUCUN, utilisez le classement d origine ou le jeu de caractères';
    $MULTILANG_TblTransliteracion='Utiliser la translittération de caractères';
    $MULTILANG_TblTransliteracionHlp='Si la translittération est activée lorsqu un caractère ne peut pas être représenté dans le jeu de caractères cible, il peut être approximé par un ou plusieurs caractères de même apparence. Si vous décidez d ignorer, les caractères non valides seront omis, sinon la chaîne est tronquée et, E_NOTICE est généré et la fonction retournera FALSE.';
    $MULTILANG_TblTranslit='Translitération';
    $MULTILANG_TblIgnora='Ignorer';
    $MULTILANG_TblAnaliza='Analyser les tables';
    $MULTILANG_TblReparar='Tables de réparation';
    $MULTILANG_TblOptimizar='Optimiser les tables';
    $MULTILANG_TblVaciar='Vide';
    $MULTILANG_TblVaciarAdv='Cette action supprimera tous les enregistrements de cette table, êtes-vous sûr?';
    $MULTILANG_TblImportarXLS='Importer depuis une feuille de calcul';
    $MULTILANG_TblXLSConsejo='Chargement et mise en correspondance des champs d une feuille de calcul avec votre base de données actuelle Vous pouvez supprimer, créer ou remplacer des tables, des enregistrements et d autres informations connexes, ainsi que des conceptions et d autres éléments contenus dans les enregistrements associés. <br> <br> <b> Il est recommandé de faire une sauvegarde avant ce processus avant de continuer. </ b> <br> <br> La première ligne de la feuille de calcul doit contenir comme en-têtes le nom exact du champ dans la table sur laquelle vous souhaitez importer des valeurs.';
    $MULTILANG_TblTablaImportacion='Veuillez sélectionner la table sur laquelle vous souhaitez importer les données';
    $MULTILANG_TblCorrespondencia='Correspondance entre les champs de la table et les colonnes du fichier';
    $MULTILANG_TblApareaMsg='Vérifiez les champs sur le côté gauche de la table et correspondant par leur nom à partir de la colonne de la liste de sélection. Si nécessaire, faites l aperçu des manuels d appariement en fonction des colonnes existantes dans le fichier en haut. <br><br>Les champs non appariés seront ignorés et remplis avec la valeur par défaut est prise dans le moteur';
	$MULTILANG_TblPoliticaImportacion='<b>Que faire si un enregistrement en cours d importation existe déjà?:</b><br>Indiquez comment vous souhaitez traiter chaque enregistrement en double dans le système au cas où vous essayez d importer déjà dans la base de données.';
	$MULTILANG_TblIgnorarRegistro='Ignorer le dossier';
	
	//Usuarios
	$MULTILANG_UsrCopia='Copie des autorisations terminée. Veuillez vérifier ci-dessous.';
	$MULTILANG_UsrDesPW='Les mots de passe avec des conditions de sécurité minimales doivent avoir une longueur de <b>au moins 8 caractères</b>, les nombres, les majuscules et les minuscules tels que <font color=blue>$ * </font>. Pour que votre mot de passe soit considéré comme sûr par ce système <b> doit rencontrer au moins un niveau de sécurité de 81%</b>';
	$MULTILANG_UsrCambioPW='Changer le mot de passe';
	$MULTILANG_UsrAnteriorPW='Ancien mot de passe';
	$MULTILANG_UsrNuevoPW='Nouveau mot de passe';
	$MULTILANG_UsrNivelPW='Niveau de sécurité';
	$MULTILANG_UsrVerificaPW='Vérifier le mot de passe';
	$MULTILANG_UsrHlpNoPW='Le moteur d authentification est défini pour l outil de type externe.<br>
				La modification du mot de passe et les mises à jour du profil utilisateur sont désactivées car elles doivent être gérées de manière centralisée pour vous dans l outil défini par votre administrateur système';
	$MULTILANG_UsrErrPW1='Vous avez oublié d entrer l une des données demandées';
	$MULTILANG_UsrErrPW2='Vous avez entré deux mots de passe différents';
	$MULTILANG_UsrErrPW3='La clé que vous avez entrée ne correspond pas aux recommandations de sécurité minimales';
	$MULTILANG_UsrErrPW4='The actual password doesnt match with the password registered in the system.  For security reasons your password wont change until you enter your actual password as verification.';
	$MULTILANG_UsrErrInf='L utilisateur a déjà l autorisation sélectionnée';
	$MULTILANG_UsrAdmInf='Administration des rapports utilisateur';
	$MULTILANG_UsrAgreInf='Ajouter un rapport au menu de l utilisateur';
	$MULTILANG_UsrInfDisp='Rapports disponibles';
	$MULTILANG_UsrAdvDel='IMPORTANT: La suppression du registre ne peut pas lier certaines options système pour cet utilisateur.\n'.$MULTILANG_Confirma;
	$MULTILANG_UsrAdmPer='Gestion des droits utilisateur';
	$MULTILANG_UsrCopiaPer='Initialement faire une copie des autorisations de l utilisateur';
	$MULTILANG_UsrDelPer='Supprimer uniquement les autorisations';
	$MULTILANG_UsrAgreOpc='Ajouter une option au menu utilisateur';
	$MULTILANG_UsrSecc='Sections déjà disponibles';
	$MULTILANG_UsrErrCrea1='L utilisateur entré existe déjà, veuillez vérifier ou modifier le nom d utilisateur entré pour le compte et réessayer';
	$MULTILANG_UsrErrCrea2='Vous avez oublié d entrer l une des données demandées, au besoin';
	$MULTILANG_UsrErrCrea3='Le mot de passe entré doit comporter au moins six caractères';
	$MULTILANG_UsrAdicion='Ajouter des utilisateurs';
	$MULTILANG_UsrLogin='NickName / Login';
	$MULTILANG_UsrDesLogin='Connexion unique pour identifier l utilisateur dans le système. CAPS SENSITIVE';
	$MULTILANG_UsrNombre='Nom complet';
	$MULTILANG_UsrTitCorreo='Adresse pour les alertes et les notifications';
	$MULTILANG_UsrDesCorreo='E-mail d utilisation possible pour le système de notifications automatiques dans certains modules';
	$MULTILANG_UsrEstado='Etat initial';
	$MULTILANG_UsrNivel='Niveau d accès';
	$MULTILANG_UsrInterno='Utilisateur interne?';
	$MULTILANG_UsrDesInterno='Un utilisateur interne est destiné aux personnes qui travaillent au sein de l entreprise et qui déploient l ERP ou le système. Un utilisateur externe est par exemple pour les personnes d un client ou d une autre entreprise qui se connecte au système';
	$MULTILANG_UsrTitNivel='Profil de sécurité initial';
	$MULTILANG_UsrDesNivel='Profil de sécurité des utilisateurs ATTENTION: cette option est différente des autorisations utilisateur individuelles définies par le concepteur pour les objets créés. Cette page ne s applique qu aux opérations internes de Practico';
	$MULTILANG_UsrAudit1='Opérations de suivi';
	$MULTILANG_UsrAudDes='Détails de l action';
	$MULTILANG_UsrAudUsrs='Suivi des transactions pour tous les utilisateurs';
	$MULTILANG_UsrAudAccion='Avec l ACTION';
	$MULTILANG_UsrAudUsuario='pour le<b> utilisateur</b>';
	$MULTILANG_UsrAudDesde='De (jour / mois)';
	$MULTILANG_UsrAudHasta='à';
	$MULTILANG_UsrAudAno='Audit de l année de référence';
	$MULTILANG_UsrAudIniReg='Commencer sur le disque';
	$MULTILANG_UsrAudVisual='Voir';
	$MULTILANG_UsrAudMonit='Mode de surveillance';
	$MULTILANG_UsrAudHisto='Historique des opérations de l utilisateur (du plus récent au plus ancien)';
	$MULTILANG_UsrLista='Liste des utilisateurs dans le système';
	$MULTILANG_UsrLisNombre='Voir uniquement les utilisateurs dont le nom contient';
	$MULTILANG_UsrLisLogin='Voir uniquement les utilisateurs dont LOGIN contient';
	$MULTILANG_UsrFiltro='En raison du nombre d utilisateurs enregistrés, vous devez filtrer la sortie.<br>
				Entrez le type de filtre souhaité en haut et cliquez sur le bouton correspondant.';
	$MULTILANG_UsrAcceso='Dernier accès';
	$MULTILANG_UsrAdvSupr='IMPORTANT: Vous allez supprimer l utilisateur et perdre les liens vers les enregistrements associés à cette action, cette action ne peut pas être récupérée à moins que vous recréer l utilisateur avec les mêmes informations d identification plus tard.\n'.$MULTILANG_Confirma;
	$MULTILANG_UsrAddMenu='Ajouter des menus';
	$MULTILANG_UsrAddInfo='Ajouter des rapports';
	$MULTILANG_UsrAuditoria='Audit';
	$MULTILANG_UsrAgregar='Ajouter un utilisateur';
	$MULTILANG_UsrVerAudit='Voir l audit de l utilisateur';
	$MULTILANG_UsrReset='Réinitialiser le mot de passe';
    $MULTILANG_UsrOlvideClave='j ai oublié mon mot de passe';
    $MULTILANG_UsrOlvideUsuario='J ai oublié mon nom d utilisateur';
    $MULTILANG_UsrIngreseUsuario='Tapez votre nom d utilisateur';
    $MULTILANG_UsrIngreseCorreo='Tapez l email enregistré';
    $MULTILANG_UsrResetAdmin='Si vous ne parvenez pas à accéder au système après une restauration de mot de passe, vous pouvez écrire à votre administrateur système pour qu il réinitialise votre mot de passe..';
    $MULTILANG_UsrAsuntoReset='Accès réinitialisé';
    $MULTILANG_UsrMensajeReset='Un email avec les informations pour l utilisateur et la restauration des clés a été envoyé. N oubliez pas de vérifier vos e-mails dans votre boîte de réception et votre dossier de spam pour voir les instructions. <br> <br> Tout lien pour réinitialiser votre mot de passe expire le jour suivant ou lorsque ce lien est utilisé avec succès. <Hr> Le sujet de l e-mail sera quelque chose comme: <b>['.$NombreRAD.'] '.$MULTILANG_UsrAsuntoReset.'</b>';
    $MULTILANG_UsrErrorReset='Les informations entrées pour le processus de réinitialisation du mot de passe n étaient pas valides, le nom d utilisateur ou le courrier électronique entré n existe pas dans le système. Vérifiez les données et réessayez.';
    $MULTILANG_UsrResetLink='Suivez ce lien pour restaurer votre mot de passe';
    $MULTILANG_UsrResetCuenta='Message envoyé à';
    $MULTILANG_UsrResetOK='Mot de passe restauré Veuillez essayer de vous reconnecter';
    $MULTILANG_UsrPerfil='Profil de l utilisateur';
    $MULTILANG_UsrActualizarAdmin='Vos paramètres indiquent que vous devez modifier votre profil pour mettre à jour l adresse e-mail de l utilisateur admin. <br> Veuillez accéder au menu utilisateur supérieur et cliquez sur l option Super utilisateur ou nom d utilisateur pour le modifier.';
    $MULTILANG_UsrCreacionOK='L utilisateur du compte a été ajouté. Maintenant est filtré pour ajouter une option de menu ou un rapport dont vous avez besoin. Vous pouvez annuler cette opération s il n est pas nécessaire d assigner ce droit en ce moment.';
    $MULTILANG_UsrSaltarInformes='Aller aux droits du rapport pour cet utilisateur';
    $MULTILANG_UsrSaltarMenues='Aller aux droits du menu pour cet utilisateur';
    $MULTILANG_UsrEsPlantilla='Utilisez-le comme un modèle d autorisations utilisateur pour les autres?';
    $MULTILANG_UsrEsPlantillaDes='Les droits de menu et les rapports assignés à cet utilisateur seront automatiquement copiés lors de chaque entrée pour les personnes l utilisant comme modèle. Cela vous permet de gérer les profils utilisateur mis à jour en fonction des modèles généraux. Rappelez-vous: les utilisateurs de modèles ne peuvent pas se connecter au système.';
    $MULTILANG_UsrPlantillaAplicar='Autorisations de modèle à appliquer à chaque entrée';
    $MULTILANG_UsrPlantillaAplicarDes='Les permissions attribuées à l utilisateur sélectionné dans la liste seront transférées à ce nouvel utilisateur pour chacune faire un revenu';
    $MULTILANG_UsrPermisoManual='Droits manuels';
    $MULTILANG_UsrDesClaveACorreo='Veuillez vérifier que le compte de messagerie est correct. Ce compte sera vérifié car dans ce compte nous vous enverrons un mot de passe aléatoire pour accéder au système.';
    $MULTILANG_UsrFinRegistro='Votre processus d inscription a été terminé avec succès. Veuillez vérifier votre boîte de réception où vous trouvez un message de bienvenue avec un mot de passe aléatoire pour accéder au système. <br> <br> Important: N oubliez pas de vérifier votre dossier SPAM aussi si vous ne voyez aucun message dans votre boîte de réception standar.';

	//Proceso de instalacion
	$MULTILANG_Instalacion='Processus d installation';
	$MULTILANG_SubtituloPractico1='Générateur d application WEB';
	$MULTILANG_SubtituloPractico2='Gratuit et multi-plateforme';
	$MULTILANG_InstaladorAplicacion='Installateur d application';
	$MULTILANG_BienvenidaInstalacion='Bienvenue dans le processus d installation';
	$MULTILANG_BienvenidaDescripcion='Cet assistant vous guidera à chaque étape des configurations initiales pour utiliser Practico comme environnement visuel pour le développement d applications Web.';
	$MULTILANG_ResumenLicencia='Cet outil est disponible sous GNU-GPL v2';
	$MULTILANG_AmpliacionLicencia='Une copie en ligne de cette licence peut être trouvée dans différents formats et langues <a href="http://www.gnu.org/licenses/gpl-2.0.html">GNU website</a>';
	$MULTILANG_ChequeoPreprocesador='Vérification des paramètres du préprocesseur';
	$MULTILANG_VistaPreprocesador='Une vue de votre configuration PHP est disponible dans <b> <a target="_blank" href="paso_i.php">[ce lien]</a>';
	$MULTILANG_CumplirRequisitos='Doit rencontrer les éléments suivants';
	$MULTILANG_CumplirPDO='Extension PDO activée';
	$MULTILANG_CumplirDrivers='Pilote PDO pour le type de moteur de votre base de données cible';
	$MULTILANG_CumplirGD='GD Extension 2 + gestion des graphiques et support pour FreeType 2 +. <Li> Extension SimpleXML.<li>Extension POSIX';
	$MULTILANG_ChequeoDirectorios1='Vérification des répertoires';
	$MULTILANG_ChequeoDirectorios2='Les fichiers et répertoires suivants doivent disposer d autorisations d écriture pour que l application fonctionne correctement';
	$MULTILANG_ErrorEscritura='<b> trouvé des erreurs en essayant d écrire dans les répertoires d installation! </b>: <br> le chemin de la règle doit appartenir à l utilisateur qui exécute le serveur Web Scripts pratiques (usually apache <br> www, www-data or similar) and have 755 permissions for folders and 644 case for. <br> Un moyen rapide de mettre à jour ces autorisations peut être exécuté depuis la racine des commandes Practical: <li> find. -type d-exec chmod 755 {} \; (change all folder permissions) <li> find. -type f-exec chmod 644 {} \; (modifier toutes les autorisations de fichiers) <li> chown-R www-data * (en supposant que www-data est l utilisateur qui exécute le service Web)';
	$MULTILANG_ProbarNuevamente='Testez à nouveau';
	$MULTILANG_ConfiguracionDescripcion='Spécifiez les paramètres souhaités pour stocker les applications utilisateur et les informations générées par Practical ainsi que d autres options importantes de l outil. Cette fenêtre sera présentée une seule fois, alors assurez-vous de remplir et de confirmer toutes les informations requises';
	$MULTILANG_PuertoNoPredeterminado='(sinon le défaut)';
	$MULTILANG_AyudaTitMotor='MySQL et MariaDB';
	$MULTILANG_AyudaDesMotor='Les moteurs sont officiels. Au-dessus d eux est le développement et les tests de l outil, mais grâce à PDO vous pouvez utiliser l outil dans d autres moteurs, vous devrez peut-être faire des ajustements à ces opérations spécifiques.';
	$MULTILANG_AyudaTitBD='La base de données doit déjà exister';
	$MULTILANG_AyudaDesBD='Pour les différents moteurs, vous devez d abord avoir créé la base de données SQLite. Pour SQLite seulement requis pour spécifier le nom de fichier associé à BD (par exemple practico.sqlite3) et Practico essaiera de créer pour vous le fichier si vous avez les permissions appropriées sur votre serveur web.';
	$MULTILANG_PrefijoCore='Pr&aacute; ctico préfixe des tables internes';
	$MULTILANG_PrefijoApp='Préfixe des tables d application';
	$MULTILANG_AyudaTitPreCore='Il n est pas recommandé d utiliser une valeur vide ou des majuscules';
	$MULTILANG_AyudaDesPreCore='';
	$MULTILANG_AyudaTitPreApp='Important';
	$MULTILANG_AyudaDesPreApp='Le préfixe utilisé pour les tables d application peut être utilisé pour séparer différentes installations pratiques sur la même base de données ou il peut être laissé vide pour lier / intégrer avec d autres applications pratiques préexistantes. Majuscules non recommandées pour la compatibilité entre les moteurs.';
	$MULTILANG_AyudaLlave='Valeur de signe pour les comptes d utilisateurs';
	$MULTILANG_NotasImportantesInst1=' <u>IMPORTANT 1 </u>: La base de données utilisée pour Practico doit déjà exister pour s y connecter et générer les structures requises. Vérifiez auprès de votre fournisseur d hébergement ou administrateur système comment créer une base de données avec des privilèges suffisants pour travailler avec Practico. <br> <br> <u> IMPORTANT 2 </u>: Le programme d installation supprimera toutes les tables existantes de la base de données indiquées et qui correspondent aux noms des tables utilisées par Practico. Si vous pensez que vous pouvez avoir des informations importantes, il est recommandé de faire une sauvegarde avant de continuer. Pour partager une base de données unique entre différentes installations de Practico, vous pouvez modifier les préfixes de table utilisés par chacun.';
	$MULTILANG_ParametrosApp='Paramètres pour votre application';
	$MULTILANG_ParamNombreEmpresaLargo='Nom complet de votre organisation ou entreprise';
	$MULTILANG_ParamNombreEmpresa='Nom abrégé de votre organisation ou entreprise';
	$MULTILANG_ParamFechaLanzamiento='Date de déploiement';
	$MULTILANG_ParamNombreApp='Nom de l application';
	$MULTILANG_ParamVersionApp='Version initiale de son application';
	$MULTILANG_AyudaTitNomEmp='Nom à afficher en haut';
	$MULTILANG_AyudaDesNomEmp='Ce texte sera utilisé dans les rapports et les domaines d application nécessitant un nom pour identifier votre organisation.';
	$MULTILANG_AyudaTitNomApp='Nom descriptif';
	$MULTILANG_AyudaDesNomApp='Le nom spécifié apparaît toujours en haut de votre application.';
	$MULTILANG_NotasImportantesInst2='<u>IMPORTANT</u>: D autres paramètres tels que le nom long et court de votre société, la date de sortie, les textes de licence et les crédits pourront être modifiés ultérieurement dans les options disponibles pour l utilisateur administrateur.';
	$MULTILANG_AyudaTitCaptcha='Longueur du mot';
	$MULTILANG_AyudaDesCaptcha='Indique le nombre de symboles utilisés dans le mot de sécurité que les utilisateurs doivent entrer pour accéder au système chacun.';
	$MULTILANG_ModoDepuracion='Mode débogage';
	$MULTILANG_AyudaTitDebug='Afficher les erreurs et les avertissements';
	$MULTILANG_AyudaDesDebug='Pour les sites de production, cette option devrait être désactivée. Lorsque vous activez cette valeur, Practico vous montrera pendant l exécution de l application toutes les erreurs et les messages qui peuvent être générés par le préprocesseur hypertexte - PHP';
	$MULTILANG_AyudaTitDebugBD='Enregistrer le journal des requêtes';
	$MULTILANG_AyudaDesDebugBD='Pour les sites de production, cette option devrait être désactivée. Lorsque vous activez cette valeur, Practico enregistre une copie de toutes les requêtes et transactions envoyées à votre base de données via le module d audit.';
	$MULTILANG_MotorAuth='Moteur d authentification';
	$MULTILANG_AuthPractico='Interne (Tables de Practico utilisant MD5)';
	$MULTILANG_AuthLDAP='LDAP (serveur de répertoire)';
	$MULTILANG_AuthFederado='Fédéré (Voir la configuration sous les paramètres de l application)';
	$MULTILANG_AyudaDesAuth='En utilisant un moteur d authentification différent, Practico n exclut pas la création d utilisateurs de l outil. Le moteur hors-bord servira de méthode pour valider le login et le mot de passe correspondant en tant que méthode d authentification centralisée, mais les autres caractéristiques du profil proviennent de l utilisateur Practico. Le changement de mot de passe Practico sera désactivé pour être contrôlé uniquement par le moteur externe. L utilisateur admin restera toujours autonome pour conserver les erreurs de configuration du contrôle d accès.';
	$MULTILANG_AyudaTitCript='Type de cryptage de clé utilisé par le moteur';
	$MULTILANG_AyudaDesCript='Indiquez le type de chiffrement utilisé par le système d authentification à utiliser. Practico chiffrera la valeur clé entrée par l utilisateur avant d envoyer le moteur de vérification.';
	$MULTILANG_AlgoritmoCripto='Algorithme de chiffrement';
	$MULTILANG_Dominio='Domaine';
	$MULTILANG_UO='Unité organisationnelle ou contexte';
	$MULTILANG_AyudaDesLdapIP='Entrez l adresse IP du serveur ou le répertoire de noms où il peut être résolu.';
	$MULTILANG_AyudaDesLdapDominio='Domaine utilisé par le serveur. Exemple: Ceci sera créé midominio.com.co chaîne interne dc=midominio,dc=com,dc=co';
	$MULTILANG_AyudaDesLdapUO='Connexion au contexte de l utilisateur. Doit exister sur le serveur LDAP, par exemple les personnes, les ventes, le marketing, etc.';
	$MULTILANG_TitInsPaso3='Écriture de la configuration et connexion à la base de données';
	$MULTILANG_DesInsPaso3='J écris le fichier configuracion.php situé dans / core avec les paramètres que vous avez spécifiés et qui est en cours de test. Se connecte à la base de données spécifiée.';
	$MULTILANG_ErrorEscribirConfig='<b>Erreurs trouvées lors de la tentative d écriture du fichier de configuration! </b>: <br> Si vous voulez une alternative, vous pouvez changer vos propres valeurs par défaut contenues dans le fichier core / configuracion.php ou ws_llaves.php ou core / ws_oauth.php en fonction des changements souhaités.<br> <br> Vous pouvez également modifier les autorisations de fichier pour configuracion.php et réessayer avec cet assistant.';
	$MULTILANG_ErrorConexBD='<b> trouvé des erreurs lors de la connexion à la base de données! </b>: <br> Vérifiez les valeurs entrées à l étape précédente et réessayez.';
	$MULTILANG_InfoPaso3='<b> Tout semble bien avec la configuration de base de PDO. </b> <br> La dernière étape consiste à indiquer à l assistant d installation comment essayer votre base de données:<br><br>
				<li><b>1.</b> Ajouter des données démarrer la base de données, ce qui inclut l utilisateur initial (admin), les menus et autres enregistrements sur les tables de Practico Core. C est le meilleur choix pour les nouvelles installations.
				<li><b>2.</b> Laissez la base de données telle quelle, indiquant qu aucune opération ne doit être exécutée sur la base de données. Cette option est utile lorsque vous tentez d installer sur une base de données existante contenant des applications conçues et des utilisateurs actifs. Il peut également être compris comme une base de données vide pour les nouvelles installations ne sera même pas accessible aux utilisateurs et des options pour sélectionner.';
	$MULTILANG_BtnAplicarBD='1. Ajouter des informations initiales au BD';
	$MULTILANG_BtnNoAplicarBD='2. Ne pas modifier le BD connecté';
	$MULTILANG_ExeScripts='Exécuter des scripts de base de données (le cas échéant)';
	$MULTILANG_ErrorScripts='Erreur lors de l exécution de la requête sur la base de données';
	$MULTILANG_IrInstalacion='Accédez à votre installation Practico';
	$MULTILANG_Totalejecutado='Nombre total de requêtes exécutées';
	$MULTILANG_MsjFinal1='Si c est une nouvelle installation peut entrer dans le système par <b> lettres de créance admin / admin </ b> et changez alors comme vous le désirez.';
	$MULTILANG_MsjFinal2='N oubliez pas de supprimer complètement le répertoire d installation (folder / ins) </b> </u> pour empêcher l autre personne d exécuter ces scripts à nouveau sur un système de production peut causer des dommages.';
	$MULTILANG_MsjFinal2='Résumé des opérations exécutées';
	$MULTILANG_AuthLDAPTitulo='Connexion basée sur LDAP';
	$MULTILANG_AuthOauthPlantilla='Utilisateur du modèle';
	$MULTILANG_AuthOauthId='identité du client';
	$MULTILANG_AuthOauthSecret='Secret du client';
	$MULTILANG_AuthOauthURI='Rediriger l URI';
	$MULTILANG_OauthTitURI='Avant de continuer, vous devez enregistrer une nouvelle application auprès du fournisseur pour obtenir un ID, un secret et un URI pour configurer le service d authentification. L URI à enregistrer est calculée automatiquement par Practico dans chaque champ URI de ce formulaire.';
	$MULTILANG_OauthDesURI='Important: Votre adresse URI de retour doit être sous un domaine ou une adresse IP publique, car votre fournisseur devra établir un lien avec celle-ci. Cet URI est automatiquement créé en fonction du chemin lors de l installation. Cliquez sur le logo de chaque fournisseur pour accéder au site Web d enregistrement de l API.';
	$MULTILANG_OauthPredeterminado='Une fois que vous avez enregistré un fournisseur OAuth, vous pouvez configurer votre système pour que les options OAuth soient présentées par défaut au moment de la connexion à partir du panneau de configuration.';
	$MULTILANG_BuscarActual='Rechercher des mises à jour automatiquement';
	$MULTILANG_DescActual='Effectuez des recherches aléatoires sur les connexions admin pour vérifier les nouvelles versions de Practicos. Cette option peut ralentir le chargement de l administrateur lors de la recherche de nouvelles versions';
	$MULTILANG_ConfGraficas='Modifier les configurations graphiques';
	$MULTILANG_UsuariosAdmin='Super utilisateurs';
	$MULTILANG_UsuariosAdminDes='Une liste séparée par des virgules des utilisateurs qui sont les administrateurs de plate-forme et les concepteurs d applications. Si vous souhaitez supprimer l administrateur, assurez-vous d avoir un autre super utilisateur ou vous perdrez les droits d administrateur.';
	$MULTILANG_PermitirReseteoClave='Permettre de récupérer les mots de passe';
	$MULTILANG_DesPermitirReseteoClave='Met une option de récupération de mot de passe dans la fenêtre de connexion permettant aux utilisateurs d ouvrir un assistant de récupération de mot de passe. Ceci est disponible uniquement pour le moteur d authentification interne Practicos.';
	$MULTILANG_PermitirAutoRegistro='Autoriser les utilisateurs à s auto-inscrire dans le système';
	$MULTILANG_DesPermitirAutoRegistro='Met une option d inscription dans la fenêtre de connexion qui permet aux utilisateurs d ouvrir un formulaire d auto-inscription dans le système. Ceci est disponible uniquement pour le moteur d authentification interne Practicos.';
	$MULTILANG_UsuarioAutoRegistro='Utilisateur de modèle pour l auto-inscription';
	$MULTILANG_DesUsuarioAutoRegistro='Dit quel utilisateur sera utilisé pour les droits dans les utilisateurs auto-enregistrés';
	$MULTILANG_NoRecomendado='Non recommandé pour des raisons de sécurité';
	$MULTILANG_UbicacionOauth='Prefered location for Oauth options at login time';
	$MULTILANG_OauthOpcionBoton='As a button that open the OAuth providers';
	$MULTILANG_OauthOpcionDirecta='As extra options directly over standar login window';

	//API-Webservices
	$MULTILANG_WSErrTitulo='Practico WebServices - Error';
	$MULTILANG_WSErr01='[Cod. 01] Clé non valide';
	$MULTILANG_WSErr02='[Cod. 01] La valeur secrète n est pas valide';
	$MULTILANG_WSErr03='[Cod. 03] Fichier de fonctions WebServices introuvable';
	$MULTILANG_WSErr04='[Cod. 04] La clé des consommateurs Webservice est vide ou nulle. Vérifiez la valeur que vous avez envoyée ou votre processus d installation de Practico.';
	$MULTILANG_WSErr05='[Cod. 05] L identifiant, la fonction ou la méthode du service n a pas pu être exécuté, est inconnu ou est vide.';
	$MULTILANG_WSErr06='[Cod. 06] Vous n êtes pas autorisé à exécuter le service:';
	$MULTILANG_WSErr07='[Cod. 07] Accès API non autorisé pour l adresse: ';
	$MULTILANG_WSErr08='[Cod. 08] Accès API non autorisé pour le domaine: ';
	$MULTILANG_WSConfigButt='Clés WebServices';
	$MULTILANG_WSLlavesDefinidas='<b>Clés client WebServices</b> (une chaque ligne)';
	$MULTILANG_WSLlavesAyuda='Ce sont les clés webservices que vous autorisez à utiliser Pr & aacute; ctico Webservices ou les services personnalisés de l utilisateur. Il n est pas nécessaire d ajouter votre clé de passe d installation car elle est autorisée par défaut sur tous les domaines et toutes les fonctions';
	$MULTILANG_WSLlavesNuevo='Ajouter un nouveau client API';
	$MULTILANG_WSLlavesBorrar='Vous allez supprimer les clés API sélectionnées. Toute application de connexion étrangère utilisant ces clés sera interdite par Practico. Cette opération ne peut pas être annulée plus tard, êtes-vous sûr?';
	$MULTILANG_WSLlavesNombre='Nom du client';
	$MULTILANG_WSLlavesLlave='Clé';
	$MULTILANG_WSLlavesSecreto='Secret';
	$MULTILANG_WSLlavesURI='Rediriger l URI';
	$MULTILANG_WSLlavesDominio='Domaine (s) autorisé (s)';
	$MULTILANG_WSLlavesIP='IP (s) autorisée (s)';
	$MULTILANG_WSLlavesFunciones='Services autorisés';
	$MULTILANG_WSLlavesAsterisco='(*) astérisque pour tout';


	//OAuth
	$MULTILANG_OauthButt='Authentification OAuth';
	$MULTILANG_PreferirOauth='Afficher les options OAuth par défaut lors de la connexion';
	$MULTILANG_ProtoTransporte='Protocole de transport préféré';
	$MULTILANG_ProtoTransAUTO='Détection automatique par URL';
	$MULTILANG_ProtoTransHTTP='Norme HTTP';
	$MULTILANG_ProtoTransHTTPS='HTTP sécurisé';
	$MULTILANG_ProtoDescripcion='Autodetect vérifiera les URL utilisées pour accéder et activera ou désactivera SSL, le standard HTTP permettra aux personnes ayant des certificats auto-signés de se connecter au service web auth Practicos. C est un mode non sécurisé mais très efficace si vous avez besoin d y accéder. HTTP Secured nécessite un certificat SSL valide par une autorité de certification sur votre serveur Web.';

	//Login Federado
	$MULTILANG_TitFederado='Connexion fédérée';

	//Modulo de monitoreo
	$MULTILANG_MonTitulo='Système de surveillance';
	$MULTILANG_MonPgInicio='Page de démarrage';
	$MULTILANG_MonConfig='Moniteur configure';
	$MULTILANG_MonNuevo='Ajouter un nouveau moniteur';
	$MULTILANG_MonCommShell='Commande shell';
	$MULTILANG_MonCommSQL='Requête SQL';
	$MULTILANG_MonDesTipo='C est l élément que vous voulez ajouter à la page de surveillance';
	$MULTILANG_MonMetodo='Méthode utilisée';
	$MULTILANG_MonSaltos='Freins de ligne';
	$MULTILANG_MonTamano='Taille de la police SQL';
	$MULTILANG_MonOcultaTit='Titre hidding';
	$MULTILANG_MonCorreoAlerta='Alertes email';
	$MULTILANG_MonAlertaSnd='Alerte la plus saine';
	$MULTILANG_MonMsLectura='Millisecondes pour la lecture';
	$MULTILANG_MonDefinidos='Pages et moniteurs définis';
	$MULTILANG_MonErr='Le champ Nom est obligatoire';
	$MULTILANG_MonEstado='État du système';
	$MULTILANG_MonAcerca='&copy; Système de surveillance basé sur <a target="_blank" href="http://www.practico.org" style="color:#FFFFFF"><font color=white><b>Practico.org</b></font></a>';
	$MULTILANG_AplicaPara='Ceci s applique pour: ';
	$MULTILANG_MonLinea='EN LIGNE';
	$MULTILANG_MonCaido='HORS LIGNE';
	$MULTILANG_MonAlertaVibrar='Vibreur sur les appareils mobiles';
	$MULTILANG_MonSensorRango='Capteur dans une plage';
	$MULTILANG_MonModoCompacto='utiliser le mode compact';

    //Modulo de correos
    $MULTILANG_MailIntro1='Message de plate-forme automatique';
    $MULTILANG_MailIntro2='Les détails sur ce message pourraient être disponibles dans le système <span style="font-weight: bold;">'.$NombreRAD.'</span> en utilisant votre nom d utilisateur et votre mot de passe.';
    $MULTILANG_MailIntro3='Ce message a été livré par un système automatique, veuillez ne pas y répondre.';
    $MULTILANG_MailIntro4='Rappelez-vous que nos messages ne vous demandent jamais des informations personnelles, des clés de sécurité par e-mail</span>, Ne répondez à aucun message ou ne remplissez pas un formulaire qui vous demande de ce type d informations sur notre '.$NombreRAD.' système.';
    $MULTILANG_MailIntro5='Toutes les informations contenues dans cet e-mail et toutes ses pièces jointes sont confidentielles pour la société et peuvent être utilisées uniquement pour les personnes qui lui sont liées. Si vous recevez ce message par erreur, effacez-le et informez l expéditeur de l erreur, toute autre opération avec cet e-mail et son contenu sera sous protection légale.';
    $MULTILANG_MailIntro6='<br><br>Un système alimenté par <a href=http://www.practico.org>www.practico.org</a>';

	//Modulo de chat
	$MULTILANG_UsuariosChat='Les utilisateurs qui sont hors connexion à ce moment verront tous les messages lorsqu ils se reconnecteront au système.';
	$MULTILANG_ChatActivar='Activer le module de chat?';
	$MULTILANG_ChatTipo1='Seulement entre les utilisateurs internes';
	$MULTILANG_ChatTipo2='Seulement entre utilisateurs externes';
	$MULTILANG_ChatTipo3='Pour tous les utilisateurs';
	$MULTILANG_ChatTipo4='Seulement pour admin';
	$MULTILANG_ChatDevel='Developers chat';

	//Modulo de replicas
	$MULTILANG_ReplicaTitulo='Connexions supplémentaires et réplication';
	$MULTILANG_ReplicaDefinidos='Serveurs de réplication automatique définis';
	$MULTILANG_AgregarReplica='Ajouter une nouvelle connexion';
	$MULTILANG_ReplicaTodo='Utilisez-le comme un miroir';
	$MULTILANG_AyudaReplica='Définissez si toutes les opérations de base de données sur le système principal doivent être répliquées via cette connexion. Si cette valeur est NON, Practico définira la connexion et la rendra prête à être utilisée par le code ou des opérations individuelles uniquement quand vous le souhaitez. Cela s applique aux opérations de mise à niveau des données (Insert, Update, Delete) créées par la fonction interne PCO_EjecutarSQLUnaria ()';
	$MULTILANG_ConnAdicionales='Connexions de base de données supplémentaires définies';
	$MULTILANG_ConnPredeterminada='Par défaut (même connexion utilisée par Practico)';
	$MULTILANG_ConnOrigenDatos='Origine des données';
	$MULTILANG_ConnOrigenDatosDes='Détermine où les données seront prises pour créer le rapport. Par défaut, il utilise la connexion et le moteur de base de données configurés pour fonctionner avec Practical; mais vous pouvez également sélectionner d autres moteurs ou des connexions externes et être en mesure d extraire des données à partir de là. Pour ajouter d autres sources de données, utilisez l option Connexions supplémentaires et réplication.';
    $MULTILANG_ConnAdvCambioOrigen='ATTENTION: La modification de la connexion ou de la source de données utilisée pour un rapport après sa conception peut générer des erreurs d exécution car les structures de données, les tables et les champs peuvent ne pas être détectés dans la nouvelle connexion sélectionnée. Faites attention.';

	//Eventos javascript
    $MULTILANG_EventosTit='Evénements d objet et déclencheurs';
    $MULTILANG_EventosPrevio='Avant de pouvoir automatiser des opérations à l aide d événements ou de déclencheurs avec un contrôle d objet ou de formulaire, vous devez d abord créer le contrôle de base, puis le modifier à nouveau pour activer les options.';
    $MULTILANG_EventoClick='Cliquez sur un élément';
    $MULTILANG_EventoDobleClick='Double-cliquez sur un élément';
    $MULTILANG_EventoMouseDown='Le bouton de la souris est enfoncé sur un élément';
    $MULTILANG_EventoMouseEnter='Le pointeur de la souris entre dans un élément';
    $MULTILANG_EventoMouseLeave='Le pointeur de la souris sort d un élément';
    $MULTILANG_EventoMouseMove='Le pointeur de la souris se déplace sur un élément';
    $MULTILANG_EventoMouseOver='Le pointeur de la souris est sur un élément';
    $MULTILANG_EventoMouseOut='Le pointeur de la souris sort d un élément ou de ses enfants';
    $MULTILANG_EventoMouseUp='Le bouton de la souris est relâché sur un élément';
    $MULTILANG_EventoContextMenu='Souris bouton droit appuyé (avant que le menu contextuel n apparaisse)';
    $MULTILANG_EventoKeyDown='L utilisateur a une touche enfoncée (contrôle de forme et corps)';
    $MULTILANG_EventoKeyPress='L utilisateur appuie sur une touche (moment dans lequel il est pressé) (éléments de forme et corps)';
    $MULTILANG_EventoKeyUp='Version de l utilisateur une touche qui a été enfoncée (éléments de formulaire et corps)';
    $MULTILANG_EventoFocus='Un élément de formulaire attire l attention';
    $MULTILANG_EventoBlur='Un élément de formulaire perd la mise au point';
    $MULTILANG_EventoChange='Un élément de formulaire change';
    $MULTILANG_EventoSelect='L utilisateur sélectionne le texte d une entrée ou d une zone de texte';
    $MULTILANG_EventoSubmit='Le bouton d envoi de formulaire est enfoncé (avant l envoi)';
    $MULTILANG_EventoReset='Le bouton de réinitialisation de formulaire est enfoncé';
    $MULTILANG_EventoCut='Les données sélectionnées dans un contrôle de texte ont été coupées';
    $MULTILANG_EventoCopy='Les données sélectionnées dans un contrôle de texte ont été copiées';
    $MULTILANG_EventoPaste='Le contenu a été collé dans un contrôle de texte';
    $MULTILANG_EventoLoad='La charge de la fenêtre ou du cadre a été complétée';
    $MULTILANG_EventoUnload='Fenêtre ou cadre de fermeture de l utilisateur';
    $MULTILANG_EventoResize='L utilisateur change la taille des fenêtres';
    $MULTILANG_EventoClose='L utilisateur essaie de fermer la fenêtre ou le cadre';
    $MULTILANG_EventoScroll='L utilisateur fait défiler les fenêtres ou le contrôle qui le supporte';
    $MULTILANG_EventoAnimFin='Une animation CSS a été terminée';
    $MULTILANG_EventoAnimInicio='Une animation CSS a été démarrée';
    $MULTILANG_EventoAnimIteracion='Une animation CSS a été redémarrée / répétée';
    $MULTILANG_EventoTipoRaton='Evénements souris ou périphérique de pointage';
    $MULTILANG_EventoTipoTeclado='Événements de clavier';
    $MULTILANG_EventoTipoFormulario='Événements de contrôle de formulaire';
    $MULTILANG_EventoTipoVentana='Evénements pour les fenêtres et les cadres';
    $MULTILANG_EventoTipoAnima='Evénements pour les animations et les transitions';
    $MULTILANG_EventoTipoBateria='Événements liés à la batterie et à sa charge';
    $MULTILANG_EventoTipoLlamadas='Evénements associés aux appels et à la téléphonie';
    $MULTILANG_EventoTipoDOM='Evénements sur l arborescence DOM';
    $MULTILANG_EventoTipoArrastrar='Evénements associés aux éléments de glisser-déposer';
    $MULTILANG_EventoTipoAudio='Événements audio et vidéo';
    $MULTILANG_EventoTipoInternet='Événements de connexion Internet';

    //ModuloKanban
    $MULTILANG_TablerosKanban='Conseil Kanban';
    $MULTILANG_AgregarNuevaTarea='Ajouter une nouvelle tâche';
    $MULTILANG_DesTarea='Description générale de la tâche ou de l activité à ajouter au tableau Kanban. Vous pouvez même utiliser d autres techniques de description telles que des user stories ou toute autre méthode que vous souhaitez documenter.';
    $MULTILANG_AsignadoA='Assigné à';
    $MULTILANG_AsignadoADes='Utilisateur enregistré dans le système responsable de l exécution de cette tâche ou de cette activité (le cas échéant)';
    $MULTILANG_FechaLimite='Date d échéance';
    $MULTILANG_DelKanban='Vous allez supprimer une tâche du forum et cette action ne pourra pas être annulée plus tard. Êtes-vous sûr?';
    $MULTILANG_Historia1='Historique minimal de l utilisateur: [Rol, Functionality, Purpose]';
    $MULTILANG_Historia1Des='Comme ________ j ai besoin de ___________ dans le but de ________.';
    $MULTILANG_Historia2='Historique de l utilisateur intermédiaire: [Rol, Fonctionnalité, But] + [Contexte / Acceptance requirements, Event]';
    $MULTILANG_Historia2Des='Comme ________ j ai besoin de ___________ dans le but de ________. BRBRIn cas _______ il devrait _______';
    $MULTILANG_Historia3='Historique détaillé de l utilisateur: [ID, Rol, Fonctionnalité, But] + [Stade, Conditions de Contexte / Acceptation, Evénement]';
    $MULTILANG_Historia3Des='ID: ______BRAs ________ J ai besoin de ___________ dans le but de ________.BRBRScene: ________. Dans le cas _______ il devrait _______';
    $MULTILANG_ListaColumnas='Liste des colonnes';
    $MULTILANG_ListaCategorias='Liste de catégories';
    $MULTILANG_ArchivarTarea='Tâche d archivage';
    $MULTILANG_ArchivarTareaAdv='La tâche sera archivée, elle quittera le forum et ira à l historique. Voulez-vous continuer?';
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
    $MULTILANG_Documentar='Document';
    $MULTILANG_DocumentarDes='Ajouter au début du code un modèle de documentation pour les fonctions ou procédures en notation NaturalDocs';
    $MULTILANG_DocumentarLink='Ouvrir l aide de documentation supplémentaire pour NaturalDocs';

    //PWA
    $MULTILANG_PWAActivar='Activer lutilisation des applications Web progressistes';
    $MULTILANG_PWAAyuda='Il permet d activer dans l application la technologie PWA qui permet à votre application de faire une demande d installation en tant qu application mobile à partir des navigateurs dans les appareils qui supportent cette technologie. Pour plus d informations voir les liens  https://w3c.github.io/manifest/  y  https://developers.google.com/web/progressive-web-apps/';
    $MULTILANG_PWAIconos='Définition des icônes pour l application';
    $MULTILANG_PWADescripcion='Application Web progressive générée automatiquement par Practico Framework';
    $MULTILANG_PWADireccionTexto='Direction du texte';
    $MULTILANG_PWADisplayPreferido='Mode d affichage préféré';
    $MULTILANG_PWAOrientacionPantalla='Orientation de l écran';
    $MULTILANG_PWAGCM='ID Firebase Cloud Messaging';
    $MULTILANG_PWAScope='Atteindre (Scope)';
    $MULTILANG_PWAScopeDes='Si votre installation de Practico réside à la racine de votre serveur Web ou de votre sous-domaine, vous pouvez laisser ce champ vide. Si votre installation réside dans un dossier, veuillez indiquer ./dossier/ pour définir la portée de l agent de service et le manifeste PWA.';
    $MULTILANG_PWAAutorizarGPS='Demander une autorisation pour obtenir un emplacement (GPS)';
    $MULTILANG_PWAAutorizarFCM='Demander l autorisation d envoyer des notifications (PUSH)';
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
	$MULTILANG_PCODER_Abrir='Open';
	$MULTILANG_PCODER_Aceptar='Accept';
	$MULTILANG_PCODER_Activar='Enable';
	$MULTILANG_PCODER_Archivo='File';
	$MULTILANG_PCODER_Acercar='Zoom in';
	$MULTILANG_PCODER_Alejar='Zoom out';
	$MULTILANG_PCODER_Ayuda='Help';
	$MULTILANG_PCODER_Basicos='Basics';
	$MULTILANG_PCODER_Buscar='Find';
	$MULTILANG_PCODER_Cancelar='Cancel';
	$MULTILANG_PCODER_Caracteres='Characters';
	$MULTILANG_PCODER_Cargando='Loading';
	$MULTILANG_PCODER_Carpeta='Folder';
	$MULTILANG_PCODER_Cerrar='Close';
	$MULTILANG_PCODER_Columna='Column';
	$MULTILANG_PCODER_Copiar='Copy';
	$MULTILANG_PCODER_Cortar='Cut';
	$MULTILANG_PCODER_Depurar='Debug';
	$MULTILANG_PCODER_Desactivar='Disable';
	$MULTILANG_PCODER_Deshacer='Undo';
	$MULTILANG_PCODER_Desplazar='Move';
	$MULTILANG_PCODER_Editar='Edit';
	$MULTILANG_PCODER_Eliminado='Deleted';
	$MULTILANG_PCODER_Error='Error';
	$MULTILANG_PCODER_Estado='Status';
	$MULTILANG_PCODER_Explorar='Explore';
	$MULTILANG_PCODER_Finalizado='Finished';
	$MULTILANG_PCODER_Formato='Format';
	$MULTILANG_PCODER_Guardando='Saving';
	$MULTILANG_PCODER_Guardar='Save';
	$MULTILANG_PCODER_Herramientas='Tools';
	$MULTILANG_PCODER_Ir='Go';
	$MULTILANG_PCODER_Linea='Line';
	$MULTILANG_PCODER_Lineas='Lines';
	$MULTILANG_PCODER_Modificado='Modified';
	$MULTILANG_PCODER_No='No';
	$MULTILANG_PCODER_Nombre='Name';
	$MULTILANG_PCODER_Nuevo='New';
	$MULTILANG_PCODER_Operacion='Operation';
	$MULTILANG_PCODER_Otros='Others';
	$MULTILANG_PCODER_Pegar='Paste';
	$MULTILANG_PCODER_Permisos='Permissions';
	$MULTILANG_PCODER_Predeterminado='Default';
	$MULTILANG_PCODER_Preferencias='{P}Coder editors Preferences';
	$MULTILANG_PCODER_Propietario='Owner';
	$MULTILANG_PCODER_Reemplazar='Replace';
	$MULTILANG_PCODER_Rehacer='Redo';
	$MULTILANG_PCODER_Salir='Quit';
	$MULTILANG_PCODER_Seleccionar='Select';
	$MULTILANG_PCODER_Si='Yes';
	$MULTILANG_PCODER_Tamano='Size';
	$MULTILANG_PCODER_Tipo='Type';
	$MULTILANG_PCODER_Trabajando='Working';
	$MULTILANG_PCODER_Ubicacion='Location';
	$MULTILANG_PCODER_Ver='View';

	//Mensajes de error y varios
	$MULTILANG_PCODER_Minimap='Code Minimap';
	$MULTILANG_PCODER_AumSangria='Increase indent';
	$MULTILANG_PCODER_DisSangria='Decrease indent';
	$MULTILANG_PCODER_ConvMay='Convert to uppercase';
	$MULTILANG_PCODER_ConvMin='Convert to lowercase';
	$MULTILANG_PCODER_OrdenaSel='Order selection';
	$MULTILANG_PCODER_CargarArchivo='Load file';
    $MULTILANG_PCODER_Ajuste='Window adjustment';
	$MULTILANG_PCODER_DefPcoder='Code Editor';
	$MULTILANG_PCODER_EnlacePcoder='Code Editor {P}Coder';
	$MULTILANG_PCODER_AtajosTitPcoder='Keyboard shortcuts';
	$MULTILANG_PCODER_PcoderAjuste='Window adjustment';
	$MULTILANG_PCODER_ErrorRW='You dont have rights to write this file! Any change will be lost!';
	$MULTILANG_PCODER_SaltarLinea='Jump to line';
	$MULTILANG_PCODER_Acerca='About';
	$MULTILANG_PCODER_AparienciaEditor='Editor theme';
	$MULTILANG_PCODER_TamanoFuente='Font size';
	$MULTILANG_PCODER_LenguajeProg='Programming language';
	$MULTILANG_PCODER_VerCaracteres='Show hidden chars';
	$MULTILANG_PCODER_CerrarVentana='Changes may lost';
	$MULTILANG_PCODER_PathFull='WebServer Root';
	$MULTILANG_PCODER_PathDisco='Hard disk root';
	$MULTILANG_PCODER_CaracNoImprimibles='Show/Hide Invisible characters';
	$MULTILANG_PCODER_PantallaCompleta='Full screen';
	$MULTILANG_PCODER_PanelIzq='Left panel';
	$MULTILANG_PCODER_PanelDer='Right panel';
	$MULTILANG_PCODER_OcultarPanel='Panel hide';
	$MULTILANG_PCODER_RevisarSintaxis='Check language syntax while I write';
	$MULTILANG_PCODER_SeleccionarTodo='Select all';
	$MULTILANG_PCODER_DepuraErrorSiguiente='Go to next error';
	$MULTILANG_PCODER_DepuraErrorPrevio='Go to previous error';
	$MULTILANG_PCODER_EnrollarSeleccion='Fold selected text';
	$MULTILANG_PCODER_DesenrollarTodo='Unfold all';
	$MULTILANG_PCODER_DuplicarSeleccion='Duplicate selection';
	$MULTILANG_PCODER_InvertirSeleccion='Invert Selection';
	$MULTILANG_PCODER_UnirSeleccion='Join selected in one line';
	$MULTILANG_PCODER_DividirNO='No split code editor';
	$MULTILANG_PCODER_DividirHorizontal='Horizontal split';
	$MULTILANG_PCODER_DividirVertical='Vertical split';
	$MULTILANG_PCODER_ClicSeleccionar='Click to select';
	$MULTILANG_PCODER_ExploradorColores='Color explorer Tool';
	$MULTILANG_PCODER_TerminalRemota='Remote terminal';
	$MULTILANG_PCODER_EditorArchivos='File editor';
	$MULTILANG_PCODER_NavegadorEmbebido='Embedded web browser';
	$MULTILANG_PCODER_AdvertenciaCierre='You are trying to shut down the entire {P} Coder editor. Edited files youve stored still not to be missed. Your confirmation is required to continue.';
	$MULTILANG_PCODER_ErrGuardarDefecto='You must specify a valid file to save or open a file to edit!';
	$MULTILANG_PCODER_ErrGuardarNoPermiso='You dont have rights to write this file using your webserver user!.  Check permissions and try again.';
	$MULTILANG_PCODER_CrearArchivo='New file';
	$MULTILANG_PCODER_CrearCarpeta='New folder';
	$MULTILANG_PCODER_EditarPermisos='Edit permissions';
	$MULTILANG_PCODER_SubirArchivo='Upload file';
	$MULTILANG_PCODER_RecargarExplorador='Explorer reload';
	$MULTILANG_PCODER_EliminarElemento='Delete file/folder';
	$MULTILANG_PCODER_OperacionesFS='Files, Folders and Permissions tasks';
	$MULTILANG_PCODER_ElementoCreado='The element has been created';
	$MULTILANG_PCODER_ElementoExiste='The element already exists';
	$MULTILANG_PCODER_ElementoNoCreado='The element can not be created, deleted or modified over file system.  Please check your permissions';
	$MULTILANG_PCODER_NrosLinea='Show/Hide line numbers, folding and syntax check';
	$MULTILANG_PCODER_CheqSintaxis='Syntax check';
	$MULTILANG_PCODER_LenguajeResaltado='Highlighted language';
	$MULTILANG_PCODER_ExtensionNoSoportada='The file extension that you are trying to open is not supported.  You could add it to the supported extensions if you want to edit this file using PCoder.';
	$MULTILANG_PCODER_HerramientaDiferencias='Differences tool';
	$MULTILANG_PCODER_SensibleMayusculas='Case sensitive';
	$MULTILANG_PCODER_Autocompletado='Autocomplete as you type';
	$MULTILANG_PCODER_HistorialVersiones='Version history';
	$MULTILANG_PCODER_ChatDesarrolladores='Developers chat only';
	$MULTILANG_PCODER_ErrorRO='ERROR: This file is locked for open it simultaneously. Only the user or super user (admin) can unlock it.';
	$MULTILANG_PCODER_AdvertenciaCierre='WARNING: This file was opened by you in the past but this was not closed propertly.  We advice you to close your sessions and files correctly to avoid simultaneous file locks for other users.';
	$MULTILANG_PCODER_AdvConcurrencia='<font color=red>WARNING WARNING WARNING !!!</font><br>This may also indicate that even you have this file open from another workstation. The file will be open but be careful not to overwrite changes when loading the same work file from different computers or use the <b> File-> Version History </b> option to verify any changes.';