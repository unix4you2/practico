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
		Title: Seccion Proveedores OAuth
		Ubicacion *[/core/marco_oauth.php]*.  Archivo con los proveedores definidos para OAuth

	Ver tambien:
		<Seccion superior> | <Articulador>
	*/

	//Valida que quien llame este marco tenga permisos suficientes
	if (@$PCOSESS_LoginUsuario!="admin" || !$PCOSESS_SesionAbierta)
		die();

?>


    <!-- Modal Proveedores Oauth -->
    <?php abrir_dialogo_modal("myModalOAUTH",$MULTILANG_ConfiguracionGeneral,"modal-wide"); ?>

			<?php

				// Determina si la conexion actual de Practico esta encriptada
				if(empty($_SERVER["HTTPS"]))
					$protocolo_webservice="http://";
				else
					$protocolo_webservice="https://";
				// Construye la URI de retorno
				$prefijo_webservice=$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
				// Construye la URI de redireccion base para concatenar el servicio especifico
				$URI = $protocolo_webservice.$prefijo_webservice."?WSOn=1&WSId=autenticacion_oauth&OAuthSrv=";
			?>

					<form name="configoauth" action="" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
					<input type="hidden" name="PCO_Accion" value="guardar_oauth">

					<?php
						echo '<b>'.$MULTILANG_Importante.'</b>:<br>';
						echo '<li>'.$MULTILANG_OauthTitURI; 						
						echo '<li>'.$MULTILANG_OauthDesURI.'<hr>'; 
					?>

					<table class="table table-condensed table-unbordered btn-xs">
						<tr>
							<td valign=top align=center>
									<!-- ### OAUTH GOOGLE ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="http://code.google.com/apis/console" target="_BLANK"><img src="inc/oauth/logos/google.png" border=0 width=94 height=35 align=middle></a>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIGoogle_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIGoogle_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIGoogle_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIGoogle_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIGoogle_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>Google" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIGoogle_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIGoogle_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
							<td valign=top  align=center>
									<!-- ### OAUTH FACEBOOK ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="https://developers.facebook.com/apps" target="_BLANK"><img src="inc/oauth/logos/facebook.png" border=0 width=94 height=35 align=middle></a>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIFacebook_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIFacebook_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIFacebook_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIFacebook_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIFacebook_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>Facebook" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIFacebook_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIFacebook_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
							<td valign=top  align=center>
									<!-- ### OAUTH TWITTER ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="https://dev.twitter.com/apps/new" target="_BLANK"><img src="inc/oauth/logos/twitter.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APITwitter_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APITwitter_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APITwitter_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APITwitter_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APITwitter_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>Twitter" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APITwitter_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APITwitter_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
						</tr>
						<tr>
							<td valign=top  align=center>
									<!-- ### OAUTH DROPBOX ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="https://www.dropbox.com/developers/apps" target="_BLANK"><img src="inc/oauth/logos/dropbox.png" border=0 width=94 height=35 align=middle></a>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIDropbox_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIDropbox_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIDropbox_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIDropbox_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIDropbox_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>Dropbox" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIDropbox_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIDropbox_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
							<td valign=top  align=center>
									<!-- ### OAUTH FLICKR ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="http://www.flickr.com/services/apps/create/" target="_BLANK"><img src="inc/oauth/logos/flickr.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIFlickr_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIFlickr_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIFlickr_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIFlickr_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIFlickr_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>Flickr" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIFlickr_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIFlickr_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
							<td valign=top  align=center>
									<!-- ### OAUTH MICROSOFT ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="https://manage.dev.live.com/AddApplication.aspx" target="_BLANK"><img src="inc/oauth/logos/microsoft.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIMicrosoft_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIMicrosoft_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIMicrosoft_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIMicrosoft_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIMicrosoft_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>Microsoft" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIMicrosoft_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIMicrosoft_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
						</tr>
						<tr>
							<td valign=top align=center>
									<!-- ### OAUTH FOURSQUARE ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="https://foursquare.com/developers/apps" target="_BLANK"><img src="inc/oauth/logos/foursquare.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIFoursquare_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIFoursquare_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIFoursquare_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIFoursquare_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIFoursquare_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>Foursquare" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIFoursquare_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIFoursquare_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
							<td valign=top  align=center>
									<!-- ### OAUTH BITBUCKET ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="https://bitbucket.org/account/" target="_BLANK"><img src="inc/oauth/logos/bitbucket.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIBitbucket_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIBitbucket_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIBitbucket_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIBitbucket_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIBitbucket_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>Bitbucket" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIBitbucket_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIBitbucket_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
							<td valign=top  align=center>
									<!-- ### OAUTH SALESFORCE ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="http://www.salesforce.com/" target="_BLANK"><img src="inc/oauth/logos/salesforce.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APISalesforce_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APISalesforce_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APISalesforce_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APISalesforce_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APISalesforce_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>Salesforce" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APISalesforce_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APISalesforce_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
						</tr>
						<tr>
							<td valign=top align=center>
									<!-- ### OAUTH YAHOO ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="https://developer.apps.yahoo.com/projects/" target="_BLANK"><img src="inc/oauth/logos/yahoo.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIYahoo_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIYahoo_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIYahoo_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIYahoo_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIYahoo_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>Yahoo" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIYahoo_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIYahoo_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
							<td valign=top  align=center>
									<!-- ### OAUTH BOX ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="https://www.box.com/developers/services" target="_BLANK"><img src="inc/oauth/logos/box.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIBox_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIBox_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIBox_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIBox_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIBox_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>Box" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIBox_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIBox_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
							<td valign=top  align=center>
									<!-- ### OAUTH DISQUS ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="http://disqus.com/api/applications/" target="_BLANK"><img src="inc/oauth/logos/disqus.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIDisqus_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIDisqus_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIDisqus_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIDisqus_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIDisqus_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>Disqus" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIDisqus_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIDisqus_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
						</tr>
						<tr>
							<td valign=top align=center>
									<!-- ### OAUTH RIGHTSIGNATURE ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="https://rightsignature.com/oauth_clients/new" target="_BLANK"><img src="inc/oauth/logos/rightsignature.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIRightSignature_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIRightSignature_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIRightSignature_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIRightSignature_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIRightSignature_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>RightSignature" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIRightSignature_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIRightSignature_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
							<td valign=top  align=center>
									<!-- ### OAUTH FITBIT ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="https://dev.fitbit.com/apps/new" target="_BLANK"><img src="inc/oauth/logos/fitbit.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIFitbit_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIFitbit_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIFitbit_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIFitbit_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIFitbit_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>Fitbit" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIFitbit_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIFitbit_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
							<td valign=top  align=center>
									<!-- ### OAUTH SCOOP.IT ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="https://www.scoopit.com/developers/apps" target="_BLANK"><img src="inc/oauth/logos/scoopit.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIScoopIt_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIScoopIt_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIScoopIt_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIScoopIt_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIScoopIt_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>ScoopIt" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIScoopIt_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIScoopIt_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
						</tr>
						<tr>
							<td valign=top align=center>
									<!-- ### OAUTH TUMBLR ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="http://www.tumblr.com/oauth/apps" target="_BLANK"><img src="inc/oauth/logos/tumblr.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APITumblr_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APITumblr_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APITumblr_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APITumblr_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APITumblr_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>Tumblr" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APITumblr_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APITumblr_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
							<td valign=top  align=center>
									<!-- ### OAUTH STOCKTWITS ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="http://stocktwits.com/developers/apps/new" target="_BLANK"><img src="inc/oauth/logos/stocktwits.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIStockTwits_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIStockTwits_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIStockTwits_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIStockTwits_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIStockTwits_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>StockTwits" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIStockTwits_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIStockTwits_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
							<td valign=top  align=center>
									<!-- ### OAUTH LINKEDIN ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="https://www.linkedin.com/secure/developer?newapp=" target="_BLANK"><img src="inc/oauth/logos/linkedin.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APILinkedIn_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APILinkedIn_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APILinkedIn_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APILinkedIn_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APILinkedIn_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>LinkedIn" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APILinkedIn_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APILinkedIn_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
						</tr>
						<tr>
							<td valign=top align=center>
									<!-- ### OAUTH INSTAGRAM ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="http://instagram.com/developer/register/" target="_BLANK"><img src="inc/oauth/logos/instagram.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIInstagram_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIInstagram_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIInstagram_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIInstagram_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIInstagram_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>Instagram" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIInstagram_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIInstagram_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
							<td valign=top  align=center>
									<!-- ### OAUTH SURVEYMONKEY ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="https://developer.surveymonkey.com/apps/register" target="_BLANK"><img src="inc/oauth/logos/surveymonkey.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APISurveyMonkey_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APISurveyMonkey_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APISurveyMonkey_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APISurveyMonkey_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APISurveyMonkey_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>SurveyMonkey" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APISurveyMonkey_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APISurveyMonkey_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
							<td valign=top  align=center>
									<!-- ### OAUTH EVENTFUL ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="http://api.eventful.com/keys/new" target="_BLANK"><img src="inc/oauth/logos/eventful.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIEventful_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIEventful_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIEventful_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIEventful_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIEventful_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>Eventful" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIEventful_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIEventful_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
						</tr>
						<tr>
							<td valign=top  align=center>
									<!-- ### OAUTH XING ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="https://dev.xing.com/applications" target="_BLANK"><img src="inc/oauth/logos/xing.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIXING_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIXING_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIXING_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIXING_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIXING_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>XING" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIXING_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIXING_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
							<td valign=top  align=center>
									<!-- ### OAUTH VK ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="http://vk.com/editapp?act=create" target="_BLANK"><img src="inc/oauth/logos/vk.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIVK_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIVK_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIVK_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIVK_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIVK_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>VK" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIVK_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIVK_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
							<td valign=top  align=center>
									<!-- ### OAUTH Withings ### -->
									<table cellspacing=0 cellpadding=0 width="100%" style="font-size:11px; color:000000;">
										<tr>
											<td valign=top align=right></td>
											<td valign=top>
												<a href="https://oauth.withings.com/en/partner/add" target="_BLANK"><img src="inc/oauth/logos/withings.png" border=0 width=94 height=35 align=middle></a>
												<i><b><font color=red>Beta</font></b></i>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthId; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIWithings_ClientIdNEW" size="20" class="CampoTexto" value="<?php echo $APIWithings_ClientId; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthSecret; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIWithings_ClientSecretNEW" size="20" class="CampoTexto" value="<?php echo $APIWithings_ClientSecret; ?>" >
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthURI; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIWithings_RedirectUriNEW" size="20" class="CampoTexto" value="<?php echo $URI; ?>Withings" readonly>
											</td>
										</tr>
										<tr>
											<td valign=top align=right>
												<?php echo $MULTILANG_AuthOauthPlantilla; ?>
											</td>
											<td valign=top>
												&nbsp;<input type="text" name="APIWithings_TemplateNEW" size="20" class="CampoTexto" value="<?php echo $APIWithings_Template; ?>" >
											</td>
										</tr>
									</table>
							</td>
						</tr>

					</table>


    <?php 
        $barra_herramientas_modal='
            <button type="submit" class="btn btn-success">'.$MULTILANG_Guardar.' <i class="fa fa-save"></i></button>
            <button type="button" class="btn btn-default" data-dismiss="modal">'.$MULTILANG_Cerrar.' {<i class="fa fa-keyboard-o"></i> Esc}</button>';
        cerrar_dialogo_modal($barra_herramientas_modal);
    ?>

					</form>
