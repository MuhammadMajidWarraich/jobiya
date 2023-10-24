<?php get_header() ?>

<!-- Hero Section -->
<div class="container-fluid bg-light px-5">
	<div class="row px-5" style="display: flex; align-items: center; padding: 50px 0 0;">
		<div class="col-md-6">
			<h1>Welcome to My Theme</h1>
			<p>This is my custom WordPress theme developed using HTML, CSS, JS, Bootstrap, and PHP. This theme is specialised for job board with large scale features needed for a job board website, So you should keep using this theme for your job portal.</p>
		</div>
		<div class="col-md-6">
			<img src="<?php echo get_template_directory_uri()?>/img/healus-mockup.png" style="width: 100%">
		</div>
	</div>
</div>
<!-- Hero Section End -->

<!-- Post Cards Section -->
<div class="container my-5">
	<div class="row">
		<h2 class="text-center">Posts Card Style</h2>

		<?php 
			$args = array(
				'posts_per_page'	=>	3,
				'orderby'			=>	'date',
				'order'				=>	'asc',
				'post_type'			=>	'jobs'
			);

			$query = new wp_query($args);

			if($query->have_posts()):
				while($query->have_posts()): $query->the_post(); 

		?>
		<div class="col-md-4">
			<div class="card p-2">
				<?php 
				//the_post_thumbnail();	

				// Display the post thumbnail with 100% width and height
				 if (has_post_thumbnail()) {
				    $thumbnail_id = get_post_thumbnail_id();
				    $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full', true);
				        echo '<img src="' . esc_url($thumbnail_url[0]) . '" style="width: 100%; height: 100%;" alt="' . esc_attr(get_the_title()) . '">';
				}

				?>
				<h3><?php  the_title();	?></h3>
				<?php  the_content();	?>
				<a href="<?php the_permalink()	?>" class="btn btn-primary">Learn More</a>
			</div>
		</div>
		
		<?php			
			endwhile;
			endif;
			wp_reset_postdata();
		?>	
	</div>
</div>
<!-- Posts Cards Section End-->

<!-- Posts Slider Section -->
<div class="container">
	<div class="row">
		<h2 class="text-center">Posts Carousel Style</h2>
	</div>
	
	<div class="carousel mb-5">
        <?php 
        	$slide = array(
        		'posts_per_page'	=>	5,
        		'orderby'			=>	'date',
        		'order'				=>	'asc',
        	);

        	$slideQuery	= new wp_query($slide);
        	if($slideQuery->have_posts()):
        		while ($slideQuery->have_posts()): $slideQuery-> the_post();
        ?>
    <div class="slide">
        <div class="module">
            <p><?php the_date(); 	?>	</p>
            <h2><?php the_title()	?></h2>
            <a href="<?php the_permalink(); ?>">Read More</a>
        </div>
    </div>

        <?php 
        		endwhile;
        	endif;
        	wp_reset_postdata();
        ?>
	</div>
</div>
<!-- Posts Slider Section End -->


<!-- Posts slider shortcode -->
<?php echo do_shortcode('[job_listing posts_per_page="1"]'); ?>


<?php get_footer() ?>