<?php
//The header template page/search/404

global $woocommerce;

$enableParallax = get_theme_mod('enableParallax', 'on');

$shopMessage = '';
$productMessage = '';

$pageid = get_option('woocommerce_shop_page_id');

$pageHeaderImage = get_post_meta(get_the_ID(), 'pageHeaderImage', true);
$wooCategoryHeaderImage = get_theme_mod('wooCategoryHeaderImage');

if(is_shop()){
	$shopMessage = get_post_meta($pageid, 'pageMessage', true);
}

if(is_product()){
	$productMessage = get_post_meta(get_the_ID(), 'pageMessage', true);
}

?>



<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 pm-subpage-header-left-column">
        
        	<div class="pm-subpage-header-left-filler"></div>
        
            <div class="pm-subpage-header-info">
            
                <?php if(is_product()) { ?>
                	<h2 class="pm_page_title"><?php the_title(); ?></h2> 
                <?php } else { ?>
                	<h2 class="pm_page_title"><?php woocommerce_page_title(); ?></h2> 
                <?php } ?>
                                
                <?php				
					$args = array(
							'delimiter' => '<li> / </li>',
							'wrap_before' => '<ul class="woocommerce-breadcrumb" itemprop="breadcrumb">',
							'wrap_after' => '</ul>',
							'before' => '<li>',
							'after' => '</li>',
					);
				?>
                
                <?php woocommerce_breadcrumb( $args ); ?>
                
                 
            </div>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 pm-subpage-header-right-column">
        	
            <?php if(is_shop() || is_product_category() || is_product_tag()) { ?>
            
            	 <div class="pm-subpage-header-img-container news-post" style="background-image:url(<?php echo esc_html($wooCategoryHeaderImage); ?>); background-color:<?php echo esc_attr($subHeaderBackgroundColor); ?>;">
            <?php } else { ?>
            	 <div class="pm-subpage-header-img-container news-post" style="background-image:url(<?php echo esc_html($pageHeaderImage); ?>); background-color:<?php echo esc_attr($subHeaderBackgroundColor); ?>;">
            <?php } ?>
                        
            	<?php if($shopMessage !== '') { ?>
                    <div class="pm-subpage-header-quote">
                        <p><?php echo esc_attr($shopMessage); ?></p>
                    </div>
                <?php } ?>
                
                <?php if($productMessage !== '') { ?>
                    <div class="pm-subpage-header-quote">
                        <p><?php echo esc_attr($productMessage); ?></p>
                    </div>
                <?php } ?>
            
            </div>
        	
        </div>
        
    </div>
</div>