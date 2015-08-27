<?php
/** 
*
* @package MathJax
* @copyright (c) 2014 Sérgio Faria and Marco van Oort
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2 
*
*/

namespace marcovo\mathjax\migrations;

class release_1_0_0_data extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['mathjax_ext_version']) && version_compare($this->config['mathjax_ext_version'], '1.0.0', '>=');
	}

	static public function depends_on()
	{
		return array('\marcovo\mathjax\migrations\release_0_3_0_data');
	}

	public function update_data()
	{
		return array(
			array('config.update', array('mathjax_ext_version', '1.0.0')),
		);
	}

}
