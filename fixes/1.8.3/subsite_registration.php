<?php 
exit();
	/**
	 * Fix a problem with registration on subsites
	 * 
	 */

	require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php");
	
	admin_gatekeeper();
	
	$options = array(
		"type" => "site",
		"subtype" => Subsite::SUBTYPE,
		"limit" => false,
		"private_setting_name_value_pairs" => array(
			"name" => "membership",
			"value" => Subsite::MEMBERSHIP_INVITATION,
			"operand" => "<>"
		)
	);
	
	$batch = new ElggBatch("elgg_get_entities_from_private_settings", $options);
	
	foreach($batch as $subsite){
		set_config("allow_registration", true, $subsite->getGUID());
	}
	
	echo "done";