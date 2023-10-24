<?php

class JobiyaPlugin {
      function __construct() {

        add_action('init', array($this, 'create_job_cpt'), 10);
        add_action('init', array($this, 'create_department_tax'), 10);
        add_action('init', array($this, 'create_job_type_tax'), 10);
        add_action('init', array($this, 'create_shift_tax'), 10);
        add_action('init', array($this, 'create_location_tax'), 10);
    }

    

    public function activate() {
        // Generated a CPT
        // Flush rewrite rules
        flush_rewrite_rules(); 
    }

    public function deactivate() {
        // Add deactivation logic here
    }

    public static function uninstall() {
        // Add uninstall logic here
    }

    // Register CPT Job using OOP , its being hooked in above constructor


// Register Custom Post Type Job
function create_job_cpt() {
    $labels = array(
        'name' => _x('Jobs', 'Post Type General Name', 'textdomain'),
        'singular_name' => _x('Job', 'Post Type Singular Name', 'textdomain'),
        'menu_name' => _x('Jobs', 'Admin Menu text', 'textdomain'),
        'name_admin_bar' => _x('Job', 'Add New on Toolbar', 'textdomain'),
        'attributes' => __('Job Attributes', 'textdomain'),
        'parent_item_colon' => __('Parent Job:', 'textdomain'),
        'all_items' => __('All Jobs', 'textdomain'),
        'add_new_item' => __('Add New Job', 'textdomain'),
        'add_new' => __('Add New', 'textdomain'),
        'new_item' => __('New Job', 'textdomain'),
        'edit_item' => __('Edit Job', 'textdomain'),
        'update_item' => __('Update Job', 'textdomain'),
        'view_item' => __('View Job', 'textdomain'),
        'view_items' => __('View Jobs', 'textdomain'),
        'search_items' => __('Search Job', 'textdomain'),
        'not_found' => __('Not found', 'textdomain'),
        'not_found_in_trash' => __('Not found in Trash', 'textdomain'),
        'featured_image' => __('Featured Image', 'textdomain'),
        'set_featured_image' => __('Set featured image', 'textdomain'),
        'remove_featured_image' => __('Remove featured image', 'textdomain'),
        'use_featured_image' => __('Use as featured image', 'textdomain'),
        'insert_into_item' => __('Insert into Job', 'textdomain'),
        'uploaded_to_this_item' => __('Uploaded to this Job', 'textdomain'),
        'items_list' => __('Jobs list', 'textdomain'),
        'items_list_navigation' => __('Jobs list navigation', 'textdomain'),
        'filter_items_list' => __('Filter Jobs list', 'textdomain'),
    );

    $args = array(
        'label' => __('Job', 'textdomain'),
        'description' => __('', 'textdomain'),
        'labels' => $labels,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'author', 'comments', 'trackbacks', 'page-attributes', 'post-formats', 'custom-fields'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'exclude_from_search' => false,
        'show_in_rest' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('jobs', $args);
}
//add_action('init', 'create_job_cpt', 0);


// Register Custom Taxonomy Departments
function create_department_tax() {
    $labels = array(
        'name' => _x('Departments', 'taxonomy general name', 'textdomain'),
        'singular_name' => _x('Department', 'taxonomy singular name', 'textdomain'),
        'search_items' => __('Search Departments', 'textdomain'),
        'all_items' => __('All Departments', 'textdomain'),
        'parent_item' => __('Parent Department', 'textdomain'),
        'parent_item_colon' => __('Parent Department:', 'textdomain'),
        'edit_item' => __('Edit Department', 'textdomain'),
        'update_item' => __('Update Department', 'textdomain'),
        'add_new_item' => __('Add New Department', 'textdomain'),
        'new_item_name' => __('New Department Name', 'textdomain'),
        'menu_name' => __('Departments', 'textdomain'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_quick_edit' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'departments'), // Add the rewrite parameter
    );

    register_taxonomy('departments', 'jobs', $args);
}
//add_action('init', 'create_department_cpt', 0);

// Register Custom Taxonomy Shifts
function create_shift_tax() {
    $labels = array(
        'name' => _x('Shifts', 'taxonomy general name', 'textdomain'),
        'singular_name' => _x('Shift', 'taxonomy singular name', 'textdomain'),
        'search_items' => __('Search Shifts', 'textdomain'),
        'all_items' => __('All Shifts', 'textdomain'),
        'parent_item' => __('Parent Shift', 'textdomain'),
        'parent_item_colon' => __('Parent Shift:', 'textdomain'),
        'edit_item' => __('Edit Shift', 'textdomain'),
        'update_item' => __('Update Shift', 'textdomain'),
        'add_new_item' => __('Add New Shift', 'textdomain'),
        'new_item_name' => __('New Shift Name', 'textdomain'),
        'menu_name' => __('Shifts', 'textdomain'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_quick_edit' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'shifts'), // Add the rewrite parameter
    );

    register_taxonomy('shifts', 'jobs', $args);
}
//add_action('init', 'create_shift_tax', 0);


// Register Custom Taxonomy Job Types Under Jobs CPT
function create_job_type_tax() {
    $labels = array(
        'name' => _x('Types', 'taxonomy general name'),
        'singular_name' => _x('Type', 'taxonomy singular name'),
        'search_items' => __('Search Types'),
        'all_items' => __('All Types'),
        'parent_item' => __('Parent Type'),
        'parent_item_colon' => __('Parent Type:'),
        'edit_item' => __('Edit Type'),
        'update_item' => __('Update Type'),
        'add_new_item' => __('Add New Type'),
        'new_item_name' => __('New Type Name'),
        'menu_name' => __('Job Types'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'type'),
    );

    register_taxonomy('types', 'jobs', $args);
}

//add_action('init', 'custom_taxonomy_type', 0);



// Register Custom Taxonomy Locations Under Jobs CPT
function create_location_tax() {
    $labels = array(
        'name' => _x('Locations', 'taxonomy general name', 'textdomain'),
        'singular_name' => _x('Location', 'taxonomy singular name', 'textdomain'),
        'search_items' => __('Search Locations', 'textdomain'),
        'all_items' => __('All Locations', 'textdomain'),
        'parent_item' => __('Parent Location', 'textdomain'),
        'parent_item_colon' => __('Parent Location:', 'textdomain'),
        'edit_item' => __('Edit Location', 'textdomain'),
        'update_item' => __('Update Location', 'textdomain'),
        'add_new_item' => __('Add New Location', 'textdomain'),
        'new_item_name' => __('New Locations Name', 'textdomain'),
        'menu_name' => __('Locations', 'textdomain'),
    );
    $args = array(
        'labels' => $labels,
        'description' => __('', 'textdomain'),
        'hierarchical' => true,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_quick_edit' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
    );
    register_taxonomy('locations', 'jobs', $args);
}
//add_action('init', 'create_locations_tax');
   
}

// Instantiate the class
$JobiyaPlugin = new JobiyaPlugin();
