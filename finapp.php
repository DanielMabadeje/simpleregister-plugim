<?php

/*
Plugin Name: FinApp
Description: Registration And Login
Version: 1.0
Author: FinApp
Author URI: 
*/


require_once('classes/class-login.php');
require_once('classes/class-registration.php');
require_once('config.php');
$login = new UserLogin();
$register = new UserRegistration();


/**
 * Perform automatic login.
 */
function wpdocs_custom_login()
{
    $creds = array(
        'user_login'    => $_POST['user_email'],
        'user_password' => $_POST['user_pass'],
        'remember'      => true
    );

    $user = wp_signon($creds, false);

    if (is_wp_error($user)) {
        echo $user->get_error_message();
    }

    echo "<script>alert('Login Successful')</script>";
    wp_redirect('/');
    // var_dump(is_user_logged_in());
}

// Run before the headers and cookies are sent.

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['finapp-user-login-form']) {
    add_action('after_setup_theme', 'wpdocs_custom_login');
}
