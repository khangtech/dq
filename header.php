<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<link href="favicon.ico" rel="shortcut icon">



		<?php if(isset( $wp_query->query['prd'] ) ) {
			 $query_var = $wp_query->query['prd'];
  
			 $current_lang = 	qtranxf_getLanguage() ;
		 

		 
			 //split to array de kiem tra, vi url se chua current_term_id, sub tag id cua PIM va short url cua PIM
			 $arr_check = explode("_", $query_var);
			 //print_r($arr_check);  
			 //arr 0 la cha trong cai menu hien tai
			 $parent_cat_id = $arr_check[0];
			 $product_id = $arr_check[1];

			 $pim_link_photo = 'http://pim.daviteq.com/images/';

			 global $remote_pim; 
 			// $remote_pim = new wpdb('root','','2018_pim','localhost');
				$remote_pim = new wpdb('pim','Daviteq@123','pim_wepabb','192.168.10.114');

				 //load san pham nay
         if ($current_lang=="vi") {
          $sql_select_product = "select product_id, product_sku, product_name, product_overview, product_tags, product_feature_title_1, product_feature_content_1, product_feature_title_2, product_feature_content_2, product_feature_title_3, product_feature_content_3, product_feature_title_4, product_feature_content_4, product_feature_title_5, product_feature_content_5, product_feature_title_6, product_feature_content_6, product_img_1, product_img_2, product_img_3, product_img_4, product_img_5, product_img_6, product_img_7, product_img_8, product_spec, product_docs, product_video, product_sell, product_related, product_name_seo from products where product_active =1 and product_id =" .  $product_id  ;

         } else {

          $sql_select_product = "select product_id, product_sku, product_name_en as product_name , product_overview_en as product_overview, product_tags_en as product_tags, product_feature_title_1_en as product_feature_title_1, product_feature_content_1_en as product_feature_content_1, product_feature_title_2_en as product_feature_title_2, product_feature_content_2_en as product_feature_content_2, product_feature_title_3_en as product_feature_title_3, product_feature_content_3_en as product_feature_content_3, product_feature_title_4_en as product_feature_title_4, product_feature_content_4_en as product_feature_content_4, product_feature_title_5_en as product_feature_title_5, product_feature_content_5_en as product_feature_content_5, product_feature_title_6_en as product_feature_title_6, product_feature_content_6_en as product_feature_content_6, product_img_1_en as product_img_1, product_img_2_en as product_img_2, product_img_3_en as product_img_3, product_img_4_en as product_img_4, product_img_5_en as product_img_5, product_img_6_en as product_img_6, product_img_7_en as product_img_7, product_img_8_en product_img_8, product_spec_en as product_spec, product_docs_en as product_docs, product_video_en as product_video, product_sell_en as product_sell, product_related_en as product_related, product_name_seo_en as product_name_seo from products where product_active =1 and product_id =" .  $product_id  ;

         }

        //  echo $sql_select_product;
  
					$product_items = $remote_pim->get_results($sql_select_product);
					

					foreach ($product_items as $product_item) {
						$id_san_pham = $product_item->product_id;
						$ma_san_pham = $product_item->product_sku;
						$ten_san_pham = $product_item->product_name;
						$gioi_thieu =   $product_item->product_overview; 
						$link_seo = $product_item->product_name_seo;
						$share_link = get_home_url() . '/?prd=' . $parent_cat_id . '_' 
      			. $id_san_pham . '_' . $link_seo  ;
				
					//load hinh vao array, lay 3 hinh only
					if (!empty($product_item->product_img_1)) {
							$photo_1 = $pim_link_photo . $ma_san_pham .  ($current_lang=="vi" ? '_1.jpg': '_en_1.jpg') ;
						
					}

					}
	
					?>

			<!-- META FOR FACEBOOK -->
<meta content="<?php bloginfo('name'); ?>" property="og:site_name"/>
<meta property="og:url" itemprop="url" content="<?php echo $share_link; ?>"/>
<meta property="og:image" itemprop="thumbnailUrl" content="<?php echo $photo_1; ?>"/>
<meta content="<?php echo $ten_san_pham; ?>" itemprop="headline" property="og:title"/>
<meta content="<?php echo $gioi_thieu; ?>" itemprop="description" property="og:description"/>

<meta content="article" property="og:type"/> <!-- END META FOR FACEBOOK -->
					
		<?php } else { 


global $wp_query;
$page_id = $wp_query->post->ID;
$page_object = get_page( $page_id );
$page_content =  $page_object->post_excerpt;
$page_excerpt = wp_trim_words($page_content);


			?>


			<!-- META FOR FACEBOOK -->
<meta content="<?php bloginfo('name'); ?>" property="og:site_name"/>
<meta property="og:url" itemprop="url" content="<?php the_permalink(); ?>"/>
<meta property="og:image" itemprop="thumbnailUrl" content="<?php the_post_thumbnail_url(); ?>"/>
<meta content="<?php the_title(); ?>" itemprop="headline" property="og:title"/>
<meta content="<?php echo $page_excerpt; ?>" itemprop="description" property="og:description"/>

<meta content="article" property="og:type"/> <!-- END META FOR FACEBOOK -->


		<?php 
		} ?>

	



		<?php wp_head(); ?>

	</head>

	<nav class="navbar navbar-default affix-top" role="navigation" id="BB-nav">
  <div class="container-fluid">
    <div class="container-fluid nav-container header clearfix">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".BB-nav"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			<ul class="nav navbar-nav navbar-left nav-pills logo">
	        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/logo.png" alt="" /></a></li>
	      </ul>
      <div id="pc-menu">

					<?php

					wp_nav_menu( array(
    				'theme_location' => 'header-menu'	,
						'container' => 'ul',
						'menu_class' => 'nav navbar-nav BB-nav collapse navbar-collapse menu',
					) );

					?>

      </div>
      <div id="mobile-menu">
				<?php

				wp_nav_menu( array(
					'theme_location' => 'header-menu'	,
					'container' => 'ul',
					'menu_class' => 'nav navbar-nav BB-nav collapse navbar-collapse menu',
				) );

				?>
        </ul>
      </div>
			<div class="hRight">
			<div class="hSearch clearfix">
				<form  role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="text" id="s" name="s" value="" />
					<input type="image" class="icoSearch" src="<?php echo get_stylesheet_directory_uri() ?>/img/icoS.png" alt="" />
				</form>
			</div>
			<?php
  				$current_lang = 	qtranxf_getLanguage() ;
					
					$link_quote = $current_lang=="vi"?'/lien-he':'/en/contact-us';

			?>
			<p class="quote"><a href="<?php echo get_site_url() . $link_quote; ?>"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/getqoute.png" alt="" /></a></p>
			<ul class="language clearfix">
				  <?php dynamic_sidebar('language-switcher'); ?>
			</ul>
		</div>
    </div>
  </div>
</nav>
