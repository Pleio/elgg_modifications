<?php 
/**
 * Bundled view of the user and group notification settings
 */

$user = elgg_get_page_owner_entity();
if (empty($user) || !elgg_instanceof($user, "user") || !$user->canEdit()) {
	forward(REFERER);
}

// Set the context to settings
elgg_set_context("settings");

$title = elgg_echo("notifications:subscriptions:changesettings");

elgg_push_breadcrumb(elgg_echo("settings"), "settings/user/$user->username");
elgg_push_breadcrumb($title);

// Get the (personal) form
$people = elgg_get_entities_from_relationship(array(
	"relationship" => "notify",
	"relationship_guid" => $user->guid,
	"type" => "user",
	"limit" => false,
	"callback" => "elgg_modifications_row_to_guid"
));

$body = elgg_view("notifications/subscriptions/form", array(
	"people" => $people,
	"user" => $user,
));

// get the (group) form
$groupmemberships = elgg_get_entities_from_relationship(array(
	"relationship" => "member",
	"relationship_guid" => $user->guid,
	"type" => "group",
	"limit" => false,
));

$group_form = elgg_view_form("notificationsettings/groupsave", array(), array(
	"groups" => $groupmemberships,
	"user" => $user,
));

$body .= elgg_view_module("info", elgg_echo("notifications:subscriptions:changesettings:groups"), $group_form, array("id" => "group"));

$params = array(
	"content" => $body,
	"title" => $title,
);

$body = elgg_view_layout("one_sidebar", $params);

echo elgg_view_page($title, $body);