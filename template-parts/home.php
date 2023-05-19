<?php
/**
* Template Name: Home
*/

get_header();
$user_id = get_current_user_id();
$user_first_name = get_user_meta( $user_id, 'first_name', true );
$user_last_name = get_user_meta( $user_id, 'last_name', true ); ?>

<div class="main">
    <div class="greetings">
        <img class="user-profile-img" src="<?= get_template_directory_uri() . '/img/icons/user.png'?>">
        <h2></h2>
    </div>
</div>
<script>
    jQuery(document).ready(function($) {

        // Calculate Greeting
        let currentTime = new Date();
        let time = currentTime.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: false });
        console.log(time);
        let greeting;
        if(time >= "05:00") {
            greeting = "Good Morning, <?= $user_first_name ?>!";
        } else if(time >= "12:00") {
            greeting = "Good Afternoon, <?= $user_first_name ?>!";
        } else if(time >= "17:00") {
            greeting = "Good Evening, <?= $user_first_name ?>!";
        }
        $('.greetings h2').text(greeting);
    });
</script>

<?php get_footer();