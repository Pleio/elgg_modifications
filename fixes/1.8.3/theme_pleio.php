<?php 
exit();
	/**
	 * Find which sites have theme_pleio enabled, this should be pleio_template_selector
	 * 
	 */

	require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php");
	
	admin_gatekeeper();
	
	$dbprefix = elgg_get_config("dbprefix");
	
	$query = "SELECT guid_one, guid_two";
	$query .= " FROM " . $dbprefix . "entity_relationships r";
	$query .= " JOIN " . $dbprefix . "objects_entity oe ON r.guid_one = oe.guid";
	$query .= " WHERE oe.title = 'theme_pleio'";
	$query .= " AND r.relationship = 'active_plugin'";
	$query .= " AND guid_two <> 1";
	
	if($data = get_data($query)){
		echo "found " . count($data) . " subsites with theme_pleio enabled<br />";
		
		$options = array(
			"type" => "object",
			"subtype" => "plugin",
			"limit" => 1,
			"joins" => array("JOIN " . $dbprefix . "objects_entity oe ON e.guid = oe.guid"),
			"wheres" => array("(oe.title = 'pleio_template_selector')")
		);
		
		foreach($data as $row){
			$subsite = elgg_get_site_entity($row->guid_two);
			
			if(elgg_instanceof($subsite, "site", Subsite::SUBTYPE, "Subsite")){
				$options["site_guids"] = array($subsite->getGUID());
				
				if($plugins = elgg_get_entities($options)){
					$plugin = $plugins[0];
					
					// switch enabled template
					remove_entity_relationship($row->guid_one, "active_plugin", $row->guid_two);
					
					add_entity_relationship($plugin->getGUID(), "active_plugin", $row->guid_two);
					
					echo "changed: " . $subsite->name . "<br />";
				}
			}
		}
	}
	
	echo "done";