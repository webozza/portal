<?php get_header() ?>

<script>
    // Additional Variables
    cure['report_id'] = "<?php the_ID() ?>";
</script>

<div class="main single-client-overview">
    <!-- BREADCRUMBS -->
    <div class="greetings">
        <h2><a class="breadcrumb_parent" href="<?= get_site_url() . '/approvals'?>">Approvals</a> / <?= the_title() ?> </h2>
    </div>
    <!-- FILTERS -->
    <div class="cure-filters">
        <div class="filters">
        </div>
        <div class="filters cr-actions has-modal">
            <div class="filter cr-download">
                <a class="cr--download" href="javascript:void(0)" data-modal="cr-download">
                    Download Client Overview
                    <img src="<?= get_template_directory_uri() . '/img/icons/download.png'?>">
                </a>
            </div>
            <div class="filter cr-send">
                <a href="javascript:void(0)" data-modal="cr-send">
                    Approve
                    <img src="<?= get_template_directory_uri() . '/img/icons/send.png'?>">
                </a>
            </div>
        </div>
    </div>
    <!-- THE CLIENT OVERVIEW -->
    <div class="client-overview-details cure-section">
        <div class="cod-header">
            <h2>Confidential - Client Overview - <?= get_field('prepared_for') ?></h2>
            <div class="co-meta">
                <p>Prepared by: <?= get_field('prepared_by') ?></p>
                <p>Date: <?= get_field('prepared_date') ?></p>
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
                    <!-- About the client -->
                    <tr>
                        <td>
                            <div><p>About the client</p></div>
                        </td>
                        <td class="cod-data about-the-client">
                            <div>
                                <?= get_field('about_client') ?>
                            </div>
                        </td>
                    </tr>
                    <!-- Key contact -->
                    <tr>
                        <td>
                            <div><p>Key contact</p></div>
                        </td>
                        <td class="cod-data key-contact">
                            <div>
                                <?= get_field('key_contacts') ?>
                            </div>
                        </td>
                    </tr>
                    <!-- Objectives -->
                    <tr>
                        <td>
                            <div><p>Objectives</p></div>
                        </td>
                        <td class="cod-data objectives">
                            <div>
                                <?= get_field('objectives') ?>
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
                    <!-- Opportunities/challenges -->
                    <tr>
                        <td>
                            <div><p>Opportunities/challenges</p></div>
                        </td>
                        <td class="cod-data opportunities">
                            <div>
                                <?= get_field('opportunities') ?>
                            </div>
                        </td>
                    </tr>
                    <!-- Competitors -->
                    <tr>
                        <td>
                            <div><p>Competitors</p></div>
                        </td>
                        <td class="cod-data competitors">
                            <div>
                                <?= get_field('competitors') ?>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- THE REVISIONS -->
    <?php comments_template( '', true ); ?>
</div>

<!-- MODALS -->
<?php include(get_template_directory() . '/template-parts/modals/send-report.php') ?>

<?php get_footer() ?>