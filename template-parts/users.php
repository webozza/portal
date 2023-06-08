<?php
/**
* Template Name: User Management
*/

get_header(); ?>

<div class="main user-management">
    <div class="greetings has-options">
        <h2>User Management</h2>
        <div>
            <a class="btn-cure trigger-modal" href="javascript:void(0)" data-modal="new-guide">Add User +</a>
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
            <div class="filter f--search">
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
                    <tr>
                        <td class="cure-user"><?= $user->display_name ?></td>
                        <td class="cure-user-id"><?= 'C-' . sprintf('%03d', $user->ID); ?></td>
                        <td><?php echo ($user->ID == "1" || $user->ID == "3") ? 'Administrator' : 'Member' ?></td>
                        <td>
                            <div class="approval-actions">
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

<?php get_footer();