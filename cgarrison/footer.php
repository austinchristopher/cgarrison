


<?php

include_once('constants.php');

if (!is_front_page()) {
    // echo "something out";
    if( get_adjacent_post(true, '', false, 'category') ) {
      // $tags = wp_get_post_tags( $next_post->ID, array('fields'=>'names'));
      // for ($x =0; $x < count($tags); $x++){
      //   echo $tags[$x];
      // }
      $post_id = $post->ID; // current post ID
      // echo 'IF';

      $cat = get_the_category();
      $current_cat_id = $cat[0]->cat_ID; // current category ID

      $args = array(
          'category' => $current_cat_id,
          // 'orderby'  => 'post_date',
          // 'order'    => 'DESC'
      );
      $posts = get_posts( $args );
      // get IDs of posts retrieved from get_posts
      $ids = array();
      foreach ( $posts as $thepost ) {
          $ids[] = $thepost->ID;
      }
      // get and echo previous and next post in the same category
      $thisindex = array_search( $post_id, $ids );
      $previd = $ids[ $thisindex - 1 ];
      $nextid = $ids[ $thisindex + 1 ];
      // print_r ($nextid);
        // if ( $nextid == "56" ) {
        //     $nextid = "55";
        // }
      if(empty($nextid))  {
        $nextid = "55";
      }
    }

    else {
      $nextid = '51';
      // $last = new WP_Query('posts_per_page=1&order=ASC&post_type=object'); $last->the_post();
      // echo 'ELSE';
      // wp_reset_query();
    }
    // else {$nextid = $ids[ $thisindex + 1 ];}

    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $nextid ), 'single-post-thumbnail' );
  ?>

  <section class="nda">
    <div class="nda__body">
      <p>I can’t go into further detail about this project publicly, but we can still talk about it.</p>
      <?php
        // let's talk design
        $id = LETS_TALK_ID;
        $cta = get_post_meta($id, 'cta', true);
      ?>
      <div class="nda__social">
        <div class="nda__cta"><a href="mailto:<?=$cta?>"><?=$cta?></a></div>
        <div>
          <a href="https://www.linkedin.com/in/christophergarrisondesigns/">
            <img src="<?php echo get_template_directory_uri(); ?>/images/icons/linkedin.svg" />
          </a>
      </div>
      </div>
    </div>
  </section>

<?php print_r($nextid); ?>

  <section id="next-project" class="next-project highlight">
    <header>
      <div class="next-project__title"><h2>Next Project</h2></div>
      <div class="next-project__subtitle">
        <h5><?=get_the_title($nextid)?></h5>
        <p><?=get_the_excerpt($nextid)?></p>
      </div>
      <div class="next-project__cta">
        <a href="<?php the_permalink($nextid); ?>">
          <?=get_post_meta($nextid, 'cta', true)?>
        </a>
      </div>
      <div class="next-project__image"><img src="<?php echo $image[0]; ?>" /></div>
    </header>
  </section>

<?php
} // end if
?>



<!-- global footer -->
<footer>
  <div><b>©<?=date("Y");?> Christopher Garrison</b></div>
  <div><span class="separator"> | </span>Don’t take yourself too seriously</div>
  <div><span class="separator"> | </span>Make things people covet</div>
</footer>

<script src="<?php echo get_template_directory_uri(); ?>/scripts/main.js"></script>
