soundManager.onload = function() {
	var sound = soundManager.createSound({ id: 'sound', url: plugin_url+'/talky-wordpress/sounds/'+dir+'/page-deleted.mp3', volume: vol });
	sound.play();
}