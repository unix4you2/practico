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

addEvent(window, "load", makeNiceTitles);

var XHTMLNS = "http://www.w3.org/1999/xhtml";
var CURRENT_NICE_TITLE;
var browser = new Browser();

function makeNiceTitles() {
    if (!document.createElement || !document.getElementsByTagName) return;
    // add namespace methods to HTML DOM; this makes the script work in both
    // HTML and XML contexts.
    if(!document.createElementNS)
    {
        document.createElementNS = function(ns,elt) {
            return document.createElement(elt);
        }
    }

    if( !document.links )
    {
        document.links = document.getElementsByTagName("a");
    }
    for (var ti=0;ti<document.links.length;ti++) {
        var lnk = document.links[ti];
        if (lnk.title) {
            lnk.setAttribute("nicetitle",lnk.title);
            lnk.removeAttribute("title");
            addEvent(lnk,"mouseover",showNiceTitle);
            addEvent(lnk,"mouseout",hideNiceTitle);
            addEvent(lnk,"focus",showNiceTitle);
            addEvent(lnk,"blur",hideNiceTitle);
        }
    }
    var instags = document.getElementsByTagName("ins");
    if (instags) {
    for (var ti=0;ti<instags.length;ti++) {
        var instag = instags[ti];
        if (instag.dateTime) {
            var strDate = instag.dateTime;
            var dtIns = new Date(strDate.substring(0,4),parseInt(strDate.substring(4,6)-1),strDate.substring(6,8),strDate.substring(9,11),strDate.substring(11,13),strDate.substring(13,15));
            instag.setAttribute("nicetitle","Added on "+dtIns.toString());
            addEvent(instag,"mouseover",showNiceTitle);
            addEvent(instag,"mouseout",hideNiceTitle);
            addEvent(instag,"focus",showNiceTitle);
            addEvent(instag,"blur",hideNiceTitle);
        }
    }
    }
}

function findPosition( oLink ) {
  if( oLink.offsetParent ) {
    for( var posX = 0, posY = 0; oLink.offsetParent; oLink = oLink.offsetParent ) {
      posX += oLink.offsetLeft;
      posY += oLink.offsetTop;
    }
    return [ posX, posY ];
  } else {
    return [ oLink.x, oLink.y ];
  }
}

function showNiceTitle(e) {
    if (CURRENT_NICE_TITLE) hideNiceTitle(CURRENT_NICE_TITLE);
    if (!document.getElementsByTagName) return;
    if (window.event && window.event.srcElement) {
        lnk = window.event.srcElement
    } else if (e && e.target) {
        lnk = e.target
    }
    if (!lnk) return;
    if (lnk.nodeName.toUpperCase() != 'A') {
        // lnk is not actually the link -- ascend parents until we hit a link
        lnk = getParent(lnk,"A");
    }
    if (!lnk) return;
    nicetitle = lnk.getAttribute("nicetitle");
    
    var d = document.createElementNS(XHTMLNS,"div");
    d.className = "nicetitle";
    tnt = document.createTextNode(nicetitle);
    pat = document.createElementNS(XHTMLNS,"p");
    pat.className = "titletext";
    pat.appendChild(tnt);
    d.appendChild(pat);
    if (lnk.href) {
        tnd = document.createTextNode(lnk.name);
        pad = document.createElementNS(XHTMLNS,"p");
        pad.className = "destination";
        pad.appendChild(tnd);
        d.appendChild(pad);
    }
    
    STD_WIDTH = 300;
    if (lnk.href) {
        h = lnk.href.length;
    } else { h = nicetitle.length; }
    if (nicetitle.length) {
      t = nicetitle.length;
    }
    h_pixels = h*6; t_pixels = t*10;
    
    if (h_pixels > STD_WIDTH) {
        w = h_pixels;
    } else if ((STD_WIDTH>t_pixels) && (t_pixels>h_pixels)) {
        w = t_pixels;
    } else if ((STD_WIDTH>t_pixels) && (h_pixels>t_pixels)) {
        w = h_pixels;
    } else {
        w = STD_WIDTH;
    }
        
    d.style.width = w + 'px';    

    /*
    mx = lnk.offsetLeft;
    my = lnk.offsetTop;
    */
    mpos = findPosition(lnk);
    mx = mpos[0];
    my = mpos[1];
    //xy = getMousePosition(e);
    //mx = xy[0]; my = xy[1];
    
    d.style.left = (mx+15) + 'px';
    d.style.top = (my+35) + 'px';
    if (window.innerWidth && ((mx+w) > window.innerWidth)) {
        d.style.left = (window.innerWidth - w - 25) + "px";
    }
    if (document.body.scrollWidth && ((mx+w) > document.body.scrollWidth)) {
        d.style.left = (document.body.scrollWidth - w - 25) + "px";
    }
    
    document.getElementsByTagName("body")[0].appendChild(d);
    
    CURRENT_NICE_TITLE = d;
}

function hideNiceTitle(e) {
    if (!document.getElementsByTagName) return;
    if (CURRENT_NICE_TITLE) {
        document.getElementsByTagName("body")[0].removeChild(CURRENT_NICE_TITLE);
        CURRENT_NICE_TITLE = null;
    }
}

// Add an eventListener to browsers that can do it somehow.
// Originally by the amazing Scott Andrew.
function addEvent(obj, evType, fn){
  if (obj.addEventListener){
    obj.addEventListener(evType, fn, false);
    return true;
  } else if (obj.attachEvent){
	var r = obj.attachEvent("on"+evType, fn);
    return r;
  } else {
	return false;
  }
}

function getParent(el, pTagName) {
	if (el == null) return null;
	else if (el.nodeType == 1 && el.tagName.toLowerCase() == pTagName.toLowerCase())	// Gecko bug, supposed to be uppercase
		return el;
	else
		return getParent(el.parentNode, pTagName);
}

function getMousePosition(event) {
  if (browser.isIE) {
    x = window.event.clientX + document.documentElement.scrollLeft
      + document.body.scrollLeft;
    y = window.event.clientY + document.documentElement.scrollTop
      + document.body.scrollTop;
  }
  if (browser.isNS) {
    x = event.clientX + window.scrollX;
    y = event.clientY + window.scrollY;
  }
  return [x,y];
}

// Determine browser and version.

function Browser() {
// blah, browser detect, but mouse-position stuff doesn't work any other way
  var ua, s, i;

  this.isIE    = false;
  this.isNS    = false;
  this.version = null;

  ua = navigator.userAgent;

  s = "MSIE";
  if ((i = ua.indexOf(s)) >= 0) {
    this.isIE = true;
    this.version = parseFloat(ua.substr(i + s.length));
    return;
  }

  s = "Netscape6/";
  if ((i = ua.indexOf(s)) >= 0) {
    this.isNS = true;
    this.version = parseFloat(ua.substr(i + s.length));
    return;
  }

  // Treat any other "Gecko" browser as NS 6.1.

  s = "Gecko";
  if ((i = ua.indexOf(s)) >= 0) {
    this.isNS = true;
    this.version = 6.1;
    return;
  }
}