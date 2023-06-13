<div class="cure-modal new-user hidden" style="display:none" data-modal="new-user">
    <div class="inner">
        <div class="cure-modal-header">
            <h3>New User</h3>
            <a class="close-modal" href="javascript:void(0)"><img src="<?= get_template_directory_uri() . '/img/icons/close.png' ?>"></a>
        </div>
        <div class="cure-modal-body">
            <form id="new-user" method="post" action="">
                <div class="cure-field-group">
                    <label>Email address</label>
                    <input type="email" name="user_email_address" value="">
                </div>
                <div class="cure-field-group">
                    <label>First name</label>
                    <input type="text" name="user_first_name" value="">
                </div>
                <div class="cure-field-group">
                    <label>Last name</label>
                    <input type="text" name="user_last_name" value="">
                </div>
                <div class="cure-field-group multi">
                    <div>
                        <label>Hours per day</label>
                        <input type="text" name="hours_per_day" value="">
                    </div>
                    <div>
                        <label>Days per week</label>
                        <div class="days-of-the-week">
                            <div data-day="Monday">Mon</div>
                            <div data-day="Tuesday">Tue</div>
                            <div data-day="Wednesday">Wed</div>
                            <div data-day="Thursday">Thu</div>
                            <div data-day="Friday">Fri</div>
                        </div>
                        <input type="hidden" name="working_days_per_week" value="">
                    </div>
                </div>
                <div class="cure-field-group">
                    <label>Role</label>
                    <input type="text" name="cure_role" value="">
                </div>
                <div class="cure-field-group">
                    <label>User ID - ProofHub</label>
                    <input type="text" name="userid_ph" value="">
                </div>
                <div class="cure-field-group hidden">
                    <input type="hidden" name="working_days_selected" value="">
                    <input type="hidden" name="new_user" value="1">
                    <input type="submit" class="hidden">
                </div>
                <p class="error-msg">You missed something..</p>
            </form>
        </div>
        <div class="cure-modal-footer">
            <div class="modal-btn-wrapper">
                <a class="btn-cure-secondary btn-close" href="javascript:void(0)">Cancel</a>
                <a class="btn-cure modal-submit" href="javascript:void(0)">Invite</a>
            </div>
        </div>
    </div>
</div>