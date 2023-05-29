<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cure_Portal
 */

?>

	<!-- <footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'cure-portal' ) ); ?>">
				<?php
				printf( esc_html__( 'Proudly powered by %s', 'cure-portal' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'cure-portal' ), 'cure-portal', '<a href="http://underscores.me/">Underscores.me</a>' );
				?>
		</div>
	</footer> -->
</div>

<?php 
	$user_id = get_current_user_id();
	$user_first_name = get_user_meta( $user_id, 'first_name', true );
	$user_last_name = get_user_meta( $user_id, 'last_name', true );
?>

<script>
	jQuery(document).ready(function ($) {
		// Profile Image
		let firstName = "<?= $user_first_name ?>";
		let lastName = "<?= $user_last_name ?>";
		let fullName = `${firstName} ${lastName}`;
		let profileImg = $(".user-profile-img");

		if (fullName == "Rony Chowdhury") {
			profileImg.attr("src", `${tempDir}/img/users/rony-chowdhury.jpeg`);
		} else if (fullName == "Lee Morgan") {
			profileImg.attr("src", `${tempDir}/img/users/lee-morgan.jpeg`);
		} else if (fullName == "Shawn Peh") {
			profileImg.attr("src", `${tempDir}/img/users/shawn-peh.jpeg`);
		} else if (fullName == "Syiqin Shukri") {
			profileImg.attr("src", `${tempDir}/img/users/syiqin-shukri.jpeg`);
		}
	});
</script>
<?= get_site_url() ?>
<div class="hidden">
	<div class="approval-notification">
		<?php 
			if(get_site_url() == "http://localhost:9090/portal") {
				do_shortcode('[contact-form-7 id="153" title="Approval Notifcation"]');
			} else {
				do_shortcode('[contact-form-7 id="95" title="Approval Notification - Briefs"]');
			}
		?>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
