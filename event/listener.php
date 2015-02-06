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
	protected $db;

	protected $a_math_bbcode_ids = null;
	protected $b_load_math = false;

	/**
	* Constructor
	*
	* @param \phpbb\controller\helper    $helper        Controller helper object
	*/
	public function __construct(\phpbb\user $user, \phpbb\template\template $template, \phpbb\config\config $config, \phpbb\db\driver\factory $db)
	{
		$this->user = $user;
		$this->template = $template;
		$this->config = $config;
		$this->db = $db;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.page_header_after'	=> 'page_header_after',
			'core.bbcode_cache_init_end'	=> 'bbcode_cache_init_end',
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
	
	public function bbcode_cache_init_end($event)
	{
		// If we know already that we have to load the math library js, we won't have to do the check again
		if($this->b_load_math)
		{
			return;
		}

		// If mathjax isn't enabled, we don't have to check anything...
		if(empty($this->config['mathjax_enable']))
		{
			return;
		}
		
		// If not done already, load the id's of the bbcodes that have a math-flag
		if($this->a_math_bbcode_ids === null)
		{
			$this->a_math_bbcode_ids = array();
			$s_sql = 'SELECT bbcode_id FROM ' . BBCODES_TABLE . ' WHERE is_math = 1';
			$qry_bbcodes = $this->db->sql_query($s_sql);
			while($a_bbcode = $this->db->sql_fetchrow($qry_bbcodes))
			{
				$this->a_math_bbcode_ids[] = $a_bbcode['bbcode_id'];
			}
			$this->db->sql_freeresult($qry_bbcodes);
		}
		
		// Check whether to load the math library js
		$bbcode_cache = $event['bbcode_cache'];
		foreach($this->a_math_bbcode_ids as $i_math_bbcode_id)
		{
			if(isset($bbcode_cache[$i_math_bbcode_id]) && $bbcode_cache[$i_math_bbcode_id] != false)
			{
				$this->b_load_math = true;
				$this->template->assign_var('S_ENABLE_MATHJAX', true);
				break;
			}
		}
	}
}
