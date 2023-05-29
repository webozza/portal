<?php get_header() ?>
<?php
    $author_id = get_post_field( 'post_author', get_the_ID() );
?>
<script>
    // Additional Variables
    cure['brief_id'] = "<?php the_ID() ?>";
    cure['preparedBy'] = "<?= get_field('prepared_by') ?>";
    cure['preparedByEmail'] = "<?= get_userdata($author_id)->user_email ?>";
    cure['template'] = "<?= get_field('template') ?>";
</script>
<div class="main single-client-overview">
    <!-- BREADCRUMBS -->
    <div class="greetings">
        <h2><a class="breadcrumb_parent" href="<?= get_site_url() . '/briefs'?>">Briefs</a> / <?= the_title() ?> </h2>
    </div>
    <!-- FILTERS -->
    <div class="cure-filters">
        <div class="filters">
        </div>
        <div class="filters cr-actions has-modal">
            <div class="filter cb-edit">
                <a href="javascript:void(0)" class="">
                    <img src="<?= get_template_directory_uri() . '/img/icons/edit.png' ?>">
                </a>
            </div>
            <div class="filter cr-download">
                <a class="cr--download" href="javascript:void(0)" data-modal="cr-download">
                    Download Brief
                    <img src="<?= get_template_directory_uri() . '/img/icons/download.png'?>">
                </a>
            </div>
            <div class="filter cr-approve">
                <a href="javascript:void(0)">
                    Approve
                    <img src="<?= get_template_directory_uri() . '/img/icons/send.png'?>">
                </a>
            </div>
        </div>
    </div>
    <!-- THE CLIENT OVERVIEW -->
    <div class="client-overview-details cure-section">
        <div class="cod-header">
            <h2>Confidential - <?= get_field('template') ?> Brief - <?= get_field('prepared_for') ?></h2>
            <div class="co-meta">
                <p>From: <?= get_field('prepared_by') ?></p>
                <p>Briefing Date: <?= get_field('briefing_date') ?></p>
                <p>Drafts Date: <?= get_field('drafts_date') ?></p>
                <p>Delivery Date: <?= get_field('delivery_date') ?></p>
                <p>In Market Date: <?= get_field('in_market_date') ?></p>
            </div>
        </div>
        <div class="cod-body">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Background -->
                    <tr>
                        <td>
                            <div><p>Background</p></div>
                        </td>
                        <td class="cod-data background">
                            <div>
                                <?= get_field('background') ?>
                            </div>
                        </td>
                    </tr>
                    <!-- Campaign Objective -->
                    <tr>
                        <td>
                            <div><p>Campaign Objective</p></div>
                        </td>
                        <td class="cod-data campaign-objective">
                            <div>
                                <?= get_field('campaign_objective') ?>
                            </div>
                        </td>
                    </tr>
                    <!-- Audience -->
                    <tr>
                        <td>
                            <div><p>Audience</p></div>
                        </td>
                        <td class="cod-data audience">
                            <div>
                                <?= get_field('audience') ?>
                            </div>
                        </td>
                    </tr>
                    <!-- Deliverables -->
                    <tr>
                        <td>
                            <div><p>Deliverables</p></div>
                        </td>
                        <td class="cod-data deliverables">
                            <div>
                                <?= get_field('deliverables') ?>
                            </div>
                        </td>
                    </tr>
                    <!-- Key Messages -->
                    <tr>
                        <td>
                            <div><p>Key Messages</p></div>
                        </td>
                        <td class="cod-data key-messages">
                            <div>
                                <?= get_field('key_messages') ?>
                            </div>
                        </td>
                    </tr>
                    <!-- Desired Action -->
                    <tr>
                        <td>
                            <div><p>Desired Action</p></div>
                        </td>
                        <td class="cod-data desired-action">
                            <div>
                                <?= get_field('desired_action') ?>
                            </div>
                        </td>
                    </tr>
                    <!-- Budget -->
                    <tr>
                        <td>
                            <div><p>Budget</p></div>
                        </td>
                        <td class="cod-data budget">
                            <div>
                                <?= get_field('budget') ?>
                            </div>
                        </td>
                    </tr>
                    <!-- Expected return -->
                    <tr>
                        <td>
                            <div><p>Expected return</p></div>
                        </td>
                        <td class="cod-data expected-return">
                            <div>
                                <?= get_field('expected_return') ?>
                            </div>
                        </td>
                    </tr>
                    <!-- Metrics to track -->
                    <tr>
                        <td>
                            <div><p>Metrics to track</p></div>
                        </td>
                        <td class="cod-data metrics-to-track">
                            <div>
                                <?= get_field('metrics_to_track') ?>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="cod-footer">
            <a class="save--changes btn-cure" href="javascript:void(0)">
                <img src="<?= get_template_directory_uri() . '/img/live-update-loader.gif' ?>">
            SAVE CHANGES
            </a>
        </div>
    </div>

    <!-- THE REVISIONS -->
    <?php comments_template( '', true ); ?>
</div>

<!-- MODALS -->
<?php include(get_template_directory() . '/template-parts/modals/send-report.php') ?>

<?php get_footer() ?>