<?php /* Template Name: Members Registration Template */ ?>
<?php get_header(); ?>


<?php 

	//Are we logged in?
	if( is_user_logged_in() ) {
		
		$current_user = wp_get_current_user();
		
		//redirect user to default page - board or executive based on member role
		$user_roles = $current_user->roles;
		$user_role = array_shift($user_roles);
		
		global $quantum_options;
	
		$membersAccountSlug = get_option('pm_members_account_template_slug');
		$membersAreaSlug = get_option('pm_members_area_template_slug');
		
		//do redirect
		if( $user_role == 'standard_member' ){
			
			//direct to account page
			if($membersAccountSlug !== ''){
				wp_redirect( site_url($membersAccountSlug) );
			} else {
				wp_redirect( site_url('members-account') );	
			}
			
			
		} elseif($user_role == 'board_member' || $user_role == 'executive_member' || $user_role == 'administrator') {
			
			//direct to board of directors page
			if($membersAreaSlug !== ''){
				wp_redirect( site_url($membersAreaSlug) );
			} else {
				wp_redirect( site_url('members-area') );	
			}
			
		} else {
			
			//direct all other roles types to account page
			if($membersAccountSlug !== ''){
				wp_redirect( site_url($membersAccountSlug) );
			} else {
				wp_redirect( site_url('members-account') );	
			}
							
		}
		
		exit;
		
	}	
	

?>

<?php 
$getPageLayout = get_post_meta(get_the_ID(), 'pm_page_layout_meta', true);
$pageLayout = $getPageLayout !== '' ? $getPageLayout : 'no-sidebar';
?>

<?php if($pageLayout === 'no-sidebar') { //Render col-lg-12 ?>

	<div class="container pm-containerPadding60">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                        
            	<?php pm_ln_registration_form(); ?>
                        
            </div>
        </div>
    </div>

<?php } ?>

<?php if($pageLayout === 'left-sidebar') { ?>

	<div class="container pm-containerPadding60">
        <div class="row">
        
            <?php get_sidebar(); ?>
    
            <div class="col-lg-8 col-md-8 col-sm-8">
            
            	<?php pm_ln_registration_form(); ?>
                
            </div>
        </div>
    </div>

<?php } ?>

<?php if($pageLayout === 'right-sidebar') { ?>


	<div class="container pm-containerPadding60">
        <div class="row">
        
            <div class="col-lg-8 col-md-8 col-sm-8">
            
            	<?php pm_ln_registration_form(); ?>
                                    
            </div>
            <?php get_sidebar(); ?>
            
        </div>
    </div>

<?php } ?>


<?php get_footer(); ?>