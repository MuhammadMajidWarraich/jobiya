<?php 

// Settings page form 
    function jobiya_settings_page() {
    ?>
    <div class="wrap">
        <h1>Jobiya Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('jobiya_settings'); ?>
            <?php do_settings_sections('jobiya_settings'); ?>
            <?php submit_button('Save Settings'); ?>
        </form>
    </div>
    <?php
}


// Register Admin Menu for Jobs Plugin
function jobiya_admin_menu() {
    add_menu_page('Jobiya Settings', 'Jobiya', 'manage_options', 'jobiya_settings', 'jobiya_settings_page', 'dashicons-admin-generic');
}
add_action('admin_menu', 'jobiya_admin_menu');



// Default Jobs layout Settings - on settings page
function jobiya_settings_init() {
    register_setting('jobiya_settings', 'jobiya_layout', array(
        'type' => 'string',
        'default' => 'list', // Default layout
        'sanitize_callback' => 'sanitize_text_field',
    ));

    add_settings_section('jobiya_layout_section', 'Layout Options', '__return_empty_string', 'jobiya_settings');

    add_settings_field('jobiya_layout_field', 'Default Layout', 'jobiya_layout_field', 'jobiya_settings', 'jobiya_layout_section');

        add_settings_field('jobiya_count_field', 'Default Post Count', 'jobiya_count_field', 'jobiya_settings', 'jobiya_layout_section');
}

// Jobiya Layout Field Callback Function
function jobiya_layout_field() {
    $current_layout = get_option('jobiya_layout', 'list');
    ?>
    <select name="jobiya_layout">
        <option value="list" <?php selected($current_layout, 'list'); ?>>List View</option>
        <option value="grid" <?php selected($current_layout, 'grid'); ?>>Grid View</option>
        <option value="carousel" <?php selected($current_layout, 'carousel'); ?>>Carousel View</option>
    </select>
    <?php
}

add_action('admin_init', 'jobiya_settings_init');




// Jobya jobs count field Callback
function jobiya_count_field() {
    // Get the current value from the options
    $post_count = get_option('jobiya_post_count', 5);

    // Display the input field
    ?>
    <input type="number" name="jobiya_post_count" value="<?php echo esc_attr($post_count); ?>" placeholder="Number of posts to show">    
    <?php
}

// Save the count field value
function jobiya_save_count_field() {
    if (isset($_POST['jobiya_post_count'])) {
        update_option('jobiya_post_count', intval($_POST['jobiya_post_count']));
    }
}

add_action('admin_post', 'jobiya_count_field');
add_action('admin_init', 'jobiya_save_count_field');
