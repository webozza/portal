<?php get_header() ?>

<?php 
    $author_id = get_post_field( 'post_author', get_the_ID() );
?>

<script>
    // Additional Variables
    cure['guide_id'] = "<?php the_ID() ?>";
</script>

<div class="main single-guide">
    <!-- BREADCRUMBS -->
    <div class="greetings">
        <h2><a class="breadcrumb_parent" href="<?= get_site_url() . '/info-centre'?>">Info Centre</a> / <?= the_title() ?> </h2>
    </div>
    <!-- FILTERS -->
    <div class="cure-filters">
        <div class="filters status-of-approval <?php if(get_field('status') == "Pending Approval") {echo 'pending';} else {echo 'approved';} ?>">
            <div class="the-status"><?= get_field('status') ?></div>
        </div>
        <div class="filters cr-actions has-modal">
            <div class="filter cb-edit">
                <a href="javascript:void(0)" class="">
                    <img src="<?= get_template_directory_uri() . '/img/icons/edit.png' ?>">
                </a>
            </div>
            <div class="filter cr-download">
                <a class="cr--download" href="javascript:void(0)" data-modal="cr-download">
                    Download Guide
                    <img src="<?= get_template_directory_uri() . '/img/icons/download.png'?>">
                </a>
            </div>
            <?php if(get_field('status') !== "Approved") { ?>
                <div class="filter cr-approve">
                    <a href="javascript:void(0)">
                        Approve
                        <img src="<?= get_template_directory_uri() . '/img/icons/send.png'?>">
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- THE CLIENT OVERVIEW -->
    <div class="guide-details cure-section">
        <div class="cod-header">
            <h2><?= get_the_title() ?></h2>
            <div class="co-meta">
                <p>From: <?= get_the_author_meta( 'display_name', $author_id ) ?></p>
                <p>Date: <?= get_the_date() ?></p>
            </div>
        </div>
        <div class="cod-body">
            <?= get_the_content() ?>
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

<?php get_footer() ?>