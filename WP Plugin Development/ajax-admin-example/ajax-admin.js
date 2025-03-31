/*
	    Ajax Example - JavaScript for Admin Area
*/

(function($) {
	
	$(document).ready(function() {
		
		// When user submits the form
		$('.ajax-form').on( 'submit', function(event) {
			
			// Prevent form submission
			event.preventDefault();
			
			// Add loading message
			$('.ajax-response').html('Loading...');
			
			// Define url
			var url = $('#url').val();
			
			// Submit the data
			$.post(ajaxurl, {
				
				nonce:  ajax_admin.nonce,
				action: 'admin_hook',
				url:    url
				
			}, function(data) {
				
				// Log data
				console.log(data);
				
				// Display data
				$('.ajax-response').html(data);
				
			});
			
		});
		
	});
	
})( jQuery );
