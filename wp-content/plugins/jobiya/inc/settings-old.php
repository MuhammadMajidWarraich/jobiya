<?php
// Settings page HTML
function jobiya_settings_page_thml(){
	if (!is_admin()) {
		return;
	}
	?>
		<div class="wrap">
			<h1 style="background-color: #000; color: #fff; text-align: center;"><?php echo esc_html(get_admin_page_title()); ?></h1>
			<form action="options.php" method="post">
				<?php 
					settings_fields('jobiya-settings');  
					do_settings_sections('jobiya-settings');
					submit_button('Save Changes');
				?>
			</form>
		</div>
	<?php
}

// Register admin menu for plugin
function jobiya_register_menu_page(){
	add_menu_page('Jobiya (Job Board System)', 'Jobiya Settings', 'manage_options', 'jobiya-settings', 'jobiya_settings_page_thml', 'dashicons-menu', 30);
}
add_action('admin_menu', 'jobiya_register_menu_page');


// Add/register setings, sections, and fields
function jobiya_plugin_settings(){
	// Register settings
	register_setting('jobiya-settings', 'jobiya_like_btn_lable');
	register_setting('jobiya-settings', 'jobiya_dislike_btn_lable');

	// Register sections
	add_settings_section('jobiya_label_settings', 'Like DisLike Buttons Labels Section', 'jobiya_plugin_settings_section_cb', 'jobiya-settings');
	
	// Register Fields
	add_settings_field('jobiya_like_lable_field', 'Like Button Label', 'jobiya_like_lable_field_cb', 'jobiya-settings', 'jobiya_label_settings');

	add_settings_field('jobiya_dislike_lable_field', 'DisLike Button Label', 'jobiya_dislike_lable_field_cb', 'jobiya-settings', 'jobiya_label_settings');

	//add_settings_field('jobiya_count_lable_field', 'Like Button Count', 'jobiya_like_lable_field_cb', 'jobiya-settings', 'jobiya_label_settings');


}
add_action('admin_init', 'jobiya_plugin_settings');


// Callback function for section
function jobiya_plugin_settings_section_cb(){
	// Output goes here
}

// Callback function for Like Btn field
function jobiya_like_lable_field_cb(){
	$Settings = get_option('jobiya_like_btn_lable');
	?>
	<input type="text" name="jobiya_like_btn_lable" value="<?php echo isset($Settings) ? esc_attr($Settings) : ''; ?>">
	<?php
}

// Callback function for dislike btn field
function jobiya_dislike_lable_field_cb(){
	$Settings = get_option('jobiya_dislike_btn_lable');
	?>
	<input type="text" name="jobiya_dislike_btn_lable" value="<?php echo isset($Settings) ? esc_attr($Settings) : ''; ?>">
	<?php
}




