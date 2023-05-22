<div class="cure-modal new-brief hidden" style="display:none" data-modal="new-brief">
    <div class="inner">
        <div class="cure-modal-header">
            <h3>New Brief</h3>
            <a class="close-modal" href="javascript:void(0)"><img src="<?= get_template_directory_uri() . '/img/icons/close.png' ?>"></a>
        </div>
        <div class="cure-modal-body">
            <form id="new-brief" method="post" action="">
                <div class="cure-field-group">
                    <label>Select Client</label>
                    <select class="has-select2">
                        <option>Client 1</option>
                        <option>Client 2</option>
                        <option>Client 3</option>
                    </select>
                </div>
                <div class="cure-field-group">
                    <label>Select Template</label>
                    <select class="has-select2">
                        <option>Advertising</option>
                        <option>Design</option>
                        <option>WordPress</option>
                    </select>
                </div>
                <div class="cure-field-group hidden">
                    <input type="hidden" name="new-brief" value="1">
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