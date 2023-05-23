<div class="cure-modal client-overview hidden" style="display:none" data-modal="client-overview">
    <div class="inner">
        <div class="cure-modal-header">
            <h3>New Client Overview</h3>
            <a class="close-modal" href="javascript:void(0)"><img src="<?= get_template_directory_uri() . '/img/icons/close.png' ?>"></a>
        </div>
        <div class="cure-modal-body">
            <form id="client-overview" method="GET" action="">
                <div class="cure-field-group">
                    <label>Client name</label>
                    <input type="text" name="co_client_name" value="">
                    <p class="error-msg">Please enter client name</p>
                </div>
                <div class="cure-field-group hidden">
                    <input type="hidden" name="co_date_created" value="">
                    <input type="hidden" name="co_created_by" value="">
                    <input type="hidden" name="client_overview" value="1">
                    <input type="submit" class="hidden">
                </div>
            </form>
        </div>
        <div class="cure-modal-footer">
            <div class="modal-btn-wrapper">
                <a class="btn-cure-secondary btn-close" href="javascript:void(0)">Cancel</a>
                <a class="btn-cure modal-submit" href="javascript:void(0)">Create</a>
            </div>
        </div>
    </div>
</div>