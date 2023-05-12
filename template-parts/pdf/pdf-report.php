<?php
    $filename = plugin_dir_path( __FILE__ ) . "evaluation-report.pdf"; // You specify the path for the file
    ob_start();
    include( plugin_dir_path( __FILE__ ) . 'public/fpdf/fpdf.php');
    include( plugin_dir_path( __FILE__ ) . 'public/fpdf/writeHTML.php');
?>