#!/bin/bash
#	 _
#	|_) _ _  _ _|_. _ _					  	Copyright (C) 2012-2022
#	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
#	  www.practico.org					  	unix4you2@gmail.com
#                                            All rights reserved.
#    
#	 This program is free software: you can redistribute it and/or modify
#	 it under the terms of the GNU General Public License as published by
#	 the Free Software Foundation, either version 3 of the License, or
#	 (at your option) any later version.
#
#	 This program is distributed in the hope that it will be useful,
#	 but WITHOUT ANY WARRANTY; without even the implied warranty of
#	 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#	 GNU General Public License for more details.
#
#	 You should have received a copy of the GNU General Public License
#	 along with this program.  If not, see <http://www.gnu.org/licenses/>
#	 
#	            --- TRADUCCION NO OFICIAL DE LA LICENCIA ---
#
#     Esta es una traducción no oficial de la Licencia Pública General de
#     GNU al español. No ha sido publicada por la Free Software Foundation
#     y no establece los términos jurídicos de distribución del software 
#     publicado bajo la GPL 3 de GNU, solo la GPL de GNU original en inglés
#     lo hace. De todos modos, esperamos que esta traducción ayude a los
#     hispanohablantes a comprender mejor la GPL de GNU:
#	 
#     Este programa es software libre: puede redistribuirlo y/o modificarlo
#     bajo los términos de la Licencia General Pública de GNU publicada por
#     la Free Software Foundation, ya sea la versión 3 de la Licencia, o 
#     (a su elección) cualquier versión posterior.
#
#     Este programa se distribuye con la esperanza de que sea útil pero SIN
#     NINGUNA GARANTÍA; incluso sin la garantía implícita de MERCANTIBILIDAD
#     o CALIFICADA PARA UN PROPÓSITO EN PARTICULAR. Vea la Licencia General
#     Pública de GNU para más detalles.
#
#     Usted ha debido de recibir una copia de la Licencia General Pública de
#     GNU junto con este programa. Si no, vea <http://www.gnu.org/licenses/>


#bencoder [-f] [-q] [-t] -o FILE    file1.php
#bencoder [-f] [-q] [-t] -o OUTDIR  file1.php file2.php ...
#bencoder [-f] [-q] [-t] -o OUTDIR  -s SRCDIR  [-e SUFFIX] [-r] [-c] [-l]

#  -o FILE   : the file name to write the encoded script
#                (default to '-encoded.XXX' suffix)
#                  -o OUTDIR : the directory to write all encoded files
                  
#                    -s SRCDIR
#                      -a SRCDIR : encode all files from this source directory
                      
#                        -r        : encode directories recursively (no by default)
#                          -f        : force overwriting even if the target exists
#                            -t        : truncate/keep only the basename of the file into the bytecode
#                              -e SUFFIX : encode the files with the SUFFIX extension only (default: php)
#                                            (regular expression allowed, ex: "php|inc")
#                                              -c        : copy files those shouldn't be encoded (no by default)
#                                                -l        : follow symbolic link (no by default)
#                                                  -q        : do not print the file name while encoding or copying
#                                                    -b
#                                                      -bz2      : compress the encoded files with bz2 (needs bzip2-extension)


bencoder -e php -f -q -t -o /mnt/datos/bencoder/salida  -s /mnt/datos/webserver/practico/core -c -r