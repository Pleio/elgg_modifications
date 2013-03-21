<?php
/**
 * Elgg video list widget
 *
 * @package ElggVideolist
 */

$widget = elgg_extract("entity", $vars);

$num = (int) $widget->videos_num;
if($num < 1){
	$num = 4;
}

$options = array(
	'type' => 'object',
	'subtype' => 'videolist_item',
	'container_guid' => $widget->getOwnerGUID(),
	'limit' => $num,
	'full_view' => FALSE,
	'pagination' => FALSE,
);

if ($content = elgg_list_entities($options)) {
	echo $content;
	
	$widget_owner = $widget->getOwnerEntity();
	if(elgg_instanceof($widget_owner, "group")){
		$url = "videolist/group/" . $widget_owner->getGUID() . "/all";
	} else {
		$url = "videolist/owner/" . $widget_owner->username;
	}
	
	$more_link = elgg_view('output/url', array(
		'href' => $url,
		'text' => elgg_echo('videolist_item:more'),
		'is_trusted' => true,
	));
	
	echo "<span class=\"elgg-widget-more\">$more_link</span>";
} else {
	echo elgg_echo('videolist_item:none');
}
