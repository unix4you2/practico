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
	Title: Modulo ajax
	Ubicacion *[/core/ajax.php]*.  Archivo de funciones utilizadas para el retorno de informacion mediante peticiones asincronas

	Section: Controles de datos
	Funciones asociadas a generacion de controles de datos basados en los parametros recibidos
*/
 
//Recupera al menos la accion cuando se trata de llamados sin contexto del index del framework
if (!isset($PCO_Accion)) $PCO_Accion=$_REQUEST["PCO_Accion"];


########################################################################
########################################################################
/*
	Function: PCO_ExportacionQueryCacheCSV
	Este archivo exporta cualquier QueryRecibido a formato CSV en la salida estandar del navegador para ser descargado

	Variables de entrada:

        IdRegistro_CacheSQL - ID unico del Informe asociado a la consulta que se encuentra cacheado
        NombreArchivo - Opcional para generar un nombre de archivo personalizado para el informe

	Salida:
		* Datos a traves del navegador
*/
if ($PCO_Accion=="PCO_ExportacionQueryCacheCSV" ) 
    {   
        // Valida sesion activa de Practico
        @session_start();
        if(!isset($_SESSION['PCOSESS_SesionAbierta'])) {
        	echo '<head><title>Error</title><style type="text/css"> body { background-color: #000000; color: #7f7f7f; font-family: sans-serif,helvetica; } </style></head><body><table width="100%" height="100%" border=0><tr><td align=center>&#9827; Acceso no autorizado !</td></tr></table></body>';
        	die();
        }

        //Se asegura de tener las variables requeridas por filtros y recibidas desde la peticion
        if (!isset($IdRegistro_CacheSQL)) $IdRegistro_CacheSQL=$_REQUEST["IdRegistro_CacheSQL"];
        
        $NombreArchivo=$_REQUEST['NombreArchivo'];
        if ($NombreArchivo=="") $NombreArchivo="DatosExportadosCSV_Inf{$IdRegistro_CacheSQL}.csv";

        include_once '../core/configuracion.php';
        // Inicia las conexiones con la BD y las deja listas para las operaciones
        include_once '../core/conexiones.php';
        // Incluye definiciones comunes de la base de datos
        include_once '../inc/practico/def_basedatos.php';
        // Incluye archivo con algunas funciones comunes usadas por la herramienta
        include_once '../core/comunes.php';
        // Genera conexiones individuales o conexiones para replicacion de transacciones
        include_once '../core/conexiones_extra.php';
        
        $RegistroCacheSQL=PCO_EjecutarSQL("SELECT * FROM core_informe_cache WHERE id='{$IdRegistro_CacheSQL}' AND usuario='".$_SESSION["PCOSESS_LoginUsuario"]."' ")->fetch();
        $ConsultaCacheada=trim($RegistroCacheSQL["script_sql"]);
        $ListaColumnasCache=trim($RegistroCacheSQL["columnas"]);
        $ConexionCache=trim($RegistroCacheSQL["conexion"]);

        //Continua adelante solo si realmente encontro el informe cacheado y coincidente entre id y usuario
        if ($ConsultaCacheada!="")
            {
                //Construye las columnas
                $PCO_ColumnasVisibles=explode(",",$ListaColumnasCache);
        
                //Inicia la entrega de contenidos
                ob_clean();
                $ArchivoDestino = fopen("php://output", 'w');

 		        header("Content-Encoding: utf-8"); 
                header("Content-disposition: attachment; filename=".$NombreArchivo);
                header("Content-Type: text/csv; charset=UTF-8;");
                echo "\xEF\xBB\xBF"; // UTF-8 BOM	
		
                //Agrega las columnas como encabezados
                fputcsv($ArchivoDestino, $PCO_ColumnasVisibles);

                //Determina si el informe obtiene los datosw de conexion local o remota. Si es remota llama la variable global de la conexion pra ser usada
                if ($ConexionCache=="")
                    {
                        //Agrega los datos de cada registro
                        $ResultadoConsulta=PCO_EjecutarSQL($ConsultaCacheada);
                    }
                else
                    {
                        //Agrega los datos de cada registro
                        global ${$ConexionCache};
                        $ResultadoConsulta=PCO_EjecutarSQL($ConsultaCacheada,"",${$ConexionCache});
                    }

                while ($Registro = $ResultadoConsulta->fetch(PDO::FETCH_ASSOC))
                    fputcsv($ArchivoDestino, $Registro);
                //Cierra la salida
                fclose($ArchivoDestino);
            }
    }


