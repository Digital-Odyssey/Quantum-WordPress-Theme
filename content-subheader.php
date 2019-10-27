<!-- SUBHEADER AREA -->

<?php 
		
	//Sub-header options
	$getEnableParallax = get_theme_mod('enableParallax');
	$enableParallax = $getEnableParallax == '' ? 'on' : $getEnableParallax;
	$globalHeaderImage = get_theme_mod('globalHeaderImage');
	$globalHeaderImage2 = get_theme_mod('globalHeaderImage2');

?>
        
<!-- Subpage Header layouts -->
<?php if( function_exists( 'is_shop' ) ) {//woocommerce installed ?>

        <?php if( is_shop() ) { //Load Woocommerce shop header ?>
        
                <?php 
                    global $woocommerce;
                    $pageid = get_option('woocommerce_shop_page_id');
                    $pm_woocom_header_image_meta = get_post_meta($pageid, 'pm_header_image_meta', true); 
                ?>
                
                <?php if($pm_woocom_header_image_meta !== '') { ?>
            
                    <?php if($enableParallax == 'on') { ?>
        
                        <div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="95" style="background-image:url('<?php echo esc_html($pm_woocom_header_image_meta); ?>')">
                    
                    <?php } else { ?>
                    
                        <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($pm_woocom_header_image_meta); ?>')">
                    
                    <?php } ?>
                
                <?php } else { ?>
                
                        <div class="pm-sub-header-container">
                
                <?php } ?>
                
        <?php } elseif( is_product() ) {//Load Woocommerce product header ?>
        
                <?php 
                    global $woocommerce;
                    $pm_woocom_header_image_meta = get_post_meta(get_the_ID(), 'pm_woocom_header_image_meta', true); 
                ?>
                
                <?php if($pm_woocom_header_image_meta !== '') { ?>
            
                    <?php if($enableParallax == 'on') { ?>
        
                        <div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="95" style="background-image:url('<?php echo esc_html($pm_woocom_header_image_meta); ?>')">
                    
                    <?php } else { ?>
                    
                        <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($pm_woocom_header_image_meta); ?>')">
                    
                    <?php } ?>
                
                <?php } else { ?>
                
                        <div class="pm-sub-header-container">
                
                <?php } ?>
        
        <?php } elseif( is_product_category() || is_product_tag() ) {//Load Woocommerce archive header ?>
        
                <?php 
                    $wooCategoryHeaderImage = get_theme_mod('wooCategoryHeaderImage'); 
                ?>
                
                <?php if($wooCategoryHeaderImage !== '') { ?>
            
                    <?php if($enableParallax == 'on') { ?>
        
                        <div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="95" style="background-image:url('<?php echo esc_html($wooCategoryHeaderImage); ?>')">
                    
                    <?php } else { ?>
                    
                        <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($wooCategoryHeaderImage); ?>')">
                    
                    <?php } ?>
                
                <?php } else { ?>
                
                        <div class="pm-sub-header-container">
                
                <?php } ?>
        
        <?php } elseif( is_404() || is_search() || is_tag() || is_category() || is_archive() ) { ?>
        
                <?php if($globalHeaderImage !== '') { ?>
            
                    <?php if($enableParallax == 'on') { ?>
        
                        <div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="95" style="background-image:url('<?php echo esc_html($globalHeaderImage); ?>')">
                    
                    <?php } else { ?>
                    
                        <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($globalHeaderImage); ?>')">
                    
                    <?php } ?>
                
                <?php } else { ?>
                
                        <div class="pm-sub-header-container">
                
                <?php } ?>
            
        <?php } else { ?>
        
                <?php
                    $pageHeaderImage = get_post_meta(get_the_ID(), 'pm_header_image_meta', true); 
                    $pageHeaderMessage = get_post_meta(get_the_ID(), 'pm_header_message_meta', true); 
                ?>
                
                <?php if($pageHeaderImage !== '') { ?>
                
                	<!-- Display global header image -->
                    <?php if($enableParallax == 'on') { ?>
        
                        <div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="95" style="background-image:url('<?php echo esc_html($pageHeaderImage); ?>')">
                    
                    <?php } else { ?>
                    
                        <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($pageHeaderImage); ?>')">
                    
                    <?php } ?>
                
                <?php } elseif($globalHeaderImage2 !== '') { ?>
                
                	<!-- Display page header image -->
                    <?php if($enableParallax == 'on') { ?>
        
                        <div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="95" style="background-image:url('<?php echo esc_html($globalHeaderImage2); ?>')">
                    
                    <?php } else { ?>
                    
                        <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($globalHeaderImage2); ?>')">
                    
                    <?php } ?>
                
                <?php } else { ?>
                
                	<!-- Display empty sub-header -->
                    <div class="pm-sub-header-container">
                
                <?php } ?>
        
        
        <?php } ?>

<?php } else {//woocommerce not installed ?>

        <?php if( is_404() || is_search() || is_tag() || is_category() || is_archive() ) {//Display Global header image on these pages ?>
        
            <?php if($globalHeaderImage !== '') { ?>
            
                <?php if($enableParallax == 'on') { ?>
    
                    <div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="95" style="background-image:url('<?php echo esc_html($globalHeaderImage); ?>')">
                
                <?php } else { ?>
                
                    <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($globalHeaderImage); ?>')">
                
                <?php } ?>
            
            <?php } else { ?>
            
                    <div class="pm-sub-header-container">
            
            <?php } ?>
        
        <?php } else {//Display Page header on pages ?>
        
                <?php
                    $pageHeaderImage = get_post_meta(get_the_ID(), 'pm_header_image_meta', true); 
                    $pageHeaderMessage = get_post_meta(get_the_ID(), 'pm_header_message_meta', true); 
                ?>
        
                <?php if($pageHeaderImage !== '') { ?>
                
                	<!-- Display global header image -->
                    <?php if($enableParallax == 'on') { ?>
        
                        <div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="95" style="background-image:url('<?php echo esc_html($pageHeaderImage); ?>')">
                    
                    <?php } else { ?>
                    
                        <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($pageHeaderImage); ?>')">
                    
                    <?php } ?>
                
                <?php } elseif($globalHeaderImage2 !== '') { ?>
                
                	<!-- Display page header image -->
                    <?php if($enableParallax == 'on') { ?>
        
                        <div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="95" style="background-image:url('<?php echo esc_html($globalHeaderImage2); ?>')">
                    
                    <?php } else { ?>
                    
                        <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($globalHeaderImage2); ?>')">
                    
                    <?php } ?>
                
                <?php } else { ?>
                
                	<!-- Display empty sub-header -->
                    <div class="pm-sub-header-container">
                
                <?php } ?>
        
        <?php } ?>

<?php } ?>

    <!-- Breadcrumbs -->
    <?php if( function_exists('is_shop') ) {//Woocommerce enabled ?>
    
        <?php if( is_shop() || is_product() || is_product_category() || is_product_tag()  ) { ?>
            <div class="pm-sub-header-breadcrumbs">
                <?php				
                    $args = array(
                            'delimiter' => '<p> &nbsp;<i class="fa fa-angle-right"></i> &nbsp;</p>',
                            'wrap_before' => '<div class="woocommerce-breadcrumb pm-sub-header-breadcrumbs-ul" itemprop="breadcrumb">',
                            'wrap_after' => '</div>',
                            'before' => '<p>',
                            'after' => '</p>',
                    );
                ?>
                
                <?php woocommerce_breadcrumb( $args ); ?>
            </div>
        <?php } else { ?>
        
        	<?php if( !is_tax('gallerycats') && !is_tax('gallerytags') ) : ?>
            
            	<?php 
				
					$enableBreadCrumbs = get_theme_mod('enableBreadCrumbs', 'on'); 
				
				?>
                <?php if($enableBreadCrumbs === 'on'){ ?>
                        <div class="pm-sub-header-breadcrumbs">
                            <?php pm_ln_breadcrumbs(); ?>
                        </div>
                <?php } ?>
            
            <?php endif ?>    
        
        <?php } ?>	
    
    <?php } else {//Woocommerce not enabled ?>
    
        <?php if( !is_tax('gallerycats') && !is_tax('gallerytags') ) : ?>
            
			<?php $enableBreadCrumbs = get_theme_mod('enableBreadCrumbs', 'on'); ?>
            <?php if($enableBreadCrumbs === 'on'){ ?>
                    <div class="pm-sub-header-breadcrumbs">
                        <?php pm_ln_breadcrumbs(); ?>
                    </div>
            <?php } ?>
        
        <?php endif ?>  
    
    <?php } ?>
                
    
    <!-- Header Page Title --> 
    <?php if( function_exists('is_shop') ) {//Woocommerce enabled ?>
    
            <?php if( is_search() && is_shop() ) { ?>
    
                    <div class="pm-sub-header-title-container">
                        <h5><?php esc_attr_e('Search Results for:', 'quantumtheme'); ?></h5>
                    </div>
            
            <?php } else if( is_shop() ) { ?>
                            
                    <div class="pm-sub-header-title-container">
                        <h5><?php woocommerce_page_title(); ?></h5>
                    </div>
            
            <?php } else if( is_404() ) { ?>
            
                    <div class="pm-sub-header-title-container">
                        <h5><?php esc_attr_e('404 Error', 'quantumtheme'); ?></h5>
                    </div>
            
            <?php } else if( is_search() ) { ?>
            
                    <div class="pm-sub-header-title-container">
                        <h5><?php esc_attr_e('Search Results for:', 'quantumtheme'); ?></h5>
                    </div>
                    
            <?php } else if(is_tag()) { ?>
            
                    <div class="pm-sub-header-title-container">
                        <h5><?php esc_attr_e('News tagged with:', 'quantumtheme'); ?></h5>
                    </div>
                    
            <?php } else if(is_category()) { ?>
            
                    <div class="pm-sub-header-title-container">
                        <h5><?php esc_attr_e('News filed in:', 'quantumtheme'); ?></h5>
                    </div>
                    
            <?php } else if(is_tax('gallerycats') ) { ?>
            
            		<div class="pm-sub-header-title-container">
                        <h5><?php single_tag_title("Gallery posts filed in &quot;"); echo '&quot; '; ?></h5>
                    </div>
                    
            <?php } else if(is_tax('gallerytags') ) { ?>
            
            		<div class="pm-sub-header-title-container">
                        <h5><?php single_tag_title("Gallery posts tagged in &quot;"); echo '&quot; '; ?></h5>
                    </div>
                    
            <?php } else if( is_archive() ) { ?>
            
                    <div class="pm-sub-header-title-container">
                        <h5><?php esc_attr_e('Archive for', 'quantumtheme'); ?></h5>
                    </div>
            
            <?php } else { ?>
            
                    <div class="pm-sub-header-title-container">
                        <h5><?php the_title(); ?></h5>
                    </div>
            
            <?php } ?>
    
    <?php } else {//Woocommerce not enabled ?>

        
        <?php if( is_404() ) { ?>
        
                <div class="pm-sub-header-title-container">
                    <h5><?php esc_attr_e('404 Error', 'quantumtheme'); ?></h5>
                </div>
        
        <?php } else if( is_search() ) { ?>
        
                <div class="pm-sub-header-title-container">
                    <h5><?php esc_attr_e('Search Results for:', 'quantumtheme'); ?></h5>
                </div>
                
        <?php } else if(is_tag()) { ?>
        
                <div class="pm-sub-header-title-container">
                    <h5><?php esc_attr_e('News tagged with:', 'quantumtheme'); ?></h5>
                </div>
                
        <?php } else if(is_category()) { ?>
        
                <div class="pm-sub-header-title-container">
                    <h5><?php esc_attr_e('News filed in:', 'quantumtheme'); ?></h5>
                </div>
                
        <?php } else if(is_tax('gallerycats') ) { ?>
            
            		<div class="pm-sub-header-title-container">
                        <h5><?php single_tag_title("Gallery posts filed in &quot;"); echo '&quot; '; ?></h5>
                    </div>
                    
        <?php } else if(is_tax('gallerytags') ) { ?>
            
            		<div class="pm-sub-header-title-container">
                        <h5><?php single_tag_title("Gallery posts tagged in &quot;"); echo '&quot; '; ?></h5>
                    </div>
                
        <?php } else if( is_archive() ) { ?>
        
                <div class="pm-sub-header-title-container">
                    <h5><?php esc_attr_e('Archive for', 'quantumtheme'); ?></h5>
                </div>
        
        <?php } else { ?>
        
                <div class="pm-sub-header-title-container">
                    <h5><?php the_title(); ?></h5>
                </div>
        
        <?php } ?>
    
    <?php } ?>
                          
    
    <!-- Header Message -->
    <?php if( function_exists('is_shop') ) {//Woocommerce enabled ?>
    
        <?php if( is_search() && is_shop() ) { ?>

            <div class="pm-sub-header-message">
                <p>"<?php echo get_search_query(); ?>"</p>
            </div>
 
        <?php } else if( is_shop() ) { ?>
        
                <?php 
                    global $woocommerce;
                    $pageid = get_option('woocommerce_shop_page_id');
                    $pm_header_message_meta = get_post_meta($pageid, 'pm_header_message_meta', true); 
                    //$pm_woocom_header_message_meta = get_post_meta(get_the_ID(), 'pm_woocom_header_message_meta', true); 
                ?>
                
                <div class="pm-sub-header-message">
                    <p><?php echo esc_attr($pm_header_message_meta); ?></p>
                </div>
                
        <?php } else if( is_product() ) { ?>
        
                <?php 
                    $pm_woocom_header_message_meta = get_post_meta(get_the_id(), 'pm_woocom_header_message_meta', true); 
                    //$pm_woocom_header_message_meta = get_post_meta(get_the_ID(), 'pm_woocom_header_message_meta', true); 
                ?>
                
                <div class="pm-sub-header-message">
                    <p><?php echo esc_attr($pm_woocom_header_message_meta); ?></p>
                </div>
                
        <?php } else if(  is_product_category() || is_product_tag()  ) { ?>      
               
               <div class="pm-sub-header-message">
                    <p>"<?php woocommerce_page_title(); ?>"</p>
                </div>
                         
        <?php } else if(is_single()) { ?>
        
            <?php get_template_part('content', 'postnavigation'); ?>
        
        <?php } else if( is_404() ) { ?>
        
                <div class="pm-sub-header-message">
                    <p><?php esc_attr_e('Page not found', 'quantumtheme'); ?></p>
                </div>
                                    
        <?php } else if( is_search() ) { ?>
        
                <div class="pm-sub-header-message">
                    <p>"<?php echo get_search_query(); ?>"</p>
                </div>
                
        <?php } else if(is_tag()) { ?>
        
                <div class="pm-sub-header-message">
                    <p>"<?php echo get_query_var('tag'); ?>"</p>
                </div>
                
        <?php } else if(is_category()) { ?>
        
                <div class="pm-sub-header-message">
                    <p>"<?php $cat = get_category( get_query_var( 'cat' ) ); echo $cat->name; ?>"</p>
                </div>
                
        <?php } else if( is_archive() ) { ?>
        
                <div class="pm-sub-header-message"><p>
                <?php 
                
                    if (is_day()) {
                        the_time('F jS, Y');
                    }
                    elseif (is_month()) {
                        the_time('F, Y');
                    }
                    elseif (is_year()) {
                        the_time('Y');
                    }
                    elseif (is_author()) {
                        echo"<li>Author Archive"; echo'</li>';
                    }
                
                ?>
                </p></div>
                                    
        
        <?php } else { ?>
        
            <?php if($pageHeaderMessage !== ''){ ?>
        
                <div class="pm-sub-header-message">
                    <p><?php echo esc_attr($pageHeaderMessage); ?></p>
                </div>
            
            <?php } ?>
        
        <?php } ?>
    
    
    <?php } else {//No woocommerce installed ?>
    
                             
        <?php if(is_single()) { ?>
        
            <?php get_template_part('content', 'postnavigation'); ?>
        
        <?php } else if( is_404() ) { ?>
        
                <div class="pm-sub-header-message">
                    <p><?php esc_attr_e('Page not found', 'quantumtheme'); ?></p>
                </div>
                                    
        <?php } else if( is_search() ) { ?>
        
                <div class="pm-sub-header-message">
                    <p>"<?php echo get_search_query(); ?>"</p>
                </div>
                
        <?php } else if(is_tag()) { ?>
        
                <div class="pm-sub-header-message">
                    <p>"<?php echo get_query_var('tag'); ?>"</p>
                </div>
                
        <?php } else if(is_category()) { ?>
        
                <div class="pm-sub-header-message">
                    <p>"<?php $cat = get_category( get_query_var( 'cat' ) ); echo $cat->name; ?>"</p>
                </div>
                
        <?php } else if( is_archive() ) { ?>
        
                <div class="pm-sub-header-message"><p>
                <?php 
                
                    if (is_day()) {
                        the_time('F jS, Y');
                    }
                    elseif (is_month()) {
                        the_time('F, Y');
                    }
                    elseif (is_year()) {
                        the_time('Y');
                    }
                    elseif (is_author()) {
                        echo"<li>Author Archive"; echo'</li>';
                    }
                
                ?>
                </p></div>
                                    
        
        <?php } else { ?>
        
            <?php if($pageHeaderMessage !== ''){ ?>
        
                <div class="pm-sub-header-message">
                    <p><?php echo esc_attr($pageHeaderMessage); ?></p>
                </div>
            
            <?php } ?>
        
        <?php } ?>
    
    <?php }  ?>
                                        
</div>
<!-- SUBHEADER AREA end -->