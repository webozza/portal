<?php
    $first_name = get_user_meta($_GET['co_created_by'], 'first_name', true);
    $last_name = get_user_meta($_GET['co_created_by'], 'last_name', true);
    $editor_toolbar = array(
        'tinymce' => array(
            'toolbar1' => 'bold,italic,underline,separator,alignleft,aligncenter,alignright,separator,link,unlink,undo,redo, bullist, numlist',
        ),
        'editor_height' => 200,
        'textarea_rows' => 20,
    );
?>

<script>
    cure['preparedBy'] = "<?= $first_name . ' ' . $last_name ?>";
    cure['preparedFor'] = "<?= $_GET['co_client_name'] ?>";
    cure['preparedDate'] = "<?= date("d-m-Y") ?>";
</script>

<div class="main create-client-overview">
    <div class="greetings has-options">
        <h2>Create Client Overview</h2>
        <div>
            <a class="btn-cure btn-co-approval" href="javascript:void(0)">Send for Approval</a>
        </div>
    </div>
    <div class="cure-filters">
        <div class="date-notice">
            Confidential - Client Overview - <strong><?= $_GET['co_client_name'] ?></strong>
        </div>
        <div class="client-overview-info">
            <ul>
                <li class="prepared-date">Date: <?= date("d-m-Y") ?></li>
                <li class="prepared-by">Prepared By: <?= $first_name . ' ' . $last_name?></li>
            </ul>
        </div>
        <!-- SLIDES -->
        <div class="client-overview-fields">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <!-- About the client -->
                    <div class="swiper-slide">
                        <div class="cure-field-group">
                            <h3>About the client</h3>
                            <?php wp_editor('', 'about_the_client', $editor_toolbar) ?>
                        </div>
                    </div>
                    <!-- Key contacts -->
                    <div class="swiper-slide">
                        <div class="cure-field-group">
                            <h3>Key contacts</h3>
                            <?php wp_editor('', 'key_contacts', $editor_toolbar) ?>
                        </div>
                    </div>
                    <!-- Objectives -->
                    <div class="swiper-slide">
                        <div class="cure-field-group">
                            <h3>Objectives</h3>
                            <?php wp_editor('', 'objectives', $editor_toolbar) ?>
                        </div>
                    </div>
                    <!-- Audience -->
                    <div class="swiper-slide">
                        <div class="cure-field-group">
                            <h3>Audience</h3>
                            <?php wp_editor('', 'audience', $editor_toolbar) ?>
                        </div>
                    </div>
                    <!-- Opportunities -->
                    <div class="swiper-slide">
                        <div class="cure-field-group">
                            <h3>Opportunities</h3>
                            <?php wp_editor('', 'opportunities', $editor_toolbar) ?>
                        </div>
                    </div>
                    <!-- Competitors -->
                    <div class="swiper-slide">
                        <div class="cure-field-group">
                            <h3>Competitors</h3>
                            <?php wp_editor('', 'competitors', $editor_toolbar) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cure-slide-controls">
                <div class="cure-btn-wrapper">
                    <a class="cure-prev-slide btn-cure" href="javascript:void(0)">Prev</a>
                    <a class="cure-next-slide btn-cure" href="javascript:void(0)">Next</a>
                </div>
            </div>
        </div>
    </div>

    
</div>