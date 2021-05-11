<?php
// Loads post content into the sliders
$args = array(
    'post_type' => 'announcements',
);

$loop = new WP_Query( $args );
    

?>
<div class="announcements-slider">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>

   

    <div class="splide">
	<div class="splide__track">
		<ul class="splide__list">
        <?php while ( $loop->have_posts() ) : $loop->the_post(); 
                
                if (has_post_thumbnail()) {
                    $post_thumbnail = get_the_post_thumbnail_url();
                } else {
                    $post_thumbnail = 'assets/img/banner-01.jpg';
                }
            ?> 
			<li class="splide__slide" style="background-image: url(<?php echo $post_thumbnail; ?>)">
                <div class="splide__slide-card">
                    <span class="slide-card__title"><?php echo get_the_title(); ?></span>
                    <span class="slide-card__subtext"><?php echo get_the_excerpt(); ?></span>
                </div>
            </li>
        <?php endwhile; wp_reset_postdata(); ?>
		</ul>
	</div>
    </div>

<script>
	new Splide( '.splide', { autoplay: true } ).mount();
</script>

</div>