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
				$userid = qa_get_logged_in_userid();
				$tag_imp = Array();
				//select the tag_id in favorites
				$tag_id = qa_db_query_raw("SELECT entityid FROM qa_userfavorites  WHERE userid ='".$userid."' AND entitytype ='T'");
				$tags = qa_db_read_all_values($tag_id);
				//transform the tag_id in word and save it in tag_imp array
				foreach($tags as $k => $v){
				$tags_name = qa_db_query_raw("SELECT word FROM qa_words  WHERE wordid ='".$v."'");
				$tag = qa_db_read_all_values($tags_name);
				$tag_imp[$k] = $tag[0]; 
				}
				
				//compare the two array
				$post_tags = explode(",", $q_item['raw']['tags']);
				$result = array_diff($tag_imp, $post_tags);
				//print_r($tag_imp);
				//print_r( $post_tags);
				// if it has tag in common add is_favorite in the classes
				if(sizeof($result) != sizeof($tag_imp) && $tag_imp)
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