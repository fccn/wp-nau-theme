<article class="news-article">
            <a class="news-article__link" href="<?php echo get_permalink(); ?>" title="<?php echo nau_trans('Read more about'); ?> <?php echo get_the_title(); ?>">
                <div class="news-article__image_container">
                    <?php echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array( 'class' => 'news-article__image' ) ); ?>
                </div>
                <div class="news-article__description">
                    <h2><?php echo get_the_title(); ?></h2>
                    <p class="news-article__description-date"><?php echo get_the_date( 'l, j F Y');?></p>
                    <p class="news-article__description-excerpt"><?php echo get_the_excerpt(); ?></p>
                </div>
                
            </a>
        </article>