<?php 

	$user = elgg_get_logged_in_user_entity();
	
	// ban the user for not accepting terms
	$user->ban("Declined General Terms");
	
	// logout the user
	logout();
	
	forward();
