/*
	JavaScript for public pages
	
		- Wraps code in IIFE
		- Enables noconflict mode
		- Enables strict mode
*/
(function( $ ) {
	
	/*
		Enable strict mode
		
			- Encourages best practice
			- Throws exceptions for common coding errors
			- Throws errors for potentially unsafe actions
	*/
	'use strict';
	
	/*
		Add your own jQuery code here, some examples:
	
		$(function() {
			// run code when the DOM is ready
		});
	*/	
		$( document ).ready(function() {
            console.log("The ADMIN JS example is loaded in successfully.")
		}); 
	/*	
		$( window ).load(function() {
			// run code when the window is loaded
		});
    */
	
})( jQuery );
