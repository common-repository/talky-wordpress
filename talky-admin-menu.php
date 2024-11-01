<?php
add_action('admin_menu', 'talky_plugin_menu');

function talky_plugin_menu() {
	add_submenu_page( 'options-general.php', 'Talky WordPress Options', 'Talky WordPress', 8, __FILE__, 'talky_plugin_options');
}

function talky_plugin_options() {
	$volume = get_option('talky-volume');
	$theme = get_option('talky-theme');
	
	$dirs = array();
	array_push($dirs, 'diana', 'the-russian', 'knoppix');
	
	if ($_POST['options-submit']){
		$volume = $_POST['volume'];
		update_option('talky-volume', $volume);

		$theme = $_POST['theme'];
		update_option('talky-theme', $theme);
		
		?>
			<div class="updated"><p>Your new options have been successfully saved.</p></div>
		<?php
	}
	
	
	?>
		<div class="wrap">
			<div id="icon-options-general" class="icon32"></div>
			<h2>Talky WordPress Options</h2>
			<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);?>">
				<table class="form-table">
					<tr>
						<td width="100">Volume:</td>
						<td>
							<select name="volume">
								<?php
									for($i=0;$i<=100;$i=$i+1){
										if($i==$volume) $sel='selected="selected"';
										else $sel='';
										echo '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Sound Theme:</td>
						<td>
							<select name="theme">
								<?php
									foreach ($dirs as $dir) {
										if($dir==$theme) $sel='selected="selected"';
										else $sel='';
										echo '<option value="'.$dir.'" '.$sel.'>'.$dir.'</option>';
									}
								?>
							</select>
						</td>
					</tr>
				</table>
				<input type="hidden" name="options-submit" value="1" />
				<p class="submit"><input type="submit" name="submit" value="Save Options" /></p>
			</form>
		</div>
	<?php
}
?>