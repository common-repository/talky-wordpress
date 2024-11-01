<?php

require '../../../wp-config.php';

if (get_option('talky-volume') == '') update_option('talky-volume', '50');
if (get_option('talky-theme') == '') update_option('talky-theme', 'default');

$vol = get_option('talky-volume');
$dir = get_option('talky-theme');

echo 'var plugin_url="'.WP_PLUGIN_URL.'";';
echo 'var dir="'.$dir.'";';
echo 'var vol="'.$vol.'";';

echo 'soundManager.url = plugin_url+"/talky-wordpress/soundmanager2.swf";';
echo 'soundManager.debugMode = false;';

?>