<?php
    $root = get_site_url();
?>

<div class="cure-modal forgot-password hidden" style="display:none" data-model="cr-send">
    <div class="inner">
        <div class="cure-modal-header">
            <h3>Reset Password</h3>
            <a class="close-modal" href="javascript:void(0)"><img src="<?= get_template_directory_uri() . '/img/icons/close.png' ?>"></a>
        </div>
        <div class="cure-modal-body">
            <iframe src="<?= $root . '/wp-login.php?action=lostpassword' ?>"></iframe>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        $('.close-modal').click(function() {
            $(this).parent().parent().parent().hide();
        });
        $('.forgot-password:not(.cure-modal) a').click(function() {
            $('.cure-modal.forgot-password').fadeIn().css('display','flex');
        })
    });
</script>