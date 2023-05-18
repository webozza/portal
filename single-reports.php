<?php get_header() ?>

<script>
    // Additional Variables
    cure['report_id'] = "<?php the_ID() ?>";
</script>

<div class="main single-report">
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
                    Download Report
                    <img src="<?= get_template_directory_uri() . '/img/icons/download.png'?>">
                </a>
            </div>
            <div class="filter cr-send">
                <a href="javascript:void(0)" data-modal="cr-send">
                    Approve and Send to Client
                    <img src="<?= get_template_directory_uri() . '/img/icons/send.png'?>">
                </a>
            </div>
        </div>
    </div>
    <!-- THE REPORT -->
    <?php the_content() ?>
    <!-- THE REVISIONS -->
    
</div>

<!-- MODALS -->
<?php include(get_template_directory() . '/template-parts/modals/send-report.php') ?>

<?php get_footer() ?>