########################################################################
########################################################################
/*
	Function: PCO_RecuperarRecordsetJSON_DataTablePANES
	Hace una consulta a la base de datos determinada por un identificador de informe y retorna los registros formateados en JSON.  Util en DataTables con AJAX

	Variables de entrada:

        IdRegistro_CacheSQL - ID unico del Informe asociado a la consulta que se encuentra cacheado
        
        start - Enviado automaticamente por DataTables 
        length - Enviado automaticamente por DataTables 
        search[value] - Enviado automaticamente por DataTables 

    Ver tambien:
        Para efectos de depuracion F12 pestana Network presentara en Headers todo lo enviado por datatables en la solicitud Ajax

	Salida:
		Lista de elementos < option > usados en el combo
*/
if ($PCO_Accion=="PCO_RecuperarRecordsetJSON_DataTablePANES" ) 
    {   
        // Valida sesion activa de Practico
        @session_start();
        if(!isset($_SESSION['PCOSESS_SesionAbierta'])) {
        	echo '<head><title>Error</title><style type="text/css"> body { background-color: #000000; color: #7f7f7f; font-family: sans-serif,helvetica; } </style></head><body><table width="100%" height="100%" border=0><tr><td align=center>&#9827; Acceso no autorizado !</td></tr></table></body>';
        	die();
        }
        
        //Se asegura de tener las variables requeridas por filtros y recibidas desde la peticion
        if (!isset($IdRegistro_CacheSQL)) $IdRegistro_CacheSQL=$_REQUEST["IdRegistro_CacheSQL"];
        if (!isset($NroFilasBase)) $NroFilasBase=$_REQUEST["NroFilasBase"];

        include_once '../core/configuracion.php';
        // Inicia las conexiones con la BD y las deja listas para las operaciones
        include_once '../core/conexiones.php';
        // Incluye definiciones comunes de la base de datos
        include_once '../inc/practico/def_basedatos.php';
        // Incluye archivo con algunas funciones comunes usadas por la herramienta
        include_once '../core/comunes.php';
        
        //Busca la consulta asociada al datatable desde la cache de SQL en la primera generacion del reporte.
        //Verifica no solo por ID de cache sino tambien que perteneca al usuario logueado para evitar robo de datos o informes entre usuarios
        $RegistroCacheSQL=PCO_EjecutarSQL("SELECT * FROM core_informe_cache WHERE id='{$IdRegistro_CacheSQL}' AND usuario='".$_SESSION["PCOSESS_LoginUsuario"]."' ")->fetch();
        $ConsultaCacheada=trim($RegistroCacheSQL["script_sql"]);
        $ListaColumnasCache=trim($RegistroCacheSQL["columnas"]);
        $ListaCamposDT=explode(",",$ListaColumnasCache);

        //BLOQUE1: Ajusta consultas y variables necesarias.  Sigue adelante solo si hay consulta valida
        if ($ConsultaCacheada!="")
            {
                ##Obtiene algunos de los valores recibidos en la solicitud desde el DataTable
                @$PCO_IteracionLlamadosDataTable = $_POST['draw'];                                       //Uso interno de DT
                @$PCO_FilaInicial = $_POST['start'];                                                     //Registro inicial 
                @$PCO_CantidadFilas = $_POST['length'];                                                  //Cantidad deseada de registros usado en LIMIT
                @$ColumnaOrdenamientoRecibidaDT = $_POST['order'][0]['column'];                          //Obtiene la columna de indexado / ordenamiento
                @$PCO_ColumnaOrdenamiento = $_POST['columns'][$ColumnaOrdenamientoRecibidaDT]['data'];   //Columna usada en el ORDER BY
                @$PCO_DireccionOrdenamiento = $_POST['order'][0]['dir'];                                 //Direccion usada en el ordenamiento: asc or desc
                @$PCO_ValorFiltro = $_POST['search']['value'];                                           //Valor ingresado en la caja de filtro por el usuario

                //Corrige valores para un limit basico cuando no se reciben de entrada
                if ($PCO_CantidadFilas=="")
                    {
                        $PCO_FilaInicial=0;
                        $PCO_CantidadFilas=$NroFilasBase;
                    }

                //Busca y/o establece posibles condiciones de filtro adicional recibidas desde el DT en su campo de busqueda
                $PCO_CondicionesFiltrado=" ";
                if(trim($PCO_ValorFiltro) != '')
                    {
                        //Agrega los likes para todos los campos en el complemento de condicion cuando el usuario digita algo en el cuadro de filtro
                        $PCO_CondicionesFiltrado=" AND ( ";

                        //Verifica si los campos tienen aliases o no
                        $ExistenAliasEnCampos=0;
                        $ConsultaBusquedaAlias=strstr($ConsultaCacheada, "FROM", TRUE); //Con retorno de cadena previa al needle
                        $ConsultaBusquedaAlias=str_replace("SELECT", "", $ConsultaBusquedaAlias);
                        //Cambia cualquier combinacion de la sentencia para alias para uniformarla a mausculas 
                        $ConsultaBusquedaAlias=str_replace ( " as ", " AS " , $ConsultaBusquedaAlias);
                        $ConsultaBusquedaAlias=str_replace ( " As ", " AS " , $ConsultaBusquedaAlias);
                        $ConsultaBusquedaAlias=str_replace ( " aS ", " AS " , $ConsultaBusquedaAlias);
                        
                        //CASO 1: La lista de campos contiene la sentenia de Alias.  Busca la palabra As
                            if ( strpos($ConsultaBusquedaAlias," AS ")>0 )
                                {
                                    $ExistenAliasEnCampos=1;
                                    $TrozosCamposAlias=explode(" AS ",$ConsultaBusquedaAlias);
                                    $ListaCamposDTAlias=array();
                                    $TotalTrozos=count($TrozosCamposAlias);
                                    $TrozoAnalizado=1;
                                    //Recorre todos los trozos, normalmente de la forma:   Campo1    Alias1,Campo2    Alias2,Campo3    Alias3...
                                    foreach ($TrozosCamposAlias as $TrozoCampo)
                                        {
                                            $CampoDTAlias="";
                                            //El primer trozo ya llega listo entonces lo agrega directamente, sino lo procesa
                                            if ($TrozoAnalizado==1)
                                                $CampoDTAlias=$TrozoCampo;
                                            else
                                                {
                                                    //Verifica que no sea el ultimo trozo (el cual se descarta)
                                                    if ($TrozoAnalizado!=$TotalTrozos)
                                                        {
                                                            $CampoDTAlias=strstr($TrozoCampo, ",", FALSE); //Con retorno de cadena posterior al needle
                                                            $CampoDTAlias=substr($CampoDTAlias, 1); //Elimina coma inicial sobrante 
                                                        }
                                                }
                                            if ($CampoDTAlias!="")
                                                $PCO_CondicionesFiltrado.=" {$CampoDTAlias} LIKE '%{$PCO_ValorFiltro}%' OR ";
                                            $TrozoAnalizado++;
                                        }
                                }

                        //CASO 2: El mas simple, Cuando no se tienen Aliases en los campos (AS)
                            if ($ExistenAliasEnCampos==0)
                                {
                                    foreach ($ListaCamposDT as $CampoDT)
                                        $PCO_CondicionesFiltrado.=" {$CampoDT} LIKE '%{$PCO_ValorFiltro}%' OR ";
                                }

                        $PCO_CondicionesFiltrado.=" 1=2 ) "; //Agrega una condicion que nunca se cumple para los OR y Cierra el AND del SQL
                    }

                //PROCESA LA CONSULTA DE BASE separando en partes y generando las subconsultas para conteo de registros y agregando ademas las condiciones
                //1. Construye consulta para gran TOTAL de registros en la consulta
                $SubCadena=strstr($ConsultaCacheada, "FROM", FALSE); //SIN retorno de cadena previa al needle
                $ConsultaTotalRegistros = "SELECT COUNT(*) AS allcount  {$SubCadena}";

                //2. Construye consulta para TOTAL de registros en la consulta al aplicar filtros
                $ConsultaTotalRegistrosFiltrados = "{$ConsultaTotalRegistros} {$PCO_CondicionesFiltrado}";

                //3. Construye consulta para obtener los registros
                    $CadenaOrderBy=" ";
                    if ($PCO_ColumnaOrdenamiento!="")
                        $CadenaOrderBy=" ORDER BY $PCO_ColumnaOrdenamiento $PCO_DireccionOrdenamiento ";
                    $ConsultaCacheadaRegistros="{$ConsultaCacheada} {$PCO_CondicionesFiltrado} {$CadenaOrderBy} LIMIT {$PCO_FilaInicial},{$PCO_CantidadFilas} ";

                if(1==2) //Solo para efectos de depuracion mediante F12 - Network, cambiar a condicion invalida en produccion
                    {
                        echo "
                            <br>ConsultaOriginal=$ConsultaCacheada
                            <br>ConsultaTotalRegistros=$ConsultaTotalRegistros
                            <br>ConsultaTotalRegistrosFiltrados=$ConsultaTotalRegistrosFiltrados
                            <br>ConsultaRegistros=$ConsultaCacheadaRegistros
                            <br>PCO_ValorFiltro=$PCO_ValorFiltro
                        ";
                        die();
                    }
            }

        //BLOQUE2: Genera conteos y datos requeridos.  Sigue adelante solo si hay consulta valida
        if ($ConsultaCacheada!="")
            {
                //Obitene el Total de registros en la consulta de base SIN filtros
                $PCO_TotalRegistrosConsulta = PCO_EjecutarSQL($ConsultaTotalRegistros)->fetchColumn();
        
                //Obtiene el total de registros en la consulta CON filtros aplicados
                $PCO_TotalRegistrosConsultaCONFiltro = PCO_EjecutarSQL($ConsultaTotalRegistrosFiltrados)->fetchColumn();
        
                //Hace la consulta desde la cache de SQL
                $RegistrosRecuperados = PCO_EjecutarSQL($ConsultaCacheadaRegistros)->fetchAll();
        
                //Define el arreglo con los datos y lo llena desde cada fila del registro
                $PCO_ArregloDatosRegistros = array();
                    foreach($RegistrosRecuperados as $row)
                        {
                            $ArregloAsociativoCampos=array();
                            //Recorre todos los campos definidos para agregarlos como llaves al arreglo de registro
                            foreach ($ListaCamposDT as $CampoDT)
                                {
                                    //Agrega el par Key-Value con el campo correspondiente al arreglo de registro
                                    $ArregloAsociativoCampos += array( $CampoDT => $row[$CampoDT] ); 
                                }
                            $PCO_ArregloDatosRegistros[]=$ArregloAsociativoCampos;          //Agrega el arreglo de registro al arreglo de resultado general
                        }
        
                //Define la respuesta con los datos obtenidos
                //Antes el elemento data era aaData

$PCO_ArregloPanes='


"SearchPanes": {
  "options": { 
    "Identificador": [ 
      { "label": "6", "total": "100", "value": "6", "count": "100" } 
      ]
       } }

';

//$PCO_ArregloPanes=json_encode($PCO_ArregloPanes);

                $RespuestaFormatoJSON = array(
                   "draw" => intval($PCO_IteracionLlamadosDataTable),
                   "iTotalRecords" => $PCO_TotalRegistrosConsulta,
                   "iTotalDisplayRecords" => $PCO_TotalRegistrosConsultaCONFiltro,
                   "data" => $PCO_ArregloDatosRegistros,
                   $PCO_ArregloPanes
                );



$RespuestaFormatoJSON='{"draw":0,"iTotalRecords":"4329","iTotalDisplayRecords":"4329","data":[{"Identificador":"1","Fecha":"2021-05-21","Dia":"21","Mes":"5","Ano":"2021","Hora":"20:28:39","Usuario":"admin","Accion":"Elimina informe -29"},{"Identificador":"2","Fecha":"2021-05-21","Dia":"21","Mes":"5","Ano":"2021","Hora":"20:28:39","Usuario":"admin","Accion":"Elimina formulario -6"},{"Identificador":"3","Fecha":"2021-05-21","Dia":"21","Mes":"5","Ano":"2021","Hora":"20:28:39","Usuario":"admin","Accion":"Elimina formulario -21"},{"Identificador":"4","Fecha":"2021-05-21","Dia":"21","Mes":"5","Ano":"2021","Hora":"20:28:39","Usuario":"admin","Accion":"Elimina informe -28"},{"Identificador":"5","Fecha":"2021-05-21","Dia":"21","Mes":"5","Ano":"2021","Hora":"20:28:39","Usuario":"admin","Accion":"Elimina formulario -11"},{"Identificador":"6","Fecha":"2021-05-21","Dia":"21","Mes":"5","Ano":"2021","Hora":"20:28:39","Usuario":"admin","Accion":"Elimina informe -19"},{"Identificador":"7","Fecha":"2021-05-21","Dia":"21","Mes":"5","Ano":"2021","Hora":"20:28:39","Usuario":"admin","Accion":"Elimina informe -15"},{"Identificador":"8","Fecha":"2021-05-21","Dia":"21","Mes":"5","Ano":"2021","Hora":"20:28:39","Usuario":"admin","Accion":"Elimina informe -22"},{"Identificador":"9","Fecha":"2021-05-21","Dia":"21","Mes":"5","Ano":"2021","Hora":"20:28:39","Usuario":"admin","Accion":"Elimina informe -10"},{"Identificador":"10","Fecha":"2021-05-21","Dia":"21","Mes":"5","Ano":"2021","Hora":"20:28:39","Usuario":"admin","Accion":"Elimina formulario -15"}],"SearchPanes":{"options":{"Identificador":[{"label":"6","total":"100","value":"6","count":"100"}]}}}';

echo $RespuestaFormatoJSON;
                
                //Entrega resultados en JSON formateados para DT
                //echo json_encode($RespuestaFormatoJSON);

                //Finaliza ejecucion para evitar datos basura
                die();
            }
    }


