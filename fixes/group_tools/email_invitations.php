<?php 
/**
 * Cleanup of the old group_tools invitations
 */
exit();
require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php");

admin_gatekeeper();

set_time_limit(0);

$options = array(
	"annotation_name" => "email_invitation",
	"limit" => false,
	"site_guids" => false,
	"joins" => array("JOIN " . elgg_get_config("dbprefix") . "metastrings mv ON n_table.value_id = mv.id"),
	"wheres" => array("(mv.string NOT LIKE '%|%')")
);

echo "Starting<br />";

elgg_delete_annotations($options);

echo "Done";
