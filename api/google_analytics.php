<?php
require get_template_directory() . '/vendor/autoload.php';

use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;

$json_path = get_template_directory() . '/GA4_credentials.json';
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $json_path);

/**
 * TODO(developer): Replace this variable with your Google Analytics 4
 *   property ID before running the sample.
 */
$property_id = '362597853';

// Using a default constructor instructs the client to use the credentials
// specified in GOOGLE_APPLICATION_CREDENTIALS environment variable.
$client = new BetaAnalyticsDataClient();

// Date filters
$week_to_date = date('Y-m-d', strtotime("this week"));

// Retrive GA4 Ad Spend by Campaign Name
$GA4_AD_SPEND = $client->runReport([
    'property' => 'properties/' . $property_id,
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

// Retrive Total New Users
$GA4_NEW_USERS = $client->runReport([
    'property' => 'properties/' . $property_id,
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

// RENDER TOTAL GOOGLE AD SPEND FROM GA4
$google_ads_cost = array();
foreach ($GA4_AD_SPEND->getRows() as $row) {
    // print $row->getDimensionValues()[0]->getValue()
    //     . ' ' . $row->getMetricValues()[0]->getValue() . PHP_EOL;
    array_push($google_ads_cost, $row->getMetricValues()[0]->getValue() );
}
$google_ads_total_cost = array_sum($google_ads_cost);

// RENDER TOTAL NEW USERS COUNT
$ga4_new_users = array();
foreach ($GA4_NEW_USERS->getRows() as $row) {
    // print $row->getDimensionValues()[0]->getValue()
    //     . ' ' . $row->getMetricValues()[0]->getValue() . PHP_EOL;
    array_push($ga4_new_users, $row->getMetricValues()[0]->getValue() );
}
$ga4_new_users = array_sum($ga4_new_users);

?>