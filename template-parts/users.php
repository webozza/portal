<?php
/**
* Template Name: User Management
*/

get_header(); ?>

<div class="main user-management">
    <div class="greetings has-options">
        <h2>User Management</h2>
        <div>
            <a class="btn-cure trigger-modal" href="javascript:void(0)" data-modal="new-user">Add User +</a>
        </div>
    </div>
    <div class="cure-filters">
        <div class="date-notice">
            Let Rony know if there's an issue!!
        </div>
        <div class="filters">
            <div class="filter f--user">
                <select>
                    <option selected>All Users</option>
                </select>
            </div>
            <div class="filter f--client">
                <select>
                    <option selected>All Roles</option>
                </select>
            </div>
            <div class="filter f--search hidden">
                <a href="javascript:void(0)">Filter >></a>
            </div>
        </div>
    </div>

    <!-- Client Reports -->
    <?php $users = get_users() ?>
    <div class="cr-table">
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>ID</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- RUN USER LOOP HERE -->
                <?php foreach($users as $user) { ?>
                    <tr data-id="<?= $user->ID ?>" data-id-ph="<?= get_field('userid_ph', 'user_'.$user->ID) ?>" data-hours-per-day="<?= get_field('hours_per_day', 'user_'.$user->ID) ?>" data-days-per-week="<?= get_field('days_per_week', 'user_'.$user->ID) ?>">
                        <!-- NAME & PROFILE PIC -->
                        <td class="cure-user">
                            <div>
                                <img src="<?= get_template_directory_uri() . '/img/data-loader.gif' ?>">
                                <span><?= $user->display_name ?></span>
                            </div>
                        </td>
                        <td class="cure-user-id"><?= 'C-' . sprintf('%03d', $user->ID); ?></td>
                        <td><?= get_field('cure_role', 'user_'.$user->ID) ?></td>
                        <td>
                            <div class="approval-actions">
                                <a class="send-password-reset" href="javascript:void(0)">
                                    <img title="Send password reset" src="<?= get_template_directory_uri() . '/img/icons/email.png' ?>">
                                </a>
                                <a class="approval-edit" href="javascript:void(0)">
                                    <img src="<?= get_template_directory_uri() . '/img/icons/edit.png' ?>">
                                </a>
                                <a class="approval-delete" href="javascript:void(0)">
                                    <img src="<?= get_template_directory_uri() . '/img/icons/delete.png' ?>">
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modals -->
<?php include(get_template_directory() . '/template-parts/modals/new-user.php') ?>

<?php get_footer();