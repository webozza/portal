<?php
/**
* Template Name: Project Briefs
*/

get_header(); ?>

<?php if( isset($_GET['client_overview']) == "1" ) {
    include(get_template_directory() . '/template-parts/create/new-client-overview.php');
} else if( isset($_GET['new-brief']) == "1" ) {
    include(get_template_directory() . '/template-parts/create/new-brief.php');
} else { ?>
    <div class="main project-briefs">
        <div class="greetings has-options">
            <h2>Project Briefs</h2>
            <div>
                <a class="btn-cure trigger-modal" href="javascript:void(0)" data-modal="client-overview">New Client Overview +</a>
                <a class="btn-cure trigger-modal" href="javascript:void(0)" data-modal="new-brief">New Brief +</a>
            </div>
        </div>
        <div class="cure-filters">
            <div class="date-notice">
                COMING SOON!
            </div>
            <!-- FILTERS -->
            <div class="filters">
                <div class="filter search-brief cure-search">
                    <div class="cure-field-group">
                        <input type="search" value="" placeholder="Try `Miami beachhouse`">
                        <img src="<?= get_template_directory_uri() . '/img/icons/search.png' ?>">
                    </div>
                </div>
                <div class="filter">
                    <a class="no-hover" href="javascript:void(0)">
                        Filter briefs
                        <img src="<?= get_template_directory_uri() . '/img/icons/filter.png' ?>">
                    </a>
                </div>
            </div>
        </div>

        <!-- DATA | PROJECT BRIEFS -->
        <div class="cr-table">
            <table>
                <thead>
                    <tr>
                        <th>Project Brief</th>
                        <th>Date created</th>
                        <th>Project name</th>
                        <th>Briefing type</th>
                        <th>Contributors</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- RUN LOOP -->
                    <tr></tr>
                </tbody>
            </table>
        </div>

        <!-- <div class="dev-notes">
            <h3>Dev Notes</h3>
            <ul>
                <li>GA4 API Connected!</li>
            </ul>
        </div> -->
    </div>
<?php } ?>

<!-- MODALS -->
<?php include(get_template_directory() . '/template-parts/modals/new-brief.php') ?>
<?php include(get_template_directory() . '/template-parts/modals/client-overview.php') ?>
<?php include(get_template_directory() . '/template-parts/modals/client-overview-success.php') ?>

<?php get_footer(); ?>