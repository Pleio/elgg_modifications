<?php 

	$user = elgg_get_page_owner_entity();
	$plugin = elgg_extract("entity", $vars);
	
	$noyes_options = array(
		"no" => elgg_echo("option:no"),
		"yes" => elgg_echo("option:yes")
	);
	
	if(($user->isAdmin() || (subsite_manager_on_subsite() && elgg_get_site_entity()->isAdmin($user->getGUID()))) && $user->canEdit()){
		echo "<div>";
		echo elgg_echo("elgg_modifications:usersettings:reportedcontent:notify:description");
		echo "&nbsp;" . elgg_view("input/dropdown", array("name" => "params[notify]", "options_values" => $noyes_options, "value" => $plugin->getUserSetting("notify", $user->getGUID())));
		echo "</div>";
	}