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