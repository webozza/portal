<?php
/**
* Template Name: Approvals
*/

get_header(); ?>

<?php
    $client_reports = array(
        'post_type' => 'reports',
        'posts_per_page' => -1,
        'order' => 'ASC',
    );
    $cr = new WP_Query($client_reports); 
?>

<div class="main approvals">
    <div class="greetings">
        <h2>Approvals</h2>
    </div>
    <div class="cure-filters">
        <div class="date-notice">
            All kinds of approvals
        </div>
        <div class="filters">
            <div class="filter">
                <a href="javascript:void(0)">By User</a>
            </div>
            <div class="filter">
                <a href="javascript:void(0)">By Client</a>
            </div>
            <div class="filter">
                <a href="javascript:void(0)">Hide Approved</a>
            </div>
            <div class="filter">
                <a href="javascript:void(0)">By Type</a>
            </div>
        </div>
    </div>

    <!-- Client Reports -->
    <div class="cr-table">
        <table>
            <thead>
                <tr>
                    <th>Client Reports</th>
                    <th>Sent by</th>
                    <th>Client</th>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ( $cr->have_posts() ) : ?>
                <?php while ( $cr->have_posts() ) : $cr->the_post(); ?>
                <?php 
                    $assigned_id = get_field('sent_by');
                    $assigned_first_name = get_user_meta( $assigned_id, 'first_name', true );
                    $assigned_last_name = get_user_meta( $assigned_id, 'last_name', true );
                    $assigned_name = $assigned_first_name . ' ' . $assigned_last_name;
                ?>
                    <tr data-id="<?php the_ID() ?>" class="approval-row client-reports">	

                        <!-- Approval Name -->
                        <td class="the-approval"><a href="<?php the_permalink() ?>"><?php the_field('approval_type') ?></a></td>

                        <!-- Approval From -->
                        <td><?= $assigned_name ?></td>

                        <!-- Approval Client -->
                        <td><?php the_field('client') ?></td>
                        
                        <!-- Approval ID -->
                        <td><?= 'CR' . get_the_ID() ?></td>

                        <!-- Approval Status -->
                        <td class="status-of-approval <?php if(get_field('status') == "Pending Approval") {echo 'pending';} else {echo 'approved';} ?>">
                            <div><?php the_field('status') ?></div>
                        </td>

                        <!-- Approval Actions -->
                        <td>
                            <div class="approval-actions">
                                <a class="approval-edit" href="<?php the_permalink() ?>">
                                    <img src="<?= get_template_directory_uri() . '/img/icons/edit.png' ?>">
                                </a>
                                <a class="approval-delete" href="javascript:void(0)">
                                    <img src="<?= get_template_directory_uri() . '/img/icons/delete.png' ?>">
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Client Overview -->
    <div class="cr-table">
        <table>
            <thead>
                <tr>
                    <th>Client Overview</th>
                    <th>Date created</th>
                    <th>Project name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
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

<?php get_footer();