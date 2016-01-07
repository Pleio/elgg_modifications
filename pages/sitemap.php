<?php
if(subsite_manager_on_subsite() && !$indexingEnabled) {
    http_response_code(404);
    exit();
}

header('Content-type: text/xml');

$base = elgg_get_site_url();
$xml = new SimpleXMLElement(
    '<?xml version="1.0" encoding="UTF-8" ?>' . PHP_EOL .
    '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />'
);

// Start page
$url = $xml->addChild('url');
$url->addChild('loc', $base);
$url->addChild('lastmod', date("Y-m-d", time()));
$url->addChild('priority', '0.5');

// Widget manager, extra pages
$extra_contexts = elgg_get_plugin_setting("extra_contexts", "widget_manager");
if ($extra_contexts) {
    $contexts = string_to_tag_array($extra_contexts);
    foreach ($contexts as $context) {
        $url = $xml->addChild('url');
        $url->addChild('loc', $base . $context);
        $url->addChild('lastmod', date("Y-m-d", time()));
        $url->addChild('priority', '0.5');
    }
}

// Entity pages of blogs and static pages
$batch = new ElggBatch('elgg_get_entities', array(
    'type' => 'object',
    'subtypes' => array('blog', 'static', 'page_top', 'page'),
    'limit' => 2000
));

foreach ($batch as $object) {
    $url = $xml->addChild('url');
    $url->addChild('loc', $object->getURL());
    $url->addChild('lastmod', date("Y-m-d", $object->time_updated));
    $url->addChild('priority', '0.5');
}

echo $xml->asXML();
?>
