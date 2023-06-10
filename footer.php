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
