<?php 
exit();
	/**
	 * change the widget column because Elgg chaned it
	 */
	
	require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php");
	
	admin_gatekeeper();
	set_time_limit(0);
	
	$dbprefix = elgg_get_config("dbprefix");
	
	// move column 1 to 99
	$query = "UPDATE " . $dbprefix . "private_settings";
	$query .= " SET value = 99";
	$query .= " WHERE name = 'column'";
	$query .= " AND value = 1";
	
	update_data($query);
	
	// move column 3 to 1
	$query = "UPDATE " . $dbprefix . "private_settings";
	$query .= " SET value = 1";
	$query .= " WHERE name = 'column'";
	$query .= " AND value = 3";
	
	update_data($query);
	
	// move column 99 to 3
	$query = "UPDATE " . $dbprefix . "private_settings";
	$query .= " SET value = 3";
	$query .= " WHERE name = 'column'";
	$query .= " AND value = 99";
	
	update_data($query);
	
	echo "done";
	
	