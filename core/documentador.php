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

session_start();
$SaltoLinea=PHP_EOL;
$Tabulacion="\t";


include_once '../../core/configuracion.php';
// Inicia las conexiones con la BD y las deja listas para las operaciones
include_once '../../core/conexiones.php';
// Incluye definiciones comunes de la base de datos
include_once '../../inc/practico/def_basedatos.php';
// Incluye archivo con algunas funciones comunes usadas por la herramienta
include_once '../../core/comunes.php';


########################################################################
########################################################################
/*
	Function: PCO_ObtenerBloquesDocumentacion
	Obtiene todos los bloques de documentacion del codigo fuente entregado

	Variables de entrada:

		CadenaAnalizada - Cadena que contiene el codigo fuente de lenguaje a analizar
		DetalleOrigen - Especifica la ruta del archivo fuente o nombre de formulario interno que origina la documentacion 
		TipoOrigen - Indica el origen de la documentacion parseada.  Uno de Arch | Form
		Lenguaje - Nombre corto descriptor del lenguaje de programacion desde el cual proviene el codigo.  Uno de: PHP | Java | JavaScript | C/C++
		MaximoComentariosAnalisis - -1 para Ilimitado o una cantidad máxima de comentarios que serán analizados.

	Salida:
		Arreglo con todos los elementos encontrados que contienen comentarios o bloques de comentarios 
*/
function PCO_ObtenerBloquesDocumentacion($CadenaAnalizada="",$TipoOrigen="Arch",$DetalleOrigen="",$LenguajeObjetivo="PHP",$MaximoComentariosAnalisis=-1)
    {
        global $SaltoLinea,$Tabulacion;
        $ArregloComentarios = array();

        //Define separadores comunes para comentarios segun el tipo de lenguaje
        if ($LenguajeObjetivo=="PHP" || $LenguajeObjetivo=="Java" || $LenguajeObjetivo=="JavaScript" || $LenguajeObjetivo=="C/C++")
            {
                $InicioComentarioSimple1="//";
                $InicioComentarioSimple2="#";   //Comentarios por # No se soportan! en tanto pueden estar en otras instrucciones que sin ser parseadas puede arrojar falsos positivos por ahora
                $InicioComentarioBloque1="/*";
                $CierreComentarioBloque1="*/";
            }
        //Inicia la descomposicion de cadenas por los delimitadores definidos segun lenguaje
        $FinAnalisis=false;
        $PosicionInicio=0;
        $PosicionFin=strlen($CadenaAnalizada);
        $SubCadena=$CadenaAnalizada;
        while (!$FinAnalisis && (count($ArregloComentarios)<=$MaximoComentariosAnalisis-1 || $MaximoComentariosAnalisis==-1) )
            {
                //Busca aparicion de bloque central de comentario.  Si lo encuentra busca cadena de cierre (obligatoria por sintaxis)
                $SubCadenaComentario_Bloque=strstr($SubCadena, "/*", FALSE); //Sin retorno de cadena previa al needle
                $SubCadenaComentario_Simple=strstr($SubCadena, "//", FALSE); //Sin retorno de cadena previa al needle
                //Determina si encontro al menos un tipo de comentario
                if ($SubCadenaComentario_Bloque!==FALSE || $SubCadenaComentario_Simple!==FALSE)
                    {
                        //Si la cadena de Bloque es Mayor que la de Simple entonces la procesa primero porque su ocurrencia fue encontrada antes sino se va por la simple
                        if (strlen($SubCadenaComentario_Bloque)>strlen($SubCadenaComentario_Simple) && strlen($SubCadenaComentario_Bloque)!==FALSE)
                            {
                                $SubCadenaComentario=$SubCadenaComentario_Bloque;
                                $SubCadenaComentario=strstr($SubCadenaComentario, "*/", TRUE); //Con retorno de cadena previa al needle
                                //No importa si lo cierra o no, si por sintaxis es obligatorio 
                                if ($SubCadenaComentario!==FALSE)
                                    {
                                        $ComentarioParseado = str_replace('/*' , '' ,$SubCadenaComentario  );
                                        //Elimina el comentario que acaba de encontrar de la SubCadena analizada
                                        $SubCadena=str_replace($SubCadenaComentario.'*/' , '' ,$SubCadena  );
                                    }
                            }
                        else
                            {
                                $SubCadenaComentario=$SubCadenaComentario_Simple;
                                $SubCadenaComentario=strstr($SubCadenaComentario, $SaltoLinea, TRUE); //Con retorno de cadena previa al needle
                                //No importa si lo cierra o no, si por sintaxis es obligatorio 
                                if ($SubCadenaComentario!==FALSE)
                                    {
                                        $ComentarioParseado = str_replace('//' , '' ,$SubCadenaComentario  );
                                        //Elimina el comentario que acaba de encontrar de la SubCadena analizada
                                        $SubCadena=str_replace($SubCadenaComentario.$SaltoLinea , '' ,$SubCadena  );
                                    }
                                else
                                    {
                                        $FinAnalisis=TRUE;
                                    }
                            }
                        ###############################  DEPURACION  #############################
                        //echo "<hr>".$ComentarioParseado;
                        ###############################  DEPURACION  #############################
                        //Agrega el comentario al arreglo con la lista encontrada
                        $ArregloComentarios[] = ["comentario" => $ComentarioParseado, "tipo_origen" => $TipoOrigen, "detalle_origen" => $DetalleOrigen ];
                    }
                else
                    {
                        $FinAnalisis=TRUE;
                    }
            }
        return $ArregloComentarios;
    }


