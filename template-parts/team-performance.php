<?php
/**
* Template Name: Performance - Team
*/

get_header(); ?>

<div class="main user-management team-performance">
    <div class="greetings has-options">
        <h2>Billable Hours</h2>
        <div>
            <!-- <a class="btn-cure trigger-modal" href="javascript:void(0)" data-modal="new-user">Add User +</a> -->
        </div>
    </div>
    <div class="cure-filters">
        <div class="date-notice"></div>
        <div class="filters">
            <div class="filter active filter-date-range">
                <a href="javascript:void(0)">WTD</a>
            </div>
            <div class="filter filter-date-range">
                <a href="javascript:void(0)">MTD</a>
            </div>
            <div class="filter filter-cds">
                <a class="cds-filter" href="javascript:void(0)">Custom</a>
                <div class="custom-date-selector" style="display: none;">
                    <div class="cds-from">
                        <label>From:</label>
                        <input type="date" name="cds_from" value="">
                    </div>
                    <div class="cds-to">
                        <label>To:</label>
                        <input type="date" name="cds_to" value="">
                    </div>
                    <div class="cds-submit">
                        <button class="cds-btn-submit">Apply</button>
                        <button class="cds-btn-cancel">Cancel</button>
                    </div>
                    <div class="cds-error">
                        <p style="color:red;"></p>
                    </div>
                </div>
            </div>
            <div class="filter f--user">
                <select class="has-select2">
                    <option selected>All Users</option>
                </select>
            </div>
            <div class="filter f--status">
                <select class="has-select2">
                    <option value="billable" selected>Billable</option>
                    <option value="all">All Status</option>
                    <option value="non-billable">Non-Billable</option>
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
                    <th>Role</th>
                    <th class="th-target">
                        <div>
                            Target Hit
                            <img class="icon-sort" src="<?= get_template_directory_uri() . '/img/icons/sort.png' ?>">
                        </div>
                    </th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- RUN USER LOOP HERE -->
                <?php foreach($users as $user) { ?>
                    <tr data-id="<?= $user->ID ?>" data-billable-hours-per-day="<?= get_field('billable_hours_per_day', 'user_'.$user->ID) ?>" data-id-ph="<?= get_field('userid_ph', 'user_'.$user->ID) ?>" data-hours-per-day="<?= get_field('hours_per_day', 'user_'.$user->ID) ?>" data-days-per-week="<?= get_field('days_per_week', 'user_'.$user->ID) ?>" data-days-selected='<?= get_field('working_days_selected', 'user_'.$user->ID) ?>' data-chunks="true">
                        <!-- NAME & PROFILE PIC -->
                        <td class="cure-user">
                            <div>
                                <img src="<?= get_template_directory_uri() . '/img/data-loader.gif' ?>">
                                <span><?= $user->display_name ?></span>
                            </div>
                        </td>
                        <td><?= get_field('cure_role', 'user_'.$user->ID) ?></td>
                        <!-- TOTAL HOURS HIT -->
                        <td class="total-hours-hit">
                            <div>
                                <meter min="0" max="100" value=""></meter>
                                <img class="data--loader" height="15" src="<?= get_template_directory_uri() . '/img/data-loader.gif' ?>">
                                <div class="percentage-hit"></div>
                            </div>
                        </td>
                        <td class="total-hours-hit">
                            <div>
                                <div class="status-text">
                                    <img height="15" src="<?= get_template_directory_uri() . '/img/data-loader.gif' ?>">
                                </div>
                                <div class="user-status">
                                    <div class="under hidden">Under</div>
                                    <div class="at-risk hidden">Under</div>
                                    <div class="on-target hidden">On target</div>
                                    <div class="over hidden">Over</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="approval-actions">
                                <a class="approval-email" href="mailto:<?= $user->user_email; ?>">
                                    <img src="<?= get_template_directory_uri() . '/img/icons/email.png' ?>">
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