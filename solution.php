<?php
/* Template Name: Solutions */

get_header(); ?>

<?php
  
  //echo "day la" . $current_lang;
  $current_lang =  qtranxf_getLanguage() ;
  $current_path = get_template_directory_uri();
	$current_style_path = get_stylesheet_directory_uri();


?>



<section class="path2">
  <div class="container">
    <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
      <ul class="clearfix">
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo $current_lang=="vi" ? "Trang chủ" : "Home" ?></a> &gt;</li>
        <li><?php echo $current_lang=="vi" ? "Giải pháp" : "Solutions" ?></li>
      </ul>
    </div>
  </div>
  </div>
</section>
<section class="productlanding" id="solution">
  <div class="container">
    <h2 class="title_big"><?php
        $txtGiaiPhap = $current_lang == "vi" ? "Giải pháp" : "Solutions" ;
        echo $txtGiaiPhap;
    ?>
     </h2>



    <div class="row">
          <div class="col-sm-9">

            <?php
  					 $args = array(
  						 'post_type' => 'giai-phap',
  						 'orderby' => 'date',
               'posts_per_page' => 10,
  						 'order' => 'DESC'
  					 );

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
