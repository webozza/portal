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
	define( '_S_VERSION', '1.0.09' );
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
	
	wp_enqueue_script( 'cure-portal-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if( is_page('client-reporting') ) {
		wp_enqueue_style( 'data-table', get_template_directory_uri() . '/css/datatables.min.css' );
		wp_enqueue_script( 'data-table-script', get_template_directory_uri() . '/js/datatables.min.js', array('jquery') );
		wp_enqueue_script( "client-reporting", get_template_directory_uri() . '/js/client-reporting.js', array('jquery'), _S_VERSION, true );
		wp_enqueue_script( "jspdf", get_template_directory_uri() . '/js/jspdf.min.js', array('jquery'), _S_VERSION, true );
		wp_enqueue_script( "autotable", get_template_directory_uri() . '/js/autotable.min.js', array('jquery'), _S_VERSION, true );
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
 * Forgot Password
 */
add_shortcode('custom-password-lost-form', 'render_password_lost_form');
function render_password_lost_form($attributes, $content = null) {
	// Parse shortcode attributes
	$default_attributes = array('show_title' => false);
	$attributes = shortcode_atts($default_attributes, $attributes);


	if (is_user_logged_in()) {
		return __('You are already signed in.', 'personalize-login');
	} else {
		if ( isset( $_REQUEST['errors'] ) ) {
			switch($_REQUEST['errors']){
				case 'empty_username':
					_e( 'You need to enter your email address to continue.', 'personalize-login' );
				case 'invalid_email':
				case 'invalidcombo':
					_e( 'There are no users registered with this email address.', 'personalize-login' );
			}
		}
		if ( isset( $_REQUEST['checkemail'] ) ) {
			switch($_REQUEST['checkemail']){
				case 'confirm':
					_e( 'Password reset email has been sent.', 'personalize-login' );
			}
//			return;
		}
		if ( isset( $_POST['user_login'] ) ) {
			var_dump($_POST['user_login']);
		}
//		$link = get_the_permalink();
		//var_dump($link);
		?>
		<div id="password-lost-form" class="widecolumn">
			<?php if ($attributes['show_title']) : ?>
				<h3><?php _e('Forgot Your Password?', 'personalize-login'); ?></h3>
			<?php endif; ?>

			<p>
				<?php
				_e(
					"Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.",
					'personalize_login'
				);
				?>
			</p>

			<form id="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">
				<p class="form-row">
					<label for="user_login"><?php _e('Email', 'personalize-login'); ?>
						<input type="text" name="user_login" id="user_login">
				</p>

				<p class="lostpassword-submit">
					<input type="submit" name="submit" class="lostpassword-button"
					       value="<?php _e('Reset Password', 'personalize-login'); ?>"/>
				</p>
			</form>
		</div>
		<?php
	}
}

add_action('login_form_lostpassword', 'do_password_lost');
function do_password_lost() {
	if ('POST' == $_SERVER['REQUEST_METHOD']) {
		$errors = retrieve_password();
		if (is_wp_error($errors)) {
			// Errors found
			$redirect_url = home_url('member-password-lost');//page slug where reset shortcode will be use
			$redirect_url = add_query_arg('errors', join(',', $errors->get_error_codes()), $redirect_url);
		} else {
			// Email sent
//			$link = get_the_permalink();
//			var_dump($link);
//			$redirect_url = home_url('signin');
			$redirect_url = home_url('member-password-lost');//page slug where reset shortcode will be use
			$redirect_url = add_query_arg('checkemail', 'confirm', $redirect_url);
		}

		wp_redirect($redirect_url);
		exit;
	}
}

//After send Email
add_action('login_form_rp', 'redirect_to_custom_password_reset');
add_action('login_form_resetpass', 'redirect_to_custom_password_reset');
function redirect_to_custom_password_reset() {
	if ('GET' == $_SERVER['REQUEST_METHOD']) {
		// Verify key / login combo
		$user = check_password_reset_key($_REQUEST['key'], $_REQUEST['login']);
		if (!$user || is_wp_error($user)) {
			if ($user && $user->get_error_code() === 'expired_key') {
				wp_redirect(home_url('member-login?login=expiredkey'));
			} else {
				wp_redirect(home_url('member-login?login=invalidkey'));
			}
			exit;
		}

		$redirect_url = home_url('member-password-reset');
		$redirect_url = add_query_arg('login', esc_attr($_REQUEST['login']), $redirect_url);
		$redirect_url = add_query_arg('key', esc_attr($_REQUEST['key']), $redirect_url);

		wp_redirect($redirect_url);
		exit;
	}
}


add_shortcode('custom-password-reset-form', 'render_password_reset_form');
function render_password_reset_form($attributes, $content = null) {
	// Parse shortcode attributes
	$default_attributes = array('show_title' => false);
	$attributes = shortcode_atts($default_attributes, $attributes);

	if (is_user_logged_in()) {
		return __('You are already signed in.', 'personalize-login');
	} else {
		if (isset($_REQUEST['login']) && isset($_REQUEST['key'])) {
			$attributes['login'] = $_REQUEST['login'];
			$attributes['key'] = $_REQUEST['key'];

			// Error messages
			$errors = array();
			if (isset($_REQUEST['error'])) {
				$error_codes = explode(',', $_REQUEST['error']);

				foreach ($error_codes as $code) {
					$errors [] = $this->get_error_message($code);
				}
			}
			$attributes['errors'] = $errors;
			?>
			<div id="password-reset-form" class="widecolumn">
				<?php if ($attributes['show_title']) : ?>
					<h3><?php _e('Pick a New Password', 'personalize-login'); ?></h3>
				<?php endif; ?>

				<form name="resetpassform" id="resetpassform"
				      action="<?php echo site_url('wp-login.php?action=resetpass'); ?>" method="post" autocomplete="off">
					<input type="hidden" id="user_login" name="rp_login"
					       value="<?php echo esc_attr($attributes['login']); ?>" autocomplete="off"/>
					<input type="hidden" name="rp_key" value="<?php echo esc_attr($attributes['key']); ?>"/>

					<?php if (count($attributes['errors']) > 0) : ?>
						<?php foreach ($attributes['errors'] as $error) : ?>
							<p>
								<?php echo $error; ?>
							</p>
						<?php endforeach; ?>
					<?php endif; ?>

					<p>
						<label for="pass1"><?php _e('New password', 'personalize-login') ?></label>
						<input type="password" name="pass1" id="pass1" class="input" size="20" value="" autocomplete="off"/>
					</p>
					<p>
						<label for="pass2"><?php _e('Repeat new password', 'personalize-login') ?></label>
						<input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="off"/>
					</p>

					<p class="description"><?php echo wp_get_password_hint(); ?></p>

					<p class="resetpass-submit">
						<input type="submit" name="submit" id="resetpass-button"
						       class="button" value="<?php _e('Reset Password', 'personalize-login'); ?>"/>
					</p>
				</form>
			</div>
			<?php
		} else {
			return __('Invalid password reset link.', 'personalize-login');
		}
	}
}

add_action('login_form_rp', 'do_password_reset');
add_action('login_form_resetpass', 'do_password_reset');
function do_password_reset() {
	if ('POST' == $_SERVER['REQUEST_METHOD']) {
		$rp_key = $_REQUEST['rp_key'];
		$rp_login = $_REQUEST['rp_login'];

		$user = check_password_reset_key($rp_key, $rp_login);

		if (!$user || is_wp_error($user)) {
			if ($user && $user->get_error_code() === 'expired_key') {
				wp_redirect(home_url('signin?login=expiredkey'));
			} else {
				wp_redirect(home_url('signin?login=invalidkey'));
			}
			exit;
		}

		if (isset($_POST['pass1'])) {
			if ($_POST['pass1'] != $_POST['pass2']) {
				// Passwords don't match
				$redirect_url = home_url('member-password-reset');

				$redirect_url = add_query_arg('key', $rp_key, $redirect_url);
				$redirect_url = add_query_arg('login', $rp_login, $redirect_url);
				$redirect_url = add_query_arg('error', 'password_reset_mismatch', $redirect_url);

				wp_redirect($redirect_url);
				exit;
			}

			if (empty($_POST['pass1'])) {
				// Password is empty
				$redirect_url = home_url('member-password-reset');//page slug where reset shortcode will be use

				$redirect_url = add_query_arg('key', $rp_key, $redirect_url);
				$redirect_url = add_query_arg('login', $rp_login, $redirect_url);
				$redirect_url = add_query_arg('error', 'password_reset_empty', $redirect_url);

				wp_redirect($redirect_url);
				exit;
			}

			// Parameter checks OK, reset password
			reset_password($user, $_POST['pass1']);
			wp_redirect(home_url('signin?password=changed'));//page slug where signin shortcode will be use
		} else {
			echo "Invalid request.";
		}

		exit;
	}
}
