<?php get_header(); ?>

<?php
// kiem tra no la cha hay con

$current_term = get_queried_object();
$current_lang = 	qtranxf_getLanguage() ;

//print_r($current_term);
//$current_term_link = get_term_link( $current_term );

$term_id = $current_term->term_id;
// tim lien ket cha only
$link_pim_id = get_field('cat_pim_id', $current_term);  
 
//print_r($link_pim_id); 

global $remote_pim; 
//remote_pim = new wpdb('root','','2018_pim','localhost');
$remote_pim = new wpdb('pim','Daviteq@123','pim_wepabb','192.168.10.114');


//kiem tra no la cha hay con, mac dinh < 9 là cha :)))
if (!empty($link_pim_id) &&  $link_pim_id >0 ) {
  //load cac category con cua no tren server PIM de san
  $cmd = "select * from categories where cat_parent=" . $link_pim_id  . " order by cat_id asc  " ;
 // echo $cmd;
  $sub_cat_rows = $remote_pim->get_results($cmd);
  
  
  //loop de tao tags
  if ($current_lang =="vi") {
    $tags_cloud = "";
      foreach ($sub_cat_rows as $sub_cat_item) {
          $tags_cloud .=  " '%" . trim($sub_cat_item->cat_title) . "%' or product_tags like ";
      }

      $tags_cloud = substr($tags_cloud, 0, strlen($tags_cloud)-strlen("or product_tags like")-1);
  } else {
    $tags_cloud = "";
    foreach ($sub_cat_rows as $sub_cat_item) {
        $tags_cloud .=  " '%" . trim($sub_cat_item->cat_title_en) . "%' or product_tags_en like ";
    }

    $tags_cloud = substr($tags_cloud, 0, strlen($tags_cloud)-strlen("or product_tags_en like")-1);

  }
  
  if ($current_lang =="vi") {
    $sql_select_product = "select product_id as product_id, product_sku as product_sku, product_name as product_name,product_name_seo as product_name_seo, product_img_1 as product_img_1 from products where product_active =1 and product_tags like " . $tags_cloud  ;
  } else {
    $sql_select_product = "select product_id as product_id, product_sku as product_sku, product_name_en as product_name,product_name_seo_en as product_name_seo, product_img_1_en as product_img_1 from products where product_active =1 and product_tags_en like " . $tags_cloud  ;

  }
  // load tat ca san pham
  
  $product_rows = $remote_pim->get_results($sql_select_product); 
    
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

          if ($term_item->term_id == $current_term->term_id || $term_item->term_id == $current_term->parent) {
            $menu_class = ' class="active"' ;
          } else {
            $menu_class= '';
          //  print_r($term_item->parent);
          }
        ?>
            <li <?php echo $menu_class;  ?>> <a href="<?php echo $term_link ?>"><?php echo $term_item->name; ?></a> </li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid Pc_menuInnerBot">
    <div class="tab-content container clearfix">
      <div class="tab-pane active">
        <ul>
          <?php
            if ($current_lang =="vi") { 
              foreach ($sub_cat_rows as $sub_cat_item) { 
                 $sub_term_link  =  get_home_url() . '/?tags=' . $term_id . '_' . $sub_cat_item->cat_id . '_' . $sub_cat_item->cat_title_url ;
          ?>
              <li>
                <a href="<?php echo $sub_term_link ?>"><?php echo $sub_cat_item->cat_title; ?></a>
              </li>
          <?php 
              }  } 
            else {
              foreach ($sub_cat_rows as $sub_cat_item) { 
                $sub_term_link  =  get_home_url() . '/?tags=' . $term_id . '_' . $sub_cat_item->cat_id . '_' . $sub_cat_item->cat_title_url_en ;
         ?>
             <li>
               <a href="<?php echo $sub_term_link ?>"><?php echo $sub_cat_item->cat_title_en; ?></a>
             </li>

         <?php }
        } ?>




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
              
                  $sub_menu_link  =  get_home_url() . '/?tags=' . $term_id . '_' . $sub_menu_items->cat_id . '_' . $sub_menu_items->cat_title_url ;

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




<section class="spList">
  <div class="container">
    <?php 

        foreach ($product_rows as $product_item){ ?> 
           <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="spListItem">
              <p class="spListItemImg">
                <?php $link_item = get_home_url() . '/?prd=' . $term_id . '_' . $product_item->product_sku . '_' . 
                $product_item->product_name_seo  ?>
                <a title="<?php echo $product_item->product_name;  ?>" href="<?php echo $link_item;   ?>">
                <img class="imgFit" src="<?php echo $product_item->product_img_1;  ?>" alt="<?php echo $product_item->product_name;  ?>" /></a></p>
              <p class="spListItemTxt"><a href="<?php echo $link_item;   ?>"><?php echo $product_item->product_name;  ?></a></p>
            </div>
          </div> 
    <?php 
        } // end foreach
    ?>
  
  </div>
</section>  





<?php get_footer(); ?>
