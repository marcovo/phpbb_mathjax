/*!
 * MathJax phpBB Integration
 * copyright (c) 2014 Sérgio Faria and Marco van Oort
 * license http://opensource.org/licenses/gpl-license.php GNU Public License v2
 */
function phpbb2jax(){var d=getElementsByClassName("MathJaxBB","span");for(i=0,n=d.length;i<n;++i){var c=d[i];for(j=0,m=c.childNodes.length;j<m;j++){var e=c.childNodes[j];var b=e.className;if(b=="math/tex"||b=="math/mml"){var a=document.createElement("script");a.type=b;MathJax.HTML.setScript(a,getText(e));c.replaceChild(a,e);MathJax.Hub.Queue(["Process",MathJax.Hub,c])}}}}function getElementsByClassName(c,b){if(document.getElementsByClassName){return document.getElementsByClassName(c)}else{var f=new Array();if(!b){b="*"}var e=document.getElementsByTagName(b);var a=e.length;var d=new RegExp("(^|\\s)"+c+"(\\s|$)");for(i=0,j=0;i<a;i++){if(e[i].className&&d.test(e[i].className)){f[j]=e[i];j++}}return f}}function getText(a){if(a.textContent!==undefined){return a.textContent}return a.innerText};
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
