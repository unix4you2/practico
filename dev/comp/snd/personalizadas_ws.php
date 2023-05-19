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
    Function: PCOWS_MailGateway_Sendgrid
	Definicion  de servicio web que despacha un mensaje de correo utilizando el proveedor registrado en API externa bajo el nombre de Twilio-Sendgrid (si lo desea cambiar deberá registrarlo con otro nombre y ajustar el codigo de este servicio en la recuperacion de llave de API)

	Variables de entrada de Practico:
	
		PCO_WSOn - Siempre en valor 1 para encender el motor de servicios web
		PCO_WSKey - Llave de servicio creada para el consumo en el framework
		PCO_WSSecret - Secreto de la llave de servicio asociada en el framework
		PCO_WSId - Identificador del servicio o metodo a consumir.  Siempre como PCOWS_MailGateway_Sendgrid

	Variables de entrada (Todas en Base64):
	
		Token - Un token de entrada extra para una segunda capa de seguridad.  Debe ser reemplazado en el servicio y el consumidor por un valor de complejidad adecuada.
		Formato - Formato del contenido de correo (cuerpo del mensaje).  Puede ser  text/html o text/plain
		DeCorreo - (obligatorio) Direccion de correo del remitente 
		DeNombre - Nombre visual del remitente.  Si no es recibido se usa el mismo valor de DeCorreo
		ParaCorreo - (obligatorio) Direccion de correo del destinatario 
		ParaNombre - Nombre visual del destinatario.  Si no es recibido se usa el mismo valor de ParaCorreo
		Asunto - Asunto del mensaje de correo
		Mensaje - Cuerpo del mensaje.  Debe coincidir su formato con la variable Formato
		Icono - Un icono, simbolo codificado en UNICODE o cualquier otro prefiejo que quiera agregar al comienzo de su asunto de correo.  Refs: https://symbl.cc/en/ - https://www.compart.com/en/unicode/
                Ejemplos:   Caduceo         &#9764;     ☤
                            Informacion     &#8505;     ℹ
                            Advertencia     &#9888;     ⚠

	Salida:
		Evaluacion de variables, envio del mensaje y almacenamiento de estadisticas
	
	Estructuras en BD:
	    Para el caso de requerir analitica , auditoria y estadisticas de los mensajes procesados puede crear sobre su instalacion la siguiente tabla.
	    En caso de no requerir estadisticas puede omitir su creacion Y COMENTAR LA LINEA DE INSERCION justo al final de este script
	
            CREATE TABLE app_monitor_correos (
              id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              fecha date NOT NULL,
              hora time NOT NULL,
              ip_origen varchar(20) NOT NULL,
              remitente varchar(50) NOT NULL,
              destinatario varchar(250) NOT NULL,
              asunto varchar(250) NOT NULL,
              aceptado char(2) NOT NULL DEFAULT 'Si'
            ) ENGINE='MyISAM';
            
            ALTER TABLE app_monitor_correos
            ADD INDEX fecha (fecha),
            ADD INDEX hora (hora),
            ADD INDEX ip_origen (ip_origen),
            ADD INDEX remitente (remitente),
            ADD INDEX destinatario (destinatario),
            ADD INDEX aceptado (aceptado);
            
    Ejemplo de llamado por GET: https://host.sudominio.com:8443/index.php?PCO_WSOn=1&PCO_WSKey=3231474E4O&PCO_WSSecret=VJN9356193&PCO_WSId=PCOWS_MailGateway_Sendgrid&Token=e45ee7ce7e88149af8dd32b27f9512ce&Formato=dGV4dC9odG1s&DeCorreo=bm9yZXBseUBjb2xtZWRpY29zLmNvbQ==&DeNombre=RVJQIENvbG1lZGljb3M=&ParaCorreo=dW5peDR5b3UyQGdtYWlsLmNvbQ==&ParaNombre=Sm9obiBBcnJveWF2ZSBHLg==&Asunto=TWVuc2FqZSBkZSBwcnVlYmE=&Mensaje=SG9sYSBlc3RlIGVzIGVsIGN1ZXJvIDxiPmRlIGNvcnJlbzwvYj4hIQ==&Icono=JiMxMDAxNzsgJiM5ODg4OyA=
    Quienes requieran envío de correos de gran peso pueden hacer el llamado al servicio con todos sus datos mediante POST.
