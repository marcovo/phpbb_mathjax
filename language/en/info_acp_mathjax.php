<?php
/** 
*
* @package MathJax
* @copyright (c) 2014 Sérgio Faria and Marco van Oort
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2 
*
*/

/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
// ACP Vars
	'ACP_MATHJAX'					=> 'MathJax',
	'ACP_MATHJAX_CAT'				=> 'MATHJAX',
	'ACP_MATHJAX_SETTINGS'			=> 'General Settings',
	'ACP_MATHJAX_BBCODES'			=> 'BBCode Settings',
	'ACP_MATHJAX_EXTENSIONS'		=> 'Extensions',
	'LOG_CONFIG_MATHJAX'			=> '<strong>Altered MathJax settings</strong>',
	
// Errors
	'ERROR_BBCODE_EXISTS'		=> 'Tag %s already exists.',
	'ERROR_BBCODE_INVALID'		=> 'Invalid tag name %s.',
	'TOO_MANY_BBCODES'			=> 'You cannot create any more BBCodes. Please remove one or more BBCodes then try again.',
	'NO_BBCODE_ID'				=> 'No BBCode id was sent in the request.',
	'BBCODE_DOESNT_EXIST'		=> 'The requested math BBCode doesn\'t exist',
	'BBCODE_NOT_MATH_TPL'		=> 'The request bbcode doesn\'t seem to be a math bbcode although is marked as such.',
	'INVALID_MATHJAX_PATH'		=> 'The entered path doesn\'t contain a valid MathJax installation',
	'MUST_CONFIGURE_MATHJAX'	=> 'The entered path doesn\'t contain a valid MathJax installation and the <abbr title="Content Distribution Network">CDN</abbr> is disabled. <br /> Please enter a valid path to your MathJax local installation or use the <abbr title="Content Distribution Network">CDN</abbr>.',
	
// Confirm boxes & notice msg
	'BBCODE_DELETE_CONFIRM'		=> 'Are you sure you want to delete the %s bbcode?',
	'BBCODE_DELETED'			=> 'BBCode deleted successfully.',
	'BBCODE_CREATED'			=> 'BBCode created successfully.',
	'BBCODE_MODIFIED'			=> 'BBCode modified successfully.',
	
// Page titles and "legend" titles
	'MATHJAX_SETTINGS'				=> 'MathJax General Settings',
	'MATHJAX_SETTINGS_EXPLAIN'		=> 'Here you can configure phpBB Integration with MathJax.',
	'MATHJAX_BBCODE'				=> 'Math BBCode Settings',
	'MATHJAX_BBCODE_EXPLAIN'		=> 'Here you can set the BBCodes to use with phpBB2jax.',
	
	'GENERAL_SETTINGS'				=> 'General Settings',
	'SERVER_SETTINGS'				=> 'Server Settings',
	'BBCODE_EDITOR'					=> 'BBCode Editor',

// General Settings
	'MATHJAX_ENABLE'				=> 'Enable MathJax',
	'MATHJAX_USE_CDN'				=> 'Use the Mathjax <abbr title="Content Distribution Network">CDN</abbr>',
	'MATHJAX_USE_CDN_EXPLAIN'		=> 'By selecting this option, you hereby agree to its <a href="http://www.mathjax.org/download/mathjax-cdn-terms-of-service/"><abbr title="Terms of Service">TOS</abbr></a>.',
	'MATHJAX_CDN_FORCE_SSL'			=> 'Force a secure connection to the <abbr title="Content Distribution Network">CDN</abbr>',
	'MATHJAX_CDN_FORCE_SSL_EXPLAIN'	=> 'Force HTTPS even if your board doesn\'t use a secure connection.',
	'MATHJAX_URI'					=> 'MathJax Installation Path',
	'MATHJAX_URI_EXPLAIN'			=> 'If you don\'t use the <abbr title="Content Distribution Network">CDN</abbr>, you\'ll need to enter the path to your local installation, e.g. <samp>assets/javascript/MathJax</samp>. <br /> If you do use the <abbr title="Content Distribution Network">CDN</abbr>, this will be used for fallback purposes.',
	'MATHJAX_DYNAMIC_LOAD'			=> 'Dynamically load MathJax',
	'MATHJAX_DYNAMIC_LOAD_EXPLAIN'	=> 'Only loads MathJax if theres a math bbcode to be processed.',
	'MATHJAX_CONFIG'				=> 'Configuration File',
	'MATHJAX_CONFIG_EXPLAIN'		=> 'MathJax configuration filename or url e.g. <samp>TeX-AMS-MML_HTMLorMML</samp>. Valid values are explained in the <a href="http://www.mathjax.org/docs/1.1/configuration.html#using-a-configuration-file">documentation</a>.',
	
// BBCode Settings
	'MATHJAX_BBCODE_TYPE'				=> 'Math type',
	'MATHJAX_BBCODE_TAG'				=> 'BBCode tag',
	'MATHJAX_BBCODE_DISPLAY'			=> 'Display on the editor',
	'MATHJAX_BBCODE_DISPLAY_EXPLAIN'	=> 'If yes, this BBCode will be displayed on the user\'s editor when posting.',
	'MATHJAX_BBCODE_HELPLINE'			=> 'BBCode Helpline', 
	'MATHJAX_BBCODE_HELPLINE_EXPLAIN'	=> 'This field contains the mouse over text of the BBCode in the editor.',
	'MATHJAX_PREVIEW'					=> 'Preview text',
	'MATHJAX_PREVIEW_EXPLAIN'			=> 'By default the user code is shown while the math is rendering. You can change the preview text to eg. <samp>[Processing math...]</samp>. If you don\'t want a preview text nor the math code being shown, use <samp>{NONE}</samp>.',
	'MATH_TYPE_TEX'						=> 'LaTeX',
	'MATH_TYPE_MML'						=> 'MathML',
	'BBCODE_TAG'						=> 'TAG',
	'ADD_BBCODE'						=> 'Add a new BBCode', 
));
