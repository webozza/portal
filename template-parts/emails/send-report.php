<?php
    $insights = $_POST['insights'];
    $actions = $_POST['actions'];
    // WTD
    $ga_cost_wtd = str_replace('$','',$_POST['ga_cost_wtd']);
    $ga_cost_wtd = str_replace(',','',$ga_cost_wtd);
    $visitors_wtd = str_replace(',','',$_POST['visitors_wtd']);
    // MTD
    $ga_cost_mtd = str_replace('$','',$_POST['ga_cost_mtd']);
    $ga_cost_mtd = str_replace(',','',$ga_cost_mtd);
    $visitors_mtd = str_replace(',','',$_POST['visitors_mtd']);
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
            <td>otw</td>
            <td>otw</td>
            <td>otw</td>
            <td>otw</td>
        </tr>
        <tr>
            <td>Month to Date</td>
            <td><?= '$' . number_format($ga_cost_mtd, 2); ?></td>
            <td><?= number_format($visitors_mtd) ?></td>
            <td><?= '$' . number_format($ga_cost_mtd / $visitors_mtd, 2) ?></td>
            <td>otw</td>
            <td>otw</td>
            <td>otw</td>
            <td>otw</td>
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
