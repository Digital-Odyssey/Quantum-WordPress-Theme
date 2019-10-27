<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_pricing_table extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"title" => 'Beginner',
			"icon" => 'typcn typcn-cog-outline',
			"price" => '$19.99',
			"subscript" => '/mo',
			"button_text" => 'Purchase',
			"button_link" => '#',
			"header_color" => '#2B5C84',
			"price_color" => '#DBC164',
			"class" => 'wow fadeInUp',
			"icon_color" => '#2B5D82'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_bg_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-pricing-table" class="<?php esc_attr_e($class); ?>">
            <h2 style="background-color:<?php esc_attr_e($header_color); ?>;"><?php esc_attr_e($title); ?></h2>
            <div class="pm-pricing-table-header">
                <?php if($icon !== ''){ ?>
                    <i class="<?php esc_attr_e($icon); ?>" style="color:<?php esc_attr_e($icon_color); ?> !important;"></i>
                <?php } ?>
                <h1 style="color:<?php esc_attr_e($price_color); ?>;"><?php esc_attr_e($price) .' '. ( $subscript !== '' ? '<sub>'. $subscript .'</sub>' : '' ); ?></h1>
            </div>
            <div class="pm-pricing-table-offer">
            <?php echo $content; ?>
            </div>
            <div class="pm-rounded-btn">
                <a href="<?php esc_attr_e($button_link); ?>"><?php esc_attr_e($button_text); ?></a>
            </div>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_pricing_table",
    "name"      => __("Pricing Table", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(
	
		
		
		array(
            "type" => "textfield",
            "heading" => __("Title", 'quantumtheme'),
            "param_name" => "title",
			"value" => 'Beginner'
            //"description" => __("Enter a CSS class if required.", 'quantumtheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'quantumtheme'),
            "param_name" => "icon",
			"value" => 'typcn typcn-cog-outline',
            "description" => __("Accepts a Typicon icon value. (Ex. typcn typcn-cog-outline)", 'quantumtheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Price", 'quantumtheme'),
            "param_name" => "price",
			"value" => '$19.99'
            //"description" => __("Enter a CSS class if required.", 'quantumtheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Subscript", 'quantumtheme'),
            "param_name" => "subscript",
			"value" => '/mo'
            //"description" => __("Enter a CSS class if required.", 'quantumtheme')
        ),

		
		array(
            "type" => "textfield",
            "heading" => __("Button Text", 'quantumtheme'),
            "param_name" => "button_text",
			"value" => 'Purchase'
            //"description" => __("Enter a CSS class if required.", 'quantumtheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Button URL", 'quantumtheme'),
            "param_name" => "button_link",
			"value" => '#'
            //"description" => __("Enter a CSS class if required.", 'quantumtheme')
        ),
		
				
		array(
            "type" => "colorpicker",
            "heading" => __("Header Color", 'quantumtheme'),
            "param_name" => "header_color",
            //"description" => __("Choose the divider style you desire.", 'quantumtheme'),
			"value"      => '#2B5C84', //Add default value in $atts
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Price Color", 'quantumtheme'),
            "param_name" => "price_color",
            //"description" => __("Choose the divider style you desire.", 'quantumtheme'),
			"value"      => '#DBC164', //Add default value in $atts
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", 'quantumtheme'),
            "param_name" => "icon_color",
            //"description" => __("Choose the divider style you desire.", 'quantumtheme'),
			"value"      => '#2B5D82', //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Class", 'quantumtheme'),
            "param_name" => "class",
			"value" => '',
            "description" => __("Apply a custom CSS class if required.", 'quantumtheme')
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'quantumtheme'),
            "param_name" => "content",
			"value" => '',
            "description" => __("Format your content in an unordered list for proper formatting.", 'quantumtheme')
        ),
		

    )

));