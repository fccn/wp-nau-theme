<?php
/*
 * Homepage main search bar
 * shortcode: [nau_homepage_search]
 */
?>

<div id="homepage-form-container" class="homepage-searchbar">
    <form class="homepage-search-form" action="<?php echo home_url(); ?>" role="search" method="post" enctype="application/x-www-form-urlencoded">
        <label class="homepage-search-form-label" for="s"><?php echo nau_trans("Search Courses")?></label>
        <input class="homepage-search-form-input" name="s" type="text" placeholder="<?=nau_trans("What do you want to learn today?")?>" value="<?php echo isset($search_query) ? $search_query : ""; ?>" aria-labelledBy="banner-search-form-label">
        <input class="homepage-search-form-submit" name="submit-search" type="submit" value="<?php echo nau_trans("Search"); ?>" />
    </form>
</div>