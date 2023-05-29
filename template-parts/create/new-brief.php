<?php
    $first_name = get_user_meta(get_current_user_id(), 'first_name', true);
    $last_name = get_user_meta(get_current_user_id(), 'last_name', true);
    $editor_toolbar = array(
        'tinymce' => array(
            'toolbar1' => 'bold,italic,underline,separator,alignleft,aligncenter,alignright,separator,link,unlink,undo,redo, bullist, numlist',
        ),
        'editor_height' => 200,
        'textarea_rows' => 20,
    );
    $assigned_email = get_userdata(get_current_user_id())->user_email;
?>

<script>
    cure['preparedBy'] = "<?= $first_name . ' ' . $last_name ?>";
    cure['preparedByEmail'] = "<?= $assigned_email ?>";
    cure['preparedFor'] = "<?= $_GET['client'] ?>";
    cure['preparedDate'] = "<?= date("d-m-Y") ?>";
    cure['draftsDate'] = "<?= $_GET['drafts_date'] ?>";
    cure['deliveryDate'] = "<?= $_GET['delivery_date'] ?>";
    cure['inMarketDate'] = "<?= $_GET['in_market_date'] ?>";
    cure['template'] = "<?= $_GET['template'] ?>";
</script>

<div class="main create-client-overview">
    <div class="greetings has-options">
        <h2>Create Advertising Brief</h2>
        <div>
            <a class="btn-cure btn-co-approval" href="javascript:void(0)">Send for Approval</a>
        </div>
    </div>
    <div class="cure-filters">
        <div class="date-notice">
            Confidential - <?= $_GET['template'] ?> Brief - <strong><?= $_GET['client'] ?></strong>
        </div>
        <div class="client-overview-info">
            <ul>
                <li class="prepared-by">From: <?= $first_name . ' ' . $last_name?></li>
                <li class="prepared-date">Briefing Date: <?= date("d-m-Y") ?></li>
                <li>Drafts: <?= $_GET['drafts_date'] ?></li>
                <li>Delivery Date: <?= $_GET['delivery_date'] ?></li>
                <li>In Market Date: <?= $_GET['in_market_date'] ?></li>
            </ul>
        </div>
        <!-- SLIDES -->
        <div class="client-overview-fields">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <!-- Background -->
                    <div class="swiper-slide">
                        <div class="cure-field-group">
                            <h3>Background</h3>
                            <?php wp_editor('', 'background', $editor_toolbar) ?>
                        </div>
                    </div>
                    <!-- Campaign objective -->
                    <div class="swiper-slide">
                        <div class="cure-field-group">
                            <h3>Campaign objective</h3>
                            <?php wp_editor('', 'campaign_objective', $editor_toolbar) ?>
                        </div>
                    </div>
                    <!-- Audience -->
                    <div class="swiper-slide">
                        <div class="cure-field-group">
                            <h3>Audience</h3>
                            <?php wp_editor('', 'audience', $editor_toolbar) ?>
                        </div>
                    </div>
                    <!-- Deliverables -->
                    <div class="swiper-slide">
                        <div class="cure-field-group">
                            <h3>Deliverables</h3>
                            <?php wp_editor('', 'deliverables', $editor_toolbar) ?>
                        </div>
                    </div>
                    <!-- Key messages -->
                    <div class="swiper-slide">
                        <div class="cure-field-group">
                            <h3>Key messages</h3>
                            <?php wp_editor('', 'key_messages', $editor_toolbar) ?>
                        </div>
                    </div>
                    <!-- Destination/desired action -->
                    <div class="swiper-slide">
                        <div class="cure-field-group">
                            <h3>Destination/desired action (landing page link, form)</h3>
                            <?php wp_editor('', 'desired_action', $editor_toolbar) ?>
                        </div>
                    </div>
                    <!-- Budget -->
                    <div class="swiper-slide">
                        <div class="cure-field-group">
                            <h3>Budget</h3>
                            <?php wp_editor('', 'budget', $editor_toolbar) ?>
                        </div>
                    </div>
                    <!-- Expected return -->
                    <div class="swiper-slide">
                        <div class="cure-field-group">
                            <h3>Expected return</h3>
                            <?php wp_editor('', 'expected_return', $editor_toolbar) ?>
                        </div>
                    </div>
                    <!-- Metrics to track -->
                    <div class="swiper-slide">
                        <div class="cure-field-group">
                            <h3>Metrics to track</h3>
                            <?php wp_editor('', 'metrics_to_track', $editor_toolbar) ?>
                        </div>
                    </div>
                    <!-- Any other supporting files -->
                    <div class="swiper-slide">
                        <div class="cure-field-group">
                            <h3>Any other supporting files</h3>
                            <input type="file" name="supporting_files">
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
        <!-- Contact Asignee -->
        <!-- <div class="asignee-contact">
            <p>Any questions:</p>
            <br>
            <p>Asignee name</p>
            <p>Designation</p>
            <p>Email of asignee</p>
        </div> -->
    </div>

    
</div>