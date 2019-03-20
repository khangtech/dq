<?php get_header(); ?>
<section class="Pc_menuInner">
  <div class="container-fluid Pc_menuInnerTop">
    <div class="container">
      <ul  class="nav nav-pills">
        <?php

          $current_term = get_queried_object();
          $current_term_link = get_term_link( $current_term );

          $link_pim_id = get_field('cat_pim_id', $current_term);

          echo "day la" . $link_pim_id;
/*
          WP_Term Object ( [term_id] => 50 [name] => Komoto Ball Valves [slug] => komoto-ball-valves [term_group] => 0 [term_taxonomy_id] => 50 [taxonomy] => chung-loai [description] => [parent] => 31 [count] => 0 [filter] => raw [term_order] => 0 ) */

          $terms_list = get_terms( array(
          'taxonomy' => 'chung-loai',
          'hide_empty' => 0,
          'parent' => 0,
        ) );

        //  print_r($current_term);


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

          if ($current_term->parent >0  ) {
            $sub_terms_list = get_terms( array(
            'taxonomy' => 'chung-loai',
            'hide_empty' => 0,
            'parent' =>  $current_term->parent,
            ) );

          } else {
            $sub_terms_list = get_terms( array(
            'taxonomy' => 'chung-loai',
            'hide_empty' => 0,
            'parent' =>  $current_term->term_id,
            ) );

          }


          foreach ($sub_terms_list as $sub_term)  { ?>
          <?php  $sub_term_link = get_term_link( $sub_term);

              if ($sub_term->term_id == $current_term->term_id) {
                $menu_sub_class = ' class="active"';
              } else {
                $menu_sub_class = '';
              }

          ?>
              <li><a <?php echo $menu_sub_class; ?> href="<?php echo $sub_term_link ?>"><?php echo $sub_term->name; ?></a></li>

          <?php } ?>

        </ul>
      </div>

    </div>
  </div>
</section>
<section class="m_menuInner">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">

      <?php

      foreach ($terms_list as $term_item) {
         $term_link = get_term_link( $term_item ); ?>

         <div class="panel-heading">
           <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" class="collapsed" href="#m_sp<?php echo $term_item->term_id ?>"><?php echo $term_item->name ?></a> </h4>
         </div>

        <div id="m_sp<?php echo $term_item->term_id ?>" class="panel-collapse collapse">
              <ul class="m_suBmenu">
                <?php


                $sub_terms_list = get_terms( array(
                'taxonomy' => 'chung-loai',
                'hide_empty' => 0,
                'parent' =>  $term_item->term_id,
                ) );

                foreach ($sub_terms_list as $sub_term)  {
                  $sub_term_link = get_term_link( $sub_term);  ?>
                    <li><a href="<?php echo $sub_term_link ?>"><?php echo $sub_term->name ?></a></li>
              <?php } ?>
              </ul>
        </div>

      <?php }  ?>

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
<section class="spList">
  <div class="container">
    <div class="row">
      <?php
            $args = array (
                 'post_type' => 'san-pham',
                 'posts_per_page' => 16,
                 'orderby' => 'menu_order',
                 'order' => 'ASC',
                 'tax_query' => array(
                   array(
                     'taxonomy' => 'chung-loai',
                     'field' => 'slug',
                     'terms' => $current_term->slug,
                   ),
                 ),
             );
             $list_product = new WP_Query($args);

            while ($list_product->have_posts()) : $list_product->the_post();?>


            <div class="col-sm-4 col-md-4 col-lg-4">
              <div class="spListItem">
                <p class="spListItemImg"><a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php the_title(); ?>" /></a></p>
                <p class="spListItemTxt"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
              </div>
            </div>

    <?php endwhile ; wp_reset_postdata(); ?>



    </div>
  </div>
</section>



<?php get_footer(); ?>
