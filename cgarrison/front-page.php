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

  <?php
  // constants
  include_once('constants.php');
  include_once("analyticstracking.php");
  ?>

  <main class="front-page">
    <header class="site-header__header">
      <div class="site-header__brand">
        <a href="/">Christopher<br><span class="bar-bg">Garrison</span></a>
      </div>
      <nav class="site-header__main-nav">
        <?php wp_nav_menu(array('menu' => 'main')); ?>
      </nav>
    </header>

    <?php
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();
        $pageId = $post->ID;
    ?>

    <?php if (has_post_thumbnail( $pageId ) ): ?>
      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $pageId ), 'single-post-thumbnail' ); ?>
      <div class="hero">
        <div class="hero__title"><h1><?=get_post_meta($pageId, 'title', true)?></h1></div>
        <div class="hero__image"><img src="<?php echo $image[0]; ?>" /></div>
        <div class="hero__subtitle"><?=get_post_meta($pageId, 'subtitle', true)?></div>
        <div class="hero__cta">
          <a href="#about"><?=get_post_meta($pageId, 'cta', true)?></a>
        </div>
      </div>
    <?php endif; ?>

    <?php
        endwhile;
      else :
        echo wpautop( 'Sorry, no posts were found' );
      endif;
      ?>

    <section id="projects" class="projects highlight">
      <div class="projects__title">
        <h2>Projects</h2>
      </div>
      <div class="projects__list--wrap">
        <?php
          // Query only Project posts
          $posts = query_posts('cat=4');
          $postsCount = count($posts);
        ?>
          <?php
            $iterator = 1;
            // The Loop
            while ( have_posts() ) :
              if ($iterator == 1) { ?>
                <ul class="projects__list projects__list-1" style="height: <?=295*( ceil( $postsCount / 2 ) )?>px;">
              <?php } elseif ($iterator == ceil($postsCount / 2)+1) { ?>
                </ul>
                <ul class="projects__list projects__list-2" style="height: <?=295*( ceil( $postsCount / 2 ) )?>px;">
              <?php }
                $iterator++;
                the_post();
                $posttags = get_the_tags();
                $posttagsArray = array();
                if ($posttags) {
                  foreach($posttags as $tag) {
                    $posttagsArray[] = $tag->name;
                  }
                }
                $concatTags = join(', ', $posttagsArray);
                $image = wp_get_attachment_image_url( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
                ?>

                <li class="projects__item">
                  <a href="<?php the_permalink(); ?>" style="background-image: url(<?=$image?>);">
                    <div class="projects__content">
                      <div class="content__title"><?=the_title()?></div>
                      <div class="content__tags"><?=$concatTags?></div>
                      <div class="content__text"><?=the_excerpt()?></div>
                      <span class="content__cta">Lay eyes on it</span>
                    </div>
                  </a>
                </li>

            <?php endwhile;
            // Reset Query
            wp_reset_query();
          ?>
        </ul>
      </div>
    </section>
    <?php
      // about me
      $id = ABOUT_ME_ID;
      $post = get_post($id);
      $content = apply_filters('the_content', $post->post_content);
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'single-post-thumbnail' );
    ?>

    <section id="about" class="about-me highlight">
        <header>
          <div class="about-me__title"><h2><?=get_post_meta($id, 'title', true)?></h2></div>
          <div class="about-me__subtitle"><?=get_post_meta($id, 'subtitle', true)?></div>
          <div class="about-me__cta"><a href="http://cgarrison.com/wp-content/uploads/2017/08/CGarrisonResume.pdf"><?=get_post_meta($id, 'cta', true)?></a></div>
          <div class="about-me__image"><img src="<?php echo $image[0]; ?>" /></div>
        </header>
        <div class="about-me__content">
          <div class="content__pane"><?=$content?></div>
          <aside class="content__nav">
            <h5>Domains I've Worked In</h5>
            <?php wp_nav_menu(array('menu' => 'domains')); ?>
          </aside>
        </div>
    </section>

    <?php
      // let's talk design
      $id = LETS_TALK_ID;
      $post = get_post($id);
      $content = apply_filters('the_content', $post->post_content);
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'single-post-thumbnail' );
      $cta = get_post_meta($id, 'cta', true);
    ?>
    <section id="contact" class="contact highlight">
      <div class="contact__title">
        <h2><?=get_the_title()?></h2>
      </div>
      <div class="contact__body">
        <div class="contact__image" style="background-size: 100%; background-image: url(<?php echo $image[0]; ?>)"></div>
        <div class="contact__content">
          <div class="contact__text"><h3><?=$content?></h3></div>
          <div class="contact__cta"><a href="mailto:<?=$cta?>"><?=$cta?></a></div>
          <div class="contact__social">
            <ul>
              <li><a href="https://twitter.com/garrisondesigns"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/twitter.svg" /></a></li>
              <li><a href="https://www.linkedin.com/in/christophergarrisondesigns/"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/linkedin.svg" /></a></li>
              <li><a href="https://medium.com/@garrisondesigns"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/medium.svg" /></a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </main>
  <?php get_footer(); ?>
</body>
</html>
