<?php

$plugin = elgg_extract("entity", $vars);

$noyes_options = array(
    "no" => elgg_echo("option:no"),
    "yes" => elgg_echo("option:yes")
);

echo "<div>";
    echo elgg_echo("elgg_modifications:accept_terms");
    echo elgg_view("input/dropdown", array(
        "name" => "params[accept_terms]",
        "options_values" => $noyes_options,
        "value" => $plugin->accept_terms ? $plugin->accept_terms : "yes"
    ));
echo "</div>";
