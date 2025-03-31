/*
	Ajax Example - JavaScript for public pages
*/

(function($) {
	
	$(document).ready(function() {
		
		// When user clicks the link
		$('.ajax-learn-more a').on( 'click', function(event) {
			
			// Prevent default
			event.preventDefault();
			
			// Add loading message
			$('.ajax-response').html('Loading...');
			
			// Define url
			var author_id = $(this).data('id');
			
			// Submit the data
			$.post(ajax_public.ajaxurl, {
				
				nonce:     ajax_public.nonce,
				action:    'public_hook',
				author_id: author_id
				
			}, function(data) {
				
				// Log data
				console.log(data);
				
				// Display data
				$('.ajax-response').html(data);
				
			});
			
		});
		
	});
	
})( jQuery );
