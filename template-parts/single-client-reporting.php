<?php
    $client = $_POST['client'];
    $project_name = $_POST['project_name'];
    $report_type = $_POST['report_type'];
?>

<script>
    cure["client"] = "<?= $project_name ?>";
    cure["approval_type"] = "<?= $report_type ?>";
</script>

<div class="main single-client-reporting">
    <div class="greetings">
        <h2><a class="breadcrumb_parent" href="javascript:void(0)">Client Reporting</a> / <?= $_POST['project_name'] ?></h2>
    </div>
    <?php if(isset($_POST['send_report']) == "1") { ?>
        <div class="report-sent-msg-container">
            <div class="inner">
                <p class="report-sent-msg"><img src="<?= get_template_directory_uri() . '/img/icons/checkmark.png'?>">Success! Your report was sent.</p>
                <span class="dismiss">Dismiss</span>
            </div>
        </div>
    <?php } ?>
    <div class="cure-filters">
        <div class="filters">
            <img class="client-icon-large" src="<?= $client_icon ?>">
            <div class="filter">
                <a href="javascript:void(0)">Channels</a>
            </div>
            <div class="filter">
                <a href="javascript:void(0)">Weekly Snapshot</a>
            </div>
            <div class="filter">
                <a href="javascript:void(0)">Monthly Report</a>
            </div>
        </div>
        <?php if($report_type == "Weekly Snapshot" || $report_type == "Monthly Report") { ?>
            <div class="filters cr-actions has-modal">
                <div class="filter cr-download">
                    <a class="cr--download" href="javascript:void(0)" data-modal="cr-download">
                        Download Report
                        <img src="<?= get_template_directory_uri() . '/img/icons/download.png' ?>">
                    </a>
                </div>
                <!-- <div class="filter cr-send">
                    <a href="javascript:void(0)" data-modal="cr-send">
                        Send Report
                        <img src="<?= get_template_directory_uri() . '/img/icons/send.png' ?>">
                    </a>
                </div> -->
                <div class="filter cr-send-for-approval">
                    <a href="javascript:void(0)" data-modal="cr-send-for-approval">
                        Send Report
                        <img src="<?= get_template_directory_uri() . '/img/icons/send.png' ?>">
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Single Client Report | Channels -->
    <?php if($report_type == "Channels") { ?>
        <div class="cr-table">
            <table>
                <thead>
                    <th>Channel</th>
                    <th>Ad Spend</th>
                    <th>Conversions</th>
                    <th>CPA</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Google Ads</td>
                        <td><?= '$' . round($dq_ga_cost_wtd, 2); ?></td>
                        <td>otw</td>
                        <td>otw</td>
                        <td>otw</td>
                    </tr>
                    <tr class="channel-total">
                        <td>Total</td>
                        <td><?= '$' . round($dq_ga_cost_wtd, 2); ?></td>
                        <td>otw</td>
                        <td>otw</td>
                        <td>otw</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="dev-notes">
            <?php // include( get_template_directory() . '/api/google_ads.php'); ?>
            <h3>Dev Notes</h3>
            <ul>
                <li>This design for metrics by channel does not have a date filter. <strong>[For Alex]</strong></li>
            </ul>
        </div>
    <?php } ?>

    <!-- Single Client Report | Weekly Snapshot -->
    <?php if($report_type == "Weekly Snapshot") { ?>
        <div class="cure-weekly-snapshot cure-report">
            <div class="inner">
                <div class="report-header">
                    <div>
                        <h5>Online</h5>
                        <h4>Weekly Snapshot Report</h4>
                    </div>
                    <div>
                        <img src="<?= $client_icon ?>">
                    </div>
                </div>
                <div class="report-body">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Spend</th>
                                <th>Visitors</th>
                                <th>Cost Per Visitor</th>
                                <th>Conversion Rate</th>
                                <th>Enrolments</th>
                                <th>Cost per Enrolment</th>
                                <th>Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Week to Date</td>
                                <td><?= '$' . number_format(round($dq_ga_cost_lw, 2)); ?></td>
                                <td><?= number_format($dq_visitors_lw) ?></td>
                                <td><?= '$' . round($dq_ga_cost_lw / $dq_visitors_lw, 2) ?></td>
                                <td>otw</td>
                                <td>otw</td>
                                <td>otw</td>
                                <td>otw</td>
                            </tr>
                            <tr>
                                <td>Month to Date</td>
                                <td><?= '$' . number_format(round($dq_ga_cost_lm, 2)); ?></td>
                                <td><?= number_format($dq_visitors_lm) ?></td>
                                <td><?= '$' . round($dq_ga_cost_lm / $dq_visitors_lm, 2) ?></td>
                                <td>otw</td>
                                <td>otw</td>
                                <td>otw</td>
                                <td>otw</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="cr-insights-container">
                        <div class="cr-insights">
                            <h4>Insights</h4>
                            <ul></ul>
                        </div>
                        <div class="cr-actions">
                            <h4>Actions</h4>
                            <ul></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="add-insights-container">
            <div class="cure-field-group add-insights">
                <div>
                    <label>Add Insights:</label>
                    <textarea placeholder="Add in your insights." value=""></textarea>
                </div>
                <div>
                    <a href="javascript:void(0)" class="btn-cure cr-button btn-add-insights">+ Add Insights</a>
                </div>
            </div>
            <div class="cure-field-group add-actions">
                <div>
                    <label>Add Actions:</label>
                    <textarea placeholder="List down the next action steps to be taken." value=""></textarea>
                </div>
                <div>
                    <a href="javascript:void(0)" class="btn-cure cr-button btn-add-insights">+ Add Actions</a>
                </div>
            </div>
        </div>

        <div class="dev-notes">
            <?php // include( get_template_directory() . '/api/google_ads.php'); ?>
            <h3>Dev Notes</h3>
            <ul>
                <li>The table section here was just an image on figma. <strong>[For Alex]</strong></li>
            </ul>
        </div>
    <?php } ?>

    <!-- Single Client Report | Monthly Report -->
    <?php if($report_type == "Monthly Report") { ?>
        <div class="cure-monthly-report cure-report">
            <div class="inner">
                <div class="report-header">
                    <div>
                        <h5>Online</h5>
                        <h4>Monthly Report</h4>
                    </div>
                    <div>
                        <img src="<?= $client_icon ?>">
                    </div>
                </div>
                <div class="report-body">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Spend</th>
                                <th>Visitors</th>
                                <th>Cost Per Visitor</th>
                                <th>Conversion Rate</th>
                                <th>Enrolments</th>
                                <th>Cost per Enrolment</th>
                                <th>Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Month to Date</td>
                                <td><?= '$' . number_format(round($dq_ga_cost_lm, 2)); ?></td>
                                <td><?= number_format($dq_visitors_lm) ?></td>
                                <td><?= '$' . round($dq_ga_cost_lm / $dq_visitors_lm, 2) ?></td>
                                <td>otw</td>
                                <td>otw</td>
                                <td>otw</td>
                                <td>otw</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="cr-insights-container">
                        <div class="cr-insights">
                            <h4>Insights</h4>
                            <ul></ul>
                        </div>
                        <div class="cr-actions">
                            <h4>Actions</h4>
                            <ul></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="add-insights-container">
            <div class="cure-field-group add-insights">
                <div>
                    <label>Add Insights:</label>
                    <textarea placeholder="Add in your insights." value=""></textarea>
                </div>
                <div>
                    <a href="javascript:void(0)" class="btn-cure cr-button btn-add-insights">+ Add Insights</a>
                </div>
            </div>
            <div class="cure-field-group add-actions">
                <div>
                    <label>Add Actions:</label>
                    <textarea placeholder="List down the next action steps to be taken." value=""></textarea>
                </div>
                <div>
                    <a href="javascript:void(0)" class="btn-cure cr-button btn-add-insights">+ Add Actions</a>
                </div>
            </div>
        </div>

        <div class="dev-notes">
            <?php // include( get_template_directory() . '/api/google_ads.php'); ?>
            <h3>Dev Notes</h3>
            <ul>
                <li>The table section here was just an image on figma. <strong>[For Alex]</strong></li>
            </ul>
        </div>
    <?php } ?>

    <form method="post" action="" class="hidden">
        <input type="hidden" name="client" value="<?= $client ?>">
        <input type="hidden" name="project_name" value="<?= $project_name ?>">
        <input type="hidden" name="report_type" value="">
        <input type="hidden" name="single_client_report_view" value="1">
        <input type="submit">
    </form>

    <script>
        let reportType = "Channels";
        <?php if($report_type) { ?>
            reportType = "<?= $_POST['report_type'] ?>";
        <?php } ?>
        jQuery(document).ready(function($) {
            $(".filters .filter:not(.cr-download):not(.cr-send)").each(function () {
            let reportTypeSelected = $(this).find("a");
                if (reportTypeSelected.text() == reportType) {
                    reportTypeSelected.parent().addClass("active");
                }
            });
        });
    </script>
</div>

<!-- Modals -->
<?php include(get_template_directory() . '/template-parts/modals/forgot-insights.php') ?>
<?php include(get_template_directory() . '/template-parts/modals/send-report-for-approval.php') ?>
