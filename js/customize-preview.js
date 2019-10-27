/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function( $ ) {

	// Collect information from customize-controls.js about which panels are opening.
	wp.customize.bind( 'preview-ready', function() {

		// Initially hide the theme option placeholders on load
		$( '.panel-placeholder' ).hide();

		wp.customize.preview.bind( 'section-highlight', function( data ) {

			// Only on the front page.
			if ( ! $( 'body' ).hasClass( 'procast_theme-front-page' ) ) {
				return;
			}

			// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
			if ( true === data.expanded ) {
				$( 'body' ).addClass( 'highlight-front-sections' );
				$( '.panel-placeholder' ).slideDown( 200, function() {
					$.scrollTo( $( '#panel1' ), {
						duration: 600,
						offset: { 'top': -70 } // Account for sticky menu.
					});
				});

			// If we've left the panel, hide the placeholders and scroll back to the top.
			} else {
				$( 'body' ).removeClass( 'highlight-front-sections' );
				// Don't change scroll when leaving - it's likely to have unintended consequences.
				$( '.panel-placeholder' ).slideUp( 200 );
			}
		});
	});
	
	//Header textfields
	wp.customize( 'headerPostsListSelector', function( value ) {
		value.bind( function( to ) {
			$( '#pro-cast-posts-selector li.activator' ).text( to );
		});
	});
	
	//Reviews textfields
	wp.customize( 'keyRating1Text', function( value ) {
		value.bind( function( to ) {
			$( '.pro-cast-review-rating-score-bar.level-one p' ).text( to );
		});
	});
	
	
	//Footer textfields
	wp.customize( 'newsletterFieldText', function( value ) {
		value.bind( function( to ) {
			$( '.pro-cast-newsletter-field' ).val( to );
		});
	});
		
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});
		
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	
	
	//Header Colors
	wp.customize( 'microNavColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pro-cast-header-row-wrapper-micro-nav' ).css({
					backgroundColor : to
				});	
				
				/*$( '.pro-cast-social-icons li' ).css({
					borderLeft : '1px solid' + to
					borderRight : '1px solid' + to
					borderBottom : '1px solid' + to
				});*/
				
				/*$( '.pro-cast-general-info' ).css({
					color : to
				});	*/
				
			}			
		});		
	});	
	//end Header Colors
	
	//Header slider options	
	
	


	//Footer slider options	
	wp.customize( 'fatFooterPadding', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-fat-footer' ).css({
					paddingTop : to + 'px',
					paddingBottom : to  + 'px'
					//opacity : to / 100
				});				
			}			
		});		
	});
	
	//Post slider options
	wp.customize( 'textAreaHeight', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-presentation-text-container' ).css({
					height : to
				});				
			}			
		});		
	});
	
	wp.customize( 'textAreaPosition', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-presentation-text-container' ).css({
					top : to + "%"
				});				
			}			
		});		
	});
	
	wp.customize( 'primaryColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.woocommerce .widget_price_filter .ui-slider .ui-slider-range' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce #respond input#submit' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce a.button' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce button.button' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce input.button' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce #respond input#submit.alt' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce a.button.alt' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce button.button.alt' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce input.button.alt' ).css({
					backgroundColor : to
				});	
				
				$( '.product_meta > span > a' ).css({
					color : to
				});	
				
				$( '.woocommerce div.product .woocommerce-tabs ul.tabs li' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce div.product form.cart .reset_variations' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce div.product p.price' ).css({
					color : to
				});	
				
				$( '.woocommerce div.product span.price' ).css({
					color : to
				});	
				
				$( '.woocommerce #respond input#submit' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce a.button' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce button.button' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce input.button' ).css({
					backgroundColor : to
				});	
				
				$( '.pm-column-border' ).css({
					borderTop : "5px solid" + to
				});
				
				$( '.pm-dropdown.pm-language-selector-menu .pm-dropmenu i' ).css({
					color : to
				});
				
				$( '#back-top' ).css({
					borderRightColor: to,
					borderBottomColor: to,
					borderRight : "35px solid" + to
				});
				
				$( '#pm-quick-message-close' ).css({
					backgroundColor : to
				});	
				
				$( '.pm-main-menu-btn i' ).css({
					color : to
				});
				
				$( '.pm-sub-header-breadcrumbs-ul p' ).css({
					color : to
				});
				
				$( '.pm-footer-subscribe-submit-btn' ).css({
					backgroundColor : to
				});	
				
				$( '#back-top' ).css({
					borderRight : "35px solid" + to,
					borderBottom : "35px solid" + to
				});
				
				$( '.pm-gallery-item-btns li a' ).css({
					backgroundColor : to
				});
				
				$( '.panel-title i' ).css({
					backgroundColor : to
				});	
				
				$( '.pm-workshop-newsletter-submit-btn' ).css({
					backgroundColor : to
				});	
				
				$( '.pm-course-post-title-box i' ).css({
					backgroundColor : to
				});	
				
				$( '.pm-testimonial-container' ).css({
					backgroundColor : to
				});
				
				$( '.pm-parnters-post-featured' ).css({
					backgroundColor : to
				});
				
				$( '.pm-workshop-widget-post i' ).css({
					backgroundColor : to
				});
				
				$( '.pm-career-opening-widget-post i' ).css({
					backgroundColor : to
				});
				
				$( '.pm-testimonial-name' ).css({
					color : to
				});
				
				$( '.pm_quick_contact_submit' ).css({
					backgroundColor : to
				});
				
				$( '.pm-career-post-icon' ).css({
					backgroundColor : to
				});
				
				$( '.pm-primary' ).css({
					color : to
				});
				
				$( '.pm-workshop-post-icon' ).css({
					backgroundColor : to
				});
				
				$( '.flex-direction-nav a' ).css({
					backgroundColor : to
				});
				
				$( '.pm-single-workshop-post-left-column i' ).css({
					backgroundColor : to
				});
				
				$( '.pm-workshop-widget-post p' ).css({
					color : to
				});
				
				$( '.quantity .minus' ).css({
					backgroundColor : to
				});
				
				$( '.quantity .plus' ).css({
					backgroundColor : to
				});
				
				$( '.posted_in i' ).css({
					color : to
				});
				
				$( '.tagged_as i' ).css({
					color : to
				});
				
				$( '.pm-isotope-filter-system-expand' ).css({
					backgroundColor : to
				});
				
				$( '.pm-product-social-icons li a' ).css({
					backgroundColor : to
				});
				
				$( '.pm-page-social-icons li a' ).css({
					backgroundColor : to
				});
				
				$( '.pm-search-submit' ).css({
					color : to
				});
				
				$( '.pm-primary-bg' ).css({
					backgroundColor : to
				});
						
			}			
		});		
	});
	
		
				
				
	wp.customize( 'secondaryColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.woocommerce .widget_price_filter .ui-slider .ui-slider-handle' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce span.onsale' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce ul.products li.product .price' ).css({
					color : to
				});	
				
				$( '.woocommerce div.product .woocommerce-tabs ul.tabs li.active > a' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce .star-rating span' ).css({
					color : to
				});	
				
				$( '.woocommerce p.stars a' ).css({
					color : to
				});	
				
				$( '.woocommerce-review-link' ).css({
					color : to
				});	
				
				$( '.woocommerce form .form-row.woocommerce-invalid .select2-container' ).css({
					borderColor : to
				});	
				
				$( '.woocommerce form .form-row.woocommerce-invalid input.input-text' ).css({
					borderColor : to
				});	
				
				$( '.woocommerce form .form-row.woocommerce-invalid select' ).css({
					borderColor : to
				});	
				
				$( '.woocommerce form .form-row.woocommerce-invalid label' ).css({
					color : to
				});	
				
				$( '.woocommerce form .form-row .required' ).css({
					color : to
				});	
				
				$( '.woocommerce a.remove' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce-error' ).css({
					borderTop : "3px solid" + to
				});
				
				$( '.woocommerce-info' ).css({
					borderTop : "3px solid" + to
				});
				
				$( '.woocommerce-message' ).css({
					borderTop : "3px solid" + to
				});
				
				$( '.woocommerce ul.products li.product .price' ).css({
					color : to
				});	
				
				$( '.woocommerce form .form-row.woocommerce-validated .select2-container' ).css({
					borderColor : to
				});	
				
				$( '.woocommerce form .form-row.woocommerce-validated input.input-text' ).css({
					borderColor : to
				});	
				
				$( '.woocommerce form .form-row.woocommerce-validated select' ).css({
					borderColor : to
				});	
				
				$( '.pm-quantum-alert-title' ).css({
					color : to
				});
				
				$( '.pm-gallery-item-title' ).css({
					backgroundColor : to
				});
				
				$( '.pm-workshop-newsletter-form-container input[type="text"]' ).css({
					color : to
				});
				
				$( '.panel-default > .panel-heading' ).css({
					backgroundColor : to
				});
				
				$( '.pm-course-post-title-box' ).css({
					backgroundColor : to
				});
				
				$( '.pm-secondary' ).css({
					color : to
				});
				
				$( '.pm-workshop-post-title-container' ).css({
					backgroundColor : to
				});
				
				$( '.pm-icon-bundle i' ).css({
					color : to
				});
				
				$( '.pm-icon-bundle-content p a' ).css({
					color : to
				});
				
				$( '.pm-pricing-table-header i' ).css({
					color : to
				});
				
				$( '.pm-single-blog-post-author-details .author-name span' ).css({
					color : to
				});
				
				$( '.recentcomments' ).css({
					color : to
				});
				
				$( '.pm-sidebar-search-icon-btn' ).css({
					color : to
				});
				
				$( '.pm-staff-profile-name' ).css({
					color : to
				});
				
				$( '.pm-rounded-btn a.current' ).css({
					backgroundColor : to,
					border : "3px solid" + to
				});
				
				$( '.pm-single-workshop-title' ).css({
					color : to
				});
				
				$( '.pm-single-course-title' ).css({
					color : to
				});
				
				$( '.pm-single-course-price' ).css({
					color : to
				});
				
				$( '.price' ).css({
					color : to
				});
				
				$( '.pm-career-post-details-box .title' ).css({
					color : to
				});
				
				$( '.pm-career-post-date-posted-box .date' ).css({
					color : to
				});
				
				$( '.pm-career-post-date-posted-box .year' ).css({
					color : to
				});
				
				$( '.pm-search-container' ).css({
					backgroundColor : convertHex(to, 95)
				});
				
				$( '.pm-secondary-bg' ).css({
					backgroundColor : to
				});
							
			}			
		});		
	});
	
	
				
				
	wp.customize( 'dividerColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				
				$( '.comment-body' ).css({
					borderBottom : "1px solid" + to
				});	
				
				$( '.woocommerce table.shop_table tbody th' ).css({
					borderTop : "1px solid" + to
				});	
				
				$( '.woocommerce table.shop_table tfoot td' ).css({
					borderTop : "1px solid" + to
				});	
				
				$( '.woocommerce table.shop_table tfoot th' ).css({
					borderTop : "1px solid" + to
				});	
				
				$( '.woocommerce .widget_shopping_cart .total' ).css({
					borderTop : "1px solid" + to
				});	
				
				$( '.woocommerce.widget_shopping_cart .total' ).css({
					borderTop : "1px solid" + to
				});	
				
				$( '.woocommerce .woocommerce-ordering select' ).css({
					border : "1px solid" + to
				});
				
				$( '.woocommerce #reviews #comment' ).css({
					border : "1px solid" + to
				});	
				
				$( '.input-text.qty.text' ).css({
					border : "1px solid" + to
				});	
				
				$( '.woocommerce #reviews #comments ol.commentlist li .comment-text' ).css({
					border : "1px solid" + to
				});	
				
				$( '.woocommerce div.product form.cart .variations select' ).css({
					border : "1px solid" + to
				});	
				
				$( '.woocommerce table.shop_table' ).css({
					border : "1px solid" + to
				});		
				
				$( '.woocommerce table.shop_table td' ).css({
					borderTop : "1px solid" + to
				});	
				
				$( '.woocommerce form .form-row input.input-text' ).css({
					border : "1px solid" + to
				});	
				
				$( '.woocommerce form .form-row textarea' ).css({
					border : "1px solid" + to
				});
				
				$( '.woocommerce form .form-row select' ).css({
					border : "1px solid" + to
				});	
				
				$( '.quantity .qty' ).css({
					border : "1px solid" + to
				});	
				
				$( '.pm-pagination li' ).css({
					border : "1px solid" + to
				});	
				
				$( '.related.products' ).css({
					borderTop : "1px solid" + to
				});	
				
				$( '.pm-returning-customer' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm_paginated-posts' ).css({
					borderTop : "3px solid" + to
				});
				
				$( '.pm-single-blog-post-categories-container' ).css({
					borderTop : "3px solid" + to
				});
				
				$( '.pm-textfield, input[id="author"]' ).css({
					border : "1px solid" + to
				});	
				
				
				$( 'input[id="email"]' ).css({
					border : "1px solid" + to
				});	
				
				$( 'input[id="url"]' ).css({
					border : "1px solid" + to
				});	
				
				$( 'input[id="username"]' ).css({
					border : "1px solid" + to
				});	
				
				$( 'input[id="password"]' ).css({
					border : "1px solid" + to
				});	
				
				$( 'input[id="account_password"]' ).css({
					border : "1px solid" + to
				});	
				
				$( '.woocommerce-billing-fields input[type="text"]' ).css({
					border : "1px solid" + to
				});	
				
				$( '.widget_recent_entries .pm-widget-spacer ul li' ).css({
					borderBottom : "3px solid" + to
				});
				
				$( '.pm-comment-form-textfield' ).css({
					border : "1px solid" + to
				});	
				
				$( '.pm-comment-form-textarea' ).css({
					border : "1px solid" + to
				});	
				
				$( '.pm-comment-html-tags' ).css({
					border : "1px solid" + to
				});	
				
				$( '.pm-comment-box-container' ).css({
					border : "1px solid" + to
				});	
				
				$( '.pm-single-blog-post-author-box' ).css({
					border : "1px solid" + to
				});	
				
				$( '.pm-textfield' ).css({
					border : "1px solid" + to
				});	
				
				$( '.pm-form-textfield-with-icon' ).css({
					border : "1px solid" + to
				});	
				
				$( '.pm-dropmenu' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-blog-post-container' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-dropmenu-active ul' ).css({
					borderBottom : "1px solid" + to,
					borderLeft : "1px solid" + to,
					borderRight : "1px solid" + to
				});
				
				$( '.pm-revised-schedules-ul li' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.pm-sidebar-popular-posts li' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.pm-comment-box-avatar-container' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( 'blockquote' ).css({
					borderColor : to
				});
				
				$( '.pm-sidebar-search-container' ).css({
					border : "1px solid" + to
				});
				
				$( '.widget_shopping_cart_content .total' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.product_list_widget li' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '#comment' ).css({
					border : "1px solid" + to
				});
				
				$( '.form-allowed-tags' ).css({
					border : "1px solid" + to
				});
				
				$( 'select' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-divider' ).css({
					backgroundColor : to
				});
				
				$( '.pm-sidebar .widget_meta ul li' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.pm-sidebar .widget_categories ul li' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.pm-sidebar .widget_archive ul li' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.pm-sidebar #recentcomments li' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.pm-page-share-options' ).css({
					borderTop : "1px solid" + to
				});
				
				$( '.pm_quick_contact_field.Light' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm_quick_contact_textarea.Light' ).css({
					border : "1px solid" + to
				});
							
			}			
		});		
	});		
		
			
	wp.customize( 'pageBackgroundColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( 'body' ).css({
					backgroundColor : to
				});				
			}			
		});		
	});
	
	wp.customize( 'blockQuoteColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( 'blockquote' ).css({
					borderLeftColor : to
				});				
			}			
		});		
	});
	
	wp.customize( 'commentBoxColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-comment-box-avatar-container' ).css({
					backgroundColor : to
				});	
				$( '.pm-single-blog-post-author-box' ).css({
					backgroundColor : to
				});	
				$( '.comment-author.vcard' ).css({
					backgroundColor : to
				});				
			}			
		});		
	});

	
	wp.customize( 'commentShareBoxColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-single-blog-post-author-box-share' ).css({
					backgroundColor : to
				});				
			}			
		});		
	});
	
	wp.customize( 'globalButtonBorderColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-sidebar .tagcloud a' ).css({
					border : "3px solid" + to
				});
				$( '.pm-rounded-btn a' ).css({
					border : "3px solid" + to
				});
				$( '.pm-rounded-submit-btn' ).css({
					border : "3px solid" + to
				});	
				$( '#submit' ).css({
					border : "3px solid" + to
				});	
				$( '#wp-submit' ).css({
					border : "3px solid" + to
				});
				$( '.comment-reply-link' ).css({
					border : "3px solid" + to
				});		
			}			
		});		
	});
	

	
	wp.customize( 'globalButtonBackgroundColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-sidebar .tagcloud a' ).css({
					backgroundColor : to
				});
				$( '.pm-rounded-btn a' ).css({
					backgroundColor : to
				});
				$( '.pm-rounded-submit-btn' ).css({
					backgroundColor : to
				});	
				$( '#submit' ).css({
					backgroundColor : to
				});	
				$( '#wp-submit' ).css({
					backgroundColor : to
				});	
				$( '.comment-reply-link' ).css({
					backgroundColor : to
				});		
			}			
		});		
	});
	
	wp.customize( 'mainNavColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( 'header' ).css({
					backgroundColor : to
				});	
				$( '.pm-members-nav-container' ).css({
					backgroundColor : to
				});	
			}			
		});		
	});
	
	wp.customize( 'mainNavBorderColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( 'header' ).css({
					borderTop : "1px solid" + to,
					borderBottom : "1px solid" + to
				});	
				$( '.pm-members-nav-container' ).css({
					border : "1px solid" + to
				});	
			}			
		});		
	});
	
	wp.customize( 'subpageHeaderBackgroundColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( 'header' ).css({
					backgroundColor : to
				});	
			}			
		});		
	});
	
	
	
	wp.customize( 'navBorderColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-members-navigation li' ).css({
					borderLeft : "1px solid" + to
				});	
				
				$( '.sf-menu a' ).css({
					borderRight : "1px solid" + to
				});
				
				$( '.sf-menu a' ).css({
					borderBottom : "1px solid" + to,
					borderLeft : "1px solid" + to
				});
				
				$( '.sf-menu ul li:last-child a' ).css({
					borderBottom : "1px solid" + to
				});
				
			}			
		});		
	});
	
	wp.customize( 'registerButtonColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-register-btn' ).css({
					backgroundColor : to
				});	
				
			}			
		});		
	});
	
	wp.customize( 'registerBorderColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-register-btn' ).css({
					border : "1px solid" + to,
				});	
				
			}			
		});		
	});
	
	wp.customize( 'loginButtonColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-login-btn' ).css({
					backgroundColor : to
				});
				
				$( '#pm-search-btn' ).css({
					backgroundColor : to
				});	
				
			}			
		});		
	});
	
	wp.customize( 'loginButtonBorderColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-login-btn' ).css({
					border : "1px solid" + to,
				});
				
				$( '#pm-search-btn' ).css({
					border : "1px solid" + to,
				});	
				
			}			
		});		
	});
	
	wp.customize( 'navButtonColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-members-navigation li' ).css({
					backgroundColor : to
				});
				
				$( '.sf-menu li' ).css({
					backgroundColor : to
				});
				
				$( '.sf-menu ul li' ).css({
					backgroundColor : to
				});
				
				$( '.pm-language-selector-menu .pm-dropmenu-active ul li' ).css({
					backgroundColor : to
				});
				
			}			
		});		
	});
	
	wp.customize( 'socialIconColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-footer-social-icons li a i' ).css({
					backgroundColor : to
				});
			}			
		});		
	});
	
	wp.customize( 'newsletterFieldColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-footer-subscribe-field' ).css({
					backgroundColor : to
				});
			}			
		});		
	});
	
	wp.customize( 'footerWidgetTitleColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-fat-footer h6' ).css({
					backgroundColor : to
				});
			}			
		});		
	});
	
	wp.customize( 'footerWidgetTitleIconColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-fat-footer h6 i' ).css({
					backgroundColor : to
				});
			}			
		});		
	});
	
	wp.customize( 'fatFooterBackgroundColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-fat-footer' ).css({
					backgroundColor : to
				});
			}			
		});		
	});
	
	wp.customize( 'footerBackgroundColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( 'footer' ).css({
					backgroundColor : to
				});
			}			
		});		
	});
	
	wp.customize( 'footerNavBackgroundColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-footer-copyright' ).css({
					backgroundColor : to
				});
			}			
		});		
	});
	
	wp.customize( 'postTitleBGColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-footer-copyright' ).css({
					backgroundColor : convertHex(to, 70)
				});
			}			
		});		
	});
	
	wp.customize( 'postDateBGColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-blog-post-date' ).css({
					backgroundColor : to
				});
				$( '.pm-single-blog-post-date' ).css({
					backgroundColor : to
				});
			}			
		});		
	});
	
	wp.customize( 'postExcerptDividerColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-blog-post-divider' ).css({
					backgroundColor : to
				});
			}			
		});		
	});
	
	wp.customize( 'postNavigationButtonColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-sub-header-post-pagination-ul .prev a' ).css({
					backgroundColor : convertHex(to, 70)
				});
				
				$( '.pm-sub-header-post-pagination-ul .next a' ).css({
					backgroundColor : convertHex(to, 70)
				});
			}			
		});		
	});
	
	wp.customize( 'postNavigationBorderColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-sub-header-post-pagination-ul .prev a' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-sub-header-post-pagination-ul .next a' ).css({
					border : "1px solid" + to
				});
			}			
		});		
	});
	
	wp.customize( 'postImageBorderColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-single-blog-post-img-container' ).css({
					border : "10px solid" + to
				});
			}			
		});		
	});
	
	wp.customize( 'postTitleBGColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-single-blog-post-title' ).css({
					backgroundColor : convertHex(to, 70)
				});
				$( '.pm-blog-post-title' ).css({
					backgroundColor : convertHex(to, 70)
				});
			}			
		});		
	});
	
	wp.customize( 'title_bg_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-workshop-post-date-container' ).css({
					backgroundColor : to
				});
			}			
		});		
	});
	
	wp.customize( 'view_details_btn_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-workshop-post-button-container' ).css({
					backgroundColor : to
				});
			}			
		});		
	});
	
	wp.customize( 'date_posted_bg_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-career-post-date-posted-box' ).css({
					backgroundColor : to
				});
				$( '.pm-single-career-post-date-posted-box' ).css({
					backgroundColor : to
				});
			}			
		});		
	});
	
	wp.customize( 'textBackgroundColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-presentation-text-container' ).css({
					backgroundColor : convertHex(to, 40)
				});
			}
		});		
	});
	
	wp.customize( 'buttonColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-presentation-posts .owl-controls .owl-buttons div' ).css({
					backgroundColor : convertHex(to, 70)
				});
			}
		});		
	});
	
	wp.customize( 'buttonBorderColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-presentation-posts .owl-controls .owl-buttons div' ).css({
					border : "1px solid" + to
				});
			}
		});		
	});

	wp.customize( 'titleBackgroundColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-presentation-post-title' ).css({
					backgroundColor : to
				});
			}
		});		
	});

	wp.customize( 'excerptBackgroundColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-presentation-post-excerpt' ).css({
					backgroundColor : convertHex(to, 70)
				});
			}
		});		
	});
	
	wp.customize( 'dateBackgroundColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-presentation-post-date' ).css({
					backgroundColor :to
				});
				$( '.pm-presentation-post-hover-container a' ).css({
					backgroundColor :to
				});
			}
		});		
	});
	
	wp.customize( 'testimonials_quote_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-testimonial-text-box' ).css({
					backgroundColor :to
				});
			}
		});		
	});
	
	wp.customize( 'data_table_title_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-workshop-table-title' ).css({
					backgroundColor :to
				});
			}
		});		
	});

	wp.customize( 'data_table_info_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-workshop-table-content' ).css({
					backgroundColor :to
				});
			}
		});		
	});
	
	wp.customize( 'statBox1_bg_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-statistic-box-container' ).css({
					backgroundColor :to
				});
			}
		});		
	});
	
	wp.customize( 'staff_profile_bg_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-staff-profile-container' ).css({
					backgroundColor :to
				});
			}
		});		
	});
	
	wp.customize( 'progress_bar_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-progress-bar .pm-progress-bar-outer' ).css({
					backgroundColor :to
				});
			}
		});		
	});
	
	wp.customize( 'quickLoginBackgroundColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-quick-login-container' ).css({
					backgroundColor :to
				});
			}
		});		
	});
	
	wp.customize( 'submitButtonColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '#btn-quick-login' ).css({
					backgroundColor :to
				});
			}
		});		
	});
	
	wp.customize( 'submitButtonBorderColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '#btn-quick-login' ).css({
					border : "1px solid" + to
				});
			}
		});		
	});
	
	wp.customize( 'activatorButtonColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '#pm-quick-login-btn' ).css({
					backgroundColor :to
				});
			}
		});		
	});
	
	wp.customize( 'activatorBorderColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '#pm-quick-login-btn' ).css({
					border : "1px solid" + to
				});
			}
		});		
	});
	
	wp.customize( 'notificationBackgroundColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-quick-login-message' ).css({
					backgroundColor :to
				});
			}
		});		
	});
	
	wp.customize( 'notificationBorderColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-quick-login-message' ).css({
					border : "1px solid" + to
				});
			}
		});		
	});





	// Page layouts.
	/*wp.customize( 'page_layout', function( value ) {
		value.bind( function( to ) {
			if ( 'one-column' === to ) {
				$( 'body' ).addClass( 'page-one-column' ).removeClass( 'page-two-column' );
			} else {
				$( 'body' ).removeClass( 'page-one-column' ).addClass( 'page-two-column' );
			}
		} );
	} );*/
	
	//convertHex('#A7D136',50)
	function convertHex(hex,opacity){
		hex = hex.replace('#','');
		r = parseInt(hex.substring(0,2), 16);
		g = parseInt(hex.substring(2,4), 16);
		b = parseInt(hex.substring(4,6), 16);
	
		result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
		return result;
	}

	// Whether a header image is available.
	function hasHeaderImage() {
		var image = wp.customize( 'header_image' )();
		return '' !== image && 'remove-header' !== image;
	}

	// Whether a header video is available.
	function hasHeaderVideo() {
		var externalVideo = wp.customize( 'external_header_video' )(),
			video = wp.customize( 'header_video' )();

		return '' !== externalVideo || ( 0 !== video && '' !== video );
	}

	// Toggle a body class if a custom header exists.
	/*$.each( [ 'external_header_video', 'header_image', 'header_video' ], function( index, settingId ) {
		wp.customize( settingId, function( setting ) {
			setting.bind(function() {
				if ( hasHeaderImage() ) {
					$( document.body ).addClass( 'has-header-image' );
				} else {
					$( document.body ).removeClass( 'has-header-image' );
				}

				if ( ! hasHeaderVideo() ) {
					$( document.body ).removeClass( 'has-header-video' );
				}
			} );
		} );
	} );*/

} )( jQuery );