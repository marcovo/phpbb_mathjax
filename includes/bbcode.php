<?php
/**
* Mainly BBCode functions to insert/update/remove math bbcodes.
*
* @package MathJax
* @copyright (c) 2014 Sérgio Faria and Marco van Oort
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2 
*
*/

namespace marcovo\mathjax\includes;

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}


/* BBCode configuration:
 * The parameter for generate_bbcode_template(),
 * create_bbcode and modify_bbcode().
 * 
 * 	$bbcode = array(
 * 		'bbcode_id'				=> '', // just for modify 
 * 		'bbcode_tag' 			=> '',
 * 		'math_type'				=> '',
 * 		'display_on_posting'	=> '',
 * 		'bbcode_helpline'		=> '',
 * );
 * 
 */

class bbcode
{

	/**
	* Creates the bbcode with the given configuration.
	* @param array bbcode The bbcode new configuration with its id. Its tag may be "normalized".
	* @param array error If the bbcode tag isn't valid or exists a message is printed to this array.
	*/
	function create_bbcode(&$bbcode, &$error)
	{
		global $db, $cache, $user;
		
		$tag =& $bbcode['bbcode_tag'];

		if (!$this->verify_tag($tag)) 
		{
			$error[] = sprintf($user->lang['ERROR_BBCODE_INVALID'], $tag);
		}
		else if ($this->bbcode_exists($tag))
		{
			$error[] = sprintf($user->lang['ERROR_BBCODE_EXISTS'], $tag);
		}
		else if (($bbcode_id = $this->get_free_bbcode_id()) === false)
		{
			$error[] = $user->lang['TOO_MANY_BBCODES'];
		}
		else
		{
			$sql_ary = array_merge(
				array('bbcode_id' => $bbcode_id),
				$this->generate_bbcode_template($bbcode)
			);

			$db->sql_query('INSERT INTO ' . BBCODES_TABLE . $db->sql_build_array('INSERT', $sql_ary));
			$cache->destroy('sql', BBCODES_TABLE);
		}
	}

	/**
	* Modifies the bbcode given.
	* Note: that $bbcode['bbcode_id'] is mandatory and a valid id is assumed.
	* @param array bbcode The bbcode new configuration with its id. Its tag may be "normalized".
	* @param array error If the bbcode tag isn't valid or is hardcoded a message is printed to this array.
	*/
	function modify_bbcode(&$bbcode, &$error)
	{
		global $db, $cache, $user;
		static $hard_coded_bbcodes = array('code', 'quote', 'attachment', 'b', 'i', 'url', 'img', 'size', 'color', 'u', 'list', 'email', 'flash');
		
		$tag &= $bbcode['bbcode_tag'];
		
		if (!$this->verify_tag($tag)) 
		{
			$error[] = sprintf($user->lang['ERROR_BBCODE_INVALID'], $tag);
		}
		else if (in_array($tag, $hard_coded_bbcodes))
		{
			$error[] = sprintf($user->lang['ERROR_BBCODE_EXISTS'], $tag);
		}
		else
		{
			$template = $this->generate_bbcode_template($bbcode);

			$sql = 'UPDATE ' . BBCODES_TABLE . ' 
				SET ' . $db->sql_build_array('UPDATE', $template) . ' 
				WHERE bbcode_id = ' . (int) $bbcode['bbcode_id'];
			$db->sql_query($sql);
			$cache->destroy('sql', BBCODES_TABLE);
		}
	}

	/**
	* Verifies that the given tag is valid.
	* @param string tag Parameter by reference that may be "normalized".
	* @return boolean True if its valid, otherwise false.
	*/
	function verify_tag(&$tag)
	{
		// Lets be nice and allow [AwS-0Me_Tag2] and no_brackets_lazy_tag
		if (!preg_match('/^\[[a-zA-Z0-9_-]+\]$|^[a-zA-Z0-9_-]+$/', $tag)) 
		{
			return false;
		}

		$tag = strtolower(trim($tag, '[]'));
		return true;
	}

	/**
	* Removes the bbcode with such id
	* Note: It doesn't check if it exists first.
	* @param int bbcode_id The id to remove.
	*/
	function remove_bbcode($bbcode_id)
	{
		global $db, $cache;

		$sql = 'DELETE 
			FROM ' . BBCODES_TABLE . ' 
			WHERE bbcode_id = ' . (int) $bbcode_id;
		$db->sql_query($sql);
		$cache->destroy('sql', BBCODES_TABLE);
	}

