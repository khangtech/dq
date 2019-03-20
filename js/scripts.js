(function ($, root, undefined) {

	$(function () {

		'use strict';

		$('#BB-nav').affix({
		offset: {
			top: $('header').height()
		}
		});


		$("#top-banner").owlCarousel({

  navigation : true,
  slideSpeed : 400,
  paginationSpeed : 400,
  autoPlay: 5000,
  singleItem : true


  });


	var owl_tes = $("#testimonial");
  owl_tes.owlCarousel({
  items : 2,
  itemsDesktop : [1000,1],
  itemsDesktopSmall : [900,1],
  itemsTablet: [600,1],
  itemsMobile : [400,1] ,
  autoPlay: 3000
  });

  $(".next1").click(function(){
	owl_tes.trigger('owl_test.next');
  })
  $(".prev1").click(function(){
	owl_tes.trigger('owl_test.prev');
  })

	var owl = $("#client");
 owl.owlCarousel({
 items : 7,
 itemsDesktop : [1000,5],
 itemsDesktopSmall : [900,3],
 itemsTablet: [767,2],
 itemsMobile : [500,1] ,
 autoPlay: 3000
 });

 $(".next2").click(function(){
 owl.trigger('owl.next');
 })
 $(".prev2").click(function(){
 owl.trigger('owl.prev');
 })

 var owl = $("#partner");
 owl.owlCarousel({
 items : 6,
 itemsDesktop : [1000,5],
 itemsDesktopSmall : [900,3],
 itemsTablet: [767,2],
 itemsMobile : [500,1] ,
 autoPlay: 3000
 });

 $(".next3").click(function(){
 owl.trigger('owl.next');
 })
 $(".prev3").click(function(){
 owl.trigger('owl.prev');
 })

 var owl = $("#newsSlideTop");
  owl.owlCarousel({
  items : 4,
  itemsDesktop : [1200,3],
  itemsDesktopSmall : [900,3],
  itemsTablet: [700,2],
  itemsMobile : [500,1] ,
  autoPlay: 3000
  });

  $(".next7").click(function(){
	owl.trigger('owl.next');
  })
  $(".prev7").click(function(){
	owl.trigger('owl.prev');
  })




	});

})(jQuery, this);
