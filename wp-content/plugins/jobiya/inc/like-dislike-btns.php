<?php
// Create like and dislike buttons using filter
function jobiya_like_dislike_buttons($content){
	$like_btn_label = get_option('jobiya_like_btn_lable', 'Like');
	$dislike_btn_label = get_option('jobiya_dislike_btn_lable', 'DisLike');

	$like_btn_wrap = ' <div class="jobiya-btn-container"> ';
	$like_btn = ' <a href="javascript:;" class="jobiya-btn jobiya-like-btn"> '.$like_btn_label.'  </a> ';
	$dislike_btn = ' <a href="javascript:;" class="jobiya-btn jobiya-dislike-btn">  '.$dislike_btn_label.' </a> ';
	$like_btn_wrap_end = '</div>'; 

	$content .= $like_btn_wrap;
	$content .= $like_btn;		// Append like btn after content
	$content .= $dislike_btn;	// Append dislike btn after content
	$content .= $like_btn_wrap_end;

	return $content; 
}
add_filter('the_content', 'jobiya_like_dislike_buttons');