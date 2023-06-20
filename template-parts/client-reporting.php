<?php
/**
* Template Name: Client Reporting
*/

get_header();
$user_id = get_current_user_id();
$user_first_name = get_user_meta( $user_id, 'first_name', true );
$current_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

include( get_template_directory() . '/api/google_analytics.php');

if($dq_enrollments_wtd != "0") {
    $dq_cpa_wtd = "$" . number_format($dq_ga_cost_wtd / $dq_enrollments_wtd, 2);
} else {
    $dq_cpa_wtd = "N/A";
}

if($dq_enrollments_mtd != "0") {
    $dq_cpa_mtd = "$" . number_format($dq_ga_cost_mtd / $dq_enrollments_mtd, 2);
} else {
    $dq_cpa_mtd = "N/A";
}

if($dq_conversions_cds != "0") {
    $dq_cpa_cds = "$" . number_format($dq_ga_cost_cds / $dq_conversions_cds, 2);
} else {
    $dq_cpa_cds = "N/A";
}

if(isset($_POST['custom_date_selector']) == "1") {
    $client_reporting = [
        [
            'project' => 'Diabetes Qualified',
            'slug' => 'diabetes-qualified',
            'ad_spend' => '$' . number_format(round($dq_ga_cost_cds, 2)),
            'new_users' => number_format($dq_visitors_cds),
            'conversions' => $dq_conversions_cds,
            'cpa' => $dq_cpa_cds,
            'status' => 'N/A',
            'actions' => '>>',
            'thumb' => get_template_directory_uri() . '/img/icons/dq.png'
        ],
        [
            'project' => 'Langley Group Institute',
            'slug' => 'langley-group-institute',
            'ad_spend' => 'otw',
            'new_users' => 'otw',
            'conversions' => 'otw',
            'cpa' => 'otw',
            'status' => 'otw',
            'actions' => 'otw',
            'thumb' => get_template_directory_uri() . '/img/icons/lgi.jpeg'
        ],
    ];
} else {
    $client_reporting = [
        [
            'project' => 'Diabetes Qualified',
            'slug' => 'diabetes-qualified',
            'ad_spend' => '$' . number_format(round($dq_ga_cost_wtd, 2)),
            'new_users' => number_format($dq_visitors_wtd),
            'conversions' => $dq_enrollments_wtd,
            'cpa' => $dq_cpa_wtd,
            'status' => 'N/A',
            'actions' => '>>',
            'thumb' => get_template_directory_uri() . '/img/icons/dq.png'
        ],
        [
            'project' => 'Langley Group Institute',
            'slug' => 'langley-group-institute',
            'ad_spend' => 'otw',
            'new_users' => 'otw',
            'conversions' => 'otw',
            'cpa' => 'otw',
            'status' => 'otw',
            'actions' => 'otw',
            'thumb' => get_template_directory_uri() . '/img/icons/lgi.jpeg'
        ],
    ];
}


?>

<script>
    let metricsByClient = {
        diabetes_qualified: {
            ad_spend_wtd: '$<?= number_format($dq_ga_cost_wtd, 2); ?>',
            ad_spend_mtd: '$<?= number_format($dq_ga_cost_mtd, 2); ?>',
            new_users_wtd: '<?= number_format($dq_visitors_wtd); ?>',
            new_users_mtd: '<?= number_format($dq_visitors_mtd); ?>',
            enrolments_wtd: '<?= $dq_enrollments_wtd ?>',
            enrolments_mtd: '<?= $dq_enrollments_mtd ?>',
            cpa_wtd: '<?= $dq_cpa_wtd ?>',
            cpa_mtd: '<?= $dq_cpa_mtd ?>',
        },
        langley_group_institute: {
            ad_spend_wtd: '-/-',
        }
    }
</script>

