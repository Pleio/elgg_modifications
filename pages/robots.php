<?php
header("Content-type: text/plain");
$url = elgg_get_site_url();

echo "User-agent: *" . PHP_EOL;

$indexingEnabled = elgg_get_config("enable_frontpage_indexing");
if(subsite_manager_on_subsite() && !$indexingEnabled) {
    echo "Disallow: /" . PHP_EOL;
} else {
    echo "Sitemap: " . $url . "sitemap.xml" . PHP_EOL;
    echo "Disallow: /profile/" . PHP_EOL;
    echo "Disallow: /search/" . PHP_EOL;
    echo "Disallow: /search" . PHP_EOL;
    echo "Disallow: /tags/" . PHP_EOL;
    echo "Disallow: /tags" . PHP_EOL;
}
