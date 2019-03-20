<?php
/* Template Name: Products */ ?>
<?php get_header(); ?>

<?php
  $current_lang = 	qtranxf_getLanguage() ;
  //echo "day la" . $current_lang;
  $current_path = get_template_directory_uri();
	$current_style_path = get_stylesheet_directory_uri();

  $txtTrangChu =  $current_lang == "vi" ? "Trang chủ" : "Home" ;
  $txtSanPham =  $current_lang == "vi" ? "Sản phẩm" : "Products" ;


?>


<section class="path2">
  <div class="container">
    <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
      <ul class="clearfix">
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo $txtTrangChu; ?></a> &gt;</li>
        <li><?php echo $txtSanPham; ?></li>
      </ul>
    </div>
  </div>
  </div>
</section>
<section class="productlanding">
  <div class="container">
    <h2 class="mhTtl_SP"><?php echo $txtSanPham; ?></h2>
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



<?php get_footer(); ?>
