<?php get_header(); ?>

<?php

global $wp_query;
if(isset( $wp_query->query['tags'] ) ) {
  $query_var = $wp_query->query['tags']; 
  $current_lang = 	qtranxf_getLanguage() ;


	//split to array de kiem tra, vi url se chua current_term_id, sub tag id cua PIM va short url cua PIM
  $arr_check = explode("_", $query_var);
  //print_r($arr_check);  
  //arr 0 la cha trong cai menu hien tai
  $parent_cat_slug_check = $arr_check[0];
  $sub_tag_slug = $arr_check[1];



  //can thiep tho bao vao mysql
  global $wpdb;
  $table = $wpdb->prefix . 'termmeta' ;
  if ($current_lang =="vi") {
    $mylink = $wpdb->get_row( "SELECT * FROM $table WHERE meta_key ='_qts_slug_vi' and meta_value  ='" . $parent_cat_slug_check . "'");
  } else {
      $mylink = $wpdb->get_row( "SELECT * FROM $table WHERE meta_key ='_qts_slug_en' and meta_value  ='" . $parent_cat_slug_check . "'" );
  }

  

  $parent_cat_slug = $mylink->meta_value;
  $parent_cat_id =  (int)$mylink->term_id;

  $parent_term = get_term($parent_cat_id, 'chung-loai');
 
  $link_pim_id = get_field('cat_pim_id', $parent_term);  

  global $remote_pim; 
  //$remote_pim = new wpdb('root','','2018_pim','localhost');
  $remote_pim = new wpdb('pim','Daviteq@123','pim_wepabb','192.168.10.114');

  $sub_tag_id = '';
  //tim ten sub_tag theo id
  if ($current_lang =="vi") {
    $sub_cat_find_rows = $remote_pim->get_results("select cat_id
    from categories where cat_title_url='" .  esc_html($sub_tag_slug) . "'");
  } else {
    $sub_cat_find_rows = $remote_pim->get_results("select cat_id 
    from categories where cat_title_url_en='" . esc_html($sub_tag_slug) . "'");
  }

  
  foreach ($sub_cat_find_rows as $sub_cat_find_item) {
    $sub_tag_id = $sub_cat_find_item->cat_id;
    
  }



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
        if ($current_lang =="vi") {
          $sql = "select cat_id, cat_title, cat_title_url
          from categories where cat_parent=" . $link_pim_id ;
          
        } else {
          $sql = "select cat_id, cat_title_en as cat_title, cat_title_url_en as cat_title_url
          from categories where cat_parent=" . $link_pim_id ;
         
        }
     //   echo $sql;
        
        $sub_cat_rows = $remote_pim->get_results($sql);
       
  
    // tim ten cua current tags nay
         $sub_tag_rows_find = $remote_pim->get_results("select * 
    from categories where cat_id=" . $sub_tag_id);

       //  print_r($sub_tag_rows);
         if ($current_lang =="vi") {
          foreach ($sub_tag_rows_find as $sub_tag_item) {
            $sub_cat_name = $sub_tag_item->cat_title;
          }
         } else {
          foreach ($sub_tag_rows_find as $sub_tag_item) {
            $sub_cat_name = $sub_tag_item->cat_title_en;
         }
         }
 
         



         //load san pham cua tags nay
         if ($current_lang=="vi") {
          $sql_select_product = "select product_id, product_sku, product_name, product_name_seo, product_img_1 from products where product_active =1 and product_tags like '%" . $sub_cat_name . "%'" ;

         } else {
          $sql_select_product = "select product_id, product_sku, product_name_en as product_name,product_name_seo_en as product_name_seo, product_img_1_en as product_img_1  from products where product_active =1 and product_tags_en like '%" . $sub_cat_name . "%'" ;

         }

          if (strlen($sub_cat_name)>0) {
            $product_rows = $remote_pim->get_results($sql_select_product); 
          }
  
         



  ?>
  <div class="container-fluid Pc_menuInnerBot">
    <div class="tab-content container clearfix">
      <div class="tab-pane active">
        <ul class="submenu">
             <?php
              foreach ($sub_cat_rows as $sub_cat_item) { 
                 $sub_term_link  =  get_home_url() . '/?tags=' . $parent_cat_slug .  '_' . $sub_cat_item->cat_title_url ;

                 if ($sub_cat_item->cat_id == $sub_tag_id) {
                    echo "<li><span>" . $sub_cat_item->cat_title . "</span></li>";
                 } else { ?>
                    <li>
                        <a href="<?php echo $sub_term_link ?>"><?php echo $sub_cat_item->cat_title; ?></a>
                    </li>
             <?php      
                 } }
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


                $sub_menu_link  = get_home_url() . '/?tags=' . $parent_cat_slug .  '_' . $sub_menu_items->cat_title_url ;

                 //$sub_menu_link  =  get_home_url() . '/?tags=' . $sub_menu_items->cat_title_url ;


            ?>                
           
             <li>

                <?php if ($sub_menu_items->cat_id == $sub_tag_id) { ?>
                    <span><?php echo $sub_menu_items->cat_title; ?></span>
                <?php } else { ?>
                    <a href="<?php echo $sub_menu_link ?>"><?php echo $sub_menu_items->cat_title; ?></a>
                <?php 
                } ?>
              
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




<section class="spList">
  <div class="container">

    <?php 

        foreach ($product_rows as $product_item){ ?> 
           <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="spListItem">
              <p class="spListItemImg">
                <?php $link_item = get_home_url() . '/?prd=' . $parent_cat_slug . '_' . $product_item->product_sku . '_' . 
                $product_item->product_name_seo  ?>
                <a title="<?php echo $product_item->product_name;  ?>" href="<?php echo $link_item;   ?>">
                <img class="imgFit"  src="<?php echo $product_item->product_img_1;  ?>" alt="<?php echo $product_item->product_name;  ?>" /></a></p>
              <p class="spListItemTxt"><a href="<?php echo $link_item;   ?>"><?php echo $product_item->product_name;  ?></a></p>
            </div>
          </div> 
    <?php 
        } // end foreach
    ?>

    
  
  </div>
</section>



<?php  } ?>


<?php get_footer(); ?>
