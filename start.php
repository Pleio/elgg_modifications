<?php

	require_once(dirname(__FILE__) . "/lib/functions.php");
	require_once(dirname(__FILE__) . "/lib/events.php");
	require_once(dirname(__FILE__) . "/lib/hooks.php");
	require_once(dirname(__FILE__) . "/lib/page_handlers.php");

	function elgg_modifications_init(){
		// extend css
		elgg_extend_view("css/elgg", "elgg_modifications/css/site");
		elgg_extend_view("page/elements/head", "elgg_modifications/extends/head", 400);
		elgg_extend_view("forms/uservalidationbyemail/bulk_action", "elgg_modifications/extends/uservalidationbyemail/bulk_action", 499);

		elgg_register_page_handler("accept_terms", "elgg_modifications_accept_terms_page_handler");
		elgg_register_page_handler("generate_digischool_menu", "elgg_modifications_generate_digischool_menu_page_handler");

		elgg_register_widget_type("pdokkaart", elgg_echo("widgets:pdokkaart:title"),  elgg_echo("widgets:pdokkaart:description") ,"index,groups,profile,dashboard", true);

		elgg_unregister_plugin_hook_handler("object:notifications", "object", "group_object_notifications_intercept"); // disable intercept
		elgg_unregister_plugin_hook_handler("notify:entity:message", "object", "groupforumtopic_notify_message"); // unregister default message
		elgg_unregister_plugin_hook_handler("notify:annotation:message", "group_topic_post", "discussion_create_reply_notification"); // unregister default message
		elgg_register_plugin_hook_handler("notify:entity:message", "object", "elgg_modifications_groupforumtopic_notify_message"); // register new message
		elgg_register_plugin_hook_handler("notify:annotation:message", "group_topic_post", "elgg_modifications_groupforumtopic_reply_message"); // register new message

		elgg_register_plugin_hook_handler("prepare", "menu:filter", "elgg_modifications_prepare_menu_filter_hook");

		elgg_register_plugin_hook_handler("route", "notifications", "elgg_modifications_route_notifications_hook");

		// allow tidypics widgets on group and index page
		elgg_register_widget_type('album_view', elgg_echo("tidypics:widget:albums"), elgg_echo("tidypics:widget:album_descr"), 'profile,index,groups');
		elgg_register_widget_type('latest_photos', elgg_echo("tidypics:widget:latest"), elgg_echo("tidypics:widget:latest_descr"), 'profile,index,groups');
	}

	/**
	 * Extend the registered widgets to more contexts
	 *
	 */
	function elgg_modifications_init_extend_widgets(){
		global $CONFIG;
		
		$allowed_index_widgets = array();
		
		if(isset($CONFIG->widgets) && is_array($CONFIG->widgets->handlers)){
			
			// add group context to widgets
			if(!empty($allowed_group_widgets)){
				foreach($allowed_group_widgets as $widget_handler){
					if(array_key_exists($widget_handler, $CONFIG->widgets->handlers)){
						$CONFIG->widgets->handlers[$widget_handler]->context[] = "groups";
					}
				}
			}
			
			// add index context to widgets
			if(!empty($allowed_index_widgets)){
				foreach($allowed_index_widgets as $widget_handler){
					if(array_key_exists($widget_handler, $CONFIG->widgets->handlers)){
						$CONFIG->widgets->handlers[$widget_handler]->context[] = "index";
					}
				}
			}
		}
	}
	
	function elgg_modifications_pagesetup(){
		$user = elgg_get_logged_in_user_entity();
		
		// check for terms
		if(!empty($user) && !elgg_in_context("accept_terms") && !elgg_get_site_entity()->isPublicPage()){
			// do we need to check
			if(empty($_SESSION["terms_accepted"])){
				$user_ts = $user->getPrivateSetting("general_terms_accepted");
				if(empty($user_ts)){
					$_SESSION["terms_forward_from"] = current_page_url();
					forward("accept_terms");
				} else {
					// user has accepted the terms, so don't check again
					$_SESSION["terms_accepted"] = $user_ts;
				}
			}
		}
	}
	
	// register default Elgg events
	elgg_register_event_handler("init", "system", "elgg_modifications_init");
	elgg_register_event_handler("init", "system", "elgg_modifications_init_extend_widgets", 99999);
	elgg_register_event_handler("pagesetup", "system", "elgg_modifications_pagesetup");

	// register other events
	elgg_register_event_handler("create", "user", "elgg_modifications_create_user_event_handler");
	
	// register plugin hooks
	elgg_register_plugin_hook_handler("reportedcontent:add", "system", "elgg_modifications_reportedcontent_hook");
	elgg_register_plugin_hook_handler("gatekeeper", "group", "elgg_modifications_group_gatekeeper_hook");
	elgg_register_plugin_hook_handler("widget_url", "widget_manager", "elgg_modifications_widgets_url_hook");
	
	// register actions
	elgg_register_action("accept_terms/accept", dirname(__FILE__) . "/actions/accept_terms/accept.php");
	elgg_register_action("accept_terms/deactivate", dirname(__FILE__) . "/actions/accept_terms/deactivate.php");