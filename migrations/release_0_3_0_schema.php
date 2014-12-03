<?php
/** 
*
* @package MathJax
* @copyright (c) 2014 Sérgio Faria and Marco van Oort
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2 
*
*/

namespace marcovo\mathjax\migrations;

class release_0_3_0_schema extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return $this->db_tools->sql_column_exists(BBCODES_TABLE, 'is_math');
	}

	static public function depends_on()
	{
		return array();
	}

	public function update_schema()
	{
		return array(
			'add_columns' => array(
				BBCODES_TABLE => array(
					'is_math' => array('BOOL', '0')
				),
			)
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns' => array(
				BBCODES_TABLE => array(
					'is_math'
				),
			)
		);
	}

}
