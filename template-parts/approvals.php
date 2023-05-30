<?php
/**
* Template Name: Approvals
*/

get_header(); ?>

<?php

    // Query client reports
    $client_reports = array(
        'post_type' => 'reports',
        'posts_per_page' => -1,
        'order' => 'ASC',
    );
    $cr = new WP_Query($client_reports); 

    // Query client overviews
    $client_overviews = array(
        'post_type' => 'client-overview',
        'posts_per_page' => -1,
        'order' => 'ASC',
    );
    $co = new WP_Query($client_overviews);

    // Query project brief
    $project_briefs = array(
        'post_type' => 'project-brief',
        'posts_per_page' => -1,
        'order' => 'ASC',
    );
    $pb = new WP_Query($project_briefs);
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
            <div class="filter f--user">
                <select>
                    <option selected>All Users</option>
                </select>
            </div>
            <div class="filter f--client">
                <select>
                    <option selected>All Clients</option>
                </select>
            </div>
            <div class="filter f--status">
                <select>
                    <option selected>Status</option>
                    <option>Approved</option>
                    <option>Pending Approval</option>
                </select>
            </div>
            <div class="filter f--type">
                <select>
                    <option selected>All Types</option>
                </select>
            </div>
            <div class="filter f--search">
                <a href="javascript:void(0)">Filter >></a>
            </div>
        </div>
    </div>

    <!-- Client Reports -->
    <div class="cr-table">
        <table>
            <thead>
                <tr>
                    <th>Approvals</th>
                    <th>Sent by</th>
                    <th>Client</th>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
                <!-- Client Reports -->
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
                            <td class="the-user"><?= $assigned_name ?></td>

                            <!-- Approval Client -->
                            <td class="the-client"><?php the_field('client') ?></td>
                            
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

                <!-- Client Overview -->
                <?php if ( $co->have_posts() ) : ?>
                    <?php while ( $co->have_posts() ) : $co->the_post(); ?>
                    <?php 
                        $assigned_name = get_field('prepared_by');
                    ?>
                        <tr data-id="<?php the_ID() ?>" class="approval-row client-overview">	

                            <!-- Approval Name -->
                            <td class="the-approval"><a href="<?php the_permalink() ?>"><?= 'Client Overview' ?></a></td>

                            <!-- Approval From -->
                            <td class="the-user"><?= $assigned_name ?></td>

                            <!-- Approval Client -->
                            <td class="the-client"><?php the_field('prepared_for') ?></td>
                            
                            <!-- Approval ID -->
                            <td><?= 'CO' . get_the_ID() ?></td>

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

                <!-- Project Brief -->
                <?php if ( $pb->have_posts() ) : ?>
                    <?php while ( $pb->have_posts() ) : $pb->the_post(); ?>
                    <?php 
                        $assigned_name = get_field('prepared_by');
                    ?>
                        <tr data-id="<?php the_ID() ?>" class="approval-row project-brief">	

                            <!-- Approval Name -->
                            <td class="the-approval"><a href="<?php the_permalink() ?>"><?= get_field('template') . ' ' . 'Brief' ?></a></td>

                            <!-- Approval From -->
                            <td class="the-user"><?= $assigned_name ?></td>

                            <!-- Approval Client -->
                            <td class="the-client"><?php the_field('prepared_for') ?></td>
                            
                            <!-- Approval ID -->
                            <td><?= 'PB' . get_the_ID() ?></td>

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

    <!-- <div class="dev-notes">
        <h3>Dev Notes</h3>
        <ul>
            <li>GA4 API Connected!</li>
        </ul>
    </div> -->
</div>

<?php get_footer();