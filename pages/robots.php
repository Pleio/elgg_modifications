<?php
header("Content-type: text/plain");
$url = elgg_get_site_url();
?>
User-agent: *
Sitemap: <?php echo $url; ?>sitemap.xml
Disallow: /profile/
Disallow: /search/
Disallow: /search
Disallow: /tags/
Disallow: /tags
