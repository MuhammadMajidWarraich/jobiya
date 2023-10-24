<?php get_header() ?>

<!-- Hero Section -->
<div class="container-fluid bg-light px-5">
	<div class="row px-5" style="display: flex; align-items: center; padding: 50px 0 0;">
		<div class="col-md-12">
			<h1 class="text-center"><?php the_title(); ?></h1>
			<p class="text-center">This is my custom WordPress theme developed using HTML, CSS, JS, Bootstrap, and PHP. This theme is specialised for job board with large scale features needed for a job board website, So you should keep using this theme for your job portal.</p>
		</div>
	</div>
</div>
<!-- Hero Section End -->


<!-- Posts Slider Section -->
<div class="container">
	<div class="row my-5">
		<div class="col-md-8">
			<?php the_content(); ?>
		</div>
		<div class="col-md-4 bg-light pt-3">
			<h2>Jobs List Style</h2>
            <p>These jobs are being retrieved by jobs list style function</p>
		<!-- Posts slider shortcode -->
			<?php echo do_shortcode('[job_listing ]'); ?>
		</div>
	</div>
</div>
<!-- Posts Slider Section End -->


<?php get_footer() ?>