<!-- CONTENT -->
<article class="content">
    <div class="content_tags">
      <?php echo nau_list_tags()?>
      <?php echo nau_list_categories()?>
    </div>
    <p class="date"><?php echo get_the_date()?></p>
    <p class="content"><?php echo $post->post_content?></p>
</article>

