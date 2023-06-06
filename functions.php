<?php
/**
 * Cure Portal functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Cure_Portal
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.69' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cure_portal_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Cure Portal, use a find and replace
		* to change 'cure-portal' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'cure-portal', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'cure-portal' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'cure_portal_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'cure_portal_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cure_portal_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cure_portal_content_width', 640 );
}
add_action( 'after_setup_theme', 'cure_portal_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cure_portal_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'cure-portal' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'cure-portal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'cure_portal_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cure_portal_scripts() {
	wp_enqueue_style( 'cure-portal-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'cure-portal-style', 'rtl', 'replace' );

	// Libraries - Global Styles
	wp_enqueue_style( 'data-table', get_template_directory_uri() . '/css/datatables.min.css' );
	wp_enqueue_style( 'select2', get_template_directory_uri() . '/css/select2.min.css' );
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper.min.css' );

	// Libraries - Global Scripts
	wp_enqueue_script( 'data-table-script', get_template_directory_uri() . '/js/datatables.min.js', array('jquery') );
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper.min.js', array('jquery') );
	wp_enqueue_script( "jspdf", get_template_directory_uri() . '/js/jspdf.min.js', array('jquery') );
	wp_enqueue_script( "autotable", get_template_directory_uri() . '/js/autotable.min.js', array('jquery') );
	wp_enqueue_script( 'select2', get_template_directory_uri() . '/js/select2.min.js', array(), _S_VERSION, true );

	// Scripts - Global
	wp_enqueue_script( 'cure-portal-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	
	if(is_user_logged_in()) {
		wp_enqueue_script( 'global', get_template_directory_uri() . '/js/global.js', array('jquery'), _S_VERSION, true );
	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Scripts - Client Reportin Section
	if( is_page('client-reporting') ) {
		wp_enqueue_script( "client-reporting", get_template_directory_uri() . '/js/client-reporting.js', array('jquery'), _S_VERSION, true );
	}

	// Scripts - Approvals Section
	if( is_page('approvals') ) {
		wp_enqueue_script( "approvals", get_template_directory_uri() . '/js/approvals.js', array('jquery'), _S_VERSION, true );
	}

	// Scripts - Single Reports CPT
	if( is_singular('reports') ) {
		wp_enqueue_script( "single-reports", get_template_directory_uri() . '/js/single-reports.js', array('jquery'), _S_VERSION, true );
	}

	// Scripts - Single Client Overview CPT
	if( is_singular('client-overview') ) {
		wp_enqueue_script( "client-overview", get_template_directory_uri() . '/js/single-client-overview.js', array('jquery'), _S_VERSION, true );
	}

	// Scripts - Single Project Brief CPT
	if( is_singular('project-brief') ) {
		wp_enqueue_script( "project-brief", get_template_directory_uri() . '/js/single-brief.js', array('jquery'), _S_VERSION, true );
	}

	// Scripts - Briefs Overview
	if( is_page('briefs') ) {
		wp_enqueue_script( "briefs", get_template_directory_uri() . '/js/briefs.js', array('jquery'), _S_VERSION, true );
	}

	// Scripts - Checklists
	if( is_page('checklists') ) {
		wp_enqueue_script( "checklists", get_template_directory_uri() . '/js/checklists.js', array('jquery'), _S_VERSION, true );
	}

	// Scripts - Checklists
	if( is_page('guidelines') ) {
		wp_enqueue_script( "guidelines", get_template_directory_uri() . '/js/guidelines.js', array('jquery'), _S_VERSION, true );
	}

	// Scripts - Single Project Brief CPT
	if( is_singular('guide') ) {
		wp_enqueue_script( "single-guide", get_template_directory_uri() . '/js/single-guide.js', array('jquery'), _S_VERSION, true );
	}
}
add_action( 'wp_enqueue_scripts', 'cure_portal_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * If user is logged in, send him to home page
 */
function redirect_logged_in() {
	$url = basename($_SERVER['REQUEST_URI']);
	if( is_user_logged_in() && $url == 'login' ) {
		wp_redirect( home_url('/') );
		exit;
	} elseif ( !is_user_logged_in() && $url != 'login' ) {
		wp_redirect( home_url('/login') );
		exit;
	}
}
add_action('template_redirect', 'redirect_logged_in');

/**
 * Block super admin access
 */
function blockusers_init() { 
	if ( is_admin() && get_current_user_id() != 1 && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) { wp_redirect( home_url() ); exit; } 
}
add_action( 'init', 'blockusers_init' ); 

/**
 * Filter & Function to rename the WordPress login URL
 */
function redirect_login_page() {
    $login_url  = home_url( '/login' );
    $url = basename($_SERVER['REQUEST_URI']); // get requested URL
    isset( $_REQUEST['redirect_to'] ) ? ( $url = "wp-login.php" ): 0; // if users ssend request to wp-admin
    if( $url  == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET' )  {
        wp_redirect( $login_url );
        exit;
    }
}
add_action('init','redirect_login_page');

/**
 * Hide the admin bar
 */
function remove_admin_bar() {
	show_admin_bar(false);
}
add_action('after_setup_theme', 'remove_admin_bar');

/**
 * CURE ACTION - SEND CLIENT REPORT
 */
function send_client_report() {
	if(isset($_POST['send_report']) == "1") {

		//Update approval status to approved
		$report_id = $_POST['report_id'];
		update_field('status', 'Approved', $report_id);
	
		//allow html email
		add_filter('wp_mail_content_type', function( $content_type ) {
			return 'text/html';
		});
	
		//user posted variables
		$name = 'gadfsafd';
		$email = '<web@curecollective.com.au>';
		ob_start();
		include(get_template_directory() . '/template-parts/emails/send-report.php');
		$message = ob_get_clean();
	
		//php mailer variables
		$to = $_POST['client_email'];
		$subject = get_field('client') . " - Weekly Media Performance Snapshot";
		$headers = 'From: '. $email . "\r\n" .
			'Reply-To: ' . $email . "\r\n";
	
		//Here put your Validation and send mail
		$sent = wp_mail($to, $subject, $message, $headers);
	
	}
}
add_action('init','send_client_report');

/**
 * Redirection after logout
 */
add_action('wp_logout','auto_redirect_external_after_logout');
function auto_redirect_external_after_logout(){
  wp_redirect( get_site_url() . '/login' );
  exit();
}

/**
 * Publish new post
 */
function new_guide() {
	if( isset($_POST['new_guide']) == "1" ) {
		$post_data = array(
			'post_type' => 'guide',
			'post_title' => $_POST['guide_title'],
			'post_content' => $_POST['guide_content'],
			'post_status' => 'publish',
		);
		$post_id = wp_insert_post( $post_data );
		update_post_meta($post_id,'status','Pending Approval');
		wp_redirect(get_site_url() . '/guidelines');
	}
}
add_action('init','new_guide');
