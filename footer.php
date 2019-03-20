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


    <h4><a  href="<?php echo get_the_permalink(139); ?>"><?php

$txtGiaiPhap = $current_lang == "vi" ? "Giải pháp chính" : "Solutions" ;
echo $txtGiaiPhap	;

?></a></h4>

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