########################################################################
########################################################################
/*
	Function: PCO_RecuperarRecordsetJSON_DataTable
	Hace una consulta a la base de datos determinada por un identificador de informe y retorna los registros formateados en JSON.  Util en DataTables con AJAX

	Variables de entrada:

        IdRegistro_CacheSQL - ID unico del Informe asociado a la consulta que se encuentra cacheado
        
        start - Enviado automaticamente por DataTables 
        length - Enviado automaticamente por DataTables 
        search[value] - Enviado automaticamente por DataTables 

    Ver tambien:
        Para efectos de depuracion F12 pestana Network presentara en Headers todo lo enviado por datatables en la solicitud Ajax

	Salida:
		Lista de elementos < option > usados en el combo
*/
if ($PCO_Accion=="PCO_RecuperarRecordsetJSON_DataTable" ) 
    {   
        // Valida sesion activa de Practico
        @session_start();
        if(!isset($_SESSION['PCOSESS_SesionAbierta'])) {
        	echo '<head><title>Error</title><style type="text/css"> body { background-color: #000000; color: #7f7f7f; font-family: sans-serif,helvetica; } </style></head><body><table width="100%" height="100%" border=0><tr><td align=center>&#9827; Acceso no autorizado !</td></tr></table></body>';
        	die();
        }
        
        //Se asegura de tener las variables requeridas por filtros y recibidas desde la peticion
        if (!isset($IdRegistro_CacheSQL)) $IdRegistro_CacheSQL=$_REQUEST["IdRegistro_CacheSQL"];
        if (!isset($NroFilasBase)) $NroFilasBase=$_REQUEST["NroFilasBase"];

        include_once '../core/configuracion.php';
        // Inicia las conexiones con la BD y las deja listas para las operaciones
        include_once '../core/conexiones.php';
        // Incluye definiciones comunes de la base de datos
        include_once '../inc/practico/def_basedatos.php';
        // Incluye archivo con algunas funciones comunes usadas por la herramienta
        include_once '../core/comunes.php';
        
        //Busca la consulta asociada al datatable desde la cache de SQL en la primera generacion del reporte.
        //Verifica no solo por ID de cache sino tambien que perteneca al usuario logueado para evitar robo de datos o informes entre usuarios
        $RegistroCacheSQL=PCO_EjecutarSQL("SELECT * FROM core_informe_cache WHERE id='{$IdRegistro_CacheSQL}' AND usuario='".$_SESSION["PCOSESS_LoginUsuario"]."' ")->fetch();
        $ConsultaCacheada=trim($RegistroCacheSQL["script_sql"]);
        $ListaColumnasCache=trim($RegistroCacheSQL["columnas"]);
        $ListaCamposDT=explode(",",$ListaColumnasCache);

        //BLOQUE1: Ajusta consultas y variables necesarias.  Sigue adelante solo si hay consulta valida
        if ($ConsultaCacheada!="")
            {
                ##Obtiene algunos de los valores recibidos en la solicitud desde el DataTable
                @$PCO_IteracionLlamadosDataTable = $_POST['draw'];                                       //Uso interno de DT
                @$PCO_FilaInicial = $_POST['start'];                                                     //Registro inicial 
                @$PCO_CantidadFilas = $_POST['length'];                                                  //Cantidad deseada de registros usado en LIMIT
                @$ColumnaOrdenamientoRecibidaDT = $_POST['order'][0]['column'];                          //Obtiene la columna de indexado / ordenamiento
                @$PCO_ColumnaOrdenamiento = $_POST['columns'][$ColumnaOrdenamientoRecibidaDT]['data'];   //Columna usada en el ORDER BY
                @$PCO_DireccionOrdenamiento = $_POST['order'][0]['dir'];                                 //Direccion usada en el ordenamiento: asc or desc
                @$PCO_ValorFiltro = $_POST['search']['value'];                                           //Valor ingresado en la caja de filtro por el usuario

                //Corrige valores para un limit basico cuando no se reciben de entrada
                if ($PCO_CantidadFilas=="")
                    {
                        $PCO_FilaInicial=0;
                        $PCO_CantidadFilas=$NroFilasBase;
                    }

                //Busca y/o establece posibles condiciones de filtro adicional recibidas desde el DT en su campo de busqueda
                $PCO_CondicionesFiltrado=" ";
                if(trim($PCO_ValorFiltro) != '')
                    {
                        //Agrega los likes para todos los campos en el complemento de condicion cuando el usuario digita algo en el cuadro de filtro
                        $PCO_CondicionesFiltrado=" AND ( ";

                        //Verifica si los campos tienen aliases o no
                        $ExistenAliasEnCampos=0;
                        $ConsultaBusquedaAlias=strstr($ConsultaCacheada, "FROM", TRUE); //Con retorno de cadena previa al needle
                        $ConsultaBusquedaAlias=str_replace("SELECT", "", $ConsultaBusquedaAlias);
                        //Cambia cualquier combinacion de la sentencia para alias para uniformarla a mausculas 
                        $ConsultaBusquedaAlias=str_replace ( " as ", " AS " , $ConsultaBusquedaAlias);
                        $ConsultaBusquedaAlias=str_replace ( " As ", " AS " , $ConsultaBusquedaAlias);
                        $ConsultaBusquedaAlias=str_replace ( " aS ", " AS " , $ConsultaBusquedaAlias);
                        
                        //CASO 1: La lista de campos contiene la sentenia de Alias.  Busca la palabra As
                            if ( strpos($ConsultaBusquedaAlias," AS ")>0 )
                                {
                                    $ExistenAliasEnCampos=1;
                                    $TrozosCamposAlias=explode(" AS ",$ConsultaBusquedaAlias);
                                    $ListaCamposDTAlias=array();
                                    $TotalTrozos=count($TrozosCamposAlias);
                                    $TrozoAnalizado=1;
                                    //Recorre todos los trozos, normalmente de la forma:   Campo1    Alias1,Campo2    Alias2,Campo3    Alias3...
                                    foreach ($TrozosCamposAlias as $TrozoCampo)
                                        {
                                            $CampoDTAlias="";
                                            //El primer trozo ya llega listo entonces lo agrega directamente, sino lo procesa
                                            if ($TrozoAnalizado==1)
                                                $CampoDTAlias=$TrozoCampo;
                                            else
                                                {
                                                    //Verifica que no sea el ultimo trozo (el cual se descarta)
                                                    if ($TrozoAnalizado!=$TotalTrozos)
                                                        {
                                                            $CampoDTAlias=strstr($TrozoCampo, ",", FALSE); //Con retorno de cadena posterior al needle
                                                            $CampoDTAlias=substr($CampoDTAlias, 1); //Elimina coma inicial sobrante 
                                                        }
                                                }
                                            if ($CampoDTAlias!="")
                                                $PCO_CondicionesFiltrado.=" {$CampoDTAlias} LIKE '%{$PCO_ValorFiltro}%' OR ";
                                            $TrozoAnalizado++;
                                        }
                                }

                        //CASO 2: El mas simple, Cuando no se tienen Aliases en los campos (AS)
                            if ($ExistenAliasEnCampos==0)
                                {
                                    foreach ($ListaCamposDT as $CampoDT)
                                        $PCO_CondicionesFiltrado.=" {$CampoDT} LIKE '%{$PCO_ValorFiltro}%' OR ";
                                }

                        $PCO_CondicionesFiltrado.=" 1=2 ) "; //Agrega una condicion que nunca se cumple para los OR y Cierra el AND del SQL
                    }

                //PROCESA LA CONSULTA DE BASE separando en partes y generando las subconsultas para conteo de registros y agregando ademas las condiciones
                //1. Construye consulta para gran TOTAL de registros en la consulta
                $SubCadena=strstr($ConsultaCacheada, "FROM", FALSE); //SIN retorno de cadena previa al needle
                $ConsultaTotalRegistros = "SELECT COUNT(*) AS allcount  {$SubCadena}";

                //2. Construye consulta para TOTAL de registros en la consulta al aplicar filtros
                $ConsultaTotalRegistrosFiltrados = "{$ConsultaTotalRegistros} {$PCO_CondicionesFiltrado}";

                //3. Construye consulta para obtener los registros
                    $CadenaOrderBy=" ";
                    if ($PCO_ColumnaOrdenamiento!="")
                        $CadenaOrderBy=" ORDER BY $PCO_ColumnaOrdenamiento $PCO_DireccionOrdenamiento ";
                    $ConsultaCacheadaRegistros="{$ConsultaCacheada} {$PCO_CondicionesFiltrado} {$CadenaOrderBy} LIMIT {$PCO_FilaInicial},{$PCO_CantidadFilas} ";

                if(1==2) //Solo para efectos de depuracion mediante F12 - Network, cambiar a condicion invalida en produccion
                    {
                        echo "
                            <br>ConsultaOriginal=$ConsultaCacheada
                            <br>ConsultaTotalRegistros=$ConsultaTotalRegistros
                            <br>ConsultaTotalRegistrosFiltrados=$ConsultaTotalRegistrosFiltrados
                            <br>ConsultaRegistros=$ConsultaCacheadaRegistros
                            <br>PCO_ValorFiltro=$PCO_ValorFiltro
                        ";
                        die();
                    }
            }

        //BLOQUE2: Genera conteos y datos requeridos.  Sigue adelante solo si hay consulta valida
        if ($ConsultaCacheada!="")
            {
                //Determina la conexion utilizada por el informe
                $ConexionAUtilizar="";
                $IdInformeCacheado=$RegistroCacheSQL["informe"];
                //$ConexionBDInforme=PCO_EjecutarSQL("SELECT conexion_origen_datos FROM core_informe WHERE id='{$IdInformeCacheado}' ")->fetchColumn();
                $ConexionBDInforme=PCO_EjecutarSQL("SELECT conexion_origen_datos FROM core_informe,core_replicasbd WHERE core_replicasbd.nombre=core_informe.conexion_origen_datos AND core_informe.id='{$IdInformeCacheado}' ")->fetchColumn();
                if($ConexionBDInforme!=""  )
                    {
                        // Genera conexiones individuales o conexiones para replicacion de transacciones
                        include_once '../core/conexiones_extra.php';
                        $ConexionAUtilizar=${$ConexionBDInforme};
                    }

                //Obitene el Total de registros en la consulta de base SIN filtros
                $PCO_TotalRegistrosConsulta = PCO_EjecutarSQL($ConsultaTotalRegistros,"",$ConexionAUtilizar)->fetchColumn();
        
                //Obtiene el total de registros en la consulta CON filtros aplicados
                $PCO_TotalRegistrosConsultaCONFiltro = PCO_EjecutarSQL($ConsultaTotalRegistrosFiltrados,"",$ConexionAUtilizar)->fetchColumn();
        
                //Hace la consulta desde la cache de SQL
                $RegistrosRecuperados = PCO_EjecutarSQL($ConsultaCacheadaRegistros,"",$ConexionAUtilizar)->fetchAll();

                //Define el arreglo con los datos y lo llena desde cada fila del registro
                $PCO_ArregloDatosRegistros = array();
                    foreach($RegistrosRecuperados as $row)
                        {
                            $ArregloAsociativoCampos=array();
                            //Recorre todos los campos definidos para agregarlos como llaves al arreglo de registro
                            foreach ($ListaCamposDT as $CampoDT)
                                {
                                    //Agrega el par Key-Value con el campo correspondiente al arreglo de registro
                                    $ArregloAsociativoCampos += array( $CampoDT => $row[$CampoDT] ); 
                                }
                            $PCO_ArregloDatosRegistros[]=$ArregloAsociativoCampos;          //Agrega el arreglo de registro al arreglo de resultado general
                        }
        
                //Define la respuesta con los datos obtenidos
                //Antes el elemento data era aaData
                $RespuestaFormatoJSON = array(
                   "draw" => intval($PCO_IteracionLlamadosDataTable),
                   "iTotalRecords" => $PCO_TotalRegistrosConsulta,
                   "iTotalDisplayRecords" => $PCO_TotalRegistrosConsultaCONFiltro,
                   "data" => $PCO_ArregloDatosRegistros
                );

                //Entrega resultados en JSON formateados para DT
                echo json_encode($RespuestaFormatoJSON);
                //Finaliza ejecucion para evitar datos basura
                die();
            }
    }


