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
$HabilitarDepuracion=FALSE; //Habilita o deshabilita la depuracion haciendo un eco del analisis

$PrefijoInclusion='../../core/';
include_once 'configuracion.php';
// Inicia las conexiones con la BD y las deja listas para las operaciones
include_once 'conexiones.php';
// Incluye definiciones comunes de la base de datos
include_once '../inc/practico/def_basedatos.php';
// Incluye archivo con algunas funciones comunes usadas por la herramienta
include_once 'comunes.php';


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
        global $SaltoLinea,$Tabulacion,$HabilitarDepuracion;
        $ArregloComentarios = array();

        //Define separadores comunes para comentarios segun el tipo de lenguaje
        if ($LenguajeObjetivo=="PHP" || $LenguajeObjetivo=="Java" || $LenguajeObjetivo=="JavaScript" || $LenguajeObjetivo=="C/C++")
            {
                $InicioComentarioSimple1="//";
                $InicioComentarioSimple2="#";   //Comentarios simples por numeral # No se soportan! en tanto pueden estar en otras instrucciones que sin ser parseadas puede arrojar falsos positivos por ahora
                $InicioComentarioBloque1="/*";
                $CierreComentarioBloque1="*/";
            }
        
        //Prepara la cadena inicial con un reemplazo general de cadenas equivalentes
        $CadenaAnalizada= ReemplazarTagsCodigoMultilinea($CadenaAnalizada);

        //Inicia la descomposicion de cadenas por los delimitadores definidos segun lenguaje
        $FinAnalisis=false;
        $PosicionInicio=0;
        $PosicionFin=strlen($CadenaAnalizada);
        $SubCadena=$CadenaAnalizada;
        while (!$FinAnalisis && (count($ArregloComentarios)<=$MaximoComentariosAnalisis-1 || $MaximoComentariosAnalisis==-1) )
            {
                //Busca aparicion de bloque central de comentario.  Si lo encuentra busca cadena de cierre (obligatoria por sintaxis)
                $SubCadenaComentario_Bloque=strstr($SubCadena, $InicioComentarioBloque1, FALSE); //Sin retorno de cadena previa al needle
                $SubCadenaComentario_Simple=strstr($SubCadena, $InicioComentarioSimple1, FALSE); //Sin retorno de cadena previa al needle
                //Determina si encontro al menos un tipo de comentario
                if ($SubCadenaComentario_Bloque!==FALSE || $SubCadenaComentario_Simple!==FALSE)
                    {
                        //Si la cadena de Bloque es Mayor que la de Simple entonces la procesa primero porque su ocurrencia fue encontrada antes sino se va por la simple
                        if (strlen($SubCadenaComentario_Bloque)>strlen($SubCadenaComentario_Simple) && strlen($SubCadenaComentario_Bloque)!==FALSE)
                            {
                                $SubCadenaComentario=$SubCadenaComentario_Bloque;
                                $SubCadenaComentario=strstr($SubCadenaComentario, $CierreComentarioBloque1, TRUE); //Con retorno de cadena previa al needle
                                //No importa si lo cierra o no, si por sintaxis es obligatorio 
                                if ($SubCadenaComentario!==FALSE)
                                    {
                                        $ComentarioParseado = str_replace($InicioComentarioBloque1 , '' ,$SubCadenaComentario  );
                                        //Elimina el comentario que acaba de encontrar de la SubCadena analizada
                                        $SubCadena=str_replace($SubCadenaComentario.$CierreComentarioBloque1 , '' ,$SubCadena  );
                                    }
                            }
                        else
                            {
                                $SubCadenaComentario=$SubCadenaComentario_Simple;
                                $SubCadenaComentario=strstr($SubCadenaComentario, $SaltoLinea, TRUE); //Con retorno de cadena previa al needle
                                //No importa si lo cierra o no, si por sintaxis es obligatorio 
                                if ($SubCadenaComentario!==FALSE)
                                    {
                                        $ComentarioParseado = str_replace($InicioComentarioSimple1 , '' ,$SubCadenaComentario  );
                                        //Elimina el comentario que acaba de encontrar de la SubCadena analizada
                                        $SubCadena=str_replace($SubCadenaComentario.$SaltoLinea , '' ,$SubCadena  );
                                    }
                                else
                                    {
                                        $FinAnalisis=TRUE;
                                    }
                            }
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
	Function: LimpiarLinea
	Retorna el valor de una linea de comentario despues de aplicar la unfion trim.  Utilizado para llamadas mediante arraw_walk

	Variables de entrada:

		LineaSuciaComentario - Cadena con la linea a la que se desea aplicar la funcion de limpieza de caracteres no imprimibles (trim)

	Salida:
		Linea de comentario modificada mediante el cambio de su valor por referencia
*/
function LimpiarLinea(&$LineaSuciaComentario) 
    { 
        $LineaSuciaComentario = trim($LineaSuciaComentario); 
    }


########################################################################
########################################################################
/*
	Function: ReemplazarAliases
	Reemplaza cualquier cadena de alias conocida por su equivalente a sintaxis del documentador.  Utilizado para llamadas mediante arraw_walk

	Variables de entrada:

		CadenaConAlias - Cadena a la que se desea reemplazar los substrings con los alias

	Salida:
		Cadena modificada mediante el cambio de su valor por referencia
*/
function ReemplazarAliases(&$CadenaConAlias) 
    { 
        //TODO:  Hacer esto multi-idioma con definicion de cadenas de inicio genericas de reemplazo aun cuando al final se reemplace por la de español
        $CadenaConAlias = str_ireplace("@seccion@", "@Seccion@", $CadenaConAlias);
        $CadenaConAlias = str_ireplace("@funcion@", "@Funcion@", $CadenaConAlias);
        $CadenaConAlias = str_ireplace("@menu@"   , "@Menu@",    $CadenaConAlias);
        $CadenaConAlias = str_ireplace("@salida@" , "@Salida@",  $CadenaConAlias);
        $CadenaConAlias = str_ireplace("@vease@"  , "@Vease@",   $CadenaConAlias);
        $CadenaConAlias = str_ireplace("@param@"  , "@Param@",   $CadenaConAlias);
        $CadenaConAlias = str_ireplace("@var@"    , "@Param@",   $CadenaConAlias);
    }


########################################################################
########################################################################
/*
	Function: ReemplazarTagsCodigoMultilinea
	Reemplaza cualquier cadena asociada a inicios o fin de bloques de codigo dentro de los comentarios sobre la cadena entregada

	Variables de entrada:

		CadenaConTags - Cadena a la que se desea reemplazar los substrings con los tags

	Salida:
		Cadena modificada
*/
function ReemplazarTagsCodigoMultilinea($CadenaConTags) 
    { 
        //Reemplaza TAGS por compatibilidad hcia NaturalDocs
        $CadenaConTags = str_ireplace(">>", "(start code)", $CadenaConTags);
        $CadenaConTags = str_ireplace("<<", "(end)", $CadenaConTags);

        //Formatea cualquier comentario encontrado
        $InicioComentarioBloque1="(start code)";        $ReemplazoInicioComentarioBloque1='<div class="PCO_BloqueCodigo">';
        $CierreComentarioBloque1="(end)";               $ReemplazoCierreComentarioBloque1='</div>';
        //Inicia la descomposicion de cadenas por los delimitadores definidos segun lenguaje
        $FinAnalisis=false;
        $PosicionInicio=0;
        $PosicionFin=strlen($CadenaConTags);
        $SubCadena=$CadenaConTags;
        while (!$FinAnalisis)
            {
                //Busca aparicion de bloque central de comentario.  Si lo encuentra busca cadena de cierre (obligatoria por sintaxis)
                $SubCadenaComentario_Bloque=strstr($SubCadena, $InicioComentarioBloque1, FALSE); //Sin retorno de cadena previa al needle
                //Determina si encontro al menos un tipo de comentario
                if ($SubCadenaComentario_Bloque!==FALSE)
                    {
                        $SubCadenaComentario=$SubCadenaComentario_Bloque;
                        $SubCadenaComentario=strstr($SubCadenaComentario, $CierreComentarioBloque1, TRUE); //Con retorno de cadena previa al needle
                        //No importa si lo cierra o no, si por sintaxis es obligatorio 
                        if ($SubCadenaComentario!==FALSE)
                            {
                                $ComentarioParseado = str_replace($InicioComentarioBloque1 , '' ,$SubCadenaComentario  );
                                $ComentarioResaltado = ResaltarSintaxisTexto($ComentarioParseado, "php");
                                $SubCadena = str_replace($ComentarioParseado , $ComentarioResaltado ,$SubCadena  );

                                //Elimina el comentario que acaba de encontrar de la SubCadena analizada
                                $SubCadena = preg_replace('/\(start code\)/', $ReemplazoInicioComentarioBloque1 , $SubCadena, 1); //Reemplaza solo primera ocurrencia
                                $SubCadena = preg_replace('/\(end\)/', $ReemplazoCierreComentarioBloque1 , $SubCadena, 1); //Obliga reemplazo de una segunda ocurrencia para el supuesto cierre
                            }
                        else
                            {
                                $FinAnalisis=TRUE;
                            }
                    }
                else
                    {
                        $FinAnalisis=TRUE;
                    }
            }
        return $SubCadena;
    }


########################################################################
########################################################################
/*
	Function: DetectarFormatoEspecial
	Busca en una cadena determinada por simbolos especiales y conocidos que dan formato al texto

	Variables de entrada:

		CadenaBusqueda - Cadena sobre la que se desea buscar subcadenas de formato

	Salida:
		Verdadero o falso segun lo encontrado
*/
function DetectarFormatoEspecial($CadenaBusqueda) 
    { 
        $EstadoBusqueda=FALSE;
        if ($EstadoBusqueda===FALSE && strstr($CadenaBusqueda, '__')!==FALSE) $EstadoBusqueda=TRUE; //__Subrayado__
        if ($EstadoBusqueda===FALSE && strstr($CadenaBusqueda, '**')!==FALSE) $EstadoBusqueda=TRUE; //**Resaltado**
        if ($EstadoBusqueda===FALSE && strstr($CadenaBusqueda, '°°')!==FALSE) $EstadoBusqueda=TRUE; //ºº Viñeta
        if ($EstadoBusqueda===FALSE && strstr($CadenaBusqueda, '!!')!==FALSE) $EstadoBusqueda=TRUE; //!!Imagen-AnchoxAlto!!
        if ($EstadoBusqueda===FALSE && strstr($CadenaBusqueda, '%%')!==FALSE) $EstadoBusqueda=TRUE; //%%Clase%%
        if ($EstadoBusqueda===FALSE && strstr($CadenaBusqueda, '@@')!==FALSE) $EstadoBusqueda=TRUE; //@@Enlace-URL@@
        return $EstadoBusqueda;
    }


########################################################################
########################################################################
/*
	Function: ResaltarSintaxisTexto
	Da formato compatible HTML para colorear la sintaxis de una cadena determinada

	Variables de entrada:

		TextoEntrada - Cadena a la que se desea resaltar su sintaxis
		LenguajeFormato - Lenguaje de programacion diferenciado en caso que se cuente con colores especificos para el mismo

	Salida:
		Cadena formateada en HTML
*/
function ResaltarSintaxisTexto($TextoEntrada, $LenguajeFormato="")
{
    if ($LenguajeFormato == "php")
        {
            ini_set("highlight.comment", "#008000");
            ini_set("highlight.default", "#000000");
            ini_set("highlight.html", "#808080");
            ini_set("highlight.keyword", "#0000BB; font-weight: bold");
            ini_set("highlight.string", "#DD0000");
        }
    if ($LenguajeFormato == "html")
        {
            ini_set("highlight.comment", "green");
            ini_set("highlight.default", "#CC0000");
            ini_set("highlight.html", "#000000");
            ini_set("highlight.keyword", "black; font-weight: bold");
            ini_set("highlight.string", "#0000FF");
        }

    $TextoEntrada = trim($TextoEntrada);
    $TextoEntrada = highlight_string("<?php " . $TextoEntrada, true);  // No importa el lenguaje, la funcion de PHP requiere el tag que lo abre para creer que se trata de su codigo y poder formatearlo
    $TextoEntrada = trim($TextoEntrada);
    $TextoEntrada = preg_replace("|^\\<code\\>\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>|", "", $TextoEntrada, 1);  // Eliminar prefijo
    $TextoEntrada = preg_replace("|\\</code\\>\$|", "", $TextoEntrada, 1);  // Eliminar primer sufijo
    $TextoEntrada = trim($TextoEntrada);  // Eliminar saltos de linea
    $TextoEntrada = preg_replace("|\\</span\\>\$|", "", $TextoEntrada, 1);  // Eliminar segundo sufijo
    $TextoEntrada = trim($TextoEntrada);  // Eliminar saltos de linea
    $TextoEntrada = preg_replace("|^(\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>)(&lt;\\?php&nbsp;)(.*?)(\\</span\\>)|", "\$1\$3\$4", $TextoEntrada);  // remove custom added "<?php "

    return $TextoEntrada;
}


########################################################################
########################################################################
/*
	Function: FormatearCadenaEnHTML
	Da formato compatible HTML desde los simbolos basicos introducidos en la documentacion

	Variables de entrada:

		CadenaBase - Cadena a la que se desea dar formato segun lo ingresado en la documentacion

	Salida:
		Cadena formateada en HTML estandar que representa al elemento
		TODO:  Revisar highlight_file()
*/
function FormatearCadenaEnHTML($CadenaBase) 
    {
        global $HabilitarDepuracion;
        $CadenaFormateada=$CadenaBase;
        //Reemplaza de manera ordenada y por pares de inicio-cierre todas las ocurrencias de cadenas de formato 
        while (DetectarFormatoEspecial($CadenaFormateada)!==FALSE)
            {
                //Detecta Subrayado
                if (strstr($CadenaFormateada, '__')!==FALSE)
                    {
                        $CadenaFormateada = preg_replace('/__/', '<u>', $CadenaFormateada, 1); //Reemplaza solo primera ocurrencia
                        $CadenaFormateada = preg_replace('/__/', '</u>', $CadenaFormateada, 1); //Obliga reemplazo de una segunda ocurrencia para el supuesto cierre
                    }
                //Detecta Reslatado - Negrita
                if (strstr($CadenaFormateada, '**')!==FALSE)
                    {
                        $CadenaFormateada = preg_replace('/\*\*/', '<b>', $CadenaFormateada, 1); //Reemplaza solo primera ocurrencia
                        $CadenaFormateada = preg_replace('/\*\*/', '</b>', $CadenaFormateada, 1); //Obliga reemplazo de una segunda ocurrencia para el supuesto cierre
                    }
                //Detecta Vinetas
                if (strstr($CadenaFormateada, '°°')!==FALSE)
                    {
                        $CadenaFormateada = preg_replace('/°°/', '<li>', $CadenaFormateada, 1); //Reemplaza solo primera ocurrencia
                        //$CadenaFormateada = preg_replace('/°°/', '</li>', $CadenaFormateada, 1); //Obliga reemplazo de una segunda ocurrencia para el supuesto cierre
                    }
                //Detecta Imagenes
                if (strstr($CadenaFormateada, '!!')!==FALSE)
                    {
                        $CadenaFormateada = preg_replace('/!!/', '<img>', $CadenaFormateada, 1); //Reemplaza solo primera ocurrencia
                        $CadenaFormateada = preg_replace('/!!/', '</img>', $CadenaFormateada, 1); //Obliga reemplazo de una segunda ocurrencia para el supuesto cierre
                    }
            }
        return $CadenaFormateada;
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
    @Seccion@                       Nombre de la sección                - Descripcion
        @Funcion@                   Nombre de la funcion                - Descripcion
        Function:                   Alias de @Funcion@ e incluyendo las lineas siguientes que no tengan otro tag diferencial
            @Param@                 Nombre de la variable               - Descripcion
            @param@ a-z A-Z         Alias de @Param@ case insen
            @var@   a-z A-Z         Alias de @Param@
	        Variables de entrada:   Alias de @Param@ e incluyendo las lineas siguientes que no tengan otro tag diferencial
            @Salida@                Descripción de salida o retorno
            Salida:                 Alias de @Salida@ e incluyendo las lineas siguientes que no tengan otro tag diferencial
            @Vease@                 Elemento1 - Elemento2 - Elemento3...
            Ver tambien:            Alias de @Vease@ e incluyendo las lineas siguientes que no tengan otro tag diferencial
    @Menu@                          ElementoVisual - Enlace (Agrega entradas arbitrarias al menu izquierdo)

    Nota: La jerarquia de los elementos hace que se declare como elemento actual de proceso a
    ====  @Seccion@, @Funcion@ ó @Procedimiento@, haciendo que todos los elementos enumerados
          posteriormente sean marcados como inmersos en esas jerarquias.  Util para identificar
          elementos de diferentes archivos y diferentes secciones.  Al recibir otro @@ se
          redefine el elemento actual de proceso para iniciar nuevamente.

    REGLAS DE FORMATEADO COMUNES - SE APLICAN A TODAS LAS DESCRIPCIONES DE ELEMENTOS:
    --------------------------------------------------------------------------------
    __Subrayado__           Reemplazados como <u> </u> sobre el mismo parrafo o linea hasta el siguiente salto de linea
    **Resaltado**           Reemplazados como <b> </b> sobre el mismo parrafo o linea hasta el siguiente salto de linea
    ººViñeta                Reemplazados como <li> sobre el mismo parrafo o linea hasta el siguiente salto de linea
    (start code) y (end)    Formato de codigo de una o multiples lineas.  Puede manejar un alias mediante >>Codigo<<
    !!Imagen-AnchoxAlto!!   Path hacia imagen que se desea agregar. Puede incluir dimensiones
    %%Clase%%               Reemplazado por un item con la clase indicada: <i class="Clase"></i>
    @@Enlace-URL@@          Reemplazado por enlaces hacia la URL indicada
    
    Nota: El guion es utilizado como separador en muchas de las propiedades, si su codigo posee
          caracteres de guión inmersos en los comentarios con otro significado podrían malintepretarse 
*/
function PCO_ParsearBloquesDocumentacion($ArregloComentarios)
    {
        global $SaltoLinea,$Tabulacion,$HabilitarDepuracion;
        $SeccionActiva="";
        $FuncionActiva="";
        $ArregloParseado = array();
        //Estructura: tipo_elemento (seccion, funcion, menu), nombre_seccion, nombre_funcion, hash_md5, descripcion, lista_parametros, descripcion_salida, ver_tambien

        //Recorre todos los comentarios recibidos en busca de palabras clave definidas
        //Esto parsea SOLO UN COMENTARIO A LA VEZ uniendo su salida posteriormente a los demas parseos
        foreach ($ArregloComentarios as $Comentario)
            {
                //Separar por saltos de linea el comentario y eliminar sus espacios y tabulaciones adelante
                $LineasComentario=explode($SaltoLinea,$Comentario["comentario"]);
                array_walk($LineasComentario, 'LimpiarLinea');
                //Elimina elementos en blanco dentro del arreglo
                $LineasComentario = array_filter($LineasComentario);
                //Reemplaza valores comunes de alias por su cadena oficial de documentador
                array_walk($LineasComentario, 'ReemplazarAliases');

                //Recorre cada linea del comentario para parsearla
                foreach ($LineasComentario as $Linea)
                    {
                        //Busca posibles secciones
                        $BusquedaSeccion=strstr($Linea, "@Seccion@", FALSE); //Sin retorno de cadena previa al needle
                        if ($BusquedaSeccion!==FALSE)
                            {
                                $PartesSeccionActivaDetectada=explode("-",str_replace("@Seccion@","",$BusquedaSeccion));
                                $SeccionActiva=trim($PartesSeccionActivaDetectada[0]);
                                $SeccionActivaDes=trim($PartesSeccionActivaDetectada[1]);
                                //Agrega al arreglo de comentarios parseados el elemento de seccion
                                $ArregloParseado[] = ["tipo_elemento" => "seccion", "nombre_seccion" => $SeccionActiva, "nombre_funcion" => "", "nombre_menu" => "", "hash_md5" => md5("SECCION".$SeccionActiva), "descripcion" => FormatearCadenaEnHTML($SeccionActivaDes), "lista_parametros" => FormatearCadenaEnHTML(""), "descripcion_salida" => FormatearCadenaEnHTML(""), "ver_tambien" => "" ];
                                continue; //Pasa al siguiente elemento del arreglo

                            }
                        
                        //Busca posibles menues
                        $BusquedaMenu=strstr($Linea, "@Menu@", FALSE); //Sin retorno de cadena previa al needle
                        if ($BusquedaMenu!==FALSE)
                            {
                                $PartesMenuDetectado=explode("-",str_replace("@Menu@","",$BusquedaMenu));
                                $NombreMenu=trim($PartesMenuDetectado[0]);
                                $EnlaceMenu=trim($PartesMenuDetectado[1]);
                                //Agrega al arreglo de comentarios parseados el elemento de seccion
                                $ArregloParseado[] = ["tipo_elemento" => "menu", "nombre_seccion" => $SeccionActiva, "nombre_funcion" => "", "nombre_menu" => $NombreMenu, "hash_md5" => md5("MENU".$SeccionActiva.$NombreMenu), "descripcion" => $EnlaceMenu, "lista_parametros" => FormatearCadenaEnHTML(""), "descripcion_salida" => FormatearCadenaEnHTML(""), "ver_tambien" => "" ];
                                continue; //Pasa al siguiente elemento del arreglo
                            }


                        //Agregar registro de documentacion a BD
                        PCO_EjecutarSQLUnaria("INSERT INTO core_devdoc (hash,tipo,seccion,funcion,origen,detalle_origen,documentacion) VALUES ('$hash','$tipo','$SeccionActiva','$FuncionActiva','$origen','$detalle_origen','$documentacion') ");

                    }

                //la seccion se puede repetir por registro.  la funcion ES EL REGISTRO mismo con:
                
                //1.Parsear palabras clave @_____@
                //Busca por posibles secciones en el comentario

                //Busca por posibles funciones en el comentario

                //Generar enlaces unicos
                //2.Definir cambios de secciones o funciones activas
                //3.Formatear cadenas de descripcion
                
                
                ###############################  DEPURACION  #############################
                if ($HabilitarDepuracion)  echo "<hr>".$Comentario["comentario"]."<br><b>Tipo:</b>".$Comentario["tipo_origen"]."<br><b>Origen:</b>".$Comentario["detalle_origen"];
                ###############################  DEPURACION  #############################
                //print_r($LineasComentario);
            }
        return $ArregloParseado;
    }

if ($HabilitarDepuracion)
    $CodigoEntrada=file_get_contents( "../dev_tools/tests/t_documentador.php" );

//Limpia cualquier documentacion previa antes de regenerar
$Resultado=PCO_EjecutarSQLUnaria("DELETE FROM core_devdoc WHERE 1=1");

$ArregloComentariosIdentificados=PCO_ObtenerBloquesDocumentacion($CodigoEntrada,"Arch","../dev_tools/tests/t_documentador.php");
$ComentariosParseados=PCO_ParsearBloquesDocumentacion($ArregloComentariosIdentificados);



print_r($ComentariosParseados);