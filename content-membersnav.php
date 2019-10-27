<?php 

	$current_user = wp_get_current_user();
	//$current_user->user_login
	//$current_user->user_email
	//$current_user->user_firstname
	//$current_user->user_lastname
	//$current_user->display_name
	//$current_user->ID 
	
	$user_roles = $current_user->roles;
	$user_role = array_shift($user_roles);
	
	//Redux options
	global $quantum_options;
	
	$membersAccountSlug = get_option('pm_members_account_template_slug');
	$membersAreaSlug = get_option('pm_members_area_template_slug');
	$membersViewOrdersSlug = get_option('pm_members_view_orders_slug');
	
	
?>

<div class="container pm-members-nav-container-margin">

    <div class="row">
    
        <div class="pm-members-nav-container">
        
            <div class="col-lg-4 col-md-4 col-sm-4">
            
                <div class="pm-member-welcome-box">
                    <p><?php esc_attr_e('Welcome back', 'quantumtheme'); ?>, <?php echo $current_user->user_firstname; ?></p>
                </div>
                
            </div>
            
            <div class="col-lg-8 col-md-8 col-sm-8 pm-members-nav-container-padding">
                
                <ul class="pm-members-navigation" id="pm-members-nav">
                
                	<?php 
					
						if($user_role == 'board_member' || $user_role == 'executive_member' || $user_role == 'administrator') {
							
							?>
                            <li><a href="<?php echo $membersAreaSlug !== '' ? site_url($membersAreaSlug) : site_url('members-area'); ?><?php echo isset( $_GET['lang'] ) ? '?lang='. (string) $_GET['lang'] .'' : '' ?>"><?php echo $membersAreaSlug !== '' ? ucwords(str_replace('-', ' ', esc_attr__($membersAreaSlug, 'quantumtheme'))) : esc_attr__('Member Files', 'quantumtheme'); ?></a></li>
                            <?php
							
						} 
					
					?>
                
                    
                    <li><a href="<?php echo $membersAccountSlug !== '' ? site_url($membersAccountSlug) : site_url('members-account'); ?><?php echo isset( $_GET['lang'] ) ? '?lang='. (string) $_GET['lang'] .'' : '' ?>"><?php echo $membersAccountSlug !== '' ? ucwords(str_replace('-', ' ', esc_attr__($membersAccountSlug, 'quantumtheme'))) : esc_attr__('My Account', 'quantumtheme'); ?></a></li>
                    <?php 
						
						if(function_exists('is_shop')){
							?>
                            
                            
                            
							<li><a href="<?php echo $membersViewOrdersSlug !== '' ? site_url($membersViewOrdersSlug) : site_url('my-account'); ?><?php echo isset( $_GET['lang'] ) ? '?lang='. (string) $_GET['lang'] .'' : '' ?>"><?php echo $membersViewOrdersSlug !== '' ? ucwords(str_replace('-', ' ', esc_attr__($membersViewOrdersSlug, 'quantumtheme'))) : esc_attr__('View Orders', 'quantumtheme'); ?></a></li>
                            <?php
						}
					
					?>
                    
                    
                    <?php 
						
						$logoutURL = get_option('pm_custom_logout_url');
					?>
				
					<?php if($logoutURL !== '') { ?>
						<li><a href="<?php echo wp_logout_url( site_url($logoutURL) ); ?>"><?php esc_attr_e('Sign Out', 'quantumtheme'); ?></a></li>
					<?php } else { ?>
						<li><a href="<?php echo wp_logout_url( site_url('/login/') ); ?>"><?php esc_attr_e('Sign Out', 'quantumtheme'); ?></a></li>
					<?php } ?>
                    
                    
                </ul>
                
            </div>
        
        </div>
        
    </div>

</div>