<?php
/* Template Name: Resources */

get_header(); ?>

<?php
  $current_lang = 	qtranxf_getLanguage() ;
  //echo "day la" . $current_lang;
  $current_path = get_template_directory_uri();
	$current_style_path = get_stylesheet_directory_uri();

?>

<section class="path2">
  <div class="container">
    <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
      <ul class="clearfix">
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php // echo pll_e('Trang chủ') ?></a> &gt;</li>
        <li><?php
        // echo pll_e('Tài liệu') ?></li>
      </ul>
    </div>
  </div>
  </div>
</section>
<section class="productlanding">
  <div class="container">
    <h2 class="mhTtl">
      <?php
          $txtTaiLieu = $current_lang == "vi" ? "Tài liệu" : "Resources" ;
          echo $txtTaiLieu;
      ?>
  </h2>



    <div class="row">
          <div class="col-sm-9">

            <?php
  					 $args = array(
  						 'post_type' => 'tai-lieu',
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
          <div class="col-sm-3">
            <h3 class="blog_cat_title">Phân loại</h3>
            <ul class="right_nav">
              <?php
              $terms =  get_terms( array(
                  'taxonomy' => 'loai-tai-lieu',
                  'parent' => 0,
                  'hide_empty'    => false ,
                  'orderby' => 'term_id',
              ));
              foreach ($terms as $term) {
                  $term_link  = get_term_link( $term )
              ?>
              <li><a href="<?php echo $term_link;  ?>"><?php echo $term->name ?></a></li>

              <?php } ?>
            </ul>
          </div>


  </div>
  </div>
</section>



<?php get_footer(); ?>
