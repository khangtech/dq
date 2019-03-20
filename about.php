<?php
    /* Template Name: About */
?>
<?php get_header(); ?>


<?php
  $current_lang = 	qtranxf_getLanguage() ;
  //echo "day la" . $current_lang;
  $current_path = get_template_directory_uri();
	$current_style_path = get_stylesheet_directory_uri();

?>


<?php
           $about_intro = get_field('noi_dung',144);
           $photo_intro =  get_field('hinh_minh_hoa',144);

           $about_intro_2 = get_field('noi_dung_2',144);
           $photo_intro_2 =  get_field('hinh_minh_hoa_2',144);

           $txtGioiThieu =  $current_lang == "vi" ? "Giới thiệu Daviteq" : "About Daviteq" ;
           $txtTinTuc =  $current_lang == "vi" ? "Tin tức" : "News" ;
           $txtLienHe =  $current_lang == "vi" ? "Liên hệ" : "Contact us" ;
?>




<section class="Pc_menuInner2 clearfix">
  <div class="container-fluid">
    <div class="container">
      <div class="row">
      <ul class="clearfix">

          <li><a href="<?php echo esc_url( get_permalink(144) ); ?>" class="active"><?php echo $txtGioiThieu; ?></a></li>
            <li><a href="<?php echo esc_url( get_permalink(160) ); ?>"><?php echo $txtTinTuc; ?></a></li>
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
              <li><a href="<?php echo esc_url( get_permalink(144) ); ?>" class="active"><?php echo $txtGioiThieu; ?></a></li>
                <li><a href="<?php echo esc_url( get_permalink(160) ); ?>"><?php echo $txtTinTuc; ?></a></li>
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


<section class="introduction">
  <div class="container">
    <h2 class="mhTtl"><?php the_title(); ?></h2>
    <div class="introductionInner">
      <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 introductionImg"> <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" /> </div>
        <div class="col-sm-6 col-md-6 col-lg-6 introductionTxt">

              <?php if (have_posts()): while (have_posts()) : the_post(); ?>

          <?php the_content(); ?>

            <?php endwhile; endif; ?>


        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 introductionImg introductionR"> <img src="<?php echo $photo_intro ?>" alt="" /> </div>
        <div class="col-sm-6 col-md-6 col-lg-6 introductionTxt">
            <?php echo $about_intro; ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 introductionImg"> <img src="<?php echo $photo_intro_2 ?>" alt="" /> </div>
        <div class="col-sm-6 col-md-6 col-lg-6 introductionTxt">
        <?php echo $about_intro_2; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
