<?php
	/*
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
	*/

	/*
		Title: Libreria base 
		Ubicacion *[/core/comunes_bd.php]*.  Archivo que contiene las funciones de uso global.
	*/
	/*
		Section: Funciones asociadas a las operaciones con bases de datos - Ejecucion de consultas
	*/


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCODER_ListadoExploracionArchivos
	Construye una lista de los archivos contenidos en una carpeta y que coinciden con un flitro determinado

	Variables de entrada:

		RutaExploracion - El Path donde se desean buscar los archivos, preferible terminando en /
		Filtro_contenido - Un texto que debe ser contenido en el nombre de archivo para poder ser presentado.  Vacio indica cualquier archivo

	Salida:
		Arreglo de elementos asociados a cada archivo encontrado
*/
function PCODER_ListadoExploracionArchivos($RutaExploracion="",$Filtro_contenido="")
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


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCODER_ListadoVisualExploracionArchivos
	Presenta una lista de los archivos contenidos en una carpeta con modificadores para las opciones
*/
function PCODER_ListadoVisualExploracionArchivos($RutaExploracion="",$Filtro_contenido="",$TituloExploracion="",$PermitirDescarga=1)
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
                $ListadoArchivos=PCODER_ListadoExploracionArchivos($RutaExploracion,$Filtro_contenido);
                
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