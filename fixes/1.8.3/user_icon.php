<?php 
exit();
	/**
	* Find users which don't have icontime but have an icon
	*/
	require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php");
	
	set_time_limit(0);
	
	admin_gatekeeper();

	$icontime_id = get_metastring_id("icontime");
	
	$options = array(
		"type" => "user",
		"limit" => false,
		"site_guids" => false,
		"wheres" => array("NOT EXISTS (
			SELECT 1 FROM " . elgg_get_config("dbprefix") . "metadata md
			WHERE md.entity_guid = e.guid
				AND md.name_id = $icontime_id)")
	);
	
	if($users = elgg_get_entities($options)){
		echo "found: " . count($users) . " users to check<br />";
		
		foreach($users as $user){
			$fh = new ElggFile();
			$fh->owner_guid = $user->getGUID();
			
			$fh->setFilename("profile/" . $user->getGUID() . "master.jpg");
			
			if($fh->exists()){
				echo "found and icon for " . $user->name . "<br />";
				$user->icontime = time();
			}
		}
	}
	
	echo "done";