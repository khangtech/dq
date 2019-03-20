<?php
    /* Template Name: Home */
?>
<?php get_header(); ?>

<?php
  $current_lang = 	qtranxf_getLanguage() ;
  //echo "day la" . $current_lang;
  $current_path = get_template_directory_uri();
	$current_style_path = get_stylesheet_directory_uri();

?>

<section class="banner">
  <div id="top-banner" class="owl-carousel">
    <?php
          $args = array(
            'post_type' => 'top_banner'
          );
          $top_banner = new WP_Query($args);
          if ($top_banner->have_posts()){
              while($top_banner->have_posts()) : $top_banner->the_post(); ?>
              <?php
                $top_banner_link = get_field("banner_link_to", $post->ID);
                $top_banner_photo = get_field("banner_photo", $post->ID)
              ?>
              <div class="item"><a href="<?php echo $top_banner_link; ?>"><img src="<?php echo $top_banner_photo; ?>" alt="" /></a></div>
          <?php endwhile; wp_reset_postdata(); } ?>
  </div>
</section>


<section class="topSp">
  <div class="container">
    <div class="row">
    <?php
            $terms =  get_terms( array(
                'taxonomy' => 'chung-loai',
                'parent' => 0,
                'hide_empty'    => false ,
                'orderby' => 'term_id',
            ));
            foreach ($terms as $term) {
                $term_link  = get_term_link( $term )
      ?>
              <div class="col-sm-4 col-md-4 col-lg-4">
                  <div class="topSpItem"> <img src="<?php echo z_taxonomy_image_url($term->term_id) ?>" alt="" /> <a href="<?php echo $term_link ?>"><span><?php echo $term->name ?></span></a> </div>
              </div>
            <?php  } ?>
          </div>
  </div>
</section>




<section class="newsTopLst">
  <div class="container">
		<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
      <h2><?php
      //echo pll_e('Tin tức')
      $txtTinTuc = $current_lang == "vi" ? "Tin tức" : "News" ;
      echo $txtTinTuc;
      ?></h2>
      <div class="newsSlideTop">
        <div id="newsSlideTop" class="owl-carousel">

					<?php
					 $args = array(
						 'post_type' => 'post',
						 'orderby' => 'date',
						 'order' => 'DESC'
					 );

					 $news_list = new WP_Query($args);

					 if ($news_list->have_posts()){
							 while($news_list->have_posts()) : $news_list->the_post(); ?>
							 <div class="item">
 		            <p class="newsSlideImg"><a href="<?php the_permalink() ?>"><img src="<?php echo the_post_thumbnail_url('hot_news_thumb') ?>" alt="" /></a></p>
 		            <div class="newsSlideTxt">
 		              <h3><a href="<?php the_permalink() ?>"><?php echo wp_trim_words( get_the_title() , 9, '...' ); ?></a></h3>
 		              <p>
<?php
										$intro = get_the_excerpt();
									 echo wp_trim_words($intro, 15, '...');
?>
										<span><?php echo get_the_date( 'd/m/Y' ); ?></span></p>
 		            </div>
 		          </div>
					 <?php endwhile; wp_reset_postdata(); } ?>

        </div>
        <div class="customNavigation"> <a class="prev7"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/prev2.png" alt="" /></a> <a class="next7"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/next2.png" alt="" /></a></div>
      </div>
    </div>
	</div>
  </div>
</section>





<section class="testimonial">
  <div class="container">
		<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
      <h2><?php
      $txtCamNhan = $current_lang == "vi" ? "Cảm nhận" : "Testimonials" ;
      echo $txtCamNhan;
       ?></h2>
      <div class="testimonialInner">
        <div id="testimonial" class="owl-carousel">

					<?php

					$args = array(
				                 'post_type' => 'testimonial'
				               );
				               $testimonial_list = new WP_Query($args);
				               if ($testimonial_list->have_posts()){
				                   while($testimonial_list->have_posts()) : $testimonial_list->the_post(); ?>

													 <div class="item clearfix">
		 						            <p class="testimonialImg"><img src="<?php echo get_the_post_thumbnail_url() ?>" alt="" /></p>
		 						            <div class="testimonialInfo">
		 						              <div class="testimonialTxt"><?php the_content(); ?></div>
		 						              <p class="testimonialName"><?php the_title(); ?><span><?php  the_field('job_title') ?></span></p>
		 						            </div>
		 						          </div>

			  <?php endwhile; wp_reset_postdata(); } ?>

        </div>

        <div class="customNavigation"> <a class="prev1"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/prev1.png" alt="" /></a> <a class="next1"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/next1.png" alt="" /></a></div>
      </div>
    </div>
	</div>
  </div>
</section>



<section class="client">
<div class="container">
	<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<h2 class="mhTtl">
<?php
  $txtKhachHang = $current_lang == "vi" ? "Khách hàng" : "Clients" ;
    echo $txtKhachHang;
  ?>
		</h2>
		<div class="clientInner">
			<div id="client" class="owl-carousel">
				<?php
						$args = array(
			                 'post_type' => 'client'
			               );

						 $client_list = new WP_Query($args);

						 if ($client_list->have_posts()){
								while($client_list->have_posts()) : $client_list->the_post(); ?>
								<div class="item"> <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" /> </div>
						<?php endwhile; wp_reset_postdata(); } ?>
			</div>
			<div class="customNavigation"> <a class="prev2"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/prev2.png" alt="" /></a> <a class="next2"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/next2.png" alt="" /></a></div>
		</div>
	</div>
</div>
</div>
</section>
<section class="partner">
<div class="container">
	<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<h2 class="mhTtl"><?php

    $txtDoiTac = $current_lang == "vi" ? "Đối tác" : "Partners" ;
    echo $txtDoiTac;

     ?></h2>
		<div class="partnerInner">
			<div id="partner" class="owl-carousel">
				<?php
				$args = array(
			                 'post_type' => 'partner'
			               );
			               $partner_list = new WP_Query($args);
			               if ($partner_list->have_posts()){
			                   while($partner_list->have_posts()) : $partner_list->the_post(); ?>
			                   <div class="item"> <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" /> </div>
			               <?php endwhile; wp_reset_postdata(); } ?>

			</div>
			<div class="customNavigation"> <a class="prev3"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/prev2.png" alt="" /></a> <a class="next3"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/next2.png" alt="" /></a></div>
		</div>
	</div>
</div>
</div>
</section>




<?php get_footer(); ?>
