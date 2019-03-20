<?php get_header(); ?>


<?php
$current_lang = 	qtranxf_getLanguage() ;
?>

<?php
           $about_intro = ($current_lang =="vi")?get_field('noi_dung',144):get_field('thong_tin_en',153);
           $photo_intro =  ($current_lang =="vi")?get_field('hinh_minh_hoa',144):get_field('hinh_minh_hoa_en',155);

           $about_intro_2 = ($current_lang =="vi")?get_field('noi_dung_2',144):get_field('thong_tin_2_en',153);
           $photo_intro_2 =  ($current_lang =="vi")?get_field('hinh_minh_hoa_2',144):get_field('hinh_minh_hoa_2_en',155);

?>


<section class="Pc_menuInner2 clearfix">
  <div class="container-fluid">
    <div class="container">
      <div class="row">
      <ul class="clearfix">
        <?php if ($current_lang=="vi") { ?>
          <li><a href="<?php echo esc_url( get_permalink(144) ); ?>"><?php echo 'Giới thiệu Daviteq' ?></a></li>
            <li><a href="<?php echo esc_url( get_permalink(160) ); ?>" class="active"><?php echo 'Tin tức' ?></a></li>
            <li><a href="<?php echo esc_url( get_permalink(162) ); ?>"><?php echo 'Liên hệ' ?></a></li>
      <?php } else { ?>
        <li><a href="<?php echo esc_url( get_permalink(144) ); ?>" ><?php echo 'About Daviteq' ?></a></li>
          <li><a href="<?php echo esc_url( get_permalink(160) ); ?>" class="active"><?php echo 'News' ?></a></li>
          <li><a href="<?php echo esc_url( get_permalink(162) ); ?>"><?php echo 'Contact' ?></a></li>
      <?php
      } ?>

      </ul>
    </div>
    </div>
  </div>
</section>
<section class="m_menuInner2">
  <div class="container-fluid">
    <div class="container">
          <div class="row">
            <ul class="clearfix">
              <?php if ($current_lang=="vi") { ?>
                <li><a href="<?php echo esc_url( get_permalink(144) ); ?>"><?php echo 'Giới thiệu Daviteq' ?></a></li>
                  <li><a href="<?php echo esc_url( get_permalink(160) ); ?>" class="active"><?php echo 'Tin tức' ?></a></li>
                  <li><a href="<?php echo esc_url( get_permalink(162) ); ?>"><?php echo 'Liên hệ' ?></a></li>
            <?php } else { ?>
              <li><a href="<?php echo esc_url( get_permalink(153) ); ?>" ><?php echo 'About Daviteq' ?></a></li>
                <li><a href="<?php echo esc_url( get_permalink(170) ); ?>" class="active"><?php echo 'News' ?></a></li>
                <li><a href="<?php echo esc_url( get_permalink(172) ); ?>"><?php echo 'Contact' ?></a></li>
            <?php
            } ?>

            </ul>
    </div>
    </div>
  </div>
</section>
<section class="path">
  <div class="container">
    <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
      
    <ul class="clearfix">
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo $current_lang=="vi" ? "Trang chủ" : "Home" ?></a> &gt;</li>
        <li><a href="<?php echo get_the_permalink(160); ?>"><?php echo $current_lang=="vi" ? "Tin tức" : "News" ?></a>  &gt;</li>
        <li><?php the_title() ?></li>
      </ul>


    </div>
  </div>
  </div>
</section>



