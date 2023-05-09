<div class="cure-modal crm-send-report hidden" style="display:none" data-model="cr-send">
    <div class="inner">
        <div class="cure-modal-header">
            <h3>Send this Report</h3>
            <a class="close-modal" href="javascript:void(0)"><img src="<?= get_template_directory_uri() . '/img/icons/close.png' ?>"></a>
        </div>
        <div class="cure-modal-body">
            <form id="send_report" method="post" action="">
                <div class="cure-field-group">
                    <label>Client's Email Address</label>
                    <input type="email" name="client_email" value="" placeholder="Client's Email Address">
                    <input type="hidden" name="client" value="<?= $client ?>">
                    <input type="hidden" name="report_type" value="<?= $report_type ?>">
                    <input type="hidden" name="project_name" value="<?= $project_name ?>">
                    <input type="hidden" name="send_report" value="1">
                    <input type="hidden" name="single_client_report_view" value="1">
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

    // get insights and actions
    $insights = $_POST['insights'];

	//user posted variables
	$name = 'fadsfsadfsadf';
	$email = '<lee.morgan@curecollective.com.au>';
	foreach($insights as $insight) {
        $email = '<li>'. $insight .'</li>';
    }

    //allow html email
    add_filter('wp_mail_content_type', function( $content_type ) {
        return 'text/html';
    });

	//php mailer variables
	$to = $_POST['client_email'];
	$subject = $_POST['project_name'] . " - Weekly Media Performance Snapshot";
	$headers = 'From: '. $email . "\r\n" .
		'Reply-To: ' . $email . "\r\n";

	//Here put your Validation and send mail
	$sent = wp_mail($to, $subject, $message, $headers);
}
?>