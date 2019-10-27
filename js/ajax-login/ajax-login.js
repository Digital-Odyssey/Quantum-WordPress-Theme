(function($) {
	
	var displayPercent = "-60px",
	hidePercent = "-370px"; 

	$(document).ready(function(e) {
		

	  /**
	   * When user clicks on button - retrieve data from form and send request to WordPres
	   *
	   */
	  $('#btn-quick-login').click( function(e) {
		  		  	
		/**
		 * Prevent default action, so when user clicks button he doesn't navigate away from page
		 *
		 */
		e.preventDefault();
	
			// Collect data from inputs
		var reg_login_nonce = $('#pm_ln_quick_login_nonce').val();
		var reg_quickuser  = $('#pm_quick_username').val();
		var reg_quickpass  = $('#pm_quick_password').val();
		var $closeTag = "<i class='typcn typcn-times' id='pm-quick-message-close'></i>";
		var $cancelTag = "<i class='typcn typcn-cancel' id='pm-quick-message-close'></i>";
	
		/**
		 * AJAX URL where to send data 
		 * (from localize_script)
		 */
		var ajax_url = wordpressOptionsObject.pm_ln_ajax_url;
		console.log('ajax_url = ' + ajax_url);
	
		//Data to send
		data = {
		  action: 'validate_quick_login',
		  nonce: reg_login_nonce,
		  quickuser: reg_quickuser,
		  quickpass: reg_quickpass,
		};
		
		//Set initial message
		$('#pm-quick-message').find('span').replaceWith( "<span>" + $cancelTag + " " + wordpressOptionsObject.loginMessage + "</span>" );
		$('#pm-quick-message-close').die('click');
		
		//Display message
		$('#pm-quick-message').css({
			'right' : displayPercent
		});
		
	
		// Do AJAX request
		$.post( ajax_url, data, function(response) {
						
			var $closeTag = "<i class='typcn typcn-times' id='pm-quick-message-close'></i>";
			
			$('#pm-quick-message-close').live("click", function(e) {
				$('#pm-quick-message').css({
					'right' : hidePercent
				});
			});
			
	
		  // If we have response
		  if( response ) {
			  			  
			if( response === 'username_error' ){
				
				//Show slide out box with error
				$('#pm-quick-message').find('span').replaceWith( "<span>" + $closeTag + " " + wordpressOptionsObject.loginMessageInvalid + "</span>" );
				$('#pm-quick-message').css({
					'right' : displayPercent
				});
				methods.resetMessage();
			  
			} else if( response === 'password_error' ){
				
				//Show slide out box with error
				$('#pm-quick-message').find('span').replaceWith( "<span>" + $closeTag + " " + wordpressOptionsObject.loginMessageInvalid + "</span>" );
				$('#pm-quick-message').css({
					'right' : displayPercent
				});
				methods.resetMessage();
			
			} else if( response === 'login_success' ){
				
				//Show slide out box with success and redirect to forums page
			  	$('#pm-quick-message').find('span').replaceWith( "<span>" + $closeTag + " " + wordpressOptionsObject.loginMessageSuccess + "</span>" );
				$('#pm-quick-message').css({
					'right' : displayPercent
				});
			  
			    setTimeout(function(){
				   //window.location.replace('http://dev.pulsarmedia.ca/forums');
				   location.reload(); 
			    }, 4000);	
			  
			} else if( response === 'login_failed' ){ //system error notice
				
				//Show slide out box with success and redirect to forums page
			  	$('#pm-quick-message').find('span').replaceWith( "<span>" + $closeTag + " " + wordpressOptionsObject.failedMessage + "</span>" );
				$('#pm-quick-message').css({
					'right' : displayPercent
				});
				methods.resetMessage();
			  
			} else if( response === 'credentials_failed' ){ //bad credentials
				
			  	//Show slide out box with error
				$('#pm-quick-message').find('span').replaceWith( "<span>" + $closeTag + " " + wordpressOptionsObject.loginMessageInvalid + "</span>" );
				$('#pm-quick-message').css({
					'right' : displayPercent
				});
				methods.resetMessage();
				
			} else {
				
			  //do nothing
			  
			}
		  }
		});
		
	  });
	});
	
	var methods = {
	
		resetMessage : function(e) {
						
			var $message = $('#pm-quick-message');
			
			setTimeout(function(){
			   
			   $message.css({
					'right' : hidePercent
			   });
			   
		    }, 4000);	
			
			
		},
				
		
	};

	
})(jQuery);

