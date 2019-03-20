<?php get_header(); ?>

<?php  $current_lang =  qtranxf_getLanguage() ;

$txtSPLienQuan = $current_lang == "vi" ? "Sản phẩm liên quan" : "Related Products" ;

  global $remote_pim; 
 // $remote_pim = new wpdb('root','','2018_pim','localhost');
  $remote_pim = new wpdb('pim','Daviteq@123','pim_wepabb','192.168.10.114');

    $pim_link_photo = 'http://pim.daviteq.com/images/';


?>

<section class="path2">
  <div class="container">
    <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
      <ul class="clearfix">
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo $current_lang=="vi" ? "Trang chủ" : "Home" ?></a> &gt;</li>
        <li><a href="<?php echo get_the_permalink(139); ?>"><?php echo $current_lang=="vi" ? "Giải pháp" : "Solutions" ?></a>  &gt;</li>
        <li><?php the_title() ?></li>
      </ul>

    </div>
  </div>
  </div>
</section>
<section class="productlanding" id="solution">
  <div class="container">


    <div class="row">
          <div class="col-sm-9">

              <h2 class="title_medium"><?php the_title() ?></h2>


            <?php if (have_posts()): while (have_posts()) : the_post(); ?>


	             <?php the_content() ?>



              <br>

              <h2 class="title_medium">

                <?php

                echo $txtSPLienQuan	;

                ?>
              </h2>

                 




              <?php endwhile; endif; ?>




              <div class="row">

    <div class="col-sm-12 col-md-12">


   <?php $related_sku = get_field('san_pham_lien_quan');  

                      $related_cloud = explode(";", $related_sku);
                  $related_cloud_where =  implode("','", $related_cloud);


      if ($current_lang=="vi") {

        $sql_select_related_product = "select product_id, product_sku, product_name,product_name_seo, product_img_1 from products where product_active =1 and product_sku IN ('" .  $related_cloud_where . "')"  ;

      } else {
        $sql_select_related_product = "select product_id, product_sku, product_name_en as product_name,product_name_seo_en as product_name_seo, product_img_1_en as product_img_1 from products where product_active =1 and product_sku IN ('" .  $related_cloud_where . "')"  ;
      }
    

   //   echo $sql_select_related_product; 
  
      $product_related_items = $remote_pim->get_results($sql_select_related_product);



                      ?>

                    
           <div class="productSlide">
          <div id="productSlide" class="owl-carousel">
        <?php 
          foreach ($product_related_items as $product_related_item) {
            $related_link_item = get_home_url() . '/?prd=' . $parent_cat_id . '_' 
            . $product_related_item->product_id . '_' . $product_related_item->product_name_seo  ;

          //      $photo_item = $product_related_item->product_img_1; 
                if ($current_lang=="vi") {
                  $photo_item = $pim_link_photo . $product_related_item->product_sku . '_1.jpg';

                } else {
                  $photo_item = $pim_link_photo . $product_related_item->product_sku . '_en_1.jpg';

                }

                $related_product_name = $product_related_item->product_name;

                ?>

         <div class="item">
          <div class="spListItem">
            <p class="spListItemImg" style="height: 200px; width: auto; background-color: #fff;   text-align: center; vertical-align: middle;">
              <a href="<?php echo $related_link_item; ?>">
                <img style="position: relative;top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);" src="<?php echo $photo_item; ?>">
            </a>
          </p>
            <p class="spListItemTxt"><a href="<?php echo $related_link_item; ?>"><?php echo $related_product_name; ?></a></p>
          </div>
        </div>

        <?php } ?>
      </div>
      <div class="customNavigation"> <a class="prev5"><img src="<?php echo get_template_directory_uri(); ?>/img/prev2.png" alt="" /></a> <a class="next5"><img src="<?php echo get_template_directory_uri(); ?>/img/next2.png" alt="" /></a></div>     
    </div>


     </div>
    </div>

          </div>





          <?php
                get_template_part( 'solution_topic');
         ?>



  </div>


    
  </div>
</section>



<?php get_footer('product'); ?>
