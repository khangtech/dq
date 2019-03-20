<?php get_header(); ?>
<?php
  $current_lang = 	qtranxf_getLanguage() ;
  //echo "day la" . $current_lang;
  $current_path = get_template_directory_uri();
	$current_style_path = get_stylesheet_directory_uri();

  $txtTrangChu = $current_lang == "vi" ? "Trang chủ" : "Home" ;

  $txtGiaiPhap = $current_lang == "vi" ? "Giải pháp" : "Solutions" ;

 


?>

<section class="path2">
  <div class="container">
    <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
      <ul class="clearfix">
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo $txtTrangChu; ?></a> &gt;</li>
        <li><?php echo $txtGiaiPhap; ?></li>
      </ul>
    </div>
  </div>
  </div>
</section>
<section class="productlanding">
  <div class="container">

    <?php
    $current_term = get_queried_object();
    $current_term_link = get_term_link( $current_term );

    $args = array (
         'post_type' => 'giai-phap',
         'posts_per_page' => 16,
         'orderby' => 'date',
         'order' => 'ASC',
         'tax_query' => array(
           array(
             'taxonomy' => 'loai-giai-phap',
             'field' => 'slug',
             'terms' => $current_term->slug,
           ),
         ),
     );


    ?>

    <h2 class="title_big"><?php echo   $current_term->name  ?></h2>



    <div class="row">
          <div class="col-sm-9">

            <?php


             $news_list = new WP_Query($args);

            if ($news_list->have_posts()){
                while($news_list->have_posts()) : $news_list->the_post(); ?>
                <div class="row solution">
                   <div class="col-md-4">
                          <a href="<?php the_permalink() ?>"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'medium') ?>" alt="" /></a>
                   </div>
                   <div class="col-md-8">
                          <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>

                          <p>
       <?php
                          $intro = get_the_excerpt();
                         echo wp_trim_words($intro, 30, '...');
       ?>
                          </p>



                   </div>




                </div>

                <div class="sepline"></div>

            <?php endwhile; wp_reset_postdata(); } ?>












          </div>
         <?php 
                get_template_part( 'solution_topic');
         ?>


  </div>
  </div>
</section>



<?php get_footer(); ?>
