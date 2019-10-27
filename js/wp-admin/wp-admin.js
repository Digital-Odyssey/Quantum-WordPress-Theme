// JavaScript Document

(function($) {
	
	$(document).ready(function(e) {
		        
		//Header image preview
		if( $('.pm-admin-upload-field').length > 0 ){
	
			var value = $('.pm-admin-upload-field').val();
			
			if (value !== '') {
				
				$('.pm-admin-upload-field-preview').html('<img src="'+ value +'" />');
				
			}
	
		}
		
		//Remove page header button
		if( $('#remove_page_header_button').length > 0 ){
	
			$('#remove_page_header_button').click(function(e) {
				
				$('#img-uploader-field').val('');
				$('.pm-admin-upload-field-preview').empty();
				
			});
	
		}
		
		//Featured Post image preview
		if( $('.pm-featured-image-upload-field').length > 0 ){
	
			var value = $('.pm-featured-image-upload-field').val();
			
			if (value !== '') {
				
				$('.pm-featured-image-preview').html('<img src="'+ value +'" />');
				
			}
	
		}
		
		//Remove Featured Post image button
		if( $('#remove_featured_post_image_button').length > 0 ){
	
			$('#remove_featured_post_image_button').click(function(e) {
				
				$('#featured-img-uploader-field').val('');
				$('.pm-featured-image-preview').empty();
				
			});
	
		}
		
		
		//Staff image preview
		if( $('.pm-admin-upload-field').length > 0 ){
	
			var value = $('.pm-admin-upload-field').val();
			
			if (value !== '') {
				
				$('.pm-admin-upload-staff-preview').html('<img src="'+ value +'" />');
				
			}
	
		}
		
		//Remove Staff image button
		if( $('#remove_staff_profile_image_button').length > 0 ){
	
			$('#remove_staff_profile_image_button').click(function(e) {
				
				$('#img-uploader-field').val('');
				$('.pm-admin-upload-staff-preview').empty();
				
			});
	
		}
		
		
		//Gallery image preview
		if( $('#featured-img-uploader-field').length > 0 ){
	
			var value = $('#featured-img-uploader-field').val();
			
			if (value !== '') {
				
				$('.pm-admin-gallery-image-preview').html('<img src="'+ value +'" />');
				
			}
	
		}
		
		//Remove Gallery image button
		if( $('#remove_gallery_image_button').length > 0 ){
	
			$('#remove_gallery_image_button').click(function(e) {
				
				$('#featured-img-uploader-field').val('');
				$('.pm-admin-gallery-image-preview').empty();
				
			});
	
		}
		
		//Datepicker
		if( $( "#datepicker" ).length > 0 ){
			$( "#datepicker" ).datepicker();
		}
		
		//Theme verification - marketplace selection
		if( $('#pm_ln_verify_marketplace_selection').length > 0 ){
	
			$('#pm_ln_verify_marketplace_selection').on('change', function(e) {		
			
				
				var val = $(this).val();
				
				if(val === 'themeforest'){
					
					$('#pm_ln_micro_themes_purchase_code_themeforest').addClass('active');
					$('#pm_ln_micro_themes_purchase_code_mojo').removeClass('active');		
									
					
				} else if(val === 'mojo') {
					
					$('#pm_ln_micro_themes_purchase_code_mojo').addClass('active');	
					$('#pm_ln_micro_themes_purchase_code_themeforest').removeClass('active');			
							
				} else {
					
					$('#pm_ln_micro_themes_purchase_code_themeforest').removeClass('active');
					$('#pm_ln_micro_themes_purchase_code_mojo').removeClass('active');	
						
				}
				
			});
	
		}
		
		
    });
	
})(jQuery);