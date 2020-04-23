<!-- CONTENT -->
<article class="content">
    <div class="content_tags">
      <?=nau_list_tags()?>
      <?=nau_list_categories()?>
    </div>
    <p class="date"><?=get_the_date()?></p>
    <p class="content"><?=$post->post_content?></p>
</article>

