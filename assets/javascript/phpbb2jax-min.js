/*!
 * MathJax phpBB Integration
 * copyright (c) 2014 Sérgio Faria and Marco van Oort
 * license http://opensource.org/licenses/gpl-license.php GNU Public License v2
 */
function phpbb2jax(){var d=getElementsByClassName("MathJaxBB","span");for(i=0,n=d.length;i<n;++i){var c=d[i];for(j=0,m=c.childNodes.length;j<m;j++){var e=c.childNodes[j];var b=e.className;if(b=="math/tex"||b=="math/mml"){var a=document.createElement("script");a.type=b;MathJax.HTML.setScript(a,getText(e));c.replaceChild(a,e);MathJax.Hub.Queue(["Process",MathJax.Hub,c])}}}}function getElementsByClassName(c,b){if(document.getElementsByClassName){return document.getElementsByClassName(c)}else{var f=new Array();if(!b){b="*"}var e=document.getElementsByTagName(b);var a=e.length;var d=new RegExp("(^|\\s)"+c+"(\\s|$)");for(i=0,j=0;i<a;i++){if(e[i].className&&d.test(e[i].className)){f[j]=e[i];j++}}return f}}function getText(a){if(a.textContent!==undefined){return a.textContent}return a.innerText};