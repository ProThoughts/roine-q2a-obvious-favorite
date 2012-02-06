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