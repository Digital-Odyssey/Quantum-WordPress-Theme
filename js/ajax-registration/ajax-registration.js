(function($) {

	$(document).ready(function(e) {

	  /**
	   * When user clicks on button - retrieve data from form and send request to WordPres
	   *
	   */
	  $('.btn-register-user').click( function(e) {
		  		  	
		/**
		 * Prevent default action, so when user clicks button he doesn't navigate away from page
		 *
		 */
		e.preventDefault();
	
		// Show 'Please wait' loader to user, so she/he knows something is going on
		$('.indicator').show();
	
		// If for some reason result field is visible hide it
		$('.result-message').show();
		$('.result-message').addClass('alert-notice');
		$('.result-message').html( 'Validating information...' );
	
		// Collect data from inputs
		var reg_nonce = $('#pm_ln_new_user_nonce').val();
		var reg_user  = $('#pm_username').val();
		var reg_pass  = $('#pm_pass').val();
		var reg_mail  = $('#pm_email').val();
		var reg_name  = $('#pm_name').val();
		var reg_admin_email = $('#pm_admin_email').val();
		var reg_security_answer_input = $('#pm_form_security_question').val();
		var reg_security_answer_validate = $('#pm_form_security_answer').val();
		
	
		/**
		 * AJAX URL where to send data 
		 * (from localize_script)
		 */
		var ajax_url = wordpressOptionsObject.pm_ln_ajax_url;
	
		// Data to send
		data = {
		  action: 'register_user',
		  nonce: reg_nonce,
		  user: reg_user,
		  pass: reg_pass,
		  mail: reg_mail,
		  name: reg_name,
		  adminemail: reg_admin_email,
		  security_answer_input: reg_security_answer_input,
		  security_answer_validate: reg_security_answer_validate
		};
	
		// Do AJAX request
		$.post( ajax_url, data, function(response) {
	
		  // If we have response
		  if( response ) {
	
			// Hide 'Please wait' indicator
			$('.indicator').hide();
	
			if( response === 'name_error' ) {
			  // If user is created
			  $('.result-message').html( wordpressOptionsObject.reg1 );
			  $('.result-message').removeClass('alert-notice').addClass('alert-danger');
			  $('.result-message').show();
			  
			  $('#pm_name').addClass('invalid_field');
			  $('#pm_name').focus(function(e) {
				$(this).removeClass('invalid_field');
			  });
			  
			} else if( response === 'email_error' ){
				
			  $('.result-message').html(wordpressOptionsObject.reg2);
			  $('.result-message').removeClass('alert-notice').addClass('alert-danger');
			  $('.result-message').show();
			  
			  $('#pm_email').addClass('invalid_field');
			  $('#pm_email').focus(function(e) {
				$(this).removeClass('invalid_field');
			  });
			  
			} else if( response === 'username_error' ){
				
			  $('.result-message').html(wordpressOptionsObject.reg3);
			  $('.result-message').removeClass('alert-notice').addClass('alert-danger');
			  $('.result-message').show();
			  
			  $('#pm_username').addClass('invalid_field');
			  $('#pm_username').focus(function(e) {
				$(this).removeClass('invalid_field');
			  });
			  
			} else if( response === 'pass_error' ){
				
			  $('.result-message').html(wordpressOptionsObject.reg4);
			  $('.result-message').removeClass('alert-notice').addClass('alert-danger');
			  $('.result-message').show();
			  
			  $('#pm_pass').addClass('invalid_field');
			  $('#pm_pass').focus(function(e) {
				$(this).removeClass('invalid_field');
			  });
			  
			} else if( response === 'security_error' ){
				
			  $('.result-message').html(wordpressOptionsObject.reg5);
			  $('.result-message').removeClass('alert-notice').addClass('alert-danger');
			  $('.result-message').show();
			  
			  $('#pm_pass').addClass('invalid_field');
			  $('#pm_pass').focus(function(e) {
				$(this).removeClass('invalid_field');
			  });
			  
			}  else if( response === 'success' ){
				
			  $('.result-message').html(wordpressOptionsObject.reg6);
			  $('#btn-new-user').fadeOut('slow');
			  $('.result-message').removeClass('alert-danger').removeClass('alert-notice').addClass('alert-success');
			  $('.result-message').show();
			  
			} else if( response === 'form_error' ){
				
			  $('.result-message').html(wordpressOptionsObject.reg7);
			  $('.result-message').removeClass('alert-notice').addClass('alert-danger');
			  $('.result-message').show();
				
			} else {
			  $('.result-message').html( response );
			  $('.result-message').addClass('alert-danger'); 
			  $('.result-message').show();
			}
		  }
		});
		
	  });
	});
	

	
})(jQuery);

