<li class="result">
    <div class="title"><a href="<?=get_permalink($post->ID)?>"><?=$post->post_title?></a></div>
    <div class="exerpt"><?=$post->exerpt?></a></div>
    <div class="tags"><?=nau_list_tags()?></div>
    <div class="image"><a href="<?=get_permalink($post->ID)?>"><img class="image" src="<?=get_the_post_thumbnail_url($post)?>"></a></div>
</li>