########################################################################
########################################################################
/*
	Function: PCO_ObtenerOpcionesComboBox
	Hace una consulta a la base de datos y retorna las opciones a desplegar en una lista de seleccion o combobox

	Variables de entrada:

        origen_lista_tablas - Lista de tablas separadas por coma
        origen_lista_opciones - Campo que sera agregado al select para obtener la lista de opciones
        origen_lista_valores -  Campo que sera agregado al select para obtener la lista de valores
        condicion_filtrado_listas - Condiones a ser agregadas en el where para filtrar los registros
        PCO_Prefijo - Cadena para anteponer a las opciones.  Podria recibir algo como un  <option value="  para inciar opciones de un combo o un | para otros usos (por ejemplo)
        PCO_Infijo - Cadena para agregar entre el valor y la opcion visual.  Podria recibir algo como un  ">  para cerrar opciones de un combo o un | para otros usos (por ejemplo)
        PCO_Posfijo - Cadena para agregar al final de cada opcion.  Podria recibir algo como un  </option>  para inciar opciones de un combo o un | para otros usos (por ejemplo)

	Salida:
		Lista de elementos < option > usados en el combo

*/
if ($PCO_Accion=="PCO_ObtenerOpcionesComboBox") 
    {
        $PCO_MensajeError="";
        $PCO_SalidaCombos="";
        //Valida variables minimas para la consulta
        if (@$origen_lista_tablas=="" || @$origen_lista_opciones=="" || @$origen_lista_valores=="")
            {
                $PCO_MensajeError.='<option>[Error] Parametros de seleccion</option>';
                if (@$origen_lista_tablas=="") $PCO_MensajeError.='<option>[Causa] Falta origen_lista_tablas</option>';
                if (@$origen_lista_opciones=="") $PCO_MensajeError.='<option>[Causa] Falta origen_lista_opciones</option>';
                if (@$origen_lista_valores=="") $PCO_MensajeError.='<option>[Causa] Falta origen_lista_valores</option>';
            }

        //Decodifica variables si aplica
        if ($PCO_UsandoBase64==1)
            {
                $origen_lista_tablas=base64_decode($origen_lista_tablas);
                $origen_lista_opciones=base64_decode($origen_lista_opciones);
                $origen_lista_valores=base64_decode($origen_lista_valores);
                $condicion_filtrado_listas=base64_decode($condicion_filtrado_listas);
                $PCO_Prefijo=base64_decode($PCO_Prefijo);
                $PCO_Infijo=base64_decode($PCO_Infijo);
                $PCO_Posfijo=base64_decode($PCO_Posfijo);
            }

        //Pendiente proteger tablas o campos CORE
        // ******************** //

        //Si no ha obtenido mensajes de error inicia la consulta
        if ($PCO_MensajeError=="")
            {
                // Se buscan los registros para el combo
                $complemento_condicion_filtrado="";
                if (@$condicion_filtrado_listas!="") $complemento_condicion_filtrado=" AND ($condicion_filtrado_listas) ";
                $consulta_registros_combo=PCO_EjecutarSQL("SELECT $origen_lista_opciones as opcion, $origen_lista_valores as valor FROM $origen_lista_tablas WHERE 1 $complemento_condicion_filtrado ");
                while ($registro_opciones_combo = $consulta_registros_combo->fetch())
					$PCO_SalidaCombos.=$PCO_Prefijo.$registro_opciones_combo['valor'].$PCO_Infijo.$registro_opciones_combo['opcion'].$PCO_Posfijo;
            }

        //Retorna el resultado final
        if ($PCO_MensajeError!="")
            echo $PCO_MensajeError;
        else
            echo $PCO_SalidaCombos;
    }


