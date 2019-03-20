 <?php  
 $current_lang = 	qtranxf_getLanguage() ;
 $txtPhanLoai = $current_lang == "vi" ? "Phân loại" : "Categories" ; 
 ?>
 <div class="col-sm-3">
            <h3 class="blog_cat_title"><?php echo $txtPhanLoai; ?></h3>
            <ul class="right_nav">

              <?php 

             $terms =  get_terms( array(
                  'taxonomy' => 'loai-giai-phap',
                  'parent' => 0,
                  'hide_empty'    => false ,
                  'orderby' => 'term_id',
              ));
          
              ?>


               <?php

                
              foreach ($terms as $term) {
                   $count_post = $term->count;
              }

              // dem post

               $args = array(
               'post_type' => 'giai-phap',
               'orderby' => 'date',
               'order' => 'DESC'
               );
               $solutions = new WP_Query($args);

               $total_post = $solutions->post_count;


              ?>




              <li><a href="<?php echo get_the_permalink(139); ?>"><?php _e("<!--:en-->All solutions<!--:--><!--:vi-->Tất cả giải pháp<!--:-->"); ?> (<?php echo $total_post; ?>)</a></li>
              <?php


              
              foreach ($terms as $term) {
                  $term_link  = get_term_link( $term );
                   $count_post = $term->count;
              ?>
               <li><a href="<?php echo $term_link;  ?>"><?php echo $term->name ?> (<?php echo $count_post; ?>)</a></li>
              <?php } ?>
            </ul>
</div>