<?php 

$socialMediaCTA = get_theme_mod('socialMediaCTA', 'Join the conversation');
$toggle_defaultSocialcta = get_theme_mod('toggle_defaultSocialcta', 'on'); 

$enableTooltip = get_theme_mod('enableTooltip', 'on');

//Social links
$twitterlink = get_theme_mod('twitterlink', 'http://www.twitter.com');
$facebooklink = get_theme_mod('facebooklink', 'http://www.facebook.com');
$googlelink = get_theme_mod('googlelink', 'http://www.googleplus.com');
$linkedinLink = get_theme_mod('linkedinLink', 'http://www.linkedin.com');
$youtubelink = get_theme_mod('youtubelink', 'http://www.youtube.com');

$vimeolink = get_theme_mod('vimeolink', 'http://www.vimeo.com');
$dribbblelink = get_theme_mod('dribbblelink', 'http://www.dribbble.com');
$pinterestlink = get_theme_mod('pinterestlink', 'http://www.pinterest.com');
$instagramlink = get_theme_mod('instagramlink', 'http://www.instagram.com');
$behancelink = get_theme_mod('behancelink', 'http://www.behance.com');
$skypelink = get_theme_mod('skypelink', 'http://www.skype.com');
$flickrlink = get_theme_mod('flickrlink', 'http://www.flickr.com');
$githublink = get_theme_mod('githublink', 'http://www.github.com');
$tumblrlink = get_theme_mod('tumblrlink', 'http://www.tumblr.com');
$businessEmail = get_theme_mod('businessEmail', 'info@quantum.com');
$rssLink = get_theme_mod('rssLink', '/rss');

?>

<div class="pm-footer-social-info-container">
	
	<?php if($toggle_defaultSocialcta === 'on') { ?>	
        <h6><?php  esc_attr_e('Join the conversation','quantumtheme') ?></h6>
        <p><?php  esc_attr_e('Follow us on social media and stay up to date.','quantumtheme') ?></p>
    <?php } else { ?>
        <h6><?php echo esc_attr($socialMediaCTA); ?></h6>	
    <?php } ?>
    
                                
    <ul class="pm-footer-social-icons">
    
        <?php if($twitterlink !== '') { ?>
            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Twitter', 'quantumtheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo esc_html($twitterlink); ?>" target="_blank"><i class="fa fa-twitter tw"></i></a></li>
        <?php } ?>
        <?php if($facebooklink !== '') { ?>
            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Facebook', 'quantumtheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo esc_html($facebooklink); ?>" target="_blank"><i class="fa fa-facebook fb"></i></a></li>
        <?php } ?>
        <?php if($googlelink !== '') { ?>
            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Google Plus', 'quantumtheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo esc_html($googlelink); ?>" target="_blank"><i class="fa fa-google-plus gp"></i></a></li>
        <?php } ?>
        <?php if($linkedinLink !== '') { ?>
            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Linkedin', 'quantumtheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo esc_html($linkedinLink); ?>" target="_blank"><i class="fa fa-linkedin linked"></i></a></li>
        <?php } ?>
        <?php if($youtubelink !== '') { ?>
            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('YouTube', 'quantumtheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo esc_html($youtubelink); ?>" target="_blank"><i class="fa fa-youtube yt"></i></a></li>
        <?php } ?>
        <?php if($vimeolink !== '') { ?>
            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Vimeo', 'quantumtheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo esc_html($vimeolink); ?>" target="_blank"><i class="fa fa-vimeo-square vimeo"></i></a></li>
        <?php } ?>
        <?php if($dribbblelink !== '') { ?>
            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Dribbble', 'quantumtheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo esc_html($dribbblelink); ?>" target="_blank"><i class="fa fa-dribbble dribbble"></i></a></li>
        <?php } ?>
        <?php if($pinterestlink !== '') { ?>
            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Pinterest', 'quantumtheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo esc_html($pinterestlink); ?>" target="_blank"><i class="fa fa-pinterest pinterest"></i></a></li>
        <?php } ?>
        <?php if($instagramlink !== '') { ?>
            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Instagram', 'quantumtheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo esc_html($instagramlink); ?>" target="_blank"><i class="fa fa-instagram instagram"></i></a></li>
        <?php } ?>
        <?php if($behancelink !== '') { ?>
            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Behance', 'quantumtheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo esc_html($behancelink); ?>" target="_blank"><i class="fa fa-behance behance"></i></a></li>
        <?php } ?>
        <?php if($skypelink !== '') { ?>
            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Skype', 'quantumtheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo esc_attr($skypelink); ?>" target="_blank"><i class="fa fa-skype skype"></i></a></li>
        <?php } ?>
        <?php if($flickrlink !== '') { ?>
            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Flickr', 'quantumtheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo esc_html($flickrlink); ?>" target="_blank"><i class="fa fa-flickr flickr"></i></a></li>
        <?php } ?>
        <?php if($githublink !== '') { ?>
            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Github', 'quantumtheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo esc_html($githublink); ?>" target="_blank"><i class="fa fa-github-alt github"></i></a></li>
        <?php } ?>
        <?php if($tumblrlink !== '') { ?>
            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Tumblr', 'quantumtheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo esc_html($tumblrlink); ?>" target="_blank"><i class="fa fa-tumblr tumblr"></i></a></li>
        <?php } ?>
        <?php if($businessEmail !== '') { ?>
            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Email us', 'quantumtheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="mailto:<?php echo esc_attr($businessEmail); ?>" target="_blank"><i class="fa fa-envelope envelope"></i></a></li>
        <?php } ?>
        <?php if($rssLink !== '') { ?>
            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('RSS Feed', 'quantumtheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo esc_html($rssLink); ?>" target="_blank"><i class="fa fa-rss rss"></i></a></li>
        <?php } ?>
        
        
    </ul>
</div><!-- /.pm-footer-social-info-container -->