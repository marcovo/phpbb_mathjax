# MathJax phpBB Integration #

[![Powered by phpBB][1]][2]
[![Powered by MathJax][3]][4]

phpBB extension that enables users to post beautiful math in LaTeX and MathML, rendered in all major browsers using the MathJax JavaScript Library.

## Features: ##
* Uses the phpBB BBCode system.
* Multiple BBCodes can be used with static preview texts.
* Dynamic loading, saving users time and bandwidth.
* MathJax CDN can be used with a local installed copy for fallback purposes.
* Rendering is done in the client side, by the JavaScript library. No complicated setups!
* Works on all major browsers.
* Renders in native MathML, Web fonts and Image fonts depending on the browser capabilities.

### Requirements: ###
* phpBB3 v3.1.3 or superior. For v3.0.*, see the [MathJax Mod GitHub page][7]
* The [MathJax library][5] accessible from the forum web path or the ability to accept the [CDN TOS][6].

### Installation: ###
* Copy the extension code to the right subdirectory (/ext/marcovo/mathjax/)
* Enable the extension in the ACP under Customise -> Extensions
* In the ACP under Extensions -> Mathjax -> General Settings, do at least one of the following:
  * (Simple) Enable the use of the MathJax CDN, thereby accepting the [CDN TOS][6], or
  * (Requires FTP access) Download the [MathJax library][5] to your website, see also [the documentation][10] about this

*****************

![Screenshot][9]

 [1]: https://github.com/sergio91pt/MathJax-phpBB-Integration/raw/master/contrib/images/phpbb.png
 [2]: http://www.phpbb.com
 [3]: https://github.com/sergio91pt/MathJax-phpBB-Integration/raw/master/contrib/images/mathjax.gif
 [4]: http://www.mathjax.org/
 [5]: http://www.mathjax.org/download/
 [6]: http://www.mathjax.org/download/mathjax-cdn-terms-of-service/
 [7]: https://github.com/sergio91pt/MathJax-phpBB-Integration
 [9]: https://github.com/sergio91pt/MathJax-phpBB-Integration/raw/master/contrib/images/screenshot2.png
 [10]: http://docs.mathjax.org/en/latest/start.html#installing-your-own-copy-of-mathjax
