<?php
/**
* Template Name: Login
*/

get_header();

if ( ! is_user_logged_in() ) {
    $args = array(
        'redirect' => home_url(),
        'form_id' => 'cure_login_form',
        'label_username' => __( 'Email Address' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in' => __( 'LOG IN' ),
        'remember' => false
    );
    
    ?>
        <div class="cure-login-container">
            <div style="background-image:url(<?= get_template_directory_uri() . '/img/login-bg-left.png' ?>)">
                <div class="inner">
                    <img class="login-logo" src="<?= get_template_directory_uri() . '/img/logo-light.avif' ?>">
                    <h1>Accounts Management Dashboard</h1>
                </div>
            </div>
            <div class="login-form-container" style="background-image:url(<?= get_template_directory_uri() . '/img/login-bg-right.png' ?>)">
                <div class="inner">
                    <h2>Login</h2>
                    <?php wp_login_form( $args ); ?>
                </div>
                <div class="forgot-password">
                    <a href="javascript:void(0)">Forgot Password?</a>
                </div>
            </div>
        </div>

        <script src="<?= includes_url() . 'js/jquery/jquery.min.js?ver=3.6.3' ?>"></script>

        <?php include(get_template_directory() . '/template-parts/modals/forgot-password.php'); ?>
    <?php

    echo do_shortcode('[]');
}

get_footer();