########################################################################
########################################################################
/*
	Function: valor_campo_tabla
	Hace una consulta a la base de datos sobre un campo y tabla especificos y retorna su valor.  Acepta condiciones de filtrado

	Variables de entrada:

        campo - Campo que se desea retornar
        tabla - En donde se busca el valor
        condicion - condicion de filtrado que debe cumplir el registro

	Salida:
		Valor del campo o vacio si no se encuentra nada
    
    Ejemplo de llamado:
    index.php?PCO_Accion=valor_campo_tabla&campo=login&tabla=core_usuario&condicion=login%3d'pepito.perez'&Presentar_FullScreen=1

*/
if ($PCO_Accion=="valor_campo_tabla") 
    {
        if($condicion=="") $condicion="1=1";
        $registro=PCO_EjecutarSQL("SELECT $campo FROM $tabla WHERE $condicion ")->fetch();

        if (@ob_clean() === false) throw new \RuntimeException('Error no se pudo hacer ob_clean en funcion de valor_campo_tabla.');
        if ($registro[0]!="")
            echo trim($registro[0]);
        else
            echo "";
    }


########################################################################
########################################################################
/*
	Section: Acciones a ser ejecutadas (si aplica) en cada cargue de la herramienta
*/

########################################################################
########################################################################
/*
	Function: cambiar_estado_campo
	Abre los espacios de trabajo dinamicos sobre el contenedor principal donde se despliega informacion

	Variables de entrada:

		tabla - Nombre de la tabla que contiene el registro a actualizar.
		campo - Nombre del campo que sera actualizado.
		id - Valor Identificador unico del campo a ser actualizado.
		PCO_CambioEstado_CampoLlave - Nombre del campo que sera utulizado para comparar.  Si no se recibe se asume id
		valor - Valor a ser asignado en el campo del registro cuyo identificador coincida con el recibido.
		PCO_CambioEstado_NegarRetorno - Determina si se debe o no retornar despues de un cambio.  Valor vacio hace que se ejecute la operacion por defecto y retorne.
		PCO_CambioEstado_NoUsarCore - Determina si anular o no el prefijo de tablas Core de la operacion. 1=anula, otros valores dejaran el prefijo core

	Salida:

		Valor actualizado en el campo y retorno al escritorio de la aplicacion.  En caso de error se retorna al escritorio sin realizar cambios ante el fallo del query.
*/
if (@$PCO_Accion=="cambiar_estado_campo")
	{		
		$mensaje_error="";
		if ($mensaje_error=="")
			{
				//Determina el tipo de objeto sobre el que se hace el cambio
				$TipoCampo="";
				if (@$formulario!="") $TipoCampo.="Frm:".$formulario;
				if (@$informe!="") $TipoCampo.="Inf:".$informe;
				
				//Define el campo sobre el cual se hace la operacion
				if (@$PCO_CambioEstado_CampoLlave=="")	$PCO_CambioEstado_CampoLlave="id";
				
				//Algunas operaciones requieren por defecto usar los prefijos Core.  Si se desea pueden anularse con el parametro en 1
				$PrefijoTablas="core_";
				if ($PCO_CambioEstado_NoUsarCore==1) $PrefijoTablas="";
				
				PCO_EjecutarSQLUnaria("UPDATE ".$PrefijoTablas."$tabla SET $campo = '$valor' WHERE $PCO_CambioEstado_CampoLlave = ? ","$id");
		        if (@PCO_Auditar("Cambia estado del campo $campo en objetoID $TipoCampo") === false) throw new \RuntimeException('Error no se pudo llevar un registro de auditoria en funcion cambiar_estado_campo');

				if (@$PCO_CambioEstado_NegarRetorno=="")
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
							<input type="Hidden" name="PCO_Accion" value="'.$accion_retorno.'">
							<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
							<input type="Hidden" name="formulario" value="'.@$formulario.'">
							<input type="Hidden" name="informe" value="'.@$informe.'">
							<input type="Hidden" name="popup_activo" value="'.$popup_activo.'">
						</form>
						<script type="" language="JavaScript">
						//setTimeout ("document.cancelar.submit();", 10); 
						document.cancelar.submit();
						</script>';
			}
		else
			echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="PCO_EditarFormulario">
					<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
					<input type="Hidden" name="formulario" value="'.$formulario.'">
					<input type="Hidden" name="informe" value="'.$informe.'">
					<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
					<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
				</form>
				<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
	}
	


