#!/usr/bin/env python
# -*- coding: utf-8 -*-
"""
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2020
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
    Redistribution and use in source and binary forms, with or without
    modification, are permitted provided that the following conditions are met:
    
    1. Redistributions of source code must retain the above copyright notice, this
       list of conditions and the following disclaimer.
    
    2. Redistributions in binary form must reproduce the above copyright notice,
       this list of conditions and the following disclaimer in the documentation
       and/or other materials provided with the distribution.
    
    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
    AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
    IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
    DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
    FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
    DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
    SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
    CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
    OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
    OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
"""
import sys
import PAM
import urllib
import xml.dom.minidom
from getpass import getpass



########################################################################
###############  PARAMETROS BASICOS DE CONFIGURACION  ##################
########################################################################
uid = "admin"
clave = "admin"

# Llave para consumo de web services preautorizada en Practico o llave de instalacion
LlaveDePaso = "CN3S9B25NH"

# Protocolo a utilizar en la solicitud, Valores posibles:  http://  o https:// 
protocolo_webservice = "http://"

# URL de Practico, slash al final.  Se debe resolver por el cliente (ip, dominio, etc)
prefijo_webservice = "127.0.0.1/practico/"
########################################################################



# Construye la URL del webservice
posfijo_webservice = "?PCO_WSOn=1&PCO_WSKey=" + LlaveDePaso + "&PCO_WSId=verificar_credenciales&uid=" + uid + "&clave=" + clave
webservice_validacion = protocolo_webservice + prefijo_webservice + posfijo_webservice

# Carga la URL indicada para el webservice
contenido = urllib.urlopen(webservice_validacion)

# Lee desde el objeto y guarda el resultado
resultado_webservice = contenido.read()
contenido.close()
# print resultado_webservice  # Imprime todo el XML (para pruebas)

# Carga el archivo XML desde la ruta de webservice
xmldoc = xml.dom.minidom.parseString(resultado_webservice)

# Carga cada valor de los tags XML (repetir esto por cada tag deseado del XML, ej:  uid,nivel,nombre,etc)
for xml_aceptacion in xmldoc.getElementsByTagName("aceptacion"):
	resultado_aceptacion=xml_aceptacion.firstChild.data
	# print xml_aceptacion.toxml()		# Imprime el elemento analizado
	# print xml_aceptacion.firstChild.data	# Imprime el valor del elemento


if resultado_aceptacion == 1:
	retval = pamh.PAM_SUCCESS
else:
	retval = pamh.PAM_AUTH_ERR



return retval





def pam_conv(auth, query_list, userData):

	resp = []

	for i in range(len(query_list)):
		query, type = query_list[i]
		if type == PAM.PAM_PROMPT_ECHO_ON:
			val = raw_input(query)
			resp.append((val, 0))
		elif type == PAM.PAM_PROMPT_ECHO_OFF:
			val = getpass(query)
			resp.append((val, 0))
		elif type == PAM.PAM_PROMPT_ERROR_MSG or type == PAM.PAM_PROMPT_TEXT_INFO:
			print query
			resp.append(('', 0))
		else:
			return None

	return resp

service = 'passwd'

if len(sys.argv) == 2:
	user = sys.argv[1]
else:
	user = None

auth = PAM.pam()
auth.start(service)
if user != None:
	auth.set_item(PAM.PAM_USER, user)
auth.set_item(PAM.PAM_CONV, pam_conv)
try:
	auth.authenticate()
	auth.acct_mgmt()
except PAM.error, resp:
	print 'Go away! (%s)' % resp
except:
	print 'Internal error'
else:
	print 'Good to go!'