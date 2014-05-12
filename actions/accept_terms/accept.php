<?php 

	$user = elgg_get_logged_in_user_entity();
	
	$user->setPrivateSetting("general_terms_accepted", time());
	
	$forward = get_input("forward", false);
	if(!empty($forward)){
		forward(urldecode($forward));
	} else {
		forward();
	}
