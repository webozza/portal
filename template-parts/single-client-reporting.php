<div class="main single-client-reporting">
    <div class="greetings">
        <h2><a class="breadcrumb_parent" href="javascript:void(0)">Client Reporting</a> / <?= $_POST['project_name'] ?></h2>
    </div>
    <div class="cure-filters">
        <div class="date-notice">
            <div class="filters">
                <img class="client-icon-large" src="<?= $client_icon ?>">
                <div class="filter active">
                    <a href="javascript:void(0)">Channels</a>
                </div>
                <div class="filter">
                    <a href="javascript:void(0)">Weekly Snapshot</a>
                </div>
                <div class="filter">
                    <a href="javascript:void(0)">Monthly Report</a>
                </div>
            </div>
        </div>
        
    </div>
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
                    <td>Facebook Ads</td>
                    <td>otw</td>
                    <td>otw</td>
                    <td>otw</td>
                    <td>otw</td>
                </tr>
                <tr>
                    <td>Google Ads</td>
                    <td><?= '$' . round($google_ads_total_cost, 2); ?></td>
                    <td>otw</td>
                    <td>otw</td>
                    <td>otw</td>
                </tr>
                <tr class="channel-total">
                    <td>Total</td>
                    <td><?= '$' . round($google_ads_total_cost, 2) . ' + ' . 'FB'; ?></td>
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

    <form method="post" action="" class="hidden">
        <input type="hidden" name="client" value="">
        <input type="hidden" name="single_client_report_view" value="1">
        <input type="submit">
    </form>
</div>