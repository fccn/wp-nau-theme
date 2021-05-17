<?php 
    global $news_array;
?>

<div class="news-container">
    <?php if( empty ($news_array) && function_exists("pll_current_language") ) {
        $default_language_page_id = pll_get_post($post->ID , pll_default_language());
    ?>
        <p>
            <?= nau_trans('Sorry, currently this page is only available in ') ?>
            <a href="<?= get_permalink($default_language_page_id) ?>"><?= pll_default_language() != 'pt' ?: 'Portuguese' ?></a>.
        </p>
    <?php } ?>
    <?php foreach ($news_array as $news): ?>
        <article class="news-article">
            <a class="news-article__link" href="<?php echo get_permalink($news); ?>">
                <div class="news-article__image_container">
                    <?php echo get_the_post_thumbnail( $news, 'thumbnail', array( 'class' => 'news-article__image' ) ); ?>
                </div>
                <div class="news-article__description">
                    <h2><?php echo get_the_title($news); ?></h2>
                    <p class="news-article__description-date"><?php echo get_the_date( 'l, j F Y', $news );?></p>
                    <p class="news-article__description-excerpt"><?php echo get_the_excerpt($news); ?></p>
                </div>
                
                <!--<a class="news_article__read_more" href="<?php echo get_permalink($news); ?>">
                    <?php echo nau_trans("Read More"); ?>
                </a>-->
                
            </a>
        </article>

        <!-- <div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>

        <div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div> -->
    <? endforeach; ?>
</div>