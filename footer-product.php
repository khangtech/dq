<?php
  $current_lang = 	qtranxf_getLanguage() ;
  //echo "day la" . $current_lang;
  $current_path = get_template_directory_uri();
	$current_style_path = get_stylesheet_directory_uri();

?>

<section class="footer">
<div class="container">
	<div class="row">
	<div class="footerInner clearfix">
		<div class="fInfo">
		<div class="col-sm-2 fInfo">
      <h4><?php
      		$txtSanPham = $current_lang == "vi" ? "Sản phẩm chính" : "Products" ;
      		echo $txtSanPham;
		      ?>
      </h4>
				<?php

        global $term_product_do_not_duplicate;

				$terms_list = get_terms( array(
				'taxonomy' => 'chung-loai',
				'hide_empty' => 0,
        'number' => 3,
				'parent' => 0,
			) );

			?>
			<ul>
			<?php
			foreach ($terms_list as $term_item) {
				 $term_link = get_term_link( $term_item );
         $term_product_do_not_duplicate[]= $term_item->term_id;
			?>
					<li <?php echo $menu_class;  ?>> <a href="<?php echo $term_link ?>"><?php echo $term_item->name; ?></a> </li>
      <?php } ?>

		  </ul>

		</div>

    <div class="col-sm-2 fInfo">
      <h4>&nbsp;</h4>
        <?php
        $terms_list = get_terms( array(
        'taxonomy' => 'chung-loai',
        'hide_empty' => 0,
        'parent' => 0,
        'exclude' => $term_product_do_not_duplicate
      ) );

      ?>
      <ul>
      <?php
      foreach ($terms_list as $term_item) {
         $term_link = get_term_link( $term_item );
      ?>
          <li <?php echo $menu_class;  ?>> <a href="<?php echo $term_link ?>"><?php echo $term_item->name; ?></a> </li>
      <?php } ?>

      </ul>

    </div>


		<div class="col-sm-2 fInfo">
<h4><?php

$txtGiaiPhap = $current_lang == "vi" ? "Giải pháp chính" : "Solutions" ;
echo $txtGiaiPhap	;

?></h4>

<ul>
	<?php
  global $term_do_not_duplicate;
	$terms =  get_terms( array(
			'taxonomy' => 'loai-giai-phap',
			'parent' => 0,
			'hide_empty'    => false ,
      'number' => 5,
			'orderby' => 'term_id',

	));
	foreach ($terms as $term) {
			$term_link  = get_term_link( $term );
      $term_do_not_duplicate[]= $term->term_id;

	?>
	<li><a href="<?php echo $term_link;  ?>"><?php echo $term->name ?></a></li>

	<?php } ?>

</ul>

    <?php //print_r($term_do_not_duplicate); ?>

		</div>

    <div class="col-sm-2 fInfo">
      <h4>&nbsp;</h4>
<ul>
	<?php
	$terms =  get_terms( array(
			'taxonomy' => 'loai-giai-phap',
			'parent' => 0,
			'hide_empty'    => false ,
			'orderby' => 'term_id',
      'exclude' => $term_do_not_duplicate,
	));
	foreach ($terms as $term) {
			$term_link  = get_term_link( $term )
	?>
	<li><a href="<?php echo $term_link;  ?>"><?php echo $term->name ?></a></li>

	<?php } ?>

</ul>

		</div>


		<div class="col-sm-4 fInfo">

			<?php
			$ten_cong_ty = get_field('ten_cong_ty',162);
			$dia_chi =   get_field('dia_chi',162);
			$tel =   get_field('tel',162);
      $fax =   get_field('fax',162);
			$email_lien_he  = get_field('email_lien_he',162);
			$google_map = get_field('google_map',162);

			?>
			<h4><?php echo $ten_cong_ty; ?></h4>

			<p><span><?php

			//echo pll_e('Sản phẩm')
			$txtDiaChi = $current_lang == "vi" ? "Địa chỉ" : "Address" ;
			echo $txtDiaChi;


			?></span>: &nbsp;<?php echo $dia_chi ?><br />
				<span>Tel:</span>&nbsp;<?php echo $tel ?> - <span>Fax:</span>&nbsp;<?php echo $fax; ?><br />
				<span>Email:</span>&nbsp;<?php echo $email_lien_he ?><br />
				<!--<span>Email:</span> info@daviteq.com
   -->
			 </p>

       <ul class="social clearfix">
          <?php 
          		$args = array(
          			'post_type' => 'social_link',
          		);
          		$social_list = new WP_Query($args);
          		if ($social_list->have_posts()){
              while($social_list->have_posts()) : $social_list->the_post(); ?>
              <?php
                $social_media_link = get_field("link_social", $post->ID);
               
              ?>
             <li><a href="<?php echo $social_media_link;?>"><img src="<?php echo the_post_thumbnail_url(); ?>" alt="" /></a></li>
          <?php endwhile; wp_reset_postdata(); } ?>
        </ul>

        <p><strong>Copyright by Daviteq</strong> - Allright Reserved</p>

		</div>
	</div>
	</div>

