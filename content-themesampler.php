<!-- Theme color selector -->
<div id="pm_theme_color_selector">
    <a class="pm_theme_color_selector_btn"><i class="typcn typcn-cog"></i></a>
    <p class="pm_theme_color_selector_title"><?php esc_attr_e('Style Sampler','quantumtheme'); ?></p>

    <div class="pm_theme_color_selector_container">
        <p><?php esc_attr_e('Layout Style','quantumtheme'); ?></p>
        <select name="pm_theme_color_selector_mode" id="pm_theme_color_selector_mode">
          <option value="pm-full-mode" selected><?php esc_attr_e('Fullscreen','quantumtheme'); ?></option>
          <option value="pm-boxed-mode"><?php esc_attr_e('Boxed Mode','quantumtheme'); ?></option>
        </select>
    </div>
    <div class="pm_theme_color_selector_container">
        <p><?php esc_attr_e('Patterns for Boxed Mode','quantumtheme'); ?></p>
        <ul class="pm_theme_img_selector" id="pm_theme_pattern_selector">
            <li><a href="#" id="01_pattern"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-patterns/01_pattern.png" alt="pattern1"></a></li>
            <li><a href="#" id="02_pattern"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-patterns/02_pattern.png" alt="pattern2"></a></li>
            <li><a href="#" id="03_pattern"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-patterns/03_pattern.png" alt="pattern3"></a></li>
            <li><a href="#" id="04_pattern"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-patterns/04_pattern.png" alt="pattern4"></a></li>
            <li><a href="#" id="05_pattern"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-patterns/05_pattern.png" alt="pattern5"></a></li>
            <li><a href="#" id="06_pattern"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-patterns/06_pattern.png" alt="pattern6"></a></li>
        </ul>
    </div>
    
    <div class="pm_theme_color_selector_container">
        <p><?php esc_attr_e('Backgrounds for Boxed Mode','quantumtheme'); ?></p>
        <ul class="pm_theme_img_selector" id="pm_theme_background_selector">
            <li><a href="#" id="01_bg"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-bgs/01_bg_thumb.jpg" alt="bg1"></a></li>
            <li><a href="#" id="02_bg"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-bgs/02_bg_thumb.jpg" alt="bg2"></a></li>
            <li><a href="#" id="03_bg"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-bgs/03_bg_thumb.jpg" alt="bg3"></a></li>
            <li><a href="#" id="04_bg"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-bgs/04_bg_thumb.jpg" alt="bg4"></a></li>
            <li><a href="#" id="05_bg"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-bgs/05_bg_thumb.jpg" alt="bg5"></a></li>
        </ul>
    </div>

</div>
<!-- Theme color selector -->