<?php 
exit();
	require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php");
	
	admin_gatekeeper();
	
	$digischool_urls = array(
		"https://groep1en2.pleio.nl/",
		"https://groep3en4.pleio.nl/",
		"https://groep5en6.pleio.nl/",
		"https://groep7en8.pleio.nl/",
		"https://interbegeleiders.pleio.nl/",
		"https://pabo.pleio.nl/",
		"https://rekenen.pleio.nl/",
		"https://taal.pleio.nl/",
		"https://voorschool.pleio.nl/",
		"https://aardrijkskunde.pleio.nl/",
		"https://arabisch.pleio.nl/",
		"https://beeldonderwijs.pleio.nl/",
		"https://biologie.pleio.nl/",
		"https://ckv.pleio.nl/",
		"https://drama.pleio.nl/",
		"https://duits.pleio.nl/",
		"https://economie.pleio.nl/",
		"https://engels.pleio.nl/",
		"https://filosofie.pleio.nl/",
		"https://frans.pleio.nl/",
		"https://geschiedenis.pleio.nl/",
		"https://grafimedia.pleio.nl/",
		"https://informatica.pleio.nl/",
		"https://levensbeschouwing.pleio.nl/",
		"https://klassieketalen.pleio.nl/",
		"https://ckv2kua.pleio.nl/",
		"https://lichamelijkeopvoeding.pleio.nl/",
		"https://maatschappijleer.pleio.nl/",
		"https://natuurlevenentechnologie.pleio.nl/",
		"https://muziek.pleio.nl/",
		"https://natuurkunde.pleio.nl/",
		"https://nederlands.pleio.nl/",
		"https://praktijkonderwijs.pleio.nl/",
		"https://scheikunde.pleio.nl/",
		"https://spaans.pleio.nl/",
		"https://systeembeheer.pleio.nl/",
		"https://techniekvo.pleio.nl/",
		"https://turks.pleio.nl/",
		"https://tweetaligonderwijs.pleio.nl/",
		"https://verzorging.pleio.nl/",
		"https://wiskunde.pleio.nl/",
		"https://digitaalleermateriaal.pleio.nl/",
		"https://professionalisering.pleio.nl/",
	);
	
	$digischool_admin_usernames = array(
		"Luyben"
	);
	
	$count = 0;
	$digischool_admins = array();
	
	echo "matching usernames to users<br />";
	foreach($digischool_admin_usernames as $username){
		if($user = get_user_by_username($username)){
			$digischool_admins[] = $user;
		} else {
			echo "couldn't find " . $username . "<br />";
		}
	}
	
	echo "proccessing site urls<br />";
	
	foreach($digischool_urls as $site_url){
		echo "searching for " . $site_url . "<br />";
		
		if($subsite = get_site_by_url($site_url)){
			echo "found " . $site->name . "<br />";
			
			if(!empty($digischool_admins)){
				echo "adding admins<br />";
				
				foreach($digischool_admins as $admin){
					if(!$subsite->isUser($admin->getGUID())){
						echo "adding user to site " . $admin->name . "<br />";
						$subsite->addUser($admin->getGUID());
					}
					
					if(!$subsite->isAdmin($admin->getGUID())){
						echo "adding user as admin " . $admin->name . "<br />";
						$subsite->makeAdmin($admin->getGUID());
					}
				}
				
				echo "done with admins<br />";
			}
			
			$count++;
		}
		
		echo "done with " . $site_url . "<br />";
	}
	
	echo "found " . $count . " sites out of " . count($digischool_urls) . "<br />";
	echo "done<br />";