########################################################################
########################################################################
/*
	Function: PCO_ObtenerOpcionesAjaxSelect
	Consulta de manera dinamica los elementos requeridos para una lista de seleccion

	Variables de entrada:

		PCO_TablaConsulta - Nombre de la tabla que contiene los datos.  Puede ser combinacion de tablas separadas por coma sin olvidar agregar la condicion de llaves foraneas
		PCO_ListaCamposRetorno - Lista de campos separados por coma que seran devueltos por el query
		PCO_ListaCamposBusqueda - Lista de campos separados unicamente por coma y que son utilizados para la consulta tipo LIKE con el valor recibido
		PCO_CondicionFiltrado - OPCIONAL Condicion a ser agregada a la clausula WHERE de la consulta que filtra resultados

	Salida:

		Objeto JSON con los resultados o registros coincidentes o un mensaje de error formateado como JSON ante cualquier eventualidad
*/
if (@$PCO_Accion=="PCO_ObtenerOpcionesAjaxSelect")
	{		
        //Construye la cadena de filtrado para la consulta
        $ListaCamposArray=explode ("," , $PCO_ListaCamposBusqueda );
        foreach ($ListaCamposArray as $CampoBusqueda)
            $CadenaCondicionCamposFiltro.=" $CampoBusqueda LIKE '%$q%' OR ";
        $CadenaCondicionCamposFiltro = substr($CadenaCondicionCamposFiltro, 0, -3);
        
        $HayResultados=0;
        //Valida que se reciban todos los parametros requeridos
        if ($PCO_ListaCamposRetorno!="" && $PCO_ListaCamposBusqueda!="" && $PCO_TablaConsulta!="")
            {
                $Resultados='[';
                $Consulta=PCO_EjecutarSQL("SELECT $PCO_ListaCamposRetorno FROM $PCO_TablaConsulta WHERE  ($CadenaCondicionCamposFiltro) $PCO_CondicionFiltrado ");
                while ($Registro=$Consulta->fetch())
                    {
                        $Resultados.='
                            {
                                "V": "'.trim($Registro[0]).'",
                                "T": "'.trim($Registro[1]).'",
                                "S": "'.trim($Registro[2]).'",
                                "I": "'.trim($Registro[3]).'"
                            },';
                        $HayResultados=1;
                    }
                $Resultados = substr($Resultados, 0, -1);
                $Resultados.=']';
            }

        if (!$HayResultados)
            $Resultados='
                [
                ]';

        //Devuelve el JSON generado con los resultados
        echo $Resultados;
        die();
	}


