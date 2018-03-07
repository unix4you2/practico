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


		Title: Configuracion Proveedores OAuth 1.0 y 2.0
		
		IMPORTANTE: La actualizacion de este archivo se deberia realizar por medio de la ventana de configuracion de la herramienta.  No altere estos valores manualmente a menos que sepa lo que hace.
		
		Ubicacion *[/core/ws_oauth.php]*.  Archivo que contiene la configuracion para autenticaciones externas con proveedores OAuth
	*/

	// Ubicacion de las opciones al login
	$UbicacionProveedoresOAuth='0';

	// Google
	$APIGoogle_ClientId='345';
	$APIGoogle_ClientSecret='345';
	$APIGoogle_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=Google';
	$APIGoogle_Template='';

	// Facebook
	$APIFacebook_ClientId='345';
	$APIFacebook_ClientSecret='345';
	$APIFacebook_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=Facebook';
	$APIFacebook_Template='';

	// Twitter
	$APITwitter_ClientId='';
	$APITwitter_ClientSecret='';
	$APITwitter_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=Twitter';
	$APITwitter_Template='';

	// Dropbox
	$APIDropbox_ClientId='345';
	$APIDropbox_ClientSecret='345';
	$APIDropbox_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=Dropbox';
	$APIDropbox_Template='';

	// Flickr
	$APIFlickr_ClientId='';
	$APIFlickr_ClientSecret='';
	$APIFlickr_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=Flickr';
	$APIFlickr_Template='';

	// Microsoft
	$APIMicrosoft_ClientId='';
	$APIMicrosoft_ClientSecret='';
	$APIMicrosoft_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=Microsoft';
	$APIMicrosoft_Template='';

	// Foursquare
	$APIFoursquare_ClientId='';
	$APIFoursquare_ClientSecret='';
	$APIFoursquare_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=Foursquare';
	$APIFoursquare_Template='';

	// Bitbucket
	$APIBitbucket_ClientId='';
	$APIBitbucket_ClientSecret='';
	$APIBitbucket_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=Bitbucket';
	$APIBitbucket_Template='';

	// Salesforce
	$APISalesforce_ClientId='';
	$APISalesforce_ClientSecret='';
	$APISalesforce_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=Salesforce';
	$APISalesforce_Template='';

	// Yahoo
	$APIYahoo_ClientId='345';
	$APIYahoo_ClientSecret='345';
	$APIYahoo_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=Yahoo';
	$APIYahoo_Template='';

	// Box
	$APIBox_ClientId='';
	$APIBox_ClientSecret='';
	$APIBox_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=Box';
	$APIBox_Template='';

	// Disqus
	$APIDisqus_ClientId='';
	$APIDisqus_ClientSecret='';
	$APIDisqus_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=Disqus';
	$APIDisqus_Template='';

	// RightSignature
	$APIRightSignature_ClientId='';
	$APIRightSignature_ClientSecret='';
	$APIRightSignature_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=RightSignature';
	$APIRightSignature_Template='';

	// Fitbit
	$APIFitbit_ClientId='';
	$APIFitbit_ClientSecret='';
	$APIFitbit_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=Fitbit';
	$APIFitbit_Template='';

	// ScoopIt
	$APIScoopIt_ClientId='';
	$APIScoopIt_ClientSecret='';
	$APIScoopIt_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=ScoopIt';
	$APIScoopIt_Template='';

	// Tumblr
	$APITumblr_ClientId='';
	$APITumblr_ClientSecret='';
	$APITumblr_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=Tumblr';
	$APITumblr_Template='';

	// StockTwits
	$APIStockTwits_ClientId='';
	$APIStockTwits_ClientSecret='';
	$APIStockTwits_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=StockTwits';
	$APIStockTwits_Template='';

	// LinkedIn
	$APILinkedIn_ClientId='345';
	$APILinkedIn_ClientSecret='345';
	$APILinkedIn_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=LinkedIn';
	$APILinkedIn_Template='';

	// Instagram
	$APIInstagram_ClientId='';
	$APIInstagram_ClientSecret='';
	$APIInstagram_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=Instagram';
	$APIInstagram_Template='';

	// SurveyMonkey
	$APISurveyMonkey_ClientId='';
	$APISurveyMonkey_ClientSecret='';
	$APISurveyMonkey_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=SurveyMonkey';
	$APISurveyMonkey_Template='';

	// Eventful
	$APIEventful_ClientId='';
	$APIEventful_ClientSecret='';
	$APIEventful_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=Eventful';
	$APIEventful_Template='';

	// XING
	$APIXING_ClientId='';
	$APIXING_ClientSecret='';
	$APIXING_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=XING';
	$APIXING_Template='';
	
	// VK
	$APIVK_ClientId='';
	$APIVK_ClientSecret='';
	$APIVK_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=VK';
	$APIVK_Template='';
	
	// Withings
	$APIWithings_ClientId='';
	$APIWithings_ClientSecret='';
	$APIWithings_RedirectUri='http://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=autenticacion_oauth&OAuthSrv=Withings';
	$APIWithings_Template='';