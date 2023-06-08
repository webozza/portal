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
		} else if (fullName == "Tom Jacob") {
			profileImg.attr("src", `${tempDir}/img/users/tom-jacob.jpeg`);
		}
	});
</script>
<div class="hidden">
	<div class="approval-notification">
		<?php 
			if(get_site_url() == "https://cure-portal.local") {
				echo do_shortcode('[contact-form-7 id="153" title="Approval Notifcation"]');
			} else {
				echo do_shortcode('[contact-form-7 id="95" title="Approval Request Notification - Briefs"]');
				echo do_shortcode('[contact-form-7 id="101" title="Approved Notification - Briefs"]');
			}
		?>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