<?php if( isset($_POST['single_client_report_view']) != "1" && isset($_POST['custom_date_selector']) != "1" ) { ?>
    <div class="main client-reporting-overview">
        <div class="greetings">
            <h2><?= get_the_title() ?></h2>
        </div>
        <div class="cure-filters">
            <div class="date-notice"></div>
            <div class="filters">
                <div class="filter active">
                    <a href="javascript:void(0)">WTD</a>
                </div>
                <div class="filter">
                    <a href="javascript:void(0)">MTD</a>
                </div>
                <div class="filter">
                    <a class="cds-filter" href="javascript:void(0)">Custom</a>
                    <div class="custom-date-selector">
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
                <div class="filter">
                    <a href="javascript:void(0)">Sort Client</a>
                </div>
            </div>
        </div>
        <div class="cr-table">
            <table>
                <thead>
                    <th>Client</th>
                    <th>Ad Spend</th>
                    <th>Visitors</th>
                    <th>Conversions</th>
                    <th>CPA</th>
                    <th>Status</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php foreach($client_reporting as $cp) { ?>
                        <tr class="<?= 'client--' . $cp['slug']?>">
                            <td>
                                <a href="javascript:void(0)" class="cure--project" data-client="<?= $cp['slug'] ?>">
                                    <img src="<?= $cp['thumb'] ?>">
                                    <span><?= $cp['project'] ?></span>
                                </a>
                            </td>
                            <td class="td-ad-spend"><?= $cp['ad_spend'] ?></td>
                            <td class="td-new-users"><?= $cp['new_users'] ?></td>
                            <td class="td-conversions"><?= $cp['conversions'] ?></td>
                            <td class="td-cpa"><?= $cp['cpa'] ?></td>
                            <td class="td-status"><?= $cp['status'] ?></td>
                            <td class="td-actions"><?= $cp['actions'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <form method="post" action="" class="hidden">
            <input type="hidden" name="client" value="">
            <input type="hidden" name="project_name" value="">
            <input type="hidden" name="report_type" value="Weekly Snapshot">
            <input type="hidden" name="single_client_report_view" value="1">
            <input type="submit">
        </form>

        <!-- Custom Date Selector -->
        <form id="custom_date_filter" method="post" action="" class="hidden">
            <input type="hidden" name="start_date" value="">
            <input type="hidden" name="end_date" value="">
            <input type="hidden" name="custom_date_selector" value="1">
            <input type="submit">
        </form>
    </div>
<?php } else if(isset($_POST['custom_date_selector']) != "1") { 
    $client_view_selected = $_POST['project_name'];
    if ($client_view_selected == "Diabetes Qualified") {
        $client_icon = get_template_directory_uri() . '/img/icons/dq.png';
    } elseif ($client_view_selected == "Langley Group Institute") {
        $client_icon = get_template_directory_uri() . '/img/icons/lgi.jpeg';
    }

    include(get_template_directory() . '/template-parts/single-client-reporting.php');
} ?>

<?php if(isset($_POST['custom_date_selector']) == "1" && isset($_POST['single_client_report_view']) != "1") { ?>
    <script>
        cure.dates['cds_start'] = "<?= $_POST['start_date'] ?>";
        cure.dates['cds_end'] = "<?= $_POST['end_date'] ?>";
        jQuery(document).ready(function($) {
            let formattedDate = cureDateConverter("<?= $_POST['start_date'] ?>","<?= $_POST['end_date'] ?>");
            $('.date-notice').text(formattedDate);
        })
    </script>
    <div class="main client-reporting-overview">
        <div class="greetings">
            <h2><?= get_the_title() ?></h2>
        </div>
        <div class="cure-filters">
            <div class="date-notice"></div>
            <div class="filters">
                <div class="filter">
                    <a href="javascript:void(0)">WTD</a>
                </div>
                <div class="filter">
                    <a href="javascript:void(0)">MTD</a>
                </div>
                <div class="filter active">
                    <a class="cds-filter" href="javascript:void(0)">Custom</a>
                    <div class="custom-date-selector">
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
                <div class="filter">
                    <a href="javascript:void(0)">Sort Client</a>
                </div>
            </div>
        </div>
        <div class="cr-table">
            <table>
                <thead>
                    <th>Client</th>
                    <th>Ad Spend</th>
                    <th>Visitors</th>
                    <th>Conversions</th>
                    <th>CPA</th>
                    <th>Status</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php foreach($client_reporting as $cp) { ?>
                        <tr class="<?= 'client--' . $cp['slug']?>">
                            <td>
                                <a href="javascript:void(0)" class="cure--project" data-client="<?= $cp['slug'] ?>">
                                    <img src="<?= $cp['thumb'] ?>">
                                    <span><?= $cp['project'] ?></span>
                                </a>
                            </td>
                            <td class="td-ad-spend"><?= $cp['ad_spend'] ?></td>
                            <td class="td-new-users"><?= $cp['new_users'] ?></td>
                            <td><?= $cp['conversions'] ?></td>
                            <td><?= $cp['cpa'] ?></td>
                            <td><?= $cp['status'] ?></td>
                            <td><?= $cp['actions'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="dev-notes hidden">
            <?php // include( get_template_directory() . '/api/google_ads.php'); ?>
            <h3>Dev Notes</h3>
            <ul>
                <li>GA4 API Connected!</li>
                <li>FB API hasn't been connected yet - unable to create an app on business manager. <strong>[Admin Access Required]</strong></li>
                <li>Need to downgrade PHP version to be able to host this application.</li>
                <li>LGI metrics (otw) - GA4 doesn't exist. <strong>[Need Approval to Create GA4]</strong></li>
                <li>DQ metrics (otw) - GA4 eCommerce tracking needs to be enabled. Note: this will mean disabling eCommerce tracking on the current UA. <strong>[Need Approval]</strong></li>
                <li>Vyro - on hold. <strong>[Need to add api generated user to GA4]</strong></li>
                <li>SL - on hold.</li>
            </ul>
        </div>

        <form method="post" action="" class="hidden">
            <input type="hidden" name="client" value="">
            <input type="hidden" name="project_name" value="">
            <input type="hidden" name="report_type" value="Weekly Snapshot">
            <input type="hidden" name="single_client_report_view" value="1">
            <input type="submit">
        </form>

        <!-- Custom Date Selector -->
        <form id="custom_date_filter" method="post" action="" class="hidden">
            <input type="hidden" name="start_date" value="">
            <input type="hidden" name="end_date" value="">
            <input type="hidden" name="custom_date_selector" value="1">
            <input type="submit">
        </form>
    </div>
<?php } ?>

<script>
    jQuery(document).ready(function($) {
        // $('.cr-table table').DataTable();
    });
</script>

<?php get_footer();