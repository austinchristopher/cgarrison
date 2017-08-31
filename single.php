<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="<?php bloginfo('description'); ?>" />
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/index.css">
  <title><?php wp_title( '|', true, 'right' ); ?>Christopher Garrison</title>
  <link href="https://fonts.googleapis.com/css?family=Eczar:500,700,800|Gentium+Basic:400,700" rel="stylesheet">
  <?php //wp_head(); ?>
</head>
<body>
<?php  include_once("analyticstracking.php");?>
  <main class="project">
    <?php
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();
        $pageId = $post->ID;
        $pageTitle = get_the_title();
        $content = apply_filters('the_content', $post->post_content);
        $bgImage = wp_get_attachment_image_src( get_post_thumbnail_id( $pageId ), 'single-post-thumbnail' );
    ?>
    <div class="project__header" style="background-image: url(<?=$bgImage[0]?>);">

      <?php include_once('site-header.php')?>

      <div class="project-title__header">
        <h1><?=$pageTitle?></h1>
        <div class="project-title__domains">
          <h5>Domains Involved</h5>
          <?php
          $posttags = get_the_tags();
          if ($posttags) {
            echo '<ul>';
            foreach($posttags as $tag) {
              echo '<li>'.$tag->name.'</li>';
            }
            echo '</ul>';
          }
          ?>
        </div>
      </div>
    </div>
    <div class="project__content">
      <div class="project__excerpt"><?=the_excerpt(); ?></div>
      <?=$content;?>
    </div>

    <?php
        endwhile;
      else :
        echo wpautop( 'Sorry, no posts were found' );
      endif;
      ?>

  <?php get_footer(); ?>

  </main>
</body>
</html>
