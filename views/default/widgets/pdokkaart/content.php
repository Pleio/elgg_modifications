<?php 

$widget = $vars["entity"];

$map_height = sanitize_int($widget->map_height, false);

if(!$map_height){
	$map_height = "440";
}

if($map_url = $widget->map_url){
	echo "<object width='100%' height='" . $map_height . "px' codetype='text/html' data='" . $map_url . "' title='PDOK Kaart'></object>"; 
} else {
	echo elgg_echo("widgets:pdokkaart:content:no_url");
}