########################################################################
########################################################################
/*
	Function: PCO_ParsearBloquesDocumentacion
	Toma un arreglo de comentarios y busca comentarios indexables.
	Las reglas utilizadas son similares en estructura a las definidas por 
	NaturalDocs https://www.naturaldocs.org/getting_started/documenting_your_code/
	Aunque las reglas propias permiten operar con simples reemplazos de texto

	Variables de entrada:

		ArregloComentarios - Arreglo que contiene todos los comentarios de un codigo fuente analizado

	Salida:
		Arreglo con todos los comentarios indexados

    REGLAS DE DOCUMENTACION PROPIAS PARA ELEMENTOS COMUNES:
    ------------------------------------------------------
    @Seccion@               Nombre de la sección                - Descripcion
    @Funcion@               Nombre de la funcion                - Descripcion
        @Procedimiento@     Nombre del procedimiento            - Descripcion
            @Param@         Nombre de la variable               - Descripcion
            @Salida@        Descripción de salida o retorno
            @Vease@         Elemento1 - Elemento2 - Elemento3...
    @Menu@                  ElementoVisual - Enlace (Agrega entradas arbitrarias al menu izquierdo)

    Nota: La jerarquia de los elementos hace que se declare como elemento actual de proceso a
    ====  @Seccion@, @Funcion@ ó @Procedimiento@, haciendo que todos los elementos enumerados
          posteriormente sean marcados como inmersos en esas jerarquias.  Util para identificar
          elementos de diferentes archivos y diferentes secciones.  Al recibir otro @@ se
          redefine el elemento actual de proceso para iniciar nuevamente.

    REGLAS DE FORMATEADO COMUNES:
    ----------------------------
    __Subrayado__           Reemplazados como <u> </u> sobre el mismo parrafo o linea hasta el siguiente salto de linea
    **Resaltado**           Reemplazados como <b> </b> sobre el mismo parrafo o linea hasta el siguiente salto de linea
    ºº Viñeta               Parseada hasta el siguiente salto de linea como <li>
    \n\n (reales)           Generan salto de linea (<br>)
    $$Codigo$$              Formato de codigo.  Resaltado e Impreso en fuente de terminal sobre marco especifico
    >>Codigo                Formato de codigo de una sola línea
    !!Imagen-AnchoxAlto!!   Path hacia imagen que se desea agregar. Puede incluir dimensiones
    %%Clase%%               Reemplazado por un item con la clase indicada: <i class="Clase"></i>
    @@Enlace-URL@@          Reemplazado por enlaces hacia la URL indicada
    
    Nota: Todos los elementos despues de parseados e individualizados reciben un TRIM antes de su formato final
    ===== El guion es utilizado como separador en muchas de las propiedades, si su codigo posee
          caracteres de guión inmersos en los comentarios con otro significado podrían malintepretarse 
*/
function PCO_ParsearBloquesDocumentacion($ArregloComentarios)
    {
        global $SaltoLinea,$Tabulacion;
        $ArregloParseado = array();



        //Recorre todos los comentarios recibidos en busca de palabras clave definidas
        foreach ($ArregloComentarios as $Comentario)
            {
                
                
                ###############################  DEPURACION  #############################
                echo "<hr>".$Comentario["comentario"]."<br><b>Tipo:</b>".$Comentario["tipo_origen"]."<br><b>Origen:</b>".$Comentario["detalle_origen"];
                ###############################  DEPURACION  #############################
                
                
                //1.Parsear palabras clave @_____@
                //Generar enlaces unicos
                //2.Definir cambios de secciones o funciones activas
                //3.Formatear cadenas de descripcion
                //4.Agregar registro de BD
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
            }
        return $ArregloParseado;
    }


//$CodigoEntrada='/* comentario */';
//$CodigoEntrada=file_get_contents( "../inc/bootstrap/js/practico.js" );
//$CodigoEntrada=file_get_contents( __FILE__ );
$CodigoEntrada=file_get_contents( "../dev_tools/tests/t_documentador.php" );
$ArregloComentariosIdentificados=PCO_ObtenerBloquesDocumentacion($CodigoEntrada,"Arch","../dev_tools/tests/t_documentador.php");

$ComentariosParseados=PCO_ParsearBloquesDocumentacion($ArregloComentariosIdentificados);