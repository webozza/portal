<?php
/**
* Template Name: Checklists
*/

get_header();
$user_id = get_current_user_id();
$user_first_name = get_user_meta( $user_id, 'first_name', true ); ?>

<div class="main">
    <div class="greetings has-options">
        <h2><?= get_the_title() ?></h2>
        <div>
            <a class="btn-cure trigger-modal" href="javascript:void(0)" data-modal="new-checklist">New Checklist +</a>
        </div>
    </div>
    <div class="cure-filters">
        <div class="date-notice">
            COMING SOON!
        </div>
        <div class="filters">
            <div class="filter">
                <a href="javascript:void(0)">Filters</a>
            </div>
        </div>
    </div>
    <div class="cr-table">
        <table>
            <tr>
                <th>Project name</th>
                <th>Checklist type</th>
                <th>Status</th>
                <th>Contributors</th>
                <th>Last updated</th>
                <th>Actions</th>
            </tr>
            <tbody>
                <!-- RUN LOOPS HERE -->
            </tbody>
        </table>
    </div>
</div>


<!-- MODALS -->
<?php include(get_template_directory() . '/template-parts/modals/new-checklist.php') ?>

<?php get_footer();