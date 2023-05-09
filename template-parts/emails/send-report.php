<?php
    $insights = $_POST['insights'];
?>

<h4>Insights</h4>
<ul>
    <?php foreach($insights as $insight) { ?>
        <li><?= $insight ?></li>
    <?php } ?>
</ul>