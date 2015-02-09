<?php
/** 
*
* @package MathJax
* @copyright (c) 2011 Sérgio Faria
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
	'ACP_MATHJAX_SETTINGS'			=> 'Configuração',
	'ACP_MATHJAX_BBCODES'			=> 'BBCodes',
	'ACP_MATHJAX_EXTENSIONS'		=> 'Extensões do MathJax',
	'LOG_CONFIG_MATHJAX'			=> '<strong>Configurações da integração do MathJax alteradas.</strong>',
	
// Errors
	'ERROR_BBCODE_EXISTS'		=> 'A tag %s já existe.',
	'ERROR_BBCODE_INVALID'		=> '%s é um nome inválido para uma tag.',
	'TOO_MANY_BBCODES'			=> 'Não pode criar mais BBCodes, pois atingiu o limite. Por favor remova alguns BBCodes e tente de novo.',
	'NO_BBCODE_ID'				=> 'O pedido não continha nenhum BBCode id.',
	'BBCODE_DOESNT_EXIST'		=> 'Não existe tal BBCode de matemática.',
	'BBCODE_NOT_MATH_TPL'		=> 'O BBCode pedido não aparenta ser de matemática embora esteja marcado como tal.',
	'INVALID_MATHJAX_PATH'		=> 'O caminho introduzido não contém uma instalação válida do MathJax.',
	'MUST_CONFIGURE_MATHJAX'	=> 'O caminho introduzido não contém uma instalação válida do MathJax e o uso da <abbr title="Rede de Distribuição de Conteúdo">CDN</abbr> está desabilitado. <br /> Por favor introduza um caminho válido ou use a <abbr title="Rede de Distribuição de Conteúdo">CDN</abbr>.',
	
// Confirm boxes & notice msg
	'BBCODE_DELETE_CONFIRM'		=> 'Têm a certeza que quer eliminar a bbcode %s?',
	'BBCODE_DELETED'			=> 'BBCode eliminada com sucesso',
	'BBCODE_CREATED'			=> 'BBCode criada com sucesso.',
	'BBCODE_MODIFIED'			=> 'BBCode modificada com sucesso.',
	
// Page titles and "legend" titles
	'MATHJAX_SETTINGS'				=> 'Configuração Geral do MathJax',
	'MATHJAX_SETTINGS_EXPLAIN'		=> 'Aqui pode configurar a integração do MathJax com fórum.',
	'MATHJAX_BBCODE'				=> 'Configuração de BBCodes Matemáticas',
	'MATHJAX_BBCODE_EXPLAIN'		=> 'Aqui pode criar BBCodes para usar com o phpBB2jax.',
	
	'GENERAL_SETTINGS'				=> 'Configuração Geral',
	'SERVER_SETTINGS'				=> 'Configuração do Servidor',
	'BBCODE_EDITOR'					=> 'Editor de BBCodes',

// General Settings
	'MATHJAX_ENABLE'				=> 'Habilitar o MathJax',
	'MATHJAX_USE_CDN'				=> 'Use a <abbr title="Rede de Distribuição de Conteúdo">CDN</abbr> do MathJax',
	'MATHJAX_USE_CDN_EXPLAIN'		=> 'Selecione esta opção se pretender usar a <abbr title="Rede de Distribuição de Conteúdo">CDN</abbr> do MathJax, aceitando o <a href="http://www.mathjax.org/download/mathjax-cdn-terms-of-service/"><abbr title="Termos de Serviço">TOS</abbr></a>.',
	'MATHJAX_CDN_FORCE_SSL'			=> 'Force uma ligação segura à <abbr title="Rede de Distribuição de Conteúdo">CDN</abbr>',
	'MATHJAX_CDN_FORCE_SSL_EXPLAIN'	=> 'Use uma ligação por HTTPS mesmo que o forum não use uma ligação segura.',
	'MATHJAX_URI'					=> 'Caminho para a pasta do MathJax',
	'MATHJAX_URI_EXPLAIN'			=> 'Se não usa a <abbr title="Rede de Distribuição de Conteúdo">CDN</abbr>, tem que introduzir o caminho para a sua instalação local e.g. <samp>assets/javascript/MathJax</samp>. <br /> Se usa a <abbr title="Rede de Distribuição de Conteúdo">CDN</abbr> pode, na mesma, introduzir o caminho para o caso da <abbr title="Rede de Distribuição de Conteúdo">CDN</abbr> estar offline. <br /> ',
	'MATHJAX_DYNAMIC_LOAD'			=> 'Carregar o MathJax dinamicamente',
	'MATHJAX_DYNAMIC_LOAD_EXPLAIN'	=> 'O código JavaScript apenas é carregado pelo browser se houver BBCodes para serem processadas na página.',
	'MATHJAX_CONFIG'				=> 'Ficheiro de configuração',
	'MATHJAX_CONFIG_EXPLAIN'		=> 'O nome do ficheiro de configuração do MathJax e.g. <samp>TeX-AMS-MML_HTMLorMML</samp>. Valores e sintaxe válida são explicados na <a href="http://www.mathjax.org/docs/1.1/configuration.html#using-a-configuration-file">documentação</a>.',
	
// BBCode Settings
	'MATHJAX_BBCODE_TYPE'				=> 'Tipo de Matemática',
	'MATHJAX_BBCODE_TAG'				=> 'Tag de BBCode',
	'MATHJAX_BBCODE_DISPLAY'			=> 'Mostrar no editor',
	'MATHJAX_BBCODE_DISPLAY_EXPLAIN'	=> 'Mostra a tag no editor de posts.',
	'MATHJAX_BBCODE_HELPLINE'			=> 'Texto de ajuda', 
	'MATHJAX_BBCODE_HELPLINE_EXPLAIN'	=> 'Neste campo deve ser inserido o texto mostrado quando se coloca o cursor sobe o BBCode no editor.',
	'MATHJAX_PREVIEW'					=> 'Texto de pré-visualização',
	'MATHJAX_PREVIEW_EXPLAIN'			=> 'Por defeito o código matemático é mostrado antes dos símbolos matemáticos estarem prontos. <br /> Pode meter neste campo um texto para pré-visualização e.g. <samp>[Processando]</samp>. Se não pretende qualquer tipo de visualização use <samp>{NONE}</samp>.',
	'MATH_TYPE_TEX'						=> 'LaTeX',
	'MATH_TYPE_MML'						=> 'MathML',
	'BBCODE_TAG'						=> 'TAG',
	'ADD_BBCODE'						=> 'Adicionar novo BBCode', 
));
