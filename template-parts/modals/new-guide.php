<div class="cure-modal new-guide hidden" style="display:none" data-modal="new-guide">
    <div class="inner">
        <div class="cure-modal-header">
            <h3>New Guide</h3>
            <a class="close-modal" href="javascript:void(0)"><img src="<?= get_template_directory_uri() . '/img/icons/close.png' ?>"></a>
        </div>
        <div class="cure-modal-body">
            <form id="new-guide" method="GET" action="">
                <div class="cure-field-group">
                    <label>Title</label>
                    <input type="text" name="guide_title" value="">
                </div>
                <div class="cure-field-group hidden">
                    <input type="hidden" name="new-guide" value="1">
                    <input type="submit" class="hidden">
                </div>
                <p class="error-msg">You missed something..</p>
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