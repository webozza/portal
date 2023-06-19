<?php
/**
* Template Name: Performance - Project
*/

get_header(); ?>

<div class="main user-management client-performance">
    <div class="greetings has-options">
        <h2>Project Performance</h2>
        <div>
            <!-- <a class="btn-cure trigger-modal" href="javascript:void(0)" data-modal="new-user">Add User +</a> -->
        </div>
    </div>
    <div class="cure-filters">
        <div class="date-notice">
            Let Rony know if there's an issue!!
        </div>
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
                    <option selected>All Projects</option>
                </select>
            </div>
            <div class="filter f--status">
                <select class="has-select2">
                    <option value="all" selected>All Status</option>
                    <option value="billable">Billable</option>
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
                    <th>Client</th>
                    <th>Target Hit</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- RUN USER LOOP HERE -->
            </tbody>
        </table>
    </div>
    <div class="api-loader">
        <img src="<?= get_template_directory_uri() . '/img/shimmer-loading-effect.gif' ?>">
    </div>
</div>

<?php get_footer();