/*!
 * jQuery JavaScript Library v1.4.2
 * http://jquery.com/
 *
 * Copyright 2010, John Resig
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * Ready function adapted by Attila Oláh
 */
var ready=(function(){var b=false;var a=function(d){var f=function(){if(b){return}b=true;return d()};var h=function(){if(b){return}try{document.documentElement.doScroll("left")}catch(i){setTimeout(h,1);return}return f()};if(document.readyState==="complete"){return f()}if(document.addEventListener){document.addEventListener("DOMContentLoaded",f,false);window.addEventListener("load",f,false)}else{if(document.attachEvent){document.attachEvent("onreadystatechange",f);window.attachEvent("onload",f);var c=false;try{c=window.frameElement==null}catch(g){}if(document.documentElement.doScroll&&c){return h()}}}};return a})();