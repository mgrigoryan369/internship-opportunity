<?php 

// Lesson Takeaways from module 1 & 2 
// action modifies functionality 
// filter modifies data


// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// login_redirect hook
function change_login_destination($redirect_url){
    $redirect_url = '/some-url';
    return $redirect_url;
}
add_filter('login_redirect', 'change_login_destination');

// login_header hook 
function hello_world() {
	echo "Hello World!";
}
add_action( 'login_header', 'hello_world' ); 

// login_headerurl hook
function change_headerurl($url){
    $url = "https://example.com";
    return $url;
}
add_filter('login_headerurl', 'change_headerurl'); 

// admin_notices hook 
function hello_user() {
    if (is_admin()){
        echo "Hello Admin!";
    }else {
        echo "Hello World!";
    }
}
add_action( 'admin_notices', 'hello_user' ); 