*/
if ($PCO_WSId=="PCOWS_MailGateway_Sendgrid")
    {
        //TokenBasicoCalculado - Un segundo Token opcional para agregar otra capa de seguridad a la aceptacion del mensaje.  Reemplace por el patron deseado
        $PCO_TokenBasicoCalculado=md5(date("m"));

        //Variables de uso general
        $PCO_EstadoAceptacion='Si';
        $DireccionRemota=$_SERVER['REMOTE_ADDR'];

        //Variables generales del correo.  Decodificadas desde el base64 y usadas segun el caso
        $Formato=base64_decode($Formato);
        $PCO_RemitenteCorreo=base64_decode($DeCorreo);
        $PCO_DestinatarioCorreo=base64_decode($ParaCorreo);
        $PCO_RemitenteNombre=base64_decode($DeNombre);
        $PCO_DestinatarioNombre=base64_decode($ParaNombre);
        $PCO_IconoAsunto=html_entity_decode(base64_decode($Icono));
        $PCO_Asunto=base64_decode($Asunto);
        $PCO_Mensaje=base64_decode($Mensaje);
        
        //En caso de no recibir algunas de las variables las construye con valores predeterminados
        if ($DeNombre=="")
            $PCO_RemitenteNombre=$PCO_RemitenteCorreo;
        if ($ParaNombre=="")
            $PCO_DestinatarioNombre=$PCO_DestinatarioCorreo;
        $PCO_FormatoContenido="text/html";
        if ($Formato!="" && $Formato!="text/html")
            $PCO_FormatoContenido="text/html";
        $PCO_Asunto=$PCO_IconoAsunto.$PCO_Asunto;

        //Verifica token opcional (si aplica) y campos minimos obligatorios
        if ($PCO_TokenBasicoCalculado==$Token && $PCO_RemitenteCorreo!="" && $PCO_DestinatarioCorreo!="" && $PCO_Asunto!="")
            {
                require("mod/sendgrid/sendgrid-php.php");
                $PCO_ObjetoCorreo = new \SendGrid\Mail\Mail();
                $PCO_ObjetoCorreo->setFrom($PCO_RemitenteCorreo, $PCO_RemitenteNombre);
                $PCO_ObjetoCorreo->setSubject($PCO_Asunto);
                $PCO_ObjetoCorreo->addTo($PCO_DestinatarioCorreo, $PCO_DestinatarioNombre);
                $PCO_ObjetoCorreo->addContent($PCO_FormatoContenido, $PCO_Mensaje);

                //Crea el objeto e inetnta despachar el mensaje
                $PCO_ObjetoSendGrid = new \SendGrid(  PCO_EjecutarSQLUnaria("SELECT api_key FROM {$TablasCore}llaves_api_externas WHERE nombre='Twilio-Sendgrid' ")->fetchColumn()  );
                try 
                    {
                        $PCO_RespuestaSendgrid = $PCO_ObjetoSendGrid->send($PCO_ObjetoCorreo);
                        // print $PCO_RespuestaSendgrid->statusCode() . "\n";
                        // print_r($PCO_RespuestaSendgrid->headers());
                        // print $PCO_RespuestaSendgrid->body() . "\n";
                    }
                catch (Exception $PCO_ErrorRespuesta)
                    {
                        //echo 'Exception: '. $PCO_ErrorRespuesta->getMessage() ."\n";
                    }                    
            }
        else
            {
                $PCO_EstadoAceptacion='No';
            }

        //Guarda un log del mensaje para efectos de control de consumos y analitica posterior
		PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasApp."monitor_correos (fecha,hora,ip_origen,remitente,destinatario,asunto,aceptado) VALUES ('$PCO_FechaOperacion','$PCO_HoraOperacion','$DireccionRemota','$PCO_RemitenteCorreo','$PCO_DestinatarioCorreo','$PCO_Asunto','$PCO_EstadoAceptacion')");
    }