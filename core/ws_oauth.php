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
	$APIGoogle_ClientId='';
	$APIGoogle_ClientSecret='';
	$APIGoogle_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Google';
	$APIGoogle_Template='';

	// Facebook
	$APIFacebook_ClientId='';
	$APIFacebook_ClientSecret='';
	$APIFacebook_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Facebook';
	$APIFacebook_Template='';

	// Twitter
	$APITwitter_ClientId='';
	$APITwitter_ClientSecret='';
	$APITwitter_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Twitter';
	$APITwitter_Template='';

	// Dropbox
	$APIDropbox_ClientId='';
	$APIDropbox_ClientSecret='';
	$APIDropbox_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Dropbox';
	$APIDropbox_Template='';

	// Flickr
	$APIFlickr_ClientId='';
	$APIFlickr_ClientSecret='';
	$APIFlickr_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Flickr';
	$APIFlickr_Template='';

	// Microsoft
	$APIMicrosoft_ClientId='';
	$APIMicrosoft_ClientSecret='';
	$APIMicrosoft_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Microsoft';
	$APIMicrosoft_Template='';

	// Foursquare
	$APIFoursquare_ClientId='';
	$APIFoursquare_ClientSecret='';
	$APIFoursquare_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Foursquare';
	$APIFoursquare_Template='';

	// Bitbucket
	$APIBitbucket_ClientId='';
	$APIBitbucket_ClientSecret='';
	$APIBitbucket_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Bitbucket';
	$APIBitbucket_Template='';

	// Salesforce
	$APISalesforce_ClientId='';
	$APISalesforce_ClientSecret='';
	$APISalesforce_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Salesforce';
	$APISalesforce_Template='';

	// Yahoo
	$APIYahoo_ClientId='';
	$APIYahoo_ClientSecret='';
	$APIYahoo_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Yahoo';
	$APIYahoo_Template='';

	// Box
	$APIBox_ClientId='';
	$APIBox_ClientSecret='';
	$APIBox_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Box';
	$APIBox_Template='';

	// Disqus
	$APIDisqus_ClientId='';
	$APIDisqus_ClientSecret='';
	$APIDisqus_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Disqus';
	$APIDisqus_Template='';

	// RightSignature
	$APIRightSignature_ClientId='';
	$APIRightSignature_ClientSecret='';
	$APIRightSignature_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=RightSignature';
	$APIRightSignature_Template='';

	// Fitbit
	$APIFitbit_ClientId='';
	$APIFitbit_ClientSecret='';
	$APIFitbit_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Fitbit';
	$APIFitbit_Template='';

	// ScoopIt
	$APIScoopIt_ClientId='';
	$APIScoopIt_ClientSecret='';
	$APIScoopIt_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=ScoopIt';
	$APIScoopIt_Template='';

	// Tumblr
	$APITumblr_ClientId='';
	$APITumblr_ClientSecret='';
	$APITumblr_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Tumblr';
	$APITumblr_Template='';

	// StockTwits
	$APIStockTwits_ClientId='';
	$APIStockTwits_ClientSecret='';
	$APIStockTwits_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=StockTwits';
	$APIStockTwits_Template='';

	// LinkedIn
	$APILinkedIn_ClientId='';
	$APILinkedIn_ClientSecret='';
	$APILinkedIn_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=LinkedIn';
	$APILinkedIn_Template='';

	// Instagram
	$APIInstagram_ClientId='';
	$APIInstagram_ClientSecret='';
	$APIInstagram_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Instagram';
	$APIInstagram_Template='';

	// SurveyMonkey
	$APISurveyMonkey_ClientId='';
	$APISurveyMonkey_ClientSecret='';
	$APISurveyMonkey_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=SurveyMonkey';
	$APISurveyMonkey_Template='';

	// Eventful
	$APIEventful_ClientId='';
	$APIEventful_ClientSecret='';
	$APIEventful_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Eventful';
	$APIEventful_Template='';

	// XING
	$APIXING_ClientId='';
	$APIXING_ClientSecret='';
	$APIXING_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=XING';
	$APIXING_Template='';
	
	// VK
	$APIVK_ClientId='';
	$APIVK_ClientSecret='';
	$APIVK_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=VK';
	$APIVK_Template='';
	
	// Withings
	$APIWithings_ClientId='';
	$APIWithings_ClientSecret='';
	$APIWithings_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Withings';
	$APIWithings_Template='';
	
	// 37Signals
	$API37Signals_ClientId='';
	$API37Signals_ClientSecret='';
	$API37Signals_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=37Signals';
	$API37Signals_Template='';
	
	// Amazon
	$APIAmazon_ClientId='';
	$APIAmazon_ClientSecret='';
	$APIAmazon_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Amazon';
	$APIAmazon_Template='';
	
	// AOL
	$APIAOL_ClientId='';
	$APIAOL_ClientSecret='';
	$APIAOL_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=AOL';
	$APIAOL_Template='';
	
	// Bitly
	$APIBitly_ClientId='';
	$APIBitly_ClientSecret='';
	$APIBitly_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Bitly';
	$APIBitly_Template='';
	
	// Buffer
	$APIBuffer_ClientId='';
	$APIBuffer_ClientSecret='';
	$APIBuffer_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Buffer';
	$APIBuffer_Template='';
	
	// Copy
	$APICopy_ClientId='';
	$APICopy_ClientSecret='';
	$APICopy_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Copy';
	$APICopy_Template='';
	
	// Dailymotion
	$APIDailymotion_ClientId='';
	$APIDailymotion_ClientSecret='';
	$APIDailymotion_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Dailymotion';
	$APIDailymotion_Template='';
	
	// Discogs
	$APIDiscogs_ClientId='';
	$APIDiscogs_ClientSecret='';
	$APIDiscogs_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Discogs';
	$APIDiscogs_Template='';
	
	// Etsy
	$APIEtsy_ClientId='';
	$APIEtsy_ClientSecret='';
	$APIEtsy_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Etsy';
	$APIEtsy_Template='';
	
	// Garmin
	$APIGarmin_ClientId='';
	$APIGarmin_ClientSecret='';
	$APIGarmin_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Garmin';
	$APIGarmin_Template='';
	
	// Garmin2Legged
	$APIGarmin2Legged_ClientId='';
	$APIGarmin2Legged_ClientSecret='';
	$APIGarmin2Legged_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Garmin2Legged';
	$APIGarmin2Legged_Template='';
	
	// iHealth
	$APIiHealth_ClientId='';
	$APIiHealth_ClientSecret='';
	$APIiHealth_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=iHealth';
	$APIiHealth_Template='';
	
	// imgur
	$APIimgur_ClientId='';
	$APIimgur_ClientSecret='';
	$APIimgur_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=imgur';
	$APIimgur_Template='';
	
	// Infusionsoft
	$APIInfusionsoft_ClientId='';
	$APIInfusionsoft_ClientSecret='';
	$APIInfusionsoft_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Infusionsoft';
	$APIInfusionsoft_Template='';
	
	// Intuit
	$APIIntuit_ClientId='';
	$APIIntuit_ClientSecret='';
	$APIIntuit_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Intuit';
	$APIIntuit_Template='';
	
	// Jawbone
	$APIJawbone_ClientId='';
	$APIJawbone_ClientSecret='';
	$APIJawbone_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Jawbone';
	$APIJawbone_Template='';
	
	// Livecoding
	$APILivecoding_ClientId='';
	$APILivecoding_ClientSecret='';
	$APILivecoding_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Livecoding';
	$APILivecoding_Template='';
	
	// MailChimp
	$APIMailChimp_ClientId='';
	$APIMailChimp_ClientSecret='';
	$APIMailChimp_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=MailChimp';
	$APIMailChimp_Template='';
	
	// Mavenlink
	$APIMavenlink_ClientId='';
	$APIMavenlink_ClientSecret='';
	$APIMavenlink_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Mavenlink';
	$APIMavenlink_Template='';
	
	// Meetup
	$APIMeetup_ClientId='';
	$APIMeetup_ClientSecret='';
	$APIMeetup_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Meetup';
	$APIMeetup_Template='';
	
	// MicrosoftOpenIDConnect
	$APIMicrosoftOpenIDConnect_ClientId='';
	$APIMicrosoftOpenIDConnect_ClientSecret='';
	$APIMicrosoftOpenIDConnect_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=MicrosoftOpenIDConnect';
	$APIMicrosoftOpenIDConnect_Template='';
	
	// Misfit
	$APIMisfit_ClientId='';
	$APIMisfit_ClientSecret='';
	$APIMisfit_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Misfit';
	$APIMisfit_Template='';
	
	// oDesk
	$APIoDesk_ClientId='';
	$APIoDesk_ClientSecret='';
	$APIoDesk_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=oDesk';
	$APIoDesk_Template='';
	
	// Odnoklassniki
	$APIOdnoklassniki_ClientId='';
	$APIOdnoklassniki_ClientSecret='';
	$APIOdnoklassniki_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Odnoklassniki';
	$APIOdnoklassniki_Template='';
	
	// Paypal
	$APIPaypal_ClientId='';
	$APIPaypal_ClientSecret='';
	$APIPaypal_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Paypal';
	$APIPaypal_Template='';
	
	// Pinterest
	$APIPinterest_ClientId='';
	$APIPinterest_ClientSecret='';
	$APIPinterest_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Pinterest';
	$APIPinterest_Template='';
	
	// Rdio
	$APIRdio_ClientId='';
	$APIRdio_ClientSecret='';
	$APIRdio_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Rdio';
	$APIRdio_Template='';
	
	// Reddit
	$APIReddit_ClientId='';
	$APIReddit_ClientSecret='';
	$APIReddit_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Reddit';
	$APIReddit_Template='';
	
	// RunKeeper
	$APIRunKeeper_ClientId='';
	$APIRunKeeper_ClientSecret='';
	$APIRunKeeper_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=RunKeeper';
	$APIRunKeeper_Template='';
	
	// Uber
	$APIUber_ClientId='';
	$APIUber_ClientSecret='';
	$APIUber_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Uber';
	$APIUber_Template='';
	
	// TeamViewer
	$APITeamViewer_ClientId='';
	$APITeamViewer_ClientSecret='';
	$APITeamViewer_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=TeamViewer';
	$APITeamViewer_Template='';
	
	// Vimeo
	$APIVimeo_ClientId='';
	$APIVimeo_ClientSecret='';
	$APIVimeo_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Vimeo';
	$APIVimeo_Template='';
	
	// Wordpress
	$APIWordpress_ClientId='';
	$APIWordpress_ClientSecret='';
	$APIWordpress_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Wordpress';
	$APIWordpress_Template='';
	
	// Xero
	$APIXero_ClientId='';
	$APIXero_ClientSecret='';
	$APIXero_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Xero';
	$APIXero_Template='';
	
	// Yammer
	$APIYammer_ClientId='';
	$APIYammer_ClientSecret='';
	$APIYammer_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Yammer';
	$APIYammer_Template='';
	
	// Yandex
	$APIYandex_ClientId='';
	$APIYandex_ClientSecret='';
	$APIYandex_RedirectUri='https://dev.practico.org/practico/index.php?PCO_WSOn=1&PCO_WSId=PCO_AutenticacionOauth&OAuthSrv=Yandex';
	$APIYandex_Template='';
	