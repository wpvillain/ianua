/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.

/** 
 * ===================================================================
 * main js
 *
 * ------------------------------------------------------------------- 
 */ 

(function($) {

	"use strict";

	/*---------------------------------------------------- */
	/* Preloader
	------------------------------------------------------ */ 
   $(window).load(function() {

      // will first fade out the loading animation 
    	$("#loader").fadeOut("slow", function(){

        // will fade out the whole DIV that covers the website.
        $("#preloader").delay(300).fadeOut("slow");       

      });       

  	});


  	/*---------------------------------------------------- */
	/* Nice Select
	------------------------------------------------------ */ 
	$('.niceselect').niceSelect();


   
   /*---------------------------------------------------- */
	/* JqueryUI Slider
	------------------------------------------------------ */ 
	var priceSlider = $(".price_slider"),
	    priceLabel = $(".price_label"),
	    priceMin = $('#min_price'),
	    priceMax =	$('#max_price');
        
	priceSlider.slider({
      range: true,
      min: 0,
      max: 1000,
      values: [ 100, 900 ],
      slide: function( event, ui ) {
      	priceLabel.text( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        	priceMin.attr('value', ui.values[ 0 ]);
        	priceMax.attr('value', ui.values[ 1 ]); 
      }
   });

   priceLabel.text( "$" + priceSlider.slider( "values", 0 ) +
                 " - $" + priceSlider.slider( "values", 1 ) );

   priceMin.attr('value', priceSlider.slider( "values", 0 ));
   priceMax.attr('value', priceSlider.slider( "values", 1 ) ); 


   /*---------------------------------------------------- */
	/* Quantity Incrementer
	------------------------------------------------------ */ 
	var qty = $('.product-quantity');

	qty.find('a').on('click', function(e) {

		var el = $(this),
          theInput = el.parent().find('input'),
          oldValue = theInput.val(),
          newVal;
                
   	e.preventDefault();

      if (el.hasClass('plus')) {
         newVal = parseFloat(oldValue) + 1;
      } else if (el.hasClass('minus')) {
         newVal = (oldValue > 1) ? parseFloat(oldValue) - 1 : 1;
      }

      theInput.val(newVal);
      
   });


   /*---------------------------------------------------- */
	/* Slide Trigger
	------------------------------------------------------ */
	var slideTrigger = $('.slide-trigger'); 	

	slideTrigger.on('click', function(e) {

		var slideTarget = $(this).data("target"),
		    hasCheckbox = $(this).hasClass("has-checkbox"),
		    triggerCheckbox = $(this).children(":checkbox");

		$(slideTarget).slideToggle();

		// if trigger has checkbox, toggle checkbox value
		if (hasCheckbox && triggerCheckbox.length > 0) {
			// triggerCheckbox.prop("checked", !triggerCheckbox[0].checked);
			triggerCheckbox.prop("checked", !triggerCheckbox.is(":checked"));	
		}

		e.preventDefault();

	}); 


   /*---------------------------------------------------- */
	/* RATY - jQuery Rating Plugin
	------------------------------------------------------ */
	$(".raty").raty({
      half: true,
      starType: 'i',
      readOnly: function () {
         return $(this).data('readonly');
      },
      score: function () {
         return $(this).data('score');
      },
      starOff: 'fa fa-star-o',
      starOn: 'fa fa-star',
      starHalf: 'fa fa-star-half-o'
   });   


   /*---------------------------------------------------- */
	/* Magnific Popup
	------------------------------------------------------ */  
	$('.magnific-wrap').each(function () {
   
      var $this = $(this);

      $this.find('.magnific').magnificPopup({
         type: 'image',
         tLoading: '', 
         // fixedContentPos: false,           
         gallery: {
            enabled: true,
            navigateByImgClick: true
         },
         image: {
            titleSrc: function (item) {
            	return item.el.attr('title');
            }
         },
            removalDelay: 200,
            mainClass: 'mfp-fade',
         callbacks: {
			   open: function() {
			    $('html').css({ 'margin-right': 0 });
			  }
			}

      });
   });     



   /*---------------------------------------------------- */
	/* FitVids
	------------------------------------------------------ */ 
  	$(".fluid-video-wrapper").fitVids();


  	/*---------------------------------------------------- */
	/* code-prettify
	------------------------------------------------------ */ 
	$('pre').addClass('prettyprint');
	$( document ).ready(function() {
		
    	prettyPrint();
		
  	});
	
	
  	/*----------------------------------------------------*/
  	/* Flexslider
  	/*----------------------------------------------------*/
  	$(window).load(function() {

	  	$('#hero-slider').flexslider({
	   	namespace: "flex-",
	      controlsContainer: ".hero-content",
	      animation: 'fade',
	      controlNav: true,
	      directionNav: true,
	      smoothHeight: true,
	      slideshowSpeed: 7000,
	      animationSpeed: 600,
	      randomize: false,
	      touch: true,
	      before: function(slider){
			   $(slider).find(".animated").each(function(){
			   	$(this).removeClass("animated show fadeInUp fadeInRight");
			  	});			  	
			},
			start: function(slider){
			   $(slider).find(".flex-active-slide")
			           	.find("h1, .button").addClass("animated fadeInRight show")
			           	.next("h3").addClass("animated fadeInUp show")
			           	.next("hr").addClass("animated fadeInRight show");

			           		
			   $(window).trigger('resize');		  			 
			},
			after: function(slider){
			 	$(slider).find(".flex-active-slide")
			           	.find("h1, .button").addClass("animated fadeInRight show")
			           	.next("h3").addClass("animated fadeInUp show")
			           	.next("hr").addClass("animated fadeInRight show");			  
			}
	   });

	   $('#testimonial-slider').flexslider({
	   	namespace: "flex-",
	      controlsContainer: "",
	      animation: 'slide',
	      controlNav: true,
	      directionNav: false,
	      smoothHeight: true,
	      slideshowSpeed: 7000,
	      animationSpeed: 600,
	      randomize: false,
	      touch: true,
	   });

	   $('.post-slider').flexslider({
	   	namespace: "flex-",
	      controlsContainer: "",
	      animation: 'fade',
	      controlNav: true,
	      directionNav: false,
	      smoothHeight: false,
	      slideshowSpeed: 7000,
	      animationSpeed: 600,
	      randomize: false,
	      touch: true,
	      start: function (slider) {
				if (typeof slider.container === 'object') {
					slider.container.on("click", function (e) {
						if (!slider.animating) {
							slider.flexAnimate(slider.getTarget('next'));
						}
					});
				}
			}
	   });

	   $('.featured-post-slider').flexslider({
	   	namespace: "flex-",
	      controlsContainer: "",
	      animation: 'fade',
	      controlNav: false,
	      directionNav: true,
	      smoothHeight: true,
	      slideshowSpeed: 7000,
	      animationSpeed: 600,
	      randomize: false,
	      touch: true,

	   });

	   $('.product-slider').flexslider({
	   	namespace: "flex-",
	      controlsContainer: "",
	      animation: 'fade',
	      controlNav: false,
	      directionNav: true,
	      smoothHeight: false,
	      slideshowSpeed: 7000,
	      animationSpeed: 600,
	      randomize: false,
	      touch: true,	      
	   });

   });


	/*---------------------------------------------------- */
  	/* Isotope
  	------------------------------------------------------ */
  	var containerProjects = $('.iw-projects');
  	var containerProducts = $('.iw-products');
		
	$('.iw-projects, .iw-products').imagesLoaded( function() {
			
		containerProjects.isotope( {
			transitionDuration: '0.3s',
			itemSelector: '.folio-item',
	 		resizesContainer: true,
	 		isResizeBound: true,
	 		layoutMode: 'masonry'	
		});

		containerProducts.isotope( {
			transitionDuration: '0.3s',
			itemSelector: '.product-item',
	 		resizesContainer: true,
	 		isResizeBound: true,
	 		layoutMode: 'masonry'	
		});

		// container.isotope();

		/* Filtering */ 
		$('.filter-group a').on( 'click', function(e) {
			
			var b = $(this).attr('data-filter'),
			    c = $(".project-filter a"),
			    d = ("active");			    

			e.preventDefault();
			containerProjects.isotope({ filter: b });
			c.removeClass(d);
			$(this).addClass(d);

			return false;
		});		
			
	});

  
   /*-----------------------------------------------------*/
  	/* Mobile Menu
   ------------------------------------------------------ */  
   var menuIcon = $("<span class='menu-icon'>Menu</span>");
  	var toggleButton = $("<a>", {                         
                        id: "toggle-btn", 
                        html : "",
                        title: "Menu",
                        href : "#" } 
                        );
  	var navWrap = $('#nav-wrap');
  	var navContents = $("nav#nav-contents");  
   
   /* if JS is enabled, remove the two a.mobile-btns 
  	and dynamically prepend a.toggle-btn to #nav-wrap */
  	navWrap.find('a.mobile-btn').remove(); 
  	toggleButton.append(menuIcon); 
   navWrap.prepend(toggleButton); 

  	toggleButton.on("click", function(e) {
   	e.preventDefault();
    	navContents.slideToggle("fast");     
  	});

  	if (toggleButton.is(':visible')) { 
			navContents.addClass('mobile'); 
		}
  	$(window).resize(function() {
   	if (toggleButton.is(':visible')) {	
			navContents.addClass('mobile'); 
		}	else {
			navContents.removeClass('mobile'); 
		}
  	});

  	$('ul#nav li a').on("click", function() {      
   	if (navContents.hasClass('mobile')) { 
			navContents.fadeOut('fast'); 
		}      
  	});


  	/*-----------------------------------------------------*/
  	/* superfish
   ------------------------------------------------------ */ 
   $('ul.sf-menu').superfish({

   	animation: { height:'show' }, // slide-down effect without fade-in
		animationOut: { height:'hide'}, // slide-up effect without fade-in			
		cssArrows: false, // disable css arrows	
		delay: 600 // .6 second delay on mouseout
		
	});


  	/*----------------------------------------------------*/
  	/* Smooth Scrolling
  	------------------------------------------------------*/
  	$('.smoothscroll').on('click', function (e) {
	 	
	 	e.preventDefault();

   	var target = this.hash,
    	$target = $(target);

    	$('html, body').stop().animate({
       	'scrollTop': $target.offset().top
      }, 800, 'swing', function () {
      	window.location.hash = target;
      });

  	});  
  

   /*----------------------------------------------------*/
	/*  Placeholder Plugin Settings
	------------------------------------------------------*/ 
	$('input, textarea, select').placeholder();  


	/*---------------------------------------------------- */
   /* ajaxchimp
	------------------------------------------------------ */

	// Example MailChimp url: http://xxx.xxx.list-manage.com/subscribe/post?u=xxx&id=xxx
	var mailChimpURL = 'http://facebook.us8.list-manage.com/subscribe/post?u=cdb7b577e41181934ed6a6a44&amp;id=e65110b38d';


	$('#mc-form').ajaxChimp({

		language: 'es',
	   url: mailChimpURL

	});

	// Mailchimp translation
	//
	//  Defaults:
	//	 'submit': 'Submitting...',
	//  0: 'We have sent you a confirmation email',
	//  1: 'Please enter a value',
	//  2: 'An email address must contain a single @',
	//  3: 'The domain portion of the email address is invalid (the portion after the @: )',
	//  4: 'The username portion of the email address is invalid (the portion before the @: )',
	//  5: 'This email address looks fake or invalid. Please enter a real email address'

	$.ajaxChimp.translations.es = {
	  'submit': 'Submitting...',
	  0: '<i class="fa fa-check"></i> We have sent you a confirmation email',
	  1: '<i class="fa fa-warning"></i> You must enter a valid e-mail address.',
	  2: '<i class="fa fa-warning"></i> E-mail address is not valid.',
	  3: '<i class="fa fa-warning"></i> E-mail address is not valid.',
	  4: '<i class="fa fa-warning"></i> E-mail address is not valid.',
	  5: '<i class="fa fa-warning"></i> E-mail address is not valid.'
	};

   
	/*-----------------------------------------------------*/
  	/* close button
   -------------------------------------------------------*/ 
	$('#search-trigger, .mobile-search-trigger').on('click', function(e) {
		e.preventDefault();		
		$('#header-search').addClass('is-visible');	
		// $('#header-search').find('input.search-field').focus();	
		
	});

	//close the testimonials modal page
	$('#header-search .close-btn').on('click', function(e) {
		e.preventDefault();
		$('#header-search').removeClass('is-visible');
	});


	/*-----------------------------------------------------*/
	/* Alert Boxes
  	-------------------------------------------------------*/
	$('.alert-box').on('click', '.close', function() {
	  $(this).parent().fadeOut(500);
	});	


	/*-----------------------------------------------------*/
	/* Accordion
  	-------------------------------------------------------*/
	
	// Add Inactive Class To All Accordion Headers
	$('.accordion-header').toggleClass('inactive-header');

	// Set The Accordion Content Width
	var contentwidth = $('.accordion-header').width();

	// Open The First Accordion Section When Page Loads
	$('.accordion-header').first().toggleClass('active-header').toggleClass('inactive-header');
	$('.accordion-content').first().slideDown().toggleClass('open-content');

	// The Accordion Effect
	$('.accordion-header').on('click', function (e) {

		e.preventDefault();

		// -------------------------------------------------------
	   // for onlinestore page payment options
	   // -------------------------------------------------------
	   var hasRadio = $(this).hasClass("has-radio"),	
	   	 isActive = $(this).hasClass("active-header"),       
		    theRadio = $(this).children(":radio");

		// toggle radio value 
      if (isActive) { return 0; }
		if (hasRadio && theRadio.length > 0) {
			theRadio.prop("checked", !theRadio.is(":checked"));	
		}
		// -------------------------------------------------------


		// updated css classes
	  	if ($(this).is('.inactive-header')) {
	       $('.active-header').toggleClass('active-header').toggleClass('inactive-header').next().slideToggle().toggleClass('open-content');
	       $(this).toggleClass('active-header').toggleClass('inactive-header');
	       $(this).next().slideToggle().toggleClass('open-content');
	   } else {
	       $(this).toggleClass('active-header').toggleClass('inactive-header');
	       $(this).next().slideToggle().toggleClass('open-content');
	   }

	   
	});

			
	/*-----------------------------------------------------*/
	/* tabs
  	-------------------------------------------------------*/	
	$(".tab-content").hide();
	$(".tab-content").first().show();

	$("ul.tabs li").click(function () {
	    $("ul.tabs li").removeClass("active");
	    $(this).addClass("active");
	    $(".tab-content").hide();
	    var activeTab = $(this).attr("data-id");
	    $("#" + activeTab).fadeIn();
	});


	/*-----------------------------------------------------*/
  	/* Back to top
   -------------------------------------------------------*/ 
	var pxShow = 300; // height on which the button will show
	var fadeInTime = 400; // how slow/fast you want the button to show
	var fadeOutTime = 400; // how slow/fast you want the button to hide
	var scrollSpeed = 300; // how slow/fast you want the button to scroll to top. can be a value, 'slow', 'normal' or 'fast'

   // Show or hide the sticky footer button
	jQuery(window).scroll(function() {

		if (!( $("#header-search").hasClass('is-visible'))) {

			if (jQuery(window).scrollTop() >= pxShow) {
				jQuery("#go-top").fadeIn(fadeInTime);
			} else {
				jQuery("#go-top").fadeOut(fadeOutTime);
			}

		}		

	});		

})(jQuery);