<?php
    $insights = $_POST['insights'];
    $actions = $_POST['actions'];
?>

<!-- Metrics -->
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
            <td><?= '$' . number_format(round($dq_ga_cost_wtd, 2)); ?></td>
            <td><?= number_format($dq_visitors_wtd) ?></td>
            <td><?= '$' . round($dq_ga_cost_wtd / $dq_visitors_wtd, 2) ?></td>
            <td>otw</td>
            <td>otw</td>
            <td>otw</td>
            <td>otw</td>
        </tr>
        <tr>
            <td>Month to Date</td>
            <td><?= '$' . number_format(round($dq_ga_cost_mtd, 2)); ?></td>
            <td><?= number_format($dq_visitors_mtd) ?></td>
            <td><?= '$' . round($dq_ga_cost_mtd / $dq_visitors_mtd, 2) ?></td>
            <td>otw</td>
            <td>otw</td>
            <td>otw</td>
            <td>otw</td>
        </tr>
    </tbody>
</table>

<!-- Insights -->
<h4>Insights</h4>
<ul>
    <?php foreach($insights as $insight) { ?>
        <li><?= $insight ?></li>
    <?php } ?>
</ul>

<!-- Actions -->
<h4>Actions</h4>
<ul>
    <?php foreach($actions as $action) { ?>
        <li><?= $action ?></li>
    <?php } ?>
</ul>