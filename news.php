<?php
    /* Template Name: News */
?>
<?php get_header(); ?>


<?php
  $current_lang = 	qtranxf_getLanguage() ;
  //echo "day la" . $current_lang;
  $current_path = get_template_directory_uri();
	$current_style_path = get_stylesheet_directory_uri();

?>

<?php
$txtGioiThieu =  $current_lang == "vi" ? "Giới thiệu Daviteq" : "About Daviteq" ;
$txtTinTuc =  $current_lang == "vi" ? "Tin tức" : "News" ;
$txtLienHe =  $current_lang == "vi" ? "Liên hệ" : "Contact us" ;

?>


<section class="Pc_menuInner2 clearfix">
  <div class="container-fluid">
    <div class="container">
      <div class="row">
      <ul class="clearfix">

        <li><a href="<?php echo esc_url( get_permalink(144) ); ?>"><?php echo $txtGioiThieu; ?></a></li>
          <li><a href="<?php echo esc_url( get_permalink(160) ); ?>" class="active"><?php echo $txtTinTuc; ?></a></li>
          <li><a href="<?php echo esc_url( get_permalink(162) ); ?>"><?php echo $txtLienHe; ?></a></li>

      </ul>
    </div>
    </div>
  </div>
</section>
<section class="m_menuInner2">
  <div class="container-fluid">
    <div class="container">
          <div class="row">
            <ul class="clearfix">
              <li><a href="<?php echo esc_url( get_permalink(144) ); ?>"><?php echo $txtGioiThieu; ?></a></li>
                <li><a href="<?php echo esc_url( get_permalink(160) ); ?>" class="active"><?php echo $txtTinTuc; ?></a></li>
                <li><a href="<?php echo esc_url( get_permalink(162) ); ?>"><?php echo $txtLienHe; ?></a></li>

            </ul>
    </div>
    </div>
  </div>
</section>
<section class="path">
  <div class="container">
    <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
      <?php custom_breadcrumbs(); ?>
    </div>
  </div>
  </div>
</section>


<section class="introductionNews">
  <div class="container">
    <div class="row">
    <h2 class="mhTtl"><?php the_title(); ?></h2>
    <div class="newsTop clearfix">
      <div class="col-sm-6 col-md-6 col-lg-6">
        <div class="newsL">
          <?php
          global $do_not_duplicate;
          $args = array (
            'posts_per_page' => 1,
            'order' => 'DESC',
            'orderby' => 'date'
          );
          $latest_news = new WP_Query($args);
          while ($latest_news->have_posts()) :
              $latest_news->the_post();
              $do_not_duplicate[]= $post->ID;
          ?>

        <p class="newsLImg"><a href="<?php the_permalink(); ?>"><img src="<?php echo the_post_thumbnail_url('hot_news'); ?>" alt="" /></a></p>
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <p>
 <?php
            $intro = get_the_excerpt();
           echo wp_trim_words($intro, 15, '...');
 ?>
             ... <span><?php echo get_the_date( 'd/m/Y' ); ?></span></p>

        <?php
                  endwhile; wp_reset_postdata();
        ?>

        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-6">
        <ul class="newsRlst">

          <?php $args = array(
           'posts_per_page' => 4,
         'post__not_in' => $do_not_duplicate,
           'orderby' => 'date',
           'order' => 'DESC'
         ); ?>


         <?php
              $other_news = new WP_Query($args);
              while($other_news->have_posts()) :
                $other_news->the_post();
                $do_not_duplicate[]= $post->ID;
          ?>




          <li class="clearfix">
            <p class="newsRimg"><a href="<?php the_permalink() ?>"><img src="<?php echo the_post_thumbnail_url('right_news') ?>" alt="<?php the_title() ?>" /></a></p>
            <div class="newsRtxt">
              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <p>
              <?php
                         $intro = get_the_excerpt();
                        echo wp_trim_words($intro, 15, '...');
              ?>... <span><?php echo get_the_date( 'd/m/Y' ); ?></span></p>
            </div>
          </li>


          <?php
                endwhile; wp_reset_postdata();
          ?>


        </ul>
      </div>
    </div>
    <div class="newsSlide">
      <div id="newsSlide" class="owl-carousel">

        <?php $args = array(
         'post__not_in' => $do_not_duplicate,
         'orderby' => 'date',
         'order' => 'DESC'
       ); ?>


       <?php
            $slide_news = new WP_Query($args);
            while($slide_news->have_posts()) :
              $slide_news->the_post();

        ?>


        <div class="item">
          <p class="newsSlideImg"><a href="<?php the_permalink(); ?>"><img src="<?php echo the_post_thumbnail_url('hot_news_thumb') ?>"
            alt="<?php the_title(); ?>" /></a></p>
          <div class="newsSlideTxt">
            <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
            <p>
            <?php
                       $intro = get_the_excerpt();
                      echo wp_trim_words($intro, 15, '...');
            ?>... <span><?php echo get_the_date( 'd/m/Y' ); ?></span></p>
          </div>
        </div>


        <?php
              endwhile; wp_reset_postdata();
        ?>









      </div>
      <div class="customNavigation"> <a class="prev4"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/prev2.png" alt="" /></a> <a class="next4"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/next2.png" alt="" /></a></div>
    </div>
  </div>
  </div>
</section>


<script>
jQuery(document).ready(function() {
  var owl = jQuery("#newsSlide");
  owl.owlCarousel({
  items : 4,
  itemsDesktop : [1200,3],
  itemsDesktopSmall : [900,3],
  itemsTablet: [700,2],
  itemsMobile : [500,1] ,
  autoPlay: 3000
  });

  jQuery(".next4").click(function(){
	owl.trigger('owl.next');
  })
  jQuery(".prev4").click(function(){
	owl.trigger('owl.prev');
  })
});
</script>




<?php get_footer(); ?>
