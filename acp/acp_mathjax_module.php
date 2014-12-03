<?php
/** 
*
* @package MathJax
* @copyright (c) 2014 Sérgio Faria and Marco van Oort
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2 
*
*/

namespace marcovo\mathjax\acp;

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * @ignore
 */

/**
* @package acp
*/
class acp_mathjax_module
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $request, $phpbb_log;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		// Set up general vars
		$action	= $request->variable('action', '');
        $submit = isset($_POST['submit']) ? true : false;
		
		$user->add_lang_ext('marcovo/mathjax', 'info_acp_mathjax');
		$this->tpl_name = 'acp_mathjax';
		
		$form_key = 'acp_mathjax';
		add_form_key($form_key);

		switch ($mode) {
			case 'settings':
				$display_vars = array(
					'title'	=> 'MATHJAX_SETTINGS',
					'vars'	=> array(
						'legend1'				=> 'GENERAL_SETTINGS',
						'mathjax_enable'		=> array('lang' => 'MATHJAX_ENABLE',		'validate' => 'bool',	'type' => 'radio:enabled_disabled',	'explain' => false),
						'mathjax_dynamic_load'	=> array('lang' => 'MATHJAX_DYNAMIC_LOAD',	'validate' => 'bool',	'type' => 'radio:yes_no',			'explain' => true),
						'mathjax_use_cdn'		=> array('lang' => 'MATHJAX_USE_CDN',		'validate' => 'bool',	'type' => 'radio:yes_no',			'explain' => true),
						'mathjax_cdn_force_ssl' => array('lang' => 'MATHJAX_CDN_FORCE_SSL',	'validate' => 'bool',	'type' => 'radio:yes_no',			'explain' => true),
						'mathjax_uri'			=> array('lang' => 'MATHJAX_URI',									'type' => 'text:20:255',			'explain' => true),
						'mathjax_config'		=> array('lang' => 'MATHJAX_CONFIG',		'validate' => 'string',	'type' => 'text:20:255',			'explain' => true),	
												
						'legend2'				=> 'ACP_SUBMIT_CHANGES',
					),
				);
			break;

			case 'bbcode':
				$this->math_types = array(
					'math/tex' => 'MATH_TYPE_TEX', 
					'math/mml' => 'MATH_TYPE_MML',
				);
				
				$display_vars = array(
					'title'	=> 'MATHJAX_BBCODE',
					'vars'	=> array(),
				);

				switch($action)
				{
					case 'add':	// Dummy case for the submit button on list
						$action = 'create';
						$submit = false;
					// No break
					
					case 'modify':
					case 'create':
						$display_vars['vars'] = array(
							'legend1'				=> 'BBCODE_EDITOR',
							'bbcode_tag'			=> array('lang' => 'MATHJAX_BBCODE_TAG',		'validate' => 'string:1:16',	'type' => 'text:20:16',			'explain' => false),
							'math_type'				=> array('lang' => 'MATHJAX_BBCODE_TYPE', 		'type' => 'custom',				'method' => 'build_math_type', 	'explain' => false),
							'display_on_posting'	=> array('lang' => 'MATHJAX_BBCODE_DISPLAY',	'validate' => 'bool',			'type' => 'radio:yes_no',		'explain' => true),
							'bbcode_helpline'		=> array('lang' => 'MATHJAX_BBCODE_HELPLINE',	'validate' => 'string',			'type' => 'text:20:255', 		'explain' => true),
							'mathjax_preview'		=> array('lang' => 'MATHJAX_PREVIEW',			'validate' => 'string', 		'type' => 'text:20:255',		'explain' => true),
	
							'legend2'				=> 'ACP_SUBMIT_CHANGES',
						);
					break;

					case 'delete':
					break;

					case 'list':
					default: // List bbcodes
						$action = 'list';
						$template->assign_var('S_LIST_BBCODE', true);
						
						$sql = 'SELECT bbcode_id, bbcode_tag
							FROM ' . BBCODES_TABLE . ' 
							WHERE is_math = 1';
						$result = $db->sql_query($sql);

						while($row = $db->sql_fetchrow($result))
						{
							$template->assign_block_vars('bbcodes', array(
								'BBCODE_TAG'	=> $row['bbcode_tag'],
								'U_EDIT' 		=> $this->u_action . '&amp;action=modify&amp;bbcode_id=' . $row['bbcode_id'],
								'U_DELETE' 		=> $this->u_action . '&amp;action=delete&amp;bbcode_id=' . $row['bbcode_id'],
							));
						}
						$db->sql_freeresult($result);
					break;
				}
			break;

			default:
				trigger_error('NO_MODE', E_USER_ERROR);
			break;
		}

		if (isset($display_vars['lang']))
		{
			$user->add_lang($display_vars['lang']);
		}
		
		$bbcode_helper = new \marcovo\mathjax\includes\bbcode();
		
		// Override $this->new_config if the bbcode exists
		if ($mode == 'bbcode' && ($action == 'modify' || $action =='delete'))
		{
			if (($bbcode_id = (int) $request->variable('bbcode_id', -1)) == -1)
			{
				trigger_error('NO_BBCODE_ID', E_USER_WARNING);
			}
			
			$sql = 'SELECT *
				FROM ' . BBCODES_TABLE . "
				WHERE bbcode_id = $bbcode_id";
			$result = $db->sql_query($sql);
			
			$this->new_config = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
			
			// But before lets test if bbcode_id exists and its ours
			if (empty($this->new_config['is_math']))
			{
				trigger_error('BBCODE_DOESNT_EXIST', E_USER_WARNING);
			}

			// Lets infer the BBCode type and math preview from the tpl (but only on modify - theres no need in delete)
			if ($action == 'modify')
			{
				if (!preg_match('/(?:\<span class="MathJax_Preview"\>(.*?)\<\/span\>)?\<span class="(math\/[a-z]+)"(?:.+?(visibility: hidden))?/', $this->new_config['bbcode_tpl'], $result))
				{
					trigger_error('BBCODE_NOT_MATH_TPL', E_USER_WARNING);
				}
				// $result[0] = Whole matched text	$result[1] = Preview text?      (might be empty)   
				// $result[2] = math type			$result[3] = visibility hidden? (might not be set)
				$this->new_config['math_type'] = $result[2];

				// Check if {NONE} was used
				$this->new_config['mathjax_preview'] = (empty($result[1]) && !empty($result[3])) ? '{NONE}' : $result[1];
			}
		}
		else if ($mode == 'bbcode')
		{
			$this->new_config = array();
		}
		else
		{
			$this->new_config = $config;
		}
		
		$cfg_array = (isset($_REQUEST['config'])) ? utf8_normalize_nfc($request->variable('config', array('' => ''), true)) : $this->new_config;
		$error = array();

		// We validate the complete config if whished
		validate_config_vars($display_vars['vars'], $cfg_array, $error);
		
		if (isset($cfg_array['math_type']))
		{
			$this->validate_math_type($cfg_array['math_type']);
		}

		// Lets check if the path entered isn't valid and if we're gonna complain
		if ($submit && $mode == 'settings' && !$bbcode_helper->validate_mathjax_path($cfg_array['mathjax_uri']))
		{
			// If the user left it blank but enabled the cdn we won't complain but...
			if (!empty($cfg_array['mathjax_uri']))
			{
				$error[] = $user->lang['INVALID_MATHJAX_PATH'];
				$cfg_array['mathjax_uri'] = '';
			}
			else if ($cfg_array['mathjax_use_cdn'] == false)
			{
				$error[] = $user->lang['MUST_CONFIGURE_MATHJAX'];
			}
		}
		
		if ($submit && !check_form_key($form_key))
		{
			$error[] = $user->lang['FORM_INVALID'];
		}
		
		// Do not write values if there is an error
		if (sizeof($error))
		{
			$submit = false;
		}
		
		// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
		foreach ($display_vars['vars'] as $config_name => $null)
		{
			if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
			{
				continue;
			}
			$this->new_config[$config_name] = $config_value = $cfg_array[$config_name];

			if ($submit && $mode != 'bbcode')
			{
				$config->set($config_name, $config_value);
			}
		}

		// Do some more work here for bbcodes
		if ($mode == 'bbcode')
		{
			if ($action == 'delete')
			{
				if (confirm_box(true))
				{
					$bbcode_helper->remove_bbcode($bbcode_id);
					$phpbb_log->add('admin', $user->data['user_id'], $user->ip, 'LOG_BBCODE_DELETE', false, array('bbcode_tag'=>$this->new_config['bbcode_tag']));
					trigger_error($user->lang['BBCODE_DELETED'] . adm_back_link($this->u_action));
				}
				else
				{
					$msg = sprintf($user->lang['BBCODE_DELETE_CONFIRM'], $this->new_config['bbcode_tag']);
					confirm_box(false, $msg, build_hidden_fields(array(
						'bbcode_id'	=> $bbcode_id,
						'mode'		=> $mode,
						'action'	=> $action,
					)));
				}
			}
			else if ($submit)
			{
				if ($action == 'modify')
				{
					$bbcode_helper->modify_bbcode($this->new_config, $error);
					$log_action = 'LOG_BBCODE_EDIT';
					$notice_msg = 'BBCODE_MODIFIED';
				} 
				else if ($action == 'create')
				{
					$bbcode_helper->create_bbcode($this->new_config, $error);
					$log_action = 'LOG_BBCODE_ADD';
					$notice_msg = 'BBCODE_CREATED';
				}
			}
		}
		
		if (sizeof($error))
		{
			$submit = false;
		}

		if ($submit && !($mode == 'bbcode' && $action == 'list'))
		{
			if ($mode == 'bbcode')
			{
				$phpbb_log->add('admin', $user->data['user_id'], $user->ip, $log_action, false, array('bbcode_tag'=>$this->new_config['bbcode_tag']));
				trigger_error($user->lang[$notice_msg] . adm_back_link($this->u_action));
			}
			else
			{
				$phpbb_log->add('admin', $user->data['user_id'], $user->ip, 'LOG_CONFIG_MATHJAX');
				trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
			}
		}

		$this->page_title = $display_vars['title'];
		$template->assign_vars(array(
			'L_TITLE'			=> $user->lang[$display_vars['title']],
			'L_TITLE_EXPLAIN'	=> $user->lang[$display_vars['title'] . '_EXPLAIN'],

			'S_ERROR'			=> (sizeof($error)) ? true : false,
			'ERROR_MSG'			=> implode('<br />', $error),
		));
		
		// Assign U_ACTION
		if($mode == 'bbcode')
		{
			switch ($action)
			{
				case 'list':
					$template->assign_var('U_ACTION', $this->u_action . '&amp;action=add');
				break;
				
				case 'create':
					$template->assign_var('U_ACTION', $this->u_action . '&amp;action=create');
				break;
				
				case 'modify':
					$template->assign_var('U_ACTION', $this->u_action . '&amp;action=modify&amp;bbcode_id=' . $bbcode_id);
				break;
				
				default:
					$template->assign_var('U_ACTION', $this->u_action);
				break;
			}
		}
		else
		{
			$template->assign_var('U_ACTION', $this->u_action);
		} 
		
		// Output relevant page set in $display_vars
		foreach ($display_vars['vars'] as $config_key => $vars)
		{
			if (!is_array($vars) && strpos($config_key, 'legend') === false)
			{
				continue;
			}

			if (strpos($config_key, 'legend') !== false)
			{
				$template->assign_block_vars('options', array(
					'S_LEGEND'		=> true,
					'LEGEND'		=> (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars
				));

				continue;
			}

			$type = explode(':', $vars['type']);

			$l_explain = '';
			if ($vars['explain'] && isset($vars['lang_explain']))
			{
				$l_explain = (isset($user->lang[$vars['lang_explain']])) ? $user->lang[$vars['lang_explain']] : $vars['lang_explain'];
			}
			else if ($vars['explain'])
			{
				$l_explain = (isset($user->lang[$vars['lang'] . '_EXPLAIN'])) ? $user->lang[$vars['lang'] . '_EXPLAIN'] : '';
			}

			$content = build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars);

			if (empty($content))
			{
				continue;
			}

			$template->assign_block_vars('options', array(
				'KEY'			=> $config_key,
				'TITLE'			=> (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
				'S_EXPLAIN'		=> $vars['explain'],
				'TITLE_EXPLAIN'	=> $l_explain,
				'CONTENT'		=> $content,
				)
			);

			unset($display_vars['vars'][$config_key]);
		}
	}

	function build_math_type()
	{
		global $user;
		
		$selected = (!empty($this->new_config['math_type'])) ? $this->new_config['math_type'] : 'math/tex';
		$html = '<select id="math_type" name="config[math_type]">';

		foreach ($this->math_types as $type => $lang)
		{
			$select = ($selected == $type) ? ' selected="selected"' : '';
			$html .= '<option value="' . $type . '"' . $select . '>' . $user->lang[$lang] . '</option>';
		}
		
		return $html . '</select>';
	}
	
	function validate_math_type($type)
	{
		if (!array_key_exists($type, $this->math_types))
		{
			trigger_error('Invalid math type', E_USER_ERROR);
		}
	}
}
