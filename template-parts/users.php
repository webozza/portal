<?php
/**
* Template Name: User Management
*/

get_header(); ?>

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
                    <?= $user->display_name ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php get_footer();