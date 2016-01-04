<?php

	function elgg_modifications_accept_terms_page_handler($page){

		switch($page[0]){
			case "deactivate":
				set_input("accept_terms_deactivate", true);
				break;
		}

		include(dirname(dirname(__FILE__)) . "/pages/accept_terms.php");
		return true;
	}

	function elgg_modifications_sitemap_page_handler($page) {
		include(dirname(__FILE__) . "/../pages/sitemap.php");
		return true;
	}

	function elgg_modifications_robots_page_handler($page) {
		include(dirname(__FILE__) . "/../pages/robots.php");
		return true;
	}

	function elgg_modifications_generate_digischool_menu_page_handler($page){
		admin_gatekeeper();
		if(elgg_is_active_plugin("menu_builder")){
			// remove current menu items
			$current_options = array(
				"type" => "object",
				"subtype" => "menu_builder_menu_item",
				"limit" => false
			);

			if($current_items = elgg_get_entities($current_options)){
				foreach($current_items as $current_item){
					$current_item->delete();
				}
			}
// 			var_dump($current_items);
// 			exit();


			// add the new ones
			$site = elgg_get_site_entity();
			$site_acl = $site->getACL();

			$menu_items = array(
				array(
					"title" => "Voorpagina",
					"url" => "[wwwroot]",
					"access_id" => ACCESS_PUBLIC,
					"children" => array(
						array(
							"title" => "Alle blogs",
							"url" => "[wwwroot]blog/all",
							"access_id" => ACCESS_PUBLIC
						),
						array(
							"title" => "Alle activiteiten",
							"url" => "[wwwroot]activity",
							"access_id" => ACCESS_LOGGED_IN
						)
					)
				),
				array(
					"title" => "Statische pagina's",
					"url" => "[wwwroot]lidworden",
					"access_id" => ACCESS_LOGGED_IN
				),
				array(
					"title" => "Archief",
					"url" => "Zelf in te vullen",
					"access_id" => ACCESS_PUBLIC
				),

				array(
					"title" => "Leermiddelen",
					"url" => "#",
					"access_id" => ACCESS_PUBLIC,
					"children" => array(
						array(
							"title" => "Vakpagina",
							"url" => "hier de link naar uw vakp",
							"access_id" => ACCESS_PUBLIC
						),
						array(
							"title" => "Leermiddelenbank Digischool",
							"url" => "[wwwroot]",
							"access_id" => ACCESS_PUBLIC
						),
						array(
							"title" => "Leden keurmerkgroepen",
							"url" => "zelf te vullen",
							"access_id" => ACCESS_PUBLIC
						)
					)
				),
				array(
					"title" => "Leden",
					"url" => "#",
					"access_id" => ACCESS_LOGGED_IN,
					"children" => array(
						array(
							"title" => "Mijn groepen",
							"url" => "[wwwroot]groups/member/[username]",
							"access_id" => $site_acl
						),
						array(
							"title" => "Mijn profielpagina",
							"url" => "[wwwroot]profile/[username]",
							"access_id" => $site_acl
						),
						array(
							"title" => "Alle groepen",
							"url" => "[wwwroot]groups/all/?filter=pop",
							"access_id" => $site_acl
						),
						array(
							"title" => "Lid worden",
							"url" => "[wwwroot]lidworden",
							"access_id" => ACCESS_PUBLIC
						),
						array(
							"title" => "Content toevoegen",
							"url" => "[wwwroot]add",
							"access_id" => $site_acl
						),
						array(
							"title" => "Mijn dashboard",
							"url" => "[wwwroot]dashboard",
							"access_id" => $site_acl
						),
						array(
							"title" => "Zoeken leden",
							"url" => "[wwwroot]members",
							"access_id" => $site_acl
						),
						array(
							"title" => "Mijn contacten",
							"url" => "[wwwroot]friends/[username]",
							"access_id" => $site_acl
						),
						array(
							"title" => "Contactverzoeken",
							"url" => "[wwwroot]friend_request/",
							"access_id" => $site_acl
						),
						array(
							"title" => "Mijn instellingen",
							"url" => "[wwwroot]settings",
							"access_id" => $site_acl
						),
						array(
							"title" => "Nieuwe groep maken",
							"url" => "[wwwroot]groups/add",
							"access_id" => $site_acl
						)
					)
				),
				array(
					"title" => "Beheer",
					"url" => "[wwwroot]admin",
					"access_id" => ACCESS_PRIVATE,
					"children" => array(
						array(
							"title" => "Gebruikersbeheer",
							"url" => "[wwwroot]admin/users/newest",
							"access_id" => ACCESS_PRIVATE
						),
						array(
							"title" => "Nodig leden uit",
							"url" => "[wwwroot]admin/users/invite",
							"access_id" => ACCESS_PRIVATE
						),
						array(
							"title" => "Pluginbeheer",
							"url" => "[wwwroot]admin/plugins",
							"access_id" => ACCESS_PRIVATE
						),
						array(
							"title" => "Beheer template",
							"url" => "[wwwroot]admin/appearance/template",
							"access_id" => ACCESS_PRIVATE
						)
					)
				)
			);
			$i = 0;
			foreach($menu_items as $main_item){
				$item = new ElggObject();
				$item->subtype = "menu_builder_menu_item";
				$item->owner_guid = $site->getGUID();
				$item->container_guid = $site->getGUID();
				$item->site_guid = $site->getGUID();

				$item->access_id = $main_item["access_id"];
				$item->parent_guid = 0;
				$item->title = $main_item["title"];
				$item->url = $main_item["url"];
				$item->order = $i;
				$i++;

				$item->save();

				if(array_key_exists("children", $main_item)){
					foreach($main_item["children"] as $sub_item){
						$submenu_item = new ElggObject();
						$submenu_item->subtype = "menu_builder_menu_item";
						$submenu_item->owner_guid = $site->getGUID();
						$submenu_item->container_guid = $site->getGUID();
						$submenu_item->site_guid = $site->getGUID();
						$submenu_item->access_id = $sub_item["access_id"];

						$submenu_item->parent_guid = $item->getGUID();
						$submenu_item->title = $sub_item["title"];
						$submenu_item->url = $sub_item["url"];
						$submenu_item->order = $i;
						$i++;
						$submenu_item->save();
					}
				}
			}

			system_message("menu created");

		} else {
			register_error("plugin menu_builder not activated");
		}
		forward();
	}
