<?php
/** 
*
* @package MathJax
* @copyright (c) 2014 Sérgio Faria and Marco van Oort
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2 
*
*/

namespace marcovo\mathjax\acp;
/**
* @package module_install
*/
class acp_mathjax_info
{
    function module()
    {
    return array(
        'filename'    => '\marcovo\mathjax\acp\acp_mathjax_module',
        'title'        => 'ACP_MATHJAX',
        'modes'        => array(
            'settings'		=> array('title' => 'ACP_MATHJAX_SETTINGS', 'auth' => 'acl_a_server', 'cat' => array('ACP_MATHJAX_CAT')),
            'bbcode'		=> array('title' => 'ACP_MATHJAX_BBCODES', 'auth' => 'acl_a_bbcode', 'cat' => array('ACP_MATHJAX_CAT')),
            ),
        );
        
    }

    function install()
    {
    }

    function uninstall()
    {
    }

}
