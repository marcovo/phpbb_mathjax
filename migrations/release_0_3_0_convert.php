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
		// This file is only meant to be executed if the corresponding mod was installed on phpBB 3.0
		return (!isset($this->config['mathjax_mod_version_version']) && !isset($this->config['mathjax_mod_version']));
	}

	static public function depends_on()
	{
		return array();
	}

	public function update_data()
	{
		// Do some necessary cleaning
		return array(
			// Remove old & bad version configs
			array('if', array( isset($this->config['mathjax_mod_version_version']),
				array('config.remove', 		 array('mathjax_mod_version_version')),
			)),
			array('if', array( isset($this->config['mathjax_mod_version']),
				array('config.remove', 		 array('mathjax_mod_version')),
			)),
			
			// Remove deprecated config values
			array('if', array( isset($this->config['mathjax_enabled_post']),
				array('config.remove', 		 array('mathjax_enabled_post')),
			)),
			array('if', array( isset($this->config['mathjax_enabled_pm']),
				array('config.remove', 		 array('mathjax_enabled_pm')),
			)),
			array('if', array( isset($this->config['mathjax_enable_post']),
				array('config.remove', 		 array('mathjax_enable_post')),
			)),
			array('if', array( isset($this->config['mathjax_enable_pm']),
				array('config.remove', 		 array('mathjax_enable_pm')),
			)),
			
			// Update outdated values
			array('if', array(
					isset($this->config['mathjax_cdn_ssl']) && (
						$this->config['mathjax_cdn_ssl'] == 'https://d3eoax9i5htok0.cloudfront.net/mathjax/latest' || 
						$this->config['mathjax_cdn_ssl'] == 'https://c328740.ssl.cf1.rackcdn.com/mathjax/latest'
					),
				array('config.update', 		 array('mathjax_cdn_ssl', 'https://cdn.mathjax.org/mathjax/latest')),
			)),
			
			// Remove old ACP module if it exists
			array('if', array(
				array('module.exists', array('acp', 'ACP_CAT_DOT_MODS', 'ACP_MATHJAX_CAT')),
				array('module.remove', array('acp', 'ACP_CAT_DOT_MODS', 'ACP_MATHJAX_CAT')),
			)),
			
		);
	}

}