<section class="introduction">
  <div class="container">
    <div class="newsCT clearfix">
      <div class="col-sm-8 col-md-8 col-lg-8">
        <div class="newsCTL">
          <div class="newsCTBox">
						  <?php if (have_posts()): while (have_posts()) : the_post(); ?>

									<p class="newsDate"><?php echo get_the_date( 'd/m/Y' ); ?></p>
  								<h2><?php the_title(); ?></h2>

									<?php the_content() ?>

								<?php endwhile; endif; ?>
          </div>
          <div class="newShare clearfix">
            <dl class="clearfix">
              <dt>Chia sẻ</dt>
              <dd> <a href="#"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/icoF.jpg" alt="" /></a>
								    <a href="#"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/icoG.jpg" alt="" /></a> </dd>
            </dl>
            <ul class="clearfix">
              <li><a href="#">In trang này</a></li>
              <li><a href="#">Quay lại trang trước</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-4 col-md-4 col-lg-4">
        <div class="newsCTR">
          <h3>Tin mới</h3>
          <ul class="clearfix">
          	<?php

						$args = array (
							'posts_per_page' => 8,
							'order' => 'DESC',
							'orderby' => 'date'
						);
						$latest_news = new WP_Query($args);
						while ($latest_news->have_posts()) :
								$latest_news->the_post();
								$do_not_duplicate[]= $post->ID;
						?>


						<li class="clearfix">
							<p class="newsRimg"><a href="<?php the_permalink() ?>"><img src="<?php echo the_post_thumbnail_url('right_thumb_news') ?>" alt="<?php the_title() ?>" /></a></p>
							<div class="newsRtxt">
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<p><?php echo get_the_date( 'd/m/Y' ); ?></p>
							</div>
						</li>



						<?php
											endwhile; wp_reset_postdata();
						?>








          </ul>
        </div>
      </div>
    </div>
		<!--
    <div class="newsSlide">
      <h2 class="shTtl">Tin liên quan</h2>
      <div id="newsSlide" class="owl-carousel">
        <div class="item">
          <p class="newsSlideImg"><a href="#"><img src="images/news3.jpg" alt="" /></a></p>
          <div class="newsSlideTxt">
            <h3><a href="#">Masan khánh thành dự án tại Nghệ An</a></h3>
            <p>Trong 3 ngày tham gia triển lãm tại Hội chợ SPS IPC Drives 2015 tại Nuremberg, Đức ...<span>03-05-2017</span></p>
          </div>
        </div>
        <div class="item">
          <p class="newsSlideImg"><a href="#"><img src="images/news3.jpg" alt="" /></a></p>
          <div class="newsSlideTxt">
            <h3><a href="#">Masan khánh thành dự án tại Nghệ An</a></h3>
            <p>Trong 3 ngày tham gia triển lãm tại Hội chợ SPS IPC Drives 2015 tại Nuremberg, Đức ...<span>03-05-2017</span></p>
          </div>
        </div>
        <div class="item">
          <p class="newsSlideImg"><a href="#"><img src="images/news3.jpg" alt="" /></a></p>
          <div class="newsSlideTxt">
            <h3><a href="#">Masan khánh thành dự án tại Nghệ An</a></h3>
            <p>Trong 3 ngày tham gia triển lãm tại Hội chợ SPS IPC Drives 2015 tại Nuremberg, Đức ...<span>03-05-2017</span></p>
          </div>
        </div>
        <div class="item">
          <p class="newsSlideImg"><a href="#"><img src="images/news3.jpg" alt="" /></a></p>
          <div class="newsSlideTxt">
            <h3><a href="#">Masan khánh thành dự án tại Nghệ An</a></h3>
            <p>Trong 3 ngày tham gia triển lãm tại Hội chợ SPS IPC Drives 2015 tại Nuremberg, Đức ...<span>03-05-2017</span></p>
          </div>
        </div>
        <div class="item">
          <p class="newsSlideImg"><a href="#"><img src="images/news3.jpg" alt="" /></a></p>
          <div class="newsSlideTxt">
            <h3><a href="#">Masan khánh thành dự án tại Nghệ An</a></h3>
            <p>Trong 3 ngày tham gia triển lãm tại Hội chợ SPS IPC Drives 2015 tại Nuremberg, Đức ...<span>03-05-2017</span></p>
          </div>
        </div>
        <div class="item">
          <p class="newsSlideImg"><a href="#"><img src="images/news3.jpg" alt="" /></a></p>
          <div class="newsSlideTxt">
            <h3><a href="#">Masan khánh thành dự án tại Nghệ An</a></h3>
            <p>Trong 3 ngày tham gia triển lãm tại Hội chợ SPS IPC Drives 2015 tại Nuremberg, Đức ...<span>03-05-2017</span></p>
          </div>
        </div>
        <div class="item">
          <p class="newsSlideImg"><a href="#"><img src="images/news3.jpg" alt="" /></a></p>
          <div class="newsSlideTxt">
            <h3><a href="#">Masan khánh thành dự án tại Nghệ An</a></h3>
            <p>Trong 3 ngày tham gia triển lãm tại Hội chợ SPS IPC Drives 2015 tại Nuremberg, Đức ...<span>03-05-2017</span></p>
          </div>
        </div>
      </div>
      <div class="customNavigation"> <a class="prev4"><img src="images/prev2.png" alt="" /></a> <a class="next4"><img src="images/next2.png" alt="" /></a></div>
    </div> -->
  </div>
</section>


<?php get_footer(); ?>