	/**
	* Checks if a valid lowercase bbcode tag exists in the BBCodes table
	* @return boolean True if it exists, otherwise false.
	*/
	function bbcode_exists($tag)
	{
		global $db;
		static $hard_coded_bbcodes = array('code', 'quote', 'attachment', 'b', 'i', 'url', 'img', 'size', 'color', 'u', 'list', 'email', 'flash');
		
		if (in_array($tag, $hard_coded_bbcodes))
		{
			return false;
		}

		$sql = 'SELECT 1 as test 
			FROM ' . BBCODES_TABLE . " 
			WHERE LOWER(bbcode_tag) = '" . $db->sql_escape($tag) . "'";
		$result = $db->sql_query($sql);
		$info = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		return ($info['test'] === '1') ? true : false;
	}

	/**
	* Gets a free bbcode id in the BBCodes table
	* @return mixed A free id (int) in the BBCodes table or false if trigger_error() was called
	*/
	function get_free_bbcode_id()
	{
		global $db, $user;
		
		$sql = 'SELECT MAX(bbcode_id) as max_bbcode_id
			FROM ' . BBCODES_TABLE;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		if ($row)
		{
			$bbcode_id = $row['max_bbcode_id'] + 1;

			// Make sure it is greater than the core bbcode ids...
			if ($bbcode_id <= NUM_CORE_BBCODES)
			{
				$bbcode_id = NUM_CORE_BBCODES + 1;
			}
		}
		else
		{
			$bbcode_id = NUM_CORE_BBCODES + 1;
		}

		if ($bbcode_id > BBCODE_LIMIT)
		{
			return false;
		}
		return (int) $bbcode_id;
	}

	/**
	* Generates all required fields, except the bbcode_id, required for a math bbcode.
	* @param array bbcode The bbcode configuration.
	* @return array The full bbcode template.
	*/
	function generate_bbcode_template($bbcode)
	{
		static $first_pass_replace = "str_replace(array(\"\\r\\n\", '\\\"', '\\'', '(', ')'), array(\"\\n\", '\"', '&#39;', '&#40;', '&#41;'), trim('\${1}'))";

		$tag = $bbcode['bbcode_tag'];
		$type = $bbcode['math_type'];
		$display_on_post = $bbcode['display_on_posting'];
		$helpline = $bbcode['bbcode_helpline'];

		if (!empty($bbcode['mathjax_preview']))
		{
			$preview = $bbcode['mathjax_preview'];
			$preview = ($preview == '{NONE}') ? '' : '<span class="MathJax_Preview">' . $preview . '</span>';  
			$style = ' style="visibility: hidden;"';
		}
		else
		{
			$preview = '';
			$style = '';
		}

		$template = array(
			'bbcode_tag'			=> $tag,
			'bbcode_helpline'		=> $helpline,
			'display_on_posting'	=> $display_on_post,
			'bbcode_match'			=> '[' . $tag . ']{TEXT}[/' . $tag . ']',
			'bbcode_tpl'			=> '<span class="MathJaxBB">' . $preview . '<span class="' . $type .'"' . $style . '>{TEXT}</span></span>',
			'first_pass_match' 		=> '!\[' . $tag . '\](.*?)\[/' . $tag . '\]!ies',
			'first_pass_replace' 	=> '\'[' . $tag . ':$uid]\'.' . $first_pass_replace . '.\'[/' . $tag . ':$uid]\'',
			'second_pass_match' 	=> '!\[' . $tag . ':$uid\](.*?)\[/' . $tag . ':$uid\]!s',
			'second_pass_replace' 	=> '<span class="MathJaxBB">' . $preview . '<span class="' . $type . '"' . $style . '>${1}</span></span>',
			'is_math'				=> true,
		);
		return $template;
	}

	/**
	* Tests if MathJax.js is present at a given relative path that can escape the phpbb root dir.
	* Based on validate_config_vars (adm/index.php)
	* 
	* @param path string Parameter by reference: the path to check.
	* @returns boolean True if MathJax.js exists in path, otherwise false.
	*/
	function validate_mathjax_path(&$path)
	{
		global $phpbb_root_path, $user;

		$path = trim($path);
		$path = rtrim($path, '/');

		// Make sure no NUL byte is present...
		if (strpos($path, "\0") !== false || strpos($path, '%00') !== false)
		{
			$path = '';
		}

		return file_exists($phpbb_root_path . $path . '/MathJax.js');
	}

}
