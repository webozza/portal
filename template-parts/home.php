<?php
/**
* Template Name: Home
*/

get_header();
$user_id = get_current_user_id();
$user_first_name = get_user_meta( $user_id, 'first_name', true ); ?>

<div class="main">
    <div class="greetings">
        <img class="user-profile-img" src="<?= get_template_directory_uri() . '/img/icons/user.png'?>">
        <h2>Good afternoon, <?= $user_first_name ?>!</h2>
    </div>
</div>

<?php get_footer();