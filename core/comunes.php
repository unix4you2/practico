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
		Title: Libreria base
		Ubicacion *[/core/comunes.php]*.  Archivo que contiene las funciones de uso global.
	*/
	/*
		Section: Funciones asociadas a las operaciones con bases de datos - Ejecucion de consultas
	*/


########################################################################
########################################################################
/*
	Function: PCO_Base64UrlEncode
	Permite codificar de manera mas consistente la informacion cuando debe ser transmitida por URL y la cadena resultante cuenta con caracteres no permitidos por estandar RFC para las URL.

	Variables de entrada:

		Cadena - Cadena que se desea codificar

	Salida:
		Cadena codificada en base 64 pero reemplazando caracteres no estandar para URL
*/
function PCO_Base64UrlEncode($Cadena)
    {
        $CadenaEnBase64URL = strtr(base64_encode($Cadena), '+/', '-_');
        return rtrim($CadenaEnBase64URL, '=');
    }


########################################################################
########################################################################
/*
	Function: PCO_Base64UrlDecode
	Funciin inversa a la codificacion de informacion cuando debe ser transmitida por URL y la cadena resultante cuenta con caracteres no permitidos por estandar RFC para las URL.

	Variables de entrada:

		Cadena - Cadena codificada mediante PCO_Base64UrlEncode

	Salida:
		Cadena decodificada
*/
function PCO_Base64UrlDecode($CadenaEnBase64URL)
    {
        return base64_decode(strtr($CadenaEnBase64URL, '-_', '+/'));
    }


########################################################################
########################################################################
/*
	Function: PCO_EvaluarCodigoExterno
	Ejecuta codigo de un lenguaje determinado recibido dentro de una cadena.

	Variables de entrada:

		CodigoUnicoScript - Cadena que identifica de manera unica el script en la aplicacion
		Silenciar - Determina si se muestra o no la salida de la ejecucion
		PCO_ArchivoScript - En los casos donde el comando de compilacion o ejecucion contenga esta variable en notacion PHP entonces sera reemplazada por la ruta del archivo temporal generado

	Salida:
		Evaluacion y ejecucion del codigo correspondiente mediante la inclusion de un archivo temporal con su contenido
*/
function PCO_EvaluarCodigoExterno($CodigoUnicoScript,$Silenciar)
    {
        global $PCO_ArchivoScript;
        
        //Determina si debe o no silenciar la salida de la ejecucion.  Cualquier valor silencia la salida
        $SilenciarSalida="No";
        if ($Silenciar!="") 
            $SilenciarSalida="Si";
    
        $ResultadoEvaluacionScript="";
        
        //Recupera detalles del script 
        $RegistroScript=PCO_EjecutarSQL("SELECT * FROM core_scripts WHERE codigo_script='$CodigoUnicoScript'")->fetch();
        if ($RegistroScript["id"]!="")
            {
                //Lleva estadística de ejecuciones 
                PCO_EjecutarSQLUnaria("UPDATE core_scripts SET ejecuciones=ejecuciones+1 WHERE codigo_script='$CodigoUnicoScript'");
    
                //Sin importar el lenguaje, reemplaza cualquier variable en notacion PHP sobre el script deseado dando asi compatibilidad al transporte de variables entre lenguajes
                $Script_CUERPO=PCO_ReemplazarVariablesPHPEnCadena($RegistroScript["cuerpo"]);
                $Script_LENGUAJE=trim($RegistroScript["lenguaje"]);
                $Script_MODOEJECUCION=trim($RegistroScript["modo_ejecucion"]);
                
                //Segun el lenguaje busca como ejecutarlo
                $RegistroLenguaje=PCO_EjecutarSQL("SELECT * FROM core_scripts_lenguajes WHERE nombre='$Script_LENGUAJE'")->fetch();
                $Lenguaje_CMD_COMPILACION=trim($RegistroLenguaje["comando_compilacion"]);
                $Lenguaje_CMD_EJECUCION=trim($RegistroLenguaje["comando_ejecucion"]);
                $Lenguaje_EXTENSIONES=trim($RegistroLenguaje["extensiones"]);
                $Lenguaje_PRIMERAEXTENSION=explode("|",$Lenguaje_EXTENSIONES);
                $Lenguaje_PRIMERAEXTENSION=$Lenguaje_PRIMERAEXTENSION[0];
                
                //Escapa las cadenas asociadas a compilacion y ejecucion
                //Advertencia: Si se va a permitir que datos provenientes del usuario son escapados para asegurarse que el usuario no intenta engañar al sistema para que ejecute comandos arbitrarios
                $Lenguaje_CMD_COMPILACION = escapeshellcmd($Lenguaje_CMD_COMPILACION);
                $Lenguaje_CMD_EJECUCION = escapeshellcmd($Lenguaje_CMD_EJECUCION);
                //Escapa espacios, en caso de estar corriendo un PHP bajo windows y donde el comando tenga espacios en su path
                $Lenguaje_CMD_COMPILACION = preg_replace('`(?<!^) `', '^ ', escapeshellcmd($Lenguaje_CMD_COMPILACION));
                $Lenguaje_CMD_EJECUCION = preg_replace('`(?<!^) `', '^ ', escapeshellcmd($Lenguaje_CMD_EJECUCION));

                //Valida que el lenguaje si este configurado para ejecutarse en el entorno actual
                if ($Lenguaje_CMD_EJECUCION!="")
                    {
                        //Crea un archivo temporal con el contenido del script
                    	$ArchivoInclusionTemporal=PCO_GenerarArchivoTemporal();
                    	$MetadatosArchivoCreado = stream_get_meta_data ( $ArchivoInclusionTemporal );
                    	$RutaArchivoTemporal = $MetadatosArchivoCreado ['uri'];

                        fwrite ( $ArchivoInclusionTemporal, $Script_CUERPO );

                        //Hace una copia del archivo temporal sobre la carpeta temporal del framework que se garantiza escritura para proceso de compilacion
                        $ArchivoAleatorio="PCOScript_".PCO_TextoAleatorio(20);
                        $RutaArchivoFuente = "tmp/practico_scripts/".$ArchivoAleatorio.".".$Lenguaje_PRIMERAEXTENSION;
                        @copy($RutaArchivoTemporal, $RutaArchivoFuente);

                        //Si el lenguaje esta configurado para ser compilado entonces hace proceso de compilacion
                        //TODO
                        if (trim($Lenguaje_CMD_COMPILACION)!="")
                            {
                                echo "Scripts externos compilados no disponibles en este sistema.";
                                /*
                                //Ejecuta reemplazo de variable PCO_ArchivoScript dentro de los compandos en caso que se requiera
                                $PCO_ArchivoScript=$RutaArchivoFuente; //Asigna ruta generada temporal a la variable para que sea reemplazada en el comando
                                $Lenguaje_CMD_COMPILACION=PCO_ReemplazarVariablesPHPEnCadena($Lenguaje_CMD_COMPILACION);

                                //Su ubica en el path de instalacion del Framework para correr desde alli los comandos de compilacion
                                chdir(getcwd()."/tmp/practico_scripts");
                                //echo system("cd ".getcwd()."/tmp"."; ".$Lenguaje_CMD_COMPILACION." ".$RutaArchivoFuente);
                                
                                //system("gcc -o {$ArchivoAleatorio}.out {$ArchivoAleatorio}.c ");
                                //system("./{$ArchivoAleatorio}.out");


                                $ResultadoCompilacion=system($Lenguaje_CMD_COMPILACION." ".$RutaArchivoFuente);

// echo "Temp=".$RutaArchivoTemporal;
// echo "Comp=".$RutaArchivoFuente;
// echo "CMD=".$Lenguaje_CMD_COMPILACION." ".$RutaArchivoFuente;
                                // $RutaArchivoTemporal=$RutaArchivoTemporal.".out";
                                // $Lenguaje_CMD_EJECUCION="./";
                                // $ResultadoEvaluacionScript=system($Lenguaje_CMD_EJECUCION." ".$RutaArchivoTemporal);

                                //Elimina archivo fuente copiado para compilacio
                                @unlink ($RutaArchivoFuente);
                                */
                            }

                    
                        //Ejecuta el script
                        try
                            {
                                //Ejecuta reemplazo de variable PCO_ArchivoScript dentro de los compandos en caso que se requiera
                                $PCO_ArchivoScript=$RutaArchivoTemporal; //Asigna ruta generada temporal a la variable para que sea reemplazada en el comando
                                $Lenguaje_CMD_EJECUCION=PCO_ReemplazarVariablesPHPEnCadena($Lenguaje_CMD_EJECUCION);

                                //TODO OPCIONAL: intentar la ejecucion del comando base para determinar su codigo de salida y posible error previamente

                                //Por ahora asume comando solo de ejecucion (lenguajes interpretados)
                                PCO_Auditar("{$PCOSESS_LoginUsuario} Ejecuta Script={$CodigoUnicoScript} Lenguaje={$Script_LENGUAJE} Modo={$Script_MODOEJECUCION} Comando={$Lenguaje_CMD_EJECUCION} Archivo={$RutaArchivoTemporal}","SQLog:admin");
                                if ($Script_MODOEJECUCION=="shell_exec")
                                    {
                                    	if (function_exists('shell_exec'))
                                            $ResultadoEvaluacionScript=shell_exec($Lenguaje_CMD_EJECUCION." ".$RutaArchivoTemporal);
                                        else
                                            echo "Su instalacion de PHP en el servidor no tiene soporte para la funcion shell_exec";
                                    }
                                if ($Script_MODOEJECUCION=="exec")
                                    {
                                        if (function_exists('exec'))
                                            $ResultadoEvaluacionScript=exec($Lenguaje_CMD_EJECUCION." ".$RutaArchivoTemporal);
                                        else
                                            echo "Su instalacion de PHP en el servidor no tiene soporte para la funcion exec";
                                    }
                                if ($Script_MODOEJECUCION=="system")
                                    {
                                        if (function_exists('system'))
                                            $ResultadoEvaluacionScript=system($Lenguaje_CMD_EJECUCION." ".$RutaArchivoTemporal);
                                        else
                                            echo "Su instalacion de PHP en el servidor no tiene soporte para la funcion system";
                                    }
                                if ($Script_MODOEJECUCION=="passthru")
                                    {
                                        if (function_exists('passthru'))
                                            $ResultadoEvaluacionScript=passthru($Lenguaje_CMD_EJECUCION." ".$RutaArchivoTemporal);
                                        else
                                            echo "Su instalacion de PHP en el servidor no tiene soporte para la funcion passthru";
                                    }
                            }
                        catch (Exception $e)
                            {
                                $MensajeErrorEjecucion="{$PCOSESS_LoginUsuario} Error de ejecucion Script={$CodigoUnicoScript} Lenguaje={$Script_LENGUAJE} Archivo={$RutaArchivoTemporal}: ".$e->getMessage();
                                echo $MensajeErrorEjecucion;
                                PCO_Auditar($MensajeErrorEjecucion,"SECLog:event");
                            }
                    
                        //Cierra el archivo de script y ademas lo elimina
                        fclose ( $ArchivoInclusionTemporal );
                    }
                else
                    {
                        PCO_Auditar("{$PCOSESS_LoginUsuario} Error Script={$CodigoUnicoScript} Lenguaje={$Script_LENGUAJE}: Entorno de ejecucion no configurado","SECLog:event");
                    }
            }
        else
            {
                PCO_Auditar("{$PCOSESS_LoginUsuario} Error Script={$CodigoUnicoScript} inexistente!","SECLog:event");
            }
    
        //Entrega salida de ejecucion del script (si se requiere)
        if ($SilenciarSalida=="No")
            echo($ResultadoEvaluacionScript);
        else
            echo "";
    }


########################################################################
########################################################################
/*
    Function: PCO_EjecutarCodigoPOST
	Evalua directamente el codigo asociado a la seccion POST de un formulario.  Esto permite llamados especificos a funciones encapsuladas que pueda contener un formulario asociado a su logica de negocio

	Variables de entrada:
	
		Formulario - Id unico del formulario del cual se desea evaluar el codigo POST
		Llave - Llave de paso que deberia coincidir con la llave del sistema para poder realizar la operacion
        ByPassDie - Determina si se debe o no evitar un llamado a la funcion die() de PHP.  Por defecto SIEMPRE se hace el llamado.  Asigne un valor diferente de cero (ej. 1) para evitarlo.
		Otros - Variables que puedan indicar la accion a realizar, los parametros requeridos o cualquier otro control de seguridad o verificacion requerida por el usuario

	Salida:
		Evaluacion y ejecucion del codigo

	Vea tambien:
	    <PCO_EjecutarPostFormulario>
*/
function PCO_EjecutarCodigoPOST($Formulario,$Llave,$ByPassDie=0)
    {
        global $LlaveDePaso,$TablasCore;
		if ($LlaveDePaso==$Llave && $Formulario!="")
		    {
    			// Busca el registro del formulario
    			$RegistroFormulario=PCO_EjecutarSQL("SELECT id,post_script,titulo FROM ".$TablasCore."formulario WHERE id=? ","$Formulario")->fetch();
    			//Si encuentra codigo lo ejecuta
                if ($RegistroFormulario["id"]!="")
                    {
                        PCO_EvaluarCodigo($RegistroFormulario["post_script"]);
                        //Lleva auditoria de la ejecucion
                        PCO_Auditar("Ejecucion post-accion formulario (Id={$Formulario}) ".PCO_ReemplazarVariablesPHPEnCadena($RegistroFormulario["titulo"]),"API.Practico");
                    }
		    }
		if ($ByPassDie==0)
            die(); //Finaliza ejecucion despues de cualquier evaluacion
    }


########################################################################
########################################################################
/*
    Function: PCO_OpenAI_CODEX
	Hace un llamado a la API de OpenAI, inicialmente modelo CODEX

	Variables de entrada:
	
		Modelo - Indica el modelo a utilizar, puede ser:
		         code-davinci-002
		         code-davinci-003
		         code-cushman-001
		         text-davinci-002
		Prompt - El texto con el cual se alimenta el modelo
		ConversacionPrevia - Una lista de historial de conversaciones util para el contexto en formato JSON. Ej: {"role": "assistant", "content": "Respuesta..."}
		

	Salida:
		Resultado de llamado a la API

	Vea tambien:
	    <PCO_EjecutarPostFormulario> <https://beta.openai.com/docs/models/codex>
*/
function PCO_OpenAI_CODEX($Modelo,$Prompt,$MaximoTokens,$Temperatura,$TokenParada,$ConversacionPrevia)
    {
        global $TablasCore;
        $RespuestaAPI="";
        
        //Si no define un modelo se usa el mas completo
        if ($Modelo=="") $Modelo="gpt-3.5-turbo";
        
        if ($MaximoTokens=="") $MaximoTokens="100";
        if ($Temperatura=="") $Temperatura="0.7";
        if ($ConversacionPrevia!="") $ConversacionPrevia.=",";

		$PCO_RegistroAPI_OpenAI=PCO_EjecutarSQL("SELECT api_openai,url_openai FROM ".$TablasCore."parametros WHERE 1=1 LIMIT 0,1")->fetch();
		$PCO_API_OpenAI=$PCO_RegistroAPI_OpenAI["api_openai"];
		$PCO_URL_OpenAI=$PCO_RegistroAPI_OpenAI["url_openai"];
		//Si encuentra un valor de API KEY sigue adelante
        if ($PCO_API_OpenAI!="")
            {
                if ($Prompt!="")
                    {
                        //La API puede ser usada para multiples cosas, aqui se establece para completación de chat solamente
                        $URLFinal=$PCO_URL_OpenAI."/v1/chat/completions";
        
                        $OpcionesCURL='{
                                            "CURLOPT_HEADER":0,
                                            "CURLOPT_RETURNTRANSFER":true,
                                            "CURLOPT_ENCODING":"",
                                            "CURLOPT_MAXREDIRS":10,
                                            "CURLOPT_TIMEOUT":0,
                                            "CURLOPT_FOLLOWLOCATION":true,
                                            "CURLOPT_HTTP_VERSION":"CURL_HTTP_VERSION_1_1",
                                            "CURLOPT_CUSTOMREQUEST":"POST"
                                        }';
                                        
                        $CabecerasCURL=array(
                                            "Content-Type: application/json",
                                            "Authorization: Bearer ".$PCO_API_OpenAI
                                        );
        
                        $PostCURL='
                                        {
                                            "model": "'.$Modelo.'",
                                            "max_tokens": '.$MaximoTokens.',
                                            "temperature": '.$Temperatura.',
                                            "n": 1,
                                            "stop": "'.$TokenParada.'",
                                            "messages": [
                                                {"role": "user", "content": "'.$Prompt.'"}
                                                '.$ConversacionPrevia.'
                                            ]
                                        }';
                                            /*
                                                //Las respuestas previas pueden ser enviadas de manera acumulativa para mantener el hilo de la conversacion
                                                {"role": "user", "content": "'.$Prompt.'"}
                                                {"role": "assistant", "content": "Respuesta..."},
                                            */
                        $RespuestaAPI=PCO_FileGetContents_CURL($URLFinal,$OpcionesCURL,$CabecerasCURL,$PostCURL);
                    }
                else
                    {
                        $RespuestaAPI='{"id":"Rta-LMQTP","object":"error.interno","created":000000,"model":"sin-modelo","usage":{"prompt_tokens":0,"completion_tokens":0,"total_tokens":0},"choices":[{"message":{"role":"assistant","content":"No se ha recibido un prompt de entrada"},"finish_reason":"error.api","index":0}]}';
                    }
            }
        else
            {
                $RespuestaAPI='{"id":"Rta-LMQTP","object":"error.interno","created":000000,"model":"sin-modelo","usage":{"prompt_tokens":0,"completion_tokens":0,"total_tokens":0},"choices":[{"message":{"role":"assistant","content":"Usted no cuenta con una llave API de OpenAI definida en Configuraci&oacute;n de Pr&aacute;ctico -> Parametros de aplicaci&oacute;n -> Conexiones Externas y APIs"},"finish_reason":"error.api","index":0}]}';
            }
        return $RespuestaAPI;
    }


########################################################################
########################################################################
/*
    Function: PCO_Minimizador_ObtenerSiguientePosicionMinimizacion
	Dado el arrglo de secuencias minimizadas, busca la siguiente posicion de secuencia que se debe revisar

	Salida:
		Posicion objetivo

	Vea tambien:
	    <PCO_Minimizador_OptimizarJS> <PCO_Minimizador_OptimizarCSS>
*/
$ArregloSecuenciasMinimizadas = array();
function PCO_Minimizador_ObtenerSiguientePosicionMinimizacion()
    {
        global $ArregloSecuenciasMinimizadas;
        return '<-!!-' . sizeof($ArregloSecuenciasMinimizadas) . '-!!->';
    }


abstract class PCO_Minimizador_BuscadorSecuenciasMinimizacion
    {
        public $IndiceInicial;
        public $IndiceFinal;
        public $Tipo;
        abstract protected function ObtenerPrimerValor($Cadena);
        
        public function isValid()
            {
                return $this->IndiceInicial !== false;
            }
    }


class BuscadorSecuenciasCadenas extends PCO_Minimizador_BuscadorSecuenciasMinimizacion
    {
        protected $DelimitadorInicial;
        protected $DelimitadorFinal;
        
        function __construct($DelimitadorInicial, $DelimitadorFinal)
            {
                $this->type = $DelimitadorInicial;
                $this->start_delimiter = $DelimitadorInicial;
                $this->end_delimiter = $DelimitadorFinal;
            }
            
        public function ObtenerPrimerValor($Cadena)
            {
                $this->IndiceInicial = strpos($Cadena, $this->start_delimiter);
                if ($this->isValid())
                    {
                        $this->IndiceFinal = strpos($Cadena, $this->end_delimiter, $this->IndiceInicial+1);
                        // sanity check for non well formed lines
                        $this->IndiceFinal = ($this->IndiceFinal === false ? strlen($Cadena) :
                        $this->IndiceFinal + strlen($this->end_delimiter));
                    }
            }
    }


class PCO_Minimizador_BuscadorSecuenciasCadenas extends PCO_Minimizador_BuscadorSecuenciasMinimizacion
    {
        function __construct($Tipo)
            {
                $this->type = $Tipo;
            }
            
        public function ObtenerPrimerValor($Cadena)
            {
                $this->IndiceInicial = strpos($Cadena, $this->type);
                if ($this->isValid())
                    {
                        // busque la primera comilla final que no haya escapado
                        $this->IndiceFinal = $this->IndiceInicial+1;
                        while ($this->IndiceFinal < strlen($Cadena))
                            {
                                // encontrar el número de escapes antes de la comilla final
                                if (preg_match('/(\\\\*)(' . preg_quote($this->type) . ')/', $Cadena, $ArregloEncontrados, PREG_OFFSET_CAPTURE, $this->IndiceFinal))
                                    {
                                        $this->IndiceFinal = $ArregloEncontrados[2][1] + 1;
                                        // si un número impar de escapes antes de comilla, la comilla se escapa. Sigue adelante
                                        if (!isset($ArregloEncontrados[1][0]) || strlen($ArregloEncontrados[1][0]) % 2 == 0)
                                            {
                                                return;
                                            }
                                    }
                                else
                                    {
                                        // no match, not well formed
                                        $this->IndiceFinal = strlen($Cadena);
                                        return;
                                    }
                            }
                    }
            }
    }


function PCO_Minimizador_ObtenerSiguienteSecuenciaEspecial($Cadena, $Secuencias)
    {
        // $ArregloIndices es una matriz del índice más cercano para todos los caracteres especiales
        $ArregloIndices = array();
        foreach ($Secuencias as $Buscador)
            {
                $Buscador->ObtenerPrimerValor($Cadena);
                if ($Buscador->isValid())
                    {
                        $ArregloIndices[$Buscador->IndiceInicial] = $Buscador;
                    }
            }
        // Si no encuentra ninguno retorna
        if (count($ArregloIndices) == 0) {return false;}
        // Otiene el primer item que coincida
        asort($ArregloIndices);
        return $ArregloIndices[min(array_keys($ArregloIndices))];
    }


class PCO_Minimizador_BuscadorSecuenciasExpRegularesJS extends PCO_Minimizador_BuscadorSecuenciasMinimizacion
    {
        function __construct()
            {
                $this->type = 'regex';
            }
        
        // verifica que este no sea el comienzo de un comentario o una división
        public function BuscarPosibleInicio($Cadena, $Indice = 0)
            {
                $IndiceInicial = strpos($Cadena, '/', $Indice);
                if ($IndiceInicial === false)
                    {
                        return false;
                    }
                if (substr($Cadena, $IndiceInicial, 2) === '//' || substr($Cadena, $IndiceInicial, 2) === '/*')
                    {
                        // comentario encontrado, no patrón, no se moleste en continuar
                        return false;
                    }
                $IndiceTemporal = $IndiceInicial - 1;
                // obtener el primer carácter anterior no espacial
                while ($IndiceTemporal > 0 && substr($Cadena, $IndiceTemporal, 1) == ' ') {$IndiceTemporal--;}
                if ($IndiceTemporal > 0)
                    {
                        $Caracter = substr($Cadena, $IndiceTemporal, 1);
                        // si el carácter o el número es una división, ve más lejos
                        if (is_numeric($Caracter) || ctype_alpha($Caracter) || $Caracter == ')' || $Caracter == ']')
                            {
                                return $this->BuscarPosibleInicio($Cadena, $IndiceInicial + 1);
                            }
                    }
                return $IndiceInicial;
            }
            
        public function ObtenerPrimerValor($Cadena)
            {
                $this->IndiceInicial = $this->BuscarPosibleInicio($Cadena);
                if ($this->IndiceInicial === false)
                    {
                        return;
                    }
                // position of first newline after pattern
                $NuevaLinea = strpos($Cadena, "\n", $this->IndiceInicial);
                // look for first non escaped endquote
                $IndiceFinal = $this->IndiceInicial+1;
                while ($IndiceFinal < strlen($Cadena)
                // if there's still room to explore in the string
                && ($NuevaLinea === false || $IndiceFinal < $NuevaLinea)) // and we're not at a newline yet
                    {
                        // find number of escapes before endquote
                        if (preg_match('/(\\\\*)(\/)/', $Cadena, $ArregloEncontrados, PREG_OFFSET_CAPTURE, $IndiceFinal))
                                {
                                    $IndiceFinal = $ArregloEncontrados[2][1] + 1;
                                    // if odd number of escapes before endquote, endquote is escaped. Keep going
                                    if (!isset($ArregloEncontrados[1][0]) || strlen($ArregloEncontrados[1][0]) % 2 == 0)
                                        {
                                            if ($NuevaLinea !== false && $IndiceFinal > $NuevaLinea) {return false;}
                                            $this->IndiceFinal = $IndiceFinal;
                                            return;
                                        }
                                    // no coincide o no esta bien formado el codigo
                                }
                            else
                                {
                                    $this->IndiceInicial = false;
                                    return;
                                }
                    }
            }
    }


########################################################################
########################################################################
/*
    Function: PCO_Minimizador_OptimizarCSS
	Toma un codigo CSS y lo miniminiza antes de ser publicado en produccion ayudando a disminuir tiempos de transferencia

	Salida:
		Codigo CSS equivalente pero minimizado

	Vea tambien:
		<PCO_CargarFormulario> <PCO_Minimizador_OptimizarJS>
*/
$BuscadorSecuenciasComillaSimple = new PCO_Minimizador_BuscadorSecuenciasCadenas('\'');
$BuscadorSecuenciasComillaDoble = new PCO_Minimizador_BuscadorSecuenciasCadenas('"');
$BuscadorComentariosDeBloque = new BuscadorSecuenciasCadenas('/*', '*/');
function PCO_Minimizador_OptimizarCSS($CodigoCSS)
    {
        global $ArregloSecuenciasMinimizadas, $BuscadorSecuenciasComillaSimple, $BuscadorSecuenciasComillaDoble, $BuscadorComentariosDeBloque;
        $CaracteresEspecialesCSS = array($BuscadorComentariosDeBloque, // Comentario CSS
            $BuscadorSecuenciasComillaSimple, // Comilla simple de escape, ej :before{ content: '-';}
            $BuscadorSecuenciasComillaDoble); // Comilla doble
        // Elimina todo lo que haya que ser eliminado y conserva el resto
        while ($Secuencia = PCO_Minimizador_ObtenerSiguienteSecuenciaEspecial($CodigoCSS, $CaracteresEspecialesCSS))
            {
                switch ($Secuencia->type)
                    {
                        case '/*': // Elimina comentarios
                            $CodigoCSS = substr($CodigoCSS, 0, $Secuencia->IndiceInicial) . substr($CodigoCSS, $Secuencia->IndiceFinal);
                            break;
                        default: // Cadenas que deben ser conservadas
                            $Posicion = PCO_Minimizador_ObtenerSiguientePosicionMinimizacion();
                            $ArregloSecuenciasMinimizadas[$Posicion] = substr($CodigoCSS, $Secuencia->IndiceInicial, $Secuencia->IndiceFinal - $Secuencia->IndiceInicial);
                            $CodigoCSS = substr($CodigoCSS, 0, $Secuencia->IndiceInicial) . $Posicion . substr($CodigoCSS, $Secuencia->IndiceFinal);
                    }
            }
        // minimiza la cadena
        $CodigoCSS = preg_replace('/\s{2,}/s', ' ', $CodigoCSS);
        $CodigoCSS = preg_replace('/\s*([:;{}])\s*/', '$1', $CodigoCSS);
        $CodigoCSS = preg_replace('/;}/', '}', $CodigoCSS);
        // devuelve las cadenas que se deben conservar
        foreach($ArregloSecuenciasMinimizadas as $Posicion => $Original)
            {
                $CodigoCSS = str_replace($Posicion, $Original, $CodigoCSS);
            }
        return trim($CodigoCSS);
    }


########################################################################
########################################################################
/*
    Function: PCO_Minimizador_OptimizarJS
	Toma un codigo JS y lo miniminiza antes de ser publicado en produccion ayudando a disminuir tiempos de transferencia y ocultando en parte alguna logica de negocio

	Salida:
		Codigo JS equivalente pero minimizado

	Vea tambien:
		<PCO_CargarFormulario> <PCO_Minimizador_OptimizarCSS>
*/
$BuscadorLineasComentarios = new BuscadorSecuenciasCadenas('//', "\n");
function PCO_Minimizador_OptimizarJS($CodigoJS)
    {
        global $ArregloSecuenciasMinimizadas, $BuscadorSecuenciasComillaSimple, $BuscadorSecuenciasComillaDoble,
        $BuscadorComentariosDeBloque, $BuscadorLineasComentarios;
        $CaracteresEspecialesJava = array($BuscadorComentariosDeBloque, // Comentario de bloques JavaScript
                $BuscadorLineasComentarios, // Comentario de lineas JavaScript
                $BuscadorSecuenciasComillaSimple, // Comilla simple, ej :before{ content: '-';}
                $BuscadorSecuenciasComillaDoble, // Comilla doble
                new PCO_Minimizador_BuscadorSecuenciasExpRegularesJS() // Expresion regular JavaScript
            );
        // Elimina todo lo que haya que ser eliminado y conserva el resto
        while ($Secuencia = PCO_Minimizador_ObtenerSiguienteSecuenciaEspecial($CodigoJS, $CaracteresEspecialesJava))
            {
                switch ($Secuencia->type)
                    {
                        case '/*':
                        case '//':// Elimina comentarios
                            $CodigoJS = substr($CodigoJS, 0, $Secuencia->IndiceInicial) . substr($CodigoJS, $Secuencia->IndiceFinal);
                            break;
                        default: // Cadenas con comillas o expresiones regulares que deben ser conservadas
                            $IndiceInicial = $Secuencia->IndiceInicial;
                            $IndiceFinal = $Secuencia->IndiceFinal;
                            $Posicion = PCO_Minimizador_ObtenerSiguientePosicionMinimizacion();
                            $ArregloSecuenciasMinimizadas[$Posicion] =substr($CodigoJS, $IndiceInicial, $IndiceFinal - $IndiceInicial);
                            $CodigoJS = substr($CodigoJS, 0, $IndiceInicial) . $Posicion . substr($CodigoJS, $IndiceFinal);
                    }
            }
        // Caso especial donde el + indica tratar la variable como numérica, p. ej. a = b + + c
        $CodigoJS = preg_replace('/([-\+])\s+\+([^\s;]*)/', '$1 (+$2)', $CodigoJS);
        // Condensar (unir) espacios
        $CodigoJS = preg_replace("/\s*\n\s*/", "\n", $CodigoJS);
        // Espacios alrededor de nuevas lineas
        $CodigoJS = preg_replace("/\h+/", " ", $CodigoJS); // \h+ horizontal white space
        // Remueve espacios horizontales innecesarios cerca a no variables (alfanumericos, underscore, signo pesos)
        $CodigoJS = preg_replace("/\h([^A-Za-z0-9\_\$])/", '$1', $CodigoJS);
        $CodigoJS = preg_replace("/([^A-Za-z0-9\_\$])\h/", '$1', $CodigoJS);
        // Eliminar los espacios innecesarios entre corchetes y paréntesis
        $CodigoJS = preg_replace("/\s?([\(\[{])\s?/", '$1', $CodigoJS);
        $CodigoJS = preg_replace("/\s([\)\]}])/", '$1', $CodigoJS);
        // Eliminar espacios innecesarios alrededor de los operadores que no necesitan ningún espacio (específicamente nuevas líneas)
        $CodigoJS = preg_replace("/\s?([\.=:\-+,])\s?/", '$1', $CodigoJS);
        // Caracteres innecesarios
        $CodigoJS = preg_replace("/;\n/", ";", $CodigoJS); // punto y coma antes de una nueva linea
        $CodigoJS = preg_replace('/;}/', '}', $CodigoJS); // punto y coma antes del corchete final
        // Volver a poner las cadenas conservadas
        foreach($ArregloSecuenciasMinimizadas as $Posicion => $Original)
            {
                $CodigoJS = str_replace($Posicion, $Original, $CodigoJS);
            }
        return trim($CodigoJS);
    }


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_SAML_CrearUsuario
	Agrega usuarios de manera automatica cuando son autenticados por SAML
*/
	function PCO_SAML_CrearUsuario($login_chk='',$nombre_chk='',$correo_chk='',$interno_chk=0,$plantilla_permisos_chk='')
		{
			global $TablasCore,$LlaveDePaso,$PCO_FechaOperacion,$ListaCamposSinID_usuario;
			// Inserta datos del usuario
			$clavemd5=MD5(PCO_TextoAleatorio(20));
			$pasomd5=MD5($LlaveDePaso);
			$descripcion="Auth:SAML";
			//Agrega el registro de usuario si aun no existe
			if (!PCO_ExisteValor($TablasCore."usuario","login",$login_chk))
				{
					@PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."usuario (login,clave,nombre,estado,correo,ultimo_acceso,llave_paso,usuario_interno,plantilla_permisos,descripcion) VALUES ('$login_chk','$clavemd5','$nombre_chk',1,'$correo_chk','$PCO_FechaOperacion','$pasomd5','$interno_chk','$plantilla_permisos_chk','$descripcion')");
					PCO_Auditar("OAuth:Agregado usuario $login_chk para SAML");
				}
		}


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_SAML_EjecutarLogin
	Recibe los parametros necesarios para hacer el registro de un usuario en la plataforma durante su ingreso cuando se usa oauth
	
	Variables de entrada:

		accion - Accion a ser ejectudada, de la que se desea buscar permiso heredado por otra

	Salida:
		Variables de sesion registradas
		Redireccion del usuario al menu
*/
	function PCO_SAML_EjecutarLogin($login_chk)
		{
			global $TablasCore,$uid,$ListaCamposSinID_usuario,$ListaCamposSinID_parametros,$ListaCamposSinID_parametros,$ListaCamposSinID_auditoria,$PCO_DireccionAuditoria,$PCO_HoraOperacion,$PCO_FechaOperacion,$ArchivoCORE;
			$nombre_chk=$login_chk;
			$correo_chk="";
            $plantilla_origen_permisos=PCO_EjecutarSQL("SELECT usuario_plantilla FROM core_samlconector WHERE activado='S' ORDER BY nombre_conector LIMIT 0,1 ")->fetchColumn();

			// Busca datos del usuario Practico, segun tipo de servicio OAuth para tener configuraciones de permisos y parametros propios de la herramienta
			$consulta_busqueda_usuario_oauth="SELECT $ListaCamposSinID_usuario FROM ".$TablasCore."usuario WHERE login='$login_chk' AND descripcion LIKE '%Auth:$OAuth_servicio%' ";
			$registro=PCO_EjecutarSQL($consulta_busqueda_usuario_oauth)->fetch();

			// Agrega el usuario cuando es primer login desde el servicio
			if ($registro["login"]=="")
				{
					PCO_SAML_CrearUsuario($login_chk,$nombre_chk,$correo_chk,1,$plantilla_origen_permisos);
					// Actualiza el registro desde nueva consulta
					$registro=PCO_EjecutarSQL($consulta_busqueda_usuario_oauth)->fetch();
				}

			//Copia permisos de la plantilla si aplica
			if ($registro["plantilla_permisos"]!="")
				{
					PCO_Auditar("Carga permisos a su perfil desde plantilla ".$registro["plantilla_permisos"],$login_chk);
					PCO_CopiarPermisos($registro["plantilla_permisos"],$login_chk);
					PCO_CopiarInformes($registro["plantilla_permisos"],$login_chk);
				}

			// Se buscan datos de la aplicacion
			$consulta_parametros=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_parametros." FROM ".$TablasCore."parametros");
			$registro_parametros = $consulta_parametros->fetch();

			// Actualiza las variables de sesion con el registro
			$PCOSESS_SesionAbierta=1;
			// Actualiza booleana de ingreso
			$clave_correcta=1;
			// Registro de variables en la sesion
			@session_start();
			if (!isset($_SESSION["PCOSESS_LoginUsuario"])) $_SESSION["PCOSESS_LoginUsuario"]=(string)$registro["login"];
			if (!isset($_SESSION["username"])) $_SESSION["username"]=(string)$registro["login"]; //Usada para el modulo de chat
			if (!isset($_SESSION["Nombre_usuario"])) $_SESSION["Nombre_usuario"]=(string)$registro["nombre"];
			if (!isset($_SESSION["Descripcion_usuario"])) $_SESSION["Descripcion_usuario"]=(string)$registro["descripcion"];
			if (!isset($_SESSION["Nivel_usuario"])) $_SESSION["Nivel_usuario"]=(string)$registro["nivel"];
			if (!isset($_SESSION["Correo_usuario"])) $_SESSION["Correo_usuario"]=(string)$registro["correo"];
			if (!isset($_SESSION["Clave_usuario"])) $_SESSION["Clave_usuario"]=$registro["clave"];
			if (!isset($_SESSION["LlaveDePasoUsuario"])) $_SESSION["LlaveDePasoUsuario"]=$registro["llave_paso"];
			if (!isset($_SESSION["PCOSESS_SesionAbierta"])) $_SESSION["PCOSESS_SesionAbierta"]=$PCOSESS_SesionAbierta;
			if (!isset($_SESSION["clave_correcta"])) $_SESSION["clave_correcta"]=$clave_correcta;
			if (!isset($_SESSION["Nombre_Empresa_Corto"])) $_SESSION["Nombre_Empresa_Corto"]=$registro_parametros["nombre_empresa_corto"];
			if (!isset($_SESSION["Nombre_Aplicacion"])) $_SESSION["Nombre_Aplicacion"]=$registro_parametros["nombre_aplicacion"];
			if (!isset($_SESSION["Version_Aplicacion"])) $_SESSION["Version_Aplicacion"]=$registro_parametros["version"];

			// Lleva a auditoria con query manual por la falta de $PCOSESS_LoginUsuario
			PCO_Auditar("Ingresa al sistema desde $PCO_DireccionAuditoria",$_SESSION["PCOSESS_LoginUsuario"]);
			// Actualiza fecha del ultimo ingreso para el usuario
			PCO_EjecutarSQLUnaria("UPDATE ".$TablasCore."usuario SET ultimo_acceso='$PCO_FechaOperacion' WHERE login='".$registro["login"]."'");

			// Redirecciona al menu
			header("Location: ../../../index.php");
			exit();
		}


########################################################################
########################################################################
/*
    Function: PCO_GenerarNombreAdjunto
	Busca ocurrencias de las cadenas de formato de nombre de un archivo adjunto y las reemplaza por los valores correspondientes

	Salida:

		Nombre final del path del archivo adjunto

	Vea tambien:

		<PCO_GuardarDatosFormulario> | <PCO_ActualizarDatosFormulario>
*/
function PCO_GenerarNombreAdjunto($nombre_archivo,$campo_tabla,$extension_archivo,$path_final_archivo)
{
    global $PCO_FechaOperacion,$PCO_HoraOperacion,$PCOSESS_LoginUsuario;

    $valores_buscar_rem_array = array
        (
              array("_ORIGINAL_",$nombre_archivo),
              array("_CAMPOTABLA_",$campo_tabla),
              array("_FECHA_",$PCO_FechaOperacion),
              array("_HORA_",$PCO_HoraOperacion),
              array("_HORAINTERNET_",date('B')),
              array("_USUARIO_",$PCOSESS_LoginUsuario),
              array("_MICRO_",date('u')),
              array("_EXTENSION_",$extension_archivo)
        );

    foreach ($valores_buscar_rem_array as $valores_buscar_rem) {

        if (strpos($path_final_archivo,$valores_buscar_rem[0])!==FALSE) $path_final_archivo=str_replace($valores_buscar_rem[0], $valores_buscar_rem[1], $path_final_archivo); // Booleana requiere === o !==
    }

	return $path_final_archivo;
}



########################################################################
########################################################################
/*
    Function: PCO_AgregarFaroAnalytics
    Agrega el codigo HTML y JS necesario para activar los faros de Google Analytics cuando asi se desea
    
	Salida:
		Funciones requeridas para la adcion del faro al final de la pagina
*/
function PCO_AgregarFaroAnalytics()
    {
        global $PCO_Accion,$TablasCore,$CodigoGoogleAnalytics;
        $PosfijoGA=$_SERVER['SERVER_NAME'].'/ACT/'.$PCO_Accion.'/SCR'.$_SERVER['PHP_SELF'];
        $RegistroParam=PCO_EjecutarSQL("SELECT nombre_empresa_corto,nombre_aplicacion FROM {$TablasCore}parametros LIMIT 0,1")->fetch();
        $InfoAppGA=$RegistroParam["nombre_empresa_corto"]." - ".$RegistroParam["nombre_aplicacion"];
        // Este valor indica un ID generico de GA UA-847800-9 No edite esta linea sobre el codigo
        // Para validar que su ID es diferente al generico de seguimiento.  En lugar de esto cambie
        // su valor a traves del panel de configuracion de Practico con el entregado como ID de GoogleAnalytics
        $TagsGA[]=base64_decode("VUEtODQ3ODAwLTk=");
        if ($CodigoGoogleAnalytics!="" && $CodigoGoogleAnalytics!="UA-847800-9") $TagsGA[]=$CodigoGoogleAnalytics;
        //Global site tag (gtag.js) - Google Analytics
        foreach ($TagsGA as $EtiquetaGA)
            {
                echo "<script async src='https://www.googletagmanager.com/gtag/js?id={$EtiquetaGA}'></script>
                    <script>
                      window.dataLayer = window.dataLayer || [];
                      function gtag(){dataLayer.push(arguments);}
                      gtag('js', new Date());
                      gtag('config', '{$EtiquetaGA}',
                            {
                                'transport_type': 'beacon',
                                'page_title': '{$InfoAppGA}',
                                'page_path': '{$PosfijoGA}',
                            }
                      );
                    </script>";                
            }
    }


########################################################################
########################################################################
/*
	Function: PCO_GenerarArchivoTemporal
	Verifica disponibilidad de funciones internas de PHP o genera funcion propia para crear archivos temporales en modo W+

	Salida:
		Gestor de archivo o descriptor de archivo creado similar al retornado por tmpfile o fopen del que se puede extraer luego el puntero, URI o demas datos
*/
function PCO_GenerarArchivoTemporal()
{
	if (function_exists('tmpfile'))
		$DescriptorArchivo = tmpfile();
	else
		{		
            try
                {
                    $RutaArchivoTemporal=sys_get_temp_dir().DIRECTORY_SEPARATOR."PCO_TempFile_".PCO_TextoAleatorio(30);
			        $DescriptorArchivo=fopen($RutaArchivoTemporal, "w+");	
                }
            catch (Exception $e)
                {
                    try
                        {
                            $RutaArchivoTemporal="tmp/PCO_TempFile_".PCO_TextoAleatorio(30);
                			$DescriptorArchivo=fopen($RutaArchivoTemporal, "w+");	
                        }
                    catch (Exception $e)
                        {
                            $DescriptorArchivo=null;
                        }
                }
		}
    return $DescriptorArchivo;
}


########################################################################
########################################################################
/*
	Function: PCO_EvaluarCodigo
	Ejecuta codigo PHP recibido dentro de una cadena.  Reemplazo para la funcion eval que pasa a ser obsoleta por seguridad

	Variables de entrada:

		CadenaCodigoPHP - Cadena con todo el codigo a evaluar TIENE que comenzar con el tag <?php si se desea interpretar

	Salida:
		Evaluacion y ejecucion del codigo correspondiente mediante la inclusion de un archivo temporal con su contenido
*/
function PCO_EvaluarCodigo($CadenaCodigoPHP,$ByPassSintaxis=0,$DescComplemento="",$EvitarInclusionSoloRevisar=0)
{
    global $PCO_ChequeoDinamicoSintaxis;

	$ArchivoInclusionTemporal=PCO_GenerarArchivoTemporal();
	$MetadatosArchivoCreado = stream_get_meta_data ( $ArchivoInclusionTemporal );
	$RutaArchivoTemporal = $MetadatosArchivoCreado ['uri'];
		
    fwrite ( $ArchivoInclusionTemporal, $CadenaCodigoPHP );

    //Busca si se tienen errores o no para saber si incluye el archivo 
    $ErroresSintaxis=0;
    if ($PCO_ChequeoDinamicoSintaxis==1 || $ByPassSintaxis==1)
        $ErroresSintaxis=PCO_BuscarErroresSintaxisPHP($RutaArchivoTemporal,1,$DescComplemento);
    if ($ErroresSintaxis==0 && $EvitarInclusionSoloRevisar==0)
        {
            try
                {
                    $ResultadoInclusion = include ($RutaArchivoTemporal);
                }
            catch (Exception $e)
                {
                    echo "Se ha detectado un error durante la inclusion del archivo {$RutaArchivoTemporal}: ",  $e->getMessage();
                }
        }
    fclose ( $ArchivoInclusionTemporal );
    @unlink ($RutaArchivoTemporal);
    return $ResultadoInclusion;
}


########################################################################
########################################################################
/*
	Function: PCO_ImprimirOpcionMenu
	Imprime en pantalla una opcion de menu, de acuerdo a su configuracion recibida en el registro y la ubicacion definida.

	Variables de entrada:

		RegistroOpcion - Registro completo de la opcion de menu
		Ubicacion - Ubicacion sobre la cual se desea ubicar la opcion y que obedece a las mismas disponibles cuando esta es creada. Posibilidades: [arriba,escritorio,centro,lateral,formulario]

	Salida:
		Impresion del codigo HTML correspondiente
*/
function PCO_ImprimirOpcionMenu($RegistroOpcion,$Ubicacion='',$PreUbicacion='')
    {
        global $ArchivoCORE,$PCOSESS_LoginUsuario,$TablasCore;

        //Verifica si se trata de una opcion simple o de una agrupadora.  Si es agrupadora recorre sus opciones hijas
        if ($RegistroOpcion['tipo_menu']=='grp')
			{
    			// Si el usuario es diferente al administrador agrega condiciones al query
    			if (!PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && $Ubicacion!='formulario')
    				{
    					$Complemento_tablas=",".$TablasCore."usuario_menu";
    					$Complemento_condicion=" AND ".$TablasCore."usuario_menu.menu=".$TablasCore."menu.hash_unico AND ".$TablasCore."usuario_menu.usuario='$PCOSESS_LoginUsuario'";  // AND nivel>0
    				}

    			if ($Ubicacion=='formulario')
    				$Complemento_condicion=" AND ".$TablasCore."menu.formulario_vinculado=".$RegistroOpcion["formulario_vinculado"]."";  // AND nivel>0

    			if ($Ubicacion=='lateral')
    				$Complemento_AnchoLateral=' style="width: 100%; font-size:0.95em;" ';  // Agrega porcentaje de 100% ancho a las opciones laterales

    			$ResultadoOpcionesAnidadas=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."menu ".@$Complemento_tablas." WHERE padre='".$RegistroOpcion['hash_unico']."' ".@$Complemento_condicion." ORDER BY peso");
    			$CadenaPreOpcion='
                    <div class="btn-group" '.$Complemento_AnchoLateral.'>
                      <button type="button" '.$Complemento_AnchoLateral.' class="btn dropdown-toggle '.$RegistroOpcion["clase_contenedor"].' " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div align=left>
                            <i class="'.$RegistroOpcion["imagen"].' fa-fw"></i> '.PCO_ReemplazarVariablesPHPEnCadena($RegistroOpcion["texto"]).' <span class="caret"></span>
                        </div>
                      </button>
                      <ul class="dropdown-menu">';
                $CadenaPosOpcion='
                      </ul>
                    </div>';

    			//Si la posicion es un formulario cambia el estilo de presentacion del grupo
    			if ($Ubicacion=="formulario")
    			    {
            			$CadenaPreOpcion='
                            <div class="btn-group">
                              <li class="btn dropdown-toggle '.$RegistroOpcion["clase_contenedor"].' " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="'.$RegistroOpcion["imagen"].' fa-fw"></i> '.PCO_ReemplazarVariablesPHPEnCadena($RegistroOpcion["texto"]).' <span class="caret"></span>
                              </li>
                              <ul class="dropdown-menu">';
                        $CadenaPosOpcion='
                              </ul>
                            </div>';
    			    }

    			//Crea el elemento para dropdown con las opciones
                echo $CadenaPreOpcion;
                        // Imprime las opciones con sus formularios
                        while($RegistroOpcionAnidada = $ResultadoOpcionesAnidadas->fetch())
                        	PCO_ImprimirOpcionMenu($RegistroOpcionAnidada,'submenu',$Ubicacion);
                echo $CadenaPosOpcion;
			}

        //Genera el formulario que sera llamado en la opcion de menu
		echo '<form action="'.$ArchivoCORE.'" method="post" name="'.$PreUbicacion.'_'.$Ubicacion.'_'.$RegistroOpcion["id"].'" id="'.$PreUbicacion.'_'.$Ubicacion.'_'.$RegistroOpcion["id"].'" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">';
		// Verifica si se trata de un comando interno o personal y crea formulario y enlace correspondiente (ambos funcionan igual)
		if ($RegistroOpcion["tipo_comando"]=="Interno" || $RegistroOpcion["tipo_comando"]=="Personal")
            echo '<input type="hidden" name="PCO_Accion" value="'.$RegistroOpcion["comando"].'">';
		// Verifica si se trata de una opcion para cargar un objeto de practico
		if ($RegistroOpcion["tipo_comando"]=="Objeto")
			echo'<input type="hidden" name="PCO_Accion" value="PCO_CargarObjeto"><input type="hidden" name="PCO_Objeto" value="'.$RegistroOpcion["comando"].'">';
		echo '</form>';

        //Define la cadena a imprimir como accion para el menu
        $CadenaPreOpcion='';
        $CadenaPosOpcion='</a>';
		//Si tiene una URL trata la opcion como enlace estandar, sino como opcion de menu especial
		if ($RegistroOpcion["url"]!="")
		    {
		        if ($Ubicacion=='submenu' || $Ubicacion=='usuario')
		        	$CadenaPreOpcion= '<a href="'.PCO_ReemplazarVariablesPHPEnCadena($RegistroOpcion["url"]).'" target="'.$RegistroOpcion["destino"].'"><i class="'.$RegistroOpcion["imagen"].' fa-fw"></i> '.PCO_ReemplazarVariablesPHPEnCadena($RegistroOpcion["texto"]);
		        else
		        	$CadenaPreOpcion= '<a title="'.PCO_ReemplazarVariablesPHPEnCadena($RegistroOpcion["texto"]).'" href="'.PCO_ReemplazarVariablesPHPEnCadena($RegistroOpcion["url"]).'" target="'.$RegistroOpcion["destino"].'">';
		    }
		else
			{
			    if ($Ubicacion=='arriba' || $Ubicacion=='lateral')
                    $CadenaPreOpcion= '<a href="javascript:document.'.$PreUbicacion.'_'.$Ubicacion.'_'.$RegistroOpcion["id"].'.submit();">';
			    if ($Ubicacion=='centro' || $Ubicacion=='escritorio' || $Ubicacion=='formulario')
			        $CadenaPreOpcion= '<a title="'.PCO_ReemplazarVariablesPHPEnCadena($RegistroOpcion["texto"]).'" href="javascript:document.'.$PreUbicacion.'_'.$Ubicacion.'_'.$RegistroOpcion["id"].'.submit();">';
			    if ($Ubicacion=='submenu' || $Ubicacion=='usuario')
			        $CadenaPreOpcion= '<a href="javascript:document.'.$PreUbicacion.'_'.$Ubicacion.'_'.$RegistroOpcion["id"].'.submit();"><i class="'.$RegistroOpcion["imagen"].' fa-fw"></i> '.PCO_ReemplazarVariablesPHPEnCadena($RegistroOpcion["texto"]).' '.$TextoAccesoDirecto;
			}

        //Imprime opciones de submenus
		if ($RegistroOpcion['tipo_menu']=='opc' && $Ubicacion=="submenu")
			{

			    //Define el texto a ubicar al lado derecho de la opcion cuando se ha indicadu su valor de acceso directo
			    $TextoAccesoDirecto='<span class="pull-right text-muted small"><i>Ctrl+O</i></span>';
			    $TextoAccesoDirecto='';

			    //Si la imagen definida para el menu es la palabra clave _SEPARADOR_ entonces lo trata como tal, en caso contrario presenta la opcion
			    if ($RegistroOpcion["imagen"]=="_SEPARADOR_")
			        echo '<li role="separator" class="divider"></li>';
			    else
			        {
        			    //Imprime el item de menu
        				echo '<li class="'.$RegistroOpcion["clase_contenedor"].'">';
        				echo $CadenaPreOpcion;
        				echo $CadenaInOpcion;
        				echo $CadenaPosOpcion;
                        echo '</li>';
			        }
			}

        //Imprime opciones estandar de menu
		if ($RegistroOpcion['tipo_menu']=='opc' && $Ubicacion!="submenu")
			{
        		//Determina si la opcion es una imagen o no
        		$PCO_EsImagen=0;
        		if (strpos($RegistroOpcion["imagen"],".png") || strpos($RegistroOpcion["imagen"],".jpg") || strpos($RegistroOpcion["imagen"],".gif"))
        			$PCO_EsImagen=1;

        		//Si no detecta ninguna extension de archivo de imagen entonces agrega codigo en bootstrap para representarla
        		$CadenaInOpcion='';
        		if (!$PCO_EsImagen)
        			{
        			    if ($Ubicacion=='arriba')
                            $CadenaInOpcion= '<button class="btn-circle btn-info btn-xs"><i class="'.$RegistroOpcion["imagen"].'"></i></button> '.PCO_ReemplazarVariablesPHPEnCadena($RegistroOpcion["texto"]);
        			    if ($Ubicacion=='centro')
                            $CadenaInOpcion= '<button type="button" class="btn btn-default btn-outline"><i class="'.$RegistroOpcion["imagen"].' fa-fw"></i><span class="btn-xs">'.PCO_ReemplazarVariablesPHPEnCadena($RegistroOpcion["texto"]).'</span></button>';
        			    if ($Ubicacion=='formulario')
                            $CadenaInOpcion= '<ul type="button" class="btn '.$RegistroOpcion["clase_contenedor"].'"><i class="'.$RegistroOpcion["imagen"].' fa-fw"></i><span>'.PCO_ReemplazarVariablesPHPEnCadena($RegistroOpcion["texto"]).'</span></ul>';
        			    if ($Ubicacion=='escritorio')
                            $CadenaInOpcion= '<button style="margin-left:7px;margin-bottom:7px;" class="btn btn-default"><i class="'.$RegistroOpcion["imagen"].' fa-3x fa-fw"></i><br><span class="btn-xs">'.PCO_ReemplazarVariablesPHPEnCadena($RegistroOpcion["texto"]).'</span></button>';
        			    if ($Ubicacion=='lateral')
                            $CadenaInOpcion= '<i class="'.$RegistroOpcion["imagen"].'"></i>'.PCO_ReemplazarVariablesPHPEnCadena($RegistroOpcion["texto"]);
        			}
        		else
        			$CadenaInOpcion= '<img src="'.$RegistroOpcion["imagen"].'" border="0" />';

                //Imprime opciones ubicadas en la barra superior de la aplicacion
                if ($Ubicacion=='arriba')
                    {
        				echo '<li role="presentation">';
        				echo $CadenaPreOpcion;
        				echo $CadenaInOpcion;
        				echo $CadenaPosOpcion;
                        echo '</li>';
                    }

                //Imprime opciones ubicadas en ventanas o acordeones en el centro de la aplicacion
                if ($Ubicacion=='centro')
                    {
                        echo $CadenaPreOpcion;
                        echo $CadenaInOpcion;
                        echo $CadenaPosOpcion.'&nbsp;';
                    }

                //Imprime opciones ubicadas en ventanas o acordeones en el centro de la aplicacion
                if ($Ubicacion=='formulario')
                    {
                        echo $CadenaPreOpcion;
                        echo $CadenaInOpcion;
                        echo $CadenaPosOpcion.'&nbsp;';
                    }

                //Imprime opciones ubicadas en el escritorio de la aplicacion (iconos grandes sin categorizar)
                if ($Ubicacion=='escritorio')
                    {
                        // Imprime la imagen
                        echo $CadenaPreOpcion;
                        echo $CadenaInOpcion;
                        echo $CadenaPosOpcion;
                    }

                //Imprime opciones ubicadas en la barra lateral de navegacion (izquierda)
                if ($Ubicacion=='lateral')
                    {
                        echo '<li style="text-align: left; font-size:0.95em;">';
                        echo $CadenaPreOpcion;
                        echo $CadenaInOpcion;
                        echo $CadenaPosOpcion;
                        echo '</li>';
                    }

                //Imprime opciones ubicadas en la barra superior, menu de usuario
                if ($Ubicacion=='usuario')
                    {
                        echo '<li>';
                        echo $CadenaPreOpcion;
                        echo $CadenaInOpcion;
                        echo $CadenaPosOpcion;
                        echo '</li>';
                    }
			}
    }



/*#################################################################################
###################################################################################*/
function PCO_CodificarCadena_UUEncode($Cadena)
    {
        // Sanity check
        if (!is_scalar($Cadena)) {
            user_error('convert_uuencode() expects parameter 1 to be'
                . ' string, ' . gettype($Cadena) . ' given',
                E_USER_WARNING);
            return false;
        }

        $u = 0;
        $encoded = '';

        while ($c = count($bytes = unpack('c*',
            substr($Cadena, $u, 45)))) {
            $u += 45;
            $encoded .= pack('c', $c + 0x20);

            while ($c % 3) {
                $bytes[++$c] = 0;
            }

            foreach (array_chunk($bytes, 3) as $b) {
                $b0 = ($b[0] & 0xFC) >> 2;
                $b1 = (($b[0] & 0x03) << 4) + (($b[1] & 0xF0) >> 4);
                $b2 = (($b[1] & 0x0F) << 2) + (($b[2] & 0xC0) >> 6);
                $b3 = $b[2] & 0x3F;

                $b0 = $b0 ? $b0 + 0x20 : 0x60;
                $b1 = $b1 ? $b1 + 0x20 : 0x60;
                $b2 = $b2 ? $b2 + 0x20 : 0x60;
                $b3 = $b3 ? $b3 + 0x20 : 0x60;

                $encoded .= pack('c*', $b0, $b1, $b2, $b3);
            }

            $encoded .= "\n";
        }

        // Add termination characters
        $encoded .= "\x60\n";
        return $encoded;
    }


/*#################################################################################
###################################################################################*/
function PCO_DecodificarCadena_UUEncode($Cadena)
    {
        // Sanity check
        if (!is_scalar($Cadena)) {
            user_error('convert_uuencode() expects parameter 1 to be'
                . ' string, ' . gettype($Cadena) . ' given',
                E_USER_WARNING);
            return false;
        }

        if (strlen($Cadena) < 8) {
            user_error('convert_uuencode() The given parameter is not'
                . ' a valid uuencoded string', E_USER_WARNING);
            return false;
        }

        $decoded = '';
        foreach (explode("\n", $Cadena) as $line) {

            $c = count($bytes = unpack('c*', substr(trim($line), 1)));

            while ($c % 4) {
                $bytes[++$c] = 0;
            }

            foreach (array_chunk($bytes, 4) as $b) {
                $b0 = $b[0] == 0x60 ? 0 : $b[0] - 0x20;
                $b1 = $b[1] == 0x60 ? 0 : $b[1] - 0x20;
                $b2 = $b[2] == 0x60 ? 0 : $b[2] - 0x20;
                $b3 = $b[3] == 0x60 ? 0 : $b[3] - 0x20;

                $b0 <<= 2;
                $b0 |= ($b1 >> 4) & 0x03;
                $b1 <<= 4;
                $b1 |= ($b2 >> 2) & 0x0F;
                $b2 <<= 6;
                $b2 |= $b3 & 0x3F;

                $decoded .= pack('c*', $b0, $b1, $b2);
            }
        }
        return rtrim($decoded, "\0");
    }


/*#################################################################################
###################################################################################*/
function PCO_CodificarCadena_Binario($input)
    {
        if (!is_string($input))
            return false;
        $input = unpack('H*', $input);
        $chunks = str_split($input[1], 2);
        $ret = '';
        foreach ($chunks as $chunk)
            {
                $temp = base_convert($chunk, 16, 2);
                $ret .= str_repeat("0", 8 - strlen($temp)) . $temp;
            }

        //RETORNO DE HEXADECIMAL TOMADO DEL BINARIO
        {
            //$ret = bin2hex ($ret);
        }
        //RETORNO DE DECIMAL TOMADO DEL BINARIO CON ADICION DE CEROS A LA IZQUIERDA
        /*
        {
            //Busca primer uno
            $PrimerUno=stripos ( $ret , "1");
            $CadenaCeros="";
            for ($i=0;$i<$PrimerUno;$i++)
                $CadenaCeros.="0";
            $ret = $CadenaCeros."_".bindec($ret);   //Retorna por ejemplo  00_6552311
        }
        */
        return $ret;
    }


/*#################################################################################
###################################################################################*/
function PCO_DecodificarCadena_Binario($input)
    {
        //RETOMA UN HEXADECIMAL Y DEVUELVE EL BINARIO A PROCESAR
        {
            //$ret = hex2bin ($ret);
        }
        //RETOMA UN DECIMAL Y DEVUELVE EL BINARIO A PROCESAR AGREGANDO LOS CEROS EXTRA
        /*
        {
            $PartesNumero=explode("_",$input);
            $input = $PartesNumero[0].decbin($PartesNumero[1]);   //Analiza por ejemplo una entrada como 00_6552311  para devolver su parte decimal en binaria antecedida por los ceros dados
        }
        */

        if (!is_string($input))
            return false;
        $chunks = str_split($input,8);
        $ret = '';
        foreach ($chunks as $chunk)
        {
            $temp = base_convert($chunk, 2, 16);
            $ret .= pack('H*',str_repeat("0", 2 - strlen($temp)) . $temp);
        }
        return $ret;
    }


########################################################################
########################################################################
/*
	Function: ImprimirMarcoPanelAdmin
	Imprime un marco generico con informacion para el panel del administrador

	Variables de entrada:

		ClaseColumnas - Clases para la definicion del tamano del control en formato de columnas bootstrap.  Ej:  col-lg-3 col-md-6
		EstiloPanel - Define el color del control bootstrap.  [primary | green | red | default | yellow | info | success | danger]
		ClaseIconoFA - Clase con el icono en notacion FontAwesome para ser agregado al cuadro. Acepta modificadores FA.  Ej.  fa-table fa-4x fa-spin
		Titulo - Texto a imprimir en formato grande sobre el cuadro.  Se recomienda una sola palabra.
		SubTitulo - Texto corto explicativo del cuadro a ser impreso debajo del titulo en letra pequena.
		EnlaceTexto - Texto a presentar al usuario para hacer clic sobre el.
		EnlaceURL - URL para agregar al elemento Anchor.  Soporta los modificadores estandar de HTML.
		ClaseTextoTitulo - Clase CSS para ser aplicada al texto del titulo

	Salida:
		Impresion del codigo HTML correspondiente
*/
function PCO_ImprimirPanelSimpleDashboard($ClaseColumnas,$EstiloPanel,$ClaseIconoFA,$Titulo,$SubTitulo,$EnlaceTexto,$EnlaceURL,$ClaseTextoTitulo="huge")
    {
        $SalidaFuncion="
            <div class='$ClaseColumnas'>
                <div class='panel panel-$EstiloPanel'>
                    <div class='panel-heading'>
                        <div class='row'>
                            <div class='col-xs-3'>
                                <i class='fa $ClaseIconoFA'></i>
                            </div>
                            <div class='col-xs-9 text-right'>
                                <div class='$ClaseTextoTitulo'>
                                    <b>$Titulo</b>
                                </div>
                                <div>$SubTitulo</div>
                            </div>
                        </div>
                    </div>
                    <a href='$EnlaceURL'>
                        <div class='panel-footer'>
                            <span class='pull-left'>$EnlaceTexto</span>
                            <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                            <div class='clearfix'></div>
                        </div>
                    </a>
                </div>
            </div>";
        return $SalidaFuncion;
    }


########################################################################
########################################################################
/*
	Function: PCOFUNC_EliminarInforme
	Elimina un informe definido para la aplicacion incluyendo todos los objetos definidos en su interior

	Variables de entrada:

		informe - ID unico de identificacion del formulario a eliminar

	(start code)
		DELETE FROM ".$TablasCore."formulario WHERE id='$formulario'
		DELETE FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario'
		DELETE FROM ".$TablasCore."formulario_boton WHERE formulario=? ","$formulario
	(end)

	Salida:
		Registro eliminado

	Ver tambien:
		<PCO_AdministrarFormularios>
*/
function PCOFUNC_EliminarInforme($informe="")
	{
		global $TablasCore;
		if ($informe!="")
			{
				PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."informe WHERE id=? ","$informe");
				PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."informe_campos WHERE informe=? ","$informe");
				PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."informe_tablas WHERE informe=? ","$informe");
				PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."informe_condiciones WHERE informe=? ","$informe");
				PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."informe_boton WHERE informe=? ","$informe");
				PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."usuario_informe WHERE informe=? ","$informe");
				PCO_Auditar("Elimina informe $informe");
			}
	}


########################################################################
########################################################################
/*
	Function: PCO_EliminarFormulario
	Elimina un formulario definido para la aplicacion incluyendo todos los objetos definidos en su interior

	Variables de entrada:

		formulario - ID unico de identificacion del formulario a eliminar

	(start code)
		DELETE FROM ".$TablasCore."formulario WHERE id='$formulario'
		DELETE FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario'
		DELETE FROM ".$TablasCore."formulario_boton WHERE formulario=? ","$formulario
	(end)

	Salida:
		Registro eliminado

	Ver tambien:
		<PCO_AdministrarFormularios>
*/
function PCO_EliminarFormulario($formulario="")
	{
		global $TablasCore;
		if ($formulario!="")
			{
			    //Elimina los eventos relacionados con sus objetos
				$EventosFormulario=PCO_EjecutarSQL("SELECT ".$TablasCore."evento_objeto.id FROM ".$TablasCore."evento_objeto,".$TablasCore."formulario_objeto WHERE ".$TablasCore."formulario_objeto.formulario=$formulario AND ".$TablasCore."formulario_objeto.id=".$TablasCore."evento_objeto.objeto ","");
	            while($RegistroEventosFormulario=$EventosFormulario->fetch())
		            PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."evento_objeto WHERE id=? ",$RegistroEventosFormulario["id"]);

				PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."formulario WHERE id=? ","$formulario");

				PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."formulario_objeto WHERE formulario=? ","$formulario");
				PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."formulario_boton WHERE formulario=? ","$formulario");
				PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."menu WHERE formulario_vinculado=? ","$formulario");
				PCO_Auditar("Elimina formulario $formulario");
			}
	}


########################################################################
########################################################################
/*
	Function: PCO_ImportarDefinicionesXML
	Busca definiciones de elementos XML almacenadas sobre xml/ y ejecuta el proceso de importacion de cada uno automaticamente durante cada cargue de pagina por algun usuario disenador de aplicacion.

	Salida:

		Ejecucion automatica de los scripts residentes para la generacion de los elementos internos correspondientes
*/
function PCO_ImportarDefinicionesXML($ByPassControlDesarrollo)
    {
        global $ModoDesarrolladorPractico;
        
        //Hace ejecucion de solamente si no esta en desarrollo de framework o si se hace el ByPass (1=Regenera y Borra,2=Regenera y dejar archivos)
        //Esto permite que los fuentes permanezcan con los XML y scripts en trazabilidad
        if ($ModoDesarrolladorPractico>=0 || $ByPassControlDesarrollo>0)
            {
        		//Se desactiva el limite de tiempo para ejecucion del script
        		set_time_limit (0) ;
        		
                $ArregloElementos = array();
                //Obtiene lista de archivos en xml/ para ser ejecutados
                $DirectorioXML = dir("xml/");
                while (false !== ($ArchivoXML = $DirectorioXML->read()))
                    if(strtolower(substr($ArchivoXML, -4))==".xml") //Considera solo los XML
                        $ArregloElementos[]=$ArchivoXML;
                $DirectorioXML->close();
        
                //Por cada archivo ejecuta el proceso de importacion correspondiente
                foreach ($ArregloElementos as $ArchivoXML)
                    {
                        //Identifica el tipo de elemento contenido en el archivo para saber como procesarlo
                        $cadena_xml_importado = file_get_contents("xml/".$ArchivoXML);
        				$xml_importado = @simplexml_load_string($cadena_xml_importado); // Usa SimpleXML Directamente para interpretar cadena
                        //Procesa el archivo segun su tipo
                        if ($xml_importado->descripcion[0]->tipo_objeto=="Informe")
                            $ResultadoImportacion=PCO_ImportarXMLInforme($cadena_xml_importado);
                        if ($xml_importado->descripcion[0]->tipo_objeto=="Formulario")
                            $ResultadoImportacion=PCO_ImportarXMLFormulario($cadena_xml_importado);
                        //Una vez procesado el archivo lo elimina
                        if ($ByPassControlDesarrollo<2)
                            unlink("xml/".$ArchivoXML);
                    }
            }
    }


########################################################################
########################################################################
/*
	Function: PCO_ImportarScriptsPHP
	Busca definiciones de scripts PHP almacenadas sobre xml/ (carpeta del sistema para importar elementos y ejecuta cada uno automaticamente durante cada cargue de pagina por algun usuario disenador de aplicacion.

	Salida:

		Ejecucion automatica de los scripts residentes y renombrado de los mismos para evitar su posterior ejecucion
*/
function PCO_ImportarScriptsPHP($ByPassControlDesarrollo)
    {
        global $ModoDesarrolladorPractico;
        
        //Hace ejecucion de solamente si no esta en desarrollo de framework
        //Esto permite que los fuentes permanezcan con los XML y scripts en trazabilidad
        if ($ModoDesarrolladorPractico>=0 || $ByPassControlDesarrollo>0)
            {
                global $PCO_FechaOperacion,$PCO_HoraOperacion;
                $ArregloElementos = array();
                //Obtiene lista de archivos en xml/ para ser ejecutados
                $DirectorioScripts = dir("xml/");
                while (false !== ($ArchivoPHP = $DirectorioScripts->read()))
                    if(strtolower(substr($ArchivoPHP, -4))==".php") //Considera solo los PHP
                        $ArregloElementos[]=$ArchivoPHP;
                $DirectorioScripts->close();
        
                //Por cada archivo ejecuta el proceso de ejecucion correspondiente
                foreach ($ArregloElementos as $ArchivoPHP)
                    {
                        //Incluye el codigo
                        include_once("xml/".$ArchivoPHP);
                        //Una vez procesado el archivo lo renombra para no ser ejecutado mas
                        if ($ByPassControlDesarrollo<2)
                            rename("xml/".$ArchivoPHP, "xml/".$ArchivoPHP.".Run_".$PCO_FechaOperacion."-".$PCO_HoraOperacion);
                    }
            }
    }


########################################################################
########################################################################
/*
	Function: PCO_ExportarDefinicionesXML
	Exporta masivamente a XML las definiciones de elementos de un tipo dado

	Variables de entrada:

		TipoElementos - Indica el tipo de elementos que deben ser exportados:  Inf o Frm
		ListaElementos - Una lista de los elementos de ese tipo que deben ser exportados en un formato similar a la impresion  EJ: 1,2,5-6,8,12-30
		tipo_copia_objeto - Indica si los objetos seran generados con ID estatico o dinamico: XML_IdEstatico | XML_IdDinamico

	Salida:

		Archivos generados para los elementos seleccionados

	Ver tambien:
		<PCO_ExportarXMLInforme> | <PCO_ImportarXMLInforme> | <PCO_ExportarXMLFormulario> | <PCO_ImportarXMLFormulario>
*/
function PCO_ExportarDefinicionesXML($TipoElementos,$ListaElementos,$tipo_copia_objeto)
    {
        global $ModoDesarrolladorPractico,$PCO_FechaOperacion,$PCO_HoraOperacion,$TablasCore;
        $ArregloElementosExportacion=PCO_ParsearListasElementos($ListaElementos);
        foreach ($ArregloElementosExportacion as $ElementoExportar)
            {
                //Valida que sea un elemento exportable (de usuario o interno pero en modo desarrollador)
                if ($ElementoExportar>=$ModoDesarrolladorPractico)
                    {
                        //Establece el prefijo del path final del archivo exportado segun el valor de ID asi como si llevara fecha y hora o no
                        $PrefijoPath="tmp/";
                        $InfijoPath="_".$PCO_FechaOperacion."_".$PCO_HoraOperacion;
                        if ($ElementoExportar<0)
                            {
                                $PrefijoPath="xml/";
                                $InfijoPath=""; //Elimina fecha y hora dejando siempre un nombre de archivo fijo
                            }
                        //Exporta elementos tipo informe
                        if ($TipoElementos=="Inf")
                            {
                                //Verifica primero que si exista el ID de informe asociado antes de proceder
                                $RegistroElemento=@PCO_EjecutarSQL("SELECT id FROM ".$TablasCore."informe WHERE id = '$ElementoExportar' ")->fetch();
                                if ($RegistroElemento["id"]!="")
                                    {
                                        $PCO_NombreArchivoXML=$PrefijoPath."RepID_".$ElementoExportar.$InfijoPath.".xml";
                                        PCO_ExportarXMLInforme($ElementoExportar,$tipo_copia_objeto,$PCO_NombreArchivoXML);
                                    }
                            }
                        //Exporta elementos tipo formulario
                        if ($TipoElementos=="Frm")
                            {
                                //Verifica primero que si exista el ID de informe asociado antes de proceder
                                $RegistroElemento=@PCO_EjecutarSQL("SELECT id FROM ".$TablasCore."formulario WHERE id = '$ElementoExportar' ")->fetch();
                                if ($RegistroElemento["id"]!="")
                                    {
                                        $PCO_NombreArchivoXML=$PrefijoPath."FormID_".$ElementoExportar.$InfijoPath.".xml";
                                        PCO_ExportarXMLFormulario($ElementoExportar,$tipo_copia_objeto,$PCO_NombreArchivoXML);
                                    }
                            }
                    }
            }
    }


########################################################################
########################################################################
/*
	Function: PCO_ParsearListasElementos
	Toma una cadena con la lista de elementos separados por comas y rangos por guiones y los genera uno a uno sobre un arreglo que se retorna luego para realizar operaciones individuales sobre ellos.  Ignora rangos invertidos o donde no sean numericos.

	Variables de entrada:

		ListaElementos - Lista de elementos a parsear en formato similar al de impresion. EJ: 1,2,5-6,8,12-30

	Salida:

		Arreglo con todos los elementos parseados para ser procesado posteriormente por quien llame la funcion
*/
function PCO_ParsearListasElementos($ListaElementos)
    {
        $ArregloElementos = array();
        $ArregloParcial=explode(",",$ListaElementos);
        //Recorre toda la lista de elementos
        foreach ($ArregloParcial as $Rango)
            {
                $Rango=trim($Rango);
                //Por cada elemento analiza si se trata de un rango y lo genera, sino simplemente lo agrega
                if (substr_count ( $Rango , "-" ) > 0)
                    {
                        $RangoValido=false;
                        //Separa nuevamente por el guion y hace el ciclo de inclusion.  Solo analiza los dos primeros valores y descarta posibles rangos como 3-8-10
                        $RangoCompuesto=explode("-",$Rango);

                        //CASO 1: Analiza rangos normales con numeros enteros Ej. 4-8
                        if (!$RangoValido)
                            {
                                $InicioRango=trim($RangoCompuesto[0]);
                                $FinRango=trim($RangoCompuesto[1]);
                                //Evalua si la operacion obtuvo un rango valido
                                if (is_numeric($InicioRango) && is_numeric($FinRango)) $RangoValido=true;
                            }
                        //CASO 2: Analiza rangos donde el primero es negativo y el segundo positivo. Ej: -100-0 o -80-5
                        if (!$RangoValido)
                            {
                                $InicioRango="-".trim($RangoCompuesto[1]);
                                $FinRango=trim($RangoCompuesto[2]);
                                //Evalua si la operacion obtuvo un rango valido
                                if (is_numeric($InicioRango) && is_numeric($FinRango)) $RangoValido=true;
                            }
                        //CASO 3: Analiza rangos donde el primero es negativo y el segundo tambien. Ej: -80--5
                        if (!$RangoValido)
                            {
                                $InicioRango="-".trim($RangoCompuesto[1]);
                                $FinRango   ="-".trim($RangoCompuesto[3]);
                                //Evalua si la operacion obtuvo un rango valido
                                if (is_numeric($InicioRango) && is_numeric($FinRango)) $RangoValido=true;
                            }
                        //CASO 4: Analiza Elementos unicos que a pesar de comenzar con guion se trata de un unico elemento. Ej: -5
                        if (!$RangoValido)
                            {
                                $InicioRango="-".trim($RangoCompuesto[1]);
                                //Evalua si la operacion obtuvo un rango valido
                                if (is_numeric($InicioRango))
                                    {
                                        $ArregloElementos[]=$Rango;
                                        $RangoValido=false;
                                    }
                            }
                        //Revisa que el rango si sea valido (ambos numericos) antes de seguir
                        if ($RangoValido)
                            {
                                //Revisa que el rango no sea inverso, sino lo ignora
                                if ($InicioRango<=$FinRango)
                                    {
                                        //Genera los elementos asociados al rango dentro del arreglo a retornar
                                        for ($i=$InicioRango;$i<=$FinRango;$i++)
                                            $ArregloElementos[]=$i;
                                    }
                            }
                    }
                else
                    {
                        //Revisa que el rango si sea un numero antero antes de seguir
                        if (is_numeric($Rango))
                            $ArregloElementos[]=$Rango;
                    }
            }
        return $ArregloElementos;
    }


########################################################################
########################################################################
/*
	Function: PCO_ImportarXMLFormulario
	Importa una cadena XML con la especificacion de un formulario al sistema

	Variables de entrada:

		xml_importado - Cadena en notacion XML con todos los componentes necesarios del formulario

	Salida:

		Objetos generados a partir de la definicion de la cadena
*/
function PCO_ImportarXMLFormulario($xml_importado)
    {
        global $ListaCamposSinID_menu,$ListaCamposSinID_evento_objeto,$_SeparadorCampos_,$TablasCore,$ListaCamposSinID_formulario,$ConexionPDO,$ListaCamposSinID_formulario_objeto,$ListaCamposSinID_formulario_boton;
        $xml_importado = @simplexml_load_string($xml_importado); // Usa SimpleXML Directamente para interpretar cadena

				//Si es tipo estatico elimina el formulario existente con el mismo ID
				$ListaCamposParaID="";
				$InterroganteParaID="";
				$ValorInsercionParaID="";
				if ($xml_importado->descripcion[0]->tipo_exportacion=="XML_IdEstatico")
					{
						$ListaCamposParaID="id,";
						$InterroganteParaID="?,";
						$ValorInsercionParaID=base64_decode($xml_importado->core_formulario[0]->id).$_SeparadorCampos_;
						PCO_EliminarFormulario(base64_decode($xml_importado->core_formulario[0]->id));
					}

				// Establece valores para cada campo a insertar en el nuevo form
				/* ##########################################################################################################*/
				/* ####### IMPORTANTE: Ajustes sobre esta funcion se deberian replicar en funcion de copia asociadas ########*/
				/* ##########################################################################################################*/
				$titulo=base64_decode($xml_importado->core_formulario[0]->titulo);
				$ayuda_titulo=base64_decode($xml_importado->core_formulario[0]->ayuda_titulo);
				$ayuda_texto=base64_decode($xml_importado->core_formulario[0]->ayuda_texto);
				$tabla_datos=base64_decode($xml_importado->core_formulario[0]->tabla_datos);
				$columnas=base64_decode($xml_importado->core_formulario[0]->columnas);
				$javascript=base64_decode($xml_importado->core_formulario[0]->javascript);
				$borde_visible=base64_decode($xml_importado->core_formulario[0]->borde_visible);
				$estilo_pestanas=base64_decode($xml_importado->core_formulario[0]->estilo_pestanas);
				$id_html=base64_decode($xml_importado->core_formulario[0]->id_html);
				$tipo_maquetacion=base64_decode($xml_importado->core_formulario[0]->tipo_maquetacion);
				$css_columnas=base64_decode($xml_importado->core_formulario[0]->css_columnas);
				$estilo_ventana=base64_decode($xml_importado->core_formulario[0]->estilo_ventana);
				$pre_script=base64_decode($xml_importado->core_formulario[0]->pre_script);
				$post_script=base64_decode($xml_importado->core_formulario[0]->post_script);
				$modulo=base64_decode($xml_importado->core_formulario[0]->modulo);
				// Inserta el nuevo objeto al form
				PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."formulario (".$ListaCamposParaID.$ListaCamposSinID_formulario.") VALUES (".$InterroganteParaID."?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ","$ValorInsercionParaID$titulo$_SeparadorCampos_$ayuda_titulo$_SeparadorCampos_$ayuda_texto$_SeparadorCampos_$tabla_datos$_SeparadorCampos_$columnas$_SeparadorCampos_$javascript$_SeparadorCampos_$borde_visible$_SeparadorCampos_$estilo_pestanas$_SeparadorCampos_$id_html$_SeparadorCampos_$tipo_maquetacion$_SeparadorCampos_$css_columnas$_SeparadorCampos_$estilo_ventana$_SeparadorCampos_$pre_script$_SeparadorCampos_$post_script$_SeparadorCampos_$modulo");

				//Determina el ID del registro
				if ($xml_importado->descripcion[0]->tipo_exportacion=="XML_IdEstatico")
					$idObjetoInsertado=base64_decode($xml_importado->core_formulario[0]->id);
				else
					$idObjetoInsertado=PCO_ObtenerUltimoIDInsertado($ConexionPDO);

				// Busca los elementos que componen el formulario para hacerles la copia
				//Determina cuantos campos tiene la tabla
				$ArregloCampos=explode(',',$ListaCamposSinID_formulario_objeto);
				$TotalCampos=count($ArregloCampos);
				// Registros de formulario_objeto
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_formulario_objeto[0]->cantidad_objetos;$PCO_i++)
					{
						//Genera cadena de interrogantes y valores segun cantidad de campos
						$CadenaInterrogantes='?'; //Agrega el primer interrogante
						$CadenaValores=base64_decode($xml_importado->core_formulario_objeto[$PCO_i]->tipo);

						for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
							{
								//Cadena de interrogantes
								$CadenaInterrogantes.=',?';
								//Cadena de valores (el campo No 5 corresponde al ID de formulario nuevo)
								if ($PCOCampo!=5)
									$CadenaValores.=$_SeparadorCampos_.base64_decode($xml_importado->core_formulario_objeto[$PCO_i]->{$ArregloCampos[$PCOCampo]});
								else
									$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
							}
						//Inserta el nuevo objeto al form
						PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."formulario_objeto ($ListaCamposSinID_formulario_objeto) VALUES ($CadenaInterrogantes) ","$CadenaValores");

                        //Determina cual fue el ID para el ultimo elemento insertado
						$idObjetoInsertadoParaEvento=PCO_ObtenerUltimoIDInsertado($ConexionPDO);
                        //Averigua el ID ORIGINAL del objeto recien insertado
                        $IDOriginalObjeto=base64_decode($xml_importado->core_formulario_objeto[$PCO_i]->id);
                        //Recorre la lista de todos los eventos en el XML
        				for ($PCO_iEvento=0;$PCO_iEvento<$xml_importado->total_core_evento_objeto[0]->cantidad_objetos;$PCO_iEvento++)
        					{
        					    $RegistroEvento_id=base64_decode($xml_importado->core_evento_objeto[$PCO_iEvento]->id);
        					    $RegistroEvento_objeto=base64_decode($xml_importado->core_evento_objeto[$PCO_iEvento]->objeto);
        					    $RegistroEvento_evento=base64_decode($xml_importado->core_evento_objeto[$PCO_iEvento]->evento);
        					    $RegistroEvento_javascript=base64_decode($xml_importado->core_evento_objeto[$PCO_iEvento]->javascript);
                                //Si el objeto del evento original es igual al id original del evento recien insertado crea el nuevo registro de evento
                                if ($RegistroEvento_objeto==$IDOriginalObjeto)
                                    {
    									$CadenaValoresEventos="{$idObjetoInsertadoParaEvento}{$_SeparadorCampos_}{$RegistroEvento_evento}{$_SeparadorCampos_}{$RegistroEvento_javascript}";
    									PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."evento_objeto ($ListaCamposSinID_evento_objeto) VALUES (?,?,?) ","$CadenaValoresEventos");
                                    }
        					}
					}

				//Determina cuantos campos tiene la tabla
				$ArregloCampos=explode(',',$ListaCamposSinID_formulario_boton);
				$TotalCampos=count($ArregloCampos);
				// Registros de formulario_boton
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_formulario_boton[0]->cantidad_objetos;$PCO_i++)
					{
						//Genera cadena de interrogantes y valores segun cantidad de campos
						$CadenaInterrogantes='?'; //Agrega el primer interrogante
						$CadenaValores=base64_decode($xml_importado->core_formulario_boton[$PCO_i]->titulo);

						for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
							{
								//Cadena de interrogantes
								$CadenaInterrogantes.=',?';
								//Cadena de valores (el campo No 2 corresponde al ID de formulario nuevo)
								if ($PCOCampo!=2)
									$CadenaValores.=$_SeparadorCampos_.base64_decode($xml_importado->core_formulario_boton[$PCO_i]->{$ArregloCampos[$PCOCampo]});
								else
									$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
							}
						//Inserta el nuevo objeto al form
						PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."formulario_boton ($ListaCamposSinID_formulario_boton) VALUES ($CadenaInterrogantes) ","$CadenaValores");
					}

				//Determina cuantos campos tiene la tabla
				$ArregloCampos=explode(',',$ListaCamposSinID_menu);
				$TotalCampos=count($ArregloCampos);
				// Registros de formulario_boton
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_menu[0]->cantidad_objetos;$PCO_i++)
					{
						//Genera cadena de interrogantes y valores segun cantidad de campos
						$CadenaInterrogantes='?'; //Agrega el primer interrogante
						$CadenaValores=base64_decode($xml_importado->core_menu[$PCO_i]->texto);

						for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
							{
								//Cadena de interrogantes
								$CadenaInterrogantes.=',?';
								//Cadena de valores (el campo No 2 corresponde al ID de formulario nuevo)
								if ($PCOCampo!=16)
									$CadenaValores.=$_SeparadorCampos_.base64_decode($xml_importado->core_menu[$PCO_i]->{$ArregloCampos[$PCOCampo]});
								else
									$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
							}
						//Inserta el nuevo objeto al form
						PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."menu ($ListaCamposSinID_menu) VALUES ($CadenaInterrogantes) ","$CadenaValores");
					}

        return $idObjetoInsertado;
    }


########################################################################
########################################################################
/*
	Function: PCO_ExportarXMLFormulario
	Exporta las especificaciones de un formulario a una cadena XML valida dentro de un archivo especificado

	Variables de entrada:

		formulario - Identificador unico del formulario que se desea exportar
		tipo_copia_objeto - Indica el tipo de copia que se hara del formulario: EnLinea|XML_IdEstatico|XML_IdDinamico

	Salida:

		Archivo con el elemento exportado

	Ver tambien:
		<PCO_AdministrarFormularios>
*/
function PCO_ExportarXMLFormulario($formulario,$tipo_copia_objeto,$PCO_NombreArchivoXML="")
    {
        global $ArchivoCORE,$ListaCamposSinID_evento_objeto,$_SeparadorCampos_,$TablasCore,$ListaCamposSinID_menu,$ListaCamposSinID_formulario,$ConexionPDO,$ListaCamposSinID_formulario_objeto,$ListaCamposSinID_formulario_boton;
        global $MULTILANG_ErrorDatos,$MULTILANG_ErrorTiempoEjecucion,$MULTILANG_FrmMsjCopia,$MULTILANG_FrmTipoCopiaExporta,$MULTILANG_FrmCopiaFinalizada,$MULTILANG_IrEscritorio,$MULTILANG_Descargar;
        global $PCO_VersionActual,$Nombre_Aplicacion,$Version_Aplicacion,$PCOSESS_LoginUsuario,$PCO_FechaOperacionGuiones,$PCO_HoraOperacionPuntos,$PCO_FechaOperacion,$PCO_HoraOperacion;
        global $MULTILANG_Editar,$MULTILANG_Objeto;

			$mensaje_error="";
			if ($formulario=="")
				$mensaje_error=$MULTILANG_ErrorTiempoEjecucion.".  No ingreso ID de Formulario / Form ID not entered";
			if ($tipo_copia_objeto=="")
				$mensaje_error=$MULTILANG_ErrorTiempoEjecucion.".  No indicado modo de copia / Copy mode not entered";

			$Contenido_XML="";

			if ($mensaje_error=="")
				{
					//Hace la copia del objeto segun el tipo solicitado
					if ($tipo_copia_objeto=="EnLinea")
						{
							// Busca datos y Crea copia del formulario
							$consulta=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id=?","$formulario");
							$registro = $consulta->fetch();
							// Establece valores para cada campo a insertar en el nuevo form
							/* ##########################################################################################################*/
							/* ####### IMPORTANTE:  Ajustes sobre esta funcionde copia se deberian replicar en importaciones XML ########*/
							/* ##########################################################################################################*/
							$titulo='[COPIA] '.$registro["titulo"];
							$ayuda_titulo=$registro["ayuda_titulo"];
							$ayuda_texto=$registro["ayuda_texto"];
							$tabla_datos=$registro["tabla_datos"];
							$columnas=$registro["columnas"];
							$javascript=$registro["javascript"];
							$borde_visible=$registro["borde_visible"];
							$estilo_pestanas=$registro["estilo_pestanas"];
							$id_html=$registro["id_html"];
							$tipo_maquetacion=$registro["tipo_maquetacion"];
							$css_columnas=$registro["css_columnas"];
							$estilo_ventana=$registro["estilo_ventana"];
							$pre_script=$registro["pre_script"];
							$post_script=$registro["post_script"];
							$modulo=$registro["modulo"];
							// Inserta el nuevo objeto al form
							PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."formulario (".$ListaCamposSinID_formulario.") VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ","$titulo$_SeparadorCampos_$ayuda_titulo$_SeparadorCampos_$ayuda_texto$_SeparadorCampos_$tabla_datos$_SeparadorCampos_$columnas$_SeparadorCampos_$javascript$_SeparadorCampos_$borde_visible$_SeparadorCampos_$estilo_pestanas$_SeparadorCampos_$id_html$_SeparadorCampos_$tipo_maquetacion$_SeparadorCampos_$css_columnas$_SeparadorCampos_$estilo_ventana$_SeparadorCampos_$pre_script$_SeparadorCampos_$post_script$_SeparadorCampos_$modulo");
							$idObjetoInsertado=PCO_ObtenerUltimoIDInsertado($ConexionPDO);

							// Busca los elementos que componen el formulario para hacerles la copia
							//Determina cuantos campos tiene la tabla
							$ArregloCampos=explode(',',$ListaCamposSinID_formulario_objeto);
							$TotalCampos=count($ArregloCampos);
							// Registros de formulario_objeto
							$consulta=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."formulario_objeto WHERE formulario=? ORDER by PCOBD_Peso,id","$formulario");
							while($registro = $consulta->fetch())
								{
									//Genera cadena de interrogantes y valores segun cantidad de campos
									$CadenaInterrogantes='?'; //Agrega el primer interrogante
									$CadenaValores=$registro[1];
									for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
										{
											//Cadena de interrogantes
											$CadenaInterrogantes.=',?';
											//Cadena de valores (el campo No 5 corresponde al ID de formulario nuevo)
											if ($PCOCampo!=5)
												$CadenaValores.=$_SeparadorCampos_.$registro[$PCOCampo+1];
											else
												$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
										}
									//Inserta el nuevo objeto al form
									PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."formulario_objeto ($ListaCamposSinID_formulario_objeto) VALUES ($CadenaInterrogantes) ","$CadenaValores");

									//Por cada elemento busca si tiene eventos y los copia tambien
									$idObjetoInsertadoParaEvento=PCO_ObtenerUltimoIDInsertado($ConexionPDO);
									$ArregloCamposEvento=explode(',',$ListaCamposSinID_evento_objeto);
							        $TotalCamposEvento=count($ArregloCamposEvento);
        							$consulta_eventos=PCO_EjecutarSQL("SELECT ".$TablasCore."evento_objeto.* FROM ".$TablasCore."evento_objeto WHERE ".$TablasCore."evento_objeto.objeto=? ",$registro["id"]);
        							while($registro_eventos = $consulta_eventos->fetch())
        								{
        									//Genera cadena de interrogantes y valores segun cantidad de campos
        									$CadenaInterrogantesEventos='?'; //Agrega el primer interrogante
        									$CadenaValoresEventos=$idObjetoInsertadoParaEvento;
        									for ($PCOCampoEvento=1;$PCOCampoEvento<$TotalCamposEvento;$PCOCampoEvento++)
        										{
        											//Cadena de interrogantes
        											$CadenaInterrogantesEventos.=',?';
        											//Cadena de valores (el campo No 1 corresponde al ID de objeto nuevo)
        											$CadenaValoresEventos.=$_SeparadorCampos_.$registro_eventos[$PCOCampoEvento+1];
        										}
        									//Inserta el nuevo objeto al form
        									PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."evento_objeto ($ListaCamposSinID_evento_objeto) VALUES ($CadenaInterrogantesEventos) ","$CadenaValoresEventos");
        								}
								}

							//Determina cuantos campos tiene la tabla
							$ArregloCampos=explode(',',$ListaCamposSinID_formulario_boton);
							$TotalCampos=count($ArregloCampos);
							// Registros de formulario_boton
							$consulta=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."formulario_boton WHERE formulario=? ORDER BY peso,id","$formulario");
							while($registro = $consulta->fetch())
								{
									//Genera cadena de interrogantes y valores segun cantidad de campos
									$CadenaInterrogantes='?'; //Agrega el primer interrogante
									$CadenaValores=$registro[1];
									for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
										{
											//Cadena de interrogantes
											$CadenaInterrogantes.=',?';
											//Cadena de valores (el campo No 2 corresponde al ID de formulario nuevo)
											if ($PCOCampo!=2)
												$CadenaValores.=$_SeparadorCampos_.$registro[$PCOCampo+1];
											else
												$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
										}
									//Inserta el nuevo objeto al form
									PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."formulario_boton ($ListaCamposSinID_formulario_boton) VALUES ($CadenaInterrogantes) ","$CadenaValores");
								}


							//Determina cuantos campos tiene la tabla
							$ArregloCampos=explode(',',$ListaCamposSinID_menu);
							$TotalCampos=count($ArregloCampos);
							// Registros de formulario_boton
							//$consulta=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."menu WHERE formulario_vinculado=? AND padre=0 ORDER BY peso,id","$formulario");
							$consulta=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."menu WHERE formulario_vinculado=? ORDER BY peso,id","$formulario");
							while($registro = $consulta->fetch())
								{
									//Genera cadena de interrogantes y valores segun cantidad de campos
									$CadenaInterrogantes='?'; //Agrega el primer interrogante
									$CadenaValores=$registro[1];
									for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
										{
											//Cadena de interrogantes
											$CadenaInterrogantes.=',?';
											//Cadena de valores (el campo No 16 corresponde al ID de formulario nuevo)
											if ($PCOCampo!=16)
												$CadenaValores.=$_SeparadorCampos_.$registro[$PCOCampo+1];
											else
												$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
										}
									//Inserta los menues correspondientes al form
									PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."menu ($ListaCamposSinID_menu) VALUES ($CadenaInterrogantes) ","$CadenaValores");
								}


							PCO_Auditar("Crea copia $tipo_copia_objeto de formulario $formulario");

							//Presenta la ventana con informacion y enlace de descarga
							?>
								<form action="<?php echo $ArchivoCORE; ?>" method="POST" name="det<?php echo $idObjetoInsertado; ?>" id="det<?php echo $idObjetoInsertado; ?>">
										<input type="hidden" name="PCO_Accion" value="PCO_EditarFormulario">
										<input type="Hidden" name="popup_activo" value="">
										<input type="hidden" name="formulario" value="<?php echo $idObjetoInsertado; ?>">
										<input type="hidden" name="nombre_tabla" value="<?php echo $tabla_datos; ?>">
								        <a class="btn btn-success btn-block" href="javascript:document.det<?php echo $idObjetoInsertado; ?>.submit();"><i class="fa fa-pencil"></i> <?php echo $MULTILANG_Editar." <b>".$titulo."</b>"; ?></a>
								</form>
							<?php
						}

					//Hace la copia del objeto segun el tipo solicitado
					if ($tipo_copia_objeto=="XML_IdEstatico" || $tipo_copia_objeto=="XML_IdDinamico")
						{
							// Inicia el archivo XML
							$Contenido_XML.="<?xml version=\"1.0\" encoding=\"utf-8\" ?>
<objetos_practicos>
	<descripcion>
		<tipo_objeto>Formulario</tipo_objeto>
		<version_practico>$PCO_VersionActual</version_practico>
		<tipo_exportacion>$tipo_copia_objeto</tipo_exportacion>
		<sistema_origen>$Nombre_Aplicacion</sistema_origen>
		<version>$Version_Aplicacion</version>
		<usuario_generador>$PCOSESS_LoginUsuario</usuario_generador>
		<fecha_exportacion>$PCO_FechaOperacionGuiones</fecha_exportacion>
		<hora_exportacion>$PCO_HoraOperacionPuntos</hora_exportacion>
	</descripcion>";
							// Exporta tabla core_formulario
							$Contenido_XML .= "
	<core_formulario>";
							// Busca datos y genera XML de cada registro
							$consulta=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id=?","$formulario");
							$registro = $consulta->fetch();
							$Contenido_XML .=PCO_ConvertirRegistroXML($registro,"id,".$ListaCamposSinID_formulario);
							$Contenido_XML .= "
	</core_formulario>";
							// Registros de formulario_objeto
							$consulta=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."formulario_objeto WHERE formulario=? ORDER BY PCOBD_Peso,id","$formulario");
							$conteo_elementos_xml=0;
							while($registro = $consulta->fetch())
								{
									//Exporta la tabla de core_formulario_objeto
									$Contenido_XML .= "
	<core_formulario_objeto>";
									$Contenido_XML .=PCO_ConvertirRegistroXML($registro,"id,".$ListaCamposSinID_formulario_objeto);
							$Contenido_XML .= "
	</core_formulario_objeto>";
									$conteo_elementos_xml++;
								}
							//Agrega el total de elementos y resetea contador para el siguiente
									$Contenido_XML .= "
	<total_core_formulario_objeto><cantidad_objetos>$conteo_elementos_xml</cantidad_objetos></total_core_formulario_objeto>";
							$conteo_elementos_xml=0;

							// Registros de eventos por formulario_objeto
							$consulta=PCO_EjecutarSQL("SELECT ".$TablasCore."evento_objeto.* FROM ".$TablasCore."evento_objeto,".$TablasCore."formulario_objeto WHERE ".$TablasCore."formulario_objeto.id=".$TablasCore."evento_objeto.objeto  AND ".$TablasCore."formulario_objeto.formulario=?","$formulario");
							$conteo_elementos_xml=0;
							while($registro = $consulta->fetch())
								{
									//Exporta la tabla de core_formulario_objeto
									$Contenido_XML .= "
	<core_evento_objeto>";
									$Contenido_XML .=PCO_ConvertirRegistroXML($registro,"id,".$ListaCamposSinID_evento_objeto);
							$Contenido_XML .= "
	</core_evento_objeto>";
									$conteo_elementos_xml++;
								}
							//Agrega el total de elementos y resetea contador para el siguiente
									$Contenido_XML .= "
	<total_core_evento_objeto><cantidad_objetos>$conteo_elementos_xml</cantidad_objetos></total_core_evento_objeto>";
							$conteo_elementos_xml=0;

							// Registros de formulario_boton
							$consulta=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."formulario_boton WHERE formulario=? ORDER BY peso,id","$formulario");
							while($registro = $consulta->fetch())
								{
									//Exporta la tabla de core_formulario_objeto
									$Contenido_XML .= "
	<core_formulario_boton>";
									$Contenido_XML .=PCO_ConvertirRegistroXML($registro,"id,".$ListaCamposSinID_formulario_boton);
							$Contenido_XML .= "
	</core_formulario_boton>";
									$conteo_elementos_xml++;
								}
							//Agrega el total de elementos y resetea contador para el siguiente
									$Contenido_XML .= "
	<total_core_formulario_boton><cantidad_objetos>$conteo_elementos_xml</cantidad_objetos></total_core_formulario_boton>";
							$conteo_elementos_xml=0;

							// Registros de menu
							$consulta=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."menu WHERE formulario_vinculado=? ORDER BY peso,id","$formulario");
							while($registro = $consulta->fetch())
								{
									//Exporta la tabla de core_menu
									$Contenido_XML .= "
	<core_menu>";
									$Contenido_XML .=PCO_ConvertirRegistroXML($registro,"id,".$ListaCamposSinID_menu);
							$Contenido_XML .= "
	</core_menu>";
									$conteo_elementos_xml++;
								}
							//Agrega el total de elementos y resetea contador para el siguiente
									$Contenido_XML .= "
	<total_core_menu><cantidad_objetos>$conteo_elementos_xml</cantidad_objetos></total_core_menu>";
							$conteo_elementos_xml=0;

							// Finaliza el archivo XML
							$Contenido_XML .= "
</objetos_practicos>";

							PCO_Auditar("Crea copia $tipo_copia_objeto de formulario $formulario");

							//Guarda la cadena generada en el archivo XML
							if ($PCO_NombreArchivoXML=="")
        						$PCO_NombreArchivoXML="tmp/FormID_".$formulario."_".$PCO_FechaOperacion."_".$PCO_HoraOperacion.".xml";
							$PCO_PunteroArchivo = fopen($PCO_NombreArchivoXML, "w");
							if($PCO_PunteroArchivo==false)
								die("No se puede abrir el archivo de exportacion");
							fputs ($PCO_PunteroArchivo, $Contenido_XML);
							fclose ($PCO_PunteroArchivo);

							//Presenta la ventana con informacion y enlace de descarga
							?>
								<a class="btn btn-success btn-block" href="<?php echo $PCO_NombreArchivoXML; ?>" target="_BLANK" download><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_Descargar." ".$PCO_NombreArchivoXML; ?></a>
							<?php
						}
				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_AdministrarFormularios">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
    }


########################################################################
########################################################################
/*
	Function: PCO_ImportarXMLInforme
	Importa una cadena XML con la especificacion de un informe al sistema

	Variables de entrada:

		xml_importado - Cadena en notacion XML con todos los componentes necesarios del informe Formato: SimpleXMLElement

	Salida:

		Objetos generados a partir de la definicion de la cadena
*/
function PCO_ImportarXMLInforme($xml_importado)
    {
        global $_SeparadorCampos_,$TablasCore,$ListaCamposSinID_informe,$ConexionPDO,$ListaCamposSinID_informe_condiciones,$ListaCamposSinID_informe_tablas,$ListaCamposSinID_informe_campos,$ListaCamposSinID_informe_boton;
        $xml_importado = @simplexml_load_string($xml_importado); // Usa SimpleXML Directamente para interpretar cadena
				//Si es tipo estatico elimina el informe existente con el mismo ID
				$ListaCamposParaID="";
				$InterroganteParaID="";
				$ValorInsercionParaID="";
				if ($xml_importado->descripcion[0]->tipo_exportacion=="XML_IdEstatico")
					{
						$ListaCamposParaID="id,";
						$InterroganteParaID="?,";
						$ValorInsercionParaID=base64_decode($xml_importado->core_informe[0]->id).$_SeparadorCampos_;
						PCOFUNC_EliminarInforme(base64_decode($xml_importado->core_informe[0]->id));
					}

				// Establece valores para cada campo a insertar en el nuevo informe
				/* ##########################################################################################################*/
				/* ####### IMPORTANTE: Ajustes sobre esta funcion se deberian replicar en funcion de copia asociadas ########*/
				/* ##########################################################################################################*/
				$titulo=base64_decode($xml_importado->core_informe[0]->titulo);
				$descripcion=base64_decode($xml_importado->core_informe[0]->descripcion);
				$categoria=base64_decode($xml_importado->core_informe[0]->categoria);
				$agrupamiento=base64_decode($xml_importado->core_informe[0]->agrupamiento);
				$ordenamiento=base64_decode($xml_importado->core_informe[0]->ordenamiento);
				$ancho=base64_decode($xml_importado->core_informe[0]->ancho);
				$alto=base64_decode($xml_importado->core_informe[0]->alto);
				$formato_final=base64_decode($xml_importado->core_informe[0]->formato_final);
				$formato_grafico=base64_decode($xml_importado->core_informe[0]->formato_grafico);
				$genera_pdf=base64_decode($xml_importado->core_informe[0]->genera_pdf);
				$variables_filtro=base64_decode($xml_importado->core_informe[0]->variables_filtro);
				$soporte_datatable=base64_decode($xml_importado->core_informe[0]->soporte_datatable);
				$formulario_filtrado=base64_decode($xml_importado->core_informe[0]->formulario_filtrado);
				$tamano_paginacion=base64_decode($xml_importado->core_informe[0]->tamano_paginacion);
				$subtotales_columna=base64_decode($xml_importado->core_informe[0]->subtotales_columna);
				$subtotales_formato=base64_decode($xml_importado->core_informe[0]->subtotales_formato);
				$conexion_origen_datos=base64_decode($xml_importado->core_informe[0]->conexion_origen_datos);
				$consulta_sql=base64_decode($xml_importado->core_informe[0]->consulta_sql);
				$tooltip_titulo=base64_decode($xml_importado->core_informe[0]->tooltip_titulo);
				$exportar_dtclp=base64_decode($xml_importado->core_informe[0]->exportar_dtclp);
				$exportar_dtcsv=base64_decode($xml_importado->core_informe[0]->exportar_dtcsv);
				$exportar_dtxls=base64_decode($xml_importado->core_informe[0]->exportar_dtxls);
				$exportar_dtpdf=base64_decode($xml_importado->core_informe[0]->exportar_dtpdf);
				$ocultar_encabezado=base64_decode($xml_importado->core_informe[0]->ocultar_encabezado);
				$ocultar_piepagina=base64_decode($xml_importado->core_informe[0]->ocultar_piepagina);
				$anular_acciones=base64_decode($xml_importado->core_informe[0]->anular_acciones);
				$encabezado_html=base64_decode($xml_importado->core_informe[0]->encabezado_html);
				$tabla_responsive=base64_decode($xml_importado->core_informe[0]->tabla_responsive);
				$permitido_home=base64_decode($xml_importado->core_informe[0]->permitido_home);
				$javascript=base64_decode($xml_importado->core_informe[0]->javascript);
				$pre_script=base64_decode($xml_importado->core_informe[0]->pre_script);
				$post_script=base64_decode($xml_importado->core_informe[0]->post_script);
				$usar_ajax=base64_decode($xml_importado->core_informe[0]->usar_ajax);
				$definir_cols=base64_decode($xml_importado->core_informe[0]->definir_cols);
				$pane_activado=base64_decode($xml_importado->core_informe[0]->pane_activado);
				$pane_cascada=base64_decode($xml_importado->core_informe[0]->pane_cascada);
				$pane_colapsado=base64_decode($xml_importado->core_informe[0]->pane_colapsado);
				$pane_columnas=base64_decode($xml_importado->core_informe[0]->pane_columnas);
				$pane_subtotalesrelativos=base64_decode($xml_importado->core_informe[0]->pane_subtotalesrelativos);
				$pane_conteos=base64_decode($xml_importado->core_informe[0]->pane_conteos);
				$pane_controles=base64_decode($xml_importado->core_informe[0]->pane_controles);
				$pane_control_colapsar=base64_decode($xml_importado->core_informe[0]->pane_control_colapsar);
				$pane_control_ordenar=base64_decode($xml_importado->core_informe[0]->pane_control_ordenar);
				$modulo=base64_decode($xml_importado->core_informe[0]->modulo);

				// Inserta el nuevo informe
				PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."informe (".$ListaCamposParaID.$ListaCamposSinID_informe.") VALUES (".$InterroganteParaID."?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ","$ValorInsercionParaID$titulo$_SeparadorCampos_$descripcion$_SeparadorCampos_$categoria$_SeparadorCampos_$agrupamiento$_SeparadorCampos_$ordenamiento$_SeparadorCampos_$ancho$_SeparadorCampos_$alto$_SeparadorCampos_$formato_final$_SeparadorCampos_$formato_grafico$_SeparadorCampos_$genera_pdf$_SeparadorCampos_$variables_filtro$_SeparadorCampos_$soporte_datatable$_SeparadorCampos_$formulario_filtrado$_SeparadorCampos_$tamano_paginacion$_SeparadorCampos_$subtotales_columna$_SeparadorCampos_$subtotales_formato$_SeparadorCampos_$conexion_origen_datos$_SeparadorCampos_$consulta_sql$_SeparadorCampos_$tooltip_titulo$_SeparadorCampos_$exportar_dtclp$_SeparadorCampos_$exportar_dtcsv$_SeparadorCampos_$exportar_dtxls$_SeparadorCampos_$exportar_dtpdf$_SeparadorCampos_$ocultar_encabezado$_SeparadorCampos_$ocultar_piepagina$_SeparadorCampos_$anular_acciones$_SeparadorCampos_$encabezado_html$_SeparadorCampos_$tabla_responsive$_SeparadorCampos_$permitido_home$_SeparadorCampos_$javascript$_SeparadorCampos_$pre_script$_SeparadorCampos_$post_script$_SeparadorCampos_$usar_ajax$_SeparadorCampos_$definir_cols$_SeparadorCampos_$pane_activado$_SeparadorCampos_$pane_cascada$_SeparadorCampos_$pane_colapsado$_SeparadorCampos_$pane_columnas$_SeparadorCampos_$pane_subtotalesrelativos$_SeparadorCampos_$pane_conteos$_SeparadorCampos_$pane_controles$_SeparadorCampos_$pane_control_colapsar$_SeparadorCampos_$pane_control_ordenar$_SeparadorCampos_$modulo");

				//Determina el ID del registro
				if ($xml_importado->descripcion[0]->tipo_exportacion=="XML_IdEstatico")
					$idObjetoInsertado=base64_decode($xml_importado->core_informe[0]->id);
				else
					$idObjetoInsertado=PCO_ObtenerUltimoIDInsertado($ConexionPDO);

				// Busca los elementos que componen el informe para hacerles la copia
				//Determina cuantos campos tiene la tabla
				$ArregloCampos=explode(',',$ListaCamposSinID_informe_condiciones);
				$TotalCampos=count($ArregloCampos);
				// Registros de informe_condiciones
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_informe_condiciones[0]->cantidad_objetos;$PCO_i++)
					{
						//Genera cadena de interrogantes y valores segun cantidad de campos
						$CadenaInterrogantes='?'; //Agrega el primer interrogante
						$CadenaValores=$idObjetoInsertado;

						for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
							{
								//Cadena de interrogantes
								$CadenaInterrogantes.=',?';
								//Cadena de valores (el campo No 0 corresponde al ID de informe nuevo)
								if ($PCOCampo!=0)
									$CadenaValores.=$_SeparadorCampos_.base64_decode($xml_importado->core_informe_condiciones[$PCO_i]->{$ArregloCampos[$PCOCampo]});
								else
									$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
							}
						//Inserta el nuevo objeto al informe
						PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."informe_condiciones ($ListaCamposSinID_informe_condiciones) VALUES ($CadenaInterrogantes) ","$CadenaValores");
					}

				//Determina cuantos campos tiene la tabla
				$ArregloCampos=explode(',',$ListaCamposSinID_informe_tablas);
				$TotalCampos=count($ArregloCampos);
				// Registros de informe_tablas
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_informe_tablas[0]->cantidad_objetos;$PCO_i++)
					{
						//Genera cadena de interrogantes y valores segun cantidad de campos
						$CadenaInterrogantes='?'; //Agrega el primer interrogante
						$CadenaValores=$idObjetoInsertado;

						for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
							{
								//Cadena de interrogantes
								$CadenaInterrogantes.=',?';
								//Cadena de valores (el campo No 0 corresponde al ID de informe nuevo)
								if ($PCOCampo!=0)
									$CadenaValores.=$_SeparadorCampos_.base64_decode($xml_importado->core_informe_tablas[$PCO_i]->{$ArregloCampos[$PCOCampo]});
								else
									$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
							}
						//Inserta el nuevo objeto al informe
						PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."informe_tablas ($ListaCamposSinID_informe_tablas) VALUES ($CadenaInterrogantes) ","$CadenaValores");
					}

				//Determina cuantos campos tiene la tabla
				$ArregloCampos=explode(',',$ListaCamposSinID_informe_campos);
				$TotalCampos=count($ArregloCampos);
				// Registros de informe_campos
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_informe_campos[0]->cantidad_objetos;$PCO_i++)
					{
						//Genera cadena de interrogantes y valores segun cantidad de campos
						$CadenaInterrogantes='?'; //Agrega el primer interrogante
						$CadenaValores=$idObjetoInsertado;

						for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
							{
								//Cadena de interrogantes
								$CadenaInterrogantes.=',?';
								//Cadena de valores (el campo No 0 corresponde al ID de informe nuevo)
								if ($PCOCampo!=0)
									$CadenaValores.=$_SeparadorCampos_.base64_decode($xml_importado->core_informe_campos[$PCO_i]->{$ArregloCampos[$PCOCampo]});
								else
									$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
							}
						//Inserta el nuevo objeto al informe
						PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."informe_campos ($ListaCamposSinID_informe_campos) VALUES ($CadenaInterrogantes) ","$CadenaValores");
					}

				//Determina cuantos campos tiene la tabla
				$ArregloCampos=explode(',',$ListaCamposSinID_informe_boton);
				$TotalCampos=count($ArregloCampos);
				// Registros de informe_boton
				for ($PCO_i=0;$PCO_i<$xml_importado->total_core_informe_boton[0]->cantidad_objetos;$PCO_i++)
					{
						//Genera cadena de interrogantes y valores segun cantidad de campos
						$CadenaInterrogantes='?'; //Agrega el primer interrogante
						$CadenaValores=base64_decode($xml_importado->core_informe_boton[$PCO_i]->titulo);

						for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
							{
								//Cadena de interrogantes
								$CadenaInterrogantes.=',?';
								//Cadena de valores (el campo No 0 corresponde al ID de informe nuevo)
								if ($PCOCampo!=2)
									$CadenaValores.=$_SeparadorCampos_.base64_decode($xml_importado->core_informe_boton[$PCO_i]->{$ArregloCampos[$PCOCampo]});
								else
									$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
							}
						//Inserta el nuevo objeto al informe
						PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."informe_boton ($ListaCamposSinID_informe_boton) VALUES ($CadenaInterrogantes) ","$CadenaValores");
					}
        return $idObjetoInsertado;
    }


########################################################################
########################################################################
/*
	Function: PCO_ExportarXMLInforme
	Exporta las especificaciones de un informe a una cadena XML valida dentro de un archivo especificado

	Variables de entrada:

		informe - Identificador unico del informe que se desea exportar
		tipo_copia_objeto - Indica el tipo de copia que se hara del informe: EnLinea|XML_IdEstatico|XML_IdDinamico

	Salida:

		Archivo con el elemento exportado

	Ver tambien:
		<PCO_AdministrarFormularios>
*/
function PCO_ExportarXMLInforme($informe,$tipo_copia_objeto,$PCO_NombreArchivoXML="")
    {
        global $ArchivoCORE,$ListaCamposSinID_evento_objeto,$_SeparadorCampos_,$TablasCore,$ListaCamposSinID_formulario,$ConexionPDO,$ListaCamposSinID_formulario_objeto,$ListaCamposSinID_formulario_boton;
        global $MULTILANG_ErrorDatos,$MULTILANG_ErrorTiempoEjecucion,$MULTILANG_FrmMsjCopia,$MULTILANG_FrmTipoCopiaExporta,$MULTILANG_FrmCopiaFinalizada,$MULTILANG_IrEscritorio,$MULTILANG_Descargar;
        global $PCO_VersionActual,$Nombre_Aplicacion,$Version_Aplicacion,$PCOSESS_LoginUsuario,$PCO_FechaOperacionGuiones,$PCO_HoraOperacionPuntos,$PCO_FechaOperacion,$PCO_HoraOperacion;
        global $ListaCamposSinID_informe,$ListaCamposSinID_informe_condiciones,$ListaCamposSinID_informe_tablas,$ListaCamposSinID_informe_campos,$ListaCamposSinID_informe_boton;


			$mensaje_error="";
			if ($informe=="")
				$mensaje_error=$MULTILANG_ErrorTiempoEjecucion.".  No ingreso ID de Informe - Report ID not entered";
			if ($tipo_copia_objeto=="")
				$mensaje_error=$MULTILANG_ErrorTiempoEjecucion.".  No indicado modo de copia - Copy mode not entered";

			$Contenido_XML="";

			if ($mensaje_error=="")
				{
					//Hace la copia del objeto segun el tipo solicitado
					if ($tipo_copia_objeto=="EnLinea")
						{
							// Busca datos y Crea copia del informe
							$consulta=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_informe." FROM ".$TablasCore."informe WHERE id=?","$informe");
							$registro = $consulta->fetch();
							// Establece valores para cada campo a insertar en el nuevo informe
							/* ##########################################################################################################*/
							/* ####### IMPORTANTE:  Ajustes sobre esta funcionde copia se deberian replicar en importaciones XML ########*/
							/* ##########################################################################################################*/
							$titulo='[COPIA] '.$registro["titulo"];
							$descripcion=$registro["descripcion"];
							$categoria=$registro["categoria"];
							$agrupamiento=$registro["agrupamiento"];
							$ordenamiento=$registro["ordenamiento"];
							$ancho=$registro["ancho"];
							$alto=$registro["alto"];
							$formato_final=$registro["formato_final"];
							$formato_grafico=$registro["formato_grafico"];
							$genera_pdf=$registro["genera_pdf"];
							$variables_filtro=$registro["variables_filtro"];
							$soporte_datatable=$registro["soporte_datatable"];
							$formulario_filtrado=$registro["formulario_filtrado"];
							$tamano_paginacion=$registro["tamano_paginacion"];
							$subtotales_columna=$registro["subtotales_columna"];
							$subtotales_formato=$registro["subtotales_formato"];
							$conexion_origen_datos=$registro["conexion_origen_datos"];
							$consulta_sql=$registro["consulta_sql"];
							$tooltip_titulo=$registro["tooltip_titulo"];
							$exportar_dtclp=$registro["exportar_dtclp"];
							$exportar_dtcsv=$registro["exportar_dtcsv"];
							$exportar_dtxls=$registro["exportar_dtxls"];
							$exportar_dtpdf=$registro["exportar_dtpdf"];
							$ocultar_encabezado=$registro["ocultar_encabezado"];
							$ocultar_piepagina=$registro["ocultar_piepagina"];
							$anular_acciones=$registro["anular_acciones"];
							$encabezado_html=$registro["encabezado_html"];
							$tabla_responsive=$registro["tabla_responsive"];
							$permitido_home=$registro["permitido_home"];
							$javascript=$registro["javascript"];
							$pre_script=$registro["pre_script"];
							$post_script=$registro["post_script"];
							$usar_ajax=$registro["usar_ajax"];
							$definir_cols=$registro["definir_cols"];
							$pane_activado=$registro["pane_activado"];
							$pane_cascada=$registro["pane_cascada"];
							$pane_colapsado=$registro["pane_colapsado"];
							$pane_columnas=$registro["pane_columnas"];
							$pane_subtotalesrelativos=$registro["pane_subtotalesrelativos"];
							$pane_conteos=$registro["pane_conteos"];
							$pane_controles=$registro["pane_controles"];
							$pane_control_colapsar=$registro["pane_control_colapsar"];
							$pane_control_ordenar=$registro["pane_control_ordenar"];
							$modulo=$registro["modulo"];

							// Inserta el nuevo informe
							PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."informe (".$ListaCamposSinID_informe.") VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ","$titulo$_SeparadorCampos_$descripcion$_SeparadorCampos_$categoria$_SeparadorCampos_$agrupamiento$_SeparadorCampos_$ordenamiento$_SeparadorCampos_$ancho$_SeparadorCampos_$alto$_SeparadorCampos_$formato_final$_SeparadorCampos_$formato_grafico$_SeparadorCampos_$genera_pdf$_SeparadorCampos_$variables_filtro$_SeparadorCampos_$soporte_datatable$_SeparadorCampos_$formulario_filtrado$_SeparadorCampos_$tamano_paginacion$_SeparadorCampos_$subtotales_columna$_SeparadorCampos_$subtotales_formato$_SeparadorCampos_$conexion_origen_datos$_SeparadorCampos_$consulta_sql$_SeparadorCampos_$tooltip_titulo$_SeparadorCampos_$exportar_dtclp$_SeparadorCampos_$exportar_dtcsv$_SeparadorCampos_$exportar_dtxls$_SeparadorCampos_$exportar_dtpdf$_SeparadorCampos_$ocultar_encabezado$_SeparadorCampos_$ocultar_piepagina$_SeparadorCampos_$anular_acciones$_SeparadorCampos_$encabezado_html$_SeparadorCampos_$tabla_responsive$_SeparadorCampos_$permitido_home$_SeparadorCampos_$javascript$_SeparadorCampos_$pre_script$_SeparadorCampos_$post_script$_SeparadorCampos_$usar_ajax$_SeparadorCampos_$definir_cols$_SeparadorCampos_$pane_activado$_SeparadorCampos_$pane_cascada$_SeparadorCampos_$pane_colapsado$_SeparadorCampos_$pane_columnas$_SeparadorCampos_$pane_subtotalesrelativos$_SeparadorCampos_$pane_conteos$_SeparadorCampos_$pane_controles$_SeparadorCampos_$pane_control_colapsar$_SeparadorCampos_$pane_control_ordenar$_SeparadorCampos_$modulo");

							$idObjetoInsertado=PCO_ObtenerUltimoIDInsertado($ConexionPDO);

							// Busca los elementos que componen el informe para hacerles la copia
							//Determina cuantos condiciones tiene la tabla
							$ArregloCampos=explode(',',$ListaCamposSinID_informe_condiciones);
							$TotalCampos=count($ArregloCampos);
							// Registros de informe_condiciones
							$consulta=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."informe_condiciones WHERE informe=? ORDER BY peso,id","$informe");
							while($registro = $consulta->fetch())
								{
									//Genera cadena de interrogantes y valores segun cantidad de campos
									$CadenaInterrogantes='?'; //Agrega el primer interrogante
									$CadenaValores=$idObjetoInsertado;
									for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
										{
											//Cadena de interrogantes
											$CadenaInterrogantes.=',?';
											//Cadena de valores (el campo No 0 corresponde al ID de informe nuevo)
											if ($PCOCampo!=0)
												$CadenaValores.=$_SeparadorCampos_.$registro[$PCOCampo+1];
											else
												$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
										}
									//Inserta el nuevo objeto al informe
									PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."informe_condiciones ($ListaCamposSinID_informe_condiciones) VALUES ($CadenaInterrogantes) ","$CadenaValores");
								}

							//Determina cuantos tablas tiene la tabla
							$ArregloCampos=explode(',',$ListaCamposSinID_informe_tablas);
							$TotalCampos=count($ArregloCampos);
							// Registros de informe_tablas
							$consulta=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."informe_tablas WHERE informe=? ","$informe");
							while($registro = $consulta->fetch())
								{
									//Genera cadena de interrogantes y valores segun cantidad de campos
									$CadenaInterrogantes='?'; //Agrega el primer interrogante
									$CadenaValores=$idObjetoInsertado;
									for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
										{
											//Cadena de interrogantes
											$CadenaInterrogantes.=',?';
											//Cadena de valores (el campo No 0 corresponde al ID de informe nuevo)
											if ($PCOCampo!=0)
												$CadenaValores.=$_SeparadorCampos_.$registro[$PCOCampo+1];
											else
												$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
										}
									//Inserta el nuevo objeto al informe
									PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."informe_tablas ($ListaCamposSinID_informe_tablas) VALUES ($CadenaInterrogantes) ","$CadenaValores");
								}


							//Determina cuantos campos tiene la tabla
							$ArregloCampos=explode(',',$ListaCamposSinID_informe_campos);
							$TotalCampos=count($ArregloCampos);
							// Registros de informe_campos
							$consulta=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."informe_campos WHERE informe=? ORDER BY peso,id","$informe");
							while($registro = $consulta->fetch())
								{
									//Genera cadena de interrogantes y valores segun cantidad de campos
									$CadenaInterrogantes='?'; //Agrega el primer interrogante
									$CadenaValores=$idObjetoInsertado;
									for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
										{
											//Cadena de interrogantes
											$CadenaInterrogantes.=',?';
											//Cadena de valores (el campo No 0 corresponde al ID de informe nuevo)
											if ($PCOCampo!=0)
												$CadenaValores.=$_SeparadorCampos_.$registro[$PCOCampo+1];
											else
												$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
										}
									//Inserta el nuevo objeto al informe
									PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."informe_campos ($ListaCamposSinID_informe_campos) VALUES ($CadenaInterrogantes) ","$CadenaValores");
								}

							//Determina cuantos botones tiene la tabla
							$ArregloCampos=explode(',',$ListaCamposSinID_informe_boton);
							$TotalCampos=count($ArregloCampos);
							// Registros de informe_boton
							$consulta=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."informe_boton WHERE informe=? ORDER BY peso,id","$informe");
							while($registro = $consulta->fetch())
								{
									//Genera cadena de interrogantes y valores segun cantidad de campos
									$CadenaInterrogantes='?'; //Agrega el primer interrogante
									$CadenaValores=$registro[1];
									for ($PCOCampo=1;$PCOCampo<$TotalCampos;$PCOCampo++)
										{
											//Cadena de interrogantes
											$CadenaInterrogantes.=',?';
											//Cadena de valores (el campo No 0 corresponde al ID de informe nuevo)
											if ($PCOCampo!=2)
												$CadenaValores.=$_SeparadorCampos_.$registro[$PCOCampo+1];
											else
												$CadenaValores.=$_SeparadorCampos_.$idObjetoInsertado;
										}
									//Inserta el nuevo objeto al informe
									PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."informe_boton ($ListaCamposSinID_informe_boton) VALUES ($CadenaInterrogantes) ","$CadenaValores");
								}

							PCO_Auditar("Crea copia de informe $informe");

							//Presenta la ventana con informacion y enlace de descarga
							?>
								<form action="<?php echo $ArchivoCORE; ?>" method="POST" name="det<?php echo $idObjetoInsertado; ?>" id="det<?php echo $idObjetoInsertado; ?>">
										<input type="hidden" name="PCO_Accion" value="PCO_EditarInforme">
										<input type="hidden" name="informe" value="<?php echo $idObjetoInsertado; ?>">
										<input type="hidden" name="PCO_Valor" value="<?php echo $idObjetoInsertado; ?>">
								        <a class="btn btn-success btn-block" href="javascript:document.det<?php echo $idObjetoInsertado; ?>.submit();"><i class="fa fa-pencil"></i> <?php echo $MULTILANG_Editar." <b>".$titulo."</b>"; ?></a>
								</form>
							<?php
						}


					//Hace la copia del objeto segun el tipo solicitado
					if ($tipo_copia_objeto=="XML_IdEstatico" || $tipo_copia_objeto=="XML_IdDinamico")
						{
							// Inicia el archivo XML
							$Contenido_XML.="<?xml version=\"1.0\" encoding=\"utf-8\" ?>
<objetos_practicos>
	<descripcion>
		<tipo_objeto>Informe</tipo_objeto>
		<version_practico>$PCO_VersionActual</version_practico>
		<tipo_exportacion>$tipo_copia_objeto</tipo_exportacion>
		<sistema_origen>$Nombre_Aplicacion</sistema_origen>
		<version>$Version_Aplicacion</version>
		<usuario_generador>$PCOSESS_LoginUsuario</usuario_generador>
		<fecha_exportacion>$PCO_FechaOperacionGuiones</fecha_exportacion>
		<hora_exportacion>$PCO_HoraOperacionPuntos</hora_exportacion>
	</descripcion>";
							// Exporta tabla core_informe
							$Contenido_XML .= "
	<core_informe>";
							// Busca datos y genera XML de cada registro
							$consulta=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_informe." FROM ".$TablasCore."informe WHERE id=?","$informe");
							$registro = $consulta->fetch();
							$Contenido_XML .=PCO_ConvertirRegistroXML($registro,"id,".$ListaCamposSinID_informe);
							$Contenido_XML .= "
	</core_informe>";
							// Registros de informe_boton
							$consulta=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."informe_boton WHERE informe=? ORDER BY peso,id","$informe");
							$conteo_elementos_xml=0;
							while($registro = $consulta->fetch())
								{
									//Exporta la tabla de core_informe_boton
									$Contenido_XML .= "
	<core_informe_boton>";
									$Contenido_XML .=PCO_ConvertirRegistroXML($registro,"id,".$ListaCamposSinID_informe_boton);
							$Contenido_XML .= "
	</core_informe_boton>";
									$conteo_elementos_xml++;
								}
							//Agrega el total de elementos y resetea contador para el siguiente
									$Contenido_XML .= "
	<total_core_informe_boton><cantidad_objetos>$conteo_elementos_xml</cantidad_objetos></total_core_informe_boton>";
							$conteo_elementos_xml=0;

							// Registros de informe_campos
							$consulta=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."informe_campos WHERE informe=? ORDER BY peso,id","$informe");
							while($registro = $consulta->fetch())
								{
									//Exporta la tabla de core_informe_campos
									$Contenido_XML .= "
	<core_informe_campos>";
									$Contenido_XML .=PCO_ConvertirRegistroXML($registro,"id,".$ListaCamposSinID_informe_campos);
							$Contenido_XML .= "
	</core_informe_campos>";
									$conteo_elementos_xml++;
								}
							//Agrega el total de elementos y resetea contador para el siguiente
									$Contenido_XML .= "
	<total_core_informe_campos><cantidad_objetos>$conteo_elementos_xml</cantidad_objetos></total_core_informe_campos>";
							$conteo_elementos_xml=0;

							// Registros de informe_condiciones
							$consulta=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."informe_condiciones WHERE informe=? ORDER BY peso,id","$informe");
							while($registro = $consulta->fetch())
								{
									//Exporta la tabla de core_informe_condiciones
									$Contenido_XML .= "
	<core_informe_condiciones>";
									$Contenido_XML .=PCO_ConvertirRegistroXML($registro,"id,".$ListaCamposSinID_informe_condiciones);
							$Contenido_XML .= "
	</core_informe_condiciones>";
									$conteo_elementos_xml++;
								}
							//Agrega el total de elementos y resetea contador para el siguiente
									$Contenido_XML .= "
	<total_core_informe_condiciones><cantidad_objetos>$conteo_elementos_xml</cantidad_objetos></total_core_informe_condiciones>";
							$conteo_elementos_xml=0;

							// Registros de informe_tablas
							$consulta=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."informe_tablas WHERE informe=?","$informe");
							while($registro = $consulta->fetch())
								{
									//Exporta la tabla de core_informe_tablas
									$Contenido_XML .= "
	<core_informe_tablas>";
									$Contenido_XML .=PCO_ConvertirRegistroXML($registro,"id,".$ListaCamposSinID_informe_tablas);
							$Contenido_XML .= "
	</core_informe_tablas>";
									$conteo_elementos_xml++;
								}
							//Agrega el total de elementos y resetea contador para el siguiente
									$Contenido_XML .= "
	<total_core_informe_tablas><cantidad_objetos>$conteo_elementos_xml</cantidad_objetos></total_core_informe_tablas>";
							$conteo_elementos_xml=0;

							// Finaliza el archivo XML
							$Contenido_XML .= "
</objetos_practicos>";

							PCO_Auditar("Crea copia $tipo_copia_objeto de informe $informe");

							//Guarda la cadena generada en el archivo XML
							if ($PCO_NombreArchivoXML=="")
        						$PCO_NombreArchivoXML="tmp/RepID_".$informe."_".$PCO_FechaOperacion."_".$PCO_HoraOperacion.".xml";
							$PCO_PunteroArchivo = fopen($PCO_NombreArchivoXML, "w");
							if($PCO_PunteroArchivo==false)
								die("No se puede abrir el archivo de exportacion");
							fputs ($PCO_PunteroArchivo, $Contenido_XML);
							fclose ($PCO_PunteroArchivo);

							//Presenta la ventana con informacion y enlace de descarga
							?>
								<a class="btn btn-success btn-block" href="<?php echo $PCO_NombreArchivoXML; ?>" target="_BLANK" download><i class="fa fa-floppy-o"></i> <?php echo $MULTILANG_Descargar." ".$PCO_NombreArchivoXML; ?></a>
							<?php
						}

				}
			else
				{
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
						<input type="Hidden" name="PCO_Accion" value="PCO_AdministrarInformes">
						<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
						<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
						</form>
						<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
				}
    }


########################################################################
########################################################################
/*
	// Function: PCO_ManejadorExcepciones
	Captura las excepciones generados por PHP durante la ejecucion y las presenta al usuario

	Salida:
		Mensajes de alerta en pantalla con los detalles entregados por PHP
*/
function PCO_ManejadorExcepciones($DetalleExcepcion)
    {
        global $ModoDepuracion,$MULTILANG_Atencion,$MULTILANG_Archivo;
        if ($ModoDepuracion)
            {
                $Detalles=error_get_last();
                if ($Detalles!=null)
                    {
                        $Tipo=@$Detalles["type"];
                        $Mensaje=@$Detalles["message"];
                        $Archivo=@$Detalles["file"];
                        $Linea=@$Detalles["line"];
                        if ($Archivo!="" && $Mensaje!="")
                            PCO_Mensaje($MULTILANG_Atencion." (PHP Exception cod $Tipo)","$Archivo (linea $Linea)<br>$Mensaje", '', 'fa fa-exclamation-triangle texto-rojo texto-blink', 'alert alert-warning');
                    }
            }
    }


########################################################################
########################################################################
/*
	// Function: PCO_ManejadorErrores
	Captura los errores generados por PHP durante la ejecucion y los presenta al usuario

	Salida:
		Mensajes de alerta en pantalla con los detalles entregados por PHP
*/
function PCO_ManejadorErrores($DetalleExcepcion)
    {
        global $ModoDepuracion,$MULTILANG_Atencion,$MULTILANG_Archivo;
        if ($ModoDepuracion)
            {
                $Detalles=error_get_last();
                if ($Detalles!=null)
                    {
                        $Tipo=@$Detalles["type"];
                        $Mensaje=@$Detalles["message"];
                        $Archivo=@$Detalles["file"];
                        $Linea=@$Detalles["line"];
                        if ($Archivo!="" && $Mensaje!="")
                            PCO_Mensaje($MULTILANG_Atencion." (PHP Error cod $Tipo)","$Archivo (linea $Linea)<br>$Mensaje", '', 'fa fa-exclamation-triangle texto-rojo texto-blink', 'alert alert-danger');
                    }
            }
    }


########################################################################
########################################################################
/*
	// Function: PCO_BuscarErroresSintaxisPHP
	Verifica la sintaxis de un archivo PHP.  Utilizada normalmente antes de cualquier inclusion para evitar que se incluyan archivos con errores del lado del usuario.

	Variables de entrada:

		ArchivoFuente - Archivo que se desea verificar sintaxis
		Funcion exec - Activada en PHP

	Salida:
		0 si no hay errores de sintaxis
		1 si hay errores ademas de los mensajes en la salida estandar
*/
function PCO_BuscarErroresSintaxisPHP($ArchivoFuente,$ByPassSintaxis=0,$DescComplemento="")
    {
		//Hace el proceso de verificacion solamente en plataformas diferentes a Windows.  Windows no lo permite a menos que se especifique el path completo de PHP
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' || strtoupper(PHP_OS) === 'FREEBSD' || strtoupper(PHP_OS) === 'OPENBSD')
			{
				//Se omite verificacion de sintaxis
				/*Otros posibles hosts
				CYGWIN_NT-5.1
                Darwin
                FreeBSD
                HP-UX
                IRIX64
                Linux
                NetBSD
                OpenBSD
                SunOS
                Unix
				*/

				return 0;
			}
		else
			{
				global $MULTILANG_ErrorTiempoEjecucion,$MULTILANG_Detalles,$PCO_ChequeoDinamicoSintaxis;
				$SalidaFuncion=0;
				if ($PCO_ChequeoDinamicoSintaxis=="1" || $ByPassSintaxis=="1")
				    {
        				if (@exec('php -l '.escapeshellarg($ArchivoFuente), $Salida, $Codigo)===false)
                            throw new \RuntimeException('Detectado error de sintaxis en'.escapeshellarg($ArchivoFuente));

        				if ($Codigo)  //Si se tiene un valor diferente de cero retornado por el comando
        					{
        						PCO_Mensaje($MULTILANG_ErrorTiempoEjecucion,"PHP retorna: <i>".$Salida[0].$Salida[1].$Salida[2]."<i>.  <b>Valide su sintaxis para ser incluido sin problemas</b>.  {$DescComplemento}", '', 'fa fa-exclamation-triangle fa-3x texto-rojo texto-blink', 'alert alert-danger alert-dismissible');
        						$SalidaFuncion=1;
        					}
				    }
				return $SalidaFuncion;
			}
    }


########################################################################
########################################################################
/*
	Function: PCO_ReemplazarVariablesPHPEnCadena
	Devuelve una cadena evaluada donde se reemplazan las expresiones de variables PHP con el formato {$variable} por su valor definido

	Variables de entrada:

		cadena_original - Cadena con las variables expresadas

	Salida:

		Cadena con las variables reemplazadas

	Ver tambien:
		<PCO_ConstruirConsultaInforme>
*/
function PCO_ReemplazarVariablesPHPEnCadena($cadena_original,$PCO_RegistroDatosFormulario="")
	{
	    //Reemplaza todas las ocurrencias de variables por el valor de la misma en su variable global
        $cadena_final = preg_replace_callback('~\{\$(.*?)\}~si',    //Aqui sigue la funcion de CallBack (ANTES de vers. 19.9 era funcion independiente sin recepcion de parametros)
                                                                    function  ($ocurrencia) use ($PCO_RegistroDatosFormulario)
                                                                    	{
                                                                            //Declara la variable como global, pues no se sabe qué variable y en qué ambito se encuentra
                                                                            //Busca si tiene corchetes (porque puede ser un arreglo)
                                                                            if (strpos ($ocurrencia[1] , "[") !== false && strpos ($ocurrencia[1] , "]") !== false)
                                                                                {
                                                                                    $VariableRealArreglo=strstr ( $ocurrencia[1]  , "[", TRUE );
                                                                                    $PosicionArreglo=str_replace ( $VariableRealArreglo."[" , "" , $ocurrencia[1] );
                                                                                    $PosicionArreglo=strstr ( $PosicionArreglo  , "]", TRUE );
                                                                                    //Si la variable es la de contenido de registros de practico
                                                                                    if ($VariableRealArreglo=="PCO_RegistroDatosActivo")
                                                                                        return $PCO_RegistroDatosFormulario[$PosicionArreglo];
                                                                                    else
                                                                                        return;
                                                                                }
                                                                            else
                                                                                {
                                                                                    global ${$ocurrencia[1]};
                                                                                    //Obtiene el valor de la variable
                                                                                    //return eval('return $' . $ocurrencia[1] . ';');  //Funcion eval reemplazada por seguridad
                                                                                    return ${$ocurrencia[1]};                
                                                                                }
                                                                    	}  
                                                                    ,$cadena_original);
		return $cadena_final;
	}


########################################################################
########################################################################
/*
	// Function: PCO_DistanciaDosCoordenadas
	Retorna el nombre legible de una direccion (en lenguaje natural) indicados por latitud y longitud

	Variables de entrada:

		Latitud - Asociada al punto deseado			Ejemplos Furatena: 6.249326, -75.565550    Castropol:  6.217010, -75.566734
		Longitud - Asociada al punto deseado
		APIKey_GoogleMaps - Utilizada para hacer el llamado a la API

	Salida:
		Arreglo con todos los resultados
*/
function PCO_DireccionPorCoordenas($Latitud, $Longitud, $APIKey_GoogleMaps)
	{
		$URLMaps = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$Latitud.",".$Longitud."&key=".$APIKey_GoogleMaps."&language=es";
		$DatosRecibidos = @PCO_CargarURL($URLMaps);
		return json_decode($DatosRecibidos, true);
	}


########################################################################
########################################################################
/*
	// Function: PCO_DireccionPorIDSitio
	Retorna el nombre legible de una direccion (en lenguaje natural) indicados por el PlaceID usado por Google

	Variables de entrada:

		PlaceID - Asociada al punto deseado			Ejemplo Castropol:  EkNDbC4gMTcgIzM3YS05NiBhIDM3YS0xNzIsIE1lZGVsbMOtbiwgTWVkZWxsw61uLCBBbnRpb3F1aWEsIENvbG9tYmlh
		APIKey_GoogleMaps - Utilizada para hacer el llamado a la API

	Salida:
		Arreglo con todos los resultados
*/
function PCO_DireccionPorIDSitio($PlaceID, $APIKey_GoogleMaps)
	{
		$URLMaps = "https://maps.googleapis.com/maps/api/geocode/json?place_id=".$PlaceID."&key=".$APIKey_GoogleMaps."&language=es";
		$DatosRecibidos = @PCO_CargarURL($URLMaps);
		return json_decode($DatosRecibidos, true);
	}



########################################################################
########################################################################
/*
	// Function: PCO_DistanciaDosCoordenadas
	Retorna la distancia entre dos puntos indicados por latitud y longitud

	Variables de entrada:

		Punto1 - Determinado por latitud1 y longitud1
		Punto1 - Determinado por latitud2 y longitud2
		UnidadMedida - Determinado por latitud y longitud   m=metros|km=kilometros|mi=millas

	Salida:
		Valor de la distancia expresado en la unidad solicitada

	Adicionales:
		* http://stackoverflow.com/questions/29003118/get-driving-distance-between-two-points-using-google-maps-api
		* http://stackoverflow.com/questions/14041227/distance-from-point-a-to-b-using-google-maps-php-and-mysql  ver working example
		* http://jafrancov.com/2011/06/geocode-gmaps-api-v3/
*/
function PCO_DistanciaCoordenadasSimple($Latitud1, $Longitud1, $Latitud2, $Longitud2, $UnidadMedida="m")
	{
		$theta = $Longitud1 - $Longitud2;
		$Millas = (sin(deg2rad($Latitud1)) * sin(deg2rad($Latitud2))) + (cos(deg2rad($Latitud1)) * cos(deg2rad($Latitud2)) * cos(deg2rad($theta)));
		$Millas = acos($Millas);
		$Millas = rad2deg($Millas);
		$Millas = $Millas * 60 * 1.1515;
		if ($UnidadMedida=="mi")
			return $Millas;
		$Kilometros = $Millas * 1.609344;
		if ($UnidadMedida=="km")
			return $Kilometros;
		return $Kilometros/1000;//retorna metros
	}


########################################################################
########################################################################
/*
	// Function: PCO_EsDispositivoMovil
	Determina si la aplicacion esta corriendo en un dispositivo movil o PC de escritorio segun el agente reportado

	Variables de entrada:

		HTTP_USER_AGENT - Tomada desde el entorno

	Salida:
		Verdadero o falso segun el navegador del usuario

*/
function PCO_EsDispositivoMovil()
	{
		$aMobileUA = array(
			'/iphone/i' => 'iPhone',
			'/ipod/i' => 'iPod',
			'/ipad/i' => 'iPad',
			'/android/i' => 'Android',
			'/blackberry/i' => 'BlackBerry',
			'/webos/i' => 'Mobile'
			);

		//Retorna verdadero si es detectado un agente de usuario movil
		foreach($aMobileUA as $sMobileKey => $sMobileOS)
			{
				if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT']))
					{
						return true;
					}
			}
		//En otro caso retorna falso
		return false;
	}


########################################################################
########################################################################
/*
	// Function: PCO_EsUsuarioInterno
	Determina si un login de usuario es corresponde a un usuario interno o no

	Variables de entrada:

		Usuario - Login de usuario a verificar

	Salida:
		Cero (0) o uno (1) segun la pertenencia o no del usuario
*/
function PCO_EsUsuarioInterno($Usuario)
	{
	    global $ListaCamposSinID_usuario,$TablasCore;
	    $RegistroUsuario=PCO_EjecutarSQL("SELECT $ListaCamposSinID_usuario FROM ".$TablasCore."usuario WHERE login='$Usuario' ")->fetch();
	    return $RegistroUsuario["usuario_interno"];
	}


########################################################################
########################################################################
/*
	// Function: PCO_EsAdministrador
	Determina si un login de usuario es administrador de plataforma o no (si es super usuario)

	Variables de entrada:

		Usuario - Login de usuario a verificar

	Salida:
		Cero (0) o uno (1) segun la pertenencia o no del usuario al grupo de admins
*/
function PCO_EsAdministrador($Usuario)
	{
		global $PCOVAR_Administradores;
		$ArregloAdmins=explode(",",$PCOVAR_Administradores);

		//Recorre el arreglo de super-usuarios
		$Resultado = 0;
		if ($Usuario!="")
			foreach ($ArregloAdmins as $UsuarioAdmin)
				{
					if (trim($UsuarioAdmin)==$Usuario)
						$Resultado = 1;
				}
		return $Resultado;
	}


########################################################################
########################################################################
/*
	// Function: PCO_BackupObtenerDatosTabla
	Recupera los datos en formato Insert asociados a una tabla

	Variables de entrada:

		PCO_NombreTabla - Nombre de la tabla de la que se desea obtener los datos

	Salida:
		Sentencias necesarias para insertar los datos en las tablas
*/
function PCO_BackupObtenerDatosTabla($PCO_NombreTabla,$codificacion_actual,$codificacion_destino,$transliterar_conversion)
	{
		$RegistrosEncontrados = PCO_EjecutarSQL('SELECT * FROM '.$PCO_NombreTabla)->fetchAll(PDO::FETCH_NUM);
		$Datos = '';
		foreach ($RegistrosEncontrados as $Registro)
			{
				foreach($Registro as &$Valor)
					{
						//Determina si se quiere un cambio de codificacion de caracteres y lo ejecuta
						if ($codificacion_destino!="")
							{
								//Determina si se tiene o no transliteracion
								$ComplementoTransliteracion="";
								if($transliterar_conversion==1)
									$ComplementoTransliteracion="//TRANSLIT";
								if($transliterar_conversion==2)
									$ComplementoTransliteracion="//IGNORE";
								if($transliterar_conversion==3)
									$ComplementoTransliteracion="//IGNORE//TRANSLIT";
								//Hace la conversion de la cadena
								$Valor = iconv($codificacion_actual,$codificacion_destino.$ComplementoTransliteracion,$Valor);
							}
						$Valor = htmlentities(addslashes($Valor));
					}
				$Datos .= 'INSERT INTO '. $PCO_NombreTabla .' VALUES (\'' . implode('\',\'', $Registro) . '\');'."\n";
			}
		return $Datos;
	}


########################################################################
########################################################################
/*
	// Function: PCO_BackupObtenerColumnasTabla
	Recupera los campos asociados a una tabla de datos

	Variables de entrada:

		PCO_NombreTabla - Nombre de la tabla de la que se desea obtener la estructura

	Salida:
		Sentencia de creacion de la tabla
*/
function PCO_BackupObtenerColumnasTabla($PCO_NombreTabla="")
	{
		$ConsultaCreate = PCO_EjecutarSQL('SHOW CREATE TABLE '.$PCO_NombreTabla)->fetchAll();
		$ConsultaCreate[0][1] = preg_replace("/AUTO_INCREMENT=[\w]*./", '', $ConsultaCreate[0][1]);
		return $ConsultaCreate[0][1].";"."\n";
	}


########################################################################
########################################################################
/*
	// Function: PCO_BackupObtenerTablasBD
	Recupera las tablas desde la base de datos

	Variables de entrada:

		PCO_ListaTablas - Lista de tablas separadas por coma o simbolo * para todas las tablas

	Salida:
		Retorna un arreglo con todas las tablas y su backup dividido en tres campos logicos de Nombre, SentenciaCreate y SentenciaInsert
		Retorna 0 cuando se obtiene algun error
*/
function PCO_BackupObtenerTablasBD($PCO_ListaTablas,$TipoDeCopia,$codificacion_actual,$codificacion_destino,$transliterar_conversion)
	{
	    if ($TipoDeCopia=="") $TipoDeCopia="Estructura";
		$TablasExistentes = PCO_EjecutarSQL('SHOW TABLES')->fetchAll();
		$TablasSolicitadasBackup=explode(",",$PCO_ListaTablas);
		$i=0;
		foreach($TablasExistentes as $Tabla)
			{
				//Determina si la tabla esta dentro de las deseadas para backup
				if (in_array($Tabla[0],$TablasSolicitadasBackup) || $PCO_ListaTablas=="*")
					{
						$ArregloFinalTablas[$i]['Nombre']=$Tabla[0];
						if ($TipoDeCopia=="Estructura" || $TipoDeCopia=="Estructura+Datos")
							$ArregloFinalTablas[$i]['SentenciaCreate']=PCO_BackupObtenerColumnasTabla($Tabla[0]);
						if ($TipoDeCopia=="Datos" || $TipoDeCopia=="Estructura+Datos")
							$ArregloFinalTablas[$i]['SentenciaInsert']=PCO_BackupObtenerDatosTabla($Tabla[0],$codificacion_actual,$codificacion_destino,$transliterar_conversion);
						$i++;
					}
			}
		return $ArregloFinalTablas;
	}


########################################################################
########################################################################
/*
	// Function: PCO_Backup
	Ejecuta un respaldo parcial o total de la base de datos sobre un archivo determinado

	Variables de entrada:

		PCO_ListaTablas - Lista de tablas separadas por coma o simbolo * para todas las tablas
		TipoDeCopia - Lista de tablas separadas por coma  Estructura|Datos|Estructura+Datos
		ArchivoDestino - Ruta completa al archivo de destino del backup

	Salida:
		Retorna 1 ante un proceso exitoso
		Retorna 0 cuando se obtiene algun error
*/
function PCO_Backup($PCO_ListaTablas,$ArchivoDestino="",$TipoDeCopia="Estructura",$codificacion_actual="UTF-8",$codificacion_destino="UTF-8",$transliterar_conversion=0)
	{
		$EstadoOperacion=1;  //Asume que no hay errores
		$ContenidoBackup="";
		if ($ArchivoDestino=="") $EstadoOperacion=0;

		//Si no hay errores continua con el proceso
		if ($EstadoOperacion==1)
			{
				//Lanza el proceso de copia
				$ArregloContenidos=PCO_BackupObtenerTablasBD($PCO_ListaTablas,$TipoDeCopia,$codificacion_actual,$codificacion_destino,$transliterar_conversion);
				//Recorre las tablas agregando todo al Backup
				for($i=0;$i<count($ArregloContenidos);$i++)
					{
						if ($TipoDeCopia=="Estructura" || $TipoDeCopia=="Estructura+Datos")
							$ContenidoBackup.=$ArregloContenidos[$i]['SentenciaCreate'];
						if ($TipoDeCopia=="Datos" || $TipoDeCopia=="Estructura+Datos")
							$ContenidoBackup.=$ArregloContenidos[$i]['SentenciaInsert'];
					}

				// Comprime el archivo resultante y lo guarda
				$resultado_backup_comprimido = gzencode($ContenidoBackup, 9);
				$puntero_archivo_destino_backup_bdd = fopen($ArchivoDestino, "w");
				fwrite($puntero_archivo_destino_backup_bdd, $resultado_backup_comprimido);
				fclose($puntero_archivo_destino_backup_bdd);
			}
		//Retorna el resultado general de la operacion de copia
		return $EstadoOperacion;
	}


########################################################################
########################################################################
/*
	// Function: PCO_SegmentarSQL
	Divide una cadena completa en sentencias SQL independientes para ser ejecutadas una a una

	Variables de entrada:

		sql - Cadena completa de sentencias

	Salida:
		Cadena SQL dividida
*/
//Divide los queries de un cadena
function PCO_SegmentarSQL($sql)
	{
		$sql = trim($sql);
		$sql = preg_replace("/\n#[^\n]*\n/", "\n", $sql);

		$buffer = array();
		$ret = array();
		$in_string = false;

		for($i=0; $i<strlen($sql)-1; $i++) {
			if($sql[$i] == ";" && !$in_string) {
				$ret[] = substr($sql, 0, $i);
				$sql = substr($sql, $i + 1);
				$i = 0;
			}

			if($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\") {
				$in_string = false;
			}
			elseif(!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\")) {
				$in_string = $sql[$i];
			}
			if(isset($buffer[1])) {
				$buffer[0] = $buffer[1];
			}
			$buffer[1] = $sql[$i];
		}

		if(!empty($sql)) {
			$ret[] = $sql;
		}
		return($ret);
	}


########################################################################
########################################################################
/*
	Function: PCO_CopiarPermisos
	Copia los permisos definidos para un usuario origen en otro especificado por destino

	Variables de entrada:

		usuariod - Usuario destino (al que seran copiados los permisos)
		usuarioo - Usuario oorigen (del que se toman los permisos como base para ser copiados)

	Salida:
		Registros de permisos actualizados en BD
*/
function PCO_CopiarPermisos($usuario_origen="",$usuario_destino="")
    {
		global $TablasCore,$ListaCamposSinID_usuario_menu,$_SeparadorCampos_;
		// Elimina opciones existentes
		PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."usuario_menu WHERE usuario=? ","$usuario_destino");
		// Copia permisos si el usuario origen es diferente de vacio, sino lo deja sin nada
        if ($usuario_origen!="")
            {
                $resultado=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_usuario_menu." FROM ".$TablasCore."usuario_menu WHERE usuario='$usuario_origen' ");
                while($registro = $resultado->fetch())
                    {
                        $menuinsertar=$registro["menu"];
                        PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."usuario_menu (".$ListaCamposSinID_usuario_menu.") VALUES (?,?)","$usuario_destino$_SeparadorCampos_$menuinsertar");
                    }
            }
    }


########################################################################
########################################################################
/*
	Function: PCO_CopiarInformes
	Copia los informes definidos para un usuario origen en otro especificado por destino

	Variables de entrada:

		usuariod - Usuario destino (al que seran copiados los permisos)
		usuarioo - Usuario oorigen (del que se toman los permisos como base para ser copiados)

	Salida:
		Registros de permisos actualizados en BD
*/
function PCO_CopiarInformes($usuario_origen="",$usuario_destino="")
    {
		global $TablasCore,$ListaCamposSinID_usuario_informe,$_SeparadorCampos_;
		// Elimina opciones existentes
		PCO_EjecutarSQLUnaria("DELETE FROM ".$TablasCore."usuario_informe WHERE usuario=? ","$usuario_destino");
		// Copia permisos si el usuario origen es diferente de vacio, sino lo deja sin nada
        if ($usuario_origen!="")
            {
                $resultado=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_usuario_informe." FROM ".$TablasCore."usuario_informe WHERE usuario='$usuario_origen' ");
                while($registro = $resultado->fetch())
                    {
                        $menuinsertar=$registro["informe"];
                        PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."usuario_informe (".$ListaCamposSinID_usuario_informe.") VALUES (?,?)","$usuario_destino$_SeparadorCampos_$menuinsertar");
                    }
            }
    }


########################################################################
########################################################################
/*
	Function: PCO_ListadoExploracionArchivos
	Construye una lista de los archivos contenidos en una carpeta y que coinciden con un flitro determinado

	Variables de entrada:

		RutaExploracion - El Path donde se desean buscar los archivos, preferible terminando en /
		Filtro_contenido - Un texto que debe ser contenido en el nombre de archivo para poder ser presentado.  Vacio indica cualquier archivo

	Salida:
		Arreglo de elementos asociados a cada archivo encontrado
*/
function PCO_ListadoExploracionArchivos($RutaExploracion="",$Filtro_contenido="")
    {
        $PCO_ListadoArchivos=array();
        //Si la ruta de exploracion es diferente de vacio hace el proceso de busqueda de archivos
        if ($RutaExploracion!="")
            {
                $ContenidoDirectorio = opendir($RutaExploracion);
                while (($Elemento = readdir($ContenidoDirectorio)) !== false)
                    {
                        if (($Elemento != ".") && ($Elemento != "..") && (stristr($Elemento,$Filtro_contenido) || $Filtro_contenido=="")  )
                            {
                                $TamanoElemento=round(filesize($RutaExploracion.$Elemento)/1024);
                                $TipoElemento=filetype($RutaExploracion.$Elemento);
                                $FechaElemento=date("d F Y H:i:s", filemtime($RutaExploracion.$Elemento));
                                $EnlaceElemento=$RutaExploracion.$Elemento;
                                $PCO_ListadoArchivos[]=array(Ruta => $RutaExploracion, Nombre=>$Elemento, Enlace => $EnlaceElemento,Fecha => $FechaElemento, Tipo => $TipoElemento, Tamano => $TamanoElemento);
                            }
                    }
            }

		//Retorna la lista de archivos construida
		return $PCO_ListadoArchivos;
    }


########################################################################
########################################################################
/*
	Function: PCO_ListadoExploracionArchivosVisual
	Presenta una lista de los archivos contenidos en una carpeta con modificadores para las opciones
*/
function PCO_ListadoExploracionArchivosVisual($RutaExploracion="",$Filtro_contenido="",$TituloExploracion="",$PermitirDescarga=1)
    {
        global $MULTILANG_TotalRegistros,$MULTILANG_Explorar,$MULTILANG_Filtro,$MULTILANG_Descargar,$MULTILANG_Tipo,$MULTILANG_Fecha,$MULTILANG_Peso;
        //Si la ruta de exploracion es diferente de vacio hace el proceso de busqueda de archivos
        if ($RutaExploracion!="")
            {
                //Inicia Marco de presentacion de archivos
                echo '
                    <div class="panel panel-default"> <!-- Clase chat-panel para altura -->
                        <div class="well well-sm">
                        <span class="label label-primary">'.$TituloExploracion.'</span> '.$MULTILANG_Explorar.' <b>'.$RutaExploracion.'</b> '.$MULTILANG_Filtro.' '.$Filtro_contenido.':
                        </div>
                        <div class="panel-body">
                            <ul class="chat">';

                $ConteoElementos=0;
                $TotalTamanoElementos=0;

                //Obtiene la lista de archivos
                $ListadoArchivos=PCO_ListadoExploracionArchivos($RutaExploracion,$Filtro_contenido);

                //Recorre el arreglo de archivos encontrados para presentarlo
                $ContenidoDirectorio = opendir($RutaExploracion);
                foreach ($ListadoArchivos as $Archivo)
                    {
						echo '
						<li class="left clearfix">
							<span class="chat-img pull-left">
								<i class="fa fa-file-archive-o fa-2x fa-fw icon-gray"></i>
							</span>
							<div class="chat-body clearfix">
								<div class="header">
									<strong class="primary-font">'.$Archivo["Nombre"].'</strong>
									<small class="pull-right text-muted">';
										//Si se debe presentar el boton de descarga lo agrega (por defecto), sino no lo muestra
										if($PermitirDescarga==1)
											echo '
												<a  href="'.$Archivo["Enlace"].'" class="btn btn-xs btn-default"><i class="fa fa-download fa-fw"></i> '.$MULTILANG_Descargar.'</a>
												<br>';

										echo ''.$MULTILANG_Peso.' <span class="badge">'.$Archivo["Tamano"].' Kb</span>
									</small>
								</div>
								<p>
									<i class="icon-gray">&nbsp;&nbsp;&nbsp;
									'.$MULTILANG_Fecha.': '.$Archivo["Fecha"].'
									('.$MULTILANG_Tipo.' '.$Archivo["Tipo"].')
									</i>
								</p>
							</div>
						</li>';
						$ConteoElementos++;
						$TotalTamanoElementos+=$Archivo["Tamano"];
                    }

                //Cierra Marco de presentacion de archivos
                echo '
                            </ul>
                        </div> <!-- /.panel-body -->
                    <div class="well well-sm">'.$MULTILANG_TotalRegistros.': <b>'.$ConteoElementos.'</b> '.$MULTILANG_Peso.': <b>'.$TotalTamanoElementos.' Kb</b></div>
                    </div> <!-- /.panel .chat-panel -->';
            }
    }

########################################################################
########################################################################
/*
	Function: PCO_OpcionesComboDesdeCSV
	Genera una lista de seleccion con la variable recibida y los items separados por un caracter especifico
*/
function PCO_OpcionesComboDesdeCSV($lista_opciones,$caracter_separador,$valor_comparacion="",$usar_indice=0)
	{
		$SalidaFormateada="";
		$campos = explode($caracter_separador, $lista_opciones);
		for ($i=0;$i<count($campos);$i++)
			{
				$cadena_seleccion="";
				if ($campos[$i]==$valor_comparacion)
				$cadena_seleccion=" selected ";

				$cadena_valor=$campos[$i];
				//Si se indica que se debe utilizar el indice se retorna el numero de item, en lugar de su valor
				if ($usar_indice==1)
					$cadena_valor=$i;
				$SalidaFormateada.= '<option value="'.$cadena_valor.'" '.$cadena_seleccion.'>'.$campos[$i].'</option>';
			}
		return $SalidaFormateada;
	}


########################################################################
########################################################################
/*
	Function: PCO_AparearCamposTabla_vs_HojaCalculo
	Abre un archivo de hoja de cálculo y lo compara frente a los campos de una tabla de datos para ver si existen, tipos de dato, etc.

	Variables de entrada:

		PathArchivo - Ruta completa al archivo que se desea cargar
		NombreTabla - Nombre de la tabla a revisar campos
*/
function PCO_AparearCamposTabla_vs_HojaCalculo($NombreTabla,$PathArchivo)
	{
		global $MULTILANG_Campo,$MULTILANG_Columna,$MULTILANG_Tablas,$MULTILANG_Archivo,$_SeparadorCampos_,$MULTILANG_Campo,$MULTILANG_Deshabilitado,$MULTILANG_FrmPredeterminado;
		//Obtiene posibles variables de filtro globales
		global $PCO_lista_campos_ignorados,$PCO_lista_campos_fijos,$PCO_lista_valores_fijos;
		$ArregloCamposIgnorados=explode($_SeparadorCampos_,$PCO_lista_campos_ignorados);
		$ArregloCamposFijos=explode($_SeparadorCampos_,$PCO_lista_campos_fijos);
		$ArregloValoresFijos=explode($_SeparadorCampos_,$PCO_lista_valores_fijos);

		$SalidaFormateada.='<table class="table table-condensed btn-xs table-hover table-striped table-unbordered table-responsive" id="TablaArchivoCSV_Apareado"><thead><tr>
			<th>'.$MULTILANG_Campo.' ('.$MULTILANG_Tablas.')</th>
			<th></th>
			<th>'.$MULTILANG_Columna.' ('.$MULTILANG_Archivo.')</th>
			</tr></thead><tbody>';

		//Busca las columnas definidas en el archivo
		$ColumnasArchivo = PCO_ColumnasDesdeHojaCalculo($PathArchivo);
		//Genera la lista en minuscula para ser pasada a los combos
		$ListaColumnas="";
		foreach ($ColumnasArchivo as $ColumnaLista)
			$ListaColumnas.="|".strtolower($ColumnaLista);

		//Busca las columnas definidas en la tabla
		$CamposTabla=PCO_ConsultarColumnas($NombreTabla);

		//Busca por cada campo de tabla algun equivalente en las columnas
		for($i=0;$i<count($CamposTabla);$i++)
			{
				$SalidaFormateada.= '<tr>';
					$SalidaFormateada.= '<td>'.$CamposTabla[$i]["nombre"].'</td>';
					$SalidaFormateada.= '<td><i class="fa fa-exchange"></i></td>';
					//Genera combo de columnas de archivo preseleccionando uno si aplica
					$OpcionesCombo=PCO_OpcionesComboDesdeCSV($ListaColumnas,"|",strtolower($CamposTabla[$i]["nombre"]),1); //Solicita el indice en lugar del valor

					//Si el campo es un campo ignorado deja un combo vacio
					if (  in_array($CamposTabla[$i]["nombre"],$ArregloCamposIgnorados)  )
						$OpcionesCombo='<option value="">'.$MULTILANG_Campo.' '.strtoupper($CamposTabla[$i]["nombre"]).' '.$MULTILANG_Deshabilitado.'</option>';

					//Si el campo es un campo de valor fijo lo indica en el combo pero como valor queda ignorado
					if (  in_array($CamposTabla[$i]["nombre"],$ArregloCamposFijos)  )
						$OpcionesCombo='<option value="">'.$MULTILANG_Campo.' '.strtoupper($CamposTabla[$i]["nombre"]).' '.$MULTILANG_FrmPredeterminado.'='.$ArregloValoresFijos[array_search($CamposTabla[$i]["nombre"], $ArregloCamposFijos)].'</option>';

					//Presenta combo
					$SalidaFormateada.= '<td><select id="PCO_campoimportado_'.strtolower($CamposTabla[$i]["nombre"]).'" name="PCO_campoimportado_'.strtolower($CamposTabla[$i]["nombre"]).'" class="btn btn-xs btn-default">'.$OpcionesCombo.'</select></td>';
				$SalidaFormateada.= '</tr>';
				//.$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($Columna, $Fila)->getFormattedValue().'</td>';	// METODO1: getCell('A1')->getFormattedValue(); METODO2: getCellByColumnAndRow(1, 2)->getFormattedValue();
			}
		$SalidaFormateada.= '</tbody></table>';
		return $SalidaFormateada;
	}


########################################################################
########################################################################
/*
	Function: PCO_ColumnasDesdeHojaCalculo
	Abre un archivo de hoja de cálculo y busca las columnas definidas en la primera fila de la primera hoja

	Variables de entrada:

		PathArchivo - Ruta completa al archivo que se desea analizar

	Variables de salida:

		ArregloColumnas - Variable con la lista de columas encontradas
*/
function PCO_ColumnasDesdeHojaCalculo($PathArchivo)
	{
		$ArregloColumnas=array();

		//Crea el objeto para lectura del archivo
		$XLFileType = PHPExcel_IOFactory::identify($PathArchivo);
		$objReader = PHPExcel_IOFactory::createReader($XLFileType);
		$objReader->setLoadSheetsOnly(0);	//Asume que la primera hoja tiene los datos.  ALTERNATIVA INDICANDO EL NOMBRE DE HOJA : $objReader->setLoadSheetsOnly('Hoja1');
		$objPHPExcel = $objReader->load($PathArchivo);

		$Fila=1;
		$MaximaColumna=0;

		//Determina el numero de columna maxima y genera la primera fila como encabezados
		while ($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($MaximaColumna, $Fila)->getFormattedValue()!="")
			{
				$ArregloColumnas[]=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($MaximaColumna, $Fila)->getFormattedValue();
				$MaximaColumna++;
			}

		return $ArregloColumnas;
	}


########################################################################
########################################################################
/*
	Function: PCO_DatatableDesdeHojaCalculo
	Abre un archivo de hoja de cálculo y lo presenta en formato DataTable

	Variables de entrada:

		PathArchivo - Ruta completa al archivo que se desea cargar
		NroLineas - Cantidad de lineas para ser agregadas al DataTable.  Cero para ilimitado
*/
function PCO_DatatableDesdeHojaCalculo($PathArchivo,$NroLineas)
	{
		global $PCO_InformesDataTable,$PCO_InformesDataTablePaginaciones,$PCO_InformesDataTableTotales,$PCO_InformesDataTableFormatoTotales,$PCO_InformesDataTableExrpotaCLP,$PCO_InformesDataTableExrpotaCSV,$PCO_InformesDataTableExrpotaXLS,$PCO_InformesDataTableExrpotaPDF,$PCO_InformesDataTableDefineCOLS,$PCO_InformesDataTable_pane_activado,$PCO_InformesDataTable_pane_cascada,$PCO_InformesDataTable_pane_colapsado,$PCO_InformesDataTable_pane_columnas,$PCO_InformesDataTable_pane_subtotalesrelativos,$PCO_InformesDataTable_pane_conteos,$PCO_InformesDataTable_pane_controles,$PCO_InformesDataTable_pane_control_colapsar,$PCO_InformesDataTable_pane_control_ordenar;

		@$PCO_InformesDataTable.="TablaArchivoCSV_Importado|"; //Agrega la tabla a la lista de DataTables para ser convertida
        @$PCO_InformesDataTablePaginaciones.="10|";
        @$PCO_InformesDataTableTotales.="|";
        @$PCO_InformesDataTableFormatoTotales.="|";
		$SalidaFormateada.='<table class="table table-condensed btn-xs table-hover table-striped table-unbordered table-responsive" id="TablaArchivoCSV_Importado"><thead><tr>';

		//Crea el objeto para lectura del archivo
		$XLFileType = PHPExcel_IOFactory::identify($PathArchivo);
		$objReader = PHPExcel_IOFactory::createReader($XLFileType);
		$objReader->setLoadSheetsOnly(0);	//Asume que la primera hoja tiene los datos.  ALTERNATIVA INDICANDO EL NOMBRE DE HOJA : $objReader->setLoadSheetsOnly('Hoja1');
		$objPHPExcel = $objReader->load($PathArchivo);

		$Fila=1;
		$Columna=0;
		$MaximaFila=$NroLineas;
		$MaximaColumna=0;

		//Determina el numero de columna maxima y genera la primera fila como encabezados
		$ColumnasEncabezado=PCO_ColumnasDesdeHojaCalculo($PathArchivo);
		foreach ($ColumnasEncabezado as $TituloColuma)
			{
				//$SalidaFormateada.= '<th>COL_'.($MaximaColumna+1).'<br>'.$TituloColuma.'</th>';
				$SalidaFormateada.= '<th>'.$TituloColuma.'</th>';
				$MaximaColumna++;
			}

		$SalidaFormateada.= '</tr></thead><tbody>';

		$Fila++; //Obvia la primera fila pues ya fue usada como encabezados
		//Recorre la hoja segun las columnas encontradas y las filas solicitadas
		while ($Fila<=$MaximaFila)
			{
				//Asume que la primera columna siempre tiene dato (llave o algo minimo) para agregarla a la tabla, sino no es agregada
				if ($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($Columna, $Fila)->getFormattedValue()!="")
					{
						$SalidaFormateada.= '</tr>';
						while ($Columna<$MaximaColumna)
							{
								$SalidaFormateada.= '<td>'.$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($Columna, $Fila)->getFormattedValue().'</td>';	// METODO1: getCell('A1')->getFormattedValue(); METODO2: getCellByColumnAndRow(1, 2)->getFormattedValue();
								$Columna++;
							}
						$SalidaFormateada.= '</tr>';
						$Columna=0;
					}
				$Fila++;
			}
		$SalidaFormateada.= '</tbody></table>';
		return $SalidaFormateada;
	}


########################################################################
########################################################################
/*
	Function: PCO_PermisoHeredadoAccion
	Busca dentro de los permisos del usuario la accion a ejecutar cuando no se encuentra directamente como una opcion del usuario sino como una subrutina de otra de la que si tiene agregada de manera que valida si puede ingresar o no a ella.

	Variables de entrada:

		accion - Accion a ser ejectudada, de la que se desea buscar permiso heredado por otra

	Salida:
		Retorna 1 en caso de encontrar el permiso
		Retorna 0 cuando no se encuentra un permiso
*/
function PCO_PermisoHeredadoAccion($PCO_Accion)
	{
		global $PCOSESS_LoginUsuario,$TablasCore;
		// Variable que determina el estado de aceptacion o rechazo del permiso 0=no permiso 1=ok permiso
		$retorno=0;

		// Verifica mapeo de permisos para acciones que llaman a otras, heredadas.  Valores en = 1  son funciones publicas:
		// FUNCION_solicitada_por_el_usuario				FUNCION_madre_de_entrada_a_funcion_solicitada
		if ($PCO_Accion== "PCO_MisInformes")					$retorno = 1;
		if ($PCO_Accion== "PCO_GuardarInforme")					$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarInformes");
		if ($PCO_Accion== "PCO_EditarInforme")					$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarInformes");
		if ($PCO_Accion== "PCO_ClonarDisenoInforme")			$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarInformes");
		if ($PCO_Accion== "PCO_DefinirCopiaInformes")			$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarInformes");
		if ($PCO_Accion== "PCO_EliminarInforme")				$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarInformes");
		if ($PCO_Accion== "PCO_EliminarInformeTabla")			$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarInformes");
		if ($PCO_Accion== "PCO_GuardarInformeTabla")			$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarInformes");
		if ($PCO_Accion== "PCO_EliminarInformeCampo")			$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarInformes");
		if ($PCO_Accion== "PCO_GuardarInformeCampo")			$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarInformes");
		if ($PCO_Accion== "PCO_GuardarInformeCondicion")		$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarInformes");
		if ($PCO_Accion== "PCO_EliminarInformeCondicion")		$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarInformes");
		if ($PCO_Accion== "PCO_ActualizarGraficoInforme")		$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarInformes");
		if ($PCO_Accion== "PCO_ActualizarAgrupamientoInforme")	$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarInformes");
		if ($PCO_Accion== "PCO_GuardarAccionInforme")			$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarInformes");
		if ($PCO_Accion== "PCO_EliminarRegistroInforme")		$retorno = 1;
		if ($PCO_Accion== "PCO_EliminarAccionInforme")			$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarInformes");
		if ($PCO_Accion== "PCO_ExportarInforme")				$retorno = 1;
		if ($PCO_Accion== "PCO_ImportarInforme")				$retorno = 1;
		if ($PCO_Accion== "PCO_AnalizarImportacionInforme")		$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarInformes");
		if ($PCO_Accion== "PCO_ConfirmarImportacionInforme")	$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarInformes");

		// Funciones en core/usuarios.php
		if ($PCO_Accion== "PCO_CambiarContrasena")				$retorno = 1;
        if ($PCO_Accion== "PCO_ActualizarPerfilUsuario")		$retorno = 1;
        if ($PCO_Accion== "PCO_GuardarPerfilUsuario")			$retorno = 1;
		if ($PCO_Accion== "PCO_ActualizarContrasena")			$retorno = PCO_PermisoHeredadoAccion("PCO_CambiarContrasena");
/*
		if ($PCO_Accion== "PCO_ResetearContrasena")				$retorno = PCO_PermisoAgregadoAccion("PCO_ListarUsuarios");
		if ($PCO_Accion== "PCO_AgregarUsuario")					$retorno = PCO_PermisoAgregadoAccion("PCO_ListarUsuarios");
		if ($PCO_Accion== "PCO_GuardarUsuario")					$retorno = PCO_PermisoAgregadoAccion("PCO_ListarUsuarios");
		if ($PCO_Accion== "PCO_EliminarUsuario")				$retorno = PCO_PermisoAgregadoAccion("PCO_ListarUsuarios");
		if ($PCO_Accion== "PCO_CambiarEstadoUsuario")			$retorno = PCO_PermisoAgregadoAccion("PCO_ListarUsuarios");
		if ($PCO_Accion== "PCO_PermisosUsuario")				$retorno = PCO_PermisoAgregadoAccion("PCO_ListarUsuarios");
		if ($PCO_Accion== "PCO_AgregarPermiso")					$retorno = PCO_PermisoAgregadoAccion("PCO_ListarUsuarios");
		if ($PCO_Accion== "PCO_EliminarPermiso")				$retorno = PCO_PermisoAgregadoAccion("PCO_ListarUsuarios");
		if ($PCO_Accion== "PCO_InformesUsuario")				$retorno = PCO_PermisoAgregadoAccion("PCO_ListarUsuarios");
		if ($PCO_Accion== "PCO_AgregarInformeUsuario")			$retorno = PCO_PermisoAgregadoAccion("PCO_ListarUsuarios");
		if ($PCO_Accion== "PCO_EliminarInformeUsuario")			$retorno = PCO_PermisoAgregadoAccion("PCO_ListarUsuarios");
        if ($PCO_Accion== "PCO_CopiarPermisos")					$retorno = PCO_PermisoAgregadoAccion("PCO_ListarUsuarios");
        if ($PCO_Accion== "PCO_CopiarInformes")					$retorno = PCO_PermisoAgregadoAccion("PCO_ListarUsuarios");
*/
        if ($PCO_Accion== "PCO_AgregarUsuarioAutoregistro")		$retorno = 1;
        if ($PCO_Accion== "PCO_GuardarUsuarioAutoregistro")		$retorno = 1;

		// Funciones en core/menus.php
		if ($PCO_Accion== "PCO_VerMenu")						$retorno = 1;
		if ($PCO_Accion== "PCO_ReportarBugs")					$retorno = 1;
		if ($PCO_Accion== "PCO_BuscarPermisosPractico")			$retorno = 1;
		if ($PCO_Accion== "PCO_EliminarMenu")					$retorno = PCO_PermisoAgregadoAccion("PCOFUNC_AdministrarMenu");
		// Funciones en core/tablas.php
		if ($PCO_Accion== "PCO_AsistenteTablas")				$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarTablas");
		if ($PCO_Accion== "PCO_GuardarCrearTablaAsistente")		$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarTablas");
		if ($PCO_Accion== "PCO_EditarTabla")					$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarTablas");
		if ($PCO_Accion== "PCO_EliminarTabla")					$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarTablas");
		if ($PCO_Accion== "PCO_EliminarCampoTabla")				$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarTablas");
		if ($PCO_Accion== "PCO_GuardarCrearCampo")				$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarTablas");
		if ($PCO_Accion== "PCO_GuardarCrearTabla")				$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarTablas");
		if ($PCO_Accion== "PCO_DefinirCopiaTablas")				$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarTablas");
		if ($PCO_Accion== "PCO_CopiarTabla")					$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarTablas");
		if ($PCO_Accion== "PCO_ImportarTabla")					$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarTablas");
		if ($PCO_Accion== "PCO_ConfirmarImportacionTabla")		$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarTablas");
		if ($PCO_Accion== "PCO_AnalizarImportacionCSV")			$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarTablas");
		if ($PCO_Accion== "PCO_EscogerTablaImportacionCSV")		$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarTablas");
		if ($PCO_Accion== "PCO_EjecutarImportacionCSV")			$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarTablas");

		// Funciones en core/formularios.php
		if ($PCO_Accion== "PCO_GuardarDatosFormulario")			$retorno = 1;
		if ($PCO_Accion== "PCO_EliminarDatosFormulario")		$retorno = 1;
		if ($PCO_Accion== "PCO_ActualizarDatosFormulario")		$retorno = 1;
		if ($PCO_Accion== "PCO_EjecutarPostAccionForm")		    $retorno = 1;
		if ($PCO_Accion== "PCO_EditarEventoObjeto")		        $retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarFormularios");
		if ($PCO_Accion== "PCO_ActualizarFormulario")			$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarFormularios");
		if ($PCO_Accion== "PCO_CopiarFormulario")				$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarFormularios");
		if ($PCO_Accion== "PCO_DefinirCopiaFormularios")		$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarFormularios");
		if ($PCO_Accion== "PCO_GuardarFormulario")				$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarFormularios");
		if ($PCO_Accion== "PCO_EliminarFormulario")				$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarFormularios");
		if ($PCO_Accion== "PCO_EditarFormulario")				$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarFormularios");
		if ($PCO_Accion== "PCO_EliminarCampoFormulario")		$retorno = PCO_PermisoAgregadoAccion("PCO_EditarFormulario");
		if ($PCO_Accion== "PCO_GuardarAccionFormulario")		$retorno = PCO_PermisoAgregadoAccion("PCO_EditarFormulario");
		if ($PCO_Accion== "PCO_EliminarAccionFormulario")		$retorno = PCO_PermisoAgregadoAccion("PCO_EditarFormulario");
		if ($PCO_Accion== "PCO_ConfirmarImportacionFormulario")	$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarFormularios");
		if ($PCO_Accion== "PCO_AnalizarImportacionFormulario")	$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarFormularios");
		if ($PCO_Accion== "PCO_ImportarFormulario")				$retorno = PCO_PermisoAgregadoAccion("PCO_AdministrarFormularios");
		if ($PCO_Accion== "PCO_DesplazarObjetosForm")			$retorno = PCO_PermisoAgregadoAccion("PCO_EditarFormulario");

		// Funciones en core/sesion.php
		if ($PCO_Accion== "Iniciar_login")						$retorno = 1;
		if ($PCO_Accion== "Terminar_sesion")					$retorno = 1;
		if ($PCO_Accion== "Mensaje_cierre_sesion")				$retorno = 1;
		// Funciones en core/objetos.php
		if ($PCO_Accion== "PCO_CargarObjeto")					$retorno = 1;
		if ($PCO_Accion== "cargar_objeto")						$retorno = 1; //Eliminar despues de version 18.9
		// Funciones en core/actualizacion.php
		if ($PCO_Accion== "cargar_archivo")						$retorno = PCO_PermisoAgregadoAccion("actualizar_practico");
		if ($PCO_Accion== "analizar_parche")					$retorno = PCO_PermisoAgregadoAccion("actualizar_practico");
		if ($PCO_Accion== "aplicar_parche")						$retorno = PCO_PermisoAgregadoAccion("actualizar_practico");
		// Funciones en core/ajax.php
		if ($PCO_Accion== "opciones_combo_box")					$retorno = 1;
		if ($PCO_Accion== "valor_campo_tabla")					$retorno = 1;
		if ($PCO_Accion== "PCO_ObtenerOpcionesAjaxSelect")		$retorno = 1;

		// Funciones en core/kanban.php
        if ($PCO_Accion=="PCO_ExplorarTablerosKanban")          $retorno = 1;
        if ($PCO_Accion=="PCO_ExplorarTablerosGantt")           $retorno = 1;
        if ($PCO_Accion=="EliminarTableroKanban")               $retorno = 1; //PCO_PermisoAgregadoAccion("PCO_ExplorarTablerosKanban")
        if ($PCO_Accion=="GuardarCreacionKanban")               $retorno = 1;
        if ($PCO_Accion=="VerTareasArchivadas")                 $retorno = 1;
        if ($PCO_Accion=="ArchivarTareaKanban")                 $retorno = 1;
        if ($PCO_Accion=="GuardarTareaKanban")                  $retorno = 1;
        if ($PCO_Accion=="EliminarTareaKanban")                 $retorno = 1;
        if ($PCO_Accion=="GuardarPersonalizacionKanban")        $retorno = 1;
        if ($PCO_Accion=="PCO_ExplorarTablerosKanbanResumido")  $retorno = 1;

        if (PCO_EsAdministrador($PCOSESS_LoginUsuario))
            {
                if ($PCO_Accion=="PCO_LimpiarCacheSQL")  $retorno = 1;
            }

        //VALIDA OTRAS ACCOIONES ESPECIALES

        //Verifica cambios de estado en tableros kanban de usuarios razo
        if ($PCO_Accion=="cambiar_estado_campo")
            {
                //Valida si el usuario tiene  al menos un kanban, si la accion es sobre la tabla de kanban
                $RegistroTableros=PCO_EjecutarSQL("SELECT id FROM ".$TablasCore."kanban WHERE archivado<>1 AND categoria='[PRACTICO][ColumnasTablero]' AND (login_admintablero='$PCOSESS_LoginUsuario' OR compartido_rw LIKE '%|$PCOSESS_LoginUsuario|%') LIMIT 0,1 ")->fetch();
                if ($RegistroTableros["id"]!="" && $tabla="kanban")
                    $retorno = 1;
            }

		//echo $PCOSESS_LoginUsuario.':Permiso heredado accion='.$PCO_Accion.':'.$retorno.'<br>'; //Activar para depuracion permisos
		return $retorno;
	}


########################################################################
########################################################################
/*
	Function: PCO_RestaurarEtiquetasHTML
	Determina si hay etiquetas sin cerrar o abrir en un arbol de elementos HTML y las genera.
*/
function PCO_RestaurarEtiquetasHTML($input)
	{
		$opened = array();
		$closed = array();
		//loop through opened and closed tags in order
		if(preg_match_all("/<(\/?[a-z]+)>?/i", $input, $matches))
			{
				foreach($matches[1] as $tag)
					{
						if(preg_match("/^[a-z]+$/i", $tag, $regs))
							{
								// a tag has been opened
								if(strtolower($regs[0]) != 'br')
									$opened[] = $regs[0];
							}
						elseif(preg_match("/^\/([a-z]+)$/i", $tag, $regs) && in_array($regs[1],$opened))
							{
								// a tag has been closed
								unset($opened[array_pop(array_keys($opened, $regs[1]))]);
							}
						else
							if(preg_match("/^\/([a-z]+)$/i", $tag, $regs) && !in_array($regs[1],$opened))
								{
									//a Tag that has been closed but not open
									$closed[]="<".$regs[1].">";
								}
					}
			}

		// close tags that are still open
		if($opened)
			{
				$tagstoclose = array_reverse($opened);
				foreach($tagstoclose as $tag)
					$input .= "";
			}
		$input1='';

		// open tags that are still close
		if($closed)
			{
				$tagstoopen = array_reverse($closed);
				foreach($tagstoopen as $tag)
					$input1 .= $tag;
			}

		return $input1.''.$input;
	}


########################################################################
########################################################################
/*
	Function: PCO_PermisoAgregadoAccion
	Busca dentro de los permisos agregados de manera explicita al usuario.

	Variables de entrada:

		accion - Accion a ser ejectudada
		estado_aceptacion - Si el usuario cuenta o no con el permiso solicitado

	Salida:
		Retorna 1 en caso de encontrar el permiso
		Retorna 0 cuando no se encuentra un permiso
*/
function PCO_PermisoAgregadoAccion($PCO_Accion)
	{
		// Variable que determina el estado de aceptacion o rechazo del permiso 0=no permiso 1=ok permiso
		$retorno=0;
		global $ConexionPDO,$TablasCore,$PCOSESS_LoginUsuario;

		$consulta = $ConexionPDO->prepare("SELECT ".$TablasCore."menu.id FROM ".$TablasCore."usuario_menu,".$TablasCore."menu WHERE ".$TablasCore."menu.id=".$TablasCore."usuario_menu.menu AND usuario='$PCOSESS_LoginUsuario' AND ".$TablasCore."menu.comando='$PCO_Accion' ");
		$consulta->execute();
		$registro = $consulta->fetch();
		if ($registro[0]!="")
			{
				$retorno=1;
			}
		//echo $PCOSESS_LoginUsuario.':Permiso agregado accion='.$PCO_Accion.':'.$retorno.'<br>'; //Activar para depuracion permisos
		return $retorno;
	}


########################################################################
########################################################################
/*
	Function: PCO_ConvertirRegistroXML
	Traduce un registro de base de datos a notacion XML y retorna su cadena equivalente

	Ver tambien:
		<PCO_CopiarFormulario> | <copiar_informe>
*/
function PCO_ConvertirRegistroXML($Registro_BD,$ListaCampos,$CodificarBase64=1)
	{
		//Inicializa la variable de retorno
		$Contenido_XML="";
		// Busca datos y genera XML de cada registro
		$Elementos_tabla=explode(",",$ListaCampos);

		foreach ($Elementos_tabla as $ElementoExportar)
			{
				$EtiquetaAperturaXML="<$ElementoExportar>";
				$EtiquetaCierreXML="</$ElementoExportar>";
				$ValorEtiqueta=$Registro_BD[$ElementoExportar];
				if ($CodificarBase64==1)
					$ValorEtiqueta=base64_encode($ValorEtiqueta);
				$Contenido_XML .= "
	".$EtiquetaAperturaXML.$ValorEtiqueta.$EtiquetaCierreXML;
			}

		//Retorna la cadena equivalente
		return $Contenido_XML;
	}


########################################################################
########################################################################
/*
	Function: PCO_PermisoAccion
	Busca dentro de los permisos del usuario la accion a ejecutar de manera que valida si puede ingresar o no a ella.

	Variables de entrada:

		accion - Accion a ser ejectudada

	Salida:
		Retorna 1 en caso de encontrar el permiso
		Retorna 0 cuando no se encuentra un permiso
*/
function PCO_PermisoAccion($PCO_Accion)
	{
		global $PCOSESS_LoginUsuario,$TablasCore;
		// Variable que determina el estado de aceptacion o rechazo del permiso 0=no permiso 1=ok permiso
		$retorno=0;

		// Evalua inicialmente permisos para el admin (evita queries)
		if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario)) $retorno=1;

		// Si es un usuario estandar siempre entra, si es el admin entra si no es permiso raiz
		if (!$retorno)
			{
				// Busca permisos agregados directamente al usuario
				$retorno=PCO_PermisoAgregadoAccion($PCO_Accion);
				// Si no encuentra permisos directos, busca en los heredados de los directos
				if (!$retorno)
					{
						// Si no encuentra el permiso directo llama los heredados
						$retorno=PCO_PermisoHeredadoAccion($PCO_Accion);
					}
				//Si no encuentra en los heredados busca en preautorizados por configuracion
				if (!$retorno)
					{
						$resultado=PCO_EjecutarSQL("SELECT id from ".$TablasCore."parametros WHERE funciones_personalizadas LIKE '%$PCO_Accion%' ");
						$parametros = $resultado->fetch();
						//Si encuentra un registro con la accion preautorizada entonces autoriza al usuario
						if ($parametros["id"]!="")
							$retorno=1;
					}
			}

		//echo $PCOSESS_LoginUsuario.':Permiso accion='.$PCO_Accion.':'.$retorno.'<br>'; //Activar para depuracion permisos
		return $retorno;
	}


########################################################################
########################################################################
/*
	Function: PCO_EscaparContenido
	Limpia cadenas y URLs a ser impresas para evitar posibles ataques por XSS
	En general, se debe limpiar cualquier variable enviada por el usuario y que vaya a ser impresa en su navegador para evitar que al imprimirla se puedan enviar javascripts o similares

	Variables de entrada:

		texto - URL, texto, variable de entrada o cualquier otro valor a escapar.

	Salida:
		Cadena filtrada
*/
function PCO_EscaparContenido($texto)
	{
		//$texto = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $texto); // Muy estricto
		$texto = str_ireplace("script","",$texto);

		return $texto;
	}


########################################################################
########################################################################
/*
	Function: gzdecode
	Crea una funcion de descompresion en caso de no estar disponible en la instalacion de PHP actual
*/
if (!function_exists('gzdecode'))
	{
		function gzdecode($cadena)
			{
				return gzinflate(substr($cadena,10,-8));
			}
	}


########################################################################
########################################################################
/*
	Function: PCO_LimpiarEntradas
	Limpia cadenas y URLs a ser impresas segun acciones para evitar XSS

	Salida:
		Cadenas y variables filtradas sobre sus valores globales
*/
function PCO_LimpiarEntradas()
	{
		global $PCO_Accion,$PCO_ErrorTitulo,$PCO_ErrorDescripcion;
		// Escapar siempre las acciones pues deberian tener solo letras, numeros y underlines.
		$PCO_Accion=PCO_EscaparContenido($PCO_Accion);
		$PCO_Accion = preg_replace("/[^A-Za-z0-9_]/", "", $PCO_Accion);

		// Escapa siempre los mensajes de error
		$PCO_ErrorTitulo=PCO_EscaparContenido(PCO_ReemplazarVariablesPHPEnCadena($PCO_ErrorTitulo));
		$PCO_ErrorTitulo = preg_replace("/[^A-Za-z0-9_ ><]/", "", $PCO_ErrorTitulo);
		$PCO_ErrorDescripcion=PCO_EscaparContenido(PCO_ReemplazarVariablesPHPEnCadena($PCO_ErrorDescripcion));
		$PCO_ErrorDescripcion = preg_replace("/[^A-Za-z0-9_ ><]/", "", $PCO_ErrorDescripcion);

		// Escapa otras variables de uso comun
		global $PCO_ErrorTitulo,$PCO_ErrorDescripcion;
		$PCO_ErrorTitulo=PCO_EscaparContenido(PCO_ReemplazarVariablesPHPEnCadena($PCO_ErrorTitulo));
		$PCO_ErrorDescripcion=PCO_EscaparContenido(PCO_ReemplazarVariablesPHPEnCadena($PCO_ErrorDescripcion));

		// Escapar algunas variables segun la accion recibida

		if ($PCO_Accion=="PCO_AdministrarFormularios")
			{
				global $PCO_ErrorDescripcion,$PCO_ErrorTitulo;
				$PCO_ErrorDescripcion=PCO_EscaparContenido(PCO_ReemplazarVariablesPHPEnCadena($PCO_ErrorDescripcion));
				$PCO_ErrorTitulo=PCO_EscaparContenido(PCO_ReemplazarVariablesPHPEnCadena($PCO_ErrorTitulo));
			}

		if ($PCO_Accion=="actualizar_menu")
			{
				global $id;
				$id=PCO_EscaparContenido($id);
			}

		if ($PCO_Accion=="detalles_menu")
			{
				global $id;
				$id=PCO_EscaparContenido($id);
			}

		if ($PCO_Accion=="PCO_EditarInforme")
			{
				//
				global $informe;
				$informe=PCO_EscaparContenido($informe);
			}

		if ($PCO_Accion=="PCO_ListarUsuarios")
			{
				global $login_filtro,$nombre_filtro;
				$login_filtro=PCO_EscaparContenido($login_filtro);
				$nombre_filtro=PCO_EscaparContenido($nombre_filtro);
			}

		if ($PCO_Accion=="PCO_CargarObjeto")
			{
				global $PCO_Objeto;
				$PCO_Objeto=PCO_EscaparContenido($PCO_Objeto);
			}

		if ($PCO_Accion=="PCO_GuardarFormulario")
			{
				global $tabla_datos;
				$tabla_datos=PCO_EscaparContenido($tabla_datos); // Revisar si afecta el script de autorun
			}

		if ($PCO_Accion=="Iniciar_login")
			{
				global $uid,$clave,$captcha;
				$uid=PCO_EscaparContenido($uid);
				$clave=PCO_EscaparContenido($clave);
				$captcha=PCO_EscaparContenido($captcha);
			}
	}


########################################################################
########################################################################
/*
	Function: PCO_TextoAleatorio
	Genera un texto alfanumerico aleatorio de una longitud determinada

	Variables de entrada:

		longitud - Numero de caracteres que deben ser retornados en la cadena

	Salida:
		Cadena aleatoria
*/
function PCO_TextoAleatorio($longitud)
	{
		$plantilla = "23456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$clave="";
		for($i=0;$i<$longitud;$i++)
			{
				$clave .= $plantilla[rand(0,strlen($plantilla)-1)];
			}
		return $clave;
	}


########################################################################
########################################################################
/*
	Function: PCO_CodigoQR
	Genera un codigo QR a partir de los parametros recibidos

	Variables de entrada:

		contenido - Texto que debera ser representado en el codigo QR
		recuperacion_errores - Recuperacion de errores para el codigo (L,M,Q,H) L el mas bajo, H el mas alto
		ancho_pixeles - Tamano de cada cuadro del codigo en pixeles
		margen_pixeles - La margen externa del codigo QR
		ruta_almacenamiento - Path sobre el cual se almacenara el codigo, debe contar con permisos de escritura
		archivo - nombre de archivo (sin extension) sobre el cual sera guardado el codigo

	Salida:
		Imagen generada para el codigo QR
*/
function PCO_CodigoQR($contenido,$recuperacion_errores="L",$ancho_pixeles=3,$margen_pixeles=1,$ruta_almacenamiento="tmp/",$archivo="")
	{
		include_once("inc/qrcode/qrcode.php");
		//Si no se recibe un archivo entonces genera uno aleatorio
		if ($archivo=="") $archivo="QR".PCO_TextoAleatorio(15);
		//Genera el archivo con el QR
		$Ruta_QRC=$ruta_almacenamiento.$archivo.".png";
		QRcode::png($contenido, $Ruta_QRC, $recuperacion_errores, $ancho_pixeles, $margen_pixeles);
		//Devuelve el codigo QR como etiqueta de imagen HTML
		return '<img src="'.$Ruta_QRC.'" alt="" border="0">';
	}


########################################################################
########################################################################
/*
	Function: PCO_FiltrarCadenaSQL
	Filtra los caracteres existentes en una cadena de manera que no permita comillas sencillas, backslash o cualquier otro caracter que genere problemas en las consultas o posibles fallos de seguridad derivados de un SQLInjection

	Variables de entrada:

		cadena - Cadena a filtrar

	Salida:
		Retorna cadena sin caracteres ilegales o posibles inyecciones

		' or "='
		'' or 1=1 -- and ''=''
		admin' --
		admin' #
		admin'/*
		' or 1=1--
		' or 1=1#
		' or 1=1/*
		') or '1'='1--
		') or ('1'='1--
		1' and ''='
		' OR 'A'='A
		$username = 1' or '1' = '1





*/
function PCO_FiltrarCadenaSQL($cadena)
	{
		global $PCO_Accion;

		if ($PCO_Accion=="Iniciar_login")
			{
				$cadena = str_ireplace("''","'",$cadena);
				$cadena = str_ireplace("\\","",$cadena);
				$cadena = str_ireplace("COPY ","",$cadena);
				$cadena = str_ireplace("DELETE ","",$cadena);
				$cadena = str_ireplace("DROP ","",$cadena);
				$cadena = str_ireplace("DUMP ","",$cadena);
				$cadena = str_ireplace(" OR ","",$cadena);
				$cadena = str_ireplace("%","",$cadena);
				$cadena = str_ireplace(" LIKE ","",$cadena);
				$cadena = str_ireplace("--","",$cadena);
				$cadena = str_ireplace("^","",$cadena);
				$cadena = str_ireplace("[","",$cadena);
				$cadena = str_ireplace("]","",$cadena);
				$cadena = str_ireplace("!","",$cadena);
				$cadena = str_ireplace("¡","",$cadena);
				$cadena = str_ireplace("?","",$cadena);
				$cadena = str_ireplace("&","",$cadena);
			}

		// Expresiones que siempre deben ser filtradas
		$cadena = str_ireplace("BENCHMARK","",$cadena);

		/*
		array_walk($_POST, 'PCO_FiltrarCadenaSQL');
		array_walk($_GET, 'PCO_FiltrarCadenaSQL');
		//$cadena = str_ireplace("SELECT","",$cadena);
		//$cadena = str_ireplace("=","",$cadena);
		*/
		return $cadena;
	}


/* ##################################################################
   ##################################################################
    Function: PCO_CompletarParametros
    reemplaza los parametros, solo se usa para depuracion

    Variables de entrada:

        string -
        data -

    Salida:
        Retorna la cadena de consulta con valores formateada para impresion
*/
function PCO_CompletarParametros($Cadena,$data)
    {
        $indexed=$data==array_values($data);
        foreach($data as $k=>$v) {
            if(is_string($v))
	      if($v =='')
		$v="NULL";
	      else
	        $v="'$v'";
            if($indexed)
              if($v =='')
		$Cadena=preg_replace('/\?/','NULL',$Cadena,1);
	      else
		$Cadena=preg_replace('/\?/',$v,$Cadena,1);
            else
              if($v =='')
		$Cadena=str_replace(":$k","NULL",$Cadena);
	      else
	        $Cadena=str_replace(":$k",$v,$Cadena);
        }
        return $Cadena;
    }


########################################################################
########################################################################
/*
	Function: PCO_ObtenerUltimoIDInsertado
	Segun el motor, obtiene el ultimo ID de registro insertado en la conexion especificada

	Variables de entrada:

		ConexionBD - Determina si la consulta debe ser ejecutada en otra conexion o motor.  Se hace obligatorio enviar parametros cuando se envia otra conexion

	Salida:
		Retorna valor de ID de registro o vacio si no se encuentra alguno
*/
function PCO_ObtenerUltimoIDInsertado($ConexionBD="")
	{
		global $MotorBD,$ConexionPDO;
        if ($ConexionBD=="")  $ConexionBD=$ConexionPDO;
        $id_ultimo_registro_insertado="";

		if ($MotorBD=="mysql")
			{
		        $id_ultimo_registro_insertado=$ConexionBD->lastInsertId();
		    }
		//Si el motor no soporta adecuadamente el lastInsertId() hace funcion manual
		if ($MotorBD=="dblib_mssql")
			{
				$registro_ultimo_id=PCO_EjecutarSQL("SELECT SCOPE_IDENTITY()","",$ConexionBD,1)->fetch();
				$id_ultimo_registro_insertado=$registro_ultimo_id[0];
			}
		if ($MotorBD=="oracle")
			{
				$registro_ultimo_id=PCO_EjecutarSQL("SELECT SEQNAME.CURRVAL FROM DUAL;","",$ConexionBD,1)->fetch();
				$id_ultimo_registro_insertado=$registro_ultimo_id[0];
			}
		if ($MotorBD=="pgsql")
			{
				$registro_ultimo_id=PCO_EjecutarSQL("SELECT lastval();","",$ConexionBD,1)->fetch();
				$id_ultimo_registro_insertado=$registro_ultimo_id[0];
			}

        return $id_ultimo_registro_insertado;
	}


########################################################################
########################################################################
/*
	Function: PCO_EjecutarSQL
	Ejecuta consultas que retornan registros (SELECTs).

	Variables de entrada:

		query - Consulta preformateada para ser ejecutada en el motor
		lista_parametros - Lista de variables PHP con parametros que deben ser preparados para el query separados por $_SeparadorCampos_
		ConexionBD - Determina si la consulta debe ser ejecutada en otra conexion o motor.  Se hace obligatorio enviar parametros cuando se envia otra conexion

	Salida:
		Retorna mensaje en pantalla con la descripcion devuelta por el driver en caso de error
		Retorna una variable con el arreglo de resultados en caso de ser exitosa la consulta
*/
    //Funcion para compatibilidad hacia atras.  Desaparecera en la version 18.9
    function ejecutar_sql($query,$lista_parametros="",$ConexionBD="",$ReplicaRecursiva=1,$EvitarLogSQL=0)
    { echo "ERROR: Llamado a funcion obsoleta del framework ejecutar_sql().  En su lugar utilice PCO_EjecutarSQL() "; }
function PCO_EjecutarSQL($query,$lista_parametros="",$ConexionBD="",$EvitarLogSQL=0)
	{
		//Determina si se debe usar la conexion global del sistema o una especifica de usuario
		if($ConexionBD=="")
			global $ConexionPDO;
		else
			$ConexionPDO=$ConexionBD;

		global $ModoDepuracion,$MotorBD;
		global $MULTILANG_ErrorTiempoEjecucion,$MULTILANG_Detalles,$MULTILANG_ErrorSoloAdmin,$MULTILANG_Archivo;
		global $PCO_Accion;
		global $PCOSESS_LoginUsuario,$_SeparadorCampos_,$DepuracionSQL;

		// Filtra la cadena antes de ser ejecutada
		$query=PCO_FiltrarCadenaSQL($query);
		
		//Agrega comentario al query con nombre del usuario si aplica
		if (@$PCOSESS_LoginUsuario!="" && @$MotorBD=="mysql")
		    $query="/*US={$PCOSESS_LoginUsuario}*/ ".$query;

		try
			{
				$consulta = $ConexionPDO->prepare($query);
				//Cuando se reciben parametros entonces se asume recepcion de querys con  interrogaciones  ?
				//que deben ser preparados antes de ejecutarse con cada uno de los parametros recibidos
				if ($lista_parametros!="")
					{
						$cantidad_parametros=substr_count($query,'?');
						$parametros=@explode($_SeparadorCampos_,$lista_parametros);
						// if ($cantidad_parametros!=count($parametros)) //La cantidad de parametros en query es diferente a los recibidos
						//Recorre cada parametro y toma su valor
						for ($i=1;$i<=$cantidad_parametros;$i++)
							{
                                /*
                                //Si no recibe valor en el parametro hace el bind con vacio para al menos hacerlo valido
                                if($parametros[$i-1] == "")
                                    $consulta->bindValue($i,'');  // $consulta->bindValue($i,PDO::PARAM_NULL);
                                else
                                */
                                    $consulta->bindValue($i, $parametros[$i-1]);
								//echo 'Parametro '.$i.'='.$parametros[$i-1]."<br>"; //PARA DEPURACION
							}
					}
				$consulta->execute();

				//Lleva el log a auditoria en caso de estar encendido
				if ($EvitarLogSQL==0)
					if ($DepuracionSQL==1)
						PCO_Auditar($query,"SQLog:$PCOSESS_LoginUsuario");

				return $consulta;
				//return $consulta->fetchAll();
			}
		catch( PDOException $ErrorPDO)
			{
			    //Lleva el log de errores
			    PCO_Auditar($query,"SQLog:error");
			    $mensaje_final='';
			    $detalles_conexion=' (CNX='.$ConexionPDO->getAttribute(PDO::ATTR_CONNECTION_STATUS).') ';
				//Muestra detalles del query solo al admin y si el modo de depuracion se encuentra activo
				if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
					$mensaje_final.=$ErrorPDO->getMessage().'<br><b>'.$MULTILANG_Detalles.'</b>: '.@PCO_CompletarParametros($query,$parametros).$detalles_conexion."<br><b>$MULTILANG_Archivo</b>: ".$ErrorPDO->getFile()." -> ".$ErrorPDO->getLine();
				else
					$mensaje_final.='<b>'.$MULTILANG_Detalles.'</b>: '.$detalles_conexion.$MULTILANG_ErrorSoloAdmin;

				//Presenta el mensaje sobre el HTML y como Emergente JS
                PCO_Mensaje($MULTILANG_ErrorTiempoEjecucion,$mensaje_final, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
				echo '<script type="" language="JavaScript"> alert("'.$MULTILANG_ErrorTiempoEjecucion.'\\n\\n'.$mensaje_final.'");</script>';
				//Redirecciona segun la accion
				if ($PCO_Accion=="Iniciar_login")
					echo '<form name="Acceso" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="PCO_Accion" value=""></form><script type="" language="JavaScript">	document.Acceso.submit();  </script>';
				return 1;
			}
	}


########################################################################
########################################################################
/*
	Function: PCO_EjecutarNoSQL
	Ejecuta consultas hacia motores NoSQL

	Variables de entrada:

		ConexionNoSQL - Variable de conexion previamente creada
		LlaveRegistro - Consulta preformateada para ser ejecutada en el motor

	Salida:
		Retorna mensaje en pantalla con la descripcion devuelta por el driver en caso de error
		Retorna una variable con el arreglo de resultados en caso de ser exitosa la consulta
*/
    //Funcion para compatibilidad hacia atras.  Desaparecera en la version 18.9
    function ejecutar_nosql($ConexionNoSQL,$LlaveRegistro="")
    { echo "ERROR: Llamado a funcion obsoleta del framework ejecutar_nosql().  En su lugar utilice PCO_EjecutarNoSQL() "; }
function PCO_EjecutarNoSQL($ConexionNoSQL,$LlaveRegistro="")
	{
		global $ModoDepuracion;
		global $MULTILANG_ErrorTiempoEjecucion,$MULTILANG_Detalles,$MULTILANG_ErrorSoloAdmin;
		global $PCO_Accion;
		global $PCOSESS_LoginUsuario;
		try
			{
				if ($ConexionNoSQL[TipoMotor]=="couchbase")
					{
						//Si la llave de registro para consulta unica fue entregada hace la operacion
						if ($LlaveRegistro!="")
							$ResultadosNoSQL = $ConexionNoSQL[Enlace]->get($LlaveRegistro);
					}
				return $ResultadosNoSQL;
			}
		catch( Exception $CODError)
			{
				//Muestra detalles del query solo al admin y si el modo de depuracion se encuentra activo
				if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
					$mensaje_final=$CODError->getMessage().'<br><b>'.$MULTILANG_Detalles.'</b>: ';
				else
					$mensaje_final='<b>'.$MULTILANG_Detalles.'</b>: '.$MULTILANG_ErrorSoloAdmin;
				//Presenta el mensaje sobre el HTML y como Emergente JS
                PCO_Mensaje($MULTILANG_ErrorTiempoEjecucion,$mensaje_final, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
				echo '<script type="" language="JavaScript"> alert("'.$MULTILANG_ErrorTiempoEjecucion.'\\n\\n'.$mensaje_final.'");</script>';
				//Redirecciona segun la accion
				if ($PCO_Accion=="Iniciar_login")
					echo '<form name="Acceso" action="'.$ArchivoCORE.'" method="POST"><input type="Hidden" name="PCO_Accion" value=""></form><script type="" language="JavaScript">	document.Acceso.submit();  </script>';
				return 1;
			}
	}


########################################################################
########################################################################
/*
	Function: PCO_EjecutarSQLUnaria
	Ejecuta consultas que no retornan registros tales como CREATE, INSERT, DELETE, UPDATE entre otros.

	Variables de entrada:

		query - Consulta preformateada para ser ejecutada en el motor
		param - Lista de parametros que deben ser preparados para el query separados por coma
		ConexionBD - Determina si la consulta debe ser ejecutada en otra conexion o motor.  Se hace obligatorio enviar parametros cuando se envia otra conexion
		ReplicaRecursiva - Indica si se deben buscar o no conexiones adicionales para realizar replica de oepraciones.  Normalmente inicia en 1, pero las llamadas sucesivas se hacen en 0 para evitar llamadas infinitas

	Salida:
		Retorna una cadena que contiene una descripcion de error PDO en caso de error y agrega un mensaje en pantalla con la descripcion devuelta por el driver
		Retorna una cadena vacia si la consulta es ejecutada sin problemas.
*/
    //Funcion para compatibilidad hacia atras.  Desaparecera en la version 18.9
    function ejecutar_sql_unaria($query,$lista_parametros="",$ConexionBD="",$ReplicaRecursiva=1,$EvitarLogSQL=0)
    { echo "ERROR: Llamado a funcion obsoleta del framework ejecutar_sql_unaria().  En su lugar utilice PCO_EjecutarSQLUnaria() "; }
function PCO_EjecutarSQLUnaria($query,$lista_parametros="",$ConexionBD="",$ReplicaRecursiva=1,$EvitarLogSQL=0)
	{
		global $ListaCamposSinID_replicasbd,$TablasCore,$DepuracionSQL,$MotorBD,$PCOSESS_LoginUsuario;

		//Agrega comentario al query con nombre del usuario si aplica
		if (@$PCOSESS_LoginUsuario!="" && @$MotorBD=="mysql")
		    $query="/*US={$PCOSESS_LoginUsuario}*/ ".$query;

		//Si aplica la replica recursiva entonces busca las conexiones
		if ($ReplicaRecursiva==1)
			{
				//Busca conexiones configuradas como replica
				$ConexionesReplica=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_replicasbd." FROM ".$TablasCore."replicasbd WHERE tipo_replica=1 ");
				//Recorre cada conexion de replica encontrada para realizar la operacion
				while ($registro_conexion = $ConexionesReplica->fetch())
					{
						global ${$registro_conexion["nombre"]};
						//Hace el llamado a la operacion de replica sobre la conexion encontrada
						PCO_EjecutarSQLUnaria($query,$lista_parametros,${$registro_conexion["nombre"]},0);
					}
			}

		//Determina si se debe usar la conexion global del sistema o una especifica de usuario
		if($ConexionBD=="")
			global $ConexionPDO;
		else
			$ConexionPDO=$ConexionBD;

		global $ModoDepuracion;
		global $_SeparadorCampos_;
		global $MULTILANG_ErrorTiempoEjecucion,$MULTILANG_Detalles,$MULTILANG_ErrorSoloAdmin,$MULTILANG_ContacteAdmin,$MULTILANG_MotorBD;
		try
			{
				$consulta = $ConexionPDO->prepare($query);
				//Cuando se reciben parametros entonces se asume recepcion de querys con  interrogaciones  ?
				//que deben ser preparados antes de ejecutarse con cada uno de los parametros recibidos
				if ($lista_parametros!="")
					{
						$cantidad_parametros=substr_count($query,'?');
						$parametros=@explode($_SeparadorCampos_,$lista_parametros);
						// if ($cantidad_parametros!=count($parametros)) //La cantidad de parametros en query es diferente a los recibidos
						//Recorre cada parametro y toma su valor
						for ($i=1;$i<=$cantidad_parametros;$i++)
							{
                                //Si no recibe valor en el parametro hace el bind con null para al menos hacerlo valido
                                /*
                                if($parametros[$i-1] == '')
                                    //$consulta->bindValue($i,PDO::PARAM_NULL);
                                    //$consulta->bindValue($i,'');
                                    //$consulta->bindValue($i,$parametros[$i-1]);
                                    $consulta->bindParam($i,$parametros[$i-1]);
                                else
                                    //$consulta->bindValue($i, $parametros[$i-1]);
                                */
                                    //$consulta->bindValue($i, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $parametros[$i-1]));
                                    //$consulta->bindValue($i, utf8_encode($parametros[$i-1]));
                                    $consulta->bindValue($i, $parametros[$i-1]);
								//echo 'Parametro '.$i.'='.$parametros[$i-1]."<br>"; //PARA DEPURACION
							}
					}
				$consulta->execute();

				//Lleva el log a auditoria en caso de estar encendido
				if ($EvitarLogSQL==0)
					if ($DepuracionSQL==1)
						PCO_Auditar($query,"SQLog:$PCOSESS_LoginUsuario");

				return $consulta;
			}
		catch( PDOException $ErrorPDO)
			{
			    //Lleva el log de errores
			    PCO_Auditar($query,"SQLog:error");
			    $detalles_conexion=' (CNX='.$ConexionPDO->getAttribute(PDO::ATTR_CONNECTION_STATUS).') ';
				//Muestra detalles del query solo al admin y si el modo de depuracion se encuentra activo
				if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
                    echo '<script language="JavaScript"> alert("'.$MULTILANG_ErrorTiempoEjecucion.'\n'.$MULTILANG_Detalles.': '.PCO_CompletarParametros($query,$parametros).'\n\n'.$detalles_conexion.'\n\n'.$MULTILANG_MotorBD.': '.$ErrorPDO->getMessage().'.\n\n'.$MULTILANG_ContacteAdmin.'");  </script>';
				else
					echo '<script language="JavaScript"> alert("'.$MULTILANG_ErrorTiempoEjecucion.'\n'.$MULTILANG_Detalles.': '.$detalles_conexion.'\n\n'.$MULTILANG_ErrorSoloAdmin.'.\n\n'.$MULTILANG_ContacteAdmin.'");  </script>';
				return $MULTILANG_ErrorTiempoEjecucion;
			}
	}



########################################################################
########################################################################
/*
	Function: PCO_ProcedimientoSQL
	Ejecuta procedimientos almacenados por la base de datos

	Variables de entrada:

		procedimiento - Procedimiento que debe residir en la base de datos y que ha de ser ejecutado
		ConexionBD - Determina si la consulta debe ser ejecutada en otra conexion o motor.  Se hace obligatorio enviar parametros cuando se envia otra conexion

	Salida:
		Retorna 0 en caso de tener problemas con la ejecucion del procedimiento
		Retorna una cadena vacia si el procedimiento es llamado y ejecutado sin problemas
*/
    //Funcion para compatibilidad hacia atras.  Desaparecera en la version 18.9
    function ejecutar_sql_procedimiento($procedimiento,$ConexionBD="")
    { echo "ERROR: Llamado a funcion obsoleta del framework ejecutar_sql_procedimiento().  En su lugar utilice PCO_ProcedimientoSQL() "; }
function PCO_ProcedimientoSQL($procedimiento,$ConexionBD="")
	{
		//Determina si se debe usar la conexion global del sistema o una especifica de usuario
		if($ConexionBD=="")
			global $ConexionPDO;
		else
			$ConexionPDO=$ConexionBD;

		try
			{
				$ConexionPDO->exec($procedimiento);
				return "";
			}
		catch(PDOException $e)
			{
				return $e->getMessage();
			}
	}



########################################################################
########################################################################
/*
	Function: PCO_Auditar
	Lleva un registro de auditoria en el sistema

	Variables de entrada:

		accion - Descripcion de la accion a ser almacenada en la auditoria

	Salida:

		Registro de auditoria llevado sobre la tabla
*/
    //Funcion para compatibilidad hacia atras.  Desaparecera en la version 18.9
    function auditar($PCO_Accion,$usuario="")
    { echo "ERROR: Llamado a funcion obsoleta del framework auditar().  En su lugar utilice PCO_Auditar() "; }
function PCO_Auditar($PCO_Accion,$usuario="")
	{
		global $ArchivoCORE,$TablasCore;
		global $ListaCamposSinID_auditoria,$_SeparadorCampos_;
		global $PCOSESS_LoginUsuario,$PCO_FechaOperacion,$PCO_HoraOperacion;
		//Establece el usuario para el registro
		if ($usuario=="")
			$usuario_auditar=$PCOSESS_LoginUsuario;
		else
			$usuario_auditar=$usuario;
		//Lleva el registro
		PCO_EjecutarSQLUnaria("INSERT INTO ".$TablasCore."auditoria (".$ListaCamposSinID_auditoria.") VALUES (?,?,?,?)","$usuario_auditar$_SeparadorCampos_$PCO_Accion$_SeparadorCampos_$PCO_FechaOperacion$_SeparadorCampos_$PCO_HoraOperacion","","",1,1);
	}



########################################################################
########################################################################
/*
	Function: PCO_ExisteValor
	Busca dentro de alguna tabla para verificar si existe o no un valor determinado.  Funcion utilizada para validacion de unicidad de valores en formularios de datos.

	Variables de entrada:

		tabla - Nombre de la tabla donde se desea buscar.
		campo - Campo de la tabla sobre el cual se desea comparar la existencia del valor.
		valor - Valor a buscar dentro del campo.

	Salida:
		Retorna 1 en caso de encontrar un valor dentro de la tabla y campo especificadas y que coincida con el parametro buscado
		Retorna 0 cuando no se encuentra un valor en la tabla que coincida con el buscado
*/
function PCO_ExisteValor($tabla,$campo,$valor)
	{
		global $ConexionPDO;
		$consulta = $ConexionPDO->prepare("SELECT $campo FROM $tabla WHERE $campo='$valor'");
		$consulta->execute();
		$registro = $consulta->fetch();
		if ($registro[0]!="")
			{
				return 1;
			}
		else
			{
				return 0;
			}
	}



########################################################################
########################################################################
	/*
		Section: Funciones asociadas al retorno de informacion sobre la conexion y estructura de la BD
	*/
########################################################################
########################################################################
/*
	Function: PCO_InformacionConexionBD
	Imprime la informacion asociada a la conexion establecida mediante PDO.

	Ver tambien:
	<PCO_ImprimirDriversDisponiblesnBD> | <Definicion de conexion PDO>
*/
function PCO_InformacionConexionBD()
	{
		echo "<hr><center><blink><b><font color=yellow>".$MULTILANG_Detalles.":</font></b></blink><br>";
		echo $MULTILANG_Controlador.': '.$ConexionPDO->getAttribute(PDO::ATTR_DRIVER_NAME).'<br>';
		echo $MULTILANG_Version.' '.$MULTILANG_Servidor.': '.$ConexionPDO->getAttribute(PDO::ATTR_SERVER_VERSION).'<br>';
		echo $MULTILANG_Estado.': '.$ConexionPDO->getAttribute(PDO::ATTR_CONNECTION_STATUS).'<br>';
		echo $MULTILANG_Version.' '.$MULTILANG_Cliente.': '.$ConexionPDO->getAttribute(PDO::ATTR_CLIENT_VERSION).'<br>';
		echo $MULTILANG_InfoAdicional.': '.$ConexionPDO->getAttribute(PDO::ATTR_SERVER_INFO).'<hr>';
	}



########################################################################
########################################################################
/*
	Function: PCO_ImprimirDriversDisponiblesnBD
	Imprime el arreglo devuelto por la funcion getAvailableDrivers() para conocer los drivers soportados por la instalacion actual de PHP del lado del servidor.

	Salida:
		Listado de drivers PDO soportados

	Ver tambien:
	<PCO_InformacionConexionBD>
*/
function PCO_ImprimirDriversDisponiblesnBD()
	{
		/*foreach(PDO::getAvailableDrivers() as $driver)
			{
				echo "<hr>".$driver;
			}*/
		print_r(PDO::getAvailableDrivers());
	}





########################################################################
########################################################################
/*
	Function: PCO_ConsultarTablas
	Determina las tablas en la base de datos activa para la conexion dependiendo del motor utilizado.

	Variables de entrada:

		prefijo - Prefijo del nombre de tablas que seran retornadas

	Salida:
		Resultado de un query con las tablas  o falso en caso de error

	Ver tambien:
	<Definicion de conexion PDO>
*/
function PCO_ConsultarTablas($prefijo="",$ConexionAlterna="",$MotorAlterno="",$BaseDatosAlterna="")
	{
		global $MULTILANG_ErrorTiempoEjecucion;
		//Determina si se debe usar la conexion global del sistema o una especifica de usuario
		if($ConexionAlterna=="")
		    {
			    global $ConexionPDO;
    			global $MotorBD;
    			global $BaseDatos;
		    }
		else
		    {
			    $ConexionPDO=$ConexionAlterna;
    			$MotorBD=$MotorAlterno;
    			$BaseDatos=$BaseDatosAlterna;
		    }

		if($MotorBD=="sqlsrv" || $MotorBD=="mssql" || $MotorBD=="ibm" || $MotorBD=="dblib" || $MotorBD=="odbc")
				$consulta = "SELECT name FROM sysobjects WHERE xtype='U';";
		if($MotorBD=="sqlite")
				$consulta = "SELECT name FROM sqlite_master WHERE type IN ('table','view') AND name NOT LIKE 'sqlite_%' UNION ALL SELECT name FROM sqlite_temp_master WHERE type IN ('table','view') ORDER BY 1";
		if($MotorBD=="oracle")
				$consulta = "SELECT table_name FROM cat;";  //  Si falla probar con esta:  $consulta = "SELECT table_name FROM tabs;";
		if($MotorBD=="ifmx" || $MotorBD=="fbd")
				$consulta = "SELECT RDB$RELATION_NAME FROM RDB$RELATIONS WHERE RDB$SYSTEM_FLAG = 0 AND RDB$VIEW_BLR IS NULL ORDER BY RDB$RELATION_NAME;";
		if($MotorBD=="mysql")
				$consulta = "SHOW tables FROM ".$BaseDatos." ";
		if($MotorBD=="pgsql")
				$consulta = "SELECT relname AS name FROM pg_stat_user_tables ORDER BY relname;";

		try
			{
				$consulta_tablas=PCO_EjecutarSQL($consulta,"",$ConexionPDO,1);
				return $consulta_tablas;
			}
		catch( PDOException $ErrorPDO)
			{
                PCO_Mensaje($MULTILANG_ErrorTiempoEjecucion,$ErrorPDO->getMessage(), '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
				return false;
			}
	}


########################################################################
########################################################################
/*
	Function: consultar_nombres_columnas
	Devuelve un arreglo escalar y asociativo con los nombres de las columnas de una tabla y sus datos generales

	Variables de entrada:

		tabla - Nombre de la tabla de la que se desea consultar los nombre de columnas o campos

	Salida:
		Vector de campos/columnas

	Ver tambien:
	<PCO_ConsultarTablas>
*/
function PCO_ConsultarColumnas($tabla,$ConexionAlterna="",$MotorAlterno="",$BaseDatosAlterna="")
	{
		global $MULTILANG_ErrorTiempoEjecucion;
		//Determina si se debe usar la conexion global del sistema o una especifica de usuario
		if($ConexionAlterna=="")
		    {
			    global $ConexionPDO;
    			global $MotorBD;
    			global $BaseDatos;
		    }
		else
		    {
			    $ConexionPDO=$ConexionAlterna;
    			$MotorBD=$MotorAlterno;
    			$BaseDatos=$BaseDatosAlterna;
		    }

		//Busca los campos dependiendo del motor de BD configurado actualmente
		if ($MotorBD=="mysql" || $MotorBD=="sqlsrv" || $MotorBD=="mssql" || $MotorBD=="ibm" || $MotorBD=="dblib" || $MotorBD=="odbc" || $MotorBD=="oracle" || $MotorBD=="ifmx" || $MotorBD=="fbd")
			{
				$columna=0;
				$resultado=PCO_EjecutarSQL("DESCRIBE $tabla ","",$ConexionPDO,1);
				//echo $resultado;
				//Evalua si se retorno 1 (error) por la funcion para saber si sigue o no
				//if($resultado!="1")
					{
						while($registro = $resultado->fetch())
							{
								$columnas[$columna]["nombre"] = $registro["Field"];
								$columnas[$columna]["tipo"] = $registro["Type"];
								$columnas[$columna]["nulo"] = $registro["Null"];
								$columnas[$columna]["llave"] = $registro["Key"];
								$columnas[$columna]["predefinido"] = $registro["Default"];
								$columnas[$columna]["extras"] = $registro["Extra"];
								$columna++;
							}
					}
				/*else
					{
								$columnas[$columna]["nombre"] = "ERROR: Tabla no conectada";
								$columnas[$columna]["tipo"] = "ERROR: Tabla no conectada";
								$columnas[$columna]["nulo"] = "ERROR: Tabla no conectada";
								$columnas[$columna]["llave"] = "ERROR: Tabla no conectada";
								$columnas[$columna]["predefinido"] = "ERROR: Tabla no conectada";
								$columnas[$columna]["extras"] = "ERROR: Tabla no conectada";
								$columna++;
					}*/
			}

		if ($MotorBD=="pgsql")
			{
				$columna=0;
				$resultado=PCO_EjecutarSQL("SELECT * from INFORMATION_SCHEMA.COLUMNS where table_name = ? ","$tabla",$ConexionPDO,1);
				while($registro = $resultado->fetch())
					{
						$columnas[$columna]["nombre"] = $registro["column_name"];
						$columnas[$columna]["tipo"] = $registro["data_type"];
						$columnas[$columna]["nulo"] = $registro["is_nullable"];
						$columnas[$columna]["llave"] = "";
						$columnas[$columna]["predefinido"] = $registro["column_default"];
						$columnas[$columna]["extras"] = $registro["udt_name"];
						$columna++;
					}
			}

		if ($MotorBD=="sqlite")
			{
				$columna=0;
				$resultado=PCO_EjecutarSQL("SELECT * FROM sqlite_master WHERE type='table' AND name=? ","$tabla",$ConexionPDO,1);
				$registro = $resultado->fetch();
				//Toma los campos encontrados en el SQL de la tabla, los separa y los depura para devolver valores
				$campos=explode(",",$registro["sql"]);
				for($i=0;$i<count($campos);$i++)
					{
						$campos[$i]=trim($campos[$i]);  // Elimina espacios al comienzo y final
						$campos[$i]=str_replace("  "," ",$campos[$i]);  //Elimina espacios dobles
						if ($i==0) $campos[$i]=str_replace("CREATE TABLE $tabla (","",$campos[$i]);  //Elimina instruccion create del primer campo
						if ($i==count($campos)-1) $campos[$i]=str_replace("))",")",$campos[$i]);  //Elimina ultimos parentesis
						//echo $i." valor:".$campos[$i]."<hr>"; //  Usado para depuracion en tiempo de desarrollo
						$analisis_campo=explode(" ",$campos[$i]);
						$columnas[$columna]["nombre"] = $analisis_campo[0];
						$columnas[$columna]["tipo"] = $analisis_campo[1];
						$palabra_siguiente=2;
						if (trim(strtoupper($analisis_campo[$palabra_siguiente]))=="PRIMARY")
							{
								$columnas[$columna]["llave"] = $analisis_campo[$palabra_siguiente];
								$palabra_siguiente+=2;
							}
						if (trim(strtoupper($analisis_campo[$palabra_siguiente]))=="NOT")
							{
								$columnas[$columna]["nulo"] =  $analisis_campo[$palabra_siguiente]." ".$analisis_campo[$palabra_siguiente+1];
								$palabra_siguiente+=2;
							}
						if (trim(strtoupper($analisis_campo[$palabra_siguiente]))=="DEFAULT")
							{
								$columnas[$columna]["predefinido"] =  $analisis_campo[$palabra_siguiente+1];
								$palabra_siguiente+=2;
							}
						$columnas[$columna]["extras"] = $registro[""];
						$columna++;
					}
			}


		//Retorna el arreglo asociativo
		return $columnas;


		/*//Forma 1 (General solo nombres)
		$resultado=PCO_EjecutarSQL("SELECT * FROM ".$tabla);
		$columnas = array();
		foreach($resultado->fetch(PDO::FETCH_ASSOC) as $key=>$val)
			{
				$columnas[]["nombre"] = $key;
			}
		return $columnas;*/

		/*//Forma 2
		$resultado=PCO_EjecutarSQL("SELECT * FROM ".$tabla);
		$columnas = array();
		for ($i = 0; $i < $resultado->columnCount(); $i++)
			{
				$col = $resultado->getColumnMeta($i);
				$columnas[] = $col['name'];
			}
		return $columnas;*/
	}


########################################################################
########################################################################
/*
	Function: PCO_ExisteCampoTabla
	Determina si un campo dado existe dentro de una tabla especifica

	Variables de entrada:

		tabla - Nombre de la tabla de la que se desea buscar el campo
		campo - Nombre del campo a verificar

	Salida:
		verdadero o falso dependiendo de si existe o no el campo en la tabla

	Ver tambien:
	<PCO_ConsultarTablas>
*/
function PCO_ExisteCampoTabla($campo,$tabla,$ConexionAlterna="",$MotorAlterno="",$BaseDatosAlterna="")
	{
		//Determina si se debe usar la conexion global del sistema o una especifica de usuario
		if($ConexionAlterna=="")
		    {
			    global $ConexionPDO;
    			global $MotorBD;
    			global $BaseDatos;
		    }
		else
		    {
			    $ConexionPDO=$ConexionAlterna;
    			$MotorBD=$MotorAlterno;
    			$BaseDatos=$BaseDatosAlterna;
		    }

		//Asume que el campo no existe
		$estado=false;

		//Busca todos los campos de la tabla
		if($ConexionAlterna!="")
		    $resultadocampos=PCO_ConsultarColumnas($tabla,$ConexionPDO,$MotorBD,$BaseDatos);
		else
		    $resultadocampos=PCO_ConsultarColumnas($tabla);

		for($i=0;$i<count($resultadocampos);$i++)
			{
				//Si el campo en el arreglo es igual al campo buscado cambia el estado a verdadero
				if ($resultadocampos[$i]["nombre"]==$campo)
					$estado=true;
			}

		//Retorna el resultado
		return $estado;
	}


########################################################################
########################################################################
/*
	Function: PCO_FileGetContents_CURL
	Un reemplazo para la funcion file_get_contents utilizando cURL
	
	Variables de entrada:

		URLBase - La URL base del recurso que se desea cargar
		OpcionesJSON - Un arreglo de opciones para inicializar y personalizar el objeto CURL e formato JSON. Ej:  {"CURLOPT_MAXREDIRS":10,"CURLOPT_FOLLOWLOCATION":true}
		CabecerasArray - ARREGLO DE PHP de cabeceras que son utilizadas en la conexion.  Ej:  array("Content-Type: application/json","Authorization: Bearer XXXXX" );
		PostJSON - Arreglo con variables y valores a transportar en peticiones POST.  Ej:    {  "model": "MiValor1","max_tokens": 200, "n": 1 }


	Salida:
		Contenido de la URL recibida
*/
function PCO_FileGetContents_CURL($URLBase,$OpcionesJSON,$CabecerasArray,$PostJSON)
	{
		global $MULTILANG_ErrExtension,$MULTILANG_ErrCURL;
		
		//Por defecto inicializa opciones minimas para compatibilidad hacia atras
		if ($OpcionesJSON=="")
		    $OpcionesJSON='{"CURLOPT_HEADER":0,"CURLOPT_RETURNTRANSFER":true}';

		//Verifica soporte para cURL
		if (!extension_loaded('curl'))
            PCO_Mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrCURL, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
		//Verifica que la funcion se encuentre activada
		$funcion_evaluada='curl_init'; $valor_esperado='1';
		if (function_exists($funcion_evaluada)==$valor_esperado)
			{
				//Inicializa el objeto cURL y procesa la solicitud
				$objeto_curl = curl_init();

                // Establecer los valores de los encabezados personalizados en la llamada CURL
				if ($CabecerasArray!="")
                    curl_setopt($objeto_curl, CURLOPT_HTTPHEADER, $CabecerasArray);

                //Decodifica los parametros
                $OpcionesJSON = json_decode($OpcionesJSON, true);
                foreach ($OpcionesJSON as $OpcionCURL => $ValorOpcion) {
                  curl_setopt($objeto_curl, constant($OpcionCURL), $ValorOpcion);
                }

				if ($PostJSON!="")
				    curl_setopt($objeto_curl, CURLOPT_POSTFIELDS, $PostJSON);

				curl_setopt($objeto_curl, CURLOPT_URL, $URLBase);
				$datos_recibidos = curl_exec($objeto_curl);
				curl_close($objeto_curl);
			}
        //$datos_recibidos='{"id":"chatcmpl-7JQGxRjF08wGL06cuzJNTOdJL8q33","object":"chat.completion","created":1684863579,"model":"gpt-3.5-turbo-0301","usage":{"prompt_tokens":34,"completion_tokens":71,"total_tokens":105},"choices":[{"message":{"role":"assistant","content":"El error de sintaxis en este código es que la variable $hora no tiene un valor válido asignado. La expresión \"34-\" no es un valor numérico válido en PHP. Para corregir este error, se debe asignar a la variable $hora un valor numérico válido, por ejemplo: $hora = 34;"},"finish_reason":"stop","index":0}]}';
		return $datos_recibidos;
	}


########################################################################
########################################################################
/*
	Function: PCO_FileGetContents_SOCKET
	Un reemplazo para la funcion file_get_contents utilizando Sockets
*/
function PCO_FileGetContents_SOCKET($url)
	{
		$url_parsed = parse_url($url);
		$host = $url_parsed["host"];
		$port = $url_parsed["port"];
		if ($port==0)
			$port = 80;
		$path = $url_parsed["path"];
		if ($url_parsed["query"] != "")
			$path .= "?".$url_parsed["query"];

		$out = "GET $path HTTP/1.0\r\nHost: $host\r\n\r\n";

		$fp = fsockopen($host, $port, $errno, $errstr, 30);

		fwrite($fp, $out);
		$body = false;
		while (!feof($fp))
			{
				$s = fgets($fp, 1024);
				if ( $body )
					$in .= $s;
				if ( $s == "\r\n" )
					$body = true;
			}
		fclose($fp);
		return $in;
	}


########################################################################
########################################################################
/*
	Function: PCO_FileGetContents_NATIVO
	Una personalizacion para la funcion file_get_contents de PHP agregando Agente de navegador y otros.

	Salida:
		Contenido de la URL recibida
*/
function PCO_FileGetContents_NATIVO($url)
	{
        //ORIGINAL$contenido_url = trim(file_get_contents($url));
        //Define el contexto de navegacion
        $opciones_navegacion = array(
          'http'=>array(
            'method'=>"GET",
            'header'=>"Accept-language: en\r\n" .
                      "Cookie: foo=bar\r\n" .  // check function.stream-context-create on php.net
                      "User-Agent: Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.102011-10-16 20:23:10\r\n" // i.e. An iPad
          )
        );
        //$opciones_navegacion  = array('http' => array('user_agent' => 'custom user agent string'));

        $contexto_navegacion = stream_context_create($opciones_navegacion);
        $datos_recibidos = file_get_contents($url, false, $contexto_navegacion);
		return $datos_recibidos;
	}


########################################################################
########################################################################
/*
	Function: PCO_CargarURL
	Recibe una URL y pasa su contenido a una cadena de texto
*/
function PCO_CargarURL($url)
	{
		$contenido_url="";

		//Intenta con cURL si esta habilitado
		$funcion_evaluada='curl_init'; $valor_esperado='1';
		if (@$contenido_url=="")
			if (ini_get($funcion_evaluada)==$valor_esperado)
				$contenido_url = trim(PCO_FileGetContents_CURL($url));

		$funcion_evaluada='allow_url_fopen'; $valor_esperado='1';
		//Intenta con la funcion nativa de PHP si esta habilitada y no se pudo obtener nada con cURL
		if (@$contenido_url=="")
			if (ini_get($funcion_evaluada)==$valor_esperado)
				$contenido_url = trim(PCO_FileGetContents_NATIVO($url));

		//Intenta con funciones de socket si no se pudo obtener nada con file_get_contents
		if (@$contenido_url=="")
			$contenido_url = trim(PCO_FileGetContents_SOCKET($url));

		//Retorna el resultado
		return $contenido_url;
	}


########################################################################
########################################################################
/*
	Function: PCO_VerificarExtensionesPHP
	Verifica si las extensiones minimas requeridas por la herramienta se encuentran activadas y despliega mensaje de error si aplica.

	Salida:
		Mensajes de error asociados a la no activacion de cada extension
*/
function PCO_VerificarExtensionesPHP()
	{
		global $MotorBD;
		global $Auth_TipoMotor;
		global $Auth_TipoEncripcion;
		global $MULTILANG_ErrExtensionGenerica,$MULTILANG_ErrExtension,$MULTILANG_ErrSimpleXML,$MULTILANG_ErrCURL,$MULTILANG_ErrLDAP,$MULTILANG_ErrHASH,$MULTILANG_ErrSESS,$MULTILANG_ErrGD,$MULTILANG_ErrPDO,$MULTILANG_ErrDriverPDO,$MULTILANG_ErrGoogleAPIMod,$MULTILANG_ErrFuncion,$MULTILANG_ErrDirectiva;

		//Verifica estado de configuraciones PHP
		$funcion_evaluada='allow_url_fopen'; $valor_esperado='1';
			//Intenta encenderla (para servidores con suPHP)
			if (ini_get($funcion_evaluada)!=$valor_esperado) {ini_set($funcion_evaluada,$valor_esperado);}
			//Verifica si pudo ser encendida en tiempo de ejecucion, sino muestra mensaje y solamente si no hay cURL pues es un sustituto
			if (ini_get($funcion_evaluada)!=$valor_esperado && !extension_loaded('curl'))
				PCO_Mensaje($MULTILANG_ErrFuncion,$funcion_evaluada.': '.$MULTILANG_ErrDirectiva, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

		//Verifica soporte para LDAP cuando esta activado en la herramienta
		if ($Auth_TipoMotor=='ldap' &&  !extension_loaded('ldap'))
			PCO_Mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrLDAP, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

		//Verifica soporte para HASH cuando se requiere encripcion
		if ($Auth_TipoEncripcion!="plano" && !extension_loaded('hash'))
			PCO_Mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrHASH, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

		//Verifica soporte para sesiones
		if (!extension_loaded('session'))
			PCO_Mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrSESS, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

		//Verifica soporte para GD2
		if (!extension_loaded('gd'))
			PCO_Mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrGD, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

		//Verifica soporte para PDO
		if (!extension_loaded('pdo'))
			PCO_Mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrPDO, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

		//Verifica soporte para el driver PDO correspondiente al motor utilizado
		if (!extension_loaded('pdo_'.$MotorBD))
			PCO_Mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrDriverPDO, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

		//Verifica soporte para SimpleXML
		if (!extension_loaded('SimpleXML'))
			PCO_Mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrSimpleXML, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

		//Verifica soporte para Multibyte strings
		if (!extension_loaded('mbstring'))
			PCO_Mensaje($MULTILANG_ErrExtension,'<b>mbstring:</b> '.$MULTILANG_ErrExtensionGenerica, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

		//Verifica soporte para funciones POSIX
		if (!extension_loaded('posix'))
			PCO_Mensaje($MULTILANG_ErrExtension,'<b>posix:</b> '.$MULTILANG_ErrExtensionGenerica, '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');


		// Bloqueos por IP/pais http://stackoverflow.com/questions/15835274/file-get-contents-failed-to-open-stream-connection-refused

		// Verifica el soporte para funciones especificas PHP
		$funcion_evaluada='file_get_contents';
		if (!function_exists($funcion_evaluada))
            PCO_Mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrFuncion.'<b>'.$funcion_evaluada.'</b>', '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

		// Verifica el soporte para funciones especificas PHP
		$funcion_evaluada='simplexml_load_string';
		if (!function_exists($funcion_evaluada))
            PCO_Mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrFuncion.'<b>'.$funcion_evaluada.'</b>', '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

		// Verifica el soporte para funciones especificas PHP
		$funcion_evaluada='simplexml_load_string';
		if (!function_exists($funcion_evaluada))
            PCO_Mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrFuncion.'<b>'.$funcion_evaluada.'</b>', '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

		// Verifica el soporte para funciones especificas PHP
		$funcion_evaluada='posix_getpwuid';
		if (!function_exists($funcion_evaluada))
            PCO_Mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrFuncion.'<b>'.$funcion_evaluada.'</b>', '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

		// Verifica el soporte para funciones especificas PHP
		$funcion_evaluada='posix_getgrgid';
		if (!function_exists($funcion_evaluada))
            PCO_Mensaje($MULTILANG_ErrExtension,$MULTILANG_ErrFuncion.'<b>'.$funcion_evaluada.'</b>', '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
	}


########################################################################
########################################################################
/*
	Function: PCO_BuscarActualizaciones
	Compara la version actual del sistema frente a la ultima version publicada para determinar si existen o no actualizaciones

	Salida:
		Mensaje informativo en pantalla cuando se encuentren actualizaciones disponibles
*/
function PCO_BuscarActualizaciones($PCOSESS_LoginUsuario,$PCO_Accion)
	{
		global $MULTILANG_Atencion,$MULTILANG_ActAlertaVersion;
		// Genera un aleatorio entre 1 y 10 para no sacar siempre el aviso y buscar nuevas versiones.
		$buscar=rand(0,7);
		if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && $PCO_Accion=="PCO_VerMenu" && $buscar==1)
			{
				$path_ultima_version="http://devs.practico.org:3000/unix4you2/practico/raw/branch/master/dev/version_publicada.txt";
				$version_actualizada = @PCO_CargarURL($path_ultima_version);
				$archivo_origen="inc/version_actual.txt";
				$archivo = fopen($archivo_origen, "r");
				if ($archivo)
					{
						$version_practico = trim(fgets($archivo, 1024));
						fclose($archivo);
					}
				if ($version_actualizada>$version_practico)
					PCO_Mensaje($MULTILANG_Atencion,$MULTILANG_ActAlertaVersion.'<br><a href="https://www.practico.org/descargas" target="_blank" class="btn btn-default btn-xs" style="margin-left:90px;"><i class="fa fa-download fa-fw"></i> Descargar / Donwload </a><br><br>','','fa fa-exclamation-triangle fa-5x','TextosEscritorio');
			}
	}


########################################################################
########################################################################
/*
	Function: PCO_ConsultarBasesDeDatos
	Determina las bases de datos existentes dependiendo del motor utilizado.

	Salida:
		Resultado de un query con las bases de datos o falso en caso de error

	Ver tambien:
	<Definicion de conexion PDO> | <PCO_ConsultarTablas>
*/
function PCO_ConsultarBasesDeDatos()
	{
		global $ConexionPDO;
		global $MotorBD;
		global $BaseDatos;
		global $MULTILANG_ErrorTiempoEjecucion;

		if($MotorBD=="sqlsrv" || $MotorBD=="mssql" || $MotorBD=="ibm" || $MotorBD=="dblib" || $MotorBD=="odbc" || $MotorBD=="sqlite2" || $MotorBD=="sqlite3")
			$consulta = "SELECT name FROM sys.Databases;";
		if($MotorBD=="oracle")
			$consulta = 'SELECT * FROM v$database;';  //Si falla intentar con este: $consulta = "SELECT * FROM user_tablespaces";
		if($MotorBD=="ifmx" || $dbtype=="fbd")
			$consulta = "";
		if($MotorBD=="mysql")
			$consulta = "SHOW DATABASES;";
		if($MotorBD=="pg")
			$consulta = "SELECT datname AS name FROM pg_database;";

		try
			{
				$consulta_basesdatos = $ConexionPDO->prepare($consulta);
				$consulta_basesdatos->execute();
				return $consulta_basesdatos;
			}
		catch( PDOException $ErrorPDO)
			{
				PCO_Mensaje($MULTILANG_ErrorTiempoEjecucion,$ErrorPDO->getMessage(), '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
				return false;
			}
}


########################################################################
########################################################################
/*
	Function: PCO_ContarRegistrosTabla
	Devuelve la cantidad de registros existentes dentro de una tabla con una condicion determinada

	Salida:
		Valor numerico que indica la cantidad de registros encontrados

	Ver tambien:
	    <PCO_ConsultarTablas> | <PCO_ConsultarColumnas>
*/
function PCO_ContarRegistrosTabla($tabla,$condicion="")
	{
		global $ConexionPDO;

		//Si se recibe una concion la agrega a la consulta
		$ComplementoConsultaConteo="";
		if ($condicion!="") $ComplementoConsultaConteo=" WHERE $condicion ";
		//Ejecuta la consulta
		$consulta = $ConexionPDO->prepare("SELECT count(*) FROM $tabla $ComplementoConsultaConteo");
		$consulta->execute();
		$filas = $consulta->fetchColumn();
		return $filas;
	}


########################################################################
########################################################################
	/*
		Section: Funciones asociadas a la creacion de elementos graficos (ventanas, etc)
	*/
########################################################################
########################################################################

function PCO_CrearFormularioOauth($sitio)
    {
        global $ArchivoCORE;
        // Crea el formulario correspondiente para llamar el login con el proveedor
        $FormularioProveedor = '
            <form name="login_'.$sitio.'" method="POST" action="'.$ArchivoCORE.'" style="margin: 2; display: inline!important;">
            <input type="hidden" name="PCO_WSOn" value="1">
            <input type="hidden" name="OAuthSrv" value="'.$sitio.'">
            <input type="hidden" name="PCO_WSId" value="PCO_AutenticacionOauth">
            <!--232x86|150x56|94x35|81x30-->
            <button type="submit" class="btn btn-default  btn-default btn-lg" style="margin:10px; background-size: 100%; height: 56px; width:150px; background-position : center center; background-repeat:no-repeat; background-image : url(inc/oauth/logos/'.strtolower($sitio).'.png); ">&nbsp;</button>
            </form>';
        // Retorna valor de activacion a variable AlMenosUnOAuth
        return $FormularioProveedor;
    }


function PCO_ContarProveedoresOAuthConfigurados()
    {
        $Conteo=0;
        global $APIGoogle_ClientId,$APIGoogle_ClientSecret,$APIFacebook_ClientId,$APIFacebook_ClientSecret,$APILinkedIn_ClientId,$APILinkedIn_ClientSecret,$APIInstagram_ClientId,$APIInstagram_ClientSecret,$APIDropbox_ClientId,$APIDropbox_ClientSecret,$APIMicrosoft_ClientId,$APIMicrosoft_ClientSecret,$APIFlickr_ClientId,$APIFlickr_ClientSecret,$APITwitter_ClientId,$APITwitter_ClientSecret,$APIFoursquare_ClientId,$APIFoursquare_ClientSecret,$APIXING_ClientId,$APIXING_ClientSecret,$APISalesforce_ClientId,$APISalesforce_ClientSecret,$APIBitbucket_ClientId,$APIBitbucket_ClientSecret,$APIYahoo_ClientId,$APIYahoo_ClientSecret,$APIBox_ClientId,$APIBox_ClientSecret,$APIDisqus_ClientId,$APIDisqus_ClientSecret,$APIEventful_ClientId,$APIEventful_ClientSecret,$APISurveyMonkey_ClientId,$APISurveyMonkey_ClientSecret,$APIRightSignature_ClientId,$APIRightSignature_ClientSecret,$APIFitbit_ClientId,$APIFitbit_ClientSecret,$APIScoopIt_ClientId,$APIScoopIt_ClientSecret,$APITumblr_ClientId,$APITumblr_ClientSecret,$APIStockTwits_ClientId,$APIStockTwits_ClientSecret,$APIVK_ClientId,$APIVK_ClientSecret,$APIWithings_ClientId,$APIWithings_ClientSecret;
        // Crea los formularios de redireccion segun proveedor
        $CadenaProveedoresOAuthDisponibles="";
        if ($APIGoogle_ClientId!=''			            && $APIGoogle_ClientSecret!='')			            $Conteo++;
        if ($APIFacebook_ClientId!=''		            && $APIFacebook_ClientSecret!='')		            $Conteo++;
        if ($APILinkedIn_ClientId!=''		            && $APILinkedIn_ClientSecret!='')		            $Conteo++;
        if ($APIInstagram_ClientId!=''		            && $APIInstagram_ClientSecret!='')		            $Conteo++;
        if ($APIDropbox_ClientId!=''		            && $APIDropbox_ClientSecret!='')		            $Conteo++;
        if ($APIMicrosoft_ClientId!=''		            && $APIMicrosoft_ClientSecret!='')		            $Conteo++;
        if ($APIFlickr_ClientId!=''			            && $APIFlickr_ClientSecret!='')			            $Conteo++;
        if ($APITwitter_ClientId!=''		            && $APITwitter_ClientSecret!='')		            $Conteo++;
        if ($APIFoursquare_ClientId!=''		            && $APIFoursquare_ClientSecret!='')		            $Conteo++;
        if ($APIXING_ClientId!=''			            && $APIXING_ClientSecret!='')			            $Conteo++;
        if ($APISalesforce_ClientId!=''		            && $APISalesforce_ClientSecret!='')		            $Conteo++;
        if ($APIBitbucket_ClientId!=''		            && $APIBitbucket_ClientSecret!='')		            $Conteo++;
        if ($APIYahoo_ClientId!=''			            && $APIYahoo_ClientSecret!='')			            $Conteo++;
        if ($APIBox_ClientId!=''			            && $APIBox_ClientSecret!='')			            $Conteo++;
        if ($APIDisqus_ClientId!=''			            && $APIDisqus_ClientSecret!='')			            $Conteo++;
        if ($APIEventful_ClientId!=''		            && $APIEventful_ClientSecret!='')		            $Conteo++;
        if ($APISurveyMonkey_ClientId!=''	            && $APISurveyMonkey_ClientSecret!='')	            $Conteo++;
        if ($APIRightSignature_ClientId!=''	            && $APIRightSignature_ClientSecret!='')	            $Conteo++;
        if ($APIFitbit_ClientId!=''			            && $APIFitbit_ClientSecret!='')			            $Conteo++;
        if ($APIScoopIt_ClientId!=''		            && $APIScoopIt_ClientSecret!='')		            $Conteo++;
        if ($APITumblr_ClientId!=''			            && $APITumblr_ClientSecret!='')			            $Conteo++;
        if ($APIStockTwits_ClientId!=''	            	&& $APIStockTwits_ClientSecret!='')		            $Conteo++;
        if ($APIVK_ClientId!=''				            && $APIVK_ClientSecret!='')				            $Conteo++;
        if ($APIWithings_ClientId!=''		            && $APIWithings_ClientSecret!='')		            $Conteo++;
        if ($API37Signals_ClientId!=''		            && $API37Signals_ClientSecret!='')		            $Conteo++;
        if ($APIAmazon_ClientId!=''		                && $APIAmazon_ClientSecret!='')		                $Conteo++;
        if ($APIAOL_ClientId!=''		                && $APIAOL_ClientSecret!='')		                $Conteo++;
        if ($APIBitly_ClientId!=''		                && $APIBitly_ClientSecret!='')		                $Conteo++;
        if ($APIBuffer_ClientId!=''		                && $APIBuffer_ClientSecret!='')		                $Conteo++;
        if ($APICopy_ClientId!=''		                && $APICopy_ClientSecret!='')		                $Conteo++;
        if ($APIDailymotion_ClientId!=''		        && $APIDailymotion_ClientSecret!='')		        $Conteo++;
        if ($APIDiscogs_ClientId!=''		            && $APIDiscogs_ClientSecret!='')		            $Conteo++;
        if ($APIEtsy_ClientId!=''		                && $APIEtsy_ClientSecret!='')		                $Conteo++;
        if ($APIGarmin_ClientId!=''		                && $APIGarmin_ClientSecret!='')		                $Conteo++;
        if ($APIGarmin2Legged_ClientId!=''		        && $APIGarmin2Legged_ClientSecret!='')		        $Conteo++;
        if ($APIiHealth_ClientId!=''		            && $APIiHealth_ClientSecret!='')		            $Conteo++;
        if ($APIimgur_ClientId!=''		                && $APIimgur_ClientSecret!='')		                $Conteo++;
        if ($APIInfusionsoft_ClientId!=''		        && $APIInfusionsoft_ClientSecret!='')		        $Conteo++;
        if ($APIIntuit_ClientId!=''		                && $APIIntuit_ClientSecret!='')		                $Conteo++;
        if ($APIJawbone_ClientId!=''		            && $APIJawbone_ClientSecret!='')		            $Conteo++;
        if ($APILivecoding_ClientId!=''		            && $APILivecoding_ClientSecret!='')		            $Conteo++;
        if ($APIMailChimp_ClientId!=''		            && $APIMailChimp_ClientSecret!='')		            $Conteo++;
        if ($APIMavenlink_ClientId!=''		            && $APIMavenlink_ClientSecret!='')		            $Conteo++;
        if ($APIMeetup_ClientId!=''		                && $APIMeetup_ClientSecret!='')		                $Conteo++;
        if ($APIMicrosoftOpenIDConnect_ClientId!=''		&& $APIMicrosoftOpenIDConnect_ClientSecret!='')		$Conteo++;
        if ($APIMisfit_ClientId!=''		                && $APIMisfit_ClientSecret!='')		                $Conteo++;
        if ($APIoDesk_ClientId!=''		                && $APIoDesk_ClientSecret!='')		                $Conteo++;
        if ($APIOdnoklassniki_ClientId!=''		        && $APIOdnoklassniki_ClientSecret!='')	            $Conteo++;
        if ($APIPaypal_ClientId!=''		                && $APIPaypal_ClientSecret!='')		                $Conteo++;
        if ($APIPinterest_ClientId!=''		            && $APIPinterest_ClientSecret!='')		            $Conteo++;
        if ($APIRdio_ClientId!=''		                && $APIRdio_ClientSecret!='')		                $Conteo++;
        if ($APIReddit_ClientId!=''		                && $APIReddit_ClientSecret!='')		                $Conteo++;
        if ($APIRunKeeper_ClientId!=''		            && $APIRunKeeper_ClientSecret!='')		            $Conteo++;
        if ($APIUber_ClientId!=''		                && $APIUber_ClientSecret!='')		                $Conteo++;
        if ($APITeamViewer_ClientId!=''		            && $APITeamViewer_ClientSecret!='')		            $Conteo++;
        if ($APIVimeo_ClientId!=''		                && $APIVimeo_ClientSecret!='')		                $Conteo++;
        if ($APIWordpress_ClientId!=''		            && $APIWordpress_ClientSecret!='')		            $Conteo++;
        if ($APIXero_ClientId!=''		                && $APIXero_ClientSecret!='')		                $Conteo++;
        if ($APIYammer_ClientId!=''		                && $APIYammer_ClientSecret!='')		                $Conteo++;
        if ($APIYandex_ClientId!=''		                && $APIYandex_ClientSecret!='')		                $Conteo++;

        return $Conteo;
    }


function PCO_ContarProveedoresSAML2Configurados()
    {
        $Conteo=0;
        $Conteo=PCO_EjecutarSQL("SELECT COUNT(*) FROM core_samlconector ")->fetchColumn();
        return $Conteo;
    }


function PCO_GenerarOpcionesProveedoresOAuth()
    {
        global $APIGoogle_ClientId,$APIGoogle_ClientSecret,$APIFacebook_ClientId,$APIFacebook_ClientSecret,$APILinkedIn_ClientId,$APILinkedIn_ClientSecret,$APIInstagram_ClientId,$APIInstagram_ClientSecret,$APIDropbox_ClientId,$APIDropbox_ClientSecret,$APIMicrosoft_ClientId,$APIMicrosoft_ClientSecret,$APIFlickr_ClientId,$APIFlickr_ClientSecret,$APITwitter_ClientId,$APITwitter_ClientSecret,$APIFoursquare_ClientId,$APIFoursquare_ClientSecret,$APIXING_ClientId,$APIXING_ClientSecret,$APISalesforce_ClientId,$APISalesforce_ClientSecret,$APIBitbucket_ClientId,$APIBitbucket_ClientSecret,$APIYahoo_ClientId,$APIYahoo_ClientSecret,$APIBox_ClientId,$APIBox_ClientSecret,$APIDisqus_ClientId,$APIDisqus_ClientSecret,$APIEventful_ClientId,$APIEventful_ClientSecret,$APISurveyMonkey_ClientId,$APISurveyMonkey_ClientSecret,$APIRightSignature_ClientId,$APIRightSignature_ClientSecret,$APIFitbit_ClientId,$APIFitbit_ClientSecret,$APIScoopIt_ClientId,$APIScoopIt_ClientSecret,$APITumblr_ClientId,$APITumblr_ClientSecret,$APIStockTwits_ClientId,$APIStockTwits_ClientSecret,$APIVK_ClientId,$APIVK_ClientSecret,$APIWithings_ClientId,$APIWithings_ClientSecret;
        global $API37Signals_ClientId,$API37Signals_ClientSecret,$APIAmazon_ClientId,$APIAmazon_ClientSecret,$APIAOL_ClientId,$APIAOL_ClientSecret,$APIBitly_ClientId,$APIBitly_ClientSecret,$APIBuffer_ClientId,$APIBuffer_ClientSecret,$APICopy_ClientId,$APICopy_ClientSecret,$APIDailymotion_ClientId,$APIDailymotion_ClientSecret,$APIDiscogs_ClientId,$APIDiscogs_ClientSecret,$APIEtsy_ClientId,$APIEtsy_ClientSecret,$APIGarmin_ClientId,$APIGarmin_ClientSecret,$APIGarmin2Legged_ClientId,$APIGarmin2Legged_ClientSecret,$APIiHealth_ClientId,$APIiHealth_ClientSecret,$APIimgur_ClientId,$APIimgur_ClientSecret,$APIInfusionsoft_ClientId,$APIInfusionsoft_ClientSecret,$APIIntuit_ClientId,$APIIntuit_ClientSecret,$APIJawbone_ClientId,$APIJawbone_ClientSecret,$APILivecoding_ClientId,$APILivecoding_ClientSecret,$APIMailChimp_ClientId,$APIMailChimp_ClientSecret,$APIMavenlink_ClientId,$APIMavenlink_ClientSecret,$APIMeetup_ClientId,$APIMeetup_ClientSecret,$APIMicrosoftOpenIDConnect_ClientId,$APIMicrosoftOpenIDConnect_ClientSecret,$APIMisfit_ClientId,$APIMisfit_ClientSecret,$APIoDesk_ClientId,$APIoDesk_ClientSecret,$APIOdnoklassniki_ClientId,$APIOdnoklassniki_ClientSecret,$APIPaypal_ClientId,$APIPaypal_ClientSecret,$APIPinterest_ClientId,$APIPinterest_ClientSecret,$APIRdio_ClientId,$APIRdio_ClientSecret,$APIReddit_ClientId,$APIReddit_ClientSecret,$APIRunKeeper_ClientId,$APIRunKeeper_ClientSecret,$APIUber_ClientId,$APIUber_ClientSecret,$APITeamViewer_ClientId,$APITeamViewer_ClientSecret,$APIVimeo_ClientId,$APIVimeo_ClientSecret,$APIWordpress_ClientId,$APIWordpress_ClientSecret,$APIXero_ClientId,$APIXero_ClientSecret,$APIYammer_ClientId,$APIYammer_ClientSecret,$APIYandex_ClientId,$APIYandex_ClientSecret;
        // Crea los formularios de redireccion segun proveedor
        $CadenaProveedoresOAuthDisponibles="";
        if ($APIGoogle_ClientId!=''			            && $APIGoogle_ClientSecret!='')			            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Google');
        if ($APIFacebook_ClientId!=''		            && $APIFacebook_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Facebook');
        if ($APILinkedIn_ClientId!=''		            && $APILinkedIn_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('LinkedIn');
        if ($APIInstagram_ClientId!=''		            && $APIInstagram_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Instagram');
        if ($APIDropbox_ClientId!=''		            && $APIDropbox_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Dropbox');
        if ($APIMicrosoft_ClientId!=''		            && $APIMicrosoft_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Microsoft');
        if ($APIFlickr_ClientId!=''			            && $APIFlickr_ClientSecret!='')			            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Flickr');
        if ($APITwitter_ClientId!=''		            && $APITwitter_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Twitter');
        if ($APIFoursquare_ClientId!=''		            && $APIFoursquare_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Foursquare');
        if ($APIXING_ClientId!=''			            && $APIXING_ClientSecret!='')			            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('XING');
        if ($APISalesforce_ClientId!=''		            && $APISalesforce_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Salesforce');
        if ($APIBitbucket_ClientId!=''		            && $APIBitbucket_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Bitbucket');
        if ($APIYahoo_ClientId!=''			            && $APIYahoo_ClientSecret!='')			            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Yahoo');
        if ($APIBox_ClientId!=''			            && $APIBox_ClientSecret!='')			            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Box');
        if ($APIDisqus_ClientId!=''			            && $APIDisqus_ClientSecret!='')			            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Disqus');
        if ($APIEventful_ClientId!=''		            && $APIEventful_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Eventful');
        if ($APISurveyMonkey_ClientId!=''	            && $APISurveyMonkey_ClientSecret!='')	            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('SurveyMonkey');
        if ($APIRightSignature_ClientId!=''	            && $APIRightSignature_ClientSecret!='')	            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('RightSignature');
        if ($APIFitbit_ClientId!=''			            && $APIFitbit_ClientSecret!='')			            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Fitbit');
        if ($APIScoopIt_ClientId!=''		            && $APIScoopIt_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('ScoopIt');
        if ($APITumblr_ClientId!=''			            && $APITumblr_ClientSecret!='')			            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Tumblr');
        if ($APIStockTwits_ClientId!=''		            && $APIStockTwits_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('StockTwits');
        if ($APIVK_ClientId!=''				            && $APIVK_ClientSecret!='')				            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('VK');
        if ($APIWithings_ClientId!=''		            && $APIWithings_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Withings');
        if ($API37Signals_ClientId!=''		            && $API37Signals_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('37Signals');
        if ($APIAmazon_ClientId!=''		                && $APIAmazon_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Amazon');
        if ($APIAOL_ClientId!=''		                && $APIAOL_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('AOL');
        if ($APIBitly_ClientId!=''		                && $APIBitly_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Bitly');
        if ($APIBuffer_ClientId!=''		                && $APIBuffer_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Buffer');
        if ($APICopy_ClientId!=''		                && $APICopy_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Copy');
        if ($APIDailymotion_ClientId!=''		        && $APIDailymotion_ClientSecret!='')		        $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Dailymotion');
        if ($APIDiscogs_ClientId!=''		            && $APIDiscogs_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Discogs');
        if ($APIEtsy_ClientId!=''		                && $APIEtsy_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Etsy');
        if ($APIGarmin_ClientId!=''		                && $APIGarmin_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Garmin');
        if ($APIGarmin2Legged_ClientId!=''		        && $APIGarmin2Legged_ClientSecret!='')		        $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Garmin2Legged');
        if ($APIiHealth_ClientId!=''		            && $APIiHealth_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('iHealth');
        if ($APIimgur_ClientId!=''		                && $APIimgur_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('imgur');
        if ($APIInfusionsoft_ClientId!=''		        && $APIInfusionsoft_ClientSecret!='')		        $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Infusionsoft');
        if ($APIIntuit_ClientId!=''		                && $APIIntuit_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Intuit');
        if ($APIJawbone_ClientId!=''		            && $APIJawbone_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Jawbone');
        if ($APILivecoding_ClientId!=''		            && $APILivecoding_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Livecoding');
        if ($APIMailChimp_ClientId!=''		            && $APIMailChimp_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('MailChimp');
        if ($APIMavenlink_ClientId!=''		            && $APIMavenlink_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Mavenlink');
        if ($APIMeetup_ClientId!=''		                && $APIMeetup_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Meetup');
        if ($APIMicrosoftOpenIDConnect_ClientId!=''		&& $APIMicrosoftOpenIDConnect_ClientSecret!='')		$AlMenosUnOAuth.=PCO_CrearFormularioOauth('MicrosoftOpenIDConnect');
        if ($APIMisfit_ClientId!=''		                && $APIMisfit_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Misfit');
        if ($APIoDesk_ClientId!=''		                && $APIoDesk_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('oDesk');
        if ($APIOdnoklassniki_ClientId!=''		        && $APIOdnoklassniki_ClientSecret!='')	            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Odnoklassniki');
        if ($APIPaypal_ClientId!=''		                && $APIPaypal_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Paypal');
        if ($APIPinterest_ClientId!=''		            && $APIPinterest_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Pinterest');
        if ($APIRdio_ClientId!=''		                && $APIRdio_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Rdio');
        if ($APIReddit_ClientId!=''		                && $APIReddit_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Reddit');
        if ($APIRunKeeper_ClientId!=''		            && $APIRunKeeper_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('RunKeeper');
        if ($APIUber_ClientId!=''		                && $APIUber_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Uber');
        if ($APITeamViewer_ClientId!=''		            && $APITeamViewer_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('TeamViewer');
        if ($APIVimeo_ClientId!=''		                && $APIVimeo_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Vimeo');
        if ($APIWordpress_ClientId!=''		            && $APIWordpress_ClientSecret!='')		            $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Wordpress');
        if ($APIXero_ClientId!=''		                && $APIXero_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Xero');
        if ($APIYammer_ClientId!=''		                && $APIYammer_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Yammer');
        if ($APIYandex_ClientId!=''		                && $APIYandex_ClientSecret!='')		                $AlMenosUnOAuth.=PCO_CrearFormularioOauth('Yandex');

        return $AlMenosUnOAuth;
    }

function PCO_VentanaLogin()
    {
		/*
			Function: PCO_VentanaLogin
			Despliega la ventana de ingreso al sistema con el formulario para usuario, contrasena y captcha.
		*/
		  global $ArchivoCORE,$LlaveDePaso,$Auth_TipoMotor,$MULTILANG_OauthButt,$NombreRAD,$Auth_PresentarOauthInicio,$TipoCaptchaLogin;
		  global $Auth_PermitirAutoRegistro,$Auth_PermitirReseteoClaves,$CaracteresCaptcha,$IdiomaEnLogin;
		  global $UbicacionProveedoresOAuth,$IdiomaPredeterminado,$MULTILANG_IdiomaPredeterminado,$MULTILANG_Cerrar,$MULTILANG_Usuario,$MULTILANG_Contrasena,$MULTILANG_CodigoSeguridad,$MULTILANG_IngreseCodigoSeguridad,$MULTILANG_TituloLogin,$MULTILANG_Importante,$MULTILANG_AccesoExclusivo,$MULTILANG_Ingresar,$MULTILANG_OauthLogin,$MULTILANG_LoginClasico,$MULTILANG_LoginOauthDes,$MULTILANG_Registrarme,$MULTILANG_OlvideClave;

		  //Variables para el sistema de captcha
		  global $MULTILANG_TipoCaptchaPrefijo,$MULTILANG_TipoCaptchaPosfijo;
          global $MULTILANG_Aplicacion,$MULTILANG_SimboloCaptchaCarro,    $MULTILANG_SimboloCaptchaTijeras,    $MULTILANG_SimboloCaptchaCalculadora,    $MULTILANG_SimboloCaptchaBomba,    $MULTILANG_SimboloCaptchaLibro,    $MULTILANG_SimboloCaptchaPastel,    $MULTILANG_SimboloCaptchaCafe,    $MULTILANG_SimboloCaptchaNube,    $MULTILANG_SimboloCaptchaDiamante,    $MULTILANG_SimboloCaptchaMujer,    $MULTILANG_SimboloCaptchaHombre,    $MULTILANG_SimboloCaptchaBalon,    $MULTILANG_SimboloCaptchaControl,    $MULTILANG_SimboloCaptchaCasa,    $MULTILANG_SimboloCaptchaCelular,    $MULTILANG_SimboloCaptchaArbol,    $MULTILANG_SimboloCaptchaTrofeo,    $MULTILANG_SimboloCaptchaSombrilla,    $MULTILANG_SimboloCaptchaUniversidad,    $MULTILANG_SimboloCaptchaCamara,    $MULTILANG_SimboloCaptchaAmbulancia,    $MULTILANG_SimboloCaptchaAvion,    $MULTILANG_SimboloCaptchaTren,    $MULTILANG_SimboloCaptchaBicicleta,    $MULTILANG_SimboloCaptchaCamion,    $MULTILANG_SimboloCaptchaCorazon;

            //Variables posiblemente recibidas desde un autoregistro
            global $AUTO_uid,$AUTO_clave;

			// Variables para OAuth desde el archivo de configuracion
			global $APIGoogle_ClientId,$APIGoogle_ClientSecret;
			global $APIFacebook_ClientId,$APIFacebook_ClientSecret;
			global $APILinkedIn_ClientId,$APILinkedIn_ClientSecret;
			global $APIInstagram_ClientId,$APIInstagram_ClientSecret;
			global $APIDropbox_ClientId,$APIDropbox_ClientSecret;
			global $APIMicrosoft_ClientId,$APIMicrosoft_ClientSecret;
			global $APIFlickr_ClientId,$APIFlickr_ClientSecret;
			global $APITwitter_ClientId,$APITwitter_ClientSecret;
			global $APIFoursquare_ClientId,$APIFoursquare_ClientSecret;
			global $APIXING_ClientId,$APIXING_ClientSecret;
			global $APISalesforce_ClientId,$APISalesforce_ClientSecret;
			global $APIBitbucket_ClientId,$APIBitbucket_ClientSecret;
			global $APIYahoo_ClientId,$APIYahoo_ClientSecret;
			global $APIBox_ClientId,$APIBox_ClientSecret;
			global $APIDisqus_ClientId,$APIDisqus_ClientSecret;
			global $APIEventful_ClientId,$APIEventful_ClientSecret;
			global $APISurveyMonkey_ClientId,$APISurveyMonkey_ClientSecret;
			global $APIRightSignature_ClientId,$APIRightSignature_ClientSecret;
			global $APIFitbit_ClientId,$APIFitbit_ClientSecret;
			global $APIScoopIt_ClientId,$APIScoopIt_ClientSecret;
			global $APITumblr_ClientId,$APITumblr_ClientSecret;
			global $APIStockTwits_ClientId,$APIStockTwits_ClientSecret;
			global $APIVK_ClientId,$APIVK_ClientSecret;
			global $APIWithings_ClientId,$APIWithings_ClientSecret;
			global $API37Signals_ClientId,$API37Signals_ClientSecret;
			global $APIAmazon_ClientId,$APIAmazon_ClientSecret;
			global $APIAOL_ClientId,$APIAOL_ClientSecret;
			global $APIBitly_ClientId,$APIBitly_ClientSecret;
			global $APIBuffer_ClientId,$APIBuffer_ClientSecret;
			global $APICopy_ClientId,$APICopy_ClientSecret;
			global $APIDailymotion_ClientId,$APIDailymotion_ClientSecret;
			global $APIDiscogs_ClientId,$APIDiscogs_ClientSecret;
			global $APIEtsy_ClientId,$APIEtsy_ClientSecret;
			global $APIGarmin_ClientId,$APIGarmin_ClientSecret;
			global $APIGarmin2Legged_ClientId,$APIGarmin2Legged_ClientSecret;
			global $APIiHealth_ClientId,$APIiHealth_ClientSecret;
			global $APIimgur_ClientId,$APIimgur_ClientSecret;
			global $APIInfusionsoft_ClientId,$APIInfusionsoft_ClientSecret;
			global $APIIntuit_ClientId,$APIIntuit_ClientSecret;
			global $APIJawbone_ClientId,$APIJawbone_ClientSecret;
			global $APILivecoding_ClientId,$APILivecoding_ClientSecret;
			global $APIMailChimp_ClientId,$APIMailChimp_ClientSecret;
			global $APIMavenlink_ClientId,$APIMavenlink_ClientSecret;
			global $APIMeetup_ClientId,$APIMeetup_ClientSecret;
			global $APIMicrosoftOpenIDConnect_ClientId,$APIMicrosoftOpenIDConnect_ClientSecret;
			global $APIMisfit_ClientId,$APIMisfit_ClientSecret;
			global $APIoDesk_ClientId,$APIoDesk_ClientSecret;
			global $APIOdnoklassniki_ClientId,$APIOdnoklassniki_ClientSecret;
			global $APIPaypal_ClientId,$APIPaypal_ClientSecret;
			global $APIPinterest_ClientId,$APIPinterest_ClientSecret;
			global $APIRdio_ClientId,$APIRdio_ClientSecret;
			global $APIReddit_ClientId,$APIReddit_ClientSecret;
			global $APIRunKeeper_ClientId,$APIRunKeeper_ClientSecret;
			global $APIUber_ClientId,$APIUber_ClientSecret;
			global $APITeamViewer_ClientId,$APITeamViewer_ClientSecret;
			global $APIVimeo_ClientId,$APIVimeo_ClientSecret;
			global $APIWordpress_ClientId,$APIWordpress_ClientSecret;
			global $APIXero_ClientId,$APIXero_ClientSecret;
			global $APIYammer_ClientId,$APIYammer_ClientSecret;
			global $APIYandex_ClientId,$APIYandex_ClientSecret;

            //Determina si se tiene un login SAML activado
            $RegistroSAML=PCO_EjecutarSQL("SELECT * FROM core_samlconector WHERE activado='S' ORDER BY nombre_conector LIMIT 0,1 ")->fetch();
            $CadenaMargen_LoginSAML="";
            $CadenaOcultamiento_LoginEstandarPRE="";
            $CadenaOcultamiento_LoginEstandarPOS="";
            if ($RegistroSAML["nombre_conector"]!="")
                {
                    //Presenta boton para ir al login estandar de aplicacion
                    $CadenaOcultamiento_LoginEstandarPRE="<details><summary><div id='PCO_BotonLoginEstandar' onclick='$(\"#PCO_BotonLoginEstandar\").hide(); $(\"#PCO_MarcoLoginSAML\").hide();' class='btn btn-info'><b>{$MULTILANG_LoginClasico}</b> ($MULTILANG_Aplicacion)</div></summary>";
                    $CadenaOcultamiento_LoginEstandarPOS="</details>";
                    $CadenaMargen_LoginSAML="<br><br>";
                    $CadenaOpcionesSAML="";
                    $NombreConectorSSO=$RegistroSAML["nombre_conector"];
                    $ImagenConectorSSO="";
                    if ($RegistroSAML["ruta_logo"]!="")
                        {
                            $ImagenConectorSSO=explode("|",$RegistroSAML["ruta_logo"]);
                            $ImagenConectorSSO=$ImagenConectorSSO[0];
                            $ImagenConectorSSO="<img style='border-radius: 5%;' width='50' height='50' src='{$ImagenConectorSSO}'>";
                        }
                    $EnlaceSSO="inc/php-saml/practico/?sso";
                    $CadenaOpcionesSAML.="
                        <br><a href='{$EnlaceSSO}' style='text-decoration:none;'>
                            <div>
                                {$ImagenConectorSSO}
                            </div>
                            <div>
                                {$NombreConectorSSO}
                            </div>
                        </a>";
                    $CadenaOpcionesSAML="{$CadenaOpcionesSAML}<br>";
                }
            


            $CadenaProveedoresOAuthDisponibles=PCO_GenerarOpcionesProveedoresOAuth();
			//Si se desea ubicar las opciones oAuth a traves de un boton genera el marco flotante correspondiente
			if ($UbicacionProveedoresOAuth=='0')
			    {
			        ?>
                        <!-- Modal LoginOauth -->
                        <div class="modal fade" id="myModalLOGINOAUTH" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-body mdl-primary">
                                <?php
                                        PCO_Mensaje($MULTILANG_OauthButt,$MULTILANG_LoginOauthDes,'','fa fa-info-circle fa-3x text-info','alert alert-info');
                                ?>
                                <table class="table">
                                        <tr><td align="center"><font face="Verdana,Tahoma, Arial" style="font-size: 9px;">
                                            <?php
                                                echo $CadenaProveedoresOAuthDisponibles;
                                            ?>
                                        </td></tr>
                                </table>
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-info" type="button" data-dismiss="modal">
                                    <?php echo $MULTILANG_LoginClasico; ?> <?php echo $NombreRAD; ?>
                                    {<i class="fa fa-paypal"></i>}
                                </button>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $MULTILANG_Cerrar; ?> {<i class="fa fa-keyboard-o"></i> Esc}</button>
                              </div>
                            </div>
                          </div>
                        </div>
			        <?php
			    }
			?>


                <!--Login Estandar-->
                <div id="PCODIV_BarraArribaLogin"></div>

                <div class="row">
                    <?php echo $CadenaMargen_LoginSAML; ?>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xs-offset-0 col-sm-offset-4 col-md-offset-4 col-lg-offset-4" >
                    <br>
                    <div id="PCODIV_ArribaLogin"></div>
                    <div id="EnfasisLoginZoom" class="EnfasisLoginZoom" style="box-shadow: 3px 3px 3px gray;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo $MULTILANG_TituloLogin; ?></h3>
                            </div>
                            <div align=center class="panel-body btn-xs">
                    <?php echo $CadenaOcultamiento_LoginEstandarPRE; ?>

                                    <?php
                                        //Genera nombres aleatorios para los campos de login y clave
                                        $NombreCampoLogin=md5(PCO_TextoAleatorio(15));
                                        $NombreCampoClave=md5(PCO_TextoAleatorio(15));
                                        $_SESSION['NombreCampoLogin'] = (string)$NombreCampoLogin;
                                        $_SESSION['NombreCampoClave'] = (string)$NombreCampoClave;
                                        $PCO_FirmaLogin=md5($NombreCampoLogin." ".$NombreCampoClave." ".$_SESSION['captcha_temporal']);
                                    ?>

                                    <form role="form" name="login_usuario" method="POST" action="<?php echo $ArchivoCORE; ?>" style="margin-top: 0px; margin-bottom: 0px;" onsubmit="if (document.login_usuario.captcha.value=='' || document.login_usuario.uid.value=='' || document.login_usuario.clave.value=='') { alert('Debe diligenciar los valores necesarios (Usuario, Clave y Codigo de seguridad).'); return false; }">
                                    <input type="Hidden" name="PCO_Accion" value="Iniciar_login">
                                        <div class="form-group">
                                            <img name="img_login" id="img_login" width="100%" style="max-width:232px; max-height:160px;" src="img/practico_login.png?<?php echo filemtime('img/practico_login.png'); ?>" alt="" border="0"><br><br>
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                            <input name="<?php echo $NombreCampoLogin; ?>" value="<?php echo $AUTO_uid; ?>" type="text" class="form-control" placeholder="<?php echo $MULTILANG_Usuario; ?>" AutoCompleteType="Disabled" autocomplete="Off">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                            <input name="<?php echo $NombreCampoClave; ?>" value="<?php echo $AUTO_clave; ?>" type="password" class="form-control" placeholder="<?php echo $MULTILANG_Contrasena; ?>" AutoCompleteType="Disabled" autocomplete="Off">
                                        </div>

                                        <div id="PCODIV_PostClaveLogin"></div>

    									<?php
    										//Presenta selector de idiomas si esta habilitado
    										if ($IdiomaEnLogin==1)
    											{
    									?>
        									<div class="form-group input-group">
        									    <span class="input-group-addon"><i class="fa fa-language fa-fw"></i></span>
        										<select id="idioma_login" name="idioma_login" class="selectpicker" >
        											<?php
        											// Incluye archivos de idioma para ser seleccionados
        											$path_idiomas="inc/practico/idiomas/";
        											$directorio_idiomas=opendir($path_idiomas);
        											$IdiomaPredeterminadoActual=$IdiomaPredeterminado;
        											while (($PCOVAR_Elemento=readdir($directorio_idiomas))!=false)
        												{
        													//Lo procesa solo si es un archivo diferente del index
        													if (!is_dir($path_idiomas.$PCOVAR_Elemento) && $PCOVAR_Elemento!="." && $PCOVAR_Elemento!=".."  && $PCOVAR_Elemento!="index.html")
        														{
        															include($path_idiomas.$PCOVAR_Elemento);
        															//Establece espanol como predeterminado
        															$seleccion="";
        															$valor_opcion=str_replace(".php","",$PCOVAR_Elemento);
        															if ($valor_opcion==$IdiomaPredeterminadoActual) $seleccion="SELECTED";
        															//Presenta la opcion
        															echo '<option value="'.$valor_opcion.'" '.$seleccion.'>'.$MULTILANG_DescripcionIdioma.' ('.$PCOVAR_Elemento.')</option>';
        														}
        												}
        											//Vuelve a cargar el predeterminado actual
        											include("inc/practico/idiomas/".$IdiomaPredeterminado.".php");
        											?>
        										</select>
        									</div>
    										<?php
    												}
    										?>


    									<?php
    									    //Si el captcha es tradicional
    										if ($CaracteresCaptcha>0 && ($TipoCaptchaLogin=="tradicional" || $TipoCaptchaLogin==""))
    											{
    											    echo '<div class="well">
                										<div class="form-group col-xs-12">
                											'.$MULTILANG_CodigoSeguridad.':
                											<img src="core/captcha.php">
                										</div>
                										<div class="form-group input-group input-group-sm">
                											<span class="input-group-addon"><i class="fa fa-hand-o-right fa-fw"></i></span>
                											<input type="text" name="captcha" maxlength=6 class="form-control"  placeholder="'.$MULTILANG_IngreseCodigoSeguridad.'">
                										</div>
                										</div>';
    											}

    									    //Si el captcha es visual
    										if ($CaracteresCaptcha>0 && $TipoCaptchaLogin=="visual")
    											{
    											    //Llama de todas formas al archivo generador de captcha, solo que este se usa para la variable de sesion solamente
    											    include ("core/captcha.php");
    											}
    									?>

                                        <div class="form-group input-group input-group-sm col-xs-12">
                                            <a class="btn btn-success btn-block" href="javascript:document.login_usuario.submit();"><i class="fa fa-check-circle"></i> <?php echo $MULTILANG_Ingresar; ?></a>
                                        </div>
                                    </form>


                                        <?php
                                            // Muestra boton de login por red social si aplica
                                            if ($CadenaProveedoresOAuthDisponibles!="")
                                                {
                                        			//Si se desea ubicar las opciones oAuth a traves de un boton genera el marco flotante correspondiente
                                        			if ($UbicacionProveedoresOAuth=='0')
                                        			    {
                                                            echo '<hr>
                                                                <a id="boton_login_oauth" data-toggle="modal" href="#myModalLOGINOAUTH" class="btn btn-info  btn-block">
                                                                    <div>
                                                                        '.$MULTILANG_OauthLogin.'<br>
                                                                        <i class="fa fa-2x fa-facebook-square"></i>
                                                                        <i class="fa fa-2x fa-google-plus-square"></i>
                                                                        <i class="fa fa-2x fa-twitter"></i>
                                                                        <i class="fa fa-2x fa-linkedin-square"></i>
                                                                        <i class="fa fa-2x fa-dropbox"></i>
                                                                    </div>
                                                                </a>';

                                                            //Si esta predeterminado mostrar las opciones al comienzo entonces hace el trigger sobre el enlace
                                                            if ($Auth_PresentarOauthInicio==1)
                                                                {
                                                                    echo '<script language="JavaScript">
                                                                    $( document ).ready(function() {
                                                                        $("#boton_login_oauth").trigger("click");
                                                                        });
                                                                    </script>';
                                                                }
                                                        }

                                                    //Si se desean las opciones directamente en el login
                                                    if ($UbicacionProveedoresOAuth=='1')
                                                        {
                                                            echo '
                                                                <table class="table">
                                                                        <tr><td align="center">';
                                                                        echo "<b><i><font color=lightgray>".$MULTILANG_OauthLogin.":</font></i></b><br>";
                                                            echo $CadenaProveedoresOAuthDisponibles;
                                                            echo '
                                                                        </td></tr>
                                                                </table>';
                                                        }
                                                }
                                        ?>
                                    <?php
                                        //PCO_Mensaje($MULTILANG_Importante,$MULTILANG_AccesoExclusivo,'','fa fa-info-circle fa-3x texto-azul','alert alert-info');
                                    ?>

                                    <div class="row">
                                        <div class="col-md-6">
    										<?php
    											//Presenta opciones de recuperacion solamente cuando el motor de autenticacion sea practico
    											if ($Auth_TipoMotor=="practico" && $Auth_PermitirAutoRegistro==1)
    												{
    										?>
    													<br>
    													<form name="auto_registro" id="auto_registro" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    													<input type="Hidden" name="PCO_Accion" value="PCO_AgregarUsuarioAutoregistro">
    													</form>
    													<a class="btn btn-xs" onClick="document.auto_registro.submit();">
    														<i class="typcn fa typcn-user-add"></i>
    														<?php echo $MULTILANG_Registrarme; ?>
    													</a>
    										<?php
    												}
    										?>
                                        </div>
                                        <div class="col-md-6">
    										<?php
    											//Presenta opciones de recuperacion solamente cuando el motor de autenticacion sea practico
    											if ($Auth_TipoMotor=="practico" && $Auth_PermitirReseteoClaves==1)
    												{
    										?>
    													<br>
    													<form name="recuperacion" id="recuperacion" action="<?php echo $ArchivoCORE; ?>" method="POST"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    													<input type="Hidden" name="PCO_Accion" value="PCO_RecuperarContrasena">
    													<input type="Hidden" name="PCO_SubAccion" value="formulario_recuperacion">
    													</form>
    													<a class="btn btn-xs" onClick="document.recuperacion.submit();">
    														<i class="fa fa-unlock-alt"></i>
    														<?php echo $MULTILANG_OlvideClave; ?>
    													</a>
    										<?php
    												}
    										?>
                                        </div>
                                    </div>


                            <script language="JavaScript"> login_usuario.uid.focus(); </script>

                    <?php echo $CadenaOcultamiento_LoginEstandarPOS; ?>
                    <div id="PCO_MarcoLoginSAML">
                        <?php echo $CadenaOpcionesSAML; ?>    
                    </div>
                    

                            </div> <!-- /panel-body -->
                        </div>
                    </div>  <!--FIN Class EnfasisLoginZoom -->

                    <div id="PCODIV_AbajoLogin"></div>

                    </div>  <!--FIN Class col -->
                </div>  <!--FIN Class row -->
                <!--FIN Login Estandar-->
                <div id="PCODIV_BarraAbajoLogin"></div>

<?php
    }



########################################################################
########################################################################
/*
    Procedure: PCO_AbrirVentana
    Abre los espacios de trabajo dinamicos sobre el contenedor principal donde se despliega informacion

    Variables de entrada:

    titulo - Nombre de la ventana a visualizar en la parte superior.
    tipo_panel - Recibe el tipo de panel bootstrap a crear:

    * panel-primary,panel-success,panel-info,panel-warning,panel-danger
    * col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-
    * Otros asociados a clases de bootstrap

    barra_herramientas - Lista de barras de herramientas a ser impresas

    Ver tambien:
    <PCO_CerrarVentana>
*/
function PCO_AbrirVentana($titulo,$tipo_panel="panel-default",$css_personalizado='',$barra_herramientas='')
    {
        echo '
            <div class="panel '.$tipo_panel.'" style="'.$css_personalizado.'">
            <div class="panel-heading">'.$titulo;
        if ($barra_herramientas!='')
            echo $barra_herramientas;
        echo '</div>
            <div class="panel-body">';
    }



########################################################################
########################################################################
/*
	Function: PCO_CerrarVentana
	Cierra los espacios de trabajo dinamicos generados por <PCO_AbrirVentana>

	Ver tambien:
	<PCO_AbrirVentana>
*/
function PCO_CerrarVentana()
    {
        echo '
          </div>  <!-- CIERRA panel-body -->
        </div>  <!-- CIERRA panel panel-default -->';
    }



########################################################################
########################################################################
/*
	Procedure: PCO_AbrirBarraEstado
	Abre los espacios para despliegue de informacion en la parte inferior de los objetos tales como botones o mensajes

	Ver tambien:
	<PCO_CerrarBarraEstado>
*/
function PCO_AbrirBarraEstado($DEPRECATED_alineacion="CENTER")
    {
        echo '<div class="panel-footer">';
    }



########################################################################
########################################################################
/*
	Function: PCO_CerrarBarraEstado
	Cierra los espacios de trabajo dinamicos generados por <PCO_AbrirBarraEstado>

	Ver tambien:
	<PCO_AbrirBarraEstado>
*/
function PCO_CerrarBarraEstado()
  {
        echo '</div> <!-- CIERRA panel-footer -->';
  }



########################################################################
########################################################################
/*
    Procedure: PCO_AbrirDialogoModal
    Crea un dialogo modal que puede ser activado luego por un anchor <a>

    Variables de entrada:

    titulo - Nombre de la ventana a visualizar en la parte superior.
    tipo_panel - Recibe el tipo de panel bootstrap a crear:

    * panel-primary,panel-success,panel-info,panel-warning,panel-danger
    * col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-
    * Otros asociados a clases de bootstrap

    Ver tambien:
    <PCO_CerrarDialogoModal>
*/
function PCO_AbrirDialogoModal($identificador,$titulo="",$estilo_modal="",$impresion_directa=1,$subtitulo="")
    {
        $salida= '
            <div class="modal fade '.$estilo_modal.'" id="'.$identificador.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">'.$titulo.'</h4>';

        //Si se recibe un subtitulo lo agrega al modal
        if ($subtitulo!="")
            $salida.='<h6 id="myModalLabelSubtitulo"><i>'.$subtitulo.'</i></h6>';

        $salida.='                </div>
                        <div class="modal-body mdl-primary">';
        if($impresion_directa==1)
            echo $salida;
        else
            return $salida;
    }



########################################################################
########################################################################
/*
	Function: PCO_CerrarDialogoModal
	Cierra los espacios de trabajo por <abrir_modal>

	Ver tambien:
	<abrir_modal>
*/
function PCO_CerrarDialogoModal($contenido_piepagina,$impresion_directa=1)
    {
        $salida= '
                            </div>
                            <div class="modal-footer">
                                '.$contenido_piepagina.'
                            </div>
                        </div>
                    </div>
                </div>';
        if($impresion_directa==1)
            echo $salida;
        else
            return $salida;
    }



########################################################################
########################################################################
/*
	Function: PCO_ObtenerMicrotime
	Obtiene un tiempo en microsegundos utilizado para calcular tiempos de inicio y fin de operaciones
*/
function PCO_ObtenerMicrotime()
	{
		list($useg, $seg) = explode(" ", microtime());
		return ((float)$useg + (float)$seg);
	}



########################################################################
########################################################################
/*
    Function: PCO_Mensaje
    Funcion generica para la presentacion de mensajes.  Ver variables para personalizacion.

    Variables de entrada:

        titulo - Texto que aparece en resaltado como encabezado del texto.  Acepta modificadores HTML.
        texto - Mensaje completo a desplegar en formato de texto normal.  Acepta modificadores HTML.
        icono - Formato Awesome Fonts o Iconos de Bootstrap
        ancho - Ancho del espacio de trabajo definido en pixels o porcentaje sobre el contenedor principal.
        estilo - Especifica el punto donde sera publicado el mensaje para definir la hoja de estilos correspondiente.
*/
function PCO_Mensaje($titulo,$texto,$DEPRECATED_ancho,$icono,$estilo)
    {
        global $MULTILANG_Cerrar;
        echo '<div class="'.$estilo.'" role="alert">
            <i class="'.$icono.' pull-left"></i>
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">'.$MULTILANG_Cerrar.'</span></button>
            <strong>'.$titulo.'</strong><br>'.$texto.'
        </div>';
    }


########################################################################
########################################################################
/*
	Function: PCO_SelectorObjetosMenu
	Despliega marco para seleccionar objetos de formulario e informes durante creacion de menues

	Ver tambien:

		<PCOFUNC_AdministrarMenu> | <detalles_menu>
*/
function PCO_SelectorObjetosMenu()
    {
        global $MULTILANG_SeleccioneUno,$MULTILANG_Formularios,$MULTILANG_MnuHlpComandoInf,$MULTILANG_Si,$MULTILANG_No,$MULTILANG_Informes,$MULTILANG_FrmVentana,$MULTILANG_Guardar,$MULTILANG_Cerrar;
        global $ListaCamposSinID_formulario,$ListaCamposSinID_informe,$TablasCore;
        global $registro_informes;
        ?>
            <!-- Modal Selector de objetos -->
            <div class="modal fade" id="myModalSelectorObjetos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo $MULTILANG_SeleccioneUno; ?></h4>
                  </div>
                  <div class="modal-body mdl-primary">

                    <form name="selector_objetos" method="POST">

                        <label for="objeto_seleccionado"><?php echo $MULTILANG_Formularios; ?> / <?php echo $MULTILANG_Informes; ?>:</label>
                        <select id="objeto_seleccionado" name="objeto_seleccionado" class="form-control" >
                            <option value=""><?php echo $MULTILANG_SeleccioneUno; ?></option>
                            <optgroup label="<?php echo $MULTILANG_Formularios; ?>">
                                <?php
                                    $consulta_forms=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id>=0 ORDER BY titulo");
                                    while($registro_forms = $consulta_forms->fetch())
                                        echo '<option value="frm:'.$registro_forms["id"].'">(Id.'.$registro_forms["id"].') '.$registro_forms["titulo"].'</option>';
                                ?>
                            </optgroup>
                            <optgroup label="<?php echo $MULTILANG_Informes; ?>">
                                <?php
                                    $consulta_informs=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_informe." FROM ".$TablasCore."informe WHERE id>=0 ORDER BY titulo");
                                    while($registro_informes = $consulta_informs->fetch())
                                        echo '<option value="inf:'.$registro_informes["id"].'">(Id.'.$registro_informes["id"].') '.$registro_informes["titulo"].'</option>';
                                ?>
                            </optgroup>
                        </select>

                        <label for="definir_ventana_propia"><?php echo $MULTILANG_FrmVentana; ?></label>
                        <select id="definir_ventana_propia" name="definir_ventana_propia" class="form-control" >
                            <option value=":1"><?php echo $MULTILANG_Si; ?></option>
                            <option value=":0"><?php echo $MULTILANG_No; ?></option>
                        </select>
                        <br>
                        <?php echo $MULTILANG_MnuHlpComandoInf; ?>
                    </form>

                  </div>
                  <div class="modal-footer">
                    <button onClick="document.PCO_FormItemMenu.comando.value=document.selector_objetos.objeto_seleccionado.options[document.selector_objetos.objeto_seleccionado.selectedIndex].value + document.selector_objetos.definir_ventana_propia.options[document.selector_objetos.definir_ventana_propia.selectedIndex].value;" type="button" class="btn btn-success" data-dismiss="modal"><?php echo $MULTILANG_Guardar; ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $MULTILANG_Cerrar; ?> {<i class="fa fa-keyboard-o"></i> Esc}</button>
                  </div>
                </div>
              </div>
            </div>
<?php
    }


########################################################################
########################################################################
/*
	Function: PCO_SelectorIconosAwesome
	Despliega marco para seleccionar iconos

	Ver tambien:

		<PCOFUNC_AdministrarMenu> | <detalles_menu>
*/
function PCO_SelectorIconosAwesome()
	{
        global $MULTILANG_MnuSelImagen,$MULTILANG_MnuHlpAwesome,$MULTILANG_Cerrar;
?>

            <div class="modal fade modal-wide" id="myModalSelectorIconos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo $MULTILANG_MnuSelImagen; ?></h4>
                  </div>
                  <div class="modal-body mdl-primary">

                    <table class="table table-responsive table-unbordered btn-xs">
                        <tr>
                            <td>GlyphIcon</td>
                            <td>IonIcon</td>
                            <td>FontAwesome</td>
                            <td>WeatherIcon</td>
                            <td>MapIcon</td>
                            <td>OctIcon</td>
                            <td>TypIcon</td>
                            <td>ElusiveIcon</td>
                        </tr>
                        <tr>
                            <td><button id="lib_glyphicon" class="btn btn-default" data-iconset="glyphicon" role="iconpicker" data-search="false" data-search-text="Buscar..." data-rows="5" data-cols="8"></button></td>
                            <td><button id="lib_ionicon" class="btn btn-default" data-iconset="ionicon" role="iconpicker" data-search="false" data-search-text="Buscar..." data-rows="5" data-cols="8"></button></td>
                            <td><button id="lib_fontawesome" class="btn btn-default" data-iconset="fontawesome" role="iconpicker" data-search="false" data-search-text="Buscar..." data-rows="5" data-cols="8"></button></td>
                            <td><button id="lib_weathericon" class="btn btn-default" data-iconset="weathericon" role="iconpicker" data-search="false" data-search-text="Buscar..." data-rows="5" data-cols="8"></button></td>
                            <td><button id="lib_mapicon" class="btn btn-default" data-iconset="mapicon" role="iconpicker" data-search="false" data-search-text="Buscar..." data-rows="5" data-cols="8"></button></td>
                            <td><button id="lib_octicon" class="btn btn-default" data-iconset="octicon" role="iconpicker" data-search="false" data-search-text="Buscar..." data-rows="5" data-cols="8"></button></td>
                            <td><button id="lib_typicon" class="btn btn-default" data-iconset="typicon" role="iconpicker" data-search="false" data-search-text="Buscar..." data-rows="5" data-cols="8"></button></td>
                            <td><button id="lib_elusiveicon" class="btn btn-default" data-iconset="elusiveicon" role="iconpicker" data-search="false" data-search-text="Buscar..." data-rows="5" data-cols="8"></button></td>
                        </tr>
                    </table>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><?php echo $MULTILANG_Cerrar; ?> {<i class="fa fa-keyboard-o"></i> Esc}</button>
                  </div>
                </div>
              </div>
            </div>
<?php
	}


########################################################################
########################################################################
/*
	Function: PCO_CargarObjetoTextoCorto
	Genera el codigo HTML y CSS correspondiente a un campo de texto (text) vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos
		formulario - ID unico del formulario al cual pertenece el objeto

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
function PCO_CargarObjetoTextoCorto($registro_campos,$registro_datos_formulario,$formulario,$en_ventana)
	{
		global $TablasCore,$PCO_CampoBusquedaBD,$PCO_ValorBusquedaBD,$IdiomaPredeterminado;
        global $funciones_activacion_datepickers;
		global $MULTILANG_TitValorUnico,$MULTILANG_DesValorUnico,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio,$MULTILANG_Contrasena;
		global $TabIndex_Elemento;

        //Busca datos del formulario
        $RegistroDisenoFormulario=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."formulario WHERE id=?", "$formulario")->fetch();
        $IdHTMLFormulario=$RegistroDisenoFormulario["id_html"];

		$salida='';
		$nombre_campo=$registro_campos["campo"];
		$tipo_entrada="text"; // Se cambia a date si se trata de un campo con validacion de fecha, si se cambia a password es tipo clave...

		// Especifica longitud visual de campo en caso de haber sido definida
		$cadena_longitud_visual=' size="20" ';
		if ($registro_campos["ancho"]!="0")
			$cadena_longitud_visual=' size="'.$registro_campos["ancho"].'" ';

		// Especifica longitud maxima de caracteres en caso de haber sido definida
		$cadena_longitud_permitida=' ';
		if ($registro_campos["maxima_longitud"]!=0)
			$cadena_longitud_permitida=' maxlength="'.$registro_campos["maxima_longitud"].'" ';

		// Especifica textos de placeholder si existen
		$cadena_placeholder='';
		if ($registro_campos["valor_placeholder"]!="")
			$cadena_placeholder=' placeholder="'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["valor_placeholder"],$registro_datos_formulario).'" ';

		// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
		$cadena_valor='';
		if ($registro_campos["valor_predeterminado"]!="") $cadena_valor=' value="'.$registro_campos["valor_predeterminado"].'" ';
		//Reemplaza segundas variables sobre valores predeterminados
		$cadena_valor=' value="'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["valor_predeterminado"],$registro_datos_formulario).'" ';
		//Evalua si el valor predeterminado tiene signo $ al comienzo y ademas es una variable definida para poner su valor.
		//Conserva compatibilidad hacia atras en versiones donde las variables comienzan solamente con el signo pesos y se permite solo una
		if (substr($registro_campos["valor_predeterminado"], 0,1)=="$")
			{
				$nombre_variable = substr($registro_campos["valor_predeterminado"], 1);
				global ${$nombre_variable};
				if (isset($nombre_variable))
					{
						$valor_variable=${$nombre_variable};
						$cadena_valor=' value="'.$valor_variable.'" ';
					}
			}

        //Evalua si el campo en cuestion pertenece a la tabla.  Si es asi entonces intenta buscar su valor desde registro y cambiar el predeterminado.
    	if (PCO_ExisteCampoTabla($nombre_campo,$RegistroDisenoFormulario["tabla_datos"])==true)
    	    {
    			$valor_variable_escapada=$registro_datos_formulario["$nombre_campo"];
    			//$valor_variable_escapada=addslashes ( '"'.$valor_variable_escapada.'"' );
    			//$valor_variable_escapada=urlencode($valor_variable_escapada);
    			
    			
    			//Agregado 23.4
    			$valor_variable_escapada=htmlentities($valor_variable_escapada,ENT_QUOTES); //Presenta la cadena como caracteres especiales HTML para ayudar a presentar correctamente tildes, comillas y barras
    			//Metodo Opcional: Determinar si la cadena tiene comilla doble y encerrar en comilla simple.  Determinar si tiene comilla simple y encerrar en dobles.
    			
    			
    			if ($PCO_CampoBusquedaBD!="" && $PCO_ValorBusquedaBD!="") $cadena_valor=' value="'.$valor_variable_escapada.'" ';
    	    }

		// Define cadenas en caso de tener validaciones
		$cadena_validacion='';
		if ($registro_campos["validacion_datos"]!="" && $registro_campos["validacion_datos"]!="fecha" && $registro_campos["validacion_datos"]!="hora" && $registro_campos["validacion_datos"]!="fechahora" && $registro_campos["validacion_datos"]!="fechaxanos" && $registro_campos["validacion_datos"]!="fechahorafull")
			$cadena_validacion=' onkeypress="return PCOJS_ValidarTeclado(event, \''.$registro_campos["validacion_datos"].'\', \''.$registro_campos["validacion_extras"].'\');" ';

        $cadena_complementaria_datepicker='';
        $cadena_ID_datepicker='';
        $cadena_clase_datepicker='';
        $cadena_ID_datepickerEspecifica='';
        //Genera cadenas especificas segun el datepicker requerido
		if ($registro_campos["validacion_datos"]=="fecha" || $registro_campos["validacion_datos"]=="hora" || $registro_campos["validacion_datos"]=="fechahora" || $registro_campos["validacion_datos"]=="fechaxanos" || $registro_campos["validacion_datos"]=="fechahorafull")
			{
				if ($registro_campos["validacion_datos"]=="fecha")
					{
						$cadena_ID_datepickerEspecifica="
								pickTime: false";
						$cadena_complementaria_datepicker=' data="DateTimePicker" data-date-format="YYYY-MM-DD" ';
					}
				if ($registro_campos["validacion_datos"]=="fechaxanos")
					{
						$cadena_ID_datepickerEspecifica="
								viewMode: 'years',
								pickTime: false";
						$cadena_complementaria_datepicker=' data="DateTimePicker" data-date-format="YYYY-MM-DD" ';
					}
				if ($registro_campos["validacion_datos"]=="hora")
					{
						$cadena_ID_datepickerEspecifica="
								pickDate: false,
								pickTime: true";
						$cadena_complementaria_datepicker=' data="DateTimePicker" data-date-format="HH:mm:00" ';
					}
				if ($registro_campos["validacion_datos"]=="fechahora")
					{
						$cadena_ID_datepickerEspecifica="
								pickDate: true,
								pickTime: true";
						$cadena_complementaria_datepicker=' data="DateTimePicker" data-date-format="YYYY-MM-DD HH:mm:ss" ';
					}
				if ($registro_campos["validacion_datos"]=="fechahorafull")
					{
						$cadena_ID_datepickerEspecifica="
								sideBySide: true,
								pickDate: true,
								pickTime: true";
						$cadena_complementaria_datepicker=' data="DateTimePicker" data-date-format="YYYY-MM-DD HH:mm:ss" ';
					}
				//Genera parametros finales para los datepicker
				$cadena_ID_datepicker=' id="DatePicker_'.$registro_campos["campo"].'" ';
                $cadena_clase_datepicker=' date ';
                @$funciones_activacion_datepickers.="
                    $(function () {
                        $('#DatePicker_".$registro_campos["campo"]."').datetimepicker({
                            //locale: 'es',
                            language: '$IdiomaPredeterminado',
                            ".$cadena_ID_datepickerEspecifica."
                        });
                    });";
			}

		// Si el campo es de tipo clave cambia el input a password
		if ($registro_campos["tipo"]=="texto_clave")
			{
				$tipo_entrada="password";
			}

        //Agrega etiqueta del campo si es diferente de vacio
		if ($registro_campos["titulo"]!="" && $registro_campos["ocultar_etiqueta"]=="0")
            $salida.='<label id="PCOEtiqueta_'.$registro_campos["campo"].'" for="'.$registro_campos["campo"].'">'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["titulo"],$registro_datos_formulario).':</label>';
		//Abre el marco del control de datos style="display:inline;"
		$salida.='<div class="form-group input-group '.$cadena_clase_datepicker.'" '.$cadena_ID_datepicker.'>';
        // Muestra el campo
		$salida.='<input tabindex="'.$TabIndex_Elemento.'" type="'.$tipo_entrada.'" id="'.$registro_campos["id_html"].'" name="'.$registro_campos["campo"].'" '.$cadena_valor.' '.$cadena_longitud_visual.' '.$cadena_longitud_permitida.' class="form-control " '.$cadena_validacion.' '.$registro_campos["solo_lectura"].' '.$cadena_complementaria_datepicker.'  '.$registro_campos["personalizacion_tag"].' '.$cadena_placeholder.' >';

		// Muestra boton de busqueda cuando el campo sea usado para esto
		if ($registro_campos["etiqueta_busqueda"]!="")
			{
                $salida.= '<span class="input-group-addon">';
                    $salida.= '<input type="Button" class="btn btn-default btn-xs" value="'.$registro_campos["etiqueta_busqueda"].'" onclick="document.'.$IdHTMLFormulario.'.PCO_ValorBusquedaBD.value=document.'.$IdHTMLFormulario.'.'.$registro_campos["campo"].'.value;document.'.$IdHTMLFormulario.'.PCO_Accion.value=\'PCO_CargarObjeto\';document.'.$IdHTMLFormulario.'.submit()">';
                    $salida.= '<input type="hidden" name="PCO_Objeto" value="frm:'.$formulario.'">';
                    $salida.= '<input type="Hidden" name="en_ventana" value="'.$en_ventana.'" >';
                    $salida.= '<input type="Hidden" name="PCO_CampoBusquedaBD" value="'.$registro_campos["campo"].'" >';
                    $salida.= '<input type="Hidden" name="PCO_ValorBusquedaBD" '.$cadena_valor.'>';
                $salida.= '</span>';
			}


		// Si el campo es de clave agrega icono para mostrarla (cambiando el tipo de control dinamicamente)
		if ($registro_campos["tipo"]=="texto_clave")
			{
			    $IdCampoClave=$registro_campos["id_html"];
                $salida.= '<script languaje="JavaScript">
                                //Cambia un tipo de control de formulario para poder presentar un boton de cambio a texto o password
                                function CambiarTipoControl_'.$IdCampoClave.'(Control)
                                    {
                                        if (document.getElementById(Control).type == "text")
                                            document.getElementById(Control).type = "password";
                                        else
                                            document.getElementById(Control).type = "text";
                                    }
                            </script>
                        <span class="input-group-addon">';
                    $salida.= '<a title="'.$MULTILANG_Contrasena.'" onclick="CambiarTipoControl_'.$IdCampoClave.'(\''.$IdCampoClave.'\');"><i class="fa fa-eye-slash fa-fw"></i></a>';
                $salida.= '</span>';
			}


        //Agrega el icono de calendario a campos con validaciones tipo datepicker al detectar una cadena de ID para algun datepicker
		if ($cadena_ID_datepicker!="")
			{
                $salida.='
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-calendar"></i>
                </span>';
            }

		// Muestra indicadores de obligatoriedad o ayuda
		//Si hay algun indicador adicional del campo abre los add-ons
        if ($registro_campos["valor_unico"] == "1" || $registro_campos["obligatorio"] || $registro_campos["ayuda_titulo"] != "")
            {
                $salida.= '<span class="input-group-addon">';
                if ($registro_campos["valor_unico"] == "1") $salida.= '<a href="#"  data-toggle="tooltip" data-html="true"  data-placement="auto" title="<b>'.$MULTILANG_TitValorUnico.'</b><br>'.$MULTILANG_DesValorUnico.'"><i class="fa fa-key fa-flip-horizontal texto-rojo"></i></a>';
                if ($registro_campos["obligatorio"]) $salida.= '<a href="#"   data-toggle="tooltip" data-html="true"  data-placement="auto" title="<b>'.$MULTILANG_TitObligatorio.'</b><br>'.$MULTILANG_DesObligatorio.'"><i class="fa fa-exclamation-triangle icon-orange"></i></a>';
                if ($registro_campos["ayuda_titulo"] != "") $salida.= '<a href="#"   data-toggle="tooltip" data-html="true"  data-placement="auto"  title="<b>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_titulo"],$registro_datos_formulario).'</b><br>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_texto"],$registro_datos_formulario).'"><i class="fa fa-question-circle"></i></a>';
                $salida.= '</span>';
            }
        //Cierra marco del control de datos
        $salida.= '</div>';
		return $salida;
	}



########################################################################
########################################################################
/*
	Function: PCO_CargarObjetoOculto
	Genera el codigo HTML y CSS correspondiente a un campo de texto pero oculto (hidden) vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos
		formulario - ID unico del formulario al cual pertenece el objeto

	Salida:

		HTML asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
function PCO_CargarObjetoOculto($registro_campos,$registro_datos_formulario,$formulario,$en_ventana)
	{
		global $PCO_CampoBusquedaBD,$PCO_ValorBusquedaBD;

		$salida='';
		$nombre_campo=$registro_campos["campo"];
		$tipo_entrada="hidden";

		// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
		$cadena_valor='';
		if ($registro_campos["valor_predeterminado"]!="") $cadena_valor=' value="'.$registro_campos["valor_predeterminado"].'" ';
		//Evalua si el valor predeterminado tiene signo $ al comienzo y ademas es una variable definida para poner su valor.
		if (substr($registro_campos["valor_predeterminado"], 0,1)=="$")
			{
				$nombre_variable = substr($registro_campos["valor_predeterminado"], 1);
				global ${$nombre_variable};
				if (isset($nombre_variable))
                    $cadena_valor=${$nombre_variable};
			}
		if ($PCO_CampoBusquedaBD!="" && $PCO_ValorBusquedaBD!="") $cadena_valor=$registro_datos_formulario["$nombre_campo"];

		// Muestra el campo
		$salida.='<input type="'.$tipo_entrada.'" name="'.$registro_campos["campo"].'" value="'.$cadena_valor.'" >';
		return $salida;
	}


########################################################################
########################################################################
/*
	Function: PCO_CargarObjetoTextoLargo
	Genera el codigo HTML y CSS correspondiente a un campo de texto largo (textarea) vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
function PCO_CargarObjetoTextoLargo($registro_campos,$registro_datos_formulario)
	{
		global $PCO_CampoBusquedaBD,$PCO_ValorBusquedaBD;
		global $MULTILANG_TitValorUnico,$MULTILANG_DesValorUnico,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio;
		global $TabIndex_Elemento;

		$salida='';
		$nombre_campo=$registro_campos["campo"];

		// Define cadenas de tamano de campo
		$cadena_ancho_visual=' cols="'.$registro_campos["ancho"].'" ';
		$cadena_alto_visual=' rows="'.$registro_campos["alto"].'" ';
		$cadena_longitud_visual=$cadena_ancho_visual.$cadena_alto_visual;

		// Especifica textos de placeholder si existen
		$cadena_placeholder='';
		if ($registro_campos["valor_placeholder"]!="")
			$cadena_placeholder=' placeholder="'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["valor_placeholder"],$registro_datos_formulario).'" ';

		// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
		$cadena_valor='';
		if ($registro_campos["valor_predeterminado"]!="") $cadena_valor=PCO_ReemplazarVariablesPHPEnCadena($registro_campos["valor_predeterminado"],$registro_datos_formulario);
		//Evalua si el valor predeterminado tiene signo $ al comienzo y ademas es una variable definida para poner su valor.  COMPATIBILIDAD HACIA ATRAS
		if (substr($registro_campos["valor_predeterminado"], 0,1)=="$")
			{
				$nombre_variable = substr($registro_campos["valor_predeterminado"], 1);
				global ${$nombre_variable};
				if (isset($nombre_variable))
					{
						$valor_variable=${$nombre_variable};
						$cadena_valor=' value="'.$valor_variable.'" ';
					}
			}
		if ($PCO_CampoBusquedaBD!="" && $PCO_ValorBusquedaBD!="") $cadena_valor=$registro_datos_formulario["$nombre_campo"];

		// Define cadenas en caso de tener validaciones
		$cadena_validacion='';
		if ($registro_campos["validacion_datos"]!="" && $registro_campos["validacion_datos"]!="fecha" && $registro_campos["validacion_datos"]!="hora" && $registro_campos["validacion_datos"]!="fechahora" && $registro_campos["validacion_datos"]!="fechaxanos" && $registro_campos["validacion_datos"]!="fechahorafull")
			$cadena_validacion=' onkeypress="return PCOJS_ValidarTeclado(event, \''.$registro_campos["validacion_datos"].'\', \''.$registro_campos["validacion_extras"].'\');" ';


        //Determina si se tendran conversiones de campo a campo con TAGS
        //$registro_campos["personalizacion_tag"]
        if (strstr($registro_campos["personalizacion_tag"],"PCO_Tags")!=FALSE )
            {
                $PCO_Tags_OcultamientoCampo=" style='visibility:hidden; height:0px; ' ";
                $PCO_PreDIVTags='
                    <div id="PCODIV_ContenedorTAGS_'.$registro_campos["id_html"].'" style="border:solid; border-width:1px; border-color:lightgray;" >
                        <div id="PCODIV_Tags_'.$registro_campos["id_html"].'"></div>
                        <input type="text" name="PCOVAR_CajaEntradaTags_'.$registro_campos["id_html"].'" id="PCOVAR_CajaEntradaTags_'.$registro_campos["id_html"].'" placeholder=" >>> Ingrese valores separados por coma" style="font-size:10px; margin-top:3px; background-color:transparent; border-width:0px; width:100%;"  onblur="PCOJS_GenerarCadenaTags_'.$registro_campos["id_html"].'(event,true)" onkeydown="PCOJS_GenerarCadenaTags_'.$registro_campos["id_html"].'(event,false)" onkeyup="PCOJS_GenerarCadenaTags_'.$registro_campos["id_html"].'(event,false)">
                        <div align="right" style="font-size:10px; color:gray;"><i class="fa fa-tag"></i> Total elementos: <b><div id="PCODIV_ConteoTags_'.$registro_campos["id_html"].'" style="display:inline">0</div></b>&nbsp;</div>
                    </div>';

                $PCO_JavaScriptTags='
                    <script language="JavaScript">
                        //Define arreglo para almacenar todos los Tags
                        let PCOVAR_ArregloTags_'.$registro_campos["id_html"].' = [];

                        function PCOJS_AgregarTag_'.$registro_campos["id_html"].'(Texto){
                        	PCODIV_Tags_'.$registro_campos["id_html"].'=document.getElementById("PCODIV_Tags_'.$registro_campos["id_html"].'");
                        	PCODIV_Tags_'.$registro_campos["id_html"].'.innerHTML=PCODIV_Tags_'.$registro_campos["id_html"].'.innerHTML+\'&nbsp;<div class="badge">\'+Texto+\' &nbsp;<a><i style="color:white;" class="fa fa-times-circle" onclick="PCOJS_RemoverTag_'.$registro_campos["id_html"].'(\\\'\'+Texto+\'\\\');"></i></a></div>\';
                        }
                        
                        function PCOJS_LimpiarTags_'.$registro_campos["id_html"].'(ID_HTML_Campo)
                        	{
                        		PCODIV_Tags_'.$registro_campos["id_html"].'=document.getElementById("PCODIV_Tags_'.$registro_campos["id_html"].'");
                        		PCODIV_Tags_'.$registro_campos["id_html"].'.innerHTML="";
                        		PCOJS_RegenerarTagsDesdeValor_'.$registro_campos["id_html"].'(ID_HTML_Campo);
                        	}
                        
                        function PCOJS_RegenerarTagsDesdeValor_'.$registro_campos["id_html"].'(ID_HTML_Campo)
                        	{
                        	    //Limpia el arreglo actual de los tags y lo genera desde cero usando el valor del textarea
                        	    PCOVAR_ArregloTags_'.$registro_campos["id_html"].'.length = 0;
                        	
                                PCODIV_Tags_'.$registro_campos["id_html"].'=document.getElementById("PCODIV_Tags_'.$registro_campos["id_html"].'");
                                PCODIV_Tags_'.$registro_campos["id_html"].'.innerHTML="";
                                PCOVAR_ValorTag=$("#"+ID_HTML_Campo).val();
                                if(PCOVAR_ValorTag.length > 1 && !PCOVAR_ArregloTags_'.$registro_campos["id_html"].'.includes(PCOVAR_ValorTag)){
                                        PCOVAR_ValorTag.split(",").forEach(PCOVAR_ValorTag => {
                                            PCOVAR_ValorTag=PCOVAR_ValorTag.replace(/\n/g, "");
                                            PCOVAR_ArregloTags_'.$registro_campos["id_html"].'.push(PCOVAR_ValorTag);
                                            PCOJS_AgregarTag_'.$registro_campos["id_html"].'(PCOVAR_ValorTag);
                                        });
                                }
                        	}
    
                        function PCOJS_RemoverTag_'.$registro_campos["id_html"].'(Texto){
                            let IndiceTag = PCOVAR_ArregloTags_'.$registro_campos["id_html"].'.indexOf(Texto);
                            PCOVAR_ArregloTags_'.$registro_campos["id_html"].' = [...PCOVAR_ArregloTags_'.$registro_campos["id_html"].'.slice(0, IndiceTag), ...PCOVAR_ArregloTags_'.$registro_campos["id_html"].'.slice(IndiceTag + 1)];
                            PCOJS_RefrescarValoresTag_'.$registro_campos["id_html"].'("'.$registro_campos["id_html"].'");
                            
                            PCOJS_LimpiarTags_'.$registro_campos["id_html"].'("'.$registro_campos["id_html"].'");
                            PCOJS_RegenerarTagsDesdeValor_'.$registro_campos["id_html"].'("'.$registro_campos["id_html"].'");
                        }
                        
                        function PCOJS_RefrescarValoresTag_'.$registro_campos["id_html"].'(ID_HTML_Campo)
                        	{
                        		$("#"+ID_HTML_Campo).val("");
                        		$("#"+ID_HTML_Campo).val(  PCOVAR_ArregloTags_'.$registro_campos["id_html"].'.join(",")  );
                        		$("#PCODIV_ConteoTags_'.$registro_campos["id_html"].'").html(""+PCOVAR_ArregloTags_'.$registro_campos["id_html"].'.length);
                        	}
                        
                        function PCOJS_GenerarCadenaTags_'.$registro_campos["id_html"].'(e,ByPass){
                            if(e.key=="Enter" || e.key=="," || ByPass)
                            {
                                PCOVAR_ValorTag=e.target.value;
                                PCOVAR_ValorTag=PCOVAR_ValorTag.replace(/\n/g, "");
    
                                if(PCOVAR_ValorTag.length > 1 && PCOVAR_ArregloTags_'.$registro_campos["id_html"].'.includes(PCOVAR_ValorTag)==false){
                                        PCOVAR_ValorTag.split(",").forEach(PCOVAR_ValorTag => {
                                        
                                            if (PCOVAR_ArregloTags_'.$registro_campos["id_html"].'.includes(PCOVAR_ValorTag)==false)
                                            {
                                            PCOVAR_ArregloTags_'.$registro_campos["id_html"].'.push(PCOVAR_ValorTag);
                                            PCOJS_AgregarTag_'.$registro_campos["id_html"].'(PCOVAR_ValorTag);
                                            }
                                        });
                                }
                                e.target.value = "";
                            }
                            PCOJS_RefrescarValoresTag_'.$registro_campos["id_html"].'("'.$registro_campos["id_html"].'");
                        }

                        //Hace los llamados iniciales para regenerar en los casos en que se recupera un registro y actualizar el conteo
                        $(function() {
                            PCOJS_RegenerarTagsDesdeValor_'.$registro_campos["id_html"].'("'.$registro_campos["id_html"].'");
                            $("#PCODIV_ConteoTags_'.$registro_campos["id_html"].'").html(""+PCOVAR_ArregloTags_'.$registro_campos["id_html"].'.length);
                        });
                    </script>';
            }

        //Agrega etiqueta del campo si es diferente de vacio
		if ($registro_campos["titulo"]!="" && $registro_campos["ocultar_etiqueta"]=="0")
            $salida.='<label for="'.$registro_campos["campo"].'">'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["titulo"],$registro_datos_formulario).':</label>';
		//Abre el marco del control de datos
		$salida.='<div class="form-group input-group">';
		// Muestra el campo
		$salida.= $PCO_JavaScriptTags.$PCO_PreDIVTags.'<textarea '.$PCO_Tags_OcultamientoCampo.' tabindex="'.$TabIndex_Elemento.'" id="'.$registro_campos["id_html"].'" name="'.$registro_campos["campo"].'" '.$cadena_longitud_visual.' class=" form-control " '.$registro_campos["solo_lectura"].'  '.$registro_campos["personalizacion_tag"].' '.$cadena_placeholder.'  '.$cadena_validacion.' >'.$cadena_valor.'</textarea>';
		//Si hay algun indicador adicional del campo abre los add-ons
        if ($registro_campos["valor_unico"] == "1" || $registro_campos["obligatorio"] || $registro_campos["ayuda_titulo"] != "")
            {
                $salida.= '<span class="input-group-addon">';
                // Muestra indicadores de obligatoriedad o ayuda
                if ($registro_campos["obligatorio"]) $salida.= '<a href="#"   data-toggle="tooltip" data-html="true"  data-placement="auto" title="<b>'.$MULTILANG_TitObligatorio.'</b><br>'.$MULTILANG_DesObligatorio.'"><i class="fa fa-exclamation-triangle icon-orange"></i></a>';
                if ($registro_campos["ayuda_titulo"] != "") $salida.= '<a href="#"  data-toggle="tooltip" data-html="true"  data-placement="auto" title="<b>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_titulo"],$registro_datos_formulario).'</b><br>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_texto"],$registro_datos_formulario).'"><i class="fa fa-question-circle"></i></a>';
                $salida.= '</span>';
            }
        //Cierra marco del control de datos
        $salida.= '</div>';
		return $salida;
	}


########################################################################
########################################################################
/*
	Function: PCO_CargarObjetoAreaResponsive
	Genera el codigo HTML y CSS correspondiente a un campo de texto con formato responsive usando SummerNote

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
function PCO_CargarObjetoAreaResponsive($registro_campos,$registro_datos_formulario)
	{
		global $PCO_CampoBusquedaBD,$PCO_ValorBusquedaBD;
		global $IdiomaPredeterminado,$MULTILANG_TitValorUnico,$MULTILANG_DesValorUnico,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio;
        global $TabIndex_Elemento;

		$salida='';
		$nombre_campo=$registro_campos["campo"];

		// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
		$cadena_valor='';
		if ($registro_campos["valor_predeterminado"]!="") $cadena_valor=$registro_campos["valor_predeterminado"];
		//Evalua si el valor predeterminado tiene signo $ al comienzo y ademas es una variable definida para poner su valor.
		if (substr($registro_campos["valor_predeterminado"], 0,1)=="$")
			{
				$nombre_variable = substr($registro_campos["valor_predeterminado"], 1);
				global ${$nombre_variable};
				if (isset($nombre_variable))
					{
						$valor_variable=${$nombre_variable};
						$cadena_valor=' value="'.$valor_variable.'" ';
					}
			}
		if ($PCO_CampoBusquedaBD!="" && $PCO_ValorBusquedaBD!="") $cadena_valor=$registro_datos_formulario["$nombre_campo"];

		// Muestra el campo
		$salida.= '<div id="Summer_'.$registro_campos["campo"].'" class="summernote" ></div>';

		// Agrega el campo del form pero oculto
		$salida.= '<textarea tabindex="'.$TabIndex_Elemento.'" id="'.$registro_campos["id_html"].'" name="'.$registro_campos["campo"].'" '.$registro_campos["solo_lectura"].'  '.$registro_campos["personalizacion_tag"].' style="visibility:hidden; display:none;" >'.$cadena_valor.'</textarea>';

        //Busca el id_html de formulario para usarlo en la creacion del summernote
        $NombreFormulario=PCO_EjecutarSQL("SELECT id_html FROM core_formulario WHERE id='".$registro_campos["formulario"]."' ")->fetchColumn();

		//Si el campo tiene una altura la agrega, sino la deja vacia para ser responsive
        $cadena_altura="";
		if ($registro_campos["alto"]!="" && $registro_campos["alto"]!="0")
			$cadena_altura="height: ".$registro_campos["alto"].", ";

		//Construye el tipo de barra de herramientas, iniciando por la completa o sino asignando la que corresponda
		$cadena_barraherramientas_Base="
				['Operaciones', ['undo', 'redo']],";
		$cadena_barraherramientas_Basica="
			['Caracter', ['bold', 'italic', 'underline', 'strikethrough', 'clear', 'color']],
			['Parrafo1', ['ul', 'ol']],
			['Parrafo2', ['paragraph']],
			['Parrafo3', ['height']],";
		$cadena_barraherramientas_Estandar="
			['Estilos', ['style']],
			['Fuentes1', ['fontname']],
			['Fuentes2', ['fontsize']],";
		$cadena_barraherramientas_Extendida="
			['Insertar1', ['link', 'table', 'hr']],";
		$cadena_barraherramientas_Avanzada="
			['Otros', ['fullscreen', 'codeview']], ";
		$cadena_barraherramientas_Completa="
			['Insertar2', ['picture', 'video']], ";

		$cadena_barraherramientas=$cadena_barraherramientas_Base;
		if ($registro_campos["barra_herramientas"]=="5") //BASICA
			$cadena_barraherramientas=$cadena_barraherramientas_Base.$cadena_barraherramientas_Basica;
		if ($registro_campos["barra_herramientas"]=="6") //ESTANDAR
			$cadena_barraherramientas=$cadena_barraherramientas_Estandar.$cadena_barraherramientas_Base.$cadena_barraherramientas_Basica;								
		if ($registro_campos["barra_herramientas"]=="7") //EXTENDIDA
			$cadena_barraherramientas=$cadena_barraherramientas_Estandar.$cadena_barraherramientas_Base.$cadena_barraherramientas_Basica.$cadena_barraherramientas_Extendida;
		if ($registro_campos["barra_herramientas"]=="8") //AVANZADA
			$cadena_barraherramientas=$cadena_barraherramientas_Estandar.$cadena_barraherramientas_Base.$cadena_barraherramientas_Basica.$cadena_barraherramientas_Extendida.$cadena_barraherramientas_Avanzada;
		if ($registro_campos["barra_herramientas"]=="9") //COMPLETA
			$cadena_barraherramientas=$cadena_barraherramientas_Estandar.$cadena_barraherramientas_Base.$cadena_barraherramientas_Basica.$cadena_barraherramientas_Extendida.$cadena_barraherramientas_Avanzada.$cadena_barraherramientas_Completa;
		$cadena_barraherramientas="toolbar: [".$cadena_barraherramientas."],";

		$salida.= "
    		<script language='JavaScript'>
        		$ (function() { 
        			$('#Summer_".$registro_campos["campo"]."').summernote({
        			lang: '".$IdiomaPredeterminado."-".strtoupper($IdiomaPredeterminado)."', // default: 'en-US'
        			  $cadena_altura
        			  $cadena_barraherramientas
                      callbacks: {
                        onChange: function(contents) {
                          document.$NombreFormulario.".$registro_campos["campo"].".value=contents;
                        }
                      }
        			});
        
        		//Asigna el valor inicial del textarea al marco visual a manera de codigo
        		$('#Summer_".$registro_campos["campo"]."').summernote('code',document.$NombreFormulario.".$registro_campos["campo"].".value);
        		
        		});
    		</script>";

		return $salida;
	}


########################################################################
########################################################################
/*
	Function: PCO_CargarObjetoTextoFormato
	Genera el codigo HTML y CSS correspondiente a un campo de texto largo (textarea alterado por CKEditor) vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos
		existe_campo_textoformato - Variable que determina si ya han sido cargadas las librerias del CKEditor para evitar una segunda carga y errores derivados de JavaScript

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
function PCO_CargarObjetoTextoFormato($registro_campos,$registro_datos_formulario,$existe_campo_textoformato)
	{
		global $PCO_CampoBusquedaBD,$PCO_ValorBusquedaBD;
		global $MULTILANG_TitValorUnico,$MULTILANG_DesValorUnico,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio;
        global $TabIndex_Elemento;

		$salida='';
		$nombre_campo=$registro_campos["campo"];

		// Define cadenas de tamano de campo
		$cadena_ancho_visual=' cols="'.$registro_campos["ancho"].'" ';
		$cadena_alto_visual=' rows="'.$registro_campos["alto"].'" ';
		$cadena_longitud_visual=$cadena_ancho_visual.$cadena_alto_visual;

		// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
		$cadena_valor='';
		if ($registro_campos["valor_predeterminado"]!="") $cadena_valor=$registro_campos["valor_predeterminado"];
		//Evalua si el valor predeterminado tiene signo $ al comienzo y ademas es una variable definida para poner su valor.
		if (substr($registro_campos["valor_predeterminado"], 0,1)=="$")
			{
				$nombre_variable = substr($registro_campos["valor_predeterminado"], 1);
				global ${$nombre_variable};
				if (isset($nombre_variable))
					{
						$valor_variable=${$nombre_variable};
						$cadena_valor=' value="'.$valor_variable.'" ';
					}
			}
		if ($PCO_CampoBusquedaBD!="" && $PCO_ValorBusquedaBD!="") $cadena_valor=$registro_datos_formulario["$nombre_campo"];

		// Muestra el campo
		$salida.= '<textarea tabindex="'.$TabIndex_Elemento.'" id="'.$registro_campos["id_html"].'" name="'.$registro_campos["campo"].'" '.$cadena_longitud_visual.' '.$registro_campos["solo_lectura"].'  '.$registro_campos["personalizacion_tag"].'  >'.$cadena_valor.'</textarea>';

		// Define las barras posibles para el editor
		$barra_documento="'sourceEditing','|','heading'";
		$barra_basica="'bold', 'italic', 'underline', 'strikethrough','subscript','superscript','|','removeFormat'";
		$barra_parrafo="'numberedList','bulletedList','|','outdent','indent','|','blockQuote','|','alignment'";
		$barra_enlaces="'link'";
		$barra_estilos="'fontSize','fontFamily'";
		$barra_portapapeles="'|','undo','redo'";
		$barra_edicion="'findAndReplace','selectAll','|'";
		$barra_insertar="'insertTable','horizontalLine','specialCharacters','pageBreak','htmlEmbed'";
		$barra_colores="'fontColor','fontBackgroundColor','highlight'";
		$barra_formularios=""; //DEPRECATED en version 5
		$barra_otros="'code', 'codeBlock'";

		// Construye las barras de herramientas de acuerdo a la seleccion del usuario
		@$barra_editor.="'|'";
		if ($registro_campos["barra_herramientas"]=="0")
			{
				$barra_editor.=",".$barra_documento;
				$barra_editor.=",".$barra_basica;
				$barra_editor.=",".$barra_parrafo;
			}
		if ($registro_campos["barra_herramientas"]=="1")
			{
				$barra_editor.=",".$barra_documento;
				$barra_editor.=",".$barra_basica;
				$barra_editor.=",".$barra_parrafo;
				$barra_editor.=",".$barra_enlaces;
				$barra_editor.=",".$barra_estilos;
			}
		if ($registro_campos["barra_herramientas"]=="2")
			{
				$barra_editor.=",".$barra_documento;
				$barra_editor.=",".$barra_basica;
				$barra_editor.=",".$barra_parrafo;
				$barra_editor.=",".$barra_enlaces;
				$barra_editor.=",".$barra_estilos;
				$barra_editor.=",".$barra_portapapeles;
				$barra_editor.=",".$barra_edicion;
			}
		if ($registro_campos["barra_herramientas"]=="3")
			{
				$barra_editor.=",".$barra_documento;
				$barra_editor.=",".$barra_basica;
				$barra_editor.=",".$barra_parrafo;
				$barra_editor.=",".$barra_enlaces;
				$barra_editor.=",".$barra_estilos;
				$barra_editor.=",".$barra_portapapeles;
				$barra_editor.=",".$barra_edicion;
				$barra_editor.=",".$barra_insertar;
				$barra_editor.=",".$barra_colores;
			}
		if ($registro_campos["barra_herramientas"]=="4")
			{
				$barra_editor.=",".$barra_documento;
				$barra_editor.=",".$barra_basica;
				$barra_editor.=",".$barra_parrafo;
				$barra_editor.=",".$barra_enlaces;
				$barra_editor.=",".$barra_estilos;
				$barra_editor.=",".$barra_portapapeles;
				$barra_editor.=",".$barra_edicion;
				$barra_editor.=",".$barra_insertar;
				$barra_editor.=",".$barra_colores;
				//$barra_editor.=",".$barra_formularios;
				$barra_editor.=",".$barra_otros;
			}
		// Aplica el script del ckeditor al campo
		if (!$existe_campo_textoformato)
			$salida.= '<script type="text/javascript" src="inc/ckeditor/ckeditor.js"></script>';
		
		//Determina si se requiere un tamano especifico del control y lo usa, sino lo deja en blanco para responsive
		
		$CadenaTamanoControl='';
		if ($registro_campos["alto"]!="" && $registro_campos["alto"]!="0" && $registro_campos["ancho"]!="" && $registro_campos["ancho"]!="0")
		    $CadenaTamanoControl='  editor.ui.element.style.height = "'.$registro_campos["alto"].'px";
                    			    editor.ui.element.style.width = "'.$registro_campos["ancho"].'px";';
		
		$salida.= '<script>
                    	ClassicEditor
                    		.create( document.querySelector( "#'.$registro_campos["id_html"].'" ), {
                    			toolbar: [ '.$barra_editor.' ]
                    		} )
                    		.then( editor => {
                    			window.editor = editor;
                    			'.$CadenaTamanoControl.'
                    		} )
                    		.catch( err => {
                    			console.error( err.stack );
                    		} );
                    </script>';

		// Muestra indicadores de obligatoriedad o ayuda
		if ($registro_campos["obligatorio"]) $salida.= '<a href="#"  data-toggle="tooltip" data-html="true"  data-placement="auto"  title="<b>'.$MULTILANG_TitObligatorio.'</b><br>'.$MULTILANG_DesObligatorio.'"><i class="fa fa-exclamation-triangle icon-orange"></i></a>';
		if ($registro_campos["ayuda_titulo"] != "") $salida.= '<a href="#"  data-toggle="tooltip" data-html="true"  data-placement="auto"  title="<b>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_titulo"],$registro_datos_formulario).'</b><br>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_texto"],$registro_datos_formulario).'"><i class="fa fa-question-circle"></i></a>';

		//Activa booleana de existencia de tipo de campo para evitar doble inclusion de javascript
		$existe_campo_textoformato=1;
		return $salida;
	}


########################################################################
########################################################################
/*
	Function: PCO_CargarObjetoListaSeleccion
	Genera el codigo HTML y CSS correspondiente a un campo de lista (select - ComboBox) vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
function PCO_CargarObjetoListaSeleccion($registro_campos,$registro_datos_formulario,$formulario,$en_ventana)
	{
		global $TablasCore,$PCO_CampoBusquedaBD,$PCO_ValorBusquedaBD;
		global $PCO_ScriptsListaCombosPostCarga,$PCO_ListaCombosMultiplesJoin;
		global $MULTILANG_Cargando,$MULTILANG_Buscar,$MULTILANG_TitValorUnico,$MULTILANG_DesValorUnico,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio,$MULTILANG_SeleccioneUno,$MULTILANG_FrmActualizaAjax;
        global $TabIndex_Elemento;

        //Busca datos del formulario
        $RegistroDisenoFormulario=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."formulario WHERE id=?", "$formulario")->fetch();
        $IdHTMLFormulario=$RegistroDisenoFormulario["id_html"];

		$salida='';
		$nombre_campo=$registro_campos["campo"];

		// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
		if ($PCO_CampoBusquedaBD!="" && $PCO_ValorBusquedaBD!="")
            {
                //Si se tiene un valor de registro entonces lo prefiere, sino usa el de busqueda
                if ($registro_datos_formulario["$nombre_campo"]!="")
                    $cadena_valor=$registro_datos_formulario["$nombre_campo"];
                else
                    {
                        //Asigna el valor solo si no se trata de una lista multiple, pues listas multiples no son validas para recuperar registros unicos.
                        if (!strstr($registro_campos["personalizacion_tag"],"multiple")!=FALSE && $nombre_campo==$PCO_CampoBusquedaBD)
                            $cadena_valor=$PCO_ValorBusquedaBD;
                    }
            }

		// Define si el control es un ComboBox o un ListBox dependiendo de su altura (!=0 es listbox)
		if ($registro_campos["alto"]!='0')
			$cadena_altura='size='.$registro_campos["alto"];

        //Agrega etiqueta del campo si es diferente de vacio
		if ($registro_campos["titulo"]!="" && $registro_campos["ocultar_etiqueta"]=="0")
            $salida.='<label id="PCOEtiqueta_'.$registro_campos["campo"].'" for="'.$registro_campos["campo"].'">'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["titulo"],$registro_datos_formulario).':</label>';

		// Define si el control es solo lectura o no
		$EstadoLecturaControl="";
		if ($registro_campos["solo_lectura"]=='READONLY')
			$EstadoLecturaControl=' disabled ';

        //Si la lista tiene activada la recuperacion por AJAX mientras se escribe agrega el modificador
        $EstadoRecuperacionDinamica="";
        $EstadoObligadoLiveSerachRecuperacionDinamica="";
        if ($registro_campos["ajax_busqueda_dinamica"]=="1")
            {
                $EstadoRecuperacionDinamica=" with-ajax ";                
                $EstadoObligadoLiveSerachRecuperacionDinamica=" data-live-search=true ";
            }

        //Define cadenas para el ancho del control (si aplica)
        $CadenaAnchoSelect='  ';
        $CadenaAnchoOption='  ';
        if ($registro_campos["ancho"]!="" && $registro_campos["ancho"] !="0")
            {
                $CadenaAnchoSelect=' data-width="'.$registro_campos["ancho"].'px" ';
                $CadenaAnchoOption=" style='width : ".$registro_campos["ancho"]."px;' ";
            }

		//Abre el marco del control de datos
		$salida.='<div class="form-group input-group">';
		// Muestra el campo
		$salida.= '<select '.$CadenaAnchoSelect.' tabindex="'.$TabIndex_Elemento.'" id="'.$registro_campos["id_html"].'" name="'.$registro_campos["campo"].'" data-container="body" class="selectpicker '.$EstadoRecuperacionDinamica.' combo-'.$registro_campos["campo"].' show-tick" '.@$cadena_altura.' title="'.$MULTILANG_SeleccioneUno.'" '.$registro_campos["personalizacion_tag"].' '.$EstadoObligadoLiveSerachRecuperacionDinamica.' '.$EstadoLecturaControl.' >';


            //Genera Script Ajax y DIV para cambio de opciones en caliente
            $nombre_tabla_opciones = explode(".", $registro_campos["origen_lista_opciones"]);
            $nombre_tabla_opciones = $nombre_tabla_opciones[0];

            //Define algunas variables de construccion de la cadena final
            $PCO_Prefijo='';
            $PCO_Infijo='|';
            $PCO_Posfijo='!';

            echo '
                <script type="text/javascript">
                    function PCO_ObtenerListaOpciones_'.$registro_campos["campo"].'()
                        {
                            //Limpia el combo
                            var variablecombo_'.$registro_campos["campo"].' = document.getElementById("'.$registro_campos["campo"].'");
                            document.getElementById("'.$registro_campos["campo"].'").options.length=0;

                            var xmlhttp;
                            if (window.XMLHttpRequest)
                                {   // codigo for IE7+, Firefox, Chrome, Opera, Safari
                                    xmlhttp=new XMLHttpRequest();
                                }
                            else
                                {   // codigo for IE6, IE5
                                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                                }

                            //funcion que se llama cada vez que cambia la propiedad readyState
                            xmlhttp.onreadystatechange=function()
                                {
                                    //readyState 4: peticion finalizada y respuesta lista
                                    //status 200: OK
                                    if (xmlhttp.readyState===4 && xmlhttp.status===200)
                                        {
                                            //Pasar la respuesta html al div correspondiente
                                            //document.getElementById("PCO_ListaOpciones_'.$registro_campos["campo"].'").innerHTML=xmlhttp.responseText;
                                            contenido_recibido=xmlhttp.responseText;
                                            contenido_recibido = contenido_recibido.trim();
                                            arreglo_opciones = contenido_recibido.split("!");

                                            //Agrega la primera opcion vacia
                                            var etiqueta_option = document.createElement("option");
                                            etiqueta_option.value = "";
                                            etiqueta_option.text = "";
                                            variablecombo_'.$registro_campos["campo"].'.add(etiqueta_option);

                                            //Recorre el arreglo de opciones y las agrega al combo
                                            for (x=0;x<arreglo_opciones.length-1;x++)
                                                {
                                                    arreglo_elementos_opciones=arreglo_opciones[x].split("|");
                                                    //Agrega el elemento
                                                    var etiqueta_option = document.createElement("option");
                                                    etiqueta_option.value = arreglo_elementos_opciones[0];
                                                    etiqueta_option.text = arreglo_elementos_opciones[1];
                                                    variablecombo_'.$registro_campos["campo"].'.add(etiqueta_option);
                                                }

                                            //Actualiza el combo con las nuevas opciones
                                            $(".combo-'.$registro_campos["campo"].'").selectpicker("refresh");
                                        }
                                };

                            /* open(metodo, url, asincronico)
                            * metodo: post o get
                            * url: localizacion del archivo en el servidor
                            * asincronico: comunicacion asincronica true o false.*/
                            xmlhttp.open("POST","index.php",true);

                            //establece el header para la respuesta
                            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

                            //enviamos las variables al archivo get_combo2.php
                            //xmlhttp.send();
                            xmlhttp.send("PCO_Accion=opciones_combo_box&Presentar_FullScreen=1&origen_lista_tablas='.$nombre_tabla_opciones.'&origen_lista_opciones='.$registro_campos["origen_lista_opciones"].'&origen_lista_valores='.$registro_campos["origen_lista_valores"].'&condicion_filtrado_listas='.str_replace('"','\"',$registro_campos["condicion_filtrado_listas"]).'&PCO_Prefijo='.$PCO_Prefijo.'&PCO_Infijo='.$PCO_Infijo.'&PCO_Posfijo='.$PCO_Posfijo.'");
                        }
                </script>

            <div id="PCO_ListaOpciones_'.$registro_campos["campo"].'" style="display: inline-table;">';





                // Toma los valores desde la lista de opciones (cuando es estatico)
                //Si el campo es una simple coma entonces es para agregar el vacio al comienzo, sino hace la lista
                if ($registro_campos["lista_opciones"]!='')
                    {
                        //Es diferente de vacio asi que ahora verifica si es solo una coma para poner valor inicial en blanco o si debe expandir todo
                        if ($registro_campos["lista_opciones"]==',')
                            {
                                $opciones_lista[] = "";
                                $valores_lista[] = "";
                                $tags_lista[] = "";
                            }
                        else
                            {
                                $opciones_lista = explode(",", $registro_campos["lista_opciones"]);
                                $valores_lista = explode(",", $registro_campos["lista_opciones"]);
                                //Crea misma cantidad de tags vacios como valores
                                foreach ($valores_lista as $recorrido_valores)
                                    { $tags_lista[] = ""; }
                            }
                    }

                // Si se desea tomar los valores del combo desde una tabla hace la consulta
                    if ($registro_campos["origen_lista_opciones"]!="" && $registro_campos["origen_lista_valores"]!="")
                        {
                            $nombre_tabla_opciones = explode(".", $registro_campos["origen_lista_valores"]); //Usa el campo de valor de la lista que se asume es unico
                            $nombre_tabla_opciones = $nombre_tabla_opciones[0];
                            $campo_valores=$registro_campos["origen_lista_valores"];
                            $campo_opciones=$registro_campos["origen_lista_opciones"];
                            //Define si los registros a mostrar en la lista deben estar filtrados por alguna condicion
                            $condicion_filtrado_listas=PCO_ReemplazarVariablesPHPEnCadena($registro_campos["condicion_filtrado_listas"],$registro_datos_formulario);
                            
                            if ($condicion_filtrado_listas=="")
    							$condicion_filtrado_listas="1";
                            else
    							{
    								//Mientras existan llaves abriendo y cerrando dentro de la condicion intenta establecer valor de variables
    								$SalidaFiltradoBypass=0;
    								while(strpos($condicion_filtrado_listas,"{")!==FALSE && strpos($condicion_filtrado_listas,"}")!==FALSE && $SalidaFiltradoBypass==0)
    									{
    										//Evalua casos donde se tienen variables PHP escapadas por llaves.  Ej  "%{$Variable}%" si fuera para un LIKE, por ejemplo o para una variable en un where  campo="{$Variable}"
    										if (strpos($condicion_filtrado_listas,"{")!==FALSE && strpos($condicion_filtrado_listas,"}")!==FALSE)
    											{
    												//Determina las posiciones de las llaves en la cadena
    												$PosLlaveIzquierda=strpos($condicion_filtrado_listas,"{");
    												$PosLlaveDerecha=strpos($condicion_filtrado_listas,"}");
    												//Toma solo el pedazo entre llaves para intentar ubicar el valor de la variable por su nombre
    												$NombreVariable=substr($condicion_filtrado_listas,$PosLlaveIzquierda+2,$PosLlaveDerecha-$PosLlaveIzquierda-2);
    												//Si la variable no esta definida la busca en el entorno global
    												global ${$NombreVariable};
    												if (@isset($NombreVariable))
    													{
    														$ValorVariable=${$NombreVariable};
    														//Reemplaza el valor encontrado en la cadena de valor original
    														$condicion_filtrado_listas=str_replace('{$'.$NombreVariable.'}',$ValorVariable,$condicion_filtrado_listas);
    													}
    												else
    													{
    														//Puede que no se logre reemplazar nada porque la variable no esta definida entonces sale por ByPass para evitar ciclo infinito
    														$SalidaFiltradoBypass=1;
    													}
    											}
    									}
    							}
    
                            //Recupera los datos para la lista.  En listas de llenado estandar recupera todo SINO solo los posibles valores ya seleccionados
                            if ($registro_campos["ajax_busqueda_dinamica"]=="0")
                                {
                                    //Determina si la tabla en cuestion cuenta con el campo tags_extra.  Si es asi lo usa para generar lista de tags
                                    $ComplementoCampoTags="";
                                    if (PCO_ExisteCampoTabla("tags_extra",$nombre_tabla_opciones))
                                        $ComplementoCampoTags=", tags_extra as tags_extra ";
                                                
                                    // Consulta los campos para el tag select
                                    $resultado_opciones=PCO_EjecutarSQL("SELECT $campo_valores as valores, $campo_opciones as opciones {$ComplementoCampoTags} FROM $nombre_tabla_opciones WHERE $condicion_filtrado_listas");   //Deprecated.  ORDER BY $campo_opciones
                                    // Muestra resultados solo si $resultado_opciones es diferente de 1 que es el valor retornado cuando hay errores evitando el fatal error del fetch()
                                    while ($resultado_opciones!="1" && $registro_opciones = $resultado_opciones->fetch())
                                        {
                                            $opciones_lista[] = $registro_opciones["opciones"];
                                            $valores_lista[] = $registro_opciones["valores"];
                                            //Si tiene campo de tags los descompone y usa
                                            if ($ComplementoCampoTags!="")
                                                {
                                                    $CadenaTAGS=$registro_opciones["tags_extra"];
                                                    $tags_lista[] = $CadenaTAGS;
                                                }
                                            else
                                                {
                                                    $tags_lista[]="";
                                                }
                                        }
                                }
                            else
                                {
                                    //Solo si tiene datos intenta recuperar registros coincidentes
                                    if ($registro_datos_formulario["$nombre_campo"]!="")
                                        {
                                            $nombre_tabla_opciones = explode(".", $registro_campos["origen_lista_valores"]); //Usa el campo de valor de la lista que se asume es unico
                                            $nombre_tabla_opciones = $nombre_tabla_opciones[0];
                                            $campo_valores=$registro_campos["origen_lista_valores"];
                                            $campo_opciones=$registro_campos["origen_lista_opciones"];

                    						//Construye el comentento de la condicion para obtener como minimo aquellos registros seleccionados y no traer todos los datos
                                            $ComplementoValoresYaSeleccionados=" ( ";
                                            //$ComplementoValoresYaSeleccionados="  (documento='1128282578' OR documento='52,965,018' OR documento='71782341' OR documento='52305908' OR documento='55180918') AND ";  //,
                                            $ListaPosiblesValores=explode(",",$registro_datos_formulario["$nombre_campo"]);
                                            foreach ($ListaPosiblesValores as $PosibleValor)
                                                if (trim($PosibleValor)!="")
                                                    $ComplementoValoresYaSeleccionados.= " $campo_valores='$PosibleValor' OR ";
                                            $ComplementoValoresYaSeleccionados=substr($ComplementoValoresYaSeleccionados, 0, strlen($ComplementoValoresYaSeleccionados)-3);
                                            $ComplementoValoresYaSeleccionados.=" )  ";  //AND

                                            //Determina si la tabla en cuestion cuenta con el campo tags_extra.  Si es asi lo usa para generar lista de tags
                                            $ComplementoCampoTags="";
                                            if (PCO_ExisteCampoTabla("tags_extra",$nombre_tabla_opciones))
                                                $ComplementoCampoTags=", tags_extra as tags_extra ";

                                            // Consulta los campos para el tag select
                                            $resultado_opciones=PCO_EjecutarSQL("SELECT $campo_valores as valores, $campo_opciones as opciones {$ComplementoCampoTags} FROM $nombre_tabla_opciones WHERE $ComplementoValoresYaSeleccionados  ");  
                                            // Muestra resultados solo si $resultado_opciones es diferente de 1 que es el valor retornado cuando hay errores evitando el fatal error del fetch()
                                            while ($resultado_opciones!="1" && $registro_opciones = $resultado_opciones->fetch())
                                                {
                                                    $opciones_lista[] = $registro_opciones["opciones"];
                                                    $valores_lista[] = $registro_opciones["valores"];
                                                    //Si tiene campo de tags los descompone y usa
                                                    if ($ComplementoCampoTags!="")
                                                        {
                                                            $CadenaTAGS=$registro_opciones["tags_extra"];
                                                            $tags_lista[] = $CadenaTAGS;
                                                        }
                                                    else
                                                        {
                                                            $tags_lista[]="";
                                                        }
                                                }
                                        }
                                }
                        }

                for ($i=0;$i<count(@$opciones_lista);$i++)
                    {
                        // Determina si la opcion a agregar es la misma del valor del registro
                        $cadena_predeterminado='';
                        if ($valores_lista[$i]==@$cadena_valor)
                            $cadena_predeterminado=' SELECTED ';

                        //Determina si la opcion es una agrupadora o no
                        //Busca el valor de etiqueta para el grupo
                        $PartesOpcionCombo= explode ( "|" , $valores_lista[$i] );
                        if ( strpos ( $valores_lista[$i] , "_OPTGROUP_" ) !== FALSE )
                            if ( $PartesOpcionCombo[1]!="")
                                $salida.= "<optgroup ".$tags_lista[$i]." label='".PCO_ReemplazarVariablesPHPEnCadena($PartesOpcionCombo[1])."'>";
                            else
                                $salida.= "</optgroup>";  //Si no se encuentra valor de etiqueta alguno entonces cierra el grupo
                        else
                            $salida.= "<option ".$tags_lista[$i]." ".$CadenaAnchoOption." value='".PCO_ReemplazarVariablesPHPEnCadena($valores_lista[$i],$registro_datos_formulario)."' ".$cadena_predeterminado.">".PCO_ReemplazarVariablesPHPEnCadena($opciones_lista[$i],$registro_datos_formulario)."</option>";
                    }

            //Cierra DIV para cambio de opciones en caliente
            echo '</div>';

		$salida.= '</select>';

            //Si la lista tiene activada la recuperacion por AJAX mientras se escribe construye las variables y define funcion de recuperacion
            if ($registro_campos["ajax_busqueda_dinamica"]=="1")
                {
                    //Determina la tabla y campos desde los valores de lista definidos para usarlos como parametros en el AJAX
                    //Obtiene PCO_TablaConsulta
                    $TablaRecuperacionDinamica=explode(".",$registro_campos["origen_lista_opciones"]);
                    $TablaRecuperacionDinamica=$TablaRecuperacionDinamica[0];
                    //Obtiene PCO_ListaCamposRetorno (Campo de valor)
                    $CampoValorRecuperacionDinamica=explode(".",$registro_campos["origen_lista_valores"]);
                    $CampoValorRecuperacionDinamica=$CampoValorRecuperacionDinamica[1];
                    //Obtiene PCO_ListaCamposRetorno (Campo de texto)
                    $CampoBusquedaRecuperacionDinamica=explode(".",$registro_campos["origen_lista_opciones"]);
                    $CampoBusquedaRecuperacionDinamica=$CampoBusquedaRecuperacionDinamica[1];
                    //Obtiene la condicion de filtrado si aplica
                    $CondicionFiltradoConsulta=$registro_campos["condicion_filtrado_listas"];
                    if (trim($CondicionFiltradoConsulta)!="")
                        {
                            $CondicionFiltradoConsulta=" AND ".$CondicionFiltradoConsulta;
                            //Si encuentra comillas dobles las reemplaza por simples pues son las aceptadas en JS
                            $CondicionFiltradoConsulta=str_replace('"',"'",$CondicionFiltradoConsulta);
                            $CondicionFiltradoConsulta=PCO_ReemplazarVariablesPHPEnCadena($CondicionFiltradoConsulta,$registro_datos_formulario);
                        }
                    
                    echo '<script type="text/javascript">
                            var OrigenListaOpciones'.$registro_campos["id_html"].' = {
                              values: "a, b, c",
                              ajax: {
                                url: "index.php",
                                type: "POST",
                                dataType: "json",
                                // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will automatically replace it with the value of the search query.
                                data: {
                                  q: "{{{q}}}",
                                  PCO_Accion: "PCO_ObtenerOpcionesAjaxSelect",
                                  Presentar_FullScreen: "1",
                                  PCO_TablaConsulta: "'.$TablaRecuperacionDinamica.'",
                                  PCO_ListaCamposRetorno: "'.$CampoValorRecuperacionDinamica.','.$CampoBusquedaRecuperacionDinamica.'", //Campos en el siguiente orden: Valor, Texto o etiqueta, Subtexto, Icono tipo glyphicon
                                  PCO_ListaCamposBusqueda: "'.$CampoBusquedaRecuperacionDinamica.'",
                                  PCO_CondicionFiltrado: "'.$CondicionFiltradoConsulta.'"
                                }
                              },
                              minLength: 3,
                              locale: {
                                emptyTitle: "Seleccione y digite para buscar",
                                statusInitialized: "Empiece a digitar para recuperar registros",
                                statusSearching: "'.$MULTILANG_Cargando.'...",
                                currentlySelected: "Actualmente seleccionado(s):",
                                errorText: "No se pueden recuperar registros",
                                statusTooShort: "Ingrese al menos tres caracteres",
                                statusNoResults: "No se encuentran resultados",
                                searchPlaceholder: "'.$MULTILANG_Buscar.'..."
                              },
                              log: 0, //Nivel de console.log del combo
                              preprocessData: function(data) {
                                  //data=JSON.parse(data);
                                var i,
                                  l = data.length,
                                  array = [];
                                if (l) {
                                  for (i = 0; i < l; i++) {
                                    array.push(
                                      $.extend(true, data[i], {
                                        text: data[i].T,
                                        value: data[i].V,
                                        data: {
                                          subtext: data[i].S,
                                          icon:  data[i].I,
                                          //thumbnail: "pwa/launcher-icon-36.png"
                                        }
                                      })
                                    );
                                  }
                                }
                                // You must always return a valid array when processing data. The data argument passed is a clone and cannot be modified directly.
                                return array;
                              }
                            };

                            $( document ).ready(function() {
                                $("#'.$registro_campos["id_html"].'").selectpicker().filter(".with-ajax").ajaxSelectPicker(OrigenListaOpciones'.$registro_campos["id_html"].');
                                $("#'.$registro_campos["id_html"].'").trigger("change");
                            });
                            //  function chooseSelectpicker(index, selectpicker) {
                            //   $(selectpicker).val(index);
                            //   $(selectpicker).selectpicker("refresh");
                            //  }
                        </script>';
                }


		// Muestra boton de busqueda cuando el campo sea usado para esto
		if ($registro_campos["etiqueta_busqueda"]!="")
			{
                $salida.= '<span class="input-group-addon"><input type="Button" class="btn btn-default btn-xs" value="'.$registro_campos["etiqueta_busqueda"].'" onclick="document.'.$IdHTMLFormulario.'.PCO_ValorBusquedaBD.value=document.'.$IdHTMLFormulario.'.'.$registro_campos["campo"].'.value;document.'.$IdHTMLFormulario.'.PCO_Accion.value=\'PCO_CargarObjeto\';document.'.$IdHTMLFormulario.'.submit()"></span>';
				$salida.= '<input type="hidden" name="PCO_Objeto" value="frm:'.$formulario.'">';
				$salida.= '<input type="Hidden" name="en_ventana" value="'.$en_ventana.'" >';
				$salida.= '<input type="Hidden" name="PCO_CampoBusquedaBD" value="'.$registro_campos["campo"].'" >';
				$salida.= '<input type="Hidden" name="PCO_ValorBusquedaBD" '.$cadena_valor.'>';
			}

		//Si hay algun indicador adicional del campo abre los add-ons
        if ($registro_campos["ajax_busqueda"] == "1" || $registro_campos["valor_unico"] == "1" || $registro_campos["obligatorio"] || $registro_campos["ayuda_titulo"] != "")
            {
                $salida.= '<span class="input-group-addon">';
                // Muestra indicadores de obligatoriedad o ayuda
                //if ($registro_campos["ajax_busqueda"] == "1") $salida.= '<a class="btn btn-default btn-xs" href="javascript:PCO_ObtenerListaOpciones_'.$registro_campos["campo"].'();" title="'.$MULTILANG_Actualizar.'"><i class="fa fa-refresh icon-blue"></i></a>';
                if ($registro_campos["ajax_busqueda"] == "1") $salida.= '<a  data-toggle="tooltip" data-html="true"  data-placement="top" title="<b>'.$MULTILANG_FrmActualizaAjax.'</b>" class="btn btn-success btn-xs" href="javascript:PCO_ObtenerListaOpciones_'.$registro_campos["campo"].'();"><i class="fa fa-refresh"></i></a>&nbsp;&nbsp;&nbsp;';
                if ($registro_campos["valor_unico"] == "1") $salida.= '<a href="#"  data-toggle="tooltip" data-html="true"  data-placement="auto" title="<b>'.$MULTILANG_TitValorUnico.'</b><br>'.$MULTILANG_DesValorUnico.'"><i class="fa fa-key fa-flip-horizontal texto-rojo"></i></a>';
                if ($registro_campos["obligatorio"]) $salida.= '<a href="#"  data-toggle="tooltip" data-html="true"  data-placement="auto" title="<b>'.$MULTILANG_TitObligatorio.'</b><br>'.$MULTILANG_DesObligatorio.'"><i class="fa fa-exclamation-triangle icon-orange"></i></a>';
                if ($registro_campos["ayuda_titulo"] != "") $salida.= '<a href="#"  data-toggle="tooltip" data-html="true" data-placement="auto" title="<b>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_titulo"],$registro_datos_formulario).'</b><br>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_texto"],$registro_datos_formulario).'"><i class="fa fa-question-circle"></i></a>';
                $salida.= '</span>';
            }
        //Cierra marco del control de datos
        $salida.= '</div>';

        //Si es multiple carga sus valores indepediente si es delayed o no
        if (strstr($registro_campos["personalizacion_tag"],"multiple")!=FALSE)
            {
                //Evita la carga atrasada del valor de la lista cuando es multiple y su nombre EXISTE en base de datos
                if (PCO_ExisteCampoTabla($registro_campos["campo"],$RegistroDisenoFormulario["tabla_datos"]))
                    {
                        //$CadenaAsignacionMultiples="['".str_replace(',',"','",$cadena_valor)."']";
                        $PCO_ScriptsListaCombosPostCarga.='$("#'.$registro_campos["id_html"].'").val("'.$cadena_valor.'".split(",")); PCOJS_ActualizarComboBox("'.$registro_campos["id_html"].'");';
                        $PCO_ListaCombosMultiplesJoin.=$registro_campos["id_html"]."|";
                        //Agrega un campo hidden para el combo multiple para trasportar luego sus datos sanitizados.
        		        $salida.= '<input type=hidden value="'.$cadena_valor.'" id="PCO_ComboMultiple_'.$registro_campos["id_html"].'" name="PCO_ComboMultiple_'.$registro_campos["id_html"].'" >';
                    }
            }

        //Si es delayed porque el usuario asi lo quiere pero que no sea multiple, que por defecto ya es delayed
        if (strstr($registro_campos["personalizacion_tag"],"PCO_Delayed")!=FALSE ) // && strstr($registro_campos["personalizacion_tag"],"multiple")!=FALSE
            {
                if (!strstr($registro_campos["personalizacion_tag"],"multiple")!=FALSE)
                    $PCO_ScriptsListaCombosPostCarga.='$("#'.$registro_campos["id_html"].'").val("'.$cadena_valor.'"); PCOJS_ActualizarComboBox("'.$registro_campos["id_html"].'");';
            }

        //Mejora velocidad de carga para listas de seleccion
        $salida.= '<script type="text/javascript">$("#'.$registro_campos["id_html"].'").selectpicker("render");</script>';

		return $salida;
	}


########################################################################
########################################################################
/*
	Function: PCO_CargarObjetoEtiqueta
	Genera el codigo HTML y CSS correspondiente a un campo de etiqueta sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
function PCO_CargarObjetoEtiqueta($registro_campos,$registro_datos_formulario)
	{
		global $PCO_CampoBusquedaBD,$PCO_ValorBusquedaBD;
        $salida.= '<div id="'.$registro_campos["id_html"].'">';
		$salida.=PCO_ReemplazarVariablesPHPEnCadena($registro_campos["valor_etiqueta"],$registro_datos_formulario);
        $salida.= '</div>';
		return $salida;
	}


########################################################################
########################################################################
/*
	Function: PCO_CargarObjetoCampoEtiqueta
	Genera el codigo HTML para imprimir el valor de un campo directamente, sin control de datos.

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
function PCO_CargarObjetoCampoEtiqueta($registro_campos,$registro_datos_formulario)
	{
		global $PCO_CampoBusquedaBD,$PCO_ValorBusquedaBD;
		$salida="";
		// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
		$cadena_valor='';
		$Contenido_BARRAS='';
		$nombre_campo=$registro_campos["campo"];
		if ($registro_campos["valor_predeterminado"]!="") $cadena_valor=$registro_campos["valor_predeterminado"];
		//Evalua si el valor predeterminado tiene signo $ al comienzo y ademas es una variable definida para poner su valor.
		if (substr($registro_campos["valor_predeterminado"], 0,1)=="$")
			{
				$nombre_variable = substr($registro_campos["valor_predeterminado"], 1);
				global ${$nombre_variable};
				if (isset($nombre_variable))
					{
						$valor_variable=${$nombre_variable};
						$cadena_valor=$valor_variable;
					}
			}
		//Si viene de una busqueda de registro pone el valor de registro
		if ($PCO_CampoBusquedaBD!="" && $PCO_ValorBusquedaBD!="")
			{
				$cadena_valor=$registro_datos_formulario["$nombre_campo"];
				$Contenido_BARRAS=$cadena_valor; //En caso que se requiera para imprimir en formato especial
			}

		//Si el formato de salida es especial entonces muestra lo que corresponda
		if ($registro_campos["formato_salida"]!="")
			{
				$Tipo_BARRAS=$registro_campos["formato_salida"];

				//Establece tamanos de imagen segun tipo de grafico (codigo barras o datamatrix)
				if ($Tipo_BARRAS!="datamatrix")
					{
						$Ancho_BARRAS=$registro_campos["ancho"];
						//Si no se definio un ancho fijo entonces trata de calcularlo por la longitud del texto a mostrar
						if ($Ancho_BARRAS=="" || $Ancho_BARRAS=="0")
							$Ancho_BARRAS=110+strlen($Contenido_BARRAS)*10;
						$Alto_BARRAS=$registro_campos["alto"];
					}
				if ($Tipo_BARRAS=="datamatrix")
					{
						$Ancho_BARRAS=$registro_campos["ancho"];
						$Alto_BARRAS=$registro_campos["alto"];
					}

				//Si es un codigo desde la libreria de codigos de barras lo muestra, si es un QR usa la otra funcion
				if ($Tipo_BARRAS!="qrcode")
					$cadena_valor='<img src="core/codigobarras.php?Cadena='.$Contenido_BARRAS.'&Tipo='.$Tipo_BARRAS.'&AnchoCodigo=2&AltoCodigo='.($Alto_BARRAS-6).'&AnchoImagen='.$Ancho_BARRAS.'&AltoImagen='.$Alto_BARRAS.'" border=0>';
				else
					$cadena_valor=PCO_CodigoQR($Contenido_BARRAS);
			}

		//Identifica si el contenido es una imagen y agrega el tag para esta sino pone el contenido crudo
		if (substr ( $registro_datos_formulario["$nombre_campo"] , 0,10 )=="data:image")
		    {
		        $cadena_valor=$registro_datos_formulario["$nombre_campo"];
		        $cadena_valor="<img src='$cadena_valor' border=0 width=100%>";
		    }

		//$salida=$cadena_valor;
		//Agrega ademas el valor como hidden para disponer de el cuando se requiera en otro llamado o funcion personalizada
		$tipo_entrada="hidden";
		// Muestra el campo
		//$salida.='<input type="'.$tipo_entrada.'" name="'.$registro_campos["campo"].'" value="'.$cadena_valor.'" >';

        //Agrega marco bootstrap antes de devolver contenidos
		if ($registro_campos["ocultar_etiqueta"]=="0")
			$salida='<label for="'.$registro_campos["campo"].'">'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["titulo"],$registro_datos_formulario).':</label>';
        $salida.='<div id="'.$registro_campos["campo"].'">'.$cadena_valor.'</div>';
		return $salida;
	}


########################################################################
########################################################################
/*
	Function: PCO_CargarObjetoIFrame
	Genera el codigo HTML correspondiente a un campo de IFRAME para empotrar paginas externas sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
function PCO_CargarObjetoIFrame($registro_campos,$registro_datos_formulario)
	{
		global $PCO_CampoBusquedaBD,$PCO_ValorBusquedaBD;
		$salida='
        <div class="embed-responsive embed-responsive-4by3"  '.$registro_campos["personalizacion_tag"].' >
            <iframe id="'.$registro_campos["id_html"].'" name="'.$registro_campos["titulo"].'" src="'.$registro_campos["url_iframe"].'" width="'.$registro_campos["ancho"].'" height="'.$registro_campos["alto"].'" frameborder="0" marginheight="0" marginwidth="0">Cargando...</iframe>
        </div>';
		return $salida;
        /*
        ALTERNATIVA 1:
        <object data="http://www.web-source.net" width="600" height="400">
            <embed src="http://www.web-source.net" width="600" height="400"> </embed>
            Error: Embedded data could not be displayed.
        </object>

        ALTERNATIVA 2:
        <div id="divId"></div>
        <script type='text/javascript'>
            $(document).ready(function (){
                $('#divId').load(URL of target);
            });
        </script>

        ALTERNATIVA 3:
        $('#SampleElement').load('YourURL');
        */
	}


########################################################################
########################################################################
/*
	Function: PCO_CargarObjetoListaRadio
	Genera el codigo HTML y CSS correspondiente a los radio-button (Radio) vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
function PCO_CargarObjetoListaRadio($registro_campos,$registro_datos_formulario,$formulario,$en_ventana)
	{
		global $PCO_CampoBusquedaBD,$PCO_ValorBusquedaBD;
		global $MULTILANG_TitValorUnico,$MULTILANG_DesValorUnico,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio;
		global $TabIndex_Elemento;

		$salida='';
		$nombre_campo=$registro_campos["campo"];

		// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
		if ($PCO_CampoBusquedaBD!="" && $PCO_ValorBusquedaBD!="") $cadena_valor=$registro_datos_formulario["$nombre_campo"];

		// Toma los valores desde la lista de opciones (cuando es estatico)
		$opciones_lista = explode(",", $registro_campos["lista_opciones"]);
		$valores_lista = explode(",", $registro_campos["lista_opciones"]);

		//Elimina los elementos vacios de los arreglos
		$opciones_lista = array_filter($opciones_lista);
		$valores_lista = array_filter($valores_lista);

		// Si se desea tomar los valores del combo desde una tabla hace la consulta
		if ($registro_campos["origen_lista_opciones"]!="" && $registro_campos["origen_lista_valores"]!="")
			{
				$nombre_tabla_opciones = explode(".", $registro_campos["origen_lista_valores"]);
				$nombre_tabla_opciones = $nombre_tabla_opciones[0];
				$campo_valores=$registro_campos["origen_lista_valores"];
				$campo_opciones=$registro_campos["origen_lista_opciones"];
				//Define si los registros a mostrar en la lista deben estar filtrados por alguna condicion
				$condicion_filtrado_listas=$registro_campos["condicion_filtrado_listas"];
				if ($condicion_filtrado_listas=="")
					$condicion_filtrado_listas="1";
				else
					{
						//Mientras existan llaves abriendo y cerrando dentro de la condicion intenta establecer valor de variables
						$SalidaFiltradoBypass=0;
						while(strpos($condicion_filtrado_listas,"{")!==FALSE && strpos($condicion_filtrado_listas,"}")!==FALSE && $SalidaFiltradoBypass==0)
							{
								//Evalua casos donde se tienen variables PHP escapadas por llaves.  Ej  "%{$Variable}%" si fuera para un LIKE, por ejemplo o para una variable en un where  campo="{$Variable}"
								if (strpos($condicion_filtrado_listas,"{")!==FALSE && strpos($condicion_filtrado_listas,"}")!==FALSE)
									{
										//Determina las posiciones de las llaves en la cadena
										$PosLlaveIzquierda=strpos($condicion_filtrado_listas,"{");
										$PosLlaveDerecha=strpos($condicion_filtrado_listas,"}");
										//Toma solo el pedazo entre llaves para intentar ubicar el valor de la variable por su nombre
										$NombreVariable=substr($condicion_filtrado_listas,$PosLlaveIzquierda+2,$PosLlaveDerecha-$PosLlaveIzquierda-2);
										//Si la variable no esta definida la busca en el entorno global
										global ${$NombreVariable};
										if (@isset($NombreVariable))
											{
												$ValorVariable=${$NombreVariable};
												//Reemplaza el valor encontrado en la cadena de valor original
												$condicion_filtrado_listas=str_replace('{$'.$NombreVariable.'}',$ValorVariable,$condicion_filtrado_listas);
											}
										else
											{
												//Puede que no se logre reemplazar nada porque la variable no esta definida entonces sale por ByPass para evitar ciclo infinito
												$SalidaFiltradoBypass=1;
											}
									}
							}
					}
				// Consulta los campos para el tag select
				$resultado_opciones=PCO_EjecutarSQL("SELECT $campo_valores as valores, $campo_opciones as opciones FROM $nombre_tabla_opciones WHERE $condicion_filtrado_listas ORDER BY $campo_opciones");
				// Muestra resultados solo si $resultado_opciones es diferente de 1 que es el valor retornado cuando hay errores evitando el fatal error del fetch()
				while ($resultado_opciones!="1" && $registro_opciones = $resultado_opciones->fetch())
					{
						$opciones_lista[] = $registro_opciones["opciones"];
						$valores_lista[] = $registro_opciones["valores"];
					}
			}


        //Agrega etiqueta del campo si es diferente de vacio
		if ($registro_campos["titulo"]!="" && $registro_campos["ocultar_etiqueta"]=="0")
            $salida.='<label for="'.$registro_campos["campo"].'">'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["titulo"],$registro_datos_formulario).':</label>';
		//Abre el marco del control de datos
		$salida.='<div class="form-group input-group">';
		// Muestra el campo
		for ($i=0;$i<count($opciones_lista);$i++)
			{
				// Determina si la opcion a agregar es la misma del valor del registro
				$cadena_predeterminado='';
				if ($valores_lista[$i]==$cadena_valor)
					$cadena_predeterminado=' CHECKED ';
				$salida.= "<input tabindex='{$TabIndex_Elemento}' class='Radios' type='radio' name='".$registro_campos["campo"]."' value='".PCO_ReemplazarVariablesPHPEnCadena($valores_lista[$i],$registro_datos_formulario)."' ".$cadena_predeterminado." ".$registro_campos["personalizacion_tag"]." >".PCO_ReemplazarVariablesPHPEnCadena($opciones_lista[$i],$registro_datos_formulario)."<br>";
			}
		//Si hay algun indicador adicional del campo abre los add-ons
        if ($registro_campos["valor_unico"] == "1" || $registro_campos["obligatorio"] || $registro_campos["ayuda_titulo"] != "")
            {
                $salida.= '<span class="input-group-addon">';
                // Muestra indicadores de obligatoriedad o ayuda
                if ($registro_campos["valor_unico"] == "1") $salida.= '<a href="#"   data-toggle="tooltip" data-html="true"  data-placement="auto" title="<b>'.$MULTILANG_TitValorUnico.'</b><br>'.$MULTILANG_DesValorUnico.'"><i class="fa fa-key fa-flip-horizontal texto-rojo"></i></a>';
                if ($registro_campos["obligatorio"]) $salida.= '<a href="#"   data-toggle="tooltip" data-html="true"  data-placement="auto" title="<b>'.$MULTILANG_TitObligatorio.'</b><br>'.$MULTILANG_DesObligatorio.'"><i class="fa fa-exclamation-triangle icon-orange"></i></a>';
                if ($registro_campos["ayuda_titulo"] != "") $salida.= '<a href="#"   data-toggle="tooltip" data-html="true"  data-placement="auto" title="<b>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_titulo"],$registro_datos_formulario).'</b><br>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_texto"],$registro_datos_formulario).'"><i class="fa fa-question-circle"></i></a>';
                $salida.= '</span>';
            }
        //Cierra marco del control de datos
        $salida.= '</div>';
		return $salida;
	}


########################################################################
########################################################################
/*
	Function: PCO_CargarObjetoCasillaCheck
	Genera el codigo HTML y CSS correspondiente a una casilla de verificacion (checkbox) vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos
		formulario - ID unico del formulario al cual pertenece el objeto

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
function PCO_CargarObjetoCasillaCheck($registro_campos,$registro_datos_formulario,$formulario,$en_ventana)
	{
		global $TablasCore,$PCO_CampoBusquedaBD,$PCO_ValorBusquedaBD,$IdiomaPredeterminado;
        global $funciones_activacion_datepickers;
		global $MULTILANG_TitValorUnico,$MULTILANG_DesValorUnico,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio;
		global $TabIndex_Elemento;

        //Busca datos del formulario
        $RegistroDisenoFormulario=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."formulario WHERE id=?", "$formulario")->fetch();
        $IdHTMLFormulario=$RegistroDisenoFormulario["id_html"];

		$salida='';
		$nombre_campo=$registro_campos["campo"];

		// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
		$cadena_valor='';


		//Toma el valor predeterminado y lo asigna
		$cadena_valor_almacenada=$registro_campos["valor_predeterminado"];
		//Si el valor predeterminado es el mismo de valor check activo entonces activa el control
		if ($registro_campos["valor_predeterminado"]==$registro_campos["valor_check_activo"])
			$cadena_valor="checked";

		//Reemplaza el valor del campo en caso de tener alguno viniendo del registro
		$nombre_campo=$registro_campos["campo"];
		$valor_de_registro=$registro_datos_formulario["$nombre_campo"];
		if ($valor_de_registro!="")
			{
				$cadena_valor_almacenada=$valor_de_registro;
				//Si el valor de registro es el asociado al valor de activo entonces activa el control, sino lo desactiva
				if ($valor_de_registro==$registro_campos["valor_check_activo"])
					$cadena_valor="checked";
				else
					$cadena_valor="";
			}

        //Define si el control tiene o no textos de ayuda
        $salida_ayuda_check='';
        if ($registro_campos["ayuda_titulo"] != "") $salida_ayuda_check = '<a href="#"  data-toggle="tooltip" data-html="true" data-placement="auto" title="<b>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_titulo"],$registro_datos_formulario).'</b><br>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_texto"],$registro_datos_formulario).'"><i class="fa fa-question-circle"></i></a>';


        // Muestra el campo
        $CadenaEtiquetaCheck=PCO_ReemplazarVariablesPHPEnCadena($registro_campos["titulo"],$registro_datos_formulario);
        if($registro_campos["ocultar_etiqueta"]=="1") $CadenaEtiquetaCheck="";

        $salida.= '
			<input type="hidden" id="'.$registro_campos["campo"].'" name="'.$registro_campos["campo"].'" value="'.$cadena_valor_almacenada.'">
			<div class="checkbox">
				<label>
					<input tabindex="'.$TabIndex_Elemento.'" onchange="JSFUNC_Actualizar_'.$registro_campos["campo"].'(this);" type="checkbox" id="JSVAR_'.$registro_campos["campo"].'" name="JSVAR_'.$registro_campos["campo"].'" '.$cadena_valor.' '.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["personalizacion_tag"],$registro_datos_formulario).' > '.$CadenaEtiquetaCheck.' '.$salida_ayuda_check.'
				</label>
			</div>
			<script language="JavaScript">
				function JSFUNC_Actualizar_'.$registro_campos["campo"].'(objeto_checkbox)
					{
						//Si es marcado asigna el valor, sino asigna el otro
						if (objeto_checkbox.checked)
							document.'.$IdHTMLFormulario.'.'.$registro_campos["campo"].'.value="'.$registro_campos["valor_check_activo"].'";
						else
							document.'.$IdHTMLFormulario.'.'.$registro_campos["campo"].'.value="'.$registro_campos["valor_check_inactivo"].'";
					}
			</script>
        ';
		return $salida;
	}


########################################################################
########################################################################
/*
	Function: PCO_CargarObjetoDeslizador
	Genera el codigo HTML y CSS correspondiente a un campo tipo range de HTML5 vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
function PCO_CargarObjetoDeslizador($registro_campos,$registro_datos_formulario)
	{
		global $PCO_CampoBusquedaBD,$PCO_ValorBusquedaBD,$funciones_activacion_sliders;
		global $MULTILANG_TitValorUnico,$MULTILANG_DesValorUnico,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio;
		global $TabIndex_Elemento;

		$salida='';
		$nombre_campo=$registro_campos["campo"];

		// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
		$cadena_valor='';
        $valor_de_campo="0";
        // Si tiene valor predeterminado se asume
		if ($registro_campos["valor_predeterminado"]!="") $valor_de_campo=$registro_campos["valor_predeterminado"];
		// toma el valor predeterminado como el minimo (formulario de registro nuevo) en caso de no tener un predeterminado
        if ($registro_campos["valor_predeterminado"]=="") $valor_de_campo=$registro_campos["valor_minimo"];
		// Busca el valor segun registro en caso de recibir un registro recuperado
		if ($PCO_CampoBusquedaBD!="" && $PCO_ValorBusquedaBD!="")
			$valor_de_campo=$registro_datos_formulario["$nombre_campo"];
		$cadena_valor=' data-slider-value="'.$valor_de_campo.'" value="'.$valor_de_campo.'" ';

        //Agrega etiqueta del campo si es diferente de vacio
		if ($registro_campos["titulo"]!="" && $registro_campos["ocultar_etiqueta"]=="0")
            $salida.='<label for="'.$registro_campos["campo"].'">'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["titulo"],$registro_datos_formulario).':</label>';
		//Abre el marco del control de datos
		$salida.='<div class="form-group input-group">';
		// Muestra el campo
        $salida.= '<input tabindex="'.$TabIndex_Elemento.'" class="span2" type="text" id="'.$registro_campos["id_html"].'" name="'.$registro_campos["campo"].'" data-slider-min="'.$registro_campos["valor_minimo"].'" data-slider-max="'.$registro_campos["valor_maximo"].'" data-slider-step="'.$registro_campos["valor_salto"].'" '.$cadena_valor.' '.$registro_campos["personalizacion_tag"].' >';
        //  data-slider-selection="after" data-slider-tooltip="hide">

        //Guarda la funcion para activar el slider posterior a su carga
        @$funciones_activacion_sliders.="
                $(function(){
                    window.prettyPrint && prettyPrint();
                $('#".$registro_campos["campo"]."').slider({
                  formater: function(value) {
                    return 'Valor: '+value;
                  }
                });
            });";

		//Si hay algun indicador adicional del campo abre los add-ons
        if ($registro_campos["valor_unico"] == "1" || $registro_campos["obligatorio"] || $registro_campos["ayuda_titulo"] != "")
            {
                $salida.= '<span class="input-group-addon">';
                // Muestra indicadores de obligatoriedad o ayuda
                if ($registro_campos["obligatorio"]) $salida.= '<a href="#"   data-toggle="tooltip" data-html="true"  data-placement="auto" title="<b>'.$MULTILANG_TitObligatorio.'</b><br>'.$MULTILANG_DesObligatorio.'"><i class="fa fa-exclamation-triangle icon-orange"></i></a>';
                if ($registro_campos["ayuda_titulo"] != "") $salida.= '<a href="#"   data-toggle="tooltip" data-html="true"  data-placement="auto" title="<b>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_titulo"],$registro_datos_formulario).'</b><br>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_texto"],$registro_datos_formulario).'"><i class="fa fa-question-circle"></i></a>';
                $salida.= '</span>';
            }
        //Cierra marco del control de datos
        $salida.= '</div>';
		return $salida;
	}


########################################################################
########################################################################
/*
	Function: PCO_CargarObjetoArchivoAdjunto
	Genera el codigo HTML y CSS correspondiente a un campo de archivo (file) vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
function PCO_CargarObjetoArchivoAdjunto($registro_campos,$registro_datos_formulario)
	{
		global $PCO_CampoBusquedaBD,$PCO_ValorBusquedaBD;
		global $MULTILANG_TitValorUnico,$MULTILANG_DesValorUnico,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio,$MULTILANG_FrmArchivoLink,$MULTILANG_Tipo;
		global $TabIndex_Elemento;

		$salida='';
		$nombre_campo=$registro_campos["campo"];
		$tipo_entrada="file";

		// Especifica longitud visual de campo en caso de haber sido definida
		$cadena_longitud_visual=' size="20" ';
		if ($registro_campos["ancho"]!="0")
			$cadena_longitud_visual=' size="'.$registro_campos["ancho"].'" ';

		// Especifica longitud maxima de caracteres en caso de haber sido definida
		$cadena_longitud_permitida=' ';
		if ($registro_campos["maxima_longitud"]!=0)
			$cadena_longitud_permitida=' maxlength="'.$registro_campos["maxima_longitud"].'" ';

		// Define cadena en caso de tener valor predeterminado o el valor tomado desde el registro buscado
		$cadena_valor='';
		if ($registro_campos["valor_predeterminado"]!="") $cadena_valor=' value="'.$registro_campos["valor_predeterminado"].'" ';
		//Evalua si el valor predeterminado tiene signo $ al comienzo y ademas es una variable definida para poner su valor.
		if (substr($registro_campos["valor_predeterminado"], 0,1)=="$")
			{
				$nombre_variable = substr($registro_campos["valor_predeterminado"], 1);
				global ${$nombre_variable};
				if (isset($nombre_variable))
					{
						$valor_variable=${$nombre_variable};
						$cadena_valor=' value="'.$valor_variable.'" ';
					}
			}

		// Si detecta un path de archivo en el registro entonces agrega el enlace
		$partes_adjunto_archivo=explode("|",$registro_datos_formulario["$nombre_campo"]);
		$adjunto_url_archivo=$partes_adjunto_archivo[0];
		$adjunto_tipo_archivo=$partes_adjunto_archivo[1];
		if ($PCO_CampoBusquedaBD!="" && $PCO_ValorBusquedaBD!="" && $registro_datos_formulario["$nombre_campo"]!="")
			$salida.='<a target="_BLANK" id="PCO_EnlaceAdjunto_'.$registro_campos["id_html"].'" href="'.$adjunto_url_archivo.'"><i class="fa fa-search"></i><b>'.$MULTILANG_FrmArchivoLink.'</b><i class="fa fa-floppy-o fa-fw"></i></a><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>('.$MULTILANG_Tipo.': '.$adjunto_tipo_archivo.')</i><br>';

        //Agrega etiqueta del campo si es diferente de vacio
		if ($registro_campos["titulo"]!="" && $registro_campos["ocultar_etiqueta"]=="0")
            $salida.='<label for="'.$registro_campos["campo"].'">'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["titulo"],$registro_datos_formulario).':</label>';
		//Abre el marco del control de datos
		$salida.='<div class="form-group input-group">';
		// Muestra el campo
		$salida.='<input tabindex="'.$TabIndex_Elemento.'" type="'.$tipo_entrada.'" id="'.$registro_campos["id_html"].'" name="'.$registro_campos["campo"].'" '.$cadena_valor.' '.$cadena_longitud_visual.' '.$cadena_longitud_permitida.' class="form-control btn-default" '.$cadena_validacion.' '.$registro_campos["solo_lectura"].' '.$registro_campos["personalizacion_tag"].' >';

		//Si hay algun indicador adicional del campo abre los add-ons
        if ($registro_campos["valor_unico"] == "1" || $registro_campos["obligatorio"] || $registro_campos["ayuda_titulo"] != "")
            {
                $salida.= '<span class="input-group-addon">';
                // Muestra indicadores de obligatoriedad o ayuda
                if ($registro_campos["obligatorio"]) $salida.= '<a href="#"   data-toggle="tooltip" data-html="true"  data-placement="auto" title="<b>'.$MULTILANG_TitObligatorio.'</b><br>'.$MULTILANG_DesObligatorio.'"><i class="fa fa-exclamation-triangle icon-orange"></i></a>';
                if ($registro_campos["ayuda_titulo"] != "") $salida.= '<a href="#"   data-toggle="tooltip" data-html="true"  data-placement="auto" title="<b>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_titulo"],$registro_datos_formulario).'</b><br>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_texto"],$registro_datos_formulario).'"><i class="fa fa-question-circle"></i></a>';
                $salida.= '</span>';
            }
        //Cierra marco del control de datos
        $salida.= '</div>';
		return $salida;
	}


########################################################################
########################################################################
/*
	Function: PCO_CargarObjetoCanvas
	Genera el codigo HTML y CSS correspondiente a un campo de canvas vinculado a un campo de datos sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
function PCO_CargarObjetoCanvas($registro_campos,$registro_datos_formulario,$formulario)
	{
		global $PCO_CampoBusquedaBD,$PCO_ValorBusquedaBD,$TablasCore;
		global $MULTILANG_Cerrar,$MULTILANG_FrmCanvasLink,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio;
        global $funciones_activacion_canvas;

        //Busca datos del formulario
        $RegistroDisenoFormulario=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."formulario WHERE id=?", "$formulario")->fetch();
        $IdHTMLFormulario=$RegistroDisenoFormulario["id_html"];

		$salida='';
		$nombre_campo=$registro_campos["campo"];

		// Si detecta un valor en el registro entonces agrega el contenido
		if ($PCO_CampoBusquedaBD!="" && $PCO_ValorBusquedaBD!="" && $registro_datos_formulario["$nombre_campo"]!="")
			{
				$cadena_decodificada=$registro_datos_formulario["$nombre_campo"];
				//$cadena_decodificada=gzdecode($cadena_decodificada);
				$salida.='
				<a href="javascript:CargarImagenCANVAS_'.$registro_campos["id_html"].'();"><i class="fa fa-picture-o"></i><b>'.$MULTILANG_FrmCanvasLink.'</b></a><br>
					<script language="JavaScript">
					    function CargarImagenCANVAS_'.$registro_campos["id_html"].'()
					        {
                                PCOJS_MostrarMensaje("'.$MULTILANG_FrmCanvasLink.'","Cargando...","modal-wide");
                                $("#PCO_Modal_MensajeCuerpo").html(\'<img src="'.$cadena_decodificada.'" border=1>\');
					        }
					</script>';
			}

				$salida.='
					<script language="JavaScript">
                        // returns true if all color channels in each pixel are 0 (or "blank")
                        function isCanvasBlank(canvas) {
                          return !canvas.getContext("2d")
                            .getImageData(0, 0, canvas.width, canvas.height).data
                            .some(channel => channel !== 0);
                        }


                        function RedimensionarCanvas(canvas,PorcentajeAncho,PorcentajeAlto){
                          var tempCanvas = canvas.ownerDocument.createElement("canvas");
                          var tctx=tempCanvas.getContext("2d");
                          var cw=canvas.width;
                          var ch=canvas.height;
                          tempCanvas.width=cw;
                          tempCanvas.height=ch;
                          tctx.drawImage(canvas,0,0);
                          canvas.width*=PorcentajeAncho;
                          canvas.height*=PorcentajeAlto;
                          var ctx=canvas.getContext("2d");
                          ctx.drawImage(tempCanvas,0,0,cw,ch,0,0,cw*PorcentajeAncho,ch*PorcentajeAlto);
                        }

                        var RecortarCANVAS_'.$registro_campos["id_html"].' = (function() {
                            function rowBlank(imageData, width, y) {
                                for (var x = 0; x < width; ++x) {
                                    if (imageData.data[y * width * 4 + x * 4 + 3] !== 0) return false;
                                }
                                return true;
                            }
                        
                            function columnBlank(imageData, width, x, top, bottom) {
                                for (var y = top; y < bottom; ++y) {
                                    if (imageData.data[y * width * 4 + x * 4 + 3] !== 0) return false;
                                }
                                return true;
                            }
                        
                            return function(canvas) {
                                var ctx = canvas.getContext("2d");
                                var width = canvas.width;
                                var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                                var top = 0, bottom = imageData.height, left = 0, right = imageData.width;
                        
                                while (top < bottom && rowBlank(imageData, width, top)) ++top;
                                while (bottom - 1 > top && rowBlank(imageData, width, bottom - 1)) --bottom;
                                while (left < right && columnBlank(imageData, width, left, top, bottom)) ++left;
                                while (right - 1 > left && columnBlank(imageData, width, right - 1, top, bottom)) --right;
                        
                                var trimmed = ctx.getImageData(left, top, right - left, bottom - top);
                                var copy = canvas.ownerDocument.createElement("canvas");
                                var copyCtx = copy.getContext("2d");
                                copy.width = trimmed.width;
                                copy.height = trimmed.height;
                                copyCtx.putImageData(trimmed, 0, 0);
                        
                                return copy;
                            };
                        })();
					</script>';


        //Agrega etiqueta del campo si es diferente de vacio
		if ($registro_campos["titulo"]!="" && $registro_campos["ocultar_etiqueta"]=="0")
            $salida.='<label for="'.$registro_campos["campo"].'">'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["titulo"],$registro_datos_formulario).':</label>';
		//Abre el marco del control de datos
		$salida.='<div class="form-group input-group" style="display: block !important; ">';
		
		//Verifica si el ancho o el alto tienen alguna barra de proporcion indicando porcentaje final de escalado
		$PartesAncho=explode("|",$registro_campos["ancho"]);
		$AnchoCanvas=$PartesAncho[0]; //Toma el ancho inicial del canvas
		$ProporcionFinalAnchoCanvas=$PartesAncho[1]; if ($ProporcionFinalAnchoCanvas=="") $ProporcionFinalAnchoCanvas=1; //Define Proporcion final (0.5,2,1.5,etc)
		$PartesAlto=explode("|",$registro_campos["alto"]);
		$AltoCanvas=$PartesAlto[0]; //Toma el ancho inicial del canvas
		$ProporcionFinalAltoCanvas=$PartesAlto[1]; if ($ProporcionFinalAltoCanvas=="") $ProporcionFinalAltoCanvas=1; //Define Proporcion final (0.5,2,1.5,etc)

		// Muestra el campo
		$salida.='<canvas id="CANVAS_'.$registro_campos["campo"].'" width="'.$AnchoCanvas.'" height="'.$AltoCanvas.'" style="border: 1px solid #acc; display: inline;">Su navegador no soporta Canvas</canvas>
			<a href="javascript:limpiar_CANVAS_'.$registro_campos["campo"].'();"><i class="fa fa-times fa-2x"></i></a>

			<script type="text/javascript">';

        //Prepara la funcion de reactivacion del canvas para el final del script
        $funciones_activacion_canvas.='
                $(function ()
					{
						$(\'#CANVAS_'.$registro_campos["campo"].'\').sketch({defaultColor: "'.$registro_campos["color_trazo"].'", defaultSize: "'.$registro_campos["tamano_pincel"].'"});
					});';

        $salida.='
				/*
				// Genera el vinculo entre el enlace de upload y la funcion
				$("#upload").on("click", function ()
					{
						var oCanvas = document.getElementById("CANVAS_'.$registro_campos["campo"].'");
						var strDataURI = oCanvas.toDataURL();
						//alert(strDataURI); //Muestra el resultado en base64
					});
				*/

				function limpiar_CANVAS_'.$registro_campos["campo"].'()
					{
						// Busca el contexto del canvas y le reasigna ancho y alto para limpiarlo
						var oCanvas = document.getElementById("CANVAS_'.$registro_campos["campo"].'");
						var oContext = oCanvas.getContext("2d");
						//FORMA1:
							oContext.clearRect(0, 0, oCanvas.width, oCanvas.height);
						/*//FORMA2:
							oCanvas.width = oCanvas.width;*/
						/*//FORMA3:
							oContext.save();
							oContext.fillStyle = "#FFF";
							oContext.fillRect(0, 0, oCanvas.width, oCanvas.height);
							oContext.restore();
							oCanvas.clear();*/
						/*//FORMA4:
							var ancho_anterior = oCanvas.width;
							oCanvas.width = 1;
							oCanvas.width = ancho_anterior;*/
					}

				function actualizar_CANVAS_'.$registro_campos["campo"].'()
					{
						// Pasa el valor del canvas al campo que se usa en almacenamiento
						if (!isCanvasBlank(CANVAS_'.$registro_campos["campo"].'))
						    {
                				oCanvas=RecortarCANVAS_'.$registro_campos["campo"].'(CANVAS_'.$registro_campos["campo"].');
                				//document.'.$IdHTMLFormulario.'.'.$registro_campos["campo"].'.value=oCanvas.toDataURL();	 //Almacena imagen al 100%

                                //Redimensiona el canvas sobre otro (Si aplica)
                                RedimensionarCanvas(oCanvas,'.$ProporcionFinalAnchoCanvas.','.$ProporcionFinalAltoCanvas.');
                				document.'.$IdHTMLFormulario.'.'.$registro_campos["campo"].'.value=oCanvas.toDataURL();	     //Almacena imagen redimensionada
						    }
						window.setTimeout("actualizar_CANVAS_'.$registro_campos["campo"].'()",1000);
					}

				$( document ).ready(function() {
				    actualizar_CANVAS_'.$registro_campos["campo"].'();
				});
			</script>
			<input type="hidden" name="'.$registro_campos["campo"].'">';

		//Si hay algun indicador adicional del campo abre los add-ons
        if ($registro_campos["valor_unico"] == "1" || $registro_campos["obligatorio"] || $registro_campos["ayuda_titulo"] != "")
            {
                $salida.= '<span class="input-group-addon">';
                // Muestra indicadores de obligatoriedad o ayuda
                if ($registro_campos["obligatorio"]) $salida.= '<a href="#"   data-toggle="tooltip" data-html="true"  data-placement="auto" title="<b>'.$MULTILANG_TitObligatorio.'</b><br>'.$MULTILANG_DesObligatorio.'"><i class="fa fa-exclamation-triangle icon-orange"></i></a>';
                if ($registro_campos["ayuda_titulo"] != "") $salida.= '<a href="#"   data-toggle="tooltip" data-html="true"  data-placement="auto" title="<b>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_titulo"],$registro_datos_formulario).'</b><br>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_texto"],$registro_datos_formulario).'"><i class="fa fa-question-circle"></i></a>';
                $salida.= '</span>';
            }
        //Cierra marco del control de datos
        $salida.= '</div>';
		return $salida;
	}


########################################################################
########################################################################
/*
	Function: PCO_CargarObjetoCamara
	Genera el codigo HTML y CSS correspondiente a un campo de canvas usado para la captura de una imagen desde webcam

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
function PCO_CargarObjetoCamara($registro_campos,$registro_datos_formulario,$formulario)
	{
		global $TablasCore,$PCO_CampoBusquedaBD,$PCO_ValorBusquedaBD;
		global $MULTILANG_Cerrar,$MULTILANG_FrmCanvasLink,$MULTILANG_Capturar,$MULTILANG_FrmErrorCam,$MULTILANG_DesObligatorio,$MULTILANG_TitObligatorio;

        //Busca datos del formulario
        $RegistroDisenoFormulario=PCO_EjecutarSQL("SELECT * FROM ".$TablasCore."formulario WHERE id=?", "$formulario")->fetch();
        $IdHTMLFormulario=$RegistroDisenoFormulario["id_html"];

		$salida='';
		$nombre_campo=$registro_campos["campo"];

		// Si detecta un valor en el registro entonces agrega el contenido
		if ($PCO_CampoBusquedaBD!="" && $PCO_ValorBusquedaBD!="" && $registro_datos_formulario["$nombre_campo"]!="")
			{
				$cadena_decodificada=$registro_datos_formulario["$nombre_campo"];
				$cadena_decodificada=gzdecode($cadena_decodificada);
				$salida.='<a href="javascript:AbrirPopUp(\'CANVASPrevio'.$registro_campos["campo"].'\');"><i class="fa fa-picture-o"></i><b>'.$MULTILANG_FrmCanvasLink.'</b></a><br>
					<!-- INICIO DE MARCOS POPUP -->
					<div id="CANVASPrevio'.$registro_campos["campo"].'" class="FormularioPopUps">
						<div align=center>
							<table bgcolor="#FFFFFF"><tr><td>
								<img src="'.$cadena_decodificada.'" border=1>
							</td></tr></table>
						</br>
						<input type="Button"  class="Botones" value=" -- '.$MULTILANG_Cerrar.' -- " onClick="OcultarPopUp(\'CANVASPrevio'.$registro_campos["campo"].'\')">
						</div>
					<!-- FIN DE MARCOS POPUP -->
					</div>';
			}

		// Muestra el campo
		$escala_reduccion=1;
        //Agrega etiqueta del campo si es diferente de vacio
		if ($registro_campos["titulo"]!="" && $registro_campos["ocultar_etiqueta"]=="0")
            $salida.='<label for="'.$registro_campos["campo"].'">'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["titulo"],$registro_datos_formulario).':</label>';
		//Abre el marco del control de datos
		$salida.='<div class="form-group input-group">';

		$salida.='
			<table border=0>
				<tr>
					<td valign=top>
						<div id="container" style="margin: 0px auto; width: '.$registro_campos["ancho"].'px; height: '.$registro_campos["alto"].'px; border: 1px solid #acc;">
							<video autoplay id="videoElement"  style="width: '.$registro_campos["ancho"].'px; height: '.$registro_campos["alto"].'px;">
							</video>
						</div>
					</td>
					<td valign=top>
                        <i class="fa fa-camera" OnClick="draw(v,context,w,h);"></i>
						<br>
						<canvas id="CANVAS_'.$registro_campos["campo"].'" width="'.(($registro_campos["ancho"]/$escala_reduccion)).'" height="'.(($registro_campos["alto"]/$escala_reduccion)).'" style="width: '.(($registro_campos["ancho"]/$escala_reduccion)).'px; height: '.(($registro_campos["alto"]/$escala_reduccion)).'px; background-color: #CCC; visibility:visible;"></canvas>
					</td>
				</tr>
			</table>

			<script>
				var video = document.querySelector("#videoElement");
				navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

				if (navigator.getUserMedia) {
					navigator.getUserMedia({video: true}, handleVideo, videoError);
				}

				function handleVideo(stream) {
					video.src = window.URL.createObjectURL(stream);
				}

				function videoError(e) {
					alert("'.$MULTILANG_FrmErrorCam.'");
				}

				var v,CANVAS_'.$registro_campos["campo"].',context,w,h;
				var sel = document.getElementById(\'fileselect\');

				document.addEventListener(\'DOMContentLoaded\', function(){
				v = document.getElementById(\'videoElement\');
				CANVAS_'.$registro_campos["campo"].' = document.getElementById(\'CANVAS_'.$registro_campos["campo"].'\');
				context = CANVAS_'.$registro_campos["campo"].'.getContext(\'2d\');
				w = CANVAS_'.$registro_campos["campo"].'.width;
				h = CANVAS_'.$registro_campos["campo"].'.height;
				},false);

				function draw(v,c,w,h) {
				if(v.paused || v.ended) return false;
				context.drawImage(v,0,0,w,h);
				var uri = CANVAS_'.$registro_campos["campo"].'.toDataURL("image/png");
				}

				var fr;
				sel.addEventListener(\'change\',function(e){
				var f = sel.files[0];
				fr = new FileReader();
				fr.readAsDataURL(f);
				})
			</script>';

		$salida.='
			<script>
				function actualizar_CANVAS_'.$registro_campos["campo"].'()
					{
						// Pasa el valor del canvas al campo que se usa en almacenamiento
						var oCanvas = document.getElementById("CANVAS_'.$registro_campos["campo"].'");
						var strDataURI = oCanvas.toDataURL();
						document.'.$IdHTMLFormulario.'.'.$registro_campos["campo"].'.value=strDataURI;
						window.setTimeout("actualizar_CANVAS_'.$registro_campos["campo"].'()",1000);
					}
				window.setTimeout("actualizar_CANVAS_'.$registro_campos["campo"].'()",1000);
			</script>
			<input type="hidden" name="'.$registro_campos["campo"].'">';
		//Si hay algun indicador adicional del campo abre los add-ons
        if ($registro_campos["valor_unico"] == "1" || $registro_campos["obligatorio"] || $registro_campos["ayuda_titulo"] != "")
            {
                $salida.= '<span class="input-group-addon">';
                // Muestra indicadores de obligatoriedad o ayuda
                if ($registro_campos["obligatorio"]) $salida.= '<a href="#"   data-toggle="tooltip" data-html="true"  data-placement="auto" title="<b>'.$MULTILANG_TitObligatorio.'</b><br>'.$MULTILANG_DesObligatorio.'"><i class="fa fa-exclamation-triangle icon-orange"></i></a>';
                if ($registro_campos["ayuda_titulo"] != "") $salida.= '<a href="#"   data-toggle="tooltip" data-html="true"  data-placement="auto" title="<b>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_titulo"],$registro_datos_formulario).'</b><br>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["ayuda_texto"],$registro_datos_formulario).'"><i class="fa fa-question-circle"></i></a>';
                $salida.= '</span>';
            }
        //Cierra marco del control de datos
        $salida.= '</div>';




		$salidaNuevo='';
        $salidaNuevo.='
			<table border=0>
				<tr>
					<td valign=top>
						<div id="container" style="margin: 0px auto; width: '.$registro_campos["ancho"].'px; height: '.$registro_campos["alto"].'px; border: 1px solid #acc;">
							<video id="PCO_WebCam_'.$registro_campos["campo"].'" playsinline autoplay style="width: '.$registro_campos["ancho"].'px; height: '.$registro_campos["alto"].'px;"></video>
						    <div id="CANVAS_ErrorMsg'.$registro_campos["campo"].'"></div>
						</div>
					</td>
					<td valign=top>
                        <i id="BotonCaptura_CANVAS_'.$registro_campos["campo"].'" class="fa fa-camera" OnClick="var context = canvas.getContext(\'2d\'); context.drawImage(videoPCO_WebCam_'.$registro_campos["campo"].', 0, 0, '.$registro_campos["ancho"].', '.$registro_campos["alto"].');"></i>
						<br>
						<canvas id="CANVAS_'.$registro_campos["campo"].'" width="'.(($registro_campos["ancho"])).'" height="'.(($registro_campos["alto"])).'" style="width: '.(($registro_campos["ancho"])).'px; height: '.(($registro_campos["alto"])).'px; background-color: #CCC; visibility:visible;"></canvas>
					</td>
				</tr>
			</table>

			<script language="JavaScript">
                \'use strict\';
                
                const videoPCO_WebCam_'.$registro_campos["campo"].' = document.getElementById("PCO_WebCam_'.$registro_campos["campo"].'");
                const canvas = document.getElementById("CANVAS_'.$registro_campos["campo"].'");
                const snap = document.getElementById("snap");
                const errorMsgElement = document.querySelector("errorMsg");
                
                const constraints = {
                  audio: true,
                  video: {
                    width: '.$registro_campos["ancho"].', height: '.$registro_campos["alto"].'
                  }
                };
                
                // Access webcam
                async function init() {
                  try {
                    const stream = await navigator.mediaDevices.getUserMedia(constraints);
                    handleSuccess(stream);
                  } catch (e) {
                    $("#CANVAS_ErrorMsg'.$registro_campos["campo"].'").html("<b>Error Camara</b><br> "+"navigator.getUserMedia error:"+e.toString());
                  }
                }
                
                // Success
                function handleSuccess(stream) {
                  window.stream = stream;
                  videoPCO_WebCam_'.$registro_campos["campo"].'.srcObject = stream;
                }
                
                // Load init
                init();
			</script>';

        $salida = $salidaNuevo;





		return $salida;
	}


########################################################################
########################################################################
/*
	Function: PCO_CargarObjetoBotonComando
	Genera el codigo HTML y CSS correspondiente a un boton de comando sobre un formulario

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		registro_datos_formulario - Arreglo asociativo con nombres de campo y valores cuando se hacen llamados de registro especificos
		formulario - ID unico del formulario al cual pertenece el objeto

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
function PCO_CargarObjetoBotonComando($registro_campos,$registro_datos_formulario,$registro_formulario)
	{
		global $PCO_CampoBusquedaBD,$PCO_ValorBusquedaBD,$IdiomaPredeterminado;
        global $funciones_activacion_datepickers;
		global $MULTILANG_TitValorUnico,$MULTILANG_DesValorUnico,$MULTILANG_TitObligatorio,$MULTILANG_DesObligatorio;
		global $TabIndex_Elemento;
		$salida='';

        //Determina si el estilo del objeto debe ser inline o no
		$cadena_modo_inline='';
        if ($registro_campos["modo_inline"])
            $cadena_modo_inline='display:inline;';

		//Transfiere variables de mensajes de retorno asociadas al boton
		$comando_javascript="";
		if ($registro_campos["retorno_titulo"]!="")
			$comando_javascript="document.".$registro_formulario["id_html"].".PCO_ErrorTitulo.value='".$registro_botones["retorno_titulo"]."'; document.".$registro_formulario["id_html"].".PCO_ErrorDescripcion.value='".$registro_botones["retorno_texto"]."'; document.".$registro_formulario["id_html"].".PCO_ErrorIcono.value='".$registro_botones["retorno_icono"]."'; document.".$registro_formulario["id_html"].".PCO_ErrorEstilo.value='".$registro_botones["retorno_estilo"]."';";

        //Define el tipo de boton de acuerdo al tipo de accion
        switch ($registro_campos["tipo_accion"]) {

            case 'interna_guardar':    $comando_javascript.="PCOJS_ValidarCamposYProcesarFormulario('".$registro_formulario["id_html"]."'); ";     break;
            case 'interna_limpiar':    $comando_javascript.="document.getElementById('".$registro_formulario["id_html"]."').reset();"; break;
            case 'interna_escritorio': $comando_javascript.="document.PCO_FormVerMenu.submit();"; break;
            case 'interna_actualizar': $comando_javascript.="document.".$registro_formulario["id_html"].".PCO_Accion.value='PCO_ActualizarDatosFormulario'; PCOJS_ValidarCamposYProcesarFormulario('".$registro_formulario["id_html"]."'); "; break;
            case 'externa_postcode':   $comando_javascript.="document.".$registro_formulario["id_html"].".PCO_Accion.value='PCO_EjecutarPostAccionForm'; PCOJS_ValidarCamposYProcesarFormulario('".$registro_formulario["id_html"]."'); "; break;
            case 'interna_eliminar':   $comando_javascript.="document.".$registro_formulario["id_html"].".PCO_Accion.value='PCO_EliminarDatosFormulario';document.".$registro_formulario["id_html"].".submit();"; break;
            case 'interna_cargar':     $comando_javascript.="document.".$registro_formulario["id_html"].".PCO_Accion.value='PCO_CargarObjeto';document.".$registro_formulario["id_html"].".PCO_Objeto.value='".$registro_campos["accion_usuario"]."';  PCOJS_SanitizarValoresListaMultiple(); document.".$registro_formulario["id_html"].".submit(); "; break;
            case 'externa_formulario': $comando_javascript.="document.".$registro_formulario["id_html"].".PCO_Accion.value='".$registro_campos["accion_usuario"]."'; PCOJS_SanitizarValoresListaMultiple(); document.".$registro_formulario["id_html"].".submit();"; break;
            case 'externa_javascript': $comando_javascript.=$registro_campos["accion_usuario"];
        }


		//Verifica si el registro de botones presenta algun texto de confirmacion y lo antepone al script
		$cadena_confirmacion_accion_pre="";
		$cadena_confirmacion_accion_pos="";
		if (@$registro_campos["confirmacion_texto"]!="")
			{
				$cadena_confirmacion_accion_pre=" if (confirm('".PCO_ReemplazarVariablesPHPEnCadena($registro_campos["confirmacion_texto"],$registro_datos_formulario)."')) {";
				$cadena_confirmacion_accion_pos=" } else {} ";
			}

        //Genera cadena par el identificador del elemento usando el campo "campo". Normalmente oculto
        $cadena_identificador='';
        if ($registro_campos["campo"]!="")
            $cadena_identificador='id="'.$registro_campos["id_html"].'"';

        //Genera la cadena del enlace
        $cadena_javascript='href="javascript:  '.$cadena_confirmacion_accion_pre.'  '.@$comando_javascript.'  '.$cadena_confirmacion_accion_pos.'  "';

        //Abre el marco del control de datos style="display:inline;"
		$salida.='<div '.$cadena_identificador.' style="'.$cadena_modo_inline.'" class="form-group input-group">';
        // Muestra el campo
		$salida.='<a tabindex="'.$TabIndex_Elemento.'" id="'.$registro_campos["id_html"].'" class="btn '.$registro_campos["personalizacion_tag"].'" '.@$cadena_javascript.'><i class="'.$registro_campos["imagen"].'"></i> '.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["titulo"],$registro_datos_formulario).'</a>';
        //Cierra marco del control de datos
        $salida.= '</div>';

		return $salida;
	}


########################################################################
########################################################################
/*
	Function: PCO_AgregarFuncionesEdicionObjeto
	Genera el codigo HTML y CSS correspondiente los botones y demas elementos para la edicion en caliente de un objeto

	Variables de entrada:

		registro_campos - listado de campos sobre el formulario en cuestion
		tipo_elemento - Tipo de elemento a ser generado

	Salida:

		HTML, CSS y Javascript asociado al objeto publicado dentro del formulario

	Ver tambien:
		<PCO_CargarFormulario>
*/
function PCO_AgregarFuncionesEdicionObjeto($registro_campos,$registro_formulario,$tipo_elemento)
	{
	    global $MULTILANG_FrmEstaSeguro,$MULTILANG_FrmDesplazarObjetos,$MULTILANG_SaltoEdicion,$MULTILANG_Embebido,$MULTILANG_FrmValida,$MULTILANG_FrmPredeterminado,$MULTILANG_FrmCampo,$MULTILANG_MnuPropiedad,$MULTILANG_Detalles,$MULTILANG_Evento,$TablasCore,$MULTILANG_Cerrar,$ArchivoCORE,$MULTILANG_Editar,$MULTILANG_FrmAdvDelCampo,$MULTILANG_Eliminar,$MULTILANG_FrmAumentaPeso,$MULTILANG_FrmDisminuyePeso,$MULTILANG_Anterior,$MULTILANG_Columna,$MULTILANG_Siguiente;
		$salida='';
        if ($tipo_elemento=="ComplementoDisenoElemento")
            {
                $salida='onmouseenter="$(this).css(\'border\', \'1px solid\'); $(this).css(\'border-color\', \'#ff0000\');  //c2a7a7
                $(\'#PCOEditorContenedor_'.$registro_campos["id"].'\').css({\'visibility\':\'visible\'});
                $(\'#PCOEditorContenedor_'.$registro_campos["id"].'\').css({\'display\':\'block\'}); "
                onmouseleave="$(this).css(\'border\', \'0px solid\'); $(\'#PCOEditorContenedor_'.$registro_campos["id"].'\').css({\'visibility\':\'hidden\'}); $(\'#PCOEditorContenedor_'.$registro_campos["id"].'\').css({\'display\':\'none\'});  "';
            }
        if ($tipo_elemento=="ComplementoDisenoMarcoOpciones")
            {
                //Determina estados de activacion o no para controles segun valores actuales del registro
                $EstadoDeshabilitadoMoverIzquierda="";
                $EstadoDeshabilitadoMoverDerecha="";
                $EstadoDeshabilitadoMoverArriba="";
                if($registro_campos["PCOBD_Columna"]-1<=0) $EstadoDeshabilitadoMoverIzquierda="disabled";
                if($registro_campos["PCOBD_Columna"]+1>$registro_formulario["columnas"]) $EstadoDeshabilitadoMoverDerecha="disabled";
                if($registro_campos["PCOBD_Peso"]-1<=0) $EstadoDeshabilitadoMoverArriba="disabled";

                //Busca si el elemento tiene o no eventos para poner un boton de enlace
                $ComplementoBotonEventos="";
                $RegistroConteoEventos=PCO_EjecutarSQL("SELECT COUNT(*) as conteo_eventos FROM ".$TablasCore."evento_objeto WHERE objeto=? ",$registro_campos["id"])->fetch();
                if($RegistroConteoEventos["conteo_eventos"]>0)
                    {
                        //Listado de eventos
                        $ResultadoEventos=PCO_EjecutarSQL("SELECT evento,LENGTH(javascript) as bytes_codigo FROM ".$TablasCore."evento_objeto WHERE objeto=? ",$registro_campos["id"]);
                        $CadenaDetalleEventos="";
                        $ConteoEventos=1;
                        while ($RegistroEventos=$ResultadoEventos->fetch())
                            {
                                $CadenaDetalleEventos.="<li><b>".$RegistroEventos["evento"]."</b> (".$RegistroEventos["bytes_codigo"]." bytes)";
                                $ConteoEventos++;
                            }
                        $ComplementoBotonEventos_DEPRECATED='<br><a class="btn btn-xs btn-default" data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Evento.'(s)'.$CadenaDetalleEventos.'" href=\''.$ArchivoCORE.'?PCO_Accion=PCO_EditarFormulario&campo='.$registro_campos["id"].'&formulario='.$registro_campos["formulario"].'&popup_activo=FormularioCampos&pestana_activa_editor=eventos_objeto-tab&nombre_tabla='.$registro_formulario["tabla_datos"].'\'><i class="fa fa-bolt fa-fw texto-blink"></i></a>';
                        $ComplementoBotonEventos='<br><a class="btn btn-xs btn-default" data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Evento.'(s)'.$CadenaDetalleEventos.'" href=\'javascript:PCOJS_ActualizarControlFormulario('.$registro_campos["formulario"].','.$registro_campos["id"].',3);\'><i class="fa fa-bolt fa-fw texto-blink"></i></a>';
                    }

                //Si el elemento es un formulario o informe embebido busca ademas el nombre del mismo
                $Complemento_NombreEmbebido="";
                if ($registro_campos["tipo"]=="informe")
                    {
                        $IdentificadorBusqueda=$registro_campos["informe_vinculado"];
                        $RegistroEmbebido=PCO_EjecutarSQL("SELECT id,titulo FROM ".$TablasCore."informe WHERE id=$IdentificadorBusqueda ")->fetch();
                        $Complemento_NombreEmbebido="Inf ID ".$RegistroEmbebido["id"].": <b>".$RegistroEmbebido["titulo"]."</b>";
                    }
                if ($registro_campos["tipo"]=="form_consulta")
                    {
                        $IdentificadorBusqueda=$registro_campos["formulario_vinculado"];
                        $RegistroEmbebido=PCO_EjecutarSQL("SELECT id,titulo FROM ".$TablasCore."formulario WHERE id=$IdentificadorBusqueda ")->fetch();
                        $Complemento_NombreEmbebido="Frm ID ".$RegistroEmbebido["id"].": <b>".$RegistroEmbebido["titulo"]."</b>";
                    }

                //Pone controles
                $salida='<div id="PCOEditorContenedor_'.$registro_campos["id"].'" style="margin:2px; display:none; visibility:hidden; position: absolute; z-index:1000;">
                            <div style="display: inline-block; vertical-align:top;">
                                <a class="btn btn-xs btn-warning" data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Editar.'" href=\'javascript:PCOJS_ActualizarControlFormulario('.$registro_campos["formulario"].','.$registro_campos["id"].',1);\'><i class="fa fa-fw fa-pencil"></i></a>
                                <!--DEPRECATED:<a class="btn btn-xs btn-warning" data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Editar.'" href=\''.$ArchivoCORE.'?PCO_Accion=PCO_EditarFormulario&campo='.$registro_campos["id"].'&formulario='.$registro_campos["formulario"].'&popup_activo=FormularioCampos&nombre_tabla='.$registro_formulario["tabla_datos"].'\'><i class="fa fa-fw fa-pencil"></i></a>-->
                                '.$ComplementoBotonEventos.'
                                <br><br>
                                <a onclick=\'return confirm("'.$MULTILANG_FrmDesplazarObjetos.'\n\n'.$MULTILANG_FrmEstaSeguro.'");\' class="btn btn-xs btn-success" data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_FrmDesplazarObjetos.'" href=\''.$ArchivoCORE.'?PCO_Accion=PCO_DesplazarObjetosForm&idObjetoForm='.$registro_campos["id"].'&accion_retorno=PCO_EditarFormulario&nombre_tabla='.$registro_formulario["tabla_datos"].'\'><i class="fa fa-fw fa-step-forward fa-rotate-90"></i></a>                                
                            </div>
                            <div style="display: inline-block;">
                                <a class="btn btn-xs btn-info '.$EstadoDeshabilitadoMoverIzquierda.'" data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Anterior.' '.$MULTILANG_Columna.'" href=\''.$ArchivoCORE.'?PCO_Accion=cambiar_estado_campo&id='.$registro_campos["id"].'&tabla=formulario_objeto&campo=PCOBD_Columna&formulario='.$registro_campos["formulario"].'&accion_retorno=PCO_EditarFormulario&valor='.($registro_campos["PCOBD_Columna"]-1).'&nombre_tabla='.$registro_formulario["tabla_datos"].'\'><i class="fa fa-arrow-left"></i></a>
                            </div>
                            <div style="display: inline-block;">
                                <a class="btn btn-xs btn-info '.$EstadoDeshabilitadoMoverArriba.'" data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_FrmDisminuyePeso.' a '.($registro_campos["PCOBD_Peso"]-1).'" href=\''.$ArchivoCORE.'?PCO_Accion=cambiar_estado_campo&id='.$registro_campos["id"].'&tabla=formulario_objeto&campo=PCOBD_Peso&formulario='.$registro_campos["formulario"].'&accion_retorno=PCO_EditarFormulario&valor='.($registro_campos["PCOBD_Peso"]-1).'&nombre_tabla='.$registro_formulario["tabla_datos"].'\'><i class="fa fa-arrow-up"></i></a>
                                <br>
                                <a class="btn btn-xs btn-info" data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_FrmAumentaPeso.' a '.($registro_campos["PCOBD_Peso"]+1).'" href=\''.$ArchivoCORE.'?PCO_Accion=cambiar_estado_campo&id='.$registro_campos["id"].'&tabla=formulario_objeto&campo=PCOBD_Peso&formulario='.$registro_campos["formulario"].'&accion_retorno=PCO_EditarFormulario&valor='.($registro_campos["PCOBD_Peso"]+1).'&nombre_tabla='.$registro_formulario["tabla_datos"].'\'><i class="fa fa-arrow-down"></i></a>
                            </div>
                            <div style="display: inline-block;">
                                <a class="btn btn-xs btn-info '.$EstadoDeshabilitadoMoverDerecha.'" data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Siguiente.' '.$MULTILANG_Columna.'" href=\''.$ArchivoCORE.'?PCO_Accion=cambiar_estado_campo&id='.$registro_campos["id"].'&tabla=formulario_objeto&campo=PCOBD_Columna&formulario='.$registro_campos["formulario"].'&accion_retorno=PCO_EditarFormulario&valor='.($registro_campos["PCOBD_Columna"]+1).'&nombre_tabla='.$registro_formulario["tabla_datos"].'\'><i class="fa fa-arrow-right"></i></a>
                            </div>
                            
                            <div style="display: inline-block; vertical-align:top;">
                                <a class="btn btn-xs" data-toggle="tooltip" data-html="true"  data-placement="top" title="<div align=left><font color=yellow>'.$MULTILANG_Detalles.' <i>('.$MULTILANG_MnuPropiedad.')</i></font><br>ID HTML: <b>'.$registro_campos["id_html"].'</b><br>'.$MULTILANG_FrmCampo.': <b>'.$registro_campos["campo"].'</b><br>'.$MULTILANG_FrmPredeterminado.': <b>'.$registro_campos["valor_predeterminado"].'</b><br>'.$MULTILANG_FrmValida.': <b>'.$registro_campos["validacion_datos"].'</b> Extra: <b>'.$registro_campos["validacion_extras"].'</b></div>" href=\'#\'><i class="fa fa-info-circle"></i></a>';
                            //Si el objeto es un formulario o informe embebido agrega enlace para su edicion directa
                            if ($registro_campos["tipo"]=="form_consulta")
                                $salida.='<br><a onclick=\'return confirm("'.$MULTILANG_SaltoEdicion.'");\' href=\''.$ArchivoCORE.'?PCO_Accion=PCO_EditarFormulario&formulario='.$registro_campos["formulario_vinculado"].'&popup_activo=\' class="btn btn-primary btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Editar.' '.$MULTILANG_Embebido.'<br>'.$Complemento_NombreEmbebido.'"><i class="fa fa fa-object-ungroup"></i></a>';
                            if ($registro_campos["tipo"]=="informe")
                                $salida.='<br><a onclick=\'return confirm("'.$MULTILANG_SaltoEdicion.'");\' href=\''.$ArchivoCORE.'?PCO_Accion=PCO_EditarInforme&informe='.$registro_campos["informe_vinculado"].'&popup_activo=\' class="btn btn-primary btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Editar.' '.$MULTILANG_Embebido.'<br>'.$Complemento_NombreEmbebido.'"><i class="fa fa fa-object-ungroup"></i></a>';
                $salida.='</div>
                            <div style="display: inline-block;">
                                <a class="btn btn-xs " data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Cerrar.'" href="javascript:OcultarOpcionesEdicion(this,\'#PCOEditorContenedor_'.$registro_campos["id"].'\');"><i class="fa fa-times"></i></a>
                                <br>
                                <a onclick=\'return confirm("'.$MULTILANG_FrmAdvDelCampo.'");\' href=\''.$ArchivoCORE.'?PCO_Accion=PCO_EliminarCampoFormulario&campo='.$registro_campos["id"].'&formulario='.$registro_campos["formulario"].'&nombre_tabla='.$registro_formulario["tabla_datos"].'\' class="btn btn-danger btn-xs"  data-toggle="tooltip" data-html="true"  data-placement="top" title="'.$MULTILANG_Eliminar.'"><i class="fa fa-trash"></i></a>
                            </div>
                            </div>';
            }
		return $salida;
	}


########################################################################
########################################################################
/*
	Function: PCO_CargarFormulario
	Genera el codigo HTML correspondiente a un formulario de la aplicacion y hace los llamados necesarios para la diagramacion por pantalla de los diferentes objetos que lo componen.

	Variables de entrada:

		formulario - ID unico del formulario que se desea cargar
		en_ventana - Opcional, determina si el formulario es cargado en una ventana o directamente sobre el escritorio
		PCO_CampoBusquedaBD - Opcional, indica el campo sobre el cual se deben realizar busquedas para el cargue automatico de campos del formulario desde la base de datos
		PCO_ValorBusquedaBD - Opcional, indica el valor que sera buscado sobre el PCO_CampoBusquedaBD para encontrar los valores de cada objeto en el formulario
		anular_form - Opcional, indica si las etiquetas del formulario HTML deben ser eliminadas y agregar los campos crudos dentro del form
		modo_diseno_formulario - Opcional, indica si se esta disenando el formulario para presentar algunos controles extra

	(start code)
		SELECT * FROM ".$TablasCore."formulario WHERE id='$formulario'
		SELECT id,PCOBD_Peso,visible FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND fila_unica='1' AND visible=1 UNION SELECT 0,$limite_superior,0 ORDER BY PCOBD_Peso
		SELECT * FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND columna='$cl' AND visible=1 AND PCOBD_Peso >'$limite_inferior' AND PCOBD_Peso <='$limite_superior' ORDER BY PCOBD_Peso
		Por cada registro
			Llamar creacion de objeto correspondiente
		SELECT * FROM ".$TablasCore."formulario_objeto WHERE formulario='$formulario' AND id='$ultimo_id'
		SELECT * FROM ".$TablasCore."formulario_boton WHERE formulario='$formulario' AND visible=1 ORDER BY peso
	(end)

	Salida:

		HTML, CSS y Javascript asociado al formulario

	Ver tambien:
		<PCO_CargarInforme>
*/
    //Funcion para compatibilidad hacia atras.  Desaparecera en la version 18.9
    function cargar_formulario($formulario,$en_ventana=1,$PCO_CampoBusquedaBD="",$PCO_ValorBusquedaBD="",$anular_form=0,$modo_diseno_formulario=0)
    { echo "ERROR: Llamado a funcion obsoleta del framework cargar_formulario().  En su lugar utilice PCO_CargarFormulario() "; }
function PCO_CargarFormulario($formulario,$en_ventana=1,$PCO_CampoBusquedaBD="",$PCO_ValorBusquedaBD="",$anular_form=0,$modo_diseno_formulario=0,$ComplementoPestanas="")
  {
        global $ModoDesarrolladorPractico,$PCO_RegistroDatosFormulario;
        global $ConexionPDO,$ArchivoCORE,$TablasCore,$LlaveDePaso;
        global $PCO_InformeFiltro,$PCO_FuncionesJSInternasFORM;
		global $_SeparadorCampos_;
		// Carga variables de definicion de tablas
		global $ListaCamposSinID_formulario,$ListaCamposSinID_formulario_objeto,$ListaCamposSinID_formulario_boton,$ListaCamposSinID_menu;
		global $MULTILANG_Formularios,$MULTILANG_Editar,$MULTILANG_Elementos,$MULTILANG_Agregar,$MULTILANG_Configuracion,$MULTILANG_AvisoSistema,$MULTILANG_ErrFrmObligatorio,$MULTILANG_ErrorTiempoEjecucion,$MULTILANG_ObjetoNoExiste,$MULTILANG_ContacteAdmin,$MULTILANG_Formularios,$MULTILANG_VistaImpresion,$MULTILANG_InfRetornoFormFiltrado,$MULTILANG_FrmMsj1,$MULTILANG_Documentar;
        global $PCO_InformesListaColumnasDT,$PCO_InformesRecuperacionAJAX,$PCO_InformesIdCache,$PCO_InformesDataTable,$PCO_InformesDataTablePaginaciones,$PCO_InformesDataTableTotales,$PCO_InformesDataTableFormatoTotales,$PCO_InformesDataTableExrpotaCLP,$PCO_InformesDataTableExrpotaCSV,$PCO_InformesDataTableExrpotaXLS,$PCO_InformesDataTableExrpotaPDF,$PCO_InformesDataTableDefineCOLS,$PCO_InformesDataTable_pane_activado,$PCO_InformesDataTable_pane_cascada,$PCO_InformesDataTable_pane_colapsado,$PCO_InformesDataTable_pane_columnas,$PCO_InformesDataTable_pane_subtotalesrelativos,$PCO_InformesDataTable_pane_conteos,$PCO_InformesDataTable_pane_controles,$PCO_InformesDataTable_pane_control_colapsar,$PCO_InformesDataTable_pane_control_ordenar;
        global $POSTForm_ListaCamposObligatorios,$POSTForm_ListaTitulosObligatorios;
		global $PCO_BarraHerramientasFormulario; 
		global $TabIndex_Elemento;

		// Busca datos del formulario
		$registro_formulario=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario." FROM ".$TablasCore."formulario WHERE id=?","$formulario")->fetch();

        //Determina si el usuario es un disenador de aplicacion para mostrar el ID de objeto a manera informativa y un boton de salto a edicion
        $BotonSaltoEdicion='
                    <a class="btn btn-default btn-xs" href="index.php?PCO_Accion=PCO_EditarFormulario&popup_activo=&formulario='.$formulario.'" id="PCO_BotonEdicionFormulario">
                        <div><i class="fa fa-pencil-square"></i> '.$MULTILANG_Editar.' '.$MULTILANG_Formularios.' <i>[ID='.$formulario.']</i></div>
                    </a>';
		if (PCO_EsAdministrador($_SESSION['PCOSESS_LoginUsuario']) && ($formulario>=0 || $ModoDesarrolladorPractico==-10000) )
		    $ComplementoIdObjetoEnTitulo="  $BotonSaltoEdicion";

		echo '
		<script type="text/javascript">
			function AgregarElemento(columna,fila,elemento)
				{
					//carga dinamicamente objetos html a marcos
					var capa = document.getElementById(ubicacion);
					var zona = document.createElement("po");
					zona.innerHTML = elemento;
					capa.appendChild(zona);
				}

			function ImprimirMarco(nombre)
				{
				  var marco_contenidos = document.getElementById(nombre);
				  var ventana_impresion = window.open(" ", "PopUpImpresion");

				  //Agrega estilos basicos
                    //ventana_impresion.document.write( \'<link rel="stylesheet" type="text/css" href="general.css">\' );

				  //Agrega titulo del formulario
					//ventana_impresion.document.write( \'<div align=CENTER><b>'.$registro_formulario["titulo"].'</b></div><hr>\' );

				  //Agrega el concenito del DIV al documento
					ventana_impresion.document.write( marco_contenidos.innerHTML );
					ventana_impresion.document.close();

				  //Abre ventana de impresion
					ventana_impresion.print( );

				  //Cierra ventana de impresion
					ventana_impresion.close();
				}

			function OcultarOpcionesEdicion(ObjetoEnlazado,NombreMarcoOpciones)
			    {
				    BasuritaVar1=$(ObjetoEnlazado).css(\'border\', \'0px solid\');
				    BasuritaVar2=$(NombreMarcoOpciones).css({\'visibility\':\'hidden\'});
				    BasuritaVar3=$(NombreMarcoOpciones).css({\'display\':\'none\'});
			    }
		</script>
		<!--<input type=button onclick=\'AgregarElemento("1","1","hello world");\'>-->';

        if ($modo_diseno_formulario==1)
            {
        		echo '<script type="text/javascript">
                        function PCOJS_LlamadoRemotoEditarFormulario()
            				{
            					document.getElementById("PCO_BotonEdicionFormulario").click();
            				}
				
                        function PCOJS_ActualizarControlFormulario(idformulario,idcontrol,pestana_activa){
                            //Salta a edicion de control
                            var URLPopUp="index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=frm:-36:0:id:"+idcontrol+"&Presentar_FullScreen=1&Precarga_EstilosBS=1&formulario="+idformulario+"&pestana_activa_apertura="+pestana_activa+"&PCO_TipoControlDirecto=";
                            PCOJS_MostrarMensaje("'.$MULTILANG_FrmMsj1.'","Cargando...","modal-wide oculto_impresion");
                            $("#PCO_Modal_MensajeCuerpo").html(\'<iframe id="IFrameEmbebido" scrolling="yes" style="margin:10px; border:0px;" height=500 width=100% src="\'+URLPopUp+\'"></iframe>\');
                            $("#PCO_Modal_MensajeBotones").html(\'<button id="boton_filtrar" type="button" class="btn btn-outline btn-info" data-dismiss="modal" onclick="PCOJS_LlamadoRemotoEditarFormulario();" >Cerrar</button></a>\');
                        }
        		    </script>';
            }

        //Funciones asociadas a documentacion
		echo '<script type="text/javascript">
                function PCOJS_DocumentacionFormulario(idformulario,IdInforme){
                    //Presenta informe con documentacion del formulario o posibilidad de crear nueva documentacion
                    
                    //Define los campos segun el informe a utilizar
                    lista_campos_segun_informe="titulo as Titulo,formato as Formato,visibilidad as Visible";
                    if (IdInforme==-56) lista_campos_segun_informe="titulo as Titulo,formato as Formato";
                    
                    //Define ancho de ventana segun tipo de informe/usuario
                    estilo_ancho_ventana="modal-wide ";
                    if (IdInforme==-56) estilo_ancho_ventana="";

                    var URLPopUp="index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=inf:"+IdInforme+":0&Presentar_FullScreen=1&Precarga_EstilosBS=1&origen=Formulario&detalle_origen="+idformulario+"&lista_campos_documentacion="+lista_campos_segun_informe;
                    PCOJS_MostrarMensaje("'.$MULTILANG_Documentar.'","Cargando...",estilo_ancho_ventana+" oculto_impresion");
                    $("#PCO_Modal_MensajeCuerpo").html(\'<iframe id="IFrameEmbebido" scrolling="yes" style="margin:10px; border:0px;" height=450 width=100% src="\'+URLPopUp+\'"></iframe>\');
                    $("#PCO_Modal_MensajeBotones").html(\'<button id="boton_filtrar" type="button" class="btn btn-outline btn-info" data-dismiss="modal" onclick="CargarFormulario();" >Cerrar</button></a>\');
                }
                
                //TODO: Pasar a JS general para permitir llamado desde otros apartados, ej, Kanban
                //IdDocumentacion contiene dos datos, IdRegistro|TipoDocumentacion
                //TipoDocCreacion contiene el formato de documentacion (redundante con parte del primer parametro pero usado solo en creacion)
                function PCOJS_EditarDocumentacion(IdDocumentacion,TipoDocCreacion)
                    {
                        IdDocumentacion=IdDocumentacion+"";
                        PartesIdDocumentacion=IdDocumentacion.split("|");
                        //Determina tipo de documentacion para establecer el tipo de llamado.
                        
                        IdRegistro=PartesIdDocumentacion[0];
                        TipoRegistro=PartesIdDocumentacion[1];
                        if (IdRegistro!="" && IdRegistro!="0")
                            {
                                //Determina si va a editar un contenido enriquecido o un diagrama
                                if (TipoRegistro=="Enriquecido" || TipoDocCreacion=="Enriquecido")
                                    var URLPopUp="index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=frm:-43:0:id:"+IdRegistro+"&Presentar_FullScreen=1&Precarga_EstilosBS=1&origen=Formulario&formato="+TipoRegistro;
                                if (TipoRegistro=="Diagrama")
                                    var URLPopUp="inc/mxgraph/javascript/scripts/grapheditor/www/index.php?PCO_CampoOrigen=documentacion&PCO_TablaOrigen=core_documentacion&PCO_CampoLlave=id&PCO_ValorLlave="+IdRegistro;
                            }
                        else
                            var URLPopUp="index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=frm:-43:0&Presentar_FullScreen=1&Precarga_EstilosBS=1&origen_creacion=Formulario&detalle_origen_creacion='.$registro_formulario["id"].'&formato_creacion="+TipoDocCreacion;
                        
                        //Carga el editor de documentacion
                        PCO_VentanaPopup(URLPopUp,"Docs"+IdRegistro,"toolbar=no, location=no, directories=0, directories=no, status=no, location=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, titlebar=no, width=900, height=700");
                    }
                function PCOJS_VisualizarDocumentacion(IdDocumentacion)
                    {
                        alert("Sin acceso a elemento: "+IdDocumentacion);
                    }
		    </script>';


		//Si no encuentra formulario presenta error
		if ($registro_formulario["id"]=="")	PCO_Mensaje($MULTILANG_ErrorTiempoEjecucion,$MULTILANG_ObjetoNoExiste." ".$MULTILANG_ContacteAdmin."<br>(".$MULTILANG_Formularios." $formulario)", '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');

		// En caso de recibir un campo base y valor base se hace la busqueda para recuperar la informacion
		if ($PCO_CampoBusquedaBD!="" && $PCO_ValorBusquedaBD!="")
			{
				$consulta_datos_formulario = $ConexionPDO->prepare("SELECT * FROM ".$registro_formulario["tabla_datos"]." WHERE $PCO_CampoBusquedaBD='$PCO_ValorBusquedaBD'");
				$consulta_datos_formulario->execute();
				$registro_datos_formulario = $consulta_datos_formulario->fetch();
				$PCO_RegistroDatosFormulario=$registro_datos_formulario;
			}
		
		//Carga cualquier script PRE para el formulario
		if ($registro_formulario["pre_script"]!="" && $modo_diseno_formulario==0)
		    {
		        //Evalua si el codigo ya inicia con <?php y sino lo agrega
		        $ComplementoInicioScript="";
		        if (substr(trim($registro_formulario["pre_script"]),0,5)!='<?php')
		            $ComplementoInicioScript="<?php\n";
		        PCO_EvaluarCodigo($ComplementoInicioScript.$registro_formulario["pre_script"],1,"Detalles: PRE-Code Form ID=".$formulario);
		    }
		    
		
		// Define la barra de herramientas mini superior (en barra de titulo)
		@$PCO_BarraHerramientasFormulario.='
				<a  href="#" data-toggle="tooltip" data-html="true"  title="'.$MULTILANG_VistaImpresion.'" name="">
					<i class="fa fa-print" OnClick="ImprimirMarco(\'MARCO_IMPRESION\');"></i>
				</a>';

		// Establece color de fondo para el form
		$color_fondo="#f2f2f2";

		//Determina si esta en modo diseno para agregar algunos elementos extra al titulo del form
        if ($modo_diseno_formulario)
            {
                //Genera llaves de apertura unicos para los archivos de pcoder 
                //FORMA 1: Enlaces estandar (Modo de emergencia o depuracion de PCoder)
                // $PCO_EnlaceScriptPRE ="javascript:PCO_VentanaPopup('index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=frm:-33:0&Presentar_FullScreen=1&Precarga_EstilosBS=1&Origen_Archivo=B&Tabla_Archivo=core_formulario&Campo_Archivo=pre_script&PCODER_extension=php&PCODER_ModoEditor=PHP&PCODER_TipoMenu=Iconos&PCODER_EstadoSimple=1&Llave_Registro={$formulario}&PCODER_Titulo=Script_PRE_Formulario_{$formulario}_(PHP)','PcoderNG','toolbar=no, location=no, directories=0, directories=no, status=no, location=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, titlebar=no, width=800, height=600');";  //ANTES  width='+screen.width+', height='+screen.height);
                // $PCO_EnlaceScriptPOST="javascript:PCO_VentanaPopup('index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=frm:-33:0&Presentar_FullScreen=1&Precarga_EstilosBS=1&Origen_Archivo=B&Tabla_Archivo=core_formulario&Campo_Archivo=post_script&PCODER_extension=php&PCODER_ModoEditor=PHP&PCODER_TipoMenu=Iconos&PCODER_EstadoSimple=1&Llave_Registro={$formulario}&PCODER_Titulo=Script_POST_Formulario_{$formulario}_(PHP)','PcoderNG','toolbar=no, location=no, directories=0, directories=no, status=no, location=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, titlebar=no, width=800, height=600');";  //ANTES  width='+screen.width+', height='+screen.height);
                // $PCO_EnlaceScriptJS  ="javascript:PCO_VentanaPopup('index.php?PCO_Accion=PCO_CargarObjeto&PCO_Objeto=frm:-33:0&Presentar_FullScreen=1&Precarga_EstilosBS=1&Origen_Archivo=B&Tabla_Archivo=core_formulario&Campo_Archivo=javascript&PCODER_extension=js&PCODER_ModoEditor=JavaScript&PCODER_TipoMenu=Iconos&PCODER_EstadoSimple=1&Llave_Registro={$formulario}&PCODER_Titulo=Script_JS_Formulario_{$formulario}_(JS)' ,'PcoderNG','toolbar=no, location=no, directories=0, directories=no, status=no, location=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, titlebar=no, width=800, height=600');";  //ANTES  width='+screen.width+', height='+screen.height);
                //FORMA 2: Con funcion interna de apertura - Sobreescribe FORMA 1 - Comentar para pasar a modo de emergencia
                $TituloPCoder_COMPLEMENTO=" - <font color=white>".$registro_formulario["titulo"]."</font> ";
                $LlaveParcial_FirmaSistema=substr($LlaveDePaso,-3);
                $PCO_EnlaceScriptPRE ="javascript:PCOJS_CargarArchivoPCoderBD('{$LlaveParcial_FirmaSistema}','','','','No','B','core_formulario','pre_script', '{$formulario}','php','PHP'       ,'Iconos','1','<font color=white>Script_PRE</font> Formulario_{$formulario}_(PHP){$TituloPCoder_COMPLEMENTO}');";
                $PCO_EnlaceScriptPOST="javascript:PCOJS_CargarArchivoPCoderBD('{$LlaveParcial_FirmaSistema}','','','','No','B','core_formulario','post_script','{$formulario}','php','PHP'       ,'Iconos','1','<font color=white>Script_POST</font> Formulario_{$formulario}_(PHP){$TituloPCoder_COMPLEMENTO}');";
                $PCO_EnlaceScriptJS  ="javascript:PCOJS_CargarArchivoPCoderBD('{$LlaveParcial_FirmaSistema}','','','','No','B','core_formulario','javascript' ,'{$formulario}','js' ,'JavaScript','Iconos','1','<font color=white>Script_JS</font> Formulario_{$formulario}_(PHP){$TituloPCoder_COMPLEMENTO}');";
                $PCO_EnlaceScriptDOCS  ="javascript:LMQTP=PCOJS_DocumentacionFormulario('{$formulario}',-55);";

				$ComplementoTituloFormulario='
				<div class="pull-right">
                    <a class="btn btn-default btn-xs" data-toggle="modal" href="'.$PCO_EnlaceScriptDOCS.'">
                        <div><i class="fa fa-file-word-o"></i> Docs</div>
                    </a>
                    <a class="btn btn-primary btn-xs" data-toggle="modal" title="'.$MULTILANG_FrmAdvScriptForm.'" href="'.$PCO_EnlaceScriptPRE.'">
                        <div><i class="fa fa-file-code-o"></i> PRE</div>
                    </a>
                    <a class="btn btn-info btn-xs" data-toggle="modal" title="'.$MULTILANG_FrmAdvScriptForm.'" href="'.$PCO_EnlaceScriptPOST.'">
                        <div><i class="fa fa-file-code-o"></i> POST</div>
                    </a>
                    <a class="btn btn-warning btn-xs" data-toggle="modal" title="'.$MULTILANG_FrmAdvScriptForm.'" href="'.$PCO_EnlaceScriptJS.'">
                        <div><i class="fa fa-file-code-o"></i> JS</div>
                    </a>
                    &nbsp;
					<a class="btn btn-default btn-xs" href="javascript:PCOJS_AlternarBarraFlotanteIzquierda();">
						<div><i class="fa fa-cog fa-spin fa-fw"></i> '.$MULTILANG_Configuracion.' / '.$MULTILANG_Agregar.' '.$MULTILANG_Elementos.'</div>
					</a>
				</div>';
            }
        else
            {
                //Determina si el formulario tiene documentacion asociada y muestra el boton
                $TotalDocumentacionElemento=PCO_EjecutarSQL("SELECT COUNT(*) FROM core_documentacion WHERE origen='Formulario' AND detalle_origen='{$formulario}' AND visibilidad='Usuario' ")->fetchColumn();
                if ($TotalDocumentacionElemento!="0")
                    {
                        $PCO_EnlaceScriptDOCS  ="javascript:LMQTP=PCOJS_DocumentacionFormulario('{$formulario}',-56);";
        				$ComplementoTituloFormulario='
        				<div class="pull-right">
                            <a class="btn btn-info btn-xs" data-toggle="modal" href="'.$PCO_EnlaceScriptDOCS.'">
                                <div><i class="fa fa-file-word-o"></i> Docs</div>
                            </a>
        				</div>';                        
                    }
            }

		// Crea ventana si aplica para el form
		if ($en_ventana) PCO_AbrirVentana(PCO_ReemplazarVariablesPHPEnCadena($registro_formulario["titulo"]).$ComplementoTituloFormulario.$ComplementoIdObjetoEnTitulo,$registro_formulario["estilo_ventana"],'',$PCO_BarraHerramientasFormulario);

        //Busca las posibles opciones de menu agregadas al formulario
        $RegistroCantidadMenues=PCO_EjecutarSQL("SELECT COUNT(*) as CantidadMenues FROM ".$TablasCore."menu WHERE formulario_vinculado='$formulario' AND padre=0")->fetch();
        if ($RegistroCantidadMenues["CantidadMenues"]>0)
            {
        		echo '<!-- Boton expansible para menu en dispositivos moviles -->
        			<nav class="navbar navbar-default" style="min-height:30px !important; margin:0px !important; padding:0px !important;"> <!--  navbar-xs navbar-fixed-top  navbar-inverse navbar-fixed-bottom navbar-static-top  -->
    					<div class="navbar-header">
    						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#MENU_FORMULARIO_'.$formulario.'" aria-expanded="false">
    						    <i class="fa fa-bars"></i>
    						</button>
    					</div>
            		    <div class="collapse navbar-collapse" id="MENU_FORMULARIO_'.$formulario.'">';
                            $resultado=PCO_EjecutarSQL("SELECT ".$TablasCore."menu.id as id,$ListaCamposSinID_menu FROM ".$TablasCore."menu WHERE formulario_vinculado='$formulario' AND padre=0 ORDER BY peso");
                            $ConteoOpciones=1;
                            while($registro = $resultado->fetch())
                                {
                                    echo '<div style="display:inline !important;" id="MENU_FORMULARIO_OPCION_'.$ConteoOpciones.'">';
                                    PCO_ImprimirOpcionMenu($registro,'formulario');
                                    echo '</div>';
                                    $ConteoOpciones++;
                                }
        		echo '  </div>
        		    </nav>';
            }

		// Muestra ayuda en caso de tenerla
		$imagen_ayuda='fa fa-info-circle fa-5x texto-azul';
		if ($registro_formulario["ayuda_titulo"]!="" || $registro_formulario["ayuda_texto"]!="")
			PCO_Mensaje(PCO_ReemplazarVariablesPHPEnCadena($registro_formulario["ayuda_titulo"]),PCO_ReemplazarVariablesPHPEnCadena($registro_formulario["ayuda_texto"]),'100%',$imagen_ayuda,'alert alert-info alert-dismissible');

		//Inicia el formulario de datos
		echo '<div id="PCO_MarcoImpresion'.$formulario.'">';
		//Si se quiere anular el formulario y su accion cuando se trata de un sub-formulario de consulta
		if (!$anular_form)
			echo'<form id="'.$registro_formulario["id_html"].'" name="'.$registro_formulario["id_html"].'" action="'.$ArchivoCORE.'" method="POST" enctype="multipart/form-data" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
				<input type="Hidden" name="formulario" value="'.$formulario.'">
				<input type="Hidden" name="id_registro_datos" value="'.@$registro_datos_formulario["id"].'">
				<input type="Hidden" name="PCO_FormularioActivo" value="'.$formulario.'">
				<input type="Hidden" name="PCO_Accion" value="PCO_GuardarDatosFormulario">
				<input type="Hidden" name="PCO_ErrorIcono" value="'.@$PCO_ErrorIcono.'">
				<input type="Hidden" name="PCO_ErrorEstilo" value="'.@$PCO_ErrorEstilo.'">
				<input type="Hidden" name="PCO_ErrorTitulo" value="'.@PCO_ReemplazarVariablesPHPEnCadena($PCO_ErrorTitulo).'">
				<input type="Hidden" name="PCO_ErrorDescripcion" value="'.@PCO_ReemplazarVariablesPHPEnCadena($PCO_ErrorDescripcion).'">
                <input type="Hidden" name="Presentar_FullScreen" value="'.@$Presentar_FullScreen.'">
                <input type="Hidden" name="Precarga_EstilosBS" value="'.@$Precarga_EstilosBS.'">
                <input type="Hidden" name="PCO_Objeto" value="">  <!--Requerido si se va a transferir el control a un objeto FRM o INF-->
                <input type="Hidden" name="objeto" value="">      <!--COMPATIBILIDAD: Requerido si se va a transferir el control a un objeto FRM o INF-->
				';

        // Inicio de la generacion de encabezados pestanas
        //Cuenta las pestanas segun los objetos del form y ademas mira si es solo una con valor vacio (sin pestanas)
        $consulta_conteo_pestanas=      PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1 GROUP BY pestana_objeto ORDER BY pestana_objeto","$formulario");
        $conteo_pestanas=0;
        $conteo_pestanas_ocultas=0;
        while($registro_conteo_pestanas = @$consulta_conteo_pestanas->fetch())
            {
                $titulo_pestana_formulario=$registro_conteo_pestanas["pestana_objeto"];
                if ($titulo_pestana_formulario!="PCO_NoVisible" || (PCO_EsAdministrador($_SESSION['PCOSESS_LoginUsuario']) && $formulario>=0)  ||  (PCO_EsAdministrador($_SESSION['PCOSESS_LoginUsuario']) && $formulario<0 && $modo_diseno_formulario==1)   )
                    {
                        $conteo_pestanas++;
                        $ultimo_nombre_pestanas=$registro_conteo_pestanas["pestana_objeto"];
                    }
                //Lleva el conteo de las ocultas en caso que las deba crear aunque solo exista una visible pero se requieran los tab-pane para separar la oculta
                if ($titulo_pestana_formulario=="PCO_NoVisible")
                    $conteo_pestanas_ocultas=1;
            }
        //Presenta barra de navegacion de pestanas si se encuentra al menos una
        if ($conteo_pestanas>0 && ($ultimo_nombre_pestanas!=""))
            {
				//Determina el estilo de las pestanas
				$CadenaEstiloPestanas=""; //Estilo por defecto para aplicar a las pestanas
				if($registro_formulario["estilo_pestanas"]=="")
					$CadenaEstiloPestanas="visibility:hidden; height:0px;"; //Oculta las pestanas

                $consulta_formulario_pestana=   PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1 GROUP BY pestana_objeto ORDER BY pestana_objeto","$formulario");
                echo '<ul class="nav '.$registro_formulario["estilo_pestanas"].' nav-justified oculto_impresion" style="'.$CadenaEstiloPestanas.'">';
                $estado_activa_primera_pestana=' class="active" ';
                $pestana_activa=1;
                while($registro_formulario_pestana = @$consulta_formulario_pestana->fetch())
                    {
                        $titulo_pestana_formulario=PCO_ReemplazarVariablesPHPEnCadena($registro_formulario_pestana["pestana_objeto"]);
                        if ($titulo_pestana_formulario=="") $titulo_pestana_formulario="<i class='fa fa-stack-overflow'></i>";
                        //Presenta la pestana solamente si no es una oculta
                        if ($titulo_pestana_formulario!="PCO_NoVisible" || (PCO_EsAdministrador($_SESSION['PCOSESS_LoginUsuario']) && $formulario>=0)   ||  (PCO_EsAdministrador($_SESSION['PCOSESS_LoginUsuario']) && $formulario<0 && $modo_diseno_formulario==1)   )
                            echo '<li '.$estado_activa_primera_pestana.'  ><a  href="#PCO_Pestana'.$ComplementoPestanas.'Formulario_'.$pestana_activa.'" data-toggle="tab" id="PCO_LinkPestanaFormulario_'.$pestana_activa.'">'.$titulo_pestana_formulario.'</a></li>';
                        //Limpia para las siguientes pestanas
                        $estado_activa_primera_pestana='';
                        $pestana_activa++;
                    }
                echo '</ul>';
            }
        // Fin de la generacion de encabezados pestanas

        //Genera las pestanas con su contenido
        $UltimaClaseColumna="";
        if ($conteo_pestanas>0)
            {
                $consulta_formulario_pestana=   PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=1 GROUP BY pestana_objeto ORDER BY pestana_objeto","$formulario");
                $estado_activa_primera_pestana='in active';
                $pestana_activa=1;

                //Inicio de los tab-content
                echo '<div class="tab-content" >';
                while($registro_formulario_pestana = @$consulta_formulario_pestana->fetch())
                    {
                        //Si la pestana es PCO_NoVisible entonces agrega la clase de oculta en impresion
                        $ComplementoClaseOcultaImpresion="";
                        if ($registro_formulario_pestana["pestana_objeto"]=="PCO_NoVisible") $ComplementoClaseOcultaImpresion="oculto_impresion";

                        $titulo_pestana_formulario=$registro_formulario_pestana["pestana_objeto"];
                        //Genera el contenedor de la pestana.  Se considera necesario crear contenedores solo cuando hay mas de una pestana, si hay una solamente entonces no hay que crear el contenedor
                        if ($conteo_pestanas>1 || $conteo_pestanas_ocultas==1)
                        echo '
                        <!-- INICIO de las pestanas No '.$pestana_activa.' -->
                            <div class="tab-pane fade '.$estado_activa_primera_pestana.' '.$ComplementoClaseOcultaImpresion.' " id="PCO_Pestana'.$ComplementoPestanas.'Formulario_'.$pestana_activa.'" >';

                                //Booleana que determina si se debe incluir el javascript de ckeditor
                                $existe_campo_textoformato=0;

                                //DIAGRAMACION DE LA TABLA CON ELEMENTOS DEL FORMULARIO
                                $limite_inferior=-9999; // Peso inferior a tener en cuenta en el query
                                $constante_limite_superior=+9999;
                                $limite_superior=$constante_limite_superior; // Peso superior a tener en cuenta en el query
                                //Busca todos los objetos marcados como fila_unica=1 y agrega un registro mas con el limite superior
                                $consulta_obj_fila_unica=PCO_EjecutarSQL("SELECT id,PCOBD_Peso,visible FROM ".$TablasCore."formulario_objeto WHERE pestana_objeto=? AND formulario=? AND fila_unica='1' AND visible=1 UNION SELECT 0,$limite_superior,0 ORDER BY PCOBD_Peso","$titulo_pestana_formulario$_SeparadorCampos_$formulario");
                                //Define si debe o no dibujar borde de las celdas
                                $estilo_bordes="table-unbordered";
                                $ancho_bordes="border-width: 0px;";
                                if ($registro_formulario["borde_visible"]==1)
									{
										$estilo_bordes="table-bordered";
										$ancho_bordes="border-width: 1px;";
									}

                                $TabIndex_Elemento=1;
                                while ($registro_obj_fila_unica = $consulta_obj_fila_unica->fetch())
                                    {
                                        $limite_superior=$registro_obj_fila_unica["PCOBD_Peso"];
                                        $ultimo_id=$registro_obj_fila_unica["id"];

                                        //Define tipo_maquetacion
                                        if($registro_formulario["tipo_maquetacion"]=="responsive")
                                            {
                                                echo '<div class="row">';
                                            }
                                        //Define tipo_maquetacion
                                        if($registro_formulario["tipo_maquetacion"]=="tradicional")
                                            {
                                                // Inicia la tabla con los campos
                                                echo '
                                                    <div class="table-responsive" style="border-width: 0px; margin-top:0; margin-bottom:0; margin-left:0; margin-right:0; ">
                                                    <table class="table table-responsive '.$estilo_bordes.' table-condensed btn-xs" style="'.$ancho_bordes.' margin-top:0; margin-bottom:0; margin-left:0; margin-right:0; padding: 0px; border-spacing: 0px; "><tr>';
                                            }

                                        //Recorre todas las comunas definidas para el formulario buscando objetos
                                        for ($cl=1;$cl<=$registro_formulario["columnas"];$cl++)
                                            {
                                                //Busca los elementos de la coumna actual del formulario con PCOBD_Peso menor o igual al PCOBD_Peso del objeto fila_unica de la fila unica_actual pero que no son fila_unica
                                                $consulta_campos=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE pestana_objeto=? AND formulario=? AND PCOBD_Columna=? AND visible=1 AND PCOBD_Peso >? AND PCOBD_Peso <=? ORDER BY PCOBD_Peso","$titulo_pestana_formulario$_SeparadorCampos_$formulario$_SeparadorCampos_$cl$_SeparadorCampos_$limite_inferior$_SeparadorCampos_$limite_superior");

                                                    //Define tipo_maquetacion JJJ
                                                    if($registro_formulario["tipo_maquetacion"]=="responsive")
                                                        {
                                                            //Busca la clase asociada a la columna. Si no hay utiliza la ultima clase definida
                                                            $ArregloClasesColumnas=explode("|",$registro_formulario["css_columnas"]);
                                                            $ClaseColumna=$ArregloClasesColumnas[$cl-1];
                                                            if ($ClaseColumna!="") $UltimaClaseColumna=$ClaseColumna;
                                                            else $ClaseColumna=$UltimaClaseColumna;
                                                            //echo $ClaseColumna;
                                                            echo '<div class="'.$ClaseColumna.'">'; //col col-xs-3 col-sm-3 col-md-3 col-lg-3
                                                        }
                                                    //Define tipo_maquetacion
                                                    if($registro_formulario["tipo_maquetacion"]=="tradicional")
                                                        {
                                                            //Inicia columna de formulario
                                                            $PCO_AnchoColumnas=round(100 / $registro_formulario["columnas"]);
                                                            echo '<td width="'.$PCO_AnchoColumnas.'%" >';
                                                        }

                                                    // Crea los campos definidos por cada columna de formulario
                                                    while ($registro_campos = $consulta_campos->fetch())
                                                        {
                                                            //Determina si el estilo del objeto debe ser inline o no
                                                            $cadena_modo_inline='';
                                                            if ($registro_campos["modo_inline"])
                                                                $cadena_modo_inline='display:inline;';
                                                            echo '<div style="'.$cadena_modo_inline.'">';

                                                            //Imprime el campo solamente si no es fila unica, si es fila_unica guarda en una variable para uso posterior
                                                            if($registro_campos["fila_unica"]=="0")
                                                                {
                                                                    //Si esta en modo de diseno el formulario agrega elementos extra para la edicion de cada control
                                                                    $ComplementoDisenoElemento='';
                                                                    $ComplementoDisenoMarcoOpciones='';
                                                                    if ($modo_diseno_formulario)
                                                                        {
                                                                            $ComplementoDisenoElemento=PCO_AgregarFuncionesEdicionObjeto($registro_campos,$registro_formulario,"ComplementoDisenoElemento");
                                                                            $ComplementoDisenoMarcoOpciones=PCO_AgregarFuncionesEdicionObjeto($registro_campos,$registro_formulario,"ComplementoDisenoMarcoOpciones");
                                                                        }
                                                                    //Define el estilo del contenedor para el objeto
                                                                    $ClaseCSSContenedor="";
                                                                    if ($registro_campos["clase_contenedor"]!="") $ClaseCSSContenedor=$registro_campos["clase_contenedor"];
                                                                    echo '<div '.$ComplementoDisenoElemento.' id="PCOContenedor_'.$registro_campos["id_html"].'" class="'.$ClaseCSSContenedor.'" > '.$ComplementoDisenoMarcoOpciones;
                                                                    echo '<div id="PCOPre_'.$registro_campos["id_html"].'"></div>';
                                                                    
                                                                    //Agrega etiqueta para colapsar el control si aplica
                                                                    if ($registro_campos["etiqueta_colapsable"]!="") 
                                                                        echo '<details><summary>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["etiqueta_colapsable"]).'</summary>';
                                                                    
                                                                    // Formatea cada campo de acuerdo a su tipo
                                                                    // CUIDADO!!! Modificando las lineas de tipo siguientes debe modificar las lineas de tipo un poco mas abajo tambien
                                                                    $tipo_de_objeto=@$registro_campos["tipo"];
                                                                    switch ($tipo_de_objeto) {

                                                                        case 'texto_corto': $objeto_formateado = @PCO_CargarObjetoTextoCorto($registro_campos,@$registro_datos_formulario,$formulario,$en_ventana); break;
                                                                        case 'texto_clave': $objeto_formateado = @PCO_CargarObjetoTextoCorto($registro_campos,@$registro_datos_formulario,$formulario,$en_ventana); break;
                                                                        case 'texto_largo': $objeto_formateado = @PCO_CargarObjetoTextoLargo($registro_campos,@$registro_datos_formulario); break;
                                                                        case 'texto_formato': { $objeto_formateado = @PCO_CargarObjetoTextoFormato($registro_campos,@$registro_datos_formulario,$existe_campo_textoformato); $existe_campo_textoformato=1; } break;
                                                                        case 'area_responsive': $objeto_formateado = @PCO_CargarObjetoAreaResponsive($registro_campos,@$registro_datos_formulario); break;
                                                                        case 'lista_seleccion': $objeto_formateado = @PCO_CargarObjetoListaSeleccion($registro_campos,@$registro_datos_formulario,$formulario,$en_ventana); break;
                                                                        case 'lista_radio': $objeto_formateado = @PCO_CargarObjetoListaRadio($registro_campos,@$registro_datos_formulario,$formulario,$en_ventana); break;
                                                                        case 'casilla_check': $objeto_formateado = @PCO_CargarObjetoCasillaCheck($registro_campos,@$registro_datos_formulario,$formulario,$en_ventana); break;
                                                                        case 'etiqueta': $objeto_formateado = @PCO_CargarObjetoEtiqueta($registro_campos,@$registro_datos_formulario); break;
                                                                        case 'url_iframe': $objeto_formateado = @PCO_CargarObjetoIFrame($registro_campos,@$registro_datos_formulario); break;
                                                                        case 'informe': $informe_formateado=@PCO_CargarInforme($registro_campos["informe_vinculado"],$registro_campos["objeto_en_ventana"],"htm","Informes",1,$registro_campos["anular_acciones"],$registro_campos["anular_piepagina"],$registro_campos["anular_encabezado"]); break;
                                                                        case 'deslizador': $objeto_formateado = @PCO_CargarObjetoDeslizador($registro_campos,@$registro_datos_formulario); break;
                                                                        case 'campo_etiqueta': $objeto_formateado = @PCO_CargarObjetoCampoEtiqueta($registro_campos,@$registro_datos_formulario); break;
                                                                        case 'archivo_adjunto': $objeto_formateado = @PCO_CargarObjetoArchivoAdjunto($registro_campos,@$registro_datos_formulario); break;
                                                                        case 'objeto_canvas': $objeto_formateado = @PCO_CargarObjetoCanvas($registro_campos,@$registro_datos_formulario,$formulario); break;
                                                                        case 'objeto_camara': $objeto_formateado = @PCO_CargarObjetoCamara($registro_campos,@$registro_datos_formulario,$formulario); break;
                                                                        case 'boton_comando': $objeto_formateado = @PCO_CargarObjetoBotonComando($registro_campos,@$registro_datos_formulario,@$registro_formulario);
                                                                    }

                                                                    //Carga SubFormulario solo si no es el mismo actual para evitar ciclos infinitos

                                                                    //Ademas si es subformulario debe consultar en ese registro de ID buscado del form
                                                                    //padre el valor del campo foraneo del form hijo para llamar a buscar form con
                                                                    //el valor de Id correspondiente. Ademas valida si el form existe
                                                                    if ($tipo_de_objeto=="form_consulta" && $registro_campos["formulario_vinculado"]!=$formulario && PCO_ExisteValor($TablasCore."formulario","id",$registro_campos["formulario_vinculado"]))
                                                                        {
                                                                            //Busca la tabla principal del subformulario anidado
                                                                            $PCO_ValorCampoBind=$registro_campos["formulario_vinculado"];
                                                                            if($PCO_ValorCampoBind=="") $PCO_ValorCampoBind="";
                                                                            $consulta_tabla_subform=PCO_EjecutarSQL("SELECT tabla_datos FROM ".$TablasCore."formulario WHERE id=? ","$PCO_ValorCampoBind")->fetch();
                                                                            $PCO_TablaSubform=$consulta_tabla_subform["tabla_datos"];

                                                                            //Determina el valor del campo a vincular en el registro padre (el actual).  Deberia dar el id que se va a buscar
                                                                            $PCO_ValorCampoPadre=@$registro_datos_formulario[$registro_campos["formulario_campo_vinculo"]];
                                                                            //Si no se encuentra el dato o registro entonces mira si vienen desde un boton de busqueda y usa su valor
                                                                            if($PCO_ValorCampoPadre=="" && $PCO_ValorBusquedaBD!="")
                                                                                {
                                                                                    //$PCO_ValorCampoPadre=$PCO_ValorBusquedaBD;
                                                                                }
                                                                            //Si no obtiene ningun valor entonces lo pone en cero para evitar error de sintaxis en Bind de SQL
                                                                            if($PCO_ValorCampoPadre=="") $PCO_ValorCampoPadre=0;
                                                                            $PCO_CampoForaneoSubform=$registro_campos["formulario_campo_foraneo"];
                                                                            //Busca el ID de registro correspondiente en la tabla de datos para llamar con el valor coincidente
                                                                            $consulta_registro_subform=PCO_EjecutarSQL("SELECT $PCO_CampoForaneoSubform FROM $PCO_TablaSubform WHERE $PCO_CampoForaneoSubform=? ","$PCO_ValorCampoPadre")->fetch();

                                                                            $formulario_formateado=@PCO_CargarFormulario($registro_campos["formulario_vinculado"],$registro_campos["objeto_en_ventana"],$registro_campos["formulario_campo_foraneo"],$PCO_ValorCampoPadre,1,0,"Sub");
                                                                        }
                                                                    else
																		{
																			//Presenta mensaje de error al no poder empotrar subformulario
																			if($tipo_de_objeto=="form_consulta")
																				PCO_Mensaje($MULTILANG_ErrorTiempoEjecucion,$MULTILANG_ObjetoNoExiste.'.  FormID: '.$registro_campos["formulario_vinculado"], '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
																		}

                                                                    //Imprime el objeto siempre y cuando no sea uno preformateado por practico (informes, formularios, etc)
                                                                    if ($registro_campos["tipo"]!="informe" && $registro_campos["tipo"]!="form_consulta")
                                                                        echo $objeto_formateado;

                                                                    //Cierra la etiqueta colapsable en caso de haber abierto una
                                                                    if ($registro_campos["etiqueta_colapsable"]!="") 
                                                                        echo '</details>';
                                                                        
                                                                    echo '<div id="PCOPos_'.$registro_campos["id_html"].'"></div>';
                                                                    echo '</div>'; //Marco PCOContenedor
                                                                }

                                                            //Cierra el marco para el estilo inline del objeto
                                                            echo '</div>';
                                                        }

                                                    //Define tipo_maquetacion
                                                    if($registro_formulario["tipo_maquetacion"]=="responsive")
                                                        {
                                                            echo '</div>'; //Fin class=col
                                                        }
                                                    //Define tipo_maquetacion
                                                    if($registro_formulario["tipo_maquetacion"]=="tradicional")
                                                        {
                                                            echo '</td>'; //Fin columna de formulario
                                                        }
                                            }

                                        //Define tipo_maquetacion
                                        if($registro_formulario["tipo_maquetacion"]=="responsive")
                                            {
                                                echo '</div>'; //Fin class=row
                                            }
                                        //Define tipo_maquetacion
                                        if($registro_formulario["tipo_maquetacion"]=="tradicional")
                                            {
                                                // Finaliza la tabla con los campos
                                                echo '</tr></table>
                                                    </div>';
                                            }

                                        //Busca datos del registro de fila_unica
                                        $consulta_campos=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND id=? ","$formulario$_SeparadorCampos_$ultimo_id");
                                        $registro_campos = $consulta_campos->fetch();

                                        //Agrega el campo de fila unica cuando no se trata del agregado de peso 9999
                                        if ($registro_campos["visible"]=="1")
                                            {
                                                //echo '&nbsp;&nbsp;'.$registro_campos["titulo"];
                                                // Formatea cada campo de acuerdo a su tipo
                                                // CUIDADO!!! Modificando las lineas de tipo siguientes debe modificar las lineas de tipo un poco mas arriba tambien
                                                //Si esta en modo de diseno el formulario agrega elementos extra para la edicion de cada control
                                                $ComplementoDisenoElemento='';
                                                $ComplementoDisenoMarcoOpciones='';
                                                if ($modo_diseno_formulario)
                                                    {
                                                        $ComplementoDisenoElemento=PCO_AgregarFuncionesEdicionObjeto($registro_campos,$registro_formulario,"ComplementoDisenoElemento");
                                                        $ComplementoDisenoMarcoOpciones=PCO_AgregarFuncionesEdicionObjeto($registro_campos,$registro_formulario,"ComplementoDisenoMarcoOpciones");
                                                    }

                                                //Define el estilo del contenedor para el objeto
                                                $ClaseCSSContenedor="";
                                                if ($registro_campos["clase_contenedor"]!="") $ClaseCSSContenedor=$registro_campos["clase_contenedor"];

                                                echo '<div '.$ComplementoDisenoElemento.' id="PCOContenedor_'.$registro_campos["id_html"].'" class="'.$ClaseCSSContenedor.'" style="margin-top:0px; margin-bottom:0px; margin-left:0; margin-right:0;  padding: 0px; spacing: 0px;">'.$ComplementoDisenoMarcoOpciones.'';
                                                echo '<div id="PCOPre_'.$registro_campos["id_html"].'"></div>';

                                                //Agrega etiqueta para colapsar el control si aplica
                                                if ($registro_campos["etiqueta_colapsable"]!="") 
                                                    echo '<details><summary>'.PCO_ReemplazarVariablesPHPEnCadena($registro_campos["etiqueta_colapsable"]).'</summary>';
                                                    
                                                //Define tipo_maquetacion
                                                if($registro_formulario["tipo_maquetacion"]=="responsive")
                                                    {
                                                        echo '<div class="row"><div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12">';
                                                    }
                                                //Define tipo_maquetacion
                                                if($registro_formulario["tipo_maquetacion"]=="tradicional")
                                                    {
                                                        echo '<table class="table table-condensed btn-xs '.$estilo_bordes.'" style="'.$ancho_bordes.' margin-top:0; margin-bottom:0; margin-left:0; margin-right:0;  padding: 0px; border-spacing: 0px; width:100%; "><tr><td>';
                                                    }


                                                $tipo_de_objeto=@$registro_campos["tipo"];
                                                switch ($tipo_de_objeto) {

                                                    case 'texto_corto': $objeto_formateado = PCO_CargarObjetoTextoCorto($registro_campos,@$registro_datos_formulario,$formulario,$en_ventana); break;
                                                    case 'texto_clave': $objeto_formateado = PCO_CargarObjetoTextoCorto($registro_campos,@$registro_datos_formulario,$formulario,$en_ventana); break;
                                                    case 'texto_largo': $objeto_formateado = PCO_CargarObjetoTextoLargo($registro_campos,@$registro_datos_formulario); break;
                                                    case 'texto_formato': { $objeto_formateado = PCO_CargarObjetoTextoFormato($registro_campos,@$registro_datos_formulario,$existe_campo_textoformato); $existe_campo_textoformato=1; } break;
                                                    case 'area_responsive': $objeto_formateado = @PCO_CargarObjetoAreaResponsive($registro_campos,@$registro_datos_formulario); break;
                                                    case 'lista_seleccion': $objeto_formateado = PCO_CargarObjetoListaSeleccion($registro_campos,@$registro_datos_formulario,$formulario,$en_ventana); break;
                                                    case 'lista_radio': $objeto_formateado = PCO_CargarObjetoListaRadio($registro_campos,@$registro_datos_formulario,$formulario,$en_ventana); break;
                                                    case 'casilla_check': $objeto_formateado = @PCO_CargarObjetoCasillaCheck($registro_campos,@$registro_datos_formulario,$formulario,$en_ventana); break;
                                                    case 'etiqueta': $objeto_formateado = PCO_CargarObjetoEtiqueta($registro_campos,@$registro_datos_formulario); break;
                                                    case 'url_iframe': $objeto_formateado = PCO_CargarObjetoIFrame($registro_campos,@$registro_datos_formulario); break;
                                                    case 'informe': $informe_formateado=@PCO_CargarInforme($registro_campos["informe_vinculado"],$registro_campos["objeto_en_ventana"],"htm","Informes",1,$registro_campos["anular_acciones"],$registro_campos["anular_piepagina"],$registro_campos["anular_encabezado"]); break;
                                                    case 'deslizador': $objeto_formateado = @PCO_CargarObjetoDeslizador($registro_campos,@$registro_datos_formulario); break;
                                                    case 'campo_etiqueta': $objeto_formateado = @PCO_CargarObjetoCampoEtiqueta($registro_campos,@$registro_datos_formulario); break;
                                                    case 'archivo_adjunto': $objeto_formateado = @PCO_CargarObjetoArchivoAdjunto($registro_campos,@$registro_datos_formulario); break;
                                                    case 'objeto_canvas': $objeto_formateado = @PCO_CargarObjetoCanvas($registro_campos,@$registro_datos_formulario,$formulario); break;
                                                    case 'objeto_camara': $objeto_formateado = @PCO_CargarObjetoCamara($registro_campos,@$registro_datos_formulario,$formulario); break;
                                                    case 'boton_comando': $objeto_formateado = @PCO_CargarObjetoBotonComando($registro_campos,@$registro_datos_formulario,@$registro_formulario);
                                                }

                                                //Carga SubFormulario solo si no es el mismo actual para evitar ciclos infinitos
                                                //Ademas si es subformulario debe consultar en ese registro de ID buscado del form
                                                //padre el valor del campo foraneo del form hijo para llamar a buscar form con
                                                //el valor de Id correspondiente. Ademas valida si el form existe
                                                if ($tipo_de_objeto=="form_consulta" && $registro_campos["formulario_vinculado"]!=$formulario && PCO_ExisteValor($TablasCore."formulario","id",$registro_campos["formulario_vinculado"]))
                                                    {
                                                        //Busca la tabla principal del subformulario anidado
                                                        $PCO_ValorCampoBind=$registro_campos["formulario_vinculado"];
                                                        if($PCO_ValorCampoBind=="") $PCO_ValorCampoBind="";
                                                        $consulta_tabla_subform=PCO_EjecutarSQL("SELECT tabla_datos FROM ".$TablasCore."formulario WHERE id=? ","$PCO_ValorCampoBind")->fetch();
                                                        $PCO_TablaSubform=$consulta_tabla_subform["tabla_datos"];

                                                        //Determina el valor del campo a vincular en el registro padre (el actual).  Deberia dar el id que se va a buscar
                                                        $PCO_ValorCampoPadre=@$registro_datos_formulario[$registro_campos["formulario_campo_vinculo"]];
                                                        //Si no se encuentra el dato o registro entonces mira si vienen desde un boton de busqueda y usa su valor
                                                        if($PCO_ValorCampoPadre=="" && $PCO_ValorBusquedaBD!="")
                                                            {
                                                                //$PCO_ValorCampoPadre=$PCO_ValorBusquedaBD;
                                                            }
                                                        //Si no obtiene ningun valor entonces lo pone en cero para evitar error de sintaxis en Bind de SQL
                                                        if($PCO_ValorCampoPadre=="") $PCO_ValorCampoPadre=0;
                                                        $PCO_CampoForaneoSubform=$registro_campos["formulario_campo_foraneo"];
                                                        //Busca el ID de registro correspondiente en la tabla de datos para llamar con el valor coincidente
                                                        $consulta_registro_subform=PCO_EjecutarSQL("SELECT $PCO_CampoForaneoSubform FROM $PCO_TablaSubform WHERE $PCO_CampoForaneoSubform=? ","$PCO_ValorCampoPadre")->fetch();

                                                        $formulario_formateado=@PCO_CargarFormulario($registro_campos["formulario_vinculado"],$registro_campos["objeto_en_ventana"],$registro_campos["formulario_campo_foraneo"],$PCO_ValorCampoPadre,1,0,"Sub");
                                                    }
												else
													{
														//Presenta mensaje de error al no poder empotrar subformulario
														if($tipo_de_objeto=="form_consulta")
															PCO_Mensaje($MULTILANG_ErrorTiempoEjecucion,$MULTILANG_ObjetoNoExiste.'.  FormID: '.$registro_campos["formulario_vinculado"], '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
													}

                                                //Imprime el objeto siempre y cuando no sea uno preformateado por practico (informes, formularios, etc)
                                                if ($registro_campos["tipo"]!="informe" && $registro_campos["tipo"]!="form_consulta")
                                                    echo $objeto_formateado;

                                                //Define tipo_maquetacion
                                                if($registro_formulario["tipo_maquetacion"]=="responsive")
                                                    {
                                                        echo '</div></div>'; //Fin class=row y class=col
                                                    }
                                                //Define tipo_maquetacion
                                                if($registro_formulario["tipo_maquetacion"]=="tradicional")
                                                    {
                                                        echo '</td></tr></table>';
                                                    }

                                                //Cierra la etiqueta colapsable en caso de haber abierto una
                                                if ($registro_campos["etiqueta_colapsable"]!="") 
                                                    echo '</details>';

                                                echo '<div id="PCOPos_'.$registro_campos["id_html"].'"></div>';
                                                echo '</div>'; //Marco PCOContenedor
                                            }

                                        //Actualiza limite inferior para siguiente lista de campos
                                        $limite_inferior=$registro_obj_fila_unica["PCOBD_Peso"];
                                        $TabIndex_Elemento++;
                                    }

                        if ($conteo_pestanas>1  || $conteo_pestanas_ocultas==1)
                        echo '
                            </div>
                        <!-- FIN de las pestanas No '.$pestana_activa.'-->';

                        //Limpia para las siguientes pestanas
                        $estado_activa_primera_pestana='';
                        $pestana_activa++;
                    }
                //Fin de los tab-content
                echo '</div>';
            } //Fin Si conteo pestanas > 0

		echo '</div> <!-- cierra PCO_MarcoImpresion'.$formulario.' -->';

	//Busca los campos definidos como visilbe=0 (o NO) para agregarlos como hidden
	$consulta_ocultos=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND visible=0 ","$formulario");
	while ($registro_ocultos = $consulta_ocultos->fetch())
		{
			// Formatea cada campo de acuerdo a su tipo
			$objeto_formateado = @PCO_CargarObjetoOculto($registro_ocultos,$registro_datos_formulario,$formulario,$en_ventana);
			//Imprime el objeto siempre y cuando no sea uno preformateado por practico (informes, formularios, etc)
			if ($registro_campos["tipo"]!="informe" && $registro_campos["tipo"]!="form_consulta" && $registro_campos["tipo"]!="boton_comando")
				echo $objeto_formateado;
		}

	// Si tiene botones agrega barra de estado y los ubica
	$consulta_botones = PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_boton." FROM ".$TablasCore."formulario_boton WHERE formulario=? AND visible=1 ORDER BY peso","$formulario");

	if($consulta_botones->rowCount()>0 || $PCO_InformeFiltro!="") //Crea la barra incluso si no hay botones en diseno pero se encuentra que el llamado es desde un informe que requiere filtro
		{
			PCO_AbrirBarraEstado();
            echo '<div align="center">';
			while ($registro_botones = $consulta_botones->fetch())
				{
					//Transfiere variables de mensajes de retorno asociadas al boton
					$comando_javascript="";
					if ($registro_botones["retorno_titulo"]!="")
						$comando_javascript="document.".$registro_formulario["id_html"].".PCO_ErrorTitulo.value='".$registro_botones["retorno_titulo"]."'; document.".$registro_formulario["id_html"].".PCO_ErrorDescripcion.value='".$registro_botones["retorno_texto"]."'; document.".$registro_formulario["id_html"].".PCO_ErrorIcono.value='".$registro_botones["retorno_icono"]."'; document.".$registro_formulario["id_html"].".PCO_ErrorEstilo.value='".$registro_botones["retorno_estilo"]."';";

					//Define el tipo de boton de acuerdo al tipo de accion
          switch ($registro_botones["tipo_accion"]) {

                case 'interna_guardar':    $comando_javascript.="PCOJS_ValidarCamposYProcesarFormulario('".$registro_formulario["id_html"]."');";     break;
                case 'interna_limpiar':    $comando_javascript.="document.getElementById('".$registro_formulario["id_html"]."').reset();"; break;
                case 'interna_escritorio': $comando_javascript.="document.PCO_FormVerMenu.submit();"; break;
                case 'interna_actualizar': $comando_javascript.="document.".$registro_formulario["id_html"].".PCO_Accion.value='PCO_ActualizarDatosFormulario'; PCOJS_ValidarCamposYProcesarFormulario('".$registro_formulario["id_html"]."');"; break;
                case 'externa_postcode':   $comando_javascript.="document.".$registro_formulario["id_html"].".PCO_Accion.value='PCO_EjecutarPostAccionForm'; PCOJS_ValidarCamposYProcesarFormulario('".$registro_formulario["id_html"]."'); "; break;
                case 'interna_eliminar':   $comando_javascript.="document.".$registro_formulario["id_html"].".PCO_Accion.value='PCO_EliminarDatosFormulario';document.".$registro_formulario["id_html"].".submit();"; break;
                case 'interna_cargar':     $comando_javascript.="document.".$registro_formulario["id_html"].".PCO_Accion.value='PCO_CargarObjeto';document.".$registro_formulario["id_html"].".PCO_Objeto.value='".$registro_botones["accion_usuario"]."'; PCOJS_SanitizarValoresListaMultiple(); document.".$registro_formulario["id_html"].".submit(); "; break;
                case 'externa_formulario': $comando_javascript.="document.".$registro_formulario["id_html"].".PCO_Accion.value='".$registro_botones["accion_usuario"]."';  PCOJS_SanitizarValoresListaMultiple(); document.".$registro_formulario["id_html"].".submit(); "; break;
                case 'externa_javascript': $comando_javascript.=$registro_botones["accion_usuario"];
          }


                    //Verifica si el registro de botones presenta algun texto de confirmacion y lo antepone al script
                    $cadena_confirmacion_accion_pre="";
                    $cadena_confirmacion_accion_pos="";
					if ($registro_botones["confirmacion_texto"]!="")
						{
							$cadena_confirmacion_accion_pre=" if (confirm('".PCO_ReemplazarVariablesPHPEnCadena($registro_botones["confirmacion_texto"])."')) {";
							$cadena_confirmacion_accion_pos=" } else {} ";
						}

                    //Genera la cadena del enlace
                    $cadena_javascript='href="javascript:  '.$cadena_confirmacion_accion_pre.'  '.@$comando_javascript.'  '.$cadena_confirmacion_accion_pos.'  "';

					//Si no se especifica un estilo para el boton entonces se usa el predeterminado
                    $estilo_basico_boton="btn btn-default";
                    //Si el boton tiene definido un ID lo agrega
                    $CadenaIDHtml='';
                    if ($registro_botones["id_html"]!="") $CadenaIDHtml=' id="'.$registro_botones["id_html"].'" ';
                    echo '<a '.$CadenaIDHtml.' class="'.$estilo_basico_boton.' '.$registro_botones["estilo"].'" '.@$cadena_javascript.'>'.PCO_ReemplazarVariablesPHPEnCadena($registro_botones["titulo"]).'</a>';

                    echo '&nbsp;&nbsp;'; //Agrega espacio temporal entre controles
				}

			if ($PCO_InformeFiltro!="")
				{
					//Si se encuentra que el form viene llamado desde un informe que lo requiere para filtro agrega un boton de retorno al informe automaticamente
					$comando_javascript="document.".$registro_formulario["id_html"].".PCO_Accion.value='PCO_CargarObjeto';document.".$registro_formulario["id_html"].".PCO_Objeto.value='inf:".$PCO_InformeFiltro.":1';document.".$registro_formulario["id_html"].".submit();";
					$cadena_javascript='href="javascript:'.@$comando_javascript.'"';
					echo '<a class="'.$estilo_basico_boton.' btn btn-warning" '.@$cadena_javascript.'>'.$MULTILANG_InfRetornoFormFiltrado.'</a>';
				}

            echo '</div>';
			PCO_CerrarBarraEstado();
		}


	//Cierra todo el formulario
	//Si se quiere anular el formulario y su accion cuando se trata de un sub-formulario de consulta
	if (!$anular_form)
		echo '</form>';

	//Carga todos los eventos asociados a los controles de formulario
	$eventos_controles_formulario=PCO_EjecutarSQL("SELECT ".$TablasCore."evento_objeto.*,".$TablasCore."formulario_objeto.id_html FROM ".$TablasCore."evento_objeto,".$TablasCore."formulario_objeto WHERE ".$TablasCore."evento_objeto.objeto=".$TablasCore."formulario_objeto.id  AND ".$TablasCore."formulario_objeto.formulario=$formulario ");
	while($registro_eventos_definidos = $eventos_controles_formulario->fetch())
		{
		    //Limpia el metodo, asume no conocerlo

            switch ($registro_eventos_definidos["evento"]) {
              //1-Raton
              case 'onclick': $MetodoJQuery="click"; break;
              case 'ondblclick': $MetodoJQuery="dblclick"; break;
              case 'onmousedown': $MetodoJQuery="mousedown"; break;
              case 'onmouseenter': $MetodoJQuery="mouseenter"; break;
              case 'onmouseleave': $MetodoJQuery="mouseleave"; break;
              case 'onmousemove': $MetodoJQuery="mousemove"; break;
              case 'onmouseover': $MetodoJQuery="mouseover"; break;
              case 'onmouseout': $MetodoJQuery="mouseout"; break;
              case 'onmouseup': $MetodoJQuery="mouseup"; break;
              case 'contextmenu': $MetodoJQuery="contextmenu"; break;
              //2-Teclado
              case 'onkeydown': $MetodoJQuery="keydown"; break;
              case 'onkeypress': $MetodoJQuery="keypress"; break;
              case 'onkeyup': $MetodoJQuery="keyup"; break;
              //3-Formularios
              case 'onfocus': $MetodoJQuery="focus"; break;
              case 'onblur': $MetodoJQuery="blur"; break;
              case 'onchange': $MetodoJQuery="change"; break;
              case 'onselect': $MetodoJQuery="select"; break;
              case 'onsubmit': $MetodoJQuery="submit"; break;
              case 'oncut': $MetodoJQuery="reset"; break;
              case 'oncopy': $MetodoJQuery="click"; break;
              case 'onpaste': $MetodoJQuery="click"; break;
              default:
                $MetodoJQuery="";
            }

			//Imprime el script asociado al evento siempre y cuando la funcion sea reconocida
			if ($MetodoJQuery!="")
			    {
					$PCO_FuncionesJSInternasFORM .= '
					    <script language=\'JavaScript\'>
                            $( "#'.$registro_eventos_definidos["id_html"].'" ).on("'.$MetodoJQuery.'",function(PCOJS_Evento) {
                              '.PCO_ReemplazarVariablesPHPEnCadena($registro_eventos_definidos["javascript"]).'
                            });
					    </script>';
			    }
		}

        //Carga las funciones JavaScript asociadas al formulario y llama la funcion FrmAutoRun()
        $JavaScriptFormulario=PCO_ReemplazarVariablesPHPEnCadena($registro_formulario["javascript"]);

        //Minimiza el codigo JavaScript del formulario
        //$JavaScriptFormulario=PCO_Minimizador_OptimizarJS($JavaScriptFormulario);

        //Reemplaza la funcion de FrmAutoRun() del formulario por FrmAutoRun_IDFormulario() para garantizar que es unica
        $NumeroIdFormulario=$registro_formulario["id"];
        if ($NumeroIdFormulario<0) $NumeroIdFormulario="LTZ".($NumeroIdFormulario*-1);
        $JavaScriptFormulario=str_replace("FrmAutoRun()","FrmAutoRun_IDForm".$NumeroIdFormulario."()",$JavaScriptFormulario);
        	$PCO_FuncionesJSInternasFORM .= '<script type="text/javascript">'.$JavaScriptFormulario.'
        		if (typeof FrmAutoRun_IDForm'.$NumeroIdFormulario.' === "function") { FrmAutoRun_IDForm'.$NumeroIdFormulario.'(); }
        		</script>';

        //Busca la lista de campos marcados como obligatorios sobre el form
        $consulta_campos_obligatorios=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_formulario_objeto." FROM ".$TablasCore."formulario_objeto WHERE formulario=? AND obligatorio=1","$formulario");
        $ListaCamposObligatorios="";
        $ListaTitulosObligatorios="";
        while ($registro_campos_obligatorios=$consulta_campos_obligatorios->fetch())
            {
                $ListaCamposObligatorios.="|".$registro_campos_obligatorios["id_html"];
                $ListaTitulosObligatorios.="|".$registro_campos_obligatorios["titulo"];
            }
        $POSTForm_ListaCamposObligatorios.=$ListaCamposObligatorios;
        $POSTForm_ListaTitulosObligatorios.=$ListaTitulosObligatorios;

        if ($en_ventana) PCO_CerrarVentana();
  }


########################################################################
########################################################################
/*
	Function: PCO_GenerarBotonesInforme
	Genera el codigo HTML correspondiente a los botones definidos para cada registro de un informe indicado por su ID

	Variables de entrada:

		informe - ID unico del informe del cual se desea construir el query

	Salida:

		HTML con los botones

	Ver tambien:
		<PCO_CargarInforme>
*/
function PCO_GenerarBotonesInforme($informe,$Ubicacion=0)
	{
		global $ConexionPDO,$ArchivoCORE,$TablasCore,$PCO_ValorBusquedaBD,$PCO_CampoBusquedaBD;
		// Carga variables de sesion por si son comparadas en alguna condicion.  De todas formas pueden ser cargadas por el usuario en el diseno del informe
		global $ListaCamposSinID_informe,$ListaCamposSinID_informe_campos,$ListaCamposSinID_informe_tablas,$ListaCamposSinID_informe_condiciones,$ListaCamposSinID_informe_boton;

		$ComplementoUbicacion=' AND ubicar_principio=0 ';
		if ($Ubicacion==1)
		    $ComplementoUbicacion=' AND ubicar_principio=1 ';

		//Inicializa la cadena de botones vacia
		$cadena_generica_botones='';

		// Busca si el informe tiene acciones (botones), los cuenta y prepara dentro de un arreglo para repetir en cada registro
		$consulta_botones=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_informe_boton." FROM ".$TablasCore."informe_boton WHERE informe=? AND visible=1 $ComplementoUbicacion ORDER BY peso","$informe");
		while($registro_botones=$consulta_botones->fetch())
			{
				$destino_formulario=$registro_botones["destino"];
				$pantalla_completa_formulario=$registro_botones["pantalla_completa"];
				$precargar_estilos_formulario=$registro_botones["precargar_estilos"];
				//Construye una cadena generica con todos los botones para ser reemplazada luego con valores
				if ($registro_botones["tipo_accion"]=="interna_eliminar")
					{
						$valores = explode(".",$registro_botones["accion_usuario"]);
						$tabla_vinculada=@$valores[0];
						$campo_vinculado=@$valores[1];

						//Si solo se indico el campo, sin la tabla, intenta usar solo el campo
						if ($campo_vinculado=="" && $tabla_vinculada!="")
							{
								$campo_vinculado=$valores[0];
								$tabla_vinculada="";
							}

						$comando_javascript="
							document.FRMBASEINFORME.PCO_Accion.value='PCO_EliminarRegistroInforme';
							document.FRMBASEINFORME.tabla.value='".@$tabla_vinculada."';
							document.FRMBASEINFORME.campo.value='".@$campo_vinculado."';
							document.FRMBASEINFORME.valor.value='DELFRMVALVALOR';
							document.FRMBASEINFORME.Precarga_EstilosBS.value='".@$precargar_estilos_formulario."';
							document.FRMBASEINFORME.Presentar_FullScreen.value='".@$pantalla_completa_formulario."';
							document.FRMBASEINFORME.target = '".@$destino_formulario."';
							document.FRMBASEINFORME.submit();";
					}
				if ($registro_botones["tipo_accion"]=="interna_cargar")
					{
						$comando_javascript="
							document.FRMBASEINFORME.PCO_Accion.value='PCO_CargarObjeto';
							document.FRMBASEINFORME.PCO_Objeto.value='frm:".$registro_botones["accion_usuario"].":DETFRMVALBASE';
							document.FRMBASEINFORME.Precarga_EstilosBS.value='".@$precargar_estilos_formulario."';
							document.FRMBASEINFORME.Presentar_FullScreen.value='".@$pantalla_completa_formulario."';
							document.FRMBASEINFORME.target = '".@$destino_formulario."';
							document.FRMBASEINFORME.submit();";
					}
				if ($registro_botones["tipo_accion"]=="interna_cargar_informe")
					{
						$comando_javascript="
							document.FRMBASEINFORME.PCO_Accion.value='PCO_CargarObjeto';
							document.FRMBASEINFORME.PCO_Objeto.value='inf:".$registro_botones["accion_usuario"].":DETFRMVALBASE';
							document.FRMBASEINFORME.Precarga_EstilosBS.value='".@$precargar_estilos_formulario."';
							document.FRMBASEINFORME.Presentar_FullScreen.value='".@$pantalla_completa_formulario."';
							document.FRMBASEINFORME.target = '".@$destino_formulario."';
							document.FRMBASEINFORME.submit();";
					}
				if ($registro_botones["tipo_accion"]=="externa_formulario")
					{
						$comando_javascript="
							document.FRMBASEINFORME.PCO_Tabla.value='".@$tabla_vinculada."';
							document.FRMBASEINFORME.PCO_Campo.value='".@$campo_vinculado."';
							document.FRMBASEINFORME.PCO_Valor.value='DELFRMVALVALOR';
							document.FRMBASEINFORME.PCO_Accion.value='".$registro_botones["accion_usuario"]."';
							document.FRMBASEINFORME.Precarga_EstilosBS.value='".@$precargar_estilos_formulario."';
							document.FRMBASEINFORME.Presentar_FullScreen.value='".@$pantalla_completa_formulario."';
							document.FRMBASEINFORME.target = '".@$destino_formulario."';
							document.FRMBASEINFORME.submit();";
					}
				if ($registro_botones["tipo_accion"]=="externa_javascript")
					{
						$comando_javascript="
							document.FRMBASEINFORME.PCO_Valor.value='DELFRMVALVALOR';  ";
						$comando_javascript.=$registro_botones["accion_usuario"];
					}

				//Verifica si el registro de botones presenta algun texto de confirmacion y lo antepone al script
				$cadena_confirmacion_accion_pre="";
				$cadena_confirmacion_accion_pos="";
				if ($registro_botones["confirmacion_texto"]!="")
					{
						$cadena_confirmacion_accion_pre=" if (confirm('".PCO_ReemplazarVariablesPHPEnCadena($registro_botones["confirmacion_texto"])."')) {";
						$cadena_confirmacion_accion_pos=" } else {} ";
					}

				//Genera la cadena del enlace
				$cadena_javascript='onclick="'.$cadena_confirmacion_accion_pre.'  '.@$comando_javascript.'  '.$cadena_confirmacion_accion_pos.' "';
				//Determina si el boton llevara texto o si el texto se usa como ayuda.  Por defecto siempre se agrega el texto por defecto.
				$Cadena_Imagen="";
				$Cadena_Ayuda="";
				$Cadena_BotonIzq="";
				$Cadena_BotonDer=" ".$registro_botones["titulo"];
				//Determina si debe o no poner un elemento de imagen y si sera imagen con texto o sola
				if ($registro_botones["imagen"]!="")
					{
						$Cadena_Imagen="<i class='fa ".$registro_botones["imagen"]."'></i>";
						$Cadena_BotonIzq="";
						$Cadena_BotonDer="";
						$Cadena_Ayuda='data-toggle="tooltip" data-html="true" data-placement="auto" title="'.PCO_ReemplazarVariablesPHPEnCadena($registro_botones["titulo"]).'"';
					    //Busca si dentro de la imagen se especifico la palabra clave _TEXTOIZQ_ o _TEXTODER_ para agregar ademas el texto
					    if( strrpos ( $registro_botones["imagen"], "_TEXTOIZQ_" )!==false || strrpos ( $registro_botones["imagen"], "_TEXTODER_" )!==false )
					        {
						        $Cadena_Ayuda=''; //En cualquier caso donde se pida imprimir texto se elimina el tooltip
						        $Cadena_Imagen="<i class='fa ".$registro_botones["imagen"]."'></i>";
					            //Si se detecta el texto a la izquierda ajusta las variables para tal impresion
        					    if( strrpos ( $registro_botones["imagen"], "_TEXTOIZQ_" )!==false)
						            $Cadena_BotonIzq=$registro_botones["titulo"]." ";
					            //Si se detecta el texto a la derecha ajusta las variables para tal impresion
        					    if( strrpos ( $registro_botones["imagen"], "_TEXTODER_" )!==false)
						            $Cadena_BotonDer=" ".$registro_botones["titulo"];
					        }
					}
                $Cadena_BotonIzq=PCO_ReemplazarVariablesPHPEnCadena($Cadena_BotonIzq);
                $Cadena_BotonDer=PCO_ReemplazarVariablesPHPEnCadena($Cadena_BotonDer);
				@$cadena_generica_botones.='<button type="button" class="'.$registro_botones["estilo"].'" '.$Cadena_Ayuda.' '.$cadena_javascript.'>'.$Cadena_BotonIzq.$Cadena_Imagen.$Cadena_BotonDer.'</button>&nbsp;';
			}
		return $cadena_generica_botones;
	}


########################################################################
########################################################################
/*
	Function: PCO_DeterminarCamposOcultos
	Devuelve la lista de campos establecidos como ocultos para un informe determinado

	Variables de entrada:

		informe - ID unico del informe del cual se desea conocer los campos ocultos

	Salida:

		Arreglo con la lista de campos ocultos

	Ver tambien:
		<PCO_CargarInforme>
*/
function PCO_DeterminarCamposOcultos($informe)
	{
		global $TablasCore;
		// Carga variables de definicion de tablas
		global $ListaCamposSinID_informe_campos;

		//Busca los CAMPOS definidos para el informe
		$consulta_campos=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_informe_campos." FROM ".$TablasCore."informe_campos WHERE informe=? ORDER BY peso","$informe");

		$PCO_ColumnasOcultas=array();
		while ($registro_campos = $consulta_campos->fetch())
			{
				//Si tiene alias definido lo agrega
				$posfijo_campo="";
				if ($registro_campos["valor_alias"]!="") $posfijo_campo=" as ".$registro_campos["valor_alias"];
				//Agrega al arreglo con los campos marcados como ocultos
				if ($registro_campos["visible"]==0)
					{
						$PCO_ColumnasOcultas[]=$registro_campos["valor_campo"].$posfijo_campo;
						//Lleva el campo oculto despues del punto
						$PCO_PartesCampo=explode(".",$registro_campos["valor_campo"].$posfijo_campo);
						@$PCO_ColumnasOcultas[]=$PCO_PartesCampo[1];
						//Lleva el campo oculto si es un alias
						$PCO_PartesCampo=explode(" as ",$registro_campos["valor_campo"].$posfijo_campo);
						$PCO_ColumnasOcultas[]=$PCO_PartesCampo[1];
					}
			}
		return $PCO_ColumnasOcultas;
	}


########################################################################
########################################################################
/*
	Function: PCO_ConstruirConsultaInforme
	Genera el codigo SQL correspondiente a informe especifico por ID, es la consulta cruda de los datos para ser aplicada posteriormente a otra operacion

	Variables de entrada:

		informe - ID unico del informe del cual se desea construir el query
		evitar_campos_ocultos - Determina si los campos ocultos son agregados o no dentro del query.  Util cuando no se desean dentro de informes exportados.

	Salida:

		SQL con el query requerido por el informe

	Ver tambien:
		<PCO_CargarInforme>
*/
function PCO_ConstruirConsultaInforme($informe,$evitar_campos_ocultos=0)
	{
		global $ConexionPDO,$ArchivoCORE,$TablasCore,$PCO_ValorBusquedaBD,$PCO_CampoBusquedaBD;
		// Carga variables de sesion por si son comparadas en alguna condicion.  De todas formas pueden ser cargadas por el usuario en el diseno del informe
		global $PCOSESS_LoginUsuario,$Nombre_usuario,$Descripcion_usuario,$Nivel_usuario,$Correo_usuario,$LlaveDePasoUsuario,$PCO_FechaOperacion;
		// Carga variables de definicion de tablas
		global $ListaCamposSinID_informe,$ListaCamposSinID_informe_campos,$ListaCamposSinID_informe_tablas,$ListaCamposSinID_informe_condiciones,$ListaCamposSinID_informe_boton;

		//Si se desea evitar los campos ocultos entonces los busca
		if ($evitar_campos_ocultos==1)
			$PCO_ColumnasOcultas=PCO_DeterminarCamposOcultos($informe);

			// Inicia CONSTRUCCION DE CONSULTA DINAMICA
			$numero_columnas=0;
			//Busca los CAMPOS definidos para el informe
			$consulta="SELECT ";
			$consulta_campos=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_informe_campos." FROM ".$TablasCore."informe_campos WHERE informe=? ORDER BY peso,id","$informe");

			while ($registro_campos = $consulta_campos->fetch())
				{
					//Si tiene alias definido lo agrega
					$posfijo_campo="";
					if ($registro_campos["valor_alias"]!="") $posfijo_campo=" as ".$registro_campos["valor_alias"];

					$OrigenValorCampo=$registro_campos["valor_campo"];
					//Evalua casos donde se tienen variables PHP escapadas por llaves.  Ej  "%{$Variable}%" si fuera para una operacion cualquiera sobre el campo.
                    $OrigenValorCampo=PCO_ReemplazarVariablesPHPEnCadena($OrigenValorCampo);
					$nombre_campo=$OrigenValorCampo.$posfijo_campo;
					
					//Compatibilidad PHP 8+.  Si no recibe nada lo convierte a array para garantizar el tipo en in_array
					if (gettype($PCO_ColumnasOcultas)!="array")
					    $PCO_ColumnasOcultas=array();

					//Agrega el campo a la consulta si no se encuentra en el arreglo de ocultos o no se quieren evitar esos campos
					if (@!in_array($nombre_campo,$PCO_ColumnasOcultas) || $evitar_campos_ocultos==0)
						$consulta.=$nombre_campo.",";
				}

			// Elimina la ultima coma en el listado de campos
			$consulta=substr($consulta, 0, strlen($consulta)-1);

			//Busca las TABLAS definidas para el informe
			$consulta.=" FROM ";
			$consulta_tablas=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_informe_tablas." FROM ".$TablasCore."informe_tablas WHERE informe=? ","$informe");
			while ($registro_tablas = $consulta_tablas->fetch())
				{
					//Si tiene alias definido lo agrega
					$posfijo_tabla="";
					if ($registro_tablas["valor_alias"]!="") $posfijo_tabla=" as ".PCO_ReemplazarVariablesPHPEnCadena($registro_tablas["valor_alias"]);
					//Agrega tabla a la consulta
					$consulta.=PCO_ReemplazarVariablesPHPEnCadena($registro_tablas["valor_tabla"]).$posfijo_tabla.",";
				}
			// Elimina la ultima coma en el listado de tablas
			$consulta=substr($consulta, 0, strlen($consulta)-1);

			// Busca las CONDICIONES para el informe
			$consulta.=" WHERE ";
			$consulta_condiciones=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_informe_condiciones." FROM ".$TablasCore."informe_condiciones WHERE informe=? ORDER BY peso,id","$informe");
			$hay_condiciones=0;
			while ($registro_condiciones = $consulta_condiciones->fetch())
				{
					//Agrega condicion a la consulta
					$valor_izquierdo=$registro_condiciones["valor_izq"];
					$valor_derecho=$registro_condiciones["valor_der"];
					//Evalua casos donde se tienen variables PHP escapadas por llaves.  Ej  "%{$Variable}%" si fuera para un LIKE, por ejemplo.
                    $valor_izquierdo=PCO_ReemplazarVariablesPHPEnCadena($valor_izquierdo);
                    $valor_derecho=PCO_ReemplazarVariablesPHPEnCadena($valor_derecho);

					$consulta.=" ".$valor_izquierdo." ".$registro_condiciones["operador"]." ".$valor_derecho." ";
					$hay_condiciones=1;
				}
			if (!$hay_condiciones)
			$consulta.=" 1 ";

			//Busca si debe ser ordenado o agrupado
			$registro_informe=PCO_EjecutarSQL("SELECT agrupamiento,ordenamiento FROM ".$TablasCore."informe WHERE id=? ","$informe")->fetch();
			if (@$registro_informe["agrupamiento"]!="")
				{
					$campoagrupa=$registro_informe["agrupamiento"];
					$consulta.= " GROUP BY $campoagrupa";
				}

			if (@$registro_informe["ordenamiento"]!="")
				{
					$campoorden=$registro_informe["ordenamiento"];
					$consulta.= " ORDER BY $campoorden";
				}

		return $consulta;
	}


########################################################################
########################################################################
/*
	Function: PCO_GenerarEtiquetasConsulta
	Genera una lista separadas por coma con las etiqeutas asociadas a un query SQL

	Variables de entrada:

		ConsultaSQL - La consulta en SQL que generara las etiquetas
		informe - Si se recibe un ID de informe lo usa para conoecr sus columnas ocultas

	Salida:

		* Variable de tipo arreglo con los Resultados para ColumnasVisibles, NumerosColumnasOcultas y NumeroColumnas

	Ver tambien:
		<PCO_CargarInforme>
*/
function PCO_GenerarEtiquetasConsulta($ConsultaSQL,$informe)
	{
		global $ConexionPDO,$ArchivoCORE,$TablasCore,$PCO_ValorBusquedaBD,$PCO_CampoBusquedaBD;
		// Carga variables de sesion por si son comparadas en alguna condicion.  De todas formas pueden ser cargadas por el usuario en el diseno del informe
		global $ListaCamposSinID_informe,$ListaCamposSinID_informe_campos,$ListaCamposSinID_informe_tablas,$ListaCamposSinID_informe_condiciones,$ListaCamposSinID_informe_boton;

        $PCO_ColumnasVisibles=array();
        $PCO_NumerosColumnasOcultas=array();

		// Busca datos del informe
        if ($informe!="")
        	$registro_informe=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_informe." FROM ".$TablasCore."informe WHERE id=? ","$informe")->fetch();

        //Si encuentra que el informe usa conexion alterna accesa la variable de conexion como global
        if($registro_informe["conexion_origen_datos"]!="")
    		global ${$registro_informe["conexion_origen_datos"]};

		//Averigua cuales columnas estan definidas como ocultas
		if ($informe!="")
			$ColumnasOcultas=PCO_DeterminarCamposOcultos($informe);

		//Si se recibe un query sigue adelante
		if ($ConsultaSQL!="")
			{
				// Imprime encabezados de columna si encuentra al menos un registro
                //Si el informe usa una conexion externa usa su configuracion
                if($registro_informe["conexion_origen_datos"]!="")
                    $resultado_columnas=@PCO_EjecutarSQL($ConsultaSQL,"",${$registro_informe["conexion_origen_datos"]},1); //${$registro_informe["conexion_origen_datos"]}
                else
                    $resultado_columnas=@PCO_EjecutarSQL($ConsultaSQL);

				//Procesa resultados solo si es diferente de 1 que es el valor retornado cuando hay errores evitando el fatal error del fetch(), rowCount() y demas metodos
				if ($resultado_columnas!="1")
					$ConteoRegistros=$resultado_columnas->rowCount();

				//Si se tienen registros para mirar las columnas las agrega
				if ($ConteoRegistros>0)
					{
                        $numero_columnas=0;
                        foreach($resultado_columnas->fetch(PDO::FETCH_ASSOC) as $key=>$val)
                            {
                                //Imprime el encabezado siempre y cuando no se trate de un campo que se desea ocultar
                                if (!in_array($key,$ColumnasOcultas))
									{
										$PCO_ColumnasVisibles[]=$key;
									}
								else
									{
										//Agrega la columna al indice de columnas ocultas para no mostrarla luego
										$PCO_NumerosColumnasOcultas[]=$numero_columnas;
									}
								$numero_columnas++;
                            }
                    }
			}
		@$Resultados[]=array("ColumnasVisibles" => $PCO_ColumnasVisibles, "NumerosColumnasOcultas"=>$PCO_NumerosColumnasOcultas	,"NumeroColumnas" => $numero_columnas);
		return $Resultados;
	}


########################################################################
########################################################################
/*
	Function: PCO_CamposRealesInforme
	Retorna un arreglo con nombres de campos completos, sus nombres reales en base de datos y los nombres de las tablas correspondientes

	Variables de entrada:

		informe - ID de informe lo usa para conocer todas sus columnas

	Salida:

		* Variable de tipo arreglo con los Resultados

	Ver tambien:
		<PCO_CargarInforme>
*/
function PCO_CamposRealesInforme($informe)
	{
		global $ConexionPDO,$ArchivoCORE,$TablasCore;
		global $ListaCamposSinID_informe,$ListaCamposSinID_informe_campos,$ListaCamposSinID_informe_tablas;

		// Busca datos del informe
        if ($informe!="")
            {
        		$consulta_informe=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_informe." FROM ".$TablasCore."informe WHERE id=? ","$informe");
        		$registro_informe=$consulta_informe->fetch();

        		if ($registro_informe["conexion_origen_datos"]!="")
        		    global ${$registro_informe["conexion_origen_datos"]};
            }

			//Busca los CAMPOS definidos para el informe y sus TABLAS correspondientes
			$ListaCampos_NombreCompleto=array();	//Nombre completo del campo
			$ListaCampos_NombreSimple=array();		//Lado izquierdo solamente cuando se cuenta con Alias
			$ListaTablas_NombreSimple=array();		//Nombre de la tabla de donde sale el campo
			$ListaCampos_PermitirEdicion=array();	//Guarda los estados de edicion en linea para el campo
			$consulta_campos=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_informe_campos." FROM ".$TablasCore."informe_campos WHERE informe=? ORDER BY peso,id","$informe");
			while ($registro_campos = $consulta_campos->fetch())
				{
					//Si tiene alias definido lo agrega
					$posfijo_campo="";
					if ($registro_campos["valor_alias"]!="") $posfijo_campo=" as ".$registro_campos["valor_alias"];
					$nombre_campo=$registro_campos["valor_campo"].$posfijo_campo;

					//Agrega el campo a la lista de nombres completos
					$ListaCampos_NombreCompleto[]=$nombre_campo;

					//Agrega el estado de edicion o no para el campo
					$ListaCampos_PermitirEdicion[]=$registro_campos["editable"];

					//Establece el nombre del campo simple (el real en base de datos)
						//Elimina la posibilidad de un alias " as " tomando la primera parte solamente
						$PartesListaCampos_NombreCompleto=explode(" as ",$nombre_campo);
						$nombre_campo_simple=$PartesListaCampos_NombreCompleto[0];
						//Elimina la posibilidad de un punto " . " indicando la tabla
						if (strpos($nombre_campo_simple,"."))
							{
								$PartesListaCampos_NombreCompleto=explode(".",$nombre_campo_simple);
								$nombre_campo_simple=$PartesListaCampos_NombreCompleto[1];
							}

					//Agrega el campo a la lista de nombres simples
					$ListaCampos_NombreSimple[]=$nombre_campo_simple;

					//Determina la tabla a la que pertenece el campo
					//Se verifica inicialmente si el campo ya indica la tabla para evitar ambiguedades en consultas de varias tablas
					$PartesListaCampos_NombreCompleto=explode(" as ",$nombre_campo);
					$nombre_campo_simple=$PartesListaCampos_NombreCompleto[0];
					//Si el campo tiene puntos indica la tabla, sino la buscamos
					if (strpos($nombre_campo_simple,"."))
						{
							$PartesListaCampos_NombreCompleto=explode(".",$nombre_campo_simple);
							$nombre_tabla_simple=$PartesListaCampos_NombreCompleto[0];
							$ListaTablas_NombreSimple[]=$nombre_tabla_simple;
						}
					else
						{
							$nombre_tabla_simple="";
							//Busca en las TABLAS definidas para el informe
							$consulta_tablas=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_informe_tablas." FROM ".$TablasCore."informe_tablas WHERE informe=? ","$informe");
							while ($registro_tablas = $consulta_tablas->fetch())
								{
									$tabla_actual=$registro_tablas["valor_tabla"];
									//Si la tabla tiene alias lo ignora
									if (strpos($tabla_actual," as "))
										{
											$PartesTablaActual=explode(" as ",$tabla_actual);
											$tabla_actual=$PartesTablaActual[0];
										}
									//Si no se ha encontrado la tabla entra a comparar frente a la actual
									if ($nombre_tabla_simple=="")
										{
                                            //Si el informe usa una conexion externa usa su configuracion
                                            if($registro_informe["conexion_origen_datos"]!="")
                                                {
                            						if (@PCO_ExisteCampoTabla($nombre_campo_simple,$tabla_actual,${$registro_informe["conexion_origen_datos"]},$registro_informe["motorbd"],$registro_informe["basedatos"]))
                            							$nombre_tabla_simple=$tabla_actual;
                                                }
                                            else
                                                {
                            						if (PCO_ExisteCampoTabla($nombre_campo_simple,$tabla_actual))
                            							$nombre_tabla_simple=$tabla_actual;
                                                }
										}
								}
							$ListaTablas_NombreSimple[]=$nombre_tabla_simple;
						}
				}

		@$Resultados[]=array("ListaCampos_NombreCompleto" => $ListaCampos_NombreCompleto, "ListaCampos_NombreSimple"=>$ListaCampos_NombreSimple	,"ListaTablas_NombreSimple" => $ListaTablas_NombreSimple, "ListaCampos_PermitirEdicion" => $ListaCampos_PermitirEdicion);
		return $Resultados;
	}


########################################################################
########################################################################
/*
	Function: PCO_CargarInforme
	Genera el codigo HTML correspondiente a un informe de la aplicacion y hace los llamados necesarios para la diagramacion por pantalla de los diferentes objetos que lo componen.

	Variables de entrada:

		informe - ID unico del informe que se desea cargar
		en_ventana - Indica si el informe debe ser cargado en una ventana o directamente sobre el escritorio de aplicacion
		formato - Determina el formato en el cual es generado el informe como HTM o XLS (Alpha)
		estilo - Determina el estilo CSS utilizado para presentar el informe, debe existir dentro de las hojas de estilo de la plantilla
		embebido - Determina si el informe es presentado dentro de otro objeto o no, como por ejemplo un formulario

	(start code)
		SELECT * FROM ".$TablasCore."informe WHERE id='$informe'
		SELECT * FROM ".$TablasCore."informe_campos WHERE informe='$informe'
		SELECT * FROM ".$TablasCore."informe_tablas WHERE informe='$informe'
		SELECT * FROM ".$TablasCore."informe_condiciones WHERE informe='$informe' ORDER BY peso
	(end)

	Salida:

		HTML, CSS y Javascript asociado al formulario

	Ver tambien:
		<PCO_CargarFormulario> | <PCO_ConstruirConsultaInforme>
*/
    //Funcion para compatibilidad hacia atras.  Desaparecera en la version 18.9
    function cargar_informe($informe,$en_ventana=1,$formato="htm",$estilo="Informes",$embebido=0)
    { echo "ERROR: Llamado a funcion obsoleta del framework cargar_informe().  En su lugar utilice PCO_CargarInforme() "; }
function PCO_CargarInforme($informe,$en_ventana=1,$formato="htm",$estilo="Informes",$embebido=0,$anular_acciones=0,$anular_piepagina=0,$anular_encabezado=0,$SQLPuro="")
	{
		global $ConexionPDO,$ArchivoCORE,$TablasCore,$Nombre_Aplicacion,$PCO_ValorBusquedaBD,$PCO_CampoBusquedaBD;
		// Carga variables de sesion por si son comparadas en alguna condicion.  De todas formas pueden ser cargadas por el usuario en el diseno del informe
		global $PCOSESS_LoginUsuario,$Nombre_usuario,$Descripcion_usuario,$Nivel_usuario,$Correo_usuario,$LlaveDePasoUsuario,$PCO_FechaOperacion;
		// Carga variables de definicion de tablas
		global $ListaCamposSinID_replicasbd,$ListaCamposSinID_informe,$ListaCamposSinID_informe_campos,$ListaCamposSinID_informe_tablas,$ListaCamposSinID_informe_condiciones,$ListaCamposSinID_informe_boton;
		global $MULTILANG_Editar,$MULTILANG_Informes,$MULTILANG_Exportar,$MULTILANG_TotalRegistros,$MULTILANG_ContacteAdmin,$MULTILANG_ObjetoNoExiste,$MULTILANG_ErrorTiempoEjecucion,$MULTILANG_Informes,$MULTILANG_IrEscritorio,$MULTILANG_ErrorDatos,$MULTILANG_InfErrTamano,$MULTILANG_MonCommSQL;
		global $IdiomaPredeterminado;
        global $PCO_InformesListaColumnasDT,$PCO_InformesRecuperacionAJAX,$PCO_InformesIdCache,$PCO_InformesDataTable,$PCO_InformesDataTablePaginaciones,$PCO_InformesDataTableTotales,$PCO_InformesDataTableFormatoTotales,$PCO_InformesDataTableExrpotaCLP,$PCO_InformesDataTableExrpotaCSV,$PCO_InformesDataTableExrpotaXLS,$PCO_InformesDataTableExrpotaPDF,$PCO_InformesDataTableDefineCOLS,$PCO_InformesDataTable_pane_activado,$PCO_InformesDataTable_pane_cascada,$PCO_InformesDataTable_pane_colapsado,$PCO_InformesDataTable_pane_columnas,$PCO_InformesDataTable_pane_subtotalesrelativos,$PCO_InformesDataTable_pane_conteos,$PCO_InformesDataTable_pane_controles,$PCO_InformesDataTable_pane_control_colapsar,$PCO_InformesDataTable_pane_control_ordenar;
        global $ModoDepuracion,$ModoDesarrolladorPractico;
        global $PCO_InformesGraficosSinDatos,$PCOVAR_ConteoRegistrosUltimoInforme;
        global $PCO_FuncionesJSInternasFORM;
        
        //Determina si el usuario es un disenador de aplicacion para mostrar el ID de objeto a manera informativa y un boton de salto a edicion
        $BotonSaltoEdicion='
                    <a class="btn btn-default btn-xs" href="index.php?PCO_Accion=PCO_EditarInforme&informe='.$informe.'">
                        <div><i class="fa fa-pencil-square"></i> '.$MULTILANG_Editar.' '.$MULTILANG_Informes.' <i>[ID='.$informe.']</i></div>
                    </a>';

        if ($SQLPuro=="")
            {
        		if (PCO_EsAdministrador($_SESSION['PCOSESS_LoginUsuario']) && $informe>=0)
        		    $ComplementoIdObjetoEnTitulo="  $BotonSaltoEdicion";

        		// Busca datos del informe
        		$consulta_informe=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_informe." FROM ".$TablasCore."informe WHERE id=? ","$informe");
        		$registro_informe=$consulta_informe->fetch();
        		$Identificador_informe=$registro_informe["id"];

        		//Carga cualquier script PRE para el informe
        		if ($registro_informe["pre_script"]!="")
        		    {
        		        //Evalua si el codigo ya inicia con <?php y sino lo agrega
        		        $ComplementoInicioScript="";
        		        if (substr(trim($registro_informe["pre_script"]),0,5)!='<?php')
        		            $ComplementoInicioScript="<?php\n";
        		        PCO_EvaluarCodigo($ComplementoInicioScript.$registro_informe["pre_script"],1,"Detalles: PRE-Code Rep ID=".$informe);
        		    }

        		//Prepara script POST para el informe (se carga mas abajo pero deja la cadena lista)
        		if ($registro_informe["post_script"]!="")
        		    {
        		        //Evalua si el codigo ya inicia con <?php y sino lo agrega
        		        $ComplementoInicioScript="";
        		        if (substr(trim($registro_informe["post_script"]),0,5)!='<?php')
        		            $ComplementoInicioScript="<?php\n";
        		        $CadenaPOSTScriptPHP=$ComplementoInicioScript.$registro_informe["post_script"];
        		    }

        		//Prepara JavaSCRIPT para el informe (se carga mas abajo pero deja la cadena lista)
        		if (trim($registro_informe["javascript"])!="")
        		    {
                        $JavaScriptInforme=PCO_ReemplazarVariablesPHPEnCadena(trim($registro_informe["javascript"]));
        		    }
            }

        //Determina si se deben ocultar elementos por banderas o porque el informe asi lo obliga
        $ComplementoAnulacionPiePagina='';
        if ($anular_piepagina==1 || $registro_informe["ocultar_piepagina"]==1) $ComplementoAnulacionPiePagina=' style="display:none; visibility:hidden;" ';
        $ComplementoAnulacionEncabezado='';
        if ($anular_encabezado==1 || $registro_informe["ocultar_encabezado"]==1) $ComplementoAnulacionEncabezado=' style="display:none; visibility:hidden;" ';
        if ($anular_acciones==0 && $registro_informe["anular_acciones"]==1) $anular_acciones=1;

        if ($SQLPuro=="")
            {
                //Si el informe usa una conexion externa busca su configuracion
                if($registro_informe["conexion_origen_datos"]!="")
                    {
        		        $registro_conexiones=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_replicasbd." FROM ".$TablasCore."replicasbd WHERE nombre='".$registro_informe["conexion_origen_datos"]."' ")->fetch();
                    	global ${$registro_conexiones["nombre"]};
                    	$NombreConexionExtra=${$registro_conexiones["nombre"]};
                    }
        		//Si no encuentra informe presenta error
        		if ($registro_informe["id"]=="") PCO_Mensaje($MULTILANG_ErrorTiempoEjecucion,$MULTILANG_ObjetoNoExiste." ".$MULTILANG_ContacteAdmin."<br>(".$MULTILANG_Informes." $informe)", '', 'fa fa-times fa-5x icon-red texto-blink', 'alert alert-danger alert-dismissible');
            }

		//Identifica si el informe requiere un formulario de filtrado previo
		if ($registro_informe["formulario_filtrado"]!="")
			{
				//Determina si solicita el informe desde el formulario de filtrado apropiado, sino redirecciona a este
				global $PCO_FormularioActivo;
				if ($registro_informe["formulario_filtrado"]!=$PCO_FormularioActivo)
					{
						echo '<form name="precarga_form_filtro" action="'.$ArchivoCORE.'" method="POST" target="_self">
							<input type="Hidden" name="PCO_Accion" value="PCO_CargarObjeto">
							<input type="Hidden" name="PCO_InformeFiltro" value="'.$registro_informe["id"].'">
							<input type="Hidden" name="PCO_Objeto" value="frm:'.$registro_informe["formulario_filtrado"].':1">
							<input type="Hidden" name="Presentar_FullScreen" value="'.@$Presentar_FullScreen.'">
							<input type="Hidden" name="Precarga_EstilosBS" value="'.@$Precarga_EstilosBS.'">
							</form>
						<script type="" language="JavaScript"> document.precarga_form_filtro.submit();  </script>';
						die();
					}
			}

		//Si hay variables de filtro definidas busca su valor en el contexto global
		if($registro_informe["variables_filtro"]!="")
			{
				$arreglo_variables_filtro = @explode(",",$registro_informe["variables_filtro"]);
				//Busca y convierte cada variable recibida en global
				foreach ($arreglo_variables_filtro as $nombre_variable_filtro)
					{
						//if (isset(${$nombre_variable_filtro}))  // {Deprecated}
							global ${$nombre_variable_filtro};
					}
			}

		//Si no hay SQL explicito entonces Genera la consulta en SQL para el informe a partir de los parametros
		if (strlen($registro_informe["consulta_sql"])<5)
		    {
		        if ($SQLPuro=="")
    		        $consulta=PCO_ConstruirConsultaInforme($informe,0); //Construye query del informe sin evitar campos ocultos (0)
		        else
		            $consulta=PCO_ReemplazarVariablesPHPEnCadena($SQLPuro);
		    }
		else
		    $consulta=PCO_ReemplazarVariablesPHPEnCadena($registro_informe["consulta_sql"]);

		// Si el informe tiene formato_final = T (tabla de datos)
		if ($registro_informe["formato_final"]=="T" || $SQLPuro!="")
			{
				$SalidaFinalInforme='';
				if ($en_ventana)
					{
						//Cuando es embebido (=1) no imprime el boton de retorno pues se asume dentro de un formulario
						if (!$embebido)
							echo '<div align=center id="PCOContenedor_BotonEscritorio"><button type="Button" onclick="document.PCO_FormVerMenu.submit()" class="btn btn-warning"><i class="fa fa-home fa-fw"></i> '.$MULTILANG_IrEscritorio.'</button></div><br>';

						$TituloVentanaInforme=PCO_ReemplazarVariablesPHPEnCadena($registro_informe["titulo"]);
						//Define si requiere o no boton de exportacion en la barra de titulo
						if ($registro_informe["genera_pdf"]!='N' && $embebido!=1)
							{
							    //Formato nativo
    				            if ($registro_informe["genera_pdf"]=='S' || $registro_informe["genera_pdf"]=='A')
                                    {
        								$TituloVentanaInforme='
        								<a class="btn btn-primary btn-xs pull-right" data-toggle="modal" href="#myModalEXPORTACION">
        									<div><i class="fa fa-floppy-o fa-fw"></i> '.$MULTILANG_Exportar.'</div>
        								</a>'.$TituloVentanaInforme;
                                    }
							}

						//Define si requiere o no boton de exportacion en la barra de titulo
					    //Formato CSV por AJAX - Solo genera el marco, el boton se agrega luego cuando se conozca el ID de la cache de informe (mas abajo)
			            if ($registro_informe["genera_pdf"]=='C' || $registro_informe["genera_pdf"]=='A')
                            {
								$TituloVentanaInforme='<div id="PCO_MarcoBotonCSVInforme'.$informe.'" class="pull-right" style="margin-left:5px;"></div>'.$TituloVentanaInforme;
                            }

						//Carga la ventana con el informe
						PCO_AbrirVentana($TituloVentanaInforme.$ComplementoIdObjetoEnTitulo,'panel panel-info',$registro_informe["ancho"]);

						//Agrega la descripcion del informe en caso de contar con ella
						if ($registro_informe["descripcion"]!='')
							{
								 PCO_Mensaje('<i class="fa fa-flag fa-fw"></i>',PCO_ReemplazarVariablesPHPEnCadena($registro_informe["descripcion"]), '', '', 'alert alert-success alert-dismissible');
							}
					}

				// Si se ha definido un tamano fijo entonces crea el marco
				if ($registro_informe["ancho"]!="" && $registro_informe["alto"]!="")
					echo '<DIV style="DISPLAY: block; OVERFLOW: auto; POSITION: relative; WIDTH: '.$registro_informe["ancho"].' !important; HEIGHT: '.$registro_informe["alto"].' !important">';

				//Genera enlaces a las opciones de descarga
				if (($registro_informe["genera_pdf"]=='S' || $registro_informe["genera_pdf"]=='A')  && $embebido!=1)
					include_once("core/marco_export.php");

					//DEPRECATED echo '	<html>		<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0" style="font-size: 12px; font-family: Arial, Verdana, Tahoma;">';

                    //Agrega titulo o encabezado si esta definido
                    if ( $registro_informe["encabezado_html"] != '' )
                        $SalidaFinalInforme.= '<div id="titulo-informe-ID'.$registro_informe["id"].'">'.PCO_ReemplazarVariablesPHPEnCadena($registro_informe["encabezado_html"]).'</div>';

                    //Agrega clases para convertir la tabla a responsive si aplica
                    $ComplementoResponsiveTabla='';
                    if ( $registro_informe["tabla_responsive"] == 'S' )
                        $ComplementoResponsiveTabla= 'responsive nowrap';

					$SalidaFinalInforme.= '<!--<div class="table-responsive">-->
											<table width="100%" class="btn-xs table table-condensed table-hover order-column table-striped table-unbordered  '.$ComplementoResponsiveTabla.'  '.$estilo.'" id="TablaInforme_'.$registro_informe["id"].'"><thead id="PCO_EncabezadosInforme_'.$registro_informe["id"].'" '.$ComplementoAnulacionEncabezado.'>';

					//Busca si tiene acciones (botones) para cada registro y los genera
					if (!$anular_acciones)
					    {
    					    $cadena_generica_botones_principio=PCO_GenerarBotonesInforme($informe,1);
    					    $cadena_generica_botones=PCO_GenerarBotonesInforme($informe);
					    }
					else
					    {
					        $cadena_generica_botones_principio='';
					        $cadena_generica_botones="";
					    }

					//Si el informe tiene botones al comienzo entonces agrega columna adicional
					if ($cadena_generica_botones_principio!="")
						{
							$SalidaFinalInforme.= '<th></th>';
						}

					//Determina si el informe tiene o no campos ocultos
					$PCO_ColumnasOcultas=PCO_DeterminarCamposOcultos($informe);

					//Obtiene ColumnasVisibles, NumerosColumnasOcultas, NumeroColumnas dentro de EtiquetasConsulta
					$EtiquetasConsulta=PCO_GenerarEtiquetasConsulta($consulta,$informe); //Enviar el informe para que se determinen tambien sus columnas ocultas

					//Genera HTML con las columnas
                    //Busca los campos definidos en el informe como visibles y luego determina si el campo tiene o no titulo arbitrario
        			$ListaCampos_TitutloArbitrario=array();
        			$consulta_titulosarbitrarios=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_informe_campos." FROM ".$TablasCore."informe_campos WHERE informe=? AND visible=1 ORDER BY peso,id","$informe");
        			while ($registro_titulosarbitrarios = $consulta_titulosarbitrarios->fetch())
        					$ListaCampos_TitutloArbitrario[]=$registro_titulosarbitrarios["titulo_arbitrario"];
				    $ConteoPosicionColumna=0;   //Utilizado para conocer la columna actual y luego buscar si tiene titulo arbitrario
					$ListaColumnasInforme="";   //Acumula las columnas para ser usadas luego en los DataTables (si aplica)
					foreach($EtiquetasConsulta[0]["ColumnasVisibles"] as $EtiquetaColumna)
					    {
					        $TituloFinalColumna=$EtiquetaColumna;
					        //Si la columna actual tiene un titulo arbitrario definido entonces lo agrega
					        if (@$ListaCampos_TitutloArbitrario[$ConteoPosicionColumna]!="")
                                $TituloFinalColumna=PCO_ReemplazarVariablesPHPEnCadena($ListaCampos_TitutloArbitrario[$ConteoPosicionColumna]);
						    $SalidaFinalInforme.= '<th>'.$TituloFinalColumna.'</th>';
						    $ListaColumnasInforme.=$TituloFinalColumna.',';
						    $ConteoPosicionColumna++;
					    }
					$ListaColumnasInforme=substr($ListaColumnasInforme, 0, -1);//Elimina la coma sobrante del informe
					//Si el informe tiene botones al final entonces agrega columna adicional
					if ($cadena_generica_botones!="")
						{
							$SalidaFinalInforme.= '<th></th>';
						}
					$SalidaFinalInforme.= '</tr></thead><tbody>';

					//Busca los campos y tablas reales del informe para construir luego los ID unicos
					$CamposReales=PCO_CamposRealesInforme($informe);

					// Imprime registros del resultado
					$numero_filas=0;

                    //Si el informe usa una conexion externa usa su configuracion
                    if($registro_informe["conexion_origen_datos"]!="")
                        $consulta_ejecucion=PCO_EjecutarSQL($consulta,"",${$registro_conexiones["nombre"]});
                    else
                        $consulta_ejecucion=PCO_EjecutarSQL($consulta);
                        
                    //Asigna el total dde registros a variable global para posible uso fuera de la funcion
                    $PCOVAR_ConteoRegistrosUltimoInforme=$consulta_ejecucion->rowCount();

                    //Lleva informe a la cache siempre y cuando no sea un informe interno del framework
                    $IdCacheInformes=0;
                    PCO_EjecutarSQLUnaria("INSERT INTO {$TablasCore}informe_cache (informe,usuario,conexion,script_sql,columnas) VALUES('{$informe}','{$PCOSESS_LoginUsuario}','{$NombreConexionExtra}',?,'{$ListaColumnasInforme}') ","{$consulta}");
                    $IdCacheInformes=PCO_ObtenerUltimoIDInsertado();

                    //Ahora que se tiene una cache, determina si se requiere boton de exportacion CSV por AJAX y lo agrega
		            if ($registro_informe["genera_pdf"]=='C' || $registro_informe["genera_pdf"]=='A')
                        {
                            echo "<script language='JavaScript'>
                                $('#PCO_MarcoBotonCSVInforme{$informe}').html('<a class=\"btn btn-success btn-xs pull-right\" href=\"core/ajax.php?PCO_Accion=PCO_ExportacionQueryCacheCSV&amp;IdRegistro_CacheSQL={$IdCacheInformes}\"> <i class=\"fa fa-file-excel-o fa-fw\"></i> {$MULTILANG_Exportar} CSV </a>');
                            </script>";
                        }

					//Si el informe va a soportar datatable entonces lo agrega a las tablas que deben ser convertidas en el pageonload
					if ($registro_informe["soporte_datatable"]=="S")
					    {
						    @$PCO_InformesDataTable.="TablaInforme_".$registro_informe["id"]."|";
						    @$PCO_InformesDataTablePaginaciones.=$registro_informe["tamano_paginacion"]."|"; //Agrega tamano predefinido para la tabla
						    @$PCO_InformesDataTableTotales.=$registro_informe["subtotales_columna"]."|";
						    @$PCO_InformesDataTableFormatoTotales.=$registro_informe["subtotales_formato"]."|";
						    @$PCO_InformesDataTableExrpotaCLP.=$registro_informe["exportar_dtclp"]."|";
						    @$PCO_InformesDataTableExrpotaCSV.=$registro_informe["exportar_dtcsv"]."|";
						    @$PCO_InformesDataTableExrpotaXLS.=$registro_informe["exportar_dtxls"]."|";
						    @$PCO_InformesDataTableExrpotaPDF.=$registro_informe["exportar_dtpdf"]."|";
						    @$PCO_InformesDataTableDefineCOLS.=$registro_informe["definir_cols"]."|";
            	            @$PCO_InformesIdCache.=$IdCacheInformes."|";
                    	    @$PCO_InformesListaColumnasDT.=$ListaColumnasInforme."|";
						    @$PCO_InformesDataTable_pane_activado.=$registro_informe["pane_activado"]."|";
						    @$PCO_InformesDataTable_pane_cascada.=$registro_informe["pane_cascada"]."|";
						    @$PCO_InformesDataTable_pane_colapsado.=$registro_informe["pane_colapsado"]."|";
						    @$PCO_InformesDataTable_pane_columnas.=$registro_informe["pane_columnas"]."|";
						    @$PCO_InformesDataTable_pane_subtotalesrelativos.=$registro_informe["pane_subtotalesrelativos"]."|";
						    @$PCO_InformesDataTable_pane_conteos.=$registro_informe["pane_conteos"]."|";
						    @$PCO_InformesDataTable_pane_controles.=$registro_informe["pane_controles"]."|";
						    @$PCO_InformesDataTable_pane_control_colapsar.=$registro_informe["pane_control_colapsar"]."|";
						    @$PCO_InformesDataTable_pane_control_ordenar.=$registro_informe["pane_control_ordenar"]."|";
					    }

                    if ($registro_informe["usar_ajax"]==0)
                        {
                            //Define banderas para determinar si el informe se recupera por AJAX o no posteriormente en marco_abajo
                    	    if ($registro_informe["soporte_datatable"]=="S")
                    	        $PCO_InformesRecuperacionAJAX.="0"."|";
        
        					//Procesa resultados solo si es diferente de 1 que es el valor retornado cuando hay errores evitando el fatal error del fetch(), rowCount() y demas metodos
        					while($consulta_ejecucion!="1" && $registro_datos_informe=$consulta_ejecucion->fetch())
        						{
        							$SalidaFinalInforme.= '<tr>';
        
        							//Si el informe tiene botones al comienzo los agrega
        							if ($cadena_generica_botones_principio!="")
        								{
        									//Transforma la cadena generica con los datos especificos del registro, toma por ahora el primer campo (OCULTO O NO)
        									$cadena_botones_registro=str_replace("DELFRMVALVALOR",$registro_datos_informe[0],$cadena_generica_botones_principio);
        									$cadena_botones_registro=str_replace("DETFRMVALBASE",$registro_datos_informe[0],$cadena_botones_registro);
        									//Muestra los botones preparados para el registro
        									$SalidaFinalInforme.= '<td>'.$cadena_botones_registro.'</td>';
        								}
        
        							for ($i=0;$i<$EtiquetasConsulta[0]["NumeroColumnas"];$i++)
        								{
        									//Si no hay definidos numeros de columnas ocultas crea el arreglo vacio para compatibilidad PHP 8+
        									if (@!isset($EtiquetasConsulta[0]["NumerosColumnasOcultas"]))
        									    $EtiquetasConsulta[0]["NumerosColumnasOcultas"]=array();
        									
        									//Muestra la columna solo si no se trata de una de las ocultas
        									if (@!in_array($i,$EtiquetasConsulta[0]["NumerosColumnasOcultas"]))
        										{
        											$ValorCampoIdentificador=$registro_datos_informe[0]; //Toma por ahora el primer campo (OCULTO O NO)
        											$Nombre_CampoLlave=@$CamposReales[0]["ListaCampos_NombreSimple"][0]; //Toma por ahora el primer campo (OCULTO O NO)
        											$Nombre_CampoEditable=@$CamposReales[0]["ListaCampos_NombreSimple"][$i];
        											$Nombre_TablaEditable=@$CamposReales[0]["ListaTablas_NombreSimple"][$i];
        											$IdentificadorDeCampoEditable="$Nombre_TablaEditable:$Nombre_CampoEditable:$Nombre_CampoLlave:$ValorCampoIdentificador";
        
        											//Determina la activacion o no de la cadena de edicion del campo
        											$CadenaActivadora_Edicion="";
        											if (@$CamposReales[0]["ListaCampos_PermitirEdicion"][$i]==1)
        												$CadenaActivadora_Edicion=' id="'.$IdentificadorDeCampoEditable.'" contenteditable="true" ';
        
        											$ValorVisibleFinal=$registro_datos_informe[$i];
        											if ($ModoDesarrolladorPractico==1) $ValorVisibleFinal=PCO_ReemplazarVariablesPHPEnCadena($ValorVisibleFinal);
        
        											$SalidaFinalInforme.= '
        												<td '.$CadenaActivadora_Edicion.'>'.$ValorVisibleFinal.'</td>';
        										}
        								}
        
        							//Si el informe tiene botones al final los agrega
        							if ($cadena_generica_botones!="")
        								{
        									//Transforma la cadena generica con los datos especificos del registro, toma por ahora el primer campo (OCULTO O NO)
        									$cadena_botones_registro=str_replace("DELFRMVALVALOR",$registro_datos_informe[0],$cadena_generica_botones);
        									$cadena_botones_registro=str_replace("DETFRMVALBASE",$registro_datos_informe[0],$cadena_botones_registro);
        									//Muestra los botones preparados para el registro
        									$SalidaFinalInforme.= '<td>'.$cadena_botones_registro.'</td>';
        								}
        
        							$SalidaFinalInforme.= '</tr>';
        							$numero_filas++;
        						}
                        }
                    else
                        {
                            //Define banderas para determinar si el informe se recupera por AJAX o no posteriormente en marco_abajo
                    	    if ($registro_informe["soporte_datatable"]=="S")
                    	        $PCO_InformesRecuperacionAJAX.="1"."|";
                        }

					$SalidaFinalInforme.= '</tbody>';

					//Si se desea tabla responsive oculta el pie de pagina (libreria datatables no soporta responsive con tfooter ni recupareacion ajax con tfooter)
			        if ($registro_informe["tabla_responsive"] == 'N' &&  $registro_informe["usar_ajax"]=="0")
			            {
        					$SalidaFinalInforme.= '<tfoot id="PCO_PiePaginaInforme_'.$registro_informe["id"].'" '.$ComplementoAnulacionPiePagina.'>';
        					//Cuando es embebido (=1) no agrega los totales de registro
        					//if (!$embebido)
        					$CantidadColumnasSpan=$ConteoPosicionColumna-1;
        					@$SalidaFinalInforme.= '
        						<tr>
        						    <th colspan='.$CantidadColumnasSpan.'>
        							    <b>'.$MULTILANG_TotalRegistros.': </b>'.$numero_filas.'
        						    </th>
        						</tr>';
        					//Cierra pie de pagina, tabla y marco responsive para la tabla
        					$SalidaFinalInforme.= '</tfoot>';
			            }
					
					$SalidaFinalInforme.= '
							</table>
							<!--</div>-->';
				// DEPRECATED $SalidaFinalInforme.= '</body></html>';

				//Imprime el HTML generado para el informe
				echo $SalidaFinalInforme;

				// Si se ha definido un tamano fijo entonces cierra el marco
				if ($registro_informe["ancho"]!="" && $registro_informe["alto"]!="")
					echo '</DIV>';

			} // Fin si informe es T (tabla)

/*
		//Verifica si es un informe grafico sin dimensiones
		if ($registro_informe["formato_final"]=="G" && ( $registro_informe["ancho"]=="" || $registro_informe["alto"]=="" ))
			{
				echo '<form name="cancelarXTamano" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="PCO_VerMenu">
					<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
					<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$MULTILANG_InfErrTamano.'">
					</form>
					<script type="" language="JavaScript"> document.cancelarXTamano.submit();  </script>';
			}
*/
		// Si el informe tiene formato_final = G (grafico)
		if ($registro_informe["formato_final"]=="G")
			{
				// Si se ha definido un tamano fijo entonces crea el marco
				if ($registro_informe["ancho"]!="" && $registro_informe["alto"]!="" && $registro_informe["ancho"]!="0" && $registro_informe["alto"]!="0")
					echo '<DIV style="DISPLAY: block; OVERFLOW: no; POSITION: relative; WIDTH: '.$registro_informe["ancho"].' !important; HEIGHT: '.$registro_informe["alto"].' !important">';

				//Consulta el formato de grafico y datos de series para ponerlo en los campos
				//Dado por: Tipo|Nombre1!NombreN|Etiqueta1!EtiquetaN|Valor1!ValorN|
				$formato_base=explode("|",$registro_informe["formato_grafico"]);
				$tipo_grafico=$formato_base[0];
				$lista_nombre_series=explode("!",$formato_base[1]);
				$lista_etiqueta_series=explode("!",$formato_base[2]);
				$lista_valor_series=explode("!",$formato_base[3]);
	            //Carga detalles extendidos para el formato de grafico y los corrige en el caso de graficos viejos
	            $barra_apilada=$formato_base[4];    if ($barra_apilada=="") $barra_apilada="false";
	            $ocultar_grilla=$formato_base[5];   if ($ocultar_grilla=="") $ocultar_grilla="false";
	            $ocultar_ejes=$formato_base[6];     if ($ocultar_ejes=="") $ocultar_ejes="false";
	            $unidades_pre=$formato_base[7];     if ($unidades_pre=="") $unidades_pre="";
	            $unidades_pos=$formato_base[8];     if ($unidades_pos=="") $unidades_pos="";
	            $barras_horizontales="false";  //Asume barras verticales por defecto
				if ($tipo_grafico=="barrah")  $barras_horizontales="true";
	            $tipo_grafico_circular="donut";  //Asume barras verticales por defecto
				if ($tipo_grafico=="torta" || $tipo_grafico=="tortap")  $tipo_grafico_circular="pie";
	            $presentar_porcentaje="false";  //Asume que el grafico no es con porcentajes en tortas
				if ($tipo_grafico=="donap" || $tipo_grafico=="tortap")  $presentar_porcentaje="true";

				$presentar_datalabels="false";  //Asume que no se presentan las etiquetas con valores de datos
				$cadenaubicacion_datalabels="";
				if($formato_base[9]!="false" && $formato_base[9]!="") $presentar_datalabels="true";
				if($formato_base[9]=="true_outside") $cadenaubicacion_datalabels="dataLabelsPosition: 'outside',";
				if($formato_base[9]=="true_inside") $cadenaubicacion_datalabels="dataLabelsPosition: 'inside',";

                $cadena_arreglo_colores="";
				if($formato_base[10]!="") $cadena_arreglo_colores="colors: ".$formato_base[10].",";

				//Elimina los nombres de tabla en caso de tener punto y usa los alias si los tiene
				for ($i=0;$i<5;$i++)
					{
						//Elimina nombres de tabla encontrando el punto y seleccionando siguiente palabra
						if (strpos($lista_etiqueta_series[$i], "."))
							{
								$tmp=explode(".",$lista_etiqueta_series[$i]);
								$lista_etiqueta_series[$i]=$tmp[1];
							}
						if (strpos($lista_valor_series[$i], "."))
							{
								$tmp=explode(".",$lista_valor_series[$i]);
								$lista_valor_series[$i]=$tmp[1];
							}
						// Prefiere los alias sobre los nombres de campo cuando encuentra un AS
						if (strpos($lista_etiqueta_series[$i], " AS "))
							{
								$tmp=explode(" AS ",$lista_etiqueta_series[$i]);
								$lista_etiqueta_series[$i]=$tmp[1];
							}
						if (strpos($lista_valor_series[$i], " AS "))
							{
								$tmp=explode(" AS ",$lista_valor_series[$i]);
								$lista_valor_series[$i]=$tmp[1];
							}
					}
				$nombre_serie_1=preg_replace('~[^a-zA-Z0-9_]~', '', str_replace ( " " , "_", $lista_nombre_series[0] ) );
				$nombre_serie_2=preg_replace('~[^a-zA-Z0-9_]~', '', str_replace ( " " , "_", $lista_nombre_series[1] ) );
				$nombre_serie_3=preg_replace('~[^a-zA-Z0-9_]~', '', str_replace ( " " , "_", $lista_nombre_series[2] ) );
				$nombre_serie_4=preg_replace('~[^a-zA-Z0-9_]~', '', str_replace ( " " , "_", $lista_nombre_series[3] ) );
				$nombre_serie_5=preg_replace('~[^a-zA-Z0-9_]~', '', str_replace ( " " , "_", $lista_nombre_series[4] ) );
				$campo_etiqueta_serie_1=$lista_etiqueta_series[0];
				$campo_etiqueta_serie_2=$lista_etiqueta_series[1];
				$campo_etiqueta_serie_3=$lista_etiqueta_series[2];
				$campo_etiqueta_serie_4=$lista_etiqueta_series[3];
				$campo_etiqueta_serie_5=$lista_etiqueta_series[4];
				$campo_valor_serie_1=$lista_valor_series[0];
				$campo_valor_serie_2=$lista_valor_series[1];
				$campo_valor_serie_3=$lista_valor_series[2];
				$campo_valor_serie_4=$lista_valor_series[3];
				$campo_valor_serie_5=$lista_valor_series[4];
				// CREA OBJETO SEGUN TIPO DE GRAFICO
				$TipoObjetoGraficoMorris     = "Morris.Area";  //Por defecto define tipo Area para cualquiera de los definidos sin compatibilidad conocida
				if ($tipo_grafico=="area")
                    $TipoObjetoGraficoMorris = "Morris.Area";
				if ($tipo_grafico=="barra" || $tipo_grafico=="barrah" || $tipo_grafico=="barrav" || $tipo_grafico=="barrah_multiples" || $tipo_grafico=="barrav_multiples")
					$TipoObjetoGraficoMorris = "Morris.Bar";
				if ($tipo_grafico=="linea" || $tipo_grafico=="linea_multiples")
					$TipoObjetoGraficoMorris = "Morris.Line";
				if ($tipo_grafico=="dona"  || $tipo_grafico=="donap" || $tipo_grafico=="torta" || $tipo_grafico=="tortap")
					$TipoObjetoGraficoMorris = "Morris.Donut";

				//Define la cadena de llaves para el grafico
				$CadenaLlaves="'$nombre_serie_1'";                //'Operaciones','Usuarios','UsoAPI'
				if ($nombre_serie_2!="") $CadenaLlaves.=",'$nombre_serie_2'";
				if ($nombre_serie_3!="") $CadenaLlaves.=",'$nombre_serie_3'";
				if ($nombre_serie_4!="") $CadenaLlaves.=",'$nombre_serie_4'";
				if ($nombre_serie_5!="") $CadenaLlaves.=",'$nombre_serie_5'";

				//Define la cadena de etiquetas para el grafico
				$CadenaEtiquetas="'$nombre_serie_1'";     //'Operaciones','Usuarios','UsoAPI'
				if ($nombre_serie_2!="") $CadenaEtiquetas.=",'$nombre_serie_2'";
				if ($nombre_serie_3!="") $CadenaEtiquetas.=",'$nombre_serie_3'";
				if ($nombre_serie_4!="") $CadenaEtiquetas.=",'$nombre_serie_4'";
				if ($nombre_serie_5!="") $CadenaEtiquetas.=",'$nombre_serie_5'";
            ?>
            <?php
                //Determina si se debe o no crear cadena para el tooltipo con titulo del informe
                $CadenaComplementoToolTipTitulo="";
                if ( $registro_informe["tooltip_titulo"] == 'S' )
                    $CadenaComplementoToolTipTitulo='title="'.PCO_ReemplazarVariablesPHPEnCadena($registro_informe["titulo"]).'" data-toggle="tooltip"';

                //Agrega titulo o encabezado si esta definido
                if ( $registro_informe["encabezado_html"] != '' )
                    echo '<div id="titulo-informe-ID'.$registro_informe["id"].'">'.$registro_informe["encabezado_html"].'</div>';
            ?>
                <div <?php echo $CadenaComplementoToolTipTitulo; ?> id="marco-informe-grafico-ID<?php echo $registro_informe["id"]; ?>" style="height: auto !important;"></div>
                <script language="JavaScript">
                    //Genera el codigo Morris para el grafico
                    $(function() {
                        <?php echo $TipoObjetoGraficoMorris; ?>({
                            //Nombre del marco que tiene el grafico
                            element: 'marco-informe-grafico-ID<?php echo $registro_informe["id"]; ?>',
                            data: [
                            <?php
                                //Inicia la generacion del arreglo con los datos
                                //Si el informe usa una conexion externa usa su configuracion
                                if($registro_informe["conexion_origen_datos"]!="")
                                    $resultado_consulta=PCO_EjecutarSQL($consulta,"",${$registro_conexiones["nombre"]});
                                else
                                    $resultado_consulta=PCO_EjecutarSQL($consulta);

                                $cadena_datos="";
                                while ($registro_consulta = $resultado_consulta->fetch())
                                    {
                                        //Crea series de datos para los graficos de Barra, Linea o area que utilizan los mismos parametros
                                        if ($TipoObjetoGraficoMorris!="Morris.Donut")
                                            {
                                                $cadena_datos.= "
                                                    {";
                                                //Agrega datos al arreglo del grafico segun las series disponibles
        								        if ($nombre_serie_1 != "")
        								            {
        								                $NombreVisibleCampo=$registro_consulta[$campo_etiqueta_serie_1];
        								                $ValorVisibleCampo=$registro_consulta[$campo_valor_serie_1];
                                                        $cadena_datos.= "
                                                        ".$nombre_serie_1.": ".$ValorVisibleCampo.",
                                                        etiqueta_ejex: '$NombreVisibleCampo'";
        								            }
        								        if ($nombre_serie_2 != "")
        								            {
        								                $NombreVisibleCampo=$registro_consulta[$campo_etiqueta_serie_2];
        								                $ValorVisibleCampo=$registro_consulta[$campo_valor_serie_2];
                                                        $cadena_datos.= ",
                                                        ".$nombre_serie_2.": ".$ValorVisibleCampo;
        								            }
        								        if ($nombre_serie_3 != "")
        								            {
        								                $NombreVisibleCampo=$registro_consulta[$campo_etiqueta_serie_3];
        								                $ValorVisibleCampo=$registro_consulta[$campo_valor_serie_3];
                                                        $cadena_datos.= ",
                                                        ".$nombre_serie_3.": ".$ValorVisibleCampo;
        								            }
        								        if ($nombre_serie_4 != "")
        								            {
        								                $NombreVisibleCampo=$registro_consulta[$campo_etiqueta_serie_4];
        								                $ValorVisibleCampo=$registro_consulta[$campo_valor_serie_4];
                                                        $cadena_datos.= ",
                                                        ".$nombre_serie_4.": ".$ValorVisibleCampo;
        								            }
        								        if ($nombre_serie_5 != "")
        								            {
        								                $NombreVisibleCampo=$registro_consulta[$campo_etiqueta_serie_5];
        								                $ValorVisibleCampo=$registro_consulta[$campo_valor_serie_5];
                                                        $cadena_datos.= ",
                                                        ".$nombre_serie_5.": ".$ValorVisibleCampo;
        								            }
                                                $cadena_datos.= "
                                                    },";
                                            }
                                        //Crea series de datos para graficos tipo dona
                                        if ($TipoObjetoGraficoMorris=="Morris.Donut")
                                            {
                                                $cadena_datos.= "
                                                    {";
        								                $NombreVisibleCampo=$registro_consulta[$campo_etiqueta_serie_1];
        								                $ValorVisibleCampo=$registro_consulta[$campo_valor_serie_1];
                                                        $cadena_datos.= "
                                                        label: '".$NombreVisibleCampo."', value: ".$ValorVisibleCampo;
                                                $cadena_datos.= "
                                                    },";
                                            }
                                    }
                                $cadena_datos = substr($cadena_datos, 0, -1);
                                if ($cadena_datos!="")
                                    echo $cadena_datos;
                                if ($cadena_datos=="")
                                    $PCO_InformesGraficosSinDatos.='marco-informe-grafico-ID'.$registro_informe["id"].'|'; //Si no tiene datos lo lleva al arreglo para cambiar luego su valor html y evitar el NaN
                            ?>
                            ],
                            xkey: ['etiqueta_ejex'],
                            ykeys: [<?php echo $CadenaLlaves; ?>],
                            labels: [<?php echo $CadenaEtiquetas; ?>],
                            pointSize: 2,
                            hideHover: 'auto',
                            resize: true,
                            stacked: <?php echo $barra_apilada; ?>,
                            preUnits: '<?php echo $unidades_pre; ?>',
                            postUnits: '<?php echo $unidades_pos; ?>',
                            grid: <?php echo $ocultar_grilla; ?>,
                            horizontal: <?php echo $barras_horizontales; ?>,
                            <?php echo $cadena_arreglo_colores; ?>

                            dataLabels: <?php echo $presentar_datalabels; ?>,
                            <?php echo $cadenaubicacion_datalabels; ?>  // EJ: dataLabelsPosition: 'outside', //inside

                            showPercentage: <?php echo $presentar_porcentaje; ?>,
                            donutType: '<?php echo $tipo_grafico_circular; ?>',
                            <?php
                                //Agrega las unidades para los tipos de grafico Donut
                                if ($TipoObjetoGraficoMorris=="Morris.Donut")
                                    echo "formatter: function (value, data) { return '$unidades_pre'+ (value) + '$unidades_pos'; },";
                            ?>
                            axes: <?php echo $ocultar_ejes; ?>
                        });
                    });
                </script>
            <?php
			// Si se ha definido un tamano fijo entonces cierra el marco
			if ($registro_informe["ancho"]!="" && $registro_informe["alto"]!="" && $registro_informe["ancho"]!="0" && $registro_informe["alto"]!="0")
				echo '</DIV>';

			} // Fin si informe es G (grafico)

		if ($en_ventana) PCO_CerrarVentana();

        //Si el usuario es admin le muestra el query generador.
        if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario) && $ModoDepuracion)
            PCO_Mensaje($MULTILANG_MonCommSQL, $consulta, '', 'fa fa-fw fa-2x fa-database', 'alert alert-info alert-dismissible ');

		//Ejecuta script POST para el informe
		if ($CadenaPOSTScriptPHP!="")
		    {
		        PCO_EvaluarCodigo($CadenaPOSTScriptPHP,1,"Detalles: POST-Code Rep ID=".$informe);
		    }

		//Ejecuta script POST para el informe llevandolo a la misma cadena de formularios que se agrega en marco_abajo
		if ($JavaScriptInforme!="")
		    {
        	    $PCO_FuncionesJSInternasFORM .= '<script type="text/javascript">
        	    '.$JavaScriptInforme.'
        		</script>';
        	}
	}