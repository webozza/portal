<?php
    $insights = $_POST['insights'];
    $actions = $_POST['actions'];

    // WTD
    $ga_cost_wtd = str_replace('$','',$_POST['ga_cost_wtd']);
    $ga_cost_wtd = str_replace(',','',$ga_cost_wtd);
    $visitors_wtd = str_replace(',','',$_POST['visitors_wtd']);
    $conversion_rate_wtd = $_POST['conversion_rate_wtd'];
    $enrolments_wtd = $_POST['enrolments_wtd'];
    $cost_per_enrolments_wtd = $_POST['cost_per_enrolments_wtd'];
    $sales_wtd = $_POST['sales_wtd'];

    // MTD
    $ga_cost_mtd = str_replace('$','',$_POST['ga_cost_mtd']);
    $ga_cost_mtd = str_replace(',','',$ga_cost_mtd);
    $visitors_mtd = str_replace(',','',$_POST['visitors_mtd']);
    $conversion_rate_mtd = $_POST['conversion_rate_mtd'];
    $enrolments_mtd = $_POST['enrolments_mtd'];
    $cost_per_enrolments_mtd = $_POST['cost_per_enrolments_mtd'];
    $sales_mtd = $_POST['sales_mtd'];
?>

<!-- Metrics -->
<table cellpadding="0" cellspacing="0" align="left" border="1" width="100%">
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
            <td><?= '$' . number_format($ga_cost_wtd, 2); ?></td>
            <td><?= number_format($visitors_wtd) ?></td>
            <td><?= '$' . number_format($ga_cost_wtd / $visitors_wtd, 2) ?></td>
            <td><?= $conversion_rate_wtd ?></td>
            <td><?= $enrolments_wtd ?></td>
            <td><?= $cost_per_enrolments_wtd ?></td>
            <td><?= $sales_wtd ?></td>
        </tr>
        <tr>
            <td>Month to Date</td>
            <td><?= '$' . number_format($ga_cost_mtd, 2); ?></td>
            <td><?= number_format($visitors_mtd) ?></td>
            <td><?= '$' . number_format($ga_cost_mtd / $visitors_mtd, 2) ?></td>
            <td><?= $conversion_rate_mtd ?></td>
            <td><?= $enrolments_mtd ?></td>
            <td><?= $cost_per_enrolments_mtd ?></td>
            <td><?= $sales_mtd ?></td>
        </tr>
    </tbody>
</table>

<!-- Insights -->
<table cellpadding="0" cellspacing="0" align="left" border="0" width="100%">
    <tr>
        <td>
            <h4>Insights</h4>
            <ul>
                <?php foreach($insights as $insight) { ?>
                    <li><?= $insight ?></li>
                <?php } ?>
            </ul>
        </td>
    </tr>
</table>

<!-- Actions -->
<table cellpadding="0" cellspacing="0" align="left" border="0" width="100%">
    <tr>
        <td>
            <h4>Actions</h4>
            <ul>
                <?php foreach($actions as $action) { ?>
                    <li><?= $action ?></li>
                <?php } ?>
            </ul>
        </td>
    </tr>
</table>
