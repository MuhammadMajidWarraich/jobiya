<?php
/*
*	Plugin Name: Jobiya
*	Plugin URI:	softsunrise.com
*	Author:	jobiya
*	Author URI:	softsunrise.com
*	Description:	Simple Job Board System
* 	Version:	1.1
*	License:	GPL2
*	Text Domain:	jobiya
*	Domain Path:	/landuages
*/

// Avoid direct file access
if(!defined('WPINC')){
	die;
}

// Function to check collisions of plugin functions throughout the WordPress directory
if (!function_exists('jobiya_plugin_fuction')) {
	function jobiya_plugin_fuction(){

	}


}// define constant to assign version to your plugin in future release
if( !defined('jobiya_plugin_version')){
	define('jobiya_plugin_version', '1.0.0');
}

// define constant to assign directory/path to your plugin in future release
if(!defined('jobiya_plugin_dir')){
	define('jobiya_plugin_dir', plugin_dir_url(__file__));
}


// Enqueue styles and scripts
if (!function_exists('Jobiya_plugin_enqueue_scripts')) {
	function Jobiya_plugin_enqueue_scripts(){
		wp_enqueue_style('style', jobiya_plugin_dir. 'assets/css/main.css');
		wp_enqueue_script('jobiya-script', jobiya_plugin_dir. 'assets/js/main.js', 'jquery', '1.0.0', false );
	}
	add_action('wp_enqueue_scripts', 'Jobiya_plugin_enqueue_scripts');
}



// Including Settings menu, DB and page 
require plugin_dir_path(__file__). 'inc/settings.php';

// Including DB tables
require plugin_dir_path(__file__). 'inc/db.php';

// Including Like dislike btns for content
require plugin_dir_path(__file__). 'inc/like-dislike-btns.php';

// Including Jobs CPT and Taxonomies
require plugin_dir_path(__file__). 'inc/jobs-cpt-and-tax.php';

// Including jobs shortcodes
require plugin_dir_path(__file__). 'inc/shortcodes.php';



// Function to load custom single template for "jobs" post type
function custom_jobs_template($template) {
    if (is_singular('jobs')) {
        // Path to your custom template file within the plugin directory
        $custom_template = plugin_dir_path(__FILE__) . 'single-jobs.php';

        // Check if the custom template file exists, otherwise, fall back to the original template
        return file_exists($custom_template) ? $custom_template : $template;
    }

    return $template;
}

// Hook the function to the template_include filter
add_filter('template_include', 'custom_jobs_template');




// Function to display jobs in list view format without thumbnail
function display_job_list() {
    $jobiya_post_count = get_option('jobiya_post_count');    // Get jobs count from options settings

    // Query job posts
    $job_query = new WP_Query(array(
        'post_type'      => 'jobs', // custom post type
        'posts_per_page' => $jobiya_post_count, // Get jobs count 
    ));

     if ($job_query->have_posts()) :
        ?>
        <div class="container my-5 ">
            <div class="row bg-light align-items-center p-3">

        <?php
        while ($job_query->have_posts()) : $job_query->the_post();
            // Get job details
            $job_title    = get_the_title();
            $description  = get_the_content();
            $short_description  = get_the_excerpt();
            $job_permalink = get_the_permalink();
            $posted_date  = get_the_date();
            $department   = get_the_terms(get_the_ID(), 'departments'); // Assuming 'department' is your taxonomy
            $location     = get_the_terms(get_the_ID(), 'locations');
            $shift        = get_the_terms(get_the_ID(), 'shifts');
            $job_type     = get_the_terms(get_the_ID(), 'types');

            // Output job details
            ?>


            <div class="col-md-5">
                <h3><?php echo esc_html($job_title); ?></h3>
                <div class="jobiya-jobs-list-meta d-flex">
                    <p><strong>Posted Date:</strong> <?php echo esc_html($posted_date); ?></p>
                    <p><strong>Department:</strong> <?php echo $department ? esc_html($department[0]->name) : ''; ?></p>
                </div>
                <p><?php echo esc_html($short_description); ?></p>
            </div>

            <div class="col-md-5 my-3 d-flex justify-content-center">
                <div class="jobiya-jobs-list-meta d-flex justify-content-space-between">
                    <p><strong>Location:</strong> <?php echo $location ? esc_html($location[0]->name) : ''; ?></p>
                    <p><strong>Shift:</strong> <?php echo $shift ? esc_html($shift[0]->name) : ''; ?></p>
                    <p><strong>Type:</strong> <?php echo $job_type ? esc_html($job_type[0]->name) : ''; ?></p>
                </div>
            </div>

            <div class="col-md-2 my-3 d-flex justify-content-end">
                <a class="btn btn-primary" href="<?php echo $job_permalink ?>"> Apply Now</a>
            </div>


            <?php
        endwhile;
    else :
        echo 'No job listings found.';
        ?>
            </div>
        </div>
        <?php
    endif;

    // Restore global post data
    wp_reset_postdata();
}



