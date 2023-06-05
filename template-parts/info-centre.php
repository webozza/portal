<?php
/**
* Template Name: Info Centre
*/

get_header(); ?>

<?php
    $info_centre = array(
        'post_type' => 'guide',
        'posts_per_page' => -1
    );
    $guides = new WP_Query($info_centre);
?>

<?php if( isset($_GET['new-guide']) != "1") { ?>
    <div class="main info-centre">
        <div class="greetings has-options">
            <h2>INFO CENTRE</h2>
            <div>
                <a class="btn-cure trigger-modal" href="javascript:void(0)" data-modal="new-guide">New Guide +</a>
            </div>
        </div>
        <div class="cure-filters">
            <div class="date-notice">
                ONBOARD!
            </div>
            <!-- FILTERS -->
            <div class="filters">
                <div class="filter search-guide cure-search">
                    <div class="cure-field-group">
                        <input type="search" value="" placeholder="Try `Onboarding`">
                    </div>
                </div>
            </div>
        </div>
        <!-- GUIDES LOOP -->
        <div class="guides cure-section">
            <?php if ( $guides->have_posts() ) : ?>

            <?php while ( $guides->have_posts() ) : $guides->the_post(); ?>
                <div class="guide">
                    <a href="<?= get_the_permalink() ?>">
                        <?= get_the_title() ?>
                        <img src="<?= get_template_directory_uri() . '/img/placeholder.png' ?>">
                    </a>
                </div>
            <?php endwhile; ?>

            <?php wp_reset_postdata(); ?>

            <?php endif; ?>
        </div>
    </div>
<?php } else if( isset($_GET['new-guide']) == "1") {
    include( get_template_directory() . '/template-parts/create/new-guide.php' );
} ?>

<!-- MODALS -->
<?php include(get_template_directory() . '/template-parts/modals/new-guide.php') ?>

<?php get_footer();