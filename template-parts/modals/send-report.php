<div class="cure-modal crm-send-report hidden" style="display:none" data-model="cr-send">
    <div class="inner">
        <div class="cure-modal-header">
            <h3>Send this Report</h3>
            <a class="close-modal" href="javascript:void(0)"><img src="<?= get_template_directory_uri() . '/img/icons/close.png' ?>"></a>
        </div>
        <div class="cure-modal-body">
            <form id="send_report" method="post" action="<?= get_site_url() . '/approvals' ?>">
                <div class="cure-field-group">
                    <label>Client's Email Address</label>
                    <input type="email" name="client_email" value="" placeholder="Client's Email Address">
                    <!-- WTD -->
                    <input type="hidden" name="ga_cost_wtd" value="">
                    <input type="hidden" name="visitors_wtd" value="">
                    <!-- MTD -->
                    <input type="hidden" name="ga_cost_mtd" value="">
                    <input type="hidden" name="visitors_mtd" value="">
                    <!-- FORM CHECK -->
                    <input type="hidden" name="report_id" value="">
                    <input type="hidden" name="send_report" value="1">
                    <input type="submit" class="hidden">
                </div>
            </form>
        </div>
        <div class="cure-modal-footer">
            <div class="modal-btn-wrapper">
                <a class="btn-cure-secondary btn-close" href="javascript:void(0)">Cancel</a>
                <a class="btn-cure modal-submit" href="javascript:void(0)">Send Report</a>
            </div>
        </div>
    </div>
</div>

<?php 
/**
 * CURE ACTION - SEND CLIENT REPORT
 */
if(isset($_POST['send_report']) == "1") {

    echo get_the_ID();
    echo 'fasdfasdfsdaf';

    //allow html email
    add_filter('wp_mail_content_type', function( $content_type ) {
        return 'text/html';
    });

	//user posted variables
    $report_id = $_POST['report_id'];
	$name = 'gadfsafd';
	$email = '<lee.morgan@curecollective.com.au>';
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

    //Update approval status to approved
    update_field('status', 'Approved', $report_id);

}
?>