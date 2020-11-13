#!/bin/bash

#    _
#   |_) _ _  _ _|_. _ _					  	Copyright (C) 2020
#   |  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
#     www.practico.org					  	unix4you2@gmail.com
#                                           All rights reserved.
#   
#   Redistribution and use in source and binary forms, with or without
#   modification, are permitted provided that the following conditions are met:
#   
#   1. Redistributions of source code must retain the above copyright notice, this
#      list of conditions and the following disclaimer.
#   
#   2. Redistributions in binary form must reproduce the above copyright notice,
#      this list of conditions and the following disclaimer in the documentation
#      and/or other materials provided with the distribution.
#   
#   THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
#   AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
#   IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
#   DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
#   FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
#   DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
#   SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
#   CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
#   OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
#   OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.


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