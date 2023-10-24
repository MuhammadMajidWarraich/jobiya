
<div class="footer">
	<p class="text-center">Copy rights 2023 All rights reserved</p>
</div>

<script>
    jQuery(document).ready(function($) {
    $('.carousel').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: true,
        autoplay: true,
        autoplaySpeed: 2000,
        focusOnSelect: true,
        prevArrow: '<button class="slick-prev" aria-label="Previous" type="button">❮</button>',
        nextArrow: '<button class="slick-next" aria-label="Next" type="button">❯</button>',
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
});

</script>


	<?php wp_footer();	?>
</body>
</html>