########################################################################
########################################################################
/*
	Function: PCO_ObtenerEstadoServidorWeb
	Retorna estado formateado con información básica del servidor web que corre el Framework

	Salida:

		HTML formateado con: Carga, Uptime, Almacenamiento y RAM
*/
if (@$PCO_Accion=="PCO_ObtenerEstadoServidorWeb")
	{
	    //Presenta estadisticas del servidor solo a usuarios administradores
    	if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
            {
                //Presenta estado solo el linux y unix-like
                if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN')
                    {
                        //Verifica funcion exec habilitada
                        if (function_exists('exec'))
                            {
                                echo "<div class='well well-sm'><div align=center class='well well-sm'><b><i class='fa fa-fw fa-spinner fa-spin'></i> <font color=red> Estado del servidor web </font></b> <i><font size=1>(5 seg)</font></i></div>";
                                echo "<div class='row'>";
                                
                                    //Carga promedio del sistema
                                    echo "<div class='col col-xs-12 col-sm-12 col-md-4 col-lg-4'>";
                                                $ComandoUptime = @exec('uptime');  
                                                preg_match("/averages?: ([0-9\.]+),[\s]+([0-9\.]+),[\s]+([0-9\.]+)/",$ComandoUptime,$Promedios);
                                                echo "<b><i class='fa fa-fw fa-dashboard'></i> Carga promedio:</b> <span class='badge badge-secondary'> ".$Promedios[1]."</span> <span class='badge badge-secondary'>" .$Promedios[2]. "</span> <span class='badge badge-secondary'>".$Promedios[3]."</span>";
                                                
                                                //Tiempo de encendido
                                                $ComandoUptime = @exec('uptime');  
                                                $TiempoEncendido = explode(' up ', $ComandoUptime);
                                                $TiempoEncendido = explode(',', $TiempoEncendido[1]);
                                                $TiempoEncendido = $TiempoEncendido[0].', '.$TiempoEncendido[1];
                                                echo "<br><br><b><i class='fa fa-fw fa-power-off'></i> Tiempo en l&iacute;nea:</b> {$TiempoEncendido}";
                                    echo "</div>";
                                
                                
                                    echo "<div class='col col-xs-12 col-sm-12 col-md-4 col-lg-4'>";
                                                //Estado de los discos
                                                function ObtenerUnidadesMedida($bytes)
                                                    {
                                                    	$symbol = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
                                                    	$exp = floor(log($bytes)/log(1024));
                                                    	
                                                    	return sprintf('%.2f<small>'.$symbol[$exp].'</small>', ($bytes/pow(1024, floor($exp))));
                                                    }
                                                $ArregloDiscos = array();
                                                $ArregloDiscos[] = array("name" => "Local" , "path" => getcwd()) ;
                                                //$ArregloDiscos[] = array("name" => "Otro disco 1" , "path" => '/run') ;
                                                //$ArregloDiscos[] = array("name" => "Otro disco 2" , "path" => '/var/log') ;
                                                
                                                $ResumenDiscos="";
                                                foreach($ArregloDiscos as $Disco)
                                                    {
                                                        $TamanoTotalDisco = disk_total_space($Disco["path"]);
                                                        $TamanoDisponibleDisco = disk_free_space($Disco["path"]);
                                                        $PorcentajeDiscoDisponible = 100 - round($TamanoDisponibleDisco*1.0 / $TamanoTotalDisco*100, 2);
                                                        $ResumenDiscos .= "<br><span class='badge badge-secondary'>Disco " .$Disco['name'].'</span> '. ObtenerUnidadesMedida($TamanoDisponibleDisco) . '/'. ObtenerUnidadesMedida($TamanoTotalDisco);
                                                        $ResumenDiscos .= '
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated role="progressbar" style="width: '.$PorcentajeDiscoDisponible.'%;" aria-valuenow="'.$PorcentajeDiscoDisponible.'" aria-valuemin="0" aria-valuemax="100">'.$PorcentajeDiscoDisponible.'%</div>
                                                            </div>';
                                                    }
                                                echo "<b><i class='fa fa-fw fa-hdd-o'></i> Almacenamiento:</b> " . $ResumenDiscos;
                                    echo "</div>";
                                    
                                    //Memoria RAM
                                    echo "<div class='col col-xs-12 col-sm-12 col-md-4 col-lg-4'>";
                                                $TotalMemoriaRAM = preg_split('/ +/', @exec('grep MemTotal /proc/meminfo'));
                                                $TotalMemoriaRAM = $TotalMemoriaRAM[1];
                                                $MemoriaLibre = preg_split('/ +/', @exec('grep MemFree /proc/meminfo'));
                                                $MemoriaCache = preg_split('/ +/', @exec('grep ^Cached /proc/meminfo'));
                                                $MemoriaLibre = $MemoriaLibre[1] + $MemoriaCache[1];
                                                        $PorcentajeMemoriaUsada = round($MemoriaLibre*100 / $TotalMemoriaRAM*1.0, 2);
                                                        $ResumenMemoria .= "<br>".  ObtenerUnidadesMedida($MemoriaLibre*1024). '/'. ObtenerUnidadesMedida($TotalMemoriaRAM*1024-$MemoriaLibre);
                                                        $ResumenMemoria .= '
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated role="progressbar" style="width: '.$PorcentajeMemoriaUsada.'%;" aria-valuenow="'.$PorcentajeMemoriaUsada.'" aria-valuemin="0" aria-valuemax="100">'.$PorcentajeMemoriaUsada.'%</div>
                                                            </div>';
                                                echo "<b><i class='fa fa-fw fa-area-chart'></i> Memoria RAM:</b> " . $ResumenMemoria;
                                    echo "</div>";
                                
                                echo "</div></div><br>"; //Cierra Div de row y well
                            }
                        else
                            {
                                PCO_Mensaje($MULTILANG_Atencion.": Funci&oacute;n exec() de PHP deshabilitada","No se presentar&aacute; el estado del servidor web en tiempo real", '', 'fa fa-exclamation-triangle texto-rojo texto-blink', 'alert alert-warning');
                            }
                    }
                else
                    {
                        PCO_Mensaje($MULTILANG_Atencion.": Sistema operativo no soportado","El m&oacute;dulo es compatible con servidores BSD, Unix-like o Linux. No se presentar&aacute; el estado del servidor web en tiempo real", '', 'fa fa-exclamation-triangle texto-rojo texto-blink', 'alert alert-warning');
                    }
            }
        die();
	}