// Function to display jobs in list view format with thumbnail
function display_job_list_with_thumb() {
    $jobiya_post_count = get_option('jobiya_post_count');    // Get jobs count from options settings

    // Query job posts
    $job_query = new WP_Query(array(
        'post_type'      => 'jobs', // custom post type
        'posts_per_page' => $jobiya_post_count, // Get jobs count 
    ));

     if ($job_query->have_posts()) :
        ?>
        <div class="container my-5">
            <div class="row">

        <?php
        while ($job_query->have_posts()) : $job_query->the_post();
            // Get job details
            $job_title    = get_the_title();
            $description  = get_the_content();
            $short_description  = get_the_excerpt();
            $job_permalink = get_the_permalink();
            $job_thumb =    get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-fluid'));
            $posted_date  = get_the_date();
            $department   = get_the_terms(get_the_ID(), 'departments'); // Assuming 'department' is your taxonomy
            $location     = get_the_terms(get_the_ID(), 'locations');
            $shift        = get_the_terms(get_the_ID(), 'shifts');
            $job_type     = get_the_terms(get_the_ID(), 'types');

            // Output job details
            ?>

            <div class="col-md-4">
                <?php 
                    echo  $job_thumb;
                ?>
            </div>

            <div class="col-md-8">
                <h3><?php echo esc_html($job_title); ?></h3>
                <div class="jobiya-jobs-list-meta d-flex">
                    <p><strong>Posted Date:</strong> <?php echo esc_html($posted_date); ?></p>
                    <p><strong>Department:</strong> <?php echo $department ? esc_html($department[0]->name) : ''; ?></p>
                </div>
                <p><?php echo esc_html($short_description); ?></p>
                <div class="jobiya-jobs-list-meta d-flex">
                    <p><strong>Location:</strong> <?php echo $location ? esc_html($location[0]->name) : ''; ?></p>
                    <p><strong>Shift:</strong> <?php echo $shift ? esc_html($shift[0]->name) : ''; ?></p>
                    <p><strong>Type:</strong> <?php echo $job_type ? esc_html($job_type[0]->name) : ''; ?></p>
                </div>
                <a class="btn btn-primary" href="<?php echo $job_permalink ?>"> Read More</a>
            </div>
            <?php
        endwhile;
    else :
        echo 'No job listings found.';
        ?>
            </div>
        </div>
        <?php
    endif;

    // Restore global post data
    wp_reset_postdata();
}







// Function to display jobs in cards format
function display_job_cards(){  
    $jobiya_post_count = get_option('jobiya_post_count');    // Get jobs count from options settings

    // Query job posts
    $card_query = new WP_Query( array(
        'post_type' => 'jobs',
        'posts_per_page' =>$jobiya_post_count,
        'order_by' => 'date',
        'order' => 'asc',
    ));

    // Output job card

    if($card_query->have_posts()):
        ?>
        <div class="container my-5">
        <div class="row">
            <h2 class="text-center">Jobs Card Style</h2>
            <p class="text-center">These posts are being retrieved by posts card shortcode</p>

        <?php
        while($card_query->have_posts()) : $card_query->the_post() ;
            $department = get_the_terms(get_the_ID(), 'departments');
            $job_title    = get_the_title();
            $description  = get_the_content();
            $short_description  = get_the_excerpt();
            $job_permalink = get_the_permalink();
            $job_thumb =    get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-fluid'));
            $posted_date  = get_the_date();
            $department   = get_the_terms(get_the_ID(), 'departments'); // Assuming 'department' is your taxonomy
            $location     = get_the_terms(get_the_ID(), 'locations');
            $shift        = get_the_terms(get_the_ID(), 'shifts');
            $job_type     = get_the_terms(get_the_ID(), 'types');
        ?>

            <div class="col-md-4">
                <div class="card p-2 mb-3">
                    <h3><?php  the_title(); ?></h3>
                <div class="jobiya-jobs-list-meta d-flex justify-content-between">
                    <p><strong>Posted:</strong><?php echo esc_html($posted_date); ?></p>
                    <p><strong>Department:</strong><?php echo $department ? esc_html($department[0]->name) : ''; ?></p>
                </div>
 
                <?php  the_excerpt();   ?>
                <div class="jobiya-jobs-list-meta d-flex justify-content-between">
                    <p><strong>Location:</strong> <?php echo $location ? esc_html($location[0]->name) : ''; ?></p>
                    <p><strong>Shift:</strong> <?php echo $shift ? esc_html($shift[0]->name) : ''; ?></p>
                    <p><strong>Type:</strong> <?php echo $job_type ? esc_html($job_type[0]->name) : ''; ?></p>
                </div>

                    <a href="<?php the_permalink()  ?>" class="btn btn-primary">Learn More</a>
                </div>
            </div>

        <?php
            endwhile;
        endif;
        ?>
    </div>
</div>
<?php

}




// Function to display jobs in slider Format
function display_job_slider() {
    $jobiya_post_count = get_option('jobiya_post_count');    // Get jobs count from options settings

    // Query jobs posts
    $slide_query = new WP_Query(array(
        'post_type'      => 'jobs',  // Update with your custom post type
        'posts_per_page' => $jobiya_post_count,
        'orderby'        => 'date',
        'order'          => 'asc',
    ));

    // Output jobs slider
    ob_start();

    if ($slide_query->have_posts()) :
    ?>
    <div class="container">
        <div class="row">
            <h2 class="text-center">Jobs Carousel Style</h2>
            <p class="text-center">These posts are being retrieved by posts carousel function</p>
        </div>

        <div class="carousel mb-5">
            <?php while ($slide_query->have_posts()) : $slide_query->the_post(); ?>
                <div class="slide">
                    <div class="module">
                        <p><?php the_date(); ?></p>
                        <h2><?php the_title(); ?></h2>
                        <a href="<?php the_permalink(); ?>">Read More</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php
    else :
        echo 'No job listings found.';
    endif;

    // Restore global jobs data
    wp_reset_postdata();

    echo ob_get_clean();
}

