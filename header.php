<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cure_Portal
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
	<script>
		let tempDir = "<?= get_template_directory_uri() ?>";
	</script>
	<?php if(is_user_logged_in()) { ?>
		<script>
			let cure = {
				root: "<?= get_site_url() ?>",
				nonce: "<?= wp_create_nonce( 'wp_rest' ) ?>",
				current_user_id: "<?= get_current_user_id() ?>",
			}
		</script>
	<?php } ?>
</head>
<?php $url = basename($_SERVER['REQUEST_URI']); ?>
<body <?php if($url == "client-reporting") {echo 'onload="disablePreloader()"';} ?> <?php body_class(); ?>>
<?php if(is_page('client-reporting')) { ?>
	<div class="cure-loader">
		<img src="<?= get_template_directory_uri() . '/img/preloader-1.gif' ?>">
	</div>
	<script>
		let disablePreloader = () => {
			document.querySelector('.cure-loader').style.display = 'none';
		}
	</script>
<?php } ?>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'cure-portal' ); ?></a>

	<header id="masthead" class="site-header">

		<!-- Portal Branding -->
		<div class="site-branding">
			<div class="cure-logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?= get_template_directory_uri() . '/img/logo-dark.svg' ?>">
				</a>
			</div>
		</div>

		<nav id="site-navigation" class="main-navigation">
			<ul class="menu">
				<li class="<?php if($url == "portal" || $url == "") {echo 'active';} ?>">
					<a href="<?= home_url() ?>">
						<img src="<?php if($url == "portal" || $url == "") {echo get_template_directory_uri() . '/img/icons/dashboard-active.png';} else {echo get_template_directory_uri() . '/img/icons/dashboard.png';} ?>">
						Dashboard
					</a>
				</li>
				<li class="<?php if($url == "client-reporting" ) {echo 'active';} ?>">
					<a href="<?= home_url() . '/client-reporting' ?>">
						<img src="<?php if($url == "client-reporting") {echo get_template_directory_uri() . '/img/icons/client-reporting-active.png';} else {echo get_template_directory_uri() . '/img/icons/client-reporting.png';} ?>">
						Client Reporting
					</a>
				</li>
				<!-- <li class="<?php if($url == "checklists" ) {echo 'active';} ?>">
					<a href="<?= home_url() . '/checklists' ?>">
						<img src="<?php if($url == "checklists") {echo get_template_directory_uri() . '/img/icons/checklists-active.png';} else {echo get_template_directory_uri() . '/img/icons/checklists.png';} ?>">
						Checklists
					</a>
				</li> -->
				<li class="<?php if($url == "approvals" ) {echo 'active';} ?>">
					<a href="<?= home_url() . '/approvals' ?>">
						<img src="<?php if($url == "approvals") {echo get_template_directory_uri() . '/img/icons/checklists-active.png';} else {echo get_template_directory_uri() . '/img/icons/checklists.png';} ?>">
						Approvals
					</a>
				</li>
			</ul>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
