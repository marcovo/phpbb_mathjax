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
if (!defined('IN_PHPBB'))
{
	exit;
}

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
	'ACP_MATHJAX_SETTINGS'			=> 'Configuración General',
	'ACP_MATHJAX_BBCODES'			=> 'Configuración BBCode',
	'ACP_MATHJAX_EXTENSIONS'		=> 'Extensiones',
	'LOG_CONFIG_MATHJAX'			=> '<strong>Ajustes mathjax alterados</strong>',
	
// Errors
	'ERROR_BBCODE_EXISTS'		=> 'Tag %s ya existe.',
	'ERROR_BBCODE_INVALID'		=> 'Etiqueta no válida %s.',
	'TOO_MANY_BBCODES'			=> 'Usted no puede crear más BBCodes. Por favor, elimine uno o más BBCodes vuelva a intentarlo.',
	'NO_BBCODE_ID'				=> 'No BBCode id was sent in the request.',
	'BBCODE_DOESNT_EXIST'		=> 'El BBCode math solicitado no existe',
	'BBCODE_NOT_MATH_TPL'		=> 'La solicitud bbcode no parece ser un bbcode math aunque está marcado como tal.',
	'INVALID_MATHJAX_PATH'		=> 'La ruta introducida no contiene una instalación mathjax válida',
	'MUST_CONFIGURE_MATHJAX'	=> 'La ruta introducida no contiene una instalación mathjax válido y el <abbr title="Content Distribution Network">CDN</abbr> está desactivado. Por favor, introduzca una ruta válida a su instalación local mathjax o utilizar el <abbr title="Content Distribution Network">CDN</abbr>',
	
// Confirm boxes & notice msg
	'BBCODE_DELETE_CONFIRM'		=> '¿Seguro que quieres eliminar el bbcode %s?',
	'BBCODE_DELETED'			=> 'BBCode eliminado correctamente.',
	'BBCODE_CREATED'			=> 'BBCode creado correctamente.',
	'BBCODE_MODIFIED'			=> 'BBCode modificado correctamente.',
	
// Page titles and "legend" titles
	'MATHJAX_SETTINGS'				=> 'MathJax Configuración general',
	'MATHJAX_SETTINGS_EXPLAIN'		=> 'Aquí puede configurar Integración phpBB con mathjax.',
	'MATHJAX_BBCODE'				=> 'BBCode Math configuración',
	'MATHJAX_BBCODE_EXPLAIN'		=> 'Aquí puede ajustar los BBCodes para usar con phpBB2jax.',
	
	'GENERAL_SETTINGS'				=> 'Configuración General',
	'SERVER_SETTINGS'				=> 'Configuración del servidor',
	'BBCODE_EDITOR'					=> 'BBCode Editor',

// General Settings
	'MATHJAX_ENABLE'				=> 'Habilitar MathJax',
	'MATHJAX_USE_CDN'				=> 'Utilice el mathjax <abbr title="Content Distribution Network">CDN</abbr>',
	'MATHJAX_USE_CDN_EXPLAIN'		=> 'Al seleccionar esta opción, usted está de acuerdo con sus <a href="http://www.mathjax.org/download/mathjax-cdn-terms-of-service/"><abbr title="Terms of Service">TOS</abbr></a>.',
	'MATHJAX_CDN_FORCE_SSL'			=> 'Forzar una conexión segura a la <abbr title="Content Distribution Network">CDN</abbr>',
	'MATHJAX_CDN_FORCE_SSL_EXPLAIN'	=> 'Fuerza HTTPS, incluso si su foro no utiliza una conexión segura.',
	'MATHJAX_URI'					=> 'Ruta de instalación mathjax',
	'MATHJAX_URI_EXPLAIN'			=> 'Si usted no utiliza el <abbr title="Content Distribution Network">CDN</abbr>, que necesitará para entrar en la ruta de su instalación local, por ejemplo,. <samp>assets/javascript/MathJax</samp>. <br /> Si usted hace uso de la <abbr title="Content Distribution Network">CDN</abbr>, esto va a ser usada para fines de retorno.',
	'MATHJAX_DYNAMIC_LOAD'			=> 'Cargar Dinámicamente mathjax',
	'MATHJAX_DYNAMIC_LOAD_EXPLAIN'	=> 'Sólo carga mathjax si hay un bbcode math para ser procesados.',
	'MATHJAX_CONFIG'				=> 'Archivo de configuración',
	'MATHJAX_CONFIG_EXPLAIN'		=> 'Nombre del archivo de configuración mathjax o url ejemplo <samp>TeX-AMS-MML_HTMLorMML</samp>. Los valores válidos son explicados en la  <a href="http://docs.mathjax.org/en/latest/config-files.html">documentación</a>.',
	
// BBCode Settings
	'MATHJAX_BBCODE_TYPE'				=> 'Math type',
	'MATHJAX_BBCODE_TAG'				=> 'BBCode tag',
	'MATHJAX_BBCODE_DISPLAY'			=> 'Mostrar en mensajes',
	'MATHJAX_BBCODE_DISPLAY_EXPLAIN'	=> 'Si es así, esta BBCode se mostrará en el editor del usuario al publicar.',
	'MATHJAX_BBCODE_HELPLINE'			=> 'Texto de la línea de ayuda',
	'MATHJAX_BBCODE_HELPLINE_EXPLAIN'	=> 'Este campo contiene el puntero del ratón sobre el texto del BBCode en el editor.',
	'MATHJAX_PREVIEW'					=> 'Texto de vista previa',
	'MATHJAX_PREVIEW_EXPLAIN'			=> 'Por defecto se muestra el código de usuario, mientras que las math está prestando. Usted puede cambiar el texto de vista previa para por ejemplo. <samp>[Math Procesamiento ...]</samp>. Si usted no quiere un texto de vista previa ni el código de matemáticas que se muestra, utilice <samp>{NONE}</samp>.',
	'MATH_TYPE_TEX'						=> 'LaTeX',
	'MATH_TYPE_MML'						=> 'MathML',
	'BBCODE_TAG'						=> 'TAG',
	'ADD_BBCODE'						=> 'Añadir un nuevo BBCode',
));
