<div class="cure-modal guideline-success hidden" style="display:none" data-modal="guideline-success">
    <div class="inner">
        <div class="cure-modal-header">
            <h3>Guide sent for Approval!</h3>
            <a class="close-modal" href="javascript:void(0)"><img src="<?= get_template_directory_uri() . '/img/icons/close.png' ?>"></a>
        </div>
        <div class="cure-modal-body">
            <p>The team leader has been notified. He/She may either:</p>
            <ul>
                <li>send you a request for revision</li>
                <li>approve and publish your guide</li>
            </ul>
            <p>You will be notified of the outcome by email or you can check status by clicking on the view status button below.</p>
        </div>
        <div class="cure-modal-footer">
            <div class="modal-btn-wrapper">
                <a class="btn-cure-secondary btn-close" href="javascript:void(0)">Cancel</a>
                <a class="btn-cure view-status" href="<?= get_site_url() . '/approvals' ?>">View Status</a>
            </div>
        </div>
    </div>
</div>