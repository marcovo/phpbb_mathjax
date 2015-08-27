<?php
/** 
*
* @package MathJax
* @copyright (c) 2015 Marco van Oort
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
	'ACP_MATHJAX_SETTINGS'			=> 'Algemene Instellingen',
	'ACP_MATHJAX_BBCODES'			=> 'BBCode Instellingen',
	'ACP_MATHJAX_EXTENSIONS'		=> 'Extensies',
	'LOG_CONFIG_MATHJAX'			=> '<strong>MathJax instellingen aangepast</strong>',
	
// Errors
	'ERROR_BBCODE_EXISTS'		=> 'Tag %s bestaat al.',
	'ERROR_BBCODE_INVALID'		=> 'Ongeldige tagnaam %s.',
	'TOO_MANY_BBCODES'			=> 'Je kunt niet meer BBCodes maken. Verwijder minstens één BBCode en probeer het opnieuw.',
	'NO_BBCODE_ID'				=> 'Er was geen BBCode id meegegeven in het paginaverzoek.',
	'BBCODE_DOESNT_EXIST'		=> 'De gevraagde wiskunde BBCode bestaat niet.',
	'BBCODE_NOT_MATH_TPL'		=> 'De gevraagde bbcode lijkt geen wiskunde bbocde te zijn, ook al is het wel als zodanig gemarkeerd.',
	'INVALID_MATHJAX_PATH'		=> 'Het ingevulde pad bevat geen geldige MathJax installatie.',
	'MUST_CONFIGURE_MATHJAX'	=> 'Het ingevulde pad bevat geen geldige MathJax installatie en de <abbr title="Content Distribution Network">CDN</abbr> is uitgeschakeld. <br /> Vul a.u.b. een geldig pad in voor de lokale MathJax installatie, of gebruik de <abbr title="Content Distribution Network">CDN</abbr>.',
	
// Confirm boxes & notice msg
	'BBCODE_DELETE_CONFIRM'		=> 'Weet je zeker dat je de %s bbcode wilt verwijderen?',
	'BBCODE_DELETED'			=> 'BBCode succesvol verwijderd.',
	'BBCODE_CREATED'			=> 'BBCode succesvol aangemaakt.',
	'BBCODE_MODIFIED'			=> 'BBCode succesvol aangepast.',
	
// Page titles and "legend" titles
	'MATHJAX_SETTINGS'				=> 'MathJax Algemene Instellingen',
	'MATHJAX_SETTINGS_EXPLAIN'		=> 'Hier kun je de phpBB Integratie van MathJax configureren.',
	'MATHJAX_BBCODE'				=> 'Wiskunde BBCode Instellingen',
	'MATHJAX_BBCODE_EXPLAIN'		=> 'Hier kun je de BBCodes instellen die gebruikt moeten worden voor MathJax.',
	
	'GENERAL_SETTINGS'				=> 'Algemene Instellingen',
	'SERVER_SETTINGS'				=> 'Server Instellingen',
	'BBCODE_EDITOR'					=> 'BBCode Bewerker',

// General Settings
	'MATHJAX_ENABLE'				=> 'MathJax Aanzetten',
	'MATHJAX_USE_CDN'				=> 'Gebruik de MathJax <abbr title="Content Distribution Network">CDN</abbr>',
	'MATHJAX_USE_CDN_EXPLAIN'		=> 'Door deze optie te selecteren, stem je toe akkoord te gaan met de <a href="http://www.mathjax.org/download/mathjax-cdn-terms-of-service/"><abbr title="Terms of Service">TOS</abbr></a>.',
	'MATHJAX_CDN_FORCE_SSL'			=> 'Dwing een beveiligde verbinding af voor de <abbr title="Content Distribution Network">CDN</abbr>',
	'MATHJAX_CDN_FORCE_SSL_EXPLAIN'	=> 'Dwing HTTPS af, ook als het forum zelf geen beveiligde verbinding gebruikt.',
	'MATHJAX_URI'					=> 'MathJax Installatie Pad',
	'MATHJAX_URI_EXPLAIN'			=> 'Als je de <abbr title="Content Distribution Network">CDN</abbr> niet gebruikt, moet je het pad invullen naar je lokale installatie van MathJax, bijv.. <samp>assets/javascript/MathJax</samp>. <br /> Als je de <abbr title="Content Distribution Network">CDN</abbr> wel gebruikt, zal dit pad gebruikt worden om op terugval optie.',
	'MATHJAX_DYNAMIC_LOAD'			=> 'MathJax dynamisch laden',
	'MATHJAX_DYNAMIC_LOAD_EXPLAIN'	=> 'Laadt MathJax alleen als er een wiskunde bbcode op de pagina aanwezig is.',
	'MATHJAX_CONFIG'				=> 'Configuratie Bestand',
	'MATHJAX_CONFIG_EXPLAIN'		=> 'MathJax configuratie bestand of url, bijv. <samp>TeX-AMS-MML_HTMLorMML</samp>. Geldige waarden worden uitgelegd in de <a href="http://docs.mathjax.org/en/latest/config-files.html">documentatie</a>.',
	
// BBCode Settings
	'MATHJAX_BBCODE_TYPE'				=> 'Wiskunde opmaak type',
	'MATHJAX_BBCODE_TAG'				=> 'BBCode tag',
	'MATHJAX_BBCODE_DISPLAY'			=> 'Weergeven op de berichtpagina',
	'MATHJAX_BBCODE_DISPLAY_EXPLAIN'	=> 'Als op ja ingesteld, zal deze BBcode bij de rest van de BBcodes op de bewerkpagina worden weergegeven.',
	'MATHJAX_BBCODE_HELPLINE'			=> 'BBCode Hulplijn', 
	'MATHJAX_BBCODE_HELPLINE_EXPLAIN'	=> 'Dit veld bevat de tekst die men te zien krijg als je met de muis over de BBcode knop in de bewerker gaat.',
	'MATHJAX_PREVIEW'					=> 'Voorbeeldtekst',
	'MATHJAX_PREVIEW_EXPLAIN'			=> 'Standaard zal deze tekst worden weergegeven gedurende dat de wiskunde wordt opgemaakt. Je kunt dit veranderen in bijv. <samp>[Formule verwerken...]</samp>. Als je geen voorbeeldtekst noch wiskunde-opmaak-code wilt laten zien, vul dan <samp>{NONE}</samp> in.',
	'MATH_TYPE_TEX'						=> 'LaTeX',
	'MATH_TYPE_MML'						=> 'MathML',
	'BBCODE_TAG'						=> 'TAG',
	'ADD_BBCODE'						=> 'Voeg een nieuwe BBCode toe', 
));
