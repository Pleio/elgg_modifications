<?php 

	$widget = $vars["entity"];

	$map_height = sanitize_int($widget->map_height, false);
	if(!$map_height){
		$map_height = "440";
	}
	
	echo "<div>";
	echo elgg_echo("widgets:pdokkaart:edit:map_url") . ": ";
	echo elgg_view("input/text", array("name" => "params[map_url]", "value" => $widget->map_url));
	echo "</div>";	
	
	echo "<div>";
	echo elgg_echo("widgets:pdokkaart:edit:map_height") . ": ";
	echo elgg_view("input/text", array("name" => "params[map_height]", "value" => $map_height));
	echo "</div>";