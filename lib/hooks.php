<?php

	function elgg_modifications_reportedcontent_hook($hook, $type, $return_value, $params){
		
		if(!empty($params) && is_array($params)){
			$report = elgg_extract("report", $params);
			$site = elgg_get_site_entity();
				
			if(!subsite_manager_check_global_plugin_setting("reportedcontent", "use_global_usersettings")){
				$setting = ELGG_PLUGIN_USER_SETTING_PREFIX . "reportedcontent:" . $site->getGUID() . ":notify";
			} else {
				$setting = ELGG_PLUGIN_USER_SETTING_PREFIX . "reportedcontent:notify";
			}
			
			// get users with setting
			$options = array(
				"type" => "user",
				"limit" => false,
				"site_guids" => false,
				"private_setting_name" => $setting,
				"private_setting_value" => "yes",
				
			);
			
			if($users = elgg_get_entities_from_private_settings($options)){
				$filtered_users = array();
		
				if(elgg_instanceof($site, "site", Subsite::SUBTYPE, "Subsite")){
					foreach($users as $user){
						if(($user->getGUID() != $report->getOwner()) && ($user->isAdmin() || $site->isAdmin($user->getGUID()))){
							$filtered_users[] = $user;
						}
					}
				} else {
					foreach($users as $user){
						if(($user->getGUID() != $report->getOwner()) && $user->isAdmin()){
							$filtered_users[] = $user;
						}
					}
				}
		
				if(!empty($filtered_users)){
					$subject = elgg_echo("elgg_modifications:usersettings:reportedcontent:notify:subject");
					$message = elgg_echo("elgg_modifications:usersettings:reportedcontent:notify:message", array(
											$report->getOwnerEntity()->name,
											$site->url . "admin/administer_utilities/reportedcontent"));
						
					foreach($filtered_users as $user){
						notify_user($user->getGUID(), $report->getOwner(), $subject, $message);
					}
				}
			}
		}
	}
	
	function elgg_modifications_group_gatekeeper_hook($hook, $type, $return_value, $params){
		$result = $return_value;
		// @todo needs a fresh look after 1.8.14
		
		if(!empty($params) && is_array($params)){
			$group = elgg_extract("group", $params);
			
			if(!empty($group) && elgg_instanceof($group, "group", null, "ElggGroup")){
				
				// allow acces to group pages if this is set in the group
				if(!$result && !$group->isPublicMembership() && ($group->profile_widgets == "yes")){
					$result = true;
				}
				
				// if not logged set last_forward_from to be redirected to the group is you login
				if(!elgg_is_logged_in() && empty($_SESSION["last_forward_from"])){
					$_SESSION["last_forward_from"] = current_page_url();
				}
			}
		}
		
		return $result;
	}
		
	function elgg_modifications_widgets_url_hook($hook, $type, $return_value, $params){
		$result = $return_value;
		
		if(empty($result) && !empty($params) && is_array($params)){
			$widget = elgg_extract("entity", $params);
			$widget_owner = $widget->getOwnerEntity();
			
			switch($widget->handler){
				case "videolist":
					if(elgg_instanceof($widget_owner, "group")){
						$result = "videolist/group/" . $widget_owner->getGUID() . "/all";
					} else {
						$result = "videolist/owner/" . $widget_owner->username;
					}
					
					break;
			}
		}
		
		return $result;
	}
	
	/**
	* Returns a more meaningful message
	*
	* @param string $hook
	* @param string $entity_type
	* @param null | string $returnvalue
	* @param array $params
	*/
	function elgg_modifications_groupforumtopic_notify_message($hook, $entity_type, $returnvalue, $params) {
		
		if (!empty($params) && is_array($params)) {
			// discussion create
			$entity = elgg_extract("entity", $params);
		
			if (!empty($entity) && elgg_instanceof($entity, "object", "groupforumtopic")) {
				$owner = $entity->getOwnerEntity();
				$group = $entity->getContainerEntity();
		
				$tags = "";
				if ($entity_tags = $entity->tags) {
					if (!is_array($entity_tags)) {
						$entity_tags = array($entity_tags);
					}
		
					$tags = elgg_echo("tags") . ": " . implode(", ", $entity_tags) . PHP_EOL;
				}
				
				// discussion create
				return elgg_echo("elgg_modifications:groups:notification:create", array(
					$owner->name,
					$entity->title,
					$group->name,
					$tags,
					elgg_get_excerpt($entity->description),
					$entity->getURL()
				));
			}
		}
		
		return null;
	}
	
	/**
	 * Returns a more meaningful message
	 *
	 * @param string $hook
	 * @param string $entity_type
	 * @param null | string $returnvalue
	 * @param array $params
	 */
	function elgg_modifications_groupforumtopic_reply_message($hook, $entity_type, $returnvalue, $params) {
		
		if (!empty($params) && is_array($params)) {
			$annotation = elgg_extract("annotation", $params);
			
			// get some related entities
			$entity = $annotation->getEntity();
			$owner = $entity->getOwnerEntity();
			$group = $entity->getContainerEntity();
			
			// prepare different message parts
			$tags = "";
			if ($entity_tags = $entity->tags) {
				if (!is_array($entity_tags)) {
					$entity_tags = array($entity_tags);
				}
			
				$tags = elgg_echo("tags") . ": " . implode(", ", $entity_tags) . PHP_EOL;
			}
			
			$subtitle = elgg_echo("elgg_modifications:groups:notification:created_by", array($owner->name));
			
			if ($count = $entity->countAnnotations("group_topic_post")) {
				$subtitle .= " - " . elgg_echo("comments:count", array($count));
			}
			
			$subtitle .= PHP_EOL;
			$subtitle .= $tags;
			
			return elgg_echo("elgg_modifications:groups:notification:reply", array(
				elgg_get_logged_in_user_entity()->name,
				$entity->title,
				$group->name,
				$subtitle,
				elgg_get_excerpt($annotation->value),
				$entity->getURL()
			));
		}
		
		return null;
	}
	
	function elgg_modifications_prepare_menu_filter_hook($hook, $entity_type, $returnvalue, $params){
		$result = $returnvalue;
	
		if (elgg_in_context("activity") && !empty($result) && is_array($result)) {
			$postfix = array();
			
			if ($type = get_input("type")) {
				$postfix["type"] = $type;
			}
			
			if ($subtype = get_input("subtype")) {
				$postfix["subtype"] = $subtype;
			}
			
			if (!empty($postfix)) {
				// go through all the menu sections
				foreach ($result as $section => $menu_items) {
					
					if (!empty($menu_items) && is_array($menu_items)) {
						// go through all the menu items
						foreach ($menu_items as $idex => $menu_item) {
							// add filter elements to the URL
							$menu_item->setHref(elgg_http_add_url_query_elements($menu_item->getHref(), $postfix));
						}
					}
				}
			}
		}
	
		return $result;
	}
	