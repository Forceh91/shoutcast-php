<?php
// get the config file
$configJSON = file_get_contents('config.json');
if (!$configJSON) {
	return;
}

// decode the json into an object we can use
$config = json_decode($configJSON);
if (!$config) {
	return;
}

// set the settings variable (and replace http in the shoutcast url)
$settings = $config->settings;
$settings->shoutcast_url = str_replace("http://", "", $settings->shoutcast_url);
?>
