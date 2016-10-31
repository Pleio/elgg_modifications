<?php 

	$english = array(
		// Accept terms
		'elgg_modifications:accept_terms' => 'Ask user to accept general terms?',
		'elgg_modifications:accept_terms:title' => "Terms and conditions of Pleio",

		// reported content to mail
		'elgg_modifications:usersettings:reportedcontent:notify:description' => "I wish to be notified when somebody submits a report about inappropriate content",
		'elgg_modifications:usersettings:reportedcontent:notify:subject' => "A new item was reported",
		'elgg_modifications:usersettings:reportedcontent:notify:message' => "Hi,

%s reported a new item. To view the report check the link below.
%s",

		'elgg_modifications:groups:notification:create' =>
		'%s started the new discussion \'%s\' in the group %s:
%s
%s

View and reply to the discussion:
%s',
		'elgg_modifications:groups:notification:reply' =>
		'%s replied to the discussion topic \'%s\' in the group %s:
%s
%s

View and reply to the discussion:
%s',
		'elgg_modifications:groups:notification:created_by' => "Created by %s",
		
		'widgets:pdokkaart:title' => "PDOK Map",
		'widgets:pdokkaart:description' => "Share a PDOK map",
		'widgets:pdokkaart:edit:map_url' => "Enter the url of a PDOK map",
		'widgets:pdokkaart:edit:map_height' => "Enter the height of a the map (in pixels)",
		'widgets:pdokkaart:content:no_url' => "This widget is not yet configured. Please enter a PDOK map url. You can make your own map at <a href='http://pdokkaart.cdxi.nl/' target='_blank'>http://pdokkaart.cdxi.nl/</a>",
		
		// simplesaml
		'simplesaml:sources:label:entree' => "Kennisnet Entree",
		'simplesaml:sources:label:surfconext' => "SurfConext",
		'simplesaml:sources:label:digischool' => "Mijn Digischool",
	);
	
	add_translation("en", $english);