<?php
	
	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
		header('Location: ../');
		exit;
	}
class qa_html_theme_layer extends qa_html_theme_base {



function q_list_item($q_item)
		{
		if(qa_opt('obvious_content_on'))
		{
				require_once QA_INCLUDE_DIR.'qa-db-selects.php';
				$userid = qa_get_logged_in_userid();
				$fav_tags = qa_db_single_select(qa_db_user_favorite_tags_selectspec($userid));
				//print_r($test);
				foreach($fav_tags as $k => $v)
				$tag[$k] =  $v['word'];
				//compare the two array
				$post_tags = explode(",", $q_item['raw']['tags']);
				$result = array_diff($tag, $post_tags);
				// if it has tag in common add is_favorite in the classes
				if(sizeof($result) != sizeof($tag) && $tag)
				@$q_item['classes'] .= " is_favorite";
				}
				qa_html_theme_base::q_list_item($q_item);// call back through to the default function
		}
		
		function head_css()
		{
				qa_html_theme_base::head_css();// call back through to the default function
				$this->output('<STYLE>',
							'.is_favorite{background:'.qa_opt('obvious_content_color').';padding:10px}',
							'</STYLE>');
		}

}
/*
	Omit PHP closing tag to help avoid accidental output
*/