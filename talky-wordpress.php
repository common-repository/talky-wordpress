<?php
/*
Plugin Name: Talky WordPress
Plugin URI: http://www.reflectionmedia.ro/2009/06/new-plugin-talky-wordpress/
Description: WordPress talky events.
Version: 1.0
Author: Reflection Media
Author URI: http://www.reflectionmedia.ro/
*/

/*
	Copyright 2008  Reflection Media  (email : gabriel@reflectionmedia.ro)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (get_option('talky-volume') == '') update_option('talky-volume', '50');
if (get_option('talky-theme') == '') update_option('talky-theme', 'diana');

function add_sound($file_name, $get_variable, $get_value, $sound_name) {
	$file = $_SERVER['SCRIPT_NAME'];
	$break = Explode('/', $file);
	$pfile = $break[count($break) - 1];

	if($pfile==$file_name && $_GET[$get_variable]==$get_value){
//		wp_enqueue_script('soundscript', WP_PLUGIN_URL.'/talky-wordpress/soundmanager2.js');
		wp_enqueue_script('soundscript', WP_PLUGIN_URL.'/talky-wordpress/soundmanager2-nodebug-jsmin.js');
		wp_enqueue_script('pluginurl', WP_PLUGIN_URL.'/talky-wordpress/talky-js-init.php');
		wp_enqueue_script('sound', WP_PLUGIN_URL.'/talky-wordpress/sounds/'.$sound_name);
	}
}

add_sound('plugins.php', 'activate', 'true', 'plugin-activated.js');
add_sound('plugins.php', 'deactivate', 'true', 'plugin-deactivated.js');

add_sound('post.php', 'message', '6', 'post-published.js');
add_sound('edit.php', 'deleted', '1', 'post-deleted.js');
add_sound('page.php', 'message', '5', 'page-published.js');
add_sound('edit-pages.php', 'deleted', '1', 'page-deleted.js');

add_sound('themes.php', 'activated', 'true', 'theme-activated.js');

include 'talky-admin-menu.php';

/*
ADDING NEW SOUND THEMES:

Simply duplicate an existing sound theme directory (you can find those in talky-wordpress/sounds/).
Let's say you name it 'my-theme'.
You have to use the exact same filenames for the mp3 files inside it.
After this you can replace the old mp3 files with new ones.
Then go edit talky-admin-menu.php (it's in the talky-wordpress folder).
Go to line 16 and add your new directory name, like just like the other ones are added.

ADDING NEW SOUND EVENTS:

Create a new mp3 file and name it whatever you want to.
Let's call it 'my-new-event.mp3'.
Then go to the talky-wordpress/sounds/ directory and duplicate an existing js file. They are all quite similar.
All that differs is the name of the mp3 file inside it. The js file takes the mp3 and plays it.
It's neatest if you name your new js file just like the mp3 file. For example 'my-new-event.js'.
Remember to edit your js file so that it plays the mp3 you want.

Then all you need to do is call the function to hook your new js file to your event.
For this you will use the add_sound() function.
I will explain it using an example:

When a new wordpress theme is activated, you will get the following URL:
.../wp-admin/themes.php?activated=true

So in oreder to add a sound event for it, you have to specify:
- the file name where you want to play it: 'themes.php'
- the GET variable you want to trigger it: 'activated'
- the value of the variable: 'true'
- and, finally, the name of the js file that plays the sound: 'theme-activated.js'

*/
?>