</div>



</div>

<div class="bottomFooter">
	<div class="line_bottom">
	        	<div class="forn_left"></div>
	        </div>
</div>

</section>

		<!-- /wrapper -->

		<script>
		
jQuery(document).ready(function() {


  var sync1 = jQuery("#sync1");
  var sync2 = jQuery("#sync2");

  sync1.owlCarousel({
	singleItem : true,
	slideSpeed : 1000,
	navigation: false,
	pagination:false,
	afterAction : syncPosition,
	responsiveRefreshRate : 200,
  });

  sync2.owlCarousel({
	items : 4,
	itemsDesktop      : [1199,4],
	itemsDesktopSmall     : [979,3],
	itemsTablet       : [767,3],
	itemsMobile       : [479,2],
	pagination:false,
  navigation: true,
	responsiveRefreshRate : 100,
	afterInit : function(el){
	  el.find(".owl-item").eq(0).addClass("synced");
	}
  });

  function syncPosition(el){
	var current = this.currentItem;
	jQuery("#sync2")
	  .find(".owl-item")
	  .removeClass("synced")
	  .eq(current)
	  .addClass("synced")
	if(jQuery("#sync2").data("owlCarousel") !== undefined){
	  center(current)
	}

  }

  jQuery("#sync2").on("click", ".owl-item", function(e){
	e.preventDefault();
	var number = jQuery(this).data("owlItem");
	sync1.trigger("owl.goTo",number);
  });

  function center(number){
	var sync2visible = sync2.data("owlCarousel").owl.visibleItems;

	var num = number;
	var found = false;
	for(var i in sync2visible){
	  if(num === sync2visible[i]){
		var found = true;
	  }
	}

	if(found===false){
	  if(num>sync2visible[sync2visible.length-1]){
		sync2.trigger("owl.goTo", num - sync2visible.length+2)
	  }else{
		if(num - 1 === -1){
		  num = 0;
		}
		sync2.trigger("owl.goTo", num);
	  }
	} else if(num === sync2visible[sync2visible.length-1]){
	  sync2.trigger("owl.goTo", sync2visible[1])
	} else if(num === sync2visible[0]){
	  sync2.trigger("owl.goTo", num-1)
	}
  }

});
</script> 
<script type="text/javascript">
 jQuery(document).ready(function () {
	jQuery('.collapse.in').prev('.panel-heading').addClass('active');
	jQuery('#accordion, #bs-collapse')
		.on('show.bs.collapse', function (a) {
			jQuery(a.target).prev('.panel-heading').addClass('active');
		})
		.on('hide.bs.collapse', function (a) {
			jQuery(a.target).prev('.panel-heading').removeClass('active');
		});
});
</script> 
<script>
jQuery(document).ready(function() {
  var owl = jQuery("#productSlide");
  owl.owlCarousel({
  items : 4,
  itemsDesktop : [1200,4],
  itemsDesktopSmall : [900,3],
  itemsTablet: [700,2],
  itemsMobile : [500,1] ,
  autoPlay: 3000
  });

  jQuery(".next5").click(function(){
	owl.trigger('owl.next');
  })
  jQuery(".prev5").click(function(){
	owl.trigger('owl.prev');
  })
});
</script>


		<?php wp_footer(); ?>



		<!-- analytics -->
		<script>
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		ga('send', 'pageview');
		</script>

	</body>
</html>
