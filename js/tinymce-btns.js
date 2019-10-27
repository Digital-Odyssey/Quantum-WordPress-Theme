(function() {  

	////////////////////// FEATURE BOX
	tinymce.create('tinymce.plugins.featureBox', {  

        init : function(ed, url) {  

            ed.addButton('featureBox', {  

                title : 'Feature Box',  

                image : url+'/buttons/feature-box.gif',  

                onclick : function() {  

                     ed.selection.setContent('[featureBox icon="fa fa-thumbs-o-up" icon_color="#ffffff" title_color="#ffffff" title="Title goes here"]Content goes here[/featureBox]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('featureBox', tinymce.plugins.featureBox);
	

	//////////////////// POST ITEMS
    tinymce.create('tinymce.plugins.postItems', {  

        init : function(ed, url) {  

            ed.addButton('postItems', {  

                title : 'Post Items',  

                image : url+'/buttons/post-items.gif',  

                onclick : function() {  

                     ed.selection.setContent('[postItems num_of_posts="3" post_order="DESC" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('postItems', tinymce.plugins.postItems);
	

	////////////////////// BOX BUTTON
	tinymce.create('tinymce.plugins.boxButton', {  

        init : function(ed, url) {  

            ed.addButton('boxButton', {  

                title : 'Box Button',  

                image : url+'/buttons/button2.gif',  

                onclick : function() {  

                     ed.selection.setContent('[boxButton link="#" margin_top="0" margin_bottom="0" icon="typcn typcn-vendor-microsoft" target="_self"]' + ed.selection.getContent() + '[/boxButton]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('boxButton', tinymce.plugins.boxButton); 

	//////////////////// WORKSHOP POST
    tinymce.create('tinymce.plugins.workshopPost', {  

        init : function(ed, url) {  

            ed.addButton('workshopPost', {  

                title : 'Workshop Post',  

                image : url+'/buttons/workshopPost.gif',  

                onclick : function() {  

                     ed.selection.setContent('[workshopPost post_id="" class="wow fadeInUp" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('workshopPost', tinymce.plugins.workshopPost);


	//////////////////// STAFF PROFILE
    tinymce.create('tinymce.plugins.staffProfile', {  

        init : function(ed, url) {  

            ed.addButton('staffProfile', {  

                title : 'Staff Profile',  

                image : url+'/buttons/staffProfile.gif',  

                onclick : function() {  

                     ed.selection.setContent('[staffProfile id="" name_color="#2C5E83" title_color="#4B4B4B" text_color="#4b4b4b" icon_color="#dad9d9" target="_blank" class="wow fadeInUp" animation_delay="1" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('staffProfile', tinymce.plugins.staffProfile);


	//////////////////// PRICING TABLE
    tinymce.create('tinymce.plugins.pricingTable', {  

        init : function(ed, url) {  

            ed.addButton('pricingTable', {  

                title : 'Pricing Table',  

                image : url+'/buttons/pricingTable.gif',  

                onclick : function() {  

                     ed.selection.setContent('[pricingTable title="Advanced" icon="typcn typcn-vendor-android" price="$49.99" subscript="/yearly" button_text="Buy Now" button_link="http://www.google.com" header_color="#2B5D82" price_color="#DBC164" icon_color="#2B5D82"]' + ed.selection.getContent() + '[/pricingTable]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('pricingTable', tinymce.plugins.pricingTable);


	//////////////////// DATA TABLE GROUP
    tinymce.create('tinymce.plugins.dataTableGroup', {  

        init : function(ed, url) {  

            ed.addButton('dataTableGroup', {  

                title : 'Data Table',  

                image : url+'/buttons/dataTable.gif',  

                onclick : function() {  

                     ed.selection.setContent('[dataTableGroup]<br />[dataTableItem title="Column Title"]' + ed.selection.getContent() + '[/dataTableItem]<br />[/dataTableGroup]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('dataTableGroup', tinymce.plugins.dataTableGroup);


	//////////////////// STAT BOX 2
    tinymce.create('tinymce.plugins.statBox2', {  

        init : function(ed, url) {  

            ed.addButton('statBox2', {  

                title : 'Statistic Box 2',  

                image : url+'/buttons/statBox2.gif',  

                onclick : function() {  

                     ed.selection.setContent('[statBox2 bg_image="" stat_number="10" stat_title="Engineers" text_color="white" class="wow fadeInUp" animation_delay="1"]' + ed.selection.getContent() + '[/statBox2]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('statBox2', tinymce.plugins.statBox2);


	//////////////////// STAT BOX 1
    tinymce.create('tinymce.plugins.statBox1', {  

        init : function(ed, url) {  

            ed.addButton('statBox1', {  

                title : 'Statistic Box 1',  

                image : url+'/buttons/statBox1.gif',  

                onclick : function() {  

                     ed.selection.setContent('[statBox1 stat_image="" stat_percentage="75%" text_color="white" class="wow fadeInUp" animation_delay="1"]' + ed.selection.getContent() + '[/statBox1]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('statBox1', tinymce.plugins.statBox1);
	

	//////////////////// CTA BOX 2
    tinymce.create('tinymce.plugins.ctaBox2', {  

        init : function(ed, url) {  

            ed.addButton('ctaBox2', {  

                title : 'Call To Action version 2',  

                image : url+'/buttons/ctaBox2.gif',  

                onclick : function() {  

                     ed.selection.setContent('[ctaBox2 divider_color="#dbc164" class=""]' + ed.selection.getContent() + '[/ctaBox2]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('ctaBox2', tinymce.plugins.ctaBox2);
	
	
	//////////////////// NEWSLETTER SIGNUP
    tinymce.create('tinymce.plugins.newsletterSignup', {  

        init : function(ed, url) {  

            ed.addButton('newsletterSignup', {  

                title : 'Newsletter form',  

                image : url+'/buttons/newsletterSignup.gif',  

                onclick : function() {  

                     ed.selection.setContent('[newsletterSignup mailchimp_url="" name_placeholder="Your Name" email_placeholder="Email Address" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('newsletterSignup', tinymce.plugins.newsletterSignup); 
	 

	//////////////////// QUOTE BOX
    tinymce.create('tinymce.plugins.quoteBox', {  

        init : function(ed, url) {  

            ed.addButton('quoteBox', {  

                title : 'Quote Box',  

                image : url+'/buttons/quoteBox.gif',  

                onclick : function() {  

                     ed.selection.setContent('[quoteBox author_name="Jane Tolman" author_title="Visual Designer, Academix Systems" avatar="" text_color="#333354" name_color="#295D84"]' + ed.selection.getContent() + '[/quoteBox]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('quoteBox', tinymce.plugins.quoteBox);  

	
	//////////////////// PIE CHART
    tinymce.create('tinymce.plugins.piechart', {  

        init : function(ed, url) {  

            ed.addButton('piechart', {  

                title : 'Pie Chart',  

                image : url+'/buttons/counter.gif',  

                onclick : function() {  

                     ed.selection.setContent('[piechart bar_size="220" line_width="7" track_color="#dbdbdb" bar_color="#2B5C84" percentage="75" icon="typcn typcn-thumbs-up" caption="Cost Reduction" font_size="40" display_percent="true" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('piechart', tinymce.plugins.piechart);  
	
	
	//////////////////// MILESTONE
    tinymce.create('tinymce.plugins.milestone', {  

        init : function(ed, url) {  

            ed.addButton('milestone', {  

                title : 'Milestone',  

                image : url+'/buttons/milestone.gif',  

                onclick : function() {  

                     ed.selection.setContent('[milestone speed="2000" stop="75" caption="Quality Assurance" icon="typcn typcn-chart-line" font_size="60" style="1" display_percent="true" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('milestone', tinymce.plugins.milestone);  
	
	
	//////////////////// COUNTDOWN
    tinymce.create('tinymce.plugins.countdown', {  

        init : function(ed, url) {  

            ed.addButton('countdown', {  

                title : 'Countdown',  

                image : url+'/buttons/countdown.gif',  

                onclick : function() {  

                     ed.selection.setContent('[countdown date="2014/08/25" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('countdown', tinymce.plugins.countdown);  		
	

	//////////////////// COLUMN CONTAINER
    tinymce.create('tinymce.plugins.bootstrapContainer', {  

        init : function(ed, url) {  

            ed.addButton('bootstrapContainer', {  

                title : 'Bootstrap Container',  

                image : url+'/buttons/cc.gif',  

                onclick : function() {  

                     ed.selection.setContent('[bootstrapContainer fullscreen="off" fullscreen_container="on" bgcolor="transparent" bgimage="" bgposition="static" bgrepeat="repeat-x" alignment="left" paddingTop="60" paddingBottom="60" border_color="#DBC164" border_height="0" parallax="off" icon="" class="" id=""]' + ed.selection.getContent() + '[/bootstrapContainer]');  


                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('bootstrapContainer', tinymce.plugins.bootstrapContainer);  	
	
	
	//////////////////// CONTAINER
	tinymce.create('tinymce.plugins.bootstrapRow', {  

        init : function(ed, url) {  

            ed.addButton('bootstrapRow', {  

                title : 'Bootstrap Row',  

                image : url+'/buttons/container.gif',  

                onclick : function() {  

                     ed.selection.setContent('[bootstrapRow class=""]' + ed.selection.getContent() + '[/bootstrapRow]');

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;

        },  

    });  

    tinymce.PluginManager.add('bootstrapRow', tinymce.plugins.bootstrapRow); 
	 
	
	//////////////////// COLUMN
    tinymce.create('tinymce.plugins.bootstrapColumn', {  

        init : function(ed, url) {  

            ed.addButton('bootstrapColumn', {  

                title : 'Bootstrap Column',  

                image : url+'/buttons/column.gif',  

                onclick : function() {  

                     ed.selection.setContent('[bootstrapColumn col_large="12" col_medium="12" col_small="12" col_extrasmall="12" class=""]' + ed.selection.getContent() + '[/bootstrapColumn]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('bootstrapColumn', tinymce.plugins.bootstrapColumn); 

	
	////////////////////// CLIENT CAROUSEL
	
	tinymce.create('tinymce.plugins.clientCarousel', {  

        init : function(ed, url) {  

            ed.addButton('clientCarousel', {  

                title : 'Client Carousel',  

                image : url+'/buttons/clientCarousel.gif',  

                onclick : function() {  

                     ed.selection.setContent('[clientCarousel target="_self" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('clientCarousel', tinymce.plugins.clientCarousel);
	
	
	////////////////////// PANELS CAROUSEL
	
	tinymce.create('tinymce.plugins.panelsCarousel', {  

        init : function(ed, url) {  

            ed.addButton('panelsCarousel', {  

                title : 'Panels Carousel',  

                image : url+'/buttons/panelsCarousel.gif',  

                onclick : function() {  

                     ed.selection.setContent('[panelsCarousel target="_self" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('panelsCarousel', tinymce.plugins.panelsCarousel);
	

    ////////////////////// SLIDER CAROUSEL
	
	tinymce.create('tinymce.plugins.sliderCarousel', {  

        init : function(ed, url) {  

            ed.addButton('sliderCarousel', {  

                title : 'Slider Carousel',  

                image : url+'/buttons/slider.gif',  

                onclick : function() {  

                     ed.selection.setContent('[sliderCarousel animation="slide"]<br />[sliderItem img="" title="" /]<br />[/sliderCarousel]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('sliderCarousel', tinymce.plugins.sliderCarousel);
    

	////////////////////// CTA BOX
	
	tinymce.create('tinymce.plugins.ctaBox', {  

        init : function(ed, url) {  

            ed.addButton('ctaBox', {  

                title : 'Call To Action Box',  

                image : url+'/buttons/ctaBox.gif',  

                onclick : function() {  

                     ed.selection.setContent('[ctaBox title="" icon="fa fa-exclamation" icon_color="#DBC164"]' + ed.selection.getContent() + '[/ctaBox]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('ctaBox', tinymce.plugins.ctaBox); 


	////////////////////// DIVIDER
	
	tinymce.create('tinymce.plugins.divider', {  

        init : function(ed, url) {  

            ed.addButton('divider', {  

                title : 'Content divider',  

                image : url+'/buttons/divider.gif',  

                onclick : function() {  

                     ed.selection.setContent('[divider height="1" bg_color="#E3E3E3" margin="20" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('divider', tinymce.plugins.divider); 

	////////////////////// ALERT
	
	tinymce.create('tinymce.plugins.alert', {  

        init : function(ed, url) {  

            ed.addButton('alert', {  

                title : 'Alert Box',  

                image : url+'/buttons/alert.png',  

                onclick : function() {  

                     ed.selection.setContent('[alert close="true" type="success" icon=""]' + ed.selection.getContent() + '[/alert]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('alert', tinymce.plugins.alert); 

	////////////////////// GOOGLE MAP
	
	tinymce.create('tinymce.plugins.googleMap', {  

        init : function(ed, url) {  

            ed.addButton('googleMap', {  

                title : 'Google Map',  

                image : url+'/buttons/google-map.png',  

                onclick : function() {  

                     ed.selection.setContent('[googleMap id="anotherMap" zoom="13" latitude="43.656885" longitude="-79.383904" message="We are here" height="300" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('googleMap', tinymce.plugins.googleMap); 
	

	////////////////////// PANEL HEADER
	
	tinymce.create('tinymce.plugins.panelHeader', {  

        init : function(ed, url) {  

            ed.addButton('panelHeader', {  

                title : 'Panel Header',  

                image : url+'/buttons/panel-header.gif',  

                onclick : function() {  

                     ed.selection.setContent('[panelHeader panel_style="1" link="" target="_self" color="" show_button="true" button_text="" margin_bottom="10" icon="fa-angle-right" tip="" bg_color="transparent" ]' + ed.selection.getContent() + '[/panelHeader]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('panelHeader', tinymce.plugins.panelHeader); 
	
	////////////////////// COLUMN HEADER
	
	tinymce.create('tinymce.plugins.columnHeader', {  

        init : function(ed, url) {  

            ed.addButton('columnHeader', {  

                title : 'Column Header',  

                image : url+'/buttons/column-header.gif',  

                onclick : function() {  

                     ed.selection.setContent('[columnHeader color="" margin_bottom="0"]' + ed.selection.getContent() + '[/columnHeader]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('columnHeader', tinymce.plugins.columnHeader); 
	

	////////////////////// BUTTON
	
	tinymce.create('tinymce.plugins.standardButton', {  

        init : function(ed, url) {  

            ed.addButton('standardButton', {  

                title : 'Standard Button',  

                image : url+'/buttons/button.gif',  

                onclick : function() {  

                     ed.selection.setContent('[standardButton link="#" margin_top="20" margin_bottom="20" target="_self" icon="fa fa-angle-right" transparency="off" animated="off" class=""]' + ed.selection.getContent() + '[/standardButton]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('standardButton', tinymce.plugins.standardButton); 
	
	
	
	
	
	 /////////////////// PROGRESS BAR
	
     tinymce.create('tinymce.plugins.progressBar', {  

        init : function(ed, url) {  

            ed.addButton('progressBar', {  

                title : 'Progress bar',  

                image : url+'/buttons/progress-bar.gif',  

                onclick : function() {  

                     ed.selection.setContent('[progressBar percentage="75" text="Increased Productivity" id="1" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('progressBar', tinymce.plugins.progressBar);  
	
	
	//////////////////// SINGLE POST
	
	
     tinymce.create('tinymce.plugins.singlepost', {  

        init : function(ed, url) {  

            ed.addButton('singlepost', {  

                title : 'Single Post',  

                image : url+'/buttons/single-post.gif',  

                onclick : function() {  

                     ed.selection.setContent('[singlePost id="1" /]');  

  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('singlepost', tinymce.plugins.singlepost); 
		
	
	//////////////////// ICON
    tinymce.create('tinymce.plugins.iconElement', {  

        init : function(ed, url) {  

            ed.addButton('iconElement', {  

                title : 'Icon Element',  

                image : url+'/buttons/icon.gif',  

                onclick : function() {  

                     ed.selection.setContent('[iconElement symbol="typcn typcn-device-tablet" color="#2C5C82" size="4" /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('iconElement', tinymce.plugins.iconElement);
	
	
	//////////////////// YOUTUBE
    tinymce.create('tinymce.plugins.youtubeVideo', {  

        init : function(ed, url) {  

            ed.addButton('youtubeVideo', {  

                title : 'Youtube Video',  

                image : url+'/buttons/youtube.png',  

                onclick : function() {  

                     ed.selection.setContent('[youtubeVideo id="0" height="250" /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('youtubeVideo', tinymce.plugins.youtubeVideo);
	
	
	
	//////////////////// VIMEO
    tinymce.create('tinymce.plugins.vimeoVideo', {  

        init : function(ed, url) {  

            ed.addButton('vimeoVideo', {  

                title : 'Vimeo Video',  

                image : url+'/buttons/vimeo.png',  

                onclick : function() {  

                     ed.selection.setContent('[vimeoVideo id="0" height="250" /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('vimeoVideo', tinymce.plugins.vimeoVideo);
	
	
	//////////////////// HTML5 VIDEO


    tinymce.create('tinymce.plugins.html5Video', {  

        init : function(ed, url) {  

            ed.addButton('html5Video', {  

                title : 'HTML5 Video',  

                image : url+'/buttons/html5-video.png',  

                onclick : function() {  

                     ed.selection.setContent('[html5Video webm="" mp4="" ogg=""][/html5Video]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('html5Video', tinymce.plugins.html5Video);
	
	
	//////////////////// TAB GROUP


    tinymce.create('tinymce.plugins.tabGroup', {  

        init : function(ed, url) {  

            ed.addButton('tabGroup', {  

                title : 'Tab Group',  

                image : url+'/buttons/tab-group.gif',  

                onclick : function() {  

                     ed.selection.setContent('[tabGroup]<br />[tabItem title="Tab"]' + ed.selection.getContent() + '[/tabItem]<br />[/tabGroup]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('tabGroup', tinymce.plugins.tabGroup);
	
	
	//////////////////// ACCORDION GROUP


    tinymce.create('tinymce.plugins.accordionGroup', {  

        init : function(ed, url) {  

            ed.addButton('accordionGroup', {  

                title : 'Accordion Group',  

                image : url+'/buttons/accordion.gif',  

                onclick : function() {  

                     ed.selection.setContent('[accordionGroup]<br />[accordionItem title="Accordion Item 1"]' + ed.selection.getContent() + '[/accordionItem]<br />[/accordionGroup]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('accordionGroup', tinymce.plugins.accordionGroup);
	
	
	//////////////////// FEATURED GALLERY


    /*tinymce.create('tinymce.plugins.featuredGallery', {  

        init : function(ed, url) {  

            ed.addButton('featuredGallery', {  

                title : 'Featured Gallery',  

                image : url+'/buttons/posts.gif',  

                onclick : function() {  

                     ed.selection.setContent('[featuredGallery items="4" order_by="DESC" padding_top="20" padding_bottom="20" /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('featuredGallery', tinymce.plugins.featuredGallery);*/
	
	
	//////////////////// TESTIMONIALS


    tinymce.create('tinymce.plugins.testimonials', {  

        init : function(ed, url) {  

            ed.addButton('testimonials', {  

                title : 'Testimonials',  

                image : url+'/buttons/testimonials.gif',  

                onclick : function() {  

                     ed.selection.setContent('[testimonials /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('testimonials', tinymce.plugins.testimonials);
	
	
	//////////////////// CONTACT FORM


    tinymce.create('tinymce.plugins.contactForm', {  

        init : function(ed, url) {  

            ed.addButton('contactForm', {  

                title : 'Contact Form',  

                image : url+'/buttons/contact-form.gif',  

                onclick : function() {  

                     ed.selection.setContent('[contactForm title="Contact Form" title_size="28" email_address="name@yourdomain.com" alert_message="All fields are required." button_text="Send Message" text_color="red" /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('contactForm', tinymce.plugins.contactForm);
	
	
	//////////////////// IMAGE PANEL


    tinymce.create('tinymce.plugins.imagePanel', {  

        init : function(ed, url) {  

            ed.addButton('imagePanel', {  

                title : 'Image Panel',  

                image : url+'/buttons/image-panel.gif',  

                onclick : function() {  

                     ed.selection.setContent('[imagePanel icon="fa fa-link" link="#" image="" /]');   

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('imagePanel', tinymce.plugins.imagePanel);

    
})();  