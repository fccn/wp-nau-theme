<?php

function get_parent_link($id) {
    // get the parent page link
    return get_the_permalink(get_post_ancestors($id)[0]);
}