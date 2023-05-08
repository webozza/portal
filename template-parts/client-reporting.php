<?php
/**
* Template Name: Client Reporting
*/

get_header();
$user_id = get_current_user_id();
$user_first_name = get_user_meta( $user_id, 'first_name', true );
$current_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

include( get_template_directory() . '/api/google_analytics.php');

$client_reporting = [
    [
        'project' => 'Diabetes Qualified',
        'slug' => 'diabetes-qualified',
        'ad_spend' => '$' . round($google_ads_total_cost, 2),
        'new_users' => $ga4_new_users,
        'conversions' => 'otw',
        'cpa' => 'otw',
        'status' => 'otw',
        'actions' => 'otw',
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

?>

<?php if( isset($_POST['single_client_report_view']) != "1" ) { ?>
    <div class="main">
        <div class="greetings">
            <h2><?= get_the_title() ?></h2>
        </div>
        <div class="cure-filters">
            <div class="date-notice">
                GA4 API Connected!  |   FB API IN PROGRESS!
            </div>
            <div class="filters">
                <div class="filter active">
                    <a href="javascript:void(0)">Weekly</a>
                </div>
                <div class="filter">
                    <a href="javascript:void(0)">Monthly</a>
                </div>
                <div class="filter">
                    <a href="javascript:void(0)">Custom</a>
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
                    <th>New Users</th>
                    <th>Conversions</th>
                    <th>CPA</th>
                    <th>Status</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php foreach($client_reporting as $cp) { ?>
                        <tr>
                            <td>
                                <a href="javascript:void(0)" class="cure--project" data-client="<?= $cp['slug'] ?>">
                                    <img src="<?= $cp['thumb'] ?>">
                                    <span><?= $cp['project'] ?></span>
                                </a>
                            </td>
                            <td><?= $cp['ad_spend'] ?></td>
                            <td><?= $cp['new_users'] ?></td>
                            <td><?= $cp['conversions'] ?></td>
                            <td><?= $cp['cpa'] ?></td>
                            <td><?= $cp['status'] ?></td>
                            <td><?= $cp['actions'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="dev-notes">
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
            <input type="hidden" name="single_client_report_view" value="1">
            <input type="submit">
        </form>
    </div>
<?php } else { 
    $client_view_selected = $_POST['project_name'];
    if ($client_view_selected == "Diabetes Qualified") {
        $client_icon = get_template_directory_uri() . '/img/icons/dq.png';
    } elseif ($client_view_selected == "Langley Group Institute") {
        $client_icon = get_template_directory_uri() . '/img/icons/lgi.jpeg';
    }

    include(get_template_directory() . '/template-parts/single-client-reporting.php');
} ?>

<script>
    jQuery(document).ready(function($) {
        // $('.cr-table table').DataTable();
    });
</script>

<?php get_footer();