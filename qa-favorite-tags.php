<?php

	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
		header('Location: ../');
		exit;
	}

class qa_tag_favorite{

function allow_template($template)
	{
		switch ($template)
		{
			case 'activity':
			case 'qa':
			case 'questions':
			case 'hot':
			case 'ask':
			case 'categories':
			case 'question':
			case 'tag':
			case 'tags':
			case 'unanswered':
			case 'user':
			case 'users':
			case 'search':
			case 'admin':
				return true;
		}

		return false;
	}
	
	function allow_region($region){
		return $region == 'side';
	}
	
	function output_widget($region, $place, $themeobject, $template, $request, $qa_content)
	{
	require_once QA_INCLUDE_DIR.'qa-db-selects.php';
		$favoritetags = qa_db_single_select(qa_db_user_favorite_tags_selectspec(qa_get_logged_in_userid()) );
		$themeobject->output('<span class="qa-nav-cat-list qa-nav-cat-link">Favorite Tags</span><br>');
		foreach($favoritetags as $k => $v)
		{
		$tag = $v['word'];
		
		$themeobject->output('<a href="' . qa_path_html('tag/'.$tag).'" class="qa-tag-link">' . qa_html($tag) . '</a><br>');
		}
	}
}