<?php
/* Loads post content into the sliders
 * Use WP_Query to fetch all announcements
 * Limit to the current language by taxonomy (pt | en)
 * Optional labels by area
 */

require_once get_template_directory() . '/inc/announcements/announcements_setup.php';

$loop = get_announcements();

?>

<div class="announcements-slider">

    <div class="splide">
	<div class="splide__track">
		<ul class="splide__list">
        <?php while ( $loop->have_posts() ) : $loop->the_post();

                // Video content has priviledge over images. If there's a video link, it'll load 
                
                if (get_field('video_media_url')) {
                    $post_thumbnail = get_field('video_media_url');
                } else if (has_post_thumbnail()) {
                    $post_thumbnail = get_the_post_thumbnail_url();
                } else {
                    $post_thumbnail = 'assets/img/banner-01.jpg';
                }

                $action_target = get_field('action_button_target');
            ?> 
			<li class="splide__slide" style="background-image: url(<?php echo $post_thumbnail; ?>)">
            <div class="slide-overlay">
                <div class="splide__slide-card">
                        <span class="slide-card__title"><?php echo get_the_title(); ?></span>
                        <span class="slide-card__subtext"><?php echo get_the_excerpt(); ?></span>
                        
                        <?php if(get_field('action_button_url')): ?>
                        <a href="<?php echo get_field('action_button_url'); ?>" <?php echo ($action_target == 'new')? 'target="_blank"' : ""; ?> class="slide_card__action">
                            <?php echo get_field('action_button_text') ? get_field('action_button_text') : nau_trans('Know more', 'nau-theme'); ?>
                        </a>
                        <?php endif; ?>
                </div>
            </div>
            </li>
        <?php endwhile; wp_reset_postdata(); ?>
		</ul>
	</div>
    </div>

<script>
	new Splide( '.splide',
        { 
            type: '<?php echo $loop->found_posts<=1 ? "slide" : "loop"; ?>',
            fade: 1,
            perPage: 1,
            autoplay: true,
            slideFocus: true,
            <?php echo $loop->found_posts<=1 ? "arrows: false" : "arrows: true"; ?>
        } ).mount();
</script>

</div>