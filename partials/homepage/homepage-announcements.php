<?php
/* Loads post content into the sliders
 * Use WP_Query to fetch all announcements
 * Limit to the current language by taxonomy (pt | en)
 * Optional labels by area
 */


// get the current polylang language. If polylang is not defined, language is set to default.
$default_language = 'pt';
$language = function_exists('pll_current_language')? pll_current_language() : $default_language;

$args = array(
    'post_type' => 'announcements',
    'tax_query' => array(
        array (
            'taxonomy' => 'languages',
            'field' => 'slug',
            'terms' => $language,
        )
    ),
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