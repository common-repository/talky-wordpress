soundManager.onload = function() {
	var sound = soundManager.createSound({ id: 'sound', url: plugin_url+'/talky-wordpress/sounds/'+dir+'/theme-activated.mp3', volume: vol });
	sound.play();
}