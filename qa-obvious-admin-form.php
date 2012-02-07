<?php
if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
header('Location: ../');
exit;
}

class qa_obvious_admin_form{

	function option_default($option) {
		switch($option)
		{
			case 'obvious_content_color':
			return '#FFEFC6';
			case 'obvious_max_tags':
			return '10';
				case 'obvious_content_category_color':
				return '#FFEFC6';
			default:
			return null;
		}
	}

	function admin_form(&$qa_content)
	{
		$ok=null;

		if (qa_clicked('obvious_save_button')) {
			qa_opt('obvious_content_on', (bool)qa_post_text('obvious_content_on'));
			qa_opt('obvious_content_color', (string)qa_post_text('obvious_content_color'));
			qa_opt('obvious_max_tags', (int)qa_post_text('obvious_max_tags'));
			qa_opt('obvious_content_category_on', (bool)qa_post_text('obvious_content_category_on'));
			qa_opt('obvious_content_category_color', (string)qa_post_text('obvious_content_category_color'));
			$ok = qa_lang('admin/options_saved');
		}
		else if (qa_clicked('obvious_reset_button')) {
			foreach($_POST as $i => $v) {
				$def = $this->option_default($i);
				if($def !== null) qa_opt($i,$def);
			}
			$ok = qa_lang('admin/options_reset');
		}

		$fields = array();
		$fields[] = array(
			'label' => 'Enable Obvious Favorite Tags',
			'tags' => 'NAME="obvious_content_on"',
			'value' => qa_opt('obvious_content_on'),
			'type' => 'checkbox',
			);	
		$fields[] = array(
			'label' => 'Your color in Hex',
			'tags' => 'NAME="obvious_content_color"',
			'value' => qa_opt('obvious_content_color'),
			'type' => 'string',
			);
			$fields[] = array(
				'label' => 'Enable Obvious Favorite Category',
				'tags' => 'NAME="obvious_content_category_on"',
				'value' => qa_opt('obvious_content_category_on'),
				'type' => 'checkbox',
				);	
			$fields[] = array(
				'label' => 'Your color in Hex',
				'tags' => 'NAME="obvious_content_category_color"',
				'value' => qa_opt('obvious_content_category_color'),
				'type' => 'string',
				);
		$fields[] = array(
			'type' => 'blank',
			);
		$fields[] = array(
			'label' => 'Maximum tags for the Widget',
			'tags' => 'NAME="obvious_max_tags"',
			'value' => qa_opt('obvious_max_tags'),
			'type' => 'int',
			);
		return array(
			'ok' => ($ok && !isset($error)) ? $ok : null,

			'fields' => $fields,

		'buttons' => array(
		array(
			'label' => qa_lang_html('main/save_button'),
			'tags' => 'NAME="obvious_save_button"',
			),
		array(
			'label' => qa_lang_html('admin/reset_options_button'),
			'tags' => 'NAME="obvious_reset_button"',
			),
			),
			);		
	}

}