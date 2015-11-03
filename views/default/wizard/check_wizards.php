<?php
/**
 * Check if the user needs to do a wizard
 */

$user = elgg_get_logged_in_user_entity();
if (!empty($user) && empty($_SESSION['terms_accepted'])) {
	// user has not yet accepted the terms of service of Pleio
	return;
}

wizard_check_wizards();