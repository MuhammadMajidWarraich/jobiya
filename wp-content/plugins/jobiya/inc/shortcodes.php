<?php

// Shortcode to show job listing
function job_listing_shortcode($atts) {
    // Process shortcode attributes if needed

    // Default attributes
    $atts = shortcode_atts(array(
        'posts_per_page' => 10, // Adjust the number of job listings to display
    ), $atts, 'job_listing');

    // Query job posts
    $job_query = new WP_Query(array(
        'post_type'      => 'jobs', // Your custom post type
        'posts_per_page' => $atts['posts_per_page'],
    ));

    // Output job listings
    ob_start();

    if ($job_query->have_posts()) :
        while ($job_query->have_posts()) : $job_query->the_post();
            // Get job details
            $job_title    = get_the_title();
            $description  = get_the_content();
            $posted_date  = get_the_date();
            $department   = get_the_terms(get_the_ID(), 'departments'); // Assuming 'job_department' is your taxonomy
            $location     = get_the_terms(get_the_ID(), 'locations');
            $shift        = get_the_terms(get_the_ID(), 'shifts');
            $job_type     = get_the_terms(get_the_ID(), 'types');

            // Output job details
            ?>
            <div class="job-listing">
                <h3><?php echo esc_html($job_title); ?></h3>
                <p><?php echo esc_html($description); ?></p>
                <p><strong>Posted Date:</strong> <?php echo esc_html($posted_date); ?></p>
                <p><strong>Department:</strong> <?php echo $department ? esc_html($department[0]->name) : ''; ?></p>
                <p><strong>Location:</strong> <?php echo $location ? esc_html($location[0]->name) : ''; ?></p>
                <p><strong>Shift:</strong> <?php echo $shift ? esc_html($shift[0]->name) : ''; ?></p>
                <p><strong>Type:</strong> <?php echo $job_type ? esc_html($job_type[0]->name) : ''; ?></p>
            </div>
            <?php
        endwhile;
    else :
        echo 'No job listings found.';
    endif;

    // Restore global post data
    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('job_list_view', 'job_listing_shortcode');




// Jobs listing Carousel  shortcode
function job_slider_shortcode($atts) {
    // Shortcode attributes
    $atts = shortcode_atts(array(
        'posts_per_page' => 5,
        'orderby'        => 'date',
        'order'          => 'asc',
    ), $atts, 'job_slider');

    // Query jobs posts
    $slide_query = new WP_Query(array(
        'post_type'      => 'jobs',  // Update with your custom post type
        'posts_per_page' => $atts['posts_per_page'],
        'orderby'        => $atts['orderby'],
        'order'          => $atts['order'],
    ));

    // Output jobs slider
    ob_start();

    if ($slide_query->have_posts()) :
    ?>
    <div class="container">
        <div class="row">
            <h2 class="text-center">Jobs Carousel Style</h2>
            <p class="text-center">These posts are being retrieved by posts carousel shortcode</p>
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

    return ob_get_clean();
}

add_shortcode('job_slider', 'job_slider_shortcode');




// Jobs card style shortcode
function job_card_shortcode($atts){    
    $atts = shortcode_atts( array(
        'posts_per_page' => 10,
        'orderby' => 'date',
        'order' => 'asc',
    ), $atts, 'job_card');

    // Query job posts

    $card_query = new WP_Query( array(
        'post_type' => 'jobs',
        'posts_per_page' => $atts['posts_per_page'],
        'order_by' => $atts['orderby'],
        'order' => $atts['order'],
    ));

    // Output job card

    if($card_query->have_posts()):
        ?>
        <div class="container my-5">
        <div class="row">
            <h2 class="text-center">Jobs Card Style</h2>
            <p class="text-center">These posts are being retrieved by posts card shortcode</p>

        <?php
        while($card_query->have_posts()) : $card_query->the_post() 
        ?>

            <div class="col-md-4">
                <div class="card p-2 mb-3">
                    <h3><?php  the_title(); ?></h3>
                <?php  the_content();   ?>
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

add_shortcode('job_card','job_card_shortcode' );



// Jobs Layout Shortcode
function jobiya_listings_shortcode($atts) {
    $jobiya_post_count = get_option('jobiya_post_count');    // Get jobs count from options settings
    $atts = shortcode_atts(array(
        'posts_per_page' => $jobiya_post_count,
        'orderby' => 'date',
        'order' => 'asc',
    ), $atts, 'job_listing');

    $current_layout = get_option('jobiya_layout', 'list');

    // Modify the shortcode output based on the selected layout
    if ($current_layout === 'grid') {
        // Grid layout code
        display_job_cards(); //Function Called here to Display jobs on the homepage

    } elseif ($current_layout === 'carousel') {
        // Carousel layout code
        display_job_slider(); // Function Called here to Display jobs on the homepage

    } else {
        // Default list layout code
        display_job_list(); // Function Called here to Display jobs on the homepage
    }

    // ... rest of your shortcode logic
}

add_shortcode('job_listing', 'jobiya_listings_shortcode');
