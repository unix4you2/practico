#!/bin/bash

#	Copyright (C) 2013  John F. Arroyave Gutiérrez
#						unix4you2@gmail.com
#						www.practico.org

#	This program is free software; you can redistribute it and/or
#	modify it under the terms of the GNU General Public License
#	as published by the Free Software Foundation; either version 2
#	of the License, or (at your option) any later version.

#	This program is distributed in the hope that it will be useful,
#	but WITHOUT ANY WARRANTY; without even the implied warranty of
#	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#	GNU General Public License for more details.

#	You should have received a copy of the GNU General Public License
#	along with this program; if not, write to the Free Software
#	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.


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