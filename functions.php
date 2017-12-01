<?php
add_theme_support( 'post-thumbnails' );

function filter_ptags_on_images($content){
  return preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '<div class="project__image">\1</div>', $content);
}
add_filter('the_content', 'filter_ptags_on_images');
?>
