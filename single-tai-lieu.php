<?php get_header(); 

$current_lang =  qtranxf_getLanguage() ;
?>



<section class="path2">
  <div class="container">
    <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
       <ul class="clearfix">
       <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo $current_lang=="vi" ? "Trang chủ" : "Home" ?></a> &gt;</li>
        <li><a href="<?php echo get_the_permalink(164); ?>"><?php echo $current_lang=="vi" ? "Tài liệu" : "Resources" ?></a>  &gt;</li>
        <li><?php the_title() ?></li>
      </ul>
    </div>
  </div>
  </div>
</section>
<section class="productlanding" id="solution">
  <div class="container">
    <h2 class="mhTtl"><?php the_title() ?></h2>



    <div class="row">
          <div class="col-sm-9" id="tailieu">



            <?php if (have_posts()): while (have_posts()) : the_post(); ?>


	               <?php the_content() ?>


		          <?php endwhile; endif; ?>


            <!-- neu co danh sach file thi load len -->

            <?php
            if( have_rows('danh_sach_tai_lieu', $post->ID) ): ?>
                          <h3 class="titleList">Các file tài liệu</h3>
                            <ul class="titleFile">
                         <?php while( have_rows('danh_sach_tai_lieu', $post->ID) ): the_row(); ?>
                           <li>
                                <img src="<?php echo get_stylesheet_directory_uri() ?>/img/icoD.png" />&nbsp;
                                 <a href="<?php the_sub_field('file_tai_lieu'); ?>">
                                 <?php the_sub_field('ten_tai_lieu'); ?>
                                 </a>
                           </li>

                         <?php endwhile; ?>
                         </ul>

                     <?php endif; ?>



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
