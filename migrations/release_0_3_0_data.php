<?php
/** 
*
* @package MathJax
* @copyright (c) 2014 Sérgio Faria and Marco van Oort
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2 
*
*/

namespace marcovo\mathjax\migrations;

class release_0_3_0_data extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['mathjax_ext_version']) && version_compare($this->config['mathjax_ext_version'], '0.3.0', '>=');
	}

	static public function depends_on()
	{
		return array('\marcovo\mathjax\migrations\release_0_3_0_schema', '\marcovo\mathjax\migrations\release_0_3_0_convert');
	}

	public function update_data()
	{
		return array(
			// Add values that aren't present yet.
			array('if', array(!isset($this->config['mathjax_enable']),
				array('config.add', 		 array('mathjax_enable', true)),
			),
			array('if', array(!isset($this->config['mathjax_dynamic_load']),
				array('config.add', 		 array('mathjax_dynamic_load', true)),
			),
			array('if', array(!isset($this->config['mathjax_config']),
				array('config.add', 		 array('mathjax_config', 'TeX-AMS-MML_HTMLorMML')),
			),
			array('if', array(!isset($this->config['mathjax_cdn']),
				array('config.add', 		 array('mathjax_cdn', 'http://cdn.mathjax.org/mathjax/latest')),
			),
			array('if', array(!isset($this->config['mathjax_cdn_ssl']),
				array('config.add', 		 array('mathjax_cdn_ssl', 'https://c328740.ssl.cf1.rackcdn.com/mathjax/latest')),
			),
			array('if', array(!isset($this->config['mathjax_cdn_force_ssl']),
				array('config.add', 		 array('mathjax_cdn_force_ssl', false)),
			),
			array('if', array(!isset($this->config['mathjax_use_cdn']),
				array('config.add', 		 array('mathjax_use_cdn', false)),
			),
			array('if', array(!isset($this->config['mathjax_uri']),
				array('config.add', 		 array('mathjax_uri', '')),
			),
			
			// Add ACP module
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_MATHJAX_CAT'
			)),
			array('module.add', array(
				'acp',
				'ACP_MATHJAX_CAT',
				array(
					'module_basename'	=> '\marcovo\mathjax\acp\acp_mathjax_module',
					'modes'				=> array('settings', 'bbcode'),
				),
			)),

			array('custom', array(array($this, 'add_latex_bbcode'))),
			array('custom', array(array($this, 'add_mml_bbcode'))),
			
			array('config.add', array('mathjax_ext_version', '0.3.0')),
		);
	}

	public function revert_data()
	{
		return array(
			array('custom', array(array($this, 'remove_math_bbcodes'))),
			
			array('config.remove', array('mathjax_enable')),
			array('config.remove', array('mathjax_dynamic_load')),
			array('config.remove', array('mathjax_config')),
			array('config.remove', array('mathjax_cdn')),
			array('config.remove', array('mathjax_cdn_ssl')),
			array('config.remove', array('mathjax_cdn_force_ssl')),
			array('config.remove', array('mathjax_use_cdn')),
			array('config.remove', array('mathjax_uri')),
			array('config.remove', array('mathjax_ext_version')),
		);
	}

	/**
	* Removes all math bbcodes
	*/
	function remove_math_bbcodes()
	{
		global $db;
	
		$sql = 'DELETE 
			FROM ' . BBCODES_TABLE . ' 
			WHERE is_math = 1';
		$db->sql_query($sql);
		
	}

	/**
	* Adds the latex bbcode if it's not already present
	*/
	function add_latex_bbcode()
	{
		global $user;

		$bbcode = array(
			'bbcode_tag'			=> 'latex',
			'math_type'				=> 'math/tex',
			'display_on_posting'	=> true,
			'bbcode_helpline'		=> '[latex]\\sqrt{4} = 2[/latex]',
			'mathjax_preview'		=> '[math]',
			'is_math'				=> 1,
		);

		$error  = array();
		
		$bbcode_helper = new \marcovo\mathjax\includes\bbcode();
		$bbcode_helper->create_bbcode($bbcode, $error);

	}

	/**
	* Adds the mml bbcode if it's not already present
	*/
	function add_mml_bbcode()
	{
		global $user;
		
		$bbcode = array(
			'bbcode_tag'			=> 'math',
			'math_type'				=> 'math/mml',
			'display_on_posting'	=> false,
			'bbcode_helpline'		=> '',
			'mathjax_preview'		=> '[math]',
			'is_math'				=> 1,
		);
		
		$error  = array();

		$bbcode_helper = new \marcovo\mathjax\includes\bbcode();
		$bbcode_helper->create_bbcode($bbcode, $error);

	}
}
