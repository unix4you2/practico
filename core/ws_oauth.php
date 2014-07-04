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

	// Google
	$APIGoogle_ClientId='123123';
	$APIGoogle_ClientSecret='123123';
	$APIGoogle_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=Google';
	$APIGoogle_Template='';

	// Facebook
	$APIFacebook_ClientId='';
	$APIFacebook_ClientSecret='';
	$APIFacebook_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=Facebook';
	$APIFacebook_Template='';

	// Twitter
	$APITwitter_ClientId='';
	$APITwitter_ClientSecret='';
	$APITwitter_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=Twitter';
	$APITwitter_Template='';

	// Dropbox
	$APIDropbox_ClientId='';
	$APIDropbox_ClientSecret='';
	$APIDropbox_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=Dropbox';
	$APIDropbox_Template='';

	// Flickr
	$APIFlickr_ClientId='';
	$APIFlickr_ClientSecret='';
	$APIFlickr_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=Flickr';
	$APIFlickr_Template='';

	// Microsoft
	$APIMicrosoft_ClientId='';
	$APIMicrosoft_ClientSecret='';
	$APIMicrosoft_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=Microsoft';
	$APIMicrosoft_Template='';

	// Foursquare
	$APIFoursquare_ClientId='';
	$APIFoursquare_ClientSecret='';
	$APIFoursquare_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=Foursquare';
	$APIFoursquare_Template='';

	// Bitbucket
	$APIBitbucket_ClientId='';
	$APIBitbucket_ClientSecret='';
	$APIBitbucket_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=Bitbucket';
	$APIBitbucket_Template='';

	// Salesforce
	$APISalesforce_ClientId='';
	$APISalesforce_ClientSecret='';
	$APISalesforce_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=Salesforce';
	$APISalesforce_Template='';

	// Yahoo
	$APIYahoo_ClientId='';
	$APIYahoo_ClientSecret='';
	$APIYahoo_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=Yahoo';
	$APIYahoo_Template='';

	// Box
	$APIBox_ClientId='';
	$APIBox_ClientSecret='';
	$APIBox_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=Box';
	$APIBox_Template='';

	// Disqus
	$APIDisqus_ClientId='';
	$APIDisqus_ClientSecret='';
	$APIDisqus_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=Disqus';
	$APIDisqus_Template='';

	// RightSignature
	$APIRightSignature_ClientId='';
	$APIRightSignature_ClientSecret='';
	$APIRightSignature_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=RightSignature';
	$APIRightSignature_Template='';

	// Fitbit
	$APIFitbit_ClientId='';
	$APIFitbit_ClientSecret='';
	$APIFitbit_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=Fitbit';
	$APIFitbit_Template='';

	// ScoopIt
	$APIScoopIt_ClientId='';
	$APIScoopIt_ClientSecret='';
	$APIScoopIt_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=ScoopIt';
	$APIScoopIt_Template='';

	// Tumblr
	$APITumblr_ClientId='';
	$APITumblr_ClientSecret='';
	$APITumblr_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=Tumblr';
	$APITumblr_Template='';

	// StockTwits
	$APIStockTwits_ClientId='';
	$APIStockTwits_ClientSecret='';
	$APIStockTwits_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=StockTwits';
	$APIStockTwits_Template='';

	// LinkedIn
	$APILinkedIn_ClientId='';
	$APILinkedIn_ClientSecret='';
	$APILinkedIn_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=LinkedIn';
	$APILinkedIn_Template='';

	// Instagram
	$APIInstagram_ClientId='';
	$APIInstagram_ClientSecret='';
	$APIInstagram_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=Instagram';
	$APIInstagram_Template='';

	// SurveyMonkey
	$APISurveyMonkey_ClientId='';
	$APISurveyMonkey_ClientSecret='';
	$APISurveyMonkey_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=SurveyMonkey';
	$APISurveyMonkey_Template='';

	// Eventful
	$APIEventful_ClientId='';
	$APIEventful_ClientSecret='';
	$APIEventful_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=Eventful';
	$APIEventful_Template='';

	// XING
	$APIXING_ClientId='';
	$APIXING_ClientSecret='';
	$APIXING_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=XING';
	$APIXING_Template='';
	
	// VK
	$APIVK_ClientId='';
	$APIVK_ClientSecret='';
	$APIVK_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=VK';
	$APIVK_Template='';
	
	// Withings
	$APIWithings_ClientId='';
	$APIWithings_ClientSecret='';
	$APIWithings_RedirectUri='http://127.0.0.1/practico/index.php?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=Withings';
	$APIWithings_Template='';