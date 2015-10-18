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
	'ACP_MATHJAX_SETTINGS'			=> 'Impostazioni',
	'ACP_MATHJAX_BBCODES'			=> 'Impostazioni BBCode',
	'ACP_MATHJAX_EXTENSIONS'		=> 'Estensioni',
	'LOG_CONFIG_MATHJAX'			=> '<strong>Impostazioni MathJax modificate</strong>',
	
// Errors
	'ERROR_BBCODE_EXISTS'		=> 'Il tag %s esiste già.',
	'ERROR_BBCODE_INVALID'		=> 'Nome tag %s non valido.',
	'TOO_MANY_BBCODES'			=> 'Non è possibile creare ulteriori BBCode. Rimuovere uno o più BBCode esistenti e riprovare.',
	'NO_BBCODE_ID'				=> 'Nessun id BBCode inviato nella richiesta.',
	'BBCODE_DOESNT_EXIST'		=> 'Il BBCode <samp>math</samp> richiesto non esiste',
	'BBCODE_NOT_MATH_TPL'		=> 'Il BBCode richiesto non è di tipo <samp>math</samp> anche se idenificato come tale.',
	'INVALID_MATHJAX_PATH'		=> 'Il percorso specificato non contiene un’installazione di MathJax valida',
	'MUST_CONFIGURE_MATHJAX'	=> 'Il percorso specificato non contiene un’installazione di MathJax valida e il <abbr title="Content Distribution Network">CDN</abbr> è disabilitato.<br />Specificare un percorso valido alla propria installazione locale di mathJax o usare il <abbr title="Content Distribution Network">CDN</abbr>.',
	
// Confirm boxes & notice msg
	'BBCODE_DELETE_CONFIRM'		=> 'Sei sicuro di voler rimuovere il BBCode %s?',
	'BBCODE_DELETED'			=> 'BBCode rimosso correttamente.',
	'BBCODE_CREATED'			=> 'BBCode creato correttamente.',
	'BBCODE_MODIFIED'			=> 'BBCode modificato correttamente.',
	
// Page titles and "legend" titles
	'MATHJAX_SETTINGS'				=> 'Impostazioni MathJax',
	'MATHJAX_SETTINGS_EXPLAIN'		=> 'Qui è possibile configurare l’integrazione di MathJax in phpBB.',
	'MATHJAX_BBCODE'				=> 'Impostazioni Math BBCode MathJax',
	'MATHJAX_BBCODE_EXPLAIN'		=> 'Qui è possibile impostare i BBCode da usare con phpBB2jax.',
	
	'GENERAL_SETTINGS'				=> 'Generali',
	'SERVER_SETTINGS'				=> 'Server',
	'BBCODE_EDITOR'					=> 'Editor BBCode',

// General Settings
	'MATHJAX_ENABLE'				=> 'Abilita MathJax',
	'MATHJAX_USE_CDN'				=> 'Usa il <abbr title="Content Distribution Network">CDN</abbr> MathJax',
	'MATHJAX_USE_CDN_EXPLAIN'		=> 'Selezionando quest’opzione, si accettano i <a href="http://www.mathjax.org/download/mathjax-cdn-terms-of-service/">Termini di Servizio</a>.',
	'MATHJAX_CDN_FORCE_SSL'			=> 'Forza connessione sicura al <abbr title="Content Distribution Network">CDN</abbr>',
	'MATHJAX_CDN_FORCE_SSL_EXPLAIN'	=> 'forza HTTPS anche se la propria board non usa una connessione sicura.',
	'MATHJAX_URI'					=> 'Percorso d’installazione MathJax',
	'MATHJAX_URI_EXPLAIN'			=> 'Se non si usa il <abbr title="Content Distribution Network">CDN</abbr>, sarà necessario specificare il percorso dell’installazione locale, per esempio <samp>assets/javascript/MathJax</samp>.<br />Usando il <abbr title="Content Distribution Network">CDN</abbr>, quest’impostazione sarà utile qualora il <abbr title="Content Distribution Network">CDN</abbr> sia irraggiungibile.',
	'MATHJAX_DYNAMIC_LOAD'			=> 'Carica MathJax dinamicamente',
	'MATHJAX_DYNAMIC_LOAD_EXPLAIN'	=> 'Carica MathJax solo se c’è del BBCode <samp>math</samp> da interpretare.',
	'MATHJAX_CONFIG'				=> 'File di configurazione',
	'MATHJAX_CONFIG_EXPLAIN'		=> 'Il nome o l’indirizzo del file di configurazione di MathJax, per esempio <samp>TeX-AMS-MML_HTMLorMML</samp>.<br />Valori validi sono elencati nella <a href="http://docs.mathjax.org/en/latest/config-files.html">documentazione</a>.',
	
// BBCode Settings
	'MATHJAX_BBCODE_TYPE'				=> 'Tipo',
	'MATHJAX_BBCODE_TAG'				=> 'Tag BBCode',
	'MATHJAX_BBCODE_DISPLAY'			=> 'Mostra nell’editor',
	'MATHJAX_BBCODE_DISPLAY_EXPLAIN'	=> 'Se impostata su Sì, il BBCode comparirà nell’editor utente quando scrive un messaggio.',
	'MATHJAX_BBCODE_HELPLINE'			=> 'Guida BBCode', 
	'MATHJAX_BBCODE_HELPLINE_EXPLAIN'	=> 'Questo campo contiene una breve guida mostrata passando il mouse sul pulsante del BBCode nell’editor.',
	'MATHJAX_PREVIEW'					=> 'Testo anteprima',
	'MATHJAX_PREVIEW_EXPLAIN'			=> 'Per impostazione predefinita, viene mostrato il codice utente durante l’interpretazione. È possibile modificare questo comportamento mostrando un testo come <samp>[Interpretazione espressione in corso...]</samp>.<br />Per non mostrare né testo né codice, usare <samp>{NONE}</samp>.',
	'MATH_TYPE_TEX'						=> 'LaTeX',
	'MATH_TYPE_MML'						=> 'MathML',
	'BBCODE_TAG'						=> 'TAG',
	'ADD_BBCODE'						=> 'Aggiungi BBCode', 
));
