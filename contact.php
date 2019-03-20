<?php
    /* Template Name: Contact */
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

<?php

$ten_cong_ty = get_field('ten_cong_ty',162);
$dia_chi =   get_field('dia_chi',162);
$tel =    get_field('tel',162);
$email_lien_he  = get_field('email_lien_he',162);
$google_map = get_field('google_map',162);


?>


<section class="Pc_menuInner2 clearfix">
  <div class="container-fluid">
    <div class="container">
      <div class="row">
      <ul class="clearfix">
        <li><a href="<?php echo esc_url( get_permalink(144) ); ?>"><?php echo $txtGioiThieu; ?></a></li>
          <li><a href="<?php echo esc_url( get_permalink(160) ); ?>" ><?php echo $txtTinTuc; ?></a></li>
          <li><a href="<?php echo esc_url( get_permalink(162) ); ?>" class="active"><?php echo $txtLienHe; ?></a></li>
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
                <li><a href="<?php echo esc_url( get_permalink(160) ); ?>" ><?php echo $txtTinTuc; ?></a></li>
                <li><a href="<?php echo esc_url( get_permalink(162) ); ?>" class="active"><?php echo $txtLienHe; ?></a></li>
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
    <div class="col-sm-6 col-md-6 col-lg-6">
      <div class="contactL">
        <p class="contactImg"><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" /></p>
        <div class="contactMap">
<iframe src="<?php echo $google_map ?>" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6">
      <div class="contactR">
        <div class="lhInfo">
          <h3><?php echo $ten_cong_ty; ?></h3>
          <p class="clearfix"><img src="<?php echo get_template_directory_uri(); ?>/img/lh_L.png" alt="" /><span><?php echo $dia_chi; ?></span></p>
          <p class="clearfix"><img src="<?php echo get_template_directory_uri(); ?>/img/lh_P.png" alt="" /><span><?php echo $tel; ?></span></p>
          <p class="clearfix"><img src="<?php echo get_template_directory_uri(); ?>/img/lh_M.png" alt="" /><span><a href="mailto:<?php echo $email_lien_he; ?>"><?php echo $email_lien_he; ?></a></span></p>
        </div>


        <?php if ($current_lang=="vi") {
           echo do_shortcode( '[contact-form-7 id="187" title="Form liên hệ"]' );
       } else {
           echo do_shortcode( '[contact-form-7 id="1281" title="Contact form"]' );
       }
       ?>
      </div>
    </div>
  </div>
</section>




<?php get_footer(); ?>
