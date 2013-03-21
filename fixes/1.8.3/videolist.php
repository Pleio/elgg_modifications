<?php 
exit();
	/**
	 * Update the subtype of object => videolist to object => videolist_item
	 */

	require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php");
	
	admin_gatekeeper();

	$videolist_id = add_subtype("object", "videolist");
	$videolist_item_id = add_subtype("object", "videolist_item");
	
	$dbprefix = elgg_get_config("dbprefix");
	
	$query = "UPDATE " . $dbprefix . "entities";
	$query .= " SET subtype = " . $videolist_item_id;
	$query .= " WHERE subtype = " . $videolist_id;
	
	if($data = update_data($query)){
		echo "updated videolist objects<br />";
	}
	
	echo "done";