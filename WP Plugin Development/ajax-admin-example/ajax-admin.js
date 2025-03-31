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

        // Joke button click
        $('#get-joke-btn').on('click', function() {
            $('#joke-response').html('Loading a joke...');

            $.get('https://official-joke-api.appspot.com/jokes/random', function(data) {
                if (data && data.setup && data.punchline) {
                    $('#joke-response').html(
                        '<strong>' + data.setup + '</strong><br>' +
                        '<em>' + data.punchline + '</em>'
                    );
                } else {
                    $('#joke-response').html('No joke found.');
                }
            }).fail(function() {
                $('#joke-response').html('Failed to load a joke. Try again.');
            });
        });
		
	});
	
})( jQuery );
