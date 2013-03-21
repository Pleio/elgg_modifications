<?php 
exit();
	/**
	 * Find groups which don't have icontime but have an icon
	 * 
	 * Legacy from Elgg 1.5
	 */

	require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php");
	
	admin_gatekeeper();

	$icontime_id = get_metastring_id("icontime");
	
	$options = array(
		"type" => "group",
		"limit" => false,
		"site_guids" => false,
		"wheres" => array("NOT EXISTS (
			SELECT 1 FROM " . elgg_get_config("dbprefix") . "metadata md
			WHERE md.entity_guid = e.guid
				AND md.name_id = $icontime_id)")
	);
	
	if($groups = elgg_get_entities($options)){
		echo "found: " . count($groups) . " groups to check<br />";
		
		foreach($groups as $group){
			$fh = new ElggFile();
			$fh->owner_guid = $group->getOwnerGUID();
			
			$fh->setFilename("groups/" . $group->getGUID() . ".jpg");
			
			if($fh->exists()){
				echo "found and icon for " . $group->name . "<br />";
				$group->icontime = time();
			}
		}
	}
	
	echo "done";