<?php 

$enableTooltip = get_theme_mod('enableTooltip', 'on');
$toggle_defaultNewslettercta = get_theme_mod('toggle_defaultNewslettercta', 'on');
$newsletterCTA = get_theme_mod('newsletterCTA', 'Subscribe to our newsletter');

?>

<div class="pm-footer-subscribe-container">
	
	<?php if($toggle_defaultNewslettercta === 'on') { ?>	
        <h6><?php  esc_attr_e('Subscribe to our newsletter','quantumtheme'); ?></h6>
        <p><?php  esc_attr_e('Sign up for our newsletter and stay up to date','quantumtheme'); ?></p>
    <?php } else { ?>
        <h6><?php echo esc_attr($newsletterCTA); ?></h6>	
    <?php } ?>
    
                                    
    <div class="pm-footer-subscribe-form-container">
    
        <?php $mailchimpAddress = get_theme_mod('mailchimpAddress', 'http://pulsarmedia.us4.list-manage2.com/subscribe?u=2aa9334fc1bc18c8d05500b41&id=dbcb577c4d'); ?>
    
        <form action="<?php echo htmlentities($mailchimpAddress); ?>" method="post" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <input name="MERGE0" type="email" class="pm-footer-subscribe-field" id="MERGE3" placeholder="Email Address">
            <input name="subscribe" type="submit" value="&#xf1d8;" class="pm-footer-subscribe-submit-btn">
        </form>
    </div>
</div>
<!-- /.pm-footer-subscribe-container -->