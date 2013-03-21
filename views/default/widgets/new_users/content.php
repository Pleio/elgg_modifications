<?php
/**
 * New users admin widget
 */
	$widget = elgg_extract("entity", $vars);
	
	$num_display = (int) $widget->num_display;
	if($num_display < 1){
		$num_display = 10;
	}
	
	echo elgg_list_entities_from_relationship(array(
		"type" => "user",
		"site_guids" => false,
		"relationship" => "member_of_site",
		"relationship_guid" => $widget->site_guid,
		"inverse_relationship" => true,
		"full_view" => FALSE
	));