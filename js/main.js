(function($) {
	
	'use strict';
	
	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	
	var activateSearch = false,
	activeMap = '',
	latLong = '';

	
	$(document).ready(function(e) {
				
		// global
		var Modernizr = window.Modernizr;
		
		// support for CSS Transitions & transforms
		var support = Modernizr.csstransitions && Modernizr.csstransforms;
		var support3d = Modernizr.csstransforms3d;
		// transition end event name and transform name
		// transition end event name
		var transEndEventNames = {
								'WebkitTransition' : 'webkitTransitionEnd',
								'MozTransition' : 'transitionend',
								'OTransition' : 'oTransitionEnd',
								'msTransition' : 'MSTransitionEnd',
								'transition' : 'transitionend'
							},
		transformNames = {
						'WebkitTransform' : '-webkit-transform',
						'MozTransform' : '-moz-transform',
						'OTransform' : '-o-transform',
						'msTransform' : '-ms-transform',
						'transform' : 'transform'
					};
					
		if( support ) {
			this.transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ] + '.PMMain';
			this.transformName = transformNames[ Modernizr.prefixed( 'transform' ) ];
			//console.log('this.transformName = ' + this.transformName);
		}
				
		//Check for element animations
		animateMilestones();
		animateProgressBars();
		animatePieCharts();
		setDimensionsPieCharts();
		
		//Initialize WOW plugin for element animations
		if( $('.wow').length > 0 ){
			new WOW().init();
		}
		
	/* ==========================================================================
	   Remove empty paragraph tags
	   ========================================================================== */
		/*$('p').each(function() {
			var $this = $(this);
			if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
				$this.remove();
		});*/
		
	/* ==========================================================================
	   Gallery item
	   ========================================================================== */
	   if( $('.pm-gallery-item-container').length > 0 ){
			methods.bindGalleryItemEvents();   
	   }
	   
	/* ==========================================================================
	   Column borders for VC
	   ========================================================================== */
	   
	   if( $('.pm-column-border').length > 0 ){
			
			$('.pm-column-border').css({
				'border-top' : '5px solid white'	
			});
			
	   }
	   
	/* ==========================================================================
	   Language Selector drop down
	   ========================================================================== */
		if($('.pm-dropdown.pm-language-selector-menu').length > 0){
			$('.pm-dropdown.pm-language-selector-menu').on('mouseover', methods.dropDownMenu).on('mouseleave', methods.dropDownMenu);
		}
		
	/* ==========================================================================
	   Initialize PrettyPhoto
	   ========================================================================== */
		methods.loadPrettyPhoto();
		
	/* ==========================================================================
	   postItems shortcode carousel
	   ========================================================================== */
	   if( $("#pm-postItems-carousel").length > 0 ){
		   
		    var postOwl = $("#pm-postItems-carousel");
			
			postOwl.owlCarousel({
				
				items : 3, //10 items above 1000px browser width
				itemsDesktop : [5000,3],
				itemsDesktopSmall : [991,2],
				itemsTablet: [767,2],
				itemsTabletSmall: [720,1],
				itemsMobile : [320,1],
				
				//Pagination
				pagination : false,
				paginationNumbers: false,
				
		   });
		   
	   }
	   
		
	/* ==========================================================================
	   Ajax load more
	   ========================================================================== */
	   if($('#pm-load-more').length > 0){
						
			var morebutton = $('#pm-load-more'),
			section = morebutton.attr('name'),
			//container = 'pm-isotope-'+section+'-container',
			container = 'pm-isotope-item-container',
			btntext = morebutton.find('span').text(),
			page = 1;
									
			//alert($('#'+container).height());
		
			morebutton.click(function(e){
				
				e.preventDefault();
				page++;
				
				//morebutton.removeClass('fa fa-cloud-download').addClass('fa fa-spinner fa-spin');
				morebutton.find('span').text(pulsarajax.loading);//retrieved from localize script in functions.php
				//morebutton.find('i').removeClass('fa fa-cloud-download').addClass('fa fa-cog fa-spin').css({borderLeft:'0px'});
				
				$.post(pulsarajax.ajaxurl, {action:'pm_ln_load_more', nonce:pulsarajax.nonce, page:page, section:section}, function(data){
					
					var content = $(data.content);
					
					$(content).imagesLoaded(function(){
						
						$('#'+container).append(content).isotope('insert',content); //appended or insert (insert appends and filters the new items)
												
						//$('.pm-load-more-status').text('Loading...');
						//morebutton.find('span').append('<i class="fa fa-cloud-download"></i>');
						//morebutton.find('i').removeClass('fa fa-cog fa-spin').addClass('fa fa-cloud-download').css({borderLeft:'1px solid black'});
						
						//methods.resetHoverPanels();
						
						var numItems = $('div.pm-isotope-item').length; 
						$('.pm-load-more-container-current-count').text(numItems);
						
						if(section == 'galleries'){
							//reset prettyPhoto for new isotope items
							methods.loadPrettyPhoto();
							methods.bindGalleryItemEvents();
						}
						
						/*if(section == 'staff'){
							var numItems = $('div.pm-isotope-item').length;
							$('.pm-load-more-container-current-count').text(numItems);
						}*/
						
					});
					
					if(page >= data.pages){
						
						//all data has loaded, hide the Load More button
						morebutton.fadeOut('fase');
						morebutton.unbind( "click" );
						morebutton.click(function(e) {
							e.preventDefault();
						});
						
					} else {
						//More items can be loaded, restore text on button
						morebutton.find('span').text(btntext);//retrieved from localize script in functions.php
					}
					
				},'json');
				
			});
			
		}
		
	/* ==========================================================================
	   Isotope menu expander (mobile only)
	   ========================================================================== */
	   if($('.pm-isotope-filter-system-expand').length > 0){
		   
		   var totalHeight = 0;
		   
		   $('.pm-isotope-filter-system-expand').click(function(e) {
			   
			   var $this = $(this),
			   $parentUL = $this.parent('ul');
			   			   
			   //get the height of the total li elements
			   $parentUL.children('li').each(function(index, element) {
					totalHeight += $(this).height();
			   });
			   			   
			   if( !$parentUL.hasClass('expanded') ){
				   
				    //expand the menu
					$parentUL.addClass('expanded');
				   				  
				    $parentUL.css({
					  "height" : totalHeight	  
				    });
					
					$this.find('i').removeClass('fa-angle-down').addClass('fa-close');
				   
			   } else {
				
					//close the menu
					$parentUL.removeClass('expanded');
				   				  
				    $parentUL.css({
					  "height" : 80 
				    });
					
					$this.find('i').removeClass('fa-close').addClass('fa-angle-down');
									   
			   }
			   
			   //reset totalheight
			   totalHeight = 0;
			   
		   });
		   
	   }
	   
	/* ==========================================================================
	   Isotope activation
	   ========================================================================== */
		if($('#pm-isotope-item-container').length > 0){
			//initialize isotope
			$('#pm-isotope-item-container').isotope({
			  // options
			  itemSelector : '.pm-isotope-item',
			  layoutMode : 'fitRows',
			});	
		}
	   
	/* ==========================================================================
	   Isotope filter activation
	   ========================================================================== */
		$('.pm-isotope-filter-system').children().each(function(i,e) {
						
			if(i > 0){
				
				delay(e, 1);
				$(e).css({
					'visibility' : 'visible'	
				});
				//add click functionality
				$(e).find('a').click(function(e) {
					
					e.preventDefault();
										
					$('.pm-isotope-filter-system').children().find('a').removeClass('current');
					$(this).addClass('current');
					
					var id = $(this).attr('id');
					$('#pm-isotope-item-container').isotope({ filter: '.'+$(this).attr('id') });
					
					
					if( $(window).width() < 760 ){
						//Capture parent li index for list reordering
						var listItem = $(this).closest('li');
						var listItemIndex = $(this).closest('li').index();
						console.log( "Index: " +  listItemIndex );
						
						//$('.pm-isotope-filter-system').insertAfter(listItem, $('.pm-isotope-filter-system').find("li").index(0));
						
						$('.pm-isotope-filter-system').find("li").eq(0).after(listItem);
					}
										
				});
				
			}
						
			
		});
		
		var offset = 50;
		
		//must be declared at top level or immediately after a function call in "strict mode"
		function delay(element, opacity) {
			setTimeout(function(){
				$(element).animate({
					opacity: opacity, 
				}, 150);
			}, $(element).index() * offset)
		}	
	   
	/* ==========================================================================
	   Product switcher
	   ========================================================================== */
	   if( $('#pm-product-switcher').length > 0 ){
			
			var switcherActive = false,
			$switcher = $('#pm-product-switcher');
			
			$('#pm-product-switcher-btn').click(function(e) {
				
				var $this = $(this);
				
				if(!switcherActive){
					
					switcherActive = true;
					$switcher.css({
						'bottom' : '0px'	
					});
					
					$this.addClass('pm-switcher-active');
					
				} else {
					switcherActive = false;
					$switcher.css({
						'bottom' : '-224px'	
					});	
					$this.removeClass('pm-switcher-active');
				}
				
			});
			
		}
		
	/* ==========================================================================
	   Quick login form
	   ========================================================================== */
	   if( $('#pm-quick-login-btn').length > 0 ){
		   
		   var $quickBtn = $('#pm-quick-login-btn'),
		   $quickLoginContainer = $('.pm-quick-login-container'),
		   showQuickLogin = false;
		   
		   
		   $quickBtn.click(function(e) {
			  
			  if(!showQuickLogin){
				  
				  //expand
				  showQuickLogin = true;
				  
				  $quickBtn.find('a').removeClass('typcn-th-large-outline').addClass('typcn-times');
				  
				  //check window size
				  
				  /*$quickLoginContainer.css({
					"height" : "56px"  
				  }, 'slow').addClass('active');*/
				  
				  $quickLoginContainer.animateAuto("height", 500); 
				  
			  } else {
				  
			  	  //hide
				  showQuickLogin = false;
				  
				  $quickBtn.find('a').removeClass('typcn-times').addClass('typcn-th-large-outline');
				
				  $quickLoginContainer.animate({
					  "height" : 0  
				  });
				
			  }
			   
		   });
		   
	   }
		
		
	/* ==========================================================================
	   Placeholders for login form
	   ========================================================================== */
	    $('#user_login').attr('placeholder', 'User Name');
		$('#user_email').attr('placeholder', 'User Email');
		$('#user_pass').attr('placeholder', 'User Password');
		
	/* ==========================================================================
	   Print page
	   ========================================================================== */
		if( $('#pm-print-btn').length > 0 ){
			var printBtn = $('#pm-print-btn');
			printBtn.click(function() {
				window.print();
				return false;	
			});
		}
	/* ==========================================================================
	   Search entry
	   ========================================================================== */
		
		var $searchSubmit = $('#pm-search-submit');
		$searchSubmit.live('click', function(e) {
			$('#pm-searchform').submit();
			e.preventDefault();	
		});
		
		var $searchSubmitPage = $('#pm-search-submit-page');
		$searchSubmitPage.live('click', function(e) {
			$('#search-form-page').submit();
			e.preventDefault();	
		});
		
		//Sidebar
		if($('.pm-sidebar-search-icon-btn').length > 0){
			var $submitBtn = $('.pm-sidebar-search-icon-btn');
			//alert($submitBtn.attr('id'));
			$submitBtn.live('click', function(e) {
				$('#searchform').submit();
				e.preventDefault();	
			});
		}
		
	/* ==========================================================================
	   input placeholder correction for unsupported browsers
	   ========================================================================== */
		/*$('[placeholder]').focus(function() {
			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
				input.val('');
				input.removeClass('placeholder');
			}
		}).blur(function() {
			var input = $(this);
			if (input.val() == '' || input.val() == input.attr('placeholder')) {
				input.addClass('placeholder');
				input.val(input.attr('placeholder'));
			}
		}).blur().parents('form').submit(function() {
			$(this).find('[placeholder]').each(function() {
				var input = $(this);
				if (input.val() == input.attr('placeholder')) {
					input.val('');
				}
			})
		});*/
		
	/* ==========================================================================
	   Main menu interaction
	   ========================================================================== */
	   	   
		if( $('#pm-nav').length > 0 ){
						
			//superfish activation
			$('#pm-nav').superfish({
				delay: 0,
				animation: {opacity:'show',height:'show'},
				speed: 300,
				dropShadows: false,
			});
			
			$('.sf-sub-indicator').html('<i class="fa ' + wordpressOptionsObject.dropMenuIndicator + '"></i>');
			
			$('.sf-menu ul .sf-sub-indicator').html('<i class="fa ' + wordpressOptionsObject.dropMenuIndicator + '"></i>');
						
		};	
				
	/* ==========================================================================
	   Checkout expandable forms
	   ========================================================================== */
		if ($('#pm-returning-customer-form-trigger').length > 0){
			
			var $returningFormExpanded = false;
			
			$('#pm-returning-customer-form-trigger').on('click', function(e) {
				
				e.preventDefault();
				
				if( !$returningFormExpanded ) {
					$returningFormExpanded = true;
					$('#pm-returning-customer-form').fadeIn(700);
					
				} else {
					$returningFormExpanded = false;
					$('#pm-returning-customer-form').fadeOut(300);
				}
				
			});
			
		}
		
		if ($('#pm-promotional-code-form-trigger').length > 0){
			
			var $promotionFormExpanded = false;
			
			$('#pm-promotional-code-form-trigger').on('click', function(e) {
				
				e.preventDefault();
				
				if( !$promotionFormExpanded ) {
					$promotionFormExpanded = true;
					$('#pm-promotional-code-form').fadeIn(700);
					
				} else {
					$promotionFormExpanded = false;
					$('#pm-promotional-code-form').fadeOut(300);
				}
				
			});
			
		}
		
		
	/* ==========================================================================
	   animateMilestones
	   ========================================================================== */
	
		function animateMilestones() {
	
			$(".milestone:in-viewport").each(function() {
				
				var $t = $(this);
				var	n = $t.find(".milestone-value").attr("data-stop");
				var	r = parseInt($t.find(".milestone-value").attr("data-speed"));
					
				if (!$t.hasClass("already-animated")) {
					$t.addClass("already-animated");
					$({
						countNum: $t.find(".milestone-value").text()
					}).animate({
						countNum: n
					}, {
						duration: r,
						easing: "linear",
						step: function() {
							$t.find(".milestone-value").text(Math.floor(this.countNum));
						},
						complete: function() {
							$t.find(".milestone-value").text(this.countNum);
						}
					});
				}
				
			});
	
		}
		
	/* ==========================================================================
	   animateProgressBars
	   ========================================================================== */
	
		/*function animateProgressBars() {
				
			$(".pm-progress-bar .pm-progress-bar-outer:in-viewport").each(function() {
				
				var $t = $(this),
				progressID = $t.attr('id'),
				numID = progressID.substr(progressID.lastIndexOf("-") + 1),
				targetDesc = '#pm-progress-bar-desc-' + numID,
				$target = $(targetDesc).find('span'),
				dataWidth = $t.attr("data-width");
								
				
				if (!$t.hasClass("already-animated")) {
					$t.addClass("already-animated");
					$t.animate({
						width: dataWidth + "%"
					}, 2000);
					$target.animate({
						"left" : dataWidth + "%",
						"opacity" : 1
					}, 2000);
				}
				
			});
	
		}*/
		
		
		function animateProgressBars() {
				
			$(".pm-progress-bar .pm-progress-bar-outer:in-viewport").each(function() {
				
				var $t = $(this),
				progressID = $t.attr('id'),
				numID = progressID.substr(progressID.lastIndexOf("-") + 1),
				targetDesc = '#pm-progress-bar-desc-' + numID,
				$target = $(targetDesc).find('span'),
				dataWidth = $t.attr("data-width");
												
				
				if (!$t.hasClass("already-animated")) {
					
					$t.addClass("already-animated");
					$t.animate({
						width: dataWidth + "%"
					}, 2000);
					$target.animate({
						"left" : dataWidth + "%",
						"opacity" : 1
					}, 2000);
					
					$({
						countNum: 0 //start counter
					}).animate({
						countNum: dataWidth //end counter
					}, {
						duration: 1500,
						easing: "linear",
						step: function() {
							$target.text(Math.floor(this.countNum) + '%');
						},
						complete: function() {
							$target.text(this.countNum + '%');
						}
					});
						
				}
				
			});
	
		}
		
	/* ==========================================================================
	   setDimensionsPieCharts
	   ========================================================================== */
		
		function setDimensionsPieCharts() {
	
			$(".pm-pie-chart").each(function() {
	
				var $t = $(this);
				var n = $t.parent().width();
				var r = $t.attr("data-barSize");
				
				if (n < r) {
					r = n;
				}
				
				$t.css("height", r);
				$t.css("width", r);
				$t.css("line-height", r + "px");
				
				$t.find("i").css({
					"line-height": r + "px",
					"font-size": r / 3
				});
				
			});
	
		}
	
	/* ==========================================================================
	   animatePieCharts
	   ========================================================================== */
	
		function animatePieCharts() {
	
			if(typeof $.fn.easyPieChart != 'undefined'){
	
				$(".pm-pie-chart:in-viewport").each(function() {
		
					var $t = $(this);
					var n = $t.parent().width();
					var r = $t.attr("data-barSize");
					
					if (n < r) {
						r = n;
					}
					
					$t.easyPieChart({
						animate: 1300,
						lineCap: "square",
						lineWidth: $t.attr("data-lineWidth"),
						size: r,
						barColor: $t.attr("data-barColor"),
						trackColor: $t.attr("data-trackColor"),
						scaleColor: "transparent",
						onStep: function(from, to, percent) {
							$(this.el).find('.pm-pie-chart-percent span').text(Math.round(percent));
						}
		
					});
					
				});
				
			}
	
		}
				
	/* ==========================================================================
	   isTouchDevice - return true if it is a touch device
	   ========================================================================== */
	
		function isTouchDevice() {
			return !!('ontouchstart' in window) || ( !! ('onmsgesturechange' in window) && !! window.navigator.maxTouchPoints);
		}
				
		
		//dont load parallax on mobile devices
		function runParallax() {
						
			//enforce check to make sure we are not on a mobile device
			if( !isMobile.any()){
							
				//stellar parallax
				$.stellar({
				  horizontalOffset: 0,
				  verticalOffset: 0,
				  horizontalScrolling: false,
				});
				
				$('.pm-parallax-panel').stellar();
								
			}
			
		}//end of function
		
	/* ==========================================================================
	   Checkout form - Account password activation
	   ========================================================================== */
	   
	   if( $('#pm-create-account-checkbox').length > 0){
			  			
			$('#pm-create-account-checkbox').change(function(e) {
				
				if( $('#pm-create-account-checkbox').is(':checked') ){
					
					$('#pm-checkout-password-field').fadeIn(500);
					
				} else {
					$('#pm-checkout-password-field').fadeOut(500);	
				}
				
			});
			   
	   }
	   
	/* ==========================================================================
	   Google map reset for tabs
	   ========================================================================== */
		if( $('.pm-nav-tabs').length > 0){
			
			$('.pm-nav-tabs').children().find('a').click(function(e) {
				
				var targetId = $(this).attr('href');
				
				var targetMap = $(targetId).find('.googleMap');
				
				if(targetMap.length > 0){
					
					var id = targetMap.data('id'),
					mapType = targetMap.data('mapType'),
					zoom = targetMap.data('mapZoom'),
					latitude = targetMap.data('latitude'),
					longitude = targetMap.data('longitude'),
					message = targetMap.data('message');
					
					methods.initializeGoogleMap(id, latitude, longitude, zoom, mapType, message);
					
					$(this).on('shown.bs.tab', function(e){
						google.maps.event.trigger(activeMap, 'resize');
						activeMap.setCenter(latLong)
					});
					
				}
				
				//alert();
				
			});
			
		}
	   
	   
	 /* ==========================================================================
	   Accordion and Tabs
	   ========================================================================== */
	   
	    $('#accordion').collapse({
		  toggle: false
		})
	    $('#accordion2').collapse({
		  toggle: false
		})
	   
		if($('.panel-title').length > 0){
			
			var $prevItem = null;
			var $currItem = null;
			
			$('.pm-accordion-link').click(function(e) {
				
				var $this = $(this);
				
				if($prevItem == null){
					$prevItem = $this;
					$currItem = $this;
				} else {
					$prevItem = $currItem;
					$currItem = $this;
				}				
				
				//reset Google map if found
				var targetId = $this.attr('href');
					
				var targetMap = $(targetId).find('div').find('.googleMap');
				
				if(targetMap.length > 0){
										
					var id = targetMap.data('id'),
					mapType = targetMap.data('mapType'),
					zoom = targetMap.data('mapZoom'),
					latitude = targetMap.data('latitude'),
					longitude = targetMap.data('longitude'),
					message = targetMap.data('message');
									
					methods.initializeGoogleMap(id, latitude, longitude, zoom, mapType, message);
					
					$(targetId).on('shown.bs.collapse', function(e){
						google.maps.event.trigger(activeMap, 'resize');
						activeMap.setCenter(latLong)
					});
					
				}
				
				if( $currItem.attr('href') != $prevItem.attr('href') ) {
										
					//toggle previous item
					if( $prevItem.parent().find('i').hasClass('fa fa-minus') ){
						$prevItem.parent().find('i').removeClass('fa fa-minus').addClass('fa fa-plus');
					}
					
					$currItem.parent().find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
					
				} else if($currItem.attr('href') == $prevItem.attr('href')) {
										
					//else toggle same item
					if( $currItem.parent().find('i').hasClass('fa fa-minus') ){
						$currItem.parent().find('i').removeClass('fa fa-minus').addClass('fa fa-plus');
					} else {
						$currItem.parent().find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
					}
						
				} else {
					
					//console.log('toggle current item');
					$currItem.parent().find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
					
				}
				
				
			});

			
		}
		
		//tab menu
		if($('.nav-tabs').length > 0){
			
			//actiavte first tab of tab menu
			$('.nav-tabs a:first').tab('show');
			$('.nav.nav-tabs li:first-child').addClass('active');
			$('.pm-tab-content div:first-child').addClass('active');
		}
	   
	   
	   
		
		
	/* ==========================================================================
	   Member archive widget drop menu
	   ========================================================================== */
		if($('.pm-dropdown.pm-member-archive-menu').length > 0){
			$('.pm-dropdown.pm-member-archive-menu').on('mouseover', methods.dropDownMenu).on('mouseleave', methods.dropDownMenu);
		}
		
		
		//destroy parallax effect on desktop < 980 else enable > 980
		var $window = $(window);
		var $windowsize = 0;
		
		function checkWidth() {
			$windowsize = $window.width();
			if ($windowsize < 980) {
				//if the window is less than 980px, destroy parallax...
				$.stellar('destroy');
			} else {
				runParallax();	
			}
		}
		
		// Execute on load
		checkWidth();
		// Bind event listener
		$(window).resize(checkWidth);
		
				
		//used for quick nav toggle
		var navHeight =  $('header').outerHeight(); //outerHeight gets height with padding
		var quickNavActive = false;
		
	/* ==========================================================================
	   When the window is scrolled, do
	   ========================================================================== */
		$(window).scroll(function () {
			
			animateMilestones();
			animateProgressBars();
			animatePieCharts();
			
			//toggle back to top btn
			if ($(this).scrollTop() > 50) {
				if( support ) {
					
					$('#back-top').css({ bottom : 0 });
				} else {
					$('#back-top').animate({ bottom : 0 });
				}
				
			} else {
				if( support ) {
					$('#back-top').css({ bottom : -70 });
				} else {
					$('#back-top').animate({ bottom : -70 });
				}
				
			}
			
			//toggle fixed nav
			if(wordpressOptionsObject.stickyNav == 'on') {
				
				if( $(window).width() > 991 ){
				
					if ($(this).scrollTop() > 47) {
						
						$('header').addClass('fixed');
										
					} else {
						
						$('header').removeClass('fixed');
											
					}
				
				}
				
			}			
						
		});
		
	/* ==========================================================================
	   Detect page scrolls on buttons
	   ========================================================================== */
		if( $('.pm-page-scroll').length > 0 ){
			
			$('.pm-page-scroll').click(function(e){
								
				e.preventDefault();
				var $this = $(e.target);
				var sectionID = $this.attr('href');
				
				
				$('html, body').animate({
					scrollTop: $(sectionID).offset().top - 80
				}, 1000);
				
			});
			
		}
		
	/* ==========================================================================
	   Activate single post shortcode functionality
	   ========================================================================== */
		if ( $('.pm-presentation-post-container').length > 0 ){
			
			$('.pm-presentation-post-container').PMHoverPanel({
				slideType: 'presentationPostPanel',
				animationSpeed: 600,
				easing : "easeOutCubic",
				scaleValue : 1.2
			});
			
		}
		
	/* ==========================================================================
	   OWL Carousels
	   ========================================================================== */
		
		if ( $('#pm-presentation-owl').length > 0 ){
			
			//Activate presentation post interaction
			$('.pm-presentation-post-container').PMHoverPanel({
				slideType: 'presentationPostPanel',
				animationSpeed: 600,
				easing : "easeOutCubic",
				scaleValue : 1.2
			});
			
			//Activate Own Carousel
			$("#pm-presentation-owl").owlCarousel({
			
				 // Most important owl features
				items : 3,
				itemsCustom : false,
				itemsDesktop : [5000,3],
				itemsDesktopSmall : [991,2],
				itemsTablet: [767,2],
				itemsTabletSmall: [720,1],
				itemsMobile : [320,1],
				singleItem : false,
				itemsScaleUp : false,
				 
				//Basic Speeds
				slideSpeed : wordpressOptionsObject.slideSpeed,
				paginationSpeed : 800,
				rewindSpeed : wordpressOptionsObject.rewindSpeed,
				 
				//Autoplay
				autoPlay : wordpressOptionsObject.autoPlaySpeed == 0 ? false : wordpressOptionsObject.autoPlaySpeed,
				stopOnHover : false,
				 
				// Navigation
				navigation : true,
				navigationText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
				rewindNav : true,
				scrollPerPage : false,
				 
				//Pagination
				pagination : false,
				paginationNumbers: false,
				 
				// Responsive
				responsive: true,
				responsiveRefreshRate : 200,
				responsiveBaseWidth: window,
				 
				// CSS Styles
				baseClass : "owl-carousel",
				theme : "owl-theme",
				 
				//Lazy load
				lazyLoad : true,
				lazyFollow : true,
				lazyEffect : "fade",
				 
				//Auto height
				autoHeight : false,
				 
				//Mouse Events
				dragBeforeAnimFinish : true,
				mouseDrag : true,
				touchDrag : true,
				 
			});
			
		}
		
		if ( $('#pm-partners-carousel-owl').length > 0 ){
			
			//Activate Own Carousel
			$("#pm-partners-carousel-owl").owlCarousel({
			
				 // Most important owl features
				items : 4,
				itemsCustom : false,
				itemsDesktop : [1200,3],
				itemsDesktopSmall : [991,3],
				itemsTablet: [767,2],
				itemsTabletSmall: [720,1],
				itemsMobile : [320,1],
				singleItem : false,
				itemsScaleUp : false,
				 
				//Basic Speeds
				slideSpeed : 500,
				paginationSpeed : 800,
				rewindSpeed : 1000,
				 
				//Autoplay
				autoPlay : false,
				stopOnHover : false,
				 
				// Navigation
				navigation : true,
				navigationText : ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
				rewindNav : true,
				scrollPerPage : false,
				 
				//Pagination
				pagination : false,
				paginationNumbers: false,
				 
				// Responsive
				responsive: true,
				responsiveRefreshRate : 200,
				responsiveBaseWidth: window,
				 
				// CSS Styles
				baseClass : "owl-carousel",
				theme : "owl-theme",
				 
				//Lazy load
				lazyLoad : false,
				lazyFollow : true,
				lazyEffect : "fade",
				 
				//Auto height
				autoHeight : true,
				 
				//Mouse Events
				dragBeforeAnimFinish : true,
				mouseDrag : true,
				touchDrag : true,
				 
			});
			
		}
		
		
		if ( $('#pm-testimonials-carousel-owl').length > 0 ){
			
			//Activate Own Carousel
			$("#pm-testimonials-carousel-owl").owlCarousel({
			
				 // Most important owl features
				items : 1,
				itemsCustom : false,
				itemsDesktop : [1200,1],
				itemsDesktopSmall : [991,1],
				itemsTablet: [767,1],
				itemsTabletSmall: [720,1],
				itemsMobile : [320,1],
				singleItem : false,
				itemsScaleUp : false,
				 
				//Basic Speeds
				slideSpeed : 800,
				paginationSpeed : 800,
				rewindSpeed : 1000,
				 
				//Autoplay
				autoPlay : false,
				stopOnHover : false,
				 
				// Navigation
				navigation : true,
				navigationText : ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
				rewindNav : true,
				scrollPerPage : false,
				 
				//Pagination
				pagination : false,
				paginationNumbers: false,
				 
				// Responsive
				responsive: true,
				responsiveRefreshRate : 200,
				responsiveBaseWidth: window,
				 
				// CSS Styles
				baseClass : "owl-carousel",
				theme : "owl-theme",
				 
				//Lazy load
				lazyLoad : false,
				lazyFollow : true,
				lazyEffect : "fade",
				 
				//Auto height
				autoHeight : true,
				 
				//Mouse Events
				dragBeforeAnimFinish : true,
				mouseDrag : true,
				touchDrag : true,
				 
			});
			
		}
		
		
		if ( $('#pm-interactive-panels-owl').length > 0 ){
			
			//Activate Own Carousel
			$("#pm-interactive-panels-owl").owlCarousel({
			
				 // Most important owl features
				items : 3,
				itemsCustom : false,
				itemsDesktop : [1200,3],
				itemsDesktopSmall : [991,2],
				itemsTablet: [767,1],
				itemsTabletSmall: [720,1],
				itemsMobile : [320,1],
				singleItem : false,
				itemsScaleUp : false,
				 
				//Basic Speeds
				slideSpeed : 800,
				paginationSpeed : 800,
				rewindSpeed : 1000,
				 
				//Autoplay
				autoPlay : false,
				stopOnHover : false,
				 
				// Responsive
				responsive: true,
				responsiveRefreshRate : 200,
				responsiveBaseWidth: window,
				 
				// CSS Styles
				baseClass : "owl-carousel",
				theme : "owl-theme",
				 
				//Lazy load
				lazyLoad : false,
				lazyFollow : true,
				lazyEffect : "fade",
				 
				//Auto height
				autoHeight : true,
				 
				//Mouse Events
				dragBeforeAnimFinish : true,
				mouseDrag : true,
				touchDrag : true,
				 
			});
			
		}
		
	/* ==========================================================================
	   Blog posts interaction
	   ========================================================================== */
		if( $('.pm-blog-post-img-container').length > 0 ) {
			$('.pm-blog-post-img-container').PMHoverPanel({
				slideType: 'blogPostPanel',
				animationSpeed: 600,
				easing : "easeOutCubic",
				scaleValue : 1.2
			});
		}
		
		
	/* ==========================================================================
	   Mobile menu button toggle
	   ========================================================================== */
		if( $('#pm-mobile-menu-btn').length > 0 ){
			
			var menuCollapsed = false;
			
			$('#pm-mobile-menu-btn').on('click', function(e) {
				
				var $icon = $(this).find('i');
				
				if( !menuCollapsed ){
					
					menuCollapsed = true;
					
					$icon.removeClass('fa-bars').addClass('fa-minus');
					
				} else {
					
					menuCollapsed = false;
					
					$icon.removeClass('fa-minus').addClass('fa-bars');
						
				}
				
			});
			
		}
	
	/* ==========================================================================
	   Back to top button
	   ========================================================================== */
		$('#back-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
		
	/* ==========================================================================
	   Accordion menu
	   ========================================================================== */
		if($('#accordionMenu').length > 0){
			$('#accordionMenu').collapse({
				toggle: false,
				parent: false,
			});
		}
		
		
	/* ==========================================================================
	   Tab menu
	   ========================================================================== */
		if($('.pm-nav-tabs').length > 0){
			//actiavte first tab of tab menu
			$('.pm-nav-tabs a:first').tab('show');
			$('.pm-nav-tabs li:first-child').addClass('active');
		}

		
	/* ==========================================================================
	   Window resize call
	   ========================================================================== */
		$(window).resize(function(e) {
			methods.windowResize();
		});

		
	
		if( $('#pm-search-btn').length > 0 ){
						
			var $searchBtn = $('#pm-search-btn');
			
			$searchBtn.click(function(e) {
				
				//CALL METHODS FUNCTION
				methods.displaySearch();
								
				$('#pm-search-exit').click(function(e) {
					methods.hideSearch();
				});
											
				e.preventDefault();
			
			});
			
		}
		
	/* ==========================================================================
	   Conact page google map interaction
	   ========================================================================== */
	   if( $(".pm-google-map-container").length > 0 ){
		   		   
		   $( '.pm-google-map-container' ).each(function(index, element) {			   
				
				var $this = $(element),
				container = $this.find('.pm-googleMap'),
				id = container.attr('id'),
				mapType = container.data('mapType'),
				zoom = container.data('mapZoom'),
				latitude = container.data('latitude'),
				longitude = container.data('longitude'),
				message = container.data('message');
												
				methods.initializeGoogleMap(id, latitude, longitude, zoom, mapType, message);				
			
        	}); 			
			
			
	   }
		
	/* ==========================================================================
	   Tooltips
	   ========================================================================== */
		if( $('.pm_tip').length > 0 ){
			$('.pm_tip').PMToolTip();
		}
		if( $('.pm_tip_static_bottom').length > 0 ){
			$('.pm_tip_static_bottom').PMToolTip({
				floatType : 'staticBottom'
			});
		}
		if( $('.pm_tip_static_top').length > 0 ){
			$('.pm_tip_static_top').PMToolTip({
				floatType : 'staticTop'
			});
		}
		
	/* ==========================================================================
	   TinyNav
	   ========================================================================== */
		$("#pm-footer-nav").tinyNav();
		$("#pm-members-nav").tinyNav();
		
			
	}); //end of document ready

	
	/* ==========================================================================
	   Options
	   ========================================================================== */
		var options = {
			dropDownSpeed : 100,
			slideUpSpeed : 200,
			slideDownTabSpeed: 50,
			changeTabSpeed: 200,
		}
	
	/* ==========================================================================
	   Methods
	   ========================================================================== */
		var methods = {
	
			displaySearch : function(e) {
							
				var searchContainer = $("#pm-search-container");
				
				searchContainer.css({
					'height' : $(window).height(),
					'opacity' : 1
				});
				
			},
			
			hideSearch : function(e) {
				
				var searchContainer = $("#pm-search-container");
				
				searchContainer.css({
					'opacity' : 0,
					'height' : 0
				});
				
			},

			
			dropDownMenu : function(e){  
					
				var body = $(this).find('> :last-child');
				var head = $(this).find('> :first-child');
				
				if (e.type == 'mouseover'){
					body.fadeIn(options.dropDownSpeed);
				} else {
					body.fadeOut(options.dropDownSpeed);
				}
				
			},
			
			loadPrettyPhoto : function() {
								
				if( $("a[data-rel^='prettyPhoto']").length > 0 ){
							
					$("a[data-rel^='prettyPhoto']").prettyPhoto({
						animation_speed: wordpressOptionsObject.ppAnimationSpeed.toString(), /* fast/slow/normal */
						slideshow: wordpressOptionsObject.ppSlideShowSpeed, /* false OR interval time in ms */
						autoplay_slideshow: wordpressOptionsObject.ppAutoPlay == 'false' ? false : true, /* true/false */
						opacity: 0.80, /* Value between 0 and 1 */
						show_title: wordpressOptionsObject.ppShowTitle == 'false' ? false : true, /* true/false */
						//allow_resize: true, /* Resize the photos bigger than viewport. true/false */
						//default_width: 640,
						//default_height: 480,
						counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
						theme: wordpressOptionsObject.ppColorTheme.toString(), /* light_rounded / dark_rounded / light_square / dark_square / facebook */
						horizontal_padding: 20, /* The padding on each side of the picture */
						hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
						wmode: 'opaque', /* Set the flash wmode attribute */
						autoplay: true, /* Automatically start videos: True/False */
						modal: false, /* If set to true, only the close button will close the window */
						deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
						overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
						keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
						changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
						
					});
					
				}	
				
			},
			
			bindGalleryItemEvents : function() {
				
				$('.pm-gallery-item-hover-btn').on('click', function(e) {
					
					var $container = $(this).closest('.pm-gallery-item-container'),
					$title = $container.find('.pm-gallery-item-title'),
					$btn = $container.find('.pm-gallery-item-hover-btn'),
					$span = $container.find('span'),
					$caption = $container.find('.pm-gallery-item-caption'),
					$btns = $container.find('.pm-gallery-item-btns'),
					$closeBtn = $container.find('.pm-gallery-item-close');
						
					$title.stop().animate({
						"left" : "-380px"
					}, 450);
					
					$btn.stop().animate({
						"bottom" : "-80px"	
					}, 450);
					
					$span.stop().animate({
						"opacity" : "1"	
					}, 300);
					
					$caption.stop().animate({
						"opacity" : "1"	
					}, 800);
					
					$btns.stop().animate({
						"right" : "20px",
						"opacity" : "1"	
					}, 450);
					
					
					$closeBtn.on('click', function(e) {
						$title.stop().animate({
							"left" : "0px"
						}, 450);
						
						$btn.stop().animate({
							"bottom" : "0px"	
						}, 450);
						
						$span.stop().animate({
							"opacity" : "0"	
						}, 300);
						
						$caption.stop().animate({
							"opacity" : "0"	
						}, 500);
						
						$btns.stop().animate({
							"right" : "-200px",
							"opacity" : "0"	
						}, 450);			
					});
					
				});
				
			},
			
			initializeGoogleMap : function(id, latitude, longitude, mapZoom, mapType, message) {
				
				  var myLatlng = new google.maps.LatLng(latitude,longitude);
				  latLong = myLatlng;
				  var myOptions = {
					center: myLatlng, 
					zoom: 13,
					mapTypeId: google.maps.MapTypeId.mapType
				  };
				  
				  //alert(document.getElementById(id).getAttribute('id'));
				  
				  //clear the html div first
				  document.getElementById(id).innerHTML = "";
				  
				  var map = new google.maps.Map(document.getElementById(id), myOptions);
				  
				  
		 
				  var contentString = message;
				  var infowindow = new google.maps.InfoWindow({
					  content: contentString
				  });
				   
				  var marker = new google.maps.Marker({
					  position: myLatlng
				  });
				   
				  google.maps.event.addListener(marker, "click", function() {
					  infowindow.open(map,marker);
				  });
				   
				  marker.setMap(map);
				  
				  activeMap = map;
				
			},

					
			windowResize : function(e) {
				//resize calls
			}
			
		};
		
	
	
})(jQuery);

jQuery.fn.animateAuto = function(prop, speed, callback){
    var elem, height, width;
    return this.each(function(i, el){
        el = jQuery(el), elem = el.clone().css({"height":"auto","width":"auto"}).appendTo("body");
        height = elem.css("height"),
        width = elem.css("width"),
        elem.remove();
        
        if(prop === "height")
            el.animate({"height":height}, speed, callback);
        else if(prop === "width")
            el.animate({"width":width}, speed, callback);  
        else if(prop === "both")
            el.animate({"width":width,"height":height}, speed, callback);
    });  
}