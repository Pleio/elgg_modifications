<?php

/*
 * Disable receiving of site digest when registering on subsite
 */
function elgg_modifications_create_user_event_handler($event, $object_type, $object){
	if (elgg_instanceof($object, "user")) {
		if (subsite_manager_on_subsite()) {
			$object->setPrivateSetting("digest_" . elgg_get_site_entity()->getOwnerGUID(), "none");
		}
	}
}