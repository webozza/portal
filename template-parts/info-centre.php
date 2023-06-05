<?php
/**
* Template Name: Info Centre
*/

get_header(); ?>

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
        <!-- GUIDES -->
    </div>
<?php } else {
    include( get_template_directory() . '/template-parts/create/new-guide.php' );
} ?>

<!-- MODALS -->
<?php include(get_template_directory() . '/template-parts/modals/new-guide.php') ?>

<?php get_footer();