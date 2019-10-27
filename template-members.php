<?php /* Template Name: Members Area Template */ ?>
<?php get_header(); ?>

<?php 

	//Are we logged in?
	if ( !is_user_logged_in() ) {
		
		//user not logged in, redirect page back to homepage
		wp_redirect( home_url() );
		exit;	
		
	} 

?>

<!-- MEMBERS NAVIGATION -->
<?php get_template_part('content', 'membersnav'); ?>
<!-- MEMBERS NAVIGATION end -->

<?php 
	$getPageLayout = get_post_meta(get_the_ID(), 'pm_page_layout_meta', true);
	$pageLayout = $getPageLayout !== '' ? $getPageLayout : 'no-sidebar';
?>

<!-- BODY AREA -->
<div class="container pm-containerPadding60">
    <div class="row">
    
    	<?php if($pageLayout === 'no-sidebar') { ?>
        
        	<div class="col-lg-12">
            
            	<?php get_template_part('content', 'workshopfiles'); ?>
            
            </div>
            
        <?php }  ?>
        
        <?php if($pageLayout === 'right-sidebar') {?>
                
            <!-- Retrive right sidebar post template -->
            <div class="col-lg-8 col-md-8 col-sm-8">
            
				<?php get_template_part('content', 'workshopfiles'); ?>
                            
            </div>
            
             <!-- Right Sidebar -->
             <?php get_sidebar('members'); ?>
             <!-- /Right Sidebar -->
             
        <?php }  ?>
        
        <?php if($pageLayout === 'left-sidebar') {?>
        	
            <!-- Right Sidebar -->
            <?php get_sidebar('members'); ?>
            <!-- /Right Sidebar -->
        
            <div class="col-lg-8 col-md-8 col-sm-8">
				<?php get_template_part('content', 'workshopfiles'); ?>
            </div>
             
        <?php }  ?>

        
    </div>
</div>

<!-- BODY AREA end -->

<?php get_footer(); ?>