########################################################################
########################################################################
/*
	Function: PCO_ObtenerEstadoMotorBasedatos
	Retorna estado formateado con información básica del servidor de bases de datos que corre el Framework

	Salida:

		HTML formateado con: Procesos
*/
if (@$PCO_Accion=="PCO_ObtenerEstadoMotorBasedatos")
	{
	    //Si se solicita matar un proceso solamente ejecuta dicha accion
	    if ($PCO_SubAccion=="PCO_MatarProcesoBD")
	        {
	            PCO_EjecutarSQLUnaria("KILL {$IdProcesoBD}");
	            die();
	        }
	    
	    //Presenta estadisticas del servidor solo a usuarios administradores
    	if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
            {
                echo "<div class='well well-sm'><div align=center class='well well-sm'><b><i class='fa fa-fw fa-spinner fa-spin'></i> <font color=red> Estado del motor de base de datos </font></b> <i><font size=1>(2 seg)</font></i>
                    <a class='btn btn-xs btn-info' href='javascript:PausarActualizacionProcesosBD=1;'><i class='fa fa-pause fa-fw'></i></a>
                    <a class='btn btn-xs btn-success' href='javascript:PausarActualizacionProcesosBD=0;'><i class='fa fa-play fa-fw'></i></a>
                    
                </div>";
                echo "<div class='row'>";
                
                    //Variables de estado del motor
                    echo "<div class='col col-xs-12 col-sm-12 col-md-4 col-lg-4'>";
                                echo "<b><i class='fa fa-fw fa-wifi'></i> Comunicaciones:</b> ";
                                $ComandoSQL="
                                    SELECT VARIABLE_NAME as Transmitido, CONCAT( FORMAT(ROUND((((VARIABLE_VALUE/1024)/1024)),1),0) , ' MB (<b>',FORMAT(ROUND((((VARIABLE_VALUE/1024)/1024)/1024),1),1),' GB</b>)') as Total FROM performance_schema.global_status WHERE VARIABLE_NAME='Bytes_received' OR VARIABLE_NAME='Bytes_sent' ";
                                echo PCO_CargarInforme(0,0,"htm","Informes",1,0,1,1,"{$ComandoSQL}");

                                echo "<b><i class='fa fa-fw fa-cogs'></i> Variables:</b> ";
                                $ComandoSQL="
                                    SHOW STATUS WHERE Value<>0 AND 
                                        (Variable_name='Aborted_clients' OR 
                                        Variable_name='Aborted_connects' OR 
                                        Variable_name='Connections' OR 
                                        Variable_name='Key_read_requests' OR 
                                        Variable_name='Key_write_requests' OR 
                                        Variable_name='Last_query_cost' OR 
                                        Variable_name='Max_used_connections' OR 
                                        Variable_name='Max_used_connections_time' OR 
                                        Variable_name='Queries' OR 
                                        Variable_name='Threads_cached' OR 
                                        Variable_name='Threads_connected' OR 
                                        Variable_name='Threads_running') ";
                                echo PCO_CargarInforme(0,0,"htm","Informes",1,0,1,1,"{$ComandoSQL}");
                    echo "</div>";

                    //Consutas - Procesos
                    echo "<div class='col col-xs-12 col-sm-12 col-md-8 col-lg-8'>";
                                echo "<b><i class='fa fa-fw fa-database'></i> Procesos:</b> <div class='btn-xs'>";
                                $CondicionesProcesosSQL="
                                    SELECT COMMAND as Comando,TIME as Segundos,STATE as Estado,INFO as Detalles FROM information_schema.processlist WHERE
                                    INFO<>''
                                    AND INFO NOT LIKE '%information_schema.processlist%'
                                ";
                                PCO_CargarInforme(-66,0);

                    echo "</div></div>";
                    
                echo "</div></div><br>"; //Cierra Div de row y well
            }
        die();
	}