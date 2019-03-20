<?php get_header(); ?>

<?php

global $wp_query;
if(isset( $wp_query->query['prd'] ) ) {
  $query_var = $wp_query->query['prd'];
  
  $current_lang = 	qtranxf_getLanguage() ;


	//split to array de kiem tra, vi url se chua current_term_id, sub tag id cua PIM va short url cua PIM
  $arr_check = explode("_", $query_var);
  //print_r($arr_check);  
  //arr 0 la cha trong cai menu hien tai
  $parent_cat_id = $arr_check[0];
  //$product_id = $arr_check[1];
  $product_sku = $arr_check[1];

  //seach term nay
  $current_parent_term = get_term_by('id', $parent_cat_id, 'chung-loai');
  //print_r($current_parent_term);

  $link_pim_id = get_field('cat_pim_id', $current_parent_term);  
 //echo  $link_pim_id;

  global $remote_pim; 
 // $remote_pim = new wpdb('root','','2018_pim','localhost');
  $remote_pim = new wpdb('pim','Daviteq@123','pim_wepabb','192.168.10.114');

?>

  <section class="Pc_menuInner">
  <div class="container-fluid Pc_menuInnerTop">
    <div class="container">
      <ul  class="nav nav-pills">

        <?php
          $terms_list = get_terms( array(
          'taxonomy' => 'chung-loai',
          'hide_empty' => 0,
          'parent' => 0,
        ) );
        foreach ($terms_list as $term_item) {
           $term_link = get_term_link( $term_item );
          if ($term_item->term_id == $parent_cat_id ) {
            $menu_class = ' class="active"' ;
          } else {
            $menu_class= '';
          }
        ?>

            <li <?php echo $menu_class;  ?>> <a href="<?php echo $term_link ?>"><?php echo $term_item->name; ?></a> </li>
        <?php } ?>
      </ul>
    </div>
  </div>

  <?php 
      //tim cac sub cua no
        if ($current_lang=="vi") {
          $sub_cat_rows = $remote_pim->get_results("select cat_id, cat_title, cat_title_url
          from categories where cat_parent=" . $link_pim_id);

        } else {
          $sub_cat_rows = $remote_pim->get_results("select cat_id, cat_title_en as cat_title, cat_title_url_en as  cat_title_url
          from categories where cat_parent=" . $link_pim_id);
        }
       
  
         
         if($current_lang=="vi") {
          foreach ($sub_tag_rows as $sub_tag_item) {
            $sub_cat_name = $sub_tag_item->cat_title;
         }
         } else {
          foreach ($sub_tag_rows as $sub_tag_item) {
            $sub_cat_name = $sub_tag_item->cat_title_en;
         }
         }
         

         //load san pham nay
         if ($current_lang=="vi") {
          $sql_select_product = "select product_id, product_sku, product_name, product_overview, product_tags, product_feature_title_1, product_feature_content_1, product_feature_title_2, product_feature_content_2, product_feature_title_3, product_feature_content_3, product_feature_title_4, product_feature_content_4, product_feature_title_5, product_feature_content_5, product_feature_title_6, product_feature_content_6, product_img_1, product_img_2, product_img_3, product_img_4, product_img_5, product_img_6, product_img_7, product_img_8, product_spec, product_docs, product_video, product_sell, product_related, product_name_seo from products where product_active =1 and product_sku ='" .  $product_sku . "'"  ;

         } else {

          $sql_select_product = "select product_id, product_sku, product_name_en as product_name , product_overview_en as product_overview, product_tags_en as product_tags, product_feature_title_1_en as product_feature_title_1, product_feature_content_1_en as product_feature_content_1, product_feature_title_2_en as product_feature_title_2, product_feature_content_2_en as product_feature_content_2, product_feature_title_3_en as product_feature_title_3, product_feature_content_3_en as product_feature_content_3, product_feature_title_4_en as product_feature_title_4, product_feature_content_4_en as product_feature_content_4, product_feature_title_5_en as product_feature_title_5, product_feature_content_5_en as product_feature_content_5, product_feature_title_6_en as product_feature_title_6, product_feature_content_6_en as product_feature_content_6, product_img_1_en as product_img_1, product_img_2_en as product_img_2, product_img_3_en as product_img_3, product_img_4_en as product_img_4, product_img_5_en as product_img_5, product_img_6_en as product_img_6, product_img_7_en as product_img_7, product_img_8_en product_img_8, product_spec_en as product_spec, product_docs_en as product_docs, product_video_en as product_video, product_sell_en as product_sell, product_related_en as product_related, product_name_seo_en as product_name_seo from products where product_active =1 and product_sku ='" .  $product_sku . "'"  ;

         }

        //  echo $sql_select_product;
  
          $product_items = $remote_pim->get_results($sql_select_product);

         


  ?>
  <div class="container-fluid Pc_menuInnerBot">
    <div class="tab-content container clearfix">
      <div class="tab-pane active">
        <ul class="submenu">
             <?php
              foreach ($sub_cat_rows as $sub_cat_item) { 
                 $sub_term_link  =  get_home_url() . '/?tags=' . $parent_cat_id . '_' . $sub_cat_item->cat_id . '_' . $sub_cat_item->cat_title_url ;
			 ?>
                    <li>
                        <a href="<?php echo $sub_term_link ?>"><?php echo $sub_cat_item->cat_title; ?></a>
                    </li>
             <?php      
     		 }
            ?>
        </ul>
      </div>

    </div>
  </div>
</section>



<section class="m_menuInner">
  <div class="panel-group" id="accordion">

    <?php 

    foreach ($terms_list as $term_item) {
           $term_link = get_term_link( $term_item ); 

           $papa_link_pim_id = get_field('cat_pim_id', $term_item); 

    ?>

     <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title"> 
          <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#m_sp<?php echo $term_item->term_id ?>"><?php echo $term_item->name ?></a> </h4>
      </div>
      <div id="m_sp<?php echo $term_item->term_id; ?>" class="panel-collapse collapse">
        <ul class="m_suBmenu">
          <?php 
            //get sub menu cua no 
            if ($current_lang=="vi") {
              $sub_menu_sql = "select cat_id, cat_title, cat_title_url from categories where cat_parent=" . $papa_link_pim_id ;
            } else {
              $sub_menu_sql = "select cat_id, cat_title_en as cat_title, cat_title_url_en as cat_title_url  from categories where cat_parent=" . $papa_link_pim_id ;

            }
          //  echo $sub_menu_sql;
            $sub_menu_rows = $remote_pim->get_results($sub_menu_sql);
           // print_r($sub_menu_rows);

            foreach($sub_menu_rows as $sub_menu_items) {
                 $sub_menu_link  =  get_home_url() . '/?tags=' . $sub_menu_items->cat_title_url ;

            ?>                
           
             <li>
                <a href="<?php echo $sub_menu_link ?>"><?php echo $sub_menu_items->cat_title; ?>
                  
                </a>
              </li>

          <?php  }

          ?>
        </ul>
      </div>
    </div>
    

    

    <?php        

    }

    ?>

    
    
    
   
    
  </div>
</section>

<?php 
	// chuan bi data san sang
	$arr_feature_title = [];
	$arr_feature_content = [];
	$arr_product_photo = [];
  $pim_link_photo = 'http://pim.daviteq.com/images/';

  //$pim_link_photo = 'http://localhost/pim/images/';

	foreach ($product_items as $product_item) {
    	$ten_san_pham = $product_item->product_name;
    	$ma_san_pham = 	 $product_item->product_sku; 
    	$gioi_thieu =   $product_item->product_overview; 
    	$thong_so = $product_item->product_spec;
      $dat_hang = $product_item->product_sell;
    	$tai_lieu = $product_item->product_docs;
    	$video = $product_item->product_video ;
    	$related_sku = $product_item->product_related;

    if (!empty($video)) {	
    		$link_youtube = '<iframe width="100%" height="500" src="https://www.youtube.com/embed/' . $video . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
    } else {
    	$link_youtube ='';
    }





    //load hinh vao array, lay 3 hinh only
    if (!empty($product_item->product_img_1)) {
        $photo_1 = $pim_link_photo . $ma_san_pham .  ($current_lang=="vi" ? '_1.jpg': '_en_1.jpg') ;
        $org_photo_1 = $pim_link_photo . 's_' . $ma_san_pham  . ($current_lang=="vi" ? '_1.jpg': '_en_1.jpg') ;
        $arr_item_1 = $photo_1 . ';' . $org_photo_1;
      
    		array_push($arr_product_photo,$arr_item_1);	
     }
     

    //load hinh vao array, lay 3 hinh only
    if (!empty($product_item->product_img_2)) {
      $photo_2 = $pim_link_photo . $ma_san_pham . ($current_lang=="vi" ? '_2.jpg': '_en_2.jpg') ;
      $org_photo_2 = $pim_link_photo . 's_' . $ma_san_pham . ($current_lang=="vi" ? '_2.jpg': '_en_2.jpg') ;
      $arr_item_2 = $photo_2 . ';' . $org_photo_2;
    
      array_push($arr_product_photo,$arr_item_2);	
   }
   

   
    //load hinh vao array, lay 3 hinh only
    if (!empty($product_item->product_img_3)) {
      $photo_3 = $pim_link_photo . $ma_san_pham . ($current_lang=="vi" ? '_3.jpg': '_en_3.jpg') ;
      $org_photo_3 = $pim_link_photo . 's_' . $ma_san_pham . ($current_lang=="vi" ? '_3.jpg': '_en_3.jpg') ;
      $arr_item_3 = $photo_3 . ';' . $org_photo_3;
    
      array_push($arr_product_photo,$arr_item_3);	
   }
   


   
    //load hinh vao array, lay 3 hinh only
    if (!empty($product_item->product_img_4)) {
      $photo_4 = $pim_link_photo . $ma_san_pham . ($current_lang=="vi" ? '_4.jpg': '_en_4.jpg') ;
      $org_photo_4 = $pim_link_photo . 's_' . $ma_san_pham . ($current_lang=="vi" ? '_4.jpg': '_en_4.jpg') ;
      $arr_item_4 = $photo_4 . ';' . $org_photo_4;
    
      array_push($arr_product_photo,$arr_item_4);	
   }
   
   
    //load hinh vao array, lay 3 hinh only
    if (!empty($product_item->product_img_5)) {
      $photo_5 = $pim_link_photo . $ma_san_pham . ($current_lang=="vi" ? '_5.jpg': '_en_5.jpg') ;
      $org_photo_5 = $pim_link_photo . 's_' . $ma_san_pham . ($current_lang=="vi" ? '_5.jpg': '_en_5.jpg') ;
      $arr_item_5 = $photo_5 . ';' . $org_photo_5;
    
      array_push($arr_product_photo,$arr_item_5);	
   }
   

    //load hinh vao array, lay 3 hinh only
    if (!empty($product_item->product_img_6)) {
      $photo_6 = $pim_link_photo . $ma_san_pham . ($current_lang=="vi" ? '_6.jpg': '_en_6.jpg') ;
      $org_photo_6 = $pim_link_photo . 's_' . $ma_san_pham . ($current_lang=="vi" ? '_6.jpg': '_en_6.jpg') ;
      $arr_item_6 = $photo_6 . ';' . $org_photo_6;
    
      array_push($arr_product_photo,$arr_item_6);	
   }
   

   
    //load hinh vao array, lay 3 hinh only
    if (!empty($product_item->product_img_7)) {
      $photo_7 = $pim_link_photo . $ma_san_pham . ($current_lang=="vi" ? '_7.jpg': '_en_7.jpg') ;
      $org_photo_7 = $pim_link_photo . 's_' . $ma_san_pham . ($current_lang=="vi" ? '_7.jpg': '_en_7.jpg') ;
      $arr_item_7 = $photo_7 . ';' . $org_photo_7;
    
      array_push($arr_product_photo,$arr_item_7);	
   }
   

    //load hinh vao array, lay 3 hinh only
    if (!empty($product_item->product_img_8)) {
      $photo_8 = $pim_link_photo . $ma_san_pham . ($current_lang=="vi" ? '_8.jpg': '_en_8.jpg') ;
      $org_photo_8 = $pim_link_photo . 's_' . $ma_san_pham . ($current_lang=="vi" ? '_8.jpg': '_en_8.jpg') ;
      $arr_item_8 = $photo_8 . ';' . $org_photo_8;
    
      array_push($arr_product_photo,$arr_item_8);	
   }
   


    
   	if (!empty($product_item->product_feature_title_1)) {
    		array_push($arr_feature_title,$product_item->product_feature_title_1);	
    		array_push($arr_feature_content,$product_item->product_feature_content_1);	

   	}

   	if (!empty($product_item->product_feature_title_2)) {
    		array_push($arr_feature_title,$product_item->product_feature_title_2);	
    		array_push($arr_feature_content,$product_item->product_feature_content_2);	
   	}


   	 if (!empty($product_item->product_feature_title_3)) {
    		array_push($arr_feature_title,$product_item->product_feature_title_3);	
    		array_push($arr_feature_content,$product_item->product_feature_content_3);	
   	}

   	 if (!empty($product_item->product_feature_title_4)) {
    		array_push($arr_feature_title,$product_item->product_feature_title_4);
    		array_push($arr_feature_content,$product_item->product_feature_content_4);		
   	}

   	 if (!empty($product_item->product_feature_title_5)) {
    		array_push($arr_feature_title,$product_item->product_feature_title_5);	
    		array_push($arr_feature_content,$product_item->product_feature_content_5);	
   	}

   	if (!empty($product_item->product_feature_title_6)) {
    		array_push($arr_feature_title,$product_item->product_feature_title_6);	
    		array_push($arr_feature_content,$product_item->product_feature_content_6);	
   	}


    }	


    //load related items
    if (!empty($related_sku)) {
    	$related_cloud = explode(";", $related_sku);
    	$related_cloud_where = implode("','", $related_cloud);


      if ($current_lang=="vi") {

        $sql_select_related_product = "select product_id, product_sku, product_name,product_name_seo, product_img_1 from products where product_active =1 and product_sku IN ('" .  $related_cloud_where . "')"  ;

      } else {
        $sql_select_related_product = "select product_id, product_sku, product_name_en as product_name,product_name_seo_en as product_name_seo, product_img_1_en as product_img_1 from products where product_active =1 and product_sku IN ('" .  $related_cloud_where . "')"  ;
      }
    

    	//echo $sql_select_related_product; 
  
   		$product_related_items = $remote_pim->get_results($sql_select_related_product);



    }
  



    
	 
	
?>


<section class="spDetail">
  <div class="container">
    <div class="spdTop clearfix">
      <div class="col-sm-5 col-md-5 col-lg-5 spdImgL">

        <div id="sync1" class="owl-carousel">

         <?php 

         	foreach ($arr_product_photo as $photo_item) {
           $arr_photo_main = explode(";", $photo_item);
        ?>
         		<div class="item" style="background-color: #fff;   text-align: center; vertical-align: middle;"> 
               <a href="<?php echo $arr_photo_main[0] ?>" class="fancybox" rel="album">
               <img style="position: relative;top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);" src="<?php echo $arr_photo_main[1] ?>">
                </a>
             </div>
         <?php 
         	}
         ?>		
        </div>


        <div class="spdImgR">
          <div id="sync2" class="owl-carousel">
             <?php 
          foreach ($arr_product_photo as $photo_item2) {
            $arr_photo_thumb = explode(";", $photo_item2);
            ?>
            <div class="item" > 
              <img style="position: relative;top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);" src="<?php echo $arr_photo_thumb[1] ?>" />
          </div>
         <?php 
          }
         ?>   
        </div>
        
       </div>

       
      </div>
     
        

      <div class="col-sm-7 col-md-7 col-lg-7 spdTxtR">
        <h2><?php echo $ten_san_pham; ?></h2>
        <h4><?php _e("<!--:en-->SKU<!--:--><!--:vi-->SKU<!--:-->"); ?>: <?php echo $ma_san_pham ?></h2>
        <p class="spdRtxt"><?php echo $gioi_thieu; ?></p>
        <div class="spdbg clearfix"> <a href="<?php echo esc_url( get_permalink(162) ); ?>" class="spdbgBtn"><?php _e("<!--:en-->Get quote<!--:--><!--:vi-->Yêu cầu báo giá<!--:-->"); ?></a>  </div>
      </div>
    </div>
    <div class="spdInfo clearfix">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="panel-group wrap" id="bs-collapse">
          <div class="panel">
            <div class="panel-heading"> <a data-toggle="collapse" data-parent="#bs-collapse" href="#spdInfo1"><?php _e("<!--:en-->Highlight Features<!--:--><!--:vi--> Đặc điểm nổi bật<!--:-->"); ?> </a> </div>
            <div id="spdInfo1" class="panel-collapse collapse spdInfoInner in">
              <?php 

              	if(!empty($arr_feature_title)) {
              		$counter = 0;
              		foreach($arr_feature_title as $title) {

              			echo "<h2>" . $title . "</h2>";
              			echo "<ul><li>";
              			echo str_replace("\n", "</li><li>", $arr_feature_content[$counter]) ;
              			echo "</li></ul>";
              			$counter +=1;

              		}
              	}

              ?>
            </div>
          </div>
          <div class="panel">
            <div class="panel-heading"> <a class="collapsed" data-toggle="collapse" data-parent="#bs-collapse" href="#spdInfo2"> <?php _e("<!--:en-->Specification<!--:--><!--:vi-->Thông số kỹ thuật<!--:-->"); ?> </a> </div>
            <div id="spdInfo2" class="panel-collapse collapse spdInfoInner">

              <?php 
                $tr_thong_so = "";
                $arr_thong_so = explode("\n", $thong_so);

                for ($i = 0; $i <count($arr_thong_so); $i++) {
                    $tr_pim = $arr_thong_so[$i];
                    $td_column = explode(";", $tr_pim);
                    $tr_thong_so = $tr_thong_so . "<tr>" . "<td>" . $td_column[0] . '</td><td>' . str_replace("|","<br>",$td_column[1]) . '</tr>'; 
                }

                $table = '<table class="table table-striped">' . $tr_thong_so . '</table>';

                echo $table;
                
              ?>

                         
            </div>
          </div>
          <div class="panel">
            <div class="panel-heading"> <a class="collapsed" data-toggle="collapse" data-parent="#bs-collapse" href="#spdInfo3">  <?php _e("<!--:en-->Documents<!--:--><!--:vi-->Tài liệu<!--:-->"); ?> </a> </div>
            <div id="spdInfo3" class="panel-collapse collapse spdInfoInner">


              <ul>

               <?php 
               
                $arr_tai_lieu = explode("\n", $tai_lieu);

                for ($i = 0; $i <count($arr_tai_lieu); $i++) {
                    $link_item = $arr_tai_lieu[$i];
                    $arr_link_tai_lieu = explode(";", $link_item);
                    echo '<li><a target="_blank" href="' . $arr_link_tai_lieu[1] . '">'  . $arr_link_tai_lieu[0] . '</a></li>'; 
                } 
    
              ?>
              </ul>

            </div>
          </div>




        <div class="panel">
            <div class="panel-heading"> <a class="collapsed" data-toggle="collapse" data-parent="#bs-collapse" href="#spdInfo4"> <?php _e("<!--:en-->Ordering information<!--:--><!--:vi-->Thông tin đặt hàng<!--:-->"); ?> </a> </div>
            <div id="spdInfo4" class="panel-collapse collapse spdInfoInner">
            <?php 
                $tr_dat_hang = "";
                if (!empty($dat_hang)) {
                  $arr_dat_hang = explode("\n", $dat_hang);
                  for ($i = 0; $i <count($arr_dat_hang); $i++) {
                    $tr_pim_dat_hang = $arr_dat_hang[$i];
                    $td_column_dat_hang = explode(";", $tr_pim_dat_hang);
                    $tr_dat_hang = $tr_dat_hang . "<tr>" . "<td>" . $td_column_dat_hang[0] . '</td><td>' . str_replace("|","<br>",$td_column_dat_hang[1]) . '</tr>'; 
                 }    
                   $table2 = '<table class="table table-striped">' . $tr_dat_hang . '</table>';
                   echo $table2;  

                }
                               
              ?>
            </div>
          </div>



          <div class="panel">
            <div class="panel-heading"> <a class="collapsed" data-toggle="collapse" data-parent="#bs-collapse" href="#spdInfo5"> Videos </a> </div>
            <div id="spdInfo5" class="panel-collapse collapse spdInfoInner">
              	<?php echo $link_youtube; ?>
            </div>
          </div>
     	
        </div>
      </div>
    </div>


    <h2 class="mhTtl"> <?php _e("<!--:en-->Related products<!--:--><!--:vi-->Sản phẩm liên quan<!--:-->"); ?></h2>
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
            <p class="spListItemImg" style="height: 200px; width: 200px; background-color: #fff;   text-align: center; vertical-align: middle;">
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
</section>





<?php  } ?>


<?php get_footer('product'); ?>
