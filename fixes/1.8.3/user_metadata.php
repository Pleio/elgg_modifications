<?php 
exit();
	/**
	* Find users which have some metadata not on the correct site
	* 
	* metadata names:
	* - icontime
	* - x1
	* - x2
	* - y1
	* - y2
	* - validated
	* - validated_method
	* 
	*/
	require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php");
	
	set_time_limit(0);
	
	admin_gatekeeper();

	$options = array(
		"type" => "user",
		"limit" => false,
		"site_guids" => false,
		"metadata_names" => array("icontime", "x1", "x2", "y1", "y2", "validated", "validated_method"),
		'order_by'  =>  'n_table.time_created desc'
	);
	
	if($metadata = elgg_get_metadata($options)){
		echo "found: " . count($metadata) . " metadata to check<br />";
		
		$duplicates = array();
		$dubs = 0;
		$correct = 0;
		
		$dbprefix = elgg_get_config("dbprefix");
		
		foreach($metadata as $md){
			if(!isset($duplicates[$md->entity_guid])){
				$duplicates[$md->entity_guid] = array();
			}
				
			if(!in_array($md->name, $duplicates[$md->entity_guid])){
				// this metadata field has not yet been updated
				$duplicates[$md->entity_guid][] = $md->name;
				if($md->site_guid != 1){
					$query = "UPDATE " . $dbprefix . "metadata";
					$query .= " SET site_guid = 1";
					$query .= " WHERE id = " . $md->id;

					update_data($query);
				} else {
					$correct++;
				}
			} else {
				// duplicate found
				$dubs++;
				
				$md->delete();
			}
		}
		
		echo "duplicates found: " . $dubs . "<br />";
		echo "correct metadata found: " . $correct . "<br />";
	}
	
	echo "done";