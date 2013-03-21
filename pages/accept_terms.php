<?php 
	
	gatekeeper();
	
	$title_text = elgg_echo("elgg_modifications:accept_terms:title");
	
	if(get_input("accept_terms_deactivate", false) == true){
		$body = elgg_view("elgg_modifications/accept_terms/deactivate");
	} else {
		$body = elgg_view("elgg_modifications/accept_terms/accept");
	}
	
	// make the page
	$page_data = elgg_view_layout("one_column", array(
		"title" => $title_text,
		"content" => $body
	));
	
	// Finally draw the page
	echo elgg_view_page($title_text, $page_data);