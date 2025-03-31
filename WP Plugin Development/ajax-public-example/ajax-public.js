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

        // When user clicks the Joke Button
        $('.ajax-joke-button').on('click', function(e) {
            e.preventDefault();
        
            const $jokeBox = $('.ajax-joke-response');
            $jokeBox.html('Fetching a joke...');
        
            $.post(ajax_public.ajaxurl, {
                nonce: ajax_public.nonce,
                action: 'get_random_joke'
            }, function(response) {
                if (response.success) {
                    $jokeBox.html('<p>' + response.data + '</p>');
                } else {
                    $jokeBox.html('<p>' + response.data + '</p>');
                }
            });
        });
		
	});
	
})( jQuery );
