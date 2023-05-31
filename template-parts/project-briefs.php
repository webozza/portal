<?php
/**
* Template Name: Project Briefs
*/

get_header(); ?>

<?php
    // Query project brief
    $project_briefs = array(
        'post_type' => 'project-brief',
        'posts_per_page' => -1,
        'order' => 'ASC',
    );
    $pb = new WP_Query($project_briefs);
?>

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
            <div class="date-notice"></div>
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
                        <th>Assigned</th>
                        <th>Project name</th>
                        <th>Brief ID</th>
                        <th>Contributors</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- RUN LOOP -->
                    <?php if ( $pb->have_posts() ) : ?>
                        <?php while ( $pb->have_posts() ) : $pb->the_post(); ?>
                        <?php 
                            $assigned_name = get_field('prepared_by');
                        ?>
                            <tr data-id="<?php the_ID() ?>" class="approval-row project-brief">	

                                <!-- Brief Name -->
                                <td class="the-approval"><a href="<?php the_permalink() ?>"><?= get_field('template') . ' ' . 'Brief' ?></a></td>

                                <!-- Brief Date -->
                                <td><?= get_field('briefing_date') ?></td>

                                <!-- Brief From -->
                                <td><?= $assigned_name ?></td>

                                <!-- Brief Client -->
                                <td><?php the_field('prepared_for') ?></td>
                                
                                <!-- Brief ID -->
                                <td><?= 'PB' . get_the_ID() ?></td>

                                <!-- Brief Status -->
                                <td class="status-of-approval <?php if(get_field('status') == "Pending Approval") {echo 'pending';} else {echo 'approved';} ?>">
                                    <div><?php the_field('status') ?></div>
                                </td>

                                <!-- Brief Actions -->
                                <td>
                                    <div class="approval-actions">
                                        <a class="approval-edit" href="<?php the_permalink() ?>">
                                            <img src="<?= get_template_directory_uri() . '/img/icons/edit.png' ?>">
                                        </a>
                                        <!-- <a class="approval-delete" href="javascript:void(0)">
                                            <img src="<?= get_template_directory_uri() . '/img/icons/delete.png' ?>">
                                        </a> -->
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
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
<?php include(get_template_directory() . '/template-parts/modals/project-brief-success.php') ?>

<?php get_footer(); ?>