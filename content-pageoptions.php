<?php
//Use this file to display page options (print and share icons)

$enableTooltip = get_theme_mod('enableTooltip', 'on');

?>

<div class="pm-page-share-options">
						
    <div class="pm-rounded-btn"><a href="#" id="pm-print-btn" target="_self" >print page <i class="fa fa-print"></i></a></div>
    
    <ul class="pm-page-social-icons">
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Share on Google Plus', 'quantumtheme') .'"' : '' ?>><a href="https://plus.google.com/share?url=<?php urlencode(the_permalink()); ?>" title="<?php esc_attr_e('Share on Google Plus', 'quantumtheme'); ?>" class="fa fa-google-plus" target="_blank"></a></li>
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Share on Twitter', 'quantumtheme') .'"' : '' ?>><a href="http://twitter.com/home?status=<?php urlencode(the_title()); ?>" title="<?php esc_attr_e('Share on Twitter', 'quantumtheme'); ?>" class="fa fa-twitter" target="_blank"></a></li>
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Share on Facebook', 'quantumtheme') .'"' : '' ?>><a href="http://www.facebook.com/share.php?u=<?php urlencode(the_permalink()); ?>" title="<?php esc_attr_e('Share on Facebook', 'quantumtheme'); ?>" class="fa fa-facebook" target="_blank"></a></li>
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Share on Linkedin', 'quantumtheme') .'"' : '' ?>><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(site_url()); ?>&title=<?php urlencode(the_title()); ?>&summary=<?php urlencode(the_title()); ?>&source=<?php echo urlencode(site_url()); ?>" title="<?php esc_attr_e('Share on LinkedIn', 'quantumtheme'); ?>" class="fa fa-linkedin" target="_blank"></a></li>
    </ul>
    
</div>