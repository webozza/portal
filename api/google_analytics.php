<?php
require get_template_directory() . '/vendor/autoload.php';

use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;

$json_path = get_template_directory() . '/GA4_credentials.json';
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $json_path);

$property_id = array(
    'diabetes_qualified' => '362597853'
);
$client = new BetaAnalyticsDataClient();
$week_to_date = date('Y-m-d', strtotime("this week"));
$last_week_start = date('Y-m-d', strtotime("monday last week"));
$last_week_end = date('Y-m-d', strtotime("sunday last week"));
$month_to_date = date('Y-m-d', strtotime("first day of this month"));
$last_month_start = date('Y-m-d', strtotime("first day of last month"));
$last_month_end = date('Y-m-d', strtotime("last day of last month"));

/* GOOGLE ADS COST - DQ
================================================================================*/
$DQ_GA_COST_WTD = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $week_to_date,
            'end_date' => 'today',
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionGoogleAdsAccountName',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'advertiserAdCost'
        ]
    )
    ]
]);
$DQ_GA_COST_MTD = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $month_to_date,
            'end_date' => 'today',
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionGoogleAdsAccountName',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'advertiserAdCost'
        ]
    )
    ]
]);
$DQ_GA_COST_LW = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $last_week_start,
            'end_date' => $last_week_end,
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionGoogleAdsAccountName',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'advertiserAdCost'
        ]
    )
    ]
]);
$DQ_GA_COST_LM = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $last_month_start,
            'end_date' => $last_month_end,
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionGoogleAdsAccountName',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'advertiserAdCost'
        ]
    )
    ]
]);

$dq_ga_cost_wtd = array();
foreach ($DQ_GA_COST_WTD->getRows() as $row) {
    array_push($dq_ga_cost_wtd, $row->getMetricValues()[0]->getValue() );
}
$dq_ga_cost_wtd = array_sum($dq_ga_cost_wtd);

$dq_ga_cost_mtd = array();
foreach ($DQ_GA_COST_MTD->getRows() as $row) {
    array_push($dq_ga_cost_mtd, $row->getMetricValues()[0]->getValue() );
}
$dq_ga_cost_mtd = array_sum($dq_ga_cost_mtd);

$dq_ga_cost_lw = array();
foreach ($DQ_GA_COST_LW->getRows() as $row) {
    array_push($dq_ga_cost_lw, $row->getMetricValues()[0]->getValue() );
}
$dq_ga_cost_lw = array_sum($dq_ga_cost_lw);

$dq_ga_cost_lm = array();
foreach ($DQ_GA_COST_LM->getRows() as $row) {
    array_push($dq_ga_cost_lm, $row->getMetricValues()[0]->getValue() );
}
$dq_ga_cost_lm = array_sum($dq_ga_cost_lm);

/* NEW USERS - DQ
================================================================================*/
$DQ_VISITORS_WTD = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $week_to_date,
            'end_date' => 'today',
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionDefaultChannelGroup',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'newUsers'
        ]
    )
    ]
]);
$DQ_VISITORS_MTD = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $month_to_date,
            'end_date' => 'today',
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionDefaultChannelGroup',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'newUsers'
        ]
    )
    ]
]);
$DQ_VISITORS_LW = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $last_week_start,
            'end_date' => $last_week_end,
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionDefaultChannelGroup',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'newUsers'
        ]
    )
    ]
]);
$DQ_VISITORS_LM = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $last_month_start,
            'end_date' => $last_month_end,
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionDefaultChannelGroup',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'newUsers'
        ]
    )
    ]
]);

$dq_visitors_wtd = array();
foreach ($DQ_VISITORS_WTD->getRows() as $row) {
    // print $row->getDimensionValues()[0]->getValue()
    //     . ' ' . $row->getMetricValues()[0]->getValue() . PHP_EOL;
    array_push($dq_visitors_wtd, $row->getMetricValues()[0]->getValue() );
}
$dq_visitors_wtd = array_sum($dq_visitors_wtd);

$dq_visitors_mtd = array();
foreach ($DQ_VISITORS_MTD->getRows() as $row) {
    // print $row->getDimensionValues()[0]->getValue()
    //     . ' ' . $row->getMetricValues()[0]->getValue() . PHP_EOL;
    array_push($dq_visitors_mtd, $row->getMetricValues()[0]->getValue() );
}
$dq_visitors_mtd = array_sum($dq_visitors_mtd);

$dq_visitors_lw = array();
foreach ($DQ_VISITORS_LW->getRows() as $row) {
    // print $row->getDimensionValues()[0]->getValue()
    //     . ' ' . $row->getMetricValues()[0]->getValue() . PHP_EOL;
    array_push($dq_visitors_lw, $row->getMetricValues()[0]->getValue() );
}
$dq_visitors_lw = array_sum($dq_visitors_lw);

$dq_visitors_lm = array();
foreach ($DQ_VISITORS_LM->getRows() as $row) {
    // print $row->getDimensionValues()[0]->getValue()
    //     . ' ' . $row->getMetricValues()[0]->getValue() . PHP_EOL;
    array_push($dq_visitors_lm, $row->getMetricValues()[0]->getValue() );
}
$dq_visitors_lm = array_sum($dq_visitors_lm);








// RENDER TOTAL GOOGLE AD SPEND FROM GA4
// $google_ads_cost = array();
// foreach ($DQ_GA_COST_WTD->getRows() as $row) {
//     // print $row->getDimensionValues()[0]->getValue()
//     //     . ' ' . $row->getMetricValues()[0]->getValue() . PHP_EOL;
//     array_push($google_ads_cost, $row->getMetricValues()[0]->getValue() );
// }
// $google_ads_total_cost = array_sum($google_ads_cost);

// RENDER TOTAL NEW USERS COUNT
// $ga4_new_users = array();
// foreach ($DQ_VISITORS_WTD->getRows() as $row) {
//     // print $row->getDimensionValues()[0]->getValue()
//     //     . ' ' . $row->getMetricValues()[0]->getValue() . PHP_EOL;
//     array_push($ga4_new_users, $row->getMetricValues()[0]->getValue() );
// }
// $ga4_new_users = array_sum($ga4_new_users);

?>