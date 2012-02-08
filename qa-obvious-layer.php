<?php

if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
header('Location: ../');
exit;
}
class qa_html_theme_layer extends qa_html_theme_base {



	function q_list_item($q_item)
	{
		$userid = qa_get_logged_in_userid();
		if(qa_opt('obvious_content_on') && $userid)
		{
			require_once QA_INCLUDE_DIR.'qa-db-selects.php';
			$fav_tags = qa_db_single_select(qa_db_user_favorite_tags_selectspec($userid));
			foreach($fav_tags as $k => $v)
				$tag[$k] =  $v['word'];
			$post_tags = explode(",", $q_item['raw']['tags']);
			$result = array_diff($tag, $post_tags);
			if(sizeof($result) != sizeof($tag) && $tag)
				@$q_item['classes'] .= " is_favorite";
		}
		if(qa_opt('obvious_content_category_on') && $userid)
		{
			require_once QA_INCLUDE_DIR.'qa-db-selects.php';
			$fav_cats = qa_db_single_select(qa_db_user_favorite_categories_selectspec($userid));
			foreach($fav_cats as $k => $v)
				$cat[$k] =  $v['word'];
			$post_cat = explode(",", $q_item['raw']['category']);
			$result = array_diff($cat, $post_cat);
			if(sizeof($result) != sizeof($cat) && $cat)
				@$q_item['classes'] .= " is_favorite_cat";
			
		}
		qa_html_theme_base::q_list_item($q_item);// call back through to the default function
	}

	function head_css()
	{
		qa_html_theme_base::head_css();// call back through to the default function
		$this->output('<STYLE>',
			'.is_favorite{background:'.qa_opt('obvious_content_color').';padding:10px}',
			'.is_favorite_cat{background:'.qa_opt('obvious_content_category_color').';padding:10px}',
			'</STYLE>');
	}

}
/*
Omit PHP closing tag to help avoid accidental output
*/