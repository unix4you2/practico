<?php
	/*
	   PCODER (Editor de Codigo en la Nube)
	   Sistema de Edicion de Codigo basado en PHP
	   Copyright (C) 2013  John F. Arroyave Gutiérrez
						   unix4you2@gmail.com
						   www.practico.org

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
	*/

	//Parametros para la configuracion de la base de datos
	$ServidorBD='localhost';	// Direccion IP o nombre de host
	$BaseDatos='pcoder.sdb';   // Path completo cuando se trata de sqlite2, ej: '/path/to/database.sdb'
	$UsuarioBD='root';
	$PasswordBD='mypass';
	$MotorBD='sqlite';		// Puede variar segun el driver PDO: mysql|pgsql|sqlite|sqlsrv|mssql|ibm|dblib|odbc|oracle|ifmx|fbd
	$PuertoBD='';	// Vacio para predeterminado
	$PCODER_TablaUsuariosDDL="
		CREATE TABLE core_usuario (
		  login text PRIMARY KEY,
		  clave text default 'd41d8cd98fd41d8cd98fd41d8cd98fd41d8cd98f',
		  correo text  default ''
		); ";
	$PCODER_TablaUsuarios="core_usuario";


    //Define los modos o lenguajes soportados por el editor
	$PCODER_Modos[]=array(Nombre => "ABAP",	Extensiones => "abap");
	$PCODER_Modos[]=array(Nombre => "ActionScript",	Extensiones => "as");
	$PCODER_Modos[]=array(Nombre => "ADA",	Extensiones => "ada|adb|ads");
	$PCODER_Modos[]=array(Nombre => "Apache_Conf",	Extensiones => "htaccess|htgroups|htpasswd|conf|htaccess|htgroups|htpasswd");
	$PCODER_Modos[]=array(Nombre => "AsciiDoc",	Extensiones => "asciidoc|adoc|ans|asc");
	$PCODER_Modos[]=array(Nombre => "Assembly_x86",	Extensiones => "asm");
	$PCODER_Modos[]=array(Nombre => "AutoHotKey",	Extensiones => "ahk");
	$PCODER_Modos[]=array(Nombre => "BatchFile",	Extensiones => "bat|cmd|pif|wsf");
	$PCODER_Modos[]=array(Nombre => "C9Search",	Extensiones => "c9search_results");
	$PCODER_Modos[]=array(Nombre => "C_Cpp",	Extensiones => "cpp|c|cc|cxx|h|hh|hpp|bcp|tcc");
	$PCODER_Modos[]=array(Nombre => "Cirru",	Extensiones => "cirru|cr");
	$PCODER_Modos[]=array(Nombre => "Clojure",	Extensiones => "clj|cljs");
	$PCODER_Modos[]=array(Nombre => "Cobol",	Extensiones => "CBL|COB");
	$PCODER_Modos[]=array(Nombre => "coffee",	Extensiones => "coffee|cf|cson|Cakefile");
	$PCODER_Modos[]=array(Nombre => "ColdFusion",	Extensiones => "cfm");
	$PCODER_Modos[]=array(Nombre => "CSharp",	Extensiones => "cs|csx");
	$PCODER_Modos[]=array(Nombre => "CSS",	Extensiones => "css");
	$PCODER_Modos[]=array(Nombre => "Curly",	Extensiones => "curly");
	$PCODER_Modos[]=array(Nombre => "D",	Extensiones => "d|di");
	$PCODER_Modos[]=array(Nombre => "Dart",	Extensiones => "dart");
	$PCODER_Modos[]=array(Nombre => "Diff",	Extensiones => "diff|patch");
	$PCODER_Modos[]=array(Nombre => "Dockerfile",	Extensiones => "Dockerfile");
	$PCODER_Modos[]=array(Nombre => "Dot",	Extensiones => "dot");
	$PCODER_Modos[]=array(Nombre => "Dummy",	Extensiones => "dummy");
	$PCODER_Modos[]=array(Nombre => "DummySyntax",	Extensiones => "dummy");
	$PCODER_Modos[]=array(Nombre => "Eiffel",	Extensiones => "e");
	$PCODER_Modos[]=array(Nombre => "EJS",	Extensiones => "ejs");
	$PCODER_Modos[]=array(Nombre => "Elixir",	Extensiones => "ex|exs");
	$PCODER_Modos[]=array(Nombre => "Elm",	Extensiones => "elm");
	$PCODER_Modos[]=array(Nombre => "Erlang",	Extensiones => "erl|hrl");
	$PCODER_Modos[]=array(Nombre => "Forth",	Extensiones => "frt|fs|ldr|4th|forth");
	$PCODER_Modos[]=array(Nombre => "FTL",	Extensiones => "ftl");
	$PCODER_Modos[]=array(Nombre => "Gcode",	Extensiones => "gcode");
	$PCODER_Modos[]=array(Nombre => "Gherkin",	Extensiones => "feature");
	$PCODER_Modos[]=array(Nombre => "Gitignore",	Extensiones => "gitignore|gcloudignore");
	$PCODER_Modos[]=array(Nombre => "Glsl",	Extensiones => "glsl|frag|vert");
	$PCODER_Modos[]=array(Nombre => "golang",	Extensiones => "go");
	$PCODER_Modos[]=array(Nombre => "Groovy",	Extensiones => "groovy");
	$PCODER_Modos[]=array(Nombre => "HAML",	Extensiones => "haml");
	$PCODER_Modos[]=array(Nombre => "Handlebars",	Extensiones => "hbs|handlebars|tpl|mustache");
	$PCODER_Modos[]=array(Nombre => "Haskell",	Extensiones => "hs|has|lhs|lit");
	$PCODER_Modos[]=array(Nombre => "haXe",	Extensiones => "hx");
	$PCODER_Modos[]=array(Nombre => "HTML",	Extensiones => "html|htm|xhtml|asp|aspx");
	$PCODER_Modos[]=array(Nombre => "HTML_Ruby",	Extensiones => "erb|rhtml");
	$PCODER_Modos[]=array(Nombre => "INI",	Extensiones => "ini|cfg|prefs");
	$PCODER_Modos[]=array(Nombre => "Io",	Extensiones => "io");
	$PCODER_Modos[]=array(Nombre => "Jack",	Extensiones => "jack");
	$PCODER_Modos[]=array(Nombre => "Jade",	Extensiones => "jade");
	$PCODER_Modos[]=array(Nombre => "Java",	Extensiones => "java");
	$PCODER_Modos[]=array(Nombre => "JavaScript",	Extensiones => "js|jsm");
	$PCODER_Modos[]=array(Nombre => "JSON",	Extensiones => "json");
	$PCODER_Modos[]=array(Nombre => "JSONiq",	Extensiones => "jq");
	$PCODER_Modos[]=array(Nombre => "JSP",	Extensiones => "jsp");
	$PCODER_Modos[]=array(Nombre => "JSX",	Extensiones => "jsx");
	$PCODER_Modos[]=array(Nombre => "Julia",	Extensiones => "jl");
	$PCODER_Modos[]=array(Nombre => "LaTeX",	Extensiones => "tex|latex|ltx|bib|sty");
	$PCODER_Modos[]=array(Nombre => "LESS",	Extensiones => "less");
	$PCODER_Modos[]=array(Nombre => "Liquid",	Extensiones => "liquid");
	$PCODER_Modos[]=array(Nombre => "Lisp",	Extensiones => "lisp|lsp");
	$PCODER_Modos[]=array(Nombre => "LiveScript",	Extensiones => "ls");
	$PCODER_Modos[]=array(Nombre => "LogiQL",	Extensiones => "logic|lql");
	$PCODER_Modos[]=array(Nombre => "LSL",	Extensiones => "lsl");
	$PCODER_Modos[]=array(Nombre => "Lua",	Extensiones => "lua");
	$PCODER_Modos[]=array(Nombre => "LuaPage",	Extensiones => "lp");
	$PCODER_Modos[]=array(Nombre => "Lucene",	Extensiones => "lucene");
	$PCODER_Modos[]=array(Nombre => "Makefile",	Extensiones => "Makefile|GNUmakefile|makefile|OCamlMakefile|make|am");
	$PCODER_Modos[]=array(Nombre => "Markdown",	Extensiones => "md|markdown|markdn");
	$PCODER_Modos[]=array(Nombre => "Mask",	Extensiones => "mask");
	$PCODER_Modos[]=array(Nombre => "MATLAB",	Extensiones => "matlab");
	$PCODER_Modos[]=array(Nombre => "MEL",	Extensiones => "mel");
	$PCODER_Modos[]=array(Nombre => "MUSHCode",	Extensiones => "mc|mush");
	$PCODER_Modos[]=array(Nombre => "MySQL",	Extensiones => "mysql");
	$PCODER_Modos[]=array(Nombre => "Nix",	Extensiones => "nix");
	$PCODER_Modos[]=array(Nombre => "ObjectiveC",	Extensiones => "m|mm");
	$PCODER_Modos[]=array(Nombre => "OCaml",	Extensiones => "ml|mli");
	$PCODER_Modos[]=array(Nombre => "Pascal",	Extensiones => "pas|p|dfm");
	$PCODER_Modos[]=array(Nombre => "Perl",	Extensiones => "pl|pm");
	$PCODER_Modos[]=array(Nombre => "pgSQL",	Extensiones => "pgsql");
	$PCODER_Modos[]=array(Nombre => "PHP",	Extensiones => "php|phtml|inc|ctp|snt");
	$PCODER_Modos[]=array(Nombre => "Powershell",	Extensiones => "ps1");
	$PCODER_Modos[]=array(Nombre => "Praat",	Extensiones => "praat|praatscript|psc|proc");
	$PCODER_Modos[]=array(Nombre => "Prolog",	Extensiones => "plg|prolog");
	$PCODER_Modos[]=array(Nombre => "Properties",	Extensiones => "properties");
	$PCODER_Modos[]=array(Nombre => "Protobuf",	Extensiones => "proto");
	$PCODER_Modos[]=array(Nombre => "Python",	Extensiones => "py");
	$PCODER_Modos[]=array(Nombre => "R",	Extensiones => "r");
	$PCODER_Modos[]=array(Nombre => "RDoc",	Extensiones => "Rd");
	$PCODER_Modos[]=array(Nombre => "RHTML",	Extensiones => "Rhtml");
	$PCODER_Modos[]=array(Nombre => "Ruby",	Extensiones => "rb|ru|gemspec|rake|Guardfile|Rakefile|Gemfile");
	$PCODER_Modos[]=array(Nombre => "Rust",	Extensiones => "rs");
	$PCODER_Modos[]=array(Nombre => "SASS",	Extensiones => "sass");
	$PCODER_Modos[]=array(Nombre => "SCAD",	Extensiones => "scad");
	$PCODER_Modos[]=array(Nombre => "Scala",	Extensiones => "scala");
	$PCODER_Modos[]=array(Nombre => "Scheme",	Extensiones => "scm|rkt");
	$PCODER_Modos[]=array(Nombre => "SCSS",	Extensiones => "scss");
	$PCODER_Modos[]=array(Nombre => "SH",	Extensiones => "sh|bash|bashrc|bsh");
	$PCODER_Modos[]=array(Nombre => "SJS",	Extensiones => "sjs");
	$PCODER_Modos[]=array(Nombre => "Smarty",	Extensiones => "smarty|tpl");
	$PCODER_Modos[]=array(Nombre => "snippets",	Extensiones => "snippets");
	$PCODER_Modos[]=array(Nombre => "Soy_Template",	Extensiones => "soy");
	$PCODER_Modos[]=array(Nombre => "Space",	Extensiones => "space");
	$PCODER_Modos[]=array(Nombre => "SQL",	Extensiones => "sql|dblib|dblib_mssql|fbd|ibm|ifmx|mssql|odbc|oracle|sqlite|sqlsrv");
	$PCODER_Modos[]=array(Nombre => "Stylus",	Extensiones => "styl|stylus");
	$PCODER_Modos[]=array(Nombre => "SVG",	Extensiones => "svg");
	$PCODER_Modos[]=array(Nombre => "Tcl",	Extensiones => "tcl");
	$PCODER_Modos[]=array(Nombre => "Tex",	Extensiones => "tex");
	$PCODER_Modos[]=array(Nombre => "Text",	Extensiones => "txt|nfo|dat|inf|log|csv|tab|url|1st|fountain|me|now|readme|rft|cst|pl1|pli|plc|src|swift|tk");
	$PCODER_Modos[]=array(Nombre => "Textile",	Extensiones => "textile");
	$PCODER_Modos[]=array(Nombre => "Toml",	Extensiones => "toml");
	$PCODER_Modos[]=array(Nombre => "Twig",	Extensiones => "twig");
	$PCODER_Modos[]=array(Nombre => "Typescript",	Extensiones => "ts|typescript|str");
	$PCODER_Modos[]=array(Nombre => "Vala",	Extensiones => "vala");
	$PCODER_Modos[]=array(Nombre => "VBScript",	Extensiones => "bas|vbs|vb|b|sb");
	$PCODER_Modos[]=array(Nombre => "Velocity",	Extensiones => "vm");
	$PCODER_Modos[]=array(Nombre => "Verilog",	Extensiones => "v|vh|sv|svh");
	$PCODER_Modos[]=array(Nombre => "VHDL",	Extensiones => "vhd|vhdl");
	$PCODER_Modos[]=array(Nombre => "XML",	Extensiones => "xml|rdf|rss|wsdl|xsl|xslt|atom|mathml|mml|xul|xbl");
	$PCODER_Modos[]=array(Nombre => "XQuery",	Extensiones => "xq");
	$PCODER_Modos[]=array(Nombre => "YAML",	Extensiones => "yaml|yml");


    //Define los temas de color claro disponibles para el editor
    $PCODER_TemasBrillantes[]=array(Nombre => "Chrome",	Valor => "chrome");
    $PCODER_TemasBrillantes[]=array(Nombre => "Clouds",	Valor => "clouds");
    $PCODER_TemasBrillantes[]=array(Nombre => "Crimson Editor",	Valor => "crimson_editor");
    $PCODER_TemasBrillantes[]=array(Nombre => "Dawn",	Valor => "dawn");
    $PCODER_TemasBrillantes[]=array(Nombre => "Dreamweaver",	Valor => "dreamweaver");
    $PCODER_TemasBrillantes[]=array(Nombre => "Eclipse",	Valor => "eclipse");
    $PCODER_TemasBrillantes[]=array(Nombre => "GitHub",	Valor => "github");
    $PCODER_TemasBrillantes[]=array(Nombre => "Solarized Light",	Valor => "solarized_light");
    $PCODER_TemasBrillantes[]=array(Nombre => "TextMate",	Valor => "textmate");
    $PCODER_TemasBrillantes[]=array(Nombre => "Tomorrow",	Valor => "tomorrow");
    $PCODER_TemasBrillantes[]=array(Nombre => "XCode",	Valor => "xcode");
    $PCODER_TemasBrillantes[]=array(Nombre => "Kuroir",	Valor => "kuroir");
    $PCODER_TemasBrillantes[]=array(Nombre => "KatzenMilch",	Valor => "katzenmilch");


    //Define los temas de color oscuro disponibles para el editor
    $PCODER_TemasOscuros[]=array(Nombre => "Ambiance",	Valor => "ambiance");
    $PCODER_TemasOscuros[]=array(Nombre => "Chaos",	Valor => "chaos");
    $PCODER_TemasOscuros[]=array(Nombre => "Clouds Midnight",	Valor => "clouds_midnight");
    $PCODER_TemasOscuros[]=array(Nombre => "Cobalt",	Valor => "cobalt");
    $PCODER_TemasOscuros[]=array(Nombre => "idle Fingers",	Valor => "idle_fingers");
    $PCODER_TemasOscuros[]=array(Nombre => "krTheme",	Valor => "kr_theme");
    $PCODER_TemasOscuros[]=array(Nombre => "Merbivore",	Valor => "merbivore");
    $PCODER_TemasOscuros[]=array(Nombre => "Merbivore Soft",	Valor => "merbivore_soft");
    $PCODER_TemasOscuros[]=array(Nombre => "Mono Industrial",	Valor => "mono_industrial");
    $PCODER_TemasOscuros[]=array(Nombre => "Monokai",	Valor => "monokai");
    $PCODER_TemasOscuros[]=array(Nombre => "Pastel on dark",	Valor => "pastel_on_dark");
    $PCODER_TemasOscuros[]=array(Nombre => "Solarized Dark",	Valor => "solarized_dark");
    $PCODER_TemasOscuros[]=array(Nombre => "Terminal",	Valor => "terminal");
    $PCODER_TemasOscuros[]=array(Nombre => "Tomorrow Night",	Valor => "tomorrow_night");
    $PCODER_TemasOscuros[]=array(Nombre => "Tomorrow Night Blue",	Valor => "tomorrow_night_blue");
    $PCODER_TemasOscuros[]=array(Nombre => "Tomorrow Night Bright",	Valor => "tomorrow_night_bright");
    $PCODER_TemasOscuros[]=array(Nombre => "Tomorrow Night 80s",	Valor => "tomorrow_night_eighties");
    $PCODER_TemasOscuros[]=array(Nombre => "Twilight",	Valor => "twilight");
    $PCODER_TemasOscuros[]=array(Nombre => "Vibrant Ink",	Valor => "vibrant_ink");