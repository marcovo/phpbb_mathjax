<?php
/** 
*
* @package MathJax
* @copyright (c) 2014 Sérgio Faria and Marco van Oort
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2 
*
*/

namespace marcovo\mathjax\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	protected $user;
	protected $template;
	protected $config;

	/**
	* Constructor
	*
	* @param \phpbb\controller\helper    $helper        Controller helper object
	*/
	public function __construct(\phpbb\user $user, \phpbb\template\template $template, \phpbb\config\config $config)
	{
		$this->user = $user;
		$this->template = $template;
		$this->config = $config;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.page_header_after'	=> 'page_header_after',
			'test.bbcode_cache_init'	=> 'bbcode_cache_init',
		);
	}

	public function page_header_after($event)
	{
		// Start 'building' Mathjax url
		if (!empty($this->config['mathjax_enable']))
		{
			$mathjax_file = (!empty($this->config['mathjax_config'])) ? '/MathJax.js?config=' . $this->config['mathjax_config'] : '/MathJax.js';
			
			if(!empty($this->config['mathjax_use_cdn']))
			{
				if(!empty($this->config['mathjax_cdn_force_ssl']))
				{
					$mathjax_uri = $this->config['mathjax_cdn_ssl'];
				}
				else
				{
					$server_protocol = ($this->config['server_protocol']) ? $this->config['server_protocol'] : (($this->config['cookie_secure']) ? 'https://' : 'http://');
					$mathjax_uri = ($server_protocol === 'http://') ? $this->config['mathjax_cdn'] : $this->config['mathjax_cdn_ssl'];
				}
				$mathjax_uri_fallback = (!empty($this->config['mathjax_uri'])) ? ($this->config['mathjax_uri'] . $mathjax_file) : ''; 
			}
			else
			{
				$mathjax_uri = isset($this->config['mathjax_uri']) ? $this->config['mathjax_uri'] : '';
			}

			$mathjax_uri = $mathjax_uri . $mathjax_file;
			
			if(empty($this->config['mathjax_dynamic_load']))
			{
				$this->template->assign_var('S_ENABLE_MATHJAX', true);
			}
		}
		
		$this->template->assign_vars(array(
			'T_MATHJAX_ASSETS_PATH'	=> './ext/marcovo/mathjax/assets',
			'U_MATHJAX'				=> (isset($mathjax_uri)) ? $mathjax_uri : '',
			'UA_MATHJAX_FALLBACK'	=> (isset($mathjax_uri_fallback)) ? $mathjax_uri_fallback : '',
			'S_MATHJAX_HAS_FALLBACK'=> (!empty($mathjax_uri_fallback)) ? true : false,
		));
	}
	
	public function bbcode_cache_init($event)
	{
		if (!empty($this->config['mathjax_enable']) && !empty($event['rowset'][$event['bbcode_id']]['is_math'])) 
		{
			$this->template->assign_var('S_ENABLE_MATHJAX', true);
		}
	}
}
